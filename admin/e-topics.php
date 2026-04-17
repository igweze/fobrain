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
	This script handle student course topics
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}
 
		define('fobrain', 'igweze');  /* define a check for wrong access of file */

		require 'fobrain-config.php';  /* load fobrain configuration files */
			
		if ($_REQUEST['query'] == 'update') {  /* save course topic */ 
				
			$tid = cleanInt($_REQUEST['tid']);			
			$cid = cleanInt($_REQUEST['cid']);
			$topic = clean($_REQUEST['title']);  

			$script_scroll_cm = "
					//$('#qPicture').val('');
					hidePageLoader();
					$('.fob-btn-loader').hide(4000);
					$('.fob-btn-div').show(5000); ";
			
			/* script validation */ 
			
			if ($tid == ""){

				$msg_e = "* Ooops, an error has occur to retrieve Course Chapter information. Please try again";
				echo $erroMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> 
					$script_scroll_cm  
				</script>"; exit;
				
			}elseif ($cid == "")  {

				$msg_e = "* Ooops Error, please select an Course to add Course Chapter";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> 
					$script_scroll_cm  
				</script>"; exit;
				
			}elseif ($topic == "")  {
				
				$msg_e = "* Ooops Error, please enter your Course Chapter";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> 
					$script_scroll_cm  
				</script>"; exit;
				
			}else {  /* insert/update information */   	  
	 

					
				try{
					
					if($tid >= $fiVal){
					
						$ebele_mark = "UPDATE $fobrainCourseTopicTB  
											
											SET 
											
											cid = :cid, 
											topic = :topic
											
										WHERE tid = :tid";
						
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':tid', $tid);
						$igweze_prep->bindValue(':cid', $cid);
						$igweze_prep->bindValue(':topic', $topic);
						
					}else{

						$ebele_mark = "INSERT INTO $fobrainCourseTopicTB  (cid, topic)

								VALUES (:cid, :topic)";
						
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':cid', $cid);
						$igweze_prep->bindValue(':topic', $topic);


					}

					if($igweze_prep->execute()){  /* if sucessfully */
						
						$msg_s = "Course Chapter was successfully saved."; 
						echo $succesMsg.$msg_s.$sEnd; 
						echo "<script type='text/javascript'> 
							$('#courseQuesDiv').load('e-topics-info.php?cid=".$cid."'); 
							$('#modal-fobrain').modal('hide');
							hidePageLoader(); 
						</script>";exit;
						
					}else{  /* display error */ 
			
						$msg_e =  "Ooops, an error has occur while to save Course Chapter. Please try again";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'> 
							$script_scroll_cm  
						</script>"; exit;
						
					}						

				}catch(PDOException $e) {
	
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				}	 
		
			}
		
		}elseif ($_REQUEST['query'] == 'remove') {  /* remove course topic */ 

			$topic = $_REQUEST['rData'];
			
			list($fobrainIg, $tid, $hName) = explode("-", $topic);			
			
			/* script validation */ 
			
			if (($topic == "")  || ($tid == "")){
				
				$msg_e = "* Ooops, an error has occur while to remove Course Chapter information. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
				
			}else {   

				try { 
					
					$ebele_mark = "DELETE FROM 
					
									$fobrainCourseTopicTB										
										
									WHERE tid = :tid
										
									LIMIT 1";
					
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':tid', $tid); 
					
					if($igweze_prep->execute()){  /* if sucessfully */ 
						
						$removeDiv = "$('#row-".$tid."').fadeOut(1000);";
						$msg_s = "<strong>$hName</strong> was successfully removed"; 
						echo $succesMsg.$msg_s.$sEnd; 
						echo "<script type='text/javascript'>   
						hidePageLoader(); $('.slideUpFrmDiv').fadeOut(3000); $removeDiv  </script>";exit;
						
					}else{  /* display error */ 
			
						$msg_e =  "Ooops, an error has occur while to remove Course Chapter information. Please try again";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
						
					}
					

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				} 
		
			}
		
		}elseif ($_REQUEST['query'] == 'view') {  /* view course topic */ 
			
			$tid = strip_tags($_REQUEST['rData']);
			
			/* script validation */
			
			if ($tid == ""){
				
				$msg_e = "* Ooops, an error has occur while to retrieve Course Chapter information. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}else {  /* select information */       			


				try {
					
		
					$topicInfoArr = topicInfo($conn, $tid);  /* online course topic information */
					//$tid = $topicInfoArr[$fiVal]["tid"];
					$cid = $topicInfoArr[$fiVal]["cid"];
					$topic = htmlspecialchars_decode($topicInfoArr[$fiVal]["topic"]);
					 
					
					$eQPic = $fobrainTopicDir.$qPicture;
					
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
									Course Chapter 
								</th> 
								<td>
									$topic
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
		
		}elseif ($_REQUEST['query'] == 'edit') {  /* edit course topic */

			$tid = cleanInt($_REQUEST['topicID']);
			$cid = cleanInt($_REQUEST['courscid']);
			 
			/* script validation */ 
			
			if ($cid == ""){
				
				$msg_e = "* Ooops, an error has occur while to retrieve Course Chapter information. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}else {       			


				try {
					
					if($tid >= $fiVal){  /* check if topic ID is true */
						
						$topicInfoArr = topicInfo($conn, $tid);  /* online course topic information */
						//$tid = $topicInfoArr[$fiVal]["tid"];
						$cid = $topicInfoArr[$fiVal]["cid"];
						$topic = $topicInfoArr[$fiVal]["topic"];
							
						//$eQPic = picture($fobrainTopicDir, $qPicture, "course");
						
					}else{
						
						$tid = $i_false; 
						//$eQPic = $wiz_df_file_img;
						$topic = "";  
					
					}	 
					
?>

					<!-- form -->
					<form method="POST" class="form-horizontal" id="frmupdateTopic" role="form" enctype="multipart/form-data">
							
						<!-- row -->
						<div class="row gutters">
							<div class="col-12">										
								<!-- field wrapper start -->
								<div class="field-wrapper">

									<input type="text" class="form-control required capWords" value ="<?php echo $topic; ?>" 
										name="title" id="title" /> 
									<div class="field-placeholder"> Chapter Title <span class="text-danger">*</span></div>
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
								<input type="hidden" name="tid" value="<?php echo $tid; ?>" />
								<input type="hidden" name="cid" value="<?php echo $cid; ?>" />
								 
								<button type="submit" class="btn btn-primary waves-effect   
								btn-label waves-light fob-btn-div" id="updateTopic">
									<i class="mdi mdi-content-save label-icon"></i>  Save
								</button>
							</div>

							<div class="display-none fob-btn-loader">
								<strong role="status">Processing...</strong>
								<div class="spinner-border ms-auto" aria-hidden="true"></div>
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