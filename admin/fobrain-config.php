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
		
		$_SESSION['activeTimer'] = time(); 				
		$schoolExt = $_SESSION['school-type'];
		$adminID = $_SESSION['adminID'];
		$adminUser = $_SESSION['adminUser'];
		$admin_grade = $_SESSION['accessGrade'];
		$admin_level	 =	$_SESSION['accessLevel'];
		$admin_cw_rank = $_SESSION['wallComRank'];
		$njidekaBouncer = $_SESSION['ADmiNfiBouncer'];     
		$nkirukaBouncer = $_SESSION['ADmiNseBouncer'];
		$njidekaBouncerRand = $_SESSION['ADmiNfiBouncerRand'];     
		$nkirukaBouncerRand = $_SESSION['ADmiNseBouncerRand'];
		$regNum = $_SESSION['regNo'];

		if($_SESSION['fobrainRunMode'] != ""){
			$fobrainMode = $_SESSION['fobrainRunMode'] ;
		}else{
			$fobrainMode = $seVal; $_SESSION['fobrainRunMode'] = $seVal;
		}	
		/* script sessions end */
		
		$checkfiBouncerBabe = 'IFabuLOUSlyLoveNJidekaNCHukWUM'.
		$admin_level.'_'.$njidekaBouncerRand.'_Fabulous_Dad_In_the_GloBE';
		$checkseBouncerBabe = 'IFabuLOUSlyLoveNKiruKaNCHukWUM'.
		$admin_grade.'_'.$nkirukaBouncerRand.'_FabUloUS_Wife_In_the_WorlD';
			

		if ( (!isset($_SESSION['ADmiNfiBouncer']))
		|| ($_SESSION['ADmiNfiBouncer'] != $checkfiBouncerBabe)
		|| (!isset($_SESSION['ADmiNseBouncer']))
		|| ($_SESSION['ADmiNseBouncer'] != $checkseBouncerBabe)

		) {	 /* user validation */

			header("Location: $fobrainLogOutDir");
			echo "<script type='text/javascript'> window.location.href = '$fobrainLogOutDir';</script>"; exit; 

		}


		$admin_status = $admin_grade;
		global $admin_grade; global $admin_level; global $picPath; global $adminID; global $adminFullName; 
		global $adminPic; 
		global $admin_cw_rank; global $regNum;
		global $schoolExt;	

		//if($fobrainMode == ""){$fobrainMode = $seVal; $_SESSION['fobrainRunMode'] = $seVal;} 

		require $fobrainDBConnectDir;
		require_once ($fobrainFunctionDir);
		if (isset($_SESSION['schoolConfigs'])){  require_once ($_SESSION['schoolConfigs']); }

			
		$schoolTypeSD = schoolType($schoolExt);  /* return school type */
		global $schoolTypeSD; 

		try {

			$schoolDataArray = fobrainSchool($conn);  /* school configuration setup array  */
			$currentRSess = currentSessionInfo($conn);  /* current school session information  */

			list ($curRSessID, $rSessFI) = explode ("@$@", $currentRSess); 
			$rSessSE = ($rSessFI + $fiVal); 
			$currentSessTop = "$rSessFI - $rSessSE";

			$schoolNameTop = $schoolDataArray[0]['school_name'];
			$schoolAddressTop = $schoolDataArray[0]['school_address'];
			$schoolRegPrefix = $schoolDataArray[0]['reg_prefix'];
			$school_logo = $schoolDataArray[0]['school_logo'];
			$schoolTheme = $schoolDataArray[0]['school_theme'];
			$schoolHead = $schoolDataArray[0]['school_head'];
			$schoolCutoff = $schoolDataArray[0]['school_cutoff'];
			$subjectCutoff = $schoolDataArray[0]['school_sub_cutoff'];
			$globalTzone = $schoolDataArray[0]['tzone'];

			if($globalTzone == ""){

				date_default_timezone_set('Africa/Lagos');  /* your time zone */

			}else{

				date_default_timezone_set("$globalTzone");  /* your time zone */

			}

			global $schoolCutoff;

			$schoolThemeC = $schoolTheme;

			$fobrainTheme = fobrainThemeColor($schoolTheme, $fobrainTemplate); /* fobrain theme  */

			list ($cssTheme, $cssThemeReset) = explode ('@$$@', $fobrainTheme);

			list ($nurseryHead, $primaryHead, $secondaryHead) = explode (",", $schoolHead);	

			if($schoolID == $fiVal) { $schoolHead = $nurseryHead; }
			elseif($schoolID == $seVal) { $schoolHead = $primaryHead; }
			elseif($schoolID == $thVal) { $schoolHead = $secondaryHead; }
			else { $schoolHead = ""; } 

			$sch_logo = picture($sch_logo_path, $school_logo, "logo");
			
			$fobrainSchTitle ="<h2 class='text-primary'>  $schoolNameTop </h2> 
						<h5 class='text-danger'><i class='bx bxs-map-pin fs-20 label-icon'></i> $schoolAddressTop</h5>";
			$roll_render = 1;

		}catch(PDOException $e) {

		fobrainDie( 'Ooops Database Error: ' . $e->getMessage());

		}

?>