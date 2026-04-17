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
	This script handle staff change password
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
} 

     	define('fobrain', 'igweze');  /* define a check for wrong access of file */

        require 'fobrain-config.php';  /* load fobrain configuration files */
		
      	if($_REQUEST['access'] = 'update') {	 

            $old_pass = clean($_REQUEST['old_pass']);
			$new_pass = clean($_REQUEST['new_pass']);
	        $confirm_new = clean($_REQUEST['confirm_new']); 

			$uppercase = preg_match('@[A-Z]@', $new_pass);
            $lowercase = preg_match('@[a-z]@', $new_pass);
            $number    = preg_match('@[0-9]@', $new_pass);
            $specialChars = preg_match('@[^\w]@', $new_pass);
	         
 			try { 

			 	$checkDetail =  staffLoginData($conn, $adminUser);  /* school staffs/teachers password information */ 
			 
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
		
		exit; 
?>
