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
	This script handle school homework information
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
} 

     	define('fobrain', 'igweze');  /* define a check for quesno access of file */

        require 'fobrain-config.php';  /* load fobrain configuration files */
		      
		if ($_REQUEST['query'] == 'save') {  /* save homework */ 
			
			$eid = clean($_REQUEST['eid']);
			$correct = clean($_REQUEST['correct']);
			$quesno = clean($_REQUEST['quesno']);
			$yscore = clean($_REQUEST['yscore']);
			$tscore = clean($_REQUEST['tscore']); 
			$aver = clean($_REQUEST['aver']); 

			$ttime = date('Y-m-d H:i:s');
			
			/* script validation */
			
			if (($eid == "")  || ($correct == "") || ($yscore == "")  || ($tscore == "")  || ($aver == "")) {
				
				$msg_e = "* Ooops Error, could not save student homework performance";
				echo $errorMsg.$msg_e.$eEnd; exit;
				
			}else {   /* insert information */   						
				

				try {		
					
					$onlineHomeWorkInfoArr = onlineHomeWorkInfo($conn, $eid);  /* online student homework information */ 
					$level = $onlineHomeWorkInfoArr[$fiVal]["level"];
					$term = $onlineHomeWorkInfoArr[$fiVal]["eTerm"];
					$class = $onlineHomeWorkInfoArr[$fiVal]["class"];
					$eTitle = $onlineHomeWorkInfoArr[$fiVal]["eTitle"];
					$course = $onlineHomeWorkInfoArr[$fiVal]["eSubject"]; 
					$etime = $onlineHomeWorkInfoArr[$fiVal]["eTime"];
					
					$ebele_mark = "INSERT INTO $fobrainHomeWorkRevTB  (eid, regnum, course, level, class, term, etime, 
												correct, quesno, yscore, ttime, tscore, aver)

							VALUES (:eid, :regnum, :course, :level, :class, :term, :etime, 
												:correct, :quesno, :yscore, :ttime, :tscore, :aver)";
					
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':eid', $eid);
					$igweze_prep->bindValue(':regnum', $regNum); 
					$igweze_prep->bindValue(':course', $course); 
					$igweze_prep->bindValue(':level', $level);
					$igweze_prep->bindValue(':class', $class);
					$igweze_prep->bindValue(':term', $term);
					$igweze_prep->bindValue(':etime', $etime);
					$igweze_prep->bindValue(':correct', $correct);
					$igweze_prep->bindValue(':quesno', $quesno);
					$igweze_prep->bindValue(':yscore', $yscore);
					$igweze_prep->bindValue(':ttime', $ttime);
					$igweze_prep->bindValue(':tscore', $tscore);
					$igweze_prep->bindValue(':aver', $aver); 
					
					if($igweze_prep->execute()){  /* if sucessfully */ 
						
						$msg_s = "Your homework performance was successfully saved"; 
						echo $succesMsg.$msg_s.$sEnd; exit;   
						
					}else{  /* display error */
			
						$msg_e = "* Ooops Error, could not save student homework performance";
						echo $errorMsg.$msg_e.$eEnd; exit; 
						
					}
					

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				}          		
		
			}
		
		}elseif ($_REQUEST['query'] == 'update') {  /* upttime homework */
			exit; /* not be used */	
			$rid = cleanInt($_REQUEST['rid']);		 
			 
					
					$ebele_mark = "UPDATE $fobrainHomeWorkRevTB  
										
										SET 
										
										eid = :eid, 
										regnum = :regnum, 
										level = :level, 
										term = :term, 
										etime = :etime, 
										correct = :correct, 
										quesno = :quesno, 
										yscore = :yscore, 
										ttime = :ttime, 
										tscore = :tscore
										
									WHERE rid = :rid";
					
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':rid', $rid);
					$igweze_prep->bindValue(':eid', $eid);
					$igweze_prep->bindValue(':regnum', $regnum);
					$igweze_prep->bindValue(':level', $level);
					$igweze_prep->bindValue(':term', $term);
					$igweze_prep->bindValue(':etime', $etime);
					$igweze_prep->bindValue(':correct', $correct);
					$igweze_prep->bindValue(':quesno', $quesno);
					$igweze_prep->bindValue(':yscore', $yscore);
					$igweze_prep->bindValue(':ttime', $ttime);
					$igweze_prep->bindValue(':tscore', $tscore);  
		
		}else{
					
			echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
		
		}

		
exit;
?>