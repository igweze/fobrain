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
		 
		if ($_REQUEST['search'] == 'range') {  /* select payroll date range */
				
			$startDate = cleanDate($_REQUEST['search-from']);
			$endDate = cleanDate($_REQUEST['search-to']);		
			$startDate = trim($startDate); $endDate = trim($endDate);	
			
			/* script validation */ 
			
			if ($startDate == "")  {
				
				$msg_e = "* Ooops Error, please select fees date from";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>  
							$('.date-loader').hide(); 
							$('#reportrange').show(); 
						</script>"; exit;
				
			}elseif ($endDate == "")  {
				
				$msg_e = "* Ooops Error please select fees date to";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>  
							$('.date-loader').hide(); 
							$('#reportrange').show(); 
						</script>"; exit;
				
			}else{  /* select fees range */
				
				try {
											
					$feesDataArr = feesDataRange($conn, $startDate, $endDate);  /* school fee range array */
					
					if (is_array($feesDataArr)){   /* check if array */
						$feesDataCount = count($feesDataArr);
					}else{ $feesDataCount = $i_false; }
				
				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				}	
			
			}

			echo "<script type='text/javascript'>  
							$('.date-loader').hide(); 
							$('#reportrange').show(); 
						</script>";  
					
					
		}else{  /* select default fees date range */ 
		 
			try {
			
				$feesDataArr = feesData($conn);  /* school fee array */
				$feesDataCount = count($feesDataArr);
				
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
								<th>Category</th> 
								<th>School</th>
								<th>Picture</th> 
								<th>Reg No.<hr class="my-5 p-0 text-danger"/>Student</th>  
								<!-- <th>Level</th> 
								<th>Term</th> -->
								<!--<th>Account</th> -->
								<th>1st Payment<hr class="my-5 p-0 text-danger"/> 2nd Payment </th>
								<th>Balance</th>
								<th>Date</th>
								<th>Status</th>
								 
								<th>Tasks</th>
							</tr>
						</thead> 
						<tbody>


					<?php
						
						if($feesDataCount >= $fiVal){  /* check array is empty */		 

							$grandTotal = 0; $grandTotalBal = 0; $grandTotalPend = 0;
								
							for($i = $fiVal; $i <= $feesDataCount; $i++){  /* loop array */	
								
								$fID = trim($feesDataArr[$i]["fID"]);
								if($fID == ""){ goto nextrow; }
								$feeCat = $feesDataArr[$i]["feeCat"];
								$accID = $feesDataArr[$i]["acc"]; 
								$sessionID = $feesDataArr[$i]["session"];
								$regID = $feesDataArr[$i]["reg_id"];
								$regNum = $feesDataArr[$i]["regNo"];
								$schoolID = $feesDataArr[$i]["stype"];
								$level = $feesDataArr[$i]["level"];
								$class = $feesDataArr[$i]["class"];
								$term = $feesDataArr[$i]["term"];
								$method = $feesDataArr[$i]["method"];
								$fDetail = $feesDataArr[$i]["f_details"];
								$amount = $feesDataArr[$i]["amount"];
								$balance = $feesDataArr[$i]["balance"];
								$date = $feesDataArr[$i]["date"];
								$fStatus = $feesDataArr[$i]["f_status"];
								$confirm = $feesDataArr[$i]["pstatus"];
								$confirm2 = $feesDataArr[$i]["pstatus2"];

								$upload2 = $feesDataArr[$i]["upload2"];
								$amount2 = $feesDataArr[$i]["amount2"];
								$date2 = $feesDataArr[$i]["date2"];
								$method2 = $feesDataArr[$i]["method2"];
								$n_pay = $feesDataArr[$i]["n_pay"]; 
								
								$feeCategoryInfoArr = feeCategoryInfo($conn, $feeCat);  /* school fee category information */
								$feeCategory = $feeCategoryInfoArr[$fiVal]['fee']; 

								$sTerm = wizSelectArray($term, $termIntList);
								$school = wizSelectArray($schoolID, $school_list);
								$payMethod = wizSelectArray($method, $paymentMethodArr);
								$payStatus = wizSelectArray($fStatus, $paymentStatus); 
								
								//$account_name = accountName($conn, $accID);  

								if($n_pay == $seVal){
									$amount += intval($amount2);
									$amount2 = fobrainCurrency($amount2, $curSymbol);  /* school currency information*/
									$date = date("j M Y", strtotime($date2));
									$confirm_pay = wizSelectArray($confirm2, $confirm_pay_arr);  
								}else{ 
									$amount2 = "-"; 
									$date = date("j/M/Y", strtotime($date));
									$confirm_pay = wizSelectArray($confirm, $confirm_pay_arr);  
								}

								if($confirm == 2){
									$grandTotal += intval($amount);
									$delete_btn = "";
								}else{
									$grandTotalPend += intval($amount);
									$delete_btn = "<p>
													<a href='javascript:;' id='fobrain-$fID-$feeCategory-$regNum-$student' class ='remove-payment text-danger btn waves-effect btn-label waves-light'>									
														<i class='mdi mdi-delete label-icon'></i> Delete
													</a>	
												</p>";
								} 

								$grandTotalBal += intval($balance);
								
								$amount = fobrainCurrency($amount, $curSymbol);  /* school currency information*/
								$balance = fobrainCurrency($balance, $curSymbol);  /* school currency information*/
								
								require $fobrainSchoolTBS; /* include student database table information  */								
					
								$regNum = studentReg($conn, $regID);  /* student registration number  */									
								$student = studentName($conn, $regNum);  /* student name  */					
								$student_img = studentPicture($conn, $regNum);  /* student picture */
								
								//$levelArray = studentLevelsArray($conn);  /* student level array */ 
								//$studentLevel = $levelArray[$level]['level']; 
																
								/*
								<td> $studentLevel $class </td> 									 
								<td> $sTerm </td> */ 

								if(($admin_grade == $bus_fobrain_grd) && ($admin_level == $bus_fob_tagged)) {  /* check if bursary */		

									if(($fStatus == 0)){

										$compay_btn = "";
										$show_btn = "<p class='mb-10'>
													<a href='javascript:;' id='$fID' class ='edit-payment text-slateblue btn waves-effect btn-label waves-light'>									
														<i class='mdi mdi-checkbox-marked-circle-outline label-icon'></i> App. Pay 1
													</a>	
												</p>
												<p class='mb-10'>
													<a href='javascript:;' id='$fID' class ='complete-payment text-slateblue btn waves-effect btn-label waves-light'>									
														<i class='mdi mdi-checkbox-multiple-marked-circle-outline label-icon'></i> App. Pay 2
													</a>	
												</p>
												$delete_btn 
												";			

									}else{
										$compay_btn = "";
										$show_btn = "<p class='mb-10'>
													<a href='javascript:;' id='$fID' class ='edit-payment text-slateblue btn waves-effect btn-label waves-light'>									
														<i class='mdi mdi-checkbox-marked-circle-outline label-icon'></i> App. Pay 1
													</a>	
												</p>
												$compay_btn
												$delete_btn ";
									} 


								}else{ $show_btn = "";}	

								
					
								$serial_no++;								

$feesData =<<<IGWEZE
        
								<tr id="row-$fID">
									<td>$serial_no</td>   
									<td> $feeCategory </td> 
									<td> $school </td> 
									<td><img src = "$student_img" class="img-h-50 img-circle img-thumbnail""> </td> 
									<td>$regNum <hr class="my-5 p-0 text-danger"/>$student</td>										
									<!--<td> $account_name </td> -->
									<td> $amount <hr class="my-5 p-0 text-danger"/> $amount2</td> 
									<td> $balance</td> 
									<td> $date </td> 
									<td> $payStatus <hr class="my-5 p-0 text-danger"/> $confirm_pay</td> 
									
									<td> 
										<div class="btn-group">
											<a href="javascript:;" class="btna btn-tasks  waves-effect waves-light dropdown-toggle p-5" data-bs-toggle="dropdown" aria-haspopup="true"
											data-bs-display="static" aria-expanded="false">
												<i class="mdi mdi-dots-grid align-middle fs-18"></i>
											</a> 
											<div class="dropdown-menu dropdown-menu-lg-end p-10 dropdown-shadow end-0 animate__animated animate__flipInY"> 
												<p class="mb-10">
													<a href='javascript:;' id='$fID' class ='view-payment text-sienna btn waves-effect btn-label waves-light'>									
														<i class="mdi mdi-text-box-search label-icon"></i> View 
													</a>	
												</p>
												$show_btn 
											</div>
										</div>  
									</td>
								</tr>
		
IGWEZE;
                               
								echo $feesData; 
								
								nextrow:

		                    }
								
								
						} 

				
 					?>           
                        
						</tbody>
						<tfoot>
							<tr>
								<th colspan="5" style="text-align:right">Grand Total:</th>
								<th><?php echo $curSymbol.number_format($grandTotal, 2); ?></th>
								<th><?php echo $curSymbol.number_format($grandTotalBal, 2); ?></th>
								<th colspan="2"></th> 
							</tr>
							<tr>
								<th colspan="5" style="text-align:right">Pending Total:</th>
								<th><?php echo $curSymbol.number_format($grandTotalPend, 2); ?></th>
								<th colspan="2"></th>
								<th></th> 
							</tr>
						</tfoot>
					</table>
					<!-- table -->
				</div>
						