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
	This script handle school broadcasts information
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

		if (!defined('fobrain')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!'); 
		 
		try {
		
			$broadcastDataArr = broadcastData($conn);  /* school annoucement/broadcast array */ 
			$broadcastDataCount = count($broadcastDataArr);
			
		}catch(PDOException $e) {
		
			fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
		}	

		if($render_table == 1){
			echo "<script type='text/javascript'>  renderTable(); </script>"; 
			$show_tbID = "";
			$show_tbClass = "wiz-table";
		}else{
			echo "<script type='text/javascript'>  renderTable2(); </script>"; 
			$show_tbID = "wiz-table";
			$show_tbClass = "";
		}
			
?> 
	
		<div class="table-responsive">
			<!-- table -->
			<table class='table table-hover table-responsive style-table <?php echo $show_tbClass; ?>' id="<?php echo $show_tbID; ?>">			
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
					
					for($i = $fiVal; $i <= $broadcastDataCount; $i++){  /* loop array */	
						
						$bID = $broadcastDataArr[$i]["bID"]; 
						$bTitle = $broadcastDataArr[$i]["bTitle"];
						$broadcastMsg = $broadcastDataArr[$i]["broadcastMsg"]; 
						$date = $broadcastDataArr[$i]["date"]; 
							
						$bID = trim($bID); 
						
						$date = date("j M Y", strtotime($date)); 

						if(($admin_grade == $admin_fobrain_grd) && ($admin_level == $admin_tagged) ||
						($admin_grade == $hm_fobrain_grd) && ($admin_level == $hm_fob_tagged)){   /* check if user is admin or hm */		 

							$show_btn = "<p class='mb-10'>
											<a href='javascript:;' id='$bID' class ='edit-broadcast  text-slateblue btn waves-effect btn-label waves-light'>									
												<i class='mdi mdi-square-edit-outline label-icon'></i> Edit
											</a>	
										</p>
										<p>
											<a href='javascript:;' id='fobrain-$bID-broadast' class ='remove-broadcast text-danger btn waves-effect btn-label waves-light'>									
												<i class='mdi mdi-delete label-icon'></i> Delete
											</a>	
										</p> ";


						}else{ $show_btn = "";}	 
						
							$serial_no++; 

$broadcastData =<<<IGWEZE
        
						<tr id="row-$bID" >
							<td>$serial_no</td>  
							<td> $bTitle  </td>  
							<td> $date </td>  
							<td>
								<div class="btn-group">
									<a href="javascript:;" class="btna btn-tasks waves-effect waves-light dropdown-toggle p-5" data-bs-toggle="dropdown" aria-haspopup="true"
									data-bs-display="static" aria-expanded="false">
										<i class="mdi mdi-dots-grid align-middle fs-18"></i>
									</a> 
									<div class="dropdown-menu dropdown-menu-lg-end p-10 dropdown-shadow end-0 animate__animated animate__flipInY"> 
										<p class="mb-10">
											<a href='javascript:;' id='$bID' class ='view-broadcast text-sienna btn waves-effect btn-label waves-light'>									
												<i class="mdi mdi-text-box-search label-icon"></i> View 
											</a>	
										</p> 
										$show_btn
									</div>
								</div>   
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