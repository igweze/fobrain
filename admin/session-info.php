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
	This script handle school grades information
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

     	define('fobrain', 'igweze');  /* define a check for wrong access of file */

        require 'fobrain-config-s.php';  /* load fobrain configuration files */	  
		 
		try {
		
			$sessionDataArr = schoolSessionArrays($conn);  /* school session array */ 
			$sessionDataCount = count($sessionDataArr);
			
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
                        <th colspan="2"></th> 
						<th colspan="3" class="text-center text-info fs-14">School Term Start Date</th> 
						<th></th>
                    </tr>
					<tr>
                        <th>S/N</th> 
						<th>Session</th>                         
						<th>First Term</th> 						 
						<th>Second Term</th> 
						<th>Third Term</th>
						<th>Tasks</th>
                    </tr>
					
				</thead> 
				<tbody> 

			<?php
						
				if($sessionDataCount >= $fiVal){  /* check array is empty */		
											
					$session_se = 0;

					for($i = $fiVal; $i <= $sessionDataCount; $i++){  /* loop array */	
						
						$sID = $sessionDataArr[$i]["id_sess"]; 
						$fi_term = $sessionDataArr[$i]["fi_term"];
						$se_term = $sessionDataArr[$i]["se_term"];
						$th_term = $sessionDataArr[$i]["th_term"]; 
						$session = $sessionDataArr[$i]["year"];
						$current = $sessionDataArr[$i]["current"]; 
						
						$sID = trim($sID); 
						
						$session_se = (intval($session) + 1);
						
						$serial_no++;

						if($current == 1){

							$curr_class = "text-danger fw-600";

						}else{ $curr_class = ""; }
						
						$fi_term = date("j M Y", strtotime($fi_term));
						$se_term = date("j M Y", strtotime($se_term));
						$th_term = date("j M Y", strtotime($th_term));

$sessionInfo =<<<IGWEZE
        
						<tr id="row-$sID">
							<td class="$curr_class">$serial_no</td>  
							<td class="$curr_class">$session - $session_se</td> 
							<td class="$curr_class">$fi_term</td>  
							<td class="$curr_class">$se_term</td>
							<td class="$curr_class">$th_term</td>   
							<td>
								<div class="btn-group">
									<a href="javascript:;" class="btna btn-tasks  waves-effect waves-light dropdown-toggle p-5" data-bs-toggle="dropdown" aria-haspopup="true"
									data-bs-display="static" aria-expanded="false">
										<i class="mdi mdi-dots-grid align-middle fs-18"></i>
									</a> 
									<div class="dropdown-menu dropdown-menu-lg-end p-10 dropdown-shadow end-0 animate__animated animate__flipInY"> 
										
										<p class="mb-10">
											<a href='javascript:;' id='$sID' class ='edit-session text-slateblue btn waves-effect btn-label waves-light'>									
												<i class="mdi mdi-square-edit-outline label-icon"></i> Edit
											</a>	
										</p>
										<p>
											<a href='javascript:;' id='fobrain-$sID-$session' class ='demo-disenable remove-session text-danger btn waves-effect btn-label waves-light'>									
												<i class="mdi mdi-delete label-icon"></i> Delete
											</a>	
										</p> 
									</div>
								</div>   
							</td>
						</tr>

IGWEZE;
                               
						echo $sessionInfo; 

					} 
					
				} 
				
			?> 
                        
				</tbody>
			</table>
			<!-- / table -->	
		</div>					