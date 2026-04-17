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
	This page load staff profile form
	------------------------------------------------------------------------*/  

if(!session_id()){
    session_start();
}

		if (!defined('fobrain')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
				
		require_once $fobrainIconPage; /* This include top middle global icon page eg go back, print buttons etcs */ 
		 
		try { 
			
			$staff_id = strip_tags($_REQUEST['teacherID']);
			
			/* select information */ 
			
			$ebele_mark = "SELECT t_id, i_title, i_picture, i_sign, i_firstname, i_lastname, i_midname, i_gender, i_dob,  
							i_country, i_state, i_lga, i_city, i_add_fi, i_add_se, i_phone, i_email, i_sponsor, 
							i_spo_phone, i_spo_add, genotype, bloodgp, i_mar_status, 
							school, d_appoint, app_type, qualif, w_exper, e_note, salary, taxid, bank, swift, accname, 
							accnum, sponocc, relatn, sponsor2, sponphone2, sponocc2, sponadd2, relatn2, natid, appl, 
							doc_1, doc_2, doc_3, l_login
							

						FROM $staffTB

						WHERE t_id = :t_id";
					
			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue(':t_id', $staff_id);				 
			$igweze_prep->execute();
			
			$rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count == $foreal) {  /* check array is empty */
			
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {  /* loop array */		
	
					$staff_id = $row['t_id'];
					$pic = $row['i_picture'];
					$signPic = $row['i_sign'];
					$titleVal = $row['i_title'];
					$fname = $row['i_firstname'];
					$lname = $row['i_lastname'];
					$mname = $row['i_midname'];
					$sex = $row['i_gender'];
					$marital = $row['i_mar_status'];
					$dob = $row['i_dob'];
					$country = $row['i_country']; 
					$state = $row['i_state'];
					$lga = $row['i_lga'];
					$city = $row['i_city'];
					$add1 = $row['i_add_fi'];
					$add2 = $row['i_add_se'];
					$i_phone = $row['i_phone'];
					$email = $row['i_email'];
					$sponsor = $row['i_sponsor'];
					$sponphone = $row['i_spo_phone'];
					$sponadd = $row['i_spo_add'];
					$school = $row['school']; 
					$d_appoint = $row['d_appoint'];  
					$app_type = $row['app_type'];  
					$qualif = $row['qualif'];  
					$w_exper = $row['w_exper'];  
					$e_note = $row['e_note'];  
					$salary = $row['salary'];  
					$taxid = $row['taxid'];  
					$bank = $row['bank'];  
					$swift = $row['swift'];  
					$accname = $row['accname'];  
					$accnum = $row['accnum'];  
					$sponocc = $row['sponocc'];
					$relatn = $row['relatn'];  
					$sponsor2 = $row['sponsor2'];  
					$sponphone2 = $row['sponphone2'];  
					$sponocc2 = $row['sponocc2'];  
					$sponadd2 = $row['sponadd2'];  
					$relatn2 = $row['relatn2'];  
					$natid = $row['natid'];  
					$appl = $row['appl'];  
					$doc_1 = $row['doc_1'];  
					$doc_2 = $row['doc_2'];  
					$doc_3 = $row['doc_3'];  
					$l_login = $row['l_login'];  
					$bloodGP = $row['bloodgp'];
					$genoTP = $row['genotype'];
					//$staff_grade_v = $row['rank'];
				}	
					
				$staff_img = picture($staff_pic_ext, $pic, "staff");
				$staff_sign = picture($staff_doc_ext, $signPic, "sign");
				$staff_nat = picture($staff_doc_ext, $natid, "doc");
				$staff_appl = picture($staff_doc_ext, $appl, "doc");
				$staff_doc_1 = picture($staff_doc_ext, $doc_1, "doc");
				$staff_doc_2 = picture($staff_doc_ext, $doc_2, "doc");
				$staff_doc_3 = picture($staff_doc_ext, $doc_3, "doc");
			
			}else{  /* display error */ 
			
				$msg_e =  "Staff  record was not found.";								  
				echo $errorMsg.$msg_e.$eEnd; echo "<script type='text/javascript'> hidePageLoader();	</script>";	 echo $scroll_up; exit; 				
												
			}
				
		}catch(PDOException $e) {
				
						fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
					
		} 
