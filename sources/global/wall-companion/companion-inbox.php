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
	
*/ 

if(!session_id()){
    session_start();
}

		if (!defined('fobrain')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');

		if(isset($_SESSION['wallComRank'])){	
		
			require 'fobrain-config-s.php';  /* load fobrain configuration files */	  
			
		}else{
			
			require 'fobrain-config.php';  /* load fobrain configuration files */	 
			
		}
	
	 	require_once ($fobrainCWallFunctionDir);  /* load companion functions */	 

		try {
				
			//checkWallRegistration($conn); /* check if student is registered */
								
			$memberInfo = companionWallUserDetails($conn, $_SESSION['regNo'], $seVal);  /* retrieve student companion details */
			
			list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic, $m_dept, $m_faculty, $userMail, 
					$wallPic, $load_page) = explode ("##", $memberInfo);

			if(isset($_SESSION['wallComRank'])){	

				$unreadMsg = numOfUnreadMsgAdmin($conn, $member_id); /* retrieve number of admin unread message */
				
			}else{
				
				$unreadMsg = numOfUnreadMsg($conn, $member_id);	 /* retrieve number of unread message */
				$adminMsg = numOfAdminMsg($conn, $member_id); /* retrieve number of admin unread message */
				
			}

			$draftMsg = numOfDraftMsg($conn, $member_id); /* retrieve number of draft message */
			
			$trashMsg = numOfTrashMsg($conn, $member_id); /* retrieve number of trash message */
			
			$sentMsg = numOfSentMsg($conn, $member_id); /* retrieve number of sent message */
			
			$unreadMsgNum = '<span class="badge bg-danger ms-1  inboxMsgNum">'.$unreadMsg.'</span>';

			$draftMsgNum = '<span class="badge bg-danger draftMsgNum">'.$draftMsg.'</span>';
			
			$adminMsgNum = '<span class="badge bg-danger adminMsgNum">'.$adminMsg.'</span>'; 
			
			$sentMsgNum = '<span class="badge bg-danger SenttMsgNum">'.$sentMsg.'</span>';
			
			$trashMsgNum = '<span class="badge bg-danger TrashMsgNum">'.$trashMsg.'</span>'; 
			

			}catch(PDOException $e) {
		
				fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
			}

			if($userMail == '-'){
			
				$myMail = ' 
				<button type="button" class="btn btn-dark btn-label waves-light modal-mail-div component-free"  
				data-bs-toggle="modal" data-bs-target="#modal-mail-div">
					<i class="mdi mdi-email-outline label-icon"></i> 
					Get Email
				</button>'; 
			
			}else{
			
				$fobrainMail = $userMail.'@fobrain.com';
				$myMail = '
				<button type="button" class="btn btn-dark waves-effect waves-light component-free">
				<i class="mdi mdi-email-outline label-icon"></i>'.$fobrainMail.'</button>';
			
			}
			
			if(isset($_SESSION['wallComRank'])){	

				try { 

					$userInfo = staffData($conn, $_SESSION['adminID']);  /* school staffs/teachers information */             
					list ($title, $userName, $userSex, $userRank, $user_picture, $userLName) = 
					explode ("#@s@#", $userInfo);	
					
					$titleVal = wizSelectArray($title, $title_list);                
					$staff_t_name = $titleVal.' '.$userLName;
					$staff_img = picture($staff_pic_ext, $user_picture, "staff"); 
					$userTag = wizSelectArray($_SESSION['accessLevel'], $adminRankingArr);

					$wall_name = "$staff_t_name";
					$comp_name = "$staff_t_name"; //  - $userTag
					$gender_gl =  $userSex;
					$profile_img = $staff_img;


				}catch(PDOException $e) {
			
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
				
				}   
			
			}else{ 

				$profile_img = picture($forumPicExt, $prof_pic, "student"); 
			
			} 
			
			$showInboxBtn = 'showInboxMsg-'.$member_id;
			$showSentMailBtn = 'showSentMail-'.$member_id;
			$showAdminMailBtn = 'showAdminMail-'.$member_id;
			$showDraftMailBtn = 'showDraftMail-'.$member_id;
			$showTrashMailBtn = 'showTrashMail-'.$member_id;
						
		
