<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "callData".
 *
 * @property int $RowID
 * @property string $CaseID
 * @property int $UserID
 * @property int $MediaID
 * @property string $CallID
 * @property string $ScriptID
 * @property string $StartedAt
 * @property string $EndedAt
 * @property int $Duration
 * @property string $ScriptVersion
 * @property int $AgentID
 * @property string $AgentUserName
 * @property string $DomainCode
 * @property string $DispositionCode
 * @property string $Sale
 * @property string $CallType
 * @property string $AltPhoneNumber
 * @property string $BestTime
 * @property string $ServiceType
 * @property string $BillingAddress1
 * @property string $BillingAddress2
 * @property string $BillingAdrSame
 * @property string $BillingCity
 * @property string $BillingFirstName
 * @property string $BillingLastName
 * @property string $BillingState
 * @property string $BillingZip
 * @property string $CBDay
 * @property string $CBPhoneNumber
 * @property string $CBTime
 * @property string $CCExpMonth
 * @property string $CCExpYear
 * @property string $CCFirstName
 * @property string $CCLastName
 * @property string $CCNumber
 * @property string $CCType
 * @property string $CCTypeLong
 * @property resource $Comments
 * @property string $DialupAccess
 * @property string $DNIS
 * @property string $EmailAddress
 * @property string $EmailAddress2
 * @property string $ExpRepairType
 * @property string $FlexAmount
 * @property string $FlexDiscount
 * @property string $GenerateQuote
 * @property resource $InstallerNotes
 * @property string $InstallOption
 * @property string $MaintainOption
 * @property resource $NoOrderReason
 * @property string $NumLocations
 * @property string $NumStaticIP
 * @property string $OriginalANI
 * @property string $OwnProperty
 * @property string $PaymentOption
 * @property string $PhoneNumber
 * @property string $PlaceOrder
 * @property string $PlanName
 * @property string $QuoteID
 * @property string $ServiceAddress1
 * @property string $ServiceAddress2
 * @property string $ServiceCity
 * @property string $ServiceFirstName
 * @property string $ServiceLastName
 * @property string $ServicePlan
 * @property string $ServiceState
 * @property string $ServiceZip
 * @property string $SomeHeavyUsage
 * @property string $StandardBrowsing
 * @property string $StaticIPMention
 * @property string $TransactionID
 * @property string $TransactionTime
 * @property string $CancelledOrder
 * @property string $ExpectingMove
 * @property string $P10NoSlots
 * @property string $ResID
 * @property string $BypassP10
 * @property string $OrderID
 * @property string $ModTransactionID
 * @property string $OriginalCallID
 * @property string $HighSpeedArea
 * @property string $CheckEligible
 * @property string $ServicePlanType
 * @property string $Lowfill
 * @property string $AfbCall
 * @property string $Afb
 * @property string $MemberID
 * @property string $AdID
 * @property string $TicketID
 * @property string $HowFound
 * @property string $CreateDate
 * @property string $ContactID
 * @property string $MediaType
 * @property string $ExpeditedInstall
 * @property string $RemoteMaintenance4
 * @property string $RemoteMaintenance3
 * @property string $DeIce
 * @property resource $Data
 * @property string $Antenna
 * @property string $AntiIce
 * @property string $OrderRespCode
 * @property resource $OrderRespMsg
 * @property string $LastUpdate
 * @property string $OutboundContactID
 * @property string $ZoneAlarm
 * @property string $PSE
 * @property string $MailCode
 * @property string $Reserve3
 * @property string $VoIP
 * @property string $LeaseFail
 * @property string $OfferedProducts
 * @property string $LeaseFailPIM
 * @property resource $LeaseFailMessage
 * @property string $VoIPEligible
 * @property int $OfferID
 * @property string $Reserve4
 * @property string $POAccepted
 * @property string $CCSource
 * @property string $ContactConsent
 * @property string $WelcomeFreeForm
 * @property string $Company
 * @property string $SWVoIP
 * @property string $SAN
 * @property string $DSSStatus
 * @property string $Activated
 * @property string $Churn1
 * @property string $Churn2
 * @property string $Churn3
 * @property double $DSSCharge
 * @property double $SpiceCharge
 * @property string $Connection
 * @property int $ServiceZip5
 * @property string $OneDayCancel
 * @property string $OfferServices
 * @property string $CheckServices
 * @property resource $VEMPim
 * @property string $NewEmailAttempt
 * @property string $VerifyEmailSpelling
 * @property string $ConfirmEmail
 * @property string $VEMAttempts
 * @property string $VerizonCustomer
 * @property string $RAFShortCode
 * @property string $ORDContactID
 * @property string $SelectedInstallDate
 * @property string $Churn4
 * @property string $DateInstalled
 * @property string $RAFSelected
 * @property string $GamingDisc
 * @property string $StreamingDisc
 * @property string $VoiceDisc
 * @property string $BonusBytesDisc
 * @property string $SpeedDisc
 * @property string $CreditCheckDisc
 * @property string $ExpRepairReviewed
 * @property string $ExpRepairConsent
 * @property string $ExpRepairSold
 * @property string $PCEReviewed
 * @property string $PCEConsent
 * @property string $PCESold
 * @property string $ZAReviewed
 * @property string $ZAConsent
 * @property string $ZASold
 * @property string $VoIPReviewed
 * @property string $VoIPConsent
 * @property string $VoIPSold
 * @property string $WirelessDisc
 * @property string $ChargesExplained
 * @property string $TNCVerbatim
 * @property string $AllowanceDisc
 * @property string $WirelessRouter
 * @property string $TelephonyDNIS
 * @property int $DatesAvailable
 * @property int $ScheduleAttempted
 * @property string $SSAdmin
 * @property int $BIN
 * @property string $CreditReport
 * @property string $SwitchToConsumer
 * @property string $SwitchToConsumerReason
 * @property int $GoodFit
 * @property string $HowDidYouHear
 * @property int $FedExOveride
 * @property string $Reserve1
 * @property string $Reserve2
 * @property string $NortonReviewed
 * @property string $Norton
 * @property string $NortonConsent
 * @property string $NortonSold
 * @property string $RowDate
 * @property string $StaticIP
 * @property string $Reserve5
 * @property string $Reserve6
 * @property string $Beam
 * @property string $BeamType
 */
