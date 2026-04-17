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
	This script load student conducts field
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

		define('fobrain', 'igweze');  /* define a check for wrong access of file */

		require 'fobrain-config.php';  /* load fobrain configuration files */	   
		
		if ((isset($_REQUEST['student_conduct'])))  {
			
			$student_data = $_REQUEST['student_conduct'];
			
			list ($regNum, $level, $term, $class, $exitStatus) = explode ("@@", $student_data);
			
			require  $fobrainClassConfigDir;   /* include class configuration script */
					
			try {
				
				$gsRemarkArray =	teacherRemarksArrays($conn);  /* teacher remarks array */ 
				//$clubArray = studentsClubArrays($conn);  /* school clubs array */
				//$clubPostArray = clubPostArrays($conn);  /* school clubs position array */
				$sportArray = sportsArrays($conn);  /* school sports array */  
				$sessionID = studentRegSessionID($conn, $regNum);  /* student school session ID */
				$session_fi = fobrainSession($conn, $sessionID);  /* student school session */					
			
				$session_se = $session_fi + $foreal;  

				$ebele_mark = "SELECT r.ireg_id, nk_regno, s.$conducts_field

						FROM $i_reg_tb r, $sdoracle_student_remark_nk s

						WHERE r.nk_regno = :nk_regno
						
						AND r.ireg_id = s.ireg_id";
						
				$igweze_prep = $conn->prepare($ebele_mark);
				
				$igweze_prep->bindValue(':nk_regno', $regNum);
					
				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count == $foreal) {  /* check array is empty */
				
					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {  /* loop array */
			
						$regNum = $row['nk_regno'];
						$ID = $row['ireg_id'];
						$attendance = $row[$attendance_r];
						$conducts = $row[$conducts_r];
						$i_sport = $row[$sports_r];
						$organization = $row[$organization_r];
						$comment = $row[$comment_r];
						$teacherComment = $row[$comment_t];
						$pr_comment = $row[$pr_comment_r];
					
					}	
				
					list ($notSchOpen, $notPresent, $notPunc) = explode (",", $attendance);
					
					list ( $i_neatness, $i_politeness, $i_honesty, $i_leadership, $i_attentiveness, $i_emotionalstab,
							$i_health, $i_attitudesch, $i_speaking, $i_handwriting) = explode (",", $conducts);
												
					list ($sport_1, $sport_2, $sport_3, $sport_4, $sport_5)  = explode (",", $i_sport);   
							
				}else{  /* display error */ 
		
					$msg_e .=  "Student record with <span>$regNum </span> was not found.";
					echo $errorMsg.$msg_e.$eEnd;  exit;						  
				}
				
			}catch(PDOException $e) {
				
				fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
					
			}
		
