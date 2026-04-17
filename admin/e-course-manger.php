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
This script handle student course
------------------------------------------------------------------------*/

if(!session_id()){
session_start();
}

		define('fobrain', 'igweze');  /* define a check for wrong access of file */

		require 'fobrain-config.php';  /* load fobrain configuration files */
	
				
		if ($_REQUEST['course'] == 'save') {  /* save course */
			
			$session = cleanInt($_REQUEST['sess']);
			$level = cleanInt($_REQUEST['level']);
			$eTerm = cleanInt($_REQUEST['eTerm']);
			$class = clean($_REQUEST['class']);
			$eTitle =  clean($_REQUEST['eTitle']);
			$eSubject = clean($_REQUEST['eSubject']);
			$eTime = cleanInt($_REQUEST['eTime']);
			$status = cleanInt($_REQUEST['status']);
			$eDetail = $_REQUEST['eDetail']; 			
			
			/* script validation */
			
			if ($session == "")  {
				
				$msg_e = "* Ooops Error, please select target course class";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
				
			}elseif ($level == "")  {
				
				$msg_e = "* Ooops Error, please enter target course level";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
				
			}elseif ($eTerm == "")  {
				
				$msg_e = "* Ooops Error, please select target course semester";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
				
			}elseif ($eTitle == "")  {
				
				$msg_e = "* Ooops Error, please enter course title";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
				
			}elseif ($eSubject == "")  {
				
				$msg_e = "* Ooops Error, please select course subject";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
				
			}elseif ($eTime == "")  {
				
				$msg_e = "* Ooops Error, please enter course duration";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
				
			}elseif ($eDetail == "")  {
				
				$msg_e = "* Ooops Error, please enter course instruction";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>   hidePageLoader();  /* hide page loader * / </script>";exit;
				
			}else {  /* update information */        			
			
				$sessionID = sessionID($conn, $session);  /* school session ID */
				$eDetail = strip_tags($eDetail);
				$eDetail = str_replace('<br />', "\n", $eDetail);
				$eDetail = htmlspecialchars($eDetail);	  

				try {

					$sessionS = ($session + $fiVal);  

					$levelArray = studentLevelsArray($conn); /* student level array */		
		
					array_unshift($levelArray,"");
					unset($levelArray[0]);
					
					if(($admin_grade == $staff_fobrain_grd) && ($admin_level == $staff_fob_tagged)){    /* check admin grade */ 
					
						$eGrade = $seVal;
					
					}else{
						
						$eGrade = $fiVal;
						
					}	
					
					$ebele_mark = "INSERT INTO $fobrainCourseTB  (session, level, class, eTerm, eTitle, eSubject, eTime, eDetail, eGrade, eStaff, status)

																VALUES (:session, :level, :class, :eTerm, :eTitle, :eSubject, 
																:eTime, :eDetail, :eGrade, :eStaff, :status)";
					
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':session', $sessionID);
					$igweze_prep->bindValue(':level', $level);
					$igweze_prep->bindValue(':class', $class);
					$igweze_prep->bindValue(':eTerm', $eTerm);
					$igweze_prep->bindValue(':eTitle', $eTitle);
					$igweze_prep->bindValue(':eSubject', $eSubject);
					$igweze_prep->bindValue(':eTime', $eTime);
					$igweze_prep->bindValue(':eDetail', $eDetail);
					$igweze_prep->bindValue(':eGrade', $eGrade);
					$igweze_prep->bindValue(':eStaff', $_SESSION['adminID']);
					$igweze_prep->bindValue(':status', $status);					
					
					if($igweze_prep->execute()){  /* if sucessfully */ 
						
						$cid = $conn->lastInsertId($fobrainCourseTB); 
						
						/*
						$eDetailS = htmlspecialchars_decode($eDetail);									
						$eDetailS = nl2br($eDetailS); 						
							<tr>
								<th> Course Instruction/s </th>
								<td>$eDetailS</td>								
						</tr>
						
						*/   

						$course_level = $levelArray[$level]['level'];							

$questDiv =<<<IGWEZE

						<!-- row -->
						<div class="row gutters row-section fobrain-section-div justify-content-center">
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 table-responsive">	
								<!-- table --> 
								<table class="table table-view table-hover">
								<tbody>
									<tr>
										<th> Target Class </th>
										<td>$session - $sessionS Session   $course_level $class</td>
										
									</tr>
									<tr>
										<th> Course Title</th>
										<td> $eTitle </td>
										
									</tr>
									<tr>
										<th> Course Course </th>
										<td>$eSubject</td>
									
									</tr>
									<tr>
										<th> Duration  </th>
										<td>$eTime Minutes</td>
										
									</tr>
									
								</tbody>
								</table>
								<!-- / table --> 
							</div>
						</div>
						<!-- / row -->					 
	
						<div class="gutters my-30 text-end"> 
							<button type="button" class="btn btn-primary waves-effect   
							btn-label waves-light editTopic" id="fobrain-$i_false-$cid">
								<i class="mdi mdi-square-edit-outline label-icon"></i>  Add Chapter
							</button>
						</div> 
							
						<div id="courseQuesDiv">
									
			
IGWEZE;
								
								
						echo $questDiv; 

						require_once 'e-topics-info.php';  /* include assignment chapter div */
						echo"</div> 
							
					 
						
						<button type='button' class='btn btn-dark pull-left editTopic mt-20' id='nkiru-$i_false-$cid'>  
						<i class='mdi mdi-square-edit-outline label-icon'></i> Add Chapter </button>"; 

						$msg_s = "e Courses information was successfully created"; 
						echo $succesMsg.$msg_s.$sEnd;   

						echo "<script type='text/javascript'>  
								$('.head-quest').fadeIn(100);
								$('.head-course').fadeOut(100); 
								$('.view-info-div').fadeIn(1000);
								$('.add-new-div').fadeOut(1000);
								$('.load-wiz-frm, #subjectCourseDiv').fadeOut(1000);
								$('.new-course-div').fadeIn(1000);
								$('#frmsaveCourse')[0].reset(); 
								hidePageLoader(); 
							</script>";exit; 
						
					}else{  /* display error */ 
			
						$msg_e =  "Ooops, an error has occur while to create new e Courses information. Please try again";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
						
					}
					

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				}
		
		
			}
		
		}elseif ($_REQUEST['course'] == 'update') {  /* update course */

			$cid = cleanInt($_REQUEST['cid']);			
			$session = cleanInt($_REQUEST['sess']);
			$level = cleanInt($_REQUEST['level']);
			$eTerm = cleanInt($_REQUEST['eTerm']);
			$class = clean($_REQUEST['class']);
			$eTitle =  clean($_REQUEST['eTitle']);
			$eSubject = clean($_REQUEST['eSubject']);
			$eTime = cleanInt($_REQUEST['eTime']);
			$status = cleanInt($_REQUEST['status']);
			$eDetail = $_REQUEST['eDetail'];				
			
			/* script validation */ 
							
			if ($cid == ""){
				
				$msg_e = "* Ooops, an error has occur to retrieve course information. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($session == "")  {
				
				$msg_e = "* Ooops Error, please select target course class";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($level == "")  {
				
				$msg_e = "* Ooops Error, please enter target course level";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($eTerm == "")  {
				
				$msg_e = "* Ooops Error, please select target course semester";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($eTitle == "")  {
				
				$msg_e = "* Ooops Error, please enter course title";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($eSubject == "")  {
				
				$msg_e = "* Ooops Error, please select course subject";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($eTime == "")  {
				
				$msg_e = "* Ooops Error, please enter course duration";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($eDetail == "")  {
				
				$msg_e = "* Ooops Error, please enter course instruction";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}else {  /* update information */       			
			
				$sessionID = sessionID($conn, $session);  /* school session ID */
			 
				$eDetail = strip_tags($eDetail);
				$eDetail = str_replace('<br />', "\n", $eDetail);
				$eDetail = htmlspecialchars($eDetail);  

				try { 
					
					$ebele_mark = "UPDATE $fobrainCourseTB  
										
										SET 
										
										session = :session, 
										level = :level,
										class = :class,
										eTerm = :eTerm,	
										eTitle = :eTitle,
										eSubject = :eSubject,
										eTime = :eTime,
										eDetail = :eDetail,
										status = :status
										
										
									WHERE cid = :cid";
					
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':cid', $cid);
					$igweze_prep->bindValue(':session', $sessionID);
					$igweze_prep->bindValue(':level', $level);
					$igweze_prep->bindValue(':class', $class);
					$igweze_prep->bindValue(':eTerm', $eTerm);
					$igweze_prep->bindValue(':eTitle', $eTitle);
					$igweze_prep->bindValue(':eSubject', $eSubject);
					$igweze_prep->bindValue(':eTime', $eTime);
					$igweze_prep->bindValue(':eDetail', $eDetail); 
					$igweze_prep->bindValue(':status', $status);
					
					if($igweze_prep->execute()){  /* if sucessfully */
						
						$msg_s = "e Courses information was successfully saved."; 
						echo $succesMsg.$msg_s.$sEnd; 
						echo "<script type='text/javascript'> 
								$('#load-wiz-info').load('e-course-info.php'); 
								//$('#frmupdateCourse').slideUp(1500);
								$('#modal-fobrain').modal('hide');
								hidePageLoader();  
						</script>";exit;
						
					}else{  /* display error */ 
			
						$msg_e =  "Ooops, an error has occur while to save e Courses information. 
						Please try again";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
						
					}
					
				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				}          		
		
			}
		
		}elseif ($_REQUEST['course'] == 'chapters') {  /* save course chapter */ 
			
			$cid = strip_tags($_REQUEST['cid']);
			$i = $fiVal;
			
			/* script validation */ 
			
			if ($cid == ""){
				
				$msg_e = "* Ooops, an error has occur while to retrieve course information. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
				
			}else {      

				try { 
					
					$onlineCourseInfoArr = onlineCourseInfo($conn, $cid);  /* online student course information */

					$sessionID = $onlineCourseInfoArr[$i]["session"];
					$level = $onlineCourseInfoArr[$i]["level"];
					$eTerm = $onlineCourseInfoArr[$i]["eTerm"];
					$class = $onlineCourseInfoArr[$i]["class"];
					$eTitle = $onlineCourseInfoArr[$i]["eTitle"];
					$eSubject = $onlineCourseInfoArr[$i]["eSubject"];
					$eDetail = htmlspecialchars_decode($onlineCourseInfoArr[$i]["eDetail"]);
					$eTime = $onlineCourseInfoArr[$i]["eTime"];
					$eTerm = $termIntList[$eTerm];
					
					$session = fobrainSession($conn, $sessionID);  /* school session ID */
					$sessionS = ($session + $fiVal);
					$eDetail = nl2br($eDetail);  

					if (str_contains($eSubject, '@!fob!@')) {
						list ($course_rcode, $course_code, $course_title) = explode ("@!fob!@", $eSubject);
					}else{
						$course_rcode = $course_code = $course_title = "";
					}
					
								
				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				}			
						 	
				
$questDiv =<<<IGWEZE


				<!-- row -->
				<div class="row gutters row-section fobrain-section-div justify-content-center">
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 table-responsive">	
						<!-- table --> 
						<table class="table table-view table-hover">
						<tbody>
							<tr>
								<th> Target Class </th>
								<td>$session - $sessionS Session   $level</td>
								
							</tr>
							<tr>
								<th> Course Title</th>
								<td> $eTitle </td>
								
							</tr>
							<tr>
								<th> Course Course </th>
								<td>$course_title - $course_code</td>
							
							</tr>
							<tr>
								<th> Duration  </th>
								<td>$eTime Minutes</td>
								
							</tr>

							<tr>
								<th> Course Instruction/s </th>
								<td>$eDetail</td>
								
							</tr>
							
						</tbody>
						</table>
						<!-- / table --> 
					</div>
				</div>
				<!-- / row -->					 

				<div class="gutters my-30 text-end"> 
					<button type="button" class="btn btn-primary waves-effect   
					btn-label waves-light editTopic" id="fobrain-$i_false-$cid">
						<i class="mdi mdi-plus-circle-outline label-icon"></i>  Add Chapter
					</button>
				</div> 
					
				<div id="courseQuesDiv">
							
	
IGWEZE;
						
						
				echo $questDiv; 
				require_once 'e-topics-info.php';  /* include assignment chapter div */
				echo"</div> 
					
				
				<button type='button' class='btn btn-dark pull-left editTopic mt-50' id='nkiru-$i_false-$cid'>  
				<i class='mdi mdi-plus-circle-outline label-icon'></i> Add Chapter </button>"; 
		
				echo "<script type='text/javascript'>  
					$('.head-quest').fadeIn(100);
					$('.head-course').fadeOut(100); 
					$('.view-info-div').fadeIn(1000);
					$('.add-new-div').fadeOut(1000);
					hidePageLoader(); 
				</script>";exit; 
		
			}
		
		}elseif ($_REQUEST['course'] == 'removeCourse') {  /* remove course */

			
			$course = $_REQUEST['eData'];
			
			list($fobrainIg, $cid, $hName) = explode("-", $course);			
			
			/* script validation */ 
			
			if (($course == "")  || ($cid == "")){
				
				$msg_e = "* Ooops, an error has occur while to remove course information. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>   $('#removeLoader').fadeOut(1500); </script>";exit;
				
			}else {  /* remove information */       			


				try {
					
					
					$ebele_mark = "DELETE FROM 
					
									$fobrainCourseTB										
										
									WHERE cid = :cid
										
									LIMIT 1";
					
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':cid', $cid);						
					
					
					if($igweze_prep->execute()){  /* if sucessfully */
						
						$removeDiv = "$('#row-".$cid."').fadeOut(1000);";
						$msg_s = "<strong>$hName</strong> was successfully removed"; 
						echo $succesMsg.$msg_s.$sEnd; 
						echo "<script type='text/javascript'>   
						$('#removeLoader').fadeOut(1500); $('.slideUpFrmDiv').fadeOut(3000); $removeDiv  </script>";exit;
						
					}else{  /* display error */ 
			
						$msg_e =  "Ooops, an error has occur while to remove course information. Please try again";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'>   $('#removeLoader').fadeOut(1500); </script>";exit;
						
					}
					

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				}
		
		
			}
		
		}elseif ($_REQUEST['course'] == 'view') {  /* view course */

			
			$cid = strip_tags($_REQUEST['eData']);
			$i = $fiVal;
			
			if ($cid == ""){
				
				$msg_e = "* Ooops, an error has occur while to retrieve course information. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}else {       			


				try {
					
					
					$onlineCourseInfoArr = onlineCourseInfo($conn, $cid);  /* online student course information */
						
					$sessionID = $onlineCourseInfoArr[$i]["session"];
					$level = $onlineCourseInfoArr[$i]["level"];
					$eTerm = $onlineCourseInfoArr[$i]["eTerm"];
					$class = $onlineCourseInfoArr[$i]["class"];
					$eTitle = $onlineCourseInfoArr[$i]["eTitle"];
					$eSubject = $onlineCourseInfoArr[$i]["eSubject"];
					$eDetail = htmlspecialchars_decode($onlineCourseInfoArr[$i]["eDetail"]);
					$eTime = $onlineCourseInfoArr[$i]["eTime"];
					$eTerm = $termIntList[$eTerm];
					
					$session = fobrainSession($conn, $sessionID);  /* school session ID */
					$sessionS = ($session + $fiVal); 

					$eDetail = nl2br($eDetail);

					if (str_contains($eSubject, '@!fob!@')) {
						list ($course_rcode, $course_code, $course_title) = explode ("@!fob!@", $eSubject);
					}else{
						$course_rcode = $course_code = $course_title = "";
					}
					 
					

$showCourse =<<<IGWEZE
	
					
					<div class="row gutters mb-10">
						<div class="text-end">
							<button  class="btn btn-primary"   id="print-overlay">
								<i class="fas fa-print"></i>  
							</button>
						</div>	
					</div>
							
					<div id = 'fobrain-print-ovly'>

						<!-- table -->	
						<table  class="table table-view table-hover table-responsive"> 
							
							<tr>
								<th>
									Course Session 
								</td> 
								<td>
									$session - $sessionS
								</td> 
							</tr> 

							<tr>
								<th>
									Target Class 
								</td> 
								<td>
									$level
								</td> 
							</tr> 
							
							<tr>
								<th>
									Course Semester
								</td> 
								<td>
									$eTerm
								</td> 
							</tr>  
							
							<tr>
								<th>
									Course Title
								</td> 
								<td>
									$eTitle
								</td> 
							</tr> 
							
							<tr>
								<th>
									Course Code
								</td> 
								<td>
									$course_title - $course_code
								</td> 
							</tr>
							
							<tr>
								<th>
									Duration
								</td> 
								<td>
									$eTime Minutes
								</td> 
							</tr>

							<tr>
								<th>
									Course Details
								</td> 
								<td>
									$eDetail
								</td> 
							</tr> 
						 
						</table>
						<!-- / table --> 
					</div>
	
IGWEZE;
			
					echo $showCourse; 
					echo "<script type='text/javascript'>  hidePageLoader(); </script>"; exit; 
					

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				} 
		
			}
		
		}elseif ($_REQUEST['course'] == 'edit') {  /* edit course */

			
			$cid = strip_tags($_REQUEST['eData']);
			
			/* script validation */
			
			if ($cid == ""){
				
				$msg_e = "* Ooops, an error has occur while to retrieve course information. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}else {       	 

				try {						
						
					$onlineCourseInfoArr = onlineCourseInfo($conn, $cid);  /* online student course information */ 
					$sessionID = $onlineCourseInfoArr[$fiVal]["session"];
					$level = $onlineCourseInfoArr[$fiVal]["level"];
					$class = $onlineCourseInfoArr[$fiVal]["class"];
					$eTerm = $onlineCourseInfoArr[$fiVal]["eTerm"];
					$eTitle = $onlineCourseInfoArr[$fiVal]["eTitle"];
					$eSubject = $onlineCourseInfoArr[$fiVal]["eSubject"];
					$eTime = $onlineCourseInfoArr[$fiVal]["eTime"];
					$status = $onlineCourseInfoArr[$fiVal]["status"];
					$eDetail = htmlspecialchars_decode($onlineCourseInfoArr[$fiVal]["eDetail"]);							
			
?>
					<!-- form -->
					<form class="form-horizontal" id="frmupdateCourse" role="form">
								
						<!-- row -->
						<div class="row gutters">
							<div class="col-12">										
								<!-- field wrapper start -->
								<div class="field-wrapper select-wrapper">
									<select class="form-control"  id="subjTerm2" name="eTerm" required> 
									<option value = "">Please select One</option>  
									<?php 

										foreach($term_list as $term_key => $term_value){  /* loop array */

											if ($eTerm == $term_key){
												$selected = "SELECTED";
											} else {
												$selected = "";
											}

											echo '<option value="'.$term_key.'"'.$selected.'>'.$term_value.'</option>' ."\r\n";

										}

									?> 											
									
									</select>
									<div class="icon-wrap"  id="wait" style="display: none;">
										<i class="loader"></i>
									</div>
									<input type="hidden" value="update" name = "course"/>
									<input type="hidden" value="<?php echo $class.':<$?$>:'.$eTitle.':<$?$>:'.$eSubject; ?>" 
									name = "euData" id="euData2"/>
									<input type="hidden" name="eID" value="<?php echo $eID; ?>"/>											  
									<div class="field-placeholder"> Select Term <span class="text-danger">*</span></div>
								</div>
								<!-- field wrapper end -->
							</div>									 
						</div>	
						<!-- /row -->
 
						<span id="result" style="display: none;"></span><!-- loading div -->				
					
						<?php if ($admin_grade == $cm_fobrain_grd) {    /* check admin grade */ ?>

						<!-- row -->
						<div class="row gutters">
							<div class="col-12">										
								<!-- field wrapper start -->
								<div class="field-wrapper select-wrapper">                                      
									<select class="form-control"  id="subjectLevel2" name="subjectLevel2" required>
										<option value = "">Please select One</option>					 
										<?php 
									
											try  {

												$session = fobrainSession($conn, $sessionID); /* school session  */
												$passData = trim($session.'#@@#'.$level); 
												formTeacherSessionPass($conn, $adminID, $fobrainMode, $passData); /* class teacher school session  */ 
										
											}catch(PDOException $e) {
				
												fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
					
											}
											
										?>	 
									</select>
									<div class="icon-wrap"  id="wait_11" style="display: none;">
										<i class="loader"></i>
									</div>
									<input type="hidden" name ="classAll2" id="classAll2" value="<?php echo $i_false; ?>" />
									<div class="field-placeholder"> School Level <span class="text-danger">*</span></div>
								</div>
							</div>
						</div>
						
						<?php }else{ ?>	

						<!-- row -->
						<div class="row gutters">
							<div class="col-12">										
								<!-- field wrapper start -->
								<div class="field-wrapper select-wrapper">
									
									<select class="form-control"  id="subjectLevel2" name="subjectLevel2" required>
										<option value = "">Please select One</option>
										<?php  
										
											try {
												
												$session = fobrainSession($conn, $sessionID); /* school session  */
												$passData = trim($session.'#@@#'.$level);
													
												schoolSessionPassData($conn, $passData); /* school session  */
										
											}catch(PDOException $e) {
				
											fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
					
											} 
										?>
									
									</select>
									<div class="icon-wrap"  id="wait_11" style="display: none;">
										<i class="loader"></i>
									</div>
									<input type="hidden" name ="classAll2" id="classAll2" value="<?php echo $fiVal; ?>" />
									<div class="field-placeholder"> School Level <span class="text-danger">*</span></div>
								</div>
								<!-- field wrapper end -->
							</div>									 
						</div>	
						<!-- /row -->
					
						<?php } ?>
							

						<span id="result_11" style="display: none;"></span><!-- loading div --> 
					
						<!-- row -->
						<div class="row gutters">
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">										
								<!-- field wrapper start -->
								<div class="field-wrapper"> 
									<input type="number"  id="eTime" name="eTime" 
									class="form-control" placeholder="60" maxlength="3" value="<?php echo $eTime; ?>" required>
									<div class="field-placeholder"> Duration <span class="text-danger">*</span></div>
									<div class="form-text text-danger fw-500">
										In Minutes eg 10, 20
									</div>
								</div>
								<!-- field wrapper end -->
							</div>
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">										
								<!-- field wrapper start -->
								<div class="field-wrapper">			
									<select class="form-control"  name="status" required> 
	
										<?php

										foreach($lockArr as $status_key => $status_value){  /* loop array */

											if ($status == $status_key){
												$selected = "SELECTED";
											} else {
												$selected = "";
											}

											echo '<option value="'.$status_key.'"'.$selected.'>'.$status_value.'</option>' ."\r\n";

										}	     	
										?> 

									</select>

									<div class="field-placeholder"> Status <span class="text-danger">*</span></div>													
								</div>
								<!-- field wrapper end -->
							</div>									 
						</div>	
						<!-- /row -->
						
						
						<!-- row -->
						<div class="row gutters">
							<div class="col-12">										
								<!-- field wrapper start -->
								<div class="field-wrapper"> 
									<textarea rows="4" cols="10" class="form-control" name="eDetail" id="eDetail" 
									placeholder="Enter Course Description"><?php echo $eDetail; ?></textarea>									 
									<div class="field-placeholder"> Course Description <span class="text-danger">*</span></div>
									 
								</div>
								<!-- field wrapper end -->
							</div>
						</div>	
						<!-- /row --> 
							

						<hr class="mt-30 mb-15 text-danger" />
						<!-- row -->
						<div class="row gutters modal-btn-footer">
							<div class="col-6 text-start">
								<button type="button" id="close-modal" class="btn btn-danger close-modal" 
								data-bs-dismiss="modal"> <i class="mdi mdi-window-close label-icon"></i> Close</button>
							</div>
							<div class="col-6 text-end">
								<input type="hidden" name="cid" value="<?php echo $cid; ?>" />
								<button type="submit" class="btn btn-primary waves-effect   
								btn-label waves-light courses-list-btn" id="updateCourse">
									<i class="mdi mdi-content-save label-icon"></i>  Save
								</button>
							</div>
						</div>	
						<!-- /row --> 
							
					</form>  
					<!-- / form -->	 

					<script type='text/javascript'>  
						$('#subjectLevel2').change(); hidePageLoader();						
					</script>							
			<?php								
					
					exit;						
														
				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				}		 
		
			}
		
		}else{ 
		
			echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
		
		}
		
exit;
?>

