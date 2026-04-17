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
	This script show student profile  ID Card
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

      	require 'fobrain-config.php';  /* load fobrain configuration files */	 
		  
		 
		if ($_REQUEST['reg'] != '') { 
				 
		    try {		 				
				
				$reg = strip_tags($_REQUEST['reg']); 
				
				$reg = trim($reg);
				
				/* script validation */ 
				
				if($reg == ""){  /* display error */
					
					$msg_e =  "Ooops, student registration no. is empty";
					
				}else{  /* select profile */	

					$sessionID = studentRegSessionID($conn, $reg);  /* school session ID */
					$session_fi = fobrainSession($conn, $sessionID);  /* school session */
							 
					$session_se = $session_fi + $foreal;  

					$ebele_mark = "SELECT r.ireg_id, nk_regno, s.stu_id, i_stupic, i_firstname, i_lastname, i_midname, 
									i_gender, i_dob, i_country, i_state, i_lga, i_city, i_add_fi, i_add_se, i_stu_phone, 
									i_email, i_sponsor, i_spo_phone, i_spo_add, genotype, bloodgp, hostel, route

									FROM $i_reg_tb r,  $i_student_tb s

									WHERE r.nk_regno = :nk_regno
						 
									AND r.ireg_id = s.ireg_id";
						 
					$igweze_prep = $conn->prepare($ebele_mark);				
					$igweze_prep->bindValue(':nk_regno', $reg);				 
					$igweze_prep->execute();
					
					$rows_count = $igweze_prep->rowCount(); 
					
					if($rows_count == $foreal) {  /* check array is empty */
					
						while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {  /* loop array */		
		   
							$regNum = $row['nk_regno'];
							$ID = $row['ireg_id']; 
							$pic = $row['i_stupic'];
							$fname = $row['i_firstname'];
							$lname = $row['i_lastname'];
							$mname = $row['i_midname'];
							$gender = $row['i_gender'];
							$dob = $row['i_dob'];
							$country = $row['i_country'];
							$state = $row['i_state'];
							$lga = $row['i_lga'];
							$city = $row['i_city'];
							$add1 = $row['i_add_fi'];
							$add2 = $row['i_add_se'];
							$phone = $row['i_stu_phone'];
							$email = $row['i_email'];
							$spon = $row['i_sponsor'];
							$sphone = $row['i_spo_phone'];
							$adds = $row['i_spo_add'];
							$bloodGP = $row['bloodgp'];
							$genoTP = $row['genotype']; 
							$hID = $row['hostel'];
							$rID = $row['route'];
						}	  

						$genderM = wizSelectArray($gender, $gender_list);
						$bloodGroup = wizSelectArray($bloodGP, $bloodgr_list);
						$genoType = wizSelectArray($genoTP, $genotype_list);  
						
						$genderM = substr($genderM, 0, 1);	

						$student_img = picture($school_pic_dir.$session_fi.'_'.$session_se.'/', $pic, "student");   
						/*
						$principalData = staffData($conn, $schoolHead);  /* school staffs/teachers information * /
						list ($title, $princ_fullname, $princ_sex, $princ_rankingVal, $princ_picture, 
							  $princ_lname, $princ_phone, $princ_sign) = explode ("#@s@#", $principalData);
							  
						$staff_sign = picture($staff_pic_ext, $princ_sign, "sign");

						$principalSign = '<img src="'.$staff_sign.'" height="30px" width="100px" class="img-rounded"
						style="float:left;">';	  

						 
						$titleVal = wizSelectArray($title, $title_list);
						$schoolPrincipal = $titleVal.' '.$princ_fullname; 
						$schoolPrincipal = substr($schoolPrincipal, 0, 24);	

						*/
						
						if($mname != ""){
							$mname = substr($mname, 0, 1). ".";
						}
						$student_name = $lname.' '.$fname.' '.$mname;
						$student_name = substr($student_name, 0, 50);	
						
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

						$data   = 'fobrain:'.$reg;

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
                <div class="id-card" id="fobrain-print">
					<h2 class="head">
						<img src="$sch_logo" class="img-h-40 img-circle img-thumbnail pull-left pe-5" alt="school logo">
						$schoolNameTop
					</h2>
					<h6 class="head-sub">$schoolAddressTop</h6>
                    <div class="card-icon">
                        <img src="$student_img" class ="img-h-100 img-circle img-thumbnail" alt="student image"> 
                    </div>

					<div class="card-icon">

IGWEZE;

					echo $card_top;

					printf('<img src="%s" alt="Student QR Code" class ="img-h-100" />', $options->cachefile);

$card_bottom =<<<IGWEZE
                    
                    </div>

                    <div class="card-details">
                        <h2 class="title">$student_name</h2>
                        <span class="post">$regNum</span>
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
						
						echo "<script type='text/javascript'> hidePageLoader();	</script>";	
						

					}else{  /* display error */
					
						$msg_e =  "Student record with <strong>$reg</strong> was not found.";
					} 
				
				}
					
			}catch(PDOException $e) {
				
				fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
				 
			} 
			
		
		}else{ 
		
				echo $userNavPageError; exit;  /* else exit or redirect to 404 page */ 
		
		} 
	
		if ($msg_e) {

         	echo $errorMsg.$msg_e.$eEnd; echo $loadingStop; echo "<script type='text/javascript'> hidePageLoader();	</script>";	 echo $scroll_up; exit; 			

        }
		
exit;
?>	