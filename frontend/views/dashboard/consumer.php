<?php
/* @var $this yii\web\View */
use dosamigos\fileupload\FileUpload;

$this->title = 'Consumer';

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
						<?php
						$todaysCloseRate = Yii::$app->agentcomponent->getTodaysCloseRate($skillType, $agentId);
						?>
                        <div class="demo-4" data-backcolor="<?php echo Yii::$app->agentcomponent->getColor(25, 60, $todaysCloseRate); ?>" data-percent="<?php echo $todaysCloseRate ?>"></div>
                    </div>
                    <div class="col-md-2">
						<?php
							$communityTodaysCloseRate = Yii::$app->agentcomponent->getTodaysCloseRate($skillType, $agentId, $community);
						?>
                        <span class="top-text">Today's Community Close Rate </span>
                        <div class="demo-2" data-backcolor="<?php echo Yii::$app->agentcomponent->getColor(25, 60, $communityTodaysCloseRate); ?>" data-percent="<?php echo $communityTodaysCloseRate; ?>"></div>
                    </div>
                    <div class="col-md-2">
                        <span class="top-text"> Today's Points Earned  </span>
						<?php
						$todaysPoints = Yii::$app->agentcomponent->getTodaysPoints($agentId);
						?>
                        <div class="demo-3" data-backcolor="<?php echo Yii::$app->agentcomponent->getColor(25, 60, $todaysPoints); ?>" data-percent="<?php echo $todaysPoints; ?>" data-nopercentage="1"></div>
                    </div>
                    <div class="col-md-2">
                        <span class="top-text">WTD Points </span>
						<?php
						$wtd = Yii::$app->agentcomponent->getTodaysPoints($agentId, 1);
						?>
                        <div class="demo-1" data-backcolor="<?php echo Yii::$app->agentcomponent->getColor(25, 60, $wtd); ?>" data-percent="<?php echo $wtd; ?>" data-nopercentage="1"></div>
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
                                        <span class="bar-percentage-none"><?php echo $tv; ?>%</span> 
                                    </div>
                                </div>
								<span class="bar-percentage"><?php echo $tv ."%" ?></span> 
								<span class="bar-text"> You </span>
                            </div>
							
							
							
                            <div class="progress-bar">
                                <div class="progress-track">
                                    <div class="progress-fill <?php echo Yii::$app->agentcomponent->getColor($category["TV"]["redCutOff"], $category["TV"]["yellowCutOff"], $CommunityTV); ?>">
                                        <span class="bar-percentage-none"><?php echo $CommunityTV; ?>%</span> 
                                    </div>
                                </div>
								<span class="bar-percentage"><?php echo $CommunityTV ."%" ?></span> 
								<span class="bar-text"> Community </span>
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
                                        <span class="bar-percentage-none"><?php echo $mail; ?>%</span>
                                    </div>
                                </div>
								<span class="bar-percentage"><?php echo $mail ."%" ?></span> 
								<span class="bar-text"> You </span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-track">
                                    <div class="progress-fill <?php echo Yii::$app->agentcomponent->getColor($category["directMail"]["redCutOff"], $category["directMail"]["yellowCutOff"], $directMail); ?>">
                                        <span class="bar-percentage-none"><?php echo $directMail; ?>%</span>
                                    </div>
                                </div>
								<span class="bar-percentage"><?php echo $directMail ."%" ?></span> 
								<span class="bar-text"> Community </span>
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
                                        <span class="bar-percentage-none"><?php echo $web; ?>%</span>
                                    </div>
                                </div>
								<span class="bar-percentage"><?php echo $web ."%" ?></span> 
								<span class="bar-text"> You </span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-track">
                                    <div class="progress-fill <?php echo Yii::$app->agentcomponent->getColor($category["web"]["redCutOff"], $category["web"]["yellowCutOff"], $communityWeb); ?>">
                                        <span class="bar-percentage-none"><?php echo $communityWeb; ?>%</span>
                                    </div>
                                </div>
								<span class="bar-percentage"><?php echo $communityWeb ."%" ?></span> 
								<span class="bar-text"> Community </span>
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
                                        <span class="bar-percentage-none"><?php echo $transfer; ?>%</span>
                                    </div>
                                </div>
								<span class="bar-percentage"><?php echo $transfer ."%" ?></span> 
								<span class="bar-text"> You </span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-track">
                                    <div class="progress-fill  <?php echo Yii::$app->agentcomponent->getColor($category["transfer"]["redCutOff"], $category["transfer"]["yellowCutOff"], $CommunityTransfer); ?>">
                                        <span class="bar-percentage-none"><?php echo $CommunityTransfer; ?>%</span>
                                    </div>
                                </div>
								<span class="bar-percentage"><?php echo $CommunityTransfer ."%" ?></span> 
								<span class="bar-text"> Community </span>
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
                                        <span class="bar-percentage-none"><?php echo $voices; ?>%</span>
                                    </div>
                                </div>
								<span class="bar-percentage"><?php echo $voices ."%" ?></span> 
								<span class="bar-text"> You </span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-track">
                                    <div class="progress-fill <?php echo Yii::$app->agentcomponent->getColor($category["voice"]["redCutOff"], $category["voice"]["yellowCutOff"], $voiceCommunity); ?>">
                                        <span class="bar-percentage-none"><?php echo $voiceCommunity; ?>%</span>
                                    </div>
                                </div>
								<span class="bar-percentage"><?php echo $voiceCommunity ."%" ?></span> 
								<span class="bar-text"> Community </span>
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
                                        <span class="bar-percentage-none"><?php echo $exp; ?>%</span>
                                    </div>
                                </div>
								<span class="bar-percentage"><?php echo $exp ."%" ?></span> 
								<span class="bar-text"> You </span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-track">
                                    <div class="progress-fill <?php echo Yii::$app->agentcomponent->getColor($category["ExpRepairSold"]["redCutOff"], $category["ExpRepairSold"]["yellowCutOff"], $expCommunity); ?>">
                                        <span class="bar-percentage-none"><?php echo $expCommunity; ?>%</span>
                                    </div>
                                </div>
								<span class="bar-percentage"><?php echo $expCommunity ."%" ?></span> 
								<span class="bar-text"> Community </span>
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
                                        <span class="bar-percentage-none"><?php echo $norton ?>%</span>
                                    </div>
                                </div>
								<span class="bar-percentage"><?php echo $norton ."%" ?></span> 
								<span class="bar-text"> You </span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-track">
                                    <div class="progress-fill <?php echo Yii::$app->agentcomponent->getColor($category["NortonSold"]["redCutOff"], $category["NortonSold"]["yellowCutOff"], $nortonCommunity); ?>">
                                        <span class="bar-percentage-none"><?php echo $nortonCommunity ?>%</span>
                                    </div>
                                </div>
								<span class="bar-percentage"><?php echo $nortonCommunity ."%" ?></span> 
								<span class="bar-text"> Community </span>
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
                                        <span class="bar-percentage-none"><?php echo $pce; ?>%</span>
                                    </div>
                                </div>
								<span class="bar-percentage"><?php echo $pce ."%" ?></span>
								<span class="bar-text"> You </span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-track">
                                    <div class="progress-fill <?php echo Yii::$app->agentcomponent->getColor($category["PCESold"]["redCutOff"], $category["PCESold"]["yellowCutOff"], $pceCommunity); ?>">
                                        <span class="bar-percentage-none"><?php echo $pceCommunity; ?>%</span>
                                    </div>
                                </div>
								<span class="bar-percentage"><?php echo $pceCommunity ."%" ?></span>
								<span class="bar-text"> Community </span>
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
                                        <span class="bar-percentage-none"><?php echo $validEmail; ?>%</span>
                                    </div>
                                </div>
								<span class="bar-percentage"><?php echo $validEmail ."%" ?></span>
								<span class="bar-text"> You </span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-track">
                                    <div class="progress-fill <?php echo Yii::$app->agentcomponent->getColor($category["email"]["redCutOff"], $category["email"]["yellowCutOff"], $communityEmail); ?>">
                                        <span class="bar-percentage-none"><?php echo $communityEmail; ?>%</span>
                                    </div>
                                </div>
								<span class="bar-percentage"><?php echo $communityEmail ."%" ?></span>
								<span class="bar-text"> Community </span>
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
                                        <span class="bar-percentage-none"><?php echo $validPhones; ?>%</span>
                                    </div>
                                </div>
								<span class="bar-percentage"><?php echo $validPhones ."%" ?></span>
								<span class="bar-text"> You </span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-track">
                                    <div class="progress-fill <?php echo Yii::$app->agentcomponent->getColor($category["PhoneNumber"]["redCutOff"], $category["PhoneNumber"]["yellowCutOff"], $communityPhones); ?>">
                                        <span class="bar-percentage-none"><?php echo $communityPhones; ?>%</span>
                                    </div>
                                </div>
								<span class="bar-percentage"><?php echo $communityPhones ."%" ?></span>
								<span class="bar-text"> Community </span>
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
                                        <span class="bar-percentage-none"><?php echo $scheduleInstall; ?>%</span>
                                    </div>
                                </div>
								<span class="bar-percentage"><?php echo $scheduleInstall ."%" ?></span>
								<span class="bar-text"> You </span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-track">
                                    <div class="progress-fill <?php echo Yii::$app->agentcomponent->getColor($category["ScheduleAttempted"]["redCutOff"], $category["ScheduleAttempted"]["yellowCutOff"], $scheduleInstallCommunity); ?>">
                                        <span class="bar-percentage-none"><?php echo $scheduleInstallCommunity; ?>%</span>
                                    </div>
                                </div>
								<span class="bar-percentage"><?php echo $scheduleInstallCommunity ."%" ?></span>
								<span class="bar-text"> Community </span>
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
                                        <span class="bar-percentage-none"><?php echo $currentConnection; ?>%</span>
                                    </div>
                                </div>
								<span class="bar-percentage"><?php echo $currentConnection ."%" ?></span>
								<span class="bar-text"> You </span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-track">
                                    <div class="progress-fill <?php echo Yii::$app->agentcomponent->getColor($category["Connection"]["redCutOff"], $category["Connection"]["yellowCutOff"], $currentConnectionCommunity); ?>">
                                        <span class="bar-percentage-none"><?php echo $currentConnectionCommunity; ?>%</span> 
                                    </div>
                                    
                                </div>
								<span class="bar-percentage"><?php echo $currentConnectionCommunity ."%" ?></span>
								<span class="bar-text"> Community </span>
                                
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