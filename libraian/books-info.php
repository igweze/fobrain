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
	This script list library books information
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

        define('fobrain', 'igweze');  /* define a check for wrong access of file */

         require 'fobrain-config.php';  /* load fobrain configuration files */

?> 
			
            <script type='text/javascript'> renderTable(); </script>				 
				<div class="table-responsive">
					<!-- table --> 
					<table class='table table-hover table-responsive style-table wiz-table'>					
						<thead>
							<tr>
                                <th>SN</th>
                                <th>Picture</th>
                                <th>Title</th>                                 
								<th>School</th> 
								<th>Type</th>
								<th>Tasks</th>
							</tr>
						</thead> 
						<tbody>
<?php

                        try {
		 
				
                            $ebele_mark = "SELECT book_id, book_name, book_author, book_path, book_type, stype 
                        
                                        FROM $fobrainSchLib
                                        
                                        
                                        ORDER BY book_id DESC";
                                
                            $igweze_prep = $conn->prepare($ebele_mark);				
                            $igweze_prep->execute();
                            
                            $rows_count = $igweze_prep->rowCount(); 
                            
                            if($rows_count >= $foreal) {  /* check array is empty */ 
                             
                                $serial_no = 0;

                                while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {  /* loop array */		

                                    $book_id = $row['book_id'];
                                    $book_name = $row['book_name'];
                                    $book_author = $row['book_author'];
                                    $book_path = $row['book_path'];
                                    $book_type = $row['book_type'];
                                    $schoolID = $row['stype']; 
                                    
                                    $bookPicture = libraryUploadsManager($conn, $book_type, $book_path);  /* school library book upload manager */
                                    
                                    $schoolName = $school_list[$schoolID]; 
                                    
                                    if($book_author == '') { $book_author = 'Anonymous'; }
                                    if($book_type != '') { $book_type = $libraryTypeArr[$book_type]; }
                                    else{$book_type = '-';}
                                                        
                                    $serial_no++; 
                                
                                    /*<input type="text" class="form-control edit-library-book" placeholder="book name"  value="$book_name"  
                                    id ="book-name-$book_id"        name="book-name" maxlength="100" id="book-name" required />*/

$lib_book =<<<IGWEZE

                                    <tr id='lib_book_row-$book_id'>
                                        <td>  $serial_no  </td>
                                        <td>  
                                            <span id="library-pic-$book_id">
                                                <img src="$bookPicture" alt="book picture" class="img-h-50 img-circle img-thumnail" /> 
                                            </span>
                                        </td>  
                                        <td>  
                                            <span id='lib_name-$book_id'><strong> $book_name </strong> By $book_author</span>
                                        </td>                
                                        <td>  $schoolName  </td>                
                                        <td> <span id='lib_type-$book_id'>$book_type</span> </td>                 
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
                                                            <i class="mdi mdi-text-box-search label-icon"></i> View 
                                                        </a>	
                                                    </p>
                                                    <p class="mb-10">
                                                        <a href='javascript:;' id ="$book_id" class ='edit-lib-book text-slateblue btn waves-effect btn-label waves-light'>									
                                                            <i class="mdi mdi-square-edit-outline label-icon"></i> Edit
                                                        </a>	
                                                    </p>
                                                    <p>
                                                        <a href='javascript:;' id ="book-lib-$book_id-$book_name" class ='remove-lib-book text-danger btn waves-effect btn-label waves-light'>									
                                                            <i class="mdi mdi-delete label-icon"></i> Delete
                                                        </a>	
                                                    </p> 
                                                </div>
                                            </div> 
                                        </td> 
                                    </tr>

IGWEZE;
                                     echo $lib_book; 

                                }


                            }else{

                                $msg_i = "Ooops error, no book was found in school library. ";
                                echo $infoMsg.$msg_i.$iEnd;
                                echo "<script type='text/javascript'> hidePageLoader();	</script>";
                                exit;
                            }

                        }catch(PDOException $e) {
                            
                            fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
                            
                        }
?>
                         
                   		 </tbody>
					</table>				
					<!-- / table -->
				</div>		