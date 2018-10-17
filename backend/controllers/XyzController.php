<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * XyzController implements the CRUD actions for Xyz model.
 */
class XyzController extends Controller
{
    
    public function actionIndex()
    {
        Yii::$app->cache->flush();
        
        
    }

}
