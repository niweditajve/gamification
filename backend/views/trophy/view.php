<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Trophyimages */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Trophy Images', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trophyimages-view">

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
            
            'title',
                       
                [
                    'attribute'=>'Trophy',
                    'value'=> Yii::$app->urlManagerF->createUrl('') .'images/slider' ."/". $model->filename,
                    'format' => ['image',['width'=>'100','height'=>'100']],
                 ],
            
        ],
    ]) ?>
</div>
