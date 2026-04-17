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
	This script load application modules
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}
		
		define('fobrain', 'igweze');  /* define a check for wrong access of file */
		require_once 'sources/functions/fobrain-dir-in.php';  /* include configuration script */   
		
		if(($fobrainPortalRoot == '') || ($fobrainDB == '')){  /* check script installation */

$installScript =<<<IGWEZE
        
			<meta http-equiv="refresh" content="0;URL='./install/'" />
		
IGWEZE;
		
			echo $installScript;			 
			exit;
			
		}	
		
		require $fobrainDBConnectIndDir;  /* load connection string */ 
		require_once $fobrainFunctionDir;  /* load script functions */	 
		
		$past = time() - 3600;
		foreach ( $_COOKIE as $key => $value ) { /* check google translator cookies */ 
			setcookie( $key, $value, $past, '/' );
		}	
		
		/* reset and delete all session values */ 

		$_SESSION = array();

		if (ini_get("session.use_cookies")) {	
    		$params = session_get_cookie_params();
    		setcookie(session_name(), '', time() - 42000,
        		$params["path"], $params["domain"],
        		$params["secure"], $params["httponly"]
    		);
		}

		session_unset();
		session_destroy();	 	 
		
		try {
			
			$schoolDataArray = fobrainSchool($conn);  /* school configuration setup array  */					
			$schoolNameTop = $schoolDataArray[0]['school_name'];  
			$school_logo = $schoolDataArray[0]['school_logo']; 
			$sch_logo = picture($sch_logo_path, $school_logo, "logo-in");  
			$translator = $schoolDataArray[0]['translator'];
			
			if($translator == ""){
				$translator = "en/en";
			} 

			$translator = trim($translator);

		} catch(PDOException $e) {
			
			fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
   
		}		 	                 
