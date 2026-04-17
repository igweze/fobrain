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
	This script handle fees payment
	------------------------------------------------------------------------*/ 

if(!session_id()){
    session_start();
}

     define('fobrain', 'igweze');  /* define a check for wrong access of file */

        require 'fobrain-config.php';  /* load fobrain configuration files */	 

		if (isset($_REQUEST['payData']) == 'payFees') { 
			
			$feeCat =   clean($_REQUEST['feeCat']);
			
			/* script validation */
			
			if ($feeCat == ""){
         			
				$msg_e = "* Ooops Error, please select fee you are paying for";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>   $('.payMethodDiv').fadeOut(100); $('#payLoader').fadeOut(3000); </script>";exit;
					
	   		}else{  /* pay fee */ 
				
				$feeCategoryInfoArr = feeCategoryInfo($conn, $feeCat);  /* school fee category information */
				$productDesc = $feeCategoryInfoArr[$fiVal]['fee'];
				$total = $feeCategoryInfoArr[$fiVal]['amount'];
				$status = $feeCategoryInfoArr[$fiVal]['status'];
				
				$productItem = $productDesc;
				echo "<script type='text/javascript'>   $('#payLoader').fadeOut(1500); </script>";

				$billingData = billingData($conn, $regNum);
				list($nameFull, $address, $city, $state, $country, $phone) = explode("##", $billingData);

				$isCart = 0;

				require_once $fobrainPayG;  /* include payment gateway script */
				
			} 
			
		}else{ 
			
			echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
						
		}	
		
		exit;
?>	