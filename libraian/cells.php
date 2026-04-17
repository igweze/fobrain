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
	This script handle libranian jQuery/Javascript
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
	
		/*
		$('body').on('change','.edit-library-book',function(event){  /* edit library book * /	  
		
			event.stopImmediatePropagation();					
			
			var bookLIBID = this.id.split('-');
			var bookID = bookLIBID[2];
			var bookData = 'update-lib-book';
			var bookName = $('#book-name-'+bookID).val();
			
			showPageLoader();   
			
			$('#lib-book-msg').load('library-manager.php', {'library-data': bookData, 
									'bookID': bookID, 'bookName': bookName }); 

			return false;  
		
		}); 
		*/ 

		
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

		$('body').on('change','#book-lib-upload',function(){  /* upload library book */

			showPageLoader();

			var form_data = new FormData($('#frmLibrary')[0]);

			$.ajax({
				url: 'library-manager.php',
				dataType: 'text',
				cache: false,
				contentType: false,
				processData: false,
				data: form_data,
				type: 'post',
				success: function (response) {
					$('.msg-box').html(response); 
				},
				error: function (response) {
					$('.msg-box').html(response);
				}
			});

			return false;

		}); 

		$('body').on('change','#book-type',function(){  /* selec book type */	  
				
			var bookType = $('#book-type').val();
			
			if(bookType == 1){
				
				$('#book-picture-div, #allow-format-doc').show(500);
				$('.book-harhcopy-divs, #allow-format-pic').hide(500);
				$('#book-name-display').text('Upload Electronic Book');
				$('#allow-format').val('1');
				
			}else if (bookType == 2){
				
				$('#book-picture-div').show(500);
				$('.book-harhcopy-divs, #allow-format-pic').show(500);
				$('#allow-format-doc').hide(500);
				$('#book-name-display').text('Upload Book Cover Picture ');
				$('#allow-format').val('2');
			
			}else{
				
				$('#book-picture-div, .book-harhcopy-divs, #allow-format-doc, #allow-format-pic').hide(500);
				$('#book-name-display').text('Book Upload');
				$('#allow-format').val('');
			
			}
					
		});	
		
		$('body').on('click','.edit-lib-book',function(event){  /* edit library book */
		
			event.stopImmediatePropagation();
		
			showPageLoader(); 
			
			var varID = this.id;
			
			$('#modal-load-div').load('edit-book.php', {'bookID': varID}); 

			$('#modal-fobrain').modal('show');	
		
			return false;  

		}); 			 

		$('body').on('click','.remove-lib-book',function(event){  /* remove library book */

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
					var libraryData = this.id;
					var bookID = clickedID[2];
					var bookName = clickedID[3];

					var bookPath = $('#book-path-'+bookID).text();
					var bookData = 'remove-lib-book';
				
					showPageLoader();
				
					$('#remove-msg').loadload('library-manager.php', {'library-data': bookData, 
											'bookID': bookID, 'bookPath': bookPath }); 	
					
				}
			}); 
			
			return false;	 
		
		}); 
		
		$('body').on('click','.show-lib-book',function(event){  /* show library book */
		
			event.stopImmediatePropagation();
		
			showPageLoader(); 
			
			var varID = this.id;
			
			$('#modal-load-div').load('library-book.php', {'bookID': varID});  

			$('#modal-fobrain').modal('show');
		
			return false;  
		
		}); 

		$('body').on('click','.book-history',function(event){  /* show library book history */
		
			event.stopImmediatePropagation();		
			
			showPageLoader();   
			
			var bookID = this.id;
				
			$('#modal-load-div').load('book-history.php', {'bookID': bookID});	 

			$('#modal-fobrain').modal('show');

			return false;
		
		});

		$('body').on('click','.student-book-history',function(event){  /* student library book history */
		
			event.stopImmediatePropagation();		
			
			showPageLoader();   
			
			var studentData = this.id;
			
			$('#modal-load-div').load('student-history.php', {'studentData': studentData});		

			$('#modal-fobrain').modal('show');
		
			return false;
		
		}); 

		$('body').on('click','.pending-appl',function(event){  /* show pending library book */
		
			event.stopImmediatePropagation();
		
			showPageLoader(); 
			
			var varID = this.id;
			
			$('#modal-load-div').load('pending-application.php', {'bookID': varID}); 

			$('#modal-fobrain').modal('show');
		
			return false;  
		
		}); 

		$('body').on('click','.show-discard-div',function(event){  /* trigger discard library book button */
		
			event.stopImmediatePropagation();		

			$('.show-discard-div').fadeOut(1000); 
			$('.discard-appl-div').slideDown(2000);  
					
			return false;
				
		}); 
		
		$('body').on('click','.discard-book-app',function(event){  /* discard pending library book */
		
			event.stopImmediatePropagation();	

			Swal.fire({
				title: "Are you sure?",
				text: "You won't be able to revert this!",
				icon: "warning",
				showCancelButton: true,
				confirmButtonColor: "#3085d6",
				cancelButtonColor: "#d33",
				confirmButtonText: "Yes, Discard it!"
			}).then((result) => {
				
				if (result.isConfirmed) {
					
					var applyData = this.id;
					var reasons = $('#discard-reason').val();
					var libData = 'discard-application';					

					$('#book-app-loader').fadeIn(100);
					
					$('#remove-msg').load('book-appl-manager.php', {'libData': libData, 'applyData': applyData, 'reasons': reasons });    			
					
				}
			}); 
			
			return false;	 
		
		});	 
		
		$('body').on('click','.approve-appl-book',function(event){  /* show approved library book */
		
			event.stopImmediatePropagation();	

			var applyData = this.id;
			var reasons = $('#discard-reason').val();
			var libData = 'approve-application';					

			$('#book-app-loader').fadeIn(100);
			
			$('#msg-box-app').load('book-appl-manager.php', {'libData': libData, 'applyData': applyData, 'reasons': reasons });    			
			
			return false;  
		
		});	 

		$('body').on('click','.certyfy-book-return',function(event){  /* certify return library book */
		
			event.stopImmediatePropagation();	

			var returnBData = this.id;
			var rComments = $('#book-r-comments').val();
			var libData = 'certify-book-return';					

			$('#book-app-loader').fadeIn(100);
			
			$('#msg-box-app').load('book-appl-manager.php', {'libData': libData, 'returnBData': returnBData, 
									'rComments': rComments });    			
			
			return false;  
		
		});	

		$('body').on('click','#updateLibrary',function(){  /* update library book */

			showPageLoader();
		
			$('#frmupdateLibrary').submit(function(event) {		 
			
				event.stopImmediatePropagation();
				
				$.post('library-manager.php', $(this).find('select, input, textarea').serialize(), function(data) {
					
					$('.msg-box').html(data);	 
				
				});
		
				return false;
			
			});		

		}); 

		$('body').on('click','.approve-book',function(event){  /* approved library book information */
		
			event.stopImmediatePropagation();
		
			showPageLoader(); 
			
			var varID = this.id;
			
			$('#modal-load-div').load('approved-book.php', {'bookID': varID});  

			$('#modal-fobrain').modal('show');
		
			return false;  
		
		});  
			
		
		$('body').on('click','.show-hide-btn',function(event){  /* show/hide button */
		
			event.stopImmediatePropagation();		
			
			$('#showHideCols').click();
			$('.show-hide-btn').toggle();
			
			return false;
		
		}); 
	
		$('body').on('change','#schoolType',function(){  /* load school type */
		
			$('#result_2, #lib-detail-div').hide();	
			$('#wait_1').show();
			$('#result_1').hide();
			$.get("wizg-dropper.php", {
				func: "drop_1",
				schoolID: $('#schoolType').val()
			}, function(response){
				
				$('#wait_1').fadeOut(1500);
				$('#result_1').html(response).fadeIn(2000); 
					
			});
			
			return false;
		});  

		<?php require ($common_staff_script); ?>
		<?php require ($companionScriptJS); ?> 

	</script>            
	<?php }else{ exit; } ?>