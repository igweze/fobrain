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
	This script handle student online registration
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

     define('fobrain', 'igweze');  /* define a check for wrong access of file */

        require 'fobrain-config-s.php';  /* load fobrain configuration files */
      
		if ($_REQUEST['profile'] == 'accept') {

			$regNum =  $_REQUEST['regnum'];
			$studentID = $_REQUEST['studentID'];
			$schLevel = $_REQUEST['level'];			
			$sessionClass =  $_REQUEST['class'];
			$en_term =  $_REQUEST['term'];
			$regDate =  date("Y-m-d H:i:s"); //strtotime(date("Y-m-d H:i:s"));
			
			list ($schoolAbbr, $regNum) = explode('/', $regNum);
			list($sessionID, $class) = explode('-', $sessionClass);
			list ($school, $en_level) = explode('-', $schLevel);
			
			$errorSchool = true; 
			
			/* script validation */ 
			
			if($school == 1){  /* check school type */ 
				
				require_once ($fobrainDir.$fobrainNurConfig);  /* include school configuration script */ 
				//$schoolExt = $fobrainNurAbr;
				
			}elseif($school == 2){  /* check school type */ 
				
				require_once ($fobrainDir.$fobrainPRIConfig);  /* include school configuration script */ 
				//$schoolExt = $fobrainPriAbr;
				
			}elseif($school == 3){  /* check school type */ 
				
				require_once ($fobrainDir.$fobrainSECConfig);  /* include school configuration script */ 
				//$schoolExt = $fobrainSecAbr;
				
			}else{  /* display error */ 
				
				$errorSchool = false; 
				
			}



			if ($regNum == "")  {
				
				$msg_e = "* Ooops Error, could not find student information. Please refresh the page and try again";
				
			}elseif($errorSchool == false)   {
			
				echo $infoMsg.$noConnCongfigMsg.$iEnd; exit;  /* display error */ 
			
			}elseif (studentExitsRV($conn, $regNum) == $foreal)  {
			
				$msg_e .= "* Ooops Error, Student with this <b> Reg No $regNum </b>already  exists in database";
			
			}elseif ($studentID == "")  {
			
				$msg_e .= "* Ooops Error, could not find new student registration infomation. It might have been
				deleted. Thanks";
			
			}elseif($class == "")   {
			
				$msg_e .= "* Ooops Error, please select new student class to enroll";
			
			}elseif ($sessionID == "")  {
			
				$msg_e .= "* Ooops Error, please select new student class to enroll";
			
			}elseif($en_level == "")   {
			
				$msg_e  = "* Ooops Error, please select new student level to enroll";
			
			}elseif($en_term == "")   {
			
				$msg_e  = "* Ooops Error, please select new student' s entry term";
			
			}else {  /* insert information */  

				try { 

					$regNum = trim($regNum); 
					
					$ebele_mark = "SELECT stu_id, i_stupic, i_school, i_level, i_firstname, i_midname, i_lastname, i_gender,
									i_country, i_state, i_add_fi, i_add_se, i_email, i_sponsor, i_spo_add, bloodgp, 
									genotype, i_spon_occup
		
										FROM $studentOnlineRegTB
		
										WHERE stu_id = :stu_id";
								
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':stu_id', $studentID);
							
						$igweze_prep->execute();
						
						$rows_count = $igweze_prep->rowCount(); 
						
						if($rows_count == $foreal) {  /* check array is empty */
						
							while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {  /* loop array */	
							
									$stu_id = $row['stu_id'];
									$school = $row['i_school'];
									//$level = $row['i_level'];
									$applyPic = $row['i_stupic'];
									$fname = $row['i_firstname'];
									$lname = $row['i_lastname'];
									$mname = $row['i_midname'];
									$gender = $row['i_gender'];
									$dob = $row['i_dob'];
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

							mt_srand((double)microtime() * 1000000);
							
							if($generatePass == $foreal){  /* check generate password status */
	
								$userPass = randomString($charset, 8);  /* generate password */
								$spon_access = randomString($charset, 5);  /* generate password */
			
							}else{
			
								$userPass = "password";
								$spon_access = "password";
			
							} 		  
							
							$schoolType = $school_list[$school];									
							
							$show_tasks_div = $seVal;
				
							if($schoolExt == $fobrainNurAbr){  /* check school type */ 
									
								require_once ($fobrainAdminDir.'fobrain-nur-bio.php');  /* school registration script */ 
									
							}else{
								
								require_once ($fobrainAdminDir.'fobrain-prisec-bio.php');  /* school registration script */ 
							} 

						}else{  /* display error */	 
					
							$msg_e = "* Ooops Error, could not find new student registration infomation. It might have been removed. Thanks";
					
						} 

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				} 

					if ($msg_s) {

						echo $succesMsg.$msg_s.$sEnd; 
						echo "<script type='text/javascript'>  							
								$('#reg-tr-$studentID').fadeOut(1000); 
								$('.new-reg-div').fadeOut(2000); 								
								$('#totalRegsCount').html($totalRegis);
								hidePageLoader(); 
						
						</script>";exit;
 
									
					}						
        	
				}
			
			}elseif ($_REQUEST['profile'] == 'remove') {


				$studentID = clean($_REQUEST['studentID']);
				
				/* script validation */

				if ($studentID == "")  {
         		
					$msg_e .= "* Ooops Error, could not find new student registration infomation. It might have been removed. Thanks";
	   			
				}else {  /*  remove information */ 

		 			try { 
					
						$applyPic = onlineRegPicture($conn, $studentID);  /* online registration picture */
						
						$applyPicture = $applyPSrc.$applyPic;
					  
						if (($applyPic != '') && (file_exists($applyPicture))){  
							  
							  unlink($applyPicture);  /* removeon picture */		
							  
						} 
						 
						removeRegistraion($conn, $studentID);  /* remove student online registration */
						$totalRegis = registrationCounter($conn);  /* student online registration counter */	


						$msg_s = 'Student registration was successfully removed';
						echo $succesMsg.$msg_s.$sEnd; 
						echo "<script type='text/javascript'>  							
								$('#reg-tr-$studentID').fadeOut(1000); 
								$('.new-reg-div').fadeOut(2000); 								
								$('#totalRegsCount').html($totalRegis);
								hidePageLoader(); 
						
						</script>";exit;
					

				 	}catch(PDOException $e) {
  			
						fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					}  		
        	
				}
			
			}else{
			
					echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
			
			}
 						
			 
			if ($msg_e) {

				echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   hidePageLoader();  </script>";
				exit;
									
			}	
			
exit; 
?>