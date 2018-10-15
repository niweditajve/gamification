<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "gamification_categories".
 *
 * @property int $id
 * @property string $title
 * @property double $point
 * @property string $categoeryKey
 * @property int $redCutOff
 * @property int $yellowCutOff
 * @property int $callcenter_define_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property GamificationCallcenterDefine $callcenterDefine
 */
class Categories extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gamification_categories';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            
            [['title', 'categoeryKey', 'callcenter_define_id'], 'required'],
            [['point'], 'number'],
            [['redCutOff', 'yellowCutOff', 'callcenter_define_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['categoeryKey'], 'string', 'max' => 55],
            [['callcenter_define_id'], 'exist', 'skipOnError' => true, 'targetClass' => CallcenterDefine::className(), 'targetAttribute' => ['callcenter_define_id' => 'id']],
            [['yellowCutOff'],'compare','compareAttribute'=>'redCutOff','operator'=>'>','message'=>'Yellow Cut Off must be greater than Red Cut Off'],
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
            'point' => 'Point',
            'categoeryKey' => 'Categoery Key',
            'redCutOff' => 'Red Cut Off',
            'yellowCutOff' => 'Yellow Cut Off',
            'callcenter_define_id' => 'Callcenter Define ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
    
    public static function primaryKey()
    {
        return ['id'];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCallcenterDefine()
    {
        return $this->hasOne(CallcenterDefine::className(), ['id' => 'callcenter_define_id']);
    }
}
