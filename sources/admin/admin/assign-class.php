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
	This page is the assign teacher to class manager
	------------------------------------------------------------------------*/ 


		if (!defined('fobrain')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
				
		require_once $fobrainIconPage; /* This include top middle global icon page eg go back, print buttons etcs */

		 
?>

		<!-- row -->
		<div <?php echo $fob_view; ?> class="row gutters row-section fobrain-section-div justify-content-center">
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">	
				<!-- card start -->
				<div class="card card-shadow"> 
					<?php 
					$page_title = '<i class="mdi mdi-account-supervisor-circle fs-18"></i> 
							Assign Class to Staff';
						pageTitle($page_title, 0);	 
					?>
					<div id="msg-box"></div> 					
					<div class="card-body">

						<div class="row gutters mb-25 mt-10">
							<div class="hints">
								[<i class="mdi mdi-help-circle-outline"></i>] 
								Assign Class to Form Teacher to manage Class results 
							</div>
						</div>

						<!-- form -->
						<form class="form-horizontal" id="frmassignformTeacher" role="form"> 
							 
							<?php $show_all = 0; require ($fobrainAdminGlobalDir.'common-frm-1.php'); ?>

							<!-- row -->
							<div class="row gutters">
								<div class="col-lg-12">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<select class="form-control" name="staff[]" id="staff" required> 
											<option value = "">Please select One</option>							
											<?php
												try{
													$staff_arr = staffArrays($conn);  /* school staffs/teachers token information */
													echo staffSelectBox($conn, $staff_arr, "none", false);
												}catch(PDOException $e) {				
													fobrainDie( 'Ooops Database Error: ' . $e->getMessage());													
												}
											?>
										</select>
										<div class="field-placeholder">Staff Name<span class="text-danger">*</span></div> 
									</div>
									<!-- field wrapper end -->
								</div>									 
							</div>	
							<!-- /row -->  

							<!-- row -->
							<div class="row gutters mt-30">
								<div class="col-12 text-end">
									<input type="hidden" value="f_teacher" name = "assign"/>
									<button type="submit" class="btn btn-primary waves-effect   
									btn-label waves-light" id="assignformTeacher">
										<i class="mdi mdi-content-save label-icon"></i>  Assign
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

		<script type="text/javascript">	
			renderSelectImg("#staff", 2);
		</script>	