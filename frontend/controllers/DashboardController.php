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

       $this->checkUser();

    	$model = new User();

    	$profile = User::find()
           ->select('profile_pic')
          	->where(['id' => Yii::$app->user->id])
           ->one();

      $agentId = Yii::$app->agentcomponent->getAgentId();

      $todaysColseRate = Yii::$app->agentcomponent->getTodaysCloseRate($agentId);
      
      $communityCloseRate = Yii::$app->agentcomponent->getCommunityCloseRate($agentId);

      return $this->render('dashboard', [
          'model' => $model,
          'profile' => $profile['profile_pic'] ,
          'todaysColseRate' => $todaysColseRate,
          'communityCloseRate' => $communityCloseRate,
      ]);
    }

    public function checkUser(){

        $user = User::find()
           ->select('password_changed_at')
            ->where(['id' => Yii::$app->user->id])
           ->one();

       if(empty($user['password_changed_at']))
       {
            return Yii::$app->response->redirect(Url::to(['skill/change-password']));
       }
       
        return true;
       
        
    }
}
