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
	This page load student dashboard
	------------------------------------------------------------------------*/  

if(!session_id()){
    session_start();
}

		if (!defined('fobrain')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
        
		require 'fobrain-config.php';  /* load fobrain configuration files */	 
	
	 	require_once ($fobrainCWallFunctionDir);

		try {  
					
			$memberInfo = companionWallUserDetails($conn, $_SESSION['regNo'], $seVal);  /* retrieve student companion details */
			
			list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic, $m_dept, $m_faculty, $userMail, 
					$wallPic, $load_page) = explode ("##", $memberInfo);				

			$unreadMsg = numOfUnreadMsg($conn, $member_id); global $userMail;  /* retrieve number of unread message */
 
			libraryBookExceededLimitChecker($conn, $regID, $schoolID, $render = false);  /* check if student has any expired library book in possession */

		}catch(PDOException $e) {
  			
			fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			 
		}
		 				 
?>	

		<style> 
			div.timeline {
				width: 100% !important; 
			}   
		</style>


		<div class="row gutters mb-25" data-aos="fade-up" data-aos-duration="15000"> 

			<div class="col-12">
				<!-- card -->
				<div class="card card-widget-1 card-shadow"> 
					<?php 
						$page_title = '<i class="fas fa-list-ol fs-16"></i> 
            						Student Attendance ';
						pageTitle($page_title, 1);	  
					?>
					<!-- card body -->
					<div class="card-body scroll">  
						<div id="calendar-roll" class="my-15"></div>  
					</div>
					<!-- end card body -->
				</div>
				<!-- end card -->
			</div>
			<!-- end col -->
		</div>
		<!-- end row-->		


		<!-- row --> 
		<div class="row gutters" data-aos="fade-up" data-aos-duration="15000">
			<div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12  mb-25">
				<div class="card card-widget-1 card-shadow"> 
					<?php 
						$page_title = '<i class="fas fa-history fs-16"></i> 
						My Fees History';
						pageTitle($page_title, 0);	 
					?>
					<div class="card-body scroll">						
						<!-- row -->
						<div class="row gutters pt-2">								
							<div class="table-responsive pt-3">								
								<?php

									try {
									
										$levelArray = studentLevelsArray($conn);  /* student level array */ 
										$feesDataArr = studentFeesInfo($conn, $regID, $regNum, $schoolID);  /* student school fee array */
										$feesDataCount = count($feesDataArr);
										
									}catch(PDOException $e) {
									
											fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
										
									}	

										
								?>

								<button class="paginate-page display-none"  type="submit"> fobrains </button> 
								<script type='text/javascript'> renderTable(); </script> 
								<!-- table -->
								<table  class='table table-hover table-responsive style-table wiz-table'>
									<thead>
										<tr>
											<th>S/N</th> 
											<th>Category</th>  
											<th>Level</th>  
											<th>Amount <hr class="my-5 p-0 text-danger"/> Balance </th> 
											<th>Status</th>
											<th>Tasks</th>
										</tr>
									</thead> 
									<tbody> 
										<?php
											
											if($feesDataCount >= $fiVal){  /* check array is empty */		
													
												$serial_no = 0; 	
												
												for($i = $fiVal; $i <= $feesDataCount; $i++){  /* loop array */	
													
													$fID = $feesDataArr[$i]["fID"];
													$feeCat = $feesDataArr[$i]["feeCat"];
													$sessionID = $feesDataArr[$i]["session"];
													$regID = $feesDataArr[$i]["reg_id"];
													$regNum = $feesDataArr[$i]["regNo"];
													$schoolID = $feesDataArr[$i]["stype"];
													$level = $feesDataArr[$i]["level"];
													$class = $feesDataArr[$i]["class"];
													$term = $feesDataArr[$i]["term"];
													$method = $feesDataArr[$i]["method"];
													$fDetail = $feesDataArr[$i]["f_details"];
													$amount = $feesDataArr[$i]["amount"];
													$balance = $feesDataArr[$i]["balance"];
													$date = $feesDataArr[$i]["date"];
													$fStatus = $feesDataArr[$i]["f_status"];
													$confirm = $feesDataArr[$i]["pstatus"];
													$upload2 = $feesDataArr[$i]["upload2"];
													$amount2 = $feesDataArr[$i]["amount2"];
													$date2 = $feesDataArr[$i]["date2"];
													$method2 = $feesDataArr[$i]["method2"];
													$n_pay = $feesDataArr[$i]["n_pay"];
													$studentLevel = $levelArray[$level]['level'];
													
													$feeCategoryInfoArr = feeCategoryInfo($conn, $feeCat);  /* school fee category information */
													$feeCategory = $feeCategoryInfoArr[$fiVal]['fee'];
													
													$fID = trim($fID); 

													$sTerm = wizSelectArray($term, $termIntList);
													$school = wizSelectArray($schoolID, $school_list);
													$payMethod = wizSelectArray($method, $paymentMethodArr);
													$payStatus = wizSelectArray($fStatus, $paymentStatus); 
													$confirm_pay = wizSelectArray($confirm, $confirm_pay_arr);   
														
													if($n_pay == $seVal){
														$amount += intval($amount2);	 
														$amount = fobrainCurrency($amount, $curSymbol);  /* school currency information*/
														$balance = $curSymbol."0.00";
														$date = date("j M Y", strtotime($date2));
													}else{
														$amount = fobrainCurrency($amount, $curSymbol);  /* school currency information*/
														$balance = fobrainCurrency($balance, $curSymbol);  /* school currency information*/
														$date = date("j M Y", strtotime($date));
													}

													$serial_no++;								

$feesData =<<<IGWEZE

													<tr id="row-$fID" >
														<td>$serial_no</td> 
														<td> $feeCategory </td> 
														<td> $studentLevel $class </td> 
														<td> $amount <hr class="my-5 p-0 text-danger"/>  $balance</td>  
														<td> $payStatus <hr class="my-5 p-0 text-danger"/> $confirm_pay</td> 
														<td>   
															<a href='javascript:;' id='$fID' class ='viewFees text-sienna btn waves-effect btn-label waves-light'>									
																<i class="mdi mdi-text-box-search label-icon"></i>  
															</a> 
														</td>
													</tr>

IGWEZE;
						
													echo $feesData; 								

							}
							
							
					}else{  /* display information message */ 
									
							$msg_i = "Ooops, you don't have any school fees history to show at the momment"; 
							echo $infMsg.$msg_i.$msgEnd;
									
					}


			
		?>           
					
									</tbody>
								</table>
								<!-- table -->								
							
							</div> 
						</div>
						<!-- / row -->  
					</div>
				</div>
			</div>
			
			<div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 col-12 mb-25">
				<!-- card -->
				<div class="card card-widget-1 card-shadow"> 
					<?php 
						$page_title = '<i class="fas fa-broadcast-tower fs-16" data-title="FoBrain Page Tour" data-intro="School Broadcast Section 👋"></i> 
						School Broadcast';
						pageTitle($page_title, 0);	 
					?>
					<!-- card body -->
					<div class="card-body scroll">
					
						<div class="table-responsive pt-3">

							<?php
							try {
							
								$broadcastDataArr = broadcastData($conn);  /* school annoucement/broadcast array */
								$broadcastDataCount = count($broadcastDataArr);
								
							}catch(PDOException $e) {
							
									fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
								
							} 
										
							?>	 
							
							<!-- table -->		
							<table  class='table table-hover table-responsive style-table  wiz-table'>
								<thead>
								<tr>
									<th>S/N</th>                         
									<th>Title</th> 						 
									<th>Date</th> 
									<th>Tasks</th>
								</tr>
								</thead> 
								<tbody>

