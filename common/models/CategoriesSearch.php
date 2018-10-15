<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Categories;

/**
 * categoriesSearch represents the model behind the search form of `backend\models\Categories`.
 */
class CategoriesSearch extends Categories
{
    /**
     * {@inheritdoc}
     */
    
    public static function tableName()
    {
        $parent = get_parent_class();
        return $parent::tableName();
    }
    
    
    public function rules()
    {
        return [
            [['id','callcenter_define_id'], 'integer'],
            [['title', 'created_at', 'updated_at'], 'safe'],
            [['point'], 'number'],
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
        $query = Categories::find();
        
        if(Yii::$app->user->can('admin_cc') && ! Yii::$app->user->can('admin')){
            
            $profile = CallcenterDefine::find()
                ->select('id')
                ->where(['user_id' => Yii::$app->user->id])
                ->one();
            
            if($profile['id']){
                
                $whereCluase = array("callcenter_define_id"=>$profile['id']);

                $query->where($whereCluase);
                
            }
            else{
                $whereCluase = array("callcenter_define_id"=>5);

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
            'point' => $this->point,
            'callcenter_define_id'=>$this->callcenter_define_id,
            
        ]);

        $query->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }
}
