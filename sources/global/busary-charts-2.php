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
	This script laod bursary chart/s
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

 		if (!defined('fobrain')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
		 
		/* validate chart year */
		
		if (isset($_REQUEST['chartData']) == 'bursarySumm') {

			$chartYear = cleanDate($_REQUEST['chartYear']);
			$chartYear = trim($chartYear);					
			
			if ($chartYear == "")  {
				
				$chartYear = date('Y');
				
			}	 
			//echo "<script type='text/javascript'>   hidePageLoader(); </script>";	
				
		}else{	
		 
			//$chartYear = 2018; //date('Y');
			$chartYear = strftime("%Y", time());

		}	
						
?>
 

		<div class="row mb-20">
			<div class="col-md-3 col-sm-6">
				<div class="wiz-counter-3">
					<div class="wiz-counter-3-icon">
						<i class="mdi mdi-chart-scatter-plot-hexbin"></i>
					</div>
					<span class="wiz-counter-3-value">
					<?php 
												
						/* client order chart information*/
						$salesAmount = clientOrdersChartData($conn, $chartYear.'-01-01', $chartYear.'-12-31'); 
						echo fobrainCurrency($salesAmount, $curSymbol);
						
					?>
					</span>
					<h3>Sales Order   <br />  <i class="mdi mdi-calendar-clock"></i> <?php echo $chartYear; ?></h3> 
				</div>
			</div>
			<div class="col-md-3 col-sm-6">
				<div class="wiz-counter-3 color-1">
					<div class="wiz-counter-3-icon">
						<i class="mdi mdi-chart-bar-stacked"></i>
					</div>
					<span class="wiz-counter-3-value">
					<?php 
												
						/* fees chart information*/
						$feeAmount = feesIncomeChartData($conn, $chartYear.'-01-01', $chartYear.'-12-31'); 
						echo fobrainCurrency($feeAmount, $curSymbol);
						
					?>						
					</span>
					<h3>Fee Payments  <br />   <i class="mdi mdi-calendar-clock"></i> <?php echo $chartYear; ?></h3>
				</div>
			</div>
			<div class="col-md-3 col-sm-6">
				<div class="wiz-counter-3 color-2">
					<div class="wiz-counter-3-icon">
						<i class="mdi mdi-chart-line-stacked"></i>
					</div>
					<span class="wiz-counter-3-value">
					<?php 
												
						/* expenses chart information*/
						$expensesAmount = expensesChartData($conn, $chartYear.'-01-01', $chartYear.'-12-31'); 
						echo fobrainCurrency($expensesAmount, $curSymbol);
						
					?>		
					</span>
					<h3>Expenses  <br />   <i class="mdi mdi-calendar-clock"></i> <?php echo $chartYear; ?></h3>
				</div>
			</div>
			<div class="col-md-3 col-sm-6">
				<div class="wiz-counter-3 color-3">
					<div class="wiz-counter-3-icon">
						<i class="mdi mdi-chart-box-plus-outline"></i>
					</div>
					<span class="wiz-counter-3-value">
					<?php 
												
						/* expenses chart information*/
						$balance = (($salesAmount + $feeAmount) - $expensesAmount);
						echo fobrainCurrency($balance, $curSymbol);
						
					?>		
					</span>
					<h3>Income  <br />   <i class="mdi mdi-calendar-clock"></i> <?php echo $chartYear; ?></h3>
				</div>
			</div>

			
		</div>
		<!-- / row -->  

		<!-- row -->
		<div class="row gutters text-end">
			<div id="wiz-chart"  class="apex-charts" ></div>
		</div>
		<!-- / row -->		
						 
		<?php 
			
			$chart_balance = 0; $chart_income = 0; $chart_sale = 0; $chart_expense = 0;

			for($cha = 1; $cha <= 12; $cha++){		
				
				/*
				$chart_income .= feesIncomeChartData($conn, $chartYear.'-'.$cha.'-01', $chartYear.'-'.$cha.'-31'). ', ';
				$chart_sale .= clientOrdersChartData($conn, $chartYear.'-'.$cha.'-01', $chartYear.'-'.$cha.'-31'). ', ';
				$chart_expense .= expensesChartData($conn, $chartYear.'-'.$cha.'-01', $chartYear.'-'.$cha.'-31'). ', ';
				*/
				
				$m_income = feesIncomeChartData($conn, $chartYear.'-'.$cha.'-01', $chartYear.'-'.$cha.'-31');
				$m_sale = clientOrdersChartData($conn, $chartYear.'-'.$cha.'-01', $chartYear.'-'.$cha.'-31');
				$m_expense = expensesChartData($conn, $chartYear.'-'.$cha.'-01', $chartYear.'-'.$cha.'-31');
				
				$m_balance = "";

				$m_balance = (($m_income + $m_sale) - $m_expense);  

				$chart_balance .= $m_balance. ', '; $m_balance = "";

				$chart_income .= $m_income. ', ';
				$chart_sale .= $m_sale. ', ';
				$chart_expense .= $m_expense. ', ';
				
			}
			
				 
		?>
		
									
		<script type="text/javascript">	 
					

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

			var chart = new ApexCharts(document.querySelector("#wiz-chart"), options);
			
			chart.render(); 

			renderSelect("#chartYears");  
				
			
		</script> 
 
		
