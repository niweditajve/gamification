<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Trophyimages */

$this->title = 'Create Trophy Images';
$this->params['breadcrumbs'][] = ['label' => 'Trophyimages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trophyimages-create">

    <h1><?= Html::encode($this->title) ?></h1>
    
    
    <?php if (Yii::$app->session->hasFlash('error')): ?>
        <div class="alert alert-error alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">�</button>
        <h4><i class="icon fa fa-check"></i>Saved!</h4>
        <?= Yii::$app->session->getFlash('error') ?>
        </div>
    <?php endif; ?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
