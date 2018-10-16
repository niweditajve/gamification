<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Certificates */

$this->title = 'Update Certificates: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Certificates', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="certificates-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
