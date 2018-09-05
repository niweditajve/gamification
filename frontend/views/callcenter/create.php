<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CallCenter */

$this->title = 'Create Call Center';
$this->params['breadcrumbs'][] = ['label' => 'Call Centers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="call-center-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
