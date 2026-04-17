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
	This script handle online registration
	------------------------------------------------------------------------*/

	define('fobrain', 'igweze');  /* define a check for wrong access of file */
	require_once 'sources/functions/fobrain-dir-in.php';  /* include configuration script */	
	require_once $fobrainFunctionDir;  /* load script functions */			
	require ($fobrainDBConnectIndDir);   /* load connection string */ 
		
	if (($_REQUEST['query']) == 'register') {

		$school = clean($_REQUEST['school']);
		$class = clean($_REQUEST['class']);
		$fname = clean($_REQUEST['fname']);
		$mname = clean($_REQUEST['mname']);
		$lname = clean($_REQUEST['lname']);
		$sex =   clean($_REQUEST['sex']);
		$dateofbirth = cleanDate($_REQUEST['dob']);
		$bloodgr =   clean($_REQUEST['bloodgr']);
		$genotype =   clean($_REQUEST['genotype']);
		$country = clean($_REQUEST['country']);
		$state = clean($_REQUEST['state']);
		$lga = clean($_REQUEST['lga']);
		$add1 = clean($_REQUEST['add1']);
		$add2 = clean($_REQUEST['add2']);
		$city = clean($_REQUEST['city']);
		$studphone = clean($_REQUEST['studphone']);
		$email = preg_replace("/[^A-Za-z0-9.@]/", "", $_REQUEST['email']); 
		$sponphone = clean($_REQUEST['sponphone']);
		$soccup = clean($_REQUEST['soccup']);
		$sponsor = clean($_REQUEST['sponsor']);
		$sponadd = clean($_REQUEST['sponadd']);
		//$sponphone2 = clean($_REQUEST['sponphone2']);
		//$sponsor2 = clean($_REQUEST['sponsor2']);
		//$sponadd2 = clean($_REQUEST['sponadd2']);
		//$soccup2 = clean($_REQUEST['soccup2']);
		$time = strtotime(date("Y-m-d H:i:s"));	 
		
		/* script validation */ 
		
		if ($school == "")  {
		
			$msg_e = "Ooops error, please choose school to enroll to";
		
		}elseif ($class == "")  {
		
			$msg_e = "Ooops error, please choose class to enroll to";
		
		}elseif ($lname == "")  {
		
			$msg_e = "Ooops error, please enter first name";
		
		}elseif($fname == "")   {
		
			$msg_e  = "Ooops error, please enter last name";
		
		}elseif (($sex == "")) {
		
			$msg_e = "Ooops error, please select gender";
		
		}elseif ($dateofbirth == "") {
		
			$msg_e = "Ooops error, please enter date of birth";
		
		}elseif ($bloodgr == "") {
		
			$msg_e = "Ooops error, please enter blood group";
		
		}elseif (($country == "")) {
			
			$msg_e = "Ooops error, please select nationality";
			
		}elseif (($state == "")) {
			
			$msg_e = "Ooops error, please enter State/District";
			
		}elseif($city == "")   {
			
			$msg_e = "Ooops error, please enter city ";
			
		}elseif($add1 == "") {
			
			$msg_e = "Ooops error, please enter parmanent address";
			
		}elseif($sponsor == "")   {
			
			$msg_e = "Ooops error, please enter sponsor name";
			
		}elseif($sponphone == "")   {
			
			$msg_e = "Ooops error, please enter sponsor phnone no";
			
		}elseif($soccup == "")   {
			
			$msg_e = "Ooops error, please enter sponsor occupation";
			
		}elseif($sponadd == "")   {
			
			$msg_e = "Ooops error, please enter sponsor address";

		}else {  /* insert information */   

			
			$regName = "$lname $fname $mname";  

			$picturePath = $applyPSrc; /* picture path */
			
			$filePic = "uploadPic"; /* picture file name */
			$pageDesc = "your picture";
			
			/* call igweze file uploader */
			$uploadPicData = igwezeFileUploader($filePic, $picturePath, ($oneMB * 2), $validPicExt, $validPicType, $allowedPicExt, $fileType = "Picture", $fiVal); 
				
			if (is_array($uploadPicData['error'])) {  /* check if any upload error */
					
				$msg_e = '';
					
				foreach ($uploadPicData['error'] as $msg) {
					$msg_e .= $msg.'<br />';     /* display error messages */
				}
				
				echo $errorMsg.$msg_e.$eEnd;
				echo "<script type='text/javascript'> 
							$('.fob-btn-loader-reg').fadeOut(2000); 
							$('.fob-btn-div-reg').fadeIn(4000);
					</script>";exit;
				
				
			} else {  /* upload picture and insert information */
				
				$uploadedPic = $uploadPicData['refilename']; /* uploaded picture file */
				
				if ($uploadedPic != "") {
						
					if (move_uploaded_file($_FILES[$filePic]['tmp_name'], $picturePath.$uploadedPic )) { /* move uploaded file to its path */
							
							
						try { 

							
							$ebele_mark = "INSERT INTO $studentOnlineRegTB 
										(i_stupic, i_school, i_level, i_firstname, i_midname, i_lastname, i_gender, i_dob, 
										bloodgp, genotype, i_country, i_state, i_city, i_add_fi, i_add_se, i_stu_phone, 
										i_email,i_sponsor, i_spo_phone, i_spon_occup, i_spo_add, reg_date)
								
										VALUES (:i_stupic, :i_school, :i_level, :i_firstname, :i_midname, :i_lastname, :i_gender,
										:i_dob, :bloodgp, :genotype, :i_country, :i_state, :i_city, :i_add_fi,
										:i_add_se, :i_stu_phone, :i_email, :i_sponsor, :i_spo_phone, :i_spon_occup, :i_spo_add, :reg_date)";
											
							$igweze_prep = $conn->prepare($ebele_mark);	
							$igweze_prep->bindValue(':i_stupic', $uploadedPic);
							$igweze_prep->bindValue(':i_school', $school);
							$igweze_prep->bindValue(':i_level', $class);
							$igweze_prep->bindValue(':i_firstname', $fname);
							$igweze_prep->bindValue(':i_midname', $mname);
							$igweze_prep->bindValue(':i_lastname', $lname);
							$igweze_prep->bindValue(':i_gender', $sex);
							$igweze_prep->bindValue(':i_dob', $dateofbirth);
							$igweze_prep->bindValue(':bloodgp', $bloodgr);
							$igweze_prep->bindValue(':genotype', $genotype);
							$igweze_prep->bindValue(':i_country', $country);
							$igweze_prep->bindValue(':i_state', $state);
							$igweze_prep->bindValue(':i_city', $city);
							$igweze_prep->bindValue(':i_add_fi', $add1);
							$igweze_prep->bindValue(':i_add_se', $add2);
							$igweze_prep->bindValue(':i_stu_phone', $studphone);
							$igweze_prep->bindValue(':i_email', $email);
							$igweze_prep->bindValue(':i_sponsor', $sponsor);
							$igweze_prep->bindValue(':i_spo_phone', $sponphone);
							$igweze_prep->bindValue(':i_spon_occup', $soccup);
							$igweze_prep->bindValue(':i_spo_add', $sponadd);
							$igweze_prep->bindValue(':reg_date', $time);  
							//$igweze_prep->bindValue(':i_lga', $lga); i_lga,  :i_lga,
							
							if($igweze_prep->execute()){  /* insert picture name to database */
								
								$imgSrc = $picturePath.$uploadedPic;	 
								$msg_s = "$regName, your online registration was successfully. We will get back to you soon. Thanks";	
								echo $succesMsg.$msg_s.$sEnd; echo $scroll_up; 	
								echo "<script type='text/javascript'>   
									$('#frmsave-regis')[0].reset();  
									$('.fob-btn-loader-reg').fadeIn(2000); 
                    				$('.fob-btn-div-reg').fadeOut(4000);
									$('#modal-reg-div').modal('hide');	
								</script>";  
								exit;									

							}else{ /* display error messages */ 
								
								$msg_e = "Ooops, an error has occur while trying to save $pageDesc. Please try again or check your network connection!!!";
								echo $errorMsg.$msg_e.$eEnd;
								echo "<script type='text/javascript'> 
											$('.fob-btn-loader-reg').fadeOut(2000); 
											$('.fob-btn-div-reg').fadeIn(4000);
									</script>";exit;

							} 

						}catch(PDOException $e) { 
							
							fobrainDie( 'Ooops Database Error: ' . $e->getMessage());

						}
							
							
					}else{ /* display error messages */ 
						
						$msg_e = "Ooops, an error has occur while trying to save $pageDesc. Please try again or check your network connection!!!";
						echo $errorMsg.$msg_e.$eEnd;
						echo "<script type='text/javascript'> 
									$('.fob-btn-loader-reg').fadeOut(2000); 
									$('.fob-btn-div-reg').fadeIn(4000);
							</script>";exit;
							
					}
						
				}else{ /* display error messages */ 
					
					$msg_e = "Ooops, an error has occur while trying to save $pageDesc. Please try again or check your network connection!!!";
					echo $errorMsg.$msg_e.$eEnd;
					echo "<script type='text/javascript'> 
								$('.fob-btn-loader-reg').fadeOut(2000); 
								$('.fob-btn-div-reg').fadeIn(4000);
						</script>";exit; 						

				}	
				
				
			} 		 


		}

	}else{
	
		echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
	
	} 


	if ($msg_e) { 
		
		echo $errorMsg.$msg_e.$eEnd;
		echo "<script type='text/javascript'> 
                    $('.fob-btn-loader-reg').fadeOut(2000); 
                    $('.fob-btn-div-reg').fadeIn(4000);
            </script>";exit; 
								
	}	
	
exit;
?>