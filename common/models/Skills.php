<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "gamification_skills".
 *
 * @property int $id
 * @property string $skill
 * @property string $salesSourceId
 */
class Skills extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gamification_skills';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['skill'], 'required'],
            [['skill'], 'string', 'max' => 55],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'skill' => 'Skill',
            'salesSourceId' => 'salesSourceId',
        ];
    }
}
