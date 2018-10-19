<?php

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use common\models\LoginForm;
use common\models\ContactForm;
use common\models\CallData;
use common\models\Agent;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('dashboard');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    { 
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
    
    
    public function actionTotalcallcount(){
        
        $callCenter = Yii::$app->request->post('call_center');
                
        $response = array();
        
        if($callCenter == "all" || empty($callCenter)){
            $callCenter = '6,19,11,25,10';
        }
        
        $callCenterArray = explode(",",$callCenter);
        
        $fromTime = "8:00:00";
        $toTime = date("H:i:s");
        
        $callDate = date("Y-m-d");
        
        $agentIDs = Agent::find()
                ->select("AgentID")
                ->where(['in', 'ParentTenantID', $callCenterArray])
                ->andFilterWhere(['Active' => 1])
                ->asArray();
        
        $call = CallData::find()
                ->select("RowID")
                ->where(['between','CreateDate', $callDate ." " . $fromTime,$callDate . " " .$toTime ])
                ->andFilterWhere(['in', 'AgentID', $agentIDs])
                ->count();        
       
        $oldDate = date("Y-m-d" ,strtotime('-1 week',time()));
         
        $lastWeekcall = CallData::find()
                ->select("RowID")
                ->where(['between','CreateDate', $oldDate ." " .$fromTime, $oldDate ." ".$toTime ])
                ->andFilterWhere(['in', 'AgentID', $agentIDs])
                ->count();
        
        $todaysCount = $call;
        
        $lastWeekCount = $lastWeekcall;
        
        $callRate = ($call && $lastWeekcall) ? (($todaysCount - $lastWeekCount) / $lastWeekCount) *100 : 0;
        
        $response['todaysCount']    = $todaysCount;
        
        $response['lastWeekCount']  = $lastWeekCount;
        
        $response['callsRate']      = number_format((float) (abs($callRate)), 2, '.',',') ."%";
        
        $response['callsActualRate']= $callRate;
        
        $response['arrowType']      = ( $callRate < 0 ) ? "arrow-down" : "arrow-up" ;
                
        echo json_encode($response);
    }
    
    public function actionTotalorderscount(){
        
        $callCenter = Yii::$app->request->post('call_center');
        
        $response = array();
        
        if($callCenter == "all" || empty($callCenter)){
            $callCenter = '6,19,11,25,10';
        }
        
        $callCenterArray = explode(",",$callCenter);
        
        $fromTime = "8:00:00";
        $toTime = date("H:i:s");
        
        $callDate = date("Y-m-d");
        
        $agentIDs = Agent::find()
                ->select("AgentID")
                ->where(['in', 'ParentTenantID', $callCenterArray])
                ->andFilterWhere(['Active' => 1])
                ->asArray();
        
        $call = CallData::find()
                ->select("RowID")
                ->where(['between','CreateDate', $callDate ." " . $fromTime,$callDate . " " .$toTime ])
                ->andFilterWhere(['in', 'AgentID', $agentIDs])
                ->andFilterWhere(["!=" , 'OrderID', ""])
                ->count();        
       
        $oldDate = date("Y-m-d" ,strtotime('-1 week',time()));
         
        $lastWeekcall = CallData::find()
                ->select("RowID")
                ->where(['between','CreateDate', $oldDate ." " .$fromTime, $oldDate ." ".$toTime ])
                ->andFilterWhere(['in', 'AgentID', $agentIDs])
                ->andFilterWhere(["!=" , 'OrderID', ""])
                ->count();
        
        $todaysCount = $call;
        
        $lastWeekCount = $lastWeekcall;
        
        $callRate = ($todaysCount && $lastWeekCount) ? (($todaysCount - $lastWeekCount) / $lastWeekCount) *100 : 0;
        
        $response['todaysCount']    = $todaysCount;
        
        $response['lastWeekCount']  = $lastWeekCount;
        
        $response['ordersActualRate']= $callRate;
        
        $response['callsRate']      = number_format((float) (abs($callRate)), 2, '.',',') . "%";
        
        $response['arrowType']      = ( $callRate < 0 ) ? "arrow-down" : "arrow-up" ;
        
        $response['textColor']      = ( $callRate < 0 ) ? "color-red" : "color-green" ;
        
        echo json_encode($response);
    }
    
    public function actionAnswerrate(){
        
        $call_center = Yii::$app->request->post('call_center');
        
        $response = array();
        
        $response['answerRate']    = rand(10,100);
        
        echo json_encode($response);
    }
    
    public function actionAttachementrate(){
        
        $callCenter = Yii::$app->request->post('call_center');
        
        $response = array();
        
        if($callCenter == "all" || empty($callCenter)){
            $callCenter = '6,19,11,25,10';
        }
        
        $callCenterArray = explode(",",$callCenter);
        
        $fromTime = "8:00:00";
        $toTime = date("H:i:s");
        
        $callDate = date("Y-m-d");
        
        $agentIDs = Agent::find()
                ->select("AgentID")
                ->where(['in', 'ParentTenantID', $callCenterArray])
                ->andFilterWhere(['Active' => 1])
                ->asArray();
        
        $call = CallData::find()
                ->select("RowID")
                ->where(['between','CreateDate', $callDate ." " . $fromTime,$callDate . " " .$toTime ])
                ->andFilterWhere(['in', 'AgentID', $agentIDs])
                ->andFilterWhere(["!=" , 'OrderID', ""])
                ->count();        
       
        $oldDate = date("Y-m-d" ,strtotime('-1 week',time()));
         
        $voiceRates = CallData::find()
                ->select("RowID")
                ->where(['between','CreateDate', $oldDate ." " .$fromTime, $oldDate ." ".$toTime ])
                ->andFilterWhere(['in', 'AgentID', $agentIDs])
                ->andFilterWhere(["!=" , 'OrderID', ""])
                ->andFilterWhere(["!=" , 'VoIPSold', ""])
                ->count();
        
        $erRates = CallData::find()
                ->select("RowID")
                ->where(['between','CreateDate', $oldDate ." " .$fromTime, $oldDate ." ".$toTime ])
                ->andFilterWhere(['in', 'AgentID', $agentIDs])
                ->andFilterWhere(["!=" , 'OrderID', ""])
                ->andFilterWhere(["!=" , 'ExpRepairSold', ""])
                ->count();
        
        $pceRates = CallData::find()
                ->select("RowID")
                ->where(['between','CreateDate', $oldDate ." " .$fromTime, $oldDate ." ".$toTime ])
                ->andFilterWhere(['in', 'AgentID', $agentIDs])
                ->andFilterWhere(["!=" , 'OrderID', ""])
                ->andFilterWhere(["!=" , 'PCESold', ""])
                ->count();
        
        $nortonRates = CallData::find()
                ->select("RowID")
                ->where(['between','CreateDate', $oldDate ." " .$fromTime, $oldDate ." ".$toTime ])
                ->andFilterWhere(['in', 'AgentID', $agentIDs])
                ->andFilterWhere(["!=" , 'OrderID', ""])
                ->andFilterWhere(["!=" , 'NortonSold', ""])
                ->count();
        
        $response['voiceRate']    = ($voiceRates && $call) ? (($voiceRates / $call )* 100 ) : 0;
        
        $response['erRate']    = ($voiceRates && $call) ? (($erRates / $call )* 100 ) : 0;
        
        $response['pceRate']    = ($voiceRates && $call) ? (($pceRates / $call )* 100 ) : 0;
        
        $response['nortonRate']    = ($voiceRates && $call) ? (($nortonRates / $call )* 100 ) : 0;
        
        echo json_encode($response);
    }
    
    public function actionCurrentcloserate(){
        
        $call_center = Yii::$app->request->post('call_center');
        
        $response = array(); 
        
        $response['currentCloseRate']    = rand(10,100);
        
        echo json_encode($response);
    }
    
    public function actionCloserates(){
        
        $callCenter = Yii::$app->request->post('call_center');
        
        $response = array(); 
        
        
        if($callCenter == "all" || empty($callCenter)){
            $callCenter = '6,19,11,25,10';
        }
        
        $callCenterArray = explode(",",$callCenter);
        
        $fromTime = "8:00:00";
        $toTime = date("H:i:s");
        
        $callDate = date("Y-m-d");
        
        $agentIDs = Agent::find()
                ->select("AgentID")
                ->where(['in', 'ParentTenantID', $callCenterArray])
                ->andFilterWhere(['Active' => 1])
                ->asArray();
        
        $call = CallData::find()
                ->select("RowID")
                ->where(['between','CreateDate', $callDate ." " . $fromTime,$callDate . " " .$toTime ])
                ->andFilterWhere(['in', 'AgentID', $agentIDs])
                ->andFilterWhere(["!=" , 'OrderID', ""])
                ->count();        
       
        $oldDate = date("Y-m-d" ,strtotime('-1 week',time()));
         
        $tvCalls = CallData::find()
                ->select("RowID")
                ->where(['between','CreateDate', $callDate ." " .$fromTime, $callDate ." ".$toTime ])
                ->andFilterWhere(['in', 'AgentID', $agentIDs])
                ->andFilterWhere(["!=" , 'OrderID', ""])
                ->andFilterWhere(['MediaType'=>'Broadcast'])
                ->count();
        
        $tvRate = ($call && $tvCalls) ? (($tvCalls / $call) *100) : 0;        
        $tvCloseRate = number_format((float) ($tvRate), 2, '.',',');
        $tvweekCloseRate =  number_format((float) ($tvRate), 2, '.',',');
        
        $dmCalls = CallData::find()
                ->select("RowID")
                ->where(['between','CreateDate', $callDate ." " .$fromTime, $callDate ." ".$toTime ])
                ->andFilterWhere(['in', 'AgentID', $agentIDs])
                ->andFilterWhere(["!=" , 'OrderID', ""])
                ->andFilterWhere(['MediaType'=>'Campaigns'])
                ->count();
        
        $dmRate = ($call && $dmCalls) ? (($dmCalls / $call) *100) : 0;
        $dmCloseRate = number_format((float) ($dmRate), 2, '.',',');
        $dmWeekCloseRate =  number_format((float) ($dmRate), 2, '.',',');
        
        $webCalls = CallData::find()
                ->select("RowID")
                ->where(['between','CreateDate', $callDate ." " .$fromTime, $callDate ." ".$toTime ])
                ->andFilterWhere(['in', 'AgentID', $agentIDs])
                ->andFilterWhere(["!=" , 'OrderID', ""])
                ->andFilterWhere(['MediaType'=>'Web'])
                ->count();
        
        $webRate = ($call && $webCalls) ? (($webCalls / $call) *100) : 0;
        $webCloseRate = number_format((float) ($webRate), 2, '.',',');
        $webWeekCloseRate =  number_format((float) ($webRate), 2, '.',',');
        
        
        $transferCalls = CallData::find()
                ->select("RowID")
                ->where(['between','CreateDate', $callDate ." " .$fromTime, $callDate ." ".$toTime ])
                ->andFilterWhere(['in', 'AgentID', $agentIDs])
                ->andFilterWhere(["!=" , 'OrderID', ""])
                ->andFilterWhere(['MediaType'=>'Web'])
                ->count();
        
        $transferRate = ($call && $transferCalls) ? (($transferCalls / $call) *100) : 0;
        $transferCloseRate = number_format((float) ($transferRate), 2, '.',',');
        $transferWeekCloseRate =  number_format((float) ($transferRate), 2, '.',',');        
        
        
        $response['tvCloseRate']            = $tvCloseRate;
        $response['tvCloseWeekRate']        = $tvweekCloseRate;
        $response['tvColorText']            = ($tvweekCloseRate < 0 ) ? "color-red" : "color-green";
        $response['tvArrowType']            = ($tvweekCloseRate < 0 ) ? "arrow-down" : "arrow-up";
        
        $response['dmCloseRate']            = $dmCloseRate;
        $response['dmCloseWeekRate']        = $dmWeekCloseRate;
        $response['dmColorText']            = ($dmWeekCloseRate < 0 ) ? "color-red" : "color-green";
        $response['dmArrowType']            = ($dmWeekCloseRate < 0 ) ? "arrow-down" : "arrow-up";
        
        $response['webCloseRate']           = $webCloseRate;
        $response['webCloseWeekRate']       = $webWeekCloseRate;
        $response['webColorText']           = ($webWeekCloseRate < 0 ) ? "color-red" : "color-green";
        $response['webArrowType']           = ($webWeekCloseRate < 0 ) ? "arrow-down" : "arrow-up";
        
        $response['transferCloseRate']      = $transferCloseRate;
        $response['transferCloseWeekRate']  = $transferWeekCloseRate;
        $response['transferColorText']      = ($transferWeekCloseRate < 0 ) ? "color-red" : "color-green";
        $response['transferArrowType']      = ($transferWeekCloseRate < 0 ) ? "arrow-down" : "arrow-up";
        
        echo json_encode($response);
    }
    
    
}
