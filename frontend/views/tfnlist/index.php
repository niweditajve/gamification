<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\grid\GridView;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TFNListSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'TFN List';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tfnlist-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
        <?= Html::a('Create TFN Item', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php
 
    $gridColumns = [
        'TFN',
        'CampaignDescriptionHistory',
        'CallTypeDesignation',
        'Script',
        'Transfer',
        'Percent',
        'Report',
        'SalesForceID',
        'SourceID',
        'BusinessDesignation',
        'BusinessSourceID',
        'Greeting',
    ];

    $filename = 'tfn_' . date('YmdHis');
    echo ExportMenu::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns,
        'filename' => $filename,
        'exportConfig' => [
            ExportMenu::FORMAT_PDF => false,
            ExportMenu::FORMAT_TEXT => false,
            ExportMenu::FORMAT_EXCEL => false,],
    ]);

    //$e->folder = '@runtime\tmp';
    ?>

    <?php Pjax::begin(); ?>    
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'TFN',
            'CampaignDescriptionHistory:ntext',
            'CallTypeDesignation:ntext',
            'Script:ntext',
            'Transfer',
            // 'Percent:ntext',
            // 'Report',
            // 'SalesForceID:ntext',
            // 'SourceID:ntext',
            // 'BusinessDesignation:ntext',
            // 'BusinessSourceID:ntext',
            // 'Greeting:ntext',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
    <?php Pjax::end(); ?></div>
