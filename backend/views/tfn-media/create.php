<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\TfnMedia */

$this->title = 'Create Tfn Media';
$this->params['breadcrumbs'][] = ['label' => 'Tfn Media', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tfn-media-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
