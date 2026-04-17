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
	This script handle school SMS gateway information
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

	define('fobrain', 'igweze');  /* define a check for wrong access of file */

	require 'fobrain-config-s.php';  /* load fobrain configuration files */
	
	try {
	
		$smsDataArr = smsData($conn);  /* text message and gateway array  */ 
		$smsDataCount = count($smsDataArr);
		
	}catch(PDOException $e) {
	
		fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
		
	}		 
 
	
?> 

		<script type='text/javascript'>  renderTable(); </script>
		<div class="table-responsive">
			<!-- table -->
			<table class='table table-hover table-responsive style-table wiz-table' id="wiz-table">			
				<thead>
					<tr>
					<th>S/N</th> 
					<th>GateWay</th> 
					<th>Sender Name</th> 
					<th>User Name</th> 
					<th>Password</th> 
					<th>Api</th> 
					<th>Balance</th> 
					<th>Status</th> 
					<th>Tasks</th>
					</tr>
				</thead> 
				<tbody> 

        	<?php
						
				if($smsDataCount >= $fiVal){															
					
					$serial_no = 0;

					for($i = $fiVal; $i <= $smsDataCount; $i++){	
					
						$sID = $smsDataArr[$i]["sID"];
						$user = $smsDataArr[$i]["user"];
						$gateway = $smsDataArr[$i]["gateway"];
						$senderID = $smsDataArr[$i]["senderID"];
						$password = htmlspecialchars_decode($smsDataArr[$i]["password"]);
						$api = $smsDataArr[$i]["api"];
						$status = $smsDataArr[$i]["status"];
						
						$sID = trim($sID);
						
						$status = $onOffArr[$status];								
												
						$serial_no++;
						
						
						$balanace = fobrainSMSBalance($api, $user, $password, $sID);  /* check text message balance  */  
								

$smsData =<<<IGWEZE
        
						<tr id="row-$sID" >
							<td> $serial_no</td> 
							<td> $gateway </td> 
							<td> $senderID </td> 
							<td> $user </td> 
							<td> $password</td>
							<td> $api  </td> 
							<td> $balanace </td> 
							<td> $status </td> 		 
							<td> 							  
								<div class="btn-group">
									<a href="javascript:;" class="btna btn-tasks  waves-effect waves-light dropdown-toggle p-5" data-bs-toggle="dropdown" aria-haspopup="true"
									data-bs-display="static" aria-expanded="false">
										<i class="mdi mdi-dots-grid align-middle fs-18"></i>
									</a> 
									<div class="dropdown-menu dropdown-menu-lg-end p-10 dropdown-shadow end-0 animate__animated animate__flipInY"> 
										<p class="mb-10">
											<a href='javascript:;' id='$sID' class ='view-sms text-sienna btn waves-effect btn-label waves-light'>									
												<i class="mdi mdi-text-box-search label-icon"></i> View 
											</a>	
										</p>
										<p class="mb-10">
											<a href='javascript:;' id='$sID' class ='edit-sms text-slateblue btn waves-effect btn-label waves-light'>									
												<i class="mdi mdi-square-edit-outline label-icon"></i> Edit
											</a>	
										</p> 
									</div>
								</div> 
							</td>
						</tr>
		
IGWEZE;
                               
						echo $smsData; 

		            }  
								
				} 
				
			?>
                        
                        
                </tbody>
			</table>
			<!-- / table -->	
		</div>					