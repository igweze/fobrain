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

		$('body').on('click','#deleteMsg',function(event){							   

			Swal.fire({
				title: "Information!",
				text: "Ooops, this function has been disenable in the demo. Thanks",
				icon: "info"
			});
			
		});
		
		$('body').on('click','.demo-click',function(event){							   

			Swal.fire({
				title: "Information!",
				text: "Ooops, this function has been disenable in the demo. Thanks",
				icon: "info"
			});
			
			return false;
			
		});
		
		$('body').on('click', '.coming_soon', function(event){																
															
			Swal.fire({
				title: "Information!",
				text: "This function is coming soon in new upgrades. Meanwhile, only pictures upload is available now. Thanks",
				icon: "info"
			});
		
		}); 

		$('body').on('click', '.zoom-img',function(event){  

			var src = this.id;
			
			$('<div>').css({
				background: 'RGBA(0,0,0,.5) url('+src+') no-repeat center',
				backgroundSize: 'contain',
				width:'100%', height:'100%',
				position:'fixed',
				zIndex:'10000',
				top:'0', left:'0',
				cursor: 'zoom-out'
			}).click(function(){
				$(this).remove();
			}).appendTo('body');
			
			return false; 
			
		});

		
		/* nl2br function */
		
		function nl2br (str, is_xhtml) {   
			var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';    
			return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1'+ breakTag +'$2');
		}
		
		$('body').on('click','#moreMailBoxInfo',function(){ /* load more mail from bar notification  */
		
			$('ul.sidebar-menu li a').removeClass('active');
			
			$('#myInbox').addClass('active');
			
			var postVal = 'inbox';
			
			showPageLoader();
			
			$('#fobrain-content').load('navigator-s', {'iemj': postVa});
		
		});
		
		$('body').on('click','.readMailTopNav',function(){ /*  read mail from bar notification */
													
			var clickedID = this.id.split('-');
			var msgID = clickedID[1];
			var memberID = clickedID[2];
			var senderID = clickedID[3];
			var postVal = 'inbox';
			var viewMailTop = msgID+'-'+memberID+'-'+senderID;
			
			$('ul.sidebar-menu li a').removeClass('active');
			
			$('#myInbox').addClass('active');
			
			showPageLoader();	
			
			$('#fobrain-content').load('navigator-s.php',  {'iemj': postVal, 'viewMailTop': viewMailTop}); 
			
			$('html, body').animate({ scrollTop:  $('.scrollMailTarget').offset().top - 50 }, 'slow'); 
		
		});
		
		$('body').on('click','.readMailTopNavS',function(){ /* read mail from bar notification  */
													
			var clickedID = this.id.split('-');
			var msgID = clickedID[1];
			var memberID = clickedID[2];
			var senderID = clickedID[3];
			var postVal = 'inbox';
			var viewMailTop = msgID+'-'+memberID+'-'+senderID;
			
			$('ul.sidebar-menu li a').removeClass('active');
			
			$('#myInbox').addClass('active');
			
			showPageLoader();	
			
			$('#fobrain-content').load('navigator-ss.php',  {'iemj': postVal, 'viewMailTop': viewMailTop}); 
			
			$('html, body').animate({ scrollTop:  $('.scrollMailTarget').offset().top - 50 }, 'slow'); 
		
		});
		
		$('body').on('click','.showCWallNotification',function(){ /* show companion wall notification */
													
			var clickedID = this.id.split('-');
			
			var notificPostID = clickedID[1];
			var postVal = 'wall-comp';
			$('ul.sidebar-menu li a').removeClass('active');
			$('#wallCompanion').addClass('active');
			
			showPageLoader();	
			
			$('#fobrain-content').load('navigator-s.php', {'iemj': postVal, 
									'notificPostID': notificPostID}); $('#fobrain-content').slideDown(100); 
			
			hidePageLoader();
		
		}); 
		
		$('body').on('click','.showCWallNotificationS',function(){ /* show companion wall notification */
													
			var clickedID = this.id.split('-');
			
			var notificPostID = clickedID[1];
			var postVal = 'wall-comp';
			$('ul.sidebar-menu li a').removeClass('active');
			$('#wallCompanion').addClass('active');
			
			showPageLoader();	
			
			$('#fobrain-content').load('navigator-ss.php', {'iemj': postVal, 
									'notificPostID': notificPostID}); $('#fobrain-content').slideDown(100); 
			
			hidePageLoader();
		
		});  
		
		
		$('body').on('click','#sendNjidekaMail, #sendNkirukaMail',function(){ /* send mail  */
								
			$('#frmsendNjidekaMail, #frmsendNkirukaMail').submit(function(event) {
			
				event.stopImmediatePropagation();
				
				$('.sendMsgLoader').fadeIn(100);
				
				$.post('comp-mailbox-manager.php', $(this).find('input, textarea').serialize(), function(data) {
					
					$('#msgBoxInfo').html(data);				
					$('.sendMsgLoader').fadeOut(1000);
			
				});  return false;
			
			});	   
		
		}); 
		
		$('body').on('click','#replyMail',function(){ /* reply an email */
															
			$('#frmreplyMail').submit(function(event) {
			
				event.stopImmediatePropagation();
				
				$('#replyMsgLoader').fadeIn(100);
				
				$.post('comp-mailbox-manager.php', $(this).find('input, textarea').serialize(), function(data) {
					
					$('#replyMsgDiv').html(data);				
					$('#replyMsgLoader').fadeOut(1000);
				
				}); return false;
			
			});	 
		
		}); 
		
		$('body').on('click','#saveDraftMsg',function(event){ /* save draft email */
		
			event.stopImmediatePropagation();					
			
			var msgTitle = $('#msgTitle').val();
			var mailMsg = $('#Message').val();
			var memberID = $('#frmmemberID').text();
			var Message = 'saveDraftMail';
		
			$('.sendMsgLoader').fadeIn(100);
			
			$('#msgBoxInfo').load('comp-mailbox-manager.php', {'messageData': Message, 'memberID': memberID, 
								  'msgTitle': msgTitle, 'mailMsg': mailMsg }).fadeIn(600);					
		
			$('.sendMsgLoader').fadeOut(1000);
			$('html, body').animate({ scrollTop:  $('.scrollMailTarget').offset().top - 50 }, 'slow');
		
			return false;  
		
		});	 
		
		$('body').on('click','#composeMsg',function(event){ /* compose an email */
		
			event.stopImmediatePropagation();									  
			var Title = $('#mailTopTitle').text();
			$('#mailTitleHolder').html(Title);
			$('#inboxmsgBoxDiv').fadeOut(500);
			$('#composeMsg').fadeOut(500);
			$('#composeMsgBoxDiv').fadeIn(500);
			$('#mailTopTitle').html('Compose Message');	
			$('html, body').animate({ scrollTop:  $('.scrollMailTarget').offset().top - 50 }, 'slow');
												  
			return false;
		
		}); 
		
		$('body').on('click','#cancelComposeMsg',function(event){ /* cancel compose email */
		
			event.stopImmediatePropagation();		
			var Title = $('#mailTitleHolder').text();
			$('#composeMsgBoxDiv').fadeOut(500);
			$('#composeMsg').fadeIn(500);
			$('#inboxmsgBoxDiv').fadeIn(500);		
			$('#mailTopTitle').html(Title);
			$('html, body').animate({ scrollTop:  $('.scrollMailTarget').offset().top - 50 }, 'slow'); 
											  
			return false;
		
		});
		
		$('body').on('click','.showInbox',function(event){ /* show email message inbox */
		
			event.stopImmediatePropagation();					
			
			var clickedID = this.id.split('-');
			var memberID = clickedID[1];
			var Message = 'showInboxMsg';
		
			showPageLoader();   
			$('ul.inbox-nav li').removeClass('active');
			$(this).addClass('active'); 
			$('#composeMsg').fadeIn(500);
			$('#composeMsgBoxDiv').fadeOut(500);
			
			$('#njidekaNkirukaDiv').load('comp-mailbox-manager.php', {'messageData': Message, 
										 'memberID': memberID }).fadeIn(600);
			
			$('#mailTopTitle').html('Companion Inbox');
			$('html, body').animate({ scrollTop:  $('.scrollMailTarget').offset().top - 50 }, 'slow');
		
			hidePageLoader();
		
			return false;  
		
		});			
		
		$('body').on('click','.showSentMail',function(event){ /* show sent email */
		
			event.stopImmediatePropagation();					
			
			var clickedID = this.id.split('-');
			var memberID = clickedID[1];
			var Message = 'showSentMsg';
		
			showPageLoader();   
			$('ul.inbox-nav li').removeClass('active');
			$(this).addClass('active'); 
			$('#composeMsg').fadeIn(500);
			$('#composeMsgBoxDiv').fadeOut(500);
			
			$('#njidekaNkirukaDiv').load('comp-mailbox-manager.php', {'messageData': Message, 
										 'memberID': memberID }).fadeIn(600);
			
			$('#mailTopTitle').html(' Sent Message');
			$('html, body').animate({ scrollTop:  $('.scrollMailTarget').offset().top - 50 }, 'slow');
		
			hidePageLoader();
		
			return false;  
		
		});			
		
		$('body').on('click','.showAdminMail',function(event){ /* show school admin email */
		
			event.stopImmediatePropagation();					
			
			var clickedID = this.id.split('-');
			var memberID = clickedID[1];
			var Message = 'showAdminMail';
		
			showPageLoader();   
			$('ul.inbox-nav li').removeClass('active');
			$(this).addClass('active'); 
			$('#composeMsg').fadeIn(500);
			$('#composeMsgBoxDiv').fadeOut(500);
			
			$('#njidekaNkirukaDiv').load('comp-mailbox-manager.php', {'messageData': Message, 
										 'memberID': memberID }).fadeIn(600);
			
			$('#mailTopTitle').html(' Admin Inbox');
			$('html, body').animate({ scrollTop:  $('.scrollMailTarget').offset().top - 50 }, 'slow');
		
			hidePageLoader();
		
			return false;  
		
		});			
		
		$('body').on('click','.showDraftMail',function(event){ /* show draft email */
		
			event.stopImmediatePropagation();					
			
			var clickedID = this.id.split('-');
			var memberID = clickedID[1];
			var Message = 'showDraftMail';
		
			showPageLoader();   
			$('ul.inbox-nav li').removeClass('active');
			$(this).addClass('active'); 
			$('#composeMsg').fadeIn(500);
			$('#composeMsgBoxDiv').fadeOut(500);
			
			
			$('#njidekaNkirukaDiv').load('comp-mailbox-manager.php', {'messageData': Message, 
										 'memberID': memberID }).fadeIn(600);
			
			$('#mailTopTitle').html(' Draft Message');
			$('html, body').animate({ scrollTop:  $('.scrollMailTarget').offset().top - 50 }, 'slow');
		
			hidePageLoader();
		
			return false;  
		
		});	 
		
		$('body').on('click','.showTrashMail',function(event){ /* show trash email */
		
			event.stopImmediatePropagation();					
			
			var clickedID = this.id.split('-');
			var memberID = clickedID[1];
			var Message = 'showTrashMail';
		
			showPageLoader();   
			$('ul.inbox-nav li').removeClass('active');
			$(this).addClass('active'); 
			$('#composeMsg').fadeIn(500);
			$('#composeMsgBoxDiv').fadeOut(500);
			
			$('#njidekaNkirukaDiv').load('comp-mailbox-manager.php', {'messageData': Message, 
										 'memberID': memberID }).fadeIn(600);
			
			$('#mailTopTitle').html(' Trash Message');
			$('html, body').animate({ scrollTop:  $('.scrollMailTarget').offset().top - 50 }, 'slow');
		
			hidePageLoader();
		
			return false;  
		
		});			
		
		$('body').on('click','.readMail',function(event){ /* read an email */
		
			event.stopImmediatePropagation();					
			
			var clickedID = this.id.split('-');
			var msgID = clickedID[1];
			var memberID = clickedID[2];
			var senderID = clickedID[3];
			var Message = 'viewNkirukaMail';
		
			showPageLoader(); 
			
			$('#composeMsg').fadeIn(500);					
			$('#composeMsgBoxDiv').fadeOut(500);
			
			$('#njidekaNkirukaDiv').load('comp-mailbox-manager.php', {'messageData': Message, 'msgID': msgID, 
										 'memberID': memberID, 'senderID': senderID }).fadeIn(600);
			
			$('#mailTopTitle').html('View  Inbox');	
			$('html, body').animate({ scrollTop:  $('.scrollMailTarget').offset().top - 50 }, 'slow');
			
		
			hidePageLoader();
		
			return false;  
		
		});			
		
		
		$('body').on('click','.readNkirukaSentMail',function(event){ /* read sent email */
		
			event.stopImmediatePropagation();					
			
			var clickedID = this.id.split('-');
			var msgID = clickedID[1];
			var memberID = clickedID[2];
			var Message = 'viewNkirukaSentMail';
		
			showPageLoader(); 
			
			$('#composeMsg').fadeIn(500);					
			$('#composeMsgBoxDiv').fadeOut(500);
			
			$('#njidekaNkirukaDiv').load('comp-mailbox-manager.php', {'messageData': Message, 'msgID': msgID, 
										 'memberID': memberID}).fadeIn(600);
			
			$('#mailTopTitle').html('View  Sent Message');
			$('html, body').animate({ scrollTop:  $('.scrollMailTarget').offset().top - 50 }, 'slow');
		
			hidePageLoader();
		
			return false;  
		
		});			
		
		
		$('body').on('click','.nextMailBtn',function(event){ /* navigate to next email */
		
			event.stopImmediatePropagation();					
			
			var offsetVal = $('#nextPageDiv').text();
			var inboxType = $('#inboxType').text();
			var memberID =  $('#memberID').text();
			var totalCount =  $('#totalCount').text();
			var Message =   'paginateMail';
			$('.prevMailBtn').fadeIn(500);
		
			showPageLoader();   
			$('#selectAll').each(function() { 
						this.checked = false; 
						});
			$('#paginateMailDiv').load('comp-mailbox-manager.php', {'messageData': Message, 'inboxType': inboxType,
									   'memberID': memberID, 'offsetVal': offsetVal, 'totalCount': totalCount }).fadeIn(600);
			
			$('html, body').animate({ scrollTop:  $('.scrollMailTarget').offset().top - 50 }, 'slow');
			hidePageLoader();
		
			return false;  
		
		});			
		
		$('body').on('click','.nextMailSentBtn',function(event){ /* navigate to next email */
		
			event.stopImmediatePropagation();					
			
			var offsetVal = $('#nextPageDiv').text();
			var memberID =  $('#memberID').text();
			var totalCount =  $('#totalCount').text();
			var Message =   'paginateSentMail';
			$('.prevMailSentBtn').fadeIn(500);
		
			showPageLoader();   
			$('#paginateMailDiv').load('comp-mailbox-manager.php', {'messageData': Message, 'memberID': memberID,
										 'offsetVal': offsetVal, 'totalCount': totalCount }).fadeIn(600);
			$('html, body').animate({ scrollTop:  $('.scrollMailTarget').offset().top - 50 }, 'slow');
			hidePageLoader();
		
			return false;  
		
		});			
		
		$('body').on('click','.prevMailBtn',function(event){ /* navigate to previous email */
		
			event.stopImmediatePropagation();					
			
			var offsetVal = $('#prevPageDiv').text();
			var inboxType = $('#inboxType').text();
			var memberID =  $('#memberID').text();
			var totalCount =  $('#totalCount').text();
			var Message =   'paginateMail';
		
			showPageLoader();   
			$('#selectAll').each(function() { 
						this.checked = false; 
						});
			$('#paginateMailDiv').load('comp-mailbox-manager.php', {'messageData': Message, 'inboxType': inboxType,
									   'memberID': memberID, 'offsetVal': offsetVal, 'totalCount': totalCount }).fadeIn(600);
			
			$('html, body').animate({ scrollTop:  $('.scrollMailTarget').offset().top - 50 }, 'slow');
			hidePageLoader();
		
			return false;  
		
		});			
		
		$('body').on('click','.prevMailSentBtn',function(event){ /* navigate to previous email */
		
			event.stopImmediatePropagation();					
			
			var offsetVal = $('#prevPageDiv').text();
			var memberID =  $('#memberID').text();
			var totalCount =  $('#totalCount').text();
			var Message =   'paginateSentMail';
		
			showPageLoader();   
			
			$('#paginateMailDiv').load('comp-mailbox-manager.php', {'messageData': Message, 'memberID': memberID,
										 'offsetVal': offsetVal, 'totalCount': totalCount }).fadeIn(600);					
			$('html, body').animate({ scrollTop:  $('.scrollMailTarget').offset().top - 50 }, 'slow');
			hidePageLoader();
		
			return false;  
		
		});			

		$('body').on('click','.trashMailViewMsg',function(event){ /* view trash email */

			event.stopImmediatePropagation();					

			Swal.fire({
			  title: "Are you sure?",
			  text: "You can be able revert this in your trash folder",
			  icon: "warning",
			  showCancelButton: true,
			  confirmButtonColor: "#3085d6",
			  cancelButtonColor: "#d33",
			  confirmButtonText: "Yes, trash it!"
			}).then((result) => {
				
				if (result.isConfirmed) {
					
					var clickedID = this.id.split('-');
					var msgID = clickedID[1];
					var memberID = clickedID[2];
					var Message = 'trashMailView';

					showPageLoader(); 
					
					$('#composeMsg').fadeIn(500);					
					$('#composeMsgBoxDiv').fadeOut(500);
					
					$('#njidekaNkirukaDiv').load('comp-mailbox-manager.php', {'messageData': Message, 'msgID': msgID, 
												 'memberID': memberID}).fadeIn(600);
					
					$('#mailTopTitle').html('Companion Inbox');
					$('html, body').animate({ scrollTop:  $('.scrollMailTarget').offset().top - 50 }, 'slow');

					hidePageLoader();
				  
					Swal.fire({
					  title: "Trashed!",
					  text: "Your mail has been trash.",
					  icon: "success"
					});
				}
			}); 
			
			return false;  

		});	 

		$('body').on('click','#markUnread',function(event){	/* mark an email as unread */		 				   

			var mailData = $('.mailCheckBox').serialize();
			$.post('comp-mark-mail-unread.php', mailData, function(data) {
				$('#mailMsgBox').html(data);
			});

		}); 

		$('body').on('click','#markRead',function(event){	/* mark an email as read */						   

			var mailData = $('.mailCheckBox').serialize();
			$.post('comp-mark-mail-read.php', mailData, function(data) {
				$('#mailMsgBox').html(data);
			});

		}); 

		$('body').on('click','#moveMsgInbox',function(event){	/* move message to inbox */						   

			var mailData = $('.mailCheckBox').serialize();
			$.post('comp-move-msg.php', mailData, function(data) {
				$('#mailMsgBox').html(data);
			});

		});
	 
		$('body').on('click','#moveMsgToTrash',function(event){	 /* move message to trash */							   

			var mailData = $('.mailCheckBox').serialize();
			$.post('comp-move-msg-trash.php', mailData, function(data) {
				$('#mailMsgBox').html(data);
			});

		}); 
	 
		$('body').on('click','#selectAll',function(event){	/* select all email message */				
		   if(this.checked) { 
				$('.mailCheckBox').each(function() { 
					this.checked = true;  
				});
			}else{
				$('.mailCheckBox').each(function() { 
					this.checked = false; 
				});         
			}
		}); 

		$('body').on('click','#selectReadMsg',function(event){	/* select all read message */							   
					
			$('#selectAll').each(function() { 
				this.checked = false; 
			});								
			$('.mailCheckBox').each(function() { 
				this.checked = false; 
			});  
			$('.checkRead').each(function() { 
				this.checked = true;  
			});

		}); 

		$('body').on('click','#selectUnReadMsg',function(event){	 /* select all unread message */							   
			   
			$('#selectAll').each(function() { 
				this.checked = false; 
			});
			$('.mailCheckBox').each(function() { 
				this.checked = false; 
			});  
			$('.checkUnread').each(function() { 
				this.checked = true;  
			});

		});

		$('body').on('click','#selectAdminMsg',function(event){	/* select all admin  message */							   
			   
			$('#selectAll').each(function() { 
				this.checked = false; 
			});
			$('.mailCheckBox').each(function() { 
				this.checked = false; 
			});  
			$('.checkAdminMsg').each(function() { 
				this.checked = true;  
			});

		}); 

		
		/* Walll Companion function */
		 

		$('body').on('click','.softPaginate',function(event){ /* companion wall pagination */	
		
			event.stopImmediatePropagation();
			
			var clickedID = this.id.split('-');
			var pageID = clickedID[1];
			var loadType = clickedID[2];
			var cWallPaginate = 'paginateCompanionWall';
			
			showPageLoader();
			
			$('#wallPaginateDiv').load('comp-load-companion-posts.php', {'cWallPaginate': cWallPaginate, 
									   'pageID': pageID, 
									   'loadType': loadType });
			$(".softPaginate").removeClass('current');
			$('#softPaginate-'+pageID+'-'+loadType).addClass('current');
		
			$('html, body').animate({ scrollTop:  $('#fmsgBox').offset().top - 50 }, 'slow');
			
			hidePageLoader();
		
			return false;  
		
		});
		
		$('body').on('click','.softPaginatePCW',function(event){ /* companion wall pagination */	
		
			event.stopImmediatePropagation();
			
			var clickedID = this.id.split('-');
			var pageID = clickedID[1];
			var memberID = clickedID[2];
			var cWallPaginate = 'paginateMemberCWall';
			
			showPageLoader();
			
			$('#paginatePCWDiv').load('comp-load-companion-posts.php', {'cWallPaginate': cWallPaginate, 
										  'pageID': pageID, 
										  'memberID': memberID });
			$(".softPaginatePCW").removeClass('current');
			$('#softPaginatePCW-'+pageID+'-'+memberID).addClass('current');
			$('html, body').animate({ scrollTop:  $('#fmsgBox').offset().top - 50 }, 'slow');
			
			hidePageLoader();
		
			return false;  
		
		});

		$('body').on('click','#postStatus',function(){ /* post companion message */
				
			$('#frmPost').submit(function(event) {

				$('#postStatus').prop('disabled', 'disabled');
			
				event.stopImmediatePropagation();

				$('#postStatusSE').fadeOut(200);
				$('#postLoader').fadeIn(1000);
				
				$.post("comp-wall-script-validator.php", $(this).find('input, textarea').serialize(), function(data) {
					
					$("#newPostDiv").prepend(data);
					$("#fPostField").val('');
					$('#postStatusSE').fadeIn(200);			
					$('#postLoader').fadeOut(1000);				
	
				});

				return false;

			});
		
			setTimeout(function() {
				$('#postStatus').prop('disabled', '');
			},4000); 
			
				
		});
		
		$('body').on('click', '#postStatusSE', function(event){ /* trigger post companion button */
		
			event.stopImmediatePropagation();
		
			$('#postStatus').click();
													
			return false;
				
		});	 
		
		$('body').on('click','.companionWallPosts',function(event){ /* load/display companion message */
		
			event.stopImmediatePropagation();
		
			var postVal = 'companionWallPosts';
		
			showPageLoader();
			
			$('#chisomLoadDiv').load('comp-wall-script-manager.php', {'postsType': postVal }).fadeIn(1000);
		
			hidePageLoader();
		
			return false;  
		
		}); 			
		
		$('body').on('change','#filterCWallPosts',function(event){ /* filter post companion message */
		
			event.stopImmediatePropagation();		
		
			var filterVal = $('#filterCWallPosts').val();
			var postVal = 'filterCWallPosts';
		
			showPageLoader();
			
			$('#chisomLoadDiv').load('comp-wall-script-manager.php', {'postsType': postVal, 
									 'filterVal': filterVal}).fadeIn(1000);
		
			hidePageLoader();
		
			return false;  
		
		}); 
		
		$('body').on('change','#filterCWallSetting',function(event){ /*  companion post filter setting */
		
			event.stopImmediatePropagation();		
		
			var filterVal = $('#filterCWallSetting').val();
			var postVal = 'filterCWallSetting';
		
			showPageLoader();
			
			$('#filterSettingsMsg').load('comp-wall-script-manager.php', {'postsType': postVal, 
										 'filterVal': filterVal}).fadeIn(1000);
		
			hidePageLoader();
		
			return false;  
		
		}); 

		$('body').on('keyup','#cMailUser',function(event){ /* validate email registration */
		
			event.stopImmediatePropagation();	 
			
			$('.mail-spinner').show(); 
			var filterVal = $('#cMailUser').val();
			var postVal = 'validateEmail';
			
			$('#registMailMsg').load('comp-wall-script-manager.php', {'postsType': postVal, 
									 'filterVal': filterVal}).fadeIn(1000);
		
			
		
			return false;  
		
		});
		
		$('body').on('click','#registerCMail',function(event){ /* register student email */
		
			event.stopImmediatePropagation();		
		
			$('#cMailUser').addClass('spinner');
			var filterVal = $('#cMailUser').val();
			var postVal = 'registerMail';
			
			$('#registMailMsg').load('comp-wall-script-manager.php', {'postsType': postVal, 
									 'filterVal': filterVal}).fadeIn(1000);
			
			return false;  
		
		}); 
		
		$('body').on('click','.showcompanionWallUser',function(event){ /* show personalized student post/wall */
		
			event.stopImmediatePropagation();	
			
			var clickedID = this.id.split('-');
			var memberID = clickedID[1];
		
			var postVal = 'companionWallUser';
		
			showPageLoader();
			$('#chisomLoadDiv').slideUp(300);
			$('#chisomLoadDiv').load('comp-wall-script-manager.php', {'postsType': postVal, 
									 'memberID': memberID }).slideDown(1000);
									 
			$('html, body').animate({ scrollTop:  $('#chisomLoadDiv').offset().top - 50 }, 'slow');						 
		
			hidePageLoader();
		
			return false;  
		
		}); 
		
		$('body').on('click','.post-edit-btn',function(event){ /* load edit companion post */
		
			event.stopImmediatePropagation();					
			
			var clickedPID = this.id.split('-');
			var PostID = clickedPID[1];
			var postVal = 'frmPostEdit';
		
			showPageLoader();   
			
			$('#editPost_'+PostID).load('comp-wall-script-manager.php', {
				'postsType': postVal, 'postID': PostID  
			}).fadeIn(1000);
		
			hidePageLoader();
		
			return false;  
		
		});

		$('body').on('click','.postEditStatus',function(){ /* edit companion post */
		
			var clickedPID = this.id.split('-');
			var PostID = clickedPID[1];

			$('#frmpostEdit-'+PostID).submit(function(event) {

				event.stopImmediatePropagation();
				$('#cancelpostEdit-'+PostID).fadeOut(100);
				$('#postEdit-'+PostID).fadeOut(100);
				$('#postEditLoader-'+PostID).fadeIn(300);
				$.post('comp-wall-script-validator.php', $(this).find('input, textarea').serialize(), function(data) {
					
					$('#editPost_'+PostID).html(data);
					$('#postEditLoader-'+PostID).fadeOut(1000); 
				
				});  return false;

			});		
		});


		$('body').on('click','.cancelpostEdit',function(event){ /* cancel companion post edit */
		
			event.stopImmediatePropagation();
			
			var clickedPID = this.id.split('-');
			var PostID = clickedPID[1];
			var PostMsg = $('#editPostHolder-'+PostID).text();
			var formatMsg =  nl2br(PostMsg);
			$('#cancelpostEdit-'+PostID).fadeOut(800);
			$('#postEdit-'+PostID).fadeOut(800);
			$('#postEditLoader-'+PostID).fadeIn(950);
									
			$('#editPost_'+PostID).html(formatMsg);
			$('#postEditLoader-'+PostID).fadeOut(1000);
			
		
			return false;
		
		
		});
		
		$('body').on('click','.post-delete-btn',function(event){ /* delete companion post */
		
			event.stopImmediatePropagation();					
		
		
			Swal.fire({
			  title: "Are you sure?",
			  text: "You won't be able to revert this!",
			  icon: "warning",
			  showCancelButton: true,
			  confirmButtonColor: "#3085d6",
			  cancelButtonColor: "#d33",
			  confirmButtonText: "Yes, delete it!"
			}).then((result) => {
				
				if (result.isConfirmed) {
					
					var clickedFID = this.id.split('-');
					var DbNumberFID = clickedFID[1];
					var postVal = 'deletePost'; 
		
					showPageLoader();   
					
					$('#fmsgBox').load('comp-wall-script-manager.php', {
						'postsType': postVal, 'postID': DbNumberFID  
					}).fadeIn(1000);
		
					hidePageLoader();
		
					$('#post_'+DbNumberFID).fadeOut(300);
				  
					Swal.fire({
					  title: "Deleted!",
					  text: "Your post has been deleted.",
					  icon: "success"
					});
				}
			});  
		
			return false;  
		
		});
		
		$('body').on('click', '#exitUploadDiv', function(event){ /* exit companion picture upload */
		
			event.stopImmediatePropagation();
			var deleteID = 'deleteTempUpload';
			var valEmpty = '';
		
			$('.uploadPicIcon').show(300);				
			$('#uploadPicSE').hide(300);
			$('#postStatusSE').show(300);
			$('#wallMsgDiv').show(300);
			$('#wallPictureDiv').hide(300);	
			$('#exitUploadDiv').hide(300);	
			$('.refresh').load('comp-wall-script-manager.php', {'postsType': deleteID }).fadeIn(1000);
			$('#previewPic').html(valEmpty); 
		
			return false;
				
		});	
  
		$('body').on('click','#wallPics',function(){ /* show wall picture */

			$('#postStatusSE').hide(300);
			$('#wallMsgDiv').hide(300);
			$('#wallPictureDiv').show(300);
			$('#exitUploadDiv').show(300);
  
		});

		$('body').on('change','#wallPics',function(){ /* change wall picture */

			$("#postLoader").show();
			$(".uploadPicIcon").hide();
			$("#uploadPicSE").hide(); 

			var form_data = new FormData($('#frmWallUploader')[0]);

			$.ajax({
				url: 'comp-img-upolader.php',
				dataType: 'text',
				cache: false,
				contentType: false,
				processData: false,
				data: form_data,
				type: 'post',
				success: function (response) {
					$('#previewPic').append(response); 
					$("#postLoader").hide();
					$(".uploadPicIcon").show();
					$("#uploadPicSE").show();
					$('.refresh').load('comp-uploads-refresh.php');
					$("#wallPics").val('');
				},
				error: function (response) {
					$('#previewPic').append(response);
					$("#postLoader").hide();
					$(".uploadPicIcon").show();
					$("#uploadPicSE").show();
					$("#wallPics").val('');
				}
			});

			return false;

		}); 

		$('body').on('click', '#uploadPicSE', function(event){ /* trigger upload post picture button  */

			event.stopImmediatePropagation();

			$('#uploadPic').click();
															
			return false;
						
		});	 

		$('body').on('click','#uploadPic',function(){ /* upload post picture  */
		
			var valEmpty = '';

			$('#frmuploadPic').submit(function(event) {
		
			event.stopImmediatePropagation();

				$('#postLoader').fadeIn(200);		
				$('#uploadPicSE').fadeOut(200);		
				
				$.post('comp-wall-script-validator.php', $(this).find('input, textarea').serialize(), function(data) {
					
					$("#newPostDiv").prepend(data);								
					$('#uploadPicSE').hide(300);		
					$('.uploadPicIcon').show(300);
					$('#postStatusSE').show(300);
					$('#uploadPic').hide(300);
					$('#wallMsgDiv').show(300);
					$('#wallPictureDiv').hide(300);			
					$('#previewPic').html(valEmpty);
					$('#uploadPicTitle').val(valEmpty); 
					$('#postLoader').fadeOut(1000); 

				}); return false;

			});	
			
		}); 

		$('body').on('click','.uploadPic_DelBtn',function(event){ /* delete upload picture  */

			event.stopImmediatePropagation();			 

			Swal.fire({
				title: "Are you sure?",
				text: "You won't be able to revert this!",
				icon: "warning",
				showCancelButton: true,
				confirmButtonColor: "#3085d6",
				cancelButtonColor: "#d33",
				confirmButtonText: "Yes, delete it!"
			}).then((result) => {
				
				if (result.isConfirmed) {
					
					var clickedID = this.id.split('-');
					var pictureID = clickedID[1];
					var postVal = 'deletePic'; 

					$('.uploadPicIcon').hide();
					$('#postLoader').fadeIn(100);
					
					$('.refresh').load('comp-wall-script-manager.php', {
						'postsType': postVal, 'pictureID': pictureID 
					}).fadeIn(1000);

					$('#picture-upload-div_'+pictureID).fadeOut(100);
					
					$('#postLoader').fadeOut(1000);
					$('.uploadPicIcon').show(); 
					
					Swal.fire({
						title: "Deleted!",
						text: "Your picture has been deleted.",
						icon: "success"
					});
				}
			});  

			return false;  

		}); 

		$('body').on('click','.likePosts',function(event){ /* like post and pictures  */

			event.stopImmediatePropagation();
			var valEmpty = '';
			var clickedlikePosts = this.id.split('-');
			var likePostsID = clickedlikePosts[1];
			var postVal = 'likePost';
			var postVal2 = 'likePostDetail';				
			$('#likePosts-'+likePostsID).text(valEmpty);
			$('#likeDetails-'+likePostsID).text(valEmpty);
			
			$('#likePosts-'+likePostsID).load('comp-wall-script-manager.php', {
				'postsType': postVal, 'likePostID': likePostsID 
			}).fadeIn(300);
			
			$('#likeDetails-'+likePostsID).load('comp-wall-script-manager.php', {
				'postVal': postVal2, 'likePost': likePostsID 
			}).fadeIn(300);

			return false;   

		});
		
		$('body').on('click','.dislikePosts',function(event){ /* dislike post and pictures  */

			event.preventDefault();
			var valEmpty = '';
			var clickeddislikePosts = this.id.split('-');
			var dislikePostsID = clickeddislikePosts[1];
			var postVal = 'dislikePost';
			var postVal2 = 'likePostDetail';
			
			$('#dislikePosts-'+dislikePostsID).text(valEmpty);
			$('#likeDetails-'+dislikePostsID).text(valEmpty);
			
			$('#dislikePosts-'+dislikePostsID).load('comp-wall-script-manager.php', {
				'postsType': postVal, 'dislikePostID': dislikePostsID 
			}).fadeIn(300);
			
			$('#likeDetails-'+dislikePostsID).load('comp-wall-script-manager.php', {
				'postVal': postVal2, 'likePost': dislikePostsID 
			}).fadeIn(300);

			return false;  

		});
		
		
		$('body').on('click','.commentStatus',function(){ /* post comments */
		
			var clickedcommentID = this.id.split('-');
			var commentID = clickedcommentID[1];
			var valEmpty = '';

			$('#frmComment-'+commentID).submit(function(event) {

				event.stopImmediatePropagation();
				$('.commentStatus').fadeOut(200);
				$('#commentLoader-'+commentID).fadeIn(1000);
				$.post('comp-wall-script-validator.php', $(this).find('input, textarea').serialize(), function(data) {
					
					$('#newCommentDiv-'+commentID).append(data);
					$('.commentField-'+commentID).val('');
					$('.commentStatus').fadeIn(200);			
					$('#commentLoader-'+commentID).fadeOut(1000);
				
				});

				var postVal2 = 'commentDiv';
				
				$('#commentNumStatus-'+commentID).text(valEmpty);
				$('#commentNumStatus-'+commentID).load('comp-wall-script-manager.php', {
					'postsType': postVal2, 'postComID':commentID 
				}).fadeIn(1000);

				return false;

			});	
			
		}); 
		
		$('body').on('click','.comment-div',function(event){ /* show/display comment div  */

			event.stopImmediatePropagation();					
			
			var clickedID = this.id.split('-');
			var PostID = clickedID[1];
			
			$('#slideCommentsDiv-'+PostID).fadeIn(300);
			$('#commentDivSub-'+PostID).fadeIn(300);
			$('#commentDivSub-'+PostID).animate({ scrollTop: 0 }, 'slow');

			return false;  
	
		});

		$('body').on('click','.slideCommentsDiv',function(event){ /* hide comment div  */
	
			event.stopImmediatePropagation();					
			
			var clickedID = this.id.split('-');
			var PostID = clickedID[1];
			
			$('#slideCommentsDiv-'+PostID).fadeOut(300);
			$('#commentDivSub-'+PostID).fadeOut(300);

			return false;  

		});

		$('body').on('click','.comment-edit-btn',function(event){ /* load comment edit button  */

			event.stopImmediatePropagation();					
			
			var getID = this.id;
			var clickedCPID = this.id.split('-');
			var CPID = clickedCPID[1];
			var pid = clickedCPID[2];
			var postVal = 'frmCommentEdit';  
			
			showPageLoader();   
			
			$('#editcomment_'+CPID+'_'+pid).load('comp-wall-script-manager.php', {
				'postsType': postVal, 'commentID': getID 
			}).fadeIn(1000);

			hidePageLoader();

			return false;  

		});

		$('body').on('click','.commentEditStatus',function(){ /* edit comment  */
				
			var clickedCPID = this.id.split('-');
			var CPID = clickedCPID[1];
			var pid = clickedCPID[2];
			
			$('#frmcommentEdit-'+CPID+'-'+pid).submit(function(event) {

				event.stopImmediatePropagation();
				
				$('#cancelcommentEdit-'+CPID+'-'+pid).fadeOut(100);
				$('#commentEdit-'+CPID).fadeOut(100);
				$('#commentEditLoader-'+CPID+'-'+pid).fadeIn(300);
				
				$.post('comp-wall-script-validator.php', $(this).find('input, textarea').serialize(), function(data) {
					
					$('#editcomment_'+CPID+'_'+pid).html(data);
					$('#commentEditLoader-'+CPID+'-'+pid).fadeOut(1000);
				
				}); return false;

			});		

		});

		$('body').on('click','.cancelcommentEdit',function(event){ /* cancel edit comment  */
		
			event.stopImmediatePropagation();
			
			var clickedCPID = this.id.split('-');
			var CPID = clickedCPID[1];
			var pid = clickedCPID[2];
			
			$('#commentEditLoader-'+CPID+'-'+pid).fadeIn(100);
			
			var commentMsg = $('#editCommentHolder-'+CPID+'-'+pid).text();
			var formatMsg =  nl2br(commentMsg);
		
			$('#cancelcommentEdit-'+CPID+'-'+pid).fadeOut(100);
			$('#commentEdit-'+CPID+'_'+pid).fadeOut(100);
			
			$('#editcomment_'+CPID+'_'+pid).html(formatMsg);
			$('#commentEditLoader-'+CPID+'-'+pid).fadeOut(1000); 

			return false; 

		}); 

		$('body').on('click','.comment-delete-btn',function(event){ /* delete comment  */

			event.stopImmediatePropagation();	 
			
			Swal.fire({
				title: "Are you sure?",
				text: "You won't be able to revert this!",
				icon: "warning",
				showCancelButton: true,
				confirmButtonColor: "#3085d6",
				cancelButtonColor: "#d33",
				confirmButtonText: "Yes, delete it!"
			}).then((result) => {
				
				if (result.isConfirmed) {
					
					var valEmpty = '';
					var clickedCID = this.id.split('-'); 
					var DbNumberCID = clickedCID[1];
					var DbNumberPID = clickedCID[2];
					var postVal = 'deleteComment';
					var postVal2 = 'commentDiv';
					
					$('#fmsgBox').load('comp-wall-script-manager.php', {
						'postsType': postVal, 'commentID': DbNumberCID  
					}).fadeIn(1000);
					$('#comment_'+DbNumberCID).fadeOut(300);						
					$('#commentNumStatus-'+DbNumberPID).text(valEmpty);						
					$('#commentNumStatus-'+DbNumberPID).load('comp-wall-script-manager.php', {
						'postsType': postVal2, 'postComID':DbNumberPID 
					}).fadeIn(1000);
					
					Swal.fire({
						title: "Deleted!",
						text: "Your comment has been deleted.",
						icon: "success"
					});
				}
			}); 
			
			return false;  

		}); 
		
		$('body').on('click','.likeComments',function(event){ /* like comment  */

			event.stopImmediatePropagation();					
			
			var clickedlikeComments = this.id.split('-');
			var likeCommentsID = clickedlikeComments[1];
			var postVal = 'likeComment'; 
			
			$('#likeComments-'+likeCommentsID).load('comp-wall-script-manager.php', {
				'postsType': postVal, 'commentID': likeCommentsID 
			}).fadeIn(300);

			return false;  

		});
		
		$('body').on('click','.disLikeComments',function(event){ /* dislike comment  */

			event.stopImmediatePropagation();					
			
			var clickeddisLikeComments = this.id.split('-');
			var disLikeCommentsID = clickeddisLikeComments[1]; 
			var postVal = 'dislikeComment';
			
			$('#disLikeComments-'+disLikeCommentsID).load('comp-wall-script-manager.php',  {
				'postsType': postVal, 'commentID': disLikeCommentsID 
			}).fadeIn(300);

			return false;  

		}); 

		$('body').on('click','.sendMailPosts',function(event){ /* send mail through posts */

			event.stopImmediatePropagation();	
			
			var clickedPID = this.id.split('-');
			var PostID = clickedPID[1];
			var memberID = clickedPID[2];						
			var Message = 'postMail';

			$('#mailReportPostsDiv_'+PostID).load('comp-mailbox-manager.php', {'messageData': Message, 'sendMailPosts': PostID, 
													'Member': memberID  }).fadeIn(1000);

			return false;  

		}); 

		$('body').on('click','.sendMailComments',function(event){ /* send mail through comments */

			event.stopImmediatePropagation();	
			
			var clickedPID = this.id.split('-');
			var PostID = clickedPID[1];
			var commentID = clickedPID[2];
			var memberID = clickedPID[3];
			var Message = 'commentMail'; 
			
			$('#mailReportCommentsDiv_'+PostID+'_'+commentID+'_'+memberID).load('comp-mailbox-manager.php', {
				'messageData': Message, 'sendMailComments': PostID, 'Comment': commentID , 'Member': memberID  }).fadeIn(1000);

			return false;  

		});

		$('body').on('click','.sendReportPosts',function(event){ /* send reports through posts */

			event.stopImmediatePropagation();	
			
			var clickedPID = this.id.split('-');
			var PostID = clickedPID[1];
			var memberID = clickedPID[2];
			var Message = 'postReport';
			
			$('#mailReportPostsDiv_'+PostID).load('comp-mailbox-manager.php', {
				'messageData': Message, 'sendReportPosts': PostID, 'Member': memberID  
			}).fadeIn(1000);

			return false;  

		});

		$('body').on('click','.sendReportComments',function(event){ /* send reports through comments */

			event.stopImmediatePropagation();	
			
			var clickedPID = this.id.split('-');
			var PostID = clickedPID[1];
			var commentID = clickedPID[2];
			var memberID = clickedPID[3];
			var Message = 'commentReport';
			
			$('#mailReportCommentsDiv_'+PostID+'_'+commentID+'_'+memberID).load('comp-mailbox-manager.php', {
				'messageData': Message, 'sendReportComments': PostID, 'Comment': commentID, 'Member': memberID  
			}).fadeIn(1000);


			return false;  

		});

		$('body').on('click','.exitPostMailBoxDiv',function(event){ /* exit/cancel send mail through posts */

			event.stopImmediatePropagation();	
			
			var clickedPID = this.id.split('-');
			var PostID = clickedPID[1];
			
			$('.postMailBoxDiv_'+PostID).fadeOut(300);
			
			return false;  

		});

		$('body').on('click','.exitCommentMailBoxDiv',function(event){ /* exit/cancel send mail through comments */

			event.stopImmediatePropagation();	
			
			var clickedPID = this.id.split('-');
			var PostID = clickedPID[1];
			var commentID = clickedPID[2];
			var memberID = clickedPID[3];
			
			$('.commentMailBoxDiv_'+PostID+'_'+commentID+'_'+memberID).fadeOut(300);
			
			return false;  

		}); 

		$('body').on('click','.exitPostReportBoxDiv',function(event){ /* exit/cancel send reports through posts */

			event.stopImmediatePropagation();	
			
			var clickedPID = this.id.split('-');
			var PostID = clickedPID[1];
			
			$('.reportPostDiv_'+PostID).fadeOut(300);
			
			return false;  

		}); 

		$('body').on('click','.exitCommentReportBoxDiv',function(event){ /* exit/cancel send reports through comments */

			event.stopImmediatePropagation();	
			
			var clickedPID = this.id.split('-');
			var PostID = clickedPID[1];
			var commentID = clickedPID[2];
			var memberID = clickedPID[3];
			
			$('.reportCommentDiv_'+PostID+'_'+commentID+'_'+memberID).fadeOut(300);
			
			return false;  

		}); 

		$('body').on('click','.sendMailComp', function(){ /* send companion mail */
													  
			var clickedID = this.id.split('-');
			var mailID = clickedID[1];
			var valEmpty = '';

			$('#frmmailBoxPosts-'+mailID).submit(function(event) {

				event.stopImmediatePropagation();
				
				$('#mailBoxPosts-'+mailID).fadeOut(200);
				$('#wallpostLoader-'+mailID).fadeIn(1000);
				
				$.post('comp-mailbox-manager.php', $(this).find('input, textarea').serialize(), function(data) {
					
					$('#mailReportPostsMsg_'+mailID).html(data);				
					$('#wallpostLoader-'+mailID).fadeOut(1000);
					$('#mailBoxPosts-'+mailID).fadeIn(500);
				
				});

				return false;

			});	
		
		}); 

		$('body').on('click','.sendMailPComp',function(){ /* send companion mail through post */
													  
			var clickedID = this.id.split('-');
			var mailID = clickedID[1];

			$('#frmmailBoxPosts-'+mailID).submit(function(event) {

				event.stopImmediatePropagation();
				
				$('#mailBoxPosts-'+mailID).fadeOut(200);
				$('#wallpostLoader-'+mailID).fadeIn(1000);
				
				$.post('comp-mailbox-manager.php', $(this).find('input, textarea').serialize(), function(data) {
					
					$('#mailReportPostsMsg_'+mailID).html(data);				
					$('#wallpostLoader-'+mailID).fadeOut(2000);
					$('#mailBoxPosts-'+mailID).fadeIn(2000); 
				
				});

				return false;

			});	
		
		}); 

		$('body').on('click','.sendMailCComp',function(){ /* send companion mail through comment */
													  
			var clickedID = this.id.split('-');

			var PostID = clickedID[1];
			var commentID = clickedID[2];
			var memberID = clickedID[3];
			
			var mailData = PostID+'-'+commentID+'-'+memberID;
			var mailDataSe = PostID+'_'+commentID+'_'+memberID;

			$('#frmmailBoxComments-'+mailData).submit(function(event) {

				event.stopImmediatePropagation();
				
				$('#mailBoxPosts-'+mailData).fadeOut(200);
				$('#wallCommentLoader-'+mailData).fadeIn(1000);
				
				$.post('comp-mailbox-manager.php', $(this).find('input, textarea').serialize(), function(data) {
					
					$('#mailReportCommentsMsg_'+mailDataSe).html(data);		
					$('#wallCommentLoader-'+mailData).fadeOut(1000);
					$('#mailBoxComments-'+mailData).fadeIn(500); 
				
				});

				return false;

			});	
		
		}); 

		$('body').on('click','.sendReportPost',function(){ /* send companion mail through post */
													  
			var clickedID = this.id.split('-');
			var reportID = clickedID[1];

			$('#frmReportPost-'+reportID).submit(function(event) {

				event.stopImmediatePropagation();
				
				$('#mailBoxPosts-'+reportID).fadeOut(200);
				$('#wallpostLoader-'+reportID).fadeIn(1000);
				
				$.post('comp-mailbox-manager.php', $(this).find('input, textarea').serialize(), function(data) {
					
					$('#mailReportPostsMsg_'+reportID).html(data);				
					$('#wallpostLoader-'+reportID).fadeOut(2000);
					$('#mailBoxPosts-'+reportID).fadeIn(2000); 
				
				});

				return false;

			});	
		
		}); 

		$('body').on('click','.sendReportComment',function(){ /* send companion mail through comment */
													
			var clickedID = this.id.split('-');

			var PostID = clickedID[1];
			var commentID = clickedID[2];
			var memberID = clickedID[3];
			
			var mailData = PostID+'-'+commentID+'-'+memberID;
			var mailDataSe = PostID+'_'+commentID+'_'+memberID;

			$('#frmReportComment-'+mailData).submit(function(event) {

				event.stopImmediatePropagation();
				
				$('#mailBoxPosts-'+mailData).fadeOut(200);
				$('#wallCommentLoader-'+mailData).fadeIn(1000);
				
				$.post('comp-mailbox-manager.php', $(this).find('input, textarea').serialize(), function(data) {
					
					$('#mailReportCommentsMsg_'+mailDataSe).html(data);		
					$('#wallCommentLoader-'+mailData).fadeOut(1000);
					$('#mailBoxComments-'+mailData).fadeIn(500); 
				
				});

				return false;

			});	
		
		}); 

		$('body').on('click','.makeProfilePic',function(event){ /* make a picture profile picture  */

			event.stopImmediatePropagation();	
		
			var pictureID = this.id;					
			var picture = 'profilePic';
		
			$('#fmsgBox').load('comp-picture-manager.php', {'pictureID': pictureID, 
												'pictureData': picture  }).fadeIn(1000);

			return false;  

		}); 

		$('body').on('click','.makeWallPic',function(event){ /* make a picture wall picture  */

			event.stopImmediatePropagation();	
		
			var pictureID = this.id;					
			var picture = 'wallPic';
		
			$('#fmsgBox').load('comp-picture-manager.php', {'pictureID': pictureID, 
												'pictureData': picture  }).fadeIn(1000);

			return false;  

		}); 			