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
	This page load student online examination
	------------------------------------------------------------------------*/ 


		if (!defined('fobrain')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
				
		require_once $fobrainIconPage; /* This include top middle global icon page eg go back, print buttons etcs */
			
			
		try {
					
			$parentMeetingDataArr = parentMeetingData($conn); /* liveclass array */					
			$parentMeetingDataCount = count($parentMeetingDataArr);
			
			$levelArray = studentLevelsArray($conn); /* student level array */		
			
			array_unshift($levelArray,"");
			unset($levelArray[0]);
				
		}catch(PDOException $e) {
  			
				fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			 
		}		

?> 

		<!-- row -->
		<div <?php echo $fob_view; ?> class="row gutters row-section justify-content-center">
			<div class="col-12">	 
				<!-- card start -->
				<div class="card card-shadow"> 
					<?php 
						$page_title = '<i class="fas fa-chalkboard-teacher fs-16"></i> 
						Parents & School Live Meeting';
						pageTitle($page_title, 0);	 
					?>
					<div class="card-body" id="examQuestDiv">	
					
						<div class="table-responsive pt-3">	
						
							<script type='text/javascript'> renderTable(); </script> 
							<!-- table -->
							<table class='table table-hover table-responsive style-table wiz-table'>					
								<thead>
									<tr>
										<th>S/N</th> 
										<th>Picture</th>	
										<th>Host</th> 		
										<th>Title</th>					
										<th>Participant <hr class="my-5 p-0 text-danger"/>Staffs Allowed</th>    
										<th>Start Time <hr class="my-5 p-0 text-danger"/> Duration</th>	
										<th>Status</th>	
										<th>Tasks</th>
									</tr>
								</thead> 
								<tbody>


        		<?php
						
								if($parentMeetingDataCount >= $fiVal){  /* check array is empty */	  
									
									for($i = $fiVal; $i <= $parentMeetingDataCount; $i++){  /* loop array */		
									
										$cid = $parentMeetingDataArr[$i]["cid"];
										$sessionID = $parentMeetingDataArr[$i]["session"];
										$level = $parentMeetingDataArr[$i]["level"];
										$eType = $parentMeetingDataArr[$i]["eType"];
										$allow = $parentMeetingDataArr[$i]["allow"];
										$class = $parentMeetingDataArr[$i]["class"];
										$eTitle = $parentMeetingDataArr[$i]["eTitle"];
										//$eSubject = $parentMeetingDataArr[$i]["eSubject"];
										//$eDetail = htmlspecialchars_decode($parentMeetingDataArr[$i]["eDetail"]);
										$eTime = $parentMeetingDataArr[$i]["eTime"];
										$cTime = $parentMeetingDataArr[$i]["cTime"];
										$sTime = $parentMeetingDataArr[$i]["sTime"];
										$status = $parentMeetingDataArr[$i]["status"];
										$eStaff = $parentMeetingDataArr[$i]["eStaff"]; 
										
										//$eDetail = nl2br($eDetail); 

										$e_status = wizSelectArray($eType, $pmeeting_list);
										$allow_status = wizSelectArray($allow, $meeting_allow_list);
										$live_status = wizSelectArray($status, $live_meeting_list);  

										if($eType == $fiVal){
											$meet_tar = $e_status;
										}else{
											
											$class_level = $levelArray[$level]['level']; 
											$meet_tar = "$class_level $class";
										} 

										$sub_staff = staffData($conn, $eStaff);  /* school staffs/teachers information */ 
										list ($title, $st_fullname, $st_sex, $st_rank, $pic, 
												$st_lname) = explode ("#@s@#", $sub_staff); 
				
										$titleVal = wizSelectArray($title, $title_list);
										
										$staffs_name = $titleVal.' '.$st_fullname;
										$staff_img = picture($staff_pic_ext, $pic, "staff");

										if(($status == 0) || ($status == 3)){ 
											$show_join_btn = ""; 
										}elseif ($status == 2){ 
											$show_join_btn = " 
															<a href='javascript:;' id='$cid' class ='join-meeting text-sienna btn waves-effect btn-label waves-light'>									
																<i class='mdi mdi-motion-play label-icon'></i> Join 
															</a>	
														 "; 
										}else{
											$show_join_btn = " ";
										} 

										$serial_no++;
										

$parentMeetingData =<<<IGWEZE
        
										<tr id="row-$cid" >
											<td>$serial_no</td> 
											<td> <img src = "$staff_img" class=" img-h-50 img-circle img-thumbnail"></td>
											<td> $staffs_name </td>
											<td> $eTitle </td>
											<td> $meet_tar <hr class="my-5 p-0 text-danger"/> $allow_status </td> 	 
											<td> $sTime  <hr class="my-5 p-0 text-danger"/> $eTime Mins</td>  
											
											<td> $live_status </td> 									
											<td> $show_join_btn </td>
										</tr>
				
IGWEZE;
                               
										echo $parentMeetingData; 

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
		<div id="edit-msg"></div> 
					 