<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use common\models\CallcenterDefine; 

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CategoriesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categories-index">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'header' => 'Dashboard Display Name',
                'attribute' => 'title',
            ],
            'point',
            [
                'header' => 'Call Center',
                'attribute' => 'callcenterDefine.title',
                'visible'=>Yii::$app->user->can('admin'),
                'filter' => Html::activeDropDownList($searchModel, 'game_admin_id', ArrayHelper::map(CallcenterDefine::find()->asArray()->all(), 'id', 'title'),['class'=>'form-control','prompt' => 'Select Category'])
            ],
            
            ['class' => 'yii\grid\ActionColumn','template'=>'{view} {update}'],
            
        ],
    ]); ?>
</div>
