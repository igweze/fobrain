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
	This script load jQuery/Javascript
	------------------------------------------------------------------------*/
     
	if (($_POST['script']) == 'amanda.29.21') { 

?> 

	<script type="text/javascript">

		$(function() {

			$('#preload-wrapper').fadeOut('slow');  
			
			$('body').on('click','#login-btn',function(){ 

				$('.fob-btn-div').fadeOut(100);
				$('.fob-btn-loader').fadeIn(100);

				var frmField = $('#frmLogin');	

				$.ajax('login.php', {
					type: 'POST',  					
					data: frmField.serializeArray(),
					success: function (data, status, xhr) {
						$('#msg-box').append(data);
					},
					error: function (jqXhr, textStatus, errorMessage) {
						$('#msg-box').append('Error: ' + errorMessage);
					}
				}); 

				return false;

			});

			$('body').on('click','#login-btn-free',function(){ 

				$('.fob-btn-div').fadeOut(100);
				$('.fob-btn-loader').fadeIn(100);
				
				var frmField = $('#frmLogin');	

				$.ajax('login-2.php', {
					type: 'POST',  					
					data: frmField.serializeArray(),
					success: function (data, status, xhr) {
						$('#msg-box').append(data);
					},
					error: function (jqXhr, textStatus, errorMessage) {
						$('#msg-box').append('Error: ' + errorMessage);
					}
				}); 

				return false;

			}); 
			
			$('body').on('click','#recoverPass',function(){  /* send password reset link to email */
													
				$('#frmrecoverPass').submit(function(event) {
						
					event.stopImmediatePropagation();
								
					$('.fob-btn-div').fadeOut(100);
					$('.fob-btn-loader').fadeIn(100);
										
					$.post('recovery.php', $(this).find('input, select').serialize(), function(data) {
						
						$("#msg-box").html(data); 
					
					});
					
					return false;
			
				}); 							
								
			});
			
			$('body').on('click','#updatePass',function(){  /* reset password manager */
													
				$('#frmupdatePass').submit(function(event) {
						
					event.stopImmediatePropagation();
								
					$('.fob-btn-div').fadeOut(100);
					$('.fob-btn-loader').fadeIn(100);
										
					$.post('recovery.php', $(this).find('input, select').serialize(), function(data) {
						
						$("#msg-box").html(data); 
					
					});
					
					return false;
			
				}); 							
								
			});

			 
			$('body').on('click','#free-signup',function(){	

				$('.fob-btn-div').fadeOut(100);
				$('.fob-btn-loader').fadeIn(100); 

				var form_data = new FormData($('#frm-sign-up')[0]);

				$.ajax({
					url: 'sign-up-manger.php',
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

			
			$('body').on('click','#save-regis',function(){	

				$('.fob-btn-div-reg').fadeOut(100);
				$('.fob-btn-loader-reg').fadeIn(100); 

				var form_data = new FormData($('#frmsave-regis')[0]);
		 
				$.ajax({
					url: 'registraion-manager.php',
					dataType: 'text',
					cache: false,
					contentType: false,
					processData: false,
					data: form_data,
					type: 'post',
					success: function (response) {
						$('#msg-box-reg').html(response);
					},
					error: function (response) {
						$('#msg-box-reg').html(response);
					}
				});

				return false;

			}); 

			

			$('body').on('change','#school',function(){  /* load school type */
				
				$('#wait_1').show();
				$('#result_1').hide();
				 
				$.get("wiz-dropper.php", {
					func: "school-type",
					school: $('#school').val()					
				}, function(response){
					$('#wait_1, #wait_11').fadeOut(1500);
					$('#result_1').html(response).fadeIn(2000); 
				}); 
				
				return false;
				
			});  

			$('body').on('click','.recoverPass',function(){   /* hide sign in form */									 
						
				$('#frmLogin, #frm-sign-up').fadeOut(300);
				$('#frmrecoverPass').fadeIn(400);			
				
				return false;
							
			});
			
			$('body').on('click','.userSignin',function(){   /* hide password recovery form */									 
						
				$('#frmrecoverPass, #frm-sign-up').fadeOut(300);
				$('#frmLogin').fadeIn(400);
				
				return false;
							
			});
			
			$('body').on('click','.signup',function(){   /* hide password recovery form */									 
						
				$('#frmrecoverPass, #frmLogin').fadeOut(300);
				$('#frm-sign-up').fadeIn(400);
				
				return false;
							
			});
			
			$('body').on('click','.registration',function(){   /* hide password recovery form */									 
				
				showPageLoader();
				
				$('.modal-reg-div').click();
				
				hidePageLoader();
				
				return false;
							
			}); 

			$('body').on('change','#schoolist',function(){    
				
				$('.school-tree').fadeOut(100);

				let $school =  parseInt($(this).val());  

				if($school == ""){
					$('.school-tree').fadeOut(100);
				}else{
					$('.school-tree').fadeIn(5000);
				}

			});  

			$('.fob-select').each(function() {  
				renderSelect($('#'+this.id)); 
			});  	 

		}); 
		
	</script> 
	<?php }else{ exit; } exit;?> 