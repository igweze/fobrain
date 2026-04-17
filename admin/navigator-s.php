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

		require 'fobrain-config-s.php';  /* load fobrain configuration files */	   

		$wizg = clean($_REQUEST['iemj']);

		switch ($wizg) {

			
			case 'online-registration':

			require_once ($fobrainAdminGlobalDir.'online-registration.php');

			break;

			case 'session':

			require_once ($fobrainAdminDir.'session.php');

			break;
			
			case 'events':

			require_once ($fobrainAdminGlobalDir.'events.php');

			break;
			
			case 'broadcast':
			$render_table = 1; 	
			require_once ($fobrainAdminGlobalDir.'broadcast.php');

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

			case 'my-profile':

			require_once ($fobrainAdminGlobalDir.'profile.php');

			break;

			case 'my-payroll':

			require_once ($fobrainAdminGlobalDir.'payroll-staff.php');

			break;

			case 'my-leave':

			require_once ($fobrainAdminGlobalDir.'leave-staff.php');

			break;  				

			case 'staff-sms':

			require_once ($fobrainAdminDir.'staff-sms.php');

			break;
			
			case 'sms-config':

			require_once ($fobrainAdminDir.'sms-config.php');

			break;
			
			case 'mail-config':

			require_once ($fobrainAdminDir.'mail-config.php');

			break;

			case 'virtual-gateway':

			require_once ($fobrainAdminDir.'virtual-gateway.php');

			break;

			case 'payment-gateway':

			require_once ($fobrainAdminDir.'payment-gateway.php');

			break;

			case 'library-config':

			require_once ($fobrainLibraryDir.$wizg.'.php');

			break;

			case 'burs-config':

			require_once ($bursaryDir.$wizg.'.php');

			break;

			case 'score-grades':

			require_once ($fobrainAdminDir.'score-grades.php');

			break;	
			
			case 'wall-comp':

			require_once ($fobrainCWallIndDir);

			break;

			case 'inbox':

			require_once ($fobrainCInboxIndDir);

			break;

			case 'scratch-card':

			require_once ($fobrainAdminDir.'scratch-card.php');

			break;

			case 'parent-meeting':

			require_once ($fobrainAdminGlobalDir.'parent-meeting.php');

			break;

			case 'staff-meeting':

			require_once ($fobrainAdminGlobalDir.'staff-meeting.php');

			break; 

			case 'hostel':

			require_once ($fobrainAdminDir.'hostel.php');

			break;
			
			case 'route':

			require_once ($fobrainAdminDir.'route.php');

			break;	
			
			case 'lock-screen':

			require_once ($fobrainAdminGlobalDir.'lock-screen.php');

			break; 

			case 'access':

			require_once ($fobrainAdminGlobalDir.'password.php');

			break; 

			case 'log-out':

			require_once ($fobrainAdminGlobalDir.'log-out.php');

			break;

			default: 
			 
			require_once ($fobrainAdminGlobalDir.'common-dashboard.php'); 

			break;

		}
		
		echo "<script type='text/javascript'> hidePageLoader();	</script>";	exit; 
?>