<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "callCenters".
 *
 * @property integer $RowID
 * @property integer $CaseID
 * @property integer $UserID
 * @property integer $MediaID
 * @property string $CallCenter
 * @property string $PartnerCode
 * @property string $BPartnerCode
 * @property integer $TenantID
 * @property string $EmailDNIS
 * @property string $Aliases
 * @property integer $UpfrontCredit
 * @property integer $VerEnabled
 * @property string $Versions
 * @property string $VerCurrent
 */
class CallCenter extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'callCenters';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['RowID', 'CaseID', 'UserID', 'MediaID', 'TenantID', 'UpfrontCredit', 'VerEnabled'], 'integer'],
            [['CallCenter', 'PartnerCode', 'BPartnerCode', 'EmailDNIS', 'Aliases', 'Versions', 'VerCurrent'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'RowID' => Yii::t('app', 'Row ID'),
            'CaseID' => Yii::t('app', 'Case ID'),
            'UserID' => Yii::t('app', 'User ID'),
            'MediaID' => Yii::t('app', 'Media ID'),
            'CallCenter' => Yii::t('app', 'Call Center'),
            'PartnerCode' => Yii::t('app', 'Partner Code'),
            'BPartnerCode' => Yii::t('app', 'Bpartner Code'),
            'TenantID' => Yii::t('app', 'Tenant ID'),
            'EmailDNIS' => Yii::t('app', 'Email Dnis'),
            'Aliases' => Yii::t('app', 'Aliases'),
            'UpfrontCredit' => Yii::t('app', 'Upfront Credit'),
            'VerEnabled' => Yii::t('app', 'Ver Enabled'),
            'Versions' => Yii::t('app', 'Versions'),
            'VerCurrent' => Yii::t('app', 'Ver Current'),
        ];
    }
}
