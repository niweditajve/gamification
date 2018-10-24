<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\FrontendCallcenterDefine */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="frontend-callcenter-define-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tenant_id')->hiddenInput(['id'=>'tenant_id'])->label(false); ?>

    <?php // $form->field($model, 'user_id')->textInput() ?>
    
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
    
    function showUsers(){
        
        var tenant_id = $("#tenant_id").val();
        
        var url='<?= Yii::$app->urlManager->createUrl('') ?>/centeradmin/showusers';

        $.post(url,{ tenant_id : tenant_id },
        function(data){
            var users = JSON.parse(data);
           
            var tbody ='';
            users.forEach(function(user){
                
                tbody +="<tr id='user"+user.id+"'> <td>";
                tbody +="<strong>"+user.username +"</strong>, "+user.email;
                tbody +="</td>";
                tbody +="<td>";
                tbody +="<a href='javascript:addUser("+user.id+",\""+user.username+"\",\""+user.email+"\");'>Add</a>";
                tbody +="</td>";
                tbody +="</td> </tr> "; 
            });
            $("#user_list").html(tbody);
        });
    }
    
    var v = 0;
    
    
    function showSelectedUsers(){
        
        var tenant_id = $("#tenant_id").val();
       
        var url='<?= Yii::$app->urlManager->createUrl('') ?>/centeradmin/selelctedusers';

        $.post(url,{ tenant_id : tenant_id },
        function(data){
            var users = JSON.parse(data);
           
            var tbody ='';
            users.forEach(function(user){
                
                tbody +="<tr id='addr"+v+"'> <td>";
                tbody +="<strong>"+user.username +"</strong>, "+user.email;
                tbody +="</td>";
                tbody +="<td>";
                tbody +="<a href='javascript:delete_row("+v+",\""+user.id+"\");'>Remove</a>";
                tbody +="</td>";
                tbody +="</td> </tr> "; 
                
                v++;
                //console.log(user.id);
                checkUsers.push(parseInt(user.id));
        
                $("#checkUsers").val(JSON.stringify(checkUsers));
                
            });
            
            $("#selected_users").html(tbody);
            
            $('#selected_users').append('<tr id="addr'+(v)+'"></tr>');
            
        });
    }
    
    function addUser(id,username,email){
    
       /* var index = checkUsers.indexOf(id);
        
        if (index > -1) {
            
          alert(id + " is already added.");
          
          return false;
          
        } */
        
        $('#addr'+v).html( "<td><strong>"+username+"</strong>, "+  email + "</td><td><a href='javascript: delete_row("+v+",\""+id+"\");'> Remove</a></td>" );
		
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
        
        //var index = checkUsers.indexOf(id);
        var index = checkUsers.indexOf(parseInt(id));
       
        if (index > -1) {
            
          checkUsers.splice(index, 1);
          
        }
        
       $("#checkUsers").val(JSON.stringify(checkUsers));
       
    }
       
    $(document).ready(function(e){
        
        showUsers();
        
        showSelectedUsers();
        
    });
</script>