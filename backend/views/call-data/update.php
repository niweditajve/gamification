<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CallData */

$this->title = 'Update Call Data: ' . $model->RowID;
$this->params['breadcrumbs'][] = ['label' => 'Call Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->RowID, 'url' => ['view', 'id' => $model->RowID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="call-data-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
