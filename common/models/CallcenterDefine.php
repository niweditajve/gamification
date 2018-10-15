<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "gamification_callcenter_define".
 *
 * @property int $id
 * @property string $title
 * @property int $user_id
 *
 * @property GamificationSkills[] $gamificationSkills
 * @property GamificationUsercallcenters[] $gamificationUsercallcenters
 */
class CallcenterDefine extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gamification_callcenter_define';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'user_id'], 'required'],
            [['user_id'], 'integer'],
            [['title'], 'string', 'max' => 55],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'user_id' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGamificationSkills()
    {
        return $this->hasMany(GamificationSkills::className(), ['game_admin_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGamificationUsercallcenters()
    {
        return $this->hasMany(Usercallcenters::className(), ['callcenter_define_id' => 'id']);
    }
}
