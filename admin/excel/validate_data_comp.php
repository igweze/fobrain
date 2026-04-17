<?php
		if (!defined('fobrain')) /* This checks if this page was wrongly access by users */ 
		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!'); 

        $c_count = 0; $cc_count = 0; $cv_count = 0;
        $scoreInt = 0;

	    if(trim($course_data) == "-"){ /* check if input is null goto fobrainRSCont */ 
			$totalScore = 0;
			goto fobrainRSCont;   
		}  
        
		if($exam_status == $fiVal){  /* check school exam status */
				
			list ($fi_score, $examScore) = explode (",", $course_data);
			
			$scoresC = explode(",", $course_data);
			$scoresCount = count($scoresC); 
			
			if($scoresCount == $fiVal){

				$g_row_data = str_replace("-", "0", $course_data); 
				$g_row_data = trim($g_row_data);  
				$g_row_data = intval($g_row_data); 

				if((intval($fi_score) > 100) || ($fi_score == "")){

					$msg_e .= "*Ooops Error, student with Reg. No. <strong>$regNum</strong>
					(<strong>Row No. $row_no - Column $excelScoreCol</strong>)    Exam score 
					is <strong>$fi_score</strong>
					which is high than required set score <strong>100</strong>."; 
					unlink($uploadedFile);		 
					echo $erroMsg.$msg_e.$msgEnd;
					echo "<script type='text/javascript'> 
								$script_scroll_cm
						</script>"; exit;
					$is_clean = false;																		
				
				}elseif($g_row_data == 0){
					$totalScore = 0; 
				}else{ $totalScore = $fi_score; }  
			
			}elseif($scoresCount > $seVal){ 

				$msg_e .= "*Ooops Error, student with Reg. No. <strong>$regNum</strong>
				(<strong>Row No. $row_no - Column $excelScoreCol</strong>)    record  
				is more that <b>$seVal</b> scores. Please cross check record and continue"; 
				unlink($uploadedFile);		 
				echo $erroMsg.$msg_e.$msgEnd;
				echo "<script type='text/javascript'> 
								$script_scroll_cm
						</script>"; exit; 
				$is_clean = false;	 
			
			}else{	
			
				$fi_score = cleanInt($fi_score);
				$examScore = cleanInt($examScore);
				
				if(($fi_score > $fiAssScore) || ($fi_score == "")){

					$msg_e .= "*Ooops Error, student with Reg. No. <strong>$regNum</strong>
					(<strong>Row No. $row_no - Column $excelScoreCol</strong>)   1st Assessment score 
					is <strong>$fi_score</strong>
					which is high than required set score <strong>$fiAssScore</strong>."; 
					unlink($uploadedFile);		 
					echo $erroMsg.$msg_e.$msgEnd;
					echo "<script type='text/javascript'> 
								$script_scroll_cm
						</script>"; exit; 
					$is_clean = false;																		
					
				}elseif(($examScore > $exam_score) || ($examScore == "")){

					$msg_e .= "*Ooops Error, student with Reg. No. <strong>$regNum</strong>
					(<strong>Row No. $row_no - Column $excelScoreCol</strong>)    Exam score is 
					<strong>$examScore</strong>
					which is high than required set exam score <strong>$exam_score</strong>."; 
					unlink($uploadedFile);		 
					echo $erroMsg.$msg_e.$msgEnd;
					echo "<script type='text/javascript'> 
								$script_scroll_cm
						</script>"; exit; 
					$is_clean = false;																		
					
				}else{ $totalScore = ($fi_score + $examScore); }
		
			}
				
		}elseif($exam_status == $seVal){  /* check school exam status */
				
			list ($fi_score, $se_score, $examScore) = explode (",", $course_data);
			
			$scoresC = explode(",", $course_data);
			$scoresCount = count($scoresC); 
			
			if($scoresCount == $fiVal){
				
				$g_row_data = str_replace("-", "0", $course_data); 
				$g_row_data = trim($g_row_data);  
				$g_row_data = intval($g_row_data); 

				if((intval($fi_score) > 100) || ($fi_score == "")){

					$msg_e .= "*Ooops Error, student with Reg. No. <strong>$regNum</strong>
					(<strong>Row No. $row_no - Column $excelScoreCol</strong>)    Exam score 
					is <strong>$fi_score</strong>
					which is high than required set score <strong>100</strong>."; 
					unlink($uploadedFile);		 
					echo $erroMsg.$msg_e.$msgEnd;
					echo "<script type='text/javascript'> 
								$script_scroll_cm
						</script>"; exit; 
					$is_clean = false;																		
				
				}elseif($g_row_data == 0){
					$totalScore = 0; 
				}else{ $totalScore = $fi_score; } 
			
			}elseif($scoresCount > $thVal){ 

				$msg_e .= "*Ooops Error, student with Reg. No. <strong>$regNum</strong>
				(<strong>Row No. $row_no - Column $excelScoreCol</strong>)    record  
				is more that <b>$thVal</b> scores. Please cross check record and continue"; 
				unlink($uploadedFile);		 
				echo $erroMsg.$msg_e.$msgEnd;
				echo "<script type='text/javascript'> 
								$script_scroll_cm
						</script>"; exit; 
				$is_clean = false;			 
			
			}else{	
			
				$fi_score = cleanInt($fi_score);
				$se_score = cleanInt($se_score);
				$examScore = cleanInt($examScore);
				
				
				if(($fi_score > $fiAssScore) || ($fi_score == "")){

					$msg_e .= "*Ooops Error, student with Reg. No. <strong>$regNum</strong>
					(<strong>Row No. $row_no - Column $excelScoreCol</strong>)    1st Assessment 
					score is <strong>$fi_score</strong>
					which is high than required set score <strong>$fiAssScore</strong>."; 
					unlink($uploadedFile);		 
					echo $erroMsg.$msg_e.$msgEnd;
					echo "<script type='text/javascript'> 
								$script_scroll_cm
						</script>"; exit; 
					$is_clean = false;																		
					
				}elseif(($se_score > $seAssScore) || ($se_score == "")){

					$msg_e .= "*Ooops Error, student with Reg. No. <strong>$regNum</strong>
					(<strong>Row No. $row_no - Column $excelScoreCol</strong>)    2nd Assessment 
					score is <strong>$se_score</strong>
					which is high than required set score <strong>$seAssScore</strong>."; 
					unlink($uploadedFile);		 
					echo $erroMsg.$msg_e.$msgEnd;
					echo "<script type='text/javascript'> 
								$script_scroll_cm
						</script>"; exit; 
					$is_clean = false;																		
					
				}elseif(($examScore > $exam_score) || ($examScore == "")){

					$msg_e .= "*Ooops Error, student with Reg. No. <strong>$regNum</strong>
					(<strong>Row No. $row_no - Column $excelScoreCol</strong>)    Exam score 
					is <strong>$examScore</strong>
					which is high than required set exam score <strong>$exam_score</strong>."; 
					unlink($uploadedFile);		 
					echo $erroMsg.$msg_e.$msgEnd;
					echo "<script type='text/javascript'> 
								$script_scroll_cm
						</script>"; exit; 
					$is_clean = false;																		
					
				}else{ $totalScore = ($fi_score + $se_score + $examScore); }
			}															 
				
		}elseif($exam_status == $thVal){  /* check school exam status */
				
			list ($fi_score, $se_score, $th_score, $examScore) = explode (",", $course_data);
			
			$scoresC = explode(",", $course_data);
			$scoresCount = count($scoresC);  
			
			if($scoresCount == $fiVal){

				$g_row_data = str_replace("-", "0", $course_data); 
				$g_row_data = trim($g_row_data);  
				$g_row_data = intval($g_row_data); 

				if((intval($fi_score) > 100) || ($fi_score == "")){

					$msg_e .= "*Ooops Error, student with Reg. No. <strong>$regNum</strong>
					(<strong>Row No. $row_no - Column $excelScoreCol</strong>)    Exam score 
					is <strong>$fi_score</strong>
					which is high than required set score <strong>100</strong>."; 
					unlink($uploadedFile);		 
					echo $erroMsg.$msg_e.$msgEnd;
					echo "<script type='text/javascript'> 
								$script_scroll_cm
						</script>"; exit; 
					$is_clean = false;																		
				
				}elseif($g_row_data == 0){
					$totalScore = 0; 
				}else{ $totalScore = $fi_score; }
				
			
			}elseif($scoresCount > $foVal){ 

				$msg_e .= "*Ooops Error, student with Reg. No. <strong>$regNum</strong>
				(<strong>Row No. $row_no - Column $excelScoreCol</strong>)    record  
				is more that <b>$foVal</b> scores. Please cross check record and continue"; 
				unlink($uploadedFile);		 
				echo $erroMsg.$msg_e.$msgEnd;
				echo "<script type='text/javascript'> 
								$script_scroll_cm
						</script>"; exit; 
				$is_clean = false;																		
				
			
			}else{	
			
				$fi_score = cleanInt($fi_score);
				$se_score = cleanInt($se_score);
				$th_score = cleanInt($th_score);
				$examScore = cleanInt($examScore);
				
				if(($fi_score > $fiAssScore) || ($fi_score == "")){

					$msg_e .= "*Ooops Error, student with Reg. No. <strong>$regNum</strong>
					(<strong>Row No. $row_no - Column $excelScoreCol</strong>)    1st Assessment score 
					is <strong>$fi_score</strong>
					which is high than required set score <strong>$fiAssScore</strong>."; 
					unlink($uploadedFile);		 
					echo $erroMsg.$msg_e.$msgEnd;
					echo "<script type='text/javascript'> 
								$script_scroll_cm
						</script>"; exit; 
					$is_clean = false;																		
					
				}elseif(($se_score > $seAssScore) || ($se_score == "")){

					$msg_e .= "*Ooops Error, student with Reg. No. <strong>$regNum</strong>
					(<strong>Row No. $row_no - Column $excelScoreCol</strong>)    2nd Assessment score 
					is <strong>$se_score</strong>
					which is high than required set score <strong>$seAssScore</strong>."; 
					unlink($uploadedFile);		 
					echo $erroMsg.$msg_e.$msgEnd;
					echo "<script type='text/javascript'> 
								$script_scroll_cm
						</script>"; exit; 
					$is_clean = false;																		
					
				}elseif(($th_score > $thAssScore) || ($th_score == "")){

					$msg_e .= "*Ooops Error, student with Reg. No. <strong>$regNum</strong>
					(<strong>Row No. $row_no - Column $excelScoreCol</strong>)    3rd Assessment score 
					is <strong>$th_score</strong>
					which is high than required set score <strong>$thAssScore</strong>."; 
					unlink($uploadedFile);		 
					echo $erroMsg.$msg_e.$msgEnd;
					echo "<script type='text/javascript'> 
								$script_scroll_cm
						</script>"; exit; 
					$is_clean = false;																		
					
				}elseif(($examScore > $exam_score) || ($examScore == "")){

					$msg_e .= "*Ooops Error, student with Reg. No. <strong>$regNum</strong>
					(<strong>Row No. $row_no - Column $excelScoreCol</strong>) 
					Exam score is <strong>$examScore</strong>
					which is high than required set exam score <strong>$exam_score</strong>."; 
					unlink($uploadedFile);		 
					echo $erroMsg.$msg_e.$msgEnd;
					echo "<script type='text/javascript'> 
								$script_scroll_cm
						</script>"; exit; 
					$is_clean = false;																		
					
				}else{ $totalScore = ($fi_score + $se_score + $th_score + $examScore); }
		
			}																 
				
		}elseif($exam_status == $foVal){  /* check school exam status */
				
			list ($fi_score, $se_score, $th_score, $fo_score, $examScore) = explode (",", $course_data);
			
			$scoresC = explode(",", $course_data);
			$scoresCount = count($scoresC); 
			
			if($scoresCount == $fiVal){
				
				$g_row_data = str_replace("-", "0", $course_data); 
				$g_row_data = trim($g_row_data);  
				$g_row_data = intval($g_row_data); 

				if((intval($fi_score) > 100) || ($fi_score == "")){

					$msg_e .= "*Ooops Error, student with Reg. No. <strong>$regNum</strong>
					(<strong>Row No. $row_no - Column $excelScoreCol</strong>)    Exam score 
					is <strong>$fi_score</strong>
					which is high than required set score <strong>100</strong>."; 
					unlink($uploadedFile);		 
					echo $erroMsg.$msg_e.$msgEnd;
					echo "<script type='text/javascript'> 
								$script_scroll_cm
						</script>"; exit; 
					$is_clean = false;																		
				
				}elseif($g_row_data == 0){
					$totalScore = 0; 
				}else{ $totalScore = $fi_score; } 
			
			}elseif($scoresCount > $fifVal){ 

				$msg_e .= "*Ooops Error, student with Reg. No. <strong>$regNum</strong>
				(<strong>Row No. $row_no - Column $excelScoreCol</strong>)    record  
				is more that <b>$fifVal</b> scores. Please cross check record and continue"; 
				unlink($uploadedFile);		 
				echo $erroMsg.$msg_e.$msgEnd;
				echo "<script type='text/javascript'> 
								$script_scroll_cm
						</script>"; exit; 
				$is_clean = false;		 
			
			}else{	
			
				$fi_score = cleanInt($fi_score);
				$se_score = cleanInt($se_score);
				$th_score = cleanInt($th_score);
				$fo_score = cleanInt($fo_score);
				$examScore = cleanInt($examScore);
				
				if(($fi_score > $fiAssScore) || ($fi_score == "")){

					$msg_e .= "*Ooops Error, student with Reg. No. <strong>$regNum</strong>
					(<strong>Row No. $row_no - Column $excelScoreCol</strong>)    1st Assessment score 
					is <strong>$fi_score</strong>
					which is high than required set score <strong>$fiAssScore</strong>."; 
					unlink($uploadedFile);		 
					echo $erroMsg.$msg_e.$msgEnd;
					echo "<script type='text/javascript'> 
								$script_scroll_cm
						</script>"; exit; 
					$is_clean = false;																		
					
				}elseif(($se_score > $seAssScore) || ($se_score == "")){

					$msg_e .= "*Ooops Error, student with Reg. No. <strong>$regNum</strong>
					(<strong>Row No. $row_no - Column $excelScoreCol</strong>)    2nd Assessment score 
					is <strong>$se_score</strong>
					which is high than required set score <strong>$seAssScore</strong>."; 
					unlink($uploadedFile);		 
					echo $erroMsg.$msg_e.$msgEnd;
					echo "<script type='text/javascript'> 
								$script_scroll_cm
						</script>"; exit; 
					$is_clean = false;																		
					
				}elseif(($th_score > $thAssScore) || ($th_score == "")){

					$msg_e .= "*Ooops Error, student with Reg. No. <strong>$regNum</strong>
					(<strong>Row No. $row_no - Column $excelScoreCol</strong>)    3rd Assessment score 
					is <strong>$th_score</strong>
					which is high than required set score <strong>$thAssScore</strong>."; 
					unlink($uploadedFile);		 
					echo $erroMsg.$msg_e.$msgEnd;
					echo "<script type='text/javascript'> 
								$script_scroll_cm
						</script>"; exit; 
					$is_clean = false;																		
					
				}elseif(($fo_score > $foAssScore) || ($fo_score == "")){

					$msg_e .= "*Ooops Error, student with Reg. No. <strong>$regNum</strong>
					(<strong>Row No. $row_no - Column $excelScoreCol</strong>)    4th Assessment score 
					is <strong>$fo_score</strong>
					which is high than required set score <strong>$foAssScore</strong>."; 
					unlink($uploadedFile);		 
					echo $erroMsg.$msg_e.$msgEnd;
					echo "<script type='text/javascript'> 
								$script_scroll_cm
						</script>"; exit; 
					$is_clean = false;																		
					
				}elseif(($examScore > $exam_score) || ($examScore == "")){

					$msg_e .= "*Ooops Error, student with Reg. No. <strong>$regNum</strong>
					(<strong>Row No. $row_no - Column $excelScoreCol</strong>) 
					Exam score is <strong>$examScore</strong>
					which is high than required set exam score <strong>$exam_score</strong>."; 
					unlink($uploadedFile);		 
					echo $erroMsg.$msg_e.$msgEnd;
					echo "<script type='text/javascript'> 
								$script_scroll_cm
						</script>"; exit; 
					$is_clean = false;																		
					
				}else{ $totalScore = ($fi_score + $se_score + $th_score + $fo_score + $examScore); }
				
			}
																				
				
		}elseif($exam_status == $fifVal){  /* check school exam status */
				
			list ($fi_score, $se_score, $th_score, $fo_score, $fif_score,
			$examScore) = explode (",", $course_data);
			
			$scoresC = explode(",", $course_data);
			$scoresCount = count($scoresC); 
			
			if($scoresCount == $fiVal){
				
				$g_row_data = str_replace("-", "0", $course_data); 
				$g_row_data = trim($g_row_data);  
				$g_row_data = intval($g_row_data); 

				if((intval($fi_score) > 100) || ($fi_score == "")){

					$msg_e .= "*Ooops Error, student with Reg. No. <strong>$regNum</strong>
					(<strong>Row No. $row_no - Column $excelScoreCol</strong>)    Exam score 
					is <strong>$fi_score</strong>
					which is high than required set score <strong>100</strong>."; 
					unlink($uploadedFile);		 
					echo $erroMsg.$msg_e.$msgEnd;
					echo "<script type='text/javascript'> 
								$script_scroll_cm
						</script>"; exit; 
					$is_clean = false;																		
				
				}elseif($g_row_data == 0){
					$totalScore = 0; 
				}else{ $totalScore = $fi_score; }
				
			
			}elseif($scoresCount > $sixVal){ 

				$msg_e .= "*Ooops Error, student with Reg. No. <strong>$regNum</strong>
				(<strong>Row No. $row_no - Column $excelScoreCol</strong>)    record  
				is more that <b>$sixVal</b> scores. Please cross check record and continue"; 
				unlink($uploadedFile);		 
				echo $erroMsg.$msg_e.$msgEnd;
				echo "<script type='text/javascript'> 
								$script_scroll_cm
						</script>"; exit; 
				$is_clean = false;	 
			
			}else{	
			
				$fi_score = cleanInt($fi_score);
				$se_score = cleanInt($se_score);
				$th_score = cleanInt($th_score);
				$fo_score = cleanInt($fo_score);
				$fif_score = cleanInt($fif_score);
				$examScore = cleanInt($examScore);
				
				if(($fi_score > $fiAssScore) || ($fi_score == "")){

					$msg_e .= "*Ooops Error, student with Reg. No. <strong>$regNum</strong>
					(<strong>Row No. $row_no - Column $excelScoreCol</strong>)    1st Assessment score 
					is <strong>$fi_score</strong>
					which is high than required set score <strong>$fiAssScore</strong>."; 
					unlink($uploadedFile);		 
					echo $erroMsg.$msg_e.$msgEnd;
					echo "<script type='text/javascript'> 
								$script_scroll_cm
						</script>"; exit; 
					$is_clean = false;																		
					
				}elseif(($se_score > $seAssScore) || ($se_score == "")){

					$msg_e .= "*Ooops Error, student with Reg. No. <strong>$regNum</strong>
					(<strong>Row No. $row_no - Column $excelScoreCol</strong>)    2nd Assessment score 
					is <strong>$se_score</strong>
					which is high than required set score <strong>$seAssScore</strong>."; 
					unlink($uploadedFile);		 
					echo $erroMsg.$msg_e.$msgEnd;
					echo "<script type='text/javascript'> 
								$script_scroll_cm
						</script>"; exit; 
					$is_clean = false;																		
					
				}elseif(($th_score > $thAssScore) || ($th_score == "")){

					$msg_e .= "*Ooops Error, student with Reg. No. <strong>$regNum</strong>
					(<strong>Row No. $row_no - Column $excelScoreCol</strong>)    3rd Assessment score 
					is <strong>$th_score</strong>
					which is high than required set score <strong>$thAssScore</strong>."; 
					unlink($uploadedFile);		 
					echo $erroMsg.$msg_e.$msgEnd;
					echo "<script type='text/javascript'> 
								$script_scroll_cm
						</script>"; exit; 
					$is_clean = false;																		
					
				}elseif(($fo_score > $foAssScore) || ($fo_score == "")){

					$msg_e .= "*Ooops Error, student with Reg. No. <strong>$regNum</strong>
					(<strong>Row No. $row_no - Column $excelScoreCol</strong>)    4th Assessment score 
					is <strong>$fo_score</strong>
					which is high than required set score <strong>$foAssScore</strong>."; 
					unlink($uploadedFile);		 
					echo $erroMsg.$msg_e.$msgEnd;
					echo "<script type='text/javascript'> 
								$script_scroll_cm
						</script>"; exit; 
					$is_clean = false;																		
					
				}elseif(($fif_score > $fifAssScore) || ($fif_score == "")){

					$msg_e .= "*Ooops Error, student with Reg. No. <strong>$regNum</strong>
					(<strong>Row No. $row_no - Column $excelScoreCol</strong>)    5th Assessment score 
					is <strong>$fif_score</strong>
					which is high than required set score <strong>$fifAssScore</strong>."; 
					unlink($uploadedFile);		 
					echo $erroMsg.$msg_e.$msgEnd;
					echo "<script type='text/javascript'> 
								$script_scroll_cm
						</script>"; exit; 
					$is_clean = false;																		
					
				}elseif(($examScore > $exam_score) || ($examScore == "")){

					$msg_e .= "*Ooops Error, student with Reg. No. <strong>$regNum</strong>
					(<strong>Row No. $row_no - Column $excelScoreCol</strong>) 
					Exam score is <strong>$examScore</strong>
					which is high than required set exam score <strong>$exam_score</strong>."; 
					unlink($uploadedFile);		 
					echo $erroMsg.$msg_e.$msgEnd;
					echo "<script type='text/javascript'> 
								$script_scroll_cm
						</script>"; exit; 
					$is_clean = false;																		
					
				}else{ $totalScore = ($fi_score + $se_score + $th_score + $fo_score + $fif_score 
										+ $examScore); }
		
			}																 
				
		}elseif($exam_status == $sixVal){  /* check school exam status */
				
			list ($fi_score, $se_score, $th_score, $fo_score, $fif_score, $six_score,
			$examScore) = explode (",", $course_data); 
			
			$scoresC = explode(",", $course_data);
			$scoresCount = count($scoresC); 
			
			if($scoresCount == $fiVal){
				
				$g_row_data = str_replace("-", "0", $course_data); 
				$g_row_data = trim($g_row_data);  
				$g_row_data = intval($g_row_data); 

				if((intval($fi_score) > 100) || ($fi_score == "")){

					$msg_e .= "*Ooops Error, student with Reg. No. <strong>$regNum</strong>
					(<strong>Row No. $row_no - Column $excelScoreCol</strong>)    Exam score 
					is <strong>$fi_score</strong>
					which is high than required set score <strong>100</strong>."; 
					unlink($uploadedFile);		 
					echo $erroMsg.$msg_e.$msgEnd;
					echo "<script type='text/javascript'> 
								$script_scroll_cm
						</script>"; exit; 
					$is_clean = false;																		
				
				}elseif($g_row_data == 0){
					$totalScore = 0; 
				}else{ $totalScore = $fi_score; }
				
			
			}elseif($scoresCount > $seVal){ 

				$msg_e .= "*Ooops Error, student with Reg. No. <strong>$regNum</strong>
				(<strong>Row No. $row_no - Column $excelScoreCol</strong>)    record  
				is more that <b>$seVal</b> scores. Please cross check record and continue"; 
				unlink($uploadedFile);		 
				echo $erroMsg.$msg_e.$msgEnd;
				echo "<script type='text/javascript'> 
								$script_scroll_cm
						</script>"; exit; 
				$is_clean = false;		 
			
			}else{	
			
				$fi_score = cleanInt($fi_score);
				$se_score = cleanInt($se_score);
				$th_score = cleanInt($th_score);
				$fo_score = cleanInt($fo_score);
				$fif_score = cleanInt($fif_score);
				$six_score = cleanInt($six_score);
				$examScore = cleanInt($examScore);
				
				if(($fi_score > $fiAssScore) || ($fi_score == "")){

					$msg_e .= "*Ooops Error, student with Reg. No. <strong>$regNum</strong>
					(<strong>Row No. $row_no - Column $excelScoreCol</strong>)    1st Assessment score 
					is <strong>$fi_score</strong>
					which is high than required set score <strong>$fiAssScore</strong>."; 
					unlink($uploadedFile);		 
					echo $erroMsg.$msg_e.$msgEnd;
					echo "<script type='text/javascript'> 
								$script_scroll_cm
						</script>"; exit; 
					$is_clean = false;																		
					
				}elseif(($se_score > $seAssScore) || ($se_score == "")){

					$msg_e .= "*Ooops Error, student with Reg. No. <strong>$regNum</strong>
					(<strong>Row No. $row_no - Column $excelScoreCol</strong>)    2nd Assessment score 
					is <strong>$se_score</strong>
					which is high than required set score <strong>$seAssScore</strong>."; 
					unlink($uploadedFile);		 
					echo $erroMsg.$msg_e.$msgEnd;
					echo "<script type='text/javascript'> 
								$script_scroll_cm
						</script>"; exit; 
					$is_clean = false;																		
					
				}elseif(($th_score > $thAssScore) || ($th_score == "")){

					$msg_e .= "*Ooops Error, student with Reg. No. <strong>$regNum</strong>
					(<strong>Row No. $row_no - Column $excelScoreCol</strong>)    3rd Assessment score 
					is <strong>$th_score</strong>
					which is high than required set score <strong>$thAssScore</strong>."; 
					unlink($uploadedFile);		 
					echo $erroMsg.$msg_e.$msgEnd;
					echo "<script type='text/javascript'> 
								$script_scroll_cm
						</script>"; exit; 
					$is_clean = false;																		
					
				}elseif(($fo_score > $foAssScore) || ($fo_score == "")){

					$msg_e .= "*Ooops Error, student with Reg. No. <strong>$regNum</strong>
					(<strong>Row No. $row_no - Column $excelScoreCol</strong>)    4th Assessment score 
					is <strong>$fo_score</strong>
					which is high than required set score <strong>$foAssScore</strong>."; 
					unlink($uploadedFile);		 
					echo $erroMsg.$msg_e.$msgEnd;
					echo "<script type='text/javascript'> 
								$script_scroll_cm
						</script>"; exit; 
					$is_clean = false;																		
					
				}elseif(($fif_score > $fifAssScore) || ($fif_score == "")){

					$msg_e .= "*Ooops Error, student with Reg. No. <strong>$regNum</strong>
					(<strong>Row No. $row_no - Column $excelScoreCol</strong>)    5th Assessment score 
					is <strong>$fif_score</strong>
					which is high than required set score <strong>$fifAssScore</strong>."; 
					unlink($uploadedFile);		 
					echo $erroMsg.$msg_e.$msgEnd;
					echo "<script type='text/javascript'> 
								$script_scroll_cm
						</script>"; exit; 
					$is_clean = false;																		
					
				}elseif(($six_score > $sixAssScore) || ($six_score == "")){

					$msg_e .= "*Ooops Error, student with Reg. No. <strong>$regNum</strong>
					(<strong>Row No. $row_no - Column $excelScoreCol</strong>)    6th Assessment score 
					is <strong>$six_score</strong>
					which is high than required set score <strong>$sixAssScore</strong>."; 
					unlink($uploadedFile);		 
					echo $erroMsg.$msg_e.$msgEnd;
					echo "<script type='text/javascript'> 
								$script_scroll_cm
						</script>"; exit; 
					$is_clean = false;																		
					
				}elseif(($examScore > $exam_score) || ($examScore == "")){

					$msg_e .= "*Ooops Error, student with Reg. No. <strong>$regNum</strong>
					(<strong>Row No. $row_no - Column $excelScoreCol</strong>) 
					Exam score is <strong>$examScore</strong>
					which is high than required set exam score <strong>$exam_score</strong>."; 
					unlink($uploadedFile);		 
					echo $erroMsg.$msg_e.$msgEnd;
					echo "<script type='text/javascript'> 
								$script_scroll_cm
						</script>"; exit; 
					$is_clean = false;																		
					
				}else{ $totalScore = ($fi_score + $se_score + $th_score + $fo_score + $fif_score 
										+ $six_score + $examScore); }
			
																					
			}	
			
		}else{  /* display error */
		
			$msg_e .= "*Ooops Error, could not find school exam format configurations."; 
			unlink($uploadedFile);		 
			echo $erroMsg.$msg_e.$msgEnd;
			echo "<script type='text/javascript'> 
								$script_scroll_cm
						</script>"; exit; 
			$is_clean = false; 
					
		} 
			
		fobrainRSCont: /* if input is null continue from here */
		
		$c_count++;
		
		if (  (floor($totalScore) > 100) )  {  /* check subject total score is more than 100 */											
																	
			$msg_e .= "*Ooops Error, student with Reg. No. <strong>$regNum</strong>
			(<strong>Row No. $row_no - Column $excelScoreCol</strong>)   total score 
			is <strong>$totalScore</strong>. 
			Please total score can not be more than 100 or please input dashed '-' where 
			score is empty."; 
			unlink($uploadedFile);		 
			echo $erroMsg.$msg_e.$msgEnd;
			echo "<script type='text/javascript'> 
								$script_scroll_cm
						</script>"; exit; 
			$is_clean = false;	
			
		}else{

			if ( (floor($totalScore) > 1) && (floor($totalScore) <= 100) )  {  /* check total */ 
			
				$cc_count++;
			
			}

		}
		
		/*
		if ($totalScore == '')   {  

		}else{ 
			$cc_count++; 
			
		} 
		*/
				
		if(($courseCountLimit == 'all') || ($cc_count >= $courseCountLimit)){  /* check class course limit */	
					
			$c_count = $cc_count;
					
		}else{
					
			$c_count = $courseCountLimit;
					
		}  	

		$rsSumArr[$ksum] = $totalScore;
		
		$scoreInt++;
		$totalScore = '';

		
	
 