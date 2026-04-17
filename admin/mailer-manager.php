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
	This script send email to students, parents and staffs
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}
 
		use PHPMailer\PHPMailer\PHPMailer;
		use PHPMailer\PHPMailer\SMTP;
		use PHPMailer\PHPMailer\Exception;

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

		require '../vendor/autoload.php'; 

		if ($_REQUEST['mail'] == 'student') {  /* send Mail to selected parents/students  */

			$sendTo = cleanInt($_REQUEST['sendTo']);			
			$student_data = $_REQUEST['students'];
			$subject = $_REQUEST['subject'];
			$message = $_REQUEST['message']; 
			
			/* script validation */ 				
			
			if ($sendTo == ""){
				
				$msg_e = "* Ooops Error, please selec which people to sent mail to";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
				
			}elseif ($student_data == "")  {
				
				$msg_e = "* Ooops Error, please select student/guardian";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
				
			}elseif ($subject == "")  {
				
				$msg_e = "* Ooops Error, please enter your mail subject";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
				
			}elseif ($message == "")  {
				
				$msg_e = "* Ooops Error, please enter mail message";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
				
			}else {  /* send Mail to selected parents/students  */       			

				try {
					
					$mail_info_arr = mailInfo($conn, $mID = 1);  /* mail information  */ 

					$mID = $mail_info_arr[$fiVal]["mID"];
					$send_host = $mail_info_arr[$fiVal]["send_host"];
					$send_name = $mail_info_arr[$fiVal]["send_name"];
					$send_pass = htmlspecialchars_decode($mail_info_arr[$fiVal]["send_pass"]);
					$send_mail = $mail_info_arr[$fiVal]["send_mail"];
					$footer = htmlspecialchars_decode($mail_info_arr[$fiVal]["footer"]);
					$status = $mail_info_arr[$fiVal]["status"];   

					if(($send_host == "") || ($send_pass == "") || ($send_mail == "") 
					|| ($send_name == ""))	{  /* if stmp server parameters is not empty  */ 


$tbHead =<<<IGWEZE
 	
						<script type='text/javascript'> 
							$('#mail-msg-title').text('Sent Mail Reports and Summary');
							$('#frm-student-mail').slideUp(1000);  
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
										<th>Recp. Mail</th> 
										<th>Mail Reports</th> 
									</tr>
								</thead> 
								<tbody> 
								
IGWEZE;
								
								echo $tbHead;  

								require $fobrainGlobalDir.'/mailer-config.php'; 
								
								$studentArr =  explode(',', $student_data);										

								foreach ($studentArr as $studentInfo) {										
									
									list($student_name, $regNo) = explode("-", $studentInfo);
									$student_name = trim($student_name);
									$regNo = trim($regNo);
									
									$mail_data = studentMailInfo($conn, $regNo);  /* students Mail record information  */ 
									list ($recp_name, $recp_mail, $spoPhone, $student_img) = explode ("@##@", $mail_data);
									
									/*
									if($sendTo == $fiVal){ $receiver = $spoPhone;}
									elseif($sendTo == $seVal){ $receiver = $recp_mail;}
									else{ $receiver = ""; }
									*/ 

									$receiver = $recp_mail;
									
									if($receiver == ""){  /* if receiver is empty display information message */ 
										
										$reports = '<button type="button" class="btn btn-white"> 
										<i class="fas fa-exclamation-triangle"></i> Message Not Sent </button>';
										$receiver = '<button type="button" class="btn btn-white"> 
										<i class="fas fa-exclamation-triangle"></i> Phone No. Empty </button>';
										
									}else{	
										
										/* send email through stmp data */  
										
										try {
											
											$mail->addAddress($recp_mail, $recp_name);     //Add a recipient
											$mail->send();
											//echo "Message sent to: ({$receiver}) {$mail->ErrorInfo}\n";
											$reports = '<button type="button" class="btn btn-white"> 
											<i class="fas fa-check"></i> Sent </button>';

										} catch (Exception $e) {

											$reports = "Mailer Error ({$receiver}) {$mail->ErrorInfo}"; 

										}
										
										$mail->clearAddresses();
									
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
												$recp_name
											</a>    
										</td>  
										<td> $receiver </td> 											
										<td> $reports</td> 
									</tr>
	
IGWEZE;
							
									echo $sendReports;
									
									
								} 

$tbTail =<<<IGWEZE

								</tbody>
							</table>				
							<!-- / table -->
						</div>	 
								 

IGWEZE;
								
						echo $tbTail;

						$mail->smtpClose(); 
									
									
					}else{  /* display error */

						$msg_e = "* Ooops Error, please configure or set your default mail SMTP server before you can send Mail.";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
									
					}	
								
					
				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				}
	
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
			
		
			}
		
		}elseif ($_REQUEST['mail'] == 'student-class') {  /* send Mail to all class parents/students  */

			$sendTo = cleanInt($_REQUEST['sendTo']);			
			$message = $_REQUEST['message'];
			$subject = $_REQUEST['subject'];
			$session = $_REQUEST['sess']; 
			$level = $_REQUEST['level'];
			$class_data = $_REQUEST['class'];

			list ($class, $class_val) = explode ("@+@", $class_data);
			
			$session = strip_tags($session);
			$class = strip_tags($class);
			$level = strip_tags($level); 

			/* script validation */ 
			
			if ($sendTo == ""){
				
				$msg_e = "* Ooops Error, please selec which people to sent mail to";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
				
			}elseif (($session == '') || ($level == '') || ($class == '')) {
			
				$msg_e =  $formErrorMsg;
				
				echo $errorMsg.$msg_e.$eEnd;  
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
			
				
			}elseif ($subject == "") {
				
				$msg_e = "* Ooops Error, please enter your mail subject";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
				
			}elseif ($message == "") {
				
				$msg_e = "* Ooops Error, please enter mail message";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
				
			}else {  /* send Mail to all class parents/students  */       			


				try {
					
					$mail_info_arr = mailInfo($conn, $mID = 1);  /* mail information  */ 
					
					$mID = $mail_info_arr[$fiVal]["mID"];
					$send_host = $mail_info_arr[$fiVal]["send_host"];
					$send_name = $mail_info_arr[$fiVal]["send_name"];
					$send_pass = htmlspecialchars_decode($mail_info_arr[$fiVal]["send_pass"]);
					$send_mail = $mail_info_arr[$fiVal]["send_mail"];
					$footer = htmlspecialchars_decode($mail_info_arr[$fiVal]["footer"]);
					$status = $mail_info_arr[$fiVal]["status"]; 

					require $fobrainGlobalDir.'/mailer-config.php';
							
					if(($send_host == "") || ($send_pass == "") || ($send_mail == "") 
					|| ($send_name == ""))	{  /* if stmp server parameters is not empty  */   
								
						$mClass = studentClassLevel($level);  /* retrieve student class */
						$sessionID = sessionID($conn, $session);  /* school session ID */
						$session_fi = fobrainSession($conn, $sessionID);  /* school session  */
						$session_se = $session_fi + $foreal;
						
						$ebele_mark = "SELECT r.ireg_id, nk_regno, s.stu_id, i_stupic, i_firstname, i_lastname, i_midname,
						i_email, i_spo_phone
	
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

$tbHead =<<<IGWEZE

 
							<script type='text/javascript'> 
								$('#mail-msg-title').text('Sent Mail Reports and Summary');
								$('#frm-student-mail').slideUp(1000);  
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
											<th>Recp. Mail</th> 
											<th>Mail Reports</th> 
										</tr>
									</thead> 
									<tbody> 
IGWEZE;
								
									echo $tbHead;
									
									while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
							
										$regNo = $row['nk_regno'];
										$ID = $row['ireg_id'];
										$pic = $row['i_stupic'];
										$fname = trim($row['i_firstname']);
										$lname = trim($row['i_lastname']);
										$mname = trim($row['i_midname']);
										$recp_mail = trim($row['i_email']);
										$spoPhone = trim($row['i_spo_phone']);
									 
										
										$student_name = "$lname $fname $mname";
										$student_name = ucwords($student_name);
										$student_name = trim($student_name);
										$regNo = trim($regNo);   
											
										$student_img = picture($school_pic_dir.$session_fi.'_'.$session_se.'/', $pic, "student"); 
										
										$serial_no++;
										
										/*
										if($sendTo == $fiVal){ $receiver = $spoPhone;}
										elseif($sendTo == $seVal){ $receiver = $recp_mail;}
										else{ $receiver = ""; }
										*/

										$receiver = $recp_mail;
										
										if($receiver == ""){  /* if receiver is empty display information message */
											
											$reports = '<button type="button" class="btn btn-white"> 
											<i class="fas fa-exclamation-triangle"></i> Message Not Sent </button>';
											$receiver = '<button type="button" class="btn btn-white"> 
											<i class="fas fa-exclamation-triangle"></i> Phone No. Empty </button>';
											
										}else{ 	
											
											/* send email through stmp data */  
										
											try {
												
												$mail->addAddress($recp_mail, $recp_name);     //Add a recipient
												$mail->send();
												//echo "Message sent to: ({$receiver}) {$mail->ErrorInfo}\n";
												$reports = '<button type="button" class="btn btn-white"> 
												<i class="fas fa-check"></i> Sent </button>';

											} catch (Exception $e) {

												$reports = "Mailer Error ({$receiver}) {$mail->ErrorInfo}"; 

											}
											
											$mail->clearAddresses();
											
										
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
									 

$tbTail =<<<IGWEZE

				
											</tbody>
										</table>				
										<!-- / table -->
									</div>	

IGWEZE;
								
							echo $tbTail;
							$mail->smtpClose();
									
						}else{  /* display error */ 
									
							$msg_e = "Error, no record was found for <span>
							$session - $session_se session $classLevel $class</span>";
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;											
						}	
									
					}else{  /* display error */ 

						$msg_e = "* Ooops Error, please configure or set your default mail SMTP server before you can send Mail.";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
									
					}	
								
					
				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				}
	
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
			
		
			}
		
		}elseif ($_REQUEST['mail'] == 'some-staff') {  /* send Mail to selected staffs  */ 
						
			$staff_data = $_REQUEST['staffs'];
			$message = $_REQUEST['message'];
			$subject = $_REQUEST['subject']; 
			
			/* script validation */ 	
			
			if (is_array($staff_data)){

				$count_staff =  count($staff_data);

			}else{ $count_staff = 0; }
			
			if ((!is_array($staff_data)) || ($count_staff < 1))  {
				
				$msg_e = "* Ooops Error, please select staff/s";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
				
			}elseif ($subject == "")  {
				
				$msg_e = "* Ooops Error, please enter your mail subject";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
				
			}elseif ($message == "")  {
				
				$msg_e = "* Ooops Error, please enter mail message";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
				
			}else {       			

				try {
					
					$mail_info_arr = mailInfo($conn, $mID = 1);  /* mail information  */ 
	
					$mID = $mail_info_arr[$fiVal]["mID"];
					$send_host = $mail_info_arr[$fiVal]["send_host"];
					$send_name = $mail_info_arr[$fiVal]["send_name"];
					$send_pass = htmlspecialchars_decode($mail_info_arr[$fiVal]["send_pass"]);
					$send_mail = $mail_info_arr[$fiVal]["send_mail"];
					$footer = htmlspecialchars_decode($mail_info_arr[$fiVal]["footer"]);
					$status = $mail_info_arr[$fiVal]["status"]; 

					require $fobrainGlobalDir.'/mailer-config.php';
					
					if(($send_host == "") || ($send_pass == "") || ($send_mail == "") 
					|| ($send_name == ""))	{  /* if stmp server parameters is not empty  */   
															
						 
$tbHead =<<<IGWEZE

						<script type='text/javascript'> 
							$('#mail-msg-title').text('Sent Mail Reports and Summary');
							$('#frm-staff-mail').slideUp(1000);  
							renderTable(); 
						</script>
						<div class="table-responsive">
							<!-- table -->
							<table class='table table-hover table-responsive style-table wiz-table' id="wiz-table">					
								<thead>
									<tr>
				
										<th>S/N</th> 
										<th>Staff Infomation</th> 
										<th>Email Recp.</th> 
										<th>Mail Reports</th> 
									</tr>
								</thead> 
								<tbody>

IGWEZE;
								
								echo $tbHead; 										

								foreach ($staff_data as $staff_id) {  /* loop array */
									
									$staff_id = trim($staff_id); 
									
									$staff_info = staffData($conn, $staff_id);  /* school staffs/teachers information */ 
									list ($st_title, $st_fullname, $st_sex, $st_rankingVal, $pic, 
											$st_lname, $phone, $signature, $receiver) = explode ("#@s@#", $staff_info); 
									
									$staff_img = picture($staff_pic_ext, $pic, "staff");

									if($receiver == ""){  /* if receiver is empty display information message */ 
										
										$reports = '<button type="button" class="btn btn-white"> 
										<i class="fas fa-exclamation-triangle"></i> Message Not Sent </button>';
										$receiver = '<button type="button" class="btn btn-white"> 
										<i class="fas fa-exclamation-triangle"></i> Phone No. Empty </button>';
										
									}else{	
									
										/* send email through stmp data */  
										
										try {
											
											$mail->addAddress($recp_mail, $recp_name);     //Add a recipient
											$mail->send();
											//echo "Message sent to: ({$receiver}) {$mail->ErrorInfo}\n";
											$reports = '<button type="button" class="btn btn-white"> 
											<i class="fas fa-check"></i> Sent </button>';

										} catch (Exception $e) {

											$reports = "Mailer Error ({$receiver}) {$mail->ErrorInfo}"; 

										}
										
										$mail->clearAddresses();
									
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

$tbTail =<<<IGWEZE

									</tbody>
								</table>				
								<!-- / table -->
							</div> 
											
IGWEZE;
								
						echo $tbTail;
						$mail->smtpClose();   
									
					}else{  /* display error */ 

						$msg_e = "* Ooops Error, please configure or set your default mail SMTP server before you can send Mail.";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
									
					}	 		
					
				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				}
	
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit; 
		
			}
		
		}elseif ($_REQUEST['mail'] == 'all-staff') {  /* send Mail to all active staffs  */ 
			
			$message = $_REQUEST['message']; 
			$subject = $_REQUEST['subject'];	

			/* script validation */ 
			
			if ($subject == "")  {
				
				$msg_e = "* Ooops Error, please enter your mail subject";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
				
			}elseif ($message == "")  {
				
				$msg_e = "* Ooops Error, please enter mail message";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
				
			}else {       			


				try {
						
					$mail_info_arr = mailInfo($conn, $mID = 1);  /* mail information  */ 
		
					$mID = $mail_info_arr[$fiVal]["mID"];
					$send_host = $mail_info_arr[$fiVal]["send_host"];
					$send_name = $mail_info_arr[$fiVal]["send_name"];
					$send_pass = htmlspecialchars_decode($mail_info_arr[$fiVal]["send_pass"]);
					$send_mail = $mail_info_arr[$fiVal]["send_mail"];
					$footer = htmlspecialchars_decode($mail_info_arr[$fiVal]["footer"]);
					$status = $mail_info_arr[$fiVal]["status"]; 
							
					if(($send_host == "") || ($send_pass == "") || ($send_mail == "") 
					|| ($send_name == ""))	{  /* if stmp server parameters is not empty  */   
								
						$ebele_mark = "SELECT t_id, i_title, i_picture, i_firstname, i_lastname, i_midname, t_grade, i_email

										FROM $staffTB";
								
						$igweze_prep = $conn->prepare($ebele_mark);									 
						$igweze_prep->execute();									
						$rows_count = $igweze_prep->rowCount(); 
						
						if($rows_count >= $foreal) {

$tbHead =<<<IGWEZE

							<script type='text/javascript'> 
								$('#mail-msg-title').text('Sent Mail Reports and Summary');
								$('#frm-staff-mail').slideUp(1000);  
								renderTable(); 
							</script>

							<div class="table-responsive">
								<!-- table -->
								<table class='table table-hover table-responsive style-table wiz-table' id="wiz-table">					
									<thead>
										<tr>
											<th>S/N</th> 
											<th>Staff Infomation</th> 
											<th>Email Recp.</th> 
											<th>Mail Reports</th> 
										</tr>
									</thead> 
									<tbody>

IGWEZE;
	
							echo $tbHead;

							require $fobrainGlobalDir.'/mailer-config.php';
	
							while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
					
								$t_id = $row['t_id'];
								$title = $row['i_title'];
								$pic = $row['i_picture'];
								$fname = trim($row['i_firstname']);
								$lname = trim($row['i_lastname']);
								$mname = trim($row['i_midname']);
								$receiver = trim($row['i_email']);  

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
								
									/* send email through stmp data */  
										
									try {
											
										$mail->addAddress($recp_mail, $recp_name);     //Add a recipient
										$mail->send();
										//echo "Message sent to: ({$receiver}) {$mail->ErrorInfo}\n";
										$reports = '<button type="button" class="btn btn-white"> 
										<i class="fas fa-check"></i> Sent </button>';

									} catch (Exception $e) {

										$reports = "Mailer Error ({$receiver}) {$mail->ErrorInfo}"; 

									}
									
									$mail->clearAddresses();
								
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
							

$tbTail =<<<IGWEZE

									</tbody>
								</table>				
							<!-- / table -->
							</div>

IGWEZE;
								
						echo $tbTail;
						$mail->smtpClose(); 
									
					}else{  /* display error */
									
						$msg_e = "Error, staff record was not found";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;		
						
					}	
									
				}else{  /* display error */

					$msg_e = "* Ooops Error, please configure or set your default mail SMTP server before you can send Mail.";
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