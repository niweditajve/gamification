<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Agent;
use common\models\Agentpoints;

/**
 * AgentSearch represents the model behind the search form about `common\models\Agent`.
 */
class AgentSearch extends Agent
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['AgentID', 'TierID', 'TypeID', 'SecurityLevelID', 'Active', 'ViewID', 'BaseFolder', 'Publish', 'Reset', 'ParentTenantID', 'inContactAgent', 'inContactSuper', 'inContact', 'Five9', 'ModifiedAgent', 'CreateAgent', 'Locked', 'AmazonAgent', 'AmazonEmbedded', 'AmazonConnector', 'AbstractBuilder', 'DatabaseBuilder', 'ReportBuilder', 'inContactConnector'], 'integer'],
            [['FirstName', 'LastName', 'Login', 'Password', 'CreateDate', 'AlternateEmail', 'Phone', 'AlternatePhone', 'IMType', 'IMName', 'LastModified', 'EmailContact', 'EmaiContact', 'Groupings', 'Groups', 'LastReset'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Agent::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'AgentID' => $this->AgentID,
            'TierID' => $this->TierID,
            'TypeID' => $this->TypeID,
            'SecurityLevelID' => $this->SecurityLevelID,
            'Active' => $this->Active,
            'CreateDate' => $this->CreateDate,
            'ViewID' => $this->ViewID,
            'BaseFolder' => $this->BaseFolder,
            'Publish' => $this->Publish,
            'Reset' => $this->Reset,
            'ParentTenantID' => $this->ParentTenantID,
            'LastModified' => $this->LastModified,
            'inContactAgent' => $this->inContactAgent,
            'inContactSuper' => $this->inContactSuper,
            'inContact' => $this->inContact,
            'Five9' => $this->Five9,
            'ModifiedAgent' => $this->ModifiedAgent,
            'CreateAgent' => $this->CreateAgent,
            'LastReset' => $this->LastReset,
            'Locked' => $this->Locked,
            'AmazonAgent' => $this->AmazonAgent,
            'AmazonEmbedded' => $this->AmazonEmbedded,
            'AmazonConnector' => $this->AmazonConnector,
            'AbstractBuilder' => $this->AbstractBuilder,
            'DatabaseBuilder' => $this->DatabaseBuilder,
            'ReportBuilder' => $this->ReportBuilder,
            'inContactConnector' => $this->inContactConnector,
        ]);

        $query->andFilterWhere(['like', 'FirstName', $this->FirstName])
            ->andFilterWhere(['like', 'LastName', $this->LastName])
            ->andFilterWhere(['like', 'Login', $this->Login])
            ->andFilterWhere(['like', 'Password', $this->Password])
            ->andFilterWhere(['like', 'AlternateEmail', $this->AlternateEmail])
            ->andFilterWhere(['like', 'Phone', $this->Phone])
            ->andFilterWhere(['like', 'AlternatePhone', $this->AlternatePhone])
            ->andFilterWhere(['like', 'IMType', $this->IMType])
            ->andFilterWhere(['like', 'IMName', $this->IMName])
            ->andFilterWhere(['like', 'EmailContact', $this->EmailContact])
            ->andFilterWhere(['like', 'EmaiContact', $this->EmaiContact])
            ->andFilterWhere(['like', 'Groupings', $this->Groupings])
            ->andFilterWhere(['like', 'Groups', $this->Groups]);

        return $dataProvider;
    }
    
    
     public function searchActive($params)
    {
        $query = Agent::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'Active' => "1",
            
        ]);

        $query->andFilterWhere(['like', 'FirstName', $this->FirstName])
            ->andFilterWhere(['like', 'LastName', $this->LastName])
            ->andFilterWhere(['like', 'Login', $this->Login])
            ;
        
        return $dataProvider;
    }
    
    
    public function searchAgentCertificates($params)
    { 
        
        //echo "sdf"; exit;
        $query = Agent::find()
                ->select(["AgentID",
                    "FirstName",
                    "LastName",
                    "Login",
                    "CreateDate",
                    'points' => Agentpoints::find()
                        ->select(['AVG(point)'])
                        ->where('gamification_agentpoints.agentId = tblAgent.AgentID'),
                    //"(SELECT AVG(point) from gamification_agentpoints where gamification_agentpoints.agentId  = tblAgent.AgentID) as points"
                    ]
                    );

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        //print_r($dataProvider); exit;
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            $query->where('Active=1');
            return $dataProvider;
        }

        $query->where('Active=1');
        
        /*$query->andFilterWhere(['like', 'FirstName', $this->FirstName])
            ->andFilterWhere(['like', 'LastName', $this->LastName])
            ->andFilterWhere(['like', 'Login', $this->Login])
            ;*/
       // print_r($dataProvider); exit;
        return $dataProvider;
    }
    
}
