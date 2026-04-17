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
	
	
*/
 
	if (!defined('fobrain')) /* This checks if this page was wrongly access by users */

	die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');

				
if(!session_id()){
    session_start();
} 
		 
		$conLI = mysqli_connect($server, $username, $password, $fobrainDB); /* database parameters */

		if (mysqli_connect_errno()){ /* validating database connection */
			
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
			
			$msg_e ='Ooops, a critical has occur. Please contact the devloper immediately and report as error C404';
			
			echo $errorMsg.$msg_e.$eEnd; 
			echo "<script type='text/javascript'>  
						$('.rs-config-wrap, .exit-rs-config').fadeIn(2000);
						$('#config-loader').fadeOut(2500); 
					</script>";exit;
			
		} 

		for($i = $start_nkiru; $i <= $stop_njideka; $i++){ /* loop through student subject scores */
		
			$score = $course_info_mark[$i][3];
			$posi = $course_info_mark[$i][4];
			
			/* select and ranking subject position  */
			$ebele = "SELECT f.ireg_id, f.$score, a.ireg_id, a.$nk_class, 
		
					FIND_IN_SET(
		
								f.$score,
		
					(SELECT  GROUP_CONCAT(
								DISTINCT f.$score
								ORDER BY f.$score  DESC
					)
					
					FROM    $sdoracle_sub_score_nk f, $i_reg_tb a  
		
						WHERE f.ireg_id = a.ireg_id
		
						AND a.$nk_class = '$class' 
		
						AND  a.session_id = $sessionID)
		
						) as ranking
						
					FROM   $sdoracle_sub_score_nk f, $i_reg_tb a  
		
						WHERE f.ireg_id = a.ireg_id
		
						AND a.$nk_class = '$class' 
		
						AND  a.session_id = $sessionID";
	
	
			$igweze_mark = mysqli_query($conLI, $ebele);
			

			while ($row = mysqli_fetch_array($igweze_mark, MYSQLI_ASSOC)) {		
				
				$ireg_m = $row['ireg_id']; 
				$c = $row[$score]; 
				$position = $row['ranking']; 
				$d = $row[$nk_class]; 
	
					/* update subject position  */ 
					$ebele_update = "UPDATE $sdoracle_grade_nk SET 
		
								$posi = $position
								
								
								WHERE ireg_id = $ireg_m ";


						$igweze_mark_update = mysqli_query($conLI, $ebele_update);
			}

		} 

		$score_2 = ''; $posi_2 = '';

		$score_2 = $i_grade_grand[$i_ggr];
		$posi_2 = $i_grade_grand[$i_gpo];
			
		/* select and ranking class position  */
		$ebele_2 = "SELECT f.ireg_id, f.$score_2, a.ireg_id, a.$nk_class,
		
					FIND_IN_SET(
		
								f.$score_2,
		
					(SELECT  GROUP_CONCAT(
								DISTINCT f.$score_2
								ORDER BY f.$score_2  DESC
					)
					
					FROM    $sdoracle_grand_score_nk f, $i_reg_tb a  
		
						WHERE f.ireg_id = a.ireg_id
		
						AND a.$nk_class = '$class' 
		
						AND  a.session_id = $sessionID)
		
						) as ranking
						
					FROM   $sdoracle_grand_score_nk f, $i_reg_tb a  
		
						WHERE f.ireg_id = a.ireg_id
		
						AND a.$nk_class = '$class' 
		
						AND  a.session_id = $sessionID";
	
	
		$igweze_mark_2 = mysqli_query($conLI, $ebele_2) or die(mysqli_error()); 
			
		while ($row_2 = mysqli_fetch_array($igweze_mark_2, MYSQLI_ASSOC)) { 
			
			$ireg_m_2 = $row_2['ireg_id']; 
			$c = $row_2[$score_2]; 
			$position_2 = $row_2['ranking']; 
			$d = $row_2[$nk_class]; 
			
			/* update class position  */ 		

			$ebele_update_2 = "UPDATE $sdoracle_grand_score_nk SET 

						$posi_2 = $position_2 
						
						WHERE ireg_id = $ireg_m_2 "; 

			$igweze_mark_update_2 = mysqli_query($conLI, $ebele_update_2);

		} 


		if($cal_session == true){ /* if calculate annual is true  */
				
			$score_3 = ''; $posi_3 = '';
			$score_3 = $i_grade_grand[$ji_ggr];
			$posi_3 = $i_grade_grand[$ji_gpo];
			
			updateClassAnnualRS($conn, $sdoracle_grand_score_nk, $sessionID, $nk_class, $class, $fiGrandAvg, $seGrandAvg, $thGrandAvg, $grandAvg);
			
			/* select and ranking class annual position  */
			
			$ebele_3 = "SELECT f.ireg_id, f.$score_3, a.ireg_id, a.$nk_class,
			
						FIND_IN_SET(
			
									f.$score_3,
			
						(SELECT  GROUP_CONCAT(
									DISTINCT f.$score_3
									ORDER BY f.$score_3  DESC
						)
						
						FROM    $sdoracle_grand_score_nk f, $i_reg_tb a  
			
							WHERE f.ireg_id = a.ireg_id
			
							AND a.$nk_class = '$class' 
			
							AND  a.session_id = $sessionID)
			
							) as ranking
							
						FROM   $sdoracle_grand_score_nk f, $i_reg_tb a  
			
							WHERE f.ireg_id = a.ireg_id
			
							AND a.$nk_class = '$class' 
			
							AND  a.session_id = $sessionID";
		
		
			$igweze_mark_3 = mysqli_query($conLI, $ebele_3) or die(mysqli_error());
		
			while ($row_3 = mysqli_fetch_array($igweze_mark_3, MYSQLI_ASSOC)) {
					
				$ireg_m_3 = $row_3['ireg_id']; 
				$c = $row_3[$score_3]; 
				$position_3 = $row_3['ranking']; 
				$d = $row_3[$nk_class]; 
	
				/* update class annual position  */	
				$ebele_update_3 = "UPDATE $sdoracle_grand_score_nk SET 
	
							$posi_3 = $position_3
							
							
							WHERE ireg_id = $ireg_m_3 ";


				$igweze_mark_update_3 = mysqli_query($conLI, $ebele_update_3);
			} 

		}
?>
