<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
//use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Usercallcenters;
use common\models\CallcenterDefine;
use common\models\Agent;
use common\models\AgentSearch;
use arturoliveira\ExcelView;
use yii\data\SqlDataProvider;
use yii\filters\AccessControl;
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
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['certificates', 'agents', 'cert','export'],
                        'roles' => ['admin_cc'],
                    ],
                ],
            ],
        ];
    }
    
    public function getTenants(){
        //echo Yii::$app->user->id;
        $profile = CallcenterDefine::find()
            ->select('id')
            ->where(['user_id' => Yii::$app->user->id])
            ->one();

        $profile_id = $profile['id'];

        $tenants = Usercallcenters::find()
                ->select('tenant_id')
                ->where(['callcenter_define_id'=>$profile_id])
                ->all();
        
        $tenant_ids = array();
        
        foreach($tenants as $tenant_key){
            $tenant_ids[] = $tenant_key['tenant_id'];
        }
        // print_r($tenant_ids); exit;
        return $tenant_ids;
    }

   public function actionAgents(){
       
       if(count($this->getTenants()) <=0):
           $sql= 'SELECT `tblAgent`.`FirstName` FROM `tblAgent` WHERE `tblAgent`.Active = 1 AND `tblAgent`.Active = 0';
       else:
           $sql = "SELECT `tblAgent`.`FirstName`, `tblAgent`.`LastName`,`tblAgent`. `Login` ,
                (SELECT hit_time FROM gamification_agentlastlogin WHERE agent_id = `tblAgent`.`AgentID` ORDER BY id DESC LIMIT 1) as lastlogin
                FROM `tblAgent` 
                WHERE `tblAgent`.Active = 1 AND ParentTenantID IN (". implode(",", $this->getTenants() ) .")
                "; 
       endif;
      
        
        $connection=Yii::$app->db;
        
        $command=$connection->createCommand($sql);
        
        $rowCount=$command->execute();
        
        $dataProvider = new SqlDataProvider([
            'db' => Yii::$app->db,
            'sql' => $sql,
            'totalCount' => $rowCount,
        ]);
       
        return $this->render('agentsreport', [
           'dataProvider' => $dataProvider,
       ]);
   }
   
   public function actionCertificates(){
      
        $model = new Agent();
     
        $request = \Yii::$app->request;
        
        $from ='';
        
        $to ='';
        
        $postsql = '';
        
        $postcertificate = '';
        
        if ($request->isPost) {
            
            if(isset($request->post()['export_type']) && $request->post()['export_type'] == "Csv" ){
                
            }else{
                
                if(isset($request->post()['date_from']) && $request->post()['date_to']){
                    
                    $from = $request->post()['date_from'];
           
                    $to = $request->post()['date_to'];

                    $date_from = date("Y-m-d", strtotime($from)) . " 00:00:00";

                    $date_to = date("Y-m-d", strtotime($to)) ." 00:00:00";

                    if($from && $to){
                        $postsql = " AND (gamification_agentpoints.created_at BETWEEN '$date_from' AND  '$date_to')";

                        $postcertificate = " AND (gamification_agentcertificates.created_at BETWEEN '$date_from' AND '$date_to' )";

                    }
                    
                }
                
           }
           
        }
       
        
        $sql = "SELECT `tblAgent`.`AgentID`, `tblAgent`.`FirstName`, `tblAgent`.`LastName`,`tblAgent`. `Login`, `CreateDate`,sum(`gamification_agentpoints`.`point`) as points ,
                (SELECT count(gamification_agentcertificates.id) FROM gamification_agentcertificates WHERE gamification_agentcertificates.agent_id = `tblAgent`.`AgentID` ". $postcertificate .") as certificates,
                (SELECT CreateDate FROM callData WHERE agentID = `tblAgent`.`AgentID` ORDER BY rowid DESC LIMIT 1) as lastlogin
                FROM `tblAgent`
                LEFT JOIN `gamification_agentpoints` ON `tblAgent`.AgentID = `gamification_agentpoints`.agentId
                WHERE 
                tblAgent.`Active`=1 " . $postsql ." AND ParentTenantID IN (". implode(",", $this->getTenants() ) .") ";
        
        $sql .=" GROUP BY `tblAgent`.`AgentID`";
        
        if(count($this->getTenants()) <=0):
           $query = 'SELECT `tblAgent`.`FirstName` FROM `tblAgent` WHERE `tblAgent`.Active = 1 AND `tblAgent`.Active = 0';
        else:
            $query = $sql;
        endif;
        
        $connection=Yii::$app->db;
        
        $command=$connection->createCommand($query);
        
        $rowCount=$command->execute();
        
        $dataProvider = new SqlDataProvider([
            'db' => Yii::$app->db,
            'sql' => $query,
            'totalCount' => $rowCount,
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
       
        $model = new Agent();
        
        $previous_week = strtotime("-1 week +1 day");

        $start_week = strtotime("last sunday midnight",$previous_week);
        
        $end_week = strtotime("next saturday",$start_week);

        $start_week = date("Y-m-d",$start_week) . " 00:00:00";
        
        $end_week = date("Y-m-d",$end_week). " 00:00:00";
        
        $sql = "SELECT `gamification_agentcertificates`.`agent_id`, `tblAgent`.`FirstName`, `tblAgent`.`LastName`,`tblAgent`. `Login`,max(gamification_agentcertificates.agent_points) as points, certificate_name
            FROM `gamification_agentcertificates` 
            JOIN `tblAgent` ON `gamification_agentcertificates`.agent_id = `tblAgent`.AgentID
            WHERE
            ";
        
        $sql .=" (gamification_agentcertificates.created_at BETWEEN '$start_week' AND  '$end_week')";
        
        $sql .=" AND ParentTenantID IN (". implode(",", $this->getTenants() ) .") ";

        $sql .=" GROUP BY `gamification_agentcertificates`.`agent_id` ";
        
        if(count($this->getTenants()) <=0):
           $query = 'SELECT `tblAgent`.`FirstName` FROM `tblAgent` WHERE `tblAgent`.Active = 1 AND `tblAgent`.Active = 0';
        else:
            $query = $sql;
        endif;
       
        $connection=Yii::$app->db;
        
        $command=$connection->createCommand($query);
        
        $rowCount=$command->execute();
        
        $dataProvider = new SqlDataProvider([
            'db' => Yii::$app->db,
            'sql' => $query,
            'totalCount' => $rowCount,
            'sort' =>false,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        
        return $this->render('certreport', [
          'dataProvider' => $dataProvider,
          'model' => $model,
      ]);
       
   }
   
   public function actionExport() {
       
        $searchModel = new AgentSearch();

        $dataProvider = $searchModel->searchActive(Yii::$app->request->queryParams);
        
        headers_sent();
        
        ExcelView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'fullExportType'=> 'csv', //can change to html,xls,csv and so on
            'grid_mode' => 'export',
            'columns' => [               
                //['class' => 'yii\grid\SerialColumn'],
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
            return ob_get_clean();                
    }
}
