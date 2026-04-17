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
	This script move companion message to trash
	------------------------------------------------------------------------*/ 

	require ($fobrainvalidater); 

	try {

		$memberInfo = companionWallUserDetails($conn, $_SESSION['regNo'], $seVal);  /* retrieve student companion details */
		
		list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic, $m_dept, $m_faculty, $userMail, 
				$wallPic, $load_page) = explode ("##", $memberInfo);	
		
		$mailData = array();	   
		
		foreach($_REQUEST as $mailMsg => $msg_id) {	  /* arrange $_REQUEST Message Array  */					

			$msgType =  msgTypeStatus($conn, $msg_id);
			$mailData[$msg_id] = $msgType;
			$msg_id = ''; $msgType ='';
			
		} 

		$ebele_mark = "UPDATE $fobrainMailBoxTB 
		
						SET 
					
						njnk_type = :njnk_type,
						njnk_trash = :njnk_trash

						WHERE msg_id = :msg_id
						
						AND njnk_reps_id = :njnk_reps_id";
						
		$igweze_prep = $conn->prepare($ebele_mark);	

		foreach($mailData as $msgID => $mailType) {		/* move mail to trash */				
		
			$igweze_prep->bindValue(':njnk_reps_id', $member_id);
			$igweze_prep->bindValue(':njnk_type', $foVal);
			$igweze_prep->bindValue(':msg_id', $msgID);														
			$igweze_prep->bindValue(':njnk_trash', $mailType);
			
			$igweze_prep->execute();
			
			
			echo  "<script type='text/javascript'>$('#mailRowID-$msgID').fadeOut('300'); 
						$('#chkmailID-$msgID').each(function() { 
							this.checked = false; 
						});
					</script>";
			$mailType = ''; $msgID = '';
		
		} 

		if(isset($_SESSION['wallComRank'])){	

			$unreadMsg = numOfUnreadMsgAdmin($conn, $member_id);  /* retrieve number of admin unread message */																	
			$trashMsg = numOfTrashMsg($conn, $member_id);  /* retrieve number of trash message */
			
			echo  "<script type='text/javascript'>
					$('.TrashMsgNum').html('$trashMsg');	
					$('.inboxMsgNum').html('$unreadMsg');	
					$('#selectAll').each(function() { 
						this.checked = false; 
					});	
				</script>";

		}else{
			
			$unreadMsg = numOfUnreadMsg($conn, $member_id); /* retrieve number of nread message */									
			$adminMsg = numOfAdminMsg($conn, $member_id);  /* retrieve number of admin message */									
			$trashMsg = numOfTrashMsg($conn, $member_id);  /* retrieve number of trash message */									

			echo  "<script type='text/javascript'>
					$('.TrashMsgNum').html('$trashMsg');	
					$('.inboxMsgNum').html('$unreadMsg');	
					$('.adminMsgNum').html('$adminMsg');	
					$('#selectAll').each(function() { 
						this.checked = false; 
					});	
				</script>";
		}
				
	}catch(PDOException $e) {

		fobrainDie( 'Ooops Database Error: ' . $e->getMessage());

	} 
	exit; 
?>