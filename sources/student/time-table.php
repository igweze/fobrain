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
	This page load school event calendar
	------------------------------------------------------------------------*/ 


		if (!defined('fobrain')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
				
		require_once $fobrainIconPage; /* This include top middle global icon page eg go back, print buttons etcs */ 
			
	 
?> 
 
		<style> 
			div.timeline {
				width: 100% !important; 
			} 
		</style>

		<!-- row -->
		<div <?php echo $fob_view; ?> class="row gutters row-section fobrain-section-div justify-content-center">
			<div class="col-12">	
				<!-- card start -->
				<div class="card card-shadow"> 
					<?php 
						$page_title = '<i class="mdi mdi-timeline-clock-outline fs-18"></i> 
						School Timetable';
						pageTitle($page_title, 0);	 
					?>
					<div id="msg-box"></div> 					
					<div class="card-body"> 
						<div id="calendar" class="my-15"></div> 
					</div>
				</div>
				<!-- card end -->	
			</div>
		</div>
		<!-- / row -->	 
 
		<script>

			$(function(){

				var calendarEl = document.getElementById('calendar'); 

				var calendar = new FullCalendar.Calendar(calendarEl, {

					headerToolbar: {
						left: 'prev,next',
						center: 'title',
						right: 'today'
					},
					height: 650,
					events: 'time-table-info.php',
					
					selectable: true,
					
					eventClick: function(info) {
					info.jsEvent.preventDefault();
					
					// change the border color
					info.el.style.borderColor = 'red';

					//html:'<p>'+info.event.extendedProps.comments+'</p>',
					
					Swal.fire({
						//title: info.event.title,
						//text: info.event.extendedProps.comments,
						//icon: 'info',
						html: 
						'<div class="rows mt-50">' +
							'<div class="col-12">' +
								'<div class="attendance-timeline">' +
									'<div class="timeline filter-item" >' +
										'<a href="#" class="timeline-content">' +
											'<div class="timeline-year"><i class="mdi mdi-timeline-clock-outline"></i> Timetable </div>' +
											'<h3 class="title">'+info.event.title+'</h3>' +
											'<hr class="my-15 text-danger" />' +
											'<h3 class="title mt-20 start-end">Details</h3>' +
											'<p class="description">'+info.event.extendedProps.comments+'</p>' +											  
										'</a>' +
									'</div>' +
								'</div>' +
							'</div>' +
						'</div>', 					 
						showCloseButton: true,
						showCancelButton: true, 
						cancelButtonText: '<i class="mdi mdi-close-circle"></i> Close',					
						customClass: { 
							cancelButton: 'swal2-button-fobrain swal2-cancel-button-fobrain' 
						}, 
						
					});
					}
				});	 

				calendar.render(); 
				
			});
		</script>