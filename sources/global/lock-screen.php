		<!-- lock screen --> 
        <div class="wiz-auth-wrapper">
            <div class="container-fluid p-0">
                <div class="row g-0">
                    <div class="col-xxl-4 col-lg-4 col-md-12">
                        <div class="wiz-auth-body d-flex px-30 card-shadow-off">
                            <div class="w-100">
                                <div class="d-flex flex-column h-100">                                    
                                    <div class="wiz-auth-content my-auto">

										<div class="text-center wiz-auth-title">
                                            <h2 class="mb-1 text-danger">Screen Lock </h2> 
                                            <p class="text-muted mt-2">Please enter your password to unlock the screen! </p>
                                        </div>  
                                        
										<div id="msg-box-log"></div> 

										<div class="wiz-auth-img text-center mb-4 mt-4 pt-2">
                                            <img src="<?php echo $screen_img; ?>" class="rounded-circle img-thumbnail img-h-120" alt="thumbnail">
                                            <h5 class="font-size-22 font-head-1 mt-5 text-primary"><?php echo $screen_name; ?></h5>
                                        </div>
										 
										<div id="msg-box-lo"></div>
										
                                        <form class="mt-1 pt-0 login-form" id="frm-lock-login" method="POST" autocomplete="off"> 
											 
											<div class="col-12">												
												<!-- field wrapper start -->
												<div class="field-wrapper">
													<div class="input-group auth-pass-inputgroup">
														<input type="password" class="form-control" placeholder="Enter user password" name="password" id="password" aria-label="Password" aria-describedby="password-addon">
														<button class="btn btn-white shadow-none border-password ms-0" type="button" id="password-icon"><i class=" fas fa-eye fs-12"></i></button>
                                                	</div>
													<div class="field-placeholder">Password <span class="text-danger">*</span></div>													 
												</div>
												<!-- field wrapper end -->
											</div>
											<div class="mb-3">
												<input type="hidden" name="timer" value="check">
                                                <button class="btn btn-primary w-100 waves-effect waves-light" id="lock-login" type="submit">Log In</button>
                                            </div>
											
											<input type="hidden" name="lData"  value="to-nkiru-my-wife" />
											<div class="mt-5 text-center">
												<p class="text-muted mb-0 <?php echo $screen_link; ?>"> 
													Not you (<span class="text-danger fw-semibold"><?php echo $screen_name; ?></span>)?
													<a href="javascript:;" id="log-out" class="text-primary fw-semibold registration">Log out</a>
												</p>
											</div>
                                        </form>  
                                    </div>
                                    <div class="mt-1 mt-md-3 text-center">
                                        <?php echo $fobrain_footer_in; ?>
                                    </div> 
                                </div>
                            </div>
                        </div>
                        <!-- end auth full page content -->
                    </div>
                    <!-- end col -->  
					<div class="col-xxl-8 col-lg-8 d-none d-sm-block d-sm-none d-md-block d-md-none d-lg-block justify-content-center">						 
						<div class="wiz-auth-body d-flex px-30 card-shadow-off">
                            <div class="w-100">
                                <div class="d-flex flex-column h-100">                                    
                                    <div class="wiz-auth-content my-auto"> 									
										<div id="carouselExampleAutoplaying" class="carousel slide carousel-fade" data-bs-ride="carousel">
										<div class="carousel-inner"> 
											<div class="carousel-item active">
												<img src="<?php echo $fobrainTemplate; ?>/images/intro/intro-1.jpg" 
												class="d-block w-100" alt="Image Slider">
												<div class="carousel-caption d-none d-md-block">
													<h5>Daily Motivational Quotes</h5>
													<p><?php echo $educationQuotesArr[(rand(1,36))]; ?></p>
												</div>
											</div>
											<div class="carousel-item">
												<img src="<?php echo $fobrainTemplate; ?>/images/intro/intro-2.jpg" 
												class="d-block w-100" alt="Image Slider">
												<div class="carousel-caption d-none d-md-block">
													<h5>Daily Motivational Quotes</h5>
													<p><?php echo $educationQuotesArr[(rand(1,36))]; ?></p>
												</div>
											</div>
											<div class="carousel-item">
												<img src="<?php echo $fobrainTemplate; ?>/images/intro/intro-3.jpg" 
												class="d-block w-100" alt="Image Slider">
												<div class="carousel-caption d-none d-md-block">
													<h5>Daily Motivational Quotes</h5>
													<p><?php echo $educationQuotesArr[(rand(1,36))]; ?></p>
												</div>
											</div>
											<div class="carousel-item">
												<img src="<?php echo $fobrainTemplate; ?>/images/intro/intro-4.jpg" 
												class="d-block w-100" alt="Image Slider">
												<div class="carousel-caption d-none d-md-block">
													<h5>Daily Motivational Quotes</h5>
													<p><?php echo $educationQuotesArr[(rand(1,36))]; ?></p>
												</div>
											</div>	 
										</div>
										<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
											<span class="carousel-control-prev-icon" aria-hidden="true"></span>
											<span class="visually-hidden">Previous</span>
										</button>
										<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
											<span class="carousel-control-next-icon" aria-hidden="true"></span>
											<span class="visually-hidden">Next</span>
										</button>
									</div> 
								</div> 
							</div> 
						</div> 
                    </div>
                    <!-- end col -->   
                </div>
                <!-- end row -->
            </div>
            <!-- end container fluid -->
        </div> 
        <!-- / lock screen> -->
		 <div class="" id="fobrain-content"></div>