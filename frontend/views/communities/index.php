<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CommunitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Community Define';
$this->params['breadcrumbs'][] = $this->title;
$base_url = Yii::$app->homeUrl;
?>
<div class="community-index">

    <h1><?= Html::encode($this->title) ?></h1>
       
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'header' => 'Community',
                'attribute' => 'skill',
                
            ],
            
            [
                'header' => "Source ID's",
                'attribute' => 'skill',
                'value' => function ($data) {
       
                    $skills = json_decode($data->sales_source_Id);

                    $skillsData = implode(", " , $skills);

                    return $skillsData;
               },
            ],
            [
                'header' => 'Call Center',
                'attribute' => 'gameAdmin.title',
                'visible'=>Yii::$app->user->can('admin'),
            ],
            
            ['class' => 'yii\grid\ActionColumn','template'=>'{view} {update}'],
        ],
    ]); ?>
</div>
