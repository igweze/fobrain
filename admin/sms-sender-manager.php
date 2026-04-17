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
	This script send text message to students, parents and staffs
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}
 
		define('fobrain', 'igweze');  /* define a check for wrong access of file */
		
		if ($_REQUEST['show_more'] == 0) {
			
			require 'fobrain-config-s.php';  /* load fobrain configuration files */
			$show_more = false;
				
		}elseif ($_REQUEST['show_more'] == 1) {
				
			require 'fobrain-config.php';  /* load fobrain configuration files */
			$show_more = true;
				
		}else{		
		
			exit;  /* else exit or redirect to 404 page */	
		
		} 

	
		if ($_REQUEST['sms'] == 'student') {  /* send SMS to selected parents/students  */

			$sendTo = cleanInt($_REQUEST['sendTo']);			
			$student_data = $_REQUEST['students'];
			$sentMsg = preg_replace("/[^A-Za-z0-9@%?+. ]/", "", $_REQUEST['message']);
			
			$sentMsg = strip_tags($sentMsg);
			
			/* script validation */ 				
			
			if ($sendTo == ""){
				
				$msg_e = "* Ooops Error, please selec which people to sent message to";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
				
			}elseif ($student_data == "")  {
				
				$msg_e = "* Ooops Error, please select student/guardian";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
				
			}elseif ($sentMsg == "")  {
				
				$msg_e = "* Ooops Error, please enter  message to send";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
				
			}else {  /* send SMS to selected parents/students  */       			

				try {
					
					$smsCArr = smsCurrentGateway($conn);  /* current text message and gateway information */
					
					$sID = $smsCArr[$fiVal]["sID"];
					$gateway = $smsCArr[$fiVal]["gateway"];
					$senderID = $smsCArr[$fiVal]["senderID"];
					$user = $smsCArr[$fiVal]["user"];
					$password = htmlspecialchars_decode($smsCArr[$fiVal]["password"]);
					$api = $smsCArr[$fiVal]["api"];
					$status = $smsCArr[$fiVal]["status"];										
					$status = $onOffArr[$status];
					
					if($sID  >= $fiVal){  /* if current gateway is not empty  */
															
						$balance = fobrainSMSBalance($api, $user, $password, $sID);  /* check text message balance  */ 

$tbHead =<<<IGWEZE

						<!-- row -->
						<div class="row gutters my-20"> 
							<div class="col-12">								
								<p class="text-primary"> SMS  Balance Before Sending - $balance</p> 
							</div>	
						</div>	
						<!-- /row -->
						
						<script type='text/javascript'> 
							$('#sms-msg-title').text('Sent SMS Reports and Summary');
							$('#frm-student-sms').slideUp(1000);  
							renderTable(); 
						</script>
						<div class="table-responsive">
							<!-- table -->
							<table class='table table-hover table-responsive style-table wiz-table' id="wiz-table">					
								<thead>
									<tr>
										<th>S/N</th> 
										<th>Reg No.</th> 
										<th>Picture</th>
										<th>Student Info.</th>  
										<th>Recp. Number</th> 
										<th>SMS Reports</th> 
									</tr>
								</thead> 
								<tbody> 
								
IGWEZE;
								
								echo $tbHead;
								
								$studentArr =  explode(',', $student_data);										

								foreach ($studentArr as $studentInfo) {										
									
									list($student_name, $regNo) = explode("-", $studentInfo);
									$student_name = trim($student_name);
									$regNo = trim($regNo);
									
									$student_data = studentSMSInfo($conn, $regNo);  /* students SMS record information  */ 
									list ($full_name, $stuPhone, $spoPhone, $student_img) = explode ("@##@", $student_data);
									if($sendTo == $fiVal){ $receiver = $spoPhone;}
									elseif($sendTo == $seVal){ $receiver = $stuPhone;}
									else{ $receiver = ""; } 
									
									if($receiver == ""){  /* if receiver is empty display information message */ 
										
										$reports = '<button type="button" class="btn btn-white"> 
										<i class="fas fa-exclamation-triangle"></i> Message Not Sent </button>';
										$receiver = '<button type="button" class="btn btn-white"> 
										<i class="fas fa-exclamation-triangle"></i> Phone No. Empty </button>';
										
									}else{	
										
											/* send text message through current gateway */ 
										$reports = fobrainSendSMS($api, $senderID, $user, $password, $receiver, $sentMsg, $sID);
									
									}
									
									$serial_no++;

$sendReports =<<<IGWEZE
	
									<tr>
										<td width="5%">$serial_no</td>										
										<td width="10%"> <a href='javascript:;' id='$regNo' class ='view-student high-light-link'>$regNo </a> </td>
										<td width="10%">  
											<a href='javascript:;' id='$regNo' class ='view-student'>
												<img src = "$student_img" class=" img-h-50 img-circle img-thumbnail">
											</a>  
										</td> 
										<td width="25%"> 		 	
											<a href='javascript:;' id='$regNo' class ='view-student high-light-link'>
												$full_name
											</a>    
										</td>  
										<td> $receiver </td> 											
										<td> $reports</td> 
									</tr>
	
IGWEZE;
							
									echo $sendReports;
									
									
								}


								$balanceAF = fobrainSMSBalance($api, $user, $password, $sID);  /* check text message balance  */ 

$tbTail =<<<IGWEZE

										</tbody>
									</table>				
									<!-- / table -->
								</div>		        

								<!-- row -->
								<div class="row gutters mt-20 mb-40">
									<div class="col-12">										
										<p class="text-primary"> SMS  Balance After Sending - $balanceAF </p> 
									</div>	
								</div>	
								<!-- /row -->

								<hr class="my-20 text-danger" />

IGWEZE;
								
								echo $tbTail;
									
									
									
					}else{  /* display error */

						$msg_e = "* Ooops Error, please configure or set your default sms gateway before you can send SMS.";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
									
					}	
								
					
				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				}
	
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
			
		
			}
		
		}elseif ($_REQUEST['sms'] == 'student-class') {  /* send SMS to all class parents/students  */

			$sendTo = cleanInt($_REQUEST['sendTo']);			
			$sentMsg = preg_replace("/[^A-Za-z0-9@%?+. ]/", "", $_REQUEST['message']);
			$session = $_REQUEST['sess']; 
			$level = $_REQUEST['level'];
			$class_data = $_REQUEST['class'];

			list ($class, $class_val) = explode ("@+@", $class_data);
			
			$session = strip_tags($session);
			$class = strip_tags($class);
			$level = strip_tags($level);
			$sentMsg = strip_tags($sentMsg);	

			/* script validation */ 
			
			if ($sendTo == ""){
				
				$msg_e = "* Ooops Error, please selec which people to sent message to";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
				
			}elseif (($session == '') || ($level == '') || ($class == '')) {
			
				$msg_e =  $formErrorMsg;
				
				echo $errorMsg.$msg_e.$eEnd;  
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
			
				
			}elseif ($sentMsg == "")  {
				
				$msg_e = "* Ooops Error, please enter  message to send";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
				
			}else {  /* send SMS to all class parents/students  */       			


				try {
					
					$smsCArr = smsCurrentGateway($conn);  /* current text message and gateway information */
				
					$sID = $smsCArr[$fiVal]["sID"];
					$gateway = $smsCArr[$fiVal]["gateway"];
					$senderID = $smsCArr[$fiVal]["senderID"];
					$user = $smsCArr[$fiVal]["user"];
					$password = htmlspecialchars_decode($smsCArr[$fiVal]["password"]);
					$api = $smsCArr[$fiVal]["api"];
					$status = $smsCArr[$fiVal]["status"];										
					$status = $onOffArr[$status];
							
					if($sID  >= $fiVal){  /* if current gateway is not empty  */
								
						$mClass = studentClassLevel($level);  /* retrieve student class */
						$sessionID = sessionID($conn, $session);  /* school session ID */
						$session_fi = fobrainSession($conn, $sessionID);  /* school session  */
						$session_se = $session_fi + $foreal;
						
						$ebele_mark = "SELECT r.ireg_id, nk_regno, s.stu_id, i_stupic, i_firstname, i_lastname, i_midname,
						i_stu_phone, i_spo_phone
	
										FROM $i_reg_tb r INNER JOIN $i_student_tb s
						
										ON (r.ireg_id = s.ireg_id)

										AND r.session_id = :session_id 
									
										AND r.$mClass = :class

										AND r.active = :foreal";
								
						$igweze_prep = $conn->prepare($ebele_mark);									
						$igweze_prep->bindValue(':session_id', $sessionID, PDO::PARAM_STR);				
						$igweze_prep->bindValue(':foreal', $foreal, PDO::PARAM_STR);				
						$igweze_prep->bindValue(':class', $class, PDO::PARAM_STR);				 
						$igweze_prep->execute();
						
						$rows_count = $igweze_prep->rowCount(); 
						
						if($rows_count >= $foreal) {  /* check array is empty */
						
							$balance = fobrainSMSBalance($api, $user, $password, $sID);  /* check text message balance  */ 

$tbHead =<<<IGWEZE

							<!-- row -->
							<div class="row gutters my-20"> 
								<div class="col-12">								
									<p class="text-primary"> SMS  Balance Before Sending - $balance</p> 
								</div>	
							</div>	
							<!-- /row -->

							<script type='text/javascript'> 
								$('#sms-msg-title').text('Sent SMS Reports and Summary');
								$('#frm-student-sms').slideUp(1000);  
								renderTable(); 
							</script>
							<div class="table-responsive">
								<!-- table -->
								<table class='table table-hover table-responsive style-table wiz-table' id="wiz-table">					
									<thead>
										<tr>
											<th>S/N</th> 
											<th>Reg No.</th> 
											<th>Picture</th>
											<th>Student Info.</th>  
											<th>Recp. Number</th> 
											<th>SMS Reports</th> 
										</tr>
									</thead> 
									<tbody> 
IGWEZE;
								
									echo $tbHead;
									
									while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
							
										$regNo = $row['nk_regno'];
										$ID = $row['ireg_id'];
										$pic = $row['i_stupic'];
										$fname = $row['i_firstname'];
										$lname = $row['i_lastname'];
										$mname = $row['i_midname'];
										$stuPhone = $row['i_stu_phone'];
										$spoPhone = $row['i_spo_phone'];
										
										$fname = trim($fname);
										$lname = trim($lname);
										$mname  = trim($mname);
										$stuPhone = trim($stuPhone);
										$spoPhone= trim($spoPhone);
										
										$student_name = "$lname $fname $mname";
										$student_name = ucwords($student_name);
										$student_name = trim($student_name);
										$regNo = trim($regNo);   
											
										$student_img = picture($school_pic_dir.$session_fi.'_'.$session_se.'/', $pic, "student"); 
										
										$serial_no++;
											
										if($sendTo == $fiVal){ $receiver = $spoPhone;}
										elseif($sendTo == $seVal){ $receiver = $stuPhone;}
										else{ $receiver = ""; }
										
										
										if($receiver == ""){  /* if receiver is empty display information message */
											
											$reports = '<button type="button" class="btn btn-white"> 
											<i class="fas fa-exclamation-triangle"></i> Message Not Sent </button>';
											$receiver = '<button type="button" class="btn btn-white"> 
											<i class="fas fa-exclamation-triangle"></i> Phone No. Empty </button>';
											
										}else{ 	
										
												/* send text message through current gateway */ 
											$reports = fobrainSendSMS($api, $senderID, $user, $password, $receiver, $sentMsg, $sID);
										
										}
										
										$serial_no++;

$sendReports =<<<IGWEZE
	
										<tr>
											<td width="5%">$serial_no</td>										
											<td width="10%"> <a href='javascript:;' id='$regNo' class ='view-student high-light-link'>$regNo </a> </td>
											<td width="10%">  
												<a href='javascript:;' id='$regNo' class ='view-student'>
													<img src = "$student_img" class=" img-h-50 img-circle img-thumbnail">
												</a>  
											</td> 
											<td width="25%"> 		 	
												<a href='javascript:;' id='$regNo' class ='view-student high-light-link'>
													$student_name
												</a>    
											</td>  
											<td> $receiver </td> 											
											<td> $reports</td> 
										</tr>	 
	
IGWEZE;
							
										echo $sendReports;
									
									
									}
									
									$balanceAF = fobrainSMSBalance($api, $user, $password, $sID);  /* check text message balance  */ 

$tbTail =<<<IGWEZE

				
											</tbody>
										</table>				
										<!-- / table -->
									</div>		        

									<!-- row -->
									<div class="row gutters mt-20 mb-40">
										<div class="col-12">										
											<p class="text-primary"> SMS  Balance After Sending - $balanceAF </p> 
										</div>	
									</div>	
									<!-- /row -->

									<hr class="my-20 text-danger" />

IGWEZE;
								
									echo $tbTail;
									
						}else{  /* display error */ 
									
							$msg_e = "Error, no record was found for <span>
							$session - $session_se session $classLevel $class</span>";
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;											
						}	
									
					}else{  /* display error */ 

						$msg_e = "* Ooops Error, please configure or set your default sms gateway before you can send SMS.";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
									
					}	
								
					
				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				}
	
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
			
		
			}
		
		}elseif ($_REQUEST['sms'] == 'some-staff') {  /* send SMS to selected staffs  */

						
			$staff_data = $_REQUEST['staffs'];
			$sentMsg = preg_replace("/[^A-Za-z0-9@%?+. ]/", "", $_REQUEST['message']);
			
			$sentMsg = clean($sentMsg);
			
			/* script validation */ 	
			
			if (is_array($staff_data)){

				$count_staff =  count($staff_data);

			}else{ $count_staff = 0; }
			
			if ((!is_array($staff_data)) || ($count_staff < 1))  {
				
				$msg_e = "* Ooops Error, please select staff/s";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
				
			}elseif ($sentMsg == "")  {
				
				$msg_e = "* Ooops Error, please enter  message to send";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
				
			}else {       			

				try {
					
					$smsCArr = smsCurrentGateway($conn);  /* current text message and gateway information */
					
					$sID = $smsCArr[$fiVal]["sID"];
					$gateway = $smsCArr[$fiVal]["gateway"];
					$senderID = $smsCArr[$fiVal]["senderID"];
					$user = $smsCArr[$fiVal]["user"];
					$password = htmlspecialchars_decode($smsCArr[$fiVal]["password"]);
					$api = $smsCArr[$fiVal]["api"];
					$status = $smsCArr[$fiVal]["status"];										
					$status = $onOffArr[$status];
					
					if($sID  >= $fiVal){  /* if current gateway is not empty  */
															
						$balance = fobrainSMSBalance($api, $user, $password, $sID);  /* check text message balance  */ 

$tbHead =<<<IGWEZE

						<!-- row -->
						<div class="row gutters my-20"> 
							
							<div class="col-12">								
								<p class="text-primary"> SMS  Balance Before Sending - $balance</p> 
							</div>	
						</div>	
						<!-- /row -->
							
						<script type='text/javascript'> 
							$('#sms-msg-title').text('Sent SMS Reports and Summary');
							$('#frm-staff-sms').slideUp(1000);  
							renderTable(); 
						</script>
						<div class="table-responsive">
							<!-- table -->
							<table class='table table-hover table-responsive style-table wiz-table' id="wiz-table">					
								<thead>
									<tr>
				
										<th>S/N</th> 
										<th>Staff Infomation</th> 
										<th>Phone Number</th> 
										<th>SMS Reports</th> 
									</tr>
								</thead> 
								<tbody>

IGWEZE;
								
								echo $tbHead; 										

								foreach ($staff_data as $staff_id) {  /* loop array */
									
									$staff_id = trim($staff_id);
									
									
									$staff_info = staffData($conn, $staff_id);  /* school staffs/teachers information */ 
									list ($st_title, $st_fullname, $st_sex, $st_rankingVal, $pic, 
											$st_lname, $receiver) = explode ("#@s@#", $staff_info); 
									
									$staff_img = picture($staff_pic_ext, $pic, "staff");

									if($receiver == ""){  /* if receiver is empty display information message */ 
										
										$reports = '<button type="button" class="btn btn-white"> 
										<i class="fas fa-exclamation-triangle"></i> Message Not Sent </button>';
										$receiver = '<button type="button" class="btn btn-white"> 
										<i class="fas fa-exclamation-triangle"></i> Phone No. Empty </button>';
										
									}else{	
									
										/* send text message through current gateway */ 
										$reports = fobrainSendSMS($api, $senderID, $user, $password, $receiver, $sentMsg, $sID);
									
									}
									
									$serial_no++;

$sendReports =<<<IGWEZE
	
									<tr>
										<td>$serial_no</td> 
										<td>												
											<div class="row align-items-center"> 
												<div class="col text-primary">
													<img src = "$staff_img" class=" img-h-50 img-circle img-thumbnail">
													$st_fullname
												</div>  
											</div>
										</td> 														
										<td>$receiver</td> 												
										<td>$reports</td> 
									
									</tr>
	
IGWEZE;
							
									echo $sendReports;
									
									
								}


								$balanceAF = fobrainSMSBalance($api, $user, $password, $sID);  /* check text message balance  */ 

$tbTail =<<<IGWEZE

									</tbody>
								</table>				
								<!-- / table -->
							</div>		        
	
							<!-- row -->
							<div class="row gutters mt-20 mb-40">
								<div class="col-12">										
									<p class="text-primary"> SMS  Balance After Sending - $balanceAF </p> 
								</div>	
							</div>	
							<!-- /row -->

							<hr class="my-20 text-danger" />

											
IGWEZE;
								
							echo $tbTail;
									
									
									
					}else{  /* display error */ 

						$msg_e = "* Ooops Error, please configure or set your default sms gateway before you can send SMS.";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
									
					}	 		
					
				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				}
	
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit; 
		
			}
		
		}elseif ($_REQUEST['sms'] == 'all-staff') {  /* send SMS to all active staffs  */

			
			$sentMsg = preg_replace("/[^A-Za-z0-9@%?+. ]/", "", $_REQUEST['message']);
			
			$sentMsg = strip_tags($sentMsg);	

			/* script validation */ 
			
			if ($sentMsg == "")  {
				
				$msg_e = "* Ooops Error, please enter  message to send";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
				
			}else {       			


			try {
					
				$smsCArr = smsCurrentGateway($conn);  /* current text message and gateway information */
			
				$sID = $smsCArr[$fiVal]["sID"];
				$gateway = $smsCArr[$fiVal]["gateway"];
				$senderID = $smsCArr[$fiVal]["senderID"];
				$user = $smsCArr[$fiVal]["user"];
				$password = htmlspecialchars_decode($smsCArr[$fiVal]["password"]);
				$api = $smsCArr[$fiVal]["api"];
				$status = $smsCArr[$fiVal]["status"];										
				$status = $onOffArr[$status];
						
				if($sID  >= $fiVal){  /* if current gateway is not empty  */
							
					$ebele_mark = "SELECT t_id, i_title, i_picture, i_firstname, i_lastname, i_midname, t_grade, i_phone

									FROM $staffTB";
							
					$igweze_prep = $conn->prepare($ebele_mark);									 
					$igweze_prep->execute();									
					$rows_count = $igweze_prep->rowCount(); 
					
					if($rows_count >= $foreal) {
					
						$balance = fobrainSMSBalance($api, $user, $password, $sID);  /* check text message balance  */ 

$tbHead =<<<IGWEZE

						<!-- row -->
						<div class="row gutters my-20">
								
							
							<div class="col-12">								
								<p class="text-primary"> SMS  Balance Before Sending - $balance</p> 
							</div>	
						</div>	
						<!-- /row -->
						
						<script type='text/javascript'> 
							$('#sms-msg-title').text('Sent SMS Reports and Summary');
							$('#frm-staff-sms').slideUp(1000);  
							renderTable(); 
						</script>

						<div class="table-responsive">
							<!-- table -->
							<table class='table table-hover table-responsive style-table wiz-table' id="wiz-table">					
								<thead>
									<tr>

										<th>S/N</th> 
										<th>Staff Infomation</th> 
										<th>Phone Number</th> 
										<th>SMS Reports</th> 
									</tr>
								</thead> 
								<tbody>

IGWEZE;
	
							echo $tbHead;
	
							while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
					
								$t_id = $row['t_id'];
								$title = $row['i_title'];
								$pic = $row['i_picture'];
								$fname = trim($row['i_firstname']);
								$lname = trim($row['i_lastname']);
								$mname = trim($row['i_midname']);
								$receiver = trim($row['i_phone']); 

								$titleVal = wizSelectArray($title, $title_list);
								
								$staff_name = "$lname $fname $mname";
								$staff_name = ucwords($staff_name);
								$staff_name = trim($staff_name);
												
								$staff_img = picture($staff_pic_ext, $pic, "staff"); 
									
								if($receiver == ""){  /* if receiver is empty display information message */ 
									
									$reports = '<button type="button" class="btn btn-white"> 
									<i class="fas fa-exclamation-triangle"></i> Message Not Sent </button>';
									$receiver = '<button type="button" class="btn btn-white"> 
									<i class="fas fa-exclamation-triangle"></i> Phone No. Empty </button>';
									
								}else{	
								
									/* send text message through current gateway */ 
									$reports = fobrainSendSMS($api, $senderID, $user, $password, $receiver, $sentMsg, $sID);
								
								}
								
								$serial_no++;

$sendReports =<<<IGWEZE
	
									<tr>
										<td>$serial_no</td> 
										<td>												
											<div class="row align-items-center"> 
												<div class="col text-primary">
													<img src = "$staff_img" class=" img-h-50 img-circle img-thumbnail">
													$st_fullname
												</div>  
											</div>
										</td> 														
										<td>$receiver</td> 												
										<td>$reports</td>  
									</tr>
	
IGWEZE;
							
									echo $sendReports;
									
									
								}
									
								$balanceAF = fobrainSMSBalance($api, $user, $password, $sID);  /* check text message balance  */ 

$tbTail =<<<IGWEZE

									</tbody>
								</table>				
							<!-- / table -->
							</div>		        

							<!-- row -->
							<div class="row gutters mt-20 mb-40">
								<div class="col-12">										
									<p class="text-primary"> SMS  Balance After Sending - $balanceAF </p> 
								</div>	
							</div>	
							<!-- /row -->

							<hr class="my-20 text-danger" />

IGWEZE;
								
							echo $tbTail;
									
					}else{  /* display error */
									
						$msg_e = "Error, staff record was not found";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;		
						
					}	
									
				}else{  /* display error */

					$msg_e = "* Ooops Error, please configure or set your default sms gateway before you can send SMS.";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
									
				}	
								
					
			}catch(PDOException $e) {
		
				fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
			}
	
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
			
		
			}
		
		}else{ 
		
			echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
		
		} 
		
exit;
?>