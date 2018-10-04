<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $model backend\models\Community */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="community-form">

    <?php $form = ActiveForm::begin();
    
    $sourceIds = json_decode($model->salesSourceId);
    $sourceIds = (array)$sourceIds;
    
    
    $allSourceID = array(
                        "1" => 
                        // Source ID's for Business
                            array("98055", "98237", "98223", "98219", "98214"),
                        "2" =>
                        // Source ID's for Consumer
                            array("91505", "92323", "91851" ,"92152", "92019"),
                        "3" => 
                        // Source ID's for Dealer
                            array("91505", "92323", "91851" ,"92152", "92019")
                        );
    
    $availableSourceIds = $allSourceID[$model->id];
    
    echo '<label class="control-label" for="categories-title">Source ID</label>';
   
    echo '<div class="form-group">';
    
    foreach($availableSourceIds as $key ){
        
        $checked = "";
        
        if(in_array($key, $sourceIds)){
            
            $checked = "checked";
            
        }
        echo  $key .'<input class="form-control" type="checkbox" name="sourceid[]" value="'.$key.'" '.$checked.'> ';
        
    }
    echo '</div>';
    
    ?>
    
    <div class="help-block"></div>
    
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
