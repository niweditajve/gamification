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
use yii\web\NotFoundHttpException;


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

    public function actionCheckforupdate(){

    	$sql = "SELECT sum(RowID) as totalOrders, AgentID ,(sum(RowID) DIV sum(if(VoIPSold like 'Y',1,0))) as voice,"
                . " ( sum(RowID) DIV sum(if(ExpRepairSold like 'Y',1,0))) as exp,"
                . " ( sum(RowID) DIV sum(if(NortonSold like 'Y',1,0))) as norton,"
                . " ( sum(RowID) DIV sum(if(PCESold like 'Y',1,0))) as pce, "
                . " ( sum(RowID) DIV sum(if(`EmailAddress` AND `EmailAddress` NOT LIKE '%@hughes.com%',1,0))) as email,"
                . " ( sum(RowID) DIV sum(if(`PhoneNumber` and `PhoneNumber` REGEXP '[0-9]{10}',1,0))) as phones,"
                . " ( sum(RowID) DIV sum(if(ScheduleAttempted like '1',1,0))) as ScheduleAttempted ,"
                . " ( sum(RowID) DIV sum(if(Connection != '',1,0))) as connection FROM `calldata` WHERE AgentID !=0 "
                //. "AND CreateDate >= 'CURDATE() 00:00:00' AND CreateDate < 'CURDATE() 11:59:59'"
                . " GROUP BY AgentID";
            
        $command = Yii::$app->db->createCommand($sql);

        $result = $command->queryAll();
        
        echo '<pre>';
        
        $data = array();
        
        
        print_r($result);
        
    }
    
}
