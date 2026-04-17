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
	This page is manually add result manager
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
					$page_title = '<i class="mdi mdi-format-list-checks fs-18"></i> 
							  Export Class Results';
						pageTitle($page_title, 0);	 
					?>	
					<div id="msg-box"></div> 					
					<div class="card-body"> 

				 
						<form class="form-horizontal" id="frmload-exportRS" role="form"> 

							<?php $show_all = 0; require ($fobrainAdminGlobalDir.'common-frm-1.php'); ?> 

							<!-- row -->
							<div class="row gutters">
								<div class="col-lg-12">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<select class="form-control fob-select"  id="term1" name="term" required placeholder="Select term">
											
											<option value = "">Please select One</option>

											<?php
											
												try {
												
													$curTerm = currentSessionTerm($conn);    /* current school term  */
										
												}catch(PDOException $e) {
					
													fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
					
												}  
												foreach($term_list as $term_key => $term_value){    /* loop array */

													if ($curTerm == $term_key){
														$selected = "SELECTED";
													} else {
														$selected = "";
													}

													echo '<option value="'.$term_key.'"'.$selected.'>'.$term_value.'</option>' ."\r\n";

												}

											?>
										
										</select>
										<div class="field-placeholder"> School Term <span class="text-danger">*</span></div>
									</div>
									<!-- field wrapper end -->
								</div>									 
							</div>	
							<!-- /row -->
							
							<!-- row -->
							<div class="row gutters mt-30">
								<div class="col-12 text-end">
									<input type="hidden" name="search" value="export-rs" />
                                    <input type="hidden" value="<?php echo $blankStatus; ?>" name = "blank"/>
									<button type="submit" class="btn btn-primary waves-effect   
									btn-label waves-light" id="load-exportRS"> 
										<i class="mdi mdi-account-search label-icon"></i> Search
									</button>
								</div>
							</div>	
							<!-- /row --> 

						</form>
						<!-- /form -->  
						 

					</div>
				</div>
				<!-- card end -->	
			</div>
		</div>
		<!-- / row -->	  

		<!-- row -->
		<div class="row gutters <?php echo $fob_view_2; ?>" id="wiz-slider">	
			<div class="col-lg-12">		
				<div class=" mx-10" id="fobrain-page-div"></div>				 		
			</div>												
		</div>
		<!-- / row -->	 

		<script> 
			$('.fob-select').each(function() {  
				renderSelect($('#'+this.id)); 
			});
			
		</script>		