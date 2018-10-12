<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "gamification_certificates".
 *
 * @property int $id
 * @property double $point
 * @property int $trohpy_image_id
 * @property int $community_id
 *
 * @property GamificationTrophyimages $trohpyImage
 */
class Certificates extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gamification_certificates';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['point', 'trohpy_image_id','usercallcenter_id'], 'required'],
            [['point'], 'number'],
            [['trohpy_image_id','usercallcenter_id'], 'integer'],
            [['trohpy_image_id'], 'exist', 'skipOnError' => true, 'targetClass' => Trophyimages::className(), 'targetAttribute' => ['trohpy_image_id' => 'id']],
            [['usercallcenter_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usercallcenters::className(), 'targetAttribute' => ['usercallcenter_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'point' => 'Point',
            'trohpy_image_id' => 'Trohpy',
            'usercallcenter_id' => 'Community id',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrohpyImage()
    {
        return $this->hasOne(Trophyimages::className(), ['id' => 'trohpy_image_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCommunityName()
    {
        return $this->hasOne(Usercallcenters::className(), ['id' => 'usercallcenter_id']);
    }
}
