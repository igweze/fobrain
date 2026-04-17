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
	This page load student online home work
	------------------------------------------------------------------------*/ 


		if (!defined('fobrain')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
				
		require_once $fobrainIconPage; /* This include top middle global icon page eg go back, print buttons etcs */
			
			
		try {
					
			$onlineHomeWorkDataArr = onlineHomeWorkData($conn); /* online student home work array */							
			$onlineHomeWorkDataCount = count($onlineHomeWorkDataArr);
			
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
						CBT Home work';
						pageTitle($page_title, 0);	 
					?>
					<div class="card-body" id="examQuestDiv">	
					
						<div class="table-responsive pt-3">	
						
							<script type='text/javascript'> renderTable(); </script> 
							<!-- table -->
							<table  class='table table-hover table-responsive style-table wiz-table'>
								
								<thead>
									<tr>
										<th>S/N</th> 
										<th>Course</th>						
										<th>Level</th> 
										<th>Term</th> 
										<th>Question/s No.</th> 
										<th>Time</th> 
										<th>Tasks</th> 
									</tr>
								</thead> 
								<tbody>

<?php
						
						if($onlineHomeWorkDataCount >= $fiVal){  /* check array is empty */		
														
							try { 
								
								$serial_no = 0;

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
									$session = fobrainSession($conn, $sessionID);  /* school session */
									$sessionS = ($session + $fiVal);
									
									$countQuest = homeworkQuestions($conn, $eID);  /* online homework question array */
									$countQuestion = count($countQuest);
									
									$eDetail = nl2br($eDetail);
						
									$serial_no++;
									
									$homeworkLevel = $levelArray[$level]['level'];
									
									if(strlen($eSubject) > 20){
									
										$eSubject = substr($eSubject, 0, 20); 									
										$eSubject = $eSubject.'.';
									
									}

									if($status == 0){

										$homework_btn = '<a href="javascript:;"  class ="text-danger btn waves-effect btn-label waves-light">
														<i class="mdi mdi-lock-clock label-icon"></i>  Locked	 											
													</a>';

									}else{

										$homework_btn = '<a href="javascript:;" id="fobrain-'.$eID.'" class ="load-hwork text-sienna btn waves-effect btn-label waves-light">
														<i class="mdi mdi-play-speed label-icon"></i>  Start 										
													</a>';


									}

$homeworkQuestDiv =<<<IGWEZE
        
									<tr id="row-$eID">
										<td>$serial_no</td> 
										<td>$eSubject</td> 
										<td>$homeworkLevel $class</td> 
										<td>$eTerm Term</td> 
										<td>$countQuestion</td> 
										<td>$eTime Mins</td> 
										<td>$homework_btn</td> 
 
									</tr>
		
IGWEZE;
                               
									echo $homeworkQuestDiv;  
		                        }
								
								
							}catch(PDOException $e) {
  			
								fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
								 
							}		
								
								
						}


?>						
								</tbody>
							</table>
							<!-- table -->
						</div>	
					</div>
				</div>
				<!-- card end -->	
			</div>
		</div>
		<!-- / row -->	
					 