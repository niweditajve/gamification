<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "gamification_categories".
 *
 * @property int $id
 * @property string $title
 * @property double $point
 * @property string $categoery_key
 * @property int $red_cut_off
 * @property int $yellow_cut_off
 * @property int $game_admin_id
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
            
            [['title', 'categoery_key', 'game_admin_id'], 'required'],
            [['point'], 'number'],
            [['red_cut_off', 'yellow_cut_off', 'game_admin_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['categoery_key'], 'string', 'max' => 55],
            [['game_admin_id'], 'exist', 'skipOnError' => true, 'targetClass' => CallcenterDefine::className(), 'targetAttribute' => ['game_admin_id' => 'id']],
            [['yellow_cut_off'],'compare','compareAttribute'=>'red_cut_off','operator'=>'>','message'=>'Yellow Cut Off must be greater than Red Cut Off'],
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
            'categoery_key' => 'Categoery Key',
            'red_cut_off' => 'Red Cut Off',
            'yellow_cut_off' => 'Yellow Cut Off',
            'game_admin_id' => 'Callcenter Define ID',
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
        return $this->hasOne(CallcenterDefine::className(), ['id' => 'game_admin_id']);
    }
}
