<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TFNList */

$this->title = 'Create Tfnlist';
$this->params['breadcrumbs'][] = ['label' => 'Tfnlists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tfnlist-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
