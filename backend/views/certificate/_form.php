<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use common\models\Trophyimages; 

/* @var $this yii\web\View */
/* @var $model backend\models\Certificates */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="certificates-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'point')->textInput() ?>

    <?php //$form->field($model, 'trohpy_image_id')->textInput() ?>
    
    <?php //$form->field($model, 'trohpy_image_id')->dropDownList(ArrayHelper::map(<Trophyimages>::find()->all(),'id','title'), ['prompt'=>'Select XYZ']) ?> 
    
    <?php $categoryArray = ArrayHelper::map(\common\models\Trophyimages::find()->orderBy('title')->asArray()->all(), 'id', 'title'); ?> 
    
    <?= $form->field($model, 'trohpy_image_id')->dropDownList($categoryArray, ['prompt' => 'Select Trophy'])->label('Trophy') ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
