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
    
    <?php $callcenterArray = ArrayHelper::map(\common\models\CallcenterDefine::find()->orderBy('id')->asArray()->all(), 'id', 'title'); ?> 
    
    <?= $form->field($model, 'trohpy_image_id')->dropDownList($categoryArray, ['prompt' => 'Select Trophy'])->label('Certificate') ?>
    
    <?php echo $form->field($model, 'game_admin_id')->dropDownList($callcenterArray, ['prompt' => 'Select Call Center'])->label('Call Center') ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
