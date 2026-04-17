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
		 
		if ($_REQUEST['payroll'] == 'save') {  /* save payroll */  
			 
			$input_arr = $_REQUEST['inputs']; 
			$journalArr = $_REQUEST['journals']; 
			$total_pay = clean($_REQUEST['total']);   
			$title = clean($_REQUEST['title']);
			$pmethod = 1;//cleanInt($_REQUEST['pmethod']);  
			$edate = $_REQUEST['jdate'];	 
			$rtime = date("Y-m-d H:i:s");   
			$transact = $transact_m_payroll; 
			$acc = 1;   
			
			/* script validation */
			
			if (!is_array($input_arr)) {
				 
				$msg_e = "* Ooops Error, no staff record was fetch";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($total_pay == "")  {
				
				$msg_e = "* Ooops Error, could not fetch Payroll Grand Total";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($title == "")  {
				
				$msg_e = "* Ooops Error, please enter journal title";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($edate == "")  {
				
				$msg_e = "* Ooops Error, please select a payroll date";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}else {   /* insert information */    

				$micro = str_replace(array('.',' '), array('',''), microtime());
				$transid = $micro.randomString($charset, 4); 
 
				$grandtotal = $total_pay;

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

				try {						
					
					$conn->beginTransaction();   /* begin transaction */ 

					foreach($input_arr as $input_key => $input_val){ 

						$staff = $input_arr[$input_key]['staff'];

						if($staff == ""){
							goto nextinsert;
						}

						$earning = $input_arr[$input_key]['earn_info'];
						$deduction = $input_arr[$input_key]['ded_info'];
						$tax = $input_arr[$input_key]['tax'];
						//$earn = $input_arr[$input_key]['earn'];
						//$ded = $input_arr[$input_key]['ded'];
						$salary = $input_arr[$input_key]['salary'];
						$nsalary = $input_arr[$input_key]['nsalary']; 
						
						if($earning != ""){

							list ($s_earn1, $s_earn2, $s_earn3) = explode ("#.fob.#", $earning);  
						
							list ($earn1, $des1) = explode ("(.@.)", $s_earn1);
							list ($earn2, $des2) = explode ("(.@.)", $s_earn2);
							list ($earn3, $des3) = explode ("(.@.)", $s_earn3);

						}
						
						if($deduction != ""){

							list ($s_ded1, $s_ded2, $s_ded3) = explode ("#.fob.#", $deduction);

							list ($ded1, $purp1) = explode ("(.@.)", $s_ded1);
							list ($ded2, $purp2) = explode ("(.@.)", $s_ded2);
							list ($ded3, $purp3) = explode ("(.@.)", $s_ded3);  
						}

						if($earn1 == ""){$earn1 = 0;} if($earn2 == ""){$earn2 = 0;}  if($earn3 == ""){$earn3 = 0;}

						if($des1 == ""){$des1 = "Earning";} if($des2 == ""){$des2 = "Earning";} if($des3 == ""){$des3 = "Earning";}

						if($ded1 == ""){$ded1 = 0;} if($ded2 == ""){$ded2 = 0;} if($ded3 == ""){$ded3 = 0;}                        

						if($purp1 == ""){$purp1 = "Deduction";} if($purp2 == ""){$purp2 = "Deduction";} if($purp3 == ""){$purp3 = "Deduction";}

						$s_earn1 = $earn1."<.@.>".$des1;
						$s_earn2 = $earn2."<.@.>".$des2;
						$s_earn3 = $earn3."<.@.>".$des3;
						
						$s_ded1 = $ded1."<.@.>".$purp1;
						$s_ded2 = $ded2."<.@.>".$purp2;
						$s_ded3 = $ded3."<.@.>".$purp3;    


						$ebele_mark = "INSERT INTO $payrollTB  (acc, staff, bursar, salary, nsalary, tax, ded1, earn1, ded2, earn2, ded3, earn3, pmethod, 
												transid, dpaid, status)

								VALUES (:acc, :staff, :bursar, :salary, :nsalary, :tax, :ded1, :earn1, :ded2, :earn2, :ded3, :earn3, :pmethod, 
													:transid, :dpaid, :status)";
					
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
						$igweze_prep->bindValue(':transid', $transid); 
						$igweze_prep->bindValue(':dpaid', $edate);
						$igweze_prep->bindValue(':status', $fiVal); 
						$igweze_prep->execute(); 

						$earn1 = 0; $earn2 = 0; $earn3 = 0;
						$ded1 = 0; $ded2 = 0; $ded3 = 0;     

						nextinsert:

					} 


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
							$load_url = "$('#modal-load-div').load('payroll-wizard.php', {'payroll': postVal, 'querytp': 2});
										//$('#load-journal-div').load('journal-chart-info.php');";
						}else{
							$load_url = "$('#modal-load-div').load('payroll-wizard.php', {'payroll': postVal});
											$('#load-payroll-info').load('payroll-info.php'); ";
						}

						echo "<script type='text/javascript'> 

								var postVal = 'add-multi';
								$load_url
								//$('#modal-load-div').load('payroll-wizard.php', {'payroll': postVal});	
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
		
		}elseif ($_REQUEST['payroll'] == 'view') {  /* view payroll */

			echo '<div class="row gutters my-10">
                <div class="col-12">';

				$page_title = '<i class="mdi mdi-cash-register fs-18"></i> 
							Payroll Information';
						pageTitle($page_title, 0);
                    
            echo    '</div>	
			</div>';	   
			
			$transid = strip_tags($_REQUEST['rData']);
			
			/* script validation */ 
			
			if ($transid == ""){
				
				$msg_e = "* Ooops, an error has occur while to retrieve payroll information.";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}else {  /* select information */  


                try {
			
                    $payrollArray = payrollArray($conn, $transid);  /* school payroll array */
                    $payrollCount = count($payrollArray); 
                    
                }catch(PDOException $e) {
                
                    fobrainDie( 'Ooops Database Error: ' . $e->getMessage()); 
                }	

?>


				<div class="table-responsive">
					<!-- table -->
					<table  class='table table-hover table-responsive style-table wiz-table'>			 
						<thead>
							<tr>
                            <th>S/N</th> 
							<th>Picture</th>  
                            <th>Names</th>
                            <th>Salary</th>
                            <th>Tax</th>
							<th>Earning</th>
							<th>Deduction</th>
                            <th>Paid</th>
							<!--<th>Account</th> --> 
                            <th>Date</th>
                            
							</tr>
						</thead> 
						<tbody>


					<?php

						$grandTotal = 0; $grandTotalBal = 0; $transTotal = 0;
						$earn_t = 0; $ded_t = 0; 
						$grand_total_tax = 0; $grand_total_earn = 0; $grand_total_ded = 0;

						if($payrollCount >= $fiVal){  /* check array is empty */	 
								
							for($i = $fiVal; $i <= $payrollCount; $i++){  /* loop array */	
								
								$pid = trim($payrollArray[$i]["pid"]);
								if($pid == ""){ goto nextrow; }
								$staff = $payrollArray[$i]["staff"];
								$transid = $payrollArray[$i]["transid"];
								$accID = $payrollArray[$i]["acc"];
                                $salary = $payrollArray[$i]["salary"];
								$nsalary = $payrollArray[$i]["nsalary"];
								$salary_tax = $payrollArray[$i]["tax"];
                                $dpaid = $payrollArray[$i]["dpaid"];
								$status = $payrollArray[$i]["status"]; 
                               
								$s_ded1 = $payrollArray[$i]["ded1"];
								$s_earn1 = $payrollArray[$i]["earn1"];
								$s_ded2 = $payrollArray[$i]["ded2"];
								$s_earn2 = $payrollArray[$i]["earn2"];
								$s_ded3 = $payrollArray[$i]["ded3"];
								$s_earn3 = $payrollArray[$i]["earn3"];
								$pmethod = $payrollArray[$i]["pmethod"];
								$fDetail = $payrollArray[$i]["details"];  

								list ($earn1, $des1) = explode ("<.@.>", $s_earn1);
								list ($earn2, $des2) = explode ("<.@.>", $s_earn2);
								list ($earn3, $des3) = explode ("<.@.>", $s_earn3);

								list ($ded1, $purp1) = explode ("<.@.>", $s_ded1);
								list ($ded2, $purp2) = explode ("<.@.>", $s_ded2);
								list ($ded3, $purp3) = explode ("<.@.>", $s_ded3);

								if(($salary != "") && ($salary_tax != "")){
			
									$sal_tax = ($salary * $salary_tax);
					
									//$nsalary_tax = ($salary - $salary_per);  
		
									$earn_t = intval($earn1) + intval($earn2) + intval($earn3);
		
									$ded_t = intval($ded1) + intval($ded2) + intval($ded3);

									$grand_total_tax += $sal_tax;
									$grand_total_earn += $earn_t;
									$grand_total_ded += $ded_t;
					
								} 
							  
								
								$dpaid = date("M,Y", strtotime($dpaid));  

								$grandTotal += intval($salary);
								$grandTotalBal += intval($nsalary);
								
								$salary = fobrainCurrency($salary, $curSymbol);   
								$nsalary = fobrainCurrency($nsalary, $curSymbol);
								$earn_t = fobrainCurrency($earn_t, $curSymbol);
								$ded_t = fobrainCurrency($ded_t, $curSymbol);
								$sal_tax = fobrainCurrency($sal_tax, $curSymbol);  
								
                                $staff_info = staffData($conn, $staff);  /* school staffs/teachers information */  
							 
                                list ($title, $fname, $sex, $rank, $pic, $lname) =  explode ("#@s@#", $staff_info);	

                                $titleVal = wizSelectArray($title, $title_list);
                                $staff_img = picture($staff_pic_ext, $pic, "staff");
                                $paystatus  = $payroll_list[$status];  
					
								$serial_no++;								

$payrollData =<<<IGWEZE
        
								<tr id='staff-row-$pid'>
                                    <td>$serial_no</td> 
                                    <td>                                              
                                        <a href='javascript:;' id='$staff' class ='view-staff-i'>                                                
                                            <img src = "$staff_img" class=" img-h-50 img-circle img-thumbnail">
                                        <a/> 
                                    </td>
									<td>                                              
                                        $titleVal  $fname 
                                    </td>                               
                                    <td>$salary</td>
                                    <td>$sal_tax</td>
									<td>$earn_t</td>
									<td>$ded_t</td>
                                    <td>$nsalary</td>
									<!--<td></td>-->
                                    <td>$dpaid</td>    
                                </tr>
		
IGWEZE;
                               
								echo $payrollData; 	
								$nsalary_tax = 0;	
								nextrow:						

		                    }
								
								
						} 

				
 					?>           
                        
						</tbody>
						<tfoot>
							<tr> 
								<th colspan="3" style="text-align:right">Grand Total:</th>
								<th><?php echo $curSymbol.number_format($grandTotal, 2); ?></th>
								<th><?php echo $curSymbol.number_format($grand_total_tax, 2); ?></th>
								<th><?php echo $curSymbol.number_format($grand_total_earn, 2); ?></th>
								<th><?php echo $curSymbol.number_format($grand_total_ded, 2); ?></th>
								<th><?php echo $curSymbol.number_format($grandTotalBal, 2); ?></th>
								<th colspan="2"></th> 
							</tr>
						</tfoot>
					</table>
					<!-- table -->
				</div> 

        <?php
				
 

                try {

                    accountJournalTB($conn, $transid, $transact_m_payroll);  /* account Journal table */ 

                }catch(PDOException $e) {

                    fobrainDie( 'Ooops Database Error: ' . $e->getMessage());

                }
	 
				echo "<script type='text/javascript'> hidePageLoader(); </script>"; exit; 

				 
		
			}
		
		}elseif ($_REQUEST['payroll'] == 'transfer') {  /* transfer payroll */  

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

			if($earn1 == ""){$earn1 = 0;} if($earn2 == ""){$earn2 = 0;}  if($earn3 == ""){$earn3 = 0;}

			if($ded1 == ""){$ded1 = 0;} if($ded2 == ""){$ded2 = 0;} if($ded3 == ""){$ded3 = 0;}

			if($des1 == ""){$des1 = "Earning";} if($des2 == ""){$des2 = "Earning";} if($des3 == ""){$des3 = "Earning";}

			if($purp1 == ""){$purp1 = "Deduction";} if($purp2 == ""){$purp2 = "Deduction";} if($purp3 == ""){$purp3 = "Deduction";}

			$s_earn1 = $earn1."(.@.)".$des1;
			$s_earn2 = $earn2."(.@.)".$des2;
			$s_earn3 = $earn3."(.@.)".$des3;
			
			$s_ded1 = $ded1."(.@.)".$purp1;
			$s_ded2 = $ded2."(.@.)".$purp2;
			$s_ded3 = $ded3."(.@.)".$purp3;  

			$earning = $s_earn1."#.fob.#".$s_earn2."#.fob.#".$s_earn3; 
            $deduction = $s_ded1."#.fob.#".$s_ded2."#.fob.#".$s_ded3;

			$earn_total = floatval($earn1) + floatval($earn2) + floatval($earn3); 
            $ded_total = floatval($ded1) + floatval($ded2) + floatval($ded3);
			

			echo "<script type='text/javascript'> 
				
				$('#nsalary-$staff').val('$nsalary');
				$('#staff-earn-$staff').val('$earning');
				$('#staff-ded-$staff').val('$deduction');
				$('#salary-earn-$staff').val('$earn_total');
				$('#salary-ded-$staff').val('$ded_total');
				
				var sum = 0;
				$('.payrow-total').each(function(){
					sum += +$(this).val();
				});
				$('.grand_total, .journal-debit1, .journal-credit2, .journal-balance').html(sum);
				$('.grand_total2').val(sum); 
				 
				$('.payroll-wrapper').hide(2000); 

				var elmnt2 = document.getElementById('#staff-row-$staff');
				elmnt2.scrollIntoView();

				hidePageLoader(); 
			
			</script>";exit;

		}elseif ($_REQUEST['payroll'] == 'load') {  /* load payroll */ 
			
			$staff = clean($_REQUEST['staff']); 
            $salary_tax = strip_tags($_REQUEST['tax']);
            $salary = strip_tags($_REQUEST['salary']);
            $nsalary = strip_tags($_REQUEST['nsalary']); 
            $earning = strip_tags($_REQUEST['earn']); 
            $deduction = strip_tags($_REQUEST['ded']);  

			/* script validation */ 

			if($salary_tax == ""){
				$salary_tax = 0.0;
			}
			 
			if ($staff == ""){
				
				$msg_e = "* Ooops, an error has occur while to retrieve payroll information. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}else {    

				try {  
					 
					if($earning != ""){

						
					}
				 
                    list ($s_earn1, $s_earn2, $s_earn3) = explode ("#.fob.#", $earning);  
						
					list ($earn1, $des1) = explode ("(.@.)", $s_earn1);
					list ($earn2, $des2) = explode ("(.@.)", $s_earn2);
					list ($earn3, $des3) = explode ("(.@.)", $s_earn3);

					list ($s_ded1, $s_ded2, $s_ded3) = explode ("#.fob.#", $deduction);

					list ($ded1, $purp1) = explode ("(.@.)", $s_ded1);
					list ($ded2, $purp2) = explode ("(.@.)", $s_ded2);
					list ($ded3, $purp3) = explode ("(.@.)", $s_ded3); 

					if($earn1 == ""){$earn1 = 0;} if($earn2 == ""){$earn2 = 0;}  if($earn3 == ""){$earn3 = 0;}

					if($ded1 == ""){$ded1 = 0;} if($ded2 == ""){$ded2 = 0;} if($ded3 == ""){$ded3 = 0;}

					if($des1 == ""){$des1 = "Earning";} if($des2 == ""){$des2 = "Earning";} if($des3 == ""){$des3 = "Earning";}

					if($purp1 == ""){$purp1 = "Deduction";} if($purp2 == ""){$purp2 = "Deduction";} if($purp3 == ""){$purp3 = "Deduction";}
						
		
					if(($salary != "") && ($salary_tax != "")){
		
						$salary_per = ($salary * $salary_tax);
		
						$nsalary = ($salary - $salary_per); 

						$earn_t = intval($earn1) + intval($earn2) + intval($earn3);

						$ded_t = intval($ded1) + intval($ded2) + intval($ded3);
		
					}else{ $nsalary = $salary; } 


					$staff_info = staffData($conn, $staff);  /* school staffs/teachers information */  
				  
					list ($title, $fname, $sex, $rank, $pic, $lname) =  explode ("#@s@#", $staff_info);	

					$titleVal = wizSelectArray($title, $title_list);
					$staff_img = picture($staff_pic_ext, $pic, "staff");

					$staff_name = "$titleVal $lname $fname"; 
						
					
?>

					<!-- form -->						
					<form class="form-horizontal" id="frmtransfer-payroll" role="form"
					enctype="multipart/form-data"> 
						
						 
						
						
						 
							
						<?php 

						echo '
						<!-- row -->
						<div class="row gutters">
							<div class="col-12 text-center my-10  bb-1 px-5-per"> 
								<h2 class="text-primary">Payroll Summary</h2>  
							</div>

							<div class="col-12 text-center fs-20 fw-700 my-15">
								<img src="'.$staff_img.'" alt="staff image"  
								class="img-circle img-64 me-15"/>
								'.$staff_name.' 
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

						<div class="display-none text-primary wiz-glower fs-14 text-center"> 
							<strong role="status">Processing...</strong>
							<div class="spinner-border ms-auto" aria-hidden="true"></div>
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


					 
 
						<div class="display-none text-primary date-loader fs-14"  id="waitDi"> 
							<strong role="status">Processing...</strong>
							<div class="spinner-border ms-auto" aria-hidden="true"></div>
						</div>	

						<!-- </div>
						<div class="text-center" id="waitDi-q" style="display: none;">
							<div class="spinner-border text-danger" role="status">
								<span class="visually-hidden">Loading...</span>
							</div>
						</div>  
						<span id="payStatusDiv" style="display: none;"></span>  <!- - loading div --> 
						
						<hr class="mt-30 mb-15 text-danger" />
						<!-- row -->
						<div class="row gutters modal-btn-footer">
							<div class="col-6 text-start">
								<button type="button" id="close-payroll" class="btn btn-danger" 
								> <i class="mdi mdi-window-close label-icon"></i> Close</button>
							</div>
							<div class="col-6 text-end">
								<input type="hidden" name="payroll" value="transfer" />
								<input type="hidden" name="staff" value="<?php echo $staff; ?>" />
								 
								<button type="submit" class="btn btn-primary waves-effect   
								btn-label waves-light" id="transfer-payroll">
									<i class="mdi mdi-content-save label-icon"></i>  Insert 
								</button>
							</div>
						</div>	
						<!-- /row -->	 
								
					</form>  	
					<!-- / form -->		

					<script type="text/javascript"> 
						/*
						$('.float-number').keypress(function(event) {
							if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
								event.preventDefault();
							}
						});
						*/
						 
						hidePageLoader(); 
					</script> 
<?php 				 
					

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				} 
			
		
			}
		
		}elseif ($_REQUEST['payroll'] == 'add-multi') {  /* load payroll */
		
			$querytp =  $_REQUEST['querytp'];

			echo '<div class="row gutters my-10">
                <div class="col-12">';

				$page_title = '<i class="mdi mdi-cash-register fs-18"></i> 
							Payroll Manager';
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
						<input type="text"  name="salary_taxes" id="salary_taxes"/>
						<div class="field-placeholder"> Tax: <span class="text-danger"></span></div>													
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
				
				<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 display-none">										
					<!-- field wrapper start -->
					<div class="field-wrapper">
						<input disabled type="text" id="grand_total" name="grand_total" class="form-control chart-autofill-1 float-number grand_total2"  data-code="journal-amount">
						<div class="field-placeholder"> Grand Total <span class="text-danger">*</span></div>													
					</div>
					<!-- field wrapper end -->
				</div>	 

			</div>	
			<!-- /row -->	 

			<!-- row -->
			<div class="row gutters my-30 py-30 payroll-wrapper display-none" style="border: 4px dashed #000000;">  
				<div class="col-12">		 
					<div id="payroll-wrap"> </div> 
				</div>	 
			</div>	
			<!-- /row -->	

			<div class="table-responsive mb-100">
				<!-- table -->
				<table  id='fob-payroll-tb' class='table table-hover table-responsive style-table wiz-tablea'>			
					<thead>
						<tr>
							<th>S/N</th>                         
							<th>Picture</th>
							<th>Name</th>
							<th>Bank</th>
							<th>Salary</th> 
							<th>Tax</th>
							<th>Earn</th>
							<th>Deduction</th>
							<th>Net Salary</th>
							<th>Tasks</th>
						</tr>
					</thead> 
					<tbody> 

					<?php 

						try { 

							$ebele_mark = "SELECT t_id, i_title, i_picture, i_firstname, i_lastname, i_midname, 
							salary, bank, accname, accnum, i_email, t_grade

								FROM $staffTB
								
								WHERE status = :status LIMIT 10";

							$igweze_prep = $conn->prepare($ebele_mark);
							$igweze_prep->bindValue(':status', $fiVal);

							$igweze_prep->execute();

							$rows_count = $igweze_prep->rowCount(); 

							if($rows_count >= $foreal) {  
									
								while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		

									$t_id = $row['t_id'];
									$title = $row['i_title'];
									$pic = $row['i_picture'];
									$fname = $row['i_firstname'];
									$lname = $row['i_lastname'];
									$mname = $row['i_midname']; 
									$salary = $row['salary'];
									$bank = $row['bank'];
									$accname = $row['accname'];
									$accnum = $row['accnum'];
									$email = $row['i_email'];
									$t_grade = $row['t_grade'];  

									$serial_no = $foreal++;  
									
									/*
									if(($t_grade == "") || ($t_grade == 0)){
										$admin_lev = "Staff";
									}else{
										$admin_lev = $adminRankingArr[$t_grade];
									} 
									*/
									
									$titleVal = wizSelectArray($title, $title_list); 
									$staff_img = picture($staff_pic_ext, $pic, "staff");

									$staff_earn_arr = "";
									 
									$nsalary = "";
									$tax = "";
									

									//$salary = fobrainCurrency($salary, $curSymbol);  /* school currency information*/

									//if(($admin_grade == $admin_fobrain_grd) && ($admin_level == $admin_tagged) ||
									// ($admin_grade == $hm_fobrain_grd) && ($admin_level == $hm_fob_tagged)) {	/* check if this user is the main admin or school head */
	
									 
	$table_ad =<<<IGWEZE

											<tr id='row-$serial_no'> 
												<td>$serial_no</td>
												<td>                                              
													<a href='javascript:;' id='$t_id' class ='view-staff-i'>                                                
														<img src = "$staff_img" class=" img-h-50 img-circle img-thumbnail">
													<a/> 
												</td>  
												<td>                                              
													<a href='javascript:;' id='$t_id' class ='view-staff-i'>                                                    
														$titleVal $lname $fname $mname
													<a/> 
													<input type='hidden' value="$t_id" class='payrow-staff'>
													<textarea rows="2" cols="10" 
													class="form-control display-none" name="staff-earn-$t_id" 
													id="staff-earn-$t_id">$staff_earn_arr</textarea>
													<textarea rows="2" cols="10" 
													class="form-control display-none" name="staff-ded-$t_id" 
													id="staff-ded-$t_id">$staff_earn_arr</textarea>
												</td>  
												<td>$bank <br /> $accname <br /> $accnum</td>
												<td><input type='text' value="$salary" id="salary-$t_id" class='payrow-price form-control input-amount' onkeyup='sumPayroll()'></td>
												<td><input type='text' value="$tax" id="tax-$t_id" class='payrow-tax form-control input-amount' onkeyup='sumPayroll()'></td>
												<td><input type='text' value="0" id="salary-earn-$t_id" class='payrow-earn form-control  input-amount' disabled></td>  
												<td><input type='text' value="0" id="salary-ded-$t_id" class='payrow-ded form-control  input-amount' disabled></td>  
												<td><input type='text' value="$nsalary" id="nsalary-$t_id" class='payrow-total form-control input-amount' disabled></td>  
												<td> 
												
												<a href='javascript:;' class = 'fs-13 text-primary load-payroll-details' id='staff-$t_id' data-code='staff-$t_id'> <i class='mdi mdi-book-plus-outline'></i><a>  
												<a href='javascript:;' class = 'fs-13 text-danger remove-row-payroll'> <i class='mdi mdi-book-remove-outline'></i><a>  
													<div class="btn-group display-none">
														<a href="javascript:;" class="btna btn-tasks  waves-effect waves-light dropdown-toggle p-5" data-bs-toggle="dropdown" aria-haspopup="true"
														data-bs-display="static" aria-expanded="false">
															<i class="mdi mdi-dots-grid align-middle fs-18"></i>
														</a> 
														<div class="dropdown-menu dropdown-menu-lg-end p-10 dropdown-shadow end-0 animate__animated animate__flipInY"> 
															<p class="mb-10">
																<a href='javascript:;' id='staff-$t_id' data-code='staff-$t_id' class ='load-payroll-details text-sienna btn waves-effect btn-label waves-light'>									
																	<i class="mdi mdi-text-box-search label-icon"></i> Insert 
																</a>	
															</p>
															<p class="mb-10">
																<a href='javascript:;' data-code='$serial_no' class ='remove-row-payroll text-slateblue btn waves-effect btn-label waves-light'>									
																	<i class="mdi mdi-square-edit-outline label-icon"></i> Remove
																</a>	
															</p> 
														</div>
													</div>  
												</td> 
											</tr>

	IGWEZE;

										echo $table_ad; 

									//}

								}


							}else{

								$msg_e = "Ooops, no staff record was found. Please start adding staffs bio data info";
								echo "<script type='text/javascript'> hidePageLoader();	</script>"; //exit; 	

							}

					}catch(PDOException $e) {

					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());

					}

	


	?>
					<tfoot> 

						<tr>
							<th colspan="7" style="text-align:right">Grand Total:</th>
							<th><?php echo $curSymbol ?> <span class="ms-10q grand_total"></span></th> 
							<th></th> 
						</tr> 
						
					</tfoot>         
					</tbody>
				</table>
				<!-- / table -->	
			</div>	  

			<?php  require ($bursaryDir.'journal-entry.php');  ?> 
			
			<hr class="mt-30 mb-15 text-danger" />
			<!-- row -->
			<div class="row gutters modal-btn-footer">
				<div class="col-6 text-start">
					<button type="button" id="close-modal" class="btn btn-danger close-modal" 
					data-bs-dismiss="modal"> <i class="mdi mdi-window-close label-icon"></i> Close</button>
				</div>
				<div class="col-6 text-end">
					<input type="hidden" name="querytp" value="<?php echo $querytp; ?>" />
					<button type="submit" class="btn btn-primary waves-effect   
					btn-label waves-light demo-disenable" onclick='savePayroll()'>
						<i class="mdi mdi-content-save label-icon"></i>  Save
					</button>
				</div>
			</div>	
			<!-- /row -->	 

			<script type="text/javascript"> 

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