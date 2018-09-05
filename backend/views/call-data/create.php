<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CallData */

$this->title = 'Create Call Data';
$this->params['breadcrumbs'][] = ['label' => 'Call Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="call-data-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
