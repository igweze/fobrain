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
	This script handle accs category
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
						$page_title = '<i class="mdi mdi-chart-box-plus-outline fs-18"></i> 
							General Ledgers';
						pageTitle($page_title, 0);	 
					?>
					<div id="msg-box"></div> 	
					<div class="card-body">
						<!-- row --> 
						<div class="row gutters "> 
							<div class="col-lg-6 col-md-6 col-sm-12 col-12 text-start"> 
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
							<div class="col-lg-6 col-md-6 col-sm-12 col-12 text-end"> 
								 
								 

								<div class="btn-group mb-10">
									<button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
										Post Journal
									</button>
									<ul class="dropdown-menu dropdown-menu-lg-end">
										<li><button class="dropdown-item add-journal-single" type="button">Direct Single Entry</button></li>
										<li><button class="dropdown-item add-journal" type="button">Direct Double Entry</button></li>
										<li><button class="dropdown-item add-payment" type="button" data-code="2">Payment</button></li>
										<li><button class="dropdown-item add-expense" type="button" data-code="2">Expenses</button></li>
										<li><button class="dropdown-item add-multi-payroll" type="button" data-code="2">Bulk Payroll</button></li>
										<li><button class="dropdown-item add-payroll" type="button" data-code="2">Single Payroll</button></li>
									</ul>
								</div>  

								 

								<div class="btn-group mb-10">
									<button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
										Accounts & Statements
									</button>
									<ul class="dropdown-menu dropdown-menu-lg-end">
										<li><button class="dropdown-item chart-acc-btn" type="button">Chart of Account</button></li>
										<li><button class="dropdown-item trial-balance-btn"type="button">Trial Balance</button></li>
										<li><button class="dropdown-item view_statement" data-code="income" type="button">Income Statement</button></li>
										<li><button class="dropdown-item view_statement" data-code="balance" type="button">Balance Sheet</button></li> 										 
									</ul>
								</div>

							</div>	
						</div>
						<!-- /row --> 

						<hr class="mb-25 text-danger" />
						<!-- row --> 
						<div class="row gutters">  

							<div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12"> 
								<!-- field wrapper start -->
								<div class="field-wrapper select-wrapper mt-0">	 
									
									<select class='form-control fob-select-chart'  
													id='chart-account' name='chart-account'> 
										<option value = "">Search . . . </option> 
										<option value = "all">All Account</option>

										<?php

	
										try {

											$cid = "";
											chartOptions($conn, 1, 0, $query = "single");
											
										}catch(PDOException $e) {
										
											fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
										
										}		
									
										

										?> 
									</select> 
									<div class="icon-wrap"  id="wait_chart_acc" style="display: none;">
										<i class="loader"></i>
									</div> 
									<div class="field-placeholder"> Search Account <span class="text-danger"></span></div>													
								</div>
								<!-- field wrapper end -->
					
							</div> 

						</div>
						<!-- /row -->
						 	  
						<div id="load-journal-div" class="pb-30"> 
							<?php //require 'journal-chart-info.php';  ?> 
						</div> 
					</div><!-- end card-body -->	
				</div>
				<!-- card end -->	
			</div>
		</div>
		<!-- / row -->	  
		 
		<!-- row -->
		<div <?php echo $fob_view; ?> class="row gutters row-section chart-section-div justify-content-center mt-100 display-none">
			<div class="col-12">	
				<!-- card start -->
				<div class="card card-shadow"> 
					<?php 
						$page_title = '<i class="mdi mdi-chart-bar-stacked fs-18"></i> 
							Chart of Accounts';
						pageTitle($page_title, 0);	 
					?>
					 
					<div class="card-body">
						<!-- row --> 
						<div class="gutters my-15 text-end"> 
							<button type="button" class="add-chart-acc btn btn-primary waves-effect me-10  
							btn-label waves-light" id="wiz-1">
								<i class="mdi mdi-notebook-plus-outline label-icon"></i>  Add Account
							</button>
						</div>
						<!-- /row -->	  
						<div id="load-chart-account" class="pb-30"> 
							<?php require 'chart-accounts-info.php';  ?> 
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
			<div class="modal-dialog modal-fullscreen  modal-dialog-scrollable">
				<div class="modal-content"> 
					<div class="modal-header"> 
						<h5 class="modal-title" id="exampleModalScrollableTitle"> 
							<i class="mdi mdi-chart-box-plus-outline label-icon"></i>  
							General Ledgers
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
		<div id="remove-msg"> </div>		

		<!--  fobrain modal start -->			
		<button type="button" class="btn modal-fobrain-2  display-none"  data-bs-toggle="modal" data-bs-target="#modal-fobrain-2"></button>				
		<!-- Scrollable modal -->
		<div class="modal fade animate__animated animate__zoomInDown" id="modal-fobrain-2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
			<div class="modal-dialog modal-fullscreen  modal-dialog-scrollable">
				<div class="modal-content"> 
					<div class="modal-header"> 
						<h5 class="modal-title" id="exampleModalScrollableTitle"> 
							<i class="mdi mdi-chart-bar-stacked label-icon"></i>  
							General Ledgers
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

		<script type="text/javascript">

			$('.chart-section-div').hide();
		
			$(function() {  /* date range function from js plugin moment */  

				var start = moment().subtract(120, 'days');
				var end = moment();

				function cb(start, end) {
					
					$('#reportrange span').html('<b>Search: </b> ' +start.format('MMMM D, YYYY') + 
					' <b-</b> ' + end.format('MMMM D, YYYY'));
											
					
					$('#start').html(start.format('YYYY-M-D'));
					$('#end').html(end.format('YYYY-M-D'));
					if((start != "") || (end != "")){
						
						searchRange();
						
					}	
					
				}
				
				$('#reportrange').daterangepicker({
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
			
			function searchRange(){   /* expense date range */ 

				$('#reportrange').hide();
				$('.date-loader, #wait_chart_acc').show();
				var postVal = 'range';
				var start = $('#start').text();
				var end = $('#end').text();
				var account = $('#chart-account').val();
				 
				$('#load-journal-div').load('journal-chart-info.php', {'search': postVal, 'search-to': end, 
					'search-from': start, 'account': account});					
				
				return false;  
	
			} 

			function trialBalance(){   /* expense date range */ 
			 
				$('#reportrange').hide();
				$('.date-loader, #wait_chart_acc').show();
				var postVal = 'trial';
				var start = $('#start').text();
				var end = $('#end').text();
				var account = $('#chart-account').val();
				var statem = $('#chart-account-tp').val(); 
				
				$('#load-journal-div').load('journal-chart-info.php', {'search': postVal, 'search-to': end, 
					'search-from': start, 'account': account, 'statem': statem});					
				
				return false;  
	
			}

			function accountStatement($query){   /* expense date range */ 
			 
				$('#reportrange').hide();
				$('.date-loader, #wait_chart_acc').show();
				var postVal = 'statement';
				var start = $('#start').text();
				var end = $('#end').text();
				var account = $('#chart-account').val();
				var statem = $query; 
				
				$('#load-journal-div').load('journal-chart-info.php', {'search': postVal, 'search-to': end, 
					'search-from': start, 'account': account, 'statem': statem});					
				
				return false;  
	
			}

			$('body').on('change','#chart-account',function(){    
				$('.chart-section-div').hide();
				searchRange();
			});

			$('body').on('click','.trial-balance-btn',function(){    
				$('.chart-section-div').hide();
				trialBalance();
			});

			$('body').on('click','.view_statement',function(){    
				$('.chart-section-div').hide();
				let $query = $(this).attr("data-code");
				accountStatement($query);
			});

			$('body').on('click','.chart-acc-btn',function(){   
				$('.chart-section-div').show(); 
				$('html, body').animate({ scrollTop:  $('.chart-section-div').offset().top - 100 }, 'slow');			
			});

			$('.fob-select-chart').each(function() {  
				renderSelect($('#'+this.id)); 
			}); 


			function renderTBFull(tableClass) { /* paginate table using jquery dataTable plugin */ 
        
				$("."+tableClass).DataTable( {
					responsive: true, 
					pageLength: 1000,
					paging: false,
					layout: {
						topStart: { 
							buttons: [

								{ extend: 'copy', text:'<i class="mdi mdi-content-copy"></i>', className: 'btn btn-sm btn-dark btn-dataTable-q' },
								{ extend: 'excel', text:'<i class="mdi mdi-microsoft-excel"></i>', className: 'btn btn-sm btn-danger btn-dataTable-q' },	
								{ extend: 'pdf', text:'<i class="mdi mdi-file-pdf-outline"></i>', className: 'btn btn-sm btn-dark btn-dataTable-q' },
								{ extend: 'print', text:'<i class="mdi mdi-printer"></i>', className: 'btn btn-sm btn-danger btn-dataTable-q' },
								{ extend: 'colvis', text:'<i class="mdi mdi-light-switch"></i>', className: 'btn btn-sm btn-dark btn-dataTable-q' }							
									
							] 
						}
					}
						
				} );
				
			}


			function renderTB(tableClass) { /* paginate table using jquery dataTable plugin */ 
        
				$("."+tableClass).DataTable( {
					responsive: true, 
					paging: {
						buttons: 3
					},
					layout: {
						topStart: { 
							buttons: [

								{ extend: 'copy', text:'<i class="mdi mdi-content-copy"></i>', className: 'btn btn-sm btn-dark btn-dataTable-q' },
								{ extend: 'excel', text:'<i class="mdi mdi-microsoft-excel"></i>', className: 'btn btn-sm btn-danger btn-dataTable-q' },	
								{ extend: 'pdf', text:'<i class="mdi mdi-file-pdf-outline"></i>', className: 'btn btn-sm btn-dark btn-dataTable-q' },
								{ extend: 'print', text:'<i class="mdi mdi-printer"></i>', className: 'btn btn-sm btn-danger btn-dataTable-q' },
								{ extend: 'colvis', text:'<i class="mdi mdi-light-switch"></i>', className: 'btn btn-sm btn-dark btn-dataTable-q' }							
									
							] 
						}
					}
						
				} );
				
			}
				 
		</script> 
					