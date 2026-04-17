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
	This page is manually add result manager
	------------------------------------------------------------------------*/ 


		if (!defined('fobrain')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
				
		require_once $fobrainIconPage; /* This include top middle global icon page eg go back, print buttons etcs */

?> 
 		<?php
				
				$msg_i = 'To upload excel result, you have to export the result format using the <b> Export Class Result
				Module</b>	and save it as 
				<span style="color:#000;font-weight:bold;">
				Excel 1997 - 2003</span>. <br />
				<br />
				Meanwhile, you have to input students score and separate the scores with a comma 
				(,) eg <span style="color:#000;font-weight:bold;"> 8,9,8,55, 15,15,65 or 30, 70 </span> and subject scores  
				must not be more than 100. 
				Note: Every empty field should be replace with  a <span style="color:#000;font-weight:bold;">-</span> ie dashed. ';
				
				//echo $infMsg.$msg_i.$msgEnd;

			?>
		<!-- row -->
		<div <?php echo $fob_view; ?> class="row gutters row-section fobrain-section-div justify-content-center">
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">	
				<!-- card start -->
				<div class="card card-shadow"> 
					<?php 
					$page_title = '<i class="mdi mdi-auto-upload fs-18"></i> 
						 	Upload Bulk Student Profiles';
						pageTitle($page_title, 0);	 
					?>	
					<div id="msg-box"></div> 					
					<div class="card-body">   
					 
						 
						
						<form class="form-horizontal" id = "frmbulk-excel-bio"  enctype="multipart/form-data" 
							action='bulk-bio-upload.php'  method="POST" role="form">	 

							<div class="row gutters mb-25 mt-10">
								<div class="hints">
									[<i class="mdi mdi-help-circle-outline"></i>] 
									Kindly work offline and upload bulk students result at once with Excel file
								</div>
							</div>
							<?php $show_all = 0; require ($fobrainAdminGlobalDir.'common-frm-1.php'); ?>

							<!-- row -->
							<div class="row gutters">
								<div class="col-lg-12">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<select class="form-control fob-select"  id="term2" name="term" required>
											
											<option value = "">Please select One</option>

											<?php
											
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

											?>
										
										</select>
										<div class="field-placeholder"> School Term <span class="text-danger">*</span></div>
									</div>
									<!-- field wrapper end -->
								</div>									 
							</div>	
							<!-- /row -->
							
							<!-- row -->
							<div class="row gutters justify-content-center my-10"> 
								<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12 text-center">
									<div class="picture-div mb-10">
										<img src="<?php echo $wiz_df_xls_img; ?>" id="preview-picture" alt="school logo" class="img-h-160 rounded img-thumbnail" />
									</div>
									<!-- file-wrapper start -->
									<div class="file-wrapper component-free">
										<label>
											<i class="mdi mdi-cloud-upload-outline fs-36 text-danger link-pointer"></i> 
											<input type="file" name="uploadPic" id="bulk-excel-bio" class="form-control hide">
										</label> 
										<div class="form-text"> 
											<input type="hidden" name="uMode" value="1" />
											<input type="hidden" name="query" value="upload" />
											<div class="fs-14 fw-600 mb-10">Upload Excel File</div>
											<div class="text-danger">Only max image size of 2MB &amp; format of <?php echo $allowedExcelExt; ?> are allowed.</div>
										</div>
									</div>
									<!-- file-wrapper end -->
								</div> 
							</div>
							<!-- /row -->
 

						</form>
						<!-- /form --> 

					</div>
				</div>
				<!-- card end -->	
			</div>
		</div>
		<!-- / row -->	  

		<!-- row -->
		<div class="row gutters mb-100 <?php echo $fob_view_2; ?>" id="wiz-slider">	
			<div class="col-lg-12">		
				<div class=" mx-10" id="fobrain-page-div"></div>				 		
			</div>												
		</div>
		<!-- / row -->		
		 
		<div id="upload-qy-data" class="display-none"></div>	
			

		<!--  fobrain modal start -->			
		<button type="button" class="btn modal-fobrain  display-none"  data-bs-toggle="modal" data-bs-target="#modal-fobrain"></button>				
		<!-- Scrollable modal -->
		<div class="modal fade animate__animated animate__zoomInDown" id="modal-fobrain" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-scrollable  modal-xl">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalScrollableTitle">
							<i class="mdi mdi-auto-upload label-icon"></i> 
							Profile Manager
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


		<script>  
			$('.fob-select').each(function() {  
				renderSelect($('#'+this.id)); 
			});
		</script>	
		

		<?php

			if($component_free == 1){

				$msg_i = "* Ooops, your account does not support this module. Please upgrade to access these features.";
				 
				echo $infoMsg.$msg_i.$iEnd; 
				echo "<script type='text/javascript'>   
						$('.component-free').hide();
				</script>";

			}

		?>
			