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
				
		//require_once $fobrainIconPage; /* This include top middle global icon page eg go back, print buttons etcs */
		
		try {
			
			$burConfigsArray = bursaryConfigsArrays($conn);  /* school bursary configuration  */
			$currency = $burConfigsArray[0]['currency'];
			$bankDetails = htmlspecialchars_decode($burConfigsArray[0]['bank']);
			$stax = $burConfigsArray[0]['stax'];
			$ptax = $burConfigsArray[0]['ptax'];
			//$accID = $burConfigsArray[0]['account'];
			//$allowQ = $burConfigsArray[0]['allow'];
			//$bankDetails = nl2br($bankDetails); 
				
		}catch(PDOException $e) {
			
			fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
				
		} 
		
?>	 

		<!-- row -->
		<div <?php echo $fob_view; ?> class="row gutters row-section fobrain-section-div justify-content-center">
			<div class=" col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12">	
				<!-- card start -->
				<div class="card card-shadow"> 
					<?php 
						$page_title = '<i class="mdi mdi-account-cash fs-18"></i> 
						Busary Configuration';
						pageTitle($page_title, 0);	 
					?>
					<div id="msg-box"></div> 					
					<div class="card-body">
 
						<!-- form -->
						<form class="form-horizontal" id="frmburs-config"> 
							<!-- row -->
							<div class="row gutters">
								<div class="col-12">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<select class="form-control fob-select"  name="currency" id="currency" required>												  
												  <option value = "">Select One</option> 
												
												  <?php
												  
													  foreach($currencySymbols as $curr_key => $curr_value){  /* loop array */

														  if ($currency == $curr_key){
															  $selected = "SELECTED";
														  } else {
															  $selected = "";
														  }

														  echo '<option value="'.$curr_key.'"'.$selected.'>'.$curr_key.' - 
														  '.$curr_value.'</option>' ."\r\n";

													  }	
												  ?>  
                                        </select>
										<div class="field-placeholder">Select Currency <span class="text-danger">*</span></div>
										 
									</div>
									<!-- field wrapper end -->
								</div>									 
							</div>	
							<!-- /row -->

							<!-- row -->
							<div class="row gutters">
								<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">											
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<input type="text" class="form-control float-number" placeholder="Salary Tax" name="stax"  id="stax"
										value = "<?php echo $stax; ?>">
										<div class="field-placeholder"> Salary Tax <span class="text-danger"></span></div>
										<div class="form-text text-danger">
											Tax input  in percentage 
										</div>
									</div>
									<!-- field wrapper end -->
								</div>		
								<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">											
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<input type="text" class="form-control float-number" placeholder="Product Tax" name="ptax"  id="ptax"
										value = "<?php echo $ptax; ?>">
										<div class="field-placeholder"> Product Tax <span class="text-danger"></span></div>
										<div class="form-text text-danger">
											Tax input   in percentage 
										</div>
									</div>
									<!-- field wrapper end -->
								</div>	
																							 
							</div>	
							<!-- /row -->
							 
							
							<!-- row -->
							<div class="row gutters mt-30">
								<div class="col-12 text-end">
									<input type="hidden" name="query" value="save" />
									<button type="submit" class="btn btn-primary waves-effect   
									btn-label waves-light demo-disenable" id="burs-config">
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

		<script type="text/javascript">	 
			 
			$('.fob-select').each(function() {  
				renderSelect($('#'+this.id)); 
			}); 
			//renderSelect("#currency");  
			$('.float-number').keypress(function(event) {
				if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
					event.preventDefault();
				}
			});
			//$("#bank_acc").change();

			 

		$('body').on('click','#burs-config',function(){  /* save payroll*/ 

			showPageLoader();

			var form_data = new FormData($('#frmburs-config')[0]);

			$.ajax({
				url: 'bursary-config.php',
				dataType: 'text',
				cache: false,
				contentType: false,
				processData: false,
				data: form_data,
				type: 'post',
				success: function (response) {
					$('#msg-box').html(response); 
				},
				error: function (response) {
					$('#msg-box').html(response);
				}
			});

			return false;

		}); 
		</script> 