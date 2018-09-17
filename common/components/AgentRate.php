<?php
namespace common\components;

use Yii;
use yii\base\Component;
use common\models\Agent;
use yii\base\InvalidConfigException;
 
class AgentRate extends Component
{

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

	public function getTodaysCloseRate($skillType,$agentID){

		$sql = "SELECT sum(if(LastState=19 or LastState=16 or (LastState=17 and Transfer!=1),1,0)) as offered,sum(if(LastState=19,1,0)) as answered from billing_summaries where Start = CURDATE() AND LastQueue = '".$skillType."'  AND AgentID =".$agentID;

		$command = Yii::$app->db->createCommand($sql);

		$result = $command->queryAll();

		$answeredCall = $result[0]['answered'];

		$totalCall = $result[0]['offered'];

		if($answeredCall && $totalCall)
			return ( $totalCall / $answeredCall);
		else
			return 0;

	}

	public function startTimestamp(){

		$start_date = "1-1-".date("y")." 00:00:00";

		return $start = strtotime($start_date);
	}

	public function endTimestamp(){
		
		$end_date = "30-12-".date("y")." 11:59:59";

		return $end = strtotime($end_date);
	}

	public function startTime(){

		return $start_date = "1-1-".date("y")." 00:00:00";
	}

	public function endTime(){
		
		return $end_date = "30-12-".date("y")." 11:59:59";
	}

	public function getCommunityCloseRate($skillType,$agentID){

		$sql = "SELECT sum(if(LastState=19 or LastState=16 or (LastState=17 and Transfer!=1),1,0)) as offered,sum(if(LastState=19,1,0)) as answered from billing_summaries where Start >= " . $this->startTimestamp() . " AND Start < ".$this->endTimestamp() . " AND LastQueue = '".$skillType."'";

		$command = Yii::$app->db->createCommand($sql);

		$result = $command->queryAll();

		$answeredCall = $result[0]['answered'];

		$totalCall = $result[0]['offered'];

		if($answeredCall && $totalCall)
			return ($totalCall/$answeredCall);
		else
			return 0;

	}

	public function closeRate($skillType,$agentID,$onBehalf,$community=null){

            if($community)
                $startEnd = " Start >= ".$this->startTimestamp()." AND Start < ".$this->endTimestamp();
            else
                $startEnd = " Start BETWEEN 1480546800 AND 1482274799 AND AgentID =".$agentID;

            $mediaType = $this->getRateText($onBehalf);

            $sql = "SELECT sum(if(LastState=19 or LastState=16 or (LastState=17 and Transfer!=1),1,0)) as offered,sum(if(LastState=19,1,0)) as answered from billing_summaries where $startEnd and DNIS in (select inContactTFN from tfnMedia where mediaType in ($mediaType)) AND LastQueue = '".$skillType."' ";

            $command = Yii::$app->db->createCommand($sql);

            $result = $command->queryAll();

            $answeredCall = $result[0]['answered'];

            $totalCall = $result[0]['offered'];

            if($answeredCall && $totalCall)
                return ( $totalCall / $answeredCall);
            else
                return 0;

	}

	public function getRateText($onBehalf){

            $str = "";

            switch($onBehalf){
                case "TV":
                    $str = "'Broadcast','Broadcast2'";
                    return $str;
                case "directMail":
                    $str = "'Campaigns','Direct Mail'";
                    return $str;
                case "web":
                    $str = "'Web','Web Managed'";
                    return $str;
                case "transfer":
                    $str = "'Callback','Other'";
                    return $str;
                default:
                    return $str;	
            }

	}

