<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tfnMedia".
 *
 * @property int $RowID
 * @property string $RMFTFN
 * @property resource $description
 * @property string $mediaType
 * @property string $inContactTFN
 * @property string $script
 * @property string $transfer
 * @property string $percent
 * @property int $Report
 * @property string $SalesForceID
 * @property string $SourceID
 * @property string $BusinessDesignation
 * @property string $BusinessSourceID
 * @property string $Greeting
 */
class TfnMedia extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tfnMedia';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Report'], 'integer'],
            [['description', 'Greeting'], 'string'],
            [['mediaType', 'inContactTFN', 'script', 'transfer', 'percent'], 'string', 'max' => 50],
            [['SalesForceID'], 'string', 'max' => 150],
            [['SourceID', 'BusinessSourceID'], 'string', 'max' => 11],
            [['BusinessDesignation'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'RowID' => 'Row ID',
            //'RMFTFN' => 'Rmftfn',
            'description' => 'Description',
            'mediaType' => 'Media Type',
            'inContactTFN' => 'In Contact Tfn',
            'script' => 'Script',
            'transfer' => 'Transfer',
            'percent' => 'Percent',
            'Report' => 'Report',
            'SalesForceID' => 'Sales Force ID',
            'SourceID' => 'Source ID',
            'BusinessDesignation' => 'Business Designation',
            'BusinessSourceID' => 'Business Source ID',
            'Greeting' => 'Greeting',
        ];
    }

    /**
     * {@inheritdoc}
     * @return TfnMediaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TfnMediaQuery(get_called_class());
    }
}
