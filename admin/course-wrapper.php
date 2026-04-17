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
?>            
 
 
<!-- row -->
<div <?php echo $fob_view; ?> class="row gutters row-section fobrain-section-div justify-content-center">
	<div class="col-12">
		<div  id="accordion" id="fob-accordion">
			<div class="accordion-item">
				<div class="accordion-header">
					<h4 class="accordion-title">
						<a class="accordion-button" role="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
							<i class="mdi mdi-database-cog me-5"></i>  <span class="hide-res"><?php echo  $levelArr[$level]['level']; ?></span> <span> Courses - 1st Term </span>
						</a>
					</h4>
				</div>
				<div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#fob-accordion"> 	
					<div class="accordion-body">


						
					<div class="table-responsive pb-80 pt-20">
                        <!-- table -->
                        <table  class='table table-hover table-responsive style-table wiz-table' width="100%" id="firstTerm">
                        <thead>
                            <tr>
                            <th>S/N</th> 
                            <th>Course Code</th> 
                            <th>Course Title</th>
							<th>Course Teacher/s</th>
                            <th>Tasks</th>
                            </tr>
                        </thead> 
                        <tbody>

						<?php
						
							if($firstTSubjectsC >= $fiVal){ /* check if retrieve data is greater or equal to 1 */	
							
								$sn_cf = $fiVal;
								
								for($i = $fiVal; $i <= $firstTSubjectsC; $i++){	/* loop to retrieve level first term subjects information */
								
									$cfID = $firstTSubjects[$i]["cf_id"];
									$cf_code = $firstTSubjects[$i]["cf_code"];
									$cf_raw = $firstTSubjects[$i]["cf_raw"];
									$cf_tittle = $firstTSubjects[$i]["cf_tittle"];
									$staff_arr = unserialize($firstTSubjects[$i]["cf_staff"]); 


									$cf_code = trim($cf_code);
									$cf_raw = trim($cf_raw);
									$cf_tittle = trim($cf_tittle);
									
									$cfUpdate = 'cfUpdate-'.$cfID;
									$cfEdit = 'cfEdit-'.$cfID;
									$cfRemove = 'cfRemove-'.$cfID.'-'.$level.'-'.$fiVal.'-'.$cf_raw.'-'.$cf_code.'-'.$cf_tittle;
									$cfCCEdit = 'editCourseCf-'.$cfID;
									$cfCTEdit = 'editCourseTf-'.$cfID;
									$cfRow = 'cfRow-'.$cfID;
									$cfLoader = 'cfLoader-'.$cfID;
									$cfmsgBox = 'cfmsgBox-'.$cfID; 

									$course_staff = courseTeacher($conn, $staff_arr);
								

$cf =<<<IGWEZE
        
									<tr id='$cfRow'>
										<td>$sn_cf</td> 
										<td><div id='$cfCCEdit'>$cf_code</div></td>  
										<td>  <div id='$cfCTEdit'>$cf_tittle</div></td> 
										<td>$course_staff</td> 
										<td>  
											<div class="btn-group">
												<a href="javascript:;" class="btna btn-tasks  waves-light dropdown-toggle p-5" data-bs-toggle="dropdown" aria-haspopup="true"
												data-bs-display="static" aria-expanded="false">
													<i class="mdi mdi-dots-grid align-middle fs-18"></i>
												</a> 
												<div class="dropdown-menu dropdown-menu-lg-end p-10 dropdown-shadow end-0 animate__animated animate__flipInY"> 
													 
													<p class="mb-10">
														<a href='javascript:;' id='$cfID' class ='demo-disenable edit-subject text-slateblue btn btn-label waves-light'>									
															<i class="mdi mdi-square-edit-outline label-icon"></i> Edit
														</a>	
													</p>
													<p>
														<a href='javascript:;' id='$cfRemove' class ='demo-disenable removeSubjInfo text-danger btn btn-label waves-light'>									
															<i class="mdi mdi-delete label-icon"></i> Delete
														</a>	
													</p> 
												</div>
											</div>   
											<div class="spinner-border text-danger pull-right display-none" id="$cfLoader"  role="status">
												<span class="visually-hidden">Loading...</span>
											</div>   
										</td>
									</tr>
		
IGWEZE;

                               
									echo $cf;
									
									$sn_cf++;

		                        }
							} 
 
						?>
												
                        </tbody>
                        </table>
                        <!-- / table -->	
                    </div> 
                    <!-- / table responsive -->		
                    <div id="fiTermLast" style="display:none;"><?php echo $sn_cf; ?></div>
                    <div id="newSubjfi"> </div>   




					</div>
				</div>
			</div>

			<div class="accordion-item">
				<div class="accordion-header">
					<h4 class="accordion-title">
						<a class="accordion-button collapsed" role="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
							<i class="mdi mdi-database-cog me-5"></i>  <span class="hide-res"><?php echo  $levelArr[$level]['level']; ?></span> Courses - 2nd Term
						</a>
					</h4>
				</div>
				<div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#fob-accordion">
					<div class="accordion-body">
						

                   <div class="table-responsive pb-80 pt-20">
                        <!-- table -->
                        <table  class='table table-hover table-responsive style-table wiz-table' width="100%"  id="secordTerm">
                        <thead>
                            <tr>
                                <th>S/N</th> 
                                <th>Course Code</th> 
								<th>Course Title</th>
								<th>Course Teacher/s</th>
								<th>Tasks</th>
                            </tr>
                        </thead> 
                        <tbody>

					<?php
						 
						if($secondTSubjectsC >= $fiVal){ /* check if retrieve data is greater or equal to 1 */		
								
							$sn_cs = $fiVal;

							for($i = $fiVal; $i <= $secondTSubjectsC; $i++){ /* loop to retrieve level second term subjects information */	

								$csID = $secondTSubjects[$i]["cf_id"];
								$cs_code = $secondTSubjects[$i]["cf_code"];
								$cs_raw = $secondTSubjects[$i]["cf_raw"];
								$cs_tittle = $secondTSubjects[$i]["cf_tittle"];
								$staff_arr = unserialize($secondTSubjects[$i]["cf_staff"]); 

								$cs_code = trim($cs_code);
								$cs_raw = trim($cs_raw);
								$cs_tittle = trim($cs_tittle);
								
								$csUpdate = 'csUpdate-'.$csID;
								$csEdit = 'csEdit-'.$csID;
								$csRemove = 'csRemove-'.$csID.'-'.$level.'-'.$seVal.'-'.$cs_raw.'-'.$cs_code.'-'.$cs_tittle;
								$csCCEdit = 'editCourseCs-'.$csID;
								$csCTEdit = 'editCourseTs-'.$csID;
								$csRow = 'csRow-'.$csID;
								$csLoader = 'csLoader-'.$csID;
								$csmsgBox = 'csmsgBox-'.$csID;
								$course_staff = courseTeacher($conn, $staff_arr);							

$cs =<<<IGWEZE
	
									<tr id='$csRow'>
										<td>$sn_cs</td> 
										<td><div id='$csCCEdit'>$cs_code</div></td>  
										<td><div id='$csCTEdit'>$cs_tittle</div></td>  
										<td>$course_staff</td> 
										<td>  
											<div class="btn-group">
												<a href="javascript:;" class="btna btn-tasks  waves-light dropdown-toggle p-5" data-bs-toggle="dropdown" aria-haspopup="true"
												data-bs-display="static" aria-expanded="false">
													<i class="mdi mdi-dots-grid align-middle fs-18"></i>
												</a> 
												<div class="dropdown-menu dropdown-menu-lg-end p-10 dropdown-shadow end-0 animate__animated animate__flipInY"> 
													 
													<p class="mb-10">
														<a href='javascript:;' id='$csID' class ='demo-disenable edit-subject text-slateblue btn btn-label waves-light'>									
															<i class="mdi mdi-square-edit-outline label-icon"></i> Edit
														</a>	
													</p>
													<p>
														<a href='javascript:;' id='$csRemove' class ='demo-disenable removeSubjInfo text-danger btn btn-label waves-light'>									
															<i class="mdi mdi-delete label-icon"></i> Delete
														</a>	
													</p> 
												</div>
											</div>   
											<div class="spinner-border text-danger pull-right display-none" id="$csLoader"  role="status">
												<span class="visually-hidden">Loading...</span>
											</div>   
										</td>
									</tr>
		
IGWEZE;

                               
									echo $cs;
																		
									$sn_cs++;

		                        }
							} 
 
						?>
											
                            </tbody>
                            </table>
                            <!-- / table --> 
                        </div> 
                        <!-- / table responsive -->
                        <div id="seTermLast" style="display:none;"><?php echo $sn_cs; ?></div>
                        <div id="newSubjse"> </div> 



					</div>
				</div>
			</div>
			 			
			<div class="accordion-item">
				<div class="accordion-header">
					<h4 class="accordion-title">
						<a class="accordion-button collapsed" role="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
							<i class="mdi mdi-database-cog me-5"></i>  <span class="hide-res"><?php echo  $levelArr[$level]['level']; ?></span>  Courses  - 3rd Term
						</a>
					</h4>
				</div>
				<div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#fob-accordion">
					<div class="accordion-body">



						<div class="table-responsive pb-80 pt-20">
                            <!-- table -->
                            <table  class='table table-hover table-responsive style-table wiz-table' width="100%" id="thirdTerm">
                            <thead>
                                <tr>
                                    <th>S/N</th> 
                                    <th>Course Code</th> 
									<th>Course Title</th>
									<th>Course Teacher/s</th>
									<th>Tasks</th>
                                </tr>
                            </thead> 
                            <tbody>

						<?php
						
						if($thirdTSubjectsC >= $fiVal){	/* check if retrieve data is greater or equal to 1 */	
						
							$sn_ct = $fiVal;
							
							for($i = $fiVal; $i <= $thirdTSubjectsC; $i++){	 /* loop to retrieve level third term subjects information */
							
								$ctID = $thirdTSubjects[$i]["cf_id"];
								$ct_code = $thirdTSubjects[$i]["cf_code"];
								$ct_raw = $thirdTSubjects[$i]["cf_raw"];
								$ct_tittle = $thirdTSubjects[$i]["cf_tittle"];
								$staff_arr = unserialize($thirdTSubjects[$i]["cf_staff"]); 

								$ct_code = trim($ct_code);
								$ct_raw = trim($ct_raw);
								$ct_tittle = trim($ct_tittle);
								
								$ctUpdate = 'ctUpdate-'.$ctID;
								$ctEdit = 'ctEdit-'.$ctID;
								$ctRemove = 'ctRemove-'.$ctID.'-'.$level.'-'.$thVal.'-'.$ct_raw.'-'.$ct_code.'-'.$ct_tittle;
								$ctCCEdit = 'editCourseCt-'.$ctID;
								$ctCTEdit = 'editCourseTt-'.$ctID;
								$ctRow = 'ctRow-'.$ctID;
								$ctLoader = 'ctLoader-'.$ctID;
								$ctmsgBox = 'ctmsgBox-'.$ctID;
								$course_staff = courseTeacher($conn, $staff_arr);
							

$ct =<<<IGWEZE
	
									<tr id='$ctRow'>
										<td>$sn_ct</td> 
										<td><div id='$ctCCEdit'>$ct_code</div></td>  
										<td> <div id='$ctCTEdit'>$ct_tittle</div></td>  
										<td>$course_staff</td> 
										<td>  
											<div class="btn-group">
												<a href="javascript:;" class="btna btn-tasks  waves-light dropdown-toggle p-5" data-bs-toggle="dropdown" aria-haspopup="true"
												data-bs-display="static" aria-expanded="false">
													<i class="mdi mdi-dots-grid align-middle fs-18"></i>
												</a> 
												<div class="dropdown-menu dropdown-menu-lg-end p-10 dropdown-shadow end-0 animate__animated animate__flipInY"> 
													 
													<p class="mb-10">
														<a href='javascript:;' id='$ctID' class ='demo-disenable edit-subject text-slateblue btn btn-label waves-light'>									
															<i class="mdi mdi-square-edit-outline label-icon"></i> Edit
														</a>	
													</p>
													<p>
														<a href='javascript:;' id='$ctRemove' class ='demo-disenable removeSubjInfo text-danger btn btn-label waves-light'>									
															<i class="mdi mdi-delete label-icon"></i> Delete
														</a>	
													</p> 
												</div>
											</div>   
											<div class="spinner-border text-danger pull-right display-none" id="$ctLoader"  role="status">
												<span class="visually-hidden">Loading...</span>
											</div>   
										</td>
									</tr>
		
IGWEZE;

                               
									echo $ct;
									
									$sn_ct++;

		                        }
							} 
 
						?>
												
							</tbody>
                        </table> 
                    </div> 
                    <!-- / table responsive --> 
                    <!-- / table -->
                    <div id="thTermLast" style="display:none;"><?php echo $sn_ct; ?></div>
                    <div id="newSubjth"> </div>		



							
					</div>
				</div>
			</div> 
			 
		</div>
	</div>
</div>	 
<script type='text/javascript'> renderTable(); </script>