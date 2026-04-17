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
	This script load secondary school configurations
	------------------------------------------------------------------------*/

		if (!defined('fobrain')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
		
		$wiz_school_global = "nur";

		require 'wiz-global-configs.php';

		##############################################
		##############################################
		#######   Class One Configurations   #########
		##############################################
		##############################################

		/* database query strings */
		
		$query_select_class_one_fi_term_gran = 'jemji_to_fi, jemji_gr_fi, jemji_po_fi';

		$query_select_class_one_se_term_gran = 'jiemj_to_fi, jiemj_gr_fi, jiemj_po_fi';

		$query_select_class_one_th_term_gran = 'jmeji_to_fi, jmeji_gr_fi, jmeji_po_fi, jgrand_to_fi, jgrand_gr_fi, jgrand_po_fi';

		$i_class_one_grading_scale = array ('0', 'jemji_to_fi', 'jemji_gr_fi', 'jemji_po_fi', 'jiemj_to_fi', 'jiemj_gr_fi',
					   'jiemj_po_fi',  'jmeji_to_fi', 'jmeji_gr_fi', 'jmeji_po_fi', 'jgrand_to_fi', 
					   'jgrand_gr_fi', 'jgrand_po_fi', 'certify');

		$query_select_class_one_gran = 'jgrand_to_fi, jgrand_gr_fi, jgrand_po_fi, certify';  

		try {

			$configOneF = fobrainSchoolCoursesData($conn, $fobrainConfigTB, $schoolID, $fiVal, $fiVal); /* first term subjects array */
			$configOneS = fobrainSchoolCoursesData($conn, $fobrainConfigTB, $schoolID, $fiVal, $seVal); /* second term subjects array */
			$configOneT = fobrainSchoolCoursesData($conn, $fobrainConfigTB, $schoolID, $fiVal, $thVal); /* third term subjects array */

			$configOneFC = count($configOneF);
			$configOneSC = count($configOneS);
			$configOneTC = count($configOneT);


		}catch(PDOException $e) {

			fobrainDie( 'Ooops Database Error: ' . $e->getMessage());

		} 

		$arrOneMerge = array_merge($configOneF, $configOneS);

		$i_class_one_course_info = array_merge($arrOneMerge, $configOneT);

		array_unshift($i_class_one_course_info,"");
		unset($i_class_one_course_info[0]);

		$i_fi_start_class_one_fi_term = 1;           			 
		$i_fi_last_class_one_fi_term = $configOneFC; 

		$i_se_start_class_one_se_term = ($configOneFC + 1);    
		$i_se_last_class_one_se_term = ($configOneFC + $configOneSC); 

		$i_th_start_class_one_th_term = ($configOneFC + $configOneSC + 1);           	
		$i_th_last_class_one_th_term = ($configOneFC + $configOneSC + $configOneTC); 

		$i_gr_start_class_one = 1;           $i_gr_last_class_one = ($configOneFC + $configOneSC + $configOneTC); 

		$i_class_one_course_info_coc[] = 0;	

		#$$$$$$$$$$$ initialise first term configuation - class One $$$$$$$$$$$$$#

		$i_stop_loop_class_one_fi_term = $configOneFC; 

		$is_certify_arr_class_one_fi_term = ($configOneFC + 1); 

		#$$$$$$$$$$$ initialise second term configuation - class One $$$$$$$$$$$$$#

		$i_stop_loop_class_one_se_term = $configOneSC; 

		$is_certify_arr_class_one_se_term = ($configOneSC + 1); 

		#$$$$$$$$$$$ initialise third term configuation - class One $$$$$$$$$$$$$#

		$i_stop_loop_class_one_th_term = $configOneTC; 

		$is_certify_arr_class_one_th_term = ($configOneTC + 1);  
		
		$query_select_class_one_fi_term = ""; 
		$query_select_class_one_fi_term_to = ""; 
		$query_select_class_one_fi_term_po = "";
		$query_select_class_one_fi_term_com = "";
		
		for ($i = $i_fi_start_class_one_fi_term; $i <= $i_fi_last_class_one_fi_term; $i++){  /* loop array */ 

			$query_select_class_one_fi_term .= $i_class_one_course_info[$i][0].', ';
			$query_select_class_one_fi_term_to .= $i_class_one_course_info[$i][3].', ';
			$query_select_class_one_fi_term_po .= $i_class_one_course_info[$i][4].', ';
			$query_select_class_one_fi_term_com .= $i_class_one_course_info[$i][5].', ';

		}

		$query_select_class_one_fi_term = trim($query_select_class_one_fi_term, ', '); 

		$query_select_class_one_fi_term_to .= ' CF'; 

		$query_select_class_one_fi_term_po = trim($query_select_class_one_fi_term_po, ', ');

		$query_select_class_one_fi_term_com = trim($query_select_class_one_fi_term_com, ', '); 
		
		$query_select_class_one_se_term = ""; 
		$query_select_class_one_se_term_to = ""; 
		$query_select_class_one_se_term_po = "";
		$query_select_class_one_se_term_com = "";

		for ($i = $i_se_start_class_one_se_term; $i <= $i_se_last_class_one_se_term; $i++){  /* loop array */ 

			$query_select_class_one_se_term .= $i_class_one_course_info[$i][0].', ';
			$query_select_class_one_se_term_to .= $i_class_one_course_info[$i][3].', ';
			$query_select_class_one_se_term_po .= $i_class_one_course_info[$i][4].', ';
			$query_select_class_one_se_term_com .= $i_class_one_course_info[$i][5].', ';

		}

		$query_select_class_one_se_term = trim($query_select_class_one_se_term, ', '); 

		$query_select_class_one_se_term_to .= ' CS'; 

		$query_select_class_one_se_term_po = trim($query_select_class_one_se_term_po, ', ');

		$query_select_class_one_se_term_com = trim($query_select_class_one_se_term_com, ', ');

		$query_select_class_one_th_term = "";
		$query_select_class_one_th_term_to = "";
		$query_select_class_one_th_term_po = "";
		$query_select_class_one_th_term_com = "";

		for ($i = $i_th_start_class_one_th_term; $i <= $i_th_last_class_one_th_term; $i++){  /* loop array */ 

			$query_select_class_one_th_term .= $i_class_one_course_info[$i][0].', ';
			$query_select_class_one_th_term_to .= $i_class_one_course_info[$i][3].', ';
			$query_select_class_one_th_term_po .= $i_class_one_course_info[$i][4].', ';
			$query_select_class_one_th_term_com .= $i_class_one_course_info[$i][5].', ';

		}

		$query_select_class_one_th_term = trim($query_select_class_one_th_term, ', '); 

		$query_select_class_one_th_term_to .= ' CT'; 

		$query_select_class_one_th_term_po = trim($query_select_class_one_th_term_po, ', ');

		$query_select_class_one_th_term_com = trim($query_select_class_one_th_term_com, ', '); 

		for ($i = $i_gr_start_class_one; $i <= $i_gr_last_class_one; $i++){  /* loop array */ 

			$i_class_one_course_info_coc[] = $i_class_one_course_info[$i][0];

		}


		##############################################
		##############################################
		#######   Class Two Configurations   #########
		##############################################
		##############################################

		/* database query strings */
		
		$query_select_class_two_fi_term_gran = 'jemji_to_se, jemji_gr_se, jemji_po_se';

		$query_select_class_two_se_term_gran = 'jiemj_to_se, jiemj_gr_se, jiemj_po_se';

		$query_select_class_two_th_term_gran = 'jmeji_to_se, jmeji_gr_se, jmeji_po_se, jgrand_to_se, jgrand_gr_se, jgrand_po_se'; 

		$i_class_two_grading_scale = array ('0', 'jemji_to_se', 'jemji_gr_se', 'jemji_po_se', 'jiemj_to_se', 'jiemj_gr_se',
								   'jiemj_po_se',  'jmeji_to_se', 'jmeji_gr_se', 'jmeji_po_se', 'jgrand_to_se', 
								   'jgrand_gr_se', 'jgrand_po_se', 'certify');

		$query_select_class_two_gran = 'jgrand_to_se, jgrand_gr_se, jgrand_po_se, certify'; 

		try {

			$configTwoF = fobrainSchoolCoursesData($conn, $fobrainConfigTB, $schoolID, $seVal, $fiVal); /* first term subjects array */
			$configTwoS = fobrainSchoolCoursesData($conn, $fobrainConfigTB, $schoolID, $seVal, $seVal); /* second term subjects array */
			$configTwoT = fobrainSchoolCoursesData($conn, $fobrainConfigTB, $schoolID, $seVal, $thVal); /* third term subjects array */

			$configTwoFC = count($configTwoF);
			$configTwoSC = count($configTwoS);
			$configTwoTC = count($configTwoT);


		}catch(PDOException $e) {

			fobrainDie( 'Ooops Database Error: ' . $e->getMessage());

		}

		$arrTwoMerge = array_merge($configTwoF, $configTwoS);

		$i_class_two_course_info = array_merge($arrTwoMerge, $configTwoT);

		array_unshift($i_class_two_course_info,"");
		unset($i_class_two_course_info[0]);

		$i_fi_start_class_two_fi_term = 1;           			 
		$i_fi_last_class_two_fi_term = $configTwoFC; 

		$i_se_start_class_two_se_term = ($configTwoFC + 1);    
		$i_se_last_class_two_se_term = ($configTwoFC + $configTwoSC); 

		$i_th_start_class_two_th_term = ($configTwoFC + $configTwoSC + 1);           	
		$i_th_last_class_two_th_term = ($configTwoFC + $configTwoSC + $configTwoTC); 

		$i_gr_start_class_two = 1;           $i_gr_last_class_two = ($configTwoFC + $configTwoSC + $configTwoTC); 

		$i_class_two_course_info_coc[] = 0;	

		#$$$$$$$$$$$ initialise first term configuation - class Two $$$$$$$$$$$$$#

		$i_stop_loop_class_two_fi_term = $configTwoFC; 

		$is_certify_arr_class_two_fi_term = ($configTwoFC + 1); 

		#$$$$$$$$$$$ initialise second term configuation - class Two $$$$$$$$$$$$$#

		$i_stop_loop_class_two_se_term = $configTwoSC; 

		$is_certify_arr_class_two_se_term = ($configTwoSC + 1); 

		#$$$$$$$$$$$ initialise third term configuation - class Two $$$$$$$$$$$$$#

		$i_stop_loop_class_two_th_term = $configTwoTC; 

		$is_certify_arr_class_two_th_term = ($configTwoTC + 1);  

		$query_select_class_two_fi_term = "";
		$query_select_class_two_fi_term_to = "";
		$query_select_class_two_fi_term_po = "";
		$query_select_class_two_fi_term_com = "";

		for ($i = $i_fi_start_class_two_fi_term; $i <= $i_fi_last_class_two_fi_term; $i++){  /* loop array */ 

			$query_select_class_two_fi_term .= $i_class_two_course_info[$i][0].', ';
			$query_select_class_two_fi_term_to .= $i_class_two_course_info[$i][3].', ';
			$query_select_class_two_fi_term_po .= $i_class_two_course_info[$i][4].', ';
			$query_select_class_two_fi_term_com .= $i_class_two_course_info[$i][5].', ';

		}

		$query_select_class_two_fi_term = trim($query_select_class_two_fi_term, ', '); 

		$query_select_class_two_fi_term_to .= ' CF'; 

		$query_select_class_two_fi_term_po = trim($query_select_class_two_fi_term_po, ', ');

		$query_select_class_two_fi_term_com = trim($query_select_class_two_fi_term_com, ', ');	 

		$query_select_class_two_se_term = "";
		$query_select_class_two_se_term_to = "";
		$query_select_class_two_se_term_po = "";
		$query_select_class_two_se_term_com = "";

		for ($i = $i_se_start_class_two_se_term; $i <= $i_se_last_class_two_se_term; $i++){  /* loop array */ 

			$query_select_class_two_se_term .= $i_class_two_course_info[$i][0].', ';
			$query_select_class_two_se_term_to .= $i_class_two_course_info[$i][3].', ';
			$query_select_class_two_se_term_po .= $i_class_two_course_info[$i][4].', ';
			$query_select_class_two_se_term_com .= $i_class_two_course_info[$i][5].', ';

		}

		$query_select_class_two_se_term = trim($query_select_class_two_se_term, ', '); 

		$query_select_class_two_se_term_to .= ' CS'; 

		$query_select_class_two_se_term_po = trim($query_select_class_two_se_term_po, ', ');

		$query_select_class_two_se_term_com = trim($query_select_class_two_se_term_com, ', '); 

		$query_select_class_two_th_term = "";
		$query_select_class_two_th_term_to = "";
		$query_select_class_two_th_term_po = "";
		$query_select_class_two_th_term_com = "";
			
		for ($i = $i_th_start_class_two_th_term; $i <= $i_th_last_class_two_th_term; $i++){  /* loop array */ 

			$query_select_class_two_th_term .= $i_class_two_course_info[$i][0].', ';
			$query_select_class_two_th_term_to .= $i_class_two_course_info[$i][3].', ';
			$query_select_class_two_th_term_po .= $i_class_two_course_info[$i][4].', ';
			$query_select_class_two_th_term_com .= $i_class_two_course_info[$i][5].', ';

		}

		$query_select_class_two_th_term = trim($query_select_class_two_th_term, ', '); 

		$query_select_class_two_th_term_to .= ' CT'; 

		$query_select_class_two_th_term_po = trim($query_select_class_two_th_term_po, ', ');

		$query_select_class_two_th_term_com = trim($query_select_class_two_th_term_com, ', '); 

		for ($i = $i_gr_start_class_two; $i <= $i_gr_last_class_two; $i++){  /* loop array */ 

			$i_class_two_course_info_coc[] = $i_class_two_course_info[$i][0];

		}


		##############################################
		##############################################
		#######   Class Three Configurations   #######
		##############################################
		##############################################


		/* database query strings */
		
		$query_select_class_three_fi_term_gran = 'jemji_to_th, jemji_gr_th, jemji_po_th';

		$query_select_class_three_se_term_gran = 'jiemj_to_th, jiemj_gr_th, jiemj_po_th';

		$query_select_class_three_th_term_gran = 'jmeji_to_th, jmeji_gr_th, jmeji_po_th, jgrand_to_th, jgrand_gr_th, jgrand_po_th'; 

		$i_class_three_grading_scale = array ('0', 'jemji_to_th', 'jemji_gr_th', 'jemji_po_th', 'jiemj_to_th', 'jiemj_gr_th',
									   'jiemj_po_th',  'jmeji_to_th', 'jmeji_gr_th', 'jmeji_po_th', 'jgrand_to_th', 
									   'jgrand_gr_th', 'jgrand_po_th', 'certify');

		$query_select_class_three_gran = 'jgrand_to_se, jgrand_gr_th, jgrand_po_th, certify'; 

		try {

			$configThreeF = fobrainSchoolCoursesData($conn, $fobrainConfigTB, $schoolID, $thVal, $fiVal); /* first term subjects array */
			$configThreeS = fobrainSchoolCoursesData($conn, $fobrainConfigTB, $schoolID, $thVal, $seVal); /* second term subjects array */
			$configThreeT = fobrainSchoolCoursesData($conn, $fobrainConfigTB, $schoolID, $thVal, $thVal); /* third term subjects array */

			$configThreeFC = count($configThreeF);
			$configThreeSC = count($configThreeS);
			$configThreeTC = count($configThreeT); 

		}catch(PDOException $e) {

			fobrainDie( 'Ooops Database Error: ' . $e->getMessage());

		} 

		$arrThreeMerge = array_merge($configThreeF, $configThreeS);

		$i_class_three_course_info = array_merge($arrThreeMerge, $configThreeT);

		array_unshift($i_class_three_course_info,"");
		unset($i_class_three_course_info[0]);

		$i_fi_start_class_three_fi_term = 1;           			 
		$i_fi_last_class_three_fi_term = $configThreeFC; 

		$i_se_start_class_three_se_term = ($configThreeFC + 1);    
		$i_se_last_class_three_se_term = ($configThreeFC + $configThreeSC); 

		$i_th_start_class_three_th_term = ($configThreeFC + $configThreeSC + 1);           	
		$i_th_last_class_three_th_term = ($configThreeFC + $configThreeSC + $configThreeTC); 

		$i_gr_start_class_three = 1;           $i_gr_last_class_three = ($configThreeFC + $configThreeSC + $configThreeTC); 

		$i_class_three_course_info_coc[] = 0;	

		#$$$$$$$$$$$ initialise first term configuation - class Three $$$$$$$$$$$$$#

		$i_stop_loop_class_three_fi_term = $configThreeFC; 

		$is_certify_arr_class_three_fi_term = ($configThreeFC + 1); 

		#$$$$$$$$$$$ initialise second term configuation - class Three $$$$$$$$$$$$$#

		$i_stop_loop_class_three_se_term = $configThreeSC; 

		$is_certify_arr_class_three_se_term = ($configThreeSC + 1); 

		#$$$$$$$$$$$ initialise third term configuation - class Three $$$$$$$$$$$$$#

		$i_stop_loop_class_three_th_term = $configThreeTC; 

		$is_certify_arr_class_three_th_term = ($configThreeTC + 1);  

		$query_select_class_three_fi_term = "";
		$query_select_class_three_fi_term_to = "";
		$query_select_class_three_fi_term_po = "";
		$query_select_class_three_fi_term_com = "";
			

		for ($i = $i_fi_start_class_three_fi_term; $i <= $i_fi_last_class_three_fi_term; $i++){  /* loop array */ 

			$query_select_class_three_fi_term .= $i_class_three_course_info[$i][0].', ';
			$query_select_class_three_fi_term_to .= $i_class_three_course_info[$i][3].', ';
			$query_select_class_three_fi_term_po .= $i_class_three_course_info[$i][4].', ';
			$query_select_class_three_fi_term_com .= $i_class_three_course_info[$i][5].', ';

		}

		$query_select_class_three_fi_term = trim($query_select_class_three_fi_term, ', '); 

		$query_select_class_three_fi_term_to .= ' CF'; 

		$query_select_class_three_fi_term_po = trim($query_select_class_three_fi_term_po, ', ');

		$query_select_class_three_fi_term_com = trim($query_select_class_three_fi_term_com, ', ');		  

		$query_select_class_three_se_term = "";
		$query_select_class_three_se_term_to = "";
		$query_select_class_three_se_term_po = "";
		$query_select_class_three_se_term_com = "";

		for ($i = $i_se_start_class_three_se_term; $i <= $i_se_last_class_three_se_term; $i++){  /* loop array */ 

			$query_select_class_three_se_term .= $i_class_three_course_info[$i][0].', ';
			$query_select_class_three_se_term_to .= $i_class_three_course_info[$i][3].', ';
			$query_select_class_three_se_term_po .= $i_class_three_course_info[$i][4].', ';
			$query_select_class_three_se_term_com .= $i_class_three_course_info[$i][5].', ';

		}

		$query_select_class_three_se_term = trim($query_select_class_three_se_term, ', '); 

		$query_select_class_three_se_term_to .= ' CS'; 

		$query_select_class_three_se_term_po = trim($query_select_class_three_se_term_po, ', ');

		$query_select_class_three_se_term_com = trim($query_select_class_three_se_term_com, ', '); 

		$query_select_class_three_th_term = "";
		$query_select_class_three_th_term_to = "";
		$query_select_class_three_th_term_po = "";
		$query_select_class_three_th_term_com = "";
			
		for ($i = $i_th_start_class_three_th_term; $i <= $i_th_last_class_three_th_term; $i++){  /* loop array */ 

			$query_select_class_three_th_term .= $i_class_three_course_info[$i][0].', ';
			$query_select_class_three_th_term_to .= $i_class_three_course_info[$i][3].', ';
			$query_select_class_three_th_term_po .= $i_class_three_course_info[$i][4].', ';
			$query_select_class_three_th_term_com .= $i_class_three_course_info[$i][5].', ';

		}

		$query_select_class_three_th_term = trim($query_select_class_three_th_term, ', '); 

		$query_select_class_three_th_term_to .= ' CT'; 

		$query_select_class_three_th_term_po = trim($query_select_class_three_th_term_po, ', ');

		$query_select_class_three_th_term_com = trim($query_select_class_three_th_term_com, ', ');	 

		for ($i = $i_gr_start_class_three; $i <= $i_gr_last_class_three; $i++){  /* loop array */ 

			$i_class_three_course_info_coc[] = $i_class_three_course_info[$i][0];

		}


?>