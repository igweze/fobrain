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
		        
			if ($_REQUEST['gradeData'] == 'saveGrade') {  /* save school grade */	   
 
				$fromGrade =  cleanInt($_REQUEST['fromGrade']);
				$toGrade =  cleanInt($_REQUEST['toGrade']);
				$grade =  clean($_REQUEST['grade']);				
				
				/* script validation */
				
				if ($fromGrade == "")  {
         			
					$msg_e = "* Ooops Error, please enter <b>score grade from</b>";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'> hidePageLoader();  </script>";exit;
					
	   			}elseif ($toGrade == "")  {
         			
					$msg_e = "* Ooops Error, please enter <b>score grade to</b>";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'> hidePageLoader();  </script>";exit;
					
	   			}elseif ($fromGrade >= $toGrade)  {
         			
					$msg_e = "* Ooops Error,  <b>score grade from</b> cannot be equal to or greater than <b>score grade to</b>";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'> hidePageLoader();  </script>";exit;
					
	   			}elseif ($grade == "")  {
         			
					$msg_e = "* Ooops Error, please enter score grade";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'> hidePageLoader();  </script>";exit;
					
	   			}else {  /* insert information */       			

		 			try {
						
						$grade = strtoupper($grade);						
						
						$ebele_mark = "INSERT INTO $fobrainGradeTB  (fromGrade, toGrade, grade)

								VALUES (:fromGrade, :toGrade, :grade)";
					 
						$igweze_prep = $conn->prepare($ebele_mark); 
						$igweze_prep->bindValue(':fromGrade', $fromGrade); 
						$igweze_prep->bindValue(':toGrade', $toGrade);
						$igweze_prep->bindValue(':grade', $grade); 
						
						if($igweze_prep->execute()){  /* if sucessfully */
							
							$msg_s = "School grade score was successfully saved"; 
							echo $succesMsg.$msg_s.$sEnd; 
							echo "<script type='text/javascript'> 
								$('#load-wiz-info').load('grades-info.php'); 
								$('#frmsaveGrade')[0].reset();
								hidePageLoader();   
							</script>";exit;
							
						}else{  /* display error */ 
				
							$msg_e =  "Ooops, an error has occur while to save school grade score. Please try again";
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'> hidePageLoader();  </script>";exit;
							
						}
						

				 	}catch(PDOException $e) {
  			
						fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					} 
        	
				}
			
			}elseif ($_REQUEST['gradeData'] == 'updateGrade') {  /* upgrade school grade */

				$gID = cleanInt($_REQUEST['gID']);	
				$fromGrade =  cleanInt($_REQUEST['fromGrade']);
				$toGrade =  cleanInt($_REQUEST['toGrade']);
				$grade =  clean($_REQUEST['grade']);				
				
				/* script validation */ 
				
				if ($gID == ""){
         			
					$msg_e = "* Ooops, aan error has occur to retrieve school grade information. Please try again";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
					
	   			}elseif ($fromGrade == "")  {
         			
					$msg_e = "* Ooops Error, please enter <b>score grade from</b>";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'> hidePageLoader();  </script>";exit;
					
	   			}elseif ($toGrade == "")  {
         			
					$msg_e = "* Ooops Error, please enter <b>score grade to</b>";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'> hidePageLoader();  </script>";exit;
					
	   			}elseif ($fromGrade >= $toGrade)  {
         			
					$msg_e = "* Ooops Error,  <b>score grade from</b> cannot be equal to or greater than <b>score grade to</b>";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'> hidePageLoader();  </script>";exit;
					
	   			}elseif ($grade == "")  {
         			
					$msg_e = "* Ooops Error, please enter score grade";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'> hidePageLoader();  </script>";exit;
					
	   			}else {  /* upgrade information */       			
				
					
		 			try { 
						
						$grade = strtoupper($grade);
						
						$ebele_mark = "UPDATE $fobrainGradeTB  
											
											SET  
											 
											fromGrade = :fromGrade, 		
											toGrade = :toGrade,
											grade = :grade
											
										WHERE gID = :gID";
					 
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':gID', $gID); 
						$igweze_prep->bindValue(':fromGrade', $fromGrade); 
						$igweze_prep->bindValue(':toGrade', $toGrade);
						$igweze_prep->bindValue(':grade', $grade);  
						
						if($igweze_prep->execute()){  /* if sucessfully */
							
							$msg_s = "School grade score was successfully saved."; 
							echo $succesMsg.$msg_s.$sEnd; 
							echo "<script type='text/javascript'> 
								$('#load-wiz-info').load('grades-info.php'); 
								$('#modal-fobrain').modal('hide');
							 	hidePageLoader();   
							</script>";exit;
							
						}else{  /* display error */ 
				
							$msg_e =  "Ooops, an error has occur while to save school grade score. Please try again";
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
							
						} 

				 	}catch(PDOException $e) {
  			
						fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					} 
        	
				}
			
			}elseif ($_REQUEST['gradeData'] == 'removeGrade') {  /* remove school grade */ 
				
				$gradeData = $_REQUEST['rData'];
				
				list($fobrainIg, $gID, $hName) = explode("-", $gradeData);			
				
				/* script validation */
				
				if (($gradeData == "")  || ($gID == "")){
         			
					$msg_e = "* Ooops, an error has occur while to remove school grade score. Please try again";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
					
	   			}else {  /* remove information */       			


		 			try {
						
						
						$ebele_mark = "DELETE FROM 
						
										$fobrainGradeTB										
											
										WHERE gID = :gID
											
										LIMIT 1";
					 
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':gID', $gID);  
						
						if($igweze_prep->execute()){  /* if sucessfully */
							
							$removeDiv = "$('#row-".$gID."').fadeOut(1000);";
							$msg_s = "<strong>School grade score</strong> was successfully removed"; 
							echo $succesMsg.$msg_s.$sEnd; 
							echo "<script type='text/javascript'>   
							hidePageLoader(); $('.slideUpFrmDiv').fadeOut(3000); $removeDiv  </script>";exit;
							
						}else{  /* display error */ 
				
							$msg_e =  "Ooops, an error has occur while to remove school grade score. Please try again";
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
							
						}
						

				 	}catch(PDOException $e) {
  			
						fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					} 
        	
				}
			
			}elseif ($_REQUEST['gradeData'] == 'view') {  /* view school grade */

				
				$gID = $_REQUEST['rData'];
				
				
				if ($gID == ""){
         			
					$msg_e = "* Ooops, an error has occur while to retrieve school grade score. Please try again";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
					
	   			}else {       			


		 			try {						
						
						$gradeInfoArr = gradeInfo($conn, $gID);  /* school grade information */ 
						$fromGrade = $gradeInfoArr[$fiVal]["fromGrade"];
						$toGrade = $gradeInfoArr[$fiVal]["toGrade"]; 
						$grade = $gradeInfoArr[$fiVal]["grade"]; 
									

$showGrade =<<<IGWEZE
		
						 
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

								<tr><th> Grade Score From </td> <td> $fromGrade </td> </tr> 

								<tr><th> Grade Score To </td> <td> $toGrade</td> </tr> 

								<tr><th> Score Grade</td> <td> $grade</td> </tr> 

							</table>
							<!-- / table --> 

						</div>
		
IGWEZE;
				
						echo $showGrade; 
						
						echo "<script type='text/javascript'>  hidePageLoader(); </script>"; exit;
						
						

				 	}catch(PDOException $e) {
  			
						fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					}
		 
        	
				}
			
			}elseif ($_REQUEST['gradeData'] == 'edit') {  /* edit school grade */ 
				
				$gID = strip_tags($_REQUEST['rData']); 
				
				if ($gID == ""){
         			
					$msg_e = "* Ooops, an error has occur while to retrieve school grade score. Please try again";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
					
	   			}else {       

		 			try { 
						
						$gradeInfoArr = gradeInfo($conn, $gID);  /* school grade information */ 
						$fromGrade = $gradeInfoArr[$fiVal]["fromGrade"];
						$toGrade = $gradeInfoArr[$fiVal]["toGrade"]; 
						$grade = $gradeInfoArr[$fiVal]["grade"];

?>
						<!-- form -->
						<form class="form-horizontal" id="frmupdateGrade" role="form">  
							
							<!-- row -->
							<div class="row gutters">
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">										
									<!-- field wrapper start -->
									<div class="field-wrapper">										 
										<input type="number" class="form-control" placeholder="Enter Grade From" 
										name="fromGrade"  id="fromGrade" value="<?php echo $fromGrade; ?>" required-r>
										<div class="field-placeholder"> Score From (Lowest Score) <span class="text-danger">*</span></div>
									</div>
									<!-- field wrapper end -->
								</div>	
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">										
									<!-- field wrapper start -->
									<div class="field-wrapper">										 
										<input type="number" class="form-control" placeholder="Enter Grade From" 
										name="toGrade"  id="toGrade" value="<?php echo $toGrade; ?>" required-r>
										<div class="field-placeholder"> Score To  (Highest Score)  <span class="text-danger">*</span></div>
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
										<input type="text" class="form-control" placeholder="Enter Score Grade" 
										name="grade"  id="grade" value="<?php echo $grade; ?>" required-r>
										<div class="field-placeholder"> Score Grading  <span class="text-danger">*</span></div>
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
									<input type="hidden" name="gradeData" value="updateGrade" />
									<input type="hidden" name="gID" value="<?php echo $gID; ?>" />	
									<!--
									<button type="submit" class="btn btn-primary waves-effect   
									btn-label waves-light demo-disenable" id="updateGrade">
										<i class="mdi mdi-content-save label-icon"></i>  Save
									</button>
									-->

									<button class="btn btn-primary demo-disenable fobrain-frm-wizard" 
										type="summit" 
										data-frm="frmupdateGrade"
										data-server="grade-manager.php"
										data-target="edit-msg"
										data-nerves="fobrain"
										data-scroll="0"
										data-scroll-target="edit-msg"
										>
										<span class="button-text">
											<i class="mdi mdi-content-save label-icon"></i> Save 
										</span>									 
										<span class="spinner-text" style="display: none;">Processing...</span>
										<span class="spinner-border ms-auto spinner-icon" aria-hidden="true" 
										style="display: none;"></span>

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
			
			}elseif ($_REQUEST['gradeData'] == 'load') {  /* LOAD school grade */  
				
 

?>
				<form class="form-horizontal" id="frmsaveGrade" role="form"> 
					
					<!-- row -->
					<div class="row gutters">
						<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">										
							<!-- field wrapper start -->
							<div class="field-wrapper">										 
								<input type="number" class="form-control" placeholder="Enter Grade From" 
								name="fromGrade"  id="fromGrade" required>
								<div class="field-placeholder"> Score From (Lowest Score) <span class="text-danger">*</span></div>
							</div>
							<!-- field wrapper end -->
						</div>	
						<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">	 									
							<!-- field wrapper start -->
							<div class="field-wrapper">										 
								<input type="number" class="form-control" placeholder="Enter Grade From" 
								name="toGrade"  id="toGrade" required>
								<div class="field-placeholder"> Score To  (Highest Score)  <span class="text-danger">*</span></div>
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
								<input type="text" class="form-control" placeholder="Enter Score Grade" 
								name="grade"  id="grade" required>
								<div class="field-placeholder"> Score Grading  <span class="text-danger">*</span></div>
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
							<input type="hidden" name="gradeData" value="saveGrade" /> 	
							<button type="submit" class="btn btn-primary waves-effect   
							btn-label waves-light demo-disenable" id="saveGrade">
								<i class="mdi mdi-content-save label-icon"></i>  Save
							</button>
						</div>
					</div>	
					<!-- /row -->	

					 									
				</form>
						
<?php						
								
				echo "<script type='text/javascript'> hidePageLoader(); </script>"; exit;   
			
			}else{ 
			
				echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
			
			}  
exit; 
?>