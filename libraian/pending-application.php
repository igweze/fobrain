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
	This script handle library book pending application
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

     define('fobrain', 'igweze');  /* define a check for wrong access of file */

        require 'fobrain-config.php';  /* load fobrain configuration files */	    

		if ($_REQUEST['bookID'] != '') {

			try {
		 				
				$applyID = strip_tags($_REQUEST['bookID']);
				
				/* select information */
				
  				$ebele_mark = "SELECT 	b_id, book_id, lib_user, lib_reg, apply_date, stype, b_status
				
								FROM $fobrainLibApplyTB
								
								WHERE  b_id = :b_id";
					 
 			    $igweze_prep = $conn->prepare($ebele_mark);
				$igweze_prep->bindValue(':b_id', $applyID);
 				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count == $foreal) {  /* check array is empty */
				
					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {  /* loop array */		

						$book_id = $row['book_id'];
						$applyID = $row['b_id'];
						$lib_user = $row['lib_user'];
						$lib_reg = $row['lib_reg'];
						$apply_date = $row['apply_date'];
						$schoolID = $row['stype'];

							$ebele_mark_1 = "SELECT book_id, book_name, book_author, book_desc, book_path, book_type, book_hits, book_copies, book_location, 
											stype, sclass, book_status
							
											FROM $fobrainSchLib
											
											WHERE  book_id = :book_id";
								 
							$igweze_prep_1 = $conn->prepare($ebele_mark_1);
							$igweze_prep_1->bindValue(':book_id', $book_id);
							$igweze_prep_1->execute();
							
							$rows_count_1 = $igweze_prep_1->rowCount(); 
							
							if($rows_count_1 == $foreal) {  /* check array is empty */
							
								while($row_1 = $igweze_prep_1->fetch(PDO::FETCH_ASSOC)) {  /* loop array */		
				   
									$book_id = $row_1['book_id'];
									$book_name = $row_1['book_name'];
									$book_author = $row_1['book_author'];
									$book_path = $row_1['book_path'];
									$book_desc = $row_1['book_desc'];
									$book_type = $row_1['book_type'];
									$book_hits = $row_1['book_hits'];
									$book_copies = $row_1['book_copies'];
									$book_location = $row_1['book_location'];
									$book_status = $row_1['book_status']; 
									
								}
								
							}
							
							$book_name  = trim($book_name);
							$book_author  = trim($book_author);
							$book_desc  = trim($book_desc);
							$book_desc = htmlspecialchars_decode($book_desc);
							$book_desc = nl2br($book_desc);
						
					} 

					/*
					$bookInfo = libraryBookInfo($conn, $book_id);
					list ($book_id, $book_name, $book_path, $book_author, $book_type, $book_status) = explode ("@.%.@", $bookInfo);
					
					*/ 

					$bookPicture = libraryUploadsManager($conn, $book_type, $book_path);  /* school library book upload manager */

					if($book_type == $fiVal ){
						
						$bookLocation = '';				
						
					}else{
						
						
						$bookLocation = '<tr><th> Location </th> <td>'.$book_location.'</td> </tr>';
						
					}

					if($book_author == '') { $book_author = 'Anonymous'; }
					if($book_type != '') { $book_type = $libraryTypeArr[$book_type]; }
					else{$book_type = '-';}
					
					
					$bookStatus = $libraryStatusArr[$book_status];
					
					$schoolName = $school_list[$schoolID];		
					
					require $fobrainSchoolTBS; /* include student database table information  */						
					
					$regNum = studentReg($conn, $lib_user);  /* student registration number  */
					
					$student_name = studentName($conn, $regNum);  /* student name  */
	
					$student_img = studentPicture($conn, $regNum);  /* student picture  */
					
						
$bookInfo =<<<IGWEZE

					<!-- row -->
					<div class="row gutters mt-10 mb-20"> 
						<div class="col-12 text-center">
							<h4 class="font-head-1 text-danger fw-500">Approve Book Application</h4>	
						</div>									 
					</div>	
					<!-- /row --> 

					<div class="text-center book-app-loader" id="wait_1" style="display: none;">
						<div class="spinner-border text-danger" role="status">
							<span class="visually-hidden">Loading...</span>
						</div>
					</div>
					
					<div id ="msg-box-app"></div>					
					<div class="slide-div">  
						
						<button class="btn btn-success btn-label waves-light me-10 mb-20 approve-appl-book pull-left"
						id="$applyID-$schoolID-$lib_user">
							<i class="mdi mdi-account-check-outline label-icon"></i> 
							Approve 
						</button> 
								
						<button type="button" class="btn modal-library-pop btn-danger btn-label waves-light 
						me-10 mb-20 pull-right show-discard-div">
							<i class="mdi mdi-account-remove-outline label-icon"></i> 
							Discard  
						</button> 
						<div class="clear-ft"></div>


						<div class="row gutters mt-30 mb-40 discard-appl-div display-none">	 
							<!-- row -- >
							<div class="row gutters"> 
								<div class="col-6 text-center">	
									<h4 class="font-head-1 text-info">Book Info</h4>									
									<img src = "$bookPicture"  class="img-h-100 img-thumbnail rounded-circle"> 									 
									<p class="text-dark"><b> Discard Book Application :</b><br /> $book_name By $book_author </p>  
								</div>	
								<div class="col-6 text-center">	
									<h4 class="font-head-1 text-info">Student Info</h4>									
									<img src = "$student_img"  class="img-h-100 img-thumbnail rounded-circle"> 									 
									<p class="text-dark"><b> Applied By :</b><br /> $student_name</p>  
								</div>									 
							</div>	
							<!-- /row -->

							<!-- row -->
							<div class="row gutters  mt-30"> 
								<div class="col-12">										
									<!-- field wrapper start -->
									<div class="field-wrapper">                                                            
										<input type="text" class="form-control" placeholder="Reason/s - Optional"
										name="discard-reason" maxlength="100" id="discard-reason" />           
										<div class="field-placeholder"> Reason/s <span class="text-danger"> Optional </span></div>										 
									</div>
									<!-- field wrapper end -->
								</div>									 
							</div>	
							<!-- /row --> 

							<!-- row -->
							<div class="row gutters  mt-30 mb-30"> 
								<div class="col-12 text-end">										
									<button class="btn btn-danger btn-label waves-light discard-book-app"
									id="$applyID-$schoolID-$lib_user">
										<i class="mdi mdi-account-remove-outline label-icon"></i> 
										Yes Discard !
									</button> 
								</div>									 
							</div>	
							<!-- /row -->  
							
						</div>  


						<!-- row -->
						<div class="row gutters">
							<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-20">		
							
								<!-- table -->
								<table class="table table-hover table-responsive view-table"> 
									<tr>
										<td colspan = '2' class="font-head-1 font-size-18 text-info text-center">
											<center>Library Book Detail</center>
										</td>
									</tr>
									<tr>
										<td colspan = '2'>
											<center><img src = "$bookPicture" class="img-h-100 img-thumbnail rounded-circle"> </center> 
										</td>
									</tr>        
									<tr>
										<th>
											Type 
										</th> 
										<td> $book_type </td>
									</tr>

									<tr>
										<th>
											Title
										</th> 
										<td>  $book_name </td>
									</tr>
									
									<tr>
										<th>
											Author 
										</th> 
										<td>$book_author</td> 
									</tr>

									<tr>
										<th>
											Descriptions 
										</td> 
										<td>$book_desc</td> 
									</tr>
									
									$bookLocation

								</table>
								<!-- / table -->
								 
							</div>									 
							
							<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-20">	
							
								<!-- table -->
								<table class="table table-hover table-responsive view-table"> 

									<tr>
										<td colspan = '2' class="font-head-1 font-size-18 text-info text-center">
											<center>Student Information</center>  
										</td>  
									</tr>
									<tr>
										<td colspan = '2'>
											<center><img src = "$student_img" class="img-h-100 img-thumbnail rounded-circle"> </center> 
										</td>
									</tr> 
								
									<tr>
										<th>
											RegNum 
										</th> 
										<td>$regNum</td> 
									</tr>
									
									<tr>
										<th>
											Name 
										</th> 
										<td>$student_name</td> 
									</tr>
									
									<tr>
										<th>
											School
										</td> 
										<td>$schoolName</td> 
									</tr> 

								</table>
								<!-- / table -->
								 
							</div>									 
						</div>	
						<!-- /row --> 
						
						
					</div>
			
IGWEZE;

					echo $bookInfo;
					echo "<script type='text/javascript'> hidePageLoader();	</script>";	exit;
							

				}else{ /* display information message */
				
					$msg_e =  "Ooops error, this library book information was not found.";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'> hidePageLoader();	</script>";	 exit; 			
					
				}
					
			}catch(PDOException $e) {
				
				fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
				 
			} 
		
		}else{ 
		
			echo $userNavPageError; exit;  /* else exit or redirect to 404 page */ 
		
		}  		
exit;		
?>	