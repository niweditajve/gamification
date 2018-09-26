<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Community;

/**
 * CommunitySearch represents the model behind the search form of `backend\models\Community`.
 */
class CommunitySearch extends Community
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'call_center_id', 'sales_source_id'], 'integer'],
            [['community_title'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Community::find();

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
            'id' => $this->id,
            'call_center_id' => $this->call_center_id,
            'sales_source_id' => $this->sales_source_id,
        ]);

        $query->andFilterWhere(['like', 'community_title', $this->community_title]);

        return $dataProvider;
    }
}
