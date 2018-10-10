<?php
/* @var $this yii\web\View */
 // or yii\helpers\Html
// or yii\widgets\ActiveForm
use yii\helpers\Html;
use dosamigos\datepicker\DateRangePicker;
use yii\widgets\ActiveForm;
use fedemotta\datatables\DataTables;
use kartik\export\ExportMenu;
$this->title = 'RM Factory';

$gridColumns = [
    ['class' => 'yii\grid\SerialColumn'],
    [
        'header' => 'Name',
        'value' => function($model) { return $model['FirstName']  . " " . $model['LastName'] . ", " . $model['Login'] ;},
    ],
    [
        'header' => 'Last Login Date',
        'value' => function($model) { return $model['lastlogin']  ? $model['lastlogin'] : "" ;},
    ],
    [
        'header' => 'Number of certificate',
        'value' => 'certificates',
    ],
    [
        'header' => 'Points',
        'value' => function($model) { return $model['points'] ? $model['points'] : "" ;},
    ],
];
        
$exportColumns = [
   
    [
        'header' => 'Name',
        'value' => function($model) { return $model['FirstName']  . " " . $model['LastName'] . ", " . $model['Login'] ;},
    ],
    [
        'header' => 'Last Login Date',
        'value' => function($model) { return $model['lastlogin']  ? $model['lastlogin'] : "" ;},
    ],
    [
        'header' => 'Number of certificate',
        'value' => 'certificates',
    ],
    [
        'header' => 'Points',
        'value' => function($model) { return $model['points'] ? $model['points'] : "" ;},
    ],
];
        
        
?>


<div class="site-index">

    <div class="container">


        <?php if (Yii::$app->user->isGuest): ?>
            You must login.
        <?php else: ?>
            <div class="row">
                <div class="col-md-12">
                    <h3>Point Certificate Report</h3>
                </div>
                <div class="col-md-4">
                    <?php
                    echo ExportMenu::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => $gridColumns,
                        'exportConfig' => [
                            ExportMenu::FORMAT_TEXT => false,
                            ExportMenu::FORMAT_PDF => false,
                            ExportMenu::FORMAT_HTML => false,
                            ExportMenu::FORMAT_EXCEL  => false,
                            ],
                    ]);
                    ?>
                </div>
                <div class="col-md-6">
                <?php $form = ActiveForm::begin(); ?>
                <?php 
                 $d1= $date_from ;//? $date_from : date('Y-m-d',strtotime('today - 30 days'));
                 $d2= $date_to;// ? $date_to : date('Y-m-d',strtotime('today')) ;
                 ?>
                
                <?= DateRangePicker::widget([
                    'name' => 'date_from',
                    'value' => $d1,
                    'nameTo' => 'date_to',
                    'valueTo' => $d2
                ]);?>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <?= Html::submitButton('filter', ['class' => 'btn btn-success btn-sm report-button', 'style' => 'font-size: 18px; padding: 2px 22px;']) ?>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
                <div class="col-md-12">
                    
                <?= DataTables::widget([
                    'dataProvider' => $dataProvider,
                    //'filterModel' => $searchModel,
                    // ... more code here
                    'columns' => $gridColumns
                ]); ?>
            
                </div>
        </div>
            
        <?php endif; ?>

<!-- <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>-->
    </div>

    <div class="body-content">

        <div class="row">
        </div>

    </div>
</div>
