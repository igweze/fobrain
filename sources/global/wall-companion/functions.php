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
	This script contains all companion wall and inbox functions
	------------------------------------------------------------------------*/ 


		if (!defined('fobrain')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
				
		
		function checkWallRegistration($conn, $wall_name, $gender_gl){  /* check if student is registered */

			global $fobrainCWallTB, $foreal, $fiVal;

			$confirm_user = 'igweze';
			$update_user = 'nkiru'; 


			$ebele_mark = "SELECT member_id, member_reg, member_name, member_sex, profile_pic, member_dept, member_faculty, member_program

									FROM $fobrainCWallTB

								WHERE member_reg = :member_reg"; 

			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue(':member_reg', $_SESSION['regNo']);
				
			$igweze_prep->execute();									
			
			$rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count == $foreal) {
			
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		

					$member_id = $row['member_id'];
					$faRegNum = $row['member_reg'];
					$m_name = $row['member_name'];
					$m_sex = $row['member_sex'];
					$prof_pic = $row['profile_pic'];
					$m_sex = $row['member_sex'];
					$m_dept = $row['member_dept'];
					$m_faculty = $row['member_faculty'];
					$m_program = $row['member_program'];
				
				}	

				if (($m_name == '') || ($m_sex == '')){ $update_user = 0404;}
				

			}else{
			
				$confirm_user = 0707;

			} 

			if($confirm_user == 0707){  

				if(($gender_gl == "") ||(empty($gender_gl))){ $gender_gl = 0;}
				
				if(isset($_SESSION['wallComRank'])){	
				
					$ebele_mark_2 = "INSERT INTO $fobrainCWallTB(member_reg, member_name, member_sex, member_rank, s_grade)

																VALUES (:member_reg, :member_name, :member_sex, :member_rank, :s_grade)";

					$igweze_prep_2 = $conn->prepare($ebele_mark_2);

					$igweze_prep_2->bindValue(':member_reg', $_SESSION['adminID']);
					$igweze_prep_2->bindValue(':member_name', $wall_name);
					$igweze_prep_2->bindValue(':member_sex', $gender_gl);
					$igweze_prep_2->bindValue(':member_rank', $_SESSION['wallComRank']); 
					$igweze_prep_2->bindValue(':s_grade', $_SESSION['accessLevel']);
					$igweze_prep_2->execute();
				
				}else{

					$ebele_mark_2 = "INSERT INTO $fobrainCWallTB(member_reg, member_name, member_sex, member_rank)

																VALUES (:member_reg, :member_name, :member_sex, :member_rank)";

					$igweze_prep_2 = $conn->prepare($ebele_mark_2);

					$igweze_prep_2->bindValue(':member_reg', $_SESSION['regNo']);
					$igweze_prep_2->bindValue(':member_name', $wall_name);
					$igweze_prep_2->bindValue(':member_sex', $gender_gl);
					$igweze_prep_2->bindValue(':member_rank', $fiVal);
					$igweze_prep_2->execute();
					
				
				}
			
			
			} 

			if($update_user == 0404){

				$ebele_mark_3 = "UPDATE $fobrainCWallTB
				
									SET
										
									member_name = :member_name, 
									
									member_sex = :member_sex
									
									WHERE member_reg = :member_reg";

				$igweze_prep_3 = $conn->prepare($ebele_mark_3);

				$igweze_prep_3->bindValue(':member_reg', $_SESSION['regNo']);
				$igweze_prep_3->bindValue(':member_name', $wall_name);
				$igweze_prep_3->bindValue(':member_sex', $gender_gl);										
				$igweze_prep_3->execute();
			
			}
			
		}			


		function companionWallUserDetails($conn, $regNum, $SVal){  /* retrieve student companion details */

			global $fobrainCWallTB, $foreal, $fiVal, $seVal;

			if ($SVal == $fiVal) {

				$ebele_mark = "SELECT member_id, member_reg, profile_pic, member_name, member_sex, member_dept, 
								member_faculty, member_mail, wall_pic, load_page
				
											FROM $fobrainCWallTB

											WHERE member_id = :member_id
											
											LIMIT 1";
						
				$igweze_prep = $conn->prepare($ebele_mark);
				
				$igweze_prep->bindValue(':member_id', $regNum);

			}		

			if ($SVal == $seVal) {
				 
				$ebele_mark = "SELECT member_id, member_reg, profile_pic, member_name, member_sex, member_dept, 
								member_faculty, member_mail, wall_pic, load_page
								
									FROM $fobrainCWallTB

									WHERE member_reg = :member_reg
									
									LIMIT 1";
						
				$igweze_prep = $conn->prepare($ebele_mark);
				
				$igweze_prep->bindValue(':member_reg', $regNum);

			}

				
			$igweze_prep->execute();
			
			$rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count == $foreal) {
			
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		

					$member_id = $row['member_id'];
					$faRegNum = $row['member_reg'];
					$prof_pic = $row['profile_pic'];
					$m_name = $row['member_name'];
					$m_sex = $row['member_sex'];
					$m_dept = $row['member_dept'];
					$m_faculty = $row['member_faculty'];
					$userMail = $row['member_mail'];
					$wallPic = $row['wall_pic'];
					$load_page = $row['load_page'];  
				
				}	

				if ($member_id == ''){ $member_id = '-';}
				if ($faRegNum == '')  { $faRegNum = '-';}
				if ($m_name == '')   { $m_name = '-';}
				if ($m_sex == '')    { $m_sex = '-';}
				if ($prof_pic == '') { $prof_pic = '-';}
				if ($m_dept == '')   { $m_dept = '-';}
				if ($m_faculty == ''){ $m_faculty = '-';}
				if ($userMail == '') { $userMail = '-';}
				if ($wallPic == '')  { $wallPic = '-';}
				if ($load_page == ''){ $load_page = $fiVal;}
				
				$userDatails = $member_id.'##'.$faRegNum.'##'.$m_name.'##'.$m_sex.'##'.$prof_pic.'##'.$m_dept.'##'
				.$m_faculty.'##'.$userMail.'##'.$wallPic.'##'.$load_page;
				
				
			}else{
			
			
				$member_id = '-'; $faRegNum = '-'; $m_name = '-'; $m_sex = '-'; $prof_pic = '-'; $m_dept = '-'; 
				$m_faculty = '-'; 
				$userMail = '-';  $wallPic = '-'; $load_page = $fiVal;
				
				$userDatails = $member_id.'##'.$faRegNum.'##'.$m_name.'##'.$m_sex.'##'.$prof_pic.'##'.$m_dept.'##'
				.$m_faculty.'##'.$userMail.'##'.$wallPic.'##'.$load_page;
			
			
			}
			
			
			return $userDatails;
			

		}					

		function adminWallCmailID($conn, $rank){  /* show admin companion post */

			global $fobrainCWallTB, $foreal, $fiVal, $seVal;

			if($rank == $seVal){ 
				
				$ebele_mark = "SELECT member_id

									FROM $fobrainCWallTB

									WHERE   

								member_rank = :member_rank

								AND
								
								s_grade = :s_grade"; 
		
				$igweze_prep = $conn->prepare($ebele_mark);
				//$igweze_prep->bindValue(':member_faculty', $_SESSION['faculty_id']);member_dept = :member_dept AND
				//$igweze_prep->bindValue(':member_dept', $_SESSION['dept_id']);member_faculty = :member_faculty AND
				$igweze_prep->bindValue(':member_rank', $seVal);
				$igweze_prep->bindValue(':s_grade', $fiVal);
			
			}else{	
				
				$ebele_mark = "SELECT member_id

									FROM $fobrainCWallTB 
									
									WHERE
									
									member_rank = :member_rank";					 
			
				$igweze_prep = $conn->prepare($ebele_mark);
				$igweze_prep->bindValue(':member_rank', $thVal);
			
			}
			
			$igweze_prep->execute();				
			$rows_count = $igweze_prep->rowCount(); 
		
			if($rows_count == $foreal) {
		
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		

					$adminID = $row['member_id'];
			
				}	
			
			}else{
		
				$adminID = '-';

			}
		
			return $adminID;
		}


		function loadCompanionWall($conn, $loadType, $dID, $fID) {  /* load companion wall post */

			global $cWallPostTB, $fobrainCWallTB, $foreal, $i_false, $fobrainTemplate, $forumPicExt, $fiVal, $seVal, $thVal, $foVal, $regNum, 
			$wiz_default_img, $succesMsg, $errorMsg, $warningMsg, $infoMsg,  $sEnd, $eEnd, $iEnd, $wEnd, $cWallNumPerPage;
			$changeProfPic = ""; $postMessage2 = ""; $showMailReportBox = "";

			$checkPostAuthor = '';


			if ($loadType == $seVal){

				$ebele_mark = "SELECT post_id
								
								FROM $cWallPostTB  
								
								WHERE f_id = :f_id
								
								ORDER BY post_id DESC";

				$igweze_prep = $conn->prepare($ebele_mark);
				$igweze_prep->bindValue(':f_id', $fID);		


				$ebele_mark_1 = "SELECT post_id, author_id, post_title, post_msg, post_img_fi, post_img_se, 
				post_img_th, post_img_fo, 
								post_date, post_ip, post_type
								
								FROM $cWallPostTB  
								
								WHERE f_id = :f_id
								
								ORDER BY post_id DESC
								
								LIMIT $cWallNumPerPage";

				$igweze_prep_1 = $conn->prepare($ebele_mark_1);
				$igweze_prep_1->bindValue(':f_id', $fID);		
				

				$msg_e = "Ooops, There is not post yet in Companion Wall from your faculty classmates to display. 
				Why not be the first to start posting in your faculty. . . . . . You are Fabulous";

			}elseif ($loadType == $thVal){		


				$ebele_mark = "SELECT post_id
				
								FROM $cWallPostTB  
								
								WHERE d_id = :d_id
								
								ORDER BY post_id DESC";

				$igweze_prep = $conn->prepare($ebele_mark);
				$igweze_prep->bindValue(':d_id', $dID);		

				$ebele_mark_1 = "SELECT post_id, author_id, post_title, post_msg, post_img_fi, post_img_se, 
				post_img_th, post_img_fo, 
								post_date, post_ip, post_type
				
								FROM $cWallPostTB  
								
								WHERE d_id = :d_id
								
								ORDER BY post_id DESC
								
								LIMIT $cWallNumPerPage";

				$igweze_prep_1 = $conn->prepare($ebele_mark_1);
				$igweze_prep_1->bindValue(':d_id', $dID);		

				$msg_e = "Ooops, There is not post yet in Companion Wall from your Deparmental classmates to display. 
				Why not be the first to start posting in your Deparment. . . . . . You are Fabulous";
				


			}else {

				$ebele_mark = "SELECT post_id

								FROM $cWallPostTB  ORDER BY post_id DESC";

				$igweze_prep = $conn->prepare($ebele_mark);

				$ebele_mark_1 = "SELECT post_id, author_id, post_title, post_msg, post_img_fi, post_img_se, 
				post_img_th, post_img_fo, 
								post_date, post_ip, post_type
				

								FROM $cWallPostTB  ORDER BY post_id DESC
								
								LIMIT $cWallNumPerPage";

				$igweze_prep_1 = $conn->prepare($ebele_mark_1);

				$loadType = 1;

				$msg_e = "Ooops, There is not post yet in Companion Wall to display. 
				Why not be the first to start posting . . . . . . You are Fabulous";


			}
			
			$igweze_prep->execute();
			$rows_count = $igweze_prep->rowCount(); 

			$igweze_prep_1->execute();
			$rows_count_1 = $igweze_prep->rowCount(); 


			if($rows_count_1 >= $foreal) {

				echo '<div id="wallPaginateDiv">';	
				
				while($row = $igweze_prep_1->fetch(PDO::FETCH_ASSOC)) {		

					$post_id = $row['post_id'];  
					$author_id = $row['author_id'];
					$post_title = $row['post_title'];
					$post_msg = $row['post_msg'];
					$post_img_fi = $row['post_img_fi'];
					$post_img_se = $row['post_img_se'];
					$post_img_th = $row['post_img_th'];
					$post_img_fo = $row['post_img_fo'];
					$post_time = $row['post_date'];
					$post_type = $row['post_type']; 
					
					$post_date = wallTimerBoy($post_time);					
					$post_msg = htmlspecialchars_decode($post_msg);					
					$post_Edit = $post_msg;					
					$post_msg = nl2br($post_msg);					
					$checkEdit = 0;
					
					$thisMemberInfo = companionWallUserDetails($conn, $_SESSION['regNo'], $seVal);
				
					list ($check_user, $tRegNum, $tm_name, $tm_sex, $tprof_pic, $tm_dept, $tm_faculty, $tUserMail, 
					$tWallPic, $tload_page) = explode ("##", $thisMemberInfo);				

					$memberInfo = companionWallUserDetails($conn, $author_id, $fiVal);
				
					list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic) = explode ("##", $memberInfo);
					
					$genderVerb = genderVerb($m_sex);
					
					$postLikes = companionWallLikes($conn, $post_id, $check_user);
					
					$postLikesMore = companionWallMoreLikes($conn, $post_id, $check_user); 
					
					$commentDiv = commentsNum($conn, $post_id);
					
					if (($member_id == $author_id) && ($faRegNum == $regNum)) { $checkPostAuthor = true;}
					else {$checkPostAuthor = false;} 
					
					if($post_type == $seVal) {
					
						if  (($post_img_fi != '') && (file_exists($forumPicExt.$post_img_fi))){

							$fi_upload = renderPictures($post_img_fi, $checkPostAuthor); 
						
						}

						if  (($post_img_se != '') && (file_exists($forumPicExt.$post_img_se))){

							$se_upload = renderPictures($post_img_se, $checkPostAuthor); 
						
						}

						if  (($post_img_th != '') && (file_exists($forumPicExt.$post_img_th))){

							$th_upload = renderPictures($post_img_th, $checkPostAuthor); 
						
						}

						if  (($post_img_fo != '') && (file_exists($forumPicExt.$post_img_fo))){

							$fo_upload = renderPictures($post_img_fo, $checkPostAuthor); 
						
						}  

						$postMessage = "$post_title";
										
						$postMessage2 = "
										<div class='row my-5'>

										$fi_upload $se_upload
										$th_upload $fo_upload 
										
										</div>";				
						
						$post_Edit = '';
						$checkEdit = $foreal;
						$changeProfPic = '';
						
					
					}elseif($post_type == $thVal) {
					
						if  (($post_img_fi != '') && (file_exists($forumPicExt.$post_img_fi))){

							$profilePic = renderPictures($post_img_fi, $checkPostAuthor); 
						
						} 
						
						$postMessage = "Changed $genderVerb Profile Picture";
						
						$postMessage2 = " 
						<div class='row my-5 $post_id'> 
							$profilePic 
						</div>";
						
						
						$post_Edit = $foreal;
						$checkEdit = $foreal;
						
					
					}elseif($post_type == $foVal) {
					

						if  (($post_img_fi != '') && (file_exists($forumPicExt.$post_img_fi))){

							$wallPic = renderPictures($post_img_fi, $checkPostAuthor); 
						
						} 
						
						$postMessage = "
						Changed $genderVerb wall cover picture"; 
						
						$postMessage2 = " 
						<div class='row my-5 $post_id'> 
							$wallPic 
						</div>";  
						
						$post_Edit = $foreal;
						$checkEdit = $foreal; 
					
					}else{
					
						$postMessage = $post_msg;
					
					}
					
					
					if(($checkPostAuthor == true) || ($_SESSION['wall-general'] == 1)){ 
					
						if ($checkEdit == $i_false){
						
							$show_detele = ' 
							<a href="javascript:;" class="post-delete-btn " id="FDel-'.$post_id.'"> 
								<i class="mdi mdi-delete-circle-outline"></i>  
							</a>  
								
							<a href="javascript:;" class="post-edit-btn" id="FEdit-'.$post_id.'"> 
								<i class="mdi mdi-circle-edit-outline"></i>  
							</a>			  		
							';
						
						}elseif($checkEdit == $foreal){
						
							$show_detele = ' 
							<a href="javascript:;" class="post-delete-btn" id="FDel-'.$post_id.'"> 
								<i class="mdi mdi-delete-circle-outline"></i>
							</a>  
							';
						
						}elseif($checkEdit == $seVal){
						
							$show_detele = '';					
						
						}else{
						
							$show_detele = '';
						
						} 

						$showMailReportBox = '';
					
					}else{
					
						$show_detele = '';
						$showMailReportBox = '
							<div class="col">
								<a href="javascript:;" id="sendMailPosts-'.$post_id.'-'.$author_id.'" title="Send Private Message"
								class="sendMailPosts">
									<i class="far fa-comment-dots"></i> <span class="hide-res">Send PM</span>
								</a>
							</div>
							
							<div class="col">
								<a href="javascript:;" id="sendReportPosts-'.$post_id.'-'.$author_id.'" title="Report User"
								class="sendReportPosts">
									<i class="far fa-comments"></i> <span class="hide-res">Report</span>
								</a>
							</div> 
							<span id="mailReportPostsMsg_'.$post_id.'"></span> 
							<span id="mailReportPostsDiv_'.$post_id.'"></span>'; 
					
					} 
					
					$showSlideUp = '
					<a href="javascript:;" title="Slide Up" 
						id="slideCommentsDiv-'.$post_id.'" class="slideCommentsDiv display-none ms-10"> 
						<i class="fas fa-chevron-up"></i> 
					</a>'; 

					$stuFpic = picture($forumPicExt, $prof_pic, "student");
					
					$stuPic = '<img src="'.$stuFpic.'" class="poster-img" />';
										
					$post_row_id =  "post_".$post_id;					
					$edit_row_id =  "editPost_".$post_id;	 
				
$posts =<<<IGWEZE

	<li class="post-list"  id= "$post_row_id">
		<div class="comment-main-level">
			<!-- avatar -->
			<div class="comment-avatar">
				<a href="javascript:;" class="showcompanionWallUser"  id="companionWallUser-$member_id">
					<img src="$stuFpic" alt="">
				</a>
			</div>
			<!-- companion wall posts -->
			<div class="comment-box">
				<div class="comment-head post-h-bg">
					<h6 class="comment-name by-author">
						<a href="javascript:;" class="showcompanionWallUser"  id="companionWallUser-$member_id">
						$m_name
						</a>
					</h6>
					<span>$post_date</span>
					<b>$show_detele</b> 
				</div>
				<div class="comment-content" id='$edit_row_id'>  
					$postMessage  
					$postMessage2 
				</div> 
				<div class="row comment-btm"> 
					<div class="col">
							<a href="javascript:;" title="Like this">
								$postLikes
							</a>
						</div>
						<div class="col">
							<a href="javascript:;" title="Leave a comment" class='comment-div' id='commentNumStatus-$post_id'>
								$commentDiv  
							</a>
							
							$showSlideUp
							
						</div>
						$showMailReportBox	
				</div>
				<div class="row comment-like-div"> 
					<div class="col">
						<span id="likeDetails-$post_id">$postLikesMore</span>
					</div>
				</div>
			</div>							
		</div>
		
		<!-- companion wall comments -->						
		<ul class="commentDivPostSub comments-list display-none reply-list mt-0" id = "commentDivSub-$post_id">'	
			<!-- <li><h4 class="font-head-1">Comments</h4></li> -->
			
	
IGWEZE;
					
					echo $posts;
				
					companionWallComments($conn, $post_id);
				
									
					echo '</ul> </li>';
					
					$post_msg =''; $postMessage = ""; $postMessage2 = ""; $checkPostAuthor = ''; 
					$post_type = ""; $showMailReportBox = ''; $changeProfPic = '';
					$fi_upload =''; $se_upload =''; $th_upload =''; $fo_upload ='';  
				
				}
						
				echo '</div>';	
				$pagiNav = "";
				if($rows_count > $cWallNumPerPage){
						
						if($rows_count >= $i_false) {

							$paginationCount = getPagination($rows_count, $cWallNumPerPage);
							$lastPage = $paginationCount - 1;

							$pagiNav .='<ul class="tsc_pagination tsc_paginationA tsc_paginationA12">
										<li>
										<a  href="javascript:;" class="softPaginate first current" id="softPaginate-0-'.$loadType.'">F i r s t</a>
										</li>';
										for($i=0;$i<$paginationCount;$i++){

										$pagiNav .='<li>
											<a  href="javascript:;" class="softPaginate" id="softPaginate-'.$i.'-'.$loadType.'">
										'.($i+1).'
										</a>
										</li>';
										}

							$pagiNav .='<li>
										<a href="javascript:;" class="softPaginate last" id="softPaginate-'.$lastPage.'-'.$loadType.'">L a s t</a>
										</li>
										<li class="flash"></li>
										</ul>';
										
							echo $pagiNav;
						
						} 

				}else{

					echo $infoMsg.$msg_e.$iEnd; //exit; 			

				} 

			}

		}	

		function userCompanionWall($conn, $userID) {  /* show a student companion wall post */

			global $cWallPostTB, $foreal, $i_false, $fobrainTemplate, $forumPicExt, $fiVal, $seVal, $thVal, $foVal, $regNum, $wiz_default_img, 
			$succesMsg, $errorMsg, $warningMsg, $infoMsg,  $sEnd, $eEnd, $iEnd, $wEnd, $cWallNumPerPage;
			$changeProfPic = '';  $postMessage2 = ""; $showMailReportBox = "";

			$ebele_mark = "SELECT post_id

							FROM $cWallPostTB  
							
							WHERE author_id = :author_id 
							
							ORDER BY post_id DESC";
				

			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue(':author_id', $userID);	

			$igweze_prep->execute();
			$rows_count = $igweze_prep->rowCount();

			$ebele_mark_1 = "SELECT post_id, author_id, post_title, post_msg, post_img_fi, post_img_se, post_img_th, post_img_fo, 
					post_date, post_ip, post_type

								FROM $cWallPostTB  
								
								WHERE author_id = :author_id 
								
								ORDER BY post_id DESC
								
								LIMIT $cWallNumPerPage";
					

			$igweze_prep_1 = $conn->prepare($ebele_mark_1);
			$igweze_prep_1->bindValue(':author_id', $userID);				
				
			$igweze_prep_1->execute();

			$rows_count_1 = $igweze_prep_1->rowCount(); 

			if($rows_count_1 >= $foreal) {
				
				echo '<div id="paginatePCWDiv">';		
				//echo '<div id="wallPaginateDiv">';
				
				while($row = $igweze_prep_1->fetch(PDO::FETCH_ASSOC)) {		

					$post_id = $row['post_id'];  
					$author_id = $row['author_id'];
					$post_title = $row['post_title'];
					$post_msg = $row['post_msg'];
					$post_img_fi = $row['post_img_fi'];
					$post_img_se = $row['post_img_se'];
					$post_img_th = $row['post_img_th'];
					$post_img_fo = $row['post_img_fo'];
					$post_time = $row['post_date'];
					$post_type = $row['post_type']; 
					
					$post_date = wallTimerBoy($post_time);						
					$post_msg = htmlspecialchars_decode($post_msg);						
					$post_Edit = $post_msg;						
					$post_msg = nl2br($post_msg);
					
					$checkEdit = $i_false;
					
					$thisUserInfo = companionWallUserDetails($conn, $_SESSION['regNo'], $seVal);						
					list ($this_user_id, $faRegNum_this, $m_name_this, $m_sex_this, $prof_pic_comm) = explode ("##", $thisUserInfo);	
					
					$memberInfo = companionWallUserDetails($conn, $author_id, $fiVal);					
					list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic) = explode ("##", $memberInfo);
					
					$genderVerb = genderVerb($m_sex);
					
					$postLikes = companionWallLikes($conn, $post_id, $member_id);
					
					$postLikesMore = companionWallMoreLikes($conn, $post_id, $member_id); 
					
					$commentDiv = commentsNum($conn, $post_id);
					
					if (($member_id == $author_id) && ($faRegNum == $regNum)) { $checkPostAuthor = true;}
					else {$checkPostAuthor = false;}
					
					if($post_type == $seVal) {

						if  (($post_img_fi != '') && (file_exists($forumPicExt.$post_img_fi))){

							$fi_upload = renderPictures($post_img_fi, $checkPostAuthor); 
						
						}

						if  (($post_img_se != '') && (file_exists($forumPicExt.$post_img_se))){

							$se_upload = renderPictures($post_img_se, $checkPostAuthor); 
						
						}

						if  (($post_img_th != '') && (file_exists($forumPicExt.$post_img_th))){

							$th_upload = renderPictures($post_img_th, $checkPostAuthor); 
						
						}

						if  (($post_img_fo != '') && (file_exists($forumPicExt.$post_img_fo))){

							$fo_upload = renderPictures($post_img_fo, $checkPostAuthor); 
						
						} 

						$postMessage = "$post_title";
										
						$postMessage2 = "
										<div class='row my-5'>

										$fi_upload $se_upload
										$th_upload $fo_upload 
										
										</div>";
						
						$post_Edit = '';
						$checkEdit = $foreal;
						$changeProfPic = '';
						
					
					}elseif($post_type == $thVal) {

						if  (($post_img_fi != '') && (file_exists($forumPicExt.$post_img_fi))){

							$profilePic = renderPictures($post_img_fi, $checkPostAuthor); 
						
						}  
						
						$postMessage = "Changed $genderVerb Profile Picture";
						
						$postMessage2 = " 
						<div class='row my-5 $post_id'> 
							$profilePic 
						</div>";
						
						$post_Edit = $foreal;
						$checkEdit = $foreal; 
					
					}elseif($post_type == $foVal) {
					
						if  (($post_img_fi != '') && (file_exists($forumPicExt.$post_img_fi))){

							$wallPic = renderPictures($post_img_fi, $checkPostAuthor); 
						
						}  
						
						$postMessage = "
						Changed $genderVerb wall cover picture"; 
						
						$postMessage2 = " 
						<div class='row my-5 $post_id'> 
							$wallPic 
						</div>";  
						
						$post_Edit = $foreal;
						$checkEdit = $foreal; 
					
					}else{
					
						$postMessage = $post_msg;
					
					}
					
						
					if (($this_user_id == $author_id) && ($faRegNum_this == $faRegNum) || ($_SESSION['wall-general'] == 1)) {
					
						if ($checkEdit == $i_false){
						
							$show_detele = ' 
							<a href="javascript:;" class="post-delete-btn " id="FDel-'.$post_id.'"> 
								<i class="mdi mdi-delete-circle-outline"></i>  
							</a>  
								
							<a href="javascript:;" class="post-edit-btn" id="FEdit-'.$post_id.'"> 
								<i class="mdi mdi-circle-edit-outline"></i>  
							</a>			  		
							'; 
						
						}elseif($checkEdit == $foreal){
						
							$show_detele = ' 
							<a href="javascript:;" class="post-delete-btn" id="FDel-'.$post_id.'"> 
								<i class="mdi mdi-delete-circle-outline"></i>
							</a>  
							'; 
						
						}elseif($checkEdit == $seVal){
						
							$show_detele = '';					
						
						}else{
						
							$show_detele = '';
						
						}	

						$showMailReportBox = '';
					
					}else{
					
						$show_detele = '';
						
						$showMailReportBox = '
							<div class="col">
								<a href="javascript:;" id="sendMailPosts-'.$post_id.'-'.$author_id.'" title="Send Private Message"
								class="sendMailPosts">
									<i class="far fa-comment-dots"></i> <span class="hide-res">Send PM</span>
								</a>
							</div>
							
							<div class="col">
								<a href="javascript:;" id="sendReportPosts-'.$post_id.'-'.$author_id.'" title="Report User"
								class="sendReportPosts">
									<i class="far fa-comments"></i> <span class="hide-res">Report</span>
								</a>
							</div> 
							<span id="mailReportPostsMsg_'.$post_id.'"></span> 
							<span id="mailReportPostsDiv_'.$post_id.'"> </span>							
						';
					
					}
					
					$showSlideUp = '
					<a href="javascript:;" title="Slide Up" 
						id="slideCommentsDiv-'.$post_id.'" class="slideCommentsDiv display-none ms-10"> 
						<i class="fas fa-chevron-up"></i> 
					</a>';   

					$stuFpic = picture($forumPicExt, $prof_pic, "student");
					
					$stuPic = '<img src="'.$stuFpic.'" class="poster-img" />';
										
					$post_row_id =  "post_".$post_id;
					
					$edit_row_id =  "editPost_".$post_id;	
				
			
$posts =<<<IGWEZE

	<li class="post-list"  id= "$post_row_id">
		<div class="comment-main-level">
			<!-- avatar -->
			<div class="comment-avatar">
				<a href="javascript:;" class="showcompanionWallUser"  id="companionWallUser-$member_id">
					<img src="$stuFpic" alt="">
				</a>
			</div>
			<!-- companion wall posts -->
			<div class="comment-box">
				<div class="comment-head post-h-bg">
					<h6 class="comment-name by-author">
						<a href="javascript:;" class="showcompanionWallUser"  id="companionWallUser-$member_id">
						$m_name
						</a>
					</h6>
					<span>$post_date</span>
					<b>$show_detele</b>
				</div>
				<div class="comment-content" id='$edit_row_id'>
					$postMessage 
					
					$postMessage2
					
				</div>
			
				<div class="row comment-btm"> 
					<div class="col">
							<a href="javascript:;" title="Like this">
								$postLikes
							</a>
						</div>
						<div class="col">
							<a href="javascript:;" title="Leave a comment" class='comment-div' id='commentNumStatus-$post_id'>
								$commentDiv  
							</a>
							
							$showSlideUp
							
						</div>
						$showMailReportBox	
				</div>
				<div class="row comment-like-div"> 
					<div class="col">
						<span id="likeDetails-$post_id">$postLikesMore</span>
					</div>
				</div>
			</div>							
		</div>
		
		<!-- companion wall comments -->
		<ul class="commentDivPostSub comments-list display-none reply-list mt-0" id = "commentDivSub-$post_id">'	
			<!-- <li><h4 class="font-head-1">Comments</h4></li> -->

	
IGWEZE;

					echo $posts;

					companionWallComments($conn, $post_id);

					echo '</ul> </li>'; 
					
					$post_msg =''; $postMessage = ""; $postMessage2 = ""; $checkPostAuthor = ''; 
					$post_type = ""; $showMailReportBox = ''; $changeProfPic = '';
					$fi_upload =''; $se_upload =''; $th_upload =''; $fo_upload =''; 

				}

				echo '</div>';
				
				if($rows_count >= $i_false) {

					$paginationCount = getPagination($rows_count, $cWallNumPerPage);
					$lastPage = $paginationCount - 1;
					if($rows_count > $cWallNumPerPage){

						$pagiNav .='<ul class="tsc_pagination tsc_paginationA tsc_paginationA12">
									<li>
									<a  href="javascript:;" class="softPaginatePCW first current" id="softPaginatePCW-0-'.$member_id.'">
									F i r s t</a>
									</li>';
									
									for($i=0;$i<$paginationCount;$i++){

									$pagiNav .='<li>
										<a  href="javascript:;" class="softPaginatePCW" id="softPaginatePCW-'.$i.'-'.$member_id.'">
									'.($i+1).'
									</a>
									</li>';
									}

						$pagiNav .='<li>
									<a href="javascript:;" class="softPaginatePCW last" id="softPaginatePCW-'.$lastPage.'-'.$member_id.'">
									L a s t</a>
									</li>
									<li class="flash"></li>
									</ul>';
								
						echo $pagiNav;
					
					}
					
				} 

			}else{

				$msg = "Ooops, there is no post to display. . . . . . You are Fabulous"; 
				echo $infoMsg.$msg.$iEnd; //exit; 			

			} 
		}


		function companionWallAlerts($conn, $postID) {  /* show companion wall notification */

			global $cWallPostTB, $foreal, $fobrainTemplate, $forumPicExt, $fiVal, $seVal, $thVal, $foVal, $regNum, $wiz_default_img, 
			$succesMsg, $errorMsg, $warningMsg, $infoMsg,  $sEnd, $eEnd, $iEnd, $wEnd, $cWallNumPerPage;
			$changeProfPic = ''; 

			$ebele_mark = "SELECT post_id, author_id, post_title, post_msg, post_img_fi, post_img_se, post_img_th, post_img_fo, 
					post_date, post_ip, post_type

								FROM $cWallPostTB  
								
								WHERE post_id = :post_id";

			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindParam(':post_id', $postID, PDO::PARAM_INT); 
			$igweze_prep->execute(); 
			$rows_count = $igweze_prep->rowCount(); 

			if($rows_count == $foreal) {
					
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		

					$post_id = $row['post_id'];  
					$author_id = $row['author_id'];
					$post_title = $row['post_title'];
					$post_msg = $row['post_msg'];
					$post_img_fi = $row['post_img_fi'];
					$post_img_se = $row['post_img_se'];
					$post_img_th = $row['post_img_th'];
					$post_img_fo = $row['post_img_fo'];
					$post_time = $row['post_date'];
					$post_type = $row['post_type']; 
					
					$post_date = wallTimerBoy($post_time);
					
					$post_msg = htmlspecialchars_decode($post_msg);
					
					$post_Edit = $post_msg;
					
					$post_msg = nl2br($post_msg);
					
					$checkEdit = $i_false;
					
					$thisUserInfo = companionWallUserDetails($conn, $_SESSION['regNo'], $seVal);
					
					list ($this_user_id, $faRegNum_this, $m_name_this, $m_sex_this, $prof_pic_comm) = explode ("##", $thisUserInfo);	
					
					$memberInfo = companionWallUserDetails($conn, $author_id, $fiVal);
				
					list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic) = explode ("##", $memberInfo);
					
					$genderVerb = genderVerb($m_sex);
					
					$postLikes = companionWallLikes($conn, $post_id, $member_id);
					
					$postLikesMore = companionWallMoreLikes($conn, $post_id, $member_id); 
					
					$commentDiv = commentsNum($conn, $post_id);
					
					if (($member_id == $author_id) && ($faRegNum == $regNum)) { $checkPostAuthor = true;}
					else {$checkPostAuthor = false;}
				
					if($post_type == $seVal) {
				
						if  (($post_img_fi != '') && (file_exists($forumPicExt.$post_img_fi))){

							$fi_upload = renderPictures($post_img_fi, $checkPostAuthor); 
						
						}

						if  (($post_img_se != '') && (file_exists($forumPicExt.$post_img_se))){

							$se_upload = renderPictures($post_img_se, $checkPostAuthor); 
						
						}

						if  (($post_img_th != '') && (file_exists($forumPicExt.$post_img_th))){

							$th_upload = renderPictures($post_img_th, $checkPostAuthor); 
						
						}

						if  (($post_img_fo != '') && (file_exists($forumPicExt.$post_img_fo))){

							$fo_upload = renderPictures($post_img_fo, $checkPostAuthor); 
						
						} 

						$postMessage = "$post_title";
										
						$postMessage2 = "
										<div class='row my-5'>

										$fi_upload $se_upload
										$th_upload $fo_upload 
										
										</div>";				
						
						$post_Edit = '';
						$checkEdit = $foreal;
						$changeProfPic = '';
						
					
					}elseif($post_type == $thVal) {
					
						if  (($post_img_fi != '') && (file_exists($forumPicExt.$post_img_fi))){

							$profilePic = renderPictures($post_img_fi, $checkPostAuthor); 
						
						} 

						$postMessage = "Changed $genderVerb Profile Picture";
						
						$postMessage2 = " 
						<div class='row my-5 $post_id'> 
							$profilePic 
						</div>"; 
						
						$post_Edit = $foreal;
						$checkEdit = $foreal; 
					
					}elseif($post_type == $foVal) {
					
						if  (($post_img_fi != '') && (file_exists($forumPicExt.$post_img_fi))){

							$wallPic = renderPictures($post_img_fi, $checkPostAuthor); 
						
						}  
						
						$postMessage = "
						Changed $genderVerb wall cover picture"; 
						
						$postMessage2 = " 
						<div class='row my-5 $post_id'> 
							$wallPic 
						</div>";  
						
						$post_Edit = $foreal;
						$checkEdit = $foreal;  
					
					}else{
					
						$postMessage = $post_msg;
					
					}
					
						
					if(($checkPostAuthor == true) || ($_SESSION['wall-general'] == 1)) {
					
						if ($checkEdit == $i_false){
						
							$show_detele = ' 
							<a href="javascript:;" class="post-delete-btn " id="FDel-'.$post_id.'"> 
								<i class="mdi mdi-delete-circle-outline"></i>  
							</a>  
								
							<a href="javascript:;" class="post-edit-btn" id="FEdit-'.$post_id.'"> 
								<i class="mdi mdi-circle-edit-outline"></i>  
							</a>			  		
							';
						
						}elseif($checkEdit == $foreal){
						
							$show_detele = ' 
							<a href="javascript:;" class="post-delete-btn" id="FDel-'.$post_id.'"> 
								<i class="mdi mdi-delete-circle-outline"></i>
							</a>  
							';
						
						}elseif($checkEdit == $seVal){
						
							$show_detele = '';					
						
						}else{
						
							$show_detele = '';
						
						}
					
						$showMailReportBox = '';
					
					}else{
					
						$show_detele = '';
						$showMailReportBox = '
							<div class="col">
								<a href="javascript:;" id="sendMailPosts-'.$post_id.'-'.$author_id.'" title="Send Private Message"
								class="sendMailPosts">
									<i class="far fa-comment-dots"></i> <span class="hide-res">Send PM</span>
								</a>
							</div>
							
							<div class="col">
								<a href="javascript:;" id="sendReportPosts-'.$post_id.'-'.$author_id.'" title="Report User"
								class="sendReportPosts">
									<i class="far fa-comments"></i> <span class="hide-res">Report</span>
								</a>
							</div> 
							<span id="mailReportPostsMsg_'.$post_id.'"></span> 
							<span id="mailReportPostsDiv_'.$post_id.'"> </span>							
						';

					
					}
					
					
					$showSlideUp = '
					<a href="javascript:;" title="Slide Up" 
						id="slideCommentsDiv-'.$post_id.'" class="slideCommentsDiv display-none ms-10"> 
						<i class="fas fa-chevron-up"></i> 
					</a>';
					
					$stuFpic = picture($forumPicExt, $prof_pic, "student");
					
					$stuPic = '<img src="'.$stuFpic.'" class="poster-img" />';
										
					$post_row_id =  "post_".$post_id;
					
					$edit_row_id =  "editPost_".$post_id;	
			
			
$posts =<<<IGWEZE

	<li class="post-list"  id= "$post_row_id">
		<div class="comment-main-level">
			<!-- avatar -->
			<div class="comment-avatar">
				<a href="javascript:;" class="showcompanionWallUser"  id="companionWallUser-$member_id">
					<img src="$stuFpic" alt="">
				</a>
			</div>
			<!-- companion wall posts -->
			<div class="comment-box">
				<div class="comment-head post-h-bg">
					<h6 class="comment-name by-author">
						<a href="javascript:;" class="showcompanionWallUser"  id="companionWallUser-$member_id">
						$m_name
						</a>
					</h6>
					<span>$post_date</span>
					<b>$show_detele</b> 
				</div>
				<div class="comment-content" id='$edit_row_id'>
					$postMessage 
					
					$postMessage2
					
				</div>
			
				<div class="row comment-btm"> 
					<div class="col">
							<a href="javascript:;" title="Like this">
								$postLikes
							</a>
						</div>
						<div class="col">
							<a href="javascript:;" title="Leave a comment" class='comment-div' id='commentNumStatus-$post_id'>
								$commentDiv  
							</a>
							
							$showSlideUp
							
						</div>
						$showMailReportBox	
				</div>
				<div class="row comment-like-div"> 
					<div class="col">
						<span id="likeDetails-$post_id">$postLikesMore</span>
					</div>
				</div>
			</div>							
		</div>
		
		<!-- companion wall comments -->
		<ul class="commentDivPostSub comments-list display-none reply-list mt-0" id = "commentDivSub-$post_id">'	
			<!-- <li><h4 class="font-head-1">Comments</h4></li> --> 
	
IGWEZE;
				
					echo $posts;
				
					companionWallComments($conn, $post_id);
				
									
					echo '</ul> </li>';
			
					$post_msg =''; $postMessage = ""; $postMessage2 = ""; $checkPostAuthor = ''; 
					$post_type = ""; $showMailReportBox = ''; $changeProfPic = '';
					$fi_upload =''; $se_upload =''; $th_upload =''; $fo_upload ='';

				} 

			}else{

				$msg = "Ooops, something went wrong while retrieving post or the post might have been deleted.";
				echo $infoMsg.$msg.$iEnd; //exit; 			

			} 

		}


		function companionWallLikes($conn, $post_id, $check_user) {  /* show companion wall post likes & dislike */

			global $cWallLikesTB, $foreal;

			$ebele_mark = "SELECT likes_id, post_id, member_id

							FROM $cWallLikesTB

							WHERE post_id = :post_id";
					
			$igweze_prep = $conn->prepare($ebele_mark);

			$igweze_prep->bindValue(':post_id', $post_id);
				
			$igweze_prep->execute();

			$memberArrays = array();	   
			array_unshift($memberArrays,"");
			unset($memberArrays[0]);

			$rows_count = $igweze_prep->rowCount(); 

			if($rows_count >= $foreal) {
				
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		

					$member_id = $row['member_id'];					
					$memberArrays[] = $member_id; 
				
				}

				$memberArrays = array_unique($memberArrays); 
				
				if($rows_count > $foreal){ $like = ' likes';  }
				else {$like = ' like';} 

				if(in_array($check_user, $memberArrays)){	

					$show_like = ' 
					
					<span  class="dislikePosts fb-time-action-like" id="dislikePosts-'.$post_id.'">
						<i class="far fa-thumbs-up"></i> '.$rows_count.'<strong> Dislike </strong>
					</span>';

				}else{
				
					$show_like = '
					<span  class="likePosts fb-time-action-like" id="likePosts-'.$post_id.'"> 
						<i class="far fa-thumbs-up"></i> '.$rows_count.'<strong> '.$like.'</strong>
					</span>';
				
				}
				
			}else{

				$rows_count = '';
				$show_like = '
				<span  class="likePosts fb-time-action-like" id="likePosts-'.$post_id.'">
					<i class="far fa-thumbs-up"></i> '.$rows_count.' <strong> Like</strong>
				</span>'; 

			} 

			return $show_like;				 

		}


		function companionWallMoreLikes($conn, $fpost_id, $check_user) {  /* show more companion wall post likes & dislike */

			global $cWallLikesTB, $foreal, $fiVal, $foVal; $likePpl = "";

			$ebele_mark = "SELECT member_id
			
							FROM $cWallLikesTB
			
							WHERE post_id = :post_id";
					
			$igweze_prep = $conn->prepare($ebele_mark);			
			$igweze_prep->bindValue(':post_id', $fpost_id);				
			$igweze_prep->execute();
			
			$rows_count = $igweze_prep->rowCount(); 
			$memberArrays = array();	   
			array_unshift($memberArrays,"");
			unset($memberArrays[0]);
			
			if($rows_count >= $foreal) {
			
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		

					$member_id = $row['member_id'];					
					$memberArrays[] = $member_id;				
				
				}

				$memberArrays = array_unique($memberArrays);					
				$count = count($memberArrays);
				
				$moreLink = ' <span> like this</span>';
				if($count > $foVal) { 
				
					$moreLike = ($count - $foVal); 
					$moreLink = '<span>and</span> 
					<a href="javascript:;">'.$moreLike.' more </a> <span>like this</span>'; 
					$count = $foVal;
				}
				
				
				if(in_array($check_user, $memberArrays)) { 
				
					$likePpl = '<a href="javascript:;" class="showcompanionWallUser" id="companionWallUser-'.$check_user.'">You</a>, '; 
				}

				for($i = $fiVal; $i <= $count; $i++) {
					
					$memberID = $memberArrays[$i]; 
					
					if($memberID == $check_user){
						
					
					}else{
						
						$memberInfo = companionWallUserDetails($conn, $memberID, $fiVal);
				
						list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic) = explode ("##", $memberInfo);	

						if($m_name != '-'){
							$likePpl .= '<a href="javascript:;" class="showcompanionWallUser" 
							id="companionWallUser-'.$member_id.'">'.$m_name.'</a>, ';
						}
						
						$memberInfo = ''; $memberID = '';
					
					}
				}
				
				$pplLikes = $likePpl; 
				$likesTrim = trim($pplLikes, ', ');				
				$likes = $likesTrim.$moreLink;

				return $likes; 

			}

		}

		function companionWallComments($conn, $post_id) {  /* load companion wall post comment */

			global $cWallCommentTB, $foreal, $fiVal, $seVal, $fobrainTemplate, $forumPicExt, $wiz_default_img;
			$showMailReportBox = "";
			
			$thisUserInfo = companionWallUserDetails($conn, $_SESSION['regNo'], $seVal);
					
			list ($this_user_id, $faRegNum_this, $m_name_this, $m_sex_this, $prof_pic_comm) = explode ("##", $thisUserInfo);	
			
			$stuUserpic = picture($forumPicExt, $prof_pic_comm, "student"); 
					
			$stuPicUser = '<img src="'.$stuUserpic.'" class="" />';


			$ebele_mark = "SELECT comment_id, post_id, comment, comment_title, comment_pic, comment_date, comment_user	

								FROM $cWallCommentTB 
								
								WHERE post_id = :post_id
								
								ORDER BY comment_id ASC";
					
			$igweze_prep = $conn->prepare($ebele_mark);			
			$igweze_prep->bindValue(':post_id', $post_id);				
			$igweze_prep->execute();
			
			$rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count >= $foreal) {
			
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		

					$comment_id = $row['comment_id'];
					$post_id = $row['post_id'];
					$comment = $row['comment'];
					$comment_title = $row['comment_title'];
					$comment_pic = $row['comment_pic'];
					$comment_date = $row['comment_date'];
					$comment_user = $row['comment_user'];
					
					$comment = htmlspecialchars_decode($comment);
					
					$comment_Edit = $comment;
					$comment = nl2br($comment);
										
					$comment_time = wallTimerBoy($comment_date);
					
					$memberInfo = companionWallUserDetails($conn, $comment_user, $fiVal);
					
					list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic) = explode ("##", $memberInfo);
					
					$commenrLikes = companionWallComLikes($conn, $comment_id, $this_user_id);
					
					if(($this_user_id == $comment_user) || ($_SESSION['wall-general'] == 1)){
					
						$show_detele = ' 
					
						
						<a href="javascript:;" class="comment-delete-btn" id="delC-'.$comment_id.'-'.$post_id.'"> 
							<i class="mdi mdi-delete-circle-outline"></i>  
						</a>  
							
						<a href="javascript:;" class="comment-edit-btn" id="editC-'.$comment_id.'-'.$post_id.'"> 
							<i class="mdi mdi-circle-edit-outline"></i>  
						</a>';

						$showMailReportBox = '';	
					
					}else{
						
						$show_detele = '';
						
						
						$showMailReportBox = '
						
						<div class="col">
							<a href="javascript:;" 
							id="sendMailComments-'.$post_id.'-'.$comment_id.'-'.$comment_user.'" 
							title="Send Private Message" class="sendMailComments">
								<i class="far fa-comment-dots"></i> <span class="hide-res">Send PM</span>
							</a>
						</div>
						
						<div class="col">
							<a href="javascript:;" id="sendReportComments-'.$post_id.'-'.$comment_id.'-'.$comment_user.'" 
							title="Report User" class="sendReportComments">
								<i class="far fa-comments"></i> <span class="hide-res">Report</span>
							</a>
						</div> 
														
						<span id="mailReportCommentsMsg_'.$post_id.'_'.$comment_id.'_'.$comment_user.'"> </span>
						<span id="mailReportCommentsDiv_'.$post_id.'_'.$comment_id.'_'.$comment_user.'"> </span>';

					} 
					
					$stuFpic = picture($forumPicExt, $prof_pic, "student"); 
					
					$stuPic = '<img src="'.$stuFpic.'" class="comment-imga" />';															
					$post_row_id =  "post_".$post_id;					
					$edit_comment_id =  "editcomment_".$comment_id.'_'.$post_id;
					$comment_row_id =  "comment_".$comment_id;

