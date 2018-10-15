<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Categories */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="categories-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'title')->textInput() ?>
    
    <?= $form->field($model, 'point')->textInput() ?>
    
    <?= $form->field($model, 'red_cut_off')->textInput(['id'=>'redCutOff']) ?>
    
    <?= $form->field($model, 'yellow_cut_off')->textInput(['id'=>'yellowCutOff']) ?>
    
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>
                    Red Color Bar Range
                </th>
                <th>
                    Yellow Color Bar Range
                </th>
                <th>
                    Green Color Bar Range
                </th>
            </tr>
        </thead>
        <tbody class="color-bar">
            
        </tbody>
    </table>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script>

    // detect the change
$('input#redCutOff').bind("keyup",function() { 
    updateTable();
    
});


$('input#yellowCutOff').bind("keyup",function() { 
    updateTable();
   
});


function updateTable(){
    var redCutOffVal = $("#redCutOff").val();
    var yellowCutOff = $("#yellowCutOff").val();
    
    var redInc = parseInt(redCutOffVal) + 1;
    var yellowInc = parseInt(yellowCutOff) + 1;
    var str = '';
    
    str +="<tr>";
    str +="<td>";
    str += "0% - "+redCutOffVal+"%";
    str +="</td>";
    str +="<td>";
    str +=redInc+"% - "+yellowCutOff+"%";
    str +="</td>";
    str +="<td>";
    str +=yellowInc+"% - 100%";
    str +="</td>";
    str +="</tr>";
    
    $(".color-bar").html(str);
}

$( document ).ready(function() {
    updateTable();
});
    </script>