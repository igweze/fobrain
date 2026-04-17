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
	This script handle student live class
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

     define('fobrain', 'igweze');  /* define a check for wrong access of file */

        require 'fobrain-config.php';  /* load fobrain configuration files */ 
		         
		if ($_REQUEST['liveclass'] == 'start') {  /* start live class */   

			$cid = strip_tags($_REQUEST['eData']);
			$i = $fiVal;
			
			if ($cid == ""){
				
				$msg_e = "* Ooops, an error has occur while to retrieve live class information. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}else {  

				try {  
					
					$fobrainLiveArr = liveClassInfo($conn, $cid);  /* online student live class information */  
					$atype = $fobrainLiveArr[1]["atype"];
					$link = $fobrainLiveArr[1]["link"];
					$lpass = $fobrainLiveArr[1]["lpass"];

					if($atype == 1){ 

						$live_user = "participant"; 
						$live_grade = 1; 
						echo "<script type='text/javascript'>";  
							require_once $fob_live_script;  
						echo "</script>";  

					}else{

						echo "<script type='text/javascript'>   
								$('#fob-wrapper').css('display', 'block');
								$('#virtual-loading').hide();
								hidePageLoader();
								window.open('$link', '_blank'); 
							</script>"; 

					}

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				} 
		
			} 
				
			
		}else{ 
		
			echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
		
		}
		
exit;
?>

