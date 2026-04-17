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
	This page is the student fee history
	------------------------------------------------------------------------*/ 


		if (!defined('fobrain')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
				
		require_once $fobrainIconPage; /* This include top middle global icon page eg go back, print buttons etcs */

?> 
 
		<!-- row -->
		<div <?php echo $fob_view; ?> class="row gutters row-section justify-content-center">
			<div class="col-12">	
				<!-- card start -->
				<div class="card card-shadow"> 
					<?php 
						$page_title = '<i class="mdi mdi-card-bulleted-outline fs-18"></i> 
						E-Wallet History';
						pageTitle($page_title, 0);	 
					?>
					<div class="card-body">
							<!-- row -->
							<div class="row gutters pt-2">							
								
								<div class="table-responsive pt-3">
								
									<?php

										try {  
									 
											$levelArray = studentLevelsArray($conn);  /* student level array */  
											$eWalletArr = studentEWalletArr($conn, $regID, $regNum);
                                            $eWalletCount = count($eWalletArr);  
										}catch(PDOException $e) {
										
												fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
										 
										}	

											
									?>

									<script type='text/javascript'> renderTable(); </script> 
									<!-- table -->
									<table  class='table table-hover table-responsive style-table wiz-table'>
										
										<thead>
											<tr>
												<th>S/N</th>  
												<th>Card Pin </th>
												<th>Serial No</th>
												<th>Level</th>
												<th>Term</th>
												<th>Recharge Time</th>
												<th>Status</th>
											</tr>
										</thead> 
										<tbody> 
											<?php
												
												if($eWalletCount >= $fiVal){  /* check array is empty */		
														
													$serial_no = 0; 	
													
													for($i = $fiVal; $i <= $eWalletCount; $i++){  /* loop array */	
														
														
                                                        $e_pin = $eWalletArr[$i]["iiii_pin_iiii"];
                                                        $e_serial = $eWalletArr[$i]["iiii_serial_iiii"];
                                                        $reg_id = $eWalletArr[$i]["iiii_reg_id"];
                                                        $regNum = $eWalletArr[$i]["iiii_reg"]; 
                                                        $level = $eWalletArr[$i]["iiii_level"];
                                                        $term = $eWalletArr[$i]["iiii_term"];
                                                        $reTime = $eWalletArr[$i]["iiii_time"];
                                                        $status = $eWalletArr[$i]["iiii_status"];
                                                
                                                        if($status == ""){ $status = $i_false; } 	

                                                        $cardStatus = $cardStatusArr[$status];  
                                                        
                                                        $e_Level = $levelArray[$level]['level'];
                                                        
                                                        //$rechargeTime = date("j M Y", strtotime($reTime)); 
                                                        if($reTime != "") {$rechargeTime = date("j M Y", $reTime); }
														else{$rechargeTime = ""; }
														
														$serial_no++;								

$feesData =<<<IGWEZE
	
														<tr>
															<td>$serial_no</td> 
															<td>$e_pin</td> 
															<td>$e_serial</td>
															<td>$e_Level</td>
															<td>$term</td> 
															<td>$rechargeTime</td> 
															<td>$cardStatus</td>  
														</tr> 
	
IGWEZE;
						   
														echo $feesData; 								

                                                    }
                                                    
                                                    
                                                }else{  /* display information message */ 
                                                                
                                                    $msg_i = "Ooops, you don't have any e-wallet history to show at the momment"; 
                                                    echo $infMsg.$msg_i.$msgEnd;
                                                            
                                                } 
				
                                            ?>           
                        
										</tbody>
									</table>
									<!-- table -->	
								</div> 
							</div>
							<!-- / row --> 
					</div>
				</div>
				<!-- card end -->	
			</div>
		</div>
		<!-- / row -->	 			

		 