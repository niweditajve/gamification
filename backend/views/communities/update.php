<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Community */

$this->title = 'Update Community Define: ' . $model->skill;
$this->params['breadcrumbs'][] = ['label' => 'Community Define', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->skill, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="community-update">

    <h1><?= Html::encode($this->title) ?></h1>
    
   <?php echo "<h4>".$model->gameAdmin['title']."</h4>"; ?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
