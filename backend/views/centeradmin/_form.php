<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\FrontendCallcenterDefine */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="frontend-callcenter-define-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tenant_id')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput() ?>
    
    <div clas="row">
        <div class="col-md-6">
            <h4>Select Users</h4>
        <table class="table table-striped table-bordered">
            <thead>            
                <tr>
                    <th>
                        User
                    </th>
                    <th>
                        Action
                    </th>
                </tr>
            </thead>
            <tbody id="user_list">
                    
            </tbody>
        </table>
        </div>
        <div class="col-md-6">
            <h4>Selected Users</h4>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>
                            User
                        </th>
                        <th>
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody id="selected_users">
                    <tr id="addr0"></tr>
                </tbody>
        </table>
        </div>
    </div>
    <input type="hidden" name="checkUsers" id="checkUsers" value="" />

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>
    var checkUsers = [];
    function showResult(){
        
        var url='<?= Yii::$app->urlManager->createUrl('') ?>/centeradmin/showusers';

        $.post(url,{ },
        function(data){
            var users = JSON.parse(data);
           
            var tbody ='';
            users.forEach(function(user){
                
                tbody +="<tr id='user"+user.id+"'> <td>";
                tbody +=user.email;
                tbody +="</td>";
                tbody +="<td>";
                tbody +="<a href='javascript:addUser("+user.id+",\""+user.email+"\");'>Add</a>";
                tbody +="</td>";
                tbody +="</td> </tr> "; 
            });
            $("#user_list").html(tbody);
        });
    }
    var v = 0;
    function addUser(id,email){
        var index = checkUsers.indexOf(id);
        if (index > -1) {
          alert(id + " is already added.");
          return false;
        }
        
        $('#addr'+v).html( "<td>"+ email + "</td><td><a href='javascript: delete_row("+v+",\""+id+"\");'> Remove</a></td>" );
		
	$('#selected_users').append('<tr id="addr'+(v+1)+'"></tr>');
        
        remove_user(id);
                
        checkUsers.push(id);
        
	$("#checkUsers").val(JSON.stringify(checkUsers));
        
	v++;
    }

    function remove_user(id){
	$("#user"+(id)).hide();
    }
    
    
    
    function delete_row(v,id)
    {
        
        $("#addr"+(v)).html('');
        $("#user"+(id)).show();
        
        var index = checkUsers.indexOf(parseInt(id));
        
        console.log(index);
        if (index > -1) {
          checkUsers.splice(index, 1);
        }
        
       $("#checkUsers").val(JSON.stringify(checkUsers));
    }
        
    $(document).ready(function(e){
        
        showResult();
        
    });
</script>