<?php

								if($broadcastDataCount >= $fiVal){  /* check array is empty */	 
									
									$serial_no = 0; 	
									
									for($i = $fiVal; $i <= $broadcastDataCount; $i++){  /* loop array */	
										
										$bID = $broadcastDataArr[$i]["bID"]; 
										$bTitle = $broadcastDataArr[$i]["bTitle"];
										$broadcastMsg = $broadcastDataArr[$i]["broadcastMsg"]; 
										$date = $broadcastDataArr[$i]["date"]; 
											
										$bID = trim($bID); 
										
										$date = date("j M Y", strtotime($date)); 
										
										$serial_no++; 

$broadcastData =<<<IGWEZE

										<tr id="row-$bID" >
										<td>$serial_no</td>  
										<td> $bTitle  </td>  
										<td> $date </td>  
										<td> 
											<a href='javascript:;' id='$bID' class ='viewBroadcast text-sienna btn waves-effect btn-label waves-light'>
												<i class="mdi mdi-text-box-search label-icon"></i>   											
											</a> 	 
										</td>
										</tr>

IGWEZE;
					
										echo $broadcastData; 
					

								} 
					
					
							}else{  /* display information message */ 
							
								$msg_i = "Ooops, there is no school annoucement to show at the momment"; 
								echo $infMsg.$msg_i.$msgEnd;
							
							}	
