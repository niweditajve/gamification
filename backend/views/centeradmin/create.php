<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\FrontendCallcenterDefine */

$this->title = 'Create Dashboard admin';
$this->params['breadcrumbs'][] = ['label' => 'Dashboard admin', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="frontend-callcenter-define-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
