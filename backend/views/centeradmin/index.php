<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\FrontendCallcenterDefineSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dashboard admin';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="frontend-callcenter-define-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Dashboard admin', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            
            [
                'header' => 'CallCenter',
                'attribute' => 'callCenter.TenantLabel',
            ],
            'user_id',            

            ['class' => 'yii\grid\ActionColumn','template'=>'{view} {update}'],
        ],
    ]); ?>
</div>
