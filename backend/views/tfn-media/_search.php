<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TfnMediaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tfn-media-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'RowID') ?>


    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'mediaType') ?>

    <?php  echo $form->field($model, 'inContactTFN') ?>

    <?php // echo $form->field($model, 'script') ?>

    <?php // echo $form->field($model, 'transfer') ?>

    <?php // echo $form->field($model, 'percent') ?>

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
