<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Community */

$this->title = $model->skill;
$this->params['breadcrumbs'][] = ['label' => 'Community Define', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="community-view">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?php
    
    $sourceIds = json_decode($model->salesSourceId);
    
    echo "<h4>".$model->gameAdmin['title']."</h4>";
    
    echo "<h5>Source Ids</h5>";
    
    if($sourceIds){
        
        foreach($sourceIds as $key){
            
            echo "<div class='community-list'>" . $key . "</div>";
            
        }
    }
    
    ?>

</div>
