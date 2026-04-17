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
	This script handle student result automation and configuration
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

     	define('fobrain', 'igweze');  /* define a check for wrong access of file */

        require 'fobrain-config.php';  /* load fobrain configuration files */	    

		if ($_REQUEST['rs-config'] == 'compute'){  /* automate result */
		 
            /* script validation */
			
			if ((isset($_REQUEST['sess'])) && (isset($_REQUEST['level'])) && (isset($_REQUEST['class'])) 
				&& (isset($_REQUEST['term'])) )  {

		        $session = $_REQUEST['sess'];
        		$level = $_REQUEST['level'];
		        $class = $_REQUEST['class'];
				$term = $_REQUEST['term'];
				
				try {
						
					$sessionID = sessionID($conn, $session); /* school session ID  */					
					$rs_status = fobrainResultStatus2($conn, $sessionID, $class, $level, $term, $adminID);

					if($rs_status == 0){

						$msg_e = "Ooops, could not save result configuration for computation";
						echo $erroMsg.$msg_e.$msgEnd;
						echo "<script type='text/javascript'>  
									$('.rs-config-wrap, .exit-rs-config').fadeIn(2000);
									$('#config-loader').fadeOut(2500); 
                                </script>";exit;

					}elseif($rs_status == $thVal){

						$msg_e = "Ooops, this result is already published and cannot be edited again";
						echo $erroMsg.$msg_e.$msgEnd;
						echo "<script type='text/javascript'> 
                                    $('.rs-config-wrap, .exit-rs-config').fadeIn(2000);
									$('#config-loader').fadeOut(2500); 
                                </script>";exit;

					}else{  /* if sucessfully */ 
						
						require  $fobrainClassConfigDir;  /* include class configuration script */ 							
						require_once $fobrainCalRSDir;  /* include result automation script */  
						
						/* update information */
						
						$ebele_mark_7 = "UPDATE  $rsConfigTB 
						
											SET 
											
											status = :status
											
											WHERE 
											
											session = :session
				
											AND level = :level
							
											AND class = :class
											
											AND term = :term";
										
						$igweze_prep_7 = $conn->prepare($ebele_mark_7);	
						$igweze_prep_7->bindValue(':session', $sessionID);
						$igweze_prep_7->bindValue(':level', $level);
						$igweze_prep_7->bindValue(':class', $class);
						$igweze_prep_7->bindValue(':term', $term);
						$igweze_prep_7->bindValue(':status', $seVal);
						
						if($igweze_prep_7->execute()){

							$msg_s = "Students class result  was automatically and successfully computed."; 
							echo $succMsg.$msg_s.$msgEnd;

							echo "<script type='text/javascript'> 
									$('.rs-config-wrap, .exit-rs-config').fadeIn(2000);
									$('#config-loader').fadeOut(2500);  
								</script>";exit; 
							
						}else{

							$msg_e = "Ooops, could not save result configuration for computation - error 2";
							echo $erroMsg.$msg_e.$msgEnd;
							echo "<script type='text/javascript'>  
										$('.rs-config-wrap, .exit-rs-config').fadeIn(2000);
										$('#config-loader').fadeOut(2500); 
									</script>";exit;

						} 
						
			
					}
							 
								  
				}catch(PDOException $e) {
  			
					echo "<script type='text/javascript'>  
										$('.rs-config-wrap, .exit-rs-config').fadeIn(2000);
										$('#config-loader').fadeOut(2500); 
									</script>";
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			 
				}			

        	}else {  /* display error */

				$msg_e =  $formErrorMsg;
				echo $erroMsg.$msg_e.$msgEnd;
				echo "<script type='text/javascript'>  
							$('.rs-config-wrap, .exit-rs-config').fadeIn(2000);
							$('#config-loader').fadeOut(2500); 
						</script>";exit;
 
        	}
			
			
		}elseif ($_REQUEST['rs-config'] == 'configStaffs'){  /* save result configuration */
		 
            if ((isset($_REQUEST['sess'])) && (isset($_REQUEST['level'])) && (isset($_REQUEST['class'])) 
				&& (isset($_REQUEST['term'])) && (isset($_REQUEST['teachersInfo'])) )  {

		        $session = $_REQUEST['sess'];
        		$level = $_REQUEST['level'];
		        $class = $_REQUEST['class'];
				$term = $_REQUEST['term'];
				$teachersInfo = $_REQUEST['teachersInfo'];
				

				/*
				foreach ($teachersInfo as $field  => $TValue){  /* loop array * /

					if ( (empty($TValue)) || ($TValue == '') )  {
	
						/*
						echo "<script type='text/javascript'>  
									
							$('#rsConfigLoader').fadeOut(4000);
								
									
						</script>";

						$msg_e .= "*Ooops Error, please enter all subject teachers data";
					
						echo $errorMsg.$msg_e.$eEnd; echo $scroll_up; exit; 
						* /
	
					}

				}
				*/
				
				try{
					
					$teachersInfo = serialize($teachersInfo);

					$sessionID = sessionID($conn, $session); /* school session ID  */
					
					$ebele_mark = "SELECT s_id
			
							FROM $rsConfigTB
							
									WHERE  session = :session
							
											AND level = :level
							
											AND class = :class
											
											AND term = :term";
					 
					$igweze_prep = $conn->prepare($ebele_mark);				 
					$igweze_prep->bindValue(':session', $sessionID);
					$igweze_prep->bindValue(':level', $level);
					$igweze_prep->bindValue(':class', $class);
					$igweze_prep->bindValue(':term', $term);
					$igweze_prep->execute();
			
					$rows_count = $igweze_prep->rowCount(); 
			
					if($rows_count == $i_false) {  /* insert information */  

						$ebele_mark_1 = "INSERT INTO $rsConfigTB (session, level, class, term,
																					t_info, staff_id, status) 
									
										VALUES(:session, :level, :class, :term, :t_info, :staff_id, :status)";
										
						$igweze_prep_1 = $conn->prepare($ebele_mark_1);	
						$igweze_prep_1->bindValue(':session', $sessionID);
						$igweze_prep_1->bindValue(':level', $level);
						$igweze_prep_1->bindValue(':class', $class);
						$igweze_prep_1->bindValue(':term', $term);
						$igweze_prep_1->bindValue(':t_info', $teachersInfo);
						$igweze_prep_1->bindValue(':staff_id', $adminID);
						$igweze_prep_1->bindValue(':status', $foreal);
						$igweze_prep_1->execute(); 

							
					}else{  /* update information */ 
						
						while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {  /* loop array */
										
							$s_id = $row['s_id'];
							
						}

						$ebele_mark_1 = "UPDATE  $rsConfigTB 
						
											SET 
											
											t_info = :t_info
											
											WHERE s_id = :s_id";
										
						$igweze_prep_1 = $conn->prepare($ebele_mark_1);	
						$igweze_prep_1->bindValue(':s_id', $s_id);
						$igweze_prep_1->bindValue(':t_info', $teachersInfo);
						$igweze_prep_1->execute(); 
					
					}

					echo "<script type='text/javascript'> $('#frmsaveTeacherRS').slideUp(1500); 
														$('#rsConfigLoader').fadeOut(4000);
						</script>";

					$msg_s = "Subject Teachers information were successfully saved";
						
				}catch(PDOException $e) {
  			
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			 
				}							

        	}else {  /* display error */

					$msg_e  = "Ooops, an error has occur while trying to save subject teachers information. Please try again";

 
        	}
			
		}elseif ($_REQUEST['rs-config'] == 'publish'){  /* publish result */
		 
            /* script validation */ 
			
			if ((isset($_REQUEST['sess'])) && (isset($_REQUEST['level'])) && (isset($_REQUEST['class'])) 
				&& (isset($_REQUEST['term'])) )  {

				$session = $_REQUEST['sess'];
				$level = $_REQUEST['level'];
				$class = $_REQUEST['class'];
				$term = $_REQUEST['term'];
	
				try{

					$sessionID = sessionID($conn, $session); /* school session ID  */
					$rs_status = fobrainResultStatus2($conn, $sessionID, $class, $level, $term, $adminID);
					
					
			
					if($rs_status == $fiVal) {  /* display error */

						$msg_e =  "Ooops, please save or add subject teachers records before you can publish this result. Thanks"; 
							
					}elseif($rs_status == $thVal){

						$msg_e = "Ooops, this result is already published and cannot be edited again";
						echo $erroMsg.$msg_e.$msgEnd;
						echo "<script type='text/javascript'> 
									$('.rs-config-wrap, .exit-rs-config').fadeIn(2000);
									$('#config-loader').fadeOut(2500); 
								</script>";exit;

					}elseif($rs_status != $seVal){

						$msg_e = "Ooops, please you have to compute students result before you can publish it. Thanks";
						echo $erroMsg.$msg_e.$msgEnd;
						echo "<script type='text/javascript'> 
									$('.rs-config-wrap, .exit-rs-config').fadeIn(2000);
									$('#config-loader').fadeOut(2500); 
								</script>";exit;

					}else{ 

						$ebele_mark_7 = "UPDATE  $rsConfigTB 
						
											SET 
											
											status = :status
											
											WHERE 
											
											session = :session
				
											AND level = :level
							
											AND class = :class
											
											AND term = :term";
										
						$igweze_prep_7 = $conn->prepare($ebele_mark_7);	
						$igweze_prep_7->bindValue(':session', $sessionID);
						$igweze_prep_7->bindValue(':level', $level);
						$igweze_prep_7->bindValue(':class', $class);
						$igweze_prep_7->bindValue(':term', $term);
						$igweze_prep_7->bindValue(':status', $thVal);
						
						if($igweze_prep_7->execute()){

							$msg_s = "Students class result was successfully publish."; 
							echo $succesMsg.$msg_s.$sEnd;

							echo "<script type='text/javascript'> 
									$('.rs-config-wrap, .exit-rs-config').fadeIn(2000);
									$('#config-loader').fadeOut(2500);  
								</script>";exit; 
							
						}else{

							$msg_e = "Ooops, could not save result configuration for computation - error 3";
							echo $erroMsg.$msg_e.$msgEnd;
							echo "<script type='text/javascript'>  
										$('.rs-config-wrap, .exit-rs-config').fadeIn(2000);
										$('#config-loader').fadeOut(2500); 
									</script>";exit;

						}  
						
					
					}  
				 

				}catch(PDOException $e) { 

					echo "<script type='text/javascript'>  
										$('.rs-config-wrap, .exit-rs-config').fadeIn(2000);
										$('#config-loader').fadeOut(2500); 
									</script>";
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());				
			 
				}					

        	}else {  /* display error */

		    	$msg_e =  $formErrorMsg; 
				echo $erroMsg.$msg_e.$msgEnd;
				echo "<script type='text/javascript'>  
							$('.rs-config-wrap, .exit-rs-config').fadeIn(2000);
							$('#config-loader').fadeOut(2500); 
						</script>";exit;
 
        	}
			
		}else{
			
			echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
			
		} 	
			 
exit;	 
?>