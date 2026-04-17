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
	This script loads shopping cart products
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

     	define('fobrain', 'igweze');  /* define a check for wrong access of file */  

        require 'fobrain-config.php';  /* load fobrain configuration files */ 

		if ($shopData == 'sProduct') {  /* load products */  
				
			try {

				$productsDataArr = productsData($conn);  /* select products array */
				$productsDataCount = count($productsDataArr); 
				
				if($productsDataCount >= $fiVal){  /* check array is empty */	 
					
					if($slide_item == false){
						
						echo '<div class="row">';
					}
					
					for($i = $fiVal; $i <= $productsDataCount; $i++){  /* loop array */	

						$productID = $productsDataArr[$i]["pID"];
						$cat_id = $productsDataArr[$i]["cat_id"];
						$price = $productsDataArr[$i]["p_price"];
						$p_title = htmlspecialchars_decode($productsDataArr[$i]["p_title"]);
						$p_description = htmlspecialchars_decode($productsDataArr[$i]["p_description"]);
						$p_status = $productsDataArr[$i]["p_status"];
						$p_date = $productsDataArr[$i]["p_date"];
						
						$productCategoryInfoArr = productCategoryInfo($conn, $cat_id);  /* select products category information */
						$productCategory = $productCategoryInfoArr[$fiVal]['product'];
						
						$productID = trim($productID);
						
						$pStatus = $productStatusArr[$p_status];								
						
						$p_date = date("j M Y", strtotime($p_date));
						
						$price = fobrainCurrency($price, $curSymbol);  /* school currency information*/
						
						$productID = trim($productID);
						
						$pictureArr = productPictureArr($conn, $productID);  /* select products picture array */
						$pVal = array_rand($pictureArr);	
						$pic = $pictureArr[$pVal]['picture'];									
						
						$picture = picture($fobrainProductDir, $pic, "cart");
						 	
						if($slide_item == true){
							$slide_class = "carousel-item"; 
							$view_class = " class='pro-title editProduct'  id='njideka-$productID-0'";
							$resp_div  = "";
							if($i == 1){
								$active = "active";
							}else{ $active = ""; }		
						}else{
							
							$slide_class = "";
							$active = "";
							$resp_div = "col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 mb-20";
							$view_class = " class='pro-title view-item'  id='njideka-$productID'";
						}	
									
									
$proCatTop =<<<IGWEZE
        

							<div class="$slide_class $active $resp_div">
								<div class="card-product">
									<div class="card-img">
										<img src="$picture" alt="Product" class="img-responsive" />
									</div>
									<div class="product-item">
										<div class="price fs-13">
											<span>$price</span>
										</div>
										<div class="title-product">
											<h3>
												<a href='javascript:;' $view_class>$p_title</a>
											</h3>
										</div>
										<div class="category">
											<p>Category : $productCategory</p>
										</div>
										<div class="product-footer">											 
											<span class="add-to-cart"> 
												<select class="p-qty pro-select item-left">

IGWEZE;
                               
												echo $proCatTop;
								
								
												for($qtyVal = $fiVal; $qtyVal <= $tenVal; $qtyVal++){  /* loop array */	 
												
													if ($qtyV == $qtyVal){
														$selected = "SELECTED";
													} else {
														$selected = "";
													}

													echo '<option value="'.$qtyVal.'"'.$selected.'>'.$qtyVal.'</option>' ."\r\n"; 
												
												}								
								

$proCatBot =<<<IGWEZE


												</select>  
												<input class="p-code" type="hidden" value="$productID"> 													
												<a href="javascript:;" class="buy-btn item-right"  id="product-btn-$productID" title="Update Cart">
													<i class="mdi mdi-cart-plus"></i>
												</a> 
											</span>
										</div>
									</div>
								</div>
							</div>

							
											 
IGWEZE;
                               
		                  	echo $proCatBot; 
								
						
					}
					if($slide_item == false){
						echo '</div>';
					}
				}else{  /* display information message */  	
							
					$msg_i = "* Ooops, school product is emtpy";
					echo $infoMsg.$msg_i.$iEnd; 

				}	
								
			}catch(PDOException $e) {
						
				fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
						 
			} 	 
					 	
			echo "<script type='text/javascript'>   hidePageLoader(); </script>";

		}elseif ($_REQUEST['shopData'] == 'vCategory') {  /* load product category */  
				
				$catID = strip_tags($_REQUEST['catID']); 
				
				/* script validation */ 
				
				if ($catID == ""){
         			
					$msg_e = "* Ooops, an error has occur while to retrieve product category information. Please try again";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
					
	   			}else{  /* select information */
				
					try {
					 
						$productCategoryArr = productCategory($conn, $catID);  /* school products category information*/
						$productCategoryCount = count($productCategoryArr); 
	
						if($productCategoryCount >= $fiVal){  /* check array is empty */ 
							echo '<div class="row">';
							for($i = $fiVal; $i <= $productCategoryCount; $i++){  /* loop array */	
							
								$productID = $productCategoryArr[$i]["pID"];
								$cat_id = $productCategoryArr[$i]["cat_id"];
								$price = $productCategoryArr[$i]["p_price"];
								$p_title = htmlspecialchars_decode($productCategoryArr[$i]["p_title"]);
								$p_description = htmlspecialchars_decode($productCategoryArr[$i]["p_description"]);
								$p_status = $productCategoryArr[$i]["p_status"];
								$p_date = $productCategoryArr[$i]["p_date"];
								
								$productCategoryInfoArr = productCategoryInfo($conn, $cat_id);  /* school products category information */
								$productCategory = $productCategoryInfoArr[$fiVal]['product'];
								$productID = trim($productID);
								
								$pictureArr = productPictureArr($conn, $productID);  /* school products pictures */
								$pVal = array_rand($pictureArr);	
								$pic = $pictureArr[$pVal]['picture']; 
								
								$pStatus = $productStatusArr[$p_status];	 
								$p_date = date("j M Y", strtotime($p_date));								
								$price = fobrainCurrency($price, $curSymbol);  /* school currency information*/								
								$picture = picture($fobrainProductDir, $pic, "cart");
									

$proCatTop =<<<IGWEZE
        
							
							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 mb-20">
								<div class="card-product">
									<div class="card-img">
										<img src="$picture" alt="Product" class="img-responsive" />
									</div>
									<div class="product-item">
										<div class="price fs-13">
											<span>$price</span>
										</div>
										<div class="title-product">
											<h3>
												<a href="javascript:;" class="pro-title view-item" 
												id="njideka-$productID">$p_title</a>
											</h3>
										</div>
										<div class="category">
											<p>Category : $productCategory</p>
										</div>
										<div class="product-footer">											 
											<span class="add-to-cart"> 
												<select class="p-qty pro-select item-left"> 
															
						
IGWEZE;
                               
												echo $proCatTop;
								
								
												for($qtyVal = $fiVal; $qtyVal <= $tenVal; $qtyVal++){  /* loop array */	 
												
													if ($qtyV == $qtyVal){
														$selected = "SELECTED";
													} else {
														$selected = "";
													}

													echo '<option value="'.$qtyVal.'"'.$selected.'>'.$qtyVal.'</option>' ."\r\n"; 
												
												}								
								

$proCatBot =<<<IGWEZE


											</select>  
											<input class="p-code" type="hidden" value="$productID"> 													
											<a href="javascript:;" class="buy-btn item-right"  id="product-btn-$productID" title="Update Cart">
												<i class="mdi mdi-cart-plus"></i>
											</a> 
										</span>
									</div>
								</div>
							</div>  							
												 		

IGWEZE;					                             
		                  		echo $proCatBot; 
								
							}
						echo '</div>';
						}else{  /* display information message */ 
							
							$msg_i = "* Ooops, this category is emtpy";
							echo $infoMsg.$msg_i.$iEnd;  
						
						}
						
					}catch(PDOException $e) {
						
						fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
						 
					}	 

				}
				
				echo "<script type='text/javascript'>  hidePageLoader(); </script>";

		}elseif ($_REQUEST['shopData'] == 'vProduct') {  /* load a product details */  

				
				$pID = strip_tags($_REQUEST['pID']);
				$qtyV = strip_tags($_REQUEST['qtyV']);
				
				if($_REQUEST['eProduct'] == true){ $stopLoader = " hidePageLoader(); "; $lableBtn = "Update <span class='hide-res'>Cart<span>";}
				else {$stopLoader  = ""; $lableBtn = "Add <span class='hide-res'>to Cart<span>"; } 
				
				/* script validation */ 
				
				if ($pID == ""){
         			
					$msg_e = "* Ooops error, could not retrieve product information";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>  $stopLoader  $('#editLoader').fadeOut(1500); </script>";exit;
					
	   			}else{  /* select information */
				
					try {
					 
						$productsInfoArr = productsInfo($conn, $pID);  /* school products information*/
						$productID = $productsInfoArr[$fiVal]["pID"];
						$proID = $productsInfoArr[$fiVal]["cat_id"];
						$p_price = $productsInfoArr[$fiVal]["p_price"];
						$p_title = htmlspecialchars_decode($productsInfoArr[$fiVal]["p_title"]);
						$p_description = htmlspecialchars_decode($productsInfoArr[$fiVal]["p_description"]);
						$p_status = $productsInfoArr[$fiVal]["p_status"];
						$p_date = $productsInfoArr[$fiVal]["p_date"];
						
						$productID = trim($productID);									
							
						$productCategoryInfoArr = productCategoryInfo($conn, $proID);  /* school products category information */
						$productCategory = $productCategoryInfoArr[$fiVal]['product'];
															
						$pStatus = $productStatusArr[$p_status];		
						$p_date = date("j F Y", strtotime($p_date));									
						$price = fobrainCurrency($p_price, $curSymbol);  /* school currency information*/									
						$p_description = nl2br($p_description);
						
						$pictureArr = productPictureArr($conn, $productID);  /* school products pictures */
						$pictureCount = count($pictureArr); 
						
						$rand_keys = array_rand($pictureArr, $pictureCount);

						$fiPic = $pictureArr[$rand_keys[0]]['picture']; 						
						$sePic = $pictureArr[$rand_keys[1]]['picture']; 
						$thPic = $pictureArr[$rand_keys[2]]['picture']; 
						$foPic = $pictureArr[$rand_keys[3]]['picture']; 
						$fifPic = $pictureArr[$rand_keys[4]['picture']];  

						$fiPicture = picture($fobrainProductDir, $fiPic, "cart");
						$sePicture = picture($fobrainProductDir, $sePic, "cart");
						$thPicture = picture($fobrainProductDir, $thPic, "cart");
						$foPicture = picture($fobrainProductDir, $foPic, "cart");
						$fifPicture = picture($fobrainProductDir, $fifPic, "cart"); 									
									
$productInfoTop =<<<IGWEZE

						<div class="card-shadow  p-20">
						<div class="row">
							<div class="col-md-5 animate fadeInLeft">
							
								<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
									<div class="carousel-inner" role="listbox">
										<div class="carousel-item active product-slider">
											<img class="d-block img-fluid mx-auto" src="$fiPicture" alt="First slide">
										</div>
										<div class="carousel-item product-slider">
											<img class="d-block img-fluid mx-auto" src="$sePicture" alt="Second slide">
										</div>
										<div class="carousel-item product-slider">
											<img class="d-block img-fluid mx-auto" src="$thPicture" alt="Third slide">
										</div>
									</div>
									<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-bs-slide="prev">
										<span class="carousel-control-prev-icon" aria-hidden="true"></span>
										<span class="sr-only">Previous</span>
									</a>
									<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-bs-slide="next">
										<span class="carousel-control-next-icon" aria-hidden="true"></span>
										<span class="sr-only">Next</span>
									</a>
								</div><!-- end carousel -->									 
							</div>
							<div class="col-md-7 animate fadeInRight">
								<div class="product-detail-description">
									<h2 class="text-primary">$p_title</h2>
									
									<p class="price big text-danger">$price</p> 
									<p>$p_description </p>
									<div class="item-counter clearfix">
										<div class="add-to-cart">
											<select class="p-qty pro-select"> 
						 
						
IGWEZE;
                               
										echo $productInfoTop;
								
								
										for($qtyVal = $fiVal; $qtyVal <= $tenVal; $qtyVal++){  /* loop array */								
								
											if ($qtyV == $qtyVal){
												
												$selected = "SELECTED"; 
												
											} else {
												$selected = "";
											}

											echo '<option value="'.$qtyVal.'"'.$selected.'>'.$qtyVal.'</option>' ."\r\n"; 
								
										}
								

$productInfoBot =<<<IGWEZE

										
									
										</select> 				 
										<input class="p-code" type="hidden" value="$productID">  
										<button type="submit" id="product-btn-$productID" title="Update Cart"
										class="btn btn-primary btn-label waves-light">
											<i class="fas fa-shopping-cart label-icon"></i> $lableBtn 
										</button>		
									 
										<div class="clearfix"></div>
																
										<p class="mt-10 text-danger"><strong>Categories:</strong>  $productCategory</p>
										</div>
									</div>
								</div>
							</div>
						</div> 

						<div class="row my-50">
							<div class="col-md-3">
								<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
								<a class="nav-link mb-2 active" id="v-pills-home-tab" data-bs-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Decription</a>
								<a class="nav-link mb-2" id="v-pills-profile-tab" data-bs-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Reviews</a>
								<a class="nav-link mb-2" id="v-pills-messages-tab" data-bs-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Messages</a> 
								</div>
							</div><!-- end col -->
							<div class="col-md-9">
								<div class="tab-content text-muted mt-4 mt-md-0" id="v-pills-tabContent">
									<div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
										<p>$p_description</p> 
									</div>
									<div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
										<p class="text-danger">Coming Soon</p> 
									</div>
									<div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
										<p class="text-danger">Coming Soon</p> 
									</div> 
								</div>
							</div><!--  end col -->
						</div><!-- end row -->
						</div><!-- end row -->
						

						
						
IGWEZE;
                               
							echo $productInfoBot; 
						
						
					}catch(PDOException $e) {
						
						fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
						 
					}	 
						 

				} 
				
				echo "<script type='text/javascript'>  $stopLoader  hidePageLoader(); </script>";

		}else{			
			
			echo $userNavPageError; exit;  /* else exit or redirect to 404 page */

		}	
		
//exit;	
?>	
