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

     define('fobrain', 'igweze');  /* define a check for wrong access of file */

         require 'fobrain-config.php';  /* load fobrain configuration files */	   
		
			if (($_REQUEST['timer'] == 'check')){

				$i_password = strip_tags($_REQUEST['password']); 
			 

				if ($i_password == "")   {
			 
					$msg_e = "* Error, please enter your password!";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'> hidePageLoader(); </script>";
					exit; 			
			 
				}else{
					
					try {
						
						$retrieve_data =  studentParentPassword($conn, $regNum, $_SESSION['isParent']);
						list ($regID_q, $retrieve_pass) =  explode ("{<?.@.?>}", $retrieve_data);
						 
						if (password_verify($i_password, $retrieve_pass)) { /* if sucessfully login user */	
							
							$msg_s = "Your login was successfully. Please wait, page is reloading >>>>";
							echo $succesMsg.$msg_s.$sEnd;
							
							unset($_SESSION['lastActive']); 
							$_SESSION['screen_lock'] = 0000; 
							
							echo "<script type='text/javascript'>  
									setTimeout(function() {
										location.reload();
										hidePageLoader();
									},1500); 
									
								</script>"; exit;							
							
						}else{
							
							$msg_e = "Ooops error, your password is incorrect.";
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'> hidePageLoader(); </script>";
							exit; 		
							
						}	 
				
					}catch(PDOException $e) {
  			
						fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					} 
		 
		 		} 
		 
		 	} 
exit; 
?> 