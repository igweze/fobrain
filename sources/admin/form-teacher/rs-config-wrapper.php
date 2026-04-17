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
	
*/ 

		if (!defined('fobrain')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!'); 
			 
	?> 
		 
	<div id="wiz-overlay" class="wiz-overlay">
		<span class="closebtn exit-rs-config" onclick="closeOverlay()" title="Close Overlay">×</span>
		<div class="<?php echo $overlay_style; ?>">  
			<!-- row -->
			<div class="row gutters lowRSDiv justify-content-center">  
				<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12" id="scroll-to-div">	 
					<!-- card start -->
					<div class="card card-shadow">
							
						<?php 
							$page_title = '<i class="mdi mdi-sort-numeric-variant fs-18"></i> 
								Automate &amp; Publish Result';
							pageTitle($page_title, 0);	 
						?>
						<div class="msg-box"></div> 					
						<div class="card-body" id="scrollTarget3">  

							<div class="wiz-loader-2 wiz-glower display-none my-50" id="config-loader">
								<ul>
									<li></li>
									<li></li>
									<li></li>
									<li></li>
									<li></li>
									<li></li>
									<li></li>
								</ul>
							</div>

							<div id="rs-msg-box"></div>

							<div class="row gutters justify-content-center my-50 rs-config-wrap">  
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12  mb-20 text-center">
									<!-- form -->
										<form class="form-horizontal" id="frmautomateRS" role="form"> 
										<input type="hidden" name="sess" value="<?php echo $session ?>">
										<input type="hidden" name="level" value="<?php echo $level ?>">
										<input type="hidden" name="term" value="<?php echo $term ?>" />
										<input type="hidden" name="class" value="<?php echo $class ?>" />  
										<input type="hidden" name="rs-config" value="compute" /> 
										<button type="submit" class="btn btn-success  
										buttonMargin demo-disenable" id="automateRS">
										<i class="fas fa-sort-numeric-up"></i> Compute Result </button> 
									</form>
									<!-- / form -->  
								</div>

								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-20 text-center">
									<!-- form -->
									<form class="form-horizontal" id="frmpublishRS" role="form"> 
										<input type="hidden" name="sess" value="<?php echo $session ?>">
										<input type="hidden" name="level" value="<?php echo $level ?>">
										<input type="hidden" name="term" value="<?php echo $term ?>" />
										<input type="hidden" name="class" value="<?php echo $class ?>" /> 
										<input type="hidden" name="rs-config" value="publish" /> 
										<button type="submit" class="btn btn-danger
										buttonMargin demo-disenable" id="publishRS">
										<i class="fa fa-bullhorn"></i> Publish  Result </button>  
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
		</div>
	</div> 
 
	<script type='text/javascript'>   
		<?php 

		if (($admin_grade == $cm_fobrain_grd) || ($admin_grade == $admin_fobrain_grd)){  /* check admin */ 
						
			if (($rsStatus == $rseditingStage) || ($rsStatus == $rscomputedStage )){  /* check result status */ 
				 ?>
					//resetResultComputation($conn, $sessionID, $level, $class, $term);  /* reset results computaion */
					$('.show-rsconfig-div').show(); 
				<?php
				
			}
			 
		}

		?> 	 		
		hidePageLoader();
	</script>
