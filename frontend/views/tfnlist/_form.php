<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TFNList */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tfnlist-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'TFN')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CampaignDescriptionHistory')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'CallTypeDesignation')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'Script')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'Transfer')->textInput() ?>

    <?= $form->field($model, 'Percent')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'Report')->textInput() ?>

    <?= $form->field($model, 'SalesForceID')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'SourceID')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'BusinessDesignation')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'BusinessSourceID')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'Greeting')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
