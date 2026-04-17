<?php


$mail_tem =<<<IGWEZE

<!DOCTYPE html>
<html>
<head>
    <title>$subject</title>
     
    <style> 
        .email-wrapper{
            width: 70%;
            height: auto; 
            border: 1px solid #ccc;
            border-radius: 10px;
            margin: 50px auto;
            padding: 20px;
            color: #000; 
        }
        .email-div{ 
            font-size: 1.1rem;
            margin-bottom: 25px;
            text-align: justify;
            color: #000; 
            
        }
        .email-bold{ 
            font-weight: 700;
            color: blue; 
        } 
        @media  (max-width:450px) { 
            .email-wrapper{
                width: 80% !important;
                padding: 20px;
            } 
        }    
    </style>
</head>
<body> 
            
 
    <div class="email-wrapper">
        <div class="email-div email-bold">
            Dear $recp_name    
        </div>
        <div class="email-div">
            Thank you for your interest in our 14-day free trial program for the FoBrain AI School 
            Management System. We appreciate your enthusiasm and are currently in the process of 
            thoroughly reviewing and verifying the information you provided. This step is essential 
            to ensure the integrity of our system and to help us offer you the best possible support 
            during your trial experience.
        </div>
        <div class="email-div">
            Once your application is approved, you will receive your personalized account 
            information at the email address you provided.                
        </div>
        <div class="email-div">
            We sincerely appreciate your understanding and cooperation, and we look forward 
            to supporting your school. This step is intended to protect the integrity of our system.  
        </div>
         
        <div class="email-div email-bold">
            Warm regards, <br/> 
            The FoBrain Team    
        </div>
    </div> 

</body>
</html>



IGWEZE;

 