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

        require 'fobrain-config.php';  /* load fobrain configuration files */	  
 
		if (($_REQUEST['query']) == 'exam-configs') {  /* save school exam type configuration */

			$status =  cleanInt($_REQUEST['status']);
			$rsType =  cleanInt($_REQUEST['rsType']);
			$first =  cleanInt($_REQUEST['first']);
			$second =  cleanInt($_REQUEST['second']);
			$third =  cleanInt($_REQUEST['third']);
			$fourth =  cleanInt($_REQUEST['fourth']);
			$fifth =  cleanInt($_REQUEST['fifth']);
			$sixth =  cleanInt($_REQUEST['sixth']);
			$exam =  cleanInt($_REQUEST['exam']);
			
			$total = intval($first) + intval($second) + intval($third) + intval($fourth) + intval($fifth) + intval($sixth) + intval($exam);
			
			/* script validation */ 
			
			if ($rsType == "")  {
				
				$msg_e = "* Ooops Error, please select  school result type template ";
				
			}elseif ($status == "")  {
				
				$msg_e = "* Ooops Error, please select  School No. of Continous Assessment ";
				
			}elseif ($first == "")  {
				
				$msg_e = "* Ooops Error, please input student first Continous Assessment Score";
					
			}elseif ($exam == "")  {
				
				$msg_e = "* Ooops Error, please input student Exam Score";
					
			}elseif (($total < 100) ||  ($total > 100)){
				
				$msg_e = "* Ooops Error, please total student Continous Assessment should be 100";
					
			}else {  /* update information */

				try { 
				
					$examArray = schoolExamConfigArrays($conn);  /* school exam configuration array  */
						
					$countArr = count($examArray); 
					
					if(($countArr == $i_false)){  /* check if array is empty */

						$ebele_mark = "INSERT INTO $rsExamConfigTB (fi_ass, se_ass, th_ass, fo_ass, fif_ass, six_ass, exam, 
						rsType, status)
						
						VALUES (:fi_ass, :se_ass, :th_ass, :fo_ass, :fif_ass, :six_ass, :exam, :rsType, :status)";
										
						$igweze_prep = $conn->prepare($ebele_mark);								
						$igweze_prep->bindValue(':fi_ass', $first);
						$igweze_prep->bindValue(':se_ass', $second);
						$igweze_prep->bindValue(':th_ass', $third);
						$igweze_prep->bindValue(':fo_ass', $fourth);
						$igweze_prep->bindValue(':fif_ass', $fifth);
						$igweze_prep->bindValue(':six_ass', $sixth);
						$igweze_prep->bindValue(':exam', $exam);
						$igweze_prep->bindValue(':rsType', $rsType);
						$igweze_prep->bindValue(':status', $status);
					
					}else{	

						$ebele_mark = "UPDATE $rsExamConfigTB SET
						
										fi_ass = :fi_ass,
										se_ass = :se_ass,
										th_ass = :th_ass,
										fo_ass = :fo_ass,
										fif_ass = :fif_ass,
										six_ass = :six_ass,
										exam = :exam,
										rsType = :rsType,
										status = :status
										
										WHERE ex_id = :ex_id";
										
						$igweze_prep = $conn->prepare($ebele_mark);								
						$igweze_prep->bindValue(':fi_ass', $first);
						$igweze_prep->bindValue(':se_ass', $second);
						$igweze_prep->bindValue(':th_ass', $third);
						$igweze_prep->bindValue(':fo_ass', $fourth);
						$igweze_prep->bindValue(':fif_ass', $fifth);
						$igweze_prep->bindValue(':six_ass', $sixth);
						$igweze_prep->bindValue(':exam', $exam);
						$igweze_prep->bindValue(':rsType', $rsType);
						$igweze_prep->bindValue(':status', $status);
						$igweze_prep->bindValue(':ex_id', $fiVal);
					
					}

					if($igweze_prep->execute()){  /* if sucessfully */

						$msg_s = "School continous assessment  was successfully Saved.";						
						echo "<script type='text/javascript'> $('#frmexamConfigs').slideUp(2000); </script>";								
					
					}else {  /* display error */ 

						$msg_e = "Ooops, an error has occur while trying to save school continous assessment. Please try again";
			
					}
						
				}catch(PDOException $e) {
			
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
				
				}			

			}
	
		}elseif (($_REQUEST['query']) == 'level-nur') {  /* save nursery school levels */

			$level_1 =  clean($_REQUEST['level_1']);
			$level_2 =  clean($_REQUEST['level_2']);
			$level_3 =  clean($_REQUEST['level_3']);
			
			/* script validation */ 
			
			if ($level_1 == "")  {
				
				$msg_e = "Ooops Error, please input a value for Standard 1";
				
			}elseif ($level_2 == "")  {
				
				$msg_e = "Ooops Error, please input a value for Standard 2";
				
			}elseif ($level_3 == "")  {
				
				$msg_e = "Ooops Error, please input a value for Standard 3";
				
			}else {  /* update information */ 


				try {
				
					$ebele_mark = "UPDATE $classLevelTB SET
							
									level = :level
									
									WHERE cl_id = :cl_id";
									
					$igweze_prep = $conn->prepare($ebele_mark);	
					
					$igweze_prep->bindValue(':level', $level_1);
					$igweze_prep->bindValue(':cl_id', $fiVal);
					$igweze_prep->execute();
					$igweze_prep->bindValue(':level', $level_2);
					$igweze_prep->bindValue(':cl_id', $seVal);
					$igweze_prep->execute();
					$igweze_prep->bindValue(':level', $level_3);
					$igweze_prep->bindValue(':cl_id', $thVal);
					$igweze_prep->execute();

					if ($igweze_prep) {  /* if sucessfully */

						$msg_s = "School Level Settings was Successfully Saved."; 
						echo "<script type='text/javascript'>  
							$('#frmlevelSettings').slideUp(2000);  
							$('#wiz-menu-l-1').html('".$level_1."');
							$('#wiz-menu-l-2').html('".$level_2."');
							$('#wiz-menu-l-3').html('".$level_3."'); 
						</script>";
							
					}else{ /* display error */

							$msg_e = "Ooops, An Error Has occur
							while trying to save School Level Settings, please try again";

					}
							
				}catch(PDOException $e) {
			
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
				
				}
				

			}
	
		}elseif (($_REQUEST['query']) == 'level-ps') {  /* save school levels */

			$level_1 =  clean($_REQUEST['level_1']);
			$level_2 =  clean($_REQUEST['level_2']);
			$level_3 =  clean($_REQUEST['level_3']);
			$level_4 =  clean($_REQUEST['level_4']);
			$level_5 =  clean($_REQUEST['level_5']);
			$level_6 =  clean($_REQUEST['level_6']);

			/* script validation */ 
			
			if ($level_1 == "")  {
				
				$msg_e = "Ooops Error, please input a value for Standard 1";
				
			}elseif ($level_2 == "")  {
				
				$msg_e = "Ooops Error, please input a value for Standard 2";
				
			}elseif ($level_3 == "")  {
				
				$msg_e = "Ooops Error, please input a value for Standard 3";
				
			}elseif ($level_4 == "")  {
				
				$msg_e = "Ooops Error, please input a value for Standard 4";
				
			}elseif ($level_5 == "")  {
				
				$msg_e = "Ooops Error, please input a value for Standard 5";
				
			}elseif ($level_6 == "")  {
				
				$msg_e = "Ooops Error, please input a value for Standard 6";
				
			}else {  /* update information */ 

				try {
				
					$ebele_mark = "UPDATE $classLevelTB SET
					
									level = :level
									
									WHERE cl_id = :cl_id";
									
					$igweze_prep = $conn->prepare($ebele_mark);	
					
					$igweze_prep->bindValue(':level', $level_1);
					$igweze_prep->bindValue(':cl_id', $fiVal);
					$igweze_prep->execute();
					$igweze_prep->bindValue(':level', $level_2);
					$igweze_prep->bindValue(':cl_id', $seVal);
					$igweze_prep->execute();
					$igweze_prep->bindValue(':level', $level_3);
					$igweze_prep->bindValue(':cl_id', $thVal);
					$igweze_prep->execute();
					$igweze_prep->bindValue(':level', $level_4);
					$igweze_prep->bindValue(':cl_id', $foVal);
					$igweze_prep->execute();
					$igweze_prep->bindValue(':level', $level_5);
					$igweze_prep->bindValue(':cl_id', $fifVal);
					$igweze_prep->execute();
					$igweze_prep->bindValue(':level', $level_6);
					$igweze_prep->bindValue(':cl_id', $sixVal);
					$igweze_prep->execute();  
	
					if ($igweze_prep) {  /* if sucessfully */

						$msg_s = "School level configuration was successfully Saved.";
						echo "<script type='text/javascript'>  
							$('#frmlevelSettings').slideUp(2000);  
							$('#wiz-menu-l-1').html('".$level_1."');
							$('#wiz-menu-l-2').html('".$level_2."');
							$('#wiz-menu-l-3').html('".$level_3."');
							$('#wiz-menu-l-4').html('".$level_4."');
							$('#wiz-menu-l-5').html('".$level_5."');
							$('#wiz-menu-l-6').html('".$level_6."');
						</script>";
					
					}else {  /* display error */

						$msg_e = "Ooops, An Error Has occur while trying to save school level configuration, please try again";

					}
					
				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				}				

			}
	
		}elseif (($_REQUEST['query']) == 'min-course-nur') {  /* save nursery minimum courses */

			$level_1 =  clean($_REQUEST['level_1']);
			$level_2 =  clean($_REQUEST['level_2']);
			$level_3 =  clean($_REQUEST['level_3']);
			
			/* script validation */
			
			if ($level_1 == "")  {
				
				$msg_e = "Ooops Error, please input a value for Standard 1";
				
			}elseif ($level_2 == "")  {
				
				$msg_e = "Ooops Error, please input a value for Standard 2";
				
			}elseif ($level_3 == "")  {
				
				$msg_e = "Ooops Error, please input a value for Standard 3";
				
			}else {  /* update information */  

				try {
				
					$ebele_mark = "UPDATE $classLevelTB SET
					
									minCourse = :minCourse
									
									WHERE cl_id = :cl_id";
									
					$igweze_prep = $conn->prepare($ebele_mark);	
					
					$igweze_prep->bindValue(':minCourse', $level_1);
					$igweze_prep->bindValue(':cl_id', $fiVal);
					$igweze_prep->execute();
					$igweze_prep->bindValue(':minCourse', $level_2);
					$igweze_prep->bindValue(':cl_id', $seVal);
					$igweze_prep->execute();
					$igweze_prep->bindValue(':minCourse', $level_3);
					$igweze_prep->bindValue(':cl_id', $thVal);
					$igweze_prep->execute();

					if ($igweze_prep) {  /* if sucessfully */

						$msg_s = "School Minimum Number of courses configuration  was successfully saved.";
						echo "<script type='text/javascript'>  $('#frmminCourseConfig').slideUp(2000);  </script>";
							
					}else {  /* display error */

						$msg_e = "Ooops, An Error Has occur while trying to save School  Minimum Number of courses configuration, please try again";

					}
			
				}catch(PDOException $e) {
			
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
				
				} 

			}
	
		}elseif (($_REQUEST['query']) == 'min-course-ps') {  /* save primary and secondary minimum courses */

			$level_1 =  clean($_REQUEST['level_1']);
			$level_2 =  clean($_REQUEST['level_2']);
			$level_3 =  clean($_REQUEST['level_3']);
			$level_4 =  clean($_REQUEST['level_4']);
			$level_5 =  clean($_REQUEST['level_5']);
			$level_6 =  clean($_REQUEST['level_6']);

			/* script validation */ 
			
			if ($level_1 == "")  {
				
				$msg_e = "Ooops Error, please input a value for Standard 1";
				
			}elseif ($level_2 == "")  {
				
				$msg_e = "Ooops Error, please input a value for Standard 2";
				
			}elseif ($level_3 == "")  {
				
				$msg_e = "Ooops Error, please input a value for Standard 3";
				
			}elseif ($level_4 == "")  {
				
				$msg_e = "Ooops Error, please input a value for Standard 4";
				
			}elseif ($level_5 == "")  {
				
				$msg_e = "Ooops Error, please input a value for Standard 5";
				
			}elseif ($level_6 == "")  {
				
				$msg_e = "Ooops Error, please input a value for Standard 6";
				
			}else {  /* update information */  

				try {
				
					$ebele_mark = "UPDATE $classLevelTB SET
					
									minCourse = :minCourse
									
									WHERE cl_id = :cl_id";
									
					$igweze_prep = $conn->prepare($ebele_mark);	
					
					$igweze_prep->bindValue(':minCourse', $level_1);
					$igweze_prep->bindValue(':cl_id', $fiVal);
					$igweze_prep->execute();
					$igweze_prep->bindValue(':minCourse', $level_2);
					$igweze_prep->bindValue(':cl_id', $seVal);
					$igweze_prep->execute();
					$igweze_prep->bindValue(':minCourse', $level_3);
					$igweze_prep->bindValue(':cl_id', $thVal);
					$igweze_prep->execute();
					$igweze_prep->bindValue(':minCourse', $level_4);
					$igweze_prep->bindValue(':cl_id', $foVal);
					$igweze_prep->execute();
					$igweze_prep->bindValue(':minCourse', $level_5);
					$igweze_prep->bindValue(':cl_id', $fifVal);
					$igweze_prep->execute();
					$igweze_prep->bindValue(':minCourse', $level_6);
					$igweze_prep->bindValue(':cl_id', $sixVal);
					$igweze_prep->execute(); 
					
					if ($igweze_prep) {  /* if sucessfully */ 

						$msg_s = "School Minimum Number of courses configuration  was successfully saved.";
						echo "<script type='text/javascript'>  $('#frmminCourseConfig').slideUp(2000);  </script>";
							
					}else {  /* display error */

						$msg_e = "Ooops, An Error Has occur while trying to save School Minimum Number of courses configuration, please try again";

					}

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				}					
			

			}
	
		}elseif (($_REQUEST['query']) == 'class-nur') {  /* save nursery classes */

			$class_fi =  clean($_REQUEST['class_1']);
			$class_se =  clean($_REQUEST['class_2']);
			$class_th =  clean($_REQUEST['class_3']);
			
			/* script validation */

			foreach ($_REQUEST['class_1'] as  $value_fi){  /* loop array */
				
				$valueC_fi = clean($value_fi);
				
				if ( (!empty($valueC_fi)) || ($valueC_fi != ''))  { $class_fiArr[] = $valueC_fi; }
			
			}

			foreach ($_REQUEST['class_2'] as  $value_se){  /* loop array */
				
				$valueC_se = clean($value_se);
				
				if ( (!empty($valueC_se)) || ($valueC_se != ''))  { $class_seArr[] = $valueC_se; }
			
			}

			foreach ($_REQUEST['class_3'] as  $value_th){  /* loop array */
				
				$valueC_th = clean($value_th);
				
				if ( (!empty($valueC_th)) || ($valueC_th != ''))  { $class_thArr[] = $valueC_th; }
			
			}

			$count_fiArr = count($class_fiArr);
			$count_seArr = count($class_seArr);
			$count_thArr = count($class_thArr);
			

			if ($count_fiArr == $i_false) {
				
				$msg_e = "Ooops Error, please input a value for Standard 1";
				
			}elseif ($count_seArr == $i_false)  {
				
				$msg_e = "Ooops Error, please input a value for Standard 2";
				
			}elseif ($count_thArr == $i_false)  {
				
				$msg_e = "Ooops Error, please input a value for Standard 3";
				
			}else {  /* update information */   

				try {

					$class_fiArray = array_unique($class_fiArr);
					$class_seArray = array_unique($class_seArr);
					$class_thArray = array_unique($class_thArr);
					
					$class_1 = serialize($class_fiArray);
					$class_2 = serialize($class_seArray);
					$class_3 = serialize($class_thArray);
					
					$ebele_mark = "UPDATE $classLevelTB SET
					
									class = :class
									
									WHERE cl_id = :cl_id";
									
					$igweze_prep = $conn->prepare($ebele_mark);	
					
					$igweze_prep->bindValue(':class', $class_1);
					$igweze_prep->bindValue(':cl_id', $fiVal);
					$igweze_prep->execute();
					
					$igweze_prep->bindValue(':class', $class_2);
					$igweze_prep->bindValue(':cl_id', $seVal);
					$igweze_prep->execute();
					
					$igweze_prep->bindValue(':class', $class_3);
					$igweze_prep->bindValue(':cl_id', $thVal);
					$igweze_prep->execute();
						
					if ($igweze_prep) {  /* if sucessfully */ 

						$msg_s = "School class name was successfully saved.";
						echo "<script type='text/javascript'>  $('#frmclassSettings').slideUp(2000);  </script>";
							
					}else {  /* display error */ 

						$msg_e = "Ooops, An Error Has occur while trying to save School class name, please try again";

					}

				}catch(PDOException $e) {
			
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
				
				} 

			}
					
		}elseif (($_REQUEST['query']) == 'class-ps') {  /* save primary and secondary classes */

			$class_fi =  clean($_REQUEST['class_1']);
			$class_se =  clean($_REQUEST['class_2']);
			$class_th =  clean($_REQUEST['class_3']);
			$class_fo =  clean($_REQUEST['class_4']);
			$class_fif =  clean($_REQUEST['class_5']);
			$class_six =  clean($_REQUEST['class_6']);
			
			/* script validation */ 
			
			foreach ($_REQUEST['class_1'] as  $value_fi){  /* loop array */
				
				$valueC_fi = clean($value_fi);
				
				if ( (!empty($valueC_fi)) || ($valueC_fi != ''))  { $class_fiArr[] = $valueC_fi; }
			
			}

			foreach ($_REQUEST['class_2'] as  $value_se){  /* loop array */
				
				$valueC_se = clean($value_se);
				
				if ( (!empty($valueC_se)) || ($valueC_se != ''))  { $class_seArr[] = $valueC_se; }
			
			}

			foreach ($_REQUEST['class_3'] as  $value_th){  /* loop array */
				
				$valueC_th = clean($value_th);
				
				if ( (!empty($valueC_th)) || ($valueC_th != ''))  { $class_thArr[] = $valueC_th; }
			
			}

			foreach ($_REQUEST['class_4'] as  $value_fo){  /* loop array */
				
				$valueC_fo = clean($value_fo);
				
				if ( (!empty($valueC_fo)) || ($valueC_fo != ''))  { $class_foArr[] = $valueC_fo; }
			
			}

			foreach ($_REQUEST['class_5'] as  $value_fif){  /* loop array */
				
				$valueC_fif = clean($value_fif);
				
				if ( (!empty($valueC_fif)) || ($valueC_fif != ''))  { $class_fifArr[] = $valueC_fif; }
			
			}

			foreach ($_REQUEST['class_6'] as  $value_six){  /* loop array */
				
				$valueC_six = clean($value_six);
				
				if ( (!empty($valueC_six)) || ($valueC_six != ''))  { $class_sixArr[] = $valueC_six; }
			
			}

			$count_fiArr = count($class_fiArr);
			$count_seArr = count($class_seArr);
			$count_thArr = count($class_thArr);
			$count_foArr = count($class_foArr);
			$count_fifArr = count($class_fifArr);
			$count_sixArr = count($class_sixArr); 

			if ($count_fiArr == $i_false) {
				
				$msg_e = "Ooops Error, please input a value for Standard 1";
				
			}elseif ($count_seArr == $i_false)  {
				
				$msg_e = "Ooops Error, please input a value for Standard 2";
				
			}elseif ($count_thArr == $i_false)  {
				
				$msg_e = "Ooops Error, please input a value for Standard 3";
				
			}elseif ($count_foArr == $i_false)  {
				
				$msg_e = "Ooops Error, please input a value for Standard 4";
				
			}elseif ($count_fifArr == $i_false)  {
				
				$msg_e = "Ooops Error, please input a value for Standard 5";
				
			}elseif ($count_sixArr == $i_false)  {
				
				$msg_e = "Ooops Error, please input a value for Standard 6";
				
			}else {

				try {				

					$class_fiArray = array_unique($class_fiArr);
					$class_seArray = array_unique($class_seArr);
					$class_thArray = array_unique($class_thArr);
					$class_foArray = array_unique($class_foArr);
					$class_fifArray = array_unique($class_fifArr);
					$class_sixArray = array_unique($class_sixArr);
					
					$class_1 = serialize($class_fiArray);
					$class_2 = serialize($class_seArray);
					$class_3 = serialize($class_thArray);
					$class_4 = serialize($class_foArray);
					$class_5 = serialize($class_fifArray);
					$class_6 = serialize($class_sixArray); 
			
					$ebele_mark = "UPDATE $classLevelTB SET
					
									class = :class
									
									WHERE cl_id = :cl_id";
									
					$igweze_prep = $conn->prepare($ebele_mark);	
					
					$igweze_prep->bindValue(':class', $class_1);
					$igweze_prep->bindValue(':cl_id', $fiVal);
					$igweze_prep->execute();
					
					$igweze_prep->bindValue(':class', $class_2);
					$igweze_prep->bindValue(':cl_id', $seVal);
					$igweze_prep->execute();
					
					$igweze_prep->bindValue(':class', $class_3);
					$igweze_prep->bindValue(':cl_id', $thVal);
					$igweze_prep->execute();
					
					$igweze_prep->bindValue(':class', $class_4);
					$igweze_prep->bindValue(':cl_id', $foVal);
					$igweze_prep->execute();
					
					$igweze_prep->bindValue(':class', $class_5);
					$igweze_prep->bindValue(':cl_id', $fifVal);
					$igweze_prep->execute();
					
					$igweze_prep->bindValue(':class', $class_6);
					$igweze_prep->bindValue(':cl_id', $sixVal);
					$igweze_prep->execute(); 

					if ($igweze_prep) {  /* if sucessfully */

						$msg_s = "School class name was successfully saved.";
						echo "<script type='text/javascript'>  $('#frmclassSettings').slideUp(2000);  </script>";
							
					}else {  /* display error */ 

						$msg_e = "Ooops, An Error Has occur  while trying to save School Class Name, please try again";

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
			echo"<script type='text/javascript'> hidePageLoader(); </script>";
			exit; 					
		}	 
exit;
?>