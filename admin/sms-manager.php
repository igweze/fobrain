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
	This script handle school SMS gateway
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

     	define('fobrain', 'igweze');  /* define a check for wrong access of file */

        require 'fobrain-config-s.php';  /* load fobrain configuration files */
		         
				 
			if ($_REQUEST['smsData'] == 'saveGateway-future') {  /* save SMS gateway */ 
				
				$user = $_REQUEST['user'];
				$api =  $_REQUEST['api'];				
				$password = $_REQUEST['password'];
				$status = cleanInt($_REQUEST['status']);
				
				$user = strip_tags($user);
				$api = strip_tags($api);
				
				/* script validation */  
				
				if ($user == "")  {
         			
					$msg_e = "* Ooops Error, please select sms user name";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#saveLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($expDetails == "")  {
         			
					$msg_e = "* Ooops Error, please enter sms details";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#saveLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($password == "")  {
         			
					$msg_e = "* Ooops Error, please enter sms password";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#saveLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($status == "")  {
         			
					$msg_e = "* Ooops Error, please select a sms status";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#saveLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($pDay == "")  {
         			
					$msg_e = "* Ooops Error, please select a sms date";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#saveLoader').fadeOut(1500); </script>";exit;
					
	   			}else {  /* insert information */   

		 			try {
						
						$password = htmlspecialchars($password);
						
						$ebele_mark = "INSERT INTO $fobrainSMSTB  (user, password, api, status)

								VALUES (:user, :password, :api, :status)";
					 
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':user', $user);
						$igweze_prep->bindValue(':password', $password);
						$igweze_prep->bindValue(':api', $api);
						$igweze_prep->bindValue(':status', $status); 
						
						if($igweze_prep->execute()){  /* if sucessfully */
							
							$msg_s = "School sms was successfully saved"; 
							echo $succesMsg.$msg_s.$sEnd; 
							echo "<script type='text/javascript'> $('#viewSMS').load('fobrainSMSInfo.php'); 
							$('#frmsaveSMS')[0].reset();  $('#saveLoader').fadeOut(1500);  
							$('.alert').fadeOut(30000); </script>";exit;
							
						}else{  /* display error */ 
				
							$msg_e =  "Ooops, an error has occur while to save sms. Please try again";
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'>   $('#saveLoader').fadeOut(1500); </script>";exit;
							
						}
						

				 	}catch(PDOException $e) {
  			
						fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					}
        	
				}
			
			}elseif ($_REQUEST['smsData'] == 'updateSMS') {  /* update SMS gateway */

				$sID = cleanInt($_REQUEST['sID']);			
				$user = $_REQUEST['user'];
				$senderID = $_REQUEST['senderID'];
				$api =  $_REQUEST['api'];
				$password = $_REQUEST['password'];
				$status = cleanInt($_REQUEST['status']);
				
				$user = strip_tags($user);
				$api = strip_tags($api);
				$senderID = strip_tags($senderID);
				
				/* script validation */ 
				
				if ($sID == ""){
         			
					$msg_e = "* Ooops, an error has occur to retrieve sms information. Please try again";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
					
	   			}elseif (($user == "")  && ($password == "") && ($api == "") ){
         			
					$msg_e = "* Ooops Error, please enter SMS Gateway Username and  Password or Gateway API";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
					
	   			}elseif ($status == "")  {
         			
					$msg_e = "* Ooops Error, please select a sms status";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
					
	   			}else {  /* update information */   
				
		 			try {
						
						$password = htmlspecialchars($password);
						
						if($status == $fiVal){
							
							$ebele_mark = "UPDATE $fobrainSMSTB  
											
											SET 											
											
											status = :fobrain
											
											WHERE status = :status";
					 
							$igweze_prep = $conn->prepare($ebele_mark);
							$igweze_prep->bindValue(':status', $sID);
							$igweze_prep->bindValue(':fobrain', $i_false);
							$igweze_prep->execute();
							
							
						}	
						
						$ebele_mark = "UPDATE $fobrainSMSTB  
											
											SET 
											
											senderID = :senderID,
											user = :user, 
											password = :password, 
											api = :api,
											status = :status
											
										WHERE sID = :sID";
					 
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':sID', $sID);
						$igweze_prep->bindValue(':user', $user);
						$igweze_prep->bindValue(':senderID', $senderID);
						$igweze_prep->bindValue(':password', $password);
						$igweze_prep->bindValue(':api', $api);
						$igweze_prep->bindValue(':status', $status); 
						
						if($igweze_prep->execute()){  /* if sucessfully */
							
							$msg_s = "SMS gateway information was successfully saved."; 
							echo $succesMsg.$msg_s.$sEnd; 
							echo "<script type='text/javascript'> 
								$('#load-wiz-info').load('sms-info.php'); 
								$('#modal-fobrain').modal('hide');
							 	hidePageLoader();  
							</script>";exit;
							
						}else{  /* display error */ 
				
							$msg_e =  "Ooops, an error has occur while to save sms gateway. Please try again";
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
							
						} 

				 	}catch(PDOException $e) {
  			
						fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					}         		
        	
				}
			
			}elseif ($_REQUEST['smsData'] == 'viewSMS') {  /* view SMS gateway */ 
				
				$sID = strip_tags($_REQUEST['rData']);
				
				/* script validation */
				
				if ($sID == ""){
         			
					$msg_e = "* Ooops, an error has occur while to retrieve sms gateway information. Please try again";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
					
	   			}else {  /* select information */       	 

		 			try { 
						$smsInfoArr = smsInfo($conn, $sID);  /* text message and gateway information  */ 
						$gateway = $smsInfoArr[$fiVal]["gateway"];
						$senderID = $smsInfoArr[$fiVal]["senderID"];
						$user = $smsInfoArr[$fiVal]["user"];
						$password = htmlspecialchars_decode($smsInfoArr[$fiVal]["password"]);
						$api = $smsInfoArr[$fiVal]["api"];
						$status = $smsInfoArr[$fiVal]["status"]; 
						$status = $onOffArr[$status]; 

$showGateway =<<<IGWEZE
		
	 
					<div id = 'table-responsive'>
						<!-- table -->	
						<table class="table table-hover table-responsive style-table"> 
							<tr>
								<th style="padding-left: 30px; text-align:left; width: 40%;">
									Gateway 
								</th> 
								<td style="padding-left: 30px; text-align:left; width: 60%;">
									$gateway
								</td> 
							</tr>
							
							<tr>
								<th style="padding-left: 30px; text-align:left; width: 40%;">
									Sender Name 
								</th> 
								<td style="padding-left: 30px; text-align:left; width: 60%;">
									$senderID
								</td> 
							</tr>
							
							<tr>
								<th style="padding-left: 30px; text-align:left; width: 40%;">
									Username
								</th> 
								<td style="padding-left: 30px; text-align:left; width: 60%;">
									$user
								</td> 
							</tr>
							
							<tr>
								<th style="padding-left: 30px; text-align:left; width: 40%;">
									Password 
								</th> 
								<td style="padding-left: 30px; text-align:left; width: 60%;">
									$password
								</td>
							</tr>
							
							<tr>
								<th style="padding-left: 30px; text-align:left; width: 40%;">
									Gateway API 
								</th> 
								<td style="padding-left: 30px; text-align:left; width: 60%;">
									$api 
								</td> 
							</tr>
							
							<tr>
								<th style="padding-left: 30px; text-align:left; width: 40%;">
									SMS Status
								</th> 
								<td style="padding-left: 30px; text-align:left; width: 60%;">
									$status
								</td> 
							</tr> 
						</table>
						<!-- / table --> 
					</div>
					
		
IGWEZE;
				
					echo $showGateway;
					
					echo "<script type='text/javascript'> hidePageLoader(); </script>"; exit; 

				 	}catch(PDOException $e) {
  			
						fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					} 
        	
				}
			
			}elseif ($_REQUEST['smsData'] == 'editSMS') {  /* edit SMS gateway */

				
				$sID = strip_tags($_REQUEST['rData']);
				
				/* script validation */
				
				if ($sID == ""){
         			
					$msg_e = "* Ooops, an error has occur while to retrieve sms gateway information. Please try again";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
					
	   			}else {       			


		 			try {
						
						
						$smsInfoArr = smsInfo($conn, $sID);  /* text message and gateway information  */ 
						$smsID = $smsInfoArr[$fiVal]["sID"];
						$senderID = $smsInfoArr[$fiVal]["senderID"];
						$user = $smsInfoArr[$fiVal]["user"];
						$api = $smsInfoArr[$fiVal]["api"];
						$status = $smsInfoArr[$fiVal]["status"];
						$password = htmlspecialchars_decode($smsInfoArr[$fiVal]["password"]); 
						
?>

						<!-- form -->
						<form class="form-horizontal" id="frmupdateSMS" role="form">  

							<!-- row -->
							<div class="row gutters">
								<div class="col-12">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<input type="text" class="form-control" placeholder="Enter SMS Gateway Sender Name" 
										name="senderID"  id="senderID" value="<?php echo $senderID; ?>">									
										<div class="field-placeholder"> Sender Name <span class="text-danger">*</span></div>
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
										<input type="text" class="form-control" placeholder="Enter SMS Gateway User Name" 
										name="user"  id="user" value="<?php echo $user; ?>">
										<div class="field-placeholder">  User Name <span class="text-danger"></span></div>
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
										<input type="text" class="form-control" placeholder="Enter SMS Gateway Password" 
										name="password"  id="password" value="<?php echo $password; ?>">
										<div class="field-placeholder">  Password <span class="text-danger"></span></div>
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
										<input type="text" class="form-control" placeholder="Enter SMS Api" 
										name="api"  id="api" value="<?php echo $api; ?>">
										<div class="field-placeholder"> SMS API <span class="text-danger"></span></div>
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
										<select class="form-control"  id="status" name="status" required>

											<option value = "">Please select One</option>
											<?php 

												foreach($onOffArr as $statusKey => $statusVal){  /* loop array */

													if ($status == $statusKey){
														
														$selected = "SELECTED";
														
													} else {
														
														$selected = "";
														
													}

													echo '<option value="'.$statusKey.'"'.$selected.'>'.$statusVal.'</option>' ."\r\n";

												}

											?> 
										
										</select>
									
										<div class="field-placeholder"> SMS Status <span class="text-danger">*</span></div>
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
									<input type="hidden" name="sID" value="<?php echo $sID; ?>" />
									<input type="hidden" name="smsData" value="updateSMS" />
									<button type="submit" class="btn btn-primary waves-effect   
									btn-label waves-light" id="updateSMS">
										<i class="mdi mdi-content-save label-icon"></i>  Save
									</button>
								</div>
							</div>	
							<!-- /row --> 
								
						</form>  						
						<!-- / form -->
<?php
								
	
						echo "<script type='text/javascript'> hidePageLoader(); </script>"; exit; 
						

				 	}catch(PDOException $e) {
  			
						fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					}		 
        	
				}
			
			}else{ 
			
				echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
			
			}  
exit;
?>