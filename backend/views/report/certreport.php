<?php
/* @var $this yii\web\View */
 // or yii\helpers\Html
// or yii\widgets\ActiveForm

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
           
            
                <h3>Cert Earned report</h3>
                
                <?= DataTables::widget([
                    'dataProvider' => $dataProvider,
                    //'filterModel' => $searchModel,
                    // ... more code here
                    'columns' => $gridColumns
                ]); ?>
            

        </div>
            
        <?php endif; ?>

<!-- <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>-->
    </div>

    <div class="body-content">

        <div class="row">
        </div>

    </div>
</div>
