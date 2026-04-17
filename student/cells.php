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
	This script handle student jQuery/Javascript
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

		$('body').on('click', '.shopCategory',function(event){  /* select shop category */ 
					
			event.stopImmediatePropagation();
			
			var category = this.id.split('-');
			var catID = category[1];
			var vCategory = 'vCategory';
			var link = 	'load-products.php';
			
			showPageLoader();
			
			$('#wiz-cart-div').load(link, {'shopData': vCategory, 'catID': catID
									}).fadeIn(1000);		
									
			$('html, body').animate({ scrollTop:  $('#wiz-cart-div').offset().top - 300 }, 'slow');								   
			
			return false;  
		
		});
		
		$('body').on('click', '.view-item',function(event){  /* view product */ 
					
			event.stopImmediatePropagation();
			
			var product = this.id.split('-');
			var pID = product[1];
			var vProduct = 'vProduct';
								
			showPageLoader();
			
			$('#wiz-cart-div').load('load-products.php', {'shopData': vProduct, 'pID': pID
									}).fadeIn(1000);		
									
			$('html, body').animate({ scrollTop:  $('#shopping-mall').offset().top - 130 }, 'slow');								   
			
			return false;  
		
		});
		
		$('body').on('click', '.editProduct',function(event){  /* edit product */
			
			event.stopImmediatePropagation();					
			
			var product = this.id.split('-');
			var valEmpty = '';
			var varID = 'e-cart';
			var vProduct = 'vProduct';	
			var eProduct = true;	
			var pID = product[1];
			var qtyV = product[2];									
								
			$('#fobrain-content').html(valEmpty);
			
			showPageLoader();   
			
			$('#fobrain-content').load('navigator', {'iemj': varID, 'shopData': vProduct, 'pID': pID, 
			'eProduct': eProduct, 'qtyV': qtyV }).fadeIn(1000); 
			$('#fobrain-content').slideDown(100);
			
			$('html, body').animate({ scrollTop:  $('#wizg-wrapper').offset().top - 50 }, 'slow');
			
			return false;  
		
		});
		
		$('body').on('click', '.check-out',function(event){  /* product check out */
			
			event.stopImmediatePropagation();					
			
			var valEmpty = '';
			var varID = 'e-cart';					
			var vProduct = 'cOut';						
			
			$('#fobrain-content').html(valEmpty);
			
			showPageLoader();   
			
			$('#fobrain-content').load('navigator.php', {'iemj': varID, 'shopData':vProduct }).fadeIn(1000); 
			$('#fobrain-content').slideDown(100);
			
			$('html, body').animate({ scrollTop:  $('#wizg-wrapper').offset().top - 50 }, 'slow');
			
			return false;  
		
		});
		
		$('body').on('click', '#orderConfirmation',function(event){  /* product order confirmation */
					
			event.stopImmediatePropagation();
			
			
			var vProduct = 'confirmation';
			var confirmType = 'bankDeposit';
			var conStatus = $('#confirm-data').text();					
			//$('#mallLoader').fadeIn(100);
			
			$('#wiz-cart-div').load('e-confirm-manager.php', {'shopData': vProduct, 'confirm': confirmType, 'conStatus': conStatus }).fadeIn(1000);		
									
			$('html, body').animate({ scrollTop:  $('#shopping-mall').offset().top - 130 }, 'slow');								   
			
			return false;  
		
		});
		
		$('body').on('click', '#orderConfirmation--id',function(event){  /* product order confirmation */
			
			event.stopImmediatePropagation();					
			
			var valEmpty = '';
			var varID = 'e-cart';					
			var vProduct = 'confirmation';						
			
			$('#fobrain-content').html(valEmpty);
			
			showPageLoader();   
			
			$('#fobrain-content').load('e-confirmation.php', {'iemj': varID, 'shopData':vProduct }).fadeIn(1000); 
			$('#fobrain-content').slideDown(100);
			
			$('html, body').animate({ scrollTop:  $('#wizg-wrapper').offset().top - 50 }, 'slow');
			
			return false;  
		
		});		
		
		$('body').on('click', '.enlargePic',function(event){  /* zoom product picture */
					
			event.stopImmediatePropagation();
			
			$(".loadingEnPic").fadeIn(10);
			
			var picture = this.id.split('-');
			var pictureID = picture[1];
			
			var pPicture = '<img src="'+pictureID+'" alt="product picture" height="372" width="370">';
								
			$("#englargeProPic").html(pPicture);
			
			$(".loadingEnPic").fadeOut(4000);
			
			return false;  
		
		}); 
		
		$('body').on('click', '.item-box a, .add-to-cart a',function(event){  /* add product to cart */
				
			event.stopImmediatePropagation();
			
			var button_content = $(this); //this triggered button
			var iqty = $(this).parent().children("select.p-qty").val(); 
			var icode = $(this).parent().children("input.p-code").val(); 
			
			$("#product-btn-"+icode).fadeOut(100);
			$("#loader-"+icode).fadeIn(100);
			
			$("#cart-info, .cart-info").load("e-cart.php", {"quantity": iqty, "product_code": icode });	
			
			$(".cart-box").click();
			
		}); 
		
		$( ".cart-box").click(function(e) {  /* display product in cart */
			
			e.preventDefault(); 
			$(".shopping-cart-box").fadeIn(); 
			
			$("#shopping-cart-results" ).load( "e-cart.php", {"load_cart":"1"}); 
			
		}); 
		
		$( ".close-shopping-cart-box").click(function(e){  /* close shopping cart */ 
		
			e.preventDefault(); 
			$(".shopping-cart-box").fadeOut(); 
			
		}); 
		
		$('body').on('click', 'a.remove-item', function(event) {  /* remove a product from cart */
			
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
					
					var pcode = $(this).attr("data-code"); 
					$(this).parent().fadeOut(); 
					
					$("#cart-info, .cart-info").load("e-cart.php", {"remove_code":pcode});					
					$(".cart-box").click();
					
				}
			}); 
			
			return false;
			
		});
		
		$('body').on('click', 'a.remove-item-rs', function(event) {  /* remove a product from cart */
			
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
					
					var pcode = $(this).attr("data-code"); 
					$('#cOut-'+pcode).fadeOut();
					
					$("#cart-info, .cart-info").load("e-cart.php", {"remove_code":pcode});					
					$(".cart-box").click();
					
				}
			}); 
			
			return false;					
			
		});
		
		$('body').on('change','#feeCat',function(){  /* select fess to pay */	
						
			$('#pay_loader').fadeIn(100);
			
			var payData = 'payFees';
			var feeCat = $('#feeCat').val();
			
			$('.payMethodDiv').fadeOut(1000); 
			
			if (feeCat == ""){
				
				$('.payMethodDiv').fadeOut(1000);						
				$('#pay_loader').fadeOut(1000);
			
			} else{	 
					
				$('.payMethodDiv').fadeIn(1000);	
				$('#pay_loader').fadeOut(1000);	

			}	 				   
								
			return false;  
	
		});

		$('body').on('click','#transferPayment',function(event){  /* transfer payment */
	
			event.stopImmediatePropagation();	

			$('#wiz-glower').fadeIn();

			var feeCat = $('#feeCat').val();	
			
			var feeArray = feeCat.split('-');
			var amount = feeArray[1];	
			
			$('#amountPaid').val(amount);

			$('#wiz-glower').fadeOut(3000);	
			
			return false;  
		
		});

		$('body').on('change','#payMethod',function(){  /* select fess to pay */	
						
			$('#pay_m_loader').fadeIn(100);
			
			var payData = 'payFees';
			var payMethod = $('#payMethod').val();
			var feeCat = $('#feeCat').val(); 
			
			$('.bank-pay-div, #feePayOnline, #feePayBank').fadeOut(1000); 
			
			if (payMethod == ""){
				
				$('#feePayOnline, #feePayBank, .bank-pay-div').fadeOut(1000);						
				$('#pay_m_loader').fadeOut(1000);
			
			} else if (payMethod == "bank"){
				
				$('#feePayBank, .bank-pay-div').fadeIn(1000);
				$('#feePayOnline').fadeOut(1000);						
				$('#pay_m_loader').fadeOut(1000);
			
			}else{	 
					
				$('#feePayOnline').fadeIn(1000);				
				$('#feePayBank, .bank-pay-div').fadeOut(1000);	
				$('#pay_m_loader').fadeOut(1000);

			}	 				   
								
			return false;  
	
		}); 

		$('body').on('click','.validate_pay',function(){  /* select fess to pay */	 
			
			$('#feePayOnline, #feePayBank').fadeOut(100); 
			$('#wiz-loader-2').fadeIn(500);
			
			var payData = 'validate';
			var payMethod = $('#payMethod').val(); 
			var pDay = $('#pDay').val();

			var level = $('#level').val();
			var term = $('#term').val();
			var feeCat = $('#feeCat').val();
			var amount = $('#amountPaid').val();

				
			$('#msg-box').load('payment-manager.php', {
								'payment': payData, 'level': level, 'term': term,
									'feeCat': feeCat, 'amountPaid': amount, 'pDay': pDay, 'method': payMethod	
														});	 
								
			return false;  
	
		}); 

		$('body').on('click','#feePayBankBtn',function(){	/* pay fees */

			$('#feePayOnline, #feePayBank').fadeOut(100);
			$('#wiz-loader-2').fadeIn(500);

			var form_data = new FormData($('#frmpayFee')[0]);

			$.ajax({
				url: 'payment-manager.php',
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
		
		$('body').on('click','#placeOrder',function(event){  /* place product order */
	
			event.stopImmediatePropagation();	
			
			$('.payment-btn').fadeOut(100);
			$('.pay-loader').fadeIn(500);

			var payMethod =  $('#payMethod').val();
			
			if(payMethod == "bank"){
				
				$("#orderConfirmation").click();									   
										
			}else if(payMethod == "2checkout"){
				
				$("#2checkoutBtn").click();									   
										
			}else if(payMethod == "paystack"){
				
				$("#paystackBtn").click();									   
										
			}else{
				
				Swal.fire(
					'Error Message!',
					'Ooops Error, please select your payment method',
					'error'
				) 

			}	 
			
			return false;  
	
		});  
		
		$('body').on('click', '.load-exam',function(event){  /* start exam */
	
			event.stopImmediatePropagation();											
			
			showPageLoader();	
			
			var postVal = 'load';
			var examData = this.id.split('-');
			var eID = examData[1];
			
			$('#examQuestDiv').load('e-exam.php', {'query': postVal, 'eID': eID
									}).fadeIn(1000);					
			
			return false;  
	
		}); 
		
		$('body').on('click', '.start-exam',function(event){  /* answer exam question  */
	
			event.stopImmediatePropagation();											

			Swal.fire({
				title: "Are you ready?",
				text: "Once started, you won't be able to stop or retake this.",
				icon: "info",
				showCancelButton: true,
				confirmButtonColor: "#3085d6",
				cancelButtonColor: "#d33",
				confirmButtonText: "Yes, Start!"
			}).then((result) => {
				
				if (result.isConfirmed) {
					
					showPageLoader();	

					var postVal = 'start';
					var examData = this.id.split('-');
					var eID = examData[1];
					
					$('#examQuestDiv').load('e-exam.php', {'query': postVal, 'eID': eID
										}).fadeIn(1000);			 
					
				}
			}); 
			
			return false;  
	
		});  

		$('body').on('click', '.examPage',function(event){  /* load exam page  */
	
			event.stopImmediatePropagation();											
			
			showPageLoader();	
			
			$('#e-exam').click();
			
			hidePageLoader(); 
			
			return false;  
	
		}); 
		
		$('body').on('click', '.load-hwork',function(event){  /* start assignment  */
	
			event.stopImmediatePropagation();											
			
			showPageLoader();	
			
			var postVal = 'load';
			var assignData = this.id.split('-');
			var eID = assignData[1];
			
			$('#examQuestDiv').load('e-homework.php', {'query': postVal, 'eID': eID
									}).fadeIn(1000);					
			
			return false;  
	
		}); 
		
		$('body').on('click', '.start-hwork',function(event){  /* answer assignment question */
	
			event.stopImmediatePropagation();											

			Swal.fire({
				title: "Are you ready?",
				text: "Once started, you won't be able to stop or retake this.",
				icon: "info",
				showCancelButton: true,
				confirmButtonColor: "#3085d6",
				cancelButtonColor: "#d33",
				confirmButtonText: "Yes, Start!"
			}).then((result) => {
				
				if (result.isConfirmed) {
					
					showPageLoader();	
			
					var postVal = 'start';
					var assignData = this.id.split('-');
					var eID = assignData[1];
					
					$('#examQuestDiv').load('e-homework.php', {'query': postVal, 'eID': eID
										}).fadeIn(1000);					
					
				}
			}); 					
			
			return false;  
	
		});  

		$('body').on('click', '.assignPage',function(event){  /* load assignment page */
	
			event.stopImmediatePropagation();											
			
			showPageLoader();	
			
			$('#e-homework').click();
			
			hidePageLoader(); 
			
			return false;  
	
		});


		$('body').on('click', '.load-course',function(event){  /* start course */
	
			event.stopImmediatePropagation();											
			
			showPageLoader();	
			
			var postVal = 'load';
			var courseData = this.id.split('-');
			var cid = courseData[1];
			
			$('#course-load-wrapper').load('e-course.php', {'query': postVal, 'cid': cid
									}).fadeIn(1000);		
									
			$('html, body').animate({ scrollTop:  $('#course-load-wrapper').offset().top - 150 }, 'slow');
			
			return false;  
	
		}); 


		$('body').on('click','.load-course-video',function(event){  /* view student profile */

			event.stopImmediatePropagation(); 

			showPageLoader(); 
			 
			let postVal = 'view';
			//var hid = this.id;  

			let hid = $(this).attr("course-id"); 
			let image = $(this).attr("course-img");
			let staff = $(this).attr("course-staff");
			let chapter = $(this).attr("course-chapter");
			let ctopic = $(this).attr("course-topic");
			let ctime = $(this).attr("course-time");  
			
			$('#edit-msg').html("");	
			$('#modal-load-div').show();

			$('#modal-load-div').load('e-course.php', {'query': postVal, 'hid': hid, 
										'image': image, 'staff': staff, 'chapter':chapter, 'ctopic':ctopic, 'ctime':ctime }); 

			$('#modal-fobrain').modal('show');					

			return false;  	 
		
		});


		$('body').on('click','#course-quiz',function(event){  /* view student profile */

			event.stopImmediatePropagation(); 

			Swal.fire(
				'Coming Soon!',
				'Ooops, this features is coming soon in our next upgrade. Thanks',
				'info'
			)  
 				

			return false;  	 
		
		});
		
		
		$('body').on('click', '.course-review',function(event){  /* start course */
	
			event.stopImmediatePropagation();											
			
			showPageLoader();	
			
			//var postVal = 'save';

			var postVal = $('#review_query').val(); 
			var cid = $('#in_course_id').val();
			var rid = $('#review_q_id').val(); 
			var review = $('#review-msg').val();  
			var rating = $('input[name="rating"]:checked').val();
			
			$('#msg-box').load('course-review.php', {'query': postVal, 'rid': rid, 'cid': cid, 'review': review, 'rating': rating
									}).fadeIn(1000);		
									
			//('html, body').animate({ scrollTop:  $('#course-load-wrapper').offset().top - 70 }, 'slow');
			
			return false;  
	
		}); 
 

		$('body').on('click','.download-course', function(event){  /* multi payroll */
									 
			event.stopImmediatePropagation();	 
			
			let query = $(this).attr("data-code"); 
		
			alert("here 1 " + query);
			$('#'+query).click(); 
			
			return false;  
		
		});


		$('body').on('click','.navigate',function(){  /* page menu loading */	 
 
			var varID = this.id;

			$('#fobrain-content').html("");
			
			showPageLoader(); 
			
			$('#fobrain-content').load('navigator', {'iemj': varID}); 
		 
			$('html, body').animate({ scrollTop:  $('#wizg-wrapper').offset().top - 150 }, 'slow');  

			return false;

		}); 

			
		$('body').on('click','.show-lib-book',function(event){  /* show school library book */
		
			event.stopImmediatePropagation();
		
			showPageLoader(); 
			
			var varID = this.id;
			
			$('#lib-show-div').load('lib-show-book.php', {'bookID': varID}).fadeIn(1000);
			$('.modal-show-lib').click();
		
			return false;  
		
		});

		$('body').on('click','.apply-lib-book',function(event){  /* apply for library book */
		
			event.stopImmediatePropagation();

			var clickedID = this.id.split('-');
			var libraryData = this.id;
			var book_id = clickedID[1];
			var book_name = clickedID[2];
			var book_author = clickedID[3];

			Swal.fire({
				title: "Are sure you want to borrow?",
				text: book_name +' By '+ book_author,
				icon: "info",
				showCancelButton: true,
				confirmButtonColor: "#3085d6",
				cancelButtonColor: "#d33",
				confirmButtonText: "Yes, Borrow Book"
			}).then((result) => {
				
				if (result.isConfirmed) {
					
					showPageLoader();  
										
					$('#lib-book-msg').load('lib-book-apply.php', {'bookID': book_id}).fadeIn(1000);	
					
				}
			}); 
			
			return false; 
		
		});
		
		$('body').on('click','.viewBroadcast',function(event){  /* view school broadcast */
		
			event.stopImmediatePropagation();	
			
			var emptyStr = "";
			var broadcastID = this.id;
			var postVal = 'viewBroadcast';				
			
			showPageLoader();
			
			$('#editMsg').html(emptyStr);	
			$('#editBroadcastDiv').show();
			
			$('#editBroadcastDiv').load('broadcast.php', {'broadcastData': postVal, 'rData': broadcastID
									}).fadeIn(1000);										   
									
			$('.modal-bcast-div').click();			
			
			return false;  
		
		});   

		$('body').on('click','#rechargeWallet',function(){  /* recharge e-wallet */
		
			$('#frmrechargeWallet').submit(function(event) {		
				
				showPageLoader();	
			
				event.stopImmediatePropagation();
						
				$.post('ewallet-recharge.php', $(this).find('select, input').serialize(), function(data) {
					
					$('#msg-box').html(data);	
					$('html, body').animate({ scrollTop:  $('#msg-box').offset().top - 130 }, 'slow');
				
				
				});
		
				return false;
		
			});		
		});
	
		$('body').on('click','#viewRs',function(){  /* view student result */
		
			$('#frmviewRs').submit(function(event) {		
						
				event.stopImmediatePropagation();
				
				showPageLoader();
						
				$.post('load-result.php', $(this).find('select, input').serialize(), function(data) {
					
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

		$('body').on('click','#bestStudents',function(){  /* view best student result */
		
			$('#frmbestStudents').submit(function(event) {		
					
				event.stopImmediatePropagation();
				
				showPageLoader();
						
				$.post('load-result.php', $(this).find('select, input').serialize(), function(data) {
					
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

		$('body').on('click','#viewEWallet',function(){  /* view student e-wallet */
		
			$('#frmviewEWallet').submit(function(event) {		
					
				event.stopImmediatePropagation();
				
				showPageLoader();
				
				$.post('ewallet-history.php', $(this).find('select, input').serialize(), function(data) {
					
					$('#fobrain-page-div').html(data);	
					$('.fobrain-section-div').slideUp(2000);	
					$('#fobrain-page-div').slideDown(2000);
					$('.fobrain-page-icons').fadeIn(200);	
					$('.printer-icon').fadeIn(200);					
				
				});
		
				return false;
			
			});		
			
		});

		$('body').on('click','#supportDesk',function(){  /* send support to school admin */
		
			$('#frmSupportDesk').submit(function(event) {		
				
				event.stopImmediatePropagation();
				
				showPageLoader();
				
				$.post('support-manager.php', $(this).find('select, input, textarea').serialize(), function(data) {
					
					$('#msgBox').html(data);	
				
				});
		
				return false;
		
			});		

		}); 

		$('body').on('click','.edit-profile',function(event){  /* edit student profile information */
		
			event.stopImmediatePropagation();
			
			showPageLoader();   
			
			var varID = this.id; 
			
			$('#wigz-right-half').load('load-bio.php', {'reg': varID }).fadeIn(1000);
			$('html, body').animate({ scrollTop:  $('#wigz-right-half').offset().top - 80 }, 'slow'); 
		
			return false; 
		
		}); 

		$('body').on('click','#saveStudentBio',function(){  /* edit student profile information */
		
			$('#frmStudentBio').submit(function(event) {
							
				event.stopImmediatePropagation(); 
				
				showPageLoader();
						
				$.post('bio-manager.php', $(this).find('select, input, textarea').serialize(), function(data) {
					
					$('.msg-box').html(data);
				
				});
				
				//$('html, body').animate({ scrollTop:  $('.wizg-scroller').offset().top - 50 }, 'slow');
		
				return false;
			
			});		
			
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
	
		function finishAjax(id, response) {  /* load div */
			$('#wait_1, #wait_11').hide();
			$('#'+id).html(unescape(response));
			$('#'+id).fadeIn();
		}


		function finishAjax_tier_three(id, response) {  /* load div */
			$('#wait_2').hide();
			$('#'+id).html(unescape(response));
			$('#'+id).fadeIn();
		}

		
		setInterval(function() {  /* check inactivity user time */

			var timerData = 'check';

			$('#wizg-activity').load('activity-timer.php', {'timer': timerData});
			
		}, 30000);


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

		$('body').on('click', '#change-pass', function(event){  /* change password */
																	
			$('#frm-change-pass').submit(function(event) {
							
				event.stopImmediatePropagation();
				
				showPageLoader();
						
				$.post('chang-pass-manager.php', $(this).find('select, input').serialize(), function(data) {
					
					$('#msg-box').html(data); 
														
				});
				
				$('html, body').animate({scrollTop:$('#msg-box').position().top}, 'slow'); 
		
				return false;
			
			});	
									
		}); 
		
		$('body').on('click', '.checkRSDiv',function(event){  /* load e-wallet div in result page */
	
			event.stopImmediatePropagation();											
			
			$(this).slideUp(300);
			
			$('.checkeWalletDiv').slideDown(800);
			
			return false;  
	
		});				
		
		$('body').on('click','.viewFees',function(event){  /* view fees */
	
			event.stopImmediatePropagation();	
			
			var emptyStr = "";
			var feesID = this.id;
			var postVal = 'viewFees';				
			
			showPageLoader(); 
			
			$('#editMsg').html(emptyStr);	
			$('#editFeesDiv').show();
				
			$('#editFeesDiv').load('view-fees.php', {'feesData': postVal, 'rData': feesID
									}).fadeIn(1000);										   
								
			$('.modal-fee-div').click();			
			
			return false;  
	
		});
			
		$('body').on('change','#sesslevel',function(){  /* load school session div */
			
			$('#wait_1').show();
			$('#result_1').hide();   
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



		$('body').on('click','.join-class',function(event){  /* view online liveclass */
	
			event.stopImmediatePropagation(); 

			var emptyStr = "";
			var liveclassID = this.id;
			var postVal = 'start';				

			showPageLoader(); 

			$('#edit-msg').load( 'live-class.php', {'liveclass': postVal, 'eData': liveclassID }); 

			$('#fob-wrapper').css('display', 'none');
			$('#virtual-loading').show();

			return false;   
		
		});

		$('body').on('click','#virtual-loading',function(event){  /* reload online liveclass */
		
			location.reload();   
		
		});

		$('body').on('click','.roll-reply',function(event){  /* edit online rollreply */ 
	
			event.stopImmediatePropagation(); 

			var emptyStr = "";
			var rollreplyID = this.id;
			var postVal = 'edit';				

			showPageLoader();

			$('#edit-msg').html(emptyStr);	
			$('#modal-load-div').show();

			$('#modal-load-div').load( 'roll-call.php', {'rollreply': postVal, 'eData': rollreplyID }); 

			//$('.modal-fobrain').click();			

			return false;  

		});

		<?php require ($companionScriptJS);    /* include companion jquery scripts */  ?>


	</script>
	
<?php   }else{ exit; } ?>