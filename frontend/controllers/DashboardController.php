<?php

namespace frontend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use common\models\User;
use common\models\UploadForm;
use common\models\uploadImage;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;
use yii\helpers\Json;
use yii\helpers\Url;

class DashboardController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
    	$model = new User();

    	$profile = User::find()
           ->select('profile_pic')
          	->where(['id' => Yii::$app->user->id])
           ->one();

        //$this->TodaysCloseRate();
       // Yii::$app->agentcomponent->welcome(); exit;

        return $this->render('dashboard', [
            'model' => $model, 'profile' => $profile['profile_pic']
        ]);
    }
}
