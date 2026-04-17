<?php 
	
    if (!defined('fobrain')) /* This checks if this page was wrongly access by users */ 
	die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!'); 

 
    if($uMode == $seVal){   /* save information */ 	 

        if(trim($qtype) == "exam"){

            $examTB = $fobrainExamTB;
            $quesTB = $fobrainQuestionTB;

        }elseif(trim($qtype) == "homewk"){

            $examTB = $fobrainHomeWorkTB;
            $quesTB = $fobrainHMQuestionTB; 

        }else{

            $msg_e = "* Ooops Error, please contact developer. Error 512";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'> 
							$script_scroll_cm  
						</script>"; exit; 

        }


        try { 
         
            
            if ($admin_grade == $cm_fobrain_grd) {    /* check admin grade */ 
            
                $eGrade = $seVal;
            
            }else{
                
                $eGrade = $fiVal;
                
            }	

            $eDetail = "";
            
            $ebele_mark = "INSERT INTO $examTB  (session, level, class, eTerm, eTitle, eSubject, eTime, eDetail, eGrade, eStaff, status)

                                                        VALUES (:session, :level, :class, :eTerm, :eTitle, :eSubject, 
                                                        :eTime, :eDetail, :eGrade, :eStaff, :status)";
         
            $igweze_prep = $conn->prepare($ebele_mark);
            $igweze_prep->bindValue(':session', $sessionID);
            $igweze_prep->bindValue(':level', $level);
            $igweze_prep->bindValue(':class', $class);
            $igweze_prep->bindValue(':eTerm', $term);
            $igweze_prep->bindValue(':eTitle', $eTitle);
            $igweze_prep->bindValue(':eSubject', $eSubject);
            $igweze_prep->bindValue(':eTime', $eTime);
            $igweze_prep->bindValue(':eDetail', $eDetail);
            $igweze_prep->bindValue(':eGrade', $eGrade);
            $igweze_prep->bindValue(':eStaff', $_SESSION['adminID']);
            $igweze_prep->bindValue(':status', $status);
            
            
            if($igweze_prep->execute()){  /* if sucessfully */ 

                $eID = $conn->lastInsertId($examTB);

            }
            
        }catch(PDOException $e) {
  			
            fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
 
        }    

        for($c=0; $c <= (count($questionArr) - 1); $c++) {  /* loop array */	 

            $question = clean($questionArr[$c][0]); 
            $q1 =  clean($questionArr[$c][1]); 
            $q2 =  clean($questionArr[$c][2]); 
            $q3 =  clean($questionArr[$c][3]); 
            $q4 =  clean($questionArr[$c][4]); 
            $q5 =  clean($questionArr[$c][5]);  
            $answer = clean($questionArr[$c][6]); 
            $qMark = clean($questionArr[$c][7]); 

            $answer = strtoupper($answer);

            $ans = array_search($answer, $question_list_2);

            $ebele_mark_in = "INSERT INTO $quesTB  
                            (eID, question, q1, q2, q3, q4, ans, qMark)

            VALUES (:eID, :question, :q1, :q2, :q3, :q4, :ans, :qMark)";
            
            $igweze_prep_in = $conn->prepare($ebele_mark_in);
            $igweze_prep_in->bindValue(':eID', $eID);
            $igweze_prep_in->bindValue(':question', $question);
            $igweze_prep_in->bindValue(':q1', $q1);
            $igweze_prep_in->bindValue(':q2', $q2);
            $igweze_prep_in->bindValue(':q3', $q3);
            $igweze_prep_in->bindValue(':q4', $q4);
            $igweze_prep_in->bindValue(':ans', $ans);
            $igweze_prep_in->bindValue(':qMark', $qMark);  

            if($igweze_prep_in->execute()){  /* if sucessfully */  
                
            }else{  /* display error */  
                
            }  
            

        }    

    }  