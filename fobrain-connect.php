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
	This script handle application database connection
	------------------------------------------------------------------------*/

		if (!defined('fobrain')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
		
		require 'connect-configs.php';  /* database connection parameters */ 
		
		//if(($fobrainDB == '') || ($server == '') || ($username == '') || ($password == '')){  /* check script installation */
		if(($fobrainDB == '') || ($server == '') || ($username == '')  ){  /* check script installation */
			
$installScript =<<<IGWEZE
        
			<meta http-equiv="refresh" content="0;URL='./install/'" />
		
IGWEZE;
		
			echo $installScript;			 
			exit;			
			
		}
		
		/* PDO connection start */
		try {
			
			$conn = new PDO("mysql:host=$server; dbname=$fobrainDB", $username, $password);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); /* PDO::ERRMODE_EXCEPTION, PDO::ERRMODE_SILENT, and PDO::ERRMODE_WARNING  */		
			$conn->exec("SET CHARACTER SET utf8"); 
			
		} catch(PDOException $e) {
			
			die( 'Ooops Database Connection failed: ' . $e->getMessage());
   
		}
		/* PDO connection end */
		
		/* mysqli connection start */
		
		try {
			
			$mysqli_conn = new mysqli($server, $username, $password, $fobrainDB);
			
			if ($mysqli_conn->connect_error) {
				
				die( 'Ooops Database Connection failed: ' . $e->getMessage());
				
			}
		
		} catch(PDOException $e) {
			
			die( 'Ooops Database Connection failed: ' . $e->getMessage());
   
		}
		
		

		/* mysqli connection end */  
 
?>
