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
	This script load and save student rollcall roll-call-info.php
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

    if (!defined('fobrain')) /* This checks if this page was wrongly access by users */

    die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
		
		
$roll_head_1 =<<<IGWEZE

					 
				<div id='edit-msg'></div>		 
													
				<script type='text/javascript'>  
					renderTableFull(); 
				</script>
				<div class="table-responsive">
					<!-- table -->
					<table class='table table-hover table-responsive style-table wiz-table' width="100%">					
						<thead>
							<tr>
								<th>S/N</th>
								<th>Regnum</th> 
								<th>Picture</th>
								<th>Name</th>
								<th>Roll Call</th>
								<th>Comments</th>
							</tr>
				
						</thead>
						<tbody>
	
IGWEZE;

$roll_head_2 =<<<IGWEZE

					 
				<div id='edit-msg'></div>		 
													
				<script type='text/javascript'>  
					renderTableFull(); 
				</script>
				<div class="table-responsive">
					<!-- table -->
					<table class='table table-hover table-responsive style-table wiz-table' width="100%">					
						<thead>
							<tr>
								<th>S/N</th>
								<th>Regnum</th> 
								<th>Picture</th>
								<th>Name</th>
								<th>Status</th>
								<th>Teacher's Comment</th> 
								<th>Parent Reply</th> 
							</tr>
				
						</thead>
						<tbody>
	
