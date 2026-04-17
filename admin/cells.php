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
	This script handle admin jQuery/Javascript
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

	define('fobrain', 'igweze');  /* define a check for wrong access of file */ 
	require 'fobrain-config-s.php';  /* load fobrain configuration files */	 
	require $fobrainGlobalVars; 
	
	if (($_POST['script']) == 'amanda.29.21') { 
		
?> 
 

	<script type="text/javascript">    
		

		$('body').on('change','#fob-lang',function(event){   
	
			event.stopImmediatePropagation();

			var lang = $('#fob-lang').val(); 
			var query = "change"; 
				
			showPageLoader(); 

			$('#wizg-msg-box').load('lang-manager.php', {'query': query, 'lang': lang});   
			
			return false;   

		});

		function random_string(len) {
			var p = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
			return [...Array(len)].reduce(a=>a+p[~~(Math.random()*p.length)],'');
		}
		
		function crypt_fobrain (salt, text) {
			const textToChars = (text) => text.split("").map((c) => c.charCodeAt(0));
			const byteHex = (n) => ("0" + Number(n).toString(16)).substr(-2);
			const applySaltToChar = (code) => textToChars(salt).reduce((a, b) => a ^ b, code);
			
			return text
				.split("")
				.map(textToChars)
				.map(applySaltToChar)
				.map(byteHex)
				.join("");
		};
		
		function decrypt_fobrain (salt, encoded) {
			const textToChars = (text) => text.split("").map((c) => c.charCodeAt(0));
			const applySaltToChar = (code) => textToChars(salt).reduce((a, b) => a ^ b, code);
			return encoded
				.match(/.{1,2}/g)
				.map((hex) => parseInt(hex, 16))
				.map(applySaltToChar)
				.map((charCode) => String.fromCharCode(charCode))
				.join("");
		}; 
 
		$('body').on('click','.select-school a',function(event){  /* change school type */

			event.stopImmediatePropagation();

			showPageLoader();

			var clickedID = this.id.split('-');
			var schoolID = clickedID[1];

			var school = 'login';

			$('#wizg-msg-box').load('selector.php', {'school': schoolID, 'select':school }).fadeIn(300); 

			return false;

		});   
		
		$('body').on('click','.btn-theme',function(event){  /* change page theme */

			event.stopImmediatePropagation();
			showPageLoader();
			var clickedTheme = this.id.split('#');
			var colorID = clickedTheme[1];

			var fobrainColor = 'fobrainColor';

			$('#msg-box').load('wiz-config-manger.php', {'themeColorID': colorID,
			'query':fobrainColor }).fadeIn(300);  

			return false;

		}); 
		
		$('body').on('click','.view-new-regis',function(event){  /* view new registration */
		
			event.stopImmediatePropagation();
			var varID = this.id;
			
			showPageLoader();   
			
			$('#wigz-right-half').load('online-registration.php', {'reg': varID }).fadeIn(1000);
			$('html, body').animate({ scrollTop:  $('#scroll-to-div').offset().top - 30 }, 'slow'); 
		
			return false;  
		
		}); 
		 
		$('body').on('click','.accept-regisration',function(event){  /* admin a new student */
		
			event.stopImmediatePropagation();	
			
			var studentID = this.id;
			var profile = 'accept';
			var regnum = $('#regnum').val();
			var level = $('#levelReg').val();
			var schClass = $('#class').val();
			var term = $('#term').val(); 
			
			showPageLoader();
			
			$('#msg-box').load('regis-appl-manager.php', {'profile': profile, 'studentID': studentID, 
									'regnum': regnum, 'level': level, 'class': schClass, 'term': term  }).fadeIn(1000); 
			
			return false;  
		
		});	 

		$('body').on('click','.discard-regisration',function(event){  /* remove registration */

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
					
					var studentID = this.id;
					var profile = 'remove';
				
					showPageLoader();
				
					$('#msg-box').load('regis-appl-manager.php', {'profile': profile, 
											'studentID': studentID }).fadeIn(1000);	
					
				}
			}); 
			
			return false;	 
		
		});	  
		
		$('body').on('click','#schoolSetup',function(){  /* school settings configuration */
		
			$('#frmschoolSetup').submit(function(event) {		
					
				showPageLoader();	
			
				event.stopImmediatePropagation();
						
				$.post('wiz-config-manger.php', $(this).find('select, input').serialize(), function(data) {
					
					$('#msg-box').html(data);	
					$('html, body').animate({ scrollTop:  $('#msg-box').offset().top - 30 }, 'slow');
				
				}); return false;

			});	 

		});

		$('body').on('click','#examConfigs',function(){  /* exams settings configuration */
				
			$('#frmexamConfigs').submit(function(event) {		
				
				showPageLoader();	
					
				event.stopImmediatePropagation();
						
				$.post('wiz-config-local-manger.php', $(this).find('select, input').serialize(), function(data) {
					
					$('#msg-box').html(data);	
					//$('html, body').animate({ scrollTop:  $('#msg-box').offset().top - 30 }, 'slow');
			
				}); return false;
		
			});	 

		});

		$('body').on('click','#currentSession',function(){  /* current school settings configuration */
		
			$('#frmcurrentSession').submit(function(event) {		
					
				showPageLoader();	
			
				event.stopImmediatePropagation();
						
				$.post('session-manager.php', $(this).find('select, input').serialize(), function(data) {
					
					$('#edit-msg').html(data);	
					//$('html, body').animate({ scrollTop:  $('#msg-box').offset().top - 30 }, 'slow'); 
					
				}); return false;
			
			});	 
			
		});

		$('body').on('click','#currentSession2',function(){  /* current school settings configuration */
		
			$('#frmcurrentSession2').submit(function(event) {		
					
				showPageLoader();	
			
				event.stopImmediatePropagation();
						
				$.post('session-manager.php', $(this).find('select, input').serialize(), function(data) {
					
					$('#msg-box').html(data);	
					//$('html, body').animate({ scrollTop:  $('#msg-box').offset().top - 30 }, 'slow'); 
					
				}); return false;
			
			});	 
			
		});

		$('body').on('click','#saveSession',function(){  /* save school session */
		
			$('#frmsaveSession').submit(function(event) {		
				
				showPageLoader();	
		
				event.stopImmediatePropagation();
						
				$.post('session-manager.php', $(this).find('select, input, textarea').serialize(), function(data) {
					
					$('#msg-box').html(data);	
					//$('html, body').animate({ scrollTop:  $('#msg-box').offset().top - 50 }, 'slow');			
					
				});  return false;
		
			});	 

		});

		$('body').on('click','.set-session',function(event){  /* view school session */
		
			event.stopImmediatePropagation();	
			
			var emptyStr = "";
			var gradeID = this.id;
			var postVal = 'current';				
			
			showPageLoader();

			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();
			
			$('#modal-load-div').load('session-manager.php', {'session': postVal, 'rData': gradeID
									}).fadeIn(1000);										   
									
			$('#modal-fobrain').modal('show');		 

			return false;   
			
		});

		$('body').on('click','.edit-session',function(event){  /* edit school session */
		
			event.stopImmediatePropagation();	
			
			var emptyStr = "";
			var gradeID = this.id;
			var postVal = 'edit';				
			
			showPageLoader();
			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();
			
			$('#modal-load-div').load('session-manager.php', {'session': postVal, 'rData': gradeID
								}).fadeIn(1000);	 
			
			$('#modal-fobrain').modal('show');					
			
			return false;  

		});  
		
		$('body').on('click','.remove-session',function(event){  /* remove school session */
			
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
					var postVal = 'removeSession';
				
					showPageLoader();
				
					$('#msg-box').load('session-manager.php', {'session': postVal, 'rData': rData}).fadeIn(1000);	
					
				}
			}); 

			return false;	 
		
		});  
		
		$('body').on('click','#updateSession',function(){  /* upgrade school session */
		
			$('#frmupdateSession').submit(function(event) {		
				
				showPageLoader();	
		
				event.stopImmediatePropagation();
						
				$.post('session-manager.php', $(this).find('select, input, textarea').serialize(), function(data) {
					
					$('#edit-msg').html(data);	
					//$('html, body').animate({ scrollTop:  $('#edit-msg').offset().top - 30 }, 'slow');			
					
				}); return false; 
		
			});		

		});
					
		$('body').on('click','#levelSettings',function(){  /* school level settings configuration */
		
			$('#frmlevelSettings').submit(function(event) {		
					
				showPageLoader();	
			
				event.stopImmediatePropagation();
						
				$.post('wiz-config-local-manger.php', $(this).find('select, input').serialize(), function(data) {
					
					$('#msg-box').html(data);	
					$('html, body').animate({ scrollTop:  $('#msg-box').offset().top - 30 }, 'slow'); 
						
				
				}); return false;
			
			});	  

		});

		$('body').on('click','#classSettings',function(){  /* school class settings configuration */
		
			$('#frmclassSettings').submit(function(event) {		
					
				showPageLoader();	
			
				event.stopImmediatePropagation();
						
				$.post('wiz-config-local-manger.php', $(this).find('select, input').serialize(), function(data) {
					
					$('#msg-box').html(data);	
					$('html, body').animate({ scrollTop:  $('#msg-box').offset().top - 30 }, 'slow'); 
					
				}); return false;
			
			});		 

		});

		$('body').on('click','#classTypeSettings',function(){  /* school class type settings configuration */
		
			$('#frmclassTypeSettings').submit(function(event) {		
					
				showPageLoader();	
			
				event.stopImmediatePropagation();
						
				$.post('wiz-config-local-manger.php', $(this).find('select, input').serialize(), function(data) {
					
					$('#msg-box').html(data);	
					$('html, body').animate({ scrollTop:  $('#msg-box').offset().top - 100 }, 'slow'); 
					
				}); return false;
			
			});	 

		});
		
		$('body').on('click','#minCourseConfig',function(){  /* school minimum course settings configuration */
		
			$('#frmminCourseConfig').submit(function(event) {		
					
				showPageLoader();	
			
				event.stopImmediatePropagation();
						
				$.post('wiz-config-local-manger.php', $(this).find('select, input').serialize(), function(data) {
					
					$('#msg-box').html(data);	
					$('html, body').animate({ scrollTop:  $('#msg-box').offset().top - 30 }, 'slow'); 
						
				
				}); return false;
			
			});	 

		}); 
		 	 				 

		$('body').on('click','.remarkSave',function(event){  /* save teachers remarks */
		
			event.stopImmediatePropagation();	
			
			var clickedID = this.id.split('-');
			var remarkID = clickedID[1];
			var postVal = 'save-remark';
			var remark = $('#frmRemark-'+remarkID).val();

			$('#frmloader-'+remarkID).fadeIn(100);
			
			$('#msgBoxDiv-'+remarkID).load('wiz-config-manger.php', {'query': postVal, 
													'remark': remark, 'remarkID': remarkID  }).fadeIn(1000);
			$('#frmloader-'+remarkID).fadeOut(3000);
			
			return false;  
		
		});		

		$('body').on('click','.remarkUpdate',function(event){  /* update teachers remarks */
		
			event.stopImmediatePropagation();	
			
			var clickedID = this.id.split('-');
			var remarkID = clickedID[1];
			var postVal = 'update-remark';
			var remark = $('#frmRemark-'+remarkID).val();

			$('#frmloader-'+remarkID).fadeIn(100);
			
			$('#msgBoxDiv-'+remarkID).load('wiz-config-manger.php', {'query': postVal, 
													'remark': remark, 'remarkID': remarkID  }).fadeIn(1000);
			$('#frmloader-'+remarkID).fadeOut(3000);
			
			return false;  
		
		});		

		$('body').on('click','.remarkEdit',function(event){  /* edit teachers remarks */
		
			event.stopImmediatePropagation();	
			
			var clickedID = this.id.split('-');
			var remarkID = clickedID[1];
			var postVal = 'edit-remark';
			var remark = $('#editDiv-'+remarkID).text();

			$('#frmloader-'+remarkID).fadeIn(100); 
			
			$('#editDiv-'+remarkID).load('wiz-config-manger.php', {'query': postVal, 'remark': remark,
													'remarkID': remarkID  }).fadeIn(1000);
			$('#frmloader-'+remarkID).fadeOut(3000);
			
			return false;  
		
		});
		
		$('body').on('click','.remarkRemove',function(event){  /* remove teachers remarks */
			
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
					
					var clickedID = this.id.split('-');
					var remarkID = clickedID[1];
					var postVal = 'remove-remark';

					$('#frmloader-'+remarkID).fadeIn(100);
					
					$('#editDiv-'+remarkID).load('wiz-config-manger.php', {'query': postVal,
															'remarkID': remarkID  }).fadeIn(1000);
					$('#frmloader-'+remarkID).fadeOut(3000);

				}
			}); 
			
			return false; 
		
		});  
		
		$('body').on('click','.sportSave',function(event){  /* save sport */
		
			event.stopImmediatePropagation();	
			
			var clickedID = this.id.split('-');
			var sportID = clickedID[1];
			var postVal = 'save-sport';
			var sport = $('#frmSport-'+sportID).val();

			$('#frmloader-'+sportID).fadeIn(100);
			
			$('#msgBoxDiv-'+sportID).load('wiz-config-manger.php', {'query': postVal, 
													'sport': sport, 'sportID': sportID  }).fadeIn(1000);
			$('#frmloader-'+sportID).fadeOut(3000);
			
			return false;  
		
		});		

		$('body').on('click','.sportUpdate',function(event){  /* update sport */
		
			event.stopImmediatePropagation();	
			
			var clickedID = this.id.split('-');
			var sportID = clickedID[1];
			var postVal = 'update-sport';
			var sport = $('#frmSport-'+sportID).val();

			$('#frmloader-'+sportID).fadeIn(100);
			
			$('#msgBoxDiv-'+sportID).load('wiz-config-manger.php', {'query': postVal, 
													'sport': sport, 'sportID': sportID  }).fadeIn(1000);
			$('#frmloader-'+sportID).fadeOut(3000);
			
			return false;  
		
		});		

		$('body').on('click','.sportEdit',function(event){  /* edit sport */
		
			event.stopImmediatePropagation();	
			
			var clickedID = this.id.split('-');
			var sportID = clickedID[1];
			var postVal = 'edit-sport';
			var sport = $('#editDiv-'+sportID).text();

			$('#frmloader-'+sportID).fadeIn(100); 
			
			$('#editDiv-'+sportID).load('wiz-config-manger.php', {'query': postVal, 'sport': sport,
													'sportID': sportID  }).fadeIn(1000);
			$('#frmloader-'+sportID).fadeOut(3000);
			
			return false;  
		
		});
		
		$('body').on('click','.sportRemove',function(event){  /* remove sport */
		
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
					
					var clickedID = this.id.split('-');
					var sportID = clickedID[1];
					var postVal = 'remove-sport';

					$('#frmloader-'+sportID).fadeIn(100);
					
					$('#editDiv-'+sportID).load('wiz-config-manger.php', {'query': postVal,
															'sportID': sportID  }).fadeIn(1000);
					$('#frmloader-'+sportID).fadeOut(3000);

				}
			}); 
			
			return false;  
		
		});

		$('body').on('click','.rankingSave',function(event){  /* save teacher ranking */
		
			event.stopImmediatePropagation();	
			
			var clickedID = this.id.split('-');
			var rankingID = clickedID[1];
			var postVal = 'SaveRanking';
			var Ranking = $('#frmRanking-'+rankingID).val();

			$('#frmloader-'+rankingID).fadeIn(100);
			
			$('#msgBoxDiv-'+rankingID).load('wiz-config-manger.php', {'query': postVal, 
													'Ranking': Ranking, 'rankingID': rankingID  }).fadeIn(1000);
			$('#frmloader-'+rankingID).fadeOut(3000);
			
			return false;  
		
		});		

		$('body').on('click','.rankingUpdate',function(event){  /* update teacher ranking */
		
			event.stopImmediatePropagation();	
			
			var clickedID = this.id.split('-');
			var rankingID = clickedID[1];
			var postVal = 'UpdateRanking';
			var Ranking = $('#frmRanking-'+rankingID).val();

			$('#frmloader-'+rankingID).fadeIn(100);
			
			$('#msgBoxDiv-'+rankingID).load('wiz-config-manger.php', {'query': postVal, 
													'Ranking': Ranking, 'rankingID': rankingID  }).fadeIn(1000);
			$('#frmloader-'+rankingID).fadeOut(3000);
			
			return false;  
		
		});		

		$('body').on('click','.rankingEdit',function(event){  /* edit teacher ranking */
		
			event.stopImmediatePropagation();	
			
			var clickedID = this.id.split('-');
			var rankingID = clickedID[1];
			var postVal = 'EditRanking';
			var Ranking = $('#editDiv-'+rankingID).text();

			$('#frmloader-'+rankingID).fadeIn(100); 
			
			$('#editDiv-'+rankingID).load('wiz-config-manger.php', {'query': postVal, 'Ranking': Ranking,
													'rankingID': rankingID  }).fadeIn(1000);
			$('#frmloader-'+rankingID).fadeOut(3000);
			
			return false;  
		
		});
		
		$('body').on('click','.rankingRemove',function(event){  /* remove teacher ranking */
		
			event.stopImmediatePropagation();	
			
			var clickedID = this.id.split('-');
			var rankingID = clickedID[1];
			var postVal = 'RemoveRanking';

			$('#frmloader-'+rankingID).fadeIn(100);
			
			$('#editDiv-'+rankingID).load('wiz-config-manger.php', {'query': postVal,
													'rankingID': rankingID  }).fadeIn(1000);
			$('#frmloader-'+rankingID).fadeOut(3000);
			
			return false;  
		
		});

		$('body').on('click','#save-mail',function(){  /* save Mail */

			$('#frmsave-mail').submit(function(event) {		
				
				showPageLoader();	

				event.stopImmediatePropagation();
						
				$.post('mail-manager.php', $(this).find('select, input, textarea').serialize(), function(data) {
					
					$('#msg-box').html(data);	
					//$('html, body').animate({ scrollTop:  $('#msg-box').offset().top - 50 }, 'slow');			
					
				}); 

			});	

			return false;

		});


		$('body').on('click','#update-mail',function(){	
		
			showPageLoader();	
				
			var frmField = $('#frmupdate-mail');
			
			$.ajax('mail-manager.php', {
				type: 'POST',   
				data: frmField.serializeArray(),
				success: function (data, status, xhr) {
					$('#msg-box').html(data);
					$("#update-mail").prop("disabled", false);
					//$('.loader').fadeOut(1000);
				},
				error: function (jqXhr, textStatus, errorMessage) {
					$('#msg-box').html('Error: ' + errorMessage);
					$("#update-mail").prop("disabled", false);
					hidePageLoader();	
				}
			}); 
		
			return false;
			
		});
		

		$('body').on('click','#saveSMS-future',function(){  /* save SMS */
		
			$('#frmsaveSMS').submit(function(event) {		
				
				showPageLoader();	
		
				event.stopImmediatePropagation();
						
				$.post('sms-manager.php', $(this).find('select, input, textarea').serialize(), function(data) {
					
					$('#msg-box').html(data);	
					$('html, body').animate({ scrollTop:  $('#msg-box').offset().top - 50 }, 'slow');			
					
				}); 
		
			});	
			
			return false;

		});
		
		$('body').on('click','.view-sms',function(event){  /* view SMS */
		
			event.stopImmediatePropagation();	
			
			var emptyStr = "";
			var smsID = this.id;
			var postVal = 'viewSMS';				
			
			showPageLoader();

			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();
			
			$('#modal-load-div').load('sms-manager.php', {'smsData': postVal, 'rData': smsID}).fadeIn(1000); 
			
			$('#modal-fobrain').modal('show');					
			
			return false;  
		
		});

		$('body').on('click','.edit-sms',function(event){  /* edit SMS */
		
			event.stopImmediatePropagation();	
			
			var emptyStr = "";
			var smsID = this.id;
			var postVal = 'editSMS';				
			
			showPageLoader();

			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();
			
			$('#modal-load-div').load('sms-manager.php', {'smsData': postVal, 'rData': smsID
								}).fadeIn(1000);	 
			
			$('#modal-fobrain').modal('show');						
			
			return false;  

		}); 

		$('body').on('click','#updateSMS',function(){  /* update SMS */

			$('#frmupdateSMS').submit(function(event) {		
				
				showPageLoader();

				event.stopImmediatePropagation();
						
				$.post('sms-manager.php', $(this).find('select, input, textarea').serialize(), function(data) {
						
					$('#edit-msg').html(data);	
					$('html, body').animate({ scrollTop:  $('#edit-msg').offset().top - 30 }, 'slow');			
					
				}); return false;

			});		

		});  
			
		
		$('body').on('click','#savePayGateway-future',function(){  /* save SMS gateway */
		
			$('#frmsavePayGateway').submit(function(event) {		
				
				showPageLoader();	
		
				event.stopImmediatePropagation();
						
				$.post('p-gateway-manager.php', $(this).find('select, input, textarea').serialize(), function(data) {
					
					$('#msg-box').html(data);	
					$('html, body').animate({ scrollTop:  $('#msg-box').offset().top - 50 }, 'slow');			
					
				}); 

			});	return false;	 

		});
		
		$('body').on('click','.view-paygateway',function(event){  /* view SMS gateway */
		
			event.stopImmediatePropagation();	
			
			var emptyStr = "";
			var paymentID = this.id;
			var postVal = 'viewPayGateway';				
			
			showPageLoader();

			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();
			
			$('#modal-load-div').load('p-gateway-manager.php', {'gatewayPaymentData': postVal, 'rData': paymentID
									}).fadeIn(1000);	 
			
			$('#modal-fobrain').modal('show');					
			
			return false;  
		
		}); 

		$('body').on('click','.edit-paygateway',function(event){  /* edit SMS gateway */
		
			event.stopImmediatePropagation();	
			
			var emptyStr = "";
			var paymentID = this.id;
			var postVal = 'editPayGateway';				
			
			showPageLoader();

			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();
			
			$('#modal-load-div').load('p-gateway-manager.php', {'gatewayPaymentData': postVal, 'rData': paymentID
									}).fadeIn(1000); 
			
			$('#modal-fobrain').modal('show');					
			
			return false;  
		
		}); 

		$('body').on('click','#updatePayGateway',function(){	
		
			showPageLoader();	
				
			var frmField = $('#frmupdatePayGateway');
			
			$.ajax('p-gateway-manager.php', {
				type: 'POST',   
				data: frmField.serializeArray(),
				success: function (data, status, xhr) {
					$('#msg-box').html(data);
					$("#updatePayGateway").prop("disabled", false);
					//$('.loader').fadeOut(1000);
				},
				error: function (jqXhr, textStatus, errorMessage) {
					$('#msg-box').html('Error: ' + errorMessage);
					$("#updatePayGateway").prop("disabled", false);
					hidePageLoader();	
				}
			}); 
		
			return false;
			
		}); 

		$('body').on('click','#save-vitual-gw-future',function(){  /* save Virtual gateway */
		
			$('#frmsave-vitual-gw').submit(function(event) {		
				
				showPageLoader();	
		
				event.stopImmediatePropagation();
						
				$.post('virtual-gw-manager.php', $(this).find('select, input, textarea').serialize(), function(data) {
					
					$('#msg-box').html(data);	
					$('html, body').animate({ scrollTop:  $('#msg-box').offset().top - 50 }, 'slow');			
					
				}); 

			});	return false;	 

		});
		
		$('body').on('click','.view-virtual-gway',function(event){  /* view Virtual gateway */
		
			event.stopImmediatePropagation();	
			
			var emptyStr = "";
			var virtualID = this.id;
			var postVal = 'view';				
			
			showPageLoader();

			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();
			
			$('#modal-load-div').load('virtual-gw-manager.php', {'query': postVal, 'rData': virtualID
									}).fadeIn(1000);	 
			
			$('#modal-fobrain').modal('show');					
			
			return false;  
		
		}); 

		//function fobSumit(){

			$('body').on('click','.fobrain-wizard',function(){	

				var thisID = this.id;
				
				let qfrm = $(this).attr("data-frm");
				let qserver = $(this).attr("data-server");
				let qtarget = $(this).attr("data-target");
			
				showPageLoader();	
					
				var frmField = $("'#"+qfrm+"'");
				
				$.ajax("'"+ qserver +"'", {
					type: 'POST',   
					data: frmField.serializeArray(),
					success: function (data, status, xhr) {
						$("'#"+qtarget+"'").html(data);
						$(this).prop("disabled", false);
						//$('.loader').fadeOut(1000);
					},
					error: function (jqXhr, textStatus, errorMessage) {
						$("'#"+qtarget+"'").html('Error: ' + errorMessage);
						$(this).prop("disabled", false);
						hidePageLoader();	
					}
				}); 
			
				return false;
				
			}); 


		//}

		$('body').on('click','.edit-virtual-gway',function(event){  /* edit Virtual gateway */
		
			event.stopImmediatePropagation();	
			
			var emptyStr = "";
			var virtualID = this.id;
			var postVal = 'edit';				
			
			showPageLoader();

			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();
			
			$('#modal-load-div').load('virtual-gw-manager.php', {'query': postVal, 'rData': virtualID
									}).fadeIn(1000); 
			
			$('#modal-fobrain').modal('show');					
			
			return false;  
		
		}); 
		

		$('body').on('click','#virtualGateW',function(){	
		
			showPageLoader();	
				
			var frmField = $('#frmvirtualGateW');
			
			$.ajax('virtual-gw-manager.php', {
				type: 'POST',   
				data: frmField.serializeArray(),
				success: function (data, status, xhr) {
					$('#msg-box').html(data);
					$("#virtualGateW").prop("disabled", false);
					//$('.loader').fadeOut(1000);
				},
				error: function (jqXhr, textStatus, errorMessage) {
					$('#msg-box').html('Error: ' + errorMessage);
					$("#virtualGateW").prop("disabled", false);
					hidePageLoader();	
				}
			}); 
		
			return false;
			
		});  

		$('body').on('click','#saveBroadcast',function(){  /* save school broadcast */
		
			$('#frmsaveBroadcast').submit(function(event) {		
				
				showPageLoader();	
		
				event.stopImmediatePropagation();
						
				$.post('broadcast-manager.php', $(this).find('select, input, textarea').serialize(), function(data) {
					
					$('#edit-msg').html(data);	 			
					
				}); 

				return false;
		
			});		 
			
		}); 
		
		$('body').on('click','.remove-broadcast',function(event){  /* remove school broadcast */
		
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
					
					$('#edit-msg').load('broadcast-manager.php', {'broadcast': postVal, 'rData': rData
										}).fadeIn(1000);		

				}
			});  
		
		});  
		
		$('body').on('click','.create-broadcast',function(event){  /* edit school broadcast */
		
			event.stopImmediatePropagation();	
			
			var emptyStr = ""; 
			var postVal = 'add';				
			
			showPageLoader();
			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();
			
			$('#modal-load-div').load('broadcast-manager.php', {'broadcast': postVal }).fadeIn(1000);	 
			
			$('#modal-fobrain').modal('show');					
			
			return false;  
		
		});  


		$('body').on('click','.edit-broadcast',function(event){  /* edit school broadcast */
		
			event.stopImmediatePropagation();	
			
			var emptyStr = "";
			var broadcastID = this.id;
			var postVal = 'edit';				
			
			showPageLoader();
			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();
			
			$('#modal-load-div').load('broadcast-manager.php', {'broadcast': postVal, 'rData': broadcastID
									}).fadeIn(1000);	 
			
			$('#modal-fobrain').modal('show');					
			
			return false;  
		
		});  
		
		$('body').on('click','#updateBroadcast',function(){  /* update school broadcast */
		
			$('#frmupdateBroadcast').submit(function(event) {		
				
				showPageLoader();	
		
				event.stopImmediatePropagation();
						
				$.post('broadcast-manager.php', $(this).find('select, input, textarea').serialize(), function(data) {
					
					$('#edit-msg').html(data);	
					$('html, body').animate({ scrollTop:  $('#edit-msg').offset().top - 30 }, 'slow');			
					
				}); 

				return false;
		
			});	 

		});


		$('body').on('click','#saveEvent',function(){  /* save school event */
		
			$('#frmsaveEvent').submit(function(event) {		
				
				showPageLoader();	
		
				event.stopImmediatePropagation();
						
				$.post('event-manager.php', $(this).find('select, input, textarea').serialize(), function(data) {
					
					$('#edit-msg').html(data);	 			
					
				}); 

				return false;
		
			});		 
			
		}); 
		
		$('body').on('click','.remove-event',function(event){  /* remove school event */
		
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
					
					$('#edit-msg').load('event-manager.php', {'event': postVal, 'rData': rData
										}).fadeIn(1000);		

				}
			});  
		
		});  
		
		$('body').on('click','.create-event',function(event){  /* edit school event */
		
			event.stopImmediatePropagation();	
			
			var emptyStr = ""; 
			var postVal = 'add';				
			
			showPageLoader();
			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();
			
			$('#modal-load-div').load('event-manager.php', {'event': postVal }).fadeIn(1000);	 
			
			$('#modal-fobrain').modal('show');					
			
			return false;  
		
		});  


		$('body').on('click','.edit-event',function(event){  /* edit school event */
		
			event.stopImmediatePropagation();	
			
			var emptyStr = "";
			var eventID = this.id;
			var postVal = 'edit';				
			
			showPageLoader();
			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();
			
			$('#modal-load-div').load('event-manager.php', {'event': postVal, 'rData': eventID
									}).fadeIn(1000);	 
			
			$('#modal-fobrain').modal('show');					
			
			return false;  
		
		});  
		
		$('body').on('click','#updateEvent',function(){  /* update school event */
		
			$('#frmupdateEvent').submit(function(event) {		
				
				showPageLoader();	
		
				event.stopImmediatePropagation();
						
				$.post('event-manager.php', $(this).find('select, input, textarea').serialize(), function(data) {
					
					$('#edit-msg').html(data);	
					$('html, body').animate({ scrollTop:  $('#edit-msg').offset().top - 30 }, 'slow');			
					
				}); return false; 
		
			});		 

		});

			
		$('body').on('click','#saveGrade',function(){  /* save school grade */
		
			$('#frmsaveGrade').submit(function(event) {		
				
				showPageLoader();	
		
				event.stopImmediatePropagation();
						
				$.post('grade-manager.php', $(this).find('select, input, textarea').serialize(), function(data) {
					
					$('#msg-box').html(data);	
					//$('html, body').animate({ scrollTop:  $('#msg-box').offset().top - 50 }, 'slow');			
					
				});  return false;
		
			});	 

		});
		
		$('body').on('click','.view-grade',function(event){  /* view school grade */
		
			event.stopImmediatePropagation();	
			
			var emptyStr = "";
			var gradeID = this.id;
			var postVal = 'view';				
			
			showPageLoader();

			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();
			
			$('#modal-load-div').load('grade-manager.php', {'gradeData': postVal, 'rData': gradeID
									}).fadeIn(1000);										   
									
			$('#modal-fobrain').modal('show');		 

			return false;   

		});


		$('body').on('click','.add-grade',function(event){  /* view school grade */
		
			event.stopImmediatePropagation();	
			
			var emptyStr = "";
			var gradeID = this.id;
			var postVal = 'load';				
			
			showPageLoader();

			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();
			
			$('#modal-load-div').load('grade-manager.php', {'gradeData': postVal, 'rData': gradeID
									}).fadeIn(1000);										   
									
			$('#modal-fobrain').modal('show');		 

			return false;   
			
		});

		$('body').on('click','.edit-grade',function(event){  /* edit school grade */
		
			event.stopImmediatePropagation();	
			
			var emptyStr = "";
			var gradeID = this.id;
			var postVal = 'edit';				
			
			showPageLoader();
			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();
			
			$('#modal-load-div').load('grade-manager.php', {'gradeData': postVal, 'rData': gradeID
								}).fadeIn(1000);	 
			
			$('#modal-fobrain').modal('show');					
			
			return false;  

		});  
		
		$('body').on('click','.remove-grade',function(event){  /* remove school grade */
			
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
					var postVal = 'removeGrade';
				
					showPageLoader();
				
					$('#msg-box').load('grade-manager.php', {'gradeData': postVal, 'rData': rData}).fadeIn(1000);	
					
				}
			}); 

			return false;	 
		
		});  
		
		$('body').on('click','#updateGrade',function(){  /* upgrade school grade */
		
			$('#frmupdateGrade').submit(function(event) {		
				
				showPageLoader();	
		
				event.stopImmediatePropagation();
						
				$.post('grade-manager.php', $(this).find('select, input, textarea').serialize(), function(data) {
					
					$('#edit-msg').html(data);	
					//$('html, body').animate({ scrollTop:  $('#edit-msg').offset().top - 30 }, 'slow');			
					
				}); return false; 
		
			});		

		});

		
		$('body').on('change','#rollTask',function(){  /* mark student rollCall */	
	
			var rVal = $(this).val();
			//$(".rollCall > [value=" + rVal + "]").attr("selected", "true");
			$('.classCall option[value=' + rVal + ']').prop('selected', true);
	
			return false;
			
		});


		$('body').on('click','#load-roll-div',function(){  /* load student rollCall div */
		
			$("#frmload-roll-div").submit(function(event) {	
			
				showPageLoader();	
				
				event.stopImmediatePropagation();	
				
				$.post('roll-call-manager.php', $(this).find('select, input').serialize(), function(data) {
												
					$('#fobrain-page-div').html(data);		
					$('.fobrain-section-div').slideUp(2000);	
					$('#wiz-slider').slideDown(2000);
					$('.fobrain-page-icons').fadeIn(200);	
					$('.printer-icon').fadeIn(200);	 
					//document.body.setAttribute('data-sidebar-size', 'sm');	

				});
			
				return false;
			
			});	
			
		});
		
		$('body').on('change','#roll-date',function(event){  /* save student rollCall */
		
			event.stopImmediatePropagation();

			var sess = $('#rc-sess').val();
			var level = $('#rc-level').val(); 
			var qclass = $('#rc-class').val();
			var rdate = $('#roll-date').val(); 
			var roll = "view"; 

			showPageLoader();

			$('#roll-call-wrap').load('roll-call-manager.php', {'roll': roll, 'sess': sess, 
									'level': level, 'class': qclass, 'rdate': rdate  }).fadeIn(1000); 
			
			return false;   

		}); 

		$('body').on('click','.load-qr-rollcall',function(event){  /* edit school session */
		
			event.stopImmediatePropagation();	
			
			var emptyStr = "";
			var gradeID = this.id;
			var postVal = 'qr-code';				
			
			showPageLoader();
			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();
			
			$('#modal-load-div').load('roll-call-manager.php', {'roll': postVal, 'rData': gradeID
								}).fadeIn(1000);	 
			
			$('#modal-fobrain').modal('show');					
			
			return false;  

		}); 

		$('body').on('click','.save-roll-call',function(){  /* save student rollCall */
		
			$('#frmsave-roll-call').submit(function(event) {

				event.stopImmediatePropagation();
				
				showPageLoader();	
				
				$('#rollCallDiv').show();				
						
				$.post('roll-call-manager.php', $(this).find('select, input').serialize(), function(data) {
					
					$('#edit-msg').html(data);		
					
				});
				
				$('html, body').animate({ scrollTop:  $('#edit-msg').offset().top - 50 }, 'slow');			
		
				return false;
			
			});	

		}); 
		
		$('body').on('click','.save-class-promo',function(){  /* save class promotion */
		
			$('#frmsave-class-promo').submit(function(event) {

				event.stopImmediatePropagation();
				
				showPageLoader();	
				
				$('#promotionDiv').show();				
						
				$.post('class-promotion.php', $(this).find('select, input').serialize(), function(data) {
					
					$('#edit-msg').html(data);				
					
				});
				
				$('html, body').animate({ scrollTop:  $('#edit-msg').offset().top - 50 }, 'slow');			
		
				return false;
			
			});	

		});  
		
		$('body').on('change','#staff_message_to',function(event){  /* load state div */			
			
			event.stopImmediatePropagation();

			var msg_to = $('#staff_message_to').val(); 

			if(msg_to == 1){
				$('#staff-sms-all').fadeOut(300);
				$('#select-staff-div, #send-staff-sms').fadeIn(300);
			}else if(msg_to == 2){
				$('#staff-sms-all').fadeIn(300);
				$('#select-staff-div, #send-staff-sms').fadeOut(300);
			}else{

				$('#select-staff-div, #staff-sms-all, #send-staff-sms').fadeOut(300);
			}

		}); 

		$('body').on('click','#send-staff-sms',function(event){  /* send staff SMS */ 

			event.stopImmediatePropagation();

			var staffs = $('#staffs').val();
			var subject = $('#subject').val(); 
			var message = $('#text-message').val(); 
			var staff = "some-staff";
				
			showPageLoader();   
				
			$('#msg-box').load('sms-sender-manager.php', {'sms': staff,'staffs': staffs, 'message': message, 'subject': subject, 'show_more': 0}).fadeIn(1000);
			$('html, body').animate({ scrollTop:  $('#msg-box').offset().top - 130 }, 'slow');			
			
			return false;

		});
		
		$('body').on('click','#staff-sms-all',function(event){  /* send staff SMS */ 

			event.stopImmediatePropagation();

			var subject = $('#subject').val(); 
			var message = $('#text-message').val(); 
			var staff = "all-staff";
				
			showPageLoader();   
				
			$('#msg-box').load('sms-sender-manager.php', {'sms': staff, 'message': message, 'subject': subject, 'show_more': 0}).fadeIn(1000);
			$('html, body').animate({ scrollTop:  $('#msg-box').offset().top - 130 }, 'slow');			


			return false;

		}); 
		
		$('body').on('click','#save-hostel',function(){  /* save school hostel */
		
			$('#frmsave-hostel').submit(function(event) {		
				
				showPageLoader();	
		
				event.stopImmediatePropagation();
						
				$.post('hostel-manager.php', $(this).find('select, input').serialize(), function(data) {
					
					$('#msg-box').html(data);	
					$('html, body').animate({ scrollTop:  $('#msg-box').offset().top - 100 }, 'slow');			
					
				}); return false; 
							
			});		

		});
		
		$('body').on('click','.remove-hostel',function(event){  /* remove school hostel */ 
				
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
				
					$('#msg-box').load('hostel-manager.php', {'hostel_d': postVal, 'rData': rData}).fadeIn(1000);	
					
				}
			}); 

			return false; 
		
		});  
		
		$('body').on('click','#load-hostel',function(event){  /* edit school hostel */
		
			event.stopImmediatePropagation();	
			
			var emptyStr = "";
			var hostelID = this.id;
			var postVal = 'load';				
			
			showPageLoader();
			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();
			
			$('#modal-load-div').load('hostel-manager.php', {'hostel_d': postVal, 'rData': hostelID
									}).fadeIn(1000);											   
									
			
			$('#modal-fobrain').modal('show');					
			
			return false;   
		
		});

		$('body').on('click','.edit-hostel',function(event){  /* edit school hostel */
		
			event.stopImmediatePropagation();	
			
			var emptyStr = "";
			var hostelID = this.id;
			var postVal = 'edit';				
			
			showPageLoader();
			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();
			
			$('#modal-load-div').load('hostel-manager.php', {'hostel_d': postVal, 'rData': hostelID
									}).fadeIn(1000);											   
									
			
			$('#modal-fobrain').modal('show');					
			
			return false;   
		
		});
		
		$('body').on('click','#update-hostel',function(){  /* update school hostel */
		
			$('#frmupdate-hostel').submit(function(event) {		
				
				showPageLoader();	
		
				event.stopImmediatePropagation();
						
				$.post('hostel-manager.php', $(this).find('select, input').serialize(), function(data) {
					
					$('#edit-msg').html(data);	
					$('html, body').animate({ scrollTop:  $('#edit-msg').offset().top - 100 }, 'slow');			
					
				}); return false; 
		
			});		

		}); 

		$('body').on('click','#save-route',function(){  /* save school bus route */
		
			$('#frmsave-route').submit(function(event) {		
				
				showPageLoader();	
		
				event.stopImmediatePropagation();
						
				$.post('route-manager.php', $(this).find('select, input').serialize(), function(data) {
					
					$('#msg-box').html(data);	
					$('html, body').animate({ scrollTop:  $('#msg-box').offset().top - 100 }, 'slow');			
					
				}); return false; 
		
			});		

		});
		
		$('body').on('click','.remove-route',function(event){  /* remove school bus route */
		
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
				
					$('#msg-box').load('route-manager.php', {'route_d': postVal, 'rData': rData}).fadeIn(1000);	
					
				}
			}); 

			return false;  
		
		});  

		$('body').on('click','#load-route',function(event){  /* edit school bus route */
		
			event.stopImmediatePropagation();	
			
			var emptyStr = "";
			var routeID = this.id;
			var postVal = 'load';				
			
			showPageLoader();
			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();
			
			$('#modal-load-div').load('route-manager.php', {'route_d': postVal, 'rData': routeID
									}).fadeIn(1000); 
			
			$('#modal-fobrain').modal('show');					
			
			return false;   
		
		});

		$('body').on('click','.edit-route',function(event){  /* edit school bus route */
		
			event.stopImmediatePropagation();	
			
			var emptyStr = "";
			var routeID = this.id;
			var postVal = 'edit';				
			
			showPageLoader();
			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();
			
			$('#modal-load-div').load('route-manager.php', {'route_d': postVal, 'rData': routeID
									}).fadeIn(1000); 
			
			$('#modal-fobrain').modal('show');					
			
			return false;   
		
		});
		
		$('body').on('click','#update-route',function(){  /* update school bus route */
		
			$('#frmupdate-route').submit(function(event) {		
				
				showPageLoader();	
		
				event.stopImmediatePropagation();
						
				$.post('route-manager.php', $(this).find('select, input').serialize(), function(data) {
					
					$('#edit-msg').html(data);	
					$('html, body').animate({ scrollTop:  $('#edit-msg').offset().top - 100 }, 'slow');			
					
				});
	
				return false;
		
			});		
			
		});	 
	
		$('body').on('click','#searchWord',function(){  /* search student by words  */
		
			$('#frmSearchByKey').submit(function(event) {		
					
			showPageLoader();	
			
				event.stopImmediatePropagation();
						
				$.post('search-students.php', $(this).find('select, input').serialize(), function(data) {
						
					$('#fobrain-page-div').html(data);	
					$('.fobrain-section-div').slideUp(2000);	
					$('#wiz-slider').slideDown(2000);
					$('.fobrain-page-icons').fadeIn(200);	
					$('.printer-icon').fadeIn(200);	
					//document.body.setAttribute('data-sidebar-size', 'sm');
					
				});
			
				return false;
			
			});		
		});


		$('body').on('click','#searchMWords',function(){  /* search student by words  */
		
			$('#formBioSearch2').submit(function(event) {		
					
				showPageLoader();	
			
				event.stopImmediatePropagation();
				
				$.post('search-students.php', $(this).find('select, input').serialize(), function(data) {
					
					$('#fobrain-page-div').html(data);		
					$('#fobrain-page-div').slideDown(2000);
					$('.fobrain-section-div').slideUp(2000);
					$('.fobrain-page-icons').fadeIn(200); 
					$('.printer-icon').fadeIn(200);	 
					
				});
			
				return false;
			
			});		

		}); 

		$('body').on('click','#searchClassBio', function(){  /* search student by class  */
														
			$('#frmSearchBySess').submit(function(event) {		
					
				showPageLoader();	
			
				event.stopImmediatePropagation();
							
				$.post('search-students.php', $(this).find('select, input').serialize(), function(data) {
					
					$('#fobrain-page-div').html(data);	
					$('.fobrain-section-div').slideUp(2000);	
					$('#wiz-slider').slideDown(2000);
					$('.fobrain-page-icons').fadeIn(200);	
					$('.printer-icon').fadeIn(200);	
					
				});
			
				return false;
			
			});		

		});
		
		$('body').on('click','#newStudent', function(){  /* register new student */
														
			$('#frmnewStudent').submit(function(event) {		
					
				showPageLoader();	 
			
				event.stopImmediatePropagation();
							
				$.post('new-student-manager.php', $(this).find('select, input').serialize(), function(data) {
					
					$('#student-wrapper').html(data);	 
					$('.fobrain-section-div').slideUp(2000);
					//$('html, body').animate({ scrollTop:  $('#student-wrapper').offset().top - 100 }, 'slow'); 
					
				});
			
				return false;
			
			});		

		});			
		
		$('body').on('click','#saveStudentBio',function(){  /* edit student profile information */
			
			$('#frmStudentBio').submit(function(event) {
							
				event.stopImmediatePropagation(); 
				
				showPageLoader();
						
				$.post('bio-manager.php', $(this).find('select, input, textarea').serialize(), function(data) {
					
					$('#edit-msg').html(data);
				
				});
				
				//$('html, body').animate({ scrollTop:  $('.wizg-scroller').offset().top - 50 }, 'slow');
		
				return false;
			
			});		
			
		});
		
		$('body').on('click','#saveBioClass',function(){  /* edit student profile information */
			
			$('#frmsaveBioClass').submit(function(event) {
							
				event.stopImmediatePropagation(); 
				
				showPageLoader();
						
				$.post('bio-manager.php', $(this).find('select, input, textarea').serialize(), function(data) {
					
					$('#edit-msg').html(data);
				
				});
				
				//$('html, body').animate({ scrollTop:  $('.wizg-scroller').offset().top - 50 }, 'slow');
		
				return false;
			
			});		
			
		});

		$('body').on('click','#moveSession',function(){  /* edit student class */
		
			$('#frmmoveSession').submit(function(event) {
							
				event.stopImmediatePropagation();
				
				showPageLoader();
						
				$.post('bio-manager.php', $(this).find('select, input').serialize(), function(data) {
				
					$('#edit-msg').html(data);
				
				});
				
				//$('html, body').animate({ scrollTop:  $('.wizg-scroller').offset().top - 50 }, 'slow');

				return false;
			
			});		
		});
		
		$('body').on('click','.view-student',function(event){  /* view student profile */

			event.stopImmediatePropagation(); 

			var emptyStr = "";
			var varID = this.id; 			

			showPageLoader();

			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();

			$('#modal-load-div').load('student-profile.php', {'reg': varID }); 

			$('#modal-fobrain').modal('show');					

			return false;  	 
		
		});
		
		$('body').on('click','.edit-profile',function(event){  /* edit student profile */
		
			event.stopImmediatePropagation();

			var emptyStr = "";
			var varID = this.id; 			

			//showPageLoader();

			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();

			$('#modal-load-div').load('student-bio.php', {'reg': varID}); 

			$('#modal-fobrain').modal('show');					

			return false;   
		
		}); 

		$('body').on('click','.student-id-card',function(event){  /* view student profile */ 

			event.stopImmediatePropagation(); 

			var emptyStr = "";
			var varID = this.id; 			

			showPageLoader();

			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();

			$('#modal-load-div').load('student-id-card.php', {'reg': varID }); 

			$('#modal-fobrain').modal('show');					

			return false;  	 
		
		});
		
		$('body').on('click','.reset-student',function(event){  /* load student password */
		
			event.stopImmediatePropagation(); 

			var emptyStr = "";
			var varID = this.id; 			

			showPageLoader();

			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();

			$('#modal-load-div').load('student-reset.php', {'reg': varID }); 

			$('#modal-fobrain').modal('show');					

			return false; 
		
		});

		$('body').on('click','.reset-student-pass',function(event){  /* reset student password */
		
			event.stopImmediatePropagation();

			var varID = this.id;
			var post_val = 'student';
			
			showPageLoader();   
			
			$('#student-password').load('student-reset-manger.php', {'regNo': varID, 'reset': post_val}); 
		
			return false; 
		
		});

		$('body').on('click','.reset-parent-pass',function(event){  /* reset parent password */
		
			event.stopImmediatePropagation();
			
			var varID = this.id;
			var post_val = 'parent';
			
			showPageLoader();   
			
			$('#staff-password').load('student-reset-manger.php', {'regNo': varID, 'reset': post_val }); 
		
			return false;
		
		});
		
		
		$('body').on('click', '.remove-student',function(event){  /* remove student profile */ 
								
			event.stopImmediatePropagation();

			Swal.fire({
				title: "Are you sure?",
				text: "You won't be able to revert this!",
				icon: "warning",
				showCancelButton: true,
				confirmButtonColor: "#3085d6",
				cancelButtonColor: "#d33",
				confirmButtonText: "Yes, Deactivate Account!"
			}).then((result) => {
				
				if (result.isConfirmed) {
					
					var varID = this.id;
					var post_val = 'remove'; 
					var adminPass = $("#ad-pass").val(); 

					showPageLoader();   

					$('#edit-msg').load('student-reset-manger.php', {'regNo': varID, 'reset': post_val, 'adminPass': adminPass });
					
					
				}
			});    
			
			return false;  
				
		}); 


		$('body').on('click','#saveStudentS1',function(){  /* edit student profile */
		
			$('#frmBioData1').submit(function(event) {
							
				event.stopImmediatePropagation();
				
				$('.studentLoader').fadeIn(100);
						
					$.post('bio-manager.php', $(this).find('select, input').serialize(), function(data) {
						
						$('.msgBox1').html(data);
					
					});
					
					$('html, body').animate({ scrollTop:  $('.wizg-scroller').offset().top - 50 }, 'slow');
			
					return false;
			
			});		
			
		});

		$('body').on('click','#saveStudentS2',function(){  /* edit student profile */
		
			$('#frmBioData2').submit(function(event) {
							
				event.stopImmediatePropagation();
				
				$('.studentLoader').fadeIn(100);
						
					$.post('bio-manager.php', $(this).find('select, input').serialize(), function(data) {
					
						$('.msgBox2').html(data);												
										
					});
					
					$('html, body').animate({ scrollTop:  $('.wizg-scroller').offset().top - 50 }, 'slow');
		
					return false;
			
			});		
		}); 

		$('body').on('click','#sponsorData',function(){  /* edit parent profile */
		
			$('#frmBioData3').submit(function(event) {
							
				event.stopImmediatePropagation();
				
					$('.studentLoader').fadeIn(100);
							
					$.post('bio-manager.php', $(this).find('select, input').serialize(), function(data) {
					
						$('.msgBox3').html(data);													
										
					});
					
					$('html, body').animate({ scrollTop:  $('.wizg-scroller').offset().top - 50 }, 'slow');
		
					return false;
			
			});		
		}); 

		$('body').on('click','#saveBioClassQ',function(){  /* edit student class */
		
			$('#frmsaveBioClassQ').submit(function(event) {
							
				event.stopImmediatePropagation();
				
				$('.studentLoader').fadeIn(100);
						
					$.post('bio-manager.php', $(this).find('select, input').serialize(), function(data) {
					
						$('.msgBoxClass').html(data);
					
					});
					
					$('html, body').animate({ scrollTop:  $('.wizg-scroller').offset().top - 50 }, 'slow');
		
					return false;
			
			});		
		});
		
		

		$('body').on('click','#saveNewStaff',function(){  /* register new staff profile */
		
			$('#frmsaveNewStaff').submit(function(event) {

				event.stopImmediatePropagation();
				
				showPageLoader();	
						
				$.post('staff-manager.php', $(this).find('select, input').serialize(), function(data) {
					
					$('#edit-msg').html(data);	 
				
				});
		
				return false;
			
			});
			
		}); 

		$('body').on('click','#assignformTeacher',function(){  /* assign class to a staff */
		
			$('#frmassignformTeacher').submit(function(event) {

				event.stopImmediatePropagation();
				
				showPageLoader();	
						
				$.post('staff-assign-manager.php', $(this).find('select, input').serialize(), function(data) {
					
					$('#msg-box').html(data);		
					
				});
		
				return false;
			
			});		
		});  

		$('body').on('click','#assignsubTeacher',function(){  /* assign subject to a staff */
		
			$('#frmassignsubTeacher').submit(function(event) {

				event.stopImmediatePropagation();
				
				showPageLoader();	
						
				$.post('staff-assign-manager.php', $(this).find('select, input').serialize(), function(data) {
					
					$('#msg-box').html(data);			
					
				});
		
				return false;
			
			});		
		});  

		
		$('body').on('click','.view-staff',function(event){  /* vie staff profile */
		
			event.stopImmediatePropagation(); 

			var emptyStr = "";
			var varID = this.id;
			var postVal = 'view';				
			
			showPageLoader();

			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();
			
			$('#modal-load-div').load('staff-profile.php', {'staff': postVal, 'teacherID': varID, 'show_more': 1}).fadeIn(1000); 
			
			$('#modal-fobrain').modal('show');					
			
			return false;  	 
		
		});
		
		$('body').on('click','.staff-idcard',function(event){  /* vie staff id*/
		
			event.stopImmediatePropagation(); 

			var emptyStr = "";
			var varID = this.id;
			var postVal = 'id-card';				
			
			showPageLoader();

			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();
			
			$('#modal-load-div').load('staff-id-card.php', {'staff': postVal, 'teacherID': varID, 'show_more': 1}).fadeIn(1000); 
			
			$('#modal-fobrain').modal('show');					
			
			return false;  	 
		
		}); 
		

		$('body').on('click','.reset-staff-div',function(event){  /* load reset staff profile */
		
			event.stopImmediatePropagation();  

			var emptyStr = "";
			var varID = this.id; 			
			
			showPageLoader();

			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();
			
			$('#modal-load-div').load('staff-reset.php', { 'staff': varID, 'show_more': 0}).fadeIn(1000); 
			
			$('#modal-fobrain').modal('show');	
			
			return false; 
		
		});

		$('body').on('click','.reset-staff',function(event){  /* reset staff password */
		
			event.stopImmediatePropagation();
			
			var varID = this.id;
			
			showPageLoader();   

			var postVal = 'reset';
			
			$('#staff_new_pass').load('reset-staff-manager.php', {'staff': postVal, 'reStaff': varID}); 
		
			return false; 
		
		});

		$('body').on('click','#add-staff',function(event){  /* reset staff password */
		
			event.stopImmediatePropagation();  
			
			var emptyStr = "";
			var postVal = 'new_staff'; 			
			
			showPageLoader();

			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();
			
			$('#modal-load-div').load('reset-staff-manager.php', { 'staff': postVal, 'show_more': 0}).fadeIn(1000); 
			
			$('#modal-fobrain').modal('show');	 
				
		
			return false; 
		
		});
		
		
		$('body').on('click', '.remove-staff', function(event){  /* remove staff profile */								
								
			event.stopImmediatePropagation();
			
			Swal.fire({
				title: "Are you sure?",
				text: "You won't be able to revert this!",
				icon: "warning",
				showCancelButton: true,
				confirmButtonColor: "#3085d6",
				cancelButtonColor: "#d33",
				confirmButtonText: "Yes, Deactivate Account!"
			}).then((result) => {
				
				if (result.isConfirmed) {
					
					var staffID = this.id;
					var postVal = 'delete';
					var adminPass = $("#ad-pass").val(); 
					showPageLoader();
					$('#edit-msg').load('reset-staff-manager.php', {'staff': postVal, 'removeReg': staffID, 'adminPass': adminPass });
					
				}
			});    
			
			return false; 
		
		});
		
		$('body').on('click', '.change-staff-user',function(event){  /* edit staff ID */
								
			event.stopImmediatePropagation();
			
			var varID = this.id;
			var staffUser = $("#staff-user").val();
			var postVal = "update";
			
			showPageLoader();
			
			$('#msg-staff').load('reset-staff-manager.php', {'staff': postVal, 'staffID': varID, 'staffUser': staffUser});
			
			return false;
	
		
		});  

		$('body').on('click','#create-new-pins',function(event){  /* add card pin */
		
			event.stopImmediatePropagation();	
			
			$('#create-new-pins').fadeOut(1000);
			$('#frmsaveCardPin, #return-pin-back').fadeIn(1000);  
			
			return false;  
		
		});


		$('body').on('click','#saveLeave',function(){  /* save school event */
		
			$('#frmsaveLeave').submit(function(event) {		
				
				showPageLoader();	
		
				event.stopImmediatePropagation();
						
				$.post('leave-manager.php', $(this).find('select, input, textarea').serialize(), function(data) {
					
					$('#edit-msg').html(data);	 			
					
				}); 

				return false;
		
			});		 
			
		});
		
		$('body').on('click','.view-leave ',function(event){  /* view school event */
		
			event.stopImmediatePropagation();	
			
			var emptyStr = "";
			var leaveID = this.id;
			var postVal = 'view';				
			
			showPageLoader();
			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();
			
			$('#modal-load-div').load('leave-manager.php', {'leave': postVal, 'rData': leaveID
									}).fadeIn(1000);										   
									
			$('#modal-fobrain').modal('show');						
			
			return false;  
		
		});
		
		$('body').on('click','.remove-leave',function(event){  /* remove school event */
		
			Swal.fire({
				title: "Are you sure?",
				text: "You won't be able to revert this!",
				icon: "warning",
				showCancelButton: true,
				confirmButtonColor: "#3085d6",
				cancelButtonColor: "#d33",
				confirmButtonText: "Yes, Disenable it!"
			}).then((result) => {
				
				if (result.isConfirmed) { 
					
					var rData = this.id;
					var postVal = 'remove';
					
					showPageLoader();
					
					$('#edit-msg').load('leave-manager.php', {'leave': postVal, 'rData': rData
										}).fadeIn(1000);		

				}
			});  
		
		});  
		
		$('body').on('click','.create-leave',function(event){  /* edit school event */
		
			event.stopImmediatePropagation();	
			
			var emptyStr = ""; 
			var postVal = 'add';				
			
			showPageLoader();

			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();
			
			$('#modal-load-div').load('leave-manager.php', {'leave': postVal }).fadeIn(1000); 
			 
			$('#modal-fobrain').modal('show');					
			
			return false;  
		
		});  


		$('body').on('click','.edit-leave',function(event){  /* edit school event */
		
			event.stopImmediatePropagation();	
			
			var emptyStr = "";
			var leaveID = this.id;
			var postVal = 'edit';				
			
			showPageLoader();
			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();
			
			$('#modal-load-div').load('leave-manager.php', {'leave': postVal, 'rData': leaveID
									}).fadeIn(1000);	
				
			$('#modal-fobrain').modal('show');				
			
			return false;  
		
		});  
		
		$('body').on('click','#updateLeave',function(){  /* update school event */
		
			$('#frmupdateLeave').submit(function(event) {		
				
				showPageLoader();	
		
				event.stopImmediatePropagation();
						
				$.post('leave-manager.php', $(this).find('select, input, textarea').serialize(), function(data) {
					
					$('#edit-msg').html(data);	
					$('html, body').animate({ scrollTop:  $('#edit-msg').offset().top - 30 }, 'slow');			
					
					$('#modal-fobrain').modal('hide');

				}); return false; 
		
			});		 

		});

		$('body').on('click','.leave-app',function(event){  /* edit school event */
		
			event.stopImmediatePropagation();	
			
			var emptyStr = "";
			var leaveID = this.id;
			var postVal = 'load-leave';				
			
			showPageLoader();
			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();
			
			$('#modal-load-div').load('leave-manager.php', {'leave': postVal, 'rData': leaveID
									}).fadeIn(1000);	 
			
			$('#modal-fobrain').modal('show');					
			
			return false;  
		
		});  

		$('body').on('click','#saveLeaveApp',function(){  /* update school event */
		
			$('#frmsaveLeaveApp').submit(function(event) {		
				
				showPageLoader();	
		
				event.stopImmediatePropagation();
						
				$.post('leave-manager.php', $(this).find('select, input, textarea').serialize(), function(data) {
					
					$('#edit-msg').html(data);	
					$('html, body').animate({ scrollTop:  $('#edit-msg').offset().top - 30 }, 'slow');			
					
					$('#modal-fobrain').modal('hide');

				}); return false; 
		
			});		 

		});		   
			
		$('body').on('click','#return-pin-back',function(event){  /* view scratch card pin */
		
			event.stopImmediatePropagation();	 

			$('#frmsaveCardPin, #return-pin-back').fadeOut(1000);
			$('#create-new-pins').fadeIn(1000);  
			
			return false;  
		
		});

		$('body').on('click','#saveCardPin',function(){  /* save scratch card pin */
		
			$('#frmsaveCardPin').submit(function(event) {		
				
				showPageLoader();
		
				event.stopImmediatePropagation();
						
				$.post('scratch-card-manager.php', $(this).find('select, input, textarea').serialize(), function(data) {
					
					$('#msg-box').html(data);	
					$('html, body').animate({ scrollTop:  $('#wizg-wrapper').offset().top - 130 }, 'slow');			
					
				});
	
				return false;
		
			});		
		});
		
		$('body').on('click','.view-scratch-card',function(event){  /* view scratch card pin */
		
			event.stopImmediatePropagation();	
			
			var emptyStr = "";
			var cardPinID = this.id;
			var postVal = 'view';				
			
			showPageLoader();

			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();
			
			$('#modal-load-div').load('scratch-card-manager.php', {'card': postVal, 'rData': cardPinID
									}).fadeIn(1000);										   
									
			$('#modal-fobrain').modal('show');					
			
			return false;  
		
		});
		
		$('body').on('click','.delete-scratch-card',function(event){  /* remove scratch card pin */ 

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
					
					$('#edit-msg').load('scratch-card-manager.php', {'card': postVal, 'rData': rData
										}).fadeIn(1000);		

				}
			}); 

			return false;  						
		
		});  
			
		
		$('body').on('click','#load-exportRS',function(){  /* load result export page */
		
			$('#frmload-exportRS').submit(function(event) {		
					
				event.stopImmediatePropagation();
				
				showPageLoader();
						
				$.post('common-rs-manager.php', $(this).find('select, input').serialize(), function(data) {
					
					$('#fobrain-page-div').html(data);		
					$('.fobrain-section-div').slideUp(2000);	
					$('#wiz-slider').slideDown(2000);  
					$('.fobrain-page-icons').fadeIn(200);	 
					$('.printer-icon').fadeIn(200); 
					document.body.setAttribute('data-sidebar-size', 'sm');
					
				});
			
				return false;
			
			});		
		});
		
		$('body').on('click','#exAutoScanRS',function(){  /* load auto scan page */
		
			$('#frmexAutoScanRS').submit(function(event) {		
					
				event.stopImmediatePropagation();
				
				showPageLoader();
						
				$.post('common-rs-manager.php', $(this).find('select, input').serialize(), function(data) {
					
					$('#fobrain-page-div').html(data);	
					$('#fobrain-page-div').slideDown(2000);
					$('.fobrain-section-div').slideUp(2000);	
					$('.fobrain-page-icons').fadeIn(200);		
					$('.printer-icon').fadeIn(200);  
					
				});
			
				return false;
			
			});		
		});

		$('body').on('click','#search-session-rs',function(){  /* search student result by session */
		
			$('#frmsearch-session-rs').submit(function(event) {		
					
				event.stopImmediatePropagation();
				
				showPageLoader();
						
				$.post('common-rs-manager.php', $(this).find('select, input').serialize(), function(data) {  

					$('#fobrain-page-div').html(data);		
					$('.fobrain-section-div').slideUp(2000);	
					$('#wiz-slider').slideDown(2000);
					$('.fobrain-page-icons').fadeIn(200);	
					$('.hideTBColsBtn').fadeIn(200); 
					$('.printer-icon').fadeIn(200);	
					document.body.setAttribute('data-sidebar-size', 'sm');	
						
				});
			
				return false;
			
			});		
		}); 

		$('body').on('click','#classTranscript',function(){  /* auto generate class transcript */
		
			$('#frmRS2').submit(function(event) {		
					
				showPageLoader();	
			
				event.stopImmediatePropagation();
						
				$.post('common-rs-manager.php', $(this).find('select, input').serialize(), function(data) {
					
					$('#fobrain-page-div').html(data);		
					$('.fobrain-section-div').slideUp(2000);	
					$('#wiz-slider').slideDown(2000);
					$('.fobrain-page-icons').fadeIn(200);	
					$('.hideTBColsBtn').fadeIn(200); 
					$('.printer-icon').fadeIn(200);	
					document.body.setAttribute('data-sidebar-size', 'sm');	
					
				});
			
				return false;
			
			});		
		});

		

		$('body').on('click','#student-transcript',function(){  /* auto generate student transcript */
		
			$('#frm-student-transcript').submit(function(event) {		
					
				showPageLoader();	
			
				event.stopImmediatePropagation();
						
				$.post('common-rs-manager.php', $(this).find('select, input').serialize(), function(data) {
					
					$('#fobrain-page-div').html(data);		
					$('.fobrain-section-div').slideUp(2000);	
					$('#wiz-slider').slideDown(2000);
					$('.fobrain-page-icons').fadeIn(200);	
					$('.hideTBColsBtn').fadeIn(200); 
					$('.printer-icon').fadeIn(200);	
					document.body.setAttribute('data-sidebar-size', 'sm');	
					
				});
			
				return false;
			
			});		
		}); 

		$('body').on('click','#saveTeacherRS',function(){  /* save staff result profile */
		
			$('#frmsaveTeacherRS').submit(function(event) {		
					
				event.stopImmediatePropagation();
				
				$('#rsConfigLoader').show(100);
						
				$.post('rs-config-manager.php', $(this).find('select, input').serialize(), function(data) {
					
					$('#msgBoxTeach').html(data);	
					
				});
				
				$('html, body').animate({ scrollTop:  $('#scrollTarget2').offset().top - 100 }, 'fast');
		
				return false;
			
			});		
		}); 

		$('body').on('click','#automateRS',function(){  /* automate student results */
		
			$('#frmautomateRS').submit(function(event) {		
					
				event.stopImmediatePropagation(); 
				
				$('#config-loader').fadeIn(100);
				$('.rs-config-wrap, .exit-rs-config').fadeOut(100); 
						
				$.post('rs-config-manager.php', $(this).find('select, input').serialize(), function(data) {
					
					$('#rs-msg-box').html(data);	
					
				}); 
		
				return false;
			
			});		
		}); 

		$('body').on('click','#publishRS',function(){  /* publish student results */
		
			$('#frmpublishRS').submit(function(event) {		
					
				event.stopImmediatePropagation();
				
				$('#config-loader').fadeIn(100);
				$('.rs-config-wrap, .exit-rs-config').fadeOut(100);
						
				$.post('rs-config-manager.php', $(this).find('select, input').serialize(), function(data) {
				
					$('#rs-msg-box').html(data);	
					
				}); 
		
				return false;
			
			});		
		});

		$('body').on('click','.show-hide-btn',function(event){  /* show or hide button */
		
			event.stopImmediatePropagation();		
			
			$('#showHideCols').click(); 
			$('.show-hide-btn').toggle();
			
			return false;
			
		});
	
		
		$('body').on('click','.edit-term-result',function(event){  /* edit student results */
			
			event.stopImmediatePropagation();	
			
			var emptyStr = "";
			var varID = this.id;
			var postVal = 'view';				
			
			showPageLoader();

			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();
			
			$('#modal-load-div').load('result-edit-frm.php', {'rsData': varID}).fadeIn(1000);										   
									
			$('#modal-fobrain').modal('show');					
			
			return false;   

		});
		
		
		$('body').on('click','.edit-comment-rs',function(event){  /* view student comment results */ 
			
			event.stopImmediatePropagation();	
			
			var emptyStr = "";
			var varID = this.id;
			var postVal = 'edit';				
			
			showPageLoader();

			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();
			
			$('#modal-load-div').load('result-comment-frm.php', {'rsData': varID }).fadeIn(1000);										   
									
			$('#modal-fobrain').modal('show');					
			
			return false;   
		
		});


		$('body').on('click','.view-term-result',function(event){  /* view student termly results */

			event.stopImmediatePropagation();	
			
			var emptyStr = "";
			var varID = this.id;
			var postVal = 'view';				
			
			showPageLoader();

			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();
			
			$('#modal-load-div').load('common-rs-manager.php', {'studentReg': varID }).fadeIn(1000);										   
									
			$('#modal-fobrain').modal('show');					
			
			return false;   
		
		}); 

		
		$('body').on('click','.edit-conduct-ov',function(event){  /* load student conducts page */
			
			event.stopImmediatePropagation();	
			
			var emptyStr = "";
			var varID = this.id;
			var postVal = 'conduct';				
			
			showPageLoader();

			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();
			
			$('#modal-load-div').load('result-conducts.php', {'student_conduct': varID }).fadeIn(1000);										   
									
			$('#modal-fobrain').modal('show');					
			
			return false;    
		
		});


		$('body').on('click','.edit-student-conduct',function(event){  /* load student conducts page */
			
			event.stopImmediatePropagation();		

			var valEmpty = '';
			var varID = this.id;
			
			$('#wigz-right-half').html(valEmpty);
			showPageLoader();   
			$('#wigz-right-half').load('result-conducts.php', {'student_conduct': varID}).fadeIn(1000);
			$('html, body').animate({ scrollTop:  $('#wigz-right-half').offset().top - 130 }, 'slow'); 
		
			return false;
		
		});

		
		$('body').on('click','#saveConducts',function(){  /* save student conducts */
		
			$('.frmConducts').submit(function(event) {
							
				event.stopImmediatePropagation();
				
				showPageLoader();
						
				$.post('student-conduct-manager.php', $(this).find('select, input').serialize(), function(data) {
					
					$('#msg-box').html(data);
					$('html, body').animate({ scrollTop:  $('#scrollToTarget').offset().top - 30 }, 'fast'); 
					
				});
			
				return false;
			
			});		
		}); 

		
		$('body').on('click','.exit-overlay-box',function(event){  /* exit overlay div */
		
			event.stopImmediatePropagation();		
			
			$('#overlay-rs-box').fadeOut(300);
			//hide("blind", { direction: "horizontal" }, 1000);
		
		});

		$('body').on('click','.exit-overlay-box-2',function(event){  /* exit overlay div */
		
			event.stopImmediatePropagation();		
			
			$('#overlay-box-2').fadeOut(300);
			//hide("blind", { direction: "horizontal" }, 1000);
		
		});
		
		$('body').on('click','.exit-overlay-box-3',function(event){  /* exit overlay div */
		
			event.stopImmediatePropagation();		
			
			$('#overlay-box-3').fadeOut(300);
			//hide("blind", { direction: "horizontal" }, 1000);
		
		}); 

		$('body').on('click','#saveRS',function(){  /* save student result */
		
			$("#frmSaveRs").submit(function(event) {		
					
				//showPageLoader();	
			
				event.stopImmediatePropagation();
				
				$.post('validate-rs.php', $(this).find('select, input').serialize(), function(data) {
					
					$('#msgBox').html(data);
					
				});
		
				return false;
			
			});		
			
		});
		
		$('body').on('click','#saveSubComment',function(){  /* save student comment */
		
			$("#frmsaveSubComment").submit(function(event) {		
					
				//showPageLoader();	
			
				event.stopImmediatePropagation();
				
				$.post('validate-rs.php', $(this).find('select, input, textarea').serialize(), function(data) {
					
					$('#msgBox').html(data);
					
				});
		
				return false;
			
			});		
		});

		$('body').on('click','.edit-result',function(event){  /* edit student result */
		
			event.stopImmediatePropagation();
			
			var valEmpty = '';
			var varID = this.id;
			$('#wigz-right-half').html(valEmpty);
			
			//showPageLoader();   
			
			$('#wigz-right-half').load('result-edit-frm.php', {'rsData': varID }).fadeIn(1000);
			$('html, body').animate({ scrollTop:  $('#wigz-right-half').offset().top - 130 }, 'slow');		
		
			return false;  
			
		});

		$('body').on('click','.edit-result-staff',function(event){  /* edit student result */
		
			event.stopImmediatePropagation();
			
			var valEmpty = '';
			var varID = this.id;
			$('#wigz-right-half').html(valEmpty);
			
			//showPageLoader();   
			
			$('#wigz-right-half').load('result-edit-staff-frm.php', {'rsData': varID }).fadeIn(1000);
			$('html, body').animate({ scrollTop:  $('#wigz-right-half').offset().top - 130 }, 'slow');		
		
			return false;  
			
		});

		$('body').on('click','.edit-course-comment',function(event){  /* view comment result */
		
			event.stopImmediatePropagation();
			
			var valEmpty = '';
			var varID = this.id;
			$('#wigz-right-half').html(valEmpty);
			
			showPageLoader();   
			
			$('#wigz-right-half').load('result-comment-frm.php', {'rsData': varID }).fadeIn(1000);
			$('html, body').animate({ scrollTop:  $('#wigz-right-half').offset().top - 130 }, 'slow');
			
			return false;  
		
		});

		$('body').on('click','.edit-course-com-staff',function(event){  /* view comment result */
		
			event.stopImmediatePropagation();
			
			var valEmpty = '';
			var varID = this.id;
			$('#wigz-right-half').html(valEmpty);
			
			showPageLoader();   
			
			$('#wigz-right-half').load('result-comment-staff-frm.php', {'rsData': varID }).fadeIn(1000);
			$('html, body').animate({ scrollTop:  $('#wigz-right-half').offset().top - 130 }, 'slow');
			
			return false;  
		
		});  
		
		$('body').on('click','#load-result',function(){  /* save student result */
		
			$('#frmload-result').submit(function(event) {	
			
				showPageLoader();	
			
				event.stopImmediatePropagation();	
				
				$.post('load-results.php', $(this).find('select, input').serialize(), function(data) { 

					$('#fobrain-page-div').html(data);		
					$('.fobrain-section-div').slideUp(2000);	
					$('#wiz-slider').slideDown(2000);
					$('.fobrain-page-icons').fadeIn(200);	
					$('.printer-icon').fadeIn(200);	
					document.body.setAttribute('data-sidebar-size', 'sm');	
					
				});
			
				return false;
			
			});		
		});

		$('body').on('click','#saveLiveClass',function(){  /* save online liveclass */
		
			$('#frmsaveLiveClass').submit(function(event) {

				event.stopImmediatePropagation();
				
				showPageLoader();	
						
				$.post('live-class-manger.php', $(this).find('select, input, textarea').serialize(), function(data) {
										
					$('#edit-msg').html(data);	  
				
				});
	
				return false;
			
			});
			
		});

		
		$('body').on('click','.start-liveclass',function(event){  /* view online liveclass */
		
			event.stopImmediatePropagation(); 

			var emptyStr = "";
			var liveclassID = this.id;
			var postVal = 'start';				

			showPageLoader(); 

			$('#edit-msg').load( 'live-class-manger.php', {'liveclass': postVal, 'eData': liveclassID });  

			$('#fob-wrapper').css('display', 'none');
			$('#virtual-loading').show();
			hidePageLoader();

			return false;   
		
		});  

		$('body').on('click','.view-liveclass',function(event){  /* view online liveclass */
		
			event.stopImmediatePropagation(); 

			var emptyStr = "";
			var liveclassID = this.id;
			var postVal = 'view';				

			showPageLoader();

			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();

			$('#modal-load-div').load( 'live-class-manger.php', {'liveclass': postVal, 'eData': liveclassID }); 

			$('#modal-fobrain').modal('show');					

			return false;   
		
		});


		$('body').on('click','.add-liveclass',function(event){  /* edit online liveclass */ 
			
			event.stopImmediatePropagation(); 

			var emptyStr = "";
			var liveclassID = this.id;
			var postVal = 'add';				

			showPageLoader();

			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();

			$('#modal-load-div').load( 'live-class-manger.php', {'liveclass': postVal, 'eData': liveclassID }); 

			$('#modal-fobrain').modal('show');					

			return false;  

		});

		$('body').on('click','.edit-liveclass',function(event){  /* edit online liveclass */ 
			
			event.stopImmediatePropagation(); 

			var emptyStr = "";
			var liveclassID = this.id;
			var postVal = 'edit';				

			showPageLoader();

			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();

			$('#modal-load-div').load( 'live-class-manger.php', {'liveclass': postVal, 'eData': liveclassID }); 

			$('#modal-fobrain').modal('show');					

			return false;  

		});
		
		$('body').on('click','.remove-liveclass',function(event){  /* remove online liveclass */ 

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
					
					var eData = this.id;
					var postVal = 'remove'; 
					
					showPageLoader();
					
					$('#msg-box').load('live-class-manger.php', {'liveclass': postVal, 'eData': eData
										}).fadeIn(1000);		

				}
			}); 

			return false;  	 
		
		});  
		
		
		$('body').on('click','#updateLiveClass',function(){  /* update online liveclass */
		
			$('#frmupdateLiveClass').submit(function(event) {		
				
				showPageLoader();	
		
				event.stopImmediatePropagation();
						
				$.post('live-class-manger.php', $(this).find('select, input, textarea').serialize(), function(data) {
					
					$('#edit-msg').html(data);	
					//$('html, body').animate({ scrollTop:  $('#editMsg').offset().top - 30 }, 'slow');			
					
				});

				return false;
		
			});		
		}); 

		$('body').on('click','#saveParentMeeting',function(){  /* save online parmeeting */
		
			$('#frmsaveParentMeeting').submit(function(event) {

				event.stopImmediatePropagation();
				
				showPageLoader();	
						
				$.post('parent-meeting-manager.php', $(this).find('select, input, textarea').serialize(), function(data) {
										
					$('#edit-msg').html(data);	  
				
				});
	
				return false;
			
			});
			
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

			$('#modal-fobrain').modal('show');					

			return false;   
		
		});
			


		$('body').on('click','.add-parmeeting',function(event){  /* edit online parmeeting */ 
			
			event.stopImmediatePropagation(); 

			var emptyStr = "";
			var parmeetingID = this.id;
			var postVal = 'add';				

			showPageLoader();

			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();

			$('#modal-load-div').load( 'parent-meeting-manager.php', {'parmeeting': postVal, 'eData': parmeetingID }); 

			$('#modal-fobrain').modal('show');					

			return false;  

		});

		$('body').on('click','.edit-parmeeting',function(event){  /* edit online parmeeting */ 
			
			event.stopImmediatePropagation(); 

			var emptyStr = "";
			var parmeetingID = this.id;
			var postVal = 'edit';				

			showPageLoader();

			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();

			$('#modal-load-div').load( 'parent-meeting-manager.php', {'parmeeting': postVal, 'eData': parmeetingID }); 

			$('#modal-fobrain').modal('show');					

			return false;  

		});
		
		$('body').on('click','.remove-parmeeting',function(event){  /* remove online parmeeting */ 

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
					
					var eData = this.id;
					var postVal = 'remove'; 
					
					showPageLoader();
					
					$('#msg-box').load('parent-meeting-manager.php', {'parmeeting': postVal, 'eData': eData
										}).fadeIn(1000);		

				}
			}); 

			return false;  	 
		
		});  
		
		
		$('body').on('click','#updateParentMeeting',function(){  /* update online parmeeting */
		
			$('#frmupdateParentMeeting').submit(function(event) {		
				
				showPageLoader();	
		
				event.stopImmediatePropagation();
						
				$.post('parent-meeting-manager.php', $(this).find('select, input, textarea').serialize(), function(data) {
					
					$('#edit-msg').html(data);	
					//$('html, body').animate({ scrollTop:  $('#editMsg').offset().top - 30 }, 'slow');			
					
				});

				return false;
		
			});		
		});

		$('body').on('click','#saveStaffMeeting',function(){  /* save online staffmeeting */
		
			$('#frmsaveStaffMeeting').submit(function(event) {

				event.stopImmediatePropagation();
				
				showPageLoader();	
						
				$.post('staff-meeting-manager.php', $(this).find('select, input, textarea').serialize(), function(data) {
										
					$('#edit-msg').html(data);	  
				
				});
	
				return false;
			
			});
			
		});

		/*
		$('body').on('click','.start-staffmeeting',function(event){  /* view online staffmeeting * /
		
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

		$('body').on('click','.view-staffmeeting',function(event){  /* view online staffmeeting * /
		
			event.stopImmediatePropagation(); 

			var emptyStr = "";
			var staffmeetingID = this.id;
			var postVal = 'view';				

			showPageLoader();

			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();

			$('#modal-load-div').load( 'staff-meeting-manager.php', {'staffmeeting': postVal, 'eData': staffmeetingID }); 

			$('#modal-fobrain').modal('show');					

			return false;   
		
		});

		*/


		$('body').on('click','.add-staffmeeting',function(event){  /* edit online staffmeeting */ 
			
			event.stopImmediatePropagation(); 

			var emptyStr = "";
			var staffmeetingID = this.id;
			var postVal = 'add';				

			showPageLoader();

			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();

			$('#modal-load-div').load( 'staff-meeting-manager.php', {'staffmeeting': postVal, 'eData': staffmeetingID }); 

			$('#modal-fobrain').modal('show');					

			return false;  

		});

		$('body').on('click','.edit-staffmeeting',function(event){  /* edit online staffmeeting */ 
			
			event.stopImmediatePropagation(); 

			var emptyStr = "";
			var staffmeetingID = this.id;
			var postVal = 'edit';				

			showPageLoader();

			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();

			$('#modal-load-div').load( 'staff-meeting-manager.php', {'staffmeeting': postVal, 'eData': staffmeetingID }); 

			$('#modal-fobrain').modal('show');					

			return false;  

		});
		
		$('body').on('click','.remove-staffmeeting',function(event){  /* remove online staffmeeting */ 

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
					
					var eData = this.id;
					var postVal = 'remove'; 
					
					showPageLoader();
					
					$('#msg-box').load('staff-meeting-manager.php', {'staffmeeting': postVal, 'eData': eData
										}).fadeIn(1000);		

				}
			}); 

			return false;  	 
		
		});  
		
		
		$('body').on('click','#updateStaffMeeting',function(){  /* update online staffmeeting */
		
			$('#frmupdateStaffMeeting').submit(function(event) {		
				
				showPageLoader();	
		
				event.stopImmediatePropagation();
						
				$.post('staff-meeting-manager.php', $(this).find('select, input, textarea').serialize(), function(data) {
					
					$('#edit-msg').html(data);	
					//$('html, body').animate({ scrollTop:  $('#editMsg').offset().top - 30 }, 'slow');			
					
				});

				return false;
		
			});		
		});


		/** Course */

		$('body').on('click','#saveCourse',function(){  /* save online course */
		
			$('#frmsaveCourse').submit(function(event) {

				event.stopImmediatePropagation();
				
				showPageLoader();	
						
				$.post('e-course-manger.php', $(this).find('select, input, textarea').serialize(), function(data) {
											
					$('#new-course-div').html(data);	 

					document.body.setAttribute('data-sidebar-size', 'sm');		
				
				});
		
				return false;
			
			});
			
		});

		
		$('body').on('click','.view-course',function(event){  /* view online course */
		
			event.stopImmediatePropagation(); 

			var emptyStr = "";
			var courscid = this.id;
			var postVal = 'view';				

			showPageLoader();

			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();

			$('#modal-load-div').load( 'e-course-manger.php', {'course': postVal, 'eData': courscid }); 

			$('#modal-fobrain').modal('show');					

			return false;   
		
		});


		$('body').on('click','.edit-course',function(event){  /* edit online course */ 
			
			event.stopImmediatePropagation(); 

			var emptyStr = "";
			var courscid = this.id;
			var postVal = 'edit';				

			showPageLoader();

			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();

			$('#modal-load-div').load( 'e-course-manger.php', {'course': postVal, 'eData': courscid }); 

			$('#modal-fobrain').modal('show');					

			return false;  

		});
		
		$('body').on('click','.remove-course',function(event){  /* remove online course */ 

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
					
					var eData = this.id;
					var postVal = 'remove'; 
					
					showPageLoader();
					
					$('#msg-box').load('e-course-manger.php', {'course': postVal, 'eData': eData
										}).fadeIn(1000);		

				}
			}); 

			return false;  	 
		
		});  
		
		
		$('body').on('click','#updateCourse',function(){  /* update online course */
		
			$('#frmupdateCourse').submit(function(event) {		
				
				showPageLoader();	
		
				event.stopImmediatePropagation();
						
				$.post('e-course-manger.php', $(this).find('select, input, textarea').serialize(), function(data) {
					
					$('#edit-msg').html(data);	
					//$('html, body').animate({ scrollTop:  $('#editMsg').offset().top - 30 }, 'slow');			
					
				});
	
				return false;
		
			});		
		});
		
		
		$('body').on('click', '.addCourseQuest',function(event){  /* save course chapter */
		
			event.stopImmediatePropagation();											
			
			showPageLoader();	
			
			var postVal = 'chapters';
			var courseData = this.id.split('-');
			var cid = courseData[1]; 
			
			$('#load-wiz-info').load('e-course-manger.php', {'course': postVal, 'cid': cid
									}).fadeIn(1000);	 							
			
			return false;  
		
		}); 

		/** Course Topic */


		$('body').on('click','.viewTopic',function(event){  /* view course topic */
		
			event.stopImmediatePropagation();	
			
			var emptyStr = "";
			var topicID = this.id;
			var postVal = 'view';				
			
			showPageLoader();

			$('#course-msg').html(emptyStr);	
			$('#modal-load-div').show();
			
			$('#modal-load-div').load('e-topics.php', {'query': postVal, 'rData': topicID
									}).fadeIn(1000);											   
									
			
			$('#modal-fobrain').modal('show');					
			
			return false;  
		
		});

		$('body').on('click','.editTopic',function(event){  /* edit course topic */ 

			event.stopImmediatePropagation();	

			var emptyStr = "";
			var qData = this.id.split('-');
			var topicID = qData[1];
			var courscid = qData[2];

			var postVal = 'edit';				

			showPageLoader();

			$('#course-msg').html(emptyStr);	
			$('#modal-load-div').show();

			$('#modal-load-div').load('e-topics.php', {'query': postVal, 'topicID': topicID, 'courscid': courscid
													}).fadeIn(1000);		 
													
			$('#modal-fobrain').modal('show');					

			return false;  

		});
		
		$('body').on('click','.removeTopic',function(event){  /* remove course topic */
		
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
				
					$('#course-msg').load('e-topics.php', {'query': postVal, 'rData': rData
											}).fadeIn(1000);		
					
				}
			});  
		
		});  
		
		
		$('body').on('click','#updateTopic',function(){  /* update course topic */
		
			$('#frmupdateTopic').submit(function(event) {		
				
				$('.fob-btn-div').fadeOut(100);
				$('.fob-btn-loader').fadeIn(100); 
		
				event.stopImmediatePropagation();
						
				$.post('e-topics.php', $(this).find('select, input, textarea, file').serialize(), function(data) {
					
					$('#course-msg').html(data);	
					//$('html, body').animate({ scrollTop:  $('#edit-msg').offset().top - 30 }, 'slow');			
					
				});
	
				return false;
		
			});		
		}); 

		$('body').on('change','#eTopicPic',function(){	  /* save course topic picture */

			$('.fob-btn-div').fadeOut(100);
			$('.fob-btn-loader').fadeIn(100); 

			var form_data = new FormData($('#frmupdateTopic')[0]);

			$.ajax({
				url: 'e-topics.php',
				dataType: 'text',
				cache: false,
				contentType: false,
				processData: false,
				data: form_data,
				type: 'post',
				success: function (response) {
					$('#course-msg').html(response); 
				},
				error: function (response) {
					$('#course-msg').html(response);
				}
			});

			return false;

		});

		/** Course Chapters */
		
		$('body').on('click','.viewChapter',function(event){  /* view course chapter */
		
			event.stopImmediatePropagation();	
			
			var emptyStr = "";
			var chapterID = this.id;
			var postVal = 'view';				
			
			showPageLoader();

			$('#course-msg').html(emptyStr);	
			$('#modal-load-div').show();
			
			$('#modal-load-div').load('e-chapters.php', {'query': postVal, 'rData': chapterID
									}).fadeIn(1000);											   
									
			
			$('#modal-fobrain').modal('show');					
			
			return false;  
		
		});

		$('body').on('click','.edit-chapter',function(event){  /* edit course chapter */ 

			event.stopImmediatePropagation();	

			var emptyStr = "";

			var qData = this.id;
			//var qData = this.id.split('-'); 
			//var qchapter = qData[1];
			//var topic = qData[1];

			var postVal = 'edit';				

			showPageLoader();

			$('#course-msg').html(emptyStr);	
			$('#modal-load-div').show();

			$('#modal-load-div').load('e-chapters.php', {'query': postVal, 'qData': qData
													}).fadeIn(1000);		 
													
			$('#modal-fobrain').modal('show');					

			return false;  

		});
		
		$('body').on('click','.remove-chapter',function(event){  /* remove course chapter */
		
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
				
					$('#edit-msg').load('e-chapters.php', {'query': postVal, 'rData': rData
											}).fadeIn(1000);		
					
				}
			});  
		
		});  
		
		
		$('body').on('click','#updateChapter',function(){  /* update course chapter */
		
			$('#frmupdateChapter').submit(function(event) {		
				
				$('.fob-btn-div').fadeOut(100);
				$('.fob-btn-loader').fadeIn(100); 
		
				$('#course-msg').html(""); 

				event.stopImmediatePropagation();
						
				$.post('e-chapters.php', $(this).find('select, input, textarea, file').serialize(), function(data) {
					
					$('#course-msg').html(data);	
					//$('html, body').animate({ scrollTop:  $('#edit-msg').offset().top - 30 }, 'slow');			
					
				});
	
				return false;
		
			});		
		}); 

		$('body').on('change','#eChapterPic',function(){	  /* save course chapter picture */

			$('.fob-btn-div').fadeOut(100);
			$('.fob-btn-loader').fadeIn(100); 

			$('#course-msg').html(""); 

			var form_data = new FormData($('#frmupdateChapter')[0]);

			$.ajax({
				url: 'e-chapters.php',
				dataType: 'text',
				cache: false,
				contentType: false,
				processData: false,
				data: form_data,
				type: 'post',
				success: function (response) {
					$('#course-msg').html(response); 
				},
				error: function (response) {
					$('#course-msg').html(response);
				}
			});

			return false;

		}); 

		$('body').on('click','.course-quiz',function(event){  /* edit course chapter */ 

			event.stopImmediatePropagation();	

			var emptyStr = "";

			var qData = this.id;
			//var qData = this.id.split('-'); 
			//var qchapter = qData[1];
			//var topic = qData[1];

			var postVal = 'quiz';				

			showPageLoader();

			$('#course-msg').html(emptyStr);	
			$('#modal-load-div').show();

			$('#modal-load-div').load('e-course-quiz.php', {'query': postVal, 'qData': qData
													}).fadeIn(1000);		 
													
			$('#modal-fobrain').modal('show');					

			return false;  

		});

		
		$('body').on('click','#saveExam',function(){  /* save online exam */
		
			$('#frmsaveExam').submit(function(event) {

				event.stopImmediatePropagation();
				
				showPageLoader();	
						
				$.post('e-exam-manger.php', $(this).find('select, input, textarea').serialize(), function(data) {
											
					$('#new-exam-div').html(data);	 

					document.body.setAttribute('data-sidebar-size', 'sm');	
				
				});
		
				return false;
			
			});
			
		});

		
		$('body').on('click','.view-exam',function(event){  /* view online exam */
		
			event.stopImmediatePropagation(); 

			var emptyStr = "";
			var examID = this.id;
			var postVal = 'view';				

			showPageLoader();

			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();

			$('#modal-load-div').load( 'e-exam-manger.php', {'exam': postVal, 'eData': examID }); 

			$('#modal-fobrain').modal('show');					

			return false;   
		
		});


		$('body').on('click','.edit-exam',function(event){  /* edit online exam */ 
			
			event.stopImmediatePropagation(); 

			var emptyStr = "";
			var examID = this.id;
			var postVal = 'edit';				

			showPageLoader();

			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();

			$('#modal-load-div').load( 'e-exam-manger.php', {'exam': postVal, 'eData': examID }); 

			$('#modal-fobrain').modal('show');					

			return false;  

		});
		
		$('body').on('click','.remove-exam',function(event){  /* remove online exam */ 

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
					
					var eData = this.id;
					var postVal = 'remove'; 
					
					showPageLoader();
					
					$('#msg-box').load('e-exam-manger.php', {'exam': postVal, 'eData': eData
										}).fadeIn(1000);		

				}
			}); 

			return false;  	 
		
		});  
		
		
		$('body').on('click','#updateExam',function(){  /* update online exam */
		
			$('#frmupdateExam').submit(function(event) {		
				
				showPageLoader();	
		
				event.stopImmediatePropagation();
						
				$.post('e-exam-manger.php', $(this).find('select, input, textarea').serialize(), function(data) {
					
					$('#edit-msg').html(data);	
					//$('html, body').animate({ scrollTop:  $('#editMsg').offset().top - 30 }, 'slow');			
					
				});
	
				return false;
		
			});		
		});
		
		
		$('body').on('click', '.addExamQuest',function(event){  /* save exam question */
		
			event.stopImmediatePropagation();											
			
			showPageLoader();	
			
			var postVal = 'questions';
			var examData = this.id.split('-');
			var eID = examData[1]; 
			
			$('#load-wiz-info').load('e-exam-manger.php', {'exam': postVal, 'eID': eID
									}).fadeIn(1000);	 							
			
			return false;  
		
		}); 
		
		$('body').on('click','.viewQuestion',function(event){  /* view exam question */
		
			event.stopImmediatePropagation();	
			
			var emptyStr = "";
			var questionID = this.id;
			var postVal = 'view';				
			
			showPageLoader();

			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();
			
			$('#modal-load-div').load('e-questions.php', {'question': postVal, 'rData': questionID
									}).fadeIn(1000);											   
									
			
			$('#modal-fobrain').modal('show');					
			
			return false;  
		
		});

		$('body').on('click','.editQuestion',function(event){  /* edit exam question */ 

			event.stopImmediatePropagation();	

			var emptyStr = "";
			var qData = this.id.split('-');
			var questionID = qData[1];
			var examID = qData[2];

			var postVal = 'edit';				

			showPageLoader();

			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();

			$('#modal-load-div').load('e-questions.php', {'question': postVal, 'questionID': questionID, 'examID': examID
													}).fadeIn(1000);		 
													
			$('#modal-fobrain').modal('show');					

			return false;  

		});
		
		$('body').on('click','.removeQuestion',function(event){  /* remove exam question */
		
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
				
					$('#edit-msg').load('e-questions.php', {'question': postVal, 'rData': rData
											}).fadeIn(1000);		
					
				}
			});  
		
		});  
		
		
		$('body').on('click','#updateQuestion',function(){  /* update exam question */
		
			$('#frmupdateQuestion').submit(function(event) {		
				
				showPageLoader();	
		
				event.stopImmediatePropagation();
						
				$.post('e-questions.php', $(this).find('select, input, textarea, file').serialize(), function(data) {
					
					$('#edit-msg').html(data);	
					$('html, body').animate({ scrollTop:  $('#edit-msg').offset().top - 30 }, 'slow');			
					
				});
	
				return false;
		
			});		
		}); 

		$('body').on('change','#eQuestionPic',function(){	  /* save exam question picture */

			$('.fob-btn-div').fadeOut(100);
			$('.fob-btn-loader').fadeIn(100); 

			var form_data = new FormData($('#frmupdateQuestion')[0]);

			$.ajax({
				url: 'e-questions.php',
				dataType: 'text',
				cache: false,
				contentType: false,
				processData: false,
				data: form_data,
				type: 'post',
				success: function (response) {
					$('#edit-msg').html(response); 
				},
				error: function (response) {
					$('#edit-msg').html(response);
				}
			});

			return false;

		}); 

		$('body').on('click','#saveHomeWork',function(){  /* save online homework */
			
			$('#frmsaveHomeWork').submit(function(event) {

				event.stopImmediatePropagation();
				
				showPageLoader();	
						
				$.post('e-homework-manger.php', $(this).find('select, input, textarea').serialize(), function(data) {
										
					$('#new-homework-div').html(data);	 

					document.body.setAttribute('data-sidebar-size', 'sm');	
				
				});
	
				return false;
			
			});
			
		});

		
		$('body').on('click','.view-homework',function(event){  /* view online homework */
		
			event.stopImmediatePropagation(); 

			var emptyStr = "";
			var homeworkID = this.id;
			var postVal = 'view';				

			showPageLoader();

			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();

			$('#modal-load-div').load( 'e-homework-manger.php', {'homework': postVal, 'eData': homeworkID }); 

			$('#modal-fobrain').modal('show');					

			return false;   
		
		});


		$('body').on('click','.edit-homework',function(event){  /* edit online homework */ 
			
			event.stopImmediatePropagation(); 

			var emptyStr = "";
			var homeworkID = this.id;
			var postVal = 'edit';				

			showPageLoader();

			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();

			$('#modal-load-div').load( 'e-homework-manger.php', {'homework': postVal, 'eData': homeworkID }); 

			$('#modal-fobrain').modal('show');					

			return false;  

		});
		
		$('body').on('click','.remove-homework',function(event){  /* remove online homework */ 

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
					
					var eData = this.id;
					var postVal = 'remove'; 
					
					showPageLoader();
					
					$('#msg-box').load('e-homework-manger.php', {'homework': postVal, 'eData': eData
										}).fadeIn(1000);		

				}
			}); 

			return false;  	 
		
		});  
		
		
		$('body').on('click','#updateHomeWork',function(){  /* update online homework */
		
			$('#frmupdateHomeWork').submit(function(event) {		
				
				showPageLoader();	
		
				event.stopImmediatePropagation();
						
				$.post('e-homework-manger.php', $(this).find('select, input, textarea').serialize(), function(data) {
					
					$('#edit-msg').html(data);	
					//$('html, body').animate({ scrollTop:  $('#editMsg').offset().top - 30 }, 'slow');			
					
				});

				return false;
		
			});		
		});
		
		
		$('body').on('click', '.addHomeWorkQuest',function(event){  /* save homework question */
		
			event.stopImmediatePropagation();											
			
			showPageLoader();	
			
			var postVal = 'questions';
			var HomeWorkData = this.id.split('-');
			var eID = HomeWorkData[1]; 
			
			$('#load-wiz-info').load('e-homework-manger.php', {'homework': postVal, 'eID': eID
									}).fadeIn(1000);	 							
			
			return false;  
		
		}); 
		
		
		$('body').on('click','.view-hw-question',function(event){  /* view homework question */
		
			event.stopImmediatePropagation();	
			
			var emptyStr = "";
			var questionID = this.id;
			var postVal = 'view';				
			
			showPageLoader();

			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();
			
			$('#modal-load-div').load('e-hm-questions.php', {'question': postVal, 'rData': questionID
									}).fadeIn(1000);											   
									
			
			$('#modal-fobrain').modal('show');					
			
			return false;  
		
		});

		$('body').on('click','.edit-hw-question',function(event){  /* edit homework question */ 

			event.stopImmediatePropagation();	

			var emptyStr = "";
			var qData = this.id.split('-');
			var questionID = qData[1];
			var homeworkID = qData[2];

			var postVal = 'edit';				

			showPageLoader();

			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();

			$('#modal-load-div').load('e-hm-questions.php', {'question': postVal, 'questionID': questionID, 'homeworkID': homeworkID
													}).fadeIn(1000);		 
													
			$('#modal-fobrain').modal('show');					

			return false;  

		});
		
		$('body').on('click','.remove-hw-question',function(event){  /* remove homework question */
		
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
				
					$('#edit-msg').load('e-hm-questions.php', {'question': postVal, 'rData': rData
										}).fadeIn(1000);		
					
				}
			});  
		
		});  
		
		
		$('body').on('click','#updateQuestionHW',function(){  /* update homework question */
		
			$('#frmupdateQuestionHW').submit(function(event) {		
				
				showPageLoader();	
		
				event.stopImmediatePropagation();
						
				$.post('e-hm-questions.php', $(this).find('select, input, textarea, file').serialize(), function(data) {
					
					$('#edit-msg').html(data);	
					$('html, body').animate({ scrollTop:  $('#edit-msg').offset().top - 30 }, 'slow');			
					
				});

				return false;
		
			});		

		});

		$('body').on('change','#eQuestionHWPic',function(){	  /* save homework question picture */

			$('.fob-btn-div').fadeOut(100);
			$('.fob-btn-loader').fadeIn(100); 

			var form_data = new FormData($('#frmupdateQuestionHW')[0]);

			$.ajax({
				url: 'e-hm-questions',
				dataType: 'text',
				cache: false,
				contentType: false,
				processData: false,
				data: form_data,
				type: 'post',
				success: function (response) {
					$('#edit-msg').html(response); 
				},
				error: function (response) {
					$('#edit-msg').html(response);
				}
			});

			return false;

		});  
		
		function hideTBCols() {  /* hide table columns */
							
			var data_table = $('#wiz-table').DataTable();
						
			data_table.columns('.hideColumn').visible(false);
						
			$('#hideTBColsBtn').fadeOut(200);
			$('#showTBColsBtn').fadeIn(200);
				
		}	
					
		function showTBCols() {  /* show table columns */
							
			var data_table = $('#wiz-table').DataTable();
						
			data_table.columns('.hideColumn').visible(true);
						
			$('#hideTBColsBtn').fadeIn(200);
			$('#showTBColsBtn').fadeOut(200);
			
		}	 
		
		/*
		$('body').on('click','.show-rsconfig-div',function(event){    
		
			event.stopImmediatePropagation();		
			
			//$('.lowRSDiv').fadeIn(2000);
			//$('.highRSDiv').fadeOut(2000);
			//$('.show-rs-div').fadeIn(200);
			//$('.show-rsconfig-div').fadeOut(200);
		
		});
		*/

		$('body').on('click','.show-rs-div',function(event){  /* load result div */
		
			event.stopImmediatePropagation();	 
			$('.lowRSDiv').fadeOut(2000);
			$('.highRSDiv').fadeIn(2000);
			$('.show-rsconfig-div').fadeIn(200);
			$('.show-rs-div').fadeOut(200); 
		
		});
		
		$('body').on('change','#upload-sch-logo',function(){	  /* upload bulk comments result */

			$('.fob-btn-div').fadeOut(100);
			$('.fob-btn-loader').fadeIn(100); 

			var form_data = new FormData($('#frm-sch-logo')[0]);

			$.ajax({
				url: 'wiz-config-manger.php',
				dataType: 'text',
				cache: false,
				contentType: false,
				processData: false,
				data: form_data,
				type: 'post',
				success: function (response) {
					$('#msg-box').html(response); 
				},
				error: function (response) {
					$('#msg-box').html(response);
				}
			});

			return false;

		}); 

		$('body').on('change','#bulk-excel-result',function(){	  /* upload bulk result */

			$('.fob-btn-div').fadeOut(100);
			$('.fob-btn-loader').fadeIn(100); 

			var form_data = new FormData($('#frmbulk-excel-result')[0]);

			$.ajax({
				url: 'bulk-rs-upload.php',
				dataType: 'text',
				cache: false,
				contentType: false,
				processData: false,
				data: form_data,
				type: 'post',
				success: function (response) {
					$('#fobrain-page-div').html(response);
					$('.fobrain-section-div').slideUp(2000);	
					$('#wiz-slider').slideDown(2000);
					$('.fobrain-page-icons').fadeIn(200); 
					document.body.setAttribute('data-sidebar-size', 'sm');
				},
				error: function (response) {
					$('#fobrain-page-div').html(response);
				}
			});

			return false;

		});

		$('body').on('click','.save-bulk-rs-excel',function(event){  /* save bulk student computation result */
		
			event.stopImmediatePropagation();
			
			var uData = $('#upload-qy-data').text();
			var uMode = 2;
			var rsData = "upload";
			
			showPageLoader();   
				
			$('#fobrain-page-div').load('bulk-rs-upload.php', {'query': rsData, 'uploadData': uData, 'uMode': uMode}).fadeIn(1000);
			$('html, body').animate({ scrollTop:  $('. excel-scroll-to').offset().top - 100 }, 'slow');				
		
			return false;  
		
		}); 

		$('body').on('change','#bulk-excel-com',function(){	  /* upload bulk comments result */

			$('.fob-btn-div').fadeOut(100);
			$('.fob-btn-loader').fadeIn(100); 

			var form_data = new FormData($('#frmbulk-excel-com')[0]);

			$.ajax({
				url: 'bulk-rs-upload.php',
				dataType: 'text',
				cache: false,
				contentType: false,
				processData: false,
				data: form_data,
				type: 'post',
				success: function (response) {
					$('#fobrain-page-div').html(response);
					$('.fobrain-section-div').slideUp(2000);	
					$('#wiz-slider').slideDown(2000);
					$('.fobrain-page-icons').fadeIn(200); 
					document.body.setAttribute('data-sidebar-size', 'sm');
				},
				error: function (response) {
					$('#fobrain-page-div').html(response);
				}
			});

			return false;

		});

		$('body').on('click','.save-bulk-com-excel',function(event){  /* save bulk student comment result */
		
			event.stopImmediatePropagation();
			
			var uData = $('#upload-qy-data').text();
			var uMode = 2;
			var rsData = "upload";
			
			showPageLoader();   
			
			$('#fobrain-page-div').load('bulk-com-upload.php', {'query': rsData,'uploadData': uData, 'uMode': uMode}).fadeIn(1000);
			$('html, body').animate({ scrollTop:  $('. excel-scroll-to').offset().top - 100 }, 'slow');			
		
			return false;  
		
		});

		$('body').on('change','#bulk-excel-exam',function(){	  /* upload bulk exam & questions */

			$('.fob-btn-div').fadeOut(100);
			$('.fob-btn-loader').fadeIn(100); 

			var form_data = new FormData($('#frmbulk-excel-exam')[0]);

			$.ajax({
				url: 'bulk-question-upload.php',
				dataType: 'text',
				cache: false,
				contentType: false,
				processData: false,
				data: form_data,
				type: 'post',
				success: function (response) {
					$('#fobrain-page-div').html(response);
					$('.fobrain-section-div').slideUp(2000);	
					$('#wiz-slider').slideDown(2000);
					$('.fobrain-page-icons').fadeIn(200); 
					document.body.setAttribute('data-sidebar-size', 'sm');
				},
				error: function (response) {
					$('#fobrain-page-div').html(response);
				}
			});

			return false;

		});

		$('body').on('click','.save-bulk-exam',function(event){  /* save bulk student registration */
		
			event.stopImmediatePropagation();
			
			var uData = $('#upload-qy-data').text();
			var uMode = 2;
			var query = "upload";
			
			showPageLoader();   
			
			$('#fobrain-page-div').load('bulk-question-upload.php', {'query': query,'uploadData': uData, 'uMode': uMode}).fadeIn(1000);
			$('html, body').animate({ scrollTop:  $('. excel-scroll-to').offset().top - 100 }, 'slow');			
		
			return false;  
		
		}); 
		 

		$('body').on('change','#bulk-excel-bio',function(){	  /* upload bulk comments result */

			$('.fob-btn-div').fadeOut(100);
			$('.fob-btn-loader').fadeIn(100); 

			var form_data = new FormData($('#frmbulk-excel-bio')[0]);

			$.ajax({
				url: 'bulk-rs-upload.php',
				dataType: 'text',
				cache: false,
				contentType: false,
				processData: false,
				data: form_data,
				type: 'post',
				success: function (response) {
					$('#fobrain-page-div').html(response);
					$('.fobrain-section-div').slideUp(2000);	
					$('#wiz-slider').slideDown(2000);
					$('.fobrain-page-icons').fadeIn(200); 
					document.body.setAttribute('data-sidebar-size', 'sm');
				},
				error: function (response) {
					$('#fobrain-page-div').html(response);
				}
			});

			return false;

		});  
		
		$('body').on('click','.save-bulk-reg',function(event){  /* save bulk student registration */
		
			event.stopImmediatePropagation();
			
			var uData = $('#upload-qy-data').text();
			var uMode = 2;
			var query = "upload";
			
			showPageLoader();   
			
			$('#fobrain-page-div').load('bulk-bio-upload.php', {'query': query,'uploadData': uData, 'uMode': uMode}).fadeIn(1000);
			$('html, body').animate({ scrollTop:  $('. excel-scroll-to').offset().top - 100 }, 'slow');			
		
			return false;  
		
		});   
		
		$('body').on('change','#uploadProfile',function(){	  /* upload student profile */

			$('.fob-btn-profile').fadeOut(100);
			$('.fob-loader-profile').fadeIn(100); 

			var form_data = new FormData($('#frmuploadProfile')[0]);

			$.ajax({
				url: 'bio-manager.php',
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

		$('body').on('change','#upload1',function(){	  /* upload student document 1  */

			$('.fob-btn-bcert').fadeOut(100);
			$('.fob-loader-bcert').fadeIn(100); 

			var form_data = new FormData($('#frmDoc1')[0]);

			$.ajax({
				url: 'bio-manager.php',
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

		$('body').on('change','#upload2',function(){	  /* upload student document 2  */

			$('.fob-btn-guardid').fadeOut(100);
			$('.fob-loader-guardid').fadeIn(100); 

			var form_data = new FormData($('#frmDoc2')[0]);

			$.ajax({
				url: 'bio-manager.php',
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

		$('body').on('change','#upload3',function(){	  /* upload student document 3  */

			$('.fob-btn-prevcert').fadeOut(100);
			$('.fob-loader-prevcert').fadeIn(100); 

			var form_data = new FormData($('#frmDoc3')[0]);

			$.ajax({
				url: 'bio-manager.php',
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
		
		$('body').on('change','#state',function(){  /* load state div */			
			
			$('#wait_1').show();
			$('#result_1').hide();
			$('#fi_lga').hide();
			
			$.get("emji_lga.php", {
				func: "state",
				drop_var: $('#state').val()
			}, function(response){
				$('#wait_1').fadeOut(1500);
				$('#result_1').html(response).fadeIn(2000); 
			});
			
			return false;
		});
		
		$('body').on('change','#teacherDiv',function(){  /* load staff div */

			$('#wait_11').show();
			$('#result_11').hide();
			$.get("wizg-dropper.php", {
			func: "teacherPic",
			teacherID: $('#teacherDiv').val()
			}, function(response){
				$('#wait_11').fadeOut(1500);
				$('#result_11').html(response).fadeIn(2000); 
			});

			return false;

		});  

		$('body').on('change','.search-regno',function(){  /* load registration number div */
		
			$('#wait_1').show();
			$('#result_1').hide();
			$.get("wizg-dropper.php", {
			func: "trans-search",
			regNo: $('.search-regno').val()
			}, function(response){
				$('#wait_1').fadeOut(1500);
				$('#result_1').html(response).fadeIn(2000); 
			});
	
			return false;

		});

		$('body').on('change','.search-new-reg',function(){  /* load registration number div */
		
			$('#wait_11').show();
			$('#result_11').hide();
			$.get("wizg-dropper.php", {
			func: "check-reg-no",
			RegNum: $('.search-new-reg').val()
			}, function(response){
				$('#wait_11').fadeOut(1500);
				$('#result_11').html(response).fadeIn(2000); 
			});
		
			return false;
		});


		$('body').on('change','#level',function(){  /* load school level div */
			
			$('#wait_1').show();
			$('#result_1').hide();
			$.get("wizg-dropper.php", {
			func: "studentLevel",
			level: $('#level').val()
			}, function(response){
				$('#wait_1').fadeOut(1500);
				$('#result_1').html(response).fadeIn(2000); 
			});
		
			return false;
		});
		
		$('body').on('change','#sesslevel',function(){  /* load school session div */
			
			$('#wait_1').show();
			$('#result_1').hide();
			
			var allClass = $('#classAll').val();
			
			if (typeof allClass === "undefined") {					
				var allClass = 0; 					
			}	  

			$.get("wizg-dropper.php", {
				func: "sLevel",
				classAll: allClass,
				level: $('#sesslevel').val()
			}, function(response){					 
				$('#wait_1').fadeOut(1500);
				$('#result_1').html(response).fadeIn(2000); 
			});
		
			return false;
		});
		
		$('body').on('change','#studentClass',function(){  /* select student class */
			
			var selClass = $(this).val();
		
			if(selClass == 'all'){
		
				$("select#schoolTerm option[value='annual']").remove(); 	
			
			}else{
			
				$("select#schoolTerm option[value='annual']").remove(); 	
				$("#schoolTerm").append('<option value="annual">Annual Results</option>');
			}		
	
			return false;

		});

		$('body').on('change','#subjectLevel',function(){  /* load student subject level */
			
			$('#wait_1').show();
			$('#result_1').hide();
			
			var allClass = $('#classAll').val();
			
			if (typeof allClass === "undefined") { 
				var allClass = 0; 
			}	  
			
			$.get("wizg-dropper.php", {
				func: "subjLevel",
				classAll: allClass,
				subjTerm: $('#subjTerm').val(),
				level: $('#subjectLevel').val(),
				euData: $('#euData').val()
			}, function(response){
				$('#wait_1').fadeOut(1500);
				$('#result_1').html(response).fadeIn(2000); 
			});
		
			return false;
		});		 
		
		$('body').on('change','#subjectLevel2',function(){  /* load student subject level */
				
			$('#wait_11').show();
			$('#result_11').hide();
			
			var allClass = $('#classAll2').val();
			
			if (typeof allClass === "undefined") { 
				var allClass = 0; 
			}	  
			
			$.get("wizg-dropper.php", {
				func: "subjLevel",
				classAll: allClass,
				subjTerm: $('#subjTerm2').val(),
				level: $('#subjectLevel2').val(),
				euData: $('#euData2').val()
			}, function(response){
				$('#wait_11').fadeOut(1500);
				$('#result_11').html(response).fadeIn(2000); 
			}); 
		
			return false;
		}); 

		$('body').on('change','#subjTerm',function(){  /* load student subject term level */
				
			$('#result, #subjectExamDiv').hide();	
			$('#wait').show();
			$("#subjectLevel").val("");
			$.get("wizg-dropper.php", {
				func: "subjDropTerm",
				term: $('#subjTerm').val()
			}, function(response){  
				$('#wait').fadeOut(1500);
				$('#subjectExamDiv').fadeIn(2000);
				$('#result').html(response).fadeIn(2000); 
				
			});
		
			return false; 
		});

		$('body').on('change','#meetingLevel',function(){  /* load student subject level */
			
			$('#wait_1').show();
			$('#result_1').hide();
			
			var allClass = $('#classAll').val();
			
			if (typeof allClass === "undefined") { 
				var allClass = 0; 
			}	  
			
			$.get("wizg-dropper.php", {
				func: "meetLevel",
				classAll: allClass,
				eType: $('#par-meet-type').val(),
				level: $('#meetingLevel').val(),
				euData: $('#euData').val()
			}, function(response){
				$('#wait_1').fadeOut(1500);
				$('#result_1').html(response).fadeIn(2000); 
			});
		
			return false;
		});	
		
		$('body').on('change','#par-meet-type',function(){  /* load meeting */
				
			$('#result, #par-meet-div').hide();	
			$('#wait').show();
			//$("#subjectLevel").val("");
			$.get("wizg-dropper.php", {
				func: "meetDrop",
				eType: $('#par-meet-type').val()
			}, function(response){  
				$('#wait').fadeOut(1500);
				$('#par-meet-div').fadeIn(2000);
				$('#result').html(response).fadeIn(2000); 
				
			});
		
			return false; 
		});

		$('body').on('change','#allow-staff',function(){  /* load meeting */ 
				
			$('#wait_a').show();
			$.get("wizg-dropper.php", {
				func: "allowDrop",
				allow: $('#allow-staff').val()
			}, function(response){  
				$('#wait_a').fadeOut(1500); 
				$('#result_a').html(response).fadeIn(2000); 
				
			});
		
			return false; 
		});

		$('body').on('change','#staff-meet-type',function(){  /* load meeting */ 
				
			$('#wait').show();
			$.get("wizg-dropper.php", {
				func: "meetDrop",
				meetType: $('#staff-meet-type').val()
			}, function(response){  
				$('#wait').fadeOut(1500); 
				$('#result').html(response).fadeIn(2000); 
				
			});
		
			return false; 
		});

		$('body').on('change','#levelReg',function(){  /* load school level */
			
			$('#wait_1').show();
			$('#result_1').hide();
			$.get("wizg-dropper-reg.php", {
				func: "stuLevelReg",
				level: $('#levelReg').val()
			}, function(response){
				$('#wait_1').fadeOut(1500);
				$('#result_1').html(response).fadeIn(2000); 
			});
		
			return false;
			
		}); 

		$('body').on('change','#levelCM',function(){  /* load school level */
			
			$('#wait_1').show();
			$('#result_1').hide();
			$.get("wizg-dropper.php", {
			func: "studentLevelCM",
			level: $('#levelCM').val()
			}, function(response){
				$('#wait_1').fadeOut(1500);
				$('#result_1').html(response).fadeIn(2000); 
			});
		
			return false;

		}); 

		$('body').on('change','#ftSession',function(){  /* load school session */
			
			$('#wait_1').show();
			$('#result_1').hide();
			$.get("wizg-dropper.php", {
			func: "fteachSession",
			session: $('#ftSession').val()
			}, function(response){
				$('#wait_1').fadeOut(1500);
				$('#result_1').html(response).fadeIn(2000); 
			});
		
			return false;

		});

		$('body').on('change','#ftlevel',function(){  /* load staff school level */
			
			$('#wait_11').show();
			$('#result_11').hide();
			$.get("wizg-dropper.php", {
			func: "fteachLevel",
			level: $('#ftlevel').val(),
			session: $('#ftSession').val()
			}, function(response){
				$('#wait_1').fadeOut(1500);
				$('#result_1').html(response).fadeIn(2000); 
			});
	
			return false;

		});
		
		$('body').on('change','#ftSessL',function(){  /* load staff school session */
			
			$('#wait_1').show();
			$('#result_1').hide();
			$.get("wizg-dropper.php", {
			func: "sessionLev",
			level: $('#ftSessL').val()
			}, function(response){
				$('#wait_1').fadeOut(1500);
				$('#result_1').html(response).fadeIn(2000); 
			});
	
			return false;

		}); 

		$('body').on('change','#certifyRS',function(){  /* certify student result */
			
			$('#wait_1').show();
			$('#result_1').hide();
			$.get("wizg-dropper.php", {
			func: "Certify",
			certify: $('#certifyRS').val()
			}, function(response){
				$('#wait_1').fadeOut(1500);
				$('#result_1').html(response).fadeIn(2000); 
			});
		
			return false;
			
		});

		function finishAjax(id, response) {  /* load div */
			$('#wait, #wait_1, #wait_11, #wait_111, #fi_lga').hide();
			$('#'+id).html(unescape(response));
			$('#'+id).fadeIn();
		} 

		function finishAjax_tier_three(id, response) {  /* load div */
			$('#wait_2').hide();
			$('#'+id).html(unescape(response));
			$('#'+id).fadeIn();
		}   

		$('body').on('click', '#changeAPass', function(event){  /* change admin password */
																	
			$('#frmchangeAPass').submit(function(event) {
							
				event.stopImmediatePropagation();
				
				showPageLoader();
						
				$.post('adminChangePass.php', $(this).find('select, input').serialize(), function(data) {
					
					$('#msgBox').html(data);
																
				});
				
				$('html, body').animate({scrollTop:$('#msgBox').position().top}, 'slow'); 
		
				return false;
			
			});	
									
		}); 

		$('body').on('click', '#changeSPass', function(event){  /* change staff password */
																	
			$('#frmchangeSPass').submit(function(event) {
							
				event.stopImmediatePropagation();
				
				showPageLoader();
						
				$.post('changeStaffPass.php', $(this).find('select, input').serialize(), function(data) {
					
					$('#msgBox').html(data); 
														
				});
				
				$('html, body').animate({scrollTop:$('#msgBox').position().top}, 'slow'); 
		
				return false;
			
			});	
									
		});  
		
		$('body').on('click','.editAminBio',function(event){  /* edit admin profile */
		
			event.stopImmediatePropagation();
		
			showPageLoader();   
			$('#adminBioDiv').load('adminBio.php', {'editAdmin': $(this).attr('href')}).fadeIn(1000);
			$('html, body').animate({ scrollTop:  $('.scrollTargetMPage').offset().top - 30 }, 'slow'); 
		
			return false; 
		
		});

		$('body').on('click','#saveStep1',function(){  /* save admin profile */
		
			$('#frmStep1').submit(function(event) {
							
				event.stopImmediatePropagation();
				
				$('.BioDataLoader').fadeIn(100);
						
				$.post('adminProfileManager.php', $(this).find('select, input').serialize(), function(data) {
					
					$('.msgBox1').html(data);
																
				});
				
				$('html, body').animate({ scrollTop:  $('.scroll-to-div').offset().top - 50 }, 'slow');
		
				return false;
			
			});		
		}); 

		$('body').on('click','#saveStep2',function(){  /* save admin profile */
		
			$('#frmStep2').submit(function(event) {
							
				event.stopImmediatePropagation();
				
				$('.adminLoader').fadeIn(100);
						
				$.post('adminProfileManager.php', $(this).find('select, input').serialize(), function(data) {
					
					$('.msgBox2').html(data);
				
				});
				
				$('html, body').animate({ scrollTop:  $('.scroll-to-div').offset().top - 50 }, 'slow');
		
				return false;
			
			});		
		}); 

		$('body').on('click','#saveStep3',function(){  /* save admin profile */
		
			$('#frmStep3').submit(function(event) {
							
				event.stopImmediatePropagation();
				
				$('.adminLoader').fadeIn(100);
						
				$.post('adminProfileManager.php', $(this).find('select, input').serialize(), function(data) {

					$('.msgBox3').html(data);						
				
				});
				
				$('html, body').animate({ scrollTop:  $('.scroll-to-div').offset().top - 50 }, 'slow');
		
				return false;
			
			});		
		});  

		$('body').on('click','.cfEdit',function(event){  /* edit school subject information */
		
			event.stopImmediatePropagation();	
			
			var clickedID = this.id.split('-');
			var cfID = clickedID[1];
			var postValCC = 'cfEditCC';
			var postValCT = 'cfEditCT';
			var courseCode = $('#editCourseCf-'+cfID).text();
			var courseTitle = $('#editCourseTf-'+cfID).text();

			$('#cfLoader-'+cfID).fadeIn(100);
			
			$('#editCourseCf-'+cfID).load('course-manager.php', {'subConfig': postValCC, 'courseCode': courseCode,
													'cfID': cfID  }).fadeIn(1000);
			
			$('#editCourseTf-'+cfID).load('course-manager.php', {'subConfig': postValCT,  'courseTitle': courseTitle,
													'cfID': cfID  }).fadeIn(1000);
			
			return false;  

		}); 

		$('body').on('click','.cfUpdate',function(event){  /* update school subject information */
		
			event.stopImmediatePropagation();	
			
			var clickedID = this.id.split('-');
			var cfID = clickedID[1];
			var postValCC = 'cfUpdateCC';
			var postValCT = 'cfUpdateCT';
			var courseCode = $('#cfSubjC-'+cfID).val();
			var courseTitle = $('#cfSubjT-'+cfID).val();

			$('#cfLoader-'+cfID).fadeIn(100);
			
			$('#editCourseCf-'+cfID).load('course-manager.php', {'subConfig': postValCC, 'courseCode': courseCode,
													'cfID': cfID  }).fadeIn(1000);
			
			$('#editCourseTf-'+cfID).load('course-manager.php', {'subConfig': postValCT,  'courseTitle': courseTitle,
													'cfID': cfID  }).fadeIn(1000);
			
			return false;  
		
		}); 

		$('body').on('click','.csEdit',function(event){  /* edit school subject information */
		
			event.stopImmediatePropagation();	
			
			var clickedID = this.id.split('-');
			var csID = clickedID[1];
			var postValCC = 'csEditCC';
			var postValCT = 'csEditCT';
			var courseCode = $('#editCourseCs-'+csID).text();
			var courseTitle = $('#editCourseTs-'+csID).text();

			$('#csLoader-'+csID).fadeIn(100);
			
			$('#editCourseCs-'+csID).load('course-manager.php', {'subConfig': postValCC, 'courseCode': courseCode,
													'csID': csID  }).fadeIn(1000);
			
			$('#editCourseTs-'+csID).load('course-manager.php', {'subConfig': postValCT,  'courseTitle': courseTitle,
													'csID': csID  }).fadeIn(1000);
			
			return false;  
		
		}); 

		$('body').on('click','.csUpdate',function(event){  /* update school subject information */
		
			event.stopImmediatePropagation();	
			
			var clickedID = this.id.split('-');
			var csID = clickedID[1];
			var postValCC = 'csUpdateCC';
			var postValCT = 'csUpdateCT';
			var courseCode = $('#csSubjC-'+csID).val();
			var courseTitle = $('#csSubjT-'+csID).val();

			$('#csLoader-'+csID).fadeIn(100);
			
			$('#editCourseCs-'+csID).load('course-manager.php', {'subConfig': postValCC, 'courseCode': courseCode,
													'csID': csID  }).fadeIn(1000);
			
			$('#editCourseTs-'+csID).load('course-manager.php', {'subConfig': postValCT,  'courseTitle': courseTitle,
													'csID': csID  }).fadeIn(1000);
			
			return false;  
		
		}); 

		$('body').on('click','.ctEdit',function(event){  /* edit school subject information */
		
			event.stopImmediatePropagation();	
			
			var clickedID = this.id.split('-');
			var ctID = clickedID[1];
			var postValCC = 'ctEditCC';
			var postValCT = 'ctEditCT';
			var courseCode = $('#editCourseCt-'+ctID).text();
			var courseTitle = $('#editCourseTt-'+ctID).text();

			$('#ctLoader-'+ctID).fadeIn(100);
			
			$('#editCourseCt-'+ctID).load('course-manager.php', {'subConfig': postValCC, 'courseCode': courseCode,
													'ctID': ctID  }).fadeIn(1000);
			
			$('#editCourseTt-'+ctID).load('course-manager.php', {'subConfig': postValCT,  'courseTitle': courseTitle,
													'ctID': ctID  }).fadeIn(1000);
			
			return false;  
		
		}); 

		$('body').on('click','.ctUpdate',function(event){  /* update school subject information */
		
			event.stopImmediatePropagation();	
			
			var clickedID = this.id.split('-');
			var ctID = clickedID[1];
			var postValCC = 'ctUpdateCC';
			var postValCT = 'ctUpdateCT';
			var courseCode = $('#ctSubjC-'+ctID).val();
			var courseTitle = $('#ctSubjT-'+ctID).val();

			$('#ctLoader-'+ctID).fadeIn(100);
			
			$('#editCourseCt-'+ctID).load('course-manager.php', {'subConfig': postValCC, 'courseCode': courseCode,
													'ctID': ctID  }).fadeIn(1000);
			
			$('#editCourseTt-'+ctID).load('course-manager.php', {'subConfig': postValCT,  'courseTitle': courseTitle,
													'ctID': ctID  }).fadeIn(1000);
			
			return false;  
		
		}); 


		
		
		$('body').on('click', '#saveSubjects',function(event){  /* save school subject information */
		
			event.stopImmediatePropagation();	
								
			var postVal = 'saveSubj';

			var courseCode = $('#courseCode').val();
			var courseTitle = $('#courseTitle').val();
			var courseStaff = $('#courseStaff').val();
			var courseTerm = $('#courseTerm').val();
			var courseLevel = $('#courseLevel').text();
			
			var fiTermLast = $('#fiTermLast').val();
			var seTermLast = $('#seTermLast').val();
			var thTermLast = $('#thTermLast').val();
			
			//$('#ctLoader-'+ctID).fadeIn(100);
			$('#saveSubjects').fadeOut(100);
			$('#msg-box').load('course-manager.php', {'subConfig': postVal, 'courseCode': courseCode, 'courseTitle':courseTitle, 'courseStaff': courseStaff,
									'courseTerm': courseTerm, 'courseLevel': courseLevel, 'fiTermLast': fiTermLast,
									'seTermLast': seTermLast, 'thTermLast': thTermLast }).fadeIn(1000);
			
			$('#saveSubjects').fadeIn(10000);
			
			
			return false;  
		
		});

		$('body').on('click','.edit-subject',function(event){  /* edit school grade */
		
			event.stopImmediatePropagation();	
			
			var emptyStr = "";
			var courseID = this.id;
			var postVal = 'edit';				
			
			showPageLoader();
			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show(); 
			
			$('#modal-load-div').load('course-manager.php', {'subConfig': postVal, 'courseID': courseID
								}).fadeIn(1000);	 
			
			$('#modal-fobrain').modal('show');					
			
			return false;  

		});  

		$('body').on('click', '#updateSubject',function(event){  /* save school subject information */
		
			event.stopImmediatePropagation();	
								
			var postVal = 'update';

			var courseID = $('#courseID').val();
			var courseCode = $('#courseCode-2').val();
			var courseTitle = $('#courseTitle-2').val();
			var courseStaff = $('#courseStaff-2').val();
			var courseTerm = $('#courseTerm-2').val();
			var courseLevel = $('#courseLevel').text(); 
			
			showPageLoader();

			$('#saveSubjects').fadeOut(100);
			$('#edit-msg').load('course-manager.php', {'subConfig': postVal, 'courseID': courseID, 'courseCode-2': courseCode, 'courseTitle-2':courseTitle, 'courseStaff-2': courseStaff,
									'courseTerm-2': courseTerm, 'courseLevel': courseLevel  }).fadeIn(1000);
			
			$('#saveSubjects').fadeIn(10000);
			
			
			return false;  
		
		});


		

		$('body').on('click', '#refreshSubjsTab',function(event){  /* refresh school subject information */
		
			event.stopImmediatePropagation();	
								
			var postVal = 'saveSubj';

			var courseLevel = $('#courseLevel').text();
			var courseTerm = $('#couTerm').text();
			
			$('#subj-loader').fadeIn(100);
			
			$('#refreshDiv').load('course-reload.php', {'subConfig': postVal, 'courseLevel': courseLevel,
									'courseTerm': courseTerm,}).fadeIn(1000);
			
			
			return false;  
		
		});

		$('body').on('click','.removeSubjInfo',function(event){  /* remove school subject information */

			Swal.fire({
				title: "Are you sure?",
				text: "You won't be able to revert this!",
				icon: "warning",
				html: `
					
					<input type="text" class="form-control"
							name="ad-pass" id="ad-pass" placeholder ="Enter Super Admin Password" />
				`,
				showCancelButton: true,
				confirmButtonColor: "#3085d6",
				cancelButtonColor: "#d33",
				confirmButtonText: "Yes, Delete it!"
			}).then((result) => {
				
				if (result.isConfirmed) { 
					
					$('#subj-loader').fadeIn(100);

					var postVal = 'removeSubj';
					var adminPass = $('#ad-pass').val();  
					
					var courseData = this.id;
					//var clickedID = this.id.split('-');
					//var cfCode = clickedID[5];					
					//var cfTitle = clickedID[6];					
					//var cfSubjInfo = 'Subject Code - '+cfCode+' and Title - '+cfTitle;	

					$('#msg-box').load('course-manager.php', {'subConfig': postVal, 'courseData': courseData, 'adminPass' :adminPass
										}).fadeIn(1000);					
					
					
				}
			}); 	 	
		
		});  
		
		$('body').on('change','#chartYears',function(event){  /* load bursary chart */	  
		
			event.stopImmediatePropagation(); 
			
			var emptyStr = "";
			var postVal = 'bursarySumm';				
			
			var chartYear =  $(this).val();
			
			if(chartYear != ""){
				
				showPageLoader();	
				$('#summ-chart-div').html(emptyStr);
				
				$('#summ-chart-div').load('busary-charts.php', {'chartData': postVal, 'chartYear': chartYear
										}).fadeIn(1000);	 hidePageLoader();						
			}
			return false;  
		
		});

		$('body').on('click','#libConfiguration',function(){  /* library configuration */	  
		
			$('#frmlibConfiguration').submit(function(event) {		
				
				showPageLoader();	
		
				event.stopImmediatePropagation();
					
				$.post('library-config.php', $(this).find('select, input').serialize(), function(data) {
					
					$('#msg-box').html(data);	
					//$('html, body').animate({scrollTop:$('#scroll-target').position().top}, 'slow'); 
				
				});
	
				return false;
		
			});	

		}); 

		$('body').on('click','#burConfiguration',function(){  /* save bursary configuration */
		
			$('#frmburConfiguration').submit(function(event) {		
				
				showPageLoader();
		
				event.stopImmediatePropagation();
					
				$.post('bursary-config.php', $(this).find('select, input, textarea').serialize(), function(data) {
					
					$('#msg-box').html(data);	
					//$('html, body').animate({scrollTop:$('#scroll-target').position().top}, 'slow');
				
				});
	
				return false;
		
			});		
		});			

		<?php require ($common_staff_script); ?>
		<?php require ($companionScriptJS); ?> 
 

	</script> 
	<?php }else{ exit; } ?> 