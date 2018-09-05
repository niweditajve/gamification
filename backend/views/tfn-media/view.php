<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\TfnMedia */

$this->title = $model->RowID;
$this->params['breadcrumbs'][] = ['label' => 'Tfn Media', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tfn-media-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->RowID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->RowID], [
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
            'RowID',
            'description',
            'mediaType',
            'inContactTFN',
            'script',
            'transfer',
            'percent',
            'Report',
            'SalesForceID',
            'SourceID',
            'BusinessDesignation',
            'BusinessSourceID',
            'Greeting:ntext',
        ],
    ]) ?>

</div>
