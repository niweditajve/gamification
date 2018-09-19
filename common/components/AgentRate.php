<?php
namespace common\components;

use Yii;
use yii\base\Component;
use common\models\Agent;
use yii\base\InvalidConfigException;
 
class AgentRate extends Component
{
        /*
         * Function Name - getAgentId()
         * Parameters used - 
         * Description - Query to find agent id of logged in user.
         * Return - Returns agentID if agent found in tblagent table else return false.
         */
	public function getAgentId(){
            
	$agent = Agent::find()
            ->select('AgentID,ParentTenantID')
            ->where(['Login' => Yii::$app->user->identity->email])
            ->one();
        
        if($agent)
        	return $agent;
        else
        	return false;

	}
        
        public function getTableName(){
           
            if($_SERVER['SERVER_NAME'])
            {
                $tablename = "calldata";
            }
            else{
                $tablename = "callData";
            }
            
            return $tablename;
        }
        
        /*
         * Function Name - getSkillCondition()
         * Parameters used - $skillType
         * Description - find condition on behalf of using $skillType value.
         * Return - Returns $str if any matches found for $skillType else return false.
         */
        public function getSkillCondition($skillType){
            $str = "";
            
            switch($skillType){
                case "Consumer":
                    $str = " AND MediaType != 'Business' AND MediaType != 'Dealer' AND MediaType != '' ";
                    return $str;
                case "Business":
                    $str = " AND MediaType = 'Business' AND MediaType != '' ";
                    return $str;
                case "Dealer SalesOnCall":
                    $str = " AND MediaType = 'Dealer' AND MediaType != '' ";
                    return $str;
                default:
                    return $str;	
            }
        }
        
        /*
         * Function Name - getCommunityCondition()
         * Parameters used - $community, $agentID
         * Description - find condition on behalf of using $community value and $agentID.
         * Return - Returns text of conditions used in query for fecthing data.
         */
        public function getCommunityCondition($community,$agentID){
            
            $startEnd = "";
            
            if($community)
                $startEnd = " CreateDate >= '".$this->startTime()."' AND CreateDate < '".$this->endTime()."' AND AgentID in(SELECT AgentID FROM tblagent WHERE ParentTenantID = $community)";
            else
                $startEnd = " CreateDate >= 'CURDATE() 00:00:00' AND CreateDate < 'CURDATE() 11:59:59' AND AgentID =".$agentID;
            
            return $startEnd;
        }
        
        /*
         * Function Name - getTodaysCloseRate()
         * Parameters used - $skillType, $agentID ,$community
         * Description - query to get today's close rate of an agent or of a community.
         * Return - Returns percentage vlaue of totalCall and answeredCall.
         */
	public function getTodaysCloseRate($skillType,$agentID,$community=null){
            
            $skillCondition = $this->getSkillCondition($skillType);
            
            $communityCondition = $this->getCommunityCondition($community,$agentID);

            $sql = "SELECT sum(if(OrderID !='',1,0)) as answered,sum(RowID) as offered FROM ".$this->getTableName()." WHERE ". $communityCondition . $skillCondition;
            
            $command = Yii::$app->db->createCommand($sql);

            $result = $command->queryAll();

            $answeredCall = $result[0]['answered'];

            $totalCall = $result[0]['offered'];

            if($answeredCall && $totalCall)
                return ( $totalCall / $answeredCall);
            else
                return 0;

	}
        
        /*
         * Function Name - startTimestamp()
         * Parameters used - 
         * Description - Get timestamp value of year start.
         * Return - Returns timestamp.
         */
	public function startTimestamp(){

		$start_date = "1-1-".date("y")." 00:00:00";

		return $start = strtotime($start_date);
	}
        
        /*
         * Function Name - endTimestamp()
         * Parameters used - 
         * Description - Get timestamp value of year end.
         * Return - Returns timestamp.
         */
	public function endTimestamp(){
		
		$end_date = "30-12-".date("y")." 11:59:59";

		return $end = strtotime($end_date);
	}
        
