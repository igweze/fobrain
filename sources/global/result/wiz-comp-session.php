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
	This script handle student annual transcript
	------------------------------------------------------------------------*/ 


		if (!defined('fobrain')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
  
			 
			$gradeArray = gradeDataArr($conn);   /* school grade array */
			
			/* select student result information */
			
			$ebele_mark_1 = "SELECT r.nk_regno, f.$queryUserBio

							FROM $i_reg_tb r INNER JOIN $i_student_tb f
						
							ON (r.ireg_id = f.ireg_id)

							AND r.session_id = :session_id 
					 
							AND r.$nk_class = :class

							AND r.active = :foreal
					  
							AND r.nk_regno =  :nk_regno";
			   
				 
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
					$student_name = "$lname $mname $fname";
					
				}	 
			 
				$student_img = picture($school_pic_dir.$session_fi.'_'.$session_se.'/', $pic, "student"); 
				
			}

			$curSess = currentSessionInfo($conn); /* current school session */			
			list ($curSessID, $cSess) = explode ("@$@", $curSess);	
			$next_begin = termStartDate($conn, $curSessID, $term);  /* retrieve school next term start  */

			$academic_yr = recentAcademicYear($level, $session_fi);  /* school session academic year  */
			$levelArray = studentLevelsArray($conn); /* student level array */
			$trimLevel = ($level - $fiVal); 
			$student_level = $levelArray[$trimLevel]['level'];

			$clArray = studentClassArray($conn, $level);  /* retrieve student class array */			
			$classArray = unserialize($clArray);			

			$class_index = array_search($class, $class_list);
			$class_m = $classArray[$class_index]; 
             

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
			<table class="table table-sm table-hover table-responsive">
			<thead>  
				<tr>
					<th>S/N</th>
					<th>Course</th>
					<th><span class="vertical-lr rotated">1st Term Score</span></th>
					<th><span class="vertical-lr rotated">2nd Term Score</span></th>
					<th><span class="vertical-lr rotated">3rd Term Score</span></th>
					<th><span class="vertical-lr rotated">Total</span></th>
					<th><span class="vertical-lr rotated">Average </span></th>
					<!-- <th><span class="vertical-lr rotated">Class Average</span></th> -->
					<th><span class="vertical-lr rotated"> Grade</span></th>
					<th class="hide-none">   Teacher's   Remark</th>
					<!-- <th>Subject <br />  Teacher's <br /> Signature</th> -->
				</tr>
			</thead>
			<tbody>	


