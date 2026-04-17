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
	This page load library configuration page
	------------------------------------------------------------------------*/ 


		if (!defined('fobrain')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
				
		require_once $fobrainIconPage; /* This include top middle global icon page eg go back, print buttons etcs */ 
		 
		try {
		 
  			$libConfigsArray = libraryConfigsArrays($conn);
				
		}catch(PDOException $e) {
  			
			fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			 
		} 
		
?>		

		<!-- row -->
		<div <?php echo $fob_view; ?> class="row gutters row-section fobrain-section-div justify-content-center">
			<div class="col-xl-5 col-lg-6 col-md-12 col-sm-12 col-12">	
				<!-- card start -->
				<div class="card card-shadow"> 
					<?php 
						$page_title = '<i class="mdi mdi mdi-book-open-variant fs-18"></i> 
							 Library Settings';
						pageTitle($page_title, 0);	 
					?>
					<div id="msg-box"></div> 					
					<div class="card-body">
						<!-- form -->
						<form class="form-horizontal" id="frmlibConfiguration"> 
							<!-- row -->
							<div class="row gutters">
								<div class="col-12">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<input type="number"  id="numApply" name="numApply" 
										value ="<?php echo $libConfigsArray[0]['book_no_apply']; ?>"
										class="form-control" placeholder="10" maxlength="3" >
										<div class="field-placeholder"> Book Application Limit <span class="text-danger">*</span></div>										 
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
										<input type="number"  id="numBorrow" name="numBorrow" 
										value ="<?php echo $libConfigsArray[0]['book_no_borrow']; ?>"
										class="form-control" placeholder="5" maxlength="3" >
										<div class="field-placeholder">  Book Lending Limit <span class="text-danger">*</span></div>										 
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
										<input type="number"  id="dateline" name="dateline" 
										value ="<?php echo cleanInt($libConfigsArray[0]['book_dateline']); ?>"
										class="form-control" placeholder="30" maxlength="3" >
										<div class="field-placeholder">  Book Dateline (In Days) <span class="text-danger">*</span></div>
										 
									</div>
									<!-- field wrapper end -->
								</div>									 
							</div>	
							<!-- /row -->	 
							
							<!-- row -->
							<div class="row gutters mt-30">
								<div class="col-12 text-end">
									<input type="hidden" name="libData" value="libConfigs" />  
									<button type="submit" class="btn btn-primary waves-effect   
									btn-label waves-light demo-disenable" id="libConfiguration">
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

	