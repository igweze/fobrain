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
	This script handle screen lock timer
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}
	error_reporting(0);
	define('fobrain', 'igweze');  /* define a check for wrong access of file */ 

	if(($_SESSION['screen_timer'] != "") && (isset($_SESSION['screen_timer'])) && ($_SESSION['screen_timer'] > 1)){   /* check if inactivity time is set */ 
	
		if (($_REQUEST['timer'] == 'check')){  /* screen lock timer validation */ 

			if (isset($_SESSION['lastActive']) && (time() - $_SESSION['lastActive'] > 
			($_SESSION['screen_timer'] * 60) )) {  /* check if inactivity time */  
				 
				$_SESSION['screen_lock'] = 1111;
				echo "<script type='text/javascript'>  $('.reload-page').trigger('click');</script>"; exit;
				  
			} 
							 
		} 

	}else{ 
	
		$_SESSION['screen_lock'] = 0000;
		exit;
			
	}			

?>