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
	This page is for  student roll call
	------------------------------------------------------------------------*/ 


		if (!defined('fobrain')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
				
		require_once $fobrainIconPage; /* This include top middle global icon page eg go back, print buttons etcs */

?>

 
 	<style> 
		div.timeline {
			display:none; 
		}
		div.timeline.display {
			display: inline-block;
		} 
	</style>

	<?php

		try {  
			
			$rollCallArr = fobrainrollCallArray($conn, $regID);  /* retrieve student daily attendance array */	
			$rollCallCount = count($rollCallArr);
		
		}catch(PDOException $e) {

			fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
		
		}	
	
		if($rollCallCount >= $fiVal){  /* check array is empty */		
						
			$serial_no = 0;  $tm_roll_arr = ""; $roll_td = "";

			for($i = $fiVal; $i <= $rollCallCount; $i++){  /* loop array */	 
			
				$rID = $rollCallArr[$i]["id"];
				$startdate = $rollCallArr[$i]["startdate"];
				$comment = $rollCallArr[$i]["comments"];
				$reply = $rollCallArr[$i]["reply"]; 
				$attendance = $rollCallArr[$i]["attendance"]; 
				
				$startdate = date("j M, Y", strtotime($startdate));   
			 
				$title = wizSelectArray($attendance, $attendance_list_2); 
			
				$serial_no++;			
				/*
				if($comments != "")	{
					if (str_contains($comments, ':')) {
					list ($title, $comment) = explode (":", $comments);
					}else{
					$title = $comments; $comment = "<span class='fs-10q'>No comment</span>";
					} 
				}else{
					$title = "No Attendance"; $comment = "<span class='fs-10q'>No comment</span>";            
				}
					
				*/
				
				if(($comment == "")	|| ($comment == " ")){ 
					$comment = "<span class='fs-10q'>No comment</span>"; 
				}

				//if($i <= $load_more_limit){
					$tm_roll_arr .= '
					<div class="timeline filter-item" id="'.$rID.'">
					<a href="#" class="timeline-content">
						<div class="timeline-year"><i class="mdi mdi-calendar-clock"></i> '.$startdate.'</div>
						<h3 class="title text-end">'.$title.'</h3>
						<h3 class="title mt-20 start-end">Teacher\'s Comment</h3>
						<p class="description"> '.$comment.'</p>
						<h3 class="title mt-20 start-end">Parent\'s Reply</h3>
						<p class="description parent-reply-'.$rID.'"> '.$reply.' </p>

						<button id="'.$rID.'" class = "roll-reply text-slateblue btn waves-effect btn-label waves-light">									
							<i class="mdi mdi-message-reply-text-outline label-icon"></i>  Reply
						</button>
					</a>
					</div>
					
					';//<span id="rollcall'.$rID.'"></span>
				//}
            
          

$rollCall =<<<IGWEZE

				<tr id="row-$rID" >
					<td width="5%">$serial_no</td> 
					<td> $startdate </td> 
					<td> $title </td>
					<td> $comment</td>
					<td> <span class="parent-reply-$rID">$reply</span></td>  
					<td> 
						<button id="$rID" class = "roll-reply text-info btn waves-effect btn-label waves-light">									
							<i class="mdi mdi-message-reply-text-outline label-icon"></i> Reply
						</button>
					</td>
				</tr>

IGWEZE;
                        
          		$roll_td .= $rollCall; 								

       	 	}

        	$rollcall_div = $tm_roll_arr.'<span  id="filter-wrapper"> </span>'; 
        
		}else{  /* display information message */ 
				
			$msg_i = "Ooops, you don't have any roll call history to show at the momment"; 
			echo $infMsg.$msg_i.$msgEnd;
				
		} 		
?>  

		<!-- row -->
		<div <?php echo $fob_view; ?> class="row gutters row-section  justify-content-center">
			<div class="col-12">	
				<!-- card start -->
				<div class="card card-shadow">
         			<?php 
					$page_title = '<i class="fas fa-list-ol fs-16"></i> 
            						Student Attendance ';
						pageTitle($page_title, 1);	 
					?> 
					
					<div class="card-body"> 
						<div class="view-tree-div">
							<div class="text-end mt-20 mb-40"> 
								<div class="search">
								<span class="fas fa-search"></span>
								<input   id="filter-div" type="text" placeholder="Search..">
								</div>
							</div>  

							<input type="hidden" name="total_count" id="total_count" value="<?php echo $rollCallCount; ?>"/>
							<!-- roll call-timeline -->
							
							<div class="attendance-timeline my-30">                
								<?php echo $tm_roll_arr; ?> 
							</div> 

							<div class="page-loader display-none text-center" id="wait">
								<div class="spinner-border text-danger" style="width: 5rem; height: 5rem;" role="status">
									<span class="visually-hidden">Loading...</span>
								</div>
								<div class="font-head-1 fs-30 text-danger">Loading</div>
							</div>

							<a href="javascript" id="load-more">Load More</a>
						</div>  
			
						<div class="view-table-div">
							<div class="table-responsive pt-3">				 							
								<script type='text/javascript'> renderTable(); </script> 
								<!-- table -->
								<table  class='table table-hover table-responsive style-table wiz-table'>
								<thead>
									<tr>
									<th>S/N</th> 
									<th>Date</th>						
									<th>Status</th> 
									<th>Comment/s</th> 
									<th>Parent Reply</th> 
									<th>Tasks</th> 
									</tr>
								</thead> 
								<tbody> 
									<?php  echo $roll_td; ?>   
								</tbody>
								</table>
								<!-- table -->
							</div>
						</div>						
					</div>
				</div>
				<!-- card end -->	
			</div>
		</div>
		<!-- / row -->	

		<!--  fobrain modal start -->			
		<button type="button" class="btn modal-fobrain  display-none"  data-bs-toggle="modal" data-bs-target="#modal-fobrain"></button>				
		<!-- Scrollable modal -->
		<div class="modal fade animate__animated animate__zoomInDown" id="modal-fobrain" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
			<div class="modal-dialog modal-fullscreen-sm-down modal-dialog-scrollable">
				<div class="modal-content">
					<div class="modal-header"> 
						<h5 class="modal-title" id="exampleModalScrollableTitle"> 
							<i class="mdi mdi-message-reply-text-outline label-icon"></i>  
							Drop a Reply
						</h5>							 
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div id="edit-msg"> </div> 
					<div class="modal-body">
						<div id="modal-load-div"></div> 
					</div> 
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		<!-- fobrain modal end -->   

    	<script type="text/javascript">  		
			$('div.timeline').slice(0, 6).show();
			$('.view-table-div').fadeOut(100);
			$('body').on('click','#load-more',function(e){  
				$('.page-loader').fadeIn();	
				e.preventDefault();
				$('div.timeline:hidden').slice(0, 6).slideDown();
				if ($('div.timeline:hidden').length === 0) {
					$('#load-more').replaceWith("<p class='p'>No More</p>");
				}
				$('.page-loader').fadeOut(2000);
			});  	
		</script>		