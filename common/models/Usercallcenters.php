<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "gamification_usercallcenters".
 *
 * @property int $id
 * @property int $user_id
 * @property int $tennant_id
 */
class Usercallcenters extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gamification_usercallcenters';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'tennant_id'], 'required'],
            [['user_id', 'tennant_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'tennant_id' => 'Tennant ID',
        ];
    }
}
