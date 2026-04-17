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
		 
		if ($_REQUEST['search'] == 'range') {  /* select payroll date range */
				
			$startDate = cleanDate($_REQUEST['search-from']);
			$endDate = cleanDate($_REQUEST['search-to']);	
			$startDate = trim($startDate); $endDate = trim($endDate);	
			
			/* script validation */ 
			
			if ($startDate == "")  {
				
				$msg_e = "* Ooops Error, please select payroll date from";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>  
							$('.date-loader').hide(); 
							$('#reportrange').show(); 
						</script>"; exit;
				
			}elseif ($endDate == "")  {
				
				$msg_e = "* Ooops Error please select payroll date to";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>  
							$('.date-loader').hide(); 
							$('#reportrange').show(); 
						</script>"; exit;
				
			}else{  /* select payroll range */
				
				try {
											
					$payrollDataArr = payrollDataRange($conn, $startDate, $endDate);  /* school payroll range array */
					
					if (is_array($payrollDataArr)){   /* check if array */
						$payrollDataCount = count($payrollDataArr);
					}else{ $payrollDataCount = $i_false; }
				
				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				}	
			
			}

			echo "<script type='text/javascript'>  
							$('.date-loader').hide(); 
							$('#reportrange').show(); 
						</script>";  
					
		}else{  /* select default payroll date range */ 
		 
			try {
			
				$payrollDataArr = payrollData($conn);  /* school payroll array */
				$payrollDataCount = count($payrollDataArr); 
				
			}catch(PDOException $e) {
			
				fobrainDie( 'Ooops Database Error: ' . $e->getMessage()); 
			}	

		}	

		try { 

			//$burConfigsArray = bursaryConfigsArrays($conn);  /* school bursary configuration  */
			 
			//$salary_tax = $burConfigsArray[0]['stax'];  
			
		}catch(PDOException $e) {
		
			fobrainDie( 'Ooops Database Error: ' . $e->getMessage()); 
		}

						
?>

				<script type='text/javascript'> renderTable(); </script>
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
                            <!--<th>Status</th>-->
                            <th>Tasks</th>
							</tr>
						</thead> 
						<tbody>


					<?php
						$grandTotal = 0; $grandTotalBal = 0; $transTotal = 0;
						$earn_t = 0; $ded_t = 0; 
						$grand_total_tax = 0; $grand_total_earn = 0; $grand_total_ded = 0;

						if($payrollDataCount >= $fiVal){  /* check array is empty */	 
								
							for($i = $fiVal; $i <= $payrollDataCount; $i++){  /* loop array */	
								
								$pid = trim($payrollDataArr[$i]["pid"]);
								if($pid == ""){ goto nextrow; }
								$staff = $payrollDataArr[$i]["staff"];
								$accID = $payrollDataArr[$i]["acc"];
                                $salary = $payrollDataArr[$i]["salary"];
								$nsalary = $payrollDataArr[$i]["nsalary"];
								$salary_tax = $payrollDataArr[$i]["tax"];
                                $dpaid = $payrollDataArr[$i]["dpaid"];
								$status = $payrollDataArr[$i]["status"]; 
                               
								$s_ded1 = $payrollDataArr[$i]["ded1"];
								$s_earn1 = $payrollDataArr[$i]["earn1"];
								$s_ded2 = $payrollDataArr[$i]["ded2"];
								$s_earn2 = $payrollDataArr[$i]["earn2"];
								$s_ded3 = $payrollDataArr[$i]["ded3"];
								$s_earn3 = $payrollDataArr[$i]["earn3"];
								$pmethod = $payrollDataArr[$i]["pmethod"];
								$fDetail = $payrollDataArr[$i]["details"];  

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
								//$account_name = accountName($conn, $accID);

                                list ($title, $fname, $sex, $rank, $pic, $lname) =  explode ("#@s@#", $staff_info);	

                                $titleVal = wizSelectArray($title, $title_list);
                                $staff_img = picture($staff_pic_ext, $pic, "staff");
                                $paystatus  = $payroll_list[$status]; 

								if(($admin_grade == $bus_fobrain_grd) && ($admin_level == $bus_fob_tagged)) {  /* check if bursary */		

									$show_btn = "
												<!--
												<p class='mb-10'>
													<a href='javascript:;' id='$pid' class ='edit-payroll text-slateblue btn waves-effect btn-label waves-light'>									
														<i class='far fa-edit label-icon'></i> Edit
													</a>	
												</p>
												-->
												<p>
													<a href='javascript:;' id='$status(-)$pid' class ='remove-payroll text-danger btn waves-effect btn-label waves-light'>									
														<i class='far fa-trash-alt label-icon'></i> Delete
													</a>	
												</p> ";


								}else{ $show_btn = "";}	 
					
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
                                    <!--<td>$paystatus</td>-->                                       
                                    <td>  
										<div class="btn-group">
											<a href="javascript:;" class="btna btn-tasks  waves-effect waves-light dropdown-toggle p-5" data-bs-toggle="dropdown" aria-haspopup="true"
											data-bs-display="static" aria-expanded="false">
												<i class="mdi mdi-dots-grid align-middle fs-18"></i>
											</a> 
											<div class="dropdown-menu dropdown-menu-lg-end p-10 dropdown-shadow end-0 animate__animated animate__flipInY"> 
												<p class="mb-10">
													<a href='javascript:;' id='$pid' class ='view-payroll text-sienna btn waves-effect btn-label waves-light'>									
														<i class="fas fa-search label-icon"></i> Pay Slip 
													</a>	
												</p>
												$show_btn
											</div>
										</div>   
                                    </td> 
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