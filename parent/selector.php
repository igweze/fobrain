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

		require 'fobrain-config.php';  /* load fobrain configuration files */	 
		 
		if($_REQUEST['select'] == 'children') { 

			$regNum = clean($_REQUEST['selector']);
		
			/* script validation */
			
			if ($regNum == "")   {

				$msg_e = "* Ooops Error, please select a child to access. Thanks";
				echo $errorMsg.$msg_e.$eEnd; echo "<script type='text/javascript'> hidePageLoader();</script>";	
				exit;

			} else {    

				$handleC = explode("/", $regNum);
				$handleCount = count($handleC); 

				if($handleCount == $thVal){

					list ($schAbbr, $username, $school) =  explode ("/", $regNum);	

				}else{	

					list ($username, $school) =  explode ("/", $regNum);	

				}	 

				$schoolSettings = schoolTypeConfig($school, $seVal);  /* school type configuration  */  
				
				if ((!file_exists($schoolSettings)) || ($schoolSettings == "")){  /* check if file exits */

					$msg_e = $noConnCongfigMsg;
					echo $errorMsg.$msg_e.$eEnd; echo "<script type='text/javascript'> hidePageLoader();</script>";	
					exit; 	

				}else{  /* redirect this user */ 

					require ($schoolSettings);
					require_once $fobrainDBConnectDir;  /* load connection string */
					require_once $fobrainFunctionDir;  /* load script functions */ 

					$regID = studentRegID($conn, $regNum);

					if(($regID == "") || ($regID = 0)){

						$msg_e = "Ooops, could not find user information";
						echo $errorMsg.$msg_e.$eEnd; echo "<script type='text/javascript'> hidePageLoader();</script>";	
						exit; 	

					}else{

						unset($_SESSION['schoolConfigs']);	 $_SESSION['schoolConfigs'] = ""; 
						unset($_SESSION['regNo']);	 $_SESSION['regNo'] = ""; 
						unset($_SESSION['regID']);	 $_SESSION['regID'] = "";  

						$_SESSION['regNo'] = $regNum;  		   
						$_SESSION['regID'] = $regID; 
						$_SESSION['schoolConfigs'] = $schoolSettings;   
						
						$msg_s = "*Successful, Please Wait. Page Reeloading . . . . . "; 
						echo $succesMsg.$msg_s.$sEnd;  
						echo "<script type='text/javascript'>  location.reload(); hidePageLoader();</script>";			
						exit; 

					} 
			
				} 

			} 

		}else{

			echo "<script type='text/javascript'>hidePageLoader();</script>";	

		}  
exit;
?>