?>	
 
  
    <div class="card"> 			
		<div class="card-body">

			<div class="row gutters mb-25 mt-0 justify-content-center">
				<div class="hints col-lg-10 text-danger">
					[<i class="mdi mdi-help-circle-outline"></i>] 
					Only max image size of 2MB &amp; format of <?php echo $allowedPicExt; ?> are allowed.
				</div>
			</div>

			<div class="msg-box-st"></div>	
			<div class="tab" role="tabpanel">
				<!-- Nav tabs --> 
				<ul class="nav nav-tabs nav-tabs-customz nav-justified" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" data-bs-toggle="tab" href="#step1" role="tab">
							<span class="d-block d-sm-none"><i class="mdi mdi-account-edit"></i></span>
							<span class="d-none d-sm-block">Basic</span> 
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-bs-toggle="tab" href="#step2" role="tab">
							<span class="d-block d-sm-none"><i class="mdi mdi-map-marker-radius-outline"></i></span>
							<span class="d-none d-sm-block">Contact</span> 
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-bs-toggle="tab" href="#step3" role="tab">
							<span class="d-block d-sm-none"><i class="mdi mdi-account-cash"></i></span>
							<span class="d-none d-sm-block">Payroll</span>   
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-bs-toggle="tab" href="#step4" role="tab">
							<span class="d-block d-sm-none"><i class="mdi mdi-account-child-outline"></i></span>
							<span class="d-none d-sm-block">Gurantor</span>    
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-bs-toggle="tab" href="#step5" role="tab">
							<span class="d-block d-sm-none"><i class="mdi mdi-cloud-upload-outline"></i></span>
							<span class="d-none d-sm-block">Documents</span>    
						</a>
					</li> 
				</ul>
				 
				<!-- tab panes -->
				<div class="tab-content text-muted tab-content-border"> 

					<div class="tab-pane active  my-20" id="step1" role="tabpanel">

						<h4 class="profile-heading mb-20"> Personal Information </h4>
						
						<div class="msg-box-pic"></div>	  

						<form method="POST" id = "frmStaffPic"  enctype="multipart/form-data">
							<div class="row gutters justify-content-center">  
								<div class="col-lg-6 text-center">	 
									<div class="picture-div mb-10">
										<img src="<?php echo $staff_img; ?>" alt="staff picture" class="staff-picture-comp img-h-150 rounded img-thumbnail" />
									</div>   
									<!-- file-wrapper start -->
									<div class="file-wrapper">
										<label class="upload-img-div fob-btn-div">
											<i class="mdi mdi-cloud-upload-outline fs-24 text-danger"></i> 
											<input type="file" name="uploadPic" id="uploadStaffPic" class="form-control hide">
										</label> 
										<div class="form-text fob-btn-div"> 
											<input type="hidden" value = "<?php echo $staff_id; ?>" name="teacherID" />
											<input type="hidden"   name="upload-staff-img" id="upload-staff-img" /> 
											<input type="hidden" name="profile" value="picture" /> 
										</div>
										<div class="display-none fob-btn-loader">
											<strong role="status">Processing...</strong>
											<div class="spinner-border ms-auto" aria-hidden="true"></div>
										</div> 
									</div>
									<!-- file-wrapper end --> 
								</div>
							
							</div>	
						</form>

						
						<form class="form-horizontal" id="frmStaff1">	

						<div class="row gutters"> 	 
							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">										
								<!-- field wrapper start -->
								<div class="field-wrapper">
									<select class="form-control wiz-select" id="title" name="title" >                                              
										<option value = "">Select One</option>

										<?php

											foreach($title_list as $title => $titleValue){  /* loop array */	

												if ($titleVal == $title){
													$selected = "SELECTED";
												} else {
													$selected = "";
												}

												echo '<option value="'.$title.'"'.$selected.'>'.$titleValue.'</option>' ."\r\n";

											}

										?>
									</select>
									<div class="field-placeholder"> Title <span class="text-danger">*</span></div> 
								</div>
								<!-- field wrapper end -->
							</div>	
							<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">									
								<!-- field wrapper start -->
								<div class="field-wrapper">
									<input type="text" class="form-control capWords" value ="<?php echo $lname; ?>" 
									id="lname" name="lname"/>
									<div class="field-placeholder">Last Name <span class="text-danger">*</span></div> 
								</div>
								<!-- field wrapper end -->
							</div>
						</div>
						<div class="row gutters">
							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">										
								<!-- field wrapper start -->
								<div class="field-wrapper">
									<input type="text" class="form-control capWords" value ="<?php echo $fname; ?>" 
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
									<div class="field-placeholder">Middle Name <span class="text-danger">*</span></div> 
								</div>
								<!-- field wrapper end -->
							</div>
							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">										
								<!-- field wrapper start -->
								<div class="field-wrapper"> 
									<select class="form-control wiz-select" id="mslist" name="mslist" required>
										
										<option value = "">Select One</option>

										<?php

											foreach($mslist as $mslists => $mslistVal){  /* loop array */

												if ($marital == $mslists){
													$selected = "SELECTED";
												} else {
													$selected = "";
												}

												echo '<option value="'.$mslists.'"'.$selected.'>'.$mslistVal.'</option>' ."\r\n";

											}

										?>
									</select>
									<div class="field-placeholder">Maital Status <span class="text-danger">*</span></div> 
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
									<select class="form-control wiz-select" id="school" name="school" required>
										
										<option value = "">Select One</option>

										<?php

											foreach($school_list_2 as $school_S => $schoolVal){  /* loop array */

												if ($school_S == $school){
													$selected = "SELECTED";
												} else {
													$selected = "";
												}

												echo '<option value="'.$school_S.'"'.$selected.'>'.$schoolVal.'</option>' ."\r\n";

											}

										?>
									</select>
									<div class="field-placeholder">School <span class="text-danger"></span></div> 
								</div>
								<!-- field wrapper end -->
							</div>
							
							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">										
								<!-- field wrapper start -->
								<div class="field-wrapper">
									<select class="form-control wiz-select" id="app_type" name="app_type" required>
										
										<option value = "">Select One</option>

										<?php

											foreach($appoint_list as $app_typeW => $app_typeVal){  /* loop array */

												if ($app_type == $app_typeW){
													$selected = "SELECTED";
												} else {
													$selected = "";
												}

												echo '<option value="'.$app_typeW.'"'.$selected.'>'.$app_typeVal.'</option>' ."\r\n";

											}

										?>
									</select>
									<div class="field-placeholder">Appt. Type <span class="text-danger">*</span></div> 
								</div>
								<!-- field wrapper end -->
							</div> 
							
							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">										
								<!-- field wrapper start -->
								<div class="field-wrapper">
									<input type="text"  value="<?php echo $d_appoint; ?>" 
									size="10" class="form-control" name="d_appoint" />
									<div class="field-placeholder">Date of Appoin <span class="text-danger">*</span></div> 
								</div>
								<!-- field wrapper end -->
							</div>
						</div>	
						<!-- /row -->
								
						<!-- row -->
						<div class="row gutters">  
							<div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">										
								<!-- field wrapper start -->
								<div class="field-wrapper">
									<select class="form-control wiz-select"  id="sex" name="sex" required>                                              
										<option value = "">Select One</option>
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
							<div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">	
								<!-- field wrapper start -->
								<div class="field-wrapper">
									<input type="text"  value="<?php echo $dob; ?>" 
									 class="form-control" name="dob" />
									<div class="field-placeholder">DOB <span class="text-danger">*</span></div> 
								</div>
								<!-- field wrapper end -->
							</div>
							<div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">										
								<!-- field wrapper start -->
								<div class="field-wrapper">
									<select class="form-control wiz-select" id="bloodgr" name="bloodgr" required>                                              
										<option value = "">Select One</option>

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
									<div class="field-placeholder">Blood Gr <span class="text-danger">*</span></div> 
								</div>
								<!-- field wrapper end -->
							</div>	 
							<div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">									
								<!-- field wrapper start -->
								<div class="field-wrapper">
									<select class="form-control wiz-select" id="genotype" name="genotype">
										
										<option value = "">Select One</option>

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
						</div>	
						<!-- /row -->	

						<!-- row -->
						<div class="row gutters"> 
							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">									
								<!-- field wrapper start -->
								<div class="field-wrapper">
									<textarea rows="3" cols="10" class="form-control" name="qualif" id="qualif" 
									placeholder="Enter Qualifications"><?php echo $qualif; ?></textarea>
									<div class="field-placeholder">Qualifications<span class="text-danger"></span></div> 
								</div>
								<!-- field wrapper end -->
							</div>					
									
							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">										
								<!-- field wrapper start -->
								<div class="field-wrapper"> 
									<textarea rows="3" cols="10" class="form-control" name="w_exper" id="w_exper"
									placeholder="Enter Qualifications"><?php echo $w_exper; ?></textarea>			
									<div class="field-placeholder">Work Experience <span class="text-danger"> </span></div> 
								</div>
								<!-- field wrapper end -->
							</div> 

							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">										
								<!-- field wrapper start -->
								<div class="field-wrapper"> 
									<textarea rows="3" cols="10" class="form-control" name="e_note" id="e_note"
									placeholder="Enter Qualifications"><?php echo $e_note; ?></textarea>			
									<div class="field-placeholder">Extra Note <span class="text-danger"> </span></div> 
								</div>
								<!-- field wrapper end -->
							</div> 
						</div>	
						<!-- /row -->
						
						<!-- row -->
						<div class="row gutters mt-20">
							<div class="col-12 text-end">
								<input type='hidden' value = "<?php echo $staff_id; ?>" name="teacherID" />
								<input type="hidden" name="profile" value="step1" />
								<button type="submit" class="btn btn-primary" id="saveStaff1">Save</button>
							</div>
						</div>	
						<!-- /row -->								  
					 
						</form>
						<!-- / form --> 						
					
					</div>
					<div class="tab-pane my-20" id="step2" role="tabpanel">
						<h4 class="profile-heading mb-20">Contact Information </h4> 

						<!-- form -->
						<form class="form-horizontal" id="frmStaff2">	
							<!-- row -->
							<div class="row gutters">
								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<select class="form-control wiz-select"  id="country" name="country" required>
											
											<option value = "">Select One</option>

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
										<div class="field-placeholder">Country  <span class="text-danger">*</span></div> 
									</div>
									<!-- field wrapper end -->
								</div>
								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<input type="text" class="form-control capWords" value ="<?php echo $state; ?>" 
										id="state"  name="state" />
										<div class="field-placeholder">State / District <span class="text-danger">*</span></div> 
									</div>
									<!-- field wrapper end -->
								</div> 
								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<input type="text" class="form-control capWords" value ="<?php echo $city; ?>" 
										id="city" name="city" />
										<div class="field-placeholder">City <span class="text-danger">*</span></div> 
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
										<input placeholder="e.g. +2348030716751" type="tel" 
											class="form-control capWords" value ="<?php echo $i_phone; ?>" name="i_phone" id="i_phone" >
										<div class="field-placeholder">Phone No. <span class="text-danger">*</span></div> 
									</div>
									<!-- field wrapper end -->
								</div>	
								
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<input type="email" class="form-control lowWords" disabled value ="<?php echo $email; ?>" 
										id="email" name="email" placeholder="igweze@gmail.com" />
										<div class="field-placeholder"> Email <span class="text-danger">*</span></div> 
									</div>
									<!-- field wrapper end -->
								</div> 
								
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">										
									<!-- field wrapper start -->
									<div class="field-wrapper"> 
										<textarea rows="3" cols="10" class="form-control capWords" id="add1" name="add1"
										placeholder="Enter Current Address"><?php echo $add1; ?></textarea>
										<div class="field-placeholder">Current Address <span class="text-danger">*</span></div> 
									</div>
									<!-- field wrapper end -->
								</div>

								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">										
									<!-- field wrapper start -->
									<div class="field-wrapper"> 
										<textarea rows="3" cols="10" class="form-control capWords" id="add2" name="add2"
										placeholder="Enter Parmanent Address"><?php echo $add2; ?></textarea>
										<div class="field-placeholder"> Parmanent Address <span class="text-danger">*</span></div> 
									</div>
									<!-- field wrapper end -->
								</div>
																	
							</div>	
							<!-- /row -->  
															
							<!-- row -->
							<div class="row gutters mt-20">
								<div class="col-12 text-end">
									<input type='hidden' value = "<?php echo $staff_id; ?>" name="teacherID" />
									<input type="hidden" name="profile" value="step2" />
									<button type="submit" class="btn btn-primary" id="saveStaff2">Save</button>
								</div>
							</div>	
							<!-- /row -->									
						</form>
						<!-- / form -->	
					 
					</div>
					<div class="tab-pane my-20" id="step3" role="tabpanel">

						<h4 class="profile-heading mb-20">Payroll and Bank Information </h4> 

						<!-- form -->
						<form class="form-horizontal" id="frmStaff3">	
							<!-- row -->
							<div class="row gutters">
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<input type="text" class="form-control" value ="<?php echo $salary; ?>" 
										id="salary" name="salary" />
										<div class="field-placeholder">Salary <span class="text-danger">*</span></div> 
									</div>
									<!-- field wrapper end -->
								</div>
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<input type="text" class="form-control" value ="<?php echo $taxid; ?>" 
										id="taxid"  name="taxid"  required />
										<div class="field-placeholder">Tax ID <span class="text-danger">*</span></div> 
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
										<input type="text" class="form-control capWords" value ="<?php echo $bank; ?>" 
											id="bank" name="bank" />
										<div class="field-placeholder">Bank Name <span class="text-danger">*</span></div> 
									</div>
									<!-- field wrapper end -->
								</div>
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<input type="text" class="form-control capWords" value ="<?php echo $swift; ?>" 
											id="swift" name="swift" />
										<div class="field-placeholder">SWIFT Code <span class="text-danger"></span></div> 
									</div>
									<!-- field wrapper end -->
								</div>
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<input type="text" class="form-control capWords" value ="<?php echo $accname; ?>" 
											id="accname" name="accname" />
										<div class="field-placeholder"> Account Name <span class="text-danger">*</span></div> 
									</div>
									<!-- field wrapper end -->
								</div>
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<input type="text" class="form-control capWords" value ="<?php echo $accnum; ?>" 
											id="accnum" name="accnum" />
										<div class="field-placeholder">Bank Account <span class="text-danger">*</span></div> 
									</div>
									<!-- field wrapper end -->
								</div>
																	
							</div>	
							<!-- /row -->								
							
							<!-- row -->
							<div class="row gutters mt-20">
								<div class="col-12 text-end">
									<input type='hidden' value = "<?php echo $staff_id; ?>" name="teacherID" />
									<input type="hidden" name="profile" value="step3" />
									<button type="submit" class="btn btn-primary" id="saveStaff3">Save</button>
								</div>
							</div>	
							<!-- /row -->									
						</form>
						<!-- / form -->							
					
					</div>
					
					
					<div class="tab-pane my-20" id="step4" role="tabpanel">

						<h4 class="profile-heading mb-20"> Staff Gurantors </h4> 
				 
						<!-- form -->
						<form class="form-horizontal" id="frmStaff4">	
							<!-- row -->
							<div class="row gutters">
								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<input type="text" class="form-control capWords" value ="<?php echo $sponsor; ?>" 
										id="sponsor" name="sponsor" />
										<div class="field-placeholder">Gurantor Name <span class="text-danger">*</span></div> 
									</div>
									<!-- field wrapper end -->
								</div>
								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<input type="text" class="form-control capWords" value ="<?php echo $sponphone; ?>" 
										id="sponphone"  name="sponphone" placeholder="e.g. +2348030716751" required />
										<div class="field-placeholder">G. Phone No. <span class="text-danger">*</span></div> 
									</div>
									<!-- field wrapper end -->
								</div>	
								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<input type="text" class="form-control capWords" value ="<?php echo $sponocc; ?>" 
											id="sponocc" name="sponocc" />
										<div class="field-placeholder">G. Occupation <span class="text-danger">*</span></div> 
									</div>
									<!-- field wrapper end -->
								</div>								 
								
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<input type="text" class="form-control capWords" value ="<?php echo $sponadd; ?>" 
											id="sponadd" name="sponadd" />
										<div class="field-placeholder">G. Address <span class="text-danger">*</span></div> 
									</div>
									<!-- field wrapper end -->
								</div>

								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<input type="text" class="form-control capWords" value ="<?php echo $relatn; ?>" 
											id="relatn" name="relatn" />
										<div class="field-placeholder">Relationship <span class="text-danger">*</span></div> 
									</div>
									<!-- field wrapper end -->
								</div>
																	
							</div>	
							<!-- /row -->		
							
							<hr class="mt-30 mb-15 text-danger" />

							<!-- row -->
							<div class="row gutters">
								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<input type="text" class="form-control capWords" value ="<?php echo $sponsor2; ?>" 
										id="sponsor2" name="sponsor2" />
										<div class="field-placeholder">Gurantor Name <span class="text-danger"></span></div> 
									</div>
									<!-- field wrapper end -->
								</div>
								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<input type="text" class="form-control capWords" value ="<?php echo $sponphone2; ?>" 
										id="sponphone2"  name="sponphone2" placeholder="e.g. +2348030716751" />
										<div class="field-placeholder">G. Phone No. <span class="text-danger"></span></div> 
									</div>
									<!-- field wrapper end -->
								</div>	
								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<input type="text" class="form-control capWords" value ="<?php echo $sponocc2; ?>" 
											id="sponocc2" name="sponocc2" />
										<div class="field-placeholder">G. Occupation <span class="text-danger"></span></div> 
									</div>
									<!-- field wrapper end -->
								</div>								 
								
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<input type="text" class="form-control capWords" value ="<?php echo $sponadd2; ?>" 
											id="sponadd2" name="sponadd2" />
										<div class="field-placeholder">G. Address <span class="text-danger"</span></div> 
									</div>
									<!-- field wrapper end -->
								</div>

								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<input type="text" class="form-control capWords" value ="<?php echo $relatn2; ?>" 
											id="relatn2" name="relatn2" />
										<div class="field-placeholder">Relationship <span class="text-danger"></span></div> 
									</div>
									<!-- field wrapper end -->
								</div>
																	
							</div>	
							<!-- /row -->		
							
							<!-- row -->
							<div class="row gutters mt-20">
								<div class="col-12 text-end">
									<input type='hidden' value = "<?php echo $staff_id; ?>" name="teacherID" />
									<input type="hidden" name="profile" value="step4" />
									<button type="submit" class="btn btn-primary" id="saveStaff4">Save</button>
								</div>
							</div>	
							<!-- /row -->									
						</form>
						<!-- / form -->	 

					</div>

					<div class="tab-pane my-20" id="step5" role="tabpanel">

						<h4 class="profile-heading mb-10"> Staff Documents  </h4>  

						<div class="row gutters justify-content-center">
							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-6  text-center mb-20">	
								<div class="picture-div mb-10">
									<img src="<?php echo $staff_sign; ?>" id="preview-picture-1" alt="staff signature" class="img-h-150 rounded img-thumbnail" />
								</div>
								<!-- form --> 
								<form method="POST" id = "frmSignature"  enctype="multipart/form-data">
								<!-- file-wrapper start -->
								<div class="file-wrapper">
									<label class="upload fob-btn-sign">
										<i class="mdi mdi-cloud-upload-outline fs-24 text-danger"></i> 
										<input type="file" name="uploadSign" id="uploadSignature"  class="form-control hide">
									</label> 
									<div class="form-text fob-btn-sign"> 
										<input type='hidden' value = "<?php echo $staff_id; ?>" name="teacherID" />	
										<input type="hidden" name="profile" value="documents" />
										<input type="hidden" name="upload_t" value="sign" />   
										<div class="text-danger">Staff Signture</div>
									</div>
									<div class="display-none fob-loader-sign">
										<strong role="status">Processing...</strong>
										<div class="spinner-border ms-auto" aria-hidden="true"></div>
									</div>
								</div>
								<!-- file-wrapper end -->  
								</form>
								<!-- / form -->	
							</div> 

							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-6  text-center mb-20">	
								<div class="picture-div mb-10">
									<img src="<?php echo $staff_nat; ?>" id="preview-picture-2" alt="National ID" class="img-h-150 rounded img-thumbnail" />
								</div>
								<!-- form -->
								<form method="POST" id = "frmNatID"  enctype="multipart/form-data">
								<!-- file-wrapper start -->
								<div class="file-wrapper">
									<label class="upload fob-btn-natid">
										<i class="mdi mdi-cloud-upload-outline fs-24 text-danger"></i> 
										<input type="file" name="uploadNatID" id="uploadNatID"  class="form-control hide">
									</label> 
									<div class="form-text fob-btn-natid"> 
										<input type='hidden' value = "<?php echo $staff_id; ?>" name="teacherID" />	
										<input type="hidden" name="profile" value="documents" />
										<input type="hidden" name="upload_t" value="natid" />  	 
										<div class="text-danger">National ID</div>
									</div>
									<div class="display-none fob-loader-natid">
										<strong role="status">Processing...</strong>
										<div class="spinner-border ms-auto" aria-hidden="true"></div>
									</div>
								</div>
								<!-- file-wrapper end -->  
								</form>
								<!-- / form -->	
							</div>
							
							
							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-6  text-center mb-20">	
								<div class="picture-div mb-10">
									<img src="<?php echo $staff_appl; ?>" id="preview-picture-3" alt="Appoinment Letter" class="img-h-150 rounded img-thumbnail" />
								</div>
								<!-- form -->
								<form method="POST" id = "frmApp"  enctype="multipart/form-data">
								<!-- file-wrapper start -->
								<div class="file-wrapper">
									<label class="upload fob-btn-appoint">
										<i class="mdi mdi-cloud-upload-outline fs-24 text-danger"></i> 
										<input type="file" name="uploadApp" id="uploadApp"  class="form-control hide">
									</label> 
									<div class="form-text fob-btn-appoint"> 
										<input type='hidden' value = "<?php echo $staff_id; ?>" name="teacherID" />	
										<input type="hidden" name="profile" value="documents" />
										<input type="hidden" name="upload_t" value="appoint" />   
										<div class="text-danger">Appoinment Letter</div>
									</div>
									<div class="display-none fob-loader-appoint">
										<strong role="status">Processing...</strong>
										<div class="spinner-border ms-auto" aria-hidden="true"></div>
									</div>
								</div>
								<!-- file-wrapper end -->  
								</form>
								<!-- / form -->	
							</div> 


							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-6  text-center mb-20">	
								<div class="picture-div mb-10">
									<img src="<?php echo $staff_doc_1; ?>" id="preview-picture-4" alt="staff extra doc 1" class="img-h-150 rounded img-thumbnail" />
								</div>
								<!-- form -->
								<form method="POST" id = "frmDoc1"  enctype="multipart/form-data">
								<!-- file-wrapper start -->
								<div class="file-wrapper">
									<label class="upload fob-btn-doc1">
										<i class="mdi mdi-cloud-upload-outline fs-24 text-danger"></i> 
										<input type="file" name="uploadDoc1" id="uploadDoc1"  class="form-control hide">
									</label> 
									<div class="form-text fob-btn-doc1"> 
										<input type='hidden' value = "<?php echo $staff_id; ?>" name="teacherID" />	
										<input type="hidden" name="profile" value="documents" />
										<input type="hidden" name="upload_t" value="doc1" />  	 
										<div class="text-danger">Extra Document 1</div>
									</div>
									<div class="display-none fob-loader-doc1">
										<strong role="status">Processing...</strong>
										<div class="spinner-border ms-auto" aria-hidden="true"></div>
									</div>
								</div>
								<!-- file-wrapper end -->  
								</form>
								<!-- / form -->	
							</div> 

							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-6  text-center mb-20">	
								<div class="picture-div mb-10">
									<img src="<?php echo $staff_doc_2; ?>" id="preview-picture-5" alt="staff extra doc 1" class="img-h-150 rounded img-thumbnail" />
								</div>
								<!-- form -->
								<form method="POST" id = "frmDoc2"  enctype="multipart/form-data">
								<!-- file-wrapper start -->
								<div class="file-wrapper">
									<label class="upload fob-btn-doc2">
										<i class="mdi mdi-cloud-upload-outline fs-24 text-danger"></i> 
										<input type="file" name="uploadDoc2" id="uploadDoc2"  class="form-control hide">
									</label> 
									<div class="form-text fob-btn-doc2"> 
										<input type='hidden' value = "<?php echo $staff_id; ?>" name="teacherID" />	
										<input type="hidden" name="profile" value="documents" />
										<input type="hidden" name="upload_t" value="doc2" />  	 
										<div class="text-danger">Extra Document 2</div>
									</div>
									<div class="display-none fob-loader-doc2">
										<strong role="status">Processing...</strong>
										<div class="spinner-border ms-auto" aria-hidden="true"></div>
									</div>
								</div>
								<!-- file-wrapper end -->  
								</form>
								<!-- / form -->	
							</div> 


							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-6  text-center mb-20">	
								<div class="picture-div mb-10">
									<img src="<?php echo $staff_doc_3; ?>" id="preview-picture-6" alt="staff extra doc 3" class="img-h-150 rounded img-thumbnail" />
								</div>
								<!-- form -->
								<form method="POST" id = "frmDoc3"  enctype="multipart/form-data">
								<!-- file-wrapper start -->
								<div class="file-wrapper">
									<label class="upload fob-btn-doc3">
										<i class="mdi mdi-cloud-upload-outline fs-24 text-danger"></i> 
										<input type="file" name="uploadDoc3" id="uploadDoc3"  class="form-control hide">
									</label> 
									<div class="form-text fob-btn-doc3"> 
										<input type='hidden' value = "<?php echo $staff_id; ?>" name="teacherID" />	
										<input type="hidden" name="profile" value="documents" />
										<input type="hidden" name="upload_t" value="doc3" />   
										<div class="text-danger">Extra Document 3</div>
									</div>
									<div class="display-none fob-loader-doc3">
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

					</div> 

				</div>					
				<!-- / tab panes -->  
			</div>
			<!-- / tab --> 
		</div>
		<!-- end card-body -->
	</div>
	<!-- end card -->		
	
		

	<script type='text/javascript'>  
	
		hidePageLoader();  
				 
		$('.wiz-select').each(function() {  
			renderSelect($('#'+this.id)); 
		});  
 
		$(function() {
			$('input[name="dob"], input[name="d_appoint"]').daterangepicker({
				singleDatePicker: true,
				"autoApply": true,
				locale: {
					format: 'YYYY-MM-DD'
				},
				showDropdowns: true,
				minYear: 1930,
				maxYear: parseInt(moment().format('YYYY'),10)
			}, function(start, end, label) {
				//var years = moment().diff(start, 'years');
				//alert("You are " + years + " years old!");
			});

			
		}); 

	</script>