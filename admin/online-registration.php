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
	This script load student online registration
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

     define('fobrain', 'igweze');  /* define a check for wrong access of file */

      	require 'fobrain-config-s.php';  /* load fobrain configuration files */
		 
		if ($_REQUEST['reg'] != '') {

			/* script validation */ 
			
			try {
		 				
				$reg = $_REQUEST['reg'];
				

				$ebele_mark = "SELECT stu_id, i_stupic, i_school, i_level, i_firstname, i_midname, i_lastname, i_gender, i_dob, 
								i_country, i_state, i_lga, i_city, i_add_fi, i_add_se, i_stu_phone, i_email, i_sponsor, i_spo_add, bloodgp, genotype, 
								i_spon_occup, i_spo_phone

                     			FROM $studentOnlineRegTB

                     			WHERE stu_id = :stu_id";
					 
 			    $igweze_prep = $conn->prepare($ebele_mark);
  				$igweze_prep->bindValue(':stu_id', $reg);
				 
 				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count == $foreal) {  /* check array is empty */
				
					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {  /* loop array */	
					
						$stu_id = $row['stu_id'];
						$school = $row['i_school'];
						$level = $row['i_level'];
						$pic = $row['i_stupic'];
						$fname = $row['i_firstname'];
						$lname = $row['i_lastname'];
						$mname = $row['i_midname'];
						$gender = $row['i_gender'];
						$date = $row['i_dob'];
						$country = $row['i_country'];
						$state = $row['i_state'];
						$lga = $row['i_lga'];
						$city = $row['i_city'];
						$add1 = $row['i_add_fi'];
						$add2 = $row['i_add_se'];
						$phone = $row['i_stu_phone'];
						$email = $row['i_email'];
						$spon = $row['i_sponsor'];
						$soccup = $row['i_spon_occup'];
						$sphone = $row['i_spo_phone'];
						$adds = $row['i_spo_add'];
						$bloodGP = $row['bloodgp'];
						$genoTP = $row['genotype'];

					}	

							
					

					$schoolID = $school;
			 
					$supRegNo = $schoolRegSuffArr[$schoolID];
			
					require $fobrainSchoolTBS; /* include student database table information  */ 

					$level_list = studentLevelsArray($conn); 

					$level_val = "";

					foreach($level_list as $level_grade) { 

						$levelID = $level_grade['cl_id']; $levelVal = $level_grade['level'];

						if ($levelID == $level){
							$selected = "SELECTED";
						} else {
							$selected = "";
						}

						$level_val .= '<option value="'.$school.'-'.$levelID.'"'.$selected.'>'.$levelVal.'</option>' ."\r\n";

						$levelID = ""; $levelVal = "";

					}	 
					 

					 
					$enlevel = $level_list[$level]['level'];

					$genderM = wizSelectArray($gender, $gender_list);
					$bloodGroup = wizSelectArray($bloodGP, $bloodgr_list);
					$genoType = wizSelectArray($genoTP, $genotype_list);
					$school = wizSelectArray($school, $school_list); 
 
					$student_img = picture($applyPSrc, $pic, "student");

					$levelReg = '
					 
						<div class="col-lg-6">										
							<!-- field wrapper start -->
							<div class="field-wrapper select-wrapper">
							  	<select class="form-control"  id="levelReg" name="levelReg">							  
								<option value = "">Select  Level  </option> 								
									'.$level_val.' 									
								</select>
								<div class="icon-wrap"  id="wait_1" style="display: none;">
									<i class="loader"></i>
								</div>
								<div class="field-placeholder">Student Level <span class="text-danger">*</span></div>
							</div>
							<!-- field wrapper end -->
						</div>';


								

$table =<<<IGWEZE

					 
				 
					
					<div id ='msg-box'> </div>
					
					<div id = 'fobrain-print' class='new-reg-div'>
						
						<a href="javascript:;"  class="accept-regisration btn btn-success waves-effect   
						btn-label waves-light pull-left mb-20" id="$stu_id">
							<i class="mdi mdi-account-plus-outline label-icon"></i> Admit
						</a>

						<a href="javascript:;"  class="discard-regisration btn btn-danger waves-effect   
						btn-label waves-light pull-right mb-20" id="$stu_id">
							<i class="mdi mdi-account-remove-outline label-icon"></i> Discard
						</a>
						<div class="clear-ft"></div>
						<hr class="my-5 text-danger" /> 
						<div class="clear-ft"></div>

						<!-- row -->
						<div class="row gutters justify-content-center">

							<h3 class="text-info font-head-1 mt-10 mb-10 text-center">Choose Class to Enroll</h3>

							$levelReg 
							 	 
							<div class="col-lg-12">		 
								<span id="result_1" style="display: none;"></span><!-- loading div -->
							</div>
						</div>	
						<!-- /row -->
						<hr class="my-5 text-danger" />
						<!-- table -->
						<table  class="table view-table table-hover"> 
						<tr>
							<th colspan="2" class="text-center"> 
							<center>							   
							<img src = "$student_img" class=" img-h-100 img-circle img-thumbnail">
							<h4 class="text-primary font-head-1 mt-15">$lname Profile Information</h4>
							<center>
							</th>
						</tr>
						 
						
						<tr>
							<th>
								 School To Enroll 
							</th> 
							<td> 
								$school 
							</td>
						</tr>
						
						<tr>
							<th>
								Class To Enroll 
							</th> 
							<td> 
								$enlevel
							</td>
						</tr> 
						
						<tr>
							<th>
								Name 
							</th> 
							<td>
								$lname 
								$fname $mname 
							</td> 
						</tr>
						<tr>
							<th>
							Gender 
							</th> 
							<td>$genderM</td> 
						</tr>
						<tr>
							<th>
								Date Of Birth
							</th> 
							<td> $date</td> 
						</tr>
						<tr>
							<th>
								Nationality 
							</th> 
							<td> $country</td> 
						</tr>
						<tr>
							<th>
								State/Province 
							</th> 
							<td> $state</td> 
						</tr>
						<!--
						<tr>
							<th>
								LGA
							</th> 
							<td>$lga</td> 
						</tr>
						-->
						<tr>
							<th>
								City 
							</th> 
							<td>$city </td> 
						</tr>
						<tr>
							<th>
							Address
							</th> 
							<td>$add1 </td> 
						</tr>
						<tr>
							<th>
								Address 2
							</th> 
							<td>$add2 </td> 
						</tr>
						<tr>
							<th>
								Phone Number
							</th> 
							<td>$phone</td> 
						</tr>
						<tr>
							<th>
								Email
							</th> 
							<td>$email</td> 
						</tr>
						<tr>
							<th>
								Sponsor Name
							</th> 
							<td>$spon</td> 
						</tr> 
						<tr>
							<th>
								Sponsor Occupation
							</th> 
							<td>$soccup</td> 
						</tr> 
						<tr>
							<th>
								Sponsor Address
							</th> 
							<td>$adds</td> 
						</tr> 

						<tr>
							<th>
								Sponsor Phone
							</th> 
							<td>$sphone</td> 
						</tr>
				 			
						 
						
						<tr>
							<th colspan="2">
								<h4 class="text-center text-primary font-head-1 mt-10">$lname Medical Information </h4> 
							</th>
						</tr>

						<tr>
							<th>
								Blood Group
							</th> 
							<td>$bloodGroup</td> 
						</tr>

						<tr>
							<th>
								Genotype
							</th> 
							<td>$genoType</td> 
						</tr>
 	
					   
						</table>
						<!-- / table --> 					
				</div>
		
IGWEZE;

					echo "<div> $table </div>";
				
					echo "<script type='text/javascript'> 
							renderSelect('#levelReg');  
							$('#levelReg').change(); 
							hidePageLoader(); 
						</script>";
				
				

				}else{  /* display error */
				
					$msg_e =  "Ooops error, could not find Student's record information.";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'> hidePageLoader();	</script>";	 echo $scroll_up; exit;			
							
				}
				
			}catch(PDOException $e) {
				
						fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
				 
			} 
		
		}else{		
		
			echo $userNavPageError; exit;  /* else exit or redirect to 404 page */		
		
		} 
	
	 
		
exit;		
?>