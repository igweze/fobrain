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
	This script load database table information
	------------------------------------------------------------------------*/
 
		if (!defined('fobrain')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
			
		if(($schoolID == "") || ($fobrainDB == "")){  /* if no school type was selected */
			 
			$msg_e = "*Ooops, a Critcal Error has Occured, Please contact the developers. Thanks.";
			echo $errorMsg.$msg_e.$eEnd; echo $scroll_up; exit;
				
		}	  
		
		$i_reg_tb = $fobrainDB.'.'.$schoolTBPref.'fobrain_regno';
		$i_student_tb = $fobrainDB.'.'.$schoolTBPref.'fobrain_student_record'; 

		$class_one_sdoracle_score_tb  = $fobrainDB.'.'.$schoolTBPref.'fobrain_class_one_score';
		$class_one_sub_score_tb  = $fobrainDB.'.'.$schoolTBPref.'fobrain_class_one_sub_score';
		$class_one_sdoracle_grade_tb  = $fobrainDB.'.'.$schoolTBPref.'fobrain_class_one_grade';
		$class_one_sdoracle_comment_tb  = $fobrainDB.'.'.$schoolTBPref.'fobrain_class_one_comment';
		$class_one_sdoracle_grand_score_tb   = $fobrainDB.'.'.$schoolTBPref.'fobrain_class_one_grand_score';
		$class_one_class_remarks_tb   = $fobrainDB.'.'.$schoolTBPref.'fobrain_class_one_remark'; 
		$jss_class_repeat_tb   = $fobrainDB.'.'.$schoolTBPref.'fobrain_jss_class_repeat';

		global $i_reg_tb, $i_student_tb,
		$class_one_sdoracle_score_tb, $class_one_sub_score_tb, $class_one_sdoracle_grade_tb, $class_one_sdoracle_comment_tb,
		$class_one_sdoracle_grand_score_tb, $jss_class_repeat_tb, $class_one_class_remarks_tb;

		$class_two_sdoracle_score_tb  = $fobrainDB.'.'.$schoolTBPref.'fobrain_class_two_score';
		$class_two_sub_score_tb  = $fobrainDB.'.'.$schoolTBPref.'fobrain_class_two_sub_score';
		$class_two_sdoracle_grade_tb  = $fobrainDB.'.'.$schoolTBPref.'fobrain_class_two_grade';
		$class_two_sdoracle_comment_tb  = $fobrainDB.'.'.$schoolTBPref.'fobrain_class_two_comment';
		$class_two_sdoracle_grand_score_tb   = $fobrainDB.'.'.$schoolTBPref.'fobrain_class_two_grand_score';
		$class_two_class_remarks_tb   = $fobrainDB.'.'.$schoolTBPref.'fobrain_class_two_remark'; 

		global $class_two_sdoracle_score_tb, $class_two_sub_score_tb, $class_two_sdoracle_grade_tb, $class_two_sdoracle_comment_tb,
		$class_two_sdoracle_grand_score_tb, $class_two_class_remarks_tb; 

		$class_three_sdoracle_score_tb  = $fobrainDB.'.'.$schoolTBPref.'fobrain_class_three_score';
		$class_three_sub_score_tb  = $fobrainDB.'.'.$schoolTBPref.'fobrain_class_three_sub_score';
		$class_three_sdoracle_grade_tb  = $fobrainDB.'.'.$schoolTBPref.'fobrain_class_three_grade';
		$class_three_sdoracle_comment_tb  = $fobrainDB.'.'.$schoolTBPref.'fobrain_class_three_comment';
		$class_three_sdoracle_grand_score_tb   = $fobrainDB.'.'.$schoolTBPref.'fobrain_class_three_grand_score';
		$class_three_class_remarks_tb   = $fobrainDB.'.'.$schoolTBPref.'fobrain_class_three_remark'; 

		global $class_three_sdoracle_score_tb, $class_three_sub_score_tb, $class_three_sdoracle_grade_tb,  $class_three_sdoracle_comment_tb,       
		$class_three_sdoracle_grand_score_tb, $class_three_class_remarks_tb;

		$class_four_sdoracle_score_tb  = $fobrainDB.'.'.$schoolTBPref.'fobrain_class_four_score';
		$class_four_sub_score_tb  = $fobrainDB.'.'.$schoolTBPref.'fobrain_class_four_sub_score';
		$class_four_sdoracle_grade_tb  = $fobrainDB.'.'.$schoolTBPref.'fobrain_class_four_grade';
		$class_four_sdoracle_comment_tb  = $fobrainDB.'.'.$schoolTBPref.'fobrain_class_four_comment';
		$class_four_sdoracle_grand_score_tb   = $fobrainDB.'.'.$schoolTBPref.'fobrain_class_four_grand_score';
		$class_four_class_remarks_tb   = $fobrainDB.'.'.$schoolTBPref.'fobrain_class_four_remark'; 
		$sss_class_repeat_tb   = $fobrainDB.'.'.$schoolTBPref.'fobrain_sss_class_repeat';		 

		global $class_four_sdoracle_score_tb, $class_four_sub_score_tb, $class_four_sdoracle_grade_tb, $class_four_sdoracle_comment_tb,        
		$class_four_sdoracle_grand_score_tb, $sss_class_repeat_tb, $class_four_class_remarks_tb; 

		$class_five_sdoracle_score_tb  = $fobrainDB.'.'.$schoolTBPref.'fobrain_class_five_score';
		$class_five_sub_score_tb  = $fobrainDB.'.'.$schoolTBPref.'fobrain_class_five_sub_score';
		$class_five_sdoracle_grade_tb  = $fobrainDB.'.'.$schoolTBPref.'fobrain_class_five_grade';
		$class_five_sdoracle_comment_tb  = $fobrainDB.'.'.$schoolTBPref.'fobrain_class_five_comment';
		$class_five_sdoracle_grand_score_tb   = $fobrainDB.'.'.$schoolTBPref.'fobrain_class_five_grand_score';
		$class_five_class_remarks_tb   = $fobrainDB.'.'.$schoolTBPref.'fobrain_class_five_remark'; 
		$sss_class_repeat_tb   = $fobrainDB.'.'.$schoolTBPref.'fobrain_sss_class_repeat';		  

		global $class_five_sdoracle_score_tb, $class_five_sub_score_tb, $class_five_sdoracle_grade_tb,         
		$class_five_sdoracle_grand_score_tb, $sss_class_repeat_tb, $class_five_class_remarks_tb; 

		$class_six_sdoracle_score_tb  = $fobrainDB.'.'.$schoolTBPref.'fobrain_class_six_score';
		$class_six_sub_score_tb  = $fobrainDB.'.'.$schoolTBPref.'fobrain_class_six_sub_score';
		$class_six_sdoracle_grade_tb  = $fobrainDB.'.'.$schoolTBPref.'fobrain_class_six_grade';
		$class_six_sdoracle_comment_tb  = $fobrainDB.'.'.$schoolTBPref.'fobrain_class_six_comment';
		$class_six_sdoracle_grand_score_tb   = $fobrainDB.'.'.$schoolTBPref.'fobrain_class_six_grand_score';
		$class_six_class_remarks_tb   = $fobrainDB.'.'.$schoolTBPref.'fobrain_class_six_remark'; 
		$sss_class_repeat_tb   = $fobrainDB.'.'.$schoolTBPref.'fobrain_sss_class_repeat';		 

		global $class_six_sdoracle_score_tb, $class_six_sub_score_tb, $class_six_sdoracle_grade_tb,  $class_six_sdoracle_comment_tb,
		$class_six_sdoracle_grand_score_tb, $sss_class_repeat_tb, $class_six_class_remarks_tb, $class_six_sdoracle_grand_score_tb;

		$daily_comments_tb = $fobrainDB.'.'.$schoolTBPref.'fobrain_daily_comments';
		$classLevelTB = $fobrainDB.'.'.$schoolTBPref.'fobrain_class';
		$classFormTeachersTB = $fobrainDB.'.'.$schoolTBPref.'fobrain_form_teachers';
		$studentTimeTable = $fobrainDB.'.'.$schoolTBPref.'fobrain_timetb';
		$rsConfigTB = $fobrainDB.'.'.$schoolTBPref.'fobrain_config_rs';
		$rsExamConfigTB = $fobrainDB.'.'.$schoolTBPref.'fobrain_exams_config';
		$hostelTB = $fobrainDB.'.'.$schoolTBPref.'fobrain_hostel';
		$fobrainExamTB = $fobrainDB.'.'.$schoolTBPref.'fobrain_exams';		
		$fobrainHomeWorkTB = $fobrainDB.'.'.$schoolTBPref.'fobrain_assignment';

		$fobrainQuestionTB = $fobrainDB.'.'.$schoolTBPref.'fobrain_exam_questions';
		$fobrainHMQuestionTB = $fobrainDB.'.'.$schoolTBPref.'fobrain_assign_questions'; 

		$fobrainExamRevTB = $fobrainDB.'.'.$schoolTBPref.'fobrain_exams_review';
		$fobrainHomeWorkRevTB = $fobrainDB.'.'.$schoolTBPref.'fobrain_hm_review';

		$fobrainLiveClassTB = $fobrainDB.'.'.$schoolTBPref.'fobrain_live_class'; 

		$fobrainCourseTB = $fobrainDB.'.'.$schoolTBPref.'fobrain_courses'; 
		$fobrainChapterTB = $fobrainDB.'.'.$schoolTBPref.'fobrain_course_chapter'; 
		$fobrainCourseTopicTB = $fobrainDB.'.'.$schoolTBPref.'fobrain_course_topic';
		$fobrainQuizTB = $fobrainDB.'.'.$schoolTBPref.'fobrain_course_quiz';
		$courseReviewTB = $fobrainDB.'.'.$schoolTBPref.'fobrain_course_review';

		global $fobrainDB, $daily_comments_tb,  $rsConfigTB, $rsExamConfigTB, $classLevelTB, 
		$classFormTeachersTB, $studentTimeTable, $hostelTB, $fobrainExamTB, $fobrainExamRevTB, 
		$fobrainQuestionTB, $fobrainHomeWorkTB, $fobrainHomeWorkRevTB, $fobrainHMQuestionTB, 
		$fobrainLiveClassTB, $fobrainCourseTB, $fobrainChapterTB, $fobrainCourseTopicTB, 
		$fobrainQuizTB, $courseReviewTB; 
		 
?>	