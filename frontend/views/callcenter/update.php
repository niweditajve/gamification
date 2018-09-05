<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CallCenter */

$this->title = 'Update Call Center: ' . $model->RowID;
$this->params['breadcrumbs'][] = ['label' => 'Call Centers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->RowID, 'url' => ['view', 'id' => $model->RowID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="call-center-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
