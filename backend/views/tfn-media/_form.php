cd backache<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TfnMedia */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tfn-media-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'description')->textInput() ?>

    <?= $form->field($model, 'mediaType')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'inContactTFN')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'script')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'transfer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'percent')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Report')->textInput() ?>

    <?= $form->field($model, 'SalesForceID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SourceID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BusinessDesignation')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BusinessSourceID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Greeting')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