?>
  
			
		<!-- form -->
		<form class="form-horizontal frmConducts"> 
			<div class="row gutters mb-10 mt-10">
				<div class="hints">
					[<i class="mdi mdi-help-circle-outline"></i>] 
					Below are number of times
				</div>
			</div>
			<!-- row -->
			<div class="row gutters">
				<div class="col-lg-4">										
					<!-- field wrapper start -->
					<div class="field-wrapper">										 
						<input type="number"  id="noschopen" name="noschopen"   value = "<?php echo $notSchOpen ?>" 
						class="form-control" placeholder="300" required>
						<div class="field-placeholder">  School Open <span class="text-danger">*</span></div>
					</div>
					<!-- field wrapper end -->
				</div>
				<div class="col-lg-4">										
					<!-- field wrapper start -->
					<div class="field-wrapper">										 
						<input type="number" id="nopre" name="nopre"  value = "<?php echo $notPresent ?>" 
						class="form-control" placeholder="270" required>
						<div class="field-placeholder">   Present <span class="text-danger">*</span></div>
					</div>
					<!-- field wrapper end -->
				</div>
				<div class="col-lg-4">										
					<!-- field wrapper start -->
					<div class="field-wrapper">										 
						<input type="number" id="nopunt" name="nopunt"  value = "<?php echo $notPunc ?>" 
							class="form-control" placeholder="250" required>
						<div class="field-placeholder">   Punctual <span class="text-danger">*</span></div>
					</div>
					<!-- field wrapper end -->
				</div>																 
			</div>	
			<!-- /row -->	 

			<div class="row gutters my-10">
				<div class="hints">
					[<i class="mdi mdi-help-circle-outline"></i>] 
					<?php echo $sdo_tb_se_grade; ?>
				</div>
			</div>

			<!-- row -->
			<div class="row gutters">
				<div class="col-lg-3">										
					<!-- field wrapper start -->
					<div class="field-wrapper">										 
						<select id="neatness" name="neatness" class="form-control conducts"  required>

							<option value = "">Please select One</option>

							<?php

								foreach($conduct_list as $neatness){  /* loop array */

									if ($i_neatness == $neatness){
										$selected = "SELECTED";
									} else {
										$selected = "";
									}

									echo '<option value="'.$neatness.'"'.$selected.'>'.$neatness.'</option>' ."\r\n";

								}

							?>

						</select>
						<div class="field-placeholder">  Neatness:  <span class="text-danger">*</span></div>
					</div>
					<!-- field wrapper end -->
				</div>
				<div class="col-lg-3">										
					<!-- field wrapper start -->
					<div class="field-wrapper">										 
						<select  id="politeness" name="politeness"  class="form-control conducts"  required>

							<option value = "">Please select One</option>

							<?php

								foreach($conduct_list as $politeness){  /* loop array */

									if ($i_politeness == $politeness){
										$selected = "SELECTED";
									} else {
										$selected = "";
									}

									echo '<option value="'.$politeness.'"'.$selected.'>'.$politeness.'</option>' ."\r\n";

								}

							?> 
						</select>										 
						<div class="field-placeholder"> Politeness:  <span class="text-danger">*</span></div>
					</div>
					<!-- field wrapper end -->
				</div>
				<div class="col-lg-3">										
					<!-- field wrapper start -->
					<div class="field-wrapper">										 
						<select id="honesty" name="honesty"  class="form-control conducts"  required>

							<option value = "">Please select One</option>
							<?php

								foreach($conduct_list as $honesty){  /* loop array */

									if ($i_honesty == $honesty){
										$selected = "SELECTED";
									} else {
										$selected = "";
									}

									echo '<option value="'.$honesty.'"'.$selected.'>'.$honesty.'</option>' ."\r\n";

								}

							?>

						</select>
						<div class="field-placeholder">  Honesty <span class="text-danger">*</span></div>
					</div>
					<!-- field wrapper end -->
				</div>
				<div class="col-lg-3">										
					<!-- field wrapper start -->
					<div class="field-wrapper">										 
						<select id="leadership" name="leadership" class="form-control conducts"  required>

							<option value = "">Please select One</option>

							<?php

								foreach($conduct_list as $leadership){  /* loop array */

									if ($i_leadership == $leadership){
										$selected = "SELECTED";
									} else {
										$selected = "";
									}

									echo '<option value="'.$leadership.'"'.$selected.'>'.$leadership.'</option>' ."\r\n";

								}

							?>


						</select>
						<div class="field-placeholder">  Leadership <span class="text-danger">*</span></div>
					</div>
					<!-- field wrapper end -->
				</div>	
				<div class="col-lg-3">										
					<!-- field wrapper start -->
					<div class="field-wrapper">										 
						<select id="attentiveness" name="attentiveness" class="form-control conducts"  required>

							<option value = "">Please select One</option>
							<?php

								foreach($conduct_list as $attentiveness){  /* loop array */

									if ($i_attentiveness == $attentiveness){
										$selected = "SELECTED";
									} else {
										$selected = "";
									}

									echo '<option value="'.$attentiveness.'"'.$selected.'>'.$attentiveness.'</option>' ."\r\n";

								}

							?>


						</select>
						<div class="field-placeholder"> Attentiveness  <span class="text-danger">*</span></div>
					</div>
					<!-- field wrapper end -->
				</div>
				
				<div class="col-lg-3">										
					<!-- field wrapper start -->
					<div class="field-wrapper">										 
						<select id="health" name="health" class="form-control conducts"  required>

							<option value = "">Please select One</option>

							<?php

								foreach($conduct_list as $health){  /* loop array */

									if ($i_health == $health){
										$selected = "SELECTED";
									} else {
										$selected = "";
									}

									echo '<option value="'.$health.'"'.$selected.'>'.$health.'</option>' ."\r\n";

								}

							?>

						</select>										 
						<div class="field-placeholder"> Health  <span class="text-danger">*</span></div>
					</div>
					<!-- field wrapper end -->
				</div>  

				<div class="col-lg-3">										
					<!-- field wrapper start -->
					<div class="field-wrapper">										 
						<select id="speaking" name="speaking" class="form-control conducts"  required>

							<option value = "">Please select One</option>
							<?php

								foreach($conduct_list as $speaking){  /* loop array */

									if ($i_speaking == $speaking){
									$selected = "SELECTED";
									} else {
									$selected = "";
									}

									echo '<option value="'.$speaking.'"'.$selected.'>'.$speaking.'</option>' ."\r\n";

								}

							?> 

						</select>									 
						<div class="field-placeholder">  Speaking  <span class="text-danger">*</span></div>
					</div>
					<!-- field wrapper end -->
				</div>

				<div class="col-lg-3">										
					<!-- field wrapper start -->
					<div class="field-wrapper">										 
						<select id="handwriting" name="handwriting" class="form-control conducts"  required>

							<option value = "">Please select One</option>

							<?php

								foreach($conduct_list as $handwriting){  /* loop array */

									if ($i_handwriting == $handwriting){
										$selected = "SELECTED";
									} else {
										$selected = "";
									}

									echo '<option value="'.$handwriting.'"'.$selected.'>'.$handwriting.'</option>' ."\r\n";

								}

							?>

						</select> 									 
						<div class="field-placeholder">  Handwriting  <span class="text-danger">*</span></div>
					</div>
					<!-- field wrapper end -->
				</div>

				<div class="col-lg-4">										
					<!-- field wrapper start -->
					<div class="field-wrapper">										 
						<select id="emotionalstab" name="emotionalstab" class="form-control conducts"  required>

							<option value = "">Please select One</option>

							<?php

								foreach($conduct_list as $emotionalstab){  /* loop array */

									if ($i_emotionalstab == $emotionalstab){
										$selected = "SELECTED";
									} else {
										$selected = "";
									}

									echo '<option value="'.$emotionalstab.'"'.$selected.'>'.$emotionalstab.'</option>' ."\r\n";

								}

							?>

						</select>
						<div class="field-placeholder"> Emotional Stability  <span class="text-danger">*</span></div>
					</div>
					<!-- field wrapper end -->
				</div>


				<div class="col-lg-4">										
					<!-- field wrapper start -->
					<div class="field-wrapper">										 
						<select id="attitudesch" name="attitudesch" class="form-control conducts"  required>

							<option value = "">Please select One</option>
							<?php

								foreach($conduct_list as $attitudesch){  /* loop array */

									if ($i_attitudesch == $attitudesch){
										$selected = "SELECTED";
									} else {
										$selected = "";
									}

									echo '<option value="'.$attitudesch.'"'.$selected.'>'.$attitudesch.'</option>' ."\r\n";

								}

							?> 

						</select> 									 
						<div class="field-placeholder">  Attitude to School Work  <span class="text-danger">*</span></div>
					</div>
					<!-- field wrapper end -->
				</div>		
			</div>	
			<!-- /row --> 				
					
			<!-- row -->
			<div class="row gutters">
				<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">										
					<!-- field wrapper start -->
					<div class="field-wrapper">
						<select class="form-control"  name="sports[]" id="sport" multiple placeholder="Select a sport..." autocomplete="off"> 
							<option value = "">Please select One</option>						
							
							<?php   

								if(is_array($sportArray)){

									$staffCount = count($sportArray); 	 
												
									for($i = 1; $i <= $staffCount; $i++){  /* loop array */
										
										$sport_id = $sportArray[$i]["id"];
										$sport_val = $sportArray[$i]["name"]; 

										if(isset($i_sport)){  /* check  is empty */

											if($sport_1 == $sport_id ){

												$selected = "SELECTED";

											}elseif($sport_2 == $sport_id ){

												$selected = "SELECTED";

											}elseif($sport_3 == $sport_id ){

												$selected = "SELECTED";

											}elseif($sport_4 == $sport_id ){

												$selected = "SELECTED";

											}elseif($sport_5 == $sport_id ){

												$selected = "SELECTED";

											}else{

												$selected = "";

											}

										}

										$options .= '<option value="'.$sport_id.'"'.$selected.'>'.$sport_val.'</option>' ."\r\n"; 
											
									}  

								}else{

									$options = '<option value="">No Sport Records was  found</option>' ."\r\n";

								} 

								echo $options;
							?> 
							
						</select>   
						<div class="field-placeholder"> Student's Sports <span class="text-danger">*</span></div>
					</div>
					<!-- field wrapper end -->
				</div>									 
			</div>	
			<!-- /row -->	  
		 
			<script type='text/javascript'>  
				renderInput("#sport", 5); 
				$('.conducts').each(function() {  
					renderSelect($('#'+this.id)); 
				}); 
			</script>


			<!-- row -->
			<div class="row gutters">
				<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">									
					<!-- field wrapper start -->
					<div class="field-wrapper">
						<input type="text" id="teacherCom" name="teacherCom" maxlength="100"  
							value = "<?php echo $teacherComment; ?>"  class="form-control" placeholder="">
						<div class="field-placeholder"> Form Teacher's Comment <span class="text-danger">*</span></div>
					</div>
					<!-- field wrapper end -->
				</div>									 
			 
				<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">										
					<!-- field wrapper start -->
					<div class="field-wrapper">
						<input type="text" id="pr_comment" name="pr_comment" maxlength="100" 
							value = "<?php echo $pr_comment; ?>"   class="form-control" placeholder="">
						<div class="field-placeholder"> School Head Comment (Optional)  <span class="text-danger"></span></div>
						<div class="form-text text-danger">
							School Head comment is auto generated, if not entered.
						</div>
					</div>
					<!-- field wrapper end -->
				</div>									 
			</div>	
			<!-- /row -->
			
			
 		
							


					<!--
					<div class="form-group">
						<label for="teachers_remark" class="col-lg-5 control-label">
						Guidance & Counsellor's Remarks </label>
						<div class="col-lg-7">
						<div class="iconic-input">
							<i class="fa fa-comment"></i>
							<input type="text"  id="teachers_remark" name="remarks" class="form-control" >
							
							
						</div>
						</div>
					</div>	
					
					--> 
			 

			<hr class="mt-30 mb-15 text-danger" />
			<!-- row -->
			<div class="row gutters modal-btn-footer">
				 
				<?php if($exitStatus == $foreal){ ?>	
				<div class="col-6 text-start">
					<button type="button" id="close-modal" class="btn btn-danger close-modal" 
					data-bs-dismiss="modal"> <i class="mdi mdi-window-close label-icon"></i> Close</button>
				</div>
				
				<div class="col-6 text-end">
					<input type="hidden" name="studentData" value="studentConducts" />
					<input type='hidden' value = "<?php echo $student_data; ?>" name="conducts" />	
					<button type="submit" class="btn btn-primary waves-effect   
					btn-label waves-light" id="saveConducts">
						<i class="mdi mdi-content-save label-icon"></i>  Save
					</button>
				</div>

				<?php }else{  ?>

				<div class="col-12 text-end">
					<input type="hidden" name="studentData" value="studentConducts" />
					<input type='hidden' value = "<?php echo $student_data; ?>" name="conducts" />	
					<button type="submit" class="btn btn-primary waves-effect   
					btn-label waves-light" id="saveConducts">
						<i class="mdi mdi-content-save label-icon"></i>  Save
					</button>
				</div>

				<?php } ?>
			</div>	
			<!-- /row -->	

		</form>
		<!-- / form -->

		<script type='text/javascript'> hidePageLoader();	</script> 
<?php  
				
		
		}else{				
		
			echo $userNavPageError; exit;  /* else exit or redirect to 404 page */				
		
		}
exit;				
?>                