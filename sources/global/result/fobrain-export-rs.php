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
	This page export class result
	------------------------------------------------------------------------*/ 

 
		if (!defined('fobrain')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
				
		 
?>

			<script type='text/javascript'>   $(".excelExIcon").fadeIn(100); $('#maxPageIcon').trigger('click'); </script> 

<?php 
			
				$academic_yr = recentAcademicYear($level, $session_fi);  /* school session academic year  */   

				$fobrainSchTitle ="<div style = 'padding-bottom:10px;'>  $schoolNameTop </div>
									<div style = 'padding-bottom:10px;'> $schoolAddressTop</div>"; 
		
				$top_cols = ($stop_njideka + 3); 
       

$table_head =<<<IGWEZE


		<div id='wizg-wrapper'></div>
		$sytleTbale
		<script type='text/javascript'>  renderTable(); </script>
		<div class="table-responsive">
			<!-- table --> 
			<table class='table table-hover table-responsive table-sm table-small wiz-table' id='wiz-table-export'>					
			<thead> 
				<tr>
					<th colspan = "$top_cols">
						<div class="row">							
							<div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12 text-center hide-res""> 
								<img src="$sch_logo" alt="School Logo"  class='img-circle img-72'/>
							</div>
							<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12 text-center">
								$fobrainSchTitle 
							</div>
							<div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12 text-center"> 
								<img src="$sch_logo"  alt="Student's Picture"  class='img-circle img-72' />
							</div>							
						</div> 
					</th> 
				</tr>	

				<tr> 
					<th colspan = "$top_cols"> 
						<span class='rshead-cover'><center> $academic_yr Session Class $stu_class $class $term_value Result Sheet</center></span>     		
					</th> 
				</tr> 
 
IGWEZE;

 
				$ebele_mark = "SELECT r.nk_regno, f.$query_i_scores

							FROM $i_reg_tb r INNER JOIN $sdoracle_score_nk f
						 
							ON (r.ireg_id = f.ireg_id)

							AND r.session_id = :session_id
						 
							AND r.$nk_class = :class

							AND r.active = :foreal";						 

			    $igweze_prep = $conn->prepare($ebele_mark);
				$igweze_prep->bindValue(':session_id', $sessionID, PDO::PARAM_STR);				
				$igweze_prep->bindValue(':foreal', $foreal, PDO::PARAM_STR);				
				$igweze_prep->bindValue(':class', $class, PDO::PARAM_STR);								 
 				$igweze_prep->execute();
				
				$rows_count_1 = $igweze_prep->rowCount(); 
				
				if($rows_count_1 >= $foreal) {  /* check array is empty */ 
		  		
					echo $table_head;  

					echo  "
					<tr class='grade'> 
					<th class='sort-numeric'><span class='vertical-lr rotated'>S/N</span></th> 
					<th><div>Student</div></th> 
					<th><div>Reg No.</div></th>";

					for ($i = $start_nkiru; $i <= $stop_njideka; $i++) {  /* loop array */

						//echo "<th class='sort-numeric'><span class='vertical-lr rotated'>";
						echo "<th><span>";
						echo $course_info_mark[$i][1]; 
						echo "</span></th>";  

					} 
					
          			echo  "</tr> </thead><tbody>"; 
				
					$f = 0; 	   
			    	$c = 0;
	   				$gr_start = ($i_stop_loop * 2) + 2;	   
	   				$gr_stop = $gr_start + 2;
					
					while($row[] = $igweze_prep->fetch(PDO::FETCH_BOTH)) {  /* loop array */	 
			  		
						$p = $i_stop_loop + 2;
	   	   
						$serial_no++; 

						echo  "<tr  class='gradeX'>";
	   
						echo "<td align = 'center'> $serial_no </td>"; 

       					for ($i = $inti_reg_no_arr; $i <= $inti_reg_no_arr; $i++) {  /* loop array */

       						
							$regNum = $row[$f][$inti_reg_no_arr];
							$stuData = studentName($conn, $regNum);
							$stuPic = studentPicture($conn, $regNum);

							echo "<td align = 'left' style='text-align:left !important;
							padding-left: 3px !important;' width='20%'>";
	   						echo "<span style='text-align:left; text-transform:uppercase; font-size:12px; font-weight:700;'> 
							
									<img src = '$stuPic' height = '25' width = '25' class='small-picture'> $stuData </span>";

       						echo "</td>";


							echo "<td align = 'left' style='text-align:left !important;
							padding-left: 3px !important;text-transform:uppercase;  font-weight:700;' width='5%'>";
	   						echo $regNum;
       						echo "</td>";

       					}

       					for ($i = $i_start_loop; $i <= $i_stop_loop; $i++) {  /* loop array */
	   
       						
							$scores =  $row[$f][$i];
							
							if($_REQUEST['blank'] == true){ $scores = '';}
					
							echo "<td align = 'center'>";
       						
							if($scores == '') {$scores = '&nbsp;&nbsp;-&nbsp;&nbsp;';}
							
							echo  $scores; //$row[$f][$i];
	   						
       						echo "</td>";


       						$cr = $cr + 1;
							$scores = '';
	   
       				   }


					
						$is_certify = $row[$f][$is_certify_arr_no]; 

       					$f = $f + 1;
 
	   					$p = '';
						$is_certify = '';
	   
	   					echo  "</tr>";


					} 
      
       				echo "</tbody></table><!-- /table --></div>";
					echo '<br clear="all" />';
	   				echo $sdo_tb_footer;
					echo '<br clear="all" />';  
			
				}else{  /* display error */ 

					$msg_e = "Ooops, no record was found for <span class='bold-msg'> $stu_class $class $term_value 
					$session_fi - $session_se session</span>";						
					echo $erroMsg.$msg_e.$msgEnd; 
					echo "<script type='text/javascript'>  hidePageLoader(); </script>"; exit; 	
				} 

				echo "<div id='overlay-rs-box'></div>";	 
			
?>

		<script> 
 
			function exportToExcel() {
				var location = 'data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,';
				var excelTemplate = '<html> ' +
					'<head> ' +
					'<meta http-equiv="content-type" content="text/plain; charset=UTF-8"/> ' +
					'</head> ' +
					'<body> ' +
					document.getElementById("wiz-table-export").innerHTML +
					'</body> ' +
					'</html>'
				window.location.href = location + window.btoa(excelTemplate);
			}
		</script>		