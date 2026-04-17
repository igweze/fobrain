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
	This script validate companion mail module
	------------------------------------------------------------------------*/ 

		require ($fobrainvalidater);   
		 
		if (($_REQUEST["messageData"]) == 'postMail'){	/* load mail through post */
			
			/* script validation */ 			
			$post_id = clean($_REQUEST["sendMailPosts"]); 
			$member_id = clean($_REQUEST["Member"]);
			$mailData = $post_id.'-'.$member_id;
			$mailDataSE = $post_id.'_'.$member_id; 
			
			if(($post_id == '') || ($member_id == '')) {
			
				$msg_e = "Ooops, could not load message box (Error wall 401)"; 
				echo $errorMsg.$msg_e.$eEnd; exit;					
									
			}

			try {

				$memberInfo = companionWallUserDetails($conn, $member_id, $fiVal);  /* retrieve student companion details */
				
				list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic) = explode ("##", $memberInfo);				
						
			}catch(PDOException $e) {
		
				fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
			}
				

$mailBoxDiv =<<<IGWEZE

			<div class="card postMailBoxDiv_$mailDataSE mt-15  animate__animated animate__bounceIn">							 
				<div class="card-body">							
					<!-- form -->
					<form class="form-horizontal" 
					id="frmmailBoxPosts-$post_id" role="form">                                  
					<!-- row -->
					<div class="row gutters"> 
						<div class="col-lg-12 mt-10">                                          
							<input type="text" class="form-control" value="To: $m_name" disabled
							name="Recep" id="Recep" />
							<input type="hidden" name="messageData" value="sendWCReplyMail" />
							<input type="hidden" name="recepID" value="$member_id" />
							<input type="hidden" name="recepName" value="$m_name" />
							<input type="hidden" name="mailID" value="$mailDataSE" />
							<input type="hidden" name="mailType" value="Post" />                                       
						</div>  
						
						<div class="col-lg-12 mt-10"> 
							<input type="text" class="form-control" placeholder="Your title" 
							name="msgTitle" id="msgTitle" />  
						</div>
						
						<div class="col-lg-12 mt-10"> 
							<textarea class="form-control p-10" name="message" id="message" 
							placeholder="Write your mesaage here" rows="3"></textarea>
						</div> 
					</div>
					
					<!-- row -->
					<div class="row gutters"> 								
						<div class="col-6 text-left mt-10">
							<button type="button" class="btn btn-danger exitPostMailBoxDiv" 
							id="exitPostMailBoxDiv-$mailDataSE">Cancel</button>
						</div>									
						<div class="col-6 text-end mt-10">
							<button type="submit" class="btn btn-primary sendMailPComp" 
							id="mailBoxPosts-$post_id"> Send </button>                                          
							 
							<div class="display-none" id="wallpostLoader-$post_id"> 
								<strong role="status">Processing...</strong>
								<div class="spinner-border ms-auto text-danger" aria-hidden="true"></div>
							</div>
						</div>
					</div> 
					</form>
					<!-- / form -->
				</div>                         
			</div>
		

IGWEZE;
			echo $mailBoxDiv;	 

		} elseif (($_REQUEST["messageData"]) == 'commentMail'){	/* load mail through comment */  

			/* script validation */			
			$post_id = clean($_REQUEST["sendMailComments"]); 
			$comment_id = clean($_REQUEST["Comment"]); 
			$member_id = clean($_REQUEST["Member"]); 
			$mailData = $post_id.'-'.$comment_id.'-'.$member_id;
			$mailDataSE = $post_id.'_'.$comment_id.'_'.$member_id;
			
			if(($post_id == '') || ($comment_id == '') || ($member_id == '')) {
			
				$msg_e = "Ooops, could not load message box (Error wall 402)"; 
				echo $errorMsg.$msg_e.$eEnd; exit;					
									
			} 
			
			try {

				$memberInfo = companionWallUserDetails($conn, $member_id, $fiVal);  /* retrieve student companion details */
				
				list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic) = explode ("##", $memberInfo);				
						
			}catch(PDOException $e) {
		
				fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
			}
				

$mailBoxDiv =<<<IGWEZE

			<div class="card commentMailBoxDiv_$mailDataSE mt-15 animate__animated animate__bounceIn">							 
				<div class="card-body">							
					<!-- form -->
					<form class="form-horizontal" 
					id="frmmailBoxComments-$mailData" role="form">                                  
					<!-- row -->
					<div class="row gutters"> 
						<div class="col-lg-12 mt-10">                                          
							<input type="text" class="form-control" value="To: $m_name" disabled
							name="Recep" id="Recep" />
							<input type="hidden" name="messageData" value="sendWCReplyMail" />
							<input type="hidden" name="recepID" value="$member_id" />
							<input type="hidden" name="recepName" value="$m_name" />
							<input type="hidden" name="mailID" value="$mailDataSE" />
							<input type="hidden" name="mailType" value="Comment" />
						</div>  
						
						<div class="col-lg-12 mt-10"> 
							<input type="text" class="form-control" placeholder="Your title" 
							name="msgTitle" id="msgTitle" />  
						</div>
						
						<div class="col-lg-12 mt-10"> 
							<textarea class="form-control p-10" name="message" id="message" 
							placeholder="Write your mesaage here" rows="3"></textarea>
						</div> 
					</div>
					
					<!-- row -->
					<div class="row gutters"> 								
						<div class="col-6 text-left mt-10">
							<button type="button" class="btn btn-danger exitCommentMailBoxDiv" 
							id="exitCommentMailBoxDiv-$mailData">Cancel</button>
						</div>									
						<div class="col-6 text-end mt-10">
							<button type="submit" class="btn btn-primary sendMailCComp" 
							id="mailBoxComments-$mailData"> Send </button>                                          
							
							<div class="display-none" id="wallCommentLoader-$mailData"> 
								<strong role="status">Processing...</strong>
								<div class="spinner-border ms-auto text-danger" aria-hidden="true"></div>
							</div>
						</div>
					</div> 
					</form>
					<!-- / form -->
				</div>                         
			</div>


