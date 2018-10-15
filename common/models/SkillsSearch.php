<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Skills;

/**
 * SkillsSearch represents the model behind the search form of `backend\models\Skills`.
 */
class SkillsSearch extends Skills
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'skill','game_admin_id'], 'integer'],
            [['sales_source_Id'], 'number'],
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
        
        $query = Skills::find();
        
        if(Yii::$app->user->can('admin_cc') && ! Yii::$app->user->can('admin')){
            
            $profile = CallcenterDefine::find()
                ->select('id')
                ->where(['user_id' => Yii::$app->user->id])
                ->one();
            
            if($profile['id']){
                
                $params = array("game_admin_id"=>$profile['id']);

                $query->where($params);
                
            }
            else{
                $params = array("game_admin_id"=>5);

                $query->where($params);
            }
        }
        
        

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
            'skill' => $this->skill,
        ]);

        return $dataProvider;
    }
}
