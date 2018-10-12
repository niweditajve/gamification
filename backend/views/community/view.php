<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Community */

$this->title = $model->community_title;
$this->params['breadcrumbs'][] = ['label' => 'Sales Center', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="community-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'Trophy',
                'value' => $model->callCenter->CallCenter,
            ],
            'community_title',
            'sales_source_id',
           /* [
                'attribute' => 'User',
                'value' => $model->gameAdmin->user_id,
            ],*/
        ],
    ]) ?>

</div>
