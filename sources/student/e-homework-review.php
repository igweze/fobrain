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
	This page load student online home work results
	------------------------------------------------------------------------*/ 


		if (!defined('fobrain')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
				
		require_once $fobrainIconPage; /* This include top middle global icon page eg go back, print buttons etcs */
			
	 
		try {
					
			$eHomeWorkDataArr = eStudentHomeWorkReview($conn, $regNum); /* online student home work array */							
			$eHomeWorkDataCount = count($eHomeWorkDataArr);
			
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
						$page_title = '<i class="mdi mdi-list-status fs-18"></i> 
						My eHomeWork Results';
						pageTitle($page_title, 0);		 
					?>
					<div class="card-body" id="homeworkQuestDiv">	
					
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
										<th>Time</th> 
										<th>Correct</th> 
										<th>Ques. No.</th> 
										<th>My Score</th> 
										<th>Total Score</th> 
										<th>Date</th> 
									</tr>
								</thead> 
								<tbody>

<?php
						
						if($eHomeWorkDataCount >= $fiVal){  /* check array is empty */		
														
							try { 
								
								$serial_no = 0;

								for($i = $fiVal; $i <= $eHomeWorkDataCount; $i++){  /* loop array */		
								
									$rid = $eHomeWorkDataArr[$i]["rid"];
									$eid = $eHomeWorkDataArr[$i]["eid"]; 
									$level = $eHomeWorkDataArr[$i]["level"];
									$eTerm = $eHomeWorkDataArr[$i]["term"];
									$class = $eHomeWorkDataArr[$i]["class"];
									$course = $eHomeWorkDataArr[$i]["course"];
									$correct = $eHomeWorkDataArr[$i]["correct"];
									$quesno = $eHomeWorkDataArr[$i]["quesno"];
									$yscore = $eHomeWorkDataArr[$i]["yscore"];
									$tscore = $eHomeWorkDataArr[$i]["tscore"];
									$etime = $eHomeWorkDataArr[$i]["etime"]; 
									$ttime = $eHomeWorkDataArr[$i]["ttime"];
									$aver = $eHomeWorkDataArr[$i]["aver"];

									$eTerm = $termIntList[$eTerm];   
									$homeworkLevel = $levelArray[$level]['level'];

									$serial_no++;
									
									 

$homeworkQuestDiv =<<<IGWEZE
        
										<tr id="row-$eid">
										<td>$serial_no</td>
										<td>$course</td> 
										<td>$homeworkLevel $class</td> 
										<td>$eTerm Term</td> 
										<td>$etime Mins</td>
										<td>$correct</td> 
										<td>$quesno</td> 
										<td>$yscore ($aver%)</td>
										<td>$tscore</td>
										<td>$ttime</td> 
 
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
					 