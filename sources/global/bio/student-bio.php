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
	This page load student profile form
	------------------------------------------------------------------------*/  

if(!session_id()){
    session_start();
}

		if (!defined('fobrain')) /* This checks if this page was wrongly access by users */
		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
				
		require_once $fobrainIconPage; /* This include top middle global icon page eg go back, print buttons etcs */ 
		 
		try {
		
			
			$reg = clean($_REQUEST['reg']);

			$sessionID = studentRegSessionID($conn, $reg);  /* student school session ID */
			$session_fi = fobrainSession($conn, $sessionID);  /* school session */
									
			$session_se = $session_fi + $foreal;  
			
			if($schoolExt == $fobrainNurAbr){  /* check if school is nursery */
				
				$class = 'class_1, class_2, class_3,';
				
			}else{  /* else normal school */
				
				$class = 'class_1, class_2, class_3, class_4, class_5, class_6,';
			
			}
			
			/* select information */ 
			
			$ebele_mark = "SELECT r.ireg_id, nk_regno, $class
							s.stu_id, i_stupic, i_firstname, i_lastname, i_midname, i_gender, i_dob, 
							religion, i_country, i_state, i_lga, i_city, i_add_fi, i_add_se, i_stu_phone, 
							i_email, i_sponsor, i_spo_phone, i_spo_add, i_spon_occup,  sponsor2, sponphone2, 
							sponadd2, soccup2, genotype, bloodgp, hostel, route, disability, 
							height, weight, prevsch, bcert, guardid, prevcert, sibling

									FROM $i_reg_tb r, $i_student_tb s

									WHERE r.nk_regno = :nk_regno
									
									AND r.ireg_id = s.ireg_id";
					
			$igweze_prep = $conn->prepare($ebele_mark);	
			$igweze_prep->bindValue(':nk_regno', $reg);
			$igweze_prep->execute();
			
			$rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count == $foreal) {  /* check array is empty */
			
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {  /* loop array */			
	
					$regNum = $row['nk_regno'];
					$ID = $row['ireg_id'];
					$pic = $row['i_stupic'];
					$fname = $row['i_firstname'];
					$lname = $row['i_lastname'];
					$mname = $row['i_midname'];					
					$fiClass = $row['class_1'];
					$seClass = $row['class_2'];
					$thClass = $row['class_3'];
					$foClass = $row['class_4'];
					$fifClass = $row['class_5'];
					$sixClass = $row['class_6'];					
					$sex = $row['i_gender'];
					$dob = $row['i_dob'];
					$religion = $row['religion'];
					$country = $row['i_country']; 
					$state = $row['i_state'];
					$lga = $row['i_lga'];
					$city = $row['i_city'];
					$add1 = $row['i_add_fi'];
					$add2 = $row['i_add_se'];
					$studphone = $row['i_stu_phone'];
					$sibling = unserialize($row['sibling']);
					$email = $row['i_email'];
					$sponsor = $row['i_sponsor'];
					$sponphone = $row['i_spo_phone'];
					$soccup = $row['i_spon_occup'];
					$sponadd = $row['i_spo_add'];
					$sponsor2 = $row['sponsor2'];
					$sponphone2 = $row['sponphone2'];
					$soccup2 = $row['soccup2'];
					$sponadd2 = $row['sponadd2'];
					$bloodGP = $row['bloodgp'];
					$genoTP = $row['genotype'];
					$hostelID = $row['hostel'];
					$routeID = $row['route']; 
					$height = $row['height'];
					$weight = $row['weight'];
					$prevsch = $row['prevsch'];
					$bcert = $row['bcert'];
					$guardid = $row['guardid'];
					$prevcert = $row['prevcert'];   
					//$disability = $row['disability']; 

				}	 			 

				$student_img = picture($school_pic_dir.$session_fi.'_'.$session_se.'/', $pic, "student");
				$bcert_img = picture($school_pic_dir.$session_fi.'_'.$session_se.'/', $bcert, "doc");
				$guardid_img = picture($school_pic_dir.$session_fi.'_'.$session_se.'/', $guardid, "doc");
				$prevcert_img = picture($school_pic_dir.$session_fi.'_'.$session_se.'/', $prevcert, "doc"); 
					

				$levelArray = studentLevelsArray($conn); /* student level array */

				if($schoolExt == $fobrainNurAbr){  /* check if school is nursery */
				
					$clArray_fi = studentClassArray($conn, $fiVal);  /* retrieve student 100 level class array */
					$clArray_se = studentClassArray($conn, $seVal);  /* retrieve student 200 level class array */
					$clArray_th = studentClassArray($conn, $thVal);  /* retrieve student 300 level class array */
						
					$classArray_fi = unserialize($clArray_fi);
					$classArray_se = unserialize($clArray_se);
					$classArray_th = unserialize($clArray_th);
						
					
				}else{  /* else normal school */
					
					$clArray_fi = studentClassArray($conn, $fiVal);  /* retrieve student 100 level class array */
					$clArray_se = studentClassArray($conn, $seVal);  /* retrieve student 200 level class array */
					$clArray_th = studentClassArray($conn, $thVal);  /* retrieve student 300 level class array */
					$clArray_fo = studentClassArray($conn, $foVal);  /* retrieve student 400 level class array */
					$clArray_fif = studentClassArray($conn, $fifVal);  /* retrieve student 500 level class array */
					$clArray_six = studentClassArray($conn, $sixVal);  /* retrieve student 600 level class array */

					$classArray_fi = unserialize($clArray_fi);
					$classArray_se = unserialize($clArray_se);
					$classArray_th = unserialize($clArray_th);
					$classArray_fo = unserialize($clArray_fo);
					$classArray_fif = unserialize($clArray_fif);
					$classArray_six = unserialize($clArray_six);
				
				} 
				
					
			
			}else{  /* display error */ 
	
				$msg_e =  "Student\'s record with <span>$reg </span> was not found.";						  
				echo $errorMsg.$msg_e.$eEnd; echo "<script type='text/javascript'> hidePageLoader();	</script>";	 echo $scroll_up; exit; 			
										
			} 
			
		}catch(PDOException $e) {
			
			fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
				
		}
	
		
		
