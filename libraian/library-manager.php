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
	This script handle library book upload
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

		define('fobrain', 'igweze');  /* define a check for wrong access of file */

		require 'fobrain-config.php';  /* load fobrain configuration files */	   

		
		if (($_REQUEST['library-data']) == 'upload-lib-book') {  /* upload library book */
		
			/* script validation */ 		
			
			$schoolID = cleanInt($_REQUEST['schoolType']);
			$bookName = clean($_REQUEST['book-name']);
			$bookAuthor = clean($_REQUEST['book-author']);
			$bookDesc = $_REQUEST['book-desc'];
			$bookType = clean($_REQUEST['book-type']);
			$bookStatus = clean($_REQUEST['book-status']);
			$bookCopies = cleanInt($_REQUEST['book-copies']);
			$bookLocation = clean($_REQUEST['book-location']);
			$bookAllf = clean($_REQUEST['allow-format']);
			
			if($schoolID == ''){

				$msg_e = "Ooops error, please select school  to upload books";
				echo $errorMsg.$msg_e.$eEnd;
				echo "<script type='text/javascript'> hidePageLoader(); </script>"; exit;
			
			}elseif($bookName == ''){

				$msg_e = "Ooops error, please enter book name to upload";
				echo $errorMsg.$msg_e.$eEnd;
				echo "<script type='text/javascript'> hidePageLoader(); </script>"; exit; 
			
			}elseif($bookAuthor == ''){

				$msg_e = "Ooops error, please enter book author";
				echo $errorMsg.$msg_e.$eEnd;
				echo "<script type='text/javascript'> hidePageLoader(); </script>"; exit; 
			
			}elseif($bookType == ''){

				$msg_e = "Ooops error, please select book type you are uploading";
				echo $errorMsg.$msg_e.$eEnd;
				echo "<script type='text/javascript'> hidePageLoader(); </script>"; exit; 
			
			}else{  /* upload information */ 
			
				$picturePath = $fobrainLibDir; /* picture path */
				
				$filePic = "book-lib-upload"; /* picture file name */
				$pageDesc = "Library Book";
				
				if($bookAllf  == $fiVal){
						
					$allow_formats = $validDocFormats;
					/* call igweze file uploader */
					$uploadPicData = igwezeFileUploader($filePic, $picturePath, ($oneMB * 10), $validDocExt, $validDocType, $allowedDocExt, 
					$fileType = "Library book", $seVal); 
						
				}elseif($bookAllf  == $seVal){
						
					$allow_formats = $validPicFormats;
					/* call igweze file uploader */
					$uploadPicData = igwezeFileUploader($filePic, $picturePath, ($oneMB * 2), $validPicExt, $validPicType, $allowedPicExt, 
					$fileType = "Cover Picture", $fiVal); 
					
				}else{
						
					$allow_formats = $validDocFormats;
					/* call igweze file uploader */
					$uploadPicData = igwezeFileUploader($filePic, $picturePath, ($oneMB * 10), $validDocExt, $validDocType, $allowedDocExt, 
					$fileType = "Library book", $seVal); 
				} 
					
				if (is_array($uploadPicData['error'])) {  /* check if any upload error */
						
					$msg_e = '';
						
					foreach ($uploadPicData['error'] as $msg) {
						$msg_e .= $msg.'<br />';     /* display error messages */
					}
					
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'> hidePageLoader(); </script>"; exit; 
					
				} else {
					
					$uploadedPic = $uploadPicData['refilename']; /* uploaded picture file */
					
					if ($uploadedPic != "") {
							
						if (move_uploaded_file($_FILES[$filePic]['tmp_name'], $picturePath.$uploadedPic )) { /* move uploaded file to its path */
								
							try { 
									
								if($bookCopies == ''){ $bookCopies == $fiVal;}
								
								$bookDesc = str_replace('<br />', "\n", $bookDesc);

								$bookDesc = htmlspecialchars($bookDesc);

								$ebele_mark = "INSERT INTO $fobrainSchLib (book_name, book_author, book_desc, book_path, book_type, 
																			book_copies, book_location, stype,  book_status)
											
												VALUES(:book_name, :book_author, :book_desc, :book_path, :book_type, :book_copies, :book_location, 
														:stype, :book_status)";
												
								$igweze_prep = $conn->prepare($ebele_mark);	
								$igweze_prep->bindValue(':book_name', $bookName);
								$igweze_prep->bindValue(':book_author', $bookAuthor);
								$igweze_prep->bindValue(':book_desc', $bookDesc);
								$igweze_prep->bindValue(':book_path', $uploadedPic);
								$igweze_prep->bindValue(':book_type', $bookType);
								$igweze_prep->bindValue(':book_copies', $bookCopies);
								$igweze_prep->bindValue(':book_location', $bookLocation);
								$igweze_prep->bindValue(':stype', $schoolID); 
								$igweze_prep->bindValue(':book_status', $bookStatus);		

								if($igweze_prep->execute()){  /* insert picture name to database */

									$msg_s = "Library Book (<b>$bookName</b>) was successfully save";									
									echo $succesMsg.$msg_s.$sEnd; 	
									echo "<script type='text/javascript'> 
											$('#frmLibrary')[0].reset(); 
											hidePageLoader();
										</script>"; 
									exit;									

								}else{ /* display error messages */

									$msg_e = "Ooops, an error has occur while trying to save $pageDesc. Please try again or check your network connection!!!";
									echo $errorMsg.$msg_e.$eEnd;
									echo "<script type='text/javascript'> hidePageLoader(); </script>"; exit;

								} 

							}catch(PDOException $e) {
								
								fobrainDie( 'Ooops Database Error: ' . $e->getMessage());

							} 
								
						}else{ /* display error messages */
							
							$msg_e = "Ooops, an error has occur while trying to save $pageDesc. Please try again or check your network connection!!!";
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'> hidePageLoader(); </script>"; exit;
								
						}
							
					}else{ /* display error messages */ 

						$msg_e = "Ooops, an error has occur while trying to save $pageDesc. Please try again or check your network connection!!!";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'> hidePageLoader(); </script>"; exit;						

					} 
					
				}  

			}
		
		}elseif (($_REQUEST['library-data']) == 'update-lib-book') {  /* update library book */
		
			$bookID = clean($_REQUEST['bookID']);
			$bookName = clean($_REQUEST['book-name']);
			$bookAuthor = clean($_REQUEST['book-author']);
			$bookDesc = $_REQUEST['book-desc'];
			$bookCopies = cleanInt($_REQUEST['book-copies']);
			$bookLocation = clean($_REQUEST['book-location']);
			$bookStatus = clean($_REQUEST['book-status']);
			
			/* script validation */ 
			
			if($bookID == ''){
			
				$msg_e = "Ooops error, could not find this book information. Please try again";
				echo $errorMsg.$msg_e.$eEnd;
				echo "<script type='text/javascript'> hidePageLoader(); </script>"; exit; 
			
			}elseif($bookName == ''){
			
				$msg_e = "Ooops error, please enter book name to upload";
				echo $errorMsg.$msg_e.$eEnd;
				echo "<script type='text/javascript'> hidePageLoader(); </script>"; exit; 
			
			}elseif($bookAuthor == ''){
			
				$msg_e = "Ooops error, please enter book author";
				echo $errorMsg.$msg_e.$eEnd;
				echo "<script type='text/javascript'> hidePageLoader(); </script>"; exit; 
			
			}else{
				
				try {
					
					$bookDesc = str_replace('<br />', "\n", $bookDesc);

					$bookDesc = htmlspecialchars($bookDesc); 

					if($bookStatus == ''){
						
						$ebele_mark = "UPDATE $fobrainSchLib
						
										SET 
										
										book_name = :book_name,
										book_author = :book_author,
										book_desc = :book_desc
										
										WHERE book_id = :book_id";
										
						$igweze_prep = $conn->prepare($ebele_mark);	
						$igweze_prep->bindValue(':book_id', $bookID);
						$igweze_prep->bindValue(':book_name', $bookName);
						$igweze_prep->bindValue(':book_author', $bookAuthor);
						$igweze_prep->bindValue(':book_desc', $bookDesc);
					
					}else{
						
						if($bookCopies == ''){ $bookCopies == $fiVal; }
						
						$ebele_mark = "UPDATE $fobrainSchLib
						
										SET 
										
										book_name = :book_name,
										book_author = :book_author,
										book_desc = :book_desc,
										book_copies = :book_copies,
										book_location = :book_location,
										book_status = :book_status
										
										WHERE book_id = :book_id";
										
						$igweze_prep = $conn->prepare($ebele_mark);	
						$igweze_prep->bindValue(':book_id', $bookID);
						$igweze_prep->bindValue(':book_name', $bookName);
						$igweze_prep->bindValue(':book_author', $bookAuthor);
						$igweze_prep->bindValue(':book_desc', $bookDesc);
						$igweze_prep->bindValue(':book_copies', $bookCopies);
						$igweze_prep->bindValue(':book_location', $bookLocation);
						$igweze_prep->bindValue(':book_status', $bookStatus);									
					
					}  
						
					if ($igweze_prep->execute()) {  /* if sucessfully */ 
						
						$msgBox = "$bookName By $bookAuthor";
						$msg_s = "<b>$bookName</b> Book, was successfully updated";
						echo $succesMsg.$msg_s.$sEnd;   
						echo "<script type='text/javascript'> 
								$('#frmupdateLibrary').slideUp('500');
								$('#lib_name-".$bookID."').html('".$msgBox."');
								hidePageLoader();
							</script>"; exit;
																
					}else{  /* display error */ 
		
						$msg_e = "Library book  name was not successfully updated. Please try again";
						echo $errorMsg.$msg_e.$eEnd;
						echo "<script type='text/javascript'> hidePageLoader(); </script>"; exit; 
		
					}

				}catch(PDOException $e) {

					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
	
				}

			}
			
		}elseif (($_REQUEST['library-data']) == 'update-lib-book-upload') {  /* update library book */
		
			$bookID = clean($_REQUEST['bookID']);
			$bookType = clean($_REQUEST['book-type']);
			$bookAllf = clean($_REQUEST['allow-format']);
			$bookName = clean($_REQUEST['lib-book-name']);
			$bookPath = clean($_REQUEST['lib-book-path']);
			
			/* script validation */ 
			
			if($bookType == ''){
			
				$msg_e = "Ooops error, please select book type you are uploading";
				echo $errorMsg.$msg_e.$eEnd;
				echo "<script type='text/javascript'> hidePageLoader(); </script>"; exit;  
			
			}elseif(($bookAllf == '') || ($bookID == '') || ($bookName == '') || ($bookPath == '')){
				
				$msg_e = "Ooops error, could not retrieve this book information. Please try again"; 
				echo $errorMsg.$msg_e.$eEnd;
				echo "<script type='text/javascript'> hidePageLoader(); </script>"; exit; 
				
			}else{ 
				
				$picturePath = $fobrainLibDir; /* picture path */
				
				$filePic = "book-lib-upload"; /* picture file name */ 
				$pageDesc = "Library book picture";
				
				if($bookAllf  == $fiVal){
						
					$allow_formats = $validDocFormats;
					/* call igweze file uploader */
					$uploadPicData = igwezeFileUploader($filePic, $picturePath, ($oneMB * 10), $validDocExt, $validDocType, $allowedDocExt, 
					$fileType = "Library book", $seVal); 
						
				}elseif($bookAllf  == $seVal){
						
					$allow_formats = $validPicFormats;
					/* call igweze file uploader */
					$uploadPicData = igwezeFileUploader($filePic, $picturePath, ($oneMB * 1), $validPicExt, $validPicType, $allowedPicExt, 
					$fileType = "Cover Picture", $fiVal); 
					
				}else{
						
					$allow_formats = $validDocFormats;
					/* call igweze file uploader */
					$uploadPicData = igwezeFileUploader($filePic, $picturePath, ($oneMB * 10), $validDocExt, $validDocType, $allowedDocExt, 
					$fileType = "Library book", $seVal); 
				} 
					
				if (is_array($uploadPicData['error'])) {  /* check if any upload error */
						
					$msg_e = '';
						
					foreach ($uploadPicData['error'] as $msg) {
						$msg_e .= $msg.'<br />';     /* display error messages */
					}
				
					echo $errorMsg.$msg_e.$eEnd;
					echo "<script type='text/javascript'> hidePageLoader(); </script>"; exit; 
					
					
				} else {
					
					$uploadedPic = $uploadPicData['refilename']; /* uploaded picture file */
					
					if ($uploadedPic != "") {
							
						if (move_uploaded_file($_FILES[$filePic]['tmp_name'], $picturePath.$uploadedPic )) { /* move uploaded file to its path */
								
								
							try { 

								$ebele_mark = "UPDATE $fobrainSchLib
									
													SET 
													
													book_path = :book_path,
													book_type = :book_type
													
													WHERE book_id = :book_id";
													
								$igweze_prep = $conn->prepare($ebele_mark);	
								$igweze_prep->bindValue(':book_id', $bookID);
								$igweze_prep->bindValue(':book_path', $uploadedPic);
								$igweze_prep->bindValue(':book_type', $bookType);		 
									
								if ($igweze_prep->execute()) { /* insert picture name to database */
															 											
									$book_type = $libraryTypeArr[$bookType]; 
									
									if (($bookPath != '') && file_exists($picturePath.$bookPath)){ 											
										unlink($picturePath.$bookPath);
									}
									
									$msg_s = "$pageDesc was successfully uploaded";								
									echo $succesMsg.$msg_s.$sEnd; 

									$preview_img = $picturePath.$uploadedPic; 

									echo "<script type='text/javascript'> 
										$('#preview-picture-1').attr('src', '$preview_img?rand=' + Math.random());  
										$('#lib_type-".$bookID."').html('".$book_type."');
										hidePageLoader();									
									</script>";  exit;	 
																			
								}else{ /* display error messages */
									
									$msg_e = "Ooops, an error has occur while trying to save $pageDesc. Please try again or check your network connection!!!";
									echo $errorMsg.$msg_e.$eEnd; 
									echo "<script type='text/javascript'> hidePageLoader(); </script>"; exit;
					
								} 					 
									

							}catch(PDOException $e) {
								
								fobrainDie( 'Ooops Database Error: ' . $e->getMessage());

							} 
								
						}else{ /* display error messages */
							
							$msg_e = "Ooops, an error has occur while trying to save $pageDesc. Please try again or check your network connection!!!";
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'> hidePageLoader(); </script>"; exit;
								
						}
							
					}else{ /* display error messages */
					
						$msg_e = "Ooops, an error has occur while trying to save $pageDesc. Please try again or check your network connection!!!";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'> hidePageLoader(); </script>"; exit;						

					}	
					
					
				} 					
				
			}
		
		}elseif (($_REQUEST['library-data']) == 'remove-lib-book') {  /* remove library book */ 
					
			$bookID = $_REQUEST['bookID'];
			$bookPath = $_REQUEST['bookPath'];
			
			/* script validation */ 
			
			if($bookID == ''){
			
				$msg_e = "Ooops error, could not find this book information. Please try again";
				echo $errorMsg.$msg_e.$eEnd;
				echo "<script type='text/javascript'> hidePageLoader(); </script>"; exit;
			
			}elseif($bookPath == ''){
			
				$msg_e = "Ooops error, could not find this book information. Please try again";
				echo $errorMsg.$msg_e.$eEnd;
				echo "<script type='text/javascript'> hidePageLoader(); </script>"; exit;
			
			}else{ 
			
				try { 

					$ebele_mark = "DELETE
					
									FROM $fobrainSchLib
									
									WHERE book_id = :book_id
									
									LIMIT 1";
									
					$igweze_prep = $conn->prepare($ebele_mark);	
					$igweze_prep->bindValue(':book_id', $bookID); 
						
					if ($igweze_prep->execute()) {  /* if sucessfully */ 
						
						$rowID = 'lib_book_row-'.$bookID;
						
						$msg_s = "<b>$bookName</b> name was successfully remove";

						echo $succesMsg.$msg_s.$sEnd;  
						
						echo "<script type='text/javascript'> 
								$('#".$rowID."').fadeOut('100'); 
								hidePageLoader();
							</script>";
						
						if (($bookPath != '') && file_exists($fobrainLibDir.$bookPath)){ 
						
							unlink($fobrainLibDir.$bookPath);
						} 
						exit;
																
					}else{  /* display error */
		
						$msg_e = "Library book  name was not successfully remove. Please try again";
						echo $errorMsg.$msg_e.$eEnd;
						echo "<script type='text/javascript'> hidePageLoader(); </script>"; exit;
		
					}

				}catch(PDOException $e) {

					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
	
				}
				
			}
			
			
		}else{
		
			echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
		
		} 
			
		
exit;
?>