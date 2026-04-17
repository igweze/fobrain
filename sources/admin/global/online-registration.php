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
	This page load online registration manager
	------------------------------------------------------------------------*/ 


		if (!defined('fobrain')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
				
		require_once $fobrainIconPage; /* This include top middle global icon page eg go back, print buttons etcs */

?>

		<!-- row -->
		<div <?php echo $fob_view; ?> class="row gutters row-section fobrain-section-div justify-content-center">
			<div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 mb-50">	
				<!-- card start -->
				<div class="card card-shadow"> 
					<?php 
						$page_title = '<i class="mdi mdi-account-tie fs-18"></i> 
						Registered Students';
						pageTitle($page_title, 0);	 
					?>
					<div id="msg-box"></div> 					
					<div class="card-body">
						<script type='text/javascript'>  renderTable(); </script>
						<div class="table-responsive">
							<!-- table -->
							<table class='table table-hover table-responsive style-table wiz-table' id="wiz-table">					
								<thead>
									<tr>
										<th>SN</th>
										<th>Picture</th> 
										<th>Name</th>                                 
										<th>Tasks</th>  
									</tr>
								</thead> 
								<tbody>
 
 				<?php

					try {
						
						/* select information */
						
						$ebele_mark = "SELECT stu_id, i_stupic, i_firstname, i_lastname, i_midname
						
										FROM $studentOnlineRegTB
										
										ORDER BY stu_id DESC";
							
						$igweze_prep = $conn->prepare($ebele_mark);
						
						$igweze_prep->execute();
						
						$rows_count = $igweze_prep->rowCount(); 
						
						if($rows_count >= $foreal) {  /* check array is empty */ 
						
							while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {  /* loop array */		

								$stu_id = $row['stu_id'];
								$pic = $row['i_stupic'];
								$fname = $row['i_firstname'];
								$lname = $row['i_lastname'];
								$mname = $row['i_midname'];  
								
								$student_img = picture($applyPSrc, $pic, "student");

								$rowID = 'reg-tr-'.$stu_id;

								$serial_no = $foreal++;
		
		
$tableBody =<<<IGWEZE

										<tr id ='$rowID'>
											<td>$serial_no</td>
											<td><img src = "$student_img" class=" img-h-50 img-circle img-thumbnail"></td>
											<td>$lname $fname $mname</td> 
											<td> 
												<a href="javascript:;"  id="$stu_id" class ="view-new-regis text-sienna btn waves-effect btn-label waves-light">
													<i class="mdi mdi-text-box-search label-icon"></i>  										
												</a> 
											</td> 
										</tr>

IGWEZE;
			echo $tableBody; 

							} 

						}else{  /* display error */

							$msg_i = "Ooops, no new student registration record was found. Thanks";
							echo $infoMsg.$msg_i.$iEnd;

						}

					}catch(PDOException $e) {
					
							fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
					
					}  


				?>			


								</tbody>
							</table>				
							<!-- / table -->
						</div>		
					</div>
				</div>
				<!-- card end -->	
			</div>

			<div class="col-xl-7 col-lg-7 col-md-7 col-sm-12" id="scroll-to-div">	
				<!-- card start -->
				<div class="card card-shadow"> 
					<?php 
						$page_title = '<i class="fas fa-tasks fs-16"></i> 
						Tasks Panel';
						pageTitle($page_title, 0);	 
					?>
					<div class="msg-box"></div> 					
					<div class="card-body" id="wigz-right-half"> 

					</div>
				</div>
				<!-- card end -->	
			</div>
		</div>
		<!-- / row -->	  		

          
		 