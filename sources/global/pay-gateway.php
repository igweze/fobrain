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
	This script load payment gateways checkout
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

		require ($fobrainvalidater); 
		
		$transRefNo  = randomString($charset, 20); /* generate auto random character */				
		$errTransRefNo  = randomString($charset, 20); /* generate auto random character */
		
		$fobrainPilot = $_SESSION['fobrainPilot'];
		
		$_SESSION['transRefNo'] = $transRefNo;				
		$_SESSION['errTransRefNo'] = $errTransRefNo; 
		
		$successURL = $fobrainPilot."/payment-success?c=$transRefNo"; /* success URL details */
		$errorURL = $fobrainPilot."/payment-error?c=$transRefNo"; /* success URL details */
		$totalMulti = $total* 100;
		
		if($isCart == 1){ /* check if shopping cart */
			$show_script = 	'$("#orderConfirmation").click();';
		}else{
			$show_script = 	'$("#feePayBankBtn").click();';
		}		
	
$paystack =<<<IGWEZE
		
		
		<!-- paystack --> 
		<form >
			<script src="https://js.paystack.co/v1/inline.js"></script>
			<button type="button" class="display-none" id="paystackBtn" onclick="payWithPaystack()"></button> 
		</form>
			
		<script>
			function payWithPaystack(){
				var handler = PaystackPop.setup({
				key: '$payStackPublicKey', 
				email: '123@fobrain.com',
				amount: $totalMulti,
				currency: "$countryCurrCode",
				ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
				firstname: '$nameFull',
				lastname: '',
				// label: "Optional string that replaces customer email"
				metadata: {
					custom_fields: [
						{
							display_name: "Mobile Number",
							variable_name: "mobile_number",
							value: "$phone"
						}
					]
				},
				callback: function(response){
					$("#confirm-data").text(2);
					$('.success-pay-div').fadeOut(1000);	 
					$show_script 
					//alert('success. transaction ref is ' + response.reference); 
				},
				onClose: function(){
					$infoMsg1 You close your payment process $sEnd1;
					$('#wiz-loader-2').fadeOut(2000);
				}
				});
				handler.openIframe();
			}
		</script> 
		
		<!-- / paystack -->

IGWEZE;
			echo $paystack; 
			
			

?>

		<script type="text/javascript">   


			(function (document, src, libName, config) {
					var script             = document.createElement('script');
					script.src             = src;
					script.async           = true;
					var firstScriptElement = document.getElementsByTagName('script')[0];
					script.onload          = function () {
						for (var namespace in config) {
							if (config.hasOwnProperty(namespace)) {
								window[libName].setup.setConfig(namespace, config[namespace]);
							}
						}
						window[libName].register();
					};

					firstScriptElement.parentNode.insertBefore(script, firstScriptElement);
				})(document, 'https://secure.2checkout.com/checkout/client/twoCoInlineCart.js', 'TwoCoInlineCart',{"app":{"merchant":"255111936473","iframeLoad":"checkout"},"cart":{"host":"https:\/\/secure.2checkout.com","customization":"inline-one-step"}});
		
		</script> 



<?php

$twoCheckout =<<<IGWEZE

		
		<a href="#" class="btn hide" id="2checkoutBtn">Buy now!</a>

		<script type="text/javascript">   

			window.document.getElementById('2checkoutBtn').addEventListener('click', function() {
				TwoCoInlineCart.setup.setMode('DYNAMIC');
				TwoCoInlineCart.cart.setCurrency('USD');
				
				TwoCoInlineCart.products.removeAll();
				TwoCoInlineCart.products.add({
					name: '$productDesc',
					quantity: 1,
					price: $total,
				});

				TwoCoInlineCart.billing.setData({
					name: '$nameFull', 
					email: '$email', 
					phone: '$phone', 
					country: '$countryCurrCode', 
					city: '$city', 
					state: '$state', 
					zip: '', 
					address: '$address', 
					address2: ''
				});
				
				TwoCoInlineCart.cart.setSignature('db1ed9a35658f042552303cd18d06301c7c6672454616eb01fccb7969be35786');
				TwoCoInlineCart.cart.checkout();
			});

			(function (document, src, libName, config) {
					var script             = document.createElement('script');
					script.src             = src;
					script.async           = true;
					var firstScriptElement = document.getElementsByTagName('script')[0];
					script.onload          = function () {
						for (var namespace in config) {
							if (config.hasOwnProperty(namespace)) {
								window[libName].setup.setConfig(namespace, config[namespace]);
							}
						}
						window[libName].register();
					};

					firstScriptElement.parentNode.insertBefore(script, firstScriptElement);
				})(document, 'https://secure.2checkout.com/checkout/client/twoCoInlineCart.js', 'TwoCoInlineCart',{"app":{"merchant":"255111936473","iframeLoad":"checkout"},"cart":{"host":"https:\/\/secure.2checkout.com","customization":"inline-one-step"}});
		
		</script> 

		<!-- / 2checkout  -->
			
		
IGWEZE;
			echo $twoCheckout;


$payPal =<<<IGWEZE

		
		<!-- paypal -->
		<!-- form --><form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_blank">
		
			<!-- Identify your business so that you can collect the payments. -->
			<input type="hidden" name="business" value="igweze@gmail.com">
			
			<!-- Specify a Buy Now button. -->
			<input type="hidden" name="cmd" value="_xclick">
			
			<!-- Specify details about the item that buyers will purchase. -->
			<input type="hidden" name="item_name" value="$productItem">
			<input type="hidden" name="item_number" value="1">
			<input type="hidden" name="amount" value="$total">
			<input type="hidden" name="currency_code" value="$countryCurrCode">
			
			<!-- Specify URLs -->
			<input type='hidden' name='cancel_return' value='$errorURL'>
			<input type='hidden' name='return' value='$successURL'>
			
			<input name='submit' id="paypalBtn" type='submit' value='Paypal Checkout' class="display-none">
			
		</form><!-- / form -->

		<!-- / paypal -->
			
		
IGWEZE;
			echo $payPal;		
			
?>