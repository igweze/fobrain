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
	This page load staff profile
	------------------------------------------------------------------------*/  

if(!session_id()){
    session_start();
}

		if (!defined('fobrain')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
				
		require_once $fobrainIconPage; /* This include top middle global icon page eg go back, print buttons etcs */ 	 
	 
				 
			try {
		 				
				$teacherID = strip_tags($_REQUEST['teacherID']);

				/* select staff profile */ 	
				
  				$ebele_mark = "SELECT t_id, i_title, i_picture, i_sign, i_firstname, i_lastname, i_midname, i_gender, i_dob,  
								i_country, i_state, i_lga, i_city, i_add_fi, i_add_se, i_phone, i_email, i_sponsor, 
								i_spo_phone, i_spo_add, genotype, bloodgp, i_mar_status, 
								school, d_appoint, app_type, qualif, w_exper, e_note, salary, taxid, bank, swift, accname, 
								accnum, sponocc, relatn, sponsor2, sponphone2, sponocc2, sponadd2, relatn2, natid, appl, 
								doc_1, doc_2, doc_3, l_login

                     FROM $staffTB

                     WHERE t_id = :t_id";
					 
 			    $igweze_prep = $conn->prepare($ebele_mark);
  				$igweze_prep->bindValue(':t_id', $teacherID);
 				$igweze_prep->execute();
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count == $foreal) {  /* check array is empty */

					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {  /* loop array */		 

						$staff_id = $row['t_id'];
						$pic = $row['i_picture'];
						$signPic = $row['i_sign'];
						$title = $row['i_title'];
						$fname = $row['i_firstname'];
						$lname = $row['i_lastname'];
						$mname = $row['i_midname'];
						$gender = $row['i_gender'];
						$marital = $row['i_mar_status'];
						$dateofbirth = $row['i_dob'];
						$country = $row['i_country']; 
						$state = $row['i_state'];
						$lga = $row['i_lga'];
						$city = $row['i_city'];
						$add1 = $row['i_add_fi'];
						$add2 = $row['i_add_se'];
						$phone = $row['i_phone'];
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
					 
					$titleVal = wizSelectArray($title, $title_list);	
					$genderM = wizSelectArray($gender, $gender_list);
					$bloodGroup = wizSelectArray($bloodGP, $bloodgr_list);
					$genoType = wizSelectArray($genoTP, $genotype_list);
					$maritalS = wizSelectArray($marital, $mslist);
					$app_t = wizSelectArray($app_type, $appoint_list);
					$school_t = wizSelectArray($school, $school_list);  
					
					if($show_more == true){
					
						$formTeacherArray = formTeachersArrays($conn, $t_id);  /* assign class teacher array */ 	
						$fteacherCount = count($formTeacherArray);
						
						if($fteacherCount >= $foreal){  /* check array is empty */
							
							//$formClass .= " ";		
							$levelArray = studentLevelsArray($conn); /* student level array */
							
							array_unshift($levelArray,"");
							unset($levelArray[0]);

							for($i = $fiVal; $i <= $fteacherCount; $i++){  /* loop array */
										
								$tID = $formTeacherArray[$i]["t_id"];
								$sessionID = $formTeacherArray[$i]["session"];
								$levelID = $formTeacherArray[$i]["level"];
								$classID = $formTeacherArray[$i]["class"];								
								
								$classKey = array_search($classID, $class_list);
								$clArray = studentClassArray($conn, $levelID);  /* retrieve student class array */
								$classArray = unserialize($clArray);
								
								$fobrainClass = $classArray[$classKey];

								$session_fi = fobrainSession($conn, $sessionID);						

								$session_se = $session_fi + $foreal;  
								$classLevel = $levelArray[$levelID]['level'];
			
								$formClass .= '
								<div class="col-lg-4 col-md-4 col-sm-4 col-12 profile-info">
									<div class="title">
										<i class="fas fa-user"></i> Class Moderating 
									</div>
									<div class="detail font-head-1 fs-14">
										'.$classLevel.' Class '.$fobrainClass.', '.$session_fi.' - '. $session_se.'
										Session
									</div>
								</div>'; 

							}				
						
						} 

						$subjectsArray = subjectTeacherArrays($conn, $t_id);  /* school staff subjects array */	
						$steacherCount = count($subjectsArray);
						
						if($steacherCount >= $foreal){  /* check array is empty */
							
							$subtTable .= "
								<tr>
									<th class = 'text-center text-primary' colspan = '2'><center> 
										Subject/s Assign To Me</center>
									</th>
								</tr>
								<tr>
									<th style='padding-left: 3% !important; text-align:left; width: 30%;'>
										Subject/s 
									</th> 
									<th style='padding-left: 3% !important; text-align:left;  width: 70%;'>
										Class 
									</th> 
								</tr>";		
							$levelArray = studentLevelsArray($conn); /* student level array */
							
							array_unshift($levelArray,"");
							unset($levelArray[0]);

							for($i = $fiVal; $i <= $steacherCount; $i++){  /* loop array */
										
								$tID = $subjectsArray[$i]["t_id"];
								$subID = $subjectsArray[$i]["sub_id"];
								$sessionID = $subjectsArray[$i]["session"];
								$levelID = $subjectsArray[$i]["level"];
								$classID = $subjectsArray[$i]["class"];	
								
								$subjectName = schoolSubject($conn, $subID);  /* school subjects information */
								
								$classKey = array_search($classID, $class_list);
								$clArray = studentClassArray($conn, $levelID);  /* retrieve student class array */
								$classArray = unserialize($clArray);
								
								$fobrainClass = $classArray[$classKey];

								$session_fi = fobrainSession($conn, $sessionID);  /* school session  */						

								$session_se = $session_fi + $foreal;  
								$classLevel = $levelArray[$levelID]['level'];
			
								$subtTable .= '<tr><th>
								'.$subjectName.'
								</th><td>
								'.$classLevel.' Class '.$fobrainClass.', '.$session_fi.' - '. $session_se.'
								Session </td> </tr>
								'; 

							}				
						
						}

					}else{

						$formClass = ""; $subtTable = ""; 

					}	
						
				
		
				

$profile =<<<IGWEZE
				
						 

						<div class="profile-wrapper mb-50" id="fobrain-print">		
							<div class="picture">
								<img src="$staff_img" alt="Profile Picture">
							</div>

							<div class="info">
								<h2 class="main-title">$titleVal $lname $fname $mname</h2>
								<span class="sub-title">Basic Information </span>
							</div> 

							<div class="row mt-10 profile-top-border">

								<div class="col-lg-4 col-md-4 col-sm-4 col-12 profile-info">
									<div class="title">
										<i class="mdi mdi-human-male-female fs-14"></i> Gender
									</div>
									<div class="detail font-head-1 fs-14">
										$genderM
									</div>
								</div> 
								
								<div class="col-lg-4 col-md-4 col-sm-4 col-12 profile-info">
									<div class="title">
										<i class="fas fa-calendar-day"></i> Date Of Birth
									</div>
									<div class="detail font-head-1 fs-14">
										$dateofbirth
									</div>
								</div>

								<div class="col-lg-4 col-md-4 col-sm-4 col-12 profile-info">
									<div class="title">
										<i class="fas fa-user-shield"></i> Marital Status
									</div>
									<div class="detail font-head-1 fs-14">
										$maritalS
									</div>
								</div>


								<div class="col-lg-4 col-md-4 col-sm-4 col-12 profile-info">
									<div class="title">
										<i class="mdi mdi-school fs-14"></i> School Moderating
									</div>
									<div class="detail font-head-1 fs-14">
										$school_t
									</div>
								</div> 
								
								<div class="col-lg-4 col-md-4 col-sm-4 col-12 profile-info">
									<div class="title">
										<i class="fas fa-calendar-day"></i> Appointment Date
									</div>
									<div class="detail font-head-1 fs-14">
										$d_appoint
									</div>
								</div>

								<div class="col-lg-4 col-md-4 col-sm-4 col-12 profile-info">
									<div class="title">
										<i class="fas fa-user-shield"></i> Appointment Type
									</div>
									<div class="detail font-head-1 fs-14">
										$app_t
									</div>
								</div>


								<div class="col-lg-4 col-md-4 col-sm-4 col-12 profile-info">
									<div class="title">
										<i class="fas fa-brain"></i> Qualifications
									</div>
									<div class="detail font-head-1 fs-14">
										$qualif
									</div>
								</div> 
								
								<div class="col-lg-4 col-md-4 col-sm-4 col-12 profile-info">
									<div class="title">
										<i class=" fas fa-business-time"></i> Work Experience
									</div>
									<div class="detail font-head-1 fs-14">
										$w_exper
									</div>
								</div>

								<div class="col-lg-4 col-md-4 col-sm-4 col-12 profile-info">
									<div class="title">
										<i class="fas fa-user-shield"></i> Extra Note
									</div>
									<div class="detail font-head-1 fs-14">
										$e_note
									</div>
								</div> 

								<div class="col-lg-4 col-md-4 col-sm-4 col-12 profile-info">
									<div class="title">
										<i class="fas fa-user-md"></i> Blood Group
									</div>
									<div class="detail font-head-1 fs-14">
										$bloodGroup
									</div>
								</div>
								
								<div class="col-lg-4 col-md-4 col-sm-4 col-12 profile-info">
									<div class="title">
										<i class="fas fa-user-md"></i> Genotype
									</div>
									<div class="detail font-head-1 fs-14">
										$genoType
									</div>
								</div> 

								<div class="col-lg-4 col-md-4 col-sm-4 col-12 profile-info">
									<div class="title">
										 
									</div>
									<div class="detail font-head-1 fs-14">
									 
									</div>
								</div> 

								$formClass
										
							</div>

							<div class="info my-30"> 
								<span class="sub-title">Contact Information </span>
							</div> 

							<div class="row mt-10 profile-top-border">


								<div class="col-lg-4 col-md-4 col-sm-4 col-12 profile-info">
									<div class="title">
										<i class="fas fa-flag-checkered"></i> Country
									</div>
									<div class="detail font-head-1 fs-14">
										$country
									</div>
								</div>
								
								<div class="col-lg-4 col-md-4 col-sm-4 col-12 profile-info">
									<div class="title">
										<i class="mdi mdi-map-marker-radius fs-14"></i> State<span class="hide-res">/Province<span> 
									</div>
									<div class="detail font-head-1 fs-14">
										$state
									</div>
								</div>
								
								<div class="col-lg-4 col-md-4 col-sm-4 col-12 profile-info">
									<div class="title">
										<i class="mdi mdi-map-marker-radius fs-14"></i> City
									</div>
									<div class="detail font-head-1 fs-14">
										$city
									</div>
								</div>

								<div class="col-lg-6 col-md-6 col-sm-6 col-12 profile-info">
									<div class="title">
										<i class="fas fa-phone-volume"></i> Phone Number
									</div>
									<div class="detail font-head-1 fs-14">
										$phone										
									</div>
								</div>
								
								<div class="col-lg-6 col-md-6 col-sm-6 col-12 profile-info">
									<div class="title">
										<i class="fas fa-envelope-open-text"></i> Email
									</div>
									<div class="detail font-head-1 fs-14">
										$email
									</div>
								</div>		
								
								<div class="col-lg-6 col-md-6 col-sm-12 col-12 profile-info">
									<div class="title">
										<i class="mdi mdi-map-marker-radius fs-14"></i> Current Address
									</div>
									<div class="detail font-head-1 fs-14">
										$add1 
									</div>
								</div>

								<div class="col-lg-6 col-md-6 col-sm-12 col-12 profile-info">
									<div class="title">
										<i class="mdi mdi-google-street-view fs-14"></i> Parmanent Address
									</div>
									<div class="detail font-head-1 fs-14">
										$add2 
									</div>
								</div>  
								

							</div>


							<div class="info my-30"> 
								<span class="sub-title">Payroll and Bank </span>
							</div> 

							<div class="row mt-10 profile-top-border">

								<div class="col-lg-4 col-md-4 col-sm-4 col-12 profile-info">
									<div class="title">
										<i class="mdi mdi-account-cash-outline fs-14"></i> Salary
									</div>
									<div class="detail font-head-1 fs-14">
										$salary
									</div>
								</div>
								
								<div class="col-lg-4 col-md-4 col-sm-4 col-12 profile-info">
									<div class="title">
										<i class="mdi mdi-cash-refund fs-14"></i> Tax ID 
									</div>
									<div class="detail font-head-1 fs-14">
										$taxid
									</div>
								</div>
								
								<div class="col-lg-4 col-md-4 col-sm-4 col-12 profile-info">
									<div class="title">
										<i class="mdi mdi-qrcode fs-14"></i> SWIFT Code
									</div>
									<div class="detail font-head-1 fs-14">
										$swift
									</div>
								</div>

								<div class="col-lg-4 col-md-4 col-sm-4 col-12 profile-info">
									<div class="title">
										<i class="mdi mdi-bank fs-14"></i> Bank
									</div>
									<div class="detail font-head-1 fs-14">
										$bank
									</div>
								</div>
								
								<div class="col-lg-4 col-md-4 col-sm-4 col-12 profile-info">
									<div class="title">
										<i class="mdi mdi-bank-transfer fs-14"></i> Account Name 
									</div>
									<div class="detail font-head-1 fs-14">
										$accname
									</div>
								</div>
								
								<div class="col-lg-4 col-md-4 col-sm-4 col-12 profile-info">
									<div class="title">
										<i class="mdi mdi-bank-transfer-in fs-14"></i> Account Number
									</div>
									<div class="detail font-head-1 fs-14">
										$accnum
									</div>
								</div>  
							</div>


							<div class="info my-30"> 
								<span class="sub-title">Gurantor Information </span>
							</div> 

							<div class="row mt-10 profile-top-border">

								<div class="col-lg-4 col-md-4 col-sm-4 col-12 profile-info">
									<div class="title">
										<i class="fas fa-user-tie"></i>  Name
									</div>
									<div class="detail font-head-1 fs-14">
										$sponsor
									</div>
								</div> 
								
								<div class="col-lg-4 col-md-4 col-sm-4 col-12 profile-info">
									<div class="title">
										<i class="fas fa-phone-volume"></i>  Phone
									</div>
									<div class="detail font-head-1 fs-14">
										$sponphone
									</div>
								</div>

								<div class="col-lg-4 col-md-4 col-sm-4 col-12 profile-info">
									<div class="title">
										<i class="mdi mdi-facebook-workplace fs-14"></i> Occupation
									</div>
									<div class="detail font-head-1 fs-14">
										$sponocc
									</div>
								</div> 

								<div class="col-lg-8 col-md-8 col-sm-8 col-12 profile-info">
									<div class="title">
										<i class="mdi mdi-map-marker-radius fs-14"></i> Address
									</div>
									<div class="detail font-head-1 fs-14">
										$sponadd
									</div>
								</div>

								<div class="col-lg-4 col-md-4 col-sm-4 col-12 profile-info">
									<div class="title">
										<i class="mdi mdi-human-male-female fs-14"></i> Relationship
									</div>
									<div class="detail font-head-1 fs-14">
										$relatn
									</div>
								</div>

								<div class="col-lg-4 col-md-4 col-sm-4 col-12 profile-info">
									<div class="title">
										<i class="fas fa-user-tie"></i>  Name
									</div>
									<div class="detail font-head-1 fs-14">
										$sponsor2
									</div>
								</div> 
								
								<div class="col-lg-4 col-md-4 col-sm-4 col-12 profile-info">
									<div class="title">
										<i class="fas fa-phone-volume"></i>  Phone
									</div>
									<div class="detail font-head-1 fs-14">
										$sponphone2
									</div>
								</div>

								<div class="col-lg-4 col-md-4 col-sm-4 col-12 profile-info">
									<div class="title">
										<i class="mdi mdi-facebook-workplace fs-14"></i> Occupation
									</div>
									<div class="detail font-head-1 fs-14">
										$sponocc2
									</div>
								</div> 

								<div class="col-lg-8 col-md-8 col-sm-8 col-12 profile-info">
									<div class="title">
										<i class="mdi mdi-map-marker-radius fs-14"></i> Address
									</div>
									<div class="detail font-head-1 fs-14">
										$sponadd2
									</div>
								</div>

								<div class="col-lg-4 col-md-4 col-sm-4 col-12 profile-info">
									<div class="title">
										<i class="mdi mdi-human-male-female fs-14"></i> Relationship
									</div>
									<div class="detail font-head-1 fs-14">
										$relatn2
									</div>
								</div>

							</div>


							<div class="info my-30"> 
								<span class="sub-title">Staff Documents</span>
							</div> 

							<div class="row mt-10 profile-top-border">

								<div class="my-20"> </div>
								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-6 text-center mb-30">
									<div class="picture-div mb-10">
										<img src="$staff_sign" alt="staff signature" class="img-h-150 rounded img-thumbnail" />
									</div>
									<div class="text-danger">Staff Signturea</div>
								</div>

								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-6 text-center mb-30">
									<div class="picture-div mb-10">
										<img src="$staff_nat" alt="National ID" class="img-h-150 rounded img-thumbnail" />
									</div>
									<div class="text-danger">National ID</div>
								</div>


								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-6 text-center mb-30">
									<div class="picture-div mb-10">
										<img src="$staff_appl" alt="Appoinment Letter" class="img-h-150 rounded img-thumbnail" />
									</div>
									<div class="text-danger">Appoinment Letter</div>
								</div>

								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-6 text-center mb-30">
									<div class="picture-div mb-10">
										<img src="$staff_doc_1" alt="Extra Document 1" class="img-h-150 rounded img-thumbnail" />
									</div>
									<div class="text-danger">Extra Document 1</div>
								</div>

								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-6 text-center mb-30">
									<div class="picture-div mb-10">
										<img src="$staff_doc_2" alt="Extra Document 2" class="img-h-150 rounded img-thumbnail" />
									</div>
									<div class="text-danger">Extra Document 2</div>
								</div>

								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-6 text-center mb-30">
									<div class="picture-div mb-10">
										<img src="$staff_doc_3" alt="Extra Document 3" class="img-h-150 rounded img-thumbnail" />
									</div>
									<div class="text-danger">Extra Document 3</div>
								</div>  
							</div>
								
						</div>
		
IGWEZE;
						echo $profile;
					
						echo "<script type='text/javascript'>   hidePageLoader(); </script>";
				

				}else{  /* display error */ 
				
					$msg_e =  "Ooops, staff record was not found.";
					
					
				}
				
			}catch(PDOException $e) {
				
				fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
				 
			} 
		
			if ($msg_e) {

				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>   hidePageLoader(); </script>"; exit;  

			}
			
exit;			
?>