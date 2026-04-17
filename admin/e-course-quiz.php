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
	This script course quiz
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

	define('fobrain', 'igweze');  /* define a check for wrong access of file */
	require 'fobrain-config.php';  /* load fobrain configuration files */ 

        if ($_REQUEST['query'] == 'quiz') {  /* edit course chapter */

			$qData = clean($_REQUEST['qData']); 

			list ($none, $hid, $cid, $tid) = explode ('-', $qData);	
			
			/* script validation */ 
			
			if (($hid == "") || ($cid == "") || ($tid == "")){  
				
				$msg_e = "* Ooops, an error has occur while to retrieve Course Topic information. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader(); </script>";exit;
				
			}else { 
            
                try {  
                  
                    $courseQuizArr = courseQuizInfo2($conn, $cid, $tid, $hid) ;  /* school courseQuiz information */
                    $qid = $courseQuizArr[$fiVal]["qid"]; 
                    $questionArray = unserialize($courseQuizArr[$fiVal]["questions"]);   

                }catch(PDOException $e) {

                    fobrainDie( 'Ooops Database Error: ' . $e->getMessage());

                }    

                echo '<div class="row gutters my-10">
                        <div class="col-12">'; 
                            $page_title = '<i class="mdi mdi-cash-register fs-18"></i> 
                                    Quiz Manager';
                                pageTitle($page_title, 0);
                            
                    echo    '</div>	
                    </div>';
	
				
?>
 
            <!-- row -->
            <div class="row gutters">
                <div class="col-12">
                    <div class="table-responsive"> 
                        <div id="table-wrapper"> 

                            <!-- table -->
                            <table  id='fobrain-quiz-tb' class='table table-hover table-responsive style-table wiz-table'>
                            
                            <thead>
                                <tr id='cal-hd'>
                                    <th width="3%">S/N</th> 
                                    <th width="85%">Questions</th>  
                                    <th width="12%"><a href='javascript:;' class = 'fs-13 text-primary' id='add-row'> <i class='mdi mdi-book-plus-outline'></i> Add<a></th>
                                </tr>
                            </thead> 
                            <tbody id='cal-body'>



                    <?php 

                    $begin_new = 0;

                    if(is_array($questionArray)){ 

                        $in = 0; $sn = 1; 

                        $questionCount = count($questionArray); 

                        if($questionCount >= 1){

                            foreach ($questionArray as $input_row) { 
                            
                                $quiz = $questionArray[$in]['quiz']; 
                                
                                //<input type='text' value="$quiz" class='tr-quiz form-control'>

$row_cells =<<<IGWEZE

                                <tr>
                                    <td>$sn</td> 
                                    <td> 
                                        <textarea rows="4" cols="8"class='tr-quiz form-control'
                                        placeholder="Enter Questions">$quiz</textarea> 
                                    </td>  
                                    <td>
                                        <a href='javascript:;' class = 'fs-13 text-danger remove-row2'> <i class='mdi mdi-book-remove-outline'></i> Remove<a>
                                    </td>
                                </tr>

IGWEZE;
				
                                echo $row_cells; 
                                
                                $quest = "";	 

                                $in++;  $sn++; 	 

                            }

                        }else{

                            $begin_new = 1;

                        }
                        
                    }else{

                        $begin_new = 1;

                    }	 
                    

                    if($begin_new == 1){


$row_cells =<<<IGWEZE

                                <tr>
                                    <td>1</td> 
                                    <td> 
                                        <textarea rows="4" cols="8"class='tr-quiz form-control'
                                        placeholder="Enter Questions"></textarea>
                                    </td>  
                                    <td>
                                        <a href='javascript:;' class = 'fs-13 text-danger remove-row2'> <i class='mdi mdi-book-remove-outline'></i> Remove<a>
                                    </td>
                                </tr>

IGWEZE;
				
                                echo $row_cells; 


                    }

                    ?>	
 
                                        
                                </tbody>
                            </table>				
                            <!-- / table -->

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
                    <input type="hidden" name="qid"  id="qid" value="<?php echo $qid; ?>" />
                    <input type="hidden" name="qData"  id="qData" value="<?php echo $qData; ?>" />
                    <button type="submit" class="btn btn-primary waves-effect   
                    btn-label waves-light"  onclick='saveQuizQuestion()'>
                        <i class="mdi mdi-content-save label-icon"></i>  Save  
                    </button>
                                
                </div>
            </div>	
            <!-- /row -->  
            <div id="msg-box-quiz"></div> 

<?php 
        
            } 
            
        }else{
		
			echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
		
		}
        
?>

            <script type="text/javascript">   

                $(function() {

                    //createExpenseTable();   

                    // + "<td><input type='text' class='tr-quiz form-control'></td>" 
                    
                        
                    $("#add-row").click(function(){
                        var table = document.getElementById("fobrain-quiz-tb");
                        var rowCount = table.rows.length; 
                        var table = "<tr>"
                                + "<td>"+rowCount+"</td>" 
                                + "<td><textarea rows='3' cols='10' class='tr-quiz form-control' placeholder='Enter Questions'></textarea> </td>" 
                                + "<td><a href='javascript:;' class = 'fs-13 text-danger remove-row'> <i class='mdi mdi-book-remove-outline'></i> Remove<a></td>"
                                    + "</tr>";
                                $("#fobrain-quiz-tb").append(table)
                    
                        $(".remove-row").on('click',function(){
                            $(this).parent().parent().remove(); 
                        });
                    });

                    $('body').on('click','.remove-row2',function(event){ 
                        event.stopImmediatePropagation();	
                        $(this).parent().parent().remove(); 
                    }); 
                    
                });  

                function saveQuizQuestion(){     

                    var input_arr = $.map($('#fobrain-quiz-tb>tbody>tr'), function (tr) {
                        var $inp = $('textarea', tr); 
                        return {						 
                            quiz: $inp.eq(0).val()
                        };
                    }); 
 
                    var query = "save";
                    var qid = $('#qid').val();
                    var qData = $('#qData').val(); 

                    $.ajax('e-course-quiz-manager.php', {
                        type: 'POST',  					
                        data: { query:query, qid:qid, qData:qData, inputs:input_arr},
                        success: function (data, status, xhr) {
                            $('#msg-box-quiz').html(data); 
                        },
                        error: function (jqXhr, textStatus, errorMessage) {
                            $('#msg-box-quiz').html('Error: ' + errorMessage); 
                        }
                    }); 
 
                }  
                
                hidePageLoader();
                    
            </script>

            
		

		
