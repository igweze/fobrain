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
	This script handle course rating and reviews
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

		define('fobrain', 'igweze');  /* define a check for wrong cidess of file */

		require 'fobrain-config.php';  /* load fobrain configuration files */
		 	
		if ($_REQUEST['query'] == 'save') {  /* save cids category */ 
			
			$course = clean($_REQUEST['cid']); 
			$review = clean($_REQUEST['review']);
			$rating = clean($_REQUEST['rating']);	 
			
			/* script validation */
			
			if ($course == "")  {
				
				$msg_e = "* Ooops Error, could not fetch course information";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
				
			}elseif ($rating == "")  {
			
				$msg_e = "* Ooops Error, select your course rating";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
			
			}elseif ($review == "")  {
			
				$msg_e = "* Ooops Error, please enter course review";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
			
			}else {  /* update information */   
 
				try {
					
					$review = strip_tags($review);
					$review = str_replace('<br />', "\n", $review);
					$review = htmlspecialchars($review);
					
					$ebele_mark = "INSERT INTO $courseReviewTB  (cid, regnum, review, rating, program)

							VALUES (:cid, :regnum, :review, :rating, :program)";
					
					$igweze_prep = $conn->prepare($ebele_mark); 
					$igweze_prep->bindValue(':cid', $course);
					$igweze_prep->bindValue(':regnum', $regNum);
					$igweze_prep->bindValue(':review', $review);
					$igweze_prep->bindValue(':rating', $rating); 
					$igweze_prep->bindValue(':program', $i_program);
					
					if($igweze_prep->execute()){  /* if sucessfully */
						
						$msg_s = "Your review was successfully posted"; 
						echo $succesMsg.$msg_s.$sEnd; 
						echo "<script type='text/javascript'>  
								$('.frm-course-review').slideUp(1500);
								hidePageLoader();  
							</script>"; exit;
						
					}else{  /* display error */
			
						$msg_e =  "Ooops, an error has occur while to add new course review. Please try again";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
						
					}
					 

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				} 
		
			}
		
		}elseif ($_REQUEST['query'] == 'update') {  /* update cids category */ 
			
			$course = clean($_REQUEST['cid']); 
			$review = clean($_REQUEST['review']);
			$rating = clean($_REQUEST['rating']); 
			$rid = cleanInt($_REQUEST['rid']);			
			
			/* script validation */ 
			
			if ($rid == ""){
				
				$msg_e = "* Ooops, an error has occur to retrieve course information";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
				
			}elseif ($course == "")  {
				
				$msg_e = "* Ooops Error, could not fetch course information";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
				
			}elseif ($rating == "")  {
			
				$msg_e = "* Ooops Error, select your course rating";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
			
			}elseif ($review == "")  {
			
				$msg_e = "* Ooops Error, please enter course review";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
			
			}else {  /* update information */     			


				try {

					$review = strip_tags($review);
					$review = str_replace('<br />', "\n", $review);
					$review = htmlspecialchars($review); 
					
					$ebele_mark = "UPDATE $courseReviewTB
									
									SET 
									
										cid = :cid, 
										regnum = :regnum,
										review = :review, 
										rating = :rating, 
										program = :program
										
										WHERE rid = :rid";
					
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':cid', $course);
					$igweze_prep->bindValue(':regnum', $regNum);
					$igweze_prep->bindValue(':review', $review);
					$igweze_prep->bindValue(':rating', $rating); 
					$igweze_prep->bindValue(':program', $i_program);
					$igweze_prep->bindValue(':rid', $rid); 
					
					if($igweze_prep->execute()){  /* if sucessfully */
						
						$msg_s = "Your review was successfully updated";
						echo $succesMsg.$msg_s.$sEnd; 
						echo "<script type='text/javascript'> 
								$('.frm-course-review').slideUp(1500);
								hidePageLoader(); 
							</script>";exit;
						
					}else{  /* display error */
			
						$msg_e =  "Ooops, an error has occur while to save course review. Please try again";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
						
					}
					

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				} 
		
			}
		
		}elseif ($_REQUEST['query'] == 'remove') {  /* remove cids category */ 
			
			$query = $_REQUEST['rData'];
			
			list($fobrainIg, $rid, $hName) = explode("-", $query);			
			
			/* script validation */
			
			if (($query == "")  || ($rid == "")){
				
				$msg_e = "* Ooops, an error has occur while to remove course review. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader();  </script>";exit;
				
			}else {   /* update information */    			

				try {
											
					$ebele_mark = "UPDATE $courseReviewTB
									
									SET 										
										program = :program
										
										WHERE rid = :rid";
					
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':program', $i_false);
					$igweze_prep->bindValue(':rid', $rid); 
					
					if($igweze_prep->execute()){  /* if sucessfully */
						
						//$removeDiv = "$('#row-".$rid."').fadeOut(1000);";
						$msg_s = "<strong>$hName</strong> was successfully Disenable"; 
						echo $succesMsg.$msg_s.$sEnd; 
						echo "<script type='text/javascript'>    
								//$('#load-cid-category').load('cid-category-info.php');
								hidePageLoader();   
						</script>";exit;
						
					}else{  /* display error */
			
						$msg_e =  "Ooops, an error has occur while to remove course review. Please try again";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'> hidePageLoader();  </script>";exit;
						
					}
					

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				}          		
		
			}
		
		}elseif ($_REQUEST['query'] == 'edit') {  /* edit cids category */

			
			$rid = strip_tags($_REQUEST['rData']);
			
			/* script validation */ 
			
			if ($rid == ""){
				
				$msg_e = "* Ooops, an error has occur while to retrieve course review information. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
				
			}else {  /* select information */     			

				try { 
					
					$courseReviewInfoArr = courseReviewInfo($conn, $rid);  /* school course review information */
					$course = $courseReviewInfoArr[$fiVal]['cid'];
					$regNum = $courseReviewInfoArr[$fiVal]['regnum'];
					$review = $courseReviewInfoArr[$fiVal]['review'];
					$rating = $courseReviewInfoArr[$fiVal]['rating'];
					$program = $courseReviewInfoArr[$fiVal]['program'];

 														
							
					echo "<script type='text/javascript'>  hidePageLoader(); </script>"; exit; 						

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				} 
		
			}
		
		}else{ 
		
			echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
		
		} 
		
exit;
?>