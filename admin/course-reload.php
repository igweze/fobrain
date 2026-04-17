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
		
*/ 


if(!session_id()){
    session_start();
}

    	define('fobrain', 'igweze');  /* define a check for wrong access of file */

        require 'fobrain-config.php';  /* load fobrain configuration files */
		 
		if (($_REQUEST['courseLevel']) != '') {
			 
			$level = $_REQUEST['courseLevel'];
			//$term =   cleanInt($_REQUEST['courseTerm']);
		 
			try {
			
				$levelArr = studentLevelsArray($conn); /* retrive this school level data */
				array_unshift($levelArr,"");
				unset($levelArr[0]);

				$firstTSubjects = schoolCoursesInfo($conn, $schoolID, $level, $fiVal); /* retrive this level first term subjects */
				$secondTSubjects = schoolCoursesInfo($conn, $schoolID, $level, $seVal); /* retrive this level second term subjects */
				$thirdTSubjects = schoolCoursesInfo($conn, $schoolID, $level, $thVal); /* retrive this level third term subjects */

				$firstTSubjectsC = count($firstTSubjects);
				$secondTSubjectsC = count($secondTSubjects);
				$thirdTSubjectsC = count($thirdTSubjects); 
					
			}catch(PDOException $e) {
				
				fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
				
			} 

			require_once "course-wrapper.php";   

			echo "<script type='text/javascript'>   $('#subj-loader').fadeOut(3000);  hidePageLoader(); </script>"; 
           
		}else{
		
			echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
		
		} 
		
		if ($msg_s) {

			echo $succesMsg.$msg_s.$sEnd; echo $scroll_up; exit; 				
									
		}	 

		if ($msg_e) { 

			echo $errorMsg.$msg_e.$eEnd; echo $scroll_up; exit; 	 

		}	
			
exit;
?>