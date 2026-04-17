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
	This script handle companion wall validation
	------------------------------------------------------------------------*/ 

		require ($fobrainvalidater);   
		 
		if (($_REQUEST["postsType"]) == 'frmPostEdit'){	/* load post edit */
			
            /* script validation */ 			
			$post_id = clean($_REQUEST["postID"]);  
			
			if($post_id == ''){
			
				$msg_e = "Ooops, could not load post edit box (Error Post wall 401)"; 
				echo $errorMsg.$msg_e.$eEnd; exit;					
									
			}  

			try {

				$memberInfo = companionWallUserDetails($conn, $_SESSION['regNo'], $seVal);  /* retrieve student companion details */
				
				list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic) = explode ("##", $memberInfo);					
				
				$ebele_mark = "SELECT post_id, author_id, post_msg, post_title

									FROM $cWallPostTB  
									
									WHERE post_id = :post_id
									
									AND author_id = :author_id ";
						
			
				$igweze_prep = $conn->prepare($ebele_mark);
				$igweze_prep->bindValue(':post_id', $post_id);
				$igweze_prep->bindValue(':author_id', $member_id);				
					
				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count == $foreal) {
				
					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
		
						$post_id = $row['post_id'];  
						$author_id = $row['author_id'];
						$post_title = $row['post_title'];
						$post_msg = $row['post_msg'];

					}
					
					$DelPic = $fobrainTemplate.'images/icon_del.gif';
					$post_msg = htmlspecialchars_decode($post_msg);
					$post_msgHolder = nl2br($post_msg);
				
$editPostDiv =<<<IGWEZE
				
					<div id="editPostHolder-$post_id" class="mb-15 animate__animated animate__shakeX">$post_msgHolder</div> 
						<!-- form -->
						<form method="POST" id="frmpostEdit-$post_id" class="highlight-textarea">					
							<textarea  class="form-control cwall-edit-post-$post_id"  
							placeholder="Edit This Post" wrap="hard" onclick="highlight();"
							name="cwall-edit-post">$post_msg</textarea>
							<input type="hidden" name="postFData" value="editPostData" />
							<input type="hidden" name="PostID" value="$post_id" />	
							
							<div class="display-none pull-left" id="postEditLoader-$post_id"> 
								<strong role="status">Processing...</strong>
								<div class="spinner-border ms-auto text-danger" aria-hidden="true"></div>
							</div>
							

							<button class="btn btn-danger pull-left cancelpostEdit mt-10" 
							id="cancelpostEdit-$post_id">Cancel</button>
							<button class="btn btn-primary pull-right postEditStatus mt-10" 
							id="postEdit-$post_id">Save</button>						
						</form>
						<!-- / form -->  
					</div>	
					<div class="clearfix"></div> 

IGWEZE;
					echo $editPostDiv;	
				
				}else{ 
				
					$msg = 'Ooops, Post was not successfully retrieve. Please try again';
					echo $errorMsg.$msg.$eEnd; exit; 			
				
				}
						
			}catch(PDOException $e) {
		
				fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
			} 
				
		}elseif (($_REQUEST["postsType"]) == 'frmCommentEdit'){	/* load comment edit */
			
            /* script validation */   
			$post_data = $_REQUEST["commentID"]; 
			
			list ($div, $comment_id, $post_id) = explode ("-", $post_data);
			
			if(($post_id == '') || ($comment_id == '')){
			
				$msg_e = "Ooops, could not load comment edit box (Error Comment wall 401)"; 
				echo $errorMsg.$msg_e.$eEnd; exit;					
									
			}  

			try {
					
				$memberInfo = companionWallUserDetails($conn, $_SESSION['regNo'], $seVal);  /* retrieve student companion details */
				
				list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic) = explode ("##", $memberInfo);					
				
				$ebele_mark = "SELECT comment_id, post_id, comment, comment_title, comment_pic, comment_date, comment_user	

									FROM $cWallCommentTB 
									
									WHERE post_id = :post_id
									
									AND comment_id = :comment_id
									
									AND comment_user = :comment_user";
						
			
				$igweze_prep = $conn->prepare($ebele_mark);
				$igweze_prep->bindValue(':post_id', $post_id);
				$igweze_prep->bindValue(':comment_id', $comment_id);
				$igweze_prep->bindValue(':comment_user', $member_id);				
					
				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count == $foreal) {
				
					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
		
						$comment_id = $row['comment_id'];
						$post_id = $row['post_id'];
						$comment = $row['comment'];
						$comment_title = $row['comment_title'];
						$comment_pic = $row['comment_pic'];
						$comment_date = $row['comment_date'];
						$comment_user = $row['comment_user'];

					}

					$comment = htmlspecialchars_decode($comment);
					$comment_msgHolder = nl2br($comment);
					
					$post_data = $comment_id."-".$post_id;
				

