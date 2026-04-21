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
		require_once $fobrainFunctionDir;  /* load script functions */ 
        
        if (($_REQUEST['script']) == 'install') {  /* save student profile */

            $fname = clean($_REQUEST['fname']);
            $lname = clean($_REQUEST['lname']);
            $email = preg_replace("/[^A-Za-z0-9.@]/", "", $_REQUEST['email']);
            $password = clean($_REQUEST['password']);
            $url = clean($_REQUEST['url']);
            $dname = clean($_REQUEST['dname']);
            $dhost = clean($_REQUEST['dhost']);
            $duser = clean($_REQUEST['duser']);
            $dpassword = clean($_REQUEST['dpassword']); 
            
            // validate password strength
            $uppercase = preg_match('@[A-Z]@', $password);
            $lowercase = preg_match('@[a-z]@', $password);
            $number    = preg_match('@[0-9]@', $password);
            $specialChars = preg_match('@[^\w]@', $password);   

            /* script validation */   
            
			if ($lname == "")  {
            
                $msg_e = "Ooops, please enter first name";
                echo $errorMsg.$msg_e.$eEnd;
                echo "<script type='text/javascript'>   
                    $('#install-loader').fadeOut(3500);  $('.install-script-btn').fadeIn(4000); 	
                </script>"; exit; 
            
            }elseif($fname == "")   {
            
                $msg_e  = "Ooops, please enter last name";
                echo $errorMsg.$msg_e.$eEnd;
                echo "<script type='text/javascript'>   
                    $('#install-loader').fadeOut(3500);  $('.install-script-btn').fadeIn(4000); 	
                </script>"; exit;
            
            }elseif ($email == ''){
            
                $msg_e = "Ooops, please enter a valid email address";
                echo $errorMsg.$msg_e.$eEnd;
                echo "<script type='text/javascript'>   
                    $('#install-loader').fadeOut(3500);  $('.install-script-btn').fadeIn(4000); 	
                </script>"; exit;
            
            }elseif($password == "")   {
            
                $msg_e  = "Ooops, please enter admin password";
                echo $errorMsg.$msg_e.$eEnd;
                echo "<script type='text/javascript'>   
                    $('#install-loader').fadeOut(3500);  $('.install-script-btn').fadeIn(4000); 	
                </script>"; exit;
            
            }elseif(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
             
                $msg_e  = "Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character. eg 1@Fobrain";
                echo $errorMsg.$msg_e.$eEnd;
                echo "<script type='text/javascript'>   
                    $('#install-loader').fadeOut(3500);  $('.install-script-btn').fadeIn(4000); 	
                </script>"; exit;

            }elseif (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$url)){
                
                $msg_e  = "Ooops, please enter a valid full url eg https://www.fobrain.com or http://www.school.fobrain.com";
                echo $errorMsg.$msg_e.$eEnd;
                echo "<script type='text/javascript'>   
                    $('#install-loader').fadeOut(3500);  $('.install-script-btn').fadeIn(4000); 	
                </script>"; exit;
            
            }elseif($dname == "")   {
            
                $msg_e  = "Ooops, please enter database name";
                echo $errorMsg.$msg_e.$eEnd;
                echo "<script type='text/javascript'>   
                    $('#install-loader').fadeOut(3500);  $('.install-script-btn').fadeIn(4000); 	
                </script>"; exit;
            
            }elseif($dhost == "")   {
            
                $msg_e  = "Ooops, please enter database host";
                echo $errorMsg.$msg_e.$eEnd;
                echo "<script type='text/javascript'>   
                    $('#install-loader').fadeOut(3500);  $('.install-script-btn').fadeIn(4000); 	
                </script>"; exit;
            
            }elseif($duser == "")   {
            
                $msg_e  = "Ooops, please enter database user name";
                echo $errorMsg.$msg_e.$eEnd;
                echo "<script type='text/javascript'>   
                    $('#install-loader').fadeOut(3500);  $('.install-script-btn').fadeIn(4000); 	
                </script>"; exit;
            
            }elseif($dpassword == "")   {
            
                $msg_e  = "Ooops, please enter database password";
                echo $errorMsg.$msg_e.$eEnd;
                echo "<script type='text/javascript'>   
                    $('#install-loader').fadeOut(3500);  $('.install-script-btn').fadeIn(4000); 	
                </script>"; exit;
            
            }else {  /* update information */    

                $install = 1; 
                $lincense = 0011223344;
                //$dpassword = ""; 
                $fob_key = $encrypt_key.$url;
                $lincenseFob = encrypter($lincense, $fob_key);

                if($install == 1){  /* if installation is auto */ 
					
                    $url = rtrim($url, '/') . '/'; 
                    
                    $iframeSrc = $url.'install/db-query-wizard.php';
                    
                    echo "<script type='text/javascript'>   
                    
                        $('body').on('click','#installDB',function(){  /* install fobrain Database */
                                    
                            event.stopImmediatePropagation();
                            
                            $('#ifeOsiframe').attr('src', '$iframeSrc');
                            
                            return false; 		
                                        
                        });  
                    
                    </script>"; 
                    
                } 

                try {
 
                    $dbFile = fopen("../connect-configs.php","w");
                    $fobrainFile = fopen("../fobrain-loader.php","w");

$dbInfo = "<?php \n\n
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
    This script handle database connection parameters
    ------------------------------------------------------------------------*/

    \n
    "."$"."server = '$dhost'; "."$"."username = '$duser'; "."$"."password = '$dpassword';  /* database connection parameters */ \n

?>";


$fobrainInfo = "<?php \n\n
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
    This script load school configuration parameter
    ------------------------------------------------------------------------*/

    \n
    "."$"."fobrainPortalRoot = '$url'; "."$"."fobrainDB = '$dname'; "."$"."fobrainLincense = '$lincenseFob';  \n

?>";
                    $fobrainDB = $dname; 
                    
                    
                    if ((fwrite($dbFile, $dbInfo) > 0 ) && (fwrite($fobrainFile, $fobrainInfo) > 0 )){
                        
                        fclose($dbFile); fclose($fobrainFile); 
                            
                        /* PDO connection start */
                        try {
                            
                            $conn = new PDO("mysql:host=$dhost; dbname=$dname", $duser, $dpassword);
                            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $conn->exec("SET CHARACTER SET utf8"); 
                            
                        } catch(PDOException $e) {
                            echo "<script type='text/javascript'> 
                                $('#install-loader').fadeOut(3500);  $('.install-script-btn').fadeIn(4000);  
                            </script>";
                            fobrainDie( 'Ooops Database Connection failed: ' . $e->getMessage());                    
                        }      

                        /* PDO connection end */   
                        
                        $salted = randomString($charset, 16); 
                        $newPass = password_hash($password, PASSWORD_BCRYPT, $options_bcrypt);   
                        
                        $ebele_mark_create = "

                            CREATE TABLE IF NOT EXISTS $staffTB  (
                                `t_id` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                                `staff_id` varchar(15) DEFAULT NULL,
                                `i_picture` varchar(60) DEFAULT NULL,
                                `i_sign` varchar(50) DEFAULT NULL,
                                `i_accesspass` varchar(255) DEFAULT NULL,
                                `i_salted` char(30) DEFAULT NULL,
                                `i_pass` varchar(30) DEFAULT NULL,
                                `i_title` enum('1','2','3','4','5','6','7','8') DEFAULT NULL,
                                `i_firstname` varchar(40) DEFAULT NULL,
                                `i_midname` varchar(30) DEFAULT NULL,
                                `i_lastname` varchar(40) DEFAULT NULL,
                                `i_gender` enum('1','2') DEFAULT NULL,
                                `i_dob` date DEFAULT NULL,
                                `i_mar_status` enum('1','2','3','4','5') DEFAULT NULL,
                                `i_country` varchar(40) DEFAULT NULL,
                                `i_state` varchar(30) DEFAULT NULL,
                                `i_lga` varchar(40) DEFAULT NULL,
                                `i_city` varchar(30) DEFAULT NULL,
                                `i_add_fi` varchar(60) DEFAULT NULL,
                                `i_add_se` varchar(60) DEFAULT NULL,
                                `i_phone` varchar(20) DEFAULT NULL,
                                `i_email` varchar(40) DEFAULT NULL,
                                `i_sponsor` varchar(60) DEFAULT NULL,
                                `i_spo_phone` varchar(20) DEFAULT NULL,
                                `i_spo_add` varchar(60) DEFAULT NULL,
                                `i_sponsor_ac` char(30) DEFAULT NULL,
                                `sponocc` varchar(50) DEFAULT NULL,
                                `relatn` varchar(50) DEFAULT NULL,
                                `sponsor2` varchar(50) DEFAULT NULL,
                                `sponphone2` varchar(20) DEFAULT NULL,
                                `sponocc2` varchar(50) DEFAULT NULL,
                                `sponadd2` text DEFAULT NULL,
                                `relatn2` varchar(50) DEFAULT NULL,
                                `bloodgp` enum('1','2','3','4','5','6','7','8') DEFAULT NULL,
                                `genotype` enum('1','2','3') DEFAULT NULL,
                                `school` enum('0','1','2','3','4') DEFAULT '0',
                                `d_appoint` date DEFAULT NULL,
                                `qualif` text DEFAULT NULL,
                                `w_exper` text DEFAULT NULL,
                                `e_note` text DEFAULT NULL,
                                `salary` varchar(20) DEFAULT NULL,
                                `taxid` varchar(100) DEFAULT NULL,
                                `bank` varchar(100) DEFAULT NULL,
                                `swift` varchar(100) DEFAULT NULL,
                                `accname` varchar(100) DEFAULT NULL,
                                `accnum` varchar(30) DEFAULT NULL,
                                `natid` varchar(50) DEFAULT NULL,
                                `appl` varchar(50) DEFAULT NULL,
                                `doc_1` varchar(50) DEFAULT NULL,
                                `doc_2` varchar(50) DEFAULT NULL,
                                `doc_3` varchar(50) DEFAULT NULL,
                                `app_type` enum('0','1','2','3','4') DEFAULT '0',
                                `l_login` datetime DEFAULT NULL,
                                `rank` tinyint(3) DEFAULT NULL,
                                `level` enum('N','J','S') NOT NULL DEFAULT 'N',
                                `t_grade` enum('0','1','2','3','4','5','6') DEFAULT '0',
                                `recov_info` varchar(100) NULL,
                                `recov_time` int(15) NULL,
                                `status` enum('0','1','2','3') NOT NULL DEFAULT '1'
                                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
                        
                        $igweze_prep_create = $conn->prepare($ebele_mark_create); 

                        if ($igweze_prep_create->execute()) {  

                            $ebele_mark_insert = "INSERT INTO $staffTB  
                            
                            (i_firstname, i_lastname, i_email, i_accesspass, i_salted, t_grade)

                            VALUES (:i_firstname, :i_lastname, :i_email, :i_accesspass, :i_salted, :t_grade)"; 
                                            
                            $igweze_prep_insert = $conn->prepare($ebele_mark_insert);	 
                            $igweze_prep_insert->bindValue(':i_firstname', $fname); 								
                            $igweze_prep_insert->bindValue(':i_lastname', $lname); 
                            $igweze_prep_insert->bindValue(':i_email', $email);
                            $igweze_prep_insert->bindValue(':i_accesspass', $newPass);
                            $igweze_prep_insert->bindValue(':i_salted', $salted);
                            $igweze_prep_insert->bindValue(':t_grade', $fiVal); 

                            if ($igweze_prep_insert->execute()) { 
                                
                                if(file_exists($fobrainSQLPointer)){
                                    unlink($fobrainSQLPointer);
                                } 
                                
                                echo "<script type='text/javascript'>
                                    $('#installDB').trigger('click');
                                    $('#install-loader, .install-script-btn').fadeOut(100); 
                                    document.getElementById('wiz-overlay').style.display = 'block';
                                </script>"; 
                    
                            }else {

                                $msg_e = "Ooops, an error has occur while trying to insert admin information. Please try again";
                                echo $errorMsg.$msg_e.$eEnd;
                                echo "<script type='text/javascript'>   
                                    $('#install-loader').fadeOut(3500);  $('.install-script-btn').fadeIn(4000); 	
                                </script>"; exit;

                            } 
                            
                        }else{

                            $msg_e = "Ooops, an error has occur while trying to create admin table. Please try again";
                            echo $errorMsg.$msg_e.$eEnd;
                            echo "<script type='text/javascript'>   
                                $('#install-loader').fadeOut(3500);  $('.install-script-btn').fadeIn(4000); 	
                            </script>"; exit;
                                
                        }	 
                                
                    }else{
                                                
                        $msg_e  = "../connect-configs.php and ../fobrain-loader.php needs to be writable for this script to be installed!";
                        echo $errorMsg.$msg_e.$eEnd;
                        echo "<script type='text/javascript'>   
                            $('#install-loader').fadeOut(3500);  $('.install-script-btn').fadeIn(4000); 	
                        </script>"; exit;
                        
                    }	 
                    
                    if($install == 2){  /* if installation is manual */  
        
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

            <p class='justify mt-20'>
                For step-by-step detailed instructions on setting up your School Portal  
                and accessing its documentation, visit  <a href='https://www.docs.fobrain.com' 
                target='_blank'> https://www.docs.fobrain.com</a>.
            </p> 
		</div> 
		<canvas class='background'></canvas> 
        <!-- javascript --> 
		<script type='text/javascript' src='<?php echo "."$"."fobrainTemplate; ?>'js/particles.min.js'></script>   
		<script type='text/javascript' src='<?php echo "."$"."fobrainTemplate; ?>/js/app.js'></script> 
		<!-- / javascript  --> 
	</body> 
	</html>";


                        if (fwrite($installFile, $newInfo) > 0 ){

                            fclose($installFile);	
                            $progressPercent = "98%";	
                            echo "<script type='text/javascript'> 
                                    $('.lastProgressBar').css('width', '$progressPercent');
                                    $('#progress-value').text('$progressPercent');
                                    $('#install-loader-fr').fadeOut(100); 
                            </script>"; 
        
                            $msg_s = "<i class='fa fa-check fa-3x pull-left'></i> <span class='sr-only'>Loading...</span>
                            <b>FoBrain AI</b> installation is almost completed!. <br/> 
                            <a href='$fobrainInstallDir'><b> Please click here to delete installation files  so 
                            as to complete installation</b></a>.";
                            echo $succMsg.$msg_s.$msgEnd; exit;
                            
                        }else{

                            $msg_i = "<i class='fa fa-check fa-3x pull-left'></i> <span class='sr-only'>Loading...</span>
                            <b>FoBrain AI</b> installation is almost completed!. <br/>However, some files were unable to delete due
                            to your files system permission. Please manually delete the install folder to complete installation. 
                            <a href='$fobrainPortalRoot'><b>Please click here to login</b></a>";
                            echo $infMsg.$msg_i.$msgEnd; exit;
                        
                        }	 
     
                    
                    }
            
                }catch(PDOException $e) {
                    echo "<script type='text/javascript'> 
                                $('#install-loader').fadeOut(3500);  $('.install-script-btn').fadeIn(4000);  
                            </script>";
                    fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
             
                }

            } 
               
        }else{
        
            echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
        
        }


        
        if ($msg_s) {

            echo $succMsg.$msg_s.$msgEnd;
            echo "<script type='text/javascript'>  $('#loader-background').fadeOut(3000);</script>"; exit;
                                    
        }	


        if ($msg_e) {

            echo $erroMsg.$msg_e.$msgEnd;
            echo "<script type='text/javascript'>  $('#loader-background').fadeOut(3000);
            $('.install-loader').fadeOut(100); 
            $('#installfobrain').fadeIn(100); 	
            </script>"; exit; 
            
                                    
        }	
        
exit;
?>