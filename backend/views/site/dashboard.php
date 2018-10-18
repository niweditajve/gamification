<?php
/* @var $this yii\web\View */

$this->title = 'RM Factory';
?>


<link href="<?= Yii::$app->request->baseUrl ?>/css/admin-dashboard.css?v=1.0.0" rel="stylesheet" />
  
    
  <div class="site-index">

      <div class="container">
        <div class="row">
          <div class="col-lg-3">
            <div class="card card-chart">
              <div class="card-header">
                <h5 class="card-category">Calls now/Calls last week same time</h5>
                <h3 class="card-title"> </h3>
              </div>
              <div class="card-body">
                <div class="chart-area">
                  <canvas id="chartLinePurple"></canvas>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="card card-chart">
              <div class="card-header">
                <h5 class="card-category">Orders now/Orders Last week same time</h5>
                <h3 class="card-title"> </h3>
              </div>
              <div class="card-body">
                <div class="chart-area">
                  <canvas id="CountryChart"></canvas>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="card card-chart">
              <div class="card-header">
                <h5 class="card-category">Answer Rate</h5>
                <h3 class="card-title"> </h3>
              </div>
              <div class="card-body">
                <div class="chart-area">
                  <canvas id="chartLineGreen"></canvas>
                </div>
              </div>
            </div>
          </div>
		  
		  <div class="col-lg-3">
            <div class="card" style="padding:20px 20px 0px 20px;">
              
              <div class="card-body ">
                <div class="table-full-width">
                  <table class="table">
                    <tbody>
                      <tr>
                        <td>
                          <p class="title">Voice Attachment</p>
                          <p class="text-muted"></p>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <p class="title">ER Attachment</p>
                        </td>
                      </tr>
					  <tr>
                        <td>
                          <p class="title">PCE Attachment</p>
                          <p class="text-muted"></p>
                        </td>
                      </tr>
					  <tr>
                        <td>
                          <p class="title">Norton Attachment</p>
                          <p class="text-muted"></p>
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
						<div class="card card-chart" style="min-height: 310px;">
						  <div class="card-header">
							<h5 class="card-category">Current Close Rate</h5>
							<h3 class="card-title"> </h3>
						  </div>
						  <div class="card-body">
							<div class="chart-area">
							  <canvas id="chartLinePurple"></canvas>
							</div>
						  </div>
						</div>
					</div>
					
					<div class="col-lg-12" >
						<div class="card card-chart" style="height: 110px;">
						  <div class="card-header">
							<h5 class="card-category">Your Current Close Rate</h5>
							<h3 class="card-title"> </h3>
						  </div>
						  <div class="card-body">
							<div class="chart-area">
							  <canvas id="chartLinePurple"></canvas>
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
							<h5 class="card-category">TV Close Rate</h5>
							<h3 class="card-title"> </h3>
						  </div>
						  <div class="card-body">
							<div class="chart-area">
							  <canvas id="chartLinePurple"></canvas>
							</div>
						  </div>
						</div>
					</div>
					<div class="col-lg-6" >
						<div class="card card-chart">
						  <div class="card-header">
							<h5 class="card-category">DM Close Rate</h5>
							<h3 class="card-title"> </h3>
						  </div>
						  <div class="card-body">
							<div class="chart-area">
							  <canvas id="chartLinePurple"></canvas>
							</div>
						  </div>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-lg-6" >
						<div class="card card-chart">
						  <div class="card-header">
							<h5 class="card-category">Web Close Rate</h5>
							<h3 class="card-title"> </h3>
						  </div>
						  <div class="card-body">
							<div class="chart-area">
							  <canvas id="chartLinePurple"></canvas>
							</div>
						  </div>
						</div>
					</div>
					<div class="col-lg-6" >
						<div class="card card-chart">
						  <div class="card-header">
							<h5 class="card-category">Transfer Close Rate</h5>
							<h3 class="card-title"> </h3>
						  </div>
						  <div class="card-body">
							<div class="chart-area">
							  <canvas id="chartLinePurple"></canvas>
							</div>
						  </div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	  </div>
     
  </div>