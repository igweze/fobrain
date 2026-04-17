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
	This page load online exam information
	------------------------------------------------------------------------*/ 


		if (!defined('fobrain')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
				
		require_once $fobrainIconPage; /* This include top middle global icon page eg go back, print buttons etcs */

?> 				
				
		<!-- row -->
		<div <?php echo $fob_view; ?> class="row gutters row-section fobrain-section-div justify-content-center">
			<div class="col-lg-12">	
				<!-- card start -->
				<div class="card card-shadow">
					<div class="card-header-wiz"> 
						<h4> 
							<span class="head-exam">
								<i class="mdi mdi-google-classroom fs-18"></i> 
								Online Examination Manager
							</span> 
							<span class="head-quest display-none">
								<i class="mdi mdi-google-classroom fs-18"></i> 
								Question & Answer Manager
							</span>
						</h4> 
					</div> 
					<div id="msg-box"></div> 					
					<div class="card-body" id="examQuestDiv"> 
						<div class="gutters my-15 text-end"> 
							<button type="button" class="view-info-div btn btn-danger display-none" >
								<i class="mdi mdi-text-box-search label-icon"></i>  View  Exam
							</button>
							<button type="button" class="add-new-div btn btn-primary">
								<i class="mdi mdi-notebook-plus-outline label-icon"></i>  Create 
							</button> 
							<span = class="wiz-menu"> 
								<a href="javascript:;" id="bulk-exam" class="btn btn-dark"> 
									<i class="mdi mdi-notebook-plus-outline label-icon"></i>  Bulk Create  
								</a>
							</span> 
						</div> 
						<div id="load-wiz-info"> <?php require 'e-exam-info.php';  ?> </div>
						
						<!-- row -->
						<div class="row gutters justify-content-center">
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12  card-shadow py-30  load-wiz-frm  display-none">	
								<div class="hints my-30">
									[<i class="mdi mdi-help-circle-outline"></i>] 
									Create new and manage new examination below.
								</div>
								<div id="load-wiz-frm"> <?php require 'e-exam-create.php';  ?> </div>
							</div>

							<div class="col-12 card-shadow py-30 new-exam-div  display-none">	
								<div class="hints my-30">
									[<i class="mdi mdi-help-circle-outline"></i>] 
									Create new and manage new examination below.
								</div>
								<div id="new-exam-div">  </div>
							</div>

							<div class="space-100"></div> 

						</div> 
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
							<i class="mdi mdi-google-classroom label-icon"></i>  
							Online Examination Manager
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


		<script>

			$('body').on('click','.view-info-div',function(event){  /* view info div */
				
				event.stopImmediatePropagation();	
				
				$('.view-info-div, .load-wiz-frm, .new-exam-div').fadeOut(1000); 
				$('.add-new-div, #load-wiz-info').fadeIn(1000);  
				$('#load-wiz-info').load('e-exam-info.php');
				
				return false;  
			
			});
			

			$('body').on('click','.add-new-div',function(event){  /* view add new div*/
			
				event.stopImmediatePropagation();	 

				$('.view-info-div, .load-wiz-frm').fadeIn(1000);
				$('.add-new-div, #load-wiz-info, .new-exam-div').fadeOut(1000); 
				$('#load-wiz-frm').load('e-exam-create.php');
				
				return false;  
			
			});

		</script>		 