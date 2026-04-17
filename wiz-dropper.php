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
	This script handle regstration dropdown 
		
~~~~------------------------------------------------------------------------*/ 

		define('fobrain', 'igweze');  /* define a check for wrong access of file */ 
		require_once 'sources/functions/fobrain-dir-in.php';  /* include configuration script */ 
		require_once $fobrainFunctionDir;  /* load script functions */		 
		require ($fobrainDBConnectIndDir);   /* load connection string */ 
		
		if($_REQUEST['func'] == "school-type") {  

			$schoolID = strip_tags($_REQUEST['school']); 
			
			if($schoolID >= $fiVal){  
			 
				$supRegNo = $schoolRegSuffArr[$schoolID];
		
				require $fobrainSchoolTBS; /* include student database table information  */ 

				$level_list = studentLevelsArray($conn); 

				$level_val = ""; $level = "";

				foreach($level_list as $level_grade) { 

					$levelID = $level_grade['cl_id']; $levelVal = $level_grade['level'];

					if ($levelID == $level){
						$selected = "SELECTED";
					} else {
						$selected = "";
					}

					$level_val .= '<option value="'.$levelID.'"'.$selected.'>'.$levelVal.'</option>' ."\r\n";

					$levelID = ""; $levelVal = "";

				} 

				echo '
				<!-- row -->
				<div class="row gutters">
					<div class="col-12">										
						<!-- field wrapper start -->
						<div class="field-wrapper">				
	
							<select class="form-control required"  id="cLevel" name="class">

							<option value = "">Please select One</option> 

							'.$level_val.'

					 
							</select>
							<div class="field-placeholder"> Level <span class="text-danger">*</span></div>													
						</div>
						<!-- field wrapper end -->
					</div>																 
				</div>	
				<!-- /row -->'; 
				echo '<script type="text/javascript">	  
						renderSelect("#cLevel"); 
					</script>';
				
			}else{ 
				
				echo '<option value="">Ooops Error, could not load school level</option>' ."\r\n"; 
				
			}	  

		} 

?> 