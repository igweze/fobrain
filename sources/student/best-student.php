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
	This page search for best student in a or all class
	------------------------------------------------------------------------*/ 


		if (!defined('fobrain')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
				
		require_once $fobrainIconPage; /* This include top middle global icon page eg go back, print buttons etcs */

?>



		<!-- row -->
		<div <?php echo $fob_view; ?> class="row gutters row-section fobrain-section-div justify-content-center">
			<div class="col-xl-5 col-lg-6 col-md-12 col-sm-12 col-12">	
				<!-- card start -->
				<div class="card card-shadow"> 
					<?php 
						$page_title = '<i class="mdi mdi-trophy-award fs-18"></i> 
						Best Student/s Result';
						pageTitle($page_title, 0);	 
					?> 
					<div class="card-body">
						<!-- form -->
						<form class="form-horizontal" id="frmbestStudents"> 
							<!-- row -->
							<div class="row gutters">
								<div class="col-12">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<select class="form-control fob-select"  id="level" name="level" required> 
                                			<option value = "">Select One</option>
												<?php 
													try {
													
														studentLevel($conn);  /* retrieve student level */
											 
													}catch(PDOException $e) {
						
													fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
						 
													} 
												?> 
                                        </select>
										<div class="field-placeholder"> Level <span class="text-danger">*</span></div> 
									</div>
									<!-- field wrapper end -->
								</div>
								<div class="col-12">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
										 <select class="form-control fob-select"  id="sr-class" name="sr-class" required>                                              
                                		    <option value = "">Select One</option>
                                            <option value = "1">My Class</option>
                                            <option value = "2">Overall Classes</option>                               
                                              
                                        </select>
										<div class="field-placeholder">Class <span class="text-danger">*</span></div> 
									</div>
									<!-- field wrapper end -->
								</div>									 
							</div>	
							<!-- /row -->
							
							<!-- row -->
							<div class="row gutters">
								<div class="col-12">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<select class="form-control fob-select"  id="term" name="term" required>                                              
                                			<option value = "">Select One</option>                                
												<?php

													foreach($term_list as $term_key => $term_value){    /* loop array */

														if ($term_list == $term_value){
														$selected = "SELECTED";
														} else {
														$selected = "";
														}

														echo '<option value="'.$term_key.'"'.$selected.'>'.$term_value.'</option>' ."\r\n";
														

													}
													
													//echo '<option value="all"'.$selected.'>All Term Result</option>' ."\r\n";

												?> 
                                        </select>
										<div class="field-placeholder"> Term <span class="text-danger">*</span></div>
										<div class="form-text text-danger">
											Please select a School term / session.
										</div>
									</div>
									<!-- field wrapper end -->
								</div>																 
							</div>	
							<!-- /row -->
							
							<!-- row -->
							<div class="row gutters">
								<div class="col-12 text-end">
									<input name="rsData" value="bestStudentRS" type="hidden"  />
									<button type="submit" class="btn btn-primary waves-effect   
									btn-label waves-light" id="bestStudents">
										<i class="bx bx-search label-icon"></i>  Search
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
		
		<!-- row -->
		<div class="row gutters <?php echo $fob_view_2; ?>" id="wiz-slider">		
			<div class="col-12">	
				<!-- card start -->
				<div id="upload-qy-data" class="display-none"></div>
				<div class="card card-shadow">				 		
					<div class="card-body mx-10" id="fobrain-page-div"></div>
				</div>
				<!-- card end -->	
			</div> 			
		</div>
		<!-- / row -->						

		<script type="text/javascript">	 
			$('.fob-select').each(function() {  
				renderSelect($('#'+this.id)); 
			});  
		</script>			