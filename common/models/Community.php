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
 *
 * @property Callcenters $callCenter
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
            [['call_center_id', 'community_title', 'sales_source_id'], 'required'],
            [['call_center_id', 'sales_source_id'], 'integer'],
            [['community_title'], 'string', 'max' => 255],
            [['call_center_id'], 'exist', 'skipOnError' => true, 'targetClass' => Callcenter::className(), 'targetAttribute' => ['call_center_id' => 'RowID']],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCallCenter()
    {
        return $this->hasOne(Callcenter::className(), ['RowID' => 'call_center_id']);
    }
}
