<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CallCenter */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="call-center-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'RowID')->textInput() ?>

    <?= $form->field($model, 'CaseID')->textInput() ?>

    <?= $form->field($model, 'UserID')->textInput() ?>

    <?= $form->field($model, 'MediaID')->textInput() ?>

    <?= $form->field($model, 'CallCenter')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PartnerCode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BPartnerCode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TenantID')->textInput() ?>

    <?= $form->field($model, 'EmailDNIS')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Aliases')->textInput() ?>

    <?= $form->field($model, 'UpfrontCredit')->textInput() ?>

    <?= $form->field($model, 'VerEnabled')->textInput() ?>

    <?= $form->field($model, 'Versions')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'VerCurrent')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
