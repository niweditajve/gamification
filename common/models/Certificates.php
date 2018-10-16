<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "gamification_certificates".
 *
 * @property int $id
 * @property double $point
 * @property int $trohpy_image_id
 * @property int $game_admin_id
 *
 * @property GamificationCallcenterDefine $gameAdmin
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
            [['point', 'trohpy_image_id','game_admin_id'], 'required'],
            [['point'], 'number'],
            [['trohpy_image_id','game_admin_id'], 'integer'],
            [['trohpy_image_id'], 'exist', 'skipOnError' => true, 'targetClass' => Trophyimages::className(), 'targetAttribute' => ['trohpy_image_id' => 'id']],
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
            'point' => 'Point',
            'trohpy_image_id' => 'Trohpy',
            'game_admin_id' => 'Game Admin ID',
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
    public function getGameAdmin()
    {
        return $this->hasOne(CallcenterDefine::className(), ['id' => 'game_admin_id']);
    }
}
