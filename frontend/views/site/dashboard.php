<?php
/* @var $this yii\web\View */
use dosamigos\fileupload\FileUpload;
use yii\helpers\Html; // or yii\helpers\Html
use yii\widgets\ActiveForm; // or yii\widgets\ActiveForm
use yii\widgets\FileInput;

$this->title = 'RM Factory';
?>
<div class="site-index">

    <div class="">


        <?php if (Yii::$app->user->isGuest): ?>
            You must login.
        <?php else: ?>
            <div class="row">
            <div class="col-md-12">
                <div class="col-md-4">

                  

                  <?= FileUpload::widget([
                    'model' => $model,
                    'attribute' => 'profile_pic',
                    'url' => ['site/upload', 'id' => $model->id], // your url, this is just for demo purposes,
                    'options' => ['accept' => 'image/*'],
                    'clientOptions' => [
                        'maxFileSize' => 2000000,
                        'maxHeight' => 100,
                        'maxWidth' => 100,
                    ],

                    // Also, you can specify jQuery-File-Upload events
                    // see: https://github.com/blueimp/jQuery-File-Upload/wiki/Options#processing-callback-options
                    'clientEvents' => [
                        'fileuploaddone' => 'function(e, data) {
                                               var rt = JSON.parse(data.result);
                                               console.log(rt.files[0].name);
                                               console.log(rt.files[0].url);
                                              
                                               $(".user_image").attr("src",rt.files[0].url);
                                            }',
                        'fileuploadfail' => 'function(e, data) {
                                                console.log(e);
                                                console.log(data);
                                            }',
                    ],
                ]); ?>


                

                    <img src="<?= Yii::$app->request->baseUrl ?>/images/user_dummy.png" class="user_image" height="100px" width="auto">
                </div>
                <div class="col-md-2">
                    Today's Close Rate
                    <div class="demo-1" data-percent="30"></div>
              </div>
                <div class="col-md-2">
                    Today's Coomunity Close Rate
                    <div class="demo-2" data-percent="60"></div>
                </div>
                <div class="col-md-2">
                    Today's Points Earned
                    <div class="demo-3" data-percent="90"></div>
                </div>
                <div class="col-md-2">
                    WTD Points
                    <div class="demo-1" data-percent="10"></div>
                </div>
            </div>

            <div class="col-md-12" style="margin-top: 20px; ">
                <div class="col-md-4">
                    
                    My calls <br>
                    My Orders <br>
                    Point leader count <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    Your Center! <br>
                </div>
                <div class="col-md-8">
                        <img alt="Trophy_Image" height="200px" width="auto">
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
