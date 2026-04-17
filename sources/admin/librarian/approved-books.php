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
	
*/ 

		if (!defined('fobrain')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
				
		require_once $fobrainIconPage; /* This include top middle global icon page eg go back, print buttons etcs */

?>
 		 		
		<!-- row -->
		<div <?php echo $fob_view; ?> class="row gutters row-section fobrain-section-div justify-content-center">
			<div class="col-xl-8 col-lg-8 col-md-12 col-sm-12">	
				<!-- card start -->
				<div class="card card-shadow"> 
					<?php 
						$page_title = '<i class="mdi mdi-book-check-outline fs-18"></i> 
							Approved Book  Manager';
						pageTitle($page_title, 0);	 
					?> 
					<div id="msg-box"></div> 	
					<div class="card-body">
						<!-- row -->
						<div class="row gutters mt-10">
							 
							<div id="lib-book-msg"></div>
							<div class="table-responsive">

								<script type='text/javascript'> renderTable(); </script>				 
								<!-- table -->
								<table  class='table table-hover table-responsive style-table  mb-100 wiz-table'>
								<thead>
									<tr>
										<th>S/N</th>
										<th>Picture</th> 
										<th>Title</th> 
										<th>Author</th>
										<th>Apply Time</th>
										<th>Tasks</th>
									</tr>
								</thead> 
								<tbody> 
<?php
  	 
							try { 
								
								$ebele_mark = "SELECT b_id, book_id, lib_user, lib_reg, apply_date, stype, sclass, b_status
								
												FROM $fobrainLibApplyTB								
												
												WHERE b_status = :b_status
												
												ORDER BY b_id DESC";
									
								$igweze_prep = $conn->prepare($ebele_mark);
								$igweze_prep->bindValue(':b_status', $seVal);				
								$igweze_prep->execute();
								
								$rows_count = $igweze_prep->rowCount(); 
								
								if($rows_count >= $foreal) {  /* check array is empty */ 
								
									while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {  /* loop array */		
					
										$applyID = $row['b_id'];
										$book_id = $row['book_id'];
										$lib_user = $row['lib_user'];
										$lib_reg = $row['lib_reg'];
										$apply_date = $row['apply_date'];
										$schoolID = $row['stype'];
										$sClassID = $row['sclass'];
										
										$bookInfo = libraryBookInfo($conn, $book_id);  /* school library book information */ 
										list ($book_id, $book_name, $book_path, $book_author, $book_type, $book_status) = explode ("@.%.@", $bookInfo); 
										
										$bookPicture = libraryUploadsManager($conn, $book_type, $book_path);  /* school library book upload manager */ 
										
										if($book_author == '') { $book_author = 'Anonymous'; }						
										
										$apply_date = strtotime($apply_date);
										$applyDate = timerBoy($apply_date);
										//$a = date("h:i:s, d F, Y", $a);
															
										$serial_no++;
									
		
$lib_book =<<<IGWEZE
        
										<tr id='lib_book_row-$applyID'>
											<td>$serial_no</td>
											<td><img src="$bookPicture" alt="book picture" class="img-h-50 img-circle img-thumnail" /> </td>
											<td>$book_name</td>
											<td>$book_author</td>  
											<td> <strong> $applyDate </strong> </td> 	 
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
										echo $lib_book; 

									}
		

								}else{  /* display information */ 
						
									$msg_i = "Ooops, no library pending book was found.";
									echo $infoMsg.$msg_i.$iEnd; 
						
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
						<!-- /row -->	  						 
					</div><!-- end card-body -->	
				</div>
				<!-- card end -->	
			</div>
		</div>
		<!-- / row -->	   

		<!--  fobrain modal start -->			
		<button type="button" class="btn modal-fobrain  display-none"  data-bs-toggle="modal" data-bs-target="#modal-fobrain"></button>				
		<!-- Scrollable modal -->
		<div class="modal fade animate__animated animate__zoomInDown" id="modal-fobrain" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg modal-fullscreen-sm-down modal-dialog-scrollable">
				<div class="modal-content"> 
					<div class="modal-header"> 
						<h5 class="modal-title" id="exampleModalScrollableTitle"> 
							<i class="mdi mdi-book-check-outline label-icon"></i>  
							Approved Book  Manager
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
                 	
                  