IGWEZE;
			echo $mailBoxDiv;	 
				

		} elseif (($_REQUEST["messageData"]) == 'postReport'){	/* load reports through post */
			
			/* script validation */ 			
			$post_id = clean($_REQUEST["sendReportPosts"]); 
			$member_id = clean($_REQUEST["Member"]); 
			$reportData = $post_id.'-'.$member_id;
			$reportDataSE = $post_id.'_'.$member_id;
			
			
			if(($post_id == '') || ($member_id == '')) {
			
				$msg_e = "Ooops, could not load report box (Error wall 401)"; 
				echo $errorMsg.$msg_e.$eEnd; exit;					
									
			}	 
			
			try {

				$memberInfo = companionWallUserDetails($conn, $member_id, $fiVal);  /* retrieve student companion details */				
				list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic) = explode ("##", $memberInfo);				
						
			}catch(PDOException $e) {
		
				fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
			}
			

$reportBoxDiv =<<<IGWEZE

						
			<div class="card reportPostDiv_$reportDataSE mt-15 animate__animated animate__zoomInDown"> 					 
				<div class="card-body">							
					<!-- form -->
					<form class="form-horizontal" 
					id="frmReportPost-$post_id" method="POST">                                  
					<!-- row -->
					<div class="row gutters"> 
						<div class="col-lg-12 mt-10">                                          
							<input type="text" class="form-control" value="Report: $m_name" disabled
							name="title" id="title" />
							<input type="hidden" name="messageData" value="sendReport" />
							<input type="hidden" name="recepID" value="$member_id" />
							<input type="hidden" name="recepName" value="$m_name" /> 
							<input type="hidden" name="mailID" value="$reportDataSE" />
							<input type="hidden" name="mailType" value="post" />
						</div>   
						<div class="col-lg-12 mt-10"> 
							<input type="text" class="form-control" placeholder="Your title" 
							name="msgTitle" id="msgTitle" />  
						</div> 
						<div class="col-lg-12 mt-10"> 
							<textarea class="form-control p-10" name="message" id="message" 
							placeholder="Write your report here" rows="3"></textarea>
						</div> 
					</div> 
					<!-- row -->
					<div class="row gutters"> 								
						<div class="col-6 text-left mt-10">
							<button type="button" class="btn btn-danger exitPostReportBoxDiv" 
							id="exitPostReportBoxDiv-$reportDataSE">Cancel</button>
						</div>									
						<div class="col-6 text-end mt-10">
							<button type="submit" class="btn btn-primary sendReportPost" 
							id="sendReportPost-$post_id"> Send </button>     
							
							<div class="display-none" id="wallCommentLoader-$post_id"> 
								<strong role="status">Processing...</strong>
								<div class="spinner-border ms-auto text-danger" aria-hidden="true"></div>
							</div>
						</div>
					</div> 
					</form>
					<!-- / form -->
				</div>                         
			</div> 

IGWEZE;
			echo $reportBoxDiv;	 
			
		} elseif (($_REQUEST["messageData"]) == 'commentReport'){	/* load report through comment */  

			/* script validation */ 
			$post_id = clean($_REQUEST["sendReportComments"]); 
			$comment_id = clean($_REQUEST["Comment"]); 
			$member_id = clean($_REQUEST["Member"]); 
			$reportData = $post_id.'-'.$comment_id.'-'.$member_id;
			$reportDataSE = $post_id.'_'.$comment_id.'_'.$member_id;
			
			if(($post_id == '') || ($comment_id == '') || ($member_id == '')) {
			
				$msg_e = "Ooops, could not load message box (Error wall 402)"; 
				echo $errorMsg.$msg_e.$eEnd; exit;					
									
			} 
			
			try {

				$memberInfo = companionWallUserDetails($conn, $member_id, $fiVal);  /* retrieve student companion details */
				list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic) = explode ("##", $memberInfo);				
						
			}catch(PDOException $e) {
		
				fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
			}
				

$reportBoxDiv =<<<IGWEZE

			<div class="card reportCommentDiv_$reportDataSE mt-15 animate__animated animate__zoomInDown">		 
				<div class="card-body">
					<!-- form -->
					<form class="form-horizontal" id="frmReportComment-$reportData" role="form">   

						<div class="col-lg-12 mt-10">                                          
							<input type="text" class="form-control" value="Report: $m_name" disabled
							name="title" id="title" />
							<input type="hidden" name="messageData" value="sendReport" />
							<input type="hidden" name="recepID" value="$member_id" />
							<input type="hidden" name="recepName" value="$m_name" />
							<input type="hidden" name="mailID" value="$reportDataSE" />
							<input type="hidden" name="mailType" value="comment" />
						</div>   
						<div class="col-lg-12 mt-10"> 
							<input type="text" class="form-control" placeholder="Your title" 
							name="msgTitle" id="msgTitle" />  
						</div>  
						<div class="col-lg-12 mt-10"> 
							<textarea class="form-control" name="message" id="message" 
							placeholder="Write your report here" rows="4" required></textarea>
						</div> 
						<!-- row -->
						<div class="row gutters"> 								
							<div class="col-6 text-left mt-10">
								<button type="button" class="btn btn-danger exitCommentReportBoxDiv" 
								id="exitCommentReportBoxDiv-$reportData">Cancel</button>
							</div>									
							<div class="col-6 text-end mt-10">
								<button type="submit" class="btn btn-primary buttonMargin sendReportComment" 
								id="sendReportComment-$reportData">
								<i class="fa fa-mail-forward"></i> Send  </button> 
								
								<div class="display-none" id="wallCommentLoader-$reportData"> 
									<strong role="status">Processing...</strong>
									<div class="spinner-border ms-auto text-danger" aria-hidden="true"></div>
								</div>
							</div>
						</div> 
					</form>
					<!-- / form -->
				</div>
			</div> 

