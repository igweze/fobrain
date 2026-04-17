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
	
  */

    if (!defined('fobrain')) /* This checks if this page was wrongly access by users */ 
    die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');

	 
	if($component_free == 1){

		$msg_i = "* Ooops, your account does not support live classes or meetings. Please upgrade to access these features.";
		echo $infoMsg.$msg_i.$iEnd;  
		echo "<script type='text/javascript'>  
				
				hidePageLoader();
				$('#fob-wrapper').css('display', 'block');
				$('#virtual-loading').hide(); 
		</script>";exit;

	}else{

		try { 
					
			$gID =1;
			$virtualGatewayInfoArr = virtualGatewayInfo($conn, $gID);  /* virtual gateways information */
			$virtualID = $virtualGatewayInfoArr[$fiVal]["gID"];
			$gateway = $virtualGatewayInfoArr[$fiVal]["gateway"];
			$gatewayVerb = $virtualGatewayInfoArr[$fiVal]["gatewayVerb"];
			$virtual_api_key = trim($virtualGatewayInfoArr[$fiVal]["gateKey"]); 

			if($virtual_api_key == ""){

				$msg_i = "* Ooops, you need to your api key from from app.videosdk.live for virtual classes or meeting.";
				echo $infoMsg.$msg_i.$iEnd;  
				echo "<script type='text/javascript'>  						
						hidePageLoader();
						$('#fob-wrapper').css('display', 'block');
						$('#virtual-loading').hide(); 
				</script>";exit;

			}

		}catch(PDOException $e) {
		
			fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
		}	

		if($live_user == "host"){  
			require 'host.php';
		}else{
			require 'guest.php';
		}

	}
		
	 

    
        
?>
