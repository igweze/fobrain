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

		if (!defined('fobrain')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
				
		require_once $fobrainIconPage; /* This include top middle global icon page eg go back, print buttons etcs */

?> 
 		
		<!-- row -->
		<div <?php echo $fob_view; ?> class="row gutters row-section fobrain-section-div justify-content-center"">
			<div class="col-lg-8 col-12">	
				<!-- card start -->
				<div class="card card-shadow"> 
					<?php 
					$page_title = '<i class="mdi mdi-arrow-decision-auto fs-18"></i> 
							Scratch Card Manager';
						pageTitle($page_title, 0);	 
					?>		
					<div id="msg-box"></div> 			
					<div class="card-body">   
						<div class="gutters my-15 text-end menu-sc-card"> 
							<button type="button" class="btn btn-danger    
							btn-label waves-light display-none" id="return-pin-back">
								<i class="mdi mdi-backburger label-icon"></i>  Return
							</button>
							<button type="button" class="btn btn-primary waves-effect   
							btn-label waves-light" id="create-new-pins">
								<i class="mdi mdi-notebook-plus-outline label-icon"></i>  Create
							</button>
						</div>  
						
						<!-- form --> 
						<form class="form-horizontal my-20 display-none" id="frmsaveCardPin">  
							
							<!-- row -->
							<div class="row gutters">
								<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">										
									<!-- field wrapper start -->
									<div class="field-wrapper">										 
										<input type="number" class="form-control" placeholder="Enter No. of Pins to Generate" 
										name="pinCount"  id="pinCount" maxlength="4" >
										<div class="field-placeholder">No. of Pins to Generate <span class="text-danger">*</span></div>
									</div>
									<!-- field wrapper end -->
								</div>
                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">										
									<!-- field wrapper start -->
									<div class="field-wrapper">										 
										<input type="text" class="form-control" placeholder="Enter Card Serial No." 
										name="iiii_serial_iiii" maxlength="15" id="iiii_serial_iiii" >
										<div class="field-placeholder"> Card Serial No. <span class="text-danger">*</span></div>
									</div>
									<!-- field wrapper end -->
								</div>																 
							</div>	
							<!-- /row -->
							
							<!-- row -->
							<div class="row gutters mt-20">
								<div class="col-12 text-end">
									<input type="hidden" name="card" value="save" /> 	
									<button type="submit" class="btn btn-primary waves-effect   
									btn-label waves-light demo-disenable" id="saveCardPin">
										<i class="mdi mdi-content-save label-icon"></i>  Create
									</button>
								</div>
							</div>	
							<!-- /row -->		
							
							<hr class="text-danger" />

						</form>
						<!-- / form -->	
						<div id="msg-box"></div> 

						<div id="load-wiz-info"> <?php require 'scratch-card-info.php';  ?> </div>
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
			<div class="modal-dialog modal-fullscreen-sm-down modal-dialog-scrollable">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalScrollableTitle">
							<i class="mdi mdi-arrow-decision-auto"></i> 
							Scratch Card Manager
						</h5> 								 
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div id="edit-msg"> </div> 
					<div class="modal-body">
						<div id="modal-load-div"></div> 
					</div>
					<div class="modal-footer">
						<button type="button" id="close-modal" class="btn btn-danger close-modal" data-bs-dismiss="modal">Close</button>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		<!-- fobrain modal end -->  