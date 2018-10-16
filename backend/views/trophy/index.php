<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\TrophyimagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Trophy Images';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trophyimages-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Trophy Images', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'title',
            //'filename',
            
            [
            'attribute' => 'filename',
                'format' => 'raw',
                'label' => 'Trophy',
                'value' => function ($data) {
       
                $urls = Yii::$app->urlManagerF->createUrl('') .'images/slider' ."/". $data['filename'];
                
                return Html::img($urls ,['width' => '100px'],['height' => '100px'] ,['alt'=>'yii']);
               },
            ],
                       
            [
                'header' => 'Call Center',
                'attribute' => 'gameAdmin.title',
                'filter' => Html::activeDropDownList($searchModel, 'game_admin_id', ArrayHelper::map(\common\models\CallcenterDefine::find()->asArray()->all(), 'id', 'title'),['class'=>'form-control','prompt' => 'Select Call Center'])
           
            ],
            
           
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    
    ?>
</div>
