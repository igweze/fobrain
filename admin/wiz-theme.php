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
	This script load fobrain theme
	------------------------------------------------------------------------*/
exit; //discontinued
if(!session_id()){
    session_start();
}

     define('fobrain', 'igweze');  /* define a check for wrong access of file */

         require 'fobrain-config-s.php';  /* load fobrain configuration files */	   
		
?>		

		 
 

			<div id="msg-box"> </div>

			<div class="card-body">
				<button type="button" id="color#473C8B" class="btn btn-theme btn-theme-1">Select Theme</button><!-- theme button #01c0c8 -->
				<button type="button" id="color#00868B" class="btn btn-theme btn-theme-2">Select Theme</button><!-- theme button -->	
				<button type="button" id="color#006746" class="btn btn-theme btn-theme-3">Select Theme</button><!-- theme button -->
				<button type="button" id="color#27408B" class="btn btn-theme btn-theme-4">Select Theme</button><!-- theme button -->
				<button type="button" id="color#8B1C62" class="btn btn-theme btn-theme-5">Select Theme</button><!-- theme button -->
				<button type="button" id="color#1E1E1E" class="btn btn-theme btn-theme-6">Select Theme</button><!-- theme button -->
				<button type="button" id="color#4B0082" class="btn btn-theme btn-theme-7">Select Theme</button><!-- theme button -->
				<button type="button" id="color#330033" class="btn btn-theme btn-theme-8">Select Theme</button><!-- theme button -->
				<button type="button" id="color#033" class="btn btn-theme btn-theme-9">Select Theme</button><!-- theme button -->
				<button type="button" id="color#06c" class="btn btn-theme btn-theme-10">Select Theme</button><!-- theme button -->  
			</div>  