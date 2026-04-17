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
	This script handle 101 page
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
    require_once 'sources/functions/fobrain-dir-in.php';  /* include configuration script */  

?>

<!doctype html>
    <html lang="en"> 
    <head> 
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" /> 
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

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
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo $fobrainTemplateIN; ?>favicon/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo $fobrainTemplateIN; ?>favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo $fobrainTemplateIN; ?>favicon/favicon-16x16.png">
	<link rel="manifest" href="<?php echo $fobrainTemplateIN; ?>favicon/site.webmanifest">
	<link rel="mask-icon" href="<?php echo $fobrainTemplateIN; ?>favicon/safari-pinned-tab.svg" color="#5bbad5">
	<meta name="msapplication-TileColor" content="#bfb3d4">
	<meta name="theme-color" content="#ffffff"> 
    

    <title>Updating | fobrain </title>  

    <!-- stylesheet -->  
    <!-- fobrain style css -->
    <link href="<?php echo $fobrainTemplateIN; ?>css/info.min.css" rel="stylesheet" type="text/css" />  
    <!-- / stylesheet -->
	</head>

	<body class="info-wrapper"> 
		<div class="info-screen">
			<h1>fob</h1>
			<h5>Updating 
			<br/>Please, we are currently updating.</h5>
			<a href="https://www.fobrain.com" class="btn stripes-btn">
				Back to Website
			</a>
		</div> 
		<canvas class="background"></canvas> 
        <!-- javascript --> 
		<script type="text/javascript" src="<?php echo $fobrainTemplateIN; ?>js/particles.min.js"></script>   
		<script type="text/javascript" src="<?php echo $fobrainTemplateIN; ?>/js/app.js"></script> 
		<!-- / javascript  --> 
	</body> 
</html>