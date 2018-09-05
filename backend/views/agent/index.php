<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\grid\GridView;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AgentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Agents';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="agent-index">

    <h1><?= Html::encode($this->title) ?></h1>
<?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
<?= Html::a('Create Agent', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php
    $dataProvider->pagination->pageSize=100;
    $gridColumns = [
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
    ];
    $filename = 'agents_' . date('YmdHis');
    echo ExportMenu::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns,
        'filename' => $filename,
        'exportConfig' => [
            ExportMenu::FORMAT_PDF => false,
            ExportMenu::FORMAT_TEXT => false,
            ExportMenu::FORMAT_EXCEL => false,],
    ]);
    ?>

    <?php Pjax::begin(); ?>    <?=
    
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'AgentID',
            'FirstName',
            'LastName',
            'Login',
            //'Password',
            // 'TierID',
            // 'TypeID',
            // 'SecurityLevelID',
            'Active',
            // 'CreateDate',
            // 'ViewID',
            // 'BaseFolder',
            // 'Publish',
            // 'Reset',
            // 'AlternateEmail:email',
            // 'Phone',
            // 'AlternatePhone',
            // 'IMType',
            // 'IMName',
            // 'ParentTenantID',
            // 'LastModified',
            'inContactAgent',
            // 'inContactSuper',
            // 'EmailContact:email',
            // 'EmaiContact',
            // 'inContact',
            // 'Five9',
            // 'Groupings',
            // 'Groups',
            // 'ModifiedAgent',
            // 'CreateAgent',
            // 'LastReset',
            // 'Locked',
            // 'AmazonAgent',
            // 'AmazonEmbedded',
            // 'AmazonConnector',
            // 'AbstractBuilder',
            // 'DatabaseBuilder',
            // 'ReportBuilder',
            // 'inContactConnector',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
<?php Pjax::end(); ?></div>
