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
	This page handle staff profile validation
	------------------------------------------------------------------------*/
 

		if (!defined('fobrain')) /* This checks if this page was wrongly access by users */
		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');    
 
		if (($_REQUEST['profile']) == 'new-staff') {  /* save staff profile */  

			$title = clean($_REQUEST['title']);
			//$ranking = clean($_REQUEST['ranking']);
			$lname = clean($_REQUEST['lname']);
			$fname = clean($_REQUEST['fname']);
			$mname = clean($_REQUEST['mname']);
			$email = preg_replace("/[^A-Za-z0-9.@]/", "", $_REQUEST['email']);

			/* script validation */ 
			
			if ($lname == "")  {
			
				$msg_e = "Ooops Error, please enter staff last name";
				echo $errorMsg.$msg_e.$eEnd;
				echo "<script type='text/javascript'>  hidePageLoader(); </script>"; exit;
			
			}elseif ($fname == "")  {
			
				$msg_e = "Ooops Error, please enter staff first name";
				echo $errorMsg.$msg_e.$eEnd;
				echo "<script type='text/javascript'>  hidePageLoader(); </script>"; exit;
			
			}elseif ($email == "")  {
			
				$msg_e = "Ooops Error, please enter staff email address";
				echo $errorMsg.$msg_e.$eEnd;
				echo "<script type='text/javascript'>  hidePageLoader(); </script>"; exit;
			
			}elseif (staffUserExits($conn, $email) >= $fiVal)   {  /* check if school staffs/teachers exits */ 
					
				$msg_e = "* Ooops error, this email ($email) already exist. Please enter new one.";
				echo $errorMsg.$msg_e.$eEnd;
				echo "<script type='text/javascript'>  hidePageLoader(); </script>"; exit;
				
			}else {  /* insert information */   

				try {
																			
					
					if($generatePass == $foreal){  /* check generate password status */
						
						$userPass = randomString($charset, 8);  /* generate password */ 
	
					}else{
	
						$userPass = "password"; 
	
					}

					$userPass = password_hash($userPass, PASSWORD_BCRYPT, $options_bcrypt); 

					$salted = randomString($charset, 16);  /* generate salted */  

					$ebele_mark = "INSERT INTO $staffTB (i_title, i_lastname, i_firstname, i_midname, i_email, i_accesspass, i_salted, status) 
								
									VALUES(:i_title, :i_lastname, :i_firstname, :i_midname, :i_email, :i_accesspass, :i_salted, :status)"; 
									
					$igweze_prep = $conn->prepare($ebele_mark);	 
					$igweze_prep->bindValue(':i_title', $title); 					
					$igweze_prep->bindValue(':i_lastname', $lname);
					$igweze_prep->bindValue(':i_firstname', $fname);
					$igweze_prep->bindValue(':i_midname', $mname);
					$igweze_prep->bindValue(':i_email', $email);
					$igweze_prep->bindValue(':i_accesspass', $userPass);
					$igweze_prep->bindValue(':i_salted', $salted);
					$igweze_prep->bindValue(':status', $fiVal); 
	
					if ($igweze_prep->execute()){  /* if sucessfully */   

						$lastID = $conn->lastInsertId($staffTB);
								
						echo "<script type='text/javascript'>  
							$('#modal-load-div').load('staff-bio.php', { 'teacherID': $lastID, 'show_more': 0});
							$('#load-wiz-info').load('staffs-info.php'); 
							hidePageLoader(); 
						</script>"; exit;  

					}else{  /* display error */ 

						$msg_e = "<span>Ooops,  An Error Has occur while trying  to create new staff profile, please try again</span>";
						echo $errorMsg.$msg_e.$eEnd;
						echo "<script type='text/javascript'>  hidePageLoader(); </script>"; exit;

					}
					
				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				}						

			}
	
		}elseif (($_REQUEST['profile']) == 'step1'){  /* save staff profile */ 

			if(isset($_FILES['uploadPic'])){

				$msg_e = "upload picture";
				
			}else{ 

				$staff_id = clean($_REQUEST['teacherID']);
				$title = clean($_REQUEST['title']);
				//$ranking = clean($_REQUEST['ranking']);
				$fname = clean($_REQUEST['fname']);
				$mname = clean($_REQUEST['mname']);
				$lname = clean($_REQUEST['lname']);
				$sex =   clean($_REQUEST['sex']);
				$dateofbirth =  $_REQUEST['dob'];
				$bloodgr =   clean($_REQUEST['bloodgr']);
				$genotype =   clean($_REQUEST['genotype']);

				$mslist = cleanInt($_REQUEST['mslist']);
				$school = cleanInt($_REQUEST['school']);
				$app_type = cleanInt($_REQUEST['app_type']);
				$d_appoint =  $_REQUEST['d_appoint'];
				$qualif = clean($_REQUEST['qualif']);
				$w_exper = clean($_REQUEST['w_exper']);
				$e_note =  clean($_REQUEST['e_note']);  

				/* script validation */ 
				
				if ($staff_id == "")  {
					
					$msg_e = "Ooops Error, could not find staff information";
					
				}elseif ($mslist == "")  {
				
					$msg_e = "Ooops Error, please select marital status";
				
				}elseif ($lname == "")  {
				
					$msg_e = "Ooops Error, please enter staff first name ";
				
				}elseif($fname == "")   {
				
					$msg_e  = "Please enter staff last name  ";
				
				}elseif (($sex == "")) {
				
					$msg_e = "Ooops Error, please select staff gender ";
				
				}elseif ($dateofbirth == "") {
				
					$msg_e = "Ooops Error, please enter staff date of birth";
				
				}elseif ($bloodgr == "") {
				
					$msg_e = "Ooops Error, please enter staff blood group";
				
				}elseif ($school == "") {
				
					$msg_e = "Ooops Error, please enter school staff is handling";
				
				}elseif ($app_type == "") {
				
					$msg_e = "Ooops Error, please select staff appointment type";
				
				}else {  /* update information */  

					try { 

						if($mname != ""){
							$mname = substr($mname, 0, 1);
						}
						//$new_name = "$lname $fname $mname"; 
						$titleVal = wizSelectArray($title, $title_list); 
						$staff_t_name = "$titleVal $lname $mname"; 

						$ebele_mark = "UPDATE $staffTB SET
						
										i_title = :i_title,
										i_firstname = :i_firstname,
										i_midname = :i_midname,
										i_lastname = :i_lastname,
										i_gender = :i_gender,
										i_dob = :i_dob,
										bloodgp = :bloodgp,
										genotype = :genotype,
										i_mar_status = :mslist,
										school = :school,
										app_type = :app_type,
										d_appoint = :d_appoint,
										qualif = :qualif,
										w_exper = :w_exper,
										e_note = :e_note  
										
										
										WHERE t_id = :t_id";
										
						$igweze_prep = $conn->prepare($ebele_mark);	
						
						$igweze_prep->bindValue(':i_title', $title);
						$igweze_prep->bindValue(':i_firstname', $fname);
						$igweze_prep->bindValue(':i_midname', $mname);
						$igweze_prep->bindValue(':i_lastname', $lname);
						$igweze_prep->bindValue(':i_gender', $sex);
						$igweze_prep->bindValue(':i_dob', $dateofbirth);
						$igweze_prep->bindValue(':bloodgp', $bloodgr);
						$igweze_prep->bindValue(':genotype', $genotype);
						$igweze_prep->bindValue(':mslist', $mslist);
						$igweze_prep->bindValue(':school', $school);
						$igweze_prep->bindValue(':app_type', $app_type);
						$igweze_prep->bindValue(':d_appoint', $d_appoint);
						$igweze_prep->bindValue(':qualif', $qualif);
						$igweze_prep->bindValue(':w_exper', $w_exper);
						$igweze_prep->bindValue(':e_note', $e_note); 
						$igweze_prep->bindValue(':t_id', $staff_id);
												
						if ($igweze_prep->execute()) {  /* if sucessfully */ 

							$msg_s = "Staff personal information was successfully saved.";						
							//echo "<script type='text/javascript'> //$('#upload-staff-img').val(0); //$('#saveStaff1').slideUp(2000);  </script>";
							
							echo '
							<script type="text/javascript"> 
								$(".staff-name-comp").html("'.$staff_t_name.'");  
							</script>'; 
							
						}else {  /* display error */ 

							$msg_e = "Ooops,  an error has occur while trying to save staff profile, please try again";

						}  

					}catch(PDOException $e) {
				
						fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
					
					}

				}

			}
	
		}elseif (($_REQUEST['profile']) == 'step2') {  /* save staff profile */ 

			$staff_id = clean($_REQUEST['teacherID']);
			$country = clean($_REQUEST['country']);
			$state = clean($_REQUEST['state']);
			$lga = clean($_REQUEST['lga']);
			$add1 = clean($_REQUEST['add1']);
			$add2 = clean($_REQUEST['add2']);
			$city = clean($_REQUEST['city']);
			$studphone = clean($_REQUEST['i_phone']);
			$email = preg_replace("/[^A-Za-z0-9.@]/", "", $_REQUEST['email']);
			
			/* script validation */ 
			
			if ($staff_id == "")  {
				
				$msg_e = "Ooops Error, could not find staff information";
				
			}elseif (($country == "")) {
				
				$msg_e = "Ooops Error, please select staff nationality ";
				
			}elseif (($state == "")) {
				
				$msg_e = "Ooops Error, please select staff state ";
				
			}elseif($city == "")   {
				
				$msg_e = "Ooops Error, please enter staff city ";
				
			} elseif($add1 == "") {
				
				$msg_e = "Ooops Error, please enter staff current address ";
				
			} elseif($add2 == "") {
				
				$msg_e = "Ooops Error, please enter staff parmanent address ";
				
			}elseif($studphone == "")  {
				
				$msg_e = "Ooops Error, please enter staff mobile number ";
				
			} else {  /* update information */  

				try { 
		
					$ebele_mark = "UPDATE $staffTB SET 

									i_country = :i_country,
									i_state = :i_state,                 								
									i_city = :i_city,
									i_add_fi = :i_add_fi,
									i_add_se = :i_add_se,
									i_phone = :i_phone


									WHERE t_id = :t_id";
									
					$igweze_prep = $conn->prepare($ebele_mark);	 
			
					$igweze_prep->bindValue(':i_country', $country);
					$igweze_prep->bindValue(':i_state', $state);
					//$igweze_prep->bindValue(':i_lga', $lga); i_lga = :i_lga,
					$igweze_prep->bindValue(':i_city', $city);
					$igweze_prep->bindValue(':i_add_fi', $add1);
					$igweze_prep->bindValue(':i_add_se', $add2);
					$igweze_prep->bindValue(':i_phone', $studphone); 
					$igweze_prep->bindValue(':t_id', $staff_id);
											
					if ($igweze_prep->execute()) {  /* if sucessfully */ 

						$msg_s = "Staff contact information was successfully saved.";						
						//echo "<script type='text/javascript'> $('#saveStaff2').slideUp(2000);  </script>";
						
					}else {  /* display error */ 

						$msg_e = "Ooops,  an error has occur while trying to save staff profile, please try again";

					}

				}catch(PDOException $e) {
			
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
				
				}

			}
	
		}elseif (($_REQUEST['profile']) == 'step3') {  /* save staff profile */ 

			$staff_id = clean($_REQUEST['teacherID']);
			$salary = clean($_REQUEST['salary']);
			$taxid = clean($_REQUEST['taxid']); 
			$bank = clean($_REQUEST['bank']);
			$swift = clean($_REQUEST['swift']);
			$accname = clean($_REQUEST['accname']); 
			$accnum = clean($_REQUEST['accnum']);
			
			/* script validation */ 
			
			if ($staff_id == "")  {
				
				$msg_e = "Ooops Error, could not find staff information";
				
			}elseif (($salary == "")) {
				
				$msg_e = "Ooops Error,enter staff salary";
				
			}elseif($bank == "") {
				
				$msg_e = "Ooops Error, please enter staff bank name";
				
			}elseif($accname == "") {
				
				$msg_e = "Ooops Error, please enter staff acccount name";
				
			}elseif($accnum == "") {
				
				$msg_e = "Ooops Error, please enter staff  acccount number"; 
			
			} else {  /* update information */  

				try { 
		
					$ebele_mark = "UPDATE $staffTB SET 

									salary = :salary,
									taxid = :taxid, 
									bank = :bank,
									swift = :swift,
									accname = :accname, 
									accnum = :accnum  

									WHERE t_id = :t_id";
									
					$igweze_prep = $conn->prepare($ebele_mark);	 
			
					$igweze_prep->bindValue(':salary', $salary);
					$igweze_prep->bindValue(':taxid', $taxid); 
					$igweze_prep->bindValue(':bank', $bank);
					$igweze_prep->bindValue(':swift', $swift); 					
					$igweze_prep->bindValue(':accname', $accname);
					$igweze_prep->bindValue(':accnum', $accnum);
					$igweze_prep->bindValue(':t_id', $staff_id);
											
					if ($igweze_prep->execute()) {  /* if sucessfully */ 

						$msg_s = "Staff payroll and bank information was successfully saved.";						
						//echo "<script type='text/javascript'> $('#saveStaff3').slideUp(2000);  </script>";
						
					}else {  /* display error */ 

						$msg_e = "Ooops,  an error has occur while trying to save staff profile, please try again";

					}

				}catch(PDOException $e) {
			
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
				
				}

			}
	
		}elseif (($_REQUEST['profile']) == 'step4') {  /* save staff profile */ 

			$staff_id = clean($_REQUEST['teacherID']);
			$sponphone = clean($_REQUEST['sponphone']);
			$sponsor = clean($_REQUEST['sponsor']);
			$sponadd = clean($_REQUEST['sponadd']);
			$sponocc = clean($_REQUEST['sponocc']);
			$relatn = clean($_REQUEST['relatn']);
			$sponphone2 = clean($_REQUEST['sponphone2']);
			$sponsor2 = clean($_REQUEST['sponsor2']);
			$sponadd2 = clean($_REQUEST['sponadd2']);
			$sponocc2 = clean($_REQUEST['sponocc2']);
			$relatn2 = clean($_REQUEST['relatn2']);
			
			/* script validation */ 
			
			if ($staff_id == "")  {
				
				$msg_e = "Ooops Error, could not find staff information";
				
			}elseif($sponsor == "")   {
				
				$msg_e = "Ooops Error, please enter staff 1st gurantor name";
				
			} elseif($sponphone == "")   {
				
				$msg_e = "Ooops Error, please enter staff 1st gurantor phone number";
				
			} elseif($sponadd == "")   {
				
				$msg_e = "Ooops Error, please enter staff 1st gurantor address";
	
			}elseif($sponocc == "")   {
				
				$msg_e = "Ooops Error, please enter staff 1st gurantor occupation";
	
			}elseif($relatn == "")   {
				
				$msg_e = "Ooops Error, please enter staff relationship with 1st gurantor ";
	
			} else {  /* update information */  

				try { 												
		
					$ebele_mark = "UPDATE $staffTB SET 
								
									i_sponsor = :i_sponsor,
									i_spo_phone = :i_spo_phone,
									i_spo_add = :i_spo_add,
									sponocc = :sponocc,
									relatn = :relatn,
									sponsor2 = :sponsor2,
									sponphone2 = :sponphone2,
									sponadd2 = :sponadd2,
									sponocc2 = :sponocc2,
									relatn2 = :relatn2


									WHERE t_id = :t_id";
									
					$igweze_prep = $conn->prepare($ebele_mark);	 
					$igweze_prep->bindValue(':i_sponsor', $sponsor);
					$igweze_prep->bindValue(':i_spo_phone', $sponphone);
					$igweze_prep->bindValue(':i_spo_add', $sponadd);
					$igweze_prep->bindValue(':sponocc', $sponocc);
					$igweze_prep->bindValue(':relatn', $relatn);
					$igweze_prep->bindValue(':sponsor2', $sponsor2);
					$igweze_prep->bindValue(':sponphone2', $sponphone2);
					$igweze_prep->bindValue(':sponadd2', $sponadd2);
					$igweze_prep->bindValue(':sponocc2', $sponocc2);
					$igweze_prep->bindValue(':relatn2', $relatn2);
					$igweze_prep->bindValue(':t_id', $staff_id); 
					
					if ($igweze_prep->execute()) {  /* if sucessfully */ 

						$msg_s = "Staff gurantor information was successfully saved.";						
						//echo "<script type='text/javascript'> $('#saveStaff4').slideUp(2000);  </script>";
						
					}else {  /* display error */ 

						$msg_e = "Ooops,  an error has occur while trying to save staff gurantor info, please try again";

					} 

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				} 

			}
			
		}elseif (($_REQUEST['profile']) == 'picture'){  /* save staff profile picture */ 
		
			$staff_id = clean($_REQUEST['teacherID']); 
				
			$picturePath = $staff_pic_ext; /* picture path */
			
			$filePic = "uploadPic"; /* picture file name */
			$pageDesc = "Staff picture";

			
			$script_scroll_cm = "
			$('#uploadStaffPic').val('');
			$('.fob-btn-loader').slideUp(4000);
			$('.fob-btn-div').slideDown(5000); ";
			
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
						
							removeTeacherPicSign($conn, $staff_id, $fiVal);  /* remove school staffs/teachers picture */ 

							$ebele_mark = "UPDATE $staffTB SET 
											
												i_picture = :i_picture

												WHERE t_id = :t_id";
												
							$igweze_prep = $conn->prepare($ebele_mark);	
							$igweze_prep->bindValue(':i_picture', $uploadedPic);
							$igweze_prep->bindValue(':t_id', $staff_id);	

							if($igweze_prep->execute()){  /* insert picture name to database */ 
									
								$preview_img = $picturePath.$uploadedPic;
							 
								$msg_s = "$pageDesc was successfully uploaded";									
								echo $succesMsg.$msg_s.$sEnd;
								echo "<script type='text/javascript'> 
										$('.staff-picture-comp').attr('src', '$preview_img?rand=' + Math.random());  						
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
					
		
		}elseif (($_REQUEST['profile']) == 'documents') {  /* save staff profile documents */ 
		
			$staff_id = clean($_REQUEST['teacherID']);
			$upload = clean($_REQUEST['upload_t']);

			$upload = trim($upload);			

			$picturePath = $staff_doc_ext; /* picture path */
			
			//$filePic = "uploadSign"; /* picture file name */
			//$pageDesc = "Staff documents";

			$filePic = $staff_upload_arr["$upload"]["name"];
			$pageDesc = $staff_upload_arr["$upload"]["desc"];
			$field = $staff_upload_arr["$upload"]["field"];
			$preview = $staff_upload_arr["$upload"]["preview"];

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
								
							removeTeacherPicSign($conn, $staff_id, $seVal);  /* remove school staffs/teachers documents */ 

							$ebele_mark = "UPDATE $staffTB SET 
										
											$field = :i_sign

											WHERE t_id = :t_id";
											
							$igweze_prep = $conn->prepare($ebele_mark);	
							$igweze_prep->bindValue(':i_sign', $uploadedPic);
							$igweze_prep->bindValue(':t_id', $staff_id);									

							if($igweze_prep->execute()){  /* insert picture name to database */
								
								$preview_img = $picturePath.$uploadedPic;
 
								$msg_s = "$pageDesc was successfully uploaded";									
								echo $succesMsg.$msg_s.$sEnd;								
								echo "<script type='text/javascript'> 
									$('#".$preview."').attr('src', '$preview_img?rand=' + Math.random());
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
					
		
		}elseif (($_REQUEST['profile']) == 'access'){  /* save staff profile */

            $old_pass = strip_tags($_REQUEST['old_pass']);
			$new_pass = strip_tags($_REQUEST['new_pass']);
	        $confirm_new = strip_tags($_REQUEST['confirm_new']); 

			$uppercase = preg_match('@[A-Z]@', $new_pass);
            $lowercase = preg_match('@[a-z]@', $new_pass);
            $number    = preg_match('@[0-9]@', $new_pass);
            $specialChars = preg_match('@[^\w]@', $new_pass);
	         
 			try { 
 
			 	$checkDetail =  staffLoginData($conn, $_SESSION['adminID']);  /* school staffs/teachers password information */ 
			 
			 	list ($staffID, $staffUser, $check_old_pass, $staffName, $staff_fobrain_grdQ, $staff_fobrain_grd, $userAccess) = 
				explode ("@(.$*S*$.)@", $checkDetail); 

				/* script validation */ 	
             
				if ($old_pass == '') {

					$msg_e = '* Please enter your old password ';
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'> hidePageLoader(); </script>";				
					exit;

				}elseif ($new_pass == '') {

					$msg_e = '* Please enter your new password ';
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'> hidePageLoader(); </script>";				
					exit;

				}elseif(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($new_pass) < 8) {
             
					$msg_e  = "Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character. eg 1@Fobrain";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'> hidePageLoader(); </script>";				
					exit;
	
				}elseif ($confirm_new == "") {

					$msg_e = '* Please confirm your new password ';
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'> hidePageLoader(); </script>";				
					exit;

				}elseif ($confirm_new != $new_pass) {         

					$msg_e = "*Error, your new  and  confirmation password dose not match. please try again  ";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'> hidePageLoader(); </script>";				
					exit;

				}elseif (!password_verify($old_pass, $userAccess)) {		

					$msg_e = '* Error, your old password is incorrect, please try again '; 
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'> hidePageLoader(); </script>";				
					exit; 

				} else {  /* update information */ 

					$fi_rand = randomString($charset, 16);  

					$new_pass = password_hash($new_pass, PASSWORD_BCRYPT, $options_bcrypt);

					$ebele_mark = "UPDATE $staffTB SET
									
													i_accesspass = :i_accesspass,
													i_salted = :i_salted 
													
													WHERE t_id = :t_id";
													
					$igweze_prep = $conn->prepare($ebele_mark);	
					$igweze_prep->bindValue(':i_accesspass', $new_pass);
					$igweze_prep->bindValue(':i_salted', $fi_rand); 
					$igweze_prep->bindValue(':t_id', $staffID);

					if ($igweze_prep->execute()) {  /* if sucessfully */ 
												
						$msg_s = "Your password was sucessfully change.";
						echo $succesMsg.$msg_s.$sEnd;
						echo "<script type='text/javascript'>  hidePageLoader(); </script>"; exit;
							
							
					}else{  /* display error */ 
							
						$msg_e = "Your password was not change, please try again";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'> hidePageLoader(); </script>";				
						exit; 
							
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