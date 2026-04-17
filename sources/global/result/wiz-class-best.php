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
	This script handle best student termly result
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
				$princ_lname) = explode ("#@s@#", $principalData);

		$titleVal = $title_list[$princ_title];
		$schoolPrincipal = $titleVal.' '.$princ_fullname;
		
		
		$formTeacher = formTeacher($conn, $sessionID, $level, $class);  /* retrieve assign class teacher information */
		
		$classTeachers = rsClassTeachers($conn, $sessionID, $class, $level, $term);  /* retrieve subject class teachers */		
		$classTeachers = unserialize($classTeachers); 
				
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
		
		$fobrainSchTitle ="<h2 class='text-primary'>  $schoolNameTop </h2> 
							<h5 class='text-danger'><i class='bx bxs-map-pin fs-20 label-icon'></i> $schoolAddressTop</h5>";

		/* select student result information */
		
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
				$comment = $row_1[$comment_r];
				$pr_comment = $row_1[$pr_comment_r];
				$student_name = "$lname $mname $fname"; 
											
			}	 
				
				
			$student_img = picture($school_pic_dir.$session_fi.'_'.$session_se.'/', $pic, "student"); 
		
		} 

		$academic_yr = recentAcademicYear($level, $session_fi);  /* school session academic year  */  

$table_head =<<<IGWEZE

	 
			<!-- table -->
			<table class="table table-hover style-table" width="100%">
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
			</table>
			<!-- / table -->
	

IGWEZE;

		

	echo $table_head;



$table_body =<<<IGWEZE

		<div class="table-responsive">
		<!-- table -->	
		<table class="table table-hover table-responsive style-table">
			<thead>  
				<tr>
					<th width="20%" rowspan="2" class="v-align" style="text-align:left; padding-left:10px;">Subjects</th>
					$csCHRow
					
					<th rowspan="2" class="v-align">Exam  <br/> ($exam_score) </th>
					<th rowspan="2" class="v-align">Total Score </th>
					<th rowspan="2" class="v-align">Grade</th>
					<th rowspan="2" class="v-align hide-none">Remarks</th>
					<th rowspan="2" class="v-align">Rank </th>
					<th rowspan="2" class="v-align hide-none">Max Score</th>
					<th rowspan="2" class="v-align hide-none" style="text-align:left; padding-left:10px;">Teachers Remark</th>
					<th rowspan="2" width="25%" class="v-align hide-none" style="text-align:left; padding-left:10px;">Teachers Name</th>
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

		$p = $i_stop_loop + 2;
		$countNum = $foreal;
		$iT = 0; $subArr = $start_nkiru;
				
		for ($i = $i_start_loop; $i <= $i_stop_loop; $i++) {  /* loop array */
			
			$courseNum = $countNum++;		
	
			$i_score = $row_3[$f][$i]; 		
			
			if($i_score >= $fiVal){  /* check is score is greater than 1  */			
	
				$field = $course_info_mark[$subArr][3]; 						
				$score_remarks = gradeRemarks($i_score); /* grade remarks */					   
				$grade_remarks = teacherGradeRemarks($i_score); /* teacher grade remarks */					   
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
		
			echo "<tr>
				<td class='v-align font-head-1-out fs-13 text-primary fw-500'>";
				echo $course_info_mark[$subArr][2];
				echo "</td>";
				echo  $examRows;
				echo  $i_score_gr;
				echo "</td><td class='hide-none'>";
				echo  $score_remarks;
				echo "</td> <td >";
				echo  $subjectPoistion;
				echo "</td><td class='hide-none'>";
				echo $i_max_score;
				echo "</td><td 'class='hide-none'> $grade_remarks </td>
				<td class='v-align hide-none text-primary fw-500'> $sub_staff_name </td>		
			</tr>";
			
			if ($i_score_gr == 'F'){ $f_gr = $f_gr + 1; }
			if ($i_score_gr == 'D7'){ $d_gr = $d_gr + 1; }
			if ($i_score_gr == 'E8'){ $e_gr = $e_gr + 1; } 
			
			$subArr++;
			$i_score = '';
			$p = $p + 1;
			$field  = '';
			$c = $c + 1; 
				
			$sub_staff_name = '';  
			$i_score_gr = '';
			$i_max_score = '';
			$subjectPoistion = '';
			$score_remarks = '';
			$fi = ''; $se = ''; $th = ''; $fo = ''; $fif = ''; $six = '';  $ex = ''; 	
			
		}
		
		$f = $f + 1;

		$p = ''; 

		echo  "</tr>";

		echo"  <tr>
					<th style='text-align:left; padding-left:25px;' class='hide-none'>Number Of Subjects</th>
					<td class='hide-none text-theme-blue font-head-1 fw-600'>$courseNum</td>
					<th  colspan='3'>Total Score</th>
					<td class = 'text-theme-blue font-head-1 fw-600'> $total_score </td>
					<th colspan='3' style='text-align:left; padding-left:20px;'>Student Average</th>
					<td colspan='3' class = 'text-theme-blue font-head-1 fw-600'>$student_avg</td>
				</tr>
			</tbody>";

		echo "</table><!-- / table -->
		</div>";
		//echo $sdo_tb_fi_grade;  
		echo $rsAdsFooter;

			
		$studentPoistion = studentPostionSup($student_poistion);  /* student result position suffix  */ 

		if($pr_comment != ''){

			$principal_remark = $pr_comment;

		} 

$table_foot =<<<IGWEZE
						
		<!-- table -->
		<table width="100%" class="table table-hover style-table mt-50 mb-100"> 
			<tr style="border-color:#fff;">
				<td width="60%"  style="border-bottom-color : #000;">No of Students in Class : 
					<span class="tb-caption text-theme-blue font-head-1 fs-14"> $classNum </span>
				</td>
				<td width="40%" style="border-bottom-color : #000;">Position in Class :
					<span class="tb-caption text-theme-blue font-head-1 fs-14">$studentPoistion </span>
				</td> 
			</tr>	 
		</table>
		<!-- / table -->   

IGWEZE;

	echo $table_foot; 

	$regNum = ''; $regVal = ''; $row_1 = ''; $row_2 = '';  unset($row_3);

?> 