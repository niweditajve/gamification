<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
 
/* @var $this yii\web\View */
/* @var $model frontend\models\ChangePasswordForm */
/* @var $form ActiveForm */
 
$this->title = 'Change Password';
?>
<div class="user-changePassword row">
 	<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
 		<h1><?= Html::encode($this->title) ?></h1>
    <?php $form = ActiveForm::begin(['action'=>'change-password']); ?>
 
        <?= $form->field($model, 'password')->passwordInput() ?>
        <?= $form->field($model, 'confirm_password')->passwordInput() ?>
 
        <div class="form-group">
            <?= Html::submitButton('Change', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>
 	</div>
</div>