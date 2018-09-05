<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\CallCenter */

$this->title = $model->RowID;
$this->params['breadcrumbs'][] = ['label' => 'Call Centers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="call-center-view">

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
            'CaseID',
            'UserID',
            'MediaID',
            'CallCenter',
            'PartnerCode',
            'BPartnerCode',
            'TenantID',
            'EmailDNIS:email',
            'Aliases',
            'UpfrontCredit',
            'VerEnabled',
            'Versions',
            'VerCurrent',
        ],
    ]) ?>

</div>
