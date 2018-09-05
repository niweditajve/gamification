<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TfnMedia */

$this->title = 'Update Tfn Media: ' . $model->RowID;
$this->params['breadcrumbs'][] = ['label' => 'Tfn Media', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->RowID, 'url' => ['view', 'id' => $model->RowID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tfn-media-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
