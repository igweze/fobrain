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
	This script handle student homework information
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

		define('fobrain', 'igweze');  /* define a check for wrong access of file */

		require 'fobrain-config.php';  /* load fobrain configuration files */	

		try {
		
			if (($admin_grade == $cm_fobrain_grd) || ($admin_grade == $staff_fobrain_grd)) {    /* check admin grade */ 
				
				$onlineHomeWorkDataArr = onlineStaffHomeWorkData($conn, $_SESSION['adminID']); /* online staff homework array */
				
			}else{
				
				$onlineHomeWorkDataArr = onlineHomeWorkData($conn); /* online admin homework array */
				
			}	 
			
			$onlineHomeWorkDataCount = count($onlineHomeWorkDataArr);
			
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
						<th>Class</th> 
						<th>Term</th> 
						<th>Title</th> 
						<th>Subject</th> 
						<th>Duration</th>
						<th>Quest. Num</th>	
						<th>Status</th>	
						<th>Tasks</th>
					</tr>
				</thead> 
				<tbody>


        <?php
						
						if($onlineHomeWorkDataCount >= $fiVal){  /* check array is empty */	 		
													
							
							for($i = $fiVal; $i <= $onlineHomeWorkDataCount; $i++){  /* loop array */		
							
								$eID = $onlineHomeWorkDataArr[$i]["eID"];
								$sessionID = $onlineHomeWorkDataArr[$i]["session"];
								$level = $onlineHomeWorkDataArr[$i]["level"];
								$eTerm = $onlineHomeWorkDataArr[$i]["eTerm"];
								$class = $onlineHomeWorkDataArr[$i]["class"];
								$eTitle = $onlineHomeWorkDataArr[$i]["eTitle"];
								$eSubject = $onlineHomeWorkDataArr[$i]["eSubject"];
								$eDetail = htmlspecialchars_decode($onlineHomeWorkDataArr[$i]["eDetail"]);
								$eTime = $onlineHomeWorkDataArr[$i]["eTime"];
								$status = $onlineHomeWorkDataArr[$i]["status"];
								
								$eTerm = $termIntList[$eTerm]; 
								
								$countQuest = homeworkQuestions($conn, $eID);  /* online homework question information */
								$countQuestion = count($countQuest);
								
								//$eDetail = nl2br($eDetail);
								
								$homeworkLevel = $levelArray[$level]['level'];

								if($status == 0){

									$homework_btn = '<a href="javascript:;"  class ="text-danger btn waves-effect btn-label waves-light">
													<i class="mdi mdi-lock-clock label-icon"></i>  Lock	 											
												</a>';

								}else{

									$homework_btn = '<a href="javascript:;"  class ="text-sienna btn waves-effect btn-label waves-light">
													<i class="mdi mdi-lock-open-variant label-icon"></i>  Unlock	 											
												</a>';


								}
					
								$serial_no++;
								

$onlineHomeWorkData =<<<IGWEZE
        
								<tr id="row-$eID" >
									<td>$serial_no</td> 
									<td> $homeworkLevel $class </td> 									
									<td> $eTerm</td> 				
									<td> $eTitle</td> 			
									<td> $eSubject </td> 		 
									<td> $eTime Mins</td> 
									<td> $countQuestion </td>
									<td> $homework_btn </td> 									
									<td>  
										<div class="btn-group">
											<a href="javascript:;" class="btna btn-tasks  waves-effect waves-light dropdown-toggle p-5" data-bs-toggle="dropdown" aria-haspopup="true"
											data-bs-display="static" aria-expanded="false">
												<i class="mdi mdi-dots-grid align-middle fs-18"></i>
											</a> 
											<div class="dropdown-menu dropdown-menu-lg-end p-10 dropdown-shadow end-0 animate__animated animate__flipInY"> 
											
												<p class="mb-10">
													<a href='javascript:;' id='fobrain-$eID' class ='addHomeWorkQuest text-primary btn waves-effect btn-label waves-light'>									
														<i class="mdi mdi-progress-question label-icon"></i> Questions
													</a>	
												</p>
												<p class="mb-10">
													<a href='javascript:;' id='$eID' class ='view-homework text-sienna btn waves-effect btn-label waves-light'>									
														<i class="mdi mdi-text-box-search label-icon"></i> View 
													</a>	
												</p>
												<p class="mb-10">
													<a href='javascript:;' id='$eID' class ='edit-homework text-slateblue btn waves-effect btn-label waves-light'>									
														<i class="mdi mdi-square-edit-outline label-icon"></i> Edit
													</a>	
												</p>
												<p>
													<a href='javascript:;' id='fobrain-$eID-$eTitle' class ='remove-homework demo-disenable text-danger btn waves-effect btn-label waves-light'>									
														<i class="mdi mdi-delete label-icon"></i> Delete
													</a>	
												</p> 
											</div>
										</div>  
									</td>
								</tr>
		
IGWEZE;
                               
		                  		echo $onlineHomeWorkData; 

		                    }
								 
								
						}
 
?>
                        
                        </tbody>
                    </table>				
                    <!-- / table -->
                </div>	