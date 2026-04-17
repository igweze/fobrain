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


if(!session_id()){
    session_start();
}

     	define('fobrain', 'igweze');  /* define a check for wrong access of file */

        require 'fobrain-config.php';  /* load fobrain configuration files */	  

		error_reporting(1);

		if (($_REQUEST['subConfig']) == 'cfEditCC') {  /* load subject edit form  */ 

			$courseCode =   clean($_REQUEST['courseCode']);
			
			$cfID =  cleanInt($_REQUEST['cfID']);
			
			/* script validation */ 
			
			if ($cfID == "") {
				
				$msg_e = "Ooops, an error occur while trying to retrieve subject infomation. please try again";
				
			}else {  /* load subject edit form  */ 
				
				$cfSubjC = "cfSubjC-".$cfID;
				
				echo '<input type="text" class="form-control uppWords" id="'.$cfSubjC.'" value="'.$courseCode.'" name="'.$cfSubjC.'" /> ';

			}
	
		}elseif (($_REQUEST['subConfig']) == 'cfEditCT') {  /* load subject edit form  */

			$courseTitle =   clean($_REQUEST['courseTitle']);
			
			$cfID =  cleanInt($_REQUEST['cfID']);
			
			/* script validation */
			
			if ($cfID == "") {
				
				$msg_e = "Ooops, an error occur while trying to retrieve subject infomation. please try again";
				
			}else {  /* load subject edit form  */ 
				
				$cfSubjT = "cfSubjT-".$cfID; 
						
				echo '
				<input type="text" class="form-control capWords" id="'.$cfSubjT.'" value="'.$courseTitle.'"  name="'.$cfSubjT.'" /> '; 

				echo "<script type='text/javascript'>  
						$('#cfUpdate-$cfID').fadeIn(100); 
						$('#cfEdit-$cfID').fadeOut(100);
						$('#cfmsgBox-$cfID').fadeOut(100);
						$('#cfLoader-$cfID').fadeOut(100);
					</script>"; 

			}
	
		}elseif (($_REQUEST['subConfig']) == 'cfUpdateCC') {  /* update subject code */

			$courseCode =   clean($_REQUEST['courseCode']);
			
			$cfID =  cleanInt($_REQUEST['cfID']);
			
			/* script validation */ 
			
			if ($cfID == "") {
				
				$msg_e = "Ooops, an error occur while trying to retrieve subject infomation. please try again";
				
			}else {  /* update information */ 
				
				try {

					$courseCode = strtoupper($courseCode);
					
					$ebele_mark = "UPDATE $fobrainConfigTB
									
									SET cf_code = :cf_code
									
									WHERE cf_id = :cf_id";
			
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':cf_id', $cfID);
					$igweze_prep->bindValue(':cf_code', $courseCode); 
				
					if ($igweze_prep->execute()) {  /* if sucessfully */ 
						
						echo "$courseCode";	
						
							
					}else {  /* display error */

						$msg_e = "<span>Ooops, an  Error occur while trying to update subject infomation, please try again</span>";


					}								
							
				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				}  			

			} 	

		}elseif (($_REQUEST['subConfig']) == 'cfUpdateCT') {  /* update subject title */

			$courseTitle =   clean($_REQUEST['courseTitle']);
			
			$cfID =  cleanInt($_REQUEST['cfID']);
			
			/* script validation */
			
			if ($cfID == "") {
				
				$msg_e = "Ooops, an error occur while trying to retrieve subject infomation. please try again";
				
			}else {  /* update information */  

				try {
					
					$courseTitle = ucwords($courseTitle);
					
					$ebele_mark = "UPDATE $fobrainConfigTB
									
									SET cf_tittle = :cf_tittle
									
									WHERE cf_id = :cf_id";
			
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':cf_id', $cfID);
					$igweze_prep->bindValue(':cf_tittle', $courseTitle); 
					
					if ($igweze_prep->execute()) {  /* if sucessfully */
						
						echo "$courseTitle";	
						
							
					}else {  /* display error */ 

						$msg_e = "<span>Ooops, an  Error occur while trying to update subject infomation, please try again</span>"; 

					}	 
		
					echo "<script type='text/javascript'>  
						$('#cfUpdate-$cfID').fadeOut(100); 
						$('#cfEdit-$cfID').fadeIn(100);
						$('#cfmsgBox-$cfID').fadeOut(100);
						$('#cfLoader-$cfID').fadeOut(100);
					</script>";
	
				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				} 

			}
	
		}elseif (($_REQUEST['subConfig']) == 'csEditCC') {  /* load subject edit form  */ 

			$courseCode =   clean($_REQUEST['courseCode']);
			
			$csID =  cleanInt($_REQUEST['csID']);
			
			/* script validation */
			
			if ($csID == "") {
				
				$msg_e = "Ooops, an error occur while trying to retrieve subject infomation. please try again";
				
			}else {  /* load subject edit form  */ 
				
				$csSubjC = "csSubjC-".$csID;
				
				echo '<input type="text" class="form-control uppWords" id="'.$csSubjC.'" value="'.$courseCode.'"
					name="'.$csSubjC.'" /> ';

			}
			
	
		}elseif (($_REQUEST['subConfig']) == 'csEditCT') {  /* load subject edit form  */ 

			$courseTitle =   clean($_REQUEST['courseTitle']);
			
			$csID =  cleanInt($_REQUEST['csID']);
			
			/* script validation */
			
			if ($csID == "") {
				
				$msg_e = "Ooops, an error occur while trying to retrieve subject infomation. please try again";
				
			}else {  /* load subject edit form  */ 
				
				$csSubjT = "csSubjT-".$csID; 
						
				echo '<input type="text" class="form-control capWords" id="'.$csSubjT.'" value="'.$courseTitle.'"  name="'.$csSubjT.'" />';
						
				echo "<script type='text/javascript'>  
						$('#csUpdate-$csID').fadeIn(100); 
						$('#csEdit-$csID').fadeOut(100);
						$('#csmsgBox-$csID').fadeOut(100);
						$('#csLoader-$csID').fadeOut(100);
					</script>"; 

			}
	
		}elseif (($_REQUEST['subConfig']) == 'csUpdateCC') {  /* update subject code */

			$courseCode =   clean($_REQUEST['courseCode']);
			
			$csID =  cleanInt($_REQUEST['csID']);
			
			/* script validation */
			
			if ($csID == "") {
				
				$msg_e = "Ooops, an error occur while trying to retrieve subject infomation. please try again";
				
			}else {  /* update information */ 
				
				try {

					$courseCode = strtoupper($courseCode);
					
					$ebele_mark = "UPDATE $fobrainConfigTB
									
									SET cf_code = :cf_code
									
									WHERE cf_id = :cf_id";
			
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':cf_id', $csID);
					$igweze_prep->bindValue(':cf_code', $courseCode); 
				
					if ($igweze_prep->execute()) {  /* if sucessfully */ 
						
						echo "$courseCode";	 
							
					}else {  /* display error */

						$msg_e = "<span>Ooops, an  Error occur while trying to update subject infomation, please try again</span>"; 

					}								
							
				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				} 		

			} 

		}elseif (($_REQUEST['subConfig']) == 'csUpdateCT') {  /* update subject title */

			$courseTitle =   clean($_REQUEST['courseTitle']);
			
			$csID =  cleanInt($_REQUEST['csID']);
			
			/* script validation */
			
			if ($csID == "") {
				
				$msg_e = "Ooops, an error occur while trying to retrieve subject infomation. please try again";
				
			}else {  /* update information */ 

				try {

					$courseTitle = ucwords($courseTitle);
					
					$ebele_mark = "UPDATE $fobrainConfigTB
									
									SET cf_tittle = :cf_tittle
									
									WHERE cf_id = :cf_id";
			
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':cf_id', $csID);
					$igweze_prep->bindValue(':cf_tittle', $courseTitle); 
				
					if ($igweze_prep->execute()) {  /* if sucessfully */ 
						
						echo "$courseTitle";	 
							
					}else {  /* display error */

						$msg_e = "<span>Ooops, an  Error occur while trying to update subject infomation, please try again</span>"; 
							
					}		 

					echo "<script type='text/javascript'>  
						$('#csUpdate-$csID').fadeOut(100); 
						$('#csEdit-$csID').fadeIn(100);
						$('#csmsgBox-$csID').fadeOut(100);
						$('#csLoader-$csID').fadeOut(100);
					</script>";
	
				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				} 

			}
	
		}elseif (($_REQUEST['subConfig']) == 'ctEditCC') {  /* load subject edit form  */ 

			$courseCode =   clean($_REQUEST['courseCode']);
			
			$ctID =  cleanInt($_REQUEST['ctID']);
			
			/* script validation */
			
			if ($ctID == "") {
				
				$msg_e = "Ooops, an error occur while trying to retrieve subject infomation. please try again";
				
			}else {  /* load subject edit form  */
				
				$ctSubjC = "ctSubjC-".$ctID;
				
				echo '<input type="text" class="form-control uppWords" id="'.$ctSubjC.'" value="'.$courseCode.'"
					name="'.$ctSubjC.'" />';

			}
	
		}elseif (($_REQUEST['subConfig']) == 'ctEditCT') {  /* load subject edit form  */ 

			$courseTitle =   clean($_REQUEST['courseTitle']);
			
			$ctID =  cleanInt($_REQUEST['ctID']);
			
			/* script validation */
			
			if ($ctID == "") {
				
				$msg_e = "Ooops, an error occur while trying to retrieve subject infomation. please try again";
				
			}else {  /* load subject edit form  */
				
				$ctSubjT = "ctSubjT-".$ctID; 
						
				echo '<input type="text" class="form-control capWords" id="'.$ctSubjT.'" value="'.$courseTitle.'"  name="'.$ctSubjT.'" />';
						
				echo "<script type='text/javascript'>  
						$('#ctUpdate-$ctID').fadeIn(100); 
						$('#ctEdit-$ctID').fadeOut(100);
						$('#ctmsgBox-$ctID').fadeOut(100);
						$('#ctLoader-$ctID').fadeOut(100);
					</script>";		 

			}
	
		}elseif (($_REQUEST['subConfig']) == 'ctUpdateCC') {  /* update subject course */

			$courseCode =   clean($_REQUEST['courseCode']);
			
			$ctID =  cleanInt($_REQUEST['ctID']);
			
			/* script validation */
			
			if ($ctID == "") {
				
				$msg_e = "Ooops, an error occur while trying to retrieve subject infomation. please try again";
				
			}else {  /* update information */
				
				try {

					$courseCode = strtoupper($courseCode);
					
					$ebele_mark = "UPDATE $fobrainConfigTB
									
									SET cf_code = :cf_code
									
									WHERE cf_id = :cf_id";
			
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':cf_id', $ctID);
					$igweze_prep->bindValue(':cf_code', $courseCode); 
				
					if ($igweze_prep->execute()) {  /* if sucessfully */
						
						echo "$courseCode";	 
							
					}else {  /* display error */ 

						$msg_e = "<span>Ooops, an  Error occur while trying to update subject infomation, please try again</span>"; 

					}								
							
				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				} 			

			} 	

		}elseif (($_REQUEST['subConfig']) == 'ctUpdateCT') {  /* update subject title */

			$courseTitle =   clean($_REQUEST['courseTitle']);
			
			$ctID =  cleanInt($_REQUEST['ctID']);
			
			/* script validation */
			
			if ($ctID == "") {
				
				$msg_e = "Ooops, an error occur while trying to retrieve subject infomation. please try again";
				
			}else {  /* update information */ 

				try {

					$courseTitle = ucwords($courseTitle);
					
					$ebele_mark = "UPDATE $fobrainConfigTB
									
									SET cf_tittle = :cf_tittle
									
									WHERE cf_id = :cf_id";
			
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':cf_id', $ctID);
					$igweze_prep->bindValue(':cf_tittle', $courseTitle); 

					if ($igweze_prep->execute()) {  /* if sucessfully */
						
							echo "$courseTitle";	 
							
					}else {  /* display error */ 

							$msg_e = "<span>Ooops, an  Error occur while trying to update subject infomation, please try again</span>"; 

					} 

					echo "<script type='text/javascript'>  
						$('#ctUpdate-$ctID').fadeOut(100); 
						$('#ctEdit-$ctID').fadeIn(100);
						$('#ctmsgBox-$ctID').fadeOut(100);
						$('#ctLoader-$ctID').fadeOut(100);
					</script>";
	
				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				} 

			}
	
		}elseif (($_REQUEST['subConfig']) == 'update') {  /* update subject */ 
			
			$courseID =   cleanInt($_REQUEST['courseID']);
			$courseCode =   clean($_REQUEST['courseCode-2']);
			$courseTitle =   clean($_REQUEST['courseTitle-2']);
			$courseStaff =   $_REQUEST['courseStaff-2'];				
			$term =   cleanInt($_REQUEST['courseTerm-2']);
			$level =   cleanInt($_REQUEST['courseLevel']); 
			
			/* script validation */
			
			if ($courseID == "") {
				
				$msg_e = "Ooops, an error occur while trying to retrieve subject infomation. please try again";
				
			}elseif ($courseCode == "") {
				
				$msg_e = "* Ooops error, please enter a course code";
				
			}elseif ($courseTitle == "") {
				
				$msg_e = "* Ooops error, please enter a course title";
				
			}elseif ($term == "") {
				
				$msg_e = "* Ooops error, please select a course term/semester";
				
			}elseif ($level == "") {
				
				$msg_e = "* Ooops error, please select a course level";
				
			}else {  /* update information */  

				try{

					$courseTitle = ucwords($courseTitle);
					$courseCode = strtoupper($courseCode); 
					$courseStaff = serialize($courseStaff); 
					
					$ebele_mark = "UPDATE $fobrainConfigTB
									
									SET 

									cf_code =:cf_code,
									cf_tittle = :cf_tittle,
									cf_staff = :cf_staff
									
									WHERE cf_id = :cf_id";
			
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':cf_id', $courseID); 
					$igweze_prep->bindValue(':cf_code', $courseCode);
					$igweze_prep->bindValue(':cf_tittle', $courseTitle);
					$igweze_prep->bindValue(':cf_staff', $courseStaff);

					if ($igweze_prep->execute()) {  /* if sucessfully */
						
						$msg_s = "Course ($courseTitle) information was successfully saved."; 
						echo $succesMsg.$msg_s.$sEnd; 
						echo "<script type='text/javascript'>  
							$('#refreshDiv').load('course-reload.php', {'courseLevel': ".$level."}).fadeIn(1000);
							$('#modal-fobrain').modal('hide');
							hidePageLoader();  
						</script>";exit;

							
					}else {  /* display error */ 

						$msg_e = "Ooops, an  error occur while trying to update subject infomation, please try again"; 
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;

					}  
	
				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				} 

			}
	
		}elseif (($_REQUEST['subConfig']) == 'edit') {  /* update subject title */

			$courseID =   clean($_REQUEST['courseID']);   
			
			/* script validation */
			
			if ($courseID == "") {
				
				$msg_e = "Ooops, an error occur while trying to retrieve subject infomation. please try again";
				
			}else {  /* update information */ 

				try { 
					
					$courseArr = schoolCourse($conn, $courseID);  /* school course information */ 
					$cf_code = $courseArr[$fiVal]["cf_code"];
					$cf_tittle = $courseArr[$fiVal]["cf_tittle"];
					$cf_staffs = unserialize($courseArr[$fiVal]["cf_staff"]); 
					$cf_term = $courseArr[$fiVal]["cf_term"];   
						
				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				} 	

?>
				<!-- form -->
				<form class="form-horizontal my-20" id="frmupdateSubject">  							
					<!-- row -->
					<div class="row gutters">
						<div class="col-6">										
							<!-- field wrapper start -->
							<div class="field-wrapper">										 
								<input type="text" class="form-control uppWords" maxlength="9" id="courseCode-2" 
								placeholder="Enter Course Code" value="<?php echo $cf_code; ?>"
								required>
								<div class="field-placeholder">Course Code <span class="text-danger">*</span></div>
							</div>
							<!-- field wrapper end -->
						</div>
						<div class="col-6">										
							<!-- field wrapper start -->
							<div class="field-wrapper">										 
								<input type="text" class="form-control capWords" maxlength="60" id="courseTitle-2" 
								placeholder="Enter Course Title" value="<?php echo $cf_tittle; ?>"
								required>
								<div class="field-placeholder"> Course Title <span class="text-danger">*</span></div>
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
								<select class="form-control"  name="courseStaff[]" id="courseStaff-2"  multiple placeholder="Select Class Teacher..." autocomplete="off"> 
									<option value = "">Please select One</option>
									
									<?php  
										try{
												
											$staff_arr = staffArrays($conn);  /* school staffs/teachers token information */

											if($cf_staffs != ""){  /* check is staff is empty */	  
											
												echo staffSelectBox($conn, $staff_arr, $cf_staffs, true);  
											
											}else{

												echo staffSelectBox($conn, $staff_arr, "none", false);  

											}	 
											
										}catch(PDOException $e) {				
											fobrainDie( 'Ooops Database Error: ' . $e->getMessage());													
										}	
									?>
								
								</select>
								<div class="field-placeholder"> Teacher/s <span class="text-danger">*</span></div> 
							</div>
							<!-- field wrapper end -->
						</div>	
					</div>			
		
					<script type="text/javascript"> 
						renderSelectImg("#courseStaff-2", 3);
					</script> 
						
					
					<hr class="mt-30 mb-15 text-danger" />
					<!-- row -->
					<div class="row gutters modal-btn-footer">
						<div class="col-6 text-start">
							<button type="button" id="close-modal" class="btn btn-danger close-modal" 
							data-bs-dismiss="modal"> <i class="mdi mdi-window-close label-icon"></i> Close</button>
						</div>
						<div class="col-6 text-end">
							<input type="hidden" name="subConfig" value="update" /> 	
							<input type="hidden" name="courseID" id="courseID" value="<?php echo $courseID; ?>" /> 	
							<input type="hidden" name="courseTerm-2" id="courseTerm-2" value="<?php echo $cf_term; ?>" />
							<button type="submit" class="btn btn-primary   
							btn-label waves-light demo-disenable" id="updateSubject">
								<i class="mdi mdi-content-save label-icon"></i>  Save
							</button>
						</div>
					</div>	
					<!-- /row -->	
						

				</form>
				<!-- / form -->	 

				<script type='text/javascript'> hidePageLoader(); </script>
<?php
        	}
        
		}elseif (($_REQUEST['subConfig']) == 'saveSubj') {  /* save subject  */

			
			$courseTitle =   clean($_REQUEST['courseTitle']);
			$courseStaff =   $_REQUEST['courseStaff'];
			$courseCode =   clean($_REQUEST['courseCode']);
			$term =   cleanInt($_REQUEST['courseTerm']);
			$level =   cleanInt($_REQUEST['courseLevel']);
			$fiTermLast =   cleanInt($_REQUEST['fiTermLast']);
			$seTermLast =   cleanInt($_REQUEST['seTermLast']);
			$thTermLast =   cleanInt($_REQUEST['thTermLast']);
			
			/* script validation */
			
			if ($courseCode == "") {
				
				$msg_e = "* Ooops error, please enter a course code";
				
			}elseif ($courseTitle == "") {
				
				$msg_e = "* Ooops error, please enter a course title";
				
			}elseif ($term == "") {
				
				$msg_e = "* Ooops error, please select a course term/semester";
				
			}elseif ($level == "") {
				
				$msg_e = "* Ooops error, please select a course level";
				
			}else {  /* insert information */  

				$courseTitle = ucwords($courseTitle);
				$courseCode = strtoupper($courseCode);

				$courseStaff = serialize($courseStaff);
				
				require  $fobrainClassConfigDir;   /* include class configuration script */
				
				$rawCArr = explode(", ", $query_i_scores);
				
				$lastRawC = end($rawCArr);
				
				list($rawC, $rawNum) = explode('_', $lastRawC);
				
				/* generate new course information */
				
				if($rawNum >= $fiVal){
				
					$newRawN = ($rawNum + $fiVal);
				
					$rawCC = $rawC.'_'.$newRawN;
					$rawCT = $rawC.'_t_'.$newRawN;
					$rawCP = $rawC.'_p_'.$newRawN;
					$rawCom = $rawC.'_c_'.$newRawN;
					
				
					$rawCC_af = $rawC.'_'.$rawNum;
					$rawCT_af = $rawC.'_t_'.$rawNum;
					$rawCP_af = $rawC.'_p_'.$rawNum;
					$rawCom_af = $rawC.'_c_'.$rawNum;
					
					$rawCC_vb = "after $rawCC_af";
					$rawCT_vb = "after $rawCT_af";
					$rawCP_vb = "after $rawCP_af";
					$rawCom_vb = "after $rawCom_af";
				
				}else{
					
					$rawC = $courseRawArr[$term];
					$newRawN = $level.'01'; 
					
					$rawCC = $rawC.'_'.$newRawN;
					$rawCT = $rawC.'_t_'.$newRawN;
					$rawCP = $rawC.'_p_'.$newRawN;
					$rawCom = $rawC.'_c_'.$newRawN;
					
					
					$rawCC_vb = "after ireg_id";
					$rawCT_vb = "after ireg_id";
					$rawCP_vb = "after ireg_id";
					$rawCom_vb = "after ireg_id";
					
				} 
					

				try { 
				 
					
					if(doCourseCodeExists($conn, $schoolID, $level, $term, $courseCode) == $fiVal){  /* check if school subjects exits */
						
						$msg_e = "* Ooops error, this subject code ($courseCode) already exits in this term and level. Please try again";
					
					}elseif(doSubjectExists($conn, $schoolID, $level, $term, $rawCC, $rawCT, $rawCP) == $fiVal){  /* check if school subjects exits */
						
						$msg_e = "* Ooops error, this subject code already exits. Please try again";
					
					}else{  /* display error */  
						 
						
						//$conn->beginTransaction();   /* begin transaction */						

						$ebele_mark = "INSERT INTO $fobrainConfigTB (cf_raw , cf_code, cf_tittle, cf_staff, cf_tot, cf_pos, cf_com, cf_level, cf_term, 
																	cf_program, cf_status) 

											VALUES (:cf_raw , :cf_code, :cf_tittle, :cf_staff, :cf_tot, :cf_pos, :cf_com, :cf_level, :cf_term, :cf_program, 
													:cf_status)"; 
																
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':cf_raw', $rawCC);
						$igweze_prep->bindValue(':cf_code', $courseCode);
						$igweze_prep->bindValue(':cf_tittle', $courseTitle);
						$igweze_prep->bindValue(':cf_staff', $courseStaff);				 				 
						$igweze_prep->bindValue(':cf_tot', $rawCT);				 				 
						$igweze_prep->bindValue(':cf_pos', $rawCP);				 				 
						$igweze_prep->bindValue(':cf_com', $rawCom);
						$igweze_prep->bindValue(':cf_level', $level);
						$igweze_prep->bindValue(':cf_term', $term);
						$igweze_prep->bindValue(':cf_program', $schoolID);
						$igweze_prep->bindValue(':cf_status', $fiVal);	
						$igweze_prep->execute();

						//$courseIDQ = $conn->lastInsertId();
						
						$ebele_mark_1 = "ALTER TABLE $sdoracle_score_nk ADD $rawCC VARCHAR(50) NULL $rawCC_vb";
																		
						$igweze_prep_1 = $conn->prepare($ebele_mark_1);
						$igweze_prep_1->execute();
						
						$ebele_mark_2 = "ALTER TABLE $sdoracle_sub_score_nk ADD $rawCT TINYINT(3) NULL $rawCT_vb";
																		
						$igweze_prep_2 = $conn->prepare($ebele_mark_2);
						$igweze_prep_2->execute();
						
						$ebele_mark_3 = "ALTER TABLE $sdoracle_grade_nk ADD $rawCP TINYINT(3) NULL $rawCP_vb";
																		
						$igweze_prep_3 = $conn->prepare($ebele_mark_3);
						$igweze_prep_3->execute();
						
						$ebele_mark_4 = "ALTER TABLE $sdoracle_comment_nk ADD $rawCom TEXT NULL $rawCom_vb";
																		
						$igweze_prep_4 = $conn->prepare($ebele_mark_4);
						$igweze_prep_4->execute(); 
					
						if (($igweze_prep == true) && ($igweze_prep_1 == true) && ($igweze_prep_2 == true) && ($igweze_prep_3 == true)
							&& ($igweze_prep_4 == true)) {  /* if sucessfully */ 
							
							//$conn->commit();   /* insert information */
							$schoolTerm = schoolTerm($term);  /* school term  */

							echo "<script type='text/javascript'>  
									$('#refreshSubjsTab').click();
									$('#couTerm').text('$term');
									$('#courseCode').val('');
									$('#courseTitle').val('');
									//$('#courseStaff').val('');
									//$('#courseTerm').val(''); 
								</script>";

							$msg_s = "Course information with Code <strong>$courseCode</strong> and title <strong>$courseTitle</strong> was successfully added for <strong>$schoolTerm term</strong>. Thanks"; 
								
							echo $succesMsg.$msg_s.$sEnd; exit;
																						
						}else{  /* display error */
							
							//$conn->rollBack();   /* roll back insertion */
							$msg_e = "Ooops Error, Course information with Code <strong>$courseCode</strong> and title <strong>$courseTitle</strong> was not successfully added. Please try again!!!"; 
							
						}

					}
							
				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error aa: ' . $e->getMessage());
			
				} 
			
			}
	
		}elseif (($_REQUEST['subConfig']) == 'removeSubj') {  /* remove subject */

	
			$courseData =   $_REQUEST['courseData'];
			$adminPass =   $_REQUEST['adminPass'];
			$adminPass = clean($adminPass); 

			$checkDetail =  staffLoginData($conn, $_SESSION['adminUser']);  /* school staffs/teachers password details */ 			 
			list ($tID, $staffUser, $checkedPass, $staffName, $staff_fobrain_grdQ, $userGrade, $userAccess) = 
			explode ("@(.$*S*$.)@", $checkDetail);
				
			list ($igweze, $subjID, $level, $term, $rawCC, $courseCode, $courseTitle) = explode('-', $courseData);
			
			/* script validation */ 
			
			if (($subjID == "") ||($rawCC== "") || ($courseCode == "") || ($courseTitle == "") || ($term == "") || ($level == "")) {
				
				echo "<script type='text/javascript'>   $('#subj-loader').fadeOut(1500); </script>"; 
				$msg_e = "* Ooops error, could not find this course information";
				
			}elseif(!password_verify($adminPass, $userAccess)){ 			 

				echo "<script type='text/javascript'>   $('#subj-loader').fadeOut(1500); </script>"; 
				$msg_e = "* Ooops error, your admin authorization password is invalid.";

			}else {  /* remove information */  
					
				try { 

					require  $fobrainClassConfigDir;   /* include class configuration script */
						
					//$conn->beginTransaction();   /* begin transaction */		
					
					list($rawC, $rawNum) = explode('_', $rawCC);
					
					$rawCT = $rawC.'_t_'.$rawNum;
					$rawCP = $rawC.'_p_'.$rawNum;
					$rawCom = $rawC.'_c_'.$rawNum; 

					$ebele_mark = "DELETE FROM $fobrainConfigTB 
									
									WHERE cf_id = :cf_id
									
									AND  cf_raw = :cf_raw
									
									AND  cf_level = :cf_level
									
									LIMIT 1";
															
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':cf_id', $subjID);
					$igweze_prep->bindValue(':cf_raw', $rawCC);					
					$igweze_prep->bindValue(':cf_level', $level);	
					$igweze_prep->execute();
					
					$ebele_mark_1 = "ALTER TABLE $sdoracle_score_nk DROP $rawCC";
					$igweze_prep_1 = $conn->prepare($ebele_mark_1);
					$igweze_prep_1->execute();
					
					$ebele_mark_2 = "ALTER TABLE $sdoracle_sub_score_nk DROP $rawCT";						
					$igweze_prep_2 = $conn->prepare($ebele_mark_2);
					$igweze_prep_2->execute();
					
					$ebele_mark_3 = "ALTER TABLE $sdoracle_grade_nk DROP $rawCP";
					$igweze_prep_3 = $conn->prepare($ebele_mark_3);
					$igweze_prep_3->execute();
					
					$ebele_mark_4 = "ALTER TABLE $sdoracle_comment_nk DROP $rawCom";
					$igweze_prep_4 = $conn->prepare($ebele_mark_4);
					$igweze_prep_4->execute();
					
					
					if (($igweze_prep == true) && ($igweze_prep_1 == true) && ($igweze_prep_2 == true) && ($igweze_prep_3 == true)
						&& ($igweze_prep_4 == true)){  /* if sucessfully */ 	

						if($term == $fiVal) {  /* check subject term */
							
							$subjRow = 'cfRow-'.$subjID;
						
						}elseif($term == $seVal) {  /* check subject term */
								
							$subjRow = 'csRow-'.$subjID; 

						}elseif($term == $thVal) {  /* check subject term */

							$subjRow = 'ctRow-'.$subjID;
						
						}else{ 
								
							$subjRow = 'cfRow-'.$subjID; 
								
						} 
						
						//$conn->commit();   /* renove all information */
						$schoolTerm = schoolTerm($term);
						
						$msg_s = "Course information with Code <strong>$courseCode</strong> and title <strong>$courseTitle</strong> was successfully remove from <strong>$schoolTerm term</strong>. Thanks";
							echo $succesMsg.$msg_s.$sEnd; //exit; 	

						echo "<script type='text/javascript'>  
							
								$('#".$subjRow."').fadeOut(1000);;
								$('#subj-loader').fadeOut(1500);
								$('#adminPass').val('');
				
							</script>"; 
																					
					}else{  /* display error */ 
					
						echo "<script type='text/javascript'>  $('#subj-loader').fadeOut(1500); </script>";

						//$conn->rollBack();   /* roll back insertion */
						$msg_e = "Ooops Error, Course information with Code <strong>$courseCode</strong> and title <strong>$courseTitle</strong> was not successfully removed. Please try again!!!"; 
						
					} 								
							
				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				} 
			
			}
	
		}else{
		
			echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
		
		} 
		
		if ($msg_s) {

			echo $succesMsg.$msg_s.$sEnd; exit; 				
									
		}	


		if ($msg_e) {

			echo $errorMsg.$msg_e.$eEnd; exit;  
									
		}	
		
exit;
?>