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
	This script load and save student rollcall roll-call-info.php
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

    if (!defined('fobrain')) /* This checks if this page was wrongly access by users */

    die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!'); 
 
		
    try {            

        $ebele_mark_1 = "SELECT id, attendance 
        
                        FROM $daily_comments_tb
        
                        WHERE  start = :start";
                
        $igweze_prep_1 = $conn->prepare($ebele_mark_1); 
        $igweze_prep_1->bindValue(':start', $roll_date); 
        $igweze_prep_1->execute();
        
        $rows_count_1 = $igweze_prep_1->rowCount(); 

        $roll_ab = 0; $roll_pr = 0; $roll_pt = 0; 
        
        if($rows_count_1 >= $foreal) {  /* check array is empty */ 
            
            while($row_1 = $igweze_prep_1->fetch(PDO::FETCH_ASSOC)) {  /* loop array */		

                $id = $row_1['id'];
                $rollcall = $row_1['attendance'];  

                if ($rollcall == 1){									
                    $roll_ab++;                    
                }else  if ($rollcall == 2){									
                    $roll_pr++;                    
                }else  if ($rollcall == 3){									
                    $roll_pt++;                    
                }else{}
            } 
            
        }	         
    
    }catch(PDOException $e) {

        fobrainDie( 'Ooops Database Error: ' . $e->getMessage());

    }
                  
?>          

 		
		<script type="text/javascript"> 
 
			var options = {
				series: [<?php echo "$roll_ab, $roll_pr, $roll_pt"; ?>],
				chart: {
				width: '100%',
				type: 'pie',
				},
				labels: ['Absent', 'Present', 'Present (Late)'],
				colors: [
					 
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
		 
			var chart = new ApexCharts(document.querySelector("#wiz-chart-r1"), options);
			chart.render();
 

			var options = {
				series: [{
					data: [<?php echo "$roll_ab, $roll_pr, $roll_pt"; ?>]
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
						'Absent', 'Present', 'Present (Late)'
					],
				}
			};

			var chart = new ApexCharts(document.querySelector("#wiz-chart-r2"), options);
			chart.render();
  
		</script> 