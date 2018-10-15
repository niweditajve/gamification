<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "gamification_skills".
 *
 * @property int $id
 * @property string $skill
 * @property string $salesSourceId
 * @property int $game_admin_id
 *
 * @property GamificationCallcenterDefine $gameAdmin
 */
class Skills extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gamification_skills';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['skill', 'salesSourceId', 'game_admin_id'], 'required'],
            [['game_admin_id'], 'integer'],
            [['skill'], 'string', 'max' => 55],
            [['salesSourceId'], 'string', 'max' => 255],
            [['game_admin_id'], 'exist', 'skipOnError' => true, 'targetClass' => CallcenterDefine::className(), 'targetAttribute' => ['game_admin_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'skill' => 'Skill',
            'salesSourceId' => 'Sales Source ID',
            'game_admin_id' => 'Game Admin ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGameAdmin()
    {
        return $this->hasOne(CallcenterDefine::className(), ['id' => 'game_admin_id']);
    }
}
