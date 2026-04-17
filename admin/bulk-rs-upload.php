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
	This script handle student bulk result uploads
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

	require 'vendor/autoload.php';

	use PhpOffice\PhpSpreadsheet\{SpreadSheet, IOFactory};
	use PhpOffice\PhpSpreadsheet\Writer\Xlsx; //Csv, Xls

		define('fobrain', 'igweze');  /* define a check for wrong access of file */ 
		require 'fobrain-config.php';  /* load fobrain configuration files */    
			 
		if (($_REQUEST['query']) == 'upload') {  

			$term = $_REQUEST['term']; 
			$level = $_REQUEST['level']; 
			$class_data = clean($_REQUEST['class']);
			$session = $_REQUEST['sess'];
			$uMode = $_REQUEST['uMode'];
			$uData = $_REQUEST['uploadData'];
			$time = date("Y-m-d H:i:s");   

			list ($class, $class_val) = explode ("@+@", $class_data);

			$script_scroll_cm = "
							$('#bulk-excel-result').val('');
							$('.fob-btn-loader').fadeOut(2000); 
							$('.fob-btn-div').fadeIn(4000); 
							hidePageLoader();
							$('html, body').animate({scrollTop:$('.page-content').position().top}, 'slow');";

			if($uMode == $fiVal){

				if (($_REQUEST['sess'] == "") || ($_REQUEST['level'] == "")  
					|| ($_REQUEST['class'] == "")  || ($_REQUEST['term'] == "")
					|| ($class == "") )  {

					$msg_e =  $formErrorMsg;
					echo $erroMsg.$msg_e.$msgEnd;
					echo "<script type='text/javascript'> 
								$script_scroll_cm  
						</script>"; exit;

				}
				
			}		
			 
			
			try {
			
				$sessionID = sessionID($conn, $session);  /* school session ID */ 
				
				$rsStatus = fobrainResultStatus($conn, $sessionID, $class, $level, $term);	 /* student result status */	
				
				if  ($rsStatus == $rspublishStage){	 /* check student result status */		
												
					$session = fobrainSession($conn, $sessionID);  /* school session  */			
					$session_se = $session + $foreal;
					$SessSem = schoolTerm($term);  /* school term  */
											
					$msg_e = "$tframeF $SessSem Semester $session - $session_se $tframeS";											
					echo $erroMsg.$msg_e.$msgEnd;
					echo "<script type='text/javascript'> 
								$script_scroll_cm
						</script>"; exit;  

				}	
	
				$a = 1; $b = 2; $c = 3; $e = 4; $f = 0;
				
				$minCourseArray = levelminCourseArray($conn); /* retrieve student level minimum course array */
				$examArray = schoolExamConfigArrays($conn);  /* school exam configuration array  */
				$exam_status = $examArray[0]['status'];	
				$fiAssScore = $examArray[0]['fi_ass'];	
				$seAssScore = $examArray[0]['se_ass'];	
				$thAssScore = $examArray[0]['th_ass'];
				$foAssScore = $examArray[0]['fo_ass'];
				$fifAssScore = $examArray[0]['fif_ass'];
				$sixAssScore = $examArray[0]['six_ass'];	
				$exam_score = $examArray[0]['exam'];
				
				$courseCountLimit = $minCourseArray[$level]['minCourse']; //$courseCountLimit = 9;
				
			}catch(PDOException $e) {

				fobrainDie( 'Ooops Database Error: ' . $e->getMessage());

			}	
				
			if($uMode == $seVal){ goto fobrainSaveRS; }  /* save information */

			$picturePath = $rsUploadsPath; /* picture path */
			
			$filePic = "uploadPic"; /* picture file name */
			$pageDesc = "Excel upload";
			
			/* call igweze file uploader */
			$uploadPicData = igwezeFileUploader($filePic, $picturePath, ($oneMB * 10), $validExcelExt, $validExcelType, 
			$allowedExcelExt, $fileType = "Excel", $seVal); 
			 
			if (is_array($uploadPicData['error'])) {  /* check if any upload error */
				 
				$msg_e = '';
				  
				foreach ($uploadPicData['error'] as $msg) {
					$msg_e .= $msg.'<br />';     /* display error messages */
				}
				
				echo $erroMsg.$msg_e.$msgEnd;
				echo "<script type='text/javascript'> 
							$script_scroll_cm 
					</script>"; exit;
			  
			  
			} else {
				
				$uploadedPic = $uploadPicData['refilename']; /* uploaded picture file */
				
				if ($uploadedPic != "") {
					
					$uploadedFile = $rsUploadsPath.$uploadedPic;
						
					if (move_uploaded_file($_FILES[$filePic]['tmp_name'], $picturePath.$uploadedPic )) { /* move uploaded file to its path */									
							
						try { 

							$uploadData = $term.'::$::'.$level.'::$::'.$class.'::$::'.$sessionID.'::$::'.$uploadedPic;
							
							fobrainSaveRS:  /* save information */		
							
							if($uMode == $seVal){   /* save information */ 
						
								list ($term, $level, $class, $sessionID, $uploadedPic) = explode ("::$::", $uData);										
								$uploadedFile = $rsUploadsPath.$uploadedPic;
								$showSaveBtn = "";
								
							}else{
								
								$showSaveBtn = ' 
									
									<div class="col-12 text-end mt-20 mb-10 display-none save-excel-btn">
										<input name="upload-qy-data" value="qy" type="hidden"  />									
										<button type="submit" class="btn btn-danger waves-effect demo-disenable 
											btn-label waves-light save-bulk-rs-excel" id="'.$uploadData.'">
											<i class="bx bx-save label-icon"></i>  Save Results								
										</button>                                                    
									</div>';
							}	
						 
							echo ' 		
							<!-- row -->
							<div class="row gutters my-10 excel-scroll-to">
								<div class="col-12">	
									<!-- card start -->
									<div class="card card-shadow">
										<div class="card-header-wiz">
											<h4>
												<i class="mdi mdi-auto-upload fs-18"></i> 
												Bulk (Excel) Result Manager
											</h4>
										</div> 
										<div id="msg-box"></div> 					
										<div class="card-body">  

											<div class="row gutters mb-25 mt-10">
												<div class="hints">
													[<i class="mdi mdi-help-circle-outline"></i>] 
													Kindly cross results before saving them
												</div>
											</div>';	
											 
							 
							require_once $fobrainClassConfigDir;   /* include class configuration script */ 
					
							$course_codes = $course_info_mark;
							$course_codes_r = $course_info_mark;
									
							
							$inc = 0;
                            $inc_2 = 0; 
							$scoreInt = 0; 
                            $cols_start_3 = 3;
                            $cols_start_2 = 2;  
						 
							$courseArr  = array();  //'regnum';
							$courseToArr  = array(); //'regnum';
							$rsArray  = array(); 
							$rsSumArr  = array(); 
									
							for ($b = $start_nkiru; $b <= $stop_njideka; $b++) {  /* loop array */
									
								$courseArr[] = $course_info_mark[$b][0]; //course raw codes
								$courseCodeArr[] = $course_info_mark[$b][1]; //course outer codes
								$courseToArr[] = $course_info_mark[$b][3]; //course total													
									
							} 
							
							$colCount = $stop_njideka + 3;
							
							if(!file_exists($uploadedFile)){  /* check uploaded file exits */
								
								
								$msg_e .= "*Ooops error, could not locate uploaded excel file."; 
								echo $erroMsg.$msg_e.$msgEnd;
								echo "<script type='text/javascript'> 
											$script_scroll_cm 
									</script>"; exit;
								
							}  

                            $inputFileType = 'Xlsx';
                            $inputFileName = $uploadedFile;

                            $reader = IOFactory::createReader($inputFileType);
                            $spreadsheet = $reader->load($inputFileName);
                            $worksheet = $spreadsheet->getActiveSheet(); 
                            $dataArray = $worksheet->toArray();  

                            $html="<div class='table-responsive'>
										<table   class='table table-hover table-responsive table-sm 
										table-small mt-10'>
											<thead>";  
                         
							foreach ($dataArray as $row) { 
                                $cols_count = count($row);
							}	

							$cols_count_cols = ($cols_count - 1); 
							$data_arr_count = count($dataArray);   
							 
							$kkk = 0; $ki = 0; $ksum = 0; $sn = 1;

							for($k = 0; $k <= $data_arr_count; $k++) {  
								 
								if($k == 3){

									$html.="<tr>
												<th>SN</td>"; 

									for($kk = 0; $kk <= $cols_count; $kk++) {  
										
										$html.="<th>";
										$html.=$dataArray[$k][$kk]; 
										$html.="</th>";  
										
										if($kk >  1){ 

											$course_head =  $dataArray[$k][$kk];	 
                                            
                                            if ( trim($course_head) != trim($courseCodeArr[$ki])){  /* cross check excel header */
                                                
                                                 
                                                $subDB = $courseCodeArr[$ki];
                                                $rColInt = ($ki + $foVal);
                                                $excelColHead = $alphabetArr[$rColInt]; 
                                                $msg_e = "Ooops Error, Subject Code <strong>$subDB (Row $k)</strong> 
                                                in database does not correspond with Subjects Code <strong>$course_head
                                                (Column $excelColHead)</strong> in uploaded 
                                                Excel file.
                                                Please cross check the excel file and re-upload again.";
                                                unlink($uploadedFile);
                                                echo $erroMsg.$msg_e.$msgEnd;
												echo "<script type='text/javascript'> 
														$script_scroll_cm
													</script>"; exit;
                                            
                                            }

											$ki++;

                                        }    
										
									} 

									$html.="</tr>";	  

								}


								if(($k > 3) && ($k < $data_arr_count)){

									$html.="<tr>
												<th>$sn</td>";  
									
									$ksum = 0; 

									for($kk = 0; $kk <= $cols_count_cols; $kk++) { 
										
										$html.="<td>";
										$html.=$dataArray[$k][$kk]; 
										$html.="</td>";   

										$course_data =  $dataArray[$k][$kk];

										$regNum = $dataArray[$k][1];

										$row_no_k  = $kk + 1;
										$row_no  = $k + 1;

										if($course_data == ''){  /* check if excel row is empty */
                                                
											$excelCol = $alphabetArr[$row_no_k]; 
											
											$msg_e .= "*Ooops error, row no. <strong>$row_no</strong> 
											and column <strong>$excelCol</strong> is empty in 
											uploaded file. Please input correct data or  dashed
											'-' where cell is empty. "; 
											unlink($uploadedFile);
											echo $erroMsg.$msg_e.$msgEnd;
											echo "<script type='text/javascript'> 
													$script_scroll_cm 
												</script>"; exit;
											$is_clean = false;
											
										}

										if($kk > 1){

											$rScoreInt = ($scoreInt + $foVal); 
											$excelScoreCol = $alphabetArr[$rScoreInt]; 
											//$row_no  = $k + 1;

											require 'excel/validate_data_comp.php';
											$ksum++;

										}   
										
										
									}  

									$html.="</tr>";	

									$rsSumaryArr[$kkk]  = $rsSumArr;
									$rsArray[$kkk]  = $dataArray[$k];  

									$kkk++;
									$sn++;

								}  

							}	  

                            $html.="</tbody></table></div>
							
									<script type='text/javascript'> 
																									
										$('#upload-qy-data').text('".$uploadData."');											
										//hidePageLoader();  /* hide page loader */	 
										
									</script>";     
							 
							require 'excel/bulk-comp-wizard.php'; 

                            if($uMode == $fiVal){  /* if sucessfully excel upload validation */   
								
								$msg_s =  "Excel upload AI result error cross-checking and preview was successful. Please cross-check and save the bulk upload.";
								echo $succMsg.$msg_s.$msgEnd;
								echo $showSaveBtn.$html;
								echo "<script type='text/javascript'> 
									$('html, body').animate({scrollTop:$('.page-content').position().top}, 'slow');		
									$('.save-excel-btn').fadeIn(200);
								</script>";
								
							}else{  /* if sucessfully */  
								
								echo '<br />';																  
								$msg_s =  "Class Excel Bulk Result was successfully saved.";
								unlink($uploadedFile);
								echo $succMsg.$msg_s.$msgEnd;
								echo "<div class='mb-50'></div>";
								echo $html;
								echo "<script type='text/javascript'> 
											$script_scroll_cm
											//$('.show-rsconfig-div').fadeIn(1000);
										</script>"; 
								$overlay_style = "wiz-overlay-content_2";
								require_once ($fobrainFormTeacherDir.'rs-config-wrapper.php');	 
																						
							} 
							
							echo '
							
											</div>
										</div>
										<!-- card end -->	
									</div>
								</div>
								<!-- / row --> '; 
 
							echo "<div id='overlay-rs-box'></div>";	

							echo "<script type='text/javascript'> 
																									
										$('.fob-btn-loader').fadeOut(2000); 
										$('.fob-btn-div').fadeIn(4000);	 
										
									</script>";
							 
							exit;	  

						}catch(PDOException $e) {

							fobrainDie( 'Ooops Database Error: ' . $e->getMessage());

						}
						  
						  
					}else{ /* display error messages */ 
						
						$msg_e = "Ooops, an error has occur while trying to save $pageDesc.
						Please try again or check your network connection!!!";
						echo $erroMsg.$msg_e.$msgEnd;
						echo "<script type='text/javascript'> 
									$script_scroll_cm 
							</script>"; exit; 
						  
					}
						
				}else{ /* display error messages */ 
					
					$msg_e = "Ooops, an error has occur while trying to save $pageDesc.
					Please try again or check your network connection!!!";
					echo $erroMsg.$msg_e.$msgEnd;
					echo "<script type='text/javascript'> 
								$script_scroll_cm
						</script>"; exit;							

				}	
				
				
			}
				
		}else{
				
			echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
				
		}


exit;
?>