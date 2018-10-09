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
use common\models\Skills;
use common\models\Agentcertificates;

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
     * Get statement for selecting values from database used in actionCheckforupdate().
     * @param integer $catId the Category id.
     * @return string Exit code
     */

    public function getSelectStatement($catId) {
        $str = '';
        switch ($catId) {
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
            case "16":
                $str = "sum(if(OrderID !='',1,0))";
                return $str;
            default:
                return $str;
        }
    }
    
    /**
     * check for points to be updated in agentpoints tables on hourly basis.
     * @param
     * @return 
     */
    public function actionCheckforupdate() {

        $records = Categories::find()->all();
                
        $skills = array("Business","Consumer","Dealer");
        
        foreach ($records as $key) {
            
            $categoryId = $key['id'];            
            
            $pointValue = $key['point'];

            $selectStatement = $this->getSelectStatement($categoryId);
            

            $query = "SELECT count(RowID) as totalOrders, AgentID ,$selectStatement as answered"
                    . " FROM `callData` WHERE AgentID !=0 "
                    . "AND CreateDate >= '" . date('Y-m-d h') . ":00:00' AND CreateDate < '" . date('Y-m-d h') . ":59:59'"
                    . "";

             if ($categoryId == "2") {
                $query .= " AND MediaType = 'Broadcast'";
            }

            if ($categoryId == "3") {
                $query .= " AND MediaType = 'Campaigns'";
            }

            if ($categoryId == "4") {
                $query .= " AND MediaType = 'Web'";
            }

            if ($categoryId == "5") {
                $query .= " AND DispositionCode IN ('Transfer to Business','Transfer to Government','Transfer to Enterprise','Transfer to Consumer','Transfer To Another Business Agent')";
            }
            
            $queryCommand = Yii::$app->db->createCommand($query);
            
            $result = $queryCommand->queryAll(); 

             foreach ($result as $resultKey) {

                $AgentID = $resultKey['AgentID'];

                $answered = $resultKey['answered'];

                $totalOrders = $resultKey['totalOrders'];

                $agentrate = ($answered && $totalOrders) ? number_format((float) ( ( ($answered / $totalOrders) * 100)), 2, '.',',') : 0;
                

                if ($agentrate) {
                   
                    foreach($skills as $skillKey){
                        
                        $communities = $this->getCommunity($skillKey);
                        
                        $communityQuery = "SELECT count(RowID) as totalOrders, AgentID ,$selectStatement as answered"
                            . " FROM `callData` WHERE "
                            . "CreateDate >= '" . date('Y-m-d h') . ":00:00' AND CreateDate < '" . date('Y-m-d h') . ":59:59'";
                        
                        if($communities){
                            $communityQuery .=" AND DomainCode in(" . $communities . ") ";
                        }

                        $communityCommand = Yii::$app->db->createCommand($communityQuery);

                        $communityResult = $communityCommand->queryAll();

                        $communityAnswered = $communityResult[0]['answered'];

                        $communityTotalOrders = $communityResult[0]['totalOrders'];

                        $communityRate = number_format((float)( ($communityAnswered / $communityTotalOrders) * 100), 2, '.',',');

                        if ($agentrate > $communityRate){
                            
                            $this->updateAgentPoint($AgentID, $categoryId, $pointValue);
                        }
                            
                        
                    }

                    
                }
            } 
        }
    }
    
    /**
     * get list of communities based on skill type actionCheckforupdate().
     * @param string $skillType.
     * @return  array of communities.
     */
    public function getCommunity($skillType) {

        $skills = Skills::find()->where(["skill" => $skillType])->one();

        $skillArray = json_decode($skills['salesSourceId']);

        return implode(",", $skillArray);
    }
    
    /**
     * Update agentpoints table.
     * @param integer $agentID,integer $cat_id,integer $point.
     * @return 
     */
    public function updateAgentPoint($agentID, $cat_id, $point) {

        $agentPoints = new Agentpoints();
        $agentPoints->agentId = $agentID;
        $agentPoints->category_id = $cat_id;
        $agentPoints->point = $point;
        $agentPoints->created_at = date("Y-m-d h:i:s");

        if ($agentPoints->save()) {
            return $agentPoints;
        }
    }
    
    /**
     * Check for certificates achieved by an agent.
     * @param.
     * @return 
     */
    public function actionAgentcertificate() {

        $dateCondition = "created_at >= '" . date('Y-m-d') . " 00:00:00' AND created_at < '" . date('Y-m-d') . " 11:59:59'";

        $sql = "SELECT sum(point) as points,agentId FROM `gamification_agentpoints` WHERE $dateCondition GROUP BY AgentID ";

        $queryCommand = Yii::$app->db->createCommand($sql);

        $result = $queryCommand->queryAll();

        foreach ($result as $key) {

            $query = new \yii\db\Query;

            $query->select(['gamification_certificates.id', 'gamification_certificates.trohpy_image_id', 'gamification_certificates.point', 'gamification_trophyimages.title'])
                    ->from('gamification_certificates')
                    ->leftJoin('gamification_trophyimages', 'gamification_trophyimages.id = gamification_certificates.trohpy_image_id')
                    ->where('gamification_certificates.point <= :points', [':points' => $key['points']]);

            $command = $query->createCommand();

            $data = $command->queryAll();

            if (count($data) > 0) {

                foreach ($data as $dataKey) {

                    $certificate_id = $dataKey['id'];
                    $agent_id = $key['agentId'];
                    $agent_points = $key['points'];
                    $certificate_point = $dataKey['point'];
                    $certificate_name = $dataKey['title'];

                    $certificate = new Agentcertificates;
                    $certificate->agent_id = $agent_id;
                    $certificate->agent_points = $agent_points;
                    $certificate->certificate_id = $certificate_id;
                    $certificate->certificate_name = $certificate_name;
                    $certificate->certificate_point = $certificate_point;
                    $certificate->save();
                }
            }
        }
    }

}
