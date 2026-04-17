<!--
 
	fobrain V 1
	Copyright 2017 SOFT DIGIT LTD

	fobrain is Dedicated To Almighty God, To My Parents, To My Fabulous and Supporting Wife Nkiruka 
	and To My Inestimable Sons Osinachi and Ifechukwu.

	This product includes responsive web and mobile application developed at SOFT DIGIT LTD by Mr Igweze Ebele Mark
	
	fobrain Contacts and Supports
	
	WEBSITE 					PHONES
	https://www.fobrain.com		+234 - 80 - 30 716 751, 		+234 - 80 - 22 000 490 
	
	EMAILS		SALES						SUPPORT						
				sales@fobrain.com			info@fobrain.com
	
	
	
	-------- Script Description --------
	This page is the student result search manager
		
-->

<?php

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
						$page_title = '<i class="mdi mdi-book-education fs-18"></i> 
						Results Manager';
						pageTitle($page_title, 0);	 
					?>
					<div class="card-body"> 
						<!-- form -->
						<form class="form-horizontal" id="frmviewRs" role="form">
							<!-- row -->
							<div class="row gutters"> 
								<?php if($fobrain_demo == 1){ ?>
								<div class="col-12">									
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<select class="form-control fob-select" id="rsType" name="rsType" required>
											<option value = "">Select One</option>
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
										<div class="field-placeholder"> Result Type <span class="text-danger">*</span></div>
										<div class="form-text text-danger">
											This is for demo purpose only. Only a result type is allowed @ a time. 
										</div>
									</div>
									<!-- field wrapper end -->	
								</div>
								<?php } ?>	
								<div class="col-12">									
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
								
								
								<div class="col-12">									
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<select class="form-control fob-select" id="term" name="term" required>
											<option value = "">Select One</option>
											<?php

												foreach($term_list as $term_key => $term_value){    /* loop array */

													if ($term_list == $term_value){
													$selected = "SELECTED";
													} else {
													$selected = "";
													}

													echo '<option value="'.$term_key.'"'.$selected.'>'.$term_value.'</option>' ."\r\n";													

												} 

												if($fobrain_demo == 0){	
													if($rsType == $fiVal){
														echo '<option value="all"'.$selected.'>Annual Result</option>' ."\r\n";
													}
												}

												if($fobrain_demo == 1){
													echo '<option value="all"'.$selected.'>Annual Result</option>' ."\r\n";		
												}	

											?>
										</select>	
										<div class="field-placeholder"> School Term <span class="text-danger">*</span></div> 
									</div>
									<!-- field wrapper end -->	
								</div>
								
								<span id="wait_1" style="display: none;"> <center><img alt="Please Wait" src="loading.gif"/> <!-- loading image --></center> <!-- loading image --> </span>
    							<span id="result_1" style="display: none;"></span> <!-- loading div -->  <!-- jquery loading div -->  
									
									
								<div class="col-12 text-end mt-30">
									<input name="rsData" value="viewRs" type="hidden"  />									
									<button type="submit" class="btn btn-primary waves-effect 
									btn-label waves-light"  id="viewRs">
									<i class="bx bx-search label-icon"></i>  Search									
									</button>                                                    
								</div>
							</div>
							<!-- / row -->
						<form>
						<!-- / form -->
					</div>
				</div>
				<!-- card end --> 
			</div>
		</div>
			 
		<!-- row -->
		<div class="row gutters  <?php echo $fob_view_2; ?>" id="wiz-slider">		
			<div class="col-12">	
				<!-- card start -->
				<div id="upload-qy-data" class="display-none"></div> 
				<div class="card card-shadow" id="printJS-form">				 		
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
		</script>								  