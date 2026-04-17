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
	This script handle school hostel
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
} 

     	define('fobrain', 'igweze');  /* define a check for wrong access of file */

		require 'fobrain-config.php';  /* load fobrain configuration files */
		         
			if ($_REQUEST['hostel_d'] == 'save') {  /* save school hostel */ 
				
				$hostel = clean($_REQUEST['hostel']);
				$h_max = cleanInt($_REQUEST['h_max']);
				$h_desc = clean($_REQUEST['h_desc']);				
				$teacherID = cleanInt($_REQUEST['teacher']);
				
				$regDate = strtotime(date("Y-m-d H:i:s"));
				
				/* script validation */ 
				
				if ($hostel == "")  {
         			
					$msg_e = "* Ooops Error, please enter new hostel name";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
					
	   			}elseif ($h_max == "")  {
         		
					$msg_e = "* Ooops Error, please maximum number of student this hostel can contain";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
	   			
				}elseif($teacherID == "")   {
         		
					$msg_e  = "* Ooops Error, please select Hostel master or mistress";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
	   			
				}else {  /* insert information */   

		 			try {
						
						
						$ebele_mark = "INSERT INTO $hostelTB  (hostel, h_limit, h_desc, h_master)

								VALUES (:hostel, :h_limit, :h_desc, :h_master)";
					 
						$igweze_prep = $conn->prepare($ebele_mark);

						$igweze_prep->bindValue(':hostel', $hostel);
						$igweze_prep->bindValue(':h_limit', $h_max);
						$igweze_prep->bindValue(':h_desc', $h_desc);
						$igweze_prep->bindValue(':h_master', $teacherID); 
						
						if($igweze_prep->execute()){  /* if sucessfully */
							
							$msg_s = "<strong>$hostel</strong> was successfully added"; 
							echo $succesMsg.$msg_s.$sEnd; 
							echo "<script type='text/javascript'> 
								$('#load-wiz-info').load('hostels-info.php'); 
								$('#frmsave-hostel')[0].reset(); 
								hidePageLoader();  
							</script>";exit;
							
						}else{  /* display error */ 
				
							$msg_e =  "Ooops, an error has occur while to add new hostel. Please try again";
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
							
						} 

				 	}catch(PDOException $e) {
  			
						fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					} 
        	
				}
			
			}elseif ($_REQUEST['hostel_d'] == 'update') {  /* update school hostel */ 
				
				$hostel = clean($_REQUEST['hostel']);
				$h_max = cleanInt($_REQUEST['h_max']);
				$h_desc = clean($_REQUEST['h_desc']);				
				$teacherID = cleanInt($_REQUEST['teacher']);
				$hID = cleanInt($_REQUEST['hID']);			
				
				/* script validation */ 
				
				if ($hID == ""){
         			
					$msg_e = "* Ooops, an error has occur while to save hostel information. Please try again";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
					
	   			}elseif ($hostel == "")  {
         			
					$msg_e = "* Ooops Error, please enter new hostel name";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
					
	   			}elseif ($h_max == "")  {
         		
					$msg_e = "* Ooops Error, please maximum number of student this hostel can contain";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
	   			
				}elseif($teacherID == "")   {
         		
					$msg_e  = "* Ooops Error, please select Hostel master or mistress";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
	   			
				}else {  /* update information */       			


		 			try {
						
						
						$ebele_mark = "UPDATE $hostelTB
										
										SET 
										
											hostel = :hostel, 
											h_limit = :h_limit, 
											h_desc = :h_desc, 
											h_master = :h_master
											
											WHERE h_id = :h_id";
					 
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':hostel', $hostel);
						$igweze_prep->bindValue(':h_limit', $h_max);
						$igweze_prep->bindValue(':h_desc', $h_desc);
						$igweze_prep->bindValue(':h_master', $teacherID);
						$igweze_prep->bindValue(':h_id', $hID); 
						
						if($igweze_prep->execute()){  /* if sucessfully */
							
							$msg_s = "<strong>$hostel</strong> was successfully saved"; 
							echo $succesMsg.$msg_s.$sEnd; 
							echo "<script type='text/javascript'> 
								$('#load-wiz-info').load('hostels-info.php'); 
								$('#modal-fobrain').modal('hide');
								hidePageLoader();  
							</script>";exit;
							
						}else{  /* display error */ 
				
							$msg_e =  "Ooops, an error has occur while to save hostel. Please try again";
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
							
						}
						

				 	}catch(PDOException $e) {
  			
						fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					} 
         		
        	
				}
			
			}elseif ($_REQUEST['hostel_d'] == 'remove') {  /* remove school hostel */

				
				$hostel = $_REQUEST['rData'];
				
				list($fobrainIg, $hID, $hName) = explode("-", $hostel);			
				
				/* script validation */ 
				
				if (($hostel == "")  || ($hID == "")){
         			
					$msg_e = "* Ooops, an error has occur while to remove hostel. Please try again";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
					
	   			}else {  /* remove information */       			


		 			try { 
						
						$ebele_mark = "DELETE FROM $hostelTB 
										
										WHERE h_id = :h_id
										
										LIMIT 1";
					 
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':h_id', $hID); 
						
						if($igweze_prep->execute()){  /* if sucessfully */
							
							$removeDiv = "$('#row-".$hID."').fadeOut(1000);";
							$msg_s = "<strong>$hName</strong> was successfully removed"; 
							echo $succesMsg.$msg_s.$sEnd; 
							echo "<script type='text/javascript'>   
								$('#modal-load-div').fadeOut(3000); 
								$removeDiv 
								hidePageLoader();
							</script>";exit;
							
						}else{  /* display error */
				
							$msg_e =  "Ooops, an error has occur while to remove hostel. Please try again";
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
							
						}
						

				 	}catch(PDOException $e) {
  			
						fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					} 
        	
				}
			
			}elseif ($_REQUEST['hostel_d'] == 'load') {  /* edit school hostel */ 

$hostelFormTop =<<<IGWEZE

				<!-- form -->
				<form class="form-horizontal" id="frmsave-hostel" role="form"> 

					<!-- row -->
					<div class="row gutters">
						<div class="col-lg-12">										
							<!-- field wrapper start -->
							<div class="field-wrapper">
								<input type="text"  id="hostel" name="hostel"  class="form-control" 
								required style="text-transform:Capitalize;">
								<div class="field-placeholder"> Hostel Name <span class="text-danger">*</span></div>
							</div>
							<!-- field wrapper end -->
						</div>									 
					</div>	

					<!-- row -->
					<div class="row gutters">
						<div class="col-lg-12">										
							<!-- field wrapper start -->
							<div class="field-wrapper">
								<input type="number"  id="h_max" name="h_max" class="form-control" required>
								<div class="field-placeholder">Maximum No. of Student in Hostel <span class="text-danger">*</span></div>
							</div>
							<!-- field wrapper end -->
						</div>									 
					</div>	

					<!-- row -->
					<div class="row gutters">
						<div class="col-lg-12">										
							<!-- field wrapper start -->
							<div class="field-wrapper">
								<input type="text"  id="h_desc" name="h_desc"   class="form-control">
								<div class="field-placeholder"> Hostel Description <span class="text-danger">*</span></div>
							</div>
							<!-- field wrapper end -->
						</div>									 
					</div>	

					<!-- row -->
					<div class="row gutters">
						<div class="col-lg-12">										
							<!-- field wrapper start -->
							<div class="field-wrapper">
							
								<select class="form-control"  id="staff" name="teacher" required>
								
								<option value = "">Please select One</option> 
									

IGWEZE;
					
							echo $hostelFormTop;	  
					
							try{
								$staff_arr = staffArrays($conn);  /* school staffs/teachers token information */
								echo staffSelectBox($conn, $staff_arr, "none", false);
							}catch(PDOException $e) {				
								fobrainDie( 'Ooops Database Error: ' . $e->getMessage());													
							} 
								 

$hostelFormBot =<<<IGWEZE

								</select>
							
								<div class="field-placeholder"> Hostel Master/Mistress <span class="text-danger">*</span></div>
							</div>
							<!-- field wrapper end -->
						</div>									 
					</div>	 


					<hr class="mt-30 mb-15 text-danger" />
					<!-- row -->
					<div class="row gutters modal-btn-footer">
						<div class="col-6 text-start">
							<button type="button" id="close-modal" class="btn btn-danger close-modal" 
							data-bs-dismiss="modal"> <i class="mdi mdi-window-close label-icon"></i> Close</button>
						</div>
						<div class="col-6 text-end">
							<input type="hidden" name="hID" value="$hID" />
							<input type="hidden" name="hostel_d" value="save" />
							<button type="submit" class="btn btn-primary waves-effect   
							btn-label waves-light" id="save-hostel">
								<i class="mdi mdi-content-save label-icon"></i>  Save
							</button>
						</div>
					</div>	
					<!-- /row -->	
					
				</form> 
				<!-- / form -->
IGWEZE;
						
				echo $hostelFormBot;														
						
						
				echo '<script type="text/javascript"> 
						hidePageLoader();
						renderSelectImg("#staff", 1);	  
					</script>'; exit;  
 
			
			}elseif ($_REQUEST['hostel_d'] == 'edit') {  /* edit school hostel */

				
				$hID = $_REQUEST['rData'];
				
				/* script validation */ 
				
				if ($hID == ""){
         			
					$msg_e = "* Ooops, an error has occur while to retrieve hostel information. Please try again";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
					
	   			}else {     

		 			try { 
						
						$hostelInfoArr = fobrainHostelInfo($conn, $hID);  /* school hostel information  */
						$hostel = $hostelInfoArr[$fiVal]['hostel'];
						$h_limit = $hostelInfoArr[$fiVal]['h_limit'];
						$h_desc = $hostelInfoArr[$fiVal]['h_desc'];
						$h_master = $hostelInfoArr[$fiVal]['h_master'];

					}catch(PDOException $e) {
  			
						fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					} 
         		


$hostelFormTop =<<<IGWEZE
        
					<!-- form -->
					<form class="form-horizontal" id="frmupdate-hostel" role="form"> 

						<!-- row -->
						<div class="row gutters">
							<div class="col-lg-12">										
								<!-- field wrapper start -->
								<div class="field-wrapper">
									<input type="text"  id="hostel" name="hostel"  class="form-control"  value="$hostel"
									required style="text-transform:Capitalize;">
									<div class="field-placeholder"> Hostel Name <span class="text-danger">*</span></div>
								</div>
								<!-- field wrapper end -->
							</div>									 
						</div>	

						<!-- row -->
						<div class="row gutters">
							<div class="col-lg-12">										
								<!-- field wrapper start -->
								<div class="field-wrapper">
									<input type="number"  id="h_max" name="h_max" class="form-control" value="$h_limit" required>
									<div class="field-placeholder">Maximum No. of Student in Hostel <span class="text-danger">*</span></div>
								</div>
								<!-- field wrapper end -->
							</div>									 
						</div>	

						<!-- row -->
						<div class="row gutters">
							<div class="col-lg-12">										
								<!-- field wrapper start -->
								<div class="field-wrapper">
									<input type="text"  id="h_desc" name="h_desc" value="$h_desc" class="form-control">
									<div class="field-placeholder"> Hostel Description <span class="text-danger">*</span></div>
								</div>
								<!-- field wrapper end -->
							</div>									 
						</div>	

						<!-- row -->
						<div class="row gutters">
							<div class="col-lg-12">										
								<!-- field wrapper start -->
								<div class="field-wrapper">
								
								<select class="form-control"  id="staff" name="teacher" required>
								
								<option value = "">Please select One</option> 
										

IGWEZE;
						
								echo $hostelFormTop;						

						
						
								try{
									$staff_arr = staffArrays($conn);  /* school staffs/teachers token information */
									echo staffSelectBox($conn, $staff_arr, $h_master, false);
								}catch(PDOException $e) {				
									fobrainDie( 'Ooops Database Error: ' . $e->getMessage());													
								}
 	
						

$hostelFormBot =<<<IGWEZE

									</select>								
									<div class="field-placeholder"> Hostel Master/Mistress <span class="text-danger">*</span></div>
								</div>
								<!-- field wrapper end -->
							</div>									 
						</div>	  

						<hr class="mt-30 mb-15 text-danger" />
						<!-- row -->
						<div class="row gutters modal-btn-footer">
							<div class="col-6 text-start">
								<button type="button" id="close-modal" class="btn btn-danger close-modal" 
								data-bs-dismiss="modal"> <i class="mdi mdi-window-close label-icon"></i> Close</button>
							</div>
							<div class="col-6 text-end">
								<input type="hidden" name="hID" value="$hID" />
								<input type="hidden" name="hostel_d" value="update" />
								<button type="submit" class="btn btn-primary waves-effect   
								btn-label waves-light" id="update-hostel">
									<i class="mdi mdi-content-save label-icon"></i>  Save
								</button>
							</div>
						</div>	
						<!-- /row -->	
						
					</form> 
					<!-- / form -->
IGWEZE;
							
					echo $hostelFormBot;	  
							
					echo '<script type="text/javascript"> hidePageLoader();
				
							hidePageLoader();
							renderSelectImg("#staff", 1);
					
						</script>'; exit;   
        	
				}
			
			}else{ 
			
				echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
			
			}


		
			
exit;
?>