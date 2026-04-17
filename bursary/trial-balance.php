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
	This script handle Trial Balance information
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

    	define('fobrain', 'igweze');  /* define a check for wrong access of file */

        require 'fobrain-config.php';  /* load fobrain configuration files */		 
		 
		if ($_REQUEST['search'] == 'account') {  /* select payroll date range */
				
			$start_date = cleanDate($_REQUEST['search-from']);
			$end_date = cleanDate($_REQUEST['search-to']);	
			$account = clean($_REQUEST['acc']);		
			//$start_date = trim($start_date); $end_date = trim($end_date);
			
			//$start_date = ""; $end_date = "";
			
			/* script validation */ 
			
			if ($start_date == "")  {
				
				$msg_e = "* Ooops Error, please select trial balance date from";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>  
							$('.date-loader').hide(); 
							$('#reportrange').show(); 
						</script>"; exit;
				
			}elseif ($end_date == "")  {
				
				$msg_e = "* Ooops Error please select trial balance date to";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>  
							$('.date-loader').hide(); 
							$('#reportrange').show(); 
						</script>"; exit;
				
			}elseif ($account == "")  {
				
				$msg_e = "* Ooops Error, please select bank account to search";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>  
							$('.date-loader, #wait_cat').hide(); 
							$('#reportrange').show(); 
						</script>"; exit;
				
			}else{  /* select fees range */
				
				try {
						
					$query_type = 2; $category = "";
					$trialBalanceArr = trialBalance($conn, $query_type, $account, $category, $start_date, $end_date);  /*  trial balance range array */
					
					if (is_array($trialBalanceArr)){   /* check if array */ 
						$trialBalanceCount = (count($trialBalanceArr) - 1);
					}else{ $trialBalanceCount = $i_false; }
				
				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				}	
			
			}

			echo "<script type='text/javascript'>  
							$('.date-loader, #wait_cat').hide(); 
							$('#reportrange').show(); 
						</script>"; 
					
					
		}elseif ($_REQUEST['search'] == 'range') {  /* select payroll date range */
				
			$start_date = cleanDate($_REQUEST['search-from']);
			$end_date = cleanDate($_REQUEST['search-to']);
			$account = clean($_REQUEST['acc']);		
			//$start_date = trim($start_date); 
			//$end_date = trim($end_date);	
			
			/* script validation */ 
			
			if ($start_date == "")  {
				
				$msg_e = "* Ooops Error, please select trial balance date from";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>  
							$('.date-loader, #wait_bal, #wait_cat').hide(); 
							$('#reportrange').show(); 
						</script>"; exit;
				
			}elseif ($end_date == "")  {
				
				$msg_e = "* Ooops Error please select trial balance date to";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>  
							$('.date-loader, #wait_bal, #wait_cat').hide(); 
							$('#reportrange').show(); 
						</script>"; exit;
				
			}else{  /* select fees range */
				
				try {
									
					$query_type = 2; $category = "";
					$trialBalanceArr = trialBalance($conn, $query_type, $account, $category, $start_date, $end_date);  /*  trial balance range array */
					
					if (is_array($trialBalanceArr)){   /* check if array */ 
						$trialBalanceCount = (count($trialBalanceArr) - 1);
					}else{ $trialBalanceCount = $i_false; }
				
				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				}	
			
			}
			echo "<script type='text/javascript'>  
							$('.date-loader, #wait_bal, #wait_cat').hide(); 
							$('#reportrange').show(); 
						</script>";  
					
					
		}elseif ($_REQUEST['search'] == 'category') {  /* select payroll date range */
				
			$start_date = cleanDate($_REQUEST['search-from']);
			$end_date = cleanDate($_REQUEST['search-to']);
			$account = clean($_REQUEST['acc']);
			$category = clean($_REQUEST['categ']);	 
			
			/* script validation */ 
			
			if ($start_date == "")  {
				
				$msg_e = "* Ooops Error, please select trial balance date from";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>   
							$('#wait_bal, #wait_cat, .date-loader').hide();
							$('#reportrange').show(); 
						</script>"; exit;
				
			}elseif ($end_date == "")  {
				
				$msg_e = "* Ooops Error please select trial balance date to";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>  
							$('#wait_bal, #wait_cat, .date-loader').hide();
							$('#reportrange').show(); 
						</script>"; exit;
				
			}elseif ($category == "")  {
				
				$msg_e = "* Ooops select a category to filter";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>  
							$('#wait_bal, #wait_cat, .date-loader').hide();
							$('#reportrange').show(); 
						</script>"; exit;
				
			}else{  /* select fees range */
				
				try {
									
					$query_type = 3; 
					$trialBalanceArr = trialBalance($conn, $query_type, $account, $category, $start_date, $end_date);  /*  trial balance range array */
					
					if (is_array($trialBalanceArr)){   /* check if array */ 
						$trialBalanceCount = (count($trialBalanceArr) - 1);
					}else{ $trialBalanceCount = $i_false; }
				
				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				}	
			
			}
			echo "<script type='text/javascript'>  
							$('#wait_bal, #wait_cat, .date-loader').hide();
							$('#reportrange').show(); 
						</script>";  
					
					
		}else{  /* select default trial balance range */ 
		 
			try {
				
				$query_type = ""; $start_date = ""; $end_date = ""; 
				$account = ""; $category = "";

				$trialBalanceArr = trialBalance($conn, $query_type, $account, $category, $start_date, $end_date);  /* trial balance range array */		 
				$trialBalanceCount = (count($trialBalanceArr) - 1);
				
			}catch(PDOException $e) {
			
				fobrainDie( 'Ooops Database Error: ' . $e->getMessage()); 
			}	

		}	

		if($render_table == 1){
			echo "<script type='text/javascript'>  renderTable(); </script>"; 
			$show_tbID = "";
			$show_tbClass = "wiz-table";
		}else{
			echo "<script type='text/javascript'>  renderTable2(); </script>"; 
			$show_tbID = "wiz-table";
			$show_tbClass = "";
		}
 
