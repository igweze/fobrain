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
	This page load student profile
	------------------------------------------------------------------------*/  

if(!session_id()){
    session_start();
}
 
		if (!defined('fobrain')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
				
		require_once $fobrainIconPage; /* This include top middle global icon page eg go back, print buttons etcs */ 
   

		try { 
			 
			$staffInfo = staffData($conn, $_SESSION['adminID']);  /* school staffs/teachers information */				
			
			list ($title, $staffName, $staffSex, $staff_fobrain_grdQ, $user_picture, $staffLName) = 
			explode ("#@s@#", $staffInfo);	 

			$titleVal = wizSelectArray($title, $title_list); 
			$staff_t_name = $titleVal.' '.$staffLName;  
			$staff_img = picture($staff_pic_ext, $user_picture, "staff"); 
            $staff_tid = $_SESSION['adminID']; 
			$userTag = wizSelectArray($_SESSION['accessLevel'], $adminRankingArr); 

			if(($staff_fobrain_grdQ == $bus_fob_tagged) || ($staff_fobrain_grdQ == $lib_fob_tagged)) {

				$link_bio = "wiz-menu";

			}else{

				$link_bio = "wiz-menu-1";

			}	

		}catch(PDOException $e) {
		
			fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
		}
			 
							 
?>  		
		
		<div <?php echo $fob_view; ?> class="row row-section justify-content-center">	
			<div class="col-lg-4 mb-30"> 
				<div class="profile-card  m-0">
					<span class="user"><i class="mdi mdi-dots-hexagon"></i> Active</span>
					<img class="staff-picture-comp round img-h-150-pr" src="<?php echo $staff_img; ?>" alt="user" />
					<h3 class="font-head-1a"><?php echo "<span class='staff-name-comp'>$staff_t_name</span>"; ?></h3>
					<h6><?php echo $userTag; ?></h6>
					
					<div class="buttons">
						<button class="primary view-staff-pro" id="<?php echo $staff_tid; ?>">
							<a href="javascript:;">			
								<i class="fas fa-eye label-icon"></i> View
							</a>	
						</button>
							
						<button class="primary lighter edit-staff-pro" id="<?php echo $staff_tid; ?>">
							<i class="fas fa-edit label-icon"></i>  Edit
						</button>
					</div>  
						
					<div class="row  justify-content-center mt-40 profile-link"> 
						<div class="col <?php echo $link_bio; ?>">                                            
							<a href="javascript:;" id="access">
								<i class="mdi mdi-account-key-outline"></i>
							</a>
						</div>	
						<div class="col <?php echo $link_bio; ?>">  
							<a href="javascript:;" id="reload-page">
								<i class="mdi mdi-refresh-circle"></i>
							</a>
						</div>	
						<div class="col <?php echo $link_bio; ?>">  
							<a href="javascript:;" id="lock-screen">
								<i class="mdi mdi-account-lock"></i>
							</a>
						</div>	
						<div class="col <?php echo $link_bio; ?>"> 
							<a href="javascript:;" id="log-out">
								<i class="mdi mdi-logout"></i>
							</a>
						</div>	
					</div>	
					<div class="hot-links">
						<h6>Hot Links</h6>
						<ul>
						<li>View Result</li>
						<li>Roll Call</li>
						<li>E-Shop</li>
						<li>Library</li>
						<li>Pay Fees</li>
						<li>Inbox</li>
						<li>E-Exam</li>
						<li>Events</li>
						</ul>
					</div> 
				</div>  
			</div>  
			<div class="col-lg-8 wigz-right-half card-shadow" id="modal-load-div"></div>							
		</div>  
		<script type='text/javascript'>$('.view-staff-pro').trigger('click');</script>