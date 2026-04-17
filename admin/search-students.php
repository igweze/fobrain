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
	This script handle search class and student profiles
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

            define('fobrain', 'igweze');  /* define a check for wrong access of file */

            require 'fobrain-config.php';  /* load fobrain configuration files */	   

		 
			try {
			 
				$levelArray = studentLevelsArray($conn);
					
			}catch(PDOException $e) {
				
				fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
				 
			}
	
			
			  
?>

		<script type='text/javascript'>  renderTable(); </script>
		<div class="table-responsive">
			<!-- table -->
			<table class='table table-hover table-responsive style-table wiz-table' width="100%" id="wiz-table">					
				<thead>
					<tr>      
						<th>S/N</th>
						<th>Reg. No.</th>
						<th>Picture</th> 
						<th>Name</th>
						<th>DOB</th>
						<th>Gender</th>
						<th>Guradian</th>
						<th>Phone No.</th>
						<th>Tasks</th>
					</tr>
				</thead> 
				<tbody>           
		 

		<?php 
 
			
			if ($_REQUEST['searchData'] == 'searchProfSess') {  /* search class profile */		 
			    
				try { 
				
					$session = $_REQUEST['sess']; 
					$level = $_REQUEST['level'];

					$class_data = $_REQUEST['class'];

					list ($class, $class_val) = explode ("@+@", $class_data);
					
					$session = strip_tags($session);
					$class = strip_tags($class);
					$level = strip_tags($level);								
					
					/* script validation */
					
					if (($session == '') || ($level == '') || ($class == '')) {
					
						$msg_e =  $formErrorMsg;					
						echo $errorMsg.$msg_e.$eEnd;   //exit; 			
									
					}else{  /* search class profile */
					
						$session_se  = $session + $foreal; 
			 
						$mClass = studentClassLevel($level);  /* retrieve student class */
						$sessionID = sessionID($conn, $session);  /* school session  */
						$session_fi = fobrainSession($conn, $sessionID);  /* school session ID  */
								 
						$session_se = $session_fi + $foreal;  
						
						$ebele_mark = "SELECT r.ireg_id, nk_regno, s.stu_id, i_stupic, i_firstname, i_lastname, i_midname,
										i_gender, i_dob, i_sponsor, i_spo_phone
						
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
						
						if($rows_count >= $foreal) {  /* check array is empty */ 							
						
							while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {  /* loop array */		
			   
								$regNo = $row['nk_regno'];
								$regNoID = $row['ireg_id'];
								$pic = $row['i_stupic'];
								$fname = $row['i_firstname'];
								$lname = $row['i_lastname'];
								$mname = $row['i_midname'];
								$gender = $row['i_gender'];
								$date = $row['i_dob']; 
								$sponsor = $row['i_sponsor'];
								$sphone = $row['i_spo_phone']; 

								$genderM = wizSelectArray($gender, $gender_list);
								$student_img = picture($school_pic_dir.$session_fi.'_'.$session_se.'/', $pic, "student"); 
								
								$serial_no++; 
								
								if(($admin_grade == $admin_fobrain_grd) && ($admin_level == $admin_tagged) ||
								($admin_grade == $hm_fobrain_grd) && ($admin_level == $hm_fob_tagged)) {	/* check if this user is the main admin or school head */
								
									//$bioPicDiv = 'bioPicDiv-'.$regNo;
									//$bioNameDiv = 'bioNameDiv-'.$regNo;
									//<td>$serial_no</td>
					
$table_ed =<<<IGWEZE
        
								<tr id='student-row-$regNoID'>
									<td width="5%">$serial_no</td>
									<td width="10%"> <a href='javascript:;' id='$regNo' class ='view-student'>$regNo </a> </td>
									<td width="10%">  
										<a href='javascript:;' id='$regNo' class ='view-student'>
											<img src = "$student_img" class=" img-h-50 img-circle img-thumbnail">
										</a>  
									</td>

									<td width="25%"> 		 	
										<a href='javascript:;' id='$regNo' class ='view-student'>
											$lname $fname $mname 
										</a>    
									</td> 
									<td>$date</td>
									<td>$genderM</td>
									<td>$sponsor</td>
									<td>$sphone</td>  
									<td>
										<div class="btn-group">
											<a href="javascript:;" class="btna btn-tasks  waves-effect waves-light dropdown-toggle p-5" data-bs-toggle="dropdown" aria-haspopup="true"
											data-bs-display="static" aria-expanded="false">
												<i class="mdi mdi-dots-grid align-middle fs-18"></i>
											</a> 
											<div class="dropdown-menu dropdown-menu-lg-end p-10 dropdown-shadow end-0 animate__animated animate__flipInY"> 
												<p class="mb-10">
													<a href='javascript:;' id='$regNo' class ='view-student text-sienna btn waves-effect btn-label waves-light'>									
														<i class="mdi mdi-text-box-search label-icon"></i> View 
													</a>	
												</p>
												<p class="mb-10">
													<a href='javascript:;' id='$regNo' class ='edit-profile text-slateblue btn waves-effect btn-label waves-light'>									
														<i class="mdi mdi-square-edit-outline label-icon"></i> Edit
													</a>	
												</p>
											
												<p class="mb-10">
													<a href='javascript:;' id='$regNo' class ='student-id-card text-primary btn waves-effect btn-label waves-light'>									
														<i class="mdi mdi-square-edit-outline label-icon"></i> ID Card
													</a>	
												</p>
												
												<p>
													<a href='javascript:;' id='$regNo' class ='reset-student text-danger btn waves-effect btn-label waves-light'>									
														<i class="mdi mdi-delete label-icon"></i> Reset
													</a>	
												</p> 
											</div>
										</div>    
									</td> 
								</tr>
		
IGWEZE;
									echo $table_ed;
		
								}else{  /* check if school staff */
						
									 
					
$table_ad =<<<IGWEZE
			
									<tr id='student-row-$regNoID'>
										<td width="5%">$serial_no</td>
										<td width="10%"> <a href='javascript:;' id='$regNo' class ='view-student'>$regNo </a> </td>
										<td width="10%">  
											<a href='javascript:;' id='$regNo' class ='view-student'>
												<img src = "$student_img" class=" img-h-50 img-circle img-thumbnail">
											</a>  
										</td>

										<td width="25%"> 		 	
											<a href='javascript:;' id='$regNo' class ='view-student'>
												$lname $fname $mname 
											</a>    
										</td> 
										<td>$date</td>
										<td>$genderM</td>
										<td>$sponsor</td>
										<td>$sphone</td>  
										<td>
											<div class="btn-group">
												<a href="javascript:;" class="btna btn-tasks  waves-effect waves-light dropdown-toggle p-5" data-bs-toggle="dropdown" aria-haspopup="true"
												data-bs-display="static" aria-expanded="false">
													<i class="mdi mdi-dots-grid align-middle fs-18"></i>
												</a> 
												<div class="dropdown-menu dropdown-menu-lg-end p-10 dropdown-shadow end-0 animate__animated animate__flipInY"> 
													<p class="mb-10">
														<a href='javascript:;' id='$regNo' class ='view-student text-sienna btn waves-effect btn-label waves-light'>									
															<i class="mdi mdi-text-box-search label-icon"></i> View 
														</a>	
													</p> 
													<p class="mb-10">
														<a href='javascript:;' id='$regNo' class ='student-id-card text-primary btn waves-effect btn-label waves-light'>									
															<i class="mdi mdi-square-edit-outline label-icon"></i> ID Card
														</a>	
													</p>
													  
												</div>
											</div>    
										</td> 
									</tr>		
IGWEZE;
									echo $table_ad; 
					
								}

							}
		

						}else{  /* display error */
							
							$classLevel = $levelArray[$level-1]['level'];		
							$errMo = "$session - $session_se session $classLevel $class";	
							$msg_e = "Ooops error, no record was found for <b>$errMo</b>"; 
							echo $erroMsg.$msg_e.$msgEnd;
						
						}
					
					}
		 
						
						
				}catch(PDOException $e) {
				
						fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
				 
				}		
		
			}elseif($_REQUEST['searchData'] == 'searchWord'){  /* search student profile */		 
		
				/* script validation */ 
				
				if ($_REQUEST['queryWord'] == '') {
					
					$msg_e =  $formErrorMsg;
					
					echo $errorMsg.$msg_e.$eEnd;  //exit; 			
					
				}else{  /* search student profile */	
				  
				 
					try {
						
						$queryWord = $_REQUEST['queryWord'];	 $queryWord_S = $queryWord;	
						$queryWord = preg_replace("/[^A-Za-z0-9 ]/", " ", $queryWord);

						$ebele_mark = "SELECT r.ireg_id, nk_regno, s.stu_id, i_stupic, i_firstname, i_lastname, i_midname, 
									i_gender, i_dob, i_sponsor, i_spo_phone, y.year

							 FROM $i_reg_tb r, $i_student_tb s, $schoolSessionTB y

							 WHERE 	(s.i_firstname LIKE :i_firstname
							 
							 OR  s.i_lastname LIKE :i_lastname
							 
							 OR  s.i_midname LIKE :i_midname
							 
							 OR  r.nk_regno LIKE :nk_regno)
							 
							 AND r.ireg_id = s.ireg_id
							 
							 AND r.session_id = y.ID_SESS";
							 
						$igweze_prep = $conn->prepare($ebele_mark); 
						$igweze_prep->bindValue(':i_firstname', '%'.$queryWord.'%');
						$igweze_prep->bindValue(':i_lastname', '%'.$queryWord.'%');
						$igweze_prep->bindValue(':i_midname', '%'.$queryWord.'%');
						$igweze_prep->bindValue(':nk_regno', '%'.$queryWord.'%');
										
						 
						$igweze_prep->execute();
						
						$rows_count = $igweze_prep->rowCount(); 
						
						if($rows_count >= $foreal) {  /* check array is empty */ 
						
							while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {  /* loop array */		
			   
								$regNo = $row['nk_regno'];
								$regNoID = $row['ireg_id'];
								$pic = $row['i_stupic'];
								$fname = $row['i_firstname'];
								$lname = $row['i_lastname'];
								$mname = $row['i_midname'];
								$session_fi = $row['year'];
								$gender = $row['i_gender'];
								$date = $row['i_dob']; 
								$sponsor = $row['i_sponsor'];
								$sphone = $row['i_spo_phone']; 
								
								$stringReplace = explode(' ', $queryWord);
								
								$replaceString = array_map('fobrainHighlight', $stringReplace);
								
								$regNoRep = str_ireplace($stringReplace, $replaceString, $regNo);
								$lnameRep = str_ireplace($stringReplace, $replaceString, $lname);
								$fnameRep = str_ireplace($stringReplace, $replaceString, $fname);
								$mnameRep = str_ireplace($stringReplace, $replaceString, $mname); 
								
								$session_se = $session_fi + $fiVal;  

								$genderM = wizSelectArray($gender, $gender_list);
								$student_img = picture($school_pic_dir.$session_fi.'_'.$session_se.'/', $pic, "student"); 
						
								$serial_no++; 
								
								if(($admin_grade == $admin_fobrain_grd) && ($admin_level == $admin_tagged) ||
								($admin_grade == $hm_fobrain_grd) && ($admin_level == $hm_fob_tagged)) {	/* check if this user is the main admin or school head */
							 
								 
					
$table_ed =<<<IGWEZE
        

									<tr id='student-row-$regNoID'>
										<td width="5%">$serial_no</td>
										<td width="10%"> <a href='javascript:;' id='$regNo' class ='view-student'>$regNoRep</a> </td>
										<td width="10%">  
											<a href='javascript:;' id='$regNo' class ='view-student'>
												<img src = "$student_img" class=" img-h-50 img-circle img-thumbnail">
											</a>  
										</td>

										<td width="25%"> 		 	
											<a href='javascript:;' id='$regNo' class ='view-student'>
											$lnameRep $fnameRep $mnameRep
											</a>    
										</td> 
										 
										<td>$date</td>
										<td>$genderM</td>
										<td>$sponsor</td>
										<td>$sphone</td>  
										<td>
											<div class="btn-group">
												<a href="javascript:;" class="btna btn-tasks  waves-effect waves-light dropdown-toggle p-5" data-bs-toggle="dropdown" aria-haspopup="true"
												data-bs-display="static" aria-expanded="false">
													<i class="mdi mdi-dots-grid align-middle fs-18"></i>
												</a> 
												<div class="dropdown-menu dropdown-menu-lg-end p-10 dropdown-shadow end-0 animate__animated animate__flipInY"> 
													<p class="mb-10">
														<a href='javascript:;' id='$regNo' class ='view-student text-sienna btn waves-effect btn-label waves-light'>									
															<i class="mdi mdi-text-box-search label-icon"></i> View 
														</a>	
													</p>
													<p class="mb-10">
														<a href='javascript:;' id='$regNo' class ='edit-profile text-slateblue btn waves-effect btn-label waves-light'>									
															<i class="mdi mdi-square-edit-outline label-icon"></i> Edit
														</a>	
													</p>
												
													<p class="mb-10">
														<a href='javascript:;' id='$regNo' class ='student-id-card text-primary btn waves-effect btn-label waves-light'>									
															<i class="mdi mdi-square-edit-outline label-icon"></i> ID Card
														</a>	
													</p>
													
													<p>
														<a href='javascript:;' id='$regNo' class ='reset-student text-danger btn waves-effect btn-label waves-light'>									
															<i class="mdi mdi-delete label-icon"></i> Reset
														</a>	
													</p> 
												</div>
											</div>    
										</td> 
									</tr>

IGWEZE;
									echo $table_ed; 
	
								}else{  /* check if school staff */						
									//<td width = '5%'>$serial_no</td>						
					
$table_ad =<<<IGWEZE
        
									<tr id='student-row-$regNoID'>
										<td>$serial_no</td>
										<td width="10%"> <a href='javascript:;' id='$regNo' class ='view-student'>$regNoRep</a> </td>
										<td width="10%">  
											<a href='javascript:;' id='$regNo' class ='view-student'>
												<img src = "$student_img" class=" img-h-50 img-circle img-thumbnail" id = 'loadNewPic-$regNo'>
											</a>  
										</td>

										<td width="25%"> 		 	
											<a href='javascript:;' id='$regNo' class ='view-student'>
											<span id = 'wiz-student-$regNo'> $lnameRep $fnameRep $mnameRep <span>
											</a>    
										</td>  
										
										<td>$date</td>
										<td>$genderM</td>
										<td>$sponsor</td>
										<td>$sphone</td>  
										<td>
											<div class="btn-group">
												<a href="javascript:;" class="btna btn-tasks  waves-effect waves-light dropdown-toggle p-5" data-bs-toggle="dropdown" aria-haspopup="true"
												data-bs-display="static" aria-expanded="false">
													<i class="mdi mdi-dots-grid align-middle fs-18"></i>
												</a> 
												<div class="dropdown-menu dropdown-menu-lg-end p-10 dropdown-shadow end-0 animate__animated animate__flipInY"> 
													<p class="mb-10">
														<a href='javascript:;' id='$regNo' class ='view-student text-sienna btn waves-effect btn-label waves-light'>									
															<i class="mdi mdi-text-box-search label-icon"></i> View 
														</a>	
													</p>  
													<p class="mb-10">
														<a href='javascript:;' id='$regNo' class ='student-id-card text-primary btn waves-effect btn-label waves-light'>									
															<i class="mdi mdi-square-edit-outline label-icon"></i> ID Card
														</a>	
													</p> 
												</div>
											</div>    
										</td> 
									</tr>

		
IGWEZE;
									echo $table_ad; 
					
								}

		
							} 
							
								

						}else{  /* display error */ 
		
							$msg_e =  "Ooops error, student record with <b>$queryWord_S</b> was not found. please try search for a single word e.g. Nkiru,P, 001, Osinachi etc"; 
							echo $errorMsg.$msg_e.$eEnd; 
						}
				
					}catch(PDOException $e) {
						
								fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
						 
					}
				}
		
				 
				
			}else{		
			
					echo $userNavPageError; exit;  /* else exit or redirect to 404 page */ 
		
			}
		  
		
?>
				</tbody>
			</table>				
			<!-- / table -->
		</div>		        

		<script type='text/javascript'> hidePageLoader();	</script>

		