<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "gamification_agentlastlogin".
 *
 * @property int $id
 * @property int $agent_id
 * @property string $hit_time
 */
class Agentlastlogin extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gamification_agentlastlogin';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['agent_id', 'hit_time'], 'required'],
            [['agent_id'], 'integer'],
            [['hit_time'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'agent_id' => 'Agent ID',
            'hit_time' => 'Hit Time',
        ];
    }
}
