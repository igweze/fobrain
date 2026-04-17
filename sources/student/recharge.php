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
	This page load eWallet recharge manager
	------------------------------------------------------------------------*/ 


		if (!defined('fobrain')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
				
		require_once $fobrainIconPage; /* This include top middle global icon page eg go back, print buttons etcs */

?>	
 

		<!-- row -->
		<div <?php echo $fob_view; ?> class="row gutters row-section fobrain-section-div justify-content-center">
			<div class="col-xl-5 col-lg-6 col-md-12 col-sm-12 col-12">	
				<!-- card start -->
				<div class="card card-shadow"> 
					<?php 
						$page_title = '<i class="mdi mdi-card-bulleted-outline fs-18"></i> 
						Recharge  E-Wallet';
						pageTitle($page_title, 0);	 
					?>
					<div class="card-body">
						<!--
						<div class="row gutters mb-15 mt-10 justify-content-center">
							<div class="hints col-lg-10">
								[<i class="mdi mdi-help-circle-outline"></i>] 
								Recharge your <span style="color:#000;font-weight:bold;">e-Wallet</span> 
								for th school level and term (annual) result you intend to view. 

								Hence, every successful recharge has unlimited access to the said result forever.
							</div>
						</div>
						-->
						<div id="msg-box"></div>
						<!-- form -->
						<form class="form-horizontal" id="frmrechargeWallet"> 
							<!-- row -->
							<div class="row gutters">
								<div class="col-12">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<select class="form-control fob-select"  id="level" name="level"> 
                                			<option value = "">Select One</option>
												<?php 
													try {
													
														studentLevel($conn);  /* retrieve student level */
											 
													}catch(PDOException $e) {
						
													fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
						 
													} 
												?> 
                                        </select>
										<div class="field-placeholder"> Level <span class="text-danger">*</span></div> 
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
										<select class="form-control fob-select"  id="term" name="term">                                              
                                			<option value = "">Select One</option>                                
											<?php
												
												if($ewalletCheck == $seVal){
													
													$selected = "SELECTED";
													echo '<option value="'.$foVal.'"'.$selected.'> Annual</option>' ."\r\n";
													
												}else{	
												
													try {
													
															$curTerm = currentSessionTerm($conn);    /* current school term  */
											 
													}catch(PDOException $e) {
						
														fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
						 
													}  

													foreach($term_list as $term_key => $term_value){    /* loop array */

														if ($curTerm == $term_key){
															$selected = "SELECTED";
														} else {
															$selected = "";
														}

														echo '<option value="'.$term_key.'"'.$selected.'>'.$term_value.'</option>' ."\r\n";

													}
												
												} 
											?>
                                        </select>
										<div class="field-placeholder"> Term <span class="text-danger">*</span></div> 
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
										<input type="password" class="form-control" placeholder="111133334444" 
                                         name="card_pin" id="card_pin" />
										<div class="field-placeholder"> Scratch Pin No. <span class="text-danger">*</span></div> 
									</div>
									<!-- field wrapper end -->
								</div> 					 
							</div>	
							<!-- /row -->
							
							<!-- row -->
							<div class="row gutters  mt-30">
								<div class="col-12 text-end">
									<input name="eWalletData" value="recharge" type="hidden"  />
									<button type="submit" class="btn btn-primary waves-effect   
									btn-label waves-light" id="rechargeWallet">
										<i class="mdi mdi-content-save label-icon"></i>  Recharge
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
		
		<!-- row -->
		<div class="row gutters <?php echo $fob_view_2; ?>" id="wiz-slider">		
			<div class="col-12">	
				<!-- card start -->
				<div id="upload-qy-data" class="display-none"></div>
				<div class="card card-shadow">				 		
					<div class="card-body mx-10" id="fobrain-page-div"></div>
				</div>
				<!-- card end -->	
			</div> 			
		</div>
		<!-- / row -->						
                	 
		<script type="text/javascript">	 
			$('.fob-select').each(function() {  
				renderSelect($('#'+this.id)); 
			});
		</script>';	                 	