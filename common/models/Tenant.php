<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tbltenant".
 *
 * @property int $TenantID
 * @property string $TenantLabel
 */
class Tenant extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblTenant';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['TenantID'], 'integer'],
            [['TenantLabel'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'TenantID' => 'Tenant ID',
            'TenantLabel' => 'Tenant Label',
        ];
    }
}
