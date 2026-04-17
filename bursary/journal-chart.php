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


		if ($_REQUEST['query'] == 'save') {  
			  
			$title = clean($_REQUEST['title']); 
			$amount = clean($_REQUEST['amount']); 
			$journalArr = $_REQUEST['journals'];
			$jdate =  cleanDate($_REQUEST['jdate']);
			$jtime = strtotime(date("Y-m-d H:i:s"));  

			$transact = $transact_journal_entry_m;   
			$micro = str_replace(array('.',' '), array('',''), microtime());
			$transid = $micro.randomString($charset, 4);
			
			/* script validation */
			
			if ($title == "")  {
			
				$msg_e = "* Ooops Error, please enter journal title";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
			
			}elseif ($amount == "")  {
				
				$msg_e = "* Ooops Error, please enter journal amount";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($jdate == "")  {
			
				$msg_e = "* Ooops Error, please journal date";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
			
			}else {  /* update information */  

				if(is_array($journalArr)){ 

					$in = $grandtotal = 0; $sn = 1;  
				
					foreach ($journalArr as $input_row) { 
					
						$account = $journalArr[$in]['account']; 

						if($in == 0){ 

							$debit = $journalArr[$in]['debit'];
							$check_empty = $debit;
							$check_val = "debit";

						}else{ 
							
							$credit = $journalArr[$in]['credit'];
							$grandtotal = (intval($grandtotal) + intval($credit));
							$check_empty = $credit;
							$check_val = "credit";

						}  

						if ($account == "")  {
								
							$msg_e = "* Ooops Error, please select a journal account for table Serial No - $sn";
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'> hidePageLoader(); </script>"; exit;
							
						}elseif ($check_empty == "")  {
							
							$msg_e = "* Ooops Error, please the $check_val field is empty for table Serial No - $sn";
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'> hidePageLoader(); </script>"; exit;
							
						}else{

							//good
						} 

						$in++;  $sn++; $credit = ""; //$debit =

					} 

					if ($debit != $amount)  {
							
						$msg_e = "* Ooops Error, total debit not equal to amount entered";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'> hidePageLoader(); </script>"; exit;
						
					}elseif ($grandtotal != $amount)  {
							
						$msg_e = "* Ooops Error, total debit not equal to credit";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'> hidePageLoader(); </script>"; exit;
						
					}else{

						//good

					}
					

				}else{

					$msg_e = "* Ooops Error, could not fetch journal entries";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'> hidePageLoader(); </script>"; exit;

				} 

				try { 

					$conn->beginTransaction();   /* begin transaction */ 

					$in = 0;  

					foreach ($journalArr as $input_row) { 
					
						$account = $journalArr[$in]['account']; 

						if($in == 0){ 

							$debit = $journalArr[$in]['debit']; 

							$ebele_mark_chart_1 = "INSERT INTO $accountJournalTB  (transid, transact, account, credit, debit, descr, balance, jdate, jtime)

									VALUES (:transid, :transact, :account, :credit, :debit, :descr, :balance, :jdate, :jtime)";
							
							$igweze_prep_chart_1 = $conn->prepare($ebele_mark_chart_1);

							$igweze_prep_chart_1->bindValue(':transid', $transid);
							$igweze_prep_chart_1->bindValue(':transact', $transact);
							$igweze_prep_chart_1->bindValue(':account', $account);
							$igweze_prep_chart_1->bindValue(':credit', "");
							$igweze_prep_chart_1->bindValue(':debit', $debit); 
							$igweze_prep_chart_1->bindValue(':descr', $title); 
							$igweze_prep_chart_1->bindValue(':balance', $debit); 
							$igweze_prep_chart_1->bindValue(':jdate', $jdate);
							$igweze_prep_chart_1->bindValue(':jtime', $rtime); 
							$igweze_prep_chart_1->execute(); 

						}else{ 
							
							$credit = $journalArr[$in]['credit'];  

							$ebele_mark_chart_2 = "INSERT INTO $accountJournalTB  (transid, transact, account, credit, debit, descr, balance, jdate, jtime)

									VALUES (:transid, :transact, :account, :credit, :debit, :descr, :balance, :jdate, :jtime)";
							
							$igweze_prep_chart_2 = $conn->prepare($ebele_mark_chart_2);

							$igweze_prep_chart_2->bindValue(':transid', $transid);
							$igweze_prep_chart_2->bindValue(':transact', $transact);
							$igweze_prep_chart_2->bindValue(':account', $account);
							$igweze_prep_chart_2->bindValue(':credit', $credit);
							$igweze_prep_chart_2->bindValue(':debit', ""); 
							$igweze_prep_chart_2->bindValue(':descr', $title); 
							$igweze_prep_chart_2->bindValue(':balance', "-$credit"); 
							$igweze_prep_chart_2->bindValue(':jdate', $jdate);
							$igweze_prep_chart_2->bindValue(':jtime', $rtime); 
							$igweze_prep_chart_2->execute(); 

						}   

						$in++; $credit = $debit = ""; 

					}	 
				 
					if (($igweze_prep_chart_1 == true) && ($igweze_prep_chart_2 == true)){  /* if sucessfully */ 
						
						$conn->commit(); 

						$msg_s = "Journal Entry was successfully saved and posted."; 
						echo $succesMsg.$msg_s.$sEnd; 
						echo "<script type='text/javascript'>  
								var postVal = 'add';
								$('#modal-load-div').load('journal-chart.php', {'query': postVal});	
								$('#load-journal-div').load('journal-chart-info.php');
								//$('#frmsave-journal')[0].reset();
								//$('#modal-fobrain').modal('hide');
								hidePageLoader();  
							</script>";exit; 
						
					}else{  /* display error */
			
						$conn->rollBack(); 	  
						$msg_e =  "Ooops, an error has occur while to post Journal Entry. Please try again";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
						
					}	 
					

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				} 
		
			}
		
		}elseif ($_REQUEST['query'] == 'update') {  /* update accs category */ 

			$transid = clean($_REQUEST['transid']); 
			$journalArr = $_REQUEST['journals']; 
			
			/* script validation */
			
			if (($transid == "")){
			
				$msg_e = "* Ooops Error, could not fetch this journal information";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
			
			}else {  /* update information */     
				
				if(is_array($journalArr)){ 

					$in = $grandtotal = 0; $sn = 1;  
				 
					foreach ($journalArr as $input_row) { 
					
						$account = $journalArr[$in]['account'];
						$jid = $journalArr[$in]['jid']; 
						$transid = $journalArr[$in]['transid'];
						 

						if ($account == "")  {
								
							$msg_e = "* Ooops Error, please select a journal account for table Serial No - $sn";
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'> hidePageLoader(); </script>"; exit;
							
						}elseif (($jid == "") || ($transid == "")) {
							
							$msg_e = "* Ooops Error, could not fetct journal information for table Serial No - $sn";
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'> hidePageLoader(); </script>"; exit;
							
						}else{

							//good
						} 

						$in++;  $sn++; $credit = ""; //$debit =

					}   


				}else{

					$msg_e = "* Ooops Error, could not fetch journal entries";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'> hidePageLoader(); </script>"; exit;

				}


				try {
					
					$conn->beginTransaction();   /* begin transaction */

					$in2 = $clean_input = 0;
 
					foreach ($journalArr as $input_row) { 
				 
						$account_data = $journalArr[$in2]['account'];
						$jid = $journalArr[$in2]['jid'];
						$transid = $journalArr[$in2]['transid']; 

						list ($account, $acc_type, $st_type) = explode ("#fob#", $account_data);  

						$ebele_mark = "UPDATE $accountJournalTB
										
										SET 
										
										account = :account 
										
										WHERE jid = :jid
										
										AND transid = :transid"; 
						
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':account', $account); 
						$igweze_prep->bindValue(':transid', $transid);
						$igweze_prep->bindValue(':jid', $jid);  
						
						if($igweze_prep->execute()){

							$clean_input = 1;


						}else{
							
							$clean_input = 0;
							goto breakinsert;

						} 

						$account = $jid = $transid = $account_data = "";

						$in2++;

					} 
					
					breakinsert: 
				 
					if($clean_input == 1){  /* if sucessfully */
						
						$conn->commit();
						$msg_s = "Journal Entry was successfully saved and posted."; 
						echo $succesMsg.$msg_s.$sEnd; 
						echo "<script type='text/javascript'>  
								//$('#modal-fobrain').modal('hide');
								hidePageLoader(); 
							</script>";exit;
						
					}else{  /* display error */
			
						$conn->rollBack(); 
						$msg_e =  "Ooops, an error has occur while to save Journal Entry. Please try again";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
						
					}
					

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				} 
		
			}
		
		}elseif ($_REQUEST['query'] == 'remove') {  /* remove accs category */

			
			$query = $_REQUEST['rData'];
			
			list($fobrainIg, $jid, $hName) = explode("-", $query);			
			
			/* script validation */
			
			if (($query == "")  || ($jid == "")){
				
				$msg_e = "* Ooops, an error has occur while to remove bank account. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader();  </script>";exit;
				
			}else {   /* update information */    			

				try {
											
					$ebele_mark = "UPDATE $accountJournalTB
									
									SET 										
										status = :status
										
										WHERE jid = :jid";
					
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':status', $i_false);
					$igweze_prep->bindValue(':jid', $jid); 
					
					if($igweze_prep->execute()){  /* if sucessfully */
						
						//$removeDiv = "$('#row-".$jid."').fadeOut(1000);";
						$msg_s = "<strong>$hName</strong> was successfully Disenable"; 
						echo $succesMsg.$msg_s.$sEnd; 
						echo "<script type='text/javascript'>    
								$('#load-journal-div').load('journal-chart-info.php');
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
		
			$jid = strip_tags($_REQUEST['rData']); 
			
			/* script validation */ 
			
			if ($jid == ""){
				
				$msg_e = "* Ooops, an error has occur while to retrieve bank account information. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
				
			}else {  /* select information */   
		 
				try { 
					
					$accountJournalInfoArr = accountJournalInfo($conn, $jid);  /* school bank account information */
					 
					$jid2 = $accountJournalInfoArr[$fiVal]['jid']; 
					$tid = $accountJournalInfoArr[$fiVal]['transid']; 
					$transact = $accountJournalInfoArr[$fiVal]['transact'];
					$account = $accountJournalInfoArr[$fiVal]['account'];
					$credit = $accountJournalInfoArr[$fiVal]['credit'];
					$debit = $accountJournalInfoArr[$fiVal]['debit'];
					$descr = $accountJournalInfoArr[$fiVal]['descr'];
					$balance = $accountJournalInfoArr[$fiVal]['balance'];
					$jdate = $accountJournalInfoArr[$fiVal]['jdate'];
					$jtime = $accountJournalInfoArr[$fiVal]['jtime'];

					try {

						accountJournalTB($conn, $tid, $transact_journal_entry_m);  /* account Journal table */ 

					}catch(PDOException $e) {

						fobrainDie( 'Ooops Database Error: ' . $e->getMessage());

					}
							
					echo "<script type='text/javascript'>  hidePageLoader(); </script>"; exit; 


$accountJournalFormTop =<<<IGWEZE
	
					<form class="form-horizontal mt-10" id="frmupdate-journal"> 
					<!-- row -->
					<div class="row gutters">
						<div class="col-12">										
							<!-- field wrapper start -->
							<div class="field-wrapper">
								<input type="text"  id="acc" name="acc"  class="form-control" value="$accountJournal" required style="text-transform:Capitalize;">
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

									echo $accountJournalFormTop;
											
									foreach($onOffArr as $status_key => $status_value){  /* loop array */

										if ($status == $status_key){
											$selected = "SELECTED";
										} else {
											$selected = "";
										}

										echo '<option value="'.$status_key.'"'.$selected.'>'.$status_value.'</option>' ."\r\n";

									}	     	

$accountJournalFormBot =<<<IGWEZE


								</select>

								<div class="field-placeholder"> Status <span class="text-danger">*</span></div>													
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
							<input type="hidden" name="jid" value="$jid" />
							<button type="submit" class="btn btn-primary waves-effect   
							btn-label waves-light demo-disenable" id="update-journal">
								<i class="mdi mdi-content-save label-icon"></i>  Update
							</button>
						</div>
					</div>	
					<!-- /row -->		 
												
					</form>
					<!-- / form -->	 
						
	
IGWEZE;
							
					//echo $accountJournalFormBot;		
					
					try {

						accountJournalTB($conn, $tid, $transact_journal_entry_m);  /* account Journal table */ 

					}catch(PDOException $e) {

						fobrainDie( 'Ooops Database Error: ' . $e->getMessage());

					}
							
					echo "<script type='text/javascript'>  hidePageLoader(); </script>"; exit; 						

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				} 
		
			}
		
		}elseif ($_REQUEST['query'] == 'add') {  /* add entry */

			echo '<div class="row gutters my-10">
                <div class="col-12">';

				$page_title = '<i class="mdi mdi-cash-register fs-18"></i> 
							Double / Multible Journal Entries';
						pageTitle($page_title, 0);
                    
            echo    '</div>	
			</div>';

?>		 
				<!-- row -->
				<div class="row gutters">
					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">										
						<!-- field wrapper start -->
						<div class="field-wrapper">
							<input type="text" class="form-control chart-autofill-1"  data-code="journal-desc" 
							placeholder="Enter Title"  name="title"  id="title">
							<div class="field-placeholder">  Title <span class="text-danger">*</span></div>													
						</div>
						<!-- field wrapper end -->
					</div>									 

					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">										
						<!-- field wrapper start -->
						<div class="field-wrapper">
							<input type="date"  name="jdate" id="jdate" class="chart-autofill"  data-code="journal-date" />
							<div class="field-placeholder"> Payment Date: <span class="text-danger"></span></div>													
						</div>
						<!-- field wrapper end -->
					</div> 
					
					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">										
						<!-- field wrapper start -->
						<div class="field-wrapper">
							<input type="text" id="amount" name="amount" class="form-control chart-autofill-3 float-number"  data-code="journal-amount" required>
							<div class="field-placeholder"> Amount <span class="text-danger">*</span></div>													
						</div>
						<!-- field wrapper end -->
					</div>	 

				</div>	
				<!-- /row -->

				<?php  require ($bursaryDir.'journal-entry.php');  ?> 

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
						btn-label waves-light demo-disenable" onclick="saveJournal()">
							<i class="mdi mdi-content-save label-icon"></i>  Save
						</button>
					</div>
				</div>	
				<!-- /row -->	 
													
				 
				<script type='text/javascript'>  
				
					hidePageLoader(); 

					$('.float-number').keypress(function(event) {
						if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
							event.preventDefault();
						}
					});   
					
					
				</script>					
	
<?php 		
		}else{ 
		
			echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
		
		} 
		
exit;
?>