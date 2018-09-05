<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\CallData */

$this->title = "ANI: " . $model->OriginalANI; //'Jacada Link';
$this->params['breadcrumbs'][] = ['label' => 'Call Data', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="call-data-viewjacada">

    <h1>Script Link...</h1>

    <h3>
        <?php
        if ($scripturl === 'Call Not Found') {
            echo "Sorry, call not found on inContact's Active Users list.";
        } else {
            echo Html::a('Pop New Script for ANI ' . $model->OriginalANI, $scripturl, ['target' => 'blank']);
        }
        ?>
    </h3>


</div>
