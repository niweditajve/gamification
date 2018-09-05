<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Agent */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="agent-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'FirstName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'LastName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Login')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TierID')->textInput() ?>

    <?= $form->field($model, 'TypeID')->textInput() ?>

    <?= $form->field($model, 'SecurityLevelID')->textInput() ?>

    <?= $form->field($model, 'Active')->textInput() ?>

    <?= $form->field($model, 'CreateDate')->textInput() ?>

    <?= $form->field($model, 'ViewID')->textInput() ?>

    <?= $form->field($model, 'BaseFolder')->textInput() ?>

    <?= $form->field($model, 'Publish')->textInput() ?>

    <?= $form->field($model, 'Reset')->textInput() ?>

    <?= $form->field($model, 'AlternateEmail')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'AlternatePhone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'IMType')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'IMName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ParentTenantID')->textInput() ?>

    <?= $form->field($model, 'LastModified')->textInput() ?>

    <?= $form->field($model, 'inContactAgent')->textInput() ?>

    <?= $form->field($model, 'inContactSuper')->textInput() ?>

    <?= $form->field($model, 'EmailContact')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'EmaiContact')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'inContact')->textInput() ?>

    <?= $form->field($model, 'Five9')->textInput() ?>

    <?= $form->field($model, 'Groupings')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Groups')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ModifiedAgent')->textInput() ?>

    <?= $form->field($model, 'CreateAgent')->textInput() ?>

    <?= $form->field($model, 'LastReset')->textInput() ?>

    <?= $form->field($model, 'Locked')->textInput() ?>

    <?= $form->field($model, 'AmazonAgent')->textInput() ?>

    <?= $form->field($model, 'AmazonEmbedded')->textInput() ?>

    <?= $form->field($model, 'AmazonConnector')->textInput() ?>

    <?= $form->field($model, 'AbstractBuilder')->textInput() ?>

    <?= $form->field($model, 'DatabaseBuilder')->textInput() ?>

    <?= $form->field($model, 'ReportBuilder')->textInput() ?>

    <?= $form->field($model, 'inContactConnector')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
