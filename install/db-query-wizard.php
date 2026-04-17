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

	define('fobrain', 'igweze');  /* define a check for wrong access of file */	  
	$fobrainDir = '../';		 		
	require_once '../fobrain-box.php'; 
	require ($fobrainDBConnectDir);   /* load connection string */
	//require_once $fobrainFunctionDir;  /* load script functions */

	function fobrainDie($msg) {  /* fobrain Customize PHP Die() function */

		global $erroMsg, $msgEnd;

		$err = <<<END

		$erroMsg $msg $msgEnd

		END;

		echo $err; exit;

	}


?>

	<!DOCTYPE html>
	<html lang="en">
	<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />  
	<title> fobrain School App Installation Guide Wizard</title>  
	<!-- vendor css -->
	<link rel="stylesheet" href="<?php echo $fobrainTemplate; ?>css/vendor.css" type="text/css" /> 
		 
	<!-- fobrain style css -->
	<link href="<?php echo $fobrainTemplate; ?>css/fobrain-style.css" rel="stylesheet" type="text/css" /> 

<?php  	 
	$maxRuntime = 8; /* less then your max script execution limit */

	$deadline = time()+$maxRuntime; 
	$progressFilename = $fobrainSQLData.'_filepointer'; /* tmp file for progress */
	$errorFilename = $fobrainSQLData.'_error'; /* tmp file for erro */ 
	
	echo ' <meta http-equiv="refresh" content="'.($maxRuntime+2).'"> ';  /* activate automatic reload in browser */
		
?> 
	</head>
	<body style="background-color:#fff !important">	
	<div class="rows col-lg-12" style="margin-top:0px; background-color:#fff !important"> 
<?php
			
		 
		($fp = fopen($fobrainSQLData, 'r')) OR die('failed to open file:'.$fobrainSQLData);

		if( file_exists($errorFilename) ){ /* check for previous error */
		
			die(' previous error: '.file_get_contents($errorFilename));
			
		} 
		
		/* go to previous file position */
		$filePosition = 0;
		if( file_exists($progressFilename) ){
			$filePosition = file_get_contents($progressFilename);
			fseek($fp, $filePosition);
		}

		$queryCount = 0;
		$query = '';
		while( $deadline>time() AND ($line=fgets($fp, 1024000)) ){
			
			if(substr($line,0,2)=='--' OR trim($line)=='' ){
				continue;
			}

			$query .= $line;
			
			if( substr(trim($query),-1)==';' ){
				
				try {
					
					$igweze_prep = $conn->prepare($query);
							
					if(!($igweze_prep->execute())){	
						
						$msg_e = 'Ooops, an error has occur while performing database query. Please try again  or manually empty all database table.';
						echo $erroMsg.$msg_e.$msgEnd; exit; 
						
					}
				
				} catch(PDOException $e) {
						 
					fobrainDie( 'Ooops Database Connection failed: ' . $e->getMessage());
					   
				}
				
				$query = '';
				file_put_contents($progressFilename, ftell($fp)); /* save the current file position for */
				$queryCount++;
				
			}
		}
		
		$dbPercent = (round(ftell($fp)/filesize($fobrainSQLData), 2)*100);
		$remPercent = (100 - $dbPercent);	
		
		$progressPercent = $dbPercent.'%'; 

		
$queryPercent =<<<IGWEZE
        
		<div class="progress my-10">
			<div class="progress-bar progress-bar-striped progress-bar-animated active" 
			role="progressbar" aria-valuenow="$progressPercent" aria-valuemin="0" aria-valuemax="100" 
			style="width: $progressPercent;background-color:#228B22!important">$progressPercent</div>
		</div> 
		<script type='text/javascript'> 
				window.parent.$('.lastProgressBar').css('width', '$progressPercent');
				window.parent.$('#progress-value').text('$progressPercent');
		</script> 
		
