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
	This page handle staffs payroll
	------------------------------------------------------------------------*/ 


		if (!defined('fobrain')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
				
		require_once $fobrainIconPage; /* This include top middle global icon page eg go back, print buttons etcs */


		try {
			
			$payrollDataArr = staffPayroll($conn, $_SESSION['adminID']);  /* school payroll array */
			$payrollDataCount = count($payrollDataArr);   

			$burConfigsArray = bursaryConfigsArrays($conn);  /* school bursary configuration  */ 
			$salary_tax = $burConfigsArray[0]['stax'];  
		}catch(PDOException $e) {
		
			fobrainDie( 'Ooops Database Error: ' . $e->getMessage()); 
		}

?> 	

		<!-- row -->
		<div <?php echo $fob_view; ?> class="row gutters row-section fobrain-section-div justify-content-center">
			<div class="col-12">	
				<!-- card start -->
				<div class="card card-shadow"> 
					<?php 
						$page_title = '<i class="fas fa-cash-register fs-18"></i> 
						My Payroll';
						pageTitle($page_title, 0);	 
					?>
					<div id="msg-box"></div> 					
					<div class="card-body mb-30"> 
						 
						<script type='text/javascript'> renderTable(); </script>
						<div class="table-responsive">
							<!-- table -->
							<table  class='table table-hover table-responsive style-table wiz-table'>			 
								<thead>
									<tr>
									<th>S/N</th>                         
									<th>Picture</th>
									
									<th>Salary</th>
									<th>Tax</th>
									<th>Earning</th>
									<th>Deduction</th>
									<th>Paid</th> 

									<th>Date</th>
									<th>Status</th>
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
										
										$pid = $payrollDataArr[$i]["pid"];
										$staff = $payrollDataArr[$i]["staff"];
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
									
										
										$dpaid = date("M Y", strtotime($dpaid));  

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

										if(($admin_grade == $bus_fobrain_grd) && ($admin_level == $bus_fob_tagged)) {  /* check if bursary */		

											$show_btn = "<p class='mb-10'>
															<a href='javascript:;' id='$pid' class ='edit-payroll text-slateblue btn waves-effect btn-label waves-light'>									
																<i class='far fa-edit label-icon'></i> Edit
															</a>	
														</p>
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
												<!--<td>$titleVal  $fname</td>  <th>Names</th>-->
												<td>$salary</td>
												<td>$sal_tax</td>
												<td>$earn_t</td>
												<td>$ded_t</td>
												<td>$nsalary</td>
												<td>$dpaid</td> 
												<td>$paystatus</td>                                        
												<td>  
													 
													<a href='javascript:;' id='$pid' class ='view-payroll text-sienna btn waves-effect btn-label waves-light'>									
														<i class="fas fa-search label-icon"></i>&nbsp;Pay&nbsp;Slip 
													</a>	
															 
												</td> 
											</tr>
		
IGWEZE;
                               
											echo $payrollData; 	
											$nsalary_tax = 0;							

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




					</div>
				</div>
				<!-- card end -->	
			</div> 
		</div>
		<!-- / row -->	  
		 
 
		<!--  fobrain modal start -->			
		<button type="button" class="btn modal-fobrain  display-none"  data-bs-toggle="modal" data-bs-target="#modal-fobrain"></button>				
		<!-- Scrollable modal -->
		<div class="modal fade animate__animated animate__zoomInDown" id="modal-fobrain" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg modal-dialog-scrollable">
				<div class="modal-content"> 
					<div class="modal-header"> 
						<h5 class="modal-title" id="exampleModalScrollableTitle"> 
							<i class="mdi mdi-chart-bar-stacked label-icon"></i>  
							Payroll Manager
						</h5>							 
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div id="edit-msg"> </div> 
					<div class="modal-body">
						<div id="modal-load-div"></div> 
					</div>
					 
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		<!-- fobrain modal end -->   

		 