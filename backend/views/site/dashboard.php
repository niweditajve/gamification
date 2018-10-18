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
                    <select class="form-control">
                        <option value=""> Combined Call Centers </option>
                        <option value="1"> ComSol </option>
                        <option value="2"> ComSol Republic </option>
                        <option value="3"> ComSol Springfield </option>
                        <option value="4"> Edgemark </option>
                        <option value="5"> Focus </option>
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
                                746 </p>
                        </div>

                        <div class="order-rate color-red">
                            <span class="arrow-down"></span> 3.33%
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
                                591 </p>
                            <p>  Last week :
                                746 </p>
                        </div>

                        <div class="order-rate color-red">
                            <span class="arrow-down"></span> 3.33%
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
                        <div class="answer-rate">95%</div>
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
                                            <p >Voice Attachment X%</p>

                                        </td>
                                    </tr>
                                    <tr class="table-rate">
                                        <td>
                                            <p >ER Attachment X%</p>
                                        </td>
                                    </tr>
                                    <tr class="table-rate">
                                        <td>
                                            <p >PCE Attachment X%</p>

                                        </td>
                                    </tr>
                                    <tr class="table-rate">
                                        <td>
                                            <p >Norton Attachment X%</p>

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
                                    22% 
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
                                    12% 
                                </div>

                                <div class="order-rate color-green">
                                    <span class="arrow-up"></span> 15.13%
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
                                    19% 
                                </div>

                                <div class="order-rate color-green">
                                    <span class="arrow-up"></span> 15.13%
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
                                    27% 
                                </div>

                                <div class="order-rate color-green">
                                    <span class="arrow-up"></span> 36.84%
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
                                    23% 
                                </div>

                                <div class="order-rate color-green">
                                    <span class="arrow-up"></span> 36.84%
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
     
     function totalCallCount(){
         
         $.ajax({
                type     :'POST',
                cache    : false,
                url      : 'totalcallcount',
                success  : function(response) 
                {
                    var data = $.parseJSON(response);
                    
                    $("#todaysCallsCount").html(data.todaysCount);
                }
         });       
     }
     
    $(document).ready(function(e){
        
        totalCallCount();
        
    });

</script>