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
	This script handle school expenses  upload
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

	define('fobrain', 'igweze');  /* define a check for wrong access of file */

	require 'fobrain-config.php';  /* load fobrain configuration files */
 
	if ($_REQUEST['query'] == 'upload') {  /* save expenses category */

		$pid = $_REQUEST['pid'];
		$status = $_REQUEST['status'];

		$picturePath = $expense_doc_ext; /* picture path */ 
		$filePic = "attach"; /* picture file name */
		$pageDesc = "your Attachment";
		
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

						$uploadDocID = str_replace(".","foreal",$uploadedPic); 
						 
						$counter = insertExpenseDocs($conn, $uploadedPic, $pid, $status);
						
						$delPic = $fobrainTemplate.'images/icon_del.gif'; 
						
						echo'<div style="" class = "doc-upload-img 
						col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6" 
						id = "doc-upload-img_'.$uploadDocID.'">';
						echo '<span class = "rem-expense-doc" style="position: relative;
						top: -10px;left:-5px; float:right; cursor:pointer;" 
						id= "doc-'.$uploadedPic.'"><img src="'.$delPic.'" height="12">
						</span>';
						echo '<img src='.$picturePath.$uploadedPic.' class = "preview" />';
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

	}elseif ($_REQUEST['query'] == 'remove') {  /* remove school expenses */ 
	 
		$doc_data = $_REQUEST['doc'];
		$pid = $_REQUEST['pid'];
		
		list($fobrainIg, $doc) = explode("-", $doc_data);			
		
		/* script validation */ 
		
		if (($doc_data == "")  || ($pid == "")){
			
			$msg_e = "* Ooops, an error has occur while to remove attachment. Please try again";
			echo $errorMsg.$msg_e.$eEnd; 
			echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
			
		}else {  /* remove information */   

			try { 
				
				$ebele_mark = "DELETE FROM 
				
								$expenseDocTB										
									
								WHERE doc = :doc
									
								LIMIT 1";
				
				$igweze_prep = $conn->prepare($ebele_mark);
				$igweze_prep->bindValue(':doc', $doc);  

				if($igweze_prep->execute()){  /* if sucessfully */

					$uploadDocID = str_replace(".","foreal",$doc); 
					removePicture($expense_doc_ext, $doc); 
					$removeDiv = "$('#doc-upload-img_".$uploadDocID."').fadeOut(1000);";
					$msg_s = "<strong>Attachment</strong> was successfully removed"; 
					echo $succesMsg.$msg_s.$sEnd; 
					echo "<script type='text/javascript'>   
							$removeDiv
							hidePageLoader();
						</script>";exit;
					
				}else{  /* display error */
		
					$msg_e =  "Ooops, an error has occur while to remove attachment. Please try again";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
					
				}
				

			}catch(PDOException $e) {
	
				fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
		
			}          		
	
		}
	
	}elseif ($_REQUEST['query'] == 'count') {  /* remove school expenses */  

		$pid = $_REQUEST['pid'];
		
		/* script validation */ 
		
		if (($pid == "")){
			
			$msg_e = "* Ooops, an error has occur while to fetch attachment. Please try again";
			echo $errorMsg.$msg_e.$eEnd; 
			echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
			
		}else {  /* remove information */   

			try { 
				
				$counter = countExpenseDocs($conn, $pid);
				
				if ($counter >= 20){  
 
					$script = "$('.upload-expense-div').hide()";  
				
				}else{
					
					$script = "$('.upload-expense-div').show()";

				}

				echo "<script type='text/javascript'>   
						$script
						$('.attach-counter').text($counter);
					</script>";

			}catch(PDOException $e) {
	
				fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
		
			}          		
	
		}
	
	}else{ exit; }exit;

?>