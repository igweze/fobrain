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
	This script handle school accs category
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

		define('fobrain', 'igweze');  /* define a check for wrong access of file */

		require 'fobrain-config.php';  /* load fobrain configuration files */
		 	
		if ($_REQUEST['query'] == 'save') {  /* save accs category */ 
			
			$bankAccount = clean($_REQUEST['acc']);
			$accno = clean($_REQUEST['accno']);
			$bank = clean($_REQUEST['bank']);
			$desc = clean($_REQUEST['desc']);			
			$regDate = strtotime(date("Y-m-d H:i:s"));
			
			/* script validation */
			
			if ($bankAccount == "")  {
				
				$msg_e = "* Ooops Error, please enter new bank account name";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
				
			}elseif ($accno == "")  {
			
				$msg_e = "* Ooops Error, please enter bank account no";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
			
			}elseif ($bank == "")  {
			
				$msg_e = "* Ooops Error, please enter bank name";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
			
			}elseif ($desc == "")  {
			
				$msg_e = "* Ooops Error, please enter school bank acc descriptiona";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
			
			}else {  /* update information */     			


				try {
					
					
					$ebele_mark = "INSERT INTO $bankAccountTB  (acc, accno, bank, descr)

							VALUES (:acc, :accno, :bank, :descr)";
					
					$igweze_prep = $conn->prepare($ebele_mark); 
					$igweze_prep->bindValue(':acc', $bankAccount);
					$igweze_prep->bindValue(':accno', $accno);
					$igweze_prep->bindValue(':bank', $bank);
					$igweze_prep->bindValue(':descr', $desc); 
					
					if($igweze_prep->execute()){  /* if sucessfully */
						
						$msg_s = "<strong>$bankAccount</strong> acc was successfully saved"; 
						echo $succesMsg.$msg_s.$sEnd; 
						echo "<script type='text/javascript'> 
								$('#load-acc-category').load('bank-accounts-info.php'); 
								$('#frmsave-bankacc')[0].reset();  
								$('#modal-fobrain').modal('hide');
								hidePageLoader();  
							</script>"; exit;
						
					}else{  /* display error */
			
						$msg_e =  "Ooops, an error has occur while to add new bank account. Please try again";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
						
					}
					

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				} 
		
			}
		
		}elseif ($_REQUEST['query'] == 'update') {  /* update accs category */

			
			$bankAccount = clean($_REQUEST['acc']);
			$accno = clean($_REQUEST['accno']);
			$bank = clean($_REQUEST['bank']);
			$desc = clean($_REQUEST['desc']);
			$status = cleanInt($_REQUEST['status']);
			$bid = cleanInt($_REQUEST['fID']);			
			
			/* script validation */ 
			
			if ($bid == ""){
				
				$msg_e = "* Ooops, an error has occur to retrieve bank account. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
				
			}elseif ($bankAccount == "")  {
				
				$msg_e = "* Ooops Error, please enter new bank account name";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
				
			}elseif ($accno == "")  {
			
				$msg_e = "* Ooops Error, please bank account accno";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
			
			}elseif ($bank == "")  {
			
				$msg_e = "* Ooops Error, please enter bank name";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
			
			}elseif ($desc == "")  {
			
				$msg_e = "* Ooops Error, please enter school bank acc description";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
			
			}else {  /* update information */     			


				try {
					
					
					$ebele_mark = "UPDATE $bankAccountTB
									
									SET 
									
										acc = :acc, 
										accno = :accno,
										bank = :bank, 
										descr = :descr, 
										status = :status
										
										WHERE bid = :bid";
					
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':acc', $bankAccount);
					$igweze_prep->bindValue(':accno', $accno);
					$igweze_prep->bindValue(':bank', $bank);
					$igweze_prep->bindValue(':descr', $desc); 
					$igweze_prep->bindValue(':status', $status);
					$igweze_prep->bindValue(':bid', $bid); 
					
					if($igweze_prep->execute()){  /* if sucessfully */
						
						$msg_s = "<strong>$bankAccount</strong> was successfully saved"; 
						echo $succesMsg.$msg_s.$sEnd; 
						echo "<script type='text/javascript'> 
								$('#load-acc-category').load('bank-accounts-info.php');  
								//$('#edit-acc-category-div').slideUp(1500);
								$('#modal-fobrain').modal('hide');
								hidePageLoader(); 
							</script>";exit;
						
					}else{  /* display error */
			
						$msg_e =  "Ooops, an error has occur while to save bank account. Please try again";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
						
					}
					

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				} 
		
			}
		
		}elseif ($_REQUEST['query'] == 'remove') {  /* remove accs category */

			
			$query = $_REQUEST['rData'];
			
			list($fobrainIg, $bid, $hName) = explode("-", $query);			
			
			/* script validation */
			
			if (($query == "")  || ($bid == "")){
				
				$msg_e = "* Ooops, an error has occur while to remove bank account. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader();  </script>";exit;
				
			}else {   /* update information */    			

				try {
											
					$ebele_mark = "UPDATE $bankAccountTB
									
									SET 										
										status = :status
										
										WHERE bid = :bid";
					
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':status', $i_false);
					$igweze_prep->bindValue(':bid', $bid); 
					
					if($igweze_prep->execute()){  /* if sucessfully */
						
						//$removeDiv = "$('#row-".$bid."').fadeOut(1000);";
						$msg_s = "<strong>$hName</strong> was successfully Disenable"; 
						echo $succesMsg.$msg_s.$sEnd; 
						echo "<script type='text/javascript'>    
								$('#load-acc-category').load('acc-category-info.php');
								hidePageLoader();   
						</script>";exit;
						
					}else{  /* display error */
			
						$msg_e =  "Ooops, an error has occur while to remove bank account. Please try again";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'> hidePageLoader();  </script>";exit;
						
					}
					

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				}          		
		
			}
		
		}elseif ($_REQUEST['query'] == 'edit') {  /* edit accs category */

			
			$bid = strip_tags($_REQUEST['rData']);
			
			/* script validation */ 
			
			if ($bid == ""){
				
				$msg_e = "* Ooops, an error has occur while to retrieve bank account information. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
				
			}else {  /* select information */     			

				try { 
					
					$bankAccountInfoArr = bankAccountInfo($conn, $bid);  /* school bank account information */
					$bankAccount = $bankAccountInfoArr[$fiVal]['acc'];
					$accno = $bankAccountInfoArr[$fiVal]['accno'];
					$bank = $bankAccountInfoArr[$fiVal]['bank'];
					$desc = $bankAccountInfoArr[$fiVal]['descr'];
					$status = $bankAccountInfoArr[$fiVal]['status'];


$bankAccountFormTop =<<<IGWEZE
	
					<form class="form-horizontal mt-10" id="frmupdate-bankacc"> 
					<!-- row -->
					<div class="row gutters">
						<div class="col-12">										
							<!-- field wrapper start -->
							<div class="field-wrapper">
								<input type="text"  id="acc" name="acc"  class="form-control" value="$bankAccount" required style="text-transform:Capitalize;">
								<div class="field-placeholder">Account Name<span class="text-danger">*</span></div>													
							</div>
							<!-- field wrapper end -->
						</div>									 
					 
						<div class="col-12">										
							<!-- field wrapper start -->
							<div class="field-wrapper">
								<input type="text"  id="accno" name="accno" value="$accno" class="form-control" required>
								<div class="field-placeholder"> Account No. <span class="text-danger">*</span></div>													
							</div>
							<!-- field wrapper end -->
						</div>	

						<div class="col-12">										
							<!-- field wrapper start -->
							<div class="field-wrapper">
								<input type="text"  id="bank" value="$bank" name="bank" class="form-control" required>
								<div class="field-placeholder"> Bank Name <span class="text-danger">*</span></div>													
							</div>
							<!-- field wrapper end -->
						</div>	

						<div class="col-12">										
							<!-- field wrapper start -->
							<div class="field-wrapper">
								<textarea rows="4" cols="10" class="form-control" name="desc" id="desc" 
								placeholder="Bank Acc. Description">$desc</textarea> 

								<div class="field-placeholder"> Acc. Description <span class="text-danger">*</span></div>
									
							</div>
							<!-- field wrapper end -->
						</div>															 
					 
						<div class="col-12">										
							<!-- field wrapper start -->
							<div class="field-wrapper">			
								<select class="form-control"  name="status" required>
																
									<option value = "">Please select One</option> 

IGWEZE;

									echo $bankAccountFormTop;
											
									foreach($onOffArr as $status_key => $status_value){  /* loop array */

										if ($status == $status_key){
											$selected = "SELECTED";
										} else {
											$selected = "";
										}

										echo '<option value="'.$status_key.'"'.$selected.'>'.$status_value.'</option>' ."\r\n";

									}	     	

$bankAccountFormBot =<<<IGWEZE


								</select>

								<div class="field-placeholder"> Fee Amount <span class="text-danger">*</span></div>													
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
							<input type="hidden" name="query" value="update" />
							<input type="hidden" name="fID" value="$bid" />
							<button type="submit" class="btn btn-primary waves-effect   
							btn-label waves-light" id="update-bankacc">
								<i class="mdi mdi-content-save label-icon"></i>  Update
							</button>
						</div>
					</div>	
					<!-- /row -->		 
												
					</form>
					<!-- / form -->	 
						
	
IGWEZE;
							
					echo $bankAccountFormBot;														
							
					echo "<script type='text/javascript'>  hidePageLoader(); </script>"; exit; 						

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				} 
		
			}
		
		}elseif ($_REQUEST['query'] == 'fund') {  /* edit accs category */

?>
			
			<!-- form -->
			<form class="form-horizontal mt-10" id="frmsave-bankacc"> 

				<!-- row -->
				<div class="row gutters">	 
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">										
						<!-- field wrapper start -->
						<div class="field-wrapper fw-700 dotted-border p-2">
							Balance - <span id="balance_div" class="ms-10"></span>
						</div>
						<!-- field wrapper end -->
					</div>
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">  
						<!-- field wrapper start -->
						<div class="field-wrapper select-wrapper">		
															
							<select class="form-control fob-select"  id="bank_acc" name="bank_acc">

								<option value = "">Select account for sales</option>

								<?php 

								try {

									$bank_dataArr = bankAccountData($conn);  /* school expenses category array */
									$bank_dataCount = count($bank_dataArr);
									
								}catch(PDOException $e) {
								
										fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
								
								}		
							
								if($bank_dataCount >= $fiVal){	/* check array is empty */	 

									for($i = $fiVal; $i <= $bank_dataCount; $i++){	/* loop array */	
									
										$bid = $bank_dataArr[$i]["bid"];
										$acc = trim($bank_dataArr[$i]["acc"]);
										$bal = trim($bank_dataArr[$i]["balance"]);
										
										//$b_value = $bid.'#fob#'.$bal; 
										if ($bid == $accID){ 
											$selected = "SELECTED"; 
										} else { 
											$selected = ""; 
										}
										
										echo '<option value="'.$bid.'"'.$selected.'> '.$acc.'</option>' ."\r\n";

									}

								}else{
									
									echo '<option value="">Ooops Error, no bank account found.</option>' ."\r\n"; 
									
								}	

								?> 
							</select> 
							<div class="icon-wrap"  id="wait_bal" style="display: none;">
								<i class="loader"></i>
							</div> 
							<div class="field-placeholder"> Bank Account <span class="text-danger">*</span></div>													
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
							<input type="text"  id="amount" name="amount"  class="form-control"  required style="text-transform:Capitalize;">
							<div class="field-placeholder">Amount<span class="text-danger">*</span></div>													
						</div>
						<!-- field wrapper end -->
					</div> 
						
					<div class="col-12">										
						<!-- field wrapper start -->
						<div class="field-wrapper">
							<textarea rows="4" cols="10" class="form-control" name="desc" id="desc" 
							placeholder="Bank Acc. Description"></textarea> 
							<div class="field-placeholder"> Acc. Description <span class="text-danger">*</span></div>
								
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
						<input type="hidden" name="query" value="save" /> 
						<button type="submit" class="btn btn-primary waves-effect   
						btn-label waves-light" id="save-bankacc">
							<i class="mdi mdi-content-save label-icon"></i>  Save
						</button>
					</div>
				</div>	
				<!-- /row -->	 
												
			</form>
			<!-- / form -->		
			<script type='text/javascript'>  hidePageLoader(); </script>					

<?php 		
	}else{ 
	
		echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
	
	} 
	
exit;
?>