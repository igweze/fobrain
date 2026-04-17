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
		
			if (($_REQUEST['search'] == 'transcript') || (isset($_REQUEST['studentReg'])) ){  /* load student result transcript */	   
	
				/* script validation */ 
				
				if (((isset($_REQUEST['regnum'])) || (isset($_REQUEST['level'])) || (isset($_REQUEST['term']))) 
				|| (isset($_REQUEST['studentReg']))) {
					
					$regNum = clean($_REQUEST['regnum']);
					$level = clean($_REQUEST['level']);	
					$term = clean($_REQUEST['term']);
					
					$printArea = 'fobrain-print';
					
					if($_REQUEST['studentReg']) {
					
						$search_reg =  clean($_REQUEST['studentReg']);
						
						list ($regNum, $level, $term) = explode ("@@", $search_reg); 

$print_btn =<<<IGWEZE
						 
						<div class="text-end">
							<a href="javascript:;"  onclick="printDiv('fobrain-print-ovly')" 
							class="btn btn-primary waves-effect btn-label waves-light mb-10">
								<i class="fas fa-print label-icon"></i>  Print
							</a>
						</div>

IGWEZE;
					
						echo $print_btn;
						
						$printArea = 'fobrain-print-ovly';
					
					}


					try {
					
						echo "<div id='$printArea' class='mt-10'>";  	
					
							$sessionID = studentRegSessionID($conn, $regNum);  /* student school session ID */
							$session_fi = fobrainSession($conn, $sessionID);   /* school session  */					
						
							$session_se = $session_fi + $foreal;  
							$class = studentClass($conn, $regNum, $level);  /* retrieve a student class */ 

							$examArray = schoolExamConfigArrays($conn);  /* school exam configuration array  */
							$exam_status = $examArray[0]['status'];	
							$rsType = $examArray[0]['rsType'];  

							if ($term == 'all'){  /* if annual result */  
								
								$term = $fi_term; $promotionStatus = false;	$subfCounter = 0;
								
								require  $fobrainClassConfigDir;   /* include class configuration script */  
								
								require ($fobrainSessionRSDir);    /* include annual result */ 
								
								$promotionStatus = false;  

							}else{  /* if  termly result */ 
								
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
		

				}else {  /* display error */ 

					$msg_e =  $formErrorMsg;
					
					echo $errorMsg.$msg_e.$eEnd; echo $scroll_up;  
	
				}
				
				echo "<script type='text/javascript'>  hidePageLoader(); </script>"; exit;
			
			}elseif ($_REQUEST['search'] == 'session-rs') {  /* load class result transcript */ 
				 
				/* script validation */
			
				if ((isset($_REQUEST['sess']) != "") && (isset($_REQUEST['level']) != "") && (isset($_REQUEST['class']) != "") 
					&& (isset($_REQUEST['term']) != "") )  {  

					$annual = false;
					
					$session = clean($_REQUEST['sess']);
					$level = clean($_REQUEST['level']); 	
					$term = clean($_REQUEST['term']);  
					$class_data = clean($_REQUEST['class']);

					list ($class, $class_val) = explode ("@+@", $class_data);
					list ($session_val, $level_key, $level_val) = explode ("#@@#", clean($_REQUEST['sesslevel']));
					
					if($term == "annual"){
						
						$term = 3;
						$annual = true;
					}

					try {
			 
						echo "<div id='fobrain-print'>";
					 
							$sessionID = sessionID($conn, $session); 					
				
							$session_fi = $session;
							$session_se = $session_fi + $foreal;  

							require  $fobrainClassConfigDir;   /* include class configuration script */ 
							
							if($class == 'all'){
								
								require_once ($fobrainAllClass);   /* include all class result page */ 
								
							}elseif($annual == true){
									
								require_once ($fobrainGlobalRSDir.'wiz-class-session.php');   /* include class annual result page */ 
								
							}else{
								
								require_once ($fobrainClassRSManagerDir);   /* include  class result page */ 
								
							}

						echo "</div>";
					
					
					}catch(PDOException $e) {
				
						fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
				 
					}
		

				}else {  /* display error */ 

					$msg_e =  $formErrorMsg;
					echo $errorMsg.$msg_e.$eEnd; 
	 
				}

				echo "<script type='text/javascript'>  hidePageLoader(); </script>"; exit;
				
			
			}elseif ($_REQUEST['search'] == 'export-rs') {  /* export class result  */
			
				/* script validation */
				
				if ((isset($_REQUEST['sess'])) && (isset($_REQUEST['level'])) && (isset($_REQUEST['class'])) 
				&& (isset($_REQUEST['term'])) )  { 
	 
					$session = clean($_REQUEST['sess']);
					$level = clean($_REQUEST['level']); 	
					$term = clean($_REQUEST['term']);  
					$class_data = clean($_REQUEST['class']);

					list ($class, $class_val) = explode ("@+@", $class_data);
					list ($session_val, $level_key, $level_val) = explode ("#@@#", clean($_REQUEST['sesslevel']));
			 
					try {
			  
						echo "<div id='fobrain-print'>";
					 
							$sessionID = sessionID($conn, $session);   /* school session ID */ 
				
							$session_fi = $session;
							$session_se = $session_fi + $foreal; 

							require  $fobrainClassConfigDir;   /* include class configuration script */ 
							
							if($query_i_scores != ""){   /* check if query is empty */ 
								
								require_once ($fobrainExportRSDir);   /* include class export result file */ 
								
							}else{
								
								$msg_e = "Ooops error, no subject/course information was added for 
								<span class='bold-msg'> $stu_class $class $term_value </span>";						
								echo $erroMsg.$msg_e.$msgEnd; 	
								
							}	

						echo "</div>";
						
					}catch(PDOException $e) {
				
						fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
				 
					}
				 
        		}else {  /* display error */

        			$msg_e =  $formErrorMsg;
					echo $errorMsg.$msg_e.$eEnd; echo $scroll_up; 
 
        		}

			    echo "<script type='text/javascript'>  hidePageLoader(); </script>"; exit;
			
			}elseif ($_REQUEST['search'] == 'exportScanRS') {  /* export class result  */
			
				/* script validation */
				
				if ((isset($_REQUEST['sess'])) && (isset($_REQUEST['level'])) && (isset($_REQUEST['class'])) )  { 

					$session = $_REQUEST['sess'];
					$level = $_REQUEST['level'];
					$class = $_REQUEST['class']; 

					try {
			 
						echo "<div id='fobrain-print'>";
					 
							$sessionID = sessionID($conn, $session);   /* school session ID */ 
							
				
							$session_fi = $session;
							$session_se = $session_fi + $foreal;

							$term = $fiVal;
							
							require  $fobrainClassConfigDir;   /* include class configuration script */ 
							
							if($query_i_scores != ""){   /* check if query is empty */
								
								require_once ($exportScanRSDir);   /* include class export result file */  
								
							}else{
								
								$msg_e = "Ooops error, no subject/course information was added for 
								<span class='bold-msg'> $stu_class $class $term_value </span>";						
								echo $erroMsg.$msg_e.$msgEnd; 	
								
							}	 

						echo "</div>";
						
					}catch(PDOException $e) {
				
						fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
				 
					} 

        		}else {  /* display error */

        			$msg_e =  $formErrorMsg;
					echo $errorMsg.$msg_e.$eEnd; echo $scroll_up;  
 
        		}

			    echo "<script type='text/javascript'>  hidePageLoader(); </script>"; exit;
			
			}else{
			
				echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
			
			} 
			
exit;		 
?>