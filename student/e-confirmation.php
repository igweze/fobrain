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
	This script handle products confirmation
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

     	define('fobrain', 'igweze');  /* define a check for wrong access of file */

        require 'fobrain-config.php';  /* load fobrain configuration files */ 

		if ($_REQUEST['shopData'] == 'confirmation') { 
				
			try {

				if($sale_account == ""){

					$msg_e = "* Ooops, no school bank account is linked to online sales. Notify Bursary to link an account";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>  
						hidePageLoader();  
					</script>";

				}else{

					$bankAccountInfoArr = bankAccountInfo($conn, $sale_account);  /* school bank account information */
					$bid = $bankAccountInfoArr[$fiVal]['bid'];
					$bankAccount = $bankAccountInfoArr[$fiVal]['acc'];
					$accno = $bankAccountInfoArr[$fiVal]['accno'];
					$bank = $bankAccountInfoArr[$fiVal]['bank'];
					$desc = $bankAccountInfoArr[$fiVal]['descr'];
					$status = $bankAccountInfoArr[$fiVal]['status'];

					if($bid == ""){

						$msg_e = "* Ooops, could not fecth bank account is linked to online sales. Notify Bursary to link an account";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'>  
							hidePageLoader();  
						</script>";
						
					}

				}
					
				$paymentStatus = $_REQUEST['conStatus'];
				
				if($paymentStatus == $seVal){ $payStatus = "Paid";}
				else{ $payStatus = "Unpaid";}
				
				$billingData = billingData($conn, $regNum);
				list($nameFull, $address, $city, $state, $country, $phone) = explode("##", $billingData);
				
				$tranStatus = $confirm_pay_arr[$paymentStatus]; 
				 
				$orderDate = date("Y-m-d H:i:s"); //strtotime()
				$orderDate2 = date("Y-m-d");
				$orderIP = $_SERVER['REMOTE_ADDR'];
		
				$ebele_mark = "INSERT INTO $fobrainOrderTB (acc, reg_id, regNo, stype, orderIP, orderDate, status)

								 VALUES (:acc, :reg_id, :regNo, :stype, :orderIP, :orderDate, :status)";

				$igweze_prep = $conn->prepare($ebele_mark);
				$igweze_prep->bindValue(':acc', $sale_account);
				$igweze_prep->bindValue(':reg_id', $regID);
				$igweze_prep->bindValue(':regNo', $regNum);
				$igweze_prep->bindValue(':stype', $schoolID);
				$igweze_prep->bindValue(':orderIP', $orderIP);
				$igweze_prep->bindValue(':orderDate', $orderDate2);
				$igweze_prep->bindValue(':status', 1);
				
				if($igweze_prep->execute()){
				
					$orderID = $conn->lastInsertId($fobrainOrderTB);		 

				
$cartHead =<<<IGWEZE
	
					<!-- invoice start -->
			  
						<section class="panel" id="fobrain-print">
							<header class="panel-heading">
								Your Order Confirmation and  Review 
							</header>
							<div class="panel-body fobrain-linea">			
							$infMsg Thanks so much for patronizing us. We really appreciate you. $msgEnd
							<div class="row invoice-list">
                              
								<div class="col-lg-4 col-sm-4 fs-12">
                                  <h4><b>BILLING ADDRESS</b></h4>
                                  <p class=" text-primary">
                                     $nameFull<br>
									  $address<br>
                                      $city, $state, $country<br>
                                      $phone<br>
                                  </p>
								</div>
								<div class="col-lg-4 col-sm-4 fs-12">
                                  <h4><b>DELIVERY ADDRESS</b></h4>
                                  <p class=" text-primary">
                                      $nameFull<br>
									  $address<br>
                                      $city, $state, $country<br>
                                      $phone<br>
                                  </p>
								</div>
							  
							  
								<div class="col-lg-4 col-sm-4 fs-12">
                                  <h4>INVOICE INFORMATION</h4>
                                  <ul class="unstyled text-primary">
										<li>Invoice Number	: <strong>INVOICE-$orderID</strong></li>
										<li>Invoice Date		: <strong>$orderDate2</strong></li>
										<li class="text-danger">Invoice Status	: <strong>$payStatus</strong></li>									   
                                  </ul>
								</div>
							  
							</div>
						  
							<!-- table -->
							<div class="table-responsive">
							<table class="table table-responsive table-striped table-hover">
                              <thead>
                              <tr>
                                  <th class='text-left'>#</th>
                                  <th class='text-left'>Item</th>
                                  <th class='text-left'>Description</th>
                                  <th class='text-left'>Unit Cost</th>
                                  <th class='text-left'>Quantity</th>
                                  <th class='text-left'>Total</th>
								  
                              </tr>
                              </thead>
                              <tbody> 

		
IGWEZE;
							echo $cartHead;
						
							$total = 0; $serialCount = 0;
							$productItem = ""; $productDesc = "";
			
							foreach($_SESSION["ecart_session"] as $product){ 
						
								try { 
						
									$productID = $product["code"];
									$productData =  productInfo($conn, $productID);  /* school products information*/
								
								}catch(PDOException $e) {

									fobrainDie( 'Ooops Database Error: ' . $e->getMessage());

								}
								
								list ($p_id, $p_title, $p_date, $p_price, $p_description) = explode ("@(.$*S*$.)@", $productData);
								
								$titleEn =  cleanMultiLang($p_title);
								$titleEn = str_replace(" ", "-", $titleEn);
								
								$productLink = $p_id.'-'.$titleEn; 
								 
								$product_name = $product["name"];
								$product_price = $product["price"];
								$product_qty = $product["qty"];
								$product_code = $product["code"]; 
												
								$subtotal = ($product["price"] * $product["qty"]);
								$total = ($total + $subtotal);
								$subtotalS = number_format($subtotal, 2);
								
								/* insert product order information */ 
								
								$ebele_mark_1 = "INSERT INTO $fobrainOrderSummTB  (order_id, product_id, qty, price)

												 VALUES (:order_id, :product_id, :qty, :price)";

								$igweze_prep_1 = $conn->prepare($ebele_mark_1);
								$igweze_prep_1->bindValue(':order_id', $orderID);
								$igweze_prep_1->bindValue(':product_id', $product_code);
								$igweze_prep_1->bindValue(':qty', $product_qty);
								$igweze_prep_1->bindValue(':price', $product_price);
								
								if($igweze_prep_1->execute()){
					
$cartBody =<<<IGWEZE

									<tr id="cOut-$productID">
										 <td class='text-left'>1</td>
										 <td class='text-left'>$product_name</td>
										 <td class='text-left' >$p_title</td>
										 <td class='text-left'>$curSymbol$p_price  </td>
										 <td class='text-left'>$product_qty </td>
										 
										 <td class='text-left'> $curSymbol$subtotalS</td>
										 
									</tr> 
		
IGWEZE;
									echo $cartBody;
								
								}
					
							}
							
							$grand_total = number_format($total, 2);
						
$cardTail =<<<IGWEZE

							</tbody>
							</table>						  
							<!-- / table -->  
							</div>
							
							<!-- row -->	
							<div class="row">
                              <div class="col-lg-7 invoice-block pull-left mt-20">
							  
								<section class="panel bank-div">
								<header class="panel-heading text-left  fs-13">
									Our Bank Details
								</header>
									<div class="panel-body fobrain-line text-left" style="font-weight:bold"> 
								  
										<p class=" text-primary fs-13"> You can make payment for your order/s through our bank details below with Invoice 
										No : <strong>INVOICE-$orderID</strong> </p>
										<div class=" text-info fs-13"> 
											Name - $bankAccount <br>
											Account - $accno  <br>
											Bank - $bank  
										</div>
								  
									</div> 
								</section> 
								  
							</div> 
							
							<div class="col-lg-5 invoice-block pull-right mt-20">
								<ul class="unstyled amounts fs-13">
									<li class=" text-danger"><strong>Sub - Total  :</strong> $curSymbol$grand_total </li>
									<li class=" text-danger"><strong>VAT :</strong> -----</li>
									<li class=" text-primary"><strong>Grand Total :</strong> $curSymbol$grand_total </li>
								</ul>
                            </div> 
							  
							</div>
							<!-- / row -->	
							<div class="text-center invoice-btn mb-30">                              
                              <a class="btn btn-info btn-lg printer-icon"><i class="fa fa-print"></i> Print Invoice </a>
							</div> 
					 
						</div>
						</section>
						<!-- invoice end -->	

IGWEZE;
						
						echo $cardTail; 
					
						unset($_SESSION["ecart_session"]); // hidePageLoader(); $('#cart-info').html(''); $('.shopping-cart-box').fadeOut(); 
						
						unset($_SESSION['transRefNo']);
				
						unset($_SESSION['errTransRefNo']); 
					
						$updateCart = "<i class='fa fa-shopping-cart' style='color:#fff;'></i>";
						
						if($paymentStatus == $seVal){ $bankDiv = "$('.bank-div').fadeOut(100);";}
						else{$bankDiv = "";}
					
						echo "<script type='text/javascript'>  
					
							var emptyCart = 'emptyCart';
							$('#cart-info').load('e-cart.php', {'cartData':emptyCart});
							$('.cart-box').click();  
							//$('#mallLoader').fadeOut(3000); 
							$bankDiv
						</script>";
					
				}else{  /* display error */  
							
					$msg_e = "Oooooooooop Error, you transaction was unsuccessful. Please try again."; 
					echo $errorMsg.$msg_e.$eEnd; exit;
					
				}	
					
			}catch(PDOException $e) {
					
				fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
					 
			}						

		}else{ 
			
			echo $userNavPageError; exit;  /* else exit or redirect to 404 page */

		}	
		
exit;	
?>	