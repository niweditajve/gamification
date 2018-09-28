<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Categories */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categories-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            
           
            
            
            
            [
                'attribute' => 'Dashboard Display Name',
                'value' => $model->title,
            ],
            
            'point',
            
            [
                'attribute' => 'Red Color Bar Range',
                'value' => "0% - ".$model->redCutOff . "%",
            ],
            
            [
                'attribute' => 'Yellow Color Bar Range',
                'value' => $model->redCutOff + 1 ."% - ".  $model->yellowCutOff."%",
            ],
            
            [
                'attribute' => 'Green Color Bar Range',
                'value' => $model->yellowCutOff + 1 . "% - 100%",
            ],
            
            
        ],
    ]) ?>

</div>
