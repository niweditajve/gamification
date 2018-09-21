<?php
/* @var $this yii\web\View */
 // or yii\helpers\Html
// or yii\widgets\ActiveForm
use fedemotta\datatables\DataTables;
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
?>

<div class="site-index">

    <div class="jumbotron">


        <?php if (Yii::$app->user->isGuest): ?>
            You must login.
        <?php else: ?>
            <div class="row">
                
                Agent reports
            
                <?php
                   /* $searchModel = new AgentSearch();
                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);*/
                ?>
                <?= DataTables::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => $gridColumns,
                    'clientOptions' => [
                       // "lengthMenu"=> [[20,-1], [20,Yii::t('app',"All")]],
                        "info"=>true,
                        "responsive"=>true, 
                        "dom"=> 'lfTrtip',
                        "tableTools"=>[
                            "aButtons"=> [  
                                [
                                "sExtends"=> "csv",
                                "sButtonText"=> Yii::t('app',"Save to CSV")
                                ],[
                                "sExtends"=> "xls",
                                "oSelectorOpts"=> ["page"=> 'current']
                                ]
                            ]
                        ]
                    ],
                   
                   
                ]);?>
            

        </div>
            
        <?php endif; ?>

<!-- <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>-->
    </div>

    <div class="body-content">

        <div class="row">
        </div>

    </div>
</div>

