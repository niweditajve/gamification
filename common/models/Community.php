<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "gamification_community".
 *
 * @property int $id
 * @property int $call_center_id
 * @property string $community_title
 * @property int $sales_source_id
 * @property int $game_admin_id
 *
 * @property Callcenters $callCenter
 * @property GamificationUsercallcenters $gameAdmin
 */
class Community extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gamification_community';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['call_center_id', 'community_title', 'sales_source_id', 'game_admin_id'], 'required'],
            [['call_center_id', 'sales_source_id', 'game_admin_id'], 'integer'],
            [['community_title'], 'string', 'max' => 255],
            [['call_center_id'], 'exist', 'skipOnError' => true, 'targetClass' => Callcenter::className(), 'targetAttribute' => ['call_center_id' => 'RowID']],
            [['game_admin_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usercallcenters::className(), 'targetAttribute' => ['game_admin_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'call_center_id' => 'Call Center ID',
            'community_title' => 'Community Title',
            'sales_source_id' => 'Sales Source ID',
            'game_admin_id' => 'User',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCallCenter()
    {
        return $this->hasOne(Callcenter::className(), ['RowID' => 'call_center_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserName()
    {
        echo 'gameAdmin.id';
        return $this->hasOne(User::className(), ['id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGameAdmin()
    {
        return $this->hasOne(Usercallcenters::className(), ['id' => 'game_admin_id']);
    }
}
