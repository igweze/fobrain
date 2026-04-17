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
	This script handle student exam questions
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}
 
		define('fobrain', 'igweze');  /* define a check for wrong access of file */

		require 'fobrain-config.php';  /* load fobrain configuration files */
			
		if ($_REQUEST['question'] == 'update') {  /* save exam question */ 
				
			$qID = cleanInt($_REQUEST['qID']);			
			$eID = cleanInt($_REQUEST['eID']);
			$question = clean($_REQUEST['questionQ']); 
			$q1 =  clean($_REQUEST['q1']);
			$q2 =  clean($_REQUEST['q2']);
			$q3 =  clean($_REQUEST['q3']);
			$q4 =  clean($_REQUEST['q4']); 
			$ans =  $_REQUEST['ans'];
			$qPic = $_REQUEST['qPic'];
			$qMark = cleanInt($_REQUEST['qMark']);

			$script_scroll_cm = "
					$('#qPicture').val('');
					hidePageLoader();
					$('.fob-btn-loader').slideUp(4000);
					$('.fob-btn-div').slideDown(5000); ";
			
			/* script validation */ 
			
			if ($qID == ""){

				$msg_e = "* Ooops, an error has occur to retrieve Question information. Please try again";
				echo $erroMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> 
					$script_scroll_cm  
				</script>"; exit;
				
			}elseif ($eID == "")  {

				$msg_e = "* Ooops Error, please select an Exam to add Question";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> 
					$script_scroll_cm  
				</script>"; exit;
				
			}elseif ($question == "")  {
				
				$msg_e = "* Ooops Error, please enter your Question";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> 
					$script_scroll_cm  
				</script>"; exit;
				
			}elseif ($q1 == "")  {
				
				$msg_e = "* Ooops Error, please enter question Option A";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> 
					$script_scroll_cm  
				</script>"; exit;
				
			}elseif ($q2 == "")  {
				
				$msg_e = "* Ooops Error, please enter question Option B";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> 
					$script_scroll_cm  
				</script>"; exit;
				
			}elseif ($q3 == "")  {
				
				$msg_e = "* Ooops Error, please enter question Option C";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> 
					$script_scroll_cm  
				</script>"; exit;
				
			}elseif ($q4 == "")  {
				
				$msg_e = "* Ooops Error, please enter question Option D";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> 
					$script_scroll_cm  
				</script>"; exit;
				
			}elseif ($ans == "")  {

				$msg_e = "* Ooops Error, please select an Option Answer";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> 
					$script_scroll_cm  
				</script>"; exit;
				
			}elseif ($qMark == "")  {

				$msg_e = "* Ooops Error, please select a Question Mark";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> 
					$script_scroll_cm  
				</script>"; exit;
				
			}else {  /* insert/update information */   	 


				$question = strip_tags($question);
				$question = str_replace('<br />', "\n", $question);
				$question = htmlspecialchars($question); 

				$name = $_FILES['qPicture']['name']; 

				if(strlen($name)) {
					
					$picturePath = $fobrainQuestionDir; /* picture path */
					
					$filePic = "qPicture"; /* picture file name */
					$pageDesc = "Question picture";
					
					/* call igweze file uploader */
					$uploadPicData = igwezeFileUploader($filePic, $picturePath, ($oneMB * 1), $validPicExt, $validPicType, $allowedPicExt, 
					$fileType = "Picture", $fiVal); 
						
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

									if($qID >= $fiVal){
										
										if($qPic != ""){ 
											
											removePicture($picturePath, $qPic);

										}	
								
										$ebele_mark = "UPDATE $fobrainQuestionTB  
															
															SET 
															
															eID = :eID, 
															question = :question,
															q1 = :q1, 
															q2 = :q2,
															q3 = :q3,
															q4 = :q4, 
															qPicture = :qPicture,
															ans = :ans,		
															qMark = :qMark
															
														WHERE qID = :qID";
										
										$igweze_prep = $conn->prepare($ebele_mark);
										$igweze_prep->bindValue(':qID', $qID);
										$igweze_prep->bindValue(':eID', $eID); 
										$igweze_prep->bindValue(':question', $question);
										$igweze_prep->bindValue(':q1', $q1);
										$igweze_prep->bindValue(':q2', $q2);
										$igweze_prep->bindValue(':q3', $q3);
										$igweze_prep->bindValue(':q4', $q4);
										$igweze_prep->bindValue(':qPicture', $uploadedPic); 
										$igweze_prep->bindValue(':ans', $ans);
										$igweze_prep->bindValue(':qMark', $qMark);
										
									}else{

										$ebele_mark = "INSERT INTO $fobrainQuestionTB  (eID, question, q1, q2, q3, q4, qPicture, ans, qMark)

												VALUES (:eID, :question, :q1, :q2, :q3, :q4, :qPicture, :ans, :qMark)";
										
										$igweze_prep = $conn->prepare($ebele_mark);
										$igweze_prep->bindValue(':eID', $eID);
										$igweze_prep->bindValue(':question', $question);
										$igweze_prep->bindValue(':q1', $q1);
										$igweze_prep->bindValue(':q2', $q2);
										$igweze_prep->bindValue(':q3', $q3);
										$igweze_prep->bindValue(':q4', $q4);
										$igweze_prep->bindValue(':qPicture', $uploadedPic); 
										$igweze_prep->bindValue(':ans', $ans);
										$igweze_prep->bindValue(':qMark', $qMark);

									}

									if($igweze_prep->execute()){ /* insert picture name to database */ 
										
										$msg_s = "Exam Question was successfully saved."; 
										echo $succesMsg.$msg_s.$sEnd; 
										echo "<script type='text/javascript'> 
											$('#examQuesDiv').load('e-questions-info.php?eID=".$eID."'); 
											$('#modal-fobrain').modal('hide');
											hidePageLoader(); 
										</script>";exit;
										
									}else{ /* display error messages */ 
										
										$msg_e =  "Ooops, an error has occur while to save Exam Question. Please try again";
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
						
						if($qID >= $fiVal){
						
							$ebele_mark = "UPDATE $fobrainQuestionTB  
												
												SET 
												
												eID = :eID, 
												question = :question, 
												q1 = :q1, 
												q2 = :q2,
												q3 = :q3,
												q4 = :q4,  
												ans = :ans,		
												qMark = :qMark	 
												
											WHERE qID = :qID";
							
							$igweze_prep = $conn->prepare($ebele_mark);
							$igweze_prep->bindValue(':qID', $qID);
							$igweze_prep->bindValue(':eID', $eID);
							$igweze_prep->bindValue(':question', $question);
							$igweze_prep->bindValue(':q1', $q1);
							$igweze_prep->bindValue(':q2', $q2);
							$igweze_prep->bindValue(':q3', $q3);
							$igweze_prep->bindValue(':q4', $q4);
							$igweze_prep->bindValue(':ans', $ans);
							$igweze_prep->bindValue(':qMark', $qMark);
							
						}else{

							$ebele_mark = "INSERT INTO $fobrainQuestionTB  (eID, question, q1, q2, q3, q4, ans, qMark)

									VALUES (:eID, :question, :q1, :q2, :q3, :q4, :ans, :qMark)";
							
							$igweze_prep = $conn->prepare($ebele_mark);
							$igweze_prep->bindValue(':eID', $eID);
							$igweze_prep->bindValue(':question', $question);
							$igweze_prep->bindValue(':q1', $q1);
							$igweze_prep->bindValue(':q2', $q2);
							$igweze_prep->bindValue(':q3', $q3);
							$igweze_prep->bindValue(':q4', $q4);
							$igweze_prep->bindValue(':ans', $ans);
							$igweze_prep->bindValue(':qMark', $qMark);


						}

						if($igweze_prep->execute()){  /* if sucessfully */
							
							$msg_s = "Exam Question was successfully saved."; 
							echo $succesMsg.$msg_s.$sEnd; 
							echo "<script type='text/javascript'> 
								$('#examQuesDiv').load('e-questions-info.php?eID=".$eID."'); 
								$('#modal-fobrain').modal('hide');
								hidePageLoader(); 
							</script>";exit;
							
						}else{  /* display error */ 
				
							$msg_e =  "Ooops, an error has occur while to save Exam Question. Please try again";
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
		
		}elseif ($_REQUEST['question'] == 'remove') {  /* remove exam question */ 

			$question = $_REQUEST['rData'];
			
			list($fobrainIg, $qID, $hName) = explode("-", $question);			
			
			/* script validation */ 
			
			if (($question == "")  || ($qID == "")){
				
				$msg_e = "* Ooops, an error has occur while to remove Question information. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
				
			}else {   

				try { 
					
					$ebele_mark = "DELETE FROM 
					
									$fobrainQuestionTB										
										
									WHERE qID = :qID
										
									LIMIT 1";
					
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':qID', $qID); 
					
					if($igweze_prep->execute()){  /* if sucessfully */ 
						
						$removeDiv = "$('#row-".$qID."').fadeOut(1000);";
						$msg_s = "<strong>$hName</strong> was successfully removed"; 
						echo $succesMsg.$msg_s.$sEnd; 
						echo "<script type='text/javascript'>   
						hidePageLoader(); $('.slideUpFrmDiv').fadeOut(3000); $removeDiv  </script>";exit;
						
					}else{  /* display error */ 
			
						$msg_e =  "Ooops, an error has occur while to remove Question information. Please try again";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
						
					}
					

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				} 
		
			}
		
		}elseif ($_REQUEST['question'] == 'view') {  /* view exam question */

			
			$qID = strip_tags($_REQUEST['rData']);
			
			/* script validation */
			
			if ($qID == ""){
				
				$msg_e = "* Ooops, an error has occur while to retrieve Question information. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}else {  /* select information */       			


				try {
					
		
					$questionInfoArr = questionInfo($conn, $qID);  /* online exam question information */
					//$qID = $questionInfoArr[$fiVal]["qID"];
					$eID = $questionInfoArr[$fiVal]["eID"];
					$question = htmlspecialchars_decode($questionInfoArr[$fiVal]["question"]);
					$qPicture = $questionInfoArr[$fiVal]["qPicture"]; 
					$q1 = $questionInfoArr[$fiVal]["q1"];
					$q2 = $questionInfoArr[$fiVal]["q2"];
					$q3 = $questionInfoArr[$fiVal]["q3"];
					$q4 = $questionInfoArr[$fiVal]["q4"];
					$ans = $questionInfoArr[$fiVal]["ans"];
					$qMark = $questionInfoArr[$fiVal]["qMark"];
					$question = nl2br($question);

					$ans = wizSelectArray($ans, $question_list_2);
					
					$eQPic = $fobrainQuestionDir.$qPicture;
					
					if(($qPicture != "") && (file_exists($eQPic))){  /* check if picture exits */

$showQPicture =<<<IGWEZE
	
						<tr>
							<td colspan="2" class="text-center">								
								<img src = "$eQPic"  class="img-fluid" > 
							</td> 
						</tr>  
	
IGWEZE;
			

					}	
								
								

$showPayment =<<<IGWEZE
	
					<div class="row gutters mb-10">
						<div class="text-end">
							<button  class="btn btn-primary" onclick="printDiv('fobrain-print-ovly')">
								<i class="fas fa-print"></i>  
							</button>
						</div>	
					</div>
							
					<div id = 'fobrain-print-ovly'>

						<!-- table -->	
						<table  class="table table-view table-hover table-responsive"> 
							
							<tr>
								<th>
									Question 
								</th> 
								<td>
									$question
								</td> 
							</tr>
							
							$showQPicture 
							
							<tr>
								<th>
									Option A
								</th> 
								<td>
									$q1
								</td> 
							</tr>

							<tr>
								<th>
									Option B
								</th> 
								<td>
									$q2
								</td> 
							</tr>

							<tr>
								<th>
									Option C
								</th> 
								<td>
									$q3
								</td> 
							</tr>

							<tr>
								<th>
									Option D
								</th> 
								<td>
									$q4
								</td> 
							</tr>

							<tr>
								<th>
									Answer 
								</th> 
								<td>
									Options $ans
								</td> 
							</tr>

							<tr>
								<th>
										Marking
								</th> 
								<td>
									$qMark
								</td> 
							</tr> 
						</table>
						<!-- /table -->	 

					</div>
	
IGWEZE;
			
					echo $showPayment; 
			
					echo "<script type='text/javascript'>  hidePageLoader(); </script>"; exit;  

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				} 
		
			}
		
		}elseif ($_REQUEST['question'] == 'edit') {  /* edit exam question */

			$qID = cleanInt($_REQUEST['questionID']);
			$eID = cleanInt($_REQUEST['examID']);
			
			/* script validation */ 
			
			if ($eID == ""){
				
				$msg_e = "* Ooops, an error has occur while to retrieve Exam Question information. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}else {       			


				try {
					
					if($qID >= $fiVal){  /* check if question ID is true */
						
						$questionInfoArr = questionInfo($conn, $qID);  /* online exam question information */
						//$qID = $questionInfoArr[$fiVal]["qID"];
						$eID = $questionInfoArr[$fiVal]["eID"];
						$question = htmlspecialchars_decode($questionInfoArr[$fiVal]["question"]);
						$q1 = $questionInfoArr[$fiVal]["q1"];
						$q2 = $questionInfoArr[$fiVal]["q2"];
						$q3 = $questionInfoArr[$fiVal]["q3"];
						$q4 = $questionInfoArr[$fiVal]["q4"];
						$qPicture = $questionInfoArr[$fiVal]["qPicture"]; 
						$ans = $questionInfoArr[$fiVal]["ans"];
						$qMark = $questionInfoArr[$fiVal]["qMark"]; 
							
						$eQPic = picture($fobrainQuestionDir, $qPicture, "exam");
						
					}else{
						
						$qID = $i_false;
						$eQPic = $wiz_df_file_img;
						$question = ""; 
						$qMark = "";
						$q1 = "";
						$q2 = "";
						$q3 = "";
						$q4 = "";
						$ans = "";
					
					}	 
					
?>

					<!-- form -->
					<form method="POST" class="form-horizontal" id="frmupdateQuestion" role="form" enctype="multipart/form-data">
							
						<!-- row -->
						<div class="row gutters">
							<div class="col-12">										
								<!-- field wrapper start -->
								<div class="field-wrapper">
									<textarea rows="4" cols="10" class="form-control" name="questionQ" id="questionQ"  required
									placeholder="Enter Exam Question, can be indent as liked "><?php echo $question; ?></textarea>
								
									<div class="field-placeholder"> Exam Question <span class="text-danger">*</span></div>
								</div>
								<!-- field wrapper end -->
							</div>									 
						</div>	
						<!-- /row --> 
							
						<!-- row -->
						<div class="row gutters"> 
							
							<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">										
								<!-- field wrapper start -->
								<div class="field-wrapper"> 
									<input type="text" class="form-control" placeholder="Enter question 1 here" 
										name="q1"  id="q1" value="<?php echo $q1; ?>" maxlength="255" >
									<div class="field-placeholder">Option A <span class="text-danger">*</span></div>
								</div>
								<!-- field wrapper end -->
							</div>	

							<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">										
								<!-- field wrapper start -->
								<div class="field-wrapper"> 
									<input type="text" class="form-control" placeholder="Enter question 2 here" 
										name="q2"  id="q2" value="<?php echo $q2; ?>" maxlength="255" >
									<div class="field-placeholder">Option B <span class="text-danger">*</span></div>
								</div>
								<!-- field wrapper end -->
							</div>	

							<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">										
								<!-- field wrapper start -->
								<div class="field-wrapper"> 
									<input type="text" class="form-control" placeholder="Enter question 3 here" 
										name="q3"  id="q3" value="<?php echo $q3; ?>" maxlength="255" >
									<div class="field-placeholder">Option C <span class="text-danger">*</span></div>
								</div>
								<!-- field wrapper end -->
							</div>	

							<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">										
								<!-- field wrapper start -->
								<div class="field-wrapper"> 
									<input type="text" class="form-control" placeholder="Enter question 4 here" 
										name="q4"  id="q4" value="<?php echo $q4; ?>" maxlength="255" >
									<div class="field-placeholder">Option D <span class="text-danger">*</span></div>
								</div>
								<!-- field wrapper end -->
							</div>
							
							<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">										
								<!-- field wrapper start -->
								<div class="field-wrapper">
									<select class="form-control fob-select"  id="ans" name="ans" required>                                              
										<option value = "">Please select One</option>                                                              
										<?php

											foreach($question_list as $answer => $answerVal){  /* loop array */

												if ($ans == $answer){
												$selected = "SELECTED";
												} else {
												$selected = "";
												}

												echo '<option value="'.$answer.'"'.$selected.'>'.$answerVal.'</option>' ."\r\n";

											}

										?> 
									</select> 					
									<div class="field-placeholder"> Select Answer  <span class="text-danger">*</span></div>										 
								</div>
								<!-- field wrapper end -->
							</div>	 

							<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">										
								<!-- field wrapper start -->
								<div class="field-wrapper">
										
									<input type="number" class="form-control" placeholder="E.g 4, 10, 20" 
									name="qMark"  id="qMark" value = "<?php echo $qMark; ?>" required>
									
									<div class="field-placeholder"> Question Mark <span class="text-danger">*</span></div>
								</div>
								<!-- field wrapper end -->
							</div>									 
						</div>	
						<!-- /row -->

						<hr class="my-25 text-danger" />		

						<!-- row -->
						<div class="row gutters justify-content-center"> 
							<div class="col-12 text-center">
								<div class="picture-div mb-20">
									<img src="<?php echo $eQPic; ?>" id="preview-picture" alt=" Quesion Picture" class="img-h-150 rounded img-thumbnail" />
								</div>
								<!-- field wrapper start -->
								<div class="field-wrapper">
									<label class="upload fob-btn-div">
										<i class="mdi mdi-cloud-upload-outline fs-24 text-danger"></i>
										<input type="file"id="eQuestionPic" name="qPicture" class="form-control ps-15 hide">
									</label> 
									<div class="form-text fob-btn-div"> 
										<div class="text-info">Upload Quesion Picture</div>
										<div class="text-danger">Only max image size of 2MB &amp; format of <?php echo $allowedPicExt; ?> are allowed.</div>
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
								<input type="hidden" name="question" value="update" />
								<input type="hidden" name="qID" value="<?php echo $qID; ?>" />
								<input type="hidden" name="eID" value="<?php echo $eID; ?>" />
								<input type="hidden" name="qPic" value="<?php echo $qPicture; ?>" />	
								<button type="submit" class="btn btn-primary waves-effect   
								btn-label waves-light" id="updateQuestion">
									<i class="mdi mdi-content-save label-icon"></i>  Save
								</button>
							</div>
						</div>	
						<!-- /row -->
						
							
					</form>
					<!-- / form -->	
					<script type='text/javascript'>  

											
						hidePageLoader();					
						$('.fob-select').each(function() {  
							renderSelect($('#'+this.id)); 
						});  
					
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