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
	This script handle school fees information
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

 
		define('fobrain', 'igweze');  /* define a check for wrong access of file */

		require 'fobrain-config.php';  /* load fobrain configuration files */
				
		if ($_REQUEST['payment'] == 'save') {  /* save fees */
			
			$feeCat = $_REQUEST['feeCat'];
			$schoolID = cleanInt($_REQUEST['schoolType']);
			$levelData =  $_REQUEST['class'];
			$regData = $_REQUEST['regData'];
			$term = cleanInt($_REQUEST['term']);
			$amountPaid = $_REQUEST['amountPaid'];
			$method = cleanInt($_REQUEST['method']);
			$payDetails = $_REQUEST['payDetails'];
			$waiver = clean($_REQUEST['waiver']);
			$efine = clean($_REQUEST['efine']);
			$total_fee = clean($_REQUEST['total_fee']);
			$fbalance = clean($_REQUEST['f_balance']);
			$account_1 =  $_REQUEST['chart_account1']; 
			$account_2 =  $_REQUEST['chart_account2'];
			$pDay = $_REQUEST['pDay'];	
			$querytp =  $_REQUEST['querytp'];
			//$pstatus = cleanInt($_REQUEST['pstatus']);	
			$pstatus = 2;			
			$rtime = date("Y-m-d H:i:s");
			$edate = $pDay;
			
			list($feeCID, $feeAmount, $cat_title) = explode("#fob#", $feeCat);				
			
			$feeAmountCur = fobrainCurrency($feeAmount, $curSymbol);  /* school currency information*/
			$amountPaidCur = fobrainCurrency($amountPaid, $curSymbol);  /* school currency information*/

			list ($account1, $acc_type1, $st_type1) = explode ("#fob#", $account_1);
			list ($account2, $acc_type2, $st_type2) = explode ("#fob#", $account_2);

			$transact = 1; $fee_account = 1;

			$title = "$cat_title - $feeAmountCur";
			
			/* script validation */
			
			if ($feeCat == "")  {

				$msg_e = "* Ooops Error, please select fee category";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($feeCID == "")  {

				$msg_e = "* Ooops Error, could not fetch category information";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($schoolID == "")  {

				$msg_e = "* Ooops Error, please select school";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($levelData == "")  {

				$msg_e = "* Ooops Error, please select student payment level";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($regData == "")  {

				$msg_e = "* Ooops Error, please select a student";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($term == "")  {

				$msg_e = "* Ooops Error, please select payment term";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($amountPaid == "")  {

				$msg_e = "* Ooops Error, please enter payment amount";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($amountPaid > $feeAmount)  {

				$msg_e = "* $amountPaid > $feeAmount Ooops Error, your payment amount  <strong>$amountPaidCur</strong> entered is greater than  fee amount <strong>$feeAmountCur</strong>";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($method == "")  {

				$msg_e = "* Ooops Error, please select a payment method";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($pDay == "")  {

				$msg_e = "* Ooops Error, please select a payment date";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($pstatus == "")  {

				$msg_e = "* Ooops Error, please select a payment status";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($account1 == "")  {
				
				$msg_e = "* Ooops Error, please select chart account 1";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($account2 == "")  {
				
				$msg_e = "* Ooops Error, please select chart account 2";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}else {   /* insert information */   						
			
				list($schoolID, $level) = explode("@$@", $levelData);
				list($regID, $regNo, $sessionID, $class) = explode("@::@", $regData);
				
				$feeAmount = trim($feeAmount);
				$payDetails = strip_tags($payDetails);
				$payDetails = str_replace('<br />', "\n", $payDetails);
				$payDetails = htmlspecialchars($payDetails); 
					
				if($fbalance >= 1){

					$pbal_status = $i_false;
					$balanceCur = fobrainCurrency($fbalance, $curSymbol);  /* school currency information*/
					$msgC = " Meanwhile, <strong>$regNo</strong> has a balance of <strong>$balanceCur</strong> to pay up.";

				}else{

					$pbal_status = $fiVal;
					$fbalance = ""; $msgC = "";
					
				} 

				$name = $_FILES['payupload']['name']; 

				if(strlen($name)) {
					
					$picturePath = $fobrainPaymentDir; /* picture path */
					
					$filePic = "payupload"; /* picture file name */
					$pageDesc = "Payment Proof Picture";
					
					/* call igweze file uploader */
					$uploadPicData = igwezeFileUploader($filePic, $picturePath, ($oneMB * 1), $validPicExt, $validPicType, $allowedPicExt, 
					$fileType = "Picture", $fiVal); 
						
					if (is_array($uploadPicData['error'])) {  /* check if any upload error */
							
						$msg_e = '';
							
						foreach ($uploadPicData['error'] as $msg) {
							$msg_e .= $msg.'<br />';     /* display error messages */
						}
						
						echo $errorMsg.$msg_e.$eEnd; exit;
						
						
					} else {
						
						$uploadedPic = $uploadPicData['refilename']; /* uploaded picture file */
						
						if ($uploadedPic != "") {
								
							if (move_uploaded_file($_FILES[$filePic]['tmp_name'], $picturePath.$uploadedPic )) { /* move uploaded file to its path */
									
									
								try { 

									
									$conn->beginTransaction();   /* begin transaction */

									$ebele_mark = "INSERT INTO $fobrainFeesTB  (acc, feeCat, feeAmount, session, reg_id, regNo, stype, level, class, term, method, 
													f_details, amount, balance, waiver, efine, date, f_status, pstatus, upload)

											VALUES (:acc, :feeCat, :feeAmount, :session, :reg_id, :regNo, :stype, :level, :class, :term, :method, 
																:f_details, :amount, :balance, :waiver, :efine, :date, :f_status, :pstatus, :upload)";
									
									$igweze_prep = $conn->prepare($ebele_mark);
									$igweze_prep->bindValue(':acc', $fee_account);
									$igweze_prep->bindValue(':feeCat', $feeCID);
									$igweze_prep->bindValue(':feeAmount', $feeAmount);
									$igweze_prep->bindValue(':session', $sessionID);
									$igweze_prep->bindValue(':reg_id', $regID);
									$igweze_prep->bindValue(':regNo', $regNo);
									$igweze_prep->bindValue(':stype', $schoolID);
									$igweze_prep->bindValue(':level', $level);
									$igweze_prep->bindValue(':class', $class);
									$igweze_prep->bindValue(':term', $term);
									$igweze_prep->bindValue(':method', $method);
									$igweze_prep->bindValue(':f_details', $payDetails);
									$igweze_prep->bindValue(':amount', $amountPaid);
									$igweze_prep->bindValue(':balance', $fbalance);
									$igweze_prep->bindValue(':waiver', $waiver);
									$igweze_prep->bindValue(':efine', $efine);
									$igweze_prep->bindValue(':date', $pDay);
									$igweze_prep->bindValue(':f_status', $pbal_status); 
									$igweze_prep->bindValue(':pstatus', $pstatus);
									$igweze_prep->bindValue(':upload', $uploadedPic);  
									$igweze_prep->execute();

									$transid = $conn->lastInsertId();  

									$ebele_mark_chart_1 = "INSERT INTO $accountJournalTB  (transid, transact, account, credit, debit, descr, balance, jdate, jtime)

											VALUES (:transid, :transact, :account, :credit, :debit, :descr, :balance, :jdate, :jtime)";
									
									$igweze_prep_chart_1 = $conn->prepare($ebele_mark_chart_1);

									$igweze_prep_chart_1->bindValue(':transid', $transid);
									$igweze_prep_chart_1->bindValue(':transact', $transact);
									$igweze_prep_chart_1->bindValue(':account', $account1);
									$igweze_prep_chart_1->bindValue(':credit', "");
									$igweze_prep_chart_1->bindValue(':debit', $amountPaid); 
									$igweze_prep_chart_1->bindValue(':descr', $title); 
									$igweze_prep_chart_1->bindValue(':balance', $amountPaid); 
									$igweze_prep_chart_1->bindValue(':jdate', $edate);
									$igweze_prep_chart_1->bindValue(':jtime', $rtime); 

									$igweze_prep_chart_1->execute(); 

									$ebele_mark_chart_2 = "INSERT INTO $accountJournalTB  (transid, transact, account, credit, debit, descr, balance, jdate, jtime)

											VALUES (:transid, :transact, :account, :credit, :debit, :descr, :balance, :jdate, :jtime)";
									
									$igweze_prep_chart_2 = $conn->prepare($ebele_mark_chart_2);

									$igweze_prep_chart_2->bindValue(':transid', $transid);
									$igweze_prep_chart_2->bindValue(':transact', $transact);
									$igweze_prep_chart_2->bindValue(':account', $account2);
									$igweze_prep_chart_2->bindValue(':credit', $amountPaid);
									$igweze_prep_chart_2->bindValue(':debit', ""); 
									$igweze_prep_chart_2->bindValue(':descr', $title); 
									$igweze_prep_chart_2->bindValue(':balance', "-$amountPaid"); 
									$igweze_prep_chart_2->bindValue(':jdate', $edate);
									$igweze_prep_chart_2->bindValue(':jtime', $rtime); 

									$igweze_prep_chart_2->execute();
									
									if (($igweze_prep == true)  
										&& ($igweze_prep_chart_1 == true) && ($igweze_prep_chart_2 == true)){  /* if sucessfully */

										$conn->commit(); 	
									
										$msg_s = "Journal Entry  & Payment details was successfully saved and posted. $msgC"; 
										echo $succesMsg.$msg_s.$sEnd; 

										if($querytp == 2){
											$load_url = "$('#modal-load-div').load('payment-manager.php', {'payment': postVal, 'querytp': 2});
														//$('#load-journal-div').load('journal-chart-info.php');";
										}else{
											$load_url = "$('#modal-load-div').load('payment-manager.php', {'payment': postVal});
															$('#load-payment-info').load('payment-info.php');  ";
										}

										echo "<script type='text/javascript'> 

												var postVal = 'add';
												$load_url
												//$('#modal-load-div').load('payment-manager.php', {'payment': postVal});	
												//$('#load-payment-info').load('payment-info.php'); 
												//$('#frmsaveFees')[0].reset();
												//$('#modal-fobrain').modal('hide');
												hidePageLoader();  
											</script>";exit;
										
									}else{  /* display error */ 

										$conn->rollBack(); 	 
									 
										$msg_e =  "Ooops, an error has occur while to post Journal Entry and save Payment details. Please try again";
										echo $errorMsg.$msg_e.$eEnd; 
										echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
										
									} 


								}catch(PDOException $e) {

									fobrainDie( 'Ooops Database Error: ' . $e->getMessage());

								}
									
									
							}else{ /* display error messages */

								$msg_e = "Ooops, an error has occur while trying to save $pageDesc. Please try again or check your network connection!!!";
								echo $errorMsg.$msg_e.$eEnd; exit; 
									
							}
								
						}else{ /* display error messages */

							$msg_e = "Ooops, an error has occur while trying to save $pageDesc. Please try again or check your network connection!!!";
							echo $errorMsg.$msg_e.$eEnd; exit;							

						}	
						
						
					} 

				}else{


					try {						
						
						$conn->beginTransaction();   /* begin transaction */

						$ebele_mark = "INSERT INTO $fobrainFeesTB  (acc, feeCat, feeAmount, session, reg_id, regNo, stype, level, class, term, method, 
													f_details, amount, balance, waiver, efine, date, f_status, pstatus)

								VALUES (:acc, :feeCat, :feeAmount, :session, :reg_id, :regNo, :stype, :level, :class, :term, :method, 
													:f_details, :amount, :balance, :waiver, :efine, :date, :f_status, :pstatus)";
						
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':acc', $fee_account);
						$igweze_prep->bindValue(':feeCat', $feeCID);
						$igweze_prep->bindValue(':feeAmount', $feeAmount);
						$igweze_prep->bindValue(':session', $sessionID);
						$igweze_prep->bindValue(':reg_id', $regID);
						$igweze_prep->bindValue(':regNo', $regNo);
						$igweze_prep->bindValue(':stype', $schoolID);
						$igweze_prep->bindValue(':level', $level);
						$igweze_prep->bindValue(':class', $class);
						$igweze_prep->bindValue(':term', $term);
						$igweze_prep->bindValue(':method', $method);
						$igweze_prep->bindValue(':f_details', $payDetails);
						$igweze_prep->bindValue(':amount', $amountPaid);
						$igweze_prep->bindValue(':balance', $fbalance);
						$igweze_prep->bindValue(':waiver', $waiver);
						$igweze_prep->bindValue(':efine', $efine);
						$igweze_prep->bindValue(':date', $pDay);
						$igweze_prep->bindValue(':f_status', $pbal_status); 
						$igweze_prep->bindValue(':pstatus', $pstatus); 
						$igweze_prep->execute();

						$transid = $conn->lastInsertId();  

						$ebele_mark_chart_1 = "INSERT INTO $accountJournalTB  (transid, transact, account, credit, debit, descr, balance, jdate, jtime)

								VALUES (:transid, :transact, :account, :credit, :debit, :descr, :balance, :jdate, :jtime)";
						
						$igweze_prep_chart_1 = $conn->prepare($ebele_mark_chart_1);

						$igweze_prep_chart_1->bindValue(':transid', $transid);
						$igweze_prep_chart_1->bindValue(':transact', $transact);
						$igweze_prep_chart_1->bindValue(':account', $account1);
						$igweze_prep_chart_1->bindValue(':credit', "");
						$igweze_prep_chart_1->bindValue(':debit', $amountPaid); 
						$igweze_prep_chart_1->bindValue(':descr', $title); 
						$igweze_prep_chart_1->bindValue(':balance', $amountPaid); 
						$igweze_prep_chart_1->bindValue(':jdate', $edate);
						$igweze_prep_chart_1->bindValue(':jtime', $rtime); 

						$igweze_prep_chart_1->execute(); 

						$ebele_mark_chart_2 = "INSERT INTO $accountJournalTB  (transid, transact, account, credit, debit, descr, balance, jdate, jtime)

								VALUES (:transid, :transact, :account, :credit, :debit, :descr, :balance, :jdate, :jtime)";
						
						$igweze_prep_chart_2 = $conn->prepare($ebele_mark_chart_2);

						$igweze_prep_chart_2->bindValue(':transid', $transid);
						$igweze_prep_chart_2->bindValue(':transact', $transact);
						$igweze_prep_chart_2->bindValue(':account', $account2);
						$igweze_prep_chart_2->bindValue(':credit', $amountPaid);
						$igweze_prep_chart_2->bindValue(':debit', ""); 
						$igweze_prep_chart_2->bindValue(':descr', $title); 
						$igweze_prep_chart_2->bindValue(':balance', "-$amountPaid"); 
						$igweze_prep_chart_2->bindValue(':jdate', $edate);
						$igweze_prep_chart_2->bindValue(':jtime', $rtime); 

						$igweze_prep_chart_2->execute();
						
						if (($igweze_prep == true)  
							&& ($igweze_prep_chart_1 == true) && ($igweze_prep_chart_2 == true)){  /* if sucessfully */

							$conn->commit(); 	
						
							$msg_s = "Journal Entry  & Payment details was successfully saved and posted. $msgC"; 
							echo $succesMsg.$msg_s.$sEnd; 

							if($querytp == 2){
								$load_url = "$('#modal-load-div').load('payment-manager.php', {'payment': postVal, 'querytp': 2});
											//$('#load-journal-div').load('journal-chart-info.php');";
							}else{
								$load_url = "$('#modal-load-div').load('payment-manager.php', {'payment': postVal});
												$('#load-payment-info').load('payment-info.php');  ";
							}

							echo "<script type='text/javascript'> 

									var postVal = 'add';
									$load_url
									//$('#modal-load-div').load('payment-manager.php', {'payment': postVal});	
									//$('#load-payment-info').load('payment-info.php'); 
									//$('#frmsaveFees')[0].reset();
									//$('#modal-fobrain').modal('hide');
									hidePageLoader();  
								</script>";exit;
							
						}else{  /* display error */ 

							$conn->rollBack(); 	 
							
							$msg_e =  "Ooops, an error has occur while to post Journal Entry and save Payment details. Please try again";
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
							
						}
						
					

					}catch(PDOException $e) {
						
						fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
				
					}    
					
				}	
		
			}
		
		}elseif ($_REQUEST['payment'] == 'update') {  /* update fees */
 
			$fID = clean($_REQUEST['fID']);			
			$feeCat = $_REQUEST['feeCat'];
			$levelData =  $_REQUEST['class'];
			$regData = $_REQUEST['regData'];
			$term = cleanInt($_REQUEST['term']);
			$amountPaid = $_REQUEST['amountPaid'];
			$method = cleanInt($_REQUEST['method']);
			$payDetails = $_REQUEST['payDetails'];
			$waiver = clean($_REQUEST['waiver']);
			$efine = clean($_REQUEST['efine']);
			$total_fee = clean($_REQUEST['total_fee']);
			$fbalance = clean($_REQUEST['f_balance']);
			$pDay = $_REQUEST['pDay'];		
			$pstatus = cleanInt($_REQUEST['pstatus']);
			$pstatus_o = clean($_REQUEST['pstatus_o']);		
			$old_upload =  clean($_REQUEST['oupload']); 
			
			list($feeCID, $feeAmount, $fee_account) = explode("-", $feeCat);				
			
			$feeAmountCur = fobrainCurrency($feeAmount, $curSymbol);  /* school currency information*/
			$amountPaidCur = fobrainCurrency($amountPaid, $curSymbol);  /* school currency information*/ 
			
			/* script validation */
			
			if ($fID == ""){

				$msg_e = "* Ooops, aan error has occur to retrieve payment information. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($pstatus_o == 2) {

				$msg_e = "* Ooops Error, this payment is already approved  by bursary and cannot be updated again. Use the App. Pay 2 to balance payment";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($feeCat == "")  {

				$msg_e = "* Ooops Error, please select fee category";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($fee_account == "")  {

				$msg_e = "* Ooops Error, please link this payment transaction to a School Account";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($levelData == "")  {

				$msg_e = "* Ooops Error, please select student payment level";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($term == "")  {

				$msg_e = "* Ooops Error, please select payment term";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($amountPaid == "")  {

				$msg_e = "* Ooops Error, please enter payment amount";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}
			/*elseif (($pstatus == 2)  && ($fbalance == 0.00)) {

				$msg_e = "* Ooops Error, this payment is already approved and cannot be updated again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}*/
			elseif ($amountPaid > $feeAmount)  {

				$msg_e = "* Ooops Error, your payment amount  <strong>$amountPaidCur</strong> entered is greater than  fee amount <strong>$feeAmountCur</strong> $feeCat";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($method == "")  {

				$msg_e = "* Ooops Error, please select a payment method";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($pDay == "")  {

				$msg_e = "* Ooops Error, please select a payment date";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($pstatus == "")  {

				$msg_e = "* Ooops Error, please select a payment status";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}else {	 /* update information */      			
							
				list($schoolID, $level) = explode("@$@", $levelData);
				
				$feeAmount = trim($feeAmount);
				$payDetails = strip_tags($payDetails);
				$payDetails = str_replace('<br />', "\n", $payDetails);
				$payDetails = htmlspecialchars($payDetails);
									
				if($fbalance >= 1){

					$pbal_status = $i_false;
					$balanceCur = fobrainCurrency($fbalance, $curSymbol);  /* school currency information*/
					$msgC = " Meanwhile, <strong>$regNo</strong> has a balance of <strong>$balanceCur</strong> to pay up.";

				}else{

					$pbal_status = $fiVal;
					$fbalance = ""; $msgC = "";
					
				}

				$name = $_FILES['payupload']['name']; 

				if(strlen($name)) {
					
					$picturePath = $fobrainPaymentDir; /* picture path */
					
					$filePic = "payupload"; /* picture file name */
					$pageDesc = "Payment Proof Picture";
					
					/* call igweze file uploader */
					$uploadPicData = igwezeFileUploader($filePic, $picturePath, ($oneMB * 1), $validPicExt, $validPicType, $allowedPicExt, 
					$fileType = "Picture", $fiVal); 
						
					if (is_array($uploadPicData['error'])) {  /* check if any upload error */
							
						$msg_e = '';
							
						foreach ($uploadPicData['error'] as $msg) {
							$msg_e .= $msg.'<br />';     /* display error messages */
						}
						
						echo $errorMsg.$msg_e.$eEnd; exit;
						
						
					} else {
						
						$uploadedPic = $uploadPicData['refilename']; /* uploaded picture file */
						
						if ($uploadedPic != "") {
								
							if (move_uploaded_file($_FILES[$filePic]['tmp_name'], $picturePath.$uploadedPic )) { /* move uploaded file to its path */
									
								if($old_upload != ""){ 
									removePicture($picturePath, $old_upload); 
								}	

								try { 

									
									$ebele_mark = "UPDATE $fobrainFeesTB  
														
														SET 
														
														feeCat = :feeCat, 
														feeAmount = :feeAmount, 
														level = :level, 
														term = :term, 
														method = :method, 
														f_details = :f_details, 
														amount = :amount, 
														balance = :balance, 
														waiver = :waiver,
														efine = :efine,
														date = :date, 
														f_status = :f_status,
														pstatus = :pstatus,
														upload = :upload
														
													WHERE fID = :fID";
									
									$igweze_prep = $conn->prepare($ebele_mark);
									$igweze_prep->bindValue(':fID', $fID);
									$igweze_prep->bindValue(':feeCat', $feeCID);
									$igweze_prep->bindValue(':feeAmount', $feeAmount);
									$igweze_prep->bindValue(':level', $level);
									$igweze_prep->bindValue(':term', $term);
									$igweze_prep->bindValue(':method', $method);
									$igweze_prep->bindValue(':f_details', $payDetails);
									$igweze_prep->bindValue(':amount', $amountPaid);
									$igweze_prep->bindValue(':balance', $fbalance);
									$igweze_prep->bindValue(':waiver', $waiver);
									$igweze_prep->bindValue(':efine', $efine);
									$igweze_prep->bindValue(':date', $pDay);
									$igweze_prep->bindValue(':f_status', $pbal_status); 
									$igweze_prep->bindValue(':pstatus', $pstatus);
									$igweze_prep->bindValue(':upload', $uploadedPic); 
									
									if($pstatus == $seVal){

										$conn->beginTransaction();   /* begin transaction */

										$return_query = balanceAccount($conn, $fee_account, $amountPaid, "credit", $allow_negative);

										if(($igweze_prep->execute())  
											&& ($return_query == 1)){  /* if sucessfully */

											$conn->commit(); 	
										
											$msg_s = "Payment was successfully saved.$msgC"; 
											echo $succesMsg.$msg_s.$sEnd; 
											echo "<script type='text/javascript'> 
													$('#load-payment-info').load('payment-info.php');
													$('#modal-fobrain').modal('hide');  
													hidePageLoader();  
												</script>";exit;
											
										}else{  /* display error */ 

											$conn->rollBack(); 		
											
											if($return_query == 2){
												$msg_e =  "Ooops, you have insufficient balance to perform this transaction";
											}elseif($return_query == 3){
												$msg_e =  "Ooops, select a debit or credit transaction to perform";
											}elseif($return_query == 4){
												$msg_e =  "Ooops, an error has occur while to save transaction 4. Please try again";
											}else{
												$msg_e =  "Ooops, an error has occur while to save transaction. Please try again";
											}
											
											echo $errorMsg.$msg_e.$eEnd; 
											echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
											
										}

									}else{ 

										if($igweze_prep->execute()){ /* insert picture name to database */

											$msg_s = "Payment was successfully saved.$msgC"; 
											echo $succesMsg.$msg_s.$sEnd; 
											echo "<script type='text/javascript'> 
													$('#load-payment-info').load('payment-info.php');
													$('#modal-fobrain').modal('hide');  
													hidePageLoader();  
												</script>";exit;
											
										}else{ /* display error messages */

											$msg_e =  "Ooops, an error has occur while to save payment. Please try again";
											echo $errorMsg.$msg_e.$eEnd; 
											echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
											
										}
									
									}  

								}catch(PDOException $e) {

									fobrainDie( 'Ooops Database Error: ' . $e->getMessage());

								} 
									
							}else{ /* display error messages */
								
								$msg_e = "Ooops, an error has occur while trying to save $pageDesc. Please try again or check your network connection!!!";
								echo $errorMsg.$msg_e.$eEnd; exit; 
									
							}
								
						}else{ /* display error messages */
							
							$msg_e = "Ooops, an error has occur while trying to save $pageDesc. Please try again or check your network connection!!!";
							echo $errorMsg.$msg_e.$eEnd; exit;							

						}	 
						
					} 

				}else{


					try { 
						
						$ebele_mark = "UPDATE $fobrainFeesTB  
											
											SET 
											
											feeCat = :feeCat, 
											feeAmount = :feeAmount, 
											level = :level, 
											term = :term, 
											method = :method, 
											f_details = :f_details, 
											amount = :amount, 
											balance = :balance, 
											waiver = :waiver,
											efine = :efine,
											date = :date, 
											f_status = :f_status,
											pstatus = :pstatus
											
										WHERE fID = :fID";
						
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':fID', $fID);
						$igweze_prep->bindValue(':feeCat', $feeCID);
						$igweze_prep->bindValue(':feeAmount', $feeAmount);
						$igweze_prep->bindValue(':level', $level);
						$igweze_prep->bindValue(':term', $term);
						$igweze_prep->bindValue(':method', $method);
						$igweze_prep->bindValue(':f_details', $payDetails);
						$igweze_prep->bindValue(':amount', $amountPaid);
						$igweze_prep->bindValue(':balance', $fbalance);
						$igweze_prep->bindValue(':waiver', $waiver);
						$igweze_prep->bindValue(':efine', $efine);
						$igweze_prep->bindValue(':date', $pDay);
						$igweze_prep->bindValue(':f_status', $pbal_status); 
						$igweze_prep->bindValue(':pstatus', $pstatus);

						if($pstatus == $seVal){

							$conn->beginTransaction();   /* begin transaction */

							$return_query = balanceAccount($conn, $fee_account, $amountPaid, "credit", $allow_negative);

							if(($igweze_prep->execute())  
								&& ($return_query == 1)){  /* if sucessfully */

								$conn->commit(); 	
							
								$msg_s = "Payment was successfully saved.$msgC"; 
								echo $succesMsg.$msg_s.$sEnd; 
								echo "<script type='text/javascript'> 
										$('#load-payment-info').load('payment-info.php');  
										$('#modal-fobrain').modal('hide');
										hidePageLoader();  
									</script>";exit;
								
							}else{  /* display error */ 

								$conn->rollBack(); 		
								
								if($return_query == 2){
									$msg_e =  "Ooops, you have insufficient balance to perform this transaction";
								}elseif($return_query == 3){
									$msg_e =  "Ooops, select a debit or credit transaction to perform";
								}elseif($return_query == 4){
									$msg_e =  "Ooops, an error has occur while to save transaction 4. Please try again";
								}else{
									$msg_e =  "Ooops, an error has occur while to save transaction. Please try again";
								}
								
								echo $errorMsg.$msg_e.$eEnd; 
								echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
								
							}

						}else{ 

							if($igweze_prep->execute()){ /* insert picture name to database */

								$msg_s = "Payment was successfully saved.$msgC"; 
								echo $succesMsg.$msg_s.$sEnd; 
								echo "<script type='text/javascript'> 
										$('#load-payment-info').load('payment-info.php');  
										$('#modal-fobrain').modal('hide');
										hidePageLoader();  
									</script>";exit;
								
							}else{ /* display error messages */

								$msg_e =  "Ooops, an error has occur while to save payment. Please try again";
								echo $errorMsg.$msg_e.$eEnd; 
								echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
								
							}
						
						} 
						  

					}catch(PDOException $e) {
			
						fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
				
					}  


				}	
		
			}
		
		}elseif ($_REQUEST['payment'] == 'ubalance') {  /* update fees */
  
			$fID = clean($_REQUEST['fID']);			
			//$feeCat = clean($_REQUEST['feeCat']);
			//$levelData =  $_REQUEST['class']; 
			//$term = cleanInt($_REQUEST['term']);
			//$amountPaid = $_REQUEST['amountPaid'];
			//$amountBal = $_REQUEST['amountBal'];
			
			$method = cleanInt($_REQUEST['method']);
			$fee_account = clean($_REQUEST['account']);
			$payDetails = $_REQUEST['payDetails'];
			$waiver = clean($_REQUEST['waiver']);
			$efine = clean($_REQUEST['efine']);
			$total_fee = clean($_REQUEST['total_fee']);
			$fbalance = clean($_REQUEST['f_balance']);
			$pDay = $_REQUEST['pDay'];		
			$pstatus = cleanInt($_REQUEST['pstatus']);	
			$old_upload =  clean($_REQUEST['oupload']);	
			$pstatus_o =  clean($_REQUEST['pstatus_o']);
			$pstatus_o2 =  clean($_REQUEST['pstatus_o2']); 
			
			//list($feeCID, $feeAmount, $fee_account) = explode("-", $feeCat);				
			
			$feeAmountCur = fobrainCurrency($feeAmount, $curSymbol);  /* school currency information*/
			$amountPaidCur = fobrainCurrency($amountPaid, $curSymbol);  /* school currency information*/ 
			
			/* script validation */
			
			if ($fID == ""){

				$msg_e = "* Ooops, aan error has occur to retrieve payment information. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($pstatus_o != 2) {

				$msg_e = "* Ooops Error, 1st payment not yet approved by bursary. Use the App. Pay 1 to approve or decline the payment";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($pstatus_o2 == 2) {

				$msg_e = "* Ooops Error, this 2nd payment is already approved by bursary and cannot be updated again.";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($fee_account == "")  {

				$msg_e = "* Ooops Error, please link this payment transaction to a School Account";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}
			/*
			elseif ($feeCat == "")  {

				$msg_e = "* Ooops Error, please select fee category";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			} elseif ($amountPaid == "")  {

				$msg_e = "* Ooops Error, please enter payment amount";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}*/
			elseif ($fbalance == "")  {

				$msg_e = "* Ooops Error, could not fetch payment balance";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}
			/*
			elseif ($amountPaid > $feeAmount)  {

				$msg_e = "* Ooops Error, your payment amount  <strong>$amountPaidCur</strong> entered is greater than  fee amount <strong>$feeAmountCur</strong> $feeCat";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}*/
			elseif ($method == "")  {

				$msg_e = "* Ooops Error, please select a payment method";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($pDay == "")  {

				$msg_e = "* Ooops Error, please select a payment date";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($pstatus == "")  {

				$msg_e = "* Ooops Error, please select a payment status";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}else {	 /* update information */      			
							
				//list($schoolID, $level) = explode("@$@", $levelData);
				
				//$feeAmount = trim($feeAmount);
				$payDetails = strip_tags($payDetails);
				$payDetails = str_replace('<br />', "\n", $payDetails);
				$payDetails = htmlspecialchars($payDetails); 

				$pbal_status = $fiVal; $msgC = ""; 

				$name = $_FILES['payupload']['name']; 

				if(strlen($name)) {
					
					$picturePath = $fobrainPaymentDir; /* picture path */
					
					$filePic = "payupload"; /* picture file name */
					$pageDesc = "Payment Proof Picture";
					
					/* call igweze file uploader */
					$uploadPicData = igwezeFileUploader($filePic, $picturePath, ($oneMB * 1), $validPicExt, $validPicType, $allowedPicExt, 
					$fileType = "Picture", $fiVal); 
						
					if (is_array($uploadPicData['error'])) {  /* check if any upload error */
							
						$msg_e = '';
							
						foreach ($uploadPicData['error'] as $msg) {
							$msg_e .= $msg.'<br />';     /* display error messages */
						}
						
						echo $errorMsg.$msg_e.$eEnd; exit; 
						
					} else {
						
						$uploadedPic = $uploadPicData['refilename']; /* uploaded picture file */
						
						if ($uploadedPic != "") {
								
							if (move_uploaded_file($_FILES[$filePic]['tmp_name'], $picturePath.$uploadedPic )) { /* move uploaded file to its path */
									
								if($old_upload != ""){ 
									removePicture($picturePath, $old_upload); 
								}	

								try {  
									
									$ebele_mark = "UPDATE $fobrainFeesTB  
														
														SET 
												
														method2 = :method2, 
														f_details = :f_details, 
														amount2 = :amount2, 
														balance = :balance, 
														waiver = :waiver,
														efine = :efine,
														date2 = :date2, 
														f_status = :f_status,
														pstatus2 = :pstatus2,
														n_pay = :n_pay,
														upload2 = :upload2
														
													WHERE fID = :fID";
									
									$igweze_prep = $conn->prepare($ebele_mark);
									$igweze_prep->bindValue(':fID', $fID);
									$igweze_prep->bindValue(':method2', $method);
									$igweze_prep->bindValue(':f_details', $payDetails);
									$igweze_prep->bindValue(':amount2', $fbalance);
									$igweze_prep->bindValue(':balance', "");
									$igweze_prep->bindValue(':waiver', $waiver);
									$igweze_prep->bindValue(':efine', $efine);
									$igweze_prep->bindValue(':date2', $pDay);
									$igweze_prep->bindValue(':f_status', $pbal_status); 
									$igweze_prep->bindValue(':pstatus2', $pstatus);
									$igweze_prep->bindValue(':n_pay', $seVal);
									$igweze_prep->bindValue(':upload2', $uploadedPic);  

									if($pstatus == $seVal){

										$conn->beginTransaction();   /* begin transaction */

										$return_query = balanceAccount($conn, $fee_account, $fbalance, "credit", $allow_negative);

										if(($igweze_prep->execute())  
											&& ($return_query == 1)){  /* if sucessfully */

											$conn->commit(); 	
										
											$msg_s = "Payment was successfully saved.$msgC"; 
											echo $succesMsg.$msg_s.$sEnd; 
											echo "<script type='text/javascript'> 
													$('#load-payment-info').load('payment-info.php');  
													$('#modal-fobrain').modal('hide');
													hidePageLoader();
												</script>";exit;
											
										}else{  /* display error */ 

											$conn->rollBack(); 		
											
											if($return_query == 2){
												$msg_e =  "Ooops, you have insufficient balance to perform this transaction";
											}elseif($return_query == 3){
												$msg_e =  "Ooops, select a debit or credit transaction to perform";
											}elseif($return_query == 4){
												$msg_e =  "Ooops, an error has occur while to save transaction 4. Please try again";
											}else{
												$msg_e =  "Ooops, an error has occur while to save transaction. Please try again";
											}
											
											echo $errorMsg.$msg_e.$eEnd; 
											echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
											
										}

									}else{  

										if($igweze_prep->execute()){ /* insert picture name to database */

											$msg_s = "Payment was successfully saved.$msgC"; 
											echo $succesMsg.$msg_s.$sEnd; 
											echo "<script type='text/javascript'> 
													$('#load-payment-info').load('payment-info.php');  
													$('#modal-fobrain').modal('hide');
													hidePageLoader();  
												</script>";exit;
											
										}else{ /* display error messages */
											
											$msg_e =  "Ooops, an error has occur while to save payment. Please try again";
											echo $errorMsg.$msg_e.$eEnd; 
											echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
											
										} 

									}

								}catch(PDOException $e) {

									fobrainDie( 'Ooops Database Error: ' . $e->getMessage());

								} 
									
							}else{ /* display error messages */
								
								$msg_e = "Ooops, an error has occur while trying to save $pageDesc. Please try again or check your network connection!!!";
								echo $errorMsg.$msg_e.$eEnd; exit; 
									
							}
								
						}else{ /* display error messages */
							
							$msg_e = "Ooops, an error has occur while trying to save $pageDesc. Please try again or check your network connection!!!";
							echo $errorMsg.$msg_e.$eEnd; exit;							

						}	 
						
					} 

				}else{ 

					try { 
						
						$ebele_mark = "UPDATE $fobrainFeesTB  
											
											SET 
										  
											method2 = :method2, 
											f_details = :f_details, 
											amount2 = :amount2, 
											balance = :balance, 
											waiver = :waiver,
											efine = :efine,
											date2 = :date2, 
											f_status = :f_status,
											pstatus2 = :pstatus2,
											n_pay = :n_pay
											
										WHERE fID = :fID";
						
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':fID', $fID);
						$igweze_prep->bindValue(':method2', $method);
						$igweze_prep->bindValue(':f_details', $payDetails);
						$igweze_prep->bindValue(':amount2', $fbalance);
						$igweze_prep->bindValue(':balance', "");
						$igweze_prep->bindValue(':waiver', $waiver);
						$igweze_prep->bindValue(':efine', $efine);
						$igweze_prep->bindValue(':date2', $pDay);
						$igweze_prep->bindValue(':f_status', $pbal_status); 
						$igweze_prep->bindValue(':pstatus2', $pstatus);
						$igweze_prep->bindValue(':n_pay', $seVal);
						
						if($pstatus == $seVal){

							$conn->beginTransaction();   /* begin transaction */

							$return_query = balanceAccount($conn, $fee_account, $fbalance, "credit", $allow_negative);

							if(($igweze_prep->execute())  
								&& ($return_query == 1)){  /* if sucessfully */

								$conn->commit(); 	
							
								$msg_s = "Payment was successfully saved.$msgC"; 
								echo $succesMsg.$msg_s.$sEnd; 
								echo "<script type='text/javascript'> 
										$('#load-payment-info').load('payment-info.php');  
										$('#modal-fobrain').modal('hide');
										hidePageLoader();
									</script>";exit;
								
							}else{  /* display error */ 

								$conn->rollBack(); 		
								
								if($return_query == 2){
									$msg_e =  "Ooops, you have insufficient balance to perform this transaction";
								}elseif($return_query == 3){
									$msg_e =  "Ooops, select a debit or credit transaction to perform";
								}elseif($return_query == 4){
									$msg_e =  "Ooops, an error has occur while to save transaction 4. Please try again";
								}else{
									$msg_e =  "Ooops, an error has occur while to save transaction. Please try again";
								}
								
								echo $errorMsg.$msg_e.$eEnd; 
								echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
								
							}

						}else{  

							if($igweze_prep->execute()){  /* if sucessfully */ 
								
								$msg_s = "Payment was successfully saveda.$msgC"; 
								echo $succesMsg.$msg_s.$sEnd; 
								echo "<script type='text/javascript'> 
										$('#load-payment-info').load('payment-info.php');
										$('#modal-fobrain').modal('hide');
										hidePageLoader();   
									</script>";exit;
								
							}else{  /* display error */
								
								$msg_e =  "Ooops, an error has occur while to save payment. Please try again";
								echo $errorMsg.$msg_e.$eEnd; 
								echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
								
							}
							
						}

					}catch(PDOException $e) {
			
						fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
				
					}   

				}	
		
			}
		
		}elseif ($_REQUEST['payment'] == 'appr-decline') {  /* remove fees */

			$payment = $_REQUEST['rData'];				
			list($fID, $regNum, $confirm) = explode("@@", $payment);			
			
			/* script validation */ 
			
			if (($payment == "")  || ($fID == "") || ($confirm == "")){
				
				$msg_e = "* Ooops $payment, an error has occur while to approve/decline fee payment. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}else {  /* remove information */   

				$confirm_pay = wizSelectArray($confirm, $confirm_pay_arr); 

				try { 
					
					$ebele_mark = "UPDATE $fobrainFeesTB  
										
										SET  
										 
										f_status = :f_status,
										pstatus = :pstatus
										
									WHERE fID = :fID";
					
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':fID', $fID); 
					$igweze_prep->bindValue(':f_status', $fiVal); 
					$igweze_prep->bindValue(':pstatus', $confirm);
					$igweze_prep->bindValue(':fID', $fID); 
					
					if($igweze_prep->execute()){  /* if sucessfully */ 
						 
						$msg_s = "Payment was successfully $confirm_pay"; 
						echo $succesMsg.$msg_s.$sEnd; 
						echo "<script type='text/javascript'>  
								hidePageLoader(); 
							</script>";exit;
						
					}else{  /* display error */
			
						$msg_e =  "Ooops, an error has occur while to $confirm_pay fee payment. Please try again";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
						
					}
					

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				} 
		
			}
		
		}elseif ($_REQUEST['payment'] == 'remove') {  /* remove fees */

			$payment = $_REQUEST['rData'];				
			$adminPass =   clean($_REQUEST['adminPass']);  

			$checkDetail =  staffLoginData($conn, $_SESSION['adminUser']);  /* school staffs/teachers password details */ 			 
			list ($tID, $staffUser, $checkedPass, $staffName, $staff_fobrain_grdQ, $userGrade, $userAccess) = 
			explode ("@(.$*S*$.)@", $checkDetail);

			list($fobrainIg, $fID, $hName) = explode("-", $payment);			
			
			/* script validation */ 
			
			if (($payment == "")  || ($fID == "")){
				
				$msg_e = "* Ooops, an error has occur while to remove fee payment. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif(!password_verify($adminPass, $userAccess)){ 		 
		 
				$msg_e = "* Ooops error, your admin authorization password is invalid.";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;

			}else {  /* remove information */   

				try { 
					
					$ebele_mark = "DELETE FROM 
					
									$fobrainFeesTB										
										
									WHERE fID = :fID
										
									LIMIT 1";
					
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':fID', $fID); 
					
					if($igweze_prep->execute()){  /* if sucessfully */
						
						$removeDiv = "$('#row-".$fID."').fadeOut(1000);";
						$msg_s = "<strong>$hName</strong> was successfully removed"; 
						echo $succesMsg.$msg_s.$sEnd; 
						echo "<script type='text/javascript'>   
								$removeDiv 
								hidePageLoader(); 
							</script>";exit;
						
					}else{  /* display error */
			
						$msg_e =  "Ooops, an error has occur while to remove fee payment. Please try again";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
						
					}
					

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				} 
		
			}
		
		}elseif ($_REQUEST['payment'] == 'view') {  /* view fees */
			
			$fID = strip_tags($_REQUEST['rData']);
			
			/* script validation */ 
			
			if ($fID == ""){
				
				$msg_e = "* Ooops, an error has occur while to retrieve payment information. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}else {  /* select information */  

				try { 
					
					$feesInfoArr = feesInfo($conn, $fID);  /* school fee array information */
					$feeID = $feesInfoArr[$fiVal]["fID"];
					$feeCat = $feesInfoArr[$fiVal]["feeCat"];
					$sessionID = $feesInfoArr[$fiVal]["session"];
					$regID = $feesInfoArr[$fiVal]["reg_id"];
					$regNum = $feesInfoArr[$fiVal]["regNo"];
					$schoolID = $feesInfoArr[$fiVal]["stype"];
					$level = $feesInfoArr[$fiVal]["level"];
					$class = $feesInfoArr[$fiVal]["class"];
					$term = $feesInfoArr[$fiVal]["term"];
					$method = $feesInfoArr[$fiVal]["method"];
					$fDetail = htmlspecialchars_decode($feesInfoArr[$fiVal]["f_details"]);
					$amount = $feesInfoArr[$fiVal]["amount"];
					$balance = $feesInfoArr[$fiVal]["balance"];
					$waiver = $feesInfoArr[$fiVal]["waiver"];
					$efine = $feesInfoArr[$fiVal]["efine"];
					$date = $feesInfoArr[$fiVal]["date"];
					$fStatus = $feesInfoArr[$fiVal]["f_status"];
					$pstatus = $feesInfoArr[$fiVal]["pstatus"];
					$upload = $feesInfoArr[$fiVal]["upload"]; 

					$upload2 = $feesInfoArr[$fiVal]["upload2"];
					$amount2 = $feesInfoArr[$fiVal]["amount2"];
					$date2 = $feesInfoArr[$fiVal]["date2"];
					$method2 = $feesInfoArr[$fiVal]["method2"];
					$pstatus2 = $feesInfoArr[$fiVal]["pstatus2"];
					$n_pay = $feesInfoArr[$fiVal]["n_pay"];
							
					$feeCategoryInfoArr = feeCategoryInfo($conn, $feeCat);  /* school fee category information */
					$feeCategory = $feeCategoryInfoArr[$fiVal]['fee'];  
					
					$sTerm = wizSelectArray($term, $termIntList);
					$school = wizSelectArray($schoolID, $school_list);
					$payMethod = wizSelectArray($method, $paymentMethodArr);
					$payStatus = wizSelectArray($fStatus, $paymentStatus);
					$confirmStatus = wizSelectArray($pstatus, $confirm_pay_arr);
					$confirmStatus2 = wizSelectArray($pstatus2, $confirm_pay_arr);
					
					$date = date("j F Y", strtotime($date));
					$fDetail = nl2br($fDetail);
					
					$amount = fobrainCurrency($amount, $curSymbol);  /* school currency information*/
					$balance = fobrainCurrency($balance, $curSymbol);  /* school currency information*/
					$waiver = fobrainCurrency($waiver, $curSymbol);  /* school currency information*/
					$efine = fobrainCurrency($efine, $curSymbol);  /* school currency information*/
					
					require $fobrainSchoolTBS; /* include student database table information  */					
		
					$regNum = studentReg($conn, $regID);  /* student registration number  */						
					$student_name = studentName($conn, $regNum);  /* student name  */		
					$student_img = studentPicture($conn, $regNum);  /* student picture */
					
					$levelArray = studentLevelsArray($conn);  /* student level array */ 
					$studentLevel = $levelArray[$level]['level'];

					$pay_upload = $fobrainPaymentDir.$upload; 
						
					if(($upload != "") && (file_exists($pay_upload))){  /* check if picture exits */ 

						$showQPicture ='
						<tr>
							<th colspan="2" class="text-center">								
								Payment Proof 
							</th> 
						</tr>
						<tr>
							<td colspan="2" class="text-center">								
								<img src = "'.$pay_upload.'"  class="img-fluid-flex" style="height:450px !important";> 
							</td> 
						</tr>';  
 
					}else{
						$showQPicture = "";
					}
					
					if($n_pay == $seVal){

						$amount2 = fobrainCurrency($amount2, $curSymbol);  /* school currency information*/
						$date2 = date("j F Y", strtotime($date2));
						$payMethod2 = wizSelectArray($method2, $paymentMethodArr);

						$pay_upload2 = $fobrainPaymentDir.$upload2; 
							
						if(($upload2 != "") && (file_exists($pay_upload2))){  /* check if picture exits */ 

							$showQPicture2 ='
							<tr>
								<th colspan="2" class="text-center">								
									Payment Proof 
								</th> 
							</tr>
							<tr>
								<td colspan="2" class="text-center">								
									<img src = "'.$pay_upload2.'"  class="img-fluid-flex" style="height:450px !important"; > 
								</td> 
							</tr>';  
	
						}else{
							$showQPicture2 = "";
						}

						$payment_se ='
							<tr>
								<th colspan="2" class="text-center">								
									2nd Payment Details
								</th> 
							</tr> 
							<tr>
								<th>
									Amount Paid 
								</th> 
								<td>
									'.$amount2.'
								</td> 
							</tr>
							<tr>
								<th>
									Payment Method 
								</th> 
								<td>
									'.$payMethod.'
								</td> 
							</tr>
							<tr>
								<th>
									Date
								</th> 
								<td>
									'.$date2.'
								</td> 
							</tr>
							<tr>
								<th>
									2nd Payment Status 
								</td> 
								<td>
									'.$confirmStatus2.'
								</td> 
							</tr>
							'.$showQPicture2;   

						$payment_fi ='
							<tr>
								<th colspan="2" class="text-center">								
									1st Payment Details
								</th> 
							</tr>';	
						
					}else{ $payment_fi = ""; $payment_se = ""; }
								

$showPayment =<<<IGWEZE
	

			<!-- row --> 
			<div class="row gutters justify-content-center"> 
				<div class="col-lg-6 col-md-6 col-sm-12 col-12"> 

					<div class="row gutters mb-10">
						<div class="text-end">
							<button  class="btn btn-primary" onclick="printDiv('fobrain-print-ovly')">
								<i class="fas fa-print"></i> 
							</button>
							<div class="col-12 text-center">
								<h3 class="font-head-1 text-primary fw-500"> Payment Information</h3>	
							</div>	
						</div>	
					</div>  
 
					<div id = 'fobrain-print-ovly'> 						
						 
						<div class="profile-wrapper">		
							<div class="picture">
								<img src="$student_img" alt="Profile Picture">
							</div>

							<div class="info">
								<h2 class="main-title">$student_name</h2>
								<span class="sub-title">($regNum)</span>
							</div>  

							<!-- table -->
							<table class="table view-table table-responsive"> 
 
							<tr>
								<th>
									Fee Paid 
								</th> 
								<td>
									$feeCategory
								</td> 
							</tr>
							<tr>
								<th>
									School
								</th> 
								<td>
									$school
								</td> 
							</tr>
							<tr>
								<th>
									Class 
								</th> 
								<td>
									$studentLevel $class 
								</td> 
							</tr>
							<tr>
								<th>
									Term 
								</th> 
								<td>
									$sTerm
								</td> 
							</tr>

							<tr>
								<th>
									Waiver
								</th> 
								<td>
									$waiver
								</td> 
							</tr>

							<tr>
								<th>
									Fine
								</th> 
								<td>
									$efine
								</td> 
							</tr>
							$payment_fi
							<tr>
								<th>
									Amount Paid
								</th> 
								<td>
									$amount
								</td> 
							</tr>
							
							<tr>
								<th>
									Payment Method 
								</th> 
								<td>
									$payMethod
								</td> 
							</tr>
							<!--
							<tr>
								<th>
									Payment Details 
								</th> 
								<td>
									$fDetail
								</td> 
							</tr>
							-->
							<tr>
								<th>
									Payment Date </td> 
								<td>
									$date
								</td> 
							</tr>

							$showQPicture

							<tr>
								<th>
									1st Payment Status 
								</td> 
								<td>
									$confirmStatus
								</td> 
							</tr> 

							

							<tr>
								<th>
									Balance 
								</th> 
								<td>
									$balance
								</td> 
							</tr>

							$payment_se
							
							<tr>
								<th>
									Payment Status
								</td> 
								<td>
									$payStatus
								</td> 
							</tr>

							

						</table> 
						<!-- / table --> 
						</div>
					</div>

				</div>	
			</div>
			<!-- /row --> 	

IGWEZE;
			
					echo $showPayment; 

					try {

						accountJournalTB($conn, $fID, 1);  /* account Journal table */ 

					}catch(PDOException $e) {

						fobrainDie( 'Ooops Database Error: ' . $e->getMessage());

					}
					
					echo "<script type='text/javascript'> hidePageLoader(); </script>"; exit; 

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				} 
		
			}
		
		}elseif ($_REQUEST['payment'] == 'edit') {  /* edit fees */
			
			$fID = strip_tags($_REQUEST['rData']);
			
			/* script validation */ 
			
			if ($fID == ""){
				
				$msg_e = "* Ooops, an error has occur while to retrieve payment information. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}else {    

				try { 
					
					$feesInfoArr = feesInfo($conn, $fID);
					$feeID = $feesInfoArr[$fiVal]["fID"];
					$feeCat = $feesInfoArr[$fiVal]["feeCat"];
					$feeAmount = $feesInfoArr[$fiVal]["feeAmount"];
					$sessionID = $feesInfoArr[$fiVal]["session"];
					$regID = $feesInfoArr[$fiVal]["reg_id"];
					$regNum = $feesInfoArr[$fiVal]["regNo"];
					$schoolID = $feesInfoArr[$fiVal]["stype"];
					$level = $feesInfoArr[$fiVal]["level"];
					$class = $feesInfoArr[$fiVal]["class"];
					$term = $feesInfoArr[$fiVal]["term"];
					$method = $feesInfoArr[$fiVal]["method"];
					$fDetail = htmlspecialchars_decode($feesInfoArr[$fiVal]["f_details"]);
					$amount_db = $feesInfoArr[$fiVal]["amount"];
					$balance = $feesInfoArr[$fiVal]["balance"];
					$waiver = $feesInfoArr[$fiVal]["waiver"];
					$efine = $feesInfoArr[$fiVal]["efine"];
					$date = $feesInfoArr[$fiVal]["date"];
					$fStatus = $feesInfoArr[$fiVal]["f_status"];
					$pstatus = $feesInfoArr[$fiVal]["pstatus"];
					$upload = $feesInfoArr[$fiVal]["upload"];

					$upload2 = $feesInfoArr[$fiVal]["upload2"];
					$amount2 = $feesInfoArr[$fiVal]["amount2"];
					$date2 = $feesInfoArr[$fiVal]["date2"];
					$method2 = $feesInfoArr[$fiVal]["method2"];
					$n_pay = $feesInfoArr[$fiVal]["n_pay"];

					$pay_upload = picture($fobrainPaymentDir, $upload, "doc"); 

					if($n_pay == $seVal){

						$amount2 = fobrainCurrency($amount2, $curSymbol);  /* school currency information*/
						$date2 = date("j F Y", strtotime($date2));
						$payMethod2 = wizSelectArray($method2, $paymentMethodArr);

						$pay_upload2 = $fobrainPaymentDir.$upload2; 
							
						if(($upload2 != "") && (file_exists($pay_upload2))){  /* check if picture exits */ 

							$showQPicture2 ='
							<tr>
								<th colspan="2" class="text-center">								
									Payment Proof 
								</th> 
							</tr>
							<tr>
								<td colspan="2" class="text-center">								
									<img src = "'.$pay_upload2.'"  class="img-fluid-flex" style="height:450px !important";> 
								</td> 
							</tr>';  
	
						}else{
							$showQPicture2 = "";
						}

						$payment_se ='
						<!-- table -->
						<table  class="table table-view table-hover">
							<tr>
								<th colspan="2" class="text-center">								
									2nd Payment Details
								</th> 
							</tr> 
							<tr>
								<th>
									Amount Paid 
								</th> 
								<td>
									'.$amount2.'
								</td> 
							</tr>
							<tr>
								<th>
									Payment Method 
								</th> 
								<td>
									'.$payMethod.'
								</td> 
							</tr>
							<tr>
								<th>
									Date
								</th> 
								<td>
									'.$date2.'
								</td> 
							</tr>
							'.$showQPicture2.
							'
							</table>
							<div class="row gutters mb-20"> 
								<div class="col-6 text-start">						
									<a href="javascript:;" id="'.$feeID.'@@'.$regNum.'@@2" class ="appr-decline-fee btn btn-success">									
										<i class="mdi mdi-account-check label-icon"></i> Approve
									</a>
								</div>
								<div class="col-6 text-end">						
									<a href="javascript:;" id="'.$feeID.'@@'.$regNum.'@@3" class ="appr-decline-fee btn btn-danger">									
										<i class="mdi mdi-account-remove-outline label-icon"></i> Decline
									</a>
								</div>
							</div>';   
				 
						
					}else{  $payment_se = ""; }

					echo $payment_se;
					
?>					
					<!-- form -->						
					<form class="form-horizontal" id="frmupdatePayment" role="form" 
					enctype="multipart/form-data"> 							
						<!-- row -->
						<div class="row gutters"> 
							<div class="col-12">										
								<!-- field wrapper start -->
								<div class="field-wrapper">
									<select class="form-control fob-select" id="feeCat" name="feeCat" required>

										<option value = "">Search . . . >>>></option>

										<?php


											try {

												$feeCategoryDataArr = feeCategoryData($conn);  /* school fee category array */
												$feeCategoryDataCount = count($feeCategoryDataArr);

											}catch(PDOException $e) {

												fobrainDie( 'Ooops Database Error: ' . $e->getMessage());

											}		

											if($feeCategoryDataCount >= $fiVal){  /* check array is empty */ 

												for($i = $fiVal; $i <= $feeCategoryDataCount; $i++){  /* loop array */	

													$fID = $feeCategoryDataArr[$i]["f_id"];
													$feeCategory = $feeCategoryDataArr[$i]["fee"];
													$amount = $feeCategoryDataArr[$i]["amount"];
													$status = $feeCategoryDataArr[$i]["status"];
													$fee_account = $feeCategoryDataArr[$i]["account"];

													$feeCategory = trim($feeCategory);
													$amount = trim($amount);
													$status = trim($status);

													$amountS = fobrainCurrency($amount, $curSymbol);  /* school currency information*/ 

													if ( $fID == $feeCat){
														$selected = "SELECTED";
													} else {
														$selected = "";
													}

													echo '<option value="'.$fID.'-'.$amount.'-'.$fee_account.'"'.$selected.'>
													'.$feeCategory.' - '.$amountS.'</option>' ."\r\n";

												}
												
											}else{

												echo '<option value="">Ooops Error, could find fee category.</option>' ."\r\n"; 

											}	 

										?>

									</select>
									<div class="field-placeholder"> Fee Category <span class="text-danger"></span></div>													
								</div>
								<!-- field wrapper end -->
							</div>																 
						</div>	
						<!-- /row -->
						<?php 

								

							echo '
							<!-- row -->
							<div class="row gutters  justify-content-center">
								<div class="col-12 text-center my-10  bb-1 px-5-per"> 
									<h4 class="text-info">Payment Summary</h4>  
								</div>  
									
								<div class="col-xl-10 col-lg-10 col-md-10 col-12 text-left my-10 bb-1"> 
									<div class="row gutters"> 
										<div class="col-6 px-5-per py-10 fw-600 text-info bb-1">Fee Waiver</div>
										<div class="col-6 px-5-per py-10 fw-600 text-info bb-1">
											<span class="text-success">'.$curSymbol.'</span>
											<span class="text-success" id="waiver_des">'.$waiver.'</span> 
										</div>
										<div class="col-6 px-5-per py-10 fw-600 text-info bb-1">Fee Fine</div>
										<div class="col-6 px-5-per py-10 fw-600 text-info bb-1">
											<span class="text-danger">'.$curSymbol.'</span>
											<span class="text-danger" id="efine_des">'.$efine.'</span>
										</div>
										
										<div class="col-6 px-5-per py-10 fw-600 text-info bb-1">Net Total</div>
										<div class="col-6 px-5-per py-10 fw-600 text-info bb-1">
											<span class="text-success">'.$curSymbol.'</span>
											<span class="text-success" id="total_fee_dis"></span>
										</div> 

										<div class="col-6 px-5-per py-10 fw-600 text-info bb-1">Fee Balance</div>
										<div class="col-6 px-5-per py-10 fw-600 text-info bb-1">
											<span class="text-info">'.$curSymbol.'</span>
											<span class="text-info" id="balance_des"></span>
										</div>
									</div>
								</div>
							</div>	

							<div class="wiz-loader-2 display-none wiz-glower">
								<ul>
									<li></li>
									<li></li>
									<li></li>
									<li></li>
									<li></li>
									<li></li>
									<li></li>
								</ul>
							</div>

							<input type="hidden" class="form-control" placeholder="" name="total_fee"  id="total_fee"
									value = "'.$amount_db.'">
							<input type="hidden" class="form-control" placeholder="" name="f_balance"  id="fbalance"
									value = "'.$balance.'">';  
						?>

						<!-- row -->
						<div class="row gutters">
							<div class="col-12">										
								<!-- field wrapper start -->
								<div class="field-wrapper">
									<select class="form-control fob-select" id="cLevel" name="class" required>

										<option value = "">Search . . . >>>></option>
										<?php 

											if($schoolID >= $fiVal){  
			
												$supRegNo = $schoolRegSuffArr[$schoolID];
										
												require $fobrainSchoolTBS; /* include student database table information  */ 
								
												$level_list = studentLevelsArray($conn); 
								
												$level_val = ""; 
								
												foreach($level_list as $level_grade) { 
								
													$levelID = $level_grade['cl_id']; $levelVal = $level_grade['level'];
								
													if ($levelID == $level){
														$selected = "SELECTED";
													} else {
														$selected = "";
													}
								
													$level_val .= '<option value="'.$schoolID.'@$@'.$levelID.'"'.$selected.'>'.$levelVal.'</option>' ."\r\n";
								
													$levelID = ""; $levelVal = "";
								
												} 
								
												echo $level_val; 
												
											}else{ 
												
												echo '<option value="">Ooops Error, could not load school level</option>' ."\r\n"; 
												
											}	  

										?>

									</select>
									<div class="field-placeholder">  Level <span class="text-danger"></span></div>													
								</div>
								<!-- field wrapper end -->
							</div>																 
						</div>	
						<!-- /row --> 

						<!-- row -->
						<div class="row gutters">
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">									
								<!-- field wrapper start -->
								<div class="field-wrapper">
									<input type="number" class="form-control" placeholder="Enter Amount Paid" 
									name="amountPaid"  id="amountPaid" value = "<?php echo $amount_db; ?>" required>
									<div class="field-placeholder"> Amount <span class="text-danger"></span></div>													
								</div>
								<!-- field wrapper end -->
							</div>																 
							
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">										
								<!-- field wrapper start -->
								<div class="field-wrapper">
									<select class="form-control fob-select" id="method" name="method" required>
									<option value = "">Search . . . >>>></option>
									<?php

										foreach($paymentMethodArr as $methodKey => $methodVal){  /* loop array */

											if ($method == $methodKey){

												$selected = "SELECTED";

											} else {

												$selected = "";

											}

											echo '<option value="'.$methodKey.'"'.$selected.'>'.$methodVal.'</option>' ."\r\n";

										}

									?> 
									
									</select>
									<div class="field-placeholder">  Method <span class="text-danger"></span></div>													
								</div>
								<!-- field wrapper end -->
							</div>																 
						</div>	
						<!-- /row --> 
						
						<!-- row -->
						<div class="row gutters">
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">									
								<!-- field wrapper start -->
								<div class="field-wrapper">
									<input type="number" class="form-control field-selector" placeholder="Fee Waiver" 
									value="<?php echo $waiver; ?>"  name="waiver"  id="waiver">
									<div class="field-placeholder"> Waiver <span class="text-danger"> </span></div>	 
								</div>
								<!-- field wrapper end --> 							
							</div>	
							
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">									
								<!-- field wrapper start -->
								<div class="field-wrapper">
									<input type="number" class="form-control field-selector" placeholder="Fee Fine" 
									value="<?php echo $efine; ?>"  name="efine"  id="efine">
									<div class="field-placeholder">  Fine <span class="text-danger"> </span></div>	 
								</div>
								<!-- field wrapper end --> 							
							</div>	 
						</div>	
						<!-- /row -->  

						<!-- row -->
						<div class="row gutters">
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">								
								<!-- field wrapper start -->
								<div class="field-wrapper">
									<select class="form-control fob-select" id="term" name="term" required>
										<option value = "">Search . . . >>>></option>
										<?php

											foreach($term_list as $term_key => $term_value){  /* loop array */

												if ($term == $term_key){
													$selected = "SELECTED";
												} else {
													$selected = "";
												}

												echo '<option value="'.$term_key.'"'.$selected.'>'.$term_value.'</option>' ."\r\n";

											}

										?> 
									</select>
									<div class="field-placeholder">  Term<span class="text-danger"></span></div>													
								</div>
								<!-- field wrapper end -->
							</div>
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">									
								<!-- field wrapper start -->
								<div class="field-wrapper">
									<input type="date" value="<?php echo $date; ?>" name="pDay"  required />
									<div class="field-placeholder"> Payment Date: <span class="text-danger"></span></div>													
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
									<select class="form-control fob-select" id="pstatus" name="pstatus" required>
										<option value = "">Search . . . >>>></option>
										<?php

										foreach($confirm_pay_arr as $pstatusKey => $pstatusVal){  /* loop array */

											if ($pstatus == $pstatusKey){
												
												$selected = "SELECTED";
												
											} else {
												
												$selected = "";
												
											}

											echo '<option value="'.$pstatusKey.'"'.$selected.'>'.$pstatusVal.'</option>' ."\r\n";

										}

										?> 

									</select>
									<!--
									<textarea rows="4" cols="10" class="form-control" name="payDetails" id="payDetails" 
									placeholder="Payment Details eg Bank Name, Teller ID, Cheque ID, Card Type "><?php echo $fDetail; ?></textarea>
									-->
									<div class="field-placeholder">  Payment Status <span class="text-danger"></span></div>													
								</div>
								<!-- field wrapper end -->
							</div>																 
						</div>	
						<!-- /row -->

						<!-- /row -->
						<hr class="my-25 text-danger" />				
						<!-- row -->
						<div class="row gutters justify-content-center"> 
							<div class="col-12 text-center"> 
								<div class="picture-container">
									<div class="picture">
										<img src="<?php echo $pay_upload; ?>" class="picture-src" id="picture-preview" title="" />
										<input type="file" class="picture-file" id="payupload" name="payupload">
									</div>
									<h6>Upload Proof of Pay</h6>
									<div class="text-danger fs-10">Only max image size of 2MB &amp; format of <?php echo $allowedPicExt; ?> are allowed.</div>
								</div>  
							</div> 
						</div>
						<!-- /row -->	

						<!-- </div> --> 
						<div class="text-center" id="waitDi" style="display: none;">
							<div class="spinner-border text-danger" role="status">
								<span class="visually-hidden">Loading...</span>
							</div>
						</div>  
						<span id="payStatusDiv" style="display: none;"></span>  <!-- loading div --> 
						
						<hr class="mt-30 mb-15 text-danger" />
						<!-- row -->
						<div class="row gutters modal-btn-footer">
							<div class="col-6 text-start">
								<button type="button" id="close-modal" class="btn btn-danger close-modal" 
								data-bs-dismiss="modal"> <i class="mdi mdi-window-close label-icon"></i> Close</button>
							</div>
							<div class="col-6 text-end">
								<input type="hidden" name="payment" value="update" />
								<input type="hidden" name="fID" value="<?php echo $feeID; ?>" />
								<input type="hidden" name="pstatus_o" value="<?php echo $pstatus; ?>" />
								<input type="hidden" name="oupload" value="<?php echo $upload; ?>" />
								<button type="submit" class="btn btn-primary waves-effect   
								btn-label waves-light" id="updatePayment">
									<i class="mdi mdi-content-save label-icon"></i>  Update
								</button>
							</div>
						</div>	
						<!-- /row -->	 
								
					</form>  	
					<!-- / form -->		

					<script type="text/javascript">	 

						$('.field-selector').change(); hidePageLoader(); 

						$('.fob-select').each(function() {  
							renderSelect($('#'+this.id)); 
						}); 
						
					</script>	 
<?php 				 
					

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				} 
			
		
			}
		
		}elseif ($_REQUEST['payment'] == 'balance') {  /* edit fees */
			
			$fID = strip_tags($_REQUEST['rData']);
			
			/* script validation */ 
			
			if ($fID == ""){
				
				$msg_e = "* Ooops, an error has occur while to retrieve payment information. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}else {    

				try { 
					
					$feesInfoArr = feesInfo($conn, $fID);
					$feeID = $feesInfoArr[$fiVal]["fID"];
					$feeCat = $feesInfoArr[$fiVal]["feeCat"];
					$fee_account = $feesInfoArr[$fiVal]["acc"];
					$feeAmount = $feesInfoArr[$fiVal]["feeAmount"];
					$sessionID = $feesInfoArr[$fiVal]["session"];
					$regID = $feesInfoArr[$fiVal]["reg_id"];
					$regNum = $feesInfoArr[$fiVal]["regNo"];
					$schoolID = $feesInfoArr[$fiVal]["stype"];
					$level = $feesInfoArr[$fiVal]["level"];
					$class = $feesInfoArr[$fiVal]["class"];
					$term = $feesInfoArr[$fiVal]["term"];
					$method = $feesInfoArr[$fiVal]["method"];
					$fDetail = htmlspecialchars_decode($feesInfoArr[$fiVal]["f_details"]);
					$amount_db = $feesInfoArr[$fiVal]["amount"];
					$balance = $feesInfoArr[$fiVal]["balance"];
					$waiver = $feesInfoArr[$fiVal]["waiver"];
					$efine = $feesInfoArr[$fiVal]["efine"];
					$date = $feesInfoArr[$fiVal]["date"];
					$fStatus = $feesInfoArr[$fiVal]["f_status"];
					$pstatus = $feesInfoArr[$fiVal]["pstatus"];
					$pstatus2 = $feesInfoArr[$fiVal]["pstatus2"];
					$upload = $feesInfoArr[$fiVal]["upload"];

					$upload2 = $feesInfoArr[$fiVal]["upload2"];
					$amount2 = $feesInfoArr[$fiVal]["amount2"];
					$date2 = $feesInfoArr[$fiVal]["date2"];
					$method2 = $feesInfoArr[$fiVal]["method2"];
					$n_pay = $feesInfoArr[$fiVal]["n_pay"];

					$pay_upload = picture($fobrainPaymentDir, $upload, "doc"); 

					if($n_pay == $seVal){

						$amount2 = fobrainCurrency($amount2, $curSymbol);  /* school currency information*/
						$date2 = date("j F Y", strtotime($date2));
						$payMethod2 = wizSelectArray($method2, $paymentMethodArr);

						$pay_upload2 = $fobrainPaymentDir.$upload2; 
							
						if(($upload2 != "") && (file_exists($pay_upload2))){  /* check if picture exits */ 

							$showQPicture2 ='
							<tr>
								<th colspan="2" class="text-center">								
									Payment Proof 
								</th> 
							</tr>
							<tr>
								<td colspan="2" class="text-center">								
									<img src = "'.$pay_upload2.'"  class="img-fluid-flex" style="height:450px !important";> 
								</td> 
							</tr>';  
	
						}else{
							$showQPicture2 = "";
						}

						$payment_se ='
						<!-- table -->
						<table  class="table table-view table-hover">
							<tr>
								<th colspan="2" class="text-center">								
									2nd Payment Details
								</th> 
							</tr> 
							<tr>
								<th>
									Amount Paid 
								</th> 
								<td>
									'.$amount2.'
								</td> 
							</tr>
							<tr>
								<th>
									Payment Method 
								</th> 
								<td>
									'.$payMethod.'
								</td> 
							</tr>
							<tr>
								<th>
									Date
								</th> 
								<td>
									'.$date2.'
								</td> 
							</tr>
							'.$showQPicture2.
							'
							</table>
							<div class="row gutters mb-20"> 
								<div class="col-6 text-start">						
									<a href="javascript:;" id="'.$feeID.'@@'.$regNum.'@@2" class ="appr-decline-fee btn btn-success">									
										<i class="mdi mdi-account-check label-icon"></i> Approve
									</a>
								</div>
								<div class="col-6 text-end">						
									<a href="javascript:;" id="'.$feeID.'@@'.$regNum.'@@3" class ="appr-decline-fee btn btn-danger">									
										<i class="mdi mdi-account-remove-outline label-icon"></i> Decline
									</a>
								</div>
							</div>';   
				 
						
					}else{  $payment_se = ""; }

					echo $payment_se;
					
?>					
					<!-- form -->						
					<form class="form-horizontal" id="frmupdateBalance" role="form" 
					enctype="multipart/form-data"> 							
						<!-- row -->
						<div class="row gutters"> 
							<div class="col-12">										
								<!-- field wrapper start -->
								<div class="field-wrapper">
									<select disabled class="form-control fob-select" id="feeCat" name="feeCat" required>

										<option value = "">Search . . . >>>></option>

										<?php


											try {

												$feeCategoryDataArr = feeCategoryData($conn);  /* school fee category array */
												$feeCategoryDataCount = count($feeCategoryDataArr);

											}catch(PDOException $e) {

												fobrainDie( 'Ooops Database Error: ' . $e->getMessage());

											}		

											if($feeCategoryDataCount >= $fiVal){  /* check array is empty */ 

												for($i = $fiVal; $i <= $feeCategoryDataCount; $i++){  /* loop array */	

													$fID = $feeCategoryDataArr[$i]["f_id"];
													$feeCategory = $feeCategoryDataArr[$i]["fee"];
													$amount = $feeCategoryDataArr[$i]["amount"];
													$status = $feeCategoryDataArr[$i]["status"];
													$fee_account = $feeCategoryDataArr[$i]["account"];

													$feeCategory = trim($feeCategory);
													$amount = trim($amount);
													$status = trim($status);

													$amountS = fobrainCurrency($amount, $curSymbol);  /* school currency information*/ 

													if ( $fID == $feeCat){
														$selected = "SELECTED";
													} else {
														$selected = "";
													}

													echo '<option value="'.$fID.'-'.$amount.'-'.$fee_account.'"'.$selected.'>
													'.$feeCategory.' - '.$amountS.'</option>' ."\r\n";

												}
												
											}else{

												echo '<option value="">Ooops Error, could find fee category.</option>' ."\r\n"; 

											}	 

										?>

									</select>
									<div class="field-placeholder"> Fee Category <span class="text-danger"></span></div>													
								</div>
								<!-- field wrapper end -->
							</div>																 
						</div>	
						<!-- /row -->
						<?php 

								

							echo '
							<!-- row -->
							<div class="row gutters  justify-content-center">
								<div class="col-12 text-center my-10  bb-1 px-5-per"> 
									<h4 class="text-info">Payment Summary</h4>  
								</div>  
									
								<div class="col-xl-10 col-lg-10 col-md-10 col-12 text-left my-10 bb-1"> 
									<div class="row gutters"> 
										<div class="col-6 px-5-per py-10 fw-600 text-info bb-1">Fee Waiver</div>
										<div class="col-6 px-5-per py-10 fw-600 text-info bb-1">
											<span class="text-success">'.$curSymbol.'</span>
											<span class="text-success" id="waiver_des">'.$waiver.'</span> 
										</div>
										<div class="col-6 px-5-per py-10 fw-600 text-info bb-1">Fee Fine</div>
										<div class="col-6 px-5-per py-10 fw-600 text-info bb-1">
											<span class="text-danger">'.$curSymbol.'</span>
											<span class="text-danger" id="efine_des">'.$efine.'</span>
										</div>
										
										<div class="col-6 px-5-per py-10 fw-600 text-info bb-1">Net Total</div>
										<div class="col-6 px-5-per py-10 fw-600 text-info bb-1">
											<span class="text-success">'.$curSymbol.'</span>
											<span class="text-success" id="total_fee_dis"></span>
										</div> 

										<div class="col-6 px-5-per py-10 fw-600 text-info bb-1">Fee Balance</div>
										<div class="col-6 px-5-per py-10 fw-600 text-info bb-1">
											<span class="text-info">'.$curSymbol.'</span>
											<span class="text-info" id="balance_des"></span>
										</div>
									</div>
								</div>
							</div>	

							<div class="wiz-loader-2 display-none wiz-glower">
								<ul>
									<li></li>
									<li></li>
									<li></li>
									<li></li>
									<li></li>
									<li></li>
									<li></li>
								</ul>
							</div>

							<input type="hidden" class="form-control" placeholder="" name="total_fee"  id="total_fee"
									value = "'.$amount_db.'">
							<input type="hidden" class="form-control" placeholder="" name="f_balance"  id="fbalance"
									value = "'.$balance.'">';  
						?>


						<!-- row -->
						<div class="row gutters">
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">									
								<!-- field wrapper start -->
								<div class="field-wrapper">
									<input type="number" class="form-control" placeholder="Enter Amount Paid"  disabled
									name="amountPaid"  id="amountPaid" value = "<?php echo $amount_db; ?>" >
									<div class="field-placeholder"> Ist Payment <span class="text-danger"></span></div>													
								</div>
								<!-- field wrapper end -->
							</div>	
							
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">									
								<!-- field wrapper start -->
								<div class="field-wrapper">
									<input type="number" class="form-control" placeholder="Payment balance"  disabled
									name="amountBal"  id="amountBal" value = "<?php echo $balance; ?>" >
									<div class="field-placeholder"> Fee Balance <span class="text-danger"></span></div>													
								</div>
								<!-- field wrapper end -->
							</div>	
							
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">										
								<!-- field wrapper start -->
								<div class="field-wrapper">
									<select class="form-control fob-select" id="method" name="method" required>
									<option value = "">Search . . . >>>></option>
									<?php

										foreach($paymentMethodArr as $methodKey => $methodVal){  /* loop array */

											if ($method == $methodKey){

												$selected = "SELECTED";

											} else {

												$selected = "";

											}

											echo '<option value="'.$methodKey.'"'.$selected.'>'.$methodVal.'</option>' ."\r\n";

										}

									?> 
									
									</select>
									<div class="field-placeholder">  Method <span class="text-danger"></span></div>													
								</div>
								<!-- field wrapper end -->
							</div>																 
						</div>	
						<!-- /row --> 
						
						<!-- row -->
						<div class="row gutters">
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">									
								<!-- field wrapper start -->
								<div class="field-wrapper">
									<input type="number" class="form-control field-selector" placeholder="Fee Waiver" 
									value="<?php echo $waiver; ?>"  name="waiver"  id="waiver">
									<div class="field-placeholder"> Waiver <span class="text-danger"> </span></div>	 
								</div>
								<!-- field wrapper end --> 							
							</div>	
							
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">									
								<!-- field wrapper start -->
								<div class="field-wrapper">
									<input type="number" class="form-control field-selector" placeholder="Fee Fine" 
									value="<?php echo $efine; ?>"  name="efine"  id="efine">
									<div class="field-placeholder">  Fine <span class="text-danger"> </span></div>	 
								</div>
								<!-- field wrapper end --> 							
							</div>	 
						</div>	
						<!-- /row -->  

						<!-- row -->
						<div class="row gutters">							
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">									
								<!-- field wrapper start -->
								<div class="field-wrapper">
									<input type="date" value="<?php echo $date; ?>" name="pDay"  required />
									<div class="field-placeholder"> 2 Payment Date: <span class="text-danger"></span></div>													
								</div>
								<!-- field wrapper end -->
							</div>	
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">										
								<!-- field wrapper start -->
								<div class="field-wrapper">
									<select class="form-control fob-select" id="pstatus" name="pstatus" required>
										<option value = "">Search . . . >>>></option>
										<?php

										foreach($confirm_pay_arr as $pstatusKey => $pstatusVal){  /* loop array */

											if ($pstatus2 == $pstatusKey){
												
												$selected = "SELECTED";
												
											} else {
												
												$selected = "";
												
											}

											echo '<option value="'.$pstatusKey.'"'.$selected.'>'.$pstatusVal.'</option>' ."\r\n";

										}

										?> 

									</select>
									<!--
									<textarea rows="4" cols="10" class="form-control" name="payDetails" id="payDetails" 
									placeholder="Payment Details eg Bank Name, Teller ID, Cheque ID, Card Type "><?php echo $fDetail; ?></textarea>
									-->
									<div class="field-placeholder">  Balance Status <span class="text-danger"></span></div>													
								</div>
								<!-- field wrapper end -->
							</div>															 
						</div>	
						<!-- /row --> 
													
					 

						<!-- /row -->
						<hr class="my-25 text-danger" />				
						<!-- row -->
						<div class="row gutters justify-content-center"> 
							<div class="col-12 text-center"> 
								<div class="picture-container">
									<div class="picture">
										<img src="<?php echo $pay_upload2; ?>" class="picture-src" id="picture-preview" title="" />
										<input type="file" class="picture-file" id="payupload" name="payupload">
									</div>
									<h6>Upload Proof of Pay</h6>
									<div class="text-danger fs-10">Only max image size of 2MB &amp; format of <?php echo $allowedPicExt; ?> are allowed.</div>
								</div>  
							</div> 
						</div>
						<!-- /row -->	

						<!-- </div> --> 
						<div class="text-center" id="waitDi" style="display: none;">
							<div class="spinner-border text-danger" role="status">
								<span class="visually-hidden">Loading...</span>
							</div>
						</div>  
						<span id="payStatusDiv" style="display: none;"></span>  <!-- loading div --> 
						
						<hr class="mt-30 mb-15 text-danger" />
						<!-- row -->
						<div class="row gutters modal-btn-footer">
							<div class="col-6 text-start">
								<button type="button" id="close-modal" class="btn btn-danger close-modal" 
								data-bs-dismiss="modal"> <i class="mdi mdi-window-close label-icon"></i> Close</button>
							</div>
							<div class="col-6 text-end">
								<input type="hidden" name="payment" value="ubalance" />
								<input type="hidden" name="fID" value="<?php echo $feeID; ?>" />
								<input type="hidden" name="pstatus_o" value="<?php echo $pstatus; ?>" />
								<input type="hidden" name="pstatus_o2" value="<?php echo $pstatus2; ?>" />
								<input type="hidden" name="account" value="<?php echo $fee_account ?>" />
								<input type="hidden" name="oupload" value="<?php echo $upload2; ?>" />
								<button type="submit" class="btn btn-primary waves-effect   
								btn-label waves-light" id="updateBalance">
									<i class="mdi mdi-content-save label-icon"></i>  Update
								</button>
							</div>
						</div>	
						<!-- /row -->	 
								
					</form>  	
					<!-- / form -->		

					<script type="text/javascript">	 

						$('.field-selector').change(); hidePageLoader(); 

						$('.fob-select').each(function() {  
							renderSelect($('#'+this.id)); 
						}); 
						
					</script>	 
<?php 				 
					

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				} 
			
		
			}
		
		}elseif ($_REQUEST['payment'] == 'add') {

			$querytp =  $_REQUEST['querytp']; 

			echo '<div class="row gutters my-10">
                <div class="col-12">';

				$page_title = '<i class="mdi mdi-cash-register fs-18"></i> 
							Paymment Manager';
						pageTitle($page_title, 0);
                    
            echo    '</div>	
			</div>'; 

?> 
			<!-- form -->
			<form class="form-horizontal mt-20 mb-150" id="frmsaveFees" 
			enctype="multipart/form-data" enctype="multipart/form-data" method="POST"> 
				<!-- row -->
				<div class="row gutters">
					<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">										
						<!-- field wrapper start -->
						<div class="field-wrapper select-wrapper">
							
							<select class="form-control fob-select" id="feeCat" name="feeCat" required>

								<option value = "">Search . . . >>>></option>

								<?php


									try {

										$feeCategoryDataArr = feeCategoryData($conn);  /* school fee category array */
										$feeCategoryDataCount = count($feeCategoryDataArr);
											
									}catch(PDOException $e) {
										
										fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
										
									}		
									
									if($feeCategoryDataCount >= $fiVal){  /* check array is empty */	 

										for($i = $fiVal; $i <= $feeCategoryDataCount; $i++){  /* loop array */		
										
											$fID = $feeCategoryDataArr[$i]["f_id"];
											$feeCategory = $feeCategoryDataArr[$i]["fee"];
											$amount = $feeCategoryDataArr[$i]["amount"];
											$status = $feeCategoryDataArr[$i]["status"];
											$fee_account = $feeCategoryDataArr[$i]["account"];
											
											$feeCategory = trim($feeCategory);
											$amount = trim($amount);
											$status = trim($status);
											
											$amountS = fobrainCurrency($amount, $curSymbol);  /* school currency information*/ 
											
											echo '<option value="'.$fID.'#fob#'.$amount.'#fob#'.$feeCategory.'"'.$selected.'>
											'.$feeCategory.' - '.$amountS.'</option>' ."\r\n";

										}
										
									}else{
										
										echo '<option value="">Ooops Error, could not find fee  category.</option>' ."\r\n"; 
										
									}	 

								?> 

							</select> 
							<div class="icon-wrap"  id="wait" style="display: none;">
								<i class="loader"></i>
							</div>
							<div class="field-placeholder">  Fee Category <span class="text-danger">*</span></div>													
						</div>
						<!-- field wrapper end -->
					</div>
		
					<span id="result" style="display: none;"></span><!-- loading div -->

				</div>	
				<!-- /row --> 
					
				<div id="feeDetailsDivTop" style="display:none;">

					<!-- row -->
					<div class="row gutters">
						<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">										
							<!-- field wrapper start -->
							<div class="field-wrapper select-wrapper">
								<select class="form-control fob-select" id="schoolType" name="schoolType" required>

									<option value = "">Search . . .</option>

									<?php

										foreach($school_list as $school => $schoolVal){  /* loop array */

											if ($schoolID == $school){
												$selected = "SELECTED";
											} else {
												$selected = "";
											}

											echo '<option value="'.$school.'"'.$selected.'>'.$schoolVal.'</option>' ."\r\n";

										}

									?> 

								</select>
								<div class="icon-wrap"  id="wait_1" style="display: none;">
									<i class="loader"></i>
								</div>
								<div class="field-placeholder">  School <span class="text-danger">*</span></div>													
							</div>
							<!-- field wrapper end -->
						</div>																 
					</div>	
					<!-- /row -->  

					<!-- row -->
					<div class="row gutters">
						<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">									 
							<span id="result_1" style="display: none;"></span>										 
							<span id="result_11" style="display: none;"></span>
						</div>																 
					</div>	
					<!-- /row -->
					
					<div id="feeDetailsDiv" style="display:none;">
							
						<?php 

							$waiver = "";  $efine = ""; $total_fee = ""; $fbalance = "";

							echo '
							<!-- row -->
							<div class="row gutters  justify-content-center">
								<div class="col-12 text-center my-10  bb-1 px-5-per"> 
									<h4 class="text-info">Payment Summary</h4>  
								</div>  
									
								<div class="col-xl-10 col-lg-10 col-md-10 text-left my-10 bb-1"> 
									<div class="row gutters"> 
										<div class="col-6 px-5-per py-10 fw-600 text-info bb-1">Fee Waiver</div>
										<div class="col-6 px-5-per py-10 fw-600 text-info bb-1">
											<span class="text-success">'.$curSymbol.'</span>
											<span class="text-success" id="waiver_des">'.$waiver.'</span> 
										</div>
										<div class="col-6 px-5-per py-10 fw-600 text-info bb-1">Fee Fine</div>
										<div class="col-6 px-5-per py-10 fw-600 text-info bb-1">
											<span class="text-danger">'.$curSymbol.'</span>
											<span class="text-danger" id="efine_des">'.$efine.'</span>
										</div>
										
										<div class="col-6 px-5-per py-10 fw-600 text-info bb-1">Net Total</div>
										<div class="col-6 px-5-per py-10 fw-600 text-info bb-1">
											<span class="text-success">'.$curSymbol.'</span>
											<span class="text-success" id="total_fee_dis">'.$total_fee.'</span>
										</div> 

										<div class="col-6 px-5-per py-10 fw-600 text-info bb-1">Fee Balance</div>
										<div class="col-6 px-5-per py-10 fw-600 text-info bb-1">
											<span class="text-info">'.$curSymbol.'</span>
											<span class="text-info" id="balance_des">'.$fbalance.'</span>
										</div>
									</div>
								</div>
							</div>	

							<div class="wiz-loader-2 display-none wiz-glower">
								<ul>
									<li></li>
									<li></li>
									<li></li>
									<li></li>
									<li></li>
									<li></li>
									<li></li>
								</ul>
							</div>

							<input type="hidden" class="form-control" placeholder="" name="total_fee"  id="total_fee"
									value = "'.$total_fee.'">
							<input type="hidden" class="form-control" placeholder="" name="f_balance"  id="fbalance"
									value = "'.$fbalance.'">';  
						?>
						
						<!-- row -->
						<div class="row gutters">
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">									
								<!-- field wrapper start -->
								<div class="field-wrapper">
									<input type="number" class="form-control field-selector field-selector float-number" placeholder="Enter Amount Paid" name="amountPaid"  id="amountPaid" required>
									<div class="field-placeholder"> Amount  <span class="text-danger">*</span></div>													
									<a href="javascript:;" class="text-sienna btn waves-effect btn-label waves-light fs-10" id="transferPayment"> 
										<i class="mdi mdi-cash-check label-icon"></i> Paid Fully, Click Here 
									</a>
								</div>
								<!-- field wrapper end --> 							
							</div>																 

							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">										
								<!-- field wrapper start -->
								<div class="field-wrapper">
									<select class="form-control fob-select" id="method" name="method" required>
										<option value = "">Search . . . >>>></option>
										<?php

										foreach($paymentMethodArr as $methodKey => $methodVal){  /* loop array */

											if ($method == $methodKey){
												
												$selected = "SELECTED";
												
											} else {
												
												$selected = "";
												
											}

											echo '<option value="'.$methodKey.'"'.$selected.'>'.$methodVal.'</option>' ."\r\n";

										}

										?> 

									</select>
									<div class="field-placeholder">  Pay Method <span class="text-danger">*</span></div>													
								</div>
								<!-- field wrapper end -->
							</div>																 
						</div>	
						<!-- /row --> 

						<!-- row -->
						<div class="row gutters">
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">									
								<!-- field wrapper start -->
								<div class="field-wrapper">
									<input type="number" class="form-control field-selector float-number" placeholder="Fee Waiver" name="waiver"  id="waiver">
									<div class="field-placeholder"> Waiver <span class="text-danger"> </span></div>	 
								</div>
								<!-- field wrapper end --> 							
							</div>	
							
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">									
								<!-- field wrapper start -->
								<div class="field-wrapper">
									<input type="number" class="form-control field-selector float-number" placeholder="Fee Fine" name="efine"  id="efine">
									<div class="field-placeholder">  Fine <span class="text-danger"> </span></div>	 
								</div>
								<!-- field wrapper end --> 							
							</div>	 
						</div>	
						<!-- /row -->  

						<!-- row -->
						<div class="row gutters">
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">									
								<!-- field wrapper start -->
								<div class="field-wrapper">
									<select class="form-control fob-select" id="term" name="term" required>

										<option value = "">Search . . . >>>></option>
										<?php


											foreach($term_list as $term_key => $term_value){    /* loop array */  /* loop array */

											if ($curTerm == $term_key){
												$selected = "SELECTED";
											} else {
												$selected = "";
											}

											echo '<option value="'.$term_key.'"'.$selected.'>'.$term_value.'</option>' ."\r\n";

											}

										?> 
									</select>
									<div class="field-placeholder">  Term <span class="text-danger">*</span></div>													
								</div>
								<!-- field wrapper end -->
							</div>			
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">										
								<!-- field wrapper start -->
								<div class="field-wrapper">
									<input type="date" value="<?php echo $date; ?>" name="pDay" class="chart-autofill"  data-code="journal-date" required />
									<div class="field-placeholder"> Payment Date: <span class="text-danger">*</span></div>													
								</div>
								<!-- field wrapper end -->
							</div>																 
						</div>	
						<!-- /row -->	 
							
						<!-- row -- >
						<div class="row gutters">
							<div class="col-12">										
								<! -- field wrapper start - ->
								<div class="field-wrapper">
									<select class="form-control fob-select" id="pstatus" name="pstatus" required>
										<option value = "">Search . . . >>>></option>
										<?php

										foreach($confirm_pay_arr as $pstatusKey => $pstatusVal){  /* loop array */

											if ($pstatus == $pstatusKey){
												
												$selected = "SELECTED";
												
											} else {
												
												$selected = "";
												
											}

											//echo '<option value="'.$pstatusKey.'"'.$selected.'>'.$pstatusVal.'</option>' ."\r\n";

										}

										?> 

									</select>
									<!- -
									<textarea rows="4" cols="10" class="form-control" name="payDetails" id="payDetails" 
									placeholder="Payment Details eg Bank Name, Teller ID, Cheque ID, Card Type "></textarea>
									-- >
									<div class="field-placeholder">  Payment Status <span class="text-danger"></span></div>													
								</div>
								<!- - field wrapper end -- >
							</div>																 
						</div>	
						<!- - /row -->

						<!-- row -->
						<div class="row gutters mt-25">
							<div class="col-12">
								<?php 
									$page_title = '<i class="mdi mdi-chart-bar-stacked fs-18"></i> 
										Journals Entry';
									pageTitle($page_title, 0);	 
								?>
							</div>	
							<div class="col-12">	
								<div class="table-responsive">   
									<!-- table -->
									<table class='table table-hover table-responsive style-table wiz-table mb-0 pb-0'>
									
									<thead>
										<tr>
											<th width="10%">Date</th> 
											<th width="20%">Discription</th> 
											<th width="20%">Account</th>
											<th width="20%">Account Type</th>
											<th width="10%">Debit (<?php echo $curSymbol ?>)</th>
											<th width="10%">Credit (<?php echo $curSymbol ?>)</th>
											<!--<th width="10%">Balance (<?php echo $curSymbol ?>)</th>  -->
										</tr>
									</thead> 
									<tbody>

									<?php  

										$acc_type = "";
										$debit = "";
										$credit = "";
										$acc_balance = ""; $query = "";

										$options_chart_1 =" <select class='form-control fob-select chart-autofill-2'  data-code='journal-type1'  
													id='chart_account1' name='chart_account1'><option value=''>Select Chart Account</option>";
										try {
										
											$options_chart_1 .= chartOptions($conn, $cid, 1, $query);
											
										}catch(PDOException $e) {

											fobrainDie( 'Ooops Database Error: ' . $e->getMessage());

										}

										$options_chart_1 .= "</select>";

										
										$options_chart_2 =" <select class='form-control fob-select chart-autofill-2'  data-code='journal-type2'  
													id='chart_account2' name='chart_account2'><option value=''>Select Chart Account</option>";
										try {
										
											$options_chart_2 .= chartOptions($conn, $cid, 1, $query);
											
										}catch(PDOException $e) {

											fobrainDie( 'Ooops Database Error: ' . $e->getMessage());

										}

										$options_chart_2 .= "</select>";

$journal_rows =<<<IGWEZE

										<tr>
											<td><span class="journal-date"></span></td>
											<td><span class="journal-desc"></span></td> 
											<td>
												$options_chart_1
											</td>  
											<td><span class="journal-type1">$acc_type</span></td>
											<td><span class="journal-debit1">$debit</span></td>
											<td><span class="journal-credit1">$credit</span></td>
											<!--<td><span class="journal-balance">$acc_balance</span></td> -->
										</tr>

										<tr>
											<td><span class="journal-date"></span></td>
											<td><span class="journal-desc"></span></td> 
											<td>
												$options_chart_2
											</td>  
											<td><span class="journal-type2">$acc_type</span></td>
											<td><span class="journal-debit2">$debit</span></td>
											<td><span class="journal-credit2">$credit</span></td>
											<!--<td>-<span class="journal-balance">$acc_balance</span></td> -->
										</tr> 
IGWEZE;
            
                        				echo $journal_rows;  

										?>	

									</tbody>
									</table>				
									<!-- / table --> 
								</div>
							</div>	
						</div>

						<!-- /row -->						

						<!-- /row -->
						<hr class="my-25 text-danger" />	
						
						 
						<!-- row -->
						<div class="row gutters justify-content-center"> 
							<div class="col-12 text-center">
								<div class="picture-container">
									<div class="picture">
										<img src="<?php echo $wiz_df_file_img; ?>" class="picture-src" id="picture-preview" title="" />
										<input type="file" class="picture-file" id="payupload" name="payupload">
									</div>
									<h6>Upload Proof of Pay</h6>
									<div class="text-danger fs-10">Only max image size of 2MB &amp; format of <?php echo $allowedPicExt; ?> are allowed.</div>
								</div>   
							</div> 
						</div>
						<!-- /row -->
						
						<div class="text-center" id="waitDi" style="display: none;">
							<div class="spinner-border text-danger" role="status">
								<span class="visually-hidden">Loading...</span>
							</div>
						</div> 
						<span id="payStatusDiv" style="display: none;"></span> <!-- loading div --> 
							

						<hr class="mt-30 mb-15 text-danger" />
						<!-- row -->
						<div class="row gutters modal-btn-footer">
							<div class="col-6 text-start">
								<button type="button" id="close-modal" class="btn btn-danger close-modal" 
								data-bs-dismiss="modal"> <i class="mdi mdi-window-close label-icon"></i> Close</button>
							</div>
							<div class="col-6 text-end">
								<input type="hidden" name="payment" value="save" /> 
								<input type="hidden" name="querytp" value="<?php echo $querytp; ?>" />
								<button type="submit" class="btn btn-primary waves-effect   
								btn-label waves-light demo-disenable" id="saveFees">
									<i class="mdi mdi-content-save label-icon"></i>  Save
								</button>
							</div>
						</div>	
						<!-- /row -->	

					</div>					
				</div>									
			</form>
			<!-- / form -->		  

			<script type="text/javascript">  

				$('.fob-select').each(function() {  
					renderSelect($('#'+this.id)); 
				});

				$('.float-number').keypress(function(event) {
					if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
						event.preventDefault();
					}
				});

				hidePageLoader();
				
			</script>				

<?php


		}else{
					
			echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
		
		}

		
exit;
?>