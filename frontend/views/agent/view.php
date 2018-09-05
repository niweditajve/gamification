<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Agent */

$this->title = $model->AgentID;
$this->params['breadcrumbs'][] = ['label' => 'Agents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="agent-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->AgentID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->AgentID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'AgentID',
            'FirstName',
            'LastName',
            'Login',
            'Password',
            'TierID',
            'TypeID',
            'SecurityLevelID',
            'Active',
            'CreateDate',
            'ViewID',
            'BaseFolder',
            'Publish',
            'Reset',
            'AlternateEmail:email',
            'Phone',
            'AlternatePhone',
            'IMType',
            'IMName',
            'ParentTenantID',
            'LastModified',
            'inContactAgent',
            'inContactSuper',
            'EmailContact:email',
            'EmaiContact',
            'inContact',
            'Five9',
            'Groupings',
            'Groups',
            'ModifiedAgent',
            'CreateAgent',
            'LastReset',
            'Locked',
            'AmazonAgent',
            'AmazonEmbedded',
            'AmazonConnector',
            'AbstractBuilder',
            'DatabaseBuilder',
            'ReportBuilder',
            'inContactConnector',
        ],
    ]) ?>

</div>
