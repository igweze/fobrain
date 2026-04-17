<?php 

	if(!isset($_SESSION['lang-trans'])){

		$translator = $schoolDataArray[0]['translator'];
		if($translator == ""){
			$translator = "en/en";
		} 
		
		list ($lang_1, $lang_2) =  explode ("/", $translator);	
		

	}else{

		$lang_2 = $_SESSION['lang-trans']; 
		$translator = "en/".$lang_2;

	}

	$lang_upp = strtoupper($lang_2);

	$translator = trim($translator);

?>
<!doctype html>
<html lang="en">

<head>	

	<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title><?php echo $schoolNameTop; ?> | FoBrain </title>  
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
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
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo $fobrainTemplate; ?>favicon/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo $fobrainTemplate; ?>favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo $fobrainTemplate; ?>favicon/favicon-16x16.png">
	<link rel="manifest" href="<?php echo $fobrainTemplate; ?>favicon/site.webmanifest">
	<link rel="mask-icon" href="<?php echo $fobrainTemplate; ?>favicon/safari-pinned-tab.svg" color="#5bbad5">
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
	<link href="<?php echo $fobrainTemplate; ?>css/vendor.css" rel="stylesheet" type="text/css" />   
	<?php if($can_use_search == true){  ?>  
	<!-- jodit css -->
	<link href="<?php echo $fobrainTemplate; ?>css/jodit.min.css" rel="stylesheet" type="text/css" /> 
	<?php }  ?>	
	<!-- fobrain style css -->
	<link href="<?php echo $fobrainTemplate; ?>css/fobrain-style.css" rel="stylesheet" type="text/css" /> 
	<!-- / stylesheet -->

	<noscript> <meta http-equiv="refresh" content="0; URL=no-scripts"> </noscript>  
	 
</head> 