?>                      
								</tbody>
							</table>
							
							<!-- / table --> 
						</div>
						<!-- responsive table -->
					</div>
					<!-- end card -->
				</div>
				<!-- end col -->
			</div>
			<!-- end row--> 
			
		</div>
		<!-- / row --> 

		
		
		<div class="row align-items-center"  data-aos="fade-up data-aos-duration="15000">	
			<div class="col-lg-4 mb-25">
				<!-- card -->
				<div class="card card-widget-1 card-shadow"> 
					<?php 
						$page_title = '<i class="mdi mdi-cart-variant fs-18" data-title="FoBrain Page Tour" data-intro="School Shop Display 👋"></i> 
							School Cart';
						pageTitle($page_title, 0);	 
					?> 
					<div class="card-body py-0  scroll"> 
						<div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">	
							<div class="carousel-inner">							
							<?php  
								$shopData = 'sProduct'; $slide_item = true;
								require_once 'load-products.php';	   /* include cart product script */					
							?> 									 
							</div> 
								
						</div><!-- end carousel -->
					</div><!-- end card-body --> 
				</div>
				<!-- end card -->
			</div>  

			<div class="col-lg-8 mb-25">
				<!-- card -->
				<div class="card card-widget-1 card-shadow"> 
					<?php 
						$page_title = '<i class="fas fa-history fs-16" data-title="FoBrain Page Tour" data-intro="Your School Library History 👋"></i> 
						My Library History';
						pageTitle($page_title, 0);	 
					?>
					<div class="card-body scroll">

					<div id="lib-book-msg"></div>
