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
	This script handle class annual transcript
	------------------------------------------------------------------------*/ 


		if (!defined('fobrain')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');

		$annualAvg_noRS = 0; $annualAvg_fail = 0; $annualAvg_fair = 0; $annualAvg_pass = 0; $annualAvg_good = 0; $annualAvg_vgood = 0; $annualAvg_excel = 0;
?>		

		<!-- row -->
		<div class="row gutters my-10 ">
			<div class="col-12">	
				<!-- card start -->
				<div class="card card-shadow">
					<div class="card-header-wiz">
						<h4>
							<i class="mdi mdi-account-check fs-18"></i> 
							Promotes / Demotes Students
						</h4>
					</div> 
					<div id="msg-box"></div> 					
					<div class="card-body" id="promotionDiv"> 
 


						<div class="row gutters mb-25 mt-10">
							<div class="hints">
								[<i class="mdi mdi-help-circle-outline"></i>] 
								Click on Student Term Total, Average or Position to view student termly result. Mores so,
								Click also on Annual Total, Average or Position to view student annual result
							</div>
						</div>
						  
<?php
			  
			 	$actionSel= "";

				$rsStatus = fobrainResultStatus($conn, $sessionID, $class, $level, $term);	 /* student result status */ 

				$academic_yr = recentAcademicYear($level, $session_fi); /* retrieve school session academic year */ 
		
				//$rsStatus = fobrainResultStatus($conn, $sessionID, $class, $level, $term);	 /* student result status */
				
				$rs_status = $rslist[$rsStatus];
				
				if ($rsStatus == $rseditingStage){  /* check class result status  */  
				
					$editingStage = true; 
					//$rsSettings = "<a href = '$regNum@@$level@@$term' class='OverlayBoxConducts'>Add This Result Settings</a>";
					
				} else {
					
					$editingStage = false; 
					//$rsSettings = '';
					
				}

				$show_status = "<font color='#996600'> ( ".$rs_status." )</font>"; 
						
				if($rsStatus != $rspublishStage){  /* if result has not been published */  
					$selected  = "";
					$actionSel .= ' 
					<select class="form-control mt-15 fs-10"  id="rollTask" name="rollTask" style="width:150px;">

						<option value = "1">Select Action </option>';

						foreach($promotionArr as $p_key => $p_value){  /* loop array */

							$actionSel .= '<option value="'.$p_key.'"'.$selected.'>'.$p_value.'</option>' ."\r\n";

						}			

					$actionSel .= '</select>';

					$promTop = '
					<!-- form -->
					<form class="form-horizontal" id="frmsave-class-promo" role="form">	 

						<button  class="btn btn-sm btn-primary save-class-promo pull-right my-5">
						<i class="mdi mdi-list-status fs-18"></i> Promotes / Demotes</button> 
						<br clear="all" /><br clear="all" />
						<input type="hidden" value="'.$level.'" name="level" />
						<input type="hidden" value="effectPromotion" name="classData" />';

					$promBot = ' 
						<button  class="btn btn-sm btn-primary save-class-promo pull-left mt-20">
						<i class="mdi mdi-list-status fs-18"></i> Promotes / Demotes</button>
					</form><!-- / form -->';	
					
				}else{  /* if result has been published */ 

					$promTop = ""; $promBot = ""; 

				}	
	   
$table_body =<<<IGWEZE

				$promTop
				
				<div id='edit-msg'></div>
				<div class="table-responsive"> 
				<!-- table -->
				<table class='table table-hover table-responsive table-sm table-small'>
		
					<thead>	 
						<tr>
							<th colspan = "17" style="background-color:#fff !important;">    
								<div class="row">							
									<div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12 text-center hide-res"> 
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
							<td colspan = "17" class="text-center font-head-1  fw-600 text-info fs-14"> 
								Academic Year  - <span class="text-danger">$academic_yr </span> |  Year of Admssion -   
								<span class="text-danger"> $session_fi - $session_se </span>   
							</td>
						</tr>


						<tr> 
							<td colspan = "17"  class="text-center font-head-1  fw-600 text-info fs-13"> 
								<span class="text-danger">$level_val $class_val, $term_value</span>   | Result Status  $show_status      
							</td>
						</tr>
 
						<tr>
							<th>S/N</th>
							<th>Picture</th>
							<th>Reg No.</th>
							<th>Student Name</th>
							<th><span class="vertical-lr rotated">1st Total Score</span></th>
							<th><span class="vertical-lr rotated">1st Term Average</span></th>
							<th><span class="vertical-lr rotated">1st Term Position</span></th>
							<th><span class="vertical-lr rotated">2nd Total Score</span></th>
							<th><span class="vertical-lr rotated">2nd Term Average</span></th>
							<th><span class="vertical-lr rotated">2nd Term Position</span></th>
							<th><span class="vertical-lr rotated">3rd Term Total Score</span></th>
							<th><span class="vertical-lr rotated">3rd Term Average</span></th>
							<th><span class="vertical-lr rotated">3rd Term Position</span></th>						
							<th><span class="vertical-lr rotated">Annual Score</span></th>
							<th><span class="vertical-lr rotated">Annual Average Score</span></th>
							<th><span class="vertical-lr rotated">Annual Position</span></th>
							<th><div>Remarks</div>						 
								$actionSel
							</th> 				
						</tr>
					</thead>
					
					<tbody>	 

IGWEZE;

				echo $table_body; $serial_no = 0;
				
				/* select information */ 
				
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
				
					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {  /* loop array */		
			
						$regNum = $row['nk_regno'];
						$ID = $row['ireg_id'];
						$pic = $row['i_stupic'];
						$fname = $row['i_firstname'];
						$lname = $row['i_lastname'];
						$mname = $row['i_midname'];
						
						$serial_no++; 
						 
						$student_img = picture($school_pic_dir.$session_fi.'_'.$session_se.'/', $pic, "student"); 
				
						$term = $fi_term; $promotionStatus = false;	$subfCounter = 0;	
				
						require  $fobrainClassConfigDir;   /* include class configuration script */ 				
						$fiQuery = $query_i_strings_nj;   /* query string */ 
						
						
						$term = $se_term; $promotionStatus = false;	$subfCounter = 0;	
				
						require  $fobrainClassConfigDir;   /* include class configuration script */ 	
						$seQuery = $query_i_strings_nj;   /* query string */	
						

						$term = $th_term; $promotionStatus = false;	$subfCounter = 0;	
				
						require  $fobrainClassConfigDir;   /* include class configuration script */ 
						$thQuery = $query_i_strings_nj;   /* query string */	
						
						$annualQuery = "$fiQuery , $seQuery , $thQuery, certify";
						
						/* select information */ 
						
						$ebele_mark_1 = "SELECT r.ireg_id, f.$annualQuery

										FROM $i_reg_tb r INNER JOIN $sdoracle_grand_score_nk f
									
										ON (r.ireg_id = f.ireg_id)

										AND r.session_id = :session_id 
								 
										AND r.$nk_class = :class

										AND r.active = :foreal
								  
										AND r.nk_regno = :nk_regno";						   
							 
						$igweze_prep_1 = $conn->prepare($ebele_mark_1);
						$igweze_prep_1->bindValue(':nk_regno', $regNum, PDO::PARAM_STR);				
						$igweze_prep_1->bindValue(':session_id', $sessionID, PDO::PARAM_STR);				
						$igweze_prep_1->bindValue(':foreal', $foreal, PDO::PARAM_STR);				
						$igweze_prep_1->bindValue(':class', $class, PDO::PARAM_STR);
						 
						$igweze_prep_1->execute();
						
						$rows_count_1 = $igweze_prep_1->rowCount(); 
						
						if($rows_count_1 == $foreal) {  /* check array is empty */
						
							while($row_1[] = $igweze_prep_1->fetch(PDO::FETCH_BOTH)) {  /* loop array */ }	
						
						}
						
						$arrLoop = 0;							
						$regID =  $row_1[$arrLoop][0];
						$fiTotal =  $row_1[$arrLoop][1];
						$fiAverage =  $row_1[$arrLoop][2];
						$fiPosition =  $row_1[$arrLoop][3];
						
						$fiTermPoistion = studentPostionSup($fiPosition);  /* student first term result position suffix  */	
						
						if($fiTotal == "") {$fiTotal = " - "; }
						if($fiAverage == "") {$fiAverage = " - "; }
						
						$seTotal =  $row_1[$arrLoop][4];
						$seAverage =  $row_1[$arrLoop][5];
						$sePosition =  $row_1[$arrLoop][6];
						
						$seTermPoistion = studentPostionSup($sePosition);  /* student second term result position suffix  */	
						
						if($seTotal == "") {$seTotal = " - "; }
						if($seAverage == "") {$seAverage = " - "; }
						
						$thTotal =  $row_1[$arrLoop][7];
						$thAverage =  $row_1[$arrLoop][8];
						$thPosition =  $row_1[$arrLoop][9];
						
						$thTermPoistion = studentPostionSup($thPosition);  /* student third term result position suffix  */	
						
						if($thTotal == "") {$thTotal = " - "; }
						if($thAverage == "") {$thAverage = " - "; }
						
						
						$grandTotal =  $row_1[$arrLoop][10];
						$grandAverage =  $row_1[$arrLoop][11];
						$grandPosition =  $row_1[$arrLoop][12];
						
						$promID =  $row_1[$arrLoop][13];
						
						$grandTermPoistion = studentPostionSup($grandPosition);  /* student annual result position suffix  */	
						
						if($grandTotal == "") {$grandTotal = " - "; }
						if($grandAverage == "") {$grandAverage = " - "; }
						if(($grandPosition == "")  || ($grandPosition == $i_false)){$grandPosition = " - "; }

						
						
						if($fiAverage >= $fiVal){ $fiAnnDiv = $fiVal;}
						else{$fiAnnDiv = $i_false; $fiAverage = ""; }
						
						if($seAverage >= $fiVal){ $seAnnDiv = $fiVal;}
						else{$seAnnDiv = $i_false; $seAverage = "";}
						
						if($thAverage >= $fiVal){ $thAnnDiv = $fiVal;}
						else{$thAnnDiv = $i_false; $thAverage = ""; }
						
						
						$annualDiv = ($fiAnnDiv + $seAnnDiv + $thAnnDiv);
						$annualAverage = (intval($fiAverage) + intval($seAverage) + intval($thAverage));
						
						if($annualAverage > $fiVal){  /* check if average is greater than 1  */
							
							$annualAvg = ($annualAverage/$annualDiv);						
							$annualAvg = number_format($annualAvg, 1);  
							
						}else{ $annualAverage = ""; $annualAvg = ""; }	 


						if (($annualAvg <= 0) || ($annualAvg == '')){
									
							$annualAvg_noRS++;
						
						}elseif (($annualAvg >= 1) && ($annualAvg <= 39.9)) {
						
							$annualAvg_fail++;
						
						}elseif (($annualAvg >= 40) && ($annualAvg <= 44.9)) {
							
							$annualAvg_fair++;
						
						}elseif (($annualAvg >= 45) && ($annualAvg <= 49.9)) {
							
							$annualAvg_pass++;
							
						}elseif (($annualAvg >= 50) && ($annualAvg <= 59.9)) {
							
							$annualAvg_good++;
							
						}elseif (($annualAvg >= 60) && ($annualAvg <= 69.9)) {
						
							$annualAvg_vgood++;
							
						}elseIf (($annualAvg >= 70) && ($annualAvg <= 100)) {
							
							$annualAvg_excel++;
							
						}else{ }
							
						echo "<tr>
						
						<td width='3%'>$serial_no</td>
						<td><img src = '$student_img' class='img-h-50 img-circle img-thumbnail'> </td>
						<td>$regNum </td>
						<td>$lname $fname $mname</td> 
						<td>
							<a href='javascript:;' id='$regNum@@$level@@1' class='view-term-result hidePrintBtn'>		
								$fiTotal
							</a>
						</td>
						<td>
							<a href='javascript:;' id='$regNum@@$level@@1' class='view-term-result hidePrintBtn'>
								$fiAverage
							</a>
						</td>
						<td>
							<a href='javascript:;' id='$regNum@@$level@@1' class='view-term-result hidePrintBtn'>
								$fiPosition
							</a>
						</td>


						<td>
							<a href='javascript:;' id='$regNum@@$level@@2' class='view-term-result hidePrintBtn'>		
								$seTotal
							</a>
						</td>
						<td>
							<a href='javascript:;' id='$regNum@@$level@@2' class='view-term-result hidePrintBtn'>
								$seAverage
							</a>
						</td>
						<td>
							<a href='javascript:;' id='$regNum@@$level@@2' class='view-term-result hidePrintBtn'>
								$sePosition
							</a>
						</td>

						<td>
							<a href='javascript:;' id='$regNum@@$level@@3' class='view-term-result hidePrintBtn'>		
								$thTotal
							</a>
						</td>
						<td>
							<a href='javascript:;' id='$regNum@@$level@@3' class='view-term-result hidePrintBtn'>
								$thAverage
							</a>
						</td>
						<td>
							<a href='javascript:;' id='$regNum@@$level@@3' class='view-term-result hidePrintBtn'>
								$thPosition
							</a>
						</td>  
						
						<td>
							<a href='javascript:;' id='$regNum@@$level@@all' class='view-term-result hidePrintBtn'>	
								$grandTotal
							</a>
						</td>
						<td>
							<a href='javascript:;' id='$regNum@@$level@@all' class='view-term-result hidePrintBtn'>
								$annualAvg
							</a>
						</td>
						<td>
							<a href='javascript:;' id='$regNum@@$level@@all' class='view-term-result hidePrintBtn'>
								$grandPosition
							</a>
						</td>";
							
							
						if($rsStatus != $rspublishStage){  /* check if result has been published */

$promotionDiv =<<<IGWEZE
        
						<td width='15%' class='text-left'> 
						
							<div class="col-12"> 
								<input type="hidden" value="$regID" name="regID[]" />
								<input type="hidden" value="$regNum" name="regNo[]" />
								<input type="hidden" value="$lname $fname $mname" name="studentName[]" />
								<select class="form-control classCall fs-10"  id="promotion-$regID" name="promotionArr[]" required  style="width:150px;">

                                              
		
IGWEZE;
							echo $promotionDiv;
						
						
							foreach($promotionArr as $promotion_key => $promotion_value){  /* loop array */

								if ($promotion_key == $promID){
									$selected = "SELECTED";
								} else {
									$selected = "";
								}
						
								echo '<option value="'.$promotion_key.'"'.$selected.'>'.$promotion_value.'
								</option>' ."\r\n";

							}	 

$promotionDiv2 =<<<IGWEZE
                
								</select>
							</div> 
						</td>  
	
IGWEZE;
							echo $promotionDiv2; 
							
						}else{
							
							
							//$promotedSub = $promotionArr[$promID];
							
							$promotedSub = classPromotionManagerMin($conn, $promID);  /* school class student promotion manager */							
							echo "<td width='15%'>";
							echo  $promotedSub;
							echo "</td>";

						}	

						echo "</tr>";  
						
						unset($row_1);
						$fiTotal = ''; $fiAverage = ''; $fiPosition = ''; 
						$seTotal = ''; $seAverage = ''; $sePosition = ''; 
						$thTotal = ''; $thAverage = ''; $thPosition = ''; 
						$annualAvg = ''; $grandTotal  = ''; $grandPosition = ''; 
						
					}
			
				}else{  /* display error */
		
					$msg_e = "Ooops Error, No record was found for this search query. Please try another query";	
					echo $erroMsg.$msg_e.$msgEnd; //exit; 							
					echo'<script type="text/javascript">
						$(".save-class-promo").fadeOut(1000);
					</script>';
								
						
				}				
	   
 
				echo "	</tbody> 
						<tfoot>			
							<tr><td colspan = '17' style='padding:8px;'>  $rsAdsFooter</td></tr> 
	   					</tfoot>
					</table>
					<!-- / table -->
				</div>"; 
		
				echo $promBot;

			?>	
			
			
		 
						</div>
					</div>
					<!-- card end -->	
				</div>
			</div>
			<!-- / row -->   

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
				
			<div id='overlay-rs-box'></div> 
			
			<script type='text/javascript'> 

				renderTableFull();

				setTimeout(function() {
					$('.hideTBColsBtn').fadeOut('fast')
				}, 1000);   
							 
			</script> 
			<script src="<?php echo $fobrainTemplate; ?>js/apexcharts.js"></script>		
			<script type="text/javascript"> 
				
				setTimeout(function() {
						$('.hideTBColsBtn').fadeOut('fast')
					}, 1000);  
					
				var options = {
					series: [<?php echo "$annualAvg_noRS, $annualAvg_fail, $annualAvg_fair, $annualAvg_pass, $annualAvg_good, $annualAvg_vgood, $annualAvg_excel"; ?>],
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
						data: [<?php echo "$annualAvg_noRS, $annualAvg_fail, $annualAvg_fair, $annualAvg_pass, $annualAvg_good, $annualAvg_vgood, $annualAvg_excel"; ?>]
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
	
			</script> 			