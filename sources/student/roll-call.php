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
	This page is for  student roll call
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
		<div <?php echo $fob_view; ?> class="row gutters row-section  justify-content-center">
			<div class="col-12">	
				<!-- card start -->
				<div class="card card-shadow">
         			<?php 
					$page_title = '<i class="fas fa-list-ol fs-16"></i> 
            						Student Attendance ';
						pageTitle($page_title, 1);	 
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
					events: 'rollcall-info.php',					
					selectable: true,					
					eventClick: function(info) {
					info.jsEvent.preventDefault();
					
					// change the border color
					info.el.style.borderColor = 'red';
					//html:'<h4 class="text-primary">Teacher Comment</h4><p>'+info.event.extendedProps.comments+'</p><hr class="my-15 text-danger" /><h4 class="text-primary">Parent Comment</h4><p>'+info.event.extendedProps.reply+'</p>',

					Swal.fire({
						//title: info.event.title,
						//text: info.event.extendedProps.comments,
						//icon: 'info',						 
						html: 
						'<div class="rows mt-40">' +
							'<div class="col-12">' +
								'<div class="attendance-timeline">' +
									'<div class="timeline filter-item" >' +
										'<a href="#" class="timeline-content">' +
											'<div class="timeline-year"><i class="mdi mdi-comment-multiple"></i> Attendance</div>' +
											'<h3 class="title text-end">'+info.event.title+'</h3>' +
											'<h3 class="title mt-20 start-end">Teacher Comment</h3>' +
											'<p class="description">'+info.event.extendedProps.comments+'</p>' +
											'<hr class="my-15 text-danger" />' +
											'<h3 class="title mt-20 start-end">Parent Reply</h3>' +
											'<p class="description">'+info.event.extendedProps.reply+'</p>' +  
										'</a>' +
									'</div>' +
								'</div>' +
							'</div>' +
						'</div>',
						showCloseButton: true,
						showCancelButton: true,
						showDenyButton: true,
						cancelButtonText: '<i class="mdi mdi-close-circle"></i> Close', 
						denyButtonText: '<i class="mdi mdi-square-edit-outline"></i> Drop Reply',
						customClass: { 
							cancelButton: 'swal2-button-fobrain swal2-cancel-button-fobrain', 
							denyButton: 'swal2-button-fobrain swal2-deny-button-fobrain'
						}, 
						
					}).then((result) => {
						if (result.isConfirmed) {
						// Delete event
						fetch("rollcall-manager.php", {
							method: "POST",
							headers: { "Content-Type": "application/json" },
							body: JSON.stringify({ request_type:'delete', event_id: info.event.id}),
						})
						.then(response => response.json())
						.then(data => {
							if (data.status == 1) {
							Swal.fire('Attendance deleted successfully!', '', 'success'); 
							} else {
							Swal.fire(data.error, '', 'error');
							}

							// Refetch events from all sources and rerender
							calendar.refetchEvents();
						})
						.catch(console.error);
						} else if (result.isDenied) {
						// Edit and update event
						//'<p class="fs-18 text-primary">'+info.event.title+'</p><hr class="my-5 text-danger" /><h4 class="text-primary">Teacher Comment</h4><p>'+info.event.extendedProps.comments+'</p><hr class="my-15 text-danger" /><h4 class="text-primary">Parent Comment</h4>' +		
							//'<textarea id="swalEvtDesc_edit" class="form-swal form-swal-area" placeholder="Enter Comment">'+info.event.extendedProps.reply+'</textarea>',
							 
						Swal.fire({
							title: '<i class="mdi mdi-comment-text-multiple-outline fs-24"></i>  Drop Reply',						 
							html: 
							'<div class="rows">' +
								'<div class="col-12">' +
									'<div class="attendance-timeline">' +
										'<div class="timeline filter-item" >' +
											'<div href="#" class="timeline-content">' +
												'<div class="timeline-year"><i class="mdi mdi-comment-multiple"></i> Reply</div>' +
												'<h3 class="title text-end">'+info.event.title+'</h3>' +
												'<h3 class="title mt-20 start-end">Teacher Comment</h3>' +
												'<p class="description">'+info.event.extendedProps.comments+'</p>' +
												'<hr class="my-15 text-danger" />' +
												'<h3 class="title mt-20 start-end">Parent Reply</h3>' +
												'<div><textarea id="swalEvtDesc_edit" class="form-swal form-swal-area" placeholder="Enter Comment">'+info.event.extendedProps.reply+'</textarea></div>' + 
											'</div>' +
										'</div>' +
									'</div>' + 
								'</div>' +
							'</div>',
							
							showCloseButton: true,
							showCancelButton: true,
							focusConfirm: false,
							confirmButtonText: '<i class="mdi mdi-content-save"></i> Send', 
							cancelButtonText: '<i class="mdi mdi-close-circle"></i> Close',
							customClass: {
								confirmButton: 'swal2-button-fobrain swal2-confirm-button-fobrain',
								cancelButton: 'swal2-button-fobrain swal2-cancel-button-fobrain'
							},                    
							preConfirm: () => {
							return [ 
								document.getElementById('swalEvtDesc_edit').value 
							];
							}
						}).then((result) => {
							if (result.value) {
							// Attendance update request
							fetch("rollcall-manager.php", {
								method: "POST",
								headers: { "Content-Type": "application/json" },
								body: JSON.stringify({request_type:'reply', start:info.event.startStr, end:info.event.endStr, event_id: info.event.id, event_data: result.value}),
							})
							.then(response => response.json())
							.then(data => {
								if (data.status == 1) {
								Swal.fire('Your Reply was updated successfully!', '', 'success'); 
								} else {
								Swal.fire(data.error, '', 'error');
								}

								// Refetch events from all sources and rerender
								calendar.refetchEvents();
							})
							.catch(console.error);
							}
						});
						} else {
						Swal.close();
						}
					});
					}
				}); 

				calendar.render();
				
			});
		</script>