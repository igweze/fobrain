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
	This script load staff access cpanel
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

     define('fobrain', 'igweze');  /* define a check for wrong access of file */

      	require 'fobrain-config.php';  /* load fobrain configuration files */	   
		 
		if ($_REQUEST['reg'] != '') {

				 
			try {
		 				
				$reg = strip_tags($_REQUEST['reg']);
				
				/* script validation */ 
				
				if($reg == ""){
					
					$msg_e =  "Ooops, student  record  was not found.";
					
				}else{  /* select student profile */ 
 
					$sessionID = studentRegSessionID($conn, $reg);  /* student school session ID */
					$session_fi = fobrainSession($conn, $sessionID);  /* school session */
							 
					$session_se = $session_fi + $foreal;  

					$ebele_mark = "SELECT r.ireg_id, nk_regno, s.stu_id, i_stupic, i_firstname, i_lastname, i_midname, 
					i_accesspass, i_sponsor_p
									

									FROM $i_reg_tb r,  $i_student_tb s

									WHERE r.nk_regno = :nk_regno
						 
									AND r.ireg_id = s.ireg_id";
						 
					$igweze_prep = $conn->prepare($ebele_mark);
					

					$igweze_prep->bindValue(':nk_regno', $reg);
					 
					$igweze_prep->execute();
					
					$rows_count = $igweze_prep->rowCount(); 
					
					if($rows_count == $foreal) {  /* check array is empty */
					
						while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {  /* loop array */		
		   
							$regNum = $row['nk_regno'];
							$ID = $row['ireg_id'];
							$pic = $row['i_stupic'];
							$fname = $row['i_firstname'];
							$lname = $row['i_lastname'];
							$mname = $row['i_midname'];
							$spoAccess = $row['i_sponsor_p'];
							$stuAcesss = $row['i_accesspass']; 
						
						}	 
						 
						$student_img = picture($school_pic_dir.$session_fi.'_'.$session_se.'/', $pic, "student"); 
						
						$msg_w = "*<img src = '$student_img' height = '70' width = '90' 
						class= 'img-responsive img-circle pull-left' style='margin:0px 10px 0px 10px' id='fobrainStudentPic' > 
						Do you really want to remove <strong>$lname $fname $mname</strong> information from school database. 
						Please Note that is an irreversible action. To continue, Please enter your password below"; 				
				        
$studentInfo =<<<IGWEZE

						<!-- row -->
						<div class="row gutters mt-25"> 
							<div class="col-12 text-center">										
								<img src = "$student_img"  class=" img-h-100 img-circle img-thumbnail">
							</div> 
							<div class="col-12 text-center  text-primary mt-10">										
								$lname $fname $mname 
							</div>															 
						</div>	
						<!-- /row -->

						<!-- row -->
						<div class="row gutters mt-25"> 
							<div class="col-5 fw-700 text-primary align-self-center">										
								Student Password
							</div>
							<div class="col-4 align-self-center">										
								<div id="student-password"> ******** </div>
							</div>
							<div class="col-3 align-self-center">										
								<a href="javascript:;"  id='$regNum' class ="reset-student-pass demo-disenable btn btn-primary waves-effect   
								btn-label waves-light">
									<i class="mdi mdi-lock-reset label-icon"></i>  Reset  
								</a>
							</div>																 
						</div>	
						<!-- /row --> 

						<!-- row -->
						<div class="row gutters mt-25"> 
							<div class="col-5 fw-700 text-primary align-self-center">										
								Parent Password
							</div>
							<div class="col-4 align-self-center">										
								<div id="staff-password"> ******** </div>
							</div>
							<div class="col-3 align-self-center">										
								<a href="javascript:;"  id='$regNum' class ="reset-parent-pass demo-disenable btn btn-dark waves-effect   
								btn-label waves-light">
									<i class="mdi mdi-lock-reset label-icon"></i>  Reset  
								</a>
							</div>																 
						</div>	
						<!-- /row -->  
 
						<!-- row -->
						<div class="row gutters mt-25"> 
							<div class="col-3 fw-700 text-danger align-self-center">										
								Deactivate  
							</div> 
							<div class="col-6 align-self-center">	 
								<input type="text" class="form-control"
								name="ad-pass" id="ad-pass" placeholder ="Super Admin Password" />
							</div>
							<div class="col-3 align-self-center">										
								<a href="javascript:;"  id='$regNum' class = "remove-student demo-disenable btn btn-danger waves-effect   
								btn-label waves-light">
									<i class="mdi mdi-delete label-icon"></i>  Delete
								</a>
							</div>																 
						</div>	
						<!-- /row --> 

IGWEZE;

						echo $studentInfo;

						echo "<script type='text/javascript'> hidePageLoader();	</script>";	
				

					}else{  /* display error */ 
		
						$msg_e =  "Ooops, student  record with <strong>$reg</strong> was not found.";
					
					}
				
				}
				
				
			}catch(PDOException $e) {
				
				fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
				 
			}
	
		
		
		
		}else{		
		
			echo $userNavPageError; exit;  /* else exit or redirect to 404 page */		
		
		}
		
		
	
		if ($msg_e) {

         	 echo $errorMsg.$msg_e.$eEnd; echo "<script type='text/javascript'> hidePageLoader();	</script>";	 echo $scroll_up; exit; 			
			

        }
		
		
exit;		
?>	