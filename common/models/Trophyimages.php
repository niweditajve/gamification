<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "gamification_trophyimages".
 *
 * @property int $id
 * @property string $title
 * @property string $filename
 * @property int $game_admin_id
 * @property string $created_at
 *
 * @property GamificationCertificates[] $gamificationCertificates
 * @property GamificationCallcenterDefine $gameAdmin
 */
class Trophyimages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gamification_trophyimages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['game_admin_id'], 'required'],
            [['game_admin_id'], 'integer'],
            [['created_at'], 'safe'],
            [['title', 'filename'], 'string', 'max' => 255],
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
            'title' => 'Title',
            'filename' => 'Filename',
            'game_admin_id' => 'Game Admin ID',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGamificationCertificates()
    {
        return $this->hasMany(Certificates::className(), ['trohpy_image_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGameAdmin()
    {
        return $this->hasOne(CallcenterDefine::className(), ['id' => 'game_admin_id']);
    }
    
    public function getImageurl()
    {
        return Yii::getAlias('@frontend/web/images/slider') .'/'.$this->filename;
    }
    
}
