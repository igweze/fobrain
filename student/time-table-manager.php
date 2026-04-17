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
	This script handle school time table
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

     	define('fobrain', 'igweze');  /* define a check for wrong access of file */

      	require 'fobrain-config.php';  /* load fobrain configuration files */
 
        // Retrieve JSON from POST body 
        $jsonStr = file_get_contents('php://input'); 
        $jsonObj = json_decode($jsonStr); 
        
        if($jsonObj->request_type == 'add'){ 

            $start = $jsonObj->start; 
            $end = $jsonObj->end; 
        
            $event_data = $jsonObj->event_data; 
            $eventTitle = !empty($event_data[0])?$event_data[0]:''; 
            $eventDesc = !empty($event_data[1])?$event_data[1]:''; 
            $eventURL = !empty($event_data[2])?$event_data[2]:''; 

            $eventTitle = clean($eventTitle); 
            $eventDesc = clean($eventDesc); 
            $eventURL = clean($eventURL); 

            
            if(!empty($eventTitle)){ 
                // Insert event data into the database 
                $sqlQ = "INSERT INTO $studentTimeTable (title,description,url,start,end) VALUES (?,?,?,?,?)"; 
                $stmt = $mysqli_conn->prepare($sqlQ); 
                $stmt->bind_param("sssss", $eventTitle, $eventDesc, $eventURL, $start, $end); 
                $insert = $stmt->execute(); 
        
                if($insert){ 
                    $output = [ 
                        'status' => 1 
                    ]; 
                    echo json_encode($output); 
                }else{ 
                    echo json_encode(['error' => 'Ooops, Timetable Add request failed!']); 
                } 
            }else{
                echo json_encode(['error' => 'Ooops, please enter your title']);
            } 
        }elseif($jsonObj->request_type == 'edit'){ 

            $start = $jsonObj->start; 
            $end = $jsonObj->end; 
            $event_id = $jsonObj->event_id; 
        
            $event_data = $jsonObj->event_data; 
            $eventTitle = !empty($event_data[0])?$event_data[0]:''; 
            $eventDesc = !empty($event_data[1])?$event_data[1]:''; 
            $eventURL = !empty($event_data[2])?$event_data[2]:''; 

            $eventTitle = clean($eventTitle); 
            $eventDesc = clean($eventDesc); 
            $eventURL = clean($eventURL);
            
            if(!empty($eventTitle)){ 
                // Update event data into the database 
                $sqlQ = "UPDATE $studentTimeTable SET title=?,description=?,url=?,start=?,end=? WHERE id=?"; 
                $stmt = $mysqli_conn->prepare($sqlQ); 
                $stmt->bind_param("sssssi", $eventTitle, $eventDesc, $eventURL, $start, $end, $event_id); 
                $update = $stmt->execute(); 
        
                if($update){ 
                    $output = [ 
                        'status' => 1 
                    ]; 
                    echo json_encode($output); 
                }else{ 
                    echo json_encode(['error' => 'Ooops, Timetable Update request failed!']); 
                } 
            }else{
                echo json_encode(['error' => 'Ooops, please enter your title']);
            } 
        }elseif($jsonObj->request_type == 'delete'){ 

            $id = $jsonObj->event_id; 
        
            $sql = "DELETE FROM $studentTimeTable WHERE id=$id"; 
            $delete = $mysqli_conn->query($sql); 
            if($delete){ 
                $output = [ 
                    'status' => 1 
                ]; 
                echo json_encode($output); 
            }else{ 
                echo json_encode(['error' => 'Ooops, Timetable Delete request failed!']); 
            } 

        }else{ 
		
			echo $userNavPageError; exit;  /* else exit or redirect to 404 page */ 
		
		} 
 
?>