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
		 
				
				$reg = strip_tags($_REQUEST['reg']);

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
								i_country, i_state, i_lga, i_city, i_add_fi, i_add_se, i_stu_phone, i_email,
								i_sponsor, i_spo_phone, i_spo_add,
								genotype, bloodgp, hostel, route, disability

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
						$dateofbirth = $row['i_dob'];
						$country = $row['i_country']; 
						$state = $row['i_state'];
						$lga = $row['i_lga'];
						$city = $row['i_city'];
						$add1 = $row['i_add_fi'];
						$add2 = $row['i_add_se'];
						$studphone = $row['i_stu_phone'];
						$email = $row['i_email'];
						$sponsor = $row['i_sponsor'];
						$sponphone = $row['i_spo_phone'];
						$sponadd = $row['i_spo_add'];
						$bloodGP = $row['bloodgp'];
						$genoTP = $row['genotype'];
						$hostelID = $row['hostel'];
						$routeID = $row['route'];
						$disability = $row['disability'];
					}	

					if (is_null($pic)){
			
						$student_img = $wiz_default_img; 

					}else{
			
						$student_img = $school_pic_dir.$session_fi.'_'.$session_se.'/'.$pic;

					}

					if ((is_null($pic)) || !file_exists($student_img)){ $student_img = $wiz_default_img; }  /* check if picture exists */
					
					 		 

	  				$levelArray = studentLevelsArray($conn); /* student level array */
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
						
				
				}else{  /* display error */ 
		
						$msg_e =  "Student's record with <span>$reg </span> was not found.";						  
						echo $errorMsg.$msg_e.$eEnd; echo "<script type='text/javascript'> hidePageLoader();	</script>";	 echo $scroll_up; exit; 			
										  
				}
				
				
			}catch(PDOException $e) {
				
						fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
				 
			}
		
		
		
