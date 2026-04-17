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
	This script handle product order information
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
			
			if ($startDate == "")  {  /* select order date range */
				
				$msg_e = "* Ooops Error, please select salesOrder date from";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>  
							$('.date-loader').hide(); 
							$('#reportrange').show(); 
						</script>"; exit;
				
			}elseif ($endDate == "")  {
				
				$msg_e = "* Ooops Error please select salesOrder date to";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>  
							$('.date-loader').hide(); 
							$('#reportrange').show(); 
						</script>"; exit;
				
			}else{
				
				
				$salesOrderT = $seVal;
			
			}	
				
			echo "<script type='text/javascript'>  
							$('.date-loader').hide(); 
							$('#reportrange').show(); 
						</script>";  
				
		}else{  /* select default order date range */ 								
					
			$salesOrderT = $fiVal;		 

		}	

						
?>

		<script type='text/javascript'> renderTable(); </script>
		<div class="table-responsive">
			<!-- table -->
			<table  class='table table-hover table-responsive style-table wiz-table'>
				<thead>
					<tr>
						<th>S/N</th> 
						<th> Invoice</th> 
						<th>School</th>
						<th>Picture</th> 
						<th>Reg No. <hr class="my-5 p-0 text-danger"/> Student</th>   
						<th>Account</th>
						<th>Total</th>
						<th>Date</th>
						<th>Status</th>
						<th>Tasks</th>
					</tr>
				</thead> 
				<tbody> 

<?php
 
				try{

					$grandTotal = 0; $transTotal = 0;  $grandTotalPend = 0;

					if($salesOrderT == $seVal){  /* select order date range */

						$ebele_mark = "SELECT order_id, acc, reg_id, regNo, stype, orderDate, status
						
										FROM $fobrainOrderTB
										
										WHERE (orderDate BETWEEN :start_date AND :end_date)
										
										ORDER BY order_id DESC";
							 
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue('start_date',  $startDate, PDO::PARAM_STR);
						$igweze_prep->bindValue('end_date',  $endDate, PDO::PARAM_STR);	
						
					}else{	/* select default order date range */
					
						$ebele_mark = "SELECT order_id, acc, reg_id, regNo, stype, orderDate, status
						
										FROM $fobrainOrderTB
										
										ORDER BY order_id DESC";
							 
						$igweze_prep = $conn->prepare($ebele_mark);						 
						
					}	
					$igweze_prep->execute();
					
					$rows_count = $igweze_prep->rowCount(); 

						
					
					if($rows_count >= $fiVal) {  /* check array is empty */
											
						while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {  /* loop array */		
			
							$orderID = $row['order_id'];
							$regID = $row['reg_id'];
							$regNum = $row['regNo'];
							$schoolID = $row['stype'];
							$accID = $row['acc'];
							$orderDate = $row['orderDate'];
							$status = $row['status']; 

							$orderTime = date("j M Y", strtotime($orderDate)); 

							$transTotal = transactionTotal($conn, $orderID);  /* school total transaction information*/
							$orderStatus = $confirm_pay_arr[$status];

							if($status == 2){
								$grandTotal += intval($transTotal);
							}else{
								$grandTotalPend += intval($transTotal);
							}

							//$grandTotal += $transTotal;

							if($transTotal != ""){
								$transTotal = number_format($transTotal, 2);
							} 

							$account_name = accountName($conn, $accID);
							
							$school = $school_list[$schoolID];
							
							require $fobrainSchoolTBS; /* include student database table information  */							

							$regNum = studentReg($conn, $regID);  /* student registration number  */									
							$student = studentName($conn, $regNum);  /* student name  */					
							$student_img = studentPicture($conn, $regNum);  /* student picture */ 

							if(($admin_grade == $bus_fobrain_grd) && ($admin_level == $bus_fob_tagged)) {  /* check if bursary */		

								$show_btn = 
									"<a href='javascript:;'  id='$orderID-1' class ='view-transaction text-danger btn waves-effect btn-label waves-light'>
										<i class='mdi mdi-text-box-search label-icon'></i>  											
									</a>"; 

							}else{ 

								$show_btn = 
									"<a href='javascript:;'  id='$orderID-0' class ='view-transaction text-danger btn waves-effect btn-label waves-light'>
										<i class='mdi mdi-text-box-search label-icon'></i>  											
									</a>";
							}
							
							$serial_no++; 														
			        					
$msgBody =<<<IGWEZE
        
								<tr id="row-$orderID"> 
									<td>$serial_no</td> 
									<td>INVOICE-$orderID </td> 
									<td>$school</td> 
									<td><img src = "$student_img" class="img-h-50 img-circle img-thumbnail""> </td> 
									<td>$regNum <hr class="my-5 p-0 text-danger"/> $student</td> 									
									<td>$account_name </td>	 
									<td>$curSymbol$transTotal </td> 
									<td>$orderTime</td> 
									<td><span class="tranStatus-$orderID"> $orderStatus </span></td>  
									<td> 
										$show_btn
									</td>
								</tr> 
		
IGWEZE;
							echo $msgBody; 

							$transTotal = "";

						} 

					}
					
				}catch(PDOException $e) {
					
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
					 
				}
	

?>													
				</tbody>
				<tfoot>
					<tr>
						<th colspan="6" style="text-align:right">Grand Total:</th>
						<th><?php echo $curSymbol.number_format($grandTotal, 2); ?></th>
						<th></th> 
					</tr>
					<tr>
						<th colspan="6" style="text-align:right">Pending Total:</th>
						<th><?php echo $curSymbol.number_format($grandTotalPend, 2); ?></th>
						<th></th> 
					</tr>
				</tfoot>
			</table>
			<!-- table -->
		</div>				


		 