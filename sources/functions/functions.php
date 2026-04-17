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
	This script load predefined functions
	------------------------------------------------------------------------*/
	 
		if (!defined('fobrain')) /* This checks if this page was wrongly access by users */ 
		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!'); 
 
		function fobrainRandomChar($string){ /* generate auto random character */

			$length = strlen($string);
			$position = mt_rand(0, $length - 1);
			return($string[$position]);

		}

		function randomString ($charset_string, $length){ /* generate auto random character */

			$return_string = ""; // the empty string
			for ($x = 0; $x < $length; $x++)
			$return_string .= fobrainRandomChar($charset_string);
			return($return_string);

		} 		 

		function getPagination($count, $NumPerPage){ /* page papination */

			$paginationCount= floor($count / $NumPerPage);
			$paginationModCount = $count % $NumPerPage;
			
			if(!empty($paginationModCount)){

				$paginationCount++;
			}
			
			return $paginationCount;
		} 

		function removeArrayByValue($array, $value){ /* remove emtpy array value   */

			return array_values(array_diff($array, array($value)));

		} 

		function fobrainHighlight($inVal){ /* highlight character in a sentence or words  */

			return '<span class="high-light-text">'.$inVal.'</span>';

		}

		function highlightTerms($QueryString, $querys){  /* highlight character in a sentence or words  */

			foreach ($querys as $query){ 
			
				$queryStringRep = str_ireplace($query, '<span =style"color:red">*'.$query.'*</span>', $queryString); 
			}

			return $queryStringRep;
		}		 

		function studentPostionSup($position){  /* student result position suffix  */                               
			
			if($position == 1){
				
				$positionSup = "1<sup>st</sup>"; 

			}elseif($position == 2){
				
				$positionSup = "2<sup>nd</sup>"; 

			}elseif($position == 3){
				
				$positionSup = "3<sup>rd</sup>"; 

			}elseif(($position != '') && ($position > 3)){
				
				$positionSup = "$position<sup>th</sup>"; 
				
			}else{
				
				$positionSup = " - "; 
			}
			
			return $positionSup;
			
		} 	  

		function schoolTerm($semester) {  /* school term  */

			if ($semester == 1){

				$i_semester = 'First';

			}elseif ($semester == 2){

				$i_semester = 'Second';

			}elseif ($semester == 3){

				$i_semester = 'Third';

			}elseif ($semester == 4){

				$i_semester = 'Annual';

			}else {
			
				$i_semester = '';

			}

			return $i_semester;

		}	 

		function schoolTypeDB($school){ /* school type database  */

			global $fobrainCDB, $fobrainNurDB, $fobrainPriDB, $fobrainSecDB;
			
			$school = strtolower($school);
			
			if($school == 'nur'){
				
				$fobrainDB = $fobrainNurDB;
				
			}elseif($school == 'pri'){
				
				$fobrainDB = $fobrainPriDB;
				
			}elseif($school == 'sec'){
				
				$fobrainDB = $fobrainSecDB;
				
			}else{
				
				$fobrainDB = '';
				
			}
			
			return $fobrainDB;
		}

		function schoolRegSuffix($school){  /* school type reg. no. suffix  */

			global $fiVal, $seVal, $thVal;
			
			if($school == $fiVal){
				
				$regSuffix = '/NUR';
				
			}elseif($school == $seVal){
				
				$regSuffix = '/PRI';
				
			}elseif($school == $thVal){
				
				$regSuffix = '/SEC';
				
			}else{
				
				$regSuffix = '';
				
			}
			
			return $regSuffix;
		}

		function schoolType($school){  /* return school type */

			$school = strtolower($school);
			
			if($school == 'nur'){
				
				$fobrainDB = 'Nursery';
				
			}elseif($school == 'pri'){
				
				$fobrainDB = 'Primary';
				
			}elseif($school == 'sec'){
				
				$fobrainDB = 'Secondary';
				
			}else{
				
				$fobrainDB = '';
				
			}
			
			return $fobrainDB;
		}

		function schoolTypeCurrent($school, $schoolID){  /* return school type */

			$school = strtolower($school);
			
			if($school == $schoolID){
				
				$current_school = ' <i class="mdi mdi-check-underline text-success fs-14 fw-700"></i>';
				
			}elseif($school == $schoolID){
				
				$current_school = ' <i class="mdi mdi-check-underline text-success fs-14 fw-700"></i>';
				
			}elseif($school == $schoolID){
				
				$current_school = ' <i class="mdi mdi-check-underline text-success fs-14 fw-700"></i>';
				
			}else{
				
				$current_school = '';
				
			}
			
			echo $current_school;
		}

		function schoolTypeConfig($school, $type){ /* school type configuration  */

			global $fobrainNurConfig, $fobrainPRIConfig, $fobrainSECConfig;
			global $fiVal, $seVal;
			
			$school = strtolower($school);

			if($type == $fiVal){
				
				$ext = './'; 
				
			}elseif($type == $seVal){
				
				$ext = '../'; 
				
			}else{
				
				$ext = ''; 
				
			}
			
			if($school == 'nur'){
				
				$fobrainConfig = $ext.$fobrainNurConfig;
				
			}elseif($school == 'pri'){
				
				$fobrainConfig = $ext.$fobrainPRIConfig;
				
			}elseif($school == 'sec'){
				
				$fobrainConfig = $ext.$fobrainSECConfig;
				
			}else{
				
				$fobrainConfig = '';
				
			}

			return $fobrainConfig;
		}

		function fobrainThemeColor($themeColor, $themePath) { /* fobrain theme  */

			if (($themeColor != '') && ($themePath != '')){
			
				$cssThemePath =  $themePath.'css/style-'.$themeColor.'.css';
				$cssThemeResetPath =  $themePath.'css/bootstrap-reset-'.$themeColor.'.css';

				if ( (file_exists($cssThemePath)) && (file_exists($cssThemeResetPath)) ) {

					$cssTheme =  $cssThemePath;
					$cssThemeReset =  $cssThemeResetPath;
				
				}else{

					$cssTheme =  $themePath.'css/style.css';
					$cssThemeReset =  $themePath.'css/bootstrap-reset.css';
					
				}
			
			}else{

					$cssTheme =  $themePath.'css/style.css';
					$cssThemeReset =  $themePath.'css/bootstrap-reset.css'; 
			
			} 

			$fobrainTheme = $cssTheme.'@$$@'.$cssThemeReset;
				
			return $fobrainTheme;
		}  

		function  fobrainPrincipalRemarks($average, $d_occ, $e_occ, $f_occ){ /* principal auto remarks */

			$show_improve= "";
			
			if($d_occ == 0){ $i_dgr = ''; $no_d = true;}
			if($e_occ == 0){ $i_egr = ''; $no_e = true;}
			if($f_occ == 0){ $i_fgr = ''; $no_f = true;}
			
			if($d_occ >= 1){ $i_dgr = 'D'; $no_d = false;}
			if($e_occ >= 1){ $i_egr = 'E'; $no_e = false;}
			if($f_occ >= 1){ $i_fgr = 'F'; $no_f = false;}
			
			if(($no_d == false) || ($no_e == false) || ( $no_f == false)){  

				$show_improve = ", Improve on subject/s with grade/s $i_dgr $i_egr $i_fgr";

			}

			if (($average >= 0.1) && ($average <= 29)) {
				$remark = "<span class='text-danger'>Very Poor Results<span>";
				return $remark;
			}elseif (($average >= 30) && ($average <= 39)) {
				$remark = "<span class='text-danger'>Poor Result Work Harder<span>";
				return $remark;
			}elseif (($average >= 40) && ($average <= 49)) {
				$remark = "<span class='text-warning'>Fair Result".$show_improve."<span>";
				return $remark;
			}elseif (($average >= 50) && ($average <= 59)) {
				$remark = "<span class='text-primary'>Good Result".$show_improve."<span>";
				return $remark;
			}elseif (($average >= 60) && ($average <= 69)) { 
			
				if($no_f == true){
				
					$remark = "<span class='text-primary'>Very Good Result".$show_improve."<span>";
				
				}else{
				
					$remark = "<span class='text-primary'>Encouraging Result".$show_improve."<span>";
				
				}
				
				return $remark;
				
			}elseIf (($average >= 70) && ($average <= 79)) {
				
				if (($no_d == true) && ($no_e == true) && ($no_f == true)){

					$remark = "<span class='text-success'>Excellent Result, Keep It Up<span>";

				}else{

					$remark = "<span class='text-success'>Excellent Result ".$show_improve."<span>";

				}

				return $remark;

			}elseIf (($average >= 80) && ($average <= 100)) {

				$remark = "<span class='text-success'>Distinction, Keep It Up<span>";
				return $remark;

			}elseIf (is_null(($average))) {

				$remark = " - ";
				return $remark;

			}

		}

		function teacherGradeRemarks($score){ /* teacher grade remarks */

			if ($score < 0) {
				$score_grd = "";
				return $score_grd;
			}elseif (($score >= 1) && ($score <= 39.9)) {
				$score_grd = "<span class='text-danger fw-500 fs-14 font-head-1'>Fail</span>";
				return $score_grd;
			}elseif (($score >= 40) && ($score <= 44.9)) {
				$score_grd = "<span class='text-warning fw-500 fs-14 font-head-1'>Fair</span>";
				return $score_grd;
			}elseif (($score >= 45) && ($score <= 49.9)) {
				$score_grd = "<span class='text-primary fw-500 fs-14 font-head-1'>Pass</span>";
				return $score_grd;
			}elseif (($score >= 50) && ($score <= 59.9)) {
				$score_grd = "<span class='text-primary fw-500 fs-14 font-head-1'>Good</span>";
				return $score_grd;
			}elseif (($score >= 60) && ($score <= 69.9)) {
				$score_grd = "<span class='text-success fw-500 fs-14 font-head-1'>V. Good</span>";
				return $score_grd;
			}elseif (($score >= 70) && ($score <= 100)) {
				$score_grd = "<span class='text-success fw-500 fs-14 font-head-1'>Excellent</span>";
				return $score_grd;
			}elseif (is_null(($score))) {
				$score_grd = " ";
				return $score_grd;
			}

		}  

		function gradeRemarks($score){ /* grade remarks */

			if ($score <= 0) {

				$remark = '';
				return $remark;	   

			}elseif (($score >= 1) && ($score <= 39)) {
				
				$remark = '<span class="text-danger fw-500 fs-14 font-head-1">Fail</span>';
				return $remark;	   
			
			}else {
			
				$remark = '<span class="text-success fw-500 fs-14 font-head-1">Pass</span>';
				return $remark;
			
			}  

		} 

		function autoLoginBan(){  
                
			$spamTimer = strtotime($_SESSION['logTimer']);
			$spamTimerNow = strtotime(date("Y-m-d H:i:s"));
			
			
			if($spamTimer == ""){
				
				$_SESSION['logTimer'] = date("Y-m-d H:i:s"); $_SESSION['logcounter'] = 1;
				$spamTimer = strtotime($_SESSION['logTimer']);
				
			}
	
			$spamDiff = $spamTimerNow - $spamTimer;
			$spamMinuteC = floor($spamDiff / 60);
			
			if($spamDiff < 60){
				
				if($_SESSION['logcounter'] >= 5){ 
					
					unset($_SESSION['logTimer']); unset($_SESSION['logcounter']);
					$_SESSION['banLogTimer'] = date("Y-m-d H:i:s"); $_SESSION['islogBan'] = 1;
				}
				
			}else{
				
				unset($_SESSION['logTimer']); unset($_SESSION['logcounter']); 
				//unset($_SESSION['banLogTimer']); $_SESSION['islogBan'] = 0;
			} 
			
			$_SESSION['logcounter']++;	 
		
		}
	
		function clearLoginBan(){   
			
			if ( (isset($_SESSION['islogBan'])) && ($_SESSION['islogBan'] == 1)){
				
				$spamTimer = strtotime($_SESSION['banLogTimer']);
				$spamTimerNow = strtotime(date("Y-m-d H:i:s")); 
				
				if($spamTimer == ""){ 
				
					$spamTimer = strtotime(date("Y-m-d H:i:s"));
					
				}
			
				$spamDiff = $spamTimerNow - $spamTimer;
				$spamMinuteC = floor($spamDiff / 60);
				
				if($spamDiff > 300){
					
					$_SESSION['islogBan'] = 0; 
					unset($_SESSION['banLogTimer']);
					
				}
			
			}
		
		}

		function onlineRegPicture($conn, $studentID) {  /* online registration picture */

			global $studentOnlineRegTB, $foreal;

			$ebele_mark = "SELECT i_stupic

					FROM $studentOnlineRegTB 

					WHERE stu_id = :stu_id";
					
			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue(':stu_id', $studentID);		 
			$igweze_prep->execute();
			
			$rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count == $foreal) {
			
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		

					$picture = $row['i_stupic'];
					
				}	
			
			}else{

				$picture = "";

			}

			return  $picture;

		}	

		function registrationCounter($conn) {  /* student online registration counter */	

			global $studentOnlineRegTB, $foreal;

			$ebele_mark = "SELECT stu_id

							FROM $studentOnlineRegTB";
					
			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->execute();
			
			$totalStudents = $igweze_prep->rowCount(); 

			return $totalStudents;
			
		}

		function removeRegistraion($conn, $studentID) { /* remove student online registration */	

			global $studentOnlineRegTB;

			$ebele_mark = "DELETE

							FROM $studentOnlineRegTB
							
							WHERE stu_id = :stu_id
							
							LIMIT 1";
					
			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue(':stu_id', $studentID);
			$igweze_prep->execute();
			
		} 		

		function fobrainEventsJSON($conn) { /* retrieve school events */	

			global $notificationTB;

			$array = $conn->query("SELECT eID AS id, comments AS title, startdate AS start, 
								enddate as end
			
						FROM  $notificationTB")->fetchAll(PDO::FETCH_ASSOC);
							
						echo json_encode($array);						
			
		}

		function fobrainEvents($conn) { /* retrieve school events */	

			global $notificationTB;

			$array_events = $conn->query("SELECT id, start, title, comments
									
			
						FROM  $notificationTB
						
						ORDER BY eID DESC")->fetchAll(PDO::FETCH_ASSOC);

			array_unshift($array_events,"");
			unset($array_events[0]);

			return  $array_events; 					
			
		}

		function eventInfo($conn, $eID) {  /* school events information */

			global $notificationTB;

			$array_events = $conn->query("SELECT id, start, title, comments
									
			
										FROM  $notificationTB
											
											WHERE  id = $eID")->fetchAll(PDO::FETCH_ASSOC);
											
			array_unshift($array_events,"");
			unset($array_events[0]);

			return  $array_events;

		}

		function loadMoreEvents($conn, $last_id, $limit) {  /* retrieve more events */

			global $notificationTB, $foreal;

			$ebele_mark = "SELECT id, start, title, comments
				
							FROM  $notificationTB
							
							WHERE  
							
							id < '" .$last_id . "' ORDER BY id DESC LIMIT $limit";
					
			$igweze_prep = $conn->prepare($ebele_mark);
				
			$igweze_prep->execute();

			$rows_count = $igweze_prep->rowCount(); 

			if($rows_count >= $foreal) {

				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
							
					$eID = $row["id"];
					$startdate = $row["star"];
					$title = $row["title"]; 
					$comments = $row["comments"];  

					$startdate = date("j M, Y H:i:s", strtotime($startdate)); 
						
					echo ' 

					<div class="timeline filter-item" id="'.$eID.'">
						<a href="javascript:;" class="timeline-content">
							<div class="timeline-year"><i class="mdi mdi-calendar-clock"></i> '.$startdate.'</div> 
							<h3 class="title">'.$title.'</h3>
							<p class="description">
								'.$comments.'
							</p>
						</a>
					</div>';
					

				}	

			}else{

				//echo "<li>End of Dataa</li>";

			} 

		}

		function fobrainTimeTable($conn) { /* retrieve school timetable */	

			global $studentTimeTable;

			$array = $conn->query("SELECT tID AS id, comments AS title, startdate AS start, enddate 
									as end
			
									FROM  $studentTimeTable")->fetchAll(PDO::FETCH_ASSOC);
							
						echo json_encode($array);					
			
		}

		function fobrainStudentAttendance($conn, $regID) { /* retrieve student daily attendance  array json_encode */	

			global $daily_comments_tb;

			$array = $conn->query("SELECT id, start, end, title, comments, reply, attendance
			
												FROM  $daily_comments_tb
												
												WHERE ireg_id = $regID")->fetchAll(PDO::FETCH_ASSOC);
							
							
			echo json_encode($array);						
			
		}
 

		function fobrainrollCallArray($conn, $regID) { /* retrieve student daily attendance array */	

			global $daily_comments_tb;

			$rollCallArray = $conn->query("SELECT id, start, end, title, comments, reply, attendance
			
												FROM  $daily_comments_tb
												
												WHERE ireg_id = $regID
												
												ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
							
							
						array_unshift($rollCallArray,"");
						unset($rollCallArray[0]);

			return  $rollCallArray;
			
		}
		
		function fobrainrollCallInfo($conn, $regID, $rID) { /* retrieve student daily attendance info */	

			global $daily_comments_tb;

			$rollCallArray = $conn->query("SELECT id, start, end, title, comments, reply, attendance
			
												FROM  $daily_comments_tb
												
												WHERE ireg_id = $regID

												AND id = $rID
												
												ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
							
							
			array_unshift($rollCallArray,"");
			unset($rollCallArray[0]);

			return  $rollCallArray;
			
		}


		function loadMoreRollCall($conn, $regID, $last_id, $limit) {  /* retrieve more roll call */

			global $daily_comments_tb, $foreal;

			$ebele_mark = "SELECT rID AS id, comments, startdate, enddate
				
							FROM  $daily_comments_tb
							
							WHERE ireg_id = $regID 

							AND
							
							rID < '" .$last_id . "' ORDER BY id DESC LIMIT $limit";
					
			$igweze_prep = $conn->prepare($ebele_mark);
				
			$igweze_prep->execute();

			$rows_count = $igweze_prep->rowCount(); 

			if($rows_count >= $foreal) {

				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
							
					$rID = $row["id"];
					$startdate = $row["startdate"];
					$comments = $row["comments"]; 

					$startdate = date("j M, Y", strtotime($startdate)); 
					
					if($comments != "")	{
						if (str_contains($comments, ':')) {
							list ($title, $comment) = explode (":", $comments);
						}else{
							$title = $comments; $comment = "<span class='fs-10'>No comment</span>";
						} 
					}else{
						$title = "No Attendance"; $comment = "<span class='fs-10'>No comment</span>";            
					}

					if(($comment == "")	|| ($comment == " ")){ 
						$comment = "<span class='fs-10'>No comment</span>"; 
					}

					echo '
					<div class="timeline filter-item " id="'.$rID.'">
						<a href="#" class="timeline-content">
							<div class="timeline-year"><i class="mdi mdi-calendar-clock"></i> '.$startdate.'</div>
							<h3 class="title">'.$title.'</h3>
							<p class="description">
							'.$comment.' - '.$rID.'
							</p>
						</a>
					</div>
					'; //<span id="rollcall'.$rID.'"></span>

				}	

			}else{

				//echo "<li>End of Data</li>";

			} 

		}

		function liveClassData($conn) { /* online student live class array */	

			global $fobrainLiveClassTB, $fiVal;
		
			$liveClassData = $conn->query("SELECT cid, atype, link, lpass, meetid, participant, session, level, eTerm, class, eTitle, eSubject, eDetail, eTime, sTime, cTime, eStaff, status
		
											FROM $fobrainLiveClassTB

											ORDER BY cid DESC")->fetchAll(PDO::FETCH_ASSOC);
											
			array_unshift($liveClassData,"");
			unset($liveClassData[0]);
		
			return  $liveClassData;
		}
		
		function staffLiveClassData($conn, $userID) { /* online staff live class information */	
		
			global $fobrainLiveClassTB, $fiVal;
		
						$liveClassData = $conn->query("SELECT cid, atype, link, lpass, meetid, participant, session, level, eTerm, class, eTitle, eSubject, eDetail, eTime, sTime, cTime, eStaff, status
					
														FROM $fobrainLiveClassTB
														
														WHERE 	eStaff = $userID
														
														ORDER BY cid DESC")->fetchAll(PDO::FETCH_ASSOC);
														
						array_unshift($liveClassData,"");
						unset($liveClassData[0]);
		
			return  $liveClassData;
		} 
		
		function liveClassInfo($conn, $cid) { /* online student live class information */	
		
			global $fobrainLiveClassTB;
		
			$liveClassData = $conn->query("SELECT cid, atype, link, lpass, meetid, participant, session, level, eTerm, class, eTitle, eSubject, eDetail, eTime, sTime, cTime, eStaff, status
		
											FROM $fobrainLiveClassTB
											
											WHERE  cid = $cid")->fetchAll(PDO::FETCH_ASSOC);
											
			array_unshift($liveClassData,"");
			unset($liveClassData[0]);
		
			return  $liveClassData;
		}		 

		function parentMeetingData($conn, $school) { /* live parent meeting information */	

			global $fobrainParentMeetingTB, $fiVal;
		
			$parentMeetingData = $conn->query("SELECT cid, atype, link, lpass, meetid, school, info, participant, session, level, eType, allow, class, eTitle, eSubject, eDetail, eTime, sTime, cTime, eStaff, staffs, status
		
											FROM $fobrainParentMeetingTB
											
											WHERE school = $school
											
											ORDER BY cid DESC")->fetchAll(PDO::FETCH_ASSOC);
											
			array_unshift($parentMeetingData,"");
			unset($parentMeetingData[0]);
		
			return  $parentMeetingData;
		}

		function parentMeetingData2($conn) { /* live parent meeting information */	

			global $fobrainParentMeetingTB, $fiVal;
		
			$parentMeetingData = $conn->query("SELECT cid, atype, link, lpass, meetid, school, info, participant, session, level, eType, allow, class, eTitle, eSubject, eDetail, eTime, sTime, cTime, eStaff, staffs, status
		
											FROM $fobrainParentMeetingTB
											
											ORDER BY cid DESC")->fetchAll(PDO::FETCH_ASSOC);
											
			array_unshift($parentMeetingData,"");
			unset($parentMeetingData[0]);
		
			return  $parentMeetingData;
		}
		
		function staffParentMeetingData($conn, $userID) { /* live parent meeting information */	
		
			global $fobrainParentMeetingTB, $fiVal;
		
						$parentMeetingData = $conn->query("SELECT cid, atype, link, lpass, meetid, school, info, participant, session, level, eType, allow, class, eTitle, eSubject, eDetail, eTime, sTime, cTime, eStaff, staffs, status
					
														FROM $fobrainParentMeetingTB
														
														WHERE 	eStaff = $userID
														
														ORDER BY cid DESC")->fetchAll(PDO::FETCH_ASSOC);
														
						array_unshift($parentMeetingData,"");
						unset($parentMeetingData[0]);
		
			return  $parentMeetingData;
		} 
		
		function parentMeetingInfo($conn, $cid) { /* live parent meeting information */	
		
			global $fobrainParentMeetingTB;
		
			$parentMeetingData = $conn->query("SELECT cid, atype, link, lpass, meetid, school, info, participant, session, level, eType, allow, class, eTitle, eSubject, eDetail, eTime, sTime, cTime, eStaff, staffs, status
		
											FROM $fobrainParentMeetingTB
											
											WHERE  cid = $cid")->fetchAll(PDO::FETCH_ASSOC);
											
			array_unshift($parentMeetingData,"");
			unset($parentMeetingData[0]);
		
			return  $parentMeetingData;
		} 

		function staffMeetingData($conn) { /* live staff meeting information */	

			global $fobrainStaffMeetingTB, $fiVal;
		
			$staffMeetingData = $conn->query("SELECT cid, atype, link, lpass, meetid, participant, eType, allow, eTitle, eSubject, eDetail, eTime, sTime, cTime, eStaff, staffs, status
		
											FROM $fobrainStaffMeetingTB
											
											ORDER BY cid DESC")->fetchAll(PDO::FETCH_ASSOC);
											
			array_unshift($staffMeetingData,"");
			unset($staffMeetingData[0]);
		
			return  $staffMeetingData;
		}
		
		function staffStaffMeetingData($conn, $userID) { /* live staff meeting information */	
		
			global $fobrainStaffMeetingTB, $fiVal;
		
						$staffMeetingData = $conn->query("SELECT cid, atype, link, lpass, meetid, participant, eType, allow, eTitle, eSubject, eDetail, eTime, sTime, cTime, eStaff, staffs, status
					
														FROM $fobrainStaffMeetingTB
														
														WHERE 	eStaff = $userID
														
														ORDER BY cid DESC")->fetchAll(PDO::FETCH_ASSOC);
														
						array_unshift($staffMeetingData,"");
						unset($staffMeetingData[0]);
		
			return  $staffMeetingData;
		} 
		
		function staffMeetingInfo($conn, $cid) { /* live staff meeting information */	
		
			global $fobrainStaffMeetingTB;
		
			$staffMeetingData = $conn->query("SELECT cid, atype, link, lpass, meetid, participant, eType, allow, eTitle, eSubject, eDetail, eTime, sTime, cTime, eStaff, staffs, status
		
											FROM $fobrainStaffMeetingTB
											
											WHERE  cid = $cid")->fetchAll(PDO::FETCH_ASSOC);
											
			array_unshift($staffMeetingData,"");
			unset($staffMeetingData[0]);
		
			return  $staffMeetingData;
		} 


		/** Course  */

		function onlineCourseData($conn) { /* online student course array */	

			global $fobrainCourseTB, $fiVal;

			$onlineCourseData = $conn->query("SELECT cid, session, level, eTerm, class, eTitle, eSubject, eDetail, eTime, eStaff, status
		
											FROM $fobrainCourseTB
											
											ORDER BY cid DESC")->fetchAll(PDO::FETCH_ASSOC);
											
			array_unshift($onlineCourseData,"");
			unset($onlineCourseData[0]);

			return  $onlineCourseData;
		}

		function onlineStaffCourseData($conn, $userID) { /* online staff course information */	

			global $fobrainCourseTB, $fiVal;

			$onlineCourseData = $conn->query("SELECT cid, session, level, eTerm, class, eTitle, eSubject, eDetail, eTime, eStaff, status
		
											FROM $fobrainCourseTB
											
											WHERE 	eStaff = $userID
											
											ORDER BY cid DESC")->fetchAll(PDO::FETCH_ASSOC);
											
			array_unshift($onlineCourseData,"");
			unset($onlineCourseData[0]);

			return  $onlineCourseData;

		}

		function eStudentCourseReview($conn, $regNum) { /* online staff course information */	

			global $fobrainCourseRevTB, $fiVal; 

			$onlineCourseData = $conn->query("SELECT rid, eid, regnum, course, level, class, term, etime, 
											correct, quesno, yscore, ttime, tscore, aver
		
											FROM $fobrainCourseRevTB
											
											WHERE 	regnum = '$regNum'
											
											ORDER BY rid DESC")->fetchAll(PDO::FETCH_ASSOC);
											
			array_unshift($onlineCourseData,"");
			unset($onlineCourseData[0]);

			return  $onlineCourseData;

		}

		function onlineCourseInfo($conn, $cid) { /* online student course information */	

			global $fobrainCourseTB;

			$onlineCourseData = $conn->query("SELECT cid, session, level, eTerm, class, eTitle, eSubject, eDetail, eTime, eStaff, status
		
											FROM $fobrainCourseTB
											
											WHERE  cid = $cid")->fetchAll(PDO::FETCH_ASSOC);
											
			array_unshift($onlineCourseData,"");
			unset($onlineCourseData[0]);

			return  $onlineCourseData;

		}	
		
		
		function topicData($conn) { /* online course topic array */	

			global $fobrainCourseTopicTB, $fiVal;

			$topicData = $conn->query("SELECT tid, cid, topic
		
											FROM $fobrainCourseTopicTB")->fetchAll(PDO::FETCH_ASSOC);
											
			array_unshift($topicData,"");
			unset($topicData[0]);

			return  $topicData;

		}

		function topicInfo($conn, $tid) { /* online course topic information */	

			global $fobrainCourseTopicTB;

			$topicData = $conn->query("SELECT tid, cid, topic
		
											FROM $fobrainCourseTopicTB
											
											WHERE  tid = $tid")->fetchAll(PDO::FETCH_ASSOC);
											
			array_unshift($topicData,"");
			unset($topicData[0]);

			return  $topicData;

		}

		function courseTopics($conn, $cid) {  /* online course topic array */	

			global $fobrainCourseTopicTB;

			$topicData = $conn->query("SELECT tid, cid, topic
		
											FROM $fobrainCourseTopicTB
											
											WHERE  cid = $cid")->fetchAll(PDO::FETCH_ASSOC);
											
			array_unshift($topicData,"");
			unset($topicData[0]);

			return  $topicData;

		}

		function chapterData($conn) { /* online course chapter array */	

			global $fobrainChapterTB, $fiVal;

			$chapterData = $conn->query("SELECT hid, cid, tid, chapter, upload, details, ctype, link, duration
		
											FROM $fobrainChapterTB")->fetchAll(PDO::FETCH_ASSOC);
											
			array_unshift($chapterData,"");
			unset($chapterData[0]);

			return  $chapterData;

		}

		function chapterInfo($conn, $hid) { /* online course chapter information */	

			global $fobrainChapterTB;

			$chapterData = $conn->query("SELECT hid, cid, tid, chapter, upload, details, ctype, link, duration
		
											FROM $fobrainChapterTB
											
											WHERE  hid = $hid")->fetchAll(PDO::FETCH_ASSOC);
											
			array_unshift($chapterData,"");
			unset($chapterData[0]);

			return  $chapterData;

		}

		function courseChapters($conn, $cid, $tid) {  /* online course chapter array */	

			global $fobrainChapterTB;

			$chapterData = $conn->query("SELECT hid, cid, tid, chapter, upload, details, ctype, link, duration
		
											FROM $fobrainChapterTB
											
											WHERE  cid = $cid
											
											AND tid = $tid")->fetchAll(PDO::FETCH_ASSOC);
											
			array_unshift($chapterData,"");
			unset($chapterData[0]);

			return  $chapterData;

		} 
		
		function courseQuizData($conn) { /* online course Quiz array */	

			global $fobrainQuizTB, $fiVal;

			$courseQuizData = $conn->query("SELECT qid, cid, tid, hid, questions
		
											FROM $fobrainQuizTB")->fetchAll(PDO::FETCH_ASSOC);
											
			array_unshift($courseQuizData,"");
			unset($courseQuizData[0]);

			return  $courseQuizData;

		}

		function courseQuizInfo($conn, $qid) { /* online course Quiz information */	

			global $fobrainQuizTB;

			$courseQuizData = $conn->query("SELECT qid, cid, tid, hid, questions
		
											FROM $fobrainQuizTB
											
											WHERE  qid = $qid")->fetchAll(PDO::FETCH_ASSOC);
											
			array_unshift($courseQuizData,"");
			unset($courseQuizData[0]);

			return  $courseQuizData;

		}

		function courseQuizInfo2($conn, $cid, $tid, $hid) {  /* online course Quiz array */	

			global $fobrainQuizTB;

			$courseQuizData = $conn->query("SELECT qid, cid, tid, hid, questions
		
											FROM $fobrainQuizTB
											
											WHERE  cid = $cid
											
											AND tid = $tid
											
											AND hid = $hid")->fetchAll(PDO::FETCH_ASSOC);
											
			array_unshift($courseQuizData,"");
			unset($courseQuizData[0]);

			return  $courseQuizData;

		} 

		
		function courseReviewData($conn) {  /* school review array */

			global $courseReviewTB, $fiVal;

			$courseReviewData = $conn->query("SELECT rid, cid, regnum, review, rating, program, created, modified, cstatus 

											FROM $courseReviewTB")->fetchAll(PDO::FETCH_ASSOC);
											
			array_unshift($courseReviewData,"");
			unset($courseReviewData[0]);

			return  $courseReviewData;
			
		}

		function courseReviewArray($conn, $cid) {  /* school review information */

			global $courseReviewTB; 
 
			$courseReviewData = $conn->query("SELECT rid, cid, regnum, review, rating, program, created, modified, cstatus 

											FROM $courseReviewTB
											
											WHERE  cid = $cid")->fetchAll(PDO::FETCH_ASSOC);
											
			array_unshift($courseReviewData,"");
			unset($courseReviewData[0]);

			return  $courseReviewData;
			
		}

		function courseUserReview($conn, $cid, $user) {  /* school review information */

			global $courseReviewTB; 
 
			$courseReviewData = $conn->query("SELECT rid, cid, regnum, review, rating, program, created, modified, cstatus 

											FROM $courseReviewTB
											
											WHERE  cid = $cid
											
											AND regnum = '$user'")->fetchAll(PDO::FETCH_ASSOC);
											
			array_unshift($courseReviewData,"");
			unset($courseReviewData[0]);

			return  $courseReviewData;
			
		} 

		function courseReviewInfo($conn, $rid) {  /* school review information */

			global $courseReviewTB;

			if($rid == ""){ exit; }

			$courseReviewData = $conn->query("SELECT rid, cid, regnum, review, rating, program, created, modified, cstatus 

											FROM $courseReviewTB
											
											WHERE  rid = $rid")->fetchAll(PDO::FETCH_ASSOC);
											
			array_unshift($courseReviewData,"");
			unset($courseReviewData[0]);

			return  $courseReviewData;
			
		}

		/** Exam  */

		function quesTags($q, $ans){
			if($q == $ans){
				$tag = '<!-fob-!>1';
			}else{
				$tag = '<!-fob-!>0';
			} 
		
			return $tag;
		}
		
		function onlineExamData($conn) { /* online student examination array */	

			global $fobrainExamTB, $fiVal;

			$onlineExamData = $conn->query("SELECT eID, session, level, eTerm, class, eTitle, eSubject, eDetail, eTime, eStaff, status
		
											FROM $fobrainExamTB
											
											ORDER BY eID DESC")->fetchAll(PDO::FETCH_ASSOC);
											
			array_unshift($onlineExamData,"");
			unset($onlineExamData[0]);

			return  $onlineExamData;
		}

		function onlineStaffExamData($conn, $userID) { /* online staff examination information */	

			global $fobrainExamTB, $fiVal;

						$onlineExamData = $conn->query("SELECT eID, session, level, eTerm, class, eTitle, eSubject, eDetail, eTime, eStaff, status
					
														FROM $fobrainExamTB
														
														WHERE 	eStaff = $userID
														
														ORDER BY eID DESC")->fetchAll(PDO::FETCH_ASSOC);
														
						array_unshift($onlineExamData,"");
						unset($onlineExamData[0]);

			return  $onlineExamData;
		}

		function eStudentExamReview($conn, $regNum) { /* online staff examination information */	

			global $fobrainExamRevTB, $fiVal; 

			$onlineExamData = $conn->query("SELECT rid, eid, regnum, course, level, class, term, etime, 
											correct, quesno, yscore, ttime, tscore, aver
		
											FROM $fobrainExamRevTB
											
											WHERE 	regnum = '$regNum'
											
											ORDER BY rid DESC")->fetchAll(PDO::FETCH_ASSOC);
											
			array_unshift($onlineExamData,"");
			unset($onlineExamData[0]);

			return  $onlineExamData;
		}

		function onlineExamInfo($conn, $eID) { /* online student examination information */	

			global $fobrainExamTB;

			$onlineExamData = $conn->query("SELECT eID, session, level, eTerm, class, eTitle, eSubject, eDetail, eTime, eStaff, status
		
											FROM $fobrainExamTB
											
											WHERE  eID = $eID")->fetchAll(PDO::FETCH_ASSOC);
											
			array_unshift($onlineExamData,"");
			unset($onlineExamData[0]);

			return  $onlineExamData;
		}		 

		function questionData($conn) { /* online exam question array */	

			global $fobrainQuestionTB, $fiVal;

			$questionData = $conn->query("SELECT qID, eID, question, qPicture, qOptions, qAnswer, q1, q2, q3, q4, ans, qMark
		
											FROM $fobrainQuestionTB")->fetchAll(PDO::FETCH_ASSOC);
											
			array_unshift($questionData,"");
			unset($questionData[0]);

			return  $questionData;
		}

		function questionInfo($conn, $qID) { /* online exam question information */	

			global $fobrainQuestionTB;

			$questionData = $conn->query("SELECT qID, eID, question, qPicture, qOptions, qAnswer, q1, q2, q3, q4, ans, qMark
		
											FROM $fobrainQuestionTB
											
											WHERE  qID = $qID")->fetchAll(PDO::FETCH_ASSOC);
											
			array_unshift($questionData,"");
			unset($questionData[0]);

			return  $questionData;
		}

		function examQuestions($conn, $eID) {  /* online exam question array */	

			global $fobrainQuestionTB;

			$questionData = $conn->query("SELECT qID, eID, question, qPicture, qOptions, qAnswer, q1, q2, q3, q4, ans, qMark
		
											FROM $fobrainQuestionTB
											
											WHERE  eID = $eID")->fetchAll(PDO::FETCH_ASSOC);
											
			array_unshift($questionData,"");
			unset($questionData[0]);

			return  $questionData;
		} 

		
		function onlineHomeWorkData($conn) { /* online student home work array */	

			global $fobrainHomeWorkTB, $fiVal;

			$onlineHomeWorkData = $conn->query("SELECT eID, session, level, eTerm, class, eTitle, eSubject, eDetail, eTime, eStaff, status
		
											FROM $fobrainHomeWorkTB
											
											ORDER BY eID DESC")->fetchAll(PDO::FETCH_ASSOC);
											
			array_unshift($onlineHomeWorkData,"");
			unset($onlineHomeWorkData[0]);

			return  $onlineHomeWorkData;
		}

		function onlineStaffHomeWorkData($conn, $userID) { /* online staff home work information */	

			global $fobrainHomeWorkTB, $fiVal;

						$onlineHomeWorkData = $conn->query("SELECT eID, session, level, eTerm, class, eTitle, eSubject, eDetail, eTime, eStaff, status
					
														FROM $fobrainHomeWorkTB
														
														WHERE 	eStaff = $userID
														
														ORDER BY eID DESC")->fetchAll(PDO::FETCH_ASSOC);
														
						array_unshift($onlineHomeWorkData,"");
						unset($onlineHomeWorkData[0]);

			return  $onlineHomeWorkData;
		}

		function eStudentHomeWorkReview($conn, $regNum) { /* online staff home work information */	

			global $fobrainHomeWorkRevTB, $fiVal; 

			$onlineHomeWorkData = $conn->query("SELECT rid, eid, regnum, course, level, class, term, etime, 
											correct, quesno, yscore, ttime, tscore, aver
		
											FROM $fobrainHomeWorkRevTB
											
											WHERE 	regnum = '$regNum'
											
											ORDER BY rid DESC")->fetchAll(PDO::FETCH_ASSOC);
											
			array_unshift($onlineHomeWorkData,"");
			unset($onlineHomeWorkData[0]);

			return  $onlineHomeWorkData;
		}

		function onlineHomeWorkInfo($conn, $eID) { /* online student home work information */	

			global $fobrainHomeWorkTB;

			$onlineHomeWorkData = $conn->query("SELECT eID, session, level, eTerm, class, eTitle, eSubject, eDetail, eTime, eStaff, status
		
											FROM $fobrainHomeWorkTB
											
											WHERE  eID = $eID")->fetchAll(PDO::FETCH_ASSOC);
											
			array_unshift($onlineHomeWorkData,"");
			unset($onlineHomeWorkData[0]);

			return  $onlineHomeWorkData;
		}		 

		function questionHWData($conn) { /* online homework question array */	

			global $fobrainHMQuestionTB, $fiVal;

			$questionData = $conn->query("SELECT qID, eID, question, qPicture, qOptions, qAnswer, q1, q2, q3, q4, ans, qMark
		
											FROM $fobrainHMQuestionTB")->fetchAll(PDO::FETCH_ASSOC);
											
			array_unshift($questionData,"");
			unset($questionData[0]);

			return  $questionData;
		}

		function questionHWInfo($conn, $qID) { /* online homework question information */	

			global $fobrainHMQuestionTB;

			$questionData = $conn->query("SELECT qID, eID, question, qPicture, qOptions, qAnswer, q1, q2, q3, q4, ans, qMark
		
											FROM $fobrainHMQuestionTB
											
											WHERE  qID = $qID")->fetchAll(PDO::FETCH_ASSOC);
											
			array_unshift($questionData,"");
			unset($questionData[0]);

			return  $questionData;
		}

		function homeworkQuestions($conn, $eID) {  /* online homework question array */	

			global $fobrainHMQuestionTB;

			$questionData = $conn->query("SELECT qID, eID, question, qPicture, qOptions, qAnswer, q1, q2, q3, q4, ans, qMark
		
											FROM $fobrainHMQuestionTB
											
											WHERE  eID = $eID")->fetchAll(PDO::FETCH_ASSOC);
											
			array_unshift($questionData,"");
			unset($questionData[0]);

			return  $questionData;
		} 

		function studentLevel($conn) {  /* retrieve student level */

			global $classLevelTB, $foreal, $schoolExt, $fobrainNurAbr, $thVal;

			if($schoolExt == $fobrainNurAbr){ $limit = "LIMIT $thVal";
			}else{ $limit = ''; }
			
			$ebele_mark = "SELECT DISTINCT cl_id, level

							FROM $classLevelTB
							
							ORDER BY cl_id $limit";
					
			$igweze_prep = $conn->prepare($ebele_mark);
				
			$igweze_prep->execute();
			
			$rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count >= $foreal) {
			
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
						
					$level_id = $row['cl_id'];
					$level = $row['level'];             			

					echo "<option value=\"$level_id\">$level</option>"."\r\n";

				}	
			
			}else{
			
				echo "<option value='0'>Ooops, no student level was found</option>"."\r\n";
			
			} 

		}

		function studentClassLevel($level) {  /* retrieve student class */
			
			if($level == 1) {
			
				$stuClass = 'class_1'; 
			
			}elseif($level == 2) {
			
				$stuClass = 'class_2'; 
			
			}elseif($level == 3) {
			
				$stuClass = 'class_3'; 
			
			}elseif($level == 4) {
			
				$stuClass = 'class_4'; 
								
			}elseif($level == 5) {
			
				$stuClass = 'class_5'; 
								
			}elseif($level == 6) {

				$stuClass = 'class_6'; 
								
			}else{
			
				$stuClass = 'class_1';  
			
			}
						
			return $stuClass;
		}	

		function studentLevelsArray($conn) { /* student level array */

			global $classLevelTB, $foreal;

			$levelArray = $conn->query("SELECT DISTINCT cl_id, level

							FROM $classLevelTB
							
							ORDER BY cl_id")->fetchAll(PDO::FETCH_ASSOC);

			return  $levelArray;

		}

		function levelminCourseArray($conn) { /* retrieve student level minimum course array */

			global $classLevelTB, $foreal;

			$minCourseArray = $conn->query("SELECT DISTINCT cl_id, minCourse

							FROM $classLevelTB
							
							ORDER BY cl_id")->fetchAll(PDO::FETCH_ASSOC);
							
						array_unshift($minCourseArray,"");
						unset($minCourseArray[0]);				

			return  $minCourseArray;

		}

		function studentClass($conn, $stu_reg, $level) {  /* retrieve a student class*/

			global $i_reg_tb, $foreal;

			$nk_class = 'class_'.$level;
			
			$ebele_mark = "SELECT $nk_class

						FROM $i_reg_tb 

						WHERE nk_regno = :nk_regno";
						
				$igweze_prep = $conn->prepare($ebele_mark);

				$igweze_prep->bindValue(':nk_regno', $stu_reg, PDO::PARAM_STR);
					
				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count == $foreal) {
				
					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		

						$class = $row[$nk_class];
						
					}	
				
				}else{
				
					$class = "";
			
				} 

			return $class;

		}

		function studentClassCount($conn, $sessionID, $class, $level) {  /* count student class */

			global $i_reg_tb, $foreal;

			$nk_class = 'class_'.$level;
			
			$ebele_mark = "SELECT ireg_id

						FROM $i_reg_tb 

						WHERE 	session_id = :session_id
						
						AND active = :active
						
						AND $nk_class = :class";
						
				$igweze_prep = $conn->prepare($ebele_mark);

				$igweze_prep->bindValue(':session_id', $sessionID);
				$igweze_prep->bindValue(':active', $foreal);
				$igweze_prep->bindValue(':class', $class, PDO::PARAM_STR);
					
				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
			return $rows_count;

		} 

		function classSelectBox($classArray, $class_list, $p_class){  /* class select box array */
			
			global $i_false;

			if(is_array($classArray)){

				$classArray_l = ((count($classArray)) - 1);

				for($i = $i_false; $i <= $classArray_l; $i++){  /* loop array */

					$classList[] = $class_list[$i];

				}

				$classArrayList = array_combine($classList, $classArray);  /* combine arrays */	    

				foreach($classArrayList as $classKey => $classVal){  /* loop array */

					$classKey = trim($classKey);
					
					if($classKey == $p_class){

						$selected = "SELECTED";

					}else{

						$selected = "";
					}	

					echo '<option value="'.$classKey.'"'.$selected.'>'.$classVal.'</option>' ."\r\n"; 

				}

			}else{
				echo '<option value="">Ooops, no class found</option>' ."\r\n"; 
			}	

		}

		function studentClassArray($conn, $level) {  /* retrieve student class array */

			global $classLevelTB, $foreal;

			$ebele_mark = "SELECT class

							FROM $classLevelTB
							
							WHERE cl_id = :cl_id";
					
			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue(':cl_id', $level);
				
			$igweze_prep->execute();
			
			$rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count >= $foreal) {
			
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
						
					$classArray  = $row['class'];
					
				}	
			
			}else{
			
				$classArray = '';
			
			} 

			return  $classArray;

		}

		function studentClassTypeArray($conn, $level) { /* retrieve student class type array */

			global $classLevelTB, $foreal;

			$ebele_mark = "SELECT class_type

							FROM $classLevelTB
							
							WHERE cl_id = :cl_id";
					
			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue(':cl_id', $level);
				
			$igweze_prep->execute();
			
			$rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count >= $foreal) {
			
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
						
					$classArray  = $row['class_type'];
					
				}	
			
			}else{
			
				$classArray = '';
			
			} 

			return  $classArray;

		}

		function returnStudentClassType($conn, $level, $class) {  /* return student class type array */

			global $i_false, $foVal, $class_list;
			
			$clArray = studentClassArray($conn, $level);
			
			$classArray = unserialize($clArray);

			$classArray_l = ((count($classArray)) - 1);
			
			for($i = $i_false; $i <= $classArray_l; $i++){
			
				$classList[] = $class_list[$i];
			
			} 
			
			if($level >= $foVal){
				
				$clTyArray = studentClassTypeArray($conn, $level);
				$classTypeArray = unserialize($clTyArray);					
			
			} 
			
			$classArrayList = array_combine($classList, $classTypeArray);
			
			$classType = $classArrayList[$class]; 
			
			return $classType;

		} 

		function resetResultComputation($conn, $sessionID, $level, $class, $term) {  /* reset results computaion */

			global $rsConfigTB, $fiVal;
			
			$ebele_mark = "SELECT s_id

							FROM $rsConfigTB
					
							WHERE  session = :session
					
									AND level = :level
					
									AND class = :class
									
									AND term = :term";
				
			$igweze_prep = $conn->prepare($ebele_mark);				 
			$igweze_prep->bindValue(':session', $sessionID);
			$igweze_prep->bindValue(':level', $level);
			$igweze_prep->bindValue(':class', $class);
			$igweze_prep->bindValue(':term', $term);
			$igweze_prep->execute();

			$rows_count = $igweze_prep->rowCount(); 

			if($rows_count == $fiVal) {

				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {
								
					$s_id = $row['s_id'];
					
				} 

				$ebele_mark_1 = "UPDATE  $rsConfigTB 
				
									SET 
									
									status = :status
									
									WHERE s_id = :s_id";
								
				$igweze_prep_1 = $conn->prepare($ebele_mark_1);	
				$igweze_prep_1->bindValue(':s_id', $s_id);
				$igweze_prep_1->bindValue(':status', $fiVal);
				$igweze_prep_1->execute();
					
			}

		}

		function updateGrandSessionRS($conn, $db, $regID, $fiGrandTotal, $seGrandTotal, $thGrandTotal, $grandTotal, $grandAvg){ 
		/* update student grand annual score  */

			global $foreal, $fiVal, $i_false;

			$ebele_mark = "SELECT $fiGrandTotal, $seGrandTotal, $thGrandTotal 

							FROM $db 

							WHERE  ireg_id = :reg_id";

			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue(':reg_id', $regID);				 
			$igweze_prep->execute();

			$rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count == $foreal) {

				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		

					$fiGrandT = $row[$fiGrandTotal];
					$seGrandT = $row[$seGrandTotal];
					$thGrandT = $row[$thGrandTotal];

					if($fiGrandT >= $fiVal){ $fiCount = $fiVal; }
						
					else{ $fiCount = ''; $fiGrandT = ''; }

					if($seGrandT >= $fiVal){ $seCount = $fiVal; }
						
					else{ $seCount = ''; $seGrandT = ''; }

					if($thGrandT >= $fiVal){ $thCount = $fiVal; }
						
					else{ $thCount = ''; $thGrandT = ''; }

					$totalGrand = ($fiGrandT + $seGrandT + $thGrandT);
					$totalCount = ($fiCount + $seCount + $thCount);
					if(($totalGrand >= $fiVal) && ($totalCount >= $fiVal)){
						
						$grandAverage = ($totalGrand / $totalCount);
						$grandAverage = number_format($grandAverage, 1);


						$ebele_mark_2 = "UPDATE $db SET  

									$grandTotal = :grand_to,
									
									$grandAvg = :grade_nk 
									
									WHERE  ireg_id = :reg_id";
						
						$igweze_prep_2 = $conn->prepare($ebele_mark_2);
						$igweze_prep_2->bindValue(':reg_id', $regID);
						$igweze_prep_2->bindValue(':grand_to', $totalGrand);
						$igweze_prep_2->bindValue(':grade_nk', $grandAverage);  
						
						if($igweze_prep_2->execute()){
							
							return $fiVal;
							
						}
						
					}else{ return $i_false;}
				}

			}else{

				return $i_false;

			}
			
									
		} 

		function updateClassAnnualRS($conn, $db, $sessionID, $nk_class, $class, $fiGrandAvg, $seGrandAvg, $thGrandAvg, $grandAvg){

		/* update class annual result */	

			global $i_reg_tb, $foreal, $fiVal, $i_false, $fiVal, $seVal, $thVal, $schoolCutoff; //$GrandAvg, 

			$ebele_mark = "SELECT a.$fiGrandAvg, $seGrandAvg, $thGrandAvg, r.ireg_id, nk_regno 
			
							FROM $i_reg_tb r INNER JOIN $db a
						
							WHERE  r.ireg_id = a.ireg_id

							AND r.session_id = :session_id
							
							AND r.$nk_class = :class

							AND r.active = :foreal";
				
			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue(':session_id', $sessionID, PDO::PARAM_STR);
			$igweze_prep->bindValue(':foreal', $foreal, PDO::PARAM_STR);
			$igweze_prep->bindValue(':class', $class, PDO::PARAM_STR);				  
			$igweze_prep->execute();
				
			$rows_count = $igweze_prep->rowCount(); 
				
			if($rows_count >= $foreal) {

				while($row = $igweze_prep->fetch(PDO::FETCH_BOTH)) {		

					$regNum = $row['nk_regno'];
					$regID = $row['ireg_id'];
					$fiGrandT = $row[$fiGrandAvg];
					$seGrandT = $row[$seGrandAvg];
					$thGrandT = $row[$thGrandAvg]; 
					
					if($fiGrandT >= $fiVal){ $fiCount = $fiVal; }
						
					else{ $fiCount = ''; $fiGrandT = ''; }
					
					if($seGrandT >= $fiVal){ $seCount = $fiVal; }
						
					else{ $seCount = ''; $seGrandT = ''; }
					
					if($thGrandT >= $fiVal){ $thCount = $fiVal; }
						
					else{ $thCount = ''; $thGrandT = ''; }
					
					$totalGrand = ($fiGrandT + $seGrandT + $thGrandT);
					$totalCount = ($fiCount + $seCount + $thCount);
					
					if(($totalGrand >= $fiVal) && ($totalCount >= $fiVal)){
						
						$grandAverage = ($totalGrand / $totalCount);
						$grandAverage = number_format($grandAverage, 1); 
						
						if($grandAverage > $schoolCutoff){
							
							$promoted = $fiVal;
							
						}elseif($grandAverage == $schoolCutoff){
							
							$promoted = $seVal;

						}elseif($grandAverage > $schoolCutoff){
							
							$promoted = $thVal;

						}else{
							
							
							$promoted = $thVal;

						}	

						$ebele_mark_2 = "UPDATE $db SET  
						
							$grandAvg = :grade_nk,
							certify = :certify	
							
							WHERE  ireg_id = :reg_id";
						
						$igweze_prep_2 = $conn->prepare($ebele_mark_2);
						$igweze_prep_2->bindValue(':reg_id', $regID);
						//$igweze_prep_2->bindValue(':grand_to', $totalGrand); $GrandAvg = :grand_to, //checkThis
						$igweze_prep_2->bindValue(':grade_nk', $grandAverage); 
						$igweze_prep_2->bindValue(':certify', $promoted);
						$igweze_prep_2->execute();  
						
					}else{  
						
						$ebele_mark_2 = "UPDATE $db SET  
						
								
							certify = :certify	
							
							WHERE  ireg_id = :reg_id";
						
						$igweze_prep_2 = $conn->prepare($ebele_mark_2);
						$igweze_prep_2->bindValue(':reg_id', $regID);
						//$igweze_prep_2->bindValue(':grand_to', $totalGrand); $GrandAvg = :grand_to,	//checkThis							 
						$igweze_prep_2->bindValue(':certify', $thVal); 	   
						$igweze_prep_2->execute();
					
					}
				}
				
			}else{
					
				return $i_false;
					
			} 
									
		}

		function maxStudentScore($conn, $stu_reg, $db, $field, $sessionID, $class, $nk_class) { /* student termly maximum subject score */

			global $i_reg_tb, $fiVal; 

			$ebele_mark = "SELECT MAX($field) AS maximum

							FROM $i_reg_tb r, $db f
							
							WHERE r.ireg_id = f.ireg_id

							AND r.session_id = :session_id 
						
							AND r.$nk_class = :class

							AND r.active = :foreal";
					
			$igweze_prep = $conn->prepare($ebele_mark);				
			$igweze_prep->bindValue(':session_id', $sessionID, PDO::PARAM_STR);				
			$igweze_prep->bindValue(':class', $class, PDO::PARAM_STR);				
			$igweze_prep->bindValue(':foreal', $fiVal, PDO::PARAM_STR);								 
			$igweze_prep->execute();
			
			$rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count == $fiVal) {
			
				while($row = $igweze_prep->fetch(PDO::FETCH_BOTH)) {		

					$max_score = $row['maximum']; 
					
				}	

			}else{

				$max_score = '';

			} 
			
			return $max_score; 

		} 

		function classBestStudentReg($conn, $db, $fieldPosi, $sessionID, $class, $nk_class) {  /* retrieve class best student information */

			global $i_reg_tb, $foreal; 

			$ebele_mark= "SELECT r.nk_regno

							FROM $i_reg_tb r INNER JOIN $db f
						
							ON (r.ireg_id = f.ireg_id)

							AND r.session_id = :session_id 
						
							AND r.$nk_class = :class

							AND r.active = :foreal
						
							AND f.$fieldPosi = :fieldPosi";
				
					
			$igweze_prep= $conn->prepare($ebele_mark);
			$igweze_prep->bindValue(':session_id', $sessionID, PDO::PARAM_STR);				
			$igweze_prep->bindValue(':foreal', $foreal, PDO::PARAM_STR);				
			$igweze_prep->bindValue(':class', $class, PDO::PARAM_STR);				
			$igweze_prep->bindValue(':fieldPosi', $foreal, PDO::PARAM_STR);
				
			$igweze_prep->execute();
			
			$rows_count= $igweze_prep->rowCount(); 
			
			if($rows_count >= $foreal) {
			
				while($row= $igweze_prep->fetch(PDO::FETCH_BOTH)) {		

					$regNumArr [] = $row['nk_regno'];  

				}	 
			
			}else{
				
				$regNumArr = '';
						
			}
			
			return $regNumArr;
			
		}

		function classSessionBeststudentReg($conn, $db, $sessionID, $fieldPosi, $fieldAvg) { /* retrieve all class best student information */

			global $i_reg_tb, $foreal; 

			$ebele_mark= "SELECT r.nk_regno

							FROM $i_reg_tb r INNER JOIN $db f
						
							ON (r.ireg_id = f.ireg_id)

							AND r.session_id = :session_id 

							AND r.active = :foreal
						
							AND f.$fieldPosi = :fieldPosi
							
							ORDER BY $fieldAvg DESC"; 
					
			$igweze_prep= $conn->prepare($ebele_mark);
			$igweze_prep->bindValue(':session_id', $sessionID, PDO::PARAM_STR);				
			$igweze_prep->bindValue(':foreal', $foreal, PDO::PARAM_STR);				
			$igweze_prep->bindValue(':fieldPosi', $foreal, PDO::PARAM_STR);				 
			$igweze_prep->execute();
			
			$rows_count= $igweze_prep->rowCount(); 
			
			if($rows_count >= $foreal) {
			
				while($row= $igweze_prep->fetch(PDO::FETCH_BOTH)) {		

					$regNumArr [] = $row['nk_regno'];  

				}	 
			
			}else{
				
				$regNumArr = '';
						
			}
			
			return $regNumArr;
			
		}	 

		function classPromotionManager($conn, $db, $regNum){  /* school class student promotion manager Compact func below */ 

			global $i_reg_tb, $foreal, $fiVal, $seVal, $thVal, $i_false; 

			$ebele_mark = "SELECT r.ireg_id, nk_regno, f.certify

					FROM $i_reg_tb r, $db f

					WHERE r.nk_regno = :nk_regno

					AND r.ireg_id = f.ireg_id";
					
			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue(':nk_regno', $regNum);			  
			$igweze_prep->execute();
				
			$rows_count = $igweze_prep->rowCount(); 
				
			if($rows_count == $foreal) {

				while($row = $igweze_prep->fetch(PDO::FETCH_BOTH)) {		
						
					$promoted = $row['certify'];
					$regID = $row['ireg_id'];
						
				}
				
				if($promoted == $fiVal){							
					
					$promtSub = '<span class="font-head-1 fs-16 fw-600 text-success">Promoted </span>';							
				
				}elseif($promoted == $seVal){
					
					$promtSub = '<span class="font-head-1 fs-16 fw-600 text-info">Promoted on Trial</span>';
					
				}elseif($promoted == $thVal){
					
					$promtSub = '<span class="font-head-1 fs-16 fw-600 text-danger">Not Promoted</span>';
					
				}else{							
					
					$promtSub = '<span class="font-head-1 fs-16 fw-600 text-danger">Not Promoted</span>';							
				
				}  
				
			}else{ 
					
				$promtSub = '<span class="font-head-1 fs-16 fw-600 text-danger">Not Promoted</span>'; 
					
			}
				
				
			return $promtSub;
		}					  

		function classPromotionManagerMin($conn, $promoted){  /* school class student promotion manager */

			global $fiVal, $seVal, $thVal, $i_false; 
						
			if($promoted == $fiVal){							
				
				$promtSub = '<div class="font-head-1 fs-14 fw-600 text-success">Promoted </div>';							
			
			}elseif($promoted == $seVal){ 

				$promtSub = '<div class="font-head-1 fs-14 fw-600 text-info">Promoted on Trial</div>';
				
			}elseif($promoted == $thVal){
				
				$promtSub = '<div class="font-head-1 fs-14 fw-600 text-danger">Not Promoted</div>'; 
				
			}else{							
				
				$promtSub = '<div class="font-head-1 fs-14 fw-600 text-danger">Not Promoted</div>';					
			
			}					
					
			return $promtSub;
		}		 

		function termStatusTb($term) {  /* student result status function  */

			global $result_status_fi_term, $result_status_se_term, $result_status_th_term;

			if ($term == 1){

				$term_status_tb = $result_status_fi_term;

				}elseif ($term == 2){

				$term_status_tb = $result_status_se_term;

			}elseif ($term == 3){

				$term_status_tb = $result_status_th_term;

			}else {

				$term_status_tb = '';

			}

			return $term_status_tb;

		} 

		function fobrainResultStatus($conn, $sessionID, $class, $level, $term) {	 /* student result status */	 

			global $rsConfigTB, $foreal, $i_false;
			
			$ebele_mark = "SELECT s_id, status
	
					FROM $rsConfigTB
					
							WHERE  session = :session
					
									AND level = :level
					
									AND class = :class
									
									AND term = :term";
				
			$igweze_prep = $conn->prepare($ebele_mark);				 
			$igweze_prep->bindValue(':session', $sessionID);
			$igweze_prep->bindValue(':level', $level);
			$igweze_prep->bindValue(':class', $class);
			$igweze_prep->bindValue(':term', $term);
			$igweze_prep->execute();
	
			$rows_count = $igweze_prep->rowCount(); 
	
			if($rows_count == $i_false) {
	
				$statusRS = $foreal;
	
			}else{
				
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {
								
					$statusRS = $row['status'];
					
				}
			
			}

			return $statusRS;

		}
		
		function fobrainResultStatus2($conn, $sessionID, $class, $level, $term, $adminID) {	 /* student result status */	 

			global $rsConfigTB, $rsConfigTB, $foreal, $i_false;
			
			$ebele_mark = "SELECT s_id, status
	
					FROM $rsConfigTB
					
							WHERE  session = :session
					
									AND level = :level
					
									AND class = :class
									
									AND term = :term";
				
			$igweze_prep = $conn->prepare($ebele_mark);				 
			$igweze_prep->bindValue(':session', $sessionID);
			$igweze_prep->bindValue(':level', $level);
			$igweze_prep->bindValue(':class', $class);
			$igweze_prep->bindValue(':term', $term);
			$igweze_prep->execute(); 
	
			$rows_count = $igweze_prep->rowCount(); 
	
			if($rows_count == $i_false) { 
				
				$ebele_mark_1 = "INSERT INTO $rsConfigTB (session, level, class, term,
															t_info, staff_id, status) 
							
								VALUES(:session, :level, :class, :term, :t_info, :staff_id, :status)";
								
				$igweze_prep_1 = $conn->prepare($ebele_mark_1);	
				$igweze_prep_1->bindValue(':session', $sessionID);
				$igweze_prep_1->bindValue(':level', $level);
				$igweze_prep_1->bindValue(':class', $class);
				$igweze_prep_1->bindValue(':term', $term);
				$igweze_prep_1->bindValue(':t_info', $teachersInfo);
				$igweze_prep_1->bindValue(':staff_id', $adminID);
				$igweze_prep_1->bindValue(':status', $foreal);
				
				if($igweze_prep_1->execute()){
					$statusRS = $foreal;
				}else{
					$statusRS = 0;
				}
	
			}else{
				
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {
								
					$statusRS = $row['status'];
					
				}
			
			}

			return $statusRS;

		}

		function resultStatus($rs_status, $term){ 

			if($rs_status != "")	{
				$rs_status_arr = preg_split("/\,/", $rs_status); 
				if(is_array($rs_status_arr)){
					$status = $rs_status_arr[$term];
				}else{
					$status =  0; 
				}
			}else{
				$status =  0;       
			}

			if($status == 0){
				$r_status = "<span class='text-danger fw-600'>Pending</span>";
			}elseif($status == 1){
				$r_status = "<span class='text-success fw-600'>Approved</span>";
			}else{
				$r_status = "<span class='text-danger fw-600'>Pending</span>";
			}	

			return $status."@@".$r_status;

		}

		function updateResultStatus($conn, $rs_status, $regID, $level, $term){ 

			global $i_reg_tb;

			if($rs_status != ""){

				$rs_status_arr = preg_split("/\,/", $rs_status); 
				 
				if(is_array($rs_status_arr)){
					
					$rs_status_arr[$term] = 1;

					$status = implode(',', $rs_status_arr);

				}else{ $status =  "0,0,0"; }

			}else{ $status =  "0,0,0"; }  

			$rs_check = "rs_".$level;
			$rs_check_q = ":rs_".$level;

			$ebele_mark_qp = "UPDATE  $i_reg_tb 
					
								SET 
								
								$rs_check = $rs_check_q
								
								WHERE ireg_id = :reg_id";
							
			$igweze_prep_qp = $conn->prepare($ebele_mark_qp);	
			$igweze_prep_qp->bindValue(':reg_id', $regID);
			$igweze_prep_qp->bindValue($rs_check_q, $status);
			$igweze_prep_qp->execute();

		}

		function rsClassTeachers($conn, $sessionID, $class, $level, $term) {  /* retrieve subject class teachers */	 	

			global $rsConfigTB, $foreal, $i_false;
			
			$ebele_mark = "SELECT t_info
	
					FROM $rsConfigTB
					
							WHERE  session = :session
					
									AND level = :level
					
									AND class = :class
									
									AND term = :term";
				
			$igweze_prep = $conn->prepare($ebele_mark);				 
			$igweze_prep->bindValue(':session', $sessionID);
			$igweze_prep->bindValue(':level', $level);
			$igweze_prep->bindValue(':class', $class);
			$igweze_prep->bindValue(':term', $term);
			$igweze_prep->execute();
	
			$rows_count = $igweze_prep->rowCount(); 
	
			if($rows_count == $i_false) {
	
				$t_info = $foreal;
	
			}else{
				
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {
								
					$t_info = $row['t_info'];
					
				}
			
			} 

			return $t_info; 

		}  

		function rsTimeFrame($conn, $term, $sessionID) {	/* student result time frame  */	

			global $schoolSessionTB, $foreal, $expireStage, $editingStage;
			
			$rstf = rsTimeFrameField($term);

			$ebele_mark = "SELECT $rstf

								FROM $schoolSessionTB WHERE
					
								id_sess = :id_sess";
					
			$igweze_prep = $conn->prepare($ebele_mark);

			$igweze_prep->bindValue(':id_sess', $sessionID);
				
			$igweze_prep->execute();
			
			$rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count == $foreal) {
			
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		

					$timeframe = $row[$rstf];
					
				}	
			
			}else{
			
				$timeframe = "";
			
			} 

			$frstf = new DateTime($timeframe);
			$frstf->format('md');
				
			$today = new DateTime();
			$today->format('md');
				
			if($today >= $frstf){
					
				$tfStatus = $expireStage;
					
			}else{
					
				$tfStatus = $editingStage;
					
			}

			return $tfStatus; 

		} 

		function rsTermStatus($conn, $term_status_tb, $sessionID, $level, $class) {		/* student termly result status  */

			global $foreal; $RClass = 'R'.$class;

			$ebele_mark = "SELECT $RClass

					FROM $term_status_tb WHERE
					
					session = :session

					AND level = :level";
					
			$igweze_prep = $conn->prepare($ebele_mark);

			$igweze_prep->bindValue(':session', $sessionID);
			$igweze_prep->bindValue(':level', $level);
				
			$igweze_prep->execute();
			
			$rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count == $foreal) {
			
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		

					$status = $row[$RClass];
					
				}	
			
			}else{
			
				$status = "";
			
			}

			return $status;
					
		}   

		function studentRegSessionID($conn, $stu_reg) {  /* student school session ID */

			global $i_reg_tb, $foreal;

			$ebele_mark = "SELECT session_id

					FROM $i_reg_tb 

					WHERE nk_regno = :nk_regno";
					
			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue(':nk_regno', $stu_reg, PDO::PARAM_STR);				 
			$igweze_prep->execute();
			
			$rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count == $foreal) {
			
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		

					$sess_id = $row['session_id'];
					
				}	
			
			}else{

				$sess_id = "";

			}

			return  $sess_id;

		}

		function sessionID($conn, $stu_session) {  /* school session ID */

			global $schoolSessionTB, $foreal;

			$ebele_mark = "SELECT id_sess

						FROM $schoolSessionTB 

						WHERE year = :year";
					
			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue(':year', $stu_session);				 
			$igweze_prep->execute();
			
			$rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count == $foreal) {
			
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		

					$sessionID = $row['id_sess'];
					
				}	
			
			}else{ $sessionID = "";  }

			return $sessionID; 

		}

		function fobrainSession($conn, $sess_id) {  /* school session  */

			global $schoolSessionTB, $foreal;

			$ebele_mark = "SELECT year

						FROM $schoolSessionTB 

						WHERE id_sess = :id_sess";
					
			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue(':id_sess', $sess_id, PDO::PARAM_INT);				 
			$igweze_prep->execute();
			
			$rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count == $foreal) {
			
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		

					$session = $row['year'];
					
				}	
			
			}else{
			
				$session = "0";
			
			}

			return intVal($session);

		} 

		function termStartDate($conn, $sessionID, $term) {  /* retrieve school next term start  */

			global $schoolSessionTB, $foreal, $fiVal, $seVal, $thVal; 

			if($term == $fiVal) { $termVal = 'se_term';}
			elseif($term == $seVal) { $termVal = 'th_term';}
			elseif($term == $thVal) { $termVal = 'fi_term'; $sessionID += 1;}
			else { $termVal = 'fi_term';}

			$ebele_mark = "SELECT $termVal

						FROM $schoolSessionTB 

						WHERE 	id_sess = :session_id";
					
			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue(':session_id', $sessionID);				 
			$igweze_prep->execute();
			
			$rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count == $foreal) {
			
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		

					$nextDate = $row[$termVal];
					
				}	
			
			}else{
			
				$nextDate = "";

			} 

			return $nextDate; 

		}  

		function schoolSession($conn) {  /* school session  */

			global $schoolSessionTB, $foreal, $i_false, $fiVal, $seVal, $thVal, $foVal, $fifVal, $sixVal,
			$schoolExt, $fobrainNurAbr;

			$levelArray = studentLevelsArray($conn);

			$curSess = currentSessionInfo($conn);
			
			list ($curSessID, $cSess) = explode ("@$@", $curSess);
			
			$fi_l = intval($curSessID); 		$fi_level = $levelArray[$i_false]['level'];
			$se_l = ($curSessID - $fiVal);		$se_level = $levelArray[$fiVal]['level'];
			$th_l = ($curSessID - $seVal);		$th_level = $levelArray[$seVal]['level'];
			$fo_l = ($curSessID - $thVal);		$fo_level = $levelArray[$thVal]['level'];
			$fif_l = ($curSessID - $foVal);		$fif_level = $levelArray[$foVal]['level'];
			$six_l = ($curSessID - $fifVal);	$six_level = $levelArray[$fifVal]['level'];
							
			$ebele_mark = "SELECT DISTINCT id_sess, year, current

							FROM $schoolSessionTB 
								
								ORDER BY year";
					
			$igweze_prep = $conn->prepare($ebele_mark);
			//$igweze_prep->bindValue(':used', $foreal, PDO::PARAM_STR);
			$igweze_prep->execute();
			
			$rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count >= $foreal) {
				
				$terminate = false;
			
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
						
					$sessID = $row['id_sess'];
					$yr = $row['year'];
					$yr1 = $row['year'] + $foreal;
					$current = $row['current'];
					$ses_yr = "$yr - $yr1"; 
					
					if($current == $foreal){
						
						$selectSess = 'selected';
						$currentS = ' - Current Session';
						
					}else{
						
						$selectSess = '';
						$currentS = '';
					}
					
					$verbAf = '';//Class Now 

					if($schoolExt == $fobrainNurAbr){

						if($sessID  == $fi_l){
						
							$classLevel = $fi_level.$verbAf; //for student in
							
						}elseif($sessID  == $se_l){
						
							$classLevel = $se_level.$verbAf;	//for student in 					
						
						}elseif($sessID  == $th_l){
						
							$classLevel = $th_level.$verbAf; //for student in 
							
						}else{
						
							$classLevel  = '';
						}

					}else{


						if($sessID  == $fi_l){
						
							$classLevel = $fi_level.$verbAf; //for student in 
							
						}elseif($sessID  == $se_l){
						
							$classLevel = $se_level.$verbAf;						
						
						}elseif($sessID  == $th_l){
						
							$classLevel = $th_level.$verbAf;
							
						}elseif($sessID  == $fo_l){
						
							$classLevel = $fo_level.$verbAf;
							
						}elseif($sessID  == $fif_l){
						
							$classLevel = $fif_level.$verbAf;
							
						}elseif($sessID  == $six_l){
						
							$classLevel = $six_level.$verbAf;
							
						}else{
						
							$classLevel  = '';
						}

					}

					if($terminate == false){

						echo "<option value=\"$yr\" $selectSess >
								$ses_yr Session ($classLevel) $currentS 
							</option>"."\r\n";
					
					}

					if($current == $foreal){
						
						$terminate = true;
						
					} 

				}	
			
			}else{
			
				echo "<option value='0'>Ooops, no school session was found</option>"."\r\n";
			
			} 

		} 

		function schoolSessionL($conn) { /* school session  */

			global $schoolSessionTB, $foreal, $i_false, $fiVal, $seVal, $thVal, $foVal, $fifVal, $sixVal,
			$schoolExt,$fobrainNurAbr;

			$levelArray = studentLevelsArray($conn);
			$curSess = currentSessionInfo($conn);
			
			list ($curSessID, $cSess) = explode ("@$@", $curSess);
			
			$fi_l = intval($curSessID); 		$fi_level = $levelArray[$i_false]['level'];
			$se_l = ($curSessID - $fiVal);		$se_level = $levelArray[$fiVal]['level'];
			$th_l = ($curSessID - $seVal);		$th_level = $levelArray[$seVal]['level'];
			$fo_l = ($curSessID - $thVal);		$fo_level = $levelArray[$thVal]['level'];
			$fif_l = ($curSessID - $foVal);		$fif_level = $levelArray[$foVal]['level'];
			$six_l = ($curSessID - $fifVal);	$six_level = $levelArray[$fifVal]['level'];
							
			$ebele_mark = "SELECT DISTINCT id_sess, year, current

							FROM $schoolSessionTB 
								
								ORDER BY year DESC";
					
			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->execute();
			
			echo $rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count >= $foreal) {
			
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
						
					$sessID = $row['id_sess'];
					$yr = $row['year'];
					$yr1 = $row['year'] + $foreal;
					$current = $row['current'];
					$ses_yr = "$yr - $yr1";
					
					if($current == $foreal){
						
						//$selectSess = 'selected';
						$currentS = ' - Current';
						
					}else{
						
						//$selectSess = '';
						$currentS = '';
						
					}
					
					$showClass = false;
					
					if($schoolExt == $fobrainNurAbr){ 

						if($sessID  == $fi_l){
						
							$classLevel = $fi_level;
							$flevel = $fiVal;
							$showClass = true;
							
						}elseif($sessID  == $se_l){
						
							$classLevel = $se_level;
							$flevel = $seVal;
							$showClass = true;
						
						}elseif($sessID  == $th_l){
						
							$classLevel = $th_level;
							$flevel = $thVal;
							$showClass = true;
							
						}else{
						
							$classLevel  = '';
							$flevel = '';
							$showClass = false;
						}

					
					}else{
						
						if($sessID  == $fi_l){
						
							$classLevel = $fi_level;
							$flevel = $fiVal;
							$showClass = true;
							
						}elseif($sessID  == $se_l){
						
							$classLevel = $se_level;
							$flevel = $seVal;
							$showClass = true;
						
						}elseif($sessID  == $th_l){
						
							$classLevel = $th_level;
							$flevel = $thVal;
							$showClass = true;
							
						}elseif($sessID  == $fo_l){
						
							$classLevel = $fo_level;
							$flevel = $foVal;
							$showClass = true;
							
						}elseif($sessID  == $fif_l){
						
							$classLevel = $fif_level;
							$flevel = $fifVal;
							$showClass = true;
							
						}elseif($sessID  == $six_l){
						
							$classLevel = $six_level;
							$flevel = $sixVal;
							$showClass = true;
							
						}else{
						
							$classLevel  = '';
							$flevel = '';
							$showClass = false;
						}
					}
					
					if($showClass == true){
						
						$slData = trim($yr.'#@@#'.$flevel.'#@@#'.$classLevel);	

						if($passData == $slData){
								
							$selectSess = 'selected';
							
						}else{

							$selectSess = '';
						} 
						
						echo "<option value='$slData' $selectSess >$classLevel </option>"."\r\n";
					
					}

				}	
			
			}else{
			
				echo "<option value='0'>Ooops, no school session was found</option>"."\r\n";
			
			} 

		}

		function schoolSessionPassData($conn, $passData) { /* school session with pass data  */

			global $schoolSessionTB, $foreal, $i_false, $fiVal, $seVal, $thVal, $foVal, $fifVal, $sixVal,
			$schoolExt,$fobrainNurAbr;

			$levelArray = studentLevelsArray($conn);

			$curSess = currentSessionInfo($conn);
			//$curSess = currentSessionInfo($conn, $passData);
			
			list ($curSessID, $cSess) = explode ("@$@", $curSess);
			
			$fi_l = intval($curSessID); 		$fi_level = $levelArray[$i_false]['level'];
			$se_l = ($curSessID - $fiVal);		$se_level = $levelArray[$fiVal]['level'];
			$th_l = ($curSessID - $seVal);		$th_level = $levelArray[$seVal]['level'];
			$fo_l = ($curSessID - $thVal);		$fo_level = $levelArray[$thVal]['level'];
			$fif_l = ($curSessID - $foVal);		$fif_level = $levelArray[$foVal]['level'];
			$six_l = ($curSessID - $fifVal);	$six_level = $levelArray[$fifVal]['level'];
							
			$ebele_mark = "SELECT DISTINCT id_sess, year, current

							FROM $schoolSessionTB 
								
								ORDER BY year DESC";
					
			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->execute();
			
			echo $rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count >= $foreal) {
			
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
						
					$sessID = $row['id_sess'];
					$yr = $row['year'];
					$yr1 = $row['year'] + $foreal;
					$current = $row['current'];
					$ses_yr = "$yr - $yr1";
					
					if($current == $foreal){
						
						//$selectSess = 'selected';
						$currentS = ' - Current';
						
					}else{
						
						//$selectSess = '';
						$currentS = '';
						
					}
					
					$showClass = false;
					
					if($schoolExt == $fobrainNurAbr){ 

						if($sessID  == $fi_l){
						
							$classLevel = $fi_level;
							$flevel = $fiVal;
							$showClass = true;
							
						}elseif($sessID  == $se_l){
						
							$classLevel = $se_level;
							$flevel = $seVal;
							$showClass = true;
						
						}elseif($sessID  == $th_l){
						
							$classLevel = $th_level;
							$flevel = $thVal;
							$showClass = true;
							
						}else{
						
							$classLevel  = '';
							$flevel = '';
							$showClass = false;
						}

					
					}else{
						
						if($sessID  == $fi_l){
						
							$classLevel = $fi_level;
							$flevel = $fiVal;
							$showClass = true;
							
						}elseif($sessID  == $se_l){
						
							$classLevel = $se_level;
							$flevel = $seVal;
							$showClass = true;
						
						}elseif($sessID  == $th_l){
						
							$classLevel = $th_level;
							$flevel = $thVal;
							$showClass = true;
							
						}elseif($sessID  == $fo_l){
						
							$classLevel = $fo_level;
							$flevel = $foVal;
							$showClass = true;
							
						}elseif($sessID  == $fif_l){
						
							$classLevel = $fif_level;
							$flevel = $fifVal;
							$showClass = true;
							
						}elseif($sessID  == $six_l){
						
							$classLevel = $six_level;
							$flevel = $sixVal;
							$showClass = true;
							
						}else{
						
							$classLevel  = '';
							$flevel = '';
							$showClass = false;
						}
					}
					
					if($showClass == true){
						
						$slData = trim($yr.'#@@#'.$flevel);	
						if($passData == $slData){
								
							$selectSess = 'selected';
							
						}else{

							$selectSess = '';
						} 
						
						echo "<option value='$slData' $selectSess >  $classLevel </option>"."\r\n";
					
					}

				}	
			
			}else{
			
				echo "<option value='0'>Ooops, no school session was found</option>"."\r\n";
			
			}


		}

		function formTeacherSession($conn, $tID, $mType) { /* class teacher school session  */

			global $classFormTeachersTB, $schoolSessionTB, $foreal, $i_false, $fiVal, $seVal, $thVal, $foVal, 
			$fifVal, $sixVal, $schoolExt,$fobrainNurAbr;

			$levelArray = studentLevelsArray($conn);
			$curSess = currentSessionInfo($conn);
			
			list ($curSessID, $cSess) = explode ("@$@", $curSess);
			
			$fi_l = $curSessID; 				$fi_level = $levelArray[$i_false]['level'];
			$se_l = ($curSessID - $fiVal);		$se_level = $levelArray[$fiVal]['level'];
			$th_l = ($curSessID - $seVal);		$th_level = $levelArray[$seVal]['level'];
			$fo_l = ($curSessID - $thVal);		$fo_level = $levelArray[$thVal]['level'];
			$fif_l = ($curSessID - $foVal);		$fif_level = $levelArray[$foVal]['level'];
			$six_l = ($curSessID - $fifVal);	$six_level = $levelArray[$fifVal]['level'];  

			$ebele_mark = "SELECT DISTINCT s.year, id_sess, current, f.session	

							FROM $schoolSessionTB s INNER JOIN $classFormTeachersTB f
							
							ON s.id_sess = f.session
							
							AND f.t_id = :t_id
								
							ORDER BY year";
					
			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue(':t_id', $tID);
			$igweze_prep->execute();
			
			$rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count >= $foreal) {
			
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
						
					$sessID = $row['id_sess'];
					$yr = $row['year'];
					$yr1 = $row['year'] + $foreal;
					$current = $row['current'];
					$ses_yr = "$yr - $yr1";
					
					if($current == $foreal){
						
						//$selectSess = 'selected';
						$currentS = ' - Current';
						
					}else{
						
						//$selectSess = '';
						$currentS = '';
						
					}
					

					$verbAf = ' Class Now ';

					if($schoolExt == $fobrainNurAbr){

						if($sessID  == $fi_l){
						
							$classLevel = ' - for student in '.$fi_level.$verbAf;
							$classML = $fi_level; $classMLV = $fiVal;
							
						}elseif($sessID  == $se_l){
						
							$classLevel = ' - for student in '.$se_level.$verbAf;
							$classML = $se_level; $classMLV = $seVal;	 		
							
						
						}elseif($sessID  == $th_l){
						
							$classLevel = ' - for student in '.$th_level.$verbAf;
							$classML = $th_level; $classMLV = $thVal;
							
						}else{
						
							$classLevel  = ''; $classML = ''; $classMLV = '';
						}
						
						if($mType == $seVal){
							
							$classInfo = $yr.'::-::'.$classMLV;
				
							echo "<option value=\"$classInfo\" $selectSess>$classML</option>"."\r\n";
							
							$classInfo = '';
					
						}

					}else{

						if($sessID  == $fi_l){
						
							$classLevel = ' - for student in '.$fi_level.$verbAf;
							$classML = $fi_level; $classMLV = $fiVal;
							
						}elseif($sessID  == $se_l){
						
							$classLevel = ' - for student in '.$se_level.$verbAf;
							$classML = $se_level; $classMLV = $seVal;									
						
						}elseif($sessID  == $th_l){
						
							$classLevel = ' - for student in '.$th_level.$verbAf;
							$classML = $th_level; $classMLV = $thVal;
							
						}elseif($sessID  == $fo_l){
						
							$classLevel = ' - for student in '.$fo_level.$verbAf;
							$classML = $fo_level; $classMLV = $foVal;
							
						}elseif($sessID  == $fif_l){
						
							$classLevel = ' - for student in '.$fif_level.$verbAf;
							$classML = $fif_level; $classMLV = $fifVal;
							
						}elseif($sessID  == $six_l){
						
							$classLevel = ' - for student in '.$six_level.$verbAf;
							$classML = $six_level; $classMLV = $sixVal;
							
						}else{
						
							$classLevel  = ''; $classML = ''; $classMLV = '';
						}
						
						if($mType == $seVal){
							
							$classInfo = $yr.'::-::'.$classMLV;
				
							echo "<option value=\"$classInfo\" $selectSess>$classML</option>"."\r\n";
							
							$classInfo = '';
					
						}

					}

					if($mType == $fiVal){
					
						echo "<option value=\"$yr\" $selectSess>$ses_yr Session $classLevel $currentS </option>"."\r\n";
						
					}	

				}	
			
			}else{
			
				echo "<option value='0'>Ooops, you have no class assign to you</option>"."\r\n";
			
			}

		}

		function formTeacherSessionPass($conn, $tID, $mType, $passData) { /* class teacher school session  */

			global $classFormTeachersTB, $schoolSessionTB, $foreal, $i_false, $fiVal, $seVal, $thVal, $foVal, 
			$fifVal, $sixVal, $schoolExt,$fobrainNurAbr; 

			$levelArray = studentLevelsArray($conn); 
			$curSess = currentSessionInfo($conn);
			
			list ($curSessID, $cSess) = explode ("@$@", $curSess);
			list ($sessionPass, $levelPass) = explode ("#@@#", $passData);
			
			$fi_l = $curSessID; 				$fi_level = $levelArray[$i_false]['level'];
			$se_l = ($curSessID - $fiVal);		$se_level = $levelArray[$fiVal]['level'];
			$th_l = ($curSessID - $seVal);		$th_level = $levelArray[$seVal]['level'];
			$fo_l = ($curSessID - $thVal);		$fo_level = $levelArray[$thVal]['level'];
			$fif_l = ($curSessID - $foVal);		$fif_level = $levelArray[$foVal]['level'];
			$six_l = ($curSessID - $fifVal);	$six_level = $levelArray[$fifVal]['level'];  

			$ebele_mark = "SELECT DISTINCT s.year, id_sess, current, f.session	

							FROM $schoolSessionTB s INNER JOIN $classFormTeachersTB f
							
							ON s.id_sess = f.session
							
							AND f.t_id = :t_id
								
							ORDER BY year";
					
			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue(':t_id', $tID);
			$igweze_prep->execute();
			
			$rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count >= $foreal) {
			
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
						
					$sessID = $row['id_sess'];
					$yr = $row['year'];
					$yr1 = $row['year'] + $foreal;
					$current = $row['current'];
					$ses_yr = "$yr - $yr1";
					
					if($current == $foreal){
						
						//$selectSess = 'selected';
						$currentS = ' - Current';
						
					}else{
						
						//$selectSess = '';
						$currentS = '';
						
					} 

					$verbAf = ' Class Now ';

					if($schoolExt == $fobrainNurAbr){

						if($sessID  == $fi_l){
						
							$classLevel = ' - for student in '.$fi_level.$verbAf;
							$classML = $fi_level; $classMLV = $fiVal;
							
						}elseif($sessID  == $se_l){
						
							$classLevel = ' - for student in '.$se_level.$verbAf;
							$classML = $se_level; $classMLV = $seVal;	 		
							
						
						}elseif($sessID  == $th_l){
						
							$classLevel = ' - for student in '.$th_level.$verbAf;
							$classML = $th_level; $classMLV = $thVal;
							
						}else{
						
							$classLevel  = ''; $classML = ''; $classMLV = '';
						}
						
						if($mType == $seVal){

							$slData = trim($yr.'#@@#'.$classML);	
							if($passData == $slData){
									
								$selectSess = 'selected';
								
							}else{

								$selectSess = '';
							} 
							
							$classInfo = $yr.'::-::'.$classMLV;
				
							echo "<option value=\"$classInfo\" $selectSess>$classML</option>"."\r\n";
							
							$classInfo = '';
					
						}

					}else{

						if($sessID  == $fi_l){
						
							$classLevel = ' - for student in '.$fi_level.$verbAf;
							$classML = $fi_level; $classMLV = $fiVal;
							
						}elseif($sessID  == $se_l){
						
							$classLevel = ' - for student in '.$se_level.$verbAf;
							$classML = $se_level; $classMLV = $seVal;									
						
						}elseif($sessID  == $th_l){
						
							$classLevel = ' - for student in '.$th_level.$verbAf;
							$classML = $th_level; $classMLV = $thVal;
							
						}elseif($sessID  == $fo_l){
						
							$classLevel = ' - for student in '.$fo_level.$verbAf;
							$classML = $fo_level; $classMLV = $foVal;
							
						}elseif($sessID  == $fif_l){
						
							$classLevel = ' - for student in '.$fif_level.$verbAf;
							$classML = $fif_level; $classMLV = $fifVal;
							
						}elseif($sessID  == $six_l){
						
							$classLevel = ' - for student in '.$six_level.$verbAf;
							$classML = $six_level; $classMLV = $sixVal;
							
						}else{
						
							$classLevel  = ''; $classML = ''; $classMLV = '';
						}
						
						if($mType == $seVal){

							$slData = trim($yr.'#@@#'.$classMLV);	
							if($passData == $slData){
									
								$selectSess = 'selected';
								
							}else{

								$selectSess = '';
							} 
							
							$classInfo = $yr.'::-::'.$classMLV;
				
							echo "<option value=\"$classInfo\" $selectSess>$classML</option>"."\r\n";
							
							$classInfo = '';
					
						}

					} 
                  

                    $slData = trim($yr.'#@@#'.$classMLV);	
                    if($passData == $slData){
                            
                        $selectSess = 'selected';
                        
                    }else{

                        $selectSess = '';
                    } 

					if($mType == $fiVal){ 

						if($sessionPass == $yr){
								
							$selectSess = 'selected';
							
						}else{

							$selectSess = '';
						} 
					
						echo "<option value=\"$yr\" $selectSess>$ses_yr Session $sessionPass $passData $classLevel $currentS </option>"."\r\n";
						
					}	

				}	
			
			}else{
			
				echo "<option value='0'>Ooops, you have no class assign to you</option>"."\r\n";
			
			}

		}

		function currentSession($conn) {  /* current school session  */

			global $schoolSessionTB, $foreal;

			$ebele_mark = "SELECT DISTINCT id_sess, year, current

							FROM $schoolSessionTB
								
								ORDER BY year";
					
			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->execute();
			
			$rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count >= $foreal) {
			
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
						
					$sessID = $row['id_sess'];
					$yr = $row['year'];
					$yr1 = $row['year'] + $foreal;
					$current = $row['current'];
					$ses_yr = "$yr - $yr1";
					
					if($current == $foreal){
						
						$selectSess = 'selected';
						$currentS = 'Current';
						
					}else{
						
						$selectSess = '';
						$currentS = '';
						
					}

					echo "<option value=\"$sessID\" $selectSess>$ses_yr $currentS Session</option>"."\r\n";

				}	
			
			}else{
			
				echo "<option value='0'>Ooops, no Session was found</option>"."\r\n";
			
			} 

		}

		function currentSessionInfo($conn) {  /* current school session information  */

			global $schoolSessionTB, $foreal;

			$ebele_mark = "SELECT id_sess, year

							FROM $schoolSessionTB
								
								WHERE current = :current";
					
			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue(':current', $foreal);
			$igweze_prep->execute();
			
			$rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count == $foreal) {
			
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
						
					$sessID = $row['id_sess'];
					$cSess = $row['year'];
				
				}	
				
				$curSess = $sessID.'@$@'.$cSess;
				
			}else{
				
				$curSess = '';
				
			}
					
			return $curSess;

		}

		function currentSessionTerm($conn) {  /* current school term  */

			global $schoolSessionTB, $foreal;

			$ebele_mark = "SELECT cur_term

							FROM $schoolSessionTB
							
							WHERE current = :current";
					
			$igweze_prep = $conn->prepare($ebele_mark);

			$igweze_prep->bindValue(':current', $foreal);
				
			$igweze_prep->execute();
			
			$rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count == $foreal) {
			
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
						
					$curTerm = $row['cur_term'];

				}	
			
			}else{
			
				$curTerm = '';
			
			}
			
			return $curTerm;

		}

		function schoolSessionArrays($conn) {  /* school session array  */

			global $schoolSessionTB, $foreal;

			$sessionArray = $conn->query("SELECT id_sess, year, fi_term, se_term, th_term, current, cur_term

									FROM  $schoolSessionTB
									
									ORDER BY id_sess DESC")->fetchAll(PDO::FETCH_ASSOC);
			
			array_unshift($sessionArray,"");
			unset($sessionArray[0]);

			return  $sessionArray;
		}

		function sessionInfo($conn, $sID) {  /* school session array  */

			global $schoolSessionTB, $foreal;

			$sessionArray = $conn->query("SELECT id_sess, year, fi_term, se_term, th_term, current, cur_term

									FROM  $schoolSessionTB
									
									WHERE id_sess =  $sID")->fetchAll(PDO::FETCH_ASSOC);
			
			array_unshift($sessionArray,"");
			unset($sessionArray[0]);

			return  $sessionArray;

		}

		function rsTimeFrameArrays($conn) {  /* school time frame array  */

			global $schoolSessionTB, $foreal;

			$rsArray = $conn->query("SELECT id_sess, year, rtf_fi, rtf_se, rtf_th, current, cur_term

									FROM  $schoolSessionTB
									
									ORDER BY id_sess DESC")->fetchAll(PDO::FETCH_ASSOC);
			
			array_unshift($rsArray,"");
			unset($rsArray[0]);

			return  $rsArray;
		}


		function sesssionCurent($conn) {  /* retrieve school current session */

			global $schoolSessionTB, $foreal;

			$ebele_mark = "SELECT year

							FROM $schoolSessionTB 

								WHERE current = :used";
					
			$igweze_prep = $conn->prepare($ebele_mark);

			$igweze_prep->bindValue(':used', $foreal, PDO::PARAM_STR);
				
			$igweze_prep->execute();
			
			$rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count == $foreal) {
			
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
						
					$yr = $row['year'];
					$yr1 = $row['year'] + $foreal;
					$session = "$yr - $yr1";

				}	
			
			}else{
			
				$session ='';
			
			} 

			return $session; 

		} 

		function activeStaffs($conn) {  /* school active staff count */

			global $staffTB, $foreal;

			$ebele_mark = "SELECT t_id
			
							FROM $staffTB
								
								WHERE status = :status";
					
			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue(':status', $foreal);
			$igweze_prep->execute();
			
			$totalStaffts = $igweze_prep->rowCount(); 
			return $totalStaffts;

		}

		function studentsPerStandard($conn, $sessionID) {  /* school active student pupolation count */

			global $i_reg_tb, $foreal;

			$ebele_mark = "SELECT ireg_id

							FROM $i_reg_tb
								
								WHERE session_id = :session_id
								
								AND active = :active";
					
			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue(':session_id', $sessionID, PDO::PARAM_INT);
			$igweze_prep->bindValue(':active', $foreal);
			$igweze_prep->execute();
			
			$totalStudents = $igweze_prep->rowCount(); 

			return $totalStudents;

		}

		function studentsSexPerStandard($conn, $sessionID, $sexType) {  /* school active gender pupolation count */

			global $i_reg_tb, $i_student_tb, $foreal;

			$ebele_mark = "SELECT r.ireg_id, s.stu_id

							FROM $i_reg_tb r INNER JOIN $i_student_tb s
								
								ON (r.ireg_id = s.ireg_id)
								
								AND r.session_id = :session_id
								
								AND r.active = :active
								
								AND s.i_gender = :i_gender";
					
			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue(':session_id', $sessionID);
			$igweze_prep->bindValue(':active', $foreal);
			$igweze_prep->bindValue(':i_gender', $sexType);
			$igweze_prep->execute();
			
			$totalStudents = $igweze_prep->rowCount(); 
			
			return $totalStudents;

		} 

		function formTeacher($conn, $sessionID, $level, $class) {  /* retrieve assign class teacher information */ 

			global $classFormTeachersTB, $foreal, $title_list; $class_all = "all"; $formTeacher = "";

			$ebele_mark = "SELECT form_id, t_id 

							FROM  $classFormTeachersTB 
							
							WHERE  session = :session
							
							AND level = :level
							
							AND (class = :class
							
							OR class = :class_all)";
					
			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue(':session', $sessionID);
			$igweze_prep->bindValue(':level', $level);
			$igweze_prep->bindValue(':class', $class);
			$igweze_prep->bindValue(':class_all', $class_all);
			$igweze_prep->execute();
			
			$rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count >= $foreal) {
			
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {	
				
					$t_id = $row['t_id'];
				
					$ftData = staffData($conn, $t_id);
					list ($ft_title, $ft_fullname, $ft_sex, $ft_rankingVal, $ft_picture, $ft_lname, $ft_phone, $ft_sign) = explode ("#@s@#", $ftData);
			
					if($ft_title != "") {$fttitleVal = $title_list[$ft_title];}
					else{$fttitleVal = ""; }
					$formTeacher .= $fttitleVal.' '.$ft_fullname.' / ';


				}
				
					$formTeacher = trim($formTeacher, ' / '); 
			
			}else{
				
				$formTeacher = ' - ';
			
			} 
						
			return $formTeacher;

		}

		function formTeacherSignatures($conn, $sessionID, $level, $class) { /* retrieve assign class teacher signature */ 

			global $classFormTeachersTB, $staff_doc_ext, $foreal, $title_list; $class_all = "all"; $formTeacherSign = "";

			$ebele_mark = "SELECT form_id, t_id 

							FROM  $classFormTeachersTB 
							
							WHERE  session = :session
							
							AND level = :level
							
							AND (class = :class
							
							OR class = :class_all)";
					
			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue(':session', $sessionID);
			$igweze_prep->bindValue(':level', $level);
			$igweze_prep->bindValue(':class', $class);
			$igweze_prep->bindValue(':class_all', $class_all);
			$igweze_prep->execute();
			
			$rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count >= $foreal) {
			
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {	
				
					$t_id = $row['t_id'];
				
					$ftData = staffData($conn, $t_id);
					list ($ft_title, $ft_fullname, $ft_sex, $ft_rankingVal, $ft_picture, $ft_lname, $ft_phone, $ft_sign) = explode ("#@s@#", $ftData);

					$ftSign = picture($staff_doc_ext, $ft_sign, "sign");

					$ftSignature = '<div class="col-6"><img src="'.$ftSign.'" style="height: 60px; width:100px; margin-right:5px;"></div>';
					$formTeacherSign .= $ftSignature; 

				}
				
				//$formTeacherSign = trim($formTeacherSign, ' / ');
				 
			
			}else{
				
				$formTeacherSign = ' - ';
			
			} 
						
			return $formTeacherSign;

		}
		
		

		function formTeacherLevel($conn, $tID, $sessionID) {  /* assign class teacher session array */ 

			global $classFormTeachersTB, $foreal;

			$levelArray = $conn->query("SELECT DISTINCT level	

								FROM  $classFormTeachersTB 
								
								WHERE  t_id = $tID
								
								AND session = $sessionID")->fetchAll(PDO::FETCH_ASSOC);

			array_unshift($levelArray,"");
			unset($levelArray[0]);
						
			return $levelArray;

		}

		function formTeacherClass($conn, $tID, $sessionID, $level) {  /* assign class teacher class array */ 

			global $classFormTeachersTB, $foreal;

			$ebele_mark = "SELECT DISTINCT class	

							FROM  $classFormTeachersTB 
							
							WHERE t_id = :t_id
							
							AND session = :session
							
							AND level = :level";
					
			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue(':t_id', $tID);
			$igweze_prep->bindValue(':session', $sessionID);
			$igweze_prep->bindValue(':level', $level);
			$igweze_prep->execute();
			
			$rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count >= $foreal) {
			
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {	
				
					$classArray[] = $row['class'];
				}
				
				array_unshift($classArray,"");
				unset($classArray[0]);
				$classArray = array_unique($classArray);
			
			}else{
				
				$classArray = '';
			
			} 
						
			return $classArray;

		}

		function formTeachersArrays($conn, $tID) {  /* assign class teacher array */ 

			global $classFormTeachersTB, $foreal;

			$formTeacherArray = $conn->query("SELECT form_id, session, level, class

									FROM  $classFormTeachersTB
									
									WHERE t_id = $tID
									
									ORDER BY session, level")->fetchAll(PDO::FETCH_ASSOC);
									
			array_unshift($formTeacherArray,"");
			unset($formTeacherArray[0]);

			return  $formTeacherArray;
			
		}

		function teacherRemarksArrays($conn) {  /* teacher remarks array */ 

			global $tRemarksTB, $foreal;

			$remarkArray = $conn->query("SELECT id_rem AS id, remarks As name

									FROM  $tRemarksTB")->fetchAll(PDO::FETCH_ASSOC);
									
			array_unshift($remarkArray,"");
			unset($remarkArray[0]);

			return  $remarkArray;
			
		}		 

		function staffPicture($conn, $tID) {  /* school staffs/teachers picture */ 

			global $staffTB, $wiz_default_img, $staff_pic_ext, $foreal; 

			$ebele_mark = "SELECT i_picture
			
							FROM $staffTB
							
							WHERE t_id = :t_id";
					
			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue(':t_id', $tID);
			$igweze_prep->execute();
			
			$rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count == $foreal) {
			
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
				
					$pic = $row['i_picture'];
				
				} 

			} 
			 
			$staff_img = picture($staff_pic_ext, $pic, "staff");

			return $staff_img;

		} 

		function picture($picture_ext, $picture, $user){
			
			global $wiz_default_img, $wiz_df_staff_img, $wiz_df_sign_img, $wiz_df_cart_img, 
			$wiz_df_word_img, $wiz_df_file_img, $wiz_df_pdf_img, $wiz_df_xls_img, $wiz_df_exam_img,
			$wiz_default_img_i;

			if($user == "student"){

				$default = $wiz_default_img;

			}elseif($user == "staff"){

				$default = $wiz_df_staff_img;

			}elseif($user == "sign"){

				$default = $wiz_df_sign_img;

			}elseif($user == "shop"){

				$default = $wiz_df_cart_img;
				
			}elseif($user == "doc"){

				$default = $wiz_df_file_img;
				
			}elseif($user == "exam"){

				$default = $wiz_df_exam_img;
				
			}elseif($user == "logo-in"){

				$default = $wiz_default_img_i;
				
			}elseif($user == "logo"){

				$default = $wiz_default_img;
				
			}else{

				$default = $wiz_default_img;

			}	

			$wiz_picture = $picture_ext.$picture;
		
			if ((is_null($picture)) || ($picture == '') || (!file_exists($wiz_picture))){ $wiz_picture = $default; }	

			return $wiz_picture;

		}

		function removePicture($picture_ext, $picture) {  /* remove picture */  
				
			$wiz_picture = $picture_ext.$picture;

			if ((!is_null($picture)) && ($picture != '') && (file_exists($wiz_picture))){ unlink($wiz_picture); } 

		}

		function wizSelectArray($val, $arr_list){ 

			$val = trim($val);
			
			if($val != ""){ $wiz_select = $arr_list[$val]; }
			else{ $wiz_select = ""; }

			return $wiz_select;

		}

		function removeTeacherPicSign($conn, $tID, $typeID) {  /* remove school staffs/teachers picture/signature */ 

			global $staffTB, $wiz_default_img, $staff_pic_ext, $staff_doc_ext, $foreal, $fiVal, $seVal; 

			$ebele_mark = "SELECT i_picture, i_sign
			
							FROM $staffTB
							
							WHERE t_id = :t_id";
					
			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue(':t_id', $tID);
			$igweze_prep->execute();
			
			$rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count == $foreal) {
			
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
				
					$pic = $row['i_picture'];
					$sign = $row['i_sign'];

					if($typeID == $fiVal){ 
					 
						removePicture($staff_pic_ext, $pic);
					
					}	

					if($typeID == $seVal){

						removePicture($staff_doc_ext, $sign);
					
					}

				} 

			} 

		}  

		function staffSalary($conn, $tID) {  /* school staffs/teachers picture */ 

			global $staffTB,   $foreal; 

			$ebele_mark = "SELECT salary
			
							FROM $staffTB
							
							WHERE t_id = :t_id";
					
			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue(':t_id', $tID);
			$igweze_prep->execute();
			
			$rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count == $foreal) {
			
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
				
					$salary = $row['salary'];
				
				} 

			}else{ $salary = 0; }  

			return $salary;

		} 

		function staffData($conn, $tID) {  /* school staffs/teachers information */ 

			global $staffTB, $foreal; 

			$ebele_mark = "SELECT t_id, i_title, i_picture, i_sign, i_firstname, i_lastname, i_midname, i_gender, t_grade, i_phone, i_email 

								FROM $staffTB

								WHERE t_id = :t_id";
								
			$igweze_prep = $conn->prepare($ebele_mark);			
			$igweze_prep->bindValue(':t_id', $tID);				 
			$igweze_prep->execute();
			
			$rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count == $foreal) {
			
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		

					$teacherID = $row['t_id'];
					$title = $row['i_title'];
					$picture = $row['i_picture'];
					$sign = $row['i_sign'];
					$fname = $row['i_firstname'];
					$lname = $row['i_lastname'];
					$mname = $row['i_midname'];
					$sex = $row['i_gender'];
					$staff_grade_v = $row['t_grade'];
					$phone = $row['i_phone'];
					$i_mail = $row['i_email'];
				
				} 

				if($title == ""){$title = 0;} 

				if($mname != ""){
					$mname = substr($mname, 0, 1). ".";
				}
				if($sex == ""){$sex = 0;}

				$teacherName = $lname.' '.$mname.' '.$fname;
				
				$teacherData = $title.'#@s@#'.$teacherName.'#@s@#'.$sex.'#@s@#'.$staff_grade_v.'#@s@#'.$picture.
				'#@s@#'.$lname.'#@s@#'.$phone.'#@s@#'.$sign.'#@s@#'.$i_mail; 

			}else{ 
				
				$teacherData = '';
				
			}
			
			return $teacherData; 

		}

		function staffName($conn, $tID) {  /* school staffs/teachers name */ 

			global $staffTB, $title_list, $foreal; 

			$ebele_mark = "SELECT t_id, i_title, i_picture, i_sign, i_firstname, i_lastname, i_midname, i_gender, t_grade, i_phone, i_email 

								FROM $staffTB

								WHERE t_id = :t_id";
								
			$igweze_prep = $conn->prepare($ebele_mark);			
			$igweze_prep->bindValue(':t_id', $tID);				 
			$igweze_prep->execute();
			
			$rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count == $foreal) {
			
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		

					$teacherID = $row['t_id'];
					$title = $row['i_title'];
					$picture = $row['i_picture'];
					$sign = $row['i_sign'];
					$fname = $row['i_firstname'];
					$lname = $row['i_lastname'];
					$mname = $row['i_midname'];
					$sex = $row['i_gender'];
					$staff_grade_v = $row['t_grade'];
					$phone = $row['i_phone'];
					$i_mail = $row['i_email'];
				
				}  

				if($mname != ""){
					$mname = substr($mname, 0, 1). ".";
				} 

                $titleVal = wizSelectArray($title, $title_list);

				$staff = "$titleVal $lname $mname $fname"; 
				 

			}else{ 
				
				$staff = 'Unclassified';
				
			}
			
			return $staff; 

		}

		function staffToken($conn) {  /* school staffs/teachers token information */  

			global $staffTB, $foreal, $i_false, $title_list, $fiVal;				
			
			$ebele_mark = "SELECT t_id, i_title, i_firstname, i_lastname, i_midname
			
							FROM $staffTB
							
							WHERE 	status = :status";
					
			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue(':status', $fiVal);
			$igweze_prep->execute();
			
			$rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count >= $foreal) {

				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {	
					
					$tID = $row['t_id'];
					$title = $row['i_title'];
					$fname = $row['i_firstname'];
					$lname = $row['i_lastname'];
					$mname = $row['i_midname'];		 
					 
					$titleVal = wizSelectArray($title, $title_list);
					$staff = "$titleVal $lname $fname $mname";	
					$staff = trim($staff);
						
					$staffArr .= "{ value: '$tID', label: '$staff' },";
					
				}
				
				$staffArr = trim($staffArr, ', ');
				
			}
			
			return $staffArr;				
			
		} 

		function staffSelectBox($conn, $staff_arr, $staff_id, $option) {  /*  staffs/teachers select options */ 

			global $staff_pic_ext, $wiz_default_img, $title_list;

			if(is_array($staff_arr)){

				$staffCount = count($staff_arr); 	 

				if($option == true){
					$user = implode(', ', $staff_id);
					list ($item_1, $item_2, $item_3) = explode (",", $user);
				}
							
				for($i = 1; $i <= $staffCount; $i++){  /* loop array */
					
					$sID = $staff_arr[$i]["t_id"];
					$title = $staff_arr[$i]["i_title"];
					$lname = $staff_arr[$i]["i_lastname"];
					$fname = $staff_arr[$i]["i_firstname"];
					$mname = $staff_arr[$i]["i_midname"];
					$pic = $staff_arr[$i]["i_picture"];

					$titleVal = wizSelectArray($title, $title_list);
					$staff_name = "$titleVal $lname $fname $mname";	  
					 
					$staff_img = picture($staff_pic_ext, $pic, "staff");

					if($option == true){

						if(trim($item_1) == $sID){

							$selected = "SELECTED";

						}elseif(trim($item_2) == $sID){

							$selected = "SELECTED";

						}elseif(trim($item_3) == $sID){

							$selected = "SELECTED";

						}else{

							$selected = "";

						}
					}else{

						if ($sID == $staff_id){

							$selected = "SELECTED";

						}else{

							$selected = "";
							
						} 

					}	


					$options .= '<option value="'.$sID.'"'.$selected.' data-src="'.$staff_img.'"> '.$staff_name.'</option>' ."\r\n"; 
				
				} 

			}else{

				$options = '<option value=""  data-src="'.$wiz_default_img.'"> No staff record found</option>' ."\r\n";

			} 

			return $options;

		}
		 

		function staffUserExits($conn, $userName) {  /* check if school staffs/teachers exits */ 

			global $staffTB, $foreal;

			$userName = trim($userName);
			
			$ebele_mark = "SELECT t_id
			
							FROM $staffTB
							
							WHERE i_email = :i_email";
					
			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue(':i_email', $userName);
			$igweze_prep->execute();
			
			$rows_count = $igweze_prep->rowCount(); 
			
			return $rows_count;
			
		}		

		function staffLoginData($conn, $staffID) {  /* school staffs/teachers password details */ 

			global $staffTB, $foreal, $i_false;

			$ebele_mark = "SELECT t_id, staff_id, i_firstname, i_lastname, i_midname, i_lga,
								i_sponsor_ac, i_accesspass, t_grade, i_pass, i_email

								FROM $staffTB

								WHERE i_email = :i_email";


			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue(':i_email',  $staffID);
			$igweze_prep->execute();
			
			$rows_count = $igweze_prep->rowCount();

			if($rows_count == $foreal) {

				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {

					$t_id = $row['t_id'];
					$staffID = $row['staff_id'];
					$fname = $row['i_firstname'];
					$lname = $row['i_lastname'];
					$mname = $row['i_midname'];
					$ranking = $row['i_lga'];
					$access = $row['i_accesspass'];
					$password = $row['i_sponsor_ac'];
					$t_grade = $row['t_grade'];
					$i_pass = $row['i_pass'];
					$i_email = $row['i_email'];

				} 
				 
				$staffPass = "none"; 
				$staffName = $lname;

				$staffData = $t_id.'@(.$*S*$.)@'.$staffID.'@(.$*S*$.)@'.$staffPass.'@(.$*S*$.)@'.
				$staffName.'@(.$*S*$.)@'.$ranking.'@(.$*S*$.)@'.$t_grade.'@(.$*S*$.)@'.$access;

			}else{

				$staffData = $i_false; 

			}

			return $staffData;

		}		


		function courseTeacher($conn, $staff_arr) {  /*  course teachers */

			global $title_list; $course_teacher  = "";

            if(is_array($staff_arr)){  /* check if array */  

                $staffs = implode(', ', $staff_arr);

				$count = substr_count($staffs, ',');

				if($count == 2){

					list ($fiTeacher, $seTeacher, $thTeacher) = explode (",", $staffs); 

				}elseif($count == 1){

					list ($fiTeacher, $seTeacher) = explode (",", $staffs); 	
					$thTeacher = "";

				}else{

					$fiTeacher = $staffs;
					$seTeacher = ""; $thTeacher = "";

				} 
				
                
                if($fiTeacher != ''){
                    
                    $ficlassTeacher = staffData($conn, $fiTeacher);  /* school staffs/teachers information */ 
                    list ($fi_title, $fi_fullname, $fi_sex, $fi_rankingVal, $fi_picture, 
                        $fi_lname) = explode ("#@s@#", $ficlassTeacher);

                    if($fi_title != "") {$fi_titleV = $title_list[$fi_title];}else{$fi_titleV = "";}

                    $fi_sub_teacher = $fi_titleV.' '.$fi_fullname;
                    
                    if($ficlassTeacher != ''){
                        
                        $course_teacher .=  $fi_sub_teacher;	
                    
                    }
                }


                if($seTeacher != ''){
                    
                    $seclassTeacher = staffData($conn, $seTeacher);  /* school staffs/teachers information */ 
                    list ($se_title, $se_fullname, $se_sex, $se_rankingVal, $se_picture, 
                        $se_lname) = explode ("#@s@#", $seclassTeacher);
                
                    if($se_title != "") {$se_titleV = $title_list[$se_title];}else{$se_titleV = "";}
                    $se_sub_teacher = $se_titleV.' '.$se_fullname;
                    
                    if($seclassTeacher != ''){
                        
                        $course_teacher .=  ' <hr class="text-danger my-5 py-0"> '.$se_sub_teacher;	
                    
                    }
                }


                if($thTeacher != ''){
                    
                    $thclassTeacher = staffData($conn, $thTeacher);  /* school staffs/teachers information */ 
                    list ($th_title, $th_fullname, $th_sex, $th_rankingVal, $th_picture, 
                        $th_lname) = explode ("#@s@#", $thclassTeacher);

                    if($th_title != "") {$th_titleV = $title_list[$th_title];}else{$th_titleV = "";}
                    $th_sub_teacher = $th_titleV.' '.$th_fullname;
                    
                    if($thclassTeacher != ''){
                        
                        $course_teacher .=  ' <hr class="text-danger my-5 py-0"> '.$th_sub_teacher;
                    
                    }
                }

            }else{

                $course_teacher = '';

            } 

            return $course_teacher;

        }    

		function staffArrays($conn) {  /* school staffs/teachers array */ 

			global $staffTB, $foreal, $fiVal, $i_false;

			$teachersArray = $conn->query("SELECT t_id, i_title, i_picture, i_firstname, i_lastname, 
											i_midname, i_lga

									FROM  $staffTB
									
									WHERE status != $i_false")->fetchAll(PDO::FETCH_ASSOC);
									
			array_unshift($teachersArray,"");
			unset($teachersArray[0]);

			return  $teachersArray;
		}

		function staffArrays2($conn) {  /* school staffs/teachers array */ 

			global $staffTB, $foreal, $fiVal, $i_false; 

			$ebele_mark = "SELECT t_id, i_title, i_picture, i_firstname, i_lastname, 
											i_midname, i_lga
					
							FROM $staffTB
							
							WHERE  
							
							t_grade != :t_grade

							AND
								
							status != :status ";

			$igweze_prep = $conn->prepare($ebele_mark); 
			$igweze_prep->bindValue(':t_grade',  $fiVal, PDO::PARAM_STR);
			$igweze_prep->bindValue(':status', $i_false, PDO::PARAM_STR);
			$igweze_prep->execute();

			$rows_count = $igweze_prep->rowCount();

			if($rows_count >= $foreal) {

				while($staffArray[] = $igweze_prep->fetch(PDO::FETCH_ASSOC)) { }
				
				array_unshift($staffArray,"");
				unset($staffArray[0]);
			
			}

			return $staffArray;

		}
		
		function leaveArrays($conn) {  /* staff leave array */ 

			global $staffLeaveCatTB, $foreal, $fiVal, $i_false;

			$leaveArrays = $conn->query("SELECT lid, leave_c, status

									FROM  $staffLeaveCatTB
									
									WHERE status != $i_false")->fetchAll(PDO::FETCH_ASSOC);
									
			array_unshift($leaveArrays,"");
			unset($leaveArrays[0]);

			return  $leaveArrays;
		}

		function staffLeaveArrays($conn) {  /* staff leave array */ 

			global $staffLeaveTB, $foreal, $fiVal, $i_false;

			$leaveArrays = $conn->query("SELECT l_id, staff, l_type, l_apply, l_days, l_date, status

									FROM  $staffLeaveTB
									
									ORDER BY l_id DESC")->fetchAll(PDO::FETCH_ASSOC);
									
			array_unshift($leaveArrays,"");
			unset($leaveArrays[0]);

			return  $leaveArrays;
		}

		function staffLeaveInfo($conn, $l_id) {  /* staff leave array */ 

			global $staffLeaveTB, $foreal, $fiVal, $i_false;

			$l_id = clean($l_id);

			$leaveArrays = $conn->query("SELECT l_id, staff, l_type, l_apply, l_days, l_date, status

									FROM  $staffLeaveTB
									
									WHERE l_id = $l_id")->fetchAll(PDO::FETCH_ASSOC);
									
			array_unshift($leaveArrays,"");
			unset($leaveArrays[0]);

			return  $leaveArrays;
		}

		function staffRankingArrays($conn) {  /* school staffs/teachers ranking array */ 

			global $staffRankingTB, $foreal;

			$staffRankingArray = $conn->query("SELECT rank_id AS id, ranking As name

									FROM  $staffRankingTB")->fetchAll(PDO::FETCH_ASSOC);
									
			array_unshift($staffRankingArray,"");
			unset($staffRankingArray[0]);

			return  $staffRankingArray;
			
		}  

		function recoveryStaffInfo($conn, $email, $resetID) {  /* school admin recovery password information  */

			global $staffTB, $foreal, $i_false;

			$ebele_mark = "SELECT i_email, recov_info, recov_time

								FROM $staffTB

								WHERE recov_info = :recov_info
								
								AND i_email = :i_email"; 

			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue(':recov_info', $resetID);
			$igweze_prep->bindValue(':i_email', $email);
			$igweze_prep->execute();
			$rows_count = $igweze_prep->rowCount();

			if($rows_count == $foreal) {

				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {

					$rInfo = $row['recov_info'];
					$rTime = $row['recov_time'];
					$email = $row['i_email'];

				} 

				$rData = $rInfo.'@(.$.)@'.$rTime.'@(.$.)@'.$email; 

			}else{ 

				$rData = ""; 

			} 

			return $rData; 

		}


		function migrateStaffs($conn) {  /* migrate staffs */   exit;
			exit;
			global $staffTB, $foreal, $i_false, $options_bcrypt;
		
			$ebele_mark = "SELECT t_id, staff_id, i_accesspass, t_grade, i_pass
		
								FROM $staffTB"; 
			$igweze_prep = $conn->prepare($ebele_mark); 
			$igweze_prep->execute();
			
			$rows_count = $igweze_prep->rowCount();


			if($rows_count >= $foreal) {

				$password = "password";
		
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {
		
					$t_id = $row['t_id'];
					$staffID = $row['staff_id']; 
					$t_grade = $row['t_grade'];
					//$i_pass = $row['i_accesspass']; 

					$new_pass = password_hash($password, PASSWORD_BCRYPT, $options_bcrypt);
		
					if($t_grade == 1){
						$grade = 6;
					}elseif($t_grade == 2){
						$grade = 5;
					}elseif($t_grade == 3){
						$grade = 2;
					}elseif($t_grade == 4){
						$grade = 4;
					}elseif($t_grade == 5){
						$grade = 3;
					}elseif($t_grade == 6){
						$grade = 6;
					}else{
						$grade = 6;
					}
					echo  "ID = $t_id, $t_grade to $grade | $new_pass <br />";
					$ebele_mark_1 = "UPDATE $staffTB SET
										 
									t_grade = :t_grade,
									i_accesspass = :i_accesspass
									
									WHERE t_id = :t_id";
									
					$igweze_prep_1 = $conn->prepare($ebele_mark_1);	
					$igweze_prep_1->bindValue(':t_grade', $grade);
					$igweze_prep_1->bindValue(':i_accesspass', $new_pass);
					$igweze_prep_1->bindValue(':t_id', $t_id);
					$igweze_prep_1->execute();
		
				} 
				 
		
			} 
			
		
		}	

		function recentAcademicYear($level, $year1) {  /* school session academic year  */ 

			if ($level == 1){

				$second_yr = $year1 + 1;
				$first_yr = $second_yr - 1;

				$recent_a_yr = "$first_yr"." - "."$second_yr";

			}elseif ($level == 2){

				$second_yr = $year1 + 2;
				$first_yr = $second_yr - 1;

				$recent_a_yr = "$first_yr"." - "."$second_yr";

			}elseif ($level == 3){

				$second_yr = $year1 + 3;
				$first_yr = $second_yr - 1;

				$recent_a_yr = "$first_yr"." - "."$second_yr";

			}elseif ($level == 4){

				$second_yr = $year1 + 4;
				$first_yr = $second_yr - 1;

				$recent_a_yr = "$first_yr"." - "."$second_yr";

			}elseif ($level == 5){

				$second_yr = $year1 + 5;
				$first_yr = $second_yr - 1;

				$recent_a_yr = "$first_yr"." - "."$second_yr";

			}elseif ($level == 6){

				$second_yr = $year1 + 6;
				$first_yr = $second_yr - 1;

				$recent_a_yr = "$first_yr"." - "."$second_yr";

			}elseif ($level == 700){

				$second_yr = $year1 + 7;
				$first_yr = $second_yr - 1;

				$recent_a_yr = "$first_yr"." - "."$second_yr";

			}else{

				$recent_a_yr = "*";

			}

			return $recent_a_yr;
		} 

		function studentExits($conn, $stu_reg) {  /* check if a student really exist */ 

			global $i_reg_tb, $foreal, $i_false, $errorMsg, $erroMsg, $msgEnd, $eEnd;

			$ebele_mark = "SELECT ireg_id

					FROM $i_reg_tb  

					WHERE nk_regno = :nk_regno";
					
			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue(':nk_regno', $stu_reg);				 
			$igweze_prep->execute();
			
			$rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count > $foreal) {

				$msg_e = "Critical Error, Student With Reg no. ($stu_reg) occurs more than once in datababse. Please delete the duplicate. Thanks";
				echo $errorMsg.$msg_e.$eEnd;  echo "<script type='text/javascript'> hidePageLoader(); </script>";exit; 

			}elseif($rows_count == $i_false){
			
				$msg_e = "Ooops, Student With Reg no. ($stu_reg) dose not exist and is not a valid student.  Thanks";
				echo $errorMsg.$msg_e.$eEnd;  echo "<script type='text/javascript'> hidePageLoader(); </script>"; exit;
			}

		} 

		function studentExitsRV($conn, $stu_reg) {  /* check if a student really exist */

			global $i_reg_tb, $foreal, $i_false;

			$ebele_mark = "SELECT ireg_id

						FROM $i_reg_tb  

						WHERE nk_regno = :nk_regno";
					
			$igweze_prep = $conn->prepare($ebele_mark);

			$igweze_prep->bindValue(':nk_regno', $stu_reg);
				
			$igweze_prep->execute();
			
			$rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count == $i_false){

				return $i_false;
					
			}else {

				return $foreal;			
			}

		} 

		function studentRegID($conn, $stu_reg) {   /* student record ID  */

			global $i_reg_tb, $foreal;
						
			$ebele_mark = "SELECT ireg_id

						FROM $i_reg_tb  

						WHERE nk_regno = :nk_regno";
					
			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue(':nk_regno', $stu_reg);				 
			$igweze_prep->execute();
			
			$rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count == $foreal) {
			
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		

					$st_reg_id = $row['ireg_id'];
					
				}	
			
			}else{

				$st_reg_id = "";

			}

			return  $st_reg_id;
		}

		function studentReg($conn, $regID) {  /* student registration number  */

			global $i_reg_tb, $foreal;
						
			$ebele_mark = "SELECT nk_regno

						FROM $i_reg_tb  

						WHERE ireg_id = :ireg_id";
					
			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue(':ireg_id', $regID);				 
			$igweze_prep->execute();
			
			$rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count == $foreal) {
			
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		

					$stuReg = $row['nk_regno'];
					
				}	
				
			
			}else{

				$stuReg = "";

			}

			return  $stuReg;
		}

		function sessionLastReg($conn, $session) {  /* school session last student registration number  */

			global $i_reg_tb, $foreal;
			
			$sessionID = sessionID($conn, $session); 
			
			$ebele_mark = "SELECT nk_regno 

						FROM $i_reg_tb  

						WHERE session_id = :session_id
						
						ORDER BY ireg_id DESC LIMIT 1";
					
			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue(':session_id', $sessionID);				 
			$igweze_prep->execute();
			
			$rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count == $foreal) {
			
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		

					$regNum = $row['nk_regno'];
					
				}	
			
			}else{

					$regNum = "";

			} 

			return  $regNum;
		}

		function sessionLastRegID($conn, $sessionID) {  /* school session last student registration ID  */

			global $i_reg_tb, $foreal;
			
			$ebele_mark = "SELECT nk_regno 

						FROM $i_reg_tb  

						WHERE session_id = :session_id
						
						ORDER BY ireg_id DESC LIMIT 1";
					
			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue(':session_id', $sessionID);				 
			$igweze_prep->execute();
			
			$rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count == $foreal) {
			
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		

					$regNum = $row['nk_regno'];
					
				}	
			
			}else{

				$regNum = "";

			}

			return  $regNum;
		}  

		function fobrainSchool($conn) {  /* school configuration setup array  */

			global $fobrainSchoolTB, $foreal;

			$schoolArray = $conn->query("SELECT school_id, school_name, school_address, reg_prefix, school_cutoff,
								school_head, bursary, libraian, school_theme, school_logo, school_sub_cutoff, translator, 
								screen_timer, ewallet, tzone

			FROM  $fobrainSchoolTB")->fetchAll(PDO::FETCH_ASSOC);

			return  $schoolArray;
		} 

		function schoolExamConfigArrays($conn) {  /* school exam configuration array  */

			global $rsExamConfigTB, $foreal;

			$schoolArray = $conn->query("SELECT ex_id, fi_ass, se_ass, th_ass, fo_ass, fif_ass, six_ass, exam, rsType, status

							FROM  $rsExamConfigTB")->fetchAll(PDO::FETCH_ASSOC);

			return  $schoolArray;
		} 

		function disabilityArrays($conn) {  /* disability array  */

			global $disabilityTB, $foreal;

						$disArray = $conn->query("SELECT id_dis AS id, disability As name
			
												FROM  $disabilityTB")->fetchAll(PDO::FETCH_ASSOC);
			array_unshift($disArray,"");
			unset($disArray[0]);

			return  $disArray;
		} 

		function reDisabilityArrays($disability) {  /* disability array  */

			 list ($disability_1, $disability_2, $disability_3, $disability_4, $disability_5, $disability_6, 
					$disability_7, $disability_8) = explode (",", $disability);

			if (isset($disability_1)) { $dis1 = "$disability_1";  settype($dis1, "integer");  
				$DisArray = array($dis1);
			}
			if (isset($disability_2)) { $dis2 = "$disability_2";  settype($dis2, "integer"); $DisArray = ""; 
			$DisArray = array($dis1, $dis2);}
			if (isset($disability_3)) { $dis3 = "$disability_3";  settype($dis3, "integer"); $DisArray = ""; 
			$DisArray = array($dis1, $dis2, $dis3);}   
			if (isset($disability_4)) { $dis4 = "$disability_4";  settype($dis4, "integer"); $DisArray = ""; 
			$DisArray = array($dis1, $dis2, $dis3, $dis4);}
			if (isset($disability_5)) { $dis5 = "$disability_5";  settype($dis5, "integer"); $DisArray = ""; 
			$DisArray = array($dis1, $dis2, $dis3, $dis4, $dis5);}   
			if (isset($disability_6)) { $dis6 = "$disability_6";  settype($dis6, "integer"); $DisArray = ""; 
			$DisArray = array($dis1, $dis2, $dis3, $dis4, $dis5, $dis6);}
			if (isset($disability_7)) { $dis7 = "$disability_7";  settype($dis7, "integer");
										$DisArray = ""; $DisArray = array($dis1, $dis2, $dis3, $dis4, $dis5, $dis6, $dis7);}   
			if (isset($disability_8)) { $dis8 = "$disability_8";  settype($dis8, "integer"); 
										$DisArray = ""; $DisArray = array($dis1, $dis2, $dis3, $dis4, $dis5, $dis6, $dis7, $dis8);}	

			return  $DisArray;
		}  

		function fobrainAdminData($conn, $admiID) {  /* school admin information  */

			global $adminAccessTB, $foreal, $i_false;

			$ebele_mark = "SELECT admin_id, a_title, a_fname, a_lname, a_mname, a_picture, a_mail

								FROM $adminAccessTB

								WHERE admin_id = :admin_id"; 

			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue('admin_id', $admiID);
			$igweze_prep->execute();
			$rows_count = $igweze_prep->rowCount();

			if($rows_count == $foreal) {

				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {

					$adminID = $row['admin_id'];
					$pic = $row['a_picture'];
					$title = $row['a_title'];
					$fname = $row['a_fname'];
					$lname = $row['a_lname'];
					$mname = $row['a_mname'];
					$email = $row['a_mail'];
				} 

				$adminData = $adminID.'@(.$.)@'.$pic.'@(.$.)@'.$title.'@(.$.)@'.$lname.'@(.$.)@'.$fname.'@(.$.)@'.
				$mname.'@(.$.)@'.$email; 

			}else{ 

				$adminData = $i_false; 

			} 

			return $adminData; 

		}

		function adminLoginData($conn, $adminUser) {  /* school admin password details */

			global $adminAccessTB, $foreal, $i_false;

			$ebele_mark = "SELECT admin_id,  a_fname, a_lname, a_mname, a_delimit, a_pass

								FROM $adminAccessTB

								WHERE a_mail = :a_name"; 

			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue(':a_name', $adminUser);
			$igweze_prep->execute();
			$rows_count = $igweze_prep->rowCount();

			if($rows_count == $foreal) {

				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {

					$adminID = $row['admin_id'];
					$fname = $row['a_fname'];
					$lname = $row['a_lname'];
					$mname = $row['a_mname'];
					$access = $row['a_pass'];
					$password = $row['a_delimit']; 

				}
				
				$adminPass = $access;

				//$adminPass = decrypter($access, $password); Depreac
				$adminName = $lname;

				$adminData = $adminID.'@(.$*S*$.)@'.$adminPass.'@(.$*S*$.)@'.$adminName;

			}else{ 

				$adminData = $i_false; 

			}

			return $adminData; 

		}
		
		function recoveryInfo($conn, $email, $resetID) {  /* school admin recovery password information  */

			global $adminAccessTB, $foreal, $i_false;

			$ebele_mark = "SELECT a_mail, recov_info, recov_time

								FROM $adminAccessTB

								WHERE recov_info = :recov_info
								
								AND a_mail = :a_mail"; 

			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue('recov_info', $resetID);
			$igweze_prep->bindValue('a_mail', $email);
			$igweze_prep->execute();
			$rows_count = $igweze_prep->rowCount();

			if($rows_count == $foreal) {

				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {

					$rInfo = $row['recov_info'];
					$rTime = $row['recov_time'];
					$email = $row['a_mail'];
				} 

				$rData = $rInfo.'@(.$.)@'.$rTime.'@(.$.)@'.$email; 

			}else{ 

				$rData = ""; 

			} 

			return $rData; 

		}

		function removeAdminPicture($conn, $admiID) { /* remove school admin picture */

			global $adminAccessTB, $wiz_default_img, $admin_pic_ext, $foreal; 

			$ebele_mark = "SELECT a_picture
			
							FROM $adminAccessTB
							
							WHERE admin_id = :admin_id";
					
			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue('admin_id', $admiID);
			$igweze_prep->execute();
			
			$rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count == $foreal) {
			
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
				
					$pic = $row['a_picture'];

				} 

				removePicture($admin_pic_ext, $pic);

			} 

		}   

		function studentsClubArrays($conn) {  /* school clubs array */

			global $schoolClubTB, $foreal;

			$clubArray = $conn->query("SELECT club_id AS id, club As name

									FROM  $schoolClubTB")->fetchAll(PDO::FETCH_ASSOC);
									
			array_unshift($clubArray,"");
			unset($clubArray[0]);

			return  $clubArray;
			
		}

		function clubPostArrays($conn) {  /* school clubs position array */

			global $schoolClubPostTB, $foreal;

			$clubArray = $conn->query("SELECT club_id AS id, club_post As name

									FROM  $schoolClubPostTB")->fetchAll(PDO::FETCH_ASSOC); 

			array_unshift($clubArray,"");
			unset($clubArray[0]);

			return  $clubArray;
			
		}

		function sportsArrays($conn) {  /* school sports array */

			global $sportsTB, $foreal;

			$sportArray = $conn->query("SELECT sport_id AS id, sport As name

									FROM  $sportsTB")->fetchAll(PDO::FETCH_ASSOC);
									
			array_unshift($sportArray,"");
			unset($sportArray[0]);

			return  $sportArray;
			
		}

		function sportsToken($conn) {  /* school sports token array */

			global $sportsTB, $foreal, $i_false, $title_list;				
			
			$ebele_mark = "SELECT sport_id, sport 
			
							FROM $sportsTB";
					
			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->execute();
			
			$rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count >= $foreal) {

				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {	
					
					$sID = $row['sport_id'];
					$sport = $row['sport'];
					
					$sport = trim($sport);						
					$sportArr .= "{ value: '$sID', label: '$sport' },";
					
				}
				
				$sportArr = trim($sportArr, ', ');
				
			}
			
			return $sportArr;				
			
		} 

		function fobrainSubjectsArrays($conn) {  /* school subjects array */

			global $subjectsTB, $foreal;

			$subjectsArray = $conn->query("SELECT sub_id, subjects, status

									FROM  $subjectsTB")->fetchAll(PDO::FETCH_ASSOC);
									
			array_unshift($subjectsArray,"");
			unset($subjectsArray[0]);

			return  $subjectsArray;
		}

		function schoolSubject($conn, $subID) {  /* school subjects information */

			global $subjectsTB, $foreal;

			$ebele_mark = "SELECT subjects					

							FROM $subjectsTB

							WHERE sub_id = :sub_id";
					
			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue(':sub_id', $subID);
			$igweze_prep->execute();
			
			$rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count == $foreal) {
			
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		

					$subject = $row['subjects']; 
				
				}
				
			}else{ 
				
				$subject = '';
				
			} 
			
			return $subject; 

		}

		function subjectTeacherArrays($conn, $tID) {  /* school staff subjects array */

			global $teachersAssignSubTB, $foreal;

			$subjectsArray = $conn->query("SELECT t_id, sub_id, session, level, class

									FROM  $teachersAssignSubTB
									
									WHERE t_id = $tID
									
									ORDER BY session, level")->fetchAll(PDO::FETCH_ASSOC);
									
			array_unshift($subjectsArray,"");
			unset($subjectsArray[0]);

			return  $subjectsArray;
		}		

		function checkSubjectToPass($conn, $fobrainConfigTB, $schoolID, $level, $term, $subRCode) {  /* retrieve school compulsory subjects to pass */

			global $foreal;
			
			$ebele_mark = "SELECT sub_mpass

						FROM $fobrainConfigTB 

						WHERE  cf_level = :cf_level
															
						AND cf_term = :cf_term
															
						AND cf_program = :cf_program
						
						AND cf_raw = :cf_raw";
					
			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue(':cf_level', $level);
			$igweze_prep->bindValue(':cf_term', $term);
			$igweze_prep->bindValue(':cf_program', $schoolID);
			$igweze_prep->bindValue(':cf_raw', $subRCode);				 
			$igweze_prep->execute();	
			
			$rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count == $foreal) {
			
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		

					$subMpass = $row['sub_mpass'];
					
				}	
			
			}else{

				$subMpass  = "";

			}

			return  $subMpass;
		}

		function fobrainSchoolCoursesData($conn, $fobrainConfigTB, $schoolID, $level, $term) { /* school subjects array */

			$schoolSubjs = $conn->query("SELECT cf_raw, cf_code, cf_tittle, cf_tot, cf_pos, cf_com, cf_level, cf_term, cf_status, cf_staff

											FROM $fobrainConfigTB
											
											WHERE  cf_level = $level
											
											AND cf_term = $term
											
											AND cf_program = $schoolID")->fetchAll(PDO::FETCH_NUM);
											
			array_unshift($schoolSubjs,"");
			unset($schoolSubjs[0]);

			return  $schoolSubjs;

		}

		function schoolCoursesInfo($conn, $schoolID, $level, $term) {  /* school subjects information */

			global $fobrainConfigTB; 

			$schoolSubjs = $conn->query("SELECT cf_id, cf_raw, cf_code, cf_tittle, cf_staff, cf_tot, cf_pos, cf_com, cf_level, cf_term, cf_status

											FROM $fobrainConfigTB
											
											WHERE  cf_level = $level
											
											AND cf_term = $term
											
											AND cf_program = $schoolID")->fetchAll(PDO::FETCH_ASSOC);
											
			array_unshift($schoolSubjs,"");
			unset($schoolSubjs[0]);

			return  $schoolSubjs;

		}
		
		function schoolCourse($conn, $course_id) {  /* school subjects information */

			global $fobrainConfigTB; 

			$schoolSubjs = $conn->query("SELECT cf_id, cf_raw, cf_code, cf_tittle, cf_staff, cf_tot, cf_pos, cf_com, cf_level, cf_term, cf_status

											FROM $fobrainConfigTB

											WHERE
											
											cf_id = $course_id")->fetchAll(PDO::FETCH_ASSOC);
											
			array_unshift($schoolSubjs,"");
			unset($schoolSubjs[0]);

			return  $schoolSubjs;

		}

		function doCourseCodeExists($conn, $schoolID, $level, $term, $courseCode) {  /* check if school subjects exits */
			
			global $fobrainConfigTB, $foreal, $i_false, $fiVal, $seVal, $thVal;	 
				
			$ebele_mark = "SELECT cf_id					

							FROM $fobrainConfigTB

							WHERE cf_level = :cf_level
							
							AND cf_code = :cf_code 
							
							AND cf_term = :cf_term
							
							AND cf_program = :cf_program";
					
			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue(':cf_level', $level);
			$igweze_prep->bindValue(':cf_code', $courseCode); 
			$igweze_prep->bindValue(':cf_term', $term);
			$igweze_prep->bindValue(':cf_program', $schoolID);				
			$igweze_prep->execute();
			
			$rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count >= $foreal) {
			
				$status = $fiVal;
				
			}else{ 
				
				$status = $i_false;
				
			} 
			
			return $status; 

		}

		function doSubjectExists($conn, $schoolID, $level, $term, $rawCC, $rawCT, $rawCP) {  /* check if school subjects exits */
			
			global $fobrainConfigTB, $foreal, $i_false, $fiVal, $seVal, $thVal;	 
				
			$ebele_mark = "SELECT cf_id					

							FROM $fobrainConfigTB

							WHERE cf_level = :cf_level
							
							AND cf_raw = :cf_raw
							
							AND cf_tot = :cf_tot
							
							AND cf_pos = :cf_pos
							
							AND cf_term = :cf_term
							
							AND cf_program = :cf_program";
					
			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue(':cf_level', $level);
			$igweze_prep->bindValue(':cf_raw', $rawCC);
			$igweze_prep->bindValue(':cf_tot', $rawCT);
			$igweze_prep->bindValue(':cf_pos', $rawCP);
			$igweze_prep->bindValue(':cf_term', $term);
			$igweze_prep->bindValue(':cf_program', $schoolID);				
			$igweze_prep->execute();
			
			$rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count >= $foreal) {
			
				$status = $fiVal;
				
			}else{ 
				
				$status = $i_false;
				
			} 
			
			return $status; 

		} 

		function fobrainHostelData($conn) {  /* school hostel array  */

			global $hostelTB;

			$hostelData = $conn->query("SELECT h_id, hostel, h_limit, h_desc, h_master

											FROM $hostelTB")->fetchAll(PDO::FETCH_ASSOC);
											
			array_unshift($hostelData,"");
			unset($hostelData[0]);

			return  $hostelData;
			
		}

		function fobrainHostelInfo($conn, $hID) {  /* school hostel information  */

			global $hostelTB;

			$hostelData = $conn->query("SELECT h_id, hostel, h_limit, h_desc, h_master

											FROM $hostelTB
											
											WHERE  h_id = $hID")->fetchAll(PDO::FETCH_ASSOC);
											
			array_unshift($hostelData,"");
			unset($hostelData[0]);

			return  $hostelData;

		}

		function fobrainRouteData($conn) {  /* school route array */

			global $routeTB;

			$routeData = $conn->query("SELECT r_id, route, r_amout, r_desc, r_master

											FROM $routeTB")->fetchAll(PDO::FETCH_ASSOC);
											
			array_unshift($routeData,"");
			unset($routeData[0]);

			return  $routeData;
			
		}

		function fobrainRouteInfo($conn, $rID) {  /* school route information */

			global $routeTB;

			$routeData = $conn->query("SELECT r_id, route, r_amout, r_desc, r_master

											FROM $routeTB
											
											WHERE  r_id = $rID")->fetchAll(PDO::FETCH_ASSOC);
											
			array_unshift($routeData,"");
			unset($routeData[0]);

			return  $routeData;

		} 

		function bursaryConfigsArrays($conn) {  /* school bursary configuration  */

			global $bursaryConfigTB;

			$burConfigsArray = $conn->query("SELECT b_id, account, currency, bank, stax, ptax, allow

									FROM  $bursaryConfigTB")->fetchAll(PDO::FETCH_ASSOC);

			return  $burConfigsArray;
			
		}

		function bankAccountData($conn) {  /* school bank array */

			global $bankAccountTB, $fiVal;

			$bankAccountData = $conn->query("SELECT bid, acc, accno, bank, descr, balance, status

											FROM $bankAccountTB")->fetchAll(PDO::FETCH_ASSOC);
											
			array_unshift($bankAccountData,"");
			unset($bankAccountData[0]);

			return  $bankAccountData;
			
		}

		function bankAccountInfo($conn, $bid) {  /* school bank information */

			global $bankAccountTB;

			if($bid == ""){ exit; }

			$bankAccountData = $conn->query("SELECT bid, acc, accno, bank, descr, balance, status

											FROM $bankAccountTB
											
											WHERE  bid = $bid")->fetchAll(PDO::FETCH_ASSOC);
											
			array_unshift($bankAccountData,"");
			unset($bankAccountData[0]);

			return  $bankAccountData;
			
		}

		function trialBalance($conn, $query_type, $account, $category, $start_date, $end_date) {  /* fee trial Balance */    

			global $fobrainFeesTB, $fobrainExpenseTB, $payrollTB, $fobrainOrderTB, 
			$fobrainOrderSummTB,  $fiVal, $seVal;

			$query_select_1 = "fID as id, acc, feeCat as title, reg_id as client, stype as school, 
										amount as total1,  amount2 as total2, transact, date as timer, date2 as timer2";

			$query_select_2 = "order_id as id, acc, reg_id as client, stype as school, transact, 
							orderDate as timer";							

			$query_select_3 = "eid as id, acc, title, payee as client, 
											total as total1, method as total2, transact, edate as timer";							
							
			$query_select_4 = "pid as id, acc, bursar as title, staff as client, 
											nsalary as total1, salary as total2, transact, dpaid as timer";

			if($query_type == 1){  

				if(($account == "") || ($account == "all")){

					$query_acc_1 = "";
					$query_acc_2 = "";
					$query_acc_3 = "";
					$query_acc_4 = "";

				}else{
				  
					$query_acc_1 = " AND acc = $account";
					$query_acc_2 = " acc = $account AND ";
					$query_acc_3 = " WHERE acc = $account";

				}

				$ebele_mark = "SELECT $query_select_1
						
								FROM $fobrainFeesTB 
								
								WHERE   
								 
								pstatus = :pstatus 

								$query_acc_1
								
								ORDER BY fID DESC";

				$igweze_prep = $conn->prepare($ebele_mark); 
				$igweze_prep->bindValue(':pstatus',  $seVal, PDO::PARAM_STR);
				$igweze_prep->execute();

				$rows_count = $igweze_prep->rowCount();

				if($rows_count >= $foreal) {

					while($feesData[] = $igweze_prep->fetch(PDO::FETCH_ASSOC)) { }
					
					array_unshift($feesData,"");
					unset($feesData[0]);
				
				} 

				$ebele_mark_2 = "SELECT $query_select_2

                                FROM  $fobrainOrderTB
				
                                WHERE  

								$query_acc_2 
								 
								status = :status  
								
								ORDER BY order_id DESC";

				$igweze_prep_2 = $conn->prepare($ebele_mark_2); 
				$igweze_prep_2->bindValue(':status',  $seVal, PDO::PARAM_STR);
				$igweze_prep_2->execute();

				$rows_count_2 = $igweze_prep_2->rowCount();

				if($rows_count_2 >= $foreal) {

					while($saleData[] = $igweze_prep_2->fetch(PDO::FETCH_ASSOC)) { }
					
					array_unshift($saleData,"");
					unset($saleData[0]);
				
				}

				$expensesData = $conn->query("SELECT  $query_select_3

												FROM $fobrainExpenseTB 

												$query_acc_3
												
												ORDER BY eid DESC")->fetchAll(PDO::FETCH_ASSOC);
												
				array_unshift($expensesData,"");
				unset($expensesData[0]);
				
				$payrollData = $conn->query("SELECT  $query_select_4

												FROM $payrollTB 

												$query_acc_3
												
												ORDER BY pid DESC")->fetchAll(PDO::FETCH_ASSOC);
												
				array_unshift($payrollData,"");
				unset($payrollData[0]);

			}elseif($query_type == 2){   

				if(($account == "") || ($account == "all")){

					$query_acc = "";

				}else{
				  
					$query_acc = " AND acc = $account";

				}

				$ebele_mark = "SELECT $query_select_1
						
								FROM $fobrainFeesTB 
								
								WHERE  
								
								(date BETWEEN :start_date AND :end_date)

								$query_acc

								AND
								 
								pstatus = :pstatus 
								
								ORDER BY fID DESC";

				$igweze_prep = $conn->prepare($ebele_mark);
				$igweze_prep->bindValue(':start_date',  $start_date, PDO::PARAM_STR);
				$igweze_prep->bindValue(':end_date',  $end_date, PDO::PARAM_STR);
				$igweze_prep->bindValue(':pstatus',  $seVal, PDO::PARAM_STR);
				$igweze_prep->execute();

				$rows_count = $igweze_prep->rowCount();

				if($rows_count >= $foreal) {

					while($feesData[] = $igweze_prep->fetch(PDO::FETCH_ASSOC)) { }
					
					array_unshift($feesData,"");
					unset($feesData[0]);
				
				} 

				$ebele_mark_2 = "SELECT $query_select_2

                                FROM  $fobrainOrderTB 
				
                                WHERE orderDate 
                                
                                BETWEEN :start_date AND :end_date	 
                                 

								$query_acc

								AND
								 
								status = :status  
								
								ORDER BY order_id DESC";

				$igweze_prep_2 = $conn->prepare($ebele_mark_2);
				$igweze_prep_2->bindValue(':start_date',  $start_date, PDO::PARAM_STR);
				$igweze_prep_2->bindValue(':end_date',  $end_date, PDO::PARAM_STR);
				$igweze_prep_2->bindValue(':status',  $seVal, PDO::PARAM_STR);
				$igweze_prep_2->execute();

				$rows_count_2 = $igweze_prep_2->rowCount();

				if($rows_count_2 >= $foreal) {

					while($saleData[] = $igweze_prep_2->fetch(PDO::FETCH_ASSOC)) { }
					
					array_unshift($saleData,"");
					unset($saleData[0]);
				
				}

				$ebele_mark_3 = "SELECT $query_select_3
						
								FROM $fobrainExpenseTB 
								
								WHERE 
								
								(edate BETWEEN :start_date AND :end_date)

								 $query_acc
								
								ORDER BY eid DESC";

				$igweze_prep_3 = $conn->prepare($ebele_mark_3);
				$igweze_prep_3->bindValue('start_date',  $start_date, PDO::PARAM_STR);
				$igweze_prep_3->bindValue('end_date',  $end_date, PDO::PARAM_STR);
				$igweze_prep_3->execute();

				$rows_count_3 = $igweze_prep_3->rowCount();

				if($rows_count_3 >= $foreal) {

					while($expensesData[] = $igweze_prep_3->fetch(PDO::FETCH_ASSOC)) { }
					
					array_unshift($expensesData,"");
					unset($expensesData[0]);
				
				} 

				$ebele_mark_4 = "SELECT $query_select_4
						
								FROM $payrollTB 
								
								WHERE 
								
								(dpaid BETWEEN :start_date AND :end_date)

								 $query_acc
								
								ORDER BY pid DESC";

				$igweze_prep_4 = $conn->prepare($ebele_mark_4);
				$igweze_prep_4->bindValue('start_date',  $start_date, PDO::PARAM_STR);
				$igweze_prep_4->bindValue('end_date',  $end_date, PDO::PARAM_STR);
				$igweze_prep_4->execute();

				$rows_count_4 = $igweze_prep_4->rowCount();

				if($rows_count_4 >= $foreal) {

					while($payrollData[] = $igweze_prep_4->fetch(PDO::FETCH_ASSOC)) { }
					
					array_unshift($payrollData,"");
					unset($payrollData[0]);
				
				} 

			}elseif($query_type == 3){   

				if(($account == "") || ($account == "all")){

					$query_acc = "";

				}else{
				  
					$query_acc = " AND acc = $account";

				}

				if($category == "1"){

					$ebele_mark = "SELECT $query_select_1
							
									FROM $fobrainFeesTB 
									
									WHERE  
									
									(date BETWEEN :start_date AND :end_date)

									$query_acc

									AND
									
									pstatus = :pstatus 
									
									ORDER BY fID DESC";

					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':start_date',  $start_date, PDO::PARAM_STR);
					$igweze_prep->bindValue(':end_date',  $end_date, PDO::PARAM_STR);
					$igweze_prep->bindValue(':pstatus',  $seVal, PDO::PARAM_STR);
					$igweze_prep->execute();

					$rows_count = $igweze_prep->rowCount();

					if($rows_count >= $foreal) {

						while($feesData[] = $igweze_prep->fetch(PDO::FETCH_ASSOC)) { }
						
						array_unshift($feesData,"");
						unset($feesData[0]);
					
					}  
					 
					$saleData = array();
					$expensesData = array();
					$payrollData = array(); 

				}elseif($category == "2"){

					$ebele_mark_2 = "SELECT $query_select_2

									FROM  $fobrainOrderTB 
					
									WHERE orderDate 
									
									BETWEEN :start_date AND :end_date	 
									

									$query_acc

									AND
									
									status = :status  
									
									ORDER BY order_id DESC";

					$igweze_prep_2 = $conn->prepare($ebele_mark_2);
					$igweze_prep_2->bindValue(':start_date',  $start_date, PDO::PARAM_STR);
					$igweze_prep_2->bindValue(':end_date',  $end_date, PDO::PARAM_STR);
					$igweze_prep_2->bindValue(':status',  $seVal, PDO::PARAM_STR);
					$igweze_prep_2->execute();

					$rows_count_2 = $igweze_prep_2->rowCount();

					if($rows_count_2 >= $foreal) {

						while($saleData[] = $igweze_prep_2->fetch(PDO::FETCH_ASSOC)) { }
						
						array_unshift($saleData,"");
						unset($saleData[0]);
					
					}

					$feesData = array(); 
					$expensesData = array();
					$payrollData = array();

				}elseif($category == "3"){

					$ebele_mark_3 = "SELECT $query_select_3
							
									FROM $fobrainExpenseTB 
									
									WHERE 
									
									(edate BETWEEN :start_date AND :end_date)

									$query_acc
									
									ORDER BY eid DESC";

					$igweze_prep_3 = $conn->prepare($ebele_mark_3);
					$igweze_prep_3->bindValue('start_date',  $start_date, PDO::PARAM_STR);
					$igweze_prep_3->bindValue('end_date',  $end_date, PDO::PARAM_STR);
					$igweze_prep_3->execute();

					$rows_count_3 = $igweze_prep_3->rowCount();

					if($rows_count_3 >= $foreal) {

						while($expensesData[] = $igweze_prep_3->fetch(PDO::FETCH_ASSOC)) { }
						
						array_unshift($expensesData,"");
						unset($expensesData[0]);
					
					} 

					$feesData = array();
					$saleData = array(); 
					$payrollData = array();
					
				}elseif($category == "4"){

					$ebele_mark_4 = "SELECT $query_select_4
							
									FROM $payrollTB 
									
									WHERE 
									
									(dpaid BETWEEN :start_date AND :end_date)

									$query_acc
									
									ORDER BY pid DESC";

					$igweze_prep_4 = $conn->prepare($ebele_mark_4);
					$igweze_prep_4->bindValue('start_date',  $start_date, PDO::PARAM_STR);
					$igweze_prep_4->bindValue('end_date',  $end_date, PDO::PARAM_STR);
					$igweze_prep_4->execute();

					$rows_count_4 = $igweze_prep_4->rowCount();

					if($rows_count_4 >= $foreal) {

						while($payrollData[] = $igweze_prep_4->fetch(PDO::FETCH_ASSOC)) { }
						
						array_unshift($payrollData,"");
						unset($payrollData[0]);
					
					}		
					
					$feesData = array();
					$saleData = array();
					$expensesData = array(); 

				}else{ 

					$ebele_mark = "SELECT $query_select_1
							
									FROM $fobrainFeesTB 
									
									WHERE  
									
									(date BETWEEN :start_date AND :end_date)

									$query_acc

									AND
									
									pstatus = :pstatus 
									
									ORDER BY fID DESC";

					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':start_date',  $start_date, PDO::PARAM_STR);
					$igweze_prep->bindValue(':end_date',  $end_date, PDO::PARAM_STR);
					$igweze_prep->bindValue(':pstatus',  $seVal, PDO::PARAM_STR);
					$igweze_prep->execute();

					$rows_count = $igweze_prep->rowCount();

					if($rows_count >= $foreal) {

						while($feesData[] = $igweze_prep->fetch(PDO::FETCH_ASSOC)) { }
						
						array_unshift($feesData,"");
						unset($feesData[0]);
					
					} 

					$ebele_mark_2 = "SELECT $query_select_2

									FROM  $fobrainOrderTB 
					
									WHERE orderDate 
									
									BETWEEN :start_date AND :end_date	 
									

									$query_acc

									AND
									
									status = :status  
									
									ORDER BY order_id DESC";

					$igweze_prep_2 = $conn->prepare($ebele_mark_2);
					$igweze_prep_2->bindValue(':start_date',  $start_date, PDO::PARAM_STR);
					$igweze_prep_2->bindValue(':end_date',  $end_date, PDO::PARAM_STR);
					$igweze_prep_2->bindValue(':status',  $seVal, PDO::PARAM_STR);
					$igweze_prep_2->execute();

					$rows_count_2 = $igweze_prep_2->rowCount();

					if($rows_count_2 >= $foreal) {

						while($saleData[] = $igweze_prep_2->fetch(PDO::FETCH_ASSOC)) { }
						
						array_unshift($saleData,"");
						unset($saleData[0]);
					
					}

					$ebele_mark_3 = "SELECT $query_select_3
							
									FROM $fobrainExpenseTB 
									
									WHERE 
									
									(edate BETWEEN :start_date AND :end_date)

									$query_acc
									
									ORDER BY eid DESC";

					$igweze_prep_3 = $conn->prepare($ebele_mark_3);
					$igweze_prep_3->bindValue('start_date',  $start_date, PDO::PARAM_STR);
					$igweze_prep_3->bindValue('end_date',  $end_date, PDO::PARAM_STR);
					$igweze_prep_3->execute();

					$rows_count_3 = $igweze_prep_3->rowCount();

					if($rows_count_3 >= $foreal) {

						while($expensesData[] = $igweze_prep_3->fetch(PDO::FETCH_ASSOC)) { }
						
						array_unshift($expensesData,"");
						unset($expensesData[0]);
					
					} 

					$ebele_mark_4 = "SELECT $query_select_4
							
									FROM $payrollTB 
									
									WHERE 
									
									(dpaid BETWEEN :start_date AND :end_date)

									$query_acc
									
									ORDER BY pid DESC";

					$igweze_prep_4 = $conn->prepare($ebele_mark_4);
					$igweze_prep_4->bindValue('start_date',  $start_date, PDO::PARAM_STR);
					$igweze_prep_4->bindValue('end_date',  $end_date, PDO::PARAM_STR);
					$igweze_prep_4->execute();

					$rows_count_4 = $igweze_prep_4->rowCount();

					if($rows_count_4 >= $foreal) {

						while($payrollData[] = $igweze_prep_4->fetch(PDO::FETCH_ASSOC)) { }
						
						array_unshift($payrollData,"");
						unset($payrollData[0]);
					
					}

				}	 

			}else{

				$ebele_mark = "SELECT $query_select_1
						
								FROM $fobrainFeesTB 
								
								WHERE   
								 
								pstatus = :pstatus  
								
								ORDER BY fID DESC";

				$igweze_prep = $conn->prepare($ebele_mark); 
				$igweze_prep->bindValue(':pstatus',  $seVal, PDO::PARAM_STR);
				$igweze_prep->execute();

				$rows_count = $igweze_prep->rowCount();

				if($rows_count >= $foreal) {

					while($feesData[] = $igweze_prep->fetch(PDO::FETCH_ASSOC)) { }
					
					array_unshift($feesData,"");
					unset($feesData[0]);
				
				} 

				$ebele_mark_2 = "SELECT $query_select_2

                                FROM  $fobrainOrderTB 
				
                                WHERE  
								 
								status = :status  
								
								ORDER BY order_id DESC";

				$igweze_prep_2 = $conn->prepare($ebele_mark_2); 
				$igweze_prep_2->bindValue(':status',  $seVal, PDO::PARAM_STR);
				$igweze_prep_2->execute();

				$rows_count_2 = $igweze_prep_2->rowCount();

				if($rows_count_2 >= $foreal) {

					while($saleData[] = $igweze_prep_2->fetch(PDO::FETCH_ASSOC)) { }
					
					array_unshift($saleData,"");
					unset($saleData[0]);
				
				} 

				$expensesData = $conn->query("SELECT  $query_select_3

												FROM $fobrainExpenseTB 
												
												ORDER BY eid DESC")->fetchAll(PDO::FETCH_ASSOC);
												
				array_unshift($expensesData,"");
				unset($expensesData[0]);   

				$payrollData = $conn->query("SELECT  $query_select_4

												FROM $payrollTB  
												
												ORDER BY pid DESC")->fetchAll(PDO::FETCH_ASSOC);
												
				array_unshift($payrollData,"");
				unset($payrollData[0]);

			} 

			$trialBalance_1 = array_merge($feesData, $saleData); 
            $trialBalance_2 = array_merge($expensesData, $payrollData); 
			$trialBalance = array_merge($trialBalance_1, $trialBalance_2);

			$dates = array();
			foreach ($trialBalance as $key => $row) {
				$dates[$key] = strtotime($row['timer']);
			}

			// Sort the multidimensional array based on the 'date' values using array_multisort() with a callback
			array_multisort($dates, SORT_DESC, $trialBalance); 
		 
			array_unshift($trialBalance,"");
			unset($trialBalance[0]); 

            return $trialBalance; 
			//echo "<pre>"; print_r($trialBalanceArr); echo "</pre>";
			 
		}

		function accountBalance($conn, $bid) {  /* check account balance  */	

			global $bankAccountTB, $foreal, $fiVal, $curSymbol; 
						
			$ebele_mark = "SELECT bid, balance
	
								FROM $bankAccountTB
	
								WHERE bid = :bid"; 
	
			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue(':bid', $bid);					 
			$igweze_prep->execute();
							
			$rows_count = $igweze_prep->rowCount(); 
			
			if ($rows_count == 1){ 
	
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
	
					$bid = $row['bid']; 
					$balance = $row['balance']; 
	
				} 
			
			}else{
	
				$balance = "";
				
			}	 

			echo fobrainCurrency($balance, $curSymbol);
			
		}

		function accountName($conn, $bid) {  /* check account balance  */	

			global $bankAccountTB, $foreal, $fiVal; 
						
			$ebele_mark = "SELECT bid, acc
	
								FROM $bankAccountTB
	
								WHERE bid = :bid"; 
	
			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue(':bid', $bid);					 
			$igweze_prep->execute();
							
			$rows_count = $igweze_prep->rowCount(); 
			
			if ($rows_count == 1){ 
	
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
	
					$bid = $row['bid']; 
					$acc = $row['acc']; 
	
				} 
			
			}else{
	
				$acc = "";
				
			}	 

			return $acc;
			
		}

		function accountName2($conn, $bid) {  /* check account balance  */	

			global $bankAccountTB, $curSymbol, $foreal, $fiVal; 
						
			$ebele_mark = "SELECT bid, acc, balance
	
								FROM $bankAccountTB
	
								WHERE bid = :bid"; 
	
			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue(':bid', $bid);					 
			$igweze_prep->execute();
							
			$rows_count = $igweze_prep->rowCount(); 
			
			if ($rows_count == 1){ 
	
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
	
					$bid = $row['bid'];
					$balance = $row['balance']; 
					$acc = $row['acc']; 
	
				} 

				$balance = fobrainCurrency($balance, $curSymbol);  /* school currency information*/

				$full_info =  $acc.' ('.$balance.')';
			
			}else{
	
				$full_info = "";
				
			}	 

			return $full_info;
			
		}

		function balanceAccount($conn, $bid, $total, $transaction, $allow) {  /* balance account */	

			global $bankAccountTB, $foreal, $fiVal, $foVal; 
						
			$ebele_mark_b1 = "SELECT bid, balance
	
								FROM $bankAccountTB
	
								WHERE bid = :bid";
					
	
			$igweze_prep_b1 = $conn->prepare($ebele_mark_b1);
			$igweze_prep_b1->bindValue(':bid', $bid);					 
			$igweze_prep_b1->execute();
							
			$rows_count_b1 = $igweze_prep_b1->rowCount(); 
			
			if ($rows_count_b1 == 1){ 
	
				while($row = $igweze_prep_b1->fetch(PDO::FETCH_ASSOC)) {		
	
					$bid = $row['bid']; 
					$balance = $row['balance'];

                    if($transaction == "debit"){
						
                        $curr_balance = (doubleval($balance) - doubleval($total));

						if($allow == 0){

							if($curr_balance < 0){
								return 2;
							}

						}

                    }elseif($transaction == "credit"){
                        $curr_balance = (doubleval($balance) + doubleval($total));
                    }else{
                       return 3; 
                    } 
	
					$ebele_mark_b2 = "UPDATE 
					
									$bankAccountTB	
	
									SET
	
									balance = :balance									
										
									WHERE 
									
									bid = :bid 
									
									LIMIT 1";
					
					$igweze_prep_b2 = $conn->prepare($ebele_mark_b2);
					$igweze_prep_b2->bindValue(':bid', $bid);
					$igweze_prep_b2->bindValue(':balance', $curr_balance);  
					if($igweze_prep_b2->execute()){  /* if sucessfully */ 
						
						return 1;
	
					}else{ 
						return 4;
					}	
	
				}
			
			}else{
	
				return 0;
				
			}			
			
		}

		function bankOptions($conn, $bid2, $return){
            
            global $fiVal;

            $bankArray = bankAccountData($conn);  /* school banks array */
            $bankCount = count($bankArray);  

			$select_box = "";
            
            if($bankCount >= $fiVal){	/* check array is empty */	 

                for($i = $fiVal; $i <= $bankCount; $i++){	/* loop array */
                
                    $bid = $bankArray[$i]["bid"];
                    $bank = $bankArray[$i]["acc"];
                    
                    $bank = trim($bank); 

                    if ( $bid == $bid2){
                        $selected = "SELECTED";
                    } else {
                        $selected = "";
                    }

                    $select_box .= "<option value='$bid' $selected> $bank</option>";

                }
                
            }else{
                
                $select_box .= "<option value=''>Ooops Error, could not find bank account.</option>";
                    
            }	

			if($return == 0){
				echo $select_box;
			}else{
				return $select_box;
			}


        }

		function chartAccountData($conn) {  /* school chart array */

			global $chartAccountTB, $fiVal;

			$chartAccountData = $conn->query("SELECT cid, acc, acc_type, st_type, st_group, descr, balance, cstatus

											FROM $chartAccountTB")->fetchAll(PDO::FETCH_ASSOC);
											
			array_unshift($chartAccountData,"");
			unset($chartAccountData[0]);

			return  $chartAccountData;
			
		}

		function chartAccountInfo($conn, $cid) {  /* school chart information */

			global $chartAccountTB;

			if($cid == ""){ exit; }

			$chartAccountData = $conn->query("SELECT cid, acc, acc_type, st_type, st_group, descr, balance, cstatus

											FROM $chartAccountTB
											
											WHERE  cid = $cid")->fetchAll(PDO::FETCH_ASSOC);
											
			array_unshift($chartAccountData,"");
			unset($chartAccountData[0]);

			return  $chartAccountData;
			
		} 

		function chartBalance($conn, $cid) {  /* check chart balance  */	

			global $chartAccountTB, $foreal, $fiVal, $curSymbol; 
						
			$ebele_mark = "SELECT cid, balance
	
								FROM $chartAccountTB
	
								WHERE cid = :cid"; 
	
			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue(':cid', $cid);					 
			$igweze_prep->execute();
							
			$rows_count = $igweze_prep->rowCount(); 
			
			if ($rows_count == 1){ 
	
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
	
					$cid = $row['cid']; 
					$balance = $row['balance']; 
	
				} 
			
			}else{
	
				$balance = "";
				
			}	 

			echo fobrainCurrency($balance, $curSymbol);
			
		}

		function chartName($conn, $cid) {  /* check chart name  */	

			global $chartAccountTB, $foreal, $fiVal; 
						
			$ebele_mark = "SELECT cid, acc, acc_type, st_type, st_group, descr, balance
	
								FROM $chartAccountTB
	
								WHERE cid = :cid"; 
	
			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue(':cid', $cid);					 
			$igweze_prep->execute();
							
			$rows_count = $igweze_prep->rowCount(); 
			
			if ($rows_count == 1){ 
	
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
	
					$cid = $row['cid']; 
					$acc = $row['acc']; 
					$acc_type = $row['acc_type']; 
					$st_type = $row['st_type'];
					$st_group = $row['st_group']; 
					$descr = $row['descr']; 
					$balance = $row['balance'];  
 
				} 

				$acc_info = $acc.'#fob#'.$acc_type.'#fob#'.$st_type.'#fob#'.$st_group;
			
			}else{
	
				$acc_info = "";
				
			}	 

			return $acc_info;
			
		}

		function chartName2($conn, $cid) {  /* check account balance  */	

			global $chartAccountTB, $curSymbol, $foreal, $fiVal; 
						
			$ebele_mark = "SELECT cid, acc, balance
	
								FROM $chartAccountTB
	
								WHERE cid = :cid"; 
	
			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue(':cid', $cid);					 
			$igweze_prep->execute();
							
			$rows_count = $igweze_prep->rowCount(); 
			
			if ($rows_count == 1){ 
	
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
	
					$cid = $row['cid'];
					$balance = $row['balance']; 
					$acc = $row['acc']; 
	
				} 

				$balance = fobrainCurrency($balance, $curSymbol);  /* school currency information*/

				$full_info =  $acc.' ('.$balance.')';
			
			}else{
	
				$full_info = "";
				
			}	 

			return $full_info;
			
		}

		function balanceChartAccount($conn, $cid, $total, $transaction, $allow) {  /* balance account */	

			global $chartAccountTB, $foreal, $fiVal, $foVal; 
						
			$ebele_mark_b1 = "SELECT cid, balance
	
								FROM $chartAccountTB
	
								WHERE cid = :cid";
					
	
			$igweze_prep_b1 = $conn->prepare($ebele_mark_b1);
			$igweze_prep_b1->bindValue(':cid', $cid);					 
			$igweze_prep_b1->execute();
							
			$rows_count_b1 = $igweze_prep_b1->rowCount(); 
			
			if ($rows_count_b1 == 1){ 
	
				while($row = $igweze_prep_b1->fetch(PDO::FETCH_ASSOC)) {		
	
					$cid = $row['cid']; 
					$balance = $row['balance'];

                    if($transaction == "debit"){
						
                        $curr_balance = (doubleval($balance) - doubleval($total));

						if($allow == 0){

							if($curr_balance < 0){
								return 2;
							}

						}

                    }elseif($transaction == "credit"){
                        $curr_balance = (doubleval($balance) + doubleval($total));
                    }else{
                       return 3; 
                    } 
	
					$ebele_mark_b2 = "UPDATE 
					
									$chartAccountTB	
	
									SET
	
									balance = :balance									
										
									WHERE 
									
									cid = :cid 
									
									LIMIT 1";
					
					$igweze_prep_b2 = $conn->prepare($ebele_mark_b2);
					$igweze_prep_b2->bindValue(':cid', $cid);
					$igweze_prep_b2->bindValue(':balance', $curr_balance);  
					if($igweze_prep_b2->execute()){  /* if sucessfully */ 
						
						return 1;
	
					}else{ 
						return 4;
					}	
	
				}
			
			}else{
	
				return 0;
				
			}			
			
		}

		function chartOptions($conn, $cid2, $return, $query){
            
            global $fiVal, $account_type_arr;

            $chartArray = chartAccountData($conn);  /* school charts array */
            $chartCount = count($chartArray);  

			$select_box = "";
            
            if($chartCount >= $fiVal){	/* check array is empty */	 

                for($i = $fiVal; $i <= $chartCount; $i++){	/* loop array */
                
                    $cid = $chartArray[$i]["cid"];
                    $chart = $chartArray[$i]["acc"];
					$acc_type = $chartArray[$i]["acc_type"];
					$st_type = $chartArray[$i]["st_type"];
                    
                    $chart = trim($chart); 

					$acc_type = wizSelectArray($acc_type, $account_type_arr);

                    if ( $cid == $cid2){
                        $selected = "SELECTED";
                    } else {
                        $selected = "";
                    }

					if($query == "single"){
						$option_val = $cid;
					}else{
						$option_val = $cid.'#fob#'.$acc_type.'#fob#'.$st_type;
					} 

                    $select_box .= "<option value='$option_val' $selected> $chart</option>";

                }
                
            }else{
                
                $select_box .= "<option value=''>Ooops Error, could not find chart account.</option>";
                    
            }	

			if($return == 0){
				echo $select_box;
			}else{
				return $select_box;
			}


        } 

		function accountJournalData($conn) {  /* school journal chart array */

			global $accountJournalTB, $fiVal;

			$accountJournalData = $conn->query("SELECT jid, transid, transact, account, credit, debit, descr, balance, jdate, jtime

											FROM $accountJournalTB")->fetchAll(PDO::FETCH_ASSOC);
											
			array_unshift($accountJournalData,"");
			unset($accountJournalData[0]);

			return  $accountJournalData;
			
		}

		function accountJournalInfo($conn, $jid) {  /* school journal chart information */

			global $accountJournalTB;
			/*
			if($jid == ""){ exit; }

			$accountJournalData = $conn->query("SELECT jid, transid, transact, account, credit, debit, descr, balance, jdate, jtime

											FROM $accountJournalTB
											
											WHERE  jid = $jid")->fetchAll(PDO::FETCH_ASSOC);
											
			array_unshift($accountJournalData,"");
			unset($accountJournalData[0]);

			return  $accountJournalData;
*/

			$ebele_mark = "SELECT jid, transid, transact, account, credit, debit, descr, balance, jdate, jtime
					
						from $accountJournalTB 
		
						WHERE jid = :jid";
						

			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue('jid',  $jid);   
			
			$igweze_prep->execute();

			$rows_count = $igweze_prep->rowCount();

			if($rows_count >= $foreal) {

				while($accountJournalArr[] = $igweze_prep->fetch(PDO::FETCH_ASSOC)) { }
				
				array_unshift($accountJournalArr,"");
				unset($accountJournalArr[0]);
			
			}else{

				$accountJournalArr = '';

			}

			return $accountJournalArr;
			
		}

		function accountJournalRange($conn, $startDate, $endDate, $account, $query) {  /* school expenses range array */

			global $accountJournalTB, $foreal, $i_false;	
			
			if($query == "account"){


				$ebele_mark = "SELECT jid, transid, transact, account, credit, debit, descr, balance, jdate, jtime
					
							from $accountJournalTB 
			
							WHERE (jdate BETWEEN :start_date AND :end_date)

							AND account = :account
							
							ORDER BY jid, jdate ASC";//DESC
							

				$igweze_prep = $conn->prepare($ebele_mark);
				$igweze_prep->bindValue('start_date',  $startDate, PDO::PARAM_STR);
				$igweze_prep->bindValue('end_date',  $endDate, PDO::PARAM_STR); 
				$igweze_prep->bindValue('account',  $account, PDO::PARAM_INT); 


			}else{

				$ebele_mark = "SELECT jid, transid, transact, account, credit, debit, descr, balance, jdate, jtime
					
							from $accountJournalTB 
			
							WHERE (jdate BETWEEN :start_date AND :end_date)
							
							ORDER BY jid, jdate ASC";//DESC
							

				$igweze_prep = $conn->prepare($ebele_mark);
				$igweze_prep->bindValue('start_date',  $startDate, PDO::PARAM_STR);
				$igweze_prep->bindValue('end_date',  $endDate, PDO::PARAM_STR); 


			}
					
			
			$igweze_prep->execute();

			$rows_count = $igweze_prep->rowCount();

			if($rows_count >= $foreal) {

				while($accountJournalArr[] = $igweze_prep->fetch(PDO::FETCH_ASSOC)) { }
				
				array_unshift($accountJournalArr,"");
				unset($accountJournalArr[0]);
			
			}else{

				$accountJournalArr = '';

			}

			return $accountJournalArr;
				
		}

		function journalTrialRange($conn, $startDate, $endDate) {  /* school expenses range array */

			global $accountJournalTB, $foreal, $i_false;	 

			$ebele_mark = "SELECT account

						from $accountJournalTB 
		
						WHERE (jdate BETWEEN :start_date AND :end_date)";
						

			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue('start_date',  $startDate, PDO::PARAM_STR);
			$igweze_prep->bindValue('end_date',  $endDate, PDO::PARAM_STR);  
			$igweze_prep->execute(); 
		 
			$rows_count = $igweze_prep->rowCount(); 

			$accountJournalArr  = array();
			
			if ($rows_count >= 1){ 
	
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {	 
					
					$accountJournalArr[] = $row['account'];  
	
				}
				
				$accountJournalArr = array_unique($accountJournalArr);

				array_unshift($accountJournalArr,"");
				unset($accountJournalArr[0]);
			
			}else{

				$accountJournalArr = '';

			}

			return $accountJournalArr;
				
		}

		function incomeBalanceRange($conn, $startDate, $endDate){

			global $i_false, $curSymbol;  
			
			$journalTrialRange = journalTrialRange($conn, $startDate, $endDate); 

			$grand_credit = 0; $grand_debit = 0; $grand_balance = 0; 	
			$credit_grand = 0; $debit_grand = 0; $net_balance = 0;		
			
			if(is_array($journalTrialRange)){ 
						
				foreach ($journalTrialRange as $account){ 
						
					if($account == ""){ goto nextrow2; } 

					$journalTrialRow = journalTrialRow($conn, $startDate, $endDate, $account);

					list ($debit, $credit, $balance) = explode ("#fob#", $journalTrialRow);
					
					$credit_con = fobrainCurrency($credit, $curSymbol);  /* school currency information*/
					$debit_con = fobrainCurrency($debit, $curSymbol);  /* school currency information*/
					$balance_con = fobrainCurrency($balance, $curSymbol);  /* school currency information*/

					$account_info = chartName($conn, $account); 
					list ($account, $acc_type, $st_type, $st_group) = explode ("#fob#", $account_info);        

						
					if($st_type != 2){ goto nextrow2; }

					if($st_group == 1){
						
						$credit_grand += floatval($credit);
						$amount_bal = $credit_con;

					}elseif($st_group == 2){  

						$debit_grand += floatval($debit);
						$amount_bal = $debit_con;

					}else{
						
					}

					nextrow2: 

				} 

			} 
					
			//$credit_total = fobrainCurrency($credit_grand, $curSymbol);
			//$expense_total = fobrainCurrency($debit_grand, $curSymbol);   

			$net_balance = floatval($credit_grand) - floatval($debit_grand); 
			//$net_balance_con = fobrainCurrency($net_balance, $curSymbol);

			return $credit_grand.'#fob#'.$debit_grand.'#fob#'.$net_balance;

		}	

		function journalTrialRow($conn, $startDate, $endDate, $account) {  /* school expenses range array */

			global $accountJournalTB, $foreal, $i_false;	$credit_total = 0; $debit_total = 0;

			$ebele_mark = "SELECT jid, transid, transact, account, credit, debit, descr, balance, jdate, jtime
				
						from $accountJournalTB 
		
						WHERE (jdate BETWEEN :start_date AND :end_date)

						AND account = :account";
						

			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue('start_date',  $startDate, PDO::PARAM_STR);
			$igweze_prep->bindValue('end_date',  $endDate, PDO::PARAM_STR); 
			$igweze_prep->bindValue('account',  $account, PDO::PARAM_INT);  
			
			$igweze_prep->execute();

			$rows_count = $igweze_prep->rowCount();

			if($rows_count >= $foreal) {

				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {	  
					
					$credit_total += $row['credit'];
					$debit_total += $row['debit']; 
	
				}

				$balance = floatval($debit_total) - floatval($credit_total); 
				$account_data = $debit_total.'#fob#'.$credit_total.'#fob#'.$balance; 
				 
			
			}else{

				$credit_total = 0;
				$debit_total = 0;
				$balance = 0; 

			}

			$account_data = $debit_total.'#fob#'.$credit_total.'#fob#'.$balance;

			return $account_data; 
				
		}

        function accountJournalTB($conn, $tid, $transact) {  /* school journal chart information */
            
            global  $accountJournalTB, $curSymbol, $fiVal, $account_type_arr;

            $ebele_mark = "SELECT jid, transid, transact, account, credit, debit, descr, balance, jdate, jtime

								FROM $accountJournalTB

								WHERE transid = :transid
								
								AND transact = :transact"; 

			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue(':transid', $tid);
			$igweze_prep->bindValue(':transact', $transact);
			$igweze_prep->execute();
			$rows_count = $igweze_prep->rowCount();
 
            $page_title = '<i class="mdi mdi-chart-bar-stacked fs-18"></i> 
                        Journals Entry';
			$title_1 = pageTitle2($page_title, 0);

$journal_head =<<<IGWEZE

            <!-- row -->
            <div class="row gutters my-30">
                <div class="col-12">
                    $title_1
                </div>	
                <div class="col-12">	
                    <div class="table-responsive">   
                        <!-- table -->
                        <table id="fob-journal-entry" class='table table-hover table-responsive style-table mb-15 pb-0'>
                        
                        <thead>
                            <tr>
                                <th width="10%">Date</th> 
                                <th width="20%">Discription</th> 
                                <th width="20%">Account</th>
                                <!--<th width="20%">Account Type</th>-->
                                <th width="15%">Debit ($curSymbol)</th>
                                <th width="15%">Credit ($curSymbol)</th>
                                <!--<th width="10%">Balance ($curSymbol)</th>  -->
                            </tr>
                        </thead> 
                        <tbody>  
IGWEZE;

                        echo $journal_head; 

						$opt_c = 1;  $query = "";

                        if($rows_count >= $fiVal) {

                            while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {

                                $transid = $row['transid'];
                                $jid = $row['jid'];
                                $transact = $row['transact'];
                                $account = $row['account'];
                                $credit = $row['credit'];
                                $debit = $row['debit'];
                                $descr = $row['descr'];
                                $balance = $row['balance'];
                                $jdate = $row['jdate'];
                                $jtime = $row['jtime'];

								$account_id =  $account;

                                $account_info = chartName($conn, $account); 
                                list ($account, $acc_type, $st_type) = explode ("#fob#", $account_info); 
								$acc_type = wizSelectArray($acc_type, $account_type_arr);

								$account_field = 'chart_account'.$opt_c;
								$account_data = 'journal-type'.$opt_c;

								$options_chart_1 =" <select class='form-control fob-select chart-autofill-2'  data-code='$account_data'  
                                    id='$account_field' name='$account_field'><option value=''>Select Chart Account</option>";
								try {
								
									$options_chart_1 .= chartOptions($conn, $account_id, 1, $query);
									
								}catch(PDOException $e) {

									fobrainDie( 'Ooops Database Error: ' . $e->getMessage());

								}

								$options_chart_1 .= "</select>";


								$credit_con = fobrainCurrency($credit, $curSymbol);  /* school currency information*/
								$debit_con = fobrainCurrency($debit, $curSymbol);  /* school currency information*/
								$balance_con = fobrainCurrency($balance, $curSymbol); 

$journal_rows =<<<IGWEZE

                                <tr>
                                    <td><span class="journal-date">$jdate</span></td>
                                    <td><span class="journal-desc">$descr</span></td> 
                                    <td> 
										$options_chart_1 
										<input type="hidden" name="journal-id" id="journal-id" value="$jid" />
										<input type="hidden" name="journal-trans" id="journal-trans" value="$transid" />
									</td>  
                                    <!--<td><span class="journal-type$opt_c">$acc_type</span></td> -->
                                    <td><span class="journal-debit$opt_c">$debit_con</span></td>
                                    <td><span class="journal-credit$opt_c">$credit_con</span></td>
                                    <!--<td><span class="journal-balance">$balance_con</span></td> -->
                                </tr> 
                                
IGWEZE;

                                echo $journal_rows;  
								$options_chart_1 ="";
								$opt_c++;
                                
                            }  

                        }else{ 

                            //$adminData = $i_false; 

                        } 

$journal_bot =<<<IGWEZE

                        </tbody>
                        </table>				
                        <!-- / table --> 
                    </div>
                </div>	
            </div>

            <!-- /row -->	 

			<hr class="my-25 text-danger" />
			<div class="msg-box-ref"> </div>
			<!-- row -->
			<div class="row gutters"> 
				<div class="col-12 text-end">
					<input type="hidden" name="transid" id="transid" value="$transid" />
					<button type="submit" class="btn btn-primary waves-effect   
					btn-label waves-light demo-disenable"  onclick='updateJournal()'>
						<i class="mdi mdi-content-save label-icon"></i>  Update 
					</button>
				</div>
			</div>	
			<!-- /row --> 

IGWEZE;

            echo $journal_bot;   

        }

		function feeCategoryData($conn) {  /* school fee category array */

			global $feeCategoryTB, $fiVal;

			$feeCategoryData = $conn->query("SELECT f_id, fee, amount, account, status

											FROM $feeCategoryTB")->fetchAll(PDO::FETCH_ASSOC);
											
			array_unshift($feeCategoryData,"");
			unset($feeCategoryData[0]);

			return  $feeCategoryData;
			
		}

		function feeCategoryInfo($conn, $fID) {  /* school fee category information */

			global $feeCategoryTB;

			if($fID == ""){ exit; }

			$feeCategoryData = $conn->query("SELECT f_id, fee, amount, account, status

											FROM $feeCategoryTB
											
											WHERE  f_id = $fID")->fetchAll(PDO::FETCH_ASSOC);
											
			array_unshift($feeCategoryData,"");
			unset($feeCategoryData[0]);

			return  $feeCategoryData;
			
		}	

		function feeCategoryName($conn, $f_id) {  /* get fee category name  */	

			global $feeCategoryTB, $foreal, $fiVal; 
						
			$ebele_mark = "SELECT f_id, fee
	
								FROM $feeCategoryTB
	
								WHERE f_id = :f_id"; 
	
			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue(':f_id', $f_id);					 
			$igweze_prep->execute();
							
			$rows_count = $igweze_prep->rowCount(); 
			
			if ($rows_count == 1){ 
	
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
	
					$f_id = $row['f_id']; 
					$fee = $row['fee']; 
	
				} 
			
			}else{
	
				$fee = "";
				
			}	 

			return $fee;
			
		}

		function expenseCategoryData($conn) {  /* school expenses category array */

			global $expenseCategoryTB, $fiVal;

			$expenseCategoryData = $conn->query("SELECT e_id, expense, status

											FROM $expenseCategoryTB")->fetchAll(PDO::FETCH_ASSOC);
											
			array_unshift($expenseCategoryData,"");
			unset($expenseCategoryData[0]);

			return  $expenseCategoryData;
			
		}

		function expenseCategoryInfo($conn, $eID) {  /* school expenses category information */

			global $expenseCategoryTB;

			if($eID == ""){ exit; }

			$expenseCategoryData = $conn->query("SELECT e_id, expense, status

											FROM $expenseCategoryTB
											
											WHERE  e_id = $eID")->fetchAll(PDO::FETCH_ASSOC);
											
			array_unshift($expenseCategoryData,"");
			unset($expenseCategoryData[0]);

			return  $expenseCategoryData;
			
		}	
		
		function expenseOptions($conn, $expID, $return){
            
            global $fiVal;

            $expenseArray = expenseCategoryData($conn);  /* school expenses category array */
            $expenseCount = count($expenseArray);  

			$select_box = "";
            
            if($expenseCount >= $fiVal){	/* check array is empty */	 

                for($i = $fiVal; $i <= $expenseCount; $i++){	/* loop array */
                
                    $eID = $expenseArray[$i]["e_id"];
                    $expense = $expenseArray[$i]["expense"];
                    
                    $expense = trim($expense); 

                    if ( $eID == $expID){
                        $selected = "SELECTED";
                    } else {
                        $selected = "";
                    }

                    $select_box .= "<option value='$eID' $selected> $expense</option>";

                }
                
            }else{
                
                $select_box .= "<option value=''>Ooops Error, could not find expense category.</option>";
                    
            }	

			if($return == 0){
				echo $select_box;
			}else{
				return $select_box;
			}


        }

		function insertExpenseDocs($conn, $doc, $pid, $status) {  /* insert expense docs */

			global $expenseDocTB, $foreal, $fiVal, $foVal;

			$ebele_mark_1= "INSERT INTO $expenseDocTB
								(doc, pid, status)
	
							VALUES (:doc, :pid, :status)";
	
			$igweze_prep_1 = $conn->prepare($ebele_mark_1);
			$igweze_prep_1->bindValue(':doc', $doc);
			$igweze_prep_1->bindValue(':pid', $pid);
			$igweze_prep_1->bindValue(':status', $status);										
			$igweze_prep_1->execute();
						
			$ebele_mark = "SELECT eid
		
								FROM $expenseDocTB
		
								WHERE pid = :pid";
					
		
			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue(':pid', $pid);					 
			$igweze_prep->execute();
							
			return $rows_count = $igweze_prep->rowCount();   
						
			
		}

		function countExpenseDocs($conn, $pid) {  /* count expense docs */

			global $expenseDocTB, $foreal, $fiVal, $foVal; 
						
			$ebele_mark = "SELECT eid
		
								FROM $expenseDocTB
		
								WHERE pid = :pid";
					
		
			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue(':pid', $pid);					 
			$igweze_prep->execute();
							
			return $counter = $igweze_prep->rowCount();   
			
		}

		function cleanExpenseDocs($conn) {  /* insert expense docs */	

			global $expenseDocTB, $expense_doc_ext, $foreal, $fiVal, $foVal; $status = 0;
						
			$ebele_mark = "SELECT eid, doc
		
								FROM $expenseDocTB
		
								WHERE status = :status";
					
		
			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue(':status', $status);					 
			$igweze_prep->execute();
							
			$rows_count = $igweze_prep->rowCount(); 
			
			if ($rows_count >= 1){ 

				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		

					$eid = $row['eid']; 
					$doc = $row['doc'];

					$ebele_mark_1 = "DELETE FROM 
					
									$expenseDocTB										
										
									WHERE 
									
									eid = :eid

									AND

									status = :status
									
									LIMIT 1";
					
					$igweze_prep_1 = $conn->prepare($ebele_mark_1);
					$igweze_prep_1->bindValue(':eid', $eid);
					$igweze_prep_1->bindValue(':status', $status);  

					if($igweze_prep_1->execute()){  /* if sucessfully */ 
						 
						removePicture($expense_doc_ext, $doc); 

					}	

				}
			
			}			
			
		}

		function expenseDocs($conn, $pid, $rem_icon) {  /* expense docs */	

			global $expenseDocTB, $expense_doc_ext, $foreal, $fiVal;   
			
			$expense_doc = ""; $picturePath = $expense_doc_ext;
						
			$ebele_mark = "SELECT eid, doc
		
								FROM $expenseDocTB
		
								WHERE pid = :pid"; 
		
			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue(':pid', $pid);					 
			$igweze_prep->execute();
							
			$rows_count = $igweze_prep->rowCount(); 
			
			if ($rows_count >= 1){ 

				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		

					$eid = $row['eid']; 
					$doc = $row['doc'];  
					 
					$uploadDocID = str_replace(".","foreal",$doc);  

					echo  '
						<div style="" class = "doc-upload-img 
							col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6" 
							id = "doc-upload-img_'.$uploadDocID.'">';
							echo '<span class = "rem-expense-doc" style="position: relative;
							top: -10px;left:-5px; float:right; cursor:pointer;" 
							id= "doc-'.$doc.'"><img src="'.$rem_icon.'" height="12">
							</span>
							<img src='.$picturePath.$doc.' class = "preview" />
						</div>'; 

				}  
			
			}	
			
			if ($rows_count >= 20){  
 
				$script = "$('.upload-expense-div').hide()";  
			
			}else{
				
				$script = "$('.upload-expense-div').show()";

			}

			echo "<script type='text/javascript'>    
					$script
					$('.attach-counter').text($rows_count);
				</script>";
			
		}

		function feesData($conn) {  /* school fee array */

			global $fobrainFeesTB, $fiVal;

			$feesData = $conn->query("SELECT fID, feeCat, feeAmount, session, reg_id, regNo, stype, level, class, term, method, 
									f_details, amount, balance, waiver, efine, date, f_status, pstatus, pstatus2, 
									upload, upload2, amount2, date2, method2, n_pay, acc

											FROM $fobrainFeesTB
											
											ORDER BY fID DESC")->fetchAll(PDO::FETCH_ASSOC);
											
			array_unshift($feesData,"");
			unset($feesData[0]);

			return  $feesData;
			
		}

		function feesInfo($conn, $fID) {  /* school fee array information */

			global $fobrainFeesTB;

			$feesData = $conn->query("SELECT fID, feeCat, feeAmount, session, reg_id, regNo, stype, level, class, term, method, 
									f_details, amount, balance, waiver, efine, date, f_status, pstatus, pstatus2, 
									upload, upload2, amount2, date2, method2, n_pay, acc

											FROM $fobrainFeesTB
											
											WHERE  fID = $fID")->fetchAll(PDO::FETCH_ASSOC);
											
			array_unshift($feesData,"");
			unset($feesData[0]);

			return  $feesData;
			
		}

		function studentFeesInfo($conn, $regID, $regNum, $sType) {  /* student school fees array information */

			global $fobrainFeesTB;

			$feesData = $conn->query("SELECT fID, feeCat, feeAmount, session, reg_id, regNo, stype, level, class, term, method, 
									f_details, amount, balance, waiver, efine, date, f_status, pstatus, pstatus2, 
									upload, upload2, amount2, date2, method2, n_pay, acc

											FROM $fobrainFeesTB
											
											WHERE  reg_id = $regID
											
											AND regNo = '$regNum'
											
											AND stype = $sType
											
											ORDER BY fID DESC")->fetchAll(PDO::FETCH_ASSOC);
											
			array_unshift($feesData,"");
			unset($feesData[0]);

			return  $feesData;
			
		}

		function feesDataRange($conn, $startDate, $endDate) {  /* school fee range array */

			global $fobrainFeesTB, $foreal, $i_false;		
					
			$ebele_mark = "SELECT fID, feeCat, feeAmount, session, reg_id, regNo, stype, level, class, term, method, 
							f_details, amount, balance, waiver, efine, date, f_status, pstatus, pstatus2, 
							upload, upload2, amount2, date2, method2, n_pay, acc
					
							FROM $fobrainFeesTB 
			
							WHERE (date BETWEEN :start_date AND :end_date)
							
							ORDER BY fID DESC";

			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue('start_date',  $startDate, PDO::PARAM_STR);
			$igweze_prep->bindValue('end_date',  $endDate, PDO::PARAM_STR);
			$igweze_prep->execute();

			$rows_count = $igweze_prep->rowCount();

			if($rows_count >= $foreal) {

				while($feesDataArr[] = $igweze_prep->fetch(PDO::FETCH_ASSOC)) { }
				
				array_unshift($feesDataArr,"");
				unset($feesDataArr[0]);
			
			}else{

				$feesDataArr = '';

			}

			return $feesDataArr;
				
		}

		function checkFeeExits($conn, $regNum, $regID, $schoolID, $level, $term) {  /* check if a student fee exist */

			global $fobrainFeesTB, $foreal, $i_false;
		
			$ebele_mark = "SELECT fID, feeCat, feeAmount, session, reg_id, regNo, stype, level, class, term, method, 
											f_details, amount, balance, waiver, efine, date, f_status, pstatus, pstatus2, 
											upload, upload2, amount2, date2, method2, n_pay, acc
		
						FROM $fobrainFeesTB  
		
						WHERE regNo = :regNo
						
						AND reg_id = :reg_id
						
						AND level = :level
						
						AND term = :term
						
						AND stype = :stype";
					
			$igweze_prep = $conn->prepare($ebele_mark); 
			$igweze_prep->bindValue(':regNo', $regNum); 
			$igweze_prep->bindValue(':reg_id', $regID); 
			$igweze_prep->bindValue(':stype', $schoolID);
			$igweze_prep->bindValue(':level', $level);
			//$igweze_prep->bindValue(':class', $class);
			$igweze_prep->bindValue(':term', $term);				
			$igweze_prep->execute();
			
			$rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count >= $foreal) {

				while($feesDataArr[] = $igweze_prep->fetch(PDO::FETCH_ASSOC)) { }				
				array_unshift($feesDataArr,"");
				unset($feesDataArr[0]);
			
			}else{

				$feesDataArr = 0;

			}

			return $feesDataArr;
		
		}

        function payrollData($conn) {  /* school payroll array */

            global $payrollTB, $fiVal;

            $payrollData = $conn->query("SELECT pid, acc, staff, bursar, transid, salary, nsalary, tax, ded1, earn1, ded2, earn2, 
            ded3, earn3, pmethod, details, dpaid, transact, upload, status

                                            FROM $payrollTB
											
											ORDER BY pid DESC")->fetchAll(PDO::FETCH_ASSOC);
                                            
            array_unshift($payrollData,"");
            unset($payrollData[0]);

            return  $payrollData;
            
        }

        function payrollArray($conn, $transid) {  /* school payroll array information */

            global $payrollTB, $foreal, $i_false;		
                    
            $ebele_mark = "SELECT pid, acc, staff, bursar, transid, salary, nsalary, tax, ded1, earn1, ded2, earn2, 
            ded3, earn3, pmethod, details, dpaid, transact, upload, status
                    
                            FROM $payrollTB 
            
                            WHERE transid = :transid";

            $igweze_prep = $conn->prepare($ebele_mark);
            $igweze_prep->bindValue(':transid',  $transid);
            $igweze_prep->execute();

            $rows_count = $igweze_prep->rowCount();

            if($rows_count >= $foreal) {

                while($payrollArray[] = $igweze_prep->fetch(PDO::FETCH_ASSOC)) { }
                
                array_unshift($payrollArray,"");
                unset($payrollArray[0]);
            
            }else{

                $payrollArray = '';

            }
		 
            return $payrollArray;
                
        }

		function payrollInfo($conn, $pid) {  /* school payroll array information */

            global $payrollTB;

            $payrollData = $conn->query("SELECT pid, acc, staff, bursar, transid, salary, nsalary, tax, ded1, earn1, ded2, earn2, 
            ded3, earn3, pmethod, details, dpaid, transact, upload, status

                                            FROM $payrollTB
                                            
                                            WHERE  pid = $pid")->fetchAll(PDO::FETCH_ASSOC);
                                            
            array_unshift($payrollData,"");
            unset($payrollData[0]);

            return  $payrollData;
            
        }

		function staffPayroll($conn, $staff) {  /* school payroll array information */

            global $payrollTB;

            $payrollData = $conn->query("SELECT pid, acc, staff, bursar, transid, salary, nsalary, tax, ded1, earn1, ded2, earn2, 
            ded3, earn3, pmethod, details, dpaid, transact, upload, status

                                            FROM $payrollTB
                                            
                                            WHERE  staff = $staff
											
											ORDER BY pid DESC")->fetchAll(PDO::FETCH_ASSOC);
                                            
            array_unshift($payrollData,"");
            unset($payrollData[0]);

            return  $payrollData;
            
        }

 

        function payrollDataRange($conn, $startDate, $endDate) {  /* school payroll range array */

            global $payrollTB, $foreal, $i_false;		
                    
            $ebele_mark = "SELECT pid, acc, staff, bursar, transid, salary, nsalary, tax, ded1, earn1, ded2, earn2, 
            ded3, earn3, pmethod, details, dpaid, transact, upload, status
                    
                            FROM $payrollTB 
            
                            WHERE (dpaid BETWEEN :start_date AND :end_date)
							
							ORDER BY pid DESC";

            $igweze_prep = $conn->prepare($ebele_mark);
            $igweze_prep->bindValue('start_date',  $startDate, PDO::PARAM_STR);
            $igweze_prep->bindValue('end_date',  $endDate, PDO::PARAM_STR);
            $igweze_prep->execute();

            $rows_count = $igweze_prep->rowCount();

            if($rows_count >= $foreal) {

                while($payrollDataArr[] = $igweze_prep->fetch(PDO::FETCH_ASSOC)) { }
                
                array_unshift($payrollDataArr,"");
                unset($payrollDataArr[0]);
            
            }else{

                $payrollDataArr = '';

            }
		 
            return $payrollDataArr;
                
        }

		function expensesData($conn) {  /* school expenses array */

			global $fobrainExpenseTB, $fiVal;

			$expensesData = $conn->query("SELECT eid, pid, title, payee, acc, expense, total, method, tags, memo, edate, rtime, status

											FROM $fobrainExpenseTB
											
											ORDER BY eid DESC")->fetchAll(PDO::FETCH_ASSOC);
											
			array_unshift($expensesData,"");
			unset($expensesData[0]);

			return  $expensesData;
			
		}

		function expensesInfo($conn, $eid) {  /* school expenses information */

			global $fobrainExpenseTB;

			$expensesData = $conn->query("SELECT eid, pid, title, payee, acc, expense, total, method, tags, memo, edate, rtime, status

											FROM $fobrainExpenseTB
											
											WHERE  eid = $eid")->fetchAll(PDO::FETCH_ASSOC);
											
			array_unshift($expensesData,"");
			unset($expensesData[0]);

			return  $expensesData;
			
		} 

		function expensesDataRange($conn, $startDate, $endDate) {  /* school expenses range array */

			global $fobrainExpenseTB, $foreal, $i_false;		
					
			$ebele_mark = "SELECT eid, pid, title, payee, acc, expense, total, method, tags, memo, edate, rtime, status
					
							from $fobrainExpenseTB 
			
							WHERE (edate BETWEEN :start_date AND :end_date)
							
							ORDER BY eid DESC";
							

			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue('start_date',  $startDate, PDO::PARAM_STR);
			$igweze_prep->bindValue('end_date',  $endDate, PDO::PARAM_STR);
			$igweze_prep->execute();

			$rows_count = $igweze_prep->rowCount();

			if($rows_count >= $foreal) {

				while($expensesDataArr[] = $igweze_prep->fetch(PDO::FETCH_ASSOC)) { }
				
				array_unshift($expensesDataArr,"");
				unset($expensesDataArr[0]);
			
			}else{

				$expensesDataArr = '';

			}

			return $expensesDataArr;
				
		}

		function expensesChartData($conn, $startDate, $endDate) {  /* school expenses chart information */

			global $fobrainExpenseTB, $foreal, $i_false;		
							
			$ebele_mark = "SELECT total from $fobrainExpenseTB 
			
							WHERE edate BETWEEN :start_date AND :end_date";

			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue('start_date',  $startDate);
			$igweze_prep->bindValue('end_date',  $endDate);
			$igweze_prep->execute();

			$rows_count = $igweze_prep->rowCount();
			
			$total = 0;

			if($rows_count >= $foreal) {

				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {

					$total += preg_replace("/[^0-9.]/", "", $row['total']);

				}
			
			}else{

				$total = $i_false;

			}

			return $total;


		}
		
		function feesIncomeChartData($conn, $startDate, $endDate) { /* school fees chart information */

			global $fobrainFeesTB, $foreal, $i_false, $seVal;		
							
			$ebele_mark = "SELECT feeAmount from $fobrainFeesTB 
			
							WHERE 
							
							date BETWEEN :start_date AND :end_date
							
							AND pstatus = :pstatus";

			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue('start_date', $startDate);
			$igweze_prep->bindValue('end_date', $endDate);
			$igweze_prep->bindValue(':pstatus', $seVal);
			$igweze_prep->execute();

			$rows_count = $igweze_prep->rowCount();
			
			$eAmount = 0;

			if($rows_count >= $foreal) {

				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {

					$eAmount += preg_replace("/[^0-9.]/", "", $row['feeAmount']);

				}
			
			}else{

				$eAmount = $i_false;

			}
			
			return $eAmount;
		} 

		function productCategoryData($conn) {   /* school products category array */

			global $productCategoryTB, $fiVal;

			$productCategoryData = $conn->query("SELECT p_id, product, status

											FROM $productCategoryTB")->fetchAll(PDO::FETCH_ASSOC);
											
			array_unshift($productCategoryData,"");
			unset($productCategoryData[0]);

			return  $productCategoryData;
			
		}

		function productCategoryInfo($conn, $pID) {  /* school products category information */

			global $productCategoryTB;

			$productCategoryData = $conn->query("SELECT p_id, product, status

											FROM $productCategoryTB
											
											WHERE  p_id = $pID")->fetchAll(PDO::FETCH_ASSOC);
											
			array_unshift($productCategoryData,"");
			unset($productCategoryData[0]);

			return  $productCategoryData;
			
		}		 

		function productsData($conn) {  /* select products array */

			global $fobrainProductTB, $fiVal;

			$productsData = $conn->query("SELECT pID, cat_id, p_price, p_title, p_description, p_date, p_status

											FROM $fobrainProductTB")->fetchAll(PDO::FETCH_ASSOC);
											
			array_unshift($productsData,"");
			unset($productsData[0]);

			return  $productsData;
			
		}

		function productsInfo($conn, $pID) {  /* select products information*/

			global $fobrainProductTB;

			$productsData = $conn->query("SELECT pID, cat_id, p_price, p_title, p_description, p_date, p_status

											FROM $fobrainProductTB
											
											WHERE  pID = $pID")->fetchAll(PDO::FETCH_ASSOC);
											
			array_unshift($productsData,"");
			unset($productsData[0]);

			return  $productsData;

		}		 

		function productInfo($conn, $productID) {  /* school products information*/

			global $fobrainProductTB, $foreal, $fake;

			$ebele_mark = "SELECT pID, p_title, p_date, p_price, p_description
			
								FROM $fobrainProductTB
								
								WHERE pID = :pID"; 

			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue(':pID', $productID);
			$igweze_prep->execute();
			$rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count == $foreal) {
			
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
				
					$p_id = $row['pID'];
					$p_title = $row['p_title'];
					$p_date = $row['p_date'];
					$p_price = $row['p_price'];
					$p_description = $row['p_description'];
				}   


				$productInfo = $p_id.'@(.$*S*$.)@'.$p_title.'@(.$*S*$.)@'.$p_date.'@(.$*S*$.)@'.$p_price.'@(.$*S*$.)@'.$p_description;

			}else{ 

				$productInfo = $fake; 

			}

			return $productInfo; 

		}

		function productCategory($conn, $cID) {  /* school products category information*/

			global $fobrainProductTB;

			$productsData = $conn->query("SELECT pID, cat_id, p_price, p_title, p_description, p_date, p_status

											FROM $fobrainProductTB
											
											WHERE  cat_ID = $cID")->fetchAll(PDO::FETCH_ASSOC);
											
			array_unshift($productsData,"");
			unset($productsData[0]);

			return  $productsData;
			
		}

		function productPictureArr($conn, $pID) {  /* school products pictures */

			global $fobrainProductPicTB;

			$pictureArr = $conn->query("SELECT pic_id, picture

											FROM $fobrainProductPicTB
											
											WHERE  p_id = $pID")->fetchAll(PDO::FETCH_ASSOC);
											
			array_unshift($pictureArr,"");
			unset($pictureArr[0]);

			return  $pictureArr;
			
		}

		function transactionTotal($conn, $transID){  /* school total transaction information*/

			global $fobrainOrderSummTB, $fiVal; $transTotal = 0;

			$ebele_mark = "SELECT  qty, price
			
							FROM $fobrainOrderSummTB 
							
							WHERE order_id  = :order_id";
					
			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue(':order_id', $transID);							 
			$igweze_prep->execute();
			
			$rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count >= $fiVal) {
			
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
										
					$qty = $row['qty'];
					$price = $row['price'];										

					$subtotal = ($price * $qty);
					$transTotal +=  $subtotal;

					$subtotal = "";
				} 
				
			}else{
				
				$transTotal = "";
				
			}

			return $transTotal;			

		}	 
						
		function clientOrdersChartData($conn, $startDate, $endDate) {  /* client order chart information*/

			global $fobrainOrderTB, $fobrainOrderSummTB, $foreal, $i_false, $seVal;						
			
			$ebele_mark = "SELECT order_id
			
							from  $fobrainOrderTB 
				
							WHERE orderDate 
							
							BETWEEN :start_date AND :end_date	
							
							AND status = :status";

			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue('start_date', $startDate);
			$igweze_prep->bindValue('end_date', $endDate);
			$igweze_prep->bindValue(':status', $seVal);
			$igweze_prep->execute();

			$rows_count = $igweze_prep->rowCount();

			$eAmount = 0;

			if($rows_count >= $foreal) {

				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {

					$order_id = trim($row['order_id']);
					$eAmount += transactionTotal($conn, $order_id);

				}
			
			}else{

				$eAmount = $i_false;

			}

			return $eAmount; 

		} 

		function fobrainCurrency($money, $curSymbol){  /* school currency information*/ 

			if($money != ""){
				$rMoney = round($money, 2);
				$nMoney = number_format($rMoney, 2);
				return $curSymbol.$nMoney; 
			}else{
				return $curSymbol.'0.00';
			}

		}  	

		function broadcastData($conn) {  /* school annoucement/broadcast array */

			global $fobrainBroadcastTB, $fiVal;

			$broadcastData = $conn->query("SELECT bID, bTitle, broadcastMsg, date

											FROM $fobrainBroadcastTB
											
											ORDER BY bID DESC")->fetchAll(PDO::FETCH_ASSOC);
											
			array_unshift($broadcastData,"");
			unset($broadcastData[0]);

			return  $broadcastData;

		}

		function broadcastInfo($conn, $bID) {  /* school annoucement/broadcast information */

			global $fobrainBroadcastTB;

			$broadcastData = $conn->query("SELECT bID, bTitle, broadcastMsg, date

											FROM $fobrainBroadcastTB
											
											WHERE  bID = $bID")->fetchAll(PDO::FETCH_ASSOC);
											
			array_unshift($broadcastData,"");
			unset($broadcastData[0]);

			return  $broadcastData;

		}    

		function gradeData($conn) {  /* school grade array */

			global $fobrainGradeTB, $fiVal;

			$gradeData = $conn->query("SELECT gID, fromGrade, toGrade, grade

											FROM $fobrainGradeTB
											
											ORDER BY gID DESC")->fetchAll(PDO::FETCH_ASSOC);
											
			array_unshift($gradeData,"");
			unset($gradeData[0]);

			return  $gradeData;

		}

		function gradeDataArr($conn) {  /* school grade array */

			global $fobrainGradeTB, $fiVal;

			$gradeDataArr = gradeData($conn);  /* school grade array */ 
			$gradeDataCount = count($gradeDataArr);

			for($i = $fiVal; $i <= $gradeDataCount; $i++){  /* loop array */	
					
				$gID = $gradeDataArr[$i]["gID"]; 
				$fromGrade = $gradeDataArr[$i]["fromGrade"];
				$toGrade = $gradeDataArr[$i]["toGrade"]; 
				$grade = $gradeDataArr[$i]["grade"]; 
				
				$gradeArray[$grade] = range($fromGrade, $toGrade); 						
			}

			return $gradeArray;	 

		}

		function fobrainGradeScore ($gradeArray, $score){ /* student grades score */
			$score = round($score);
			foreach($gradeArray as $k => $v){ 
				if(in_array($score, $v)){ 
					$grade = $k; 
					return $grade;
				} 
			}  
		}

		function gradeInfo($conn, $gID) {  /* school grade information */

			global $fobrainGradeTB;

			$gradeData = $conn->query("SELECT gID, fromGrade, toGrade, grade

											FROM $fobrainGradeTB
											
											WHERE  gID = $gID")->fetchAll(PDO::FETCH_ASSOC);
											
			array_unshift($gradeData,"");
			unset($gradeData[0]);

			return  $gradeData;

		}   				

		function studentName($conn, $stu_reg) {  /* students name information  */ 

			global $i_reg_tb, $foreal, $i_student_tb;

			$ebele_mark = "SELECT r.ireg_id, s.i_firstname, i_lastname, i_midname

							FROM $i_reg_tb r, $i_student_tb s

							WHERE nk_regno = :nk_regno
							
							AND r.ireg_id = s.ireg_id";
					
			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue(':nk_regno', $stu_reg);				 
			$igweze_prep->execute();
			
			$rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count == $foreal) {
			
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		

					$finame = $row['i_firstname'];
					$laname = $row['i_lastname'];
					$mname = $row['i_midname']; 

				}

				$finame = stripslashes($finame);
				$laname = stripslashes($laname);
				$mname  = stripslashes($mname); 
				 

				if($mname != ""){
					$mname = substr($mname, 0, 1). ".";
				}
				
				$name_full = "$laname $finame $mname";
				$name_full = ucwords($name_full); 
				
				if  ( (is_null($finame)) AND (is_null($laname)) ){ $name_full = "-"; } 
			
			}else{

				$name_full = "-"; 

			}
			
			return $name_full;

		}

		function studentData($conn, $stu_reg) {  /* students record information  */ 

			global $i_reg_tb, $foreal, $i_student_tb, $schoolSessionTB;

			$ebele_mark = "SELECT r.ireg_id, s.i_firstname, i_lastname, i_midname, i_stupic, i_dob,
							i_gender, height, weight, y.year 

							FROM $i_reg_tb r, $i_student_tb s, $schoolSessionTB y

							WHERE nk_regno = :nk_regno
							
							AND r.ireg_id = s.ireg_id
							
							AND r.session_id = y.ID_SESS";
					
			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue(':nk_regno', $stu_reg);				 
			$igweze_prep->execute();
			
			$rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count == $foreal) {
			
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		

					$fname = $row['i_firstname'];
					$lname = $row['i_lastname'];
					$mname = $row['i_midname'];
					$gender = $row['i_gender'];
					$i_dob = $row['i_dob'];
					$height = $row['height'];
					$weight = $row['weight'];
					$pic = $row['i_stupic']; 
					$session = $row['year'];

					if($mname != ""){
						$mname_f = substr($mname, 0, 1). ".";
					}

					if($gender != ""){
						$gender = substr($gender, 0, 1);
					}
					
					$name_full = ucwords("$lname $fname $mname_f");  
										
				}	 

				$bio_data = $lname.'@+@'.$fname.'@+@'.$mname.'@+@'.$pic.'@+@'.$gender.'@+@'.$i_dob.'@+@'.$height.'@+@'.$weight.'@+@'.$session.'@+@'.$name_full; 
			
			}else{ 
				 
				$lname = ""; $fname = ""; $mname = "";
				$name_full = ""; $pic = ""; $gender = ""; $i_dob = ""; $height = ""; $weight = ""; $session = "";
				$bio_data = $lname.'@+@'.$fname.'@+@'.$mname.'@+@'.$pic.'@+@'.$gender.'@+@'.$i_dob.'@+@'.$height.'@+@'.$weight.'@+@'.$session.'@+@'.$name_full;

			} 
			
			return $bio_data;

		}

		function billingData($conn, $stu_reg) {  /* students billing information  */ 

			global $i_reg_tb, $foreal, $i_student_tb;

			$ebele_mark = "SELECT r.ireg_id, s.i_firstname, i_lastname, i_midname, i_add_fi, i_city, i_state, 
								i_country, i_spo_phone, i_email 

							FROM $i_reg_tb r, $i_student_tb s

							WHERE nk_regno = :nk_regno
							
							AND r.ireg_id = s.ireg_id";
					
			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue(':nk_regno', $stu_reg);				 
			$igweze_prep->execute();
			
			$rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count == $foreal) {
			
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		

					$finame = $row['i_firstname'];
					$laname = $row['i_lastname'];
					$miname = $row['i_midname'];
					$i_add_fi = $row['i_add_fi'];
					$i_city = $row['i_city'];
					$i_state = $row['i_state'];
					$country = $row['i_country'];
					$phone = $row['i_spo_phone'];
					$phone = $row['i_spo_phone'];
					$email = $row['i_email'];			   		   					   
										
				}	
				
				$name_full = "$laname $finame $miname";
				$name_full = ucwords($name_full);

				if  ( (is_null($finame)) && (is_null($laname)) ){ $name_full = "-"; }			   
				
				if  (is_null($i_add_fi)){ $i_add_fi = "-"; }

				if  (is_null($i_city)){ $i_city = "-"; }

				if  (is_null($i_state)){ $i_state = "-"; }
				
				if  (is_null($country)){ $country = "-"; }
				
				if  (is_null($phone)){ $phone = "-"; } 

				if  (is_null($email)){ $email = "-"; } 

				$billingData = "$name_full##$i_add_fi##$i_city##$i_state##$country##$phone##$email"; 
			
			}else{

				$name_full = "-"; $ $i_add_fi = "-";  $i_city = "-"; $i_state = "-"; $country = "-"; $phone = "-";
				$billingData = "$name_full##$i_add_fi##$i_city##$i_state##$country##$phone##$email";

			}
			
			return $billingData;

		}

		function studentToken($conn) {  /* students token record information  */ 

			global $i_reg_tb, $foreal, $i_student_tb, $school_pic_dir, $wiz_default_img;			

			$ebele_mark = "SELECT r.nk_regno, session_id, s.i_firstname, i_lastname, i_midname, i_stupic
			
							FROM $i_reg_tb r INNER JOIN $i_student_tb s
			
							ON (r.ireg_id = s.ireg_id)

							AND r.active = :foreal";
					
			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue(':foreal', $foreal, PDO::PARAM_STR);
			$igweze_prep->execute();
			
			$rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count >= $foreal) { 
			
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		

					$regNum = $row['nk_regno'];
					$fname = $row['i_firstname'];
					$lname = $row['i_lastname'];
					$mname = $row['i_midname']; 
					$pic = $row['i_stupic']; 
					$sess_id = $row['session_id']; 

					//$sess_id = studentRegSessionID($conn, $regNum);
					$session_fi = fobrainSession($conn, $sess_id); 
					$session_se = $session_fi + $foreal;  

					$student_img = picture($school_pic_dir.$session_fi.'_'.$session_se.'/', $pic, "student"); 					
					$student_name = "$lname $fname $mname";	 
					$student_name = trim($student_name);	 

					$selected = "";

					echo  '<option value="'.$regNum.'"'.$selected.' data-src="'.$student_img.'"> Name: '.$student_name.' Reg: '.$regNum.'</option>' ."\r\n"; 
				 
				}
				
				 
			}else{

				echo  '<option value="" data-src="'.$wiz_default_img.'"> No Student records was found</option>' ."\r\n"; 

			} 
			
			 
		}
		
		function studentOptions($conn, $sessionID, $type){  /* student dropdown select option field */

			global $i_student_tb, $i_reg_tb, $foreal, $fiVal, $seVal, $wiz_default_img, $school_pic_dir; $options = "";
			$selected = "";

			$nk_class = studentClassLevel($level);
				
			if($type == $fiVal){
					
				$ebele_mark = "SELECT r.ireg_id, nk_regno, $nk_class, s.stu_id, i_stupic, i_firstname, i_lastname, i_midname
				
								FROM $i_reg_tb r INNER JOIN $i_student_tb s
				
								ON (r.ireg_id = s.ireg_id)

								AND r.session_id = :session_id 
							
								AND r.$nk_class = :class

								AND r.active = :foreal";
						
				$igweze_prep = $conn->prepare($ebele_mark);
				$igweze_prep->bindValue(':session_id', $sessionID, PDO::PARAM_STR);				
				$igweze_prep->bindValue(':foreal', $foreal, PDO::PARAM_STR);				
				$igweze_prep->bindValue(':class', $class, PDO::PARAM_STR);		
				
			}else{
				
				$ebele_mark = "SELECT r.ireg_id, nk_regno, $nk_class, s.stu_id, i_stupic, i_firstname, i_lastname, i_midname
				
								FROM $i_reg_tb r INNER JOIN $i_student_tb s
				
								ON (r.ireg_id = s.ireg_id)

								AND r.session_id = :session_id 

								AND r.active = :foreal";
						
				$igweze_prep = $conn->prepare($ebele_mark);
				$igweze_prep->bindValue(':session_id', $sessionID, PDO::PARAM_STR);				
				$igweze_prep->bindValue(':foreal', $foreal, PDO::PARAM_STR);	
				
			}		
			
			$igweze_prep->execute();
			
			$rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count >= $foreal) {
				
				$session_fi = fobrainSession($conn, $sessionID); 
				$session_se = $session_fi + $foreal; 
		
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		

					$regNum = $row['nk_regno'];
					$regID = $row['ireg_id'];
					$fname = $row['i_firstname'];
					$lname = $row['i_lastname'];
					$mname = $row['i_midname'];
					$class = $row[$nk_class];
					$pic = $row['i_stupic']; 
					
					$studentData = $regID.'@::@'.$regNum.'@::@'.$sessionID.'@::@'.$class; 
					$student_img = picture($school_pic_dir.$session_fi.'_'.$session_se.'/', $pic, "student");
					$student_info = "$lname $fname $mname $regNum";
					
					$options .= '<option value="'.$studentData.'"'.$selected.' data-src="'.$student_img.'"> '.$student_info.'</option>' ."\r\n"; 					 
			
				}
			
			}else{ 
						 
				$options = '<option value=""  data-src="'.$wiz_default_img.'"> No student record found</option>' ."\r\n";				
				
			} 

			echo $options;
			
		}


		function activeStudentOptions($conn){  /* student dropdown select option field */

			global $i_student_tb, $i_reg_tb, $foreal, $fiVal, $seVal, $wiz_default_img, $school_pic_dir; $options = "";
			$selected = ""; 
			 
					
			$ebele_mark = "SELECT r.ireg_id, nk_regno, session_id, s.stu_id, i_stupic, i_firstname, i_lastname, i_midname
			
							FROM $i_reg_tb r INNER JOIN $i_student_tb s
			
							ON (r.ireg_id = s.ireg_id)  

							AND r.active = :foreal";
					
			$igweze_prep = $conn->prepare($ebele_mark); 			
			$igweze_prep->bindValue(':foreal', $foreal, PDO::PARAM_STR);	  
			 
			$igweze_prep->execute();
			
			$rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count >= $foreal) { 
		
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		

					$regNum = $row['nk_regno'];
					$regID = $row['ireg_id'];
					$sessionID = $row['session_id'];
					$fname = $row['i_firstname'];
					$lname = $row['i_lastname'];
					$mname = $row['i_midname']; 
					$pic = $row['i_stupic'];

					$session_fi = fobrainSession($conn, $sessionID); 
					$session_se = $session_fi + $foreal;
					
					
					$studentData = $regID.'@'.$regNum;
					$student_img = picture($school_pic_dir.$session_fi.'_'.$session_se.'/', $pic, "student");
					$student_info = "$lname $fname $mname $regNum";
					
					$options .= '<option value="'.$studentData.'"'.$selected.' data-src="'.$student_img.'"> '.$student_info.'</option>' ."\r\n"; 					 
			
				}
			
			}else{ 
						 
				$options = '<option value=""  data-src="'.$wiz_default_img.'"> No student record found</option>' ."\r\n";				
				
			} 

			return $options;
			
		}

		function studentSelectBox($conn, $student_arr, $students, $option) {  /*  student select options */ 

			global $wiz_default_img, $school_pic_dir; $options = "";  $selected = "";
		
			if(is_array($student_arr)){
		
				$student_count = count($student_arr); 	 
		
				if($option == true){
					$student_list = implode(', ', $students);
					list ($student_1, $student_2, $student_3, $student_4, $student_5, $student_6) = explode (",", $student_list);
				}
							
				for($i = 1; $i <= $student_count; $i++){  /* loop array */ 
		
					$regNum = $student_arr[$i]['nk_regno'];
					$regID = $student_arr[$i]['ireg_id'];
					$sessionID = $student_arr[$i]['session_id'];
					$fname = $student_arr[$i]['i_firstname'];
					$lname = $student_arr[$i]['i_lastname'];
					$mname = $student_arr[$i]['i_midname']; 
					$pic = $student_arr[$i]['i_stupic'];  
		
					$session_fi = fobrainSession($conn, $sessionID); 
					$session_se = $session_fi + $foreal; 
		
					$student_img = picture($school_pic_dir.$session_fi.'_'.$session_se.'/', $pic, "student");
		
					$student_info = "$lname $fname $mname $regNum"; 
		
					if($option == true){
		
						if(trim($student_1) == $regNum){
		
							$selected = "SELECTED";
		
						}elseif(trim($student_2) == $regNum){
		
							$selected = "SELECTED";
		
						}elseif(trim($student_3) == $regNum){
		
							$selected = "SELECTED";
		
						}elseif(trim($student_4) == $regNum){
		
							$selected = "SELECTED";
		
						}elseif(trim($student_5) == $regNum){
		
							$selected = "SELECTED";
		
						}elseif(trim($student_6) == $regNum){
		
							$selected = "SELECTED";
		
						}else{
		
							$selected = "";
		
						}
					}else{
		
						if ($regNum == $students){
		
							$selected = "SELECTED";
		
						}else{
		
							$selected = "";
							
						} 
		
					} 
					
					$options .= '<option value="'.$regNum.'"'.$selected.' data-src="'.$student_img.'"> '.$student_info.'</option>' ."\r\n"; 					 
		
					
				
				} 
		
			}else{
		
				$options = '<option value=""  data-src="'.$wiz_default_img.'"> No student record found</option>' ."\r\n";
		
			} 
		
			return $options;
		
		} 

		function activeStudent($conn) {  /* students token record information  */ 

			global $i_reg_tb, $foreal, $i_student_tb;		 

			$active_student_arr = $conn->query("SELECT r.ireg_id, nk_regno, session_id, active, s.stu_id, i_stupic, i_firstname, i_lastname, i_midname

											FROM $i_reg_tb r INNER JOIN $i_student_tb s

											WHERE (r.ireg_id = s.ireg_id)

											AND r.active != 0")->fetchAll(PDO::FETCH_ASSOC);
									
			array_unshift($active_student_arr,"");
			unset($active_student_arr[0]);

			return  $active_student_arr; 
			 	

		}

		function studentSMSInfo($conn, $stu_reg) {  /* students SMS record information  */ 

			global $i_reg_tb, $foreal, $i_student_tb, $school_pic_dir, $wiz_default_img; 
			 
			$ebele_mark = "SELECT r.ireg_id, session_id, s.i_firstname, i_lastname, i_midname, i_stu_phone, i_spo_phone, i_stupic

							FROM $i_reg_tb r, $i_student_tb s

							WHERE nk_regno = :nk_regno
							
							AND r.ireg_id = s.ireg_id";
					
			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue(':nk_regno', $stu_reg);				 
			$igweze_prep->execute();
			
			$rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count == $foreal) {
			
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {	 

					$finame = trim($row['i_firstname']);
					$laname = trim($row['i_lastname']);
					$miname = trim($row['i_midname']);
					$pic = $row['i_stupic'];
					$stuPhone = trim($row['i_stu_phone']);
					$spoPhone = trim($row['i_spo_phone']); 
					$sess_id = $row['session_id'];  

				}

				//$sess_id = studentRegSessionID($conn, $regNum);
				$session_fi = fobrainSession($conn, $sess_id); 
				$session_se = $session_fi + $foreal;  
				 
				$name_full = "$laname $finame $miname";
				$name_full = ucwords($name_full); 

				$student_img = picture($school_pic_dir.$session_fi.'_'.$session_se.'/', $pic, "student"); 
				
				$stuInfo = $name_full.'@##@'.$stuPhone.'@##@'.$spoPhone.'@##@'.$student_img;	 
			
			}else{

				$stuInfo = ""; 

			} 
			
			return $stuInfo;

		}

		function studentMailInfo($conn, $stu_reg) {  /* students Mail record information  */ 

			global $i_reg_tb, $foreal, $i_student_tb, $school_pic_dir, $wiz_default_img; 

			$ebele_mark = "SELECT r.ireg_id, session_id, s.i_firstname, i_lastname, i_midname, i_email, i_spo_phone, i_stupic

							FROM $i_reg_tb r, $i_student_tb s

							WHERE nk_regno = :nk_regno
							
							AND r.ireg_id = s.ireg_id";
					
			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue(':nk_regno', $stu_reg);				 
			$igweze_prep->execute();
			
			$rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count == $foreal) {
			
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {	 

					$finame = trim($row['i_firstname']);
					$laname = trim($row['i_lastname']);
					$miname = trim($row['i_midname']);
					$pic = $row['i_stupic'];
					$mail = trim($row['i_email']);
					$spoPhone = trim($row['i_spo_phone']); 
					$sess_id = $row['session_id'];

				}  		
				
				//$sess_id = studentRegSessionID($conn, $stu_reg);
				$session_fi = fobrainSession($conn, $sess_id); 
				$session_se = $session_fi + $foreal;
				$name_full = "$laname $finame $miname";
				$name_full = ucwords($name_full); 

				$student_img = picture($school_pic_dir.$session_fi.'_'.$session_se.'/', $pic, "student"); 
				
				$stuInfo = $name_full.'@##@'.$mail.'@##@'.$spoPhone.'@##@'.$student_img;	 
			
			}else{

				$stuInfo = ""; 

			} 
			
			return $stuInfo;

		}

		function studentPicture($conn, $stu_reg) {  /* students picture */ 

			global $i_reg_tb, $i_student_tb, $wiz_default_img, $school_pic_dir, $foreal; 

			$ebele_mark = "SELECT r.ireg_id, session_id, s.i_stupic

							FROM $i_reg_tb r, $i_student_tb s

							WHERE nk_regno = :nk_regno
							
							AND r.ireg_id = s.ireg_id";
					
			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue(':nk_regno', $stu_reg);				 
			$igweze_prep->execute();
			
			$rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count == $foreal) {
			
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
				
					$pic = $row['i_stupic'];
					$sess_id = $row['session_id'];  
				
				} 
			} 
			 
			//$sess_id = studentRegSessionID($conn, $regNum);
			$session_fi = fobrainSession($conn, $sess_id); 
			$session_se = $session_fi + $foreal;  

			$student_img = picture($school_pic_dir.$session_fi.'_'.$session_se.'/', $pic, "student"); 

			return $student_img;

		} 

		function removeStudentPicture($conn, $stu_reg, $path, $field) {  /* remove students picture */  

			global $i_reg_tb, $i_student_tb;  global $foreal;

			$ebele_mark = "SELECT r.ireg_id, s.$field

							FROM $i_reg_tb r, $i_student_tb s

							WHERE nk_regno = :nk_regno
							
							AND r.ireg_id = s.ireg_id";
					
			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue(':nk_regno', $stu_reg);				 
			$igweze_prep->execute();
			
			$rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count == $foreal) {
			
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
				
					$pic = $row[$field];  

				} 

				removePicture($path, $pic); 

			}
			
		}  

		function studentParentLogin($conn, $stu_reg, $user) {  /* students password */ 

			global $i_reg_tb, $i_student_tb, $foreal; 

			$ebele_mark = "SELECT r.ireg_id, s.i_accesspass, i_sponsor_p

							FROM $i_reg_tb r, $i_student_tb s

							WHERE nk_regno = :nk_regno
							
							AND r.ireg_id = s.ireg_id";
					
			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue(':nk_regno', $stu_reg);				 
			$igweze_prep->execute();
			
			$rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count == $foreal) {
			
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		

					$regID = $row['ireg_id'];
					$studentPass = $row['i_accesspass'];
					$parentPass = $row['i_sponsor_p']; 
				} 

				if($user == 1){
					$accesspass = $regID.'{<?.@.?>}'.$parentPass;
				}else{
					$accesspass = $regID.'{<?.@.?>}'.$studentPass;
				} 

			}else{
				
				$accesspass = "";
				
			}	

			return $accesspass;

		}
		
		function studentParentPassword($conn, $stu_reg, $user) {  /* students password */ 

			global $i_reg_tb, $i_student_tb, $foreal; 

			$ebele_mark = "SELECT r.ireg_id, s.i_accesspass, i_sponsor_p

							FROM $i_reg_tb r, $i_student_tb s

							WHERE nk_regno = :nk_regno
							
							AND r.ireg_id = s.ireg_id";
					
			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue(':nk_regno', $stu_reg);				 
			$igweze_prep->execute();
			
			$rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count == $foreal) {
			
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
					$regID = $row['ireg_id'];
					$studentPass = $row['i_accesspass'];
					$parentPass = $row['i_sponsor_p']; 
				} 

				if($user == 1){
					$accesspass = $regID.'{<?.@.?>}'.$parentPass;
				}else{
					$accesspass = $regID.'{<?.@.?>}'.$studentPass;
				}  

			}else{
				
				$accesspass = "";
				
			}	

			return $accesspass;

		}

		function eWalletfobrain($conn, $cardpin) {  /* card pin e - wallet information */

			global $eWalletTB, $foreal; 
			
			$ebele_mark = "SELECT iiii_id, iiii_reg_id, iiii_reg, iiii_level, iiii_term, iiii_status

						FROM $eWalletTB  

						WHERE iiii_pin_iiii = :iiii_pin_iiii";
					
			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue(':iiii_pin_iiii', $cardpin);				 
			$igweze_prep->execute();
			
			$rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count == $foreal) {
			
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		

					$iiii_id  = $row['iiii_id'];
					$iiii_reg_id  = $row['iiii_reg_id'];
					$iiii_reg = $row['iiii_reg'];
					$iiii_level = $row['iiii_level'];
					$iiii_term = $row['iiii_term'];
					$iiii_status = $row['iiii_status'];
				}	
				
				$cardData =  $iiii_id.':@@:'.$iiii_reg_id.':@@:'.$iiii_reg.':@@:'.$iiii_level.':@@:'.$iiii_term.':@@:'.$iiii_status; 
			
			}else{

				$cardData = "";

			} 

			return  $cardData;
		}

		function eWalletCheckRecharge($conn, $regNum, $regID, $level, $term, $ewalletCheck) {  /* validate card pin e - wallet information */

			global $eWalletTB, $foreal, $fiVal, $seVal, $foVal; 
			
			if($ewalletCheck == $fiVal){
				
				$ebele_mark = "SELECT iiii_id, iiii_pin_iiii, iiii_time

									FROM $eWalletTB  
			
									WHERE 
									
									iiii_reg_id = :iiii_reg_id
									
									AND iiii_reg = :iiii_reg
									
									AND iiii_level = :iiii_level
									
									AND iiii_term = :iiii_term
									
									AND iiii_status = :iiii_status";
						
				$igweze_prep = $conn->prepare($ebele_mark);
				$igweze_prep->bindValue(':iiii_reg_id', $regID);
				$igweze_prep->bindValue(':iiii_reg', $regNum);
				$igweze_prep->bindValue(':iiii_level', $level);
				$igweze_prep->bindValue(':iiii_term', $term);
				$igweze_prep->bindValue(':iiii_status', $foreal);
				
			}else{
				
				$ebele_mark = "SELECT iiii_id, iiii_pin_iiii, iiii_time

									FROM $eWalletTB  
			
									WHERE 
									
									iiii_reg_id = :iiii_reg_id
									
									AND iiii_reg = :iiii_reg
									
									AND iiii_level = :iiii_level
									
									AND iiii_term = :iiii_term
									
									AND iiii_status = :iiii_status";
						
				$igweze_prep = $conn->prepare($ebele_mark);
				$igweze_prep->bindValue(':iiii_reg_id', $regID);
				$igweze_prep->bindValue(':iiii_reg', $regNum);
				$igweze_prep->bindValue(':iiii_level', $level);
				$igweze_prep->bindValue(':iiii_term', $foVal);
				$igweze_prep->bindValue(':iiii_status', $foreal);
				
			} 
			
			$igweze_prep->execute();
			
			$rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count == $foreal) { 

				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		

					$iiii_id  = $row['iiii_id'];
					$cardPin  = $row['iiii_pin_iiii'];
					$cardRTime  = $row['iiii_time'];
				}	
				
				$cardData = $iiii_id.':@@:'.$cardPin.':@@:'.$cardRTime.':@@:'.$foreal;
				
				
			}else{
				
				$cardData = "";

			} 

			return  $cardData;
		}  

		function cardPinData($conn) {  /* school cardPin array */

			global $eWalletTB, $fiVal;

			$ewallet = $conn->query("SELECT iiii_id, iiii_pin_iiii, iiii_serial_iiii, iiii_reg_id, iiii_reg, 
												iiii_stype, iiii_level, iiii_term, iiii_time, iiii_status

											FROM $eWalletTB
											
											ORDER BY iiii_id DESC")->fetchAll(PDO::FETCH_ASSOC);
											
			array_unshift($ewallet,"");
			unset($ewallet[0]);

			return  $ewallet;

		}

		function cardPinInfo($conn, $iiii_id) {  /* school cardPin information */

			global $eWalletTB; $iiii_id = clean($iiii_id);

			$ewallet = $conn->query("SELECT iiii_id, iiii_pin_iiii, iiii_serial_iiii, iiii_reg_id, iiii_reg, 
												iiii_stype, iiii_level, iiii_term, iiii_time, iiii_status

											FROM $eWalletTB
											
											WHERE  iiii_id = $iiii_id")->fetchAll(PDO::FETCH_ASSOC);
											
			array_unshift($ewallet,"");
			unset($ewallet[0]);

			return  $ewallet;

		}		
		
		function studentEWalletArr($conn, $regID, $reg) {  /* school cardPin information */

			global $eWalletTB; $regID = clean($regID); $reg = clean($reg);

			$ewallet = $conn->query("SELECT iiii_id, iiii_pin_iiii, iiii_serial_iiii, iiii_reg_id, iiii_reg, 
												iiii_stype, iiii_level, iiii_term, iiii_time, iiii_status

											FROM $eWalletTB
											
											WHERE  iiii_reg_id = $regID
									
											AND iiii_reg = '$reg'")->fetchAll(PDO::FETCH_ASSOC);
											
			array_unshift($ewallet,"");
			unset($ewallet[0]);

			return  $ewallet;

		}

		function libraryConfigsArrays($conn) {  /* school library book array */ 

			global $fobrainSchLibConfig;

			$libConfigsArray = $conn->query("SELECT c_id, book_no_apply, book_no_borrow, book_dateline
			
											FROM  $fobrainSchLibConfig")->fetchAll(PDO::FETCH_ASSOC);

			return  $libConfigsArray;
			
		} 

		function libraryBookInfo($conn, $bookID) {  /* school library book information */ 

			global $fobrainSchLib, $foreal, $i_false; 

			$ebele_mark = "SELECT book_id, book_name, book_author, book_path, book_type, book_status, stype, sclass, book_hits, book_copies,
							book_location
			

							FROM $fobrainSchLib

							WHERE book_id = :book_id";
					
			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue(':book_id', $bookID);
			$igweze_prep->execute();
			
			$rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count == $foreal) {
			
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		

					$book_id = $row['book_id'];
					$book_name = $row['book_name'];
					$book_path = $row['book_path'];
					$book_author = $row['book_author'];
					$book_type = $row['book_type'];
					$book_status = $row['book_status'];	
					$schoolID = $row['stype'];
					$sClassID = $row['sclass'];
					$book_hits = $row['book_hits'];
					$book_copies = $row['book_copies'];
					$book_location = $row['book_location']; 
					
				}
				
				$bookInfo = $book_id.'@.%.@'.$book_name.'@.%.@'.$book_path.'@.%.@'.$book_author.'@.%.@'.$book_type.'@.%.@'.$book_status
				.'@.%.@'.$schoolID.'@.%.@'.$sClassID.'@.%.@'.$book_hits.'@.%.@'.$book_copies.'@.%.@'.$book_location;
				
			}else{
				
				$bookInfo = '';				
			
			}
			
			return $bookInfo;	
			
		}

		function libraryBookTypeTotal($conn, $bookType) {  /* school library book type summary */ 

			global $fobrainSchLib, $foreal, $i_false; 

			$ebele_mark = "SELECT book_id, book_name, book_author, book_path, book_type, book_status

							FROM $fobrainSchLib

							WHERE book_type = :book_type";
					
			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue(':book_type', $bookType);
			$igweze_prep->execute();
			
			$rows_count = $igweze_prep->rowCount(); 
							
			return $rows_count;	

		}

		function libraryBookAppStatus($conn, $bookID, $regID, $schoolID) {  /* school library book application status */ 

			global $fobrainLibApplyTB, $foreal, $i_false; 

			$ebele_mark = "SELECT b_status, apply_date, approve_date, return_date

							FROM $fobrainLibApplyTB

							WHERE book_id = :book_id
							
								AND lib_user = :lib_user
								
								AND stype = :stype";
					
			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue(':book_id', $bookID);
			$igweze_prep->bindValue(':lib_user', $regID);
			$igweze_prep->bindValue(':stype', $schoolID);
			$igweze_prep->execute();
			
			$rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count == $foreal) {
				
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		

					$bookStatus = $row['b_status'];	
					$applyDate = $row['apply_date'];	
					$approveDate = $row['approve_date'];	
					$returnDate = $row['return_date'];	
					
				}
				
				$bookInfo = $bookStatus.'@.%.@'.$applyDate.'@.%.@'.$approveDate.'@.%.@'.$returnDate;
				
				
			}else{ 
				
				$bookInfo = '';
			
			} 
			
			return $bookInfo;	 

		}

		function libraryBookApplicationLimit($conn, $regID, $schoolID) {  /* check if student has exceeded book application limit */

			global $fobrainLibApplyTB, $foreal, $i_false, $infoMsg, $msgEnd; 		
			
			$libConfigsArray = libraryConfigsArrays($conn);
				
			$applyNum = $libConfigsArray[0]['book_no_apply'];

				$ebele_mark = "SELECT book_id

								FROM $fobrainLibApplyTB
							
								WHERE lib_user = :lib_user
								
								AND stype = :stype";
					
			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue(':lib_user', $regID);
			$igweze_prep->bindValue(':stype', $schoolID);
			$igweze_prep->execute();
			
			$rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count >= $applyNum) {
										
				$msg_i = "Ooops, you have exceeded the School Library Book application limit of  
				<strong>$applyNum</strong>. Meanwhile, you are not allowed apply for more books for now. Thanks";	
				
				echo $infoMsg.$msg_i.$iEnd;	 
				echo  "<script type='text/javascript'> $('html, body').animate({scrollTop:$('#scroll-target').position().top}, 'slow'); hidePageLoader(); </script>";
				exit;
				
			}

		}

		function libraryBookLendingLimit($conn, $regID, $schoolID) {  /* check if student has exceeded book application limit */

			global $fobrainLibApplyTB, $foreal, $seVal, $fiVal,$infoMsg, $msgEnd;		
			
			$libConfigsArray = libraryConfigsArrays($conn);
				
			$borrowNum = $libConfigsArray[0]['book_no_borrow'];

				$ebele_mark = "SELECT book_id

								FROM $fobrainLibApplyTB
							
								WHERE lib_user = :lib_user
								
								AND stype = :stype
								
								AND b_status = :b_status";
					
			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue(':lib_user', $regID);
			$igweze_prep->bindValue(':stype', $schoolID);
			$igweze_prep->bindValue(':b_status', $seVal);
			$igweze_prep->execute();
			
			$rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count >= $borrowNum) {
			
				$msg_i = "Ooops, this student have exceeded School Library Book lending limit of  
				<strong>$applyNum</strong> in his/her possesion. Meanwhile, He/She is not allowed to borrow more books at the
				moment. Thanks";						  					
				echo $infoMsg.$msg_i.$iEnd;	 exit;
				
			} 

		}


		function libraryUploadsManager($conn, $type, $picture) {  /* school library book upload manager */

			global $fiVal, $seVal, $fobrainLibDir, $validDocFormats,
			$wiz_df_word_img, $wiz_df_file_img, $wiz_df_pdf_img, $wiz_df_xls_img;
			
			if(($type == $fiVal) && ($picture != '')){				
				
				list($pic, $picExt) = explode(".", $picture);
				
				if($picExt == ''){
					
					$bookPicture = $wiz_df_file_img;
					
				}else{
					
					if(($picExt == 'doc') || ($picExt == 'docx')){
						
						$bookPicture = $wiz_df_word_img;
						
					}elseif(($picExt == 'xls') || ($picExt == 'xlsx')){
						
						$bookPicture = $wiz_df_xls_img;
					
					}elseif($picExt == 'pdf'){
						
						$bookPicture = $wiz_df_pdf_img;
					
					}elseif($picExt == 'txt'){
						
						$bookPicture = $wiz_df_file_img;
					
					}else{
						
						$bookPicture = $wiz_df_file_img;
					
					} 
					
				}
				
			
			}elseif(($type == $seVal) && ($picture != '')){
				
				list($pic, $picExt) = explode(".", $picture);
				
				if(in_array($picExt, $validDocFormats)) {
					
					$bookPicture = $wiz_df_file_img;
					
				}else{  

					$bookPicture = picture($fobrainLibDir, $picture, "doc");
				}
				
			}else{					
				
				$bookPicture = $wiz_df_file_img;
				
			} 
			
			return $bookPicture;
		}

		function libraryBookExceededLimitChecker($conn, $regID, $schoolID, $render) {  /* check if student has any expired library book in possession */

			global $fobrainLibApplyTB, $libDefaultTime, $foreal, $i_false, $seVal, $infoMsg, $iEnd; 

			if($render ==true){ $card_style = "";}
			else{ $card_style = "mb-25"; }

			$page_title = '<i class="mdi mdi-calendar-clock fs-18"></i> 
								Exceeded library Book/s';
			$title_1 = pageTitle2($page_title, 0);

$table_head =<<<IGWEZE

				<!-- row -->
				<div class="row gutters $card_style fobrain-section-div  animate__animated animate__zoomInUp" id="scroll-target">
					<div class="col-12">	
						<!-- card start -->
						<div class="card $card_style card-shadow">
							$title_1
							<div class="card-body">	

								<div class="table-responsive pt-3"> 
								
								<table  class='table table-hover table-responsive style-table wiz-table'>
								<thead>
									<tr><th>App. ID</th>
									<th>Book Details</th> 
									<th>Application Time</th> 
									<th>Approved Time</th> 
									<th>Status</th>
								</thead> 
								<tbody>
						
IGWEZE;

								$libConfigsArray = libraryConfigsArrays($conn);
								
								$timeDateline = $libConfigsArray[0]['book_dateline'];
								
								if($timeDateline == '') {$timeDateline = $libDefaultTime;} //AND sclass = :sclass

								$ebele_mark = "SELECT b_id, book_id, lib_user, lib_reg, apply_date, approve_date, stype
								
												FROM $fobrainLibApplyTB
												
												WHERE  approve_date	<= NOW() - INTERVAL $timeDateline
												
												AND b_status = :b_status 
																	
												AND stype = :stype
												
												AND lib_user = :lib_user
												
												ORDER BY b_id DESC";
									
								$igweze_prep = $conn->prepare($ebele_mark);
								$igweze_prep->bindValue(':b_status', $seVal);
								$igweze_prep->bindValue(':stype', $schoolID);
								$igweze_prep->bindValue(':lib_user', $regID);
								$igweze_prep->execute();
								
								$rows_count = $igweze_prep->rowCount();

								if($rows_count >= $foreal) {
									
									echo  $table_head;

									$msg_i = "School Library book/s is in your possession and  have exceeded the stiputaled School time limit of <strong>$timeDateline</strong>S. <br /> <br />Meanwhile, you are not allowed to borrow any other books until you return those book/s. Thanks";
										
									//echo $infoMsg.$msg_i.$iEnd;	  
									
									while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		

										$bookID = $row['book_id'];
										$applyID = $row['b_id'];
										$lib_user = $row['lib_user'];
										$lib_reg = $row['lib_reg'];
										$apply_date = $row['apply_date'];
										$approve_date = $row['approve_date'];
										$schoolID = $row['stype'];
										
										
										if($apply_date != ''){
											
											$apply_date = strtotime($apply_date);
											$apply_date = date("h:i:s, j M Y", $apply_date);
											
										}else{ $apply_date = ' - '; }

										if($approve_date != ''){
											
											$approve_date = strtotime($approve_date);
											$approve_date = date("h:i:s, j M Y", $approve_date);
											
										}else{ $approve_date = ' - '; }


										$bookInfo = libraryBookInfo($conn, $bookID);
										list ($bookLID, $bookName, $bookPath, $bookAuthor, $bookType, $bookStatusT, $schoolID, $sClassID, $bookHits, 
											$bookCopies, $bookLocation) = explode ("@.%.@", $bookInfo);
										
										$bookName  = trim($bookName);
										$bookAuthor  = trim($bookAuthor);

										$bookPicture = libraryUploadsManager($conn, $bookType, $bookPath);
										
										if($bookAuthor == '') { $bookAuthor = 'Anonymous'; } 
					
$bookInfo =<<<IGWEZE

										<tr> 
											<td> App-$applyID </td>						
											<td> 
												<div class="d-flex align-items-center me-15">
													<div class="flex-shrink-0 me-3">
														<img src = "$bookPicture" class=" img-h-50 img-circle img-thumbnail">
													</div>
													<div class="flex-grow-1">
														<h5>$bookName </h5>
														<p class="mb-0">by $bookAuthor</p>
													</div>
												</div>							  
											</td> 
											<td>$apply_date</td> 
											<td>$approve_date</td>
											<td> 
												<button class="btn btn-danger waves-effect btn-label waves-light">
													Exceeded
												</button> 
											</td>  
										</tr> 

IGWEZE;

					echo $bookInfo; 
			
				}
				
				echo  '					</tbody>
									</table> 
								</div>
							</div>
						</div>
						<!-- card end -->	
					</div>
				</div>
				<!-- / row -->						
				
				';
				if($render == true){
					echo  "<script type='text/javascript'> $('html, body').animate({scrollTop:$('#scroll-target').position().top}, 'slow'); hidePageLoader(); </script>";
					exit;
				}
				
			} 

		}  

		function mailData($conn) {  /* mail config array  */ 

			global $fobrainMailTB, $fiVal;
			
			$query = $conn->query("SELECT mID, send_host, send_name, send_pass, send_mail, footer, status
			
											FROM $fobrainMailTB")->fetchAll(PDO::FETCH_ASSOC);
											
			array_unshift($query,"");
			unset($query[0]);
			
			return  $query;

		}
			
		function mailInfo($conn, $mID) {  /* mail config information  */ 
			
			global $fobrainMailTB;
			
			$query = $conn->query("SELECT mID, send_host, send_name, send_pass, send_mail, footer, status
			
											FROM $fobrainMailTB
											
											WHERE  mID = $mID")->fetchAll(PDO::FETCH_ASSOC);
											
			array_unshift($query,"");
			unset($query[0]);
			
			return  $query;

		}

		function smsData($conn) {  /* text message and gateway array  */ 

			global $fobrainSMSTB, $fiVal;

			$smsData = $conn->query("SELECT sID, gateway, senderID, user, password, api, status

											FROM $fobrainSMSTB")->fetchAll(PDO::FETCH_ASSOC);
											
			array_unshift($smsData,"");
			unset($smsData[0]);

			return  $smsData;
		}

		function smsInfo($conn, $sID) {  /* text message and gateway information  */ 

			global $fobrainSMSTB;

			$smsData = $conn->query("SELECT sID, gateway, senderID, user, password, api, status

											FROM $fobrainSMSTB
											
											WHERE  sID = $sID")->fetchAll(PDO::FETCH_ASSOC);
											
			array_unshift($smsData,"");
			unset($smsData[0]);

			return  $smsData;
		}

		function smsCurrentGateway($conn) {  /* current text message and gateway information */ 

			global $fobrainSMSTB, $fiVal;

			$smsData = $conn->query("SELECT sID, gateway, senderID, user, password, api, status

											FROM $fobrainSMSTB
											
											WHERE  status = $fiVal")->fetchAll(PDO::FETCH_ASSOC);
											
			array_unshift($smsData,"");
			unset($smsData[0]);

			return  $smsData;
		} 

		function fobrainSendSMS($api, $senderID, $user, $password, $receiver, $sentMsg, $gType) {  /* send text message through current gateway */ 

			$user = urlencode($user); $password = urlencode($password); $api = urlencode($api);
			$receiver = urlencode($receiver); $sentMsg = urlencode($sentMsg);
			global $fiVal, $seVal, $thVal, $foVal;

			if($gType == $fiVal){
				
				$response =  send_1s2u($user, $password, $receiver, $sentMsg); 
				
			}elseif($gType == $seVal){
				 
				$response = file_get_contents('https://www.bulksmsnigeria.com/api/v1/sms/create?api_token='.
				$api.'&from='.$senderID.'&to='.$receiver.'&body='.$sentMsg);
				
				
			}elseif($gType == $thVal){ 

				$response = file_get_contents('https://smsclone.com/api/sms/sendsms?username='.$user.'& password='.
				$password.'&sender=@@'.$senderID.'@@&recipient=@@'.$receiver.'@@&message=@@'.$sentMsg.'@@');
				
			}else{

				$response = "";
				
			}	
			
			return $response;

		}  

		function fobrainSMSBalance($api, $user, $password, $gType) {  /* check text message balance  */ 

			$user = urlencode($user); $password = urlencode($password); $api = urlencode($api);

			global $fiVal, $seVal, $thVal, $foVal;

			if($gType == $fiVal){
				
				$smsBalance = file_get_contents('https://api.1s2u.io/checkbalance?user='.$user.'&pass='.$password); 
				
			}elseif($gType == $seVal){
				
				//$smsBalance = file_get_contents('http://www.bulksmsnigeria.net/components/com_spc/smsapi.php?username='.$user.'&password='.$password.'&balance=true&'); 
				
			}elseif($gType == $thVal){
				
				$smsBalance = file_get_contents('https://smsclone.com/api/sms/balance?username='.$user.'&password='.$password.'&balance=true'); 
				
			}else{
				
				$smsBalance = "";

			}	
			
			if($smsBalance == "") { $smsBalance = 0; }

			return $smsBalance;

		}  

		function gatewayPaymentData($conn) {  /* payment gateways array  */

			global $fobrainPayGatewayTB, $fiVal;

			$gatewayPaymentData = $conn->query("SELECT gID, gateway, gatewayVerb, gateKey 

											FROM $fobrainPayGatewayTB")->fetchAll(PDO::FETCH_ASSOC);
											
			array_unshift($gatewayPaymentData,"");
			unset($gatewayPaymentData[0]);

			return  $gatewayPaymentData;
			
		}

		function gatewayPaymentInfo($conn, $gID) {  /* payment gateways information */

			global $fobrainPayGatewayTB;

			$gatewayPaymentData = $conn->query("SELECT gID, gateway, gatewayVerb, gateKey 

											FROM $fobrainPayGatewayTB
											
											WHERE  gID = $gID")->fetchAll(PDO::FETCH_ASSOC);
											
			array_unshift($gatewayPaymentData,"");
			unset($gatewayPaymentData[0]);

			return  $gatewayPaymentData;
			
		} 
		
		
		function virtualGateway($conn) {  /* virtual gateways array  */

			global $fobrainVitualTB, $fiVal;

			$virtualGateway = $conn->query("SELECT gID, gateway, gatewayVerb, gateKey 

											FROM $fobrainVitualTB")->fetchAll(PDO::FETCH_ASSOC);
											
			array_unshift($virtualGateway,"");
			unset($virtualGateway[0]);

			return  $virtualGateway;
			
		}

		function virtualGatewayInfo($conn, $gID) {  /* virtual gateways information */

			global $fobrainVitualTB;

			$virtualGateway = $conn->query("SELECT gID, gateway, gatewayVerb, gateKey 

											FROM $fobrainVitualTB
											
											WHERE  gID = $gID")->fetchAll(PDO::FETCH_ASSOC);
											
			array_unshift($virtualGateway,"");
			unset($virtualGateway[0]);

			return  $virtualGateway;
			
		}
		
		function selectSchools($conn) {  /* Select Free Portal School List */

			global $schoolistsTB, $foreal; $status = 2;
			
			$ebele_mark = "SELECT sid, dbname, scodes, school
	
							FROM $schoolistsTB
	
							WHERE reg_status = :reg_status
							
							ORDER BY sid DESC";
					
			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue(':reg_status', $status);    
			$igweze_prep->execute();
			
			$rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count >= $foreal) {
			
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
						
					$sid = $row['sid'];
					$dbname = $row['dbname'];
					$school = $row['scodes'];             			
	
					echo "<option value=\"$sid\">$school</option>"."\r\n";
	
				}	
			
			}else{
			
				echo "<option value=''>Oooops, no school was found</option>"."\r\n";
			
			} 
	
		}
	
		function schoolDB($conn, $school) {  /* Select Free Portal School DB */

			global $schoolistsTB, $returnDB, $foreal; 

			if($school <= 500){

				return $returnDB;

			}
			
			$ebele_mark = "SELECT dbname
	
							FROM $schoolistsTB
							
							WHERE sid = :sid";
					
			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue(':sid', $school); 
			$igweze_prep->execute();
			
			$rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count == $foreal) {
			
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {
	
					$dbname = $row['dbname'];    
	
				}	
			
			}else{
			
				$dbname = "";
			
			} 
	
			return $dbname;
	
		}  

		function clientIP() {  /* user IP Address   */

			$ipaddress = '';
			
			if (getenv('HTTP_CLIENT_IP')) {
				
				$ipaddress = getenv('HTTP_CLIENT_IP');
				
			}elseif(getenv('HTTP_X_FORWARDED_FOR')){
				
				$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
				
			}elseif(getenv('HTTP_X_FORWARDED')){
				
				$ipaddress = getenv('HTTP_X_FORWARDED');
				
			}elseif(getenv('HTTP_FORWARDED_FOR')){
				
				$ipaddress = getenv('HTTP_FORWARDED_FOR');
				
			}elseif(getenv('HTTP_FORWARDED')){
				
				$ipaddress = getenv('HTTP_FORWARDED');
				
			}elseif(getenv('REMOTE_ADDR')){
				
				$ipaddress = getenv('REMOTE_ADDR');
				
			}else{
				
				$ipaddress = 'UNKNOWN';
				
			}	
			
			return $ipaddress;

		} 

		function timerBoy($session_time) {  /* time a go functions  */

			$time_difference = time() - $session_time;
			$seconds = $time_difference ;
			$minutes = round($time_difference / 60 );
			$hours = round($time_difference / 3600 );
			$days = round($time_difference / 86400 );
			$weeks = round($time_difference / 604800 );
			$months = round($time_difference / 2419200 );
			$years = round($time_difference / 29030400 );

			if($seconds <= 60)	{	
			
				$time = "$seconds seconds ago";  

			}elseif($minutes <=60){

				if($minutes == 1) { $time = "one minute ago"; }
				else {  $time = "$minutes minutes ago";  }
				
			} elseif($hours <=24) {
				
				if($hours==1) {  $time = "one hour ago"; }
				else {  $time = "$hours hours ago";  }
				
			} elseif($days <=7) {
				
				if($days==1) { $time = "one day ago"; }
				else { $time = "$days days ago"; }
			}  elseif($weeks <=4) {
				
				if($weeks==1) {  $time = "one week + ago"; }
				else  {  $time = "$weeks weeks ago"; }
				
			} elseif($months <=12) {
				
				if($months==1) { $time = "one month + ago"; }
				else { $time = "$months months ago"; }
				
			} else {
				
				if($years==1){ $time = "one year + ago"; }
				else{$time = "$years years ago";}
			}


			return $time;

		} 

		/**
		* Helper library for CryptoJS AES encryption/decryption
		* Allow you to use AES encryption on client side and server side vice versa
		*
		* @author BrainFooLong (bfldev.com)
		* @link https://github.com/brainfoolong/cryptojs-aes-php
		*/

		/**
		* Decrypt data from a CryptoJS json encoding string
		*
		* @param mixed $passphrase
		* @param mixed $jsonString
		* @return mixed
		*/
		function cryptoJsAesDecrypt($passphrase, $jsonString){  /* character decrypter */
			$jsondata = json_decode($jsonString, true);
			try {
				$salt = hex2bin($jsondata["s"]);
				$iv  = hex2bin($jsondata["iv"]);
			} catch(Exception $e) { return null; }
			$ct = base64_decode($jsondata["ct"]);
			$concatedPassphrase = $passphrase.$salt;
			$md5 = array();
			$md5[0] = md5($concatedPassphrase, true);
			$result = $md5[0];
			for ($i = 1; $i < 3; $i++) {
				$md5[$i] = md5($md5[$i - 1].$concatedPassphrase, true);
				$result .= $md5[$i];
			}
			$key = substr($result, 0, 32);
			$data = openssl_decrypt($ct, 'aes-256-cbc', $key, true, $iv);
			return json_decode($data, true);
		}

		/**
		* Encrypt value to a cryptojs compatiable json encoding string
		*
		* @param mixed $passphrase
		* @param mixed $value
		* @return string
		*/
		function cryptoJsAesEncrypt($passphrase, $value){  /* character encrypter */
			$salt = openssl_random_pseudo_bytes(8);
			$salted = '';
			$dx = '';
			while (strlen($salted) < 48) {
				$dx = md5($dx.$passphrase.$salt, true);
				$salted .= $dx;
			}
			$key = substr($salted, 0, 32);
			$iv  = substr($salted, 32,16);
			$encrypted_data = openssl_encrypt(json_encode($value), 'aes-256-cbc', $key, true, $iv);
			$data = array("ct" => base64_encode($encrypted_data), "iv" => bin2hex($iv), "s" => bin2hex($salt));
			return json_encode($data);
		}


		function igwezeFileUploader ($file_field, $path, $max_size, $validPicExt, $validPicType, $allowedFile, $fileType, $byePass) {
			/* file upload manager */

			global $randChars, $fiVal, $seVal;

			//$file_field = null;

			// Create an array to hold any output
			$out = array('error'=>null);

			if (!$file_field) {
				$out['error'][] = "Ooops, please upload a $fileType. Only $allowedFile is/are allowed.";           
			}

			if (!$path) {
				$out['error'][] = "Ooops, upload path is invalid";               
			}
			if(is_array($out['error'])){ 
				if (count($out['error'])>0) {
					return $out;
				}
			}
			//Make sure that there is a file
			if((!empty($_FILES[$file_field])) && ($_FILES[$file_field]['error'] == 0)) {
					
				$info = new finfo(FILEINFO_MIME_TYPE);
				
				$mime_type = $info->buffer(file_get_contents($_FILES[$file_field]['tmp_name']));
				$_FILES[$file_field]["type"];
				
				// Get filename 1st funtion
				$file_info = pathinfo($_FILES[$file_field]['name']);
				$name = $file_info['filename'];
				$ext = strtolower($file_info['extension']);

				//Check file has the right extension           
				if (!in_array($ext, $validPicExt)) {
					$out['error'][] = "Invalid a $fileType Extension, please upload a valid a $fileType extension. Only $allowedFile is/are allowed.";
				}

				//Check that the file is of the right type
				if ((!in_array($_FILES[$file_field]["type"], $validPicType)) || (!in_array($mime_type, $validPicType))){
					$out['error'][] = "Invalid b $fileType Type. Please upload a valid a $fileType type. Only $allowedFile is/are allowed.";
				}
				
				//Check that the file is not too big
				if ($_FILES[$file_field]["size"] > $max_size) {
					$out['error'][] = "$fileType maximum file allowed size is $max_size MB";
				}

				//If $check image is set as true
				if($byePass == $fiVal){
					if (!getimagesize($_FILES[$file_field]['tmp_name'])) {
						$out['error'][] = "Invalid $fileType, please upload a valid a $fileType. Only $allowedFile is/are allowed.";
					}
				}

				// Generate random filename
				$tmp = str_replace(array('.',' '), array('',''), microtime());

				if (!$tmp || $tmp == '') {
					$out['error'][] = "Invalid c $fileType Name, $fileType file must have a name";
				}    
					
				$randC = randomString($randChars, 6);				
				$newname = $tmp.$randC.'.'.$ext;     

				//Check if file already exists on server
				if (file_exists($path.$newname)) {
					$out['error'][] = "A file with this name already exists";
				}
				
				if(is_array($out['error'])){ 
					if (count($out['error'])>0) {
						//The file has not correctly validated
						return $out;
					}
				} else{ 
					
					$out['refilename'] = $newname;
					return $out;
					
				}	 
					

			} else {
				
				$out['error'][] = "Ooops, please upload d a $fileType. Only $allowedFile is/are allowed.";
				return $out;
				
			}      

		} 

		function fobrainDie($msg) {  /* fobrain Customize PHP Die() function */

			global $erroMsg, $msgEnd;

			$err = <<<END

			$erroMsg $msg $msgEnd

			END;

			echo $err; exit;

		}


		function wizMailer($to, $subject, $message, $from) {  /* fobrain Mailer */

			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
			$headers .= 'From: Africantab ' . $from . "\r\n";
			$headers .= 'Reply-To: ' .$from . "\r\n";
			$headers .= 'X-Mailer: PHP/' . phpversion();

			if(mail($to, $subject, $message, $headers)){
				return 1;
			} 
			return 0;
		}		


		function validateMail($str) {
			return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
		} 

		function encrypter($string, $encrypt_key){

			$ciphering = "AES-128-CTR";  $encrypt_iv = '1214547811015190'; 
			$iv_length = openssl_cipher_iv_length($ciphering); $options = 0;  
	
			return $encryption = openssl_encrypt($string, $ciphering, $encrypt_key, $options, $encrypt_iv);  
	
		}
		
		function decrypter($string, $decrypt_key){
	
			$ciphering = "AES-128-CTR";  $encrypt_iv = '1214547811015190'; 
			$iv_length = openssl_cipher_iv_length($ciphering); $options = 0;  
	
			return $decryption = openssl_decrypt ($string, $ciphering,  $decrypt_key, $options, $encrypt_iv); 
	
		}
		 
		function cleanInput($value, $type){ /* clean posted field */

			if($type == "text"){
				
				return trim(preg_replace("/[^A-Za-z0-9]/", "", $value));
				
			}elseif($type == "num"){
				
				return trim(preg_replace("/[^0-9]/", "", $value));

			}elseif($type == "phone"){
				
				return trim(preg_replace("/[^0-9+]/", "", $value));
				
			}elseif($type == "dob"){
				
				return trim(preg_replace("/[^A-Za-z0-9-]/", "", $value));
				
			}elseif($type == "email"){
				
				return trim(preg_replace("/[^A-Za-z0-9.@]/", "", $value));
				
			}elseif($type == "web"){
				
				return trim(preg_replace("/[^A-Za-z0-9]/", "", $value));
				
			}elseif($type == "msg"){
				
				return trim(preg_replace("/[^A-Za-z0-9]/", "", $value));
				
			}else{
				
				return trim(preg_replace("/[^A-Za-z0-9]/", "", $value));
				
			}	 
		}

		function clean($value){

			return trim(strip_tags($value));

		} 

		function cleanInt($value){ 
		 
			return trim(preg_replace("/[^0-9]/", "", $value));
	
		}

		function cleanData($value){

			return trim(strip_tags($value));

		}

		function cleanText($value){ /* clean posted field */

			return trim(preg_replace("/[^A-Za-z0-9]/", "", $value));

		}
		
		function cleanMultiLang($value){ /* clean posted field */

			return trim(preg_replace("~[^\p{L}\p{N}]+~u", " ", $value));
			//$value =  preg_replace("~[^\p{L}\p{N}]+~u", " ", $value);

		}

		function cleanPhoneNum($value){ /* clean posted field */

			return trim(preg_replace("/[^A-Za-z0-9+]/", "", $value));

		} 

		function cleanDate($value){ /* clean posted field */

			return trim(preg_replace("/[^0-9-]/", "", $value));

		}

		function cleanEmail($value){ /* clean posted field */
		
			return trim(preg_replace("/[^A-Za-z0-9@_.]/", "", $value));

		}

		function myFilter($var){
			return ($var !== NULL && $var !== FALSE && $var !== "");
		}

		function removeEmptyArr($array){
			foreach($array as $key => $value){
				if(empty($value)){
					unset($array[$key]); 
				}     
			}
			return $array;
		}


		function pageTitle($page_title, $type){


			if($type == 1){ 

$pg_header =<<<IGWEZE

			<div class="card-header-wiz animate__animated animate__zoomIn">  
				<div class="row align-items-center">
					<div class="col-9">
						<h4>
						$page_title
						</h4> 
					</div>
					<div class="col-3"> 
						<a href="javascript:;" class ="full-screen text-magenta pull-right ps-10">									
						<i class="mdi mdi-fullscreen"></i>  
						</a>
						<a href="javascript:;" class ="view-tree text-slateblue display-none pull-right">									
						<i class="mdi mdi-timeline-text"></i>  
						</a>	 
						<a href="javascript:;" class ="view-table text-danger pull-right">									
						<i class="mdi mdi-table-eye"></i>  
						</a>	 
					</div> 
				</div>			 
			</div>

IGWEZE;     

			}else{  

$pg_header =<<<IGWEZE

			<div class="card-header-wiz animate__animated animate__zoomIn">  
				<div class="row align-items-center">
					<div class="col-11">
						<h4>
						$page_title
						</h4> 
					</div>
					<div class="col-1"> 
						<a href="javascript:;" class ="full-screen text-magenta pull-right ps-10">									
							<i class="mdi mdi-fullscreen"></i>  
						</a>  
					</div> 
				</div>			 
			</div>

IGWEZE;           


			}

			echo $pg_header;

		}	

		function pageTitle2($page_title, $type){


			if($type == 1){ 

$pg_header =<<<IGWEZE

			<div class="card-header-wiz">  
				<div class="row align-items-center">
					<div class="col-9">
						<h4>
						$page_title
						</h4> 
					</div>
					<div class="col-3"> 
						<a href="javascript:;" class ="full-screen text-magenta pull-right ps-10">									
						<i class="mdi mdi-fullscreen"></i>  
						</a>
						<a href="javascript:;" class ="view-tree text-slateblue display-none pull-right">									
						<i class="mdi mdi-timeline-text"></i>  
						</a>	 
						<a href="javascript:;" class ="view-table text-danger pull-right">									
						<i class="mdi mdi-table-eye"></i>  
						</a>	 
					</div> 
				</div>			 
			</div>

IGWEZE;     

			}else{  

$pg_header =<<<IGWEZE

			<div class="card-header-wiz">  
				<div class="row align-items-center">
					<div class="col-11">
						<h4>
						$page_title
						</h4> 
					</div>
					<div class="col-1"> 
						<a href="javascript:;" class ="full-screen text-magenta pull-right ps-10">									
						<i class="mdi mdi-fullscreen"></i>  
						</a>  
					</div> 
				</div>			 
			</div>

IGWEZE;           


			}

			return $pg_header;

		}			


       /*
        /*
        * Requirements: your PHP installation needs cUrl support, which not all PHP installations
        * include by default.
        *
        * Substitute your own username, password, mno, Sid, fl, mt, and message in seven_bit_msg
        *then run the code:
        */

        function send_1s2u($username, $password, $receiver, $sentMsg){

            $username = 'username';
            $password = 'password';
            $mt = '0';
            $fl = '0';
            $seven_bit_msg = $sentMsg;
            /*
            * Your phone number, including country code, i.e. 60123456756:
            */
            $mno = $receiver;
            $Sid = 'test';
            /*
            * 
            */
            $url = 'https://api.1s2u.io/bulksms';
            $post_fields = array(
                'username' => $username,
                'password' => $password,
                'mt' => $mt,
                'Sid' => $Sid,
                'mno' => $mno,
                'msg' => $seven_bit_msg
            );
            $get_url = $url . "?" . http_build_query($post_fields);
            /*
            * A 7-bit GSM SMS message can contain up to 160 characters (longer messages can be
            * achieved using concatenation).
            *
            * All non-alphanumeric 7-bit GSM characters are included in this example. Note that Greek characters,
            * and extended GSM characters (e.g. the caret "^"), may not be supported
            * to all networks. Please let us know if you require support for any characters that
            * do not appear to work to your network.
            */
            /*
            * Sending 7-bit message
            */
            $post_body = seven_bit_sms( $username, $password, $seven_bit_msg, $mno, $Sid, $fl, $mt);
            
            $result = send_message_1s2u( $post_body, $get_url );

            return  formatted_server_response($result);

            /*
            if( $result['success'] ) {
                print_ln( formatted_server_response( $result ) );
            }
            else {
                print_ln( formatted_server_response( $result ) );
            }

            /*
            * If you don't see this, and no errors appeared to screen, you should
            * check your Web server's error logs for error output:
              print_ln("Script completely ran.");  
            */
            
            
        }
        
        function print_ln($content) {
            if (isset($_SERVER["SERVER_NAME"])) {
                print $content."";
            }
            else {
                print $content."\n";
            }
        }

        function formatted_server_response( $result ) {
            $this_result = "";
            if ($result['success']) {
                $this_result .= "Success ID : ".$result['id'];
            }
            else {
                $this_result .= "Fatal error: HTTP status " .$result['http_status_code']. ", API status " .$result['api_status_code']. " Full details " .$result['details'];
            }
            return $this_result;
        }
        
        function send_message_1s2u ( $post_body, $get_url ) {
            $ch = curl_init( );
            curl_setopt ( $ch, CURLOPT_URL, $get_url );
            curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
            // Allowing cUrl funtions 20 second to execute
            curl_setopt ( $ch, CURLOPT_TIMEOUT, 20 );
            // Waiting 20 seconds while trying to connect
            curl_setopt ( $ch, CURLOPT_CONNECTTIMEOUT, 20 );
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $response_string = curl_exec( $ch );
            $curl_info = curl_getinfo( $ch );
            $sms_result = array();
            $sms_result['success'] = 0;
            $sms_result['details'] = '';
            $sms_result['http_status_code'] = $curl_info['http_code'];
            $sms_result['api_status_code'] = '';
            $sms_result['id'] = $response_string;
            if ( $response_string == FALSE ) {
            $sms_result['details'] .= "cURL error: " . curl_error( $ch ) . "\n";
            } elseif ( $curl_info[ 'http_code' ] != 200 ) {
            $sms_result['details'] .= "Error: non-200 HTTP status code: " . $curl_info[ 'http_code' ] . "\n";
            }
            else {
            $sms_result['details'] .= "Response from server: $response_string\n";
            $api_result = substr($response_string, 0, 2);
            $status_code = $api_result;
            $sms_result['api_status_code'] = $status_code;
            if ( $api_result != 'OK' ) {
                $sms_result['details'] .= "Error: could not parse valid return data from server.\n" . $api_result;
            } else {
                if ($status_code == 'OK') {
                $sms_result['success'] = 1;
                }
            }
            }
            curl_close( $ch );
            return $sms_result;
        }

        function seven_bit_sms ( $username, $password, $message, $mno, $sid, $fl, $mt) {
            $post_fields = array (
            'username' => $username,
            'password' => $password,
            'mno'   => $mno,
            'sid' => $sid,
            'sfl' => $fl,
            'mt' => $mt,
            'message'  => $message
            );
            return make_post_body($post_fields);
        }

        function make_post_body($post_fields) {
            $stop_dup_id = make_stop_dup_id();
            if ($stop_dup_id > 0) {
            $post_fields['stop_dup_id'] = make_stop_dup_id();
            }
            $post_body = '';
            foreach( $post_fields as $key => $value ) {
            $post_body .= urlencode( $key ).'='.urlencode( $value ).'&';
            }
            $post_body = rtrim( $post_body,'&' );
            return $post_body;
        }

        function make_stop_dup_id() {
            return 0;
        }		

		function messenger($type, $msg){ 

			$toat_msg = '<script type="text/javascript"> 

				const Toast = Swal.mixin({
					toast: true,
					position: "top-end",
					showConfirmButton: false,
					timer: 5000,
					timerProgressBar: true,
					didOpen: (toast) => {
					toast.onmouseenter = Swal.stopTimer;
					toast.onmouseleave = Swal.resumeTimer;
					}
				});
				Toast.fire({
			  
						icon: "'.$type.'",
						title: "'.$msg.'"
					});
				
			</script>';  

			echo $toat_msg;

		}
		
		

		function sendRequest($url, $method = 'GET', $data = []){
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		 
			// Set request method
			switch ($method) {
				case 'GET':
					curl_setopt($ch, CURLOPT_HTTPGET, true);
					break;
				case 'POST':
					curl_setopt($ch, CURLOPT_POST, true);
					curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
					break;
				case 'PUT':
					curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
					curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
					break;
				case 'DELETE':
					curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
					break;
			}
			$response = curl_exec($ch);
			$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			curl_close($ch);
			return json_encode(['response' => $response, 'http_code' => $httpCode]);
			
		}		


?>

 