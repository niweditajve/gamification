<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\FrontendCallcenterDefine */

$this->title = 'Update Dashboard admin: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Dashboard admin', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->callCenter->TenantLabel, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="frontend-callcenter-define-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