        /*
         * Function Name - startTime()
         * Parameters used - 
         * Description - Get date time value of start of the year.
         * Return - Returns date and time.
         */
	public function startTime(){

		return $start_date = date("Y")."-01-01 00:00:00";
	}
        
         /*
         * Function Name - endTime()
         * Parameters used - 
         * Description - Get date time value of end of the year.
         * Return - Returns date and time.
         */
	public function endTime(){
		
		return $end_date = date("Y")."-12-30 11:59:59";
	}
        
        /*
         * Function Name - closeRate()
         * Parameters used - $skillType, $agentID, $onBehalf, $community
         * Description - get close rate for agent and community.
         * Return - Returns percnetage value of totalcall and answered call.
         */
	public function closeRate($agentID,$onBehalf,$community=null){

            $mediaType = $this->getRateText($onBehalf);
            
            $communityCondition = $this->getCommunityCondition($community,$agentID);

            $sql = "SELECT sum(if(OrderID !='',1,0)) as answered,sum(RowID) as offered FROM ".$this->getTableName()." WHERE ". $communityCondition . " AND MediaType = '$mediaType'";

            $command = Yii::$app->db->createCommand($sql);

            $result = $command->queryAll();

            $answeredCall = $result[0]['answered'];

            $totalCall = $result[0]['offered'];

            if($answeredCall && $totalCall)
                return number_format((float)($totalCall/$answeredCall),2, '.', '');
            else
                return 0;

	}
        
        /*
         * Function Name - getRateText()
         * Parameters used - $onBehalf
         * Description - get condition text for closeRate() function .
         * Return - Returns text.
         */
	public function getRateText($onBehalf){

            $str = "";

            switch($onBehalf){
                case "TV":
                    $str = "Broadcast";
                    return $str;
                case "directMail":
                    $str = "Campaigns";
                    return $str;
                case "web":
                    $str = "Web";
                    return $str;
                case "transfer":
                    $str = "Broadcast";
                    return $str;
                default:
                    return $str;	
            }

	}
        
         /*
         * Function Name - getSelectColumns()
         * Parameters used - $onBehalf
         * Description - get select text for getRate() function .
         * Return - Returns text.
         */
        public function getSelectColumns($onBehalf){
            
            $str = "";

            switch($onBehalf){
                case "EmailAddress":
                    $str = "sum(if(`EmailAddress`,1,0))";
                    return $str;
                case "PhoneNumber":
                    $str = "sum(if(`PhoneNumber` and `PhoneNumber` REGEXP '[0-9]{10}',1,0))";
                    return $str;
                case "voice":
                    $str = "sum(if(VoIPSold like 'Y',1,0))";
                    return $str;
                case "ExpRepairSold":
                    $str = "sum(if(ExpRepairSold like 'Y',1,0))";
                    return $str;
                case "PCESold":
                    $str = "sum(if(PCESold like 'Y',1,0))";
                    return $str;
                case "NortonSold":
                    $str = "sum(if(NortonSold like 'Y',1,0))";
                    return $str;
                case "ScheduleAttempted":
                    $str = "sum(if(ScheduleAttempted like '1',1,0))";
                    return $str;
                case "Connection":
                    $str = "sum(if(Connection != '',1,0))";
                    return $str;
                case "CCNumber":
                    $str = "sum(if(CCNumber != '',1,0))";
                    return $str;
                default:
                    return $str;	
            }
            
        }
        
