<?php
/* @var $this yii\web\View */
use dosamigos\fileupload\FileUpload;

$this->title = 'Consumer';

// find agent id of logged in user
$agent = Yii::$app->agentcomponent->getAgentId();
$agentId = $agent['AgentID'];

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
        <?php elseif (empty($agentId)): ?>
            Sorry Agent not found!!
        <?php else: ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-4">
                        <?php if ($profile == ""): ?>
                            <img src="<?php echo Yii::$app->request->baseUrl ?>/images/user_dummy.png" class="user_image" height="100px" width="auto">
                        <?php else: ?>
                            <img src="<?php echo Yii::$app->request->baseUrl . '/images/user/' . $profile ?>" class="user_image" height="100px" width="auto">
                        <?php endif; ?>

                        <div style="padding-top:4px;" class="user_image_button">
                            <?php
                            // Widegt to change user image 
                            echo FileUpload::widget([
                                'model' => $model,
                                'attribute' => 'profile_pic',
                                'url' => ['site/upload', 'id' => $model->id], // Url,
                                'options' => ['accept' => 'image/*'], // Allowed file types
                                'clientOptions' => [
                                    'maxFileSize' => 2000000,
                                    'maxHeight' => 100,
                                    'maxWidth' => 100,
                                ],
                                'clientEvents' => [
                                    'fileuploaddone' => 'function(e, data) {
                                               var rt = JSON.parse(data.result);                                              
                                               $(".user_image").attr("src",rt.files[0].url);
                                            }',
                                    'fileuploadfail' => 'function(e, data) {
                                                alert("please try again, Image could not be uploaded");
                                            }',
                                ],
                            ]);
                            ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <span class="top-text">Today's Close Rate</span>
                        <div class="demo-1" data-percent="<?php echo Yii::$app->agentcomponent->getTodaysCloseRate($skillType, $agentId); ?>"></div>
                    </div>
                    <div class="col-md-2">
                        <span class="top-text">Today's Community Close Rate </span>
                        <div class="demo-2" data-percent="<?php echo Yii::$app->agentcomponent->getTodaysCloseRate($skillType, $agentId, $community); ?>"></div>
                    </div>
                    <div class="col-md-2">
                        <span class="top-text"> Today's Points Earned  </span>
                        <div class="demo-3" data-percent="<?php echo Yii::$app->agentcomponent->getTodaysPoints($agentId); ?>" data-nopercentage="1"></div>
                    </div>
                    <div class="col-md-2">
                        <span class="top-text">WTD Points </span>
                        <div class="demo-1" data-percent="<?php echo Yii::$app->agentcomponent->getTodaysPoints($agentId, 1); ?>" data-nopercentage="1"></div>
                    </div>
                </div>

                <div class="col-md-12" style="margin-top: 20px; ">
                    <div class="col-md-4">
                        <?php $calls = Yii::$app->agentcomponent->getTotalCalls($agentId, $skillType); ?>
                        <?php
                        echo $calls['answered'] ? $calls['answered'] : 0;
                        echo " " . $category["orders"]["title"];
                        ?> 
                        <br>
                        <?php
                        echo $calls['orders'] ? $calls['orders'] : 0;
                        echo " " . $category["allOrders"]["title"];
                        ?>
                        <br>
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
                        ]);
                        ?>
                    </div>
                </div>



                <div class="col-md-12" style="margin-top:20px; padding-bottom: 25px;">
                    <div class="col-md-3">
                        <span class="category-text"> 
                            <?php
                        echo $category["TV"]["title"]; ?>
                        </span>
                        <?php
                        
                        $tv = Yii::$app->agentcomponent->closeRate($agentId, "TV");
                        $CommunityTV = Yii::$app->agentcomponent->closeRate($agentId, "TV", $community);
                        ?>
                        <div class="container vertical rounded" style="margin-left:40px;">

                            <div class="progress-bar">
                                <div class="progress-track">
                                    <div class="progress-fill <?php echo Yii::$app->agentcomponent->getColor($category["TV"]["redCutOff"], $category["TV"]["yellowCutOff"], $tv); ?>">
                                        <span><?php //echo $tv; ?>50%</span> You
                                    </div>
                                </div>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-track">
                                    <div class="progress-fill <?php echo Yii::$app->agentcomponent->getColor($category["TV"]["redCutOff"], $category["TV"]["yellowCutOff"], $CommunityTV); ?>">
                                        <span><?php //echo $CommunityTV; ?>90%</span> Community
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <span class="category-text"><?php
                        echo $category["directMail"]["title"];?> </span>
                        <?php
                        
                        $mail = Yii::$app->agentcomponent->closeRate($agentId, "directMail");
                        $directMail = Yii::$app->agentcomponent->closeRate($agentId, "directMail", $community);
                        ?>
                        <div class="container vertical rounded" style="margin-left:40px;">

                            <div class="progress-bar">
                                <div class="progress-track">
                                    <div class="progress-fill <?php echo Yii::$app->agentcomponent->getColor($category["directMail"]["redCutOff"], $category["directMail"]["yellowCutOff"], $mail); ?>">
                                        <span><?php echo $mail; ?>%</span> You
                                    </div>
                                </div>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-track">
                                    <div class="progress-fill <?php echo Yii::$app->agentcomponent->getColor($category["directMail"]["redCutOff"], $category["directMail"]["yellowCutOff"], $directMail); ?>">
                                        <span><?php echo $directMail; ?>%</span> Community
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <span class="category-text"><?php
                        echo $category["web"]["title"]; ?> </span>
                        <?php
                        
                        $web = Yii::$app->agentcomponent->closeRate($agentId, "web");
                        $communityWeb = Yii::$app->agentcomponent->closeRate($agentId, "web", $community);
                        ?>
                        <div class="container vertical rounded" style="margin-left:40px; ">
                            <div class="progress-bar">
                                <div class="progress-track">
                                    <div class="progress-fill <?php echo Yii::$app->agentcomponent->getColor($category["web"]["redCutOff"], $category["web"]["yellowCutOff"], $web); ?>">
                                        <span><?php echo $web; ?>%</span> You
                                    </div>
                                </div>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-track">
                                    <div class="progress-fill <?php echo Yii::$app->agentcomponent->getColor($category["web"]["redCutOff"], $category["web"]["yellowCutOff"], $communityWeb); ?>">
                                        <span><?php echo $communityWeb; ?>%</span> Community
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <span class="category-text"><?php echo $category["transfer"]["title"]; ?></span>
                        <?php
                        
                        $transfer = Yii::$app->agentcomponent->getTransferCloseRate($agentId);
                        $CommunityTransfer = Yii::$app->agentcomponent->getTransferCloseRate($agentId, $community);
                        ?>
                        <div class="container vertical rounded" style="margin-left:40px;">

                            <div class="progress-bar">
                                <div class="progress-track">
                                    <div class="progress-fill <?php echo Yii::$app->agentcomponent->getColor($category["transfer"]["redCutOff"], $category["transfer"]["yellowCutOff"], $transfer); ?>">
                                        <span><?php echo $transfer; ?>%</span> You
                                    </div>
                                </div>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-track">
                                    <div class="progress-fill  <?php echo Yii::$app->agentcomponent->getColor($category["transfer"]["redCutOff"], $category["transfer"]["yellowCutOff"], $CommunityTransfer); ?>">
                                        <span><?php echo $CommunityTransfer; ?>%</span> Community
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>

                <div class="col-md-12" style="margin-top:20px;  padding-bottom: 25px; ">
                    <div class="col-md-3">
                        <span class="category-text"> <?php echo $category["voice"]["title"]; ?></span>
                        <?php
                       
                        $voices = Yii::$app->agentcomponent->getRate($skillType, $agentId, "voice");
                        $voiceCommunity = Yii::$app->agentcomponent->getRate($skillType, $agentId, "voice", $community);
                        ?>
                        <div class="container vertical rounded" style="margin-left:40px;">

                            <div class="progress-bar">
                                <div class="progress-track">
                                    <div class="progress-fill <?php echo Yii::$app->agentcomponent->getColor($category["voice"]["redCutOff"], $category["voice"]["yellowCutOff"], $voices); ?>">
                                        <span><?php echo $voices; ?>%</span> You
                                    </div>
                                </div>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-track">
                                    <div class="progress-fill <?php echo Yii::$app->agentcomponent->getColor($category["voice"]["redCutOff"], $category["voice"]["yellowCutOff"], $voiceCommunity); ?>">
                                        <span><?php echo $voiceCommunity; ?>%</span> Community
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-3">
                        <span class="category-text"><?php echo $category["ExpRepairSold"]["title"]; ?></span>
                        <?php
                        
                        $exp = Yii::$app->agentcomponent->getRate($skillType, $agentId, "ExpRepairSold");
                        $expCommunity = Yii::$app->agentcomponent->getRate($skillType, $agentId, "ExpRepairSold", $community);
                        ?>
                        <div class="container vertical rounded" style="margin-left:40px;">

                            <div class="progress-bar">
                                <div class="progress-track">
                                    <div class="progress-fill <?php echo Yii::$app->agentcomponent->getColor($category["ExpRepairSold"]["redCutOff"], $category["ExpRepairSold"]["yellowCutOff"], $exp); ?>">
                                        <span><?php echo $exp; ?>%</span> You
                                    </div>
                                </div>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-track">
                                    <div class="progress-fill <?php echo Yii::$app->agentcomponent->getColor($category["ExpRepairSold"]["redCutOff"], $category["ExpRepairSold"]["yellowCutOff"], $expCommunity); ?>">
                                        <span><?php echo $expCommunity; ?>%</span> Community
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <span class="category-text"><?php
                        echo $category["NortonSold"]["title"]; ?></span>
                        <?php
                       
                        $norton = Yii::$app->agentcomponent->getRate($skillType, $agentId, "NortonSold");
                        $nortonCommunity = Yii::$app->agentcomponent->getRate($skillType, $agentId, "NortonSold", $community);
                        ?>
                        <div class="container vertical rounded" style="margin-left:40px;">
                            <div class="progress-bar">
                                <div class="progress-track">
                                    <div class="progress-fill <?php echo Yii::$app->agentcomponent->getColor($category["NortonSold"]["redCutOff"], $category["NortonSold"]["yellowCutOff"], $norton); ?>">
                                        <span><?php echo $norton ?>%</span> You
                                    </div>
                                </div>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-track">
                                    <div class="progress-fill <?php echo Yii::$app->agentcomponent->getColor($category["NortonSold"]["redCutOff"], $category["NortonSold"]["yellowCutOff"], $nortonCommunity); ?>">
                                        <span><?php echo $nortonCommunity ?>%</span> Community
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <span class="category-text"><?php echo $category["PCESold"]["title"]; ?></span>
                        <?php
                        
                        $pce = Yii::$app->agentcomponent->getRate($skillType, $agentId, "PCESold");
                        $pceCommunity = Yii::$app->agentcomponent->getRate($skillType, $agentId, "PCESold", $community);
                        ?>
                        <div class="container vertical rounded" style="margin-left:40px;">

                            <div class="progress-bar">
                                <div class="progress-track">
                                    <div class="progress-fill <?php echo Yii::$app->agentcomponent->getColor($category["PCESold"]["redCutOff"], $category["PCESold"]["yellowCutOff"], $pce); ?>">
                                        <span><?php echo $pce; ?>%</span> You
                                    </div>
                                </div>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-track">
                                    <div class="progress-fill <?php echo Yii::$app->agentcomponent->getColor($category["PCESold"]["redCutOff"], $category["PCESold"]["yellowCutOff"], $pceCommunity); ?>">
                                        <span><?php echo $pceCommunity; ?>%</span> Community
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-12" style="margin-top:20px; padding-bottom: 25px;">
                    <div class="col-md-3">
                        <span class="category-text"><?php echo $category["email"]["title"]; ?></span>
                        <?php
                        
                        $validEmail = Yii::$app->agentcomponent->getValidEmail($skillType, $agentId);
                        $communityEmail = Yii::$app->agentcomponent->getValidEmail($skillType, $agentId, $community);
                        ?>
                        <div class="container vertical rounded" style="margin-left:40px;">
                            <div class="progress-bar">
                                <div class="progress-track">
                                    <div class="progress-fill <?php echo Yii::$app->agentcomponent->getColor($category["email"]["redCutOff"], $category["email"]["yellowCutOff"], $validEmail); ?>">
                                        <span><?php echo $validEmail; ?>%</span> You
                                    </div>
                                </div>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-track">
                                    <div class="progress-fill <?php echo Yii::$app->agentcomponent->getColor($category["email"]["redCutOff"], $category["email"]["yellowCutOff"], $communityEmail); ?>">
                                        <span><?php echo $communityEmail; ?>%</span> Community
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <span class="category-text"><?php echo $category["PhoneNumber"]["title"]; ?></span>
                        <?php
                        
                        $validPhones = Yii::$app->agentcomponent->getRate($skillType, $agentId, "PhoneNumber");
                        $communityPhones = Yii::$app->agentcomponent->getRate($skillType, $agentId, "PhoneNumber", $community);
                        ?>
                        <div class="container vertical rounded" style="margin-left:40px;">
                            <div class="progress-bar">
                                <div class="progress-track">
                                    <div class="progress-fill <?php echo Yii::$app->agentcomponent->getColor($category["PhoneNumber"]["redCutOff"], $category["PhoneNumber"]["yellowCutOff"], $validPhones); ?>">
                                        <span><?php echo $validPhones; ?>%</span> You
                                    </div>
                                </div>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-track">
                                    <div class="progress-fill <?php echo Yii::$app->agentcomponent->getColor($category["PhoneNumber"]["redCutOff"], $category["PhoneNumber"]["yellowCutOff"], $communityPhones); ?>">
                                        <span><?php echo $communityPhones; ?>%</span> Community
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 

                    <div class="col-md-3">
                        <span class="category-text"><?php echo $category["ScheduleAttempted"]["title"]; ?></span>
                        <?php
                        
                        $scheduleInstall = Yii::$app->agentcomponent->getRate($skillType, $agentId, "ScheduleAttempted");
                        $scheduleInstallCommunity = Yii::$app->agentcomponent->getRate($skillType, $agentId, "ScheduleAttempted", $community);
                        ?>
                        <div class="container vertical rounded" style="margin-left:40px;">
                            <div class="progress-bar">
                                <div class="progress-track">
                                    <div class="progress-fill <?php echo Yii::$app->agentcomponent->getColor($category["ScheduleAttempted"]["redCutOff"], $category["ScheduleAttempted"]["yellowCutOff"], $scheduleInstall); ?>">
                                        <span><?php echo $scheduleInstall; ?>%</span> You
                                    </div>
                                </div>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-track">
                                    <div class="progress-fill <?php echo Yii::$app->agentcomponent->getColor($category["ScheduleAttempted"]["redCutOff"], $category["ScheduleAttempted"]["yellowCutOff"], $scheduleInstallCommunity); ?>">
                                        <span><?php echo $scheduleInstallCommunity; ?>%</span> Community
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <span class="category-text"><?php echo $category["Connection"]["title"]; ?></span>
                        <?php
                        
                        $currentConnection = Yii::$app->agentcomponent->getRate($skillType, $agentId, "Connection");
                        $currentConnectionCommunity = Yii::$app->agentcomponent->getRate($skillType, $agentId, "Connection", $community);
                        ?>
                        <div class="container vertical rounded" style="margin-left:40px;">

                            <div class="progress-bar">
                                <div class="progress-track">
                                    <div class="progress-fill <?php echo Yii::$app->agentcomponent->getColor($category["Connection"]["redCutOff"], $category["Connection"]["yellowCutOff"], $currentConnection); ?>">
                                        <span><?php echo $currentConnection; ?>%</span> You
                                    </div>
                                </div>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-track">
                                    <div class="progress-fill <?php echo Yii::$app->agentcomponent->getColor($category["Connection"]["redCutOff"], $category["Connection"]["yellowCutOff"], $currentConnectionCommunity); ?>">
                                        <span><?php echo $currentConnectionCommunity; ?>%</span> 
                                    </div>
                                    
                                </div>
                                Community
                            </div>
                        </div>
                    </div>
                </div>

            </div>

<?php endif; ?>

    </div>

    <div class="body-content">

        <div class="row">
        </div>

    </div>
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.user_image_button').show();
        $(".fileinput-button").find("span").text("Change Image");

    });
</script>