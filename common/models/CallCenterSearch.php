<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CallCenter;

/**
 * CallCenterSearch represents the model behind the search form about `common\models\CallCenter`.
 */
class CallCenterSearch extends CallCenter
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['RowID', 'CaseID', 'UserID', 'MediaID', 'TenantID', 'UpfrontCredit', 'VerEnabled'], 'integer'],
            [['CallCenter', 'PartnerCode', 'BPartnerCode', 'EmailDNIS', 'Aliases', 'Versions', 'VerCurrent'], 'safe'],
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
        $query = CallCenter::find();

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
            'CaseID' => $this->CaseID,
            'UserID' => $this->UserID,
            'MediaID' => $this->MediaID,
            'TenantID' => $this->TenantID,
            'UpfrontCredit' => $this->UpfrontCredit,
            'VerEnabled' => $this->VerEnabled,
        ]);

        $query->andFilterWhere(['like', 'CallCenter', $this->CallCenter])
            ->andFilterWhere(['like', 'PartnerCode', $this->PartnerCode])
            ->andFilterWhere(['like', 'BPartnerCode', $this->BPartnerCode])
            ->andFilterWhere(['like', 'EmailDNIS', $this->EmailDNIS])
            ->andFilterWhere(['like', 'Aliases', $this->Aliases])
            ->andFilterWhere(['like', 'Versions', $this->Versions])
            ->andFilterWhere(['like', 'VerCurrent', $this->VerCurrent]);

        return $dataProvider;
    }
}
