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

        if (!defined('fobrain')) /* This checks if this page was wrongly access by users */

        die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');

        require 'fobrain-config-s.php';  /* load fobrain configuration files */	 
			
?>

  
		<script type='text/javascript'>  renderTable(); </script>
		<div class="table-responsive">
			<!-- table -->
			<table class='table table-hover table-responsive style-table wiz-table' id="wiz-table">			
				<thead>
					<tr>
                        <th>S/N</th>                         
                        <th>Picture</th>
						<th>Name</th>
                        <th>Rank</th> 
                        <th>Phone</th>
                        <th>Email</th>
						<th>Tasks</th>
                    </tr>
				</thead> 
				<tbody> 

                <?php 

                    try {
                            

                        $ebele_mark = "SELECT t_id, i_title, i_picture, i_firstname, i_lastname, i_midname, i_phone, i_email, t_grade

                            FROM $staffTB
                            
                            WHERE status = :status";

                        $igweze_prep = $conn->prepare($ebele_mark);
                        $igweze_prep->bindValue(':status', $fiVal);

                        $igweze_prep->execute();

                        $rows_count = $igweze_prep->rowCount(); 

                        if($rows_count >= $foreal) {  
                                
                            while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		

                                $t_id = $row['t_id'];
                                $title = $row['i_title'];
                                $pic = $row['i_picture'];
                                $fname = $row['i_firstname'];
                                $lname = $row['i_lastname'];
                                $mname = $row['i_midname'];
                                //$ranking = $row['rank'];
                                $phone = $row['i_phone'];
						        $email = $row['i_email'];
                                $t_grade = $row['t_grade'];  

                                $serial_no = $foreal++;  
                                
                                if(($t_grade == "") || ($t_grade == 0)){
                                    $admin_lev = "";
                                }else{
                                    $admin_lev = $adminRankingArr[$t_grade];
                                } 

                                $titleVal = wizSelectArray($title, $title_list); 
                                $staff_img = picture($staff_pic_ext, $pic, "staff");

                                if(($admin_grade == $admin_fobrain_grd) && ($admin_level == $admin_tagged) ||
                                   ($admin_grade == $hm_fobrain_grd) && ($admin_level == $hm_fob_tagged)) {	/* check if this user is the main admin or school head */

$table_ed =<<<IGWEZE

                                    <tr id='staff-row-$t_id'>
                                        <td>$serial_no</td> 
                                        <td>                                              
                                            <a href='javascript:;' id='$t_id' class ='view-staff-i'>                                                
                                                <img src = "$staff_img" class=" img-h-50 img-circle img-thumbnail">
                                            <a/>
                                        
                                        </td> 
                                        <td>                                              
                                            <a href='javascript:;' id='$t_id' class ='view-staff-i'>                                                    
                                                $titleVal $lname $fname $mname
                                            <a/> 
                                        </td>  
                                        <td>$admin_lev</td>
                                        <td>$phone</td>
                                        <td>$email</td>                                        
                                        <td>   
                                            <div class="btn-group">
                                                <a href="javascript:;" class="btna btn-tasks  waves-effect waves-light dropdown-toggle p-5" data-bs-toggle="dropdown" aria-haspopup="true"
                                                data-bs-display="static" aria-expanded="false">
                                                    <i class="mdi mdi-dots-grid align-middle fs-18"></i>
                                                </a> 
                                                <div class="dropdown-menu dropdown-menu-lg-end p-10 dropdown-shadow end-0 animate__animated animate__flipInY"> 
                                                    <p class="mb-10">
                                                        <a href='javascript:;' id='$t_id' class ='view-staff-i text-sienna btn waves-effect btn-label waves-light'>									
                                                            <i class="mdi mdi-text-box-search label-icon"></i> View 
                                                        </a>	
                                                    </p>
                                                    <!--
                                                    <p class="mb-10">
                                                        <a href='javascript:;' id='$t_id' class ='staffIDCard text-slateblue btn waves-effect btn-label waves-light'>									
                                                            <i class="mdi mdi-square-edit-outline label-icon"></i> ID Card
                                                        </a>	
                                                    </p>
                                                    -->
                                                    <p class="mb-10">
                                                        <a href='javascript:;' id='$t_id' class ='edit-staff text-slateblue btn waves-effect btn-label waves-light'>									
                                                            <i class="mdi mdi-square-edit-outline label-icon"></i> Edit
                                                        </a>	
                                                    </p> 
                                                    <p> 
                                                        <a href='javascript:;' id='$t_id' class ='reset-staff-div text-danger btn waves-effect btn-label waves-light'>									
                                                            <i class="mdi mdi-delete label-icon"></i> Reset 
                                                        </a>	
                                                    </p> 
                                                </div>
                                            </div>    
                                        </td> 
                                    </tr>

IGWEZE;

                                    echo $table_ed;

                                }else{ /* else this user is not the main admin */

$table_ad =<<<IGWEZE

                                        <tr> 
                                            <td>$serial_no</td>
                                            <td>                                              
                                                <a href='javascript:;' id='$t_id' class ='view-staff-i'>                                                
                                                    <img src = "$staff_img" class=" img-h-50 img-circle img-thumbnail">
                                                <a/>
                                            
                                            </td> 
                                            <td>                                              
                                                <a href='javascript:;' id='$t_id' class ='view-staff-i'>                                                    
                                                    $titleVal $lname $fname $mname
                                                <a/> 
                                            </td>  
                                            <td>$admin_lev</td>
                                            <td>$phone</td>
                                            <td>$email</td>  
                                            <td>  
                                                <div class="btn-group">
                                                    <a href="javascript:;" class="btna btn-tasks  waves-effect waves-light dropdown-toggle p-5" data-bs-toggle="dropdown" aria-haspopup="true"
                                                    data-bs-display="static" aria-expanded="false">
                                                        <i class="mdi mdi-dots-grid align-middle fs-18"></i>
                                                    </a> 
                                                    <div class="dropdown-menu dropdown-menu-lg-end p-10 dropdown-shadow end-0 animate__animated animate__flipInY"> 
                                                        <p class="mb-10">
                                                            <a href='javascript:;' id='$t_id' class ='view-staff-i text-sienna btn waves-effect btn-label waves-light'>									
                                                                <i class="mdi mdi-text-box-search label-icon"></i> View 
                                                            </a>	
                                                        </p>
                                                        <p class="mb-10">
                                                            <a href='javascript:;' id='$t_id' class ='staffIDCard text-slateblue btn waves-effect btn-label waves-light'>									
                                                                <i class="mdi mdi-square-edit-outline label-icon"></i> ID Card
                                                            </a>	
                                                        </p> 
                                                    </div>
                                                </div>  
                                            </td> 
                                        </tr>

IGWEZE;

                                    echo $table_ad; 

                                }

                            }


                        }else{

                            $msg_e = "Ooops, no staff record was found. Please start adding staffs bio data info";
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