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
    
    $sourceIds = json_decode($model->sales_source_Id);
    $sourceIds = (array)$sourceIds;
    
    
    $allSourceID = array(
                        "Business" => 
                        // Source ID's for Business
                            array("98055", "98237", "98223", "98219", "98214"),
                        "Consumer" =>
                        // Source ID's for Consumer
                            array("91505", "92323", "91851" ,"92152", "92019"),
                        "Dealer" => 
                        // Source ID's for Dealer
                            array("91505", "92323", "91851" ,"92152", "92019")
                        );
    
    $availableSourceIds = $allSourceID[$model->skill];
    
    echo '<label class="control-label" for="categories-title">Source ID</label>';
   
    echo '<div class="form-group">';
    
    foreach($availableSourceIds as $key ){
        
        $checked = "";
        
        if(in_array($key, $sourceIds)){
            
            $checked = "checked";
            
        }
        echo  '<div class="abd"><label class="community-label">' . $key .'</label>';
		
		echo '<input class="form-control community-checkbox" type="checkbox" name="sourceid[]" value="'.$key.'" '.$checked.'> </div> ';
        
    }
    echo '</div>';
    
    ?>
    
    <div class="help-block"></div>
    
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success button-community']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
