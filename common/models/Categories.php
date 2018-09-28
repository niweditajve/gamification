<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "categories".
 *
 * @property int $id
 * @property string $title 
 * @property double $point
 * @property string $created_at
 * @property string $updated_at
 * @property int $redCutOff
 * @property int $yellowCutOff
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
            [['title','redCutOff','yellowCutOff'], 'required'],
            [['point'], 'number'],
            [['redCutOff','yellowCutOff'], 'number'],
            [['redCutOff','yellowCutOff'], 'string', 'max' => 2],
            [['yellowCutOff'],'compare','compareAttribute'=>'redCutOff','operator'=>'>','message'=>'Yellow Cut Off must be greater than Red Cut Off'],
            [['created_at', 'updated_at'], 'safe'],
            [['title'], 'string', 'max' => 255],
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
            'dashboardName' => 'Dashboar Display Name',
            'redCutOff' => 'Red Cut Off Maximum Value',
            'yellowCutOff' => 'Yellow Cut Off Maximum Value',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
    
    public static function primaryKey()
    {
        return ['id'];
    }
}
