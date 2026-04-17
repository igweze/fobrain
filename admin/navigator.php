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
	This script load admin, staff and school head modules
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}


		define('fobrain', 'igweze');  /* define a check for wrong access of file */
		
		$_SESSION['activeTimer'] = time(); 

		require 'fobrain-config.php';  /* load fobrain configuration files */

		$wizg = clean($_REQUEST['iemj']);

		switch ($wizg) { 
			
			case 'subjects-1':

			require_once ($fobrainAdminDir.'class-courses.php');

			break;
			
			case 'subjects-2':

			require_once ($fobrainAdminDir.'class-courses.php');

			break;
			
			case 'subjects-3':

			require_once ($fobrainAdminDir.'class-courses.php');

			break;
			
			case 'subjects-4':

			require_once ($fobrainAdminDir.'class-courses.php');

			break;
			
			case 'subjects-5':

			require_once ($fobrainAdminDir.'class-courses.php');

			break;
			
			case 'subjects-6':

			require_once ($fobrainAdminDir.'class-courses.php');

			break; 
			
			case 'upload-results':

			require_once ($fobrainAdminGlobalDir.'upload-results.php');

			break;

			case 'upload-results-bulk':

			require_once ($fobrainAdminGlobalDir.'upload-results-bulk.php');

			break;

			case 'upload-com-bulk':

			require_once ($fobrainAdminGlobalDir.'upload-com-bulk.php');

			break; 
		
			case 'create-student':

			require_once ($fobrainAdminDir.'create-student.php');

			break;
			
			case 'create-bulk-bio':

			require_once ($fobrainAdminDir.'create-bulk-bio.php');

			break; 

			case 'search-student':

			require_once ($fobrainAdminGlobalDir.'search-student.php');

			break; 
			
			case 'export-result':
			$blankStatus = false;
			require_once ($fobrainAdminGlobalDir.'export-result.php');

			break;

			case 'export-comm-rs':
			$blankStatus = true;
			require_once ($fobrainAdminGlobalDir.'export-result.php');

			break;
			
			case 'autoScan':
			$blankStatus = true;
			require_once ($fobrainAdminGlobalDir.'autoScanExportRS.php');

			break;

			case 'class-result':

			require_once ($fobrainAdminGlobalDir.'class-result.php');

			break;

			case 'classRS':

			require_once ($fobrainFormTeacherDir.'searchRS.php');

			break;
			
			case 'roll-call':

			require_once ($fobrainAdminGlobalDir.'roll-call.php');

			break;

			case 'transcripts':

			require_once ($fobrainAdminGlobalDir.'transcripts.php');

			break;
			
			case 'student-promotion':

			require_once ($fobrainAdminGlobalDir.'student-promotion.php');

			break;

			case 'time-table':

			require_once ($fobrainAdminGlobalDir.'time-table.php');

			break;
			
			case 'events':

			require_once ($fobrainAdminGlobalDir.'events.php');

			break;
			
			case 'broadcast':
			$render_table = 1; 	
			require_once ($fobrainAdminGlobalDir.'broadcast.php');

			break;  
			
			case 'live-class':

			require_once ($fobrainAdminGlobalDir.'live-class.php');

			break;

			case 'parent-meeting':

			require_once ($fobrainAdminGlobalDir.'parent-meeting.php');

			break;

			case 'staff-meeting':

			require_once ($fobrainAdminGlobalDir.'staff-meeting.php');

			break;

			case 'e-course':

			require_once ($fobrainAdminGlobalDir.'e-course.php');

			break;

			case 'e-exam':

			require_once ($fobrainAdminGlobalDir.'e-exam.php');

			break;

			case 'bulk-exam':

			require_once ($fobrainAdminGlobalDir.'bulk-exam.php');

			break;

			case 'e-homework':

				require_once ($fobrainAdminGlobalDir.'e-homework.php');

			break; 
			
			case 'bulk-homework':

			require_once ($fobrainAdminGlobalDir.'bulk-homewk.php');

			break; 
			
			case 'assign-class':

			require_once ($fobrainAdminDir.'assign-class.php');

			break;

			/*
			
			case 'assignSubject':

			require_once ($fobrainAdminDir.'assignSubject.php');

			break;

			*/

			case 'sms-student':

			require_once ($fobrainAdminGlobalDir.'sms-student.php');

			break;

			case 'mail-student':

			require_once ($fobrainAdminGlobalDir.'mail-student.php');

			break;
			
			case 'hostel':

			require_once ($fobrainAdminDir.'hostel.php');

			break;
			
			case 'route':

			require_once ($fobrainAdminDir.'route.php');

			break;					
			
			case 'online-registration':

			require_once ($fobrainAdminGlobalDir.'online-registration.php');

			break;		 

			case 'staff-records':

			require_once ($fobrainAdminDir.'staff-records.php');

			break;

			case 'leave':

			require_once ($fobrainAdminGlobalDir.'leave.php');

			break;

			case 'payroll':

			require_once ($fobrainAdminGlobalDir.'payroll.php');

			break; 			

			case 'staff-sms':

			require_once ($fobrainAdminDir.'staff-sms.php');

			break;
			
			case 'sms-config':

			require_once ($fobrainAdminDir.'sms-config.php');

			break;
			
			case 'staff-mail':

			require_once ($fobrainAdminDir.'staff-mail.php');

			break;

			case 'virtual-gateway':

			require_once ($fobrainAdminDir.'virtual-gateway.php');

			break;

			case 'payment-gateway':

			require_once ($fobrainAdminDir.'payment-gateway.php');

			break;
			
			case 'score-grades':

			require_once ($fobrainAdminDir.'score-grades.php');

			break;

			case 'scratch-card':

			require_once ($fobrainAdminDir.'scratch-card.php');

			break;
			
			case 'wall-comp':

			require_once ($fobrainCWallIndDir);

			break;
					
			case 'inbox':

			require_once ($fobrainCInboxIndDir);

			break;
			

			case 'lock-screen':

			require_once ($fobrainAdminGlobalDir.'lock-screen.php');

			break;  

			case 'log-out':

			require_once ($fobrainAdminGlobalDir.'log-out.php'); 

			break;

			default: 
			
			require_once ($fobrainAdminGlobalDir.'common-dashboard.php'); /* admin dashboad index page */

			break;
			
				
				
		}
		
		echo "<script type='text/javascript'> hidePageLoader();	</script>";	exit; 
?>