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
	This script handle student registration dropdown 
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

			define('fobrain', 'igweze');  /* define a check for wrong access of file */

			require 'fobrain-config-s.php';  /* load fobrain configuration files */
	  
			if($_GET['func'] == "stuLevelReg" && isset($_GET['func'])) { 

			 
				$levelSchool = $_GET['level'];
			 
				list($schoolID, $level) = explode('-', $levelSchool);
			 
				$supRegNo = $schoolRegSuffArr[$schoolID];
			
				require $fobrainSchoolTBS; /* include student database table information  */ 

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

				if($level == $fiVal){  /* check student level  and generate new  registration number  */
				
					$sessionID = $fiSessionID;										
					$lastSessReg = sessionLastRegID($conn, $sessionID);  /* school session last student registration ID  */
					
					list ($regSplit, $sup) = explode ("/", $lastSessReg);
										
					if($regSplit == ''){
										
						$session = fobrainSession($conn, $sessionID);  /* school session  */											
						$newReg = $session.'001';
											
					}else{
										
						$newReg = ($regSplit + $fiVal);
					}
										

					$newRegNo =  $newReg.$supRegNo;
					
				}elseif($level == $seVal){  /* check student level  and generate new  registration number  */
					
					$sessionID = $seSessionID;
					$lastSessReg = sessionLastRegID($conn, $sessionID);  /* school session last student registration ID  */
					
					list ($regSplit, $sup) = explode ("/", $lastSessReg);
										
					if($regSplit == ''){
						
						$session = fobrainSession($conn, $sessionID);  /* school session  */		
						$newReg = $session.'001';
											
					}else{
										
						$newReg = ($regSplit + $fiVal);
					}
										

					$newRegNo =  $newReg.$supRegNo;
					
				}elseif($level == $thVal){  /* check student level  and generate new  registration number  */
					
					$sessionID = $thSessionID;
					$lastSessReg = sessionLastRegID($conn, $sessionID);  /* school session last student registration ID  */
					
					list ($regSplit, $sup) = explode ("/", $lastSessReg);
										
					if($regSplit == ''){
						
						$session = fobrainSession($conn, $sessionID);  /* school session  */	
						$newReg = $session.'001';
											
					}else{
										
						$newReg = ($regSplit + $fiVal);
					}
										

					$newRegNo =  $newReg.$supRegNo;
					
				}elseif($level == $foVal){  /* check student level  and generate new  registration number  */
					
					$sessionID = $foSessionID;
					$lastSessReg = sessionLastRegID($conn, $sessionID);  /* school session last student registration ID  */
					
					list ($regSplit, $sup) = explode ("/", $lastSessReg);
										
					if($regSplit == ''){
						
						$session = fobrainSession($conn, $sessionID);  /* school session  */	
						$newReg = $session.'001';
											
					}else{
										
						$newReg = ($regSplit + $fiVal);
					}
										

					$newRegNo =  $newReg.$supRegNo;
					
				}elseif($level == $fifVal){  /* check student level  and generate new  registration number  */
					
					$sessionID = $fifSessionID;
					$lastSessReg = sessionLastRegID($conn, $sessionID);  /* school session last student registration ID  */
					
					list ($regSplit, $sup) = explode ("/", $lastSessReg);
										
					if($regSplit == ''){
						
						$session = fobrainSession($conn, $sessionID);  /* school session  */	
						$newReg = $session.'001';
											
					}else{
										
						$newReg = ($regSplit + $fiVal);
					}
										

					$newRegNo =  $newReg.$supRegNo;
					
				}elseif($level == $sixVal){  /* check student level  and generate new  registration number  */
					
					$sessionID = $sixSessionID;
					$lastSessReg = sessionLastRegID($conn, $sessionID);  /* school session last student registration ID  */
					
					list ($regSplit, $sup) = explode ("/", $lastSessReg);
										
					if($regSplit == ''){
										
						$session = fobrainSession($conn, $sessionID);  /* school session  */
						$newReg = $session.'001';
											
					}else{
										
						$newReg = ($regSplit + $fiVal);
					}
										

					$newRegNo =  $newReg.$supRegNo;
					
				}else{  /* no registration number */ 
					
					$newRegNo = '';
					$sessionID = '';
					
				}

				echo '    
				
				<div class="row gutters">      

					<div class="col-lg-4">										
						<!-- field wrapper start -->
						<div class="field-wrapper">	
							<select class="form-control fob-select text-left"  id="class" name="class" required>						  
								<option value = "">Select Class</option>';
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
										
										$classCount;
										
									}
									
									echo '<option value="'.$sessionID.'-'.$classKey.'">'.$classVal.' - '.$classCount.'</option>' ."\r\n";
									
									$Type++;
								
								}

					
					echo '		</select> 
					
								<div class="field-placeholder">Select Class <span class="text-danger">*</span></div>
							</div>
							<!-- field wrapper end -->
						</div>'; 
				
					echo '            
						<div class="col-lg-4">										
							<!-- field wrapper start -->
							<div class="field-wrapper">	
								<input type="text" class="form-control text-left" value ="'.$newRegNo.'"  maxlength="15" name="regnum" 
								id="regnum" disabled required /> 
								<div class="field-placeholder"> New Regno. <span class="text-danger">*</span></div>
						  	</div>
						  	<!-- field wrapper end -->
					 	</div>'; 	 
 
					echo '            
					<div class="col-lg-4">										
						<!-- field wrapper start -->
						<div class="field-wrapper">	 				 
							<select class="form-control fob-select text-left"  id="term" name="term" required>
						  
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

				   
					echo '		
							</select>   
							<div class="field-placeholder"> Select Term <span class="text-danger">*</span></div>
						</div>
						<!-- field wrapper end -->
					</div> 
				</div>'; 					 

				echo "<script type='text/javascript'>  
							 

							$('.fob-select').each(function() {  
								renderSelect($('#'+this.id)); 
							});
						</script>";
			}



?>