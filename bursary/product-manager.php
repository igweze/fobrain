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
	This script handle school product information
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

		define('fobrain', 'igweze');  /* define a check for wrong access of file */

		require 'fobrain-config.php';  /* load fobrain configuration files */
				
		if ($_REQUEST['product'] == 'save') {  /* save product */

			
			$proID = cleanInt($_REQUEST['cat_id']);
			$p_title =  strip_tags($_REQUEST['title']);
			$p_description = $_REQUEST['p_description'];
			$p_price = strip_tags($_REQUEST['p_price']);
			$p_status = cleanInt($_REQUEST['p_status']);
			$pDay = $_REQUEST['pDay'];
			
			/* script validation */
			
			if ($proID == "")  {
				
				$msg_e = "* Ooops Error, please select product category";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($p_title == "")  {
				
				$msg_e = "* Ooops Error, please enter product title";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($p_price == "")  {
				
				$msg_e = "* Ooops Error, please enter product price";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($p_description == "")  {
				
				$msg_e = "* Ooops Error, please enter product details";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($p_status == "")  {
				
				$msg_e = "* Ooops Error, please select a product status";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($pDay == "")  {
				
				$msg_e = "* Ooops Error, please select a product date";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}else {  /* insert information */   
				
					$p_description = strip_tags($p_description);
					$p_title = strip_tags($p_title);
					$p_description = str_replace('<br />', "\n", $p_description);
					$p_description = htmlspecialchars($p_description);
					$p_title = htmlspecialchars($p_title);


				try {
					
					
					$ebele_mark = "INSERT INTO $fobrainProductTB  (cat_id, p_price, p_title, p_status, p_description, p_date)

							VALUES (:cat_id, :p_price, :p_title, :p_status, :p_description, :p_date)";
					
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':cat_id', $proID);
					$igweze_prep->bindValue(':p_price', $p_price);
					$igweze_prep->bindValue(':p_title', $p_title);
					$igweze_prep->bindValue(':p_status', $p_status);
					$igweze_prep->bindValue(':p_description', $p_description);
					$igweze_prep->bindValue(':p_date', $pDay); 
					
					if($igweze_prep->execute()){ 

						$productID = $conn->lastInsertId($fobrainProductTB); 
			
$uploadManager =<<<IGWEZE

						 
						<!-- form -->
						<form method="POST" class="form-horizontal" id="frmproductPic" role="form"  enctype="multipart/form-data" 
						action="product-manager.php"> 

							<!-- row -->					
							<div class="row gutters">
								<div class="col-12">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<input type="text" class="form-control" placeholder="<?php echo $p_title; ?>" 
										name="title"  id="title" value="<?php echo $p_title; ?>" disabled>
										<div class="field-placeholder"> Product Title <span class="text-danger">*</span></div>													
									</div>
									<!-- field wrapper end -->													 													
								</div>																 
							</div>	
							<!-- /row --> 

							<!-- row -->					
							<div class="row gutters">
								<div class="col-12 text-center"> 
									<!-- file-wrapper start -->
									<div class="file-wrapper">
										<label class="upload-img-div">
											<i class="mdi mdi-cloud-upload-outline fs-30 text-danger"></i> 
											<input type="file" name="productPic" id="productPic" class="form-control hide">
										</label> 
										<div class="form-text"> 
											<input type="hidden" name="productID" value="$productID">
											<input type="hidden" name="product" value="upload" /> 
											<div class="fs-14 fw-600 mb-10">Upload Picture</div>
											<div class="text-danger">Only max image size of 2MB &amp; format of <?php echo $allowedPicExt; ?> are allowed.</div>
										</div>
									</div>
									<!-- file-wrapper end -->  
								</div>	 														 
							</div>	
							<!-- /row --> 								   
						</form>
						
						<!-- form -->
	
IGWEZE;
			

						$msg_s = "Your product was successfully saved. Please upload product pictures below"; 
						echo $succesMsg.$msg_s.$sEnd; 
						echo $uploadManager;
						echo "<script type='text/javascript'> 
							$('#load-product').load('products-info.php'); 
							$('#frmsaveProducts')[0].reset(); 
							$('#frmsaveProducts').fadeOut(1500);
							hidePageLoader();  
							</script>";exit;
						
					}else{  /* display error */
			
						$msg_e =  "Ooops, an error has occur while to save product. Please try again";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
						
					}
					

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				}
		
			}
		
		}elseif ($_REQUEST['product'] == 'update') {  /* update product */

			$pID = cleanInt($_REQUEST['pID']);			
			$proID = cleanInt($_REQUEST['cat_id']);
			$p_title =  strip_tags($_REQUEST['title']);
			$p_description = $_REQUEST['p_description'];
			$p_price = strip_tags($_REQUEST['p_price']);
			$p_status = cleanInt($_REQUEST['p_status']);
			$pDay = $_REQUEST['pDay'];
			
			/* script validation */ 
			
			if ($pID == ""){
				
				$msg_e = "* Ooops, aan error has occur to retrieve product information. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($proID == "")  {
				
				$msg_e = "* Ooops Error, please select product category";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($p_title == "")  {
				
				$msg_e = "* Ooops Error, please enter product title";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($p_price == "")  {
				
				$msg_e = "* Ooops Error, please enter product price";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($p_description == "")  {
				
				$msg_e = "* Ooops Error, please select product details";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($p_status == "")  {
				
				$msg_e = "* Ooops Error, please select a product status";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($pDay == "")  {
				
				$msg_e = "* Ooops Error, please select a product p_date";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}else {  /* update information */  
				
				$p_description = strip_tags($p_description);
				$p_title = strip_tags($p_title);
				$p_description = str_replace('<br />', "\n", $p_description);
				$p_description = htmlspecialchars($p_description);
				$p_title = htmlspecialchars($p_title); 

				try {						
					
					$ebele_mark = "UPDATE $fobrainProductTB  
										
										SET 
										
										cat_id = :cat_id, 
										p_price = :p_price, 
										p_title = :p_title,
										p_status = :p_status,		
										p_description = :p_description,
										p_date = :p_date
										
									WHERE pID = :pID";
					
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':pID', $pID);
					$igweze_prep->bindValue(':cat_id', $proID);
					$igweze_prep->bindValue(':p_price', $p_price);
					$igweze_prep->bindValue(':p_title', $p_title);
					$igweze_prep->bindValue(':p_status', $p_status);
					$igweze_prep->bindValue(':p_description', $p_description);
					$igweze_prep->bindValue(':p_date', $pDay); 
					
					if($igweze_prep->execute()){  /* if sucessfully */ 
						
						$msg_s = "School Product was successfully saved."; 
						echo $succesMsg.$msg_s.$sEnd; 
						echo "<script type='text/javascript'> 
							$('#load-product').load('products-info.php');  
							hidePageLoader(); 
						</script>"; exit;
						
					}else{  /* display error */ 
			
						$msg_e =  "Ooops, an error has occur while to save product. Please try again";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
						
					}
					

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				} 
		
			}
		
		}elseif ($_REQUEST['product'] == 'remove') {  /* remove product */
			
			$product = $_REQUEST['rData'];
			$adminPass =   clean($_REQUEST['adminPass']);  

			$checkDetail =  staffLoginData($conn, $_SESSION['adminUser']);  /* school staffs/teachers password details */ 			 
			list ($tID, $staffUser, $checkedPass, $staffName, $staff_fobrain_grdQ, $userGrade, $userAccess) = 
			explode ("@(.$*S*$.)@", $checkDetail);
			
			list($fobrainIg, $pID, $hName) = explode("-", $product);			
			
			/* script validation */ 
			
			if (($product == "")  || ($pID == "")){
				
				$msg_e = "* Ooops, an error has occur while to remove product information. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif(!password_verify($adminPass, $userAccess)){ 		 
		 
				$msg_e = "* Ooops error, your admin authorization password is invalid.";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;

			}else {  /* remove information */      	

				try { 
					
					$ebele_mark = "DELETE FROM 
					
									$fobrainProductTB										
										
									WHERE pID = :pID
										
									LIMIT 1";
					
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':pID', $pID); 
					
					if($igweze_prep->execute()){  /* if sucessfully */
						
						$removeDiv = "$('#row-".$pID."').fadeOut(1000);";
						$msg_s = "<strong>$hName</strong> was successfully removed"; 
						echo $succesMsg.$msg_s.$sEnd; 
						echo "<script type='text/javascript'>   
								$removeDiv 
								hidePageLoader();
							</script>";exit;
						
					}else{  /* display error */
			
						$msg_e =  "Ooops, an error has occur while to remove product information. Please try again";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
						
					}

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				} 
		
			}
		
		}elseif ($_REQUEST['product'] == 'view') {  /* view product */
			
			$pID = strip_tags($_REQUEST['rData']);
			
			/* script validation */
			
			if ($pID == ""){
				
				$msg_e = "* Ooops, an error has occur while to retrieve product information. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}else {       			


				try {						
					
					$productsInfoArr = productsInfo($conn, $pID);  /* school products information*/
					$productID = $productsInfoArr[$fiVal]["pID"];
					$proID = $productsInfoArr[$fiVal]["cat_id"];
					$p_price = $productsInfoArr[$fiVal]["p_price"];
					$p_title = htmlspecialchars_decode($productsInfoArr[$fiVal]["p_title"]);
					$p_description = htmlspecialchars_decode($productsInfoArr[$fiVal]["p_description"]);
					$p_status = $productsInfoArr[$fiVal]["p_status"];
					$p_date = $productsInfoArr[$fiVal]["p_date"];						
							
					$productCategoryInfoArr = productCategoryInfo($conn, $proID);  /* school products category information */
					$productCategory = $productCategoryInfoArr[$fiVal]['product'];						
					
					$pStatus = $productStatusArr[$p_status];						
					
					$p_date = date("j F Y", strtotime($p_date));						
					$price = fobrainCurrency($p_price, $curSymbol);  /* school currency information*/						
					$p_description = nl2br($p_description);
								

$showProduct =<<<IGWEZE
	
					<div class="row gutters mb-10">
							<div class="text-end">
								<button  class="btn btn-primary" onclick="printDiv('fobrain-print-ovly')">
									<i class="fas fa-print"></i>  
								</button>
							</div>	
						</div>
							 
						<div id = 'fobrain-print-ovly'>

							<!-- table -->	
							<table  class="table table-view table-hover table-responsive"> 
							<tr>
								<th style="padding-left: 30px; text-align:left; width: 40%;">
									Product Category 
								</th> 
								<td style="padding-left: 30px; text-align:left; width: 60%;">
									$productCategory
								</td> 
							</tr>
							<tr>
								<th style="padding-left: 30px; text-align:left; width: 40%;">
									Product Title 
								</th> 
								<td style="padding-left: 30px; text-align:left; width: 60%;">
									$p_title  
								</td> 
							</tr>
							<tr>
								<th style="padding-left: 30px; text-align:left; width: 40%;">
									Product Price
								</th> 
								<td style="padding-left: 30px; text-align:left; width: 60%;">
									$price
								</td> 
							</tr>
							<tr>
								<th style="padding-left: 30px; text-align:left; width: 40%;">
									Product Details 
								</th> 
								<td style="padding-left: 30px; text-align:left; width: 60%;">
									$p_description
								</td> 
							</tr>
							<tr>
								<th style="padding-left: 30px; text-align:left; width: 40%;">
									Product Date 
								</th> 
								<td style="padding-left: 30px; text-align:left; width: 60%;">
									$p_date
								</td> 
							</tr>
							<tr>
								<th style="padding-left: 30px; text-align:left; width: 40%;">
									Product Status 
								</td> 
								<td style="padding-left: 30px; text-align:left; width: 60%;">
									$pStatus
								</td> 
							</tr>
							<tr>
								<th style="text-align:center; width: 100%;" colspan="2">
									Product Picture/s 
								</th>  
							</tr> 								
						</table>
						<!-- table -->
					</div>
	
	
	
IGWEZE;
			
					echo $showProduct;
								
					/* select product picture */
						
					$ebele_mark = "SELECT pic_id, picture
					
									FROM $fobrainProductPicTB
									
									WHERE p_id = :p_id";
							
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':p_id', $productID);				 
					$igweze_prep->execute();
					
					$rows_count = $igweze_prep->rowCount(); 
					
					if($rows_count >= $fiVal) {  /* check result is empty */
						
						echo '<div class="row gutters">';
					
						while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {  /* loop array */	
			
							$picID = $row['pic_id'];
							$picture = $row['picture'];
							
							echo "<div class='col-lg-6 mb-10' id = 'picDiv_".$picID."'>
								<img src="."'".$fobrainProductDir.$picture."' class='img-thumbnail img-fluid'> 
							</div>";
							
						} 
						
					} 	
									
						echo '</div>'; 
					
					echo "<script type='text/javascript'>  hidePageLoader(); </script>"; exit; 
					

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				} 
			
		
			}
		
		}elseif ($_REQUEST['product'] == 'upload') {  /* upload product picture */				
			
			$productID = $_REQUEST['productID'];
			$time = strtotime(date("Y-m-d H:i:s"));

			$picturePath = $fobrainProductDir; /* picture path */
			
			$filePic = "productPic"; /* picture file name */
			$pageDesc = "your product picture";
			
			/* call igweze file uploader */
			$uploadPicData = igwezeFileUploader($filePic, $picturePath, ($oneMB * 2), $validPicExt, 
			$validPicType, $allowedPicExt, $fileType = "Picture", $fiVal);
				
			if (is_array($uploadPicData['error'])) {  /* check if any upload error */
					
				$msg_e = '';
					
				foreach ($uploadPicData['error'] as $msg) {
					$msg_e .= $msg.'<br />';     /* display error messages */
				}
				
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>"; exit; 
				
				
			} else {
				
				$uploadedPic = $uploadPicData['refilename']; /* uploaded picture file */
				
				if ($uploadedPic != "") {
						
					if (move_uploaded_file($_FILES[$filePic]['tmp_name'], $picturePath.$uploadedPic )) { /* move uploaded file to its path */
							
						try { 

							$ebele_mark = "INSERT INTO $fobrainProductPicTB(p_id, picture)

														VALUES (:p_id, :picture)";

							$igweze_prep = $conn->prepare($ebele_mark);
							$igweze_prep->bindValue(':p_id', $productID);
							$igweze_prep->bindValue(':picture', $uploadedPic);	 
								
							if ($igweze_prep->execute()) {  /* if sucessfully */

								$uploadedPicID = $conn->lastInsertId($fobrainProductPicTB); 

								echo "<div id = 'picDiv_".$uploadedPicID."' class='col-lg-6 mb-10'>
									<span class = 'remProductPic' position: relative; top:16px; right:5px; 
										cursor:pointer;'  id= 'fobrain-".$uploadedPicID."'>
										<i class='fas fa-times fs-22 text-danger'></i>
									</span>
									<img src="."'".$fobrainProductDir.$uploadedPic."' class='img-thumbnail img-fluid' 
									height = '180px' > 
								</div>";

								$msg_s = "Picture was successfully Uploaded.."; 
								echo $succesMsg.$msg_s.$sEnd; 
								echo "<script type='text/javascript'> hidePageLoader(); </script>"; exit; 
									
							}else{  /* display error */
								
								$msg_e = "Ooops, product picture was not successfully uploaded. Please try again";
								echo $errorMsg.$msg_e.$eEnd; 
								echo "<script type='text/javascript'> hidePageLoader(); </script>"; exit; 
				
							}	 

						}catch(PDOException $e) {
							
							fobrainDie( 'Ooops Database Error: ' . $e->getMessage());

						}
							
							
					}else{ /* display error messages */
						
						$msg_e = "Ooops, an error has occur while trying to save $pageDesc. Please try again or check your network connection!!!";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'> hidePageLoader(); </script>"; exit; 
							
					}
						
				}else{ /* display error messages */
					
					$msg_e = "Ooops, an error has occur while trying to save $pageDesc. Please try again or check your network connection!!!";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'> hidePageLoader(); </script>"; exit; 					

				}	
				
				
			} 	  
			
			echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;	 			
		
		}elseif ($_REQUEST['product'] == 'remove-pic') {  /* remove product picture */
			
			
			$pictureID = cleanInt($_REQUEST['pictureID']);
			$pictureID = trim($pictureID);
			
			/* script validation */
			
			if ($pictureID == "")  {
				
				$msg_e = "* Ooops Error, could not retrieve picture infomation. Please try again.";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>  $('#save-loader').fadeOut(1000); </script>";exit;
				
			}else{  /* remove picture */  
						
				$ebele_mark = "SELECT picture
				
								FROM $fobrainProductPicTB
								
								WHERE pic_id = :pic_id";
						
				$igweze_prep = $conn->prepare($ebele_mark);
				$igweze_prep->bindValue(':pic_id', $pictureID);						 
				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count == $fiVal) {  /* check select is empty */
								
					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {  /* loop array */		
		
						$picture = $row['picture'];
					
						$picDel = $fobrainProductDir.$picture;
										
					}
					
					$ebele_mark_1 = "DELETE
				
									FROM $fobrainProductPicTB
									
									WHERE pic_id = :pic_id
									
										LIMIT 1";
							
					$igweze_prep_1 = $conn->prepare($ebele_mark_1);
					$igweze_prep_1->bindValue(':pic_id', $pictureID);	 
					
					if($igweze_prep_1->execute()){  /* if sucessfully */
						
						if(file_exists($picDel)){ unlink($picDel); }								
						
						$picDiv = '#picDiv_'.$pictureID;
						$msg_s = "Picture was successfully deleted."; 
						echo $succesMsg.$msg_s.$sEnd; 
						
						echo "<script type='text/javascript'> 
								$('$picDiv').fadeOut(1000);  
								$('#save-loader').fadeOut(1000);  									
							</script>";exit;
						
					}else{  /* display error */								
						
						$msg_e = "Ooops, could not remove picture."; 
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'>  $('#save-loader').fadeOut(1000);  </script>";exit;								
						
					}
					
				}else{  /* display error */								
					
					$msg_e = "Ooops, could not find picture."; 
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;

				}	 
			
			}	
				
			
		}elseif ($_REQUEST['product'] == 'edit') {  /* edit product */ 
			
			$pID = strip_tags($_REQUEST['rData']);
			
			/* script validation */
			
			if ($pID == ""){
				
				$msg_e = "* Ooops, an error has occur while to retrieve product information. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}else {    

				try { 
					
					$productsInfoArr = productsInfo($conn, $pID);  /* school products information*/
					$productID = $productsInfoArr[$fiVal]["pID"];
					$proID = $productsInfoArr[$fiVal]["cat_id"];
					$p_title = htmlspecialchars_decode($productsInfoArr[$fiVal]["p_title"]);
					$p_description = htmlspecialchars_decode($productsInfoArr[$fiVal]["p_description"]);
					$p_status = $productsInfoArr[$fiVal]["p_status"];
					$price = $productsInfoArr[$fiVal]["p_price"];
					$p_date = $productsInfoArr[$fiVal]["p_date"]; 
					
?>

					<!-- form -->
					<form class="form-horizontal" id="frmupdateProducts" role="form"> 

						<!-- row -->
						<div class="row gutters">
							<div class="col-12">										
								<!-- field wrapper start -->
								<div class="field-wrapper select-wrapper">
									<select class="form-control fob-select"  id="pCategory" name="cat_id" required>
										<option value = "">Search . . . . >>>></option>
										<?php

											try {

												$productCategoryDataArr = productCategoryData($conn);   /* school products category array */
												$productCategoryDataCount = count($productCategoryDataArr);

											}catch(PDOException $e) {

												fobrainDie( 'Ooops Database Error: ' . $e->getMessage());

											}		

											if($productCategoryDataCount >= $fiVal){  /* check array is empty */

												for($i = $fiVal; $i <= $productCategoryDataCount; $i++){  /* loop array */	

													$pID = $productCategoryDataArr[$i]["p_id"];
													$productCategory = $productCategoryDataArr[$i]["product"];

													$productCategory = trim($productCategory); 

													if ( $pID == $proID){
														$selected = "SELECTED";
													} else {
														$selected = "";
													}

													echo '<option value="'.$pID.'"'.$selected.'>
													'.$productCategory.'</option>' ."\r\n";

												}
												
											}else{

												echo '<option value="">Ooops Error, could not find product category.</option>' ."\r\n";

											}	 

										?> 

									</select>
									<div class="icon-wrap"  id="wait" style="display: none;">
										<i class="loader"></i>
									</div>
									<div class="field-placeholder">   Category <span class="text-danger">*</span></div>													
								</div>
								<!-- field wrapper end -->													 													
							</div>																 
						</div>	
						<!-- /row --> 

						<!-- row -->					
						<div class="row gutters">
							<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">								
								<!-- field wrapper start -->
								<div class="field-wrapper">
									<input type="text" class="form-control" placeholder="Enter Product Title" 
									name="title"  id="title" value="<?php echo $p_title; ?>">
									<div class="field-placeholder">   Title <span class="text-danger">*</span></div>													
								</div>
								<!-- field wrapper end -->													 													
							</div>																 
						 
							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">									
								<!-- field wrapper start -->
								<div class="field-wrapper">
									<input type="number" class="form-control" placeholder="Price " 
									name="p_price"  id="p_price" value = "<?php echo $price; ?>" required>
									<div class="field-placeholder"> Price  <span class="text-danger">*</span></div>													
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
									<textarea rows="4" cols="10" class="form-control" name="p_description" id="p_description" 
									placeholder="Product Details eg Bank Name, Teller ID, Cheque ID, Card 
									Type" required><?php echo $p_description; ?></textarea>
								<div class="field-placeholder">   Details <span class="text-danger">*</span></div>													
								</div>
								<!-- field wrapper end -->													 													
							</div>																 
						</div>	
						<!-- /row -->  

						<!-- row -->
						<div class="row gutters">
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">									
								<!-- field wrapper start -->
								<div class="field-wrapper">
									<input type="date" value="<?php echo $p_date; ?>" name="pDay"  required />
									<div class="field-placeholder">  Date <span class="text-danger">*</span></div>													
								</div>
								<!-- field wrapper end -->
							</div>																 
						 
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">										
								<!-- field wrapper start -->
								<div class="field-wrapper">
									<select class="form-control fob-select"  id="p_status" name="p_status" required>
										<option value = "">Please select One</option>
										<?php 

											foreach($productStatusArr as $statusKey => $statusVal){  /* loop array */

												if ($p_status == $statusKey){

													$selected = "SELECTED";

												} else {

													$selected = "";

												}

												echo '<option value="'.$statusKey.'"'.$selected.'>'.$statusVal.'</option>' ."\r\n";

											}

										?> 

									</select> 
									<div class="field-placeholder">  Status <span class="text-danger">*</span></div>													
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
								<input type="hidden" name="product" value="update" />
								<input type="hidden" name="pID" value="<?php echo $productID; ?>" />
								<button type="submit" class="btn btn-primary waves-effect   
								btn-label waves-light" id="updateProducts">
									<i class="mdi mdi-content-save label-icon"></i>  Update  
								</button>
							</div>
						</div>	
						<!-- /row -->		 

					</form> 
					<!-- / form --> 	
										
					
					<?php
							
							
			
$uploadManager =<<<IGWEZE

						<hr class="mt-50 mb-30 text-danger" />
						<!-- form -->
						<form method="POST" class="form-horizontal" id="frmproductPic" role="form"  enctype="multipart/form-data" 
						action="product-manager.php">  
						<!-- row -->					
							<div class="row gutters">
								<div class="col-12 text-center"> 
									<!-- file-wrapper start -->
									<div class="file-wrapper">
										<label class="upload-img-div">
											<i class="mdi mdi-cloud-upload-outline fs-30 text-danger"></i> 
											<input type="file" name="productPic" id="productPic" class="form-control hide">
										</label> 
										<div class="form-text"> 
											<input type="hidden" name="productID" value="$productID">
											<input type="hidden" name="product" value="upload" /> 
											<div class="fs-14 fw-600 mb-10">Upload Picture</div>
											<div class="text-danger">Only max image size of 2MB &amp; format of <?php echo $allowedPicExt; ?> are allowed.</div>
										</div>
									</div>
									<!-- file-wrapper end -->  
								</div>																 
							</div>	
							<!-- /row --> 									 
						</form>
						<!-- / form -->

						<script type="text/javascript">	  
							$('.fob-select').each(function() {  
								renderSelect($('#'+this.id)); 
							});
						</script>
	
IGWEZE;


						echo  $uploadManager;
						echo '<div class="row gutters mt-10 mb-50">';

						$ebele_mark = "SELECT pic_id, picture
						
										FROM $fobrainProductPicTB
										
										WHERE p_id = :p_id";
								
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':p_id', $productID);				 
						$igweze_prep->execute();
						
						$rows_count = $igweze_prep->rowCount(); 
						
						if($rows_count >= $fiVal) {  /* check select is empty */
						
							while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {  /* loop array */		
				
								$picID = $row['pic_id'];
								$picture = $row['picture'];
								
								echo "<div id = 'picDiv_".$picID."' class='col-lg-6 mb-10'>
									<span class = 'remProductPic' style='position: relative; top:16px; right:5px; 
										cursor:pointer;'  id= 'fobrain-".$picID."'>
										<i class='fas fa-times fs-22 text-danger'></i>
									</span>
									<img src="."'".$fobrainProductDir.$picture."' class='img-thumbnail img-fluid' 
									height = '180px' > 
								</div>";	 
							
							}
															
						}	
						echo '<div id="msg-box-pic"></div>
						</div>';
						echo '
							<div class="text-center" id="save-loader" style="display: none;">
								<div class="spinner-border text-danger" role="status">
									<span class="visually-hidden">Loading...</span>
								</div>
							</div>';

						echo "<script type='text/javascript'>   hidePageLoader(); </script>"; exit;  

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				} 
		
			}
		
		}elseif ($_REQUEST['product'] == 'add') {
?> 

			<div class="row gutters">
				<div id="msg-box-pic"></div>
			</div>

			<!-- form -->
			<form class="form-horizontal mt-10 mb-70" id="frmsaveProducts"> 
				<!-- row -->
				<div class="row gutters">
					<div class="col-12">										
						<!-- field wrapper start -->
						<div class="field-wrapper select-wrapper">	

							<select class="form-control fob-select"  id="pCategory" name="cat_id" required>

								<option value = "">Search . . . . >>>></option>

								<?php 

									try {

										$productCategoryDataArr = productCategoryData($conn);   /* school products category array */
										$productCategoryDataCount = count($productCategoryDataArr);

									}catch(PDOException $e) {

										fobrainDie( 'Ooops Database Error: ' . $e->getMessage());

									}		

									if($productCategoryDataCount >= $fiVal){  /* check array is empty */	 

										for($i = $fiVal; $i <= $productCategoryDataCount; $i++){  /* loop array */	

											$pID = $productCategoryDataArr[$i]["p_id"];
											$productCategory = $productCategoryDataArr[$i]["product"];

											$productCategory = trim($productCategory); 

											echo '<option value="'.$pID.'"'.$selected.'>
											'.$productCategory.'</option>' ."\r\n";

										}
									}else{

										echo '<option value="">Ooops Error, could not find product category.</option>' ."\r\n"; 

									}	 

								?> 
							</select> 
							<div class="icon-wrap"  id="wait" style="display: none;">
								<i class="loader"></i>
							</div>
							<div class="field-placeholder">  Category <span class="text-danger">*</span></div>													
						</div>
						<!-- field wrapper end -->
					</div> 
			 
					<span id="result" style="display: none;"></span><!-- loading div -->

				</div>	
				<!-- /row --> 
					
				<div id="productDetailsDiv" style="display:none;">

					<div class="text-center" id="wait_1" style="display: none;">
						<div class="spinner-border text-danger" role="status">
							<span class="visually-hidden">Loading...</span>
						</div>
					</div>													 
					<span id="result_1" style="display: none;"></span> <!-- loading div --> <!-- loading div --> 			

					<!-- row -->
					<div class="row gutters">
						<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">										
							<!-- field wrapper start -->
							<div class="field-wrapper">
								<input type="text" class="form-control" placeholder="Enter Product Title" 
								name="title"  id="title" required>
								<div class="field-placeholder">   Title <span class="text-danger">*</span></div>													
							</div>
							<!-- field wrapper end -->
						</div>																 
					 
						<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">										
							<!-- field wrapper start -->
							<div class="field-wrapper">
								<input type="number" class="form-control" placeholder="Price" 
								name="p_price"  id="p_price" required>
								<div class="field-placeholder">   Price <span class="text-danger">*</span></div>													
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
								<textarea rows="4" cols="10" class="form-control" name="p_description" id="p_description" 
								placeholder="Enter Product Details" required></textarea>
								<div class="field-placeholder">  Details <span class="text-danger">*</span></div>													
							</div>
							<!-- field wrapper end -->
						</div>																 
					</div>	
					<!-- /row -->

					<!-- row -->
					<div class="row gutters">
						<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">									
							<!-- field wrapper start -->
							<div class="field-wrapper">
								<input type="date" name="pDay"  required />
								<div class="field-placeholder">  Date  <span class="text-danger">*</span></div>													
							</div>
							<!-- field wrapper end -->
						</div>																 
					 
						<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">								
							<!-- field wrapper start -->
							<div class="field-wrapper">
								<select class="form-control fob-select"  id="p_status" name="p_status" required>
									<?php 

										foreach($productStatusArr as $statusKey => $statusVal){  /* loop array */

											if ($fiVal == $statusKey){

												$selected = "SELECTED";

											} else {

												$selected = "";

											}

											echo '<option value="'.$statusKey.'"'.$selected.'>'.$statusVal.'</option>' ."\r\n";

										}

									?> 
									</select>
								<div class="field-placeholder">   Status <span class="text-danger"></span></div>													
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
							<input type="hidden" name="product" value="save" />  
							<button type="submit" class="btn btn-primary waves-effect   
							btn-label waves-light" id="saveProducts">
								<i class="mdi mdi-content-save label-icon"></i>  Save  
							</button>
						</div>
					</div>	
					<!-- /row -->										
								
				</div>									
			</form>
			<!-- / form -->		 

			<script type="text/javascript">	 
				$('.fob-select').each(function() {  
					renderSelect($('#'+this.id)); 
				});
				hidePageLoader(); 
			</script>

<?php			
			
		}else{ 
		
			echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
		
		} 
	
		
exit;

?>