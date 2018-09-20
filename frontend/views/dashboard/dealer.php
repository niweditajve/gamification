<?php
/* @var $this yii\web\View */
use dosamigos\fileupload\FileUpload;
 // or yii\helpers\Html
// or yii\widgets\ActiveForm
use yii\widgets\FileInput;

$this->title = 'RM Factory';

$agent = Yii::$app->agentcomponent->getAgentId();

$agentId = $agent['AgentID']; 
$parentTenantID = $agent['ParentTenantID'];
?>
<style>
.jumbotron .btn{
      font-size: 13px;
    padding: 10px 15px;
  }
  .fileinput-button> .glyphicon-plus  {
    display: none;
}
.user_image_button {
    display: none;
}

</style>
<div class="site-index">

    <div class="jumbotron">


        <?php if (Yii::$app->user->isGuest): ?>
            You must login.
        <?php elseif(empty($agentId)): ?>
            Sorry Agent not found
        <?php else: ?>
            <div class="row">
            <div class="col-md-12">
                <div class="col-md-4">
                  <?php if($profile == ""): ?>
                    <img src="<?php echo Yii::$app->request->baseUrl ?>/images/user_dummy.png" class="user_image" height="100px" width="auto">
                  <?php else: ?>
                    <img src="<?php echo Yii::$app->request->baseUrl  . '/images/user/' . $profile ?>" class="user_image" height="100px" width="auto">
                  <?php endif; ?>
                    
                    <div style="padding-top:4px;" class="user_image_button">
                     <?php echo FileUpload::widget([
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
              </div>
                </div>
                <div class="col-md-2">
                    Today's Close Rate
                    <div class="demo-1" data-percent="<?php echo Yii::$app->agentcomponent->getTodaysCloseRate($skillType,$agentId); ?>"></div>
              </div>
                <div class="col-md-2">
                    Today's Community Close Rate
                    <div class="demo-2" data-percent="<?php echo Yii::$app->agentcomponent->getTodaysCloseRate($skillType,$agentId,$parentTenantID); ?>"></div>
                </div>
                <div class="col-md-2">
                    Today's Points Earned
                    <div class="demo-3" data-percent="<?php echo Yii::$app->agentcomponent->getTodaysPoints($agentId); ?>"></div>
                </div>
                <div class="col-md-2">
                    WTD Points
                    <div class="demo-1" data-percent="<?php echo Yii::$app->agentcomponent->getTodaysPoints($agentId,1); ?>"></div>
                </div>
            </div>

            <div class="col-md-12" style="margin-top: 20px; ">
                <div class="col-md-4">
                    <?php $calls = Yii::$app->agentcomponent->getTotalCalls($agentId,$skillType); ?>
                    <?php echo $calls['answered'] ? $calls['answered'] :0; ?> My calls <br>
                    <?php echo $calls['orders'] ? $calls['orders'] : 0; ?> My Orders <br>
                    <?php echo Yii::$app->agentcomponent->getLeaderPoints($skillType) ? Yii::$app->agentcomponent->getLeaderPoints($skillType) : 0; ?> Point leader count <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    You Vs. Your Center! <br>
                </div>
                <div class="col-md-8">
                        <?php
                    
                    $sliderArray = Yii::$app->agentcomponent->getTrophies($agentId);
                   
                    echo \aki\imageslider\ImageSlider::widget([
                        'baseUrl' => Yii::getAlias('@web/images'),
                        'nextPerv' => true,
                        'indicators' => false,
                        'height' => '170px',
                        'classes' => 'img-rounded',
                        'images' => $sliderArray                        
                    ]); ?>
                </div>
            </div>

           

            <div class="col-md-12" style="margin-top:20px;">
                <div class="col-md-3">
                    Voice Attachment
                    <?php 
                    $voices = Yii::$app->agentcomponent->getRate($skillType,$agentId,"voice");
                    $voiceCommunity = Yii::$app->agentcomponent->getRate($skillType,$agentId,"voice",$parentTenantID);
                    ?>
                    <div class="container vertical rounded" style="margin-left:40px;">
                          
                          <div class="progress-bar">
                            <div class="progress-track">
                              <div class="progress-fill <?php echo Yii::$app->agentcomponent->getColor("voice", $voices); ?>">
                                <span><?php echo $voices; ?>%</span>
                              </div>
                            </div>
                          </div>
                          <div class="progress-bar">
                            <div class="progress-track">
                              <div class="progress-fill <?php echo Yii::$app->agentcomponent->getColor("voice", $voiceCommunity); ?>">
                                <span><?php echo $voiceCommunity; ?>%</span>
                              </div>
                            </div>
                          </div>
                      </div>
                </div>
                
                <div class="col-md-3">
                    Express Repair
                    <?php 
                    $exp = Yii::$app->agentcomponent->getRate($skillType,$agentId,"ExpRepairSold");
                    $expCommunity = Yii::$app->agentcomponent->getRate($skillType,$agentId,"ExpRepairSold",$parentTenantID);
                    ?>
                    <div class="container vertical rounded" style="margin-left:40px;">
                          <div class="progress-bar">
                            <div class="progress-track">
                              <div class="progress-fill <?php echo Yii::$app->agentcomponent->getColor("exp", $exp); ?>">
                                <span><?php echo $exp; ?>%</span>
                              </div>
                            </div>
                          </div>
                          <div class="progress-bar">
                            <div class="progress-track">
                              <div class="progress-fill <?php echo Yii::$app->agentcomponent->getColor("exp", $expCommunity); ?>">
                                <span><?php echo $expCommunity; ?>%</span>
                              </div>
                            </div>
                          </div>
                      </div>
                </div>

                <div class="col-md-3">
                    Norton Attachment
                    <?php 
                        $norton = Yii::$app->agentcomponent->getRate($skillType,$agentId,"NortonSold");
                        $nortonCommunity = Yii::$app->agentcomponent->getRate($skillType,$agentId,"NortonSold",$parentTenantID);
                    ?>
                    <div class="container vertical rounded" style="margin-left:40px;">
                          <div class="progress-bar">
                            <div class="progress-track">
                              <div class="progress-fill <?php echo Yii::$app->agentcomponent->getColor("norton", $norton); ?>">
                                <span><?php echo $norton?>%</span>
                              </div>
                            </div>
                          </div>
                          <div class="progress-bar">
                            <div class="progress-track">
                              <div class="progress-fill <?php echo Yii::$app->agentcomponent->getColor("norton", $nortonCommunity); ?>">
                                <span><?php echo $nortonCommunity?>%</span>
                              </div>
                            </div>
                          </div>
                      </div>
                </div>

                <div class="col-md-3">
                    PCE Attachment
                    <?php 
                        $pce = Yii::$app->agentcomponent->getRate($skillType,$agentId,"PCESold");
                        $pceCommunity = Yii::$app->agentcomponent->getRate($skillType,$agentId,"PCESold",$parentTenantID);
                    ?>
                    <div class="container vertical rounded" style="margin-left:40px;">
                          
                          <div class="progress-bar">
                            <div class="progress-track">
                              <div class="progress-fill <?php echo Yii::$app->agentcomponent->getColor("pce", $pce); ?>">
                                <span><?php echo $pce; ?>%</span>
                              </div>
                            </div>
                          </div>
                          <div class="progress-bar">
                            <div class="progress-track">
                              <div class="progress-fill <?php echo Yii::$app->agentcomponent->getColor("pce", $pceCommunity); ?>">
                                <span><?php echo $pceCommunity; ?>%</span>
                              </div>
                            </div>
                          </div>
                      </div>
                </div>
            </div>

            <div class="col-md-12" style="margin-top:20px;">
                
                <div class="col-md-3">
                    Credit Card Orders
                    <?php 
                    $ccorders = Yii::$app->agentcomponent->getRate($skillType,$agentId,"CCNumber");
                    $ccordersCommunity = Yii::$app->agentcomponent->getRate($skillType,$agentId,"CCNumber",$parentTenantID);
                    ?>
                    <div class="container vertical rounded" style="margin-left:40px;">
                          
                          <div class="progress-bar">
                            <div class="progress-track">
                              <div class="progress-fill <?php echo Yii::$app->agentcomponent->getColor("ccorders", $ccorders); ?>">
                                <span><?php echo $ccorders; ?>%</span>
                              </div>
                            </div>
                          </div>
                          <div class="progress-bar">
                            <div class="progress-track">
                              <div class="progress-fill <?php echo Yii::$app->agentcomponent->getColor("ccorders", $ccordersCommunity); ?>">
                                <span><?php echo $ccordersCommunity; ?>%</span>
                              </div>
                            </div>
                          </div>
                      </div>
                </div>
            

                <div class="col-md-3">
                    Valid email address collection
                    <?php $validEmail = Yii::$app->agentcomponent->getRate($skillType,$agentId,"EmailAddress"); 
                    $communityEmail = Yii::$app->agentcomponent->getRate($skillType,$agentId,"EmailAddress",$parentTenantID);
                    ?>
                    <div class="container vertical rounded" style="margin-left:40px;">
                          
                          <div class="progress-bar">
                            <div class="progress-track">
                              <div class="progress-fill <?php echo Yii::$app->agentcomponent->getColor("Email", $validEmail); ?>">
                                <span><?php echo $validEmail; ?>%</span>
                              </div>
                            </div>
                          </div>
                          <div class="progress-bar">
                            <div class="progress-track">
                              <div class="progress-fill <?php echo Yii::$app->agentcomponent->getColor("Email", $communityEmail); ?>">
                                <span><?php echo $communityEmail; ?>%</span>
                              </div>
                            </div>
                          </div>
                      </div>
                </div>

                <div class="col-md-3">
                    Mobile Phone Collection
                    <?php 
                    $validPhones = Yii::$app->agentcomponent->getRate($skillType,$agentId,"PhoneNumber"); 
                    $communityPhones = Yii::$app->agentcomponent->getRate($skillType,$agentId,"PhoneNumber",$parentTenantID);
                    ?>
                    <div class="container vertical rounded" style="margin-left:40px;">
                          <div class="progress-bar">
                            <div class="progress-track">
                              <div class="progress-fill <?php echo Yii::$app->agentcomponent->getColor("phone", $validPhones); ?>">
                                <span><?php echo $validPhones;?>%</span>
                              </div>
                            </div>
                          </div>
                          <div class="progress-bar">
                            <div class="progress-track">
                              <div class="progress-fill <?php echo Yii::$app->agentcomponent->getColor("phone", $communityPhones); ?>">
                                <span><?php echo $communityPhones;?>%</span>
                              </div>
                            </div>
                          </div>
                      </div>
                </div>

                <div class="col-md-3">
                    Scheduled Installation at Safe
                    <?php 
                        $scheduleInstall = Yii::$app->agentcomponent->getRate($skillType,$agentId,"ScheduleAttempted"); 
                        $scheduleInstallCommunity = Yii::$app->agentcomponent->getRate($skillType,$agentId,"ScheduleAttempted",$parentTenantID);
                    ?>
                    <div class="container vertical rounded" style="margin-left:40px;">
                          <div class="progress-bar">
                            <div class="progress-track">
                              <div class="progress-fill <?php echo Yii::$app->agentcomponent->getColor("install", $scheduleInstall); ?>">
                                <span><?php echo $scheduleInstall;?>%</span>
                              </div>
                            </div>
                          </div>
                          <div class="progress-bar">
                            <div class="progress-track">
                              <div class="progress-fill <?php echo Yii::$app->agentcomponent->getColor("install", $scheduleInstallCommunity); ?>">
                                <span><?php echo $scheduleInstallCommunity;?>%</span>
                              </div>
                            </div>
                          </div>
                      </div>
                </div>
            </div>


            <div class="col-md-12" style="margin-top:20px;">
                <div class="col-md-3">
                    Current Internet Connection
                    <?php 
                        $currentConnection = Yii::$app->agentcomponent->getRate($skillType,$agentId,"Connection"); 
                        $currentConnectionCommunity = Yii::$app->agentcomponent->getRate($skillType,$agentId,"Connection",$parentTenantID);
                    ?>
                    <div class="container vertical rounded" style="margin-left:40px;">
                          
                          <div class="progress-bar">
                            <div class="progress-track">
                              <div class="progress-fill <?php echo Yii::$app->agentcomponent->getColor("connection", $currentConnection); ?>">
                                <span><?php echo $currentConnection;?>%</span>
                              </div>
                            </div>
                          </div>
                          <div class="progress-bar">
                            <div class="progress-track">
                              <div class="progress-fill <?php echo Yii::$app->agentcomponent->getColor("connection", $currentConnectionCommunity); ?>">
                                <span><?php echo $currentConnectionCommunity;?>%</span>
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
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
  $(document).ready(function(){
$('.user_image_button').show();
$(".fileinput-button").find("span").text("Change Image");

  });
</script>