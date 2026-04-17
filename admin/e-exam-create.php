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
											+234 - 80 22 000 490			sales@fobrain.com 	(Sales Only)	
		
*/ 


if(!session_id()){
    session_start();
}

		define('fobrain', 'igweze');  /* define a check for wrong access of file */

		require 'fobrain-config.php';  /* load fobrain configuration files */	 
		 
?>
			
			<!-- form -->
			<form class="form-horizontal" id="frmsaveExam" role="form">			
			
				<!-- row -->
				<div class="row gutters">
					<div class="col-12">										
						<!-- field wrapper start -->
						<div class="field-wrapper select-wrapper">
							<select class="form-control fob-select"  id="subjTerm" name="eTerm" required>
							
								<option value = "">Please select One</option>
								<?php  

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
							<div class="icon-wrap"  id="wait" style="display: none;">
								<i class="loader"></i>
							</div>
							<input type="hidden" value="saveExam" name = "exam"/>
							<input type="hidden" value="<?php echo $empty_str.':<$?$>:'.$empty_str.':<$?$>:'.$empty_str; ?>" 
							name = "euData" id="euData"/>							
							<div class="field-placeholder">  Term <span class="text-danger">*</span></div>
						</div>
						<!-- field wrapper end -->
					</div>																 
				</div>	
				<!-- /row -->				

				 
                <span id="result" style="display: none;"></span><!-- loading div -->  
			
				<div id="subjectExamDiv" style="display:none;">   
				
					<?php if ($admin_grade == $cm_fobrain_grd) {  ?>

					<!-- row -->
					<div class="row gutters">
						<div class="col-12">										
							<!-- field wrapper start -->
							<div class="field-wrapper select-wrapper">					
								<select class="form-control fob-select"  id="subjectLevel" name="subjectLevel" required>
								
									<option value = "">Please select One</option>
									<?php 
									
										try  {
											
											formTeacherSession($conn, $adminID, $fobrainMode);  /* class teacher school session  */ 
									
										}catch(PDOException $e) {
			
											fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
				
										} 
										
									?>
								
								</select>
								<div class="icon-wrap"  id="wait_1" style="display: none;">
									<i class="loader"></i>
								</div>
								<input type="hidden" name ="classAll" id="classAll" value="<?php echo $i_false; ?>" />
								
								<div class="field-placeholder"> Level <span class="text-danger">*</span></div>
							</div>
							<!-- field wrapper end -->
						</div>																 
					</div>	
					<!-- /row -->

					<?php }else{ ?>	 
				
					<!-- row -->
					<div class="row gutters">
						<div class="col-12">										
							<!-- field wrapper start -->
							<div class="field-wrapper select-wrapper">	
								
								<select class="form-control fob-select"  id="subjectLevel" name="subjectLevel" required>
								
									<option value = "">Please select One</option>
									<?php 
									
										try {
										
											schoolSessionL($conn);  /* school session  */
									
										}catch(PDOException $e) {
			
										fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
				
										}

									?>
								
								</select>
								<div class="icon-wrap"  id="wait_1" style="display: none;">
									<i class="loader"></i>
								</div>
								<input type="hidden" name ="classAll" id="classAll" value="<?php echo $fiVal; ?>" />
								
								<div class="field-placeholder">  Level <span class="text-danger">*</span></div>
							</div>
							<!-- field wrapper end -->
						</div>																 
					</div>	
					<!-- /row -->
				
					<?php } ?>

					
					<span id="result_1" style="display: none;"></span><!-- loading div --> 
					

					<!-- row -->
					<div class="row gutters">
						<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">										
							<!-- field wrapper start -->
							<div class="field-wrapper">
								<input type="number"  id="eTime" name="eTime" 
								class="form-control" placeholder="60" maxlength="3" required>							
								<div class="field-placeholder"> Duration <span class="text-danger">*</span></div>
								<div class="form-text text-danger fw-500">
									In Minutes eg 10, 20
								</div>
							</div>
							<!-- field wrapper end -->
						</div>																 
					 
						<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">										
							<!-- field wrapper start -->
							<div class="field-wrapper">			
								<select class="form-control fob-select" id="status" name="status" required> 
 
									<?php

									foreach($lockArr as $status_key => $status_value){  /* loop array */

										if ($status == $status_key){
											$selected = "SELECTED";
										} else {
											$selected = "";
										}

										echo '<option value="'.$status_key.'"'.$selected.'>'.$status_value.'</option>' ."\r\n";

									}	     	
									?> 

								</select>

								<div class="field-placeholder"> Status <span class="text-danger">*</span></div>													
							</div>
							<!-- field wrapper end -->
						</div>																 
					</div>	
					<!-- /row -->

					<!--
					<!- - row -- >
					<div class="row gutters">
						<div class="col-12">										
							<!-- field wrapper start -- >
							<div class="field-wrapper">
							
								<textarea rows="4" cols="10" class="form-control" name="eDetail" id="eDetail" 
								placeholder="Enter Exam Instructions"></textarea>
									
									<div class="field-placeholder">Select Term<span class="text-danger">*</span></div>
								</div>
								<!- - field wrapper end -- >
								</div>																 
						</div>	
						<!- - /row -- >
				
					-->

					<!-- row -->
					<div class="row gutters mt-30">
						<div class="col-12 text-end"> 
							<button type="submit" class="btn btn-primary waves-effect   
							btn-label waves-light" id="saveExam">
								<i class="mdi mdi-content-save label-icon"></i>  Save & Continue
							</button>
						</div>
					</div>	
					<!-- /row -->	 

				</div>
		
			</form><!-- / form --> 					  

			<script type="text/javascript">	  
				$('.fob-select').each(function() {  
					renderSelect($('#'+this.id)); 
				});
			</script>				