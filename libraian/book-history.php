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
	This script handle library book history
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

     	define('fobrain', 'igweze');  /* define a check for wrong access of file */

    	require 'fobrain-config.php';  /* load fobrain configuration files */	  
		echo "<script type='text/javascript'> hidePageLoader();	</script>";	  
		if ($_REQUEST['bookID'] != '') {

			try {
		 				
				$bookID = $_REQUEST['bookID'];
				
				$bookID = strip_tags($bookID);
				
				$bookInfo = libraryBookInfo($conn, $bookID);  /* school library book information */
				list ($bookLID, $bookName, $bookPath, $bookAuthor, $bookType, $bookStatusT, $schoolID, $sClassID, $bookHits, 
					  $bookCopies, $bookLocation) = explode ("@.%.@", $bookInfo); 

				$bookName  = trim($bookName);
				$bookAuthor  = trim($bookAuthor); 

				$bookPicture = libraryUploadsManager($conn, $bookType, $bookPath);  /* school library book upload manager */
				
				$schoolNameT = $school_list[$schoolID];
				

				if($bookType == $fiVal ){
					
					$bookMore = "<br /> <span class='text-info fw-600'> Book Downloads </span> - $bookHits"; 
					
				}else{ 
					
					$bookMore = "<br /> <span class='text-info fw-600'> Book Copies </span> - $bookCopies
									 <br /> <span class='text-info fw-600'> Book Location </span> - $bookLocation";
					
				}

				if($bookAuthor == '') { $bookAuthor = 'Anonymous'; }
				if($bookType != '') { $bookType = $libraryTypeArr[$bookType]; }
				else{$bookType = '-';} 
				
				$bookStatusT = $libraryStatusArr[$bookStatusT]; 
				
				echo "<script type='text/javascript'> renderTable3(); </script>"; 

$table_head =<<<IGWEZE

				<!-- row -->
				<div class="row gutters mt-10 mb-20"> 
					<div class="col-12 text-center">
						<h4 class="font-head-1 text-danger fw-500"> Book History</h4>	
					</div>									 
				</div>	
				<!-- /row --> 

				<!-- row -->
				<div class="row gutters my-10  justify-content-center"> 
					<div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12 mb-10">
						<img src = "$bookPicture" class="img-h-100 rounded img-thumbnail"> 
					</div>	
					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 mb-10">
						<span class="text-info fw-600">Title </span> - $bookName
						<br /><span class="text-info fw-600">  Author </span> - $bookAuthor 
						<br /><span class="text-info fw-600">  Type </span> - $bookType
						<br /> <span class="text-info fw-600">  Status </span> - $bookStatusT							
						<br /> <span class="text-info fw-600">School</span> - $schoolNameT							
						$bookMore 	
					</div>									 
				</div>	
				<!-- /row -->  
				<hr class="my-20  text-danger"/> 
				
				<div class="table-responsive">
				<!-- table -->
				<table  class='table table-hover table-responsive style-table wiz-table-3'>
					<thead>
						<tr>
							<th>App. ID</th>
							<th>Picture</th> 
							<th>Name</th> 
							<th>School</th> 
							<th>Status</th> 
							<th>Comments</th> 
						</tr>
					</thead> 
					<tbody>
		
IGWEZE;

				echo  $table_head;
				/* select information */ 
				
  				$ebele_mark = "SELECT b_id, book_id, lib_user, lib_reg, apply_date, comment, stype, sclass, b_status
				
								FROM $fobrainLibApplyTB
								
								WHERE  book_id = :book_id";
					 
 			    $igweze_prep = $conn->prepare($ebele_mark);
				$igweze_prep->bindValue(':book_id', $bookID);
 				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count >= $foreal) {  /* check array is empty */ 
					
					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {  /* loop array */		

						$book_id = $row['book_id'];
						$applyID = $row['b_id'];
						$lib_user = $row['lib_user'];
						$lib_reg = $row['lib_reg'];
						$apply_date = $row['apply_date'];
						$bComments = $row['comment'];
						
						$schoolID = $row['stype'];
						$sClassID = $row['sclass'];
						$b_status = $row['b_status'];
						
						$bookStatus = $libraryAppStatusArr[$b_status];							
						
						$schoolName = $school_list[$schoolID];
						
						require $fobrainSchoolTBS; /* include student database table information  */						
						
						$regNum = studentReg($conn, $lib_user);  /* student registration number  */
						
						$student_name = studentName($conn, $regNum);  /* student name  */
		
						$student_img = studentPicture($conn, $regNum);  /* student picture  */
					
						
$bookInfo =<<<IGWEZE


					<tr>
						<td> App-$applyID </td> 
						<td> <img src="$student_img" alt="student picture" class="img-h-50 img-circle img-thumnail" /> </td> 
						<td> 
							$student_name <br /> $regNum   
						</td> 
						<td>
							$schoolName
						</td> 
						<td style="ext-transform:capitalize;">
							$bookStatus
						</td> 
						<td>
							$bComments
						</td>
					</tr>
		
IGWEZE;

						echo $bookInfo;
				
				
				
					}
					
					
						
				}else{  /* display information message */ 
		
					$msg_i =  "Ooops, this library book has no history information to show.aa Thanks";
					echo $infoMsg.$msg_i.$iEnd; 
					//echo "<script type='text/javascript'> hidePageLoader();	</script>";	
					exit;
			
				}

				echo  '</tbody></table><!-- / table --></div>';
				//echo "<script type='text/javascript'> hidePageLoader();	</script>";	
				exit;

				
			}catch(PDOException $e) {
  			
				fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			 
			}
		
		}else{
		
			echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
		
		}
		
		
	 exit;
 	
?>	