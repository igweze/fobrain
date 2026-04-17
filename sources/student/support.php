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
	This page handle student support 
	------------------------------------------------------------------------*/ 


		if (!defined('fobrain')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
				
		require_once $fobrainIconPage; /* This include top middle global icon page eg go back, print buttons etcs */

?>
 
 
 		<!-- row -->
		<div class="row gutters justify-content-center">
			<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">	
				<!-- card start -->
				<div class="card card-shadow"> 
					<?php 
						$page_title = '<i class="mdi mdi-human-male-child fs-18"></i> 
										Send Message To School Mgm';
						pageTitle($page_title, 0);	 
					?>
					<div class="card-body"> 
						<div id="msgBox"></div>						
						<!-- form -->
						<form class="form-horizontal" id="frmSupportDesk">	
							<!-- row -->
							<div class="row gutters">
								<div class="col-12 hide">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<select class="form-control"  id="msgRecep" name="msgRecep"> 
											<option value = "2"> School Admin</option>
										</select>
										<div class="field-placeholder">Send Mail to <span class="text-danger">*</span></div>										 
									</div>
									<!-- field wrapper end -->
								</div>
								<div class="col-12">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
										 <input type="text" class="form-control" placeholder="Your mesaage title here" 
													  name="msgTitle" id="msgTitle" requireda />
										<div class="field-placeholder"> Title <span class="text-danger">*</span></div> 
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
										<textarea class="form-control" name="msg" id="msg"
										style="padding:10px; text-align:justify !important;"
										placeholder="Write your mesaage here" rows="10" requireda></textarea>
													 
										<div class="field-placeholder"> Message <span class="text-danger">*</span></div>
										<div class="form-text">
											Please enter your mesaage.
										</div>
									</div>
									<!-- field wrapper end -->
								</div>									 
							</div>	
							<!-- /row -->
							
							<!-- row -->
							<div class="row gutters mt-30">
								<div class="col-12 text-end">
									<input type="hidden" name="msgData" value="support"/>	 
									<button type="submit" class="btn btn-primary waves-effect   
									btn-label waves-light" id="supportDesk">
										<i class="bx bx-send label-icon"></i> 
										Send
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
		<div id="mailMsgBox"> </div>