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
	This page handle student profile validation
	------------------------------------------------------------------------*/
	
		if (($_REQUEST['profile']) == 'save') {  /* save student profile */ 
			 
			$regNum = clean($_REQUEST['regNum']);
			$fname = clean($_REQUEST['fname']);
			$mname = clean($_REQUEST['mname']);
			$lname = clean($_REQUEST['lname']);
			$sex =   clean($_REQUEST['sex']);
			$dateofbirth = cleanDate($_REQUEST['dob']);
			$bloodgr =   clean($_REQUEST['bloodgr']);
			$genotype =   clean($_REQUEST['genotype']);
			$height =   clean($_REQUEST['height']); 
			$weight =   clean($_REQUEST['weight']); 
			$religion =   clean($_REQUEST['religion']);
			$height =   clean($_REQUEST['height']);
			$weight =   clean($_REQUEST['weight']); 

			$country = clean($_REQUEST['country']);
			$state = clean($_REQUEST['state']);
			//$lga = clean($_REQUEST['lga']);
			$add1 = clean($_REQUEST['add1']);
			$add2 = clean($_REQUEST['add2']);
			$city = clean($_REQUEST['city']);
			$studphone = clean($_REQUEST['studphone']);
			$email = preg_replace("/[^A-Za-z0-9.@]/", "", $_REQUEST['email']);
			$hostelID = clean($_REQUEST['hostel']);
			$routeID = clean($_REQUEST['route']); 

			$sponphone = clean($_REQUEST['sponphone']);
			$sponsor = clean($_REQUEST['sponsor']);
			$sponadd = clean($_REQUEST['sponadd']);
			$soccup = clean($_REQUEST['soccup']);

			$sponphone2 = clean($_REQUEST['sponphone2']);
			$sponsor2 = clean($_REQUEST['sponsor2']);
			$sponadd2 = clean($_REQUEST['sponadd2']);
			$soccup2 = clean($_REQUEST['soccup2']);

			/* script validation */ 
			
			if ($regNum == "")  {
				
				$msg_e = "Ooops error, could not retrieve student record";
				
			}elseif ($lname == "")  {
			
				$msg_e = "Please enter student first name";
			
			}elseif($fname == "")   {
			
				$msg_e  = "Please enter student last name";
			
			}elseif (($sex == "")) {
			
				$msg_e = "Please select student gender";
			
			}elseif ($dateofbirth == "") {
			
				$msg_e = "Please enter student date of birth";
			
			}elseif ($bloodgr == "") {
			
				$msg_e = "Please enter student blood group";
			
			}elseif (($country == "")) {
				
				$msg_e = "Please select student nationality";
			
			}elseif (($state == "")) {
			
				$msg_e = "Please select student State / District";
			
			}elseif($city == "")   {
			
				$msg_e = "Please enter student city";
			
			}elseif($add1 == "") {
			
				$msg_e = "Please enter student temporary address";
			
			}elseif($add2 == "") {
			
				$msg_e = "Please enter student parmanent address";
			
			}elseif($sponsor == "")   {
			
				$msg_e = "Please enter student sponsor name";
			
			}elseif($sponphone == "")   {
			
				$msg_e = "Please enter student sponsor phone number";
			
			}elseif($sponadd == "")   {
			
				$msg_e = "Please enter student sponsor address";

			}elseif($soccup == "")   {
			
				$msg_e = "Please enter student sponsor occupation";

			}else {  /* update information */  
				
				 
				if($mname != ""){
					$mname = substr($mname, 0, 1);
				}
				$new_name = "$lname $fname $mname";
				

				try { 
		
					$regID = studentRegID($conn, $regNum);   /* student record ID  */
	
					$ebele_mark = "UPDATE $i_student_tb SET
						
									i_firstname = :i_firstname,
									i_midname = :i_midname,
									i_lastname = :i_lastname,
									i_gender = :i_gender,
									i_dob = :i_dob,
									religion = :religion,
									height = :height,
									weight = :weight,
									bloodgp = :bloodgp,
									genotype = :genotype,
									i_country = :i_country,
									i_state = :i_state,                 								
									i_city = :i_city,
									i_add_fi = :i_add_fi,
									i_add_se = :i_add_se,
									i_stu_phone = :i_stu_phone,
									i_email = :i_email,
									hostel = :hostel,
									route = :route,
									i_sponsor = :i_sponsor,
									i_spo_phone = :i_spo_phone,
									i_spo_add = :i_spo_add,
									i_spon_occup = :i_spon_occup,
									sponsor2 = :sponsor2,
									sponphone2 = :sponphone2,
									sponadd2 = :sponadd2, 
									soccup2 = :soccup2  
									
									WHERE ireg_id = :ireg_id";
									
					$igweze_prep = $conn->prepare($ebele_mark);							
					$igweze_prep->bindValue(':i_firstname', $fname);
					$igweze_prep->bindValue(':i_midname', $mname);
					$igweze_prep->bindValue(':i_lastname', $lname);
					$igweze_prep->bindValue(':i_gender', $sex);
					$igweze_prep->bindValue(':i_dob', $dateofbirth);
					$igweze_prep->bindValue(':religion', $religion);
					$igweze_prep->bindValue(':height', $height);
					$igweze_prep->bindValue(':weight', $weight);
					$igweze_prep->bindValue(':bloodgp', $bloodgr);
					$igweze_prep->bindValue(':genotype', $genotype); 
					$igweze_prep->bindValue(':i_country', $country);
					$igweze_prep->bindValue(':i_state', $state);
					//$igweze_prep->bindValue(':i_lga', $lga); i_lga = :i_lga,
					$igweze_prep->bindValue(':i_city', $city);
					$igweze_prep->bindValue(':i_add_fi', $add1);
					$igweze_prep->bindValue(':i_add_se', $add2);
					$igweze_prep->bindValue(':i_stu_phone', $studphone);
					$igweze_prep->bindValue(':i_email', $email);
					$igweze_prep->bindValue(':hostel', $hostelID);
					$igweze_prep->bindValue(':route', $routeID);
					$igweze_prep->bindValue(':i_sponsor', $sponsor);
					$igweze_prep->bindValue(':i_spo_phone', $sponphone);
					$igweze_prep->bindValue(':i_spo_add', $sponadd);
					$igweze_prep->bindValue(':i_spon_occup', $soccup);
					$igweze_prep->bindValue(':sponsor2', $sponsor2);
					$igweze_prep->bindValue(':sponphone2', $sponphone2);
					$igweze_prep->bindValue(':sponadd2', $sponadd2);
					$igweze_prep->bindValue(':soccup2', $soccup2);
					 	
					$igweze_prep->bindValue(':ireg_id', $regID); 

					if ($igweze_prep->execute()) {

						if(($admin_grade == $admin_fobrain_grd) && ($admin_level == $admin_tagged) ||
                        ($admin_grade == $hm_fobrain_grd) && ($admin_level == $hm_fob_tagged)){  /* check if user is admin or hm */ 
							
							if(isset($_REQUEST['sibling'])){

								$sibling = $_REQUEST['sibling'];	
								
								if(is_array($sibling)){  
									
									$sibling[] = $regNum; 

									$sibling = array_unique($sibling);

									$sibling_s = serialize($sibling);

									foreach($sibling as $child){

										$regID = studentRegID($conn, $child);   /* student record ID  */
			
										$ebele_mark_sib = "UPDATE $i_student_tb SET 
														
														sibling = :sibling 
														
														WHERE ireg_id = :ireg_id";
														
										$igweze_prep_sib = $conn->prepare($ebele_mark_sib);							
									
										$igweze_prep_sib->bindValue(':sibling', $sibling_s);		
										$igweze_prep_sib->bindValue(':ireg_id', $regID);
										$igweze_prep_sib->execute(); 

									} 

								}

							}

						}

						$msg_s = "Student Profile with <span> $regNum</span>  was successfully saved";

						echo '
						<script type="text/javascript"> 
							$(".student-name-rp").html("'.$new_name.'");  
						</script>';  
			
					}else {

						$msg_e = "Ooops, an error has occur while trying to save student record. Please try again";

					}
	
				}catch(PDOException $e) {
			
						fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
				
				}

			}
	
		}elseif (($_REQUEST['profile']) == 'uploads') {  /* save student profile picture */
		
					
			$regNum = clean($_REQUEST['regNum']);
			$upload = clean($_REQUEST['upload_t']);
			$upload = trim($upload);
			
			try { 
							
				$sessionID = studentRegSessionID($conn, $regNum);  /* student school session ID */
				$session_fi = fobrainSession($conn, $sessionID);  /* school session */
				
				$regID = studentRegID($conn, $regNum);   /* student record ID  */
				$session_se = $session_fi + $foreal;  
					
				$studentPath = $school_pic_dir.$session_fi.'_'.$session_se.'/';
				
			}catch(PDOException $e) {
		
				fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
			}	
			
			if (!file_exists($studentPath)) {  /* Check if path exists */
				mkdir($studentPath, 0777, true);   /* Create path if not */
			}

			$picturePath = $studentPath; /* picture path */
			
			//$filePic = "uploadPic"; /* picture file name */
			//$pageDesc = "Student picture";

			$filePic = $student_upload_arr["$upload"]["name"];
			$pageDesc = $student_upload_arr["$upload"]["desc"];
			$field = $student_upload_arr["$upload"]["field"];
			$preview = $student_upload_arr["$upload"]["preview"];

			$script_scroll_cm = "
				$('#".$filePic."').val(''); 
				$('.fob-loader-".$upload."').slideUp(4000);
				$('.fob-btn-".$upload."').slideDown(5000); ";
			
			/* call igweze file uploader */
			$uploadPicData = igwezeFileUploader($filePic, $picturePath, ($oneMB * 2), $validPicExt, $validPicType, $allowedPicExt, $fileType = "Picture", $fiVal); 
				
			if (is_array($uploadPicData['error'])) {  /* check if any upload error */
					
				$msg_e = '';
					
				foreach ($uploadPicData['error'] as $msg) {
					$msg_e .= $msg.'<br />';     /* display error messages */
				}
				 
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> 
						$script_scroll_cm  
					</script>"; exit;
				
				
			} else {
				
				$uploadedPic = $uploadPicData['refilename']; /* uploaded picture file */
				
				if ($uploadedPic != "") {
						
					if (move_uploaded_file($_FILES[$filePic]['tmp_name'], $picturePath.$uploadedPic )) { /* move uploaded file to its path */
							
							
						try { 
							
							removeStudentPicture($conn, $regNum, $picturePath, $field);

							$ebele_mark = "UPDATE $i_student_tb SET 
											
												$field = :i_stupic

												WHERE ireg_id = :ireg_id";
												
							$igweze_prep = $conn->prepare($ebele_mark);	
							$igweze_prep->bindValue(':i_stupic', $uploadedPic);
							$igweze_prep->bindValue(':ireg_id', $regID);	 

							if($igweze_prep->execute()){  /* insert picture name to database */ 

								$preview_img = $picturePath.$uploadedPic;
								
								//$msg_s = "$pageDesc was successfully uploaded";									
								//echo $succesMsg.$msg_s.$sEnd;								
								echo "<script type='text/javascript'> 
										$('.".$preview."').attr('src', '$preview_img?rand=' + Math.random());  									
										$script_scroll_cm
								</script>";  exit;	

							}else{ /* display error messages */ 
						 
								$msg_e = "Ooops, an error has occur while trying to save $pageDesc. Please try again or check your network connection!!!";
								echo $errorMsg.$msg_e.$eEnd;
								echo "<script type='text/javascript'> 
										$script_scroll_cm  
									</script>"; exit;

							}


						}catch(PDOException $e) { 
							 
							fobrainDie( 'Ooops Database Error: ' . $e->getMessage());

						}
							
							
					}else{ /* display error messages */ 
						 
						$msg_e = "Ooops, an error has occur while trying to save $pageDesc. Please try again or check your network connection!!!";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'> 
							$script_scroll_cm  
						</script>"; exit;
									
					}
						
				}else{ /* display error messages */ 
				 
					$msg_e = "Ooops, an error has occur while trying to save $pageDesc. Please try again or check your network connection!!!";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'> 
						$script_scroll_cm  
					</script>"; exit;							

				}	 
				
			} 
		
		}elseif (($_REQUEST['profile']) == 'class') {  /* save student class */

			$regNum = clean($_REQUEST['regNum']);
			$class_fi = clean($_REQUEST['class_fi']);
			$class_se = clean($_REQUEST['class_se']);
			$class_th = clean($_REQUEST['class_th']);
			$class_fo = clean($_REQUEST['class_fo']);
			$class_fif = clean($_REQUEST['class_fif']);
			$class_six = clean($_REQUEST['class_six']);

			/* script validation */ 
			
			if ($regNum == "")  {
				
				$msg_e = "Ooops error, could not retrieve student record";
				
			} else {

				try {

					$regID = studentRegID($conn, $regNum);   /* student record ID  */
	
					if($schoolExt == $fobrainNurAbr){  /* check if school is nursery */
						
							$ebele_mark = "UPDATE $i_reg_tb SET 
										
											class_1 = :class_1,
											class_2 = :class_2,
											class_3 = :class_3
											
											WHERE ireg_id = :ireg_id";
											
							$igweze_prep = $conn->prepare($ebele_mark);    
							$igweze_prep->bindValue(':class_1', $class_fi);
							$igweze_prep->bindValue(':class_2', $class_se);
							$igweze_prep->bindValue(':class_3', $class_th);                                   
							$igweze_prep->bindValue(':ireg_id', $regID);								
						
					}else{


							$ebele_mark = "UPDATE $i_reg_tb SET 
										
											class_1 = :class_1,
											class_2 = :class_2,
											class_3 = :class_3,
											class_4 = :class_4,
											class_5 = :class_5,
											class_6 = :class_6
											
											WHERE ireg_id = :ireg_id";
											
							$igweze_prep = $conn->prepare($ebele_mark);    
							$igweze_prep->bindValue(':class_1', $class_fi);
							$igweze_prep->bindValue(':class_2', $class_se);
							$igweze_prep->bindValue(':class_3', $class_th);
							$igweze_prep->bindValue(':class_4', $class_fo);
							$igweze_prep->bindValue(':class_5', $class_fif);
							$igweze_prep->bindValue(':class_6', $class_six);
							$igweze_prep->bindValue(':ireg_id', $regID);								
					
					}
					
					if ($igweze_prep->execute()) {  /* if sucessfully */

						$msg_s = "Student class infomation was successfully saved";
						//echo "<script type='text/javascript'>  $('#editBio5').slideUp(2000);  </script>";									

					}else {  /* display error */ 

						$msg_e = "<span>Ooops, an error has occur where trying t0 save Class Settings.
						Please try again</span>";

					}
			
				}catch(PDOException $e) {
			
						fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
				
				}

			
			} 
	
		}elseif (($_REQUEST['profile']) == 'move') {  /* move student to new session */
			exit;

			$regNum = clean($_REQUEST['regNum']);
			$session = clean($_REQUEST['session']);


			try {
				
				$sess_id = studentRegSessionID($conn, $regNum);
				$c_session_fi = fobrainSession($conn, $sess_id);
				$sessionID = sessionID($conn, $session);	 				 														
				$regID = studentRegID($conn, $regNum);   /* student record ID  */
				
				$c_session_se = $c_session_fi + $foreal; 

				if ($regNum == "") {
					
					$msg_e = "Ooops error, could not retrieve student record";
					
				}elseif($session == ""){

					$msg_e = "Please select session to move student result to";
		
				} elseif($sess_id < $sessionID){
				
					$msg_e = "Please select session which is higher or the same student current 
					$c_session_fi - $c_session_se session";
		
				} else {


					$session_se = ($session + $foreal);

					if($sess_id == $sessionID){
					
						$s_status = $session_norm;
						$session_frm = '';
					
					}else{
					
						$s_status = $session_extr_yr;
						$session_frm = $sessionID;							
					
					} 

					$ebele_mark = "UPDATE $reg_tb SET 
								
									session_frm = :session_frm,
									
									s_status = :s_status

									WHERE ireg_id = :ireg_id";
									
					$igweze_prep = $conn->prepare($ebele_mark);	
				
					$igweze_prep->bindValue(':session_frm', $session_frm);
					$igweze_prep->bindValue(':s_status', $s_status);
					$igweze_prep->bindValue(':ireg_id', $regID);

					if ($igweze_prep->execute()) {

						$msg_s = "Student Profile with  $regNum result session was Successfully move to $session - $session_se session.";
						echo "<script type='text/javascript'>  $('#MoveSessionDiv').slideUp(2000);  </script>";
						echo "<script type='text/javascript'>  $('.successbox').fadeOut(15000);</script>"; 

					}else {

						$msg_e = "<span>Ooops,  An Error Has occur, please try again</span>";

					}

				}
			
			}catch(PDOException $e) {
			
				fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
				
			}	
	
		}else{
		
			echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
		
		}


		
		if ($msg_s) {

			echo $succesMsg.$msg_s.$sEnd;
			echo "<script type='text/javascript'>  hidePageLoader(); </script>"; exit;
									
		}	


		if ($msg_e) {

			echo $errorMsg.$msg_e.$eEnd;
			echo "<script type='text/javascript'>  hidePageLoader(); </script>"; exit; 
			
									
		}	
		
exit;
?>