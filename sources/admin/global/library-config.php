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
	This script handle library configuration
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

		if (!defined('fobrain')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');	    
		
		if (($_REQUEST['libData']) == 'libConfigs') {
			
			$numApply =  cleanInt($_REQUEST['numApply']);
			$numBorrow =  cleanInt($_REQUEST['numBorrow']);
			$dateline =  cleanInt($_REQUEST['dateline']);

			/* script validation */ 
			
			if ($numApply == "")  {
				
				$msg_e = "* Ooops error, please enter number of book/s a student can apply from school library. Thanks";
				
			}elseif ($numBorrow == "")  {
				
				$msg_e = "* Ooops error, please enter number of book/s a student can borrow from school library. Thanks";
					
			}elseif ($dateline == "")  {
				
				$msg_e = "* Ooops error, please enter school library book dateline in Days. Thanks";
					
			}else {  /* select information */

				try {
		
					$datelineM = $dateline.' DAY';

					$ebele_mark = "UPDATE $fobrainSchLibConfig SET
					
									book_no_apply = :book_no_apply,
									book_no_borrow = :book_no_borrow,
									book_dateline = :book_dateline
									
									WHERE c_id = :c_id";
									
					$igweze_prep = $conn->prepare($ebele_mark);	
					
					$igweze_prep->bindValue(':book_no_apply', $numApply);
					$igweze_prep->bindValue(':book_no_borrow', $numBorrow);
					$igweze_prep->bindValue(':book_dateline', $datelineM);
					$igweze_prep->bindValue(':c_id', $fiVal);
					
					if ($igweze_prep->execute()) {  /* if sucessfully */ 
	
						$scriptSlide =  "$('#frmlibConfiguration').slideUp(2000);";
						$msg_s = "School Library Configuration was Successfully Saved.";
	
							
					}else {  /* display error */ 
	
							$msg_e = "<span>Ooops, an error has occur
							while trying to save School Library Configuration, Please try again</span>";	
					
					} 

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				} 

			} 
	
		}else{
		
			echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
		
		} 
		
		if ($msg_s) {

			echo "<script type='text/javascript'>   $scriptSlide hidePageLoader(); </script>";
			echo $succesMsg.$msg_s.$sEnd;exit; 				
									
		}	


		if ($msg_e) {
			
			echo "<script type='text/javascript'>  hidePageLoader(); </script>";
			echo $errorMsg.$msg_e.$eEnd;exit;	 
									
		}	
		
exit;
?>