<?php
/* @var $this yii\web\View */

$this->title = 'RM Factory';
?>
<div class="site-index">

    <div class="jumbotron">


        <?php if (Yii::$app->user->isGuest): ?>
            You must login.
        <?php else: ?>
            <div class="row">
            <div class="col-md-12">
                <div class="col-md-4">
                    <img src="<?= Yii::$app->request->baseUrl ?>/images/user_dummy.png" height="100px" width="auto">
                </div>
                <div class="col-md-2">
                    Today's Close Rate
                </div>
                <div class="col-md-2">
                    Today's Coomunity Close Rate
                </div>
                <div class="col-md-2">
                    Today's Points Earned
                </div>
                <div class="col-md-2">
                    WTD Points
                </div>
            </div>

            <div class="col-md-12" style="margin-top: 20px; ">
                <div class="col-md-4">
                    
                    Calls <br>
                    Orders <br>
                    Leader <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    Your Center! <br>
                </div>
                <div class="col-md-8">
                        <img src="<?= Yii::$app->request->baseUrl ?>/images/download.jpg" height="200px" width="auto">
                </div>
            </div>

           

            <div class="col-md-12" style="margin-top:20px;">
                <div class="col-md-3">
                    TV Close Rate
                        <div class="container vertical rounded" style="margin-left:40px;">
                          
                          <div class="progress-bar">
                            <div class="progress-track">
                              <div class="progress-fill red">
                                <span>30%</span>
                              </div>
                            </div>
                          </div>
                          <div class="progress-bar">
                            <div class="progress-track">
                              <div class="progress-fill yellow">
                                <span>60%</span>
                              </div>
                            </div>
                          </div>
                      </div>
                </div>

                <div class="col-md-3">
                    Direct Mail Close Rate
                    <div class="container vertical rounded" style="margin-left:40px;">
                          
                          <div class="progress-bar">
                            <div class="progress-track">
                              <div class="progress-fill yellow">
                                <span>60%</span>
                              </div>
                            </div>
                          </div>
                          <div class="progress-bar">
                            <div class="progress-track">
                              <div class="progress-fill green">
                                <span>95%</span>
                              </div>
                            </div>
                          </div>
                      </div>
                </div>

                <div class="col-md-3">
                    Web Close Rate
                    <div class="container vertical rounded" style="margin-left:40px;">
                          <div class="progress-bar">
                            <div class="progress-track">
                              <div class="progress-fill green">
                                <span>90%</span>
                              </div>
                            </div>
                          </div>
                          <div class="progress-bar">
                            <div class="progress-track">
                              <div class="progress-fill red">
                                <span>15%</span>
                              </div>
                            </div>
                          </div>
                      </div>
                </div>

                <div class="col-md-3">
                    Transfers Close Rate
                    <div class="container vertical rounded" style="margin-left:40px;">
                          
                          <div class="progress-bar">
                            <div class="progress-track">
                              <div class="progress-fill red">
                                <span>20%</span>
                              </div>
                            </div>
                          </div>
                          <div class="progress-bar">
                            <div class="progress-track">
                              <div class="progress-fill green">
                                <span>95%</span>
                              </div>
                            </div>
                          </div>
                      </div>
                </div>
            </div>


            <div class="col-md-12" style="margin-top:20px;">
                <div class="col-md-3">
                    Voice Attachment
                        <div class="container vertical rounded" style="margin-left:40px;">
                          
                          <div class="progress-bar">
                            <div class="progress-track">
                              <div class="progress-fill red">
                                <span>30%</span>
                              </div>
                            </div>
                          </div>
                          <div class="progress-bar">
                            <div class="progress-track">
                              <div class="progress-fill yellow">
                                <span>60%</span>
                              </div>
                            </div>
                          </div>
                      </div>

                </div>

                <div class="col-md-3">
                    Express Repair
                    <div class="container vertical rounded" style="margin-left:40px;">
                          
                          <div class="progress-bar">
                            <div class="progress-track">
                              <div class="progress-fill yellow">
                                <span>60%</span>
                              </div>
                            </div>
                          </div>
                          <div class="progress-bar">
                            <div class="progress-track">
                              <div class="progress-fill green">
                                <span>95%</span>
                              </div>
                            </div>
                          </div>
                      </div>
                </div>

                <div class="col-md-3">
                    Norton Attachment
                    <div class="container vertical rounded" style="margin-left:40px;">
                          <div class="progress-bar">
                            <div class="progress-track">
                              <div class="progress-fill green">
                                <span>90%</span>
                              </div>
                            </div>
                          </div>
                          <div class="progress-bar">
                            <div class="progress-track">
                              <div class="progress-fill red">
                                <span>15%</span>
                              </div>
                            </div>
                          </div>
                      </div>
                </div>

                <div class="col-md-3">
                    PCE Attachment
                    <div class="container vertical rounded" style="margin-left:40px;">
                          
                          <div class="progress-bar">
                            <div class="progress-track">
                              <div class="progress-fill red">
                                <span>20%</span>
                              </div>
                            </div>
                          </div>
                          <div class="progress-bar">
                            <div class="progress-track">
                              <div class="progress-fill green">
                                <span>95%</span>
                              </div>
                            </div>
                          </div>
                      </div>
                </div>
            </div>


            <div class="col-md-12" style="margin-top:20px;">
                <div class="col-md-3">
                    Valid Email Address Collection
                        <div class="container vertical rounded" style="margin-left:40px;">
                          
                          <div class="progress-bar">
                            <div class="progress-track">
                              <div class="progress-fill red">
                                <span>30%</span>
                              </div>
                            </div>
                          </div>
                          <div class="progress-bar">
                            <div class="progress-track">
                              <div class="progress-fill yellow">
                                <span>60%</span>
                              </div>
                            </div>
                          </div>
                      </div>
                </div>

                <div class="col-md-3">
                    Mobile Phone Collection
                    <div class="container vertical rounded" style="margin-left:40px;">
                          <div class="progress-bar">
                            <div class="progress-track">
                              <div class="progress-fill yellow">
                                <span>60%</span>
                              </div>
                            </div>
                          </div>
                          <div class="progress-bar">
                            <div class="progress-track">
                              <div class="progress-fill green">
                                <span>95%</span>
                              </div>
                            </div>
                          </div>
                      </div>
                </div>

                <div class="col-md-3">
                    Scheduled Installtion at Safe
                    <div class="container vertical rounded" style="margin-left:40px;">
                          <div class="progress-bar">
                            <div class="progress-track">
                              <div class="progress-fill green">
                                <span>90%</span>
                              </div>
                            </div>
                          </div>
                          <div class="progress-bar">
                            <div class="progress-track">
                              <div class="progress-fill red">
                                <span>15%</span>
                              </div>
                            </div>
                          </div>
                      </div>
                </div>

                <div class="col-md-3">
                    Current Inetrnet Connection
                    <div class="container vertical rounded" style="margin-left:40px;">
                          
                          <div class="progress-bar">
                            <div class="progress-track">
                              <div class="progress-fill red">
                                <span>20%</span>
                              </div>
                            </div>
                          </div>
                          <div class="progress-bar">
                            <div class="progress-track">
                              <div class="progress-fill green">
                                <span>95%</span>
                              </div>
                            </div>
                          </div>
                      </div>
                </div>
            </div>

            

        </div>
            
        <?php endif; ?>

<!-- <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>-->
    </div>

    <div class="body-content">

        <div class="row">
        </div>

    </div>
</div>