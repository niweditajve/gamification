<?php

namespace backend\controllers;

use Yii;
use common\models\UploadForm;
use common\models\TfnMedia;
use common\models\TfnMediaSearch;
use common\models\TfnMediaNewTable;
use common\models\TfnMediaNewTableSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;

/**
 * TfnMediaController implements the CRUD actions for TfnMedia model.
 */
class TfnMediaController extends Controller {

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
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'upload', 'indexnew'],
                        'roles' => ['admin_tfn'],
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
     * Lists all TfnMedia models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new TfnMediaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TfnMedia model.
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
     * Creates a new TfnMedia model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new TfnMedia();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->RowID]);
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing TfnMedia model.
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
     * Deletes an existing TfnMedia model.
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
     * Finds the TfnMedia model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TfnMedia the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = TfnMedia::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Uploads file to update TFN's
     * 
     */
    public function actionUpload() {
        $model = new UploadForm();

        //Set the path that the file will be uploaded to
        $path = Yii::getAlias('@backend') . '/uploads/tfn/';

        if (Yii::$app->request->isPost) {
            $model->file = UploadedFile::getInstance($model, 'file');
            if ($model->file && $model->validate()) {
                $model->file->saveAs($path . $model->file->baseName . '.' . $model->file->extension);

                $model->file = $path . $model->file->baseName . '.' . $model->file->extension;

                //backup existing table 
                $newtable = 'tfnMediaNewTable';
                $query = Yii::$app->db->createCommand()->truncateTable($newtable)->execute();
//                $sql = 'Insert ' . $newtable . ' SELECT * FROM tfnMedia';
//                $query = Yii::$app->db->createCommand($sql)->execute();



                $handle = fopen($model->file, "r");
                $flag = true;
                while (($fileop = fgetcsv($handle, 1000, ",")) !== false) {
                    if ($flag) {
                        $flag = false;
                        continue;
                    }
                    $description = str_replace("'", "\'", $fileop[0]);
                    $mediaType = $fileop[1];
                    $inContactTFN = $fileop[2];
                    $script = $fileop[3];
                    $transfer = $fileop[4];
                    $percent = $fileop[5];
                    $Report = $fileop[6];
                    $SalesForceID = $fileop[7];
                    $SourceID = $fileop[8];
                    $BusinessDesignation = str_replace("'", "\'", $fileop[9]);
                    $BusinessSourceID = $fileop[10];
                    $Greeting = str_replace("'", "\'", $fileop[11]);
                    // print_r($fileop);exit();
                    $sql = "INSERT INTO {$newtable} (description, mediaType, inContactTFN, script,transfer,percent,Report,SalesForceID,SourceID,BusinessDesignation,BusinessSourceID,Greeting) "
                            . "VALUES ('$description', '$mediaType', '$inContactTFN','$script','$transfer','$percent','$Report','$SalesForceID','$SourceID','$BusinessDesignation','$BusinessSourceID','$Greeting')";
                    $query = Yii::$app->db->createCommand($sql)->execute();
                }

                if ($query) {
                    // file is uploaded successfully
                    Yii::$app->session->setFlash('success', 'Upload Was successful');
                    return $this->redirect(array('/tfn-media-new-table'));
                }
            }
//            $model = new TfnMediaNewTable();
//            return $this->render('indexnew', ['model' => $model]);
        }

        return $this->render('upload', ['model' => $model]);
    }

    /**
     * Displays a single TfnMedia model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionViewNew($id) {
        $model = new TfnMediaNewTable();
        return $this->render('viewnew', [
                    'model' => $model->findModel($id),
        ]);
    }

}
