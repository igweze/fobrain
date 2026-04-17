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
	This page load school event calendar
	------------------------------------------------------------------------*/ 


		if (!defined('fobrain')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
				
		require_once $fobrainIconPage; /* This include top middle global icon page eg go back, print buttons etcs */ 
 
    try { 
      
      $eventsArr = fobrainEvents($conn);  /* retrieve school events array */	
      $eventsCount = count($eventsArr);
      
    }catch(PDOException $e) {

        fobrainDie( 'Ooops Database Error: ' . $e->getMessage());

    }	

    if($eventsCount >= $fiVal){  /* check array is empty */		
              
      $serial_no = 0;  $events_list = ""; $event_td = "";

      for($i = $fiVal; $i <= $eventsCount; $i++){  /* loop array */	
        
        $eID = $eventsArr[$i]["eID"];
        $startdate = $eventsArr[$i]["startdate"];
        $title = $eventsArr[$i]["title"]; 
        $comments = $eventsArr[$i]["comments"];  
        
        $startdate = date("j M, Y H:i:s", strtotime($startdate)); 

        $serial_no++;	 

        if($i <= $load_more_limit){  

$event_list =<<<IGWEZE

        <div class="timeline filter-item" id="$eID">
          <a href="javascript:;" class="timeline-content">
            <div class="timeline-year"><i class="mdi mdi-calendar-clock"></i> $startdate </div>
            
            <h3 class="title">$title</h3>
            <p class="description">
              $comments
            </p>
          </a>
        </div>
        
IGWEZE;

        $events_list .= $event_list;

      }
        
       
        
$events_tb =<<<IGWEZE

        <tr id="row-$eID" >
          <td width="5%">$serial_no</td> 
          <td> $startdate </td> 
          <td> $title </td>
          <td> $comments</td>  
        </tr>

IGWEZE;
                      
        $event_td .= $events_tb; 	  
        
      }
      
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
						$page_title = '<i class="mdi mdi-calendar-multiple fs-18"></i> 
            School Events ';
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

              <input type="hidden" name="total_count" id="total_count" value="<?php echo $eventsCount; ?>"/>
              <!-- events timeline --> 
              <div class="event-timeline my-30">
                               
                  <?php  echo $events_list; ?>  
                  <span  id="filter-wrapper"> </span>                 
              </div> 
              
  
 
              <div class="ajax-loader text-center  my-10" id="wait">
                  <div class="spinner-border text-danger" style="width: 5rem; height: 5rem;" role="status">
                      <span class="visually-hidden">Loading...</span>
                  </div>
                  <div class="font-head-1 fs-30 text-danger">Loading</div>
              </div>
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
                    <th>Title</th> 
                    <th>Message</th> 
                    </tr>
                  </thead> 
                  <tbody> 
                    <?php  echo $event_td; ?>   
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


    <script type="text/javascript"> 

        $(document).ready(function(){ 
          //$("#filter-wrapper").html("");
          onScrollPaginate();           
          $('.view-table-div').fadeOut(100);
          
        });  
         
        function onScrollPaginate() {  
          $(window).scroll(function(e){            
            if($(window).scrollTop() + $(window).height() > $("#filter-wrapper").height()){  

              var lastId = 0;
              
              if($(".filter-item").length < $("#total_count").val()) {
                var lastId = $(".filter-item:last").attr("id"); 
                loadMore(lastId); 
              }

            }
          });
        }

        function loadMore(lastId) {
          
          $(window).off("scroll");

          $.ajax({
            url: 'pagination.php?load=event&lastId=' + lastId,
            type: "get",
            beforeSend: function (){
              $('.ajax-loader').show();
            },
            success: function (data) {
              setTimeout(function() {
                $('.ajax-loader').hide();
                cache: false;
                //$("#filter-wrapper").append(data);
                $("#filter-wrapper").empty().append(data);
             
                onScrollPaginate();
              }, 3000);
            }
          });
        }
  
    </script>	



 