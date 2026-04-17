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
	This page load school library books
	------------------------------------------------------------------------*/ 


		if (!defined('fobrain')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
				
		require_once $fobrainIconPage; /* This include top middle global icon page eg go back, print buttons etcs */

?>

		
		<!-- row -->		 
		<div <?php echo $fob_view; ?> class="row gutters row-section justify-content-center" id="scroll-target">	
			<div class="col-lg-10 col-12">
				<!-- card start -->
				<div class="card card-shadow">
					<?php 
						$page_title = '<i class="mdi mdi-bookshelf fs-18"></i> 
						Library Books';
						pageTitle($page_title, 0);	 
					?>
					<div class="card-body"> 					

						<div id="lib-book-msg"></div> 
						<div class="table-responsive pt-3">

						<script type='text/javascript'> renderTable(); </script> 
						<!-- table -->
						<table  class='table table-hover table-responsive style-table wiz-table'>
							<thead>
								<tr>
									<th>S/N</th>
									<th>Title</th>
									<th>Author</th>
									<th>Type</th>
									<th>Tasks</th>
								</tr>
							</thead> 
							<tbody>
								
<?php 

		 
$table_head =<<<IGWEZE
        
		 
					
			
IGWEZE;
				
		 
			try {
		 
				
				$ebele_mark = "SELECT book_id, book_name, book_author, book_path, book_type, book_desc, stype, book_status 
				
								FROM $fobrainSchLib 
								
								ORDER BY book_id DESC";
					 
 			    $igweze_prep = $conn->prepare($ebele_mark);
				
 				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count >= $foreal) {
					
					$serial_no = 0;
					echo $table_head;					

					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
	   
						$book_id = $row['book_id'];
						$book_name = $row['book_name'];
						$book_path = $row['book_path'];
						$book_author = $row['book_author'];
						$book_desc = $row['book_desc'];
						$book_type = $row['book_type'];
						$book_status = $row['book_status'];	
						$schoolID = $row['stype']; 
						
						$book_name  = trim($book_name);
						$book_author  = trim($book_author);
						$book_desc  = trim($book_desc); 
					
						$serial_no++;
									
						$bookLibPath =  $fobrainLibDir.$book_path;	
						$bookPicture = libraryUploadsManager($conn, $book_type, $book_path);

						if($book_author == '') { $book_author = 'Anonymous'; }
						
						if($book_type == $fiVal) { 
						
							$showBlink = ' 
							<p class="mb-10">
								<a href="'.$bookLibPath.'" target="_blank" alt="'.$book_name.'" 
								class ="text-danger btn waves-effect btn-label waves-light">									
									<i class="mdi mdi-cloud-download label-icon"></i> Download
								</a>	
							</p>';
							 
						
						}elseif($book_type == $seVal) { 
						
							if($book_status == $fiVal){
								
								
								$bookUserInfo = libraryBookAppStatus($conn, $book_id, $regID, $schoolID); 
								if($bookUserInfo != ""){
									list ($bookStatus, $applyDate, $approveDate, $returnDate) = explode ("@.%.@", $bookUserInfo);
								}else{ $bookStatus = ""; $applyDate = ""; $approveDate = ""; $returnDate = ""; }
												  
								
								if($bookStatus == $fiVal){ 

									$showBlink = '
									<p class="mb-10">
										<a href="javascript:;" alt="'.$book_name.'" 
										class ="text-slateblue btn waves-effect btn-label waves-light">									
											<i class="mdi mdi-account-check label-icon"></i> Appl. Pending
										</a>	
									</p>';
									
								}elseif($bookStatus == $seVal){
									
									$showBlink = '
									<p class="mb-10">
										<a href="javascript:;" alt="'.$book_name.'" 
										class ="text-success btn waves-effect btn-label waves-light">									
											<i class="mdi mdi-account-check label-icon"></i> Assign To You
										</a>	
									</p>';								
									
								}else{
					  
									$showBlink = '
									<p class="mb-10">
										<a href="javascript:;" id="libr-'.$book_id.'-'.$book_name.'-'.$book_author.'" alt="'.$book_name.'" 
										class ="apply-lib-book text-success btn waves-effect btn-label waves-light">									
											<i class="mdi mdi-account-plus label-icon"></i> Borrow
										</a>	
									</p>';	 
								
								}
							
							}else{
							
								$showBlink = ' 
								<p class="mb-10">
									<a href="javascript:;" alt="'.$book_name.'" 
									class ="text-danger btn waves-effect btn-label waves-light">									
										<i class="mdi mdi-close-octagon label-icon"></i> Unavailable
									</a>	
								</p>';
							
							}
							
						
						}else{
							
							$showBlink = '';
						}
						
						
						if($book_type != '') { $book_type = $libraryTypeArr[$book_type]; }
						else{$book_type = '-';}
					
					
					
					
$lib_book =<<<IGWEZE
        
						<tr id='lib_book_row-$book_id'>
							<td>$serial_no</td>
							<td>
								<div class="row align-items-center"> 
									<div class="col text-primary">
										<img src = "$bookPicture" class=" img-h-50 img-circle img-thumbnail">
										$book_name  
									</div>  
								</div>
							</td>
							
							<td>
								<div class="row align-items-center"> 
									<div class="col text-primary">
										 <strong>$book_author</strong> 
									</div>  
								</div>
							</td>

							<td>$book_type</td>
							
							<td>  	
								<div class="btn-group">
									<a href="javascript:;" class="btna btn-tasks  waves-effect waves-light dropdown-toggle p-5" data-bs-toggle="dropdown" aria-haspopup="true"
									data-bs-display="static" aria-expanded="false">
										<i class="mdi mdi-dots-grid align-middle fs-18"></i>
									</a> 
									<div class="dropdown-menu dropdown-menu-lg-end p-10 dropdown-shadow end-0 animate__animated animate__flipInY"> 
										<p class="mb-10">
											<a href='javascript:;' id='$book_id' class ='show-lib-book text-sienna btn waves-effect btn-label waves-light'>									
												<i class="mdi mdi-text-box-search label-icon"></i> View 
											</a>	
										</p>
										<span id='lib-btn-status-$book_id'>$showBlink</span> 
									</div>
								</div> 
							</td> 
						</tr>
		
IGWEZE;
		
						echo $lib_book; 

					}
		

				}else{  /* display error */ 
		
					$msg_i = "Ooops error, no book was found in school library. ";
					echo $infoMsg.$msg_i.$iEnd;  
		
				}
		
			}catch(PDOException $e) {
  			
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			 
			}
	 

?>

					 
								</tbody>
							</table>
							<!-- table -->	
						</div> 

					</div>
				</div>
				<!-- card end -->	
			</div>
		</div>
		<!-- / row -->	   

		<!--  library book view  pop up modal start -->			
		<button type="button" class="btn modal-show-lib display-none"  data-bs-toggle="modal" data-bs-target="#modal-show-lib"></button>				
		<!-- Scrollable modal -->
		<div class="modal fade animate__animated animate__zoomInDown" id="modal-show-lib" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
			<div class="modal-dialog modal-fullscreen-sm-down modal-dialog-scrollable">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalScrollableTitle"> 
							<i class="mdi mdi-content-save label-icon"></i>  
							Book Details
						</h5>
						<div id="editMsg"> </div>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>	
					</div>
					<div class="modal-body slideUpFrmUDiv">
						<div id="lib-show-div"></div> 
					</div>
					<div class="modal-footer">						
						<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		<!-- library book view pop up modal end -->
