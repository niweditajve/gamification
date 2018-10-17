<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * CallDataController implements the CRUD actions for CallData model.
 */
class TestController extends Controller {

    
    public function actionIndex() {
        
        Yii::$app->cache->flush();
        
    }

    
}
