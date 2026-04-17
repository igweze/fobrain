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
	This script handle school expenses information
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

     	define('fobrain', 'igweze');  /* define a check for wrong access of file */

        require 'fobrain-config.php';  /* load fobrain configuration files */		 
		 
		if ($_REQUEST['search'] == 'range') {  /* select payroll date range */
				
			$startDate = cleanDate($_REQUEST['search-from']);
			$endDate = cleanDate($_REQUEST['search-to']);		
			$startDate = trim($startDate); $endDate = trim($endDate); 
			
			/* script validation */ 
			
			if ($startDate == "")  {
				
				$msg_e = "* Ooops Error, please select expenses date from";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>  
							$('.date-loader').hide(); 
							$('#reportrange').show(); 
						</script>"; exit;
				
			}elseif ($endDate == "")  {
				
				$msg_e = "* Ooops Error please select expenses date to";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>  
							$('.date-loader').hide(); 
							$('#reportrange').show(); 
						</script>"; exit;
				
			}else{
				
				try {
											
					$expensesDataArr = expensesDataRange($conn, $startDate, $endDate);  /* school expenses range array */
					
					if (is_array($expensesDataArr)){
							$expensesDataCount = count($expensesDataArr);
					}else{ $expensesDataCount = $i_false; }
				
				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				}	

			
			}

			echo "<script type='text/javascript'>  
							$('.date-loader').hide(); 
							$('#reportrange').show(); 
						</script>";  
					
		}else{								
					
	
			try {
			
				$expensesDataArr = expensesData($conn);  /* school expenses array */
				$expensesDataCount = count($expensesDataArr);
				
			}catch(PDOException $e) {
			
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
				
			}	

		}	
 
		$account_name = "";				
?>

		<script type='text/javascript'> renderTable(); </script>
		<div class="table-responsive">
			<!-- table -->
			<table  class='table table-hover table-responsive style-table wiz-table'>

				<thead>
					<tr>
					<th>S/N</th> 
					<th>Title</th> 
					<!--<th>Link Account</th>--> 
					<th>Payee</th> 
					<th>Debit</th> 
					<th>Method</th> 
					<th>Date</th> 
					<th>Tasks</th>
					</tr>
				</thead> 
				<tbody>

       				 <?php
						$grandTotal = 0; $transTotal = 0;

						if($expensesDataCount >= $fiVal){  /* check array is empty */	 
							 
							for($i = $fiVal; $i <= $expensesDataCount; $i++){  /* loop array */
																 
								$eid = trim($expensesDataArr[$i]["eid"]);
								if($eid == ""){ goto nextrow; }
								$pageID = $expensesDataArr[$i]["pid"];
								$title = $expensesDataArr[$i]["title"];
								$payee = $expensesDataArr[$i]["payee"];
								$accID = $expensesDataArr[$i]["acc"];
								$expenseArray = unserialize($expensesDataArr[$i]["expense"]);
								$total = $expensesDataArr[$i]["total"];
								$method = $expensesDataArr[$i]["method"];
								$tags = $expensesDataArr[$i]["tags"]; 
								$memo = htmlspecialchars_decode($expensesDataArr[$i]["memo"]); 
								$date = $expensesDataArr[$i]["edate"];
								$rtime = $expensesDataArr[$i]["rtime"];
								$status = $expensesDataArr[$i]["status"];   

								//$account_name = accountName($conn, $accID); 

								$payMethod = $paymentMethodArr[$method];															
								$date = date("j M Y", strtotime($date));	
								
								$grandTotal += intval($total);

								$totalCon = fobrainCurrency($total, $curSymbol);  /* school currency information*/								

								if(($admin_grade == $bus_fobrain_grd) && ($admin_level == $bus_fob_tagged)) {  /* check if bursary */		

									$show_btn = "<!--<p class='mb-10'>
													<a href='javascript:;' id='$eid' class ='edit-expense text-slateblue btn waves-effect btn-label waves-light'>									
														<i class='mdi mdi-square-edit-outline label-icon'></i> Edit
													</a>	
												</p>-->
												<p>
													<a href='javascript:;' id='fobrain-$eid-amanda' class ='remove-expense text-danger btn waves-effect btn-label waves-light'>									
														<i class='mdi mdi-delete label-icon'></i> Delete
													</a>	
												</p>";


								}else{ 

									$show_btn = "";
								}
					
								$serial_no++;								

$expensesData =<<<IGWEZE
        
								<tr id="row-$eid">
									<td>$serial_no</td> 
									<td> $title </td> 
									<!--<td> $account_name</td>--> 
									<td> $payee </td>
									<td> $totalCon </td> 
									<td> $payMethod </td> 
									<td> $date </td> 
									<td>
										<div class="btn-group">
											<a href="javascript:;" class="btna btn-tasks  waves-effect waves-light dropdown-toggle p-5" data-bs-toggle="dropdown" aria-haspopup="true"
											data-bs-display="static" aria-expanded="false">
												<i class="mdi mdi-dots-grid align-middle fs-18"></i>
											</a> 
											<div class="dropdown-menu dropdown-menu-lg-end p-10 dropdown-shadow end-0 animate__animated animate__flipInY"> 
												<p class="mb-10">
													<a href='javascript:;' id='$eid' class ='edit-expense text-sienna btn waves-effect btn-label waves-light'>									
														<i class="mdi mdi-text-box-search label-icon"></i> View 
													</a>	
												</p>
												$show_btn 
											</div>
										</div>    
									</td>
								</tr>
		
IGWEZE;
                               
		                  		echo $expensesData;
								$total = ""; $totalCon ="";
								nextrow:

		                    } 
								
						} 
				
          			?> 
				</tbody>	
				<tfoot>
					<tr>
						<th colspan="3" style="text-align:right">Grand Total:</th>
						<th><?php echo $curSymbol.number_format($grandTotal, 2); ?></th>
						<th colspan="3"></th> 
					</tr>
				</tfoot> 
			</table>
			<!-- / table -->
		</div>
						