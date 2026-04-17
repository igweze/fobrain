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
	This script load staff and admin common dashboard
	------------------------------------------------------------------------*/  

if(!session_id()){
    session_start();
}


		if (!defined('fobrain')) /* This checks if this page was wrongly access by users */ 
		
		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!'); 
        
		 	
		 
		try {
	
			$eBookNum = libraryBookTypeTotal($conn, $fiVal);  /* school library book type summary */
			$hBookNum = libraryBookTypeTotal($conn, $seVal);  /* school library book type summary */

			$sessionInfoSec = currentSessionInfo($conn);  /* current school session information  */
			$totalStaffs = activeStaffs($conn);  /* school active staff count */				
			
			list ($fiSessionID, $fiSession) = explode ("@$@", $sessionInfoSec);
			
			$seSessionID =  ($fiSessionID - $fiVal);			
			$thSessionID =  ($fiSessionID - $seVal);
			$foSessionID =  ($fiSessionID - $thVal);			
			$fifSessionID =  ($fiSessionID - $foVal);
			$sixSessionID =  ($fiSessionID - $fifVal);


			/* Nursery School Summary */
			$wiz_school_global = "nur";
			require ($fobrainDir.$wiz_config_global);   /* include configuration script */

			$levelArrayNur = studentLevelsArray($conn); /* student level array */
			array_unshift($levelArrayNur,"");
			unset($levelArrayNur[0]); 

			$fifTotalNur = 0; $sefTotalNur = 0; $thfTotalNur = 0;  
			$fimTotalNur = 0; $semTotalNur = 0; $thmTotalNur = 0;

			$fifTotalPri = 0; $sefTotalPri = 0; $thfTotalPri = 0; $fofTotalPri = 0; $fiffTotalPri = 0; $sixfTotalPri = 0;
			$fimTotalPri = 0; $semTotalPri = 0; $thmTotalPri = 0; $fomTotalPri = 0; $fifmTotalPri = 0; $sixmTotalPri = 0;

			$fifTotalSec = 0; $sefTotalSec = 0; $thfTotalSec = 0; $fofTotalSec = 0; $fiffTotalSec = 0; $sixfTotalSec = 0;
			$fimTotalSec = 0; $semTotalSec = 0; $thmTotalSec = 0; $fomTotalSec = 0; $fifmTotalSec = 0; $sixmTotalSec = 0;

			$fiStuTotalNur = studentsPerStandard($conn, $fiSessionID);  /* school active student pupolation count */

			if($fiStuTotalNur >= $foreal){  /* school active gender pupolation count */

				$fifTotalNur = studentsSexPerStandard($conn, $fiSessionID, $femaleG);
				$fimTotalNur = studentsSexPerStandard($conn, $fiSessionID, $maleG);
			}

			$seStuTotalNur = studentsPerStandard($conn, $seSessionID);  /* school active student pupolation count */

			if($seStuTotalNur >= $foreal){  /* school active gender pupolation count */

				$sefTotalNur = studentsSexPerStandard($conn, $seSessionID, $femaleG);
				$semTotalNur = studentsSexPerStandard($conn, $seSessionID, $maleG);
			}

			$thStuTotalNur = studentsPerStandard($conn, $thSessionID);  /* school active student pupolation count */

			if($thStuTotalNur >= $foreal){  /* school active gender pupolation count */

				$thfTotalNur = studentsSexPerStandard($conn, $thSessionID, $femaleG);
				$thmTotalNur = studentsSexPerStandard($conn, $thSessionID, $maleG);
			}


			$activeFTotalNur = ($fifTotalNur + $sefTotalNur + $thfTotalNur);
			$activeMTotalNur = ($fimTotalNur + $semTotalNur + $thmTotalNur );

			$activeStuTotalNur = ($fiStuTotalNur + $seStuTotalNur + $thStuTotalNur);

			/* Nursery School Summary End */


			/* Primary School Summary */

			$wiz_school_global = "pri";
			require ($fobrainDir.$wiz_config_global);   /* include configuration script */

			$levelArrayPri = studentLevelsArray($conn); /* student level array */
			array_unshift($levelArrayPri,"");
			unset($levelArrayPri[0]);  

			$fiStuTotalPri = studentsPerStandard($conn, $fiSessionID);  /* school active student pupolation count */

			if($fiStuTotalPri >= $foreal){  /* school active gender pupolation count */

				$fifTotalPri = studentsSexPerStandard($conn, $fiSessionID, $femaleG);
				$fimTotalPri = studentsSexPerStandard($conn, $fiSessionID, $maleG);
			}

			$seStuTotalPri = studentsPerStandard($conn, $seSessionID);  /* school active student pupolation count */

			if($seStuTotalPri >= $foreal){  /* school active gender pupolation count */

				$sefTotalPri = studentsSexPerStandard($conn, $seSessionID, $femaleG);
				$semTotalPri = studentsSexPerStandard($conn, $seSessionID, $maleG);
			}

			$thStuTotalPri = studentsPerStandard($conn, $thSessionID);  /* school active student pupolation count */

			if($thStuTotalPri >= $foreal){  /* school active gender pupolation count */

				$thfTotalPri = studentsSexPerStandard($conn, $thSessionID, $femaleG);
				$thmTotalPri = studentsSexPerStandard($conn, $thSessionID, $maleG);
			}

			$foStuTotalPri = studentsPerStandard($conn, $foSessionID);  /* school active student pupolation count */

			if($foStuTotalPri >= $foreal){  /* school active gender pupolation count */

				$fofTotalPri = studentsSexPerStandard($conn, $foSessionID, $femaleG); 
				$fomTotalPri = studentsSexPerStandard($conn, $foSessionID, $maleG);
				
			}

			$fifStuTotalPri = studentsPerStandard($conn, $fifSessionID);  /* school active student pupolation count */

			if($fifStuTotalPri >= $foreal){  /* school active gender pupolation count */

				$fiffTotalPri = studentsSexPerStandard($conn, $fifSessionID, $femaleG);
				$fifmTotalPri = studentsSexPerStandard($conn, $fifSessionID, $maleG);
				
			}


			$sixStuTotalPri = studentsPerStandard($conn, $sixSessionID);  /* school active student pupolation count */

			if($sixStuTotalPri >= $foreal){  /* school active gender pupolation count */

				$sixfTotalPri = studentsSexPerStandard($conn, $sixSessionID, $femaleG);
				$sixmTotalPri = studentsSexPerStandard($conn, $sixSessionID, $maleG);
				
			}

			$activeFTotalPri = ($fifTotalPri + $sefTotalPri + $thfTotalPri + $fofTotalPri + $fiffTotalPri + $sixfTotalPri);
			$activeMTotalPri = ($fimTotalPri + $semTotalPri + $thmTotalPri + $fomTotalPri + $fifmTotalPri + $sixmTotalPri);

			$activeStuTotalPri = ($fiStuTotalPri + $seStuTotalPri + $thStuTotalPri + $foStuTotalPri + $fifStuTotalPri
									+ $sixStuTotalPri);

			/* Primary School Summary End */
			

			/* Secondary School Summary */

			$wiz_school_global = "sec";  
			require ($fobrainDir.$wiz_config_global);   /* include configuration script */

			$levelArraySec = studentLevelsArray($conn); /* student level array */
			array_unshift($levelArraySec,"");
			unset($levelArraySec[0]); 


			$fiStuTotalSec = studentsPerStandard($conn, $fiSessionID);  /* school active student pupolation count */

			if($fiStuTotalSec >= $foreal){  /* school active gender pupolation count */

				$fifTotalSec = studentsSexPerStandard($conn, $fiSessionID, $femaleG);
				$fimTotalSec = studentsSexPerStandard($conn, $fiSessionID, $maleG);
			}

			$seStuTotalSec = studentsPerStandard($conn, $seSessionID);  /* school active student pupolation count */

			if($seStuTotalSec >= $foreal){  /* school active gender pupolation count */

				$sefTotalSec = studentsSexPerStandard($conn, $seSessionID, $femaleG);
				$semTotalSec = studentsSexPerStandard($conn, $seSessionID, $maleG);
			}

			$thStuTotalSec = studentsPerStandard($conn, $thSessionID);  /* school active student pupolation count */

			if($thStuTotalSec >= $foreal){  /* school active gender pupolation count */

				$thfTotalSec = studentsSexPerStandard($conn, $thSessionID, $femaleG);
				$thmTotalSec = studentsSexPerStandard($conn, $thSessionID, $maleG);
			}

			$foStuTotalSec = studentsPerStandard($conn, $foSessionID);  /* school active student pupolation count */

			if($foStuTotalSec >= $foreal){  /* school active gender pupolation count */

				$fofTotalSec = studentsSexPerStandard($conn, $foSessionID, $femaleG);
				$fomTotalSec = studentsSexPerStandard($conn, $foSessionID, $maleG);
				
			}

			$fifStuTotalSec = studentsPerStandard($conn, $fifSessionID);  /* school active student pupolation count */

			if($fifStuTotalSec >= $foreal){  /* school active gender pupolation count */

				$fiffTotalSec = studentsSexPerStandard($conn, $fifSessionID, $femaleG);
				$fifmTotalSec = studentsSexPerStandard($conn, $fifSessionID, $maleG);
				
			}


			$sixStuTotalSec = studentsPerStandard($conn, $sixSessionID);  /* school active student pupolation count */

			if($sixStuTotalSec >= $foreal){  /* school active gender pupolation count */

				$sixfTotalSec = studentsSexPerStandard($conn, $sixSessionID, $femaleG);
				$sixmTotalSec = studentsSexPerStandard($conn, $sixSessionID, $maleG);
				
			}

			$activeFTotalSec = ($fifTotalSec + $sefTotalSec + $thfTotalSec + $fofTotalSec + $fiffTotalSec + $sixfTotalSec);
			$activeMTotalSec = ($fimTotalSec + $semTotalSec + $thmTotalSec + $fomTotalSec + $fifmTotalSec + $sixmTotalSec);

			$activeStuTotalSec = ($fiStuTotalSec + $seStuTotalSec + $thStuTotalSec + $foStuTotalSec + $fifStuTotalSec 
							+ $sixStuTotalSec);

			/* Secondary School Summary End */

			$schoolTotal = ($activeStuTotalNur + $activeStuTotalPri + $activeStuTotalSec);
			$schoolFTotal = ($activeFTotalNur + $activeFTotalPri + $activeFTotalSec);
			$schoolMTotal = ($activeMTotalNur + $activeMTotalPri + $activeMTotalSec); 

		}catch(PDOException $e) {
			
			fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
				
		} 
	 
