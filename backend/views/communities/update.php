<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Community */

$this->title = 'Update Community: ' . $model->skill;
$this->params['breadcrumbs'][] = ['label' => 'Communities', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->skill, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="community-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
