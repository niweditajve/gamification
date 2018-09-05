<?php

namespace backend\controllers;

use Yii;
use common\models\CallData;
use common\models\CallDataSearch;
use common\models\CallDataSearchQuick;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * CallDataController implements the CRUD actions for CallData model.
 */
class CallDataController extends Controller {

    //public $scripturl;
    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                //'only' => ['suggest', 'queue', 'delete', 'update'], //only be applied to
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'indexquick', 'view', 'viewquick', 'create', 'update', 'delete', 'newcase'],
                        'roles' => ['admin_cc'],
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

    /**
     * Lists all CallData models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new CallDataSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all CallData models.
     * @return mixed
     */
    public function actionIndexquick() {
        $searchModel = new CallDataSearchQuick();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('indexquick', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CallData model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Displays a single CallData model in quick view.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionViewquick($id) {
        return $this->render('viewquick', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * opens new case.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionNewcase($id) {
        $calldata = $this->findModel($id);
        require_once '_apiCallinContactAPI.php';
        $callfound = FALSE;
        try {
            $callList = $icClient->Contact_GetLiveList();
//            Yii::$app->mailer->compose()
//                    ->setFrom('noreply@appshughes.com')
//                    ->setTo('tom.fabbricante@rmfactory.com')
//                    ->setSubject('inContact API call ')
//                    ->setTextBody($calldata->OriginalANI . "\n" . $calldata->DNIS)
//                    //->setHtmlBody('<b>HTML content</b>')
//                    ->send();
//            $agentlist = "";
            foreach ($callList->Contact_GetLiveListResult->inContact as $r) {
                //print_r($r);

//                $agentlist .= $r->From . "-" . $r->To . "-" . $r->AgentNo . "-" . $r->State . "\n";

                if ($r->AgentNo != 0) {
                    if ($r->From === $calldata->OriginalANI && $r->To === $calldata->DNIS) {
                        if ($r->State !== 'Transfer') {
                            $callfound = TRUE;
                            if (($r->SkillName == 'Outbound') || ($r->SkillName == 'SpiceCSM_OUTBOUND')) {
                                $contactid = $r->ContactID;
                            } elseif ($r->MediaType == 'VoiceMail') {
                                $contactid = $r->ContactID;
                            } else {
                                $contactid = $r->ContactID;
                            }
                        }
                    }
                }
            }
        } catch (SoapFault $e) {
            Yii::$app->mailer->compose()
                    ->setFrom('noreply@appshughes.com')
                    ->setTo('tom.fabbricante@rmfactory.com')
                    ->setSubject('inContact API call fail')
                    ->setTextBody($e)
                    //->setHtmlBody('<b>HTML content</b>')
                    ->send();
        }

//        Yii::$app->mailer->compose()
//                ->setFrom('noreply@appshughes.com')
//                ->setTo('tom.fabbricante@rmfactory.com')
//                ->setSubject('inContact API call ')
//                ->setTextBody($callfound . "\n" . $agentlist)
//                //->setHtmlBody('<b>HTML content</b>')
//                ->send();

        if ($callfound == 0) {
            $scripturl = 'Call Not Found';
        } else {
            $interaction = Yii::$app->params['consumerinteraction'];
            //453edf780953-2bc82cbb78f53008-e089  consumer
            if ($calldata->ScriptID === 'Business') {
                //65221ff8dff5-ffe44cd1a4a55fea-6638 business
                $interaction = Yii::$app->params['businessinteraction'];
            }
            $appkey = '371b5de6-a4c0-44ff-8f84-ae448c33e52d';
            $jenvironment = Yii::$app->params['jacadaenvironment'];
            $scripturl = "https://gointeract.io:443/interact/index";
            $scripturl .= "?interaction={$interaction}&accountId=hughesnet";
            $scripturl .= "&appkey={$appkey}";
            $scripturl .= "&Environment-Name={$jenvironment}";
            $scripturl .= "&icDNIS={$calldata->DNIS}&icANI={$calldata->OriginalANI}&icContactID={$contactid}";
        }
        return $this->render('viewjacada', ['model' => $calldata, 'scripturl' => $scripturl,]);
        //return $this->redirect("https://www.ibm.com");

        /*
         * 
         * CONSUMER
          https://gointeract.io:443/interact/index?interaction=453edf780953-2bc82cbb78f53008-e089&accountId=hughesnet&appkey=371b5de6-a4c0-44ff-8f84-ae448c33e52d&Environment-Name=Dev


          https://gointeract.io:443/interact/index?interaction=453edf780953-2bc82cbb78f53008-e089&accountId=hughesnet&appkey=371b5de6-a4c0-44ff-8f84-ae448c33e52d&Environment-Name=Test


          https://gointeract.io:443/interact/index?interaction=453edf780953-2bc82cbb78f53008-e089&accountId=hughesnet&appkey=371b5de6-a4c0-44ff-8f84-ae448c33e52d&Environment-Name=Prod
         * 
         * BUSINESS

          https://gointeract.io:443/interact/index?interaction=65221ff8dff5-ffe44cd1a4a55fea-6638&accountId=hughesnet&appkey=371b5de6-a4c0-44ff-8f84-ae448c33e52d&Environment-Name=Dev


          https://gointeract.io:443/interact/index?interaction=65221ff8dff5-ffe44cd1a4a55fea-6638&accountId=hughesnet&appkey=371b5de6-a4c0-44ff-8f84-ae448c33e52d&Environment-Name=Test


          https://gointeract.io:443/interact/index?interaction=65221ff8dff5-ffe44cd1a4a55fea-6638&accountId=hughesnet&appkey=371b5de6-a4c0-44ff-8f84-ae448c33e52d&Environment-Name=Prod

         *             
         * 
         */

//            $c = curl_init($scripturl);
//            curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
//            $response = curl_exec($c);
//            curl_close($c);
    }

    /**
     * Creates a new CallData model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new CallData();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->RowID]);
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing CallData model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->RowID]);
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing CallData model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CallData model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CallData the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = CallData::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
