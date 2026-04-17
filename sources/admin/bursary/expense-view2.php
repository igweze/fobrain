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
	This script handle expense add
	------------------------------------------------------------------------*/

	if (!defined('fobrain'))

	die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');

	$eid = $_REQUEST['rData'];
			
	/* script validation */ 
	
	if ($eid == ""){
		
		$msg_e = "* Ooops, an error has occur while to retrieve expenditure information. Please try again";
		echo $errorMsg.$msg_e.$eEnd; 
		echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
		
	}else {     
	 
		try {  
			
			//cleanExpenseDocs($conn);  
			$options = "<select class='form-control'  id='' name=''>".expenseOptions($conn, $eid, 1)."</select>";

			$expensesArr = expensesInfo($conn, $eid);  /* school expenses information */

			$id = $expensesArr[$fiVal]["eid"];
			$pageID = $expensesArr[$fiVal]["pid"];
			$title = $expensesArr[$fiVal]["title"];
			$payee = $expensesArr[$fiVal]["payee"];
			$accID = $expensesArr[$fiVal]["acc"];
			$expenseArray = unserialize($expensesArr[$fiVal]["expense"]);
			$total = $expensesArr[$fiVal]["total"];
			$method = $expensesArr[$fiVal]["method"];
			$tags = $expensesArr[$fiVal]["tags"]; 
			$memo = htmlspecialchars_decode($expensesArr[$fiVal]["memo"]); 
			$edate = $expensesArr[$fiVal]["edate"];
			$rtime = $expensesArr[$fiVal]["rtime"];
			$status = $expensesArr[$fiVal]["status"];  

		}catch(PDOException $e) {

			fobrainDie( 'Ooops Database Error: ' . $e->getMessage());

		}    

		echo '<div class="row gutters my-10">
                <div class="col-12">';

				$page_title = '<i class="mdi mdi-cash-register fs-18"></i> 
							Expense Manager';
						pageTitle($page_title, 0);
                    
            echo    '</div>	
			</div>';
	
				
?>
 
                    
		<!-- row -->
		<div class="row gutters">	
			<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">										
				<!-- field wrapper start -->
				<div class="field-wrapper">
					<input type="text" class="form-control" placeholder="Enter Title" 
					name="title"  id="title" value="<?php echo $title; ?>">
					<div class="field-placeholder">  Title <span class="text-danger">*</span></div>													
				</div>
				<!-- field wrapper end -->
			</div>
			<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">										
				<!-- field wrapper start -->
				<div class="field-wrapper">
					<input type="text" class="form-control" placeholder="Enter Payee" 
					name="payee"  id="payee" value="<?php echo $payee; ?>">
					<div class="field-placeholder">  Payee <span class="text-danger">*</span></div>													
				</div>
				<!-- field wrapper end -->
			</div>
			<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 display-none">	
				
				<div class="input-group-text fw-700" >
					Balance - <span id="balance_div" class="ms-10"></span>
				</div>

				<!-- field wrapper start -->
				<div class="field-wrapper select-wrapper">		
													
					<select class="form-control fob-select-2"  id="bank_acc" name="bank_acc">

						<option value = "">Please select One</option>

						<?php


						try {

							$bank_dataArr = bankAccountData($conn);  /* school expenses category array */
							$bank_dataCount = count($bank_dataArr);
							
						}catch(PDOException $e) {
						
								fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
						
						}		
					
						if($bank_dataCount >= $fiVal){	/* check array is empty */	 

							for($i = $fiVal; $i <= $bank_dataCount; $i++){	/* loop array */	
							
								$bid = $bank_dataArr[$i]["bid"];
								$acc = trim($bank_dataArr[$i]["acc"]);
								$bal = trim($bank_dataArr[$i]["balance"]);
								
								//$b_value = $bid.'#fob#'.$bal; 
								if ($bid == $accID){ 
									$selected = "SELECTED"; 
								} else { 
									$selected = ""; 
								}
								
								echo '<option value="'.$bid.'"'.$selected.'> '.$acc.'</option>' ."\r\n";

							}

						}else{
							
							echo '<option value="">Ooops Error, no bank account found.</option>' ."\r\n"; 
							
						}	

						?> 
					</select> 
					<div class="icon-wrap"  id="wait_bal" style="display: none;">
						<i class="loader"></i>
					</div> 
					<div class="field-placeholder"> Payment Account <span class="text-danger">*</span></div>													
				</div>
				<!-- field wrapper end -->
			</div>   
		</div>	
		<!-- /row -->	
		
		<!-- row -->
		<div class="row gutters">	    

			<div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">										
				<!-- field wrapper start -->
				<div class="field-wrapper">
					<input type="date"  name="edate" id="edate" value="<?php echo $edate; ?>" />
					<div class="field-placeholder"> Payment Date: <span class="text-danger"></span></div>													
				</div>
				<!-- field wrapper end -->
			</div>
			
			<div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">										
				<!-- field wrapper start -->
				<div class="field-wrapper">
					<select class="form-control fob-select-2"  id="method" name="method">

						<option value = "">Please select One</option>

						<?php

						foreach($paymentMethodArr as $methodKey => $methodVal){  /* loop array */

							if ($method == $methodKey){

								$selected = "SELECTED";

							} else {

								$selected = "";

							}

							echo '<option value="'.$methodKey.'"'.$selected.'>'.$methodVal.'</option>' ."\r\n";

						}

						?> 

					</select>
					<div class="field-placeholder">  Method <span class="text-danger">*</span></div>													
				</div>
				<!-- field wrapper end -->													 													
			</div> 
			
		</div>	
		<!-- /row --> 

		<!-- row -->
		<div class="row gutters">
			<div class="col-12">
				<div class="table-responsive"> 
					<div id="table-wrapper">


						<!-- table -->
						<table  id='fob-calculate-tb' class='table table-hover table-responsive style-table wiz-table'>
						
						<thead>
							<tr id='cal-hd'>
								<th>S/N</th> 
								<th>Category</th> 
								<th>Description</th>
								<th>Rate</th>
								<th>Qty (<?php echo $curSymbol ?>)</th>
								<th>Total (<?php echo $curSymbol ?>)</th>
								<th><a href='javascript:;' class = 'fs-13 text-primary  display-none' id='add-row'> <i class='mdi mdi-book-plus-outline'></i> Add<a></th>
							</tr>
						</thead> 
						<tbody id='cal-body'>



				<?php 

				if(is_array($expenseArray)){ 

					$in = 0; $sn = 1; $grandtotal = 0;
					$options2 = "";
					foreach ($expenseArray as $input_row) { 
					
						$cat = $expenseArray[$in]['cat'];
						$desc = $expenseArray[$in]['desc'];
						$qty = $expenseArray[$in]['qty'];
						$rate = $expenseArray[$in]['rate'];
						$amount = $expenseArray[$in]['amount'];  
						
						$row_total = ($qty * $rate);	

						$options2 .=" <select class='form-control fob-select-2a'  
									id='expense-cate' name='expense-cate'>";
						try {
						
							$options2 .= expenseOptions($conn, $cat, 1);
							
						}catch(PDOException $e) {

							fobrainDie( 'Ooops Database Error: ' . $e->getMessage());

						}

						$options2 .= "</select>";

$row_cells =<<<IGWEZE

						<tr>
							<td>$sn</td> 
							<td>
								$options2
							</td> 
							<td>
								<input type='text' value="$desc" class='tr-desc form-control'>
							</td>
							<td>
								<input type='text' value="$qty" class='tr-qty form-control input-bk-qty' onkeyup='calculateTotal()'>
							</td>
							<td>
								<input type='text' value="$rate" class='tr-rate form-control input-bk-rt' onkeyup='calculateTotal()'
							</td>
							<td>
								<input type='text' value="$row_total" class='tr-total form-control input-amount' disabled></td>
							</td>
							<td>
								<a href='javascript:;' class = 'fs-13 text-danger remove-row2  display-none'> <i class='mdi mdi-book-remove-outline'></i> Remove<a>
							</td>
						</tr>

IGWEZE;
				
						echo $row_cells; 
						
						$options2 = "";	 $cat = ""; $desc = ""; $qty = "";
						$rate = ""; $amount = "";   

						$in++;  $sn++; 	 

					}
					
				}	 


						

				?>	

									
							</tbody>
						</table>				
						<!-- / table -->

					</div>
				</div>	
			</div>

			<div class="col-10 text-end text-primary" style="position:relative; top:-50px;">
				Grand Total - <?php echo $curSymbol ?> <span id="divGrandTotal" class="ms-10q"><?php echo $total; ?></span>  
			</div>
			
		</div>	
		<!-- /row -->  

		<?php 

			try {

				accountJournalTB($conn, $id, $transact_expense);  /* account Journal table */ 

			}catch(PDOException $e) {

				fobrainDie( 'Ooops Database Error: ' . $e->getMessage());

			}
		?>

		<!-- row -->
		<div class="row gutters">
			
			<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">	  
				<!-- field wrapper start -->
				<div class="field-wrapper">
					<input type="text"  name="tags" id="e-tags"   class="form-control"
					value="<?php echo $tags; ?>" autocomplete="off" placeholder="Enter expense tags " />
					<div class="field-placeholder"> Tags <span class="text-danger"></span></div>													
				</div>
				<!-- field wrapper end -->
			</div>

			<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">										
				<!-- field wrapper start -->
				<div class="field-wrapper">
					<textarea rows="4" cols="10" class="form-control" name="memo" id="memo" 
					placeholder="memo here"><?php echo $memo; ?></textarea>  
					<div class="field-placeholder"> Memo </div>
						
				</div>
				<!-- field wrapper end -->
			</div>

			<div class="col-12 mt-30">	 
				<div class="row">	 
					<div class="col-6">
						<h6 class="text-primary">Attachments (<span class="attach-counter">0</span>) </h6> 
					</div> 
					<div class="col-6 text-end">										
						<!-- form -->
						<form id="frmExpenseUpload" method="post" enctype="multipart/form-data"> 
							<input type="hidden" name="query" value="upload" />
							<input type="hidden" name="status" value="1" /> 
							<input type="hidden" name="pid" id="pid" value="<?php echo $pageID; ?>" />
							<!--
							<label class="upload upload-expense-div display-none">
								<i class="fas fa-upload fs-14 text-danger me-1"></i>  <span class="fs-14 text-primary">Add</span>															
								<input type="file" name="attach" id="upload-expense" class="form-control hide"/>
							</label>  
							-->
							<div class="display-none text-danger upload-loader"> 
								<strong role="status">Processing...</strong>
								<div class="spinner-border ms-auto" aria-hidden="true"></div>
							</div> 
						</form>
						<!-- / form --> 
					</div>  
					
				</div>

				<div class="row mt-10"> 
													
					<di class="doc-upload-holder"> 
															
						<div id="preview-upload" class="col-lg-12">

							<?php 
							
								try {  

									$rem_icon = $fobrainTemplate.'images/icon_del.gif';				
									expenseDocs($conn, $pageID, $rem_icon);

								}catch(PDOException $e) {

									fobrainDie( 'Ooops Database Error: ' . $e->getMessage());

								}
							?>
						</div>												 
																
					</div> 
					
					<div class=" row c-wall-upload-div"> 
						<div class="col-lg-12 text-danger fs-10">
							* Maximum of 20 image per upload, picture size of 2 MB &amp; only
							<?php echo $allowedPicExt; ?> are allowed.
						</div>   
						
					</div> 	 
				</div> 	 

			</div> 
		
		</div>	
		<!-- /row -->	


		<hr class="mt-30 mb-15 text-danger" />
		<!-- row -->
		<div class="row gutters modal-btn-footer">
			<div class="col-6 text-start">
				<button type="button" id="close-modal" class="btn btn-danger close-modal" 
				data-bs-dismiss="modal"> <i class="mdi mdi-window-close label-icon"></i> Close</button>
			</div>
			<div class="col-6 text-end"> 
				<!--
				<input type="hidden" name="eid"  id="eid" value="<?php echo $eid; ?>" />
				<button type="submit" class="btn btn-primary waves-effect   
				btn-label waves-light"  onclick='updateExpense()'>
					<i class="mdi mdi-content-save label-icon"></i>  Save  
				</button>
				-->
			</div>
		</div>	
		<!-- /row -->  
		<div id="msg-box"'></div>
		<div class="refresh"> </div>

		<script type="text/javascript"> 
		
			$('.fob-select-2').each(function() {  
				renderSelect($('#'+this.id)); 
			});  

			new TomSelect("#e-tags",{
				plugins: {
					remove_button:{
						title:'Remove this item',
					}
				},
				persist: false,
				create: true,
				onDelete: function(values) {
					return confirm(values.length > 1 ? 'Are you sure you want to remove these ' + values.length + ' items?' : 'Are you sure you want to remove "' + values[0] + '"?');
				}
				
			});  


			$(function() {

				//createExpenseTable();  

				//$("#bank_acc").change();
				
				/*
				$("#add-row").click(function(){
					var table = document.getElementById("fob-calculate-tb");
					var rowCount = table.rows.length;
					var optionsBox = "<?php echo $options; ?>";
					var table = "<tr>"
							+ "<td>"+rowCount+"</td>"
							+ "<td>"+optionsBox+"</td>"
							+ "<td><input type='text' class='tr-desc form-control'></td>"
							+ "<td><input type='text' class='tr-qty form-control input-bk-qty' onkeyup='calculateTotal()'></td>"
							+ "<td><input type='text' class='tr-rate form-control input-bk-rt' onkeyup='calculateTotal()'></td>"
							+ "<td><input type='text' class='tr-total form-control input-amount' disabled></td>"
							+ "<td><a href='javascript:;' class = 'fs-13 text-danger remove-row'> <i class='mdi mdi-book-remove-outline'></i> Remove<a></td>"
								+ "</tr>";
							$("#fob-calculate-tb").append(table)
				
					$(".remove-row").on('click',function(){
						$(this).parent().parent().remove();
						calculateTotal();
						calculateGrandTotal();

					});
				});

				$('body').on('click','.remove-row2',function(event){ 
					event.stopImmediatePropagation();	
					$(this).parent().parent().remove();
					calculateTotal();
					calculateGrandTotal(); 
				});
				
				$(document).on("change", ".tr-total", function() {
					alert(1)
					var sum = 0;
					$(".tr-total").each(function(){
						sum += +$(this).val();
					});
					$(".divGrandTotal").val(sum);
				});
				
				$("#btnCreate").click(function(){
					$('#fob-calculate-tb').find('input').each(function() {
						$(this).replaceWith("" + this.value);
					});
				})
				*/
				
			});

			/*	
			function createExpenseTable() {
				var table = "";
				var optionsBox = "<?php echo $options; ?>";
				table += "<table id='fob-calculate-tb' class='table table-hover table-responsive style-table wiz-table'> <thead> "
					+ "<tr id='cal-hd'>"
					+ "<th>SN</th>"
					+ "<th>Category</th>"
					+ "<th>Description</th>"
					+ "<th>Qty</th>"
					+ "<th>Rate (<?php echo $curSymbol ?>)</th>"
					+ "<th>Total (<?php echo $curSymbol ?>)</th>"
					+ "<th><a href='javascript:;' class = 'fs-13 text-primary' id='add-row'> <i class='mdi mdi-book-plus-outline'></i> Add<a></th>"
					+ "</tr></thead> <tbody id='cal-body'>";
				table += "<tr>"
					+ "<td>1</td>"
					+ "<td>"
					+ optionsBox 
					+"</td>"
					+ "<td><input type='text' class='tr-desc form-control'></td>"
					+ "<td><input type='text' class='tr-qty form-control input-bk-qty' onkeyup='calculateTotal()'></td>"
					+ "<td><input type='text' class='tr-rate form-control input-bk-rt' onkeyup='calculateTotal()'></td>"
					+ "<td><input type='text' class='tr-total form-control input-amount' disabled></td>"
					+ "<td></td>"
					+ "</tr>";
				table += "</tbody></table>";
				$("#table-wrapper").html(table)
			}

			function calculateTotal() {
				var sum = 0.0;
				$('#fob-calculate-tb > tbody  > tr').each(function() {
						var qty = $(this).find('.tr-qty').val();
					var price = $(this).find('.tr-rate').val();
					var amount = (qty*price);
						$(this).find('.tr-total').val(''+amount);
					
					var sum1 = 0;
					$(".tr-total").each(function(){
						if($(this).val()!=null || $(this).val()!='')
						{
							sum1 += parseFloat($(this).val());
						}
						
					});
					$("#divGrandTotal").html(sum1);
				});
			
			}

			function calculateGrandTotal() {
				var sum = 0.0;
				$('#fob-calculate-tb > tbody  > tr').each(function() {
						var qty = $(this).find('.tr-qty').val();
					var price = $(this).find('.tr-rate').val();
					var amount = (qty*price);
						$(this).find('.tr-total').val(''+amount);
				});
			
			}  

			function updateExpense(){   

				var input_arr = $.map($('#fob-calculate-tb>tbody>tr'), function (tr) {
					var $inp = $('input', tr);
					var $select = $('select', tr);
					return {
						cat: $select.eq(0).val(),
						desc: $inp.eq(0).val(),
						qty: $inp.eq(1).val(),
						rate: $inp.eq(2).val(),
						amount: $inp.eq(3).val(),
					};
				}); 

				var query = "update";
				var eid = $('#eid').val();
				var pid = $('#pid').val();
				var title = $('#title').val();
				var payee = $('#payee').val();
				var bank_acc = $('#bank_acc').val();
				var edate = $('#edate').val();
				var method = $('#method').val();
				var tags = $('#e-tags').val();
				var memo = $('#memo').val();  
			

				$.ajax('expenses-manager.php', {
					type: 'POST',  					
					data: { query:query, eid:eid, pid:pid, title:title, inputs:input_arr, payee:payee, acc:bank_acc, edate:edate, method:method, tags:tags, memo:memo},
					success: function (data, status, xhr) {
						$('#msg-box').html(data);
					},
					error: function (jqXhr, textStatus, errorMessage) {
						$('#msg-box').html('Error: ' + errorMessage);
					}
				}); 

			}  
			*/
			hidePageLoader();
				
		</script>

		<?php } ?>
		

		