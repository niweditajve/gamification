<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = 'Upload TFN File';
$this->params['breadcrumbs'][] = ['label' => 'TFNs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tfn-upload">

    <h1><?= Html::encode($this->title) ?></h1>
    <h4><?= Html::encode('File must be a csv formated file with the following columns...') ?></h4>  
    <h5><?= Html::encode('"description","mediaType","inContactTFN","script","transfer","percent","Report","SalesForceID","SourceID","BusinessDesignation","BusinessSourceID","Greeting"') ?></h5> 

    <?= $this->render('_uploadform', [
        'model' => $model,
    ]) ?>

</div>
