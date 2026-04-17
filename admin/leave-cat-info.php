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
	This script handle school grades information
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

        define('fobrain', 'igweze');  /* define a check for wrong access of file */

        require 'fobrain-config-s.php';  /* load fobrain configuration files */	   
			
?> 
 
		
		<div class="table-responsive">
			<!-- table -->
			<table class='table table-hover table-responsive style-table wiz-table'>			
				<thead>
					<tr>
                        <th>S/N</th>                         
                        <th>Leave Cat</th> 
						<th>Status</th> 
						<th>Tasks</th>
                    </tr>
				</thead> 
				<tbody> 

                <?php 

                    try {
                            

                        $ebele_mark = "SELECT lid, leave_c, status

                            FROM $staffLeaveCatTB";

                        $igweze_prep = $conn->prepare($ebele_mark);
                        $igweze_prep->execute();
                        
                        $sn = 0;

                        $rows_count = $igweze_prep->rowCount(); 

                        if($rows_count >= $foreal) {  
                                
                            while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		

                                $lid = $row['lid']; 
                                $leave_c = $row['leave_c']; 
                                $status = $row['status']; 

                                $status_q = $onOffArr[$status];

                                if($status == 1){
                                    $status_view = "<p> 
                                                    <a href='javascript:;' id='$lid' class ='remove-leave text-danger btn waves-effect btn-label waves-light'>									
                                                        <i class='mdi mdi-delete label-icon'></i> Disenable
                                                    </a>	
                                                </p>";
                                }else{ $status_view = ""; }

                                $sn++;

                                 
                                

$profile =<<<IGWEZE

                                <tr id='leave-c-$lid'>
                                    <td>$sn</td>               
                                    <td>$leave_c</td> 
                                    <td>$status_q</td>                                        
                                    <td>   
                                        <div class="btn-group">
                                            <a href="javascript:;" class="btna btn-tasks  waves-effect waves-light dropdown-toggle p-5" data-bs-toggle="dropdown" aria-haspopup="true"
                                            data-bs-display="static" aria-expanded="false">
                                                <i class="mdi mdi-dots-grid align-middle fs-18"></i>
                                            </a> 
                                            <div class="dropdown-menu dropdown-menu-lg-end p-10 dropdown-shadow end-0 animate__animated animate__flipInY"> 
                                                
                                                <p class="mb-10">
                                                    <a href='javascript:;' id='$status(-)$lid(-)$leave_c' class ='edit-leave text-slateblue btn waves-effect btn-label waves-light'>									
                                                        <i class="mdi mdi-square-edit-outline label-icon"></i> Edit
                                                    </a>	
                                                </p> 
                                                $status_view
                                            </div>
                                        </div>    
                                    </td> 
                                </tr>

IGWEZE;

                            echo $profile; 

                        }


                    }else{

                        $msg_e = "Ooops, school staff leave cat record is empty.";
                        echo "<script type='text/javascript'> hidePageLoader();	</script>"; //exit; 	

                    }

                }catch(PDOException $e) {

                    fobrainDie( 'Ooops Database Error: ' . $e->getMessage());

                }

 


?>
                        
				</tbody>
			</table>
			<!-- / table -->	
		</div>					



 