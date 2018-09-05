<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\grid\GridView;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CallDataSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Call Data';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="call-data-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
        <!--<?//= Html::a('Create Call Data', ['create'], ['class' => 'btn btn-success']) ?>-->
    </p>

    <?php
    $dataProvider->pagination->pageSize = 25;
    $gridColumns = [
        'RowID',
        'CreateDate',
        'CaseID',
        'ContactID',
        'DNIS',
        'OriginalANI',
        //'UserID',
        //'MediaID',
        //'CallID',
        'ScriptID',
        'MediaType',
        //'StartedAt',
        //'EndedAt',
        //'Duration',
        //'ScriptVersion',
        'AgentID',
        'AgentUserName',
        //'DomainCode',
        'ServiceFirstName',
        'ServiceLastName',
        'ServiceAddress1',
        'ServiceAddress2',
        'ServiceCity',
        'ServiceState',
        'ServiceZip',
        'EmailAddress:email',
        'ServicePlan',
        'DispositionCode',
        'Sale',
        'OrderRespCode',
        'OrderRespMsg',
        'OrderID',
        'PlanName',
        'CallType',
        //'AltPhoneNumber',
        //'BestTime',
        //'ServiceType',
        'BillingFirstName',
        'BillingLastName',
        'BillingAddress1',
        'BillingAddress2',
        'BillingAdrSame',
        'BillingCity',
        'BillingState',
        'BillingZip',
            //'CBDay',
            //'CBPhoneNumber',
            // 'CBTime',
//            'CCExpMonth',
//            'CCExpYear',
//            'CCFirstName',
//            'CCLastName',
//            'CCNumber',
//            'CCType',
//            'CCTypeLong',
//            'Comments',
//            'DialupAccess',
//            'EmailAddress2:email',
//            'ExpRepairType',
//            'FlexAmount',
//            'FlexDiscount',
//            'GenerateQuote',
//            'InstallerNotes',
//            'InstallOption',
//            'MaintainOption',
//            'NoOrderReason',
//            'NumLocations',
//            'NumStaticIP',
//            'OwnProperty',
//            'PaymentOption',
//            'PhoneNumber',
//            'PlaceOrder',          
//            'QuoteID',
//            'SomeHeavyUsage',
//            'StandardBrowsing',
//            'StaticIPMention',
//            'TransactionID',
//            'TransactionTime',
//            'CancelledOrder',
//            'ExpectingMove',
//            'P10NoSlots',
//            'ResID',
//            'BypassP10',            
//            'ModTransactionID',
//            'OriginalCallID',
//            'HighSpeedArea',
//            'CheckEligible',
//            'ServicePlanType',
//            'Lowfill',
//            'AfbCall',
//            'Afb',
//            'MemberID',
//            'AdID',
//            'TicketID',
//            'HowFound',           
//            'ExpeditedInstall',
//            'RemoteMaintenance4',
//            'RemoteMaintenance3',
//            'DeIce',
//            'Data',
//            'Antenna',
//            'AntiIce',           
//            'LastUpdate',
//            'OutboundContactID',
//            'ZoneAlarm',
//            'PSE',
//            'MailCode',
//            'Reserve3',
//            'VoIP',
//            'LeaseFail',
//            'OfferedProducts',
//            'LeaseFailPIM',
//            'LeaseFailMessage',
//            'VoIPEligible',
//            'OfferID',
//            'Reserve4',
//            'POAccepted',
//            'CCSource',
//            'ContactConsent',
//            'WelcomeFreeForm',
//            'Company',
//            'SWVoIP',
//            'SAN',
//            'DSSStatus',
//            'Activated',
//            'Churn1',
//            'Churn2',
//            'Churn3',
//            'DSSCharge',
//            'SpiceCharge',
//            'Connection',
//            'ServiceZip5',
//            'OneDayCancel',
//            'OfferServices',
//            'CheckServices',
//            'VEMPim',
//            'NewEmailAttempt:email',
//            'VerifyEmailSpelling:email',
//            'ConfirmEmail:email',
//            'VEMAttempts',
//            'VerizonCustomer',
//            'RAFShortCode',
//            'ORDContactID',
//            'SelectedInstallDate',
//            'Churn4',
//            'DateInstalled:ntext',
//            'RAFSelected',
//            'GamingDisc',
//            'StreamingDisc',
//            'VoiceDisc',
//            'BonusBytesDisc',
//            'SpeedDisc',
//            'CreditCheckDisc',
//            'ExpRepairReviewed',
//            'ExpRepairConsent',
//            'ExpRepairSold',
//            'PCEReviewed',
//            'PCEConsent',
//            'PCESold',
//            'ZAReviewed',
//            'ZAConsent',
//            'ZASold',
//            'VoIPReviewed',
//            'VoIPConsent',
//            'VoIPSold',
//            'WirelessDisc',
//            'ChargesExplained',
//            'TNCVerbatim',
//            'AllowanceDisc',
//            'WirelessRouter',
//            'TelephonyDNIS',
//            'DatesAvailable',
//            'ScheduleAttempted',
//            'SSAdmin',
//            'BIN',
//            'CreditReport',
//            'SwitchToConsumer',
//            'SwitchToConsumerReason:ntext',
//            'GoodFit',
//            'HowDidYouHear',
//            'FedExOveride',
//            'Reserve1',
//            'Reserve2',
//            'NortonReviewed',
//            'Norton',
//            'NortonConsent',
//            'NortonSold',
//            'RowDate',
//            'StaticIP',
//            'Reserve5',
//            'Reserve6',
//            'Beam',
//            'BeamType',
    ];
    $filename = 'calldata_' . date('YmdHis');
    echo ExportMenu::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns,
        'filename' => $filename,
        'exportConfig' => [
            ExportMenu::FORMAT_PDF => false,
            ExportMenu::FORMAT_TEXT => false,
            ExportMenu::FORMAT_EXCEL => false,],
    ]);
    ?>

    <?php Pjax::begin(); ?>    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            //'RowID',
            'CaseID',
            //'UserID',
            //'MediaID',
            //'CallID',
            //'ScriptID',
            //'StartedAt',
            //'EndedAt',
            //'Duration',
            //'ScriptVersion',
            'AgentID',
            //'AgentUserName',
            //'DomainCode',
            //'DispositionCode',
            //'Sale',
            //'CallType',
            //'AltPhoneNumber',
            //'BestTime',
            //'ServiceType',
            //'BillingAddress1',
            //'BillingAddress2',
            //'BillingAdrSame',
            //'BillingCity',
            //'BillingFirstName',
            //'BillingLastName',
            //'BillingState',
            //'BillingZip',
            //'CBDay',
            //'CBPhoneNumber',
            //'CBTime',
            //'CCExpMonth',
            //'CCExpYear',
            //'CCFirstName',
            //'CCLastName',
            //'CCNumber',
            //'CCType',
            //'CCTypeLong',
            //'Comments',
            //'DialupAccess',
            'DNIS',
            //'EmailAddress:email',
            //'EmailAddress2:email',
            //'ExpRepairType',
            //'FlexAmount',
            //'FlexDiscount',
            //'GenerateQuote',
            //'InstallerNotes',
            //'InstallOption',
            //'MaintainOption',
            //'NoOrderReason',
            //'NumLocations',
            //'NumStaticIP',
            'OriginalANI',
            //'OwnProperty',
            //'PaymentOption',
            //'PhoneNumber',
            //'PlaceOrder',
            //'PlanName',
            //'QuoteID',
            'ServiceAddress1',
            //'ServiceAddress2',
            //'ServiceCity',
            //'ServiceFirstName',
            //'ServiceLastName',
            //'ServicePlan',
            //'ServiceState',
            //'ServiceZip',
            //'SomeHeavyUsage',
            //'StandardBrowsing',
            //'StaticIPMention',
            //'TransactionID',
            //'TransactionTime',
            //'CancelledOrder',
            //'ExpectingMove',
            //'P10NoSlots',
            //'ResID',
            //'BypassP10',
            //'OrderID',
            //'ModTransactionID',
            //'OriginalCallID',
            //'HighSpeedArea',
            //'CheckEligible',
            //'ServicePlanType',
            //'Lowfill',
            //'AfbCall',
            //'Afb',
            //'MemberID',
            //'AdID',
            //'TicketID',
            //'HowFound',
            'CreateDate',
            //'ContactID',
            //'MediaType',
            //'ExpeditedInstall',
            //'RemoteMaintenance4',
            //'RemoteMaintenance3',
            //'DeIce',
            //'Data',
            //'Antenna',
            //'AntiIce',
            //'OrderRespCode',
            //'OrderRespMsg',
            //'LastUpdate',
            //'OutboundContactID',
            //'ZoneAlarm',
            //'PSE',
            //'MailCode',
            //'Reserve3',
            //'VoIP',
            //'LeaseFail',
            //'OfferedProducts',
            //'LeaseFailPIM',
            //'LeaseFailMessage',
            //'VoIPEligible',
            //'OfferID',
            //'Reserve4',
            //'POAccepted',
            //'CCSource',
            //'ContactConsent',
            //'WelcomeFreeForm',
            //'Company',
            //'SWVoIP',
            //'SAN',
            //'DSSStatus',
            //'Activated',
            //'Churn1',
            //'Churn2',
            //'Churn3',
            //'DSSCharge',
            //'SpiceCharge',
            //'Connection',
            //'ServiceZip5',
            //'OneDayCancel',
            //'OfferServices',
            //'CheckServices',
            //'VEMPim',
            //'NewEmailAttempt:email',
            //'VerifyEmailSpelling:email',
            //'ConfirmEmail:email',
            //'VEMAttempts',
            //'VerizonCustomer',
            //'RAFShortCode',
            //'ORDContactID',
            //'SelectedInstallDate',
            //'Churn4',
            //'DateInstalled:ntext',
            //'RAFSelected',
            //'GamingDisc',
            //'StreamingDisc',
            //'VoiceDisc',
            //'BonusBytesDisc',
            //'SpeedDisc',
            //'CreditCheckDisc',
            //'ExpRepairReviewed',
            //'ExpRepairConsent',
            //'ExpRepairSold',
            //'PCEReviewed',
            //'PCEConsent',
            //'PCESold',
            //'ZAReviewed',
            //'ZAConsent',
            //'ZASold',
            //'VoIPReviewed',
            //'VoIPConsent',
            //'VoIPSold',
            //'WirelessDisc',
            //'ChargesExplained',
            //'TNCVerbatim',
            //'AllowanceDisc',
            //'WirelessRouter',
            //'TelephonyDNIS',
            //'DatesAvailable',
            //'ScheduleAttempted',
            //'SSAdmin',
            //'BIN',
            //'CreditReport',
            //'SwitchToConsumer',
            //'SwitchToConsumerReason:ntext',
            //'GoodFit',
            //'HowDidYouHear',
            //'FedExOveride',
            //'Reserve1',
            //'Reserve2',
            //'NortonReviewed',
            //'Norton',
            //'NortonConsent',
            //'NortonSold',
            //'RowDate',
            //'StaticIP',
            //'Reserve5',
            //'Reserve6',
            //'Beam',
            //'BeamType',
            ['class' => 'yii\grid\ActionColumn',
                'header' => 'Actions',
                'template' => '{viewquick} {newcase}',
                'buttons' => [
                    'viewquick' => Yii::$app->user->can('admin_cc') ?
                            function ($url) {
                                return Html::a(
                                                '<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                                            'title' => 'View',
                                            'data-pjax' => '0',
                                                ]
                                );
                            } : function ($url) {
                                return '';
                            },
                    'newcase' => Yii::$app->user->can('admin_cc') ?
                            function ($url) {
                                return Html::a(
                                                '<span class="glyphicon glyphicon-hand-right"></span>', $url, [
                                            'title' => 'Open new case',
                                            'data-pjax' => '0',
                                                ]
                                );
                            } : function ($url) {
                                return '';
                            },
                ]
            ],
        ],
    ]);
    ?>
    <?php Pjax::end(); ?>
</div>
