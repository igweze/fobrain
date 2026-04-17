<?php

    if($footer != ""){
        $footer = "<div style='margin-top:70px;'>$footer</div>";
    }

    $message_body = "$message $footer";

    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = $send_host;                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = $send_mail;                     //SMTP username
    $mail->Password   = $send_pass;                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    $mail->SMTPKeepAlive = true; // add it to keep the SMTP connection open after each email sent

    //Recipients
    $mail->setFrom($send_mail, $send_name);
    //$mail->addAddress($recp_mail, $recp_name);     //Add a recipient
    //$mail->addAddress('igwezemark@gmail.com');               //Name is optional
    $mail->addReplyTo($send_mail, $send_name);
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com'); 
    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $message_body;
    $mail->AltBody = $message_body;  