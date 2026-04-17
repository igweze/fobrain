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
	This script handle school grades
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
} 

		define('fobrain', 'igweze');  /* define a check for wrong access of file */

		require 'fobrain-config-s.php';  /* load fobrain configuration files */	   
			
		if ($_REQUEST['session'] == 'save') {  /* save school session */	   

			$fi_term =  cleanInt($_REQUEST['fi_term']);
			$se_term =  cleanInt($_REQUEST['se_term']);
			$session =  clean($_REQUEST['session']);				
			
			/* script validation */
			
			if ($fi_term == "")  {
				
				$msg_e = "* Ooops Error, please enter <b>score session from</b>";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader();  </script>";exit;
				
			}elseif ($se_term == "")  {
				
				$msg_e = "* Ooops Error, please enter <b>score session to</b>";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader();  </script>";exit;
				
			}elseif ($fi_term >= $se_term)  {
				
				$msg_e = "* Ooops Error,  <b>score session from</b> cannot be equal to or greater than <b>score session to</b>";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader();  </script>";exit;
				
			}elseif ($session == "")  {
				
				$msg_e = "* Ooops Error, please enter score session";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader();  </script>";exit;
				
			}else {  /* insert information */       			

				try {
					
					$session = strtoupper($session);						
					
					$ebele_mark = "INSERT INTO $schoolSessionTB  (fi_term, se_term, session)

							VALUES (:fi_term, :se_term, :session)";
					
					$igweze_prep = $conn->prepare($ebele_mark); 
					$igweze_prep->bindValue(':fi_term', $fi_term); 
					$igweze_prep->bindValue(':se_term', $se_term);
					$igweze_prep->bindValue(':session', $session); 
					
					if($igweze_prep->execute()){  /* if sucessfully */
						
						$msg_s = "School session was successfully saved"; 
						echo $succesMsg.$msg_s.$sEnd; 
						echo "<script type='text/javascript'> 
							$('#load-wiz-info').load('session-info.php'); 
							$('#frmsaveSession')[0].reset();
							hidePageLoader();   
						</script>";exit;
						
					}else{  /* display error */ 
			
						$msg_e =  "Ooops, an error has occur while to save school session. Please try again";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'> hidePageLoader();  </script>";exit;
						
					}
					

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				} 
		
			}
		
		}elseif ($_REQUEST['session'] == 'update') {  /* upgrade school session */

			$sID = cleanInt($_REQUEST['sID']);	
			$fi_term =  $_REQUEST['fi_term'];
			$se_term =  $_REQUEST['se_term'];
			$th_term =  $_REQUEST['th_term'];
			$session =  $_REQUEST['session'];				
			
			/* script validation */ 
			
			if ($sID == ""){
				
				$msg_e = "* Ooops, aan error has occur to retrieve school session information. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($fi_term == "")  {
				
				$msg_e = "* Ooops Error, please enter <b>score session from</b>";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader();  </script>";exit;
				
			}elseif ($se_term == "")  {
				
				$msg_e = "* Ooops Error, please enter <b>score session to</b>";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader();  </script>";exit;
				
			}else {  /* upgrade information */       			
			
				
				try { 
					
					$ebele_mark = "UPDATE $schoolSessionTB  
										
										SET  
											
										fi_term = :fi_term, 		
										se_term = :se_term,
										th_term = :th_term
										
									WHERE id_sess = :sID";
					
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':sID', $sID); 
					$igweze_prep->bindValue(':fi_term', $fi_term); 
					$igweze_prep->bindValue(':se_term', $se_term);
					$igweze_prep->bindValue(':th_term', $th_term); 
					
					if($igweze_prep->execute()){  /* if sucessfully */
						
						$msg_s = "School session was successfully saved."; 
						echo $succesMsg.$msg_s.$sEnd; 
						echo "<script type='text/javascript'> 
								$('#load-wiz-info').load('session-info.php'); 
								hidePageLoader();  
								$('#modal-fobrain').modal('hide'); 
						</script>";exit;
						
					}else{  /* display error */ 
			
						$msg_e =  "Ooops, an error has occur while to save school session. Please try again";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
						
					} 

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				} 
		
			}
		
		}elseif (($_REQUEST['session']) == 'update-current') {  /* save school current session */	

			$sessionID =  preg_replace("/[^A-Za-z0-9']/", "", $_REQUEST['sess']);
			$termID =  preg_replace("/[^A-Za-z0-9']/", "", $_REQUEST['term']);

			/* script validation */ 
			
			if ($sessionID == "")  {
				
				$msg_e = "Ooops Error, please select a school current session";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($termID == "")  {
				
				$msg_e = "Ooops Error, please select a school current term";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}else {  /* update information */

				try {
				
					$ebele_mark = "UPDATE $schoolSessionTB SET
					
									current = :current,
									cur_term = :cur_term
									
									WHERE current = :currentS";
									
					$igweze_prep = $conn->prepare($ebele_mark);	
					
					$igweze_prep->bindValue(':current', $i_false);
					$igweze_prep->bindValue(':cur_term', '');
					$igweze_prep->bindValue(':currentS', $fiVal);
					$igweze_prep->execute(); 

					$ebele_mark_3 = "UPDATE $schoolSessionTB SET
					
									current = :current,
									cur_term = :cur_term
									
									WHERE id_sess = :id_sess";
									
					$igweze_prep_3 = $conn->prepare($ebele_mark_3);	
					
					$igweze_prep_3->bindValue(':current', $fiVal);
					$igweze_prep_3->bindValue(':cur_term', $termID);
					$igweze_prep_3->bindValue(':id_sess', $sessionID);
					$igweze_prep_3->execute(); 
	
					if (($igweze_prep) && ($igweze_prep_3)) {  /* if sucessfully */

						$msg_s = "Current School Session was Successfully Saved.";
						echo $succesMsg.$msg_s.$sEnd;
						echo "<script type='text/javascript'> 
								$('#load-wiz-info').load('session-info.php'); 
								hidePageLoader();  
								$('#modal-fobrain').modal('hide');
						</script>";exit;
						//echo "<script type='text/javascript'>  $('#frmcurrentSession').slideUp(2000);  </script>";
					
					}else { /* display error */

						$msg_e = "Ooops, An Error Has occur
						while trying to save Current School Session, please try again";
						echo $erroMsg.$msg_e.$msgEnd; 
						echo"<script type='text/javascript'> hidePageLoader(); </script>";exit;

					} 

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				}						

			}
	
		}elseif ($_REQUEST['session'] == 'edit') {  /* edit school session */ 
			
			$sID = strip_tags($_REQUEST['rData']); 
			
			if ($sID == ""){
				
				$msg_e = "* Ooops, an error has occur while to retrieve school session. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}else {       

				try {  
					
					$gradeInfoArr = sessionInfo($conn, $sID);  /* school session information */ 
					$fi_term = $gradeInfoArr[$fiVal]["fi_term"];
					$se_term = $gradeInfoArr[$fiVal]["se_term"]; 
					$th_term = $gradeInfoArr[$fiVal]["th_term"]; 
					$session = $gradeInfoArr[$fiVal]["year"];

?>
					<!-- form -->
					<form class="form-horizontal" id="frmupdateSession" role="form">  
						
						<!-- row -->
						<div class="row gutters">
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">										
								<!-- field wrapper start -->
								<div class="field-wrapper">										 
									<input type="date" class="form-control" placeholder="Term Start" 
									name="fi_term"  id="fi_term" value="<?php echo $fi_term; ?>" required-r>
									<div class="field-placeholder"> First Term <span class="text-danger">*</span></div>
								</div>
								<!-- field wrapper end -->
							</div>	
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">										
								<!-- field wrapper start -->
								<div class="field-wrapper">										 
									<input type="date" class="form-control" placeholder="Term Start" 
									name="se_term"  id="se_term" value="<?php echo $se_term; ?>" required-r>
									<div class="field-placeholder"> Second Term  <span class="text-danger">*</span></div>
								</div>
								<!-- field wrapper end -->
							</div> 
							
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">										
								<!-- field wrapper start -->
								<div class="field-wrapper">										 
									<input type="date" class="form-control" placeholder="Term Start" 
									name="th_term"  id="th_term" value="<?php echo $th_term; ?>" required-r>
									<div class="field-placeholder"> Third Term  <span class="text-danger">*</span></div>
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
								<input type="hidden" name="session" value="update" />
								<input type="hidden" name="sID" value="<?php echo $sID; ?>" />	
								<button type="submit" class="btn btn-primary waves-effect   
								btn-label waves-light" id="updateSession">
									<i class="mdi mdi-content-save label-icon"></i>  Save
								</button>
							</div>
						</div>	
						<!-- /row -->	 
															
					</form>							

						
					
<?php						
							
					echo "<script type='text/javascript'> hidePageLoader(); </script>"; exit; 

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				} 
		
			}
		
		}elseif ($_REQUEST['session'] == 'current') {  /* LOAD school session */   


?>
			<!-- form -->
			<form class="form-horizontal" id="frmcurrentSession" role="form">
				<!-- row -->
				<div class="row gutters">
					<div class="col-12">										
						<!-- field wrapper start -->
						<div class="field-wrapper">
							<select class="form-control fob-select"  id="sess" name="sess" required>                                              
								<option value = "">Please select One</option>
								<?php 
									try {
									
										currentSession($conn);  /* current school session  */
							
									}catch(PDOException $e) {
		
									fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
		
									} 
								?> 
							</select>
							<div class="field-placeholder">Current   Session  <span class="text-danger">*</span></div>
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
							<select class="form-control fob-select"  id="term" name="term" placeholder="Search ..." required>                                              
								<option value = "">Please select One</option>
								<?php

									try {
									
										$curTerm = currentSessionTerm($conn); /* current school term  */
							
									}catch(PDOException $e) {
		
									fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
		
									} 


									foreach($term_list as $term_key => $term_value){  /* loop array */

										if ($curTerm == $term_key){
											$selected = "SELECTED";
										} else {
											$selected = "";
										}

										echo '<option value="'.$term_key.'"'.$selected.'>'.$term_value.'</option>' ."\r\n";

									}

								?>
								
							</select>			
							<div class="field-placeholder"> Current Term <span class="text-danger">*</span></div>
						</div>
						<!-- field wrapper end -->
					</div> 														 
				</div>	
				<!-- /row -->
				
				<!-- row -->
				<div class="row gutters mt-30">
					<div class="col-12 text-end">
						<input type="hidden" name="session" value="update-current" /> 
						<button type="submit" class="btn btn-primary waves-effect   
						btn-label waves-light demo-disenable" id="currentSession">
							<i class="mdi mdi-content-save label-icon"></i>  Save
						</button>
					</div>
				</div>	
				<!-- /row -->									
			</form>
			<!-- / form -->		

			<script type="text/javascript">	 
				$('.fob-select').each(function() {  
					renderSelect($('#'+this.id)); 
				});
				hidePageLoader(); 
			</script>
					
<?php						
							
			exit;   
		
		}else{ 
		
			echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
		
		}  
exit; 
?>