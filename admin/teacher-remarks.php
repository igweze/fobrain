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
	This script handle teachers remarks
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

     	define('fobrain', 'igweze');  /* define a check for wrong access of file */

		require 'fobrain-config-s.php';  /* load fobrain configuration files */ 
		
		try {
		

			$remarkArray = teacherRemarksArrays($conn);  /* teacher remarks array */ 
			
			$remarkCount = count($remarkArray);
			if($remarkCount == 30){ $moreRemark = ''; }
			if($remarkCount < 30){ $moreRemark = (30 - $remarkCount); }
			
			
		}catch(PDOException $e) {
		
				fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
		} 
		
		require_once $fobrainIconPage; /* This include top middle global icon page eg go back, print buttons etcs */
?>		

		<!-- row -->
		<div <?php echo $fob_view; ?> class="row gutters row-section fobrain-section-div justify-content-center">
			<div class="col-xl-10 col-lg-10 col-md-10 col-sm-12 col-12">	
				<!-- card start -->
				<div class="card card-shadow"> 
					<?php 
						$page_title = '<i class="mdi mdi-account-tie-voice fs-18"></i> 
						Teacher\'s Remark';
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
										<th>S/N</th> 
										<th>Teacher's Remarks</th>
										<th>Tasks</th>
									</tr>
								</thead> 
								<tbody>

<?php

							if($remarkCount > $fiVal){  /* check array is empty */		
								
								for($i = $fiVal; $i <= $remarkCount; $i++){  /* loop array */	
								
									$remarksTeacher = $remarkArray[$i]["name"];
									$remarksID = $remarkArray[$i]["id"];
									$serial_no = $foreal++;	
									$remarkUpdate = 'Update-'.$remarksID;
									$remarkEdit = 'Edit-'.$remarksID;
									$remarkRemove = 'Remove-'.$remarksID;
									$remarkEditDiv = 'editDiv-'.$remarksID;
									$remarkRow = 'DivRow-'.$remarksID;
									$frmLoader= 'frmloader-'.$remarksID;
									$msgBox = 'msgBoxDiv-'.$remarksID;
								

$remark =<<<IGWEZE
        
									<tr id='$remarkRow'>
										<td>$serial_no  </td> 
										<td>  
											<div id='$msgBox'></div>						  
											<div id='$remarkEditDiv'>$remarksTeacher</div> 
										</td>
									
										<td> 
											<div class="text-center pull-left" id="$frmLoader" style="display: none;">
												<div class="spinner-border text-danger" role="status">
													<span class="visually-hidden">Loading...</span>
												</div>
											</div>
											<div class="btn-group">
												<a href="javascript:;" class="btna btn-tasks  waves-effect waves-light dropdown-toggle p-5" data-bs-toggle="dropdown" aria-haspopup="true"
												data-bs-display="static" aria-expanded="false">
													<i class="mdi mdi-dots-grid align-middle fs-18"></i>
												</a> 
												<div class="dropdown-menu dropdown-menu-lg-end p-10 dropdown-shadow end-0 animate__animated animate__flipInY"> 
													<p class="mb-10">
														<a href='javascript:;' id='$remarkUpdate' style="display: none;"
														class ='remarkUpdate text-sienna  btn waves-effect btn-label waves-light'>									
															<i class="mdi mdi-content-save-cog-outline label-icon"></i> Update
														</a>	
													</p>
													<p class="mb-10">
														<a href='javascript:;' id='$remarkEdit' class ='remarkEdit text-slateblue btn waves-effect btn-label waves-light'>									
															<i class="mdi mdi-square-edit-outline label-icon"></i> Edit
														</a>	
													</p>
													<p>
														<a href='javascript:;' id='$remarkRemove' class ='demo-disenable remarkRemove text-danger btn waves-effect btn-label waves-light'>									
															<i class="mdi mdi-delete label-icon"></i> Delete
														</a>	
													</p> 
												</div>
											</div>   									
										</td> 
									</tr>
		
IGWEZE;
                               
		                  		echo $remark;

		                        }
							}



							if($remarkCount != $i_false){  /* check if count is false */		
								
								for($i = $fiVal; $i <= $moreRemark; $i++){  /* loop array */	 
						
									$serial_no = $foreal++;	
									$remarkSave = 'Save-'.$serial_no;
									$remarkEdit = 'Edit-'.$serial_no;
									$remarkUpdate = 'Update-'.$serial_no;
									$remarkRemove = 'Remove-'.$serial_no;
									$remarkEditDiv = 'editDiv-'.$serial_no;
									$remarkRow = 'DivRow-'.$serial_no;
									$frmRemark= 'frmRemark-'.$serial_no;
									$frmLoader= 'frmloader-'.$serial_no;
									$msgBox = 'msgBoxDiv-'.$serial_no; 

$remarkMore =<<<IGWEZE
        
									<tr id='$remarkRow'>
										<td>$serial_no</td> 
										<td>  								
											<div id='$msgBox'></div>								 				  
											<div id='$remarkEditDiv'> 
												<input type="text" class="form-control" id="$frmRemark"   name="$frmRemark" /> 
											</div> 
									 	 </td>
										<td> 
											<div class="text-center pull-left" id="$frmLoader" style="display: none;">
												<div class="spinner-border text-danger" role="status">
													<span class="visually-hidden">Loading...</span>
												</div>
											</div>
											<div class="btn-group">
												<a href="javascript:;" class="btna btn-tasks  waves-effect waves-light dropdown-toggle p-5" data-bs-toggle="dropdown" aria-haspopup="true"
												data-bs-display="static" aria-expanded="false">
													<i class="mdi mdi-dots-grid align-middle fs-18"></i>
												</a> 
												<div class="dropdown-menu dropdown-menu-lg-end p-10 dropdown-shadow end-0 animate__animated animate__flipInY"> 
													<p class="mb-10">
														<a href='javascript:;' id='$remarkUpdate' style="display: none;"
														class ='remarkUpdate text-sienna  btn waves-effect btn-label waves-light'>									
															<i class="mdi mdi-content-save-cog-outline label-icon"></i> Update
														</a>	
													</p>
													<p class="mb-10">
														<a href='javascript:;' id='$remarkSave' class ='remarkSave text-sienna btn waves-effect btn-label waves-light'>									
															<i class="mdi mdi-content-save-cog-outline label-icon"></i> Save
														</a>	
													</p>
													<p class="mb-10">
														<a href='javascript:;' id='$remarkEdit' style="display: none;" 
														class ='remarkEdit text-slateblue btn waves-effect btn-label waves-light'>									
															<i class="mdi mdi-square-edit-outline label-icon"></i> Edit
														</a>	
													</p>
													<p>
														<a href='javascript:;' id='$remarkRemove' style="display: none;"
															class ='demo-disenable remarkRemove text-danger btn waves-effect btn-label waves-light'>									
															<i class="mdi mdi-delete label-icon"></i> Delete
														</a>	
													</p> 
												</div>
											</div>  
										</td>  
									</tr>
		
IGWEZE;
                               
									echo $remarkMore;

		                        }
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
		</div>
		<!-- / row -->	  
 