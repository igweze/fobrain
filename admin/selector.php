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
	This script load and redirect school type
	------------------------------------------------------------------------*/
if(!session_id()){
    session_start();
}

		define('fobrain', 'igweze');  /* define a check for wrong access of file */

		require 'fobrain-config-s.php';  /* load fobrain configuration files */	 
			
		unset($_SESSION['schoolConfigs']);	

		$_SESSION['schoolConfigs'] = ""; 
	
	
		if($_REQUEST['select'] == 'login') {

			$school = $_POST['school'];
		
			/* script validation */
			
			if ($school == "")   {

				$msg_e = "* Ooops Error, please select a school to login. Thanks";

			} else { 

				$schoolSettings = schoolTypeConfig($school, $seVal); /* school type configuration  */
				
				if ((!file_exists($schoolSettings)) || ($schoolSettings == "")){  /* check if file exits */

					$msg_e = $noConnCongfigMsg;
					echo $errorMsg.$msg_e.$eEnd; echo "<script type='text/javascript'> hidePageLoader();	</script>";	
					exit; 	

				}else{  /* redirect this user */ 

					$_SESSION['schoolConfigs'] = $schoolSettings; 
					$_SESSION['school-type'] = $school;
			
					if(($admin_grade == $admin_fobrain_grd) && ($admin_level == $admin_tagged)){  /* check if admin */
						
						$login_user = $headerAdminPage;
						
					}elseif(($admin_grade == $hm_fobrain_grd) && ($admin_level == $hm_fob_tagged)){  /* check if school head */
						
						$login_user = $headerSchHeadPage;
						
					}elseif(($admin_grade == $cm_fobrain_grd) && ($admin_level == $cm_fob_tagged)){  /* check if school staff */
						
						$login_user = $headerClassManagerPage;
						
					}elseif(($admin_grade == $staff_fobrain_grd) && ($admin_level == $staff_fob_tagged)){  /* check if school staff */
						
						$login_user = $headerStaffPage;
						
					}else{  /* log this user out */
						
						$login_user = $fobrainLogOutDir; 
					}
					
					$msg_s = "*Successful, Please Wait. Page Redirecting . . . . . ";
				
					echo $succesMsg.$msg_s.$sEnd; 
					
					$_SESSION['fobrainPilot'] =  $login_user;  /* redirect user */ 
				
					echo "<script type='text/javascript'>  window.location.href = '$login_user'; hidePageLoader(); </script>";			
					exit;		
			
				} 

			} 

		}  
exit;
?>