 	<!-- form wizard -->
	<div class="">  
		<form class="form-wizard frm-wd-header" id="frmfobrain" method="POST" >						
			<div class="wiz-auth-img text-center mb-2 mt-1">
				<img src="<?php echo $fobrainTemplate; ?>images/logo-sm.png" class="rounded-circle img-thumbnail img-h-100" alt="thumbnail">
			</div>
			<div class="text-center wiz-auth-title">
				<h3 class="mb-1 text-info">Installation Wizard </h3> 
				<p class="justify">
					For step-by-step instructions on installing FoBrain AI School Manager 
					and accessing its documentation, visit  <a href="https://www.docs.fobrain.com" 
					target="_blank"> https://www.docs.fobrain.com</a>.
				</p> 
			</div>
			<!--
			<h3>Student Registration</h3>
			<p>* Field are mandatory</p>
			-->
			<!-- form progress -->
			<div class="form-wizard-steps form-wizard-tolal-steps-4">
				<div class="form-wizard-progress">
				<div class="form-wizard-progress-line" data-now-value="25" data-number-of-steps="3" style="width: 25%;"></div>
				</div>
				<!-- step 1 -->
				<div class="form-wizard-step active">
					<div class="form-wizard-step-icon"><i class="fas fa-check-double" aria-hidden="true"></i></div>
					<p>Step 1</p>
				</div>
				<!-- step 1 -->
				
				<!-- step 2 -->
				<div class="form-wizard-step">
					<div class="form-wizard-step-icon"><i class="fas fa-user-tie" aria-hidden="true"></i></div>
					<p>Step 2</p>
				</div>
				<!-- step 2 -->
				
				<!-- step 3 -->
				<div class="form-wizard-step">
					<div class="form-wizard-step-icon"><i class="fas fa-database" aria-hidden="true"></i></div>
					<p>Step 3</p>
				</div>
				<!-- step 3 -->
				
				<!-- step 4 -->
				<div class="form-wizard-step">
					<div class="form-wizard-step-icon"><i class="fas fa-handshake" aria-hidden="true"></i></div>
					<p>Step 4</p>
				</div>
				<!-- step 4 -->
			</div>
			<!-- form progress -->
			
			

			<!-- form step 1 -->
			<fieldset>
				<!-- progress bar -->
				<div class="progress">
					<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%">
					</div>
				</div>
				<!-- progress bar -->
				<h4>App. Server Requirements: <span>Step 1 - 4</span></h4> 

				<!-- row -->
				<div class="row gutters mt-20">

				<?php

					if ((phpversion() < '7.0') || (phpversion() > '8.2.12')) {
						$app_error .= 'You require PHP version greater than <b>7</b> or below <b>8.2.12</b> 
						for this script to work good.<br />'; 
					}
					if (ini_get('session.auto_start')) {
						$app_error .= 'Your site will not work with session.auto_start enabled!<br />'; 
					}
					if (!extension_loaded('mysqli')) {
						$app_error .= 'MySQL extension needs to be loaded for this script to work!<br />';
					}
					if (!extension_loaded('gd')) {
						$app_error .= 'GD extension needs to be loaded for this script to work!<br />';
					}
					if (!is_writable('../fobrain-loader.php')) {
						$app_error .= '../fobrain-loader.php needs to be writable for this script to be installed!';
					}
					if (!is_writable('../connect-configs.php')) {
						$app_error .= '../connect-configs.php needs to be writable for this script to be installed!';
					}

					if($app_error){
					
						echo $erroMsg.$app_error.$msgEnd;  
						
					}
					?>
					<table width = '100%' class="table table-hover style-table"> 
						<thead>
							<tr>
							<th>App Requirements:</th>
							<th>Your Server </th>
							<th>Required</th>
							<th>Status</th>
							</tr>
						</thead> 
						<tbody>
							<tr>
								<td>PHP Version:</td>
								<td><?php echo phpversion(); ?></td>
								<td> > 7.0  < 8.2.12 </td>
								<td><?php if ((phpversion() < '7.0') || (phpversion() > '8.2.12')) { ?> 
									<i class="far fa-times-circle fs-16 text-danger"></i>
									<?php }else{ ?>
									<i class="far fa-check-square fs-16 text-success"></i>
								<?php } ?>
								</td>
							</tr>
							<tr>
								<td>Session Auto Start:</td>
								<td><?php echo (ini_get('session_auto_start')) ? 'On' : 'Off'; ?></td>
								<td>Off</td>
								<td><?php echo (!ini_get('session_auto_start')) ? 
								'<i class="far fa-check-square fs-16 text-success"></i>' : '<i class="far fa-times-circle fs-16 text-danger"></i>'; ?></td>
							</tr>
							<tr>
								<td>PDO:</td>
								<td><?php echo extension_loaded('pdo') ? 'On' : 'Off'; ?></td>
								<td>On</td>
								<td><?php echo extension_loaded('pdo') ? 
								'<i class="far fa-check-square fs-16 text-success"></i>' : '<i class="far fa-times-circle fs-16 text-danger"></i>'; ?></td>
							</tr>
							<tr>
								<td>MySQLI:</td>
								<td><?php echo extension_loaded('mysqli') ? 'On' : 'Off'; ?></td>
								<td>On</td>
								<td><?php echo extension_loaded('mysqli') ? 
								'<i class="far fa-check-square fs-16 text-success"></i>' : '<i class="far fa-times-circle fs-16 text-danger"></i>'; ?></td>
							</tr>
							<tr>
								<td>GD:</td>
								<td><?php echo extension_loaded('gd') ? 'On' : 'Off'; ?></td>
								<td>On</td>
								<td><?php echo extension_loaded('gd') ? 
								'<i class="far fa-check-square fs-16 text-success"></i>' : '<i class="far fa-times-circle fs-16 text-danger"></i>'; ?></td>
							</tr>
							<tr>
								<td>./fobrain-loader.php</td>
								<td><?php echo is_writable('../fobrain-loader.php') ? 'Writable' : 'Unwritable'; ?></td>
								<td>Writable</td>
								<td><?php echo is_writable('../fobrain-loader.php') ? 
								'<i class="far fa-check-square fs-16 text-success"></i>' : '<i class="far fa-times-circle fs-16 text-danger"></i>'; ?></td>
							</tr>
							<tr>
								<td>./connect-configs.php</td>
								<td><?php echo is_writable('../connect-configs.php') ? 'Writable' : 'Unwritable'; ?></td>
								<td>Writable</td>
								<td><?php echo is_writable('../connect-configs.php') ? 
								'<i class="far fa-check-square fs-16 text-success"></i>' : '<i class="far fa-times-circle fs-16 text-danger"></i>'; ?></td>
							</tr>
						</tbody>
					</table> 



				</div>	
				<!-- /row -->   
					
				<div class="form-wizard-buttons"> 
					<button type="button" class="btn btn-next btn-primary" id="app-required">
						<i class="mdi mdi-page-next-outline label-icon"></i>
						Next
					</button>
				</div>
			</fieldset>
			<!-- form step 1 -->

			<!-- form step 2 -->
			<fieldset>
				<!-- progress bar -->
				<div class="progress">
					<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%">
					</div>
				</div>
				<!-- progress bar -->
				<h4>Admin. Information: <span>Step 2 - 4</span></h4>


				<!-- row -->
				<div class="row guttersmt-20">
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
						<!-- field wrapper start -->
						<div class="field-wrapper">
							<input type="text" class="form-control required capWords" 
							id="lname" name="lname" />
							<div class="field-placeholder">Last Name  <span class="text-danger">*</span></div> 
						</div>
						<!-- field wrapper end -->
					</div>
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
						<!-- field wrapper start -->
						<div class="field-wrapper">
							<input type="text" class="form-control required capWords" 
								id="fname" name="fname"  />
							<div class="field-placeholder">First Name  <span class="text-danger">*</span></div> 
						</div>
						<!-- field wrapper end -->
					</div>									 
						
				</div>	
				<!-- /row -->

				<!-- row -->
				<div class="row gutters"> 		 
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">										
						<!-- field wrapper start -->
						<div class="field-wrapper">
							<div class="input-group auth-pass-inputgroup">
								<input type="password" class="form-control required" placeholder="Enter password" name="password" id="password" aria-label="Password" aria-describedby="password-addon">
								<button class="btn btn-white shadow-none border-password ms-0" type="button" id="password-icon"><i class=" fas fa-eye fs-12"></i></button>
							</div>
							<div class="field-placeholder">Password  <span class="text-danger">*</span></div>													 
						</div>
						<!-- field wrapper end -->

						<div id="popover-password">
							<p><span id="result"></span></p>
							<div class="progress progress-password">
								<div id="password-strength" 
									class="progress-bar" 
									role="progressbar" 
									aria-valuenow="40" 
									aria-valuemin="0" 
									aria-valuemax="100" 
									style="width:0%">
								</div>
							</div>
							<ul class="list-unstyled">
								<li class="">
									<span class="low-upper-case">
										<i class="fas fa-circle" aria-hidden="true"></i>
										&nbsp;Lowercase &amp; Uppercase
									</span>
								</li>
								<li class="">
									<span class="one-number">
										<i class="fas fa-circle" aria-hidden="true"></i>
										&nbsp;Number (0-9)
									</span> 
								</li>
								<li class="">
									<span class="one-special-char">
										<i class="fas fa-circle" aria-hidden="true"></i>
										&nbsp;Special Character (!@#$%^&*)
									</span>
								</li>
								<li class="">
									<span class="eight-character">
										<i class="fas fa-circle" aria-hidden="true"></i>
										&nbsp;Atleast 8 Character
									</span>
								</li>
							</ul>
						</div>
					</div>

					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
						<!-- field wrapper start -->
						<div class="field-wrapper">
							<input type="email" class="form-control required lowWords"
							id="email" name="email" placeholder="igweze@gmail.com" />
							<div class="field-placeholder"> Email  <span class="text-danger">*</span></div> 
							<div class="form-text text-danger fw-500">
								This is admin username and also use for password recovery.
							</div>
						</div>
						<!-- field wrapper end -->
					</div> 
				</div>	
				<!-- /row -->  
				
				<div class="form-wizard-buttons"> 
					<button type="button" class="btn btn-previous btn-dark">
						<i class="mdi mdi-page-previous-outline label-icon"></i>
						Previous
					</button>

					<button type="button" class="btn btn-next btn-primary">
						<i class="mdi mdi-page-next-outline label-icon"></i>
						Next
					</button>
				</div>
			</fieldset>
			<!-- form step 2 -->

			<!-- form step 3 -->
			<fieldset>
				<!-- progress bar -->
				<div class="progress">
					<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%">
					</div>
				</div>
				<!-- progress bar -->
				<h4>Database Configuration: <span>Step 3 - 4</span></h4>


				<!-- row -->
				<div class="row gutters mt-20">
					<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
						<!-- field wrapper start -->
						<div class="field-wrapper">
							<input type="text" class="form-control required" 
							placeholder="Enter your site url" value="<?php echo $pageUrl; ?>"
							name="url" id="url" />
							<div class="field-placeholder">Site Full Url <span class="text-danger">*</span></div>
							<div class="form-text text-danger fw-500">
								e.g https://www.fobrain.com or https://www.sc.fobrain.com
							</div>			
						</div>
						<!-- field wrapper end -->
					</div>
					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
						<!-- field wrapper start -->
						<div class="field-wrapper">
							<input type="text" class="form-control required" 
							placeholder="Enter your database host" value="localhost"
							name="dhost" id="dhost"  />
							<div class="field-placeholder">Database Host <span class="text-danger">*</span></div>
							<div class="form-text text-danger fw-500">
								Localhost is alaways the default
							</div>			
						</div>
						<!-- field wrapper end -->
					</div>	 
				</div>	
				<!-- /row -->

				<!-- row -->
				<div class="row gutters"> 
					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
						<!-- field wrapper start -->
						<div class="field-wrapper">
							<input type="text" class="form-control required" 
							placeholder="Enter your database name"
							name="dname" id="dname" />
							<div class="field-placeholder">Database Name <span class="text-danger">*</span></div>
							<div class="form-text text-danger fw-500">
								Manually create your db & enter it
							</div>			
						</div>
						<!-- field wrapper end -->
					</div>	
					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
						<!-- field wrapper start -->
						<div class="field-wrapper">
							<input type="text" class="form-control required" 
							placeholder="Enter your database username"
							name="duser" id="duser" />
							<div class="field-placeholder">Database Username <span class="text-danger">*</span></div>		
						</div>
						<!-- field wrapper end -->
					</div>	
					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
						<!-- field wrapper start -->
						<div class="field-wrapper">
							<input type="text" class="form-control required" 
							placeholder="Enter your database password"
							name="dpassword" id="dpassword" />
							<div class="field-placeholder">Database Password <span class="text-danger">*</span></div> 
						</div>
						<!-- field wrapper end -->
					</div>	 
				</div>	
				<!-- /row -->  
					
				<div class="form-wizard-buttons"> 
					<button type="button" class="btn btn-previous btn-dark">
						<i class="mdi mdi-page-previous-outline label-icon"></i>
						Previous
					</button>

					<button type="button" class="btn btn-next btn-primary">
						<i class="mdi mdi-page-next-outline label-icon"></i>
						Next
					</button> 
				</div>		 
			</fieldset>
			<!-- form step 3 --> 

			<!-- form step 4 -->
			<fieldset>
				<!-- progress bar -->
				<div class="progress">
					<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
					</div>
				</div>
				<!-- progress bar -->
				<h4>Terms of use : <span>Step 4 - 4</span></h4>  

				<div class="row mt-10">
					<div class="col-12">   
						<div class="form-group">
							<label class="col-xs-3 control-label">Terms of use</label>
							<div class="col-xs-9">
								<div style="border: 1px solid #e5e5e5; height: 150px; overflow: auto; padding: 10px;"> 

									<p>Licensed under the Apache License, Version 2.0 (the 'License');
									you may not use this file except in compliance with the License.
									You may obtain a copy of the License at</p>    

									<p><strong>http://www.apache.org/licenses/LICENSE-2.0</strong></p>

									<p>Unless required by applicable law or agreed to in writing, software
									distributed under the License is distributed on an 'AS IS' BASIS,
									WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
									See the License for the specific language governing permissions and
									limitations under the License</p> 

									<p>Copyright (C) foBrain Tech LTD (Igweze Ebele Mark) 2010 - 2026 
									- All Rights Reserved</p> 
								</div>
							</div>
						</div> 		 		

						<div class="form-check mb-3 mt-15">
							<input class="form-check-input" type="checkbox" name="acceptTerm" 
							id="acceptTerm">
							<label class="form-check-label text-info text-justify" for="acceptTerm"> 
								I Agree with the terms and conditions.
							</label>
						</div> 
						
					</div>
				</div>
				
				<div id="msg-box"></div>
				<div class="wiz-loader-2  wiz-glower display-none" id="install-loader">
					<ul>
						<li></li> <li></li> 
						<li></li> <li></li> 
						<li></li> <li></li> 
						<li></li>
					</ul>
				</div> 	  
				
				<button class="btn btn-primary nextBtn btn-lg pull-right display-none" id="installDB" type="button">Next Phase</button>
					
				<div class="form-wizard-buttons"> 
					<button type="button" class="btn btn-previous btn-dark install-script-btn">
						<i class="mdi mdi-page-previous-outline label-icon"></i>
						Previous
					</button> 
					<button type="submit" class="btn btn-submit btn-success install-script-btn"  id="install-script">
						<input type="hidden" name="script" value="install" /> 
						<i class="mdi mdi-content-save label-icon"></i>
						Install
					</button> 
				</div>		 
			</fieldset>
			<!-- form step 4 --> 

		</form> 
	</div>
	<!-- form wizard -->   

	<div id="wiz-overlay" class="wiz-overlay">
		<span class="closebtn hide" onclick="closeOverlay()" title="Close Overlay">×</span>
		<div class="wiz-overlay-install">  
			<!-- row -->
			<div class="row gutters justify-content-center  p-0 m-0">  
				<div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12" id="scroll-to-div">	 
					<!-- card start -->
					<div class="card card-shadow p-0 m-0"  style="border-radius:0px !important;">  
						<div class="card-body p-0 m-0">     
							<div id="carouselExampleAutoplaying" class="carousel slide carousel-fade" data-bs-ride="carousel">
								<div class="carousel-inner"> 
									<div class="carousel-item active">
										<img src="<?php echo $fobrainTemplate; ?>/images/intro/intro-1.jpg" 
										class="d-block w-100" style="height: 410px;" alt="Image Slider">
										<div class="carousel-caption">
											<h5>Daily Motivational Quotes</h5>
											<p><?php echo $educationQuotesArr[(rand(1,36))]; ?></p>
										</div>
									</div>
									<div class="carousel-item">
										<img src="<?php echo $fobrainTemplate; ?>/images/intro/intro-2.jpg" 
										class="d-block w-100" style="height: 410px;" alt="Image Slider">
										<div class="carousel-caption">
											<h5>Daily Motivational Quotes</h5>
											<p><?php echo $educationQuotesArr[(rand(1,36))]; ?></p>
										</div>
									</div>
									<div class="carousel-item">
										<img src="<?php echo $fobrainTemplate; ?>/images/intro/intro-3.jpg" 
										class="d-block w-100" style="height: 410px;" alt="Image Slider">
										<div class="carousel-caption">
											<h5>Daily Motivational Quotes</h5>
											<p><?php echo $educationQuotesArr[(rand(1,36))]; ?></p>
										</div>
									</div>
									<div class="carousel-item">
										<img src="<?php echo $fobrainTemplate; ?>/images/intro/intro-4.jpg" 
										class="d-block w-100" style="height: 410px;" alt="Image Slider">
										<div class="carousel-caption">
											<h5>Daily Motivational Quotes</h5>
											<p><?php echo $educationQuotesArr[(rand(1,36))]; ?></p>
										</div>
									</div>	 
								</div>
								<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
									<span class="carousel-control-prev-icon" aria-hidden="true"></span>
									<span class="visually-hidden">Previous</span>
								</button>
								<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
									<span class="carousel-control-next-icon" aria-hidden="true"></span>
									<span class="visually-hidden">Next</span>
								</button>
							</div> 
							<div class="wiz-loader-2  wiz-glower display-none" id="install-loader-fr">	
								<ul>
									<li></li> <li></li> 
									<li></li> <li></li> 
									<li></li> <li></li> 
									<li></li>
								</ul>
							</div>  
							<iframe  src="javascript:;" id="ifeOsiframe" scrolling="no"
							sandbox="allow-top-navigation allow-forms allow-same-origin allow-scripts allow-popups" 
							class="wiz-frame"></iframe>  
						</div>
					</div>
					<!-- card end -->	
				</div>
			</div>
			<!-- / row -->	  
		</div>
	</div>  