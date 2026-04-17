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
	This script load application configurations
	------------------------------------------------------------------------*/
				
		require_once '../sources/functions/fobrain-dir.php';  /* include configuration script */ 

		if ( (empty($_SESSION['schoolConfigs']))
		) {	 /* user validation */  

			//header("Location: $fobrainPortalRoot");
			echo "<script type='text/javascript'> window.location.href = '$fobrainPortalRoot'; </script>"; exit;  

		}

		/* script sessions start */
		
		$_SESSION['lastActive'] = time(); 
		$regNum = $_SESSION['regNo']; 			   
		$regID = $_SESSION['regID']; 
		$regNumB = $_SESSION['regNoB']; 			   
		$regIDB = $_SESSION['regIDB'];   
		$njidekaBouncer = $_SESSION['fiBouncer']; 
		$nkirukaBouncer = $_SESSION['seBouncer'];
		$njidekaBouncerRand = $_SESSION['fiBouncerRand'];
		$nkirukaBouncerRand = $_SESSION['seBouncerRand'];	
		$is_parent = $_SESSION['isParent'];
		$_SESSION['accessGrade'] = "";  
		
		/* script sessions end */ 

		$checkfiBouncerBabe = 'IAmzininGlyLoveNjiDeKa'.$regIDB.'_'.$njidekaBouncerRand.'_OutStanding_MuM_In_the_GloBE';
		$checkseBouncerBabe = 'IAmzininGLoveNKiruKa'.$regNumB.'_'.$nkirukaBouncerRand.'_OutStanding_Wife_In_the_WorlD';

		if ( (!isset($_SESSION['fiBouncer']))
		|| ($_SESSION['fiBouncer'] != $checkfiBouncerBabe)
		|| (!isset($_SESSION['seBouncer']))
		|| ($_SESSION['seBouncer'] != $checkseBouncerBabe)

		) {	 /* user validation */   

			//header("Location: $fobrainLogOutDir");exit;
			echo "<script type='text/javascript'> window.location.href = '$fobrainLogOutDir';</script>"; exit; 

		}
		
		require $fobrainDBConnectDir;  /* load connection string */
		require_once $fobrainFunctionDir;  /* load script functions */
		
		if (isset($_SESSION['schoolConfigs'])){	 /* user validation */   
			
			require_once ($_SESSION['schoolConfigs']); 
				
		}else { 
		
			//header("Location: $fobrainPortalRoot");
			echo "<script type='text/javascript'> window.location.href = '$fobrainPortalRoot'; </script>"; exit;  
				
		}

		try {


			$ebele_mark = "SELECT r.ireg_id, nk_regno, session_id, 
							s.stu_id, i_stupic, i_firstname, i_lastname, i_midname, i_gender, i_dob, i_country, i_stu_phone, 
							i_email, sibling

							FROM $i_reg_tb r,  $i_student_tb s

							WHERE r.nk_regno = :nk_regno
					
							AND r.ireg_id = s.ireg_id";
					
			$igweze_prep = $conn->prepare($ebele_mark);		
			$igweze_prep->bindValue(':nk_regno', $regNum);
			$igweze_prep->execute();
			
			$rows_count = $igweze_prep->rowCount(); 

			if($rows_count == $foreal) {  /* check array is empty */
			
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {  /* loop array */		

					$regNum = $row['nk_regno'];
					$regID = $row['ireg_id'];
					$sessionID = $row['session_id'];
					$pic = $row['i_stupic'];
					$fname_gl = $row['i_firstname'];
					$lname_gl = $row['i_lastname'];
					$mname_gl = substr($row['i_midname'], 0, 1);
					$gender = $row['i_gender'];
					$date = $row['i_dob']; 
					$countryS = $row['i_country']; 
					$phone = $row['i_stu_phone'];
					$email = $row['i_email']; 
					$sibling = unserialize($row['sibling']);
					
				}	 
				
				$session_fi = fobrainSession($conn, $sessionID);  /* school session */									
				$session_se = $session_fi + $foreal;  

				$student_img = picture($school_pic_dir.$session_fi.'_'.$session_se.'/', $pic, "student");  
				$student_name = "$lname_gl $fname_gl $mname_gl";

				if($student_name == ''){$student_name = $regNum;} 

			}else{

				$msg_e =  "Ooops, student record was not found.";
				echo $errorMsg.$msg_e.$eEnd;  exit;

			}	

			
			$schoolDataArray = fobrainSchool($conn);  /* school configuration setup array  */
			$currentRSess = currentSessionInfo($conn);  /* current school session information  */

			list ($curRSessID, $rSessFI) = explode ("@$@", $currentRSess); 
			$rSessSE = ($rSessFI + $fiVal); 
			$currentSessTop = "$rSessFI - $rSessSE";
			
			$schoolNameTop = $schoolDataArray[0]['school_name'];
			$schoolAddressTop = $schoolDataArray[0]['school_address'];
			$school_logo = $schoolDataArray[0]['school_logo'];
			$schoolTheme = $schoolDataArray[0]['school_theme'];
			$schoolHead = $schoolDataArray[0]['school_head'];
			$schoolCutoff = $schoolDataArray[0]['school_cutoff'];
			$subjectCutoff = $schoolDataArray[0]['school_sub_cutoff'];
			$ewalletCheck = $schoolDataArray[0]['ewallet'];
			$globalTzone = $schoolDataArray[0]['tzone'];

			if($globalTzone == ""){

				date_default_timezone_set('Africa/Lagos');  /* your time zone */

			}else{

				date_default_timezone_set("$globalTzone");  /* your time zone */

			}

			$schoolThemeC = $schoolTheme;

			$fobrainTheme = fobrainThemeColor($schoolTheme, $fobrainTemplate); /* fobrain theme  */

			list ($cssTheme, $cssThemeReset) = explode ('@$$@', $fobrainTheme);

			list ($nurseryHead, $primaryHead, $secondaryHead) = explode (",", $schoolHead);	

			if($schoolID == $fiVal) { $schoolHead = $nurseryHead; }
			elseif($schoolID == $seVal) { $schoolHead = $primaryHead; }
			elseif($schoolID == $thVal) { $schoolHead = $secondaryHead; }
			else { $schoolHead = ""; }

			$burConfigsArray = bursaryConfigsArrays($conn);  /* school bursary configuration  */

			$countryCurrCode = $burConfigsArray[0]['currency'];
			$sale_account = $burConfigsArray[0]['account'];
			$bankDetails = htmlspecialchars_decode($burConfigsArray[0]['bank']);
			$bankDetails = nl2br($bankDetails);

			$curVal = $currencySymbols[$countryCurrCode];
					
			list($countryCur, $symbol) = explode("-", $curVal);
			$curSymbol = trim($symbol); 

			global $curSymbol, $sale_account;

			$sch_logo = picture($sch_logo_path, $school_logo, "logo");

			$fobrainSchTitle ="<h2 class='text-primary'>  $schoolNameTop </h2> 
							<h5 class='text-danger'><i class='bx bxs-map-pin fs-20 label-icon'></i> $schoolAddressTop</h5>";

			
			$gatewayPaymentDataArr = gatewayPaymentData($conn);  /* payment gateways array  */

			$paypalID = trim($gatewayPaymentDataArr[$fiVal]["gateKey"]); 
			$twoCheckoutAccKey = trim($gatewayPaymentDataArr[$seVal]["gateKey"]); 
			$payStackPublicKey = trim($gatewayPaymentDataArr[$thVal]["gateKey"]); 
			
			$examArray = schoolExamConfigArrays($conn);  /* school exam configuration array  */
			$exam_status = $examArray[0]['status'];	
			$rsType = $examArray[0]['rsType'];

			$admin_grade = 0; $admin_level = 0;

		}catch(PDOException $e) {

			fobrainDie( 'Ooops Database Error: ' . $e->getMessage());

		} 

		global $regNum, $regID, $i_db_ext, $fobrainDBConnectDir, $student_name, $student_img; // $pic_path,  $picPath;		

?>