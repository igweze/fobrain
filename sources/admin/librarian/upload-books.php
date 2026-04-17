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
	This page upload library books
	------------------------------------------------------------------------*/ 


		if (!defined('fobrain')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
				
		require_once $fobrainIconPage; /* This include top middle global icon page eg go back, print buttons etcs */

?>	 		

		<!-- row -->
		<div <?php echo $fob_view; ?> class="row gutters row-section fobrain-section-div justify-content-center">
			<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">	
				<!-- card start -->
				<div class="card card-shadow"> 
					<?php 
						$page_title = '<i class="mdi mdi-book-plus-multiple-outline fs-18"></i> 
							 Upload Library Book ';
						pageTitle($page_title, 0);	 
					?>
                    <div class="msg-box"></div>
					<div class="msgBoxPic"></div>						
					<div class="card-body">
						<!-- form -->						 
						<form method="POST" class="form-horizontal mb-80" id="frmLibrary" role="form" 
						enctype="multipart/form-data">                                           
							<!-- row -->
							<div class="row gutters">
								<div class="col-12">										
									<!-- field wrapper start -->
									<div class="field-wrapper select-wrapper">
										<select class="form-control wiz-select"  id="schoolType" name="schoolType" required>                                              
											<option value = "">Please select One</option>                                                              
											<?php

												foreach($school_list_2 as $school => $schoolVal){  /* loop array */

													if ($sex == $school){
													$selected = "SELECTED";
													} else {
													$selected = "";
													}

													echo '<option value="'.$school.'"'.$selected.'>'.$schoolVal.'</option>' ."\r\n";

												}

											?> 
										</select>	
										<div class="icon-wrap"  id="wait_1" style="display: none;">
											<i class="loader"></i>
										</div>									
										<div class="field-placeholder"> Select School  <span class="text-danger">*</span></div>										 
									</div>
									<!-- field wrapper end -->
								</div>									 
							</div>	
							<!-- /row -->  
							 
							<span id="result_1" style="display: none;"></span><!-- loading div -->

							<div id="lib-detail-div" style="display:none;">

							<!-- row -->
							<div class="row gutters">
								<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<input type="text" class="form-control" placeholder="Book Title" 
										name="book-name" maxlength="100" id="book-name" style="text-transform:capitalize !important;" required />                                            
										<div class="field-placeholder">  Title <span class="text-danger">*</span></div>										 
									</div>
									<!-- field wrapper end -->
								</div>									 
							 
								<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<input type="text" class="form-control" placeholder="Author Name" 
										name="book-author" maxlength="100" id="book-author" style="text-transform:capitalize !important;" required />
										<div class="field-placeholder"> Author  <span class="text-danger">*</span></div>										 
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
										<textarea rows="4" cols="10" class="form-control" name="book-desc" id="book-desc" 
										placeholder="Book Descriptions"></textarea>
										<div class="field-placeholder"> Descriptions <span class="text-danger">*</span></div>										 
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
										<select class="form-control wiz-select"  id="book-type" name="book-type" required>								
											<option value = "">Please select One</option>
											<?php

												foreach($libraryTypeArr as $typeB => $typeBB){  /* loop array */

													if ( $book_type == $typeB){
														$selected = "SELECTED";
													} else {
														$selected = "";
													}
	
													echo '<option value="'.$typeB.'"'.$selected.'>'.$typeBB.'</option>' ."\r\n";

												}

											?>
										</select>
										<div class="field-placeholder">  Type <span class="text-danger">*</span></div>										 
									</div>
									<!-- field wrapper end -->
								</div>									 
							</div>	
							<!-- /row -->                            

							<!-- row -->
							<div class="row gutters book-harhcopy-divs"  style="display:none;"> 
								<div class="col-12">										
									<!-- field wrapper start -->
									<div class="field-wrapper">                                                            
										<input type="text" class="form-control" placeholder="Library Book Location" 
										name="book-location" maxlength="255" id="book-location" style="text-transform: capitalize !important;"/>            
										<div class="field-placeholder"> Book Location <span class="text-danger"> </span></div>										 
									</div>
									<!-- field wrapper end -->
								</div>									 
							</div>	
							<!-- /row -->
 
							<!-- row -->
							<div class="row gutters book-harhcopy-divs"  style="display:none;"> 
								<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<input type="number" class="form-control" placeholder="Book Copies" 
										name="book-copies" maxlength="5" id="book-copies" style="text-transform:capitalize !important;" required />
										<div class="field-placeholder"> No. of Copies <span class="text-danger">*</span></div>										 
									</div>
									<!-- field wrapper end -->
								</div>
								<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">										
									<!-- field wrapper start -->
									<div class="field-wrapper">                                                            
										<select class="form-control wiz-select"  id="book-status" name="book-status" required>
										<?php

											foreach($libraryStatusArr as $status => $statusN){  /* loop array */

												if ( $book_status == $status){
														$selected = "SELECTED";
												} else {
														$selected = "";
												}

												echo '<option value="'.$status.'"'.$selected.'>'.$statusN.'</option>' ."\r\n";

											}

										?>       
										</select>
										<div class="field-placeholder">  Status <span class="text-danger"> * </span></div>										 
									</div>
									<!-- field wrapper end -->
								</div>									 
							</div>	
							<!-- /row -->

							<!-- row -->					
							<div class="row gutters mt-30 book-picture-div" id="book-picture-div"  style="display:none">
								<div class="col-12   text-center mb-20">

									<div class="picture-div mb-10">
										<img src="<?php echo $wiz_df_file_img; ?>" id="preview-picture-1" alt="Student Picture" class="img-h-150 rounded img-thumbnail" />
									</div>
									
									<!-- file-wrapper start -->
									<div class="file-wrapper">
										<label class="upload">
											<i class="mdi mdi-cloud-upload-outline fs-24 text-danger"></i> 
											<input type="file" id="book-lib-upload"  name="book-lib-upload"  class="form-control hide">
										</label> 
										<div class="form-text"> 
											<span id="allow-format-pic">Only max image size of 2MB &amp; format of <?php echo $allowedPicExt; ?> are allowed.</span> 
											<span id="allow-format-doc">Only max file size of 10MB &amp; format of <?php echo $allowedDocExt; ?> are allowed.</span>  
											<input type="hidden" name="library-data" value="upload-lib-book" />
											<input type="hidden" name="allow-format" id="allow-format" value="" />	
																				
											<div class="text-danger" id="book-name-display">Upload Book</div>
										</div>
									</div>
									<!-- file-wrapper end -->   
								</div>																 
							</div>	
							<!-- /row -->    
							
							</div>									
						</form>
						<!-- / form -->		
					</div>
				</div>
				<!-- card end -->	
			</div>
		</div>
		<!-- / row -->	   
                    
                		
		<!-- row -->	
		<div class="row">  
			<div class="col-lg-12">
				<div id="fobrain-page-div"> </div> <!-- This a div where jquery loads its contents -->					 					 
			</div>
		</div>
		<!-- / row -->	


		<script type="text/javascript">	 

			$('.wiz-select').each(function() {  
				renderSelect($('#'+this.id)); 
			});   

		</script>