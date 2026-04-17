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
	This script handle school view broadcast information
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

     define('fobrain', 'igweze');  /* define a check for wrong access of file */

        require 'fobrain-config.php';  /* load fobrain configuration files */	   
		        
			if ($_REQUEST['broadcastData'] == 'viewBroadcast') {

				
				$bID = strip_tags($_REQUEST['rData']);
				
				/* script validation */
				
				if ($bID == ""){
         			
					$msg_e = "* Ooops, an error has occur while to retrieve broadcast message. Please try again";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
					
	   			}else {       			


		 			try {
						
						
						$broadcastInfoArr = broadcastInfo($conn, $bID);  /* school annoucement/broadcast information */
						$bTitle = $broadcastInfoArr[$fiVal]["bTitle"];
						$broadcastMsg = htmlspecialchars_decode($broadcastInfoArr[$fiVal]["broadcastMsg"]); 
						$date = $broadcastInfoArr[$fiVal]["date"]; 						
						$date = date("j F Y", strtotime($date));  
						$broadcastMsg = nl2br($broadcastMsg);
									

$showBroadcast =<<<IGWEZE
		
						<a href="javascript:;"  class="btn btn-primary waves-effect btn-label waves-light 
						printer-icon pull-right mb-30">
							<i class="fas fa-print label-icon"></i>  Print
						</a>

						<div id = 'fobrain-print'> 
							<!-- table -->
							<table   class="table table-hover table-responsive style-table"> 

							<tr><th style="padding-left: 30px; text-align:left; width: 30%;">
							Title </td> <td style="padding-left: 30px; text-align:left; width: 70%;">
							$bTitle class </td> </tr> 

							<tr><th style="padding-left: 30px; text-align:left; width: 30%;">
							Message </td> <td style="padding-left: 30px; text-align:left; width: 70%;">
							$broadcastMsg</td> </tr>


							<tr><th style="padding-left: 30px; text-align:left; width: 30%;">
							Date </td> <td style="padding-left: 30px; text-align:left; width: 70%;">
							$date</td> </tr> 
							</table> 
							<!-- / table -->
						</div>				
		
IGWEZE;
				
						echo $showBroadcast; 
						
						echo "<script type='text/javascript'> hidePageLoader(); </script>"; exit; 

				 	}catch(PDOException $e) {
  			
						fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					}          		
        	
				}
			
			}else{ 
			
				echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
			
			} 
			
exit;
?>