	public function getValidEmailCollection($skillType,$agentID,$community=null){

            if($community)
                $startEnd = " AND CreateDate >= '".$this->startTime()."' AND CreateDate < '".$this->endTime()."' AND AgentID in(SELECT AgentID FROM tblagent WHERE ParentTenantID = $community)";
            else
                $startEnd = " AND CreateDate >= '".$this->startTime()."' AND CreateDate < '".$this->endTime()."' AND AgentID =".$agentID;

            $sql = "SELECT sum(if(`EmailAddress`,1,0)) as emails FROM `calldata` WHERE `EmailAddress` NOT LIKE '%@hughes.com%'". $startEnd;

            $command = Yii::$app->db->createCommand($sql);

            $result = $command->queryAll();

            $validEmails = $result[0]['emails'];

            return $validEmails ? $validEmails : 0;
	}


	public function getValidPhoneCollection($skillType,$agentID,$community=null){
            
            if($community)
                $startEnd = " WHERE CreateDate >= '".$this->startTime()."' AND CreateDate < '".$this->endTime()."' AND AgentID in(SELECT AgentID FROM tblagent WHERE ParentTenantID = $community)";
            else
                $startEnd = " WHERE CreateDate >= '".$this->startTime()."' AND CreateDate < '".$this->endTime()."' AND AgentID =".$agentID;

            $sql = "SELECT sum(if(`PhoneNumber` and `PhoneNumber` REGEXP '[0-9]{10}',1,0)) as phones FROM `callData`".$startEnd;

            $command = Yii::$app->db->createCommand($sql);

            $result = $command->queryAll();

            $validPhones = $result[0]['phones']; echo " ";

            if($validPhones)
                return $validPhones;
            else
                return 0;
	}
        
        
        public function getVoiceAttachement($skillType,$agentID,$community=null){

            if($community)
                $startEnd = " CreateDate >= '".$this->startTime()."' AND CreateDate < '".$this->endTime()."' AND AgentID in(SELECT AgentID FROM tblagent WHERE ParentTenantID = $community)";
            else
                $startEnd = " CreateDate >= '".$this->startTime()."' AND CreateDate < '".$this->endTime()."' AND AgentID =".$agentID;

            $sql = "SELECT sum(if(OfferedProducts like '%VoIP%',1,0)) as vpoffered, sum(if(VoIP='VoIP Domestic Business - 1 Year Commitment',1,0)) as voip1,
                        sum(if(VoIP='VoIP Domestic - 2 Year Commitment',1,0)) AS voip2,
                        sum(if(VoIP='VoIP Domestic - No Commitment',1,0)) AS voip3 FROM calldata WHERE ".$startEnd;

            $command = Yii::$app->db->createCommand($sql);

            $result = $command->queryAll();
            
            $totalOrder = $result[0]['vpoffered'];
            
            $order = $result[0]['voip1'] + $result[0]['voip2'] + $result[0]['voip3'];
 
            if($totalOrder && $order)
                return ($totalOrder/$order);
            else
                return 0;

	}

        public function getColor($type,$value){
            
            if( $value >=0 && $value < 30)
                return "red";
            elseif($value >= 30 && $value < 60)
                return "yellow";
            elseif($value >= 60)
                return "green";
        }
        
        public function getExpRepairSold($skillType,$agentID,$community=null){
            
            if($community)
            {
                $startEnd = " CreateDate >= '".$this->startTime()."' AND CreateDate < '".$this->endTime()."' AND AgentID in(SELECT AgentID FROM tblagent WHERE ParentTenantID = $community) AND ExpRepairSold != ''";
            }
            else
                $startEnd = " CreateDate >= 'CURDATE() 00:00:00' AND CreateDate < 'CURDATE() 11:59:59' AND AgentID =".$agentID ." AND ExpRepairSold != ''";

            $sql = "SELECT sum(if(ExpRepairSold like 'Y',1,0)) as exp, sum(RowID) AS totalOrders FROM calldata WHERE ".$startEnd;

            $command = Yii::$app->db->createCommand($sql);

            $result = $command->queryAll();
            
            $exp = $result[0]['exp'];
            
            $totalOrders = $result[0]['totalOrders'];
            
            if($totalOrders && $exp)
                return ($totalOrders/$exp);
            else
                return 0;
            
        }
        
