<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\grid\GridView;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CallCenterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Call Centers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="call-center-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
        <?= Html::a('Create Call Center', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php
    $dataProvider->pagination->pageSize = 100;
    $gridColumns = [
        // 'RowID',
        // 'CaseID',
        // 'UserID',
        'MediaID',
        'CallCenter',
        'PartnerCode',
        'BPartnerCode',
        'TenantID',
        'EmailDNIS:email',
        'Aliases',
        // 'UpfrontCredit',
        'VerEnabled',
        'Versions',
        'VerCurrent',
    ];
    $filename = 'callcenters_' . date('YmdHis');
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
            // 'RowID',
            // 'CaseID',
            // 'UserID',
            //'MediaID',
            'CallCenter',
            'PartnerCode',
            'BPartnerCode',
            'TenantID',
            // 'EmailDNIS:email',
            // 'Aliases',
            // 'UpfrontCredit',
            'VerEnabled',
            'Versions',
            'VerCurrent',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
    <?php Pjax::end(); ?></div>

