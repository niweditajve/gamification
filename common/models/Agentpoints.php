<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "agentpoints".
 *
 * @property int $id
 * @property int $agentId
 * @property int $category_id
 * @property double $point
 * @property string $created_at
 */
class Agentpoints extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'agentpoints';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['agentId', 'category_id'], 'integer'],
            [['point'], 'number'],
            [['created_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'agentId' => 'Agent ID',
            'category_id' => 'Category ID',
            'point' => 'Point',
            'created_at' => 'Created At',
        ];
    }
}