?>		

	<!-- form wizard -->
	<div class="form-wizard frm-wd-header"> 
		<div class="row gutters justify-content-center"> 
			<div class="hints col-lg-12 text-danger mb-25">
				[<i class="mdi mdi-help-circle-outline"></i>] 
				Only max image size of 2MB &amp; format of <?php echo $allowedPicExt; ?> are allowed.
			</div> 
			<div class="msg-box-pic"></div>	<div class="msg-box"></div>		
			<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-6 text-center mb-20">	
				<div class="picture-div mb-10">
					<img src="<?php echo $student_img; ?>" alt="Student Picture" class="preview-picture-1 img-h-150 rounded img-thumbnail" />
				</div>
				<!-- form -->
				<form method="POST" id = "frmuploadProfile"  enctype="multipart/form-data">
				<!-- file-wrapper start -->
				<div class="file-wrapper">
					<label class="upload  fob-btn-profile">
						<i class="mdi mdi-cloud-upload-outline fs-24 text-danger"></i> 
						<input type="file" name="uploadProfile" id="uploadProfile"  class="form-control hide">
					</label> 
					<div class="form-text fob-btn-profile"> 
						<input type='hidden' value = "<?php echo $regNum; ?>" name="regNum" />	
						<input type="hidden" name="profile" value="uploads" />
						<input type="hidden" name="upload_t" value="profile" />  		
															
						<div class="text-danger">Student Picture</div>
					</div>
					<div class="display-none fob-loader-profile"> 
						<strong role="status">Processing...</strong>
						<div class="spinner-border ms-auto" aria-hidden="true"></div>
					</div>
				</div>
				<!-- file-wrapper end -->  
				</form>
				<!-- / form -->	
			</div> 

			<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-6 text-center mb-20">	
				<div class="picture-div mb-10">
					<img src="<?php echo $bcert_img; ?>" alt="Birth Certificate" class="preview-picture-2 img-h-150 rounded img-thumbnail" />
				</div>
				<!-- form -->
				<form method="POST" id = "frmDoc1"  enctype="multipart/form-data" action='bio-manager.php'>
				<!-- file-wrapper start -->
				<div class="file-wrapper">
					<label class="upload fob-btn-bcer">
						<i class="mdi mdi-cloud-upload-outline fs-24 text-danger"></i> 
						<input type="file" name="upload1" id="upload1"  class="form-control hide">
					</label> 
					<div class="form-text fob-btn-bcert"> 
						<input type='hidden' value = "<?php echo $regNum; ?>" name="regNum" />	
						<input type="hidden" name="profile" value="uploads" />
						<input type="hidden" name="upload_t" value="bcert" />   
						<div class="text-danger">Birth Certificate</div>
					</div>
					<div class="display-none fob-loader-bcert">
						<strong role="status">Processing...</strong>
						<div class="spinner-border ms-auto" aria-hidden="true"></div>
					</div>
				</div>
				<!-- file-wrapper end -->  
				</form>
				<!-- / form -->	
			</div> 

			<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-6 text-center mb-20">	
				<div class="picture-div mb-10">
					<img src="<?php echo $guardid_img; ?>"  alt="Gurdian ID" class="preview-picture-3 img-h-150 rounded img-thumbnail" />
				</div>
				<!-- form -->
				<form method="POST" id = "frmDoc2"  enctype="multipart/form-data" action='bio-manager.php'>
				<!-- file-wrapper start -->
				<div class="file-wrapper">
					<label class="upload fob-btn-guardid">
						<i class="mdi mdi-cloud-upload-outline fs-24 text-danger"></i> 
						<input type="file" name="upload2" id="upload2"  class="form-control hide">
					</label> 
					<div class="form-text fob-btn-guardid"> 
						<input type='hidden' value = "<?php echo $regNum; ?>" name="regNum" />	
						<input type="hidden" name="profile" value="uploads" />
						<input type="hidden" name="upload_t" value="guardid" />  		
															
						<div class="text-danger">Gurdian ID</div>
					</div>
					<div class="display-none fob-loader-guardid">
						<strong role="status">Processing...</strong>
						<div class="spinner-border ms-auto" aria-hidden="true"></div>
					</div>
				</div>
				<!-- file-wrapper end -->  
				</form>
				<!-- / form -->	
			</div> 


			<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-6 text-center mb-20">	
				<div class="picture-div mb-10">
					<img src="<?php echo $prevcert_img; ?>" alt="Prev. School Result" class="preview-picture-4 img-h-150 rounded img-thumbnail" />
				</div>
				<!-- form -->
				<form method="POST" id = "frmDoc3"  enctype="multipart/form-data" action='bio-manager.php'>
				<!-- file-wrapper start -->
				<div class="file-wrapper">
					<label class="upload fob-btn-prevcert">
						<i class="mdi mdi-cloud-upload-outline fs-24 text-danger"></i> 
						<input type="file" name="upload3" id="upload3"  class="form-control hide">
					</label> 
					<div class="form-text fob-btn-prevcert"> 
						<input type='hidden' value = "<?php echo $regNum; ?>" name="regNum" />	
						<input type="hidden" name="profile" value="uploads" />
						<input type="hidden" name="upload_t" value="prevcert" />  		
															
						<div class="text-danger">Prev. School Result</div>
					</div>
					<div class="display-none fob-loader-prevcert">
						<strong role="status">Processing...</strong>
						<div class="spinner-border ms-auto" aria-hidden="true"></div>
					</div>
				</div>
				<!-- file-wrapper end -->  
				</form>
				<!-- / form -->	
			</div>  
		</div>	
		<!-- /row --> 	
 


		
		<form method="POST" id = "frmStudentBio"  action='bio-manager.php'> 
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
				<! -- step 4 -->
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
				<div style="clear:both;"></div>

				<!-- row -->
				<div class="row gutters">  
					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">									
						<!-- field wrapper start -->
						<div class="field-wrapper">
							<input type="text" class="form-control required capWords" value ="<?php echo $lname; ?>" 
							id="lname" name="lname" />
							<div class="field-placeholder">Last Name <span class="text-danger">*</span></div> 
						</div>
						<!-- field wrapper end -->
					</div>
					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">										
						<!-- field wrapper start -->
						<div class="field-wrapper">
							<input type="text" class="form-control required capWords" value ="<?php echo $fname; ?>" 
								id="fname" name="fname" />
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
					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">	
						<!-- field wrapper start -->
						<div class="field-wrapper">
							<select class="form-control required fob-select-2"  id="sex" name="sex">                                              
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
					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">										
						<!-- field wrapper start -->
						<div class="field-wrapper">
							<input type="text"  value="<?php echo $dob; ?>" 
							  class="form-control required" name="dob" />
							<div class="field-placeholder">Date of Birth <span class="text-danger">*</span></div> 
						</div>
						<!-- field wrapper end -->
					</div>		
					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12"> 
						<!-- field wrapper start -->
						<div class="field-wrapper"> 
							<input type="text" class="form-control capWords" value ="<?php echo $religion; ?>" 
							id="religion" name="religion" />
							<div class="field-placeholder">Religion <span class="text-danger"></span></div> 
						</div>
						<!-- field wrapper end --> 
					</div>							 
				</div>	
				<!-- /row -->

				<!-- row -->
				<div class="row gutters"> 
					<div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">									
						<!-- field wrapper start -->
						<div class="field-wrapper">
							<select class="form-control required fob-select-2" id="bloodgr" name="bloodgr">                                              
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
					<div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">									
						<!-- field wrapper start -->
						<div class="field-wrapper">
							<select class="form-control fob-select-2" id="genotype" name="genotype">
								
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
					<div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12"> 
						<!-- field wrapper start -->
						<div class="field-wrapper"> 
							<input type="text" class="form-control capWords" value ="<?php echo $height; ?>" 
							id="height" name="height" />
							<div class="field-placeholder">Height <span class="text-danger"></span></div> 
						</div>
						<!-- field wrapper end --> 
					</div>	 
					<div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12"> 
						<!-- field wrapper start -->
						<div class="field-wrapper"> 
							<input type="text" class="form-control capWords" value ="<?php echo $weight; ?>" 
							id="weight" name="weight"/>
							<div class="field-placeholder">Weight <span class="text-danger"></span></div> 
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
							<select class="form-control fob-select-2" id="hostel" name="hostel">  
								<option value = "">Search . . .</option> 
								<?php
									
									try{

										$hostelDataArr = fobrainHostelData($conn);  /* school hostel array */
										$hostelDataCount = count($hostelDataArr);
										
									}catch(PDOException $e) {
			
										fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
				
									}
			
									for($i = $fiVal; $i <= $hostelDataCount; $i++){  /* loop array */
										
										$hID = $hostelDataArr[$i]["h_id"];
										$hostel = $hostelDataArr[$i]["hostel"]; 
										
										if ($hID == $hostelID){
											$selected = "SELECTED";
										}else{
											$selected = "";
										} 
										
										echo '<option value="'.$hID.'"'.$selected.'>'.$hostel.'</option>' ."\r\n";
									}

								?> 
								
							</select>
							<div class="field-placeholder">School Hostel <span class="text-info"></span></div> 
						</div>
						<!-- field wrapper end -->
					</div>									 
				 
						
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">										
						<!-- field wrapper start -->
						<div class="field-wrapper">
							<select class="form-control fob-select-2"  id="route" name="route">
								
								<option value = "">Search . . .</option>

								<?php
									
									try{

										$routeDataArr = fobrainRouteData($conn);  /* school route array */
										$routeDataCount = count($routeDataArr);
										
									}catch(PDOException $e) {
			
										fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
				
									}
			
									for($i = $fiVal; $i <= $routeDataCount; $i++){  /* loop array */
										
										$rID = $routeDataArr[$i]["r_id"];
										$route = $routeDataArr[$i]["route"]; 
										
										if ($rID == $routeID){
											$selected = "SELECTED";
										}else{
											$selected = "";
										} 
										
										echo '<option value="'.$rID.'"'.$selected.'>'.$route.'</option>' ."\r\n";

									}

								?>

								
							</select>
							<div class="field-placeholder">School Route <span class="text-info"></span></div> 
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
				<h4>Contact  Information : <span>Step 2 - 3</span></h4>
				<div style="clear:both;"></div>						
				
				<!-- row -->
				<div class="row gutters">
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">										
						<!-- field wrapper start -->
						<div class="field-wrapper">
							<select class="form-control required fob-select-2"  id="country" name="country"> 
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
							<div class="field-placeholder">Country/Nationality <span class="text-danger">*</span></div> 
						</div>
						<!-- field wrapper end -->
					</div>
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">										
						<!-- field wrapper start -->
						<div class="field-wrapper">
							<input type="text" class="form-control required capWords" value ="<?php echo $state; ?>" 
							id="state"  name="state" />
							<div class="field-placeholder">State / District <span class="text-danger">*</span></div> 
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
							<input type="text" class="form-control required capWords" value ="<?php echo $city; ?>" 
							id="city" name="city" />
							<div class="field-placeholder">City <span class="text-danger">*</span></div> 
						</div>
						<!-- field wrapper end -->
					</div>
					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">										
						<!-- field wrapper start -->
						<div class="field-wrapper">
							<input placeholder="e.g. +2348030716751" type="tel" 
								class="form-control required capWords" value ="<?php echo $studphone; ?>" name="studphone" id="studphone" />
							<div class="field-placeholder">Phone No. <span class="text-danger">*</span></div> 
						</div>
						<!-- field wrapper end -->
					</div>		
					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">										
						<!-- field wrapper start -->
						<div class="field-wrapper">
							<input type="email" class="form-control required lowWords" value ="<?php echo $email; ?>" 
							id="email" name="email" placeholder="igweze@gmail.com" />
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
							<textarea rows="3" cols="10" class="form-control required capWords" id="add1" name="add1"
							placeholder="Enter Current Address"><?php echo $add1; ?></textarea>
							<div class="field-placeholder">Current Address <span class="text-danger">*</span></div> 
						</div>
						<!-- field wrapper end -->
					</div> 
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">										
						<!-- field wrapper start -->
						<div class="field-wrapper"> 
							<textarea rows="3" cols="10" class="form-control required capWords" id="add2" name="add2"
							placeholder="Enter Parmanent Address"><?php echo $add2; ?></textarea>
							<div class="field-placeholder"> Parmanent Address <span class="text-danger">*</span></div> 
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
				<div style="clear:both;"></div>					
				<?php 
					if(($admin_grade == $admin_fobrain_grd) && ($admin_level == $admin_tagged)){ 
						$disabled = "";
					}else{ 
						$disabled = "disabled"; 
					}  
				?>

				<!-- row -->
				<div class="row gutters">  
					<div class="col-12">									
						<!-- field wrapper start -->
						<div class="field-wrapper">
							<select <?php echo $disabled; ?> class="form-control" id="sibling" name="sibling[]"  multiple placeholder="Select Siblings..." autocomplete="off"> 
								<option value = "">Search . . .</option> 
								
								<?php  
									try{
											
										$student_arr = activeStudent($conn);  /* active students */

										if(is_array($sibling)){  /* check is student is empty */	  
										
											echo studentSelectBox($conn, $student_arr, $sibling, true);  
										
										}else{

											echo studentSelectBox($conn, $student_arr, "none", false);  

										}	 
										
									}catch(PDOException $e) {				
										fobrainDie( 'Ooops Database Error: ' . $e->getMessage());													
									}	
								?>
							</select>
							<div class="field-placeholder">Link Sibling <span class="text-danger"></span></div> 
							<div class="form-text text-danger fw-500">
								This link sibling together for easy parent management. Max allow is 10 children.
							</div>
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
							<input type="text" class="form-control required capWords" value ="<?php echo $sponsor; ?>" 
							id="sponsor" name="sponsor" />
							<div class="field-placeholder">Father Name <span class="text-danger">*</span></div> 
						</div>
						<!-- field wrapper end -->
					</div>
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">										
						<!-- field wrapper start -->
						<div class="field-wrapper">
							<input type="text" class="form-control required capWords" value ="<?php echo $sponphone; ?>" 
							id="sponphone"  name="sponphone" placeholder="e.g. +2348030716751" />
							<div class="field-placeholder">Phone No. <span class="text-danger">*</span></div> 
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
							<input type="text" class="form-control required capWords" value ="<?php echo $soccup; ?>" 
								id="soccup" name="soccup"   />
							<div class="field-placeholder"> Occupation <span class="text-danger">*</span></div>
								
						</div>
						<!-- field wrapper end -->
					</div>
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">										
						<!-- field wrapper start -->
						<div class="field-wrapper">
							<input type="text" class="form-control required capWords" value ="<?php echo $sponadd; ?>" 
								id="sponadd" name="sponadd" />
							<div class="field-placeholder">Address <span class="text-danger">*</span></div> 
						</div>
						<!-- field wrapper end -->
					</div>
														
				</div>	
				<!-- /row -->	 
				<hr class="text-danger " />
				<!-- row -->
				<div class="row gutters">
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">										
						<!-- field wrapper start -->
						<div class="field-wrapper">
							<input type="text" class="form-control capWords" value ="<?php echo $sponsor2; ?>" 
							id="sponsor2" name="sponsor2"   />
							<div class="field-placeholder">Mother Name <span class="text-danger">*</span></div>
								
						</div>
						<!-- field wrapper end -->
					</div>
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">										
						<!-- field wrapper start -->
						<div class="field-wrapper">
							<input type="text" class="form-control capWords" value ="<?php echo $sponphone2; ?>" 
							id="sponphone2"  name="sponphone2" placeholder="e.g. +2348030716751"  />
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
							<input type="text" class="form-control capWords" value ="<?php echo $soccup2; ?>" 
								id="soccup2" name="soccup2"   />
							<div class="field-placeholder"> Occupation <span class="text-danger">*</span></div>
								
						</div>
						<!-- field wrapper end -->
					</div>
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">										
						<!-- field wrapper start -->
						<div class="field-wrapper">
							<input type="text" class="form-control capWords" value ="<?php echo $sponadd2; ?>" 
								id="sponadd2" name="sponadd2"   />
							<div class="field-placeholder">Address <span class="text-danger">*</span></div>
							<input type='hidden' value = "<?php echo $regNum; ?>" name="regNum" />
							<input type="hidden" name="profile" value="save" />
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
					<button type="submit" class="btn btn-submit btn-success"  id="saveStudentBio">
						<i class="mdi mdi-content-save label-icon"></i>
						Save
					</button> 
				</div> 
				 			
				 
			</fieldset>
			<!-- form step 3 -->
			
			<!-- form step 4 -- >
			<fieldset>
				<!- - progress bar -- >
				<div class="progress">
					<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
					</div>
				</div>
				<!- - progress bar -- >
				<h4>Guardian Information: <span>Step 4 - 4</span></h4>
				<div style="clear:both;"></div>

				<div class="form-wizard-buttons">
					<button type="button" class="btn btn-previous">Previous</button>
					<button type="submit" class="btn btn-submit">Submit</button>
				</div>
				 
			</fieldset>
			<!-- form step 4 -->
		
		</form>  


		<?php if(($admin_grade == $admin_fobrain_grd) && ($admin_level == $admin_tagged)){   ?>

		<!-- row -->
		<div class="row gutters row-section fobrain-section-div justify-content-center">
			<div class="col-12">
				<div  id="accordion" id="fob-accordion">
					<div class="accordion-item">
						<div class="accordion-header">
							<h4 class="accordion-title">
								<a class="accordion-button" role="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
									Student Class
								</a>
							</h4>
						</div>
						<div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#fob-accordion"> 	
							<div class="accordion-body">
								
						<!-- form -->
						<form class="form-horizontal" id="frmsaveBioClass" role="form" AUTOCOMPLETE=OFF> 
							<?php 	  
								$msg_i = ''; 
							?>	
							<div class="row gutters mb-15 mt-10 justify-content-center">
								<div class="hints col-lg-10">
									[<i class="mdi mdi-help-circle-outline"></i>] 
									Note: Student Should be move to another class at the end of each session.
								</div>
							</div>
							<div class="row gutters">  
								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">	
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<select class="form-control required fob-select-2"  id="class_fi" name="class_fi">                                              
											<option value = "">Search . . .</option>
											<?php
												classSelectBox($classArray_fi, $class_list, $fiClass);							 
											?>												
										</select>											
										<div class="field-placeholder"> <?php echo $levelArray[0]['level']; ?> <span class="text-danger">*</span></div> 
									</div>
									<!-- field wrapper end -->		 
								</div>

								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">	
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<select class="form-control required fob-select-2"  id="class_se" name="class_se">                                              
											<option value = "">Search . . .</option>
											<?php
												classSelectBox($classArray_se, $class_list, $seClass);							 
											?>												
										</select>											
										<div class="field-placeholder"> <?php echo $levelArray[1]['level']; ?> <span class="text-danger">*</span></div> 
									</div>
									<!-- field wrapper end -->		 
								</div>

								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">	
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<select class="form-control required fob-select-2"  id="class_th" name="class_th">                                              
											<option value = "">Search . . .</option>
											<?php
												classSelectBox($classArray_th, $class_list, $thClass);							 
											?>												
										</select>											
										<div class="field-placeholder"> <?php echo $levelArray[2]['level']; ?> <span class="text-danger">*</span></div> 
									</div>
									<!-- field wrapper end -->		 
								</div>

								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">	
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<select class="form-control required fob-select-2"  id="class_fo" name="class_fo">                                              
											<option value = "">Search . . .</option>
											<?php
												classSelectBox($classArray_fo, $class_list, $foClass);							 
											?>												
										</select>											
										<div class="field-placeholder"> <?php echo $levelArray[3]['level']; ?> <span class="text-danger">*</span></div> 
									</div>
									<!-- field wrapper end -->		 
								</div>

								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">	
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<select class="form-control required fob-select-2"  id="class_fif" name="class_fif">                                              
											<option value = "">Search . . .</option>
											<?php
												classSelectBox($classArray_fif, $class_list, $fifClass);							 
											?>												
										</select>											
										<div class="field-placeholder"> <?php echo $levelArray[4]['level']; ?> <span class="text-danger">*</span></div> 
									</div>
									<!-- field wrapper end -->		 
								</div>

								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">	
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<select class="form-control required fob-select-2"  id="class_six" name="class_six">                                              
											<option value = "">Search . . .</option>
											<?php
												classSelectBox($classArray_six, $class_list, $sixClass);							 
											?>												
										</select>											
										<div class="field-placeholder"> <?php echo $levelArray[5]['level']; ?> <span class="text-danger">*</span></div> 
									</div>
									<!-- field wrapper end -->		 
								</div>

								<div class="col-12 text-end  mt-30">
									<input type='hidden' value = "<?php echo $regNum; ?>" name="regNum" />
									<input type="hidden" name="profile" value="class" />
															
									<button type="submit" class="btn btn-primary waves-effect   
									btn-label waves-light" id="saveBioClass">
										<i class="mdi mdi-content-save label-icon"></i>  Save
									</button>
								</div>
								
							</div>	
							<!-- /row --> 
							</form>
							<!-- / form -->   
							</div>
						</div>
					</div>

					<div class="accordion-item">
						<div class="accordion-header">
							<h4 class="accordion-title">
								<a class="accordion-button collapsed" role="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
									Demote/Promote a Student
								</a>
							</h4>
						</div>
						<div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#fob-accordion">
							<div class="accordion-body"> 
								<!-- form -->
								<form class="form-horizontal" id="frmmoveSession" role="form" AUTOCOMPLETE=OFF>  
									<div class="row gutters mb-15 mt-10 justify-content-center">
										<div class="hints col-lg-10">
											[<i class="mdi mdi-help-circle-outline"></i>] 
											Note: This will either promote or demote a student to a new Session Level
										</div>
									</div>
									<div class="row gutters justify-content-center">
										<div class="col-8">										
											<!-- field wrapper start -->
											<div class="field-wrapper">                                         
												<select class="form-control fob-select-2"  id="sessionQ" name="session">
											
												<option value = "">Search . . .</option>
												<?php 
													try {
														
															schoolSessionL($conn); /* school session  */
												
														}catch(PDOException $e) {

														fobrainDie( 'Ooops Database Error: ' . $e->getMessage());

														} 
												?>
											
												</select>
												<div class="field-placeholder"> Level <span class="text-danger">*</span></div>
												<div class="form-text text-danger fw-500">
													 
												</div>
											</div>
											<!-- field wrapper end --> 
										</div>									 
									</div>	
									<!-- /row -->

									<!-- row -->
									<div class="row gutters"> 
										<div class="col-12 text-end  mt-10">
											<input type='hidden' value = "<?php echo $regNum; ?>" name="regNum" />
											<input type="hidden" name="profile" value="move" />
																	
											<button type="submit" class="btn btn-primary waves-effect   
											btn-label waves-light" id="moveSession">
												<i class="mdi mdi-content-save label-icon"></i>  Save
											</button>
										</div>
									
									</div>	
									<!-- /row --> 
								</form>
								<!-- / form -->  
							</div>
						</div>
					</div>
					<!--			
					<div class="accordion-item">
						<div class="accordion-header">
							<h4 class="accordion-title">
								<a class="accordion-button collapsed" role="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
									Section 3
								</a>
							</h4>
						</div>
						<div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#fob-accordion">
							<div class="accordion-body">
								 
							</div>
						</div>
					</div> 
					-->
				</div>
			</div>
		</div>		

		<?php }  ?>		 

	</div>
	<!-- form wizard --> 
	
	<script type="text/javascript" src="<?php echo $fobrainTemplate; ?>/js/wizard-form.js"></script>

	<script type="text/javascript">	  

		$(function() {
			$('input[name="dob"]').daterangepicker({ 
				
				"singleDatePicker": true,
				"timePicker": true,
				"autoApply": true,
				"drops": "auto",
				"minYear": 1920,
				"maxYear": parseInt(moment().format('YYYY'),10),
				"locale": {
					format: 'YYYY-MM-DD'
				},
				"showDropdowns": true, 
			});
		});

		renderSelectImg("#sibling", 10);

		$('.fob-select-2').each(function() {  
			renderSelect($('#'+this.id)); 
		});  

		hidePageLoader(); 
		
	</script>