IGWEZE;
			echo $reportBoxDiv;	 

		} elseif (($_REQUEST['messageData']) == 'sendReport') { /* report mail script */ 

			try {
				 
				$title = clean($_REQUEST['msgTitle']);
				$recepName = $_REQUEST['recepName'];
				$recepID = $_REQUEST['recepID'];
				$report = clean($_REQUEST['message']);
				$mailID = $_REQUEST['mailID'];
				$mailType = $_REQUEST['mailType']; 
									
				$memberInfo = companionWallUserDetails($conn, $_SESSION['regNo'], $seVal);  /* retrieve student companion details */				
				list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic) = explode ("##", $memberInfo);
				  
				/* script validation */
				
				if($recepID == ''){
			
					$msg_e = "This Mail recepient cannot receive message. Thanks"; 
					echo $errorMsg.$msg_e.$eEnd; exit;					
										
				}elseif ($member_id == '') { 
				
					$msg_e = "You are not allow to post on Companion Wall. please contact your administrator for more info. Thanks"; 
					echo $errorMsg.$msg_e.$eEnd; exit;					
										
				}elseif ($title == '') { 
				
					$msg_e = "Ooops, please type your title"; 					
					echo $errorMsg.$msg_e.$eEnd; exit;					
										
				}elseif ($report == '') { 
				
					$msg_e = "Ooops, please type your message"; 					
					echo $errorMsg.$msg_e.$eEnd; exit;					
						
				}else{  /* validate and insert mail */ 
 
					$report = str_replace('<br />', "\n", $report); 
					$title = htmlspecialchars($title);
					$report = htmlspecialchars($report);   

					if($mailType == 'post') {
						list ($post_id, $rep_id) = explode ("_", $mailID); $comment_id = "";
						$repor_div = "$('.reportPostDiv_".$mailID."').fadeOut(1000);"; 
						$msgType = 1;
					}

					if($mailType == 'comment') {
						list ($post_id, $comment_id, $rep_id) = explode ("_", $mailID);
						$repor_div = "$('.reportCommentDiv_".$mailID."').fadeOut(1000);"; 
						$msgType = 2;
					}

					$ebele_mark = "INSERT INTO $fobrainMailReportTB (title, report, post_id, com_id, reporting, reported, 
																 rtype)

										VALUES (:title, :report, :post_id, :com_id, :reporting, :reported, 
												:rtype)";

					$igweze_prep = $conn->prepare($ebele_mark);

					$igweze_prep->bindValue(':title', $title);
					$igweze_prep->bindValue(':report', $report);
					$igweze_prep->bindValue(':post_id', $post_id);
					$igweze_prep->bindValue(':com_id', $comment_id);
					$igweze_prep->bindValue(':reporting', $member_id);
					$igweze_prep->bindValue(':reported', $recepID); 
					$igweze_prep->bindValue(':rtype', $msgType);
								
					if ($igweze_prep->execute()){  /* if successfully */  

                        $msg_s = "You successfully reported <b>$recepName</b> to school authority";  
                        echo $succesMsg.$msg_s.$sEnd;	 
					 
						echo "<script type='text/javascript'>
							$repor_div
						</script>";	 exit; 

					}else{  /* display error */
						
						$msg_e = "Ooops Something went wrong while sending your report, please try again";
						echo $errorMsg.$msg_e.$eEnd; exit;					
					
					} 
				
				} 
					
			}catch(PDOException $e) {
		
				fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
			}
				
		} elseif (($_REQUEST['messageData']) == 'sendWCReplyMail') {	/* reply mail script */ 

			try {

				$msgTitle = clean($_REQUEST['msgTitle']);
				$recepName = $_REQUEST['recepName'];
				$recepID = $_REQUEST['recepID'];
				$mailMsg = clean($_REQUEST['message']);
				$mailID = $_REQUEST['mailID'];
				$mailType = $_REQUEST['mailType'];
				$replyMsg = clean($_REQUEST['replyMsg']); 
									
				$memberInfo = companionWallUserDetails($conn, $_SESSION['regNo'], $seVal);  /* retrieve student companion details */				
				list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic) = explode ("##", $memberInfo);
				
				/* script validation */  
				
				if($recepID == ''){
			
					$msg_e = "This Mail recepient cannot receive message. Thanks"; 
					echo $errorMsg.$msg_e.$eEnd; exit;					
										
				}elseif ($member_id == '') { 
				
					$msg_e = "You are not allow to post on Companion Wall. please contact your administrator for more info. Thanks"; 
					echo $errorMsg.$msg_e.$eEnd; exit;					
										
				}elseif ($msgTitle == '') { 
				
					$msg_e = "Ooops, please type your title"; 					
					echo $errorMsg.$msg_e.$eEnd; exit;					
										
				}elseif ($mailMsg == '') { 
				
					$msg_e = "Ooops, please type your message"; 					
					echo $errorMsg.$msg_e.$eEnd; exit;					
						
				}else{  /* validate and insert mail */ 

					$time = strtotime(date("Y-m-d H:i:s"));
					$uip = $_SERVER['REMOTE_ADDR'];
					$mailMsg = str_replace('<br />', "\n", $mailMsg);
					
					$msgTitle = htmlspecialchars($msgTitle);
					$mailMsg = htmlspecialchars($mailMsg); 
					
					$msgTypefi = msgSentType($conn, $recepID);  /* retrieve companion sent mail type */
					$msgTypese = msgSentType($conn, $member_id);  /* retrieve companion sent mail type */						
					$msgType = returnMsgSentType($msgTypefi, $msgTypese);  /* return companion sent mail type */				
					

					$ebele_mark = "INSERT INTO $fobrainMailBoxTB (njnk_title, njnk_msg, njnk_time, njnk_status, njnk_sender_id, njnk_reps_id, 
																njnk_sender_ip, njnk_type)

										VALUES (:njnk_title, :njnk_msg, :njnk_time, :njnk_status, :njnk_sender_id, :njnk_reps_id, :njnk_sender_ip,
												:njnk_type)";

					$igweze_prep = $conn->prepare($ebele_mark);

					$igweze_prep->bindValue(':njnk_title', $msgTitle);
					$igweze_prep->bindValue(':njnk_msg', $mailMsg);
					$igweze_prep->bindValue(':njnk_time', $time);
					$igweze_prep->bindValue(':njnk_status', $foreal);
					$igweze_prep->bindValue(':njnk_sender_id', $member_id);
					$igweze_prep->bindValue(':njnk_reps_id', $recepID);
					$igweze_prep->bindValue(':njnk_sender_ip', $uip);
					$igweze_prep->bindValue(':njnk_type', $msgType);
								
					if ($igweze_prep->execute()){  /* if successfully */
					
						if(isset($replyMsg) == 'replyMsg'){
							
							$sentMsg = numOfSentMsg($conn, $member_id);	

							$msg_s = "Your mail was successfully Reply to <b>$recepName</b>"; 
							
							echo $succesMsg.$msg_s.$sEnd;								
							echo "<script type='text/javascript'> $('#replymsgBoxDiv').slideUp(800); 
							$('.SenttMsgNum').html('$sentMsg');	 </script>"; exit;

						}else{

							if($mailType == 'Post') {
								echo "<script type='text/javascript'>
										$('.postMailBoxDiv_".$mailID."').fadeOut(1000);
								</script>";	
							}

							if($mailType == 'Comment') {
								echo "<script type='text/javascript'> 
										$('.commentMailBoxDiv_".$mailID."').fadeOut(1000);
								</script>";	
							}
							
							$msg_s = "Your mail was successfully sent to <b>$recepName</b>"; 							
							echo $succesMsg.$msg_s.$sEnd; exit;
						
						}

					}else{  /* display error */
						
						$msg_e = "Ooops Something went wrong while sending your mail, please try again";
						echo $errorMsg.$msg_e.$eEnd; exit;					
					
					} 
				
				}
			
					
			}catch(PDOException $e) {
		
				fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
			}
				
		} elseif (($_REQUEST["messageData"]) == 'sendNjidekaMail') {	/* send mail scripts */

			try {

				$msgEmail = $_REQUEST['msgEmail'];
				$msgTitle = clean($_REQUEST['msgTitle']);
				$mailMsg = clean($_REQUEST['message']);
				$member_id = clean($_REQUEST['memberID']);
				
				$recepID = emailValidator($conn, $msgEmail);  /* check if email exits or not */
				
				/* script validation */
				
				if($recepID == ''){

					$msg_e = "Cannot send this mail, however this email do not exists. Thanks"; 
					echo $errorMsg.$msg_e.$eEnd; exit;					

				}elseif ($member_id == '') { 

					$msg_e = "You are not allow to send mail. please contact your administrator for more info. Thanks"; 
					echo $errorMsg.$msg_e.$eEnd; exit;					

				}elseif ($member_id == $recepID) { 

					$msg_e = "Ooops, You cannot send mail to yourself. Thanks"; 
					echo $errorMsg.$msg_e.$eEnd; exit;					

				}elseif ($msgTitle == '') { 

					$msg_e = "Ooops, please type your mail title"; 
					echo $errorMsg.$msg_e.$eEnd; exit;					

				}elseif ($mailMsg == '') { 

					$msg_e = "Ooops, please type your mail message"; 
					echo $errorMsg.$msg_e.$eEnd; exit;					
					
				}else{  /* validate and insert mail */

					$time = strtotime(date("Y-m-d H:i:s"));
					$uip = $_SERVER['REMOTE_ADDR'];
					$mailMsg = str_replace('<br />', "\n", $mailMsg);
					
					$msgTitle = htmlspecialchars($msgTitle);
					$mailMsg = htmlspecialchars($mailMsg);

					$ebele_mark = "INSERT INTO $fobrainMailBoxTB (njnk_title, njnk_msg, njnk_time, njnk_status, njnk_sender_id, njnk_reps_id, 
																njnk_sender_ip, njnk_type)

										VALUES (:njnk_title, :njnk_msg, :njnk_time, :njnk_status, :njnk_sender_id, :njnk_reps_id, :njnk_sender_ip,
												:njnk_type)";

					$igweze_prep = $conn->prepare($ebele_mark);

					$igweze_prep->bindValue(':njnk_title', $msgTitle);
					$igweze_prep->bindValue(':njnk_msg', $mailMsg);
					$igweze_prep->bindValue(':njnk_time', $time);
					$igweze_prep->bindValue(':njnk_status', $foreal);
					$igweze_prep->bindValue(':njnk_sender_id', $member_id);
					$igweze_prep->bindValue(':njnk_reps_id', $recepID);
					$igweze_prep->bindValue(':njnk_sender_ip', $uip);
					$igweze_prep->bindValue(':njnk_type', $foreal); 
					
					if ($igweze_prep->execute()){  /* if successfully */
					
						$sentMsg = numOfSentMsg($conn, $member_id);  /* number of user sent mail */

						echo "<script type='text/javascript'> var Empty = '';
								$('#showSuccessSent').show(); 
								$('#showSuccessSent').fadeOut(18000); 
								$('.SenttMsgNum').html('$sentMsg');	
								$('#inboxmsgBoxDiv').fadeOut(1000);
								$('.showInbox').trigger('click');
								$('#msgEmail').val(Empty);
								$('#msgTitle').val(Empty);
								$('#Message').val(Empty);
						</script>"; exit;	


					}else{  /* display error */
						
						$msg_e = "Ooops Something went wrong while sending your mail, please try again";
						echo $errorMsg.$msg_e.$eEnd; exit;					
					
					}   
				} 
					
			}catch(PDOException $e) {
		
				fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
			}
				
		} elseif (($_REQUEST["messageData"])  == 'saveDraftMail') {	/*  draft mail script */

			try { 
						
				$msgTitle = $_REQUEST['msgTitle'];
				$mailMsg = $_REQUEST['mailMsg'];
				$member_id = clean($_REQUEST['memberID']);

				/* script validation */
				
				if ($msgTitle == '') { 

					$msg_e = "Ooops, please type your mail title";
					echo $errorMsg.$msg_e.$eEnd; exit;					

				}elseif ($member_id == '') { 

					$msg_e = "You are not allow to send mail. please contact your administrator for more info. Thanks"; 
					echo $errorMsg.$msg_e.$eEnd; exit;					

				}elseif ($mailMsg == '') { 

					$msg_e = "Ooops, please type your mail message"; 
					echo $errorMsg.$msg_e.$eEnd; exit;					
					
				}else{  /* validate and draft mail  */

					$time = strtotime(date("Y-m-d H:i:s"));
					$uip = $_SERVER['REMOTE_ADDR'];
					$mailMsg = str_replace('<br />', "\n", $mailMsg);
					
					$msgTitle = htmlspecialchars($msgTitle);
					$mailMsg = htmlspecialchars($mailMsg);

					$ebele_mark = "INSERT INTO $fobrainMailBoxTB (njnk_title, njnk_msg, njnk_time, njnk_status, njnk_reps_id, njnk_sender_ip, njnk_type)

										VALUES (:njnk_title, :njnk_msg, :njnk_time, :njnk_status, :njnk_reps_id, :njnk_sender_ip, :njnk_type)";

					$igweze_prep = $conn->prepare($ebele_mark);

					$igweze_prep->bindValue(':njnk_title', $msgTitle);
					$igweze_prep->bindValue(':njnk_msg', $mailMsg);
					$igweze_prep->bindValue(':njnk_time', $time);
					$igweze_prep->bindValue(':njnk_status', $foreal);
					$igweze_prep->bindValue(':njnk_reps_id', $member_id);
					$igweze_prep->bindValue(':njnk_sender_ip', $uip);
					$igweze_prep->bindValue(':njnk_type', $thVal); 
								
					if ($igweze_prep->execute()){  /* if successfully */
					
						$draftMsg = numOfDraftMsg($conn, $member_id);

						echo "<script type='text/javascript'> var Empty = '';
									$('#showSuccessDraft').show(); 
									$('#showSuccessDraft').fadeOut(18000); 
									$('.draftMsgNum').html('$draftMsg');	
									$('#inboxmsgBoxDiv').fadeOut(1000);
									$('.showInbox').trigger('click');
									$('#msgEmail').val(Empty);
									$('#msgTitle').val(Empty);
									$('#Message').val(Empty);
							</script>"; exit;	


					}else{
						
						$msg_e = "Ooops Something went wrong while saving your mail, please try again";
						echo $errorMsg.$msg_e.$eEnd; exit;					
					
					}
				
				
				}
			
					
			}catch(PDOException $e) {
		
				fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
			}
				
		} elseif (($_REQUEST["messageData"]) == 'showInboxMsg'){	/* show inbox script */

			$member_id = clean($_REQUEST['memberID']);
	
			try {
					
				if(isset($_SESSION['wallComRank'])){
					
					companionInbox($conn, $member_id, $seVal, $i_false);  /* load companion inbox information */
					
				}else{
					
					companionInbox($conn, $member_id, $fiVal, $i_false);  /* load companion inbox information */
					
				}
				
			}catch(PDOException $e) {
		
				fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
			}
								
		} elseif (($_REQUEST["messageData"]) == 'showSentMsg'){	/* show sent mail */

			$member_id = clean($_REQUEST['memberID']);
	
			try { 
			
				companionSentMsg($conn, $member_id, $i_false);  /* load sent mail */
						
			}catch(PDOException $e) {
		
				fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
			}					
				
		} elseif (($_REQUEST["messageData"]) == 'showAdminMail'){	/* show admin mail */

			$member_id = clean($_REQUEST['memberID']);
	
			try {		 				
			
				companionInbox($conn, $member_id, $seVal, $i_false);   /* load companion inbox information */
						
			}catch(PDOException $e) {
		
				fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
			}		
				
		} elseif (($_REQUEST["messageData"]) == 'showDraftMail'){	/* show draft mail */

			$member_id = clean($_REQUEST['memberID']);
	
			try {		 				
			
				companionInbox($conn, $member_id, $thVal, $i_false);   /* load companion inbox information */
						
			}catch(PDOException $e) {
		
				fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
			} 			
				
		} elseif (($_REQUEST["messageData"]) == 'showTrashMail'){	/* show trash mail */

			$member_id = clean($_REQUEST['memberID']);
	
			try {		 				
			
				companionInbox($conn, $member_id, $foVal, $i_false);  /* load companion inbox information */
						
			}catch(PDOException $e) {
		
				fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
			} 			
				
		} elseif (($_REQUEST["messageData"]) == 'trashMailView'){	/* trash mail script */

			$msgID = clean($_REQUEST['msgID']);
			$member_id = clean($_REQUEST['memberID']);
			
			if (($msgID == '') || ($member_id == '')){
														 
					$msg_e = "Ooops Something went wrong while tring to trash your mail, please try again";
			   		echo $errorMsg.$msg_e.$eEnd; exit; 
					
	        }else{
		
				try {
					
					$msgType =  msgTypeStatus($conn, $msgID);  /* retrieve companion inbox mail type */

					$ebele_mark = "UPDATE $fobrainMailBoxTB 
					
									SET 
								
									njnk_type = :njnk_type,
									njnk_trash = :njnk_trash

									WHERE msg_id = :msg_id
									
									AND njnk_reps_id = :njnk_reps_id";
									
					$igweze_prep = $conn->prepare($ebele_mark);	
				
					$igweze_prep->bindValue(':njnk_reps_id', $member_id);
					$igweze_prep->bindValue(':njnk_type', $foVal);
					$igweze_prep->bindValue(':njnk_trash', $msgType);
					$igweze_prep->bindValue(':msg_id', $msgID);
					
					if($igweze_prep->execute()){

						if(isset($_SESSION['wallComRank'])){
						
							companionInbox($conn, $member_id, $seVal, $i_false);   /* load companion inbox information */
						
						}else{
						
							companionInbox($conn, $member_id, $fiVal, $i_false);   /* load companion inbox information */
						
						}
					
						$trashMsg = numOfTrashMsg($conn, $member_id);  /* number of trash mail */							
						echo  "<script type='text/javascript'> $('.TrashMsgNum').html('$trashMsg');	 </script>";
						
					}else{
						
						$msg_e = "Ooops Something went wrong while tring to trash your mail, please try again";
						echo $errorMsg.$msg_e.$eEnd; exit;

					}	
									   
				}catch(PDOException $e) {
  			
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			 
				}
				
				
			} 				
				
		} elseif (($_REQUEST["messageData"]) == 'viewNkirukaMail'){	/* view email script */

			$msgID = clean($_REQUEST['msgID']);
			$member_id = clean($_REQUEST['memberID']);
			$sender_id = clean($_REQUEST['senderID']);				
			viewCompanionMail($conn, $msgID, $member_id, $sender_id);  /* view companion mail */
				
		} elseif (($_REQUEST["messageData"]) == 'viewNkirukaSentMail'){	/* view sent email script */

			$msgID = clean($_REQUEST['msgID']);
			$member_id = clean($_REQUEST['memberID']);
			
			/* script validation */
			
			if (($msgID == '') || ($member_id == '')){
														 
					$msg_e = "Ooops Something went wrong while tring to retrieve your sent mail, please try again";
			   		echo $errorMsg.$msg_e.$eEnd; exit; 
					
	        }else{  /* select sent mail */
				
			
				try { 
			
					$ebele_mark = "SELECT msg_id, njnk_title, njnk_msg, njnk_time, njnk_status, njnk_sender_id, njnk_reps_id, njnk_type
					
									FROM $fobrainMailBoxTB
									
									WHERE njnk_sender_id = :njnk_sender_id
									
									AND msg_id = :msg_id";

					$igweze_prep = $conn->prepare($ebele_mark);	 
					$igweze_prep->bindValue(':njnk_sender_id', $member_id);
					$igweze_prep->bindValue(':msg_id', $msgID);
				
					$igweze_prep->execute();
			
					$rows_count = $igweze_prep->rowCount(); 
			
					if($rows_count == $foreal) {							
					
						while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
	
							$msg_id = $row['msg_id'];
							$njnk_title = $row['njnk_title'];
							$njnk_msg = $row['njnk_msg'];
							$njnk_time = $row['njnk_time'];
							$njnk_status = $row['njnk_status'];
							$njnk_sender_id = $row['njnk_sender_id'];
							$njnk_reps_id = $row['njnk_reps_id'];
							$njnk_type = $row['njnk_type'];
						}
						$memberInfo = companionWallUserDetails($conn, $njnk_reps_id, $fiVal);  /* retrieve student companion details */
				
						list ($senderID, $faRegNum, $m_name, $m_sex, $prof_pic, $m_dept, $m_faculty, $userMail, 
						$wallPic, $load_page) = explode ("##", $memberInfo);									
						
						$njnk_title = htmlspecialchars_decode($njnk_title);
						$njnk_msg = htmlspecialchars_decode($njnk_msg);					
					
						$njnk_msg = nl2br($njnk_msg);
						
						$msgTime = wallTimerBoy($njnk_time);  /* companion wall time ago */
						$msgTime = date("F d, Y h:i:s", $njnk_time); 

						$senderPic = picture($forumPicExt, $prof_pic, "student");

						if($userMail == '-'){
				
							$senderMail = '';
				
						}else{
				
							$senderMail = '['.$userMail.'@fobrain.com]';
				
						}
							
						echo "<script type='text/javascript'> $('#mailTopTitle').html('View Sent Message');
																	$('#mailTitleHolder').html('View Sent Message');</script>";

$nkiruViewBox =<<<IGWEZE
					<div id="fobrain-print">	
                      	<div class="inbox-body" id="inboxmsgBoxDiv">
							<div class="heading-inbox row">
								<div class="col-md-8">
									<div class="compose-btn">
										
										<button title="" data-placement="top" data-toggle="tooltip" type="button" id="printer-btn"
										data-original-title="Print" class="btn btn-sm tooltips"><i class="fa fa-print"></i> </button>
										
									</div>

								</div>
								<div class="col-md-4 text-right">
									<p class="date"> $msgTime </p>
								</div>
								<div class="col-md-12">
									<h4> $njnk_title </h4>
								</div>
							</div>
							
						<div class="sender-info">
							<!-- row -->	
						<div class="row">  
									<div class="col-md-12">
										
										From <strong> Me</strong>
										to
										<img src="$senderPic" height="60px" width="64px" alt="Mail Sender Picture">
										<strong>$m_name</strong>
										<span>$senderMail</span>
										
										<a class="sender-dropdown " href="javascript:;">
											<i class="fa fa-chevron-down"></i>
										</a>
									</div>
								</div>
							</div>
							<div class="view-mail">
								$njnk_msg
							</div>  
						</div> 
					</div>


IGWEZE;
						
					
					echo $nkiruViewBox;
			
					}else{  /* display error */
					
						$msg_e = "Ooops Something went wrong while tring to retrieve your sent mail, please try again";
						echo $errorMsg.$msg_e.$eEnd; exit; 

					}
			
			   						
				}catch(PDOException $e) {
  			
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			 
				}
				
			}			
				
		} elseif (($_REQUEST["messageData"]) == 'paginateMail'){	/* paginate mail script */ 	

			$member_id = clean($_REQUEST['memberID']);
			$inboxType = $_REQUEST['inboxType'];
			$offSetVal = $_REQUEST['offsetVal'];
			$totalCount = $_REQUEST['totalCount'];
			
			$nextPageOff = $offSetVal + 10;
			$prevPageOff = $offSetVal - 10;
			$pagiNext = $offSetVal + $fiVal;
			$nextPage = $offSetVal + 10;
			
			if($totalCount <= 10){

				$nextPage = $totalCount;
				$pagiDetail = $pagiNext.'-'.$nextPage;

				echo  "<script type='text/javascript'> $('.prevMailBtn').fadeOut(10);  $('.nextMailBtn').fadeOut(10); 
												   
												   $('#pagiDetailsDiv').html('$pagiDetail');
				</script>";
				  
				  
			}else{
				
				if($nextPageOff > $totalCount){ $nextPage = $totalCount; }

				$pagiDetail = $pagiNext.'-'.$nextPage;
				
				if($prevPageOff <= $i_false){
					
						echo  "<script type='text/javascript'> $('.prevMailBtn').fadeOut(10);  $('.nextMailBtn').fadeIn(10); 
													   $('#prevPageDiv').html('');	
													   $('#pagiDetailsDiv').html('$pagiDetail'); $('#nextPageDiv').html('10');
						</script>";			
				
				}else{
				
						echo  "<script type='text/javascript'> $('#nextPageDiv').html('$nextPageOff'); $('#prevPageDiv').html('$prevPageOff'); 
													   $('#pagiDetailsDiv').html('$pagiDetail'); 
						</script>";
				
				}
				
				if($nextPageOff > $totalCount){
					
						echo  "<script type='text/javascript'> $('.nextMailBtn').fadeOut(10); $('.prevMailBtn').fadeIn(10); </script>";
				
				}
			
			}
		
			try {
					
				if($offSetVal == '') {$offSetVal = $i_false; }
				
				if (($inboxType != '') && ($inboxType != $fiVal)){
					
					$ebele_mark_1 = "SELECT msg_id, njnk_title, njnk_msg, njnk_time, njnk_status, njnk_sender_id, njnk_reps_id, njnk_type
					
									FROM $fobrainMailBoxTB
									
									WHERE njnk_reps_id = :njnk_reps_id
									
									AND  njnk_type = :njnk_type
									
									ORDER BY njnk_time ASC
									
									LIMIT 10 OFFSET $offSetVal";

					$igweze_prep_1 = $conn->prepare($ebele_mark_1);	 
					$igweze_prep_1->bindValue(':njnk_reps_id', $member_id);
					$igweze_prep_1->bindValue(':njnk_type', $inboxType);
						
				}else{

					$ebele_mark_1 = "SELECT msg_id, njnk_title, njnk_msg, njnk_time, njnk_status, njnk_sender_id, njnk_reps_id, njnk_type
					
									FROM $fobrainMailBoxTB
									
									WHERE njnk_reps_id = :njnk_reps_id
									
									AND  njnk_type = :njnk_type
									
									ORDER BY njnk_time ASC
									
									LIMIT 10 OFFSET $offSetVal";

					$igweze_prep_1 = $conn->prepare($ebele_mark_1);	 
					$igweze_prep_1->bindValue(':njnk_reps_id', $member_id);
					$igweze_prep_1->bindValue(':njnk_type', $fiVal); 
				
				}
						
				$igweze_prep_1->execute();
		
				$rows_count_1 = $igweze_prep_1->rowCount(); 

				if($rows_count_1 >= $foreal) {  /* select email */

					echo '<div class="table-responsive">
					<table class="table table-inbox table-hover table-responsive"> <tbody>';
					
					while($row_1 = $igweze_prep_1->fetch(PDO::FETCH_ASSOC)) {		

						$msg_id = $row_1['msg_id'];
						$njnk_title = $row_1['njnk_title'];
						$njnk_msg = $row_1['njnk_msg'];
						$njnk_time = $row_1['njnk_time'];
						$njnk_status = $row_1['njnk_status'];
						$njnk_sender_id = $row_1['njnk_sender_id'];
						$njnk_reps_id = $row_1['njnk_reps_id'];
						$njnk_type = $row_1['njnk_type'];
						
						$msgData = $msg_id.'-'.$njnk_reps_id.'-'.$njnk_sender_id;
						
						$memberInfo = companionWallUserDetails($conn, $njnk_sender_id, $fiVal);  /* retrieve student companion details */
			
						list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic, $m_dept, $m_faculty, $userMail, 
						$wallPic, $load_page) = explode ("##", $memberInfo);				

						if($njnk_type == $thVal) { $m_name = '*';}
						if($njnk_status == $fiVal){ $msgStatus = 'unread'; $starIcon = 'fa fa-star inbox-started'; $ckeckRU = 'checkUnread';}
						else { $msgStatus = ''; $starIcon = 'fa fa-star'; $ckeckRU = 'checkRead'; }	
						
						if($njnk_type == $seVal){ $admicIcon = '<span class="label label-danger pull-right">admin</span>'; 
													$chkAdmin = 'checkAdminMsg'; }
						else{ $admicIcon = ''; $chkAdmin ='';}
						
						$msgTime = wallTimerBoy($njnk_time);  /* companion wall time ago */
						$msgTime = date("F d, Y", $njnk_time);
						
					
$nkirumsgBox =<<<IGWEZE
						
						<tr class="$msgStatus" id="mailRowID-$msg_id">
							<td class="inbox-small-cells text-right" width="5%">
								<input type="checkbox" class="mail-checkbox mailCheckBox $chkAdmin $ckeckRU" 
								value='$msg_id' name="chkmailID-$msg_id" id="chkmailID-$msg_id">
							</td>
							<td class="inbox-small-cells readMail" id="readMail-$msgData" width="5%">
							<span id="starIconMail-$msg_id"><i class="$starIcon"></i></span></td>
							<td class="view-message  dont-show readMail" id="readMail-$msgData" width="30%">$m_name 
							$admicIcon</td>
							<td class="view-message readMail" id="readMail-$msgData" width="40%"> $njnk_title   </td>
							<td class="view-message  inbox-small-cells readMail" id="readMail-$msgData"></td>
							<td class="view-message  text-right readMail" id="readMail-$msgData" width="20%"> 
							$msgTime</td>
						</tr>	
		

IGWEZE;
			
				
						echo $nkirumsgBox;
					
					
					}
						
						echo '</tbody>
							</table></div>';
				
				}else{  /* display error */
				
					$msg_e = "Ooops Something went wrong while tring to retrieve your mail, please try again";
					echo $errorMsg.$msg_e.$eEnd; exit;
					
				} 

			}catch(PDOException $e) {
		
				fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
			}
								
				
		} elseif (($_REQUEST["messageData"]) == 'paginateSentMail'){	/* paginate sent email */

			$member_id = clean($_REQUEST['memberID']);
			$offSetVal = $_REQUEST['offsetVal'];
			$totalCount = $_REQUEST['totalCount'];
			
			$nextPageOff = $offSetVal + 10;
			$prevPageOff = $offSetVal - 10;
			$pagiNext = $offSetVal + $fiVal;
			$nextPage = $offSetVal + 10;
			
			if($totalCount <= 10){

				$nextPage = $totalCount;
				$pagiDetail = $pagiNext.'-'.$nextPage;

				echo  "<script type='text/javascript'> $('.prevMailSentBtn').fadeOut(10);  $('.nextMailBtn').fadeOut(10); 
												   
												   $('#pagiDetailsDiv').html('$pagiDetail');
				  </script>";
				  
				  
			}else{
				
				if($nextPageOff > $totalCount){ $nextPage = $totalCount; }

				$pagiDetail = $pagiNext.'-'.$nextPage;
				
				if($prevPageOff <= $i_false){
					
					echo  "<script type='text/javascript'> $('.prevMailSentBtn').fadeOut(10);  $('.nextMailSentBtn').fadeIn(10); 
													   $('#prevPageDiv').html('');	
													   $('#pagiDetailsDiv').html('$pagiDetail'); $('#nextPageDiv').html('10');
					 </script>";			
				
				}else{
				
					echo  "<script type='text/javascript'> $('#nextPageDiv').html('$nextPageOff'); $('#prevPageDiv').html('$prevPageOff'); 
													   $('#pagiDetailsDiv').html('$pagiDetail'); 
					</script>";
				
				}
				
				if($nextPageOff > $totalCount){
					
					echo  "<script type='text/javascript'> $('.nextMailBtn').fadeOut(10); $('.prevMailBtn').fadeIn(10); </script>";
				
				}
			
			}
		
			try {
							
				if($offSetVal == '') {$offSetVal = $i_false; } 
				
					$ebele_mark_1 = "SELECT msg_id, njnk_title, njnk_msg, njnk_time, njnk_status, njnk_sender_id, njnk_reps_id, njnk_type
					
									FROM $fobrainMailBoxTB
									
									WHERE njnk_sender_id = :njnk_sender_id
									
									ORDER BY njnk_time ASC
									
									LIMIT 10 OFFSET $offSetVal";

					$igweze_prep_1 = $conn->prepare($ebele_mark_1);	 
					$igweze_prep_1->bindValue(':njnk_sender_id', $member_id);						
					
					$igweze_prep_1->execute();
			
					$rows_count_1 = $igweze_prep_1->rowCount(); 

					if($rows_count_1 >= $foreal) {  /* select email */

						echo '<div class="table-responsive">
						<table class="table table-inbox table-hover table-responsive"> 
						<tbody>';
						
						while($row_1 = $igweze_prep_1->fetch(PDO::FETCH_ASSOC)) {		

							$msg_id = $row_1['msg_id'];
							$njnk_title = $row_1['njnk_title'];
							$njnk_msg = $row_1['njnk_msg'];
							$njnk_time = $row_1['njnk_time'];
							$njnk_status = $row_1['njnk_status'];
							$njnk_sender_id = $row_1['njnk_sender_id'];
							$njnk_reps_id = $row_1['njnk_reps_id'];
							$njnk_type = $row_1['njnk_type'];
							
							$msgData = $msg_id.'-'.$njnk_sender_id;
							
							$memberInfo = companionWallUserDetails($conn, $njnk_sender_id, $fiVal);  /* retrieve student companion details */
				
							list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic, $m_dept, $m_faculty, $userMail, 
							$wallPic, $load_page) = explode ("##", $memberInfo);			
							
							if($njnk_status == $fiVal){ $msgStatus = 'unread'; $starIcon = 'fa fa-star inbox-started'; $ckeckRU = 'checkUnread';}
							else { $msgStatus = ''; $starIcon = 'fa fa-star'; $ckeckRU = 'checkRead'; }	
							
							if($njnk_type == $seVal){ $admicIcon = '<span class="label label-danger pull-right">admin</span>'; 
														$chkAdmin = 'checkAdminMsg'; }
							else{ $admicIcon = ''; $chkAdmin ='';}
							
							$msgTime = wallTimerBoy($njnk_time);  /* companion wall time ago */
							$msgTime = date("F d, Y", $njnk_time);
						
					
$nkirumsgBox =<<<IGWEZE
					
							<tr class="$msgStatus" id="mailRowID-$msg_id">
								<td class="inbox-small-cells text-right" width="5%">
								</td>
								<td class="inbox-small-cells readNkirukaSentMail" id="readNkirukaSentMail-$msgData" width="5%">
								<span id="starIconMail-$msg_id"><i class="$starIcon"></i></span></td>
								<td class="view-message  dont-show readNkirukaSentMail" id="readNkirukaSentMail-$msgData" width="30%">$m_name 
								$admicIcon</td>
								<td class="view-message readNkirukaSentMail" id="readNkirukaSentMail-$msgData" width="40%"> $njnk_title   </td>
								<td class="view-message  inbox-small-cells readNkirukaSentMail" id="readNkirukaSentMail-$msgData"></td>
								<td class="view-message  text-right readNkirukaSentMail" id="readNkirukaSentMail-$msgData" width="20%"> 
								$msgTime</td>
							</tr>	 

IGWEZE;
		
			
						echo $nkirumsgBox;
				
				
					}
			
					echo '</tbody>
						</table></div>';
			
				}else{  /* display error */
				
					$msg_e = "Ooops Something went wrong while tring to retrieve your mail, please try again";
					echo $errorMsg.$msg_e.$eEnd; exit;
					
				}
				


			}catch(PDOException $e) {
		
				fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
			}
								
				
		}else{ exit; }  exit; 
?>