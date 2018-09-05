<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CallData;

/**
 * CallDataSearch represents the model behind the search form of `common\models\CallData`.
 */
class CallDataSearch extends CallData {
    //public $inContactAgent;

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['RowID', 'UserID', 'MediaID', 'Duration', 'OfferID', 'ServiceZip5', 'DatesAvailable', 'ScheduleAttempted', 'BIN', 'GoodFit', 'FedExOveride'], 'integer'],
            [['AgentID', 'CaseID', 'CallID', 'ScriptID', 'StartedAt', 'EndedAt', 'ScriptVersion', 'AgentUserName', 'DomainCode', 'DispositionCode', 'Sale', 'CallType', 'AltPhoneNumber', 'BestTime', 'ServiceType', 'BillingAddress1', 'BillingAddress2', 'BillingAdrSame', 'BillingCity', 'BillingFirstName', 'BillingLastName', 'BillingState', 'BillingZip', 'CBDay', 'CBPhoneNumber', 'CBTime', 'CCExpMonth', 'CCExpYear', 'CCFirstName', 'CCLastName', 'CCNumber', 'CCType', 'CCTypeLong', 'Comments', 'DialupAccess', 'DNIS', 'EmailAddress', 'EmailAddress2', 'ExpRepairType', 'FlexAmount', 'FlexDiscount', 'GenerateQuote', 'InstallerNotes', 'InstallOption', 'MaintainOption', 'NoOrderReason', 'NumLocations', 'NumStaticIP', 'OriginalANI', 'OwnProperty', 'PaymentOption', 'PhoneNumber', 'PlaceOrder', 'PlanName', 'QuoteID', 'ServiceAddress1', 'ServiceAddress2', 'ServiceCity', 'ServiceFirstName', 'ServiceLastName', 'ServicePlan', 'ServiceState', 'ServiceZip', 'SomeHeavyUsage', 'StandardBrowsing', 'StaticIPMention', 'TransactionID', 'TransactionTime', 'CancelledOrder', 'ExpectingMove', 'P10NoSlots', 'ResID', 'BypassP10', 'OrderID', 'ModTransactionID', 'OriginalCallID', 'HighSpeedArea', 'CheckEligible', 'ServicePlanType', 'Lowfill', 'AfbCall', 'Afb', 'MemberID', 'AdID', 'TicketID', 'HowFound', 'CreateDate', 'ContactID', 'MediaType', 'ExpeditedInstall', 'RemoteMaintenance4', 'RemoteMaintenance3', 'DeIce', 'Data', 'Antenna', 'AntiIce', 'OrderRespCode', 'OrderRespMsg', 'LastUpdate', 'OutboundContactID', 'ZoneAlarm', 'PSE', 'MailCode', 'Reserve3', 'VoIP', 'LeaseFail', 'OfferedProducts', 'LeaseFailPIM', 'LeaseFailMessage', 'VoIPEligible', 'Reserve4', 'POAccepted', 'CCSource', 'ContactConsent', 'WelcomeFreeForm', 'Company', 'SWVoIP', 'SAN', 'DSSStatus', 'Activated', 'Churn1', 'Churn2', 'Churn3', 'Connection', 'OneDayCancel', 'OfferServices', 'CheckServices', 'VEMPim', 'NewEmailAttempt', 'VerifyEmailSpelling', 'ConfirmEmail', 'VEMAttempts', 'VerizonCustomer', 'RAFShortCode', 'ORDContactID', 'SelectedInstallDate', 'Churn4', 'DateInstalled', 'RAFSelected', 'GamingDisc', 'StreamingDisc', 'VoiceDisc', 'BonusBytesDisc', 'SpeedDisc', 'CreditCheckDisc', 'ExpRepairReviewed', 'ExpRepairConsent', 'ExpRepairSold', 'PCEReviewed', 'PCEConsent', 'PCESold', 'ZAReviewed', 'ZAConsent', 'ZASold', 'VoIPReviewed', 'VoIPConsent', 'VoIPSold', 'WirelessDisc', 'ChargesExplained', 'TNCVerbatim', 'AllowanceDisc', 'WirelessRouter', 'TelephonyDNIS', 'SSAdmin', 'CreditReport', 'SwitchToConsumer', 'SwitchToConsumerReason', 'HowDidYouHear', 'Reserve1', 'Reserve2', 'NortonReviewed', 'Norton', 'NortonConsent', 'NortonSold', 'RowDate', 'StaticIP', 'Reserve5', 'Reserve6', 'Beam', 'BeamType'], 'safe'],
            [['DSSCharge', 'SpiceCharge'], 'number'],
                //[['inContactAgent'],'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios() {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params) {
        $query = CallData::find();

        //$query->joinWith(['agent']);
        // add conditions that should always apply here
        $query->orderBy([
            'callData.CreateDate' => SORT_DESC,
        ]);
