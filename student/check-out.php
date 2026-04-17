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
	This script handle product checkout
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

     	define('fobrain', 'igweze');  /* define a check for wrong access of file */

        require 'fobrain-config.php';  /* load fobrain configuration files */ 
		

		if ($_REQUEST['shopData'] == 'cOut') { 
				
			try {

				if($sale_account == ""){

					$msg_e = "* Ooops, no school bank account is linked to online sales. Notify Bursary to link an account";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>  
						hidePageLoader();  
					</script>";

				}else{

					$bankAccountInfoArr = bankAccountInfo($conn, $sale_account);  /* school bank account information */
					$bankAccount = $bankAccountInfoArr[$fiVal]['acc'];
					$accno = $bankAccountInfoArr[$fiVal]['accno'];
					$bank = $bankAccountInfoArr[$fiVal]['bank'];
					$desc = $bankAccountInfoArr[$fiVal]['descr'];
					$status = $bankAccountInfoArr[$fiVal]['status'];
				}
				 
				$billingData = billingData($conn, $regNum);  /* students billing information  */ 
				list($nameFull, $address, $city, $state, $country, $phone) = explode("##", $billingData);
				$refReg = clean($regNum);  
						
			}catch(PDOException $e) {
					
				fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
					 
			}			


				
$cartHead =<<<IGWEZE
	
				

				<!-- invoice start -->
			  
						<div class="row" id="fobrain-print">
						 
							<h3 class="my-25 text-center text-primary">Please Confirm Your Order</h3> 
			
					  
							<div class="row invoice-list">
                              
								<div class="col-lg-6 col-sm-6 fs-13">
                                  <h4 class=" text-danger"><b>BILLING ADDRESS</b></h4>
                                  <p class=" text-primary">
                                     $nameFull<br>
									  $address<br>
                                      $city, $state, $country<br>
                                      $phone<br>
                                  </p>
								</div>
								<div class="col-lg-6 col-sm-6  fs-13">
                                  <h4 class=" text-danger"><b>DELIVERY ADDRESS</b></h4>
                                  <p class=" text-primary">
                                      $nameFull<br>
									  $address<br>
                                      $city, $state, $country<br>
                                      $phone<br>
                                  </p>
								</div>
							  
							  
							</div>
						  
							<!-- table -->
							<div class="table-responsive">
							<table class="table table-responsive table-striped table-hover my-20">
                              <thead>
                              <tr>
                                  <th class='text-left'>#</th>
                                  <th class='text-left'>Item</th>
                                  <th class='text-left'>Description</th>
                                  <th class='text-left'>Unit Cost</th>
                                  <th class='text-left'>Quantity</th>
                                  <th class='text-left'>Total</th>
								  <th class='text-left'>Tasks</th>
                              </tr>
                              </thead>
                              <tbody>
							  

		
IGWEZE;
							echo $cartHead;
		
							$total = 0; $serialCount = 0;
							$productItem = ""; $productDesc = "";
							foreach($_SESSION["ecart_session"] as $product){  /* loop array */ 
						
								try { 
						
									$productID = $product["code"];
									$productData =  productInfo($conn, $productID);  /* school products information*/
								
								}catch(PDOException $e) {

									fobrainDie( 'Ooops Database Error: ' . $e->getMessage());

								}
								list ($p_id, $p_title, $p_date, $p_price, $p_description) = explode ("@(.$*S*$.)@", $productData);
								
								$productItem .= $p_title.', ';
								$productDesc .= $p_description.', ';
								
								$titleEn =  cleanMultiLang($p_title);
								$titleEn = str_replace(" ", "-", $titleEn);
								
								$productLink = $p_id.'-'.$titleEn;
								
								$product_price = ($product["price"] * $product["qty"]);
								$product_price = number_format($product_price, 2);
								$product_name = $product["name"];
								$product_qty = $product["qty"];
								$product_code = $product["code"];
						
												
								$subtotal = ($product["price"] * $product["qty"]);
								$total = ($total + $subtotal);
								$subtotalS = number_format($subtotal, 2);
								$serialCount++;
					
$cartBody =<<<IGWEZE

								<tr id="cOut-$productID">
										 <td class='text-left'>$serialCount</td>
										 <td class='text-left'>$product_name</td>
										 <td class='text-left' >$p_title</td>
										 <td class='text-left'>$curSymbol$p_price  </td>
										 <td class='text-left'>$product_qty </td>
										 
										 <td class='text-left'> $curSymbol$subtotalS</td>
										 <td class='text-left'>
										 <a href="javascript:;" class="remove-item-rs icon-red pe-15" data-code="$product_code"><i class="fa fa-times"></i></a>
										 <a href="javascript:;" class="editProduct icon-tem-color" id="fobrain-$product_code-$product_qty"><i class="fa fa-edit"></i></a>
										 </td>	
								 </tr>
							  
					
		
IGWEZE;
								echo $cartBody;
					
					
							}
			
							$grand_total = number_format($total, 2);
							
							$productDesc = trim($productDesc, ', ');
							$productItem = trim($productItem, ', ');
							
							$_SESSION['cartTotal'] = $total;
					
						
$cardTail =<<<IGWEZE

							</tbody>
							</table>
							<!-- / table -->  
							</div>
							
							<!-- row -->
							<div class="row my-10">
								<div class="col-lg-7 invoice-block pull-left"> 
								
									<h4 class="my-20 text-danger fs-13">Select Your Payment Method</h4>  
									<div id="orderConfirmation"> </div>
									<span id="confirm-data" class="display-none">1</span> 
									<!-- field wrapper start -->
									<div class="field-wrapper text-left">
										<select class="form-control fob-select"  id="payMethod" name="payMethod" required>											  
											<option value = "">Search . . .</option>
											<option value = "bank">Bank Deposit / Transfer</option> 
											<!--<option value = "2checkout">2Checkout</option> -->
											<option value = "paystack">Paystack</option> 										   
										</select>
										<input type="hidden" value="" name = "payment"/> 
										<div class="field-placeholder">* Payment Method <span class="text-danger">*</span></div>
										<div class="form-text text-danger fs-11">
											Select your payment method.
										</div>
									</div>
									<!-- field wrapper end -->
								</div>
							  
								<div class="col-lg-5 mt-20 invoice-block pull-right">
                                  <ul class="unstyled amounts fs-13">
                                      <li class=" text-danger"><strong>Sub - Total  :</strong> $curSymbol$grand_total </li>
                                      <li class=" text-danger"><strong>VAT :</strong> -----</li>
                                      <li class=" text-primary"><strong>Grand Total :</strong> $curSymbol$grand_total </li>
                                  </ul>
								</div> 
							  
							</div>
							<!-- / row -->
							
							<div class="text-left invoice-btn my-40">
								<div class="display-none pay-loader">
									<strong role="status">Processing...</strong>
									<div class="spinner-border ms-auto" aria-hidden="true"></div>
								</div>
                              	<a class="btn btn-danger btn-lg payment-btn" id ="placeOrder"><i class="fa fa-check"></i> Place Your Order </a>
                              	<a class="btn btn-info btn-lg printer-icon payment-btn"><i class="fa fa-print"></i> Print </a>
							</div> 
					 
						 
						
						</div>
						<!-- invoice end -->

IGWEZE;
						echo $cardTail; 
						
						$isCart = 1;
						
						echo "<script type='text/javascript'>   
									$('.fob-select').each(function() {  
										renderSelect($('#'+this.id)); 
									});
									hidePageLoader();
									$('.shopping-cart-box').fadeOut(); 
								</script>";

						require_once $fobrainPayG;

		}else{ 
			
				echo $userNavPageError; exit;  /* else exit or redirect to 404 page */

		}	
		
exit;	
?>