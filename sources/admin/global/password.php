<?php

/* 
	------------------------------------------------------------------------	  
	Copyright (C) foBrain Tech LTD (Igweze Ebele Mark) 2010 - 2026.

	Licensed under the Apache License, Version 2.0 (the 'License');
	you may not use this file except in compliance with the License.
	You may obtain a copy of the License at

	http://www.apache.org/licenses/LICENSE-2.0

	Unless required by applicable law or agreed to in writing, software
	distributed under the License is distributed on an 'AS IS' BASIS,
	WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
	See the License for the specific language governing permissions and
	limitations under the License		 
	------------------------------------------------------------------------ 
	foBrain Open Source & wizGrade Open Source App is designed & developed 
	by Igweze Ebele Mark for foBrain Tech LTD

	foBrain School App is Dedicated To Almighty God, My Amazing Parents, 
	To My Fabulous and Supporting Wife Nkiruka J.
	To My Inestimable Kids Osinachi, Ifechukwu, Naetochukwu & Chimamanda.  
	------------------------------------------------------------------------
	WEBSITE 					PHONES/WHATSAPP			EMAILS
	https://www.fobrain.com		+234 - 80 30 716 751  	igweze@fobrain.com	 
	https://www.fobrain.ng		+234 - 80 22 000 490	support@fobrain.com 
	------------------------------------------------------------------------
	
	
	-------- Script Description --------
	This page load password page
	------------------------------------------------------------------------*/ 


		if (!defined('fobrain')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!'); 
?>		

		<!-- row -->
		<div <?php echo $fob_view; ?> class="row gutters row-section fobrain-section-div justify-content-center">
			<div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-12">	
				<!-- card start -->
				<div class="card card-shadow"> 
					<?php 
						$page_title = '<i class="mdi mdi-account-key-outline fs-18"></i> 
							Change Password';
						pageTitle($page_title, 0);	 
					?>
					<div id="msg-box"></div> 					
					<div class="card-body">
						<!-- form -->
						<form class="form-horizontal" id="frmupdatePass"> 
							<!-- row -->
							<div class="row gutters">
								<div class="col-12">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<input type="password" class="form-control pass-field"
                                              name="old_pass" id="old_pass"  />
										<div class="field-placeholder">Old Password <span class="text-danger">*</span></div>
									</div>
									<!-- field wrapper end -->
								</div>
								

								<div class=" col-12">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<div class="input-group auth-pass-inputgroup">
											<input type="password" class="form-control required" placeholder="Enter password" name="new_pass" id="password" aria-label="Password" aria-describedby="password-addon">
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
								
								<div class="col-12">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<input type="password" class="form-control pass-field" 
                                              name="confirm_new" id="confirm_new" require />
										<div class="field-placeholder">Confirm Password <span class="text-danger">*</span></div>
										 
									</div>
									<!-- field wrapper end -->
								</div>	
							</div>	
							<!-- /row -->  
							 
							 
							<!-- row -->
							<div class="row gutters mt-30">
								<div class="col-6 text-start">
									<button type="button" id="password-field" class="btn btn-danger">
										<i class="fas fa-eye label-icon" style="color:#fff"></i>
									</button>
								</div>
								<div class="col-6 text-end">
									<input type="hidden" name="profile" value="access" />  
									<button type="submit" class="btn btn-primary waves-effect   
									demo-disenable btn-label waves-light" id="updatePass">
										<i class="mdi mdi-content-save label-icon"></i>  Update
									</button>
								</div>
							</div>	
							<!-- /row -->	
						</form>
						<!-- / form -->		
					</div>
				</div>
				<!-- card end -->	
			</div>
		</div>
		<!-- / row -->	 
		<script type="text/javascript" src="<?php echo $fobrainTemplate; ?>js/password.js"></script>   