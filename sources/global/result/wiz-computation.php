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
	This script handle student termly result
	------------------------------------------------------------------------*/ 


		if (!defined('fobrain')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');  

		$curSess = currentSessionInfo($conn); /* current school session */			
		list ($curSessID, $cSess) = explode ("@$@", $curSess);
		
		$classNum = studentClassCount($conn, $sessionID, $class, $level);  /* count student class */
		$next_begin = termStartDate($conn, $curSessID, $term);  /* retrieve school next term start  */
		
		$levelArray = studentLevelsArray($conn); /* student level array */
		$trimLevel = ($level - $fiVal);
		$student_level = $levelArray[$trimLevel]['level'];

		$clArray = studentClassArray($conn, $level);  /* retrieve student class array */			
		$classArray = unserialize($clArray);			

		$class_index = array_search($class, $class_list);
		$class_m = $classArray[$class_index]; 

		$examArray = schoolExamConfigArrays($conn);  /* school exam configuration array  */
		$exam_status = $examArray[0]['status'];		
		$exam_fi = $examArray[0]['fi_ass'];	
		$exam_se = $examArray[0]['se_ass'];	
		$exam_th = $examArray[0]['th_ass'];	
		$exam_fo = $examArray[0]['fo_ass'];	
		$exam_fif = $examArray[0]['fif_ass'];	
		$exam_six = $examArray[0]['six_ass'];	
		$exam_score = $examArray[0]['exam'];	
		
		$principalData = staffData($conn, $schoolHead);  /* school staffs/teachers information */
		list ($princ_title, $princ_fullname, $princ_sex, $princ_rankingVal, $princ_picture, 
				$princ_lname, $princ_phone, $princ_sign) = explode ("#@s@#", $principalData);

		$titleVal = $title_list[$princ_title];
		$schoolPrincipal = $titleVal.' '.$princ_fullname; 
		
		$formTeacher = formTeacher($conn, $sessionID, $level, $class);  /* retrieve assign class teacher information */
		
		$formTeacherSign = formTeacherSignatures($conn, $sessionID, $level, $class); /* retrieve assign class teacher signature */
		
		//$staff_course = rsClassTeachers($conn, $sessionID, $class, $level, $term);  /* retrieve subject class teachers */		
		//$staff_course = unserialize($staff_course); 
		

		$gradeArray = gradeDataArr($conn);   /* school grade array */
		
		/* check exam configuration status  */	

		if($exam_status == $fiVal){
		
			$csCHRow = '<th width="30px" colspan="1">Continous Assessment </th>';
			
			$csCLRow = '  <tr>
				<th>1st <br/> ('.$exam_fi.') </th>
				
				</tr>';
			$rsColplus = $fiVal; 	
		
		}elseif($exam_status == $seVal){
		
			$csCHRow = '<th width="60px" colspan="2">Continous Assessment </th>';
			
			$csCLRow = '  <tr>
				<th>1st <br/>  ('.$exam_fi.') </th>
				<th>2nd  <br/> ('.$exam_se.')</th>
				
				</tr>';
				
				$rsColplus = $seVal; 	
		
		}elseif($exam_status == $thVal){

			$csCHRow = '<th width="90px" colspan="3">Continous Assessment </th>';
			
			$csCLRow = '  <tr>
				<th>1st <br/>('.$exam_fi.')</th>
				<th>2nd <br/>('.$exam_se.')</th>
				<th>3rd <br/>('.$exam_th.')</th>
				</tr>';
				$rsColplus = $thVal; 	
			
		
		}elseif($exam_status == $foVal){

			$csCHRow = '<th width="90px" colspan="4">Continous Assessment </th>';
			
			$csCLRow = '  <tr>
				<th>1st <br/>('.$exam_fi.')</th>
				<th>2nd <br/>('.$exam_se.')</th>
				<th>3rd <br/>('.$exam_th.')</th>
				<th>4th <br/>('.$exam_fo.')</th>
				</tr>';
				$rsColplus = $foVal; 	
			
		
		}elseif($exam_status == $fifVal){

			$csCHRow = '<th width="90px" colspan="5">Continous Assessment </th>';
			
			$csCLRow = '  <tr>
				<th>1st <br/>('.$exam_fi.')</th>
				<th>2nd <br/>('.$exam_se.')</th>
				<th>3rd <br/>('.$exam_th.')</th>
				<th>4th <br/>('.$exam_fo.')</th>
				<th>5th <br/>('.$exam_fif.')</th>
				</tr>';
				$rsColplus = $fifVal; 	
			
		
		}elseif($exam_status == $sixVal){

			$csCHRow = '<th width="90px" colspan="6">Continous Assessment </th>';
			
			$csCLRow = '  <tr>
				<th>1st <br/>('.$exam_fi.')</th>
				<th>2nd <br/>('.$exam_se.')</th>
				<th>3rd <br/>('.$exam_th.')</th>
				<th>4th <br/>('.$exam_fo.')</th>
				<th>5th <br/>('.$exam_fif.')</th>
				<th>6th <br/>('.$exam_six.')</th>
				</tr>';
				$rsColplus = $sixVal; 	
			
		
		}else{
			
			$csCHRow = '<th width="90px" colspan="3">Continous Assessment </th>';
			
			$csCLRow = '  <tr>
				<th>1st <br/> ('.$exam_fi.') </th>
				<th>2nd  <br/> 
				('.$exam_se.')</th>
				<th>3rd  <br/> ('.$exam_th.')</th>
				</tr>';
				$rsColplus = $thVal; 	
		
		} 

		$rsColspan = (9 + $rsColplus);	
		
			
		/* select student and conducts information */
		
		$ebele_mark_1 = "SELECT r.nk_regno, f.$queryUserBio, c.$conducts_field 

						FROM $i_reg_tb r INNER JOIN $i_student_tb f
					
						ON (r.ireg_id = f.ireg_id)

						AND r.session_id = :session_id 
					
						AND r.$nk_class = :class

						AND r.active = :foreal
					
						AND r.nk_regno =  :nk_regno
						
						INNER JOIN $sdoracle_student_remark_nk c
					
							ON (r.ireg_id = c.ireg_id)"; 
				
		$igweze_prep_1 = $conn->prepare($ebele_mark_1);
		$igweze_prep_1->bindValue(':nk_regno', $regNum, PDO::PARAM_STR);				
		$igweze_prep_1->bindValue(':session_id', $sessionID, PDO::PARAM_STR);				
		$igweze_prep_1->bindValue(':foreal', $foreal, PDO::PARAM_STR);				
		$igweze_prep_1->bindValue(':class', $class, PDO::PARAM_STR);				 
		$igweze_prep_1->execute();
		
		$rows_count_1 = $igweze_prep_1->rowCount(); 
		
		if($rows_count_1 == $foreal) {  /* check array is empty */
		
			while($row_1 = $igweze_prep_1->fetch(PDO::FETCH_BOTH)) {  /* loop array */		

				$pic = $row_1['i_stupic'];
				$fname = $row_1['i_firstname'];
				$mname = $row_1['i_midname'];
				$lname = $row_1['i_lastname'];
				$dob = $row_1['i_dob']; 
				//$attribute = $row_1[$attrib]; 
				$attendance = $row_1[$attendance_r];
				$conducts = $row_1[$conducts_r];
				$i_sport = $row_1[$sports_r];
				$organization = $row_1[$organization_r];
				$comment = $row_1[$comment_r];
				$ftRemark = $row_1[$comment_t];
				$pr_comment = $row_1[$pr_comment_r];
				$student_name = "$lname $mname $fname"; 
										
			}	 				
				

			$gsRemarkArray = teacherRemarksArrays($conn);  /* teacher remarks array */ 
			//$clubArray = studentsClubArrays($conn);  /* school clubs array */
			//$clubPostArray = clubPostArrays($conn);  /* school clubs position array */
			$sportArray = sportsArrays($conn);  /* school sports array */ 
			
			$student_img = picture($school_pic_dir.$session_fi.'_'.$session_se.'/', $pic, "student");
		
		} 

		//list ($i_att, $i_sporta, $i_conduct, $i_org, $i_off, $t_com, $t_name, $rs_date, $bg_date) = 
		//explode ("#", $attribute);

		list ($NOTSchOpen, $NOTPresent, $NOTPunc) = explode (",", $attendance); 
		$NOTAbsent = (intval($NOTSchOpen) - intval($NOTPresent));

		list ($i_sport_1, $i_sport_2, $i_sport_3, $i_sport_4, $i_sport_5) = explode (",", $i_sport);

		list ($i_conduct_1, $i_conduct_2, $i_conduct_3, $i_conduct_4, $i_conduct_5, $i_conduct_6, 
			$i_conduct_7, $i_conduct_8, $i_conduct_9, $i_conduct_10) = explode (",", $conducts);
							
		//settype($t_com, "integer"); settype($t_name, "integer"); settype($rs_date, "integer"); 
		//settype($bg_date, "integer");

		settype($i_sport_1, "integer"); settype($i_sport_2, "integer"); settype($i_sport_3, "integer"); 
		settype($i_sport_4, "integer"); settype($i_sport_5, "integer"); 

		if($i_sport_1 != ""){ $sport_1 = $sportArray[$i_sport_1]['name']; }
		if($i_sport_2 != ""){ $sport_2 = $sportArray[$i_sport_2]['name']; } 
		if($i_sport_3 != ""){ $sport_3 = $sportArray[$i_sport_3]['name']; }
		if($i_sport_4 != ""){ $sport_4 = $sportArray[$i_sport_4]['name']; }
		if($i_sport_5 != ""){ $sport_5 = $sportArray[$i_sport_5]['name']; }

		/*
		list ($fi_social_info, $se_social_info, $th_social_info, $fo_social_info, $fif_social_info) = 
		explode ("%##%", $organization);

		list ($i_org_1, $i_off_1, $fi_contrib) = explode ("@@", $fi_social_info); 
		list ($i_org_2, $i_off_2, $se_contrib) = explode ("@@", $se_social_info);
		list ($i_org_3, $i_off_3, $th_contrib) = explode ("@@", $th_social_info);
		list ($i_org_4, $i_off_4, $fo_contrib) = explode ("@@", $fo_social_info);
		list ($i_org_5, $i_off_5, $fif_contrib) = explode ("@@", $fif_social_info);
							
		$i_fi_org = $clubArray[$i_org_1]['name']; $i_se_org = $clubArray[$i_org_2]['name']; 
		$i_th_org = $clubArray[$i_org_3]['name']; 
		$i_fo_org = $clubArray[$i_org_4]['name']; $i_fif_org = $clubArray[$i_org_5]['name'];

		$i_fi_off = $clubPostArray[$i_off_1]['name']; $i_se_off = $clubPostArray[$i_off_2]['name']; 
		$i_th_off = $clubPostArray[$i_off_3]['name']; 
		$i_fo_off = $clubPostArray[$i_off_4]['name']; $i_fif_off = $clubPostArray[$i_off_5]['name']; 

		$rs_date_pub = $rs_date_list[$rs_date]; 
		*/

		$academic_yr = recentAcademicYear($level, $session_fi);  /* school session academic year  */ 			 

		//$show_status = "<font color='#996600'> ( ".$rs_status." )</font>";

$table_head =<<<IGWEZE

			
		<!-- table -->
		<table class="table table-sm" width="100%"> 
			<tr>
				<th colspan = "8" style="background-color:#fff !important;">  
					<div class="row">							
						<div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12 text-center hide-res"> 
							<img src="$sch_logo" alt="School Logo"  class='img-circle img-72'/>
						</div>
						<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12 text-center">
							$fobrainSchTitle 
						</div>
						<div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12 text-center"> 
							<img src="$student_img"  alt="Student's Picture"  class='img-circle img-72' />
						</div>							
					</div> 
				</th>
			</tr> 
			<tr>
				<th colspan="8">
					<div class="row gutters"> 
						<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 fs-12">
							Name : <span class = "text-theme-blue font-head-1 fs-13">$student_name</span>
						</div>
						<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 fs-12">
							Admission No : <span class = "text-theme-blue font-head-1 fs-13">$regNum</span>
						</div> 
						<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 fs-12">
							Academic Year : <span class = "text-theme-blue font-head-1 fs-13">$academic_yr</span>
						</div> 
					<div>
				</th>  
			</tr> 
			<tr>
				<th colspan="8">
					<div class="row gutters"> 
						<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-6 fs-12">
							Level : <span class = "text-theme-blue font-head-1 fs-13">$student_level</span>
						</div>
						<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-6 fs-12">
							Class : <span class = "text-theme-blue font-head-1 fs-13">$class_m</span>
						</div> 
						<div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12 fs-12">
							Term : <span class = "text-theme-blue font-head-1 fs-13">$term_value</span>
						</div> 
						<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 fs-12">
							Next Term Begin : <span class = "text-theme-blue font-head-1 fs-13"> $next_begin</span>
						</div>
						
					<div>
				</th>  
			</tr> 
				

IGWEZE;

		echo $table_head;
		
$tableTop =<<<IGWEZE

			<tr>
				<th class= "text-theme-blue font-head-1 fs-14" colspan="8">No. of times</th>
			</tr> 
			<tr>
				<th colspan="8">
					<div class="row gutters"> 
						<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-6 fs-12">
							Sch. Open : <span class = "text-theme-blue font-head-1 fs-13">$NOTSchOpen</span>
						</div>
						<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-6 fs-12">
							Presents : <span class = "text-theme-blue font-head-1 fs-13">$NOTPresent</span>
						</div> 
						<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-6 fs-12">
							Punctual : <span class = "text-theme-blue font-head-1 fs-13">$NOTPunc</span>
						</div> 
						<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-6 fs-12">
							Absents : <span class = "text-theme-blue font-head-1 fs-13">$NOTAbsent</span>
						</div>
						
					<div>
				</th>  
			</tr>  
		</table>
		<!-- / table --> 

IGWEZE;

		echo $tableTop;



$table_body =<<<IGWEZE

		<div class="table-responsive">
		<!-- table -->	
		<table class="table table-sm table-responsive">
			<thead>  
				<tr>
					<th rowspan="2" class="hide-none">S/N</th>
					<th width="20%" rowspan="2">Subjects</th>
					$csCHRow 
					<th rowspan="2"><span class="vertical-lr rotated">Exam   ($exam_score) </span></th> 
					<th rowspan="2"><span class="vertical-lr rotated">Total Score</span></b>
					<th rowspan="2"><span class="vertical-lr rotated">Grade</span></th>
					<th rowspan="2" class="hide-none"><span class="vertical-lr rotated">Remarks</span></th>
					<th rowspan="2"><span class="vertical-lr rotated">Position</span></th>
					<th rowspan="2"><span class="vertical-lr rotated">Max Score</span></th>
					<th rowspan="2" class="hide-none">Teachers <br /> Remark</th>
					<th rowspan="2" width="25%" class="hide-none">Teachers Name</th>				
				</tr>

				$csCLRow

			</thead>
			<tbody>

			

IGWEZE;

			echo $table_body;

			/* select student result information */

			$ebele_mark_2 = "SELECT r.nk_regno, f.$query_i_strings_nj

							FROM $i_reg_tb r INNER JOIN $sdoracle_grand_score_nk f
						
							ON (r.ireg_id = f.ireg_id)

							AND r.session_id = :session_id 
						
							AND r.$nk_class = :class

							AND r.active = :foreal
						
							AND r.nk_regno = :nk_regno";
				
					
			$igweze_prep_2 = $conn->prepare($ebele_mark_2);
			$igweze_prep_2->bindValue(':nk_regno', $regNum, PDO::PARAM_STR);				
			$igweze_prep_2->bindValue(':session_id', $sessionID, PDO::PARAM_STR);				
			$igweze_prep_2->bindValue(':foreal', $foreal, PDO::PARAM_STR);				
			$igweze_prep_2->bindValue(':class', $class, PDO::PARAM_STR);				 
			$igweze_prep_2->execute();
			
			$rows_count_2 = $igweze_prep_2->rowCount(); 
			
			if($rows_count_2 == $foreal) {  /* check array is empty */
			
				while($row_2 = $igweze_prep_2->fetch(PDO::FETCH_BOTH)) {  /* loop array */		
	
					$total_score = $row_2[1]; 
					$student_avg = $row_2[2]; 
					$student_poistion = $row_2[3]; 

				}	
			
			} 

			$ebele_mark_3 = "SELECT r.nk_regno, f.$query_i_strings, g.$query_i_strings_nk, j.$query_i_scores

							FROM $i_reg_tb r INNER JOIN $sdoracle_sub_score_nk f
							
							ON (r.ireg_id = f.ireg_id)

							AND r.session_id = :session_id 
						
							AND r.$nk_class = :class

							AND r.active = :foreal
						
							AND r.nk_regno =  :nk_regno
							
								INNER JOIN $sdoracle_grade_nk g
						
								ON (r.ireg_id = g.ireg_id)
						
									INNER JOIN $sdoracle_score_nk j
						
									ON (g.ireg_id = j.ireg_id)"; 
					
			$igweze_prep_3 = $conn->prepare($ebele_mark_3);
			$igweze_prep_3->bindValue(':nk_regno', $regNum, PDO::PARAM_STR);				
			$igweze_prep_3->bindValue(':session_id', $sessionID, PDO::PARAM_STR);				
			$igweze_prep_3->bindValue(':foreal', $foreal, PDO::PARAM_STR);				
			$igweze_prep_3->bindValue(':class', $class, PDO::PARAM_STR);				 
			$igweze_prep_3->execute();
			
			$rows_count_3 = $igweze_prep_3->rowCount(); 
			
			if($rows_count_3 == $foreal) {  /* check array is empty */
			
				while($row_3[] = $igweze_prep_3->fetch(PDO::FETCH_BOTH)) {  /* loop array */ }						
			
			}
				
			$f = 0; 	   
			$c = 0;
			$c = ($i_stop_loop * 2) + 2;
			$f_gr = 0; $e_gr = 0; $d_gr = 0; 
			$courseCount = 0;

			$p = $i_stop_loop + 2;
			$countNum = $foreal;
			$iT = 0; $subArr = $start_nkiru;  
				
			for ($i = $i_start_loop; $i <= $i_stop_loop; $i++) {  /* loop array */ 
				
				$courseNum = $countNum++;		
		
				$i_score = $row_3[$f][$i]; 
					
				if($i_score >= $fiVal){  /* check is score is greater than 1  */
		
		
					$field = $course_info_mark[$subArr][3]; 
					
					$score_remarks = gradeRemarks($i_score); /* grade remarks */					   
					$grade_remarks = teacherGradeRemarks($i_score);	 /* teacher grade remarks */				   
					$i_score_gr = fobrainGradeScore($gradeArray, $i_score); /* student grades score */					   
					$i_max_score = maxStudentScore($conn, $regNum, $sdoracle_sub_score_nk, $field, 
																$sessionID, $class, $nk_class); /* student termly maximum subject score */
																
					$subject_poistion = $row_3[$f][$p];
					$subjectPoistion = studentPostionSup($subject_poistion);  /* student result position suffix  */	 
					
				}else{
				
					$field = '-';  $i_score = '-';  $score_remarks = '-'; 
					
					$grade_remarks = '-';  $i_score_gr = '-';  $i_max_score = '-'; 
					
					$fi = '-'; $se = '-'; $th = '-'; $fo = '-'; $fif = '-'; $six = '-';  $ex = '-'; 
					
					$subjectPoistion = '-';	
		
				} 

				$sub_staff_name = "";

				$staff = $course_info_mark[$subArr][9];	 
				$staff_course = unserialize($staff);  

				if(is_array($staff_course)){  /* check if array */  

					foreach($staff_course as $staffID){  /* loop array */

						$sub_staff = staffData($conn, $staffID);  /* school staffs/teachers information */ 
						list ($title, $st_fullname, $st_sex, $st_rank, $st_picture, 
								$st_lname) = explode ("#@s@#", $sub_staff); 

						$titleVal = wizSelectArray($title, $title_list);
						
						$sub_teacher = $titleVal.' '.$st_fullname;
						
						if($sub_staff != ''){
							
							$sub_staff_name .=  $sub_teacher .' / ';	
						
						} 

					}
					
					$sub_staff_name = rtrim($sub_staff_name ,' / ');

				}else{

					$sub_staff_name = ' - ';

				} 

				$iT++;
				
				$scoresC = explode(",", $row_3[$f][$c]);
				$scoresCount = count($scoresC);  	
				
				/* check exam configuration status  */	
				
				if($exam_status == $fiVal){
					
					list ($fi, $ex) = explode (",", $row_3[$f][$c]);
					$examRows = '<td class="v-align">'.$fi.'</td> <td class="v-align">'.$ex.'</td> 
					<td >'.$i_score.'</td> <td class="v-align">';
				
				}elseif($exam_status == $seVal){
					
					list ($fi, $se, $ex) = explode (",", $row_3[$f][$c]);
					$examRows = '<td class="v-align">'.$fi.'</td> <td class="v-align">'.$se.'</td> <td class="v-align">'.$ex.'</td> 
					<td >'.$i_score.'</td> <td class="v-align">';
				
				}elseif($exam_status == $thVal){
					
					list ($fi, $se, $th, $ex) = explode (",", $row_3[$f][$c]);
					$examRows = '<td class="v-align">'.$fi.'</td> <td class="v-align">'.$se.'</td> <td class="v-align">'.$th.'</td> 
					<td class="v-align">'.$ex.'</td> 
					<td class="v-align">'.$i_score.' </td> <td class="v-align">';
				
				}elseif($exam_status == $foVal){
					
					list ($fi, $se, $th, $fo, $ex) = explode (",", $row_3[$f][$c]);
					$examRows = '<td class="v-align">'.$fi.'</td> <td class="v-align">'.$se.'</td> <td class="v-align">'.$th.'</td>
					<td class="v-align">'.$fo.'</td><td class="v-align">'.$ex.'</td> 
					<td class="v-align">'.$i_score.' </td> <td class="v-align">';
				
				}elseif($exam_status == $fifVal){
					
					list ($fi, $se, $th, $fo, $fif, $ex) = explode (",", $row_3[$f][$c]);
					$examRows = '<td class="v-align">'.$fi.'</td> <td class="v-align">'.$se.'</td> <td class="v-align">'.$th.'</td>
					<td class="v-align">'.$fo.'</td><td class="v-align">'.$fif.'</td><td class="v-align">'.$ex.'</td> 
					<td class="v-align">'.$i_score.' </td> <td class="v-align">';
				
				}elseif($exam_status == $sixVal){
					
					list ($fi, $se, $th, $fo, $fif, $six, $ex) = explode (",", $row_3[$f][$c]);
					
					if($scoresCount == $fiVal){

						$examRows = '<td class="v-align"> - </td> <td class="v-align"> - </td> <td class="v-align"> - </td>
						<td class="v-align"> - </td><td class="v-align"> - </td><td class="v-align"> - </td>
						<td class="v-align">'.$fi.'</td> 
						<td class="v-align">'.$i_score.' </td> <td class="v-align">';
					
					}else{								
					
						$examRows = '<td class="v-align">'.$fi.'</td> <td class="v-align">'.$se.'</td> <td class="v-align">'.$th.'</td>
						<td class="v-align">'.$fo.'</td><td class="v-align">'.$fif.'</td><td class="v-align">'.$six.'</td>
						<td class="v-align">'.$ex.'</td> 
						<td class="v-align">'.$i_score.' </td> <td class="v-align">';
						
					}	
				
				}else{
					
					list ($fi, $se, $th, $ex) = explode (",", $row_3[$f][$c]);	
					$examRows = '<td >'.$fi.'</td> <td >'.$se.'</td> <td >'.$th.'</td> <td >'.$ex.'</td> 
					<td >'.$i_score.' </td> <td class="v-align">';
				
				} 
				$courseCount++;
				echo "<tr>
					<td valign='middle' class='hide-none'>$courseCount</td> 
					<td class='v-align font-head-1-out fs-13 text-primary fw-500'>";
					echo $course_info_mark[$subArr][2];
					echo "</td>";
					echo  $examRows;
					echo  $i_score_gr;
					echo "</td><td class='v-align hide-none'>";
					echo  $score_remarks;
					echo "</td> <td class='v-align'>";
					echo  $subjectPoistion;
					echo "</td><td class='v-align hide-none'>";
					echo $i_max_score;
					echo "</td><td class='v-align hide-none'> $grade_remarks </td>
					<td  class='v-align hide-none font-head-1 fs-12 text-primary fw-500'> <span>$sub_staff_name</span> </td> 
				</tr>";
				
				if ($i_score_gr == 'F'){ $f_gr = $f_gr + 1; }
				if ($i_score_gr == 'D7'){ $d_gr = $d_gr + 1; }
				if ($i_score_gr == 'E8'){ $e_gr = $e_gr + 1; } 
					
				$subArr++;
				$i_score = '';
				$p = $p + 1;
				$field  = '';
				$c = $c + 1;
				$i_score_gr = '';
				$i_max_score = '';
				$subjectPoistion = '';
				$score_remarks = '';
				$fi = ''; $se = ''; $th = ''; $fo = ''; $fif = ''; $six = '';  $ex = ''; 
				// $row_3[$f][$c] = '';

				$sub_staff_name = '';   
				
			} 
			
			$f = $f + 1;

			$p = ''; 

			echo  "</tr>";

			echo" <tr>
					<th style='text-align:right !important; padding-right:10px;' class ='hide-none' colspan='2'>Number Of Subjects : </th>
					<td colspan='1' class ='hide-none text-primary font-head-1 fw-600'>$courseNum</td>
					<th style='text-align:right !important; padding-right:10px;' colspan='3'>Total Score :</th>
					<td colspan='1' class = 'text-primary font-head-1 fw-600'> $total_score </td>
					<th style='text-align:right !important; padding-right:10px;' colspan='3'>Student Average :</th>
					<td colspan='3' class = 'text-primary font-head-1 fw-600'>$student_avg</td>

					</tr>
				</tbody>";

			echo "</table><!-- / table --></div>";
				
			echo $rsAdsFooter;

			$gsRemark = $gsRemarkArray[$comment]['name'];
			$gcTeacher = "";
			$principal_remark = fobrainPrincipalRemarks ($student_avg, $d_gr, $e_gr, $f_gr); /* principal auto remarks */
			$studentPoistion = studentPostionSup($student_poistion);  /* student result position suffix  */

			$pr_comment = trim($pr_comment);

			if(($pr_comment == '') || ($pr_comment == '-')){

				$principal_remark = $principal_remark;	

			}else{ 

				$principal_remark = $pr_comment; 

			} 

			$prin_img = picture($staff_doc_ext, $princ_sign, "sign");
			$principal_sign = '<img src="'.$prin_img.'" style="height: 60px; width:130px; margin-top:8px;">';
			

$table_foot =<<<IGWEZE
						
				<!-- row --> 
				<div class="row">  
					<div class="col-xl-7 col-lg-7 col-md-7 col-sm-12 col-12">  
						<table width="100%" class="table table-sm mt-20">
						
							<tr style="border-color:#fff;">
								<td width="50%"  style="border-bottom-color : #000;">No of Students in Class : 
									<span class="text-primary font-head-1 fs-14"> $classNum </span>
								</td>
								<td width="50%" style="border-bottom-color : #000;">Position in Class :
									<span class="text-primary font-head-1 fs-14">$studentPoistion </span>
								</td> 
							</tr>
							<!--
							<tr style="border-color:#fff;">
								<td colspan="2" style="text-align:left; padding: 5px; border-color:#fff; font-weight:bold;"> Guidance &amp; Counsellor's Name :
									<span class="text-primary font-head-1 fs-14"> $gcTeacher </span>  
								</td>
							</tr> 
							
							<tr>
								<td width="60%" style="border-bottom-color : #000;">
									Guidance &amp; Counsellor's Comments : 
									<span class="text-primary font-head-1 fs-14"> $gsRemark  </span> 
								</td>
								<td width="40%" style="border-bottom-color : #000;">
									Sign. 	__________________
								</td>
							</tr>
							-->		
							<tr style="border-color:#fff;">
								<td colspan="2">Form Teacher Name :
									<span class="text-primary font-head-1 fs-13"> $formTeacher </span>  
								</td>
							</tr>
	
							<tr>
								<td width="50%" style="border-bottom-color : #000;">Form Teacher Comments : 
									<div class="text-primary font-head-1 fs-14 mt-5">$ftRemark $gsRemark</div> 
								</td>
								<td width="50%" class="v-align" style="border-bottom-color : #000;">
									<div class="row">
										<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-6 v-align"">
											<div class="text-primary font-head-1 fs-14 mt-15 me-10">Sign.</div>
										</div>	
										<div class="col-9">
											<div class="row p-0 m-0">
												$formTeacherSign  
											</div>
										</div>
									</div>		
								</td>
							</tr>
	
							<tr>
								<td colspan="2">
									Principal Name : <span class="text-primary font-head-1 fs-13"> $schoolPrincipal </span> 
								</td>
							</tr>
	
							<tr>
								<td width="50%" style="border-bottom-color : #000;">
									Principal Comments  :  
									<div class="text-primary font-head-1 fs-14 mt-5">$principal_remark</div>  
								</td>
								<td width="50%" class="v-align" style="border-bottom-color : #000;">
									<span class="text-primary font-head-1 fs-14 me-10">Sign.</span>   $principal_sign 
								</td>
							</tr> 
						
						</table>
						<!-- / table --> 
					</div>
	
					<div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-12">
						<!-- table -->
						<table width="100%" class="table table-sm">
	
							<tr>
								<th width="35%" class = "text-primary">Assessment</th>
								<th width="15%" class = "text-primary">Rating</th> 
								<th width="35%" class = "text-primary">Assessment</th>
								<th width="15%" class = "text-primary">Rating</th>  
							</tr>
							
							<tr>
								<td width="35%" class = "fw-600 fs-10">Neatness</td>
								<td width="15%" class = "text-primary font-head-1 fw-600">$i_conduct_1</td> 					
								<td width="35%" class = "fw-600">Politeness</td>
								<td width="15%" class = "text-primary font-head-1 fw-600">$i_conduct_2</td>
							</tr> 
	
							<tr>
								<td width="35%" class = "fw-600">Honesty</td>
								<td width="15%" class = "text-primary font-head-1 fw-600">$i_conduct_3</td>
								<td width="35%" class = "fw-600">Leadership</td>
								<td width="15%" class = "text-primary font-head-1 fw-600">$i_conduct_4</td>
							</tr> 
							
							<tr>	
								<td width="35%" class = "fw-600">Attentiveness</td>
								<td width="15%" class = "text-primary font-head-1 fw-600">$i_conduct_5</td>
								<td width="35%" class = "fw-600">Emotional Stability</td>
								<td width="15%" class = "text-primary font-head-1 fw-600">$i_conduct_6</td> 
							</tr> 
										
							<tr>				
								<td width="35%" class = "fw-600 fs-11">Health</td>
								<td width="15%" class = "text-primary font-head-1 fw-600">$i_conduct_7</td> 
								<td width="35%" class = "fw-600 fs-10">Attitude to Sch.Work</td>
								<td width="15%" class = "text-primary font-head-1 fw-600">$i_conduct_8</td> 
							</tr>  
	
							<tr>	
								<td width="35%" class = "fw-600">Speaking</td>
								<td width="15%" class = "text-primary font-head-1 fw-600">$i_conduct_9</td> 
								<td width="35%" class = "fw-600">Hand Writing</td>
								<td width="15%" class = "text-primary font-head-1 fw-600">$i_conduct_10</td> 
							</tr> 
	
							<tr>
								<td width="100%" colspan="4" class = "text-primary"><small>$sdo_tb_se_grade</small></td> 
							</tr>  
	
							<tr style="border-color:#fff;">
								<th colspan="4" class = "text-primary"> 
									Sports &amp; Athletics  
								</th>  
							</tr>
	
							<tr>	 
								<td colspan="4" style="border-bottom-color:#000;" class="text-primary font-head-1 fs-13">
									$sport_1 $sport_2 $sport_3 $sport_4 $sport_5
								</td>  
							</tr>
	
						</table>				
						<!-- / table -->
					</div>			 
				</div>					
			
IGWEZE;

			echo $table_foot; 

?> 