?>		

		<div class="card"> 			
			<div class="card-body">
				<!-- Nav tabs -->
				<ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" data-bs-toggle="tab" href="#step1" role="tab">
							<span class="d-block d-sm-none"><i class="mdi mdi-file-upload-outline"></i></span>
							<span class="d-none d-sm-block">Step 1</span> 
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-bs-toggle="tab" href="#step2" role="tab">
							<span class="d-block d-sm-none"><i class="mdi mdi-account-edit"></i></span>
							<span class="d-none d-sm-block">Step 2</span> 
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-bs-toggle="tab" href="#step3" role="tab">
							<span class="d-block d-sm-none"><i class="mdi mdi-map-marker-radius-outline"></i></span>
							<span class="d-none d-sm-block">Step 3</span>   
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-bs-toggle="tab" href="#step4" role="tab">
							<span class="d-block d-sm-none"><i class="mdi mdi-account-child-outline"></i></span>
							<span class="d-none d-sm-block">Step 4</span>    
						</a>
					</li>
					<?php if(($admin_grade == $admin_fobrain_grd) && ($admin_level == $admin_tagged)) {  /* check if school admin */ ?>
					<li class="nav-item">
						<a class="nav-link" data-bs-toggle="tab" href="#step5" role="tab">
							<span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
							<span class="d-none d-sm-block">Step 5</span>    
						</a>
					</li>
					<?php }?>
				</ul>

				<!-- Tab panes -->
				<div class="tab-content text-muted tab-content-border">
					<div class="tab-pane active my-20" id="step1" role="tabpanel">
						<h4 class="profile-heading mb-20"> Upload  Picture - <?php echo $regNum; ?></h4>
						<div class="msgBoxPic"></div>	
						<div id = 'editBioPic'>
							<!-- form -->
							<form method="POST" id = "frmBioPic"  enctype="multipart/form-data" action='bio-manager.php'>
								<!-- row -->
								<div class="row gutters justify-content-center">
									<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12  text-center">										 
										<div class="picture-div mb-20">
											<img src="<?php echo $student_img; ?>" id="preview-picture" alt="student picture" class="img-h-160 rounded img-thumbnail" />
										</div>
										<!-- field wrapper start -->
										<div class="field-wrapper">
											<input type="file" name="uploadPic" id="uploadStudentPic" class="form-control ps-15">
											<div class="field-placeholder"> Profile Picture <span class="text-danger">*</span></div>
											<div class="form-text">
												<input type='hidden' value = "<?php echo $regNum; ?>" name="regNum" />
												<input type="hidden" name="profileData" value="studentPic" />
												Only max image size of 2MB &amp; format of <?php echo $allowedPicExt; ?> are allowed.
											</div>
										</div>
										<!-- field wrapper end -->
									</div> 
								</div>	
								<!-- /row --> 
							</form>
							<!-- / form -->
						</div>
					</div>
					<div class="tab-pane my-20" id="step2" role="tabpanel">
						<h4 class="profile-heading mb-20"> Student Bio - <?php echo $regNum; ?></h4>
						<div class="msgBox1"></div>	
						<div id = 'editBio2'>						
							<!-- form -->
							<form class="form-horizontal" id="frmBioData1">
								<!-- row -->
								<div class="row gutters">
									<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">										
										<!-- field wrapper start -->
										<div class="field-wrapper">
											<input type="text" class="form-control capWords" value ="<?php echo $lname; ?>" 
											id="lname" name="lname"/>
											<div class="field-placeholder">Last Name <span class="text-danger">*</span></div> 
										</div>
										<!-- field wrapper end -->
									</div>
									<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">										
										<!-- field wrapper start -->
										<div class="field-wrapper">
											<input type="text" class="form-control capWords" value ="<?php echo $fname; ?>" 
                                              id="fname" name="fname" />
											<div class="field-placeholder">First Name <span class="text-danger">*</span></div> 
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
											<input type="text" class="form-control capWords" value ="<?php echo $mname; ?>" 
											id="mname" name="mname"  />
											<div class="field-placeholder">Middle Name <span class="text-danger">*</span></div> 
										</div>
										<!-- field wrapper end -->
									</div>
									<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">										
										<!-- field wrapper start -->
										<div class="field-wrapper">
											<select class="form-control"  id="sex" name="sex" required>                                              
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
								</div>	
								<!-- /row -->
								
								<!-- row -->
								<div class="row gutters">
									<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">										
										<!-- field wrapper start -->
										<div class="field-wrapper">
											<input type="date"  value="<?php echo $dateofbirth; ?>" 
                                            size="10" class="form-control" name="dob" />
											<div class="field-placeholder">Date of Birth <span class="text-danger">*</span></div> 
										</div>
										<!-- field wrapper end -->
									</div>
									<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">										
										<!-- field wrapper start -->
										<div class="field-wrapper">
											<select class="form-control" id="bloodgr" name="bloodgr" require>                                              
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
								</div>	
								<!-- /row -->
									 
								<!-- row -->
								<div class="row gutters">
									<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">										
										<!-- field wrapper start -->
										<div class="field-wrapper">
											<select class="form-control" id="genotype" name="genotype" require>
                                              
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
											<div class="field-placeholder">Genotype <span class="text-danger">*</span></div> 
										</div>
										<!-- field wrapper end -->
									</div>
									 							 
								</div>	
								<!-- /row -->	
								
								<!-- row -->
								<div class="row gutters mt-20">
									<div class="col-12 text-end">
										<input type='hidden' value = "<?php echo $regNum; ?>" name="regNum" />
										<input type="hidden" name="profileData" value="saveStudentS1" />
										<button type="submit" class="btn btn-primary" id="saveStudentS1">Save</button>
									</div>
								</div>	
								<!-- /row -->								  
							</form>
							<!-- / form -->						
						</div>
					</div>
					<div class="tab-pane my-20" id="step3" role="tabpanel">
						<h4 class="profile-heading mb-20"> Student Bio 2 - <?php echo $regNum; ?></h4>
						<div class="msgBox2"></div>	
						<div id = 'editBio3'>

							<!-- form -->
							<form class="form-horizontal" id="frmBioData2">	
								<!-- row -->
								<div class="row gutters">
									<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">										
										<!-- field wrapper start -->
										<div class="field-wrapper">
											<select class="form-control"  id="country" name="country" required>
                                              
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
											<input type="text" class="form-control capWords" value ="<?php echo $state; ?>" 
											id="state"  name="state" />
											<div class="field-placeholder">State / District <span class="text-danger">*</span></div> 
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
											<input type="text" class="form-control capWords" value ="<?php echo $city; ?>" 
											id="city" name="city" />
											<div class="field-placeholder">City <span class="text-danger">*</span></div> 
										</div>
										<!-- field wrapper end -->
									</div>
									<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">										
										<!-- field wrapper start -->
										<div class="field-wrapper">
											<input placeholder="e.g. +2348030716751" type="tel" 
                                             class="form-control capWords" value ="<?php echo $studphone; ?>" id="studphone" >
											<div class="field-placeholder">Phone No. <span class="text-danger">*</span></div> 
										</div>
										<!-- field wrapper end -->
									</div>									 
								</div>	
								<!-- /row -->

								<!-- row -->
								<div class="row gutters">
									<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">										
										<!-- field wrapper start -->
										<div class="field-wrapper">
											<input type="text" class="form-control capWords" 
											value ="<?php echo $add1; ?>" id="add1" name="add1" />
											<div class="field-placeholder"> Address <span class="text-danger">*</span></div> 
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
											<input type="email" class="form-control lowWords" value ="<?php echo $email; ?>" 
											id="email" name="email" placeholder="igweze@gmail.com" />
											<div class="field-placeholder"> Email <span class="text-danger">*</span></div> 
										</div>
										<!-- field wrapper end -->
									</div>
									<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">										
										<!-- field wrapper start -->
										<div class="field-wrapper">
											<select class="form-control"  id="hostel" name="hostel">
                                              
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
											<div class="field-placeholder">School Hostel <span class="text-info">Optional</span></div> 
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
											<select class="form-control"  id="route" name="route">
                                              
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
											<div class="field-placeholder">School Route <span class="text-info">Optional</span></div> 
										</div>
										<!-- field wrapper end -->
									</div>									 
								</div>	
								<!-- /row -->
								
								<!-- row -->
								<div class="row gutters mt-20">
									<div class="col-12 text-end">
										<input type='hidden' value = "<?php echo $regNum; ?>" name="regNum" />
										<input type="hidden" name="profileData" value="saveStudentS2" />
										<button type="submit" class="btn btn-primary" id="saveStudentS2">Save</button>
									</div>
								</div>	
								<!-- /row -->									
							</form>
							<!-- / form -->	
						</div>
					</div>
					<div class="tab-pane my-20" id="step4" role="tabpanel">
						<h4 class="profile-heading mb-20">  Sponsor Data  - <?php echo $regNum; ?></h4>
						<div class="msgBox3"></div>	
						<div id = 'editBio4'>


							<!-- form -->
							<form class="form-horizontal" id="frmBioData3">	
								<!-- row -->
								<div class="row gutters">
									<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">										
										<!-- field wrapper start -->
										<div class="field-wrapper">
											<input type="text" class="form-control capWords" value ="<?php echo $sponsor; ?>" 
                                            id="sponsor" name="sponsor" />
											<div class="field-placeholder">Parent Name <span class="text-danger">*</span></div> 
										</div>
										<!-- field wrapper end -->
									</div>
									<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">										
										<!-- field wrapper start -->
										<div class="field-wrapper">
											<input type="text" class="form-control capWords" value ="<?php echo $sponphone; ?>" 
                                            id="sponphone"  name="sponphone" placeholder="e.g. +2348030716751" required />
											<div class="field-placeholder">Parent Phone No. <span class="text-danger">*</span></div> 
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
											<input type="text" class="form-control capWords" value ="<?php echo $sponadd; ?>" 
                                              id="sponadd" name="sponadd" />
											<div class="field-placeholder">Parent Address <span class="text-danger">*</span></div> 
										</div>
										<!-- field wrapper end -->
									</div>
									 								 
								</div>	
								<!-- /row -->								
								
								<!-- row -->
								<div class="row gutters mt-20">
									<div class="col-12 text-end">
										<input type='hidden' value = "<?php echo $regNum; ?>" name="regNum" />
										<input type="hidden" name="profileData" value="sponsorData" />
										<button type="submit" class="btn btn-primary" id="sponsorData">Save</button>
									</div>
								</div>	
								<!-- /row -->									
							</form>
							<!-- / form -->							
						
						</div>
					</div>
					<?php if(($admin_grade == $admin_fobrain_grd) && ($admin_level == $admin_tagged)) {  /* check if school admin */ ?> 
					<div class="tab-pane my-20" id="step5" role="tabpanel">
						<h4 class="profile-heading mb-20"> Class Manager - <?php echo $regNum; ?></h4>
						<?php
						  
							$msg_i = 'Note: Student Should be move to another class at the end of each session';
							echo $infMsg.$msg_i.$msgEnd;						  
						  
						?>
						<div class="msgBoxClass"></div>	
						<div id = 'editBioPic5'> 

							<!-- form -->
							<form class="form-horizontal" id="frmBioData2">	
								<!-- row -->
								<div class="row gutters">
									<div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
										<!-- field wrapper start -->
										<div class="field-wrapper">
											<select class="form-control"  id="class_fi" name="class_fi">
                                              
                                				<option value = "">No Class</option>

												<?php

													foreach($classArray_fi as $class_fi){  /* loop array */

														if ($fiClass == $class_fi){
															$selected = "SELECTED";
														} else {
															$selected = "";
														}

														echo '<option value="'.$class_fi.'"'.$selected.'>'.$class_fi.'</option>' ."\r\n";

													}

												?>
                                              
                                            </select>
											<div class="field-placeholder"><?php echo $levelArray[0]['level']; ?> <span class="text-danger">*</span></div> 
										</div>
										<!-- field wrapper end -->
									</div>
									<div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
										<!-- field wrapper start -->
										<div class="field-wrapper">
											<select class="form-control"  id="class_se" name="class_se">
                                              
                                				<option value = "">No Class</option>

												<?php

													foreach($classArray_se as $class_se){  /* loop array */

														if ($seClass == $class_se){
															$selected = "SELECTED";
														} else {
															$selected = "";
														}

														echo '<option value="'.$class_se.'"'.$selected.'>'.$class_se.'</option>' ."\r\n";

													}

												?>
                                              
                                            </select>
											<div class="field-placeholder"><?php echo $levelArray[1]['level']; ?><span class="text-danger">*</span></div> 
										</div>
										<!-- field wrapper end -->
									</div>									 
									<div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">										
										<!-- field wrapper start -->
										<div class="field-wrapper">
											<select class="form-control"  id="class_th" name="class_th">
                                              
                                				<option value = "">No Class</option>

												<?php

													foreach($classArray_th as $class_th){  /* loop array */

														if ($thClass == $class_th){
															$selected = "SELECTED";
														} else {
															$selected = "";
														}

														echo '<option value="'.$class_th.'"'.$selected.'>'.$class_th.'</option>' ."\r\n";

													}

												?>
                                              
                                              </select>
											<div class="field-placeholder"><?php echo $levelArray[2]['level']; ?><span class="text-danger">*</span></div> 
										</div>
										<!-- field wrapper end -->
									</div>									 									
								</div>	
								<!-- /row -->								
								
								<?php if($schoolExt != $fobrainNurAbr){  /* check if school is not nursery */?>\
								

								<!-- row -->
								<div class="row gutters">
									<div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
										<!-- field wrapper start -->
										<div class="field-wrapper">
											<select class="form-control"  id="class_fo" name="class_fo">
                                              
                                				<option value = "">No Class</option>

												<?php

													foreach($classArray_fo as $class_fo){  /* loop array */

														if ($foClass == $class_fo){
															$selected = "SELECTED";
														} else {
															$selected = "";
														}

														echo '<option value="'.$class_fo.'"'.$selected.'>'.$class_fo.'</option>' ."\r\n";

													}

												?>
                                              
                                            </select>
											<div class="field-placeholder"><?php echo $levelArray[3]['level']; ?> <span class="text-danger">*</span></div> 
										</div>
										<!-- field wrapper end -->
									</div>
									<div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
										<!-- field wrapper start -->
										<div class="field-wrapper">
											<select class="form-control"  id="class_fif" name="class_fif">
                                              
                                				<option value = "">No Class</option>

												<?php

												foreach($classArray_fif as $class_fif){  /* loop array */

													if ($fifClass == $class_fif){
														$selected = "SELECTED";
													} else {
														$selected = "";
													}

													echo '<option value="'.$class_fif.'"'.$selected.'>'.$class_fif.'</option>' ."\r\n";

												}

												?>
                                              
                                            </select>
											<div class="field-placeholder"><?php echo $levelArray[4]['level']; ?><span class="text-danger">*</span></div> 
										</div>
										<!-- field wrapper end -->
									</div>									 
									<div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">										
										<!-- field wrapper start -->
										<div class="field-wrapper">
											<select class="form-control"  id="class_six" name="class_six">
                                              
                                				<option value = "">No Class</option>

												<?php

												foreach($classArray_six as $class_six){  /* loop array */

													if ($sixClass == $class_six){
														$selected = "SELECTED";
													} else {
														$selected = "";
													}

													echo '<option value="'.$class_six.'"'.$selected.'>'.$class_six.'</option>' ."\r\n";

												}

												?>
                                              
                                            </select>
											<div class="field-placeholder"><?php echo $levelArray[5]['level']; ?><span class="text-danger">*</span></div> 
										</div>
										<!-- field wrapper end -->
									</div>									 									
								</div>	
								<!-- /row -->
								
								<?php } ?>									
                                           
								<!-- row -->
								<div class="row gutters mt-20">
									<div class="col-12 text-end">
										<input type='hidden' value = "<?php echo $regNum; ?>" name="regNum" />
										<input type="hidden" name="profileData" value="classSettings" />
										<button type="submit" class="btn btn-primary" id="saveBioClass">Save</button>
									</div>
								</div>	
								<!-- /row -->									
							</form>
							<!-- / form -->							
						
						</div>
					</div>
					<?php }?>
				</div>
			</div><!-- end card-body -->
		</div><!-- end card -->		
		
		

		<script type='text/javascript'>  hidePageLoader(); </script>