<?php 
	
    if (!defined('fobrain')) /* This checks if this page was wrongly access by users */ 
	die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!'); 
 

    if($uMode == $seVal){   /* save information */ 	 

        echo '

            <!-- row -->
            <div class="row gutters row-section">
            
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-30">	
                    <!-- card start -->
                    <div class="card card-shadow">
                        <div class="card-header-wiz">
                            <h4>
                                <i class="fas fa-user-plus fs-16"></i> 
                                New Students Detail
                            </h4>
                        </div> 
                        <div id="msg-box"></div> 					
                        <div class="card-body pb-70">  
		                  
                        <div class="table-responsive">
						<!-- table -->
						<table class="table table-hover table-responsive style-table mb-100  wiz-table">
						<thead>
							<tr>
								<th>Reg No.</th> 
								<th>Name</th>
								<th>Tasks</th>
							</tr>
						</thead> 
						<tbody> ';
 
        for($c=0; $c <= (count($bioArray) - 1); $c++) {  /* loop array */	 

            if($session != ''){  						 
                  
                $lastSessReg = sessionLastReg($conn, $session);  /* school session last student registration number  */

                /* generate new student registration number  */
                  
                $regC = explode("/", $lastSessReg);
                
                $regCount = count($regC);
                
                if($regCount == $thVal){
                    
                    list ($schSplit, $regSplit, $sup) = explode ("/", $lastSessReg);
                    
                }elseif($regCount == $seVal){
                    
                    list ($regSplit, $sup) = explode ("/", $lastSessReg);
                    
                }else{
                    
                    list ($regSplit) = explode ("/", $lastSessReg);

                }	 
                                        
                if($regSplit == ''){
                                        
                    $newReg = $session.'001';
                                            
                }else{
                                        
                    $newReg = ($regSplit + $fiVal);
                            
                }		 
                
                if($regCount == $thVal){
                    
                    $regNum =  $schSplit.'/'.$newReg.$supRegNo;
                    
                }elseif($regCount == $seVal){
                    
                    $regNum =  $newReg.$supRegNo;
                    
                }else{
                    
                    $regNum =  $newReg.$supRegNo;

                } 
                
                mt_srand((double)microtime() * 1000000);							

                if($generatePass == $foreal){  /* check generate password status */

                    $userPass = wizGradeRandomString($charset, 8);  /* generate password */
                    $spon_access = wizGradeRandomString($charset, 5);  /* generate password */

                }else{

                    $userPass = "password";
                    $spon_access = "password";

                } 

                $n_userPass = $userPass;
									
                $userPass = password_hash($userPass, PASSWORD_BCRYPT, $options_bcrypt);
                $spon_access  = password_hash($spon_access, PASSWORD_BCRYPT, $options_bcrypt);  
                
                $lname = ucwords($bioArray[$c][0]);
                $fname = ucwords($bioArray[$c][1]);
                $mname = ucwords($bioArray[$c][2]);
                $dob = $bioArray[$c][3];
                $gender = $bioArray[$c][4]; 
                $phone = $bioArray[$c][5];
                $email = strtolower($bioArray[$c][6]);
                $add1 = ucwords($bioArray[$c][7]);
                $city = ucwords($bioArray[$c][8]);
                $state = ucwords($bioArray[$c][9]);
                $country = ucwords($bioArray[$c][10]);  

                if($gender == "M"){
                    $gender = 1;
                }elseif($gender == "F"){
                    $gender = 2;
                }else{
                    $gender = "";
                }
 
                $show_tasks_div = $thVal;  
                
                if($schoolExt == $fobrainNurAbr){  /* check school type */
										
                    require ($fobrainAdminDir.'fobrain-nur-bio.php');  /* school registration script */
                    
                }else{
                
                    require ($fobrainAdminDir.'fobrain-prisec-bio.php');  /* school registration script */
                }       
                
            }else{ 
            
                //info
            }  


            $regNum = ''; $newReg = ''; $lastSessReg = ''; $regSplit =''; 
			$regSplit = ''; $regCount = ''; $regC = ''; 

        } 

        echo '</tbody>
						</table>
					</div> ';
        
        
        echo '
					
    
                </div>
            </div>
            <!-- card end -->	
        </div>

        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12" id="scroll-to-div">	
            <!-- card start -->
            <div class="card card-shadow">
                <div class="card-header-wiz">
                    <h4>
                        <i class="fas fa-tasks fs-16"></i> 
                        Tasks Panel
                    </h4>
                </div> 
                <div class="msg-box"></div> 					
                <div class="card-body" id="wigz-right-half"> 
                    '.$info_pass.'
                </div>
            </div>
            <!-- card end -->	
        </div>
    </div>
    <!-- / row --> '; 

    echo "<script type='text/javascript'>  renderTable(); </script>";
         

    } 
 