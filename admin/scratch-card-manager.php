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
	This script handle school scratch card pins
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

     define('fobrain', 'igweze');  /* define a check for wrong access of file */

        require 'fobrain-config-s.php';  /* load fobrain configuration files */	   
		        
			if ($_REQUEST['card'] == 'save') {  /* save school cardPin */	   
 
				$pinCount =  cleanInt($_REQUEST['pinCount']);
				$iiii_serial_iiii =  clean($_REQUEST['iiii_serial_iiii']);
				
				/* script validation */
				
				if (($pinCount == "") || ($pinCount <= $fiVal)) {
         			
					$msg_e = "* Ooops Error, please enter <b>No. of Pins to Generate</b>";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
					
	   			}elseif ($iiii_serial_iiii == "")  {
         			
					$msg_e = "* Ooops Error, please enter <b>Card Serial No</b>";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
					
	   			}else {  /* insert information */   

					$msg_s = "<strong>$pinCount Scratch card pin/s</strong> was successfully created"; 
					echo $succesMsg.$msg_s.$sEnd;     			

		 			try {
						
$tableHead =<<<IGWEZE
        
				<script type='text/javascript'> 
					$('#frmsaveCardPin')[0].reset();
					$('#load-wiz-info, #frmsaveCardPin, .menu-sc-card').fadeOut(1000); 
					$('#create-new-pins').fadeIn(1000);
					renderTable2(); 
				</script>
				<div class="table-responsive">
					<!-- table -->
					<table class='table table-hover table-responsive style-table' id="wiz-table">	
						<thead>
							<tr>                        
								<th>S/N</th> 						 
								<th>Card Pin</th> 
								<th>Serial No.</th>	 	
							</tr>
						</thead> 
						<tbody>
		
IGWEZE;
                               
		      			echo $tableHead;
				 								
				
						for ($i = 1; $i <= $pinCount; $i++){
						
							mt_srand((double)microtime() * 1000000);
							
							$iiii_pin = randomString($randNumber, 12);	
						
							$ebele_mark = "INSERT INTO $eWalletTB  (iiii_pin_iiii, iiii_serial_iiii)

									VALUES (:iiii_pin_iiii, :iiii_serial_iiii)";
						 
							$igweze_prep = $conn->prepare($ebele_mark); 
							$igweze_prep->bindValue(':iiii_pin_iiii', $iiii_pin); 
							$igweze_prep->bindValue(':iiii_serial_iiii', $iiii_serial_iiii);
							 
							
							if($igweze_prep->execute()){  /* if sucessfully */
							

$tableHead =<<<IGWEZE
        
								<tr id='row-$iiii_id'>
									<td>$i</td>
									<td>$iiii_pin</td>
									<td>$iiii_serial_iiii</td> 
								</tr>
		
IGWEZE;
                               
								echo $tableHead;															
								
							}else{  /* display error */ 
					
								$msg_e =  "Ooops, an error has occur while to save scratch card pins. Please try again";
								echo $errorMsg.$msg_e.$eEnd; exit;
								
							}
							
							$iiii_pin = '';
						}								
						
						echo "
								</tbody>
							</table>
							<!-- / table -->
						</div>	 ";
						echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;

				 	}catch(PDOException $e) {
  			
						fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					} 
        	
				}
			
			}elseif ($_REQUEST['card'] == 'remove') {  /* remove school cardPin */ 
				
				$cardPinData = $_REQUEST['rData'];
				
				list($fobrainIg, $iiii_id, $hName) = explode("-", $cardPinData);			
				
				/* script validation */
				
				if (($cardPinData == "")  || ($iiii_id == "")){
         			
					$msg_e = "* Ooops, an error has occur while to remove scratch card pins. Please try again";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
					
	   			}else {  /* remove information */       			


		 			try {
						
						
						$ebele_mark = "DELETE FROM 
						
										$eWalletTB										
											
										WHERE iiii_id = :iiii_id
											
										LIMIT 1";
					 
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':iiii_id', $iiii_id);  
						
						if($igweze_prep->execute()){  /* if sucessfully */
							
							$removeDiv = "$('#row-".$iiii_id."').fadeOut(1000);";
							$msg_s = "<strong>Scratch card pin</strong> was successfully removed"; 
							echo $succesMsg.$msg_s.$sEnd; 
							echo "<script type='text/javascript'>   
							hidePageLoader(); $('.slideUpFrmDiv').fadeOut(3000); $removeDiv  </script>";exit;
							
						}else{  /* display error */ 
				
							$msg_e =  "Ooops, an error has occur while to remove scratch card pin. Please try again";
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
							
						}
						

				 	}catch(PDOException $e) {
  			
						fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					} 
        	
				}
			
			}elseif ($_REQUEST['card'] == 'view') {  /* view school cardPin */

				$iiii_id = $_REQUEST['rData'];				
				
				if ($iiii_id == ""){
         			
					$msg_e = "* Ooops, an error has occur while to retrieve scratch card pin information. Please try again";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
					
	   			}else {       			

		 			try {						
													
						$cardPinInfoArr = cardPinInfo($conn, $iiii_id);  /* school cardPin information */ 
						$iiii_pin_iiii = $cardPinInfoArr[$fiVal]["iiii_pin_iiii"];
						$iiii_serial_iiii = $cardPinInfoArr[$fiVal]["iiii_serial_iiii"];
						$iiii_reg_id = $cardPinInfoArr[$fiVal]["iiii_reg_id"];
						$regNum = $cardPinInfoArr[$fiVal]["iiii_reg"];
						$schoolID = $cardPinInfoArr[$fiVal]["iiii_stype"];
						$iiii_level = $cardPinInfoArr[$fiVal]["iiii_level"];
						$iiii_term = $cardPinInfoArr[$fiVal]["iiii_term"];
						$reTime = $cardPinInfoArr[$fiVal]["iiii_time"];
						$iiii_status = $cardPinInfoArr[$fiVal]["iiii_status"];
				
						if($iiii_status == ""){ $iiii_status = $i_false; }
						$schoolName = $school_list[$schoolID];												
						$cardStatus = $cardStatusArr[$iiii_status];
						if($schoolID == ""){ $schoolID = $fiVal; }

						require $fobrainSchoolTBS; /* include student database table information  */		
						
						$student_name = studentName($conn, $regNum);  /* student name  */
		
						$student_img = studentPicture($conn, $regNum);  /* student picture  */
						
						$levelArray = studentLevelsArray($conn);  /* student level array */ 
						
						$schoolLevel = $levelArray[$iiii_level]['level'];
						
						//$rechargeTime = date("j M Y", strtotime($reTime)); 
						if($reTime != "") {$rechargeTime = date("j M Y", $reTime); }
						else{$rechargeTime = ""; }					

$showCardPin =<<<IGWEZE
		 
						<div class="row gutters mb-10">
							<div class="text-end">
								<button  class="btn btn-primary" onclick="printDiv('fobrain-print-ovly')">
									<i class="fas fa-print"></i>  
								</button>
							</div>	
						</div>
							 
						<div id = 'fobrain-print-ovly'>

						<!-- table -->	
						<table  class="table table-view table-hover table-responsive"> 

						<tr><th style="padding-left: 30px; text-align:left; width: 40%;">
						Card Pin </th> <td style="padding-left: 30px; text-align:left; width: 60%;">
						$iiii_pin_iiii </td> </tr> 

						<tr><th style="padding-left: 30px; text-align:left; width: 40%;">
						Serial No. </th> <td style="padding-left: 30px; text-align:left; width: 60%;">
						$iiii_serial_iiii</td> </tr> 

						<tr><th style="padding-left: 30px; text-align:left; width: 40%;">
						School</th><td style="padding-left: 30px; text-align:left; width: 60%;">
						$schoolName</td> </tr> 
						
						<tr><th style="padding-left: 30px; text-align:left; width: 40%;">
						Class Level</th><td style="padding-left: 30px; text-align:left; width: 60%;">
						$schoolLevel</td> </tr> 
						
						<tr><th style="padding-left: 30px; text-align:left; width: 40%;">
						School Term</th><td style="padding-left: 30px; text-align:left; width: 60%;">
						$iiii_term</td> </tr>

						<tr><th style="padding-left: 30px; text-align:left; width: 40%;">
						Recharge Time</th><td style="padding-left: 30px; text-align:left; width: 60%;">
						$rechargeTime</td> </tr>

						<tr><th style="padding-left: 30px; text-align:left; width: 40%;">
						Card Status</th><td style="padding-left: 30px; text-align:left; width: 60%;">
						$cardStatus</td> </tr>	

						</table>
						<!-- / table --> 

						</div>
		
IGWEZE;
				
						echo $showCardPin; 
						
						echo "<script type='text/javascript'>  hidePageLoader(); </script>"; exit;
						
						

				 	}catch(PDOException $e) {
  			
						fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					}
		 
        	
				}
			
			}else{ 
			
				echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
			
			} 
			
exit;

?>