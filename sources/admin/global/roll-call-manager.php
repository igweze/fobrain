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

if(!session_id()){
    session_start();
}

		if (!defined('fobrain'))

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');	   
	 
		if (($_REQUEST['roll']) == 'load') {  /* load student rollcall */	  
			
			/* script validation */ 
			if ( (($_REQUEST['sess']) != "") && (($_REQUEST['level']) != "") && (($_REQUEST['class']) != ""))  {

				$session = $_REQUEST['sess'];
				$level = $_REQUEST['level'];
				$class_data = $_REQUEST['class'];

				$roll_date = date("Y-m-d");
				$calendarDate = date("l, F d, Y");

				if(($admin_grade == $cm_fobrain_grd) && ($admin_level == $cm_fob_tagged)){ /* check if user is school staff */
					 
					$save_rcall = true;

				}else{ 
					 
					$save_rcall = false;
					echo "<script type='text/javascript'> $('.roll_component').hide(100); </script>";

				}  
				
				list ($class, $class_val) = explode ("@+@", $class_data);

				$term = $fiVal;
				
				require  $fobrainClassConfigDir;   /* include class configuration script */

				try { 
					
					$levelArray = studentLevelsArray($conn); /* student level array */		
					
					array_unshift($levelArray,"");
					unset($levelArray[0]);
						
				}catch(PDOException $e) {
				
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
					
				}
				
				$class_level = $levelArray[$level]['level']; 
				 

$roll_data =<<<IGWEZE

			<input type="hidden" value="$session" name="sess" id="rc-sess" />
			<input type="hidden" value="$level" name="level" id="rc-level" />
			<input type="hidden" value="$class" name="class" id="rc-class" /> 
			 
IGWEZE;                            
								
		 
				
				$page_title = "<i class='mdi mdi-format-list-checks fs-18'></i> 
								$class_level ($class_val) | <span id='calender_date'>$calendarDate</span>";
				$title_1 = pageTitle2($page_title, 0); 
		 
	
$div_head =<<<IGWEZE
			

			<!-- row -->
			<div class="row gutters justify-content-center">
				<div class="col-12">	
					<!-- card start -->
					<div class="card card-shadow">
						$title_1
						<div id="msg-box"></div> 					
						<div class="card-body" id="roll_call_div"> 

						$roll_data
						
						<!-- form -->
						<form class="form-horizontal" id="frmsave-roll-call" role="form">
					
			
IGWEZE;

						echo $div_head; 
						
						echo '
						<!-- row -->
						<div class="row gutters  justify-content-centers">
							<div class="col-lg-3">										
								<!-- field wrapper start -->
								<div class="field-wrapper">
										<input type="date" value="'.$roll_date.'" name ="roll_date" id ="roll-date">
									<div class="field-placeholder"> Date <span class="text-danger">*</span></div>
								</div>
								<!-- field wrapper end -->
							</div>
							<div class="col-lg-3 roll_component">										
								<!-- field wrapper start -->
								<div class="field-wrapper">
									<select class="form-control fob-select"  id="rollTask" name="rollTask">

										<option value = "1">Select an action for all</option>'; 
						
										foreach($attendance_list as $attend_key => $attend_value){  /* loop array */
	
											echo '<option value="'.$attend_key.'"'.$selected.'>'.$attend_value.'</option>' ."\r\n";
	
										}		 
												
						echo '            
									</select>

									<div class="field-placeholder"> Select an Action <span class="text-danger">*</span></div>
								</div>
								<!-- field wrapper end -->
							</div>		
							<div class="col-lg-3 text-end roll_component">		
								<!-- field wrapper start -->
								<div class="field-wrapper">								
									<button type="button" class="btn btn-dark waves-effect   
									btn-label waves-light load-qr-rollcall">
										<i class="mdi mdi-qrcode label-icon"></i> QR Attendance
									</button>
								</div>
								<!-- field wrapper end -->
							</div>
							<div class="col-lg-3 text-end roll_component">		
								<!-- field wrapper start -->
								<div class="field-wrapper">								
									<button type="submit" class="btn btn-primary waves-effect   
									btn-label waves-light save-roll-call">
										<i class="mdi mdi-content-save label-icon"></i>  Save
									</button>
								</div>
								<!-- field wrapper end -->
							</div>							 
						</div>	
						<!-- /row -->
						
						<!-- row -->
						<div class="row gutters">
							<div class="col-lg-12" id="roll-call-wrap">';
		
								require_once 'roll-call-info.php'; 

							echo '
								</div>
							</div>							 
						</div>	
						<!-- /row -->

									
						<!-- row -->
						<div class="row gutters mt-30 pull-left roll_component">
							<div class="col-12 text-end"> 
								<input type="hidden" name="roll" value="save" />
								<button type="submit" class="btn btn-primary waves-effect   
								btn-label waves-light save-roll-call">
									<i class="mdi mdi-content-save label-icon"></i>  Save
								</button>
							</div>
						</div>	
						<!-- /row -->	
							
						</form>							
						<!-- form -->'; 
					
								 
	
?>
							</div>
						</div>
					</div>
					<!-- card end -->	
				</div>
			</div>
			<!-- / row --> 
			
<?php 			
						
			}else {  /* display error */  

				$msg_e =  $formErrorMsg;
				echo $errorMsg.$msg_e.$eEnd; //exit; 

			}
					
			echo "<script type='text/javascript'> 
				
					//$('.fob-select').each(function() {  
						//renderSelect($('#'+this.id)); 
					//}); 
			
			hidePageLoader(); </script>"; 
			
		}elseif (($_REQUEST['roll']) == 'view') {  /* load student roll call */	  
			
			/* script validation */ 
			if ( (($_REQUEST['sess']) != "") && (($_REQUEST['level']) != "") && (($_REQUEST['class']) != "")
				&& (($_REQUEST['rdate']) != "")	)  {

				$session = $_REQUEST['sess'];
				$level = $_REQUEST['level'];
				$class = $_REQUEST['class'];
				$roll_date = $_REQUEST['rdate'];   
				$calendarDate = date("l, F d, Y", strtotime($roll_date)); 
				$today = date("Y-m-d");
				$success_insert = false;

				if(($admin_grade == $cm_fobrain_grd) && ($admin_level == $cm_fob_tagged)){ /* check if user is school staff */
					 
					if($today == $roll_date){
						$save_rcall = true;
						echo "<script type='text/javascript'> $('.roll_component').show(100); </script>";
					}else{
						$save_rcall = false;
						echo "<script type='text/javascript'> $('.roll_component').hide(100); </script>";
					} 

				}else{ 
					 
					$save_rcall = false;
					echo "<script type='text/javascript'> $('.roll_component').hide(100); </script>";

				}  
				
				//list ($class, $class_val) = explode ("@+@", $class_data);

				$term = $fiVal;
				
				require  $fobrainClassConfigDir;   /* include class configuration script */

				require_once 'roll-call-info.php';

				 
            }else {  /* display error */  

                $msg_e =  "Ooops, could not retreive roll call information";
                echo $errorMsg.$msg_e.$eEnd; //exit; 

            }
                
            echo "<script type='text/javascript'> 
              	 	$('#calender_date').html('$calendarDate');
            		hidePageLoader(); 
				</script>"; 

        }elseif (($_REQUEST['roll']) == 'save') {  /* save student rollcall */

			$regIDArr = $_REQUEST['regID'];
			$regNoArr = $_REQUEST['regNo'];
			$rollCallArr = $_REQUEST['rollCall'];
			$remarksArr = $_REQUEST['remarks'];
			$start = $_REQUEST['roll_date'];
			$student_nameArr = $_REQUEST['studentName'];
			
			$end = $start;
			
			/* script validation */
			
			if($start == ""){
				
				$msg_e = "Ooops  Error, please select roll call date";
				echo "<script type='text/javascript'>  hidePageLoader();</script>";
				echo $errorMsg.$msg_e.$eEnd; echo $scroll_up; exit; 		
				
			}else{	
				
			
				foreach ($regIDArr as $id => $val) {  /* loop array */
					
					$rollCallArray [$id] = array(
						'regID'  => $regIDArr[$id],
						'regNo'  => $regNoArr[$id],
						'Name'  => $student_nameArr[$id],
						'rollCall' => $rollCallArr[$id],
						'remarks'    => $remarksArr[$id],
					); 
					
					$regID  = $regIDArr[$id];
					$regNo  = $regNoArr[$id];
					$rollCall = $rollCallArr[$id];
					$student_name = $student_nameArr[$id];
					$remarks = clean($remarksArr[$id]);
					$remarks = preg_replace("/[^A-Za-z0-9'%.? ]/", "", $remarks);
					$remarks = htmlspecialchars($remarks);				
				
					$title = wizSelectArray($rollCall, $attendance_list);

					try { 

						$ebele_mark = "SELECT id
						
										FROM $daily_comments_tb
						
										WHERE ireg_id = :ireg_id
										
										AND start = :start
										
										AND end = :end";
								
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':ireg_id', $regID);
						$igweze_prep->bindValue(':start', $start);
						$igweze_prep->bindValue(':end', $end);	 
						$igweze_prep->execute();
						
						$rows_count = $igweze_prep->rowCount(); 
						
						if($rows_count == $foreal) {  /* check array is empty */
							
							while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {  /* loop array */		
	
								$id = $row['id'];
								
							}

							$ebele_mark_1 = "UPDATE $daily_comments_tb 
						
										SET 
										
										attendance = :attendance,
										title = :title,
										comments = :comments

										WHERE id = :id";
					
							$igweze_prep_1 = $conn->prepare($ebele_mark_1);
							$igweze_prep_1->bindValue(':attendance', $rollCall);
							$igweze_prep_1->bindValue(':title', $title);
							$igweze_prep_1->bindValue(':comments', $remarks);
							$igweze_prep_1->bindValue(':id', $id);
						
						}else{	
					
							$ebele_mark_1 = "INSERT INTO $daily_comments_tb 
											(ireg_id, start, end, title, attendance, comments)

											VALUES (:ireg_id, :start, :end, :title, :attendance, :comments)";
						
							$igweze_prep_1 = $conn->prepare($ebele_mark_1);
							$igweze_prep_1->bindValue(':ireg_id', $regID);
							$igweze_prep_1->bindValue(':start', $start);
							$igweze_prep_1->bindValue(':end', $end);
							$igweze_prep_1->bindValue(':title', $title);
							$igweze_prep_1->bindValue(':attendance', $rollCall);
							$igweze_prep_1->bindValue(':comments', $remarks); 
							
						}	
	
						if ($igweze_prep_1->execute()) {  /* if sucessfully */ 
							
							$success_insert = true;
					
						}else {  /* display error */ 

							$msg_e = "<span>Ooops, an error occured while tring to save <strong>$student_name</strong> roll call.  Please try again</span>";
							echo $errorMsg.$msg_e.$eEnd;		
							$success_insert = false;

						} 

					}catch(PDOException $e) {
			
						fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
				
					} 
					
					$regID  = "";
					$regNo  = "";
					$rollCall = "";
					$remarks = "";
				}
				
			} 
			
			$msg_s = "Student Roll Call was successfully saved.";
			echo $succesMsg.$msg_s.$sEnd; 
			echo "<script type='text/javascript'>  hidePageLoader(); //$('#roll_call_div').slideUp(2000); </script>";
			
		}elseif (($_REQUEST['roll']) == 'widget') {  /* load student roll call */	  
			
			/* script validation */ 
			if (($_REQUEST['rdate']) != "")	 { 
				 
				$roll_date = $_REQUEST['rdate'];  

				require_once 'roll-call-widget.php'; 
				 
            }else {  /* display error */  

                $msg_e =  "Ooops, could not retreive roll call information";
                echo $errorMsg.$msg_e.$eEnd;  

            }

			echo "<script type='text/javascript'> hidePageLoader(); </script>"; exit; 

        }elseif (($_REQUEST['roll']) == 'qr-code') {  /* take qr attendance */	  
			

$qr_form =<<<IGWEZE
 
			<div class="msg-box"></div> 
			<!-- form -->
			<form method="POST" class="form-horizontal mb-50" 
			id="frm-qr-attendance" >
				<!-- row -->
				<div class="row gutters justify-content-center">   
					<div class="col-lg-7 mt-15">
						<div id="fobrain-camera"></div> 
						<input type="hidden" name="roll" value="qr-rcall" id="qr-rcall">
						<input type="hidden" name="cam_image" class="image-tag">									
						<button type="button" class="btn btn-danger mt-25 take-shot-btn"  
						onClick="take_snapshot()"> 
							<span class="button-text">
								<i class="mdi mdi-qrcode-scan label-icon"></i>  
								Mark Attendance 
							</span>									 
							<span class="spinner-text" style="display: none;">Processing...</span>
							<span class="spinner-border ms-auto spinner-icon" aria-hidden="true" 
							style="display: none;"></span> 
						</button>                                     
					</div>
				</div>
				<!-- / row -->
			<form>
			<!-- / form -->   

			<div class="row gutters mt-15">
				<div class="hints">[<i class="mdi mdi-help-circle-outline"></i>] 
					To automatically record student attendance, please 
					focus on scanning only the <strong>QR code</strong> section located on the <strong>student ID card</strong> . 
					This ensures an accurate and efficient attendance-taking process.
				</div>
			</div>
			
					
IGWEZE;     
			
			echo $qr_form;

		?>


			<!-- fobrain js  -->
        	<script type="text/javascript" src="<?php echo $fobrainTemplate; ?>jx/webcam.min.js"></script> 

			<script type="text/javascript">

				Webcam.set({
					width: 350,
					height: 300,
					image_format: 'jpeg',
					jpeg_quality: 100
				}); 

				Webcam.attach( '#fobrain-camera' );

				function take_snapshot() { 

					// Show spinner and disable button
					$('.button-text').hide();
					$('.spinner-icon').show();
					$('.spinner-text').show();
					$('.take-shot-btn').prop('disabled', true); 
 
					Webcam.snap( function(data_uri) {
						$(".image-tag").val(data_uri);						
					} ); 
				 
					var form_data = new FormData($('#frm-qr-attendance')[0]); 
			 
					$.ajax({
						url: 'roll-call-qr.php',
						dataType: 'text',
						cache: false,
						contentType: false,
						processData: false,
						data: form_data,
						type: 'post',
						success: function (response) {
							$('.msg-box').html(response); 
							setTimeout(function() {  
								$('.spinner-text').hide();
								$('.spinner-icon').hide();
								$('.button-text').show();
								$('.take-shot-btn').prop('disabled', false);
							}, 2000); 
						},
						error: function (response) {
							$('.msg-box').html(response);
							setTimeout(function() {  
								$('.spinner-text').hide();
								$('.spinner-icon').hide();
								$('.button-text').show();
								$('.take-shot-btn').prop('disabled', false);
							}, 2000); 
						}
					});  
					
					return false; 

				}

				hidePageLoader();

			</script> 
		 
		<?php	

        }else{ 		
				
			echo $userNavPageError; exit;  /* else exit or redirect to 404 page */		
	
		}  
exit;
?>