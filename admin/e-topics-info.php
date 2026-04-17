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
	This script handle student course topics information
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

    	define('fobrain', 'igweze');  /* define a check for wrong access of file */

		require 'fobrain-config.php';  /* load fobrain configuration files */
		
		if($cid == "") { $cid = cleanInt($_REQUEST['cid']); }
		
		$inner_details = "";

		try {
		
			$courseTopicsArr = courseTopics($conn, $cid);  /* online course topic array */	
			$courseTopicsCount = count($courseTopicsArr);
			
		}catch(PDOException $e) {
		
			fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
		} 
		 
?>

 
<!--
		<script type='text/javascript'>  renderTable(); </script>
		<div class="table-responsive">
			<!- - table -- >
			<table class='table table-hover table-responsive style-table wiz-table' id="wiz-table">					
				<thead>
					<tr>
						<th>SN</th>
						<th>Course Topic </th>  
						<th> Answer </th>
						<th> Course Chapters </th>
						<th> Tasks </th>
					</tr>
				</thead>
				<tbody>		
					
-->

<?php 

		if($courseTopicsCount >= $fiVal){  /* check array is empty */														
			
			for($i = $fiVal; $i <= $courseTopicsCount; $i++){  /* loop array */	 
			
				$tid = $courseTopicsArr[$i]["tid"];
				$cid = $courseTopicsArr[$i]["cid"];
				$topic = ucwords($courseTopicsArr[$i]["topic"]); 

				$topicS = "wiz";  

				$serial_no++; 

				if($serial_no == 1){
					$toggle_accord = "show";
					$toggle_laspse = "";
					$toggle_aria = true;
				}else{
					$toggle_accord = "";
					$toggle_laspse = "collapsed";
					$toggle_aria = false;
				}

				$accord_num = $serial_no.'-'.$tid.'-'.$cid;

				$chapters_arr = courseChapters($conn, $cid, $tid); 

				foreach ($chapters_arr as $chapter_rows){

					//echo "<pre>"; print_r($rows); echo "</pre>";

               	 	$hid = $chapter_rows['hid'];
					$course_time = $chapter_rows['duration'];
					$course_title_ch = $chapter_rows['chapter'];
					$course_type = $chapter_rows['ctype'];
					$upload = $chapter_rows['upload'];

               		$inner_id = "fobrain-$hid-$cid-$tid";

					if($course_type == 1){

						$download_link = $fobrainCourseDir.$upload;
						//target="_blank"
						$inner_details .= '
						<li>

							<a href="'.$download_link.'" id="'.$inner_id.'" 
								class="display-none"  download>
								<i class="mdi mdi-file-document-outline"></i>
								'.$course_title_ch.'
							</a>
						
							<div class="text"> 
								
								<i class="mdi mdi-file-document-outline"></i>
								'.$course_title_ch.'
								
							</div>
							<div class="icon"> 
								<a class="course-quiz btn btn-primary me-10" id="'.$inner_id.'">
									<i class="mdi mdi-progress-question"></i> Quiz
								</a>
								<a class="edit-chapter btn btn-primary me-10" id="'.$inner_id.'">
									<i class="mdi mdi-square-edit-outline"></i>
								</a>  
								<a class="remove-chapter btn btn-danger me-15" id="'.$inner_id.'">
									<i class="mdi mdi-delete label-icon"></i>
								</a> 
								<a href="'.$download_link.'" class="download-course-0ff" 
									data-code="'.$inner_id.'" download>
									Download
									<i class="mdi mdi-file-download-outline"></i>
								</a>
							</div>
							
						</li>';

					}else{  

						$inner_details .= '
						<li class="load-course-video" id="'.$hid.'">
							<div class="text">
								<i class="mdi mdi-video-outline"></i>
								'.$course_title_ch.'
							</div>
							<div class="icon"> 

								<a class="course-quiz btn btn-primary me-10" id="'.$inner_id.'">
									<i class="mdi mdi-progress-question"></i> Quiz
								</a>
								<a class="edit-chapter btn btn-primary me-10" id="'.$inner_id.'">
									<i class="mdi mdi-square-edit-outline"></i>
								</a>  
								<a class="remove-chapter btn btn-danger me-15" id="'.$inner_id.'">
									<i class="mdi mdi-delete label-icon"></i>
								</a> 

								'.$course_time.' Mins
								<i class="mdi mdi-motion-play"></i>
							</div>
						</li>';

					}

					/*

					$inner_details .= '
					<li>
						<div class="text">
						<i class="mdi mdi-video-outline"></i>
						'.$course_title.'
						</div>
						<div class="icon"> 
						<a class="edit-chapter btn btn-primary" id="'.$inner_id.'">
						<i class="mdi mdi-square-edit-outline"></i></a>  
						<a class="remove-chapter btn btn-danger" id="'.$inner_id.'">
						<i class="mdi mdi-delete label-icon"></i></a> 
						'.$course_time.' Mins
						<i class="mdi mdi-motion-play"></i>
						</div>
					</li>';

					*/

				}	

				echo '
		        <div class="fob-course-curriculum mt-20">
                    <div  class="fob-course-accordion accordion" id="accordionExample">';

$chapter_div =<<<IGWEZE


						<!-- Course Curriculum Item -->
						<div class="fob-course-accordion-item">
							<h2 class="accordion-header" id="heading-$accord_num">  
			 
							<button
								class="accordion-button $toggle_laspse"
								type="button"
								data-bs-toggle="collapse"
								data-bs-target="#collapse-$accord_num"
								aria-expanded="$toggle_aria"
								aria-controls="collapse-$accord_num">
								$serial_no) $topic 
							</button>
							</h2>
							<div
							id="collapse-$accord_num"
							class="accordion-collapse collapse $toggle_accord"
							aria-labelledby="heading-$accord_num"
							data-bs-parent="#accordionExample">
							
								<div class="fob-course-accordion-body">
									<ul> 
										<li>
											<div class="text"> 
											 
											</div> 
											<div class="icon">   
												<a class="edit-chapter btn btn-primary" id="fobrain-$i_false-$cid-$tid">
												<i class="mdi mdi-plus-circle-outline"></i> Add Topic</a> 
												<a class="remove-chapter btn btn-danger me-10" id="fobrain-$i_false-$cid-$tid">
												<i class="mdi mdi-delete label-icon"></i></a>
											</div>
										</li>
										$inner_details 
									</ul>
								</div>
							</div>
						</div>
						<!-- Course Curriculum Item --> 

IGWEZE;
                               
						echo $chapter_div; 

				echo '
					</div>
				</div>';    

				$inner_details = $inner_id = ""; 
						 

$courseTopics =<<<IGWEZE
								
							<tr id="row-$tid">
								<td>$serial_no</td> 
								<td> $topic</td>  
								<td> </td> 
								<td>
								
									<button type="button" class="btn btn-primary waves-effect   
									btn-label waves-light edit-chapter" id="fobrain-$i_false-$cid-$tid">
										<i class="mdi mdi-square-edit-outline label-icon"></i>  Add Course Info
									</button>

								</td>
								<td>
									<div class="btn-group">
										<a href="javascript:;" class="btna btn-tasks  waves-effect waves-light dropdown-toggle p-5" data-bs-toggle="dropdown" aria-haspopup="true"
										data-bs-display="static" aria-expanded="false">
											<i class="mdi mdi-dots-grid align-middle fs-18"></i>
										</a> 
										<div class="dropdown-menu dropdown-menu-lg-end p-10 dropdown-shadow end-0 animate__animated animate__flipInY">  
											<!--
											<p class="mb-10">
												<a href='javascript:;' id='$tid' class ='viewTopic text-sienna btn waves-effect btn-label waves-light'>									
													<i class="mdi mdi-text-box-search label-icon"></i> View 
												</a>	
											</p>
											-->
											<p class="mb-10">
												<a href='javascript:;' id='fobrain-$tid-$cid' class ='editTopic text-slateblue btn waves-effect btn-label waves-light'>									
													<i class="mdi mdi-square-edit-outline label-icon"></i> Edit
												</a>	
											</p>
											<p>
												<a href='javascript:;' id='fobrain-$tid-$topicS' class ='removeTopic demo-disenable text-danger btn waves-effect btn-label waves-light'>									
													<i class="mdi mdi-delete label-icon"></i> Delete
												</a>	
											</p> 
										</div>
									</div>    
								</td>
							</tr>

IGWEZE;
						
							//echo $courseTopics; 

						}
						
					} 

?>                   
				<!--
				</tbody>
			</table>				
			<! -- / table -- >
		</div>		-->