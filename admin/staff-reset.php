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
	This script load staff access cpanel
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

    	define('fobrain', 'igweze');  /* define a check for wrong access of file */

		if ($_REQUEST['show_more'] == 0) {
				
			require 'fobrain-config-s.php';  /* load fobrain configuration files */
			$show_more = false;
				
		}elseif ($_REQUEST['show_more'] == 1) {
			
			require 'fobrain-config.php';  /* load fobrain configuration files */
			$show_more = true;
				
		}else{		
		
			exit;  /* else exit or redirect to 404 page */	
		
		} 
		
		if ($_REQUEST['staff'] != '') { 
		 
			try {
		 				
				$staffID = strip_tags($_REQUEST['staff']);
				
				/* script validation */
				
				if($staffID == ""){
					
					echo "<script type='text/javascript'>   hidePageLoader(); </script>";
					$msg_e =  "Ooops, staff record was not found.";
					
				}else{  /* select staff profile */	

					$ebele_mark = "SELECT t_id, i_email, i_title, i_picture, i_firstname, i_lastname, i_midname, t_grade 
					
									FROM $staffTB
									
									WHERE t_id = :t_id";
						 
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':t_id', $staffID);
					 
					$igweze_prep->execute();
					
					$rows_count = $igweze_prep->rowCount(); 
					
					if($rows_count == $foreal) {  /* check array is empty */
					
						while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {  /* loop array */		
		   
							$t_id = $row['t_id'];
							$i_email = $row['i_email'];
							$title = $row['i_title'];
							$pic = $row['i_picture'];
							$fname = $row['i_firstname'];
							$lname = $row['i_lastname'];
							$mname = $row['i_midname']; 
							$t_grade = $row['t_grade'];
						
						}	 
				 
						$serial_no = $foreal++;
										
						$titleVal = wizSelectArray($title, $title_list); 
						$staff_img = picture($staff_pic_ext, $pic, "staff");

						if($t_grade == 1){
							$css_style = "display-none";
						}else{
							$css_style = "";
						}
						 
						if(($admin_grade == $admin_fobrain_grd) && ($admin_level == $admin_tagged)) {  /* check if school admin */		 
						
				        
$staffInfo =<<<IGWEZE

							<!-- row -->
							<div class="row gutters mt-25"> 
								<div class="col-12 text-center">										
									<img src = "$staff_img"  class=" img-h-100 img-circle img-thumbnail">
								</div> 
								<div class="col-12 text-center  text-primary mt-10">										
									$lname $fname $mname 
								</div>															 
							</div>	
							<!-- /row -->
							<hr class="my-15 text-danger"/>
							<!-- row -->
							<div class="row gutters mt-25  mb-30">  
							 
								<div class="col-lg-4 text-center">  
									<div class="col-12 fw-700 text-primary mb-25">										
										Change Username 
									</div>
									<div class="col-12 mb-25" id="new-staff-info">										
										<span id='msg-staff'></span> 
										<input type="email" class="form-control"
										name="staffUser" id="staff-user" placeholder ="Staff Username"
										value="$i_email" maxlength="30"  />
										<div id="staffID" style="display:none;">$t_id</div> 
									</div>
									<div class="col-12 mb-25">										
										<a href="javascript:;"  id='$t_id' class ="change-staff-user demo-disenable btn btn-primary waves-effect   
										btn-label waves-light">
											<i class="mdi mdi-content-save label-icon"></i>  Save
										</a>
									</div>																 
								</div>	
								
								<div class="col-lg-4 text-center"> 
									<div class="col-12 fw-700 text-primary mb-25">										
										Reset Password
									</div>
									<div class="col-12 mb-25 py-15">										
										<div id="staff_new_pass"> ******** </div>
									</div>
									<div class="col-12 mb-25">										
										<a href="javascript:;"  id='$t_id' class ="reset-staff demo-disenable btn btn-dark waves-effect   
										btn-label waves-light">
											<i class="mdi mdi-lock-reset label-icon"></i>  Reset
										</a>
									</div>																 
								</div>	

								<div class="col-lg-4 text-center"> 
									<div class="col-12 fw-700 text-danger mb-25 $css_style">										
										Deactivate  Staff
									</div> 
									<div class="col-12 mb-25 $css_style">	 
										<input type="text" class="form-control"
										name="ad-pass" id="ad-pass" placeholder ="Super Admin Password" />
									</div>
									<div class="col-12 mb-25 $css_style">										
										<a href="javascript:;"  id='$t_id' class ="remove-staff demo-disenable btn btn-danger waves-effect   
										btn-label waves-light">
											<i class="mdi mdi-delete label-icon"></i>  Deactivate
										</a>
									</div>																 
								</div>
							</div>	
							<!-- /row --> 
		
IGWEZE;

							echo $staffInfo;
				
							echo "<script type='text/javascript'>   hidePageLoader(); </script>";
					
						} 

					}else{  /* display error */
					
						echo "<script type='text/javascript'>   hidePageLoader(); </script>";
						$msg_e =  "Ooops, staff record was not found.";
		
		
					}
					
				}
				
			}catch(PDOException $e) {
				
						fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
				 
			} 
		
		}else{ 
					
			echo $userNavPageError; exit;  /* else exit or redirect to 404 page */ 
		
		} 
	
		if ($msg_e) {

         	echo $errorMsg.$msg_e.$eEnd; echo $scroll_up; exit; 						

        }
		
exit;		
?>