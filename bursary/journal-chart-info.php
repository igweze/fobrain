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
	This script handle school accs category information
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

		define('fobrain', 'igweze');  /* define a check for wrong access of file */ 

		require 'fobrain-config.php';  /* load fobrain configuration files */
		
		$statem = "";

		if ($_REQUEST['search'] == 'range') {  /* select payroll date range */
				
			$startDate = cleanDate($_REQUEST['search-from']);
			$endDate = cleanDate($_REQUEST['search-to']);		
			$account = $_REQUEST['account']; 
			$startDate = trim($startDate); 
			$endDate = trim($endDate); 

			//list ($account, $acc_type, $st_type) = explode ("#fob#", $account_1);
			
			/* script validation */ 
			
			if ($startDate == "")  {
				
				$msg_e = "* Ooops Error, please select General Ledger date from";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>  
							$('.date-loader, #wait_chart_acc').hide(); 
							$('#reportrange').show(); 
						</script>"; exit;
				
			}elseif ($endDate == "")  {
				
				$msg_e = "* Ooops Error please select General Ledger date to";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>  
							$('.date-loader, #wait_chart_acc').hide(); 
							$('#reportrange').show(); 
						</script>"; exit;
				
			}else{
				
				try {

					if(($account == "") || ($account == "all")){
						$query = "";
					}else{
						$query = "account";
					} 
 					
					$accountJournalArr = accountJournalRange($conn, $startDate, $endDate, $account, $query);  /* school expenses range array */
					
					if (is_array($accountJournalArr)){
							$accountCount = count($accountJournalArr);
					}else{ $accountCount = $i_false; }
				
				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				}	

			
			}

			$date1 = date_create($startDate);
			$date2 = date_create($endDate); 
			$start_date =  date_format($date1,'d F, Y');
			$end_date = date_format($date2,'d F, Y'); 
			$date_title = "<i class='mdi mdi-calendar-clock-outline label-icon'></i> $start_date - $end_date";

			echo "<script type='text/javascript'>  
							$('.date-loader, #wait_chart_acc').hide(); 
							$('#reportrange').show(); 
						</script>";  
					
		}elseif ($_REQUEST['search'] == 'trial') {  /* select payroll date range */
				
			$startDate = cleanDate($_REQUEST['search-from']);
			$endDate = cleanDate($_REQUEST['search-to']);		
			$account = $_REQUEST['account'];
			$statem = "trial";	
			$startDate = trim($startDate); 
			$endDate = trim($endDate); 

			//list ($account, $acc_type, $st_type) = explode ("#fob#", $account_1);
			
			/* script validation */ 
			
			if ($startDate == "")  {
				
				$msg_e = "* Ooops Error, please select General Ledger date from";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>  
							$('.date-loader, #wait_chart_acc').hide(); 
							$('#reportrange').show(); 
						</script>"; exit;
				
			}elseif ($endDate == "")  {
				
				$msg_e = "* Ooops Error please select General Ledger date to";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>  
							$('.date-loader, #wait_chart_acc').hide(); 
							$('#reportrange').show(); 
						</script>"; exit;
				
			}else{
				
				try { 
 					
					$journalTrialRange = journalTrialRange($conn, $startDate, $endDate);
					
					if (is_array($journalTrialRange)){
							$accountCount = count($journalTrialRange);
					}else{ $accountCount = $i_false; }
				
				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				}	

			
			}

			$date1 = date_create($startDate);
			$date2 = date_create($endDate); 
			$start_date =  date_format($date1,'d F, Y');
			$end_date = date_format($date2,'d F, Y'); 
			$date_title = "<i class='mdi mdi-calendar-clock-outline label-icon'></i> $start_date - $end_date";

			echo "<script type='text/javascript'>  
							$('.date-loader, #wait_chart_acc').hide(); 
							$('#reportrange').show(); 
						</script>";  
					
		}elseif ($_REQUEST['search'] == 'statement') {  /* select payroll date range */
				
			$startDate = cleanDate($_REQUEST['search-from']);
			$endDate = cleanDate($_REQUEST['search-to']);		
			$account = $_REQUEST['account'];
			$statem = $_REQUEST['statem'];	
			$startDate = trim($startDate); 
			$endDate = trim($endDate); 

			//list ($account, $acc_type, $st_type) = explode ("#fob#", $account_1);
			
			/* script validation */ 
			
			if ($startDate == "")  {
				
				$msg_e = "* Ooops Error, please select General Ledger date from";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>  
							$('.date-loader, #wait_chart_acc').hide(); 
							$('#reportrange').show(); 
						</script>"; exit;
				
			}elseif ($endDate == "")  {
				
				$msg_e = "* Ooops Error please select General Ledger date to";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>  
							$('.date-loader, #wait_chart_acc').hide(); 
							$('#reportrange').show(); 
						</script>"; exit;
				
			}else{
				
				try { 
 					
					$journalTrialRange = journalTrialRange($conn, $startDate, $endDate);
					
					if (is_array($journalTrialRange)){
							$accountCount = count($journalTrialRange);
					}else{ $accountCount = $i_false; }
				
				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				}	

			
			}

			$date1 = date_create($startDate);
			$date2 = date_create($endDate); 
			$start_date =  date_format($date1,'d F, Y');
			$end_date = date_format($date2,'d F, Y'); 
			$date_title = "<i class='mdi mdi-calendar-clock-outline label-icon'></i> $start_date - $end_date";

			echo "<script type='text/javascript'>  
							$('.date-loader, #wait_chart_acc').hide(); 
							$('#reportrange').show(); 
						</script>";  
					
		}else{								
					
			$date_title  = "";

			try {
			
				$accountJournalArr = accountJournalData($conn);  /* school bank account array */
				$accountCount = count($accountJournalArr);
				
			}catch(PDOException $e) {
			
				fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
				
			}	

		} 
			
		$show_tbID = "";
		$show_tbClass = "wiz-table-mul";
		
		echo "<script type='text/javascript'>  renderTB('wiz-table-mul'); </script>";  
		
