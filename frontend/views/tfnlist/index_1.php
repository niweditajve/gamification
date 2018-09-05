<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TFNListSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'TFN List';
$this->params['breadcrumbs'][] = $this->title;

$layout = <<< HTML
<div class="pull-right">
    {summary}
</div>
        <h3 class="panel-title">
    {heading}
</h3>
{toolbar}
<div class="clearfix"></div>
{items}
{pager}
HTML;
?>


<h1><?= Html::encode($this->title) ?></h1>
<?php // echo $this->render('_search', ['model' => $searchModel]);     ?>

<p>
    <?= Html::a('Create Tfnlist', ['create'], ['class' => 'btn btn-success']) ?>
</p>

<?php
$gridColumns = [
    ['class' => 'yii\grid\SerialColumn'],
    'TFN',
    'CampaignDescriptionHistory',
    'CallTypeDesignation',
    'Script',
    //'Transfer',
    // 'Percent',
    'Report',
    //'SalesForceID',
    //'SourceID',
    'BusinessDesignation',
    'BusinessSourceID',
    // 'Greeting',
    ['class' => 'yii\grid\ActionColumn'],
];

$filename = 'TFN_' . date('YmdHis');
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => $gridColumns,
    'responsive' => true,
    'hover' => true,
    'pjax' => true,
    'export'=>[
        'fontAwesome'=>true,
        'showConfirmAlert'=>false,
        'target'=>GridView::TARGET_BLANK
    ],
    'toolbar' => [
        [
            'content' =>
            Html::button('<i class="glyphicon glyphicon-plus"></i>', [
                'type' => 'button',
                'title' => 'Add Book',
                'class' => 'btn btn-success'
            ]) . ' ' .
            Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['grid-demo'], [
                'class' => 'btn btn-default',
                'title' => 'Reset Grid'
            ]),
        ],
        '{export}',
        '{toggleData}'
    ],
    'toggleDataContainer' => ['class' => 'btn-group-sm'],
    'exportContainer' => ['class' => 'btn-group-sm'],
]);
?>


