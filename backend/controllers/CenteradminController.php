<?php

namespace backend\controllers;

use Yii;
use common\models\FrontendCallcenterDefine;
use common\models\User;
use common\models\FrontendCallcenterDefineSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * CenterAdminController implements the CRUD actions for FrontendCallcenterDefine model.
 */
class CenteradminController extends Controller
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
                //'only' => ['suggest', 'queue', 'delete', 'update'], //only be applied to
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view', 'create', 'update','showusers','selelctedusers'],
                        'roles' => ['admin','admin_agents'],
                    ],
                ],
            ],
        ];
    } 

    /**
     * Lists all FrontendCallcenterDefine models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FrontendCallcenterDefineSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FrontendCallcenterDefine model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new FrontendCallcenterDefine model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new FrontendCallcenterDefine();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing FrontendCallcenterDefine model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        if ($model->load(Yii::$app->request->post())) {
            
            $user_id = Yii::$app->request->post('checkUsers');
            
            $user_ids = explode(",",str_replace(array("[","]"), array("",""),$user_id));
           
            $model->user_id = json_encode($user_ids);
            
            if($model->save())
            {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing FrontendCallcenterDefine model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the FrontendCallcenterDefine model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FrontendCallcenterDefine the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FrontendCallcenterDefine::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    public function actionShowusers(){
        
        $tenant_id = Yii::$app->request->post('tenant_id');
        
        $selectedUsers = FrontendCallcenterDefine::find()
                ->select("user_id")
                ->where(['tenant_id'=>$tenant_id])
                ->asArray()
                ->all();
        
        $notUsers = array();
        
        foreach($selectedUsers as $selectedUser){
             
            $users = json_decode($selectedUser['user_id']);
             
            foreach($users as $user){
               ($user) ? array_push($notUsers, $user) : "";
            }
        }
        
        $users = User::find()
               ->Select('id,email,username')
               ->orderBy('id')
               ->where(['not in','id',$notUsers])
               ->asArray()
               ->all();
       
       echo json_encode($users);
       
       die();
    }
    
    public function actionSelelctedusers(){
        
        $tenant_id = Yii::$app->request->post('tenant_id');
        
        $userResult = FrontendCallcenterDefine::find()
                ->select("user_id")
                ->where(['tenant_id'=>$tenant_id])
                ->one();
        
        $users = json_decode($userResult['user_id']);
        
        $response = array();
        
        foreach($users as $user){
            
            $userDetail = User::find()
               ->Select('email,username')
               ->where(['id'=>$user])
               ->one();
            
            $data['id'] = $user;
            $data['email'] = $userDetail['email'];
            $data['username'] = $userDetail['username'];
            
            $response[] = $data;
            
        }
        
        echo json_encode($response);
        
        die();
    }
}
