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
	This script handle student parent meeting information
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

		if (!defined('fobrain'))

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');	

		try { 

			if (($admin_grade == $hm_fobrain_grd)) {    /* check admin grade */ 
				$parentMeetingDataArr = parentMeetingData2($conn, $schoolID); /* online admin parmeeting array */  
			}else{
				$parentMeetingDataArr = parentMeetingData2($conn); /* online admin parmeeting array */  
			}	 
			
			$parentMeetingDataCount = count($parentMeetingDataArr);  

			if (($admin_grade == $cm_fobrain_grd) || ($admin_grade == $staff_fobrain_grd) 
			|| ($admin_grade == $admin_fobrain_grd) || ($admin_grade == $bus_fobrain_grd)
			|| ($admin_grade == $lib_fobrain_grd)) {    /* check admin grade */ 
				
				echo "<script type='text/javascript'> $('.live_component').hide(100); </script>";
				$show_comp = false;
				
			}else{
				$show_comp = true;
			}
				
		}catch(PDOException $e) {
		
				fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
		}		

		 
?>
		<script type='text/javascript'>  renderTable(); </script>
		<div class="table-responsive">
			<!-- table -->
			<table class='table table-hover table-responsive style-table wiz-table'>					
				<thead>
					<tr>
						<th>S/N</th> 
						<th>Picture</th>	
						<th>Host <hr class="my-5 p-0 text-danger"/>School</th> 		
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
						$school = $parentMeetingDataArr[$i]["school"];
						$info = $parentMeetingDataArr[$i]["info"];
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
						$participant = $parentMeetingDataArr[$i]["participant"];  
						$staffs = unserialize($parentMeetingDataArr[$i]["staffs"]);
							
						//$eDetail = nl2br($eDetail); 

						$e_status = wizSelectArray($eType, $pmeeting_list);
						$allow_status = wizSelectArray($allow, $meeting_allow_list);
						$live_status = wizSelectArray($status, $live_meeting_list);
						$school_m = wizSelectArray($school, $school_list);  

						if($eType == $fiVal){
							$meet_tar = $e_status;
						}else{ 									 
							list ($session_val, $class_level, $class) = explode ("#@@#", $info);
							$meet_tar = "$class_level ($class)";
						} 

						$sub_staff = staffData($conn, $eStaff);  /* school staffs/teachers information */ 
						list ($title, $st_fullname, $st_sex, $st_rank, $pic, 
								$st_lname) = explode ("#@s@#", $sub_staff); 

						$titleVal = wizSelectArray($title, $title_list);
						
						$staffs_name = $titleVal.' '.$st_fullname;
						$staff_img = picture($staff_pic_ext, $pic, "staff");

						if(($status == 0) || ($status == 3)){ 
							$show_join_btn = "";  $show_stop_btn = "";
						}elseif ($status == 2){

							$show_join_btn = "<p class='mb-10'>
											<a href='javascript:;' id='$cid' class ='start-parmeeting text-sienna btn waves-effect btn-label waves-light'>									
												<i class='mdi mdi-motion-play label-icon'></i> Join 
											</a>	
										</p>";

							if($show_comp == true){
								$show_stop_btn = "<p class='mb-10'>
											<a href='javascript:;' id='$cid' class ='edit-parmeeting text-dark btn waves-effect btn-label waves-light'>									
												<i class='mdi mdi-stop-circle-outline label-icon'></i> Stop 
											</a>	
										</p>";
							}else{
								$show_stop_btn = "";
							}			

						}else{
							if($show_comp == true){
								$show_join_btn = "<p class='mb-10'>
											<a href='javascript:;' id='$cid' class ='start-parmeeting text-sienna btn waves-effect btn-label waves-light'>									
												<i class='mdi mdi-motion-play label-icon'></i> Start 
											</a>	
										</p>"; 
							}else{
								$show_join_btn = ""; 
							}	
							
							$show_stop_btn = "";
						} 

						if(($eType == $fiVal) && ($admin_grade == $cm_fobrain_grd) || ($admin_grade == $staff_fobrain_grd)){ 

							if(is_array($staffs)){  
								
								if(!in_array($_SESSION['adminID'], $staffs)){  /* check if array */  

									$show_join_btn = "<p class='mb-10'>
										<a href='javascript:;' id='$cid' class ='text-danger btn waves-effect btn-label waves-light'>									
											<i class='mdi mdi-account-tie-voice-off label-icon'></i> Not Allow 
										</a>	
									</p>"; 
								}	

							}else{
								$show_join_btn = "<p class='mb-10'>
									<a href='javascript:;' id='$cid' class ='text-danger btn waves-effect btn-label waves-light'>									
										<i class='mdi mdi-account-tie-voice-off label-icon'></i> Not Allow 
									</a>	
								</p>"; 
							} 

						}

						$serial_no++;
						

$parentMeetingData =<<<IGWEZE

						<tr id="row-$cid" >
							<td>$serial_no</td> 
							<td> <img src = "$staff_img" class=" img-h-50 img-circle img-thumbnail"></td>
							<td> $staffs_name (HM) <hr class="my-5 p-0 text-danger"/>  $school_m</td>
							<td> $eTitle </td>
							<td> $meet_tar <hr class="my-5 p-0 text-danger"/> $allow_status </td> 	 
							<td> $sTime  <hr class="my-5 p-0 text-danger"/> $eTime Mins</td>  
								
							<td> $live_status </td> 									
							<td>  
								<div class="btn-group">
									<a href="javascript:;" class="btna btn-tasks  waves-effect waves-light dropdown-toggle p-5" data-bs-toggle="dropdown" aria-haspopup="true"
									data-bs-display="static" aria-expanded="false">
										<i class="mdi mdi-dots-grid align-middle fs-18"></i>
									</a> 
									<div class="dropdown-menu dropdown-menu-lg-end p-10 dropdown-shadow end-0 animate__animated animate__flipInY"> 
										$show_join_btn 
										$show_stop_btn 
										<p class="mb-10">
											<a href='javascript:;' id='$cid' class ='view-parmeeting text-sienna btn waves-effect btn-label waves-light'>									
												<i class="mdi mdi-text-box-search label-icon"></i> View 
											</a>	
										</p>
										<p class="mb-10 live_component">
											<a href='javascript:;' id='$cid' class ='edit-parmeeting text-slateblue btn waves-effect btn-label waves-light'>									
												<i class="mdi mdi-square-edit-outline label-icon"></i> Edit
											</a>	
										</p>
										<p class="live_component">
											<a href='javascript:;' id='fobrain-$cid-$eTitle' class ='remove-parmeeting demo-disenable text-danger btn waves-effect btn-label waves-light'>									
												<i class="mdi mdi-delete label-icon"></i> Delete
											</a>	
										</p> 
									</div>
								</div>  
							</td>
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