        /*
         * Function Name - getRate()
         * Parameters used - $skillType, $agentID, $onBehalf,$community
         * Description - query to find rates for an agent or for a community .
         * Return - Returns percnetage value of totalOrders and validOrders.
         */
        public function getRate($skillType,$agentID,$onBehalf,$community=null){
            
            $selectColumns = $this->getSelectColumns($onBehalf);
            
            $communityCondition = $this->getCommunityCondition($community,$agentID);
            
            $skillCondition = $this->getSkillCondition($skillType);
            
            $sql = "SELECT $selectColumns as validOrders, sum(RowID) AS totalOrders FROM ".$this->getTableName()." WHERE ". $communityCondition . $skillCondition ;
            
            if($onBehalf == "EmailAddress")
                $sql .=" AND `EmailAddress` NOT LIKE '%@hughes.com%'";
            
            if($onBehalf == "CCNumber")
                $sql .=" AND OrderID !='' ";

            $command = Yii::$app->db->createCommand($sql);

            $result = $command->queryAll();

            $validOrders = $result[0]['validOrders'];
            
            $totalOrder = $result[0]['totalOrders'];

             if($validOrders && $totalOrder)
                return number_format((float)(($totalOrder/$validOrders)),2, '.', '');
            else
                return 0;
            
        }
        
         /*
         * Function Name - getColor()
         * Parameters used - $type, $value
         * Description - Get color for bar graphs.
         * Return - Return color for bar graphs.
         */
        public function getColor($type,$value){
            
            if( $value >=0 && $value < 30)
                return "red";
            elseif($value >= 30 && $value < 60)
                return "yellow";
            elseif($value >= 60)
                return "green";
        }
        
       /*
         * Function Name - getTotalCalls()
         * Parameters used - $agentID
         * Description - Get call answered and total orders from calldata table.
         * Return - Return color for bar graphs.
         */
        public function getTotalCalls($agentID,$skillType){
            
            $skillCondition = $this->getSkillCondition($skillType);
            
            $sql = "SELECT sum(if(OrderID !='',1,0)) as answered,sum(RowID) as orders FROM ".$this->getTableName()." WHERE CreateDate >= 'CURDATE() 00:00:00' AND CreateDate < 'CURDATE() 11:59:59' AND AgentID =".$agentID . $skillCondition;

            $command = Yii::$app->db->createCommand($sql);

            $result = $command->queryAll();

            $validOrders = $result[0];
            
            return $validOrders;
            
        }
        
        /*
         * Function Name - getTotalCalls()
         * Parameters used - $agentID
         * Description - Get call answered and total orders from calldata table.
         * Return - Return color for bar graphs.
         */
        public function getTodaysPoints($agentID,$wkd = null){
            
            $dateCondition = $this->getDateCondition($wkd);
            
            $sql = "SELECT sum(point) as ponits FROM `agentpoints` WHERE $dateCondition AND AgentID =".$agentID ;

            $command = Yii::$app->db->createCommand($sql);

            $result = $command->queryAll();

            $validOrders = $result[0]['ponits'];
            
            return $validOrders;
            
        }
        
        
        public function getDateCondition($wkd){

            if(empty($wkd)){
                $text = "created_at >= '".date('Y-m-d h').":00:00' AND created_at < '".date('Y-m-d h').":59:59'";
            }
            else{
                
                $monday = strtotime("last monday");
                $monday = date('w', $monday)==date('w') ? $monday+7*86400 : $monday;

                $sunday = strtotime(date("Y-m-d",$monday)." +5 days");

                $this_week_sd = date("Y-m-d",$monday);
                $this_week_ed = date("Y-m-d",$sunday);

                $text = "created_at >= '".$this_week_sd." 00:00:00' AND created_at < '".$this_week_ed." 11:59:59'";
            }
            return $text;
        }
        
        public function getLeaderPoints(){
            
            $sql = "SELECT max(point) as maxPonits FROM `agentpoints` WHERE created_at >= '".date('Y-m-d')." 00:00:00' AND created_at < '".date('Y-m-d')." 11:59:59'" ;
            
            $command = Yii::$app->db->createCommand($sql);

            $result = $command->queryAll();

            $maxPonits = $result[0]['maxPonits'];
            
            return $maxPonits;
        }

 
}