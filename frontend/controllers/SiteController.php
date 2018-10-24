<?php

namespace frontend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use common\models\LoginForm;
use common\models\User;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;
use yii\helpers\Json;
use yii\helpers\Url;
use common\models\CallData;
use common\models\Agent;
use common\models\FrontendCallcenterDefine;


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
    
   public function beforeAction($action) {
       
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
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
            
            $tenantId = $this->getTenantId();

            if( Yii::$app->user->can('admin_cc') &&  (count($tenantId) > 0) ){
                return $this->render('dashboard',['tenantId' => $tenantId]);
            }
            else{
                return $this->render('index');  
            }
        }
        
    }
    
    public function getTenantId(){
        
        $userId = Yii::$app->user->id;
        
        $result = FrontendCallcenterDefine::find()
                ->select('tenant_id,user_id')
                ->asArray()->all();
        
       $return = array();
       
       foreach($result as $key){
           
           $users = json_decode($key['user_id']);
          
           if(in_array($userId,$users))
           {
               $return[] =  $key['tenant_id'];
           }
       }
       
       
       return $return;
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

    public function actionUpload()
    {
        $model = new User();

	    $imageFile = UploadedFile::getInstance($model, 'profile_pic');

	    $directory = Yii::getAlias('@frontend/web/images/user') . DIRECTORY_SEPARATOR;
            
	    if (!is_dir($directory)) {
	        FileHelper::createDirectory($directory);
	    }

	    if ($imageFile) {
	        $uid = uniqid(time(), true);
	        $fileName = $uid . '.' . $imageFile->extension;
	        $filePath = $directory . $fileName;
                
	        if ($imageFile->saveAs($filePath)) {
	            
	            $path = Url::base(true)  . '/images/user/' . DIRECTORY_SEPARATOR . $fileName;

                    $user = User::findOne(Yii::$app->user->id);
                    $user->profile_pic = $fileName;
                    $user->save(false);
	            
	            return Json::encode([
	                'files' => [
	                    [
	                        'name' => $fileName,
	                        'url' => $path
	                    ],
	                ],
	            ]);
	        }
	    }

	    return '';
	    }
            
    public function getTenantIds(){
        
        $callCenter = '6,19,11,25,10';
        
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
        
        $response = array();
        
        $fromTime = $this->getFromTime();
        $toTime = $this->getToTime();
        $callDate = $this->getCallDate();
        $oldDate = $this->getOldDate();
        
        $agentIDs = $this->getTenantIds();
        
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
        
        $response = array();
        
        $fromTime = $this->getFromTime();
        $toTime = $this->getToTime();
        $callDate = $this->getCallDate();
        $oldDate = $this->getOldDate();
        
        $agentIDs = $this->getTenantIds();
        
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
        
        $callCenter = '6,19,11,25,10';
       
        $callCenterArray = explode(",",$callCenter);
        
        $response = array();
        
        $response['answerRate']    = rand(10,100);
        
        echo json_encode($response);
    }
    
    public function actionAttachementrate(){
        
        $response = array();
        
        $fromTime = $this->getFromTime();
        $toTime = $this->getToTime();
        $callDate = $this->getCallDate();
        
        $agentIDs = $this->getTenantIds();
        
        $call = CallData::find()
                ->select("RowID")
                ->where(['between','CreateDate', $callDate ." " . $fromTime,$callDate . " " .$toTime ])
                ->andWhere(['in', 'AgentID', $agentIDs])
                ->andWhere(["!=" , 'OrderID', ""])
                ->count();        
       
        $voiceRates = CallData::find()
                ->select("RowID")
                ->where(['between','CreateDate', $callDate ." " .$fromTime, $callDate ." ".$toTime ])
                ->andWhere(['in', 'AgentID', $agentIDs])
                ->andWhere(["!=" , 'OrderID', ""])
                ->andWhere(["!=" , 'VoIPSold', ""])
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
        
        $response = array(); 
        
        $fromTime = $this->getFromTime();
        $toTime = $this->getToTime();
        $callDate = $this->getCallDate();
        
        $agentIDs = $this->getTenantIds();
       
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
        
        $response['currentCloseRate']    = number_format((float) ($rate), 2, '.',',') . "%";
        
        echo json_encode($response);
    }
    
    public function actionCloserates(){
        
        $response = array(); 
        
        $fromTime = $this->getFromTime();
        $toTime = $this->getToTime();
        $callDate = $this->getCallDate();
        $oldDate = $this->getOldDate();
        
        $agentIDs = $this->getTenantIds();
        
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
    
    public function actionCentercloserate(){
        
        $tenant_id = Yii::$app->request->post('tenant_id');
        
        $response = array(); 
        
        $fromTime = $this->getFromTime();
        $toTime = $this->getToTime();
        $callDate = $this->getCallDate();
        
        $agentIDs = Agent::find()
                ->select("AgentID")
                ->where(['ParentTenantID'=> $tenant_id])
                ->andWhere(['Active' => 1])
                ->asArray();
        
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
        
        $response['centerCloseRate']    = number_format((float) ($rate), 2, '.',',') . "%";
        
        echo json_encode($response);
    }
}