//        $startdate = date('Y-m-d H:i:s', strtotime('-120 days'));
//        $query->andWhere("CreateDate > '{$startdate}'");


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
                ]
        );

        /**
         * Setup your sorting attributes
         * Note: This is setup before the $this->load($params) 
         * statement below
         */
//     $dataProvider->setSort([
//        'attributes' => [
//            //'id',
//            'inContactAgent' => [
//                'asc' => ['tblAgent.InContactAgent' => SORT_ASC],
//                'desc' => ['tblAgent.InContactAgent' => SORT_DESC],
//                'label' => 'inContact Agent'
//            ]
//        ]
//    ]);


        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            // $query->joinWith(['agent']);
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
//            'RowID' => $this->RowID,
//            'UserID' => $this->UserID,
//            'MediaID' => $this->MediaID,
//            'StartedAt' => $this->StartedAt,
//            'EndedAt' => $this->EndedAt,
//            'Duration' => $this->Duration,
            'AgentID' => $this->AgentID,
            // 'TransactionTime' => $this->TransactionTime,
            'CreateDate' => $this->CreateDate,
//            'LastUpdate' => $this->LastUpdate,
//            'OfferID' => $this->OfferID,
//            'DSSCharge' => $this->DSSCharge,
//            'SpiceCharge' => $this->SpiceCharge,
//            'ServiceZip5' => $this->ServiceZip5,
//            'DatesAvailable' => $this->DatesAvailable,
//            'ScheduleAttempted' => $this->ScheduleAttempted,
//            'BIN' => $this->BIN,
//            'GoodFit' => $this->GoodFit,
//            'FedExOveride' => $this->FedExOveride,
//            'RowDate' => $this->RowDate,
           
            'CaseID' => $this->CaseID,
            'OriginalANI' => $this->OriginalANI,
            'DNIS' => $this->DNIS,
        ]);

//        $query->andFilterWhere(['like', 'CaseID', $this->CaseID])
//                ->andFilterWhere(['like', 'CallID', $this->CallID])
//                ->andFilterWhere(['like', 'ScriptID', $this->ScriptID])
//                ->andFilterWhere(['like', 'ScriptVersion', $this->ScriptVersion])
//                ->andFilterWhere(['like', 'AgentUserName', $this->AgentUserName])
        //->andFilterWhere(['like', 'tblAgent.Login', $this->AgentID])
