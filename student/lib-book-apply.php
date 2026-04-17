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
	This script handle library book application
	------------------------------------------------------------------------*/ 

if(!session_id()){
    session_start();
}

    define('fobrain', 'igweze');  /* define a check for wrong access of file */

        require 'fobrain-config.php';  /* load fobrain configuration files */	   

		$scroll_up = "<script type='text/javascript'> $('html, body').animate({scrollTop:$('#scroll-target').position().top}, 'slow'); hidePageLoader(); </script>";
		 
		 
		if ($_REQUEST['bookID'] != '') {

			try {
							
				$bookID = strip_tags($_REQUEST['bookID']);				
				
				/* script validation */ 				
				
				if($bookID == ""){
					
					$msg_e =  "Ooops error, this library book information was not found. Please try again"; 
					
				}else{	
				
					libraryBookExceededLimitChecker($conn, $regID, $schoolID, $render = true);  /* check if student has any expired library book in possession */

					libraryBookApplicationLimit($conn, $regID, $schoolID);  /* check if student has exceeded book application limit */

					$bookUserInfo = libraryBookAppStatus($conn, $bookID, $regID, $schoolID);

					list ($bookAppStatus, $applyDate, $approveDate, $returnDate) = explode ("@.%.@", $bookUserInfo);

					$bookInfo = libraryBookInfo($conn, $bookID);  /* school library book information */
					
					list ($book_id, $book_name, $book_path, $book_author, $book_type, $book_status) = explode ("@.%.@", $bookInfo);

					if($bookAppStatus == ''){

						$applyTime = date("Y-m-d H:i:s");

						$ebele_mark = "INSERT INTO $fobrainLibApplyTB (book_id, lib_user, lib_reg, apply_date, stype, b_status)
								  
									  VALUES(:book_id, :lib_user, :lib_reg, :apply_date, :stype, :b_status)";
									  
						$igweze_prep = $conn->prepare($ebele_mark);	
						$igweze_prep->bindValue(':book_id', $bookID);
						$igweze_prep->bindValue(':lib_user', $regID);
						$igweze_prep->bindValue(':lib_reg', $regNum);
						$igweze_prep->bindValue(':apply_date', $applyTime);
						$igweze_prep->bindValue(':stype', $schoolID); 
						$igweze_prep->bindValue(':b_status', $fiVal); 

						if ($igweze_prep->execute()) {  /* if sucessfully */

							$msg_s = "Your application was successfully. You will be notify if your application is approved";

						}else {  /* display error */

							$msg_e = "Ooops error, your application was not successfully received. Please try again.";

						}

					}elseif($bookAppStatus == $fiVal){  /* display information message */ 

						$applyDateS = date('h:i:s, d F, Y', strtotime($applyDate)); 
						$msg_i = "You have already apply for to borrow  <span>$book_name</span> on <strong>$applyDateS</strong>. Meanwhile, your application is pending and you will be notify if your  application is approved.";

					}elseif($bookAppStatus == $seVal){  /* display information message */ 

						$approveDateS = date('h:i:s, d F, Y', strtotime($approveDate)); 
						$msg_i = "School Library book by name <span>$book_name</span> have been approved for you  on <strong>$approveDateS</strong> and is in your possession now.";

					}else{  /* display error */ 

						$msg_e = "<span>Ooops error, your application  to borrow School Library book by name <span>$book_name</span> was not successfully received. Please try again.</span>";

					}

				}		

			}catch(PDOException $e) {
				
						fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
				 
			} 
			
		}else{
		
				$msg_e =  "Ooops error, this library book information was not found. Please try again";
			
		}
				 
		
	
		if ($msg_s) {

			echo $succesMsg.$msg_s.$sEnd; echo $scroll_up; exit; 				
									
        }	

		if ($msg_i) {

			echo $infMsg.$msg_i.$msgEnd; echo $scroll_up; exit; 				
									
        }	 

		if ($msg_e) {

			echo $errorMsg.$msg_e.$eEnd;  echo $scroll_up; exit;  
									
        }	 
		
exit;		
?>