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
	This script handle admin password recovery
	------------------------------------------------------------------------*/

session_start();
session_unset();
session_destroy();
session_start();

		define('fobrain', 'igweze');  /* define a check for wrong access of file */ 
		
		setcookie('googtrans', '');
		
		require_once 'sources/functions/fobrain-dir-in.php';  /* include configuration script */		
		require_once $fobrainFunctionDir;  /* load script functions */
		
		if ($_REQUEST['profile'] == 'reset') {  /* check and send admin reset password link */ 
		
			$userMail = cleanEmail($_REQUEST['userMail']);
				
			$userMail = clean($userMail);				
			$userMail = strtolower($userMail); 

			try { 

				require ($fobrainDBConnectIndDir);   /* load connection string */ 	
				
				$checkDetail =  staffLoginData($conn, $userMail);  /* school staffs/teachers password details */ 			 
				list ($tID, $staffUser, $checkedPass, $staffName, $staff_fobrain_grdQ, $userGrade, $userAccess) = 
				explode ("@(.$*S*$.)@", $checkDetail); 
				 
			}catch(PDOException $e) {

				fobrainDie( 'Ooops Database Error: ' . $e->getMessage());

			}

			/* script validation */ 
			
			if (($userMail == '') || (!validateMail($userMail))){
			
				$msg_e = "Ooops Error, please enter a valid email address";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> 
						$('.fob-btn-loader').fadeOut(2000); 
						$('.fob-btn-div').fadeIn(4000); 
				</script>";exit;
			
			}elseif ($tID == "") {
			
				$msg_e = "Ooops Error, invalid admin account. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> 
						$('.fob-btn-loader').fadeOut(2000); 
						$('.fob-btn-div').fadeIn(4000); 
				</script>";exit;
			
			}elseif($userGrade == $i_false){

				$msg_e = "* Ooops Error, you dont have any staff login priviledge assign to you.";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> 
						$('.fob-btn-loader').fadeOut(2000); 
						$('.fob-btn-div').fadeIn(4000); 
				</script>";exit;

			}else{

				$recovTime = strtotime(date("Y-m-d H:i:s"));

				$resetVal = randomString($charset, 44);
				
				$ebele_mark = "UPDATE $staffTB 
				
								SET recov_info = :recov_info,
								
								recov_time = :recov_time
									
								WHERE i_email = :i_email";

				$igweze_prep = $conn->prepare($ebele_mark);
				$igweze_prep->bindValue(':recov_info', $resetVal);
				$igweze_prep->bindValue(':recov_time', $recovTime);
				$igweze_prep->bindValue(':i_email', $userMail); 

				if ($igweze_prep->execute()){
				 
					$resetLink = $fobrainPortalRoot.'?r='.$resetVal.'&mail='.$userMail;
				 
					$subject = 'Information to Reset your Password - fobrain';

					$message = "Hi $userMail, you have requested for a password recovery on your account.<br /><br />

					Meanwhile, your password has not been changed yet, but you can reset it here : Click the link below <br />
					$resetLink  <br /><br />
				   
				   
					Best Regards, <br /><br />
					fobrain";


					wizMailer($userMail, $subject, $message, "no-reply@fobrain.com"); 
					$msg_s = "A link have been sent to your email address ($userMail). Please check your inbox or spam folder for the mail and click on the link to reset your password";
					echo $succesMsg.$msg_s.$sEnd;
					echo "<script type='text/javascript'>   
						$('#frmupdatePass, #frmrecoverPass').fadeOut(2000);  
						$('#frmLogin').fadeIn(2500);  
						$('.fob-btn-loader').fadeOut(2000); 
						$('.fob-btn-div').fadeIn(4000); 
					</script>";exit;

				}else{


					$msg_e = "Ooops, an error has occur while trying to reset your password. Please try again or check your network connection!!!";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'> 
						$('.fob-btn-loader').fadeOut(2000); 
						$('.fob-btn-div').fadeIn(4000); 
					</script>";exit;


				} 

			} 

			 	
		}elseif($_REQUEST['profile'] = 'update') {  /* reset admin password */ 	 
 
			$new_pass = clean($_REQUEST['new_pass']);
	        $confirm_new = clean($_REQUEST['confirm_new']);
			$userMail = cleanEmail($_REQUEST['user-mail']);

			$uppercase = preg_match('@[A-Z]@', $new_pass);
            $lowercase = preg_match('@[a-z]@', $new_pass);
            $number    = preg_match('@[0-9]@', $new_pass);
            $specialChars = preg_match('@[^\w]@', $new_pass);
	         
 			try {
				
				/* script validation */ 
				
				if ($new_pass == '') {

					$msg_e = '* Please enter your new password ';
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'> 
						$('.fob-btn-loader').fadeOut(2000); 
						$('.fob-btn-div').fadeIn(4000); 
					</script>";exit;

				}elseif(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($new_pass) < 8) {
             
					$msg_e  = "Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character. eg 1@Fobrain";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'> 
						$('.fob-btn-loader').fadeOut(2000); 
						$('.fob-btn-div').fadeIn(4000); 
					</script>";exit;
	
				}elseif ($confirm_new == "") {

					$msg_e = '* Please confirm your new password ';
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'> 
						$('.fob-btn-loader').fadeOut(2000); 
						$('.fob-btn-div').fadeIn(4000); 
					</script>";exit;

				}elseif ($confirm_new != $new_pass) {         

					$msg_e = "*Error, your new  and  confirmation password dose not match. please try again  ";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'> 
						$('.fob-btn-loader').fadeOut(2000); 
						$('.fob-btn-div').fadeIn(4000); 
					</script>";exit;

				} else {  /* update information */  

					require ($fobrainDBConnectIndDir);   /* load connection string */ 	 

					$fi_rand = randomString($charset, 16);  

					$new_pass = password_hash($new_pass, PASSWORD_BCRYPT, $options_bcrypt);

					$ebele_mark = "UPDATE $staffTB SET
									
									i_accesspass = :i_accesspass,
									i_salted = :i_salted,
									recov_info = :recov_info,
									recov_time = :recov_time 
									
									WHERE t_id = :t_id";
													
					$igweze_prep = $conn->prepare($ebele_mark);	
					$igweze_prep->bindValue(':i_accesspass', $new_pass);
					$igweze_prep->bindValue(':i_salted', $fi_rand); 
					$igweze_prep->bindValue(':recov_info', "");
					$igweze_prep->bindValue(':recov_time', "");
					$igweze_prep->bindValue(':t_id', $staffID);
					
					if ($igweze_prep->execute()) {  /* if sucessfully */ 
									 
						$msg_s = "Your password was sucessfully updated"; 	
						echo $succesMsg.$msg_s.$sEnd;					
						
						echo "<script type='text/javascript'>  
									$('#frmupdatePass, #frmrecoverPass').fadeOut(2000);  
									$('#frmLogin').fadeIn(2500);  
									$('.fob-btn-loader').fadeOut(2000); 
									$('.fob-btn-div').fadeIn(4000); 
						</script>";  
						exit; 

					}else{  /* display error */

						$msg_e = "*Ooops error, your password was not reset, please try again";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'> 
							$('.fob-btn-loader').fadeOut(2000); 
							$('.fob-btn-div').fadeIn(4000); 
						</script>";exit;

					}

				}

			}catch(PDOException $e) {
  			
				fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			 
			}	 

		}else{  /* display error */ 
							
			echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
				
		} 
		 
				
exit;
?>