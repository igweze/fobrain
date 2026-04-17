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
	This page load librainain dashboard
	------------------------------------------------------------------------*/  

if(!session_id()){
    session_start();
}

		if (!defined('fobrain')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');

         require 'fobrain-config.php';  /* load fobrain configuration files */	

		 try{		

				$eBookNum = libraryBookTypeTotal($conn, $fiVal);  /* school library book type summary */
				$hBookNum = libraryBookTypeTotal($conn, $seVal);  /* school library book type summary */

			}catch(PDOException $e) {
  			
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			 
			}			

			//require_once ($fobrainGlobalDir.'/widgets.php');   /* include page widget */ 
?>
 
		<style> 
			div.timeline {
				width: 100% !important; 
			} 
		</style>  
				
		<!-- row -->
		<div class="row gutters widget justify-content-center">
			<div class="col-12">	
				<!-- card start -->
				<div class="card card-shadow"> 
					<?php 
						$page_title = '<i class="mdi mdi-book-clock-outline fs-18"></i> 
							Expired <span class="hide-res">Library</span> Book ';
						pageTitle($page_title, 0);	 
					?>					
					<div class="card-body">
						 
						<script type='text/javascript'> renderTable(); </script>				 
						<!-- table -->
						<table  class='table table-hover table-responsive style-table wiz-table'>
							<thead>
								<tr>
									<th>App. ID</th>
									<th>Book Details</th> 
									<th>Student Details</th> 
									<th>School</th> 
									<th>Book Status</th> 
									<th>Tasks</th>
								</tr>
							</thead> 
							<tbody>

<?php		 
		
  
						try{
							
							$libConfigsArray = libraryConfigsArrays($conn);  /* school library book array */
							
							$timeDateline = $libConfigsArray[0]['book_dateline'];
							
							if($timeDateline == '') {$timeDateline = $libDefaultTime;}
							
							$ebele_mark = "SELECT b_id, book_id, lib_user, lib_reg, apply_date, stype, sclass, b_status
							
											FROM $fobrainLibApplyTB
											
											WHERE  approve_date	<= NOW() - INTERVAL $timeDateline
											
											AND b_status = :b_status
											
											ORDER BY b_id DESC";
								
							$igweze_prep = $conn->prepare($ebele_mark);
							$igweze_prep->bindValue(':b_status', $seVal);
							$igweze_prep->execute();
							
							$rows_count = $igweze_prep->rowCount(); 
							
							if($rows_count >= $foreal) {  /* check array is empty */ 
								
								while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {  /* loop array */		

									$book_id = $row['book_id'];
									$applyID = $row['b_id'];
									$lib_user = $row['lib_user'];
									$lib_reg = $row['lib_reg'];
									$apply_date = $row['apply_date'];						
									$schoolID = $row['stype'];
									$sClassID = $row['sclass'];
									$b_status = $row['b_status'];


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

									$bookPicture = libraryUploadsManager($conn, $book_type, $book_path);  /* school library book upload manager */ 

									if($book_type == $fiVal ){
										
										$bookLocation = '';				
										
									}else{
										
										
										$bookLocation = '<tr>
															<th>
																Book Location 
															</th>
															<td>'.$book_location.'</td> 
														</tr>';
										
									}

									if($book_author == '') { $book_author = 'Anonymous'; }
									if($book_type != '') { $book_type = $libraryTypeArr[$book_type]; }
									else{$book_type = '-';}
									
									
									$bookStatus = $libraryAppStatusArr[$b_status];
									
									$schoolName = $school_list[$schoolID];
									
									require $fobrainSchoolTBS;						
									
									$regNum = studentReg($conn, $lib_user);  /* student registration number  */
									
									$student_name = studentName($conn, $regNum);  /* student name  */
					
									$student_img = studentPicture($conn, $regNum);  /* student profile picture  */
					
						
$bookInfo =<<<IGWEZE


									<tr>
										<td> App-$applyID </td>
										<td>
										<img src = "$bookPicture" style="width: 30px; height: 30px; float:left; border-radius: 20px; padding-right: 5px"> $book_name <br /> By $book_author </td> 
										<td>
										<img src = "$student_img" style="width: 30px; height: 30px; float:left; border-radius: 20px; padding-right: 5px"> $regNum <br /> $student_name </td> 
										<td>$schoolName</td> 
										<td>$bookStatus </td> 
										<td>
											<div id='book-path-$book_id' style='display:none;'>$book_path</div>
												<div class="btn-group">
												<a href="javascript:;" class="btna btn-tasks  waves-effect waves-light dropdown-toggle p-5" data-bs-toggle="dropdown" aria-haspopup="true"
												data-bs-display="static" aria-expanded="false">
													<i class="mdi mdi-dots-grid align-middle fs-18"></i>
												</a> 
												<div class="dropdown-menu dropdown-menu-lg-end p-10 dropdown-shadow end-0 animate__animated animate__flipInY"> 
												
													<p class="mb-10">
														<a href='javascript:;' id ="$book_id" class ='book-history text-primary btn waves-effect btn-label waves-light'>									
															<i class="mdi mdi-history label-icon"></i>  History
														</a>	
													</p>
													<p class="mb-10">
														<a href='javascript:;' id ="$book_id" class ='show-lib-book text-sienna btn waves-effect btn-label waves-light'>									
															<i class="mdi mdi-text-box-search label-icon"></i> Book 
														</a>	
													</p>
													<p class="mb-10">
														<a href='javascript:;' id='$schoolID-$lib_user'  class ='student-book-history text-slateblue btn waves-effect btn-label waves-light'>									
															<i class="mdi mdi-account-clock-outline label-icon"></i> Student
														</a>	
													</p>
													<p>
														<a href='javascript:;' id ="$applyID" class ='approve-book text-success btn waves-effect btn-label waves-light'>									
															<i class="mdi mdi-list-status label-icon"></i> Certify
														</a>	
													</p> 
												</div>
											</div>	 
										
										</td>
									</tr>  
		
IGWEZE;

									echo $bookInfo; 
				
								} 

							}else{  /* display information message */ 
						
								$msg_i =  "Ooops, no library book has exceeded its dateline. Thanks";
								echo $infMsg.$msg_i.$msgEnd; 
							
							}
							
						}catch(PDOException $e) {
						
								fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
						
						}
	 	
?>							
								</tbody>
							</table>
							<!-- / table -->
						</div>

					</div><!-- end card-body -->	
				</div>
				<!-- card end -->	
			</div>
		</div>
		<!-- / row -->	 


		<?php require_once ($fobrainAdminGlobalDir.'common-dashboard.php'); ?>


		<!--  fobrain modal start -->			
		<button type="button" class="btn modal-fobrain  display-none"  data-bs-toggle="modal" data-bs-target="#modal-fobrain"></button>				
		<!-- Scrollable modal -->
		<div class="modal fade animate__animated animate__zoomInDown" id="modal-fobrain" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg modal-fullscreen-sm-down modal-dialog-scrollable">
				<div class="modal-content"> 
					<div class="modal-header"> 
						<h5 class="modal-title" id="exampleModalScrollableTitle"> 
							<i class="mdi mdi-book-check-outline label-icon"></i>  
							Library  Manager
						</h5>									 
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div id="edit-msg"> </div> 
					<div class="modal-body">
						<div id="modal-load-div" class="pb-70"></div> 
					</div>					 
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		<!-- fobrain modal end --> 		
		<div id="remove-msg"> </div>	
		<div id="msg-box"></div>
			  
		 