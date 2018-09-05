<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CallData */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="call-data-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'CaseID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'UserID')->textInput() ?>

    <?= $form->field($model, 'MediaID')->textInput() ?>

    <?= $form->field($model, 'CallID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ScriptID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'StartedAt')->textInput() ?>

    <?= $form->field($model, 'EndedAt')->textInput() ?>

    <?= $form->field($model, 'Duration')->textInput() ?>

    <?= $form->field($model, 'ScriptVersion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'AgentID')->textInput() ?>

    <?= $form->field($model, 'AgentUserName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DomainCode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DispositionCode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Sale')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CallType')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'AltPhoneNumber')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BestTime')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ServiceType')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BillingAddress1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BillingAddress2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BillingAdrSame')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BillingCity')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BillingFirstName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BillingLastName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BillingState')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BillingZip')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CBDay')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CBPhoneNumber')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CBTime')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CCExpMonth')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CCExpYear')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CCFirstName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CCLastName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CCNumber')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CCType')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CCTypeLong')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Comments')->textInput() ?>

    <?= $form->field($model, 'DialupAccess')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DNIS')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'EmailAddress')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'EmailAddress2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ExpRepairType')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'FlexAmount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'FlexDiscount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'GenerateQuote')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'InstallerNotes')->textInput() ?>

    <?= $form->field($model, 'InstallOption')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'MaintainOption')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NoOrderReason')->textInput() ?>

    <?= $form->field($model, 'NumLocations')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NumStaticIP')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'OriginalANI')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'OwnProperty')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PaymentOption')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PhoneNumber')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PlaceOrder')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PlanName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'QuoteID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ServiceAddress1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ServiceAddress2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ServiceCity')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ServiceFirstName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ServiceLastName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ServicePlan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ServiceState')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ServiceZip')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SomeHeavyUsage')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'StandardBrowsing')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'StaticIPMention')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TransactionID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TransactionTime')->textInput() ?>

    <?= $form->field($model, 'CancelledOrder')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ExpectingMove')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'P10NoSlots')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ResID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BypassP10')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'OrderID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ModTransactionID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'OriginalCallID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'HighSpeedArea')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CheckEligible')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ServicePlanType')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Lowfill')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'AfbCall')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Afb')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'MemberID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'AdID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TicketID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'HowFound')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CreateDate')->textInput() ?>

    <?= $form->field($model, 'ContactID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'MediaType')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ExpeditedInstall')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'RemoteMaintenance4')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'RemoteMaintenance3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DeIce')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Data')->textInput() ?>

    <?= $form->field($model, 'Antenna')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'AntiIce')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'OrderRespCode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'OrderRespMsg')->textInput() ?>

    <?= $form->field($model, 'LastUpdate')->textInput() ?>

    <?= $form->field($model, 'OutboundContactID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ZoneAlarm')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PSE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'MailCode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Reserve3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'VoIP')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'LeaseFail')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'OfferedProducts')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'LeaseFailPIM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'LeaseFailMessage')->textInput() ?>

    <?= $form->field($model, 'VoIPEligible')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'OfferID')->textInput() ?>

    <?= $form->field($model, 'Reserve4')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'POAccepted')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CCSource')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ContactConsent')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'WelcomeFreeForm')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Company')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SWVoIP')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SAN')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DSSStatus')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Activated')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Churn1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Churn2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Churn3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DSSCharge')->textInput() ?>

    <?= $form->field($model, 'SpiceCharge')->textInput() ?>

    <?= $form->field($model, 'Connection')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ServiceZip5')->textInput() ?>

    <?= $form->field($model, 'OneDayCancel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'OfferServices')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CheckServices')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'VEMPim')->textInput() ?>

    <?= $form->field($model, 'NewEmailAttempt')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'VerifyEmailSpelling')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ConfirmEmail')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'VEMAttempts')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'VerizonCustomer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'RAFShortCode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ORDContactID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SelectedInstallDate')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Churn4')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DateInstalled')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'RAFSelected')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'GamingDisc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'StreamingDisc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'VoiceDisc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BonusBytesDisc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SpeedDisc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CreditCheckDisc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ExpRepairReviewed')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ExpRepairConsent')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ExpRepairSold')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PCEReviewed')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PCEConsent')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PCESold')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ZAReviewed')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ZAConsent')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ZASold')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'VoIPReviewed')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'VoIPConsent')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'VoIPSold')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'WirelessDisc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ChargesExplained')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TNCVerbatim')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'AllowanceDisc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'WirelessRouter')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TelephonyDNIS')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DatesAvailable')->textInput() ?>

    <?= $form->field($model, 'ScheduleAttempted')->textInput() ?>

    <?= $form->field($model, 'SSAdmin')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BIN')->textInput() ?>

    <?= $form->field($model, 'CreditReport')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SwitchToConsumer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SwitchToConsumerReason')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'GoodFit')->textInput() ?>

    <?= $form->field($model, 'HowDidYouHear')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'FedExOveride')->textInput() ?>

    <?= $form->field($model, 'Reserve1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Reserve2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NortonReviewed')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Norton')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NortonConsent')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NortonSold')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'RowDate')->textInput() ?>

    <?= $form->field($model, 'StaticIP')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Reserve5')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Reserve6')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Beam')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BeamType')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
