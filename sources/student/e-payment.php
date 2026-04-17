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
	This page is the student fee payment
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
					<?php 
						$page_title = '<i class="mdi mdi mdi-account-cash-outline fs-18"></i> 
						Pay Fees Manager';
						pageTitle($page_title, 0);	 
					?>  
					<div class="card-body"> 
						<!-- form -->
						<form class="form-horizontal mt-20 mb-50" id="frmpayFee" 
						enctype="multipart/form-data" enctype="multipart/form-data" method="POST">	
							<!-- row -->
							<div class="row gutters">
								<div class="col-12">										
									<!-- field wrapper start -->
									<div class="field-wrapper select-wrapper">									
										<select class="form-control fob-select"  id="feeCat" name="feeCat" placeholder="Search . . ." required>
											<option value = "">Search . . .</option>

											<?php 

												try {

													$feeCategoryDataArr = feeCategoryData($conn);
													$feeCategoryDataCount = count($feeCategoryDataArr);
													
												}catch(PDOException $e) {
												
													fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
												
												}		
											
												if($feeCategoryDataCount >= $fiVal){  /* check array is empty */ 

													for($i = $fiVal; $i <= $feeCategoryDataCount; $i++){  /* loop array */	
													
														$fID = $feeCategoryDataArr[$i]["f_id"];
														$feeCategory = $feeCategoryDataArr[$i]["fee"];
														$amount = $feeCategoryDataArr[$i]["amount"];
														$status = $feeCategoryDataArr[$i]["status"];
														$fee_account = $feeCategoryDataArr[$i]["account"];
														
														$feeCategory = trim($feeCategory);
														$amount = trim($amount);
														$status = trim($status);
														
														$amountS = fobrainCurrency($amount, $curSymbol); 

														if($status == $fiVal){
														
															echo '<option value="'.$fID.'-'.$amount.'-'.$fee_account.'"'.$selected.'>
															'.$feeCategory.' - '.$amountS.'</option>' ."\r\n";
														
														}

													}
													
												}else{
													
													echo '<option value="">No fee category.</option>' ."\r\n"; 
													
												}	 

											?> 
										</select>
										<div class="icon-wrap"  id="pay_loader" style="display: none;">
											<i class="loader"></i>
										</div> 
										<div class="field-placeholder">Select Fee To Pay <span class="text-danger">*</span></div>
										
									</div>
									<!-- field wrapper end -->
									<div class="form-text text-danger fw-500 fs-11">
										Only two (2) installment payments are allowed for each unique payment.
									</div>
								</div>    
								
							</div>	
							<!-- /row -->	 

							<!-- row -->
							<div class="row gutters"> 

								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 display-none payMethodDiv">									
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<input type="number" class="form-control" placeholder="Enter Amount Paid" 
										name="amountPaid"  id="amountPaid" required>
										<div class="field-placeholder"> Amount <span class="text-danger"></span></div>		
										<a href="javascript:;" class="text-sienna btn waves-effect btn-label waves-light fs-10" id="transferPayment"> 
											<i class="mdi mdi-cash-check label-icon"></i> Paid Fully, Click Here 
										</a>											
									</div>
									<!-- field wrapper end -->
								</div>

								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 display-none payMethodDiv">
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<select class="form-control fob-select" id="level" name="level" required>
											<option value = "">Select One</option>
											<?php 
												try {
													
													studentLevel($conn);  /* retrieve student level */
											 
													}catch(PDOException $e) {
						
														fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
						 
													} 
											?>
										</select>
										<div class="field-placeholder"> School Level <span class="text-danger">*</span></div> 
									</div>
									<!-- field wrapper end -->	  
								</div> 
							</div>
							<!-- /row -->

							<!-- row -->
							<div class="row gutters">   
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 display-none payMethodDiv">									
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<select class="form-control fob-select" id="term" name="term" required>

											<option value = "">Search . . . >>>></option>
											<?php


												foreach($term_list as $term_key => $term_value){    /* loop array */  /* loop array */

												if ($curTerm == $term_key){
													$selected = "SELECTED";
												} else {
													$selected = "";
												}

												echo '<option value="'.$term_key.'"'.$selected.'>'.$term_value.'</option>' ."\r\n";

												}

											?> 
										</select>
										<div class="field-placeholder">  Term <span class="text-danger">*</span></div>													
									</div>
									<!-- field wrapper end -->
								</div> 		
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 display-none payMethodDiv">										
									<!-- field wrapper start -->
									<div class="field-wrapper select-wrapper">
										<select class="form-control fob-select"  id="payMethod" name="payMethod" required> 
											<option value = "">Search . . .</option>
											<option value = "bank">Bank Deposit / Transfer</option> 
											<!--<option value = "2checkout">2Checkout</option> -->
											<option value = "paystack">Paystack</option> 	 
										</select>
										<div class="icon-wrap"  id="pay_m_loader" style="display: none;">
											<i class="loader"></i>
										</div>
										<div class="field-placeholder">Payment Method <span class="text-danger">*</span></div>
									</div>
									<!-- field wrapper end -->
								</div>									 
								
							</div>	
							<!-- /row -->

							<!-- row -->
							<div class="row gutters">		 

								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 display-none bank-pay-div">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<input type="date" name="pDay" id="pDay"  required />
										<div class="field-placeholder"> Payment Date: <span class="text-danger"></span></div>													
									</div>
									<!-- field wrapper end -->
								</div>	 

							</div>	
							<!-- /row --> 

							<!-- row -->
							<div class="row gutters justify-content-center my-25 display-none bank-pay-div"> 
								<div class="col-12 text-center">
									<div class="picture-container">
										<div class="picture">
											<img src="<?php echo $wiz_df_file_img; ?>" class="picture-src" id="picture-preview" title="" />
											<input type="file" class="picture-file" id="payupload" name="payupload">
										</div>
										<h6>Upload Proof of Pay</h6>
										<div class="text-danger fs-10">Only max image size of 2MB &amp; format of <?php echo $allowedPicExt; ?> are allowed.</div>
									</div>   
								</div> 
							</div>
							<!-- /row --> 
							 
							
							<!-- row -->
							<div class="row gutters"> 
								<div class="col-12 text-end mt-30 display-none" id="feePayOnline"> 
									<input name="payment" value="save" type="hidden"/> 
									<button type="submit" class="btn btn-primary waves-effect   
									btn-label waves-light validate_pay">
										<i class="mdi mdi-bank-transfer label-icon"></i> 
										Pay Fee
									</button>
									<button type="submit" class="btn btn-primary waves-effect   
									btn-label waves-light hide" id="feePayOnlineBtn">
										<i class="mdi mdi-bank-transfer label-icon"></i> 
										Pay Fee
									</button> 
								</div>	
					 
								<div class="col-12 text-end mt-30 display-none" id="feePayBank"> 
									<button type="submit" class="btn btn-primary waves-effect   
									btn-label waves-light validate_pay">
										<i class="mdi mdi-bank-transfer label-icon"></i> 
										Submit
									</button>
									<button type="submit" class="btn btn-primary waves-effect   
									btn-label waves-light hide" id="feePayBankBtn">
										<i class="mdi mdi-bank-transfer label-icon"></i> 
										Pay Fee
									</button> 
								</div>	
								
								<div class="col-12 text-end mt-10"> 
									<div class="display-none" id="wiz-loader-2">
										<strong role="status">Processing...</strong>
										<div class="spinner-border ms-auto" aria-hidden="true"></div>
									</div>
								</div>  

							</div>
							<!-- /row -->
							<span id="msg-box"></span>  
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
		</script>