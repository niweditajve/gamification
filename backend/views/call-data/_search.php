<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CallDataSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="call-data-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'RowID') ?>

    <?= $form->field($model, 'CaseID') ?>

    <?= $form->field($model, 'UserID') ?>

    <?= $form->field($model, 'MediaID') ?>

    <?= $form->field($model, 'CallID') ?>

    <?php // echo $form->field($model, 'ScriptID') ?>

    <?php // echo $form->field($model, 'StartedAt') ?>

    <?php // echo $form->field($model, 'EndedAt') ?>

    <?php // echo $form->field($model, 'Duration') ?>

    <?php // echo $form->field($model, 'ScriptVersion') ?>

    <?php // echo $form->field($model, 'AgentID') ?>

    <?php // echo $form->field($model, 'AgentUserName') ?>

    <?php // echo $form->field($model, 'DomainCode') ?>

    <?php // echo $form->field($model, 'DispositionCode') ?>

    <?php // echo $form->field($model, 'Sale') ?>

    <?php // echo $form->field($model, 'CallType') ?>

    <?php // echo $form->field($model, 'AltPhoneNumber') ?>

    <?php // echo $form->field($model, 'BestTime') ?>

    <?php // echo $form->field($model, 'ServiceType') ?>

    <?php // echo $form->field($model, 'BillingAddress1') ?>

    <?php // echo $form->field($model, 'BillingAddress2') ?>

    <?php // echo $form->field($model, 'BillingAdrSame') ?>

    <?php // echo $form->field($model, 'BillingCity') ?>

    <?php // echo $form->field($model, 'BillingFirstName') ?>

    <?php // echo $form->field($model, 'BillingLastName') ?>

    <?php // echo $form->field($model, 'BillingState') ?>

    <?php // echo $form->field($model, 'BillingZip') ?>

    <?php // echo $form->field($model, 'CBDay') ?>

    <?php // echo $form->field($model, 'CBPhoneNumber') ?>

    <?php // echo $form->field($model, 'CBTime') ?>

    <?php // echo $form->field($model, 'CCExpMonth') ?>

    <?php // echo $form->field($model, 'CCExpYear') ?>

    <?php // echo $form->field($model, 'CCFirstName') ?>

    <?php // echo $form->field($model, 'CCLastName') ?>

    <?php // echo $form->field($model, 'CCNumber') ?>

    <?php // echo $form->field($model, 'CCType') ?>

    <?php // echo $form->field($model, 'CCTypeLong') ?>

    <?php // echo $form->field($model, 'Comments') ?>

    <?php // echo $form->field($model, 'DialupAccess') ?>

    <?php // echo $form->field($model, 'DNIS') ?>

    <?php // echo $form->field($model, 'EmailAddress') ?>

    <?php // echo $form->field($model, 'EmailAddress2') ?>

    <?php // echo $form->field($model, 'ExpRepairType') ?>

    <?php // echo $form->field($model, 'FlexAmount') ?>

    <?php // echo $form->field($model, 'FlexDiscount') ?>

    <?php // echo $form->field($model, 'GenerateQuote') ?>

    <?php // echo $form->field($model, 'InstallerNotes') ?>

    <?php // echo $form->field($model, 'InstallOption') ?>

    <?php // echo $form->field($model, 'MaintainOption') ?>

    <?php // echo $form->field($model, 'NoOrderReason') ?>

    <?php // echo $form->field($model, 'NumLocations') ?>

    <?php // echo $form->field($model, 'NumStaticIP') ?>

    <?php // echo $form->field($model, 'OriginalANI') ?>

    <?php // echo $form->field($model, 'OwnProperty') ?>

    <?php // echo $form->field($model, 'PaymentOption') ?>

    <?php // echo $form->field($model, 'PhoneNumber') ?>

    <?php // echo $form->field($model, 'PlaceOrder') ?>

    <?php // echo $form->field($model, 'PlanName') ?>

    <?php // echo $form->field($model, 'QuoteID') ?>

    <?php // echo $form->field($model, 'ServiceAddress1') ?>

    <?php // echo $form->field($model, 'ServiceAddress2') ?>

    <?php // echo $form->field($model, 'ServiceCity') ?>

    <?php // echo $form->field($model, 'ServiceFirstName') ?>

    <?php // echo $form->field($model, 'ServiceLastName') ?>

    <?php // echo $form->field($model, 'ServicePlan') ?>

    <?php // echo $form->field($model, 'ServiceState') ?>

    <?php // echo $form->field($model, 'ServiceZip') ?>

    <?php // echo $form->field($model, 'SomeHeavyUsage') ?>

    <?php // echo $form->field($model, 'StandardBrowsing') ?>

    <?php // echo $form->field($model, 'StaticIPMention') ?>

    <?php // echo $form->field($model, 'TransactionID') ?>

    <?php // echo $form->field($model, 'TransactionTime') ?>

    <?php // echo $form->field($model, 'CancelledOrder') ?>

    <?php // echo $form->field($model, 'ExpectingMove') ?>

    <?php // echo $form->field($model, 'P10NoSlots') ?>

    <?php // echo $form->field($model, 'ResID') ?>

    <?php // echo $form->field($model, 'BypassP10') ?>

    <?php // echo $form->field($model, 'OrderID') ?>

    <?php // echo $form->field($model, 'ModTransactionID') ?>

    <?php // echo $form->field($model, 'OriginalCallID') ?>

    <?php // echo $form->field($model, 'HighSpeedArea') ?>

    <?php // echo $form->field($model, 'CheckEligible') ?>

    <?php // echo $form->field($model, 'ServicePlanType') ?>

    <?php // echo $form->field($model, 'Lowfill') ?>

    <?php // echo $form->field($model, 'AfbCall') ?>

    <?php // echo $form->field($model, 'Afb') ?>

    <?php // echo $form->field($model, 'MemberID') ?>

    <?php // echo $form->field($model, 'AdID') ?>

    <?php // echo $form->field($model, 'TicketID') ?>

    <?php // echo $form->field($model, 'HowFound') ?>

    <?php // echo $form->field($model, 'CreateDate') ?>

    <?php // echo $form->field($model, 'ContactID') ?>

    <?php // echo $form->field($model, 'MediaType') ?>

    <?php // echo $form->field($model, 'ExpeditedInstall') ?>

    <?php // echo $form->field($model, 'RemoteMaintenance4') ?>

    <?php // echo $form->field($model, 'RemoteMaintenance3') ?>

    <?php // echo $form->field($model, 'DeIce') ?>

    <?php // echo $form->field($model, 'Data') ?>

    <?php // echo $form->field($model, 'Antenna') ?>

    <?php // echo $form->field($model, 'AntiIce') ?>

    <?php // echo $form->field($model, 'OrderRespCode') ?>

    <?php // echo $form->field($model, 'OrderRespMsg') ?>

    <?php // echo $form->field($model, 'LastUpdate') ?>

    <?php // echo $form->field($model, 'OutboundContactID') ?>

    <?php // echo $form->field($model, 'ZoneAlarm') ?>

    <?php // echo $form->field($model, 'PSE') ?>

    <?php // echo $form->field($model, 'MailCode') ?>

    <?php // echo $form->field($model, 'Reserve3') ?>

    <?php // echo $form->field($model, 'VoIP') ?>

    <?php // echo $form->field($model, 'LeaseFail') ?>

    <?php // echo $form->field($model, 'OfferedProducts') ?>

    <?php // echo $form->field($model, 'LeaseFailPIM') ?>

    <?php // echo $form->field($model, 'LeaseFailMessage') ?>

    <?php // echo $form->field($model, 'VoIPEligible') ?>

    <?php // echo $form->field($model, 'OfferID') ?>

    <?php // echo $form->field($model, 'Reserve4') ?>

    <?php // echo $form->field($model, 'POAccepted') ?>

    <?php // echo $form->field($model, 'CCSource') ?>

    <?php // echo $form->field($model, 'ContactConsent') ?>

    <?php // echo $form->field($model, 'WelcomeFreeForm') ?>

    <?php // echo $form->field($model, 'Company') ?>

    <?php // echo $form->field($model, 'SWVoIP') ?>

    <?php // echo $form->field($model, 'SAN') ?>

    <?php // echo $form->field($model, 'DSSStatus') ?>

    <?php // echo $form->field($model, 'Activated') ?>

    <?php // echo $form->field($model, 'Churn1') ?>

    <?php // echo $form->field($model, 'Churn2') ?>

    <?php // echo $form->field($model, 'Churn3') ?>

    <?php // echo $form->field($model, 'DSSCharge') ?>

    <?php // echo $form->field($model, 'SpiceCharge') ?>

    <?php // echo $form->field($model, 'Connection') ?>

    <?php // echo $form->field($model, 'ServiceZip5') ?>

    <?php // echo $form->field($model, 'OneDayCancel') ?>

    <?php // echo $form->field($model, 'OfferServices') ?>

    <?php // echo $form->field($model, 'CheckServices') ?>

    <?php // echo $form->field($model, 'VEMPim') ?>

    <?php // echo $form->field($model, 'NewEmailAttempt') ?>

    <?php // echo $form->field($model, 'VerifyEmailSpelling') ?>

    <?php // echo $form->field($model, 'ConfirmEmail') ?>

    <?php // echo $form->field($model, 'VEMAttempts') ?>

    <?php // echo $form->field($model, 'VerizonCustomer') ?>

    <?php // echo $form->field($model, 'RAFShortCode') ?>

    <?php // echo $form->field($model, 'ORDContactID') ?>

    <?php // echo $form->field($model, 'SelectedInstallDate') ?>

    <?php // echo $form->field($model, 'Churn4') ?>

    <?php // echo $form->field($model, 'DateInstalled') ?>

    <?php // echo $form->field($model, 'RAFSelected') ?>

    <?php // echo $form->field($model, 'GamingDisc') ?>

    <?php // echo $form->field($model, 'StreamingDisc') ?>

    <?php // echo $form->field($model, 'VoiceDisc') ?>

    <?php // echo $form->field($model, 'BonusBytesDisc') ?>

    <?php // echo $form->field($model, 'SpeedDisc') ?>

    <?php // echo $form->field($model, 'CreditCheckDisc') ?>

    <?php // echo $form->field($model, 'ExpRepairReviewed') ?>

    <?php // echo $form->field($model, 'ExpRepairConsent') ?>

    <?php // echo $form->field($model, 'ExpRepairSold') ?>

    <?php // echo $form->field($model, 'PCEReviewed') ?>

    <?php // echo $form->field($model, 'PCEConsent') ?>

    <?php // echo $form->field($model, 'PCESold') ?>

    <?php // echo $form->field($model, 'ZAReviewed') ?>

    <?php // echo $form->field($model, 'ZAConsent') ?>

    <?php // echo $form->field($model, 'ZASold') ?>

    <?php // echo $form->field($model, 'VoIPReviewed') ?>

    <?php // echo $form->field($model, 'VoIPConsent') ?>

    <?php // echo $form->field($model, 'VoIPSold') ?>

    <?php // echo $form->field($model, 'WirelessDisc') ?>

    <?php // echo $form->field($model, 'ChargesExplained') ?>

    <?php // echo $form->field($model, 'TNCVerbatim') ?>

    <?php // echo $form->field($model, 'AllowanceDisc') ?>

    <?php // echo $form->field($model, 'WirelessRouter') ?>

    <?php // echo $form->field($model, 'TelephonyDNIS') ?>

    <?php // echo $form->field($model, 'DatesAvailable') ?>

    <?php // echo $form->field($model, 'ScheduleAttempted') ?>

    <?php // echo $form->field($model, 'SSAdmin') ?>

    <?php // echo $form->field($model, 'BIN') ?>

    <?php // echo $form->field($model, 'CreditReport') ?>

    <?php // echo $form->field($model, 'SwitchToConsumer') ?>

    <?php // echo $form->field($model, 'SwitchToConsumerReason') ?>

    <?php // echo $form->field($model, 'GoodFit') ?>

    <?php // echo $form->field($model, 'HowDidYouHear') ?>

    <?php // echo $form->field($model, 'FedExOveride') ?>

    <?php // echo $form->field($model, 'Reserve1') ?>

    <?php // echo $form->field($model, 'Reserve2') ?>

    <?php // echo $form->field($model, 'NortonReviewed') ?>

    <?php // echo $form->field($model, 'Norton') ?>

    <?php // echo $form->field($model, 'NortonConsent') ?>

    <?php // echo $form->field($model, 'NortonSold') ?>

    <?php // echo $form->field($model, 'RowDate') ?>

    <?php // echo $form->field($model, 'StaticIP') ?>

    <?php // echo $form->field($model, 'Reserve5') ?>

    <?php // echo $form->field($model, 'Reserve6') ?>

    <?php // echo $form->field($model, 'Beam') ?>

    <?php // echo $form->field($model, 'BeamType') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
