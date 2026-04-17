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
	This script handle student rollcall
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}


	define('fobrain', 'igweze');  /* define a check for wrong access of file */
			
	require 'fobrain-config.php';  /* load fobrain configuration files */	   

	//echo "<pre>"; print_r($_REQUEST); echo "</pre>";
	 
	if (($_REQUEST['load']) == 'roll') {

		$last_id = $_GET['lastId'];
		
		try {

			$regID = studentRegID($conn, $regNum);    /* student record ID  */
				
			loadMoreRollCall($conn, $regID, $last_id, $load_more_limit);  /* retrieve student daily attendance */	 

		}catch(PDOException $e) {

			fobrainDie( 'Ooops Database Error: ' . $e->getMessage());

		}
	 

	}else if (($_REQUEST['load']) == 'event') {

		$last_id = $_GET['lastId'];
		
		try { 
				
			loadMoreEvents($conn, $last_id, $load_more_limit);  /* retrieve student daily attendance */	 

		}catch(PDOException $e) {

			fobrainDie( 'Ooops Database Error: ' . $e->getMessage());

		}
	 

	}else{


		echo $userNavPageError;   /* exit or redirect to 404 page */


	}
			
	 
			
exit;

?>