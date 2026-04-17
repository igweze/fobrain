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
	This script handle installation modules
	------------------------------------------------------------------------*/
if(!session_id()){
	session_start();
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

	define('fobrain', 'igweze');  /* define a check for wrong access of file */	  
	$fobrainDir = '../';		 		
	require_once '../fobrain-box.php';  

	$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https' : 'http';
	$pageUrl = $protocol."://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";					
	$pageUrl = str_replace("install/","", $pageUrl);
	$app_error = "";
			
?>

<!doctype html>
<html lang="en">
 
<head>
		<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
        <meta charset="utf-8" />
        <title>FoBrain Installation Wizard</title>  
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"> -->
		
		<meta name="robots" content="ALL">
		<meta name="rating" content="GENERAL">
		<meta name="distribution" content="GLOBAL">
		<meta name="classification" content="school portal, school management system, software">
		<meta name="copyright" content="fobrain https://www.fobrain.com">
		<meta name="author" content="IGWEZE EBELE MARK">
		<meta http-equiv="X-UA-Compatible" content="IE=edge" /> 
		<meta name="keywords" content="fobrain"  /> 
		<meta name="description" content=""/>
		
        <!-- favicon -->	
		<link rel="apple-touch-icon" sizes="180x180" href="<?php echo $fobrainTemplate; ?>favicon/apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="<?php echo $fobrainTemplate; ?>favicon/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="<?php echo $fobrainTemplate; ?>favicon/favicon-16x16.png">
		<link rel="manifest" href="<?php echo $fobrainTemplate; ?>favicon/site.webmanifest">
		<link rel="mask-icon" href="<?php echo $fobrainTemplate; ?>favicon/safari-pinned-tab.svg" color="#5bbad5">
		<meta name="msapplication-TileColor" content="#bfb3d4">
		<meta name="theme-color" content="#ffffff">    

		<!-- stylesheet -->

        <!-- vendor css -->
        <link rel="stylesheet" href="<?php echo $fobrainTemplate; ?>css/vendor.css" type="text/css" /> 
		 
		<!-- fobrain style css -->
        <link href="<?php echo $fobrainTemplate; ?>css/fobrain-style.css" rel="stylesheet" type="text/css" /> 

		<!-- / stylesheet -->
		<noscript> <meta http-equiv="refresh" content="0; URL=no-scripts"> </noscript> 
 
    </head>

    <body class="bg-body">

        <!-- loading wrapper --> 
        <div id="preload-wrapper" class="loader-background hide">
            <div class="wiz-page-loader">
                <div class="cube-wrapper">
                    <div class="cube">
                        <div class="cube-faces">
                        <div class="cube-face shadow"></div>
                        <div class="cube-face bottom"></div>
                        <div class="cube-face top"></div>
                        <div class="cube-face left"></div>
                        <div class="cube-face right"></div>
                        <div class="cube-face back"></div>
                        <div class="cube-face front"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<!-- / loading wrapper --> 
                         
		<!-- <body data-layout="horizontal"> -->
        <div class="wiz-auth-wrapper">
            <div class="container-fluid p-0">
                <div class="row justify-content-center">
                    <div class="col-xxl-8 col-lg-8 col-md-12">
                        <div class="wiz-auth-body d-flex">
                            <div class="w-100">
                                <div class="d-flex flex-column h-100">                                    
                                    <div class="wiz-auth-content my-auto"> 
										<?php require_once "install-card.php"; ?> 
                                    </div>
                                    <div class="mt-1 mt-md-3 text-center">
										<?php echo $fobrain_footer_in; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end auth full page content -->
                    </div>
                     
                </div>
                <!-- end row -->
            </div>
            <!-- end container fluid -->
        </div>   
 
		<!-- javascript --> 
		<script type="text/javascript" src="<?php echo $fobrainTemplate; ?>js/fobrain-root.js"></script>   
		<script type="text/javascript" src="<?php echo $fobrainTemplate; ?>/js/wizard-form.js"></script>
		<script type="text/javascript" src="<?php echo $fobrainTemplate; ?>js/password.js"></script>  
		<!-- / javascript  -->

		<div id="fobrain-base"> </div>		

		<script type="text/javascript">   
			
			$(document).ready(function () {
				
				<?php if($app_error){  echo "$('#app-required').hide(100);";  } ?>  
				
				function isValidEmailAddress(emailAddress) {
					var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
					return pattern.test(emailAddress);
				} 			
				
				$('body').on('click','#install-script',function(){  /* install fobrain Script */
				
					var email = $("#email").val(); 
					
					if($('#acceptTerm').is(":not(:checked)")){
						
						<?php echo "$infoMsg1 Ooops, please accept our terms $sEnd1"; ?>
						return false;
						
					}else if($('#fname').val() == ""){
					
						<?php echo "$infoMsg1 Ooops, please enter first name $sEnd1"; ?>
						return false;
										
					}else if($('#lname').val() == ""){
					
						<?php echo "$infoMsg1 Ooops, please enter last name $sEnd1"; ?>
						return false;
										
					}else if((email == "") || (!isValidEmailAddress(email))){
					
						<?php echo "$infoMsg1 Ooops, please enter a valid email address $sEnd1"; ?>
						return false;
										
					}else if($('#password').val() == ""){
					
						<?php echo "$infoMsg1 Ooops, please enter a password $sEnd1"; ?>
						return false;
										
					}else if($('#url').val() == ""){
					
						<?php echo "$infoMsg1 Ooops, please enter a valid full url $sEnd1"; ?>
						return false;
										
					}else if($('#dname').val() == ""){
					
						<?php echo "$infoMsg1 Ooops, please enter database name $sEnd1"; ?>
						return false;
										
					}else if($('#dhost').val() == ""){
					
						<?php echo "$infoMsg1 Ooops, please enter database host $sEnd1"; ?>
						return false;
										
					}else if($('#duser').val() == ""){
					
						<?php echo "$infoMsg1 Ooops, please enter database user name $sEnd1"; ?>
						return false;
										
					}else if($('#dpassword').val() == ""){
					
						<?php echo "$infoMsg1 Ooops, please enter database  password $sEnd1"; ?>
						return false;
										
					}else{ 
						
						$('#frmfobrain').submit(function(event) {
								
							event.stopImmediatePropagation(); 
							 
							$('.install-script-btn').fadeOut(100); 
							$('#install-loader').fadeIn(100);  
												
							$.post('install-manger.php', $(this).find('input, select').serialize(), function(data) { 
								
								$("#msg-box").html(data); 
							
							});
							
							return false;
					
						});

					} 
									
				});  
			
			});  

			Swal.fire({
				title: "<i class='fas fa-smile fs-30'></i> foBrain AI <i class='fa fas fa-smile fs-30'></i>",
				html: `
					<i class="far fa-handshake fs-16"></i> 
					You are fabulously welcome to foBrain AI family. </br></br>
					<i class="fas fa-smile fs-16"></i> 
					foBrain welcomes and wishes you an amazing experience. </br></br>
					Our community are ever ready to help out. 
				`,
				imageUrl: "welcome.jpg",
				color: "#fff",
  				background: "#000",
				imageWidth: 450,
				imageHeight: 230,
				imageAlt: "Welcome Message",
				confirmButtonText: `
					<i class="far fa-surprise"></i> Close
				`,
			});

			//document.getElementById('wiz-overlay').style.display = 'block';

		</script> 
		 		
    </body>
</html>