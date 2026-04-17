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
	This script load  manual student result inputation
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

        define('fobrain', 'igweze');  /* define a check for wrong access of file */
						
		require 'fobrain-config.php';  /* load fobrain configuration files */	   
		
		if (($_REQUEST['result']) == 'load') {
			
			/* script validation */ 
			
			if ( (($_REQUEST['sess']) == "") || (($_REQUEST['level']) == "") || (($_REQUEST['class']) == "") 
																							
			|| (($_REQUEST['term']) == "") )  {

				$msg_e =  $formErrorMsg;
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>  hidePageLoader();	</script>"; exit;
				exit; 

			}else{	

				$session = $_REQUEST['sess'];
				$level = $_REQUEST['level']; 
				$term = $_REQUEST['term'];  
				$class_data = $_REQUEST['class'];

				list ($class, $class_val) = explode ("@+@", $class_data);

				try { 

					$levelArray = studentLevelsArray($conn); /* student level array */ 
					$sessionID = sessionID($conn, $session); /* school session ID  */
					$rsStatus = fobrainResultStatus($conn, $sessionID, $class, $level, $term);	 /* student result status */ 
						
				}catch(PDOException $e) {
					
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
					 
				}
 		  
						 
				
				if  ($rsStatus == $rspublishStage){	 /* check student result status */	 
						
					//$session_se = $session + $foreal;
					//$SessSem = schoolTerm($term);  /* school term  */
					
					//$msg_i = "$tframeF $SessSem Semester $session - $session_se $tframeS";

					$msg_i = "Ooops, this result has been published and can't be edited again."; 

					echo $infMsg.$msg_i.$msgEnd;
					echo "<script type='text/javascript'>  hidePageLoader();  document.body.setAttribute('data-sidebar-size', 'lg');	</script>"; exit;
					exit;
					
				}


				$page_title = '<i class="mdi mdi-account-tie fs-18"></i> 
								Student Information';
				$title_1 = pageTitle2($page_title, 0);  
		
	
		
$table_head =<<<IGWEZE


			<!-- row -->
			<div class="row gutters highRSDiv">
				<div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 mb-50">	
					<!-- card start -->
					<div class="card card-shadow">
						$title_1 
						<div id="msg-box"></div> 					
						<div class="card-body">
							<script type='text/javascript'>  renderTable(); </script>
							<div class="table-responsive">
								<!-- table -->
								<table class='table table-hover table-responsive  table-sm table-small'>					
									<thead>
										<tr>
											<th>SN</th>
											<th>Picture</th> 
											<th>
											Reg. No. 
											<hr class='text-danger my-5 py-0'  style="width:60%;">
											Name 
											</th> 
											<th>Status</th> <th>Tasks</th>  
										</tr>
									</thead> 
									
							 

IGWEZE;
				echo $table_head;		
		 
				try {
		 
		
					$sessionID = sessionID($conn, $session); /* school session ID  */
					$session_fi = fobrainSession($conn, $sessionID); /* school session */
					$mClass = studentClassLevel($level);  /* retrieve student class */
							 
					$session_se = $session_fi + $foreal;  

					$rs_check = "rs_".$level;
					
					$ebele_mark = "SELECT r.ireg_id, nk_regno, $rs_check, s.stu_id, i_stupic, i_firstname, i_lastname, i_midname
					
									FROM $i_reg_tb r INNER JOIN $i_student_tb s				
					
									ON (r.ireg_id = s.ireg_id)

									AND r.session_id = :session_id 
							 
									AND r.$mClass = :class

									AND r.active = :foreal";
						 
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':session_id', $sessionID, PDO::PARAM_STR);				
					$igweze_prep->bindValue(':foreal', $foreal, PDO::PARAM_STR);				
					$igweze_prep->bindValue(':class', $class, PDO::PARAM_STR);				 
					$igweze_prep->execute();
					
					$rows_count = $igweze_prep->rowCount(); 

					$serial_no = 0;
					$edit_rs_btn = "";
					$edit_com_btn = "";	
					$cond_rs_btn = "";

					if($rows_count >= $foreal) {  /* check array is empty */	 
					
						while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {  /* loop array */		
		   
							$regNum = $row['nk_regno'];
							$ID = $row['ireg_id'];
							$pic = $row['i_stupic'];
							$fname = $row['i_firstname'];
							$lname = $row['i_lastname'];
							$mname = $row['i_midname'];
							$rs_status = $row[$rs_check];

							if($mname != ""){
								$mname = substr($mname, 0, 1);
								$mname = "$mname".".";
							} 
							
							$edit_data = $regNum.'@@'.$session.'@@'.$level.'@@'.$class.'@@'.$term.'@@'.$i_false.'@@'.$rs_status;
							$conduct_data = $regNum.'@@'.$level.'@@'.$term.'@@'.$class.'@@'.$i_false; 
							 
							$student_img = picture($school_pic_dir.$session_fi.'_'.$session_se.'/', $pic, "student"); 

							$rt_status_data = resultStatus($rs_status, $term);

							list ($rt_statusKey, $rt_status ) = explode ("@@", $rt_status_data); 
							
							if(($admin_grade == $admin_fobrain_grd) && ($admin_level == $admin_tagged) ||
								($admin_grade == $cm_fobrain_grd) && ($admin_level == $cm_fob_tagged)){

								$edit_rs_btn = "edit-result";
								$edit_com_btn = "edit-course-comment";	
								$cond_rs_btn = "";
								$edit_rs_btn_s = "";

							}elseif(($admin_grade == $staff_fobrain_grd) && ($admin_level == $staff_fob_tagged)){

								$edit_rs_btn = "edit-result-staff";
								$edit_com_btn = "edit-course-com-staff";
								$cond_rs_btn = "hide";

								if($rt_statusKey == 1){
									$edit_rs_btn_s = "hide";
								}else{ $edit_rs_btn_s = ""; }


							}else{
								$edit_rs_btn = "";
								$edit_com_btn = "";
								$cond_rs_btn = "hide"; 
								$edit_rs_btn_s = "hide";
							} 

							$serial_no++;
						
$table =<<<IGWEZE
								<tr>
									<td>$serial_no</td>
									<td>
										<a href='javascript:;' id='$edit_data' class='$edit_rs_btn'>
											<img src = "$student_img" class=" img-h-50 img-circle img-thumbnail">
										</a>
									</td>
									<td style='text-transform:uppercase;'>
										<a href='javascript:;' id='$edit_data' class='$edit_rs_btn text-info font-head-1a fs-12a fw-600'>$regNum</a>
											<hr class='text-danger my-5 py-0' style="width:80%;">
										<a href='javascript:;' id='$edit_data' class='$edit_rs_btn text-info font-head-1a fs-12a fw-600'>$lname $mname $fname </a>
									</td>  
									<td> 
										<a href='javascript:;' id='$edit_data' class='$edit_rs_btn'>$rt_status</a>
										</td>  
									<td> 
										<div class="btn-group">
											<a href="javascript:;" class="btna btn-tasks  waves-effect waves-light dropdown-toggle p-5" data-bs-toggle="dropdown" aria-haspopup="true"
											data-bs-display="static" aria-expanded="false">
												<i class="mdi mdi-dots-grid align-middle fs-18"></i>
											</a> 
											<div class="dropdown-menu dropdown-menu-lg-end p-10 dropdown-shadow end-0 animate__animated animate__flipInY"> 

												<p class="mb-10 $edit_rs_btn_s">
													<a href='javascript:;' id='$edit_data' class='$edit_rs_btn text-slateblue btn waves-effect btn-label waves-light'>									
														<i class="mdi mdi-square-edit-outline label-icon"></i> Edit 
													</a>	
												</p>
												<p class="mb-10 $cond_rs_btn">
													<a href='javascript:;' id='$conduct_data' class='edit-student-conduct text-sienna btn waves-effect btn-label waves-light'>									
														<i class="mdi mdi-trophy-award label-icon"></i>   Conducts
													</a>	
												</p> 
												<p>
													<a href='javascript:;' id='$edit_data' class='$edit_com_btn text-danger btn waves-effect btn-label waves-light'>									
														<i class="mdi mdi-shield-star-outline label-icon"></i>   Comments
													</a>	
												</p> 
											</div> 	
										</div>  
									</td>
								</tr>
		
IGWEZE;
							echo $table;

						}

						 
					
					
					}else{
			
						$classLevel = $levelArray[$level-1]['level'];;
						
						$msg_e = "Error, no record was found for <span>
						$session - $session_se session $classLevel $class_val $term_value </span>";
					
						echo $erroMsg.$msg_e.$mgsEnd;   	
							
					}
		
				}catch(PDOException $e) {
  			
						fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			 
				}
	
		
?>

								</tbody>
							</table>				
							<!-- / table -->
						</div>		
					</div>
				</div>
				<!-- card end -->	
			</div>

			<?php require_once $fobrainClassConfigDir; $a = 1; $b = 2; $c = 3; $e = 4; $f = 0; ?> 	

			<div class="col-xl-7 col-lg-7 col-md-7 col-sm-12" id="scroll-to-div">	
				<!-- card start -->
				<div class="card card-shadow">
					
					<?php 
						$level_cl = $levelArray[$level-1]['level'];
						$page_title = "<i class='mdi mdi-format-list-checks'></i> $session_fi $session_se session $level_cl $class_val $term_value Results";
						pageTitle($page_title, 0);	 
					?>
					<div class="msg-box"></div> 					
					<div class="card-body" id="wigz-right-half">   
							

					</div>
				</div>
				<!-- card end -->	
			</div>
		</div>
		<!-- / row -->	 
                    
		<?php 	
		
				$overlay_style = "wiz-overlay-content_2";
				require_once ($fobrainFormTeacherDir.'rs-config-wrapper.php');    /* include staff result configuration div */ 
				
				
			} 
				
		}else{  /* display error */ 
		
		
			echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
		
		
		}
			
			
		if ($msg) {
				
			echo $errorMsg.$msg.$eEnd;  exit; 			

		}

exit;
?>		 