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
	This script handle library book student history
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

    	 define('fobrain', 'igweze');  /* define a check for wrong access of file */

        require 'fobrain-config.php';  /* load fobrain configuration files */	   
 
		if ($_REQUEST['studentData'] != '') {

			try {
		 				
				$studentData = $_REQUEST['studentData'];
				
				$studentData = strip_tags($studentData);
				
				list ($schoolID, $regID) = explode ("-", $studentData);


				$schoolName = $school_list[$schoolID];												

				require $fobrainSchoolTBS; /* include student database table information  */						
				
				$regNum = studentReg($conn, $regID);  /* student registration number  */
				
				$student_name = studentName($conn, $regNum);  /* student name  */

				$student_img = studentPicture($conn, $regNum);  /* student picture  */
				

				echo "<script type='text/javascript'> renderTable3(); </script>";
		

$table_head =<<<IGWEZE

		<!-- row -->
		<div class="row gutters mt-10 mb-20"> 
			<div class="col-12 text-center">
				<h4 class="font-head-1 text-danger fw-500"> Student Library History</h4>	
			</div>									 
		</div>	
		<!-- /row --> 

		<!-- row -->
		<div class="row gutters my-10  justify-content-center"> 
			<div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12 mb-10">
				<img src = "$student_img" class="img-h-70 rounded img-thumbnail"> 
			</div>	
			<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 mb-10">
				<span class="text-info fw-600">Reg No.</span> - $regNum 
				<br /><span class="text-info fw-600">Name</span> - $student_name  
				<br /><span class="text-info fw-600">School</span> - $schoolName  
			</div>									 
		</div>	
		<!-- /row -->  
		<hr class="my-20  text-danger"/> 
		
		<div class="table-responsive">
		<!-- table --> 
        <table  class='table table-hover table-responsive style-table wiz-table-3'>
			<thead>
				<tr>
					 
					<th>Picture</th> 
					<th>Book Details</th> 
					<th>Apply. Time <hr> Approved Time <hr> Return Date</th>   
					<th>Book Comments</th>
					<th>Book Status</th>
				</tr>
			</thead> 
			<tbody>
		
IGWEZE;


				echo  $table_head;

  				$ebele_mark = "SELECT b_id, book_id, lib_user, lib_reg, apply_date, approve_date, return_date, d_reasons, comment, 
								stype, sclass,  b_status
				
								FROM $fobrainLibApplyTB
								
								WHERE   stype = :stype
								
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
							$apply_date = date("h:i:s, j M, Y", $apply_date);
							
						}else{ $apply_date = ' - '; }

						if($approve_date != ''){
							
							$approve_date = strtotime($approve_date);
							$approve_date = date("h:i:s, j M, Y", $approve_date);
							
						}else{ $approve_date = ' - '; }


						if($return_date != ''){
							
							$return_date = strtotime($return_date);
							$return_date = date("h:i:s, j M, Y", $return_date);
							
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
							 
							<td> <img src = "$bookPicture" class=" img-h-40 img-circle img-thumbnail"> </td>
							<td> $book_name by $book_author </td> 
							<td> $apply_date <hr /> $approve_date <hr /> $return_date</td>   
							<td>$comment</td>
							<td>$bookStatus</td>
						</tr> 
		
IGWEZE;

						echo $bookInfo; 
				
					}  

				}else{  /* display information message */ 
				
					$msg_i =  "Ooops, this student has no book history information to show. Thanks";
					echo $infMsg.$msg_i.$msgEnd; echo "<script type='text/javascript'> hidePageLoader(); </script>"; exit; 			
					
				}

				echo  '</tbody></table><!-- / table --></div>';					
				echo "<script type='text/javascript'> hidePageLoader(); </script>";	exit;
					
			}catch(PDOException $e) {
				
				fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
				 
			}  
		
		}else{		
		
			echo $userNavPageError; exit;  /* else exit or redirect to 404 page */		
		
		} 
		
	
		if ($msg_i) {

         	

        }
		
exit;
?>