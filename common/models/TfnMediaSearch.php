<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\TfnMedia;

/**
 * TfnMediaSearch represents the model behind the search form of `common\models\TfnMedia`.
 */
class TfnMediaSearch extends TfnMedia
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['RowID', 'Report'], 'integer'],
            [['description', 'mediaType', 'inContactTFN', 'script', 'transfer', 'percent', 'SalesForceID', 'SourceID', 'BusinessDesignation', 'BusinessSourceID', 'Greeting'], 'safe'],
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
        $query = TfnMedia::find();

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
            'RowID' => $this->RowID,
            'Report' => $this->Report,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'mediaType', $this->mediaType])
            ->andFilterWhere(['like', 'inContactTFN', $this->inContactTFN])
            ->andFilterWhere(['like', 'script', $this->script])
            ->andFilterWhere(['like', 'transfer', $this->transfer])
            ->andFilterWhere(['like', 'percent', $this->percent])
            ->andFilterWhere(['like', 'SalesForceID', $this->SalesForceID])
            ->andFilterWhere(['like', 'SourceID', $this->SourceID])
            ->andFilterWhere(['like', 'BusinessDesignation', $this->BusinessDesignation])
            ->andFilterWhere(['like', 'BusinessSourceID', $this->BusinessSourceID])
            ->andFilterWhere(['like', 'Greeting', $this->Greeting]);

        return $dataProvider;
    }
}
