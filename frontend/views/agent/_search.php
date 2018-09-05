<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AgentSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="agent-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'AgentID') ?>

    <?= $form->field($model, 'FirstName') ?>

    <?= $form->field($model, 'LastName') ?>

    <?= $form->field($model, 'Login') ?>

    <?= $form->field($model, 'Password') ?>

    <?php // echo $form->field($model, 'TierID') ?>

    <?php // echo $form->field($model, 'TypeID') ?>

    <?php // echo $form->field($model, 'SecurityLevelID') ?>

    <?php // echo $form->field($model, 'Active') ?>

    <?php // echo $form->field($model, 'CreateDate') ?>

    <?php // echo $form->field($model, 'ViewID') ?>

    <?php // echo $form->field($model, 'BaseFolder') ?>

    <?php // echo $form->field($model, 'Publish') ?>

    <?php // echo $form->field($model, 'Reset') ?>

    <?php // echo $form->field($model, 'AlternateEmail') ?>

    <?php // echo $form->field($model, 'Phone') ?>

    <?php // echo $form->field($model, 'AlternatePhone') ?>

    <?php // echo $form->field($model, 'IMType') ?>

    <?php // echo $form->field($model, 'IMName') ?>

    <?php // echo $form->field($model, 'ParentTenantID') ?>

    <?php // echo $form->field($model, 'LastModified') ?>

    <?php // echo $form->field($model, 'inContactAgent') ?>

    <?php // echo $form->field($model, 'inContactSuper') ?>

    <?php // echo $form->field($model, 'EmailContact') ?>

    <?php // echo $form->field($model, 'EmaiContact') ?>

    <?php // echo $form->field($model, 'inContact') ?>

    <?php // echo $form->field($model, 'Five9') ?>

    <?php // echo $form->field($model, 'Groupings') ?>

    <?php // echo $form->field($model, 'Groups') ?>

    <?php // echo $form->field($model, 'ModifiedAgent') ?>

    <?php // echo $form->field($model, 'CreateAgent') ?>

    <?php // echo $form->field($model, 'LastReset') ?>

    <?php // echo $form->field($model, 'Locked') ?>

    <?php // echo $form->field($model, 'AmazonAgent') ?>

    <?php // echo $form->field($model, 'AmazonEmbedded') ?>

    <?php // echo $form->field($model, 'AmazonConnector') ?>

    <?php // echo $form->field($model, 'AbstractBuilder') ?>

    <?php // echo $form->field($model, 'DatabaseBuilder') ?>

    <?php // echo $form->field($model, 'ReportBuilder') ?>

    <?php // echo $form->field($model, 'inContactConnector') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
