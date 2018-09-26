<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $model backend\models\Community */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="community-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?php  $communityArray = ArrayHelper::map(\common\models\CallCenter::find()->orderBy('CallCenter')->asArray()->all(), 'RowID', 'CallCenter'); ?> 
    
    <?php echo $form->field($model, 'call_center_id')->dropDownList($communityArray, ['prompt' => 'Select Call Center'])->label('Call Center') ?>

    <?= $form->field($model, 'community_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sales_source_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
