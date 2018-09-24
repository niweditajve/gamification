<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "gamification_agentcertificates".
 *
 * @property int $id
 * @property int $agent_id
 * @property double $agent_points
 * @property int $certificate_id
 * @property string $certificate_name
 * @property double $certificate_point
 */
class Agentcertificates extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gamification_agentcertificates';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['agent_id', 'agent_points', 'certificate_id', 'certificate_name', 'certificate_point'], 'required'],
            [['agent_id', 'certificate_id'], 'integer'],
            [['agent_points', 'certificate_point'], 'number'],
            [['certificate_name'], 'string', 'max' => 255],
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
            'agent_points' => 'Agent Points',
            'certificate_id' => 'Certificate ID',
            'certificate_name' => 'Certificate Name',
            'certificate_point' => 'Certificate Point',
        ];
    }
}