IGWEZE;

			echo $table_body;
		
		
				/* select student first term result as array */
				
				$term = $fi_term; $promotionStatus = false;	$subfCounter = 0;	
		
        		require  $fobrainClassConfigDir;   /* include class configuration script */ 				

			    $ebele_mark_1 = "SELECT r.nk_regno, f.$query_i_strings

                         	    FROM $i_reg_tb r INNER JOIN $sdoracle_sub_score_nk f
								
								ON (r.ireg_id = f.ireg_id)

                          		AND r.session_id = :session_id 
						 
						  		AND r.$nk_class = :class

				          		AND r.active = :foreal
						  
						  		AND r.nk_regno =  :nk_regno"; 
					 
 			    $igweze_prep_1 = $conn->prepare($ebele_mark_1);
  				$igweze_prep_1->bindValue(':nk_regno', $regNum, PDO::PARAM_STR);				
				$igweze_prep_1->bindValue(':session_id', $sessionID, PDO::PARAM_STR);				
				$igweze_prep_1->bindValue(':foreal', $foreal, PDO::PARAM_STR);				
				$igweze_prep_1->bindValue(':class', $class, PDO::PARAM_STR);				 
 				$igweze_prep_1->execute();
				
				$rows_count_1 = $igweze_prep_1->rowCount(); 
				
				if($rows_count_1 == $foreal) {  /* check array is empty */
				
					while($row_1[] = $igweze_prep_1->fetch(PDO::FETCH_BOTH)) {  /* loop array */ }	 
				
				}
				
				/* select student second term result as array */
				
				$term = $se_term; $promotionStatus = false;	$subfCounter = 0;	
		
        		require  $fobrainClassConfigDir;   /* include class configuration script */ 	 

			    $ebele_mark_2 = "SELECT r.nk_regno, f.$query_i_strings

                         	    FROM $i_reg_tb r INNER JOIN $sdoracle_sub_score_nk f
								
								ON (r.ireg_id = f.ireg_id)

                          		AND r.session_id = :session_id 
						 
						  		AND r.$nk_class = :class

				          		AND r.active = :foreal
						  
						  		AND r.nk_regno =  :nk_regno"; 
					 
 			    $igweze_prep_2 = $conn->prepare($ebele_mark_2);
  				$igweze_prep_2->bindValue(':nk_regno', $regNum, PDO::PARAM_STR);				
				$igweze_prep_2->bindValue(':session_id', $sessionID, PDO::PARAM_STR);				
				$igweze_prep_2->bindValue(':foreal', $foreal, PDO::PARAM_STR);				
				$igweze_prep_2->bindValue(':class', $class, PDO::PARAM_STR);				 
 				$igweze_prep_2->execute();
				
				$rows_count_2 = $igweze_prep_2->rowCount(); 
				
				if($rows_count_2 == $foreal) {  /* check array is empty */
				
					while($row_2[] = $igweze_prep_2->fetch(PDO::FETCH_BOTH)) {  /* loop array */ }	
				
				}
				
				/* select student third term result as array */

				$term = $th_term; $promotionStatus = false;	$subfCounter = 0;	
		
        		require  $fobrainClassConfigDir;	   /* include class configuration script */ 

			    $ebele_mark_3 = "SELECT r.nk_regno, f.$query_i_strings

                         	    FROM $i_reg_tb r INNER JOIN $sdoracle_sub_score_nk f
								
								ON (r.ireg_id = f.ireg_id)

                          		AND r.session_id = :session_id 
						 
						  		AND r.$nk_class = :class

				          		AND r.active = :foreal
						  
						  		AND r.nk_regno =  :nk_regno"; 
					 
 			    $igweze_prep_3 = $conn->prepare($ebele_mark_3);
  				$igweze_prep_3->bindValue(':nk_regno', $regNum, PDO::PARAM_STR);				
				$igweze_prep_3->bindValue(':session_id', $sessionID, PDO::PARAM_STR);				
				$igweze_prep_3->bindValue(':foreal', $foreal, PDO::PARAM_STR);				
				$igweze_prep_3->bindValue(':class', $class, PDO::PARAM_STR);				 
 				$igweze_prep_3->execute();
				
				$rows_count_3 = $igweze_prep_3->rowCount(); 
				
				if($rows_count_3 == $foreal) {  /* check array is empty */
				
					while($row_3[] = $igweze_prep_3->fetch(PDO::FETCH_BOTH))  {  /* loop array */ }	
				
				}
				
			   	$f = 0; 	 $c = 0;   
	   			$c = ($i_stop_loop * 2) + 1;
	   
				$p = $i_stop_loop + 2;
       			$countNum = $foreal;
				$courseNumC = $i_false;
				$subArr = $i_start_loop; $m_i = 1;
				
				$serialNo = 0;
				$fiTermAnnTotal = 0;
				$seTermAnnTotal  = 0;
				$thTermAnnTotal  = 0;
				$annualTotala  = 0;

				$d_gr = 0; $e_gr = 0; $f_gr = 0; 

	   			for ($i = $i_start_loop; $i <= $i_stop_loop; $i++) {  /* loop array */
					
					$CourseNum = $countNum++;	
					$serialNo++;
					
					$fiTermTotal = $row_1[$f][$i];
					$seTermTotal = $row_2[$f][$i];
					$thTermTotal = $row_3[$f][$i];
					
					if($fiTermTotal >= $fiVal){ $fiTermDiv = $fiVal; $courseNumC++;}
					else{$fiTermDiv = $i_false; $fiTermTotal = "-"; }
					
					if($seTermTotal >= $fiVal){ $seTermDiv = $fiVal; $courseNumC++;}
					else{$seTermDiv = $i_false; $seTermTotal = "-";}
					
					if($thTermTotal >= $fiVal){ $thTermDiv = $fiVal; $courseNumC++;}
					else{$thTermDiv = $i_false; $thTermTotal = "-"; }
					
					$subAnnualDiv = ($fiTermDiv + $seTermDiv + $thTermDiv);
					$subAnnualTotal = ($fiTermTotal + $seTermTotal + $thTermTotal);
					
					if (($subAnnualTotal > $fiVal) && ($subAnnualDiv > $fiVal)) {
						
						$subAnnualAvg = ($subAnnualTotal/$subAnnualDiv);					
						$subAnnualAvg = number_format($subAnnualAvg, 1);
						
						$gradeRemarkAbbr = fobrainGradeScore($gradeArray, $subAnnualAvg); /* student grades score */
						$gradeRemark = teacherGradeRemarks($subAnnualAvg); /* teacher grade remarks */ 
					
					}else{ $subAnnualAvg = " - "; $subAnnualTotal = " - "; $gradeRemarkAbbr = " - "; $gradeRemark = " - "; }
					
					
					
       				echo "<tr><td>$serialNo</td >
					
					<td class='font-head-1-out fs-13 text-primary fw-500'>";
       				echo $course_info_mark[$subArr][2];					
       				echo "</td><td>";
       				echo  $fiTermTotal;
	   				echo "</td><td>";
					echo  $seTermTotal;
	   				echo "</td><td>";
					echo  $thTermTotal;
	   				echo "</td><td>";
					echo  $subAnnualTotal;
	   				echo "</td><td>";
					echo  $subAnnualAvg;
	   				echo "</td><!-- <td>";
					echo  "&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;";
	   				echo "</td>--> <td>&nbsp;&nbsp;";
					echo  $gradeRemarkAbbr;
	   				echo "&nbsp;&nbsp;</td><td class='hide-none'>";
					echo  $gradeRemark;
	   				echo "</td><!-- <td>";
					echo  " - ";
	   				echo "</td>-->";

	   				echo "</tr>";
					
					$fiTermAnnTotal += $fiTermTotal;
					$seTermAnnTotal += $seTermTotal;
					$thTermAnnTotal += $thTermTotal;
					
					$annualTotala += $subAnnualTotal; 
	   
	   				if ($subAnnualAvg == 'F'){ $f_gr = $f_gr + 1; }
	   				if ($subAnnualAvg == 'D7'){ $d_gr = $d_gr + 1; }
	   				if ($subAnnualAvg == 'E8'){ $e_gr = $e_gr + 1; }
					
					$subAnnualTotal = ""; $subAnnualDiv = ""; $gradeRemark = ""; $gradeRemarkAbbr = "";
	   
	   				$subArr++;
					$i_score = '';
	   				$p = $p + 1;
	   				$field  = '';
	   				$c = $c + 1;
	   				$i_max_score = ''; 
	 	   
				}
			
				if($fiTermAnnTotal >= $fiVal){ $fiAnnDiv = $fiVal;}
				else{$fiAnnDiv = $i_false; $fiTermTotal = "0"; }
				
				if($seTermAnnTotal >= $fiVal){ $seAnnDiv = $fiVal;}
				else{$seAnnDiv = $i_false; $seTermTotal = "0";}
				
				if($thTermAnnTotal >= $fiVal){ $thAnnDiv = $fiVal;}
				else{$thAnnDiv = $i_false; $thTermTotal = "0"; } 
				
				$annualDiv = ($fiAnnDiv + $seAnnDiv + $thAnnDiv);
				$annualTotal = ($fiTermAnnTotal + $seTermAnnTotal + $thTermAnnTotal); 

				if($annualDiv != 0){
				
					$annualAvg = ($annualTotal/$annualDiv);
					
					$annualAvg = number_format($annualAvg, 1);
					
					$annualAverage = ($annualTotal/$courseNumC);
					
					$annualAverage = number_format($annualAverage, 1); 

				}else{

					$annualAvg = ""; 
					
					$annualAverage = ""; 

				}
				
				echo "<tr><td>";
								
				echo "</td><th style='text-align:right; padding-right:30px;'>Grand Total</th>
				<td class = 'text-primary font-head-1 fw-600'>";
				echo  $fiTermAnnTotal;
				echo "</td><td class = 'text-primary font-head-1 fw-600'>";
				echo  $seTermAnnTotal;
				echo "</td><td class = 'text-primary font-head-1 fw-600'>";
				echo  $thTermAnnTotal;
				echo "</td><td class = 'text-primary font-head-1 fw-600'>";
				echo  "$annualTotal";
				echo "</td><td class = 'text-primary font-head-1 fw-600'>";
				echo  $annualAvg;
				echo "</td><td colspan='3'></td>";	  

				echo "</tr>"; 

       			$f = $f + 1;
 
	   			$p = '';
      			
       			echo "</tbody>	
				</table><!-- / table --></div>"; 
	   			
				$classNum = studentClassCount($conn, $sessionID, $class, $level);  /* count student class */
				$next_begin = termStartDate($conn, $sessionID, $term);  /* retrieve school next term start  */
				$gsRemarkArray = teacherRemarksArrays($conn);  /* teacher remarks array */ 
			
				$ebele_mark = "SELECT r.nk_regno, c.$comment_r, $comment_t, $pr_comment_r

								FROM $i_reg_tb r INNER JOIN $sdoracle_student_remark_nk c
							
								ON (r.ireg_id = c.ireg_id)

                          		AND r.session_id = :session_id 
						 
						  		AND r.$nk_class = :class

				          		AND r.active = :foreal
						  
						  		AND r.nk_regno =  :nk_regno"; 
					 
 			    $igweze_prep = $conn->prepare($ebele_mark);
  				$igweze_prep->bindValue(':nk_regno', $regNum, PDO::PARAM_STR);				
				$igweze_prep->bindValue(':session_id', $sessionID, PDO::PARAM_STR);				
				$igweze_prep->bindValue(':foreal', $foreal, PDO::PARAM_STR);				
				$igweze_prep->bindValue(':class', $class, PDO::PARAM_STR);				 
 				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count == $foreal) {  /* check array is empty */
				
					while($row = $igweze_prep->fetch(PDO::FETCH_BOTH)) {  /* loop array */		
	   
        				$comment = $row[$comment_r];
						$ftRemark = $row[$comment_t];
						$pr_comment = $row[$pr_comment_r];
													
					}	 
				
				} 
				
				$ebele_mark_4 = "SELECT r.nk_regno, f.$query_i_strings_nj

								FROM $i_reg_tb r INNER JOIN $sdoracle_grand_score_nk f
							
								ON (r.ireg_id = f.ireg_id)

                          		AND r.session_id = :session_id 
						 
						  		AND r.$nk_class = :class

				          		AND r.active = :foreal
						  
						  		AND r.nk_regno = :nk_regno"; 
					 
 			    $igweze_prep_4 = $conn->prepare($ebele_mark_4);
  				$igweze_prep_4->bindValue(':nk_regno', $regNum, PDO::PARAM_STR);				
				$igweze_prep_4->bindValue(':session_id', $sessionID, PDO::PARAM_STR);				
				$igweze_prep_4->bindValue(':foreal', $foreal, PDO::PARAM_STR);				
				$igweze_prep_4->bindValue(':class', $class, PDO::PARAM_STR);
				 
 				$igweze_prep_4->execute();
				
				$rows_count_4 = $igweze_prep_4->rowCount(); 
				
				if($rows_count_4 == $foreal) {  /* check array is empty */
				
					while($row_4 = $igweze_prep_4->fetch(PDO::FETCH_BOTH)) {  /* loop array */		

			   	     	/*
							$total_score = $row_4[1]; 
							$student_avg = $row_4[2]; 
							$student_poistion = $row_4[3]; 
							$session_total = $row_4[4]; 
						*/
						$session_avg = $row_4[5]; 
						$session_poistion = $row_4[6]; 

					}	
				
				}
				
				$principalData = staffData($conn, $schoolHead);  /* school staffs/teachers information */
				list ($princ_title, $princ_fullname, $princ_sex, $princ_rankingVal, $princ_picture, 
					  $princ_lname, $princ_phone, $princ_sign) = explode ("#@s@#", $principalData);
	
				$titleVal = $title_list[$princ_title];
				$schoolPrincipal = $titleVal.' '.$princ_fullname;
								
				$formTeacher = formTeacher($conn, $sessionID, $level, $class);  /* retrieve assign class teacher information */
				
				$formTeacherSign = formTeacherSignatures($conn, $sessionID, $level, $class); /* retrieve assign class teacher signature */

			    //$gsRemark = $i_teachers_remark_list[$comment];
				
				$gsRemark = $gsRemarkArray[$comment]['name'];

	   		    $principal_remark = fobrainPrincipalRemarks($annualAvg, $d_gr, $e_gr, $f_gr); /* principal auto remarks */
				
				if($pr_comment != ''){
					
					$principal_remark = $pr_comment;
					
				} 

				$prin_img = picture($staff_doc_ext, $princ_sign, "sign");
				$principal_sign = '<img src="'.$prin_img.'" style="height: 60px; width:130px; margin-top:0px;">';
				
				$annualPoistion = studentPostionSup($session_poistion);  /* student result position suffix  */
				
				$promotedSub = classPromotionManager($conn, $sdoracle_grand_score_nk, $regNum);  /* school class student promotion manager */
				
				echo $rsAdsFooter; 

				$annualClassDiv = 'Annual Position <span class="hide-none"> in Class</span> : ';

				if($rsType == $seVal){ 

					$annualPoistion = "";
					$annualClassDiv = "";

				}	
	   