class CallData extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'callData';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['UserID', 'MediaID', 'Duration', 'AgentID', 'OfferID', 'ServiceZip5', 'DatesAvailable', 'ScheduleAttempted', 'BIN', 'GoodFit', 'FedExOveride'], 'integer'],
            [['StartedAt', 'EndedAt', 'TransactionTime', 'CreateDate', 'LastUpdate', 'RowDate'], 'safe'],
            [['AgentID'], 'required'],
            [['Comments', 'InstallerNotes', 'NoOrderReason', 'Data', 'OrderRespMsg', 'LeaseFailMessage', 'VEMPim', 'DateInstalled', 'SwitchToConsumerReason'], 'string'],
            [['DSSCharge', 'SpiceCharge'], 'number'],
            [['Agent', 'CaseID', 'ScriptVersion'], 'string', 'max' => 200],
            [['CallID', 'AltPhoneNumber', 'Reserve1', 'Reserve2', 'Beam'], 'string', 'max' => 10],
            [['ScriptID', 'CallType', 'BestTime', 'ServiceType', 'BillingAdrSame', 'BillingCity', 'BillingFirstName', 'BillingLastName', 'BillingState', 'BillingZip', 'CBDay', 'CBPhoneNumber', 'CBTime', 'CCExpMonth', 'CCExpYear', 'CCFirstName', 'CCLastName', 'CCNumber', 'CCType', 'CCTypeLong', 'DialupAccess', 'DNIS', 'ExpRepairType', 'FlexAmount', 'FlexDiscount', 'GenerateQuote', 'InstallOption', 'MaintainOption', 'NumLocations', 'NumStaticIP', 'OriginalANI', 'OwnProperty', 'PaymentOption', 'PhoneNumber', 'PlaceOrder', 'PlanName', 'QuoteID', 'ServiceFirstName', 'ServiceLastName', 'ServicePlan', 'ServiceZip', 'SomeHeavyUsage', 'StandardBrowsing', 'StaticIPMention', 'TransactionID', 'CancelledOrder', 'ExpectingMove', 'P10NoSlots', 'BypassP10', 'OriginalCallID', 'HighSpeedArea', 'CheckEligible', 'ServicePlanType', 'Lowfill', 'AfbCall', 'Afb', 'MemberID', 'AdID', 'TicketID', 'ContactID', 'MediaType', 'ExpeditedInstall', 'DeIce', 'Antenna', 'AntiIce', 'OrderRespCode', 'OutboundContactID', 'SAN', 'DSSStatus', 'TelephonyDNIS'], 'string', 'max' => 50],
            [['AgentUserName', 'DispositionCode'], 'string', 'max' => 140],
            [['DomainCode', 'BillingAddress1', 'BillingAddress2', 'EmailAddress', 'EmailAddress2', 'ServiceAddress1', 'ServiceAddress2', 'ServiceCity', 'ServiceState', 'ResID', 'OrderID', 'ModTransactionID', 'HowFound', 'MailCode', 'Reserve3', 'Reserve4', 'WelcomeFreeForm', 'Company', 'SWVoIP'], 'string', 'max' => 150],
            [['Sale', 'GamingDisc', 'StreamingDisc', 'VoiceDisc', 'BonusBytesDisc', 'SpeedDisc', 'CreditCheckDisc', 'ExpRepairReviewed', 'ExpRepairConsent', 'ExpRepairSold', 'PCEReviewed', 'PCEConsent', 'PCESold', 'ZAReviewed', 'ZAConsent', 'ZASold', 'VoIPReviewed', 'VoIPConsent', 'VoIPSold', 'WirelessDisc', 'ChargesExplained', 'TNCVerbatim', 'AllowanceDisc', 'WirelessRouter', 'SSAdmin', 'SwitchToConsumer', 'NortonReviewed', 'NortonConsent', 'NortonSold'], 'string', 'max' => 1],
            [['RemoteMaintenance4', 'RemoteMaintenance3', 'ZoneAlarm', 'PSE', 'Connection', 'ORDContactID', 'Norton'], 'string', 'max' => 100],
            [['VoIP'], 'string', 'max' => 250],
            [['LeaseFail', 'VoIPEligible', 'POAccepted', 'CCSource', 'ContactConsent', 'Churn1', 'Churn2', 'Churn3', 'OneDayCancel', 'OfferServices', 'CheckServices', 'NewEmailAttempt', 'VerifyEmailSpelling', 'ConfirmEmail', 'VEMAttempts', 'VerizonCustomer', 'RAFShortCode', 'Churn4'], 'string', 'max' => 11],
            [['OfferedProducts'], 'string', 'max' => 400],
            [['LeaseFailPIM'], 'string', 'max' => 25],
            [['Activated', 'CreditReport'], 'string', 'max' => 3],
            [['SelectedInstallDate', 'HowDidYouHear', 'StaticIP', 'Reserve5', 'Reserve6', 'BeamType'], 'string', 'max' => 20],
            [['RAFSelected'], 'string', 'max' => 5],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'RowID' => 'Row ID',
            'CaseID' => 'Case ID',
            'UserID' => 'User ID',
            'MediaID' => 'Media ID',
            'CallID' => 'Call ID',
            'ScriptID' => 'Script ID',
            'StartedAt' => 'Started At',
            'EndedAt' => 'Ended At',
            'Duration' => 'Duration',
            'ScriptVersion' => 'Script Version',
            'AgentID' => 'Agent ID',
            'AgentUserName' => 'Agent User Name',
            'DomainCode' => 'Domain Code',
            'DispositionCode' => 'Disposition Code',
            'Sale' => 'Sale',
            'CallType' => 'Call Type',
            'AltPhoneNumber' => 'Alt Phone Number',
            'BestTime' => 'Best Time',
            'ServiceType' => 'Service Type',
            'BillingAddress1' => 'Billing Address1',
            'BillingAddress2' => 'Billing Address2',
            'BillingAdrSame' => 'Billing Adr Same',
            'BillingCity' => 'Billing City',
            'BillingFirstName' => 'Billing First Name',
            'BillingLastName' => 'Billing Last Name',
            'BillingState' => 'Billing State',
            'BillingZip' => 'Billing Zip',
            'CBDay' => 'Cbday',
            'CBPhoneNumber' => 'Cbphone Number',
            'CBTime' => 'Cbtime',
            'CCExpMonth' => 'Ccexp Month',
            'CCExpYear' => 'Ccexp Year',
            'CCFirstName' => 'Ccfirst Name',
            'CCLastName' => 'Cclast Name',
            'CCNumber' => 'Ccnumber',
            'CCType' => 'Cctype',
            'CCTypeLong' => 'Cctype Long',
            'Comments' => 'Comments',
            'DialupAccess' => 'Dialup Access',
            'DNIS' => 'DNIS',
            'EmailAddress' => 'Email Address',
            'EmailAddress2' => 'Email Address2',
            'ExpRepairType' => 'Exp Repair Type',
            'FlexAmount' => 'Flex Amount',
            'FlexDiscount' => 'Flex Discount',
            'GenerateQuote' => 'Generate Quote',
            'InstallerNotes' => 'Installer Notes',
            'InstallOption' => 'Install Option',
            'MaintainOption' => 'Maintain Option',
            'NoOrderReason' => 'No Order Reason',
            'NumLocations' => 'Num Locations',
            'NumStaticIP' => 'Num Static Ip',
            'OriginalANI' => 'Original ANI',
            'OwnProperty' => 'Own Property',
            'PaymentOption' => 'Payment Option',
            'PhoneNumber' => 'Phone Number',
            'PlaceOrder' => 'Place Order',
            'PlanName' => 'Plan Name',
            'QuoteID' => 'Quote ID',
            'ServiceAddress1' => 'Service Address1',
            'ServiceAddress2' => 'Service Address2',
            'ServiceCity' => 'Service City',
            'ServiceFirstName' => 'Service First Name',
            'ServiceLastName' => 'Service Last Name',
            'ServicePlan' => 'Service Plan',
            'ServiceState' => 'Service State',
            'ServiceZip' => 'Service Zip',
            'SomeHeavyUsage' => 'Some Heavy Usage',
            'StandardBrowsing' => 'Standard Browsing',
            'StaticIPMention' => 'Static Ipmention',
            'TransactionID' => 'Transaction ID',
            'TransactionTime' => 'Transaction Time',
            'CancelledOrder' => 'Cancelled Order',
            'ExpectingMove' => 'Expecting Move',
            'P10NoSlots' => 'P10 No Slots',
            'ResID' => 'Res ID',
            'BypassP10' => 'Bypass P10',
            'OrderID' => 'Order ID',
            'ModTransactionID' => 'Mod Transaction ID',
            'OriginalCallID' => 'Original Call ID',
            'HighSpeedArea' => 'High Speed Area',
            'CheckEligible' => 'Check Eligible',
            'ServicePlanType' => 'Service Plan Type',
            'Lowfill' => 'Lowfill',
            'AfbCall' => 'Afb Call',
            'Afb' => 'Afb',
            'MemberID' => 'Member ID',
            'AdID' => 'Ad ID',
            'TicketID' => 'Ticket ID',
            'HowFound' => 'How Found',
            'CreateDate' => 'Create Date',
            'ContactID' => 'Contact ID',
            'MediaType' => 'Media Type',
            'ExpeditedInstall' => 'Expedited Install',
            'RemoteMaintenance4' => 'Remote Maintenance4',
            'RemoteMaintenance3' => 'Remote Maintenance3',
            'DeIce' => 'De Ice',
            'Data' => 'Data',
            'Antenna' => 'Antenna',
            'AntiIce' => 'Anti Ice',
            'OrderRespCode' => 'Order Resp Code',
            'OrderRespMsg' => 'Order Resp Msg',
            'LastUpdate' => 'Last Update',
            'OutboundContactID' => 'Outbound Contact ID',
            'ZoneAlarm' => 'Zone Alarm',
            'PSE' => 'Pse',
            'MailCode' => 'Mail Code',
            'Reserve3' => 'Reserve3',
            'VoIP' => 'Vo Ip',
            'LeaseFail' => 'Lease Fail',
            'OfferedProducts' => 'Offered Products',
            'LeaseFailPIM' => 'Lease Fail Pim',
            'LeaseFailMessage' => 'Lease Fail Message',
            'VoIPEligible' => 'Vo Ipeligible',
            'OfferID' => 'Offer ID',
            'Reserve4' => 'Reserve4',
            'POAccepted' => 'Poaccepted',
            'CCSource' => 'Ccsource',
            'ContactConsent' => 'Contact Consent',
            'WelcomeFreeForm' => 'Welcome Free Form',
            'Company' => 'Company',
            'SWVoIP' => 'Swvo Ip',
            'SAN' => 'San',
            'DSSStatus' => 'Dssstatus',
            'Activated' => 'Activated',
            'Churn1' => 'Churn1',
            'Churn2' => 'Churn2',
            'Churn3' => 'Churn3',
            'DSSCharge' => 'Dsscharge',
            'SpiceCharge' => 'Spice Charge',
            'Connection' => 'Connection',
            'ServiceZip5' => 'Service Zip5',
            'OneDayCancel' => 'One Day Cancel',
            'OfferServices' => 'Offer Services',
            'CheckServices' => 'Check Services',
            'VEMPim' => 'Vempim',
            'NewEmailAttempt' => 'New Email Attempt',
            'VerifyEmailSpelling' => 'Verify Email Spelling',
            'ConfirmEmail' => 'Confirm Email',
            'VEMAttempts' => 'Vemattempts',
            'VerizonCustomer' => 'Verizon Customer',
            'RAFShortCode' => 'Rafshort Code',
            'ORDContactID' => 'Ordcontact ID',
            'SelectedInstallDate' => 'Selected Install Date',
            'Churn4' => 'Churn4',
            'DateInstalled' => 'Date Installed',
            'RAFSelected' => 'Rafselected',
            'GamingDisc' => 'Gaming Disc',
            'StreamingDisc' => 'Streaming Disc',
            'VoiceDisc' => 'Voice Disc',
            'BonusBytesDisc' => 'Bonus Bytes Disc',
            'SpeedDisc' => 'Speed Disc',
            'CreditCheckDisc' => 'Credit Check Disc',
            'ExpRepairReviewed' => 'Exp Repair Reviewed',
            'ExpRepairConsent' => 'Exp Repair Consent',
            'ExpRepairSold' => 'Exp Repair Sold',
            'PCEReviewed' => 'Pcereviewed',
            'PCEConsent' => 'Pceconsent',
            'PCESold' => 'Pcesold',
            'ZAReviewed' => 'Zareviewed',
            'ZAConsent' => 'Zaconsent',
            'ZASold' => 'Zasold',
            'VoIPReviewed' => 'Vo Ipreviewed',
            'VoIPConsent' => 'Vo Ipconsent',
            'VoIPSold' => 'Vo Ipsold',
            'WirelessDisc' => 'Wireless Disc',
            'ChargesExplained' => 'Charges Explained',
            'TNCVerbatim' => 'Tncverbatim',
            'AllowanceDisc' => 'Allowance Disc',
            'WirelessRouter' => 'Wireless Router',
            'TelephonyDNIS' => 'Telephony Dnis',
            'DatesAvailable' => 'Dates Available',
            'ScheduleAttempted' => 'Schedule Attempted',
            'SSAdmin' => 'Ssadmin',
            'BIN' => 'Bin',
            'CreditReport' => 'Credit Report',
            'SwitchToConsumer' => 'Switch To Consumer',
            'SwitchToConsumerReason' => 'Switch To Consumer Reason',
            'GoodFit' => 'Good Fit',
            'HowDidYouHear' => 'How Did You Hear',
            'FedExOveride' => 'Fed Ex Overide',
            'Reserve1' => 'Reserve1',
            'Reserve2' => 'Reserve2',
            'NortonReviewed' => 'Norton Reviewed',
            'Norton' => 'Norton',
            'NortonConsent' => 'Norton Consent',
            'NortonSold' => 'Norton Sold',
            'RowDate' => 'Row Date',
            'StaticIP' => 'Static Ip',
            'Reserve5' => 'Reserve5',
            'Reserve6' => 'Reserve6',
            'Beam' => 'Beam',
            'BeamType' => 'Beam Type',
                // 'inContactAgent'=>'inContact Agent',
        ];
    }

    /**
     * {@inheritdoc}
     * @return CallDataQuery the active query used by this AR class.
     */
    public static function find() {
        return new CallDataQuery(get_called_class());
    }
