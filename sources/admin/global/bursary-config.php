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
	This script handle bursary configuration
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

		if (!defined('fobrain')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');	    
		
		if (($_REQUEST['query']) == 'save') {
			
			$currency =  clean($_REQUEST['currency']);
			//$bank =  clean($_REQUEST['bank']);
			$stax = clean($_REQUEST['stax']);
			$ptax = clean($_REQUEST['ptax']);
			$account = clean($_REQUEST['bank_acc']);
			$allow = clean($_REQUEST['allow']);

			if ($currency == "")  {
				
				$msg_e = "* Error, please select currency to be use";
				
			}
			/*elseif ($account == "")  {
				
				$msg_e = "* Error, create bank account and link account to online school sales";
				
			}elseif ($allow == "")  {
				
				$msg_e = "* Error, enable or dis-enable negative transactions e.g ₦ -4,044,00 in debits";
				
			}*/
			else {  /*  update information */ 

				try {
						
					//$bank = str_replace('<br />', "\n", $bank); 
					//$bank = htmlspecialchars($bank);

					$ebele_mark = "UPDATE $bursaryConfigTB SET
					
									account = :account,
									currency = :currency, 
									stax = :stax,
									ptax = :ptax									
									
									WHERE b_id = :b_id";
									
					$igweze_prep = $conn->prepare($ebele_mark);									
					$igweze_prep->bindValue(':account', $account);
					$igweze_prep->bindValue(':currency', $currency);
					//$igweze_prep->bindValue(':bank', $bank); bank = :bank, 
					$igweze_prep->bindValue(':stax', $stax);
					$igweze_prep->bindValue(':ptax', $ptax);
					//$igweze_prep->bindValue(':allow', $allow);allow = :allow
					$igweze_prep->bindValue(':b_id', $fiVal); 
					
					if ($igweze_prep->execute()) {  /* if sucessfully */  

						//$scriptSlide =  "$('#frmburConfiguration').slideUp(2000);";
						$msg_s = "School Bursary configuration was successfully saved.";		
							
					}else {	 /* display error */
					
						$msg_e = "Ooops, an error has occur while trying to save school bursary configuration, Please try again"; 
					
					}									

					}catch(PDOException $e) {
				
						fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
					
					} 

			}
				
		}else{
		
			echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
		
		} 
		
		if ($msg_s) { 
			
			echo $succesMsg.$msg_s.$sEnd; 
			echo "<script type='text/javascript'>   $scriptSlide hidePageLoader(); </script>";
			exit; 				
									
		}	
	
		if ($msg_e) {
			
			echo $errorMsg.$msg_e.$eEnd;
			echo "<script type='text/javascript'> hidePageLoader(); </script>";
			exit;  
									
		}	
		
exit;
?>