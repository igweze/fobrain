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
	This script handle school setup configurations
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

    		 define('fobrain', 'igweze');  /* define a check for wrong access of file */

        	require 'fobrain-config-s.php';  /* load fobrain configuration files */	 

			$script_scroll_cm = "
							$('#upload-sch-logo').val('');
							$('.fob-btn-loader').fadeOut(2000); 
							$('.fob-btn-div').fadeIn(4000); ";
		 
		
			if (($_REQUEST['query']) == 'logo') {  /* save school logo */		
					
				$picturePath = $sch_logo_path; /* picture path */
				
				$filePic = "uploadPic"; /* picture file name */
				$pageDesc = "School logo picture";
				
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
							
								$ebele_mark = "UPDATE $fobrainSchoolTB SET
								 
													school_logo = :school_logo
													
													WHERE school_id = :school_id";
													
								$igweze_prep = $conn->prepare($ebele_mark);									
								$igweze_prep->bindValue(':school_logo', $uploadedPic);
								$igweze_prep->bindValue(':school_id', $fiVal);

								if($igweze_prep->execute()){  /* insert picture name to database */
									
									$preview_img = $picturePath.$uploadedPic;	 								
									echo "<script type='text/javascript'> 
										$('#preview-picture').attr('src', '$preview_img?rand=' + Math.random());
										$script_scroll_cm	
									</script>";  
									$msg_s = "$pageDesc was successfully uploaded";									
									echo $succesMsg.$msg_s.$sEnd; 	
									exit;									

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
						
			
			}elseif (($_REQUEST['query']) == 'setup') {  /* save school settings */	

				$schoolName =  clean($_REQUEST['schoolName']);
				$schoolAddress =  preg_replace("/[^A-Za-z0-9'.# ]/", "", $_REQUEST['schoolAddress']);
				//$regPrefix =  strtoupper(preg_replace("/[^A-Za-z0-9']/", "", $_REQUEST['regPrefix']));
				$schoolCutoff =  clean($_REQUEST['schoolCutoff']); 
				$nur_head =  preg_replace("/[^A-Za-z0-9,']/", "", $_REQUEST['nur_head']);
				$pri_head =  preg_replace("/[^A-Za-z0-9,']/", "", $_REQUEST['pri_head']);
				$sec_head =  preg_replace("/[^A-Za-z0-9,']/", "", $_REQUEST['sec_head']);
				$bursary =  preg_replace("/[^A-Za-z0-9']/", "", $_REQUEST['bursary']);
				$libraian =  preg_replace("/[^A-Za-z0-9']/", "", $_REQUEST['libraian']);
				$transFrom = clean($_REQUEST['transFrom']);
				$transTo =  clean($_REQUEST['transTo']);
				$sTime = cleanInt($_REQUEST['sTime']);
				$ewallet = cleanInt($_REQUEST['ewallet']); 
				$tzone = clean($_REQUEST['tzone']); 

				
				/* script validation */
				
				if ($schoolName == "")  {
         			
					$msg_e = "Ooops Error, please input your schoool name";
					
	   			}elseif ($schoolAddress == "")  {
         			
					$msg_e = "Ooops Error, please input your school address";
						
	   			//}elseif ($regPrefix == "")  {
         			
					//$msg_e = "Ooops Error, please input your school Reg No Prefix";
						
	   			}elseif (($schoolCutoff == "")  || ($schoolCutoff >= 100) || ($schoolCutoff <= $i_false)){
         			
					$msg_e = "Ooops Error, please input a correct percentage for automated student end of term promotion. eg 40";
						
	   			}elseif ($nur_head == "")  {
         			
					$msg_e = "Ooops Error, please input nursery school heads";
						
	   			}elseif ($pri_head == "")  {
         			
					$msg_e = "Ooops Error, please input primary school heads";
						
	   			}elseif ($sec_head == "")  {
         			
					$msg_e = "Ooops Error, please input secondary school heads";
						
	   			}elseif ($bursary == "")  {
         			
					$msg_e = "Ooops Error, please input school bursary";
						
	   			}elseif ($libraian == "")  {
         			
					$msg_e = "Ooops Error, please input school libraian";
						
	   			}
				/*elseif (($transFrom != "") && ($transTo == "")){
         			
					$msg_e = "Ooops Error, please select language to translate To";
						
	   			}elseif (($transFrom == "") && ($transTo != "")){
         			
					$msg_e = "Ooops Error, please select your language to translate From";
						
	   			}*/
				elseif ($transTo == ""){
         			
					$msg_e = "Ooops Error, please select your language";
						
				}elseif ($ewallet == ""){
         			
					$msg_e = "Ooops Error, please select an e-wallet setting";
						
	   			}elseif ($tzone == ""){
         			
					$msg_e = "Ooops Error, please select your time zone";
						
	   			}else {  /* update information */

						
					//if (($transFrom != "") && ($transTo != "")){
						//$translator = $transFrom.'/'.$transTo;
					//}else{ $translator = "en/en"; } 

					$transFrom =  "en";

					$translator = $transFrom.'/'.$transTo;

					$schoolHead =  $nur_head.",".$pri_head.",".$sec_head;
					
					try {		 			

							$schoolArray = fobrainSchool($conn);  /* school configuration setup array  */

							$ebele_mark = "UPDATE $fobrainSchoolTB SET
							
											school_name = :school_name,
											school_address = :school_address,												
											school_cutoff = :school_cutoff,
											school_head = :school_head,
											bursary = :bursary,
											libraian = :libraian,
											translator = :translator,
											screen_timer = :screen_timer,
											ewallet = :ewallet,
											tzone = :tzone
											
											WHERE school_id = :school_id";
											
							$igweze_prep = $conn->prepare($ebele_mark);									
							$igweze_prep->bindValue(':school_name', $schoolName);
							$igweze_prep->bindValue(':school_address', $schoolAddress);
							//$igweze_prep->bindValue(':reg_prefix', $regPrefix); reg_prefix = :reg_prefix,
							$igweze_prep->bindValue(':school_cutoff', $schoolCutoff);
							$igweze_prep->bindValue(':school_head', $schoolHead);
							$igweze_prep->bindValue(':bursary', $bursary);
							$igweze_prep->bindValue(':libraian', $libraian);
							$igweze_prep->bindValue(':translator', $translator);
							$igweze_prep->bindValue(':screen_timer', $sTime);
							$igweze_prep->bindValue(':ewallet', $ewallet);
							$igweze_prep->bindValue(':tzone', $tzone);
							$igweze_prep->bindValue(':school_id', $fiVal);
							$igweze_prep->execute();
							
							$schHeadID = $schoolArray[0]['school_head'];
							$libraianID = $schoolArray[0]['libraian'];
							$bursaryID = $schoolArray[0]['bursary'];
							
							//$randomSchHead  = randomString($charset, 5);							
							//$newSchHeadID = 'staff'.$schHeadID.$randomSchHead;
							
	
							if($schHeadID != ""){  /* check school head is empty  */
								
								$ebele_mark_1 = "UPDATE $staffTB SET
								
												t_grade = :t_grade
												
												WHERE t_grade = :t_g";
												
								$igweze_prep_1 = $conn->prepare($ebele_mark_1);	
								$igweze_prep_1->bindValue(':t_grade', $i_false);
								$igweze_prep_1->bindValue(':t_g', $hm_fob_tagged);
								$igweze_prep_1->execute();
								
							}
							
							list ($nurseryHead, $primaryHead, $secondaryHead) = explode (",", $schoolHead);	
														
							if($nurseryHead != ""){  /* check nursery school head is empty  */
								
								$ebele_mark_2 = "UPDATE $staffTB SET
								
												t_grade = :t_grade 
												
												WHERE t_id = :t_id";
												
								$igweze_prep_2 = $conn->prepare($ebele_mark_2);	
								$igweze_prep_2->bindValue(':t_grade', $hm_fob_tagged);
								$igweze_prep_2->bindValue(':t_id', $nurseryHead);
								$igweze_prep_2->execute();	
								
							}
							
							if($primaryHead != ""){  /* check primary school head is empty  */
								
								$ebele_mark_2_1 = "UPDATE $staffTB SET
								
												t_grade = :t_grade 
												
												WHERE t_id = :t_id";
												
								$igweze_prep_2_1 = $conn->prepare($ebele_mark_2_1);	
								$igweze_prep_2_1->bindValue(':t_grade', $hm_fob_tagged);
								$igweze_prep_2_1->bindValue(':t_id', $primaryHead);
								$igweze_prep_2_1->execute();	
								
							}
							
							if($secondaryHead != ""){  /* check secondary school head is empty  */
								
								$ebele_mark_2_2 = "UPDATE $staffTB SET
								
												t_grade = :t_grade 
												
												WHERE t_id = :t_id";
												
								$igweze_prep_2_2 = $conn->prepare($ebele_mark_2_2);	
								$igweze_prep_2_2->bindValue(':t_grade', $hm_fob_tagged);
								$igweze_prep_2_2->bindValue(':t_id', $secondaryHead);
								$igweze_prep_2_2->execute();	
								
							}
	
							if($bursaryID != ""){  /* check bursary is empty  */
								
								$ebele_mark_3 = "UPDATE $staffTB SET
								
												t_grade = :t_grade 
												
												WHERE t_id = :t_id";
												
								$igweze_prep_3 = $conn->prepare($ebele_mark_3);	
								$igweze_prep_3->bindValue(':t_grade', $i_false); 
								$igweze_prep_3->bindValue(':t_id', $bursaryID);
								$igweze_prep_3->execute();
								
							}

							$ebele_mark_4 = "UPDATE $staffTB SET
							
											t_grade = :t_grade 
											
											WHERE t_id = :t_id";
											
							$igweze_prep_4 = $conn->prepare($ebele_mark_4);	
							$igweze_prep_4->bindValue(':t_grade', $bus_fob_tagged); 
							$igweze_prep_4->bindValue(':t_id', $bursary);
							$igweze_prep_4->execute();
							
	
							if($libraianID != ""){  /* check libraian is empty  */
								
								$ebele_mark_5 = "UPDATE $staffTB SET
								
												t_grade = :t_grade 
												
												WHERE t_id = :t_id";
												
								$igweze_prep_5 = $conn->prepare($ebele_mark_5);	
								$igweze_prep_5->bindValue(':t_grade', $i_false); 
								$igweze_prep_5->bindValue(':t_id', $libraianID);
								$igweze_prep_5->execute();
								
							}

							$ebele_mark_6 = "UPDATE $staffTB SET
							
											t_grade = :t_grade 
											
											WHERE t_id = :t_id";
											
							$igweze_prep_6 = $conn->prepare($ebele_mark_6);	
							$igweze_prep_6->bindValue(':t_grade', $lib_fob_tagged); 
							$igweze_prep_6->bindValue(':t_id', $libraian);
							$igweze_prep_6->execute();
							
						


						}catch(PDOException $e) {
					
								fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
						
						}
	
	
					if (($igweze_prep) && ($igweze_prep_2) && ($igweze_prep_4) && ($igweze_prep_6)){  /* if sucessfully */ 

						$msg_s = "School configuration was successfully saved.";
						
						unset($_SESSION['screen_timer']); 
						unset($_SESSION['activeTimer']);
						
						$_SESSION['screen_timer'] = $sTime; 
						$_SESSION['activeTimer'] = time();
						

$script =<<<IGWEZE
						<script type="text/javascript"> 
							$("#top-school-name").html("$schoolName");
							$('#frmschoolSetup').slideUp(2000);
						</script>

IGWEZE;
						echo $script;
					
					}else {  /* display error */ 

						$msg_e = "Ooops, An Error Has occur while trying to save school settings, please try again";

			
					}

        		}
        
			}elseif (($_REQUEST['query']) == 'fobrainColor') {  /* save school theme */	

				$themeColor =  clean($_REQUEST['themeColorID']);
				
				/* script validation */ 
				
				if ($themeColor == "")  {
         			
					$msg_e = "Ooops Error, please select a color theme for your school";
					
	   			}else {  /* update information */

		 			try {
		 			
						$ebele_mark = "UPDATE $fobrainSchoolTB SET
					 
										school_theme = :school_theme
										
										WHERE school_id = :school_id";
										
						$igweze_prep = $conn->prepare($ebele_mark);									
						$igweze_prep->bindValue(':school_theme', $themeColor);
						$igweze_prep->bindValue(':school_id', $fiVal);
						
						if ($igweze_prep->execute()) { /* if sucessfully */ 

								$msg_s = "School Theme was Successfully change. Please wait  . . . .  Page Refreshing";
								 echo "<script type='text/javascript'> hidePageLoader(); $('.reload-page').trigger('click');</script>"; exit;
							
						}else {  /* display error */

								$msg_e = "Ooops, An Error Has occur
								while trying to change school theme, please try again";										
								echo "<script type='text/javascript'> hidePageLoader();  </script>"; exit;

						} 
								
					}catch(PDOException $e) {
  			
						fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					}

        		}
        
			}elseif (($_REQUEST['query']) == 'edit-remark') {  /* load student remarks */

				$remarks =   clean($_REQUEST['remark']);
				$remarkID =  $_REQUEST['remarkID'];
				
				/* script validation */ 
				
				if ($remarkID== "") {
         			
					$msg_e = "Ooops, an error occur while trying to retrive remarks infomation. please try again";
					
	   			}else {  /* load student remarks input */
					
					$frmRemark= "frmRemark-".$remarkID;
					
					echo ' <input type="text" class="form-control" id="'.$frmRemark.'" value="'.$remarks.'"
                                              name="'.$frmRemark.'" />';
					echo "<script type='text/javascript'>  
							$('#Update-$remarkID').fadeIn(100); 
							$('#Edit-$remarkID').fadeOut(100);
							$('#msgBoxDiv-$remarkID').fadeOut(100);						
						</script>";	  

        		}
        
			}elseif (($_REQUEST['query']) == 'save-remark') {  /* save student remarks */

				$remarks =   clean($_REQUEST['remark']);
				$remarkID =  $_REQUEST['remarkID'];
				
				/* script validation */ 
				
				if ($remarks == "") {
         			
					$msg_e = "Ooops Error, please input a word for Teacher's Remark";
					echo $errorMsg.$msg_e.$eEnd;
					
	   			}else {  /* insert/update information */


		 			try {

						$ebele_mark = "INSERT INTO $tRemarksTB (remarks)

									VALUES (:remarks)";
				
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':remarks', $remarks); 								
					
						$ShowRemark = "$remarks";

						if ($igweze_prep->execute()) {  /* if sucessfully */ 

$script =<<<IGWEZE
							<script type="text/javascript">  
							$("#editDiv-$remarkID").html("$ShowRemark");
							$("#Edit-$remarkID").fadeIn(100); 
							$("#Remove-$remarkID").fadeIn(100);
							$("#Save-$remarkID").fadeOut(100);
							$('#msgBoxDiv-$remarkID').fadeOut(100);
							</script>
		
IGWEZE;
							echo $script;
		
				
						}else {  /* display error */

							$msg_e = "Ooops, An Error has occur while trying to save teacher's remark, please try again";

						}
		
					}catch(PDOException $e) {
				
							fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
				 
					}

        		}
        
			}elseif (($_REQUEST['query']) == 'update-remark') {  /* update student remarks */

				$remarks =   clean($_REQUEST['remark']);
				$remarkID =  $_REQUEST['remarkID'];
				
				/* script validation */
				
				if ($remarks == "") {
         			
					$msg_e = "Ooops Error, please input a word for Teacher's Remark";
					echo $errorMsg.$msg_e.$eEnd;
					
	   			}else {  /* update information */ 


		 			try {

						$ebele_mark = "UPDATE $tRemarksTB 
										
										SET remarks = :remarks
										
										WHERE id_rem = :id_rem";
			
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':remarks', $remarks);
						$igweze_prep->bindValue(':id_rem', $remarkID);
						
						$ShowRemark = "$remarks";


						if ($igweze_prep->execute()) {  /* if sucessfully */ 

$script =<<<IGWEZE
							<script type="text/javascript">  
							$("#editDiv-$remarkID").html("$ShowRemark");
							$("#Update-$remarkID").fadeOut(100); 
							$("#Edit-$remarkID").fadeIn(100);
							$("#Save-$remarkID").fadeOut(100);
							$('#msgBoxDiv-$remarkID').fadeOut(100);
							</script>
		
IGWEZE;
							echo $script;
				
						}else {  /* display error */ 

							$msg_e = "Ooops, An  Error occur while trying to update teacher's remark, please try again";

						}
				
					}catch(PDOException $e) {
					
								fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
					 
					}

        		}
        
			}elseif (($_REQUEST['query']) == 'remove-remark') {  /* remove student remarks */

				$remarkID =  clean($_REQUEST['remarkID']);
				
				/* script validation */ 
				
				if ($remarkID == "") {
         			
					$msg_e = "Ooops, An 
						Error occur while trying to remove teacher's remark, please try again";
					
	   			}else {  /* remove information */ 

		 			try {

						$ebele_mark = "DELETE FROM $tRemarksTB 
										
										WHERE id_rem = :id_rem
										
										LIMIT 1";
			 
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':id_rem', $remarkID);
						
						if($igweze_prep->execute()){  /* if sucessfully */

								echo "<script type='text/javascript'>  
								$('#DivRow-$remarkID').fadeOut(1000);
								$('#msgBoxDiv-$remarkID').fadeOut(100);
								</script>";							
								
						}else {  /* display error */ 

								$msg_e = "Ooops, An 
								Error occur while trying to remove teacher's remark, please try again";

						} 
								
				 	}catch(PDOException $e) {
  			
						fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					} 

        		}
        
			}elseif (($_REQUEST['query']) == 'edit-sport') {  /* load school sports */

				$sport =   clean($_REQUEST['sport']);
				$sportID =  $_REQUEST['sportID'];
				
				/* script validation */
				
				if ($sportID == "") {
         			
					$msg_e = "Ooops, an error occur while trying to retrive sport infomation. please try again";
					
	   			}else {  /* load school sports form input */
					
					$frmSport= "frmSport-".$sportID;
					
					echo '<input type="text" class="form-control" id="'.$frmSport.'" value="'.$sport.'"  name="'.$frmSport.'" /> ';
					echo "<script type='text/javascript'>  
							$('#Update-$sportID').fadeIn(100); 
							$('#Edit-$sportID').fadeOut(100);
							$('#msgBoxDiv-$sportID').fadeOut(100);
						</script>";	  

        		}
        
			}elseif (($_REQUEST['query']) == 'save-sport') {  /* save school sports */

				$sport =   clean($_REQUEST['sport']);
				$sportID =  $_REQUEST['sportID'];
				
				/* script validation */
				
				if ($sport == "") {
         			
					$msg_e = "Ooops Error, please input a word for Student\'s Sport";
					
	   			}else {  /* insert information */ 


		 			try {

						$ebele_mark = "INSERT INTO $sportsTB (sport)

									VALUES (:sport)";
				
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':sport', $sport);
					
						$show_sport = "$sport"; 

						if($igweze_prep->execute()){  /* if sucessfully */

$script =<<<IGWEZE
							<script type="text/javascript">  
							$("#editDiv-$sportID").html("$show_sport");
							$("#Edit-$sportID").fadeIn(100); 
							$("#Remove-$sportID").fadeIn(100);
							$("#Save-$sportID").fadeOut(100);
							$('#msgBoxDiv-$sportID').fadeOut(100);
							</script>

IGWEZE;
							echo $script;
				
						
						}else {  /* display error */

							$msg_e = "Ooops, An Error occur while trying to save student sport, please try again";

						}
						
								
					}catch(PDOException $e) {
  			
						fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					}			
					

        		}
				
        
			}elseif (($_REQUEST['query']) == 'update-sport') {  /* update school sports */

				$sport =   clean($_REQUEST['sport']);
				$sportID =  $_REQUEST['sportID'];
				
				/* script validation */
				
				if ($sport == "") {
         			
					$msg_e = "Ooops Error, please input a word for Student\'s Sport";
					
	   			}else {  /* /update information */ 


		 			try {

						$ebele_mark = "UPDATE $sportsTB 
										
										SET sport = :sport
										
										WHERE sport_id = :sport_id";
				
						$igweze_prep = $conn->prepare($ebele_mark);

						$igweze_prep->bindValue(':sport', $sport);
						$igweze_prep->bindValue(':sport_id', $sportID);
					
						$show_sport = "$sport";
						
			


						if($igweze_prep->execute()){  /* if sucessfully */

$script =<<<IGWEZE
							<script type="text/javascript">
								$("#editDiv-$sportID").html("$show_sport");
								$("#Update-$sportID").fadeOut(100);
								$("#Edit-$sportID").fadeIn(100);
								$("#Save-$sportID").fadeOut(100);
								$('#msgBoxDiv-$sportID').fadeOut(100);
							</script>

IGWEZE;
							echo $script;

				
						}else {  /* display error */

							$msg_e = "Ooops, An Error occur while trying to update student sport, please try again"; 

						}
								
					}catch(PDOException $e) {
  			
						fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					}			

        		}
        
			}elseif (($_REQUEST['query']) == 'remove-sport') {  /* remove school sports */

				$sportID =  $_REQUEST['sportID'];
				
				/* script validation */
				
				if ($sportID == "") {
         			
					$msg_e = "Ooops, An  Error occur while trying to remove student sport, please try again";
					
	   			}else {  /* remove information */ 


		 			try {

						$ebele_mark = "DELETE FROM $sportsTB 
										
										WHERE sport_id = :sport_id
										
										LIMIT 1";
			 
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':sport_id', $sportID);

						if($igweze_prep->execute()){  /* if sucessfully */

							echo "<script type='text/javascript'>  
							$('#DivRow-$sportID').fadeOut(1000);
							$('#msgBoxDiv-$sportID').fadeOut(100);
							</script>";							
								
						}else {  /* display error */

							$msg_e = "Ooops, An Error occur while trying to remove student sport, please try again</span>"; 

						}
								
								
					}catch(PDOException $e) {
  			
						fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					}			

        		}
        
			}else{
			
				echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
			
			} 
			
			if ($msg_s) {
				echo $succesMsg.$msg_s.$sEnd; 
				echo"<script type='text/javascript'> hidePageLoader(); </script>";
				exit;					
			}	 

			if ($msg_e) {
				echo $errorMsg.$msg_e.$eEnd; 
				echo"<script type='text/javascript'>  hidePageLoader(); </script>";
				exit;					
			}	
exit; 
?> 