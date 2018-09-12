<?php
namespace app\components;


use Yii;
use yii\base\Component;
use common\models\Agent;
use yii\base\InvalidConfigException;
 
class AgentRate extends Component
{
	public function welcome()
	{
	  echo "Hello..Welcome to MyComponent";
	}

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

			$sql = "SELECT AgentID,DNIS, sum(if(LastState=19 or LastState=16 or (LastState=17 and Transfer!=1),1,0)) as offered, count(distinct ANI) as unani, sum(if(LastState=17 and Transfer!=1,1,0)) as ivr,sum(if(LastState=16,1,0)) as abandoned,sum(if(LastState=19,1,0)) as answered from billing_summaries where CallType='call' and Start BETWEEN 1480546800 AND 1482274799 and DNIS in (select inContactTFN from tfnMedia where mediaType in ('Business')) AND AgentID =".$agentID;

      $command = Yii::$app->db->createCommand($sql);

      $result = $command->queryAll();

	  $answeredCall = $result[0]['answered'];
	  
      $totalCall = $result[0]['offered'];
      
      return round(( $answeredCall/$totalCall ) * 100);

	}

	public function getCommunityCloseRate($agentID){

	$start_date = "1-1-".date("y")." 12:00:00";

	$start = strtotime($start_date);

	$end_date = "30-12-".date("y")." 11:59:59";

	$end = strtotime($end_date);

	$sql = "SELECT AgentID,DNIS, sum(if(LastState=19 or LastState=16 or (LastState=17 and Transfer!=1),1,0)) as offered, count(distinct ANI) as unani, sum(if(LastState=17 and Transfer!=1,1,0)) as ivr,sum(if(LastState=16,1,0)) as abandoned,sum(if(LastState=19,1,0)) as answered from billing_summaries where CallType='call' and Start >= $start AND Start < $end and DNIS in (select inContactTFN from tfnMedia where mediaType in ('Business')) AND AgentID =".$agentID;

      $command = Yii::$app->db->createCommand($sql);

      $result = $command->queryAll();

	  $answeredCall = $result[0]['answered'];

      $totalCall = $result[0]['offered'];

      return round (($answeredCall / $totalCall) * 100);

	}


 
}