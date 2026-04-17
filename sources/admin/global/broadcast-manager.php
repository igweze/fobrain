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

if(!session_id()){
    session_start();
}

		if (!defined('fobrain')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');	    

		if ($_REQUEST['broadcast'] == 'save') {  /* save school broadcast */	    

			$bTitle =  clean($_REQUEST['title']);
			$broadcastMsg = $_REQUEST['broadcastMsg']; 
			$bDay = $_REQUEST['bDay'];
			
			/* script validation */
			
			if ($bTitle == "")  {
				
				$msg_e = "* Ooops Error, please enter Broadcast Title";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>  hidePageLoader();  </script>";exit;
				
			}elseif ($broadcastMsg == "")  {
				
				$msg_e = "* Ooops Error, please enter Broadcast Message";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
				
			}elseif ($bDay == "")  {
				
				$msg_e = "* Ooops Error, please select a Broadcast date";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
				
			}else {  /* insert information */       			
				
				
				$broadcastMsg = strip_tags($broadcastMsg);
				$broadcastMsg = str_replace('<br />', "\n", $broadcastMsg);
				$broadcastMsg = htmlspecialchars($broadcastMsg); 

				try {
					
					
					$ebele_mark = "INSERT INTO $fobrainBroadcastTB  (bTitle, broadcastMsg, date)

							VALUES (:bTitle, :broadcastMsg, :date)";
					
					$igweze_prep = $conn->prepare($ebele_mark); 
					$igweze_prep->bindValue(':bTitle', $bTitle); 
					$igweze_prep->bindValue(':broadcastMsg', $broadcastMsg);
					$igweze_prep->bindValue(':date', $bDay); 
					
					if($igweze_prep->execute()){  /* if sucessfully */
						
						$msg_s = "Broadcast Message was successfully saved"; 
						echo $succesMsg.$msg_s.$sEnd; 
						echo "<script type='text/javascript'> 
								$('#load-wiz-info').load('broadcast-info.php');
								$('#frmsaveBroadcast')[0].reset(); 
								hidePageLoader();   
							</script>";exit;
						
					}else{  /* display error */ 
			
						$msg_e =  "Ooops, an error has occur while to save Broadcast Message. Please try again";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
						
					}
					

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				} 
		
			}
		
		}elseif ($_REQUEST['broadcast'] == 'update') {  /* update school broadcast */

			$bID = cleanInt($_REQUEST['bID']);	
			$bTitle =  clean($_REQUEST['title']);	
			$broadcastMsg = $_REQUEST['broadcastMsg']; 
			$bDay = $_REQUEST['bDay'];
			
			/* script validation */ 
			
			if ($bID == ""){
				
				$msg_e = "* Ooops, aan error has occur to retrieve broadcast information. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
				
			}elseif ($bTitle == "")  {
				
				$msg_e = "* Ooops Error, please enter Broadcast Title";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
				
			}elseif ($broadcastMsg == "")  {
				
				$msg_e = "* Ooops Error, please enter Broadcast Message";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
				
			}elseif ($bDay == "")  {
				
				$msg_e = "* Ooops Error, please select a Broadcast date";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
				
			}else {  /* update information */       			
			
				$broadcastMsg = strip_tags($broadcastMsg);
				$broadcastMsg = str_replace('<br />', "\n", $broadcastMsg);
				$broadcastMsg = htmlspecialchars($broadcastMsg); 

				try { 
					
					$ebele_mark = "UPDATE $fobrainBroadcastTB  
										
										SET  
											
										bTitle = :bTitle, 		
										broadcastMsg = :broadcastMsg,
										date = :date
										
									WHERE bID = :bID";
					
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':bID', $bID); 
					$igweze_prep->bindValue(':bTitle', $bTitle); 
					$igweze_prep->bindValue(':broadcastMsg', $broadcastMsg);
					$igweze_prep->bindValue(':date', $bDay);  
					
					if($igweze_prep->execute()){  /* if sucessfully */
						
						$msg_s = "Broadcast Message was successfully saved."; 
						echo $succesMsg.$msg_s.$sEnd; 
						echo "<script type='text/javascript'> 
								$('#load-wiz-info').load('broadcast-info.php');  
								$('#frmupdateBroadcast').slideUp(1500);
								$('#modal-fobrain').modal('hide');
								hidePageLoader(); 
						</script>";exit;
						
					}else{  /* display error */ 
			
						$msg_e =  "Ooops, an error has occur while to save Broadcast Message. Please try again";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
						
					} 

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				} 
		
			}
		
		}elseif ($_REQUEST['broadcast'] == 'remove') {  /* remove school broadcast */ 
			
			$broadcastData = $_REQUEST['rData'];
			
			list($fobrainIg, $bID, $hName) = explode("-", $broadcastData);			
			
			/* script validation */
			
			if (($broadcastData == "")  || ($bID == "")){
				
				$msg_e = "* Ooops, an error has occur while to remove Broadcast Message. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
				
			}else {  /* remove information */       			


				try {
					
					
					$ebele_mark = "DELETE FROM 
					
									$fobrainBroadcastTB										
										
									WHERE bID = :bID
										
									LIMIT 1";
					
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':bID', $bID);  
					
					if($igweze_prep->execute()){  /* if sucessfully */
						
						$removeDiv = "$('#row-".$bID."').fadeOut(1000);";
						$msg_s = "<strong>Broadcast Message</strong> was successfully removed"; 
						echo $succesMsg.$msg_s.$sEnd; 
						echo "<script type='text/javascript'>   
								$removeDiv 
								hidePageLoader();   
						</script>";exit;
						
					}else{  /* display error */ 
			
						$msg_e =  "Ooops, an error has occur while to remove Broadcast Message. Please try again";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
						
					}
					

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				} 
		
			}
		
		}elseif ($_REQUEST['broadcast'] == 'view') {  /* view school broadcast */

			
			$bID = $_REQUEST['rData'];
			
			
			if ($bID == ""){
				
				$msg_e = "* Ooops, an error has occur while to retrieve Broadcast Message. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
				
			}else {       

				try { 
					
					$broadcastInfoArr = broadcastInfo($conn, $bID);  /* school annoucement/broadcast information */ 
					$bTitle = $broadcastInfoArr[$fiVal]["bTitle"];
					$broadcastMsg = htmlspecialchars_decode($broadcastInfoArr[$fiVal]["broadcastMsg"]); 
					$date = $broadcastInfoArr[$fiVal]["date"];
						
					
					$date = date("j F Y", strtotime($date));  
					$broadcastMsg = nl2br($broadcastMsg);
								

$showBroadcast =<<<IGWEZE
	
					 

					<div id = 'fobrain-print'>

					<!-- table -->
					<table class="table view-table"> 

					<tr><th> Title </td> <td> $bTitle class </td> </tr> 

					<tr><th> Details </td> <td> $broadcastMsg</td> </tr> 

					<tr><th>  Date </td> <td> $date</td> </tr> 

					</table>
					<!-- / table --> 

					</div>
	
IGWEZE;
			
					echo $showBroadcast; 
					
					echo "<script type='text/javascript'> hidePageLoader(); </script>"; exit;
					
					

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				}
		
		
			}
		
		}elseif ($_REQUEST['broadcast'] == 'add') {  /* add school broadcast */ 
			
			

?>
			<!-- form -->
			<form class="form-horizontal" id="frmsaveBroadcast" role="form"> 

				<!-- row -->
				<div class="row gutters">
					<div class="col-12">										
						<!-- field wrapper start -->
						<div class="field-wrapper">
							<input type="text" class="form-control" placeholder="Enter Broadcast Title" 
							name="title"  id="title">
							<div class="field-placeholder"> Title <span class="text-danger">*</span></div>
						</div>
						<!-- field wrapper end -->
					</div>									 
				</div>	
				<!-- /row -->

				<!-- row -->
				<div class="row gutters">
					<div class="col-12">										
						<!-- field wrapper start -->
						<div class="field-wrapper">
							<textarea rows="4" cols="10" class="form-control" name="broadcastMsg" id="broadcastMsg" 
							placeholder="Broadcast Message"></textarea>
							<div class="field-placeholder"> Message  <span class="text-danger">*</span></div>
						</div>
						<!-- field wrapper end -->
					</div>									 
				</div>	
				<!-- /row --> 

				<!-- row -->
				<div class="row gutters">
					<div class="col-12">										
						<!-- field wrapper start -->
						<div class="field-wrapper">
							<input type="date" class="form-control" placeholder="Enter Broadcast Date" 
							name="bDay"  id="bDay">
							<div class="field-placeholder"> Date:  <span class="text-danger">*</span></div>
						</div>
						<!-- field wrapper end -->
					</div>									 
				</div>	
				<!-- /row --> 


				<hr class="mt-30 mb-15 text-danger" />
				<!-- row -->
				<div class="row gutters modal-btn-footer">
					<div class="col-6 text-start">
						<button type="button" id="close-modal" class="btn btn-danger close-modal" 
						data-bs-dismiss="modal"> <i class="mdi mdi-window-close label-icon"></i> Close</button>
					</div>
					<div class="col-6 text-end">
						<input type="hidden" name="broadcast" value="save" />
						<button type="submit" class="btn btn-primary waves-effect   
						btn-label waves-light" id="saveBroadcast">
							<i class="mdi mdi-content-save label-icon"></i>  Save
						</button>
					</div>
				</div>	
				<!-- /row -->				
			</form>  	
			<!-- / form -->	
			
			<script type='text/javascript'>  hidePageLoader(); </script>
			
<?php						
							
						
		
		}elseif ($_REQUEST['broadcast'] == 'edit') {  /* edit school broadcast */ 
			
			$bID = clean($_REQUEST['rData']); 
			
			if ($bID == ""){
				
				$msg_e = "* Ooops, an error has occur while to retrieve Broadcast Message. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
				
			}else {       

				try { 
					
					$broadcastInfoArr = broadcastInfo($conn, $bID);  /* school annoucement/broadcast information */ 
					$bTitle = $broadcastInfoArr[$fiVal]["bTitle"];
					$broadcastMsg = htmlspecialchars_decode($broadcastInfoArr[$fiVal]["broadcastMsg"]); 
					$date = $broadcastInfoArr[$fiVal]["date"];


?>
					<!-- form -->
					<form class="form-horizontal" id="frmupdateBroadcast" role="form"> 

						<!-- row -->
						<div class="row gutters">
							<div class="col-12">										
								<!-- field wrapper start -->
								<div class="field-wrapper">
									<input type="text" class="form-control" placeholder="Enter Broadcast Title" 
									name="title"  id="title" value="<?php echo $bTitle; ?>">
									<div class="field-placeholder"> Title <span class="text-danger">*</span></div>
								</div>
								<!-- field wrapper end -->
							</div>									 
						</div>	
						<!-- /row -->

						<!-- row -->
						<div class="row gutters">
							<div class="col-12">										
								<!-- field wrapper start -->
								<div class="field-wrapper">
									<textarea rows="4" cols="10" class="form-control" name="broadcastMsg" id="broadcastMsg" 
									placeholder="Broadcast Message"><?php echo $broadcastMsg; ?></textarea>

									<div class="field-placeholder"> Message  <span class="text-danger">*</span></div>
								</div>
								<!-- field wrapper end -->
							</div>									 
						</div>	
						<!-- /row --> 

						<!-- row -->
						<div class="row gutters">
							<div class="col-12">										
								<!-- field wrapper start -->
								<div class="field-wrapper">
									<input type="date" class="form-control" placeholder="Enter Broadcast Date" 
									name="bDay"  id="bDay" value="<?php echo $date; ?>">

									<div class="field-placeholder"> Date:  <span class="text-danger">*</span></div>
								</div>
								<!-- field wrapper end -->
							</div>									 
						</div>	
						<!-- /row -->  

						<hr class="mt-30 mb-15 text-danger" />
						<!-- row -->
						<div class="row gutters modal-btn-footer">
							<div class="col-6 text-start">
								<button type="button" id="close-modal" class="btn btn-danger close-modal" 
								data-bs-dismiss="modal"> <i class="mdi mdi-window-close label-icon"></i> Close</button>
							</div>
							<div class="col-6 text-end">
								<input type="hidden" name="broadcast" value="update" />
								<input type="hidden" name="bID" value="<?php echo $bID; ?>" />
								<button type="submit" class="btn btn-primary    
								btn-label waves-light" id="updateBroadcast">
									<i class="mdi mdi-content-save label-icon"></i>  Save
								</button>
							</div>
						</div>	
						<!-- /row -->

					</form>  	
					<!-- / form -->		 
<?php						
							
					echo "<script type='text/javascript'> hidePageLoader();  </script>"; exit; 

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				} 
		
			}
		
		}else{ 
		
			echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
		
		} 
		
exit;

?>