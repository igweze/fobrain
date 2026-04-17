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
	This script handle student support desk
	------------------------------------------------------------------------*/ 

if(!session_id()){
    session_start();
}

     define('fobrain', 'igweze');  /* define a check for wrong access of file */

        require 'fobrain-config.php';  /* load fobrain configuration files */	  
		
		if (($_REQUEST['msgData']) == 'support') {
		
			require_once ($fobrainCWallFunctionDir); /* load companion functions */

			try {

				$msgRecep = clean($_REQUEST['msgRecep']);
				$msgTitle = clean($_REQUEST['msgTitle']);
				$mailMsg = clean($_REQUEST['msg']);
								
				$recepID = adminWallCmailID($conn, $msgRecep);  /* admin ID check */ 
				
				/* script validation */ 
				
				if($msgRecep == ''){					
					$msg_e = "please select Admin to send support message to. Thanks"; 
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>  hidePageLoader(); </script>"; 
					exit;					
										
				}elseif ($recepID == '-') { 
				
					$msg_e = "Ooops, this admin cannot receive mail at the moment. Thanks"; 						
					echo "<script type='text/javascript'> hidePageLoader();	</script>"; 
					echo $errorMsg.$msg_e.$eEnd; 
					exit;					
										
				}elseif ($msgTitle == '') { 
				
					$msg_e = "Ooops, please type your title"; 
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>  hidePageLoader(); </script>"; 
					exit;					
										
				}elseif ($mailMsg == '') { 
				
					$msg_e = "Ooops, please type your message"; 
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>  hidePageLoader(); </script>"; 
					exit;					

				}else{  /* insert information */
				
					//checkWallRegistration($conn);  /* check student registration */ 
										
					$memberInfo = companionWallUserDetails($conn, $_SESSION['regNo'], $seVal);  /* retrieve student companion details */
					
					list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic, $m_dept, $m_faculty, $userMail, 
							$wallPic, $load_page) = explode ("##", $memberInfo);

					$time = strtotime(date("Y-m-d H:i:s"));
					$uip = $_SERVER['REMOTE_ADDR'];
					$mailMsg = str_replace('<br />', "\n", $mailMsg);
					
					$msgTitle = htmlspecialchars($msgTitle);
					$mailMsg = htmlspecialchars($mailMsg);

					$ebele_mark = "INSERT INTO $fobrainMailBoxTB (njnk_title, njnk_msg, njnk_time, njnk_status, njnk_sender_id, 
															njnk_reps_id, njnk_sender_ip, njnk_type)

										VALUES (:njnk_title, :njnk_msg, :njnk_time, :njnk_status, :njnk_sender_id, :njnk_reps_id, 
										:njnk_sender_ip, :njnk_type)";

					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':njnk_title', $msgTitle);
					$igweze_prep->bindValue(':njnk_msg', $mailMsg);
					$igweze_prep->bindValue(':njnk_time', $time);
					$igweze_prep->bindValue(':njnk_status', $foreal);
					$igweze_prep->bindValue(':njnk_sender_id', $member_id);
					$igweze_prep->bindValue(':njnk_reps_id', $recepID);
					$igweze_prep->bindValue(':njnk_sender_ip', $uip);
					$igweze_prep->bindValue(':njnk_type', $seVal); 
								
					if ($igweze_prep->execute()){  /* if sucessfully */
					
						$msg_s = "You support mail was successfully sent to ADMIN. Thanks";
						echo $succesMsg.$msg_s.$sEnd; 
						echo "<script type='text/javascript'> $('#frmSupportDesk').slideUp(500); hidePageLoader(); </script>"; exit;	

					}else{  /* display error */
						
						$msg_e = "Ooops Something went wrong while sending your message, please try again";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'>  hidePageLoader(); </script>"; exit;					
					
					} 
				
				} 
					
			}catch(PDOException $e) {
		
				fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
			}
				

		}else{
			
			echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
			
		}

?>