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
	This script handle student online courseination
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}
 
    	define('fobrain', 'igweze');  /* define a check for wrong access of file */

        require 'fobrain-config.php';  /* load fobrain configuration files */ 
		
		/* script validation*/ 
				
		if ($_REQUEST['query'] == 'load') {  /* load courseination module */
			
			$cid =   cleanInt($_REQUEST['cid']);
			
			/* script validation */
			
			if ($cid == ""){
				
				$msg_e = "* Ooops, an error has occur to retrieve course information. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
					
	   		}else{ 
				 
				try {

					$course_array = onlineCourseInfo($conn, $cid); /* online course array */ 

					$courseTopicsArr = courseTopics($conn, $cid);  /* online course topic array */	
					$courseTopicsCount = count($courseTopicsArr);
					$inner_details = "";

					$review_arr = courseReviewArray($conn, $cid);  /* online course topic array */	
        			$review_counts = count($review_arr);

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
					
				} 		 

				if(is_array($course_array)){

					$course_count = count($course_array);

					if($course_count == 1){
 
						//$cid = $course_array[1]["cid"];
						$sessionID = $course_array[1]["session"];
						$level = $course_array[1]["level"];
						$eTerm = $course_array[1]["eTerm"];
						$class = $course_array[1]["class"];
						$eStaff = $course_array[1]["eStaff"];
						$eTitle = ucwords($course_array[1]["eTitle"]);
						$eSubject = $course_array[1]["eSubject"];
						$eDetail = htmlspecialchars_decode($course_array[1]["eDetail"]);
						$eTime = $course_array[1]["eTime"];
						$status = $course_array[1]["status"];
 
						$eDetail = nl2br($eDetail); 

						if (str_contains($eSubject, '@!fob!@')) {
							list ($course_rcode, $course_code, $course_title) = explode ("@!fob!@", $eSubject);
						}else{
							$course_rcode = $course_code = $course_title = "";
						}

						$sub_staff = staffData($conn, $eStaff);  /* school staffs/teachers information */ 
						list ($title, $st_fullname, $st_sex, $st_rank, $pic, 
							$st_lname) = explode ("#@s@#", $sub_staff); 

						$titleVal = wizSelectArray($title, $title_list);
						
						$staffs_name = $titleVal.' '.$st_fullname;
						$staff_img = picture($staff_pic_ext, $pic, "staff"); 

					}else{

						$msg_e = "* Ooops, an error has occur to retrieve course information. Please try again";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;

					} 
					

				} 
					 
		?>  
		
		<!-- Start Course Details Area -->
		<section class="fob-section fob-course-details section-gap position-relative">
			<div class="container fob-container">

			<div class="row">
				<div class="col-12">
				<div class="fob-section-head d-flex-end-between">
					<div class="fob-section-head-info">
					<span class="fob-section-head-sm-title"
						><?php echo $eSubject; ?> </span
					>
					<h3 class="fob-section-head-big-title fob-split-text left">
						<span>Learning</span>  
						<br />  <?php echo $eTitle; ?> 
					</h3>
					</div>
					<div class="fob-section-head-btn">
					<a href="javascript:;" class="fob-button navigate" id="courses"
						>Back to Courses <i class="mdi mdi-arrow-right-bold-hexagon-outline"></i>
					</a>
					</div>
				</div>
				</div>
			</div>

			<div class="row mt-30">
				<div class="col-lg-12 col-xl-8 col-12">
				<div class="fob-course-details-tab">
					<div class="row">
					<div class="col-12">
						<!-- Tab Menu -->
						<div class="fob-course-tab-menu tab-menu">
						<div class="list-group" id="list-tab" role="tablist">
							<a
							class="list-group-item active"
							data-bs-toggle="list"
							href="#overview"
							role="tab"
							>
							Overview
							</a>
							<a
							class="list-group-item"
							data-bs-toggle="list"
							href="#curriculum"
							role="tab"
							>
							Curriculum
							</a>
							<a
							class="list-group-item"
							data-bs-toggle="list"
							href="#instructor"
							role="tab"
							>
							Instructor
							</a>
							<a
							class="list-group-item"
							data-bs-toggle="list"
							href="#reviews"
							role="tab"
							>
							Reviews
							</a>
						</div>
						</div>
					</div>
					<div class="col-12">
						<!-- Tab Details -->
						<div class="fob-course-tab-details tab-details">
						<div class="tab-content" id="nav-tabContent">
							<!-- Overview -->
							<div
							class="tab-pane fade show active"
							id="overview"
							role="tabpanel"
							>
							<div class="fob-course-overview">
								<div class="fob-course-overview-widget">
									<h3 class="fob-course-overview-title">
										Course Description
									</h3>
									<div class="text-justify">
										<?php echo $eDetail; ?>
									</div>

									
									<p class="text-justify">
										
									</p>
								 
								</div>

								<!--
								<div class="fob-course-overview-widget">
									<h3 class="fob-course-overview-title">
										What You'll Learn?
									</h3>
									<ul>
										<li>
											<i class="mdi mdi-check-circle"></i >
											Nurturing Young Minds
										</li> 
									</ul>
								 
								</div> 
								-->
							</div>
							</div>
							<!-- Curriculum -->
							<div
							class="tab-pane fade"
							id="curriculum"
							role="tabpanel"
							>
 


							<?php 

								if($courseTopicsCount >= $fiVal){  /* check array is empty */														
									
									$timer_count = 0;

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
										 
											$hid = $chapter_rows['hid'];
											$course_time = $chapter_rows['duration'];
											$course_type = $chapter_rows['ctype'];
											$upload = $chapter_rows['upload'];
											$course_title_ch = $chapter_rows['chapter'];

											$timer_count += intval($course_time); 

											$inner_id = "fobrain-$hid-$cid-$tid"; 
										 
											if($course_type == 1){

												/*
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
													<a href="'.$download_link.'" class="download-course-0ff" 
														data-code="'.$inner_id.'" download>
														Download
														<i class="mdi mdi-file-download-outline"></i>
													</a>
													</div>
													
												</li>';

												*/

												$inner_details .= '
												<li class="load-course-video " id="'.$hid.'"												
													course-img="'.$staff_img.'"
													course-staff="'.$staffs_name.'"
													course-chapter="'.$topic.'"
													course-topic="'.$course_title_ch.'"
													course-id="'.$inner_id.'"
													course-time="'.$course_time.'" 
												>
													<div class="text">
														<i class="mdi mdi-file-document-outline"></i>
														'.$course_title_ch.'
													</div> 
													<div class="icon">  
														<i class="mdi mdi-file-download-outline"></i> 
													</div>
												</li>';

											}else{  

												$inner_details .= '
												<li class="load-course-video " id="'.$hid.'"												
													course-img="'.$staff_img.'"
													course-staff="'.$staffs_name.'"
													course-chapter="'.$topic.'"
													course-topic="'.$course_title_ch.'"
													course-id="'.$inner_id.'"
													course-time="'.$course_time.'" 
												>
													<div class="text">
														<i class="mdi mdi-video-outline"></i>
														'.$course_title_ch.'
													</div> 
													<div class="icon">  
														<i class="mdi mdi-motion-play"></i>  
														'.$course_time.' Mins
													</div>
												</li>';

											}

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
						
						

									}
												
								} 
 
								/*
								if($timer_count > 1){

									$course_dur = intval($timer_count) / 60;

									$course_dur = floor($course_dur);

									if($course_dur == 1){
										$course_duration = "$course_dur hour";
									}else{
										$course_duration = "$course_dur hours";
									}

								}
								*/

								if($eTime > 1){

									$course_dur = intval($eTime) / 60;

									$course_dur = floor($course_dur);

									if($course_dur == 1){
										$course_duration = "$course_dur hour";
									}else{
										$course_duration = "$course_dur hours";
									}

								}	

							?>                
 


							</div>
							<!-- Instructor -->
							<div
							class="tab-pane fade"
							id="instructor"
							role="tabpanel"
							>
							<div class="fob-course-instructor">
								<div class="fob-course-instructor-thumb">
								<img
									src="<?php echo $staff_img; ?>"
									alt="instructor picture"
								/>
								</div>
								<div class="fob-course-instructor-info">
								<h6><?php echo $staffs_name; ?></h6>
								<span><?php echo  $course_title; ?></span>
								<p>
									Staff History
								</p>
								<ul>
									<li>
									<a href="#">
										<i class="mdi mdi-twitter"></i>
									</a>
									</li>
									<li>
									<a href="#">
										<i class="mdi mdi-facebook"></i>
									</a>
									</li>
									<li>
									<a href="#">
										<i class="mdi mdi-instagram"></i>
									</a>
									</li>
									<li>
									<a href="#">
										<i class="mdi mdi-linkedin"></i>
									</a>
									</li>
								</ul>
								</div>
							</div>
							</div>
							<!-- Reviews -->
							<div
							class="tab-pane fade"
							id="reviews"
							role="tabpanel"
							>
							<div class="fob-course-review"> 

							<?php
								$rating = 0;
								$star_counts = 0;
								$five_star_rating = 0;
								$four_star_rating = 0;
								$three_star_rating = 0;
								$two_star_rating = 0;
								$one_star_rating = 0;	
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

								?>
								<div class="row">
								<div class="col-lg-4">
									<div class="fob-course-rating-box">
									<div class="fob-course-rating-number">
										<?php printf('%.1f', $average); ?> <small>/ 5</small>
									</div>
									<div class="rating mb-10">

										<?php
										$average_rating = round($average, 0);
										for ($i = 1; $i <= 5; $i++) {
											$rate_class = "off-color";
											if($i <= intval($average_rating)) {
												$rate_class = "on-color";
											} 
										?> 
										 
										<i class="mdi mdi-star <?php echo $rate_class; ?>"></i>
										 
										<?php } ?>  
										 
									</div>
									<span>(<?php echo $review_counts; ?> Review)</span>
									</div>
								</div>
								<div class="col-lg-8">
									<div class="fob-course-review-wrapper">
									<div class="single-progress-bar">
										<div class="rating-text">
										5 <i class="mdi mdi-star"></i>
										</div>
										<div class="progress">
										<div
											class="progress-bar bg-success"
											role="progressbar"
											style="width: <?php echo $five_star_percent; ?>"
											aria-valuenow="100"
											aria-valuemin="0"
											aria-valuemax="100"
										></div>
										</div>
										<span class="rating-value"><?php echo $five_star_rating; ?></span>
									</div>
									<div class="single-progress-bar">
										<div class="rating-text">
										4 <i class="mdi mdi-star"></i>
										</div>
										<div class="progress">
										<div
											class="progress-bar bg-primary"
											role="progressbar"
											style="width: <?php echo $four_star_percent; ?>"
											aria-valuenow="0"
											aria-valuemin="0"
											aria-valuemax="100"
										></div>
										</div>
										<span class="rating-value"><?php echo $four_star_rating; ?></span>
									</div>
									<div class="single-progress-bar">
										<div class="rating-text">
										3 <i class="mdi mdi-star"></i>
										</div>
										<div class="progress">
										<div
											class="progress-bar bg-info"
											role="progressbar"
											style="width: <?php echo $three_star_percent; ?>"
											aria-valuenow="0"
											aria-valuemin="0"
											aria-valuemax="100"
										></div>
										</div>
										<span class="rating-value"><?php echo $three_star_rating; ?></span>
									</div>
									<div class="single-progress-bar">
										<div class="rating-text">
										2 <i class="mdi mdi-star"></i>
										</div>
										<div class="progress">
										<div
											class="progress-bar bg-warning"
											role="progressbar"
											style="width: <?php echo $two_star_percent; ?>"
											aria-valuenow="0"
											aria-valuemin="0"
											aria-valuemax="100"
										></div>
										</div>
										<span class="rating-value"><?php echo $two_star_rating; ?></span>
									</div>
									<div class="single-progress-bar">
										<div class="rating-text">
										1 <i class="mdi mdi-star"></i>
										</div>
										<div class="progress">
										<div
											class="progress-bar bg-danger"
											role="progressbar"
											style="width: <?php echo $one_star_percent; ?>"
											aria-valuenow="0"
											aria-valuemin="0"
											aria-valuemax="100"
										></div>
										</div>
										<span class="rating-value"><?php echo $one_star_rating; ?></span>
									</div>
									</div>
								</div>
								</div>
								<div class="fob-course-comment-wrapper">
								<h3 class="fob-course-comment-title text-primary">
									Reviews
								</h3>

								<?php

								foreach($review_arr as $rating_row_2){		 
									
									$date = date_create($rating_row_2['created']);
									$reviewDate = date_format($date,"M d, Y");	
									$regNo = $rating_row_2['regnum'];
									$rid = $rating_row_2['rid'];
									$rating_rev = $rating_row_2['rating'];
									$programID = $rating_row_2['program'];	
									$student_rev = htmlspecialchars_decode($rating_row_2['review']);
									$student_review = nl2br($student_rev); 

									$student_name = studentName($conn, $regNo);  /* student name  */
									$student_img = studentPicture($conn, $regNo);  /* student picture  */
									
									/*
									if($regNo == $_SESSION['regNo']){

										$student_review_frm = $student_rev;
										$review_query = "update";
										$review_id = $rid;
										$review_rating = $rating_rev;

									}else{

										$student_review_frm = "";
										$review_query = "save";
										$review_id = "";
										$review_rating = "";

									}
									*/

									
								?>				
									 				
								

								<!-- Single Comment -->
								<div class="fob-course-comment">
									<div class="fob-course-comment-thumb">
										
									<img
										src="<?php echo $student_img ?>"
										alt="students's picture"
									/>
									</div>
									<div class="fob-course-comment-content">
									<div class="fob-course-comment-top">
										<h6 class="title text-primary"><?php echo $student_name; ?></h6>
										<div class="rating">

											<?php
											for ($i = 1; $i <= 5; $i++) {
												$rate_class = "off-color";
												if($i <= $rating_row_2['rating']) {
													$rate_class = "on-color";
												}
											?>
											<i class="mdi mdi-star <?php echo $rate_class; ?>"></i>
											 							
											<?php } ?> 
											 
										</div>
									</div>
									<!--
									<span class="subtitle"
										>Title is here</span
									>-->
									<p>
										<?php echo $student_review; ?>
									</p>
									</div>
								</div>

								<?php } ?>

								<div id="msg-box"></div>

								<!-- row -->
								<div class="row gutters mt-50 frm-course-review">   
 
									<div class="col-12 mb-5">
										<h4 class="text-danger"> Rate this Course </h4>
										<div class="rating-comment p-0 m-0">
											<input type="radio" id="star5" name="rating" class="rating" value="5" />
											<label for="star5" title="text">5 stars</label>
											<input type="radio" id="star4" name="rating" class="rating" value="4" />
											<label for="star4" title="text">4 stars</label>
											<input type="radio" id="star3" name="rating" class="rating" value="3" />
											<label for="star3" title="text">3 stars</label>
											<input type="radio" id="star2" name="rating" class="rating" value="2" />
											<label for="star2" title="text">2 stars</label>
											<input type="radio" id="star1" name="rating" class="rating" value="1" />
											<label for="star1" title="text">1 star</label>
										</div>
									</div>	

									<?php 

									try {
										$user_review_info = courseUserReview($conn, $cid, $_SESSION['regNo']);
									}catch(PDOException $e) {
												
										fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
											
									}	

									if(is_array($user_review_info)){

										$user_review_count = count($user_review_info);

										if($user_review_count == 1){ 
									
											$review_id = $user_review_info[1]["rid"];
											$review_rating = $user_review_info[1]["rating"];
											$student_review_frm = htmlspecialchars_decode($user_review_info[1]['review']);										 
											$review_query = "update";  

										}else{
											$student_review_frm = "";
											$review_query = "save";
											$review_id = "";
											$review_rating = "";
										}
										
									}else{
										$student_review_frm = "";
										$review_query = "save";
										$review_id = "";
										$review_rating = "";
									}

									if($review_rating != ""){

$script_rating =<<<IGWEZE
        
										<script> 
											$('input[name="rating"][value="$review_rating"]').prop('checked', true);
										</script>
		
IGWEZE;
									

										echo $script_rating;

									}

									?>  

									<div class="col-12" style="float: none !important;">										
										<!-- field wrapper start -->
										<div class="field-wrapper">
											<textarea rows="4" cols="10" class="form-control" name="review" id="review-msg"  required
											placeholder="Enter Chapter Details "><?php echo $student_review_frm; ?></textarea>
											<div class="field-placeholder"> Your Review <span class="text-danger"> * </span></div>
										</div>
										<!-- field wrapper end -->
									</div>

									<div class="col-12 text-end mt-30"> 
										<input type="hidden" name="query" id="review_q_id" value="<?php echo $review_id; ?>" />
										<input type="hidden" name="query" id="review_query" value="<?php echo $review_query; ?>" />
										<input type="hidden" name="in_course_id" id="in_course_id" value="<?php echo $cid; ?>" />
										<button type="submit" class="course-review btn btn-primary waves-effect 
										btn-label waves-light"  id="course-review">
										<i class="mdi mdi-email-send label-icon"></i>  <?php echo ucwords($review_query); ?> Review							
										</button>                                                    
									</div>  

								</div>	 


								</div>
							</div>
							</div>
						</div>
						</div>
						<!-- End Tab Details -->
					</div>
					</div>
				</div>
				</div>
				<div class="col-lg-8 col-xl-4 col-md-8 col-12">
				<div class="fob-course-sidebar">
					<div class="fob-video-bg background-image position-relative"
					style="background-image: url('<?php echo $staff_img; ?>');">
						<!--
						<a
							href="javascript:;"
							class="fob-video-btn popup-video"
						>
							<i class="mdi mdi-motion-play"></i>
						</a>
						-->
					</div>
					<div class="fob-course-sidebar-data">
						<!--<h4 class="fob-course-sidebar-title">Course Includes</h4>-->
						<ul class="fob-course-sidebar-data-list">
							
							<li>
							<span>Instructor :</span>
							<strong><?php echo $st_lname; ?></strong>
							</li>
							<li>
							<span>Duration :</span>
							<strong><?php echo $course_duration; ?>  </strong>
							</li>
							<li>
							<span>Course :</span>
							<strong><?php echo $course_code; ?></strong>
							</li>
							<li>
							<span>Reviews :</span>
							<strong><?php echo $review_counts; ?></strong>
							</li>
						 
						</ul>
						<!--							
						<div class="fob-course-buy-btn">
							<a href="checkout.php" class="fob-button"
							>Buy Now <i class="mdi mdi-arrow-right-bold-hexagon-outline"></i>
							</a>
						</div>
						-->
					</div>
				</div>
				</div>
			</div>
			</div>
		</section>
		 

			<?php
					 
				
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
			}	
			
		}elseif ($_REQUEST['query'] == 'view') {  /* load courseination module */

			?>

 <style>  
 
 
 

 

 </style>
<?php
			$qData =   clean($_REQUEST['hid']);
			$staff_img =   clean($_REQUEST['image']);
			$staffs_name =   clean($_REQUEST['staff']);
			$chapter_title =   clean($_REQUEST['chapter']);
			$ctopic =   clean($_REQUEST['ctopic']);
			$ctime =   clean($_REQUEST['ctime']);  
			
			list ($none, $hid, $cid, $tid) = explode ('-', $qData);	

			/* script validation */
			
			if ($hid == ""){
         			
				$msg_e = "* Ooops, an error has occur to retrieve course information. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
					
	   		}else{

			 

				try {

					$chapterInfoArr = chapterInfo($conn, $hid);  /* online course chapter information */
					//$hid = $chapterInfoArr[$fiVal]["hid"];
					$cid = $chapterInfoArr[$fiVal]["cid"];
					$chapter = htmlspecialchars_decode($chapterInfoArr[$fiVal]["chapter"]);
					$upload = $chapterInfoArr[$fiVal]["upload"]; 
					$details = $chapterInfoArr[$fiVal]["details"];
					$ctype = $chapterInfoArr[$fiVal]["ctype"];
					$link = $chapterInfoArr[$fiVal]["link"];
					$duration = $chapterInfoArr[$fiVal]["duration"];
					$details = nl2br($details);  

					$courseQuizArr = courseQuizInfo2($conn, $cid, $tid, $hid) ;  /* school courseQuiz information */

					$qid = $courseQuizArr[$fiVal]["qid"]; 
					$questionArr = unserialize($courseQuizArr[$fiVal]["questions"]); 

                    $quiz_frm_build = "";

                    if(is_array($questionArr)){ 

						$in = 0; $sn = 1; $grandtotal = 0;

$quiz_frm_build .=<<<IGWEZE
        							  									 
							<div class="fob-course-card-view__preview-txt mb-20"> 
                                <div class="mt-25">
                                    <h1 class="fob-course-card-view__title blue-col"><a href="#">Quiz</a></h1>

                                    <hr class="mt-10 mb-25 text-white" />
                                    <form id="frm-course-quiz" class="pb-50" method="POST">                                    
		
IGWEZE;                        
					                   
						foreach ($questionArr as $input_row) { 
						
							$quiz = $questionArr[$in]['quiz']; 

							if ($quiz != "")  {
									
$quiz_frm_build .=<<<IGWEZE
        							  									                                    
                                <div class="mb-25">
                                    <label for="question-$sn" class="form-label mb-15">$quiz</label>
                                    <textarea class="form-control" placeholder="Leave a answer here" id="question-$sn"></textarea>
                                </div>    
		
IGWEZE;
                                 
							}else{   } 

							$in++;  $sn++; 

						}  

$quiz_frm_build .=<<<IGWEZE
        							  									 
                                    <button type="submit" class="btn btn-primary mb-50" id="course-quiz"> 
										<i class="mdi mdi-email-send-outline"></i> Submit
									</button>
								</form>
							</div>
						</div>                                   
		
IGWEZE;
                                       

					}


					if($ctype == 1){

						$download_link = $fobrainCourseDir.$upload;
						$tag_button = '
						<li class="tag__item play blue-col">
							<a href="'.$download_link.'">
							<i class="mdi mdi-cloud-download-outline mr-2"></i> 
							Download Course
							</a>
						</li>
						';
						$video_player = "";

					}elseif($ctype == 2){ 

						$tag_button = '
							<li class="tag__item">
							<i class="fas fa-clock mr-2"></i> 
							'.$ctime.' mins.
							</li>						
						';

						$upload_doc = $fobrainCourseDir.$upload;

						if(($upload != "") && (file_exists($upload_doc))){  /* check if picture exits */

							//<video width="320" height="240" autoplay muted>

$video_player =<<<IGWEZE
        							  									 
							<video width="100%" height="360" controls>
								<source src="$upload_doc" type="video/mp4">
								<source src="movie.ogg" type="video/ogg">
								Your browser does not support the video tag.
							</video>                                     
		
IGWEZE;
                               												
						}else{

							$msg_e = "* Ooops error, could not retrieve course video. Please try again";
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'>  hidePageLoader(); $('#modal-fobrain').modal('hide'); </script>";exit;

						} 

					}elseif($ctype == 3){ 

						//$tag_button = '';
						$tag_button = '
							<li class="tag__item">
							<i class="fas fa-clock mr-2"></i> 
							'.$ctime.' mins.
							</li>						
						';

						if($link == ""){

							$msg_e = "* Ooops error, could not retrieve course video. Please try again";
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'>  hidePageLoader(); $('#modal-fobrain').modal('hide'); </script>";exit;

						}else{

 
							//?autoplay=1&mute=1
							
$video_player =<<<IGWEZE
        							  									 
                       	 	<iframe width="100%"" height="360"
								src="$link?controls=0">
							</iframe>                                  
		
IGWEZE;	

						}

					}else{


					}

$tutor_grid =<<<IGWEZE

		<!-- row -->
		<div class="row gutters row-section fobrain-section-div justify-content-center">		
			<div class="col-12">
				<div class="dark-col-qq">
					<div class="container py-4">  
						<article class="fob-course-card-view dark-col blue-col">
							<a class="fob-course-card-view__img_link" href="#">
								<img class="fob-course-card-view__img" src="$staff_img" alt="Image Title" />
							</a>
							<div class="fob-course-card-view__text">
								<h1 class="fob-course-card-view__title blue-col"><a href="#">$chapter_title</a></h1>
								<h3 class="fob-course-card-view__title blue-col"><a href="#">$ctopic</a></h3>
								<div class="fob-course-card-view__subtitle small"> 
									<i class="mdi mdi-account-tie mr-2"></i> $staffs_name  
								</div>
								<div class="fob-course-card-view__bar"></div>
								<ul class="fob-course-card-view__tagbox"> 
									$tag_button
								</ul>
								<div class="fob-course-card-view__bar"></div>
								<div class="fob-course-card-view__preview-txt">
									$details
									<div class="mt-50">
										$video_player
									</div>
								</div>
								   
								$quiz_frm_build  
							</div> 
						</article> 
					</div>
				</div>
			</div>
		</div>							

IGWEZE;		
					echo $tutor_grid;  
					
				}catch(PDOException $e) {
				
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
					
				}

				 

				echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
				
			}		

		}else{  /* display error */ 
			
			$msg_e = "* Ooops, an error has occur to retrieve course information. Please try again";
			echo $errorMsg.$msg_e.$eEnd; 
			echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
						
		}	
		
exit;
?>	