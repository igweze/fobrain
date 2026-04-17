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
	This script handle staff leaves
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}


		if (!defined('fobrain'))

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');	   
			
		if ($_REQUEST['leave_st'] == 'save') {  /* save staff leave */	   

			$l_type =  cleanInt($_REQUEST['l_type']);
			$l_apply = $_REQUEST['l_apply']; 
			$l_days =  cleanInt($_REQUEST['l_days']);
			$l_date = date("Y-m-d H:i:s");				
			
			/* script validation */
			
			if ($l_type == "")  {
				
				$msg_e = "* Ooops Error, select leave type";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader();  </script>";exit;
				
			}elseif ($l_apply == "")  {
				
				$msg_e = "* Ooops Error, select your leave day";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader();  </script>";exit;
				
			}else {  /* insert information */       			

				try {  
					
					$ebele_mark = "INSERT INTO $staffLeaveTB  (staff, l_type, l_apply, l_days, l_date)

							VALUES (:staff, :l_type, :l_apply, :l_days, :l_date)";
					
					$igweze_prep = $conn->prepare($ebele_mark); 
					$igweze_prep->bindValue(':staff', $_SESSION['adminID']); 
					$igweze_prep->bindValue(':l_type', $l_type); 
					$igweze_prep->bindValue(':l_apply', $l_apply);
					$igweze_prep->bindValue(':l_days', $l_days);
					$igweze_prep->bindValue(':l_date', $l_date); 
					
					if($igweze_prep->execute()){  /* if sucessfully */
						
						$msg_s = "Staff Leave was successfully saved"; 
						echo $succesMsg.$msg_s.$sEnd; 
						echo "<script type='text/javascript'> 
							$('#load-wiz-info').load('leave-info-staff.php'); 
							$('#frmsaveStaffLeave')[0].reset();
							$('#modal-fobrain').modal('hide');
							hidePageLoader();   
						</script>";exit;
						
					}else{  /* display error */ 
			
						$msg_e =  "Ooops, an error has occur while to save staff leave. Please try again";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'> hidePageLoader();  </script>";exit;
						
					}
					

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				} 
		
			}
		
		}elseif ($_REQUEST['leave_st'] == 'update') {  /* upgrade staff leave */

			$l_id = cleanInt($_REQUEST['l_id']);	 
			$l_type =  cleanInt($_REQUEST['l_type']);
			$l_apply = $_REQUEST['l_apply']; 
			$l_days =  cleanInt($_REQUEST['l_days']);  
			
			/* script validation */ 
			
			if ($l_id == ""){
				
				$msg_e = "* Ooops, aan error has occur to retrieve staff leave information. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}if ($l_type == "")  {
				
				$msg_e = "* Ooops Error, select leave type";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader();  </script>";exit;
				
			}elseif ($l_apply == "")  {
				
				$msg_e = "* Ooops Error, select your leave day";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader();  </script>";exit;
				
			}else {  /* upgrade information */       			
			
				
				try {  
					
					$ebele_mark = "UPDATE $staffLeaveTB  
										
										SET  
											
										l_type = :l_type, 		
										l_apply = :l_apply,
										l_days = :l_days
										
									WHERE l_id = :l_id";
					
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':l_id', $l_id); 
					$igweze_prep->bindValue(':l_type', $l_type); 
					$igweze_prep->bindValue(':l_apply', $l_apply);
					$igweze_prep->bindValue(':l_days', $l_days);
					
					if($igweze_prep->execute()){  /* if sucessfully */
						
						$msg_s = "Staff Leave was successfully saved."; 
						echo $succesMsg.$msg_s.$sEnd; 
						echo "<script type='text/javascript'> 
							$('#load-wiz-info').load('leave-info-staff.php'); 
							hidePageLoader();  
							$('#modal-fobrain').modal('hide');
						</script>";exit;
						
					}else{  /* display error */ 
			
						$msg_e =  "Ooops, an error has occur while to save staff leave. Please try again";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
						
					} 

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				} 
		
			}
		
		}elseif ($_REQUEST['leave_st'] == 'remove') {  /* remove staff leave */ 
			
			$leave_st = $_REQUEST['rData'];
			
			list($fobrainIg, $l_id, $hName) = explode("-", $leave_st);			
			
			/* script validation */
			
			if (($leave_st == "")  || ($l_id == "")){
				
				$msg_e = "* Ooops, an error has occur while to remove staff leave. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
				
			}else {  /* remove information */       			


				try {
					
					
					$ebele_mark = "DELETE FROM 
					
									$staffLeaveTB										
										
									WHERE l_id = :l_id
										
									LIMIT 1";
					
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':l_id', $l_id);  
					
					if($igweze_prep->execute()){  /* if sucessfully */
						
						$removeDiv = "$('#staff-row-".$l_id."').fadeOut(1000);";
						$msg_s = "<strong>Staff Leave</strong> was successfully removed"; 
						echo $succesMsg.$msg_s.$sEnd; 
						echo "<script type='text/javascript'>   
						hidePageLoader(); $('.slideUpFrmDiv').fadeOut(3000); $removeDiv  </script>";exit;
						
					}else{  /* display error */ 
			
						$msg_e =  "Ooops, an error has occur while to remove staff leave. Please try again";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
						
					}
					

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				} 
		
			}
		
		}elseif ($_REQUEST['leave_st'] == 'view') {  /* view staff leave */
			
			$l_id = $_REQUEST['rData'];
			
			if ($l_id == ""){
				
				$msg_e = "* Ooops, an error has occur while to retrieve staff leave. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}else {   

				try {						

					$leaveInfoArr = staffLeaveInfo($conn, $l_id);  /* staff leave information */ 
					$l_type = $leaveInfoArr[$fiVal]["l_type"];
					$l_apply = $leaveInfoArr[$fiVal]["l_apply"]; 
					$l_date = $leaveInfoArr[$fiVal]["l_date"]; 
								

$showGrade =<<<IGWEZE
	
						
					<div id = 'fobrain-print'>

					<!-- table -->
					<table class="table view-table"> 

						<tr><th> Grade Score From </td> <td> $l_type </td> </tr> 

						<tr><th> Grade Score To </td> <td> $l_apply</td> </tr> 

						<tr><th> Score Grade</td> <td> $l_date</td> </tr> 

					</table>
					<!-- / table --> 

					</div>
	
IGWEZE;
			
					echo $showGrade; 
					
					echo "<script type='text/javascript'>  hidePageLoader(); </script>"; exit;
					
					

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				}
		
		
			}
		
		}elseif ($_REQUEST['leave_st'] == 'edit') {  /* edit staff leave */ 
			
			$l_id = strip_tags($_REQUEST['rData']); 
			
			if ($l_id == ""){
				
				$msg_e = "* Ooops, an error has occur while to retrieve staff leave. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}else {       

				try { 
						
					$leaveInfoArr = staffLeaveInfo($conn, $l_id);  /* staff leave information */ 
					$l_type = $leaveInfoArr[$fiVal]["l_type"];
					$l_apply = $leaveInfoArr[$fiVal]["l_apply"]; 
					$l_days = $leaveInfoArr[$fiVal]["l_days"]; 
					$l_date = $leaveInfoArr[$fiVal]["l_date"];
					$status = $leaveInfoArr[$fiVal]["status"];
					
					$leaveArrays = leaveArrays($conn);

?>
					<!-- form -->
					<form class="form-horizontal" id="frmupdateStaffLeave" role="form">   
						<!-- row -->
						<div class="row gutters">
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">										
								<!-- field wrapper start -->
								<div class="field-wrapper">										 
									<select class="form-control wiz-select" name="l_type"  id="l_type" placeholder="Select Leave" required > 
										<option value = "">Select One</option> 
										<?php

											try{

												$leaveArrays = leaveArrays($conn);
												$leaveCount = count($leaveArrays);  

											}catch(PDOException $e) {

												fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
							
											}
											if($leaveCount >= $fiVal){  /* check array is empty */	 

												for($i = $fiVal; $i <= $leaveCount; $i++){  /* loop array */		
												
													$lid = $leaveArrays[$i]["lid"];
													$leave_c = $leaveArrays[$i]["leave_c"]; 
													$status = $leaveArrays[$i]["status"];
													if($status == 1){ 

														if ($l_type == $lid){
															$selected = "SELECTED";
														} else {
															$selected = "";
														}
														
														echo '<option value="'.$lid.'"'.$selected.'> '.$leave_c.'</option>' ."\r\n";
													}
		
												}
												
											}else{
												
												echo '<option value="">Ooops, no  staff leave category was found.</option>' ."\r\n"; 
												
											} 

										?>
									</select>	
								</div>
								<!-- field wrapper end -->
							</div>	
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">										
								<!-- field wrapper start -->
								<div class="field-wrapper">										 
									<input type="text" class="form-control" placeholder="Enter Leave Days" 
									name="l_apply"  id="l_apply" value="<?php echo $l_apply; ?>" required-r>
									<div class="field-placeholder"> Leave Days  <span class="text-danger">*</span></div>
								</div>
								<!-- field wrapper end -->
							</div> 												 
						</div>	
						<!-- /row -->

						<!-- row -->
						<div class="row gutters">
							<div class="col-12">										
								<!-- field wrapper start -->
								<div class="field-wrapper">
									<input type="text" class="form-control l_days" placeholder="Leave Days" 
									name="l_daysD"  id="l_daysD" value="<?php echo $l_days; ?>" disabled>
									<input type="hidden" class="form-control l_days" placeholder="Leave Days" 
									name="l_days"  id="l_days" value="<?php echo $l_days; ?>">
									<div class="field-placeholder"> Duration (Days) <span class="text-danger">*</span></div> 
								</div>
								<!-- field wrapper end -->
							</div>									 
						</div>	
						<!-- /row -->

						<hr class="mt-30 mb-15 text-danger" />
						<!-- row -->
						<div class="row gutters modal-btn-footer">
							<div class="col-6 text-start">
								<button type="button" id="close-modal" class="btn btn-danger close-modal" 
								data-bs-dismiss="modal"> <i class="mdi mdi-window-close label-icon"></i> Close</button>
							</div>
							<div class="col-6 text-end">
								<input type="hidden" name="leave_st" value="update" />
								<input type="hidden" name="l_id" value="<?php echo $l_id; ?>" />	
								<button type="submit" class="btn btn-primary waves-effect   
								btn-label waves-light" id="updateStaffLeave">
									<i class="mdi mdi-content-save label-icon"></i>  Save
								</button>
							</div>
						</div>	
						<!-- /row -->	 
															
					</form>	
					<script type='text/javascript'>
						
						$(function() {
							$('input[name="l_apply"]').daterangepicker({
								
								"autoApply": true,
								locale: {
									format: 'YYYY-MM-DD'
								},
								showDropdowns: true,

							}, function(start, end, label) { 
								var diff = end.diff(start, 'days');  
								$(".l_days").val(diff);
							});
						});

						$('.wiz-select').each(function() {  
							renderSelect($('#'+this.id)); 
						}); 

						hidePageLoader();

					</script>	
					
<?php						
							
					exit; 

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				} 
		
			}
		
		}elseif ($_REQUEST['leave_st'] == 'load') {  /* LOAD staff leave */  
			


?>
			<form class="form-horizontal" id="frmsaveStaffLeave" role="form"> 
				
				<!-- row -->
				<div class="row gutters">
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">										
						<!-- field wrapper start -->
						<div class="field-wrapper">	
							<select class="form-control wiz-select" name="l_type"  id="l_type" placeholder="Select Leave" required > 
								<option value = "">Select One</option> 
								<?php

									try{

										$leaveArrays = leaveArrays($conn);
										$leaveCount = count($leaveArrays);  

									}catch(PDOException $e) {

										fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
					
									}
									if($leaveCount >= $fiVal){  /* check array is empty */	 

										for($i = $fiVal; $i <= $leaveCount; $i++){  /* loop array */		
										
											$lid = $leaveArrays[$i]["lid"];
											$leave_c = $leaveArrays[$i]["leave_c"]; 
											$status = $leaveArrays[$i]["status"];

											if($status == 1){ 

												if ($l_type == $lid){
													$selected = "SELECTED";
												} else {
													$selected = "";
												}
												
												echo '<option value="'.$lid.'"'.$selected.'> '.$leave_c.'</option>' ."\r\n";
											}

										}
										
									}else{
										
										echo '<option value="">Ooops, no  staff leave category was found.</option>' ."\r\n"; 
										
									} 

								?>
							</select>	 
							<div class="field-placeholder"> Leave Type <span class="text-danger">*</span></div>
						</div>
						<!-- field wrapper end -->
					</div>	
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">	 									
						<!-- field wrapper start -->
						<div class="field-wrapper">										 
							<input type="text" class="form-control" placeholder="Enter Leave Days" 
							name="l_apply"  id="l_apply" required>
							<div class="field-placeholder"> Leave Days  <span class="text-danger">*</span></div>
						</div>
						<!-- field wrapper end -->
					</div> 												 
				</div>	
				<!-- /row -->

				<!-- row -->
				<div class="row gutters">
					<div class="col-12">										
						<!-- field wrapper start -->
						<div class="field-wrapper">
							<input type="text" class="form-control l_days" placeholder="Leave Days" 
							name="l_daysD"  id="l_daysD" disabled>
							<input type="hidden" class="form-control l_days" placeholder="Leave Days" 
							name="l_days"  id="l_days">
							<div class="field-placeholder"> Duration (Days) <span class="text-danger">*</span></div>
						</div>
						<!-- field wrapper end -->
					</div>									 
				</div>	
				<!-- /row -->
				
				<hr class="mt-30 mb-15 text-danger" />
				<!-- row -->
				<div class="row gutters modal-btn-footer">
					<div class="col-6 text-start">
						<button type="button" id="close-modal" class="btn btn-danger close-modal" 
						data-bs-dismiss="modal"> <i class="mdi mdi-window-close label-icon"></i> Close</button>
					</div>
					<div class="col-6 text-end">
						<input type="hidden" name="leave_st" value="save" /> 	
						<button type="submit" class="btn btn-primary waves-effect   
						btn-label waves-light" id="saveStaffLeave">
							<i class="mdi mdi-content-save label-icon"></i>  Save
						</button>
					</div>
				</div>	
				<!-- /row -->	 
													
			</form>

			<script type='text/javascript'>

				$(function() {
					$('input[name="l_apply"]').daterangepicker({
						
						"autoApply": true,
						locale: {
							format: 'YYYY-MM-DD'
						},
						showDropdowns: true,

					}, function(start, end, label) { 
						var diff = end.diff(start, 'days');  
						$(".l_days").val(diff);
					});
				});

				$('.wiz-select').each(function() {  
					renderSelect($('#'+this.id)); 
				}); 

				hidePageLoader();

			</script>
					
<?php						
							
		exit;   
		
		}else{ 
		
			echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
		
		}  
exit; 
?>