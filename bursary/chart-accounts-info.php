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
	This script handle school accs category information
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

	define('fobrain', 'igweze');  /* define a check for wrong access of file */ 

	require 'fobrain-config.php';  /* load fobrain configuration files */
	
	try {
	
		$chartAccountDataArr = chartAccountData($conn);  /* school chart account array */
		$chartAccountDataCount = count($chartAccountDataArr);
		
	}catch(PDOException $e) {
	
			fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
		
	}	
	
	

		 
?> 
		<script type='text/javascript'>  
			renderTB('wiz-table2');			
		</script>
 
		<div class="table-responsive">
			<!-- table -->
			<table  class='table table-hover table-responsive style-table wiz-table2'>
			
				<thead>
					<tr>
						<th>S/N</th> 
						<th>Account</th> 
						<th>Account Type</th> 
						<th>Statement Type</th>
						<th>Statement Group</th>
						<!--<th>Balance</th>-->
						<th>Status</th>
						<th>Tasks</th>
					</tr>
				</thead> 
				<tbody>


        <?php
						
				if($chartAccountDataCount >= $fiVal){  /* check array is empty */	
						
					for($i = $fiVal; $i <= $chartAccountDataCount; $i++){	
					
						$cid = $chartAccountDataArr[$i]["cid"];
						$chartAccount = $chartAccountDataArr[$i]["acc"];
						$acc_type = $chartAccountDataArr[$i]["acc_type"];
						$st_type = $chartAccountDataArr[$i]["st_type"];
						$st_group = $chartAccountDataArr[$i]["st_group"];
						$balance = $chartAccountDataArr[$i]["balance"];
						$cstatus = $chartAccountDataArr[$i]["cstatus"];
						
						$balance = fobrainCurrency($balance, $curSymbol);  /* school currency information*/

						$chartAccount = trim($chartAccount); 

						$acc_type = wizSelectArray($acc_type, $account_type_arr);
						$st_type = wizSelectArray($st_type, $account_state_arr);
						$st_group = wizSelectArray($st_group, $acc_group_arr2);
						$cstatus = wizSelectArray($cstatus, $onOffArr);

						$serial_no++;  

$chartAccountData =<<<IGWEZE
        
						<tr id="row-$cid">
							<td>$serial_no</td> 
							<td>$chartAccount</td>  				
							<td>$acc_type</td>
							<td>$st_type</td>
							<td>$st_group</td>
							<!--<td>$balance</td>-->									
							<td> $cstatus</td>	
							<td> 
								<div class="btn-group">
									<a href="javascript:;" class="btna btn-tasks  waves-effect waves-light dropdown-toggle p-5" data-bs-toggle="dropdown" aria-haspopup="true"
									data-bs-display="static" aria-expanded="false">
										<i class="mdi mdi-dots-grid align-middle fs-18"></i>
									</a> 
									<div class="dropdown-menu dropdown-menu-lg-end p-10 dropdown-shadow end-0 animate__animated animate__flipInY"> 
										 
										<p class="mb-10">
											<a href='javascript:;' id='$cid' class ='edit-chart-acc text-slateblue btn waves-effect btn-label waves-light'>									
												<i class="mdi mdi-square-edit-outline label-icon"></i> Edit
											</a>	
										</p>
										<p>
											<a href='javascript:;' id='fobrain-$cid-$chartAccount' class ='remove-chart-acc text-danger btn waves-effect btn-label waves-light demo-disenable'>									
												<i class="mdi mdi-delete label-icon"></i> Delete
											</a>	
										</p> 
									</div>
								</div>   												
							</td>
						</tr>
		
IGWEZE;
                               
						echo $chartAccountData; 

					} 
						
				}
		
	?>
					
				</tbody>
			</table>				
			<!-- / table -->
		</div>		