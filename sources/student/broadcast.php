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
	This page is achool annoucements manager
	------------------------------------------------------------------------*/ 
 

if(!session_id()){
    session_start();
}

		if (!defined('fobrain')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');

        require 'fobrain-config.php';  /* load fobrain configuration files */	    
		
		require_once $fobrainIconPage; /* This include top middle global icon page eg go back, print buttons etcs */
		 
		try {
	 
			$broadcastDataArr = broadcastData($conn);  /* school annoucement/broadcast array */
			$broadcastDataCount = count($broadcastDataArr);
			
		}catch(PDOException $e) {
		
				fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
		 
		}	 

?>					
 
		<!-- row -->
		<div class="row gutters justify-content-center">
		
			<div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
				<!-- card start -->
				<div class="card card-shadow"> 
					<?php 
						$page_title = '<i class="fas fa-bullhorn fs-16"></i> 
						School Broadcast';
						pageTitle($page_title, 0);	 
					?>
					<div class="card-body"> 
						<div class="table-responsive pt-3">				 
							<script type='text/javascript'> renderTable(); </script> 
							<!-- table -->
							<table  class='table table-hover table-responsive style-table wiz-table'>
								<thead>
								<tr>
									<th>S/N</th>                         
									<th>Title</th> 						 
									<th>Date</th> 
									<th>Tasks</th>
								</tr>
								</thead> 
								<tbody>										


        					<?php

								if($broadcastDataCount >= $fiVal){  /* check array is empty */		
															
									$serial_no = 0;
									
									for($i = $fiVal; $i <= $broadcastDataCount; $i++){  /* loop array */	
										
										$bID = $broadcastDataArr[$i]["bID"]; 
										$bTitle = $broadcastDataArr[$i]["bTitle"];
										$broadcastMsg = $broadcastDataArr[$i]["broadcastMsg"]; 
										$date = $broadcastDataArr[$i]["date"]; 
											
										$bID = trim($bID); 
										
										$date = date("j M Y", strtotime($date)); 
										
										$serial_no++;
						

$broadcastData =<<<IGWEZE
        
										<tr id="row-$bID" >
											<td>$serial_no</td>  
											<td>$bTitle</td>  
											<td>$date</td>  
											<td> 
												<a href='javascript:;' id='$bID' class ='viewBroadcast text-sienna btn waves-effect btn-label waves-light'>
													<i class="mdi mdi-text-box-search label-icon"></i> 	 											
												</a>	 
											</td>
										</tr>
								
		
IGWEZE;
                               
												echo $broadcastData; 

										} 
								
									} 
				
?>
                         
								</tbody>
							</table>
							<!-- / table --> 
						</div>						
					</div>
				</div>
				<!-- card end -->	
			</div>
		</div>
		<!-- / row -->			 

		<!-- annoucement pop up modal start -->			
		<button type="button" class="btn modal-bcast-div  display-none"  data-bs-toggle="modal" data-bs-target="#modal-bcast-div"></button>				
		<!-- Scrollable modal -->
		<div class="modal fade animate__animated animate__zoomInDown" id="modal-bcast-div" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
			<div class="modal-dialog modal-fullscreen-sm-down modal-dialog-scrollable">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalScrollableTitle"> 
							<i class="mdi mdi-account-tie-voice label-icon"></i>  
							School Broadcast
						</h5> 
						<div id="editMsg"> </div> 
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body slideUpFrmUDiv">
						<div id="editBroadcastDiv"></div> 
					</div> 
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		<!-- annoucement pop up modal end -->			