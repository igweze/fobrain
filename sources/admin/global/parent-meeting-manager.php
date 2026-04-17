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
	This script handle student parent meeting
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

			if (!defined('fobrain'))

			die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');	 
 
			if ($_REQUEST['parmeeting'] == 'save') {  /* save parent meeting */
				
				$session = cleanInt($_REQUEST['sess']);
				$level = cleanInt($_REQUEST['level']);
				$eType = cleanInt($_REQUEST['eType']);
				//$class = clean($_REQUEST['class']);
				$eTitle =  clean($_REQUEST['eTitle']);
				$allow = clean($_REQUEST['allow']);
				$eTime = cleanInt($_REQUEST['eTime']);
				$sTime = clean($_REQUEST['sTime']);
				$staffs = $_REQUEST['staffs'];
				$class_data = clean($_REQUEST['class']);
				
				//$status = cleanInt($_REQUEST['status']);
				//$eDetail = $_REQUEST['eDetail']; 		
				
				list ($class, $class_val) = explode ("@+@", $class_data); 
				
				/* script validation */
				
				if ($eTitle == "")  {
         			
					$msg_e = "* Ooops Error, please enter title";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
					
	   			}elseif ($eType == "")  {
         			
					$msg_e = "* Ooops Error, please select meeting Participant";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
					
	   			}elseif ($allow == "")  {
         			
					$msg_e = "* Ooops Error, please select if staffs can join the meeting";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
					
	   			}elseif (($eType == $seVal) && ($session == ""))  {
         			
					$msg_e = "* Ooops Error, please select target class";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
					
	   			}elseif (($eType == $seVal) && ($level == ""))  {
         			
					$msg_e = "* Ooops Error, please enter target level";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
					
	   			}elseif (($eType == $seVal) && ($class == ""))  {
         			
					$msg_e = "* Ooops Error, please select target  class";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
					
	   			}elseif ($eTime == "")  {
         			
					$msg_e = "* Ooops Error, please enter parent meeting duration";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
					
	   			}elseif ($sTime == "")  {
         			
					$msg_e = "* Ooops Error, please enter parent meeting start time";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
					
	   			}
				/*elseif ($eDetail == "")  {
         			
					$msg_e = "* Ooops Error, please enter parent meeting instruction";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   hidePageLoader();  /* hide page loader * / </script>";exit;
					
	   			}
				
				*/
				else {  /* update information */        			
				
					$sessionID = sessionID($conn, $session);  /* school session ID */ 
					$meetid = 'fobrain-'.strtotime(date("Y-m-d H:i:s"));	 
					$ctime = date("Y-m-d H:i:s"); 
					$status = 1;
					

					//$eDetail = strip_tags($eDetail);
					//$eDetail = str_replace('<br />', "\n", $eDetail);
					//$eDetail = htmlspecialchars($eDetail);	
					$eDetail = "";	 
					$eSubject = "";

					if($allow == 0){ $staffs = "";}
					else{$staffs = serialize($staffs);}

					if ($eType == $seVal){

						list ($session_val, $level_key, $level_val) = explode ("#@@#", clean($_REQUEST['sesslevel']));

						$class_data = $session_val."#@@#".$level_val."#@@#".$class_val;

					}

		 			try { 
						
						if ($admin_grade == $cm_fobrain_grd) {    /* check admin grade */ 
						
							$eGrade = $seVal;
						
						}else{
							
							$eGrade = $fiVal;
							
						}	
						
						$ebele_mark = "INSERT INTO $fobrainParentMeetingTB  (meetid, school, info, session, level, class, eType, allow, eTitle, eSubject, eTime, cTime, sTime, eDetail, eGrade, eStaff, staffs, status)

																	VALUES (:meetid, :school, :info, :session, :level, :class, :eType, :allow, :eTitle, :eSubject, 
																	:eTime, :cTime, :sTime, :eDetail, :eGrade, :eStaff, :staffs, :status)";
					 
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':meetid', $meetid);
						$igweze_prep->bindValue(':school', $schoolID);
						$igweze_prep->bindValue(':info', $class_data);
						$igweze_prep->bindValue(':session', $sessionID);
						$igweze_prep->bindValue(':level', $level);
						$igweze_prep->bindValue(':class', $class);
						$igweze_prep->bindValue(':eType', $eType);
						$igweze_prep->bindValue(':allow', $allow);
						$igweze_prep->bindValue(':eTitle', $eTitle);
						$igweze_prep->bindValue(':eSubject', $eSubject);
						$igweze_prep->bindValue(':eTime', $eTime);
						$igweze_prep->bindValue(':cTime', $ctime);
						$igweze_prep->bindValue(':sTime', $sTime);
						$igweze_prep->bindValue(':eDetail', $eDetail);
						$igweze_prep->bindValue(':eGrade', $eGrade);
						$igweze_prep->bindValue(':eStaff', $_SESSION['adminID']);
						$igweze_prep->bindValue(':staffs', $staffs);
						$igweze_prep->bindValue(':status', $status);
						
						
						if($igweze_prep->execute()){  /* if sucessfully */    

							$msg_s = "Parent Live Meeting information was successfully saved."; 
							echo $succesMsg.$msg_s.$sEnd; 
							echo "<script type='text/javascript'> 
									$('#load-wiz-info').load('parent-meeting-info.php'); 
									//$('#frmsaveParentMeeting').slideUp(1500); 
									$('#modal-fobrain').modal('hide');
							 		hidePageLoader();  
							</script>";exit;
							
						}else{  /* display error */ 
				
							$msg_e =  "Ooops, an error has occur while to create new Parent Live Meeting. Please try again";
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
							
						}
						

				 	}catch(PDOException $e) {
  			
						fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					}
		 
        	
				}
			
			}elseif ($_REQUEST['parmeeting'] == 'update') {  /* update parent meeting */

				$cid = cleanInt($_REQUEST['cid']);			 
				$session = cleanInt($_REQUEST['sess']);
				$level = cleanInt($_REQUEST['level']);
				$eType = cleanInt($_REQUEST['eType']);
				//$class = clean($_REQUEST['class']);
				$eTitle =  clean($_REQUEST['eTitle']);
				$allow = clean($_REQUEST['allow']);
				$eTime = cleanInt($_REQUEST['eTime']);
				$sTime = clean($_REQUEST['sTime']);
				$staffs = $_REQUEST['staffs'];
				$status = cleanInt($_REQUEST['status']);
				$class_data = clean($_REQUEST['class']);				
				 
				//$eDetail = $_REQUEST['eDetail']; 		
				
				list ($class, $class_val) = explode ("@+@", $class_data); 
				
				/* script validation */ 
								
				if ($cid == ""){
         			
					$msg_e = "* Ooops, an error has occur to retrieve parent meeting information. Please try again";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
					
	   			}elseif ($eTitle == "")  {
         			
					$msg_e = "* Ooops Error, please enter title";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
					
	   			}elseif ($eType == "")  {
         			
					$msg_e = "* Ooops Error, please select meeting Participant";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
					
	   			}elseif ($allow == "")  {
         			
					$msg_e = "* Ooops Error, please select if staffs can join the meeting";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
					
	   			}elseif (($eType == $seVal) && ($session == ""))  {
         			
					$msg_e = "* Ooops Error, please select target class";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
					
	   			}elseif (($eType == $seVal) && ($level == ""))  {
         			
					$msg_e = "* Ooops Error, please enter target level";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
					
	   			}elseif (($eType == $seVal) && ($class == ""))  {
         			
					$msg_e = "* Ooops Error, please select target  class";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
					
	   			}elseif ($eTime == "")  {
         			
					$msg_e = "* Ooops Error, please enter parent meeting duration";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
					
	   			}elseif ($sTime == "")  {
         			
					$msg_e = "* Ooops Error, please enter parent meeting start time";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
					
	   			}elseif ($status == "")  {
         			
					$msg_e = "* Ooops Error, please enter parent meeting status";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
					
	   			}
				
				/*
				elseif ($eDetail == "")  {
         			
					$msg_e = "* Ooops Error, please enter parent meeting instruction";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
					
	   			}
				*/
				
				else {  /* update information */       			
				
					$sessionID = sessionID($conn, $session);  /* school session ID */
					/*
					$eDetail = strip_tags($eDetail);
					$eDetail = str_replace('<br />', "\n", $eDetail);
					$eDetail = htmlspecialchars($eDetail); 
					*/
					$eDetail = ""; 
					$eSubject = "";
					if($allow == 0){ $staffs = "";}
					else{$staffs = serialize($staffs);}

					if ($eType == $seVal){

						list ($session_val, $level_key, $level_val) = explode ("#@@#", clean($_REQUEST['sesslevel']));

						$class_data = $session_val."#@@#".$level_val."#@@#".$class_val;

					} 

		 			try { 
						
						$ebele_mark = "UPDATE $fobrainParentMeetingTB  
											
											SET 
											
											school = :school,
											info = :info,
											session = :session, 
											level = :level,
											class = :class,
											eType = :eType,
											allow = :allow,	
											eTitle = :eTitle,
											eSubject = :eSubject,
											eTime = :eTime,
											sTime = :sTime,
											eDetail = :eDetail,
											staffs = :staffs,
											status = :status
											
											
										WHERE cid = :cid";
					 
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':cid', $cid);
						$igweze_prep->bindValue(':school', $schoolID);
						$igweze_prep->bindValue(':info', $class_data);
						$igweze_prep->bindValue(':session', $sessionID);
						$igweze_prep->bindValue(':level', $level);
						$igweze_prep->bindValue(':class', $class);
						$igweze_prep->bindValue(':eType', $eType);
						$igweze_prep->bindValue(':allow', $allow);
						$igweze_prep->bindValue(':eTitle', $eTitle);
						$igweze_prep->bindValue(':eSubject', $eSubject);
						$igweze_prep->bindValue(':eTime', $eTime);
						$igweze_prep->bindValue(':sTime', $sTime);
						$igweze_prep->bindValue(':eDetail', $eDetail); 
						$igweze_prep->bindValue(':staffs', $staffs);
						$igweze_prep->bindValue(':status', $status);
						
						if($igweze_prep->execute()){  /* if sucessfully */
							
							$msg_s = "Parent Live Meeting information was successfully saved."; 
							echo $succesMsg.$msg_s.$sEnd; 
							echo "<script type='text/javascript'> 
									$('#load-wiz-info').load('parent-meeting-info.php'); 
									//$('#frmupdateParentMeeting').slideUp(1500);
									$('#modal-fobrain').modal('hide');
							 		hidePageLoader();  
							</script>";exit;
							
						}else{  /* display error */ 
				
							$msg_e =  "Ooops, an error has occur while to save Parent Live Meeting. Please try again";
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
							
						}
						

				 	}catch(PDOException $e) {
  			
						fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					}          		
        	
				}
			
			}elseif ($_REQUEST['parmeeting'] == 'view') {  /* view parent meeting */ 
				
				$cid = strip_tags($_REQUEST['eData']);
				$i = $fiVal;
				
				if ($cid == ""){
         			
					$msg_e = "* Ooops, an error has occur while to retrieve parent meeting information. Please try again";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
					
	   			}else {  


		 			try {
						
						
						$parentMeetingInfoArr = parentMeetingInfo($conn, $cid);  /* online student parent meeting information */
						 
						$meetid = $parentMeetingInfoArr[$i]["meetid"];
						$school = $parentMeetingInfoArr[$i]["school"];
						$info = $parentMeetingInfoArr[$i]["info"];
						$participant = $parentMeetingInfoArr[$i]["participant"];
						$sessionID = $parentMeetingInfoArr[$i]["session"];
						$level = $parentMeetingInfoArr[$i]["level"];
						$eType = $parentMeetingInfoArr[$i]["eType"];
						$allow = $parentMeetingInfoArr[$i]["allow"];
						$staffs = unserialize($parentMeetingInfoArr[$i]["staffs"]);
						$eStaff = $parentMeetingInfoArr[$i]["eStaff"]; 
						$class = $parentMeetingInfoArr[$i]["class"];
						$eTitle = $parentMeetingInfoArr[$i]["eTitle"];
						$eSubject = $parentMeetingInfoArr[$i]["eSubject"];
						$eDetail = htmlspecialchars_decode($parentMeetingInfoArr[$i]["eDetail"]);
						$eTime = $parentMeetingInfoArr[$i]["eTime"];
						$sTime = $parentMeetingInfoArr[$i]["sTime"];
						$cTime = $parentMeetingInfoArr[$i]["cTime"];
						$status = $parentMeetingInfoArr[$i]["status"];   
						 

						$e_status = wizSelectArray($eType, $pmeeting_list);
						$allow_status = wizSelectArray($allow, $meeting_allow_list);
						$live_status = wizSelectArray($status, $live_meeting_list);  
						$school_m = wizSelectArray($school, $school_list);
 

						if($eType == $fiVal){
							$meet_tar = $e_status;
						}else{

							list ($session_val, $class_level, $class) = explode ("#@@#", $info);
							$sessionS = ($session_val + $fiVal);
							$meet_tar = "$class_level ($class) - ($session_val - $sessionS Session)"; 
						}

						$sub_staff = staffData($conn, $eStaff);  /* school staffs/teachers information */ 
						list ($title, $st_fullname, $st_sex, $st_rank, $pic, 
								$st_lname) = explode ("#@s@#", $sub_staff); 

						$titleVal = wizSelectArray($title, $title_list);
						
						$staffs_name = $titleVal.' '.$st_fullname;
						
						if($allow == $fiVal){

							$staffs_allow  = ""; $staffs_v = "";

							if(is_array($staffs)){  /* check if array */  
	
								foreach($staffs as $staffID){  /* loop array */
			
									$sub_staff = staffData($conn, $staffID);  /* school staffs/teachers information */ 
									list ($title, $st_fullname, $st_sex, $st_rank, $st_picture, 
										  $st_lname) = explode ("#@s@#", $sub_staff); 
			
									$titleVal = wizSelectArray($title, $title_list);
									
									$staffs_v = $titleVal.' '.$st_fullname;
									
									if($sub_staff != ''){
										
										$staffs_allow .=  $staffs_v .' / ';	
									
									} 
			
								}
								
								$staffs_allow = rtrim($staffs_allow ,' / ');

								$show_staffs = "<tr>
													<th>
														Staffs 
													</th> 
													<td>
														$staffs_allow
													</td> 
												</tr> ";
			
							}else{
			
								$staffs_allow = ' - ';
								$show_staffs = "";
			
							} 
						}else{$show_staffs = "";}

						//$eDetail = nl2br($eDetail);
						
						/*<tr><th>
							<i class="fa fa-sort-alpha-asc"></i> ParentMeeting Details </td> <td>
							$eDetail</td> </tr>
						*/	
						

$showParentMeeting =<<<IGWEZE
							 

						<div id = 'fobrain-print'>

							<!-- table -->	
							<table  class="table table-view table-hover"> 
								
								<tr><th>
									 Title </th> <td>
								$eTitle</td> </tr>
								
								<tr><th>
									 Host </th> <td>
								$staffs_name (HM)</td> </tr>

								<tr><th>
									 School </th> <td>
								$school_m </td> </tr>
								
								<tr><th>
								  Participant</th> <td>
								$meet_tar </td> </tr> 

								<tr><th>
								  Staff Allow</th> <td>
								$allow_status </td> </tr> 

								$show_staffs
								
								<tr><th>
									Duration </th> <td>
								$eTime Minutes</td> </tr>  

								<tr><th>
									Created </th> <td>
								$cTime  </td> </tr> 
								
								<tr><th>
									Start</th> <td>
								$sTime  </td> </tr> 

								<tr><th>
									Status</th> <td>
								$live_status </td> </tr> 
								
							</table>
							<!-- / table --> 
						</div>
		
IGWEZE;
				
						echo $showParentMeeting; 
						echo "<script type='text/javascript'>  hidePageLoader(); </script>"; exit; 
						

				 	}catch(PDOException $e) {
  			
						fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					} 
        	
				}
			
			}elseif ($_REQUEST['parmeeting'] == 'remove') {  /* remove school parmeeting */

				
				$parmeeting = $_REQUEST['eData'];
				
				list($fobrainIg, $cid, $hName) = explode("-", $parmeeting);			
				
				/* script validation */ 
				
				if (($parmeeting == "")  || ($cid == "")){
         			
					$msg_e = "* Ooops, an error has occur while to remove parent meeting. Please try again";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
					
	   			}else {  /* remove information */       			


		 			try { 
						
						$ebele_mark = "DELETE FROM $fobrainParentMeetingTB 
										
										WHERE cid = :cid
										
										LIMIT 1";
					 
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':cid', $cid); 
						
						if($igweze_prep->execute()){  /* if sucessfully */
							
							$removeDiv = "$('#row-".$cid."').fadeOut(1000);";
							$msg_s = "<strong>$hName</strong> was successfully removed"; 
							echo $succesMsg.$msg_s.$sEnd; 
							echo "<script type='text/javascript'>   
								$('#modal-load-div').fadeOut(3000); 
								$removeDiv 
								hidePageLoader();
							</script>";exit;
							
						}else{  /* display error */
				
							$msg_e =  "Ooops, an error has occur while to remove parent meeting. Please try again";
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
							
						}
						

				 	}catch(PDOException $e) {
  			
						fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					} 
        	
				}
			
			}elseif ($_REQUEST['parmeeting'] == 'edit') {  /* edit parent meeting */ 
				
				$cid = strip_tags($_REQUEST['eData']);
				
				/* script validation */
				
				if ($cid == ""){
         			
					$msg_e = "* Ooops, an error has occur while to retrieve parent meeting information. Please try again";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
					
	   			}else {       	 

		 			try {						
							
						$parentMeetingInfoArr = parentMeetingInfo($conn, $cid);  /* online student parent meeting information */ 
						$sessionID = $parentMeetingInfoArr[$fiVal]["session"];
						$level = $parentMeetingInfoArr[$fiVal]["level"];
						$class = $parentMeetingInfoArr[$fiVal]["class"];
						$eType = $parentMeetingInfoArr[$fiVal]["eType"];
						$allow = $parentMeetingInfoArr[$fiVal]["allow"];
						$staffs = unserialize($parentMeetingInfoArr[$fiVal]["staffs"]);
						$eTitle = $parentMeetingInfoArr[$fiVal]["eTitle"];
						$eSubject = $parentMeetingInfoArr[$fiVal]["eSubject"];
						$eTime = $parentMeetingInfoArr[$fiVal]["eTime"];
						$sTime = $parentMeetingInfoArr[$fiVal]["sTime"];
						$status = $parentMeetingInfoArr[$fiVal]["status"];
						//$eDetail = htmlspecialchars_decode($parentMeetingInfoArr[$fiVal]["eDetail"]);	
						
						  
?>
						<!-- form -->
						<form class="form-horizontal" id="frmupdateParentMeeting" role="form">
							
							<!-- row -->
							<div class="row gutters">
								<div class="col-lg-12">										
									<!-- field wrapper start -->
									<div class="field-wrapper">	
										<input type="text"  id="eTitle" name="eTitle" 
										class="form-control" placeholder="Enter  Title" value="<?php echo $eTitle; ?>">
										<div class="field-placeholder">  Title <span class="text-danger">*</span></div>
									</div>
									<!-- field wrapper end -->
								</div>
							</div>

							<!-- row -->
							<div class="row gutters">
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">										
									<!-- field wrapper start -->
									<div class="field-wrapper select-wrapper">
										<select class="form-control fob-select"  id="par-meet-type" name="eType" required> 
										<option value = "">Please select One</option>  
										<?php 

											foreach($pmeeting_list as $meet_key => $meet_value){  /* loop array */

												if ($eType == $meet_key){
													$selected = "SELECTED";
												} else {
													$selected = "";
												}

												echo '<option value="'.$meet_key.'"'.$selected.'>'.$meet_value.'</option>' ."\r\n";

											}

										?> 											
										
										</select>
										<div class="icon-wrap"  id="wait" style="display: none;">
											<i class="loader"></i>
										</div>
										<input type="hidden" value="update" name = "parmeeting"/>
										<input type="hidden" value="<?php echo $class; ?>" 
										name = "euData" id="euData"/>
										<input type="hidden" name="cid" value="<?php echo $cid; ?>"/>											  
										<div class="field-placeholder"> Participant  <span class="text-danger">*</span></div>
									</div>
									<!-- field wrapper end -->
								</div>	
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">										
									<!-- field wrapper start -->
									<div class="field-wrapper select-wrapper">
										<select class="form-control fob-select"  id="allow-staff" name="allow" required>
										
											<option value = "">Please select One</option>
											<?php  

												foreach($meeting_allow_list as $allow_key => $allow_value){    /* loop array */

													if ($allow == $allow_key){
														$selected = "SELECTED";
													} else {
														$selected = "";
													}

													echo '<option value="'.$allow_key.'"'.$selected.'>'.$allow_value.'</option>' ."\r\n";

												}

											?> 							
										</select>
										<div class="icon-wrap"  id="wait_a" style="display: none;">
											<i class="loader"></i>
										</div>
																	
										<div class="field-placeholder">  Allow Staffs <span class="text-danger">*</span></div>
									</div>
									<!-- field wrapper end -->
								</div>									 
							</div>	
							<!-- /row -->
 
							<span id="result" style="display: none;"></span><!-- loading div -->
							<span id="result_a" style="display: none;"></span><!-- loading div --> 	 

							<!-- row -->
							<div class="row gutters"  id="show_class_meet">
								<div class="col-12">										
									<!-- field wrapper start -->
									<div class="field-wrapper select-wrapper"> 
										<select class="form-control fob-select"  id="meetingLevel" name="meetingLevel">
											<option value = "">Please select One</option>
											<?php  
											
												try {
													
													$session = fobrainSession($conn, $sessionID); /* school session  */
													$passData = trim($session.'#@@#'.$level);
														
													schoolSessionPassData($conn, $passData); /* school session  */
													
											
												}catch(PDOException $e) {
					
													fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
						
												} 
											?> 
										</select>
										<div class="icon-wrap"  id="wait_1" style="display: none;">
											<i class="loader"></i>
										</div>
										<input type="hidden" name ="classAll" id="classAll" value="<?php echo $fiVal; ?>" />
										<div class="field-placeholder"> Level <span class="text-danger">*</span></div>
									</div>
									<!-- field wrapper end -->
								</div>									 
							</div>	
							<!-- /row -->  

							<span id="result_1" style="display: none;"></span><!-- loading div -->  

							<div class="col-lg-12 display-nonea" id="show_staff_div">
								<!-- field wrapper start -->
								<div class="field-wrapper">	
									<select class="form-control wiz-select"  id="staffs" name="staffs[]" multiple placeholder="Select Staff..." autocomplete="off">
									<option value = "">Search . . .</option>
									<?php  
										try{
												
											$staff_arr = staffArrays($conn);  /* school staffs/teachers token information */

											if($staffs != ""){  /* check is staff is empty */	  
											
												echo staffSelectBox($conn, $staff_arr, $staffs, true);  
											
											}else{

												echo staffSelectBox($conn, $staff_arr, "none", false);  

											}	 
											
										}catch(PDOException $e) {				
											fobrainDie( 'Ooops Database Error: ' . $e->getMessage());													
										}	
									?>	
									</select>

									<div class="field-placeholder"> Select Staffs <span class="text-danger">*</span></div>
								</div>
								<!-- field wrapper end -->
							</div>
						
							<!-- row -->
							<div class="row gutters">
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">										
									<!-- field wrapper start -->
									<div class="field-wrapper"> 
										<input type="number"  id="eTime" name="eTime" 
										class="form-control" placeholder="60" maxlength="3" value="<?php echo $eTime; ?>" required>
										<div class="field-placeholder"> Duration <span class="text-danger">*</span></div>
										<div class="form-text text-danger fw-500">
											In Minutes eg 10, 20
										</div>
									</div>
									<!-- field wrapper end -->
								</div>
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">	
									<!-- field wrapper start -->
									<div class="field-wrapper">										 
										<input type="text" class="form-control" placeholder="Class Start Time" 
										name="sTime"  id="sTime" value="<?php echo $sTime; ?>" required>
										<div class="field-placeholder"> Start Time  <span class="text-danger">*</span></div>
									</div>
									<!-- field wrapper end --> 
								</div>									 
							</div>	
							<!-- /row -->

							<!-- row -->
							<div class="row gutters"> 							 
								<div class="col-12">	
									<!-- field wrapper start -->
									<div class="field-wrapper">			
										<select class="form-control fob-select"  name="status" id="status" required> 
		
											<?php

											foreach($live_meeting_status as $status_key => $status_value){  /* loop array */

												if ($status == $status_key){
													$selected = "SELECTED";
												} else {
													$selected = "";
												}

												echo '<option value="'.$status_key.'"'.$selected.'>'.$status_value.'</option>' ."\r\n";

											}	     	
											?> 

										</select>

										<div class="field-placeholder"> Status <span class="text-danger">*</span></div>													
									</div>
									<!-- field wrapper end -->	 
								</div> 	 										 
							</div>	
							<!-- /row -->
							
							<!--

							<div class="form-group">
								<label for="eDetail" class="col-lg-4 col-sm-4 control-label"> * ParentMeeting Instruction/s</label>
								
								<div class="col-lg-8">
								
									<textarea rows="4" cols="10" class="form-control" name="eDetail" id="eDetail" 
									placeholder="Enter ParentMeeting Instructions"><?php echo $eDetail; ?></textarea>
									
									</div>
								</div>		
					
							--> 
							 

							<hr class="mt-30 mb-15 text-danger" />
							<!-- row -->
							<div class="row gutters modal-btn-footer">
								<div class="col-6 text-start">
									<button type="button" id="close-modal" class="btn btn-danger close-modal" 
									data-bs-dismiss="modal"> <i class="mdi mdi-window-close label-icon"></i> Close</button>
								</div>
								<div class="col-6 text-end">
									<input type="hidden" name="cid" value="<?php echo $cid; ?>" />
									<button type="submit" class="btn btn-primary waves-effect   
									btn-label waves-light" id="updateParentMeeting">
										<i class="mdi mdi-content-save label-icon"></i>  Save
									</button>
								</div>
							</div>	
							<!-- /row --> 
								
						</form>  
						<!-- / form -->	 

						<script type='text/javascript'>  

							$('#meetingLevel, #par-meet-type, #allow-staff').change();  

							hidePageLoader();

							$(function() {
								$('input[name="sTime"]').daterangepicker({ 
								
									"singleDatePicker": true,
									"timePicker": true,
									"autoApply": true,
									"drops": "auto",
									"minYear": 2010,
									"maxYear": parseInt(moment().format('YYYY'),10),
									"locale": {
										format: 'YYYY-MM-DD hh:mm A'
									},
									"showDropdowns": true,

								});
							});
							 
						  
							$('.fob-select').each(function() {  
								renderSelect($('#'+this.id)); 
							}); 
							renderSelectImg("#staffs", 10); 
							 
						</script>							
				<?php								
						
						 exit;						
															
				 	}catch(PDOException $e) {
  			
						fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					}		 
        	
				}
			
			}elseif ($_REQUEST['parmeeting'] == 'start') {  /* start parent meeting */   


				$cid = strip_tags($_REQUEST['eData']);
				$i = $fiVal;
				
				if ($cid == ""){
         			
					$msg_e = "* Ooops, an error has occur while to retrieve parent meeting information. Please try again";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
					
	   			}else {  

					if (($admin_grade == $cm_fobrain_grd) || ($admin_grade == $staff_fobrain_grd) 
					|| ($admin_grade == $admin_fobrain_grd) || ($admin_grade == $bus_fobrain_grd)
					|| ($admin_grade == $lib_fobrain_grd)) {    /* check admin grade */  
						 
						$live_user = "attendant";
						
					}else{

						$live_user = "host"; $status = 2;

						try { 
						
							$ebele_mark = "UPDATE $fobrainParentMeetingTB  
												
												SET  
												 
												status = :status
												
												
											WHERE cid = :cid";
						 
							$igweze_prep = $conn->prepare($ebele_mark);
							$igweze_prep->bindValue(':cid', $cid); 
							$igweze_prep->bindValue(':status', $status);
							
							if($igweze_prep->execute()){  /* if sucessfully */
								
								//everything cool
								
							}else{  /* display error */ 
					
								$msg_e =  "Ooops, an error has occur while to start Parent Live Meeting.  Please try again";
								echo $errorMsg.$msg_e.$eEnd; 
								echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
								
							}

						}catch(PDOException $e) {
  			
							fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
				 
						}	


					} 

		 			try { 
						
						$fobrainLiveArr = parentMeetingInfo($conn, $cid);  /* online student parent meeting information */
					 
						$atype = $fobrainLiveArr[1]["atype"];
						$link = $fobrainLiveArr[1]["link"];
						$lpass = $fobrainLiveArr[1]["lpass"];

						if($atype == 1){

							echo "<script type='text/javascript'>"; 
									require_once $fob_live_script;
							echo "</script>"; 
	
						}else{

							echo "<script type='text/javascript'>   
									$('#fob-wrapper').css('display', 'block');
									$('#virtual-loading').hide();
									hidePageLoader();
									window.open('$link', '_blank'); 
								</script>"; 
						} 
						 

				 	}catch(PDOException $e) {
  			
						fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					} 
        	
				} 
				 
			 
			}elseif ($_REQUEST['parmeeting'] == 'add') {  /* start parent meeting */  

?>

				<!-- form -->
				<form class="form-horizontal mb-70" id="frmsaveParentMeeting" role="form">	  
					<!-- row -->
					<div class="row gutters">
						<div class="col-lg-12">										
							<!-- field wrapper start -->
							<div class="field-wrapper">	
								<input type="text"  id="eTitle" name="eTitle" 
								class="form-control" placeholder="Enter  Title" value="">
								<div class="field-placeholder">  Title <span class="text-danger">*</span></div>
							</div>
							<!-- field wrapper end -->
						</div>
					</div>

					<!-- row -->
					<div class="row gutters">
						<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">										
							<!-- field wrapper start -->
							<div class="field-wrapper select-wrapper">
								<select class="form-control fob-select"  id="par-meet-type" name="eType" required>
								
									<option value = "">Please select One</option>
									<?php  

										foreach($pmeeting_list as $meet_key => $meet_value){    /* loop array */

											if ($curTerm == $meet_key){
												$selected = "SELECTED";
											} else {
												$selected = "";
											}

											echo '<option value="'.$meet_key.'"'.$selected.'>'.$meet_value.'</option>' ."\r\n";

										}

									?> 							
								</select>
								<div class="icon-wrap"  id="wait" style="display: none;">
									<i class="loader"></i>
								</div>
								<input type="hidden" value="save" name = "parmeeting"/>
								<input type="hidden" value="<?php echo $empty_str; ?>" 
								name = "euData" id="euData"/>							
								<div class="field-placeholder">  Participant <span class="text-danger">*</span></div>
							</div>
							<!-- field wrapper end -->
						</div>		
						
						<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">										
							<!-- field wrapper start -->
							<div class="field-wrapper select-wrapper">
								<select class="form-control fob-select"  id="allow-staff" name="allow" required>
								
									<option value = "">Please select One</option>
									<?php  

										foreach($meeting_allow_list as $allow_key => $allow_value){    /* loop array */

											if ($allow_staff == $allow_key){
												$selected = "SELECTED";
											} else {
												$selected = "";
											}

											echo '<option value="'.$allow_key.'"'.$selected.'>'.$allow_value.'</option>' ."\r\n";

										}

									?> 							
								</select>
								<div class="icon-wrap"  id="wait_a" style="display: none;">
									<i class="loader"></i>
								</div>
								 							
								<div class="field-placeholder">  Allow Staffs <span class="text-danger">*</span></div>
							</div>
							<!-- field wrapper end -->
						</div>		
					</div>	
					<!-- /row --> 
						
					<span id="result" style="display: none;"></span><!-- loading div -->  
					<span id="result_a" style="display: none;"></span><!-- loading div --> 
				
					<div id="par-meet-div" style="display:none;">    
					
						<!-- row -->
						<div class="row gutters display-none" id="show_class_meet">
							<div class="col-12">										
								<!-- field wrapper start -->
								<div class="field-wrapper select-wrapper">	
									
									<select class="form-control fob-select"  id="meetingLevel" name="meetingLevel">
									
										<option value = "">Please select One</option>
										<?php 
										
											try {
											
												schoolSessionL($conn);  /* school session  */
										
											}catch(PDOException $e) {
				
											fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
					
											}

										?>
									
									</select>
									<div class="icon-wrap"  id="wait_1" style="display: none;">
										<i class="loader"></i>
									</div>
									<input type="hidden" name ="classAll" id="classAll" value="<?php echo $fiVal; ?>" />
									
									<div class="field-placeholder"> Level <span class="text-danger">*</span></div>
								</div>
								<!-- field wrapper end -->
							</div>																 
						</div>	
						<!-- /row --> 
						
						<span id="result_1" style="display: none;"></span><!-- loading div -->   

						<div class="col-lg-12 display-none" id="show_staff_div">
							<!-- field wrapper start -->
							<div class="field-wrapper">	
								<select class="form-control wiz-select"  id="staffs" name="staffs[]" placeholder="Select Staff..." autocomplete="off">
								<option value = "">Search . . .</option>
								<?php
									try{
										$staff_arr = staffArrays($conn);  /* school staffs token information */  
										echo staffSelectBox($conn, $staff_arr, "none", false);
									}catch(PDOException $e) {				
										fobrainDie( 'Ooops Database Error: ' . $e->getMessage());													
									} 
								?>	
								</select>

								<div class="field-placeholder"> Select Staffs <span class="text-danger">*</span></div>
							</div>
							<!-- field wrapper end -->
						</div>

						<!-- row -->
						<div class="row gutters"> 
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">										
								<div class="field-wrapper">										 
									<input type="text" class="form-control" placeholder="Class Start Time" 
									name="sTime"  id="sTime"  required>
									<div class="field-placeholder"> Start Time  <span class="text-danger">*</span></div>
								</div>
								<!-- field wrapper start -- >
								<div class="field-wrapper">			
									<select class="form-control" id="status" name="status" required> 

										<?php
										/*
										foreach($live_meeting_status as $status_key => $status_value){  /* loop array * /

											if ($status == $status_key){
												$selected = "SELECTED";
											} else {
												$selected = "";
											}

											echo '<option value="'.$status_key.'"'.$selected.'>'.$status_value.'</option>' ."\r\n";

										}	
										*/     	
										?> 

									</select>

									<div class="field-placeholder"> Status <span class="text-danger">*</span></div>													
								</div>
								<!-- field wrapper end -->
							</div>	
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">										
								<!-- field wrapper start -->
								<div class="field-wrapper">
									<input type="number"  id="eTime" name="eTime" 
									class="form-control" placeholder="60" maxlength="3" required>							
									<div class="field-placeholder"> Duration <span class="text-danger">*</span></div>
									<div class="form-text text-danger fw-500">
										In Minutes eg 10, 20
									</div>
								</div>
								<!-- field wrapper end -->
							</div>																 
						</div>	
						<!-- /row -->
 

						<!--
						<!- - row -- >
						<div class="row gutters">
							<div class="col-12">										
								<!-- field wrapper start -- >
								<div class="field-wrapper">
								
									<textarea rows="4" cols="10" class="form-control" name="eDetail" id="eDetail" 
									placeholder="Enter ParentMeeting Instructions"></textarea>
										
										<div class="field-placeholder">Select Term<span class="text-danger">*</span></div>
									</div>
									<!- - field wrapper end -- >
									</div>																 
							</div>	
							<!- - /row -- >
					
						-->

						<!-- row -->
						<div class="row gutters mt-30">
							<div class="col-12 text-end"> 
								<button type="submit" class="btn btn-primary waves-effect   
								btn-label waves-light" id="saveParentMeeting">
									<i class="mdi mdi-content-save label-icon"></i>  Save  
								</button>
							</div>
						</div>	
						<!-- /row -->	 

					</div>
			
				</form><!-- / form --> 					  

				<script type="text/javascript">	 
					$(function() {
						$('input[name="sTime"]').daterangepicker({ 
						 
							"singleDatePicker": true,
    						"timePicker": true,
							"autoApply": true,
							"drops": "auto",
							"minYear": 2010,
							"maxYear": parseInt(moment().format('YYYY'),10),
							"locale": {
								format: 'YYYY-MM-DD hh:mm A'
							},
							"showDropdowns": true, 
						});
					});
					  
					$('.fob-select').each(function() {  
						renderSelect($('#'+this.id)); 
					}); 
					renderSelectImg("#staffs", 10);
					hidePageLoader(); 
				</script>		

<?php


 
			 
			}else{ 
			
				echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
			
			}
			
exit;
?>

