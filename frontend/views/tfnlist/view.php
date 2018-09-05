<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TFNList */

$this->title = $model->TFN;
$this->params['breadcrumbs'][] = ['label' => 'Tfnlists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tfnlist-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->TFN], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->TFN], [
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
            'TFN',
            'CampaignDescriptionHistory:ntext',
            'CallTypeDesignation:ntext',
            'Script:ntext',
            'Transfer',
            'Percent:ntext',
            'Report',
            'SalesForceID:ntext',
            'SourceID:ntext',
            'BusinessDesignation:ntext',
            'BusinessSourceID:ntext',
            'Greeting:ntext',
        ],
    ]) ?>

</div>
