<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Agent;
use common\models\AgentSearch;
use arturoliveira\ExcelView;
use yii\data\SqlDataProvider;
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
       
        $searchModel = new AgentSearch();
        $dataProvider = $searchModel->searchActive(Yii::$app->request->queryParams);
       
       return $this->render('agentsreport', [
          'searchModel' => $searchModel,
          'dataProvider' => $dataProvider,
      ]);
   }
   
   public function actionCertificates(){
      
        $model = new Agent();
        
        $totalCount = Yii::$app->db->createCommand('SELECT COUNT(*) FROM tblAgent WHERE `Active`=1')->queryScalar();

        $sql = "SELECT `tblAgent`.`AgentID`, `tblAgent`.`FirstName`, `tblAgent`.`LastName`,`tblAgent`. `Login`, `CreateDate`,AVG(`gamification_agentpoints`.`point`) as points 
                FROM `tblAgent`
                LEFT JOIN `gamification_agentpoints` ON `tblAgent`.AgentID = `gamification_agentpoints`.agentId
                WHERE 
                tblAgent.`Active`=1 ";
     
        $request = \Yii::$app->request;
        
        $from ='';
        
        $to ='';
        
        if ($request->isPost) {
            
           $from = $request->post()['date_from'];
           
           $to = $request->post()['date_to'];
           
           $date_from = $from . " 00:00:00";
           
           $date_to = $to ." 00:00:00";
           
           if($from && $to)
                $sql .= " AND (gamification_agentpoints.created_at BETWEEN '$date_from' AND  '$date_to')";
           
        }
        /*else{
           $from = date('Y-m-d',strtotime('today - 30 days'));
           $to = date('Y-m-d',strtotime('today'));
           
           $date_from = $from . " 00:00:00";
           $date_to = $to ." 00:00:00";
           
           $sql .= " AND (gamification_agentpoints.created_at BETWEEN '$date_from' AND  '$date_to')";
        }*/
        
        $sql .=" GROUP BY `tblAgent`.`AgentID`";
        
        $dataProvider = new SqlDataProvider([
            'db' => Yii::$app->db,
            'sql' => $sql,
            'totalCount' => $totalCount,
            'sort' =>false,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        
        return $this->render('certificatesreport', [
          'dataProvider' => $dataProvider,
          'model' => $model,
          'date_to' => $to,
          'date_from' => $from,
      ]);
   }
   
   public function actionCert(){
       
       return $this->render('certreport', [
          
      ]);
   }
   
   public function actionExport() {
       
        $searchModel = new AgentSearch();

        $dataProvider = $searchModel->searchActive(Yii::$app->request->queryParams);
        
        ExcelView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'fullExportType'=> 'csv', //can change to html,xls,csv and so on
            'grid_mode' => 'export',
            'columns' => [               
                ['class' => 'yii\grid\SerialColumn'],
                        [
                            'header' => 'Name',
                            'value' => function($model) { return $model->FirstName  . " " . $model->LastName . " " . $model->Login ;},
                        ],
                        [
                            'header' => 'Last Login Date',
                            'attribute' => 'Login',
                        ],
              ],
        ]);
    }
}
