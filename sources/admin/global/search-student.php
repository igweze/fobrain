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
	This page load search student panel
	------------------------------------------------------------------------*/ 


		if (!defined('fobrain')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
				
		require_once $fobrainIconPage; /* This include top middle global icon page eg go back, print buttons etcs */		

?> 
        
		<!-- row -->
		<div <?php echo $fob_view; ?> class="row gutters row-section fobrain-section-div justify-content-center">
			<div class="col-xl-10 col-lg-10 col-md-12 col-sm-12 col-12">	
				<!-- card start -->
				<div class="card card-shadow"> 
					<?php 
					$page_title = '<i class="mdi mdi-account-search fs-18"></i> 
							Search Student';
						pageTitle($page_title, 0);	 
					?>
					<div id="msg-box"></div> 					
					<div class="card-body">
						<div class="row gutters my-10  justify-content-center">
						<?php if (($admin_grade == $admin_fobrain_grd) || ($admin_grade == $hm_fobrain_grd)) {  /*  check if school staff */ ?>
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12  mb-30">
								<div class="row gutters mb-25 mt-10">
									<div class="hints">
										[<i class="mdi mdi-help-circle-outline"></i>] 
										Search By Query E.g Igweze, Nkiru, Andre, 2010003
									</div>
								</div>

								<!-- form -->
								<form class="form-horizontal" id="frmSearchByKey" role="form">
									<!-- row -->
									<div class="row gutters">
										<div class="col-12">										
											<!-- field wrapper start -->
											<div class="field-wrapper">
												<input type="text" class="form-control" placeholder="E.g Igweze, Nkiru, Andre, Rose" id="queryWord" 
												name="queryWord"  required />  
												<div class="field-placeholder"> Search Query <span class="text-danger">*</span></div>
											</div>
											<!-- field wrapper end -->
										</div>									 
									</div>	
									<!-- /row -->  
									
									<!-- row -->
									<div class="row gutters mt-10">
										<div class="col-12 text-end">
											<input type="hidden" value="searchWord" name = "searchData"/>
											<button type="submit" class="btn btn-primary waves-effect   
											btn-label waves-light" id="searchWord">
												<i class="mdi mdi-briefcase-search-outline label-icon"></i>  Search
											</button>
										</div>
									</div>	
									<!-- /row -->									
								</form>
								<!-- / form -->		

							</div>

							<?php } ?>

							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">

								<div class="row gutters mb-25 mt-10">
									<div class="hints">
										[<i class="mdi mdi-help-circle-outline"></i>] 
										Search By Class/Session
									</div>
								</div>

								

								<!-- form -->
								<form class="form-horizontal" id="frmSearchBySess" role="form">
									
									<?php require_once ($fobrainAdminGlobalDir.'common-frm-2.php'); ?>
									

									<!-- row -->
									<div class="row gutters mt-10">
										<div class="col-12 text-end">
											<input type="hidden" value="searchProfSess" name = "searchData"/>
											<button type="submit" class="btn btn-primary waves-effect   
											btn-label waves-light" id="searchClassBio">
												<i class="mdi mdi mdi-briefcase-search-outline label-icon"></i>  Search
											</button>
										</div>
									</div>	
									<!-- /row -->									
								</form>
								<!-- / form -->		

							</div>
						
						</div>


					</div>
				</div>
				<!-- card end -->	
			</div>
		</div>
		<!-- / row -->	  


		<!-- row -->
		<div class="row gutters <?php echo $fob_view_2; ?>" id="wiz-slider">		
			<div class="col-12">	
				<!-- card start --> 
				<div class="card card-shadow">				 		
					<div class="card-body mx-10" id="fobrain-page-div"></div>
				</div>
				<!-- card end -->	
			</div> 			
		</div>
		<!-- / row -->		


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