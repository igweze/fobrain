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
	This page enroll new student to school database
	------------------------------------------------------------------------*/ 


		if (!defined('fobrain')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
				
		require_once $fobrainIconPage; /* This include top middle global icon page eg go back, print buttons etcs */

?>
  
		<!-- row -->
		<div <?php echo $fob_view; ?> class="row gutters row-section fobrain-section-div justify-content-center">
			<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">	
				<!-- card start -->
				<div class="card card-shadow">
					<div class="card-header-wiz">
						<h4>
							<i class="fas fa-users-cog fs-16"></i> 
							Create New Student
						</h4>
					</div> 
					<div id="msg-box"></div> 					
					<div class="card-body">

						
						<!-- form -->
						<form class="form-horizontal" id="frmnewStudent" role="form">
							<!-- row -->
							<div class="row gutters">
								<div class="col-lg-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<input type="text" class="form-control capWords" id="lname" 
                                        name="lname"  required />
										<div class="field-placeholder"> Last Name <span class="text-danger">*</span></div>
									</div>
									<!-- field wrapper end -->
								</div>									 
							 
								<div class="col-lg-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<input type="text" class="form-control capWords"  id="fname" 
                                        name="fname"  required />
										<div class="field-placeholder"> First Name <span class="text-danger">*</span></div>
									</div>
									<!-- field wrapper end -->
								</div>	
								
								<div class="col-lg-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<input type="text" class="form-control capWords"  id="mname" 
                                        name="mname"  />
										<div class="field-placeholder"> Middle Name <span class="text-danger">*</span></div>
									</div>
									<!-- field wrapper end -->
								</div>	

								<div class="col-lg-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<select class="form-control fob-select search-new-reg"  id="sess" name="sess" required>
                                              
											<option value = "">Please select One</option>
											<?php 
									
												try {
												
													schoolSessionL($conn);  /* school session  */
										
												}catch(PDOException $e) {
					
												fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
					
												} 
									
											?>
											
										</select>
										<div class="field-placeholder"> Student's Level <span class="text-danger">*</span></div>
									</div>
									<!-- field wrapper end -->
								</div>
							</div>	
							<!-- /row --> 	

								<div class="text-center" id="wait_11" style="display: none;">
									<div class="spinner-border text-danger" role="status">
										<span class="visually-hidden">Loading...</span>
									</div>
								</div>
								<div id="result_11" style="display: none; width:100%"></div><!-- loading div --> 

									
						</form>
						<!-- / form -->		
						
					</div>
				</div>
				<!-- card end -->	
			</div>
		</div>
		<!-- / row -->	  


		<!-- row -->
		<div class="row gutters mt-30">
			<div  id="student-wrapper"></div>								 
		</div>	
		<!-- /row -->

		<!--  fobrain modal start -->			
		<button type="button" class="btn modal-fobrain  display-none"  data-bs-toggle="modal" data-bs-target="#modal-fobrain"></button>				
		<!-- Scrollable modal -->
		<div class="modal fade animate__animated animate__zoomInDown" id="modal-fobrain" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
			<div class="modal-dialog  modal-lg modal-fullscreen-sm-down modal-dialog-scrollable">
				<div class="modal-content">
					<div class="modal-header"> 
						<h5 class="modal-title" id="exampleModalScrollableTitle"> 
							<i class="mdi mdi-account-search label-icon"></i>  
							Student Manager
						</h5>						 		 
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div id="edit-msg"> </div>
					<div class="modal-body">
						<div id="modal-load-div"></div> 
					</div>
					 
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		<!-- fobrain modal end -->


		<script type="text/javascript">	 
			$('.fob-select').each(function() {  
				renderSelect($('#'+this.id)); 
			});
		</script>