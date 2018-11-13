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
        if (Yii::$app->user->isGuest) {
           return $this->render('index');
        }else{
            if( Yii::$app->user->can('admin') ){
                return $this->render('dashboard');
            }
            else{
                return $this->render('index');  
            }
        }
        
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
    
    public function getTenantIds($callCenter){
        
        if($callCenter == "all" || empty($callCenter)){
            $callCenter = '6,19,11,25,10';
        }
        
        $callCenterArray = explode(",",$callCenter);
        
        $agentIDs = Agent::find()
                ->select("AgentID")
                ->where(['in', 'ParentTenantID', $callCenterArray])
                ->andWhere(['Active' => 1])
                ->asArray();
        
        return $agentIDs;
    }
    
    public function getCallDate(){
        return $callDate = date("Y-m-d");
    }
    
    public function getFromTime(){
        return $fromTime = "8:00:00";
    }
    
    public function getToTime(){
        return $toTime = date("H:i:s");
    }
    
    public function getOldDate(){
       return $oldDate = date("Y-m-d" ,strtotime('-1 week',time()));
    }
    
    
    public function actionTotalcallcount(){
        
        $callCenter = Yii::$app->request->post('call_center');
                
        $response = array();
        
        $agentIDs = $this->getTenantIds($callCenter);
        
        $callDate = $this->getCallDate();
        $fromTime = $this->getFromTime();
        $toTime = $this->getToTime();        
        $oldDate = $this->getOldDate();
        
        $call = CallData::find()
                ->select("RowID")
                ->where(['between','CreateDate', $callDate ." " . $fromTime,$callDate . " " .$toTime ])
                ->andWhere(['in', 'AgentID', $agentIDs])
                ->count();        
        
        $lastWeekcall = CallData::find()
                ->select("RowID")
                ->where(['between','CreateDate', $oldDate ." " .$fromTime, $oldDate ." ".$toTime ])
                ->andWhere(['in', 'AgentID', $agentIDs])
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
        
        $agentIDs = $this->getTenantIds($callCenter);
        
        $callDate = $this->getCallDate();
        $fromTime = $this->getFromTime();
        $toTime = $this->getToTime();        
        $oldDate = $this->getOldDate();      
        
        $call = CallData::find()
                ->select("RowID")
                ->where(['between','CreateDate', $callDate ." " . $fromTime,$callDate . " " .$toTime ])
                ->andWhere(['in', 'AgentID', $agentIDs])
                ->andWhere(["!=" , 'OrderID', ""])
                ->count();        
        
        $lastWeekcall = CallData::find()
                ->select("RowID")
                ->where(['between','CreateDate', $oldDate ." " .$fromTime, $oldDate ." ".$toTime ])
                ->andWhere(['in', 'AgentID', $agentIDs])
                ->andWhere(["!=" , 'OrderID', ""])
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
        
        $sTime = $this->getFromTime();
        $eTime = $this->getToTime();
        $callDate = $this->getCallDate();
       
        $sDate = $callDate . " " . $sTime;
        $eDate = $callDate . " " . $eTime;
        $fDNIS = " and (DNIS is null or DNIS in (select inContactTFN from tfnMedia where mediaType in ('Other','Broadcast','Campaigns','Web','Callback','Directories','Digital','Broadcast2','Direct Mail','Web Managed')))";
        
        $qstr = "select DNIS,
        sum(offered) as offered,
        sum(answered) as answered 
        from (
                (SELECT DNIS, 
                sum(if(LastState=19 or LastState=16 or (LastState=17 and Transfer!=1),1,0)) as offered,
                sum(if(LastState=19,1,0)) as answered 
                from billing_summaries 
                where CallType='call' 
                and Start BETWEEN UNIX_TIMESTAMP('" . $sDate . "') AND UNIX_TIMESTAMP('" . $eDate . "') 
                group by DNIS 
                order by DNIS) 
                union 
                (SELECT DNIS,
                count(ContactID) as offered,
                sum(if(LastState=19,1,0)) as answered 
                from billing_summaries2 
                where CallType='call' 
                and Start BETWEEN UNIX_TIMESTAMP('" . $sDate . "') AND UNIX_TIMESTAMP('" . $eDate . "') 
                group by DNIS 
                order by DNIS))
                t where 1=1 " . $fDNIS . " 
                group by DNIS 
                order by DNIS";
        
        $command = Yii::$app->db->createCommand($qstr);

        $result = $command->queryAll();
       
        $offered = 0;
        $answered = 0;
        
        foreach($result as $key)
        {
            $offered += $key['offered'];
            $answered += $key['answered'];
        }
        
        $rate = ($answered && $offered) ? 100 * ($answered)/($offered) : 0;
        
        $response = array();
        
        $response['answerRate']    = number_format((float) ($rate), 2, '.',',');
        
        echo json_encode($response);
    }
    
    public function actionAttachementrate(){
        
        $callCenter = Yii::$app->request->post('call_center');
        
        $response = array();
        
        $callDate = $this->getCallDate();
        $fromTime = $this->getFromTime();
        $toTime = $this->getToTime();        
        
        $agentIDs = $this->getTenantIds($callCenter);
        
        $call = CallData::find()
                ->select("RowID")
                ->where(['between','CreateDate', $callDate ." " . $fromTime,$callDate . " " .$toTime ])
                ->andWhere(['in', 'AgentID', $agentIDs])
                ->count();        
       
        $voiceRates = CallData::find()
                ->select("RowID")
                ->where(["!=" , 'OrderID', ""])
                ->andWhere(["!=" , 'VoIPSold', ""])
                ->andWhere(['between','CreateDate', $callDate ." " .$fromTime, $callDate ." ".$toTime ])
                ->andWhere(['in', 'AgentID', $agentIDs])
                ->count();
        
        $erRates = CallData::find()
                ->select("RowID")
                ->where(['between','CreateDate', $callDate ." " .$fromTime, $callDate ." ".$toTime ])
                ->andWhere(['in', 'AgentID', $agentIDs])
                ->andWhere(["!=" , 'OrderID', ""])
                ->andWhere(["!=" , 'ExpRepairSold', ""])
                ->count();
        
        $pceRates = CallData::find()
                ->select("RowID")
                ->where(['between','CreateDate', $callDate ." " .$fromTime, $callDate ." ".$toTime ])
                ->andWhere(['in', 'AgentID', $agentIDs])
                ->andWhere(["!=" , 'OrderID', ""])
                ->andWhere(["!=" , 'PCESold', ""])
                ->count();
        
        $nortonRates = CallData::find()
                ->select("RowID")
                ->where(['between','CreateDate', $callDate ." " .$fromTime, $callDate ." ".$toTime ])
                ->andWhere(['in', 'AgentID', $agentIDs])
                ->andWhere(["!=" , 'OrderID', ""])
                ->andWhere(["!=" , 'NortonSold', ""])
                ->count();
        
        $response['voiceRate']    = ($voiceRates && $call) ? (number_format((float) (($voiceRates / $call )* 100), 2, '.',',')) : 0;
        
        $response['erRate']    = ($erRates && $call) ? (number_format((float) (($erRates / $call )* 100), 2, '.',',')) : 0;
        
        $response['pceRate']    = ($pceRates && $call) ? (number_format((float) (($pceRates / $call )* 100), 2, '.',',') ) : 0;
        
        $response['nortonRate']    = ($nortonRates && $call) ? (number_format((float) (($nortonRates / $call )* 100), 2, '.',',') ) : 0;
        
        echo json_encode($response);
    }
    
    public function actionCurrentcloserate(){
        
        $callCenter = Yii::$app->request->post('call_center');
        
        $response = array();
        
        $callDate = $this->getCallDate();
        $fromTime = $this->getFromTime();
        $toTime = $this->getToTime();        
        
        $agentIDs = $this->getTenantIds($callCenter);
        
        $toalCall = CallData::find()
                ->select("RowID")
                ->where(['between','CreateDate', $callDate ." " . $fromTime,$callDate . " " .$toTime ])
                ->andWhere(['in', 'AgentID', $agentIDs])
                ->count(); 
        
        $answeredCall = CallData::find()
                ->select("RowID")
                ->where(['between','CreateDate', $callDate ." " . $fromTime,$callDate . " " .$toTime ])
                ->andWhere(['in', 'AgentID', $agentIDs])
                ->andWhere(["!=" , 'OrderID', ""])
                ->count();
        
        $rate = ( $answeredCall && $toalCall) ? ( ($answeredCall / $toalCall) * 100) : 0;
        
        $response['currentCloseRate'] = number_format((float) ($rate), 2, '.',',') . "%";
        
        echo json_encode($response);
    }
    
    public function actionCloserates(){
        
        $callCenter = Yii::$app->request->post('call_center');        
        $response = array(); 
        
        $callDate = $this->getCallDate();
        $fromTime = $this->getFromTime();
        $toTime = $this->getToTime();        
        $oldDate = $this->getOldDate();
        
        $agentIDs = $this->getTenantIds($callCenter);
        
        $call = CallData::find()
                ->select("RowID")
                ->where(['between','CreateDate', $callDate ." " . $fromTime,$callDate . " " .$toTime ])
                ->andWhere(['in', 'AgentID', $agentIDs])
                ->andWhere(["!=" , 'OrderID', ""])
                ->count();        
       
        $tvCalls = CallData::find()
                ->select("RowID")
                ->where(['between','CreateDate', $callDate ." " .$fromTime, $callDate ." ".$toTime ])
                ->andWhere(['in', 'AgentID', $agentIDs])
                ->andWhere(["!=" , 'OrderID', ""])
                ->andWhere(['MediaType'=>'Broadcast'])
                ->count();
        
        $tvRate = ($call && $tvCalls) ? (($tvCalls / $call) *100) : 0;        
        $tvCloseRate = number_format((float) ($tvRate), 2, '.',',');
        
        $tvWeekCalls = CallData::find()
                ->select("RowID")
                ->where(['between','CreateDate', $oldDate ." " .$fromTime, $oldDate ." ".$toTime ])
                ->andWhere(['in', 'AgentID', $agentIDs])
                ->andWhere(["!=" , 'OrderID', ""])
                ->andWhere(['MediaType'=>'Broadcast'])
                ->count();
        
        $tvWeekRate = ($tvCalls && $tvWeekCalls) ? (( ($tvCalls - $tvWeekCalls) / $tvWeekCalls) *100) : 0;  
        $tvweekCloseRate =  number_format((float) ($tvWeekRate), 2, '.',',');
        
        $dmCalls = CallData::find()
                ->select("RowID")
                ->where(['between','CreateDate', $callDate ." " .$fromTime, $callDate ." ".$toTime ])
                ->andWhere(['in', 'AgentID', $agentIDs])
                ->andWhere(["!=" , 'OrderID', ""])
                ->andWhere(['MediaType'=>'Campaigns'])
                ->count();
        
        $dmRate = ($call && $dmCalls) ? (($dmCalls / $call) *100) : 0;
        $dmCloseRate = number_format((float) ($dmRate), 2, '.',',');
        
        $dmWeekCalls = CallData::find()
                ->select("RowID")
                ->where(['between','CreateDate', $oldDate ." " .$fromTime, $oldDate ." ".$toTime ])
                ->andWhere(['in', 'AgentID', $agentIDs])
                ->andWhere(["!=" , 'OrderID', ""])
                ->andWhere(['MediaType'=>'Campaigns'])
                ->count();
        
        $dmWeekRate = ($dmCalls && $dmWeekCalls) ? (( ($dmCalls - $dmWeekCalls) / $dmWeekCalls) *100) : 0;  
        $dmWeekCloseRate =  number_format((float) ($dmWeekRate), 2, '.',',');
        
        $webCalls = CallData::find()
                ->select("RowID")
                ->where(['between','CreateDate', $callDate ." " .$fromTime, $callDate ." ".$toTime ])
                ->andWhere(['in', 'AgentID', $agentIDs])
                ->andWhere(["!=" , 'OrderID', ""])
                ->andWhere(['MediaType'=>'Web'])
                ->count();
        
        $webRate = ($call && $webCalls) ? (($webCalls / $call) *100) : 0;
        $webCloseRate = number_format((float) ($webRate), 2, '.',',');
        
        $webWeekCalls = CallData::find()
                ->select("RowID")
                ->where(['between','CreateDate', $oldDate ." " .$fromTime, $oldDate ." ".$toTime ])
                ->andWhere(['in', 'AgentID', $agentIDs])
                ->andWhere(["!=" , 'OrderID', ""])
                ->andWhere(['MediaType'=>'Web'])
                ->count();
        
        $webWeekRate = ($webCalls && $webWeekCalls) ? (( ($webCalls - $webWeekCalls) / $webWeekCalls) *100) : 0;  
        $webWeekCloseRate =  number_format((float) ($webWeekRate), 2, '.',',');
        
        $transferArray = array(
                    "Transfer to Business",
                    "Transfer to Government",
                    "Transfer to Enterprise",
                    "Transfer to Consumer",
                    "Transfer To Another Business Agent"
                );
        
        $transferCalls = CallData::find()
                ->select("RowID")
                ->where(['between','CreateDate', $callDate ." " .$fromTime, $callDate ." ".$toTime ])
                ->andWhere(['in', 'AgentID', $agentIDs])
                ->andWhere(["!=" , 'OrderID', ""])
                ->andWhere(['in','DispositionCode',$transferArray])
                ->count();
        
        $transferRate = ($call && $transferCalls) ? (($transferCalls / $call) *100) : 0;
        $transferCloseRate = number_format((float) ($transferRate), 2, '.',',');
        
         $transferWeekCalls = CallData::find()
                ->select("RowID")
                ->where(['between','CreateDate', $oldDate ." " .$fromTime, $oldDate ." ".$toTime ])
                ->andWhere(['in', 'AgentID', $agentIDs])
                ->andWhere(["!=" , 'OrderID', ""])
                ->andWhere(['in','DispositionCode',$transferArray])
                ->count();
        
        $transferWeekRate = ($transferCalls && $transferWeekCalls) ? (( ($transferCalls - $transferWeekCalls) / $transferWeekCalls) *100) : 0;  
        $transferWeekCloseRate =  number_format((float) ($webWeekRate), 2, '.',',');
        
        
        $response['tvCloseRate']            = $tvCloseRate . "%";
        $response['tvActualRate']           = $tvWeekRate;
        $response['tvCloseWeekRate']        = $tvweekCloseRate . "%";
        $response['tvArrowType']            = ($tvweekCloseRate < 0 ) ? "arrow-down" : "arrow-up";
        
        $response['dmCloseRate']            = $dmCloseRate . "%";
        $response['dmActualRate']           = $dmWeekRate ;
        $response['dmCloseWeekRate']        = $dmWeekCloseRate . "%";
        $response['dmArrowType']            = ($dmWeekCloseRate < 0 ) ? "arrow-down" : "arrow-up";
        
        $response['webCloseRate']           = $webCloseRate . "%";
        $response['webActualRate']          = $webWeekRate;
        $response['webCloseWeekRate']       = $webWeekCloseRate . "%";
        $response['webArrowType']           = ($webWeekCloseRate < 0 ) ? "arrow-down" : "arrow-up";
        
        $response['transferCloseRate']      = $transferCloseRate . "%";
        $response['transferActualRate']     = $transferWeekRate;
        $response['transferCloseWeekRate']  = $transferWeekCloseRate . "%";
        $response['transferArrowType']      = ($transferWeekCloseRate < 0 ) ? "arrow-down" : "arrow-up";
        
        echo json_encode($response);
    }
    
    
}