$commentMsg =<<<IGWEZE

					<li id= "$comment_row_id">
						<!-- avatar -->
						<div class="comment-avatar">
							<a href="javascript:;" class="showcompanionWallUser" id="companionWallUser-$member_id">
								<img src="$stuFpic">
							</a>
						</div>
						<!-- companion wall posts -->
						<div class="comment-box" style="position: relative; top: -10px;">
							<div class="comment-head comment-h-bg">
								<h6 class="comment-name">
									<a href="javascript:;" class="showcompanionWallUser" id="companionWallUser-$member_id">
									$m_name
									</a>
								</h6> 
								<span> - $comment_time</span>
								<b>$show_detele</b>
							</div>
							<div class="comment-content">
								<span id='$edit_comment_id'> $comment </span>
							</div>
							<div class="row comment-btm"> 
								<div class="col">
									<a href="javascript:;">
										$commenrLikes
									</a>
								</div>
								$showMailReportBox
							</div>
						</div>
					</li> 			
	
IGWEZE;
					echo $commentMsg;
						
					$showMailReportBox ='';$commenrLikes ='';
			
				}
			

			}else{}

			//$upload_comment_img = $fobrainTemplate.'images/upload_icon.png';


$comment_body =<<<IGWEZE

			<div id="newCommentDiv-$post_id"></div>		 
			<li> 
				<div class="row comment-input-div animate__animated animate__shakeX">   
					<!-- form -->
					<form method="POST" id="frmComment-$post_id" class="highlight-textarea">
						<input type="hidden" name="postFData" value="sendCommentFData" />
						<input type="hidden" name="PostID" value="$post_id" />
						
						<textarea class="form-control comment-input commentField-$post_id"
						rows="3" name="cwall-comment-div" onclick="highlight();"
						id="fPostField" placeholder="Comment on this post"></textarea> 

						<button class="btn btn-primary  btn-sm mt-10 pull-right commentStatus" id="commentStatus-$post_id">Comment</button>

						<div class="display-none pull-right" id="commentLoader-$post_id"> 
							<strong role="status">Processing...</strong>
							<div class="spinner-border ms-auto text-danger" aria-hidden="true"></div>
						</div>

					</form>
					<!-- / form -->  
				</div> 
			</li> 

