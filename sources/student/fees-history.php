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
	This page is the student fee history
	------------------------------------------------------------------------*/ 


		if (!defined('fobrain')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
				
		require_once $fobrainIconPage; /* This include top middle global icon page eg go back, print buttons etcs */

?> 
	 
		<!-- row -->
		<div <?php echo $fob_view; ?> class="row gutters row-section justify-content-center">
			<div class="col-12">	
				<!-- card start -->
				<div class="card card-shadow"> 
					<?php 
						$page_title = '<i class="mdi mdi-calendar-clock fs-18"></i> 
						Student Fees History';
						pageTitle($page_title, 0);	 
					?>
					<div class="card-body">
							<!-- row -->
							<div class="row gutters pt-2">							
								
								<div class="table-responsive pt-3">
								
									<?php

										try {
									 
											$levelArray = studentLevelsArray($conn);  /* student level array */ 
											$feesDataArr = studentFeesInfo($conn, $regID, $regNum, $schoolID);  /* student school fee array */
											$feesDataCount = count($feesDataArr);
											
										}catch(PDOException $e) {
										
												fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
										 
										}	

											
									?>

									<script type='text/javascript'> renderTable(); </script> 
									<!-- table -->
									<table  class='table table-hover table-responsive style-table wiz-table'>
										
										<thead>
											<tr>
												<th>S/N</th> 
												<th>Category</th>  
												<th>Level</th> 
												<th>Term</th>
												<th>Amount </th>
												<th>Balance</th>
												<th>Date</th>
												<th>Status</th>
												<th>Tasks</th>
											</tr>
										</thead> 
										<tbody> 
											<?php
												
												if($feesDataCount >= $fiVal){  /* check array is empty */		
														
													$serial_no = 0; 	
													
													for($i = $fiVal; $i <= $feesDataCount; $i++){  /* loop array */	
														
														$fID = $feesDataArr[$i]["fID"];
														$feeCat = $feesDataArr[$i]["feeCat"];
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
														$upload2 = $feesDataArr[$i]["upload2"];
														$amount2 = $feesDataArr[$i]["amount2"];
														$date2 = $feesDataArr[$i]["date2"];
														$method2 = $feesDataArr[$i]["method2"];
														$n_pay = $feesDataArr[$i]["n_pay"];

														$studentLevel = $levelArray[$level]['level'];
														
														$feeCategoryInfoArr = feeCategoryInfo($conn, $feeCat);  /* school fee category information */
														$feeCategory = $feeCategoryInfoArr[$fiVal]['fee'];
														
														$fID = trim($fID); 
														
														$sTerm = wizSelectArray($term, $termIntList);
														$school = wizSelectArray($schoolID, $school_list);
														$payMethod = wizSelectArray($method, $paymentMethodArr);
														$payStatus = wizSelectArray($fStatus, $paymentStatus); 
														$confirm_pay = wizSelectArray($confirm, $confirm_pay_arr);  

														if($n_pay == $seVal){
															$amount += intval($amount2);	 
															$amount = fobrainCurrency($amount, $curSymbol);  /* school currency information*/
															$balance = $curSymbol."0.00";
															$date = date("j M Y", strtotime($date2));
														}else{
															$amount = fobrainCurrency($amount, $curSymbol);  /* school currency information*/
															$balance = fobrainCurrency($balance, $curSymbol);  /* school currency information*/
															$date = date("j M Y", strtotime($date));
														}  
														
														$serial_no++;								

$feesData =<<<IGWEZE
	
														<tr id="row-$fID" >
															<td>$serial_no</td> 
															<td> $feeCategory </td> 
															<td> $studentLevel $class </td>
															<td> $sTerm </td>
															<td> $amount</td> 
															<td> $balance</td> 
															<td> $date </td> 
															<td> $payStatus <hr class="my-5 p-0 text-danger"/> $confirm_pay</td>
															<td> 
																<a href='javascript:;' id='$fID' class ='viewFees text-sienna btn waves-effect btn-label waves-light'>									
																	<i class="mdi mdi-text-box-search label-icon"></i>  
																</a> 
															</td>
														</tr> 
	
IGWEZE;
						   
														echo $feesData; 								

													}
													
													
												}else{  /* display information message */ 
																
													$msg_i = "Ooops, you don't have any school fees history to show at the momment"; 
													echo $infMsg.$msg_i.$msgEnd;
																
												}


				
         									?>           
                        
										</tbody>
									</table>
									<!-- table -->	
								</div> 
							</div>
							<!-- / row --> 
					</div>
				</div>
				<!-- card end -->	
			</div>
		</div>
		<!-- / row -->	 			

		<!--  school fee pop up modal start -->			
		<button type="button" class="btn modal-fee-div display-none"  data-bs-toggle="modal" data-bs-target="#modal-fee-div"></button>						
		<!-- Scrollable modal -->
		<div class="modal fade animate__animated animate__zoomInDown" id="modal-fee-div" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
			<div class="modal-dialog modal-fullscreen-sm-down modal-dialog-scrollable">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalScrollableTitle"> 
							<i class="mdi mdi-calendar-clock"></i>  
							Fees Manager
						</h5>
						<div id="editMsg"> </div> 
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body slideUpFrmUDiv">
						<div id="editFeesDiv"></div> 
					</div> 
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		<!-- school fee pop up modal end -->		