<?php

		try {
					

					
			$student_name = studentName($conn, $regNum);  /* students name information  */ 
	
			$student_img = studentPicture($conn, $regNum);  /* students profile picture  */ 
			

$table_head =<<<IGWEZE

				
			
				
			<div class="table-responsive">
			<!-- table -->
			<table  class='table table-hover table-responsive style-table wiz-table'>
			<thead>
				<tr><th style=" width: 3%; ">ID</th>
				<th style=" width: 32%;">Details <hr/> Status</th> 
				<th style=" width: 30%;">Time Apply <hr/> Time Approved <hr/> Return Date</th> 				
				<th style=" width: 35%;">Comments</th> 
			</thead> 
			<tbody>
	
IGWEZE;

			echo  $table_head;
			
			$ebele_mark = "SELECT b_id, book_id, lib_user, lib_reg, apply_date, approve_date, return_date, d_reasons, comment, 
							stype, b_status
			
							FROM $fobrainLibApplyTB
							
							WHERE  stype = :stype
							
							AND lib_user = :lib_user";
					
			$igweze_prep = $conn->prepare($ebele_mark); 
			$igweze_prep->bindValue(':stype', $schoolID);
			$igweze_prep->bindValue(':lib_user', $regID);
			$igweze_prep->execute();
			
			$rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count >= $foreal) {  /* check array is empty */
					
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {  /* loop array */		

					$book_id = $row['book_id'];
					$applyID = $row['b_id'];
					$lib_user = $row['lib_user'];
					$lib_reg = $row['lib_reg'];
					$apply_date = $row['apply_date'];
					$approve_date = $row['approve_date'];
					$return_date = $row['return_date'];
					$d_reasons = $row['d_reasons'];
					$comment = $row['comment'];
					$schoolID = $row['stype']; 
					$b_status = $row['b_status'];
					
					if($b_status == $foVal){$comment = $d_reasons;}
					
					if($apply_date != ''){
						
						$apply_date = strtotime($apply_date);
						$apply_date = date("h:i:s, j M Y", $apply_date);
						
					}else{ $apply_date = ' - '; }

					if($approve_date != ''){
						
						$approve_date = strtotime($approve_date);
						$approve_date = date("h:i:s, j M Y", $approve_date);
						
					}else{ $approve_date = ' - '; }


					if($return_date != ''){
						
						$return_date = strtotime($return_date);
						$return_date = date("h:i:s, j M Y", $return_date);
						
					}else{ $return_date = ' - '; }
					
					
					if(($approve_date != '') && ($return_date != '')){
						
						if($approve_date >= $return_date){
							
							$is_due = "Yes";
							
						}else{

							$is_due = "No";
							
						}		
						
						
					}	


						$ebele_mark_1 = "SELECT book_id, book_name, book_author, book_desc, book_path, book_type, book_hits, book_copies, 
										book_location, stype, book_status
						
										FROM $fobrainSchLib
										
										WHERE  book_id = :book_id";
								
						$igweze_prep_1 = $conn->prepare($ebele_mark_1);
						$igweze_prep_1->bindValue(':book_id', $book_id);
						$igweze_prep_1->execute();
						
						$rows_count_1 = $igweze_prep_1->rowCount(); 
						
						if($rows_count_1 == $foreal) {  /* check array is empty */
						
							while($row_1 = $igweze_prep_1->fetch(PDO::FETCH_ASSOC)) {  /* loop array */		
				
								$book_id = $row_1['book_id'];
								$book_name = $row_1['book_name'];
								$book_author = $row_1['book_author'];
								$book_path = $row_1['book_path'];
								$book_desc = $row_1['book_desc'];
								$book_type = $row_1['book_type'];
								$book_hits = $row_1['book_hits'];
								$book_copies = $row_1['book_copies'];
								$book_location = $row_1['book_location'];
								$book_status = $row_1['book_status']; 
								
							}
							
						}
						
					$book_name  = trim($book_name);
					$book_author  = trim($book_author);
					$book_desc  = trim($book_desc);
					$book_desc = htmlspecialchars_decode($book_desc);
					$book_desc = nl2br($book_desc);

					$bookPicture = libraryUploadsManager($conn, $book_type, $book_path);  /* school library book upload manager */ 

					if($book_type == $fiVal ){
						
						$bookLocation = '';				
						
					}else{
						
						
						$bookLocation = '<tr><th style="padding-left: 30px; text-align:left; width: 30%;">
										<i class="fa  fa-eye"></i> Book Location </td> <td style="padding-left: 
										30px; text-align:left; width: 70%;">'.$book_location.'</td> </tr>';
						
					}

					if($book_author == '') { $book_author = 'Anonymous'; }
					if($book_type != '') { $book_type = $libraryTypeArr[$book_type]; }
					else{$book_type = '-';}
					
					
					$bookStatus = $libraryAppStatusArr[$b_status];
					
				
					
$bookInfo =<<<IGWEZE

					<tr>
						<td> App$applyID </td>
						<td> 
							<div class="row align-items-center"> 
								<div class="col text-primary">
									<img src = "$bookPicture" class=" img-h-50 img-circle img-thumbnail">
										$book_name  
										by $book_author 
								</div>  
							</div>
								
							<hr class="bg-danger"/>
							$bookStatus  
						</td> 
						<td> $apply_date <hr class="bg-danger"/> $approve_date <hr class="bg-danger"/> $return_date</td> 
						<td>$comment</td> 
					</tr> 
	
IGWEZE;

					echo $bookInfo; 
			
				}
					
			}else{  /* display information message */ 
	
				$msg_i =  "Ooops, you dont have any book history information to view. Thanks";
				echo $infoMsg.$msg_i.$iEnd; 
		
			}
			
			echo  '</tbody></table><!-- / table --></div>';
			
		}catch(PDOException $e) {
		
				fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
		}

	

