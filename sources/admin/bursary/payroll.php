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
	This script handle school payroll 
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
							  Payroll Manager';
						pageTitle($page_title, 0);	 
					?>
					<div id="msg-box"></div> 	
					<div class="card-body">

						 <!-- row --> 
						 <div class="row gutters my-15"> 
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
								<button type="button" class="add-payroll btn btn-primary waves-effect   
								btn-label waves-light" id="wiz-1">
									<i class="mdi mdi-notebook-plus-outline label-icon"></i>  Add
								</button>
								<button type="button" class="add-multi-payroll btn btn-dark waves-effect   
								btn-label waves-light" id="wiz-1">
									<i class="mdi mdi-notebook-plus-outline label-icon"></i>  Bulk Add
								</button>
							</div>	
						</div>
						<!-- /row -->
						 
						<div class="clear-ft"></div> 
						<div id="load-payroll-info" class="pb-30"> 
							<?php require 'payroll-info.php';  ?> 
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
			<div class="modal-dialog modal-fullscreen modal-dialog-scrollable">
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
						searchRange();						
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
			
			function searchRange(){   /* payroll  date range */													
				
				//showPageLoader();
				$('#reportrange').hide();
				$('.date-loader').show();
				var postVal = 'range';
				var start = $('#start').text();
				var end = $('#end').text();
				
				$('#load-payroll-info').load('payroll-info.php', {'search': postVal, 'search-to': end, 
					'search-from': start});				
				
				return false;  
	
			}      

		</script> 