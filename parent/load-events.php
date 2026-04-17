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
	This script handle school events
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

	define('fobrain', 'igweze');  /* define a check for wrong access of file */
			
	require 'fobrain-config.php';  /* load fobrain configuration files */	    

	$perPage = $load_more_limit;

	$sql_query = "SELECT eID, startdate, title, comments FROM $notificationTB";

	$page = 1;

	if(!empty($_GET["page"])) {
		$page = $_GET["page"];
	}

	$start = ($page-1)*$perPage;

	if($start < 0) $start = 0;

	$ebele_mark = $sql_query . " limit " . $start . "," . $perPage;

	//$resultset = mysqli_query($conn, $query) or die("database error:". mysqli_error($conn));

	$igweze_prep = $conn->prepare($ebele_mark);
				
	$igweze_prep->execute();

	$rows_count = $igweze_prep->rowCount(); 
	

	//$records = mysqli_fetch_assoc($resultset);

	if(empty($_GET["total_record"])) {
		$_GET["total_record"] = $rows_count; // mysqli_num_rows($resultset);
	}

	$message = '';

	//if(!empty($records)) {
	if($rows_count != 0) {	

		$message .= '<input type="hidden" class="page_number" value="' . $page . '" />';
		$message .= '<input type="hidden" class="total_record" value="' . $_GET["total_record"] . '" />';

		while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
							
			$eID = $row["eID"];
			$startdate = $row["startdate"];
			$title = $row["title"]; 
			$comments = $row["comments"];  

			$startdate = date("j M, Y H:i:s", strtotime($startdate)); 
				
			$message .= '
			<div class="timeline filter-item" id="'.$eID.'">
				<a href="javascript:;" class="timeline-content">
					<div class="timeline-year"><i class="mdi mdi-calendar-clock"></i> '.$startdate.'</div> 
					<h3 class="title">'.$title.'</h3>
					<p class="description">
						'.$comments.'
					</p>
				</a>
			</div>';
			

		} 
	}

	echo $message;

	/*

	if (($_REQUEST['e']) == 'show') {
		
		try {

				fobrainEvents($conn);   /* retrieve school events * /	

		}catch(PDOException $e) {

			fobrainDie( 'Ooops Database Error: ' . $e->getMessage());

		}
	 

	}else{


		echo $userNavPageError;   /* exit or redirect to 404 page * /


	}
			
	if ($msg_s) {

		echo $succesMsg.$msg_s.$sEnd; echo $scroll_up; exit; 						
								
	}	


	if ($msg_e) {

		echo $errorMsg.$msg_e.$eEnd; echo $scroll_up; exit; 		
								
	}	
		*/	
//exit;

?>