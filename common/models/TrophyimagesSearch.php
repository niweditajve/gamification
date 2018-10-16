<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Trophyimages;

/**
 * TrophyimagesSearch represents the model behind the search form of `backend\models\Trophyimages`.
 */
class TrophyimagesSearch extends Trophyimages
{
    /**
     * {@inheritdoc}
     */
    
    public static function tableName()
    {
        $parent = get_parent_class();
        return $parent::tableName();
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id','game_admin_id'], 'integer'],
            [['title', 'filename', 'created_at'], 'safe'],
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
        $query = Trophyimages::find();
        
        
        if(Yii::$app->user->can('admin_cc') && ! Yii::$app->user->can('admin')){
            
            $profile = CallcenterDefine::find()
                ->select('id')
                ->where(['user_id' => Yii::$app->user->id])
                ->one();
            
            if($profile['id']){
                
                $whereCluase = array("game_admin_id"=>$profile['id']);

                $query->where($whereCluase);
                
            }
            else{
                $whereCluase = array("game_admin_id"=>5);

                $query->where($whereCluase);
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
            'created_at' => $this->created_at,
            'game_admin_id'=>$this->game_admin_id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'filename', $this->filename]);

        return $dataProvider;
    }
}
