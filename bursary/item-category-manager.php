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
	This script handle product category
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

		define('fobrain', 'igweze');  /* define a check for wrong access of file */

		require 'fobrain-config.php';  /* load fobrain configuration files */
				
		if ($_REQUEST['productCat'] == 'save') {  /* save product category */ 
			
			$productCategory = clean($_REQUEST['product']);
			
			$regDate = strtotime(date("Y-m-d H:i:s"));
			
			/* script validation */ 
			
			if ($productCategory == "")  {
				
				$msg_e = "* Ooops Error, please enter new product category name";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader();</script>";exit;
				
			}else {  /* insert information */      			


				try {
					
					
					$ebele_mark = "INSERT INTO $productCategoryTB  (product)

							VALUES (:product)";
					
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':product', $productCategory); 
					
					if($igweze_prep->execute()){  /* if sucessfully */
						
						$msg_s = "<strong>$productCategory</strong> product was successfully saved"; 
						echo $succesMsg.$msg_s.$sEnd; 
						echo "<script type='text/javascript'> 
								$('#load-item-category').load('item-category-info.php'); 
								$('#frmsaveProductCategory')[0].reset();
								hidePageLoader(); 
							</script>"; exit;
						
					}else{  /* display error */ 
			
						$msg_e =  "Ooops, an error has occur while to add new product category. Please try again";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'> hidePageLoader();</script>";exit;
						
					}
					
				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				}          		
		
			}
		
		}elseif ($_REQUEST['productCat'] == 'update') {  /* update product category */ 
			
			$productCategory = clean($_REQUEST['product']);
			$pID = cleanInt($_REQUEST['pID']);		
			$status = cleanInt($_REQUEST['status']);	
			
			/* script validation */ 
			
			if ($pID == ""){
				
				$msg_e = "* Ooops, an error has occur while to save product category information. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($productCategory == "")  {
				
				$msg_e = "* Ooops Error, please enter new product category name";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}else {  /* update information */    

				try { 
					
					$ebele_mark = "UPDATE $productCategoryTB
									
									SET 
									
										product = :product,
										status = :status
										
										WHERE p_id = :p_id";
					
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':product', $productCategory);
					$igweze_prep->bindValue(':status', $status);
					$igweze_prep->bindValue(':p_id', $pID); 
					
					if($igweze_prep->execute()){  /* if sucessfully */ 
						
						$msg_s = "<strong>$productCategory</strong> was successfully saved"; 
						echo $succesMsg.$msg_s.$sEnd; 
						echo "<script type='text/javascript'> 
								$('#load-item-category').load('item-category-info.php');
								hidePageLoader(); 
							</script>"; exit;
						
					}else{  /* display error */
			
						$msg_e =  "Ooops, an error has occur while to save product category. Please try again";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
						
					}

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				} 
		
			}
		
		}elseif ($_REQUEST['productCat'] == 'remove') {  /* remove product category */

			
			$productCat = $_REQUEST['rData'];
			
			list($fobrainIg, $pID, $hName) = explode("-", $productCat);			
			
			/* script validation */ 
			
			if (($productCat == "")  || ($pID == "")){
				
				$msg_e = "* Ooops, an error has occur while to remove product category. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}else {   /* update information */     	 

				try { 
					
					$ebele_mark = "UPDATE $productCategoryTB
									
									SET 										
										status = :status
										
										WHERE p_id = :p_id";
					
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':status', $i_false);
					$igweze_prep->bindValue(':p_id', $pID); 
					
					if($igweze_prep->execute()){  /* if sucessfully */							
						//$removeDiv = "$('#row-".$pID."').fadeOut(1000);";
						$msg_s = "<strong>$hName</strong> was successfully Disenable"; 
						echo $succesMsg.$msg_s.$sEnd; 
						echo "<script type='text/javascript'>   
									$('#load-item-category').load('item-category-info.php'); 
									hidePageLoader(); 	
							</script>";exit;							
					}else{  /* display error */
			
						$msg_e =  "Ooops, an error has occur while to remove product category. Please try again";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
						
					}

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				} 
		
			}
		
		}elseif ($_REQUEST['productCat'] == 'edit') {  /* edit product category */

			$pID = strip_tags( $_REQUEST['rData']);
			
			/* script validation */ 
			
			if ($pID == ""){
				
				$msg_e = "* Ooops, an error has occur while to retrieve product category information. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}else {   /* select information */     			


				try {
					
					
					$productCategoryInfoArr = productCategoryInfo($conn, $pID);  /* school products category information */
					$productCategory = $productCategoryInfoArr[$fiVal]['product']; 
					$status = $productCategoryInfoArr[$fiVal]['status'];


$productCategoryFrm =<<<IGWEZE
	
					<!-- form --> 
					<form class="form-horizontal" id="frmupdateProductCategory" role="form"> 

						<!-- row -->
						<div class="row gutters">
							<div class="col-12">										
								<!-- field wrapper start -->
								<div class="field-wrapper">
									<input type="text"  id="product" name="product" value="$productCategory" class="form-control"  required style="text-transform:Capitalize;">
									<div class="field-placeholder">Product Item Category<span class="text-danger">*</span></div>													
								</div>
								<!-- field wrapper end -->
							</div>									 
						</div>	
						<!-- /row --> 

						<!-- row -->
						<div class="row gutters">
							<div class="col-12">										
								<!-- field wrapper start -->
								<div class="field-wrapper">			
									<select class="form-control"  name="status" required>
																			
	
IGWEZE;
	
									echo $productCategoryFrm;
											
									foreach($onOffArr as $status_key => $status_value){  /* loop array */

										if ($status == $status_key){
											$selected = "SELECTED";
										} else {
											$selected = "";
										}

										echo '<option value="'.$status_key.'"'.$selected.'>'.$status_value.'</option>' ."\r\n";

									}	     	
	
$productCategoryFormBot =<<<IGWEZE
	
	
									</select>

									<div class="field-placeholder"> Category Status <span class="text-danger">*</span></div>													
								</div>
								<!-- field wrapper end -->
							</div>																 
						</div>	
						<!-- /row -->


						<hr class="mt-30 mb-15 text-danger" />
						<!-- row -->
						<div class="row gutters modal-btn-footer">
							<div class="col-6 text-start">
								<button type="button" id="close-modal" class="btn btn-danger close-modal" 
								data-bs-dismiss="modal"> <i class="mdi mdi-window-close label-icon"></i> Close</button>
							</div>
							<div class="col-6 text-end">
								<input type="hidden" name="productCat" value="update" />
								<input type="hidden" name="pID" value="$pID" />
								<button type="submit" class="btn btn-primary waves-effect   
								btn-label waves-light" id="updateProductCategory">
									<i class="mdi mdi-content-save label-icon"></i>  Update
								</button>
							</div>
						</div>	
						<!-- /row -->	 	

							
								
					</form> 
					<!-- / form -->
	
IGWEZE;
							
						echo $productCategoryFormBot;														
							
							
						echo "<script type='text/javascript'> hidePageLoader(); </script>"; exit;
					
					

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				} 
			
		
			}
		
		}elseif ($_REQUEST['productCat'] == 'add') { 

?>
			<!-- form -->
			<form class="form-horizontal mt-10" id="frmsaveProductCategory"> 
				<!-- row -->
				<div class="row gutters">
					<div class="col-12">										
						<!-- field wrapper start -->
						<div class="field-wrapper">
							<input type="text"  id="product" name="product"  class="form-control"  required style="text-transform:Capitalize;">
							<div class="field-placeholder">Product Category<span class="text-danger">*</span></div>													
						</div>
						<!-- field wrapper end -->
					</div>									 
				</div>	
				<!-- /row --> 

				<hr class="mt-30 mb-15 text-danger" />
				<!-- row -->
				<div class="row gutters modal-btn-footer">
					<div class="col-6 text-start">
						<button type="button" id="close-modal" class="btn btn-danger close-modal" 
						data-bs-dismiss="modal"> <i class="mdi mdi-window-close label-icon"></i> Close</button>
					</div>
					<div class="col-6 text-end">
						<input type="hidden" name="productCat" value="save" /> 
						<button type="submit" class="btn btn-primary waves-effect   
						btn-label waves-light" id="saveProductCategory">
							<i class="mdi mdi-content-save label-icon"></i>  Save
						</button>
					</div>
				</div>	
				<!-- /row -->	 
				 							
			</form>
			<!-- / form -->		

			<script type='text/javascript'> hidePageLoader(); </script>

<?php
			
		}else{ 
		
			echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
		
		}


	
		
exit;

?>