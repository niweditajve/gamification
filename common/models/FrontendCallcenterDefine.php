<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "gamification_frontend_callcenter_define".
 *
 * @property int $id
 * @property int $tenant_id
 * @property int $user_id
 */
class FrontendCallcenterDefine extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gamification_frontend_callcenter_define';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tenant_id', 'user_id'], 'required'],
            [['tenant_id', 'user_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tenant_id' => 'Tenant ID',
            'user_id' => 'User ID',
        ];
    }
    
    public function getCallCenter()
    {
        return $this->hasOne(Tenant::className(), ['TenantID' => 'tenant_id']);
    }
}