?>
	<!doctype html>
	<html lang="en"> 
	<head>
		<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
        <meta charset="utf-8" />
        <title><?php echo $schoolNameTop; ?> | FoBrain </title>  
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"> -->
		
		<meta name="robots" content="ALL">
		<meta name="rating" content="GENERAL">
		<meta name="distribution" content="GLOBAL">
		<meta name="classification" content="open source, school portal, school management system, software, open source school management system">
		<meta name="copyright" content="fobrain https://www.fobrain.com">
		<meta name="author" content="IGWEZE EBELE MARK">
		<meta http-equiv="X-UA-Compatible" content="IE=edge" /> 
		<meta name="keywords" content="fobrain"  /> 
		<meta name="description" content=""/>
		
        <!-- favicon -->	
		<link rel="apple-touch-icon" sizes="180x180" href="<?php echo $fobrainTemplateIN; ?>favicon/apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="<?php echo $fobrainTemplateIN; ?>favicon/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="<?php echo $fobrainTemplateIN; ?>favicon/favicon-16x16.png">
		<link rel="manifest" href="<?php echo $fobrainTemplateIN; ?>favicon/site.webmanifest">
		<link rel="mask-icon" href="<?php echo $fobrainTemplateIN; ?>favicon/safari-pinned-tab.svg" color="#5bbad5">
		<meta name="msapplication-TileColor" content="#bfb3d4">
		<meta name="theme-color" content="#ffffff">  

		<?php if($translator != "en/en"){ ?> 
		<!-- Google tag (gtag.js) -->
		<style>#google_translate_element,.skiptranslate{display:none;}body{top:0!important;}
			#goog-gt-tt, .goog-te-balloon-frame{display: none !important;} 
			.goog-text-highlight { background: none !important; box-shadow: none !important;}
			.goog-logo-link{display: none !important;}
			.goog-te-gadget{height: 28px !important;  overflow: hidden;}
		</style>
		
		<script type="text/javascript">
			function googleTranslateElementInit() {
				//setLang('googtrans', '/en/ig', 1);
				setLang('googtrans', '/<?php echo $translator; ?>', 1);
				new google.translate.TranslateElement({ pageLanguage: 'ES', layout: google.translate.TranslateElement.InlineLayout.SIMPLE }, 'google_translate_element');
			}
			function setLang(key, value, expiry) {
				var expires = new Date();
				expires.setTime(expires.getTime() + (expiry * 24 * 60 * 60 * 1000));
				document.cookie = key + '=' + value + ';expires=' + expires.toUTCString();
			}
		</script> 
		<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
		<?php } ?>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date()); 
			gtag('config', 'G-4572FDKSHY');
		</script>


		<!-- stylesheet --> 
        <!-- vendor css -->
        <link rel="stylesheet" href="<?php echo $fobrainTemplateIN; ?>css/vendor.css" type="text/css" /> 
		 
		<!-- fobrain style css -->
        <link href="<?php echo $fobrainTemplateIN; ?>css/fobrain-style.css" rel="stylesheet" type="text/css" /> 

		<!-- / stylesheet -->
		<noscript> <meta http-equiv="refresh" content="0; URL=no-scripts"> </noscript> 
 
    </head>

    <body class="bg-body"> 
		
		<!----pre loader----->
		<div id="preload-wrapper">
			<div class="preloader" 
				style="background-image:url(<?php echo $fobrainTemplateIN; ?>/images/preloader.gif)">
			</div> 
		</div>
		<!----pre loader end-----> 
        <div id="google_translate_element"></div>                 
		<!-- <body data-layout="horizontal"> -->
        <div class="wiz-auth-wrapper">
            <div class="container-fluid p-0">
                <div class="row g-0" >
                    <div class="col-xxl-4 col-lg-4 col-md-12">
                        <div class="wiz-auth-body d-flex px-10">
                            <div class="w-100">
                                <div class="d-flex flex-column h-100">                                    
                                    <div class="wiz-auth-content my-auto">
										<div class="wiz-auth-img text-center mb-2 mt-4">
                                            <img src="<?php echo $sch_logo; ?>" class="rounded-circle img-thumbnail img-h-80" alt="thumbnail">
                                        </div>
                                        <div class="text-center wiz-auth-title">
                                            <h3 class="mb-1 text-primary"><?php echo $schoolNameTop; ?> </h3> 
                                        </div>
										<div id="msg-box"></div> 
                                        <form class="mt-1 pt-0 login-form" id="frmLogin" method="POST" autocomplete="off">
											 
											<div class="login-pro text-center m-3">
												<p><span class="text-primary fw-500">Login</span> <span class="text-danger fw-500">As</span></p>
												<ul>
													<li><input type="radio" name="logintype" value="student" id="cb1" />
														<label for="cb1"><img src="<?php echo $fobrainTemplateIN; ?>/images/s1.png" /></label>
														<span>Student<br />&nbsp</span>
													</li>
													<li><input type="radio" name="logintype" value="parent" id="cb2" />
														<label for="cb2"><img src="<?php echo $fobrainTemplateIN; ?>/images/s2.png" /></label>
														<span>Parent<br />&nbsp</span>
													</li>
													<li><input type="radio" name="logintype" value="staff" id="cb3" />
														<label for="cb3"><img src="<?php echo $fobrainTemplateIN; ?>/images/s3.png" /></label>
														<span>Staff / <br /> Admin</span>
													</li> 
												</ul>  
											</div>	

											<div class="col-12 login-pro-px">												
												<!-- field wrapper start -->
												<div class="field-wrapper">
													<input type="text" class="form-control" placeholder="Enter user name"  name="username" id="username">
													<div class="field-placeholder">Username <span class="text-danger">*</span></div>													 
												</div>
												<!-- field wrapper end -->
											</div>
											
											<div class="col-12 login-pro-px">												
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
											
                                            <div class="mb-3 fob-btn-div login-pro-px">
                                                <button class="btn btn-primary w-100 waves-effect waves-light" id="login-btn" type="submit">Log In</button>
                                            </div>  
											<div class="display-none mb-3 fob-btn-loader login-pro-px">
												<strong role="status">Processing...</strong>
												<div class="spinner-border ms-auto" aria-hidden="true"></div>
											</div> 
											<input type="hidden" name="profile"  value="login" />
											<div class="mt-5 text-center login-pro-px">
												<p class="mb-2">Enroll your kid/s ? 
												<a href="javascript:;" class="text-primary fw-semibold registration"> Register </a></p>
												<p class="mb-1"> 
												  <a href="javascript:;" class="text-danger fw-semibold recoverPass"> Forget Password  </a> </p>
											</div>
                                        </form>  

										<form class="mt-4 pt-2 display-none login-form login-pro-px" id="frmrecoverPass" method="POST">
											<div class="col-12">												
												<!-- field wrapper start -->
												<div class="field-wrapper">
													<input type="email" class="form-control" placeholder="Enter User Email"  name="userMail" id="userMail">
													<div class="field-placeholder">Email <span class="text-danger">*</span></div>
													<div class="form-text">
														Please enter staff or admin email
													</div>
												</div>
												<!-- field wrapper end -->
											</div>	 
                                            <div class="mb-3 fob-btn-div">
                                                <button class="btn btn-primary w-100 waves-effect waves-light" id="recoverPass" type="submit">Reset</button>
                                            </div> 
											<div class="display-none mb-3 fob-btn-loader">
												<strong role="status">Processing...</strong>
												<div class="spinner-border ms-auto" aria-hidden="true"></div>
											</div> 
											<input type="hidden" name="profile"  value="reset" />
											<div class="mt-5 text-center">
												<p class="mb-2">Enroll your kid/s ? 
													<a href="javascript:;" class="text-primary fw-semibold registration"> Register Now </a>  
												</p> 
												<p class="mb-1">
													<a href="javascript:;" class="text-danger fw-semibold userSignin"> Sign In </a> 
												</p>
											</div>
                                        </form>   

										<!-- form -->
										<form class="form-horizontal mt-4 pt-2 login-pro-px display-none" id="frmupdatePass"> 
											<!-- row -->
											<div class="row gutters">  
												<div class=" col-12">										
													<!-- field wrapper start -->
													<div class="field-wrapper">
														<div class="input-group auth-pass-inputgroup">
															<input type="password" class="form-control required" placeholder="Enter password" name="new_pass" id="password" aria-label="Password" aria-describedby="password-addon">
															<button class="btn btn-white shadow-none border-password ms-0" type="button" id="password-icon"><i class=" fas fa-eye fs-12"></i></button>
														</div>
														<div class="field-placeholder">New Password  <span class="text-danger">*</span></div>													 
													</div>
													<!-- field wrapper end -->

													<div id="popover-password">
														<p><span id="result"></span></p>
														<div class="progress progress-password">
															<div id="password-strength" 
																class="progress-bar" 
																role="progressbar" 
																aria-valuenow="40" 
																aria-valuemin="0" 
																aria-valuemax="100" 
																style="width:0%">
															</div>
														</div>
														<ul class="list-unstyled">
															<li class="">
																<span class="low-upper-case">
																	<i class="fas fa-circle" aria-hidden="true"></i>
																	&nbsp;Lowercase &amp; Uppercase
																</span>
															</li>
															<li class="">
																<span class="one-number">
																	<i class="fas fa-circle" aria-hidden="true"></i>
																	&nbsp;Number (0-9)
																</span> 
															</li>
															<li class="">
																<span class="one-special-char">
																	<i class="fas fa-circle" aria-hidden="true"></i>
																	&nbsp;Special Character (!@#$%^&*)
																</span>
															</li>
															<li class="">
																<span class="eight-character">
																	<i class="fas fa-circle" aria-hidden="true"></i>
																	&nbsp;Atleast 8 Character
																</span>
															</li>
														</ul>
													</div>
												</div>
												
												<div class="col-12">										
													<!-- field wrapper start -->
													<div class="field-wrapper">
														<input type="password" class="form-control pass-field" 
															name="confirm_new" id="confirm_new" require />
														<div class="field-placeholder">Confirm Password <span class="text-danger">*</span></div>
														
													</div>
													<!-- field wrapper end -->
												</div>	 		

											</div>	
											<!-- /row -->  
											
											
											<!-- row -->
											<div class="row gutters mt-30">
												<div class="col-6 text-start fob-btn-div">
													<button type="button" id="password-field" class="btn btn-danger">
														<i class="fas fa-eye label-icon" style="color:#fff"></i>
													</button>
												</div>
												<div class="col-6 text-end fob-btn-div">
													<input type="hidden" name="profile" value="access" />  
													<input type="hidden" name="user-mail"  value="<?php echo $userMail; ?>" />
													<button type="submit" class="btn btn-primary waves-effect   
													demo-disenable btn-label waves-light" id="updatePass">
														<i class="mdi mdi-content-save label-icon"></i>  Update
													</button>
												</div>

												<div class="display-none mb-3 fob-btn-loader">
													<strong role="status">Processing...</strong>
													<div class="spinner-border ms-auto" aria-hidden="true"></div>
												</div> 

												<div class="mt-5 text-center">
													<p class="mb-2">Enroll your kid/s ? 
														<a href="javascript:;" class="text-primary fw-semibold registration"> Register Now </a>  
													</p> 
													<p class="mb-1">
														<a href="javascript:;" class="text-danger fw-semibold userSignin"> Sign In </a> 
													</p>
												</div>
											</div>	
											<!-- /row -->	
										</form>   

                                    </div>
                                    <div class="text-center mt-20 mb-25">
										<?php echo $fobrain_footer_in; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end auth full page content -->
                    </div>
                    <!-- end col -->  
					<div class="col-xxl-8 col-lg-8 d-none d-sm-block d-sm-none d-md-block d-md-none d-lg-block d-flex align-content-center-q flex-wrap">						 
						<div class="wiz-auth-body d-flex  px-30">
                            <div class="w-100">
                                <div class="d-flex flex-column h-100">                                    
                                    <div class="wiz-auth-content my-auto"> 									
										<div id="carouselExampleAutoplaying" class="carousel slide carousel-fade" data-bs-ride="carousel">
										<div class="carousel-inner"> 
											<div class="carousel-item active">
												<img src="<?php echo $fobrainTemplateIN; ?>/images/intro/intro-1.jpg" 
												class="d-block w-100" alt="Image Slider">
												<div class="carousel-caption d-none d-md-block">
													<h5>Daily Motivational Quotes</h5>
													<p><?php echo $educationQuotesArr[(rand(1,36))]; ?></p>
												</div>
											</div>
											<div class="carousel-item">
												<img src="<?php echo $fobrainTemplateIN; ?>/images/intro/intro-2.jpg" 
												class="d-block w-100" alt="Image Slider">
												<div class="carousel-caption d-none d-md-block">
													<h5>Daily Motivational Quotes</h5>
													<p><?php echo $educationQuotesArr[(rand(1,36))]; ?></p>
												</div>
											</div>
											<div class="carousel-item">
												<img src="<?php echo $fobrainTemplateIN; ?>/images/intro/intro-3.jpg" 
												class="d-block w-100" alt="Image Slider">
												<div class="carousel-caption d-none d-md-block">
													<h5>Daily Motivational Quotes</h5>
													<p><?php echo $educationQuotesArr[(rand(1,36))]; ?></p>
												</div>
											</div>
											<div class="carousel-item">
												<img src="<?php echo $fobrainTemplateIN; ?>/images/intro/intro-4.jpg" 
												class="d-block w-100" alt="Image Slider">
												<div class="carousel-caption d-none d-md-block">
													<h5>Daily Motivational Quotes</h5>
													<p><?php echo $educationQuotesArr[(rand(1,36))]; ?></p>
												</div>
											</div>	
											<div class="carousel-item">
												<img src="<?php echo $fobrainTemplateIN; ?>/images/intro/intro-5.jpg" 
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
		
	 

		<!-- annoucement pop up modal start -->			
		<button type="button" class="btn modal-reg-div  display-none"  data-bs-toggle="modal" data-bs-target="#modal-reg-div">aaaaa</button>				
		<!-- Scrollable modal -->
		<div class="modal fade animate__animated animate__zoomInDown" id="modal-reg-div" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
			<div class="modal-dialog modal-fullscreen modal-dialog-scrollable">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalScrollableTitle"> 
							<i class="mdi mdi-account-tie label-icon"></i>  
							<span class="hide-res"><?php echo $schoolNameTop ?>  - </span>  New Registration 
						</h5>
						 	
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<?php						
							require_once "registraion.php";						
						?>
					</div>
					 
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		<!-- annoucement pop up modal end -->	 

        <!-- javascript --> 
		<script type="text/javascript" src="<?php echo $fobrainTemplateIN; ?>js/fobrain-root.js"></script>   
		<script type="text/javascript" src="<?php echo $fobrainTemplateIN; ?>/js/wizard-form.js"></script>
		<script type="text/javascript" src="<?php echo $fobrainTemplateIN; ?>js/password.js"></script>   
  
  
		<!-- / javascript  -->
		<div id="fobrain-base"> </div>		

<?php
	try {

		if((isset($_REQUEST['mail'])) && (isset($_REQUEST['r']))){
			
			$userMail = cleanEmail($_REQUEST['mail']); 
			$resetVal = clean($_REQUEST['r']); 
			$resetVal = clean($resetVal);	 		

			if(($resetVal != "") && ($userMail != "")){

				$reset_val = recoveryStaffInfo($conn, $userMail, $resetVal);

				list ($rInfo, $rTime, $userMail) = explode ("@(.$.)@", $reset_val);   		

				if($reset_val != ''){   /* check if recovery information is true  */	

					echo "<script type='text/javascript'>   
							$('#frmLogin, #frmrecoverPass').fadeOut(2000);  
							$('#frmupdatePass').fadeIn(2500);   
						</script>";
					
				}else{

					$msg_i = "Ooops Error, invalid password recovery information. Please try again"; 
					echo $infoMsg.$msg_i.$iEnd; 
					
				}
			}
		}


	} catch(PDOException $e) {

		fobrainDie( 'Ooops Database Error: ' . $e->getMessage());

	}		 
		 
?>			
    </body>
</html>

