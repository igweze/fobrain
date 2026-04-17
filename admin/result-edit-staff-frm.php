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
	This script handle student result edit 
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

		define('fobrain', 'igweze');  /* define a check for wrong access of file */

		require 'fobrain-config.php';  /* load fobrain configuration files */	   
				
		if ($_REQUEST['rsData'] != '') {

			list ($regNum, $session, $level, $class, $term, $exitStatus, $rs_status) = explode ("@@", $_REQUEST['rsData']);
			
			$rs_header = ""; $exam_score = "";
			
			require_once $fobrainClassConfigDir;   /* include class configuration script */  
			
			try { 
				
				$examArray = schoolExamConfigArrays($conn);  /* school exam configuration array  */
				
				$exam_status = $examArray[0]['status'];	
				$exam_fi = $examArray[0]['fi_ass'];	
				$exam_se = $examArray[0]['se_ass'];	
				$exam_th = $examArray[0]['th_ass'];	
				$exam_fo = $examArray[0]['fo_ass'];	
				$exam_fif = $examArray[0]['fif_ass'];	
				$exam_six = $examArray[0]['six_ass'];
				$exam_score_config = $examArray[0]['exam'];	

				$sessionID = studentRegSessionID($conn, $regNum);  /* student school session ID */  

				echo '<style>
				
					.numbers{
						text-align:center !important;
					}
				
				</style>';
				
				/* select result */ 	 
				
				$ebele_mark = "SELECT  s.$query_i_scores
				
								FROM $i_reg_tb r INNER JOIN $sdoracle_score_nk s
								
								ON (r.ireg_id = s.ireg_id)

								AND r.session_id = :session_id 
							
								AND r.$nk_class = :class

								AND r.active = :foreal
							
								AND r.nk_regno =  :nk_regno"; 
						
				$igweze_prep = $conn->prepare($ebele_mark);
				$igweze_prep->bindValue(':nk_regno', $regNum, PDO::PARAM_STR);					
				$igweze_prep->bindValue(':session_id', $sessionID, PDO::PARAM_STR);					
				$igweze_prep->bindValue(':foreal', $foreal, PDO::PARAM_STR);					
				$igweze_prep->bindValue(':class', $class, PDO::PARAM_STR);					 
				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count == $foreal) {  /* if sucessfully */
				
						while($row[] = $igweze_prep->fetch(PDO::FETCH_BOTH)) {	 }
				
				}else{  /* display error */ 
						
						$msg_e .=  "Student record with <span>$regNum  </span> was not found.";
						echo $erroMsg.$msg_e.$msgEnd;  exit;			
						
				} 	

			
				$a = 1; $b = 2; $c = 3; $d = 4; $e = 5; $f = 6; $g = 7; $h = 8; 
			
				$add_data = $session.'@@'.$level.'@@'.$class.'@@'.$term; 
				
				if($exitStatus == $foreal){  /* check exit status */   
						
					$scrollType = $foVal;
			
				}else{  
					
					$scrollType = ''; 
						
				}
				
			}catch(PDOException $e) {
		
				fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
			}					
				
