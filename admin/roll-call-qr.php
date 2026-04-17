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
	This script load and save student rollcall
	------------------------------------------------------------------------*/
use chillerlan\QRCode\{QRCode, QROptions};
require_once '../vendor/autoload.php';  

if(!session_id()){
    session_start();
}
 
		define('fobrain', 'igweze');  /* define a check for wrong access of file */
		require 'fobrain-config.php';  /* load fobrain configuration files */ 
	 
		if (($_REQUEST['roll']) == 'qr-rcall') {  /* take qr attendance */	   
 
			$img = $_REQUEST['cam_image'];

			$qr_upload_path = $fobrainQRCodeDir; 

			$image_parts = explode(";base64,", $img);

			$image_type_aux = explode("image/", $image_parts[0]);

			$image_type = $image_type_aux[1]; 

			$image_base64 = base64_decode($image_parts[1]);

			$qrimg_name = uniqid() . '.png';  

			$qrimg_name_path = $qr_upload_path . $qrimg_name;

			file_put_contents($qrimg_name_path, $image_base64);  
 
			//$stu_reg = "2023001/SEC"; 

			try {

				$result = (new QRCode())->readFromFile($qrimg_name_path);
				$content = (string)$result; // Get the decoded data as a string
				//echo "Decoded data: " . $content;

				list ($fobrain, $stu_reg) = explode (":", $content);

				$studnet_id = studentRegID($conn, $stu_reg);

				if($studnet_id == ""){
					$msg_e =  "Ooops, could not retreive this student information";
					echo $errorMsg.$msg_e.$eEnd; exit;
				}else{ 
					echo "<script type='text/javascript'> 
						$('#rollCall-$studnet_id').val(1);
					</script>";
					$student_name = studentName($conn, $stu_reg);
					$msg_s = "$student_name ($stu_reg) attendance was successfully taken.";
					echo $succesMsg.$msg_s.$sEnd;  exit;
				}

				
			} catch (Throwable $exception) {
				// Handle exception (e.g., file not found, invalid QR code)
				echo $errorMsg."Error reading QR code: " . $exception->getMessage().$eEnd;
			}


        }else{ 		
				
			echo $userNavPageError; exit;  /* else exit or redirect to 404 page */		
	
		}  
exit;
?>