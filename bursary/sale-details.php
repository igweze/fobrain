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
	This script handle school shopping information
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

		define('fobrain', 'igweze');  /* define a check for wrong access of file */

		require 'fobrain-config.php';  /* load fobrain configuration files */

		if ($_REQUEST['transData'] == 'viewOrder') {  /* view product order */ 
			
			$order_info = clean($_REQUEST['transID']);	 			
			$regDate = strtotime(date("Y-m-d H:i:s"));		
			
			list ($orderID, $o_status) =  explode ("-", $order_info);	
			
			/* script validation */ 
			
			if ($orderID == "")  {
				
				$msg_e = "* Ooops Error, could not retrieve transaction information.";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
				
			}else {   /* select order */     
			
				try{
				
					$ebele_mark = "SELECT order_id, acc, reg_id, regNo, stype, orderDate, status
					
									FROM $fobrainOrderTB 
									
									WHERE order_id  = :order_id";
							
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':order_id', $orderID);						 
					$igweze_prep->execute();
					
					$rows_count = $igweze_prep->rowCount(); 
					
					if($rows_count == $fiVal) {  /* check select is empty */
					
						while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {  /* loop array */		
			
							$orderID = $row['order_id'];
							$account = $row['acc'];
							$regID = $row['reg_id'];
							$regNum = $row['regNo'];
							$schoolID = $row['stype'];
							$orderDate = $row['orderDate'];
							$status = $row['status']; 
						}
						
						//$orderTime = timerBoy($orderDate);
						$orderDate = strtotime($orderDate);
						$orderTime = date("j M Y", $orderDate);
						$orderStatus = $confirm_pay_arr[$status];

						$school = $school_list[$schoolID];
								
						require $fobrainSchoolTBS; /* include student database table information  */						
							
						$regNum = studentReg($conn, $regID);  /* student registration number  */													
						$student_name = studentName($conn, $regNum);  /* student name  */										
						$student_img = studentPicture($conn, $regNum);  /* student picture */
						$billingData = billingData($conn, $regNum);  /* students billing information  */ 
						list($nameFull, $address, $city, $state, $country, $phone) = explode("##", $billingData);	
															
						
					}else{
						
						$msg_e = "* Ooops Error, could not retrieve this order information.";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
							
					}	

					if($status == 1){
						$hide_class = "";
					}else{ $hide_class = "display-none"; }


$cartHead =<<<IGWEZE

		<div class="row gutters mb-10">
			<div class="text-end">
				<button  class="btn btn-primary" onclick="printDiv('fobrain-print-ovly')">
					<i class="fas fa-print"></i>  
				</button> 
			</div>	
		</div>  

		<div id = 'fobrain-print-ovly clear-ft'>	 
			<!-- invoice start--> 
				<div class="card card-shadow mb-50"> 
					<div class="card-header-wiz">
						<h4>
							<i class="mdi mdi-account-supervisor-circle fs-18"></i> 
							Transaction Invoice  
						</h4>
					</div> 
					<div class="card-body">
						<div class="row invoice-list">
							
							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 mb-10 fs-13">
								<h4 class="text-info bb-1 my-15">BILLING ADDRESS</h4>
								<p>
									$nameFull<br>
									$address<br>
									$city, $state, $country<br>
									$phone<br>
								</p>
							</div>
							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 mb-10 fs-13">
								<h4 class="text-info bb-1 my-15">SHIPPING ADDRESS</h4>
								<p>
									$nameFull<br>
									$address<br>
									$city, $state, $country<br>
									$phone<br>
								</p>
							</div>
							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 mb-10 fs-13">
								<h4 class="text-info bb-1 my-15">INVOICE INFO</h4>
								<ul class="unstyled">
									<li>Invoice Number	: <span class="text-danger fw-600">Order-$orderID</span></li>
									<li>Invoice Date		: <span class="text-info fw-600">$orderTime</span></li>
									<li>Invoice Status		: <span class="text-danger  fw-600 tranStatus-$orderID"> $orderStatus </span></li>
								</ul>
							</div>
						</div>

						<!-- table -->
						<div class="table-responsive">
						<table class="table view-table table-hover table-responsive">
							<thead>
							<tr>
								<th class='text-left'>#</th>
								<th class='text-left'>Item</th>
								<th class='text-left'>Description</th>
								<th class='text-left'>Unit Cost</th>
								<th class='text-left'>Quantity</th>
								<th class='text-left'>Total</th>
								
							</tr>
							</thead>
							<tbody>
							

	
IGWEZE;
					echo $cartHead;
	
					$total = 0; 

					$ebele_mark = "SELECT s_id, order_id, product_id, qty, price
					
									FROM $fobrainOrderSummTB 
									
									WHERE order_id  = :order_id";
							
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':order_id', $orderID);							 
					$igweze_prep->execute();
					
					$rows_count = $igweze_prep->rowCount(); 
					
					if($rows_count >= $fiVal) {  /* check select is empty */
					
						while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {  /* loop array */		
			
							$s_id = $row['s_id'];
							//$orderIDS = $row['order_id'];
							$productID = $row['product_id'];
							$qty = $row['qty'];
							$price = $row['price']; 
							
							$productData =  productInfo($conn, $productID);  /* school products information*/
				
							list ($p_id, $p_title, $p_date, $p_price, $p_description) = explode ("@(.$*S*$.)@", $productData); 

							$product_price = ($price * $qty);
							$product_price = number_format($product_price, 2); 
				
							$subtotal = ($price * $qty);
							$total +=  $subtotal;
							$subtotalS = number_format($subtotal, 2);
							
							$serial_no++;
			

$cartBody =<<<IGWEZE

							<tr id="cOut-$productID">
								<td class='text-left'>$serial_no</td>
								<td class='text-left'>$p_title</td>
								<td class='text-left' >$p_description</td>
								<td class='text-left'>$curSymbol$p_price  </td>
								<td class='text-left'>$qty </td>										 
								<td class='text-left'> $curSymbol$subtotalS</td>										 
							</tr> 
	
IGWEZE;
							echo $cartBody; 

							$subtotal = "";
						
						} 

						$grand_total = number_format($total, 2);
					
$cardTailTop =<<<IGWEZE



								</tbody>
							</table>
						</div>
						
						<!-- / table -->  
						
						<!-- row -->
						<div class="row">
							<div id="edit-msg"> </div> 
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
						</div>	
						<div class="row"> 
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12  slideTransaction mb-20">
								<h4 class="text-info bb-1 my-15"> Transaction Status</h4>  
												
								<select class="form-control $hide_class" style="width:200px;"  id="tranStatus" name="tranStatus" required>
																						
	
IGWEZE;
								echo $cardTailTop;
				
								foreach($confirm_pay_arr as $trans_key => $trans_value){  /* loop array */

									if ($status == $trans_key){
										$selected = "SELECTED";
									} else {
										$selected = "";
									}

									echo '<option value="'.$trans_key.'"'.$selected.'>'.$trans_value.'</option>' ."\r\n";

								}
									

$cardTailBot =<<<IGWEZE


									</select>
									<input type="hidden" value="$orderID#@#$account#@#$total" name="transID" id="transID"> 
								</div>
								
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 invoice-block fs-13">
									<ul class="unstyled amounts text-right">
										<li><strong>Sub - Total :</strong> $curSymbol$grand_total </li>
										<li><strong>VAT :</strong> -----</li>
										<li><strong>Grand Total :</strong> $curSymbol$grand_total </li>
									</ul>
								</div>

								
							</div>  
								
						</div> 
					</div>
				</div> 			
			</div>
			<!-- / row -->
	
IGWEZE;
						echo $cardTailBot;	 
				
					}	
					
					if($status == $seVal){
						
						try {

							accountJournalTB($conn, $orderID, $transact_sales);  /* account Journal table */ 

						}catch(PDOException $e) {

							fobrainDie( 'Ooops Database Error: ' . $e->getMessage());

						}

					}else{  

						require ($bursaryDir.'journal-entry.php');  
				 
					}
						

				}catch(PDOException $e) {
					
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
						
				} 
			
				echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
			} 
			
			
		}elseif($_REQUEST['transData'] == 'tranStatus') {  /* update transaction status */ 

			$trans_data = clean($_REQUEST['transID']);				
			$status = $_REQUEST['status'];
			$journalArr = $_REQUEST['journals'];
			$edate = date("Y-m-d");
			$rtime = date("Y-m-d H:i:s");
 
			list ($orderID, $account, $total) =  explode ("#@#", $trans_data); 

			$transact = $transact_sales;  
			$title = "School Sales";
			
			/* script validation */ 
			
			if($orderID == "")  {
				
				$msg_e = "* Ooops Error, could not retrieve transaction information.";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>  
						$('.wiz-glower').fadeOut(2000); 
						$('#tranStatus').val(''); 
					</script>";exit;
				
			}elseif($status == '') { 
			
				$msg_e = "Ooops Error, Please select a transaction status"; 
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>  
						$('.wiz-glower').fadeOut(2000); 
						$('#tranStatus').val(''); 
					</script>";exit;
												
			}else {  /* update information */      
			
				try{  

					$grandtotal = $total;

					if($status == $seVal){

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
						
						$transid = $orderID; 

						$ebele_mark = "UPDATE $fobrainOrderTB
							
											SET 
											
											status = :status
											
										WHERE order_id  = :order_id";
		
						$igweze_prep = $conn->prepare($ebele_mark);
		
						$igweze_prep->bindValue(':status', $status);
						$igweze_prep->bindValue(':order_id', $orderID);
						$igweze_prep->execute(); 

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
						
						if ( ($igweze_prep_chart_1 == true) && ($igweze_prep_chart_2 == true)){  /* if sucessfully */

							$conn->commit(); 	
						
							$msg_s = "Journal Entry  & Sales details was successfully saved and posted. $msgC"; 
							echo $succesMsg.$msg_s.$sEnd;  
						
							$orderStatus = $confirm_pay_arr[$status];									
							//$msg_s = "Transaction Status was successfully change to <strong> $orderStatus </strong> "; 								
							//echo $succesMsg.$msg_s.$sEnd; 

					
$tMsg =<<<IGWEZE

							<script type='text/javascript'> 
								$('.slideTransaction').fadeOut(1500);
								$('.wiz-glower').fadeOut(2000); 
								$('.tranStatus-$orderID').html('$orderStatus');  
							</script>                                   				
	
IGWEZE;
							echo $tMsg; exit;
							
						}else{  /* display error */ 

							$conn->rollBack(); 		 
							
							$msg_e =  "Ooops, an error has occur while to save transaction. Please try again";
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'>  
									$('.wiz-glower').fadeOut(2000); 
									$('#tranStatus').val(''); 
								</script>";exit;
							
						}

					}else{ 
						
						$ebele_mark = "UPDATE $fobrainOrderTB
						
											SET 
											
											status = :status
											
										WHERE order_id  = :order_id";
		
						$igweze_prep = $conn->prepare($ebele_mark);
		
						$igweze_prep->bindValue(':status', $status);
						$igweze_prep->bindValue(':order_id', $orderID);
					 

						if ($igweze_prep->execute()){  /* if sucessfully */ 
						
							$orderStatus = $confirm_pay_arr[$status];									
							$msg_s = "Transaction Status was successfully change to <strong> $orderStatus </strong> "; 								
							echo $succesMsg.$msg_s.$sEnd; 

					
$tMsg =<<<IGWEZE

							<script type='text/javascript'> 
								$('.slideTransaction').fadeOut(1500);
								$('.wiz-glower').fadeOut(2000); 
								$('.tranStatus-$orderID').html('$orderStatus');  
							</script>                                   				
	
IGWEZE;
							echo $tMsg; exit;
							
						}else{  /* display error */ 
				
							$msg_e =  "Ooops, an error has occur while to save transaction status. Please try again";
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'>   $('.wiz-glower').fadeOut(2000); </script>";exit;
							
						}
					}

				}catch(PDOException $e) {
					
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
						
				}

			}

			
		}else{ 
		
			echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
		
		} 
		
exit; 
?>
		
