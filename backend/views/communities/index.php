<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CommunitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Communities';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="community-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php 
        echo '<table class="table table-striped table-bordered">';
        echo '<thead>';
        echo "<tr>";
        echo "<th>#</th>";
        echo "<th>Community</th>";
        echo "<th>Action</th>";
        echo "</tr>";
        echo '</thead>';
        echo '<tbody>';
    foreach($model as $key){
       
        echo "<tr>";
        echo "<td>".$key['id']."</td>";
        echo "<td>".$key['skill']."</td>";
        echo "<td>";
        echo '<a href="/projects/gamification/backend/web/communities/view?id='.$key['id'].'" title="View" aria-label="View" data-pjax="0"><span class="glyphicon glyphicon-eye-open"></span></a>';
        echo "&nbsp;";
        echo '<a href="/projects/gamification/backend/web/communities/update?id='.$key['id'].'" title="Update" aria-label="Update" data-pjax="0"><span class="glyphicon glyphicon-pencil"></span></a>';
        echo "</td>";
        echo "</tr>";
        
    }
    echo '</tbody>';
        echo '</table>';
    ?>
    <?php /*GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'skill',
            

            ['class' => 'yii\grid\ActionColumn','template'=>'{view} {update}'],
        ],
    ]);*/ ?>
</div>