IGWEZE;
		
						try { 
							
							$sessionID = sessionID($conn, $session); /* school session ID  */
							$session_fi = fobrainSession($conn, $sessionID); /* school session */
										
							$session_se = $session_fi + $foreal;  

                            $roll_opt = "";
							
							$ebele_mark = "SELECT r.ireg_id, nk_regno, s.stu_id, i_stupic, i_firstname, i_lastname, i_midname
							
											FROM $i_reg_tb r INNER JOIN $i_student_tb s
							
											ON (r.ireg_id = s.ireg_id)

											AND r.session_id = :session_id 
										
											AND r.$nk_class = :class

											AND r.active = :foreal";
									
							$igweze_prep = $conn->prepare($ebele_mark);
							$igweze_prep->bindValue(':session_id', $sessionID, PDO::PARAM_STR);				
							$igweze_prep->bindValue(':foreal', $foreal, PDO::PARAM_STR);				
							$igweze_prep->bindValue(':class', $class, PDO::PARAM_STR);				 
							$igweze_prep->execute();
							
							$rows_count = $igweze_prep->rowCount(); 
							
							if($rows_count >= $foreal) {  /* check array is empty */ 

								if($save_rcall == true){
									echo $roll_head_1;
								}else{
									echo $roll_head_2;
								}
							
								while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {  /* loop array */		
					
									$regNo = $row['nk_regno'];
									$regID = $row['ireg_id'];
									$pic = $row['i_stupic'];
									$fname = $row['i_firstname'];
									$lname = $row['i_lastname'];
									$mname = $row['i_midname'];
									
									$studentData = $regID.'@@'.$regNo.'@@'.$session.'@@'.$level.'@@'.$class.'@@'.$term;
									
									$serial_no++; 
									
									$student_img = picture($school_pic_dir.$session_fi.'_'.$session_se.'/', $pic, "student"); 
									

									$ebele_mark_1 = "SELECT id, start, end, attendance, comments, reply
									
													FROM $daily_comments_tb
									
													WHERE ireg_id = :ireg_id
													
													AND start = :start
													
													AND end = :end";
											
									$igweze_prep_1 = $conn->prepare($ebele_mark_1);
									$igweze_prep_1->bindValue(':ireg_id', $regID);
									$igweze_prep_1->bindValue(':start', $roll_date);
									$igweze_prep_1->bindValue(':end', $roll_date);	 
									$igweze_prep_1->execute();
									
									$rows_count_1 = $igweze_prep_1->rowCount(); 
									
									if($rows_count_1 == $foreal) {  /* check array is empty */
										
										while($row_1 = $igweze_prep_1->fetch(PDO::FETCH_ASSOC)) {  /* loop array */		
				
											$id = $row_1['id'];
											$rollID = $row_1['attendance']; 
											$comments = $row_1['comments'];
                                            $reply = $row_1['reply'];
											
										}
										
										//$comments = htmlspecialchars_decode($comments);
										$roll_call = wizSelectArray($rollID, $attendance_list);

										if($comments != "")	{
											if (str_contains($comments, ':')) {
											list ($title, $comment) = explode (":", $comments);
											}else{
											$title = $comments; $comment = "No comment";
											} 
										}else{
											$title = ""; $comment = "No comment";            
										}
										
										if(($comment == "")	|| ($comment == " ")){ 
											$comment = "No comment"; 
										}
										
									}else{
										$rollID = "";
                                        $comment = "";
                                        $title = ""; 
                                        $reply = ""; 
										$roll_call = "";
									}	
												
									foreach($attendance_list as $attend_key => $attend_value){  /* loop array */

										if ($attend_key == $rollID){
											$selected = "SELECTED";
										} else {
											$selected = "";
										}

										$roll_opt .= '<option value="'.$attend_key.'"'.$selected.'>'.$attend_value.'
										</option>' ."\r\n";

									}
									
									if($mname != ""){
										$mname = substr($mname, 0, 1);
										$mname = "$mname".".";
									} 

$student_info_1 =<<<IGWEZE
	
								<tr>
									<td>$serial_no</td> 
									<td> <a href='javascript:;' id='$regNo' class ='view-student high-light-link'>$regNo </a> </td>
									<td>  
										<a href='javascript:;' id='$regNo' class ='view-student'>
											<img src = "$student_img" class=" img-h-50 img-circle img-thumbnail">
										</a>  
									</td>

									<td> 		 	
										<a href='javascript:;' id='$regNo' class ='view-student high-light-link'>
											$lname $mname  $fname 
										</a>    
									</td>
									
									<td width="15%"> 
									
										<div class="col-lg-12 py-10"> 
											<input type="hidden" value="$regID" name="regID[]" />
											<input type="hidden" value="$regNo" name="regNo[]" />
											<input type="hidden" value="$lname $fname $mname" name="studentName[]" />
											<select class="form-control fob-select classCall"  id="rollCall-$regID" name="rollCall[]" required> 
												$roll_opt
											</select>
										</div> 
									</td> 
									
									<td width="30%">  
										<div class="col-lg-12 py-10"> 
											<input type="text" class="form-control" placeholder="$lname 's Remarks" 
											name="remarks[]" id="remark-$regID" value="$title" /> 
										</div>   
									</td> 
									
								</tr>
	
IGWEZE;
                                
                                

$student_info_2 =<<<IGWEZE
	
								<tr>
									<td>$serial_no</td> 
									<td> <a href='javascript:;' id='$regNo' class ='view-student high-light-link'>$regNo </a> </td>
									<td>  
										<a href='javascript:;' id='$regNo' class ='view-student'>
											<img src = "$student_img" class=" img-h-50 img-circle img-thumbnail">
										</a>  
									</td> 
									<td width="20%"> 		 	
										<a href='javascript:;' id='$regNo' class ='view-student high-light-link'>
											$lname $fname $mname 
										</a>    
									</td> 
									<td>$roll_call</td>
                                    <td width="25%">$title</td>
                                    <td width="25%">$reply</td>  
								</tr>
	
IGWEZE;
                                 
                                if($save_rcall == true){
									echo $student_info_1;
                                    $roll_opt = "";
								}else{
									echo $student_info_2;
								}

                            }
            
                            echo '</tbody>
                            </table>
                            <!-- / table -->';  
		
                            
                        }else{

                            $msg_e = "Ooops Error, no record was found for this search query, please try another query";												
                            echo $errorMsg.$msg_e.$eEnd; //exit; 			
                                
                        } 
                        
        
                    }catch(PDOException $e) {
                
                        fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
                
                    }

						
			 