        public function getPCESold($skillType,$agentID,$community=null){
            
            if($community)
            {
                $startEnd = " CreateDate >= '".$this->startTime()."' AND CreateDate < '".$this->endTime()."' AND AgentID in(SELECT AgentID FROM tblagent WHERE ParentTenantID = $community) AND PCESold != ''";
            }
            else
                $startEnd = " CreateDate >= 'CURDATE() 00:00:00' AND CreateDate < 'CURDATE() 11:59:59' AND AgentID =".$agentID ." AND PCESold != ''";

            $sql = "SELECT sum(if(PCESold like 'Y',1,0)) as exp, sum(RowID) AS totalOrders FROM calldata WHERE ".$startEnd;

            $command = Yii::$app->db->createCommand($sql);

            $result = $command->queryAll();
            
            $exp = $result[0]['exp'];
            
            $totalOrders = $result[0]['totalOrders'];
            
            if($totalOrders && $exp)
                return ($totalOrders/$exp);
            else
                return 0;
            
        }
        
        
        public function getNortonSold($skillType,$agentID,$community=null){
            
            if($community)
            {
                $startEnd = " CreateDate >= '".$this->startTime()."' AND CreateDate < '".$this->endTime()."' AND AgentID in(SELECT AgentID FROM tblagent WHERE ParentTenantID = $community) AND NortonSold != ''";
            }
            else
                $startEnd = " CreateDate >= 'CURDATE() 00:00:00' AND CreateDate < 'CURDATE() 11:59:59' AND AgentID =".$agentID ." AND NortonSold != ''";

            $sql = "SELECT sum(if(NortonSold like 'Y',1,0)) as exp, sum(RowID) AS totalOrders FROM calldata WHERE ".$startEnd;

            $command = Yii::$app->db->createCommand($sql);

            $result = $command->queryAll();
            
            $exp = $result[0]['exp'];
            
            $totalOrders = $result[0]['totalOrders'];
            
            if($totalOrders && $exp)
                return ($totalOrders/$exp);
            else
                return 0;
            
        }
        
        public function getscheduleInstallCollection($skillType,$agentID,$community=null){
            if($community)
            {
                $startEnd = " CreateDate >= '".$this->startTime()."' AND CreateDate < '".$this->endTime()."' AND AgentID in(SELECT AgentID FROM tblagent WHERE ParentTenantID = $community)";
            }
            else
                $startEnd = " CreateDate >= 'CURDATE() 00:00:00' AND CreateDate < 'CURDATE() 11:59:59' AND AgentID =".$agentID ." ";

            $sql = "SELECT sum(if(ScheduleAttempted like '1',1,0)) as exp, sum(RowID) AS totalOrders FROM calldata WHERE ".$startEnd;

            $command = Yii::$app->db->createCommand($sql);

            $result = $command->queryAll();
            
            $exp = $result[0]['exp'];
            
            $totalOrders = $result[0]['totalOrders'];
            
            if($totalOrders && $exp)
                return ($totalOrders/$exp);
            else
                return 0;
        }
        
        public function getCurrentConnection($skillType,$agentID,$community=null){
            if($community)
            {
                $startEnd = " CreateDate >= '".$this->startTime()."' AND CreateDate < '".$this->endTime()."' AND AgentID in(SELECT AgentID FROM tblagent WHERE ParentTenantID = $community) AND Connection != ''";
            }
            else
                $startEnd = " CreateDate >= 'CURDATE() 00:00:00' AND CreateDate < 'CURDATE() 11:59:59' AND AgentID =".$agentID ." AND Connection != ''";

            $sql = "SELECT sum(if(Connection NOT LIKE 'no internet',1,0)) as exp, sum(RowID) AS totalOrders FROM calldata WHERE ".$startEnd;

            $command = Yii::$app->db->createCommand($sql);

            $result = $command->queryAll();
            
            $exp = $result[0]['exp'];
            
            $totalOrders = $result[0]['totalOrders'];
            
            if($totalOrders && $exp)
                return ($totalOrders/$exp);
            else
                return 0;
        }


 
}