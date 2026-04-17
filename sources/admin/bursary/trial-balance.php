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
	
	6:10
	4:33 to 6.17
	-------- Script Description --------
	This script handle school payment and fees
	------------------------------------------------------------------------*/

		if (!defined('fobrain'))

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
				
		require_once $fobrainIconPage; /* This include top middle global icon page eg go back, print buttons etcs */

?>		
  
		<!-- row -->
		<div <?php echo $fob_view; ?> class="row gutters row-section fobrain-section-div justify-content-center">
 
			<div class="col-12">	
				<!-- card start -->
				<div class="card card-shadow"> 
					<?php 
						$page_title = '<i class="mdi mdi-chart-bar-stacked fs-18"></i> 
							Tranasctions';
						pageTitle($page_title, 0);	 
					?>
					<div id="msg-box"></div> 	
					<div class="card-body">

						<!-- row --> 
						<div class="row gutters my-15"> 
							<div class="col-lg-8 col-md-8 col-sm-12 col-12"> 
								<div id='start' style="display: none;"></div> 
								<div id='end' style="display: none;"></div>
								<div id="reportrange" class="text-danger" style="background: #fff; cursor: pointer; padding: 5px 10px; 
									border: 0px solid #000; width:auto;">
									<i class="mdi mdi-calendar-search fs-24"></i>&nbsp;
									<span></span> <i class="fas fa-caret-down"></i> 									
								</div>

								<div class="display-none text-primary date-loader fs-14"> 
									<strong role="status">Processing...</strong>
									<div class="spinner-border ms-auto" aria-hidden="true"></div>
								</div>
							</div>

							<div class="col-lg-4 col-md-34 col-sm-12 col-12">										
								<!-- field wrapper start -->
								<div class="field-wrapper select-wrapper mt-0">
									
									<select class="form-control fob-select" id="trialCat" name="trialCat" required>

										<option value = "">Search . . .</option>
										<option value = "1">Income Fees</option>
										<option value = "2">Online Sales</option>
										<option value = "3">Expenses</option>
										<option value = "4">Payroll</option> 
										<option value = "all">All Transaction</option> 
										
									</select> 
									<div class="icon-wrap"  id="wait_cat" style="display: none;">
										<i class="loader"></i>
									</div>
									<div class="field-placeholder">  Filter <span class="text-danger"></span></div>													
								</div>
								<!-- field wrapper end -->
							</div>
						</div>	
						<!--
						<div class="row gutters mt-25 mb-15"> 
							<div class="col-lg-4 col-md-4 col-sm-12 col-12">  
								<div class="text-primary" style="background: #fff; cursor: pointer; padding: 5px 10px; 
									border: 3px dotted #ccc; width:auto;">
									Balance - <span id="balance_div" class="ms-10"></span>									
								</div> 
							</div>

							<div class="col-lg-3 col-md-3 col-sm-12 col-12"> 
								<!- - field wrapper start -- >
								<div class="field-wrapper select-wrapper mt-0">		
																	
									<select class="form-control fob-select"  id="bank_acc" name="bank_acc">

										<option value = "">Search . . . </option>

										<?php

	
										try {

											//$bank_dataArr = bankAccountData($conn);  /* school expenses category array */
											//$bank_dataCount = count($bank_dataArr);
											
										}catch(PDOException $e) {
										
											fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
										
										}		
										/*
										if($bank_dataCount >= $fiVal){ 

											for($i = $fiVal; $i <= $bank_dataCount; $i++){	 
											
												$bid = $bank_dataArr[$i]["bid"];
												$acc = trim($bank_dataArr[$i]["acc"]);
												$bal = trim($bank_dataArr[$i]["balance"]);
												
												//$b_value = $bid.'#fob#'.$bal; 
												$selected = "";
												
												echo '<option value="'.$bid.'"'.$selected.'> '.$acc.'</option>' ."\r\n";

											}

											echo "<option value = 'all'>Search All Account</option>";

										}else{
											
											echo '<option value="">Ooops Error, no bank account found.</option>' ."\r\n"; 
											
										}	
										*/
										?> 
									</select> 
									<div class="icon-wrap"  id="wait_bal" style="display: none;">
										<i class="loader"></i>
									</div> 
									<div class="field-placeholder"> Search Account <span class="text-danger"></span></div>													
								</div>
								<!- - field wrapper end -- >
					
							</div> 

							
						</div>
						<! -- /row -->
						 
						<div class="clear-ft"></div> 
						<div id="load-trial-balance" class="mt-20 pb-50"> 
							<?php //require 'trial-balance.php';  ?> 
						</div> 
					</div><!-- end card-body -->	
				</div>
				<!-- card end -->	
			</div>
		</div>
		<!-- / row -->	  
	
		<!--  fobrain modal start -->			
		<button type="button" class="btn modal-fobrain  display-none"  data-bs-toggle="modal" data-bs-target="#modal-fobrain"></button>				
		<!-- Scrollable modal -->
		<div class="modal fade animate__animated animate__zoomInDown" id="modal-fobrain" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg modal-fullscreen-md-down  modal-dialog-scrollable">
				<div class="modal-content"> 
					<div class="modal-header"> 
						<h5 class="modal-title" id="exampleModalScrollableTitle"> 
							<i class="mdi mdi-chart-bar-stacked label-icon"></i>  
							Trial Balance Manager
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

		<!--  fobrain modal start -->			
		<button type="button" class="btn modal-fobrain-2  display-none"  data-bs-toggle="modal" data-bs-target="#modal-fobrain-2"></button>				
		<!-- Scrollable modal -->
		<div class="modal fade animate__animated animate__zoomInDown" id="modal-fobrain-2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
			<div class="modal-dialog modal-fullscreen  modal-dialog-scrollable">
				<div class="modal-content"> 
					<div class="modal-header"> 
						<h5 class="modal-title" id="exampleModalScrollableTitle"> 
							<i class="mdi mdi-chart-bar-stacked label-icon"></i>  
							Trial Balance Manager
						</h5>									 
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div id="edit-msg-2"> </div> 
					<div class="modal-body">
						<div id="modal-load-div-2"></div> 
					</div>					 
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		<!-- fobrain modal end --> 		

		<div id="remove-msg"> </div>
			  
		<script type="text/javascript">
		
			$(function() {  /* date range function from js plugin moment */

				var start = moment().subtract(120, 'days');
				var end = moment();

				function cb(start, end) {
					
					$('#reportrange span').html('<b>Search : </b> ' +start.format('MMMM D, YYYY') + 
					' <b>-</b> ' + end.format('MMMM D, YYYY')); 
					
					$('#start').html(start.format('YYYY-M-D'));
					$('#end').html(end.format('YYYY-M-D'));
					if((start != "") || (end != "")){
						
						trialBalanceRange();
						
					}	
					
				}
				
				$('#reportrange').daterangepicker({
					//timePicker: true, - to allow time
					startDate: start,
					endDate: end,
					ranges: {
						'Today': [moment(), moment()],
						'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
						'Last 7 Days': [moment().subtract(6, 'days'), moment()],
						'Last 30 Days': [moment().subtract(29, 'days'), moment()],
						'Last 90 Days': [moment().subtract(87, 'days'), moment()],
						'This Month': [moment().startOf('month'), moment().endOf('month')],
						'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
					}
				}, cb);

				cb(start, end); 
				
			});
			 
			function trialBalanceRange(){   /* fee  date range */		 

				$('#reportrange').hide();
				$('.date-loader').show();
				$('#wait_bal, #wait_cat').show();
				var postVal = 'range';
				var start = $('#start').text();
				var end = $('#end').text();
				var account = $('#bank_acc').val();
				
				$('#load-trial-balance').load('trial-balance.php', {'search': postVal, 'search-to': end, 
					'search-from': start, 'acc': account});					
				
				return false;  
	
			}
			
			function trialBalanceAccount(){   /* fee  date range */													
				
				$('#reportrange').hide();
				$('.date-loader, #wait_cat').show(); 
				var postVal = 'account';
				var start = $('#start').text();
				var end = $('#end').text();
				var account = $('#bank_acc').val();

				$('#trialCat').val(""); 
				
				$('#load-trial-balance').load('trial-balance.php', {'search': postVal, 'search-to': end, 
					'search-from': start, 'acc': account});					
				
				return false;  
	
			}

			function trialBalanceCategory(){   /* fee  date range */													
				
				$('#reportrange').hide();
				$('.date-loader').show();
				$('#wait_bal, #wait_cat').show();
				var postVal = 'category';
				var start = $('#start').text();
				var end = $('#end').text();
				var account = $('#bank_acc').val();
				var categ = $('#trialCat').val();
				
				$('#load-trial-balance').load('trial-balance.php', {'search': postVal, 'search-to': end, 
					'search-from': start, 'acc': account, 'categ': categ});					
				
				return false;  
	
			}

			$('body').on('change','#bank_acc',function(){    
				trialBalanceRange();
			});

			$('body').on('change','#trialCat',function(){    
				trialBalanceCategory();
			});

			$('.fob-select').each(function() {  
				renderSelect($('#'+this.id)); 
			}); 

			
		</script>



