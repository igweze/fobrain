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
	This script handle product payment error
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

     define('fobrain', 'igweze');  /* define a check for wrong access of file */

        require 'fobrain-config.php';  /* load fobrain configuration files */

			$paymentInfo = clean($_REQUEST['c']);				
				
			$paymentInfo = strip_tags($paymentInfo);	
			
			if($paymentInfo != $_SESSION['transRefNo']){   /* check if payment ref no is correct  */
			
				echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
			
			}

?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="icon" type="image/x-icon" href="<?php echo $fobrainTemplate; ?>images/favicon.png" /> <!-- favicon -->

	<title>Ooops Error</title> 

	<!-- stylesheet -->
	
    <link href="<?php echo $fobrainTemplate; ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $fobrainTemplate; ?>css/bootstrap-reset-27408B.css" rel="stylesheet">   
    <link href="<?php echo $fobrainTemplate; ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet" />     
	<link href="<?php echo $fobrainTemplate; ?>css/pnotify.custom.css" rel="stylesheet">
    <link href="<?php echo $fobrainTemplate; ?>css/style-27408B.css" rel="stylesheet">
    <link href="<?php echo $fobrainTemplate; ?>css/style-responsive.css" rel="stylesheet" /> 
	
	<!-- / stylesheet -->
	
	<!-- jquery and javascripts -->
	
	<script> var locateFefe = '<?php echo $fobrainLogOutDir;?>'; </script>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
    <script src="./fobrainTemplates/js/html5shiv.js"></script>
    <script src="./fobrainTemplates/js/respond.min.js"></script>
    <![endif]-->
	
	<!-- / jquery and javascripts -->
	
	</head> 

	<!-- body -->
	
	<body class="body-404">

		<div class="container">

			<section class="error-wrapper text-center">				
				
				<i class="icon-404 img-circle"></i> 
				
				<h1>Ooops Error</h1>
				<h2>Your payment was not successfully processed. Please try again.</h2>
          
			</section>

		</div> 

	</body> 
	
	<!-- / body -->

	</html>