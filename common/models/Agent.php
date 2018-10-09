<?php

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "tblAgent".
 *
 * @property integer $AgentID
 * @property string $FirstName
 * @property string $LastName
 * @property string $Login
 * @property string $Password
 * @property integer $TierID
 * @property integer $TypeID
 * @property integer $SecurityLevelID
 * @property integer $Active
 * @property string $CreateDate
 * @property integer $ViewID
 * @property integer $BaseFolder
 * @property integer $Publish
 * @property integer $Reset
 * @property string $AlternateEmail
 * @property string $Phone
 * @property string $AlternatePhone
 * @property string $IMType
 * @property string $IMName
 * @property integer $ParentTenantID
 * @property string $LastModified
 * @property integer $inContactAgent
 * @property integer $inContactSuper
 * @property string $EmailContact
 * @property string $EmaiContact
 * @property integer $inContact
 * @property integer $Five9
 * @property string $Groupings
 * @property string $Groups
 * @property integer $ModifiedAgent
 * @property integer $CreateAgent
 * @property string $LastReset
 * @property integer $Locked
 * @property integer $AmazonAgent
 * @property integer $AmazonEmbedded
 * @property integer $AmazonConnector
 * @property integer $AbstractBuilder
 * @property integer $DatabaseBuilder
 * @property integer $ReportBuilder
 * @property integer $inContactConnector
 */
class Agent extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */

    public static function tableName() {
        return 'tblAgent';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        //REMOVE 'AgentID', WHEN WE are completely on JACADA and add auto increment on the database and remove unique attribute //
        return [
            [['AgentID','FirstName', 'LastName', 'Login', 'Password', 'TierID', 'TypeID', 'SecurityLevelID', 'Active', 'ParentTenantID'], 'required'],
            [['TierID', 'TypeID', 'SecurityLevelID', 'Active', 'ViewID', 'BaseFolder', 'Publish', 'Reset', 'ParentTenantID', 'inContactAgent', 'inContactSuper', 'inContact', 'Five9', 'ModifiedAgent', 'CreateAgent', 'Locked', 'AmazonAgent', 'AmazonEmbedded', 'AmazonConnector', 'AbstractBuilder', 'DatabaseBuilder', 'ReportBuilder', 'inContactConnector'], 'integer'],
            //[['CreateDate', 'LastModified', 'LastReset'], 'safe'],
            [['FirstName', 'LastName'], 'string', 'max' => 100],
            [['Login'], 'string', 'max' => 50],
            [['Password', 'EmaiContact', 'Groupings', 'Groups'], 'string', 'max' => 250],
            [['AlternateEmail', 'IMName', 'EmailContact'], 'string', 'max' => 450],
            [['Phone', 'AlternatePhone', 'IMType'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'AgentID' => 'Agent ID',
            'FirstName' => 'First Name',
            'LastName' => 'Last Name',
            'Login' => 'Login',
            'Password' => 'Password',
            'TierID' => 'Tier ID',
            'TypeID' => 'Type ID',
            'SecurityLevelID' => 'Security Level ID',
            'Active' => 'Active',
            'CreateDate' => 'Create Date',
            'ViewID' => 'View ID',
            'BaseFolder' => 'Base Folder',
            'Publish' => 'Publish',
            'Reset' => 'Reset',
            'AlternateEmail' => 'Alternate Email',
            'Phone' => 'Phone',
            'AlternatePhone' => 'Alternate Phone',
            'IMType' => 'Imtype',
            'IMName' => 'Imname',
            'ParentTenantID' => 'Parent Tenant ID',
            'LastModified' => 'Last Modified',
            'inContactAgent' => 'In Contact Agent',
            'inContactSuper' => 'In Contact Super',
            'EmailContact' => 'Email Contact',
            'EmaiContact' => 'Emai Contact',
            'inContact' => 'In Contact',
            'Five9' => 'Five9',
            'Groupings' => 'Groupings',
            'Groups' => 'Groups',
            'ModifiedAgent' => 'Modified Agent',
            'CreateAgent' => 'Create Agent',
            'LastReset' => 'Last Reset',
            'Locked' => 'Locked',
            'AmazonAgent' => 'Amazon Agent',
            'AmazonEmbedded' => 'Amazon Embedded',
            'AmazonConnector' => 'Amazon Connector',
            'AbstractBuilder' => 'Abstract Builder',
            'DatabaseBuilder' => 'Database Builder',
            'ReportBuilder' => 'Report Builder',
            'inContactConnector' => 'In Contact Connector',
        ];
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

}
