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
	This script handle school events
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

		if (!defined('fobrain')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');	    

		if ($_REQUEST['event'] == 'save') {  /* save school event */	    

			$title =  strip_tags($_REQUEST['title']);
			$comments = $_REQUEST['comments']; 
			$eDay = $_REQUEST['eDay'];
			
			/* script validation */
			
			if ($title == "")  {
				
				$msg_e = "* Ooops Error, please enter Event Title";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>  hidePageLoader();  </script>";exit;
				
			}elseif ($comments == "")  {
				
				$msg_e = "* Ooops Error, please enter Event Message";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
				
			}elseif ($eDay == "")  {
				
				$msg_e = "* Ooops Error, please select a Event date";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
				
			}else {  /* insert information */       			
				
				
				$comments = strip_tags($comments);
				$comments = str_replace('<br />', "\n", $comments);
				$comments = htmlspecialchars($comments); 

				try {
					
					
					$ebele_mark = "INSERT INTO $notificationTB (title, comments, start)

							VALUES (:title, :comments, :start)";
					
					$igweze_prep = $conn->prepare($ebele_mark); 
					$igweze_prep->bindValue(':title', $title); 
					$igweze_prep->bindValue(':comments', $comments);
					$igweze_prep->bindValue(':start', $eDay); 
					
					if($igweze_prep->execute()){  /* if sucessfully */
						
						$msg_s = "Event Message was successfully saved"; 
						echo $succesMsg.$msg_s.$sEnd; 
						echo "<script type='text/javascript'> 
								$('#load-wiz-info').load('event-info.php');
								$('#frmsaveEvent')[0].reset(); 
								hidePageLoader();   
							</script>";exit;
						
					}else{  /* display error */ 
			
						$msg_e =  "Ooops, an error has occur while to save Event Message. Please try again";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
						
					}
					

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				} 
		
			}
		
		}elseif ($_REQUEST['event'] == 'update') {  /* update school event */

			$id = cleanInt($_REQUEST['id']);	
			$title =  strip_tags($_REQUEST['title']);	 
			$comments = $_REQUEST['comments']; 
			$eDay = $_REQUEST['eDay'];
			
			/* script validation */ 
			
			if ($id == ""){
				
				$msg_e = "* Ooops, aan error has occur to retrieve event information. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
				
			}elseif ($title == "")  {
				
				$msg_e = "* Ooops Error, please enter Event Title";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
				
			}elseif ($comments == "")  {
				
				$msg_e = "* Ooops Error, please enter Event Message";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
				
			}elseif ($eDay == "")  {
				
				$msg_e = "* Ooops Error, please select a Event date";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
				
			}else {  /* update information */       			
			
				$comments = strip_tags($comments);
				$comments = str_replace('<br />', "\n", $comments);
				$comments = htmlspecialchars($comments); 

				try { 
					
					$ebele_mark = "UPDATE $notificationTB 
										
										SET  
											
										title = :title, 		
										comments = :comments,
										start = :start
										
									WHERE id = :id";
					
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':id', $id); 
					$igweze_prep->bindValue(':title', $title); 
					$igweze_prep->bindValue(':comments', $comments);
					$igweze_prep->bindValue(':start', $eDay);  
					
					if($igweze_prep->execute()){  /* if sucessfully */
						
						$msg_s = "Event Message was successfully saved."; 
						echo $succesMsg.$msg_s.$sEnd; 
						echo "<script type='text/javascript'> 
								$('#load-wiz-info').load('event-info.php');  
								$('#frmupdateEvent').slideUp(1500);
								$('#modal-fobrain').modal('hide');
								hidePageLoader(); 
						</script>";exit;
						
					}else{  /* display error */ 
			
						$msg_e =  "Ooops, an error has occur while to save Event Message. Please try again";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
						
					} 

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				} 
		
			}
		
		}elseif ($_REQUEST['event'] == 'remove') {  /* remove school event */ 
			
			$eventData = $_REQUEST['rData'];
			
			list($fobrainIg, $id, $hName) = explode("-", $eventData);			
			
			/* script validation */
			
			if (($eventData == "")  || ($id == "")){
				
				$msg_e = "* Ooops, an error has occur while to remove Event Message. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
				
			}else {  /* remove information */       			


				try {
					
					
					$ebele_mark = "DELETE FROM 
					
									$notificationTB										
										
									WHERE id = :id
										
									LIMIT 1";
					
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':id', $id);  
					
					if($igweze_prep->execute()){  /* if sucessfully */
						
						$removeDiv = "$('#row-".$id."').fadeOut(1000);";
						$msg_s = "<strong>Event Message</strong> was successfully removed"; 
						echo $succesMsg.$msg_s.$sEnd; 
						echo "<script type='text/javascript'>   
								$removeDiv 
								hidePageLoader();   
						</script>";exit;
						
					}else{  /* display error */ 
			
						$msg_e =  "Ooops, an error has occur while to remove Event Message. Please try again";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
						
					}
					

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				} 
		
			}
		
		}elseif ($_REQUEST['event'] == 'view') {  /* view school event */

			
			$id = $_REQUEST['rData'];
			
			
			if ($id == ""){
				
				$msg_e = "* Ooops, an error has occur while to retrieve Event Message. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
				
			}else {       

				try { 
					
					$eventInfoArr = eventInfo($conn, $id);  /* school annoucement/event information */ 
					$title = $eventInfoArr[$fiVal]["title"];
					$comments = htmlspecialchars_decode($eventInfoArr[$fiVal]["comments"]); 
					$date = $eventInfoArr[$fiVal]["start"];
						
					
					$date = date("j F Y", strtotime($date));  
					$comments = nl2br($comments);
								

$showEvent =<<<IGWEZE
	
					 

					<div id = 'fobrain-print'>

					<!-- table -->
					<table class="table view-table"> 

					<tr><th> Title </td> <td> $title class </td> </tr> 

					<tr><th> Details </td> <td> $comments</td> </tr> 

					<tr><th>  Date </td> <td> $date</td> </tr> 

					</table>
					<!-- / table --> 

					</div>
	
IGWEZE;
			
					echo $showEvent; 
					
					echo "<script type='text/javascript'> hidePageLoader(); </script>"; exit;
					
					

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				}
		
		
			}
		
		}elseif ($_REQUEST['event'] == 'add') {  /* add school event */ 
			
			

?>
			<!-- form -->
			<form class="form-horizontal" id="frmsaveEvent" role="form"> 

				<!-- row -->
				<div class="row gutters">
					<div class="col-12">										
						<!-- field wrapper start -->
						<div class="field-wrapper">
							<input type="text" class="form-control" placeholder="Enter Event Title" 
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
							<textarea rows="4" cols="10" class="form-control" name="comments" id="comments" 
							placeholder="Event Message"></textarea>

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
							<input type="date" class="form-control" placeholder="Enter Event Date" 
							name="eDay"  id="eDay">
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
						<input type="hidden" name="event" value="save" />
						<button type="submit" class="btn btn-primary waves-effect   
						btn-label waves-light" id="saveEvent">
							<i class="mdi mdi-content-save label-icon"></i>  Save
						</button>
					</div>
				</div>	
				<!-- /row -->				
			</form>  	
			<!-- / form -->	
			
			<script type='text/javascript'>  hidePageLoader(); </script>
			
<?php						
							
						
		
		}elseif ($_REQUEST['event'] == 'edit') {  /* edit school event */ 
			
			$id = strip_tags($_REQUEST['rData']); 
			
			if ($id == ""){
				
				$msg_e = "* Ooops, an error has occur while to retrieve Event Message. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
				
			}else {       

				try { 
					  
					$eventInfoArr = eventInfo($conn, $id);  /* school annoucement/event information */ 
					$title = $eventInfoArr[$fiVal]["title"];
					$comments = htmlspecialchars_decode($eventInfoArr[$fiVal]["comments"]); 
					$date = $eventInfoArr[$fiVal]["start"];


?>
					<!-- form -->
					<form class="form-horizontal" id="frmupdateEvent" role="form"> 

						<!-- row -->
						<div class="row gutters">
							<div class="col-12">										
								<!-- field wrapper start -->
								<div class="field-wrapper">
									<input type="text" class="form-control" placeholder="Enter Event Title" 
									name="title"  id="title" value="<?php echo $title; ?>">
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
									<textarea rows="4" cols="10" class="form-control" name="comments" id="comments" 
									placeholder="Event Message"><?php echo $comments; ?></textarea>

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
									<input type="date" class="form-control" placeholder="Enter Event Date" 
									name="eDay"  id="eDay" value="<?php echo $date; ?>">

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
								<input type="hidden" name="event" value="update" />
								<input type="hidden" name="id" value="<?php echo $id; ?>" />
								<button type="submit" class="btn btn-primary    
								btn-label waves-light" id="updateEvent">
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