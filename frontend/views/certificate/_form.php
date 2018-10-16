<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\Certificates */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="certificates-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'point')->textInput() ?>
    
    <?php $categoryArray = ArrayHelper::map(\common\models\Trophyimages::find()->orderBy('title')->asArray()->all(), 'id', 'title'); ?> 
    
    <?= $form->field($model, 'trohpy_image_id')->dropDownList($categoryArray, ['prompt' => 'Select Trophy'])->label('Certificate') ?>
    
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