IGWEZE;

		echo $queryPercent; 

		$remaingPer = "<b>$remPercent"."%"." Remaining.</b>";
		
		if( feof($fp) ){  
   
			
			$installFile = fopen("../install/index.php","w");		 
	
			
$newInfo = "<?php \n\n 
 

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
	This script handle script installation
	------------------------------------------------------------------------*/

		define('fobrain', 'igweze');  /* define a check for wrong access of file */	  		
	  	"."$"."fobrainDir = '../';		 		
		require_once '../fobrain-box.php';  
		
		if  (file_exists("."$"."fobrainInstallDir.'db-query-wizard.php')) {
			
			unlink("."$"."fobrainInstallDir.'db-query-wizard.php');  
			
		}	
		
		if  (file_exists("."$"."fobrainInstallDir.'install-manger.php')) {
			
			unlink("."$"."fobrainInstallDir.'install-manger.php'); 
			
		}

		if  (file_exists("."$"."fobrainInstallDir.'install-card.php')) {
			
			unlink("."$"."fobrainInstallDir.'install-card.php'); 
			
		}
		
		if  (file_exists("."$"."fobrainInstallDir.'fobrain.sql')) {
			
			unlink("."$"."fobrainInstallDir.'fobrain.sql');  
			
		}
		
		if  (file_exists("."$"."fobrainInstallDir.'fobrain.sql_filepointer')) {
			
			unlink("."$"."fobrainInstallDir.'fobrain.sql_filepointer');  
			
		} 
		\n\n
?>

	<!doctype html>
    <html lang='en'> 
    <head> 
    <meta http-equiv='content-type' content='text/html;charset=UTF-8' />
    <meta charset='utf-8' /> 
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>

    <meta name='robots' content='ALL'>
    <meta name='rating' content='GENERAL'>
    <meta name='distribution' content='GLOBAL'>
    <meta name='classification' content='school portal, school management system, software'>
    <meta name='copyright' content='fobrain https://www.fobrain.com'>
    <meta name='author' content='IGWEZE EBELE MARK'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge' /> 
    <meta name='keywords' content='fobrain'  /> 
    <meta name='description' content=''/>  
    <!-- favicon -->	
	<link rel='apple-touch-icon' sizes='180x180' href='../favicon/apple-touch-icon.png'>
	<link rel='icon' type='image/png' sizes='32x32' href='../favicon/favicon-32x32.png'>
	<link rel='icon' type='image/png' sizes='16x16' href='../favicon/favicon-16x16.png'>
	<link rel='manifest' href='../favicon/site.webmanifest'>
	<link rel='mask-icon' href='../favicon/safari-pinned-tab.svg' color='#5bbad5'>
	<meta name='msapplication-TileColor' content='#bfb3d4'>
	<meta name='theme-color' content='#ffffff'> 
    <title>Installation Successfully | fobrain </title>  
    <!-- stylesheet -->  
    <!-- fobrain style css -->
    <link href='<?php echo "."$"."fobrainTemplate; ?>css/info.min.css' rel='stylesheet' type='text/css' />  
    <!-- / stylesheet -->
	</head>

	<body class='info-wrapper'> 
		<div class='info-screen'>
			<h2>WOW</h2>
			<h5>Installation Successfully</h5>
			<a href='<?php echo "."$"."fobrainPortalRoot; ?>' class='btn stripes-btn'>
				Login
			</a>
		</div> 
		<canvas class='background'></canvas> 
        <!-- javascript --> 
		<script type='text/javascript' src='<?php echo "."$"."fobrainTemplate; ?>js/particles.min.js'></script>   
		<script type='text/javascript' src='<?php echo "."$"."fobrainTemplate; ?>/js/app.js'></script> 
		<!-- / javascript  --> 
	</body> 
	</html>";


			if (fwrite($installFile, $newInfo) > 0 ){
				
				fclose($installFile);	

				$msg_s = "				
					<div class='fs-12 p-10' style='background: #39DA8A !important; color: #000 !important; text-align:justify'>
						<i class='fas fa-check fa-3x pull-left pe-15'></i>
						<b>FoBrain AI</b> installation is almost completed!. <br/> 
						<a href='$fobrainInstallDir'  target='_top'><b>
						Please click here to delete installation files to complete installation</b></a>.
					</div>";
				echo $msg_s;
				echo "<script type='text/javascript'>   
					$('#install-loader-fr').fadeOut(2500); 
				</script>";
				
			}else{

				$msg_i = "
					<div class='fs-12 p-10' style='background: #39DA8A !important; color: #000 !important; text-align:justify'>
						<i class='fas fa-check fa-3x pull-left pe-15'></i>
						<b>FoBrain AI</b> installation is almost completed!. <br/>However, some files were unable to delete due
						to your files system permission. Please manually delete the install folder to complete installation. 
						<a href='$fobrainPortalRoot'><b>Please click here to login</b></a>
					</div>";
				echo $msg_i;
				echo "<script type='text/javascript'>   
					$('#install-loader-fr').fadeOut(2500);
				</script>";
			
			}			
			 
			
		}else{	   
			
			$msg_i = "
				<div class='fs-12 p-10' style='background: #00CFDD !important; color: #000 !important; text-align:justify'> 
					<i class='fas fa-info fa-3x pull-left pe-15'></i>
					<b>FoBrain AI</b> installation is currently running.  
					Please, don't disconnect your internet or shut down your system.  
					This might take <b>1 to 4 minutes</b> depending on your system and server configurations.
					<br />Please wait . . . . $remaingPer
				</div>";
			echo $msg_i;
			
		}
?>
			</div>	 
		</body>
	</html>