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
	This script handle school route
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

     	define('fobrain', 'igweze');  /* define a check for wrong access of file */

        require 'fobrain-config.php';  /* load fobrain configuration files */ 
			
		if ($_REQUEST['route_d'] == 'save') {  /* save school route */  
			
			$route = clean($_REQUEST['route']);
			$r_amout = clean($_REQUEST['r_amout']);
			$r_desc = clean($_REQUEST['r_desc']);				
			$teacherID = cleanInt($_REQUEST['teacher']);
			
			$regDate = strtotime(date("Y-m-d H:i:s"));
			
			/* script validation */ 
			
			if ($route == "")  {
				
				$msg_e = "* Ooops Error, please enter new route name";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
				
			}elseif ($r_amout == "")  {
			
				$msg_e = "* Ooops Error, please enter route price";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
			
			}elseif($teacherID == "")   {
			
				$msg_e  = "* Ooops Error, please select Route master or mistress";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
			
			}else {  /* insert information */       			


				try {
					
					
					$ebele_mark = "INSERT INTO $routeTB  (route, r_amout, r_desc, r_master)

							VALUES (:route, :r_amout, :r_desc, :r_master)";
					
					$igweze_prep = $conn->prepare($ebele_mark);

					$igweze_prep->bindValue(':route', $route);
					$igweze_prep->bindValue(':r_amout', $r_amout);
					$igweze_prep->bindValue(':r_desc', $r_desc);
					$igweze_prep->bindValue(':r_master', $teacherID); 
					
					if($igweze_prep->execute()){  /* if sucessfully */ 
						
						$msg_s = "<strong>$route</strong> was successfully added"; 
						echo $succesMsg.$msg_s.$sEnd; 
						echo "<script type='text/javascript'> 
							$('#load-wiz-info').load('routes-info.php'); 
							$('#frmsave-route')[0].reset(); 
							hidePageLoader(); 
						</script>";exit;
						
					}else{  /* display error */ 
			
						$msg_e =  "Ooops, an error has occur while to add new route. Please try again";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
						
					} 

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				}  
		
			}
		
		}elseif ($_REQUEST['route_d'] == 'update') {  /* update school route */ 
			
			$route = clean($_REQUEST['route']);
			$r_amout = clean($_REQUEST['r_amout']);
			$r_desc = clean($_REQUEST['r_desc']);				
			$teacherID = cleanInt($_REQUEST['teacher']);
			$hID = cleanInt($_REQUEST['hID']);			
			
			
			if ($hID == ""){
				
				$msg_e = "* Ooops, an error has occur while to save route information. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($route == "")  {
				
				$msg_e = "* Ooops Error, please enter new route name";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
				
			}elseif ($r_amout == "")  {
			
				$msg_e = "* Ooops Error, please enter route price";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
			
			}elseif($teacherID == "")   {
			
				$msg_e  = "* Ooops Error, please select Route master or mistress";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
			
			}else {  /* update information */       

				try { 
					
					$ebele_mark = "UPDATE $routeTB
									
									SET 
									
										route = :route, 
										r_amout = :r_amout, 
										r_desc = :r_desc, 
										r_master = :r_master
										
										WHERE r_id = :r_id";
					
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':route', $route);
					$igweze_prep->bindValue(':r_amout', $r_amout);
					$igweze_prep->bindValue(':r_desc', $r_desc);
					$igweze_prep->bindValue(':r_master', $teacherID);
					$igweze_prep->bindValue(':r_id', $hID); 
					
					if($igweze_prep->execute()){  /* if sucessfully */ 
						
						$msg_s = "<strong>$route</strong> was successfully saved"; 
						echo $succesMsg.$msg_s.$sEnd; 							 
						echo "<script type='text/javascript'> 
							$('#load-wiz-info').load('routes-info.php');  
							hidePageLoader(); 
							$('#modal-fobrain').modal('hide');
						</script>";exit;
						
					}else{  /* display error */ 
			
						$msg_e =  "Ooops, an error has occur while to save route. Please try again";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
						
					}
					

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				}  
		
			}
		
		}elseif ($_REQUEST['route_d'] == 'remove') {  /* remove school route */ 

			
			$route_d = $_REQUEST['rData'];
			
			list($fobrainIg, $hID, $hName) = explode("-", $route_d);			
			
			/* script validation */ 
			
			if (($route_d == "")  || ($hID == "")){
				
				$msg_e = "* Ooops, an error has occur while to remove route. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}else {  /* remove information */       			


				try {
					
					
					$ebele_mark = "DELETE FROM $routeTB 
									
									WHERE r_id = :r_id
									
									LIMIT 1";
					
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':r_id', $hID); 
					
					if($igweze_prep->execute()){  /* if sucessfully */ 
						
						$removeDiv = "$('#row-".$hID."').fadeOut(1000);";
						$msg_s = "<strong>$hName</strong> was successfully removed"; 
						echo $succesMsg.$msg_s.$sEnd; 
						
						echo "<script type='text/javascript'> 
							$removeDiv
							//$('#modal-load-div').slideUp(1500);
							hidePageLoader(); 
						</script>";exit;
						
					}else{  /* display error */
			
						$msg_e =  "Ooops, an error has occur while to remove route. Please try again";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
						
					}
					

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				} 
		
			}
		
		}elseif ($_REQUEST['route_d'] == 'load') {  /* edit school route */  
				

$routeFormTop =<<<IGWEZE
		
				<!-- form -->
				<form class="form-horizontal" id="frmsave-route" role="form"> 

					<!-- row -->
					<div class="row gutters">
						<div class="col-lg-12">										
							<!-- field wrapper start -->
							<div class="field-wrapper">
								<input type="text"  id="route" name="route"  class="form-control" 
								required style="text-transform:Capitalize;">
								<div class="field-placeholder"> Route Name <span class="text-danger">*</span></div>
							</div>
							<!-- field wrapper end -->
							</div>									 
						</div>	

						<!-- row -->
						<div class="row gutters">
							<div class="col-lg-12">										
								<!-- field wrapper start -->
								<div class="field-wrapper">
								<input type="number"  id="r_amout" name="r_amout" class="form-control"  required>
								<div class="field-placeholder"> Route Amout <span class="text-danger">*</span></div>
								</div>
								<!-- field wrapper end -->
							</div>									 
						</div>	 

						<!-- row -->
						<div class="row gutters">
							<div class="col-lg-12">										
								<!-- field wrapper start -->
								<div class="field-wrapper">
								<input type="text"  id="r_desc" name="r_desc" class="form-control">
									<div class="field-placeholder"> Route Description <span class="text-danger">*</span></div>
								</div>
								<!-- field wrapper end -->
							</div>									 
						</div>	 

						<!-- row -->
						<div class="row gutters">
							<div class="col-lg-12">										
								<!-- field wrapper start -->
								<div class="field-wrapper">									
									<select class="form-control" id="staff" name="teacher" required> 
										<option value = "">Please select One</option>  
								

IGWEZE;
				
										echo $routeFormTop;	 

										try{
											$staff_arr = staffArrays($conn);  /* school staffs/teachers token information */
											echo staffSelectBox($conn, $staff_arr, "none", false);
										}catch(PDOException $e) {				
											fobrainDie( 'Ooops Database Error: ' . $e->getMessage());												
										} 
							

$routeFormBot =<<<IGWEZE

	
								</select>								
								<div class="field-placeholder"> Route Master/Mistress <span class="text-danger">*</span></div>
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
							<input type="hidden" name="route_d" value="save" />
							<button type="submit" class="btn btn-primary waves-effect   
							btn-label waves-light" id="save-route">
								<i class="mdi mdi-content-save label-icon"></i>  Save
							</button>
						</div>
					</div>	
					<!-- /row -->	
				</form> 
				<!-- /form -->

IGWEZE;

			echo $routeFormBot; 
							
			echo '<script type="text/javascript"> 
					hidePageLoader();			
					renderSelectImg("#staff", 1); 
			</script>';// exit;
			
		
		}elseif ($_REQUEST['route_d'] == 'edit') {  /* edit school route */ 
			
			$hID = strip_tags($_REQUEST['rData']);
			
			/* script validation */
			
			if ($hID == ""){
				
				$msg_e = "* Ooops, an error has occur while to retrieve route information. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
				
			}else {       

				try { 
					$routeInfoArr = fobrainRouteInfo($conn, $hID);  /* school route information */
					$route = $routeInfoArr[$fiVal]['route'];
					$r_amout = $routeInfoArr[$fiVal]['r_amout'];
					$r_desc = $routeInfoArr[$fiVal]['r_desc'];
					$r_master = $routeInfoArr[$fiVal]['r_master'];

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				} 

$routeFormTop =<<<IGWEZE
		
				<!-- form -->
				<form class="form-horizontal" id="frmupdate-route" role="form"> 

					<!-- row -->
					<div class="row gutters">
						<div class="col-lg-12">										
							<!-- field wrapper start -->
							<div class="field-wrapper">
								<input type="text"  id="route" name="route"  class="form-control"  value="$route"
								required style="text-transform:Capitalize;">
								<div class="field-placeholder"> Route Name <span class="text-danger">*</span></div>
							</div>
							<!-- field wrapper end -->
							</div>									 
						</div>	

						<!-- row -->
						<div class="row gutters">
							<div class="col-lg-12">										
								<!-- field wrapper start -->
								<div class="field-wrapper">
								<input type="number"  id="r_amout" name="r_amout" class="form-control" value="$r_amout" required>
								<div class="field-placeholder"> Route Amout <span class="text-danger">*</span></div>
								</div>
								<!-- field wrapper end -->
							</div>									 
						</div>	 

						<!-- row -->
						<div class="row gutters">
							<div class="col-lg-12">										
								<!-- field wrapper start -->
								<div class="field-wrapper">
								<input type="text"  id="r_desc" name="r_desc" value="$r_desc" class="form-control">
									<div class="field-placeholder"> Route Description <span class="text-danger">*</span></div>
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
				
										echo $routeFormTop;	 

										try{
											$staff_arr = staffArrays($conn);  /* school staffs/teachers token information */
											echo staffSelectBox($conn, $staff_arr, $r_master, false);
										}catch(PDOException $e) {				
											fobrainDie( 'Ooops Database Error: ' . $e->getMessage());													
										} 
							

$routeFormBot =<<<IGWEZE

	
								</select>								
								<div class="field-placeholder"> Route Master/Mistress <span class="text-danger">*</span></div>
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
							<input type="hidden" name="route_d" value="update" />
							<button type="submit" class="btn btn-primary waves-effect   
							btn-label waves-light" id="update-route">
								<i class="mdi mdi-content-save label-icon"></i>  Save
							</button>
						</div>
					</div>	
					<!-- /row -->	
				</form> 
				<!-- /form -->

IGWEZE;

				echo $routeFormBot; 
							
				echo '<script type="text/javascript"> 
						hidePageLoader();
						renderSelectImg("#staff", 1);  
					</script>'; exit;
		
			}
		
		}else{ 
		
			echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
		
		}

	
exit;
?>