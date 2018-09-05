<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\grid\GridView;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel common\models\TfnMediaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'TFN Media';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tfn-media-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Tfn Media', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Upload TFN File', ['upload'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php
    $gridColumns = [
        'RowID',
        'inContactTFN',
        'script',
        'description',
        'mediaType',
        'transfer',
        'percent',
        'Report',
        'SalesForceID',
        'SourceID',
        'BusinessDesignation',
        'BusinessSourceID',
        'Greeting:ntext',
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
            // ['class' => 'yii\grid\SerialColumn'],
            'inContactTFN',
            'script',
            // 'RowID',
            'description',
            'mediaType',
            //'transfer',
            //'percent',
            //'Report',
            //'SalesForceID',
            //'SourceID',
            //'BusinessDesignation',
            //'BusinessSourceID',
            //'Greeting:ntext',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
    <?php Pjax::end(); ?>
</div>
