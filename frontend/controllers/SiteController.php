<?php

namespace frontend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use common\models\LoginForm;
use common\models\ContactForm;
use common\models\User;
use common\models\UploadForm;
use common\models\uploadImage;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;
use yii\helpers\Json;
use yii\helpers\Url;

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
    	/*$model = new User();

    	$profile = User::find()
           ->select('profile_pic')
          	->where(['id' => Yii::$app->user->id])
           ->one();*/
           //print_r($profile['profile_pic']);  exit;

        return $this->render('index'/*, [
            'model' => $model, 'profile' => $profile['profile_pic']
        ]*/);
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
            $userid = \Yii::$app->user->identity->id;

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

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
//    public function actionContact()
//    {
//        $model = new ContactForm();
//        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
//            Yii::$app->session->setFlash('contactFormSubmitted');
//
//            return $this->refresh();
//        }
//        return $this->render('contact', [
//            'model' => $model,
//        ]);
//    }

    /**
     * Displays about page.
     *
     * @return string
     */
//    public function actionAbout()
//    {
//        return $this->render('about');
//    }
}
