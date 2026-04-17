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
	This script handle student live class
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

		define('fobrain', 'igweze');  /* define a check for wrong access of file */

		require 'fobrain-config.php';  /* load fobrain configuration files */ 
				
		if ($_REQUEST['liveclass'] == 'save') {  /* save live class */
			
			$session = cleanInt($_REQUEST['sess']);
			$level = cleanInt($_REQUEST['level']);
			$eTerm = cleanInt($_REQUEST['eTerm']);
			$class = clean($_REQUEST['class']);
			$eTitle =  clean($_REQUEST['eTitle']);
			$eSubject = clean($_REQUEST['eSubject']);
			$eTime = cleanInt($_REQUEST['eTime']);
			$sTime = clean($_REQUEST['sTime']);
			$atype =  cleanInt($_REQUEST['atype']);
			$link =  clean($_REQUEST['link']);
			$lpass =  clean($_REQUEST['lpass']);

			//$status = cleanInt($_REQUEST['status']);
			//$eDetail = $_REQUEST['eDetail']; 			 
			
			/* script validation */
			
			if ($session == "")  {
				
				$msg_e = "* Ooops Error, please select target class";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
				
			}elseif ($level == "")  {
				
				$msg_e = "* Ooops Error, please enter target level";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
				
			}elseif ($class == "")  {
				
				$msg_e = "* Ooops Error, please select target class";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
				
			}elseif ($eTerm == "")  {
				
				$msg_e = "* Ooops Error, please select target term";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
				
			}elseif ($eTitle == "")  {
				
				$msg_e = "* Ooops Error, please enter title";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
				
			}elseif ($eSubject == "")  {
				
				$msg_e = "* Ooops Error, please select subject";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
				
			}elseif ($atype == "")  {
				
				$msg_e = "* Ooops Error, please enter document type";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> 
					$script_scroll_cm  
				</script>"; exit;
				
			}elseif (($atype > 1) && ($link == ""))  {
				
				$msg_e = "* Ooops Error, please enter your generated meeting link from your API Provider";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> 
					$script_scroll_cm  
				</script>"; exit;
				
			}elseif ($eTime == "")  {
				
				$msg_e = "* Ooops Error, please enter live class duration";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
				
			}elseif ($sTime == "")  {
				
				$msg_e = "* Ooops Error, please enter live class start time";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
				
			}
			/*elseif ($eDetail == "")  {
				
				$msg_e = "* Ooops Error, please enter live class instruction";
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

				try { 
					
					if ($admin_grade == $cm_fobrain_grd) {    /* check admin grade */ 
					
						$eGrade = $seVal;
					
					}else{
						
						$eGrade = $fiVal;
						
					}	
					
					$ebele_mark = "INSERT INTO $fobrainLiveClassTB  (atype, link, lpass, meetid, session, level, class, eTerm, eTitle, eSubject, eTime, cTime, sTime, eDetail, eGrade, eStaff, status)

																VALUES (:atype, :link, :lpass, :meetid, :session, :level, :class, :eTerm, :eTitle, :eSubject, 
																:eTime, :cTime, :sTime, :eDetail, :eGrade, :eStaff, :status)";
					
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':atype', $atype);
					$igweze_prep->bindValue(':link', $link);
					$igweze_prep->bindValue(':lpass', $lpass);
					$igweze_prep->bindValue(':meetid', $meetid);
					$igweze_prep->bindValue(':session', $sessionID);
					$igweze_prep->bindValue(':level', $level);
					$igweze_prep->bindValue(':class', $class);
					$igweze_prep->bindValue(':eTerm', $eTerm);
					$igweze_prep->bindValue(':eTitle', $eTitle);
					$igweze_prep->bindValue(':eSubject', $eSubject);
					$igweze_prep->bindValue(':eTime', $eTime);
					$igweze_prep->bindValue(':cTime', $ctime);
					$igweze_prep->bindValue(':sTime', $sTime);
					$igweze_prep->bindValue(':eDetail', $eDetail);
					$igweze_prep->bindValue(':eGrade', $eGrade);
					$igweze_prep->bindValue(':eStaff', $_SESSION['adminID']);
					$igweze_prep->bindValue(':status', $status);
					
					
					if($igweze_prep->execute()){  /* if sucessfully */    

						$msg_s = "Live Class information was successfully saved."; 
						echo $succesMsg.$msg_s.$sEnd; 
						echo "<script type='text/javascript'> 
								$('#load-wiz-info').load('live-class-info.php'); 
								//$('#frmsaveLiveClass')[0].reset(); 
								$('#modal-fobrain').modal('hide');
								hidePageLoader();  
						</script>";exit;
						
					}else{  /* display error */ 
			
						$msg_e =  "Ooops, an error has occur while to create new Live Class. Please try again";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
						
					}
					

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				}
		
		
			}
		
		}elseif ($_REQUEST['liveclass'] == 'update') {  /* update live class */

			$cid = cleanInt($_REQUEST['cid']);			
			$session = cleanInt($_REQUEST['sess']);
			$level = cleanInt($_REQUEST['level']);
			$eTerm = cleanInt($_REQUEST['eTerm']);
			$class = clean($_REQUEST['class']);
			$eTitle =  clean($_REQUEST['eTitle']);
			$eSubject = clean($_REQUEST['eSubject']);
			$eTime = cleanInt($_REQUEST['eTime']);
			$sTime = clean($_REQUEST['sTime']);
			$status = cleanInt($_REQUEST['status']);
			$atype =  cleanInt($_REQUEST['atype']);
			$link =  clean($_REQUEST['link']);
			$lpass =  clean($_REQUEST['lpass']);
			//$eDetail = $_REQUEST['eDetail'];				
			
			/* script validation */ 
							
			if ($cid == ""){
				
				$msg_e = "* Ooops, an error has occur to retrieve live class information. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($session == "")  {
				
				$msg_e = "* Ooops Error, please select target class";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($level == "")  {
				
				$msg_e = "* Ooops Error, please enter target level";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($class == "")  {
				
				$msg_e = "* Ooops Error, please select target  class";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($eTerm == "")  {
				
				$msg_e = "* Ooops Error, please select target term";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($eTitle == "")  {
				
				$msg_e = "* Ooops Error, please enter title";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($eSubject == "")  {
				
				$msg_e = "* Ooops Error, please select subject";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($atype == "")  {
				
				$msg_e = "* Ooops Error, please enter document type";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> 
					$script_scroll_cm  
				</script>"; exit;
				
			}elseif (($atype > 1) && ($link == ""))  {
				
				$msg_e = "* Ooops Error, please enter your generated meeting link from your API Provider";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> 
					$script_scroll_cm  
				</script>"; exit;
				
			}elseif ($eTime == "")  {
				
				$msg_e = "* Ooops Error, please enter live class duration";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($sTime == "")  {
				
				$msg_e = "* Ooops Error, please enter live class start time";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
				
			}elseif ($status == "")  {
				
				$msg_e = "* Ooops Error, please enter live class status";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
				
			}
			
			/*
			elseif ($eDetail == "")  {
				
				$msg_e = "* Ooops Error, please enter live class instruction";
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

				try { 
					
					$ebele_mark = "UPDATE $fobrainLiveClassTB  
										
										SET 
										atype = :atype,
										link = :link,
										lpass = :lpass,
										session = :session, 
										level = :level,
										class = :class,
										eTerm = :eTerm,	
										eTitle = :eTitle,
										eSubject = :eSubject,
										eTime = :eTime,
										sTime = :sTime,
										eDetail = :eDetail,
										status = :status
										
										
									WHERE cid = :cid";
					
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':cid', $cid);
					$igweze_prep->bindValue(':atype', $atype);
					$igweze_prep->bindValue(':link', $link);
					$igweze_prep->bindValue(':lpass', $lpass);
					$igweze_prep->bindValue(':session', $sessionID);
					$igweze_prep->bindValue(':level', $level);
					$igweze_prep->bindValue(':class', $class);
					$igweze_prep->bindValue(':eTerm', $eTerm);
					$igweze_prep->bindValue(':eTitle', $eTitle);
					$igweze_prep->bindValue(':eSubject', $eSubject);
					$igweze_prep->bindValue(':eTime', $eTime);
					$igweze_prep->bindValue(':sTime', $sTime);
					$igweze_prep->bindValue(':eDetail', $eDetail); 
					$igweze_prep->bindValue(':status', $status);
					 
					if($igweze_prep->execute()){  /* if sucessfully */
						
						$msg_s = "Live Class information was successfully saved."; 
						echo $succesMsg.$msg_s.$sEnd; 
						echo "<script type='text/javascript'> 
								$('#load-wiz-info').load('live-class-info.php'); 
								//$('#frmupdateLiveClass').slideUp(1500);
								$('#modal-fobrain').modal('hide');
								hidePageLoader();  
						</script>";exit;
						
					}else{  /* display error */ 
			
						$msg_e =  "Ooops, an error has occur while to save Live Class. 
						Please try again";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
						
					}
					

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				}          		
		
			}
		
		}elseif ($_REQUEST['liveclass'] == 'view') {  /* view live class */ 
			
			$cid = strip_tags($_REQUEST['eData']);
			$i = $fiVal;
			
			if ($cid == ""){
				
				$msg_e = "* Ooops, an error has occur while to retrieve live class information. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}else {  


				try {
					
					
					$liveClassInfoArr = liveClassInfo($conn, $cid);  /* online student live class information */
					$levelArray = studentLevelsArray($conn); /* student level array */		
		
					array_unshift($levelArray,"");
					unset($levelArray[0]);

					$atype = $liveClassInfoArr[$i]["atype"];
					$link = $liveClassInfoArr[$i]["link"];
					$lpass = $liveClassInfoArr[$i]["lpass"];
					$meetid = $liveClassInfoArr[$i]["meetid"];
					$participant = $liveClassInfoArr[$i]["participant"];
					$sessionID = $liveClassInfoArr[$i]["session"];
					$level = $liveClassInfoArr[$i]["level"];
					$eTerm = $liveClassInfoArr[$i]["eTerm"];
					$class = $liveClassInfoArr[$i]["class"];
					$eTitle = $liveClassInfoArr[$i]["eTitle"];
					$eSubject = $liveClassInfoArr[$i]["eSubject"];
					$eDetail = htmlspecialchars_decode($liveClassInfoArr[$i]["eDetail"]);
					$eTime = $liveClassInfoArr[$i]["eTime"];
					$sTime = $liveClassInfoArr[$i]["sTime"];
					$cTime = $liveClassInfoArr[$i]["cTime"];
					$eTerm = $term_list[$eTerm];
					
					$session = fobrainSession($conn, $sessionID);  /* school session ID */
					$sessionS = ($session + $fiVal); 
					$liveclassLevel = $levelArray[$level]['level'];

					$api_provider = wizSelectArray($atype, $live_virtual_apk_arr);
				 
					if($atype == 1){
						$meeting_id = $meetid;
						$meeting_pass = "-";
					}else{
						$meeting_id = $link; 
						$meeting_pass = $lpass;
					}  

					//$eDetail = nl2br($eDetail);
					
					/*<tr><th>
						<i class="fa fa-sort-alpha-asc"></i> LiveClass Details </td> <td>
						$eDetail</td> </tr>
					*/	
					

$showLiveClass =<<<IGWEZE
							

					<div class="row gutters mb-10">
						<div class="text-end">
							<button  class="btn btn-primary" onclick="printDiv('fobrain-print-ovly')">
								<i class="fas fa-print"></i>  
							</button>
						</div>	
					</div>
							
					<div id = 'fobrain-print-ovly'>

						<!-- table -->	
						<table  class="table table-view table-hover table-responsive"> 
							
							<tr>
								<th>
									API Provider
								</td> 
								<td>
									$api_provider
								</td> 
							</tr> 

							<tr>
								<th>
									Meeting Link/ID
								</td> 
								<td>
									$meeting_id
								</td> 
							</tr> 

							<tr>
								<th>
									Password 
								</td> 
								<td>
									$meeting_pass
								</td> 
							</tr> 

							<tr>
								<th>
									Session 
								</td> 
								<td>
									$session - $sessionS
								</td> 
							</tr> 
							
							<tr><th>
								Target Class </td> <td>
							$liveclassLevel $class </td> </tr> 
							
							<tr><th>
								Term</td> <td>
							$eTerm</td> </tr>
							
							
							<tr><th>
									Title </td> <td>
							$eTitle</td> </tr>
							
							<tr><th>
								Subject Title </td> <td>
							$eSubject</td> </tr>
							
							<tr><th>
								Duration </td> <td>
							$eTime Minutes</td> </tr>  

							<tr><th>
								Created </td> <td>
							$cTime  </td> </tr> 
							
							<tr><th>
								Start</td> <td>
							$sTime  </td> </tr> 
							
						</table>
						<!-- / table --> 
					</div>
	
IGWEZE;
			
					echo $showLiveClass; 
					echo "<script type='text/javascript'>  hidePageLoader(); </script>"; exit; 
					

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				} 
		
			}
		
		}elseif ($_REQUEST['liveclass'] == 'remove') {  /* remove school liveclass */

			
			$liveclass = $_REQUEST['eData'];
			
			list($fobrainIg, $cid, $hName) = explode("-", $liveclass);			
			
			/* script validation */ 
			
			if (($liveclass == "")  || ($cid == "")){
				
				$msg_e = "* Ooops, an error has occur while to remove live class. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}else {  /* remove information */       			


				try { 
					
					$ebele_mark = "DELETE FROM $fobrainLiveClassTB 
									
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
			
						$msg_e =  "Ooops, an error has occur while to remove live class. Please try again";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
						
					}
					

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				} 
		
			}
		
		}elseif ($_REQUEST['liveclass'] == 'edit') {  /* edit live class */

			
			$cid = strip_tags($_REQUEST['eData']);
			
			/* script validation */
			
			if ($cid == ""){
				
				$msg_e = "* Ooops, an error has occur while to retrieve live class information. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}else {       	 

				try {						
						
					$liveClassInfoArr = liveClassInfo($conn, $cid);  /* online student live class information */ 
					$sessionID = $liveClassInfoArr[$fiVal]["session"];
					$atype = $liveClassInfoArr[$fiVal]["atype"];
					$link = $liveClassInfoArr[$fiVal]["link"];
					$lpass = $liveClassInfoArr[$fiVal]["lpass"];
					$level = $liveClassInfoArr[$fiVal]["level"];
					$class = $liveClassInfoArr[$fiVal]["class"];
					$eTerm = $liveClassInfoArr[$fiVal]["eTerm"];
					$eTitle = $liveClassInfoArr[$fiVal]["eTitle"];
					$eSubject = $liveClassInfoArr[$fiVal]["eSubject"];
					$eTime = $liveClassInfoArr[$fiVal]["eTime"];
					$sTime = $liveClassInfoArr[$fiVal]["sTime"];
					$status = $liveClassInfoArr[$fiVal]["status"];
					//$eDetail = htmlspecialchars_decode($liveClassInfoArr[$fiVal]["eDetail"]);							
			
?>
					<!-- form -->
					<form class="form-horizontal" id="frmupdateLiveClass" role="form">
								
						<!-- row -->
						<div class="row gutters">
							<div class="col-12">										
								<!-- field wrapper start -->
								<div class="field-wrapper select-wrapper">
									<select class="form-control fob-select"  id="subjTerm2" name="eTerm" required> 
									<option value = "">Please select One</option>  
									<?php 

										foreach($term_list as $term_key => $term_value){  /* loop array */

											if ($eTerm == $term_key){
												$selected = "SELECTED";
											} else {
												$selected = "";
											}

											echo '<option value="'.$term_key.'"'.$selected.'>'.$term_value.'</option>' ."\r\n";

										}

									?> 											
									
									</select>
									<div class="icon-wrap"  id="wait" style="display: none;">
										<i class="loader"></i>
									</div>
									<input type="hidden" value="update" name = "liveclass"/>
									<input type="hidden" value="<?php echo $class.':<$?$>:'.$eTitle.':<$?$>:'.$eSubject; ?>" 
									name = "euData" id="euData2"/>
									<input type="hidden" name="cid" value="<?php echo $cid; ?>"/>											  
									<div class="field-placeholder"> Select Term <span class="text-danger">*</span></div>
								</div>
								<!-- field wrapper end -->
							</div>									 
						</div>	
						<!-- /row -->

						<span id="result" style="display: none;"></span><!-- loading div -->				
					
						<?php if ($admin_grade == $cm_fobrain_grd) {    /* check admin grade */ ?>

						<!-- row -->
						<div class="row gutters">
							<div class="col-12">										
								<!-- field wrapper start -->
								<div class="field-wrapper select-wrapper">                                      
									<select class="form-control fob-select"  id="subjectLevel2" name="subjectLevel2" required>
										<option value = "">Please select One</option>					 
										<?php 
									
											try  {

												$session = fobrainSession($conn, $sessionID); /* school session  */
												$passData = trim($session.'#@@#'.$level); 
												formTeacherSessionPass($conn, $adminID, $fobrainMode, $passData); /* class teacher school session  */ 
										
											}catch(PDOException $e) {
				
												fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
					
											} 
											
										?>	 
									</select>
									<div class="icon-wrap"  id="wait_11" style="display: none;">
										<i class="loader"></i>
									</div>
									<input type="hidden" name ="classAll2" id="classAll2" value="<?php echo $i_false; ?>" />
									<div class="field-placeholder"> School Level <span class="text-danger">*</span></div>
								</div>
							</div>
						</div>
						
						<?php }else{ ?>	

						<!-- row -->
						<div class="row gutters">
							<div class="col-12">										
								<!-- field wrapper start -->
								<div class="field-wrapper select-wrapper">
									
									<select class="form-control fob-select"  id="subjectLevel2" name="subjectLevel2" required>
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
									<div class="icon-wrap"  id="wait_11" style="display: none;">
										<i class="loader"></i>
									</div>
									<input type="hidden" name ="classAll2" id="classAll2" value="<?php echo $fiVal; ?>" />
									<div class="field-placeholder"> School Level <span class="text-danger">*</span></div>
								</div>
								<!-- field wrapper end -->
							</div>									 
						</div>	
						<!-- /row -->
					
						<?php } ?>
							

						<span id="result_11" style="display: none;"></span><!-- loading div --> 
					
						<!-- row -->
						<div class="row gutters">

							<div class="col-12">										
								<!-- field wrapper start -->
								<div class="field-wrapper">
									<select class="form-control fob-select"  id="atype" name="atype" required>                                              
										<option value = "">Please select One</option>                                                              
										<?php

											if($atype == ""){ $atype = 1; }

											foreach($live_virtual_apk_arr as $atype_ind => $atype_val){  /* loop array */

												if ($atype == $atype_ind){
													$selected = "SELECTED";
												} else {
													$selected = "";
												}

												echo '<option value="'.$atype_ind.'"'.$selected.'>'.$atype_val.'</option>' ."\r\n";

											}

										?> 
									</select> 					
									<div class="field-placeholder"> Live API Provider  <span class="text-danger">*</span></div>										 
								</div>
								<!-- field wrapper end -->
							</div>	

							<div class="col-12 external-video-link">										
								<!-- field wrapper start -->
								<div class="field-wrapper">
									<input type="text" class="form-control required" value ="<?php echo $link; ?>" 
										name="link" id="link" /> 							
									<div class="field-placeholder"> Meeting Link <span class="text-danger">*</span></div>
								</div>
								<!-- field wrapper end -->
							</div>
							
							<div class="col-12 external-video-link">										
								<!-- field wrapper start -->
								<div class="field-wrapper">
									<input type="text" class="form-control required" value ="<?php echo $lpass; ?>" 
										name="lpass" id="lpass" /> 							
									<div class="field-placeholder"> Meeting Password <span class="text-danger"></span></div>
								</div>
								<!-- field wrapper end -->
							</div>
							
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

						<!-- row -->
						<div class="row gutters"> 							 
							<div class="col-12">										
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
						
						<!--

						<div class="form-group">
							<label for="eDetail" class="col-lg-4 col-sm-4 control-label"> * LiveClass Instruction/s</label>
							
							<div class="col-lg-8">
							
								<textarea rows="4" cols="10" class="form-control" name="eDetail" id="eDetail" 
								placeholder="Enter LiveClass Instructions"><?php echo $eDetail; ?></textarea>
								
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
								btn-label waves-light" id="updateLiveClass">
									<i class="mdi mdi-content-save label-icon"></i>  Save
								</button>
							</div>
						</div>	
						<!-- /row --> 
							
					</form>  
					<!-- / form -->	 

					<script type='text/javascript'>   

						$(function() {

							hidePageLoader();

							$('#subjectLevel2').change(); 

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

							$('body').on('change','#atype',function(){  /* select api type */	  

								var course_type = $('#atype').val();
								
								if(course_type == 1){ 
									
									$('.external-video-link').hide(500);
									$('#diplay-c-text').text('Upload Electronic Book');
									$('#allow-format').val('1');
									
								}else{ 

									$('.external-video-link').show(500); 
									$('#allow-format').val('2');
								
								}
										
							});	

							$('#atype').change();

							$('.fob-select').each(function() {  
								renderSelect($('#'+this.id)); 
							});
							
						}); 
							
					</script>							
			<?php								
					
						exit;						
														
				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				}		 
		
			}
		
		}elseif ($_REQUEST['liveclass'] == 'start') {  /* start live class */  


			$cid = strip_tags($_REQUEST['eData']);
			$i = $fiVal; 
			
			if ($cid == ""){
				
				$msg_e = "* Ooops, an error has occur while to retrieve live class information. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}else {   

				try { 
					
					$fobrainLiveArr = liveClassInfo($conn, $cid);  /* online student live class information */ 

					$atype = $fobrainLiveArr[1]["atype"];
					$link = $fobrainLiveArr[1]["link"];
					$lpass = $fobrainLiveArr[1]["lpass"];

					if($_SESSION['adminID'] == $fobrainLiveArr[1]["eStaff"]){
						
						$live_user = "host"; $status = 2;

						$ebele_mark = "UPDATE $fobrainLiveClassTB  
										
											SET  
												
											status = :status
											
											
										WHERE cid = :cid";
						
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':cid', $cid); 
						$igweze_prep->bindValue(':status', $status);
						
						if($igweze_prep->execute()){  /* if sucessfully */
							
							//everything cool
							
						}else{  /* display error */ 
				
							$msg_e =  "Ooops, an error has occur while to start Staff Live Meeting.  Please try again";
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
							
						}

					}else{
						$live_user = "attendant";
					} 
						
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
				
			
		}elseif ($_REQUEST['liveclass'] == 'add') {  /* start live class */  

?>

			<!-- form -->
			<form class="form-horizontal mb-70" id="frmsaveLiveClass" role="form">	  
				<!-- row -->
				<div class="row gutters">
					<div class="col-12">										
						<!-- field wrapper start -->
						<div class="field-wrapper select-wrapper">
							<select class="form-control fob-select"  id="subjTerm" name="eTerm" required>
							
								<option value = "">Please select One</option>
								<?php  

									foreach($term_list as $term_key => $term_value){    /* loop array */

										if ($curTerm == $term_key){
											$selected = "SELECTED";
										} else {
											$selected = "";
										}

										echo '<option value="'.$term_key.'"'.$selected.'>'.$term_value.'</option>' ."\r\n";

									}

								?> 							
							</select>
							<div class="icon-wrap"  id="wait" style="display: none;">
								<i class="loader"></i>
							</div>
							<input type="hidden" value="save" name = "liveclass"/>
							<input type="hidden" value="<?php echo $empty_str.':<$?$>:'.$empty_str.':<$?$>:'.$empty_str; ?>" 
							name = "euData" id="euData"/>							
							<div class="field-placeholder">  Term <span class="text-danger">*</span></div>
						</div>
						<!-- field wrapper end -->
					</div>																 
				</div>	
				<!-- /row -->				

					
				<span id="result" style="display: none;"></span><!-- loading div -->  
			
				<div id="subjectExamDiv" style="display:none;">   
				
					<?php if ($admin_grade == $cm_fobrain_grd) {  ?>

					<!-- row -->
					<div class="row gutters">
						<div class="col-12">										
							<!-- field wrapper start -->
							<div class="field-wrapper select-wrapper">					
								<select class="form-control fob-select"  id="subjectLevel" name="subjectLevel" required>
								
									<option value = "">Please select One</option>
									<?php 
									
										try  {
											
											formTeacherSession($conn, $adminID, $fobrainMode);  /* class teacher school session  */ 
									
										}catch(PDOException $e) {
			
											fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
				
										} 
										
									?>
								
								</select>
								<div class="icon-wrap"  id="wait_1" style="display: none;">
									<i class="loader"></i>
								</div>
								<input type="hidden" name ="classAll" id="classAll" value="<?php echo $i_false; ?>" />
								
								<div class="field-placeholder"> Level <span class="text-danger">*</span></div>
							</div>
							<!-- field wrapper end -->
						</div>																 
					</div>	
					<!-- /row -->

					<?php }else{ ?>	 
				
					<!-- row -->
					<div class="row gutters">
						<div class="col-12">										
							<!-- field wrapper start -->
							<div class="field-wrapper select-wrapper">	
								
								<select class="form-control fob-select"  id="subjectLevel" name="subjectLevel" required>
								
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
				
					<?php } ?> 
					
					<span id="result_1" style="display: none;"></span><!-- loading div -->   

					<!-- row -->
					<div class="row gutters"> 

						<div class="col-12">										
							<!-- field wrapper start -->
							<div class="field-wrapper">
								<select class="form-control fob-select"  id="atype" name="atype" required>                                              
									<option value = "">Please select One</option>                                                              
									<?php

										if($atype == ""){ $atype = 1; }

										foreach($live_virtual_apk_arr as $atype_ind => $atype_val){  /* loop array */

											if ($atype == $atype_ind){
												$selected = "SELECTED";
											} else {
												$selected = "";
											}

											echo '<option value="'.$atype_ind.'"'.$selected.'>'.$atype_val.'</option>' ."\r\n";

										}

									?> 
								</select> 					
								<div class="field-placeholder"> Live API Provider  <span class="text-danger">*</span></div>										 
							</div>
							<!-- field wrapper end -->
						</div>	

						<div class="col-12 external-video-link">										
							<!-- field wrapper start -->
							<div class="field-wrapper">
								<input type="text" class="form-control required"  
									name="link" id="link" /> 							
								<div class="field-placeholder"> Meeting Link <span class="text-danger">*</span></div>
							</div>
							<!-- field wrapper end -->
						</div>
						
						<div class="col-12 external-video-link">										
							<!-- field wrapper start -->
							<div class="field-wrapper">
								<input type="text" class="form-control required" 
									name="lpass" id="lpass" /> 							
								<div class="field-placeholder"> Meeting Password <span class="text-danger"></span></div>
							</div>
							<!-- field wrapper end -->
						</div>
						
						<div class="col-12">										
							<div class="field-wrapper">										 
								<input type="text" class="form-control" placeholder="Class Start Time" 
								name="sTime"  id="sTime"  required>
								<div class="field-placeholder"> Start Time  <span class="text-danger">*</span></div>
							</div>
							<!-- field wrapper start -- >
							<div class="field-wrapper">			
								<select class="form-control fob-select" id="status" name="status" required> 

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
						<div class="col-12">										
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
								placeholder="Enter LiveClass Instructions"></textarea>
									
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
							btn-label waves-light" id="saveLiveClass">
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

					$('body').on('change','#atype',function(){  /* select api type */	  

						var course_type = $('#atype').val();
						
						if(course_type == 1){ 
							
							$('.external-video-link').hide(500);
							$('#diplay-c-text').text('Upload Electronic Book');
							$('#allow-format').val('1');
							
						}else{ 

							$('.external-video-link').show(500); 
							$('#allow-format').val('2');
						
						}
								
					});	

					$('#atype').change();

					$('.fob-select').each(function() {  
						renderSelect($('#'+this.id)); 
					}); 

					hidePageLoader();

				});
				
			</script>		

<?php



			
		}else{ 
		
			echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
		
		}
		
exit;
?>