?>
						
					</div><!-- end card-body -->
			
				</div>
				<!-- end card -->
			</div>   
		</div>
		<!-- end row -->  

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


		


		<!--  school fee pop up modal start -->			
		<button type="button" class="btn modal-fee-div  display-none"  data-bs-toggle="modal" data-bs-target="#modal-fee-div"></button>				
		<!-- Scrollable modal -->
		<div class="modal fade animate__animated animate__zoomInDown" id="modal-fee-div" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
			<div class="modal-dialog modal-fullscreen-sm-down modal-dialog-scrollable">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalScrollableTitle"> 
							<i class="mdi mdi-calendar-clock"></i>  
							Fees Manager
						</h5>
						<div id="editMsg"> </div> 
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body slideUpFrmUDiv">
						<div id="editFeesDiv"></div> 
					</div> 
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		<!-- school fee pop up modal end --> 

		<!-- annoucement pop up modal start -->			
		<button type="button" class="btn modal-bcast-div  display-none"  data-bs-toggle="modal" data-bs-target="#modal-bcast-div"></button>				
		<!-- Scrollable modal -->
		<div class="modal fade animate__animated animate__zoomInDown" id="modal-bcast-div" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
			<div class="modal-dialog modal-fullscreen-sm-down modal-dialog-scrollable">
				<div class="modal-content">
					<div class="modal-header"> 
						<h5 class="modal-title" id="exampleModalScrollableTitle">  
							<i class="mdi mdi-account-tie-voice label-icon"></i>  
							Annoucements  Manager
						</h5>	
						<div id="editMsg"> </div> 
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body slideUpFrmUDiv">
						<div id="editBroadcastDiv"></div> 
					</div> 
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		<!-- annoucement pop up modal end -->	

		<!--  fobrain modal start -->			
		<button type="button" class="btn modal-fobrain  display-none"  data-bs-toggle="modal" data-bs-target="#modal-fobrain"></button>				
		<!-- Scrollable modal -->
		<div class="modal fade animate__animated animate__zoomInDown" id="modal-fobrain" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
			<div class="modal-dialog modal-fullscreen-sm-down modal-dialog-scrollable">
				<div class="modal-content">
					<div class="modal-header"> 
						<h5 class="modal-title" id="exampleModalScrollableTitle"> 
							<i class="mdi mdi-message-reply-text-outline label-icon"></i>  
							Drop a Reply
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

		<script type='text/javascript'> 

			var notificationNo = $('#notMsgDiv').text(); 
			$('.notMsgNum').html(notificationNo);  

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

				var calendarEl2 = document.getElementById('calendar-roll');
 
				var calendar2 = new FullCalendar.Calendar(calendarEl2, {

					headerToolbar: {
						left: 'prev,next',
						center: 'title',
						right: 'today'
					},
					height: 650,
					events: 'rollcall-info.php',					
					selectable: true,					
					eventClick: function(info) {
					info.jsEvent.preventDefault();
					
					// change the border color
					info.el.style.borderColor = 'red';
					//html:'<h4 class="text-primary">Teacher Comment</h4><p>'+info.event.extendedProps.comments+'</p><hr class="my-15 text-danger" /><h4 class="text-primary">Parent Comment</h4><p>'+info.event.extendedProps.reply+'</p>',

					Swal.fire({
						//title: info.event.title,
						//text: info.event.extendedProps.comments,
						//icon: 'info',						 
						html: 
						'<div class="rows mt-40">' +
							'<div class="col-12">' +
								'<div class="attendance-timeline">' +
									'<div class="timeline filter-item" >' +
										'<a href="#" class="timeline-content">' +
											'<div class="timeline-year"><i class="mdi mdi-comment-multiple"></i> Attendance</div>' +
											'<h3 class="title text-end">'+info.event.title+'</h3>' +
											'<h3 class="title mt-20 start-end">Teacher Comment</h3>' +
											'<p class="description">'+info.event.extendedProps.comments+'</p>' +
											'<hr class="my-15 text-danger" />' +
											'<h3 class="title mt-20 start-end">Parent Reply</h3>' +
											'<p class="description">'+info.event.extendedProps.reply+'</p>' +  
										'</a>' +
									'</div>' +
								'</div>' +
							'</div>' +
						'</div>',
						showCloseButton: true,
						showCancelButton: true,
						showDenyButton: true,
						cancelButtonText: '<i class="mdi mdi-close-circle"></i> Close', 
						denyButtonText: '<i class="mdi mdi-square-edit-outline"></i> Drop Reply',
						customClass: { 
							cancelButton: 'swal2-button-fobrain swal2-cancel-button-fobrain', 
							denyButton: 'swal2-button-fobrain swal2-deny-button-fobrain'
						}, 
						
					}).then((result) => {
						if (result.isConfirmed) {
						// Delete event
						fetch("rollcall-manager.php", {
							method: "POST",
							headers: { "Content-Type": "application/json" },
							body: JSON.stringify({ request_type:'delete', event_id: info.event.id}),
						})
						.then(response => response.json())
						.then(data => {
							if (data.status == 1) {
							Swal.fire('Attendance deleted successfully!', '', 'success'); 
							} else {
							Swal.fire(data.error, '', 'error');
							}

							// Refetch events from all sources and rerender
							calendar2.refetchEvents();
						})
						.catch(console.error);
						} else if (result.isDenied) {
						// Edit and update event
						//'<p class="fs-18 text-primary">'+info.event.title+'</p><hr class="my-5 text-danger" /><h4 class="text-primary">Teacher Comment</h4><p>'+info.event.extendedProps.comments+'</p><hr class="my-15 text-danger" /><h4 class="text-primary">Parent Comment</h4>' +		
							//'<textarea id="swalEvtDesc_edit" class="form-swal form-swal-area" placeholder="Enter Comment">'+info.event.extendedProps.reply+'</textarea>',
							 
						Swal.fire({
							title: '<i class="mdi mdi-comment-text-multiple-outline fs-24"></i>  Drop Reply',						 
							html: 
							'<div class="rows">' +
								'<div class="col-12">' +
									'<div class="attendance-timeline">' +
										'<div class="timeline filter-item" >' +
											'<div href="#" class="timeline-content">' +
												'<div class="timeline-year"><i class="mdi mdi-comment-multiple"></i> Reply</div>' +
												'<h3 class="title text-end">'+info.event.title+'</h3>' +
												'<h3 class="title mt-20 start-end">Teacher Comment</h3>' +
												'<p class="description">'+info.event.extendedProps.comments+'</p>' +
												'<hr class="my-15 text-danger" />' +
												'<h3 class="title mt-20 start-end">Parent Reply</h3>' +
												'<div><textarea id="swalEvtDesc_edit" class="form-swal form-swal-area" placeholder="Enter Comment">'+info.event.extendedProps.reply+'</textarea></div>' + 
											'</div>' +
										'</div>' +
									'</div>' + 
								'</div>' +
							'</div>',
							
							showCloseButton: true,
							showCancelButton: true,
							focusConfirm: false,
							confirmButtonText: '<i class="mdi mdi-content-save"></i> Send', 
							cancelButtonText: '<i class="mdi mdi-close-circle"></i> Close',
							customClass: {
								confirmButton: 'swal2-button-fobrain swal2-confirm-button-fobrain',
								cancelButton: 'swal2-button-fobrain swal2-cancel-button-fobrain'
							},                    
							preConfirm: () => {
							return [ 
								document.getElementById('swalEvtDesc_edit').value 
							];
							}
						}).then((result) => {
							if (result.value) {
							// Attendance update request
							fetch("rollcall-manager.php", {
								method: "POST",
								headers: { "Content-Type": "application/json" },
								body: JSON.stringify({request_type:'reply', start:info.event.startStr, end:info.event.endStr, event_id: info.event.id, event_data: result.value}),
							})
							.then(response => response.json())
							.then(data => {
								if (data.status == 1) {
								Swal.fire('Your Reply was updated successfully!', '', 'success'); 
								} else {
								Swal.fire(data.error, '', 'error');
								}

								// Refetch events from all sources and rerender
								calendar2.refetchEvents();
							})
							.catch(console.error);
							}
						});
						} else {
						Swal.close();
						}
					});
					}
				});	 

				calendar2.render(); 

			});

			introJs().setOptions({
				showProgress: true,
			}).start()
			
		</script>

			
