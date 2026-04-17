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
	This script reset staff password, remove staff and change staff username
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

    	define('fobrain', 'igweze');  /* define a check for wrong access of file */

      	require 'fobrain-config-s.php';  /* load fobrain configuration files */
		 
		if ($_REQUEST['staff'] == 'reset') {  /* reset staff password */

				 
			try {
		 				
				$staffID = $_REQUEST['reStaff'];

                mt_srand((double)microtime() * 1000000);


				if($generatePass == $foreal){  /* check generate password status */

					$userPass = randomString($charset, 8);  /* generate password */

				}else{

					$userPass = "password";

				} 

				$fi_rand = randomString($charset, 16);  /* generate password */ 
						
				$new_pass = password_hash($userPass, PASSWORD_BCRYPT, $options_bcrypt);
				
				/* update information */ 
				  
				$ebele_mark = "UPDATE $staffTB SET
							 
                						 		i_accesspass = :i_accesspass,
												i_salted = :i_salted 
												
                 								WHERE t_id = :t_id";
												
				$igweze_prep = $conn->prepare($ebele_mark);	
				$igweze_prep->bindValue(':i_accesspass', $new_pass);
				$igweze_prep->bindValue(':i_salted', $fi_rand); 
				$igweze_prep->bindValue(':t_id', $staffID); 
				
				if($igweze_prep->execute()){  /* if sucessfully */
					
					echo 'New password is: <span class="bold-pass text-danger">'.$userPass.'</span>'; 
					echo "<script type='text/javascript'>   hidePageLoader(); </script>";
					
				}else{  /* display error */ 
		
					$msg_e =  "Ooops, an error has occur while reseting staff's Password. Please try again";
					echo "<script type='text/javascript'>   hidePageLoader(); </script>";
					echo $errorMsg.$msg_e.$eEnd; echo $scroll_up; exit; 
				}
				
			}catch(PDOException $e) {
  			
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			 
			} 
		
		}elseif ($_REQUEST['staff'] == 'delete')  {  /* remove staff profile */

				 
			try {
		 				
				$staffID = strip_tags($_REQUEST['removeReg']);
				$adminPass =   $_REQUEST['adminPass'];
				$adminPass = strip_tags($adminPass);
				
										
				$checkDetail =  adminLoginData($conn, $_SESSION['adminUser']);  /* school admin password details */
			 
			 	list ($adminID, $checkedPass, $adminName) =  explode ("@(.$*S*$.)@", $checkDetail);
				
				/* script validation */
				
				if ($staffID == "") {
         			
					echo "<script type='text/javascript'>  hidePageLoader(); </script>";
					$msg_e = "* Ooops error, could not find this staff Info";
					echo $errorMsg.$msg_e.$eEnd;exit; 
					
	   			}elseif ($adminPass == "")   {
					
					echo "<script type='text/javascript'>  hidePageLoader(); </script>";					
					$msg_e = "* Ooops error, please enter your admin authorization password to continue.";
					echo $errorMsg.$msg_e.$eEnd;exit; 
					
				}elseif ($adminPass != $checkedPass)   {
					
					echo "<script type='text/javascript'>  hidePageLoader(); </script>";					
					$msg_e = "* Ooops error, your admin authorization password is wrong.";
					echo $errorMsg.$msg_e.$eEnd;exit; 
					
				}else {  /* update information */ 
				
					$ebele_mark = "UPDATE $staffTB SET
							
											status = :status
											
											WHERE t_id = :t_id";
											
					$igweze_prep = $conn->prepare($ebele_mark);	
					$igweze_prep->bindValue(':status', $i_false);
					$igweze_prep->bindValue(':t_id', $staffID);						
					
					if($igweze_prep->execute()){  /* if sucessfully */ 
						
						$msg_s = "Staff record was successfully removed by you"; 
						echo $succesMsg.$msg_s.$sEnd;							
						$staffRow = "#staff-row-".$staffID;
						
						echo "<script type='text/javascript'>  
								$('$staffRow, #modal-load-div').fadeOut(1500);   
								hidePageLoader(); 
						</script>";
						
						exit; 
						
					}else{  /* display error */
			
						$msg_e =  "Ooops, an error has occur while to remove Staff record. Please try again";
						echo $errorMsg.$msg_e.$eEnd;
						echo "<script type='text/javascript'> hidePageLoader(); </script>";exit; 
					}
						
				}
				
			}catch(PDOException $e) {
  			
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			 
			} 
		
		}elseif ($_REQUEST['staff'] == 'update')  {  /* change staff username */

			try {
		 				
				$staffID = clean($_REQUEST['staffID']);
				$email =  clean($_REQUEST['staffUser']); 
				
				/* script validation */
				
				if ($staffID == "") {
         								
					$msg_e = "* Ooops error, could not find this staff Info";
					echo $errorMsg.$msg_e.$eEnd;
					echo "<script type='text/javascript'>   hidePageLoader(); </script>"; exit;
					
	   			}elseif ($email == "")   {
					
					$msg_e = "Ooops Error, please enter staff email address";
					echo $errorMsg.$msg_e.$eEnd;
					echo "<script type='text/javascript'>   hidePageLoader(); </script>"; exit;
					
				}elseif (staffUserExits($conn, $email) >= $fiVal)   {  /* check if school staffs/teachers exits */ 
					 
					$msg_e = "* Ooops error, this email ($email) already exist. Please enter new one.";
					echo $errorMsg.$msg_e.$eEnd;
					echo "<script type='text/javascript'>   hidePageLoader(); </script>"; exit;
					
				}else {  /* update information */ 
				
					$ebele_mark = "UPDATE $staffTB SET
							
												i_email = :i_email
											
											WHERE t_id = :t_id";
											
					$igweze_prep = $conn->prepare($ebele_mark);	
					$igweze_prep->bindValue(':i_email', $email);
					$igweze_prep->bindValue(':t_id', $staffID);					
					
					if($igweze_prep->execute()){  /* if sucessfully */
						
						$msg_s = "Staff User Name <b>$email</b> was successfully updated"; 
						echo $succesMsg.$msg_s.$sEnd;														
						echo "<script type='text/javascript'>  
							$('#new-staff-info').text('$email');
							$('.change-staff-user').fadeOut(100);
							hidePageLoader(); 
						</script>";exit; 
						
					}else{  /* display error */ 
			
						$msg_e =  "Ooops, an error has occur while to update Staff user name. Please try again";
						echo $errorMsg.$msg_e.$eEnd;
						echo "<script type='text/javascript'> hidePageLoader();</script>";exit; 
						
					}
						
				}
				
			}catch(PDOException $e) {
  			
				fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			 
			} 
		
		}elseif ($_REQUEST['staff'] == 'new_staff')  {  /* change staff username */

		?> 
 
 
				<!-- form -->
				<form class="form-horizontal" id="frmsaveNewStaff">
					<!-- row -->
					<div class="row gutters">
						<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">										
							<!-- field wrapper start -->
							<div class="field-wrapper">
								<select class="form-control" id="title" name="title" >                                              
									<option value = "">Search . . .</option> 
									<?php

										foreach($title_list as $title => $titleValue){  /* loop array */	

											if ($titleVal == $title){
												$selected = "SELECTED";
											} else {
												$selected = "";
											}

											echo '<option value="'.$title.'"'.$selected.'>'.$titleValue.'</option>' ."\r\n";

										}

									?>
								</select>
								<div class="field-placeholder"> Title <span class="text-danger">*</span></div> 
							</div>
							<!-- field wrapper end -->
						</div>	
						<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">										
							<!-- field wrapper start -->
							<div class="field-wrapper">
								<input type="text" class="form-control capWords"  
								id="lname" name="lname"/>
								<div class="field-placeholder">Last Name <span class="text-danger">*</span></div> 
							</div>
							<!-- field wrapper end -->
						</div> 
						<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">										
							<!-- field wrapper start -->
							<div class="field-wrapper">
								<input type="text" class="form-control capWords"  
								id="fname" name="fname" />
								<div class="field-placeholder">First Name <span class="text-danger">*</span></div> 
							</div>
							<!-- field wrapper end -->
						</div>						 
					</div>	
					<!-- /row -->
					
					<!-- row -->
					<div class="row gutters"> 
						<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">										
							<!-- field wrapper start -->
							<div class="field-wrapper"> 
								<input type="text" class="form-control capWords" 
								id="mname" name="mname"  />
								<div class="field-placeholder">Middle Name <span class="text-danger"></span></div> 
							</div>
							<!-- field wrapper end -->
						</div> 
						<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">										
							<!-- field wrapper start -->
							<div class="field-wrapper">
								<input type="email" class="form-control lowWords" 
								id="email" name="email" placeholder="igweze@gmail.com" />
								<div class="field-placeholder"> Email <span class="text-danger">*</span></div> 
							</div>
							<div class="form-text text-danger fw-500">
								This is staff login username
							</div>
							<!-- field wrapper end -->
						</div> 			 
					</div>	
					<!-- /row -->  
					  
					<!-- row -->
					<div class="row gutters mt-20 mb-30">
						<div class="col-12 text-end">
							<input type="hidden" name="profile" value="new-staff" />
							<button type="submit" class="btn btn-primary" id="saveNewStaff">Save</button>
						</div>
					</div>	
					<!-- /row -->								  
				</form>
				<!-- / form -->			 
				
				 <script type='text/javascript'> hidePageLoader();  /* hide page loader*/</script>
						
		<?php		
		exit;						
		}else{ 
		
				echo $userNavPageError; exit;  /* else exit or redirect to 404 page */		
		
		} 
		
exit;		
?>