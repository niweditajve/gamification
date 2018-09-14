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
                ->select('AgentID')
                     ->where(['Login' => Yii::$app->user->identity->email])
                ->one();

        if($agent)
        	return $agent['AgentID'];
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
                $startEnd = " AND CreateDate >= '".$this->startTime()."' AND CreateDate < '".$this->endTime()."'";
            else
                $startEnd = " AND CreateDate >= '".$this->startTime()."' AND CreateDate < '".$this->endTime()."' AND AgentID =".$agentID;

            $sql = "SELECT sum(if(`EmailAddress`,1,0)) as emails FROM `calldata` WHERE `EmailAddress` NOT LIKE '%@hughes.com%'". $startEnd;

            $command = Yii::$app->db->createCommand($sql);

            $result = $command->queryAll();

            $validEmails = $result[0]['emails'];

            return $validEmails;
	}


	public function getValidPhoneCollection($skillType,$agentID,$community=null){
            
            if($community)
                $startEnd = " WHERE CreateDate >= '".$this->startTime()."' AND CreateDate < '".$this->endTime()."'";
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
                $startEnd = " CreateDate >= '".$this->startTime()."' AND CreateDate < '".$this->endTime()."'";
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



 
}