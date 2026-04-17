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
	This script handle student library history
	------------------------------------------------------------------------*/ 


		if (!defined('fobrain')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
				
		require_once $fobrainIconPage; /* This include top middle global icon page eg go back, print buttons etcs */

?>


		<!-- row --> 
		<div <?php echo $fob_view; ?> class="row gutters row-section fobrain-section-div" id="scroll-target">	
			<div class="col-12">	
				<!-- card start -->
				<div class="card card-shadow">
					<?php 
						$page_title = '<i class="fas fa-history fs-16"></i>  
						My Library History';
						pageTitle($page_title, 0);	 
					?>
					<div class="card-body">
						<div id="lib-book-msg"></div>
<?php

			try {
		 				
 
						
				$student_name = studentName($conn, $regNum);  /* students name information  */ 
		
				$student_img = studentPicture($conn, $regNum);  /* students profile picture  */ 
				

$table_head =<<<IGWEZE
  
				<div class="table-responsive pt-3">
				 
				<script type='text/javascript'> renderTable(); </script> 
				<!-- table -->
				<table  class='table table-hover table-responsive style-table wiz-table'>
				<thead>
				<tr><th style=" width: 3%; ">ID</th>
				<th style=" width: 26%;">Details</th> 
				<th style=" width: 12%;">Apply. Time</th> 
				<th style=" width: 12%;">Approved Time</th> 
				<th style=" width: 12%;">Return Date</th> 
				<th style=" width: 30%;">Comments</th>
				<th style=" width: 5%;">Status</th></tr>
				</thead> <tbody>
		
IGWEZE;

				echo  $table_head;
				
  				$ebele_mark = "SELECT b_id, book_id, lib_user, lib_reg, apply_date, approve_date, return_date, d_reasons, comment, 
								stype, b_status
				
								FROM $fobrainLibApplyTB
								
								WHERE  stype = :stype
								
								AND lib_user = :lib_user";
					 
 			    $igweze_prep = $conn->prepare($ebele_mark); 
				$igweze_prep->bindValue(':stype', $schoolID);
				$igweze_prep->bindValue(':lib_user', $regID);
 				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count >= $foreal) {  /* check array is empty */
					 
					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {  /* loop array */		

						$book_id = $row['book_id'];
						$applyID = $row['b_id'];
						$lib_user = $row['lib_user'];
						$lib_reg = $row['lib_reg'];
						$apply_date = $row['apply_date'];
						$approve_date = $row['approve_date'];
						$return_date = $row['return_date'];
						$d_reasons = $row['d_reasons'];
						$comment = $row['comment'];
						$schoolID = $row['stype']; 
						$b_status = $row['b_status'];
						
						if($b_status == $foVal){$comment = $d_reasons;}
						
						if($apply_date != ''){
							
							$apply_date = strtotime($apply_date);
							$apply_date = date("h:i:s, j M Y", $apply_date);
							
						}else{ $apply_date = ' - '; }

						if($approve_date != ''){
							
							$approve_date = strtotime($approve_date);
							$approve_date = date("h:i:s, j M Y", $approve_date);
							
						}else{ $approve_date = ' - '; }


						if($return_date != ''){
							
							$return_date = strtotime($return_date);
							$return_date = date("h:i:s, j M Y", $return_date);
							
						}else{ $return_date = ' - '; }


							$ebele_mark_1 = "SELECT book_id, book_name, book_author, book_desc, book_path, book_type, book_hits, book_copies, 
											book_location, stype, book_status
							
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
							
							
							$bookLocation = '<tr><th style="padding-left: 30px; text-align:left; width: 30%;">
											<i class="fa  fa-eye"></i> Book Location </td> <td style="padding-left: 
											30px; text-align:left; width: 70%;">'.$book_location.'</td> </tr>';
							
						}

						if($book_author == '') { $book_author = 'Anonymous'; }
						if($book_type != '') { $book_type = $libraryTypeArr[$book_type]; }
						else{$book_type = '-';}
						
						
						$bookStatus = $libraryAppStatusArr[$b_status];
						
					
						
$bookInfo =<<<IGWEZE

						<tr>
							<td> App$applyID </td>
							<td> 
								<div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 me-3">
                                        <img src = "$bookPicture" class=" img-h-50 img-circle img-thumbnail">
                                    </div>
                                    <div class="flex-grow-1">
                                        <h5>$book_name </h5>
                                        <p class="mb-0">by $book_author</p>
                                    </div>
                                </div> 
							</td>  
							<td> $apply_date </td> 
							<td>$approve_date</td> 
							<td>$return_date</td> 
							<td>$comment</td>
							<td>$bookStatus</td>
						</tr> 
		
IGWEZE;

						echo $bookInfo;
				
				
				
					}
					
					
					

				}else{  /* display information message */ 
		
					$msg_i =  "Ooops, you dont have any book history information to view. Thanks";
					echo $infoMsg.$msg_i.$iEnd; 
			
				}
				
				echo  '</tbody></table><!-- / table --></div>';
				
			}catch(PDOException $e) {
  			
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			 
			}
	
		

?>

								
					</div>
				</div>
				<!-- card end -->	
			</div>
		</div>
		<!-- / row -->	

 		 		
