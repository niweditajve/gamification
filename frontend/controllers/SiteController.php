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
use common\models\Tenant;
use common\models\TfnMedia;

class SiteController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
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
    public function actions() {
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
    public function actionIndex() {
        if (Yii::$app->user->isGuest) {
            return $this->render('index');
        } else {


            $tenant = $this->getTenant();

            if (Yii::$app->user->can('admin_cc') && (count($tenant) > 0)) {
                return $this->render('dashboard', ['tenant' => $tenant]);
            } else {
                return $this->render('index');
            }
        }
    }
    
    public function actionConsumer(){
        
         if (Yii::$app->user->isGuest) {
            return $this->render('index');
        } else {
            
            $tenant = $this->getTenant();

            if (Yii::$app->user->can('admin_cc') && (count($tenant) > 0)) {
                
                return $this->render('consumerDashboard', ['tenant' => $tenant, 'type' => "consumer"]);
                
            } else {
                
                return $this->render('index');
                
            }
            
        }
        
    }
    
    public function actionBusiness(){
        
         if (Yii::$app->user->isGuest) {
            return $this->render('index');
        } else {
            
            $tenant = $this->getTenant();

            if (Yii::$app->user->can('admin_cc') && (count($tenant) > 0)) {
                
                return $this->render('consumerDashboard', ['tenant' => $tenant, 'type' => "business"]);
                
            } else {
                
                return $this->render('index');
                
            }
            
        }
        
    }
    
    public function actionDealer(){
        
         if (Yii::$app->user->isGuest) {
            return $this->render('index');
        } else {
            
            $tenant = $this->getTenant();

            if (Yii::$app->user->can('admin_cc') && (count($tenant) > 0)) {
                
                return $this->render('consumerDashboard', ['tenant' => $tenant, 'type' => "dealer"]);
                
            } else {
                
                return $this->render('index');
                
            }
            
        }
        
    }

    public function getTenant() {

        $userId = Yii::$app->user->id;

        $result = FrontendCallcenterDefine::find()
                        ->select('tenant_id,user_id')
                        ->asArray()->all();

        $return = array();

        foreach ($result as $key) {

            $users = json_decode($key['user_id']);

            if (in_array($userId, $users)) {
                $tenant = Tenant::find()
                        ->select('TenantLabel')
                        ->where(['TenantID' => $key['tenant_id']])
                        ->one();

                $data['TenantLabel'] = $tenant['TenantLabel'];
                $data['TenantID'] = $key['tenant_id'];
                $return[] = $data;
            }
        }


        return $return;
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin() {
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
    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionUpload() {
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

                $path = Url::base(true) . '/images/user/' . DIRECTORY_SEPARATOR . $fileName;

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

    public function getCallDate() {
        return $callDate = date("Y-m-d");
    }

    public function getFromTime() {
        return $fromTime = "8:00:00";
    }

    public function getToTime() {
        return $toTime = date("H:i:s");
    }

    public function getOldDate() {
        return $oldDate = date("Y-m-d", strtotime('-1 week', time()));
    }
    
    public function getMediaCondition($media){
        
        $mediaArray = array();
        
        if($media == "consumer"){

            $mediaArray = array('Other',
                'Broadcast',
                'Campaigns',
                'Web',
                'Callback',
                'Directories',
                'Digital',
                'Broadcast2',
                'Direct Mail',
                'Web Managed'
            );
        }
        
        if($media == "business"){

            $mediaArray = array('Business');
        }
        
        if($media == "dealer"){

            $mediaArray = array('Dealer');
        }
        
        
        return $mediaArray;
    }

    public function actionTotalcallcount() {
        
        $media = Yii::$app->request->post('media');
        
        $mediaCondition = $this->getMediaCondition($media);
        
        $response = array();

        $fromTime = $this->getFromTime();
        $toTime = $this->getToTime();
        $callDate = $this->getCallDate();
        $oldDate = $this->getOldDate();

        $agentIDs = $this->getTenantIds();

        $call = CallData::find()
                ->select("RowID")
                ->where(['between', 'CreateDate', $callDate . " " . $fromTime, $callDate . " " . $toTime])
                ->andWhere(['in', 'AgentID', $agentIDs])
                ->andWhere(['in' , 'mediaType' , $mediaCondition])
                ->count();

        $lastWeekcall = CallData::find()
                ->select("RowID")
                ->where(['between', 'CreateDate', $oldDate . " " . $fromTime, $oldDate . " " . $toTime])
                ->andWhere(['in', 'AgentID', $agentIDs])
                ->andWhere(['in' , 'mediaType' , $mediaCondition])
                ->count();

        $todaysCount = $call;

        $lastWeekCount = $lastWeekcall;

        $callRate = ($call && $lastWeekcall) ? (($todaysCount - $lastWeekCount) / $lastWeekCount) * 100 : 0;

        $response['todaysCount'] = $todaysCount;

        $response['lastWeekCount'] = $lastWeekCount;

        $response['callsRate'] = number_format((float) (abs($callRate)), 2, '.', ',') . "%";

        $response['callsActualRate'] = $callRate;

        $response['arrowType'] = ( $callRate < 0 ) ? "arrow-down" : "arrow-up";

        echo json_encode($response);
    }

    public function actionTotalorderscount() {

        $response = array();

        $fromTime = $this->getFromTime();
        $toTime = $this->getToTime();
        $callDate = $this->getCallDate();
        $oldDate = $this->getOldDate();

        $agentIDs = $this->getTenantIds();
        
        $media = Yii::$app->request->post('media');
        $mediaCondition = $this->getMediaCondition($media);

        $call = CallData::find()
                ->select("RowID")
                ->where(['between', 'CreateDate', $callDate . " " . $fromTime, $callDate . " " . $toTime])
                ->andWhere(['in', 'AgentID', $agentIDs])
                ->andWhere(["!=", 'OrderID', ""])
                ->andWhere(['in' , 'mediaType' , $mediaCondition])
                ->count();

        $lastWeekcall = CallData::find()
                ->select("RowID")
                ->where(['between', 'CreateDate', $oldDate . " " . $fromTime, $oldDate . " " . $toTime])
                ->andWhere(['in', 'AgentID', $agentIDs])
                ->andWhere(["!=", 'OrderID', ""])
                ->andWhere(['in' , 'mediaType' , $mediaCondition])
                ->count();

        $todaysCount = $call;

        $lastWeekCount = $lastWeekcall;

        $callRate = ($todaysCount && $lastWeekCount) ? (($todaysCount - $lastWeekCount) / $lastWeekCount) * 100 : 0;

        $response['todaysCount'] = $todaysCount;

        $response['lastWeekCount'] = $lastWeekCount;

        $response['ordersActualRate'] = $callRate;

        $response['callsRate'] = number_format((float) (abs($callRate)), 2, '.', ',') . "%";

        $response['arrowType'] = ( $callRate < 0 ) ? "arrow-down" : "arrow-up";

        $response['textColor'] = ( $callRate < 0 ) ? "color-red" : "color-green";

        echo json_encode($response);
    }

    public function actionAnswerrate() {

        $sTime = $this->getFromTime();
        $eTime = $this->getToTime();
        $callDate = $this->getCallDate();
        
        $media = Yii::$app->request->post('media');
        
        $sDate = $callDate . " " . $sTime;
        $eDate = $callDate . " " . $eTime;
        
        if($media == "consumer" || $media == "dealer"){
            $fDNIS = " and (DNIS is null or DNIS in (select inContactTFN from tfnMedia where mediaType in ('Other','Broadcast','Campaigns','Web','Callback','Directories','Digital','Broadcast2','Direct Mail','Web Managed')))";

            $qstr = "select DNIS,
            sum(offered) as offered,
            sum(answered) as answered,
            sum(ivr) as ivr

            from (
                (SELECT DNIS, 
                sum(if(LastState=19 or LastState=16 or (LastState=17 and Transfer!=1),1,0)) as offered,
                sum(if(LastState=19,1,0)) as answered,
                sum(if(LastState=17 and Transfer!=1,1,0)) as ivr
                from billing_summaries 
                where CallType='call' 
                and Start BETWEEN UNIX_TIMESTAMP('" . $sDate . "') AND UNIX_TIMESTAMP('" . $eDate . "') 
                group by DNIS 
                order by DNIS) 
                union 
                (SELECT DNIS,
                count(ContactID) as offered,
                sum(if(LastState=19,1,0)) as answered,
                sum(if(LastState=17 and Transfer!=1,1,0)) as ivr 
                from billing_summaries2 
                where CallType='call' 
                and Start BETWEEN UNIX_TIMESTAMP('" . $sDate . "') AND UNIX_TIMESTAMP('" . $eDate . "') 
                group by DNIS 
                order by DNIS))
                t where 1=1 " . $fDNIS . " 
                group by DNIS 
                order by DNIS";
        }
        elseif($media == "business"){
            
            $fDNIS = " and DNIS in (select inContactTFN from tfnMedia where mediaType in ('Business'))";
            $qstr = "select DNIS,sum(offered) as offered,sum(ivr) as ivr,sum(answered) as answered from
                ((SELECT DNIS, sum(if(LastState=19 or LastState=16 or (LastState=17 and Transfer!=1),1,0)) as offered, sum(if(LastState=17 and Transfer!=1,1,0)) as ivr,sum(if(LastState=19,1,0)) as answered
                from billing_summaries
                where CallType='call'
                and Start BETWEEN '" . $sDate . "' AND '" . $eDate . "'
                group by DNIS order by DNIS)
                union
                (SELECT DNIS,count(ContactID) as offered, sum(if(LastState=17 and Transfer!=1,1,0)) as ivr,
                sum(if(LastState=19,1,0)) as answered from billing_summaries2 where CallType='call' and
                Start BETWEEN '" . $sDate . "' AND '" . $eDate . "' group by DNIS order by DNIS)) t where 1=1 " 
                    . $fDNIS . " group by DNIS order by DNIS";
        }
       
        

        $command = Yii::$app->db->createCommand($qstr);

        $result = $command->queryAll();

        $offered = 0;

        $answered = 0;

        $ivr = 0;

        foreach ($result as $key) {
            $offered += $key['offered'];

            $answered += $key['answered'];

            $ivr += $key['ivr'];
        }

        $divideBy = $offered - $ivr;

        $rate = ($answered && $divideBy) ? 100 * ($answered) / ($divideBy) : 0;

        $response = array();

        $response['answerRate'] = number_format((float) ($rate), 2, '.', ',');

        echo json_encode($response);
    }

    public function actionAttachementrate() {

        $response = array();

        $fromTime = $this->getFromTime();
        $toTime = $this->getToTime();
        $callDate = $this->getCallDate();

        $agentIDs = $this->getTenantIds();
        
        $media = Yii::$app->request->post('media');
        $mediaCondition = $this->getMediaCondition($media);

        $call = CallData::find()
                ->select("RowID")
                ->where(['between', 'CreateDate', $callDate . " " . $fromTime, $callDate . " " . $toTime])
                ->andWhere(['in', 'AgentID', $agentIDs])
                ->andWhere(["!=", 'OrderID', ""])
                ->andWhere(['in' , 'mediaType' , $mediaCondition])
                ->count();

        $voiceRates = CallData::find()
                ->select("RowID")
                ->where(['between', 'CreateDate', $callDate . " " . $fromTime, $callDate . " " . $toTime])
                ->andWhere(['in', 'AgentID', $agentIDs])
                ->andWhere(["!=", 'OrderID', ""])
                ->andWhere(["!=", 'VoIPSold', ""])
                ->andWhere(['in' , 'mediaType' , $mediaCondition])
                ->count();

        $erRates = CallData::find()
                ->select("RowID")
                ->where(['between', 'CreateDate', $callDate . " " . $fromTime, $callDate . " " . $toTime])
                ->andWhere(['in', 'AgentID', $agentIDs])
                ->andWhere(["!=", 'OrderID', ""])
                ->andWhere(["!=", 'ExpRepairSold', ""])
                ->andWhere(['in' , 'mediaType' , $mediaCondition])
                ->count();

        $pceRates = CallData::find()
                ->select("RowID")
                ->where(['between', 'CreateDate', $callDate . " " . $fromTime, $callDate . " " . $toTime])
                ->andWhere(['in', 'AgentID', $agentIDs])
                ->andWhere(["!=", 'OrderID', ""])
                ->andWhere(["!=", 'PCESold', ""])
                ->andWhere(['in' , 'mediaType' , $mediaCondition])
                ->count();

        $nortonRates = CallData::find()
                ->select("RowID")
                ->where(['between', 'CreateDate', $callDate . " " . $fromTime, $callDate . " " . $toTime])
                ->andWhere(['in', 'AgentID', $agentIDs])
                ->andWhere(["!=", 'OrderID', ""])
                ->andWhere(["!=", 'NortonSold', ""])
                ->andWhere(['in' , 'mediaType' , $mediaCondition])
                ->count();

        $response['voiceRate'] = ($voiceRates && $call) ? (number_format((float) (($voiceRates / $call ) * 100), 2, '.', ',')) : 0;

        $response['erRate'] = ($erRates && $call) ? (number_format((float) (($erRates / $call ) * 100), 2, '.', ',')) : 0;

        $response['pceRate'] = ($pceRates && $call) ? (number_format((float) (($pceRates / $call ) * 100), 2, '.', ',') ) : 0;

        $response['nortonRate'] = ($nortonRates && $call) ? (number_format((float) (($nortonRates / $call ) * 100), 2, '.', ',') ) : 0;

        echo json_encode($response);
    }

    public function actionCurrentcloserate() {

        $response = array();

        $fromTime = $this->getFromTime();
        $toTime = $this->getToTime();
        $callDate = $this->getCallDate();

        $agentIDs = $this->getTenantIds();

//        $toalCall = CallData::find()
//                ->select("RowID")
//                ->where(['between', 'CreateDate', $callDate . " " . $fromTime, $callDate . " " . $toTime])
//                ->andWhere(['in', 'AgentID', $agentIDs])
//                ->count();
        $toalCall = $this->getAnswered();
        
        $media = Yii::$app->request->post('media');
        $mediaCondition = $this->getMediaCondition($media);

        $answeredCall = CallData::find()
                ->select("RowID")
                ->where(['between', 'CreateDate', $callDate . " " . $fromTime, $callDate . " " . $toTime])
                ->andWhere(['in', 'AgentID', $agentIDs])
                ->andWhere(["!=", 'OrderID', ""])
                ->andWhere(['in' , 'mediaType' , $mediaCondition])
                ->count();

        $rate = ( $answeredCall && $toalCall) ? ( ($answeredCall / $toalCall) * 100) : 0;

        $response['currentCloseRate'] = number_format((float) ($rate), 2, '.', ',') . "%";

        echo json_encode($response);
    }

    public function actionCloserates() {

        $response = array();

        $fromTime = $this->getFromTime();
        $toTime = $this->getToTime();
        $callDate = $this->getCallDate();
        $oldDate = $this->getOldDate();

        $agentIDs = $this->getTenantIds();
        
        $media = Yii::$app->request->post('media');
        $mediaCondition = $this->getMediaCondition($media);

        $call = CallData::find()
                ->select("RowID")
                ->where(['between', 'CreateDate', $callDate . " " . $fromTime, $callDate . " " . $toTime])
                ->andWhere(['in', 'AgentID', $agentIDs])
                ->andWhere(["!=", 'OrderID', ""])
                ->andWhere(['in' , 'mediaType' , $mediaCondition])
                ->count();

        $tvCalls = CallData::find()
                ->select("RowID")
                ->where(['between', 'CreateDate', $callDate . " " . $fromTime, $callDate . " " . $toTime])
                ->andWhere(['in', 'AgentID', $agentIDs])
                ->andWhere(["!=", 'OrderID', ""])
                ->andWhere(['MediaType' => 'Broadcast'])
                ->andWhere(['in' , 'mediaType' , $mediaCondition])
                ->count();

        $tvRate = ($call && $tvCalls) ? (($tvCalls / $call) * 100) : 0;
        $tvCloseRate = number_format((float) ($tvRate), 2, '.', ',');

        $tvWeekCalls = CallData::find()
                ->select("RowID")
                ->where(['between', 'CreateDate', $oldDate . " " . $fromTime, $oldDate . " " . $toTime])
                ->andWhere(['in', 'AgentID', $agentIDs])
                ->andWhere(["!=", 'OrderID', ""])
                ->andWhere(['MediaType' => 'Broadcast'])
                ->andWhere(['in' , 'mediaType' , $mediaCondition])
                ->count();

        $tvWeekRate = ($tvCalls && $tvWeekCalls) ? (( ($tvCalls - $tvWeekCalls) / $tvWeekCalls) * 100) : 0;
        $tvweekCloseRate = number_format((float) ($tvWeekRate), 2, '.', ',');

        $dmCalls = CallData::find()
                ->select("RowID")
                ->where(['between', 'CreateDate', $callDate . " " . $fromTime, $callDate . " " . $toTime])
                ->andWhere(['in', 'AgentID', $agentIDs])
                ->andWhere(["!=", 'OrderID', ""])
                ->andWhere(['MediaType' => 'Campaigns'])
                ->andWhere(['in' , 'mediaType' , $mediaCondition])
                ->count();

        $dmRate = ($call && $dmCalls) ? (($dmCalls / $call) * 100) : 0;
        $dmCloseRate = number_format((float) ($dmRate), 2, '.', ',');

        $dmWeekCalls = CallData::find()
                ->select("RowID")
                ->where(['between', 'CreateDate', $oldDate . " " . $fromTime, $oldDate . " " . $toTime])
                ->andWhere(['in', 'AgentID', $agentIDs])
                ->andWhere(["!=", 'OrderID', ""])
                ->andWhere(['MediaType' => 'Campaigns'])
                ->andWhere(['in' , 'mediaType' , $mediaCondition])
                ->count();

        $dmWeekRate = ($dmCalls && $dmWeekCalls) ? (( ($dmCalls - $dmWeekCalls) / $dmWeekCalls) * 100) : 0;
        $dmWeekCloseRate = number_format((float) ($dmWeekRate), 2, '.', ',');

        $webCalls = CallData::find()
                ->select("RowID")
                ->where(['between', 'CreateDate', $callDate . " " . $fromTime, $callDate . " " . $toTime])
                ->andWhere(['in', 'AgentID', $agentIDs])
                ->andWhere(["!=", 'OrderID', ""])
                ->andWhere(['MediaType' => 'Web'])
                ->andWhere(['in' , 'mediaType' , $mediaCondition])
                ->count();

        $webRate = ($call && $webCalls) ? (($webCalls / $call) * 100) : 0;
        $webCloseRate = number_format((float) ($webRate), 2, '.', ',');

        $webWeekCalls = CallData::find()
                ->select("RowID")
                ->where(['between', 'CreateDate', $oldDate . " " . $fromTime, $oldDate . " " . $toTime])
                ->andWhere(['in', 'AgentID', $agentIDs])
                ->andWhere(["!=", 'OrderID', ""])
                ->andWhere(['MediaType' => 'Web'])
                ->andWhere(['in' , 'mediaType' , $mediaCondition])
                ->count();

        $webWeekRate = ($webCalls && $webWeekCalls) ? (( ($webCalls - $webWeekCalls) / $webWeekCalls) * 100) : 0;
        $webWeekCloseRate = number_format((float) ($webWeekRate), 2, '.', ',');

        $transferArray = array(
            "Transfer to Business",
            "Transfer to Government",
            "Transfer to Enterprise",
            "Transfer to Consumer",
            "Transfer To Another Business Agent"
        );

        $transferCalls = CallData::find()
                ->select("RowID")
                ->where(['between', 'CreateDate', $callDate . " " . $fromTime, $callDate . " " . $toTime])
                ->andWhere(['in', 'AgentID', $agentIDs])
                ->andWhere(["!=", 'OrderID', ""])
                ->andWhere(['in', 'DispositionCode', $transferArray])
                ->andWhere(['in' , 'mediaType' , $mediaCondition])
                ->count();

        $transferRate = ($call && $transferCalls) ? (($transferCalls / $call) * 100) : 0;
        $transferCloseRate = number_format((float) ($transferRate), 2, '.', ',');

        $transferWeekCalls = CallData::find()
                ->select("RowID")
                ->where(['between', 'CreateDate', $oldDate . " " . $fromTime, $oldDate . " " . $toTime])
                ->andWhere(['in', 'AgentID', $agentIDs])
                ->andWhere(["!=", 'OrderID', ""])
                ->andWhere(['in', 'DispositionCode', $transferArray])
                ->andWhere(['in' , 'mediaType' , $mediaCondition])
                ->count();

        $transferWeekRate = ($transferCalls && $transferWeekCalls) ? (( ($transferCalls - $transferWeekCalls) / $transferWeekCalls) * 100) : 0;
        $transferWeekCloseRate = number_format((float) ($webWeekRate), 2, '.', ',');


        $response['tvCloseRate'] = $tvCloseRate . "%";
        $response['tvActualRate'] = $tvWeekRate;
        $response['tvCloseWeekRate'] = $tvweekCloseRate . "%";
        $response['tvArrowType'] = ($tvweekCloseRate < 0 ) ? "arrow-down" : "arrow-up";

        $response['dmCloseRate'] = $dmCloseRate . "%";
        $response['dmActualRate'] = $dmWeekRate;
        $response['dmCloseWeekRate'] = $dmWeekCloseRate . "%";
        $response['dmArrowType'] = ($dmWeekCloseRate < 0 ) ? "arrow-down" : "arrow-up";

        $response['webCloseRate'] = $webCloseRate . "%";
        $response['webActualRate'] = $webWeekRate;
        $response['webCloseWeekRate'] = $webWeekCloseRate . "%";
        $response['webArrowType'] = ($webWeekCloseRate < 0 ) ? "arrow-down" : "arrow-up";

        $response['transferCloseRate'] = $transferCloseRate . "%";
        $response['transferActualRate'] = $transferWeekRate;
        $response['transferCloseWeekRate'] = $transferWeekCloseRate . "%";
        $response['transferArrowType'] = ($transferWeekCloseRate < 0 ) ? "arrow-down" : "arrow-up";

        echo json_encode($response);
    }

    public function actionCentercloserate() {

        $tenant = Yii::$app->request->post('tenant');
        $allTenants = Yii::$app->request->post('allTenants');

        if ($tenant == "all"):
            $callCenters = explode(",", $allTenants);
        else:
            $callCenters = $tenant;
        endif;
        
        $media = Yii::$app->request->post('media');
        $mediaCondition = $this->getMediaCondition($media);

        $response = array();

        $fromTime = $this->getFromTime();
        $toTime = $this->getToTime();
        $callDate = $this->getCallDate();

        $agentIDs = Agent::find()
                ->select("AgentID")
                ->where(['in', 'ParentTenantID', $callCenters])
                ->andWhere(['Active' => 1])
                ->asArray();

        $toalCall = CallData::find()
                ->select("RowID")
                ->where(['between', 'CreateDate', $callDate . " " . $fromTime, $callDate . " " . $toTime])
                ->andWhere(['in', 'AgentID', $agentIDs])
                ->andWhere(['in' , 'mediaType' , $mediaCondition])
                ->count();

        $answeredCall = CallData::find()
                ->select("RowID")
                ->where(['between', 'CreateDate', $callDate . " " . $fromTime, $callDate . " " . $toTime])
                ->andWhere(['in', 'AgentID', $agentIDs])
                ->andWhere(["!=", 'OrderID', ""])
                ->andWhere(['in' , 'mediaType' , $mediaCondition])
                ->count();

        $rate = ( $answeredCall && $toalCall) ? ( ($answeredCall / $toalCall) * 100) : 0;

        $response['centerCloseRate'] = number_format((float) ($rate), 2, '.', ',') . "%";

        echo json_encode($response);
    }

    public function getTenantIds() {

        $callCenter = '6,19,11,25,10';

        $callCenterArray = explode(",", $callCenter);

        $agentIDs = Agent::find()
                ->select("AgentID")
                ->where(['in', 'ParentTenantID', $callCenterArray])
                ->andWhere(['Active' => 1])
                ->asArray();

        return $agentIDs;
    }

    public function getAnswered() {

        $sTime = $this->getFromTime();
        $eTime = $this->getToTime();
        $callDate = $this->getCallDate();

        $sDate = $callDate . " " . $sTime;
        $eDate = $callDate . " " . $eTime;
        $fDNIS = " and (DNIS is null or DNIS in (select inContactTFN from tfnMedia where mediaType in ('Other','Broadcast','Campaigns','Web','Callback','Directories','Digital','Broadcast2','Direct Mail','Web Managed')))";

        $qstr = "select DNIS,
        sum(answered) as answered
        from (
                (SELECT DNIS, 
                sum(if(LastState=19,1,0)) as answered
                from billing_summaries 
                where CallType='call' 
                and Start BETWEEN UNIX_TIMESTAMP('" . $sDate . "') AND UNIX_TIMESTAMP('" . $eDate . "') 
                group by DNIS 
                order by DNIS) 
                union 
                (SELECT DNIS,
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

        $answered = 0;

        foreach ($result as $key) {

            $answered += $key['answered'];
        }
        return $answered;
    }

}
