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
	This script handle shopping cart
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

    define('fobrain', 'igweze');  /* define a check for wrong access of file */

        require 'fobrain-config.php';  /* load fobrain configuration files */ 

		if(isset($_POST["load_cart"]) && $_POST["load_cart"]==1){  /* load cart information */ 

			if(isset($_SESSION["ecart_session"]) && count($_SESSION["ecart_session"])>0){
			 
				$cart_box = '<ul class="cart-products-loaded font-size-13">';
				$total = 0;
				
				foreach($_SESSION["ecart_session"] as $product){ /* loop though items and prepare html content */
			
					try { 
			
						$productID = $product["code"];
						$productData =  productInfo($conn, $productID);  /* school products information*/
					
					}catch(PDOException $e) {

						fobrainDie( 'Ooops Database Error: ' . $e->getMessage());

					}
					
					list ($pID, $p_title, $p_date, $p_price, $p_description) = explode ("@(.$*S*$.)@", $productData);
					
					$titleEn =  cleanMultiLang($p_title);
					$titleEn = str_replace(" ", "-", $titleEn);
					
					$productLink = $pID.'-'.$titleEn;
					
					$product_price = ($product["price"] * $product["qty"]);
					$product_price = number_format($product_price, 2);
					
					$product_name = $product["name"];
					if(strlen($product_name) >= 11){
						$product_name = substr($product_name, 0, 11).".";
					}
			
					$cart_box .=  '<li> 
						<div class="row align-items-center">
							<div class="col text-primary">
								<i class="fa fa-cart-plus"></i> ' . $product_name. ' (Qty : ' . $product["qty"]. ')  <br/><br/><span class="text-danger">' 
								. $curSymbol. $product_price . '<span>
							</div>
							<div class="col-auto">	
							 
								<a href="javascript:;" class="remove-item icon-red cart-t-btn hide-res" data-code="'.$product["code"].'"><i class="fa fa-times fs-14"></i></a>
								<a href="javascript:;" class="editProduct icon-tem-color cart-t-btn hide-res" id="fobrain-'.$pID.'-'.$product["qty"].'"><i class="fa fa-edit fs-14"></i></a>
							 
							</div>
						</div>
					</li>';
					$subtotal = ($product["price"] * $product["qty"]);
					$total = ($total + $subtotal);
					//'.$productLink.'
				}
			
				$product_total = number_format($total, 2);
			
				$cart_box .= "</ul>";
				$cart_box .= '<div class="cart-products-total font-size-13 text-danger"> <i class="fa fa-cart-plus"></i>  Total : '.$curSymbol.$product_total.' </div>
				
				<div class="p-5 border-top d-grid">
                    <a class="btn btn-sm btn-link font-size-14 text-center check-out" href="javascript:;" title="Review Cart and Check-Out">
                        <i class="mdi mdi-arrow-right-circle me-1"></i> <span>Check Out</span> 
                    </a>
                </div>';
				
				die($cart_box); /* exit and display content */
				
			}else{
				die('<div class="cart-products-total font-size-13">Your Cart is empty</div>');   /* display error */
			}
	
		} 
		
		if(isset($_REQUEST["remove_code"]) && isset($_SESSION["ecart_session"])){  /* remove item from shopping cart */ 		
			
    		$product_code   = strip_tags($_REQUEST["remove_code"]);  
   			
			$product = array();
			
			foreach ($_SESSION["ecart_session"] as $cart_itm){  /* loop array */
     
				if($cart_itm["code"]!= $product_code){ /* item do not exist in the list */
				
            		$product[] = array('name'=>$cart_itm["name"], 'code'=>$cart_itm["code"], 'qty'=>$cart_itm["qty"], 'price'=>$cart_itm["price"]);
				}
				
				$_SESSION["ecart_session"] = $product;
			
			}
						
 			echo $total_items = count($_SESSION["ecart_session"]);
			
			$msg_s = "Your item was successfully deleted"; 
			echo $succesMsg.$msg_s.$sEnd; 
							
			//die(json_encode(array('items'=>$total_items)));
		}

		if(isset($_POST["quantity"]) && isset($_POST["product_code"])){  /* add item to shopping cart */ 		

			$product_code = strip_tags($_POST["product_code"]); //product code
			$product_qty = strip_tags($_POST["quantity"]); //product quantity
			$product = array();
			$found 	= false;
			/* fetch item from database using product code */
			$statement = $mysqli_conn->prepare("SELECT p_title, p_price FROM $fobrainProductTB WHERE pID=? LIMIT 1");
			$statement->bind_param('s', $product_code);
			$statement->execute();
			$statement->bind_result($product_name, $product_price);
	
			while($statement->fetch()){  /* loop array */

				$new_product = array( array('name'=> $product_name, 'price'=> $product_price, 'code'=>$product_code, 'qty'=>$product_qty)); 
				//prepare new product
				if(isset($_SESSION["ecart_session"])) {
				
            		foreach ($_SESSION["ecart_session"] as $cart_itm){  /* loop array */
            	 
						if($cart_itm["code"] == $product_code){ /* if item found in the list, update with new quantity */
						
							$product[] = array('name'=>$cart_itm["name"], 'code'=>$cart_itm["code"], 'qty'=>$product_qty, 
							'price'=> $cart_itm["price"]);
                    		$found = true;
							
						}else{ /* else continue with other items */
							
							$product[] = array('name'=>$cart_itm["name"], 'code'=>$cart_itm["code"], 'qty'=>$cart_itm["qty"], 'price'=> $cart_itm["price"]);
							
						}
					}
					if(!$found){ /* we did not find item, merge new product to list */
					
						$_SESSION["ecart_session"] = array_merge($product, $new_product);
						
					 }else{
					 
						$_SESSION["ecart_session"] = $product; //create new product list
					}
				
				}else{ /* if there's no session variable, create new */
					$_SESSION["ecart_session"] = $new_product;
					//die(json_encode(array('items'=>1)));
				}
			}
	 
			echo $total_items = count($_SESSION["ecart_session"]);  
			
			$msg_s = "Your item was successfully save"; 
			echo $succesMsg.$msg_s.$sEnd;			
		
			//count items in variable
			//die(json_encode(array('items'=>$total_items))); //exit script outputing json data
	
$script =<<<IGWEZE

			<script type="text/javascript">	  $("#product-btn-$product_code").fadeIn(300);  </script>
		
IGWEZE;
			echo $script;

		
	
		}
		
		if(isset($_REQUEST["cartData"]) == "emptyCart"){  /* emty shopping cart */ 				
			
			echo '0'; 
			
		}
