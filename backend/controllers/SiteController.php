<?php

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use common\models\LoginForm;
use common\models\ContactForm;

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
        
        $call_center = Yii::$app->request->post('call_center');
        
        $response = array();
        
        $todaysCount = rand(100,1000);
        
        $lastWeekCount = rand(100,1000);
        
        $callRate = (($todaysCount - $lastWeekCount) / $lastWeekCount) *100;
        
        $response['todaysCount']    = $todaysCount;
        
        $response['lastWeekCount']  = $lastWeekCount;
        
        $response['callsRate']      = number_format((float) (abs($callRate)), 2, '.',',') ."%";
        
        $response['callsActualRate']= $callRate;
        
        $response['arrowType']      = ( $callRate < 0 ) ? "arrow-down" : "arrow-up" ;
        
        //$response['textColor']      = ( $callRate < 0 ) ? "color-red" : "color-green" ;
        
        echo json_encode($response);
    }
    
    public function actionTotalorderscount(){
        
        $call_center = Yii::$app->request->post('call_center');
        
        $response = array();
        
        $todaysCount = rand(100,1000);
        
        $lastWeekCount = rand(100,1000);
        
        $callRate = (($todaysCount - $lastWeekCount) / $lastWeekCount) *100;
        
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
        
        $call_center = Yii::$app->request->post('call_center');
        
        $response = array();
        
        $response['voiceRate']    = rand(10,100);
        
        $response['erRate']    = rand(10,100);
        
        $response['pceRate']    = rand(10,100);
        
        $response['nortonRate']    = rand(10,100);
        
        echo json_encode($response);
    }
    
    public function actionCurrentcloserate(){
        
        $call_center = Yii::$app->request->post('call_center');
        
        $response = array(); 
        
        $response['currentCloseRate']    = rand(10,100);
        
        echo json_encode($response);
    }
    
    public function actionCloserates(){
        
        $call_center = Yii::$app->request->post('call_center');
        
        $response = array(); 
        
        $tvweekCloseRate = number_format((float) (rand(10,100)), 2, '.',',');
        $dmweekCloseRate = number_format((float) (rand(10,100)), 2, '.',',');
        $webweekCloseRate = number_format((float) (rand(10,100)), 2, '.',',');
        $transferweekCloseRate = number_format((float) (rand(10,100)), 2, '.',',');
        
        $response['tvCloseRate']            = rand(10,100);
        $response['tvCloseWeekRate']        = $tvweekCloseRate;
        $response['tvColorText']            = ($tvweekCloseRate < 0 ) ? "color-red" : "color-green";
        $response['tvArrowType']            = ($tvweekCloseRate < 0 ) ? "arrow-down" : "arrow-up";
        
        $response['dmCloseRate']            = rand(10,100);
        $response['dmCloseWeekRate']        = $dmweekCloseRate;
        $response['dmColorText']            = ($dmweekCloseRate < 0 ) ? "color-red" : "color-green";
        $response['dmArrowType']            = ($dmweekCloseRate < 0 ) ? "arrow-down" : "arrow-up";
        
        $response['webCloseRate']           = rand(10,100);
        $response['webCloseWeekRate']       = $webweekCloseRate;
        $response['webColorText']           = ($webweekCloseRate < 0 ) ? "color-red" : "color-green";
        $response['webArrowType']           = ($webweekCloseRate < 0 ) ? "arrow-down" : "arrow-up";
        
        $response['transferCloseRate']      = rand(10,100);
        $response['transferCloseWeekRate']  = $transferweekCloseRate;
        $response['transferColorText']      = ($transferweekCloseRate < 0 ) ? "color-red" : "color-green";
        $response['transferArrowType']      = ($transferweekCloseRate < 0 ) ? "arrow-down" : "arrow-up";
        
        echo json_encode($response);
    }
    
    
}