?>
 
		<style> 
			div.timeline {
				width: 100% !important; 
			} 
		</style>
			
		<?php //if (($_SESSION['accessGrade'] != $cm_fobrain_grd)) { ?>		
	 
		<script src="<?php echo $fobrainTemplate; ?>js/apexcharts.js"></script>

		<div <?php echo $fob_view; ?> class="row gutters justify-content-center">	 

			<div class="col-lg-6 mb-25">
				<!-- card -->
				<div class="card card-widget-1 card-shadow">
					<?php 
						$page_title = '<i class="mdi mdi-chart-scatter-plot-hexbin fs-18" data-title="FoBrain Page Tour" data-intro="School Summary Section 👋"></i> 
							 School Summary';
						pageTitle($page_title, 0);	 
					?>
					<div class="card-body scroll"> 

						<div class="row justify-content-center">
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 my-15">
								<div class="wiz-counter-1">
									<div class="wiz-counter-1-icon">
										<i class="mdi mdi-human-queue"></i>
									</div>
									<span class="wiz-counter-1-value"><?php echo $schoolTotal; ?></span>
									<h3><span class="hide-res">Active</span> Students</h3>
								</div>
							</div>
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 my-15">
								<div class="wiz-counter-1 color-3">
									<div class="wiz-counter-1-icon">
										<i class="mdi mdi-account-tie"></i>
									</div>
									<span class="wiz-counter-1-value"><?php echo $totalStaffs; ?></span>
									<h3><span class="hide-res">Active</span>  Staffs</h3>
								</div>
							</div> 
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 my-15">
								<div class="wiz-counter-1 color-1">
									<div class="wiz-counter-1-icon">
										<i class="mdi mdi-human-female-female"></i>
									</div>
									<span class="wiz-counter-1-value"><?php echo $schoolFTotal; ?></span>
									<h3><span class="hide-res">Active</span>  Female</h3>
								</div>
							</div>
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 my-15">
								<div class="wiz-counter-1 color-2">
									<div class="wiz-counter-1-icon">
										<i class="mdi mdi-human-male-male"></i>
									</div>
									<span class="wiz-counter-1-value"><?php echo $schoolMTotal; ?></span>
									<h3><span class="hide-res">Active</span>  Male</h3>
								</div>
							</div> 

							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 my-15">
								<div class="wiz-counter-1">
									<div class="wiz-counter-1-icon">
										<i class="mdi mdi-file-pdf-outline"></i>
									</div>
									<span class="wiz-counter-1-value"><?php echo $eBookNum; ?></span>
									<h3>E - BOOK</h3>
								</div>
							</div>
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 my-15">
								<div class="wiz-counter-1 color-1">
									<div class="wiz-counter-1-icon">
										<i class="mdi mdi-notebook-multiple"></i>
									</div>
									<span class="wiz-counter-1-value"><?php echo $hBookNum; ?></span>
									<h3>Hard Copy</h3>
								</div>
							</div>
								
						</div> 
						
					</div><!-- end card-body -->
			
				</div>
				<!-- end card -->
			</div>  
			<div class="col-lg-6 mb-25">
				<!-- card -->
				<div class="card card-widget-1 card-shadow">						 
					<?php 
						$page_title = '<i class="mdi mdi-account-tie-voice fs-18"></i> 
						School Broadcast';
						pageTitle($page_title, 0);	 
						$render_table = 0;
					?>
					<div class="card-body scroll">   
						<?php require_once ($fobrainAdminGlobalDir.'broadcast-info.php');  ?> 
					</div><!-- end card-body --> 
				</div>
				<!-- end card -->
			</div>
			
		</div>
		<!-- end row -->
			
		 

		<?php 
		
			if(($admin_grade == $admin_fobrain_grd) || ($admin_grade == $hm_fobrain_grd)) { 

				if($roll_render == 1){

		?>

		<div <?php echo $fob_view; ?> class="row gutters align-items-center">	
			<div class="col-lg-12 mb-25">
				<!-- card -->
				<div class="card card-widget-1 card-shadow">						 
					<?php 
						$page_title = '<i class="mdi mdi-chart-scatter-plot-hexbin fs-18" data-title="FoBrain Page Tour" data-intro="Daily Attendance 👋"></i> 
							 Daily Attendance';
						pageTitle($page_title, 0);	 
					?>
					<div class="card-body scroll"> 
						<!-- row -->
						<div class="row gutters  start-end">
							<div class="col-lg-4">										
								<!-- field wrapper start -->
								<div class="field-wrapper">
										<input type="date" value="<?php echo date("Y-m-d"); ?>" name ="roll_date" id ="roll-widget">
									<div class="field-placeholder"><i class="mdi mdi-calendar-search fs-14"></i> 
									Search Date <span class="text-danger">*</span></div>
								</div>
								<!-- field wrapper end -->
							</div>
							<?php $roll_date = date("Y-m-d");  require_once 'roll-call-widget.php'; ?>
							<div id="roll-call-widget"></div>
						</div>
						<div class="row gutters justify-content-center mt-20">

							<div class=" col-6">
								<div id="wiz-chart-r1"  class="apex-charts" ></div>
							</div>
							<div class="col-6">
								<div id="wiz-chart-r2"  class="apex-charts" ></div>
							</div> 
						</div> 	 
							
					</div><!-- end card-body --> 
				</div>
				<!-- end card -->
			</div>
		</div> 
			<?php } ?>			

		<?php } ?>

		<?php 
		
			if(($admin_grade == $bus_fobrain_grd) || ($admin_grade == $admin_fobrain_grd) || ($admin_grade == $hm_fobrain_grd)) { 

		?>

		<!-- transaction summary start -->
		<!-- row -->
		<div <?php echo $fob_view; ?> class="row gutters justify-content-center">
			
			<div class="col-12 col-lg-12 mb-25">	
				<!-- card start -->
				<div class="card card-shadow"> 
					<?php 
						$page_title = '<i class="fas fa-chart-line fs-16" data-title="FoBrain Page Tour" data-intro="School Transaction  Summary 👋"></i> 
							School Transaction  Summary';
						pageTitle($page_title, 0);	 
					?>						
					<div class="card-body value-box-sp">
						<!-- row -->
						<div class="row gutters justify-content-end">
							<div class="col-lg-3">										
								<!-- field wrapper start -->
								<div class="field-wrapper select-wrapper">
									<select class="form-control" id="chartYears">
										<?php 
											
											$set_year = strftime("%Y", time());
											//$set_year = 2018;
											$years = range(2000, strftime("%Y", time()));
											
											foreach($years as $year) {  
												if($year == $set_year){
													$selected = "SELECTED";			
												}else{
													$selected = "";
												}
											 	echo "<option value='$year' $selected >$year</option>";
											}
												
										?> 
									</select>
									<div class="icon-wrap"  id="wait_loader" style="display: none;">
										<i class="loader"></i>
									</div>
									<div class="field-placeholder"> 
										<span class="text-danger">
											<i class="fas fa-search label-icon"></i> 
											  Filter By Year
										 </span>
									</div>													
								</div>
								<!-- field wrapper end -->
							</div>																 
						</div>	
						<!-- /row -->		
												
						<div id = "summ-chart-div">	 
							<?php require_once 'busary-charts.php'; ?>							
						</div> 								

					</div><!-- end card-body -->	
				</div>
				<!-- card end -->	
			</div>
		</div>
		<!-- / row -->	 
        <!-- transaction summary  end -->	 
		
		<?php } ?>		 

		<!-- row -->
		<div <?php echo $fob_view; ?> class="row gutters justify-content-center">
			<div class="col-12 mb-25">	
				<!-- card start -->
				<div class="card card-shadow"> 
					<?php 
						$page_title = '<i class="mdi mdi-chart-bar-stacked fs-18" data-title="FoBrain Page Tour" data-intro="Active Student Spread Summary 👋"></i> 
							Active Student Spread Summary';
						pageTitle($page_title, 0);	 
					?>				
					<div class="card-body">					 				
						<div class="row gutters justify-content-center">
							<div class="col-md-3 col-sm-6">
								<div class="wiz-counter-2">
									<div class="wiz-counter-2-icon">
										<i class="mdi mdi-human-queue"></i>
									</div>
									<span class="wiz-counter-2-value"><?php echo $activeStuTotalNur; ?></span>
									<h3>Nursery </h3>
								</div>
							</div>
							<div class="col-md-3 col-sm-6">
								<div class="wiz-counter-2 color-1">
									<div class="wiz-counter-2-icon">
										<i class="mdi mdi-human-queue"></i>
									</div>
									<span class="wiz-counter-2-value"><?php echo $activeStuTotalPri; ?></span>
									<h3>Primary </h3>
								</div>
							</div>
							<div class="col-md-3 col-sm-6">
								<div class="wiz-counter-2 color-2">
									<div class="wiz-counter-2-icon">
										<i class="mdi mdi-human-queue"></i>
									</div>
									<span class="wiz-counter-2-value"><?php echo $activeStuTotalSec; ?></span>
									<h3>Secondary </h3>
								</div>
							</div> 
						</div>

						<div class="row gutters mt-30 mb-25 justify-content-center">
							<div class="hints col-lg-4">
								[<i class="mdi mdi-help-circle-outline"></i>] 
								Graphical Data Representation
							</div>
						</div>

						<div class="row gutters justify-content-center">
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 hide">
								<div id="wiz-chart-1"  class="apex-charts" ></div>
							</div>
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
								<div id="wiz-chart-2"  class="apex-charts" ></div>
							</div>
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
								<div id="wiz-chart-3"  class="apex-charts" ></div>
							</div> 
						</div> 
					 
					</div>
				</div>
				<!-- card end -->	
			</div>
		</div>
		<!-- / row -->	  
             


        <!-- nursery school div start -->
		<!-- row -->
		<div <?php echo $fob_view; ?> class="row gutters justify-content-center">
			<div class="col-12 mb-25">	
				<!-- card start -->
				<div class="card card-shadow"> 
					<?php 
						$page_title = '<i class="mdi mdi-account-supervisor-circle fs-18" data-title="FoBrain Page Tour" data-intro="Nursery School Summary 👋"></i> 
							Nursery School Summary';
						pageTitle($page_title, 0);	 
					?>				
					<div class="card-body"> 
						<div class="row gutters  justify-content-center">	
							<div class="col-md-3 col-sm-6">
								<div class="wiz-counter-2">
									<div class="wiz-counter-2-icon">
										<i class="mdi mdi-human-queue"></i>
									</div>
									<span class="wiz-counter-2-value"><?php echo $activeStuTotalNur; ?></span>
									<h3>Students</h3>
								</div>
							</div>
							<div class="col-md-3 col-sm-6">
								<div class="wiz-counter-2 color-1">
									<div class="wiz-counter-2-icon">
										<i class="mdi mdi-human-female-female"></i>
									</div>
									<span class="wiz-counter-2-value"><?php echo $activeFTotalNur; ?></span>
									<h3>Female</h3>
								</div>
							</div>
							<div class="col-md-3 col-sm-6">
								<div class="wiz-counter-2 color-2">
									<div class="wiz-counter-2-icon">
										<i class="mdi mdi-human-male-male"></i>
									</div>
									<span class="wiz-counter-2-value"><?php echo $activeMTotalNur; ?></span>
									<h3>Male</h3>
								</div>
							</div> 	
						</div>

						<div class="row gutters mt-30 mb-25 justify-content-center">
							<div class="hints col-lg-4">
								[<i class="mdi mdi-help-circle-outline"></i>] 
								Graphical Data Representation
							</div>
						</div>

						<div class="row gutters justify-content-center">
							<div class="col-12">
								<div id="wiz-chart-nur"  class="apex-charts" ></div>
							</div> 
						</div>  
                  
				  	</div>
				</div>
				<!-- card end -->	
			</div>
		</div>
		<!-- / row -->	  
    	<!-- nursery school div end -->



        <!-- primary school div start -->
		<!-- row -->
		<div <?php echo $fob_view; ?> class="row gutters justify-content-center">
			<div class="col-12 mb-25">	
				<!-- card start -->
				<div class="card card-shadow"> 
					<?php 
						$page_title = '<i class="mdi mdi-account-supervisor-circle fs-18" data-title="FoBrain Page Tour" data-intro="Primary  School  Summary 👋"></i> 
							Primary  School  Summary';
						pageTitle($page_title, 0);	 
					?> 				
					<div class="card-body"> 	
						<div class="row gutters justify-content-center">	
							<div class="col-md-3 col-sm-6">
								<div class="wiz-counter-2">
									<div class="wiz-counter-2-icon">
										<i class="mdi mdi-human-queue"></i>
									</div>
									<span class="wiz-counter-2-value"><?php echo $activeStuTotalPri; ?></span>
									<h3>Students </h3>
								</div>
							</div>
							<div class="col-md-3 col-sm-6">
								<div class="wiz-counter-2 color-1">
									<div class="wiz-counter-2-icon">
										<i class="mdi mdi-human-female-female"></i>
									</div>
									<span class="wiz-counter-2-value"><?php echo $activeFTotalPri; ?></span>
									<h3>Female</h3>
								</div>
							</div>
							<div class="col-md-3 col-sm-6">
								<div class="wiz-counter-2 color-2">
									<div class="wiz-counter-2-icon">
										<i class="mdi mdi-human-male-male"></i>
									</div>
									<span class="wiz-counter-2-value"><?php echo $activeMTotalPri; ?></span>
									<h3>Male</h3>
								</div>
							</div>  
						</div>

						<div class="row gutters mt-30 mb-25 justify-content-center">
							<div class="hints col-lg-4">
								[<i class="mdi mdi-help-circle-outline"></i>] 
								Graphical Data Representation
							</div>
						</div>

						<div class="row gutters justify-content-center">
							<div class="col-12">
								<div id="wiz-chart-pri"  class="apex-charts" ></div>
							</div> 
						</div> 
                 
					</div>
				</div>
				<!-- card end -->	
			</div>
		</div>
		<!-- / row -->	  
              
		<!-- primary school div end --> 

		<!-- secondary school div start -->

		<!-- row -->
		<div <?php echo $fob_view; ?> class="row gutters justify-content-center">
			<div class="col-12 mb-25">	
				<!-- card start -->
				<div class="card card-shadow"> 
					<?php 
						$page_title = '<i class="mdi mdi-account-supervisor-circle fs-18" data-title="FoBrain Page Tour" data-intro="Secondary School  Summary 👋"></i> 
							Secondary School  Summary';
						pageTitle($page_title, 0);	 
					?>			
					<div class="card-body">  			  
					
						<div class="row gutters  justify-content-center">
							
							<div class="col-md-3 col-sm-6">
								<div class="wiz-counter-2">
									<div class="wiz-counter-2-icon">
										<i class="mdi mdi-human-queue"></i>
									</div>
									<span class="wiz-counter-2-value"><?php echo $activeStuTotalSec; ?></span>
									<h3>Students </h3>
								</div>
							</div>
							<div class="col-md-3 col-sm-6">
								<div class="wiz-counter-2 color-1">
									<div class="wiz-counter-2-icon">
										<i class="mdi mdi-human-female-female"></i>
									</div>
									<span class="wiz-counter-2-value"><?php echo $activeFTotalSec; ?></span>
									<h3>Female</h3>
								</div>
							</div>
							<div class="col-md-3 col-sm-6">
								<div class="wiz-counter-2 color-2">
									<div class="wiz-counter-2-icon">
										<i class="mdi mdi-human-male-male"></i>
									</div>
									<span class="wiz-counter-2-value"><?php echo $activeMTotalSec; ?></span>
									<h3>Male</h3>
								</div>
							</div>  
						</div> 
							 
						<div class="row gutters mt-30 mb-25 justify-content-center">
							<div class="hints col-lg-4">
								[<i class="mdi mdi-help-circle-outline"></i>] 
								Graphical Data Representation
							</div>
						</div>

						<div class="row gutters justify-content-center">
							<div class="col-12">
								<div id="wiz-chart-sec"  class="apex-charts" ></div>
							</div> 
						</div>						
                 
					</div>
				</div>
				<!-- card end -->	
			</div>
		</div>
		<!-- / row -->	  
        <!-- secondary school div end -->

		<!-- row start -->
		<div class="row gutters mb-25" data-aos="fade-up" data-aos-duration="15000">  
			<div class="col-12">
				<!-- card -->
				<div class="card card-widget-1 card-shadow"> 
					<?php 
						$page_title = '<i class="far fa-calendar-alt fs-16" data-title="FoBrain Page Tour" data-intro="School Events Section 👋"></i> 
							School Events';
						pageTitle($page_title, 0);	 
					?>
					<!-- card body -->
					<div class="card-body scroll">   
						<div id="calendar" class="my-15"></div>  
					</div>
					<!-- end card body -->
				</div>
				<!-- end card -->
			</div>
			<!-- end col -->
		</div>
		<!-- end row-->

		<!--  fobrain modal start -->			
		<button type="button" class="btn modal-fobrain  display-none"  data-bs-toggle="modal" data-bs-target="#modal-fobrain"></button>				
		<!-- Scrollable modal -->
		<div class="modal fade animate__animated animate__zoomInDown" id="modal-fobrain" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
			<div class="modal-dialog modal-fullscreen-sm-down modal-dialog-scrollable">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalScrollableTitle">
							<i class="mdi mdi-account-tie-voice label-icon"></i> 
							School Broadcast
						</h5> 				 
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div id="edit-msg"> </div> 
					<div class="modal-body">
						<div id="modal-load-div"></div> 
					</div> 
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		<!-- fobrain modal end -->  
				
		<script type="text/javascript"> 

			var options = {
				series: [<?php echo "$activeStuTotalNur, $activeStuTotalPri, $activeStuTotalSec"; ?>],
				chart: {
				width: '100%',
				type: 'pie',
				},
				labels: ['Nursery', 'Primary', 'Secondary'],
				colors: [
				'#8B008B',
				'#4B0082',
				'#B22222', 
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

			var options_2 = {
				series: [<?php echo "$activeStuTotalNur, $activeStuTotalPri, $activeStuTotalSec"; ?>],
				chart: {
				type: 'polarArea',
				},
				stroke: {
				colors: ['#fff']
				},
				colors: [
				'#ffa502',
				'#7b4c90',
				'#4c5882', 
				],
				labels: ['Nursery', 'Primary', 'Secondary'],
				fill: {
				opacity: 0.9
				},
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

			var chart = new ApexCharts(document.querySelector("#wiz-chart-2"), options_2);
			chart.render();


			
		
			var options_3 = {
			series: [
			{
				name: "",
				data: [<?php echo "$activeStuTotalNur, $activeStuTotalPri, $activeStuTotalSec"; ?>],
			},
			],
			chart: {
			type: 'bar',
			height: 350,
			},
			plotOptions: {
			bar: {
				borderRadius: 0,
				horizontal: true,
				distributed: true,
				barHeight: '50%',
				isFunnel: true,
			},
			},
			colors: [
				'#ffa502',
				'#7b4c90',
				'#4c5882', 
			],
			dataLabels: {
			enabled: true,
			formatter: function (val, opt) {
				return opt.w.globals.labels[opt.dataPointIndex] 
			},
			dropShadow: {
				enabled: true,
			},
			},
			title: {
			text: 'School  Summary',
			align: 'middle',
			},
			xaxis: {
			categories: ['Nursery', 'Primary', 'Secondary'],
			},
			legend: {
			show: false,
			},
			};

		
			var chart = new ApexCharts(document.querySelector("#wiz-chart-3"), options_3);
			chart.render();

			var options_nur = {
			series: [
			{
				name: 'Male',
				group: 'budget',
				data: [<?php echo "$fimTotalNur,  $semTotalNur,  $thmTotalNur"; ?>]
			},
			{
				name: 'Female',
				group: 'budget',
				data: [<?php echo "$fifTotalNur,  $sefTotalNur,  $thfTotalNur"; ?>]
			},
			{
				name: 'Total',
				group: 'actual',
				data: [<?php echo "$fiStuTotalNur,  $seStuTotalNur,  $thStuTotalNur"; ?>]
			}
			
			],
			chart: {
			type: 'bar',
			height: 250,
			stacked: true,
			},
			stroke: {
			width: 1,
			colors: ['#fff']
			},
			dataLabels: {
			formatter: (val) => {
				return val 
			}
			},
			plotOptions: {
			bar: {
				horizontal: true
			}
			},
			xaxis: {
			categories: [
				'<?php echo $levelArrayNur[$fiVal]['level'];?>',
				'<?php echo $levelArrayNur[$seVal]['level'];?>',
				'<?php echo $levelArrayNur[$thVal]['level'];?>'
			],
			labels: {
				formatter: (val) => {
				return val 
				}
			}
			},
			fill: {
			opacity: 1,
			},
			colors: [
				'#ffa502',
				'#7b4c90',
				'#4c5882'
			],
			legend: {
			position: 'top',
			horizontalAlign: 'left'
			}
			};

			var chart = new ApexCharts(document.querySelector("#wiz-chart-nur"), options_nur);
			chart.render();

			var options_pri = {
			series: [
			{
				name: 'Male',
				group: 'budget',
				data: [<?php echo "$fimTotalPri,  $semTotalPri,  $thmTotalPri,  $fomTotalPri,  $fifmTotalPri,  $sixmTotalPri"; ?>]
			},
			{
				name: 'Female',
				group: 'budget',
				data: [<?php echo "$fifTotalPri,  $sefTotalPri,  $thfTotalPri,  $fofTotalPri,  $fiffTotalPri,  $sixfTotalPri"; ?>]
			},
			{
				name: 'Total',
				group: 'actual',
				data: [<?php echo "$fiStuTotalPri,  $seStuTotalPri,  $thStuTotalPri,  $foStuTotalPri,  $fifStuTotalPri,  $sixStuTotalPri"; ?>]
			}
			
			],
			chart: {
			type: 'bar',
			height: 350,
			stacked: true,
			},
			stroke: {
			width: 1,
			colors: ['#fff']
			},
			dataLabels: {
			formatter: (val) => {
				return val 
			}
			},
			plotOptions: {
			bar: {
				horizontal: true
			}
			},
			xaxis: {
			categories: [
				'<?php echo $levelArrayPri[$fiVal]['level'];?>',
				'<?php echo $levelArrayPri[$seVal]['level'];?>',
				'<?php echo $levelArrayPri[$thVal]['level'];?>',
				'<?php echo $levelArrayPri[$foVal]['level'];?>',
				'<?php echo $levelArrayPri[$fifVal]['level'];?>',
				'<?php echo $levelArrayPri[$sixVal]['level'];?>'
			],
			labels: {
				formatter: (val) => {
				return val 
				}
			}
			},
			fill: {
			opacity: 1,
			},
			colors: [
				'#ffa502',
				'#7b4c90',
				'#4c5882'
			],
			legend: {
			position: 'top',
			horizontalAlign: 'left'
			}
			};

			var chart = new ApexCharts(document.querySelector("#wiz-chart-pri"), options_pri);
			chart.render();
		
			var options_sec = {
			series: [
			{
				name: 'Male',
				group: 'budget',
				data: [<?php echo "$fimTotalSec,  $semTotalSec,  $thmTotalSec,  $fomTotalSec,  $fifmTotalSec,  $sixmTotalSec"; ?>]
			},
			{
				name: 'Female',
				group: 'budget',
				data: [<?php echo "$fifTotalSec,  $sefTotalSec,  $thfTotalSec,  $fofTotalSec,  $fiffTotalSec,  $sixfTotalSec"; ?>]
			},
			{
				name: 'Total',
				group: 'actual',
				data: [<?php echo "$fiStuTotalSec,  $seStuTotalSec,  $thStuTotalSec,  $foStuTotalSec,  $fifStuTotalSec,  $sixStuTotalSec"; ?>]
			}
			
			],
			chart: {
			type: 'bar',
			height: 350,
			stacked: true,
			},
			stroke: {
			width: 1,
			colors: ['#fff']
			},
			dataLabels: {
			formatter: (val) => {
				return val 
			}
			},
			plotOptions: {
			bar: {
				horizontal: true
			}
			},
			xaxis: {
			categories: [
				'<?php echo $levelArraySec[$fiVal]['level'];?>',
				'<?php echo $levelArraySec[$seVal]['level'];?>',
				'<?php echo $levelArraySec[$thVal]['level'];?>',
				'<?php echo $levelArraySec[$foVal]['level'];?>',
				'<?php echo $levelArraySec[$fifVal]['level'];?>',
				'<?php echo $levelArraySec[$sixVal]['level'];?>'
			],
			labels: {
				formatter: (val) => {
				return val 
				}
			}
			},
			fill: {
			opacity: 1,
			},
			colors: [
				'#ffa502',
				'#7b4c90',
				'#4c5882'
			],
			legend: {
			position: 'top',
			horizontalAlign: 'left'
			}
			};

			var chart = new ApexCharts(document.querySelector("#wiz-chart-sec"), options_sec);
			chart.render();


			var options = {
				series: [{
				name: 'Income Payment',
				data: [<?php echo rtrim($chart_income, ", "); ?>]
				}, {
				name: 'Sale Orders',
				data: [<?php echo rtrim($chart_sale, ", "); ?>]
				}, {
				name: 'Expenditure',
				data: [<?php echo rtrim($chart_expense, ", "); ?>]
				}, {
				name: 'Balance',
				data: [<?php echo rtrim($chart_balance, ", "); ?>]
				}],
				chart: {
				type: 'bar',
				height: 450
				},
				plotOptions: {
				bar: {
					horizontal: false,
					columnWidth: '75%',
					endingShape: 'rounded'
				},
				},
				dataLabels: {
				enabled: false
				},
				stroke: {
				show: true,
				width: 2,
				colors: ['transparent']
				},
				xaxis: {
				categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
				},
				yaxis: {
				title: {
					text: '<?php echo $curSymbol; ?> (Amount)'
				}
				},
				fill: {
				opacity: 1
				},
				colors: [
					'#ffa502',
					'#7b4c90',
					'#4c5882',
					'#ee5835'
				],
				tooltip: {
				y: {
					formatter: function (val) {
					return "<?php echo $curSymbol; ?> " + val + " Amount"
					}
				}
				}
			};

			//var chart = new ApexCharts(document.querySelector("#wiz-chart"), options);
			
			//chart.render(); 
	
			$(function(){
				$('.wiz-counter-1-value, .wiz-counter-2-value').each(function(){
					$(this).prop('Counter',0).animate({
						Counter: $(this).text()
					},{
						duration: 3500,
						easing: 'swing',
						step: function (now){
							$(this).text(Math.ceil(now));
						}
					});
				});
				
			});  

			$(function(){

				var calendarEl = document.getElementById('calendar'); 

				var calendar = new FullCalendar.Calendar(calendarEl, {

					headerToolbar: {
						left: 'prev,next',
						center: 'title',
						right: 'today'
					},
					height: 650, 
					events: 'events-info.php', 
					selectable: true, 
      				dayMaxEvents: true, // allow "more" link when too many events
					eventClick: function(info) {
					info.jsEvent.preventDefault();
					
					// change the border color
					info.el.style.borderColor = 'red';
					//html:'<p>'+info.event.extendedProps.comments+'</p>',
					Swal.fire({
						//title: info.event.title,
						//text: info.event.extendedProps.comments,
						//icon: 'info',
						html: 
						'<div class="rows mt-50">' +
							'<div class="col-12">' +
								'<div class="attendance-timeline">' +
									'<div class="timeline filter-item" >' +
										'<a href="#" class="timeline-content">' +
											'<div class="timeline-year"><i class="mdi mdi-calendar-multiple"></i> Events </div>' +
											'<h3 class="title">'+info.event.title+'</h3>' +
											'<hr class="my-15 text-danger" />' +
											'<h3 class="title mt-20 start-end">Details</h3>' +
											'<p class="description">'+info.event.extendedProps.comments+'</p>' +											  
										'</a>' +
									'</div>' +
								'</div>' +
							'</div>' +
						'</div>', 
						showCloseButton: true,
						showCancelButton: true, 
						cancelButtonText: '<i class="mdi mdi-close-circle"></i> Close',					
						customClass: { 
							cancelButton: 'swal2-button-fobrain swal2-cancel-button-fobrain' 
						}, 
						
					});
					}
				});	 

				calendar.render();
				 
			});

			introJs().setOptions({
				showProgress: true,
			}).start()

		</script>				 