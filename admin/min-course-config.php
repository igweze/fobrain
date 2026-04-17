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
	This script handle student level minimum course
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

		define('fobrain', 'igweze');  /* define a check for wrong access of file */

        require 'fobrain-config.php';  /* load fobrain configuration files */
		 
			try {		 

  				$levelArray = studentLevelsArray($conn); /* student level array */				
				$minCourseArray = levelminCourseArray($conn); /* retrieve student level minimum course array */
				
			}catch(PDOException $e) {
  			
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			 
			} 		
?>		
 		
		<!-- row -->
		<div <?php echo $fob_view; ?> class="row gutters row-section fobrain-section-div justify-content-center">
			<div class="col-xl-5 col-lg-5 col-md-6 col-sm-12 col-12">	
				<!-- card start -->
				<div class="card card-shadow">
					<div class="card-header-wiz">
						<h4>
							<i class="fas fa-users-cog fs-16"></i> 
							Minimum No. of Courses
						</h4>
					</div> 
					<div id="msg-box"></div> 					
					<div class="card-body">

						<div class="row gutters mb-10">
							<div class="hints">[<i class="mdi mdi-help-circle-outline"></i>] 
								Use <strong>All</strong> if all courses are compulsory
							</div>
						</div>	

						<!-- form -->
						<form class="form-horizontal" id="frmminCourseConfig" role="form">
							<!-- row -->
							<div class="row gutters">
							 
								<div class="col-lg-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<input type="text"  id="level_1" name="level_1" 
										value ="<?php echo $minCourseArray[1]['minCourse']; ?>"
										class="form-control" placeholder="E.g 10, 14, All" >
										<div class="field-placeholder"> <?php echo $levelArray[0]['level']; ?> <span class="text-danger">*</span></div>
									</div>
									<!-- field wrapper end -->
								</div>
								<div class="col-lg-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<input type="text"  id="level_2" name="level_2" 
										value ="<?php echo $minCourseArray[2]['minCourse']; ?>"
										class="form-control" placeholder="E.g 10, 14, All" >
										<div class="field-placeholder"> <?php echo $levelArray[1]['level']; ?> <span class="text-danger">*</span></div>
									</div>
									<!-- field wrapper end -->
								</div>
								<div class="col-lg-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<input type="text"  id="level_3" name="level_3" 
										value ="<?php echo $minCourseArray[3]['minCourse']; ?>"
										class="form-control" placeholder="E.g 10, 14, All" >
										<div class="field-placeholder"> <?php echo $levelArray[2]['level']; ?> <span class="text-danger">*</span></div>
									</div>
									<!-- field wrapper end -->
								</div>
								<input type="hidden" name="query" value="min-course-nur" />
								<?php if($schoolExt != $fobrainNurAbr){  /* check school type */  ?> 
								<div class="col-lg-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<input type="text"  id="level_4" name="level_4" 
										value ="<?php echo $minCourseArray[4]['minCourse']; ?>"
										class="form-control" placeholder="E.g 10, 14, All" >
										<div class="field-placeholder"> <?php echo $levelArray[3]['level']; ?> <span class="text-danger">*</span></div>
									</div>
									<!-- field wrapper end -->
								</div>
								<div class="col-lg-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<input type="text"  id="level_5" name="level_5" 
										value ="<?php echo $minCourseArray[5]['minCourse']; ?>"
										class="form-control" placeholder="E.g 10, 14, All" >
										<div class="field-placeholder"> <?php echo $levelArray[4]['level']; ?> <span class="text-danger">*</span></div>
									</div>
									<!-- field wrapper end -->
								</div>
								<div class="col-lg-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
										<input type="text"  id="level_6" name="level_6" 
										value ="<?php echo $minCourseArray[6]['minCourse']; ?>"
										class="form-control" placeholder="E.g 10, 14, All" >
										<div class="field-placeholder"> <?php echo $levelArray[5]['level']; ?> <span class="text-danger">*</span></div>
									</div>
									<!-- field wrapper end -->
								</div>	
								<input type="hidden" name="query" value="min-course-ps" />
								<?php } ?>	
							</div>	
							<!-- /row --> 
							 
							
							<!-- row -->
							<div class="row gutters mt-30">
								<div class="col-12 text-end">
									
									<button type="submit" class="btn btn-primary waves-effect   
									btn-label waves-light" id="minCourseConfig">
										<i class="mdi mdi-content-save label-icon"></i>  Save
									</button>
								</div>
							</div>	
							<!-- /row -->	
							
							<div class="row gutters mt-20">
								<div  class="hints">[<i class="mdi mdi-help-circle-outline"></i>] 
								The minimum number of subjects or courses a student must take at a given 
								level is important for calculating their results. If a student enrolls in 
								more subjects than the established limit, the system will still compute their
								results based on the number of courses they are taking. Conversely, if a student 
								does not meet the required minimum number of subjects, this limit will be used for 
								their result computation.
								</div>
							</div>	
						</form>
						<!-- / form -->		
					</div>
				</div>
				<!-- card end -->	
			</div>
		</div>
		<!-- / row -->	  