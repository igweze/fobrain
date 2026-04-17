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
	This page handle student SMS
	------------------------------------------------------------------------*/ 


		if (!defined('fobrain')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
				
		require_once $fobrainIconPage; /* This include top middle global icon page eg go back, print buttons etcs */

		try {
				
			//$studentToken = studentToken($conn); /* rettieve all active school student information */  

		}catch(PDOException $e) { 
  			
			fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			 
		}

?>
	
	
		<!-- row -->
		<div <?php echo $fob_view; ?> class="row gutters row-section fobrain-section-div justify-content-center">
			<div class="col-xl-10 col-lg-10 col-md-10 col-sm-12 col-12">	
				<!-- card start -->
				<div class="card card-shadow">
					<?php 
					$page_title = '<i class="mdi mdi-cellphone-text fs-18"></i>  
							<span id="sms-msg-title">Student / Guardian SMS Manager</span>';
						pageTitle($page_title, 0);	 
					?>			
					<div class="card-body"> 

						<div id="msg-box"></div> 	

						<!-- form -->
						<form class="form-horizontal" id="frm-student-sms" method="POST"> 							
							<!-- row -->
							<div class="row gutters">
								<div class="col-lg-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<select class="form-control fob-select"  name="message_to" id="student_message_to"> 
											<option value = "">Please select One</option>
											<option value = "1">Select Students / Guardians</option>
											<option value = "2">Select Class</option>							
											 
										</select>
										<div class="field-placeholder"> Send Message To  <span class="text-danger">*</span></div>
									</div>
									<!-- field wrapper end -->
								</div>
								<div class="col-lg-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
											<select class="form-control fob-select"  id="sendTo" name="sendTo" required> 
												<option value = "">Please select One</option>		
											 	<option value = "1">Guardian/s</option>
											  	<option value = "2">Student/s</option> 
											</select>
										<div class="field-placeholder"> Recipient  <span class="text-danger">*</span></div>
									</div>
									<!-- field wrapper end -->
								</div>									 
							</div>	
							<!-- /row -->
 

							<!-- row -->
							<div class="row gutters display-none" id="select-student-div">
								<div class="col-12">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<select class="form-control"  name="students[]" id="students" placeholder="Search for Student or Guardians..." autocomplete="off"> 
											<option value = "">Please select One</option>	
											<?php  
												try{
													
													$sibling = "";

													$student_arr = activeStudent($conn);  /* active students */

													if(is_array($sibling)){  /* check is student is empty */	  
													
														echo studentSelectBox($conn, $student_arr, $sibling, true);  
													
													}else{

														echo studentSelectBox($conn, $student_arr, "none", false);  

													}	 
													
												}catch(PDOException $e) {				
													fobrainDie( 'Ooops Database Error: ' . $e->getMessage());													
												}	
											?>						
											 
										</select>
										<div class="field-placeholder"> Search for student/s  <span class="text-danger">*</span></div>
									</div>
									<!-- field wrapper end -->
								</div>									 
							</div>	
							<!-- /row -->

							<div class="display-none" id="student-session-div">					
								<?php $show_all = 0; require ($fobrainAdminGlobalDir.'common-frm-1.php'); ?>
							</div>

							<!-- row -->
							<div class="row gutters">
								<div class="col-12">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<textarea class="form-control" name="message" id="text-message" 
										style="padding: 5px 30px;" placeholder="Write your mesaage here" rows="10" required></textarea>
										<div class="field-placeholder"> Message <span class="text-danger">*</span></div>
									</div>
									<!-- field wrapper end -->									
									<span id="remaining_fi" class="badge bg-primary">160</span>&nbsp;
									Character
									<span class="cplural_fi">s</span> 
									Remaining Total&nbsp;
									<span id="messages_fi" class="badge bg-danger">1</span>&nbsp;
									Message<span class="mplural_fi">s</span>
									&nbsp;<span id="total_fi" class="tplural_fi badge bg-success">0</span>&nbsp;
									Character<span class="tplural_fi">s</span>
								</div>									 
							</div>	
							<!-- /row --> 
							
							<!-- row -->
							<div class="row gutters mt-30">
								<div class="col-12 text-end">
									<input type="hidden" name="sms" value="student"/>									
									<button type="submit" class="btn btn-primary   
									btn-label waves-light display-none" id="send-student-sms">
										<i class="mdi mdi-email-send label-icon"></i>  Send
									</button>
									<button type="submit" class="btn btn-primary    
									btn-label waves-light display-none" id="student-sms-all">
										<i class="mdi mdi-email-send label-icon"></i>  Send  
									</button>
								</div>
							</div>	
							<!-- /row -->									
						</form>
						<!-- / form -->		
					</div>
				</div>
				<!-- card end -->	
			</div>
		</div>
		<!-- / row -->	   

		<!--  fobrain modal start -->			
		<button type="button" class="btn modal-fobrain  display-none"  data-bs-toggle="modal" data-bs-target="#modal-fobrain"></button>				
		<!-- Scrollable modal -->
		<div class="modal fade animate__animated animate__zoomInDown" id="modal-fobrain" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg modal-fullscreen-sm-down modal-dialog-scrollable">
				<div class="modal-content">
					<div class="modal-header">
						 
						<h5 class="modal-title" id="exampleModalScrollableTitle"> 
							<i class="mdi mdi mdi-email-open-multiple label-icon"></i>  
							SMS Manager
						</h5>								 
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div id="edit-msg"> </div>
					<div class="modal-body">
						<div id="modal-load-div"></div> 
					</div>
					 
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		<!-- fobrain modal end -->	

		<!-- jquery sms manager start -->												
		<script type="text/javascript">	

			/*$('.fob-select').each(function() {  
				renderSelect($('#'+this.id)); 
			});*/
			renderSelectImg("#students", 20);

			$('#text-message').keyup(function(){
				
				var part1Count = 160; var part2Count = 145; var part3Count = 152;								 
				var chars = $(this).val().length;
					messages = 0;
					remaining = 0;
					total = 0;
				if (chars <= part1Count) {
					messages = 1;
					remaining = part1Count - chars;
				} else if (chars <= (part1Count + part2Count)) { 
					messages = 2;
					remaining = part1Count + part2Count - chars;
				} else if (chars > (part1Count + part2Count)) { 
					moreM = Math.ceil((chars - part1Count - part2Count) / part3Count) ;
					remaining = part1Count + part2Count + (moreM * part3Count) - chars;
					messages = 2 + moreM;
				}
				$('#remaining_fi').text(remaining);
				$('#messages_fi').text(messages);
				$('#total_fi').text(chars);
				if (remaining > 1) $('.cplural_fi').show();
					else $('.cplural_fi').hide();
				if (messages > 1) $('.mplural_fi').show();
					else $('.mplural_fi').hide();
				if (chars > 1) $('.tplural_fi').show();
					else $('.tplural_fi').hide();
			});
			
			$('#text-message').keyup();  

			$('body').on('change','#student_message_to',function(event){  /* load state div */			
				
				event.stopImmediatePropagation();

				var msg_to = $('#student_message_to').val();  

				if(msg_to == 1){
					$('#student-sms-all, #student-session-div').fadeOut(300);
					$('#select-student-div, #send-student-sms').fadeIn(300);
				}else if(msg_to == 2){
					$('#student-sms-all, #student-session-div').fadeIn(300);
					$('#select-student-div, #send-student-sms').fadeOut(300);
				}else{

					//$('#select-student-div, #student-sms-all, #send-student-sms, #student-session-div').fadeOut(300);
				}

			}); 

			$('body').on('click','#send-student-sms',function(event){  /* send student SMS */ 

				event.stopImmediatePropagation();

				var students = $('#students').val();
				var message = $('#text-message').val(); 
				var student = "student";
					
				showPageLoader();   
					
				$('#msg-box').load('sms-sender-manager.php', {'sms': student,'students': students, 'message': message, 'show_more': 1}).fadeIn(1000);
				$('html, body').animate({ scrollTop:  $('#msg-box').offset().top - 130 }, 'slow');			
				

				return false;

			});
			
			$('body').on('click','#student-sms-all',function(event){  /* send student SMS */ 

				event.stopImmediatePropagation(); 
				
				var student = "student-class";
				var message = $('#text-message').val();  
				var sendTo = $('#sendTo').val();  
				var session = $('#session_s').val(); 
				var level = $('#level_s').val();
				var class_q = $('.class').val(); 
					
				showPageLoader();   
					
				$('#msg-box').load('sms-sender-manager.php', {'sms': student, 'message': message, 
					'sess': session, 'level': level, 'class': class_q, 'sendTo': sendTo, 'show_more': 1});
				$('html, body').animate({ scrollTop:  $('#msg-box').offset().top - 130 }, 'slow');			


				return false;

			}); 

		</script>
		<!-- jquery sms manager end -->		