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
	This script handle school Mail SMTP server
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

     	define('fobrain', 'igweze');  /* define a check for wrong access of file */

        require 'fobrain-config-s.php';  /* load fobrain configuration files */
		         
		
		if ($_REQUEST['query'] == 'update') {  /* update Mail SMTP server */

			$mID = 1;			
			$send_name = clean($_REQUEST['send_name']);
			$send_host = clean($_REQUEST['send_host']);
			$send_mail =  clean($_REQUEST['send_mail']);
			$send_pass = $_REQUEST['send_pass'];
			$footer =  $_REQUEST['footer'];
			//$status = cleanInt($_REQUEST['status']); 
			
			/* script validation */ 
			
			if ($mID == ""){
				
				$msg_e = "* Ooops, an error has occur to retrieve mail information. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($send_name == ""){
				
				$msg_e = "* Ooops Error, please enter mail Sender Profile";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($send_host == ""){
				
				$msg_e = "* Ooops Error, please enter mail SMTP Server";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($send_mail == ""){
				
				$msg_e = "* Ooops Error, please enter mail SMTP Username";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($send_pass == ""){
				
				$msg_e = "* Ooops Error, please enter mail SMTP Password";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}else {  /* update information */   
			
				try {
					
					$send_pass = htmlspecialchars($send_pass); 
					$footer = htmlspecialchars($footer); 

					$status = 1;
					
					$ebele_mark = "UPDATE $fobrainMailTB  
										
										SET 
										
										send_host = :send_host,
										send_name = :send_name, 
										send_pass = :send_pass, 
										send_mail = :send_mail,
										footer = :footer,
										status = :status
										
									WHERE mID = :mID";
					
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':mID', $mID);
					$igweze_prep->bindValue(':send_name', $send_name);
					$igweze_prep->bindValue(':send_host', $send_host);
					$igweze_prep->bindValue(':send_pass', $send_pass);
					$igweze_prep->bindValue(':send_mail', $send_mail);
					$igweze_prep->bindValue(':footer', $footer);
					$igweze_prep->bindValue(':status', $status);  
					
					if($igweze_prep->execute()){  /* if sucessfully */
						
						$msg_s = "Mail SMTP server information was successfully saved."; 
						echo $succesMsg.$msg_s.$sEnd; 
						echo "<script type='text/javascript'>  
							hidePageLoader();  
						</script>";exit;
						
					}else{  /* display error */ 
			
						$msg_e =  "Ooops, an error has occur while to save mail SMTP server. Please try again";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
						
					} 

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				}         		
		
			}
		
		}elseif ($_REQUEST['query'] == 'view') {  /* view Mail SMTP server */ 
			
			$mID = strip_tags($_REQUEST['rData']);
			
			/* script validation */
			
			if ($mID == ""){
				
				$msg_e = "* Ooops, an error has occur while to retrieve mail SMTP server information. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}else {  /* select information */       	 

				try { 

					$mail_info_arr = mailInfo($conn, $mID);  /* text message and SMTP server information  */ 
					$gateway = $mail_info_arr[$fiVal]["gateway"];
					$send_host = $mail_info_arr[$fiVal]["send_host"];
					$send_name = $mail_info_arr[$fiVal]["send_name"];
					$send_pass = htmlspecialchars_decode($mail_info_arr[$fiVal]["send_pass"]);
					$send_mail = $mail_info_arr[$fiVal]["send_mail"];
					$footer = $mail_info_arr[$fiVal]["footer"];
					$status = $mail_info_arr[$fiVal]["status"]; 
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
								$send_host
							</td> 
						</tr>
						
						<tr>
							<th style="padding-left: 30px; text-align:left; width: 40%;">
								Username
							</th> 
							<td style="padding-left: 30px; text-align:left; width: 60%;">
								$send_name
							</td> 
						</tr>
						
						<tr>
							<th style="padding-left: 30px; text-align:left; width: 40%;">
								Password 
							</th> 
							<td style="padding-left: 30px; text-align:left; width: 60%;">
								$send_pass
							</td>
						</tr>
						
						<tr>
							<th style="padding-left: 30px; text-align:left; width: 40%;">
								Gateway API 
							</th> 
							<td style="padding-left: 30px; text-align:left; width: 60%;">
								$send_mail 
							</td> 
						</tr>
						
						<tr>
							<th style="padding-left: 30px; text-align:left; width: 40%;">
								Mail Status
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
		
		}elseif ($_REQUEST['query'] == 'edit') {  /* edit Mail SMTP server */

			
			$mID = strip_tags($_REQUEST['rData']);
			
			/* script validation */
			
			if ($mID == ""){
				
				$msg_e = "* Ooops, an error has occur while to retrieve mail SMTP server information. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}else {       			


				try {
					
					
					$mail_info_arr = mailInfo($conn, $mID);  /* text message and SMTP server information  */ 
					$mailID = $mail_info_arr[$fiVal]["mID"];
					$send_host = $mail_info_arr[$fiVal]["send_host"];
					$send_name = $mail_info_arr[$fiVal]["send_name"];
					$send_mail = $mail_info_arr[$fiVal]["send_mail"];
					$status = $mail_info_arr[$fiVal]["status"];
					$send_pass = htmlspecialchars_decode($mail_info_arr[$fiVal]["send_pass"]); 
					
?>

					<!-- form -->
					<form class="form-horizontal" id="frmsave-mail">  
						
						<!-- row -->
						<div class="row gutters">
							<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">											
								<!-- field wrapper start -->
								<div class="field-wrapper">
									<input type="text" class="form-control float-number" placeholder="E.g Amanda School" name="send_name"  id="send_name"
									value = "<?php echo $send_name; ?>">
									<div class="field-placeholder"> Sender Profile <span class="text-danger"></span></div>
									<div class="form-text text-danger">
										This name appears in sent mail
									</div>
								</div>
								<!-- field wrapper end -->
							</div>	
							<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">											
								<!-- field wrapper start -->
								<div class="field-wrapper">
									<input type="text" class="form-control" placeholder="E.g mail.fobrain.com" name="send_host"  id="send_host"
									value = "<?php echo $send_host; ?>">
									<div class="field-placeholder"> SMTP Server <span class="text-danger"></span></div>										 
								</div>
								<!-- field wrapper end -->
							</div>		
							<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">											
								<!-- field wrapper start -->
								<div class="field-wrapper">
									<input type="text" class="form-control" placeholder="E.g info@fobrain.com" name="send_mail"  id="send_mail"
									value = "<?php echo $send_mail; ?>">
									<div class="field-placeholder"> SMTP Username <span class="text-danger"></span></div>										 
								</div>
								<!-- field wrapper end -->
							</div>	
							<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">											
								<!-- field wrapper start -->
								<div class="field-wrapper">
									<input type="text" class="form-control" placeholder="Your SMTP password" name="send_pass"  id="send_pass"
									value = "<?php echo $send_pass; ?>">
									<div class="field-placeholder"> SMTP Password <span class="text-danger"></span></div>										 
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
									<textarea rows="4" cols="10" class="form-control" name="footer" id="footer" 
									placeholder="School Mail Footer"><?php echo $footer; ?></textarea> 

									<div class="field-placeholder"> Mail Footer (Optional) <span class="text-danger">*</span></div>
										
								</div>
								<!-- field wrapper end -->
							</div>																 
						</div>	
						<!-- /row -->
						
						<!-- row -->
						<div class="row gutters mt-30">
							<div class="col-12 text-end">
								<input type="hidden" name="query" value="update" />
								<button type="submit" class="btn btn-primary waves-effect   
								btn-label waves-light" id="save-mail">
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
		
			echo $send_nameNavPageError; exit;  /* else exit or redirect to 404 page */
		
		}  
exit;
?>
 