?>	

		<script type="text/javascript">
		
			<?php 				
				if(isset($_SESSION['wallComRank'])){	
				
					echo "$('.showAdminMail').fadeOut('fast');";
				
				}
			?>

		</script>		 
		<!-- input style --> 
		<style>
			input[type="checkbox"] {
			display:inline;
			} 
			input[type="radio"] {
				display:inline;
			} 					
		</style>
		<!-- / input style -->  

		<!-- row -->
		<div <?php echo $fob_view; ?> class="row gutters row-section">
			<div class="col-12">	
				<!-- card start -->
				<div class="card-qq"> 					
					<div class="card-body-qq"> 
						<!--mail inbox start--> 
						<div class="mail-box"> 
							<aside class="sm-side"> 
								<div id="showSuccessSent" class="display-none">
								   <?php 
										$msg = "<strong> Your mail was successfully sent </strong>";  
										echo $succMsg.$msg.$msgEnd; 
									?>
								</div> 
								<div id="showSuccessDraft" class="display-none">
									<?php 
										$msg = "<strong> Your mail was successfully save as draft</strong>"; 							
										echo $succMsg.$msg.$msgEnd; 
									?>
								</div> 
								<div class="inbox-side mb-10"> 
									<a class="btn btn-compose  component-free" id="composeMsg" href="javascript:;">
										<i class="mdi mdi-email-edit fs-20"></i> Compose
									</a> 
								</div>
								<ul class="inbox-nav inbox-divider  pb-50">
									<li class="active showInbox" id="<?php echo $showInboxBtn;?>">
										<a href="javascript:;">
											<i class="mdi mdi-inbox align-middle "></i> Inbox  <?php echo $unreadMsgNum; ?> 
										</a> 
									</li> 
									<li class="showAdminMail" id="<?php echo $showAdminMailBtn;?>">
										<a href="javascript:;">
											<i class="mdi mdi-account-tie align-middle "></i> Admin Mail <?php echo $adminMsgNum; ?>
										</a>
									</li>
									<li id="<?php echo $showSentMailBtn;?>" class="showSentMail">
										<a href="javascript:;">
											<i class="mdi mdi-email-send-outline align-middle "></i> Sent Mail <?php echo $sentMsgNum; ?>
										</a>
									</li>
									<li id="<?php echo $showDraftMailBtn;?>" class="showDraftMail">
										<a href="javascript:;">
											<i class="mdi mdi-content-save align-middle "></i> Drafts  <?php echo $draftMsgNum; ?> 
										</a>
									</li>
									<li id="<?php echo $showTrashMailBtn;?>" class="showTrashMail">
										<a href="javascript:;">
											<i class="mdi mdi-trash-can-outline align-middle "></i> Trash <?php echo $trashMsgNum; ?>
										</a>
									</li>
								</ul> 
							</aside> 
							<aside class="lg-side scrollMailTarget"> 
								<div class="inbox-head"> 
									<div class="row">
										<div class="col-xl-8 col-lg-8 col-md-12 col-sm-12">
											<h3>
												<div id="mailTopTitle"> Companion  Inbox </div> 
												<div id="mailTitleHolder" class="display-none"> </div>
											</h3>											  
										</div>
										<div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 text-end hide-res inbox-head-right">
											<h5><a href="javascript:;"><div id="comp-usermail-div"><?php echo $myMail; ?> </div></a></h5> 
										</div>
									</div>
								</div>
								  
								<div class="row display-none" id="composeMsgBoxDiv"> 
									<div class="col-lg-12"> 
										<div class="card"> 
											<div class="card-body" style="background: #FFFAF0 !important;">										  
												<div id="msgBoxInfo"> </div>	 
												<!-- form -->
												<form class="form-horizontal" id="frmsendNjidekaMail" role="form"> 
													<div class="text-center sendMsgLoader" id="wait" style="display: none;">
														<div class="spinner-border text-danger" role="status">
															<span class="visually-hidden">Loading...</span>
														</div>
													</div> 
													<div class="row my-15">	   
														<div class="col-6 text-left"> 
															<button class="btn btn-sm btn-dark  waves-effecta 
															btn-label waves-light" id="saveDraftMsg"><i class="far fa-save label-icon"></i> 
																Save <span class="hide-res">As Draft </span>
															</button>	
															<span class="display-none" id="frmmemberID"> <?php echo $member_id; ?></span> 
														</div>
														<div class="col-6  text-end">
															<button class="btn btn-sm btn-danger waves-effecta 
															btn-label waves-light" id="cancelComposeMsg"><i class="fas fa-times label-icon"></i> 
																Cancel 
															</button>	  
														</div>
													</div>	 
													<div class="col-lg-12 mt-10">
														<input type="email" class="form-control" placeholder="Email address" 
														name="msgEmail" id="msgEmail" required />  
													</div> 
													<div class="col-lg-12 mt-10">
														<input type="text" class="form-control" placeholder="Message Title" 
														name="msgTitle" id="msgTitle"/>
													</div>  
													<div class="col-lg-12 mt-10">
														<textarea class="form-control p-10" name="Message" id="Message"
														style="text-align:justify !important;"
														placeholder="Message" rows="10"></textarea> 
													</div>   
													<div class="col-lg-12 text-end mt-15"> 
														<input type="hidden" name="memberID" value="<?php echo $member_id; ?>" />
														<input type="hidden" name="messageData" value="sendNjidekaMail" />														
														<button type="submit" class="btn btn-primary btn-label waves-light" 
														id="sendNjidekaMail">
														<i class="bx bx-send label-icon"></i> 
															Send
														</button> 
													</div> 
												</form>
												<!-- / form --> 
											</div> 
										</div> 
									</div> 
								</div>
										  
								<div id="mailMsgBox"> </div>
		 
								<div id="njidekaNkirukaDiv" class="mail-box-msg">		
								<?php
	 
									try {
									
										if (isset($_REQUEST["viewMailTop"])){

											$mailData = $_REQUEST['viewMailTop'];
											list ($msgID, $member_id, $sender_id) = explode ("-", $mailData);
						
											viewCompanionMail($conn, $msgID, $member_id, $sender_id);  /* load companion mail */
											
											echo "<script type='text/javascript'> 
												$('#mailTopTitle').html('Companion Inbox'); 
												$('html, body').animate({ scrollTop:  $('#njidekaNkirukaDiv').offset().top - 100 }, 'slow');
											</script>";
							
										}else{
										
											if(isset($_SESSION['wallComRank'])){
												
												companionInbox($conn, $member_id, $seVal, $i_false);  /* load companion inbox */
												
											}else{
												
												companionInbox($conn, $member_id, $fiVal, $i_false);  /* load companion inbox */
												
											}
										
										}
							 
									}catch(PDOException $e) {
					
										fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
					 
									}
							
								?>
				   
								</div>				
							</aside> 
						</div>
						<!--mail inbox end-->				
					</div>
				</div>
				<!-- card end -->	
			</div>
		</div>
		<!-- / row --> 

		
		<!-- companion email registration modal start -->			
		<button type="button" class="btn modal-mail-div display-none"  data-bs-toggle="modal" data-bs-target="#modal-mail-div"></button>
		<!-- Scrollable modal -->
		<div class="modal fade animate__animated animate__zoomInDown" id="modal-mail-div" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">			<div class="modal-dialog modal-fullscreen-sm-down modal-dialog-scrollable">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalScrollableTitle"> 
							<i class="mdi mdi-account-reactivate label-icon"></i>  
							Email Registation
						</h5>
						<div id="registMailMsg"> </div>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body slideUpFrmUDiv"> 
						<div class="row gutters my-30">
							<div class="col-12">	
								<!-- card start -->
								<div class="card fobrain-section-div">
									<div class="input-group mb-3">										
										<input type="text" class="form-control" name="cMailUser" id="cMailUser" placeholder="Enter your desire mail">
										<div class="input-group-append">
											<span class="input-group-text">@fobrain.com
												<i class="fas fa-check text-success availMail display-none mx-10"></i>
												<i class="fas fa-times text-danger mailAlready display-none mx-10"></i>
												<span class="spinner-border mail-spinner text-info mx-10 display-none" role="status">
												  <span class="visually-hidden">Loading...</span>
												</span>
											</span> 
										</div>										 
										<div class="form-text">
											* Only Alphabets &amp; Numbers are  accepted. However, you can
											only register once &amp; can't edit later.
										</div>
									</div> 
								</div> 
							</div>
						</div> 
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary  btn-label waves-light demo-disenable registerCMail display-none" 
						id="registerCMail"><i class="fas fa-user-plus label-icon"></i> 
							Register
						</button>
						<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		<!-- companion email registration modal end -->


		<?php

			if($component_free == 1){

				$msg_i = "* Ooops, your account does not support this module. Please upgrade to access these features.";
				 
				echo $infoMsg.$msg_i.$iEnd; 
				echo "<script type='text/javascript'>   
						$('.component-free').hide();
				</script>";

			}

		?>