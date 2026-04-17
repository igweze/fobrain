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
	This script load school setup configuration
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

     	define('fobrain', 'igweze');  /* define a check for wrong access of file */

        require 'fobrain-config-s.php';  /* load fobrain configuration files */
 
		 
		try {		 

			$schoolArray = fobrainSchool($conn);  /* school configuration setup array  */  
			$staff_arr = staffArrays2($conn);  /* school staffs/teachers token information */ 
			 
			$school_logo = $schoolArray[0]['school_logo'];			
			$ewallet = $schoolArray[0]['ewallet'];
			$translator = $schoolArray[0]['translator'];
			$school_head = $schoolArray[0]['school_head'];	
			$tzone = $schoolArray[0]['tzone'];	 
													
			list ($nur_head, $pri_head, $sec_head) = explode (",", $school_head);	

			$sch_logo = picture($sch_logo_path, $school_logo, "logo");

			list ($transFrom, $transTo) = explode ("/", $translator);	
				
		}catch(PDOException $e) {
  			
			fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			 
		} 
		
?>		
 
		<!-- row -->
		<div <?php echo $fob_view; ?> class="row gutters row-section fobrain-section-div justify-content-center">
			<div class="col-xl-10 col-lg-10 col-md-10 col-sm-12 col-12">	
				<!-- card start -->
				<div class="card card-shadow"> 
					<?php 
						$page_title = '<i class="fas fa-users-cog fs-16"></i>  Global School Configuration';
						pageTitle($page_title, 0);	 
					?>  
					<div id="msg-box"></div> 					
					<div class="card-body">
						
						<!-- form -->
						<form method="POST" id ="frm-sch-logo"  enctype="multipart/form-data"  class="form-wizard-bd form-horizontal">
							<!-- row -->
							<div class="row gutters justify-content-center my-10"> 
								<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12 text-center">
									<div class="picture-div mb-10">
										<img src="<?php echo $sch_logo; ?>" id="preview-picture" alt="school logo" class="img-h-160 rounded img-thumbnail" />
									</div>
									<!-- file-wrapper start -->
									<div class="file-wrapper"> 
										<label class="upload-img-div fob-btn-div"">	
											<i class="mdi mdi-cloud-upload-outline fs-24 text-danger"></i> 
											<input type="file" name="uploadPic" id="upload-sch-logo" class="form-control hide">
										</label> 
										<div class="form-text fob-btn-div"> 
											<input type="hidden" name="query" value="logo" /> 
											<div class="fs-14 fw-600 mb-10">Upload School Logo</div>
											<div class="text-danger">Only max image size of 2MB &amp; format of <?php echo $allowedPicExt; ?> are allowed.</div>
										</div>

										<div class="display-none mb-3 fob-btn-loader login-pro-px">
											<strong role="status">Processing...</strong>
											<div class="spinner-border ms-auto" aria-hidden="true"></div>
										</div>
									</div>
									<!-- file-wrapper end -->
								</div> 
							</div>
							<!-- /row -->							
						</form>	
						<!-- / form -->

						<!-- form -->
						<form class="form-horizontal" id="frmschoolSetup" role="form">
							<!-- row -->
							<div class="row gutters">
								<div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-12">										
									<!-- field wrapper start -->
									<div class="field-wrapper">		
										<input type="text"  id="schoolName" name="schoolName" 
										value ="<?php echo $schoolArray[0]['school_name']; ?>"
										class="form-control uppWords" placeholder="fobrains Pri/Sec School" >
										<div class="field-placeholder"> School Name <span class="text-danger">*</span></div>
									</div>
									<!-- field wrapper end -->
								</div>
                                <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12 col-12">										
									<!-- field wrapper start -->
									<div class="field-wrapper">										 
										<input type="text"  id="schoolAddress" name="schoolAddress" 
										value ="<?php echo $schoolArray[0]['school_address']; ?>"
										class="form-control uppWords" placeholder="No 004 fobrain Avenue" >
										<div class="field-placeholder"> School Address <span class="text-danger">*</span></div>
									</div>
									<!-- field wrapper end -->
								</div>																 
							</div>	
							<!-- /row -->

							<!-- row -->
							<div class="row gutters">
								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<select class="form-control"  name="nur_head" id="nur_head" required> 
											<option value = "">Please select One</option>							
											<?php
												try{
													echo staffSelectBox($conn, $staff_arr, $nur_head, false);
												}catch(PDOException $e) {				
													fobrainDie( 'Ooops Database Error: ' . $e->getMessage());													
												}
											?>
										</select>
										<div class="field-placeholder">Nursery Head Teacher <span class="text-danger">*</span></div> 
									</div>
									<!-- field wrapper end -->
								</div>
								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<select class="form-control"  name="pri_head" id="pri_head" required> 
											<option value = "">Please select One</option>							
											<?php
												try{
													echo staffSelectBox($conn, $staff_arr, $pri_head, false);
												}catch(PDOException $e) {				
													fobrainDie( 'Ooops Database Error: ' . $e->getMessage());													
												}
											?>
										</select>
										<div class="field-placeholder">Primary Head Teacher <span class="text-danger">*</span></div> 
									</div>
									<!-- field wrapper end -->
								</div>									 
								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<select class="form-control"  name="sec_head" id="sec_head" required> 
											<option value = "">Please select One</option>							
											<?php
												try{
													echo staffSelectBox($conn, $staff_arr, $sec_head, false);
												}catch(PDOException $e) {				
													fobrainDie( 'Ooops Database Error: ' . $e->getMessage());													
												}
											?>
										</select>
										<div class="field-placeholder">Secondary Head Teacher <span class="text-danger">*</span></div> 
									</div>
									<!-- field wrapper end -->
								</div>
							</div>	
							<!-- /row -->

							<!-- row -->
							<div class="row gutters">
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">										
									<!-- field wrapper start -->
									<div class="field-wrapper">		
										<select class="form-control"  name="bursary" id="bursary" required>
                                              
											<option value = "">Please select One</option>							
											<?php
												try{
  													echo staffSelectBox($conn, $staff_arr, $schoolArray[0]['bursary'], false);
												}catch(PDOException $e) {				
													fobrainDie( 'Ooops Database Error: ' . $e->getMessage());													
												}
											  ?>
										</select>
										<div class="field-placeholder"> School Bursary <span class="text-danger">*</span></div> 
									</div>
									<!-- field wrapper end -->
								</div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">										
									<!-- field wrapper start -->
									<div class="field-wrapper">										 
										<select class="form-control"  name="libraian" id="libraian" required> 
											<option value = "">Please select One</option>							
											<?php
												try{
													echo staffSelectBox($conn, $staff_arr, $schoolArray[0]['libraian'], false);
												}catch(PDOException $e) {				
													fobrainDie( 'Ooops Database Error: ' . $e->getMessage());													
												}
											?>
										</select>											 
										<div class="field-placeholder"> School Libraian <span class="text-danger">*</span></div>
									</div>
									<!-- field wrapper end -->
								</div>																 
							</div>	
							<!-- /row -->

							<!-- row -->
							<div class="row gutters">
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<input type="number"  id="schoolCutoff" name="schoolCutoff" 
                                        value ="<?php echo $schoolArray[0]['school_cutoff']; ?>"
                                        class="form-control" placeholder="40" >
										<div class="field-placeholder">  % To be Promoted <span class="text-danger">*</span></div> 
										<div class="form-text text-danger">
											Set student promotion cut off mark (Precentage).
										</div>
									</div>
									<!-- field wrapper end -->
								</div>
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<input type="number"  id="sTime" name="sTime" 
                                        class="form-control" placeholder="10" maxlength="5" value="<?php echo $schoolArray[0]['screen_timer']; ?>">
										<div class="field-placeholder">Screen Lock   (In Mins) <span class="text-danger">*</span></div>
										<div class="form-text text-danger">
											Leave empty to disenable auto lock screen .
										</div>
									</div>
									<!-- field wrapper end -->
								</div>		 
							</div>	
							<!-- /row --> 	 


							<!-- row -->
							<div class="row gutters">
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">										
									<!-- field wrapper start -->
									<div class="field-wrapper"> 
										<select class="form-control fob-select"  id="ewallet" name="ewallet" required>
                                              
											<option value = "">Please select One</option>							
											<?php

												foreach($ewallet_list as $ekey => $evalue){    /* loop array */

													if ($ewallet == $ekey){
														$selected = "SELECTED";
													} else {
														$selected = "";
													}

													echo '<option value="'.$ekey.'"'.$selected.'>'.$evalue.'</option>' ."\r\n";
													
												} 
											?>
										</select>
										<div class="field-placeholder">E - Wallet (Scratch Card) <span class="text-danger">*</span></div>
										<div class="form-text text-danger">
											Use Scratch Card Pin Features
										</div>
									</div>
									<!-- field wrapper end -->
								</div>
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">										
									<!-- field wrapper start -->
									<div class="field-wrapper"> 
										<select class="form-control fob-select"  id="transTo" name="transTo" required>
                                              
											<option value = "">Please select One</option>							
											<?php

												foreach($translatorArr as $trans_key => $trans_value){  /* loop array */

													if ($transFrom == $trans_key){
														$selected = "SELECTED";
													} else {
														$selected = "";
													}

													echo '<option value="'.$trans_key.'"'.$selected.'>'.$trans_value.'</option>' ."\r\n";

												}
											?>
										</select>
										<div class="field-placeholder">Select Language <span class="text-danger">*</span></div>
										<div class="form-text text-danger">
											App default language for all users
										</div>
									</div>
									<!-- field wrapper end -->
								</div>                                 														 
							</div>	
							<!-- /row -->

							<!-- row -->
							<div class="row gutters">
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<select class="form-control required fob-select"  id="tzone" name="tzone"> 
											<option value = "">Search . . .</option> 
											<?php

												foreach($timezonesArr as $tzoneK => $tzoneV){  /* loop array */

													if ($tzone == $tzoneK){
														$selected = "SELECTED";
													} else {
														$selected = "";
													}

													echo '<option value="'.$tzoneK.'"'.$selected.'>'.$tzoneV.'</option>' ."\r\n";

												}

											?> 
											
										</select>
										<div class="field-placeholder">Time Zone <span class="text-danger">*</span></div> 
									</div>
									<!-- field wrapper end -->
								</div>				
							</div>	
							<!-- /row -->
							
							<!-- row -->
							<div class="row gutters mt-20">
								<div class="col-12 text-end">
									<input type="hidden" name="query" value="setup" /> 
									<button type="submit" class="btn btn-primary waves-effect   
									btn-label waves-light  demo-disenable" id="schoolSetup">
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

			hidePageLoader();
			
			renderSelectImg("#nur_head", 1);
			renderSelectImg("#pri_head", 1);
			renderSelectImg("#sec_head", 1);
			renderSelectImg("#bursary", 1);
			renderSelectImg("#libraian", 1);  
			$('.fob-select').each(function() {  
				renderSelect($('#'+this.id)); 
			});
		</script>			