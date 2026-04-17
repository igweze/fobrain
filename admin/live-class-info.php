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
	This script handle student live class information
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

		define('fobrain', 'igweze');  /* define a check for wrong access of file */

		require 'fobrain-config.php';  /* load fobrain configuration files */	

		try {
		
			if (($admin_grade == $cm_fobrain_grd) || ($admin_grade == $staff_fobrain_grd)) {    /* check admin grade */ 
				
				$liveClassDataArr = staffLiveClassData($conn, $_SESSION['adminID']); /* online staff liveclass array */
				$show_comp = true;

			}else{
				
				$liveClassDataArr = liveClassData($conn); /* online admin liveclass array */
				echo "<script type='text/javascript'> $('.live_component').hide(100); </script>";
				$show_comp = false;
				
			}	  
			
			$liveClassDataCount = count($liveClassDataArr);
			
			$levelArray = studentLevelsArray($conn); /* student level array */					
			array_unshift($levelArray,"");
			unset($levelArray[0]);
				
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
						<th>Host</th> 	
						<th>Course</th>							
						<th>Class</th> 
						<!--<th>Term</th>-->  
						<th>Start Time <hr class="my-5 p-0 text-danger"/> Duration</th>
						<th>Status</th>	
						<th>Tasks</th>
					</tr>
				</thead> 
				<tbody>


        <?php
						
				if($liveClassDataCount >= $fiVal){  /* check array is empty */	  
					
					for($i = $fiVal; $i <= $liveClassDataCount; $i++){  /* loop array */		
					
						$cid = $liveClassDataArr[$i]["cid"];
						$sessionID = $liveClassDataArr[$i]["session"];
						$level = $liveClassDataArr[$i]["level"];
						$eTerm = $liveClassDataArr[$i]["eTerm"];
						$class = $liveClassDataArr[$i]["class"];
						$eTitle = $liveClassDataArr[$i]["eTitle"];
						$eSubject = $liveClassDataArr[$i]["eSubject"];
						$eDetail = htmlspecialchars_decode($liveClassDataArr[$i]["eDetail"]);
						$eTime = $liveClassDataArr[$i]["eTime"];
						$cTime = $liveClassDataArr[$i]["cTime"];
						$sTime = $liveClassDataArr[$i]["sTime"];
						$status = $liveClassDataArr[$i]["status"];
						$eStaff = $liveClassDataArr[$i]["eStaff"];
						
						//$eTerm = $termIntList[$eTerm];   
						//$eDetail = nl2br($eDetail);
						
						$liveclassLevel = $levelArray[$level]['level']; 
						$live_status = wizSelectArray($status, $live_meeting_list); 

						$sub_staff = staffData($conn, $eStaff);  /* school staffs/teachers information */ 
						list ($title, $st_fullname, $st_sex, $st_rank, $pic, 
								$st_lname) = explode ("#@s@#", $sub_staff); 

						$titleVal = wizSelectArray($title, $title_list);
						
						$staffs_name = $titleVal.' '.$st_fullname;
						$staff_img = picture($staff_pic_ext, $pic, "staff");
						
						if(($status == 0) || ($status == 3)){ 
							$show_join_btn = "";  
						}elseif ($status == 2){

							$show_join_btn = "<p class='mb-10'>
											<a href='javascript:;' id='$cid' class ='start-liveclass text-sienna btn waves-effect btn-label waves-light'>									
												<i class='mdi mdi-motion-play label-icon'></i> Join 
											</a>	
										</p>";
							if($show_comp == true){
								$show_stop_btn = "<p class='mb-10'>
											<a href='javascript:;' id='$cid' class ='edit-liveclass text-dark btn waves-effect btn-label waves-light'>									
												<i class='mdi mdi-stop-circle-outline label-icon'></i> Stop 
											</a>	
										</p>";
							}else{
								$show_stop_btn = "";
							}			

						}else{
							if($show_comp == true){
								$show_join_btn = "<p class='mb-10'>
											<a href='javascript:;' id='$cid' class ='start-liveclass text-sienna btn waves-effect btn-label waves-light'>									
												<i class='mdi mdi-motion-play label-icon'></i> Start 
											</a>	
										</p>";
							}else{
								$show_join_btn = ""; $show_stop_btn = "";
							}				
						}
			
						$serial_no++;
						

$liveClassData =<<<IGWEZE

						<tr id="row-$cid" >
							<td>$serial_no</td> 
							<td> <img src = "$staff_img" class=" img-h-50 img-circle img-thumbnail"></td>
							<td> $staffs_name </td>
							<td> $eTitle </td>
							<td> $liveclassLevel $class </td> 									
							<!--<td> $eTerm</td>-->  
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
											<a href='javascript:;' id='$cid' class ='view-liveclass text-sienna btn waves-effect btn-label waves-light'>									
												<i class="mdi mdi-text-box-search label-icon"></i> View 
											</a>	
										</p>
										<p class="mb-10 live_component">
											<a href='javascript:;' id='$cid' class ='edit-liveclass text-slateblue btn waves-effect btn-label waves-light'>									
												<i class="mdi mdi-square-edit-outline label-icon"></i> Edit
											</a>	
										</p>
										<p class="live_component">
											<a href='javascript:;' id='fobrain-$cid-$eTitle' class ='remove-liveclass demo-disenable text-danger btn waves-effect btn-label waves-light'>									
												<i class="mdi mdi-delete label-icon"></i> Delete
											</a>	
										</p> 
									</div>
								</div>  
							</td>
						</tr>

IGWEZE;
						
						echo $liveClassData; 

					}
							
						
				}

?>
				
				</tbody>
			</table>				
			<!-- / table -->
		</div>	