?>

				 
				<div class="table-responsive">
					<!-- table -->
					<table class='table table-hover table-responsive style-table <?php echo $show_tbClass; ?>' id="<?php echo $show_tbID; ?>">			 
						<thead>
							<tr>
								<th>S/N</th>  
                                <!--<th>Account</th>--> 
								<th>Title</th> 
								<th>Payer / Payee</th>
								<th>Credit</th>
								<th>Debit</th>
								<th>Balance <hr class="my-5 p-0 text-danger"/> Date</th>  
								<!--<th>Transaction</th> -->
								<th>Date</th>   
								<th>Tasks</th>
							</tr>
						</thead> 
						<tbody> 

					<?php
					  	
						if($trialBalanceCount >= $fiVal){  /* check array is empty */		 

							$grandTotalCredit = 0; 
							$grandTotalSale = 0; 
							$grandTotalDebit = 0; 
							$grandTotalBal = 0;
								
							for($i = $fiVal; $i <= $trialBalanceCount; $i++){  /* loop array */	
								
								$id = $trialBalanceArr[$i]["id"];
								$acc = $trialBalanceArr[$i]["acc"]; 
								$title = $trialBalanceArr[$i]["title"];
								$transact = $trialBalanceArr[$i]["transact"];
								$schoolID = $trialBalanceArr[$i]["school"];
								$client = $trialBalanceArr[$i]["client"]; 
								$amount = $trialBalanceArr[$i]["total1"];
								$balance = $trialBalanceArr[$i]["total2"];
								$date = $trialBalanceArr[$i]["timer"];
								$date2 = $trialBalanceArr[$i]["timer2"];
								//$fStatus = $trialBalanceArr[$i]["f_status"];
								//$confirm = $trialBalanceArr[$i]["pstatus"]; 
								
								$id = trim($id);    

								if($id == ""){
									goto nextrow;
								}
								
 								//$account_name = accountName($conn, $acc);

								if(($admin_grade == $bus_fobrain_grd) && ($admin_level == $bus_fob_tagged)) {  /* check if bursary */		

									$show_btn = "<p class='mb-10'>
													<a href='javascript:;' id='$id' class ='edit-payment text-slateblue btn waves-effect btn-label waves-light'>									
														<i class='mdi mdi-square-edit-outline label-icon'></i> View
													</a>	
												</p>
											 
												 "; 

								}else{ $show_btn = "";}	

                                if($transact == 1){

                                    $trans_status = "Credit";
									$title = feeCategoryName($conn, $title); 
									$amount_credit = fobrainCurrency($amount, $curSymbol);  /* school currency information*/
									$amount_debit = "-"; 

									require $fobrainSchoolTBS; /* include student database table information  */								
					
									$regNum = studentReg($conn, $client);  /* student registration number  */									
									$client_name = studentName($conn, $regNum);  /* student name  */					

									if($balance != 0.00){ 
										 
										$balanceCon = fobrainCurrency($balance, $curSymbol);  /* school currency information*/ 
										$grandTotalCredit += intval($balance);

									} 

									$grandTotalCredit += intval($amount); 

									$show_btn = "<p class='mb-10'>
													<a href='javascript:;' id='$id' class ='view-payment text-slateblue btn waves-effect btn-label waves-light'>									
														<i class='mdi mdi-square-edit-outline label-icon'></i> View
													</a>	
												</p>";

                                }elseif($transact == 2){

                                    $trans_status = "Sales/Credit";
									//$title = productCategoryName($conn, $title);
									$title = "Online Sales";
									//$client_name = "Products";
									$balanceCon = "";
									$amount = transactionTotal($conn, $id);
									$amount_credit = fobrainCurrency($amount, $curSymbol);  /* school currency information*/
									$amount_debit = "-";

									require $fobrainSchoolTBS; /* include student database table information  */								
					
									$regNum = studentReg($conn, $client);  /* student registration number  */									
									$client_name = studentName($conn, $regNum);  /* student name  */					

									$grandTotalSale += intval($amount);

									$show_btn = 
									"<a href='javascript:;'  id='$id-0' class ='view-transaction text-danger btn waves-effect btn-label waves-light'>
										<i class='mdi mdi-text-box-search label-icon'></i> View  											
									</a>"; 

                                }elseif($transact == 3){

                                    $trans_status = "Debit";
									$client_name = $client;
									$balanceCon = "";
									$amount_debit = fobrainCurrency($amount, $curSymbol);  /* school currency information*/
									$amount_credit = "-";

									$grandTotalDebit += intval($amount);

									$show_btn = 
									"<a href='javascript:;'  id='$id' class ='view-expense2 text-danger btn waves-effect btn-label waves-light'>
										<i class='mdi mdi-text-box-search label-icon'></i> View  											
									</a>";


                                }elseif($transact == 4){

                                    $trans_status = "Debit";
									$client_name = staffName($conn, $client);
									$title = "Payroll";
									$balanceCon = "";
									$amount_debit = fobrainCurrency($amount, $curSymbol);  /* school currency information*/
									$amount_credit = "-";

									$grandTotalDebit += intval($amount);

									$show_btn = 
									"<a href='javascript:;'  id='$id' class ='view-payroll text-danger btn waves-effect btn-label waves-light'>
										<i class='mdi mdi-text-box-search label-icon'></i> View  											
									</a>";


                                }else{ 
                                    $trans_status = "Unclassified";
									$show_btn = "";
                                }  
					
								$serial_no++;								

$transaction =<<<IGWEZE
        
								<tr id="row-$id">
									<td>$serial_no</td>  
									<!--<td>$account_name</td> -->
									<td>$title</td>	 
									<td>$client_name</td>
									<td>$amount_credit</td>
									<td>$amount_debit</td>
									<td>$balanceCon <hr class="my-5 p-0 text-danger"/> $date2</td>									
									<!--<td>$trans_status</td>-->  
									<td>$date</td>   
									<td> 
										<div class="btn-group">
											<a href="javascript:;" class="btna btn-tasks  waves-effect waves-light dropdown-toggle p-5" data-bs-toggle="dropdown" aria-haspopup="true"
											data-bs-display="static" aria-expanded="false">
												<i class="mdi mdi-dots-grid align-middle fs-18"></i>
											</a> 
											<div class="dropdown-menu dropdown-menu-lg-end p-10 dropdown-shadow end-0 animate__animated animate__flipInY">  
												$show_btn 
											</div>
										</div>  
									</td>
								</tr>
		
IGWEZE;
                               
								echo $transaction; 		
								$balanceCon = ""; $amountCon = "";	
								
								nextrow:

		                    }
 
							$grandTotalBal = (($grandTotalCredit + $grandTotalSale) - $grandTotalDebit);
								
								
						} 

				
 					?>           
                        
						</tbody>
						<tfoot>
							<tr>
								<th colspan="2"></th>
								<th style="text-align:right">Total - </th> 
								<th><?php echo $curSymbol.number_format($grandTotalCredit, 2); ?></th>  
								<th style="text-align:left"><?php echo $curSymbol.number_format($grandTotalDebit, 2); ?></th>
								<th colspan="3"></th>
							</tr>
							<tr>
								<th colspan="2"></th>
								<th style="text-align:right">Credit Sales Total - </th>
								<th colspan="5"><?php echo $curSymbol.number_format($grandTotalSale, 2); ?></th>  
							</tr>
							 
							<tr>
								<th colspan="2"></th>
								<th style="text-align:right">Income / Lost - </th>
								<th colspan="5"><?php echo $curSymbol.number_format($grandTotalBal, 2); ?></th>  
							</tr>
						</tfoot>
					</table>
					<!-- table -->
				</div>
						