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
	This script handle school expenses information
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

		define('fobrain', 'igweze');  /* define a check for wrong access of file */ 
		require 'fobrain-config.php';  /* load fobrain configuration files */

	 
		if ($_REQUEST['query'] == 'save') {  /* save school expenses */ 

			$qid = clean($_REQUEST['qid']); 
			$qData = clean($_REQUEST['qData']);
			$questionArr =  $_REQUEST['inputs']; 
			list ($none, $hid, $cid, $tid) = explode ('-', $qData);	

			/* script validation */ 
			
			if (($hid == "") || ($cid == "") || ($tid == "")){  
				
				$msg_e = "* Ooops, an error has occur while to retrieve Course Topic information. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			} else {   /* insert information */    


				if(is_array($questionArr)){ 

                    $in = 0; $sn = 1; $grandtotal = 0;
                
                    foreach ($questionArr as $input_row) { 
                    
                        $quiz = $questionArr[$in]['quiz']; 

                        if ($quiz == "")  {
                                
                            $msg_e = "* Ooops Error, please enter Course Quiz question for table Serial No - $sn";
                            echo $errorMsg.$msg_e.$eEnd; 
                            echo "<script type='text/javascript'> hidePageLoader(); </script>"; exit;
                            
                        }else{   } 

                        $in++;  $sn++; 

                    }  

					$questions =  serialize($questionArr);   
 
					try {  

						if($qid == ""){


							$ebele_mark = "INSERT INTO $fobrainQuizTB  (cid, tid, hid, questions)

									VALUES (:cid, :tid, :hid, :questions)";
							
							$igweze_prep = $conn->prepare($ebele_mark); 
							$igweze_prep->bindValue(':cid', $cid);
							$igweze_prep->bindValue(':tid', $tid);
							$igweze_prep->bindValue(':hid', $hid);
							$igweze_prep->bindValue(':questions', $questions);   

						}else{ 

							$ebele_mark = "UPDATE $fobrainQuizTB  
										
											SET  
											
											cid = :cid, 
											tid = :tid, 
											hid = :hid, 
											questions = :questions 
											
										WHERE qid = :qid"; 
							
							$igweze_prep = $conn->prepare($ebele_mark);
							$igweze_prep->bindValue(':qid', $qid);
							$igweze_prep->bindValue(':cid', $cid);
							$igweze_prep->bindValue(':tid', $tid);
							$igweze_prep->bindValue(':hid', $hid);
							$igweze_prep->bindValue(':questions', $questions); 

						} 
				 
						if ($igweze_prep->execute()){  /* if sucessfully */ 

							$msg_s = "<strong>Course Quiz question</strong> was successfully saved"; 
							echo $succesMsg.$msg_s.$sEnd; 
							echo "<script type='text/javascript'> 
								//$('#load-wiz-info').load('hostels-info.php'); 
								$('#modal-fobrain').modal('hide');
								hidePageLoader();  
							</script>";exit;  
							
						}else{  /* display error */  
					 
							$msg_e =  "Ooops, an error has occur while to save Course Quiz. Please try again";
							 
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
							
						}

					}catch(PDOException $e) {
			
						fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
				
					}   
		

                }else{


					$msg_e = "* Ooops Error, your Course Quiz question table is empty";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'> hidePageLoader(); </script>"; exit;


				}
				      		
		
			}
		
		}elseif ($_REQUEST['query'] == 'remove') {  /* remove school expenses */ 
			
			$expense = $_REQUEST['rData']; 
			$adminPass =   clean($_REQUEST['adminPass']);  

			$checkDetail =  staffLoginData($conn, $_SESSION['adminUser']);  /* school staffs/teachers password details */ 			 
			list ($tID, $staffUser, $checkedPass, $staffName, $staff_fobrain_grdQ, $userGrade, $userAccess) = 
			explode ("@(.$*S*$.)@", $checkDetail);
			
			list($fobrainIg, $qid, $hName) = explode("-", $expense);			
			
			/* script validation */ 
			
			if (($expense == "")  || ($qid == "")){
				
				$msg_e = "* Ooops, an error has occur while to remove expenditure information. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif(!password_verify($adminPass, $userAccess)){ 		 
		 
				$msg_e = "* Ooops error, your admin authorization password is invalid.";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;

			}else {  /* remove information */      			


				try { 
					
					$ebele_mark = "DELETE FROM 
					
									$fobrainQuizTB										
										
									WHERE qid = :qid
										
									LIMIT 1";
					
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':qid', $qid); 
					
					if($igweze_prep->execute()){  /* if sucessfully */
						
						$removeDiv = "$('#row-".$qid."').fadeOut(1000);";
						$msg_s = "<strong>$hName</strong> was successfully removed"; 
						echo $succesMsg.$msg_s.$sEnd; 
						echo "<script type='text/javascript'>   
								$removeDiv
								hidePageLoader();
							</script>";exit;
						
					}else{  /* display error */
			
						$msg_e =  "Ooops, an error has occur while to remove expenditure information. Please try again";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
						
					}
					

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				}          		
		
			}
		
		}elseif ($_REQUEST['query'] == 'view') {  /* view school expenses */

			
			$qid = strip_tags($_REQUEST['rData']);
			
			/* script validation */
			
			if ($qid == ""){
				
				$msg_e = "* Ooops, an error has occur while to retrieve expenditure information. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}else {   /* select information */    

				try {					
					
					$expensesInfoArr = expensesInfo($conn, $qid);  /* school expenses information */
					//$qid = $expensesInfoArr[$fiVal]["qid"];
					$qid = $expensesInfoArr[$fiVal]["qid"];
					$total = $expensesInfoArr[$fiVal]["total"];
					$title = $expensesInfoArr[$fiVal]["title"];
					$memo = htmlspecialchars_decode($expensesInfoArr[$fiVal]["memo"]);
					$method = $expensesInfoArr[$fiVal]["method"];
					$edate = $expensesInfoArr[$fiVal]["edate"];						
							
					$expenseCategoryInfoArr = expenseCategoryInfo($conn, $qid);  /* school expenses category information */
					$expenseCategory = $expenseCategoryInfoArr[$fiVal]['expense'];
					
					$payMethod = $paymentMethodArr[$method];				
					$edate = date("j F Y", strtotime($edate));						
					$amount = fobrainCurrency($total, $curSymbol);						
					$memo = nl2br($memo);
								

$showExpenses =<<<IGWEZE
	
					
						<div class="row gutters mb-10">
							<div class="text-end">
								<button  class="btn btn-primary"   id="print-overlay">
									<i class="fas fa-print"></i>  
								</button>
							</div>	
						</div>
							 
						<div id = 'fobrain-print-ovly'>

							<!-- table -->	
							<table  class="table table-view table-hover table-responsive">

							<tr>
								<th>
									Expense  
								</td> 
								<td>
									$expenseCategory
								</td> 
							</tr>
							<tr>
								<th>
									 Title
								</th> 
								<td>
									$title 
								</td> 
							</tr>
							<tr>
								<th>
									Amount 
								</th> 
								<td>
									$amount
								</td> 
							</tr>
							<tr>
								<th>
									Details 
								</th> 
								<td>
									$memo
								</td> 
							</tr>
							<tr>
								<th>
									 Date 
								</th> 
								<td>
								$edate
								</td> 
							</tr>
						</table>							
						<!-- / table -->
					</div>
	
IGWEZE;
			
					echo $showExpenses; 
					
					echo "<script type='text/javascript'> hidePageLoader(); </script>"; exit; 						

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				} 
		
			}
		
		}else{
		
			echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
		
		}
exit;

?>