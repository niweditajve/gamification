<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */
//namespace app\commands;

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use common\models\Agentpoints;
use common\models\Categories;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AgentpointsController extends Controller {

    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     * @return int Exit code
     */
    public function actionIndex($message = 'hello world') {
        echo $message . "\n";

        return ExitCode::OK;
    }
    
    public function getSelectStatement($catId){
        
        switch($catId){
                case "2":
                    $str = "sum(if(OrderID !='',1,0))";
                    return $str;
                case "3":
                    $str = "sum(if(OrderID !='',1,0))";
                    return $str;
                case "4":
                    $str = "sum(if(OrderID !='',1,0))";
                    return $str;
                case "5":
                    $str = "sum(if(OrderID !='',1,0))";
                    return $str;
                case "6":
                    $str = "sum(if(VoIPSold like 'Y',1,0))";
                    return $str;
                case "7":
                    $str = "sum(if(ExpRepairSold like 'Y',1,0))";
                    return $str;
                case "8":
                    $str = "sum(if(NortonSold like 'Y',1,0))";
                    return $str;
                case "9":
                    $str = "sum(if(PCESold like 'Y',1,0))";
                    return $str;
                case "10":
                    $str = "sum(if(`EmailAddress` != '' AND `EmailAddress` NOT LIKE '%@hughes.com%',1,0))";
                    return $str;
                case "11":
                    $str = "sum(if(`PhoneNumber` and `PhoneNumber` REGEXP '[0-9]{10}',1,0))";
                    return $str;
                case "12":
                    $str = "sum(if(ScheduleAttempted like '1',1,0))";
                    return $str;
                case "13":
                    $str = "sum(if(Connection != '',1,0))";
                    return $str;
                case "14":
                    $str = "sum(if(OrderID !='',1,0))";
                    return $str;
                case "15":
                    $str = "sum(if(OrderID !='',1,0))";
                    return $str;
                default:
                    return $str;	
            }
    }

    public function actionCheckforupdate(){
        
        $records = Categories::find()->all();
        
        foreach($records as $key)
        {
            $categoryId = $key['id'];
            
            $pointValue = $key['point'];
            
            $selectStatement = $this->getSelectStatement($categoryId);
            
           $query = "SELECT sum(RowID) as totalOrders, AgentID ,$selectStatement as answered"
                . " FROM `calldata` WHERE AgentID !=0 "
                . "AND CreateDate >= '".date('Y-m-d h').":00:00' AND CreateDate < '".date('Y-m-d h').":59:59'"
                ."";
           
            $queryCommand = Yii::$app->db->createCommand($query);

            $result = $queryCommand->queryAll();

           
            $AgentID= $result[0]['AgentID'];
            $answered= $result[0]['answered'];

            if($answered)
                $this->updateAgentPoint($AgentID,$categoryId,$pointValue);
        }
        
    }
    
    public function updateAgentPoint($agentID,$cat_id,$point){
        
        $agentPoints = new Agentpoints();
        $agentPoints->agentId = $agentID;
        $agentPoints->category_id = $cat_id;
        $agentPoints->point = $point;
        $agentPoints->created_at = date("Y-m-d h:i:s");
        
        if ($agentPoints->save()) {
            return $agentPoints;
        }
    }
    
    public function get(){
        $sql = "SELECT sum(RowID) as totalOrders, AgentID ,(sum(RowID) DIV sum(if(VoIPSold like 'Y',1,0))) as voice,"
                . " ( sum(RowID) DIV sum(if(ExpRepairSold like 'Y',1,0))) as exp,"
                . " ( sum(RowID) DIV sum(if(NortonSold like 'Y',1,0))) as norton,"
                . " ( sum(RowID) DIV sum(if(PCESold like 'Y',1,0))) as pce, "
                . " ( sum(RowID) DIV sum(if(`EmailAddress` AND `EmailAddress` NOT LIKE '%@hughes.com%',1,0))) as email,"
                . " ( sum(RowID) DIV sum(if(`PhoneNumber` and `PhoneNumber` REGEXP '[0-9]{10}',1,0))) as phones,"
                . " ( sum(RowID) DIV sum(if(ScheduleAttempted like '1',1,0))) as ScheduleAttempted ,"
                . " ( sum(RowID) DIV sum(if(Connection != '',1,0))) as connection FROM `calldata` WHERE AgentID !=0 v"
                //. "AND CreateDate >= 'CURDATE() 00:00:00' AND CreateDate < 'CURDATE() 11:59:59'"
                . " GROUP BY AgentID";
    }
    
}
