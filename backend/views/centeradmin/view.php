<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\FrontendCallcenterDefine */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Dashboard admin', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->callCenter->TenantLabel;
?>
<div class="frontend-callcenter-define-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php /* Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) */ ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            
            [
                'attribute' => 'Call Center',
                'value' => $model->callCenter->TenantLabel,
            ],
            [
                'attribute' => 'User(s)',
                'format' => 'html',
                'value' => function ($data) {
                    if(!empty($data->user_id)){
                    
                        $users = json_decode($data->user_id);

                        $return = '';
                        foreach($users as $user){

                            $userDetail = \common\models\User::find()->select("username,email")->where(["id" => $user])->one();
                            $return .=$userDetail['username'];
                            $return .=", ".$userDetail['email'];
                            $return .="<br>";
                        }

                    return $return;
                   }else{
                       
                      return "";
                      
                   }
                   
               }
            ],
        ],
    ]) ?>

</div>
