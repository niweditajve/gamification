<?php
/* @var $this yii\web\View */

$this->title = 'RM Factory';
?>


<link href="<?= Yii::$app->request->baseUrl ?>/css/admin-dashboard.css?v=1.0.0" rel="stylesheet" />


<div class="site-index">

    <div class="container">
        
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <select class="form-control" id="call_center">
                        <option value="all"> Combined Call Centers </option>
                        <option value="6"> ComSol </option>
                        <option value="19"> ComSol Republic </option>
                        <option value="11"> ComSol Springfield </option>
                        <option value="25"> Edgemark </option>
                        <option value="10"> Focus </option>
                    </select>
                </div>
                
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <div class="card card-chart">
                    <div class="card-header">
                        <h5 class=""> Calls now/Calls Last week </h5>
                        Same time

                    </div>
                    <div class="card-body">
                        <div class="order-count">
                            <p> Today : 
                                <span id="todaysCallsCount"> </span>
                            </p>
                            <p>  Last week :
                                <span id="lastWeekCallsCount"> <span>
                            </p>
                        </div>

                        <div class="order-rate">
                            <div id="callsArrowType">
                                
                            </div>
                            <span id="callsRate"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card card-chart">
                    <div class="card-header">
                        <h5 class="">Orders now/Orders Last week </h5>
                        Same time

                    </div>
                    <div class="card-body">
                        <div class="order-count">
                            <p> Today : 
                                <span id="todaysOrdersCount"></span>
                            </p>
                            <p>  Last week :
                                <span id="lastWeekOrdersCount"></span>
                            </p>
                        </div>

                        <div class="order-rate">
                            <div id="ordersArrowType">
                                
                            </div> 
                            
                            <span id="ordersRate"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card card-chart">
                    <div class="card-header">
                        <h5 class="">Answer Rate</h5>

                    </div>
                    <div class="card-body">
                        <div class="answer-rate"><span id="answerRate"></span>%</div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="card">

                    <div class="card-body" style="padding: 15px;">
                        <div class="table-full-width">
                            <table class="table">
                                <tbody>
                                    <tr class="table-rate">
                                        <td>
                                            <p >Voice Attachment <span id="voiceRate"></span>%</p>

                                        </td>
                                    </tr>
                                    <tr class="table-rate">
                                        <td>
                                            <p >ER Attachment <span id="erRate"></span>%</p>
                                        </td>
                                    </tr>
                                    <tr class="table-rate">
                                        <td>
                                            <p >PCE Attachment <span id="pceRate"></span>%</p>

                                        </td>
                                    </tr>
                                    <tr class="table-rate">
                                        <td>
                                            <p >Norton Attachment <span id="nortonRate"></span>%</p>

                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-12" >
                        <div class="card card-chart" style="min-height: 450px;">
                            <div class="card-header">
                                <h5 class="card-category">Current Close Rate</h5>
                                <h3 class="card-title"> </h3>
                            </div>
                            <div class="card-body">
                                <div class="main-order-percentage">
                                    <span id="currentCloseRate"></span>% 
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>


            </div>
            <div class="col-lg-6">

                <div class="row">
                    <div class="col-lg-6" >
                        <div class="card card-chart">
                            <div class="card-header">
                                <h5 class="">TV Close Rate</h5>

                            </div>
                            <div class="card-body">
                                <div class="order-percentage">
                                    <span id="tvCloseRate"></span>% 
                                </div>

                                <div id="tvColorText" class="order-rate">
                                    <div id="tvArrowType"></div>
                                    <span id="tvCloseWeekRate"></span>%
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6" >
                        <div class="card card-chart">
                            <div class="card-header">
                                <h5 class="">DM Close Rate</h5>

                            </div>
                            <div class="card-body">
                                <div class="order-percentage">
                                    <span id="dmCloseRate"></span>% 
                                </div>

                                <div id="dmColorText" class="order-rate">
                                    <div id="dmArrowType"></div>
                                    <span id="dmCloseWeekRate"></span>%
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6" >
                        <div class="card card-chart">
                            <div class="card-header">
                                <h5 class="">Web Close Rate</h5>

                            </div>
                            <div class="card-body">
                                <div class="order-percentage">
                                    <span id="webCloseRate"></span>% 
                                </div>

                                <div id="webColorText" class="order-rate">
                                    <div id="webArrowType"></div>
                                    <span id="webCloseWeekRate"></span>%
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6" >
                        <div class="card card-chart">
                            <div class="card-header">
                                <h5 class="">Transfer Close Rate</h5>

                            </div>
                            <div class="card-body">
                                <div class="order-percentage">
                                    <span id="transferCloseRate"></span>% 
                                </div>

                                <div id="transferColorText" class="order-rate">
                                    <div id="transferArrowType"></div>
                                    <span id="transferCloseWeekRate"></span>%
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
        </div>

    </div>

