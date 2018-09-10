<?php

namespace frontend\controllers;

use Yii;
use common\models\Agent;
use common\models\AgentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\AgentLoginForm;
use yii\filters\AccessControl;
use yii\helpers\Url;



/**
 * AgentController implements the CRUD actions for Agent model.
 */
class SkillController extends Controller
{

	public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                //'only' => ['suggest', 'queue', 'delete', 'update'], //only be applied to
                'rules' => [
                    [
                        'allow' => true,
                        //'actions' => ['index', 'view', 'create', 'update', 'delete'],
                        //'roles' => [''],
                    ],
                ],
            ],
            
            
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
       $model = new AgentLoginForm();
       if (!Yii::$app->user->getIsGuest()) {
            return $this->render(
            'login',
            [
                'model' => $model,
                'module' => $this->module,
            ]
        );
        }
    }

    public function actionLogin(){

    	if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new AgentLoginForm();

        /*if (Yii::$app->request->isAjax && $form->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;

            return ActiveForm::validate($form);
        }*/
        //print_r(Yii::$app->request->post()); exit;

       /* if ($form->load(Yii::$app->request->post())) {

        	if ($form->validate()) {
                 
                    Yii::$app->session->set('credentials', ['login' => $form->login, 'pwd' => $form->password]);

                    return $this->redirect(['confirm']);
                
            }*/

	        $fileHandler=fopen( Url::base(true) . "/agents.csv",'r');
			if($fileHandler){
			   while($line=fgetcsv($fileHandler,1000)){
			      if($line[0])
			      	echo $line[0];
			   }
			   //exit;
			}
		//}

		return $this->render(
            'login',
            [
                'model' => $model
            ]
        );
    }



 }