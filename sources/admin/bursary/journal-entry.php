        <!-- row -->
        <div class="row gutters mt-25">
            <div class="col-12">
                <?php 
                    $page_title = '<i class="mdi mdi-chart-bar-stacked fs-18"></i> 
                        Double / Multiple Journals Entry';
                    pageTitle($page_title, 0);	 
                ?>
            </div>	
            <div class="col-12">	
                <div class="table-responsive">   
                    <!-- table -->
                    <table   id='fob-journal-entry' class='table table-hover table-responsive style-table wiz-table mb-0 pb-0'>
                    
                    <thead>
                        <tr>
                            <th width="5%">SN</th> 
                            <th width="10%">Date</th> 
                            <th width="22%">Discription</th> 
                            <th width="20%">Account</th>
                            <!--<th width="15%">Account Type</th>-->
                            <th width="10%">Debit (<?php echo $curSymbol ?>)</th>
                            <th width="10%">Credit (<?php echo $curSymbol ?>)</th>
                            <!--<th width="10%">Balance (<?php echo $curSymbol ?>)</th>  -->
                            <th width="8%"><a href='javascript:;' class = 'fs-13 text-primary' id='add-journal-row'> <i class='mdi mdi-book-plus-outline'></i>Add<a></th>
                        </tr>
                    </thead> 
                    <tbody>

                    <?php  

                        $acc_type = $debit = $acc_balance = ""; 
                        $query = "single"; 

                        try {
                        
                            $options = "<select class='form-control'  id='accounts' name='accounts'><option value=''>Select Account</option>".chartOptions($conn, $cid = "", 1, $query)."</select>";
                            
                        }catch(PDOException $e) {

                            fobrainDie( 'Ooops Database Error: ' . $e->getMessage());

                        } 
                            

$journal_rows =<<<IGWEZE

                        <tr>
                            <td>1</td>
                            <td><span class="journal-date"></span></td>
                            <td><span class="journal-desc"></span></td> 
                            <td>
                                $options
                            </td>  
                            <!--<td><span class="journal-type">$acc_type</span></td>
                            <td><span class="journal-debit1 journal-amount">$debit</span></td>
                            <td><span class="journal-credit1">$credit</span></td>-->
                            <td><input type='number' class='tr-debit journal-amount form-control input-amount float-number'></td>
                            <td><input type='number' class='tr-credit hide form-control input-amount'></td>
                            <!--<td><span class="journal-balance journal-amount">$acc_balance</span></td> -->
                            <td> </td>
                        </tr>

                        <tr>
                            <td>2</td>
                            <td><span class="journal-date"></span></td>
                            <td><span class="journal-desc"></span></td> 
                            <td>
                                $options
                            </td>  
                            <!--<td><span class="journal-type">$acc_type</span></td>-->
                            <td><input type='number' class='tr-debit hide form-control input-amount'></td>
                            <td><input type='number' class='tr-credit journal-amount form-control input-amount'></td>
                            <!--<td>-<span class="journal-balance journal-amount">$acc_balance</span></td> -->
                            <td> </td>

                        </tr> 
IGWEZE;

                        echo $journal_rows;  

                        ?>	

                    </tbody>
                    </table>				
                    <!-- / table --> 
                </div>
            </div>	
        </div> 
        <!-- /row -->   



        <script type='text/javascript'>   


            $("#add-journal-row").click(function(){
            //+ "<td><span class='journal-type'></span></td>"
                var table = document.getElementById("fob-journal-entry");
                var rowCount = table.rows.length;
                var optionsBox = "<?php echo $options; ?>"; 
                var table = "<tr>"
                    + "<td>"+rowCount+"</td>"
                    + "<td><span class='journal-date'></span></td>"
                    + "<td><span class='journal-desc'></span></td>"
                    + "<td>"+optionsBox+"</td>" 
                    + "<td><input type='number' class='tr-debit hide form-control input-amount'></td>"
                    + "<td><input type='number' class='tr-credit form-control input-amount'></td>"                               
                    + "<td><a href='javascript:;' class = 'fs-13 text-danger remove-journal-row'> <i class='mdi mdi-book-remove-outline'></i><a></td>"
                        + "</tr>";
                    $("#fob-journal-entry").append(table);
                    
                    $("#jdate, #edate").change();
                    $("#title").keyup();
                

            }); 

            
            $('body').on('click','.remove-journal-row',function(event){	
                event.stopImmediatePropagation();	
                $(this).parent().parent().remove();
                //validateTotal(); 
            }); 
            
        </script>		