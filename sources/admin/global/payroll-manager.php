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
	This script handle school payroll information
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

		if (!defined('fobrain'))

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!'); 
	 
		  
		if ($_REQUEST['payroll'] == 'save') {  /* save payroll */ 
			
			$acc = cleanInt($_REQUEST['bank_acc']);
			$staff = cleanInt($_REQUEST['staff']);
			$salary = clean($_REQUEST['salary']);
			$nsalary = clean($_REQUEST['nsalary']);
			$tax = clean($_REQUEST['tax']);

			$earn1 =  clean($_REQUEST['earn1']);
			$des1 =  clean($_REQUEST['des1']);
			$earn2 =  clean($_REQUEST['earn2']);
			$des2 =  clean($_REQUEST['des2']);
			$earn3 =  clean($_REQUEST['earn3']);
			$des3 =  clean($_REQUEST['des3']); 

			$ded1 =  clean($_REQUEST['ded1']);
			$purp1 =  clean($_REQUEST['purp1']);
			$ded2 =  clean($_REQUEST['ded2']);
			$purp2 =  clean($_REQUEST['purp2']);
			$ded3 =  clean($_REQUEST['ded3']);
			$purp3 =  clean($_REQUEST['purp3']); 
			
			$journalArr = $_REQUEST['journals']; 
			
			$pmethod = cleanInt($_REQUEST['pmethod']);
			$payDetails = $_REQUEST['payDetails']; 
			$pDay = $_REQUEST['pDay'];		
			$querytp =  $_REQUEST['querytp'];

			$rtime = date("Y-m-d H:i:s");
			$edate = $pDay; 

			$transact = $transact_payroll; 
			$acc = 1;  

			$title = "Staff Payroll";
			
			/* script validation */
			
			if ($acc == "")  {
				
				$msg_e = "* Ooops Error, please a debit account";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($staff == "")  {
				
				$msg_e = "* Ooops Error, please select staff";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($salary == "")  {
				
				$msg_e = "* Ooops Error, enter staff salary";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($nsalary == "")  {
				
				$msg_e = "* Ooops Error, please select staff payroll";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($nsalary > $salary)  {
				
				$msg_e = "* Ooops Error, your payroll salary  <strong>$salaryCur</strong> entered is greater than 
				payroll salary <strong>$salaryCur</strong>";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($pmethod == "")  {
				
				$msg_e = "* Ooops Error, please select a payroll pmethod";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($pDay == "")  {
				
				$msg_e = "* Ooops Error, please select a payroll date";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}else {   /* insert information */  
				
				$grandtotal = $nsalary;

				if(is_array($journalArr)){ 

					$in = $journal_total = 0; $sn = 1;   
				
					foreach ($journalArr as $input_row) { 
					
						$account = $journalArr[$in]['account']; 

						if($in == 0){ 

							$debit = $journalArr[$in]['debit'];
							$check_empty = $debit;
							$check_val = "debit";

						}else{ 
							
							$credit = $journalArr[$in]['credit'];
							$journal_total = (intval($journal_total) + intval($credit));
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

					if ($debit != $grandtotal)  {
							
						$msg_e = "* Ooops Error, total debit not equal to amount entered";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'> hidePageLoader(); </script>"; exit;
						
					}elseif ($journal_total != $grandtotal)  {
							
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
				
				$payDetails = strip_tags($payDetails);
				$payDetails = str_replace('<br />', "\n", $payDetails);
				$payDetails = htmlspecialchars($payDetails);   
				
				if($earn1 == ""){$earn1 = 0;} if($earn2 == ""){$earn2 = 0;}  if($earn3 == ""){$earn3 = 0;}

				if($ded1 == ""){$ded1 = 0;} if($ded2 == ""){$ded2 = 0;} if($ded3 == ""){$ded3 = 0;}

				if($des1 == ""){$des1 = "Earning";} if($des2 == ""){$des2 = "Earning";} if($des3 == ""){$des3 = "Earning";}

				if($purp1 == ""){$purp1 = "Deduction";} if($purp2 == ""){$purp2 = "Deduction";} if($purp3 == ""){$purp3 = "Deduction";}

				$s_earn1 = $earn1."<.@.>".$des1;
				$s_earn2 = $earn2."<.@.>".$des2;
				$s_earn3 = $earn3."<.@.>".$des3;
				
				$s_ded1 = $ded1."<.@.>".$purp1;
				$s_ded2 = $ded2."<.@.>".$purp2;
				$s_ded3 = $ded3."<.@.>".$purp3;   

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
									
									$ebele_mark = "INSERT INTO $payrollTB  (acc, staff, bursar, salary, nsalary, tax, ded1, earn1, ded2, earn2, ded3, earn3, pmethod, 
																details, dpaid, upload, status)

											VALUES (:acc, :staff, :bursar, :salary, :nsalary, :tax, :ded1, :earn1, :ded2, :earn2, :ded3, :earn3, :pmethod, 
																:details, :dpaid, :upload, :status)";
								
									$igweze_prep = $conn->prepare($ebele_mark);
									$igweze_prep->bindValue(':acc', $acc);
									$igweze_prep->bindValue(':staff', $staff);
									$igweze_prep->bindValue(':bursar', $_SESSION['adminID']);
									$igweze_prep->bindValue(':salary', $salary);
									$igweze_prep->bindValue(':nsalary', $nsalary);
									$igweze_prep->bindValue(':tax', $tax);
									$igweze_prep->bindValue(':ded1', $s_ded1);
									$igweze_prep->bindValue(':earn1', $s_earn1);
									$igweze_prep->bindValue(':ded2', $s_ded2);
									$igweze_prep->bindValue(':earn2', $s_earn2);
									$igweze_prep->bindValue(':ded3', $s_ded3);
									$igweze_prep->bindValue(':earn3', $s_earn3);
									$igweze_prep->bindValue(':pmethod', $pmethod);
									$igweze_prep->bindValue(':details', $payDetails); 
									$igweze_prep->bindValue(':dpaid', $pDay);
									$igweze_prep->bindValue(':upload', $uploadedPic); 
									$igweze_prep->bindValue(':status', $fiVal);  
									$igweze_prep->execute();

									$transid = $conn->lastInsertId();  

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
											$igweze_prep_chart_1->bindValue(':jdate', $edate);
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
											$igweze_prep_chart_2->bindValue(':jdate', $edate);
											$igweze_prep_chart_2->bindValue(':jtime', $rtime); 
											$igweze_prep_chart_2->execute(); 

										}   

										$in++; $credit = $debit = ""; 

									}
									
									if (($igweze_prep == true)  
										&& ($igweze_prep_chart_1 == true) && ($igweze_prep_chart_2 == true)){  /* if sucessfully */

										$conn->commit(); 	
									
										$msg_s = "Journal Entry  & Payroll details was successfully saved and posted. $msgC"; 
										echo $succesMsg.$msg_s.$sEnd; 

										if($querytp == 2){
											$load_url = "$('#modal-load-div').load('payroll-manager.php', {'payroll': postVal, 'querytp': 2});
														//$('#load-journal-div').load('journal-chart-info.php');";
										}else{
											$load_url = "$('#modal-load-div').load('payroll-manager.php', {'payroll': postVal});
														 $('#load-payroll-info').load('payroll-info.php'); ";
										}

										echo "<script type='text/javascript'> 

												var postVal = 'add';
												$load_url
												//$('#modal-load-div').load('payroll-manager.php', {'payroll': postVal});	
												//$('#load-payroll-info').load('payroll-info.php'); 
												//$('#frmsavePayroll')[0].reset();
												//$('#modal-fobrain').modal('hide');
												hidePageLoader();  
											</script>";exit;
										
									}else{  /* display error */ 

										$conn->rollBack(); 	 
									 
										$msg_e =  "Ooops, an error has occur while to post Journal Entry and save Payroll details. Please try again";
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
						
						$ebele_mark = "INSERT INTO $payrollTB  (acc, staff, bursar, salary, nsalary, tax, ded1, earn1, ded2, earn2, ded3, earn3, pmethod, 
													details, dpaid, status)

								VALUES (:acc, :staff, :bursar, :salary, :nsalary, :tax, :ded1, :earn1, :ded2, :earn2, :ded3, :earn3, :pmethod, 
													:details, :dpaid, :status)";
					
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':acc', $acc);
						$igweze_prep->bindValue(':staff', $staff);
						$igweze_prep->bindValue(':bursar', $_SESSION['adminID']);
						$igweze_prep->bindValue(':salary', $salary);
						$igweze_prep->bindValue(':nsalary', $nsalary);
						$igweze_prep->bindValue(':tax', $tax);
						$igweze_prep->bindValue(':ded1', $s_ded1);
						$igweze_prep->bindValue(':earn1', $s_earn1);
						$igweze_prep->bindValue(':ded2', $s_ded2);
						$igweze_prep->bindValue(':earn2', $s_earn2);
						$igweze_prep->bindValue(':ded3', $s_ded3);
						$igweze_prep->bindValue(':earn3', $s_earn3);
						$igweze_prep->bindValue(':pmethod', $pmethod);
						$igweze_prep->bindValue(':details', $payDetails); 
						$igweze_prep->bindValue(':dpaid', $pDay);
						$igweze_prep->bindValue(':status', $fiVal); 
						$igweze_prep->execute();

						$transid = $conn->lastInsertId();  

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
								$igweze_prep_chart_1->bindValue(':jdate', $edate);
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
								$igweze_prep_chart_2->bindValue(':jdate', $edate);
								$igweze_prep_chart_2->bindValue(':jtime', $rtime); 
								$igweze_prep_chart_2->execute(); 

							}   

							$in++; $credit = $debit = ""; 

						} 
						
						if (($igweze_prep == true)  
							&& ($igweze_prep_chart_1 == true) && ($igweze_prep_chart_2 == true)){  /* if sucessfully */

							$conn->commit(); 	
						
							$msg_s = "Journal Entry  & Payroll details was successfully saved and posted. $msgC"; 
							echo $succesMsg.$msg_s.$sEnd; 

							if($querytp == 2){
								$load_url = "$('#modal-load-div').load('payroll-manager.php', {'payroll': postVal, 'querytp': 2});
											//$('#load-journal-div').load('journal-chart-info.php');";
							}else{
								$load_url = "$('#modal-load-div').load('payroll-manager.php', {'payroll': postVal});
												$('#load-payroll-info').load('payroll-info.php'); ";
							}

							echo "<script type='text/javascript'> 

									var postVal = 'add';
									$load_url
									//$('#modal-load-div').load('payroll-manager.php', {'payroll': postVal});	
									//$('#load-payroll-info').load('payroll-info.php'); 
									//$('#frmsavePayroll')[0].reset();
									//$('#modal-fobrain').modal('hide');
									hidePageLoader();  
								</script>";exit;
							
						}else{  /* display error */ 

							$conn->rollBack(); 	 
							
							$msg_e =  "Ooops, an error has occur while to post Journal Entry and save Payroll details. Please try again";
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
							
						} 


					}catch(PDOException $e) {
						
						fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
				
					}    
					
				}	
			
		
			}
		
		}elseif ($_REQUEST['payroll'] == 'update') {  /* update payroll */

			$pid = cleanInt($_REQUEST['pid']);	
			$acc = cleanInt($_REQUEST['bank_acc']);		
			$staff = cleanInt($_REQUEST['staff']);
			$salary = clean($_REQUEST['salary']);
			$nsalary = clean($_REQUEST['nsalary']); 
			$tax = clean($_REQUEST['tax']);

			$earn1 =  clean($_REQUEST['earn1']);
			$des1 =  clean($_REQUEST['des1']);
			$earn2 =  clean($_REQUEST['earn2']);
			$des2 =  clean($_REQUEST['des2']);
			$earn3 =  clean($_REQUEST['earn3']);
			$des3 =  clean($_REQUEST['des3']); 

			$ded1 =  clean($_REQUEST['ded1']);
			$purp1 =  clean($_REQUEST['purp1']);
			$ded2 =  clean($_REQUEST['ded2']);
			$purp2 =  clean($_REQUEST['purp2']);
			$ded3 =  clean($_REQUEST['ded3']);
			$purp3 =  clean($_REQUEST['purp3']);   
			
			$pmethod = cleanInt($_REQUEST['pmethod']);
			$payDetails = $_REQUEST['payDetails'];
			$pDay = $_REQUEST['pDay'];		
			
			/* script validation */
			
			if ($pid == ""){
				
				$msg_e = "* Ooops, aan error has occur to retrieve staff payroll information. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}/*elseif ($acc == "")  {
				
				$msg_e = "* Ooops Error, please a debit account";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}*/elseif ($salary == "")  {
				
				$msg_e = "* Ooops Error, enter staff salary";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($nsalary == "")  {
				
				$msg_e = "* Ooops Error, please select student payroll ded2";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($nsalary > $salary)  {
				
				$msg_e = "* Ooops Error, your payroll salary  <strong>$salaryCur</strong> entered is greater than 
				payroll salary <strong>$salaryCur</strong>";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($pmethod == "")  {
				
				$msg_e = "* Ooops Error, please select a payroll pmethod";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($pDay == "")  {
				
				$msg_e = "* Ooops Error, please select a payroll date";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}else {	 /* update information */      		 
					
				$payDetails = strip_tags($payDetails);
				$payDetails = str_replace('<br />', "\n", $payDetails);
				$payDetails = htmlspecialchars($payDetails); 

				if($earn1 == ""){$earn1 = 0;} if($earn2 == ""){$earn2 = 0;}  if($earn3 == ""){$earn3 = 0;}

				if($ded1 == ""){$ded1 = 0;} if($ded2 == ""){$ded2 = 0;} if($ded3 == ""){$ded3 = 0;}

				if($des1 == ""){$des1 = "Earning";} if($des2 == ""){$des2 = "Earning";} if($des3 == ""){$des3 = "Earning";}

				if($purp1 == ""){$purp1 = "Deduction";} if($purp2 == ""){$purp2 = "Deduction";} if($purp3 == ""){$purp3 = "Deduction";}

				$s_earn1 = $earn1."<.@.>".$des1;
				$s_earn2 = $earn2."<.@.>".$des2;
				$s_earn3 = $earn3."<.@.>".$des3;
				
				$s_ded1 = $ded1."<.@.>".$purp1;
				$s_ded2 = $ded2."<.@.>".$purp2;
				$s_ded3 = $ded3."<.@.>".$purp3; 

				try { 
					
					$ebele_mark = "UPDATE $payrollTB  
										
										SET  

										salary = :salary, 
										nsalary = :nsalary, 
										tax = :tax, 
										ded1 = :ded1, 
										earn1 = :earn1, 
										ded2 = :ded2, 
										earn2 = :earn2, 
										ded3 = :ded3, 
										earn3 = :earn3, 
										pmethod = :pmethod,
										details = :details, 
										dpaid = :dpaid, 
										status = :status
										
									WHERE pid = :pid";
					
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':pid', $pid);
					//$igweze_prep->bindValue(':acc', $acc);
					$igweze_prep->bindValue(':salary', $salary);
					$igweze_prep->bindValue(':nsalary', $nsalary);
					$igweze_prep->bindValue(':tax', $tax);
					$igweze_prep->bindValue(':ded1', $s_ded1);
					$igweze_prep->bindValue(':earn1', $s_earn1);
					$igweze_prep->bindValue(':ded2', $s_ded2);
					$igweze_prep->bindValue(':earn2', $s_earn2);
					$igweze_prep->bindValue(':ded3', $s_ded3);
					$igweze_prep->bindValue(':earn3', $s_earn3);
					$igweze_prep->bindValue(':pmethod', $pmethod);
					$igweze_prep->bindValue(':details', $payDetails); 
					$igweze_prep->bindValue(':dpaid', $pDay);
					$igweze_prep->bindValue(':status', $fiVal);
					
					if($igweze_prep->execute()){  /* if sucessfully */ 
						
						$msg_s = "Staff payroll was successfully updated"; 
						echo $succesMsg.$msg_s.$sEnd; 
						echo "<script type='text/javascript'> 
								$('#load-payroll-info').load('payroll-info.php');
								hidePageLoader();   
							</script>";exit;
						
					}else{  /* display error */
			
						$msg_e =  "Ooops, an error has occur while to save staff payroll. Please try again";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
						
					} 

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				} 
			
		
			}
		
		}elseif ($_REQUEST['payroll'] == 'remove') {  /* remove payroll */

			$payroll = $_REQUEST['rData'];
			$adminPass =   clean($_REQUEST['adminPass']);  

			$checkDetail =  staffLoginData($conn, $_SESSION['adminUser']);  /* school staffs/teachers password details */ 			 
			list ($tID, $staffUser, $checkedPass, $staffName, $staff_fobrain_grdQ, $userGrade, $userAccess) = 
			explode ("@(.$*S*$.)@", $checkDetail);

			list($fobrainIg, $pid, $hName) = explode("-", $payroll);			
			
			/* script validation */ 
			
			if (($payroll == "")  || ($pid == "")){
				
				$msg_e = "* Ooops, an error has occur while to remove payroll payroll. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif(!password_verify($adminPass, $userAccess)){ 		 
		
				$msg_e = "* Ooops error, your admin authorization password is invalid.";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;

			}else {  /* remove information */   

				try { 
					
					$ebele_mark = "DELETE FROM 
					
									$payrollTB										
										
									WHERE pid = :pid
										
									LIMIT 1";
					
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':pid', $pid); 
					
					if($igweze_prep->execute()){  /* if sucessfully */
						
						$removeDiv = "$('#row-".$pid."').fadeOut(1000);";
						$msg_s = "<strong>$hName</strong> was successfully removed"; 
						echo $succesMsg.$msg_s.$sEnd; 
						echo "<script type='text/javascript'>   
								$removeDiv 
								hidePageLoader(); 
							</script>";exit;
						
					}else{  /* display error */
			
						$msg_e =  "Ooops, an error has occur while to remove payroll payroll. Please try again";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
						
					}
					

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				} 
		
			}
		
		}elseif ($_REQUEST['payroll'] == 'view') {  /* view payroll */
			
			$pid = strip_tags($_REQUEST['rData']);
			
			/* script validation */ 
			
			if ($pid == ""){
				
				$msg_e = "* Ooops, an error has occur while to retrieve payroll information.";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}else {  /* select information */  

				echo '<div class="row gutters my-10">
					<div class="col-12">';

					$page_title = '<i class="mdi mdi-cash-register fs-18"></i> 
								Payroll Information';
							pageTitle($page_title, 0);
						
				echo    '</div>	
				</div>';

				try { 
					
					$payrollArr = payrollInfo($conn, $pid);  /* school payroll array information */
					$prid = $payrollArr[$fiVal]["pid"];
					$staff = $payrollArr[$fiVal]["staff"];
					$bursar = $payrollArr[$fiVal]["bursar"];
					$transid = $payrollArr[$fiVal]["transid"];
					$salary = $payrollArr[$fiVal]["salary"];
					$nsalary = $payrollArr[$fiVal]["nsalary"];
					$salary_tax = $payrollArr[$fiVal]["tax"];
					$s_ded1 = $payrollArr[$fiVal]["ded1"];
					$s_earn1 = $payrollArr[$fiVal]["earn1"];
					$s_ded2 = $payrollArr[$fiVal]["ded2"];
					$s_earn2 = $payrollArr[$fiVal]["earn2"];
					$s_ded3 = $payrollArr[$fiVal]["ded3"];
					$s_earn3 = $payrollArr[$fiVal]["earn3"];
					$pmethod = $payrollArr[$fiVal]["pmethod"];
					$upload = $payrollArr[$fiVal]["upload"];
					$fDetail = htmlspecialchars_decode($payrollArr[$fiVal]["details"]);
						
					$dpaid = $payrollArr[$fiVal]["dpaid"];
					$pay_method = $payrollArr[$fiVal]["status"];  
									
					$dpaid = date("j F, Y", strtotime($dpaid));
					$month_date = date("F, Y", strtotime($dpaid));
					//$fDetail = nl2br($fDetail); 

					list ($earn1, $des1) = explode ("<.@.>", $s_earn1);
					list ($earn2, $des2) = explode ("<.@.>", $s_earn2);
					list ($earn3, $des3) = explode ("<.@.>", $s_earn3);

					list ($ded1, $purp1) = explode ("<.@.>", $s_ded1);
					list ($ded2, $purp2) = explode ("<.@.>", $s_ded2);
					list ($ded3, $purp3) = explode ("<.@.>", $s_ded3);

					if(($salary != "") && ($salary_tax != "")){
		
						$salary_per = ($salary * $salary_tax);
		
						$nsalary = ($salary - $salary_per); 

						$earn_t = intval($earn1) + intval($earn2) + intval($earn3);

						$ded_t = intval($ded1) + intval($ded2) + intval($ded3);
		
					}else{ $nsalary = $salary; }


					$earn1 = fobrainCurrency($earn1, $curSymbol);
					$earn2 = fobrainCurrency($earn2, $curSymbol);
					$earn3 = fobrainCurrency($earn3, $curSymbol);
					$ded1 = fobrainCurrency($ded1, $curSymbol);
					$ded2 = fobrainCurrency($ded2, $curSymbol);
					$ded3 = fobrainCurrency($ded3, $curSymbol);

					$salary = fobrainCurrency($salary, $curSymbol);   
					$nsalary = fobrainCurrency($nsalary, $curSymbol);
					$earn_t = fobrainCurrency($earn_t, $curSymbol);
					$ded_t = fobrainCurrency($ded_t, $curSymbol);
					$salary_per = fobrainCurrency($salary_per, $curSymbol);  

					$pay_mode = wizSelectArray($pmethod, $paymentMethodArr);  

					$ebele_mark = "SELECT t_id, i_title, i_picture, i_firstname, i_lastname, i_midname, i_gender, i_dob,  
							i_country, i_state, i_city, i_add_fi, i_add_se, i_phone, i_email, 
							school, d_appoint, app_type,  salary, taxid, bank, swift, accname, 
							accnum 

						FROM $staffTB

						WHERE t_id = :t_id";
						
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':t_id', $staff);
					$igweze_prep->execute();
					$rows_count = $igweze_prep->rowCount(); 
					
					if($rows_count == $foreal) {  /* check array is empty */

						while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {  /* loop array */		 

							$staff_id = $row['t_id']; 
							$pic = $row['i_picture']; 
							$title = $row['i_title'];
							$fname = $row['i_firstname'];
							$lname = $row['i_lastname'];
							$mname = $row['i_midname'];
							$gender = $row['i_gender']; 
							$dateofbirth = $row['i_dob'];
							$country = $row['i_country']; 
							$state = $row['i_state']; 
							$city = $row['i_city'];
							$add1 = $row['i_add_fi'];
							$add2 = $row['i_add_se'];
							$phone = $row['i_phone'];
							$email = $row['i_email']; 
							$school = $row['school']; 
							$d_appoint = $row['d_appoint'];  
							$app_type = $row['app_type'];   
							//$salary = $row['salary'];  
							$taxid = $row['taxid'];  
							$bank = $row['bank'];  
							$swift = $row['swift'];  
							$accname = $row['accname'];  
							$accnum = $row['accnum'];  
						}	 

						$staff_img = picture($staff_pic_ext, $pic, "staff");   
						$titleVal = wizSelectArray($title, $title_list); 
						$app_t = wizSelectArray($app_type, $appoint_list);
						$school_t = wizSelectArray($school, $school_list);  

					}else{

						$msg_e = "* Ooops, could not retrieve staff information.";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;

					} 
					
					$bursarData = staffData($conn, $bursar);
					list ($bursar_title, $bursar_fullname, $bursar_sex, $bursar_rankingVal, $bursar_picture, $bursar_lname, $bursar_phone, $bursar_sign) = explode ("#@s@#", $bursarData);
					$title_bur = wizSelectArray($bursar_title, $title_list);
					$bursarSign = picture($staff_doc_ext, $bursar_sign, "sign");

					$pay_upload = $fobrainPaymentDir.$upload; 
					
					if(($upload != "") && (file_exists($pay_upload))){  /* check if picture exits */ 

						$showQPicture ='
						<div class="col-xl-6 col-lg-6 col-md-6 col-12 text-left mt-30  bb-1 text-center"> 
							
							<img src = "'.$pay_upload.'"  class="img-fluid-flex mt-30 mb-15"> 
							<h4 class="bb-1 px-5-per"> Attachment </h4>
						</div>
						';  

					}else{
						$showQPicture = "";
					}
								

$pay_slip =<<<IGWEZE
	
										
					<div class="profile-wrapper mb-50"  id = 'fobrain-print'>		
						<div class="picture">
							<img src="$staff_img" alt="Profile Picture">
						</div>

						<div class="info">
							<h2 class="main-title">$titleVal $lname $fname $mname</h2>
							<span class="sub-title">$month_date Payslip  </span>
						</div> 
				
						<!-- row -->
						<div class="row gutters  text-left" style="text-align:left !important">
							<div class="col-12  my-20 bb-1 "> 
								<div class="row gutters">
										
									<div class="col-xl-6 col-lg-6 col-md-6 col-12 px-5-per py-5 fs-13 text-primary bb-1">
										<i class="mdi mdi-human-greeting-proximity"></i> Payment Mode: <span class="text-info">$pay_mode</span>
									</div>
									
									<div class="col-xl-6 col-lg-6 col-md-6 col-12 px-5-per py-5 fs-13 text-primary bb-1">
										<i class="mdi mdi-calendar-check"></i> PAID: <span class="text-info">$dpaid</span>
									</div>
									
									<div class="col-xl-6 col-lg-6 col-md-6 col-12 px-5-per py-5 fs-13 text-primary bb-1">
										<i class="mdi mdi-school-outline"></i> School: <span class="text-info">$school_t</span>
									</div>
								
									<div class="col-xl-6 col-lg-6 col-md-6 col-12 px-5-per py-5 fs-13 text-primary bb-1">
										<i class="mdi mdi-badge-account"></i> Appointment: <span class="text-info">$app_t</span>
									</div>
									
									<div class="col-xl-6 col-lg-6 col-md-6 col-12 px-5-per py-5 fs-13 text-primary bb-1">
										<i class="mdi mdi-calendar-account"></i> App. Date: <span class="text-info">$d_appoint</span>
									</div>
								
									<div class="col-xl-6 col-lg-6 col-md-6 col-12 px-5-per py-5 fs-13 text-primary bb-1">
										<i class="mdi mdi-comment"></i> Detail: <span class="text-info">$fDetail</span>
									</div>
									

										
								</div>
							</div>
							<div class="col-xl-6 col-lg-6 col-md-6 col-12 text-left mb-10">		
								<div class="row gutters">								
									<h4 class="text-success bb-1 px-5-per"> Earning </h4>
									<div class="col-xl-6 col-lg-6 col-md-6 col-12 px-5-per py-5 fs-13 text-info bb-1 des1">$des1</div>
									<div class="col-xl-6 col-lg-6 col-md-6 col-12 px-5-per py-5 fs-13 text-success bb-1"><span id="tax-ea-1" class="text-success">$earn1</span> </div>
									<div class="col-xl-6 col-lg-6 col-md-6 col-12 px-5-per py-5 fs-13 text-info bb-1 des2">$des2</div>
									<div class="col-xl-6 col-lg-6 col-md-6 col-12 px-5-per py-5 fs-13 text-success bb-1"><span id="tax-ea-2" class="text-success">$earn2</span> </div>
									<div class="col-xl-6 col-lg-6 col-md-6 col-12 px-5-per py-5 fs-13 text-info bb-1 des3">$des3</div>
									<div class="col-xl-6 col-lg-6 col-md-6 col-12 px-5-per py-5 fs-13 text-success bb-1"><span id="tax-ea-3" class="text-success">$earn3</span> </div>
								</div>
							</div>

							<div class="col-xl-6 col-lg-6 col-md-6 col-12 text-left">		
								<div class="row gutters">								
									<h4 class="text-danger  bb-1 px-5-per"> Deduction </h4>		
									<div class="col-xl-6 col-lg-6 col-md-6 col-12 px-5-per py-5 fs-13 text-info bb-1 purp1">$purp1</div>	
									<div class="col-xl-6 col-lg-6 col-md-6 col-12 px-5-per py-5 fs-13 text-danger bb-1"><span id="tax-de-1" class="text-danger">$ded1</span></div>						
									<div class="col-xl-6 col-lg-6 col-md-6 col-12 px-5-per py-5 fs-13 text-info bb-1 purp2">$purp2</div>	
									<div class="col-xl-6 col-lg-6 col-md-6 col-12 px-5-per py-5 fs-13 text-danger bb-1"><span id="tax-de-2" class="text-danger">$ded2</span></div>
									<div class="col-xl-6 col-lg-6 col-md-6 col-12 px-5-per py-5 fs-13 text-info bb-1 purp3">$purp3</div>	
									<div class="col-xl-6 col-lg-6 col-md-6 col-12 px-5-per py-5 fs-13 text-danger bb-1"><span id="tax-de-3" class="text-danger">$ded3</span></div>
								</div>
							</div>

							<div class="col-xl-6 col-lg-6 col-md-6 col-12 text-left my-10  bb-1"> 
								
							</div>
							<div class="col-xl-6 col-lg-6 col-md-6 col-12 text-left my-10 bb-1"> 
								<div class="row gutters"> 
									<div class="col-xl-6 col-lg-6 col-md-6 col-12 px-5-per py-10 fs-13 text-info bb-1">Basic Salary</div>
									<div class="col-xl-6 col-lg-6 col-md-6 col-12 px-5-per py-10 fs-13 text-success bb-1"><span id="to-salary" class="text-success">$salary</span></div> 
									<div class="col-xl-6 col-lg-6 col-md-6 col-12 px-5-per py-10 fs-13 text-info bb-1">Total Earning</div>
									<div class="col-xl-6 col-lg-6 col-md-6 col-12 px-5-per py-10 fs-13 text-success bb-1"><span id="tax-ea-to" class="text-success">$earn_t</span> </div>
									<div class="col-xl-6 col-lg-6 col-md-6 col-12 px-5-per py-10 fs-13 text-info bb-1">Total Deduction</div>
									<div class="col-xl-6 col-lg-6 col-md-6 col-12 px-5-per py-10 fs-13 text-danger bb-1"><span id="tax-de-to" class="text-danger">$ded_t</span></div>
									<div class="col-xl-6 col-lg-6 col-md-6 col-12 px-5-per py-10 fs-13 text-info bb-1"> Tax</div>
									<div class="col-xl-6 col-lg-6 col-md-6 col-12 px-5-per py-10 fs-13 text-danger bb-1"><span id="tax-descrip" class="text-danger">$salary_per</span></div>
									<div class="col-xl-6 col-lg-6 col-md-6 col-12 px-5-per py-10 fs-13 text-info bb-1">Net Salary</div>
									<div class="col-xl-6 col-lg-6 col-md-6 col-12 px-5-per py-10 fs-13 text-success bb-1"><span id="to-salary" class="text-success">$nsalary</span></div> 
								</div>
							</div>

							<div class="col-xl-6 col-lg-6 col-md-6 col-12 text-left mt-30  bb-1 text-center"> 
								<img src = "$sch_logo" class="img-h-150 rounded10 img-thumbnail mb-10">
								<img src = "$bursarSign" class="img-h-150 rounded10 img-thumbnail mb-10"> 
								<div class="mt-10 text-danger">Signed</div> 
							</div>
							<div class="col-xl-6 col-lg-6 col-md-6 col-12 text-left mt-30 bb-1"> 
								<div class="row gutters"> 
									<div class="col-3 px-5-per py-10 fs-12 text-primary bb-1">Bursary</div>
									<div class="col-9 px-5-per py-10 fs-12 text-info bb-1">$title_bur $bursar_fullname</div>
									<div class="col-3 px-5-per py-10 fs-12 text-primary bb-1">Payee</div>
									<div class="col-9 px-5-per py-10 fs-12 text-info bb-1"> $schoolNameTop</div>
									<div class="col-3 px-5-per py-10 fs-12 text-primary bb-1">Address</div>
									<div class="col-9 px-5-per py-10 fs-12 text-info bb-1"> $schoolAddressTop</div>
									<div class="col-3 px-5-per py-10 fs-12 text-primary bb-1">Phone</div>
									<div class="col-9 px-5-per py-10 fs-12 text-info bb-1"> $bursar_phone</div>
								</div>
							</div>
							$showQPicture
						</div>	
					</div>	

						
	
IGWEZE;
			
					echo $pay_slip;  

					try {

						accountJournalTB($conn, $pid, $transact_payroll);  /* account Journal table */ 

					}catch(PDOException $e) {

						fobrainDie( 'Ooops Database Error: ' . $e->getMessage());

					}
	 
					echo "<script type='text/javascript'> hidePageLoader(); </script>"; exit; 

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				} 
		
			}
		
		}elseif ($_REQUEST['payroll'] == 'edit') {  /* edit payroll */
			
			$pid = strip_tags($_REQUEST['rData']);
			
			/* script validation */ 
			
			if ($pid == ""){
				
				$msg_e = "* Ooops, an error has occur while to retrieve payroll information. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}else {       			


				try { 

					//$burConfigsArray = bursaryConfigsArrays($conn);  /* school bursary configuration  */  
					$payrollArr = payrollInfo($conn, $pid);

					$prid = $payrollArr[$fiVal]["pid"];
					$staff = $payrollArr[$fiVal]["staff"];
					$accID = $payrollArr[$fiVal]["acc"];
					$salary = intval($payrollArr[$fiVal]["salary"]);
					$nsalary = $payrollArr[$fiVal]["nsalary"];
					$salary_tax = $payrollArr[$fiVal]["tax"];
					$s_ded1 = $payrollArr[$fiVal]["ded1"];
					$s_earn1 = $payrollArr[$fiVal]["earn1"];
					$s_ded2 = $payrollArr[$fiVal]["ded2"];
					$s_earn2 = $payrollArr[$fiVal]["earn2"];
					$s_ded3 = $payrollArr[$fiVal]["ded3"];
					$s_earn3 = $payrollArr[$fiVal]["earn3"];
					$pmethod = $payrollArr[$fiVal]["pmethod"];
					$fDetail = htmlspecialchars_decode($payrollArr[$fiVal]["details"]); 
					$dpaid = $payrollArr[$fiVal]["dpaid"];
					$pay_method = $payrollArr[$fiVal]["status"]; 
						
					list ($earn1, $des1) = explode ("<.@.>", $s_earn1);
					list ($earn2, $des2) = explode ("<.@.>", $s_earn2);
					list ($earn3, $des3) = explode ("<.@.>", $s_earn3);

					list ($ded1, $purp1) = explode ("<.@.>", $s_ded1);
					list ($ded2, $purp2) = explode ("<.@.>", $s_ded2);
					list ($ded3, $purp3) = explode ("<.@.>", $s_ded3);


					//$salary_tax = $burConfigsArray[0]['stax']; 
		
					if(($salary != "") && ($salary_tax != "")){
		
						$salary_per = ($salary * $salary_tax);
		
						$nsalary = ($salary - $salary_per); 

						$earn_t = intval($earn1) + intval($earn2) + intval($earn3);

						$ded_t = intval($ded1) + intval($ded2) + intval($ded3);
		
					}else{ $nsalary = $salary; } 

						
						
					
?>

					<!-- form -->						
					<form class="form-horizontal" id="frmupdatePayroll" role="form"
					enctype="multipart/form-data"> 
						
						<!-- row -->
						<div class="row gutters display-none">	 
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
								<div class="field-wrapper select-wrapper"> 
									<select class="form-control"  name="staff" id="staff-payroll" required> 
										<option value = "">Search . . . >>>></option>							
										<?php
											try{
												$staff_arr = staffArrays($conn);  /* school staffs token information */  
												echo staffSelectBox($conn, $staff_arr, $staff, false);
											}catch(PDOException $e) {				
												fobrainDie( 'Ooops Database Error: ' . $e->getMessage());													
											}
										?>
									</select>
									<div class="icon-wrap"  id="wait" style="display: none;">
										<i class="loader"></i>
									</div>
									<div class="field-placeholder">Staff <span class="text-danger">*</span></div>													
								</div>
								<!-- field wrapper end -->
							</div>  
						</div>	
						<!-- /row --> 
							
						<?php 

						echo '
						<!-- row -->
						<div class="row gutters">
							<div class="col-12 text-center my-10  bb-1 px-5-per"> 
								<h4 class="text-info">Payroll Summary</h4>  
							</div>
							<div class="col-xl-6 col-lg-6 col-md-6 col-12 text-left mb-10">		
								<div class="row gutters">								
									<h4 class="text-success bb-1 px-5-per"> Earning </h4>
									<div class="col-6 px-5-per py-5 fs-13 text-info bb-1 des1">'.$des1.'</div>
									<div class="col-6 px-5-per py-5 fs-13 text-success bb-1">'.$curSymbol.'<span id="tax-ea-1" class="text-success">'.number_format($earn1, 2).'</span> </div>
									<div class="col-6 px-5-per py-5 fs-13 text-info bb-1 des2">'.$des2.'</div>
									<div class="col-6 px-5-per py-5 fs-13 text-success bb-1">'.$curSymbol.'<span id="tax-ea-2" class="text-success">'.$earn2.'</span> </div>
									<div class="col-6 px-5-per py-5 fs-13 text-info bb-1 des3">'.$des3.'</div>
									<div class="col-6 px-5-per py-5 fs-13 text-success bb-1">'.$curSymbol.'<span id="tax-ea-3" class="text-success">'.$earn3.'</span> </div>
								</div>
							</div>

							<div class="col-xl-6 col-lg-6 col-md-6 col-12 text-left">		
								<div class="row gutters">								
									<h4 class="text-danger  bb-1 px-5-per"> Deduction </h4>		
									<div class="col-6 px-5-per py-5 fs-13 text-info bb-1 purp1">'.$purp1.'</div>	
									<div class="col-6 px-5-per py-5 fs-13 text-danger bb-1">'.$curSymbol.'<span id="tax-de-1" class="text-danger">'.$ded1.'</span></div>						
									<div class="col-6 px-5-per py-5 fs-13 text-info bb-1 purp2">'.$purp2.'</div>	
									<div class="col-6 px-5-per py-5 fs-13 text-danger bb-1">'.$curSymbol.'<span id="tax-de-2" class="text-danger">'.$ded2.'</span></div>
									<div class="col-6 px-5-per py-5 fs-13 text-info bb-1 purp3">'.$purp3.'</div>	
									<div class="col-6 px-5-per py-5 fs-13 text-danger bb-1">'.$curSymbol.'<span id="tax-de-3" class="text-danger">'.$ded3.'</span></div>
								</div>
							</div>

							<div class="col-xl-6 col-lg-6 col-md-6 col-12 text-left my-10  bb-1"> 
								
							</div>
							<div class="col-xl-6 col-lg-6 col-md-6 col-12 text-left my-10 bb-1"> 
								<div class="row gutters"> 
									<div class="col-6 px-5-per py-10 fs-13 text-info bb-1">Total Earning</div>
									<div class="col-6 px-5-per py-10 fs-13 text-success bb-1">'.$curSymbol.'<span id="tax-ea-to" class="text-success">'.$earn_t.'</span> </div>
									<div class="col-6 px-5-per py-10 fs-13 text-info bb-1">Total Deduction</div>
									<div class="col-6 px-5-per py-10 fs-13 text-danger bb-1">'.$curSymbol.'<span id="tax-de-to" class="text-danger">'.$ded_t.'</span></div>
									<div class="col-6 px-5-per py-10 fs-13 text-info bb-1">  Tax</div>
									<div class="col-6 px-5-per py-10 fs-13 text-danger bb-1">'.$curSymbol.'<span id="tax-descrip" class="text-danger">'.$salary_per.'</span></div>
									<div class="col-6 px-5-per py-10 fs-13 text-info bb-1">Net Salary</div>
									<div class="col-6 px-5-per py-10 fs-13 text-success bb-1">'.$curSymbol.'<span id="to-salary" class="text-success">'.$nsalary.'</span></div> 
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

						<div class="row gutters">			
							<div class="col-xl-4 col-lg-4 col-md-4 col-12">										
								<!-- field wrapper start -->
								<div class="field-wrapper">
									<input type="number" class="form-control salary-target" name="salary"  id="salary"
									value = "'.$salary.'"  required>
									<div class="field-placeholder">  Staff Salary  <span class="text-danger">*</span></div>													
									<div class="form-text text-danger fs-13">
										'.$salary_tax.' tax applied  <!-- <a href="javascript:;" id="burs-config" class="text-info ps-20"> Edit Tax</a>-->
									</div>
								</div> 											
							</div>
							<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12">	 
								<input type="hidden" class="form-control" placeholder="" name="nsalary"  id="nsalary"
								value = "'.$nsalary.'" >
								<input type="hidden" class="form-control"  name="tax"  id="salary-tax"
								value = "'.$salary_tax.'"> 
							</div>																 
						</div>	
						<!-- /row --> 

						<!-- row -->
						<div class="row gutters">
							<div class="col-sm-6 col-sm-offset-1">
								<div class="row gutters">												
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<input type="number" class="form-control salary-target" placeholder="Salary Earning" name="earn1"  id="earn1"
										value = "'.$earn1.'">
										<div class="field-placeholder"> Salary Earning  <span class="text-danger"></span></div>													
									</div> 											
								</div>
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<input type="text" class="form-control salary-des" placeholder="Description" name="des1"  id="des1"
										value = "'.$des1.'">
										<div class="field-placeholder">  Description <span class="text-danger"></span></div>													
									</div> 											
								</div>																 
							
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<input type="number" class="form-control salary-target" placeholder="Salary Earning" name="earn2"  id="earn2"
										value = "'.$earn2.'">
										<div class="field-placeholder"> Salary Earning  <span class="text-danger"></span></div>													
									</div> 											
								</div>
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<input type="text" class="form-control salary-des" placeholder="Description" name="des2"  id="des2"
										value = "'.$des2.'">
										<div class="field-placeholder"> Description <span class="text-danger"></span></div>													
									</div> 											
								</div>																 
							
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<input type="number" class="form-control salary-target" placeholder="Salary Earning" name="earn3"  id="earn3"
										value = "'.$earn3.'">
										<div class="field-placeholder"> Salary Earning  <span class="text-danger"></span></div>													
									</div> 											
								</div>
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<input type="text" class="form-control salary-des" placeholder="Description" name="des3"  id="des3"
										value = "'.$des3.'">
										<div class="field-placeholder"> Description <span class="text-danger"></span></div>													
									</div> 											
								</div>
								</div>		
							</div>

							<div class="col-sm-6">
								<div class="row gutters">			
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<input type="number" class="form-control salary-target" placeholder="Salary Deduction" name="ded1"  id="ded1"
										value = "'.$ded1.'">
										<div class="field-placeholder"> Salary Deduction  <span class="text-danger"></span></div>													
									</div> 											
								</div>
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<input type="text" class="form-control salary-des" placeholder="Description" name="purp1"  id="purp1"
										value = "'.$purp1.'">
										<div class="field-placeholder">  Description <span class="text-danger"></span></div>													
									</div> 											
								</div>																 
							
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<input type="number" class="form-control salary-target" placeholder="Salary Deduction" name="ded2"  id="ded2"
										value = "'.$ded2.'">
										<div class="field-placeholder"> Salary Deduction  <span class="text-danger"></span></div>													
									</div> 											
								</div>
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<input type="text" class="form-control salary-des" placeholder="Description" name="purp2"  id="purp2"
										value = "'.$purp2.'">
										<div class="field-placeholder"> Description <span class="text-danger"></span></div>													
									</div> 											
								</div>																 
							
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<input type="number" class="form-control salary-target" placeholder="Salary Deduction" name="ded3"  id="ded3"
										value = "'.$ded3.'">
										<div class="field-placeholder"> Salary Deduction  <span class="text-danger"></span></div>													
									</div> 											
								</div>
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<input type="text" class="form-control salary-des" placeholder="Description" name="purp3"  id="purp3"
										value = "'.$purp3.'">
										<div class="field-placeholder"> Description <span class="text-danger"></span></div>													
									</div> 											
								</div>		
								</div> 
							</div>														 
						</div>	
						<!-- /row --> ';  
						?> 


						<!-- row -->
						<div class="row gutters">
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">										
								<!-- field wrapper start -->
								<div class="field-wrapper">
									<select class="form-control fob-select"  id="pmethod" name="pmethod" required>
										<option value = "">Search . . . >>>></option>
										<?php

											foreach($paymentMethodArr as $pmethodKey => $pmethodVal){  /* loop array */

												if ($pmethod == $pmethodKey){

													$selected = "SELECTED";

												} else {

													$selected = "";

												}

												echo '<option value="'.$pmethodKey.'"'.$selected.'>'.$pmethodVal.'</option>' ."\r\n";

											}

										?>  
									</select>
									<div class="field-placeholder">  Method <span class="text-danger">*</span></div>													
								</div>
								<!-- field wrapper end -->
							</div>	
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">									
								<!-- field wrapper start -->
								<div class="field-wrapper">
									<input type="date" value="<?php echo $dpaid; ?>" name="pDay"  required />
									<div class="field-placeholder"> Payment Date: <span class="text-danger">*</span></div>													
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
									<textarea rows="4" cols="10" class="form-control" name="payDetails" id="payDetails" 
									placeholder="Payment Details eg Bank Name, Teller ID, Cheque ID, Card Type "><?php echo $fDetail; ?></textarea>
									<div class="field-placeholder">  Detail <span class="text-danger"></span></div>													
								</div>
								<!-- field wrapper end -->
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
								<input type="hidden" name="payroll" value="update" />
								<input type="hidden" name="pid" value="<?php echo $prid; ?>" />
								<button type="submit" class="btn btn-primary waves-effect   
								btn-label waves-light demo-disenable" id="updatePayroll">
									<i class="mdi mdi-content-save label-icon"></i>  Update
								</button>
							</div>
						</div>	
						<!-- /row -->	 
								
					</form>  	
					<!-- / form -->		

					<script type="text/javascript">	   
						renderSelectImg("#staff-payroll", 1); 
						//renderSelect("#pmethod");  
						$('.fob-select').each(function() {  
							renderSelect($('#'+this.id)); 
						}); 
						//$("#bank_acc").change();
						hidePageLoader(); 
					</script> 
<?php 				 
					

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				} 
			
		
			}
		
		}elseif ($_REQUEST['payroll'] == 'add') {

			$querytp =  $_REQUEST['querytp'];

			echo '<div class="row gutters my-10">
                <div class="col-12">';

				$page_title = '<i class="mdi mdi-cash-register fs-18"></i> 
							Payroll Manager';
						pageTitle($page_title, 0);
                    
            echo    '</div>	
			</div>';

?> 	
			<!-- form -->
			<form class="form-horizontal mb-150" id="frmsavePayroll"
			enctype="multipart/form-data"> 

				<!-- row -->
				<div class="row gutters display-none">	 
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
									$accID  = "";
									//$bank_dataArr = bankAccountData($conn);  /* school expenses category array */
									//$bank_dataCount = count($bank_dataArr);
									
								}catch(PDOException $e) {
								
									fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
								
								}		
							/*
								if($bank_dataCount >= $fiVal){	/* check array is empty * /	 

									for($i = $fiVal; $i <= $bank_dataCount; $i++){	/* loop array * /	
									
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
								*/
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
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
						<!-- field wrapper start -->
						<div class="field-wrapper select-wrapper">								
							<select class="form-control"  name="staff" id="staff-payroll" required> 
								<option value = "">Search . . . >>>></option>							
								<?php
									try{
										$staff_arr = staffArrays($conn);  /* school staffs token information */ 
										echo staffSelectBox($conn, $staff_arr, "none", false);
									}catch(PDOException $e) {				
										fobrainDie( 'Ooops Database Error: ' . $e->getMessage());													
									}
								?>
							</select>
							<div class="icon-wrap"  id="wait" style="display: none;">
								<i class="loader"></i>
							</div>
							<div class="field-placeholder">Staff <span class="text-danger">*</span></div>													
						</div>
						<!-- field wrapper end -->
					</div>			
					<span id="result" style="display: none;"></span><!-- loading div -->
					
				</div>	
				<!-- /row --> 
					
				<div id="payroll-div" style="display:none;">  							 
					<!-- row -->
					<div class="row gutters">
						<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">									
							<!-- field wrapper start -->
							<div class="field-wrapper">
								<select class="form-control fob-select"  id="pmethod" name="pmethod" required>
									
									<option value = "">Search . . . >>>></option>
									<?php

									foreach($paymentMethodArr as $pmethodKey => $pmethodVal){  /* loop array */

										if ($pmethod == $pmethodKey){
											
											$selected = "SELECTED";
											
										} else {
											
											$selected = "";
											
										}

										echo '<option value="'.$pmethodKey.'"'.$selected.'>'.$pmethodVal.'</option>' ."\r\n";

									}

									?> 

								</select>
								<div class="field-placeholder"> Payment Method <span class="text-danger">*</span></div>													
							</div>
							<!-- field wrapper end -->
						</div>
						<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">		 							
							<!-- field wrapper start -->
							<div class="field-wrapper">
								<input type="date" value="<?php echo $dpaid; ?>" name="pDay"  class="chart-autofill"  data-code="journal-date" required />
								<div class="field-placeholder"> Payment Date: <span class="text-danger">*</span></div>													
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
								<textarea rows="4" cols="10" class="form-control" name="payDetails" id="payDetails" 
								placeholder="Payment Details eg Bank Name, Teller ID, Cheque ID, Card Type "></textarea>
								<div class="field-placeholder"> Payment Details <span class="text-danger"></span></div>													
							</div>
							<!-- field wrapper end -->
						</div>																 
					</div>	
					<!-- /row --> 							 
					
					<div class="text-center" id="waitDi" style="display: none;">
						<div class="spinner-border text-danger" role="status">
							<span class="visually-hidden">Loading...</span>
						</div>
					</div> 
					<span id="payStatusDiv" style="display: none;"></span> <!-- loading div --> 

					<?php  require ($bursaryDir.'journal-entry.php');  ?>										
						
					<!-- row -->
					<div class="row gutters justify-content-center my-20"> 
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

					<hr class="mt-30 mb-15 text-danger" />
					<!-- row -->
					<div class="row gutters modal-btn-footer">
						<div class="col-6 text-start">
							<button type="button" id="close-modal" class="btn btn-danger close-modal" 
							data-bs-dismiss="modal"> <i class="mdi mdi-window-close label-icon"></i> Close</button>
						</div>
						<div class="col-6 text-end">
							<input type="hidden" name="payroll" value="save" /> 
							<input type="hidden" name="querytp" value="<?php echo $querytp; ?>" />
							<button type="submit" class="btn btn-primary waves-effect   
							btn-label waves-light demo-disenable" id="savePayroll">
								<i class="mdi mdi-content-save label-icon"></i>  Save
							</button>
						</div>
					</div>	
					<!-- /row -->	 	
				</div>									
			</form>
			<!-- / form -->		  

			<script type="text/javascript">	   
				renderSelectImg("#staff-payroll", 1); 
				//renderSelect("#pmethod");   
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