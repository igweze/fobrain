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
	This main script define school variables, database tables, directory 
	links, and predefined arrays
	------------------------------------------------------------------------*/
 
	error_reporting(0); 		
	require 'fobrain-config.php';	
	require 'fobrain-loader.php';  

	if($production_var != 0101010404040401){

		$FoBrain = 'foBrain AI '.$fobrain_version;
		$fobrain_link = 'https://www.fobrain.com'; 
		$fobrain_target = 'target="_blank"';

		$fobrain_footer = '<a href="'.$fobrain_link.'" '.$fobrain_target.' class=" fs-12">&copy<script>document.write(new Date().getFullYear())</script> 
		 <b><span class="logo-mark col-i-1">'.$FoBrain.'</span></b>
		 <span class="logo-mark col-i-2 d-none">'.$FoBrain.'</span></a>';

		$fobrain_footer_in = '<p class="mb-0 text-dark fs-12"> 
		<a href="'.$fobrain_link.'" '.$fobrain_target.'>&copy<script>document.write(new Date().getFullYear())</script> 
		<b><span class="logo col-i-1">'.$FoBrain.'</span></b>
		<span class="logo col-i-2 d-none">'.$FoBrain.'</span></a></p>';

	}
	
	$fobrainSQLData = 'fobrain.sql';  /* SQL Installation files */
	
	$fobrainSQLPointer = $fobrainSQLData.'_filepointer';  /* SQL Installation files pointer */   
	
	/* school type settings */
	
	$fobrainNurAbr = 'nur';
	$fobrainPriAbr = 'pri';
	$fobrainSecAbr = 'sec';
	
	$fobrainNurPref = 'nur_';
	$fobrainPriPref = 'pri_';
	$fobrainSecPref = 'sec_';  
				
	$rseditingStage = 1;  /* result editing stage status */
	$rscomputedStage = 2;  /* result computed stage status */
	$rspublishStage = 3;  /* result published stage status */				

	$femaleG = 1; $maleG = 2;

	/* grade level integer */		 
	
	$admin_tagged = 1;  $hm_fob_tagged = 2; $bus_fob_tagged = 3;
	$lib_fob_tagged = 4; $cm_fob_tagged = 5; $staff_fob_tagged = 6; 
	$staff_fob_taggedGL = 1; $comGradeInt = 1992; 
	
	/* grade level name */
	
	$admin_fobrain_grd = 'admin'; $cm_fobrain_grd = 'classmg'; $hm_fobrain_grd = 'schoolhead'; 
	$lib_fobrain_grd = 'libraian'; $bus_fobrain_grd = 'bursary'; $staff_fobrain_grd = 'staff'; $comGrade = 'global';  

	$show_tasks_div = false;  /* set show panel div to false */

	$i_r_cr_ar = 0; /* index raw course array position */
	$i_cc_ar = 1;   /* index course code array position */
	$i_tit_ar = 2;  /* index course title array position */
	$i_cu_ar = 3;   /* index credit units array position */
	$i_cc_in = 4;   /* index credit units array position */

	/* looping array starter */
	
	$inti_reg_no_arr = 0;
	$inti_result_loop_arr = 0;
	$inti_cr_course_arr_start = 1;
	$i_start_rs_loop = 1;

	/* semester code */
	
	$first_semester_code = 1; $second_semester_code = 2; 

	/* predefined integer start */
	
	$foreal = 1; $i_false = 0; $serial_no = 0;

	$fi_level = 1; $se_level = 2; $th_level = 3; $fo_level = 4; $fif_level = 5; $six_level = 6; $sev_level = 7;
	$eig_level = 8; $nine_level = 9; $ten_level = 10; $extra_year = "extra"; $all_year = "all";

	$fi_term = 1; $se_term = 2; $th_term = 3;

	$fiVal = 1; $seVal = 2; $thVal = 3; $foVal = 4; $fifVal = 5; $sixVal = 6; $sevVal = 7; $eightVal = 8; 
	$nineVal = 9; $tenVal = 10;  

	$start_level = 1;
	
	$courseDuration = 6;

	$mailoffSetVal = 2;

	$cWallNumPerPage = 10;
	
	$load_more_limit = 4;

	$error_add_val_1 = 9361;
	
	$error_add_val_2 = 16841;	

	$msg_e = $msg_s = $msg_i = $empty_str = "";

	$transact_pay = 1;
	$transact_sales = 2;
	$transact_expense = 3;
	$transact_payroll = 4;
	$transact_m_payroll = 5;
	$transact_journal_entry = 6;
	$transact_journal_entry_m = 7; 
	
	/* predefined integer end */ 
	
	$queryUserBio = 'i_firstname, i_midname, i_lastname, i_dob, i_stupic';  /* student profile query string */  
	
	/* random character generator */
	
	$charset = "aAbBcCdDeEfFgGhHiIjJkKlLmMnNoOpPqQrRsStTuUvVwWxXyYzZ123456789";
	$charsetSe = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789./';
	
	$randChars = "aAbBcCdDeEfFgGhHiIjJkKlLmMnNoOpPqQrRsStTuUvVwWxXyYzZ0123456789"; 
	$randCharBig = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$randNumber = '0123456789';
	$encrypt_key = "1987fobrain@amanda@2021NAETO2019$";

	$gradeNkiruka = "100 - 70 (A), 69 - 60 (B), 59 - 50 (C), 49 - 45 (D), 44 - 40 (E), 39 - 0 (F)"; /* student grader */
	
	$oneMB = 1048576;  /* one mb size value */ 
	
	$allowedPicExt = "jpeg, jpg and png";	/* allow defined files */
	$allowedDocExt = "doc, docx, pdf, xls, xlsx and txt";	/* allow defined files */
	$allowedExcelExt = "xls, xlsx";	/* allow defined files */
	
	/* script directory start */ 

	$headerStudentPage = $fobrainPortalRoot.'student';
	
	$headerParentPage = $fobrainPortalRoot.'parent';
	
	$headerAdminIndex = $fobrainPortalRoot.'admin/';    
	
	$headerAdminPage = $fobrainPortalRoot.'admin/super';
	
	$headerComPage = $fobrainPortalRoot.'admin/';
	
	$headerClassManagerPage = $fobrainPortalRoot.'admin/class-mg';

	$headerStaffPage = $fobrainPortalRoot.'admin/staff';
	
	$headerSchHeadPage = $fobrainPortalRoot.'admin/hm';
	
	$headerLibrarianPage = $fobrainPortalRoot.'libraian';	
	
	$headerBursaryPage = $fobrainPortalRoot.'bursary';
	
	$headerInstallScript = $fobrainPortalRoot.'install/';

	$header_install_script = $fobrainPortalRoot.'101';

	$header_no_connection = $fobrainPortalRoot.'002';

	$fobrainLogOutDir = $fobrainPortalRoot;
	
	$fobrain404Dir = $fobrainPortalRoot.'404';
	
	$fobrainDBConnectIndDir = './fobrain-connect.php';
	
	$fobrainDBConnectDir = '../fobrain-connect.php';	 
	
	$wizTemplateI = './wiz-design/';  
	$wizTemplate = '../wiz-design/';  
	
	$fobrainTemplateIN = $wizTemplateI.'assets/';
	$fobrainTemplate = $wizTemplate.'assets/';	
	
	$wiz_config_global = 'wiz-configs/wiz-global-configs.php';

	$fobrainNurConfig = 'wiz-configs/wiz-nur-configs.php'; 
	
	$fobrainPRIConfig = 'wiz-configs/wiz-pri-configs.php';
	
	$fobrainSECConfig = 'wiz-configs/wiz-sec-configs.php';
	
	$fobrainComTBConfig = 'wiz-configs/common-db-configs.php';		 

	$fobrainStudentDir = $fobrainDir.'sources/student/';
	
	$fobrainAdminDir = $fobrainDir.'sources/admin/admin/'; 
	
	$fobrainLibraryDir = $fobrainDir.'sources/admin/librarian/';
	
	$bursaryDir = $fobrainDir.'sources/admin/bursary/';
	
	$fobrainFormTeacherDir = $fobrainDir.'sources/admin/form-teacher/';
		
	$fobrainGlobalDir = $fobrainDir.'sources/global';
	
	$fobrainLevelDir = $fobrainDir.'sources/global/class/';
	
	$fobrainGlobalScriptsDir = $fobrainDir.'sources/global/scripts/';
	
	$wizg_bio_dir = $fobrainDir.'sources/global/bio/';
	
	$companionScriptJS = $fobrainGlobalScriptsDir.'common-js-scripts.php';

	$common_staff_script = $fobrainGlobalScriptsDir.'common-staff-script.php';

	$fob_live_script = $fobrainGlobalScriptsDir.'live.php';
	
	$fobrainvalidater = $fobrainGlobalScriptsDir.'validate-pages.php';
	
	$shoppingDir = $fobrainDir.'sources/global/shopping/'; 
	
	$fobrainGlobalRSDir = $fobrainDir.'sources/global/result/';
	
	$fobrainAdminGlobalDir = $fobrainDir.'sources/admin/global/';
	
	$fobrainFunctionDir = $fobrainDir.'sources/functions/functions.php';

	$fobrainGlobalVars = $fobrainDir.'sources/functions/global.php';
	
	$fobrainClassRSManagerDir = $fobrainDir.'sources/admin/global/class-session-rs.php';
	
	$fobrainAllClass = $fobrainDir.'sources/admin/global/class-annual-rs.php';
	
	$fobrainCalRSDir = $fobrainAdminGlobalDir.'fobrain-wiz-comp.php';
	
	$fobrainIconPage = $fobrainGlobalDir.'/page-icon.php'; 
	
	$fobrainPayG = $fobrainGlobalDir.'/pay-gateway.php';

	$lock_screen_temp = $fobrainGlobalDir.'/lock-screen.php';
	
	$fobrainFDashBoard = $fobrainGlobalDir.'/commonFDashBoard.php';  
	
	$fobrainSchoolTBS = $fobrainGlobalDir.'/wiz-common-global.php';
	
	$fobrainClassConfigDir = $fobrainGlobalDir.'/class-configs.php';	
	
	$fobrainExportRSDir = $fobrainGlobalRSDir.'fobrain-export-rs.php';
	
	$exportScanRSDir = $fobrainGlobalRSDir.'fobrain-scan-rs.php';
	
	$fobrainStudentComRSDir = $fobrainGlobalRSDir.'wiz-comment.php';
	
	$fobrainStudentSubRSDir = $fobrainGlobalRSDir.'wiz-computation.php'; //studentRS-ratio.php
	
	$fobrainClassBestRSDir = $fobrainGlobalRSDir.'wiz-class-best.php'; 
	
	$fobrainSessionRSDir = $fobrainGlobalRSDir.'wiz-comp-session.php'; 			
	
	$fobrainCWallDir = $fobrainDir.'sources/global/wall-companion/';
	
	$fobrainFunctionDir = $fobrainDir.'sources/functions/functions.php';
	
	$fobrainCWallFunctionDir = $fobrainGlobalDir.'/wall-companion/functions.php';
	
	$fobrainPicDir = $fobrainDir.'wiz-gallery/'; 
	
	$forumPicExt = $fobrainPicDir.'comp-wall/';
	
	$staff_pic_ext = $fobrainPicDir.'staffs/';
	
	$staff_doc_ext = $fobrainPicDir.'staffs/docs/';
	
	$forumPicExtTem = $fobrainPicDir.'comp-wall-temp/';

	$expense_doc_ext = $fobrainPicDir.'expenses/'; 
	
	$admin_pic_ext = $fobrainPicDir.'admin/';
	
	$applyPSrc = $fobrainPicDir.'application/';
	
	$wiz_default_img = $fobrainTemplate.'images/default/avatar.png';

	$wiz_default_img_i = $fobrainTemplateIN.'images/default/avatar.png';

	$wiz_df_staff_img = $fobrainTemplate.'images/default/staff.png'; 

	$wiz_df_sign_img = $fobrainTemplate.'images/default/sign.png'; 

	$wiz_df_cart_img = $fobrainTemplate.'images/default/cart.png';
	
	$wiz_df_word_img = $fobrainTemplate.'images/default/word.png';

	$wiz_df_file_img = $fobrainTemplate.'images/default/files.png';

	$wiz_df_pdf_img = $fobrainTemplate.'images/default/pdf.png';

	$wiz_df_xls_img = $fobrainTemplate.'images/default/xls.png';

	$wiz_df_exam_img = $fobrainTemplate.'images/default/exam.png';  
	
	$defualt_pic_forum = $wiz_default_img; 

	$wall_s_loader = $fobrainTemplate.'images/sm-loader.gif'; 
	
	$sch_logo_path = $fobrainPicDir.'school/';	
	
	$rsUploadsPath = $fobrainPicDir.'rs-uploads/';

	$fobrainCourseDir =  $fobrainPicDir.'courses/';
	
	$fobrainLibDir =  $fobrainPicDir.'library-book/';
	
	$fobrainProductDir =  $fobrainPicDir.'products/';
	
	$fobrainQuestionDir =  $fobrainPicDir.'examQuestion/';

	$fobrainPaymentDir =  $fobrainPicDir.'payment/';

	$fobrainQRCodeDir =  $fobrainPicDir.'qrcode/';
	
	$fobrainCWallIndDir = $fobrainCWallDir.'companion-wall.php';
	
	$fobrainCInboxIndDir = $fobrainCWallDir.'companion-inbox.php';        
		
	$fobrainInstallDir = $fobrainDir.'install/';	
	
	/* script directory end */ 
	
	
	/* report messages start */ 
	
	$noscriptMsg = 'Ooops, you need to turn on your javascript in your web browser to access this web application. Thanks';

	$noConnCongfigMsg = 'Ooops critical error, some important configuration files are missing. Thanks';
							
	$tframeF = "*Ooops Error,
				you don't have right again to add / edit this session class result. This
				session class result <span style = 'font-weight:bold;color:#000; 
				text-transform:uppercase;'>(";

	$tframeS = ") </span><span style='font-weight:bold;color:#000'> has been published. Thank You</span>";
				
	$sessNote = "<span class='label label-danger'>NOTE!</span>
	<span style='color:#ff0000'>School Session is to enable school search for their
							previous student records even years after graduation.
							</span>";		
						
	$rsAdsFooter = "<div class='rs-water-mark'><i class='fa fa-info-circle'></i> Computed by <b>fobrain AI</b>. 
	<b>www.fobrain.com</b> </div>";
		

	$rsAutoFooter = "<b>fobrain</b> Automatic Subject Result Scanning Format. Visits <b>www.fobrain.com</b> for more info";	

	$msg_required_fields = "*Note: This field is Required !!!!";
	$msg_required_fields_date = "*Note: Format Year/Month/Day - 2017/10/16 !!!!";		 
	$fobrainCriticalMsg = "Critical Error, An unknown error has just Occured. Please report this error to  developers";

		
	$succesMsg = "<script type='text/javascript'>
		
		Swal.fire(
			'Success Message!',
			'";
			
	$succesMsg1 = "
		
		Swal.fire(
			'Success Message!',
			'";	  

	$errorMsg = "<script type='text/javascript'>
		
		Swal.fire(
			'Error Message!',
			'"; 	
		
	$warningMsg = "<script type='text/javascript'>
		
		Swal.fire(
			'Warning Message!',
			'";
		
	$infoMsg = "<script type='text/javascript'>
		
		Swal.fire(
			'Info Message!',
			'";	
	
	$infoMsg1 = "
		
		Swal.fire(
			'Info Message!',
			'";		
							

	$sEnd =  "',
			'success'
		)
		
		</script>";
		
	$sEnd1 =  "',
			'success'
		)
		
			";	

	$eEnd =  "',
			'error'
		)
		
		</script>";

	$iEnd =  "',
			'info'
		)
		
		</script>";	

	$iEnd1 =  "',
			'info'
		)
		
		";			

	$wEnd =  "',
			'warning'
		)
		
		</script>";   

	$succMsg = '<div class="fs-12 p-10" style="background: #39DA8A !important; color: #000 !important; text-align:justify">
				<i class="fas fa-check fa-3x pull-left pe-15"></i> <strong>Success : </strong> <br />'; 

	$erroMsg = '<div class="alert alert-danger alert-dismissible alert-label-icon label-arrow fade show" role="alert">
					<i class="mdi mdi-block-helper label-icon fs-30"></i> <strong>Error :</strong> - ';  

	$warnMsg = '<div class="alert alert-warning alert-dismissible alert-label-icon label-arrow fade show" role="alert">
					<i class="mdi mdi-alert-outline label-icon fs-30"></i> <strong>Warning</strong> - ';

	$infMsg = '<div class="alert alert-info alert-dismissible alert-label-icon label-arrow fade show mb-0" role="alert">
				<i class="mdi mdi-alert-circle-outline label-icon fs-30"></i> <strong>Info</strong> - ';

	$infoAdsMsg = '<div class="alert alert-info alert-dismissible alert-label-icon label-arrow fade show mb-0" role="alert">
	<i class="mdi mdi-alert-circle-outline label-icon fs-30"></i> <strong>Info</strong> - ';	

	$msgEnd =  ' 
				</div> '; 
	
	$sdo_tb_fi_grade = "<span class='fobrain-footer'>70 - 100 = Excellent, 60 - 69 = V. Good, 50 - 59 = Good, 
	45 - 49 = Pass, 40 - 44 = Fair, 0 - 39 = Fail</span>"; 
	
	$sdo_tb_se_grade = "<span class='fobrain-footer text-danger fw-600'>5 = Excellent, 4 = V. Good, 3 = Good, 2 = Pass, 1 = Fair, 
	0 = Fail</span>";

	$userNavPageError =  "<script type='text/javascript'> window.location.href = '$fobrain404Dir';</script>; exit;"; 
	
	$formErrorMsg = "*Ooops Error, all form required input must be entered";	 
	
	//$fobrain_tb_footer = $infoAdsMsg.$rsAdsFooter.$msgEnd;	 
	
	/* report messages end */ 
	
	
	/* predefined array start */

	$options_bcrypt = [
		'cost' => 12,
	]; global $options_bcrypt;
	
	$modeLogPages = array (
	
			1=> 'super.php', 'hm.php', 'bursary.php', 'libraian.php', 'classmg.php', 'staff.php'  
	
	); 
	
	$adminRankingArr = array (
	
		1=> 'Admin', 'Head Master/Mistress', 'Bursary', 'Libraian', 'Class Manager', 'Staff'

	);
	
	$adminRankingMinArr = array ( /* This for companion wall and must reflect $adminRankingArr */
	
		1=> 'Admin', 'HM', 'Bursary', 'Libraian', 'Staff', 'Staff'

	);
	
	$validPicFormats = array("
			
			jpg", "png", "jpeg"
			
	);
	
	$validDocFormats = array(
	
			"doc", "docx", "pdf", "xls", "xlsx", "txt"
			
	); 
	
	$validRSformat = array(
	
			"xls", "xlsx"
			
	); 
	
	$validPicExt = array(
	
		'jpeg','jpg','png'
		
	); 
	
	$validPicType = array(
	
		'image/jpeg', 'image/jpg', 'image/png'
		
	); 
	
	$validPicFormats = array(
	
		"jpg", "png", "jpeg"
		
	); 
	
	$validDocExt = array(
	
		"doc", "docx", "pdf", "xls", "xlsx", "txt"
		
	); 
	
	$validDocType = array(
	
		'doc' => 'application/msword', 
		'pdf' => 'application/pdf', 
		'xls' => 'application/vnd.ms-excel', 
		'txt' => 'text/plain',
		'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
		'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' 
		
	); 	
	
	$validDocFormats = array(
	
		"doc", "docx", "pdf", "xls", "xlsx", "txt"
		
	);
	
	$validExcelExt = array(
	
		"xls", "xlsx" 
	); 
	
	$validExcelType = array(
	
		'xls' => 'application/vnd.ms-excel', 'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'  
		
	); 	
	
	$validExcelFormats = array(
	
		"xls", "xlsx" 
		
	);
	
	$validMediaType = array(

		'audio/mpeg',  'audio/ogg', 'audio/x-matroska', 'audio/x-wav', 'audio/x-ms-wma', 
		'video/mpeg', 'video/mp4', 'video/ogg', 'video/x-matroska', 'video/x-msvideo', 'video/x-flv', 'video/x-ms-wmv', 
		'video/quicktime'
		
	);
	
	$validMediaExt = array(
	
			'mp3', 'mpga', 'ogg', 'mka', 'wav', 'wma', 'mp2', 'mpeg', 'mp4', 'ogv', 'mkv', 'avi', 'flv', 'wmv', 'mov'
			
	);
	
	$validMediaFormats = array(
			
			"mp3", "mp4", "MP3", "MP4"
			
	);
	$validAudioFormats = array(
	
			'mp3', 'mpga', 'ogg', 'mka', 'wav', 'wma'
	
	);
	$validVideoFormats = array(
			
			'mp2', 'mpeg', 'mp4', 'ogv', 'mkv', 'avi', 'flv', 'wmv', 'mov'
			
	);  
	
	$statelist = array (
	
			1=> 'Abia', 'Adamawa', 'Akwa Ibom', 'Anambra', 'Bauchi', 'Bayelsa', 'Benue', 'Borno', 
			'Cross River', 'Delta', 'Ebonyi', 'Edo', 'Ekiti', 'Enugu', 'FCT', 'Gombe', 'Imo', 
			'Jigawa', 'Kaduna', 'Kano', 'Katsina', 'Kebbi', 'Kogi', 'Kwara', 'Lagos', 'Nasarawa', 
			'Niger', 'Ogun', 'Ondo', 'Osun', 'Oyo', 'Plateau', 'Rivers', 'Sokoto', 'Taraba', 
			'Yobe', 'Zamfara', '****'

	);
						
	$gender_list = array (
	
			1=> 'Female',	'Male'
	
	);

	$attendance_list = array (
	
			'Absent', 'Present', 'Present (Late)', 'Holiday'
	
	);

	$attendance_list_2 = array (
	
		'<span class="text-danger">Absent</span> <i class="fas fa-user-times text-danger fs-20"></i>', 
		'<span class="text-success">Present</span> <i class="fas fa-user-check text-success fs-20"></i>', 
		'<span class="text-success">Present (Late)</span> <i class="fas fa-user-check text-success fs-20"></i>', 
		'<span class="text-dark">Holiday</span> <i class="fas fa-user-alt-slash text-dark fs-20"></i>' 

	);
	
	$promotionArr = array ( 
	
			1=> 'Promoted', 'Promoted On Trial', 'Not Promoted'
			
	);
	
	$fobrainRunModeArr = array (
	
			1=> 'Session', 'Current'
			
	); 
	
	$admission_status = array ( 
	
			1 => 'UME' , 2 => 'SSCE', 3 => 'Direct Entry'

	);
	
	$bloodgr_list = array ( 
	
			1 => 'A+' , 2 => 'A-', 3 => 'B+', 4 => 'B-', 5 => 'AB+', 6 => 'AB-', 7 => 'O+', 8 => 'O-'

	);

	$genotype_list = array ( 
	
			1 => 'AA' , 2 => 'AS', 3 => 'SS'

	);

	$rs_status_list = array ( 
	
			1 => 'Editing' , 2 => 'Confirmation', 3 => 'Approved'

	);	
	
	$conduct_list = array (
	
			1=> '1', '2', '3', '4', '5'

	);								   

	$classType_list = array (
	
			1 => 'Science Class', 'Art Class', 'Commerce Class', 'General Class'

	);				   
	
	$term_list = array ( 
	
			1 => 'First Term' , 2 => 'Second Term',  3 => 'Third Term' 
			
	);
	
	$termIntList = array ( 
	
			1 => '1st' , 2 => '2nd',  3 => '3rd'

	);				   

	$class_list = array (
	
			'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q'

	); 
	
	$active_status_list = array (
	
			0 => 'No', 1 => 'Yes'

	);			   

	$mslist = array (
	
			1=> 'Single', 'Married', 'Divorced', 'Widowed'

	); 
	
	$rslist = array (
	
			1=> 'Editing', 'Computed', 'Published'

	);

	$title_list = array (
	
			0=> '', 'Mr', 'Mrs', 'Miss', 'Dr', 'Engr', 'Prof' 

	);

	$leave_list = array (
	
		1=> 'Pending', 'Approved', 'Disapproved'

	);

	$payroll_list = array (
	
		0=> 'Unpaid', 'Paid', 'Withheld'

	);

	$course_material_list = array (
	
		1=> 'Soft Copy eg PDF, WORD',  'Video Tutorial', ' External Video Link eg Youtube'

	);

	$appoint_list = array (
	
		1=>  'Temporary', 'Contract', 'Permanent'

	); 

	$identification_list = array (
	
		1=> 'International Passport', 'National ID', 'Driving Licencse', 'Voters Card'

	);
	
	$certifylist = array ( 
	
			0 => 'FALSE', 1 => 'TRUE' 
			
	);
	
	$onOffArr = array ( 
		 
		0 => 'Disenable', 'Enable' 
			
	);

	$lockArr = array (
	
		0 => 'Lock', 'Unlock' 
			
	);

	$gradelist = array (
	
			1=> 'A', 'B', 'C', 'D', 'E', 'F'

	);  
						
	$schoolRegSuffArr = array (
	
			1=> '/NUR', '/PRI', '/SEC'

	);				   

	$nursery_list = array (
	
			1=> 'Nursery 1', 'Nursery 2', 'Nursery 3'

	);

	$primary_list = array (
	
			1=> 'Primary 1', 'Primary 2', 'Primary 3', 'Primary 4', 'Primary 5', 'Primary 6'

	);

	$secondary_list = array (
	
			1=> 'JSS 1', 'JSS 2', 'JSS 3', 'SSS 1', 'SSS 2', 'SSS 3'

	);
	
	$courseRawArr = array (
	
			1=> 'jemji', 'jiemj', 'jmeji'
			
	);
	
	/*
	$fobrainDBArr = array (
	
			1=> "$fobrainNurDB", "$fobrainPriDB", "$fobrainSecDB", "$fobrainDB"
			
	);
	*/
	$fobrainBioArr = array (
	
			'Surname', 'First Name', 'Middle Name', 'Gender', 
			'Birthday', 'Blood Group', 'Genotype', 'Country', 'State/Province', 'City', 'Parmanent Address', 
			'Temporary Address', 'Student Phone No.', 'Student Email', 'Hostel ID', 'Transport ID', 'Sponsor Name', 
			'Sponsor Phone No.', 'Sponsor Occupation', 'Sponsor Address'
	);
	
	$alphabetArr = array(
	
			1=> 'A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'
			
	); 
						
	$libraryStatusArr = array (
	
			'Unavailable', 'Available'
			
	);
	
	$libraryAppStatusArr = array (
	
			1=> 'Pending', 'Approved', 'Returned', 'Dis-approved'
			
	);
	
	$libraryTypeArr = array (
	
			1=> 'E - Book', 'Hard Copy'
			
	);
	
	$productStatusArr = array (
	
			'Out of Stock', 'In Stock'
			
	);
	
	$paymentMethodArr = array (
	
			//1=> 'Bank Deposit / Transfer', 'Online'
			1=> 'Cash', 'Bank Transfer', 'Credit Card', 'Cheque'
			
	);
	
	$paymentStatus = array (
	
			'Part', 'Full'
			
	);
	
	$confirm_pay_arr = array (
	
			1=>'Pending', 'Approved', 'Decline'
		
	);
	
	$cardStatusArr = array (
	
			'Unuse', 'Used'
			
	); 
	
	$transactionArr = array ( 
	
			1 => 'Still Open',  'Paid',  'Sent',  'Delivered'
			
	);

	$account_type_arr = array ( 
	
			1 => 'Current Assets',  'Non Current Assets',  'Current Liabilities',  
				'Non Current Liabilities', 'Equity', 'Income/Revenues', 'Expenses'
			
	); 

	$account_state_arr = array ( 
	
			1 => 'Balance Sheet',  'Income Statement' 
			
	);

	$acc_group_arr = array ( 
	
			1 => 'Under Profit (Income Statement)',  'Under Expenses (Income Statement)' 
			
	);

	$acc_group_arr2 = array ( 
	
			0 => 'None', 'Under Profit',  'Under Expenses' 
			
	);
	
	$rsTypeArr = array ( 
	
			1 => 'Computational  Result',  'Comment Style Result'
			
	); 
	
	$ewallet_list = array ( 
	
			0 => "No" , 1 => "Use Termly" , 2 => "Use Annually"
			
	);

	$live_virtual_apk_arr = array (
	
		1=> 'Video SDK (Default)',  'Google Meet', 'Zoom', 'Microsoft Team'

	);

	$live_meeting_status = array ( 
	
		0 => "Cancelled", 1 => "Awaited", 2 => "Live", 3 => "Finished"
		
	);

	$pmeeting_list = array ( 
	
		1 => "General", 2 => "Class"
		
	);

	$stmeeting_list = array ( 
	
		1 => "General", 2 => "Select Staff"
		
	);

	$meeting_allow_list = array (
	
		0 => 'No', 1 => 'Yes'

	);

	$toggle_list = array (
	
		0 => 'No', 1 => 'Yes'

	);

	$live_meeting_list = array ( 
	
		0 => '	<a href="javascript:;"  class ="text-danger btn waves-effect btn-label waves-light">
					<i class="mdi mdi-account-tie-voice-off label-icon"></i>  Cancelled 											
				</a>', 
		1 => '	<a href="javascript:;"  class ="text-sienna btn waves-effect btn-label waves-light">
					<i class="mdi mdi-timeline-check-outline label-icon"></i>  Awaited	 											
				</a>', 
		2 => '	<a href="javascript:;"  class ="text-success btn waves-effect btn-label waves-light">
					<i class="mdi mdi-account-tie-voice label-icon"></i>  Live 											
				</a>',
		3 => '	<a href="javascript:;"  class ="text-danger btn waves-effect btn-label waves-light">
					<i class="mdi mdi-lock-clock label-icon"></i>  Finished 											
				</a>',		
		
	);

	$fob_pview_list = array ( 

		1 => 'data-aos="fade-down" data-aos-easing="ease-out-cubic" data-aos-duration="12000"', 
		2 => 'data-aos="fade-up" data-aos-easing="ease-out-cubic" data-aos-duration="12000"',
		3 => 'data-aos="fade-right" data-aos-easing="ease-out-cubic" data-aos-duration="12000"',
		4 => 'data-aos="fade-left" data-aos-easing="ease-out-cubic" data-aos-duration="12000"'
		
	); 

	$fob_pview_list_2 = array (  
	
		1 => 'animate__animated animate__fadeInUp', 
		2 => 'animate__animated animate__fadeInDown',
		3 => 'animate__animated animate__slideInUp',
		4 => 'animate__animated animate__zoomInDown',
		5 => 'animate__animated animate__zoomInLeft',
		6 => 'animate__animated animate__zoomInRight',
		7 => 'animate__animated animate__zoomInUp',
		8 => 'animate__animated animate__slideInDown',
		9 => 'animate__animated animate__slideInUp',
		10 => 'animate__animated animate__backInUp' 
		
	);  

	$student_upload_arr = array(   
		
		"profile" => array(  
		
			"name" => "uploadProfile", 
			"field" => "i_stupic", 
			"preview" => "preview-picture-1", 
			"desc" => "Student Picture", 
		),

		"bcert" => array(  
		
			"name" => "upload1", 
			"field" => "bcert", 
			"preview" => "preview-picture-2", 
			"desc" => "Birth Certificate", 
		),

		"guardid" => array(  
		
			"name" => "upload2", 
			"field" => "guardid", 
			"preview" => "preview-picture-3", 
			"desc" => "Guardian National ID", 
		),

		"prevcert" => array(  
		
			"name" => "upload3", 
			"field" => "prevcert", 
			"preview" => "preview-picture-4", 
			"desc" => "Previous School Results", 
		), 
	
		
	);
	
	$staff_upload_arr = array(  

		"sign" => array(  
		
			"name" => "uploadSign", 
			"field" => "i_sign", 
			"preview" => "preview-picture-1",
			"desc" => "Staff Signature", 
		), 
				
		
		"natid" => array(  
		
			"name" => "uploadNatID", 
			"field" => "natid", 
			"preview" => "preview-picture-2", 
			"desc" => "National ID", 
		),
		
		"appoint" => array(  
		
			"name" => "uploadApp", 
			"field" => "appl", 
			"preview" => "preview-picture-3", 
			"desc" => "Appointment Letter", 
		),

		"doc1" => array(  
		
			"name" => "uploadDoc1", 
			"field" => "doc_1", 
			"preview" => "preview-picture-4", 
			"desc" => "Extra Staff Document 1", 
		),

		"doc2" => array(  
		
			"name" => "uploadDoc2", 
			"field" => "doc_2", 
			"preview" => "preview-picture-5", 
			"desc" => "Extra Staff Document 2", 
		),

		"doc3" => array(  
		
			"name" => "uploadDoc3", 
			"field" => "doc_3", 
			"preview" => "preview-picture-6", 
			"desc" => "Extra Staff Document 3", 
		), 
	
		
	); 
	
	/* predefined array end */  
	
	/* database table name start */ 
	
	$schoolSessionTB = $fobrainDB.'.fobrain_session';
	$studentOnlineRegTB = $fobrainDB.'.fobrain_registration';
	$adminAccessTB = $fobrainDB.'.fobrain_access';
	$fobrainSchoolTB = $fobrainDB.'.fobrain_schoolinfo';
	$eWalletTB = $fobrainDB.'.fobrain_ewallet_nkiruka';
	$disabilityTB = $fobrainDB.'.fobrain_disability';
	$tRemarksTB = $fobrainDB.'.fobrain_remarks';
	$schoolClubTB = $fobrainDB.'.fobrain_club';
	$schoolClubPostTB = $fobrainDB.'.fobrain_cpost';
	$sportsTB = $fobrainDB.'.fobrain_sports';
	$staffTB = $fobrainDB.'.fobrain_teachers_record';
	$staffLeaveTB = $fobrainDB.'.fobrain_staff_leave';
	$staffLeaveCatTB = $fobrainDB.'.fobrain_leave';	
	$staffRankingTB = $fobrainDB.'.fobrain_teacher_rank';
	$subjectsTB = $fobrainDB.'.fobrain_school_subjects';
	$teachersAssignSubTB = $fobrainDB.'.fobrain_assign_subject_teachers';
	$notificationTB = $fobrainDB.'.fobrain_events_notification';
	$routeTB = $fobrainDB.'.fobrain_route';
	$fobrainSchLibConfig = $fobrainDB.'.fobrain_library_configs';
	$fobrainSchLib = $fobrainDB.'.fobrain_library';
	$fobrainLibApplyTB = $fobrainDB.'.fobrain_library_apply';
	$bankAccountTB = $fobrainDB.'.bank_accounts';
	$chartAccountTB	 = $fobrainDB.'.fobrain_chart_accounts';
	$accountJournalTB	 = $fobrainDB.'.fobrain_chart_journal';
	$feeCategoryTB = $fobrainDB.'.fobrain_fee_category';
	$expenseCategoryTB = $fobrainDB.'.fobrain_expense_category';
	$bursaryConfigTB = $fobrainDB.'.fobrain_bursary';
	$fobrainFeesTB = $fobrainDB.'.fobrain_fees'; 
	$fobrainExpenseTB = $fobrainDB.'.fobrain_expense';
	$expenseDocTB = $fobrainDB.'.fobrain_expense_docs';
	$productCategoryTB = $fobrainDB.'.fobrain_product_category';
	$fobrainProductTB = $fobrainDB.'.fobrain_products';
	$fobrainProductPicTB = $fobrainDB.'.fobrain_product_pic';
	$fobrainOrderTB = $fobrainDB.'.fobrain_product_order';
	$fobrainOrderSummTB = $fobrainDB.'.fobrain_order_summ';
	$fobrainSMSTB = $fobrainDB.'.fobrain_sms';
	$fobrainMailTB = $fobrainDB.'.fobrain_mail'; 
	$fobrainVitualTB = $fobrainDB.'.fobrain_virtual_gateway';
	$fobrainPayGatewayTB = $fobrainDB.'.fobrain_payment_gateway';	
	$fobrainBroadcastTB = $fobrainDB.'.fobrain_broadcast';	
	$fobrainGradeTB = $fobrainDB.'.fobrain_grades';
	$payrollTB = $fobrainDB.'.fobrain_payroll';	
	$fobrainStaffMeetingTB = $fobrainDB.'.fobrain_staff_meet'; 
	$fobrainCWallTB = $fobrainDB.'.fobrain_cw_forum'; 
	$fobrainMailBoxTB = $fobrainDB.'.fobrain_cw_mailbox'; 
	$fobrainMailReportTB = $fobrainDB.'.fobrain_cw_ireport';
	$cWallNotificationTB = $fobrainDB.'.fobrain_cw_notification'; 
	$cWallLikesTB = $fobrainDB.'.fobrain_cw_likes_track'; 
	$cWallCommentTB = $fobrainDB.'.fobrain_cw_comments';
	$cWallPostTB = $fobrainDB.'.fobrain_cw_posts';
	$cWallTempUploadTB = $fobrainDB.'.fobrain_cw_temp_upload_pic';  
	$fobrainParentMeetingTB = $fobrainDB.'.fobrain_parent_meet';
	
	/* database table name end */ 			

	global $rseditingStage, $rscomputedStage, $rspublishStage; 
	global $fobrainDB, $fobrainNurAbr, $fobrainPriAbr, $fobrainSecAbr;  
	global $first_semester_code, $second_semester_code; 
	global $foreal, $i_false; 
	global $fiVal, $seVal, $thVal, $foVal, $fifVal, $sixVal, $sevVal, $eightVal, $nineVal, $tenVal;  
	global $cWallNumPerPage, $randChars, $randCharBig, $randNumber, $oneMB, $validPicExt, $validPicType; 		
	global $fobrainTemplate, $fobrainTemplateIN, $fobrainDBConnectDir; 
	global $wiz_default_img, $wiz_df_staff_img, $wiz_df_sign_img, $wiz_df_cart_img, $wiz_df_word_img, $wiz_df_file_img,
	$wiz_df_pdf_img, $wiz_df_xls_img, $wiz_df_exam_img, $wiz_default_img_i; 
	global $wall_s_loader, $fobrainPicDir, $student_img, $pic_path, 
	$staff_doc_ext, $staff_pic_ext, $forumPicExt, $fobrainCWallDir, $admin_pic_ext, $forumPicExtTem,
	$expense_doc_ext;	
	global $nursery_list, $primary_list, $secondary_list, $title_list, $leave_list, $payroll_list, $appoint_list, $identification_list;	
	global $succesMsg, $errorMsg, $warningMsg, $infoMsg, $sEnd, $iEnd, $eEnd, $wEnd,$msgEnd, $userNavPageError, $formErrorMsg;	
	global $currencySymbols, $translatorArr;				
	global $adminAccessTB, $eWalletTB,  $disabilityTB, $tRemarksTB, $schoolClubTB, $schoolClubPostTB,
	$sportsTB, $fobrainSchoolTB, $TeachersTb, $staffRankingTB, $schoolSessionTB, $teachersAssignSubTB,
	$studentOnlineRegTB, $notificationTB, $routeTB, $fobrainSchLibConfig, $fobrainSchLib, $fobrainLibApplyTB, 
	$bankAccountTB, $chartAccountTB, $accountJournalTB, $feeCategoryTB, $expenseCategoryTB, $bursaryConfigTB, $fobrainFeesTB, $fobrainExpenseTB, 
	$expenseDocTB, $productCategoryTB, $fobrainProductTB, $fobrainProductPicTB, $fobrainOrderTB, $fobrainOrderSummTB, 
	$fobrainSMSTB, $fobrainMailTB, $fobrainPayGatewayTB, $fobrainBroadcastTB, $staffLeaveTB, $staffLeaveCatTB, $payrollTB, 
	$fobrainStaffMeetingTB, $fobrainVitualTB;

	global $cWallPostTB, $cWallCommentTB, $fobrainCWallTB , $cWallLikesTB, 
	$cWallTempUploadTB, $fobrainMailBoxTB, $cWallNotificationTB, $fobrainParentMeetingTB, $encrypt_key,
	$header_install_script;  

	global $account_type_arr, $account_state_arr;

	global $transact_pay, $transact_sales, $transact_expense, $transact_payroll,
	$transact_m_payroll, $transact_journal_entry, $transact_journal_entry_m;
	
	$view_ran = (rand(1,4));
	$view_ran_2 = (rand(1,10)); 
	$fob_view = $fob_pview_list[$view_ran]; 
	$fob_view_2 = $fob_pview_list_2[$view_ran_2];  
	
?> 	