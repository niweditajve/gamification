<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ColorsController implements the CRUD actions for Colors model.
 */
class ReportController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

   public function actionAgents(){
       
       return $this->render('agentsreport', [
          
      ]);
   }
   
   public function actionCertificates(){
      
        return $this->render('certificatesreport', [
          
      ]);
   }
   
   public function actionCert(){
       
       return $this->render('certreport', [
          
      ]);
   }
}