IGWEZE;

			echo $comment_body;
		}


		function commentsNum($conn, $post_id) {  /* count number post comments */

			global $cWallCommentTB, $foreal;			 
			
			$ebele_mark = "SELECT comment_id

								FROM $cWallCommentTB 
								
								WHERE post_id = :post_id";
					
			$igweze_prep = $conn->prepare($ebele_mark);					
			$igweze_prep->bindValue(':post_id', $post_id);					 
			$igweze_prep->execute();
			
			$rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count == 0){ $commment = "<i class='far fa-comment-alt'></i> <strong>0</strong> ";}
			elseif($rows_count == 1){ $commment = "<i class='far fa-comment-alt'></i>  <strong>1</strong> ";}				
			elseif($rows_count >= 2){ $commment = "<i class='far fa-comment-alt'></i> <strong>$rows_count</strong> ";}
			else{$commment = "<i class='far fa-comment-alt'></i>  <strong>0</strong>";}			
			
			return $commment;

		}

		function companionWallComLikes($conn, $comment_id, $check_user) {  /* show companion wall comment likes & dislike */

			global $cWallLikesTB, $foreal;

			$ebele_mark = "SELECT likes_id, comment_id,  member_id
			
							FROM $cWallLikesTB
			
							WHERE comment_id = :comment_id";
					
			$igweze_prep = $conn->prepare($ebele_mark);				
			$igweze_prep->bindValue(':comment_id', $comment_id);				 
			$igweze_prep->execute();

			$memberArrays = array();	   
			array_unshift($memberArrays,"");
			unset($memberArrays[0]);
			
			$rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count >= $foreal) {
				
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		

					$member_id = $row['member_id'];					
					$memberArrays[] = $member_id;					
					
				}

				$memberArrays = array_unique($memberArrays);				

				if($rows_count > $foreal){ $like = 'likes';  }else {$like = 'like';} 
				
				if(in_array($check_user, $memberArrays)){		
					
					$show_like = '<span  class="disLikeComments fb-time-action-like" id="disLikeComments-'.$comment_id.'">
					<i class="fa fa-thumbs-o-up"></i> '.$rows_count.'<strong> Dislike </strong></span>';

				}else{
				
					$show_like = '<span  class="likeComments fb-time-action-like" id="likeComments-'.$comment_id.'">
					<i class="fa fa-thumbs-o-up"></i> '.$rows_count.' <strong>'.$like.'</strong></span>';
				
				}
				
			}else{
			
				$rows_count = '';
				$show_like = '<span  class="likeComments fb-time-action-like" id="likeComments-'.$comment_id.'">
				<i class="fa fa-thumbs-o-up"></i> '.$rows_count.' <strong>Like</strong></span>';
					
			
			} 

			return $show_like;	 

		}


		function uploadTempDetails($conn, $member_id) {  /* upload temporary companion pictures */

			global $cWallTempUploadTB, $foreal, $fiVal;

			$ebele_mark = "SELECT upload_id, upload_pathp

								FROM $cWallTempUploadTB

								WHERE member_id = :member_id
								
								AND upload_type = :upload_type";
					

			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue(':member_id', $member_id);
			$igweze_prep->bindValue(':upload_type', $fiVal);				 
			$igweze_prep->execute();
							
			$rows_count = $igweze_prep->rowCount(); 
			
			$picVal = "";

			if($rows_count >= $foreal) {
			
				while($row[] = $igweze_prep->fetch(PDO::FETCH_BOTH)) { }	

				if($rows_count == 1){
				
					$picVal = $row[0][1].'@@@';
					
				}elseif($rows_count == 2){
				
					$picVal = $row[0][1].'@'.$row[1][1].'@@';
				
				}elseif($rows_count == 3){
				
					$picVal = $row[0][1].'@'.$row[1][1].'@'.$row[2][1].'@';
				
				}elseif($rows_count == 4){
				
					$picVal = $row[0][1].'@'.$row[1][1].'@'.$row[2][1].'@'.$row[3][1];
				
				}else{
				
					$picVal = '@@@@';
				
				}
				
				$uTempDetails = $rows_count.'@'.$picVal;	
			
			}else{
				
				$rows_count = 0;				
				$uTempDetails = $rows_count.'@@@@';	

			}
			
			return $uTempDetails;

		}


		function profPicTempDetails($conn, $member_id) {   /* upload temporary profile companion picture */

			global $cWallTempUploadTB, $foreal, $seVal;

			$ebele_mark = "SELECT upload_id, upload_pathp

								FROM $cWallTempUploadTB

								WHERE member_id = :member_id
								
								AND upload_type = :upload_type";
					

			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue(':member_id', $member_id);
			$igweze_prep->bindValue(':upload_type', $seVal);					 
			$igweze_prep->execute();
							
			$rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count == $foreal) {
			
				while($row = $igweze_prep->fetch(PDO::FETCH_BOTH)) {		
				
					$profPic = $row['upload_pathp'];
					
				}	
				
				$uTempDetails = $profPic;	
			
			}else{
			
			
				$uTempDetails = '';	

			}
			
			return $uTempDetails;

		}


		function insertTempUpload($conn, $upload_path, $member_id) {  /* insert companion pictures information */

			global $cWallTempUploadTB, $foreal, $fiVal, $foVal;
						
			$ebele_mark = "SELECT upload_id

								FROM $cWallTempUploadTB

								WHERE member_id = :member_id";
					

			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue(':member_id', $member_id);					 
			$igweze_prep->execute();
							
			$rows_count = $igweze_prep->rowCount(); 
			
			if ($rows_count < $foVal){
			
				$ebele_mark_1= "INSERT INTO $cWallTempUploadTB
								(upload_pathp, member_id, upload_type)

								VALUES (:upload_pathp, :member_id, :upload_type)";

				$igweze_prep_1 = $conn->prepare($ebele_mark_1);
				$igweze_prep_1->bindValue(':upload_pathp', $upload_path);
				$igweze_prep_1->bindValue(':member_id', $member_id);
				$igweze_prep_1->bindValue(':upload_type', $fiVal);										
				$igweze_prep_1->execute();
			
			}			
			
		}


		function insertTempProfPic($conn, $upload_path, $member_id) {  /* insert companion profile picture information */

			global $cWallTempUploadTB, $foreal, $fiVal, $seVal;
					
			$ebele_mark = "SELECT upload_id

								FROM $cWallTempUploadTB

								WHERE member_id = :member_id";						 

			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue(':member_id', $member_id);					 
			$igweze_prep->execute();
							
			$rows_count = $igweze_prep->rowCount(); 
			
			if ($rows_count < $fiVal){
			
				$ebele_mark_1= "INSERT INTO $cWallTempUploadTB
								(upload_pathp, member_id, upload_type)

								VALUES (:upload_pathp, :member_id, :upload_type)";

				$igweze_prep_1 = $conn->prepare($ebele_mark_1);
				$igweze_prep_1->bindValue(':upload_pathp', $upload_path);
				$igweze_prep_1->bindValue(':member_id', $member_id);
				$igweze_prep_1->bindValue(':upload_type', $seVal);										
				$igweze_prep_1->execute();
			
			}		

		}

		function removeTempUpload($conn, $member_id, $status) {  /* remove temporary companion pictures information */

			global $cWallTempUploadTB, $foreal, $forumPicExtTem; 
					
			if($status == 'deleteTempPic'){
			
				$tempDetails = uploadTempDetails($conn, $member_id);
				$tempProfPic = profPicTempDetails($conn, $member_id);	
													
				list ($count, $fi_img, $se_img, $th_img, $fo_img) = explode ("@", $tempDetails);
			
				if($fi_img == ''){ $fi_img = 'hmmmmmmmmmmmm004.jpg';}
				if($se_img == ''){ $se_img = 'hmmmmmmmmmmmm004.jpg';}
				if($th_img == ''){ $th_img = 'hmmmmmmmmmmmm004.jpg';}
				if($fo_img == ''){ $fo_img = 'hmmmmmmmmmmmm004.jpg';}
				if($tempProfPic == ''){ $tempProfPic = 'hmmmmmmmmmmmm004.jpg';}
				if(file_exists($forumPicExtTem.$fi_img)){ unlink($forumPicExtTem.$fi_img); }
				if(file_exists($forumPicExtTem.$se_img)){ unlink($forumPicExtTem.$se_img); }
				if(file_exists($forumPicExtTem.$th_img)){ unlink($forumPicExtTem.$th_img); }
				if(file_exists($forumPicExtTem.$fo_img)){ unlink($forumPicExtTem.$fo_img); }
				if(file_exists($forumPicExtTem.$tempProfPic)){ unlink($forumPicExtTem.$tempProfPic); }
				
			}	

			
			$ebele_mark = "DELETE FROM $cWallTempUploadTB
			
							WHERE member_id = :member_id ";

			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue(':member_id', $member_id);									
			$igweze_prep->execute(); 
							

		}

		function unlinkTempUpload($conn, $member_id, $post_id) {  /* remove temporary companion pictures information */

			global $cWallPostTB, $fobrainCWallTB, $foreal, $forumPicExt, $fiVal, $seVal;  
				
			$ebele_mark = "SELECT  post_img_fi, post_img_se, post_img_th, post_img_fo, post_type

								FROM $cWallPostTB  
								
								WHERE post_id = :post_id";
					

			$igweze_prep = $conn->prepare($ebele_mark);
			$igweze_prep->bindValue(':post_id', $post_id);					 
			$igweze_prep->execute();
			
			$rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count == $foreal) {
			
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		

					$post_type = $row['post_type']; 
					$post_img_fi = $row['post_img_fi'];
					$post_img_se = $row['post_img_se'];
					$post_img_th = $row['post_img_th'];
					$post_img_fo = $row['post_img_fo'];
					$post_type = $row['post_type'];
				
				} 
				
				if($post_type == $fiVal){
				
					if($post_img_fi == ''){ $post_img_fi = 'hmmmmmmmmmmmm004.jpg';}
					if($post_img_se == ''){ $post_img_se = 'hmmmmmmmmmmmm004.jpg';}
					if($post_img_th == ''){ $post_img_th = 'hmmmmmmmmmmmm004.jpg';}
					if($post_img_fo == ''){ $post_img_fo = 'hmmmmmmmmmmmm004.jpg';}
					if(file_exists($forumPicExt.$post_img_fi)){ unlink($forumPicExt.$post_img_fi); }
					if(file_exists($forumPicExt.$post_img_se)){ unlink($forumPicExt.$post_img_se); }
					if(file_exists($forumPicExt.$post_img_th)){ unlink($forumPicExt.$post_img_th); }
					if(file_exists($forumPicExt.$post_img_fo)){ unlink($forumPicExt.$post_img_fo); }
				
				}
				
				if($post_type == $seVal){
				
					$DelPic = '';
				
					/*$ebele_mark_1 = "UPDATE $fobrainCWallTB 
							
							SET 
							
							profile_pic = :profile_pic
							
							WHERE member_id = :member_id";

					$igweze_prep_1 = $conn->prepare($ebele_mark_1);
					$igweze_prep_1->bindValue(':profile_pic', $DelPic);
					$igweze_prep_1->bindValue(':member_id', $member_id);
					$igweze_prep_1->execute();*/

					if($post_img_fi == ''){ $post_img_fi = 'hmmmmmmmmmmmm004.jpg';}
					if(file_exists($forumPicExt.$post_img_fi)){ unlink($forumPicExt.$post_img_fi); } 
				
				}
				
			}

		}	

		function wallTimerBoy($session_time) {  /* companion wall time ago */

			$time_difference = time() - $session_time ; 
			$seconds = $time_difference ; 
			$minutes = round($time_difference / 60 );
			$hours = round($time_difference / 3600 ); 
			$days = round($time_difference / 86400 ); 
			$weeks = round($time_difference / 604800 ); 
			$months = round($time_difference / 2419200 ); 
			$years = round($time_difference / 29030400 ); 

			if($seconds <= 60)	{	$time = "$seconds seconds ago";  }
			
			else if($minutes <=60){ 
			
				if($minutes == 1) { $time = "one minute ago"; }
				else {  $time = "$minutes minutes ago";  }
			}
			else if($hours <=24) {
				if($hours==1) {  $time = "one hour ago"; }
				else {  $time = "$hours hours ago";  }
			}
			else if($days <=7) { 
				if($days==1) { $time = "one day ago"; }
				else { $time = "$days days ago"; }
			}
			else if($weeks <=4) {
				if($weeks==1) {  $time = "one week ago"; }
				else  {  $time = "$weeks weeks ago"; }
			}
			else if($months <=12) {
				if($months==1) { $time = "one month ago"; }
				else { $time = "$months months ago"; }
			}
			else {
				if($years==1){ $time = "one year ago"; }
				else{$time = "$years years ago";}
			} 
			
			return $time;

		} 


		function getExtension($str) {  /* retrieve file extensions */

			$i = strrpos($str,".");
			if (!$i) { return ""; } 

			$l = strlen($str) - $i;
			$ext = substr($str,$i+1,$l);
				return $ext;
		}


		function genderVerb($gender){  /* gender verb */

			global $fiVal, $seVal;

			if($gender == $fiVal){

				$genderVerb = 'her';

			}elseif($gender == $seVal){

				$genderVerb = 'his';

			}else{
			
				$genderVerb = '';
			
			}
			
			return $genderVerb;
		}


		function companionInbox($conn, $member_id, $inboxType, $mailoffSetVal) {  /* load companion inbox information */

			global $fobrainMailBoxTB, $foreal, $forumPicExt, $fiVal, $seVal, $thVal, $foVal, $regNum, $wiz_default_img, $succesMsg, 
			$errorMsg, $warningMsg, $infoMsg,  $sEnd, $eEnd, $iEnd, $wEnd;

			if (($inboxType != '') && ($inboxType != $fiVal)){
				
				$ebele_mark = "SELECT msg_id
				
								FROM $fobrainMailBoxTB
								
								WHERE njnk_reps_id = :njnk_reps_id
								
								AND  njnk_type = :njnk_type";

				$igweze_prep = $conn->prepare($ebele_mark);	 
				$igweze_prep->bindValue(':njnk_reps_id', $member_id);
				$igweze_prep->bindValue(':njnk_type', $inboxType);
					
			}else{

				$ebele_mark = "SELECT msg_id
				
								FROM $fobrainMailBoxTB
								
								WHERE njnk_reps_id = :njnk_reps_id
								
								AND  njnk_type = :njnk_type";

				$igweze_prep = $conn->prepare($ebele_mark);	 
				$igweze_prep->bindValue(':njnk_reps_id', $member_id);
				$igweze_prep->bindValue(':njnk_type', $fiVal); 

			}
					
			$igweze_prep->execute();
			$totalCount = $igweze_prep->rowCount();  

			if($totalCount <= 10){

				$nextPage = $totalCount;
				$pagiDetail = '1 - '.$nextPage;

				echo  "<script type='text/javascript'> 
							$('.prevMailBtn').fadeOut(10);  $('.nextMailBtn').fadeOut(10); 
							$('#pagiDetailsDiv').html('$pagiDetail');
						</script>";

			}

			if ($inboxType == $thVal){
				
				$btnSelectMsg = ' 
								<button class="btn btn-primary showInbox" href="javascript:;">
									All 
								</button>';
									
				$btnSelectAction = '
									<button class="btn btn-primary showInbox" href="javascript:;" id="deleteMsg">
										<i class="mdi mdi-trash-can-outline"></i>  Delete Draft
									</button>';	
										
			}elseif ($inboxType == $foVal){


				$btnSelectMsg = '<div class="btn-group mail-dropdown">
									<a class="btn btn-primary all dropdown-toggle" href="javascript:;" 
									data-bs-toggle="dropdown" aria-expanded="false">
										All
										<i class="fas fa-angle-down"></i>
									</a>
									<ul class="dropdown-menu fs-12  animate__animated animate__zoomIn">
										<li class="dropdown-item">
											<a href="javascript:;" id="selectReadMsg">
												<i class="mdi mdi-email-check"></i> Read Message
											</a>
										</li>
										<li class="dropdown-item">
											<a href="javascript:;" id="selectUnReadMsg">
												<i class="mdi mdi-email-mark-as-unread"></i> Unread Message
											</a>
										</li>
										<li class="dropdown-item">
											<a href="javascript:;" id="selectAdminMsg">
												<i class="mdi mdi-account-tie"></i> Admin Message
											</a>
										</li>  
									</ul>
								</div>';

				$btnSelectAction = ' 
								<ul class="dropdown-menu fs-12  animate__animated animate__zoomIn">
									<li class="dropdown-item">
										<a href="javascript:;" id="markRead">
											<i class="far fa-check-square"></i> Mark as Read
										</a>
									</li>
									<li class="dropdown-item">
										<a href="javascript:;" id="markUnread">
											<i class="mdi mdi-email-mark-as-unread"></i> Mark as Unread
										</a>
									</li>
									<li class="divider"></li>
									<li class="dropdown-item">
										<a href="javascript:;" id="moveMsgInbox">
											<i class="bx bx-move"></i> Move to Inbox
										</a>
									</li>
									<li class="dropdown-item">
										<a href="javascript:;" id="deleteMsg">
											<i class="mdi mdi-trash-can-outline"></i> Delete Mail
										</a>
									</li>
								</ul>';
								
			}else{ 
					
											
				$btnSelectMsg = '
								<div class="btn-group mail-dropdown" role="group" aria-label="mail dropdown">
									<div class="btn-group" role="group">
										<button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
										<label class="input-group-addon">
											<input type="checkbox" class="" id="selectAll"> 
										</label>
										</button>
										<ul class="dropdown-menu fs-12  animate__animated animate__zoomIn" id="markMsgBtn">
											<li class="dropdown-item"><a href="javascript:;" id="selectReadMsg"><i class="mdi mdi-email-check"></i> Read Message</a></li>
											<li class="dropdown-item"><a href="javascript:;" id="selectUnReadMsg"><i class="mdi mdi-email-mark-as-unread"></i> Unread Message</a></li>
											<li class="dropdown-item"><a href="javascript:;" id="selectAdminMsg"><i class="mdi mdi-account-tie"></i> Admin Message</a></li>										  
										</ul>
									</div>
								</div>';

				$btnSelectAction = ' 
								<ul class="dropdown-menu fs-12  animate__animated animate__zoomIn">
									<li class="dropdown-item"><a href="javascript:;" id="markRead"><i class="mdi mdi-email-check""></i> Mark as Read</a></li>
									<li class="dropdown-item"><a href="javascript:;" id="markUnread"><i class="mdi mdi-email-mark-as-unread"></i> Mark as Unread</a></li>
									<li class="divider"></li>
									<li class="dropdown-item"><a href="javascript:;" id="moveMsgToTrash"><i class="mdi mdi-trash-can-outline"></i> Trash Mail </a></li>
								</ul>';
				
			}

$nkiruMsgBoxHead =<<<IGWEZE

			<div id="inboxType" class="display-none">$inboxType</div>
			<div id="memberID" class="display-none">$member_id</div>
			<div id="totalCount" class="display-none">$totalCount</div>
				<div class="inbox-body" id="inboxmsgBoxDiv">
					<div class="mail-option">
						<div class="chk-all"> 
							$btnSelectMsg
						</div>  
						 
						<div class="btn-group mail-dropdown">
							<a class="btn btn-primary tasksBtn  dropdown-toggle" href="javascript:;" 
							data-bs-toggle="dropdown" aria-expanded="false">
								Tasks 
							</a> 
							$btnSelectAction 
						</div>  
						<button class="btn btn-primary showInbox" href="javascript:;"
						id="showInboxMsg-$member_id">
							<i class="mdi mdi-email-sync-outline"></i>
						</button>
						<div id="prevPageDiv" class="display-none"></div>
						<div id="nextPageDiv" class="display-none">10</div>
						<ul class="unstyled inbox-pagination">
							<li><span id="pagiDetailsDiv">1-10</span><span> of $totalCount</span></li>
							<li>
								<a href="javascript:;" class="np-btn prevMailBtn" style="display: none;">
								<i class="fa fa-angle-left pagination-left"></i>
								</a>
							</li>
							<li>
								<a href="javascript:;" class="np-btn nextMailBtn"><i class="fa fa-angle-right pagination-right"></i>
								</a>
							</li>
						</ul>
					</div>

				<div id="paginateMailDiv table-responsive">
					<table class="table table-inbox table-hover table-responsive mt-20">
						<tbody>

			

IGWEZE;


			if (($inboxType != '') && ($inboxType != $fiVal)){
				
				$ebele_mark_1 = "SELECT msg_id, njnk_title, njnk_msg, njnk_time, njnk_status, njnk_sender_id, njnk_reps_id, njnk_type
				
								FROM $fobrainMailBoxTB
								
								WHERE njnk_reps_id = :njnk_reps_id
								
								AND  njnk_type = :njnk_type
								
								ORDER BY njnk_time DESC
								
								LIMIT 10 OFFSET $mailoffSetVal";

				$igweze_prep_1 = $conn->prepare($ebele_mark_1);	 
				$igweze_prep_1->bindValue(':njnk_reps_id', $member_id);
				$igweze_prep_1->bindValue(':njnk_type', $inboxType);
					
			}else{

				$ebele_mark_1 = "SELECT msg_id, njnk_title, njnk_msg, njnk_time, njnk_status, njnk_sender_id, njnk_reps_id, njnk_type
				
								FROM $fobrainMailBoxTB
								
								WHERE njnk_reps_id = :njnk_reps_id
								
								AND  njnk_type = :njnk_type
								
								ORDER BY njnk_time DESC
								
								LIMIT 10 OFFSET $mailoffSetVal";

				$igweze_prep_1 = $conn->prepare($ebele_mark_1);	 
				$igweze_prep_1->bindValue(':njnk_reps_id', $member_id);
				$igweze_prep_1->bindValue(':njnk_type', $fiVal); 

			}
					
			$igweze_prep_1->execute();

			$rows_count_1 = $igweze_prep_1->rowCount(); 

			if($rows_count_1 >= $foreal) {
				
				echo $nkiruMsgBoxHead;
				
				while($row_1 = $igweze_prep_1->fetch(PDO::FETCH_ASSOC)) {		

					$msg_id = $row_1['msg_id'];
					$njnk_title = $row_1['njnk_title'];
					$njnk_msg = $row_1['njnk_msg'];
					$njnk_time = $row_1['njnk_time'];
					$njnk_status = $row_1['njnk_status'];
					$njnk_sender_id = $row_1['njnk_sender_id'];
					$njnk_reps_id = $row_1['njnk_reps_id'];
					$njnk_type = $row_1['njnk_type'];
					
					$msgData = $msg_id.'-'.$njnk_reps_id.'-'.$njnk_sender_id;
					
					$memberInfo = companionWallUserDetails($conn, $njnk_sender_id, $fiVal);

					list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic, $m_dept, $m_faculty, $userMail, 
					$wallPic, $load_page) = explode ("##", $memberInfo);				
					
					if($njnk_type == $thVal) { $m_name = '*';}
					
					if($njnk_status == $fiVal){ $msgStatus = 'unread'; $starIcon = 'fa fa-star inbox-started'; $ckeckRU = 'checkUnread';}
					else { $msgStatus = ''; $starIcon = 'fa fa-star'; $ckeckRU = 'checkRead'; }	
					
					if($njnk_type == $seVal){ $admicIcon = '<span class="badge bg-danger">admin</span>'; 
												$chkAdmin = 'checkAdminMsg'; }
					else{ $admicIcon = ''; $chkAdmin ='';}
					
					$msgTime = wallTimerBoy($njnk_time);
					$msgTime = date("j M", $njnk_time);
					
					
$nkiruMsgBox =<<<IGWEZE
				
					<tr class="$msgStatus" id="mailRowID-$msg_id">
						<td class="inbox-small-cells text-right" width="5%">
							<input type="checkbox" class="mail-checkbox mailCheckBox $chkAdmin $ckeckRU" 
							value='$msg_id' name="chkmailID-$msg_id" id="chkmailID-$msg_id">
						</td>
						<td class="inbox-small-cells  readMail" id="readMail-$msgData" width="5%">
							<span id="starIconMail-$msg_id"><i class="$starIcon"></i></span>
						</td>
						<td class="view-message dont-show readMail" id="readMail-$msgData">
							$m_name 
							$admicIcon
						</td>
						<td class="view-message mail-title-comp readMail" id="readMail-$msgData"> 
							$njnk_title  
						</td>
						<td class="view-message  inbox-small-cells readMail readMail-$msgData" 
						id="readMail-$msgData">
						</td>
						<td class="view-message mail-time-comp text-left readMail" id="readMail-$msgData"> 
							$msgTime
						</td>
					</tr>	 

IGWEZE;
			
				
					echo $nkiruMsgBox; 
					
				}
			
				echo '</tbody>
						</table>
					</div>
				</div>';
				
			}else{

				if ($inboxType == $seVal){$msg = "Ooops, Your Companion Wall Admin Message is empty.";}
				elseif ($inboxType == $thVal){$msg = "Ooops, Your Companion Wall Draft Message is empty.";}
				elseif ($inboxType == $foVal){$msg = "Ooops, Your Companion Wall Trash Message is empty.";}
				else {$msg = "Ooops, Your Companion Wall Inbox Message is empty.";} 
				echo "<br clear='all' /><br clear='all' />";
				echo $infoMsg.$msg.$iEnd; 		
				
			}

		}

		function viewCompanionMail($conn, $msgID, $member_id, $sender_id) {  /* view companion mail */

			global $fobrainMailBoxTB, $fobrainCWallTB, $foreal, $fobrainTemplate, $forumPicExt, $fiVal, $seVal, $thVal, $regNum, $wiz_default_img, 
			$succesMsg, $errorMsg, $warningMsg, $infoMsg,  $sEnd, $eEnd, $iEnd, $wEnd, $cWallNumPerPage;
			$changeProfPic = '';

						
			if (($msgID == '') || ($member_id == '') || ($sender_id == '')){
															
				$msg = "Ooops Something went wrong while tring to retrieve your mail, please try again";
				echo $errorMsg.$msg.$eEnd; //exit; 
					
			}else{
				
				$msgData = $msgID .'-'.$member_id;
				
				try { 
				
					$memberInfo = companionWallUserDetails($conn, $sender_id, $fiVal);					
					list ($senderID, $faRegNum, $m_name, $m_sex, $prof_pic, $m_dept, $m_faculty, $userMail, 
							$wallPic, $load_page) = explode ("##", $memberInfo);		
					
						$ebele_mark = "SELECT msg_id, njnk_title, njnk_msg, njnk_time, njnk_status, njnk_sender_id, njnk_reps_id, njnk_type
						
										FROM $fobrainMailBoxTB
										
										WHERE njnk_reps_id = :njnk_reps_id
										
										AND njnk_sender_id = :njnk_sender_id
										
										AND msg_id = :msg_id";

						$igweze_prep = $conn->prepare($ebele_mark);	 
						$igweze_prep->bindValue(':njnk_reps_id', $member_id);
						$igweze_prep->bindValue(':njnk_sender_id', $sender_id);
						$igweze_prep->bindValue(':msg_id', $msgID);  
						$igweze_prep->execute();
				
						$rows_count = $igweze_prep->rowCount(); 
				
						if($rows_count == $foreal) { 
						
							while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		

								$msg_id = $row['msg_id'];
								$njnk_title = $row['njnk_title'];
								$njnk_msg = $row['njnk_msg'];
								$njnk_time = $row['njnk_time'];
								$njnk_status = $row['njnk_status'];
								$njnk_sender_id = $row['njnk_sender_id'];
								$njnk_reps_id = $row['njnk_reps_id'];
								$njnk_type = $row['njnk_type'];
							} 
							
							$njnk_title = htmlspecialchars_decode($njnk_title);
							$njnk_msg = htmlspecialchars_decode($njnk_msg);					
						
							$njnk_msg = nl2br($njnk_msg);
							
							$msgTime = wallTimerBoy($njnk_time);
							$msgTime = date("F d, Y h:i:s", $njnk_time);		

							$senderPic = picture($forumPicExt, $prof_pic, "student");

							if($userMail == '-'){
					
								$senderMail = '';
					
							}else{
					
								$senderMail = '['.$userMail.'@fobrain.com]';
					
							}
							
							
							if($njnk_status == $fiVal){
								
								$ebele_mark_1 = "UPDATE $fobrainMailBoxTB 
								
												SET 
											
												njnk_status = :njnk_status

												WHERE njnk_reps_id = :njnk_reps_id
										
												AND njnk_sender_id = :njnk_sender_id
										
												AND msg_id = :msg_id";
												
								$igweze_prep_1 = $conn->prepare($ebele_mark_1);	
								$igweze_prep_1->bindValue(':njnk_status', $seVal);	
								$igweze_prep_1->bindValue(':njnk_reps_id', $member_id);
								$igweze_prep_1->bindValue(':njnk_sender_id', $sender_id);
								$igweze_prep_1->bindValue(':msg_id', $msgID);
								$igweze_prep_1->execute();
								
								if(isset($_SESSION['wallComRank'])){	

									$unreadMsg = numOfUnreadMsgAdmin($conn, $member_id);									
									echo "<script type='text/javascript'> $('.inboxMsgNum').html('$unreadMsg'); </script>"; 	
					
								}else{
					
									$unreadMsg = numOfUnreadMsg($conn, $member_id);	
									$adminMsg = numOfAdminMsg($conn, $member_id);						
									echo "<script type='text/javascript'> $('.inboxMsgNum').html('$unreadMsg');
																		$('.adminMsgNum').html('$adminMsg'); </script>"; 	
								}
					
							}

							if($njnk_type == $thVal) {
								
								$mailMsg = str_replace('<br />', "\n", $njnk_msg);	
								
								echo "<script type='text/javascript'> 
										$('#mailTopTitle').html('View Draft Message');
										$('#mailTitleHolder').html('View Draft Message');
									</script>";

$nkiruViewBox =<<<IGWEZE

				<div class="row" id="inboxmsgBoxDiv">
					<div class="col-lg-12">
						<div class="card">
							<div class="card-body">
								<div id="msgBoxInfo"> </div>
								<!-- form -->
								<form class="form-horizontal" id="frmsendNkirukaMail">
									<div class="col-lg-12 mt-10">
										<input type="email" class="form-control" placeholder="Email address" 
										name="msgEmail" id="msgEmail" required />  
									</div> 
									<div class="col-lg-12 mt-10">
										<input type="text" class="form-control" placeholder="Message Title" 
										name="msgTitle" id="msgTitle" value="$njnk_title"/>
									</div>  
									<div class="col-lg-12 mt-10">
										<textarea class="form-control p-10" name="message" id="message"
										style="text-align:justify !important;"
										placeholder="Message" rows="10">$mailMsg</textarea>
									</div>   
									<div class="col-lg-12 text-end mt-15"> 
										<input type="hidden" name="memberID" value="$member_id" />
										<input type="hidden" name="messageData" value="sendNjidekaMail" /> 
										<button type="submit" class="btn btn-primary waves-effect 
										btn-label waves-light" id="sendNkirukaMail"><i class="bx bx-send label-icon"></i> 
										Send
										</button>
									</div>   
								</form>
								<!-- / form -->
							</div> 
						</div> 
					</div> 
				</div> 

IGWEZE;
				
				}else{


$nkiruViewBox =<<<IGWEZE

			<div class="inbox-body" id="inboxmsgBoxDiv">
				<div id="fobrain-print">
					<div class="heading-inbox row">
						<div class="col-md-8">
							<div class="compose-btn">
								<button type="button" id="printer-btn" class="btn btn-dark btn-label waves-light me-10">
								<i class="fa fa-print label-icon"></i> 
									Print
								</button>
								
								<button type="button" id="trashMailViewMsg-$msgData"
								class="btn btn-danger btn-label waves-light trashMailViewMsg">
								<i class="mdi mdi-trash-can-outline label-icon"></i> 
									Trash
								</button>
							</div>

						</div>
						<div class="col-md-4 text-right">
							<p class="date"> $msgTime </p>
						</div>
						<div class="col-md-12">
							<h4> $njnk_title </h4>
						</div>
					</div>
					<div class="sender-info">
						<!-- row -->	
						<div class="row">  
							<div class="col-md-12">
								<img src="$senderPic" height="60px" width="64px" alt="Mail Sender Picture">
								<strong>$m_name</strong>
								<span>$senderMail</span>
								to
								<strong>me</strong>
									<a class="sender-dropdown " href="javascript:;">
										<i class="fa fa-chevron-down"></i>
									</a>
							</div>
						</div>
					</div>
					<div class="view-mail">
						$njnk_msg
					</div>
					
				</div> 
				
					
				<div class="row mt-40"> <div id="replyMsgDiv"></div>								
					<div class="col-lg-12">
						<div class="card card-shadow" id="replymsgBoxDiv">
							<div class="card-header-wiz">
								<i class="fab fa-replyd fs-16  me-1"></i>  Reply This Mail  
								 
								<div class="display-none pull-right" id="replyMsgLoader"> 
									<strong role="status">Processing...</strong>
									<div class="spinner-border ms-auto text-danger" aria-hidden="true"></div>
								</div>
							</div>
							<div class="card-body">
								<!-- form -->
								<form class="form-horizontal" id="frmreplyMail">
									<input type="hidden" name="messageData" value="sendWCReplyMail" />
									<input type="hidden" name="recepID" value="$senderID" />
									<input type="hidden" name="recepName" value="$m_name" />
									<input type="hidden" name="mailID" value="$msg_id" />
									<input type="hidden" name="mailType" value="$njnk_type" />
									<input type="hidden" name="replyMsg" value="replyMsg" />
									<input type="hidden" name="msgTitle" value="RE: $njnk_title" /> 
									<div class="col-lg-12"> 
										<textarea class="form-control p-10 no-border" name="message" id="message"
										placeholder="Write your mesaage here" rows="10"></textarea>										
									</div> 
									<hr /> 
									<div class="col-lg-12 text-end mt-10"> 													
										<button type="submit" id="replyMail"
										class="btn btn-primary btn-label waves-light">
										<i class="fas fa-reply label-icon"></i> 
											Reply
										</button>											
									</div>
								</form>
								<!-- / form --> 
							</div>
						</div>
					</div>		
				</div>
				

IGWEZE;
				
						}
					
						echo $nkiruViewBox;

					}else{
					
						$msg = "Ooops Something went wrong while tring to retrieve your mail, please try again";
						echo $errorMsg.$msg.$eEnd; //exit; 

					} 
									
				}catch(PDOException $e) {

					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());

				}

			}	 

		}

		function companionSentMsg($conn, $member_id, $mailoffSetVal) {  /* view companion sent mail */

			global $fobrainMailBoxTB, $foreal, $forumPicExt, $fiVal, $seVal, $thVal, $foVal, $regNum, $wiz_default_img, $succesMsg, 
			$errorMsg, $warningMsg, $infoMsg,  $sEnd, $eEnd, $iEnd, $wEnd; 
			
				$ebele_mark = "SELECT msg_id
				
								FROM $fobrainMailBoxTB
								
								WHERE njnk_sender_id = :njnk_sender_id";

				$igweze_prep = $conn->prepare($ebele_mark);	 
				$igweze_prep->bindValue(':njnk_sender_id', $member_id);  
				$igweze_prep->execute();

				$totalCount = $igweze_prep->rowCount();  

				if($totalCount <= 10){

					$nextPage = $totalCount;
					$pagiDetail = '1 - '.$nextPage;

					echo  "<script type='text/javascript'> 
								$('.prevMailBtn').fadeOut(10);  $('.nextMailBtn').fadeOut(10); 
								$('#pagiDetailsDiv').html('$pagiDetail');
							</script>";
			
				}

							

$nkiruMsgBoxHead =<<<IGWEZE


	<div id="memberID" class="display-none">$member_id</div>
	<div id="totalCount" class="display-none">$totalCount</div>
		<div class="inbox-body" id="inboxmsgBoxDiv">
			<div class="mail-option">
			

				<div class="btn-group">
					<a class="btn mini tooltips showInbox dropdown-toggle" href="javascript:;" data-bs-toggle="dropdown" aria-expanded="false" data-placement="top" 
					data-original-title="Refresh"
					id="showInboxMsg-$member_id">
						<i class="fas fa-sync"></i>
					</a>
				</div>

			<div id="prevPageDiv" class="display-none"></div>
			<div id="nextPageDiv" class="display-none">10</div>
				<ul class="unstyled inbox-pagination">
					<li><span id="pagiDetailsDiv">1-10</span><span> of $totalCount</span></li>
					<li>
						<a href="javascript:;" class="np-btn prevMailSentBtn" style="display: none;">
						<i class="fa fa-angle-left pagination-left"></i>
						</a>
					</li>
					<li>
						<a href="javascript:;" class="np-btn nextMailSentBtn"><i class="fa fa-angle-right pagination-right"></i>
						</a>
					</li>
				</ul>
			</div>

		<div id="paginateMailDiv table-responsive">		
			<table class="table table-inbox table-hover table-responsive mt-20">
				<tbody>

			

IGWEZE;
			
				$ebele_mark_1 = "SELECT msg_id, njnk_title, njnk_msg, njnk_time, njnk_status, njnk_sender_id, 
								njnk_reps_id, njnk_type
				
								FROM $fobrainMailBoxTB
								
								WHERE njnk_sender_id = :njnk_sender_id
								
								ORDER BY njnk_time DESC
								
								LIMIT 10 OFFSET $mailoffSetVal";

				$igweze_prep_1 = $conn->prepare($ebele_mark_1);	 
				$igweze_prep_1->bindValue(':njnk_sender_id', $member_id);						
				$igweze_prep_1->execute();

				$rows_count_1 = $igweze_prep_1->rowCount(); 

				if($rows_count_1 >= $foreal) {
					
				echo $nkiruMsgBoxHead;
				
				while($row_1 = $igweze_prep_1->fetch(PDO::FETCH_ASSOC)) {		

					$msg_id = $row_1['msg_id'];
					$njnk_title = $row_1['njnk_title'];
					$njnk_msg = $row_1['njnk_msg'];
					$njnk_time = $row_1['njnk_time'];
					$njnk_status = $row_1['njnk_status'];
					$njnk_sender_id = $row_1['njnk_sender_id'];
					$njnk_reps_id = $row_1['njnk_reps_id'];
					$njnk_type = $row_1['njnk_type'];
					
					$msgData = $msg_id.'-'.$njnk_sender_id;
					
					$memberInfo = companionWallUserDetails($conn, $njnk_reps_id, $fiVal);
					list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic, $m_dept, $m_faculty, $userMail, 
					$wallPic, $load_page) = explode ("##", $memberInfo);				

					
					if($njnk_status == $fiVal){ $msgStatus = 'unread'; $starIcon = 'fa fa-star inbox-started'; $ckeckRU = 'checkUnread';}
					else { $msgStatus = ''; $starIcon = 'fa fa-star'; $ckeckRU = 'checkRead'; }	
					
					if($njnk_type == $seVal){ $admicIcon = '<span class="badge bg-danger ">admin</span>'; 
												$chkAdmin = 'checkAdminMsg'; }
					else{ $admicIcon = ''; $chkAdmin ='';}
					
					$msgTime = wallTimerBoy($njnk_time);
					$msgTime = date("j M ", $njnk_time);
						
					
$nkiruMsgBox =<<<IGWEZE

				<tr class="$msgStatus" id="mailRowID-$msg_id">
					<td class="inbox-small-cells text-right" width="5%">
					</td>
					
					<td class="inbox-small-cells readNkirukaSentMail" id="readNkirukaSentMail-$msgData" width="5%">
					<span id="starIconMail-$msg_id"><i class="$starIcon"></i></span>
					</td>
					
					<td class="view-message dont-show readNkirukaSentMail" id="readNkirukaSentMail-$msgData">$m_name 
						$admicIcon
					</td>
					
					<td class="view-message  mail-title-comp readNkirukaSentMail" id="readNkirukaSentMail-$msgData"> $njnk_title   
					</td>
					
					<td class="view-message  inbox-small-cells readNkirukaSentMail readNkirukaSentMail-$msgData" 
					id="readNkirukaSentMail-$msgData">
					</td>
					
					<td class="view-message  mail-time-comp text-left readNkirukaSentMail" id="readNkirukaSentMail-$msgData"> 
						$msgTime
					</td>
				</tr>		


IGWEZE;
	
		
					echo $nkiruMsgBox;
					
					
				}
			
				echo '</tbody>
						</table>
					</div>
				</div>';

			}else{

				$msg = "Ooops, Your Companion Wall Sent Message is empty."; 
				echo "<br clear='all' /><br clear='all' />";
				echo $infoMsg.$msg.$iEnd; //exit; 			
				
			}

		}

		function msgTypeStatus($conn, $msg_id) {  /* retrieve companion inbox mail type */

			global $fobrainMailBoxTB, $foreal; 

			$ebele_mark_1 = "SELECT njnk_type
			
							FROM $fobrainMailBoxTB
							
							WHERE msg_id = :msg_id";

			$igweze_prep_1 = $conn->prepare($ebele_mark_1);	 
			$igweze_prep_1->bindValue(':msg_id', $msg_id);
			$igweze_prep_1->execute();
			
			while($row_1 = $igweze_prep_1->fetch(PDO::FETCH_ASSOC)) {		

				$njnk_type = $row_1['njnk_type'];
				
			}
			
			if($njnk_type == '') { $Status = $foreal; }
			else { $Status = $njnk_type; }
			
			return $Status; 

		}

		function msgSentType($conn, $memberID) {  /* retrieve companion sent mail type */

			global $fobrainCWallTB, $foreal; 

			$ebele_mark = "SELECT member_rank
			
							FROM $fobrainCWallTB
							
							WHERE member_id = :member_id";

			$igweze_prep = $conn->prepare($ebele_mark);	 
			$igweze_prep->bindValue(':member_id', $memberID);
			$igweze_prep->execute();
			
			while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		

				$msgType = $row['member_rank'];
				
			}
			
			if($msgType == '') { $mType = $foreal; }
			else { $mType = $msgType; }
			
			return $mType; 

		}

		function returnMsgSentType($msgTypefi, $msgTypese) {  /* return companion mail type */

			global $fiVal, $seVal; 

			if ($msgTypefi > $fiVal) {
				
				$msgType = $seVal;
					
			}elseif($msgTypese > $fiVal){
			
				$msgType = $seVal;
				
			}elseif($msgTypefi > $msgTypese){
			
				$msgType = $seVal;
				
			}elseif($msgTypese > $msgTypefi){
			
				$msgType = $seVal;
				
			}else{
				
				$msgType = $fiVal;
				
			}
				
			return $msgType; 

		}

		function msgTrashStatus($conn, $msg_id) {  /* companion mail trash status */

			global $fobrainMailBoxTB, $foreal; 

							
			$ebele_mark_1 = "SELECT njnk_trash
			
							FROM $fobrainMailBoxTB
							
							WHERE msg_id = :msg_id";

			$igweze_prep_1 = $conn->prepare($ebele_mark_1);	 
			$igweze_prep_1->bindValue(':msg_id', $msg_id);
			$igweze_prep_1->execute();
									
			while($row_1 = $igweze_prep_1->fetch(PDO::FETCH_ASSOC)) {		

				$njnk_trash = $row_1['njnk_trash'];

			}
			
			if($njnk_trash == '') { $status = $foreal; }
			else { $status = $njnk_trash; }
			
			return $status;

		}

		function numOfUnreadMsg($conn, $member_id) {  /* number of unread message */

			global $fobrainMailBoxTB, $foreal, $fiVal, $seVal, $thVal, $regNum; 

			$ebele_mark = "SELECT msg_id
			
							FROM $fobrainMailBoxTB
							
							WHERE njnk_status = :njnk_status
							
							AND njnk_type = :njnk_type
							
							AND njnk_reps_id = :njnk_reps_id";

			$igweze_prep = $conn->prepare($ebele_mark);	 
			$igweze_prep->bindValue(':njnk_status', $fiVal);
			$igweze_prep->bindValue(':njnk_type', $fiVal);
			$igweze_prep->bindValue(':njnk_reps_id', $member_id); 
			$igweze_prep->execute();

			$rows_count = $igweze_prep->rowCount(); 

			return $rows_count;

		}		

		function numOfUnreadMsgAdmin($conn, $member_id) {  /* number of admin unread message */

			global $fobrainMailBoxTB, $foreal, $fiVal, $seVal, $thVal, $regNum; 

			$ebele_mark = "SELECT msg_id
			
							FROM $fobrainMailBoxTB
							
							WHERE njnk_status = :njnk_status
							
							AND njnk_type = :njnk_type
							
							AND njnk_reps_id = :njnk_reps_id";

			$igweze_prep = $conn->prepare($ebele_mark);	 
			$igweze_prep->bindValue(':njnk_status', $fiVal);
			$igweze_prep->bindValue(':njnk_type', $seVal);
			$igweze_prep->bindValue(':njnk_reps_id', $member_id); 
			$igweze_prep->execute();

			$rows_count = $igweze_prep->rowCount(); 

			return $rows_count;

		}		


		function numOfSentMsg($conn, $member_id) {  /* number of sent message */

			global $fobrainMailBoxTB, $foreal, $fiVal, $seVal, $thVal, $regNum; 

			$ebele_mark = "SELECT msg_id
			
							FROM $fobrainMailBoxTB
							
							WHERE njnk_sender_id = :njnk_sender_id";

			$igweze_prep = $conn->prepare($ebele_mark);	 
			$igweze_prep->bindValue(':njnk_sender_id', $member_id); 
			$igweze_prep->execute();

			$rows_count = $igweze_prep->rowCount(); 

			return $rows_count;

		}		

		function numOfDraftMsg($conn, $member_id) {  /* number of draft message */

			global $fobrainMailBoxTB, $foreal, $fiVal, $seVal, $thVal, $regNum; 

			$ebele_mark = "SELECT msg_id
			
							FROM $fobrainMailBoxTB
							
							WHERE njnk_type = :njnk_type
							
							AND njnk_reps_id = :njnk_reps_id";

			$igweze_prep = $conn->prepare($ebele_mark);	 
			$igweze_prep->bindValue(':njnk_type', $thVal);
			$igweze_prep->bindValue(':njnk_reps_id', $member_id); 
			$igweze_prep->execute();

			$rows_count = $igweze_prep->rowCount(); 

			return $rows_count;

		}		


		function numOfAdminMsg($conn, $member_id) {  /* number of admin message */

			global $fobrainMailBoxTB, $foreal, $fiVal, $seVal, $thVal, $regNum; 

			$ebele_mark = "SELECT msg_id
			
							FROM $fobrainMailBoxTB
							
							WHERE njnk_type = :njnk_type
							
							AND njnk_status = :njnk_status
							
							AND njnk_reps_id = :njnk_reps_id";

			$igweze_prep = $conn->prepare($ebele_mark);	 
			$igweze_prep->bindValue(':njnk_type', $seVal);
			$igweze_prep->bindValue(':njnk_status', $fiVal);
			$igweze_prep->bindValue(':njnk_reps_id', $member_id); 
			$igweze_prep->execute();

			$rows_count = $igweze_prep->rowCount(); 

			return $rows_count;

		}		


		function numOfTrashMsg($conn, $member_id) {  /* number of trash message */

			global $fobrainMailBoxTB, $foreal, $fiVal, $seVal, $foVal;

			$ebele_mark = "SELECT msg_id
			
							FROM $fobrainMailBoxTB
							
							WHERE njnk_type = :njnk_type
							
							AND njnk_reps_id = :njnk_reps_id";

			$igweze_prep = $conn->prepare($ebele_mark);	 
			$igweze_prep->bindValue(':njnk_type', $foVal);
			$igweze_prep->bindValue(':njnk_reps_id', $member_id); 
			$igweze_prep->execute();

			$rows_count = $igweze_prep->rowCount(); 

			return $rows_count;

		}		

		function emailValidator($conn, $email) {  /* check if email exits or not */

			global $fobrainCWallTB, $foreal; 

			$mail = trim($email, '@fobrain.com');
			
			$ebele_mark = "SELECT member_id
			
							FROM $fobrainCWallTB
							
							WHERE member_mail = :member_mail";

			$igweze_prep = $conn->prepare($ebele_mark);	 
			$igweze_prep->bindValue(':member_mail', $mail); 
			$igweze_prep->execute();

			$rows_count = $igweze_prep->rowCount(); 

			if($rows_count >= $foreal) {
			
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		

					$member_id = $row['member_id'];
				}
			
			}else{
				
				$member_id = '';
			}
			
			return $member_id;

		}		


		function njidekaCompanionInbox($conn, $member_id, $wType) {  /* companion mail notification */

			global $fobrainMailBoxTB, $foreal, $i_false, $forumPicExt, $fiVal, $sixVal;  
			global $seVal, $thVal, $regNum, $wiz_default_img; 
			global $succesMsg, $errorMsg, $warningMsg, $infMsg,  $sEnd, $eEnd, $iEnd, $wEnd, $msgEnd;
			$count = 0;

				
			$ebele_mark = "SELECT msg_id, njnk_title, njnk_msg, njnk_time, njnk_status, njnk_sender_id, 
							njnk_reps_id, njnk_type
			
							FROM $fobrainMailBoxTB
							
							WHERE njnk_reps_id = :njnk_reps_id
							
							ORDER BY njnk_time DESC";

			$igweze_prep = $conn->prepare($ebele_mark);	 
			$igweze_prep->bindValue(':njnk_reps_id', $member_id);						
			$igweze_prep->execute();

			$rows_count = $igweze_prep->rowCount(); 
			
			echo '<div data-simplebar style="max-height: 230px;">';
			
			if($rows_count >= $foreal) {

				$count = $i_false;
				
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		

					$count++;
					
					if($count <= $sixVal){
						
						$msg_id = $row['msg_id'];
						$njnk_title = $row['njnk_title'];
						$njnk_msg = $row['njnk_msg'];
						$njnk_time = $row['njnk_time'];
						$njnk_status = $row['njnk_status'];
						$njnk_sender_id = $row['njnk_sender_id'];
						$njnk_reps_id = $row['njnk_reps_id'];
						$njnk_type = $row['njnk_type'];
						
						$msgData = $msg_id.'-'.$njnk_reps_id.'-'.$njnk_sender_id;
						
						$msgTime = wallTimerBoy($njnk_time);
						
						$memberInfo = companionWallUserDetails($conn, $njnk_sender_id, $fiVal);
			
						list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic, $m_dept, $m_faculty, $userMail, 
						$wallPic, $load_page) = explode ("##", $memberInfo); 

						$senderPic = picture($forumPicExt, $prof_pic, "student");
					
						if($wType == $seVal){
							
							$linkMail = "readMailTopNav";
							
						}else{
							
							$linkMail = "readMailTopNav";
							
						}	 
					
		$nkiruMsgBox =<<<IGWEZE


							<a href="javascript:;" class="text-reset notification-item $linkMail" id="msgRowID-$msgData">
								<div class="d-flex">
									<div class="flex-shrink-0 me-3">
										<img src="$senderPic" class="rounded-circle avatar-sm" alt="user-pic">
									</div>
									<div class="flex-grow-1">
										<h6 class="mb-1">$m_name</h6>
										<div class="font-size-13 text-muted">
											<p class="mb-1">$njnk_title</p>
											<p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>$msgTime</span></p>
										</div>
									</div>
								</div>
							</a>
							
						
			

		IGWEZE;
							
						
						echo $nkiruMsgBox;
					
					}
					
					
				} 
				
				
			}else{ 
				
				echo  "<div class='p-20 fs-14 text-info'>Ooops, you have no new message</div>";
				//echo $infoMsg.$msg.$msgEnd;
				
			}
				
			echo '</div>'; 
				
			if($count > $sixVal){
				
				echo '<div class="p-2 border-top d-grid">
						<a class="btn btn-sm btn-link font-size-14 text-center" href="javascript:;" id="moreMailBoxInfo">
							<i class="mdi mdi-arrow-right-circle me-1"></i> <span>View More..</span> 
						</a>
					</div>';  
			
			}

		}


		function wallNotifications($conn, $postComOwner, $wType) {  /* companion mail notification */

			global $cWallNotificationTB, $foreal, $fiVal, $seVal, $foVal, $fifVal, $sixVal, $i_false, $succesMsg, $errorMsg,
			$warningMsg, $infMsg,  $sEnd, $eEnd, $iEnd, $wEnd, $msgEnd;
			$count = 0;

			$ebele_mark = "SELECT not_id, post_id, comment_id, member_id, senders_id, not_time, not_type

							FROM $cWallNotificationTB

							WHERE member_id = :member_id
							
							ORDER BY not_id DESC";

			$igweze_prep = $conn->prepare($ebele_mark);				
			$igweze_prep->bindValue(':member_id', $postComOwner); 
			$igweze_prep->execute();

			$rows_count = $igweze_prep->rowCount(); 

			echo '<div data-simplebar style="max-height: 230px;">';

			if($rows_count >= $foreal) {
				
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		

					$notID = $row['not_id'];
					$post_id = $row['post_id'];
					$comment_id = $row['comment_id'];
					$member_id = $row['member_id'];
					$senders_id = $row['senders_id'];
					$not_time = $row['not_time'];
					$not_type = $row['not_type'];
					
					$noticTime = wallTimerBoy($not_time);
					
					if($not_type == $fiVal) { 
					
						$noticTypeVal = postTypeDetails($conn, $post_id);
						
						$noticIcon = '<i class="bx bx-comment-dots"></i> '; 
						$noticMsg = ' Commented on your '.$noticTypeVal; 
													
					}elseif(($not_type == $seVal) &&  ($comment_id == '') ){ 
					
						$noticTypeVal = postTypeDetails($conn, $post_id);
						
						$noticIcon = '<i class="bx bx-like"></i> '; 
						$noticMsg = ' Like your '.$noticTypeVal; 
														
					}elseif(($not_type == $seVal) && ($comment_id != '')) { 
					
						$noticTypeVal = commentDetails($conn, $comment_id);
						
						$noticIcon = '<i class="bx bx-like"></i> '; 
						$noticMsg = ' Like your Comment '.$noticTypeVal; 
						
					}else{
						
						$noticTypeVal = ''; $noticIcon = '';
						
					}
					
					$sendersArrays = unserialize($senders_id);
					$count = count($sendersArrays);
					
					if($count > $foVal) { $moreNot = ($count - $foVal); $moreNotLink = '<span> and </span> 
					'.$moreNot.' more <span>'.$noticMsg.'</span>'; $count = $foVal;}
					else { $moreNotLink = $noticMsg; }
					
					
					if($wType == $seVal){

						$noticLink = ' <p class="mb-1 showCWallNotification para-noticfication" id="showCWallNotification-'.$post_id.'">
						<span class="para-noticfication"><span>'.$noticIcon; 

					}else{
						
						$noticLink = ' <p class="mb-1 showCWallNotification para-noticfication" id="showCWallNotification-'.$post_id.'">
						<span class="para-noticfication"><span>'.$noticIcon; 
						
					}	

					if(is_array($sendersArrays)){

						for($i = 1; $i <= $count; $i++) {
							
							$memberID = $sendersArrays[$i];  
							
							if($memberID == $senders_id){
								
								//none

							}else{
								
								$memberInfo = companionWallUserDetails($conn, $memberID, $fiVal);
						
								list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic) = explode ("##", $memberInfo);	

								if($m_name != '-'){
									$noticLink .= '<strong>'.$m_name.'</strong>, ';
								}
								
								$memberInfo = ''; $memberID = '';
							
							}
							
							$post_id =''; 
						
						}

					}
					
					$noticLinkTrim = trim($noticLink, ', ');				
					
					echo '
							<a href="javascript:;" class="text-reset notification-item">
								<div class="d-flex">
									<div class="flex-shrink-0 avatar-sm me-3">
										<span class="avatar-title bg-success rounded-circle font-size-16">
											<i class="bx bxs-bell-ring"></i>
										</span>
									</div>
									<div class="flex-grow-1">
										
										<div class="font-size-13 text-muted">
											'.$noticLinkTrim.$moreNotLink.'</span></span></p>
											<p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>'.$noticTime.'</span></p>
										</div>
									</div>
								</div>
							</a>
					';
			
				} 
				
				
			}else{
				
					echo  "<div class='p-20 fs-14 text-info'>Ooops, you have no new notification</div>";
					//echo $infMsg.$msg.$iEnd; 	
			}

			echo '</div>';	

			if($count > $fifVal){ 

				echo '	
					<div class="p-2 border-top d-grid">
						<a class="btn btn-sm btn-link font-size-14 text-center" href="javascript:;" id="moreMailBoxInfo">
							<i class="mdi mdi-arrow-right-circle me-1"></i> <span>View More..</span> 
						</a>
					</div>';	
					
			}	
					
			echo '<div id="notMsgDiv" class="display-none">'.$rows_count.'</div>'; 

		}

		function saveNotifications($conn, $postComOwner, $postComSender, $postComID, $postComType, $notType) {  /* save companion mail notification */

			global $cWallNotificationTB, $foreal, $fiVal, $seVal;
				
			if ($postComType == $fiVal){ $pcType = 'post_id'; $pcTypeS = ':post_id';  }
			elseif ($postComType == $seVal){ $pcType = 'comment_id'; $pcTypeS = ':comment_id'; }
			else { $pcType = 'post_id'; $pcTypeS = ':post_id';  }

			$time = strtotime(date("Y-m-d H:i:s"));

			$ebele_mark = "SELECT not_id, senders_id

							FROM $cWallNotificationTB

							WHERE $pcType = $pcTypeS
							
							AND not_type = :not_type
							
							AND member_id = :member_id";

			$igweze_prep = $conn->prepare($ebele_mark);				
			$igweze_prep->bindValue(':member_id', $postComOwner);
			$igweze_prep->bindValue("$pcTypeS", $postComID);				
			$igweze_prep->bindValue(':not_type', $notType); 
			$igweze_prep->execute();

			$rows_count = $igweze_prep->rowCount(); 

			if($rows_count >= $foreal) {
				
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		

					$notID = $row['not_id'];
					$senders_id = $row['senders_id'];
				
				}
				
				$sendersArrays = unserialize($senders_id);				
				$sendersArray = removeArrayByValue($sendersArrays, $postComSender);	
				$sendersArray[] = $postComSender;				
				$sendersArrayU = serialize($sendersArray);
				
				$ebele_mark_1 = "UPDATE $cWallNotificationTB
				
								SET 
							
								senders_id = :senders_id,
								
								not_time = :not_time
								
								WHERE not_id = :not_id";
								
				$igweze_prep_1 = $conn->prepare($ebele_mark_1);	
				$igweze_prep_1->bindValue(':senders_id', $sendersArrayU);
				$igweze_prep_1->bindValue(':not_time', $time);
				$igweze_prep_1->bindValue(':not_id', $notID);								
				$igweze_prep_1->execute(); 
				
			}else{

				$pCSenderArr = array();	   
				array_unshift($pCSenderArr,"");
				unset($pCSenderArr[0]);
				$pCSenderArr[] = $postComSender;
				$sendersArr = serialize($pCSenderArr);
				$ebele_mark_1 = "INSERT INTO $cWallNotificationTB 
								($pcType, member_id, senders_id, not_time, not_type)

								VALUES ($pcTypeS, :member_id, :senders_id, :not_time, :not_type)";

				$igweze_prep_1 = $conn->prepare($ebele_mark_1);	
				$igweze_prep_1->bindValue("$pcTypeS", $postComID);			
				$igweze_prep_1->bindValue(':member_id', $postComOwner);
				$igweze_prep_1->bindValue(':senders_id', $sendersArr);
				$igweze_prep_1->bindValue(':not_time', $time);
				$igweze_prep_1->bindValue(':not_type', $notType);								
				$igweze_prep_1->execute();
				
			}

		}


		function removeNotification($conn, $postComOwner, $postComSender, $postComID, $postComType, $notType) {  /* remove companion mail notification */

			global $cWallNotificationTB, $foreal, $fiVal, $seVal;
				
			if ($postComType == $fiVal){ $pcType = 'post_id'; $pcTypeS = ':post_id';  }
			elseif ($postComType == $seVal){ $pcType = 'comment_id'; $pcTypeS = ':comment_id'; }
			else { $pcType = 'post_id'; $pcTypeS = ':post_id';  }

			$ebele_mark = "SELECT not_id, senders_id

							FROM $cWallNotificationTB

							WHERE $pcType = $pcTypeS
							
							AND not_type = :not_type
							
							AND member_id = :member_id";

			$igweze_prep = $conn->prepare($ebele_mark);				
			$igweze_prep->bindValue(':member_id', $postComOwner);
			$igweze_prep->bindValue("$pcTypeS", $postComID);				
			$igweze_prep->bindValue(':not_type', $notType);				 
			$igweze_prep->execute();

			$rows_count = $igweze_prep->rowCount(); 

			if($rows_count >= $foreal) {
				
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		

					$notID = $row['not_id'];
					$senders_id = $row['senders_id'];
				
				}
				
				$sendersArrays = unserialize($senders_id);					
				$sendersArray = removeArrayByValue($sendersArrays, $postComSender);		
				$sendersArrayU = serialize($sendersArray); 
				
				$ebele_mark_1 = "UPDATE $cWallNotificationTB
				
								SET 
							
								senders_id = :senders_id
								
								WHERE not_id = :not_id";
								
				$igweze_prep_1 = $conn->prepare($ebele_mark_1);	
				$igweze_prep_1->bindValue(':senders_id', $sendersArrayU);
				$igweze_prep_1->bindValue(':not_id', $notID);
				$igweze_prep_1->execute(); 
				
			}

		}

		function postTypeVal($type) {  /* companion wall post type */

			global $fiVal, $seVal, $thVal, $foVal;

			if($type == $fiVal) { $postVal = 'Post'; }
			elseif($type == $seVal) { $postVal = 'Uploaded Picture/s'; }
			elseif($type == $thVal) { $postVal = 'Profile Picture'; }
			elseif($type == $foVal) { $postVal = 'Wall Cover Picture'; }
			else {$postVal = '';}

			return $postVal;

		}

		function postTypeDetails($conn, $postID) {  /* companion wall post type details */

			global $cWallPostTB, $foreal, $i_false, $fiVal;
					
			$ebele_mark = "SELECT post_msg, post_type
			
							FROM $cWallPostTB
			
							WHERE post_id = :post_id";

			$igweze_prep = $conn->prepare($ebele_mark);				
			$igweze_prep->bindValue(':post_id', $postID); 
			$igweze_prep->execute();
			
			$rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count == $foreal) {
				
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		

					$post_msg = $row['post_msg'];
					$post_type = $row['post_type'];
				
				}
				
				if($post_type == $fiVal){
				
					$msg = substr($post_msg , 0, 30);
					
					$postDetails = '<strong> Post </strong><i>'.$msg.' . . . . </i>';
				
				}else{
				
					$postDetails = postTypeVal($post_type);
				
				}
				
			}else{
				
				$postDetails = '';
				
			}

			return $postDetails;

		}

		function commentDetails($conn, $commentID) {  /* companion comment details */

			global $cWallCommentTB, $foreal, $i_false;
					
			$ebele_mark = "SELECT comment
			
							FROM $cWallCommentTB
			
							WHERE comment_id = :comment_id";

			$igweze_prep = $conn->prepare($ebele_mark);				
			$igweze_prep->bindValue(':comment_id', $commentID); 
			$igweze_prep->execute();
			
			$rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count == $foreal) {
				
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		

					$comment = $row['comment'];
				
				}

				$msg = substr($comment , 0, 30);
				$commentDetails = $msg;
				
			}else{
				
				$commentDetails = '';
				
			}

			return $commentDetails;

		}

		function postAuthorByPostID($conn, $postID) { /* companion wall post author ID */

			global $cWallPostTB, $foreal, $i_false;
					
			$ebele_mark = "SELECT author_id
			
							FROM $cWallPostTB
			
							WHERE post_id = :post_id";

			$igweze_prep = $conn->prepare($ebele_mark);				
			$igweze_prep->bindValue(':post_id', $postID); 
			$igweze_prep->execute();
			
			$rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count == $foreal) {
				
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		

					$author_id = $row['author_id'];
				
				}
				
			}else{
				
				$author_id = $i_false;
				
			}

			return $author_id;
		}


		function postIDBycommentID($conn, $commentID) {  /* companion wall comment author ID */

			global $cWallCommentTB, $foreal, $i_false;
					
			$ebele_mark = "SELECT post_id
			
							FROM $cWallCommentTB
			
							WHERE comment_id = :comment_id";

			$igweze_prep = $conn->prepare($ebele_mark);				
			$igweze_prep->bindValue(':comment_id', $commentID); 
			$igweze_prep->execute();
			
			$rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count == $foreal) {
				
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		

					$post_id = $row['post_id'];
				
				}
				
			}else{
				
				$post_id = $i_false;
				
			}

			return $post_id;
		}

		function postDeleteStatus($conn, $postID) {  /* remove companion wall post */

			global $cWallPostTB, $foreal, $i_false;
					
			$ebele_mark = "SELECT delpost
			
							FROM $cWallPostTB
			
							WHERE post_id = :post_id";

			$igweze_prep = $conn->prepare($ebele_mark);				
			$igweze_prep->bindValue(':post_id', $postID); 
			$igweze_prep->execute();
			
			$rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count == $foreal) {
				
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		

					$delpost = $row['delpost'];
				
				}
				
			}else{
				
				$author_id = $foreal;
				
			}

			return $delpost;
		}


		function commentDeleteStatus($conn, $commentID) {  /* remove companion wall comment */

			global $cWallCommentTB, $foreal, $i_false;
					
			$ebele_mark = "SELECT delcom
			
							FROM $cWallCommentTB
			
							WHERE comment_id = :comment_id";

			$igweze_prep = $conn->prepare($ebele_mark);				
			$igweze_prep->bindValue(':comment_id', $commentID); 
			$igweze_prep->execute();
			
			$rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count == $foreal) {
				
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		

					$delcom = $row['delcom'];
				
				}
				
			}else{
				
				$delcom = $foreal;
				
			}

			return $delcom;

		}


		function activeCWallMembers($conn){  /* load active companion wall users */

			global $fobrainCWallTB, $foreal, $fiVal, $seVal, $wiz_default_img, $forumPicExt; 

			$ebele_mark = "SELECT member_id, member_reg, profile_pic, member_name, member_sex, member_dept, 
								member_faculty, member_mail, wall_pic, load_page
				
											FROM $fobrainCWallTB";
						
			$igweze_prep = $conn->prepare($ebele_mark); 
			$igweze_prep->execute();
			
			$rows_count = $igweze_prep->rowCount(); 
			
			if($rows_count >= $foreal) {
				
				while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		

					$member_id = $row['member_id'];
					$faRegNum = $row['member_reg'];
					$prof_pic = $row['profile_pic'];
					$m_name = $row['member_name'];
					$m_sex = $row['member_sex'];
					$m_dept = $row['member_dept'];
					$m_faculty = $row['member_faculty'];
					$userMail = $row['member_mail'];
					$wallPic = $row['wall_pic'];
					$load_page = $row['load_page'];	

					$stuFpic = picture($forumPicExt, $prof_pic, "student");
				
					echo $stuPic = '<a href="javascript:;" class="showcompanionWallUser" id="companionWallUser-'.$member_id.'">
					<img src="'.$stuFpic.'" class="active-cm-img img-circle m-5"  /></a>'; 
				
				} 
				
				
			}
			

		}

		function renderPictures($picture, $check_author){

            global $forumPicExt; $img_wrap = "";

            $img_wrap = ' 

            <div class="card wall-post-img-card col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6 p-5">
                <img src="'.$forumPicExt.$picture.'" alt="" class="rounded wall-post-img card-img">																												 
                <div class="c-wall-tasks-btn">
                    <div class="card-img-overlay text-end p-0 p-5">';

                    if($check_author == true){
                        $img_wrap .= '	
            
                        <div class="btn-group wall-post-dropdown">
                        
                            <button type="button" class="btn btn-sm btn-primary dropdown-toggle p-0" 
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="bx bx-chevron-down align-middle fs-16  p-0"></i>
                            </button>
							
                            <div class="dropdown-menu dropdown-menu-end dropdownmenu-primary fs-10 animate__animated animate__zoomIn">																		
                                <a class="dropdown-item delete-post-pic" 
                                    href="javascript:;" id="'.$picture.'">
                                    <i class="mdi mdi-image-remove fs-10"></i> Remove
                                </a>
                                <a class="dropdown-item makeProfilePic" 
                                    href="javascript:;" id="'.$picture.'">
                                    <i class="mdi mdi-image-album fs-10"></i> Set Profile Pic
                                </a>
                                <a class="dropdown-item makeWallPic" 
                                    href="javascript:;" id="'.$picture.'">
                                    <i class="mdi mdi-image-filter-black-white fs-10"></i> Set Back. Pic
                                </a>
                            </div>
                        </div>';
                        
                        $style_btn ="7%";
                        
                    }else{ $style_btn ="25%";}
                        
                    $img_wrap .= '	
                        
                        
                        <div class="row justify-content-center" style="position:relative; top: '.$style_btn.';">
                            <button type="button" class="btn waves-effect waves-light p-5">
                                <i class="bx bx-zoom-in align-middle zoom-img"
                                id="'.$forumPicExt.$picture.'"></i>
                            </button>															  
                        </div>
                    </div>
                </div>	
            </div>'; 

            return $img_wrap; 

        }
?>