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
					
			$onlineCourseDataArr = onlineCourseData($conn); /* online course array */
			$onlineCourseDataCount = count($onlineCourseDataArr);
				 
		}catch(PDOException $e) {
  			
			fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			 
		}		

?> 	    

      <div id="course-load-wrapper">
        
        <!-- Start Course Area -->
        <section class="fob-section fob-course section-gap  position-relative">
			
			<div class="container fob-container">
			<div class="row">
				<div class="col-12">
                    <div class="fob-section-head d-flex-end-between">
                        <div class="fob-section-head-info">
                        <span class="fob-section-head-sm-title"
                            >Virtual Courses</span
                        >
                        <h3 class="fob-section-head-big-title fob-split-text left">
                            Online <span>Learning</span> 
                        </h3>
                        </div>
                        <div class="fob-section-head-btn">
                        <a href="javascript:;" class="fob-button"
                            >Courses <i class="mdi mdi-teach"></i>
                        </a>
                        </div>
                    </div>
				</div>
			</div> 


			<div class="row">

				<?php

				$rating = 0;
				$star_counts = 0;
				$five_star_rating = 0;
				$four_star_rating = 0;
				$three_star_rating = 0;
				$two_star_rating = 0;
				$one_star_rating = 0;
				$inner_details = ""; 

				if($onlineCourseDataCount >= $fiVal){  /* check array is empty */	
							
					for($i = $fiVal; $i <= $onlineCourseDataCount; $i++){  /* loop array */		
					
                        $cid = $onlineCourseDataArr[$i]["cid"];
                        $sessionID = $onlineCourseDataArr[$i]["session"];
                        $level = $onlineCourseDataArr[$i]["level"];
                        $eTerm = $onlineCourseDataArr[$i]["eTerm"];
                        $class = $onlineCourseDataArr[$i]["class"];
                        $eStaff = $onlineCourseDataArr[$i]["eStaff"];
                        $eTitle = ucwords($onlineCourseDataArr[$i]["eTitle"]);
                        $eSubject = $onlineCourseDataArr[$i]["eSubject"];
                        $eDetail = htmlspecialchars_decode($onlineCourseDataArr[$i]["eDetail"]);
                        $eTime = $onlineCourseDataArr[$i]["eTime"];
                        $status = $onlineCourseDataArr[$i]["status"];
                        
                        $eTerm = $termIntList[$eTerm];  
                        
                        $countQuest = courseTopics($conn, $cid);  /* online course chapter information */
                        $countTopics = count($countQuest); 
                        
                        if (str_contains($eSubject, '@!fob!@')) {
                            list ($course_rcode, $course_code, $course_title) = explode ("@!fob!@", $eSubject);
                        }else{
                            $course_rcode = $course_code = $course_title = "";
                        }

                        if($status == 0){

                            $course_btn = '<a href="javascript:;"  class ="text-danger fob-course-btn">
											<i class="mdi mdi-lock-clock label-icon"></i>  Course Locked	 											
										</a>';

                        }else{

                            $course_btn = '<a href="javascript:;" id="fobrain-'.$cid.'" class ="load-course fob-course-btn">
											<i class="mdi mdi-arrow-right-bold-hexagon-outline"></i>  Enroll Now 	 											
										</a>';

                        }

                        $review_arr = courseReviewArray($conn, $cid);  /* online course topic array */	
                                $reviewCount = count($review_arr);

                        foreach($review_arr as $rating_row){

                            $rating+= $rating_row['rating'];
                            $star_counts += 1;
                            if($rating_row['rating'] == 5) {
                                $five_star_rating +=1;
                            } else if($rating_row['rating'] == 4) {
                                $four_star_rating +=1;
                            } else if($rating_row['rating'] == 3) {
                                $three_star_rating +=1;
                            } else if($rating_row['rating'] == 2) {
                                $two_star_rating +=1;
                            } else if($rating_row['rating'] == 1) {
                                $one_star_rating +=1;
                            }

                        }
                        
                        $average = 0;
                        if($rating && $star_counts) {
                            $average = $rating/$star_counts;
                        }	 

                        $average_rating = round($average, 0);
                        for ($iq = 1; $iq <= 5; $iq++) {
                            $rate_class = "off-color";
                            if($iq <= intval($average_rating)) {
                            $rate_class = "on-color";
                            } 
                                            
                            $inner_details .='<li><i class="mdi mdi-star '.$rate_class.'"></i></li>';
                        
                        }  

                        $sub_staff = staffData($conn, $eStaff);  /* school staffs/teachers information */ 
                        list ($title, $st_fullname, $st_sex, $st_rank, $pic, 
                            $st_lname) = explode ("#@s@#", $sub_staff); 

                        //$titleVal = wizSelectArray($title, $title_list);
                        
                        //$staffs_name = $titleVal.' '.$st_lname;
						$staffs_name = $st_lname;
                        $staff_img = picture($staff_pic_ext, $pic, "staff"); 

						if($eTime > 1){

							$course_dur = intval($eTime) / 60;

							$course_dur = floor($course_dur);

							if($course_dur == 1){
								$course_duration = "$course_dur hour";
							}else{
								$course_duration = "$course_dur hours";
							}

						}	
                    
                        $serial_no++;								

$course_rows =<<<IGWEZE
		

					<!-- Single Course Card -->
					<div class="col-lg-6 col-xl-4 col-md-6 col-12 mb-30">
						<div
						class="fob-course-card wow fadeInUp  h-100-0"
						data-wow-delay=".5s"
						data-wow-duration="1s">
						<a href="javascript:;" class="fob-course-img">
						<img
							src="$staff_img"
							alt="$staffs_name picture"
						/>
						</a>
						<a href="javascript:;" class="fob-course-tag">$course_code</a>
							<div class="fob-course-body">
								<div class="fob-course-lesson">
									<div class="course-user me-20">
										<i class="mdi mdi-clock"></i>
										<p>$course_duration</p>
									</div>
									<div class="course-user">
										<i class="mdi mdi-account-tie"></i>
										<p>$staffs_name</p>
									</div>
								</div>
								<div class="fob-course-rattings">
									<ul>
										$inner_details
									<li>
										<span>($average / 5.0 Ratings)</span>
									</li>
									</ul>
								</div>
								<a href="javascript:;" class="fob-course-title">
									<h5>$course_title</h5>
								</a>
								<hr class="my-15 text-danger" />
								<a href="javascript:;" class="fob-course-title">
									<h5>$eTitle</h5>
								</a>
								<div class="fob-course-bottom">
									$course_btn
									<span class="fob-course-price"><i class="mdi mdi-book-education-outline"></i> $countTopics</span>
								</div>
							</div>
						</div> 
					</div> 
		
IGWEZE;
								
						echo $course_rows;  
						
						$rating = 0;
						$star_counts = 0;
						$five_star_rating = 0;
						$four_star_rating = 0;
						$three_star_rating = 0;
						$two_star_rating = 0;
						$one_star_rating = 0;
						$inner_details = "";

					} 
								
				}

?>           
				
					</div>    
				</div>
			</div>
		</section>
		
	</div>    			

                
        <!--  fobrain modal start -->			
		<button type="button" class="btn modal-fobrain  display-none"  data-bs-toggle="modal" data-bs-target="#modal-fobrain"></button>				
		<!-- Scrollable modal -->
		<div class="modal fade animate__animated animate__zoomInDown" id="modal-fobrain" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
			<div class="modal-dialog modal-fullscreen modal-dialog-scrollable">
				<div class="modal-content">
					<div class="modal-header"> 
						<h5 class="modal-title" id="exampleModalScrollableTitle"> 
							<i class="mdi mdi mdi-teach label-icon"></i>  
							Course Video
						</h5>							 
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div id="edit-msg"> </div> 
					<div class="modal-body">
						<div id="modal-load-div"></div> 
					</div> 
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		<!-- fobrain modal end -->   


         