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
	This script handle new student registration
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

    	define('fobrain', 'igweze');  /* define a check for wrong access of file */

        require 'fobrain-config.php';  /* load fobrain configuration files */	   
		  
		      
		if ($_REQUEST['newBioData'] == 'newStuBioData') {

			$regNum =  $_REQUEST['newRegNum'];
			$fname = clean($_REQUEST['fname']);
			$mname = clean($_REQUEST['mname']);
			$lname = clean($_REQUEST['lname']);				
			$sessData =  $_REQUEST['sess'];

			$class =  $_REQUEST['class'];
			$en_term =  $_REQUEST['term'];
			
			$regDate =  date("Y-m-d H:i:s"); //strtotime(date("Y-m-d H:i:s"));
			
			list ($session, $en_level) = explode ("#@@#", $sessData);
			
			/* script validation */
			
			if ($regNum == "")  {
				
				$msg_e = "* Ooops Error, please enter new student Reg No";
				
			}elseif (studentExitsRV($conn, $regNum) == $foreal)  {  /* check if a student really exist */
			
				$msg_e .= "* Ooops Error, Student with this <b> Reg No  $regNum </b>already  exists in database";
			
			}elseif ($lname == "")  {
			
				$msg_e .= "* Ooops Error, please enter student first name ";
			
			}elseif($fname == "")   {
			
				$msg_e  = "* Ooops Error, please enter student' s last name  ";
			
			}elseif ($session == "")  {
			
				$msg_e .= "* Ooops Error, please select new student class";
			
			}elseif($en_level == "")   {
			
				$msg_e  = "* Ooops Error, please select new student class";
			
			}elseif($en_term == "")   {
			
				$msg_e  = "* Ooops Error, please enter student' s entry term";
			
			}else {  /* insert information */ 

				$e_status = strip_tags($e_status);  $regNum = strip_tags($regNum); 

				$e_status = trim($e_status);  $regNum = trim($regNum); 
				
				$sessionID = sessionID($conn, $session); /* school session ID  */


				try {
					
					echo '

					<!-- row -->
					<div class="row gutters row-section">
					
						<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-30">	
							<!-- card start -->
							<div class="card card-shadow">
								<div class="card-header-wiz">
									<h4>
										<i class="fas fa-user-plus fs-16"></i> 
										New Student Details
									</h4>
								</div> 
								<div id="msg-box"></div> 					
								<div class="card-body pb-70"> '; 

									mt_srand((double)microtime() * 1000000); 

									if($generatePass == $foreal){  /* check generate password status */
					
										$userPass = randomString($charset, 8);  /* generate password */
										$spon_access = randomString($charset, 8);  /* generate password */
					
									}else{
					
										$userPass = "password";
										$spon_access = "password";
					
									} 

									$n_userPass = $userPass;
									
									$userPass = password_hash($userPass, PASSWORD_BCRYPT, $options_bcrypt);
									$spon_access  = password_hash($spon_access, PASSWORD_BCRYPT, $options_bcrypt);

									$show_tasks_div = $fiVal; 
									
									if($schoolExt == $fobrainNurAbr){  /* check school type */
										
										require_once ($fobrainAdminDir.'fobrain-nur-bio.php');  /* school registration script */
										
									}else{
									
										require_once ($fobrainAdminDir.'fobrain-prisec-bio.php');  /* school registration script */
									}

									$info_pass = "$infMsg Student and Parent Password is <strong>$n_userPass</strong>  $msgEnd";
						
							echo '
					
					
								</div>
							</div>
							<!-- card end -->	
						</div>
			
						<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12" id="scroll-to-div">	
							<!-- card start -->
							<div class="card card-shadow">
								<div class="card-header-wiz">
									<h4>
										<i class="fas fa-tasks fs-16"></i> 
										Tasks Panel
									</h4>
								</div> 
								<div class="msg-box"></div> 					
								<div class="card-body" id="wigz-right-half"> 
									'.$info_pass.'
								</div>
							</div>
							<!-- card end -->	
						</div>
					</div>
					<!-- / row --> '; 

				}catch(PDOException $e) {
				
					echo "<script type='text/javascript'>  hidePageLoader();  </script>";
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				}
	
		
			}
		
			echo "<script type='text/javascript'>  hidePageLoader();  </script>"; 
			
		}else{
			
			echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
			
		}
 
			
		if ($msg_s) {

			echo $succMsg.$msg_s.$msgEnd; exit;
									
        }	 

		if ($msg_e) {

			echo $erroMsg.$msg_e.$msgEnd; exit;
									
        }	
			
exit;
?>