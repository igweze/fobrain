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
	This page is the school class subject manager
	------------------------------------------------------------------------*/ 
	if(!session_id()){
		session_start();
	}

		if (!defined('fobrain')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');  

		require 'fobrain-config.php';  /* load fobrain configuration files */
		
		if (($_REQUEST['iemj']) != '') {
			
			list($subs, $level) = explode('-', $_REQUEST['iemj']);
		
			try {
			
				$levelArr = studentLevelsArray($conn); /* retrive this school level data */
				array_unshift($levelArr,"");
				unset($levelArr[0]);

				$firstTSubjects = schoolCoursesInfo($conn, $schoolID, $level, $fiVal); /* retrive this level first term subjects */
				$secondTSubjects = schoolCoursesInfo($conn, $schoolID, $level, $seVal); /* retrive this level second term subjects */
				$thirdTSubjects = schoolCoursesInfo($conn, $schoolID, $level, $thVal); /* retrive this level third term subjects */
				
				$firstTSubjectsC = count($firstTSubjects);
				$secondTSubjectsC = count($secondTSubjects);
				$thirdTSubjectsC = count($thirdTSubjects); 
				
			}catch(PDOException $e) {
			
				fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
				
			} 

			require_once $fobrainIconPage; /* This include top middle global icon page eg go back, print buttons etcs */
?>		
					
			 		                
		<!-- row -->
		<div <?php echo $fob_view; ?> class="row gutters row-section fobrain-section-div justify-content-center">
			<div class=" col-12">	
				<!-- card start -->
				<div class="card card-shadow"> 

					<?php 
						$page_title = '<i class="mdi mdi-google-classroom fs-18"></i>
						'.$levelArr[$level]['level'].' Subjects  Config. ';
						pageTitle($page_title, 0);	 
					?> 
					<div id="msg-box"></div> 					
					<div class="card-body">
						<div class="row gutters mb-25 mt-10">
                            <div class="hints">
								[<i class="mdi mdi-help-circle-outline"></i>] 
								You can create and manage school courses for each level during the 1st, 2nd, and 3rd terms below.
							</div>
                        </div>
						
						<div class="gutters my-20 text-end menu-sc-card"> 
							<button type="button" class="btn btn-danger    
							btn-label waves-light display-none" id="return-pin-back">
								<i class="mdi mdi-backburger label-icon"></i>  Return
							</button>
							<button type="button" class="btn btn-primary   
							btn-label waves-light" id="create-new-pins">
								<i class="mdi mdi-notebook-plus-outline label-icon"></i>  Create
							</button>
						</div>  

						<!-- form -->
						<form class="form-horizontal mt-20 mb-70 display-none" id="frmsaveCardPin">  							
							<!-- row -->
							<div class="row gutters">
								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">										
									<!-- field wrapper start -->
									<div class="field-wrapper">										 
										<input type="text" class="form-control uppWords" maxlength="9" id="courseCode" placeholder="Course Code Eg ENG101"
                                     	required>
										<div class="field-placeholder">Course Code <span class="text-danger">*</span></div>
									</div>
									<!-- field wrapper end -->
								</div>
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">										
									<!-- field wrapper start -->
									<div class="field-wrapper">										 
										<input type="text" class="form-control capWords" maxlength="60" id="courseTitle" placeholder="Enter Course Title"
                                      	required>
										<div class="field-placeholder"> Course Title <span class="text-danger">*</span></div>
									</div>
									<!-- field wrapper end -->
								</div>	
								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">										
									<!-- field wrapper start -->
									<div class="field-wrapper">										 
										<select class="form-control fob-select"  id="courseTerm" name="courseTerm" required>											
											<option value = "">Please Select Term</option>
											<?php

												foreach($term_list as $term_key => $term_value){    /* loop array */  /* loop array */

													echo '<option value="'.$term_key.'"'.$selected.'>'.$term_value.'</option>' ."\r\n";

												}

											?>										
										</select>
										<input type="hidden" value="saveSubj" name = "subjectData"/>										
										<div id="courseLevel" style="display:none"><?php echo $level; ?></div>
										<div id="couTerm" style="display:none">1</div>
										<div class="field-placeholder"> Course Term <span class="text-danger">*</span></div>
									</div>
									<!-- field wrapper end -->
								</div>																 
							</div>	
							<!-- /row -->


							<!-- row --> 
							<div class="row gutters">
								<div class="col-12">
									<!-- field wrapper start -->
									<div class="field-wrapper tom">
										<select class="form-control"  name="courseStaff[]" id="courseStaff"  multiple placeholder="Select Course Teacher..." autocomplete="off"> 
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
										<div class="field-placeholder"> Course Teacher/s <span class="text-danger">(Optional)</span></div> 
									</div>
									<!-- field wrapper end -->
								</div>	
							</div>			
				
							<script type="text/javascript"> 
								renderSelectImg("#courseStaff", 3);
							</script>
							
							<!-- row -->
							<div class="row gutters mt-20">
								<div class="col-12 text-end">
									<input type="hidden" name="card" value="save" /> 	
									<button type="submit" class="btn btn-primary   
									btn-label waves-light demo-disenable" id="saveSubjects">
										<i class="mdi mdi-content-save label-icon"></i>  Save
									</button>
									<div class="spinner-border text-danger pull-right display-none" role="status">
										<span class="visually-hidden">Loading...</span>
									</div>
								</div>
							</div>	
							<!-- /row -->		
							
							<hr class="text-danger my-20" />

						</form>
						<!-- / form -->	 

						<div class="text-center" id="subj-loader" style="display: none;">
							<div class="spinner-border text-danger" role="status">
								<span class="visually-hidden">Loading...</span>
							</div>
						</div>
						<div id="msg-box"></div> 
						<div id="refreshSubjsTab"></div>

						<div id="refreshDiv">	  

							<?php require_once "course-wrapper.php"; ?> 

						</div>	

					</div>
				</div>
				<!-- card end -->	
			</div>
		</div>
		<!-- / row -->	  

		<!--  fobrain modal start -->			
		<button type="button" class="btn modal-fobrain  display-none"  data-bs-toggle="modal" data-bs-target="#modal-fobrain"></button>				
		<!-- Scrollable modal -->
		<div class="modal fade animate__animated animate__zoomInDown" id="modal-fobrain" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
			<div class="modal-dialog modal-fullscreen-sm-down modal-dialog-scrollable">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalScrollableTitle"> 
							<i class="mdi mdi-text-subject label-icon"></i>  
							Course Manager
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
			hidePageLoader();
		</script>


                                 
<?php 

		}else{
		
			echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
		
		} 
		
		if ($msg_s) {

			echo $succesMsg.$msg_s.$sEnd; echo $scroll_up; exit; 				
									
		}	


		if ($msg_e) {

			echo $errorMsg.$msg_e.$eEnd; echo $scroll_up; exit;  
									
		}	
				
exit;
?>		