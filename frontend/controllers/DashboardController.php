<?php

namespace frontend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use common\models\User;
use common\models\Trophyimages;
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

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
      $this->checkUser();

      $model = new User();
      
      $trophy = new Trophyimages();

      $skillType = "Business";

      $profile = User::find()
            ->select('profile_pic')
            ->where(['id' => Yii::$app->user->id])
            ->one();

      return $this->render('business', [
          'model'               => $model,
          'profile'             => $profile['profile_pic'] ,
          'skillType'           => $skillType,
          'trophy'              => $trophy,
      ]);
    }

    public function actionConsumer()
    {

        $this->checkUser();

        $model = new User();
        
        $trophy = Trophyimages::find()->all();
        
        $skillType = "Consumer";

        $profile = User::find()
            ->select('profile_pic')
            ->where(['id' => Yii::$app->user->id])
            ->one();

        return $this->render('consumer', [
            'model'               => $model,
            'profile'             => $profile['profile_pic'] ,
            'skillType'           => $skillType,
            'trophy'              => $trophy,
        ]);
    }

    public function actionBusiness(){

      $this->checkUser();

      $model = new User();

      $skillType = "Business";

      $profile = User::find()
           ->select('profile_pic')
            ->where(['id' => Yii::$app->user->id])
           ->one();

      return $this->render('business', [
          'model'               => $model,
          'profile'             => $profile['profile_pic'] ,
          'skillType'           => $skillType,          
      ]);
    }

    public function actionDealer(){

      $this->checkUser();

      $model = new User();

      $skillType = "Dealer SalesOnCall";

      $profile = User::find()
           ->select('profile_pic')
            ->where(['id' => Yii::$app->user->id])
           ->one();

      return $this->render('dealer', [
          'model'               => $model,
          'profile'             => $profile['profile_pic'] ,
          'skillType'           => $skillType,
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
