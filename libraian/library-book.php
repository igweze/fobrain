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
	This script show library book information
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

		define('fobrain', 'igweze');  /* define a check for wrong access of file */

        require 'fobrain-config.php';  /* load fobrain configuration files */	   

 		 
		if ($_REQUEST['bookID'] != '') {

			try {
		 				
				$bookID = $_REQUEST['bookID'];
				
				$bookID = strip_tags($bookID);

  				$ebele_mark = "SELECT book_id, book_name, book_author, book_desc, book_path, book_type, book_hits, book_copies, book_location, 
								stype,  book_status
				
								FROM $fobrainSchLib
								
								WHERE  book_id = :book_id";
					 
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
						$book_hits = $row['book_hits'];
						$book_copies = $row['book_copies'];
						$book_location = $row['book_location'];
						$book_status = $row['book_status'];
						$schoolID = $row['stype']; 
						
					} 
				
					$book_name  = trim($book_name);
					$book_author  = trim($book_author);
					$book_desc  = trim($book_desc);
					$book_desc = htmlspecialchars_decode($book_desc);
					$book_desc = nl2br($book_desc);


					$bookPicture = libraryUploadsManager($conn, $book_type, $book_path);  /* school library book upload manager */

					if($book_type == $fiVal ){  /* check book type */
						
						$downloadHits = '<tr>
											<th>
												Download/s 
											</th> 
											<td>'.$book_hits.' Hit/s</td> 
										</tr>';
						$bookLocation = '';
						$bookCopies = '';
						
					}else{
						
						$downloadHits = '';
						$bookLocation = '<tr>
											<th>
											 	Book Location 
											</th> 
											<td>
												'.$book_location.'
											</td> 
										</tr>';

						$bookCopies = '<tr>
											<th>
										  		Book Copies 
											</th> 
											<td>
												'.$book_copies.'
											</td> 
										</tr>';				
						
					}

					if($book_author == '') { $book_author = 'Anonymous'; }
					if($book_type != '') { $book_type = $libraryTypeArr[$book_type]; }
					else{$book_type = '-';}
					
					$bookStatus = $libraryStatusArr[$book_status];
					
					$schoolName = $school_list[$schoolID]; 
					
					
						
$bookInfo =<<<IGWEZE

						<div class="row gutters mb-10">
							<div class="text-end">
								<button  class="btn btn-primary" onclick="printDiv('fobrain-print-ovly')">
									<i class="fas fa-print"></i>  
								</button>
								<div class="col-12 text-center">
									<h3 class="font-head-1 text-primary fw-500"> Library Book Information</h3>	
								</div>	
							</div>	
						</div>
							 
						<div id = 'fobrain-print-ovly'>

							<!-- table -->	
							<table  class="table table-view table-hover table-responsive"> 
	
								<tr>
									<td style="padding-left: 10px;" colspan = '2'>
										<center><img src = "$bookPicture" class="img-h-100 img-thumbnail rounded-circle"> </center> 
									</td>
								</tr>
								
								<tr>
									<th>
										Book Type 
									</th> 
									<td> $book_type </td>
								</tr>
								<tr>
									<th>
										Book Name 
									</th> 
									<td>  $book_name </td>
								</tr>
								
								<tr>
									<th>
										Book Author 
									</th> 
									<td>$book_author</td> 
								</tr>
			
								<tr>
									<th>
										School 
									</th> 
									<td>$schoolName</td> 
								</tr>

								<tr>
									<th>
										Descriptions 
									</th> 
									<td>$book_desc</td> 
								</tr>
								
								$bookLocation
								
								<tr>
									<th>
										Book Status 
									</th> 
									<td>$bookStatus</td> 
								</tr>
							
								$bookCopies
								
								$downloadHits
							
						
							</table>
							<!-- table -->
						
						</div>
		
IGWEZE;

					echo $bookInfo;
					echo "<script type='text/javascript'> hidePageLoader();	</script>";	exit;
							

				}else{
				
					$msg_e =  "Ooops error, this library book information was not found.";
					
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