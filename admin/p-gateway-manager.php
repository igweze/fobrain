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
	This script handle payment gateway 
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

		define('fobrain', 'igweze');  /* define a check for wrong access of file */ 
		require 'fobrain-config-s.php';  /* load fobrain configuration files */ 
				
		if ($_REQUEST['gatewayPaymentData'] == 'saveGateway-future') {  /* save payment gateway */

			
			$user = clean($_REQUEST['user']);
			$api =  clean($_REQUEST['api']);				
			$password = clean($_REQUEST['password']); 
			
			/* script validation */
			
			if ($user == "")  {
				
				$msg_e = "* Ooops Error, please select PayGateway user name";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($expDetails == "")  {
				
				$msg_e = "* Ooops Error, please enter PayGateway details";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($password == "")  {
				
				$msg_e = "* Ooops Error, please enter PayGateway password";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			} else {  /* insert information */    

				try { 
					
					$ebele_mark = "INSERT INTO $fobrainPayGatewayTB  (user, password, api, status)

							VALUES (:user, :password, :api, :status)";
					
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':user', $user);
					$igweze_prep->bindValue(':password', $password);
					$igweze_prep->bindValue(':api', $api);
					$igweze_prep->bindValue(':status', $status); 
					
					if($igweze_prep->execute()){  /* if sucessfully */ 
						
						$msg_s = "School PayGateway was successfully saved"; 
						echo $succesMsg.$msg_s.$sEnd; 
						echo "<script type='text/javascript'> $('#viewPayGateway').load('paymentGatewayInfo.php'); 
						$('#frmsavePayGateway')[0].reset();hidePageLoader();  
						$('.alert').fadeOut(30000); </script>";exit;
						
					}else{  /* display error */ 
			
						$msg_e =  "Ooops, an error has occur while to save payment. Please try again";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
						
					}
					

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				}          		
		
			}
		
		}elseif ($_REQUEST['gatewayPaymentData'] == 'updatePayGateway') {  /* update payment gateway */

			$gID = cleanInt($_REQUEST['gID']);	 
			$gateKey = clean($_REQUEST['gateKey']);  
			
			/* script validation */
							
			if ($gID == ""){
				
				$msg_e = "* Ooops, an error has occur to retrieve payment information. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($gateKey == "")  {
				
				$msg_e = "* Ooops Error, please enter PayGateway Gateway Username";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}else {  /* update information */     
					
				try { 
					
					$ebele_mark = "UPDATE $fobrainPayGatewayTB  
										
										SET 
										
										gateKey = :gateKey 
										
									WHERE gID = :gID";
					
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':gID', $gID); 
					$igweze_prep->bindValue(':gateKey', $gateKey); 
					if($igweze_prep->execute()){  /* if sucessfully */
						
						$msg_s = "Payment gateway information was successfully saved."; 
						echo $succesMsg.$msg_s.$sEnd; 
						echo "<script type='text/javascript'> 
							$('#load-wiz-info').load('payment-gateway-info.php'); 
							$('#modal-fobrain').modal('hide');
							hidePageLoader();   
						</script>";exit; 
						
					}else{  /* display error */
			
						$msg_e =  "Ooops, an error has occur while to save payment gateway. Please try again";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
						
					} 

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				}          		
		
			}
		
		}elseif ($_REQUEST['gatewayPaymentData'] == 'viewPayGateway') {  /* view payment gateway */

			
			$gID = clean($_REQUEST['rData']);
			
			/* script validation */ 
			
			if ($gID == ""){
				
				$msg_e = "* Ooops, an error has occur while to retrieve payment gateway information. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}else {  

				try { 
					
					$gatewayPaymentInfoArr = gatewayPaymentInfo($conn, $gID);  /* payment gateways information */ 
					$gateway = $gatewayPaymentInfoArr[$fiVal]["gateway"];
					$gatewayVerb = $gatewayPaymentInfoArr[$fiVal]["gatewayVerb"];
					$gateKey = $gatewayPaymentInfoArr[$fiVal]["gateKey"]; 	 
								

$showGateway =<<<IGWEZE
	
					<div class="row gutters mb-10">
						<div class="text-end">
							<button  class="btn btn-primary" onclick="printDiv('fobrain-print-ovly')">
								<i class="fas fa-print"></i>  
							</button>
						</div>	
					</div>
							
					<div id = 'fobrain-print-ovly'>

						<!-- table -->	
						<table  class="table table-view table-hover table-responsive">  
							<tr>
								<th style="padding-left: 30px; text-align:left; width: 40%;"> $gatewayVerb </td> 
								<td style="padding-left: 30px; text-align:left; width: 60%;"> $gateKey </td> 
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
		
		}elseif ($_REQUEST['gatewayPaymentData'] == 'editPayGateway') {  /* edit payment gateway */

			
			$gID = clean($_REQUEST['rData']);
			
			/* script validation */ 
			
			if ($gID == ""){
				
				$msg_e = "* Ooops, an error has occur while to retrieve payment gateway information. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}else {  /* select information */        			


				try {
					
					
					$gatewayPaymentInfoArr = gatewayPaymentInfo($conn, $gID);  /* payment gateways information */
					$paymentID = $gatewayPaymentInfoArr[$fiVal]["gID"];
					$gateway = $gatewayPaymentInfoArr[$fiVal]["gateway"];
					$gatewayVerb = $gatewayPaymentInfoArr[$fiVal]["gatewayVerb"];
					$gateKey = $gatewayPaymentInfoArr[$fiVal]["gateKey"];
							
							
						
					
		?>

					<!-- form -->
					<form class="form-horizontal" id="frmupdatePayGateway" role="form"> 

						<!-- row -->
						<div class="row gutters">
							<div class="col-12">										
								<!-- field wrapper start -->
								<div class="field-wrapper">
									<input type="text" class="form-control" placeholder="Enter PayGateway Gateway Sender Name" 
									name="gateKey"  id="gateKey" value="<?php echo $gateKey; ?>">
								<div class="field-placeholder"> <?php echo $gatewayVerb; ?> <span class="text-danger">*</span></div>
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
								<input type="hidden" name="gID" value="<?php echo $gID; ?>" />
								<input type="hidden" name="gatewayPaymentData" value="updatePayGateway" />
								<button type="submit" class="btn btn-primary waves-effect   
								btn-label waves-light" id="updatePayGateway">
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