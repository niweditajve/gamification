<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\TrophyimagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Trophy Images';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trophyimages-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    
        <?= Html::a('Create Trophy Images', ['create'], ['class' => 'btn btn-success']) ?>
    

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
            
           
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    
    ?>
</div>
