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
	This script handle virtual gateway 
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

		define('fobrain', 'igweze');  /* define a check for wrong access of file */ 
		require 'fobrain-config-s.php';  /* load fobrain configuration files */ 
				
		if ($_REQUEST['query'] == 'save-future') {  /* save virtual gateway */

			
			$user = clean($_REQUEST['user']);
			$api =  clean($_REQUEST['api']);				
			$password = clean($_REQUEST['password']); 
			
			/* script validation */
			
			if ($user == "")  {
				
				$msg_e = "* Ooops Error, please select virtual gateway user name";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($expDetails == "")  {
				
				$msg_e = "* Ooops Error, please enter virtual gateway details";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($password == "")  {
				
				$msg_e = "* Ooops Error, please enter virtual gateway password";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			} else {  /* insert information */    

				try { 
					
					$ebele_mark = "INSERT INTO $fobrainVitualTB  (user, password, api, status)

							VALUES (:user, :password, :api, :status)";
					
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':user', $user);
					$igweze_prep->bindValue(':password', $password);
					$igweze_prep->bindValue(':api', $api);
					$igweze_prep->bindValue(':status', $status); 
					
					if($igweze_prep->execute()){  /* if sucessfully */ 
						
						$msg_s = "School virtual gateway was successfully saved"; 
						echo $succesMsg.$msg_s.$sEnd; 
						echo "<script type='text/javascript'> $('#view-vitual-gw').load('virtual-gw-info.php'); 
						$('#frmsave-vitual-gw')[0].reset();hidePageLoader();  
						$('.alert').fadeOut(30000); </script>";exit;
						
					}else{  /* display error */ 
			
						$msg_e =  "Ooops, an error has occur while to save virtual. Please try again";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
						
					}
					

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				}          		
		
			}
		
		}elseif ($_REQUEST['query'] == 'update') {  /* update virtual gateway */

			$gID = cleanInt($_REQUEST['gID']);	 
			$gateKey = clean($_REQUEST['gateKey']);  
			
			/* script validation */
							
			if ($gID == ""){
				
				$msg_e = "* Ooops, an error has occur to retrieve virtual information. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($gateKey == "")  {
				
				$msg_e = "* Ooops Error, please enter virtual gateway Username";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}else {  /* update information */     
					
				try { 
					
					$ebele_mark = "UPDATE $fobrainVitualTB  
										
										SET 
										
										gateKey = :gateKey 
										
									WHERE gID = :gID";
					
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':gID', $gID); 
					$igweze_prep->bindValue(':gateKey', $gateKey); 
					if($igweze_prep->execute()){  /* if sucessfully */
						
						$msg_s = "Virtual gateway information was successfully saved."; 
						echo $succesMsg.$msg_s.$sEnd; 
						echo "<script type='text/javascript'> 
							$('#load-wiz-info').load('virtual-gw-info.php'); 
							//$('#modal-fobrain').modal('hide');
							hidePageLoader();   
						</script>";exit; 
						
					}else{  /* display error */
			
						$msg_e =  "Ooops, an error has occur while to save virtual gateway. Please try again";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
						
					} 

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				}          		
		
			}
		
		}elseif ($_REQUEST['query'] == 'view') {  /* view virtual gateway */

			
			$gID = clean($_REQUEST['rData']);
			
			/* script validation */ 
			
			if ($gID == ""){
				
				$msg_e = "* Ooops, an error has occur while to retrieve virtual gateway information. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}else {  

				try { 
					
					$virtualGatewayInfoArr = virtualGatewayInfo($conn, $gID);  /* virtual gateways information */ 
					$gateway = $virtualGatewayInfoArr[$fiVal]["gateway"];
					$gatewayVerb = $virtualGatewayInfoArr[$fiVal]["gatewayVerb"];
					$gateKey = $virtualGatewayInfoArr[$fiVal]["gateKey"]; 	 
								

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
		
		}elseif ($_REQUEST['query'] == 'edit') {  /* edit virtual gateway */

			
			$gID = clean($_REQUEST['rData']);
			
			/* script validation */ 
			
			if ($gID == ""){
				
				$msg_e = "* Ooops, an error has occur while to retrieve virtual gateway information. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}else {  /* select information */         

				try { 
					
					$virtualGatewayInfoArr = virtualGatewayInfo($conn, $gID);  /* virtual gateways information */
					$virtualID = $virtualGatewayInfoArr[$fiVal]["gID"];
					$gateway = $virtualGatewayInfoArr[$fiVal]["gateway"];
					$gatewayVerb = $virtualGatewayInfoArr[$fiVal]["gatewayVerb"];
					$gateKey = $virtualGatewayInfoArr[$fiVal]["gateKey"]; 
						
					
		?>

					<!-- form --> 
					<form class="form-horizontal" id="frmvirtualGateW" role="form"> 

						<!-- row -->
						<div class="row gutters">
							<div class="col-12">										
								<!-- field wrapper start -->
								<div class="field-wrapper">
									<input type="text" class="form-control" placeholder="Enter Virtual Gateway API" 
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
								<input type="hidden" name="query" value="update" />
								<!--
								<button type="submit" class="btn btn-primary waves-effect   
								btn-label waves-light" id="virtualGateW">
									<i class="mdi mdi-content-save label-icon"></i>  Save
								</button>
				-->

								<button class="btn btn-primary fobrain-frm-wizard" 
									type="summit" 
									data-frm="frmvirtualGateW"
									data-server="virtual-gw-manager.php"
									data-target="msg-box"
									data-nerves="fobrain"
									data-scroll="0"
									data-scroll-target="msg-box"
									>
									<span class="button-text">
										<i class="mdi mdi-content-save label-icon"></i> Save 
									</span>									 
									<span class="spinner-text" style="display: none;">Processing...</span>
									<span class="spinner-border ms-auto spinner-icon" aria-hidden="true" 
									style="display: none;"></span>

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