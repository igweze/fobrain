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
	This script handle companion picture uploads
	------------------------------------------------------------------------*/ 
 
 	
	require ($fobrainvalidater);

	if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){ 

		$picturePath = $forumPicExtTem; /* picture path */ 
		$filePic = "photoimg"; /* picture file name */
		$pageDesc = "your picture";
		
		/* call igweze file uploader */
		$uploadPicData = igwezeFileUploader($filePic, $picturePath, ($oneMB * 2), $validPicExt, $validPicType, $allowedPicExt, $fileType = "Picture", $fiVal);
			
		if (is_array($uploadPicData['error'])) {  /* check if any upload error */
				
			$msg_e = ''; 
			foreach ($uploadPicData['error'] as $msg) {
				$msg_e .= $msg.'<br />';     /* display error messages */
			}
			
			echo $errorMsg.$msg_e.$eEnd; exit; 
			
		} else {
			
			$uploadedPic = $uploadPicData['refilename']; /* uploaded picture file */
			
			if ($uploadedPic != "") {
					
				if (move_uploaded_file($_FILES[$filePic]['tmp_name'], $picturePath.$uploadedPic )) { /* move uploaded file to its path */
												
					try { 

						$uploadedPicID = str_replace(".","foreal",$uploadedPic);
		
						$memberInfo = companionWallUserDetails($conn, $_SESSION['regNo'], $seVal);  /* retrieve student companion details */
						
						list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic) = explode ("##", $memberInfo);
						
						insertTempUpload($conn, $uploadedPic, $member_id);  /* insert upload */
						
						$delPic = $fobrainTemplate.'images/icon_del.gif'; 
						
						echo'<div style="" class = "picture-upload-div 
						col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6" 
						id = "picture-upload-div_'.$uploadedPicID.'">';
						echo '<span class = "uploadPic_DelBtn" style="position: relative;
						top: 6px;left:-5px; float:right; cursor:pointer;" 
						id= "DelPic-'.$uploadedPicID.'"><img src="'.$delPic.'" height="12">
						</span>';
						echo '<img src='.$forumPicExtTem.$uploadedPic.' Class = "preview" />';
						echo '</div>';	 	 


					}catch(PDOException $e) {
						
						fobrainDie( 'Ooops Database Error: ' . $e->getMessage());

					}
						
						
				}else{ /* display error messages */
					
					$msg_e = "Ooops, an error has occur while trying to save $pageDesc. Please try again or check your network connection!!!";
					echo $errorMsg.$msg_e.$eEnd; exit; 
						
				}
					
			}else{ /* display error messages */
				
				$msg_e = "Ooops, an error has occur while trying to save $pageDesc. Please try again or check your network connection!!!";
				echo $errorMsg.$msg_e.$eEnd; exit;							

			}	
			
			
		} 				

	}else{ exit; }exit;

?>