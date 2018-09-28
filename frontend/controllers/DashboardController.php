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
use common\models\Categories;

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

    public function actionConsumer()
    {
        $model = new User();
        
        $skillType = "Consumer";

        return $this->render('consumer', [
            'model'               => $model,
            'profile'             =>  $this->getProfilePic(),
            'skillType'           => $skillType,
            'category'            => $this->getCategories(),
        ]);
    }
    
    
    public function getCategories(){
        
        $categories = Categories::find()->all();
        
        $category = array();

        foreach($categories as $catKey){

            $category[$catKey['categoeryKey']] = array(
              "title"           =>   $catKey['title'],
              "redCutOff"       =>   $catKey['redCutOff'],
              "yellowCutOff"    =>   $catKey['yellowCutOff'],
            );
        }
        
        return $category;
    }
    
    
    public function getProfilePic(){
        
        $profile = User::find()
            ->select('profile_pic')
            ->where(['id' => Yii::$app->user->id])
            ->one();
        
        return $profile['profile_pic'];
    }

    public function actionBusiness(){

      $model = new User();

      $skillType = "Business";

      return $this->render('business', [
            'model'               => $model,
            'profile'             =>  $this->getProfilePic(),
            'skillType'           => $skillType,
            'category'            => $this->getCategories(),
      ]);
    }

    public function actionDealer(){

      $model = new User();

      $skillType = "Dealer SalesOnCall";

      return $this->render('dealer', [
            'model'               => $model,
            'profile'             =>  $this->getProfilePic(),
            'skillType'           => $skillType,
            'category'            => $this->getCategories(),
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
