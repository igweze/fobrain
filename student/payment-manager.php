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
	This script handle school fees information
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}
  
		define('fobrain', 'igweze');  /* define a check for wrong access of file */ 
		require 'fobrain-config.php';  /* load fobrain configuration files */

		//$method = 2; 
				
		if ($_REQUEST['payment'] == 'save') {  /* save fees */
			
			$feeCat = clean($_REQUEST['feeCat']); 
			$level =  $_REQUEST['level']; 
			$term = cleanInt($_REQUEST['term']);
			$amountPaid = $_REQUEST['amountPaid'];
			$method = clean($_REQUEST['payMethod']);  
			$pDay = $_REQUEST['pDay'];	
			$pstatus = cleanInt($_REQUEST['pstatus']);	
			
			$class = "";
			
			list($feeCID, $feeAmount, $fee_account) = explode("-", $feeCat);				
			
			$feeAmountCur = fobrainCurrency($feeAmount, $curSymbol);  /* school currency information*/
			$amountPaidCur = fobrainCurrency($amountPaid, $curSymbol);  /* school currency information*/

			$update_record = false; $update_next = false;

			if($method != "bank"){ 
				$pDay = date("Y-m-d"); 
			}

			if($method == "bank"){  
				$script_btn = "$('#feePayBank').fadeIn(1000);";
			}else{ 
				$script_btn = "$('#feePayOnline').fadeIn(1000);";
			} 
			
			/* script validation */
			
			if ($feeCat == "")  {

				$msg_e = "* Ooops Error, please select fee category";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> $('#wiz-loader-2').fadeOut(2000); $script_btn </script>";exit;
				
			}elseif ($fee_account == "")  {

				$msg_e = "* Ooops Error, please notify school admin to link this payment to a School Account";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> $('#wiz-loader-2').fadeOut(2000); $script_btn </script>";exit;
				
			}elseif ($level == "")  {

				$msg_e = "* Ooops Error, please select student payment level";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> $('#wiz-loader-2').fadeOut(2000); $script_btn </script>";exit;
				
			}elseif ($term == "")  {

				$msg_e = "* Ooops Error, please select payment term";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> $('#wiz-loader-2').fadeOut(2000); $script_btn </script>";exit;
				
			}elseif ($amountPaid == "")  {

				$msg_e = "* Ooops Error, please enter payment amount";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> $('#wiz-loader-2').fadeOut(2000); $script_btn </script>";exit;
				
			}elseif ($amountPaid > $feeAmount)  {

				$msg_e = "* Ooops Error, your payment amount  <strong>$amountPaidCur</strong> entered is greater than  fee amount <strong>$feeAmountCur</strong>";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> $('#wiz-loader-2').fadeOut(2000); $script_btn </script>";exit;
				
			}elseif ($method == "")  {

				$msg_e = "* Ooops Error, please select a payment method";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> $('#wiz-loader-2').fadeOut(2000); $script_btn </script>";exit;
				
			}elseif ($pDay == "")  {

				$msg_e = "* Ooops Error, please select a payment date";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> $('#wiz-loader-2').fadeOut(2000); $script_btn </script>";exit;
				
			}else {   /* insert information */   						
			
				$checkFeeArr = checkFeeExits($conn, $regNum, $regID, $schoolID, $level, $term);  /* school fee array */
				$update_record = false; 
			 
				if(is_array($checkFeeArr)){

					$fID_ch = $checkFeeArr[$fiVal]["fID"];
					$fStatus_ch = $checkFeeArr[$fiVal]["f_status"];
					$confirm_ch = $checkFeeArr[$fiVal]["pstatus"];
					$balance_ch = $checkFeeArr[$fiVal]["balance"]; 

					if(($fStatus_ch  == 1) && ($confirm_ch  == 2)){ 
						
						$update_record = false; $update_next = false;
						$msg_i = "* Ooops, your have already paid fully for this Level and Term. Your payment have been approved";
						echo $infoMsg.$msg_i.$iEnd; 
						echo "<script type='text/javascript'> $('#wiz-loader-2').fadeOut(2000); $script_btn </script>";exit;
	
					}elseif(($fStatus_ch  == 1) && ($confirm_ch  == 1)){ 
						
						$update_record = false; $update_next = false;
						$msg_i = "* Ooops, your have already paid fully for this Level and Term. Your payment is still pending";
						echo $infoMsg.$msg_i.$iEnd; 
						echo "<script type='text/javascript'> $('#wiz-loader-2').fadeOut(2000); $script_btn </script>";exit;
	
					}elseif(($fStatus_ch  == 0) && ($confirm_ch  == 3)){ 
						
						$update_record = false; $update_next = false;
						$msg_i = "* Ooops, your previous part payment for this Level and Term was Decline. Meanwhile, reach out to the school management.";
						echo $infoMsg.$msg_i.$iEnd; 
						echo "<script type='text/javascript'> $('#wiz-loader-2').fadeOut(2000); $script_btn </script>";exit;
	
					}elseif(($fStatus_ch  == 1) && ($confirm_ch  == 3)){ 
						
						$update_record = false; $update_next = false;
						$msg_i = "* Ooops, your previous full payment for this Level and Term was Decline. Meanwhile, reach out to the school management.";
						echo $infoMsg.$msg_i.$iEnd; 
						echo "<script type='text/javascript'> $('#wiz-loader-2').fadeOut(2000); $script_btn </script>";exit;
	
					}elseif(($amountPaid < $balance_ch) || ($amountPaid != $balance_ch)){
	
						$update_record = false; $update_next = false;
						$balance_ch = fobrainCurrency($balance_ch, $curSymbol);  /* school currency information*/ 						
						$msg_i = "* Ooops, your balance to pay is $balance_ch. Payment is not accepted. Amount ($amountPaidCur) to be paid should be the same with your balance";
						echo $infoMsg.$msg_i.$iEnd; 
						echo "<script type='text/javascript'> $('#wiz-loader-2').fadeOut(2000); $script_btn </script>";exit;
	
					}elseif(($fStatus_ch  == 0) && ($confirm_ch  == 1)){
	
						$update_record = true; $update_next = true;
	
					}elseif(($fStatus_ch  == 0) && ($confirm_ch  == 2)){
	
						$update_record = true; $update_next = true;
	
					}else{
	
						$update_record = false; $update_next = false;
	
					} 

				}else{

					$update_record = false;

				}
				
				$method = 2;

				$feeAmount = trim($feeAmount);
				$payDetails = strip_tags($payDetails);
				$payDetails = str_replace('<br />', "\n", $payDetails);
				$payDetails = htmlspecialchars($payDetails);

				if ($amountPaid < $feeAmount)  {
					$fbalance = ($feeAmount - $amountPaid);
				}	 
					
				if(($fbalance >= 1) && ($update_next == false)){

					$pbal_status = $i_false;
					$balanceCur = fobrainCurrency($fbalance, $curSymbol);  /* school currency information*/
					$msgC = " Meanwhile, <strong>$regNum</strong> you have a balance of <strong>$balanceCur</strong> to pay up.";

				}else{

					$pbal_status = $fiVal;
					$fbalance = ""; $msgC = "";
					
				} 

				$name = $_FILES['payupload']['name']; 

				if(strlen($name)) {
					
					$picturePath = $fobrainPaymentDir; /* picture path */
					
					$filePic = "payupload"; /* picture file name */
					$pageDesc = "Payment Proof Picture";
					
					/* call igweze file uploader */
					$uploadPicData = igwezeFileUploader($filePic, $picturePath, ($oneMB * 1), $validPicExt, $validPicType, $allowedPicExt, 
					$fileType = "Picture", $fiVal); 
						
					if (is_array($uploadPicData['error'])) {  /* check if any upload error */
							
						$msg_e = '';
							
						foreach ($uploadPicData['error'] as $msg) {
							$msg_e .= $msg.'<br />';     /* display error messages */
						}
						
						echo $errorMsg.$msg_e.$eEnd; exit;
						
						
					} else {
						
						$uploadedPic = $uploadPicData['refilename']; /* uploaded picture file */
						
						if ($uploadedPic != "") {
								
							if (move_uploaded_file($_FILES[$filePic]['tmp_name'], $picturePath.$uploadedPic )) { /* move uploaded file to its path */
									
									
								try {  

									if($update_next == true){
										 
										$ebele_mark = "UPDATE $fobrainFeesTB  
															
															SET   
															  
															method2 = :method2, 
															amount2 = :amount2, 
															balance = :balance,  
															date2 = :date2, 
															f_status = :f_status,
															pstatus2 = :pstatus2,
															n_pay = :n_pay,
															upload2 = :upload2
															
														WHERE fID = :fID";
										
										$igweze_prep = $conn->prepare($ebele_mark); 
										$igweze_prep->bindValue(':method2', $method);
										$igweze_prep->bindValue(':amount2', $amountPaid);
										$igweze_prep->bindValue(':balance', $fbalance);
										$igweze_prep->bindValue(':date2', $pDay);
										$igweze_prep->bindValue(':f_status', $pbal_status); 
										$igweze_prep->bindValue(':pstatus2', $fiVal);
										$igweze_prep->bindValue(':n_pay', $seVal);
										$igweze_prep->bindValue(':upload2', $uploadedPic); 
										$igweze_prep->bindValue(':fID', $fID_ch);

									}else{

										$ebele_mark = "INSERT INTO $fobrainFeesTB  (acc, feeCat, feeAmount, session, reg_id, regNo, stype, level, class, term, method, 
														amount, balance, date, f_status, pstatus, upload)

												VALUES (:acc, :feeCat, :feeAmount, :session, :reg_id, :regNo, :stype, :level, :class, :term, :method, 
														:amount, :balance, :date, :f_status, :pstatus, :upload)";
										
										$igweze_prep = $conn->prepare($ebele_mark);
										$igweze_prep->bindValue(':acc', $fee_account);
										$igweze_prep->bindValue(':feeCat', $feeCID);
										$igweze_prep->bindValue(':feeAmount', $feeAmount);
										$igweze_prep->bindValue(':session', $sessionID);
										$igweze_prep->bindValue(':reg_id', $regID);
										$igweze_prep->bindValue(':regNo', $regNum);
										$igweze_prep->bindValue(':stype', $schoolID);
										$igweze_prep->bindValue(':level', $level);
										$igweze_prep->bindValue(':class', $class);
										$igweze_prep->bindValue(':term', $term);
										$igweze_prep->bindValue(':method', $method); 
										$igweze_prep->bindValue(':amount', $amountPaid);
										$igweze_prep->bindValue(':balance', $fbalance);
										//$igweze_prep->bindValue(':waiver', $waiver);
										//$igweze_prep->bindValue(':efine', $efine);
										$igweze_prep->bindValue(':date', $pDay);
										$igweze_prep->bindValue(':f_status', $pbal_status); 
										$igweze_prep->bindValue(':pstatus', $fiVal);
										$igweze_prep->bindValue(':upload', $uploadedPic);  
									 
									}

									if($igweze_prep->execute()){ /* insert picture name to database */ 

										$msg_s = "Payment was successfully submiited, your payments is pending until approved by Bursary.$msgC"; 
										echo $succesMsg.$msg_s.$sEnd; 
										echo "<script type='text/javascript'>  
												$('#frmpayFee')[0].reset();
												$('#wiz-loader-2').fadeOut(2000); $script_btn  
											</script>";exit;
										
									}else{ /* display error messages */
										
										$msg_e =  "Ooops, an error has occur while to submit payment. Please try again";
										echo $errorMsg.$msg_e.$eEnd; 
										echo "<script type='text/javascript'> $('#wiz-loader-2').fadeOut(2000); $script_btn </script>";exit;
										
									}
									

								}catch(PDOException $e) {
									
									fobrainDie( 'Ooops Database Error: ' . $e->getMessage());

								}
									
									
							}else{ /* display error messages */
								
								$msg_e = "Ooops, an error has occur while trying to save $pageDesc. Please try again or check your network connection!!!";
								echo $errorMsg.$msg_e.$eEnd; exit; 
									
							}
								
						}else{ /* display error messages */
							
							$msg_e = "Ooops, an error has occur while trying to save $pageDesc. Please try again or check your network connection!!!";
							echo $errorMsg.$msg_e.$eEnd; exit;							

						}	
						
						
					} 

				}else{

					try{
						if($update_next == true){
											
							$ebele_mark = "UPDATE $fobrainFeesTB  
												
												SET   
												
												method2 = :method2, 
												amount2 = :amount2, 
												balance = :balance,  
												date2 = :date2, 
												f_status = :f_status,
												pstatus2 = :pstatus2,
												n_pay = :n_pay
												
											WHERE fID = :fID";
							
							$igweze_prep = $conn->prepare($ebele_mark); 
							$igweze_prep->bindValue(':method2', $method);
							$igweze_prep->bindValue(':amount2', $amountPaid);
							$igweze_prep->bindValue(':balance', $fbalance);
							$igweze_prep->bindValue(':date2', $pDay);
							$igweze_prep->bindValue(':f_status', $pbal_status); 
							$igweze_prep->bindValue(':pstatus2', $fiVal);
							$igweze_prep->bindValue(':n_pay', $seVal);
							$igweze_prep->bindValue(':fID', $fID_ch);

						}else{

							$ebele_mark = "INSERT INTO $fobrainFeesTB  (acc, feeCat, feeAmount, session, reg_id, regNo, stype, level, class, term, method, 
											amount, balance, date, f_status, pstatus)

									VALUES (:acc, :feeCat, :feeAmount, :session, :reg_id, :regNo, :stype, :level, :class, :term, :method, 
											:amount, :balance, :date, :f_status, :pstatus)";
							
							$igweze_prep = $conn->prepare($ebele_mark);
							$igweze_prep->bindValue(':acc', $fee_account);
							$igweze_prep->bindValue(':feeCat', $feeCID);
							$igweze_prep->bindValue(':feeAmount', $feeAmount);
							$igweze_prep->bindValue(':session', $sessionID);
							$igweze_prep->bindValue(':reg_id', $regID);
							$igweze_prep->bindValue(':regNo', $regNum);
							$igweze_prep->bindValue(':stype', $schoolID);
							$igweze_prep->bindValue(':level', $level);
							$igweze_prep->bindValue(':class', $class);
							$igweze_prep->bindValue(':term', $term);
							$igweze_prep->bindValue(':method', $method); 
							$igweze_prep->bindValue(':amount', $amountPaid);
							$igweze_prep->bindValue(':balance', $fbalance); 
							$igweze_prep->bindValue(':date', $pDay);
							$igweze_prep->bindValue(':f_status', $pbal_status); 
							$igweze_prep->bindValue(':pstatus', $fiVal); 
						
						}

						if($igweze_prep->execute()){ /* insert picture name to database */
							
							$msg_s = "Payment was successfully submiited, your payments is pending until approved by Bursary.$msgC"; 
							echo $succesMsg.$msg_s.$sEnd; 
							echo "<script type='text/javascript'> 
									//$('#frmpayFee')[0].reset();
									$('#frmpayFee').slideUp(2000);
									$('#wiz-loader-2').fadeOut(2000); 
									//$script_btn  
								</script>";exit;
							
						}else{ /* display error messages */
							
							$msg_e =  "Ooops, an error has occur while to submit payment. Please try again";
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'> $('#wiz-loader-2').fadeOut(2000); $script_btn </script>";exit;
							
						}

					}catch(PDOException $e) {

						fobrainDie( 'Ooops Database Error: ' . $e->getMessage());

					}	 

				}	
		
			}
		
		}elseif ($_REQUEST['payment'] == 'validate') {  /* save fees */
                
			$feeCat = clean($_REQUEST['feeCat']); 
			$level =  $_REQUEST['level']; 
			$term = cleanInt($_REQUEST['term']);
			$amountPaid = $_REQUEST['amountPaid'];
			$method = clean($_REQUEST['method']);
			$pDay = $_REQUEST['pDay'];	  
		 		
			list($feeCID, $feeAmount, $fee_account) = explode("-", $feeCat);		
			
			$feeAmountCur = fobrainCurrency($feeAmount, $curSymbol);  /* school currency information*/
			$amountPaidCur = fobrainCurrency($amountPaid, $curSymbol);  /* school currency information*/
			
			if($method == "bank"){  
				$script_btn = "$('#feePayBank').fadeIn(1000);";
			}else{ 
				$script_btn = "$('#feePayOnline').fadeIn(1000);";
			}

			/* script validation */
			
			if ($feeCat == "")  { 
				
				$msg_e = "* Ooops Error, please select fee category";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> $('#wiz-loader-2').fadeOut(2000); $script_btn </script>";exit;
				
			}elseif ($fee_account == "")  {

				$msg_e = "* Ooops Error, please notify school admin to link this payment to a School Account";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> $('#wiz-loader-2').fadeOut(2000); $script_btn </script>";exit;
				
			}elseif ($amountPaid == "")  { 
				
				$msg_e = "* Ooops Error, please enter payment amount";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> $('#wiz-loader-2').fadeOut(2000); $script_btn </script>";exit;
				
			}elseif ($amountPaid > $feeAmount)  { 
				
				$msg_e = "* Ooops Error, your payment amount  <strong>$amountPaidCur</strong> entered is greater than  fee amount <strong>$feeAmountCur</strong>";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> $('#wiz-loader-2').fadeOut(2000); $script_btn </script>";exit;
				
			}elseif ($level == "")  { 
				
				$msg_e = "* Ooops Error, please select student payment level";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> $('#wiz-loader-2').fadeOut(2000); $script_btn </script>";exit;
				
			}elseif ($term == "")  { 
				
				$msg_e = "* Ooops Error, please select payment term";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> $('#wiz-loader-2').fadeOut(2000); $script_btn </script>";exit;
				
			}elseif ($method == "")  { 
				
				$msg_e = "* Ooops Error, please select a payment method";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> $('#wiz-loader-2').fadeOut(2000); $script_btn </script>";exit;
				
			}else {   /* insert information */   						
			
				$checkFeeArr = checkFeeExits($conn, $regNum, $regID, $schoolID, $level, $term);  /* school fee array */
				$update_record = false;
				$update_next = false;
	 
				if(is_array($checkFeeArr)){
					
					$fStatus_ch = $checkFeeArr[$fiVal]["f_status"];
					$confirm_ch = $checkFeeArr[$fiVal]["pstatus"];
					$balance_ch = $checkFeeArr[$fiVal]["balance"]; 
	
					if(($fStatus_ch  == 1) && ($confirm_ch  == 2)){ 
						
						$update_record = false; $update_next = false;
						$msg_i = "* Ooops, your have already paid fully for this Level and Term. Your payment have been approved";
						echo $infoMsg.$msg_i.$iEnd; 
						echo "<script type='text/javascript'> $('#wiz-loader-2').fadeOut(2000); $script_btn </script>";exit;
	
					}elseif(($fStatus_ch  == 1) && ($confirm_ch  == 1)){ 
						
						$update_record = false; $update_next = false;
						$msg_i = "* Ooops, your have already paid fully for this Level and Term. Your payment is still pending";
						echo $infoMsg.$msg_i.$iEnd; 
						echo "<script type='text/javascript'> $('#wiz-loader-2').fadeOut(2000); $script_btn </script>";exit;
	
					}elseif(($fStatus_ch  == 0) && ($confirm_ch  == 3)){ 
						
						$update_record = false; $update_next = false;
						$msg_i = "* Ooops, your previous part payment for this Level and Term was Decline. Meanwhile, reach out to the school management.";
						echo $infoMsg.$msg_i.$iEnd; 
						echo "<script type='text/javascript'> $('#wiz-loader-2').fadeOut(2000); $script_btn </script>";exit;
	
					}elseif(($fStatus_ch  == 1) && ($confirm_ch  == 3)){ 
						
						$update_record = false; $update_next = false;
						$msg_i = "* Ooops, your previous full payment for this Level and Term was Decline. Meanwhile, reach out to the school management.";
						echo $infoMsg.$msg_i.$iEnd; 
						echo "<script type='text/javascript'> $('#wiz-loader-2').fadeOut(2000); $script_btn </script>";exit;
	
					}elseif(($amountPaid < $balance_ch) || ($amountPaid != $balance_ch)){
	
						$update_record = false; $update_next = false;
						$balance_ch = fobrainCurrency($balance_ch, $curSymbol);  /* school currency information*/ 						
						$msg_i = "* Ooops, your balance to pay is $balance_ch. Payment is not accepted. Amount ($amountPaidCur) to be paid should be the same with your balance";
						echo $infoMsg.$msg_i.$iEnd; 
						echo "<script type='text/javascript'> $('#wiz-loader-2').fadeOut(2000); $script_btn </script>";exit;
	
					}elseif(($fStatus_ch  == 0) && ($confirm_ch  == 1)){
	
						$update_record = true; $update_next = true;
	
					}elseif(($fStatus_ch  == 0) && ($confirm_ch  == 2)){
	
						$update_record = true; $update_next = true;
	
					}else{
	
						$update_record = false; $update_next = false;
	
					}
	
				}else{
	
					$update_record = true; $update_next = false;
	
				}

				if($update_record == true){

					if($method == "bank"){
 
						echo "<script type='text/javascript'> 
									setTimeout(function() {
										$('#feePayBankBtn').click();
									}, 5000);	 
								</script>"; exit; 

					}else{

						$productDesc = "Tuition Fees Testing";
						$total = $amountPaid; 
						$isCart = 0;

						$billingData = billingData($conn, $regNum);
						list($nameFull, $address, $city, $state, $country, $phone) = explode("##", $billingData);

						require_once $fobrainPayG; 

						if($method == "paystack"){

							echo "<script type='text/javascript'> 
									setTimeout(function() {
										$('#paystackBtn').click();
									}, 5000);	 
								</script>"; exit; 

						}elseif($method == "paypal"){ 

							echo "<script type='text/javascript'> 
									setTimeout(function() {
										$('#paypalBtn').click();
									}, 5000);	 
								</script>"; exit; 

						}elseif($method == "2checkout"){  

							echo "<script type='text/javascript'> 
									setTimeout(function() {
										$('#2checkoutBtn').click();
									}, 5000);	 
								</script>"; exit;  
						
						}else{

							$msg_i = "* Ooops Error, could not be able to retrieve our payment gateways";
							echo $infoMsg.$msg_i.$iEnd;
							echo "<script type='text/javascript'> $('#wiz-loader-2').fadeOut(2000); $script_btn </script>";exit;

						}	

					} 

				}else{

					$msg_i = "* Ooops Error, could not be able make payments at the moment";
					echo $infoMsg.$msg_i.$iEnd;
					echo "<script type='text/javascript'> $('#wiz-loader-2').fadeOut(2000); $script_btn </script>";exit;

				}


			}	
	
		}else{
					
			echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
		
		}

		
exit;
?>