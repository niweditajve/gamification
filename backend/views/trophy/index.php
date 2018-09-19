<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TrophyimagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Trophy Images';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trophyimages-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Trophy Images', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'title',
            'filename',
           
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    
    ?>
</div>
