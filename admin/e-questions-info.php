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
	This script handle student exam questions information
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

     	define('fobrain', 'igweze');  /* define a check for wrong access of file */

		require 'fobrain-config.php';  /* load fobrain configuration files */
		
		if($eID == "") { $eID = cleanInt($_REQUEST['eID']); }
		
		try {
		
			$examQuestionsArr = examQuestions($conn, $eID);  /* online exam question array */	
			$examQuestionsCount = count($examQuestionsArr);
			
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
						<th>SN</th>
						<th>Exam Question </th>  
						<th> Answer </th>
						<th> Mark </th>
						<th> Tasks </th>
					</tr>
				</thead>
				<tbody>					

<?php 
				
					if($examQuestionsCount >= $fiVal){  /* check array is empty */														
						
						for($i = $fiVal; $i <= $examQuestionsCount; $i++){  /* loop array */	 
						
							$qID = $examQuestionsArr[$i]["qID"];
							$eID = $examQuestionsArr[$i]["eID"];
							$qPicture = $examQuestionsArr[$i]["qPicture"];
							$question = htmlspecialchars_decode($examQuestionsArr[$i]["question"]); 
							$q1 = $examQuestionsArr[$i]["q1"];
							$q2 = $examQuestionsArr[$i]["q2"];
							$q3 = $examQuestionsArr[$i]["q3"];
							$q4 = $examQuestionsArr[$i]["q4"];
							$ans = $examQuestionsArr[$i]["ans"];
							$qMark = $examQuestionsArr[$i]["qMark"];
							
							//$questionS = substr($question, 0, 30);
							//$questionS = $questionS.' . . .';
							//$questionS = nl2br($questionS); 
							$questionS = "wiz";
							$ans = wizSelectArray($ans, $question_list_2);

							$eQPic = $fobrainQuestionDir.$qPicture;
							
							if(($qPicture != "") && (file_exists($eQPic))){  /* check if picture exits */ 
	
								$question_div = '	

									<div class="d-flex align-items-center">
										<div class="flex-shrink-0 me-3"> 
											<img src = "'.$eQPic.'"  class="img-h-40 img-circle img-thumbnail" > 
										</div>
										<div class="flex-grow-1 text-primary">
											'.$question.'
										</div>
									</div> 
								';  
		
							}else{ $question_div  = $question; }	
				
							$serial_no++; 

							/*
							<td> 
									Option A $q1 <hr/>
									Option B $q2 <hr/>
									Option C $q3 <hr/>
									Option D $q4 <hr/> 
								</td>*/

$examQuestions =<<<IGWEZE
								
							<tr id="row-$qID">
								<td>$serial_no</td> 
								<td> $question_div</td>  
								<td> <span class="badge bg-success">Option $ans</span></td> 
								<td> $qMark </td>
								<td>
									<div class="btn-group">
										<a href="javascript:;" class="btna btn-tasks  waves-effect waves-light dropdown-toggle p-5" data-bs-toggle="dropdown" aria-haspopup="true"
										data-bs-display="static" aria-expanded="false">
											<i class="mdi mdi-dots-grid align-middle fs-18"></i>
										</a> 
										<div class="dropdown-menu dropdown-menu-lg-end p-10 dropdown-shadow end-0 animate__animated animate__flipInY">  
											<p class="mb-10">
												<a href='javascript:;' id='$qID' class ='viewQuestion text-sienna btn waves-effect btn-label waves-light'>									
													<i class="mdi mdi-text-box-search label-icon"></i> View 
												</a>	
											</p>
											<p class="mb-10">
												<a href='javascript:;' id='fobrain-$qID-$eID' class ='editQuestion text-slateblue btn waves-effect btn-label waves-light'>									
													<i class="mdi mdi-square-edit-outline label-icon"></i> Edit
												</a>	
											</p>
											<p>
												<a href='javascript:;' id='fobrain-$qID-$questionS' class ='removeQuestion demo-disenable text-danger btn waves-effect btn-label waves-light'>									
													<i class="mdi mdi-delete label-icon"></i> Delete
												</a>	
											</p> 
										</div>
									</div>    
								</td>
							</tr>

IGWEZE;
						
							echo $examQuestions; 

						}
						
					} 

?>                   
				
				</tbody>
			</table>				
			<!-- / table -->
		</div>		