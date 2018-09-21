<?php
/* @var $this yii\web\View */
 // or yii\helpers\Html
// or yii\widgets\ActiveForm
use yii\helpers\Html;
use dosamigos\datepicker\DateRangePicker;
use yii\widgets\ActiveForm;
use fedemotta\datatables\DataTables;
$this->title = 'RM Factory';

$gridColumns = [
    ['class' => 'yii\grid\SerialColumn'],
    [
        'header' => 'Name',
        'value' => function($model) { return $model['FirstName']  . " " . $model['LastName'] . ", " . $model['Login'] ;},
    ],
    [
        'header' => 'Last Login Date',
        'value' => 'CreateDate',
    ],
    [
        'header' => 'Points',
        'value' => function($model) { return $model['points'] ? $model['points'] : "" ;},
    ],
];
?>

<div class="site-index">

    <div class="jumbotron">


        <?php if (Yii::$app->user->isGuest): ?>
            You must login.
        <?php else: ?>
            <div class="row">
                <div class="col-md-12">
                    <h3>Point Certificate Report</h3>
                </div>
                <div class="col-md-2">
                </div>
                <div class="col-md-7">
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
                <div class="col-md-3">
                    <div class="form-group">
                        <?= Html::submitButton('filter', ['class' => 'btn btn-success btn-sm', 'style' => 'font-size: 18px; padding: 2px 22px;']) ?>
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
