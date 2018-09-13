<?php
namespace app\components;

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

	public function getTodaysCloseRate($agentID){

		$sql = "SELECT sum(if(LastState=19 or LastState=16 or (LastState=17 and Transfer!=1),1,0)) as offered,sum(if(LastState=19,1,0)) as answered from billing_summaries where Start BETWEEN 1480546800 AND 1482274799  AND AgentID =".$agentID;

		$command = Yii::$app->db->createCommand($sql);

		$result = $command->queryAll();

		$answeredCall = $result[0]['answered'];

		$totalCall = $result[0]['offered'];

		if($answeredCall && $totalCall)
			return round(( $answeredCall/$totalCall ) * 100);
		else
			return 0;

	}

	public function startTimestamp(){

		$start_date = "1-1-".date("y")." 12:00:00";

		return $start = strtotime($start_date);
	}

	public function endTimestamp(){
		
		$end_date = "30-12-".date("y")." 11:59:59";

		return $end = strtotime($end_date);
	}

	public function getCommunityCloseRate($agentID){

		$sql = "SELECT sum(if(LastState=19 or LastState=16 or (LastState=17 and Transfer!=1),1,0)) as offered,sum(if(LastState=19,1,0)) as answered from billing_summaries where Start >= ".$this->startTimestamp()." AND Start < ".$this->endTimestamp()." AND AgentID =".$agentID;

		$command = Yii::$app->db->createCommand($sql);

		$result = $command->queryAll();

		$answeredCall = $result[0]['answered'];

		$totalCall = $result[0]['offered'];

		if($answeredCall && $totalCall)
			return round (($answeredCall / $totalCall) * 100);
		else
			return 0;

	}

	public function closeRate($agentID,$onBehalf,$community=null){

		if($community)
			$startEnd = " Start >= ".$this->startTimestamp()." AND Start < ".$this->endTimestamp();
		else
			$startEnd = " Start BETWEEN 1480546800 AND 1482274799";

		$mediaType = $this->getRateText($onBehalf);

	  	$sql = "SELECT sum(if(LastState=19 or LastState=16 or (LastState=17 and Transfer!=1),1,0)) as offered,sum(if(LastState=19,1,0)) as answered from billing_summaries where $startEnd and DNIS in (select inContactTFN from tfnMedia where mediaType in ($mediaType)) AND AgentID =".$agentID;

	  	$command = Yii::$app->db->createCommand($sql);

      	$result = $command->queryAll();

	  	$answeredCall = $result[0]['answered'];

      	$totalCall = $result[0]['offered'];

      	if($answeredCall && $totalCall)
      		return round (($answeredCall / $totalCall) * 100);
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


 
}