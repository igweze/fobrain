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
	This script handle school fees category information
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

	define('fobrain', 'igweze');  /* define a check for wrong access of file */ 

	require 'fobrain-config.php';  /* load fobrain configuration files */
	
	try {
	
		$feeCategoryDataArr = feeCategoryData($conn);  /* school fee category array */
		$feeCategoryDataCount = count($feeCategoryDataArr);
		
	}catch(PDOException $e) {
	
			fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
		
	}		

	$account_name = ""; 
?> 
			
		<script type='text/javascript'> renderTable(); </script>
		<div class="table-responsive">
			<!-- table -->
			<table  class='table table-hover table-responsive style-table wiz-table'>
			
				<thead>
					<tr>
						<th>S/N</th> 
						<!--<th>Link Account (Balance)</th>-->
						<th>Category</th> 
						<th>Price</th> 
						<th>Status</th>
						<th>Tasks</th>
					</tr>
				</thead> 
				<tbody>


        <?php
						
				if($feeCategoryDataCount >= $fiVal){  /* check array is empty */	
						
					for($i = $fiVal; $i <= $feeCategoryDataCount; $i++){	
					
						$fID = $feeCategoryDataArr[$i]["f_id"];
						$feeCategory = $feeCategoryDataArr[$i]["fee"];
						$amount = $feeCategoryDataArr[$i]["amount"];
						$account = $feeCategoryDataArr[$i]["account"];
						$status = $feeCategoryDataArr[$i]["status"];

						//$account_name = accountName2($conn, $account);
						
						$feeCategory = trim($feeCategory);
						$amount = trim($amount);
						$status = trim($status);
						$status = $onOffArr[$status];

						$amount = fobrainCurrency($amount, $curSymbol);

						$serial_no++;  

$feeCategoryData =<<<IGWEZE
        
						<tr id="row-$fID">
							<td>$serial_no</td> 
							<!--<td>$account_name</td>-->
							<td>$feeCategory </td> 				
							<td>$amount</td>										
							<td> $status</td>	
							<td> 
								<div class="btn-group">
									<a href="javascript:;" class="btna btn-tasks  waves-effect waves-light dropdown-toggle p-5" data-bs-toggle="dropdown" aria-haspopup="true"
									data-bs-display="static" aria-expanded="false">
										<i class="mdi mdi-dots-grid align-middle fs-18"></i>
									</a> 
									<div class="dropdown-menu dropdown-menu-lg-end p-10 dropdown-shadow end-0 animate__animated animate__flipInY"> 
										 
										<p class="mb-10">
											<a href='javascript:;' id='$fID' class ='edit-fee-c text-slateblue btn waves-effect btn-label waves-light'>									
												<i class="mdi mdi-square-edit-outline label-icon"></i> Edit
											</a>	
										</p>
										<p>
											<a href='javascript:;' id='fobrain-$fID-$feeCategory' class ='remove-fee-c text-danger btn waves-effect btn-label waves-light demo-disenable'>									
												<i class="mdi mdi-delete label-icon"></i> Delete
											</a>	
										</p> 
									</div>
								</div>   												
							</td>
						</tr>
		
IGWEZE;
                               
						echo $feeCategoryData; 

					} 
						
				}
		
	?>
					
				</tbody>
			</table>				
			<!-- / table -->
		</div>		