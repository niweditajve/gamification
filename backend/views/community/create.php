<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Community */

$this->title = 'Create Community';
$this->params['breadcrumbs'][] = ['label' => 'Communities', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="community-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
