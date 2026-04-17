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
	This script handle screen lock validation
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

	if (!defined('fobrain'))

	die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');		

	if (($_REQUEST['timer'] == 'check')){ 

		$i_password = $_REQUEST['password'];

		$i_password = strip_tags($i_password);
			
		/* script validation */ 
		
		if(($admin_grade == $admin_fobrain_grd) && ($admin_level == $admin_tagged)) {  /* check if school admin */ 

			$checkDetail =  adminLoginData($conn, $_SESSION['adminUser']);  /* school admin password details */
		
			list ($adminID, $checkedPass, $adminName) =  explode ("@(.$*S*$.)@", $checkDetail);
				
			if ($i_password == $checkedPass)   {  /* if sucessfully login user */  

				$msg_s = "Your login was successfully. Please wait, page is reloading >>>>";
				echo $succesMsg.$msg_s.$sEnd; 
				 
				unset($_SESSION['activeTimer']); 
				$_SESSION['screen_lock'] = 0000; 
				
				echo "<script type='text/javascript'>  
						setTimeout(function() {
							location.reload();
							hidePageLoader();
						},1500); 
						
					</script>"; exit;	

			}else{  /* display error */
			
				$msg_e = "* Error, Please enter your correct password!";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit; 
			
			}
		
		}else{ 

			$checkDetail =  staffLoginData($conn, $_SESSION['adminUser']);  /* school staffs/teachers password details */
		
			list ($tID, $staffUser, $checkedPass, $staffName, $staff_fobrain_grdQ, $staff_fobrain_grd, $userAccess) = 
			explode ("@(.$*S*$.)@", $checkDetail); 
			 
			if (password_verify($i_password, $userAccess)) { /* if sucessfully login user */	
				
				$msg_s = "Your login was successfully. Please wait, page is reloading >>>>";
				echo $succesMsg.$msg_s.$sEnd; 
				 
				unset($_SESSION['activeTimer']); 
				$_SESSION['screen_lock'] = 0000; 
				
				echo "<script type='text/javascript'>  
						setTimeout(function() {
							location.reload();
							hidePageLoader();
						},1500); 
						
					</script>"; exit;

			}else{  /* display error */
			
				$msg_e = "* Error, Please enter your correct password!";
				echo $errorMsg.$msg_e.$eEnd;
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
			
			} 
		
		}  
	
	}
	
exit;
?>