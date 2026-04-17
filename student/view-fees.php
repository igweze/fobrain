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
		         
			if ($_REQUEST['feesData'] == 'viewFees') {  /* view fees */
				
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
						$confirm = $feesInfoArr[$fiVal]["pstatus"];
						$upload = $feesInfoArr[$fiVal]["upload"]; 

						$upload2 = $feesInfoArr[$fiVal]["upload2"];
						$amount2 = $feesInfoArr[$fiVal]["amount2"];
						$date2 = $feesInfoArr[$fiVal]["date2"];
						$method2 = $feesInfoArr[$fiVal]["method2"];
						$n_pay = $feesInfoArr[$fiVal]["n_pay"];
								
						$feeCategoryInfoArr = feeCategoryInfo($conn, $feeCat);  /* school fee category information */
						$feeCategory = $feeCategoryInfoArr[$fiVal]['fee']; 
						
						  	
						$sTerm = wizSelectArray($term, $termIntList);
						$school = wizSelectArray($schoolID, $school_list);
						$payMethod = wizSelectArray($method, $paymentMethodArr);
						$payStatus = wizSelectArray($fStatus, $paymentStatus); 
						$confirm_pay = wizSelectArray($confirm, $confirm_pay_arr); 
						
						$date = date("j F Y", strtotime($date));
						$fDetail = nl2br($fDetail);
						
						$amount = fobrainCurrency($amount, $curSymbol);  /* school currency information*/
						$balance = fobrainCurrency($balance, $curSymbol);  /* school currency information*/
						
						
			
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
									<img src = "'.$pay_upload.'"  class="img-fluid-flex" > 
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
										<img src = "'.$pay_upload2.'"  class="img-fluid-flex" > 
									</td> 
								</tr>';  
		
							}else{
								$showQPicture2 = "";
							}
	
							$payment_se ='
								<tr>
									<th colspan="2" class="text-center text-info">								
										<center>2nd Payment Details</center>
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
								'.$showQPicture2;   
	
							$payment_fi ='
								<tr>
									<th colspan="2" class="text-center text-info">								
										<center>1st Payment Details</center>
									</th> 
								</tr>';	
							
						}else{ $payment_fi = ""; $payment_se = ""; }
									

$showPayment =<<<IGWEZE
		
						<div class="row gutters mb-10">
							<div class="text-end">
								<button  class="btn btn-primary" onclick="printDiv('fobrain-print-ovly')">
									<i class="fas fa-print"></i>  
								</button>
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
								<table class="table view-table">  
									 
									<tr>
										<th> Fee Paid </th> <td>$feeCategory </td> 
									</tr>
									<tr>
										<th> School</th> <td> $school</td> 
									</tr>
									<tr>
										<th> Class </th> <td> $studentLevel $class </td> 
									</tr>
									<tr>
										<th> Term </th> <td> $sTerm</td> 
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
										<th> Amount Paid </th> <td> $amount</td> 
									</tr> 
									<tr>
										<th> Payment Method </th> <td> $payMethod</td> 
									</tr>
									<tr>
										<th> Payment Details </th> <td> $fDetail</td> 
									</tr>
									<tr>
										<th> Payment Date </th> <td> $date</td> 
									</tr> 

									$showQPicture 

									$payment_se

									<tr>
										<th> Balance </th> <td>$balance </td> 
									</tr>

									<tr>
										<th> Payment Status </th> <td> $payStatus</td> 
									</tr>
									<tr>
										<th> Approval Status </th> <td> $confirm_pay</td> 
									</tr>

								</table>

								<!-- / table -->
							</div>
						</div>
		
IGWEZE;
				
						echo $showPayment; 
						
						echo "<script type='text/javascript'>  hidePageLoader();  </script>"; exit; 

				 	}catch(PDOException $e) {
  			
						fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					} 
        	
				}
			
			}else{
						
				echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
			
			}

			
exit;
?>