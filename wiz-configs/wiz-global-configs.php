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
	This script  school global configurations
	------------------------------------------------------------------------*/

		if (!defined('fobrain')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');

		if($wiz_school_global == "nur"){
		 
			$schoolID = $fiVal;		$schoolTBPref = $fobrainNurPref;	  
			$supRegNo = $schoolRegSuffArr[$schoolID];   
			$school_pic_dir = $fobrainPicDir.'nursery/'; global $school_pic_dir;		  		  
			$fobrainConfigTB = $fobrainDB.'.fobrain_config_nur';			
			$schoolExt = $wiz_school_global; 

		}elseif($wiz_school_global == "pri"){

			$schoolID = $seVal;		$schoolTBPref = $fobrainPriPref;	
			$supRegNo = $schoolRegSuffArr[$schoolID]; 
			$school_pic_dir = $fobrainPicDir.'primary/'; global $school_pic_dir;
			$fobrainConfigTB = $fobrainDB.'.fobrain_config_pri';		
			$schoolExt = $wiz_school_global;	

		}elseif($wiz_school_global == "sec"){

			$schoolID = $thVal;		$schoolTBPref = $fobrainSecPref;			  
			$supRegNo = $schoolRegSuffArr[$schoolID]; 
			$school_pic_dir = $fobrainPicDir.'secondary/'; global $school_pic_dir;
			$fobrainConfigTB = $fobrainDB.'.fobrain_config_sec';
			$schoolExt = $wiz_school_global;

		}else{
			echo $infoMsg.$noConnCongfigMsg.$iEnd; exit;  /* display error */ 
		}

		if(file_exists($fobrainDBConnectDir)){ require ($fobrainDBConnectDir); /* include database connection script */ }
		elseif(file_exists($fobrainDBConnectIndDir)){ require ($fobrainDBConnectIndDir); /* include database connection script */ }
		else { echo $infoMsg.$noConnCongfigMsg.$iEnd; exit;  /* display error */ }	

        require 'common-db-configs.php';  /* include common database table information  */

		global $fobrainConfigTB;
?>		