<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Certificates */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Certificates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="certificates-view">

    <h1><?= Html::encode($this->title) ?></h1>

    
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'point',
            
            [
                'attribute' => 'Trophy',
                'value' => $model->trohpyImage->title,
            ],
        ],
    ]) ?>

</div>
