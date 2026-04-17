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

        require 'fobrain-config.php';  /* load fobrain configuration files */	 
				
		if($schoolExt == $fobrainNurAbr){  /* check if school is nursery */
			
			$class = 'class_1, class_2, class_3,';
			
		}else{  /* else normal school */
			
			$class = 'class_1, class_2, class_3, class_4, class_5, class_6,';
		
		}
		
		/* select information */ 
		
		$ebele_mark = "SELECT r.ireg_id, nk_regno, $class 
								s.stu_id, i_stupic, i_firstname, i_lastname, i_midname, i_gender, i_dob, 
								religion, i_country, i_state, i_lga, i_city, i_add_fi, i_add_se, i_stu_phone, 
								i_email, i_sponsor, i_spo_phone, i_spo_add, i_spon_occup,  sponsor2, sponphone2, 
								sponadd2, soccup2, genotype, bloodgp, hostel, route, disability, 
								height, weight, prevsch, bcert, guardid, prevcert, sibling 

						FROM $i_reg_tb r,  $i_student_tb s

						WHERE r.nk_regno = :nk_regno
				
						AND r.ireg_id = s.ireg_id";
				
		$igweze_prep = $conn->prepare($ebele_mark);		
		$igweze_prep->bindValue(':nk_regno', $regNum);
		$igweze_prep->execute();
		
		$rows_count = $igweze_prep->rowCount(); 

		if($rows_count == $foreal) {  /* check array is empty */
		
			while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {  /* loop array */		

				$regNum = $row['nk_regno'];
				$ID = $row['ireg_id'];
				$pic = $row['i_stupic'];
				$fname = $row['i_firstname'];
				$lname = $row['i_lastname'];
				$mname = $row['i_midname'];
				$gender = $row['i_gender'];
				$date = $row['i_dob'];
				$religion = $row['religion'];
				$country = $row['i_country'];
				$state = $row['i_state'];
				$lga = $row['i_lga'];
				$city = $row['i_city'];
				$add1 = $row['i_add_fi'];
				$add2 = $row['i_add_se'];
				$phone = $row['i_stu_phone'];
				$email = $row['i_email'];
				$sibling = unserialize($row['sibling']);
				$spon = $row['i_sponsor'];
				$sphone = $row['i_spo_phone']; 
				$soccup = $row['i_spon_occup'];
				$adds = $row['i_spo_add'];
				$sponsor2 = $row['sponsor2'];
				$sponphone2 = $row['sponphone2'];
				$soccup2 = $row['soccup2'];
				$sponadd2 = $row['sponadd2'];
				$bloodGP = $row['bloodgp'];
				$genoTP = $row['genotype'];
				$fiClass = $row['class_1'];
				$seClass = $row['class_2'];
				$thClass = $row['class_3'];
				$foClass = $row['class_4'];
				$fifClass = $row['class_5'];
				$sixClass = $row['class_6'];
				$hID = $row['hostel'];
				$rID = $row['route'];

				$height = $row['height'];
				$weight = $row['weight'];
				$prevsch = $row['prevsch'];
				$bcert = $row['bcert'];
				$guardid = $row['guardid'];
				$prevcert = $row['prevcert']; 

			} 


			$sessionID = studentRegSessionID($conn, $regNum);  /* student school session ID */
			$session_fi = fobrainSession($conn, $sessionID);  /* school session */									
			$session_se = $session_fi + $foreal;  

			$student_img = picture($school_pic_dir.$session_fi.'_'.$session_se.'/', $pic, "student"); 
			$bcert_img = picture($school_pic_dir.$session_fi.'_'.$session_se.'/', $bcert, "doc");
			$guardid_img = picture($school_pic_dir.$session_fi.'_'.$session_se.'/', $guardid, "doc");
			$prevcert_img = picture($school_pic_dir.$session_fi.'_'.$session_se.'/', $prevcert, "doc"); 

			$genderM = wizSelectArray($gender, $gender_list);
			$bloodGroup = wizSelectArray($bloodGP, $bloodgr_list);
			$genoType = wizSelectArray($genoTP, $genotype_list); 
			
			$levelArray = studentLevelsArray($conn); /* student level array */
			
			$levelOne = $levelArray[0]['level'];
			$levelTwo = $levelArray[1]['level'];
			$levelThree = $levelArray[2]['level'];
			$levelFour = $levelArray[3]['level'];
			$levelFive = $levelArray[4]['level'];
			$levelSix = $levelArray[5]['level'];
			
			if($hID != ""){
				
				$hostelInfoArr = fobrainHostelInfo($conn, $hID);  /* school hostel information  */ 
				if (count($hostelInfoArr) == 1){
					$hostel = $hostelInfoArr[$fiVal]['hostel'];
				}else{ $hostel = ""; }
			}
			
			if($rID != ""){
				
				$routeInfoArr = fobrainRouteInfo($conn, $rID);  /* school route information  */
				if (count($routeInfoArr) == 1){
					$route = $routeInfoArr[$fiVal]['route'];
				}else{ $route = ""; }
				
			}

			if(is_array($sibling)){  /* check is student is empty */
				
				$sibling_branch = ""; $session_se = "";  $session_fi = ""; 

				foreach($sibling as $child){

					$student_info = studentData($conn, $child); 

					list ($lname_s, $fnameQ_s, $mnameQ_s, $pic_s, $gender_s, $i_dob_s, $height_s, $weight_s, $session_fi, $name_full) = explode ("@+@", $student_info);
   
					$session_se = $session_fi + $fiVal; 

					$student_img_s = picture($school_pic_dir.$session_fi.'_'.$session_se.'/', $pic_s, "student");

					$sibling_branch .= '

					<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-6 text-center mb-30">
						<div class="picture-div mb-10">
							<img src="'.$student_img_s.'" alt="'.$name_full.'" class="img-h-150 rounded img-thumbnail" />
						</div>
						<div class="text-danger">'.$name_full.'</div>
					</div>';

				}

				$sibling_tree = '
				
				<div class="info my-30"> 
					<span class="sub-title">Sibling</span>
				</div> 

				<div class="row mt-10 profile-top-border">
					<div class="my-20"> </div>
					'.$sibling_branch.'                        
				</div>'; 

			}	
					 
					
				if($schoolExt == $fobrainNurAbr){  /* check if school is nursery */
					
$classInfo =<<<IGWEZE
		

					<div class="col-lg-4 col-md-4 col-sm-4 col-6 profile-info profile-info-nb">
						<div class="title">
							<i class="fas fa-usersfas fa-user-tag"></i> $levelOne 
						</div>
						<div class="detail font-head-1 fs-14">
							$fiClass
						</div>
					</div>
					
					<div class="col-lg-4 col-md-4 col-sm-4 col-6 profile-info">
						<div class="title">
							<i class="fas fa-usersfas fa-user-tag"></i> $levelTwo 
						</div>
						<div class="detail font-head-1 fs-14">
							$seClass
						</div>
					</div>
					
					<div class="col-lg-4 col-md-4 col-sm-4 col-6 profile-info">
						<div class="title">
							<i class="fas fa-usersfas fa-user-tag"></i> $levelThree
						</div>
						<div class="detail font-head-1 fs-14">
							$thClass
						</div>
					</div> 
					
					
IGWEZE;
					
				}else{
					
$classInfo =<<<IGWEZE
		
 							  						
					<div class="col-lg-4 col-md-4 col-sm-4 col-6 profile-info profile-info-nb">
						<div class="title">
							<i class="fas fa-usersfas fa-user-tag"></i> $levelOne 
						</div>
						<div class="detail font-head-1 fs-14">
							$fiClass
						</div>
					</div>
					
					<div class="col-lg-4 col-md-4 col-sm-4 col-6 profile-info">
						<div class="title">
							<i class="fas fa-usersfas fa-user-tag"></i> $levelTwo 
						</div>
						<div class="detail font-head-1 fs-14">
							$seClass
						</div>
					</div>
					
					<div class="col-lg-4 col-md-4 col-sm-4 col-6 profile-info">
						<div class="title">
							<i class="fas fa-usersfas fa-user-tag"></i> $levelThree
						</div>
						<div class="detail font-head-1 fs-14">
							$seClass
						</div>
					</div>
					
					<div class="col-lg-4 col-md-4 col-sm-4 col-6 profile-info">
						<div class="title">
							<i class="fas fa-usersfas fa-user-tag"></i> $levelFour 
						</div>
						<div class="detail font-head-1 fs-14">
							$foClass
						</div>
					</div>
					
					<div class="col-lg-4 col-md-4 col-sm-4 col-6 profile-info">
						<div class="title">
							<i class="fas fa-usersfas fa-user-tag"></i> $levelFive
						</div>
						<div class="detail font-head-1 fs-14">
							$fifClass
						</div>
					</div>
					
					<div class="col-lg-4 col-md-4 col-sm-4 col-6 profile-info">
						<div class="title">
							<i class="fas fa-usersfas fa-user-tag"></i> $levelSix
						</div>
						<div class="detail font-head-1 fs-14">
							$sixClass
						</div>
					</div> 
					
IGWEZE;

				}
							 
		?>  		
					
					<div <?php echo $fob_view; ?> class="row row-section justify-content-center">	
						<div class="col-lg-4 mb-30"> 
							<div class="profile-card  m-0">
								<span class="user"><i class="mdi mdi-dots-hexagon"></i> Active</span>
								<img class="preview-picture-1 round img-h-150-pr" src="<?php echo $student_img; ?>" alt="user" />
								<h3 class="font-head-1a"><?php echo "<span class='student-name-rp'> $lname $fname  $mname</span>  <br>($regNum)"; ?></h3>
								<h6>STUDENT</h6>
								
								<div class="buttons">
									<button class="primary wiz-menu">
										<a href="javascript:;" id="profile">			
											<i class="fas fa-eye label-icon"></i> View
										</a>	
									</button>
									 
									<button class="primary lighter edit-profile" id="<?php echo $regNum; ?>">
										<i class="fas fa-edit label-icon"></i>  Edit
									</button>
								</div>  
									
								<div class="row  justify-content-center mt-40 profile-link"> 
									<div class="col wiz-menu">                                            
										<a href="javascript:;" id="support">
											<i class="mdi mdi-message-question-outline"></i>
										</a>
									</div>	
									<div class="col wiz-menu">  
										<a href="javascript:;" id="reload-page">
											<i class="mdi mdi-refresh-circle"></i>
										</a>
									</div>	
									<div class="col wiz-menu">  
										<a href="javascript:;" id="lock-screen">
											<i class="mdi mdi-account-lock"></i>
										</a>
									</div>	
									<div class="col wiz-menu"> 
										<a href="javascript:;" id="profile">
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

						<div class="col-lg-8 wigz-right-half fobrain-print " id="wigz-right-half">
							<?php require_once($wizg_bio_dir.'profile.php') ?> 
						</div>							
					</div> 

			<?php
        
				
				}else{  /* display error */ 
				
					$msg_e =  "Ooops, student record was not found.";
					echo $errorMsg.$msg_e.$eEnd;  exit;
					
				}

			?> 
			  
			<script type='text/javascript'> $('.fobrain-page-icons').fadeIn(200); $('.slide-page').fadeOut(5); $('.printer-icon').fadeIn(200); 	 </script>