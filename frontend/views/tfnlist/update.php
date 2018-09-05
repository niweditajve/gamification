<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TFNList */

$this->title = 'Update Tfnlist: ' . $model->TFN;
$this->params['breadcrumbs'][] = ['label' => 'Tfnlists', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->TFN, 'url' => ['view', 'id' => $model->TFN]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tfnlist-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
