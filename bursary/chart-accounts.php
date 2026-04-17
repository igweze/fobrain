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
	This script handle school accs category
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

		define('fobrain', 'igweze');  /* define a check for wrong access of file */

		require 'fobrain-config.php';  /* load fobrain configuration files */
		 	
		if ($_REQUEST['query'] == 'save') {  /* save accs category */ 
			
			$chartAccount = clean($_REQUEST['acc']);
			$acc_type = clean($_REQUEST['acc_type']);
			$st_type = clean($_REQUEST['st_type']);
			$st_group = clean($_REQUEST['st_group']);
			$desc = clean($_REQUEST['desc']);			
			$regDate = strtotime(date("Y-m-d H:i:s"));
			
			/* script validation */
			
			if ($chartAccount == "")  {
				
				$msg_e = "* Ooops Error, please enter new chart account name";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
				
			}elseif ($acc_type == "")  {
			
				$msg_e = "* Ooops Error, please enter chart account type";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
			
			}elseif ($st_type == "")  {
			
				$msg_e = "* Ooops Error, please enter chart name";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
			
			}elseif (($st_type == 2) && ($st_group == "")) {
			
				$msg_e = "* Ooops Error, please select income balance group. This help in income balance statement";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
			
			}elseif ($desc == "")  {
			
				$msg_e = "* Ooops Error, please enter school chart acc description";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
			
			}else {  /* update information */     			


				try {
					
					
					$ebele_mark = "INSERT INTO $chartAccountTB  (acc, acc_type, st_type, st_group, descr)

							VALUES (:acc, :acc_type, :st_type, :st_group, :descr)";
					
					$igweze_prep = $conn->prepare($ebele_mark); 
					$igweze_prep->bindValue(':acc', $chartAccount);
					$igweze_prep->bindValue(':acc_type', $acc_type);
					$igweze_prep->bindValue(':st_type', $st_type);
					$igweze_prep->bindValue(':st_group', $st_group);
					$igweze_prep->bindValue(':descr', $desc); 
					
					if($igweze_prep->execute()){  /* if sucessfully */
						
						$msg_s = "<strong>$chartAccount</strong> acc was successfully saved"; 
						echo $succesMsg.$msg_s.$sEnd; 
						echo "<script type='text/javascript'> 
								$('#load-chart-account').load('chart-accounts-info.php'); 
								$('#frmsave-chartacc')[0].reset();  
								$('#modal-fobrain').modal('hide');
								hidePageLoader();  
							</script>"; exit;
						
					}else{  /* display error */
			
						$msg_e =  "Ooops, an error has occur while to add new chart account. Please try again";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
						
					}
					

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				} 
		
			}
		
		}elseif ($_REQUEST['query'] == 'update') {  /* update accs category */

			
			$chartAccount = clean($_REQUEST['acc']);
			$acc_type = clean($_REQUEST['acc_type']);
			$st_type = clean($_REQUEST['st_type']);
			$st_group = clean($_REQUEST['st_group']);
			$desc = clean($_REQUEST['desc']);
			$cstatus = cleanInt($_REQUEST['cstatus']);
			$cid = cleanInt($_REQUEST['fID']);			
			
			/* script validation */ 
			
			if ($cid == ""){
				
				$msg_e = "* Ooops, an error has occur to retrieve chart account. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
				
			}elseif ($chartAccount == "")  {
				
				$msg_e = "* Ooops Error, please enter new chart account name";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
				
			}elseif ($acc_type == "")  {
			
				$msg_e = "* Ooops Error, please chart account type";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
			
			}elseif ($st_type == "")  {
			
				$msg_e = "* Ooops Error, please enter chart name";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
			
			}elseif (($st_type == 2) && ($st_group == "")) {
			
				$msg_e = "* Ooops Error, please select income balance group. This help in income balance statement";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
			
			}elseif ($desc == "")  {
			
				$msg_e = "* Ooops Error, please enter school chart acc description";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
			
			}else {  /* update information */     			


				try {
					
					
					$ebele_mark = "UPDATE $chartAccountTB
									
									SET 
									
										acc = :acc, 
										acc_type = :acc_type,
										st_type = :st_type, 
										st_group = :st_group,
										descr = :descr, 
										cstatus = :cstatus
										
										WHERE cid = :cid";
					
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':acc', $chartAccount);
					$igweze_prep->bindValue(':acc_type', $acc_type);
					$igweze_prep->bindValue(':st_type', $st_type);
					$igweze_prep->bindValue(':st_group', $st_group);
					$igweze_prep->bindValue(':descr', $desc); 
					$igweze_prep->bindValue(':cstatus', $cstatus);
					$igweze_prep->bindValue(':cid', $cid); 
					
					if($igweze_prep->execute()){  /* if sucessfully */
						
						$msg_s = "<strong>$chartAccount</strong> was successfully saved"; 
						echo $succesMsg.$msg_s.$sEnd; 
						echo "<script type='text/javascript'> 
								$('#load-chart-account').load('chart-accounts-info.php');  
								//$('#edit-chart-accategory-div').slideUp(1500);
								$('#modal-fobrain').modal('hide');
								hidePageLoader(); 
							</script>";exit;
						
					}else{  /* display error */
			
						$msg_e =  "Ooops, an error has occur while to save chart account. Please try again";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
						
					}
					

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				} 
		
			}
		
		}elseif ($_REQUEST['query'] == 'remove') {  /* remove accs category */ 
			
			$query = $_REQUEST['rData'];
			
			list($fobrainIg, $cid, $hName) = explode("-", $query);			
			
			/* script validation */
			
			if (($query == "")  || ($cid == "")){
				
				$msg_e = "* Ooops, an error has occur while to remove chart account. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader();  </script>";exit;
				
			}else {   /* update information */    			

				try {
											
					$ebele_mark = "UPDATE $chartAccountTB
									
									SET 										
										cstatus = :cstatus
										
										WHERE cid = :cid";
					
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':cstatus', $i_false);
					$igweze_prep->bindValue(':cid', $cid); 
					
					if($igweze_prep->execute()){  /* if sucessfully */
						
						//$removeDiv = "$('#row-".$cid."').fadeOut(1000);";
						$msg_s = "<strong>$hName</strong> was successfully Disenable"; 
						echo $succesMsg.$msg_s.$sEnd; 
						echo "<script type='text/javascript'>    
								$('#load-chart-account').load('chart-accategory-info.php');
								hidePageLoader();   
						</script>";exit;
						
					}else{  /* display error */
			
						$msg_e =  "Ooops, an error has occur while to remove chart account. Please try again";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'> hidePageLoader();  </script>";exit;
						
					}
					

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				}          		
		
			}
		
		}elseif ($_REQUEST['query'] == 'edit') {  /* edit accs category */ 
			
			$cid = strip_tags($_REQUEST['rData']);
			
			/* script validation */ 
			
			if ($cid == ""){
				
				$msg_e = "* Ooops, an error has occur while to retrieve chart account information. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
				
			}else {  /* select information */     			

				try { 
					
					$chartAccountInfoArr = chartAccountInfo($conn, $cid);  /* school chart account information */
					$chartAccount = $chartAccountInfoArr[$fiVal]['acc'];
					$acc_type = $chartAccountInfoArr[$fiVal]['acc_type'];
					$st_type = $chartAccountInfoArr[$fiVal]['st_type'];
					$st_group = $chartAccountInfoArr[$fiVal]['st_group'];
					$desc = $chartAccountInfoArr[$fiVal]['descr'];
					$cstatus = $chartAccountInfoArr[$fiVal]['cstatus']; 

?>
	
					<form class="form-horizontal mt-10" id="frmupdate-chartacc"> 
					<!-- row -->
					<div class="row gutters">
						<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">										
							<!-- field wrapper start -->
							<div class="field-wrapper">
								<input type="text"  id="acc" name="acc"  class="form-control" value="<?php echo $chartAccount; ?>"  style="text-transform:Capitalize;">
								<div class="field-placeholder">Account Name<span class="text-danger">*</span></div>													
							</div>
							<!-- field wrapper end -->
						</div>
						
						<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">										
							<!-- field wrapper start -->
							<div class="field-wrapper">			

								<select class="form-control fob-select"  id="acc_type" name="acc_type">
																
									<option value = "">Please select One</option> 

									<?php
											
										foreach($account_type_arr as $acc_type_key => $acc_type_value){  /* loop array */

											if ($acc_type == $acc_type_key){
												$selected = "SELECTED";
											} else {
												$selected = "";
											}

											echo '<option value="'.$acc_type_key.'"'.$selected.'>'.$acc_type_value.'</option>' ."\r\n";

										}	     	

									?> 

								</select>

								<div class="field-placeholder"> Account Type <span class="text-danger">*</span></div>													
							</div>
							<!-- field wrapper end -->
						</div>
						
						<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">										
							<!-- field wrapper start -->
							<div class="field-wrapper">			
								
								<select class="form-control fob-select"  id="st_type" name="st_type">
																
									<option value = "">Please select One</option> 

									<?php
											
										foreach($account_state_arr as $st_type_key => $st_type_value){  /* loop array */

											if ($st_type == $st_type_key){
												$selected = "SELECTED";
											} else {
												$selected = "";
											}

											echo '<option value="'.$st_type_key.'"'.$selected.'>'.$st_type_value.'</option>' ."\r\n";

										}	     	

									?> 

								</select>

								<div class="field-placeholder"> Statement Type <span class="text-danger">*</span></div>													
							</div>
							<!-- field wrapper end -->
						</div>

						<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">										
							<!-- field wrapper start -->
							<div class="field-wrapper">			
								
								<select class="form-control fob-select"  id="st_group" name="st_group">
																
									<option value = "">Please select One</option> 

									<?php
											
										foreach($acc_group_arr as $st_group_key => $st_group_value){  /* loop array */

											if ($st_group == $st_group_key){
												$selected = "SELECTED";
											} else {
												$selected = "";
											}

											echo '<option value="'.$st_group_key.'"'.$selected.'>'.$st_group_value.'</option>' ."\r\n";

										}	     	

									?> 

								</select>

								<div class="field-placeholder"> Income Balance Group <span class="text-danger"></span></div>													
								<div class="form-text text-danger fs-12">
									This is for Income Balance Statement only
								</div>
							</div>
							
							<!-- field wrapper end -->
						</div>
						 

						<div class="col-12">										
							<!-- field wrapper start -->
							<div class="field-wrapper">
								<textarea rows="4" cols="10" class="form-control" name="desc" id="desc" 
								placeholder="Bank Acc. Description"><?php echo $desc; ?></textarea> 

								<div class="field-placeholder"> Acc. Description <span class="text-danger">*</span></div>
									
							</div>
							<!-- field wrapper end -->
						</div>															 
					 
						<div class="col-12">										
							<!-- field wrapper start -->
							<div class="field-wrapper">			
								<select class="form-control fob-select" id="cstatus"  name="cstatus" required>
																
									<option value = "">Please select One</option> 

									<?php 
											
									foreach($onOffArr as $cstatus_key => $cstatus_value){  /* loop array */

										if ($cstatus == $cstatus_key){
											$selected = "SELECTED";
										} else {
											$selected = "";
										}

										echo '<option value="'.$cstatus_key.'"'.$selected.'>'.$cstatus_value.'</option>' ."\r\n";

									}	     	

									?>


								</select>

								<div class="field-placeholder"> Fee Amount <span class="text-danger">*</span></div>													
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
							<input type="hidden" name="query" value="update" />
							<input type="hidden" name="fID" value="<?php echo $cid; ?>" />
							<button type="submit" class="btn btn-primary waves-effect   
							btn-label waves-light demo-disenable" id="update-chartacc">
								<i class="mdi mdi-content-save label-icon"></i>  Update
							</button>
						</div>
					</div>	
					<!-- /row -->		 
												
					</form>
					<!-- / form -->	 

					<script type='text/javascript'>  
						$('.fob-select').each(function() {  
							renderSelect($('#'+this.id)); 
						});
						hidePageLoader(); 
					</script>	
						
	
<?php	 			 

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				} 
		
			}
		
		}elseif ($_REQUEST['query'] == 'add') {  /* edit accs category */

?>
			
				<!-- form -->
				<form class="form-horizontal mt-10" id="frmsave-chartacc"> 
					<!-- row -->
					<div class="row gutters">
						<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">										
							<!-- field wrapper start -->
							<div class="field-wrapper">
								<input type="text"  id="acc" name="acc"  class="form-control" style="text-transform:Capitalize;">
								<div class="field-placeholder">Account Name<span class="text-danger">*</span></div>													
							</div>
							<!-- field wrapper end -->
						</div>	
						
						<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">										
							<!-- field wrapper start -->
							<div class="field-wrapper">			

								<select class="form-control fob-select"  id="acc_type" name="acc_type">
																
									<option value = "">Please select One</option> 

									<?php
											
										foreach($account_type_arr as $acc_type_key => $acc_type_value){  /* loop array */

											if ($acc_type == $acc_type_key){
												$selected = "SELECTED";
											} else {
												$selected = "";
											}

											echo '<option value="'.$acc_type_key.'"'.$selected.'>'.$acc_type_value.'</option>' ."\r\n";

										}	     	

									?> 

								</select>

								<div class="field-placeholder"> Account Type <span class="text-danger">*</span></div>													
							</div>
							<!-- field wrapper end -->
						</div>
						
						<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">										
							<!-- field wrapper start -->
							<div class="field-wrapper">			
								
								<select class="form-control fob-select"  id="st_type" name="st_type">
																
									<option value = "">Please select One</option> 

									<?php
											
										foreach($account_state_arr as $st_type_key => $st_type_value){  /* loop array */

											if ($st_type == $st_type_key){
												$selected = "SELECTED";
											} else {
												$selected = "";
											}

											echo '<option value="'.$st_type_key.'"'.$selected.'>'.$st_type_value.'</option>' ."\r\n";

										}	     	

									?> 

								</select>

								<div class="field-placeholder"> Statement Type <span class="text-danger">*</span></div>													
							</div>
							<!-- field wrapper end -->
						</div>

						<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">										
							<!-- field wrapper start -->
							<div class="field-wrapper">			
								
								<select class="form-control fob-select"  id="st_group" name="st_group">
																
									<option value = "0">Please select One</option> 

									<?php
											
										foreach($acc_group_arr as $st_group_key => $st_group_value){  /* loop array */

											if ($st_group == $st_group_key){
												$selected = "SELECTED";
											} else {
												$selected = "";
											}

											echo '<option value="'.$st_group_key.'"'.$selected.'>'.$st_group_value.'</option>' ."\r\n";

										}	     	

									?> 

								</select>

								<div class="field-placeholder"> Income Balance Group <span class="text-danger"></span></div>													
								<div class="form-text text-danger fs-12">
									This is for Income Balance Statement only
								</div>
							</div>
							
							<!-- field wrapper end -->
						</div>

						<div class="col-12">										
							<!-- field wrapper start -->
							<div class="field-wrapper">
								<textarea rows="4" cols="10" class="form-control" name="desc" id="desc" 
								placeholder="Bank Acc. Description"></textarea> 
								<div class="field-placeholder">Description <span class="text-danger">(Optional)</span></div>
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
							<input type="hidden" name="query" value="save" /> 
							<button type="submit" class="btn btn-primary waves-effect   
							btn-label waves-light demo-disenable" id="save-chartacc">
								<i class="mdi mdi-content-save label-icon"></i>  Save
							</button>
						</div>
					</div>	
					<!-- /row -->	 
													
				</form>
				<!-- / form -->		
				<script type='text/javascript'>  
					$('.fob-select').each(function() {  
						renderSelect($('#'+this.id)); 
					});
					hidePageLoader(); 
				</script>					
	
<?php 		
		}else{ 
		
			echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
		
		} 
		
exit;
?>