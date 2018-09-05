<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Agent */

$this->title = 'Update Agent: ' . $model->AgentID;
$this->params['breadcrumbs'][] = ['label' => 'Agents', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->AgentID, 'url' => ['view', 'id' => $model->AgentID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="agent-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
