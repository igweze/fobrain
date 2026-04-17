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
	This script load class result
	------------------------------------------------------------------------*/ 


		if (!defined('fobrain')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
 		
			$top_cols = 0;
		?>	 
 
		<!-- row -->
		<div class="row gutters my-10 highRSDiv">
			<div class="col-12">	
				<!-- card start -->
				<div class="card card-shadow">
					<div class="card-header-wiz">
						<h4>
							<i class="mdi mdi-account-check fs-18"></i> 
							Class Result Manager
						</h4>
					</div> 
					<div id="msg-box"></div> 					
					<div class="card-body">  

						<div class="row gutters mb-25 mt-10 justify-content-center">
							<div class="hints col-lg-12">
								[<i class="mdi mdi-help-circle-outline"></i>] 
								Click on Student Term Total, Average or Position to view student termly result. Mores so,
								Click also on Annual Total, Average or Position to view student annual result
							</div>
						</div>								
								
					<?php				

						$editingStage = false;
						$rsSettings = '';

						$academic_yr = recentAcademicYear($level, $session_fi); /* retrieve school session academic year */ 
				
						$rsStatus = fobrainResultStatus($conn, $sessionID, $class, $level, $term);	 /* student result status */
						
						$rs_status = $rslist[$rsStatus];
						
						if ($rsStatus == $rseditingStage){  /* check class result status  */  
						
							$editingStage = true; 
							//$rsSettings = "<a href = '$regNum@@$level@@$term' class='OverlayBoxConducts'>Add This Result Settings</a>";
							
						} else {
							
							$editingStage = false; 
							//$rsSettings = '';
							
						}

						$show_status = "<font color='#996600'> ( ".$rs_status." )</font>"; 


$sytleTbale =<<<IGWEZE

			
			<style type="text/css">

			 
			</style>

IGWEZE;
         
			$top_cols = (((($stop_njideka - $start_nkiru) + 1) * 2) + 7); 
			$sortCol = ($top_cols - 3); 

$table_head =<<<IGWEZE

	<div id='wizg-wrapper'></div>
	$sytleTbale
	<script type='text/javascript'>  renderTable(); </script>
	<div class="table-responsive">
		<!-- table --> 
		<table class='table table-hover table-responsive table-sm table-small wiz-table'>					
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
				<td colspan = "$top_cols" class="text-center font-head-1  fw-600 text-info fs-14"> 
					Academic Year  - <span class="text-danger">$academic_yr </span> |  Year of Admssion -   
					<span class="text-danger"> $session_fi - $session_se </span>   
				</td>
			</tr>


			<tr> 
				<td colspan = "$top_cols"  class="text-center font-head-1  fw-600 text-info fs-13"> 
					<span class="text-danger">$level_val $class_val, $term_value</span>   | Result Status  $show_status      
				</td>
			</tr>
			
			

IGWEZE;

			

			if(($query_i_strings_nk != "") ){				
				
				/* select class result */ 
				
				$ebele_mark = "SELECT r.nk_regno, f.$query_i_strings, g.$query_i_strings_nk, j.$query_i_strings_nj

                         FROM $i_reg_tb r INNER JOIN $sdoracle_sub_score_nk f
						 
						 ON (r.ireg_id = f.ireg_id)

                          AND r.session_id = :session_id
						 
						  AND r.$nk_class = :class

				          AND r.active = :foreal
						 
						  INNER JOIN $sdoracle_grade_nk g
						 
						  ON (r.ireg_id = g.ireg_id)
						 
						  INNER JOIN $sdoracle_grand_score_nk j
						 
						  ON (g.ireg_id = j.ireg_id)
						 
						  ORDER BY j.$nj_position  ASC"; 

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
					<th><div>Picture</div></th> 
					<th><div>Student <hr class='text-danger my-5 py-0'> Reg No.</div></th>";

					for ($i = $start_nkiru; $i <= $stop_njideka; $i++) {  /* loop array */
						
						$top_course = substr($course_info_mark[$i][2], 0, 20);
						
						echo "<th class='sort-numeric'><span class='vertical-lr rotated'>";
						echo $top_course;

						echo "</span></th>"; 

						echo "<th class='sort-numeric hideColumn' class='vertical'><span class='vertical-lr rotated'>";
						echo "Subject Position";	
						echo "</span></th>";


					}

					echo" <th class='sort-numeric'><span class='vertical-lr rotated'>TOTAL SCORE</span></th>";
					echo" <th class='sort-numeric'><span class='vertical-lr rotated'>AVERAGE</span></th>";
					echo" <th class='sort-numeric'><span class='vertical-lr rotated'>CLASS POSITION</span></th>";
					echo" <th class='hideColumn'><span class='vertical-lr rotated'>Tasks</span> </th>";
					echo  "</tr> </thead><tbody>";
				
				
					$f = 0; 	   
					$c = 0; $cr = 0;
					$gr_start = ($i_stop_loop * 2) + 2;	   
					$gr_stop = $gr_start + 2;
					$avgScore = $gr_start + 1;
					$avgS_noRS = 0; $avgS_fail = 0; $avgS_fair = 0; $avgS_pass = 0; $avgS_good = 0; $avgS_vgood = 0; $avgS_excel = 0;

					$serial_no = 0;
					
					while($row[] = $igweze_prep->fetch(PDO::FETCH_BOTH)) {  /* loop array */	 
						
						$p = $i_stop_loop + 2;
			   
						$serial_no++;
						
						echo  "<tr  class='gradeX'>";

						echo "<td> $serial_no </td>"; 

						for ($i = $inti_reg_no_arr; $i <= $inti_reg_no_arr; $i++) {  /* loop array */ 
							
							$regNum = $row[$f][$inti_reg_no_arr];
							$stuData = studentName($conn, $regNum);  /* students name information  */ 
							$stuPic = studentPicture($conn, $regNum);  /* students picture information  */
							echo "<td>";							 
							echo "<img src = '$stuPic' class='img-h-50 img-circle img-thumbnail'>";
							echo "</td>"; 
							echo "<td>";
							echo "<span style='text-transform:uppercase;' class=' text-info font-head-1a fs-12a fw-600'> 
							$regNum <hr class='text-danger my-5 py-0' /> $stuData </span>";
							echo "</td>";

						}

						for ($i = $i_start_loop; $i <= $i_stop_loop; $i++) {  /* loop array */

							
							$scores =  $row[$f][$i];
							$positio = $row[$f][$p];
					
							echo "<td align = 'center' >";

							
							if(($scores == '') || ($scores == $i_false)){$scores = '&nbsp;-&nbsp;';}
							
							echo  $scores; //$row[$f][$i];
							
							echo "</td>";

							echo "<td align = 'center' >";

							
							if($positio == '') {$positio = '&nbsp;-&nbsp;';}
							
							echo  $positio; //$row[$f][$p]s

							echo "</td>";

							$cr = $cr + 1; $p = $p + 1;
							$scores = ''; $positio = '';

						}


						for ($ii = $gr_start; $ii <= $gr_stop; $ii++) {  /* loop array */
							
							echo "<td align = 'center' id='rs_bgcolo_gr'> ";

							$position =  $row[$f][$ii];
							$avgS = $row[$f][$avgScore];
							if($ii == $gr_stop){ $positionST = studentPostionSup($position); }
							else{ $positionST = $position; }
							
							if($positionST == ''){$positionST = '&nbsp;&nbsp;&nbsp;';}
							
							echo $positionST;
							
		   
							echo "</td>"; 
							
						
						  
						   	if($ii == $avgScore){  /* retrieve chart information */
							   
								if (($avgS <= 0) || ($avgS == '')){
									
									$avgS_noRS++;
								
								}elseif (($avgS >= 1) && ($avgS <= 39.9)) {
								
									$avgS_fail++;
								
								}elseif (($avgS >= 40) && ($avgS <= 44.9)) {
									
									$avgS_fair++;
								
								}elseif (($avgS >= 45) && ($avgS <= 49.9)) {
									
									$avgS_pass++;
									
								}elseif (($avgS >= 50) && ($avgS <= 59.9)) {
									
									$avgS_good++;
									
								}elseif (($avgS >= 60) && ($avgS <= 69.9)) {
								
									$avgS_vgood++;
									
								}elseIf (($avgS >= 70) && ($avgS <= 100)) {
									
									$avgS_excel++;
									
								}else{ 
									
								}
						
							}
							
							$positionST =''; $avgS = '';
							
						}
					
						$is_certify = $row[$f][$is_certify_arr_no];;


						if (($admin_grade == $cm_fobrain_grd) || ($admin_grade == $admin_fobrain_grd)){  /* check admin */  

							if (($rsStatus == $editingStage) || ($rsStatus == $rscomputedStage)){  /* check result status */ 
							
								$show_edit = "
								
								<p class='mb-10'>
									<a href='javascript:;' id='".$regNum.'@@'.$session.'@@'.$level.'@@'.$class.'@@'.$term.'@@'.$foreal."' 
										class='edit-term-result hidePrintBtn text-slateblue btn waves-effect btn-label waves-light'>									
										<i class='mdi mdi-square-edit-outline label-icon'></i> Edit  
									</a>	
								</p>
								<p class='mb-10'>
									<a href='javascript:;' id='".$regNum.'@@'.$level.'@@'.$term.'@@'.$class.'@@'.$foreal."' 
										class='edit-conduct-ov hidePrintBtn text-sienna btn waves-effect btn-label waves-light'>									
										<i class='mdi mdi-trophy-award label-icon'></i>   Conducts
									</a>	
								</p> 
								<p>
									<a href='javascript:;' id='".$regNum.'@@'.$session.'@@'.$level.'@@'.$class.'@@'.$term.'@@'.$foreal."'  
										class='edit-comment-rs hidePrintBtn text-danger btn waves-effect btn-label waves-light'>									
										<i class='mdi mdi-shield-star-outline label-icon'></i>   Comments
									</a>	
								</p>"; 
			 
							}else{
								
								$show_edit = ''; 
							}


						}else {

							$show_edit = "";
							$show_is_certify = ""; 

						} 
							
						$show_view = "
							<p class='mb-10'>
								<a href='javascript:;' id='$regNum@@$level@@$term' class='view-term-result hidePrintBtn text-sienna btn waves-effect btn-label waves-light'>									
									<i class='mdi mdi-text-box-search label-icon'></i> View 
								</a>	
							</p>";
														

						echo '<td>
						
						<div class="btn-group">
							<a href="javascript:;" class="btna btn-tasks  waves-effect waves-light dropdown-toggle p-5" data-bs-toggle="dropdown" aria-haspopup="true"
							data-bs-display="static" aria-expanded="false">
								<i class="mdi mdi-dots-grid align-middle fs-18"></i>
							</a> 
							<div class="dropdown-menu dropdown-menu-lg-end p-10 dropdown-shadow end-0 animate__animated animate__flipInY"> 								 
								'.$show_view.''.$show_edit.' 
							</div>
						</div>';

						echo "</td>"; 
							

						$f = $f + 1;

						$p = '';
						$is_certify = '';

						echo  "</tr>";

					}
		  
					echo "</tbody> "; 
					echo "<tfoot>
		
						<tr>
								<td colspan = '$top_cols' style='padding:8px;'>  $rsAdsFooter</td>
						</tr>	";
					echo "</tfoot>
					</table>
					<!-- / table -->
					</div>";  
						 
?>

					<!-- row -->	
					<div class="row">   
						<div class="row gutters mt-30 mb-25 justify-content-center">
							<div class="hints col-lg-4">
								[<i class="mdi mdi-help-circle-outline"></i>] 
								Graphical Data Representation
							</div>
						</div>

						<div class="row gutters justify-content-center">
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 hide-res">
								<div id="wiz-chart-1"  class="apex-charts" ></div>
							</div>
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
								<div id="wiz-chart-2"  class="apex-charts" ></div>
							</div> 
						</div> 
					</div>		

<?php 		
			
				}else{  /* display error */

					echo "<script type='text/javascript'>  hidePageLoader(); </script>"; 
					$msg_e = "Ooops, no record was found for <strong> $stu_class $class $term_value 
					$session_fi - $session_se session</strong>";						
					echo $erroMsg.$msg_e.$msgEnd; //exit; 	
					  
				
				}

			}else{
				
				echo "<script type='text/javascript'>  hidePageLoader(); </script>";
				$msg_e = "Ooops error, no subject/course information was added for <span class='bold-msg'> 
				$stu_class $class $term_value</span>";						
				echo $erroMsg.$msg_e.$msgEnd;  
				
			}	 								
				
 
			echo ' 
							</div>
						</div>
						<!-- card end -->	
					</div>
				</div>
				<!-- / row -->';
				 
				$overlay_style = "wiz-overlay-content";
				require_once ($fobrainFormTeacherDir.'rs-config-wrapper.php');
				
				echo "<div id='overlay-rs-box'></div>";	
				
				 
