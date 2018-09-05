<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TFNListSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tfnlist-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'TFN') ?>

    <?= $form->field($model, 'CampaignDescriptionHistory') ?>

    <?= $form->field($model, 'CallTypeDesignation') ?>

    <?= $form->field($model, 'Script') ?>

    <?= $form->field($model, 'Transfer') ?>

    <?php // echo $form->field($model, 'Percent') ?>

    <?php // echo $form->field($model, 'Report') ?>

    <?php // echo $form->field($model, 'SalesForceID') ?>

    <?php // echo $form->field($model, 'SourceID') ?>

    <?php // echo $form->field($model, 'BusinessDesignation') ?>

    <?php // echo $form->field($model, 'BusinessSourceID') ?>

    <?php // echo $form->field($model, 'Greeting') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
