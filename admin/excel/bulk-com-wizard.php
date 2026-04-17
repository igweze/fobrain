<?php 
	
    if (!defined('fobrain')) /* This checks if this page was wrongly access by users */ 
	die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!'); 
 

    if($uMode == $seVal){   /* save information */ 	 

        for($c=0; $c <= (count($rsArray) - 1); $c++) {  /* loop array */	

            $regNum = trim($rsArray[$c][1]);

            $rsArray_r = $rsArray[$c];
            unset($rsArray_r[0]);
            unset($rsArray_r[1]);
            $rsArray_r = array_values($rsArray_r);  

            $courseArray = array_combine($courseArr, $rsArray_r);  /* combine two arrays */  

            $ebele_mark = "SELECT f.ireg_id, r.nk_regno

                                FROM $i_reg_tb r, $sdoracle_score_nk f

                                WHERE r.nk_regno = :nk_regno

                                AND r.ireg_id = f.ireg_id
                                
                                AND  r.session_id = :session_id
                                
                                AND r.$nk_class = :sClass
                                
                                AND  r.active = :active";
                    
            $igweze_prep = $conn->prepare($ebele_mark);										
            $igweze_prep->bindValue(':nk_regno', $regNum);
            $igweze_prep->bindValue(':sClass', $class);	
            $igweze_prep->bindValue(':session_id', $sessionID);	
            $igweze_prep->bindValue(':active', $fiVal);	
            $igweze_prep->execute();
            
            $rows_count = $igweze_prep->rowCount();  
            
            if($rows_count != $foreal) {	 /* check if student really exits */ 
   
                $msg_e = "*Ooops Error, student with Reg. No.
                        <span> $regNum </span>
                        do not exist or is inactive or does not belong to this class, this 
                        record was not added !. 
                        Please kindly delete this row from excel to continue.<br />";
                        unlink($uploadedFile);
                        echo $erroMsg.$msg_e.$msgEnd;
                        echo "<script type='text/javascript'> 
								$script_scroll_cm
						</script>"; exit;		
                    
            }else{  /* insert/update information */

                while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {  /* loop array */		

                    $checked_id = $row['ireg_id'];
                    
                } 

                $ebele_mark_2 = "UPDATE $sdoracle_comment_nk SET ";
									
                                    foreach($courseArray as $subj => $score) {  /* loop array */

                                        if($subj != 'insert' && $subj != 'regnum') {
                                                                                        
                                                $ebele_mark_2 .= ' '.$subj.' = :'.$subj.','; 
                                                $values_2[':'.$subj] = htmlspecialchars($score); 
                                            
                                        }

                                    }
                                    
                $ebele_mark_2 = trim($ebele_mark_2, ', ');											
                $ebele_mark_2 .= ' WHERE  ireg_id = :reg_id';											
                $igweze_prep_2 = $conn->prepare($ebele_mark_2);											
                $values_2[':reg_id'] = $checked_id;															 
                $igweze_prep_2->execute($values_2); 																	 
                    
                if  ($igweze_prep_2->execute($values_2)){  /* if sucessfully */ 									
                        
                    //everything is good continue
                    
                }else {  /* display error */
								
                    $msg_e =  "Ooops error, could not input student  with Reg. No
                    (<span> $regNum </span>) result. Please try again";
                    unlink($uploadedFile); 
                    echo $erroMsg.$msg_e.$msgEnd;                             
                    echo "<script type='text/javascript'> 
								$script_scroll_cm
						</script>"; exit;

                }  

            }

            $courseArray = '';   $grade_nk = '';

        }   
         

    } 
 