?>


						</div>
					</div>
					<!-- card end -->	
				</div>
			</div>
			<!-- / row -->    

			<script src="<?php echo $fobrainTemplate; ?>js/apexcharts.js"></script>		
			<script type="text/javascript"> 
				
				setTimeout(function() {
						$('.hideTBColsBtn').fadeOut('fast')
					}, 1000);  
					
				var options = {
					series: [<?php echo "$avgS_noRS, $avgS_fail, $avgS_fair, $avgS_pass, $avgS_good, $avgS_vgood, $avgS_excel"; ?>],
					chart: {
					width: '100%',
					type: 'pie',
					},
					labels: ['No Result/s', 'Fail (0 - 39)', 'Fair (40 - 44)', 'Pass (45 - 49)', 'Good (50 - 59)', 'Very Good (60 - 69)', 'Excellent (70 - 100)'],
					colors: [
						'#000',
						'#DC143C',
						'#8B4500',
						'#8B008B',
						'#4B0082',
						'#FF34B3',
						'#2E8B57', 
					],
					responsive: [{
					breakpoint: 480,
					options: {
						chart: {
						width: 200
						},
						legend: {
						position: 'bottom'
						}
					}
					}]
				}; 
			
				var chart = new ApexCharts(document.querySelector("#wiz-chart-1"), options);
				chart.render();
	

				var options = {
					series: [{
						data: [<?php echo "$avgS_noRS, $avgS_fail, $avgS_fair, $avgS_pass, $avgS_good, $avgS_vgood, $avgS_excel"; ?>]
					}],
					chart: {
						type: 'bar',
						height: 350
					},
					plotOptions: {
						bar: {
							borderRadius: 4,
							borderRadiusApplication: 'end',
							horizontal: true,
						}
					},
					
					dataLabels: {
						enabled: false
					},
					xaxis: {
						categories: [
							'No Result/s', 'Fail (0 - 39)', 'Fair (40 - 44)', 'Pass (45 - 49)', 'Good (50 - 59)', 'Very Good (60 - 69)', 'Excellent (70 - 100)'
						],
					}
				};

				var chart = new ApexCharts(document.querySelector("#wiz-chart-2"), options);
				chart.render();

				//hidePageLoader();  
	
			</script> 