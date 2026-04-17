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
	This script handle application login validation
	------------------------------------------------------------------------*/

if(!session_id()){
	session_start();
}

		define('fobrain', 'igweze');  /* define a check for wrong access of file */ 
		
		setcookie('googtrans', '');
		
		require_once 'sources/functions/fobrain-dir-in.php';  /* include configuration script */		
		require_once $fobrainFunctionDir;  /* load script functions */ 
		
		$scroll_up = ""; 
		 
		if (($_REQUEST['logintype'] == 'student') && ($_REQUEST['profile'] == 'login') ){  /* student  login validation */
					
			$i_username = clean($_REQUEST['username']);
			$i_password = clean($_REQUEST['password']); 
			 
			$handleC = explode("/", $i_username);
			$handleCount = count($handleC); 

			clearLoginBan();
			
			if($handleCount == $thVal){
				
				list ($schAbbr, $username, $schoolType) =  explode ("/", $i_username);	
				
			}else{	
			
				list ($username, $schoolType) =  explode ("/", $i_username);	
				
			}	 

			$schoolSettings = schoolTypeConfig($schoolType, $fiVal);  /* school type configuration  */ 
			
			/* script validation */

			if ($_SESSION['islogBan'] == 1){

				$msg_e = "Ooops Error, you have attempted 5 failed login. Please, try again in 5 mins";
		
			}elseif (($_REQUEST['username'] == "") || ($_REQUEST['password'] == ""))   {
			 
				$msg_e = "* Ooops Error, please enter your Reg No and Password.!"; 
			 
			}elseif($fobrainDB == ""){
				
				$msg_e = "* Ooops Error, please enter valid Reg No e.g 20010000/NUR, 20010000/PRI, 20010000/SEC!"; 
				
			}elseif ((!file_exists($schoolSettings)) || ($schoolSettings == "")){

				$msg_e = $noConnCongfigMsg; 

			}else{  /* validate user */ 
			
				try { 

					require_once ($schoolSettings);  /* include configuration script */
					require ($fobrainDBConnectIndDir);   /* load connection string */ 	 
 
					$retrieve_data =  studentParentPassword($conn, $i_username, 0);
					list ($regID, $retrieve_pass) =  explode ("{<?.@.?>}", $retrieve_data);

					if (password_verify($i_password, $retrieve_pass)) { /* if sucessfully login user */	  
														
						$regNum = $i_username;	 
						$schoolSettings = schoolTypeConfig($schoolType, $seVal); /* school type configuration  */
  
						mt_srand((double)microtime() * 1000000);
						
						$njidekaBouncer = randomString($charset, 40);  /* generate auto random character */
						$nkirukaBouncer = randomString($charset, 40);  /* generate auto random character */
						
						$fiBouncerBabe = 'IFabuLOUSlyLoveNJideka'.$regID.'_'.$njidekaBouncer.'_Fabulous_Mum_In_the_GloBE';;					   
						$seBouncerBabe = 'IFabuLOUSlyLoveNKiruKa'.$regNum.'_'.$nkirukaBouncer.'_FabUloUS_Wife_In_the_WorlD';
															   
						$_SESSION['schoolConfigs'] = $schoolSettings;	 
						$_SESSION['isLoggedIn'] = true;  
						$_SESSION['regNo'] = $regNum;  		   
						$_SESSION['regID'] = $regID; 
						$_SESSION['fiBouncerRand'] = $njidekaBouncer;     
						$_SESSION['seBouncerRand'] = $nkirukaBouncer;
						$_SESSION['fiBouncer'] = $fiBouncerBabe;     
						$_SESSION['seBouncer'] = $seBouncerBabe; 
						$_SESSION['isParent'] = 0;
						$_SESSION['wall-general'] = 0;
							
						$schoolArray = fobrainSchool($conn);  /* school configuration setup array  */
						$translate = $schoolArray[0]['translator'];
						$screen_timer = $schoolArray[0]['screen_timer'];
						$translator = '/'.$translate;
						setcookie("googtrans", $translator, time() + 60*60*24*100);  
						
						$_SESSION['screen_timer'] = $screen_timer;  
						$_SESSION['screen_lock'] = 0000;
						
						$msg_s = "Your login was successfully. Please wait, page is redirecting >>>>";	
						
						$_SESSION['fobrainPilot'] =  $headerStudentPage;
						echo "<script type='text/javascript'>  $('.login-wrap').slideUp(); 
						window.location.href = '$headerStudentPage'; </script>";
				   
					} else {  /* display error */

						$msg_e = "*Error, incorrect student Reg no. and password combination.";
						autoLoginBan();
						
					}
				 

				}catch(PDOException $e) {
			
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			 
				} 
		 
			} 
		 
		}elseif (($_REQUEST['logintype'] == 'parent') && ($_REQUEST['profile'] == 'login') ){  /* parent login validation */
				
			$i_username = clean($_REQUEST['username']);
			$i_password = clean($_REQUEST['password']); 

			$handleC = explode("/", $i_username);
			$handleCount = count($handleC); 

			if($handleCount == $thVal){

				list ($schAbbr, $username, $schoolType) =  explode ("/", $i_username);	

			}else{	

				list ($username, $schoolType) =  explode ("/", $i_username);	

			}	 

			$schoolSettings = schoolTypeConfig($schoolType, $fiVal);  /* school type configuration  */ 
			
			/* script validation */

			clearLoginBan();

            if ($_SESSION['islogBan'] == 1){

				$msg_e = "Ooops Error, you have attempted 5 failed login. Please, try again in 5 mins";
		
			}elseif (($_REQUEST['username'] == "") || ($_REQUEST['password'] == ""))   {
			 
			 	$msg_e = "* Ooops Error, please enter your Reg No and Password.!"; 
			 
			}elseif($fobrainDB == ""){
				
				$msg_e = "* Ooops Error, please enter valid Reg No e.g 20010000/NUR, 20010000/PRI, 20010000/SEC  !"; 
				
			}elseif ((!file_exists($schoolSettings)) || ($schoolSettings == "")){

                $msg_e = $noConnCongfigMsg; 

            }else{  /* validate user */ 
			
				try { 

					require_once ($schoolSettings);  /* include configuration script */
					require ($fobrainDBConnectIndDir);   /* load connection string */ 	
					
					$retrieve_data =  studentParentPassword($conn, $i_username, 1);
					list ($regID, $retrieve_pass) =  explode ("{<?.@.?>}", $retrieve_data);

					if (password_verify($i_password, $retrieve_pass)) { /* if sucessfully login user */	  
														
						$regNum = $i_username; 

						$schoolSettings = schoolTypeConfig($schoolType, $seVal); /* school type configuration  */	 
						
						mt_srand((double)microtime() * 1000000);

						$njidekaBouncer = randomString($charset, 40);  /* generate auto random character */
						$nkirukaBouncer = randomString($charset, 40);  /* generate auto random character */
						
						$fiBouncerBabe = 'IAmzininGlyLoveNjiDeKa'.$regID.'_'.$njidekaBouncer.'_OutStanding_MuM_In_the_GloBE';
					   
						$seBouncerBabe = 'IAmzininGLoveNKiruKa'.$regNum.'_'.$nkirukaBouncer.'_OutStanding_Wife_In_the_WorlD'; 
															   
						$_SESSION['schoolConfigs'] = $schoolSettings;
						$_SESSION['isLoggedIn'] = true;        
						$_SESSION['regNo'] = $regNum;  		   
						$_SESSION['regID'] = $regID;  
						$_SESSION['regNoB'] = $regNum;  		   
						$_SESSION['regIDB'] = $regID;   
						$_SESSION['fiBouncerRand'] = $njidekaBouncer;     
						$_SESSION['seBouncerRand'] = $nkirukaBouncer;
						$_SESSION['fiBouncer'] = $fiBouncerBabe;     
						$_SESSION['seBouncer'] = $seBouncerBabe;
						$_SESSION['isParent'] = 1;
						$_SESSION['wall-general'] = 0;
						
						$schoolArray = fobrainSchool($conn);  /* school configuration setup array  */
						$translate = $schoolArray[0]['translator'];
						$screen_timer = $schoolArray[0]['screen_timer'];
						$translator = '/'.$translate;
						setcookie("googtrans", $translator, time() + 60*60*24*100);  
				 
						$_SESSION['screen_timer'] = $screen_timer;  
						$_SESSION['screen_lock'] = 0000;
						
						$msg_s = "*Login Successfully, Please Wait. Page Redirecting . . . . . ";
						
						$_SESSION['fobrainPilot'] =  $headerParentPage;
						echo "<script type='text/javascript'>  $('.login-wrap').slideUp(); 
						window.location.href = '$headerParentPage'; </script>";
				   
					} else {  /* display error */ 

						$msg_e = "* Ooops Error, incorrect student reg no. and parent password combination.";
						autoLoginBan();
						
					}
			 

			 	} catch(PDOException $e) {
  			
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			 
			 	} 
		 
			} 
		 
		}elseif (($_REQUEST['logintype'] == 'admin-login-old') && ($_REQUEST['profile'] == 'login') ){  /* admin login validation */ 
		
			$nk_name = clean($_REQUEST['username']);
			$nk_pass = clean($_REQUEST['password']); 

			try { 

				require ($fobrainDBConnectIndDir);   /* load connection string */ 		

				$checkDetail =  adminLoginData($conn, $nk_name);  /* school admin password details */			 
				list ($adminID, $checkedPass, $adminName) =  explode ("@(.$*S*$.)@", $checkDetail);					

			}catch(PDOException $e) {

				fobrainDie( 'Ooops Database Error: ' . $e->getMessage());

			}

			/* script validation */ 

			clearLoginBan();
			
			if ($_SESSION['islogBan'] == 1){

				$msg_e = "Ooops Error, you have attempted 5 failed login. Please, try again in 5 mins";
		
			}elseif ($nk_name == '')   {

				$msg_e = "* Ooops Error, please enter admin name ";

			}elseif ($nk_pass == '')   {

				$msg_e = "* Ooops Error, please enter your password";

			}elseif($checkedPass != $nk_pass){

				$msg_e = "* Ooops Error, invalid username and password combination. Thanks";
				autoLoginBan();

			} else {  /* login this user */ 

				$admin_grade = $admin_fobrain_grd; $admin_level = $admin_tagged; 

				mt_srand((double)microtime() * 1000000);
							
				$njidekaBouncer = randomString($charset, 44);
				$nkirukaBouncer = randomString($charset, 44);

				$fiBouncerBabe = 'IFabuLOUSlyLoveNJidekaNCHukWUM'.$admin_level.'_'.$njidekaBouncer.'_Fabulous_Dad_In_the_GloBE';
				$seBouncerBabe =  'IFabuLOUSlyLoveNKiruKaNCHukWUM'.$admin_grade.'_'.$nkirukaBouncer.'_FabUloUS_Wife_In_the_WorlD';

				$_SESSION['adminID'] = $adminID;
				$_SESSION['adminUser'] = $nk_name;
				$_SESSION['adminLname'] = $adminName;
				$_SESSION['accessGrade'] = $admin_grade;
				$_SESSION['accessLevel'] = $admin_level;
				$_SESSION['random_bouncer'] = $se_random_bouncer;
				$_SESSION['ADmiNfiBouncerRand'] = $njidekaBouncer;     
				$_SESSION['ADmiNseBouncerRand'] = $nkirukaBouncer;
				$_SESSION['ADmiNfiBouncer'] = $fiBouncerBabe;     
				$_SESSION['ADmiNseBouncer'] = $seBouncerBabe;	
				$_SESSION['regNo'] = $adminID;
				$_SESSION['wallComRank'] = '2'; 

				$schoolArray = fobrainSchool($conn);  /* school configuration setup array  */
				$translate = $schoolArray[0]['translator'];
				$screen_timer = $schoolArray[0]['screen_timer'];
				$translator = '/'.$translate;
				setcookie("googtrans", $translator, time() + 60*60*24*100);  
		 
				$_SESSION['screen_timer'] = $screen_timer;  
				$_SESSION['screen_lock'] = 0000;
				$msg_s = "*Login Successfully, Please Wait. Page Redirecting . . . . . ";
				echo $succesMsg.$msg_s.$sEnd; echo $scroll_up; 

				$_SESSION['fobrainPilot'] =  $headerComPage;
				echo "<script type='text/javascript'> 
				$('.login-wrap').slideUp(); window.location.href = '$headerComPage'; </script>"; exit;
				///header( 'Location:' .$headerAdminPage); 

			} 
			 	
		}/*elseif (($_REQUEST['logintype'] == 'staff') && ($_REQUEST['profile'] == 'login') ){  /* staff login validation */ 
			
			elseif (($_REQUEST['logintype'] == 'staff') || ($_REQUEST['logintype'] == 'bursary') 
						
				|| ($_REQUEST['logintype'] == 'librainain') || ($_REQUEST['logintype'] == 'principal') 
						
				|| ($_REQUEST['logintype'] == 'classmg') || ($_REQUEST['logintype'] == 'admin')
				
				&& ($_REQUEST['profile'] == 'login') ){  /* staffs login validation */		 
  
			$nk_name = clean($_REQUEST['username']);
			$nk_pass = clean($_REQUEST['password']);  

			try { 

				require ($fobrainDBConnectIndDir);   /* load connection string */ 				

				$checkDetail =  staffLoginData($conn, $nk_name);  /* school staffs/teachers password details */ 			 
				list ($tID, $staffUser, $checkedPass, $staffName, $staff_fobrain_grdQ, $userGrade, $userAccess) = 
				explode ("@(.$*S*$.)@", $checkDetail);
				 
				/*
				$pass_correct = 0;
				if($nk_pass != ""){

					$userAccess = trim($userAccess);

					if (password_verify($nk_pass, $userAccess)) {	

						$pass_correct = 1;
		
					}else{ $pass_correct = 0; }

				}
				*/

			}catch(PDOException $e) {

				fobrainDie( 'Ooops Database Error: ' . $e->getMessage());

			}
			
			/* script validation */ 

			clearLoginBan();
			
			if ($_SESSION['islogBan'] == 1){

				$msg_e = "Ooops Error, you have attempted 5 failed login. Please, try again in 5 mins";
		
			}elseif ($nk_name == '')   {

				$msg_e = "* Ooops Error, please enter valid staff name";

			}elseif ($nk_pass == '')   {

				$msg_e = "* Ooops Error, please enter your password";

			}elseif(!password_verify($nk_pass, $userAccess)){ 			 

				$msg_e = "* Ooops Error, invalid username and password combination.";
				autoLoginBan();

			}elseif($userGrade == $i_false){

				$msg_e = "* Ooops Error, you dont have any staff login priviledge assign to you.";
				autoLoginBan();

			}else {  /* login this user */ 

				if ($userGrade == $cm_fob_tagged){  /* check if school class manager*/

					$admin_grade = $cm_fobrain_grd; $admin_level = $cm_fob_tagged;
					$_SESSION['wall-general'] = 0;

				}elseif ($userGrade == $hm_fob_tagged){  /* check if school head */

					$admin_grade = $hm_fobrain_grd; $admin_level = $hm_fob_tagged;
					$_SESSION['wall-general'] = 0;

				}elseif ($userGrade == $lib_fob_tagged){  /* check if school librainain */

					$admin_grade = $lib_fobrain_grd; $admin_level = $lib_fob_tagged;
					$_SESSION['wall-general'] = 0;

				}elseif ($userGrade == $bus_fob_tagged){  /* check if school bursary */

					$admin_grade = $bus_fobrain_grd; $admin_level = $bus_fob_tagged;
					$_SESSION['wall-general'] = 0;

				}elseif ($userGrade == $admin_tagged){  /* check if school admin */

					$admin_grade = $admin_fobrain_grd; $admin_level = $admin_tagged;  
					$_SESSION['wall-general'] = 1;

				}elseif ($userGrade == $staff_fob_tagged){  /* check if school staff */

					$admin_grade = $staff_fobrain_grd; $admin_level = $staff_fob_tagged; 
					$_SESSION['wall-general'] = 0;

				}else{  /* display error */

					autoLoginBan();
					$msg_e = "* Ooops Error, you dont have any staff login priviledge assign to you.";
					echo "<script type='text/javascript'> $('.fob-btn-loader').fadeOut(2000);  $('.fob-btn-div').fadeIn(4000); </script>";
					echo $errorMsg.$msg_e.$eEnd; echo $scroll_up; exit; 	

					exit;

				} 
				
				mt_srand((double)microtime() * 1000000);

				$njidekaBouncer = randomString($charset, 44); /* generate auto random character */
				$nkirukaBouncer = randomString($charset, 44); /* generate auto random character */

				$fiBouncerBabe =  'IFabuLOUSlyLoveNJidekaNCHukWUM'.$admin_level.'_'.$njidekaBouncer.'_Fabulous_Dad_In_the_GloBE';               
				$seBouncerBabe =  'IFabuLOUSlyLoveNKiruKaNCHukWUM'.$admin_grade.'_'.$nkirukaBouncer.'_FabUloUS_Wife_In_the_WorlD';

				$_SESSION['adminID'] = $tID;
				$_SESSION['adminUser'] = $nk_name;
				$_SESSION['adminLname'] = $staffName;
				$_SESSION['accessGrade'] = $admin_grade;
				$_SESSION['accessLevel'] = $admin_level;  
				$_SESSION['random_bouncer'] = $se_random_bouncer;
				$_SESSION['ADmiNfiBouncerRand'] = $njidekaBouncer;     
				$_SESSION['ADmiNseBouncerRand'] = $nkirukaBouncer;
				$_SESSION['ADmiNfiBouncer'] = $fiBouncerBabe;     
				$_SESSION['ADmiNseBouncer'] = $seBouncerBabe;	
				$_SESSION['fobrainRunMode'] = $seVal;
				$_SESSION['regNo'] = $tID; 
				$_SESSION['wallComRank'] = '2';  

				$schoolArray = fobrainSchool($conn);  /* school configuration setup array  */
				$translate = $schoolArray[0]['translator'];
				$screen_timer = $schoolArray[0]['screen_timer'];
				$translator = '/'.$translate;
				setcookie("googtrans", $translator, time() + 60*60*24*100);  
						
				$_SESSION['screen_timer'] = $screen_timer;  
				$_SESSION['screen_lock'] = 0000;

				$msg_s = "*Login was successfully, please wait. Page Redirecting . . . . . ";

				if ($userGrade == $lib_fob_tagged){  /* check if school librainain */

					$_SESSION['fobrainPilot'] =  $headerLibrarianPage;
					echo "<script type='text/javascript'>  $('.login-wrap').slideUp(); window.location.href = '$headerLibrarianPage'; </script>"; 

				}elseif ($userGrade == $bus_fob_tagged){  /* check if school bursary */

					$_SESSION['fobrainPilot'] =  $headerBursaryPage;
					echo "<script type='text/javascript'>  $('.login-wrap').slideUp(); window.location.href = '$headerBursaryPage'; </script>"; 

				}else{  /* else school head/staff */

					$_SESSION['fobrainPilot'] =  $headerComPage;
					$_SESSION['commonPgrade'] = $comGrade;
					$_SESSION['commonPlevel'] = $comGradeInt;
					echo "<script type='text/javascript'>  $('.login-wrap').slideUp(); window.location.href = '$headerComPage'; </script>"; 

				} 

			} 
			 	
		}else{  /* display error */ 
							
			$msg_e = "* Ooops Error, please select your login type. Thanks";
			echo "<script type='text/javascript'> $('.fob-btn-loader').fadeOut(2000);  $('.fob-btn-div').fadeIn(4000); </script>";
			echo $errorMsg.$msg_e.$eEnd; echo $scroll_up; exit; 	 
			unset($_SESSION['fobrainPilot']); 
				
		}
					
		if ($msg_s) {

			echo $succesMsg.$msg_s.$sEnd; echo $scroll_up; exit; 				
							
		}	

		if ($msg_e) {
			
			echo "<script type='text/javascript'> $('.fob-btn-loader').fadeOut(2000);  $('.fob-btn-div').fadeIn(4000); </script>";
			echo $errorMsg.$msg_e.$eEnd; echo $scroll_up; exit; 			
								
		}	
				
exit;
?>