?> 

		<?php if($statem == "trial"){ ?>	
 
		<div class="table-responsive">
			<!-- table -->
			<table  class='table table-hover table-responsive style-table wiz-table-mul' id="<?php echo $show_tbID; ?>">
			
				<thead>  

					<tr>
						<td colspan="4"  style="text-align:center !important;">
							<div class="row">							
								
								<div class="col-12 text-center fs-20">
									<img src="<?php echo $sch_logo; ?>" alt="School Logo"  
									class='img-circle img-64 me-15'/><?php echo $schoolNameTop; ?> 
								</div>
								 						
							</div>  
						</td>  
					</tr>

					<tr>
						<th colspan="4"  style="text-align:center !important;">
							<h4 class="text-primary fs-16">Trial Balance</h4>
							<h6 class="text-danger fs-12"> <?php echo $date_title; ?></h6>
						</th>  
					</tr>

					<tr>
						<th>S/N</th>  
						<th>Account</th> 
						<th>Debit (<?php echo $curSymbol; ?>)</th>
						<th>Credit (<?php echo $curSymbol; ?>)</th>
						<!--<th>Balance (<?php echo $curSymbol; ?>)</th> -->
					</tr> 
					 
				</thead> 
				<tbody> 

        <?php 		
				 
				
				$grand_credit = 0;
				$grand_debit = 0;
				$grand_balance = 0; 
				$serial_no = 1;
					 	 
				foreach ($journalTrialRange as $account){ 
					 
					if($account == ""){ goto nextrow; } 

					$journalTrialRow = journalTrialRow($conn, $startDate, $endDate, $account);

					list ($debit, $credit, $balance) = explode ("#fob#", $journalTrialRow);
					
					$credit_con = fobrainCurrency($credit, $curSymbol);  /* school currency information*/
					$debit_con = fobrainCurrency($debit, $curSymbol);  /* school currency information*/
					$balance_con = fobrainCurrency($balance, $curSymbol);  /* school currency information*/

					$account_info = chartName($conn, $account); 
					list ($account, $acc_type, $st_type, $st_group) = explode ("#fob#", $account_info);
 
					$grand_credit += floatval($credit);
					$grand_debit += floatval($debit);
					$grand_balance += floatval($balance); 

$account_row =<<<IGWEZE
        
						<tr id="row-$serial_no">
							<td>$serial_no</td>  
                            <td>$account</td>  
                            <td>$debit_con</span></td>
                            <td>$credit_con</span></td>
                           <!-- <td>$balance_con</span></td> -->
						</tr>
		
IGWEZE;
					                              
					echo $account_row; 

					$serial_no++;  

					nextrow:

				} 


				$grand_balance = floatval($grand_debit) - floatval($grand_credit); 
						
				 
		
	?>
					
				</tbody>	
				<tfoot> 

					<tr>
						<th colspan="2" style="text-align:right">Grand Total:</th>
						<th class="bb-1-account"><?php echo $curSymbol.number_format($grand_debit, 2); ?></th>
						<th class="bb-1-account"><?php echo $curSymbol.number_format($grand_credit, 2); ?></th>
						<!--<th><?php echo $curSymbol.number_format($grand_balance, 2); ?></th> -->
					</tr> 
					
				</tfoot> 
			</table>				
			<!-- / table -->
		</div>	
		
		<?php }elseif($statem == "income"){ ?>

			<div class="row gutters">
			<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">

			<div class="table-responsive">
			<!-- table -->
			<table  class='table table-hover table-responsive style-table <?php echo $show_tbClassa; ?>' id="<?php echo $show_tbIDa; ?>">
			
				<thead>  

					<tr>
						<td colspan="2"  style="text-align:center !important;">
							<div class="row">							
								
								<div class="col-12 text-center fs-20">
									<img src="<?php echo $sch_logo; ?>" alt="School Logo"  
									class='img-circle img-64 me-15'/><?php echo $schoolNameTop; ?> 
								</div>
								 						
							</div>  
						</td>  
					</tr>
					<tr>
						<th colspan="2"  style="text-align:center !important;"> 
                            <h4 class="text-primary fs-16">INCOME STATEMENT</h4>
							<h6 class="text-danger fs-12"> <?php echo $date_title; ?></h6>
						</th>  
					</tr>
					<!--
					<tr> 
						<th>Account</th>  
						<th>Balance (<?php echo $curSymbol; ?>)</th> 
					</tr> 
					-->
					 
				</thead> 
				<tbody> 

        <?php 		
				 
				
				$grand_credit = 0;
				$grand_debit = 0;
				$grand_balance = 0; 
				$grand_balance_db = 0; 
				$grand_balance_cr = 0;
				$expense_row = ""; $credit_row = "";
					 	 
				foreach ($journalTrialRange as $account){ 
					 
					if($account == ""){ goto nextrow2; } 

					$journalTrialRow = journalTrialRow($conn, $startDate, $endDate, $account);

					list ($debit, $credit, $balance) = explode ("#fob#", $journalTrialRow);
					
					$credit_con = fobrainCurrency($credit, $curSymbol);  /* school currency information*/
					$debit_con = fobrainCurrency($debit, $curSymbol);  /* school currency information*/
					$balance_con = fobrainCurrency($balance, $curSymbol);  /* school currency information*/

					$account_info = chartName($conn, $account); 
					list ($account, $acc_type, $st_type, $st_group) = explode ("#fob#", $account_info);        

					//$grand_credit += floatval($credit);
					//$grand_debit += floatval($debit);
					//$grand_balance += floatval($balance); 

					if($st_type != 2){ goto nextrow2; }

					if($st_group == 1){
						
						$grand_balance_db += floatval($credit);
						$amount_bal = $credit_con;

                    }elseif($st_group == 2){  

						$grand_balance_cr += floatval($debit);
						$amount_bal = $debit_con;

                    }else{
						
					}

$account_row =<<<IGWEZE
        
						<tr> 
                            <td>$account</td>   
                            <td>$amount_bal</span></td> 
						</tr>
		
IGWEZE;
					                              
					//echo $account_row; 

                    if($st_group == 1){ 
                        
						$expense_row .= $account_row;

                    }elseif($st_group == 2){

                         $credit_row .= $account_row; 

                    }else{

					}

					$serial_no++;  

					nextrow2: 

				} 
						
				$expense_total = fobrainCurrency($grand_balance_db, $curSymbol);
				$credit_total = fobrainCurrency($grand_balance_cr, $curSymbol);  

				echo "<tr>
						<th colspan='2'>Profit</th> 
					</tr>";
				echo $expense_row; 
				echo "<tr>
						<th>Gross Profit</th>  
						<td class='fw-700 text-success'>$expense_total</td>  
					</tr>";	


				echo "<tr>
						<th colspan='2'>Operating Expenses</th>   
					</tr>";
				echo $credit_row; 
				echo "<tr>
						<th>Total Operating Expenses</th>  
						<td class='bb-1-account fw-700 text-danger'>$credit_total</td>  
					</tr>";	

				$net_total = floatval($grand_balance_db) - floatval($grand_balance_cr); 
				$net_total_con = fobrainCurrency($net_total, $curSymbol);	

				if($net_total > 1){
					$net_style = "text-success";
					$net_title = "Profit";
				}else{ 
					$net_style = "text-danger";
					$net_title = "Lost";
				} 
	?>
					
				</tbody>	
				<tfoot> 

					<tr>
						<th>Net <?php echo $net_title; ?>:</th>						 
						<th class="bb-1-account <?php echo $net_style; ?>"><?php echo $net_total_con; ?></th> 
					</tr>  
					
				</tfoot> 
			</table>				
			<!-- / table -->
		</div>	
		
		</div>
		</div>	
		<!-- /row -->

		<?php }elseif($statem == "balance"){ ?>
		

			<div class="row gutters">
			<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">

			<div class="table-responsive">
			<!-- table -->
			<table  class='table table-hover table-responsive style-table <?php echo $show_tbClassa; ?>' id="<?php echo $show_tbIDa; ?>">
			
				<thead>  

					<tr>
						<td colspan="2"  style="text-align:center !important;">
							<div class="row">							
								
								<div class="col-12 text-center fs-20">
									<img src="<?php echo $sch_logo; ?>" alt="School Logo"  
									class='img-circle img-64 me-15'/><?php echo $schoolNameTop; ?> 
								</div>
								 						
							</div>  
						</td>  
					</tr>

					<tr>
						<th colspan="2"  style="text-align:center !important;"> 
                            <h4 class="text-primary fs-16">BALANCE STATEMENT</h4>
							<h6 class="text-danger fs-12"> <?php echo $date_title; ?></h6>
						</th>  
					</tr>
					<!--
					<tr> 
						<th>Account</th>  
						<th>Balance (<?php echo $curSymbol; ?>)</th> 
					</tr> 
					-->
					 
				</thead> 
				<tbody> 

        <?php 		
				 
				
				$grand_credit = 0;
				$grand_debit = 0;
				$grand_balance = 0; 
				 
					 	 
				foreach ($journalTrialRange as $account){ 
					 
					if($account == ""){ goto nextrow3; } 

					$journalTrialRow = journalTrialRow($conn, $startDate, $endDate, $account);

					list ($debit, $credit, $balance) = explode ("#fob#", $journalTrialRow);
					
					$credit_con = fobrainCurrency($credit, $curSymbol);  /* school currency information*/
					$debit_con = fobrainCurrency($debit, $curSymbol);  /* school currency information*/
					$balance_con = fobrainCurrency($balance, $curSymbol);  /* school currency information*/

					$account_info = chartName($conn, $account); 
					list ($account, $acc_type, $st_type, $st_group) = explode ("#fob#", $account_info);
 
					//$grand_credit += floatval($credit);
					//$grand_debit += floatval($debit);
					//$grand_balance += floatval($balance);  

					if($st_type == 2){  

						if($st_group == 1){
							
							$grand_balance_db += floatval($credit); 

						}elseif($st_group == 2){  

							$grand_balance_cr += floatval($debit); 

						}else{
							
						}

					}

					if($st_type != 1){ goto nextrow3; }

					if($acc_type == 1){
						
						$asset_sum += floatval($balance);
						$amount_bal = $balance_con;

                    }elseif($acc_type == 2){  

						$asset_sum_2 += floatval($balance);
						$amount_bal = $balance_con;

                    }elseif($acc_type == 3){  

						$balance_con = fobrainCurrency(abs($balance), $curSymbol);  /* school currency information*/
						$liability_sum += floatval(abs($balance)); //$debit
						$amount_bal = $balance_con;//$debit_con;

                    }elseif($acc_type == 4){  

						$balance_con = fobrainCurrency(abs($balance), $curSymbol);  /* school currency information*/
						$liability_sum += floatval(abs($balance)); //$debit
						$amount_bal = $balance_con;//$debit_con;

                    }elseif($acc_type == 5){  

						//$a = 'How are you?';
						$search = 'Drawing';
						if(preg_match("/{$search}/i", $account)) {
							$equity_total += floatval($balance);
						}else{
							$equity_total += floatval(abs($balance));
							$balance_con = fobrainCurrency(abs($balance), $curSymbol);  /* school currency information*/
						} 		

						//$equity_total += floatval($credit);
						//$amount_bal = $credit_con;

						$amount_bal = $balance_con;

                    }else{
						
					}

$account_row =<<<IGWEZE
        
						<tr> 
                            <td>$account</td>   
                            <td>$amount_bal</span></td> 
						</tr>
		
IGWEZE;
					                              
					//echo $account_row; - $debit_con $credit_con $balance_con

                    if($acc_type == 1){ 
                        
						$asset_row .= $account_row;

                    }elseif($acc_type == 2){

                        $asset_row_2 .= $account_row; 

                    }elseif($acc_type == 3){

                        $liability_row .= $account_row; 

                    }elseif($acc_type == 4){

                        $liability_row_2 .= $account_row; 

                    }elseif($acc_type == 5){

                        $equity_row .= $account_row; 

                    }else{

					}

					$serial_no++;  

					nextrow3: 

				} 
					
				
				$net_total = floatval($grand_balance_db) - floatval($grand_balance_cr); 
				$net_total_con = fobrainCurrency($net_total, $curSymbol);	

				if($net_total > 1){
					$net_style = "text-success";
					$net_title = "Profit";
				}else{ 
					$net_style = "text-danger";
					$net_title = "Lost";
				}

				$asset_total = fobrainCurrency($asset_sum, $curSymbol);
				$asset_total_2 = fobrainCurrency($asset_sum_2, $curSymbol); 

                $asset_total_gr = floatval($asset_sum) + floatval($asset_sum_2); 
				$asset_total_gr_con = fobrainCurrency($asset_total_gr, $curSymbol);	

				$equity_total_gr = floatval($equity_total) + floatval($net_total); 
				$equity_total_con = fobrainCurrency($equity_total_gr, $curSymbol);	 

				echo "<tr>
						<th colspan='2'>Assets</th> 
					</tr>";
				echo "<tr>
						<th colspan='2'>Current Assets</th> 
					</tr>";	
				echo $asset_row; 
				echo "<tr>
						<th>Total Current Assets</th>  
						<td class='bb-1-account fw-700 text-primary'>$asset_total</td>  
					</tr>";	 
				 
				echo "<tr>
						<th colspan='2'>Non Current Assets</th> 
					</tr>";	
				echo $asset_row_2; 
				echo "<tr>
						<th>Total Non Current Assetst</th>  
						<td class='bb-1-account fw-700 text-primary'>$asset_total_2</td>  
					</tr>";	
					
				echo "<tr>
						<th>Total Assets</th>  
						<td class='bb-1-account fw-700 text-primary'>$asset_total_gr_con</td>  
					</tr>";	  

				echo "<tr>
						<th colspan='2'>Equity & Liabilities</th>   
					</tr>";
                echo "<tr>
						<th colspan='2'>Equity </th>   
					</tr>";    
				echo $equity_row; 
				echo "<tr>
						<th>Net $net_title</th>  
						<td class='bb-1-account fw-700 $net_style'>$net_total_con</td>  
					</tr>";
					
				echo "<tr>
						<th>Total Equity </th>  
						<td class='bb-1-account fw-700 text-primary'>$equity_total_con</td>  
					</tr>";	

                $liability_total = fobrainCurrency($liability_sum, $curSymbol);
				$liability_total_2 = fobrainCurrency($liability_sum_2, $curSymbol); 

                $liability_total_gr = floatval($liability_sum) + floatval($liability_sum_2); 
				$liability_total_gr_con = fobrainCurrency($liability_total_gr, $curSymbol);
				
				$equi_liab_total_gr = floatval($liability_total_gr) + floatval($equity_total_gr); 
				$equi_liab_total_gr_con = fobrainCurrency($equi_liab_total_gr, $curSymbol);

				echo "<tr>
						<th colspan='2'>Liabilities</th> 
					</tr>";
				echo "<tr>
						<th colspan='2'>Current Liabilities</th> 
					</tr>";	
				echo $liability_row; 
				echo "<tr>
						<th>Total Current Liabilitie</th>  
						<td class='bb-1-account fw-700 text-primary'>$liability_total</td>  
					</tr>";	

				 
				echo "<tr>
						<th colspan='2'>Non Current Liabilities</th> 
					</tr>";	
				echo $liability_row_2; 
				echo "<tr>
						<th>Total Non Current Liabilities</th>  
						<td class='bb-1-account fw-700 text-primary'>$liability_total_2</td>  
					</tr>";	
					
				echo "<tr>
						<th>Total Liabilities</th>  
						<td class='bb-1-account fw-700 text-primary'>$liability_total_gr_con</td>  
					</tr>";	   
					
				echo "<tr>
						<th>Total Equity & Liabilities</th>  
						<td class='bb-1-account fw-700 text-primary'>$equi_liab_total_gr_con</td>  
					</tr>";	

					

				
				


	?>
					
				</tbody>	
				<!--
				<tfoot> 

					<tr>
						<th>Net Loss / Profit:</th>						 
						<th class="bb-1-account"><?php //echo $net_total; ?></th> 
					</tr>  
					
				</tfoot> 
				-->
			</table>				
			<!-- / table -->
		</div>	
		
		</div>
		</div>	
		<!-- /row -->


		<?php }else{ ?>

		<div class="table-responsive">
			<!-- table -->
			<table  class='table table-hover table-responsive style-table wiz-table-mul' id="<?php echo $show_tbID; ?>">
			
				<thead>   

					<tr>
						<th colspan="7" style="text-align:center !important;">
							<h4 class="text-primary fs-16">General Ledgers</h4>
							<h6 class="text-danger fs-12"> <?php echo $date_title; ?></h6>
						</th>  
					</tr>

					<tr>
						<th>S/N</th> 
						<th>Date</th> 
						<th>Discription</th> 
						<th>Account</th>
						<!--<th class="hide_cols">Account Type</th>-->
						<!--<th class="hide_cols">Statement Type</th>-->
						<th>Debit (<?php echo $curSymbol; ?>)</th>
						<th>Credit (<?php echo $curSymbol; ?>)</th>
						<!--<th>Balance (<?php echo $curSymbol; ?>)</th>-->
			
						<th>Tasks</th>
					</tr> 
					  
				</thead> 
				<tbody>


        <?php
						
				if($accountCount >= $fiVal){  /* check array is empty */
					
					$grand_credit = 0;
					$grand_debit = 0;
					$grand_balance = 0;
						
					for($i = $fiVal; $i <= $accountCount; $i++){	 

						$jid = $accountJournalArr[$i]['jid'];
						if($jid == ""){ goto nextrow4; }
						$tid = $accountJournalArr[$i]['transid']; 
						$transact = $accountJournalArr[$i]['transact'];
						$account = $accountJournalArr[$i]['account'];
						$credit = $accountJournalArr[$i]['credit'];
						$debit = $accountJournalArr[$i]['debit'];
						$descr = $accountJournalArr[$i]['descr'];
						$balance = $accountJournalArr[$i]['balance'];
						$jdate = $accountJournalArr[$i]['jdate'];
						$jtime = $accountJournalArr[$i]['jtime'];
						
						$credit_con = fobrainCurrency($credit, $curSymbol);  /* school currency information*/
						$debit_con = fobrainCurrency($debit, $curSymbol);  /* school currency information*/
						$balance_con = fobrainCurrency($balance, $curSymbol);  /* school currency information*/
 
						$account_info = chartName($conn, $account); 
                    	list ($account, $acc_type, $st_type) = explode ("#fob#", $account_info);

						$acc_type = wizSelectArray($acc_type, $account_type_arr);
						$st_type = wizSelectArray($st_type, $account_state_arr);

						$grand_credit += floatval($credit);
						$grand_debit += floatval($debit);
						$grand_balance += floatval($balance);

						if($transact == $transact_pay){ 

							$show_btn = "<p class='mb-10'>
											<a href='javascript:;' id='$tid' class ='view-payment text-slateblue btn waves-effect btn-label waves-light'>									
												<i class='mdi mdi-square-edit-outline label-icon'></i> View 
											</a>	
										</p>";
										$show_class_btn = "";

						}elseif($transact == $transact_sales){  

							$show_btn = 
							"<a href='javascript:;'  id='$tid-0' class ='view-transaction text-danger btn waves-effect btn-label waves-light'>
								<i class='mdi mdi-text-box-search label-icon'></i> View 									
							</a>"; 
							$show_class_btn = "";

						}elseif($transact == $transact_expense){ 

							$show_btn = 
							"<a href='javascript:;'  id='$tid' class ='view-expense2 text-danger btn waves-effect btn-label waves-light'>
								<i class='mdi mdi-text-box-search label-icon'></i> View  								
							</a>";
							$show_class_btn = "";


						}elseif($transact == $transact_payroll){ 

							$show_btn = 
							"<a href='javascript:;'  id='$tid' class ='view-payroll text-danger btn waves-effect btn-label waves-light'>
								<i class='mdi mdi-text-box-search label-icon'></i>   View  										
							</a>";

							$show_class_btn = ""; 

						}elseif($transact == $transact_m_payroll){ 

							$show_btn = 
							"<a href='javascript:;'  id='$tid' class ='view-payroll-m text-danger btn waves-effect btn-label waves-light'>
								<i class='mdi mdi-text-box-search label-icon'></i> View   									
							</a>";

							$show_class_btn = ""; 

						}elseif($transact == $transact_journal_entry){ 

							$show_btn = 
							"<a href='javascript:;'  id='$jid' class ='edit-journal-single text-danger btn waves-effect btn-label waves-light'>
								<i class='mdi mdi-text-box-search label-icon'></i> View 									
							</a>";

							$show_class_btn = "";

						}elseif($transact == $transact_journal_entry_m){ 

							$show_btn = 
							"<a href='javascript:;'  id='$jid' class ='edit-journal text-danger btn waves-effect btn-label waves-light'>
								<i class='mdi mdi-text-box-search label-icon'></i> View 									
							</a>";

							$show_class_btn = "";

						}else{ 
							
							$show_btn = "";
							$show_class_btn = "display-none";

						}

						$serial_no++;   

$account_row =<<<IGWEZE
        
						<tr id="row-$jid">
							<td>$serial_no</td> 
							<td class="hide_cols">$jdate</span></td>
                            <td class="hide_cols">$descr</span></td> 
                            <td>$account</td>  
                            <!--<td class="hide_cols">$acc_type</span></td>-->
							<!--<td class="hide_cols">$st_type</span></td>-->
                            <td>$debit_con</span></td>
                            <td>$credit_con</span></td>
                            <!--<td>$balance_con</span></td>-->
							<td> 
								<div class="btn-group $show_class_btn">
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
                                                             
						echo $account_row; 

						nextrow4:

					} 
						
				}


				if($grand_balance > 1){
					$net_style = "text-success";
					//$net_title = "Profit";
				}else{ 
					$net_style = "text-danger";
					//$net_title = "Lost";
				}
		
	?>
					
				</tbody>	
				<tfoot> 

					<tr>
						<th colspan="4" style="text-align:right">Grand Total:</th>
						<th class="bb-1-account"><?php echo $curSymbol.number_format($grand_debit, 2); ?></th>
						<th class="bb-1-account"><?php echo $curSymbol.number_format($grand_credit, 2); ?></th>
						<!--<th class="bb-1-account <?php echo $net_style; ?>"><?php echo $curSymbol.number_format($grand_balance, 2); ?></th>-->
						<th></th> 
					</tr>
					<tr>
						<th colspan="7">.</th> 
						 
					</tr> 
					<tr>
						<th colspan="5" style="text-align:right">Balance : </th> 
						<th class="bb-1-account <?php echo $net_style; ?>"><?php echo $curSymbol.number_format($grand_balance, 2); ?></th>
						<th></th> 
					</tr> 
					
				</tfoot> 
			</table>				
			<!-- / table -->
		</div>	
		

		<?php } ?>	

		 