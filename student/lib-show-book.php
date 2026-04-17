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

		$scroll_up = "<script type='text/javascript'> hidePageLoader(); </script>";
		 
		 
		if ($_REQUEST['bookID'] != '') {

			try {
		 				
				$bookID = $_REQUEST['bookID'];
				
				/* select information */ 
				
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

					if($book_author == '') { $book_author = 'Anonymous'; }
					if($book_type != '') { $book_type = $libraryTypeArr[$book_type]; }
					else{$book_type = '-';}
					
					$bookStatus = $libraryStatusArr[$book_status];
					
					$bookUserInfo = libraryBookAppStatus($conn, $bookID, $regID, $schoolID);  /* school library book application status */
					
					if($bookUserInfo != ""){
						list ($bookAppStatus, $applyDate, $approveDate, $returnDate) = explode ("@.%.@", $bookUserInfo);
					}else{ $bookAppStatus = ""; $applyDate = ""; $approveDate = ""; $returnDate = ""; } 
					
					if($bookAppStatus == $fiVal){
						
						$applyDateS = date('h:i:s, d F, Y', strtotime($applyDate)); 
						$bookStatus  = "Your application to borrow this book on <strong>$applyDateS</strong> is pending for approval.";
					
					}elseif($bookAppStatus == $seVal){
				  
						$approveDateS = date('h:i:s, d F, Y', strtotime($approveDate)); 
						$bookStatus  = "Your application is approved on <strong>$approveDateS</strong> and this library book is in your
						possession now.";						
				  
					}else{
						
						$approveDateS = '';  $bookStatus = '';
					}
					
						
$bookInfo =<<<IGWEZE
		
					<div id = 'fobrain-print' class='table-responsive'>
						<!-- table -->
						<table class="table view-table">
							<tr>
							<th class = 'head' align = 'center' colspan = '2'>
								<center> Library Book Information  </center>
							</th>
							</tr>
							<tr><td colspan = '2'><center><img src = "$bookPicture" class='img-h-100 img-circle'> </center> </td></tr>
							

							<tr><th> Type </th> <td> $book_type </td></tr>
							<tr><th> Title </th> <td>  $book_name </td></tr>
							
							<tr><th>  Author </th> <td>$book_author</td> </tr>
							
							<tr><th> Descriptions </th> <td>$book_desc</td> </tr>
							
							<tr><th> Status </td> <th>$bookStatus</td> </tr>					   
						</table>
						<!-- / table -->					
					</div>
		
IGWEZE;

					echo $bookInfo;
					echo "<script type='text/javascript'>  hidePageLoader(); </script>"; 			

				}else{
				
					$msg_e =  "Ooops error, this library book information was not found.";
					echo $errorMsg.$msg_e.$eEnd;
					echo "<script type='text/javascript'>  hidePageLoader(); </script>"; exit;
					
				} 
				
			}catch(PDOException $e) {
  			
				fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			 
			} 
		
		}else{
			
				echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
		
		}  		
exit;		
?>	