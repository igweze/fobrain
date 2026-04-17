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
	This page handle load common input 
	------------------------------------------------------------------------*/ 


		if (!defined('fobrain')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
				
		 

?>
 
		<?php if ($admin_grade == $cm_fobrain_grd) {  /*  check if school staff */ ?>

			<?php if ($fobrainMode == $fiVal){  /* session run mode */ ?>
				<!-- row -->
				<div class="row gutters">
					<div class="col-12">										
						<!-- field wrapper start -->
						<div class="field-wrapper select-wrapper">                                       
							<select class="form-control fob-select session-select"  id="ftSession" name="sess" required>
						
							<option value = "">Search . . .</option>
							<?php 
							
								try  {
									
									formTeacherSession($conn, $adminID, $fobrainMode);  /* class teacher school session  */ 
						
								}catch(PDOException $e) {

									fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
	
								} 
									
							?>
						
							</select>  
							<div class="icon-wrap"  id="wait_1" style="display: none">
								<i class="loader"></i>
							</div>
							<div class="field-placeholder"> School Session <span class="text-danger">*</span></div>
						</div>
						<!-- field wrapper end -->
						<?php echo $sessNote; ?>
					</div>									 
				</div>	
				<!-- /row -->


			<?php } ?>
			
			<?php if ($fobrainMode == $seVal){  /* current run mode */ ?>
				<!-- row -->
				<div class="row gutters">
					<div class="col-12">										
						<!-- field wrapper start -->
						<div class="field-wrapper select-wrapper">                                        
							<select class="form-control fob-select session-select"  id="ftSessL" name="ftSessL" required>
						
							<option value = "">Search . . .</option> 
							<?php 
							
								try  {
									
									formTeacherSession($conn, $adminID, $fobrainMode);  /* class teacher school session  */ 
						
								}catch(PDOException $e) {

									fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
	
								} 
									
							?>
						
							</select>
							<div class="icon-wrap"  id="wait_1" style="display: none">
								<i class="loader"></i>
							</div>
							<div class="field-placeholder"> School Level <span class="text-danger">*</span></div>
						</div>
						<!-- field wrapper end --> 
					</div>									 
				</div>	
				<!-- /row -->	

			<?php } ?> 
						
			<?php }else{ ?>  	

			<?php if ($fobrainMode == $fiVal){  /* session run mode */ ?>
		
				<!-- row -->
				<div class="row gutters">
					<div class="col-12">										
						<!-- field wrapper start -->
						<div class="field-wrapper">                                         
							<select class="form-control fob-select session-select"  id="sess" name="sess" required>
						
							<option value = "">Search . . .</option>
							<?php 
								try {
									
									schoolSession($conn); /* school session  */
						
								}catch(PDOException $e) {

									fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
	
								} 
							?>
						
							</select>
							<div class="field-placeholder"> School Session <span class="text-danger">*</span></div>
						</div>
						<!-- field wrapper end -->
						<?php echo $sessNote; ?>
					</div>									 
				</div>	
			<!-- /row -->
			
				<!-- row -->
				<div class="row gutters">
					<div class="col-12">										
						<!-- field wrapper start -->
						<div class="field-wrapper select-wrapper">                                             
							<select class="form-control fob-select level"  id="levelCM" name="level" required>
						
							<option value = "">Search . . .</option>
							<?php 
							
								try {
									
									studentLevel($conn);  /* retrieve student level */
						
								}catch(PDOException $e) {

									fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
	
								} 
							?> 
						
							</select>
							<div class="icon-wrap"  id="wait_1" style="display: none">
								<i class="loader"></i>
							</div>
							<div class="field-placeholder"> School Level <span class="text-danger">*</span></div>
						</div>
						<!-- field wrapper end --> 
					</div>									 
				</div>	
				<!-- /row -->	
			
			<?php } ?>
			
			<?php if ($fobrainMode == $seVal){  /* current run mode */ ?>   
			
				<!-- row -->
				<div class="row gutters">
					<div class="col-12">										
						<!-- field wrapper start -->
						<div class="field-wrapper select-wrapper">                                        
							<select class="form-control fob-select session-select"   id="sesslevel" name="sesslevel" required>
								<option value = "">Search . . .</option>
								<?php 
								
									try {
									
										schoolSessionL($conn);  /* school session  */
							
									}catch(PDOException $e) {

										fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
		
									}

								?> 
							</select>
							<div class="icon-wrap"  id="wait_1" style="display: none">
								<i class="loader"></i>
							</div>
							<input type="hidden" name ="classAll" id="classAll" value="<?php echo $show_all; ?>" />
							<div class="field-placeholder"> School Level <span class="text-danger">*</span></div>
						</div>
						<!-- field wrapper end --> 
					</div>									 
				</div>	
				<!-- /row -->	

			<?php } ?>  
			

			<?php } ?> 
			
				
			<span id="result_1" style="display: none;"></span><!-- loading div -->
			<script type="text/javascript">	 
				$('.fob-select').each(function() {  
					renderSelect($('#'+this.id)); 
				});
			</script> 