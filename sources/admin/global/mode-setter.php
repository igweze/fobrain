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
	This script handle school session activation mode
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

		if (!defined('fobrain')) /* This checks if this page was wrongly access by users */
		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');	
		
		if (($_REQUEST['mode'] == 'run')){
			
			$fobrainMode = $_REQUEST['fobrainMode'];
			$fobrainMode = strip_tags($fobrainMode);
			
			/* script validation */ 
			
			if($fobrainMode == ""){$fobrainMode = $seVal;}
			
			unset($_SESSION['fobrainRunMode']);
			//$fobrainRunModeArr[$seVal]; 
			
			if($fobrainMode == $fiVal){  /* activate session run mode */
				
				$_SESSION['fobrainRunMode'] = $fiVal;
				
				$hideMode = "$('#school-mode-".$fiVal."').hide(300);";
				$showMode = "$('#school-mode-".$seVal."').show(300);";
				
				
			}elseif($fobrainMode == $seVal){  /* activate current run mode */
				
				$_SESSION['fobrainRunMode'] = $seVal;
				$hideMode = "$('#school-mode-".$seVal."').hide(300);";
				$showMode = "$('#school-mode-".$fiVal."').show(300);";
				
			}else{  /* activate current run mode */
				
				$_SESSION['fobrainRunMode'] = $seVal;
				$hideMode = "$('#school-mode-".$seVal."').hide(300);";
				$showMode = "$('#school-mode-".$fiVal."').show(300);"; 					
			}	
			
			$sRunMode = $fobrainRunModeArr[$fobrainMode];
			
			$msg_s = "*School Running Mode Successfully Activated to  <strong>$sRunMode</strong>.";
				
			echo $succesMsg.$msg_s.$sEnd;  
				
$script =<<<IGWEZE
			
			<script type="text/javascript"> 				
				$("#runModeText").html("$sRunMode");
				$hideMode $showMode 
				hidePageLoader();	
			</script>
	
IGWEZE;
			echo $script;
			
		
		}
		
exit;
?>