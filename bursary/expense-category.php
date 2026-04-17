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
	This script handle school expenses category
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

		define('fobrain', 'igweze');  /* define a check for wrong access of file */

		require 'fobrain-config.php';  /* load fobrain configuration files */
				
		if ($_REQUEST['expenseCat'] == 'save') {  /* save expenses category */

			
			$expenseCategory = clean($_REQUEST['expense']);				
			$regDate = strtotime(date("Y-m-d H:i:s"));
			
			/* script validation */ 
			
			if ($expenseCategory == "")  {
				
				$msg_e = "* Ooops Error, please enter new expense category name";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>   hidePageLoader();  </script>";exit;
				
			}else {  /* insert information */      	 		


				try {
					
					
					$ebele_mark = "INSERT INTO $expenseCategoryTB  (expense)

							VALUES (:expense)";
					
					$igweze_prep = $conn->prepare($ebele_mark);

					$igweze_prep->bindValue(':expense', $expenseCategory); 
					
					if($igweze_prep->execute()){  /* if sucessfully */ 
						
						$msg_s = "<strong>$expenseCategory</strong> expense was successfully saved"; 
						echo $succesMsg.$msg_s.$sEnd; 
						echo "<script type='text/javascript'> 
								$('#load-expense-category').load('expense-category-info.php'); 
								$('#frmsaveExpenseC')[0].reset(); 
								$('#modal-fobrain').modal('hide');
								hidePageLoader();   
							</script>"; exit;
						
					}else{  /* display error */ 
			
						$msg_e =  "Ooops, an error has occur while to add new expense category. Please try again";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'>   hidePageLoader();  </script>";exit;
						
					}
					

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				} 
		
			}
		
		}elseif ($_REQUEST['expenseCat'] == 'update') {  /* update expenses category */

			
			$expenseCategory = clean($_REQUEST['expense']);
			$eID = cleanInt($_REQUEST['eID']);		
			$status = cleanInt($_REQUEST['status']);	
			
			/* script validation */ 
			
			if ($eID == ""){
				
				$msg_e = "* Ooops, an error has occur while to save expense category information. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader();  </script>";exit;
				
			}elseif ($expenseCategory == "")  {
				
				$msg_e = "* Ooops Error, please enter new expense category name";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader();  </script>";exit;
				
			}else {  /* update information */       			


				try {
					
					
					$ebele_mark = "UPDATE $expenseCategoryTB
									
									SET 
									
										expense = :expense,
										status = :status
										
										WHERE e_id = :e_id";
					
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':expense', $expenseCategory);
					$igweze_prep->bindValue(':status', $status);
					$igweze_prep->bindValue(':e_id', $eID); 
					
					if($igweze_prep->execute()){  /* if sucessfully */
						
						$msg_s = "<strong>$expenseCategory</strong> was successfully saved"; 
						echo $succesMsg.$msg_s.$sEnd; 
						echo "<script type='text/javascript'> 
								$('#load-expense-category').load('expense-category-info.php'); 
								//$('#edit-expense-category-div').slideUp(1500);
								$('#modal-fobrain').modal('hide');
								hidePageLoader(); 
							</script>"; exit;
						
					}else{  /* display error */ 
			
						$msg_e =  "Ooops, an error has occur while to save expense category. Please try again";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'> hidePageLoader();  </script>";exit;
						
					}
					

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				} 
		
			}
		
		}elseif ($_REQUEST['expenseCat'] == 'remove') {  /* remove expenses category */

			
			$expenseCat = $_REQUEST['rData'];
			
			list($fobrainIg, $eID, $hName) = explode("-", $expenseCat);			
			
			/* script validation */ 
			
			if (($expenseCat == "")  || ($eID == "")){
				
				$msg_e = "* Ooops, an error has occur while to remove expense category. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}else {  /* update information */     			


				try {
					
					
					$ebele_mark = "UPDATE $expenseCategoryTB
									
									SET 										
										status = :status
										
										WHERE e_id = :e_id";
					
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':status', $i_false);
					$igweze_prep->bindValue(':e_id', $eID); 
					
					if($igweze_prep->execute()){  /* if sucessfully */
						
						//$removeDiv = "$('#row-".$eID."').fadeOut(1000);";
						$msg_s = "<strong>$hName</strong> was successfully Disenable"; 
						echo $succesMsg.$msg_s.$sEnd; 
						echo "<script type='text/javascript'>    
								$('#load-expense-category').load('expense-category-info.php'); 
								hidePageLoader();   
						</script>";exit; 
							
					}else{  /* display error */
			
						$msg_e =  "Ooops, an error has occur while to remove expense category. Please try again";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
						
					}
					

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				} 
			
		
			}
		
		}elseif ($_REQUEST['expenseCat'] == 'edit') {  /* edit expenses category */

			
			$eID = strip_tags($_REQUEST['rData']);
			
			/* script validation */
			
			if ($eID == ""){
				
				$msg_e = "* Ooops, an error has occur while to retrieve expense category information. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}else {  /* select information */       			


				try {
					
					
					$expenseCategoryInfoArr = expenseCategoryInfo($conn, $eID);  /* school expenses category information */
					$expenseCategory = $expenseCategoryInfoArr[$fiVal]['expense'];
					//$amount = $expenseCategoryInfoArr[$fiVal]['amount'];
					$status = $expenseCategoryInfoArr[$fiVal]['status'];


$expenseCategoryFormTop =<<<IGWEZE
	
					<form class="form-horizontal mt-10" id="frmupdateExpenseC"> 
					<!-- row -->
					<div class="row gutters">
						<div class="col-12">										
							<!-- field wrapper start -->
							<div class="field-wrapper">
								<input type="text"  id="expense" name="expense"  class="form-control"  value="$expenseCategory" required style="text-transform:Capitalize;">
								<div class="field-placeholder">Expense Category<span class="text-danger">*</span></div>													
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
								<select class="form-control"  name="status" required> 

IGWEZE;

									echo $expenseCategoryFormTop;
											
									foreach($onOffArr as $status_key => $status_value){  /* loop array */

										if ($status == $status_key){
											$selected = "SELECTED";
										} else {
											$selected = "";
										}

										echo '<option value="'.$status_key.'"'.$selected.'>'.$status_value.'</option>' ."\r\n";

									}	     	

$expenseCategoryFormBot =<<<IGWEZE


								</select>

								<div class="field-placeholder"> Category Status <span class="text-danger">*</span></div>													
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
							<input type="hidden" name="expenseCat" value="update" />
							<input type="hidden" name="eID" value="$eID" />
							<button type="submit" class="btn btn-primary waves-effect   
							btn-label waves-light demo-disenable" id="updateExpenseC">
								<i class="mdi mdi-content-save label-icon"></i>  Update
							</button>
						</div>
					</div>	
					<!-- /row -->						
					 									
					</form>
					<!-- / form -->	 
						
	
IGWEZE;
							
					echo $expenseCategoryFormBot;		
							
					echo "<script type='text/javascript'> hidePageLoader(); </script>"; exit;
						

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				} 
			
		
			}
		
		}elseif ($_REQUEST['expenseCat'] == 'add') {  /* add expenses category */
?>

			<!-- form -->
			<form class="form-horizontal mt-10" id="frmsaveExpenseC"> 
				<!-- row -->
				<div class="row gutters">
					<div class="col-12">										
						<!-- field wrapper start -->
						<div class="field-wrapper">
							<input type="text"  id="expense" name="expense"  class="form-control"  required style="text-transform:Capitalize;">
							<div class="field-placeholder">Expense Category<span class="text-danger">*</span></div>													
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
						<input type="hidden" name="expenseCat" value="save" />
						<button type="submit" class="btn btn-primary waves-effect   
						btn-label waves-light" id="saveExpenseC">
							<i class="mdi mdi-content-save label-icon"></i>  Save
						</button>
					</div>
				</div>	
				<!-- /row -->	 
				 								
			</form>
			<!-- / form -->	 

			<script type='text/javascript'> hidePageLoader(); </script>

<?php


		}else{ 
		
			echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
		
		}

		
exit;
?>