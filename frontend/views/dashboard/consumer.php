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
                    <div class="demo-2" data-percent="<?php echo Yii::$app->agentcomponent->getCommunityCloseRate($skillType,$agentId); ?>"></div>
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
                        <img src="<?php echo Yii::$app->request->baseUrl ?>/images/images.png" height="180px" width="550px">
                </div>
            </div>

           

            <div class="col-md-12" style="margin-top:20px;">
                <div class="col-md-3">
                    TV Close Rate
                    <?php 
                    $tv = Yii::$app->agentcomponent->closeRate($skillType,$agentId,"TV");
                    $CommunityTV = Yii::$app->agentcomponent->closeRate($skillType,$agentId,"TV",1);
                    ?>
                        <div class="container vertical rounded" style="margin-left:40px;">
                          
                          <div class="progress-bar">
                            <div class="progress-track">
                              <div class="progress-fill <?php echo Yii::$app->agentcomponent->getColor("tv", $tv); ?>">
                                <span><?php echo $tv; ?>%</span>
                              </div>
                            </div>
                          </div>
                          <div class="progress-bar">
                            <div class="progress-track">
                              <div class="progress-fill <?php echo Yii::$app->agentcomponent->getColor("tv", $CommunityTV); ?>">
                                <span><?php echo $CommunityTV; ?>%</span>
                              </div>
                            </div>
                          </div>
                      </div>
                </div>

                <div class="col-md-3">
                    Direct Mail Close Rate
                    <?php
                    $mail = Yii::$app->agentcomponent->closeRate($skillType,$agentId,"directMail");
                    $directMail = Yii::$app->agentcomponent->closeRate($skillType,$agentId,"directMail",1);
                    ?>
                    <div class="container vertical rounded" style="margin-left:40px;">
                          
                          <div class="progress-bar">
                            <div class="progress-track">
                              <div class="progress-fill <?php echo Yii::$app->agentcomponent->getColor("mail", $mail); ?>">
                                <span><?php echo $mail; ?>%</span>
                              </div>
                            </div>
                          </div>
                          <div class="progress-bar">
                            <div class="progress-track">
                              <div class="progress-fill <?php echo Yii::$app->agentcomponent->getColor("mail", $directMail); ?>">
                                <span><?php echo $directMail; ?>%</span>
                              </div>
                            </div>
                          </div>
                      </div>
                </div>

                <div class="col-md-3">
                    Web Close Rate
                    <?php
                    $web = Yii::$app->agentcomponent->closeRate($skillType,$agentId,"web");
                    $communityWeb = Yii::$app->agentcomponent->closeRate($skillType,$agentId,"web",1);
                    ?>
                    <div class="container vertical rounded" style="margin-left:40px;">
                          <div class="progress-bar">
                            <div class="progress-track">
                              <div class="progress-fill <?php echo Yii::$app->agentcomponent->getColor("web", $web); ?>">
                                <span><?php echo $web; ?>%</span>
                              </div>
                            </div>
                          </div>
                          <div class="progress-bar">
                            <div class="progress-track">
                              <div class="progress-fill <?php echo Yii::$app->agentcomponent->getColor("web", $communityWeb); ?>">
                                <span><?php echo $communityWeb; ?>%</span>
                              </div>
                            </div>
                          </div>
                      </div>
                </div>

                <div class="col-md-3">
                    Transfers Close Rate
                    <?php 
                    $transfer = Yii::$app->agentcomponent->closeRate($skillType,$agentId,"transfer");
                    $CommunityTransfer = Yii::$app->agentcomponent->closeRate($skillType,$agentId,"transfer",1);
                    ?>
                    <div class="container vertical rounded" style="margin-left:40px;">
                          
                          <div class="progress-bar">
                            <div class="progress-track">
                              <div class="progress-fill <?php echo Yii::$app->agentcomponent->getColor("voice", $transfer); ?>">
                                <span><?php echo $transfer; ?>%</span>
                              </div>
                            </div>
                          </div>
                          <div class="progress-bar">
                            <div class="progress-track">
                              <div class="progress-fill  <?php echo Yii::$app->agentcomponent->getColor("voice", $CommunityTransfer); ?>">
                                <span><?php echo $CommunityTransfer; ?>%</span>
                              </div>
                            </div>
                          </div>
                      </div>
                </div>
            </div>

            <div class="col-md-12" style="margin-top:20px;">
                <div class="col-md-3">
                    Voice Attachment
                    <?php 
                    $voices = Yii::$app->agentcomponent->getVoiceAttachement($skillType,$agentId);
                    $voiceCommunity = Yii::$app->agentcomponent->getVoiceAttachement($skillType,$agentId);
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
                    $exp = Yii::$app->agentcomponent->getExpRepairSold($skillType,$agentId);
                    $expCommunity = Yii::$app->agentcomponent->getExpRepairSold($skillType,$agentId,$parentTenantID);
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
                    $pce = Yii::$app->agentcomponent->getPCESold($skillType,$agentId);
                    $pceCommunity = Yii::$app->agentcomponent->getPCESold($skillType,$agentId,$parentTenantID);
                    ?>
                    <div class="container vertical rounded" style="margin-left:40px;">
                          <div class="progress-bar">
                            <div class="progress-track">
                              <div class="progress-fill <?php echo Yii::$app->agentcomponent->getColor("exp", $pce); ?>">
                                <span><?php echo $pce; ?>%</span>
                              </div>
                            </div>
                          </div>
                          <div class="progress-bar">
                            <div class="progress-track">
                              <div class="progress-fill <?php echo Yii::$app->agentcomponent->getColor("exp", $pceCommunity); ?>">
                                <span><?php echo $pceCommunity; ?>%</span>
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
                    <?php $validEmail = Yii::$app->agentcomponent->getValidEmailCollection($skillType,$agentId); 
                    $communityEmail = Yii::$app->agentcomponent->getValidEmailCollection($skillType,$agentId,1);
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
                    $validPhones = Yii::$app->agentcomponent->getValidPhoneCollection($skillType,$agentId); 
                    $communityPhones = Yii::$app->agentcomponent->getValidPhoneCollection($skillType,$agentId);
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
                    Current Internet Connection
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
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
  $(document).ready(function(){
$('.user_image_button').show();
$(".fileinput-button").find("span").text("Change Image");

  });
</script>