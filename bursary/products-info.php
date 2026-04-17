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
	
	try {
	
		$productsDataArr = productsData($conn);  /* school products array */
		$productsDataCount = count($productsDataArr);
		
	}catch(PDOException $e) {
	
			fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
		
	}		

		 
?>
			<script type='text/javascript'> renderTable(); </script>
			<div class="table-responsive">
				<!-- table -->
				<table  class='table table-hover table-responsive style-table wiz-table'>
					<thead>
						<tr>
							<th>S/N</th> 
							<th>Category</th> 
							<th>Title</th> 
							<th>Price</th> 
							<th>Date</th> 
							<th>Status</th> 
							<th>Tasks</th>
						</tr>
					</thead> 
					<tbody>


<?php
					
					if($productsDataCount >= $fiVal){  /* check array is empty */		
																					
						for($i = $fiVal; $i <= $productsDataCount; $i++){  /* loop array */	
						
							$productID = $productsDataArr[$i]["pID"];
							$cat_id = $productsDataArr[$i]["cat_id"];
							$price = $productsDataArr[$i]["p_price"];
							$p_title = htmlspecialchars_decode($productsDataArr[$i]["p_title"]);
							$p_description = htmlspecialchars_decode($productsDataArr[$i]["p_description"]);
							$p_status = $productsDataArr[$i]["p_status"];
							$p_date = $productsDataArr[$i]["p_date"];
							
							$productCategoryInfoArr = productCategoryInfo($conn, $cat_id);  /* school products category information */
							$productCategory = $productCategoryInfoArr[$fiVal]['product'];
							
							$productID = trim($productID);									
							$pStatus = $productStatusArr[$p_status];						
							
							$p_date = date("j M Y", strtotime($p_date));
							
							$price = fobrainCurrency($price, $curSymbol);  /* school currency information*/								
				
							$serial_no++;
							

$productsData =<<<IGWEZE
	
							<tr id="row-$productID">
								<td>$serial_no</td> 
								<td> $productCategory </td> 
								<td> $p_title  </td> 
								<td> $price</td> 						
								<td> $p_date </td> 		
								<td> $pStatus </td> 									
								<td> 
									<div class="btn-group">
										<a href="javascript:;" class="btna btn-tasks  waves-effect waves-light dropdown-toggle p-5" data-bs-toggle="dropdown" aria-haspopup="true"
										data-bs-display="static" aria-expanded="false">
											<i class="mdi mdi-dots-grid align-middle fs-18"></i>
										</a> 
										<div class="dropdown-menu dropdown-menu-lg-end p-10 dropdown-shadow end-0 animate__animated animate__flipInY"> 
											<p class="mb-10">
												<a href='javascript:;' id='$productID' class ='view-product text-sienna btn waves-effect btn-label waves-light'>									
													<i class="mdi mdi-text-box-search label-icon"></i> View 
												</a>	
											</p>
											<p class="mb-10">
												<a href='javascript:;' id='$productID' class ='edit-product text-slateblue btn waves-effect btn-label waves-light'>									
													<i class="mdi mdi-square-edit-outline label-icon"></i> Edit
												</a>	
											</p>
											<p>
												<a href='javascript:;' id='fobrain-$productID-$productCategory' class ='remove-product text-danger btn waves-effect btn-label waves-light'>									
													<i class="mdi mdi-delete label-icon"></i> Delete
												</a>	
											</p> 
										</div>
									</div>   						
								</td>
							</tr>
	
IGWEZE;
							
							echo $productsData; 

						} 
							
					} 
?>
					
					
				</tbody>
			</table>
			<!-- / table -->
		</div>
					