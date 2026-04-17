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

			$pid = clean($_REQUEST['pid']); 
			$title =  clean($_REQUEST['title']);
			$expenseArr =  $_REQUEST['inputs'];
			$payee =  clean($_REQUEST['payee']);
			$bid =  clean($_REQUEST['acc']); 
			$tags =  clean($_REQUEST['tags']);   
			$method = cleanInt($_REQUEST['method']);
			$memo = $_REQUEST['memo'];
			$edate = $_REQUEST['edate'];
			$rtime = date("Y-m-d H:i:s"); 
			
			/* script validation */ 
			
			if ($pid == "")  {
				
				$msg_e = "* Ooops Error, please select expenditure category";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($title == "")  {
				
				$msg_e = "* Ooops Error, please enter a title";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($payee == "")  {
				
				$msg_e = "* Ooops Error, please enter your payee";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($bid == "")  {
				
				$msg_e = "* Ooops Error, please select bank account";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($method == "")  {
				
				$msg_e = "* Ooops Error, please select a payement method";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			} else {   /* insert information */   

				if($memo != ""){

					$memo = strip_tags($memo);
					$memo = str_replace('<br />', "\n", $memo);
					$memo = htmlspecialchars($memo); 

				}   

				if(is_array($expenseArr)){ 

                    $in = 0; $sn = 1; $grandtotal = 0;
                
                    foreach ($expenseArr as $input_row) { 
                    
                        $cat = $expenseArr[$in]['cat'];
                        $desc = $expenseArr[$in]['desc'];
                        $qty = $expenseArr[$in]['qty'];
                        $rate = $expenseArr[$in]['rate'];
                        $amount = $expenseArr[$in]['amount'];  
                        
                        $grandtotal = ($grandtotal + $amount);

                        if ($cat == "")  {
                                
                            $msg_e = "* Ooops Error, please select a category for table Serial No - $sn";
                            echo $errorMsg.$msg_e.$eEnd; 
                            echo "<script type='text/javascript'> hidePageLoader(); </script>"; exit;
                            
                        }elseif ($desc == "")  {
                            
                            $msg_e = "* Ooops Error, please enter a description for table Serial No - $sn";
                            echo $errorMsg.$msg_e.$eEnd; 
                            echo "<script type='text/javascript'> hidePageLoader(); </script>"; exit;
                            
                        }elseif ($qty == "")  {
                            
                            $msg_e = "* Ooops Error, please enter quantity for table Serial No - $sn";
                            echo $errorMsg.$msg_e.$eEnd; 
                            echo "<script type='text/javascript'> hidePageLoader(); </script>"; exit;
                            
                        }elseif ($rate == "")  {
                            
                            $msg_e = "* Ooops Error, please enter the rate for table Serial No - $sn";
                            echo $errorMsg.$msg_e.$eEnd; 
                            echo "<script type='text/javascript'> hidePageLoader(); </script>"; exit;
                            
                        }elseif ($amount == "")  {
                            
                            $msg_e = "* Ooops Error, please the expense total amount is empty for table Serial No - $sn";
                            echo $errorMsg.$msg_e.$eEnd; 
                            echo "<script type='text/javascript'> hidePageLoader(); </script>"; exit;
                            
                        }elseif (($qty * $rate) != $amount)  {
                            
                            $msg_e = "* Ooops Error, total amount for table Serial No - $sn is wrong";
                            echo $errorMsg.$msg_e.$eEnd; 
                            echo "<script type='text/javascript'> hidePageLoader(); </script>"; exit;
                            
                        }else{  
                             
							 
                        } 

                        $in++;  $sn++; $amount = ""; 

                    }



					$expense =  serialize($expenseArr);

					//list ($bid, $balan) = explode ("#fob#", $acc);
				 
					$status = 1;
 
					try { 

						$conn->beginTransaction();   /* begin transaction */
						
						$ebele_mark = "INSERT INTO $fobrainExpenseTB  (pid, title, payee, acc, expense, total, method, tags, memo, edate, rtime, status)

								VALUES (:pid, :title, :payee, :acc, :expense, :total, :method, :tags, :memo, :edate, :rtime, :status)";
						
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':pid', $pid);
						$igweze_prep->bindValue(':title', $title);
						$igweze_prep->bindValue(':payee', $payee);
						$igweze_prep->bindValue(':acc', $bid);
						$igweze_prep->bindValue(':expense', $expense); 
						$igweze_prep->bindValue(':total', $grandtotal); 
						$igweze_prep->bindValue(':method', $method);
						$igweze_prep->bindValue(':tags', $tags);
						$igweze_prep->bindValue(':memo', $memo);
						$igweze_prep->bindValue(':edate', $edate);
						$igweze_prep->bindValue(':rtime', $rtime); 
						$igweze_prep->bindValue(':status', $status); 

						$ebele_mark_1= "UPDATE  $expenseDocTB

										SET 

										status = :status

										WHERE 

										pid = :pid";
				
						$igweze_prep_1 = $conn->prepare($ebele_mark_1); 
						$igweze_prep_1->bindValue(':pid', $pid);
						$igweze_prep_1->bindValue(':status', $status);	 

						$return_query = balanceAccount($conn, $bid, $grandtotal, "debit", $allow_negative);

						if(($igweze_prep->execute()) 
							&& ($igweze_prep_1->execute()) 
							&& ($return_query == 1)){  /* if sucessfully */

							$conn->commit(); 	
						
							$micro = str_replace(array('.',' '), array('',''), microtime());
							$pageID = $micro.randomString($charset, 8); 

							$msg_s = "Expenditure was successfully saved"; 
							echo $succesMsg.$msg_s.$sEnd; 
							echo "<script type='text/javascript'> 
									
									$('#load-expenditure').load('expense-info.php');  
									 
									$('#pid').val('$pageID');	
									$('#title').val('');
									$('#payee').val('');
									$('#preview-upload').html(''); 
									$('#edate').val(''); 
									$('#e-tags').val('');
									$('#memo').val('');  
									$('#bank_acc').change();
									$('#modal-fobrain').modal('hide');
									hidePageLoader();  

								</script>"; exit;
							
						}else{  /* display error */ 

							$conn->rollBack(); 		
							
							if($return_query == 2){
								$msg_e =  "Ooops, you have insufficient balance to perform this transaction";
							}elseif($return_query == 3){
								$msg_e =  "Ooops, select a debit or credit transaction to perform";
							}elseif($return_query == 4){
								$msg_e =  "Ooops, an error has occur while to save expenditure 4. Please try again";
							}else{
								$msg_e =  "Ooops, an error has occur while to save expenditure. Please try again";
							}
							 
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
							
						}

					}catch(PDOException $e) {
			
						fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
				
					}   
		

                }else{


					$msg_e = "* Ooops Error, your expense table is empty";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'> hidePageLoader(); </script>"; exit;


				}
				      		
		
			}
		
		}elseif ($_REQUEST['query'] == 'update') {  /* update school expenses */ 

			$eid = clean($_REQUEST['eid']);
			$pid = clean($_REQUEST['pid']); 
			$title =  clean($_REQUEST['title']);
			$expenseArr =  $_REQUEST['inputs'];
			$payee =  clean($_REQUEST['payee']);
			$bid =  clean($_REQUEST['acc']); 
			$tags =  clean($_REQUEST['tags']);   
			$method = cleanInt($_REQUEST['method']);
			$memo = $_REQUEST['memo'];
			$edate = $_REQUEST['edate'];
			$rtime = date("Y-m-d H:i:s"); 
			
			/* script validation */ 
			
			if ($pid == "")  {
				
				$msg_e = "* Ooops Error, please select expenditure category";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($title == "")  {
				
				$msg_e = "* Ooops Error, please enter a title";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($payee == "")  {
				
				$msg_e = "* Ooops Error, please enter your payee";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($bid == "")  {
				
				$msg_e = "* Ooops Error, please select bank account";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($method == "")  {
				
				$msg_e = "* Ooops Error, please select a payement method";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			} else {   /* insert information */   

				if($memo != ""){

					$memo = strip_tags($memo);
					$memo = str_replace('<br />', "\n", $memo);
					$memo = htmlspecialchars($memo); 

				}   

				if(is_array($expenseArr)){ 

                    $in = 0; $sn = 1; $grandtotal = 0;
                
                    foreach ($expenseArr as $input_row) { 
                    
                        $cat = $expenseArr[$in]['cat'];
                        $desc = $expenseArr[$in]['desc'];
                        $qty = $expenseArr[$in]['qty'];
                        $rate = $expenseArr[$in]['rate'];
                        $amount = $expenseArr[$in]['amount'];  
                        
                        $grandtotal = ($grandtotal + $amount);

                        if ($cat == "")  {
                                
                            $msg_e = "* Ooops Error, please select a category for table Serial No - $sn";
                            echo $errorMsg.$msg_e.$eEnd; 
                            echo "<script type='text/javascript'> hidePageLoader(); </script>"; exit;
                            
                        }elseif ($desc == "")  {
                            
                            $msg_e = "* Ooops Error, please enter a description for table Serial No - $sn";
                            echo $errorMsg.$msg_e.$eEnd; 
                            echo "<script type='text/javascript'> hidePageLoader(); </script>"; exit;
                            
                        }elseif ($qty == "")  {
                            
                            $msg_e = "* Ooops Error, please enter quantity for table Serial No - $sn";
                            echo $errorMsg.$msg_e.$eEnd; 
                            echo "<script type='text/javascript'> hidePageLoader(); </script>"; exit;
                            
                        }elseif ($rate == "")  {
                            
                            $msg_e = "* Ooops Error, please enter the rate for table Serial No - $sn";
                            echo $errorMsg.$msg_e.$eEnd; 
                            echo "<script type='text/javascript'> hidePageLoader(); </script>"; exit;
                            
                        }elseif ($amount == "")  {
                            
                            $msg_e = "* Ooops Error, please the expense total amount is empty for table Serial No - $sn";
                            echo $errorMsg.$msg_e.$eEnd; 
                            echo "<script type='text/javascript'> hidePageLoader(); </script>"; exit;
                            
                        }elseif (($qty * $rate) != $amount)  {
                            
                            $msg_e = "* Ooops Error, total amount for table Serial No - $sn is wrong";
                            echo $errorMsg.$msg_e.$eEnd; 
                            echo "<script type='text/javascript'> hidePageLoader(); </script>"; exit;
                            
                        }else{  
                             
							 
                        } 

                        $in++;  $sn++; $amount = ""; 

                    } 

					$expense =  serialize($expenseArr);

					//list ($bid, $balan) = explode ("#fob#", $acc);
				 
					$status = 1;
 
					try { 

						$conn->beginTransaction();   /* begin transaction */

						$ebele_mark = "UPDATE $fobrainExpenseTB  
										
										SET  
										  
										title = :title, 
										payee = :payee, 
										acc = :acc, 
										expense = :expense, 
										total = :total, 
										method = :method, 
										tags = :tags, 
										memo = :memo, 
										edate = :edate,  
										status = :status
										
									WHERE eid = :eid"; 
						 
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':pid', $pid);
						$igweze_prep->bindValue(':title', $title);
						$igweze_prep->bindValue(':payee', $payee);
						$igweze_prep->bindValue(':acc', $bid);
						$igweze_prep->bindValue(':expense', $expense); 
						$igweze_prep->bindValue(':total', $grandtotal); 
						$igweze_prep->bindValue(':method', $method);
						$igweze_prep->bindValue(':tags', $tags);
						$igweze_prep->bindValue(':memo', $memo);
						$igweze_prep->bindValue(':edate', $edate);
						$igweze_prep->bindValue(':rtime', $rtime); 
						$igweze_prep->bindValue(':status', $status);   

						$return_query = balanceAccount($conn, $bid, $grandtotal, "debit", $allow_negative);

						if(($igweze_prep->execute())  
							&& ($return_query == 1)){  /* if sucessfully */

							$conn->commit(); 	 

							$micro = str_replace(array('.',' '), array('',''), microtime());
							$pageID = $micro.randomString($charset, 8); 

							$msg_s = "Expenditure was successfully saved"; 
							echo $succesMsg.$msg_s.$sEnd; 
							echo "<script type='text/javascript'> 
									
									$('#load-expenditure').load('expense-info.php');  
									    
									$('#pid').val('$pageID');	
									$('#title').val('');
									$('#payee').val('');
									$('#preview-upload').html(''); 
									$('#edate').val(''); 
									$('#e-tags').val('');
									$('#memo').val('');  
									$('#bank_acc').change();
									hidePageLoader();  

								</script>"; exit;
							
						}else{  /* display error */ 

							$conn->rollBack(); 			

							if($return_query == 2){
								$msg_e =  "Ooops, you have insufficient balance to perform this transaction";
							}elseif($return_query == 3){
								$msg_e =  "Ooops, select a debit or credit transaction to perform";
							}elseif($return_query == 4){
								$msg_e =  "Ooops, an error has occur while to save expenditure 4. Please try again";
							}else{
								$msg_e =  "Ooops, an error has occur while to save expenditure. Please try again";
							}
							
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'>  hidePageLoader(); </script>";exit;
							
						}

					}catch(PDOException $e) {
			
						fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
				
					}   
		

                }else{


					$msg_e = "* Ooops Error, your expense table is empty";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'> hidePageLoader(); </script>"; exit;


				}
				      		
		
			}
		
		}elseif ($_REQUEST['query'] == 'update2') {  /* update school expenses */

			$eid = cleanInt($_REQUEST['eid']);			
			$pid = cleanInt($_REQUEST['pid']);
			$title =  clean($_REQUEST['title']);
			$memo = $_REQUEST['memo'];
			$total = clean($_REQUEST['total']);
			$method = cleanInt($_REQUEST['method']);
			$edate = $_REQUEST['edate'];
			
			/* script validation */
							
			if ($eid == ""){
				
				$msg_e = "* Ooops, aan error has occur to retrieve expenditure information. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($pid == "")  {
				
				$msg_e = "* Ooops Error, please select expenditure category";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($total == "")  {
				
				$msg_e = "* Ooops Error, please enter expenditure amount";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($memo == "")  {
				
				$msg_e = "* Ooops Error, please select expenditure details";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($method == "")  {
				
				$msg_e = "* Ooops Error, please select a expenditure method";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}elseif ($edate == "")  {
				
				$msg_e = "* Ooops Error, please select a expenditure date";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}else {   /* update information */     			
			
				$memo = strip_tags($memo);
				$memo = str_replace('<br />', "\n", $memo);
				$memo = htmlspecialchars($memo); 

				try { 
					
					$ebele_mark = "UPDATE $fobrainExpenseTB  
										
										SET 
										
										pid = :pid, 
										total = :total, 
										title = :title,
										method = :method,		
										memo = :memo,
										edate = :edate
										
									WHERE eid = :eid";
					
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':eid', $eid);
					$igweze_prep->bindValue(':pid', $pid);
					$igweze_prep->bindValue(':total', $total);
					$igweze_prep->bindValue(':title', $title);
					$igweze_prep->bindValue(':method', $method);
					$igweze_prep->bindValue(':memo', $memo);
					$igweze_prep->bindValue(':edate', $edate); 
					
					if($igweze_prep->execute()){  /* if sucessfully */ 
						
						$msg_s = "School Expenditure was successfully saved."; 
						echo $succesMsg.$msg_s.$sEnd; 
						echo "<script type='text/javascript'> 
								$('#load-expenditure').load('expense-info.php');
								hidePageLoader();  
						</script>";exit;
						
					}else{  /* display error */ 
			
						$msg_e =  "Ooops, an error has occur while to save expenditure. Please try again";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
						
					}
					

				}catch(PDOException $e) {
		
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
				} 
		
			}
		
		}elseif ($_REQUEST['query'] == 'remove') {  /* remove school expenses */ 
			
			$expense = $_REQUEST['rData']; 
			$adminPass =   clean($_REQUEST['adminPass']);  

			$checkDetail =  staffLoginData($conn, $_SESSION['adminUser']);  /* school staffs/teachers password details */ 			 
			list ($tID, $staffUser, $checkedPass, $staffName, $staff_fobrain_grdQ, $userGrade, $userAccess) = 
			explode ("@(.$*S*$.)@", $checkDetail);
			
			list($fobrainIg, $eid, $hName) = explode("-", $expense);			
			
			/* script validation */ 
			
			if (($expense == "")  || ($eid == "")){
				
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
					
									$fobrainExpenseTB										
										
									WHERE eid = :eid
										
									LIMIT 1";
					
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':eid', $eid); 
					
					if($igweze_prep->execute()){  /* if sucessfully */
						
						$removeDiv = "$('#row-".$eid."').fadeOut(1000);";
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

			
			$eid = strip_tags($_REQUEST['rData']);
			
			/* script validation */
			
			if ($eid == ""){
				
				$msg_e = "* Ooops, an error has occur while to retrieve expenditure information. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}else {   /* select information */      			


				try {
					
					
					$expensesInfoArr = expensesInfo($conn, $eid);  /* school expenses information */
					//$pid = $expensesInfoArr[$fiVal]["eid"];
					$pid = $expensesInfoArr[$fiVal]["pid"];
					$total = $expensesInfoArr[$fiVal]["total"];
					$title = $expensesInfoArr[$fiVal]["title"];
					$memo = htmlspecialchars_decode($expensesInfoArr[$fiVal]["memo"]);
					$method = $expensesInfoArr[$fiVal]["method"];
					$edate = $expensesInfoArr[$fiVal]["edate"];						
							
					$expenseCategoryInfoArr = expenseCategoryInfo($conn, $pid);  /* school expenses category information */
					$expenseCategory = $expenseCategoryInfoArr[$fiVal]['expense'];
					
					$payMethod = $paymentMethodArr[$method];				
					$edate = date("j F Y", strtotime($edate));						
					$amount = fobrainCurrency($total, $curSymbol);						
					$memo = nl2br($memo);
								

$showExpenses =<<<IGWEZE
	
					
						<div class="row gutters mb-10">
							<div class="text-end">
								<button  class="btn btn-primary" onclick="printDiv('fobrain-print-ovly')">
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