//                ->andFilterWhere(['like', 'DomainCode', $this->DomainCode])
//                ->andFilterWhere(['like', 'DispositionCode', $this->DispositionCode])
//                ->andFilterWhere(['like', 'Sale', $this->Sale])
//                ->andFilterWhere(['like', 'CallType', $this->CallType])
//                ->andFilterWhere(['like', 'AltPhoneNumber', $this->AltPhoneNumber])
//                ->andFilterWhere(['like', 'BestTime', $this->BestTime])
//                ->andFilterWhere(['like', 'ServiceType', $this->ServiceType])
//                ->andFilterWhere(['like', 'BillingAddress1', $this->BillingAddress1])
//                ->andFilterWhere(['like', 'BillingAddress2', $this->BillingAddress2])
//                ->andFilterWhere(['like', 'BillingAdrSame', $this->BillingAdrSame])
//                ->andFilterWhere(['like', 'BillingCity', $this->BillingCity])
//                ->andFilterWhere(['like', 'BillingFirstName', $this->BillingFirstName])
//                ->andFilterWhere(['like', 'BillingLastName', $this->BillingLastName])
//                ->andFilterWhere(['like', 'BillingState', $this->BillingState])
//                ->andFilterWhere(['like', 'BillingZip', $this->BillingZip])
//                ->andFilterWhere(['like', 'CBDay', $this->CBDay])
//                ->andFilterWhere(['like', 'CBPhoneNumber', $this->CBPhoneNumber])
//                ->andFilterWhere(['like', 'CBTime', $this->CBTime])
//                ->andFilterWhere(['like', 'CCExpMonth', $this->CCExpMonth])
//                ->andFilterWhere(['like', 'CCExpYear', $this->CCExpYear])
//                ->andFilterWhere(['like', 'CCFirstName', $this->CCFirstName])
//                ->andFilterWhere(['like', 'CCLastName', $this->CCLastName])
//                ->andFilterWhere(['like', 'CCNumber', $this->CCNumber])
//                ->andFilterWhere(['like', 'CCType', $this->CCType])
//                ->andFilterWhere(['like', 'CCTypeLong', $this->CCTypeLong])
//                ->andFilterWhere(['like', 'Comments', $this->Comments])
//                ->andFilterWhere(['like', 'DialupAccess', $this->DialupAccess])
//                ->andFilterWhere(['like', 'DNIS', $this->DNIS])
//                ->andFilterWhere(['like', 'EmailAddress', $this->EmailAddress])
//                ->andFilterWhere(['like', 'EmailAddress2', $this->EmailAddress2])
//                ->andFilterWhere(['like', 'ExpRepairType', $this->ExpRepairType])
//                ->andFilterWhere(['like', 'FlexAmount', $this->FlexAmount])
//                ->andFilterWhere(['like', 'FlexDiscount', $this->FlexDiscount])
//                ->andFilterWhere(['like', 'GenerateQuote', $this->GenerateQuote])
//                ->andFilterWhere(['like', 'InstallerNotes', $this->InstallerNotes])
//                ->andFilterWhere(['like', 'InstallOption', $this->InstallOption])
//                ->andFilterWhere(['like', 'MaintainOption', $this->MaintainOption])
//                ->andFilterWhere(['like', 'NoOrderReason', $this->NoOrderReason])
//                ->andFilterWhere(['like', 'NumLocations', $this->NumLocations])
//                ->andFilterWhere(['like', 'NumStaticIP', $this->NumStaticIP])
//                ->andFilterWhere(['like', 'OriginalANI', $this->OriginalANI])
//                ->andFilterWhere(['like', 'OwnProperty', $this->OwnProperty])
//                ->andFilterWhere(['like', 'PaymentOption', $this->PaymentOption])
//                ->andFilterWhere(['like', 'PhoneNumber', $this->PhoneNumber])
//                ->andFilterWhere(['like', 'PlaceOrder', $this->PlaceOrder])
//                ->andFilterWhere(['like', 'PlanName', $this->PlanName])
//                ->andFilterWhere(['like', 'QuoteID', $this->QuoteID])
//                ->andFilterWhere(['like', 'ServiceAddress1', $this->ServiceAddress1])
//                ->andFilterWhere(['like', 'ServiceAddress2', $this->ServiceAddress2])
//                ->andFilterWhere(['like', 'ServiceCity', $this->ServiceCity])
//                ->andFilterWhere(['like', 'ServiceFirstName', $this->ServiceFirstName])
//                ->andFilterWhere(['like', 'ServiceLastName', $this->ServiceLastName])
//                ->andFilterWhere(['like', 'ServicePlan', $this->ServicePlan])
//                ->andFilterWhere(['like', 'ServiceState', $this->ServiceState])
//                ->andFilterWhere(['like', 'ServiceZip', $this->ServiceZip])
//                ->andFilterWhere(['like', 'SomeHeavyUsage', $this->SomeHeavyUsage])
//                ->andFilterWhere(['like', 'StandardBrowsing', $this->StandardBrowsing])
//                ->andFilterWhere(['like', 'StaticIPMention', $this->StaticIPMention])
//                ->andFilterWhere(['like', 'TransactionID', $this->TransactionID])
//                ->andFilterWhere(['like', 'CancelledOrder', $this->CancelledOrder])
//                ->andFilterWhere(['like', 'ExpectingMove', $this->ExpectingMove])
//                ->andFilterWhere(['like', 'P10NoSlots', $this->P10NoSlots])
//                ->andFilterWhere(['like', 'ResID', $this->ResID])
//                ->andFilterWhere(['like', 'BypassP10', $this->BypassP10])
//                ->andFilterWhere(['like', 'OrderID', $this->OrderID])
//                ->andFilterWhere(['like', 'ModTransactionID', $this->ModTransactionID])
//                ->andFilterWhere(['like', 'OriginalCallID', $this->OriginalCallID])
//                ->andFilterWhere(['like', 'HighSpeedArea', $this->HighSpeedArea])
//                ->andFilterWhere(['like', 'CheckEligible', $this->CheckEligible])
//                ->andFilterWhere(['like', 'ServicePlanType', $this->ServicePlanType])
//                ->andFilterWhere(['like', 'Lowfill', $this->Lowfill])
//                ->andFilterWhere(['like', 'AfbCall', $this->AfbCall])
//                ->andFilterWhere(['like', 'Afb', $this->Afb])
//                ->andFilterWhere(['like', 'MemberID', $this->MemberID])
//                ->andFilterWhere(['like', 'AdID', $this->AdID])
//                ->andFilterWhere(['like', 'TicketID', $this->TicketID])
//                ->andFilterWhere(['like', 'HowFound', $this->HowFound])
//                ->andFilterWhere(['like', 'ContactID', $this->ContactID])
//                ->andFilterWhere(['like', 'MediaType', $this->MediaType])
//                ->andFilterWhere(['like', 'ExpeditedInstall', $this->ExpeditedInstall])
//                ->andFilterWhere(['like', 'RemoteMaintenance4', $this->RemoteMaintenance4])
//                ->andFilterWhere(['like', 'RemoteMaintenance3', $this->RemoteMaintenance3])
//                ->andFilterWhere(['like', 'DeIce', $this->DeIce])
//                ->andFilterWhere(['like', 'Data', $this->Data])
//                ->andFilterWhere(['like', 'Antenna', $this->Antenna])
//                ->andFilterWhere(['like', 'AntiIce', $this->AntiIce])
//                ->andFilterWhere(['like', 'OrderRespCode', $this->OrderRespCode])
//                ->andFilterWhere(['like', 'OrderRespMsg', $this->OrderRespMsg])
//                ->andFilterWhere(['like', 'OutboundContactID', $this->OutboundContactID])
//                ->andFilterWhere(['like', 'ZoneAlarm', $this->ZoneAlarm])
//                ->andFilterWhere(['like', 'PSE', $this->PSE])
//                ->andFilterWhere(['like', 'MailCode', $this->MailCode])
//                ->andFilterWhere(['like', 'Reserve3', $this->Reserve3])
//                ->andFilterWhere(['like', 'VoIP', $this->VoIP])
//                ->andFilterWhere(['like', 'LeaseFail', $this->LeaseFail])
//                ->andFilterWhere(['like', 'OfferedProducts', $this->OfferedProducts])
//                ->andFilterWhere(['like', 'LeaseFailPIM', $this->LeaseFailPIM])
//                ->andFilterWhere(['like', 'LeaseFailMessage', $this->LeaseFailMessage])
//                ->andFilterWhere(['like', 'VoIPEligible', $this->VoIPEligible])
//                ->andFilterWhere(['like', 'Reserve4', $this->Reserve4])
//                ->andFilterWhere(['like', 'POAccepted', $this->POAccepted])
//                ->andFilterWhere(['like', 'CCSource', $this->CCSource])
//                ->andFilterWhere(['like', 'ContactConsent', $this->ContactConsent])
//                ->andFilterWhere(['like', 'WelcomeFreeForm', $this->WelcomeFreeForm])
//                ->andFilterWhere(['like', 'Company', $this->Company])
//                ->andFilterWhere(['like', 'SWVoIP', $this->SWVoIP])
//                ->andFilterWhere(['like', 'SAN', $this->SAN])
//                ->andFilterWhere(['like', 'DSSStatus', $this->DSSStatus])
//                ->andFilterWhere(['like', 'Activated', $this->Activated])
//                ->andFilterWhere(['like', 'Churn1', $this->Churn1])
//                ->andFilterWhere(['like', 'Churn2', $this->Churn2])
//                ->andFilterWhere(['like', 'Churn3', $this->Churn3])
//                ->andFilterWhere(['like', 'Connection', $this->Connection])
//                ->andFilterWhere(['like', 'OneDayCancel', $this->OneDayCancel])
//                ->andFilterWhere(['like', 'OfferServices', $this->OfferServices])
//                ->andFilterWhere(['like', 'CheckServices', $this->CheckServices])
//                ->andFilterWhere(['like', 'VEMPim', $this->VEMPim])
//                ->andFilterWhere(['like', 'NewEmailAttempt', $this->NewEmailAttempt])
//                ->andFilterWhere(['like', 'VerifyEmailSpelling', $this->VerifyEmailSpelling])
//                ->andFilterWhere(['like', 'ConfirmEmail', $this->ConfirmEmail])
//                ->andFilterWhere(['like', 'VEMAttempts', $this->VEMAttempts])
//                ->andFilterWhere(['like', 'VerizonCustomer', $this->VerizonCustomer])
//                ->andFilterWhere(['like', 'RAFShortCode', $this->RAFShortCode])
//                ->andFilterWhere(['like', 'ORDContactID', $this->ORDContactID])
//                ->andFilterWhere(['like', 'SelectedInstallDate', $this->SelectedInstallDate])
//                ->andFilterWhere(['like', 'Churn4', $this->Churn4])
//                ->andFilterWhere(['like', 'DateInstalled', $this->DateInstalled])
//                ->andFilterWhere(['like', 'RAFSelected', $this->RAFSelected])
//                ->andFilterWhere(['like', 'GamingDisc', $this->GamingDisc])
//                ->andFilterWhere(['like', 'StreamingDisc', $this->StreamingDisc])
//                ->andFilterWhere(['like', 'VoiceDisc', $this->VoiceDisc])
//                ->andFilterWhere(['like', 'BonusBytesDisc', $this->BonusBytesDisc])
//                ->andFilterWhere(['like', 'SpeedDisc', $this->SpeedDisc])
//                ->andFilterWhere(['like', 'CreditCheckDisc', $this->CreditCheckDisc])
//                ->andFilterWhere(['like', 'ExpRepairReviewed', $this->ExpRepairReviewed])
//                ->andFilterWhere(['like', 'ExpRepairConsent', $this->ExpRepairConsent])
//                ->andFilterWhere(['like', 'ExpRepairSold', $this->ExpRepairSold])
//                ->andFilterWhere(['like', 'PCEReviewed', $this->PCEReviewed])
//                ->andFilterWhere(['like', 'PCEConsent', $this->PCEConsent])
//                ->andFilterWhere(['like', 'PCESold', $this->PCESold])
//                ->andFilterWhere(['like', 'ZAReviewed', $this->ZAReviewed])
//                ->andFilterWhere(['like', 'ZAConsent', $this->ZAConsent])
//                ->andFilterWhere(['like', 'ZASold', $this->ZASold])
//                ->andFilterWhere(['like', 'VoIPReviewed', $this->VoIPReviewed])
//                ->andFilterWhere(['like', 'VoIPConsent', $this->VoIPConsent])
//                ->andFilterWhere(['like', 'VoIPSold', $this->VoIPSold])
//                ->andFilterWhere(['like', 'WirelessDisc', $this->WirelessDisc])
//                ->andFilterWhere(['like', 'ChargesExplained', $this->ChargesExplained])
//                ->andFilterWhere(['like', 'TNCVerbatim', $this->TNCVerbatim])
//                ->andFilterWhere(['like', 'AllowanceDisc', $this->AllowanceDisc])
//                ->andFilterWhere(['like', 'WirelessRouter', $this->WirelessRouter])
//                ->andFilterWhere(['like', 'TelephonyDNIS', $this->TelephonyDNIS])
//                ->andFilterWhere(['like', 'SSAdmin', $this->SSAdmin])
//                ->andFilterWhere(['like', 'CreditReport', $this->CreditReport])
//                ->andFilterWhere(['like', 'SwitchToConsumer', $this->SwitchToConsumer])
//                ->andFilterWhere(['like', 'SwitchToConsumerReason', $this->SwitchToConsumerReason])
//                ->andFilterWhere(['like', 'HowDidYouHear', $this->HowDidYouHear])
//                ->andFilterWhere(['like', 'Reserve1', $this->Reserve1])
//                ->andFilterWhere(['like', 'Reserve2', $this->Reserve2])
//                ->andFilterWhere(['like', 'NortonReviewed', $this->NortonReviewed])
//                ->andFilterWhere(['like', 'Norton', $this->Norton])
//                ->andFilterWhere(['like', 'NortonConsent', $this->NortonConsent])
//                ->andFilterWhere(['like', 'NortonSold', $this->NortonSold])
//                ->andFilterWhere(['like', 'StaticIP', $this->StaticIP])
//                ->andFilterWhere(['like', 'Reserve5', $this->Reserve5])
//                ->andFilterWhere(['like', 'Reserve6', $this->Reserve6])
//                ->andFilterWhere(['like', 'Beam', $this->Beam])
//                ->andFilterWhere(['like', 'BeamType', $this->BeamType])
//                        ;

        return $dataProvider;
    }

}
