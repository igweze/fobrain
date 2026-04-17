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
	This script load common wall companion script
	------------------------------------------------------------------------*/
	
	?>

		$('body').on('click','.edit-staff',function(event){  /* edit staff profile */ 

			event.stopImmediatePropagation();  

			var emptyStr = "";
			var varID = this.id; 			

			showPageLoader();

			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();

			$('#modal-load-div').load('staff-bio.php', { 'teacherID': varID, 'show_more': 0}).fadeIn(1000); 

			$('.modal-fobrain').click();	 

			return false;		 

		});

		
		$('body').on('click','.edit-staff-pro',function(event){  /* edit staff profile */ 

			event.stopImmediatePropagation();  

			var emptyStr = "";
			var varID = this.id; 			

			showPageLoader(); 

			$('#modal-load-div').load('staff-bio.php', { 'teacherID': varID, 'show_more': 0}).fadeIn(1000); 
 
			$('html, body').animate({ scrollTop:  $('#modal-load-div').offset().top - 130 }, 'slow'); 

			return false;		 

		});

		$('body').on('click','.view-staff-i',function(event){  /* vie staff profile */
			
			event.stopImmediatePropagation(); 

			var emptyStr = "";
			var varID = this.id;
			var postVal = 'view';				
			
			showPageLoader();

			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();
			
			$('#modal-load-div').load('staff-profile.php', {'staff': postVal, 'teacherID': varID, 'show_more': 0}).fadeIn(1000); 
			
			$('.modal-fobrain').click();					
			
			return false;  		 
		
		}); 
		
		$('body').on('click','.view-staff-pro',function(event){  /* vie staff profile */
			
			event.stopImmediatePropagation(); 

			var emptyStr = "";
			var varID = this.id;
			var postVal = 'view';				
			
			showPageLoader(); 
			
			$('#modal-load-div').load('staff-profile.php', {'staff': postVal, 'teacherID': varID, 'show_more': 0}).fadeIn(1000); 
			
			$('html, body').animate({ scrollTop:  $('#modal-load-div').offset().top - 130 }, 'slow'); 					
			
			return false;  		 
		
		});

		$('body').on('click','#saveStaff1',function(){  /* edit staff profile */
			
			$('#frmStaff1').submit(function(event) {
							
				event.stopImmediatePropagation();
				
				showPageLoader(); 
						
				$.post('staff-manager.php', $(this).find('select, input, textarea').serialize(), function(data) {
					
					$('.msg-box-st').html(data);									
																
				});
				
				//$('html, body').animate({ scrollTop:  $('.msg-box-st').offset().top - 100 }, 'slow');
	  
				return false;
			
			});	
			
		}); 

		$('body').on('click','#saveStaff2',function(){  /* edit staff profile */
		
			$('#frmStaff2').submit(function(event) {
							
				event.stopImmediatePropagation();
				
				showPageLoader(); 
						
				$.post('staff-manager.php', $(this).find('select, input, textarea').serialize(), function(data) {
					
					$('.msg-box-st').html(data);									
																
				});
				
				//$('html, body').animate({ scrollTop:  $('.msg-box-st').offset().top - 100 }, 'slow');
	
				return false;
			
			});	
			
		});

		$('body').on('click','#saveStaff3',function(){  /* edit staff profile */
		
			$('#frmStaff3').submit(function(event) {
							
				event.stopImmediatePropagation();
				
				showPageLoader(); 
						
				$.post('staff-manager.php', $(this).find('select, input').serialize(), function(data) {
					
					$('.msg-box-st').html(data);									
																
				});
				
				//$('html, body').animate({ scrollTop:  $('.msg-box-st').offset().top - 100 }, 'slow');
	
				return false;
			
			});	
			
		});

		$('body').on('click','#saveStaff4',function(){  /* edit staff profile */
		
			$('#frmStaff4').submit(function(event) {
							
				event.stopImmediatePropagation();
				
				showPageLoader(); 
						
				$.post('staff-manager.php', $(this).find('select, input').serialize(), function(data) {
					
					$('.msg-box-st').html(data);									
																
				});
				
				//$('html, body').animate({ scrollTop:  $('.msg-box-st').offset().top - 100 }, 'slow');
	
				return false;
			
			});	
			
		});	
		
		$('body').on('click','#updatePass',function(){  /* edit staff profile */
			
			$('#frmupdatePass').submit(function(event) {
							
				event.stopImmediatePropagation();
				
				showPageLoader(); 
						
				$.post('staff-manager.php', $(this).find('select, input, textarea').serialize(), function(data) {
					
					$('#msg-box').html(data);									
																
				}); 
	  
				return false;
			
			});	
			
		});

		$('body').on('click','#saveStaffLeave',function(){  /* save school event */
			
			$('#frmsaveStaffLeave').submit(function(event) {		
				
				showPageLoader();	
		
				event.stopImmediatePropagation();
						
				$.post('leave-staff-manager.php', $(this).find('select, input, textarea').serialize(), function(data) {
					
					$('#edit-msg').html(data);	 			
					
				}); 

				return false;
		
			});		 
			
		});		

		$('body').on('click','.add-leave-staff',function(event){  /* viewstaff leave */
			
			event.stopImmediatePropagation();	
			
			var emptyStr = "";
			var gradeID = this.id;
			var postVal = 'load';				
			
			showPageLoader();

			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();
			
			$('#modal-load-div').load('leave-staff-manager.php', {'leave_st': postVal, 'rData': gradeID
									}).fadeIn(1000);										   
									
			$('.modal-fobrain').click();		 

			return false;   
			
		});

		$('body').on('click','.edit-leave-staff',function(event){  /* editstaff leave */
		
			event.stopImmediatePropagation();	
			
			var emptyStr = "";
			var gradeID = this.id;
			var postVal = 'edit';				
			
			showPageLoader();
			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();
			
			$('#modal-load-div').load('leave-staff-manager.php', {'leave_st': postVal, 'rData': gradeID
								}).fadeIn(1000);	 
			
			$('.modal-fobrain').click();					
			
			return false;  

		});  
		
		$('body').on('click','.remove-leave-staff',function(event){  /* removestaff leave */
			
			event.stopImmediatePropagation();

			Swal.fire({
				title: "Are you sure?",
				text: "You won't be able to revert this!",
				icon: "warning",
				showCancelButton: true,
				confirmButtonColor: "#3085d6",
				cancelButtonColor: "#d33",
				confirmButtonText: "Yes, Delete it!"
			}).then((result) => {
				
				if (result.isConfirmed) {
					
					var rData = this.id;
					var postVal = 'remove';
				
					showPageLoader();
				
					$('#msg-box').load('leave-staff-manager.php', {'leave_st': postVal, 'rData': rData}).fadeIn(1000);	
					
				}
			}); 

			return false;	 
		
		});  
		
		$('body').on('click','#updateStaffLeave',function(){  /* upgradestaff leave */
		
			$('#frmupdateStaffLeave').submit(function(event) {		
				
				showPageLoader();	
		
				event.stopImmediatePropagation();
						
				$.post('leave-staff-manager.php', $(this).find('select, input, textarea').serialize(), function(data) {
					
					$('#edit-msg').html(data);	
					//$('html, body').animate({ scrollTop:  $('#edit-msg').offset().top - 30 }, 'slow');			
					
				}); return false; 
		
			});		

		});

 		$('body').on('click','.view-payroll',function(event){  /* view payroll #Common */
			
			event.stopImmediatePropagation();	
			
			var emptyStr = "";
			var payrollID = this.id;
			var postVal = 'view';				
			
			showPageLoader();
			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();
			
			$('#modal-load-div').load('payroll-manager.php', {'payroll': postVal, 'rData': payrollID
								}).fadeIn(1000);										   
									
			$('.modal-fobrain').click();					
			
			return false;  
		
		});

		$('body').on('change','#uploadStaffPic',function(){  /* upload staff picture */

			$('.fob-btn-div').fadeOut(100);
			$('.fob-btn-loader').fadeIn(100); 

			var form_data = new FormData($('#frmStaffPic')[0]);

			$.ajax({
				url: 'staff-manager.php',
				dataType: 'text',
				cache: false,
				contentType: false,
				processData: false,
				data: form_data,
				type: 'post',
				success: function (response) {
					$('.msg-box-pic').html(response); 
				},
				error: function (response) {
					$('.msg-box-pic').html(response);
				}
			});

			return false;

		});  

		$('body').on('change','#uploadNatID',function(){  /* upload staff national id */

			$('.fob-btn-natid').fadeOut(100);
			$('.fob-loader-natid').fadeIn(100); 

			var form_data = new FormData($('#frmNatID')[0]);

			$.ajax({
				url: 'staff-manager.php',
				dataType: 'text',
				cache: false,
				contentType: false,
				processData: false,
				data: form_data,
				type: 'post',
				success: function (response) {
					$('.msg-box-pic').html(response); 
				},
				error: function (response) {
					$('.msg-box-pic').html(response);
				}
			});

			return false;

		});
		
		$('body').on('change','#uploadApp',function(){  /* upload staff appoin. letter */

			$('.fob-btn-appoint').fadeOut(100);
			$('.fob-loader-appoint').fadeIn(100); 

			var form_data = new FormData($('#frmApp')[0]);

			$.ajax({
				url: 'staff-manager.php',
				dataType: 'text',
				cache: false,
				contentType: false,
				processData: false,
				data: form_data,
				type: 'post',
				success: function (response) {
					$('.msg-box-pic').html(response); 
				},
				error: function (response) {
					$('.msg-box-pic').html(response);
				}
			});

			return false;

		});

		$('body').on('change','#uploadDoc1',function(){  /* upload staff doc 1 */

			$('.fob-btn-doc1').fadeOut(100);
			$('.fob-loader-doc1').fadeIn(100); 

			var form_data = new FormData($('#frmDoc1')[0]);

			$.ajax({
				url: 'staff-manager.php',
				dataType: 'text',
				cache: false,
				contentType: false,
				processData: false,
				data: form_data,
				type: 'post',
				success: function (response) {
					$('.msg-box-pic').html(response); 
				},
				error: function (response) {
					$('.msg-box-pic').html(response);
				}
			});

			return false;

		});

		$('body').on('change','#uploadDoc2',function(){  /* upload staff doc 2 */

			$('.fob-btn-doc2').fadeOut(100);
			$('.fob-loader-doc2').fadeIn(100); 

			var form_data = new FormData($('#frmDoc2')[0]);

			$.ajax({
				url: 'staff-manager.php',
				dataType: 'text',
				cache: false,
				contentType: false,
				processData: false,
				data: form_data,
				type: 'post',
				success: function (response) {
					$('.msg-box-pic').html(response); 
				},
				error: function (response) {
					$('.msg-box-pic').html(response);
				}
			});

			return false;

		});

		$('body').on('change','#uploadDoc3',function(){  /* upload staff doc 3 */

			$('.fob-btn-doc3').fadeOut(100);
			$('.fob-loader-doc3').fadeIn(100); 

			var form_data = new FormData($('#frmDoc3')[0]);

			$.ajax({
				url: 'staff-manager.php',
				dataType: 'text',
				cache: false,
				contentType: false,
				processData: false,
				data: form_data,
				type: 'post',
				success: function (response) {
					$('.msg-box-pic').html(response); 
				},
				error: function (response) {
					$('.msg-box-pic').html(response);
				}
			});

			return false;

		});  

		$('body').on('click','.view-broadcast ',function(event){  /* view school broadcast */
			
			event.stopImmediatePropagation();	
			
			var emptyStr = "";
			var broadcastID = this.id;
			var postVal = 'view';				
			
			showPageLoader();
			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();
			
			$('#modal-load-div').load('broadcast-manager.php', {'broadcast': postVal, 'rData': broadcastID
									}).fadeIn(1000);										   
									
			$('.modal-fobrain').click();						
			
			return false;  
		
		});

		$('body').on('click','.view-event ',function(event){  /* view school event */
			
			event.stopImmediatePropagation();	
			
			var emptyStr = "";
			var eventID = this.id;
			var postVal = 'view';				
			
			showPageLoader();
			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();
			
			$('#modal-load-div').load('event-manager.php', {'event': postVal, 'rData': eventID
									}).fadeIn(1000);										   
									
			$('.modal-fobrain').click();						
			
			return false;  
		
		});

		$('body').on('click','.start-parmeeting',function(event){  /* view online parmeeting */
			
			event.stopImmediatePropagation(); 

			var emptyStr = "";
			var parmeetingID = this.id;
			var postVal = 'start';				

			showPageLoader(); 

			$('#edit-msg').load( 'parent-meeting-manager.php', {'parmeeting': postVal, 'eData': parmeetingID });  

			$('#fob-wrapper').css('display', 'none');
			$('#virtual-loading').show();

			return false;   
		
		}); 
		
		$('body').on('click','.view-parmeeting',function(event){  /* view online parmeeting */
		
			event.stopImmediatePropagation(); 

			var emptyStr = "";
			var parmeetingID = this.id;
			var postVal = 'view';				

			showPageLoader();

			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();

			$('#modal-load-div').load( 'parent-meeting-manager.php', {'parmeeting': postVal, 'eData': parmeetingID }); 

			$('.modal-fobrain').click();					

			return false;   
		
		});

		$('body').on('click','.start-staffmeeting',function(event){  /* view online staffmeeting */
			
			event.stopImmediatePropagation(); 

			var emptyStr = "";
			var staffmeetingID = this.id;
			var postVal = 'start';				

			showPageLoader(); 

			$('#edit-msg').load( 'staff-meeting-manager.php', {'staffmeeting': postVal, 'eData': staffmeetingID });  

			$('#fob-wrapper').css('display', 'none');
			$('#virtual-loading').show();

			return false;   
		
		}); 

		$('body').on('click','.view-staffmeeting',function(event){  /* view online staffmeeting */
		
			event.stopImmediatePropagation(); 

			var emptyStr = "";
			var staffmeetingID = this.id;
			var postVal = 'view';				

			showPageLoader();

			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();

			$('#modal-load-div').load( 'staff-meeting-manager.php', {'staffmeeting': postVal, 'eData': staffmeetingID }); 

			$('.modal-fobrain').click();					

			return false;   
		
		});

		$('body').on('click','#virtual-loading',function(event){  /* reload online staffmeeting */
		
			location.reload();   
		
		});

		$('body').on('change','#roll-widget',function(event){  /* save student rollCall */
			
			event.stopImmediatePropagation(); 
		 
			var rdate = $('#roll-widget').val(); 
			var roll = "widget"; 

			showPageLoader();

			$('#roll-call-widget').load('roll-call-manager.php', {'roll': roll, 'rdate': rdate  }).fadeIn(1000); 
			
			return false;   

		});

		$('body').on('click','.school-mode', function(event){  /* change school mode type */

			event.stopImmediatePropagation();
			showPageLoader();
			var clickMode = this.id.split('-');
			var fobrainID = clickMode[2];

			var fobrain = 'run';

			$('#wizg-msg-box').load('mode-setter.php', {'fobrainMode': fobrainID, 
														'mode':fobrain }).fadeIn(300); 

			return false; 

		});	

		$('body').on('click','#lock-login',function(){  /* screen lock validation */
				
			$('#frm-lock-login').submit(function(event) {		
					
				showPageLoader();
			
				event.stopImmediatePropagation();
						
				$.post('time-out-manger.php', $(this).find('select, input').serialize(), function(data) {
					
					$('#msg-box-lo').html(data);	 
				
				});
		
				return false;
			
			});		
		}); 

		setInterval(function() {  /* check inactivity user time */

			var timerData = 'checkTimer';

			$('#wizg-activity').load('activity-timer.php', {'timer': timerData});

		}, 30000); 
