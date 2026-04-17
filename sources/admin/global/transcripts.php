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
	This page load student transcript page
	------------------------------------------------------------------------*/ 


		if (!defined('fobrain')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
				
		require_once $fobrainIconPage; /* This include top middle global icon page eg go back, print buttons etcs */

?>	

		<!-- row -->
		<div <?php echo $fob_view; ?> class="row gutters row-section fobrain-section-div justify-content-center">
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">	
				<!-- card start -->
				<div class="card card-shadow">
					<div class="card-header-wiz">
						<h4>
							<i class="mdi mdi-format-list-checks fs-18"></i> 
							Search Class Result
						</h4>
					</div> 
					<div id="msg-box"></div> 					
					<div class="card-body">  
						 
						<form class="form-horizontal" id="frm-student-transcript" role="form">
							<div class="row gutters mb-25 mt-10">
								<div class="hints">
									[<i class="mdi mdi-help-circle-outline"></i>] 
									Search for student transcript result using their Reg. No
								</div>
							</div>  

							<!-- row -->
							<div class="row gutters">
								<div class="col-lg-12">										
									<!-- field wrapper start -->
									<div class="field-wrapper select-wrapper">
										<input type="text" class="form-control search-regno" placeholder="2007001/SEC" 
                                        name="regnum" id="regnum" required />
										<div class="icon-wrap"  id="wait_1" style="display: none;">
											<i class="loader"></i>
										</div>
										<div class="field-placeholder"> Student Reg Num <span class="text-danger">*</span></div>
									</div>
									<!-- field wrapper end -->
								</div>									 
							</div>	
							<!-- /row -->  
							<span id="result_1" style="display: none;"></span><!-- loading div -->  
						</form>
						<!-- /form -->  
					
					</div>
				</div>
				<!-- card end -->	
			</div>
		</div>
		<!-- / row -->	  

		<!-- row -->
		<div class="row gutters <?php echo $fob_view_2; ?>" id="wiz-slider">	
			<div class="col-lg-12">		
				<div class=" mx-10" id="fobrain-page-div"></div>				 		
			</div>												
		</div>
		<!-- / row -->				

	 