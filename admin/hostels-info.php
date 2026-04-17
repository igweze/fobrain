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
	This script handle school hostel information
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

		define('fobrain', 'igweze');  /* define a check for wrong access of file */

		require 'fobrain-config.php';  /* load fobrain configuration files */
		
		try {
		
			$hostelDataArr = fobrainHostelData($conn);  /* school hostel array  */
			$hostelDataCount = count($hostelDataArr);
			
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
                        <th>Hostel</th> 
                        <th>Limit </th>
                        <th>Description</th>
						<th>Picture</th>
						<th>Master/Mistress</th>
						<th>Phone No</th>
						<th>Tasks</th> 
					</tr>
				</thead> 
				<tbody>


        <?php
						
						if($hostelDataCount >= $fiVal){  /* check array is empty */	 
								
							for($i = $fiVal; $i <= $hostelDataCount; $i++){  /* loop array */	
							
								$hID = $hostelDataArr[$i]["h_id"];
								$hostel = $hostelDataArr[$i]["hostel"];
								$h_limit = $hostelDataArr[$i]["h_limit"];
								$h_desc = $hostelDataArr[$i]["h_desc"];
								$h_master = $hostelDataArr[$i]["h_master"];
								
								$hostel = trim($hostel);
								$h_limit = trim($h_limit);
								$h_desc = trim($h_desc);
								$serial_no++;
								
								$staffInfo = staffData($conn, $h_master);  /* school staffs/teachers information */
								list ($title, $staff_fullname, $staff_sex, $staff_rankingVal, $pic, 
								$staff_lname, $phone) = explode ("#@s@#", $staffInfo);
					
								$titleVal = wizSelectArray($title, $title_list); 
                                $staff_img = picture($staff_pic_ext, $pic, "staff");
								$staffName = $titleVal.' '.$staff_fullname;

								

$hostelData =<<<IGWEZE
        
								<tr id="row-$hID"><td width="3%">$serial_no</td> 
									<td>$hostel </td>								
									<td> $h_limit</td>								
									<td>$h_desc</td>
									<td>                                              
										<a href='javascript:;' id='$h_master' class ='view-staff-i'>                                                
											<img src = "$staff_img" class=" img-h-50 img-circle img-thumbnail">
										<a/>
									
									</td> 
									<td>                                              
										<a href='javascript:;' id='$h_master' class ='view-staff-i'>                                                    
										$staffName
										<a/> 
									</td>  		
									<td>$phone</td>						
									<td>  
										<div class="btn-group">
											<a href="javascript:;" class="btna btn-tasks  waves-effect waves-light dropdown-toggle p-5" data-bs-toggle="dropdown" aria-haspopup="true"
											data-bs-display="static" aria-expanded="false">
												<i class="mdi mdi-dots-grid align-middle fs-18"></i>
											</a> 
											<div class="dropdown-menu dropdown-menu-lg-end p-10 dropdown-shadow end-0 animate__animated animate__flipInY"> 
												<!--
												<p class="mb-10">
													<a href='javascript:;' id='$hID' class ='view-hostel text-sienna btn waves-effect btn-label waves-light'>									
														<i class="mdi mdi-text-box-search label-icon"></i> View 
													</a>	
												</p>
												-->
												<p class="mb-10">
													<a href='javascript:;' id='$hID' class ='edit-hostel text-slateblue btn waves-effect btn-label waves-light'>									
														<i class="mdi mdi-square-edit-outline label-icon"></i> Edit
													</a>	
												</p>
												<p>
													<a href='javascript:;' id='fobrain-$hID-$hostel' class ='remove-hostel text-danger btn waves-effect btn-label waves-light'>									
														<i class="mdi mdi-delete label-icon"></i> Delete
													</a>	
												</p> 
											</div>
										</div>    
									</td>
								</tr>
		
IGWEZE;
                               
								echo $hostelData;
								$staffInfo = ""; 

		                    } 
								
						} 
				
?>
                           
				</tbody>
			</table>
			<!-- / table -->	
		</div>			