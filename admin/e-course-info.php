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
	This script handle student course information
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

		define('fobrain', 'igweze');  /* define a check for wrong access of file */

		require 'fobrain-config.php';  /* load fobrain configuration files */	

		try {
		
			//if(($admin_grade == $staff_fobrain_grd) && ($admin_level == $staff_fob_tagged)){    /* check admin grade */ 
				
				//$onlineCourseDataArr = onlineStaffCourseData($conn, $_SESSION['adminID']); /* online staff course array */
				
			//}else{
				
				//$onlineCourseDataArr = onlineCourseData($conn); /* online admin course array */
				
			//}	 
			
			$onlineCourseDataArr = onlineStaffCourseData($conn, $_SESSION['adminID']); /* online staff course array */
			$onlineCourseDataCount = count($onlineCourseDataArr);

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
			<table class='table table-hover table-responsive style-table wiz-table' id="wiz-table">					
				<thead>
					<tr>
						<th>S/N</th> 								
						<th>Level</th> 
						<th>Semester</th> 
						<th>Title</th> 
						<th>Course</th> 
						<th>Duration</th>
						<th>Topic. Num</th>	
						<th>Status</th>	
						<th>Tasks</th>
					</tr>
				</thead> 
				<tbody>


        			<?php
						
						if($onlineCourseDataCount >= $fiVal){  /* check array is empty */	
							
							for($i = $fiVal; $i <= $onlineCourseDataCount; $i++){  /* loop array */		
							
								$cid = $onlineCourseDataArr[$i]["cid"];
								$sessionID = $onlineCourseDataArr[$i]["session"];
								$level = $onlineCourseDataArr[$i]["level"];
								$eTerm = $onlineCourseDataArr[$i]["eTerm"];
								$class = $onlineCourseDataArr[$i]["class"];
								$eTitle = $onlineCourseDataArr[$i]["eTitle"];
								$eSubject = $onlineCourseDataArr[$i]["eSubject"];
								$eDetail = htmlspecialchars_decode($onlineCourseDataArr[$i]["eDetail"]);
								$eTime = $onlineCourseDataArr[$i]["eTime"];
								$status = $onlineCourseDataArr[$i]["status"];
								
								$eTerm = $termIntList[$eTerm]; 
								
								$countQuest = courseTopics($conn, $cid);  /* online course chapter information */
								$countTopics = count($countQuest);

								$course_level = $levelArray[$level]['level'];
								
								//$eDetail = nl2br($eDetail); 

								if($status == 0){

									$course_btn = '<a href="javascript:;"  class ="text-danger btn waves-effect btn-label waves-light">
													<i class="mdi mdi-lock-clock label-icon"></i>  Lock	 											
												</a>';

								}else{

									$course_btn = '<a href="javascript:;"  class ="text-sienna btn waves-effect btn-label waves-light">
													<i class="mdi mdi-lock-open-variant label-icon"></i>  Unlock	 											
												</a>';

								}
					
								$serial_no++;								

$onlineCourseData =<<<IGWEZE
        
								<tr id="row-$cid" >
									<td> $serial_no</td> 
									<td> $course_level $class</td> 									
									<td> $eTerm</td> 				
									<td> $eTitle</td> 			
									<td> $eSubject </td> 		 
									<td> $eTime Mins</td> 
									<td> $countTopics </td>
									<td> $course_btn </td> 									
									<td>  
										<div class="btn-group">
											<a href="javascript:;" class="btna btn-tasks  waves-effect waves-light dropdown-toggle p-5" data-bs-toggle="dropdown" aria-haspopup="true"
											data-bs-display="static" aria-expanded="false">
												<i class="mdi mdi-dots-grid align-middle fs-18"></i>
											</a> 
											<div class="dropdown-menu dropdown-menu-lg-end p-10 dropdown-shadow end-0 animate__animated animate__flipInY"> 
											
												<p class="mb-10">
													<a href='javascript:;' id='fobrain-$cid' class ='addCourseQuest text-primary btn waves-effect btn-label waves-light'>									
														<i class="mdi mdi-format-list-numbered label-icon"></i> Chapters
													</a>	
												</p>
												
												<p class="mb-10">
													<a href='javascript:;' id='$cid' class ='view-course text-sienna btn waves-effect btn-label waves-light'>									
														<i class="mdi mdi-text-box-search label-icon"></i> View 
													</a>	
												</p>
												<p class="mb-10">
													<a href='javascript:;' id='$cid' class ='edit-course text-slateblue btn waves-effect btn-label waves-light'>									
														<i class="mdi mdi-square-edit-outline label-icon"></i> Edit
													</a>	
												</p>
												<p>
													<a href='javascript:;' id='fobrain-$cid-$eTitle' class ='remove-course demo-disenable text-danger btn waves-effect btn-label waves-light'>									
														<i class="mdi mdi-delete label-icon"></i> Delete
													</a>	
												</p> 
											</div>
										</div>  
									</td>
								</tr>
		
IGWEZE;
                               
		                  		echo $onlineCourseData; 

		                    }
								 
								
						}
 
?>
                        
                        </tbody>
                    </table>				
                    <!-- / table -->
                </div>	