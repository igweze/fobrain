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
	This script handle student result
	------------------------------------------------------------------------*/ 

if(!session_id()){
    session_start();
}

		define('fobrain', 'igweze');  /* define a check for wrong access of file */

        require 'fobrain-config.php';  /* load fobrain configuration files */	 

 		if ($_REQUEST['rsData'] == 'viewRs') {  /* view result */ 
			
			/* script validation */ 
			
            if (($_REQUEST['level'] != '')  || ($_REQUEST['term'] != '')){ 

        		$level = strip_tags($_REQUEST['level']);
				$term = strip_tags($_REQUEST['term']);
				$rsType = strip_tags($_REQUEST['rsType']); 
				$schoolTypeSD = "";

				try {
					
					echo "<div id='fobrain-print'>";
					
					if($rsType == ""){
						$examArray = schoolExamConfigArrays($conn);  /* school exam configuration array  */
						$exam_status = $examArray[0]['status'];	
						$rsType = $examArray[0]['rsType'];	
					}
							 
					$sessionID = studentRegSessionID($conn, $regNum);  /* student school session ID */
					$session_fi = fobrainSession($conn, $sessionID);  /* school session */	 
		 
		 			$session_se = $session_fi + $foreal;  
					$class = studentClass($conn, $regNum, $level);  /* retrieve a student class*/
					
					if($class == ''){  /* check if student class is empty */

						$msg_e = "Ooops sorry, this student result has not be yet published by school authority.";						
						echo $erroMsg.$msg_e.$msgEnd;
						echo "<script type='text/javascript'> hidePageLoader();	</script>";	exit; 	 

					} 

					$rsStatus = fobrainResultStatus($conn, $sessionID, $class, $level, $term);	 /* student result status */  

					if ($term == 'all'){  /* if annual result */
						
						
						$term = $fi_term; $promotionStatus = false;	$subfCounter = 0;
						
						if(($ewalletCheck == $fiVal) || ($ewalletCheck == $seVal)){  /* check if e-wallet is enable by school */
				
							$term = $th_term; $promotionStatus = true;
							
							$cardRecharge = eWalletCheckRecharge($conn, $regNum, $regID, $level, $term, $ewalletCheck);  /* validate card pin e - wallet information */
							
							if ($cardRecharge == ''){  /* if return e-wallet is null */
								
								$msg_e = "* Ooops Error, you have not recharge for this level. Please recharge for this level
								using E-wallet to enable you view your result. Thanks";
								echo $erroMsg.$msg_e.$msgEnd; 
								echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader * /	</script>";exit; 	
								exit;	
							}					
						
						}
						
						require  $fobrainClassConfigDir;   /* include class configuration script */ 
						
						require ($fobrainSessionRSDir);   /* include annual result script */ 

					}else{  /* if  termly result */

						$cardRecharge = eWalletCheckRecharge($conn, $regNum, $regID, $level, $term, $ewalletCheck);  /* validate card pin e - wallet information */

						if  ($rsStatus != $rspublishStage){	 /* check result status */		
							
							$msg_e = "Ooops sorry, this student result has not be yet published by school authority.";						
							echo $erroMsg.$msg_e.$msgEnd; 
							echo "<script type='text/javascript'> hidePageLoader();	</script>";exit; 	

						}
						
						if(($ewalletCheck == $fiVal) || ($ewalletCheck == $seVal)){  /* check if e-wallet is enable by school */
						
							if ($cardRecharge == ''){  /* if return e-wallet is null */
								
								$msg_e = "* Ooops Error, you have not recharge for this level. Please recharge for this level
								using E-wallet to enable you view your result. Thanks";
								echo $erroMsg.$msg_e.$msgEnd; 
								echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader * /	</script>";exit; 	
									
							}
						
						} 

						require  $fobrainClassConfigDir;   /* include class configuration script */	
					 
						if($rsType == $fiVal){   /* check result type */
							
							require_once $fobrainStudentSubRSDir;   /* include computational result */
							
						}else{	

							require_once $fobrainStudentComRSDir;   /* include comment result */  
							
						}					
						
					}	 
			
					echo "</div>";
			
				}catch(PDOException $e) {
  			
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			 
				}
	
				echo "<script type='text/javascript'> hidePageLoader();	</script>";
			
			}else {  /* display error */ 

        		$msg_e =  $formErrorMsg;
				echo $erroMsg.$msg_e.$msgEnd;
				echo "<script type='text/javascript'> hidePageLoader();	</script>";

        	}	
			

        }elseif ($_REQUEST['rsData'] == 'bestStudentRS') {  /* view best student result */ 
			
			/* script validation */ 
			
            if (($_REQUEST['level'] != '')  || ($_REQUEST['term'] != '') || ($_REQUEST['sr-class'] != '') ){

        		$level = strip_tags($_REQUEST['level']);
				$term = strip_tags($_REQUEST['term']);
				$rsClass = strip_tags($_REQUEST['sr-class']);
				$schoolTypeSD = "";

				try {
					 
					$sessionID = studentRegSessionID($conn, $regNum);  /* student school session ID */
					$session_fi = fobrainSession($conn, $sessionID);  /* school session */	
					
		 			$session_se = $session_fi + $foreal;  
					$class = studentClass($conn, $regNum, $level);  /* retrieve a student class */ 
					
					if($class == ''){  /* check if student class is empty */

						$msg_e = "Ooops sorry, this student result has not be yet published by school authority.";						
						echo $erroMsg.$msg_e.$msgEnd; exit; 	 

					} 

					if ($term != 'all'){  /* if  termly result */ 

						if($rsClass == $fiVal){  /* check best student in a class */ 
							
							$rsStatus = fobrainResultStatus($conn, $sessionID, $class, $level, $term);	 /* student result status */ 
							
							if  ($rsStatus != $rspublishStage){	 /* check result status */		
								
								$msg_e = "Ooops sorry, this student result has not be yet published by school authority.";
								
								echo $erroMsg.$msg_e.$msgEnd; 
								echo "<script type='text/javascript'> hidePageLoader();	</script>"; exit; 	

							}
							
							require  $fobrainClassConfigDir;   /* include class configuration script */	    			

							$strArray = explode(",", $query_i_strings_nj);
							$fieldPosi = $strArray[2];
							
							$regNumArr = classBestStudentReg($conn, $sdoracle_grand_score_nk, $fieldPosi, $sessionID, $class, 
															 $nk_class);  /* retrieve class best student information */
							
							if(is_array($regNumArr)){  /* check if array */
								
								$countReg = count($regNumArr);
								
								if($countReg > $fiVal){  /* check student count */
									
									$msg_ii = "Woooo; fabulous and amazing, $countReg students emerge best and their results 
									summary are below."; 
								
								}else{
									
									$msg_ii = "Amazing, only one student emerge best and summary of the result is below.";
									
								}
							
								echo $infoMsg.$msg_ii.$iEnd; 

								foreach($regNumArr as $regNumKey => $regNum){  /* loop array */
																
									require ($fobrainClassBestRSDir);  /* include class best student result script */  echo '<hr />';
									$regNum = ""; $regNumKey = ""; 
									
								}
							
							}

						
						}elseif($rsClass == $seVal){  /* check best student in all class */
							
							require  $fobrainClassConfigDir;   /* include class configuration script */		    			

							$strArray = explode(",", $query_i_strings_nj);
							$fieldPosi = $strArray[2];
							$fieldAvg = $strArray[1];
							
							$regNumArr = classSessionBeststudentReg($conn, $sdoracle_grand_score_nk, $sessionID, $fieldPosi, 
																	$fieldAvg);  /* retrieve class best student information */

							if(is_array($regNumArr)){  /* check if array */

								$countReg = count($regNumArr);
								
								if($countReg > $fiVal){  /* check student count */
									
									$msg_ii = "Woooo; fabulous and amazing, $countReg students emerge best in their classes
									and their results summary are below.";
								
								
								}else{
									
									$msg_ii = "Amazing, only one student emerge best and summary of the result is below.";
									
								}
							
								echo $infMsg.$msg_ii.$msgEnd;
								 
								foreach($regNumArr as $regNumKey => $regNum){  /* loop array */
									 
									$class = studentClass($conn, $regNum, $level);							
									require ($fobrainClassBestRSDir);  /* include class best student result script */   echo '<hr />';
									$regNum = ""; $regNumKey = ""; 

								}
							
							}else{  /* display error */ 
								
								$msg_e = "Ooops sorry, session student result has not be yet published by school authority.";							
								echo $erroMsg.$msg_e.$msgEnd; 
								echo "<script type='text/javascript'> hidePageLoader();	</script>"; exit; 
								
							}

						
						}else{  /* display error */ 
							
								$msg_e = "Ooops sorry, session student result has not be yet published by school authority.";							
								echo $erroMsg.$msg_e.$msgEnd; 
								echo "<script type='text/javascript'> hidePageLoader();	</script>"; exit; 

						}	
						
						
					}else{  /* display error */ 
						
							$msg_e = "Ooops sorry, you cannot select student annual result.";							
							echo $erroMsg.$msg_e.$msgEnd; 
							echo "<script type='text/javascript'> hidePageLoader();	</script>"; exit; 

					}	
			
				}catch(PDOException $e) {
  			
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			 
				}
	
				echo "<script type='text/javascript'> hidePageLoader();	</script>";

			
			}else {  /* display error */ 

        		$msg_e =  $formErrorMsg;
				echo $erroMsg.$msg_e.$msgEnd;
				echo "<script type='text/javascript'> hidePageLoader();	</script>";
 
        	}	
			

        }else{
			
			echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
			
		} 
 
			
exit;	 
?>