$table_foot =<<<IGWEZE
                         
				<!-- table -->
				<table width="100%" class="table  style-table mt-20">
				  
					<tr>
						<td width="50%"  style="border-bottom-color : #000;"><span class="hide-none">Student's</span> Annual Total Score : 
						<span class="tb-caption text-primary font-head-1 fs-14"> $annualTotal </span></td>
						<td width="50%" style="border-bottom-color : #000;"><span class="hide-none">Student's</span> Annual Average: 
						<span class="tb-caption text-primary font-head-1 fs-14"> $annualAverage </span></td>
					</tr>
					
					<tr>
						<td width="50%"  style="border-bottom-color : #000;">No of Students :  
						<span class="tb-caption text-primary font-head-1 fs-14"> $classNum </span></td>
						<td width="50%" style="border-bottom-color : #000;">$annualClassDiv
						<span class="tb-caption text-primary font-head-1 fs-14"> $annualPoistion </span></td>
					</tr>
					<!--
					<tr>
						<td colspan="2"> Guidance &amp; Counsellor's Name :
						<span class="tb-caption text-primary font-head-1 fs-14">   </span>  </td>

					</tr>

					<tr>
						<td width="50%" style="border-bottom-color : #000;">
						Guidance &amp; Counsellor's Comments : 
						<span class="tb-caption text-primary font-head-1 fs-14"> $gsRemark  </span> </td>
						<td width="50%" style="border-bottom-color : #000;">Signature 	_____________________________ </td>
					</tr>
					-->
					<tr>
						<td colspan="2"> 
							<div class="row gutters bb-1-bk py-10"> 
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ps-15">
									Form Teacher Name :
									<span class="text-primary font-head-1 fs-13"> $formTeacher </span>
								</div>
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ps-15">
									Principal Name :
									<span class="text-primary font-head-1 fs-13"> $schoolPrincipal </span> 
								</div> 
							</div> 
							<div class="row gutters bb-1-bk py-10"> 
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ps-15">
									Form Teacher Comments :
									<span class="text-primary font-head-1 fs-13"> $ftRemark $gsRemark </span> 
								</div>
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ps-15">
									Principal Comments :
									<span class="text-primary font-head-1 fs-13"> $promotedSub  </span> 
								</div> 
							</div>  
							<div class="row gutters bb-1-bk py-10"> 
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ps-15">
									<div class="row py-10 ps-15">
										<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 v-align">
											<div class="text-primary font-head-1 fs-14 mt-15 me-10">Signature</div>
										</div>	
										<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
											<div class="row p-0 m-0">
												$formTeacherSign  
											</div>
										</div>
									</div> 
								</div>
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ps-15">
									<div class="row py-10 ps-15">
										<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 v-align">
											<div class="text-primary font-head-1 fs-14 mt-15 me-10">Signature</div>
										</div>	
										<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
											<div class="row p-0 m-0">
												$principal_sign  
											</div>
										</div>
									</div>
								</div> 
							</div> 
						</td>
					</tr> 
				</table>            
				<!-- /table -->

IGWEZE;

				echo $table_foot; 

				echo "
				     
                </div>";	 

?> 