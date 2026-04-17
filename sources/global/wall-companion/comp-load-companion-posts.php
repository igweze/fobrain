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
	This script handle companion message posts & comments
	------------------------------------------------------------------------*/ 

			require ($fobrainvalidater); 

			if(($_REQUEST['cWallPaginate']) == 'paginateCompanionWall'){
				
				try {
						
						$memberInfo = companionWallUserDetails($conn, $_SESSION['regNo'], $seVal);  /* retrieve student companion details */
						
						list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic, $m_dept, $m_faculty, $userMail, 
							  $wallPic, $load_page) = explode ("##", $memberInfo);				
							
							
						/* script validation */
						
						if(isset($_REQUEST['pageID']) && !empty($_REQUEST['loadType'])){
					
								$pageID = $_POST['pageID'];
								$loadType = $_POST['loadType'];
						}else{
					
								$pageID = $i_false;
								#$msg_e = "Ooops, There is no more post in Companion Wall to display.";
								#echo $errorMsg.$msg_e.$eEnd; exit; 			
						}
				
						$pageLimit = $cWallNumPerPage * $pageID;
						
						if ($loadType == $seVal){

								$ebele_mark = "SELECT post_id, author_id, post_title, post_msg, post_img_fi, post_img_se, 
								post_img_th, post_img_fo, 
												post_date, post_ip, post_type
												
												FROM $cWallPostTB  
												
												WHERE f_id = :f_id
												
												ORDER BY post_id DESC limit $pageLimit, $cWallNumPerPage";

								$igweze_prep = $conn->prepare($ebele_mark);
								$igweze_prep->bindValue(':f_id', $m_faculty);		

								$msg_e = "Ooops, There is no more post in Companion Wall from your faculty classmates to display.";

						}elseif ($loadType == $thVal){		
			
								$ebele_mark = "SELECT post_id, author_id, post_title, post_msg, post_img_fi, post_img_se, 
								post_img_th, post_img_fo, 
												post_date, post_ip, post_type
								
												FROM $cWallPostTB  
												
												WHERE d_id = :d_id
												
												ORDER BY post_id DESC limit $pageLimit, $cWallNumPerPage";

								$igweze_prep = $conn->prepare($ebele_mark);
								$igweze_prep->bindValue(':d_id', $m_dept);		
								
								$msg_e = "Ooops, There is no more post in Companion Wall from your Deparmental classmates to 
								display.";
								
				
				
						}else {
					

								$ebele_mark = "SELECT post_id, author_id, post_title, post_msg, post_img_fi, post_img_se,
								post_img_th, post_img_fo, 
												post_date, post_ip, post_type
								

												FROM $cWallPostTB  ORDER BY post_id DESC limit $pageLimit, $cWallNumPerPage";

								$igweze_prep = $conn->prepare($ebele_mark);

								$msg_e = "Ooops, There is no more post in Companion Wall to display.";


						}
								$igweze_prep->execute();
								$rows_count = $igweze_prep->rowCount(); 
						
					
				
						if($rows_count > $i_false){
							
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
								
								$post_date = wallTimerBoy($post_time);  /* companion wall time ago */
								
								$post_msg = htmlspecialchars_decode($post_msg);
								
								$post_Edit = $post_msg;
								
								$post_msg = nl2br($post_msg);
								
								$checkEdit = $i_false;
								
								$thisMemberInfo = companionWallUserDetails($conn, $_SESSION['regNo'], $seVal);  /* retrieve student companion details */
							
								list ($check_user, $tRegNum, $tm_name, $tm_sex, $tprof_pic, $tm_dept, $tm_faculty, $tUserMail, 
								  $tWallPic, $tload_page) = explode ("##", $thisMemberInfo);				
					 
								$memberInfo = companionWallUserDetails($conn, $author_id, $fiVal);  /* retrieve student companion details */
							
								list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic) = explode ("##", $memberInfo);
								
								$genderVerb = genderVerb($m_sex);  /* gender verb */
								
								$postLikes = companionWallLikes($conn, $post_id, $check_user);  /* show companion wall post likes & dislike */
		 										
								$postLikesMore = companionWallMoreLikes($conn, $post_id, $check_user); /* show companion wall post more likes & dislike */
								
								$commentDiv = commentsNum($conn, $post_id);  /* show companion wall comment number */
								
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
								
									
								if($checkPostAuthor == true){
								
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
								
								$student_img = '<img src="'.$stuFpic.'" class="poster-img" />';
													
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
							
								companionWallComments($conn, $post_id);  /* load  companion wall post comments */
		 									
								echo '</ul> </li>';
								
								$post_msg =''; $checkPostAuthor = '';
								$fi_upload =''; $se_upload ='';$th_upload =''; $fo_upload ='';  $changeProfPic = '';
												
							}
							
						}else{
							
								echo $errorMsg.$msg_e.$eEnd; exit; 			

						}
			
								
					}catch(PDOException $e) {
  			
						fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					}
				
				
			}elseif(($_REQUEST['cWallPaginate']) == 'paginateMemberCWall'){
				
				try {

						/* script validation */
						
						if(isset($_REQUEST['pageID']) && !empty($_REQUEST['memberID'])){
					
								$pageID = $_POST['pageID'];
								$memberID = $_POST['memberID'];
								
						}else{
					
								$pageID = $i_false;
								
						}
				
						echo $pageLimit = $cWallNumPerPage * $pageID;
						
						
						$ebele_mark = "SELECT post_id, author_id, post_title, post_msg, post_img_fi, post_img_se, post_img_th, post_img_fo, 
								post_date, post_ip, post_type

										 FROM $cWallPostTB  
										 
										 WHERE author_id = :author_id 
										 
										 ORDER BY post_id DESC
										 
										 LIMIT $pageLimit, $cWallNumPerPage";
							 
					
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':author_id', $memberID);				
						$igweze_prep->execute();
						$rows_count = $igweze_prep->rowCount(); 

						$msg_e = "Ooops, There is no more post in Companion Wall to display.";

						
				
						if($rows_count > $i_false){
							
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
								
								$post_date = wallTimerBoy($post_time);  /* companion wall time ago */
								
								$post_msg = htmlspecialchars_decode($post_msg);
								
								$post_Edit = $post_msg;
								
								$post_msg = nl2br($post_msg);
								
								$checkEdit = $i_false;
								
								$thisUserInfo = companionWallUserDetails($conn, $_SESSION['regNo'], $seVal);  /* retrieve student companion details */
								
								list ($this_user_id, $faRegNum_this, $m_name_this, $m_sex_this, $prof_pic_comm) = explode ("##", $thisUserInfo);	
								
								$memberInfo = companionWallUserDetails($conn, $author_id, $fiVal);  /* retrieve student companion details */
							
								list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic) = explode ("##", $memberInfo);  /* retrieve student companion details */
								
								$genderVerb = genderVerb($m_sex);  /* gender verb */
								
								$postLikes = companionWallLikes($conn, $post_id, $member_id);  /* show companion wall post likes & dislike */
								
								$postLikesMore = companionWallMoreLikes($conn, $post_id, $member_id);  /* show companion wall post more likes & dislike */
								
								$commentDiv = commentsNum($conn, $post_id);  /* show companion wall comment number */
								
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
								
									
								if($checkPostAuthor == true){
								
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
								
								$student_img = '<img src="'.$stuFpic.'" class="poster-img" />';
													
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
							
								companionWallComments($conn, $post_id);  /* load  companion wall post comments */
		 									
								echo '</ul> </li>';
								
								$post_msg ='';
								$fi_upload =''; $se_upload ='';$th_upload =''; $fo_upload ='';  $changeProfPic = '';					
					
				
							}
				
						}else{
						
							echo $errorMsg.$msg_e.$eEnd; exit; 			

						}
								
					}catch(PDOException $e) {
  			
						fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					}
				

								   
				}else{
					
						echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
					
				}exit;
										 
										 
		
		
?>