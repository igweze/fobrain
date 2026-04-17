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
 
			$session = cleanInt($_REQUEST['sess']);
			$level = cleanInt($_REQUEST['level']);
			$term = cleanInt($_REQUEST['eTerm']);
			$class = clean($_REQUEST['class']);
			$eTitle =  clean($_REQUEST['eTitle']);
			$eSubject = clean($_REQUEST['eSubject']);
			$eTime = cleanInt($_REQUEST['eTime']);
			$qtype = clean($_REQUEST['qtype']);
			$status = cleanInt($_REQUEST['status']);

			$uMode = $_REQUEST['uMode'];
			$uData = $_REQUEST['uploadData']; 	
            $regDate = date("Y-m-d H:i:s");   

			//list ($class, $class_val) = explode ("@+@", $class_data); 

			$script_scroll_cm = "
							$('#bulk-excel-exam').val('');
							$('.fob-btn-loader').fadeOut(2000); 
							$('.fob-btn-div').fadeIn(4000); 
							hidePageLoader();
							$('html, body').animate({scrollTop:$('.page-content').position().top}, 'slow');";

			if($uMode == $fiVal){  
 
				if ($session == "")  {
         			
					$msg_e = "* Ooops Error, please select target exam class";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'> 
							$script_scroll_cm  
						</script>"; exit;
					
	   			}elseif ($level == "")  {
         			
					$msg_e = "* Ooops Error, please enter target exam level";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'> 
							$script_scroll_cm  
						</script>"; exit;
					
	   			}elseif ($class == "")  {
         			
					$msg_e = "* Ooops Error, please select target exam class";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'> 
							$script_scroll_cm  
						</script>"; exit;
					
	   			}elseif ($term == "")  {
         			
					$msg_e = "* Ooops Error, please select target exam term";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'> 
							$script_scroll_cm  
						</script>"; exit;
					
	   			}elseif ($eTitle == "")  {
         			
					$msg_e = "* Ooops Error, please enter exam title";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'> 
							$script_scroll_cm  
						</script>"; exit;
					
	   			}elseif ($eSubject == "")  {
         			
					$msg_e = "* Ooops Error, please select exam subject";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'> 
							$script_scroll_cm  
						</script>"; exit;
					
	   			}elseif ($eTime == "")  {
         			
					$msg_e = "* Ooops Error, please enter exam duration";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'> 
							$script_scroll_cm  
						</script>"; exit;
					
	   			}else{

				}
				
			}
			
			try {
			
				$sessionID = sessionID($conn, $session);  /* school session ID */  
	
				$a = 1; $b = 2; $c = 3; $e = 4; $f = 0; 
				
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

							$uploadData = $term.'::$::'.$level.'::$::'.$class.'::$::'.$sessionID.'::$::'.$session.'::$::'.$uploadedPic.'::$::'.$eTitle.'::$::'.$eSubject.'::$::'.$eTime.'::$::'.$status.'::$::'.$qtype;
							//$uploadData = $term.'::$::'.$level.'::$::'.$class.'::$::'.$sessionID.'::$::'.$session.'::$::'.$eTitle.'::$::'.$eSubject.'::$::'.$eTime.'::$::'.$status.'::$::'.$qtype.'::$::'.$uploadedPic;
							fobrainSaveRS:  /* save information */		
							
							if($uMode == $seVal){   /* save information */ 
								
								list ($term, $level, $class, $sessionID, $session, $uploadedPic, $eTitle, $eSubject, $eTime, $status, $qtype) = explode ("::$::", $uData);										
								$uploadedFile = $rsUploadsPath.$uploadedPic;
								$showSaveBtn = "";

                                $en_level = $level;
                                $en_term =  $term;
								
							}else{
								 
								$showSaveBtn = ' 
									
									<div class="col-12 text-end mt-20 mb-10 display-none save-excel-btn">
										<input name="upload-qy-data" value="qy" type="hidden"  />									
										<button type="submit" class="btn btn-danger waves-effect demo-disenable 
											btn-label waves-light save-bulk-exam" id="'.$uploadData.'">
											<i class="bx bx-save label-icon"></i>  Save Questions							
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
												Bulk (Excel) Questions Manager
											</h4>
										</div> 
										<div id="msg-box"></div> 					
										<div class="card-body">  

											<div class="row gutters mb-25 mt-10">
												<div class="hints">
													[<i class="mdi mdi-help-circle-outline"></i>] 
													Kindly cross questions and ans before saving them
												</div>
											</div>';	 
							 
							 			
							
							$inc = 0;
                            $inc_2 = 0; 
							$scoreInt = 0; 
                            $cols_start_3 = 3;
                            $cols_start_2 = 2;   
							 
							$questionArr  = array();   
							
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
							
							$cols_count_limit = 7;
							 
							$kkk = 0; $sn = 1;

							for($k = 0; $k <= $data_arr_count; $k++) {  
								 
								if($k == 1){

									$html.="<tr>
												<th>SN</td>"; 

									for($kk = 0; $kk <= $cols_count_limit; $kk++) {  
										
										$html.="<th>";
										$html.=$dataArray[$k][$kk]; 
										$html.="</th>";  
										   
										
									} 

									$html.="</tr>";	  

								} 

								if(($k > 1) && ($k < $data_arr_count)){

									$html.="<tr>
												<th>$sn</td>";  
									
									$ksum = 0; 

									for($kk = 0; $kk <= $cols_count_limit; $kk++) { 
										
										$html.="<td>";
										$html.=$dataArray[$k][$kk]; 
										$html.="</td>";   

										$course_data =  $dataArray[$k][$kk]; 

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
                                         
										
									}  

									$html.="</tr>";	

									 
									$questionArr[$kkk]  = $dataArray[$k];  
									$kkk++;
									$sn++;

								}  

							}	  

                            $html.="</tbody></table></div>
							
									<script type='text/javascript'> 
																									
										$('#upload-qy-data').text('".$uploadData."');											
										//hidePageLoader();  /* hide page loader */	 
										
									</script>";    	 
                           
							require 'excel/question-wizard.php'; 

                            if($uMode == $fiVal){  /* if sucessfully excel upload validation */
								
								$msg_s =  "Excel upload AI Profile error cross-checking and preview was successful. Please cross-check and save the bulk profiles.";
								echo $succMsg.$msg_s.$msgEnd;
								echo $showSaveBtn.$html;
								echo "<script type='text/javascript'> 
									$('html, body').animate({scrollTop:$('.page-content').position().top}, 'slow');		
									$('.save-excel-btn').fadeIn(200);
								</script>";
								
							}else{  /* if sucessfully */ 
								
								echo '<br />';																  
								$msg_s =  "Class Excel Bulk Profiles was successfully saved.";
								unlink($uploadedFile);
								echo $succMsg.$msg_s.$msgEnd;
								echo "<div class='mb-50'></div>";
								//echo $html;
								echo "<script type='text/javascript'> 
										$script_scroll_cm
									</script>"; 
								$overlay_style = "wiz-overlay-content_2";
								  
																						
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