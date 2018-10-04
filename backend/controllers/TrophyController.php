<?php

namespace backend\controllers;

use Yii;
use common\models\Trophyimages;
use common\models\TrophyimagesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\UploadForm;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;

/**
 * TrophyController implements the CRUD actions for Trophyimages model.
 */
class TrophyController extends Controller
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
                        'actions' => ['index', 'view', 'create','delete', 'update'],
                        'roles' => ['admin'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Trophyimages models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TrophyimagesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Trophyimages model.
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
     * Creates a new Trophyimages model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Trophyimages();

        if ($model->load(Yii::$app->request->post())) {
            
            $directory = Yii::getAlias('@frontend/web/images/slider') . DIRECTORY_SEPARATOR;

            if (!is_dir($directory)) {
                
                FileHelper::createDirectory($directory);
            }

            $imageFile = UploadedFile::getInstance($model, 'filename');
            
            if(!empty($imageFile)){
                
                if($imageFile->extension =="png" || $imageFile->extension == "jpg" || $imageFile->extension =="jpeg" || $imageFile->extension == "gif")
                { 
                    $fileName = time() . '.' . $imageFile->extension;

                    $filePath = $directory . $fileName;

                    $imageFile->saveAs($filePath);

                    $model->filename= $fileName;

                    $model->created_at= date('Y-m-d h:i:s');

                    if($model->save()){
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                }
                else{
                    Yii::$app->session->setFlash('error', "Only JPG, PNG, GIF images are allowed.");
                    return $this->render('create', [
                    'model' => $model,
                ]);
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Trophyimages model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save() ) {
            
            $directory = Yii::getAlias('@frontend/web/images/slider') . DIRECTORY_SEPARATOR;

            if (!is_dir($directory)) {
                FileHelper::createDirectory($directory);
            }

            $imageFile = UploadedFile::getInstance($model, 'filename');
            
            if(!empty($imageFile)){
                if($imageFile->extension =="png" || $imageFile->extension == "jpg" || $imageFile->extension =="jpeg" || $imageFile->extension == "gif")
                {
                    $fileName = time() . '.' . $imageFile->extension;

                    $filePath = $directory . $fileName;

                    $imageFile->saveAs($filePath);

                    $model->filename= $fileName;

                    if($model->save()){                    
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                }
                else{
                    Yii::$app->session->setFlash('error', "Only JPG, PNG, GIF images are allowed.");
                    return $this->render('create', [
                    'model' => $model,
                ]);
                }
            }
            
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Trophyimages model.
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
     * Finds the Trophyimages model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Trophyimages the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Trophyimages::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
