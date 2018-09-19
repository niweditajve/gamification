<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "trophyimages".
 *
 * @property int $id
 * @property string $title
 * @property string $filename
 * @property string $created_at
 */
class Trophyimages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'trophyimages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at'], 'safe'],
            [['title', 'filename'], 'string', 'max' => 255],
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
            'created_at' => 'Created At',
        ];
    }
}
