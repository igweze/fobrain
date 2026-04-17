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
           
            $rsSumArr_2 = $rsSumaryArr[$c];  

            $courseArray = array_combine($courseArr, $rsArray_r);  /* combine two arrays */
            $courseArraySum = array_combine($courseToArr, $rsSumArr_2);  /* combine two arrays */
            
            $grand_c_total = array_sum($courseArraySum);  /* total array sum */ 

            if($grand_c_total >= $fiVal){   /* check if total is an interger before dividing it */				

                $grade_nk = ($grand_c_total / $c_count);   														
                $grade_nk = number_format($grade_nk, 1);	
                
            }  
           
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
                        echo $errorMsg.$msg_e.$eEnd;
                        echo "<script type='text/javascript'> 
                                    $script_scroll_cm 
                            </script>"; exit; 		
                    
            }else{  /* insert/update information */

                while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {  /* loop array */		

                    $checked_id = $row['ireg_id'];
                    
                }

                $conn->beginTransaction();  /* begin data input transaction */	 
            
                $ebele_mark_2 = "UPDATE $sdoracle_score_nk SET ";

                                    foreach($courseArray as $subj => $score) {  /* loop array */

                                        if($subj != 'insert' && $subj != 'regnum') {
                                                                                        
                                                $ebele_mark_2 .= ' '.$subj.' = :'.$subj.','; 
                                                $values_2[':'.$subj] = $score; 
                                            
                                        }

                                    }
                                    
                                    
                $ebele_mark_2 = trim($ebele_mark_2, ', ');											
                $ebele_mark_2 .= ' WHERE  ireg_id = :reg_id';											
                $igweze_prep_2 = $conn->prepare($ebele_mark_2);											
                $values_2[':reg_id'] = $checked_id;															 
                $igweze_prep_2->execute($values_2); 
            
                $ebele_mark_3 = "UPDATE $sdoracle_sub_score_nk SET ";

                                    foreach($courseArraySum as $subjs => $scores) {  /* loop array */

                                        if($subj != 'insert' && $subjs != 'regnum') {
                                                                                        
                                                $ebele_mark_3 .= ' '.$subjs.' = :'.$subjs.','; 
                                                $values_3[':'.$subjs] = $scores;
                                                
                                        }

                                    } 
                                    
                $ebele_mark_3 = trim($ebele_mark_3, ', ');											
                $ebele_mark_3 .= ' WHERE  ireg_id = :reg_id';											
                $igweze_prep_3 = $conn->prepare($ebele_mark_3);											
                $values_3[':reg_id'] = $checked_id;																									 
                $igweze_prep_3->execute($values_3); 
                                    
                $ebele_mark_4 = "UPDATE $sdoracle_grand_score_nk SET  
            
                                    $term_score = :grand_to,
                                    
                                    $term_avg = :grade_nk 
                                    
                                    WHERE  ireg_id = :reg_id";
                                    
                $igweze_prep_4 = $conn->prepare($ebele_mark_4);											
                $igweze_prep_4->bindValue(':reg_id', $checked_id);
                $igweze_prep_4->bindValue(':grand_to', $grand_c_total);
                $igweze_prep_4->bindValue(':grade_nk', $grade_nk); 															 
                $igweze_prep_4->execute(); 

                if($cal_session == true){  /* if school term is third term */ 
                
                    $reportStatus = updateGrandSessionRS($conn, $sdoracle_grand_score_nk, $checked_id, $fiGrandTotal, $seGrandTotal, 
                                    $thGrandTotal, $grandTotal, $grandAvg);  /* update student grand annual score  */
                    
                    if($reportStatus == $i_false){  /* display error */
                        
                        $msg_i =  "Ooops error, could not input student  with Reg. No
                        (<span> $regNum </span>)
                            total session result. Please try again";
                        echo $infMsg.$msg_i.$msgEnd;
                        
                    
                    }								
                    
                } 
                        
                    
                if  (($igweze_prep_2) && ($igweze_prep_3) && ($igweze_prep_4)){  /* if sucessfully */ 									
                        
                    $conn->commit(); /* if everything is alright then insert data accross tables */	
                    $rsArray_r = ''; $rsSumArr_2 = '';  $grand_c_total =''; $rsSumArr  = ''; $excelCCodeArr = ''; 
                    $courseArray = ''; $courseArraySum = '';
                    $grand_c_total = ''; $grade_nk = '';		
                    
                }else {  /* display error */
                    
                    $conn->rollBack(); /* if everything is not alright then don't insert data accross tables */		
                    	
                    $msg_e =  "Ooops error, could not input student  with Reg. No
                    (<span> $regNum </span>)
                    result. Please try again";
                    unlink($uploadedFile); 
                    echo $erroMsg.$msg_e.$msgEnd;
					echo "<script type='text/javascript'> 
								$script_scroll_cm
						</script>"; exit;

                } 


            }

            $courseArray = ''; $courseArraySum = ''; $grand_c_total = ''; $grade_nk = '';

        }   
         

    } 
 