?>    
 
				   
		<div id="msgBox"></div>
		<!-- form -->
		<form class="form-horizontal" id="frmSaveRs" role="form">

			<input type="hidden" name="nj_level" value="<?php echo $level ?>">
			<input type="hidden" name="nj_term" value="<?php echo $term ?>" />
			<input type="hidden" name="nj_class" value="<?php echo $class ?>" /> 
			<input type="hidden" name="hidefrm" value="hidefrmDiv" />
			<input type="hidden" name="regnum" value = "<?php echo $regNum; ?>"/>
			<input type="hidden" name="rs_status" value = "<?php echo $rs_status; ?>"/>
			<?php
			if($scrollType == $foVal){ 
				echo '<input type="hidden" name="scrollType"  value="overlayScroll" />'; 
			}
			?>   
			<!-- row -->
			<div class="row gutters fs-16  my-25">
				<div class="hints text-center">
					[<i class="mdi mdi-alphabetical-variant"></i>] 
					Reg. No. : <span class="fw-600 "><?php echo $regNum; ?></span>
					<input type="hidden" class="form-control numbers" placeholder="2007001/SEC" 
					name="regnumD" id="regnumD" value = "<?php echo $regNum; ?>"  required /> 
				</div>
			</div>
			<!-- /row -->

			<hr class="my-10 text-danger" /> 

				

			<?php
		

			if($exam_status == $fiVal){  /* check exam configuration status */
			
				$rs_header .= '<div class="col-lg-5">
							<strong>Subjects Name</strong>
					</div> ';
					
				$rs_header .= '<div class="col-lg-3 fobrain-fi-div">
							<strong>Test/ASE('.$exam_fi.')</strong>
					</div>
				
				<div class="col-lg-3">
							<strong>EXAM('.$exam_score.')</strong>
				</div>';												  
			
			}elseif($exam_status == $seVal){  /* check exam configuration status */

				$rs_header .= '<div class="col-lg-5">
							<strong>Subjects Name</strong>
					</div> ';

				$rs_header .= '<div class="col-lg-2 fobrain-fi-div">
							<strong>Test/ASE('.$exam_fi.')</strong>
					</div>
				<div class="col-lg-2 fobrain-se-div">
							<strong>Test/ASE('.$exam_se.')</strong>
					</div>
				
				<div class="col-lg-2">
							<strong>EXAM('.$exam_score.')</strong>
				</div>';												  
			
			}elseif($exam_status == $thVal){  /* check exam configuration status */

				$rs_header .= '<div class="col-lg-4">
							<strong>Subjects Name</strong>
					</div> ';

				$rs_header .= '<div class="col-lg-2 fobrain-fi-div">
							<strong>Test/ASE('.$exam_fi.')</strong>
					</div>
				<div class="col-lg-2 fobrain-se-div">
							<strong>Test/ASE('.$exam_se.')</strong>
					</div>
				<div class="col-lg-2 fobrain-th-div">
							<strong>Test/ASE('.$exam_th.')</strong>
					</div>
				<div class="col-lg-2">
							<strong>EXAM('.$exam_score.')</strong>
					</div>';												  
			
			}elseif($exam_status == $foVal){  /* check exam configuration status */

				$rs_header .= '<div class="col-lg-2">
							<strong>Subjects Name</strong>
					</div> ';

				$rs_header .= '<div class="col-lg-2 fobrain-fi-div">
							<strong>Test/ASE('.$exam_fi.')</strong>
					</div>
				<div class="col-lg-2 fobrain-se-div">
							<strong>Test/ASE('.$exam_se.')</strong>
					</div>
				<div class="col-lg-2 fobrain-th-div">
							<strong>Test/ASE('.$exam_th.')</strong>
					</div>									  
				<div class="col-lg-2 fobrain-fo-div">
							<strong>Test/ASE('.$exam_fo.')</strong>
					</div>  
				<div class="col-lg-2">
							<strong>EXAM('.$exam_score.')</strong>
					</div>';												  
			
			}elseif($exam_status == $fifVal){  /* check exam configuration status */

				$rs_header .= '<div class="col-lg-2">
							<strong>Subjects Name</strong>
					</div> ';

				$rs_header .= '<div class="col-lg-2 fobrain-fi-div">
							<strong>Test/ASE('.$exam_fi.')</strong>
					</div>
				<div class="col-lg-2 fobrain-se-div">
							<strong>Test/ASE('.$exam_se.')</strong>
					</div>
				<div class="col-lg-2 fobrain-th-div">
							<strong>Test/ASE('.$exam_th.')</strong>
					</div>									  
				<div class="col-lg-2 fobrain-fo-div">
							<strong>Test/ASE('.$exam_fo.')</strong>
					</div> 
				<div class="col-lg-2 fobrain-fo-div">
							<strong>Test/ASE('.$exam_fif.')</strong>
					</div>   
				<div class="col-lg-2">
							<strong>EXAM('.$exam_score.')</strong>
					</div>';												  
			
			}elseif($exam_status == $sixVal){  /* check exam configuration status */

				$rs_header .= '<div class="col-lg-2">
							<strong>Subjects Name</strong>
					</div> ';

				$rs_header .= '<div class="col-lg-2 fobrain-fi-div">
							<strong>Test/ASE('.$exam_fi.')</strong>
					</div>
				<div class="col-lg-2 fobrain-se-div">
							<strong>Test/ASE('.$exam_se.')</strong>
					</div>
				<div class="col-lg-2 fobrain-th-div">
							<strong>Test/ASE('.$exam_th.')</strong>
					</div>									  
				<div class="col-lg-2 fobrain-fo-div">
							<strong>Test/ASE('.$exam_fo.')</strong>
					</div> 
				<div class="col-lg-2 fobrain-fo-div">
							<strong>Test/ASE('.$exam_fif.')</strong>
					</div>
				<div class="col-lg-2 fobrain-fo-div">
							<strong>Test/ASE('.$exam_six.')</strong>
					</div>  
				<div class="col-lg-2">
							<strong>EXAM('.$exam_score.')</strong>
					</div>';												  
			
			}else{									
				
				$msg_e = "Ooops Error, please notify school admin to set school continous assessment before student results can be added.";									
				echo $erroMsg.$msg_e.$msgEnd; echo $scroll_up; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>"; exit;
			
			} 

			$course_codes = $course_info_mark;
			$course_codes_r = $course_info_mark;
	
			$ii = 0;    $iii = 0; $ie = 0;
			$show_course = false;
			$st_course_count = 0;

			for ($i = $start_nkiru ; $i <= $stop_njideka; $i++) {  /* loop array */  

				$staff_course = unserialize($course_codes[$i][9]);	  
	
				if(is_array($staff_course)){  /* check if array */  

					$staff_course = array_unique($staff_course);

					if (in_array($_SESSION['adminID'], $staff_course)) {  /* check staff */ 
						 
						$show_course = true;
					 
					}else{

						$show_course = false;
						
					}

				}else{ $show_course = false; }	

				if($show_course == true){ 

					$st_course_count++;

					if($exam_status == $fiVal){  /* check exam configuration status */

						list ($fi_score, $exam_score) = explode (",", $row[0][$ie]);
						
						$course_a = $course_codes_r[$i][0];								
						$course_exam = $course_codes_r[$i][0];
				
						$course_a = $course_a."[$a]";  $course_exam = $course_exam."[$g]";			
						$course_a = strtolower($course_a);       
						$course_exam = strtolower($course_exam);  

						echo ' 
						<!-- row -->
						<div class="row gutters">
							<div class="hints fw-600">
								[<i class="mdi mdi-alphabetical-variant"></i>]';
								echo substr($course_codes[$i][$b], 0, 20);
						echo '		
							</div>
						</div>
						<!-- /row -->'; 
						
						echo '
						<!-- row -->
						<div class="row gutters  justify-content-center">
							<div class="col-lg-2">										
								<!-- field wrapper start -->
								<div class="field-wrapper">										 
									<input type="number" class="form-control numbers" 
									name="'.$course_a.'" id="'.$course_a.'" value="'.$fi_score.'" data-min="0" data-max="'.$exam_fi.'" requireQ />
									<div class="field-placeholder"> Test ('.$exam_fi.') <span class="text-danger">*</span></div>
								</div>
								<!-- field wrapper end -->
							</div>'; 

						echo '							
							<div class="col-lg-3">										
								<!-- field wrapper start -->
								<div class="field-wrapper">										 
									<input type="number" class="form-control numbers" 
									name="'.$course_exam.'" id="'.$course_exam.'" value="'.$exam_score.'" data-min="0" data-max="'.$exam_score_config.'" requireQ />
									<div class="field-placeholder"> Exam ('.$exam_score_config.') <span class="text-danger">*</span></div>
								</div>
								<!-- field wrapper end -->
							</div>
						</div>
						<hr class="my-10 text-danger" />';
					
					}elseif($exam_status == $seVal){  /* check exam configuration status */

						list ($fi_score, $se_score, $exam_score) = explode (",", $row[0][$ie]);
						
						$course_a = $course_codes_r[$i][0];
						$course_b = $course_codes_r[$i][0];
						$course_exam = $course_codes_r[$i][0];
				
						$course_a = $course_a."[$a]"; $course_b = $course_b."[$b]"; $course_exam = $course_exam."[$g]";
				
						$course_a = strtolower($course_a);      $course_b = strtolower($course_b);      $course_exam = strtolower($course_exam);
						
						echo ' 
						<!-- row -->
						<div class="row gutters">
							<div class="hints fw-600">
								[<i class="mdi mdi-alphabetical-variant"></i>]';
								echo substr($course_codes[$i][$b], 0, 20);
						echo '		
							</div>
						</div>
						<!-- /row -->'; 
						
						echo '
						<!-- row -->
						<div class="row gutters  justify-content-center">
							<div class="col-lg-2">										
								<!-- field wrapper start -->
								<div class="field-wrapper">										 
									<input type="number" class="form-control numbers" 
									name="'.$course_a.'" id="'.$course_a.'" value="'.$fi_score.'" data-min="0" data-max="'.$exam_fi.'" requireQ />
									<div class="field-placeholder"> Test ('.$exam_fi.') <span class="text-danger">*</span></div>
								</div>
								<!-- field wrapper end -->
							</div>';

						echo '							
							<div class="col-lg-2">										
								<!-- field wrapper start -->
								<div class="field-wrapper">										 
									<input type="number" class="form-control numbers" 
									name="'.$course_b.'" id="'.$course_b.'" value="'.$se_score.'" data-min="0" data-max="'.$exam_se.'" requireQ />
									<div class="field-placeholder"> Test ('.$exam_se.') <span class="text-danger">*</span></div>
								</div>
								<!-- field wrapper end -->
							</div>';  

						echo '							
							<div class="col-lg-3">										
								<!-- field wrapper start -->
								<div class="field-wrapper">										 
									<input type="number" class="form-control numbers" 
									name="'.$course_exam.'" id="'.$course_exam.'" value="'.$exam_score.'" data-min="0" data-max="'.$exam_score_config.'" requireQ />
									<div class="field-placeholder"> Exam ('.$exam_score_config.') <span class="text-danger">*</span></div>
								</div>
								<!-- field wrapper end -->
							</div>
						</div>
						<hr class="my-10 text-danger" />';
					
					}elseif($exam_status == $thVal){  /* check exam configuration status */

						list ($fi_score, $se_score, $th_score, $exam_score) = explode (",", $row[0][$ie]);
						
						$course_a = $course_codes_r[$i][0];
						$course_b = $course_codes_r[$i][0];
						$course_c = $course_codes_r[$i][0];
						$course_exam = $course_codes_r[$i][0];
				
						$course_a = $course_a."[$a]"; $course_b = $course_b."[$b]";   $course_c = $course_c."[$c]";  					
						$course_exam = $course_exam."[$g]";
				
						$course_a = strtolower($course_a);      $course_b = strtolower($course_b);      $course_c = strtolower($course_c);
						$course_exam = strtolower($course_exam); 
						
						echo ' 
						<!-- row -->
						<div class="row gutters">
							<div class="hints fw-600">
								[<i class="mdi mdi-alphabetical-variant"></i>]';
								echo substr($course_codes[$i][$b], 0, 20);
						echo '		
							</div>
						</div>
						<!-- /row -->'; 
						
						echo '
						<!-- row -->
						<div class="row gutters  justify-content-center">
							<div class="col-lg-2">										
								<!-- field wrapper start -->
								<div class="field-wrapper">										 
									<input type="number" class="form-control numbers" 
									name="'.$course_a.'" id="'.$course_a.'" value="'.$fi_score.'" data-min="0" data-max="'.$exam_fi.'" requireQ />
									<div class="field-placeholder"> Test ('.$exam_fi.') <span class="text-danger">*</span></div>
								</div>
								<!-- field wrapper end -->
							</div>';

						echo '							
							<div class="col-lg-2">										
								<!-- field wrapper start --> 
								<div class="field-wrapper">										 
									<input type="number" class="form-control numbers" 
									name="'.$course_b.'" id="'.$course_b.'" value="'.$se_score.'" data-min="0" data-max="'.$exam_se.'" requireQ />
									<div class="field-placeholder"> Test ('.$exam_se.') <span class="text-danger">*</span></div>
								</div>
								<!-- field wrapper end -->
							</div>';
							
						echo '							
							<div class="col-lg-2">										
								<!-- field wrapper start -->
								<div class="field-wrapper">										 
									<input type="number" class="form-control numbers" 
									name="'.$course_c.'" id="'.$course_c.'" value="'.$th_score.'" data-min="0" data-max="'.$exam_th.'" requireQ />
									<div class="field-placeholder"> Test ('.$exam_th.') <span class="text-danger">*</span></div>
								</div>
								<!-- field wrapper end -->
							</div>'; 

						echo '							
							<div class="col-lg-3">										
								<!-- field wrapper start -->
								<div class="field-wrapper">										 
									<input type="number" class="form-control numbers" 
									name="'.$course_exam.'" id="'.$course_exam.'" value="'.$exam_score.'" data-min="0" data-max="'.$exam_score_config.'" requireQ />
									<div class="field-placeholder"> Exam ('.$exam_score_config.') <span class="text-danger">*</span></div>
								</div>
								<!-- field wrapper end -->
							</div>
						</div>
						<hr class="my-10 text-danger" />';
					
					}elseif($exam_status == $foVal){  /* check exam configuration status */

						list ($fi_score, $se_score, $th_score, $fo_score, $exam_score) = explode (",", $row[0][$ie]);
						
						$course_a = $course_codes_r[$i][0];
						$course_b = $course_codes_r[$i][0];
						$course_c = $course_codes_r[$i][0];
						$course_d = $course_codes_r[$i][0]; 
						$course_exam = $course_codes_r[$i][0];
				
						$course_a = $course_a."[$a]"; $course_b = $course_b."[$b]";   $course_c = $course_c."[$c]";   
						$course_d = $course_d."[$d]"; $course_exam = $course_exam."[$g]";
				
						$course_a = strtolower($course_a);      $course_b = strtolower($course_b);      $course_c = strtolower($course_c);
						$course_d = strtolower($course_d);      $course_exam = strtolower($course_exam); 
					
						echo ' 
						<!-- row -->
						<div class="row gutters">
							<div class="hints fw-600">
								[<i class="mdi mdi-alphabetical-variant"></i>]';
								echo substr($course_codes[$i][$b], 0, 20);
						echo '		
							</div>
						</div>
						<!-- /row -->'; 
						
						echo '
						<!-- row -->
						<div class="row gutters  justify-content-center">
							<div class="col-lg-2">										
								<!-- field wrapper start -->
								<div class="field-wrapper">										 
									<input type="number" class="form-control numbers" 
									name="'.$course_a.'" id="'.$course_a.'" value="'.$fi_score.'" data-min="0" data-max="'.$exam_fi.'" requireQ />
									<div class="field-placeholder"> Test ('.$exam_fi.') <span class="text-danger">*</span></div>
								</div>
								<!-- field wrapper end -->
							</div>';

						echo '							
							<div class="col-lg-2">										
								<!-- field wrapper start -->
								<div class="field-wrapper">										 
									<input type="number" class="form-control numbers" 
									name="'.$course_b.'" id="'.$course_b.'" value="'.$se_score.'" data-min="0" data-max="'.$exam_se.'" requireQ />
									<div class="field-placeholder"> Test ('.$exam_se.') <span class="text-danger">*</span></div>
								</div>
								<!-- field wrapper end -->
							</div>';
							
						echo '							
							<div class="col-lg-2">										
								<!-- field wrapper start -->
								<div class="field-wrapper">										 
									<input type="number" class="form-control numbers" 
									name="'.$course_c.'" id="'.$course_c.'" value="'.$th_score.'" data-min="0" data-max="'.$exam_th.'" requireQ />
									<div class="field-placeholder"> Test ('.$exam_th.') <span class="text-danger">*</span></div>
								</div>
								<!-- field wrapper end -->
							</div>';

						echo '							
							<div class="col-lg-2">										
								<!-- field wrapper start -->
								<div class="field-wrapper">										 
									<input type="number" class="form-control numbers" 
									name="'.$course_d.'" id="'.$course_d.'" value="'.$fo_score.'" data-min="0" data-max="'.$exam_fo.'" requireQ />
									<div class="field-placeholder"> Test ('.$exam_fo.') <span class="text-danger">*</span></div>
								</div>
								<!-- field wrapper end -->
							</div>'; 

						echo '							
							<div class="col-lg-3">										
								<!-- field wrapper start -->
								<div class="field-wrapper">										 
									<input type="number" class="form-control numbers" 
									name="'.$course_exam.'" id="'.$course_exam.'" value="'.$exam_score.'" data-min="0" data-max="'.$exam_score_config.'" requireQ />
									<div class="field-placeholder"> Exam ('.$exam_score_config.') <span class="text-danger">*</span></div>
								</div>
								<!-- field wrapper end -->
							</div>
						</div>
						<hr class="my-10 text-danger" />';

					
					}elseif($exam_status == $fifVal){  /* check exam configuration status */

						list ($fi_score, $se_score, $th_score, $fo_score, $fif_score, $exam_score) = explode (",", $row[0][$ie]);
						
						$course_a = $course_codes_r[$i][0];
						$course_b = $course_codes_r[$i][0];
						$course_c = $course_codes_r[$i][0];
						$course_d = $course_codes_r[$i][0];
						$course_e = $course_codes_r[$i][0]; 
						$course_exam = $course_codes_r[$i][0];
				
						$course_a = $course_a."[$a]"; $course_b = $course_b."[$b]";   $course_c = $course_c."[$c]";   
						$course_d = $course_d."[$d]"; $course_e = $course_e."[$e]";   $course_exam = $course_exam."[$g]";
				
						$course_a = strtolower($course_a);      $course_b = strtolower($course_b);      $course_c = strtolower($course_c);
						$course_d = strtolower($course_d);      $course_e = strtolower($course_e);      $course_exam = strtolower($course_exam);								

						echo ' 
						<!-- row -->
						<div class="row gutters">
							<div class="hints fw-600">
								[<i class="mdi mdi-alphabetical-variant"></i>]';
								echo substr($course_codes[$i][$b], 0, 20);
						echo '		
							</div>
						</div>
						<!-- /row -->'; 
						
						echo '
						<!-- row -->
						<div class="row gutters  justify-content-center">
							<div class="col-lg-2">										
								<!-- field wrapper start -->
								<div class="field-wrapper">										 
									<input type="number" class="form-control numbers" 
									name="'.$course_a.'" id="'.$course_a.'" value="'.$fi_score.'" data-min="0" data-max="'.$exam_fi.'" requireQ />
									<div class="field-placeholder"> Test ('.$exam_fi.') <span class="text-danger">*</span></div>
								</div>
								<!-- field wrapper end -->
							</div>';

						echo '							
							<div class="col-lg-2">										
								<!-- field wrapper start -->
								<div class="field-wrapper">										 
									<input type="number" class="form-control numbers" 
									name="'.$course_b.'" id="'.$course_b.'" value="'.$se_score.'" data-min="0" data-max="'.$exam_se.'" requireQ />
									<div class="field-placeholder"> Test ('.$exam_se.') <span class="text-danger">*</span></div>
								</div>
								<!-- field wrapper end -->
							</div>';
							
						echo '							
							<div class="col-lg-2">										
								<!-- field wrapper start -->
								<div class="field-wrapper">										 
									<input type="number" class="form-control numbers" 
									name="'.$course_c.'" id="'.$course_c.'" value="'.$th_score.'" data-min="0" data-max="'.$exam_th.'" requireQ />
									<div class="field-placeholder"> Test ('.$exam_th.') <span class="text-danger">*</span></div>
								</div>
								<!-- field wrapper end -->
							</div>';

						echo '							
							<div class="col-lg-2">										
								<!-- field wrapper start -->
								<div class="field-wrapper">										 
									<input type="number" class="form-control numbers" 
									name="'.$course_d.'" id="'.$course_d.'" value="'.$fo_score.'" data-min="0" data-max="'.$exam_fo.'" requireQ />
									<div class="field-placeholder"> Test ('.$exam_fo.') <span class="text-danger">*</span></div>
								</div>
								<!-- field wrapper end -->
							</div>';

						echo '							
							<div class="col-lg-2">										
								<!-- field wrapper start -->
								<div class="field-wrapper">										 
									<input type="number" class="form-control numbers" 
									name="'.$course_e.'" id="'.$course_e.'" value="'.$fif_score.'" data-min="0" data-max="'.$exam_fif.'" requireQ />
									<div class="field-placeholder"> Test ('.$exam_fif.') <span class="text-danger">*</span></div>
								</div>
								<!-- field wrapper end -->
							</div>'; 

						echo '							
							<div class="col-lg-3">										
								<!-- field wrapper start -->
								<div class="field-wrapper">										 
									<input type="number" class="form-control numbers" 
									name="'.$course_exam.'" id="'.$course_exam.'" value="'.$exam_score.'" data-min="0" data-max="'.$exam_score_config.'" requireQ />
									<div class="field-placeholder"> Exam ('.$exam_score_config.') <span class="text-danger">*</span></div>
								</div>
								<!-- field wrapper end -->
							</div>
						</div>
						<hr class="my-10 text-danger" />';  
						
					}elseif($exam_status == $sixVal){  /* check exam configuration status */

						list ($fi_score, $se_score, $th_score, $fo_score, $fif_score, $six_score, $exam_score) = explode (",", $row[0][$ie]);
						
						$course_a = $course_codes_r[$i][0];
						$course_b = $course_codes_r[$i][0];
						$course_c = $course_codes_r[$i][0];
						$course_d = $course_codes_r[$i][0];
						$course_e = $course_codes_r[$i][0];
						$course_f = $course_codes_r[$i][0];
						$course_exam = $course_codes_r[$i][0];
				
						$course_a = $course_a."[$a]"; $course_b = $course_b."[$b]";   $course_c = $course_c."[$c]";   
						$course_d = $course_d."[$d]"; $course_e = $course_e."[$e]";   $course_f = $course_c."[$f]";   					
						$course_exam = $course_exam."[$g]";
				
						$course_a = strtolower($course_a);      $course_b = strtolower($course_b);      $course_c = strtolower($course_c);
						$course_d = strtolower($course_d);      $course_e = strtolower($course_e);      $course_f = strtolower($course_f);
						$course_exam = strtolower($course_exam); 
					
						echo ' 
						<!-- row -->
						<div class="row gutters">
							<div class="hints fw-600">
								[<i class="mdi mdi-alphabetical-variant"></i>]';
								echo substr($course_codes[$i][$b], 0, 20);
						echo '		
							</div>
						</div>
						<!-- /row -->'; 
						
						echo '
						<!-- row -->
						<div class="row gutters  justify-content-center">
							<div class="col-lg-2">										
								<!-- field wrapper start -->
								<div class="field-wrapper">										 
									<input type="number" class="form-control numbers" 
									name="'.$course_a.'" id="'.$course_a.'" value="'.$fi_score.'" data-min="0" data-max="'.$exam_fi.'" requireQ />
									<div class="field-placeholder"> Test ('.$exam_fi.') <span class="text-danger">*</span></div>
								</div>
								<!-- field wrapper end -->
							</div>';

						echo '							
							<div class="col-lg-2">										
								<!-- field wrapper start -->
								<div class="field-wrapper">										 
									<input type="number" class="form-control numbers" 
									name="'.$course_b.'" id="'.$course_b.'" value="'.$se_score.'" data-min="0" data-max="'.$exam_se.'" requireQ />
									<div class="field-placeholder"> Test ('.$exam_se.') <span class="text-danger">*</span></div>
								</div>
								<!-- field wrapper end -->
							</div>';
							
						echo '							
							<div class="col-lg-2">										
								<!-- field wrapper start -->
								<div class="field-wrapper">										 
									<input type="number" class="form-control numbers" 
									name="'.$course_c.'" id="'.$course_c.'" value="'.$th_score.'" data-min="0" data-max="'.$exam_th.'" requireQ />
									<div class="field-placeholder"> Test ('.$exam_th.') <span class="text-danger">*</span></div>
								</div>
								<!-- field wrapper end -->
							</div>';

						echo '							
							<div class="col-lg-2">										
								<!-- field wrapper start -->
								<div class="field-wrapper">										 
									<input type="number" class="form-control numbers" 
									name="'.$course_d.'" id="'.$course_d.'" value="'.$fo_score.'" data-min="0" data-max="'.$exam_fo.'" requireQ />
									<div class="field-placeholder"> Test ('.$exam_fo.') <span class="text-danger">*</span></div>
								</div>
								<!-- field wrapper end -->
							</div>';

						echo '							
							<div class="col-lg-2">										
								<!-- field wrapper start -->
								<div class="field-wrapper">										 
									<input type="number" class="form-control numbers" 
									name="'.$course_e.'" id="'.$course_e.'" value="'.$fif_score.'" data-min="0" data-max="'.$exam_fif.'" requireQ />
									<div class="field-placeholder"> Test ('.$exam_fif.') <span class="text-danger">*</span></div>
								</div>
								<!-- field wrapper end -->
							</div>';

						echo '							
							<div class="col-lg-2">										
								<!-- field wrapper start -->
								<div class="field-wrapper">										 
									<input type="number" class="form-control numbers" 
									name="'.$course_f.'" id="'.$course_f.'" value="'.$six_score.'" data-min="0" data-max="'.$exam_six.'" requireQ />
									<div class="field-placeholder"> Test ('.$exam_six.') <span class="text-danger">*</span></div>
								</div>
								<!-- field wrapper end -->
							</div>';

						echo '							
							<div class="col-lg-3">										
								<!-- field wrapper start -->
								<div class="field-wrapper">										 
									<input type="number" class="form-control numbers" 
									name="'.$course_exam.'" id="'.$course_exam.'" value="'.$exam_score.'" data-min="0" data-max="'.$exam_score_config.'" requireQ />
									<div class="field-placeholder"> Exam ('.$exam_score_config.') <span class="text-danger">*</span></div>
								</div>
								<!-- field wrapper end -->
							</div>
						</div>
						<hr class="my-10 text-danger" />';

					}else{  /* display error */  
						
						$msg_e = "Ooops Error, please notify school admin to set school continous assessment before student results can be added.";									
						echo $erroMsg.$msg_e.$msgEnd; echo $scroll_up; 
						echo "<script type='text/javascript'> hidePageLoader(); </script>"; exit;	
					
					} 

				}
				
				$fi_score = ''; $se_score = ''; $th_score = ''; $fo_score = ''; $fif_score = ''; $six_score = ''; $exam_score = '';
				$ie++;

			}
 
			?>   
				

			<?php if($st_course_count >= $fiVal){ ?>	
			<!-- row -->
			<div class="row gutters modal-btn-footer">

				<?php if($exitStatus == $foreal){  ?>	
				<div class="col-6 text-start">
					<button type="button" id="close-modal" class="btn btn-danger close-modal" 
					data-bs-dismiss="modal"> <i class="mdi mdi-window-close label-icon"></i> Close</button>
				</div>
				
				<div class="col-6 text-end">
					<input type="hidden" name="validate" value="validateRS" />
					<button type="submit" class="btn btn-primary waves-effect   
					btn-label waves-light" id="saveRS">
						<i class="mdi mdi-content-save label-icon"></i>  Submit
					</button>
				</div>

				<?php }else{  ?>

				<div class="col-12 text-end">
					<input type="hidden" name="validate" value="validateRS" />
					<button type="submit" class="btn btn-primary waves-effect   
					btn-label waves-light" id="saveRS">
						<i class="mdi mdi-content-save label-icon"></i>  Submit
					</button>
				</div>

				<?php } ?>	
			</div>	
			<!-- /row -->	

			<?php 	}else{

						 $msg_i = "* Ooops, no course subject was assigned to you. 
						Meanwhile, inform the school admin to assign one to you.";
						echo $infMsg.$msg_i.$msgEnd;

				 	} 
			?>

			<div class="row gutters my-25 justify-content-center">
				<div class="hints col-lg-12">
					[<i class="mdi mdi-help-circle-outline"></i>] 
					Every submitted result will be verify and approved by either
					<span class="text-danger fw-600">Class Manager or School Admin. </span> <br /><br />
						Once Approved, course staff/teacher can no longer edit the student result. 
						<span class="text-danger fw-600">Class Manager or School Admin. </span> can still 
						work on the result before publishing result.
				</div>
			</div>

		</form>
		


		<script type="text/javascript">			
			/*
			 $('.numbers2').keypress(function (e) {
				if (String.fromCharCode(e.keyCode).match(/[^0-9]/g)) return false;
			});
			https://meet.google.com/sjd-nktq-ryr
			$('.numbers2').keyup(function () {
				this.value = this.value.replace(/[^0-9\.]/g,'');
			});
			*/

			$('.numbers').bind("cut copy paste", function (e) {
				e.preventDefault();
			});

			$('.numbers').keyup(function (event) {
				var min = $(this).attr('data-min');
				var max = $(this).attr('data-max');
				var val = parseInt($(this).val(), 10);

				//alert('up val::::' + val);
				//console.log('up val::::' + val);

				if (val < min) {
						$(this).val(min);
						//return false;
					}

					if (val > max) {
						$(this).val(max);
						//return false;
					}

				//console.log('::::::::::::::::::::::::::::::::');
				//return true;
			});

			$('.numbers').keypress(function (event) {
				var min = $(this).attr('data-min');
				var max = $(this).attr('data-max');
				var val = parseInt($(this).val(), 10);

				//alert('press val::::' + val);
				//console.log('press val::::' + val);

				var charCode = (event.which) ? event.which : event.keyCode
				if (charCode > 31 && (charCode < 48 || charCode > 57))
					return false;

				//var final = val + String.fromCharCode(charCode);
				//if (final < min || final > max)
				// return false;

				return true;

			});

			$('.numbers').keydown(function (event) {
				var min = $(this).attr('data-min');
				var max = $(this).attr('data-max');
				var val = parseInt($(this).val(), 10);

				//alert('down val::::' + val);
				//console.log('down val::::' + val);

				if (!isNaN(val)) {
					if (event.keyCode == 37) {
						//alert('37');
					}
					else if (event.keyCode == 38) {
						//Up
						if (val > max-1)
							return false;
					}
					else if (event.keyCode == 39) {
						//alert('39');
					}
					else if (event.keyCode == 40) {
						//Down
						if (val - 1 < min)
							return false;
					}
				}
				return true;

			});

			hidePageLoader();						
		</script>      				

<?php

	}else{ 

	echo $userNavPageError; exit;  /* else exit or redirect to 404 page */ 

	}   
exit;		
?>	