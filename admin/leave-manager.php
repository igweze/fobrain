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
	This script handle school leaves
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

		define('fobrain', 'igweze');  /* define a check for wrong access of file */

		require 'fobrain-config-s.php';  /* load fobrain configuration files */	    

		if ($_REQUEST['leave'] == 'save') {  /* save school leave */	    

			$leave_c =  strip_tags($_REQUEST['leave_c']);  
			
			/* script validation */
			
			if ($leave_c == "")  {
				
				$msg_e = "* Ooops Error, please enter Leave Category";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>  hidePageLoader();  </script>";exit;
				
			}else {  /* insert information */        
			 

				try {
					
					
					$ebele_mark = "INSERT INTO $staffLeaveCatTB (leave_c, status)

							VALUES (:leave_c, :status)";
					
					$igweze_prep = $conn->prepare($ebele_mark); 
					$igweze_prep->bindValue(':leave_c', $leave_c);  
					$igweze_prep->bindValue(':status', $fiVal); 
					
					if($igweze_prep->execute()){  /* if sucessfully */
						
						$msg_s = "Leave Category was successfully saved"; 
						echo $succesMsg.$msg_s.$sEnd;  
						echo "<script type='text/javascript'> 
								$('#load-wiz-info-cat').load('leave-cat-info.php');
								$('#frmsaveLeave').slideUp(1500); 
								$('#modal-fobrain').modal('hide');
								hidePageLoader();   
							</script>";exit;
						
					}else{  /* display error */ 
			
						$msg_e =  "Ooops, an error has occur while to save Leave Category. Please try again";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
						
					}
					

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				} 
		
			}
		
		}elseif ($_REQUEST['leave'] == 'update') {  /* update school leave */

			$lid = cleanInt($_REQUEST['lid']);	
			$leave_c =  clean($_REQUEST['leave_c']);	  
			
			/* script validation */ 
			
			if ($lid == ""){
				
				$msg_e = "* Ooops, aan error has occur to retrieve leave information. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
				
			}elseif ($leave_c == "")  {
				
				$msg_e = "* Ooops Error, please enter Leave Category";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
				
			}else {  /* update information */      
				 

				try { 
					
					$ebele_mark = "UPDATE $staffLeaveCatTB 
										
										SET  
											
										leave_c = :leave_c 
										
									WHERE lid = :lid";
					
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':lid', $lid); 
					$igweze_prep->bindValue(':leave_c', $leave_c);  
					
					if($igweze_prep->execute()){  /* if sucessfully */
						
						$msg_s = "Leave Category was successfully saved."; 
						echo $succesMsg.$msg_s.$sEnd; 
						echo "<script type='text/javascript'> 
								$('#load-wiz-info-cat').load('leave-cat-info.php'); 
								hidePageLoader();  
								$('#modal-fobrain').modal('hide');
								$('#frmupdateLeave').slideUp(1500);
						</script>";exit;
						
					}else{  /* display error */ 
			
						$msg_e =  "Ooops, an error has occur while to save Leave Category. Please try again";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
						
					} 

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				} 
		
			}
		
		}elseif ($_REQUEST['leave'] == 'remove') {  /* remove school leave */ 
			
			$lid = $_REQUEST['rData']; 			
			
			/* script validation */
			
			if ($lid == ""){
				
				$msg_e = "* Ooops, an error has occur while to disenable Leave Category. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
				
			}else {  /* remove information */    

				try { 
					
					$ebele_mark = "UPDATE $staffLeaveCatTB 
										
										SET  
											
										status = :status										
										
									WHERE lid = :lid";
					
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':lid', $lid);   
					$igweze_prep->bindValue(':status', $i_false); 
					
					if($igweze_prep->execute()){  /* if sucessfully */
						
						//$removeDiv = "$('#leave-c-".$lid."').fadeOut(1000);";
						$msg_s = "<strong>Leave Category</strong> was successfully disenable"; 
						echo $succesMsg.$msg_s.$sEnd; 
						echo "<script type='text/javascript'>   
								$('#load-wiz-info-cat').load('leave-cat-info.php');
								hidePageLoader();   
						</script>";exit;
						
					}else{  /* display error */ 
			
						$msg_e =  "Ooops, an error has occur while to disenable Leave Category. Please try again";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
						
					}
					

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				} 
		
			}
		
		}elseif ($_REQUEST['leave'] == 'leave-action') {  /* update school leave */

			$lid = cleanInt($_REQUEST['lid']);	 
			$status = $_REQUEST['status']; 

			/* script validation */ 
			
			if ($lid == ""){
				
				$msg_e = "* Ooops, aan error has occur to retrieve leave information. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
				
			}elseif ($status == "")  {
				
				$msg_e = "* Ooops Error, please select an action";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
				
			}else {  /* update information */      
				 

				try { 
					
					$ebele_mark = "UPDATE $staffLeaveTB 
										
										SET  
											
										status = :status 
										
									WHERE l_id = :l_id";
					
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':l_id', $lid); 
					$igweze_prep->bindValue(':status', $status);  
					
					if($igweze_prep->execute()){  /* if sucessfully */
						
						$msg_s = "Staff Leave was successfully saved."; 
						echo $succesMsg.$msg_s.$sEnd; 
						echo "<script type='text/javascript'> 
								$('#load-wiz-info').load('leave-info.php'); 
								hidePageLoader();  
								$('#frmsaveLeaveApp').slideUp(1500);
								$('#modal-fobrain').modal('hide');
						</script>";exit;
						
					}else{  /* display error */ 
			
						$msg_e =  "Ooops, an error has occur while to save Leave Category. Please try again";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
						
					} 

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				} 
		
			}
		
		}elseif ($_REQUEST['leave'] == 'add') {  /* add school leave */ 
			
			

?>
			<!-- form -->
			<form class="form-horizontal" id="frmsaveLeave" role="form"> 

				<!-- row -->
				<div class="row gutters  justify-content-center">
					<div class="col-lg-6 col-12">										
						<!-- field wrapper start -->
						<div class="field-wrapper">
							<input type="text" class="form-control" placeholder="Enter Leave Category" 
							name="leave_c"  id="leave_c">
							<div class="field-placeholder"> Leave<span class="text-danger">*</span></div>
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
						<input type="hidden" name="leave" value="save" />
						<button type="submit" class="btn btn-primary waves-effect   
						btn-label waves-light" id="saveLeave">
							<i class="mdi mdi-content-save label-icon"></i>  Save
						</button>
					</div>
				</div>	
				<!-- /row -->				
			</form>  	
			<!-- / form -->	
			
			<script type='text/javascript'>  hidePageLoader(); </script>
			
<?php						
							
						
		
		}elseif ($_REQUEST['leave'] == 'edit') {  /* edit school leave */ 
			
			$leaveData = strip_tags($_REQUEST['rData']); 

			list($status, $lid, $leave_c) = explode("(-)", $leaveData);	
			
			if ($lid == ""){
				
				$msg_e = "* Ooops, an error has occur while to retrieve Leave Category. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
				
			}else {    
  

?>
				<!-- form -->
				<form class="form-horizontal" id="frmupdateLeave" role="form"> 

					<!-- row -->
					<div class="row gutters  justify-content-center">
						<div class="col-lg-6 col-12">											
							<!-- field wrapper start -->
							<div class="field-wrapper">
								<input type="text" class="form-control" placeholder="Enter Leave Category" 
								name="leave_c"  id="leave_c" value="<?php echo $leave_c; ?>">
								<div class="field-placeholder"> Leave<span class="text-danger">*</span></div>
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
							<input type="hidden" name="leave" value="update" />
							<input type="hidden" name="lid" value="<?php echo $lid; ?>" />
							<button type="submit" class="btn btn-primary    
							btn-label waves-light" id="updateLeave">
								<i class="mdi mdi-content-save label-icon"></i>  Save
							</button>
						</div>
					</div>	
					<!-- /row -->

				</form>  	
				<!-- / form -->		 
<?php						
						
				echo "<script type='text/javascript'> hidePageLoader();  </script>"; exit; 
  
			}
		
		}elseif ($_REQUEST['leave'] == 'load-leave') {  /* edit school leave */ 
			
			$leaveData = strip_tags($_REQUEST['rData']); 

			list($status, $lid) = explode("(-)", $leaveData);	
			
			if ($lid == ""){
				
				$msg_e = "* Ooops, an error has occur while to retrieve leave information. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
				
			}else {    
  

?>
				<!-- form -->
				<form class="form-horizontal" id="frmsaveLeaveApp" role="form"> 

					<!-- row -->
					<div class="row gutters  justify-content-center">
						<div class="col-lg-6 col-12">											
							<!-- field wrapper start -->
							<div class="field-wrapper"> 
								<select class="form-control"  id="status" name="status" required>                                              
									<option value = "">Search . . .</option>
									<?php

										foreach($leave_list as $statusS => $statusSVal){  /* loop array */

											if ($status == $statusS){
												$selected = "SELECTED";
											} else {
												$selected = "";
											}

											echo '<option value="'.$statusS.'"'.$selected.'>'.$statusSVal.'</option>' ."\r\n";

										}

									?>												
								</select>
								<div class="field-placeholder"> Take Action <span class="text-danger">*</span></div>
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
							<input type="hidden" name="leave" value="leave-action" />
							<input type="hidden" name="lid" value="<?php echo $lid; ?>" />
							<button type="submit" class="btn btn-primary    
							btn-label waves-light" id="saveLeaveApp">
								<i class="mdi mdi-content-save label-icon"></i>  Save
							</button>
						</div>
					</div>	
					<!-- /row -->

				</form>  	
				<!-- / form -->		 
<?php						
						
				echo "<script type='text/javascript'> hidePageLoader();  </script>"; exit; 
  
			}
		
		}else{ 
		
			echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
		
		} 
		
exit;

?>