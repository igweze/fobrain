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
	This script handle assigning staff to a class  and subject 
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}
echo "<pre>"; print_r($_REQUEST); echo "</pre>";
echo "<script type='text/javascript'>   hidePageLoader(); </script>";  
		define('fobrain', 'igweze');  /* define a check for wrong access of file */

		require 'fobrain-config.php';  /* load fobrain configuration files */	   

		if (($_REQUEST['assign']) == 'f_teacher') {  /* assigning staff to a class */	 

			$session = $_REQUEST['sess'];
			$level = $_REQUEST['level'];
			$classInfo= $_REQUEST['class'];
			$staffArr = $_REQUEST['staff'];

			list($class, $class_val) = explode("@+@", $classInfo);
			
			/* script validation */
			
			if ($session == "")  {
			
				$msg_e = "* Ooops Error, please select a session"; 
			
			}elseif ($level == "")  {
			
				$msg_e = "* Ooops Error, please select a level"; 
			
			}elseif ($class == "")  {
			
				$msg_e = "* Ooops Error, please select class to assign teacher to"; 
			
			}elseif ($staffArr == "")  {
			
				$msg_e = "* Ooops Error, please select teacher/s to assign class to"; 
			
			}else {  /* select and assign information */ 
	
				try { 
																			
					$sessionID = sessionID($conn, $session);  /* school session ID */
					
					//$staffArr =  explode(',', $staffData);	 

					foreach ($staffArr as $teacherID) {  /* loop array */
						
						$teacherID = trim($teacherID); 
						$teacherData = staffData($conn, $teacherID);  /* school staffs/teachers information */ 						
					
						list ($title, $teacherName, $sex, $staff_grade_v) = explode ("#@s@#", $teacherData);
					 
						$titleVal = wizSelectArray($title, $title_list);
							
						$ebele_mark = "SELECT form_id
				
								FROM $classFormTeachersTB
								
										WHERE t_id = :t_id
								
												AND session = :session
								
												AND level = :level
								
												AND class = :class";
							
						$igweze_prep = $conn->prepare($ebele_mark);				 
						$igweze_prep->bindValue(':t_id', $teacherID);
						$igweze_prep->bindValue(':session', $sessionID);
						$igweze_prep->bindValue(':level', $level);
						$igweze_prep->bindValue(':class', $class);
						$igweze_prep->execute();
				
						$rows_count = $igweze_prep->rowCount(); 
				
						if($rows_count == $i_false) {  /* check if not assign already */

							$ebele_mark_1 = "INSERT INTO $classFormTeachersTB (t_id, session, level, class) 
										
											VALUES(:t_id, :session, :level, :class)";
											
							$igweze_prep_1 = $conn->prepare($ebele_mark_1);	
							$igweze_prep_1->bindValue(':t_id', $teacherID);
							$igweze_prep_1->bindValue(':session', $sessionID);
							$igweze_prep_1->bindValue(':level', $level);
							$igweze_prep_1->bindValue(':class', $class);
							$igweze_prep_1->execute();

							$ebele_mark = "UPDATE $staffTB SET
							
											t_grade = :t_grade
											
											WHERE t_id = :t_id";
											
							$igweze_prep = $conn->prepare($ebele_mark);	
							$igweze_prep->bindValue(':t_grade', $cm_fob_tagged);
							$igweze_prep->bindValue(':t_id', $teacherID);
							
							if ($igweze_prep->execute()) {  /* if sucessfully */ 
					
								$msg_s .= "<b> $titleVal $teacherName </b>  was successfully assign as class  - <b> $class_val </b> as form manager."; 

							}else {  /* display error */

								$msg_e .= "Ooops, an Error has occur while trying  to assign class manager to <b> $titleVal $teacherName</b>, Please try again later";

							} 
								
						}else{  /* display information message */ 
								
							$msg_i .= "$titleVal $teacherName already assign to this class -<b> $class_val </b>.";
						
						}  
						
					} 
					
					echo "<script type='text/javascript'> 
							//$('#levelCM').val(''); $('#class').val('');							 	 
						</script>"; 
						
				}catch(PDOException $e) {
					
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
						
				} 	

			}
				
	
		}elseif (($_REQUEST['assign']) == 'assignSubTeacher') {  /* assigning staff to a subject */	 

			$session = clean($_REQUEST['sess']);
			$level = clean($_REQUEST['level']);
			$class = clean($_REQUEST['class']);
			$teacherID = clean($_REQUEST['teacher']);
			$subjectID = clean($_REQUEST['subject']);

			/* script validation */ 
			
			if ($session == "")  {
			
				$msg_e = "Please select a session ";
			
			}elseif ($level == "")  {
			
				$msg_e = "Please select a level";
			
			}elseif ($class == "")  {
			
				$msg_e = "Please select class to assign teacher to";
			
			}elseif ($subjectID == "")  {
			
				$msg_e = "Please select subject to assign to teacher";
			
			}elseif ($teacherID == "")  {
			
				$msg_e = "Please select teacher to assign subject to";
			
			}else {  /* select and assign information */

	
				try {
																			
					$sessionID = sessionID($conn, $session);  /* school session ID */
					
					$ebele_mark = "SELECT assign_id
			
							FROM $teachersAssignSubTB
							
									WHERE t_id = :t_id
							
											AND session = :session
							
											AND level = :level
							
											AND class = :class
											
											AND sub_id = :sub_id";
						
					$igweze_prep = $conn->prepare($ebele_mark);				 
					$igweze_prep->bindValue(':t_id', $teacherID);
					$igweze_prep->bindValue(':session', $sessionID);
					$igweze_prep->bindValue(':level', $level);
					$igweze_prep->bindValue(':class', $class);
					$igweze_prep->bindValue(':sub_id', $subjectID);
					$igweze_prep->execute();
			
					$rows_count = $igweze_prep->rowCount(); 
			
					if($rows_count == $i_false) {  /* check if not assign already */ 

						$ebele_mark_1 = "INSERT INTO $teachersAssignSubTB (t_id, sub_id, session, level,
																						class) 
									
										VALUES(:t_id, :sub_id, :session, :level, :class)";
										
						$igweze_prep_1 = $conn->prepare($ebele_mark_1);	
						$igweze_prep_1->bindValue(':t_id', $teacherID);
						$igweze_prep_1->bindValue(':sub_id', $subjectID);
						$igweze_prep_1->bindValue(':session', $sessionID);
						$igweze_prep_1->bindValue(':level', $level);
						$igweze_prep_1->bindValue(':class', $class); 

						if ($igweze_prep_1->execute()) {

							$teacherData = staffData($conn, $teacherID);  /* school staffs/teachers information */ 
											
							list ($titleV, $teacherName, $sex, $staff_grade_v) = explode ("#@s@#", $teacherData);
							$titleVal = $title_list[$titleV];


							$msg_s = "Subject was successfully assign to <b> 
							$titleVal $teacherName </b> ";
					
							echo "<script type='text/javascript'> $('#level').val(''); $('#class').val('');
								$('#teacherDiv').val(''); $('#subjectDiv').val(''); $('.picTDIv').text(''); </script>";

						}else {

							$msg_e = "<span>Ooops, An Error Has occur while trying to create assign subject to teacher,
							please try again</span>";

						}
					
					
					}else{  /* display information message */ 

							$teacherData = staffData($conn, $teacherID);  /* school staffs/teachers information */ 
											
							list ($titleV, $teacherName, $sex, $staff_grade_v) = explode ("#@s@#", $teacherData);
							$titleVal = $title_list[$titleV];


							$msg_i = "This subject have already been assign to <b> 
							$titleVal $teacherName </b> ";

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
			echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
									
		}	


		if ($msg_e) { 
			echo $errorMsg.$msg_e.$eEnd;
			echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
									
		}	

		if ($msg_i) {

			echo $infoMsg.$msg_i.$iEnd;  
			echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
									
		}	
	
	

exit;
?>