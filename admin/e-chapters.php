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
	This script handle student course chapters
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}
 
		define('fobrain', 'igweze');  /* define a check for wrong access of file */

		require 'fobrain-config.php';  /* load fobrain configuration files */ 
		
		if ($_REQUEST['query'] == 'update') {  /* save course chapter */  
				
			$hid = cleanInt($_REQUEST['hid']);
			$tid = cleanInt($_REQUEST['tid']);			
			$cid = cleanInt($_REQUEST['cid']);
			$chapter = clean($_REQUEST['chapter']); 
			$details =  clean($_REQUEST['details']);
			$ctype =  cleanInt($_REQUEST['ctype']);
			$link =  clean($_REQUEST['link']);
			$duration =  clean($_REQUEST['duration']);  
			$upload = $_REQUEST['upload']; 

			$script_scroll_cm = "
					$('#upload').val('');
					hidePageLoader();
					$('.fob-btn-loader').hide(4000);
					$('.fob-btn-div').show(5000); ";
			
			/* script validation */ 
			
			if ($hid == ""){

				$msg_e = "* Ooops, an error has occur to retrieve Chapter information. Please try again";
				echo $erroMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> 
					$script_scroll_cm  
				</script>"; exit;
				
			}elseif ($cid == "")  {

				$msg_e = "* Ooops Error, please select an Course topic to add its Chapter";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> 
					$script_scroll_cm  
				</script>"; exit;
				
			}elseif ($chapter == "")  {
				
				$msg_e = "* Ooops Error, please enter your topic title";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> 
					$script_scroll_cm  
				</script>"; exit;
				
			}elseif ($details == "")  {
				
				$msg_e = "* Ooops Error, please enter topic desciption";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> 
					$script_scroll_cm  
				</script>"; exit;
				
			}elseif ($ctype == "")  {
				
				$msg_e = "* Ooops Error, please enter document type";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> 
					$script_scroll_cm  
				</script>"; exit;
				
			}elseif ((($ctype == 2) ||($ctype == 3)) && ($duration == ""))  {
				
				$msg_e = "* Ooops Error, please enter video duration";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> 
					$script_scroll_cm  
				</script>"; exit;
				
			}else {  /* insert/update information */    

				$details = strip_tags($details);
				$details = str_replace('<br />', "\n", $details);
				$details = htmlspecialchars($details); 

				$name = $_FILES['upload']['name']; 

				if(strlen($name)) {
					
					$picturePath = $fobrainCourseDir; /* picture path */
					
					$filePic = "upload"; /* picture file name */
					$pageDesc = "Course Material";

					if($ctype  == $fiVal){
						
						//$allow_formats = $validDocFormats;
						/* call igweze file uploader */
						$uploadPicData = igwezeFileUploader($filePic, $picturePath, ($oneMB * 10), $validDocExt, $validDocType, $allowedDocExt, 
						$fileType = "Course Soft Copy", $seVal); 
							
					}elseif($ctype  == $seVal){
						
						//$allow_formats = $validPicFormats;
						/* call igweze file uploader */
						$uploadPicData = igwezeFileUploader($filePic, $picturePath, ($oneMB * 20), $validMediaExt, $validMediaType, $allowedVideoExt, 
						$fileType = "Course Video", $seVal); 
						
					}else{

						$uploadPicData = "";

					}
					
					/* call igweze file uploader */
					//$uploadPicData = igwezeFileUploader($filePic, $picturePath, ($oneMB * 1), $validPicExt, $validPicType, $allowedPicExt, 
					//$fileType = "Picture", $fiVal); 
						
					if (is_array($uploadPicData['error'])) {  /* check if any upload error */
							
						$msg_e = '';
							
						foreach ($uploadPicData['error'] as $msg) {
							$msg_e .= $msg.'<br />';     /* display error messages */
						}
						
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'> 
							$script_scroll_cm  
						</script>";
						exit;
						
						
					} else {
						
						$uploadedPic = $uploadPicData['refilename']; /* uploaded picture file */
						
						if ($uploadedPic != "") {
								
							if (move_uploaded_file($_FILES[$filePic]['tmp_name'], $picturePath.$uploadedPic )) { /* move uploaded file to its path */
									
									
								try { 

									if($hid >= $fiVal){
										
										if($upload != ""){ 
											
											removePicture($picturePath, $upload);

										}	
								
										$ebele_mark = "UPDATE $fobrainChapterTB  
															
															SET   
															
															chapter = :chapter,
															details = :details, 
															ctype = :ctype,
															link = :link,
															duration = :duration, 
															upload = :upload 
															
														WHERE hid = :hid";
										
										$igweze_prep = $conn->prepare($ebele_mark); 
										$igweze_prep->bindValue(':hid', $hid);
										//$igweze_prep->bindValue(':cid', $cid);  
										$igweze_prep->bindValue(':chapter', $chapter);
										$igweze_prep->bindValue(':details', $details);
										$igweze_prep->bindValue(':ctype', $ctype);
										$igweze_prep->bindValue(':link', $link);
										$igweze_prep->bindValue(':duration', $duration);
										$igweze_prep->bindValue(':upload', $uploadedPic);  
										
									}else{

										$ebele_mark = "INSERT INTO $fobrainChapterTB  (tid, cid, chapter, details, ctype, link, duration, upload)

												VALUES (:tid, :cid, :chapter, :details, :ctype, :link, :duration, :upload)";
										
										$igweze_prep = $conn->prepare($ebele_mark);
										$igweze_prep->bindValue(':tid', $tid);
										$igweze_prep->bindValue(':cid', $cid);
										$igweze_prep->bindValue(':chapter', $chapter);
										$igweze_prep->bindValue(':details', $details);
										$igweze_prep->bindValue(':ctype', $ctype);
										$igweze_prep->bindValue(':link', $link);
										$igweze_prep->bindValue(':duration', $duration);
										$igweze_prep->bindValue(':upload', $uploadedPic);  

									}

									if($igweze_prep->execute()){ /* insert picture name to database */ 
										
										$msg_s = "Course Topic was successfully saved."; 
										echo $succesMsg.$msg_s.$sEnd; 
										echo "<script type='text/javascript'> 
											$('#courseQuesDiv').load('e-topics-info.php?cid=".$cid."'); 
											$('#modal-fobrain').modal('hide');
											hidePageLoader(); 
										</script>";exit;
										
									}else{ /* display error messages */ 
										
										$msg_e =  "Ooops, an error has occur while to save Course Topic. Please try again";
										echo $errorMsg.$msg_e.$eEnd; 
										echo "<script type='text/javascript'> 
											$script_scroll_cm  
										</script>"; exit;
										
									}
									

								}catch(PDOException $e) { 
									
									fobrainDie( 'Ooops Database Error: ' . $e->getMessage());

								}
									
									
							}else{ /* display error messages */
									
								
								$msg_e = "Ooops, an error has occur while trying to save $pageDesc.
								Please try again or check your network connection!!!";
								echo $errorMsg.$msg_e.$eEnd; exit; 
									
							}
								
						}else{ /* display error messages */
							
							
							$msg_e = "Ooops, an error has occur while trying to save $pageDesc.
							Please try again or check your network connection!!!";
							echo $errorMsg.$msg_e.$eEnd; exit;							

						}	
						
						
					} 

				}else{
					
					try{
						
						if($hid >= $fiVal){
						
							$ebele_mark = "UPDATE $fobrainChapterTB  
												
												SET  

												chapter = :chapter, 
												details = :details, 
												ctype = :ctype,
												link = :link,
												duration = :duration 
												
											WHERE hid = :hid";
							
							$igweze_prep = $conn->prepare($ebele_mark);
							$igweze_prep->bindValue(':hid', $hid);
							//$igweze_prep->bindValue(':cid', $cid); 
							$igweze_prep->bindValue(':chapter', $chapter);
							$igweze_prep->bindValue(':details', $details);
							$igweze_prep->bindValue(':ctype', $ctype);
							$igweze_prep->bindValue(':link', $link);
							$igweze_prep->bindValue(':duration', $duration); 
							
						}else{

							$ebele_mark = "INSERT INTO $fobrainChapterTB  (tid, cid, chapter, details, ctype, link, duration)

									VALUES (:tid, :cid, :chapter, :details, :ctype, :link, :duration)";
							
							$igweze_prep = $conn->prepare($ebele_mark);
							$igweze_prep->bindValue(':tid', $tid);
							$igweze_prep->bindValue(':cid', $cid);
							$igweze_prep->bindValue(':chapter', $chapter);
							$igweze_prep->bindValue(':details', $details);
							$igweze_prep->bindValue(':ctype', $ctype);
							$igweze_prep->bindValue(':link', $link);
							$igweze_prep->bindValue(':duration', $duration); 

						}

						if($igweze_prep->execute()){  /* if sucessfully */
							
							$msg_s = "Course Topic was successfully saved."; 
							echo $succesMsg.$msg_s.$sEnd; 
							echo "<script type='text/javascript'> 
								$('#courseQuesDiv').load('e-topics-info.php?cid=".$cid."'); 
								$('#modal-fobrain').modal('hide');
								hidePageLoader(); 
							</script>";exit;
							
						}else{  /* display error */ 
				
							$msg_e =  "Ooops, an error has occur while to save Course Topic. Please try again";
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'> 
								$script_scroll_cm  
							</script>"; exit;
							
						}						

					}catch(PDOException $e) {
		
						fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
				
					}			

				}  
		
			}
		
		}elseif ($_REQUEST['query'] == 'remove') {  /* remove course chapter */ 

			$chapter = $_REQUEST['rData'];
			
			list($fobrainIg, $hid, $hName) = explode("-", $chapter);			
			
			/* script validation */ 
			
			if (($chapter == "")  || ($hid == "")){
				
				$msg_e = "* Ooops, an error has occur while to remove Topic information. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
				
			}else {   

				try { 
					
					$ebele_mark = "DELETE FROM 
					
									$fobrainChapterTB										
										
									WHERE hid = :hid
										
									LIMIT 1";
					
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':hid', $hid); 
					
					if($igweze_prep->execute()){  /* if sucessfully */ 
						
						$removeDiv = "$('#row-".$hid."').fadeOut(1000);";
						$msg_s = "<strong>$hName</strong> was successfully removed"; 
						echo $succesMsg.$msg_s.$sEnd; 
						echo "<script type='text/javascript'>   
						hidePageLoader(); $('.slideUpFrmDiv').fadeOut(3000); $removeDiv  </script>";exit;
						
					}else{  /* display error */ 
			
						$msg_e =  "Ooops, an error has occur while to remove Topic information. Please try again";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
						
					}
					

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				} 
		
			}
		
		}elseif ($_REQUEST['query'] == 'view') {  /* view course chapter */

			
			$hid = strip_tags($_REQUEST['rData']);
			
			/* script validation */
			
			if ($hid == ""){
				
				$msg_e = "* Ooops, an error has occur while to retrieve Chapter information. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}else {  /* select information */       			


				try {
					
		
					$chapterInfoArr = chapterInfo($conn, $hid);  /* online course chapter information */
					//$hid = $chapterInfoArr[$fiVal]["hid"];
					$cid = $chapterInfoArr[$fiVal]["cid"];
					$chapter = htmlspecialchars_decode($chapterInfoArr[$fiVal]["chapter"]);
					$upload = $chapterInfoArr[$fiVal]["upload"]; 
					$details = $chapterInfoArr[$fiVal]["details"];
					$ctype = $chapterInfoArr[$fiVal]["ctype"];
					$link = $chapterInfoArr[$fiVal]["link"];
					$duration = $chapterInfoArr[$fiVal]["duration"];
					 
					$details = nl2br($details); 
					
					$upload_doc = $fobrainCourseDir.$upload;
					
					if(($upload != "") && (file_exists($upload_doc))){  /* check if picture exits */

$showQPicture =<<<IGWEZE
	
						<tr>
							<td colspan="2" class="text-center">								
								<img src = "$upload_doc"  class="img-fluid" > 
							</td> 
						</tr>  
	
IGWEZE;
			

					}	
								
								

$show_view =<<<IGWEZE
	
					<div class="row gutters mb-10">
						<div class="text-end">
							<button  class="btn btn-primary"   id="print-overlay">
								<i class="fas fa-print"></i>  
							</button>
						</div>	
					</div>
							
					<div id = 'fobrain-print-ovly'>

						<!-- table -->	
						<table  class="table table-view table-hover table-responsive"> 
							
							<tr>
								<th>
									Topic 
								</th> 
								<td>
									$chapter
								</td> 
							</tr>
							
							$showQPicture 
							
							<tr>
								<th>
									Option A
								</th> 
								<td>
									$details
								</td> 
							</tr>

							<tr>
								<th>
									Option B
								</th> 
								<td>
									$ctype
								</td> 
							</tr>

							<tr>
								<th>
									Option C
								</th> 
								<td>
									$link
								</td> 
							</tr>

							<tr>
								<th>
									Option D
								</th> 
								<td>
									$duration
								</td> 
							</tr> 
						</table>
						<!-- /table -->	 

					</div>
	
IGWEZE;
			
					echo $show_view; 
			
					echo "<script type='text/javascript'>  hidePageLoader(); </script>"; exit;  

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				} 
		
			}
		
		}elseif ($_REQUEST['query'] == 'edit') {  /* edit course chapter */

			$qData = clean($_REQUEST['qData']); 

			list ($none, $hid, $cid, $tid) = explode ('-', $qData);	
			
			/* script validation */ 
			
			if (($hid == "") || ($cid == "") || ($tid == "")){
				
				$msg_e = "* Ooops, an error has occur while to retrieve Course Chapter information. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}else {    

				try {
					
					if($hid >= $fiVal){  /* check if chapter ID is true */
						
						$chapterInfoArr = chapterInfo($conn, $hid);  /* online course chapter information */
						$tid = $chapterInfoArr[$fiVal]["tid"];
						$cid = $chapterInfoArr[$fiVal]["cid"];
						$chapter = $chapterInfoArr[$fiVal]["chapter"];
						$details = htmlspecialchars_decode($chapterInfoArr[$fiVal]["details"]);
						$ctype = $chapterInfoArr[$fiVal]["ctype"];
						$link = $chapterInfoArr[$fiVal]["link"];
						$duration = $chapterInfoArr[$fiVal]["duration"];
						
						$upload = ""; //$upload = $chapterInfoArr[$fiVal]["upload"];  
						
						if($ctype  == $fiVal){
						
							$upload_doc = picture($fobrainCourseDir, $upload, "doc"); 
								
						}elseif($ctype  == $seVal){
							
							$upload_doc = picture($fobrainCourseDir, $upload, "exam");
							
						}else{

							$upload_doc = $wiz_df_file_img;

						}
						
						
					}else{
						 
						$hid = $i_false;
						$upload_doc = $wiz_df_file_img;
						$chapter = "";  
						$details = "";
						$ctype = "";
						$link = "";
						$duration = ""; 
					
					}	 
					
?>

					<!-- form -->
					<form method="POST" class="form-horizontal" id="frmupdateChapter" role="form" enctype="multipart/form-data">
							
						<!-- row -->
						<div class="row gutters">
							<div class="col-12">										
								<!-- field wrapper start -->
								<div class="field-wrapper">
									<input type="text" class="form-control required capWords" value ="<?php echo $chapter; ?>" 
										name="chapter" id="chapter" /> 
								
									<div class="field-placeholder"> Topic Title <span class="text-danger">*</span></div>
								</div>
								<!-- field wrapper end -->
							</div>									 
						</div>	
						<!-- /row --> 

						<!-- row -->
						<div class="row gutters">
							<div class="col-12">										
								<!-- field wrapper start -->
								<div class="field-wrapper">
									<textarea rows="4" cols="10" class="form-control" name="details" id="details"  required
									placeholder="Enter Chapter Details "><?php echo $details; ?></textarea>
									<div class="field-placeholder"> Topic Details <span class="text-danger">*</span></div>
								</div>
								<!-- field wrapper end -->
							</div>
							
							<div class="col-12">										
								<!-- field wrapper start -->
								<div class="field-wrapper">
									<select class="form-control fob-select"  id="ctype" name="ctype" required>                                              
										<option value = "">Please select One</option>                                                              
										<?php

											foreach($course_material_list as $ctype_ind => $ctype_val){  /* loop array */

												if ($ctype == $ctype_ind){
													$selected = "SELECTED";
												} else {
													$selected = "";
												}

												echo '<option value="'.$ctype_ind.'"'.$selected.'>'.$ctype_val.'</option>' ."\r\n";

											}

										?> 
									</select> 					
									<div class="field-placeholder"> Course Material Type  <span class="text-danger">*</span></div>										 
								</div>
								<!-- field wrapper end -->
							</div>	 

						</div>	
						<!-- /row --> 

						<!-- row -->
						<div class="row gutters external-video-link">
							<div class="col-12">										
								<!-- field wrapper start -->
								<div class="field-wrapper">
									<input type="text" class="form-control required" value ="<?php echo $link; ?>" 
										name="link" id="link" /> 
								
									<div class="field-placeholder"> Video Link <span class="text-danger">*</span></div>
								</div>
								<!-- field wrapper end -->
							</div>									 
						</div>	
						<!-- /row -->
							
						<!-- row -->
						<div class="row gutters c-duration-div"> 
							
							<div class="col-12">										
								<!-- field wrapper start -->
								<div class="field-wrapper"> 
									<input type="number" class="form-control" placeholder="10 Mins" 
										name="duration"  id="duration" value="<?php echo $duration; ?>" maxlength="20" >
									<div class="field-placeholder">Duration (Minutes) <span class="text-danger">*</span></div>
								</div>
								<!-- field wrapper end -->
							</div>	 
 					 
						</div>	
						<!-- /row -->

						 

						<!-- row -->
						<div class="row gutters justify-content-center mt-25"> 
							<div class="col-12 text-center" id="course-upload-div">
								<div class="picture-div mb-20">
									<img src="<?php echo $upload_doc; ?>" id="preview-picture" alt=" Quesion Picture" class="img-h-150 rounded img-thumbnail" />
								</div>
								<!-- field wrapper start -->
								<div class="field-wrapper">
									<label class="upload fob-btn-div">
										<i class="mdi mdi-cloud-upload-outline fs-24 text-danger"></i>
										<input type="file"id="eChapterPic" name="upload" class="form-control ps-15 hide">
									</label> 
									<div class="form-text fob-btn-div">  
										<div id="diplay-c-text" class="text-info">Upload </div>
										<div class="text-danger"> 
										<span id="allow-format-video">Only max image size of 20MB &amp; format of <?php echo $allowedVideoExt; ?> are allowed.</span> 
										<span id="allow-format-doc">Only max file size of 10MB &amp; format of <?php echo $allowedDocExt; ?> are allowed.</span>  
										</div>
									</div>
									<div class="display-none fob-btn-loader">
										<strong role="status">Processing...</strong>
										<div class="spinner-border ms-auto" aria-hidden="true"></div>
									</div>
								</div>
								<!-- field wrapper end -->
							</div> 
						</div>
						<!-- /row -->			 
						
							
							
						<hr class="mt-30 mb-15 text-danger" />
						<!-- row -->
						<div class="row gutters modal-btn-footer">
							<div class="col-6 text-start">
								<button type="button" id="close-modal" class="btn btn-danger close-modal" 
								data-bs-dismiss="modal"> <i class="mdi mdi-window-close label-icon"></i> Close</button>
							</div>
							<div class="col-6 text-end">
								<input type="hidden" name="query" value="update" />
								<input type="hidden" name="allow-format" id="allow-format" value="" />	
								<input type="hidden" name="hid" value="<?php echo $hid; ?>" />
								<input type="hidden" name="tid" value="<?php echo $tid; ?>" />
								<input type="hidden" name="cid" value="<?php echo $cid; ?>" />
								<input type="hidden" name="upload" value="<?php echo $upload; ?>" />	
								<button type="submit" class="btn btn-primary waves-effect   
								btn-label waves-light" id="updateChapter">
									<i class="mdi mdi-content-save label-icon"></i>  Save
								</button>
							</div>
						</div>	
						<!-- /row -->
						
							
					</form>
					<!-- / form -->	
					<script type='text/javascript'>  

											
						hidePageLoader();	
						/*				
						$('.fob-select').each(function() {  
							renderSelect($('#'+this.id)); 
						});  
						*/
						
						$('body').on('change','#ctype',function(){  /* select course book type */	  
				
							var course_type = $('#ctype').val();
							
							if(course_type == 1){
								
								$('#course-upload-div, #allow-format-doc').show(500);
								$('#allow-format-video, .external-video-link, .c-duration-div').hide(500);
								$('#diplay-c-text').text('Upload Electronic Book');
								$('#allow-format').val('1');
								
							}else if (course_type == 2){ 
						
								$('#course-upload-div, #allow-format-video, .c-duration-div').show(500);
								$('#allow-format-doc, .external-video-link').hide(500);
								$('#diplay-c-text').text('Upload Course Video');
								$('#allow-format').val('2');
							
							}else if (course_type == 3){ 
							
								$('.external-video-link, .c-duration-div').show(500);
								$('#course-upload-div').hide(500); 
								$('#allow-format').val('3');
							
							}else{
								
								$('.c-duration-div, #allow-format-doc').hide(500);
								$('#allow-format-video').show(500);
								$('#diplay-c-text').text('Upload');
								$('#allow-format').val('');
							
							}
									
						});	

						$('#ctype').change();

					</script>
<?php
				
					exit;

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				} 
		
			}
		
		}else{
		
			echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
		
		}


	
		
exit;
?>