<?php
		define('fobrain', 'igweze');  /* define a check for wrong access of file */
		require_once 'sources/functions/fobrain-dir-in.php';  /* include configuration script */  
 
		
		if(($fobrainPortalRoot == '') || ($fobrainDB == '')){  /* check script installation */

$installScript =<<<IGWEZE
        
			<meta http-equiv="refresh" content="0;URL='./install/'" />
		
IGWEZE;
		
			echo $installScript;			 
			exit;
			
		}	
		
		require $fobrainDBConnectIndDir;  /* load connection string */ 
		require_once $fobrainFunctionDir;  /* load script functions */	 
		
		try {
			
			$schoolDataArray = fobrainSchool($conn);  /* school configuration setup array  */					
			$schoolNameTop = $schoolDataArray[0]['school_name'];  

		} catch(PDOException $e) {
			
			fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
   
		}			
 
		
	                 
?> 

						 		
	<div id="msg-box-reg"></div> 					

	<!-- form wizard -->
	<div class="">  
		
		<form enctype="multipart/form-data" class="form-wizard frm-wd-header frmsave-regis"
		 method="POST" id="frmsave-regis">						
		
			<!--
			<h3>Student Registration</h3>
			<p>* Field are mandatory</p>
			-->
			<!-- form progress -->
			<div class="form-wizard-steps form-wizard-tolal-steps-3">
				<div class="form-wizard-progress">
				<div class="form-wizard-progress-line" data-now-value="33.33" data-number-of-steps="3" style="width: 33.33%;"></div>
				</div>
				<!-- step 1 -->
				<div class="form-wizard-step active">
					<div class="form-wizard-step-icon"><i class="fas fa-user-graduate" aria-hidden="true"></i></div>
					<p>Personal</p>
				</div>
				<!-- step 1 -->
				
				<!-- step 2 -->
				<div class="form-wizard-step">
					<div class="form-wizard-step-icon"><i class="fas fa-map-marker-alt" aria-hidden="true"></i></div>
					<p>Contact</p>
				</div>
				<!-- step 2 -->
				
				<!-- step 3 -->
				<div class="form-wizard-step">
					<div class="form-wizard-step-icon"><i class="fas fa-user-tie" aria-hidden="true"></i></div>
					<p>Guardian</p>
				</div>
				<!-- step 3 -->
				
				<!-- step 4 -- >
				<div class="form-wizard-step">
					<div class="form-wizard-step-icon"><i class="fas fa-user-tie" aria-hidden="true"></i></div>
					<p>Guardian</p>
				</div>
				<!-- step 4 -->
			</div>
			<!-- form progress -->
			
			
			<!-- form step 1 -->
			<fieldset>
				<!-- progress bar -->
				<div class="progress">
					<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="33.33" aria-valuemin="0" aria-valuemax="100" style="width: 33.33%">
					</div>
				</div>
				<!-- progress bar -->
				<h4>Personal Information: <span>Step 1 - 3</span></h4>



					<!-- row -->
					<div class="row gutters">
								
						<div class="col-sm-6 col-sm-offset-1 mb-25">	
							<div class="picture-container">
								<div class="picture">
									<img src="<?php echo $wiz_default_img_i; ?>" class="picture-src" id="picture-preview" title="" />
									<input type="file" class="picture-file" name="uploadPic"  id="uploadPic">
								</div>
								<h6>Choose Picture</h6>
							</div>
						</div>
						<div class="col-sm-6">	
							<div class="col-12">	 
								
								<!-- field wrapper start -->
								<div class="field-wrapper select-wrapper">
									
									<select class="form-control fob-select required"  id="school" name="school">

										<option value = "">Please select One</option>

										<?php

											foreach($school_list as $school => $schoolVal){  /* loop array */

												if ($sex == $school){
													$selected = "SELECTED";
												} else {
													$selected = "";
												}

												echo '<option value="'.$school.'"'.$selected.'>'.$schoolVal.'</option>' ."\r\n";

											}

										?> 
										
									</select>
									<div class="icon-wrap"  id="wait_1" style="display: none;">
										<i class="loader"></i>
									</div>
									<div class="field-placeholder"> School <span class="text-danger">*</span></div>
									 
								</div>
								<!-- field wrapper end --> 
							</div>	  
							 		 
							<span id="result_1" style="display: none;"></span> <!-- loading div -->
						</div>	
					</div>
					
					<!-- row -->
					<div class="row gutters">
						<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
							<!-- field wrapper start -->
							<div class="field-wrapper">
								<input type="text" class="form-control required capWords" value ="<?php echo $lname; ?>" 
								id="lname" name="lname" required@? />
								<div class="field-placeholder">Last Name <span class="text-danger">*</span></div>
					 
							</div>
							<!-- field wrapper end -->
						</div>
						<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
							<!-- field wrapper start -->
							<div class="field-wrapper">
								<input type="text" class="form-control  required capWords" value ="<?php echo $fname; ?>" 
									id="fname" name="fname"  required@? />
								<div class="field-placeholder">First Name <span class="text-danger">*</span></div>
					 
							</div>
							<!-- field wrapper end -->
						</div>									 
						<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">										
							<!-- field wrapper start -->
							<div class="field-wrapper"> 
								<input type="text" class="form-control capWords" value ="<?php echo $mname; ?>" 
								id="mname" name="mname"  />
								<div class="field-placeholder">Middle Name <span class="text-danger"></span></div>
						 
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
								<select class="form-control fob-select required"  id="sex" name="sex" required@?>                                              
									<option value = "">Search . . .</option>
									<?php

										foreach($gender_list as $gender => $genderVal){  /* loop array */

											if ($sex == $gender){
												$selected = "SELECTED";
											} else {
												$selected = "";
											}

											echo '<option value="'.$gender.'"'.$selected.'>'.$genderVal.'</option>' ."\r\n";

										}

									?>												
								</select>											
								<div class="field-placeholder">Gender <span class="text-danger">*</span></div>
						 
							</div>
							<!-- field wrapper end -->
						</div>
						<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">										
							<!-- field wrapper start -->
							<div class="field-wrapper">
								<input type="date"  value="<?php echo $dateofbirth; ?>" 
								size="10" class="form-control required" name="dob"  required@? />
								<div class="field-placeholder">Date of Birth <span class="text-danger">*</span></div>
						 
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
								<input type="text" class="form-control capWords" value ="<?php echo $religion; ?>" 
								id="religion" name="religion"  />
								<div class="field-placeholder">Religion <span class="text-danger"></span></div>
						 
							</div>
							<!-- field wrapper end -->
						</div>			
						<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">									
							<!-- field wrapper start -->
							<div class="field-wrapper">
								<select class="form-control fob-select required" id="bloodgr" name="bloodgr" required@?>
									
									<option value = "">Search . . .</option>

									<?php 

										foreach($bloodgr_list as $bloodgrVal => $bloodGroup){  /* loop array */

											if ($bloodgrVal == $bloodGP){
												$selected = "SELECTED";
											} else {
												$selected = "";
											}

											echo '<option value="'.$bloodgrVal.'"'.$selected.'>'.$bloodGroup.'</option>' ."\r\n";

										}

									?>
								</select>
								<div class="field-placeholder">Blood Group <span class="text-danger">*</span></div>
						 
							</div>
							<!-- field wrapper end -->
						</div>
						<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">										
							<!-- field wrapper start -->
							<div class="field-wrapper">
								<select class="form-control fob-select" id="genotype" name="genotype" required@?>
									
									<option value = "">Search . . .</option>

									<?php

										foreach($genotype_list as $genotype => $genotypeVal){  /* loop array */

											if ($genoTP == $genotype){
												$selected = "SELECTED";
											} else {
												$selected = "";
											}

											echo '<option value="'.$genotype.'"'.$selected.'>'.$genotypeVal.'</option>' ."\r\n";

										}

									?>
								</select>
								<div class="field-placeholder">Genotype <span class="text-danger"></span></div>
					 
							</div>
							<!-- field wrapper end -->
						</div> 

					</div>	
					<!-- /row --> 

						
					
					
					
				<div class="form-wizard-buttons"> 
					<button type="button" class="btn btn-next btn-primary">
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
					<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="66.66" aria-valuemin="0" aria-valuemax="100" style="width: 66.66%">
					</div>
				</div>
				<!-- progress bar -->
				<h4>Contact Information : <span>Step 2 - 3</span></h4>


				

					<!-- row -->
					<div class="row gutters">
						<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
							<!-- field wrapper start -->
							<div class="field-wrapper">
								<select class="form-control fob-select required"  id="country" name="country" required@?>
									
									<option value = "">Search . . .</option>

									<?php

										foreach($countrylist as $countryname){  /* loop array */

											if ($country == $countryname){
												$selected = "SELECTED";
											} else {
												$selected = "";
											}

											echo '<option value="'.$countryname.'"'.$selected.'>'.$countryname.'</option>' ."\r\n";

										}

									?>

									
									
								</select>
								<div class="field-placeholder">Country  <span class="text-danger">*</span></div>
					 
							</div>
							<!-- field wrapper end -->
						</div>
						<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
							<!-- field wrapper start -->
							<div class="field-wrapper">
								<input type="text" class="form-control capWords" value ="<?php echo $state; ?>" 
								id="state"  name="state"  required@? />
								<div class="field-placeholder"> State / District <span class="text-danger">*</span></div>
					 
							</div>
							<!-- field wrapper end -->
						</div>
						<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
							<!-- field wrapper start -->
							<div class="field-wrapper">
								<input type="text" class="form-control capWords" value ="<?php echo $city; ?>" 
								id="city" name="city"  required@? />
								<div class="field-placeholder">City <span class="text-danger">*</span></div>
					 
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
								<input placeholder="e.g. +2348030716751" type="tel" 
									class="form-control capWords" value ="<?php echo $studphone; ?>" id="studphone" required@? />
								<div class="field-placeholder">Phone No. <span class="text-danger">*</span></div>
						 
							</div>
							<!-- field wrapper end -->
						</div>									 
						<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
							<!-- field wrapper start -->
							<div class="field-wrapper">
								<input type="email" class="form-control lowWords" value ="<?php echo $email; ?>" 
								id="email" name="email" placeholder="igweze@gmail.com" required@? />
								<div class="field-placeholder"> Email <span class="text-danger">*</span></div>
					 
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
								<input type="text" class="form-control capWords" 
								value ="<?php echo $add1; ?>" id="add1" name="add1"  required@? />
								<div class="field-placeholder"> Present Address <span class="text-danger">*</span></div>
					 
							</div>
							<!-- field wrapper end -->
						</div>
						<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
							<!-- field wrapper start -->
							<div class="field-wrapper">
								<input type="text" class="form-control capWords" 
								value ="<?php echo $add2; ?>" id="add2" name="add2"  />
								<div class="field-placeholder"> Parmanent Address <span class="text-info">(Optional)</span></div>
			 
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
					<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
					</div>
				</div>
				<!-- progress bar -->
				<h4>Guardian Information: <span>Step 3 - 3</span></h4> 


				<!-- row -->
				<div class="row gutters">
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">										
						<!-- field wrapper start -->
						<div class="field-wrapper">
							<input type="text" class="form-control capWords" value ="<?php echo $sponsor; ?>" 
							id="sponsor" name="sponsor"  required@? />
							<div class="field-placeholder">Sponsor Name <span class="text-danger">*</span></div>
								
						</div>
						<!-- field wrapper end -->
					</div>
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">										
						<!-- field wrapper start -->
						<div class="field-wrapper">
							<input type="text" class="form-control capWords" value ="<?php echo $sponphone; ?>" 
							id="sponphone"  name="sponphone" placeholder="e.g. +2348030716751" required@? />
							<div class="field-placeholder"> Phone Number <span class="text-danger">*</span></div>
								
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
							<input type="text" class="form-control capWords" value ="<?php echo $soccup; ?>" 
								id="soccup" name="soccup"  required@? />
							<div class="field-placeholder"> Occupation <span class="text-danger">*</span></div>
								
						</div>
						<!-- field wrapper end -->
					</div>
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">										
						<!-- field wrapper start -->
						<div class="field-wrapper">
							<input type="text" class="form-control capWords" value ="<?php echo $sponadd; ?>" 
								id="sponadd" name="sponadd"  required@? />
							<div class="field-placeholder">Address <span class="text-danger">*</span></div>
								
						</div>
						<!-- field wrapper end -->
					</div>								 
				</div>	
				<!-- /row -->		
				
				<!-- row -- >
				<div class="row gutters">
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">										
						<!- - field wrapper start -- >
						<div class="field-wrapper">
							<input type="text" class="form-control capWords" value ="<?php echo $sponsor2; ?>" 
							id="sponsor2" name="sponsor2"  required@? />
							<div class="field-placeholder">Mother Name <span class="text-danger"></span></div>
								
						</div>
						<!- - field wrapper end -- >
					</div>
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">										
						<!- - field wrapper start -- >
						<div class="field-wrapper">
							<input type="text" class="form-control capWords" value ="<?php echo $sponphone2; ?>" 
							id="sponphone2"  name="sponphone2" placeholder="e.g. +2348030716751" required@? />
							<div class="field-placeholder"> Phone Number <span class="text-danger"></span></div>
								
						</div>
						<!-- field wrapper end -- > 
					</div>									 
				</div>	
				<!- - /row -- >
				
				<!- - row -- >
				<div class="row gutters">
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">										
						<!- - field wrapper start -- >
						<div class="field-wrapper">
							<input type="text" class="form-control capWords" value ="<?php echo $soccup2; ?>" 
								id="soccup2" name="soccup2"  required@? />
							<div class="field-placeholder"> Occupation <span class="text-danger"></span></div>
								
						</div>
						<!- - field wrapper end -- >
					</div>
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">										
						<!- - field wrapper start -- >
						<div class="field-wrapper">
							<input type="text" class="form-control capWords" value ="<?php echo $sponadd2; ?>" 
								id="sponadd2" name="sponadd2"  required@? />
							<div class="field-placeholder">Address <span class="text-danger"></span></div>
								
						</div>
						<!- - field wrapper end -- >
					</div>								 
				</div>	
				<!-- /row -->	 
					
					
				<div class="form-wizard-buttons"> 
					<button type="button" class="btn btn-previous btn-dark fob-btn-div-reg">
						<i class="mdi mdi-page-previous-outline label-icon"></i>
						Previous
					</button> 
					<button type="submit" class="btn btn-submit btn-success fob-btn-div-reg"  id="save-regis">
						<i class="mdi mdi-content-save label-icon"></i>
						Submit
					</button> 
					<input type="hidden" name="query" value="register" />

					<div class="display-none mb-3 fob-btn-loader-reg">
						<strong role="status">Processing...</strong>
						<div class="spinner-border ms-auto" aria-hidden="true"></div>
					</div>
				</div>		 
			</fieldset>
			<!-- form step 3 --> 
		</form> 
	</div>
	<!-- form wizard -->


