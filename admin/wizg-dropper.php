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
	This script handle all dropdown auto field
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

		define('fobrain', 'igweze');  /* define a check for wrong access of file */ 
	
		require 'fobrain-config.php';  /* load fobrain configuration files */	   

		if($_GET['func'] == "trans-search" && isset($_GET['func'])) {  /* load student selected level */	 

			$regNum = $_GET['regNo']; 
		
			try {		 
				
				if (studentExitsRV($conn, $regNum) == $foreal) {  /* check if a student really exist */
				
					echo '
					<!-- row -->
					<div class="row gutters">
						<div class="col-lg-12">										
							<!-- field wrapper start -->
							<div class="field-wrapper">	
								
								<select class="form-control"  id="levelSE" name="level" required>
								
								<option value = "">Search . . .</option>';
						
	
								try {
								
									studentLevel($conn);  /* retrieve student level */
							
								}catch(PDOException $e) {

									fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
		
								} 
				
								

					
					echo '		</select>
								<div class="field-placeholder"> Student Level <span class="text-danger">*</span></div>
							</div>
							<!-- field wrapper end -->
						</div>									 
					</div>	
					<!-- /row -->';

					echo'
					<!-- row -->
					<div class="row gutters">
						<div class="col-lg-12">										
							<!-- field wrapper start -->
							<div class="field-wrapper">									  
									<select class="form-control"  id="term" name="term" required>										
									<option value = "">Search . . .</option>';

										try {
										
											$curTerm = currentSessionTerm($conn); /* current school term  */
									
										}catch(PDOException $e) {

											fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
				
										}  

										foreach($term_list as $term_key => $term_value){  /* loop array */

											if ($curTerm == $term_key){
												$selected = "SELECTED";
											} else {
												$selected = "";
											}

											echo '<option value="'.$term_key.'"'.$selected.'>'.$term_value.'</option>' ."\r\n";

										} 

										echo '<option value = "all">Annual Result</option>';

					echo' 
									</select>
								<div class="field-placeholder"> Student Term <span class="text-danger">*</span></div>
							</div>
							<!-- field wrapper end -->
						</div>									 
					</div>	
					<!-- /row -->';

					echo '
					
					<!-- row -->
					<div class="row gutters mt-30">
						<div class="col-12 text-end">
							<input type="hidden" value="transcript" name = "search"/>
							<button type="submit" class="btn btn-primary waves-effect   
							btn-label waves-light" id="student-transcript">
								<i class="mdi mdi-account-search label-icon"></i>  Search
							</button>
						</div>
					</div>	
					<!-- /row -->';

					echo '<script type="text/javascript">	  
						renderSelect("#levelSE");
						renderSelect("#term"); 
					</script>';

				}else{  /* display error */ 						
				
					$msg_i = "Ooops, this Reg No. $regNum does not Exists";
					echo $errorMsg.$msg_i.$eEnd; exit; 	
				
				}
		
			}catch(PDOException $e) {

				echo $e->GETMessage();

			}
					
		}


		if($_GET['func'] == "check-reg-no" && isset($_GET['func'])) {  /* load new student registration number */	 

			$sessData = $_GET['RegNum'];	
					
			list ($session, $level) = explode ("#@@#", $sessData);
		
			try {			
																
				if($session != ''){
						
					$lastSessReg = sessionLastReg($conn, $session);  /* school session last student registration number  */
					
					$regC = explode("/", $lastSessReg);
					
					$regCount = count($regC);
					
					if($regCount == $thVal){
						
						list ($schSplit, $regSplit, $sup) = explode ("/", $lastSessReg);
						
					}elseif($regCount == $seVal){
						
						list ($regSplit, $sup) = explode ("/", $lastSessReg);
						
					}else{
						
						list ($regSplit) = explode ("/", $lastSessReg);

					}	
											
					/* generate new  student registration number  */						
						
					if($regSplit == ''){
											
						$newReg = $session.'001';
												
					}else{
											
						$newReg = ($regSplit + $fiVal);
								
					}			 
					
					if($regCount == $thVal){
						
						$newReg =  $schSplit.'/'.$newReg.$supRegNo; /* generate new  student registration number  */	
						
					}elseif($regCount == $seVal){
						
						$newReg =  $newReg.$supRegNo; /* generate new  student registration number  */	
						
					}else{
						
						$newReg =  $newReg.$supRegNo; /* generate new  student registration number  */	

					}
							
					echo '<div class="row"> 
					<div class="col-lg-4">										
					<!-- field wrapper start -->
					<div class="field-wrapper"> 
						<input type="text" class="form-control"  
						value ="'.$newReg.'"  maxlength="8"
						name="regnum" id="regnum" disabled required />
								<div class="field-placeholder"> New Reg. No. <span class="text-danger">*</span></div>
							</div>
							<!-- field wrapper end -->
						</div>';

					$sessionInfoSec = currentSessionInfo($conn);  /* current school session information  */

					list ($fiSessionID, $fiSession) = explode ("@$@", $sessionInfoSec);

					$seSessionID =  ($fiSessionID - $fiVal);

					$thSessionID =  ($fiSessionID - $seVal);

					$foSessionID =  ($fiSessionID - $thVal);

					$fifSessionID =  ($fiSessionID - $foVal);

					$sixSessionID =  ($fiSessionID - $fifVal);	

					$clArray = studentClassArray($conn, $level);  /* retrieve student class array */

					$classArray = unserialize($clArray);

					$classArray_l = ((count($classArray)) - 1);

					for($i = $i_false; $i <= $classArray_l; $i++){  /* loop array */

						$classList[] = $class_list[$i];

					}

					$classArrayList = array_combine($classList, $classArray);  /* combine arrays */	

					echo ' 
					<div class="col-lg-4">										
					<!-- field wrapper start -->
					<div class="field-wrapper"> 

					<select class="form-control"  id="class" name="class" required>

					<option value = "">Search . . .</option>'; 

						foreach($classArrayList as $classKey => $classVal){  /* loop array */
											

							if($level == $fiVal){

								$classCount = studentClassCount($conn, $fiSessionID, $classKey, $level);  /* count 100 level class */
								$classCount = 'Total Student/s - '.$classCount;

							}elseif($level == $seVal){
								
								$classCount = studentClassCount($conn, $seSessionID, $classKey, $level);  /* count 200 level class */
								$classCount = 'Total Student/s - '.$classCount;
								
							}elseif($level == $thVal){
								
								$classCount = studentClassCount($conn, $thSessionID, $classKey, $level);  /* count 300 level class */
								$classCount = 'Total Student/s - '.$classCount;
								
							}elseif($level == $foVal){
								
								$classCount = studentClassCount($conn, $foSessionID, $classKey, $level);  /* count 400 level class */
								$classCount = 'Total Student/s - '.$classCount;
								
							}elseif($level == $fifVal){
								
								$classCount = studentClassCount($conn, $fifSessionID, $classKey, $level);  /* count 500 level class */
								$classCount = 'Total Student/s - '.$classCount;
								
							}elseif($level == $sixVal){
								
								$classCount = studentClassCount($conn, $sixSessionID, $classKey, $level);  /* count 600 level class */
								$classCount = 'Total Student/s - '.$classCount;
								
							}else{
								
								$classCount = 0;
								
							}

							echo '<option value="'.$classKey.'">'.$classVal.' -  '.$classCount.' </option>' ."\r\n";
	
						}


					echo '</select>
					<div class="field-placeholder"> Student Class <span class="text-danger">*</span></div>
					</div>
					<!-- field wrapper end -->
					</div>';

					echo ' 
					<div class="col-lg-4">										
					<!-- field wrapper start -->
					<div class="field-wrapper"> 
						<select class="form-control"  id="term" name="term" required>
						<option value = "">Search . . .</option>';

							try {

									$curTerm = currentSessionTerm($conn);  /* current school term  */

							}catch(PDOException $e) {

							fobrainDie( 'Ooops Database Error: ' . $e->getMessage());

							} 


							foreach($term_list as $term_key => $term_value){  /* loop array */

								if ($curTerm == $term_key){
									$selected = "SELECTED";
								} else {
									$selected = "";
								}

								echo '<option value="'.$term_key.'"'.$selected.'>'.$term_value.'</option>' ."\r\n";
							} 

						echo' </select>
								<div class="field-placeholder"> School Term <span class="text-danger">*</span></div>
							</div>
							<!-- field wrapper end -->
						</div>';

					echo '  
					<div class="col-12 text-end mt-30">
						<input type="hidden" value="newStuBioData" name = "newBioData"/>
						<input type="hidden" value ="'.$newReg.'" name = "newRegNum"/>
						<button type="submit" class="btn btn-primary waves-effect   
						btn-label waves-light" id="newStudent">
							<i class="mdi mdi-content-save label-icon"></i>  Create
						</button>
					</div>
					
					</div>'; 	
					echo '<script type="text/javascript">	  
						renderSelect("#class");
						renderSelect("#term"); 
					</script>';
									

				}else{  /* display error */  		
								
					$msg_i = "Ooops, Please select a valid student session.";
					echo $errorMsg.$msg_i.$eEnd; exit; 		 
								
				} 
					
			}catch(PDOException $e) {
		
				echo $e->GETMessage();
			
			}
					
		}



		if($_GET['func'] == "studentLevel" && isset($_GET['func'])) {  /* load student level */	  

			$level = $_GET['level'];
			
			$clArray = studentClassArray($conn, $level);  /* retrieve student class array */
			
			$classArray = unserialize($clArray);

			$classArray_l = ((count($classArray)) - 1);
			
			for($i = $i_false; $i <= $classArray_l; $i++){  /* loop array */
			
				$classList[] = $class_list[$i];
			
			}
			
			$classArrayList = array_combine($classList, $classArray);  /* combine arrays */ 
			
			echo '<div class="col-lg-6">										
					<!-- field wrapper start -->
					<div class="field-wrapper">

					<select class="form-control"  id="class" name="class" required>

					<option value = "">Search . . .</option>'; 

						foreach($classArrayList as $classKey => $classVal){  /* loop array */ 

							echo '<option value="'.$classKey.'">'.$classVal.'</option>' ."\r\n"; 

						} 
						
					echo '</select>
						<div class="field-placeholder"> Select Class <span class="text-danger">*</span></div>
					</div>
					<!-- field wrapper end -->
				</div>'; 

				echo '<script type="text/javascript">	  
						renderSelect("#class"); 
					</script>';

		}
	
		if($_GET['func'] == "studentLevelCM" && isset($_GET['func'])) {  /* load student level all */	  

			$level = $_GET['level']; /* new */
			
			$clArray = studentClassArray($conn, $level);  /* retrieve student class array */
			
			$classArray = unserialize($clArray);

			$classArray_l = ((count($classArray)) - 1);
			
			for($i = $i_false; $i <= $classArray_l; $i++){  /* loop array */
			
				$classList[] = $class_list[$i];
			
			}
			
			$classArrayList = array_combine($classList, $classArray);  /* combine arrays */	 


			echo '<!-- row -->
						<div class="row gutters">
							<div class="col-12">										
								<!-- field wrapper start -->
								<div class="field-wrapper">			

				<select class="form-control"  id="class" name="class" required>

				<option value = "">Search . . .</option>'; 

					foreach($classArrayList as $classKey => $classVal){  /* loop array */

						echo '<option value="'.$classKey.'">'.$classVal.'</option>' ."\r\n"; 

					}

				echo '<option value="all"> All Class</option>' ."\r\n";

				echo '</select>
							<div class="field-placeholder"> Class <span class="text-danger">*</span></div>
						</div>
						<!-- field wrapper end -->
					</div>																 
				</div>	
				<!-- /row -->'; 

				echo '<script type="text/javascript">	  
						renderSelect("#class"); 
					</script>';
	
		}
	
		if($_GET['func'] == "sLevel" && isset($_GET['func'])) {  /* load student level */	   

		
			$classInfo = $_GET['level'];
			$classAll = $_GET['classAll'];
			
			if($classInfo == ""){exit;}
			
			list($session, $level, $level_val) = explode("#@@#", $classInfo);
			
			if($level == ""){exit;}
			
			$clArray = studentClassArray($conn, $level);  /* retrieve student class array */ 
			
			$classArray = unserialize($clArray); 

			$classArray_l = ((count($classArray)) - 1);
			
			for($i = $i_false; $i <= $classArray_l; $i++){  /* loop array */
			
				$classList[] = $class_list[$i];
			
			}
			
			$classArrayList = array_combine($classList, $classArray);  /* combine arrays */  

			echo '	<!-- field wrapper start -->
					<div class="field-wrapper">

						<select class="form-control class"  id="studentClass" name="class" required>

						<option value = "">Search . . .</option>'; 

							foreach($classArrayList as $classKey => $classVal){ 

								echo '<option value="'.$classKey.'@+@'.$classVal.'">'.$classVal.'</option>' ."\r\n";


							}  
							
							if($classAll == $fiVal){ echo '<option value="all"> All Class</option>' ."\r\n";} 
							
						echo '	</select><input type="hidden" name="sess"  id="session_s" value="'.$session.'"/>
								<input type="hidden" name="level" id="level_s" value="'.$level.'"/>	
					<div class="field-placeholder"> Select Class <span class="text-danger">*</span></div>
				</div>
				<!-- field wrapper end --> 
				'; 
				 
				echo '<script type="text/javascript">	  
						renderSelect("#studentClass"); 
					</script>';
	
		} 
		
		if($_GET['func'] == "subjLevel" && isset($_GET['func'])) {  /* load school level and subject  */ 
			
			$classInfo = $_GET['level'];
			$classAll = $_GET['classAll'];
			$term = $_GET['subjTerm'];	
			$euData = $_GET['euData'];	

			if(($classInfo == "") || ($term == "")){exit;}	
			list($uClass, $uTitle, $uSubject) = explode(":<$?$>:", $euData);
			
			if ($admin_grade == $cm_fobrain_grd) {  /* if user is school staff/teacher */ 
				
				list($session, $level) = explode("::-::", $classInfo);
			
				$sessionID = sessionID($conn, $session);  /* school session ID */

				$teacherClass = formTeacherClass($conn, $adminID, $sessionID, $level);  /* assign class teacher class  array */ 

				$clArray = studentClassArray($conn, $level);  /* retrieve student class array */

				$classArray = unserialize($clArray);

				$classArray_l = ((count($classArray)) - 1);

				for($i = $i_false; $i <= $classArray_l; $i++){  /* loop array */

					$classList[] = $class_list[$i];

				}

				$classArrayList = array_combine($classList, $classArray);  /* combine arrays */	

				echo '
				<!- - row -- >
				<div class="row ">
				<div class="col-lg-4">										
					<!-- field wrapper start -->
					<div class="field-wrapper">	
					<select class="form-control"  id="class" name="class" required>

					<option value = "">Search . . .</option>'; 

					if (in_array('all', $teacherClass)) {  /* check if teacher was assign to all class */

						foreach($classArrayList as $classKey => $classVal){  /* loop array */ 

							$classKey = trim($classKey);

							if($classKey == $uClass){
								
								$selected = "SELECTED";
								
							}else{

								$selected = "";

							}	 

							echo '<option value="'.$classKey.'"'.$selected.'">'.$classVal.'</option>' ."\r\n"; 
										
						}

						if($uClass == "all"){
							
							$selected = "SELECTED";
							
						}else{

							$selected = "";
						}	

						echo '<option value="all"'.$selected.'> All Class</option>' ."\r\n";



					}else{  /* if not assign to all class */

						foreach($classArrayList as $classKey => $classVal){  /* loop array */

							if (in_array($classKey, $teacherClass)) {   /* load only class assign to this teacher */

								$classKey = trim($classKey);

								if($classKey == $uClass){
									
									$selected = "SELECTED";
									
								}else{

									$selected = "";

								}	 

								echo '<option value="'.$classKey.'"'.$selected.'">'.$classVal.'</option>' ."\r\n"; 

							}

						}

					}

				echo '		</select><input type="hidden" name="sess" value="'.$session.'"/>
							<input type="hidden" name="level" value="'.$level.'"/>	
						<div class="field-placeholder">  Class <span class="text-danger">*</span></div>
					</div>
					<!-- field wrapper end -->
				</div>';

	
			}else{  /* if user is admin */  
					
					
					list($session, $level) = explode("#@@#", $classInfo); 
					
					
					if($level == ""){exit;}
					
					$clArray = studentClassArray($conn, $level);  /* retrieve student class array */
					
					$classArray = unserialize($clArray);

					$classArray_l = ((count($classArray)) - 1);
					
					for($i = $i_false; $i <= $classArray_l; $i++){  /* loop array */
					
						$classList[] = $class_list[$i];
					
					}
					
					$classArrayList = array_combine($classList, $classArray);  /* combine arrays */	  

					echo '
					<!- - row -- >
					<div class="row ">
						<div class="col-lg-4">										
						<!-- field wrapper start -->
						<div class="field-wrapper">	

						<select class="form-control"  id="class" name="class" required>

						<option value = "">Search . . .</option>'; 

						foreach($classArrayList as $classKey => $classVal){  /* loop array */

							$classKey = trim($classKey);
							
							if($classKey == $uClass){

								$selected = "SELECTED";

							}else{

								$selected = "";
							}	

							echo '<option value="'.$classKey.'"'.$selected.'>'.$classVal.'</option>' ."\r\n"; 

						}


						if($uClass == "all"){

							$selected = "SELECTED";

						}else{

							$selected = "";
							
						}	
						
						if($classAll == $fiVal){ echo '<option value="all"'.$selected.'> All Class</option>' ."\r\n";}


						echo '</select><input type="hidden" name="sess" value="'.$session.'"/>
							<input type="hidden" name="level" value="'.$level.'"/>	
						<div class="field-placeholder">   Class <span class="text-danger">*</span></div>
					</div>
					<!-- field wrapper end -->
				</div>';

			}							
								
			echo '
				<div class="col-lg-8">										
					<!-- field wrapper start -->
					<div class="field-wrapper">	
							<input type="text"  id="eTitle" name="eTitle" 
							class="form-control" placeholder="Enter  Title" value="'.$uTitle.'">
						<div class="field-placeholder">  Title <span class="text-danger">*</span></div>
					</div>
					<!-- field wrapper end -->
				</div>
			</div>';

			echo '
			<div class="col-lg-12">										
				<!-- field wrapper start -->
				<div class="field-wrapper">	
				<select class="form-control wiz-select"  id="eSubject" name="eSubject" required>
					<option value = "">Search . . .</option>'; 

						try {

							$subjectArr = schoolCoursesInfo($conn, $schoolID, $level, $term);  /* school subjects information */			
							$subjectArrC = count($subjectArr);  

						}catch(PDOException $e) {

							fobrainDie( 'Ooops Database Error: ' . $e->getMessage());

						}

						if($subjectArrC >= $fiVal){  /* check array is empty */		

							$uSubject =  clean($uSubject);
							//$uSubject = trim($uSubject);

							$show_course = false;
							$st_course_count = 0;

							for($i = $fiVal; $i <= $subjectArrC; $i++){  /* loop array */	

								$cfID = $subjectArr[$i]["cf_id"];
								$cf_code = $subjectArr[$i]["cf_code"];
								$cf_raw = $subjectArr[$i]["cf_raw"];
								$cf_tittle = $subjectArr[$i]["cf_tittle"];
								$staff_course = unserialize($subjectArr[$i]["cf_staff"]);

								$cf_tittle = trim($cf_tittle);

								if($cf_tittle == $uSubject){

									$selected = "SELECTED";

								}else{

									$selected = "";
									
								}	

								if (($admin_grade == $cm_fobrain_grd) || ($admin_grade == $staff_fobrain_grd)) {

									if(is_array($staff_course)){  /* check if array */  

										$staff_course = array_unique($staff_course);
										
										if (in_array($_SESSION['adminID'], $staff_course)) {  /* check staff */ 
										 
											$show_course = true;
											 
										}
					
									}else{ $show_course = false; }	

									if($show_course == true){ 

										$st_course_count++; 															
	
										echo '<option value="'.$cf_tittle.'"'.$selected.'>'.$cf_tittle.'</option>' ."\r\n";

									}	

								}else{  

									echo '<option value="'.$cf_tittle.'"'.$selected.'>'.$cf_tittle.'</option>' ."\r\n";

								}


							}

						}	 

				echo '	</select>

					<div class="field-placeholder"> Select Subject <span class="text-danger">*</span></div>
				</div>
				<!-- field wrapper end -->
			</div> 
			';	 

			 
			echo '<script type="text/javascript">	  
					renderSelect("#class");
					renderSelect("#eSubject"); 
				</script>';
		
		} 


		if($_GET['func'] == "meetLevel" && isset($_GET['func'])) {  /* load school level and subject  */  
			
			$classInfo = $_GET['level'];
			$classAll = $_GET['classAll'];
			$term = $_GET['eType'];	
			$uClass = $_GET['euData'];	

			if(($classInfo == "") || ($term == "")){exit;}	 
				
			list($session, $level) = explode("#@@#", $classInfo);  
			
			if($level == ""){exit;}
			
			$clArray = studentClassArray($conn, $level);  /* retrieve student class array */
			
			$classArray = unserialize($clArray);

			$classArray_l = ((count($classArray)) - 1);
			
			for($i = $i_false; $i <= $classArray_l; $i++){  /* loop array */
			
				$classList[] = $class_list[$i];
			
			}
			
			$classArrayList = array_combine($classList, $classArray);  /* combine arrays */	  

			$levelArr = studentLevelsArray($conn); /* retrive this school level data */
			array_unshift($levelArr,"");
			unset($levelArr[0]);

			$level_val = $levelArr[$level]['level']; 
			 
			$sess_data = trim($session.'#@@#'.$level.'#@@#'.$level_val);

			echo '
				<!- - row -- >
				<div class="row ">
					<div class="col-lg-12">										
					<!-- field wrapper start -->
					<div class="field-wrapper">	

					<select class="form-control"  id="class" name="class" required>

					<option value = "">Search . . .</option>'; 

					foreach($classArrayList as $classKey => $classVal){  /* loop array */

						$classKey = trim($classKey);
						
						if($classKey == $uClass){

							$selected = "SELECTED";

						}else{

							$selected = "";
						}	

						echo '<option value="'.$classKey.'@+@'.$classVal.'"'.$selected.'>'.$classVal.'</option>' ."\r\n"; 

					}


					if($uClass == "all"){

						$selected = "SELECTED";

					}else{

						$selected = "";
						
					}	
					
					if($classAll == $fiVal){ echo '<option value="all"'.$selected.'> All Class</option>' ."\r\n";}

					echo '</select><input type="hidden" name="sess" value="'.$session.'"/> 
						<input type="hidden" name="level" value="'.$level.'"/>	
						<input type="hidden" name="sesslevel" value="'.$sess_data.'"/>
					<div class="field-placeholder">   Class <span class="text-danger">*</span></div>
				</div>
				<!-- field wrapper end -->
			</div>'; 
			 
			echo '<script type="text/javascript">	  
					renderSelect("#class"); 
				</script>';
		
		}
	
		if($_GET['func'] == "subjDropTerm" && isset($_GET['subjTerm'])) {  /* load subject exam div */	  
			
			$term = $_GET['term']; 
			
			if($term >= $fiVal){
				
				echo "<script type='text/javascript'> $('#subjectExamDiv').show(); </script>";  				
				
			}else{
				
				echo "<script type='text/javascript'> $('#subjectExamDiv').hide(); </script>";  
				
			}	 
	
		}


		if($_GET['func'] == "meetDrop" && isset($_GET['eType'])) {  /* load meeting div */	  
			
			$eType = $_GET['eType']; 
			
			if($eType >= $fiVal){ 
				
				if($eType == $seVal){

					$show_level = "$('#show_class_meet').show();";

				}else{

					$show_level = "$('#show_class_meet').hide();";

				}	

				echo "<script type='text/javascript'> $('#par-meet-div').show(); $show_level </script>";
				
			}else{
				
				echo "<script type='text/javascript'> $('#par-meet-div, #show_class_meet').hide(); </script>";  
				
			}	 
	
		}

		if($_GET['func'] == "allowDrop" && isset($_GET['allow'])) {  /* load meeting div */	  
			
			$allow = $_GET['allow']; 
			
			if($allow == $fiVal){  

				echo "<script type='text/javascript'> $('#show_staff_div').show(); </script>"; 
				
			}else{
				
				echo "<script type='text/javascript'> $('#show_staff_div').hide(); </script>";  
				
			}	 
	
		}

		if($_GET['func'] == "meetDrop" && isset($_GET['meetType'])) {  /* load meeting div */	  
			
			$meet_t = $_GET['meetType']; 
			
			if($meet_t == $seVal){  

				echo "<script type='text/javascript'> $('#show_staff_div').show(); </script>"; 
				
			}else{
				
				echo "<script type='text/javascript'> $('#show_staff_div').hide(); </script>";  
				
			}	 
	
		}
	
		if($_GET['func'] == "fteachSession" && isset($_GET['func'])) {  /* load form teacher level */		

			$session = $_GET['session'];
			$sessionID = sessionID($conn, $session);  /* school session ID */
			
			echo '
			<!-- row -->
			<div class="row gutters">
				<div class="col-lg-12">										
					<!-- field wrapper start -->
					<div class="field-wrapper select-wrapper">
						<select class="form-control"  id="ftlevel" name="level" required>
						<option value = "">Search . . .</option>';

							try { 

								$teacherLevel = formTeacherLevel($conn, $adminID, $sessionID);  /* assign class teacher session array */ 
								$levelArray = studentLevelsArray($conn);  /* retrieve student class array */
								array_unshift($levelArray,"");
								unset($levelArray[0]);
													
								foreach($teacherLevel as $tLevelKey => $tLevelVal){  /* loop array */

									$tLevelMKey = $tLevelVal['level'];
									$studentLevel = $levelArray[$tLevelMKey]['level'];
									echo '<option value="'.$tLevelMKey.'">'.$studentLevel.'</option>' ."\r\n";

								} 

							}catch(PDOException $e) {

							fobrainDie( 'Ooops Database Error: ' . $e->getMessage());

							} 

						echo ' </select>
						<div class="icon-wrap"  id="wait_11" style="display: none;">
							<i class="loader"></i>
						</div>
						<div class="field-placeholder"> Class <span class="text-danger">*</span></div>
					</div>
					<!-- field wrapper end -->
				</div>																 
			</div>	
			<!-- /row -->'; 

			echo '<span id="result_11" style="display: none;"></span>'; 

			echo '<script type="text/javascript">	  
						renderSelect("#ftlevel"); 
					</script>';
		
		}

		if($_GET['func'] == "fteachLevel" && isset($_GET['func'])) {   /* load form teacher level */

			$level = $_GET['level'];
			$session = $_GET['session'];   /* new */
			
			if($level == ""){exit;}
			
			$sessionID = sessionID($conn, $session);  /* school session ID */
			
			$teacherClass = formTeacherClass($conn, $adminID, $sessionID, $level);  /* assign class teacher session array */ 
								
			$clArray = studentClassArray($conn, $level);  /* retrieve student class array */
			
			$classArray = unserialize($clArray);

			$classArray_l = ((count($classArray)) - 1);
			
			for($i = $i_false; $i <= $classArray_l; $i++){  /* loop array */
			
				$classList[] = $class_list[$i];
			
			}
			
			$classArrayList = array_combine($classList, $classArray);  /* combine arrays */	  

			echo '
			<!-- row -->
			<div class="row gutters">
				<div class="col-lg-12">										
					<!-- field wrapper start -->
					<div class="field-wrapper">	  

						<select class="form-control"  id="class" name="class" required>

						<option value = "">Please select One </option>'; 

							if (in_array('all', $teacherClass)) {  /* check if teacher was assign to all class */

								foreach($classArrayList as $classKey => $classVal){  /* loop array */

									echo '<option value="'.$classKey.'">'.$classVal.'</option>' ."\r\n"; 
													
								}

							}else{   /* load only class assign to this teacher */

								foreach($classArrayList as $classKey => $classVal){  /* loop array */

									if (in_array($classKey, $teacherClass)) {   /* load only class assign to this teacher */

										echo '<option value="'.$classKey.'">'.$classVal.'</option>' ."\r\n"; 

									}

								}

							}
							
							
						echo '</select>
						<div class="field-placeholder"> Class <span class="text-danger">*</span></div>
						<input type="hidden" name="sesslevel" value="'.$sess_data.'"/>
					</div>
					<!-- field wrapper end -->
				</div>																 
			</div>	
			<!-- /row -->'; 
			echo '<script type="text/javascript">	  
						renderSelect("#class"); 
					</script>';
		
		}
	
		if($_GET['func'] == "sessionLev" && isset($_GET['func'])) {   /* load form teacher level */ 

			$classInfo = $_GET['level'];  /* new */
			
			if($classInfo == ""){exit;}
			
			list($session, $level) = explode("::-::", $classInfo);
			
			$sessionID = sessionID($conn, $session);  /* school session ID */
			
			$teacherClass = formTeacherClass($conn, $adminID, $sessionID, $level);  /* assign class teacher session array */ 
								
			$clArray = studentClassArray($conn, $level);  /* retrieve student class array */
			
			$classArray = unserialize($clArray);

			$classArray_l = ((count($classArray)) - 1);
			
			for($i = $i_false; $i <= $classArray_l; $i++){  /* loop array */
			
				$classList[] = $class_list[$i];
			
			}
			
			$classArrayList = array_combine($classList, $classArray);  /* combine arrays */	  

			$levelArr = studentLevelsArray($conn); /* retrive this school level data */
			array_unshift($levelArr,"");
			unset($levelArr[0]);

			$level_val = $levelArr[$level]['level']; 
			 
			$sess_data = trim($session.'#@@#'.$level.'#@@#'.$level_val);

			echo '
			<!-- row -->
			<div class="row gutters">
				<div class="col-lg-12">										
					<!-- field wrapper start -->
					<div class="field-wrapper">	 
						<select class="form-control"  id="class" name="class" required>

						<option value = "">Please select One </option>'; 


						if (in_array('all', $teacherClass)) {  /* check if teacher was assign to all class */

							foreach($classArrayList as $classKey => $classVal){  /* loop array */ 

								echo '<option value="'.$classKey.'@+@'.$classVal.'">'.$classVal.'</option>' ."\r\n"; 
													
							}

						}else{

							foreach($classArrayList as $classKey => $classVal){   /* load only class assign to this teacher */

								if (in_array($classKey, $teacherClass)) {   /* load only class assign to this teacher */ 

									echo '<option value="'.$classKey.'@+@'.$classVal.'">'.$classVal.'</option>' ."\r\n"; 

								}

							}

						}

				echo '	</select><input type="hidden" name="sess" value="'.$session.'"/>
						<input type="hidden" name="level" value="'.$level.'"/>	
						<input type="hidden" name="sesslevel" value="'.$sess_data.'"/>
						<div class="field-placeholder"> Class <span class="text-danger">*</span></div>
					</div>
					<!-- field wrapper end -->
				</div>																 
			</div>	
			<!-- /row -->';  
			echo '<script type="text/javascript">	  
						renderSelect("#class"); 
					</script>';
		
		} 

		
		if($_GET['func'] == "teacherPic" && isset($_GET['func'])) {  /* load staffs/teachers picture */ 

			$teacherID = $_GET['teacherID']; 
			
			try{
				
				$teacherPic  = staffPicture($conn, $teacherID);  /* school staffs/teachers picture */
			
			}catch(PDOException $e) {
		
				fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
			}
			
			echo'	<div class="form-group">
							<label for="sess" class="col-lg-4 col-sm-4 control-label">* Teacher/Staff Picture</label>
									
							<div class="col-lg-8 picTDIv">
										
								<center><img src="'.$teacherPic.'" height="150" width = "150"/></center>
								
							</div>
					</div>'; 
		
		} 
?>