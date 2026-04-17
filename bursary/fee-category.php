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
	This script handle school fees category
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

		define('fobrain', 'igweze');  /* define a check for wrong access of file */

		require 'fobrain-config.php';  /* load fobrain configuration files */
				
		if ($_REQUEST['feeCat'] == 'save') {  /* save fees category */ 
			
			$category = clean($_REQUEST['fee']);
			$amount = cleanInt($_REQUEST['amount']);
			$account = cleanInt($_REQUEST['account']);			
			$regDate = strtotime(date("Y-m-d H:i:s"));
			
			/* script validation */
			
			if ($category == "")  {
				
				$msg_e = "* Ooops Error, please enter new fee category name";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
				
			}elseif ($amount == "")  {
			
				$msg_e = "* Ooops Error, please enter fee category price";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
			
			}/*elseif ($account == "")  {
			
				$msg_e = "* Ooops Error, please link a bank account";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
			
			}*/else {  /* update information */     			


				try {
					
					
					$ebele_mark = "INSERT INTO $feeCategoryTB  (fee, amount)

							VALUES (:fee, :amount)";
					
					$igweze_prep = $conn->prepare($ebele_mark);

					$igweze_prep->bindValue(':fee', $category);
					$igweze_prep->bindValue(':amount', $amount); 
					//$igweze_prep->bindValue(':account', $account); , account, :account
					
					if($igweze_prep->execute()){  /* if sucessfully */
						
						$msg_s = "<strong>$category</strong> fee was successfully saved"; 
						echo $succesMsg.$msg_s.$sEnd; 
						echo "<script type='text/javascript'> 
								$('#load-fee-category').load('fee-category-info.php'); 
								$('#frmsaveFeeC')[0].reset();  
								//$('#modal-fobrain').modal('hide');
								hidePageLoader();  
							</script>"; exit;
						
					}else{  /* display error */
			
						$msg_e =  "Ooops, an error has occur while to add new fee category. Please try again";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
						
					}
					

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				} 
		
			}
		
		}elseif ($_REQUEST['feeCat'] == 'update') {  /* update fees category */

			
			$category = clean($_REQUEST['fee']);
			$amount = cleanInt($_REQUEST['amount']);
			//$account = cleanInt($_REQUEST['account']);
			$status = cleanInt($_REQUEST['status']);
			$fID = cleanInt($_REQUEST['fID']);			
			
			/* script validation */ 
			
			if ($fID == ""){
				
				$msg_e = "* Ooops, an error has occur to retrieve fee category. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
				
			}elseif ($category == "")  {
				
				$msg_e = "* Ooops Error, please enter new fee category name";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
				
			}elseif ($amount == "")  {
			
				$msg_e = "* Ooops Error, please fee category amount";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
			
			}/*elseif ($account == "")  {
			
				$msg_e = "* Ooops Error, please link a bank account";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
			
			}*/else {  /* update information */     			


				try {
					
					
					$ebele_mark = "UPDATE $feeCategoryTB
									
									SET 
									
										fee = :fee, 
										amount = :amount,  
										status = :status
										
										WHERE f_id = :f_id";
					
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':fee', $category);
					$igweze_prep->bindValue(':amount', $amount);
					//$igweze_prep->bindValue(':account', $account); account = :account,
					$igweze_prep->bindValue(':status', $status);
					$igweze_prep->bindValue(':f_id', $fID); 
					
					if($igweze_prep->execute()){  /* if sucessfully */
						
						$msg_s = "<strong>$category</strong> was successfully saved"; 
						echo $succesMsg.$msg_s.$sEnd; 
						echo "<script type='text/javascript'> 
								$('#load-fee-category').load('fee-category-info.php');  
								//$('#edit-fee-category-div').slideUp(1500);
								$('#modal-fobrain').modal('hide');
								hidePageLoader(); 
							</script>";exit;
						
					}else{  /* display error */
			
						$msg_e =  "Ooops, an error has occur while to save fee category. Please try again";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
						
					}
					

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				} 
		
			}
		
		}elseif ($_REQUEST['feeCat'] == 'remove') {  /* remove fees category */

			
			$feeCat = $_REQUEST['rData'];
			
			list($fobrainIg, $fID, $hName) = explode("-", $feeCat);			
			
			/* script validation */
			
			if (($feeCat == "")  || ($fID == "")){
				
				$msg_e = "* Ooops, an error has occur while to remove fee category. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader();  </script>";exit;
				
			}else {   /* update information */    			

				try {
											
					$ebele_mark = "UPDATE $feeCategoryTB
									
									SET 										
										status = :status
										
										WHERE f_id = :f_id";
					
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':status', $i_false);
					$igweze_prep->bindValue(':f_id', $fID); 
					
					if($igweze_prep->execute()){  /* if sucessfully */
						
						//$removeDiv = "$('#row-".$fID."').fadeOut(1000);";
						$msg_s = "<strong>$hName</strong> was successfully Disenable"; 
						echo $succesMsg.$msg_s.$sEnd; 
						echo "<script type='text/javascript'>    
								$('#load-fee-category').load('fee-category-info.php');
								hidePageLoader();   
						</script>";exit;
						
					}else{  /* display error */
			
						$msg_e =  "Ooops, an error has occur while to remove fee category. Please try again";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'> hidePageLoader();  </script>";exit;
						
					}
					

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				}          		
		
			}
		
		}elseif ($_REQUEST['feeCat'] == 'edit') {  /* edit fees category */

			
			$fID = strip_tags($_REQUEST['rData']);
			
			/* script validation */ 
			
			if ($fID == ""){
				
				$msg_e = "* Ooops, an error has occur while to retrieve fee category information. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
				
			}else {  /* select information */     			

				try { 
					
					$categoryInfoArr = feeCategoryInfo($conn, $fID);  /* school fee category information */
					$category = $categoryInfoArr[$fiVal]['fee'];
					$amount = $categoryInfoArr[$fiVal]['amount'];
					//$account = $categoryInfoArr[$fiVal]['account'];
					$status = $categoryInfoArr[$fiVal]['status'];

					//$account_opt = bankOptions($conn, $account, 1);


$categoryFormTop =<<<IGWEZE
	
					<form class="form-horizontal mt-10" id="frmupdateFeeC"> 
					<!-- row -->
					<div class="row gutters">
						<div class="col-12">										
							<!-- field wrapper start -->
							<div class="field-wrapper">
								<input type="text"  id="fee" name="fee"  class="form-control" value="$category" required style="text-transform:Capitalize;">
								<div class="field-placeholder">Category<span class="text-danger">*</span></div>													
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
								<input type="number"  id="amount" name="amount" value="$amount" class="form-control" required>
								<div class="field-placeholder"> Price <span class="text-danger">*</span></div>													
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
								<select class="form-control fob-select" name="status"  id="status" required>
																
									<option value = "">Please select One</option> 

IGWEZE;

									echo $categoryFormTop;
											
									foreach($onOffArr as $status_key => $status_value){  /* loop array */

										if ($status == $status_key){
											$selected = "SELECTED";
										} else {
											$selected = "";
										}

										echo '<option value="'.$status_key.'"'.$selected.'>'.$status_value.'</option>' ."\r\n";

									}	     	

$categoryFormBot =<<<IGWEZE


								</select>

								<div class="field-placeholder"> Price <span class="text-danger">*</span></div>													
							</div>
							<!-- field wrapper end -->
						</div>																 
					</div>	
					<!-- /row -->

					<!-- row -- >
					<div class="row gutters">
						<div class="col-12">										
							<!- - field wrapper start -- >
							<div class="field-wrapper">			
								<select class="form-control fob-select"  name="account"  id="account" required>
																
									<option value = "">Please a Bank Account</option>  
									//$account_opt

								</select>

								<div class="field-placeholder"> Link Bank Account <span class="text-danger">*</span></div>													
							</div>
							<!- - field wrapper end -- >
						</div>																 
					</div>	
					<! -- /row -->

					<hr class="mt-30 mb-15 text-danger" />
					<!-- row -->
					<div class="row gutters modal-btn-footer">
						<div class="col-6 text-start">
							<button type="button" id="close-modal" class="btn btn-danger close-modal" 
							data-bs-dismiss="modal"> <i class="mdi mdi-window-close label-icon"></i> Close</button>
						</div>
						<div class="col-6 text-end">
							<input type="hidden" name="feeCat" value="update" />
							<input type="hidden" name="fID" value="$fID" />
							<button type="submit" class="btn btn-primary waves-effect   
							btn-label waves-light demo-disenable" id="updateFeeC">
								<i class="mdi mdi-content-save label-icon"></i>  Update
							</button>
						</div>
					</div>	
					<!-- /row -->		 
												
					</form>
					<!-- / form -->	 
						
	
IGWEZE;
							
					echo $categoryFormBot;														
							
					echo "<script type='text/javascript'>	   
							$('.fob-select').each(function() {  
								renderSelect($('#'+this.id)); 
							});   
							hidePageLoader(); 
						</script>"; exit; 						

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				} 
		
			}
		
		}elseif ($_REQUEST['feeCat'] == 'add') {  /* edit fees category */

			try {  

				//$account_opt = bankOptions($conn, "", 1);

			}catch(PDOException $e) {
		
				fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
		
			} 		

?>
			
				<!-- form -->
				<form class="form-horizontal mt-10" id="frmsaveFeeC"> 
					<!-- row -->
					<div class="row gutters">
						<div class="col-12">										
							<!-- field wrapper start -->
							<div class="field-wrapper">
								<input type="text"  id="fee" name="fee"  class="form-control"  required style="text-transform:Capitalize;">
								<div class="field-placeholder">Category<span class="text-danger">*</span></div>													
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
								<input type="number"  id="amount" name="amount" class="form-control" required>
								<div class="field-placeholder"> Price <span class="text-danger">*</span></div>													
							</div>
							<!-- field wrapper end -->
						</div>																 
					</div>	
					<!-- /row -->

					<!-- row -- >
					<div class="row gutters">
						<div class="col-12">										
							<!- - field wrapper start -- >
							<div class="field-wrapper">			
								<select class="form-control fob-select"  name="account"  id="account" required>
																
									<option value = "">Please a Bank Account</option>  
									<?php //echo $account_opt; ?>

								</select>

								<div class="field-placeholder"> Link Bank Account <span class="text-danger">*</span></div>													
							</div>
							<!- - field wrapper end -- >
						</div>																 
					</div>	
					<!- - /row -->

					<hr class="mt-30 mb-15 text-danger" />
					<!-- row -->
					<div class="row gutters modal-btn-footer">
						<div class="col-6 text-start">
							<button type="button" id="close-modal" class="btn btn-danger close-modal" 
							data-bs-dismiss="modal"> <i class="mdi mdi-window-close label-icon"></i> Close</button>
						</div>
						<div class="col-6 text-end">
							<input type="hidden" name="feeCat" value="save" /> 
							<button type="submit" class="btn btn-primary waves-effect   
							btn-label waves-light" id="saveFeeC">
								<i class="mdi mdi-content-save label-icon"></i>  Save
							</button>
						</div>
					</div>	
					<!-- /row -->	 
													
				</form>
				<!-- / form -->		
				<script type='text/javascript'>  
					$('.fob-select').each(function() {  
						renderSelect($('#'+this.id)); 
					}); 
					hidePageLoader(); 
				</script>					
	
<?php 		
		}else{ 
		
			echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
		
		} 
		
exit;
?>