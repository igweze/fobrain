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
	This script handle exam configuration
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

     define('fobrain', 'igweze');  /* define a check for wrong access of file */

         require 'fobrain-config.php';  /* load fobrain configuration files */	   
		 		 
		 
		 try {
		 

  				$examArray = schoolExamConfigArrays($conn);  /* school exam configuration array  */
				$exam_status = $examArray[0]['status'];
				$rsType = $examArray[0]['rsType'];	
				
		 }catch(PDOException $e) {
  			
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			 
		 }
		
		
		
?>		

			<!-- row -->
			<div <?php echo $fob_view; ?> class="row gutters row-section fobrain-section-div justify-content-center">
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">	
				<!-- card start -->
				<div class="card card-shadow">
					<div class="card-header-wiz">
						<h4>
							<i class="mdi mdi-database-cog fs-18"></i> 
							School</span> Exam Configuration
						</h4>
					</div> 
					<div id="msg-box"></div> 					
					<div class="card-body">
					<div class="row gutters mb-10">
						<div class="hints">[<i class="mdi mdi-help-circle-outline"></i>] Ass. is Assessment</div>
					</div>	
						<!-- form -->
						<form class="form-horizontal" id="frmexamConfigs" role="form">
							<!-- row -->
							<div class="row gutters">
								<div class="col-lg-6">
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<select class="form-control fob-select"  id="rsType" name="rsType" required>
											<?php 

												foreach($rsTypeArr as $rsTypeKey => $rsTypeVal){

													if ($rsType == $rsTypeKey){
														
														$selected = "SELECTED";
														
													} else {
														
														$selected = "";
														
													}

													echo '<option value="'.$rsTypeKey.'"'.$selected.'>'.$rsTypeVal.'</option>' ."\r\n";

												}

											?> 
                                              
                                        </select>
										<div class="field-placeholder"> Result School Type  <span class="text-danger">*</span></div>
									</div>
									<!-- field wrapper end -->
								</div>									 
						 
								<div class="col-lg-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<select class="form-control fob-select"  id="status" name="status" required> 
											<option value = "">Please select One</option>
											<?php 
												for($i = $fiVal; $i <= $sixVal; $i++){  /* loop array */															
														
													if($i == $exam_status){
									
														$select = 'selected';
									
													}else{
									
														$select = '';
														
													}															

													echo '<option value="'.$i.'" '.$select.'>'.$i.'</option>' ."\r\n";
			
												}		 
											?> 		
										</select>
										<div class="field-placeholder">  No. of Continous Ass.   <span class="text-danger">*</span></div>
									</div>
									<!-- field wrapper end -->
								</div>									 
							</div>	
							<!-- /row -->
							
							<!-- row -->
							<div class="row gutters">
								<div class="col-lg-6" id="first-div">										
									<!-- field wrapper start -->
									<div class="field-wrapper">										 
										<input type="number"  id="first" name="first" 
									 	 value ="<?php echo $examArray[0]['fi_ass']; ?>"
										class="form-control" placeholder="10, 20" required>			
										<div class="field-placeholder"> 1st  Ass. Score <span class="text-danger">*</span></div>
									</div>
									<!-- field wrapper end -->
								</div>
								<div class="col-lg-6" id="second-div">										
									<!-- field wrapper start -->
									<div class="field-wrapper">										 
										<input type="number"  id="second" name="second" 
									 	 value ="<?php echo $examArray[0]['se_ass']; ?>"
										class="form-control" placeholder="10, 20" required>			
										<div class="field-placeholder"> 1st  Ass. Score <span class="text-danger">*</span></div>
									</div>
									<!-- field wrapper end -->
								</div>
								<div class="col-lg-6" id="third-div">										
									<!-- field wrapper start -->
									<div class="field-wrapper">										 
										<input type="number"  id="third" name="third" 
									 	 value ="<?php echo $examArray[0]['th_ass']; ?>"
										class="form-control" placeholder="10, 20" required>			
										<div class="field-placeholder"> 1st  Ass. Score <span class="text-danger">*</span></div>
									</div>
									<!-- field wrapper end -->
								</div>
								<div class="col-lg-6" id="fourth-div">										
									<!-- field wrapper start -->
									<div class="field-wrapper">										 
										<input type="number" id="fourth" name="fourth"
									 	 value ="<?php echo $examArray[0]['fo_ass']; ?>"
										class="form-control" placeholder="10, 20" required>			
										<div class="field-placeholder"> 1st  Ass. Score <span class="text-danger">*</span></div>
									</div>
									<!-- field wrapper end -->
								</div>
								<div class="col-lg-6" id="fifth-div">										
									<!-- field wrapper start -->
									<div class="field-wrapper">										 
										<input type="number"  id="fifth" name="fifth" 
									 	 value ="<?php echo $examArray[0]['fif_ass']; ?>"
										class="form-control" placeholder="10, 20" required>			
										<div class="field-placeholder"> 1st  Ass. Score <span class="text-danger">*</span></div>
									</div>
									<!-- field wrapper end -->
								</div>
								<div class="col-lg-6" id="sixth-div">										
									<!-- field wrapper start -->
									<div class="field-wrapper">										 
										<input type="number" id="sixth" name="sixth" 
									 	 value ="<?php echo $examArray[0]['six_ass']; ?>"
										class="form-control" placeholder="10, 20" required>			
										<div class="field-placeholder"> 1st  Ass. Score <span class="text-danger">*</span></div>
									</div>
									<!-- field wrapper end -->
								</div> 															 
							 
								<div class="col-lg-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<input type="number"  id="exam" name="exam" 
									 	value ="<?php echo $examArray[0]['exam']; ?>"
									 	class="form-control" placeholder="60, 70" required>
										<div class="field-placeholder"> Exam Score  <span class="text-danger">*</span></div>
									</div>
									<!-- field wrapper end -->
								</div>									 
							</div>	
							<!-- /row -->
							
							<!-- row -->
							<div class="row gutters mt-30">
								<div class="col-12 text-end">
									<input type="hidden" name="query" value="exam-configs" />
									<button type="submit" class="btn btn-primary waves-effect   
									btn-label waves-light demo-disenable" id="examConfigs">
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
	
			$(function() { 
				
				function setExamPara(){	 /* fuction to show or hide exam inputs depending on the exam status */						
					
					var status = $('#status').val();
					
					if(status == 1){
						
						$('#first-div').show();
						$('#second-div, #third-div, #fourth-div, #fifth-div, #sixth-div').hide(); 

						//$('#second-div, #third-div, #fourth-div, #fifth-div, #sixth-div').removeAttr('required');
						
						$('#second').val(0);
						$('#third').val(0);
						$('#fourth').val(0);
						$('#fifth').val(0);
						$('#sixth').val(0);
							
					}else if(status == 2){
							
						$('#first-div, #second-div').show();
						$('#third-div, #fourth-div, #fifth-div, #sixth-div').hide(); 
						//$('#third-div, #fourth-div, #fifth-div, #sixth-div').removeAttr('required');
						
						$('#third').val(0);
						$('#fourth').val(0);
						$('#fifth').val(0);
						$('#sixth').val(0);
						
					}else if(status == 3){
							
						$('#first-div, #second-div, #third-div').show();								 
						//$('#fourth-div, #fifth-div, #sixth-div').removeAttr('required');								
						$('#fourth').val(0);
						$('#fifth').val(0);
						$('#sixth').val(0);

						$('#fourth-div, #fifth-div, #sixth-div').hide(); 
						
					}else if(status == 4){
							
						$('#first-div, #second-div, #third-div, #fourth-div').show();
						$('#fifth-div, #sixth-div').hide();  
						//$('#fifth-div, #sixth-div').removeAttr('required');
						
						$('#fifth').val(0);
						$('#sixth').val(0);
						
					}else if(status == 5){
							
						$('#first-div, #second-div, #third-div, #fourth-div, #fifth-div').show();
						$('#sixth-div').hide();  
						//$('#sixth-div').removeAttr('required');
						
						$('#sixth').val(0);
						
					}else{

						$('#first-div, #second-div, #third-div, #fourth-div, #fifth-div, #sixth-div').show();  

					}
					
					
				}	
				
				$('body').on('change','#status',function(){
															
					setExamPara();
		
					return false;
					
				});
				
				setExamPara();
			}); 

			$('.fob-select').each(function() {  
				renderSelect($('#'+this.id)); 
			});
 
		</script>
 