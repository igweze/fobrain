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
	This script handle student roll call
	------------------------------------------------------------------------*/

if(!session_id()){
	session_start();
}
		define('fobrain', 'igweze');  /* define a check for wrong access of file */

		require 'fobrain-config.php';  /* load fobrain configuration files */ 

		if ($_REQUEST['rollreply'] == 'update') {  /* update roll call */

			$rID = cleanInt($_REQUEST['rID']);			 
			$reply = clean($_REQUEST['reply']);  
			
			/* script validation */ 
							
			if ($rID == ""){
				
				$msg_e = "* Ooops, an error has occur to retrieve roll call information. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($reply == "")  {
				
				$msg_e = "* Ooops Error, please enter reply to teacher comment";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
				
			}else {  /* update information */       			
			 
				try { 
					
					$ebele_mark = "UPDATE $daily_comments_tb  
										
										SET 
										
										reply = :reply  
										
										WHERE rID = :rID";
					
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':rID', $rID);
					$igweze_prep->bindValue(':reply', $reply); 
					 
					
					if($igweze_prep->execute()){  /* if sucessfully */
						
						$msg_s = "Attendace Reply information was successfully saved."; 
						echo $succesMsg.$msg_s.$sEnd; 
						echo "<script type='text/javascript'> 
								$('.parent-reply-$rID').html('$reply'); 
								$('#frmupdateRollReply').slideUp(1500);
								hidePageLoader();  
						</script>";exit;
						
					}else{  /* display error */ 
			
						$msg_e =  "Ooops, an error has occur while to save Attendace Reply. 
						Please try again";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
						
					}
					

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				}          		
		
			}
		
		}elseif ($_REQUEST['rollreply'] == 'edit') {  /* edit roll call */ 
			
			$rID = strip_tags($_REQUEST['eData']);
			
			/* script validation */
			
			if ($rID == ""){
				
				$msg_e = "* Ooops, an error has occur while to retrieve roll call information. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}else {       	 

				try {						
						
					$rollcallInfoArr = fobrainrollCallInfo($conn, $regID, $rID);  /* online student roll call information */ 
					$reply = $rollcallInfoArr[$fiVal]["reply"]; 
					 						
			
?>
					<!-- form -->
					<form class="form-horizontal" id="frmupdateRollReply" role="form">
						
						<!-- row -->
						<div class="row gutters">
							<div class="col-lg-12">										
								<!-- field wrapper start -->
								<div class="field-wrapper">	
									<textarea rows="3" cols="10" class="form-control required" id="reply" name="reply"
									placeholder="Drop your reply to teacher"><?php echo $reply; ?></textarea>
									<div class="field-placeholder"> Drop Reply <span class="text-danger">*</span></div>
								</div>
								<!-- field wrapper end -->
							</div>
						</div> 
							

						<hr class="mt-30 mb-15 text-danger" />
						<!-- row -->
						<div class="row gutters modal-btn-footer">
							<div class="col-6 text-start">
								<button type="button" id="close-modal" class="btn btn-danger close-modal" 
								data-bs-dismiss="modal"> <i class="mdi mdi-window-close label-icon"></i> Close</button>
							</div>
							<div class="col-6 text-end">
								<input type="hidden" name="rID" value="<?php echo $rID; ?>" />
								<input type="hidden" name="rollreply" value="update" />
								<button type="submit" class="btn btn-primary waves-effect   
								btn-label waves-light" id="updateRollReply">
									<i class="mdi mdi-reply-all-outline label-icon"></i>  Send
								</button>
							</div>
						</div>	
						<!-- /row --> 
							
					</form>  
					<!-- / form -->	 

					<script type='text/javascript'>   

						hidePageLoader(); 
							
					</script>							
			<?php								
					
						exit;						
														
				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				}		 
		
			}
		
		}elseif ($_REQUEST['rollreply'] == 'add') {  /* start roll call */  

?>

			<!-- form -->
			<form class="form-horizontal mb-30" id="frmsaveRollReply" role="form">	  
				<!-- row -->
				<div class="row gutters">
					<div class="col-lg-12">										
						<!-- field wrapper start -->
						<div class="field-wrapper">	
							<textarea rows="3" cols="10" class="form-control required" id="reply" name="reply"
							placeholder="Drop your reply to teacher"></textarea>
							<div class="field-placeholder"> Drop Reply <span class="text-danger">*</span></div>
						</div>
						<!-- field wrapper end -->
					</div>
				</div>

				<!-- row -->
				<div class="row gutters mt-30">
					<div class="col-12 text-end"> 
						<button type="submit" class="btn btn-primary waves-effect   
						btn-label waves-light" id="saveRollReply">
							<i class="mdi mdi-reply-all-outline label-icon"></i>  Send 
						</button>
					</div>
				</div>	
				<!-- /row -->	  
		
			</form>
			<!-- / form --> 					  

			<script type="text/javascript">	  
				hidePageLoader(); 
			</script>		

<?php



			
		}else{ 
		
			echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
		
		}
		
exit;
?>

