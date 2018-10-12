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
    
    <?php $categoryArray = ArrayHelper::map(\common\models\Trophyimages::find()->orderBy('title')->asArray()->all(), 'id', 'title'); ?> 
    
    <?php //$communityArray = ArrayHelper::map(\common\models\Usercallcenters::find()->orderBy('user_id')->asArray()->all(), 'id', 'user_id'); ?> 
    
    <?= $form->field($model, 'trohpy_image_id')->dropDownList($categoryArray, ['prompt' => 'Select Trophy'])->label('Trophy') ?>
    
    <?php //echo $form->field($model, 'usercallcenter_id')->dropDownList($communityArray, ['prompt' => 'Select '])->label('User') ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