//
//    public function getAgent() {
//         return $this->hasOne(Agent::className(), ['AgentID' => 'AgentID']);
//    }

    /*
      public function getAgent() {
      //allData.AgentID = tblAgent.AgentID
      return $this->hasOne(Agent::className(), ['Agent' => 'AgentID']);
      }

      public function getInContactAgent() {
      return $this->agent->in_contact_agent;
      }


      public function getCases() {

      //          SELECT
      //          callData.CaseID,
      //          callData.OriginalANI,
      //          callData.DNIS,
      //          callData.ContactID,
      //          callData.agentID,
      //          tblAgent.inContactAgent,
      //          tblAgent.Login,
      //          tblTenant.TenantLabel,
      //          callData.callType,
      //          callData.MediaType,
      //          callData.ScriptID,
      //          callData.EmailAddress,
      //          callData.PhoneNumber,
      //          callData.ServiceFirstName,
      //          callData.ServiceLastName,
      //          callData.ServiceAddress1,
      //          callData.ServiceAddress2,
      //          callData.ServiceCity,
      //          callData.ServiceState,
      //          callData.ServiceZip,
      //          callData.Sale,
      //          callData.OrderRespCode,
      //          callData.OrderRespMsg,
      //          callData.PaymentOption,
      //          callData.OrderID,
      //          callData.ServicePlan,
      //          callData.BillingFirstName,
      //          callData.BillingLastName,
      //          callData.BillingAddress1,
      //          callData.BillingAddress2,
      //          callData.BillingCity,
      //          callData.BillingState,
      //          callData.BillingZip
      //          FROM
      //          callData
      //          INNER JOIN
      //          tblAgent ON callData.AgentID = tblAgent.AgentID
      //          INNER JOIN
      //          tblTenant ON tblAgent.ParentTenantID = tblTenant.TenantID
      //          ORDER BY callData.CreateDate DESC

      $query = new Query;
      $query->select([
      'callData .CaseID',
      'callData.OriginalANI',
      'callData.DNIS',
      'callData.ContactID' .
      'callData.agentID',
      'tblAgent.inContactAgent',
      'tblAgent.Login',
      'tblTenant.TenantLabel',
      'callData.callType',
      'callData.MediaType',
      'callData.ScriptID',
      'callData.EmailAddress',
      'callData.PhoneNumber',
      'callData.ServiceFirstName',
      'callData.ServiceLastName',
      'callData.ServiceAddress1',
      'callData.ServiceAddress2',
      'callData.ServiceCity',
      'callData.ServiceState',
      'callData.ServiceZip',
      'callData.Sale',
      'callData.OrderRespCode',
      'callData.OrderRespMsg',
      'callData.PaymentOption',
      'callData.OrderID',
      'callData.ServicePlan',
      'callData.BillingFirstName',
      'callData.BillingLastName',
      'callData.BillingAddress1',
      'callData.BillingAddress2',
      'callData.BillingCity',
      'callData.BillingState',
      'callData.BillingZip'
      ]
      )
      ->from('callData')
      ->join('INNER JOIN', 'tblAgent', 'callData.AgentID = tblAgent.AgentID')
      ->join('INNER JOIN', 'tblTenant', 'tblAgent.ParentTenantID = tblTenant.TenantID');
      //->LIMIT(5);
      $query->orderBy([
      'callData.CreateDate' => SORT_DESC,
      ]);
      $command = $query->createCommand();
      return $command->queryAll();
      }
     * *
     */
}
