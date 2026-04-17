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
	  
	    if($_REQUEST['drop'] == "balance") { /* load fee div */	
   				 
			$bid = $_REQUEST['bid'];  
			
			/* script validation */ 
			
			if (($bid == "")){
				
				$msg_e = "* Ooops, an error has occur while to fetch account balance. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}else {  /* check information */      

				try {  
					 
					accountBalance($conn, $bid);

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				}          		
		
			}
	
	    }

		if($_REQUEST['drop'] == "drop-fee-div") { /* load fee div */	
   				 
			$feeCat = $_GET['feeCatID']; 

			list($feeCatID, $feeAmount, $title) = explode("#fob#", $feeCat);
			
			if($feeCatID >= $fiVal){
				
				echo "<script type='text/javascript'> 
							$('#feeDetailsDivTop').show(); 
							$('.journal-desc').text('$title - $feeAmount'); 
					</script>";  				
				
			}else{
				
				echo "<script type='text/javascript'> $('#feeDetailsDivTop').hide(); </script>";  
				
			} 
	
	    }
		
		if($_REQUEST['drop'] == "drop-exp-div") {   /* load expense div */   		
		 
			$eCatID = clean($_GET['eCatID']); 
			
			if($eCatID >= $fiVal){
				
				echo "<script type='text/javascript'> $('#expenseDetailsDiv').show(); </script>";  				
				
			}else{
				
				echo "<script type='text/javascript'> $('#expenseDetailsDiv').hide(); </script>";  
				
			}
	
	    }
				
		if($_REQUEST['drop'] == "drop-cat-div") {   /* load product div */   		
		 
			$pCatID = clean($_GET['pCatID']); 
			
			if($pCatID >= $fiVal){
				
				echo "<script type='text/javascript'> $('#productDetailsDiv').show(); </script>";  				
				
			}else{
				
				echo "<script type='text/javascript'> $('#productDetailsDiv').hide(); </script>";  
				
			}	 
	
	    }
		
		if($_REQUEST['drop'] == "schoool-level") {   /* load school type dropdown */		
		 
			$schoolID = clean($_GET['schoolID']);  
			
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

					$level_val .= '<option value="'.$schoolID.'@$@'.$levelID.'"'.$selected.'>'.$levelVal.'</option>' ."\r\n";

					$levelID = ""; $levelVal = "";

				} 

				echo '
				<!-- row -->
				<div class="row gutters">
					<div class="col-12">										
						<!-- field wrapper start -->
						<div class="field-wrapper select-wrapper">				
	
							<select class="form-control"  id="cLevel" name="class" required>

							<option value = "">Search . . . >>>></option> 

							'.$level_val.' 
					 
							</select>
							<div class="icon-wrap"  id="wait_11" style="display: none;">
								<i class="loader"></i>
							</div>
							<div class="field-placeholder"> Payment Level <span class="text-danger"></span></div>													
						</div>
						<!-- field wrapper end -->
					</div>																 
				</div>	
				<!-- /row -->'; 
				
			}else{ 
				
				echo '<option value="">Ooops Error, could not load school level</option>' ."\r\n"; 
				
			}	
			
			echo '<script type="text/javascript">	 
					renderSelect("#cLevel");   
				</script>';
	
	    } 
		
		if($_REQUEST['drop'] == "load-students") {   /* load student dropdown */	

			$levelData = clean($_GET['clevelID']);

			list ($schoolID, $level) = explode ("@$@", $levelData);	
			 
			try{
					
				$sessionInfo = currentSessionInfo($conn);  /* current school session information  */
				
				list ($fiSessionID, $fiSession) = explode ("@$@", $sessionInfo);
				
				if($level == $fiVal){
					
					$sessionID = $fiSessionID;
				
				}elseif($level == $seVal){
		
					$sessionID  =  ($fiSessionID - $fiVal);
				
				}elseif($level == $thVal){	
					
					$sessionID  =  ($fiSessionID - $seVal);
					
				}elseif($level == $foVal){	
					
					$sessionID  =  ($fiSessionID - $thVal);
				
				}elseif($level == $fifVal){	
					
					$sessionID  =  ($fiSessionID - $foVal);
					
				}elseif($level == $sixVal){	
				
					$sessionID  =  ($fiSessionID - $fifVal);
					
				}else{
					
					$msg_e = "* Ooops Error, could not find records";
					echo $errorMsg.$msg_e.$eEnd; 
					exit;
					
				}	
				
				require $fobrainSchoolTBS;  /* include database table information  */
				
				
			}catch(PDOException $e) {
			
				fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
				
			} 
			

			echo '
			<!-- row -->
			<div class="row gutters">
				<div class="col-12">										
					<!-- field wrapper start -->
					<div class="field-wrapper">	
						<select class="form-control"  id="regStudents" name="regData" required>							  
						<option value = "">Search . . . >>>></option>';								
						try {
						
							studentOptions($conn, $sessionID, $seVal);  /* student dropdown select option field */
					
						}catch(PDOException $e) {

							fobrainDie( 'Ooops Database Error: ' . $e->getMessage());

						}  
						
			echo'
						</select>
						<div class="field-placeholder"> Select Student <span class="text-danger"></span></div>													
					</div>
					<!-- field wrapper end -->
				</div>																 
			</div>	
			<!-- /row -->'; 
			
			 
			
			echo '<script type="text/javascript">	  
					renderSelectImg("#regStudents", 1);
					$("#feeDetailsDiv").show(); 
				</script>';
				  
 			
	    } 

		if($_REQUEST['drop'] == "payroll") {   /* load staff dropdown */	

			$staff = clean($_GET['staff']); 
 	 
			$salary = staffSalary($conn, $staff);   
 
			$salary = intval($salary);

			$burConfigsArray = bursaryConfigsArrays($conn);  /* school bursary configuration  */
				 
			$salary_tax = $burConfigsArray[0]['stax']; 

			if(($salary != "") && ($salary_tax != "")){

				$salary_per = ($salary * $salary_tax);

				$nsalary = ($salary - $salary_per);

			}else{ $nsalary = $salary; } 

			$earn1 = ""; $des1 = "Earning"; $earn2 = ""; $des2 = "Earning"; $earn3 = ""; $des3 = "Earning";
			$ded1 = ""; $purp1 = "Deduction"; $ded2 = ""; $purp2 = "Deduction"; $ded3 = ""; $purp3 = "Deduction"; 
			$earn_t = 0; $ded_t = 0; 

			echo '
			<!-- row -->
			<div class="row gutters">
				<div class="col-12 text-center my-10  bb-1 px-5-per"> 
					 <h4 class="text-info">Payroll Summary</h4>  
				</div>
				<div class="col-xl-6 col-lg-6 col-md-6 col-12 text-left mb-10">		
					<div class="row gutters">								
						<h4 class="text-success bb-1 px-5-per"> Earning </h4>
						<div class="col-6 px-5-per py-5 fw-13 text-info bb-1 des1">'.$des1.'</div>
						<div class="col-6 px-5-per py-5 fw-13 text-success bb-1">'.$curSymbol.'<span id="tax-ea-1" class="text-success">'.$earn1.'</span> </div>
						<div class="col-6 px-5-per py-5 fw-13 text-info bb-1 des2">'.$des2.'</div>
						<div class="col-6 px-5-per py-5 fw-13 text-success bb-1">'.$curSymbol.'<span id="tax-ea-2" class="text-success">'.$earn2.'</span> </div>
						<div class="col-6 px-5-per py-5 fw-13 text-info bb-1 des3">'.$des3.'</div>
						<div class="col-6 px-5-per py-5 fw-13 text-success bb-1">'.$curSymbol.'<span id="tax-ea-3" class="text-success">'.$earn3.'</span> </div>
					</div>
				</div>

				<div class="col-xl-6 col-lg-6 col-md-6 col-12 text-left">		
					<div class="row gutters">								
						<h4 class="text-danger  bb-1 px-5-per"> Deduction </h4>		
						<div class="col-6 px-5-per py-5 fw-13 text-info bb-1 purp1">'.$purp1.'</div>	
						<div class="col-6 px-5-per py-5 fw-13 text-danger bb-1">'.$curSymbol.'<span id="tax-de-1" class="text-danger">'.$ded1.'</span></div>						
						<div class="col-6 px-5-per py-5 fw-13 text-info bb-1 purp2">'.$purp2.'</div>	
						<div class="col-6 px-5-per py-5 fw-13 text-danger bb-1">'.$curSymbol.'<span id="tax-de-2" class="text-danger">'.$ded2.'</span></div>
						<div class="col-6 px-5-per py-5 fw-13 text-info bb-1 purp3">'.$purp3.'</div>	
						<div class="col-6 px-5-per py-5 fw-13 text-danger bb-1">'.$curSymbol.'<span id="tax-de-3" class="text-danger">'.$ded3.'</span></div>
					</div>
				</div>

				<div class="col-xl-6 col-lg-6 col-md-6 col-12 text-left my-10  bb-1"> 
					 
				</div>
				<div class="col-xl-6 col-lg-6 col-md-6 col-12 text-left my-10 bb-1"> 
					<div class="row gutters"> 
						<div class="col-6 px-5-per py-10 fw-13 text-info bb-1">Total Earning</div>
						<div class="col-6 px-5-per py-10 fw-13 text-success bb-1">'.$curSymbol.'<span id="tax-ea-to" class="text-success">'.$earn_t.'</span> </div>
						<div class="col-6 px-5-per py-10 fw-13 text-info bb-1">Total Deduction</div>
						<div class="col-6 px-5-per py-10 fw-13 text-danger bb-1">'.$curSymbol.'<span id="tax-de-to" class="text-danger">'.$ded_t.'</span></div>
						<div class="col-6 px-5-per py-10 fw-13 text-info bb-1"> Tax</div>
						<div class="col-6 px-5-per py-10 fw-13 text-danger bb-1">'.$curSymbol.'<span id="tax-descrip" class="text-danger">'.$salary_per.'</span></div>
						<div class="col-6 px-5-per py-10 fw-13 text-info bb-1">Net Salary</div>
						<div class="col-6 px-5-per py-10 fw-13 text-success bb-1">'.$curSymbol.'<span id="to-salary" class="text-success">'.$nsalary.'</span></div> 
					</div>
				</div>
			</div>	
			<div class="row gutters">			
				<div class="col-xl-4 col-lg-4 col-md-4 col-12">										
					<!-- field wrapper start -->
					<div class="field-wrapper">
						<input type="number" class="form-control salary-target float-number" name="salary"  id="salary"
						value = "'.$salary.'"  required>
						<div class="field-placeholder">  Staff Salary  <span class="text-danger">*</span></div>													
						<div class="form-text text-danger fw-13 wiz-menu">
							'.$salary_tax.' tax applied  <!-- <a href="javascript:;" id="burs-config" class="text-info ps-20"> Edit Tax</a>-->
						</div>
					</div> 											
				</div>
				<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12">	 
					<input type="hidden" class="form-control" placeholder="" name="nsalary"  id="nsalary"
					value = "'.$nsalary.'" >
					<input type="hidden" class="form-control"  name="tax"  id="salary-tax"
					value = "'.$salary_tax.'"> 
				</div>																 
			</div>	
			<!-- /row --> 

			<!-- row -->
			<div class="row gutters">
				<div class="col-sm-6 col-sm-offset-1">
					<div class="row gutters">												
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">										
						<!-- field wrapper start -->
						<div class="field-wrapper">
							<input type="number" class="form-control salary-target" placeholder="Salary Earning" name="earn1"  id="earn1"
							value = "'.$earn1.'">
							<div class="field-placeholder"> Salary Earning  <span class="text-danger"></span></div>													
						</div> 											
					</div>
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">										
						<!-- field wrapper start -->
						<div class="field-wrapper">
							<input type="text" class="form-control salary-des" placeholder="Description" name="des1"  id="des1"
							value = "'.$des1.'">
							<div class="field-placeholder">  Description <span class="text-danger"></span></div>													
						</div> 											
					</div>																 
				
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">										
						<!-- field wrapper start -->
						<div class="field-wrapper">
							<input type="number" class="form-control salary-target" placeholder="Salary Earning" name="earn2"  id="earn2"
							value = "'.$earn2.'">
							<div class="field-placeholder"> Salary Earning  <span class="text-danger"></span></div>													
						</div> 											
					</div>
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">										
						<!-- field wrapper start -->
						<div class="field-wrapper">
							<input type="text" class="form-control salary-des" placeholder="Description" name="des2"  id="des2"
							value = "'.$des2.'">
							<div class="field-placeholder"> Description <span class="text-danger"></span></div>													
						</div> 											
					</div>																 
				
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">										
						<!-- field wrapper start -->
						<div class="field-wrapper">
							<input type="number" class="form-control salary-target" placeholder="Salary Earning" name="earn3"  id="earn3"
							value = "'.$earn3.'">
							<div class="field-placeholder"> Salary Earning  <span class="text-danger"></span></div>													
						</div> 											
					</div>
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">										
						<!-- field wrapper start -->
						<div class="field-wrapper">
							<input type="text" class="form-control salary-des" placeholder="Description" name="des3"  id="des3"
							value = "'.$des3.'">
							<div class="field-placeholder"> Description <span class="text-danger"></span></div>													
						</div> 											
					</div>
					</div>		
				</div>

				<div class="col-sm-6">
					<div class="row gutters">			
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">										
						<!-- field wrapper start -->
						<div class="field-wrapper">
							<input type="number" class="form-control salary-target" placeholder="Salary Deduction" name="ded1"  id="ded1"
							value = "'.$ded1.'">
							<div class="field-placeholder"> Salary Deduction  <span class="text-danger"></span></div>													
						</div> 											
					</div>
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">										
						<!-- field wrapper start -->
						<div class="field-wrapper">
							<input type="text" class="form-control salary-des" placeholder="Description" name="purp1"  id="purp1"
							value = "'.$purp1.'">
							<div class="field-placeholder">  Description <span class="text-danger"></span></div>													
						</div> 											
					</div>																 
				
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">										
						<!-- field wrapper start -->
						<div class="field-wrapper">
							<input type="number" class="form-control salary-target" placeholder="Salary Deduction" name="ded2"  id="ded2"
							value = "'.$ded2.'">
							<div class="field-placeholder"> Salary Deduction  <span class="text-danger"></span></div>													
						</div> 											
					</div>
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">										
						<!-- field wrapper start -->
						<div class="field-wrapper">
							<input type="text" class="form-control salary-des" placeholder="Description" name="purp2"  id="purp2"
							value = "'.$purp2.'">
							<div class="field-placeholder"> Description <span class="text-danger"></span></div>													
						</div> 											
					</div>																 
				
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">										
						<!-- field wrapper start -->
						<div class="field-wrapper">
							<input type="number" class="form-control salary-target" placeholder="Salary Deduction" name="ded3"  id="ded3"
							value = "'.$ded3.'">
							<div class="field-placeholder"> Salary Deduction  <span class="text-danger"></span></div>													
						</div> 											
					</div>
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">										
						<!-- field wrapper start -->
						<div class="field-wrapper">
							<input type="text" class="form-control salary-des" placeholder="Description" name="purp3"  id="purp3"
							value = "'.$purp3.'">
							<div class="field-placeholder"> Description <span class="text-danger"></span></div>													
						</div> 											
					</div>		
					</div> 
				</div>														 
			</div>	
			<!-- /row --> ';   
 			
	    } 

		/*
		if($_GET['pay'] == "calStatus" && isset($_GET['pay'])) {   /* load fee details div * /	
		 
			$feeCatID = clean($_GET['amountPay']); 
			
			if($feeCatID >= $fiVal){
				
				echo "<script type='text/javascript'> $('#feeDetailsDivTop').show(); </script>";  				
				
			}else{
				
				echo "<script type='text/javascript'> $('#feeDetailsDivTop').hide(); </script>";  
				
			}	 
	
	    }*/ 

exit; 
?>