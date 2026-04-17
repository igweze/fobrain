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
	This script handle student comment result edit
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

     	define('fobrain', 'igweze');  /* define a check for wrong access of file */

		require 'fobrain-config.php';  /* load fobrain configuration files */	   
				
		if ($_REQUEST['rsData'] != '') {

			list ($regNum, $session, $level, $class, $term, $exitStatus) = explode ("@@", $_REQUEST['rsData']);  
			
			require_once $fobrainClassConfigDir;   /* include class configuration script */  
		
			try { 
			
				$examArray = schoolExamConfigArrays($conn);  /* school exam configuration array  */
				$exam_status = $examArray[0]['status'];	
				$exam_fi = $examArray[0]['fi_ass'];	
				$exam_se = $examArray[0]['se_ass'];	
				$exam_th = $examArray[0]['th_ass'];	
				$exam_score = $examArray[0]['exam'];	

				$sessionID = studentRegSessionID($conn, $regNum);  /* student school session ID */ 
				
				/* select result */ 	
				
				$ebele_mark = "SELECT  s.$query_i_strings_com
				
								FROM $i_reg_tb r INNER JOIN $sdoracle_comment_nk s
								
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
					
					$msg_e .=  "Student record with <span>$regNum
						</span> was not found.";
					echo $errorMsg.$msg_e.$eEnd;  exit;			
					
				}	 
		
				$a = 1; $b = 2; $c = 3; $e = 4; $f = 5;

			
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
		<form class="form-horizontal" id="frmsaveSubComment" role="form">

			<input type="hidden" name="nj_level" value="<?php echo $level ?>">
			<input type="hidden" name="nj_term" value="<?php echo $term ?>" />
			<input type="hidden" name="nj_class" value="<?php echo $class ?>" /> 
			<input type="hidden" name="hidefrm" value="hidefrmDiv" />
			<input type="hidden" name="regnum" value = "<?php echo $regNum; ?>"/>
			<?php if($scrollType == $foVal){ echo '<input type="hidden" name="scrollType" bvalue="overlayScroll" />'; }?>   
			
			
			<!-- row -->
			<div class="row gutters fs-16  my-25">
				<div class="hints text-center">
					[<i class="mdi mdi-alphabetical-variant"></i>] 
					Reg. No. : <span class="fw-600 "><?php echo $regNum; ?></span>
					<input type="hidden" class="form-control fobrain-rs" placeholder="2007001/SEC" 
					name="regnumD" id="regnumD" value = "<?php echo $regNum; ?>"  required /> 
				</div>
			</div>
			<!-- /row -->

			<hr class="my-10 text-danger" />


			<?php 

				$course_codes = $course_info_mark;
				$course_codes_r = $course_info_mark;
		
				$ii = 0;    $iii = 0; $ie = 0;
				$show_course = false;
				$st_course_count = 0;

				for ($i = $start_nkiru ; $i <= $stop_njideka; $i++) {  /* loop array */
								
					$subComment = htmlspecialchars_decode(($row[0][$ie]));								
					$course_a = $course_codes_r[$i][$f];
					$course_a = strtolower($course_a); 

					$staff_course = unserialize($course_codes[$i][9]);	  
	
					if(is_array($staff_course)){  /* check if array */  

						$staff_course = array_unique($staff_course);

						if (in_array($_SESSION['adminID'], $staff_course)) {  /* check staff */ 
						 
							$show_course = true;
						 
						}

					}else{ $show_course = false; }	

					if($show_course == true){ 

						$st_course_count++;
						
						echo '
						<div class="col-lg-12">										
							<!-- field wrapper start -->
							<div class="field-wrapper">										 
								<textarea rows="2"  class="form-control" name="'.$course_a.'" id="'.$course_a.'"
								placeholder="Enter '.$course_codes[$i][$b].' Teachers  Comment . . . . ">'.$subComment.'</textarea> 
								<div class="field-placeholder"> '.substr($course_codes[$i][$b], 0, 20).' <span class="text-danger">*</span></div>
							</div>
							<!-- field wrapper end -->
						</div>
						<hr class="my-10 text-danger" />'; 
					}									
					
					$subComment = '';
					$ie++;

				}
				

			?>  		 


			<?php if($st_course_count >= $fiVal){ ?>	
			<!-- row -->
			<div class="row gutters modal-btn-footer">

				<?php if($exitStatus == $foreal){ ?>	
				<div class="col-6 text-start">
					<button type="button" id="close-modal" class="btn btn-danger close-modal" 
					data-bs-dismiss="modal"> <i class="mdi mdi-window-close label-icon"></i> Close</button>
				</div>
				
				<div class="col-6 text-end">
					<input type="hidden" name="validate" value="validateCom" />
					<button type="submit" class="btn btn-primary waves-effect   
					btn-label waves-light" id="saveSubComment">
						<i class="mdi mdi-content-save label-icon"></i>  Save
					</button>
				</div>

				<?php }else{  ?>

				<div class="col-12 text-end">
					<input type="hidden" name="validate" value="validateCom" />
					<button type="submit" class="btn btn-primary waves-effect   
					btn-label waves-light" id="saveSubComment">
						<i class="mdi mdi-content-save label-icon"></i>  Save
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

		</form>
		<!-- / form --> 


			
<?php
			echo "<script type='text/javascript'> hidePageLoader();	</script>";	exit;
			
		}else{
	
				echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
				
		}
	
	

		if ($msg) {

			echo $errorMsg.$msg.$eEnd; echo $scroll_up; exit; 	 

		}
	
exit;
?>	