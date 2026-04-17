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
	This script load school sports
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

    	define('fobrain', 'igweze');  /* define a check for wrong access of file */

		require 'fobrain-config-s.php';  /* load fobrain configuration files */ 
		
		try { 

			$sportArray = sportsArrays($conn);  /* school sports array */
			
			$sportCount = count($sportArray);
			if($sportCount == 30){ $moreSport = ''; }
			if($sportCount < 30){ $moreSport = (30 - $sportCount); }
			
			
		}catch(PDOException $e) {
		
				fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
		} 

		require_once $fobrainIconPage; /* This include top middle global icon page eg go back, print buttons etcs */
		
?>		
	
		<!-- row -->
		<div <?php echo $fob_view; ?> class="row gutters row-section fobrain-section-div justify-content-center">
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">	
				<!-- card start -->
				<div class="card card-shadow"> 
					<?php 
						$page_title = '<i class="mdi mdi-basketball fs-18"></i> 
						Sports list';
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
										<th>Sports list</th>
										<th>Tasks</th>
									</tr>
								</thead> 
								<tbody>

<?php

							if($sportCount > $fiVal){  /* check array is empty */		
								
								for($i = $fiVal; $i <= $sportCount; $i++){  /* loop array */	
								
									$sportsTeacher = $sportArray[$i]["name"];
									$sportsID = $sportArray[$i]["id"];
									$serial_no = $foreal++;	
									$sportUpdate = 'Update-'.$sportsID;
									$sportEdit = 'Edit-'.$sportsID;
									$sportRemove = 'Remove-'.$sportsID;
									$sportEditDiv = 'editDiv-'.$sportsID;
									$sportRow = 'DivRow-'.$sportsID;
									$frmLoader= 'frmloader-'.$sportsID;
									$msgBox = 'msgBoxDiv-'.$sportsID;
								

$sport =<<<IGWEZE
        
									<tr id='$sportRow'>
										<td>$serial_no  </td> 
										<td>  
											<div id='$msgBox'></div>						  
											<div id='$sportEditDiv'>$sportsTeacher</div> 
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
														<a href='javascript:;' id='$sportUpdate' style="display: none;"
														class ='sportUpdate text-sienna  btn waves-effect btn-label waves-light'>									
															<i class="mdi mdi-content-save-cog-outline label-icon"></i> Update
														</a>	
													</p>
													<p class="mb-10">
														<a href='javascript:;' id='$sportEdit' class ='sportEdit text-slateblue btn waves-effect btn-label waves-light'>									
															<i class="mdi mdi-square-edit-outline label-icon"></i> Edit
														</a>	
													</p>
													<p>
														<a href='javascript:;' id='$sportRemove' class ='demo-disenable sportRemove text-danger btn waves-effect btn-label waves-light'>									
															<i class="mdi mdi-delete label-icon"></i> Delete
														</a>	
													</p> 
												</div>
											</div>   									
										</td> 
									</tr>
		
IGWEZE;
                               
		                  		echo $sport;

		                        }
							}



							if($sportCount != $i_false){  /* check if count is false */		
								
								for($i = $fiVal; $i <= $moreSport; $i++){  /* loop array */	 
						
									$serial_no = $foreal++;	
									$sportSave = 'Save-'.$serial_no;
									$sportEdit = 'Edit-'.$serial_no;
									$sportUpdate = 'Update-'.$serial_no;
									$sportRemove = 'Remove-'.$serial_no;
									$sportEditDiv = 'editDiv-'.$serial_no;
									$sportRow = 'DivRow-'.$serial_no;
									$frmSport= 'frmSport-'.$serial_no;
									$frmLoader= 'frmloader-'.$serial_no;
									$msgBox = 'msgBoxDiv-'.$serial_no; 

$sportMore =<<<IGWEZE
        
									<tr id='$sportRow'>
										<td>$serial_no</td> 
										<td>  							
											<div id='$msgBox'></div>								 				  
											<div id='$sportEditDiv'> 
												<input type="text" class="form-control" id="$frmSport"   name="$frmSport" /> 
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
														<a href='javascript:;' id='$sportUpdate' style="display: none;"
														class ='sportUpdate text-sienna  btn waves-effect btn-label waves-light'>									
															<i class="mdi mdi-content-save-cog-outline label-icon"></i> Update
														</a>	
													</p>
													<p class="mb-10">
														<a href='javascript:;' id='$sportSave' class ='sportSave text-sienna btn waves-effect btn-label waves-light'>									
															<i class="mdi mdi-content-save-cog-outline label-icon"></i> Save
														</a>	
													</p>
													<p class="mb-10">
														<a href='javascript:;' id='$sportEdit' style="display: none;" 
														class ='sportEdit text-slateblue btn waves-effect btn-label waves-light'>									
															<i class="mdi mdi-square-edit-outline label-icon"></i> Edit
														</a>	
													</p>
													<p>
														<a href='javascript:;' id='$sportRemove' style="display: none;"
															class ='demo-disenable sportRemove text-danger btn waves-effect btn-label waves-light'>									
															<i class="mdi mdi-delete label-icon"></i> Delete
														</a>	
													</p> 
												</div>
											</div>  
										</td>  
									</tr>
		
IGWEZE;
                               
									echo $sportMore;

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