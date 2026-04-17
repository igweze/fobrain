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
						$page_title = '<i class="mdi mdi-calendar-multiple fs-18"></i> 
						School Events';
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
					events: 'events-info.php',
					
					selectable: true,
					select: async function (start, end, allDay) {
					const { value: formValues } = await Swal.fire({
						title: '<i class="mdi mdi-timeline-clock-outline fs-24"></i> Add Event',
						html:
						'<input id="swalEvtTitle" class="form-swal form-swal-input" placeholder="Enter title">' +
						'<textarea id="swalEvtDesc" class="form-swal form-swal-area" placeholder="Enter description"></textarea>',
						showCloseButton: true,
						showCancelButton: true,
						confirmButtonText: '<i class="mdi mdi-content-save"></i> Save',
						cancelButtonText: '<i class="mdi mdi-close-circle"></i> Close',
						customClass: {
							confirmButton: 'swal2-button-fobrain swal2-confirm-button-fobrain',
							cancelButton: 'swal2-button-fobrain swal2-cancel-button-fobrain'
						}, 
						focusConfirm: false,
						preConfirm: () => {
						return [
							document.getElementById('swalEvtTitle').value,
							document.getElementById('swalEvtDesc').value 
						]
						}
					});

					if (formValues) {
						// Add event
						fetch("event-manager.php", {
						method: "POST",
						headers: { "Content-Type": "application/json" },
						body: JSON.stringify({ request_type:'add', start:start.startStr, end:start.endStr, event_data: formValues}),
						})
						.then(response => response.json())
						.then(data => {
						if (data.status == 1) {
							Swal.fire('Event added successfully!', '', 'success');
						} else {
							Swal.fire(data.error, '', 'error');
						}
						// Refetch events from all sources and rerender
						calendar.refetchEvents();
						})
						.catch(console.error);
					}
					},

					eventClick: function(info) {
					info.jsEvent.preventDefault();
					
					// change the border color
					info.el.style.borderColor = 'red';
					
					Swal.fire({
						//title: info.event.title,
						//text: info.event.extendedProps.comments,
						//icon: 'info',
						//html:'<p>'+info.event.extendedProps.comments+'</p>',
						html: 
						'<div class="rows mt-50">' +
							'<div class="col-12">' +
								'<div class="attendance-timeline">' +
									'<div class="timeline filter-item" >' +
										'<a href="#" class="timeline-content">' +
											'<div class="timeline-year"><i class="mdi mdi-calendar-multiple"></i> Events </div>' +
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
						showDenyButton: true,
						cancelButtonText: '<i class="mdi mdi-close-circle"></i> Close',
						confirmButtonText: '<i class="mdi mdi-delete"></i> Delete',
						denyButtonText: '<i class="mdi mdi-square-edit-outline"></i> Edit',
						customClass: {
							confirmButton: 'swal2-button-fobrain swal2-confirm-button-fobrain',
							cancelButton: 'swal2-button-fobrain swal2-cancel-button-fobrain', 
							denyButton: 'swal2-button-fobrain swal2-deny-button-fobrain'
						}, 
						
					}).then((result) => {
						if (result.isConfirmed) {
						// Delete event
						fetch("event-manager.php", {
							method: "POST",
							headers: { "Content-Type": "application/json" },
							body: JSON.stringify({ request_type:'delete', event_id: info.event.id}),
						})
						.then(response => response.json())
						.then(data => {
							if (data.status == 1) {
							Swal.fire('Event deleted successfully!', '', 'success'); 
							} else {
							Swal.fire(data.error, '', 'error');
							}

							// Refetch events from all sources and rerender
							calendar.refetchEvents();
						})
						.catch(console.error);
						} else if (result.isDenied) {
						// Edit and update event
						Swal.fire({
							title: '<i class="mdi mdi-timeline-clock-outline fs-24"></i>  Edit Event',						 
							html:
							'<input id="swalEvtTitle_edit" class="form-swal form-swal-input" placeholder="Enter title" value="'+info.event.title+'">'+
							'<textarea id="swalEvtDesc_edit" class="form-swal form-swal-area" placeholder="Enter description">'+info.event.extendedProps.comments+'</textarea>',
							showCloseButton: true,
							showCancelButton: true,
							focusConfirm: false,
							confirmButtonText: '<i class="mdi mdi-content-save"></i> Update', 
							cancelButtonText: '<i class="mdi mdi-close-circle"></i> Close',
							customClass: {
								confirmButton: 'swal2-button-fobrain swal2-confirm-button-fobrain',
								cancelButton: 'swal2-button-fobrain swal2-cancel-button-fobrain'
							},                    
							preConfirm: () => {
							return [
								document.getElementById('swalEvtTitle_edit').value,
								document.getElementById('swalEvtDesc_edit').value 
							];
							}
						}).then((result) => {
							if (result.value) {
							// Event update request
							fetch("event-manager.php", {
								method: "POST",
								headers: { "Content-Type": "application/json" },
								body: JSON.stringify({request_type:'edit', start:info.event.startStr, end:info.event.endStr, event_id: info.event.id, event_data: result.value}),
							})
							.then(response => response.json())
							.then(data => {
								if (data.status == 1) {
								Swal.fire('Event updated successfully!', '', 'success'); 
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