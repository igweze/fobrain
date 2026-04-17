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
		
*/ 

if(!session_id()){
    session_start();
}

		define('fobrain', 'igweze');  /* define a check for wrong access of file */
					
		require 'fobrain-config.php';  /* load fobrain configuration files */	   
		
		if (($_REQUEST['classData']) == 'effectPromotion') {

			$regIDArr = $_REQUEST['regID'];
			$level = $_REQUEST['level'];
			$regNoArr = $_REQUEST['regNo'];
			$promotionClassArr = $_REQUEST['promotionArr'];
			$student_nameArr = $_REQUEST['studentName'];
			
			/* script validation */ 
			
			if($level == ""){
				
				$msg_e = "Ooops  Error, please select class level";
				echo "<script type='text/javascript'>  hidePageLoader();</script>";
				echo $errorMsg.$msg_e.$eEnd; echo $scroll_up; exit; 		
				
			}else{  /* update information */ 	
				
					$term = $th_term; $promotionStatus = false;	$subfCounter = 0;	
			
					require  $fobrainClassConfigDir;  /* require class configuration */
			
					foreach ($regIDArr as $id => $val) {  /* loop array */
						
						$classPromArray [$id] = array(
							'regID'  => $regIDArr[$id],
							'regNo'  => $regNoArr[$id],
							'Name'  => $student_nameArr[$id],
							'promotionID' => $promotionClassArr[$id]
						); 
						
						$regID  = $regIDArr[$id];
						$regNo  = $regNoArr[$id];
						$promotionID = $promotionClassArr[$id];
						$student_name = $student_nameArr[$id]; 
					

						try { 

							$ebele_mark = "UPDATE $sdoracle_grand_score_nk
							
												SET 
											
											certify = :certify

											WHERE ireg_id = :ireg_id";
						
							$igweze_prep = $conn->prepare($ebele_mark);
							$igweze_prep->bindValue(':certify', $promotionID);
							$igweze_prep->bindValue(':ireg_id', $regID);
		
							if ($igweze_prep->execute()) {  /* if sucessfully */
									
								$promVerb = $promotionArr[$promotionID];
								$msg_s = "<strong>$student_name</strong> was successfully <strong>$promVerb<strong>.";
								messenger("success", $msg_s); 				
						
							}else {  /* display error */ 

								$msg_e = "Ooops, an Error occured while tring to effect class promotion. Please try again";
								messenger("error", $msg_s);

							} 

						}catch(PDOException $e) {
				
							fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
					
						}

						
						$regID  = "";
						$regNo  = "";
						$promotionID = "";
						
					}
			}
			
			echo "<script type='text/javascript'>  hidePageLoader(); $('#promotionDiv').slideUp(2000); </script>";
			
			
		}else{ 
		
				echo $userNavPageError; 
	
		} 
		
exit;
?>