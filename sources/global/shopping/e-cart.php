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
	This script load product information
	------------------------------------------------------------------------*/ 


		if (!defined('fobrain')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
				
		require_once $fobrainIconPage; /* This include top middle global icon page eg go back, print buttons etcs */ 
		 
		try {
		 
			$productCategoryDataArr = productCategoryData($conn);   /* school products category array */
			$productCategoryDataCount = count($productCategoryDataArr);
				
		}catch(PDOException $e) {
  			
			fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			 
		}		
		 
?>            

			<!-- row --> 
			<div <?php echo $fob_view; ?> class="row gutters row-section shop" id="shopping-mall">
				<div class="col-lg-9 col-md-12 mb-50">
					<div class="card card-shadow">	 
						<?php 
							$page_title = '<i class="mdi mdi mdi-cart-variant fs-18"></i> 
							e Shop';
							pageTitle($page_title, 0);	 
						?>					 
						<div class="card-body"> 							 	
							<div id="wiz-cart-div">
							  
								<?php
									
									if ((isset($_REQUEST['shopData'])) &&  ($_REQUEST['shopData'] == 'vProduct') && ($_REQUEST['pID'] >= $fiVal)){
										$shopData = '';	
										require_once 'load-products.php';   /* include cart product script */								
										
									}elseif ((isset($_REQUEST['shopData'])) && ($_REQUEST['shopData'] == 'cOut')){   /* include product checkout script */
											
										require_once 'check-out.php';								
										
									}else{	
										
										$shopData = 'sProduct'; $slide_item = false;
										require_once 'load-products.php';	   /* include cart product script */					
									
									}
						
								?> 
								  
							</div>								
						</div>
					</div>
				</div>					
				<div class="col-lg-3 col-md-12">
					<div class="card card-shadow">					
						<div class="card-header-wiz">
							<h4>
								<i class="fas fa-list-ol fs-16"></i> 
								Categories
							</h4>
						</div>
					 
						<div class="card-body shop"> 
							<ul class="categories">

<?php
						
							if($productCategoryDataCount >= $fiVal){  /* check array is empty */	 
								
								for($i = $fiVal; $i <= $productCategoryDataCount; $i++){  /* loop array */	
								
									$pID = $productCategoryDataArr[$i]["p_id"];
									$productCategory = $productCategoryDataArr[$i]["product"];
									
									$productCategory = trim($productCategory);

$proCat =<<<IGWEZE
        
									<li>
										<a href='javascript:;' class='shopCategory' id='fobrain-$pID'>
											<i class="fa fa-angle-right"></i> $productCategory 
										</a>
									</li>
		
IGWEZE;
                               
									echo $proCat;
								
								}
						
							}else{  /* display information message */
							
								$msg_i = "* Ooops, this category is emtpy";
								echo $infoMsg.$msg_i.$iEnd;  
						
							}	 
								
?>												
												
							</ul> 			  
						</div>
					</div>
				</div>
			</div>
			<!-- / row --> 


 

					 			  	
				