	<?php  if ($_SESSION['screen_lock'] == 0000) {  /* check if screen lock is activated */  ?>	  
				<!-- footer start -->
                <footer class="footer">				 
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">                               
								 <?php echo $fobrain_footer; ?>
                            </div> 
                        </div>
                    </div>
                </footer>
				<!-- footer end -->
				<a href="javascript:;" class="back-to-top">Back to Top</a>
            </div>
            <!-- / main content-->
		
        </div>
        <!-- / layout-wrapper -->
		 
        <!-- right sidebar -->
        <div class="right-bar">
            <div data-simplebar class="h-100">
                <div class="header d-flex align-items-center bg-dark py-15 px-20"> 
                    <h5 class="m-0 me-2 text-white">
						<i class="mdi mdi-account-cog-outline fs-18"></i> 
						Page Settings
					</h5> 
                    <a href="javascript:void(0);" class="right-bar-toggle ms-auto">
                        <i class="mdi mdi-close noti-icon"></i>
                    </a>
                </div> 
                <hr class="m-0" /> 
				<div class="row mt-0">				
					<div class="card">  
						<!-- card body -->
						<div class="card-body">	  
							<!-- row -->
							<div class="row gutters justify-content-center"> 
								<h5 class="my-15 text-info">  
									Current School Session  : 
									<span class="fw-600 text-danger">
									 <?php echo $currentSessTop; ?>
									</span> 
								</h5>
								<?php if(($admin_grade == $admin_fobrain_grd) && ($admin_level == $admin_tagged) ||
                                    ($admin_grade == $hm_fobrain_grd) && ($admin_level == $hm_fob_tagged)){  /* check if user is admin or hm */  ?> 
								<div id="msg-box"></div>
								<!-- form -->
								<form class="form-horizontal" id="frmcurrentSession2" role="form">
									<!-- row -->
									<div class="row gutters">
										<div class="col-12">										
											<!-- field wrapper start -->
											<div class="field-wrapper">
												<select class="form-control fob-select-sess fob-select-cm"  id="sess" name="sess" required>                                              
													<option value = "">Please select One</option>
													<?php 
														try {
														
															currentSession($conn);  /* current school session  */
												
														}catch(PDOException $e) {
							
														fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
							
														} 
													?> 
												</select>
												<div class="field-placeholder">Current   Session  <span class="text-danger">*</span></div>
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
												<select class="form-control fob-select-sess fob-select-cm"  id="term" name="term" placeholder="Search ..." required>                                              
													<option value = "">Please select One</option>
													<?php

														try {
														
															$curTerm = currentSessionTerm($conn); /* current school term  */
												
														}catch(PDOException $e) {
							
															fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
							
														}  

														foreach($term_list as $term_key => $term_value){  /* loop array */

															if ($curTerm == $term_key){
																$selected = "SELECTED";
															} else {
																$selected = "";
															}

															echo '<option value="'.$term_key.'"'.$selected.'>'.$term_value.'</option>' ."\r\n";

														}

													?>
													
												</select>			
												<div class="field-placeholder"> Current Term <span class="text-danger">*</span></div>
											</div>
											<!-- field wrapper end -->
										</div> 														 
									</div>	
									<!-- /row -->
									
									<!-- row -->
									<div class="row gutters mt-20">
										<div class="col-12 text-end">
											<input type="hidden" name="session" value="update-current" /> 
											<button type="submit" class="btn btn-primary waves-effect   
											btn-label waves-light" id="currentSession2">
												<i class="mdi mdi-content-save label-icon"></i>  Save
											</button>
										</div>
									</div>	
									<!-- /row -->									
								</form>
								<!-- / form -->	
								<?php }  ?> 			
								
								<?php //if(($admin_grade == "") || ($admin_level == "")){  ?>
								<hr class="my-15 p-0 text-danger"/>

								<?php									  
									if ($fobrainMode == $seVal){  /* current run mode */ $modeS = "style='display:none'"; }else{$modeS = "";}									  
									if ($fobrainMode == $fiVal){  /* session run mode */ $modeF = "style='display:none'"; }else{$modeF = "";}
								?>

								<div class="col-12 text-center">
									<div class="dropdown-center">
										<button class="btn btn-danger dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
											<i class="fa fa-cubes fa-lg"></i> <span class="middle-menu-div"> Run Mode -</span> <strong><span id="runModeText">
											<?php echo $fobrainRunModeArr[$fobrainMode]; ?></span></strong>
										</button>
										<ul class="dropdown-menu"> 
											<li class ="school-mode" id="school-mode-2" <?php echo $modeS; ?> >
												<a class="dropdown-item" href="javascript:;">Activate 
												<?php echo $fobrainRunModeArr[$seVal]; ?> Mode</a>
											</li> 
											<li class ="school-mode" id="school-mode-1" <?php echo $modeF; ?> >
												<a class="dropdown-item" href="javascript:;">Activate 
												<?php echo $fobrainRunModeArr[$fiVal]; ?> Mode</a>
											</li> 
										</ul>
									</div>
								</div> 
								<?php //}  ?>						

								<hr class="my-15 p-0 text-danger"/> 
								
								<h5 class="my-15 text-info"> Sidebar Settings </h5>
								<div class="col-12 text-center">
									<div class="btn-group" role="group" aria-label="Basic radio toggle button group">
										<input type="radio" class="btn-check" name="sidebar-size" id="sidebar-size-default" 
										value="default" onchange="document.body.setAttribute('data-sidebar-size', 'lg')" autocomplete="off" checked>
										<label class="btn btn-outline-primary" for="sidebar-size-default">Default Menu</label>

										<input type="radio" class="btn-check" name="sidebar-size" id="sidebar-size-small" 
										value="small" onchange="document.body.setAttribute('data-sidebar-size', 'sm')" autocomplete="off">
										<label class="btn btn-outline-primary" for="sidebar-size-small">Small Menu</label>				
									</div> 
								</div>   
							</div> 
						</div>
						<!-- end card body -->						
					</div>
					<!-- end card -->					
				</div>
				<!-- end row -->	 
            </div> <!-- / slimscroll-menu-->
        </div>
        <!-- / right-bar -->

        <!-- right bar overlay-->
        <div class="rightbar-overlay"></div> 
 	
		<?php if($can_use_search == true){  ?> 
		<div id="search-overlay" class="search-overlay">
            <span class="closeSearchbtn" onclick="closeSearch()" title="Close Overlay">×</span>
            <div class="search-overlay-content">  
				<div class="row gutters  justify-content-center">
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">	
						<!-- field wrapper start -->
						<div class="field-wrapper select-wrapper" style="text-align: left !important;"> 
							<select class="form-control"  id="search-input" name="search-input" placeholder="Search Students . . .">
								<option value = "">Search Students . . . </option>
								<?php
									try {
									
										echo activeStudentOptions($conn);  /* student dropdown select option field */
								
									}catch(PDOException $e) {

										fobrainDie( 'Ooops Database Error: ' . $e->getMessage());

									}
								?> 
							</select>
							<div class="icon-wrap">
								<i class="mdi mdi-account-search-outline text-danger fs-18"></i> 
							</div> 						
						</div>
						<!-- field wrapper end -->	 
					</div>
				</div>
            </div>
        </div>

		<!--  fobrain modal start -->			
		<button type="button" class="btn modal-search-wiz  display-none"  data-bs-toggle="modal" data-bs-target="#modal-search-wiz"></button>				
		<!-- Scrollable modal -->
		<div class="modal fade animate__animated animate__zoomInDown" id="modal-search-wiz" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg modal-fullscreen-sm-down modal-dialog-scrollable">
				<div class="modal-content"> 
					<div class="modal-header"> 
						<h5 class="modal-title" id="exampleModalScrollableTitle"> 
							<i class="mdi mdi-account-search-outline label-icon"></i>  
							Student Manager
						</h5>									 
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div id="student-loader"> </div> 
					<div class="modal-body">
						<div id="modal-load-div"></div> 
					</div>					 
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		<!-- fobrain modal end --> 	 
		<div id="remove-msg"> </div> 

		<?php }else{  ?>  
		<div id="search-overlay" class="search-overlay">
            <span class="closeSearchbtn" onclick="closeSearch()" title="Close Overlay">×</span>
            <div class="search-overlay-content">  
				<div class="row gutters  justify-content-center">
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">	
						<!-- field wrapper start -->
						<div class="field-wrapper select-wrapper" style="text-align: left !important;"> 
							<select class="form-control"  id="search-input" name="search-input" placeholder="Search Students . . .">
								<option value = "">Search . . . (Disenable) </option>
								  
							</select>
							<div class="icon-wrap">
								<i class="mdi mdi-account-search-outline text-danger fs-18"></i> 
							</div> 						
						</div>
						<!-- field wrapper end -->	 
					</div>
				</div>
            </div>
        </div> 
		<?php }  ?>	
	<?php } ?> 
         
		<!-- jquery extentions -->

		<!-- jquery.min js -->
        <script type="text/javascript" src="<?php echo $fobrainTemplate; ?>js/jquery.min.js"></script>

		<!-- bootstrap.bundle js -->
        <script type="text/javascript" src="<?php echo $fobrainTemplate; ?>js/bootstrap.bundle.min.js"></script>

		<!-- pace js -->
		<script type="text/javascript" src="<?php echo $fobrainTemplate; ?>js/fobrain.js"></script>	 

		<!-- sweetalert2 js -->
		<script type="text/javascript" src="<?php echo $fobrainTemplate; ?>js/sweetalert2@11.js"></script> 

		<!-- aos js -->
		<script type="text/javascript" src="<?php echo $fobrainTemplate; ?>js/aos.js"></script>  
		 
		<?php if($can_use_search == true){  ?> 
		<!-- jodit.fat js -->
		<script type="text/javascript" src="<?php echo $fobrainTemplate; ?>js/jodit.fat.min.js"></script> 
		<?php }  ?>	
	<?php  if ($_SESSION['screen_lock'] == 0000) {  /* check if screen lock is activated */  ?>	  
		
		<!-- jquery-ui js -->
		<script type="text/javascript" src="<?php echo $fobrainTemplate; ?>js/jquery-ui.js"></script>

		<!-- metisMenu js -->
        <script type="text/javascript" src="<?php echo $fobrainTemplate; ?>vendors/metismenu/metisMenu.min.js"></script>

		<!-- simplebar js -->
        <script type="text/javascript" src="<?php echo $fobrainTemplate; ?>vendors/simplebar/simplebar.min.js"></script>

		<!-- intro js -->
        <script type="text/javascript" src="<?php echo $fobrainTemplate; ?>js/introjs.js"></script> 

		<!-- pace js -->
        <script type="text/javascript" src="<?php echo $fobrainTemplate; ?>vendors/pace-jx/pace.min.js"></script> 

        <!-- datatables js -->
		<script type="text/javascript" src="<?php echo $fobrainTemplate; ?>vendors/dataTables/datatables.min.js"></script>  
		
		<!-- tom select js -->
		<script type="text/javascript" src="<?php echo $fobrainTemplate; ?>vendors/tom-select/tom-select.complete.min.js"></script> 
		 		 
		<!-- date range js -->
		<script type="text/javascript" src="<?php echo $fobrainTemplate; ?>vendors/bootstrap-daterangepicker/moment.js"></script>
		<script type="text/javascript" src="<?php echo $fobrainTemplate; ?>vendors/bootstrap-daterangepicker/daterangepicker.min.js"></script> 
  
		<!-- fullscreen js -->
		<script type="text/javascript" src="<?php echo $fobrainTemplate; ?>js/fullscreen.js"></script>
		
		<!-- fullcalendar js -->
		<script type="text/javascript" src="<?php echo $fobrainTemplate; ?>js/fullcalendar.js"></script>

		<!-- fobrain js -->
        <script type="text/javascript" src="<?php echo $fobrainTemplate; ?>js/fobrain-app.js"></script> 

		<script type="text/javascript">   

			var locator = "home";
			<?php  
				if($nav_render == 1){ 
					echo "$('#fobrain-content').load('navigator', {'iemj': locator});";
				}else{
					echo "$('#fobrain-content').load('navigator-s', {'iemj': locator});";
				}

				if($sibling_render == 1){ 
					echo 'renderSelectImg("#child-selector", 1);';
				}

				if($show_comp_wall == true){  /* companion wall initialization */ 

					echo "  
						$('.inboxMsgNum').html('$unreadMsg');
						var notificationNo = $('#notMsgDiv').text(); 
						$('.notMsgNum').html(notificationNo);";
							 
				}
			?>
			  
			<?php if($can_use_search == true){  ?>  
				 
				renderSelectImg("#search-input", 1); 

				$('body').on('change','#search-input',function(){  /* search student  */									 

					var studentData = $(this).val();
					var student = studentData.split('@');
					var studentID = student[1];
					studentID = studentID.trim(); 

					showPageLoader();
					$('#student-loader').html("");	
					$('#modal-load-div').show();
					$('#modal-load-div').load('student-profile.php', {'reg': studentID }); 
					$('.modal-search-wiz, .closeSearchbtn').trigger('click');   

					return false;

				});	

			<?php } ?>    
		</script> 
		</div>  
	<?php } ?>	  
		<script type="text/javascript">  
			<?php if ($_SESSION['screen_lock'] == 1111) {  /* check if screen lock is activated */  ?>	  
						hidePageLoader();
			<?php } ?>	  
			
			<?php if($fobrain_demo == 1){ ?>
			$('body').on('click','.demo-disenable',function(event){
                                                        
				event.stopImmediatePropagation(); 
					
				Swal.fire({
					title: "Information!",
					text: "Ooops, this function is disenable in this demo. Thanks",
					icon: "info"
				});
				
				return false; 
			
			});

			<?php } ?>	  
			 
			$('.fob-select-cm').each(function() {  
				renderSelect($('#'+this.id)); 
			});   
			
		</script>   
		 
		<div id="wizg-msg-box"></div>
		<div id="fobrain-base"></div>
		<!-- jquery 
		<div class="wiz-loader-2  wiz-glower display-none" id="virtual-loading">
			<div class="my-15">loading live</div>
			<div class="my-15">virtual class / meeting</div>
			<ul>
				<li></li> <li></li> 
				<li></li> <li></li> 
				<li></li> <li></li> 
				<li></li>
			</ul>
		</div>  -->   
    </body>  
</html>