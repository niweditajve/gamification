<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CallCenterSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="call-center-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'RowID') ?>

    <?= $form->field($model, 'CaseID') ?>

    <?= $form->field($model, 'UserID') ?>

    <?= $form->field($model, 'MediaID') ?>

    <?= $form->field($model, 'CallCenter') ?>

    <?php // echo $form->field($model, 'PartnerCode') ?>

    <?php // echo $form->field($model, 'BPartnerCode') ?>

    <?php // echo $form->field($model, 'TenantID') ?>

    <?php // echo $form->field($model, 'EmailDNIS') ?>

    <?php // echo $form->field($model, 'Aliases') ?>

    <?php // echo $form->field($model, 'UpfrontCredit') ?>

    <?php // echo $form->field($model, 'VerEnabled') ?>

    <?php // echo $form->field($model, 'Versions') ?>

    <?php // echo $form->field($model, 'VerCurrent') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