</div>
<script>
     
     function callsValues(){
         
         var call_center = $("#call_center").val();
         
            $.ajax({
                type     :'POST',
                cache    : false,
                url      : '<?= Yii::$app->urlManager->createUrl('') ?>/site/totalcallcount',
                data     : {
                    'call_center' : call_center
                    },
                success  : function(response) 
                {
                    var data = $.parseJSON(response);
                    
                    $("#todaysCallsCount").html(data.todaysCount);
                    $("#lastWeekCallsCount").html(data.lastWeekCount);
                    $("#callsRate").html(data.callsRate);
                    $("#callsArrowType").html("<span class='"+data.arrowType+"'></span>");
                    if( new Number(data.callsActualRate) < 0 )
                        $("#callsRate").css("color" , "red");
                    else
                        $("#callsRate").css("color" , "green"); 
                    
                }
         });       
     }
     
     function ordersValues(){
         
         var call_center = $("#call_center").val();
         
            $.ajax({
                type     :'POST',
                cache    : false,
                url      : '<?= Yii::$app->urlManager->createUrl('') ?>/site/totalorderscount',
                data     : {
                    'call_center' : call_center
                    },
                success  : function(response) 
                {
                    var data = $.parseJSON(response);
                    
                    $("#todaysOrdersCount").html(data.todaysCount);
                    $("#lastWeekOrdersCount").html(data.lastWeekCount);
                    $("#ordersRate").html(data.callsRate);
                    $("#ordersArrowType").html("<span class='"+data.arrowType+"'></span>");
                    if( new Number(data.ordersActualRate) < 0 )
                        $("#ordersRate").css("color" , "red");
                    else
                        $("#ordersRate").css("color" , "green"); 
                }
         });       
     }
     
     function answerRate(){
         var call_center = $("#call_center").val();
         
            $.ajax({
                type     :'POST',
                cache    : false,
                url      : '<?= Yii::$app->urlManager->createUrl('') ?>/site/answerrate',
                data     : {
                    'call_center' : call_center
                    },
                success  : function(response) 
                {
                    var data = $.parseJSON(response);
                    
                    $("#answerRate").html(data.answerRate);
                }
         });   
        
     }
     
     function attachmentRate(){
     
        var call_center = $("#call_center").val();
         
            $.ajax({
                type     :'POST',
                cache    : false,
                url      : '<?= Yii::$app->urlManager->createUrl('') ?>/site/attachementrate',
                data     : {
                    'call_center' : call_center
                    },
                success  : function(response) 
                {
                    var data = $.parseJSON(response);
                    
                    $("#voiceRate").html(data.voiceRate);
                    $("#erRate").html(data.erRate);
                    $("#pceRate").html(data.pceRate);
                    $("#nortonRate").html(data.nortonRate);
                }
         });   
     }
     
     function currentRate(){
     
        var call_center = $("#call_center").val();
         
            $.ajax({
                type     :'POST',
                cache    : false,
                url      : '<?= Yii::$app->urlManager->createUrl('') ?>/site/currentcloserate',
                data     : {
                    'call_center' : call_center
                    },
                success  : function(response) 
                {
                    var data = $.parseJSON(response);
                    
                    $("#currentCloseRate").html(data.currentCloseRate);
                    
                }
         });   
     }
     
     function closeRates(){
     
        var call_center = $("#call_center").val();
         
            $.ajax({
                type     :'POST',
                cache    : false,
                url      : '<?= Yii::$app->urlManager->createUrl('') ?>/site/closerates',
                data     : {
                    'call_center' : call_center
                    },
                success  : function(response) 
                {
                    var data = $.parseJSON(response);
                    
                    $("#tvCloseRate").html(data.tvCloseRate);                    
                    $("#tvCloseWeekRate").html(data.tvCloseWeekRate);
                    $("#tvColorText").addClass(data.tvColorText);
                    $("#tvArrowType").html("<span class='"+data.tvArrowType+"'></span>");
                    
                    $("#dmCloseRate").html(data.dmCloseRate);                    
                    $("#dmCloseWeekRate").html(data.dmCloseWeekRate);
                    $("#dmColorText").addClass(data.dmColorText);
                    $("#dmArrowType").html("<span class='"+data.dmArrowType+"'></span>");
                    
                    $("#webCloseRate").html(data.webCloseRate);
                    $("#webCloseWeekRate").html(data.webCloseWeekRate);
                    $("#webColorText").addClass(data.webColorText);
                    $("#webArrowType").html("<span class='"+data.webArrowType+"'></span>");
                    
                    $("#transferCloseRate").html(data.transferCloseRate);
                    $("#transferCloseWeekRate").html(data.transferCloseWeekRate);
                    $("#transferColorText").addClass(data.transferColorText);
                    $("#transferArrowType").html("<span class='"+data.transferArrowType+"'></span>");

                    
                }
         });   
     }
     
     function loadFunctions(){
     
        callsValues();
        
        ordersValues();
        
        answerRate();
        
        attachmentRate();
        
        currentRate();
        
        closeRates();
     }
     
     
    $(document).ready(function(e){
        
        loadFunctions();
        
        $('#call_center').on('change', function() {
            loadFunctions();
        });
        
        setInterval(function(){
            loadFunctions(); // this will run after every 30 seconds
            // type 900000 for 15 minutes
        }, 30000); 
        
    });

</script>