$editCommentDiv =<<<IGWEZE

					<div id="editCommentHolder-$post_data" class="mb-15 animate__animated animate__shakeX">$comment_msgHolder</div>
						<!-- form -->
						<form method="POST" id="frmcommentEdit-$post_data">					
							<textarea  class="form-control fcommentEditField-$post_data"  
							placeholder="Edit This Comment" wrap="hard" 
								name="fcommentEditField">$comment</textarea>
							<input type="hidden" name="postFData" value="editCommentData" />
							<input type="hidden" name="CPID" value="$post_data" />	
							
							<div class="display-none pull-left" id="commentEditLoader-$post_data"> 
								<strong role="status">Processing...</strong>
								<div class="spinner-border ms-auto text-danger" aria-hidden="true"></div>
							</div> 

							<button class="btn btn-danger pull-left cancelcommentEdit  mt-10" 
							id="cancelcommentEdit-$post_data">Cancel</button>
							<button class="btn btn-primary pull-right commentEditStatus mt-10" 
							id="commentEdit-$post_data">Save</button>
						</form>
						<!-- / form --> 
					</div>	
					<div class="clearfix"></div>

IGWEZE;
					echo $editCommentDiv;	
				
				}else{
									
					$msg = 'Ooops, Comment was not successfully retrieve. Please try again';
					echo $errorMsg.$msg.$eEnd; echo $scroll_up; exit; 	
					
				}
						
			}catch(PDOException $e) {
		
				fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
			}  
				
		}elseif (($_REQUEST["postsType"]) == 'deletePost'){	/* delete post */
			
            /* script validation */ 			
			$idToDelete = clean($_REQUEST["postID"]); 
			
			if($idToDelete == ''){
			
				$msg_e = "Ooops, could not retrieve post message (Error delete 401)"; 
				echo $errorMsg.$msg_e.$eEnd; exit;					
									
			}  

			try {
					
				$delStatus = postDeleteStatus($conn, $idToDelete);
				
				if($delStatus == $seVal) { 
				
					echo "<script type='text/javascript'> 
					alert('Ooops, Original Demo Post is hidden but cannot be totally deleted. However, you can add your post/pictures and delete it');
					</script>"; exit;
				
				}else{				
				
					//$memberInfo = companionWallUserDetails($conn, $_SESSION['regNo'], $seVal);  /* retrieve student companion details */
					//list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic) = explode ("##", $memberInfo);
					
					unlinkTempUpload($conn, $member_id, $idToDelete);
					
					$ebele_mark = "DELETE 

										FROM $cWallPostTB WHERE 
										
										post_id = :post_id  
										
										LIMIT 1"; 
				
					$igweze_prep = $conn->prepare($ebele_mark);					
					$igweze_prep->bindValue(':post_id', $idToDelete);
					//$igweze_prep->bindValue(':author_id', $member_id);  AND author_id = :author_id				 
					$igweze_prep->execute();
				
				}
			
			}catch(PDOException $e) {
		
				fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
			}
				
		}elseif (($_REQUEST["postsType"]) == 'deletePic'){	/* delete post */
			
            /* script validation */ 			
			$uploadPic = $_REQUEST["pictureID"]; 
			$uploadPic = str_replace("foreal",".", $uploadPic);
			
			if($uploadPic == ''){
			
				$msg_e = "Ooops, could not retrieve picture (Error delete 402)"; 
				echo $errorMsg.$msg_e.$eEnd; exit;					
									
			}  

			try {
				
				//$memberInfo = companionWallUserDetails($conn, $_SESSION['regNo'], $seVal);  /* retrieve student companion details */
				//list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic) = explode ("##", $memberInfo);
				
					$ebele_mark = "DELETE 

									FROM $cWallTempUploadTB 
									
									WHERE upload_pathp = :upload_pathp	 
									
									AND upload_type = :upload_type
									
									LIMIT 1";
						
			
				$igweze_prep = $conn->prepare($ebele_mark);				
				$igweze_prep->bindValue(':upload_pathp', $uploadPic);
				//$igweze_prep->bindValue(':member_id', $member_id); AND member_id = :member_id
				$igweze_prep->bindValue(':upload_type', $fiVal);  
				if ($igweze_prep->execute()) { 
				
					if(file_exists($forumPicExtTem.$uploadPic)){ unlink($forumPicExtTem.$uploadPic); }  
									
				}				
			
			}catch(PDOException $e) {
		
				fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
			}

		}elseif (($_REQUEST["postsType"]) == 'deleteProfPic'){	/* delete post */
			
            /* script validation */ 			
			$uploadPic = $_REQUEST["pictureID"]; 
			
			if($uploadPic == ''){
			
				$msg_e = "Ooops, could not retrieve picture (Error delete 403)"; 
				echo $errorMsg.$msg_e.$eEnd; exit;					
									
			} 

			try {
			
				//$memberInfo = companionWallUserDetails($conn, $_SESSION['regNo'], $seVal);  /* retrieve student companion details */				
				//list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic) = explode ("##", $memberInfo);					
				
				$ebele_mark = "DELETE 

					FROM $cWallTempUploadTB 
					
					WHERE upload_pathp = :upload_pathp	 
					
					AND upload_type = :upload_type
					
					LIMIT 1";
						
			
				$igweze_prep = $conn->prepare($ebele_mark); 
				$igweze_prep->bindValue(':upload_pathp', $uploadPic);
				//$igweze_prep->bindValue(':member_id', $member_id);	AND member_id = :member_id
				$igweze_prep->bindValue(':upload_type', $seVal); 
				
				if ($igweze_prep->execute()) { 
				
					if(file_exists($forumPicExtTem.$uploadPic)){ unlink($forumPicExtTem.$uploadPic); } 					
					echo '';

				}				
			
			}catch(PDOException $e) {
		
				fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
			} 
				
		}elseif (($_REQUEST["postsType"]) == 'likePost'){	/* like post */
			
            /* script validation */ 			
			$post_id = clean($_REQUEST["likePostID"]); 
			
			if($post_id == ''){
			
				$msg_e = "Ooops, could not retrieve post data (Error Post Like 401)"; 
				echo $errorMsg.$msg_e.$eEnd; exit;					
									
			} 

			try {
					  
				$memberInfo = companionWallUserDetails($conn, $_SESSION['regNo'], $seVal);  /* retrieve student companion details */
				 
				list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic) = explode ("##", $memberInfo);
				 
				$ebele_mark = "SELECT likes_id
				
								FROM $cWallLikesTB
				
								WHERE post_id = :post_id
								
								AND member_id = :member_id";
						
				$igweze_prep = $conn->prepare($ebele_mark); 
				$igweze_prep->bindValue(':post_id', $post_id);
				$igweze_prep->bindValue(':member_id', $member_id);
				$igweze_prep->execute(); 
				
				$rows_count = $igweze_prep->rowCount();  

				if($rows_count == $i_false){
				
					$ebele_mark_1 = "INSERT INTO $cWallLikesTB
											(post_id, member_id)

											VALUES (:post_id, :member_id)";

					$igweze_prep_1 = $conn->prepare($ebele_mark_1);
					$igweze_prep_1->bindValue(':post_id', $post_id);
					$igweze_prep_1->bindValue(':member_id', $member_id);
										
					if ($igweze_prep_1->execute()) {
					
						$postComOwner = postAuthorByPostID($conn, $post_id);							
						saveNotifications($conn, $postComOwner, $member_id, $post_id, $fiVal, $seVal);
					
					}
					
					$postLikes = companionWallLikes($conn, $post_id, $member_id); 						
					echo $postLikes;
				
				}
				
				
			}catch(PDOException $e) {
		
				fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
			} 
				
		}elseif (($_REQUEST["postsType"]) == 'dislikePost'){	/* dislike post */
			
            /* script validation */ 			
			$post_id = clean($_REQUEST["dislikePostID"]); 
			
			if($post_id == ''){
			
				$msg_e = "Ooops, could not post data (Error Post Like 401)"; 
				echo $errorMsg.$msg_e.$eEnd; exit;					
									
			}   

			try {

				$memberInfo = companionWallUserDetails($conn, $_SESSION['regNo'], $seVal);  /* retrieve student companion details */
				
				list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic) = explode ("##", $memberInfo);
				
					$ebele_mark = "DELETE FROM $cWallLikesTB
					
								WHERE post_id = :post_id
									
									AND member_id = :member_id";

				$igweze_prep = $conn->prepare($ebele_mark);
				$igweze_prep->bindValue(':post_id', $post_id);
				$igweze_prep->bindValue(':member_id', $member_id); 
				
				if ($igweze_prep->execute()) {
					
					$postComOwner = postAuthorByPostID($conn, $post_id);
					removeNotification($conn, $postComOwner, $member_id, $post_id, $fiVal, $seVal);				
					$postLikes = companionWallLikes($conn, $post_id, $member_id); 
					
					echo $postLikes;
					
				}
		
			}catch(PDOException $e) {
		
				fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
			}
				
		}elseif (($_REQUEST["postsType"]) == 'likePostDetail'){	/* like post detail */
			
            /* script validation */ 			
			$post_id = clean($_REQUEST["likePost"]); 
			
			if($post_id == ''){
			
				$msg_e = "Ooops, could not retrieve post data (Error Post Like 401)"; 
				echo $errorMsg.$msg_e.$eEnd; exit;					
									
			} 

			try {
					
				$memberInfo = companionWallUserDetails($conn, $_SESSION['regNo'], $seVal);  /* retrieve student companion details */
				list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic) = explode ("##", $memberInfo);

				$postLikesMore = companionWallMoreLikes($conn, $post_id, $member_id); 									
				echo $postLikesMore; 
				
			}catch(PDOException $e) {
		
				fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
			} 
				
		}elseif (($_REQUEST["postsType"]) == 'deleteComment'){	/* delete comment */
			
            /* script validation */ 			
			$cIDToDelete = clean($_REQUEST["commentID"]); 
			
			if($cIDToDelete == ''){
			
				$msg_e = "Ooops, could not retrieve comment data (Error Post Delete 401)"; 
				echo $errorMsg.$msg_e.$eEnd; exit;					
									
			} 

			try {
					
				$delStatus = commentDeleteStatus($conn, $cIDToDelete); 
				
				if($delStatus == $seVal) { 
				
					echo "<script type='text/javascript'> 
					alert('Ooops, Original Demo Comment is hidden but cannot be totally deleted. However, you can add your comment and delete it');
					</script>"; exit;
				
				}else{
					
					//$memberInfo = companionWallUserDetails($conn, $_SESSION['regNo'], $seVal);  /* retrieve student companion details */					
					//list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic) = explode ("##", $memberInfo);
					
					$ebele_mark = "DELETE 

										FROM $cWallCommentTB 
										
										WHERE comment_id = :comment_id 
										
										LIMIT 1";
				
					$igweze_prep = $conn->prepare($ebele_mark);					
					$igweze_prep->bindValue(':comment_id', $cIDToDelete);
					//$igweze_prep->bindValue(':comment_user', $member_id);	AND comment_user = :comment_user					
					$igweze_prep->execute();
					
					$postID = postIDBycommentID($conn, $cIDToDelete);
					$postComOwner = postAuthorByPostID($conn, $postID);							
					removeNotification($conn, $postComOwner, $member_id, $postID, $fiVal, $fiVal);
				
				}
		
			}catch(PDOException $e) {
		
				fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
			}
				
		}elseif (($_REQUEST["postsType"]) == 'likeComment'){	/* like comment */
			
            /* script validation */ 			
			$comment_id = clean($_REQUEST["commentID"]); 
			
			if($comment_id == ''){
			
				$msg_e = "Ooops, could not retrieve comment data (Error Comment Like 401)"; 
				echo $errorMsg.$msg_e.$eEnd; exit;					
									
			}  

			try {

				$memberInfo = companionWallUserDetails($conn, $_SESSION['regNo'], $seVal);  /* retrieve student companion details */
				list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic) = explode ("##", $memberInfo);
				
				$ebele_mark = "SELECT likes_id
				
								FROM $cWallLikesTB
				
								WHERE comment_id = :comment_id
								
								AND member_id = :member_id";
						
				$igweze_prep = $conn->prepare($ebele_mark);					
				$igweze_prep->bindValue(':comment_id', $comment_id);
				$igweze_prep->bindValue(':member_id', $member_id);					
				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count == $i_false){

					$ebele_mark_1 = "INSERT INTO $cWallLikesTB
									(comment_id, member_id)

									VALUES (:comment_id, :member_id)";

					$igweze_prep_1 = $conn->prepare($ebele_mark_1);
					$igweze_prep_1->bindValue(':comment_id', $comment_id);
					$igweze_prep_1->bindValue(':member_id', $member_id); 
					
					if ($igweze_prep_1->execute()) {
					
						$postID = postIDBycommentID($conn, $comment_id);
						$postComOwner = postAuthorByPostID($conn, $postID);								
						saveNotifications($conn, $postComOwner, $member_id, $postID, $seVal, $seVal);
					
					}
				
				} 
				
				$commentLikes = companionWallComLikes($conn, $comment_id, $member_id);  
				echo $commentLikes;				
		
		
			}catch(PDOException $e) {
		
				fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
			} 
				
		}elseif (($_REQUEST["postsType"]) == 'dislikeComment'){	/* dislike comment */
			
            /* script validation */ 			
			$comment_id = clean($_REQUEST["commentID"]);
			
			if($comment_id == ''){
			
				$msg_e = "Ooops, could not retrieve comment data (Error Comment Like 402)"; 
				echo $errorMsg.$msg_e.$eEnd; exit;					
									
			}
		 
			try {

				$memberInfo = companionWallUserDetails($conn, $_SESSION['regNo'], $seVal);  /* retrieve student companion details */
				
				list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic) = explode ("##", $memberInfo);
				
					$ebele_mark = "DELETE FROM $cWallLikesTB
					
								WHERE comment_id = :comment_id
									
									AND member_id = :member_id";

				$igweze_prep = $conn->prepare($ebele_mark);

				$igweze_prep->bindValue(':comment_id', $comment_id);
				$igweze_prep->bindValue(':member_id', $member_id);
				
				if ($igweze_prep->execute()) {
				
					$postID = postIDBycommentID($conn, $comment_id);
					$postComOwner = postAuthorByPostID($conn, $postID);					
					removeNotification($conn, $postComOwner, $member_id, $postID, $seVal, $seVal);					
					$commentLikes = companionWallComLikes($conn, $comment_id, $member_id); 
					
					echo $commentLikes;
					
				}
					
			}catch(PDOException $e) {
		
				fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
			} 
				
		}elseif (($_REQUEST["postsType"]) == 'commentDiv'){	/* comment div */
			
            /* script validation */ 			
			$post_id = clean($_REQUEST["postComID"]);
			
			if($post_id == ''){
			
				$msg_e = "Ooops, could not retrieve comment data (Error Comment 410)"; 
				echo $errorMsg.$msg_e.$eEnd; exit;					
									
			} 

			try {

				$commentDiv = commentsNum($conn, $post_id);
				echo $commentDiv;
						
			}catch(PDOException $e) {
		
				fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
			}  
				
		}elseif (($_REQUEST["postsType"]) == 'deleteTempUpload' ){

			try { 
			
				$memberInfo = companionWallUserDetails($conn, $_SESSION['regNo'], $seVal);  /* retrieve student companion details */
				list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic) = explode ("##", $memberInfo);				
				
				$status = 'deleteTempPic';				
				removeTempUpload($conn, $member_id, $status);
						
			}catch(PDOException $e) {
		
				fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
			} 
			//echo $commentDiv;
				
		}elseif (($_REQUEST["postsType"]) == 'companionWallUser'){
			
			$memberID = clean($_REQUEST['memberID']);
	
			try {

				$memberInfo = companionWallUserDetails($conn, $memberID, $fiVal);
				list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic) = explode ("##", $memberInfo);		
					
				if ($member_id == '') { 
				
					$msg_i = "You are not allow to post on this forum. please contact your administrator for more info. Thanks"; 
					echo $infoMsg.$msg_i.$iEnd; exit; 

				}else{ 
					
					userCompanionWall($conn, $memberID);	
				
				}
						
			}catch(PDOException $e) {
		
				fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
			}
								
				
		}elseif (($_REQUEST["postsType"]) == 'filterCWallPosts'){
			
			$filterVal = clean($_REQUEST['filterVal']);
	
			try {
			
				$memberInfo = companionWallUserDetails($conn, $_SESSION['regNo'], $seVal);  /* retrieve student companion details */
				
				list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic, $m_dept, $m_faculty, $userMail, 
						$wallPic, $load_page) = explode ("##", $memberInfo);				
				
				
				loadCompanionWall($conn, $filterVal, $m_dept, $m_faculty);
						
			}catch(PDOException $e) {
		
				fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
			} 			
				
		}elseif (($_REQUEST["postsType"]) == 'filterCWallSetting'){
			
			$filterVal = clean($_REQUEST['filterVal']);

			try {

				$memberInfo = companionWallUserDetails($conn, $_SESSION['regNo'], $seVal);  /* retrieve student companion details */
				list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic, $m_dept, $m_faculty, $userMail, 
				$wallPic, $load_page) = explode ("##", $memberInfo);				

				$ebele_mark = "UPDATE $fobrainCWallTB 
						
								SET 
								
								load_page = :load_page
								
								WHERE member_id = :member_id";

				$igweze_prep = $conn->prepare($ebele_mark);
				$igweze_prep->bindValue(':load_page', $filterVal);
				$igweze_prep->bindValue(':member_id', $member_id);
				
				if ($igweze_prep->execute()){
				
					$msg_s = "<b>$m_name</b>, your news feed filter settings was 
					successfully updated";
					echo $succesMsg.$msg_s.$sEnd; exit;
				
				}else{
					
					$msg_e = "Ooops Something went wrong while update your news feed filter settings, please try again";
					echo $errorMsg.$msg_e.$eEnd; exit; 
				
				}
					
			}catch(PDOException $e) {

				fobrainDie( 'Ooops Database Error: ' . $e->getMessage());

			}
				
		}elseif (($_REQUEST["postsType"]) == 'validateEmail'){
			
			$filterVal = clean($_REQUEST['filterVal']);
	
			if ((strlen($filterVal) < $thVal) || (strlen($filterVal) > 11) || (!ctype_alnum($filterVal))){
				
				$msg_e = "Email Address must be more than <b> 3 
				(three)  &amp; less than 11 digit</b>. Must contain only <b> 
				Alphabet &amp; Numbers eg amanda, nkiruka, andre004</b> ";
				echo $errorMsg.$msg_e.$eEnd;
				
				echo "<script type='text/javascript'> 
						$('.availMail, .mailAlready, .registerCMail, .mail-spinner').fadeOut(300);  
						$('#cMailUser').removeClass('border-success');
					</script>"; exit;
				
			}else{
				
				try {

					$ebele_mark = "SELECT member_id
			
										FROM $fobrainCWallTB

										WHERE member_mail = :member_mail";
							
					$igweze_prep = $conn->prepare($ebele_mark);						
					$igweze_prep->bindValue(':member_mail', $filterVal);
					
					$igweze_prep->execute();
					
					$rows_count = $igweze_prep->rowCount(); 
					
					if($rows_count >= $foreal) {
						
						echo "<script type='text/javascript'> 
								$('.availMail, .mail-spinner, .registerCMail').fadeOut(300); 
								$('.mailAlready').fadeIn(300);   
								$('#cMailUser').addClass('border-danger');	 
							</script>"; exit;
					
					}else{
						
						echo "<script type='text/javascript'> 
								$('.mailAlready, .mail-spinner').fadeOut(300); 
								$('.availMail, .registerCMail').fadeIn(300); 
								$('#cMailUser').addClass('border-success');	 
							</script>"; exit;
							
					} 

							
				}catch(PDOException $e) {
			
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
				
				}
			
			
			}
							
				
		}elseif (($_REQUEST["postsType"]) == 'registerMail'){
			
			$filterVal = clean($_REQUEST['filterVal']);
	
			if ((strlen($filterVal) < $thVal) || (strlen($filterVal) > 11) || (!ctype_alnum($filterVal))){
				
				$msg_e = "Email Address must be more than <b> 3 
				(three)  &amp; less than 11 digit</b>. Must contain only <b> 
				Alphabet &amp; Numbers eg amanda, nkiruka, andre004</b> ";
				echo $errorMsg.$msg_e.$eEnd;
				
				echo "<script type='text/javascript'> 
						$('.availMail, .mailAlready, .registerCMail').fadeOut(300);  
					</script>"; exit;
					
			}else{
				
				try {

					$ebele_mark = "SELECT member_id
			
										FROM $fobrainCWallTB

										WHERE member_mail = :member_mail";
							
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':member_mail', $filterVal);					
					$igweze_prep->execute();
					
					$rows_count = $igweze_prep->rowCount(); 
					
					if($rows_count >= $foreal) {
						
						echo "<script type='text/javascript'> 
							$('.availMail, .registerCMail, .mail-spinner').fadeOut(300); 
							$('.mailAlready').fadeIn(300);  
							</script>"; exit;
					
					}else{							
						
						$memberInfo = companionWallUserDetails($conn, $_SESSION['regNo'], $seVal);  /* retrieve student companion details */
				
						list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic, $m_dept, $m_faculty, $userMail, 
							$wallPic, $load_page) = explode ("##", $memberInfo);				
				
				
						$ebele_mark_1 = "UPDATE $fobrainCWallTB 
								
										SET 
										
										member_mail = :member_mail
										
										WHERE member_id = :member_id";

						$igweze_prep_1 = $conn->prepare($ebele_mark_1);
						$igweze_prep_1->bindValue(':member_mail', $filterVal);
						$igweze_prep_1->bindValue(':member_id', $member_id);
						
						if ($igweze_prep_1->execute()){
							
							$newUserEmail = $filterVal.'@fobrain.com';
							
							$msg_s = "<b>$m_name</b>, your email address <b>($newUserEmail)</b> was successfully saved";
							echo $succesMsg.$msg_s.$sEnd;
							
							echo "<script type='text/javascript'> 
								$('.fobrain-section-div').slideUp(1000); 	
								$('.registerCMail, .mail-spinner').fadeOut(300);  
								$('#comp-usermail-div').html('$newUserEmail');
							</script>"; exit; 
						
						}else{
							
							$msg_e = "Ooops Something went wrong while saving your Email Address, please try again";
							echo $errorMsg.$msg_e.$eEnd; exit;
						
						}
						
					}

							
				}catch(PDOException $e) {
			
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
				
				} 
			
			} 				
				
		}elseif (($_REQUEST["postsType"]) == 'companionWallPosts'){
		
			try {
			
				$memberInfo = companionWallUserDetails($conn, $_SESSION['regNo'], $seVal);  /* retrieve student companion details */
				
				list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic, $m_dept, $m_faculty, $load_page) = explode ("##", $memberInfo);				
				
				loadCompanionWall($conn, $load_page, $m_dept, $m_faculty);
						
			}catch(PDOException $e) {
		
				fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
			} 			
				
		}elseif (($_REQUEST["postsType"]) == 'uploadProfPic'){
		
			try {
			
				$memberInfo = companionWallUserDetails($conn, $_SESSION['regNo'], $seVal);  /* retrieve student companion details */
				
				list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic) = explode ("##", $memberInfo);				
				
				loadCompanionWall($conn);
						
			}catch(PDOException $e) {
		
				fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			
			} 			
				
		}else{ exit; }  exit; 
?>