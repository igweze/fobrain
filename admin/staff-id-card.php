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
	This page load staff profile ID Card
	------------------------------------------------------------------------*/  
declare(strict_types=1);
use chillerlan\QRCode\{QRCode, QROptions};
use chillerlan\QRCode\Data\QRMatrix;
use chillerlan\QRCode\Output\QRGdImagePNG;
use chillerlan\QRCode\Output\QROutputInterface;

require_once '../vendor/autoload.php';

if(!session_id()){
    session_start();
}


		define('fobrain', 'igweze');  /* define a check for wrong access of file */			

		require 'fobrain-config-s.php';  /* load fobrain configuration files */	
			
		require_once $fobrainIconPage; /* This include top middle global icon page eg go back, print buttons etcs */ 
 

		if ($_REQUEST['teacherID'] != '') { 
				 
		    try {		 				
				
				$teacherID = clean($_REQUEST['teacherID']);  

				/* script validation */ 
				
				if($teacherID == ""){  /* display error */
					
					$msg_e =  "Ooops, staff registration no. is empty";
					
				}else{  /* select profile */	 
		 
					/* select staff profile */ 	
					$ebele_mark = "SELECT t_id, i_title, i_picture, i_sign, i_firstname, i_lastname, i_midname, 
									i_gender, i_dob,  genotype, bloodgp, t_grade, i_email

									 FROM $staffTB

									 WHERE t_id = :t_id";
						 
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':t_id', $teacherID);				 
					$igweze_prep->execute();
					
					$rows_count = $igweze_prep->rowCount(); 
					
					if($rows_count == $foreal) {  /* check array is empty */

						while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {  /* loop array */		
		   
							$t_id = $row['t_id'];
							$pic = $row['i_picture'];
							$signPic = $row['i_sign'];
							$title = $row['i_title'];
							$fname = $row['i_firstname'];
							$lname = $row['i_lastname'];
							$mname = $row['i_midname'];
							$gender = $row['i_gender'];
							$dob = $row['i_dob']; 
							$bloodGP = $row['bloodgp'];
							$genoTP = $row['genotype'];
							//$ranking = $row['rank'];
							$staff_grade = $row['t_grade'];
							$staff_mail = $row['i_email'];
						
						} 

						$titleVa = wizSelectArray($title, $title_list); 
						$staff_img = picture($staff_pic_ext, $pic, "staff");

						$genderM = wizSelectArray($gender, $gender_list);
						$bloodGroup = wizSelectArray($bloodGP, $bloodgr_list);
						$genoType = wizSelectArray($genoTP, $genotype_list);  
						$genderM = substr($genderM, 0, 1); 
						 
						/*				
						$principalData = staffData($conn, $schoolHead);  /* school staffs/teachers information * /
						list ($title2, $princ_fullname, $princ_sex, $princ_rankingVal, $princ_picture, 
							  $princ_lname, $princ_phone, $princ_sign) = explode ("#@s@#", $principalData);

						$staff_sign = picture($staff_pic_ext, $princ_sign, "sign");

						$principalSign = '<img src="'.$staff_sign.'" height="30px" width="100px" class="img-rounded"
						style="float:left;">';   
						 
						$titleVal = wizSelectArray($title2, $title_list); 
						$schoolPrincipal = $titleVal.' '.$princ_fullname; 
						$schoolPrincipal = substr($schoolPrincipal, 0, 24);	

						*/

						$userTag = wizSelectArray($staff_grade, $adminRankingArr);
						if($mname != ""){
							$mname = substr($mname, 0, 1). ".";
						}
						$staff_name = $titleVa.' '.$lname.' '.$fname.' '.$mname;
						$staff_name = substr($staff_name, 0, 50);	
						
						$schoolNameTop = substr($schoolNameTop, 0, 25);	
						$schoolAddressTop = substr($schoolAddressTop, 0, 25);
						
						$options = new QROptions;

						$options->version             = 7;
						$options->outputInterface     = QRGdImagePNG::class;
						$options->scale               = 20;
						$options->outputBase64        = false;
						$options->bgColor             = [200, 150, 200];
						$options->imageTransparent    = true;
						#$options->transparencyColor   = [233, 233, 233];
						$options->drawCircularModules = true;
						$options->drawLightModules    = true;
						$options->circleRadius        = 0.4;
						$options->outputType  = QROutputInterface::CUSTOM;
						$options->keepAsSquare        = [
							QRMatrix::M_FINDER_DARK,
							QRMatrix::M_FINDER_DOT,
							QRMatrix::M_ALIGNMENT_DARK,
						];
						$options->moduleValues        = [
							// finder
							QRMatrix::M_FINDER_DARK    => [0, 63, 255], // dark (true)
							QRMatrix::M_FINDER_DOT     => [0, 63, 255], // finder dot, dark (true)
							QRMatrix::M_FINDER         => [233, 233, 233], // light (false), white is the transparency color and is enabled by default
							// alignment
							QRMatrix::M_ALIGNMENT_DARK => [255, 0, 255],
							QRMatrix::M_ALIGNMENT      => [233, 233, 233],
							// timing
							QRMatrix::M_TIMING_DARK    => [255, 0, 0],
							QRMatrix::M_TIMING         => [233, 233, 233],
							// format
							QRMatrix::M_FORMAT_DARK    => [67, 159, 84],
							QRMatrix::M_FORMAT         => [233, 233, 233],
							// version
							QRMatrix::M_VERSION_DARK   => [62, 174, 190],
							QRMatrix::M_VERSION        => [233, 233, 233],
							// data
							QRMatrix::M_DATA_DARK      => [0, 0, 0],
							QRMatrix::M_DATA           => [233, 233, 233],
							// darkmodule
							QRMatrix::M_DARKMODULE     => [0, 0, 0],
							// separator
							QRMatrix::M_SEPARATOR      => [233, 233, 233],
							// quietzone
							QRMatrix::M_QUIETZONE      => [233, 233, 233],
							// logo (requires a call to QRMatrix::setLogoSpace()), see QRImageWithLogo
							QRMatrix::M_LOGO           => [233, 233, 233],
						];

						$options->cachefile = $fobrainQRCodeDir.'fobrain-qr-code.png'; 

						$qrcode  = new QRCode; 
						 
						$data   = 'fobrain:'.$staff_mail;

						$qrcode->setOptions($options);

						$qrcode->render($data); 

				        
$card_top =<<<IGWEZE
		
		<div class="row gutters mb-10">
			<div class="text-end">
				<button  class="btn btn-primary" onclick="printDiv('fobrain-print-ovly')">
					<i class="fas fa-print"></i>  
				</button>
			</div>	
		</div>				
		<div class="row justify-content-center" id = 'fobrain-print-ovly'>
            <div class="col-md-offset-4 col-md-4">
                <div class="id-card">
					<h2 class="head">
						<img src="$sch_logo" class="img-h-40 img-circle img-thumbnail pull-left pe-5" alt="school logo">
						$schoolNameTop
					</h2>
					<h6 class="head-sub">$schoolAddressTop</h6>
                    <div class="card-icon">
                        <img src="$staff_img" class ="img-h-100 img-circle img-thumbnail" alt="student image"> 
                    </div>

					<div class="card-icon">

IGWEZE;

					echo $card_top;

					printf('<img src="%s" alt="Student QR Code" class ="img-h-100" />', $options->cachefile);

$card_bottom =<<<IGWEZE
                    
                    </div>

                    <div class="card-details">
                        <h2 class="title">$staff_name</h2>
                        <span class="post">$userTag</span>
                    </div>
                    <div class="card-content"> 
                        <p>
							<i class="mdi mdi-human-male-female"></i> $genderM 
							<span>|</span> 
							<i class="mdi mdi-calendar-account-outline"></i> $dob
							<span>|</span> 
							<i class="mdi mdi-medical-bag"></i> $bloodGroup
						</p> 
					</div>
                </div>
            </div>
        </div> 					
					 
		
IGWEZE;
						

					echo $card_bottom;

					echo "<script type='text/javascript'>   hidePageLoader(); </script>";
				

				}else{  /* display error */ 
				
					$msg_e =  "Ooops, Staff record with was not found.";
					echo $errorMsg.$msg_e.$eEnd; echo $scroll_up; 
					
				}
			
				}
				
			}catch(PDOException $e) {
  			
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			 
			}

		}else{ 
		
				echo $userNavPageError; exit;  /* else exit or redirect to 404 page */ 
		
		} 			
		
		if ($msg_e) {

			echo $errorMsg.$msg_e.$eEnd; echo $scroll_up; 
			echo "<script type='text/javascript'>   hidePageLoader(); </script>"; exit;  

		}
			
exit;			
?>	