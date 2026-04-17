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
	This script handle library book edit
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

    	 define('fobrain', 'igweze');  /* define a check for wrong access of file */

        require 'fobrain-config.php';  /* load fobrain configuration files */	 
		 	 
		if ($_REQUEST['bookID'] != '') {

			try {
		 				
				$bookID = $_REQUEST['bookID'];

  				$ebele_mark = "SELECT book_id, book_name, book_author, book_desc, book_path, book_type, book_copies, book_location, 
								stype, sclass, book_status
				
								FROM $fobrainSchLib
								
								WHERE book_id = :book_id";
					 
 			    $igweze_prep = $conn->prepare($ebele_mark); 
				$igweze_prep->bindValue(':book_id', $bookID);
 				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count == $foreal) {  /* check array is empty */
				
					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {  /* loop array */		
	   
						$book_id = $row['book_id'];
						$book_name = $row['book_name'];
						$book_author = $row['book_author'];
						$book_path = $row['book_path'];
						$book_desc = $row['book_desc'];
						$book_type = $row['book_type'];
						$book_copies = $row['book_copies'];
						$book_location = $row['book_location'];
						$book_status = $row['book_status'];
						
					}  
				
					$book_name  = trim($book_name);
					$book_author  = trim($book_author);
					$book_desc  = trim($book_desc);
					$book_desc = htmlspecialchars_decode($book_desc);
					$book_desc = nl2br($book_desc);
					
					$bookPicture = libraryUploadsManager($conn, $book_type, $book_path);  /* school library book upload manager */  
						
?>
				<!-- row -->
				<div class="row gutters mt-10 mb-20"> 
					<div class="col-12 text-center">
						<h4 class="font-head-1 text-danger fw-500">Edit Library Book </h4>	
					</div>									 
				</div>	
				<!-- /row --> 
				
				<div class="msg-box"></div>  
				<!-- form -->
				<form method="POST" id = "frmLibrary"  enctype="multipart/form-data">
					<!-- row -->
					<div class="row gutters"> 
						<div class="col-12">										
							<!-- field wrapper start -->
							<div class="field-wrapper"> 	
							 	<select class="form-control wiz-select"  id="book-type" name="book-type" required>
							  
									<option value = "">Please select One</option>

									<?php

										foreach($libraryTypeArr as $typeB => $typeBB){  /* loop array */

										if ( $book_type == $typeB){
											$selected = "SELECTED";
										} else {
											$selected = "";
										}

											echo '<option value="'.$typeB.'"'.$selected.'>'.$typeBB.'</option>' ."\r\n";

										}

									?> 
								</select>
								<div class="field-placeholder"> Book Type  <span class="text-danger">*</span></div>										 
							</div>
							<!-- field wrapper end -->
						</div>									 
					</div>	
					<!-- /row --> 

					<!-- row -->					
					<div class="row gutters book-picture-div" id="book-picture-div"  style="display:none">
						<div class="col-12 text-center">				
							<div class="picture-div mb-10">
								<img src="<?php echo $bookPicture; ?>" id="preview-picture-1" alt="Book Picture" class="img-h-150 rounded img-thumbnail" />
							</div> 
							<!-- file-wrapper start -->
							<div class="file-wrapper">
								<label class="upload">
									<i class="mdi mdi-cloud-upload-outline fs-24 text-danger"></i> 
									<input type="file" name="book-lib-upload" id="book-lib-upload" class="form-control hide"> 
								</label> 
								<div class="form-text"> 
									<span id="allow-format-pic">Only max image size of 2MB &amp; format of <?php echo $allowedPicExt; ?> are allowed.</span> 
									<span id="allow-format-doc">Only max file size of 10MB &amp; format of <?php echo $allowedDocExt; ?> are allowed.</span>  
									<input type="hidden" name="library-data" value="update-lib-book-upload" />
									<input type="hidden" name="bookID" value="<?php echo $book_id; ?>" />
									<input type="hidden" name="lib-book-name" value="<?php echo $book_name; ?>" />
									<input type="hidden" name="lib-book-path" value="<?php echo $book_path; ?>" />
									<input type="hidden" name="allow-format" id="allow-format" value="" />	
																		
									<div class="text-danger" id="book-name-display">Upload Book</div>
								</div>
							</div>
							<!-- file-wrapper end --> 	
						</div> 														 
					</div>	
					<!-- /row --> 	

				</form>
				<!-- / form -->
					
				<hr class="my-20  text-danger"/> 
					
				<!-- form -->
				<form class="form-horizontal" id="frmupdateLibrary" role="form"> 

					<!-- row -->
					<div class="row gutters"> 
						<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">										
							<!-- field wrapper start -->
							<div class="field-wrapper"> 
								<input type="text" class="form-control" placeholder="Book Title"  value="<?php echo $book_name; ?>"
								name="book-name" maxlength="100" id="book-name" style="text-transform:capitalize !important;" required />
								<div class="field-placeholder"> Title  <span class="text-danger">*</span></div>										 
							</div>
							<!-- field wrapper end -->
						</div>									 
					 
						<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">										
							<!-- field wrapper start -->
							<div class="field-wrapper"> 
								<input type="text" class="form-control" placeholder="Author Name"  value="<?php echo $book_author; ?>"
								name="book-author" maxlength="100" id="book-author" style="text-transform:capitalize !important;" required />
								<div class="field-placeholder"> Author  <span class="text-danger">*</span></div>										 
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
								<textarea rows="4" cols="10" class="form-control" name="book-desc" id="book-desc" 
								placeholder="Book Descriptions"><?php echo $book_desc; ?></textarea>
								<div class="field-placeholder"> Book Descriptions <span class="text-danger">*</span></div>										 
							</div>
							<!-- field wrapper end -->
						</div>									 
					</div>	
					<!-- /row -->   

					<!-- row -->
					<div class="row gutters book-harhcopy-divs"> 
						<div class="col-12">										
							<!-- field wrapper start -->
							<div class="field-wrapper"> 							  
								<input type="text" class="form-control" placeholder="Library Book Location"  
								value="<?php echo $book_location; ?>"
								name="book-location" maxlength="255" id="book-location" style="text-transform: capitalize !important;"/>
								<div class="field-placeholder">  Book Location  <span class="text-danger">*</span></div>										 
							</div>
							<!-- field wrapper end -->
						</div>									 
					</div>	
					<!-- /row --> 
													
					<!-- row -->
					<div class="row gutters book-harhcopy-divs"> 
						<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">										
							<!-- field wrapper start -->
							<div class="field-wrapper"> 							  
								<input type="number" class="form-control" placeholder="Book Copies" value="<?php echo $book_copies; ?>" 
								name="book-copies" maxlength="5" id="book-copies" style="text-transform:capitalize !important;" required />
								<div class="field-placeholder"> No. of Copies  <span class="text-danger">*</span></div>										 
							</div>
							<!-- field wrapper end -->
						</div>	
						<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">										
							<!-- field wrapper start -->
							<div class="field-wrapper"> 							  							  
							  	<select class="form-control wiz-select"  id="book-status" name="book-status" required>
									<?php

										foreach($libraryStatusArr as $status => $statusN){  /* loop array */

											if ( $book_status == $status){
												$selected = "SELECTED";
											} else {
												$selected = "";
											}

											echo '<option value="'.$status.'"'.$selected.'>'.$statusN.'</option>' ."\r\n";

										}

									?> 
								</select>                     
								<div class="field-placeholder"> Status  <span class="text-danger">*</span></div>										 
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
							<input type="hidden" name="bookID" value="<?php echo $book_id; ?>" />
							<input type="hidden" name="library-data" value="update-lib-book" />
							<button type="submit" class="btn btn-primary waves-effect   
							btn-label waves-light" id="updateLibrary">
								<i class="mdi mdi-content-save label-icon"></i>  Update
							</button>
						</div>
					</div>	
					<!-- /row -->
					 
				</form>
				<!-- / form -->
				
				<script type="text/javascript">	 

					$('.wiz-select').each(function() {  
						renderSelect($('#'+this.id)); 
					});   
					$('#book-type').change();  
					hidePageLoader();

				</script>  
				 
<?php
        
				}else{  /* display information message */ 
				
					$msg_e =  "Ooops error, this library book information was not found.";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'> hidePageLoader();	</script>";	 
					exit; 			
					
				}
					
			}catch(PDOException $e) {
				
				fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
				 
			} 
		
		}else{ 
		
			echo $userNavPageError; exit;  /* else exit or redirect to 404 page */ 
		
		}  
exit;		
?>