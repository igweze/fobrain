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
	This script handle school bursary configuration
	------------------------------------------------------------------------*/

		if (!defined('fobrain'))

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
				
		require_once $fobrainIconPage; /* This include top middle global icon page eg go back, print buttons etcs */
		
		try { 

			$mail_info_arr = mailInfo($conn, $mID = 1);  /* mail information  */ 
	
			$send_host = $mail_info_arr[$fiVal]["send_host"];
			$send_name = $mail_info_arr[$fiVal]["send_name"];
			$send_pass = htmlspecialchars_decode($mail_info_arr[$fiVal]["send_pass"]);
			$send_mail = $mail_info_arr[$fiVal]["send_mail"];
			$footer = htmlspecialchars_decode($mail_info_arr[$fiVal]["footer"]);
			$status = $mail_info_arr[$fiVal]["status"]; 
			//$status = $onOffArr[$status]; 
				
		}catch(PDOException $e) {
			
			fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
				
		} 
		
?>	 

		<!-- row -->
		<div <?php echo $fob_view; ?> class="row gutters row-section fobrain-section-div justify-content-center">
			<div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">	
				<!-- card start -->
				<div class="card card-shadow"> 
					<?php 
						$page_title = '<i class="mdi mdi-email-multiple fs-18"></i> 
						Email Configuration';
						pageTitle($page_title, 0);	 
					?>
					<div id="msg-box"></div> 					
					<div class="card-body">
						<!-- form -->
						<form class="form-horizontal" id="frmupdate-mail" method="post">  
							<!-- row -->
							<div class="row gutters">
								<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">											
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<input type="text" class="form-control float-number" placeholder="E.g Amanda School" name="send_name"  id="send_name"
										value = "<?php echo $send_name; ?>">
										<div class="field-placeholder"> Sender Profile <span class="text-danger"></span></div>
										<div class="form-text text-danger">
											This name appears in sent mail
										</div>
									</div>
									<!-- field wrapper end -->
								</div>	
								<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">											
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<input type="text" class="form-control" placeholder="E.g mail.fobrain.com" name="send_host"  id="send_host"
										value = "<?php echo $send_host; ?>">
										<div class="field-placeholder"> SMTP Server <span class="text-danger"></span></div>										 
									</div>
									<!-- field wrapper end -->
								</div>		
								<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">											
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<input type="text" class="form-control" placeholder="E.g info@fobrain.com" name="send_mail"  id="send_mail"
										value = "<?php echo $send_mail; ?>">
										<div class="field-placeholder"> SMTP Username <span class="text-danger"></span></div>										 
									</div>
									<!-- field wrapper end -->
								</div>	
								<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">											
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<input type="text" class="form-control" placeholder="Your SMTP password" name="send_pass"  id="send_pass"
										value = "<?php echo $send_pass; ?>">
										<div class="field-placeholder"> SMTP Password <span class="text-danger"></span></div>										 
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
										<textarea rows="4" cols="10" class="form-control" name="footer" id="text-message" 
                                        placeholder="School Mail Footer"><?php echo $footer; ?></textarea> 

										<div class="field-placeholder"> Mail Footer (Optional) <span class="text-danger">*</span></div>
										 
									</div>
									<!-- field wrapper end -->
								</div>																 
							</div>	
							<!-- /row -->
							
							<!-- row -->
							<div class="row gutters mt-30">
								<div class="col-12 text-end">
									<input type="hidden" name="query" value="update" />
									<button type="submit" class="btn btn-primary waves-effect   
									btn-label waves-light" id="update-mail">
										<i class="mdi mdi-content-save label-icon"></i>  Save
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
		<script src="<?php echo $fobrainTemplate; ?>js/rich-text-defaults.js"></script> 