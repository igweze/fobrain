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
	This script handle busary jQuery/Javascript
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

		define('fobrain', 'igweze');  /* define a check for wrong access of file */
		require 'fobrain-config.php';  /* load fobrain configuration files */	   
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

		$('body').on('change','#chartYears',function(event){  /* load bursary chart */	  
		
			event.stopImmediatePropagation(); 

			$('#wait_chart').show();
			
			var emptyStr = "";
			var postVal = 'bursarySumm';				
			
			var chartYear =  $(this).val();
			
			if(chartYear != ""){ 
			 	
				$('#wait_loader').show();
				$('#summ-chart-div').html(emptyStr);
				
				$('#summ-chart-div').load('busary-charts.php', {'chartData': postVal, 'chartYear': chartYear}).fadeIn(2000);											   
				
				$('#wait_chart').fadeOut(3000);

			}
			return false;  
		
		});
		
		$('body').on('click','#saveFeeC',function(){  /* save fee category */	  
		
			$('#frmsaveFeeC').submit(function(event) {		
				
				showPageLoader();
		
				event.stopImmediatePropagation();
						
				$.post('fee-category.php', $(this).find('select, input').serialize(), function(data) {
					
					$('#msg-box').html(data);	
					//$('html, body').animate({ scrollTop:  $('#msg-box').offset().top - 100 }, 'slow');			
					
				});
	
				return false;
		
			});		
		});
		
		$('body').on('click','.remove-fee-c',function(event){  /* remove fee category */ 
					
			Swal.fire({
				title: "Are you sure?",
				text: "You want to disenable this category. Can be enabled back",
				icon: "warning",
				showCancelButton: true,
				confirmButtonColor: "#3085d6",
				cancelButtonColor: "#d33",
				confirmButtonText: "Yes, Disenable it!"
			}).then((result) => {
				
				if (result.isConfirmed) {
					
					var postVal = 'remove'; 
					var rData = this.id;
				
					showPageLoader();
				
					$('#remove-msg').load('fee-category.php', {'feeCat': postVal, 'rData': rData
										}).fadeIn(1000);	
					
				}
			}); 
			
			return false;		 

		});
		
		$('body').on('click','.edit-fee-c',function(event){  /* edit fee category */
		
			event.stopImmediatePropagation();	
			
			var emptyStr = "";
			var feeCategoryID = this.id;
			var postVal = 'edit';				
			
			showPageLoader();

			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();
			
			$('#modal-load-div').load('fee-category.php', {'feeCat': postVal, 'rData': feeCategoryID}).fadeIn(1000);											   
									
			$('#modal-fobrain').modal('show');					
			
			return false;  
		
		});

		$('body').on('click','.add-fee-c',function(event){  /* edit fee category */
		
			event.stopImmediatePropagation();	
			
			var emptyStr = "";
			var feeCategoryID = this.id;
			var postVal = 'add';				
			
			showPageLoader();

			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();
			
			$('#modal-load-div').load('fee-category.php', {'feeCat': postVal, 'rData': feeCategoryID}).fadeIn(1000);											   
									
			$('#modal-fobrain').modal('show');					
			
			return false;  
		
		});
		
		$('body').on('click','#updateFeeC',function(){  /* update fee category */
		
			$('#frmupdateFeeC').submit(function(event) {		
				
				showPageLoader();
		
				event.stopImmediatePropagation();
						
				$.post('fee-category.php', $(this).find('select, input').serialize(), function(data) {
					
					$('#edit-msg').html(data);	
					$('html, body').animate({ scrollTop:  $('#edit-msg').offset().top - 100 }, 'slow');			
					
				});
	
				return false;
		
			});		
		});
		
		
		$('body').on('click','#saveExpenseC',function(){  /* save expense category */
		
			$('#frmsaveExpenseC').submit(function(event) {		
				
				showPageLoader();	
		
				event.stopImmediatePropagation();
						
				$.post('expense-category.php', $(this).find('select, input').serialize(), function(data) {
					
					$('#msg-box').html(data);	
					//$('html, body').animate({ scrollTop:  $('#msg-box').offset().top - 100 }, 'slow');			
					
				});
	
				return false;
		
			});		
		});
		
		$('body').on('click','.remove-expense-category',function(event){  /* remove expense category */

			Swal.fire({
				title: "Are you sure?",
				text: "You want to disenable this category. Can be enabled back",
				icon: "warning",
				showCancelButton: true,
				confirmButtonColor: "#3085d6",
				cancelButtonColor: "#d33",
				confirmButtonText: "Yes, Disenable it!"
			}).then((result) => {
				
				if (result.isConfirmed) {
					
					var postVal = 'remove';
					var rData = this.id;
				
					showPageLoader();
				
					$('#remove-msg').load('expense-category.php', {'expenseCat': postVal, 'rData': rData
										}).fadeIn(1000);	
					
				}
			}); 
			
			return false;	 
		
		});		 
			
		$('body').on('click','.edit-expense-category',function(event){  /* edit expense category */
		
			event.stopImmediatePropagation();	
			
			var emptyStr = "";
			var expenseCategoryID = this.id;
			var postVal = 'edit';				
			
			showPageLoader();

			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();
			
			$('#modal-load-div').load('expense-category.php', {'expenseCat': postVal, 'rData': expenseCategoryID
									}).fadeIn(1000);	 
			
			$('#modal-fobrain').modal('show');					
			
			return false;  
		
		});

		$('body').on('click','.add-expense-c', function(event){  /* add expense category */
		
			event.stopImmediatePropagation();	
			
			var emptyStr = "";
			var expenseCategoryID = this.id;
			var postVal = 'add';				
			
			showPageLoader();

			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();
			
			$('#modal-load-div').load('expense-category.php', {'expenseCat': postVal, 'rData': expenseCategoryID
									}).fadeIn(1000);	 
			
			$('#modal-fobrain').modal('show');					
			
			return false;  
		
		});
		
		$('body').on('click','#updateExpenseC',function(){  /* update expense category */
		
			$('#frmupdateExpenseC').submit(function(event) {		
				
				showPageLoader();	
		
				event.stopImmediatePropagation();
						
				$.post('expense-category.php', $(this).find('select, input').serialize(), function(data) {
					
					$('#edit-msg').html(data);	
					//$('html, body').animate({ scrollTop:  $('#edit-msg').offset().top - 100 }, 'slow');			
					
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
		
		$('body').on('click','#save-bankacc',function(){  /* save acc category */	  
		
			$('#frmsave-bankacc').submit(function(event) {		
				
				showPageLoader();
		
				event.stopImmediatePropagation();
						
				$.post('bank-accounts.php', $(this).find('select, input, textarea').serialize(), function(data) {
					
					$('#msg-box').html(data);	
					//$('html, body').animate({ scrollTop:  $('#msg-box').offset().top - 100 }, 'slow');			
					
				});
	
				return false;
		
			});		
		});
		
		$('body').on('click','.remove-acc-c',function(event){  /* remove acc category */ 
					
			Swal.fire({
				title: "Are you sure?",
				text: "You want to disenable this category. Can be enabled back",
				icon: "warning",
				showCancelButton: true,
				confirmButtonColor: "#3085d6",
				cancelButtonColor: "#d33",
				confirmButtonText: "Yes, Disenable it!"
			}).then((result) => {
				
				if (result.isConfirmed) {
					
					var postVal = 'remove'; 
					var rData = this.id;
				
					showPageLoader();
				
					$('#remove-msg').load('bank-accounts.php', {'query': postVal, 'rData': rData
										}).fadeIn(1000);	
					
				}
			}); 
			
			return false;		 

		});
		
		$('body').on('click','.edit-acc-c',function(event){  /* edit acc category */
		
			event.stopImmediatePropagation();	
			
			var emptyStr = "";
			var bankAccountID = this.id;
			var postVal = 'edit';				
			
			showPageLoader();

			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();
			
			$('#modal-load-div').load('bank-accounts.php', {'query': postVal, 'rData': bankAccountID}).fadeIn(1000);											   
									
			$('#modal-fobrain').modal('show');					
			
			return false;  
		
		});

		$('body').on('click','.add-acc-c',function(event){  /* edit acc category */
		
			event.stopImmediatePropagation();	
			
			var emptyStr = "";
			var bankAccountID = this.id;
			var postVal = 'add';				
			
			showPageLoader();

			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();
			
			$('#modal-load-div').load('bank-accounts.php', {'query': postVal, 'rData': bankAccountID}).fadeIn(1000);											   
									
			$('#modal-fobrain').modal('show');					
			
			return false;  
		
		});
		
		$('body').on('click','#update-bankacc',function(){  /* update acc category */
		
			$('#frmupdate-bankacc').submit(function(event) {		
				
				showPageLoader();
		
				event.stopImmediatePropagation();
						
				$.post('bank-accounts.php', $(this).find('select, input, textarea').serialize(), function(data) {
					
					$('#edit-msg').html(data);	
					$('html, body').animate({ scrollTop:  $('#edit-msg').offset().top - 100 }, 'slow');			
					
				});
	
				return false;
		
			});		
		});

		$('body').on('click','#save-chartacc',function(){  /* save acc category */	  
		
			$('#frmsave-chartacc').submit(function(event) {		
				
				showPageLoader();
		
				event.stopImmediatePropagation();
						
				$.post('chart-accounts.php', $(this).find('select, input, textarea').serialize(), function(data) {
					
					$('#msg-box').html(data);	
					//$('html, body').animate({ scrollTop:  $('#msg-box').offset().top - 100 }, 'slow');			
					
				});
	
				return false;
		
			});		
		});
		
		$('body').on('click','.remove-chart-acc',function(event){  /* remove acc category */ 
					
			Swal.fire({
				title: "Are you sure?",
				text: "You want to disenable this category. Can be enabled back",
				icon: "warning",
				showCancelButton: true,
				confirmButtonColor: "#3085d6",
				cancelButtonColor: "#d33",
				confirmButtonText: "Yes, Disenable it!"
			}).then((result) => {
				
				if (result.isConfirmed) {
					
					var postVal = 'remove'; 
					var rData = this.id;
				
					showPageLoader();
				
					$('#remove-msg').load('chart-accounts.php', {'query': postVal, 'rData': rData
										}).fadeIn(1000);	
					
				}
			}); 
			
			return false;		 

		});
		
		$('body').on('click','.edit-chart-acc',function(event){  /* edit acc category */
		
			event.stopImmediatePropagation();	
			
			var emptyStr = "";
			var chartAccountID = this.id;
			var postVal = 'edit';				
			
			showPageLoader();

			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();
			
			$('#modal-load-div').load('chart-accounts.php', {'query': postVal, 'rData': chartAccountID}).fadeIn(1000);											   
									
			$('#modal-fobrain').modal('show');					
			
			return false;  
		
		});

		$('body').on('click','.add-chart-acc',function(event){  /* edit acc category */
		
			event.stopImmediatePropagation();	
			
			var emptyStr = "";
			var chartAccountID = this.id;
			var postVal = 'add';				
			
			showPageLoader();

			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();
			
			$('#modal-load-div').load('chart-accounts.php', {'query': postVal, 'rData': chartAccountID}).fadeIn(1000);											   
									
			$('#modal-fobrain').modal('show');					
			
			return false;  
		
		});
		
		$('body').on('click','#update-chartacc',function(){  /* update acc category */
		
			$('#frmupdate-chartacc').submit(function(event) {		
				
				showPageLoader();
		
				event.stopImmediatePropagation();
						
				$.post('chart-accounts.php', $(this).find('select, input, textarea').serialize(), function(data) {
					
					$('#edit-msg').html(data);	
					$('html, body').animate({ scrollTop:  $('#edit-msg').offset().top - 100 }, 'slow');			
					
				});
	
				return false;
		
			});	

		});

		$('body').on('click','#save-journal',function(){  /* save acc category */	  
		
			$('#frmsave-journal').submit(function(event) {		
				
				showPageLoader();
		
				event.stopImmediatePropagation();
						
				$.post('journal-chart-single.php', $(this).find('select, input, textarea').serialize(), function(data) {
					
					$('#msg-box').html(data);	
					//$('html, body').animate({ scrollTop:  $('#msg-box').offset().top - 100 }, 'slow');			
					
				});
	
				return false;
		
			});		
		});
		
		$('body').on('click','.remove-journal',function(event){  /* remove acc category */ 
					
			Swal.fire({
				title: "Are you sure?",
				text: "You want to disenable this journal. Can be enabled back",
				icon: "warning",
				showCancelButton: true,
				confirmButtonColor: "#3085d6",
				cancelButtonColor: "#d33",
				confirmButtonText: "Yes, Disenable it!"
			}).then((result) => {
				
				if (result.isConfirmed) {
					
					var postVal = 'remove'; 
					var rData = this.id;
				
					showPageLoader();
				
					$('#remove-msg').load('journal-chart.php', {'query': postVal, 'rData': rData
										}).fadeIn(1000);	
					
				}
			}); 
			
			return false;		 

		});
		
		$('body').on('click','.edit-journal',function(event){  /* edit acc category */
		
			event.stopImmediatePropagation();	
			
			var emptyStr = "";
			var bankAccountID = this.id;
			var postVal = 'edit';				
			
			showPageLoader();

			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();
			
			$('#modal-load-div').load('journal-chart.php', {'query': postVal, 'rData': bankAccountID}).fadeIn(1000);											   
									
			$('#modal-fobrain').modal('show');					
			
			return false;  
		
		});

		$('body').on('click','.add-journal',function(event){  /* edit acc category */
		
			event.stopImmediatePropagation();	
			
			var emptyStr = "";
			var bankAccountID = this.id;
			var postVal = 'add';				
			
			showPageLoader();

			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();
			
			$('#modal-load-div').load('journal-chart.php', {'query': postVal, 'rData': bankAccountID}).fadeIn(1000);											   
									
			$('#modal-fobrain').modal('show');					
			
			return false;  
		
		});

		$('body').on('click','.add-journal-single',function(event){  /* edit acc category */
		
			event.stopImmediatePropagation();	
			
			var emptyStr = "";
			var bankAccountID = this.id;
			var postVal = 'add';				
			
			showPageLoader();

			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();
			
			$('#modal-load-div').load('journal-chart-single.php', {'query': postVal, 'rData': bankAccountID}).fadeIn(1000);											   
									
			$('#modal-fobrain').modal('show');					
			
			return false;  
		
		});

		$('body').on('click','.edit-journal-single',function(event){  /* edit acc category */
		
			event.stopImmediatePropagation();	
			
			var emptyStr = "";
			var bankAccountID = this.id;
			var postVal = 'edit';				
			
			showPageLoader();

			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();
			
			$('#modal-load-div').load('journal-chart-single.php', {'query': postVal, 'rData': bankAccountID}).fadeIn(1000);											   
									
			$('#modal-fobrain').modal('show');					
			
			return false;  
		
		});

		
		$('body').on('click','#update-journal',function(){  /* update acc category */
		
			$('#frmupdate-journal').submit(function(event) {		
				
				showPageLoader();
		
				event.stopImmediatePropagation();
						
				$.post('journal-chart-single.php', $(this).find('select, input, textarea').serialize(), function(data) {
					
					$('#edit-msg').html(data);	
					$('html, body').animate({ scrollTop:  $('#edit-msg').offset().top - 100 }, 'slow');			
					
				});
	
				return false;
		
			});		
		});


		$('body').on('click','#saveFees-qq',function(){  /* save fees */
		
			$('#frmsaveFees').submit(function(event) {		
				
				showPageLoader();	
		
				event.stopImmediatePropagation();
						
				$.post('payment-manager.php', $(this).find('select, input, textarea, file').serialize(), function(data) {
					
					$('#msg-box').html(data);	
					$('html, body').animate({ scrollTop:  $('#msg-box').offset().top - 50 }, 'slow');			
					
				});
	
				return false;
		
			});

		});

		$('body').on('click','#saveFees',function(){  /* save fees */ 

			showPageLoader();

			var form_data = new FormData($('#frmsaveFees')[0]);

			$.ajax({
				url: 'payment-manager.php',
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
		
		$('body').on('click','.view-payment',function(event){  /* view fees */
		
			event.stopImmediatePropagation();	
			
			var emptyStr = "";
			var feesID = this.id;
			var postVal = 'view';				
			
			showPageLoader();
			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();
			
			$('#modal-load-div').load('payment-manager.php', {'payment': postVal, 'rData': feesID
								}).fadeIn(1000);										   
									
			$('#modal-fobrain').modal('show');					
			
			return false;  
		
		});
		
		$('body').on('click','.remove-payment',function(event){  /* remove fees */ 

			Swal.fire({
				title: "Are you sure?",
				text: "You won't be able to revert this!",
				icon: "warning",
				html: ` 
					<input type="text" class="form-control"
							name="ad-pass" id="ad-pass" placeholder ="Enter Admin Password" />
				`,
				showCancelButton: true,
				confirmButtonColor: "#3085d6",
				cancelButtonColor: "#d33",
				confirmButtonText: "Yes, Delete it!"
			}).then((result) => {
				
				if (result.isConfirmed) {
					
					var postVal = 'remove';
					var rData = this.id;
					var adminPass = $('#ad-pass').val();
				
					showPageLoader();
				
					$('#remove-msg').load('payment-manager.php', {'payment': postVal, 'rData': rData, 'admin':adminPass
										}).fadeIn(1000);	
					
				}
			}); 
			
			return false;	  
		
		});			 

		$('body').on('click','.edit-payment',function(event){  /* edit fees */
		
			event.stopImmediatePropagation();	
			
			var emptyStr = "";
			var feesID = this.id;
			var postVal = 'edit';				
			
			showPageLoader();
			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();
			
			$('#modal-load-div').load('payment-manager.php', { 'payment': postVal, 'rData': feesID
									}).fadeIn(1000);											   
									
			
			$('#modal-fobrain').modal('show');					
			
			return false;  
		
		});
		
		
		$('body').on('click','.complete-payment',function(event){  /* edit fees */
		
			event.stopImmediatePropagation();	
			
			var emptyStr = "";
			var feesID = this.id;
			var postVal = 'balance';				
			
			showPageLoader();
			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();
			
			$('#modal-load-div').load('payment-manager.php', { 'payment': postVal, 'rData': feesID
									}).fadeIn(1000);											   
									
			
			$('#modal-fobrain').modal('show');					
			
			return false;  
		
		});
		
		$('body').on('click','.add-payment',function(event){  /* edit fees */
		
			event.stopImmediatePropagation();	
			
			var emptyStr = "";
			var postVal = 'add';
			var thisID = this.id; 
			
			let querytp = $(this).attr("data-code"); 
			
			showPageLoader();
			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();
			
			$('#modal-load-div').load('payment-manager.php', { 'payment': postVal, 'querytp': querytp
									}).fadeIn(1000);											   
									
			
			$('#modal-fobrain').modal('show');					
			
			return false;  
		
		});	

		$('body').on('click','.appr-decline-fee',function(event){  /* edit fees */
		
			event.stopImmediatePropagation();	
			
			var emptyStr = "";
			var feesID = this.id;
			var postVal = 'appr-decline';				
			
			showPageLoader();
			$('#edit-msg').html(emptyStr);	
			
			
			$('#edit-msg').load('payment-manager.php', { 'payment': postVal, 'rData': feesID
									}).fadeIn(1000);											   
									
			
			$('#modal-fobrain').modal('show');					
			
			return false;  
		
		});	
		
		$('body').on('click','#updatePayment-qq',function(){  /* update fees */
		
			$('#frmupdatePayment').submit(function(event) {		
				
				showPageLoader();
		
				event.stopImmediatePropagation();
						
				$.post('payment-manager.php', $(this).find('select, input, textarea, file').serialize(), function(data) {
					
					$('#edit-msg').html(data);	
					$('html, body').animate({ scrollTop:  $('#edit-msg').offset().top - 30 }, 'slow');			
					
				});
	
				return false;
		
			});		

		});

		$('body').on('click','#updatePayment',function(){  /* save fees */  

			showPageLoader();

			var form_data = new FormData($('#frmupdatePayment')[0]);

			$.ajax({
				url: 'payment-manager.php',
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
		
		$('body').on('click','#updateBalance',function(){  /* save fees */  

			showPageLoader();

			var form_data = new FormData($('#frmupdateBalance')[0]);

			$.ajax({
				url: 'payment-manager.php',
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
		
		$('body').on('click','#saveExpenses',function(){  /* save expenses */
		
			$('#frmsaveExpenses').submit(function(event) {		
				
				showPageLoader();
		
				event.stopImmediatePropagation();
						
				$.post('expenses-manager.php', $(this).find('select, input, textarea').serialize(), function(data) {
					
					$('#msg-box').html(data);	
					$('html, body').animate({ scrollTop:  $('#msg-box').offset().top - 50 }, 'slow');			
					
				});
	
				return false;
		
			});		
		});
		
		$('body').on('click','.view-expense',function(event){  /* view expenses */
		
			event.stopImmediatePropagation();	
			
			var emptyStr = "";
			var expensesID = this.id;
			var postVal = 'view';				
			
			showPageLoader();
			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();
			
			$('#modal-load-div').load('expenses-manager.php', {'query': postVal, 'rData': expensesID
									}).fadeIn(1000);										   
									
			$('#modal-fobrain').modal('show');					
			
			return false;  
		
		});

		$('body').on('click','.view-expense2',function(event){  /* edit expenses */
		
			event.stopImmediatePropagation();	
			
			var emptyStr = "";
			var expensesID = this.id;
			var postVal = 'edit';				
			
			//showPageLoader();

			$('#edit-msg-2').html(emptyStr);	
			$('#modal-load-div-2').show();
			
			$('#modal-load-div-2').load('expense-view2.php', {'query': postVal, 'rData': expensesID
									}).fadeIn(1000);	 
			
			$('#modal-fobrain-2').modal('show');					
			
			return false;  
		
		});
		
		$('body').on('click','.remove-expense',function(event){  /* remove expenses */
		
			Swal.fire({
				title: "Are you sure?",
				text: "You won't be able to revert this!",
				icon: "warning",
				html: `					
					<input type="text" class="form-control"
							name="ad-pass" id="ad-pass" placeholder ="Enter Admin Password" />
				`,
				showCancelButton: true,
				confirmButtonColor: "#3085d6",
				cancelButtonColor: "#d33",
				confirmButtonText: "Yes, Delete it!"
			}).then((result) => {
				
				if (result.isConfirmed) {
					
					var postVal = 'remove';
					var rData = this.id;
					var adminPass = $('#ad-pass').val(); 
				
					//showPageLoader();
				
					$('#remove-msg').load('expenses-manager.php', {'query': postVal, 'rData': rData, 'adminPass' :adminPass
										}).fadeIn(1000);	
					
				}
			}); 
			
			return false; 
		
		}); 

		$('body').on('click','.rem-expense-doc',function(event){ /* delete upload picture  */

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
					
					var clickedID = this.id; 
					var postVal = 'remove'; 
					var postVal2 = 'count';
					var pid = $('#pid').val();

					$('.upload').hide();
					$('.upload-loader').fadeIn(100);
					
					$('.refresh').load('expense-uploader.php', { 'pid':pid, 'query': postVal, 'doc': clickedID  });
					$('.refresh').load('expense-uploader.php', { 'query': postVal2, 'pid': pid });
					$('.upload-loader').fadeOut(1000);
					$('.upload').show(); 
					
					Swal.fire({
						title: "Deleted!",
						text: "Your picture has been deleted.",
						icon: "success"
					});
				}
			});  

			return false;  

		});

		
		$('body').on('click','.add-expense',function(event){  /* edit expenses */
		
			event.stopImmediatePropagation();	
			
			var emptyStr = "";
		 
			var postVal = 'add'; 
			var thisID = this.id; 
			
			let querytp = $(this).attr("data-code"); 
			
			showPageLoader();

			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();
			
			$('#modal-load-div').load('expense-create.php', {'query': postVal, 'querytp': querytp
									}).fadeIn(1000);	 
			
			$('#modal-fobrain').modal('show');					
			
			return false;  
		
		});
		
		$('body').on('click','.edit-expense',function(event){  /* edit expenses */
		
			event.stopImmediatePropagation();	
			
			var emptyStr = "";
			var expensesID = this.id;
			var postVal = 'edit';				
			
			showPageLoader();

			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();
			
			$('#modal-load-div').load('expense-edit.php', {'query': postVal, 'rData': expensesID
									}).fadeIn(1000);	 
			
			$('#modal-fobrain').modal('show');					
			
			return false;  
		
		}); 
		 
		
		$('body').on('click','#updateExpenses',function(){  /* update expenses */
		
			$('#frmupdateExpenses').submit(function(event) {		
				
				showPageLoader();
		
				event.stopImmediatePropagation();
						
				$.post('expenses-manager.php', $(this).find('select, input, textarea').serialize(), function(data) {
					
					$('#edit-msg').html(data);	
					$('html, body').animate({ scrollTop:  $('#edit-msg').offset().top - 30 }, 'slow');			
					
				});
	
				return false;
		
			});		
		}); 

		$('body').on('click','#saveProductCategory',function(){  /* save product category */
		
			$('#frmsaveProductCategory').submit(function(event) {		
				
				showPageLoader();	
		
				event.stopImmediatePropagation();
						
				$.post('item-category-manager.php', $(this).find('select, input').serialize(), function(data) {
					
					$('#msg-box').html(data);	
					$('html, body').animate({ scrollTop:  $('#msg-box').offset().top - 100 }, 'slow');			
					
				});
	
				return false;
		
			});		
		});
		
		$('body').on('click','.remove-product-category',function(event){  /* remove product category */
		
			Swal.fire({
				title: "Are you sure?",
				text: "You want to disenable this category. Can be enabled back",
				icon: "warning",
				showCancelButton: true,
				confirmButtonColor: "#3085d6",
				cancelButtonColor: "#d33",
				confirmButtonText: "Yes, Disenable it!"
			}).then((result) => {
				
				if (result.isConfirmed) {
					
					var postVal = 'remove';
					var rData = this.id;
				
					showPageLoader();
				
					$('#remove-msg').load('item-category-manager.php', {'productCat': postVal, 'rData': rData
										}).fadeIn(1000);	
					
				}
				
			}); 
			
			return false; 
		
		}); 
		
		$('body').on('click','.edit-product-category',function(event){  /* edit product category */
		
			event.stopImmediatePropagation();	
			
			var emptyStr = "";
			var productCategoryID = this.id;
			var postVal = 'edit';				
			
			showPageLoader();
			
			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();
			
			$('#modal-load-div').load('item-category-manager.php', {'productCat': postVal, 'rData': productCategoryID
									}).fadeIn(1000);											   
									
			$('#modal-fobrain').modal('show');					
			
			return false;  
		
		});

		$('body').on('click','.add-product-category',function(event){  /* edit product category */
		
			event.stopImmediatePropagation();	
			
			var emptyStr = "";
			var productCategoryID = this.id;
			var postVal = 'add';				
			
			showPageLoader();
			
			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();
			
			$('#modal-load-div').load('item-category-manager.php', {'productCat': postVal, 'rData': productCategoryID
									}).fadeIn(1000);											   
									
			$('#modal-fobrain').modal('show');					
			
			return false;  
		
		});
		
		$('body').on('click','#updateProductCategory',function(){  /* update product category */
		
			$('#frmupdateProductCategory').submit(function(event) {		
				
				$('#editLoader').fadeIn(100);	
		
				event.stopImmediatePropagation();
						
				$.post('item-category-manager.php', $(this).find('select, input').serialize(), function(data) {
					
					$('#edit-msg').html(data);	
					$('html, body').animate({ scrollTop:  $('#edit-msg').offset().top - 30 }, 'slow');			
					
				});
	
				return false;
		
			});		
		}); 

		$('body').on('click','#saveProducts',function(){  /* save product */
		
			$('#frmsaveProducts').submit(function(event) {		
				
				showPageLoader();
		
				event.stopImmediatePropagation();
						
				$.post('product-manager.php', $(this).find('select, input, textarea').serialize(), function(data) {
					
					$('#msg-box').html(data);	
					$('html, body').animate({ scrollTop:  $('#msg-box').offset().top - 10 }, 'slow');			
					
				});
	
				return false;
		
			});		
		});
		
		$('body').on('click','.view-product',function(event){  /* view product */
		
			event.stopImmediatePropagation();	
			
			var emptyStr = "";
			var productsID = this.id;
			var postVal = 'view';				
			
			showPageLoader();

			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();
			
			$('#modal-load-div').load('product-manager.php', {'product': postVal, 'rData': productsID
									}).fadeIn(1000);	
			
			$('#modal-fobrain').modal('show');					
			
			return false;  
		
		});
		
		$('body').on('click','.remove-product',function(event){  /* remove product */
		
			Swal.fire({
				title: "Are you sure?",
				text: "You won't be able to revert this!",
				icon: "warning",
				html: ` 
					<input type="text" class="form-control"
							name="ad-pass" id="ad-pass" placeholder ="Enter Admin Password" />
				`,
				showCancelButton: true,
				confirmButtonColor: "#3085d6",
				cancelButtonColor: "#d33",
				confirmButtonText: "Yes, Delete it!"
			}).then((result) => {
				
				if (result.isConfirmed) {
					
					var postVal = 'remove';
					var rData = this.id;
					var adminPass = $('#ad-pass').val();
				
					showPageLoader();
				
					$('#remove-msg').load('product-manager.php', {'payment': postVal, 'rData': rData, 'adminPass' :adminPass
										}).fadeIn(1000);	
					
				}
			}); 
			
			return false;  
		
		}); 
			
		$('body').on('click','.add-product',function(event){  /* edit product */
		
			event.stopImmediatePropagation();	
			
			var emptyStr = "";
			var productsID = this.id;
			var postVal = 'add';				
			
			showPageLoader();
			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();
			
			$('#modal-load-div').load('product-manager.php', {'product': postVal, 'rData': productsID
									}).fadeIn(1000);	 
			
			$('#modal-fobrain').modal('show');					
			
			return false;  
		
		}); 

		$('body').on('click','.edit-product',function(event){  /* edit product */
		
			event.stopImmediatePropagation();	
			
			var emptyStr = "";
			var productsID = this.id;
			var postVal = 'edit';				
			
			showPageLoader();
			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();
			
			$('#modal-load-div').load('product-manager.php', {'product': postVal, 'rData': productsID
									}).fadeIn(1000);	 
			
			$('#modal-fobrain').modal('show');					
			
			return false;  
		
		}); 
		
		$('body').on('click','#updateProducts',function(){  /* update product */
		
			$('#frmupdateProducts').submit(function(event) {		
				
				showPageLoader();
		
				event.stopImmediatePropagation();
						
				$.post('product-manager.php', $(this).find('select, input, textarea').serialize(), function(data) {
					
					$('#edit-msg').html(data);	
					$('html, body').animate({ scrollTop:  $('#edit-msg').offset().top - 30 }, 'slow');			
					
				});
	
				return false;
		
			});		
		});

		$('body').on('change','#productPic',function(){  /* save fees */ 

			showPageLoader(); 

			var form_data = new FormData($('#frmproductPic')[0]);

			$.ajax({
				url: 'product-manager.php',
				dataType: 'text',
				cache: false,
				contentType: false,
				processData: false,
				data: form_data,
				type: 'post',
				success: function (response) {
					$('#msg-box-pic').html(response); 
				},
				error: function (response) {
					$('#msg-box-pic').html(response);
				}
			});

			return false;

		});  
		
		$('body').on('click','.remProductPic',function(event){  /* remove product picture */
		
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
					var pictureID = clickedID[1];
					
					$("#save-loader").fadeIn(100);
					var pData = "remove-pic";
					$('#edit-msg').load('product-manager.php', {'product': pData, 'pictureID': pictureID }).fadeIn(1000);	
					
				}
			}); 
			
			return false;  
		
		}); 
		
		$('body').on('click','.view-transaction',function(event){  /* view transaction */
		
			event.stopImmediatePropagation();	
			
			var emptyStr = "";
			var transID = this.id;
			var transData = 'viewOrder';				
			
			showPageLoader();
			$('#edit-msg').html(emptyStr);	
			$('#transactionDiv').show();
			$('.slideTransaction').show();
			
			$('#modal-load-div').load('sale-details.php', {'transData': transData, 'transID': transID
									}).fadeIn(1000);											   
			
			$('#modal-fobrain').modal('show');	 		
			
			return false;  
		
		}); 
		
		$('body').on('change','#tranStatus',function(){  /* transaction status */	
							
			$('.wiz-glower').fadeIn(100);
			
			var transData = 'tranStatus';
			var status = $('#tranStatus').val();
			var transID = $('#transID').val(); 
			var account_1 = $('#chart_account1').val().split('#fob#'); 
			var account_2 = $('#chart_account2').val().split('#fob#');

			var account1 = account_1[0];
			var account2 = account_2[0];

			$('#edit-msg').load('sale-details.php', {'transData': transData, 'transID': transID, 'status' :status,  account1:account1, account2:account2,
									}).fadeIn(1000);											   
									
								
			return false;   
		
		});  
		 

		$('body').on('click','#savePayroll',function(){  /* save payroll*/ 

			showPageLoader();

			var form_data = new FormData($('#frmsavePayroll')[0]);

			$.ajax({
				url: 'payroll-manager.php',
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
									
			$('#modal-fobrain').modal('show');					
			
			return false;  
		
		});

		$('body').on('click','.view-payroll-m',function(event){  /* view payroll multiple */
		
			event.stopImmediatePropagation();	
			
			var emptyStr = "";
			var payrollID = this.id;
			var postVal = 'view';				
			
			showPageLoader();
			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();
			
			$('#modal-load-div').load('payroll-wizard.php', {'payroll': postVal, 'rData': payrollID
								}).fadeIn(1000);										   
									
			$('#modal-fobrain').modal('show');					
			
			return false;  
		
		});
		
		$('body').on('click','.remove-payroll',function(event){  /* remove payroll */ 

			Swal.fire({
				title: "Are you sure?",
				text: "You won't be able to revert this!",
				icon: "warning",
				html: ` 
					<input type="text" class="form-control"
							name="ad-pass" id="ad-pass" placeholder ="Enter Admin Password" />
				`,
				showCancelButton: true,
				confirmButtonColor: "#3085d6",
				cancelButtonColor: "#d33",
				confirmButtonText: "Yes, Delete it!"
			}).then((result) => {
				
				if (result.isConfirmed) {
					
					var postVal = 'remove';
					var rData = this.id;
					var adminPass = $('#ad-pass').val();
				
					showPageLoader();
				
					$('#remove-msg').load('payroll-manager.php', {'payroll': postVal, 'rData': rData, 'adminPass' :adminPass
										}).fadeIn(1000);	
					
				}
			}); 
			
			return false;	  
		
		});			 

		$('body').on('click','.edit-payroll',function(event){  /* edit payroll */
		
			event.stopImmediatePropagation();	
			
			var emptyStr = "";
			var payrollID = this.id;
			var postVal = 'edit';				
			
			showPageLoader();
			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();
			
			$('#modal-load-div').load('payroll-manager.php', { 'payroll': postVal, 'rData': payrollID
									}).fadeIn(1000);											   
									
			
			$('#modal-fobrain').modal('show');					
			
			return false;  
		
		});	
		
		
		$('body').on('click','.add-payroll',function(event){  /* edit payroll */
		
			event.stopImmediatePropagation();	
			
			var emptyStr = ""; 
			var postVal = 'add';	 
			var thisID = this.id; 
			
			let querytp = $(this).attr("data-code");
			
			showPageLoader();
			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();
			
			$('#modal-load-div').load('payroll-manager.php', { 'payroll': postVal, 'querytp': querytp
									}).fadeIn(1000);											   
									
			
			$('#modal-fobrain').modal('show');					
			
			return false;  
		
		});	 
		
		$('body').on('click','#updatePayroll',function(){  /* save payroll*/ 

			showPageLoader();

			var form_data = new FormData($('#frmupdatePayroll')[0]);

			$.ajax({
				url: 'payroll-manager.php',
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

		$('body').on('change','#upload-expense',function(){ /* change wall picture */

			$(".upload-loader").show();
			$(".upload-expense-div").hide(); 

			var form_data = new FormData($('#frmExpenseUpload')[0]);

			var postVal = 'count';
			var pid = $('#pid').val(); 

			$.ajax({
				url: 'expense-uploader.php',
				dataType: 'text',
				cache: false,
				contentType: false,
				processData: false,
				data: form_data,
				type: 'post',
				success: function (response) {
					$('#preview-upload').append(response); 
					$(".upload-loader").hide();
					$(".upload-expense-div").show(); 
					$('.refresh').load('expense-uploader.php', { 'query': postVal, 'pid': pid });
					$("#upload-expense").val('');
				},
				error: function (response) {
					$('#preview-upload').append(response);
					$(".upload-loader").hide();
					$(".upload-expense-div").show(); 
					$("#upload-expense").val('');
				}
			});

			return false;

		});

		$('body').on('change','.chart-autofill',function(){ 

			let $target = $(this).attr("data-code");
			let $input = $(this).val(); 

			$("."+$target).text($input);  
			
			return false;
			
		});

		$('body').on('keyup','.chart-autofill-1',function(){ 

			let $target = $(this).attr("data-code");
			let $input = $(this).val(); 

			$("."+$target).text($input);  
			
			return false;
			
		});

		$('body').on('change','.chart-autofill-2',function(){ 

			let $target = $(this).attr("data-code");
			let $input_arr = $(this).val().split('#fob#'); 

			let $input = $input_arr[1];

			$("."+$target).text($input);  
			
			return false;
			
		}); 

		$('body').on('keyup','.chart-autofill-3',function(){ 

			let $target = $(this).attr("data-code");
			let $input = $(this).val(); 

			$("."+$target).val($input);  
			
			return false;
			
		});
			
		$('body').on('click','.show-hide-btn',function(event){  /* show/hide button */
		
			event.stopImmediatePropagation();		
			
			$('#showHideCols').click();
			$('.show-hide-btn').toggle();
			
			return false;
		
		}); 

		$('body').on('change','#bank_acc',function(){  /* load expense category */
		
			//$('#result').hide();	
			$('#wait_bal').show();
			$.get("wizg-dropper.php", {
				drop: "balance",
				bid: $('#bank_acc').val()
			}, function(response){ 
			
				$('#wait_bal').fadeOut(1500);
				$('#balance_div').html(response).fadeIn(2000); 
				
			});
		
			return false;

		});

		$('body').on('change','#feeCat',function(){  /* load fee category */
		
			$('#result_1, #result_11, #feeDetailsDiv, #feeDetailsDivTop').hide();	
			$('#wait').show();
			$("#schoolType").val("");
			$("#amountPaid").val("");
			$.get("wizg-dropper.php", {
				drop: "drop-fee-div",
				feeCatID: $('#feeCat').val()
			}, function(response){ 
				
				$('#wait').fadeOut(1500);
				$('#result').html(response).fadeIn(2000); 
			
			});
		
			return false;
			
		});
		
		$('body').on('change','#expenseCat',function(){  /* load expense category */
		
			$('#result_1, #expenseDetailsDiv').hide();	
			$('#wait').show();
			$.get("wizg-dropper.php", {
				drop: "drop-exp-div",
				eCatID: $('#expenseCat').val()
			}, function(response){ 
			
				$('#wait').fadeOut(1500);
				$('#result').html(response).fadeIn(2000); 
				
			});
		
			return false;

		});
		
		$('body').on('change','#pCategory',function(){  /* load product category */
		
			$('#result_1, #productDetailsDiv').hide();	 
			$('#wait').show();
			$.get("wizg-dropper.php", {
				drop: "drop-cat-div",
				pCatID: $('#pCategory').val()
			}, function(response){ 

				$('#wait').fadeOut(1500);
				$('#result').html(response).fadeIn(2000); 
				
			});
		
			return false;
		});
		
		$('body').on('change','#schoolType',function(){  /* load school type */
		
			$('#result_1, #result_11, #feeDetailsDiv').hide();
			$("#amountPaid").val("");
			$('#wait_1').show();
			$.get("wizg-dropper.php", {
				drop: "schoool-level",
				schoolID: $('#schoolType').val()
			}, function(response){ 
				
				$('#wait_1').fadeOut(1500);
				$('#result_1').html(response).fadeIn(2000); 
				
			});
		
			return false;

		});
		
		$('body').on('change','#cLevel',function(){  /* load school level */

			$('#wait_11').show();
			$('#result_11, #feeDetailsDiv').hide();
				$.get("wizg-dropper.php", {
					drop: "load-students",
					clevelID: $('#cLevel').val()
				}, function(response){ 
					$('#wait_11').fadeOut(1500);
					$('#result_11').html(response).fadeIn(2000); 
				});
	
			return false;

		});  

		/** Journal */

		function saveJournal(){   

			var input_arr = $.map($('#fob-journal-entry>tbody>tr'), function (tr) {
				var $inp = $('input', tr);
				var $select = $('select', tr);
				return {
					account: $select.eq(0).val(),
					debit: $inp.eq(0).val(),
					credit: $inp.eq(1).val(),
				};
			}); 

			var query = "save";
			var pid = 1;//$('#pid').val();
			var title = $('#title').val();
			var jdate = $('#jdate').val(); 
			var amount = $('#amount').val();
			var querytp = 1;//$('#querytp').val();  

			$.ajax('journal-chart.php', {
				type: 'POST',  					
				data: { query:query, pid:pid, title:title, journals:input_arr, jdate:jdate, amount:amount, querytp:querytp},
				success: function (data, status, xhr) {
					$('#msg-box').html(data);
				},
				error: function (jqXhr, textStatus, errorMessage) {
					$('#msg-box').html('Error: ' + errorMessage);
				} 
					
			});  

			return false;

		}

		function updateJournal(){   

			var input_arr = $.map($('#fob-journal-entry>tbody>tr'), function (tr) {
				var $inp = $('input', tr);
				var $select = $('select', tr);
				return {
					account: $select.eq(0).val(),
					jid: $inp.eq(0).val(),
					transid: $inp.eq(1).val(),
				};
			}); 

			var query = "update";
			var transid = $('#transid').val(); 

			$.ajax('journal-chart.php', {
				type: 'POST',  					
				data: { query:query, transid:transid, journals:input_arr},
				success: function (data, status, xhr) {
					$('.msg-box-ref').html(data);
				},
				error: function (jqXhr, textStatus, errorMessage) {
					$('.msg-box-ref').html('Error: ' + errorMessage);
				} 
					
			});  

			return false;

		}


		/** Payroll */

		$('body').on('click','.add-multi-payroll', function(event){  /* multi payroll */
		
			event.stopImmediatePropagation();	
			
			var emptyStr = ""; 
			var postVal = 'add-multi';	 
			var thisID = this.id; 
			
			let querytp = $(this).attr("data-code");
			
			showPageLoader();
			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();
			
			$('#modal-load-div').load('payroll-wizard.php', { 'payroll': postVal, 'querytp': querytp
									}).fadeIn(1000);	 
			
			$('#modal-fobrain').modal('show');					
			
			return false;  
		
		});

		$('body').on('click','.remove-row-payroll', function(event){ 
			
			event.stopImmediatePropagation();	

			Swal.fire({
				title: "Are you sure?",
				text: "Delete this staff payroll",
				icon: "warning",
				showCancelButton: true,
				confirmButtonColor: "#3085d6",
				cancelButtonColor: "#d33",
				confirmButtonText: "Yes, Remove it!"
			}).then((result) => {
				
				if (result.isConfirmed) {

					$(this).parent().parent().remove();
					sumPayroll();
					sumGrandPayroll(); 
					
				}
			}); 
			
		});  
		
		$('body').on('keyup','#salary_taxes',function(){ 

			let $target = "payrow-tax";
			let $input = $(this).val();  

			$(".payrow-tax").val($input);   

			sumPayroll();
			sumGrandPayroll(); 
			
			return false;
			
		});	

		$('body').on('click','#close-payroll',function(){ 

			$('.payroll-wrapper').hide(2000); 

			var elmnt = document.getElementById('#fob-payroll-tb');
			elmnt.scrollIntoView();
			
			return false;
			
		});	

		$('body').on('click','.load-payroll-details',function(event){

			var query = "load";

			var staff_id = this.id.split('-');
			var staff = staff_id[1];  
				
			var tax = $('#tax-'+staff).val(); 
			var salary = $('#salary-'+staff).val(); 
			var nsalary = $('#nsalary-'+staff).val(); 
			var earn = $('#staff-earn-'+staff).val(); 
			var ded = $('#staff-ded-'+staff).val();  

			$.ajax('payroll-wizard.php', {
				type: 'POST',  					
				data: { payroll:query, staff:staff, tax:tax, salary:salary, nsalary:nsalary, earn:earn, ded:ded},
				success: function (data, status, xhr) {
					$('#payroll-wrap').html(data);
					$('.payroll-wrapper').show(2000);	 
					var elmnt = document.getElementById("payroll-wrap");
					elmnt.scrollIntoView();

				},
				error: function (jqXhr, textStatus, errorMessage) {
					$('#msg-box').html('Error: ' + errorMessage);
				}
			}); 

		}); 

		$('body').on('click','#transfer-payroll',function(){  /* insert payroll*/ 

			//showPageLoader();

			var form_data = new FormData($('#frmtransfer-payroll')[0]);

			$.ajax({
				url: 'payroll-wizard.php',
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

		$('body').on('change','#staff-payroll',function(){  /* load fee category */
		
			$('#result, #payroll-div').hide();	
			$('#wait').show();
				
			$.get("wizg-dropper.php", {
				drop: "payroll",
				staff: $('#staff-payroll').val()
			}, function(response){ 
				
			$('#wait').fadeOut(1500);
			$('#payroll-div').fadeIn(2000);
			$('#result').html(response).fadeIn(2000); 
			
			});
		
			return false;
			
		});

		$('body').on('keyup','.salary-des',function(){  
			
			$('.wiz-glower').show();
			
			$clickID = this.id;				
			$title = $('#'+this.id).val(); 
			$('.'+$clickID).text($title);

			$('.wiz-glower').fadeOut(2500);
			
		}); 
		
		
		$('body').on('keyup','.salary-target',function(){    
			payroll();
		});

		$('body').on('keyup','.field-selector',function(){    
			calculateFees();
		}); 

		$('body').on('click','#transferPayment',function(event){  /* transfer payment */
		
			event.stopImmediatePropagation();	
			
			var feeData = $('#feeCat').val();	
			
			var feeArray = feeData.split('#fob#');
			var amount = feeArray[1];	
			
			$('#amountPaid').val(amount);

			//$('.field-selector').change();
			calculateFees();	
			
			return false;  
		
		}); 

		function calculateFees(){  
				
			$('.wiz-glower').show();
			
			var $fee_data =  $('#feeCat').val();
			var $amountPaid =  parseInt($('#amountPaid').val()); 
			var $waiver = parseFloat($('#waiver').val()); 			
			var $efine = parseFloat($('#efine').val());  
			var $balance  = 0;
			var $amount_paid  = $amountPaid;

			var $fee_arr = $fee_data.split('#fob#');
			var $total_fee = parseInt($fee_arr[1]);	 

			if(($amountPaid > $total_fee) || ($amountPaid == "") || ($amountPaid == 0)){

				$amountPaid = "";
				$('#amountPaid').val(""); 
				$('#total_fee').val(0); 
				$('#waiver').val(""); 
				$('#efine').val(""); 
				$('#fbalance, , #amountBal').val(0); 

				$('#total_fee_dis').text("0.00");
				$('.journal-amount').val("0.00");
				$('#efine_des').text("0.00");
				$('#waiver_des').text("0.00");  
				$('#balance_des').text("0.00");  
					

			}else{	

				if(($amountPaid != "") || ($amountPaid != 0)){    

					if(($waiver != "") && (!isNaN($waiver))){

						$amountPaid -= $waiver; 

					}else{ $waiver = 0; }  

					if(($efine != "") && (!isNaN($efine))){

						$amountPaid += $efine; 

					}else{ $efine = 0; }   

					if($amount_paid == $total_fee){    
						
						if($amountPaid > $amount_paid){
							$balance = ($amountPaid - $amount_paid);  
						}else{ $balance  =  0.00; } 

					}else{
						
						if($amount_paid < $total_fee){
							$balance = (($total_fee - $amount_paid - $waiver) + $efine);  
						}else{ $balance  =  0.00; }  
						
					}

					$('#efine_des').text($efine.toFixed(2)); 
					$('#waiver_des').text($waiver.toFixed(2)); 
					$('#total_fee').val($amountPaid.toFixed(2)); 
					$('#total_fee_dis').text($amountPaid.toFixed(2));
					$('.journal-amount').val($amountPaid.toFixed(2));
					$('#balance_des').text($balance.toFixed(2));
					$('#fbalance, #amountBal').val($balance.toFixed(2));   
					
				} 
			
			}

			$('.wiz-glower').fadeOut(2500);
			
		}

		function payroll(){ 

			$('.wiz-glower').show();

			var $salary =  parseInt($('#salary').val());
			var $tax = parseFloat($('#salary-tax').val());
			var $ea1 = parseFloat($('#earn1').val());
			var $ea2 = parseFloat($('#earn2').val());
			var $ea3 = parseFloat($('#earn3').val());				
			var $de1 = parseFloat($('#ded1').val());
			var $de2 = parseFloat($('#ded2').val());
			var $de3 = parseFloat($('#ded3').val());

			var $salary_per = 0; var $nsalary = 0; 

			if (isNaN( $tax )  ||  ($tax == "")) {

				$tax = 0;

			} 

			if(($salary != "") && ($salary != 0)){  //&&  ($tax != "") && ($tax != 0)

				$salary_per = ($salary * $tax);

				$nsalary = ($salary - $salary_per);
 
				if(($ea1 != "") && (!isNaN($ea1))){

					$nsalary += $ea1;

				}else{ $ea1 = 0; }

				if(($ea2 != "") && (!isNaN($ea2))){

					$nsalary += $ea2;

				}else{ $ea2 = 0; }

				if(($ea3 != "") && (!isNaN($ea3))){

					$nsalary += $ea3;

				}else{ $ea3 = 0; } 

				if(($de1 != "") && (!isNaN($de1))){

					$nsalary -= $de1;

				}else{ $de1 = 0; }
					
				if(($de2 != "") && (!isNaN($de2))){

					$nsalary -= $de2;

				}else{ $de2 = 0; }

				if(($de3 != "") && (!isNaN($de3))){

					$nsalary -= $de3;

				}else{ $de3 = 0; } 

				$ea_total = ($ea1 + $ea2 + $ea3);

				$de_total = ($de1 + $de2 + $de3);

				$('#nsalary').val($nsalary.toFixed(2)); 
				$('#to-salary').text($nsalary.toFixed(2)); 
				$('.journal-amount').val($nsalary.toFixed(2));
				$('#tax-descrip').text($salary_per.toFixed(2));
				$('#tax-de-1').text($de1.toFixed(2));
				$('#tax-de-2').text($de2.toFixed(2));
				$('#tax-de-3').text($de3.toFixed(2)); 
				$('#tax-de-to').text($de_total.toFixed(2)); 

				$('#tax-ea-1').text($ea1.toFixed(2));
				$('#tax-ea-2').text($ea2.toFixed(2));
				$('#tax-ea-3').text($ea3.toFixed(2)); 
				$('#tax-ea-to').text($ea_total.toFixed(2));  

			}  

			$('.wiz-glower').fadeOut(2500);
			
		}  

		$(function() {  
			
			$('body').on("keyup", ".payrow-total", function() {
				alert(1)
				var sum = 0;
				$(".payrow-total").each(function(){
					sum += +$(this).val();
				});
				$(".grand_total").html(sum);
				$(".grand_total2, .journal-amount").val(sum);
			});  
			
		}); 

		function sumPayroll2(){ 

			var sum = 0;
			$(".payrow-total").each(function(){
				sum += +$(this).val();
			});
			$(".grand_total").html(sum);
			$(".grand_total2, .journal-amount").val(sum);

		}

		function sumPayroll() {

			var sum = 0.0;
			var net_earn_ded = 0.0;
			var net_nsalary;
			var amount;
			var net_salary;

			$('#fob-payroll-tb > tbody  > tr').each(function() {
				var price = $(this).find('.payrow-price').val();
				var tax = parseFloat($(this).find('.payrow-tax').val());
				var earn = $(this).find('.payrow-earn').val();
				var ded = $(this).find('.payrow-ded').val(); 

				if (isNaN( price )) { 

					/* 
					Swal.fire(
						'Invalid Iinput!',
						'Invalid Salary input. Enter number or float only eg 3000, 3500.08.',
						'error'
					);
					*/
					
					$(this).find('.payrow-price').val(0);
					//return false; 

				}
				
				if (isNaN( tax )) { 
					
					/*
					Swal.fire(
						'Invalid Iinput!',
						'Invalid Tax input. Enter number or float only eg 3000, 3500.08.',
						'error'
					);
					*/
					
					$(this).find('.payrow-tax').val(0);
					///return false; 

				}

				if (isNaN( price )  ||  (price == "")) {

					price = 0;

				}
				
				if (isNaN( ded )  ||  (ded == "")) {

					ded = 0;

				}

				if (isNaN( tax )  ||  (tax == "")) {

					tax = 0;

				}

				amount = (tax * price);
				net_salary = (price - amount);

				net_earn_ded = parseInt(earn) + parseInt(ded);  

				net_nsalary = (parseFloat(net_salary) + parseFloat(net_earn_ded));
				$(this).find('.payrow-total').val(net_nsalary);
				
				var sum1 = 0;
				$(".payrow-total").each(function(){
					if($(this).val()!=null || $(this).val()!='')
					{
						sum1 += parseFloat($(this).val());
					}
					
				});

				$(".grand_total").html(sum1);
				$(".grand_total2, .journal-amount").val(sum1);

			});
		
		}

		function sumGrandPayroll() {

			var sum = 0.0;
			var net_earn_ded = 0.0;
			var net_nsalary;
			var amount;
			var net_salary;
			$('#fob-payroll-tb > tbody  > tr').each(function() {
				var price = $(this).find('.payrow-price').val();
				var tax = $(this).find('.payrow-tax').val();
				var earn = $(this).find('.payrow-earn').val();
				var ded = $(this).find('.payrow-ded').val();

				if (isNaN( price )  ||  (price == "")) {

					price = 0;

				}
				
				if (isNaN( ded )  ||  (ded == "")) {

					ded = 0;

				}

				if (isNaN( tax )  ||  (tax == "")) {

					tax = 0;

				}

				amount = ( tax * price ); 
				net_salary = (price - amount);
				net_earn_ded = parseInt(earn) + parseInt(ded);   
				net_nsalary = (parseFloat(net_salary) + parseFloat(net_earn_ded)); 

				$(this).find('.payrow-total').val(net_nsalary);

			}); 

		}

		function savePayroll(){   

			var input_arr = $.map($('#fob-payroll-tb>tbody>tr'), function (tr) {
				var $inp = $('input', tr);
				var $textarea = $('textarea', tr);
				return {
					staff: $inp.eq(0).val(),
					earn_info: $textarea.eq(0).val(),
					ded_info: $textarea.eq(1).val(), 
					salary: $inp.eq(1).val(),
					tax: $inp.eq(2).val(),
					earn: $inp.eq(3).val(),
					ded: $inp.eq(4).val(), 
					nsalary: $inp.eq(5).val(), 
				};
			}); 

			var journal_arr = $.map($('#fob-journal-entry>tbody>tr'), function (tr) {
				var $inp = $('input', tr);
				var $select = $('select', tr);
				return {
					account: $select.eq(0).val(),
					debit: $inp.eq(0).val(),
					credit: $inp.eq(1).val(),
				};
			}); 

			var query = "save";
			var pid = 1;//$('#pid').val();
			var title = $('#title').val();
			var total = $('#grand_total').val(); 
			var jdate = $('#jdate').val();
			var method = 1;//$('#method').val(); 
			var querytp = $('#querytp').val();   
			//var account_1 = $('#chart_account1').val().split('#fob#'); 
			//var account_2 = $('#chart_account2').val().split('#fob#');   

			//var account1 = account_1[0];
			//var account2 = account_2[0]; account1:account1, account2:account2, 

			$.ajax('payroll-wizard.php', {
				type: 'POST',  					
				data: { payroll:query, pid:pid, title:title, inputs:input_arr, journals:journal_arr, total:total, jdate:jdate, method:method, querytp:querytp},
				success: function (data, status, xhr) {
					$('#msg-box').html(data); 
				},
				error: function (jqXhr, textStatus, errorMessage) {
					$('#msg-box').html('Error: ' + errorMessage);
				}
			}); 

		}
			
		<?php require ($common_staff_script); ?>
		<?php require ($companionScriptJS); ?> 
		
	</script>            
	<?php }else{ exit; } ?>