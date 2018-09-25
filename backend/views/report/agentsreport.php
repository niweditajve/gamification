<?php
/* @var $this yii\web\View */
 // or yii\helpers\Html
// or yii\widgets\ActiveForm
use fedemotta\datatables\DataTables;
use kartik\export\ExportMenu;
$this->title = 'RM Factory';
$date = "11-12-2018";
$gridColumns = [
    ['class' => 'yii\grid\SerialColumn'],
    [
        'header' => 'Name',
        'value' => function($model) { return $model->FirstName  . " " . $model->LastName . ", " . $model->Login ;},
    ],
    [
        'header' => 'Last Login Date',
        'value' => 'CreateDate',
    ],
];
  
        
$exportColumns = [
    [
        'header' => 'Name',
        'value' => function($model) { return $model->FirstName  . " " . $model->LastName . ", " . $model->Login ;},
    ],
    [
        'header' => 'Last Login Date',
        'value' => 'CreateDate',
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
                    <h3>Last Login  Report</h3>
                </div>
                
                <div class="col-md-2">
                <?php
                   // Renders a export dropdown menu
                    echo ExportMenu::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => $exportColumns,
                        'exportConfig' => [
                            ExportMenu::FORMAT_TEXT => false,
                            ExportMenu::FORMAT_PDF => false,
                            ExportMenu::FORMAT_HTML => false,
                            ],
                    ]);
                ?>
                </div>
            </div>
            <div class="margin-top15"></div>
            <div class="row">
                <div class="col-md-12">
                <?= DataTables::widget([
                    'dataProvider' => $dataProvider,
                   // 'filterModel' => $searchModel,
                    'columns' => $gridColumns,
                    'clientOptions' => [
                     "lengthMenu"=> [[20,-1], [20,Yii::t('app',"All")]],
                        "info"=>false,
                        "responsive"=>true, 
                        ],
                ]);?>
            
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

