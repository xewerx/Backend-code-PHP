<?php
    require_once('phpmailer/class.phpmailer.php');    //dodanie klasy phpmailer
    require_once('phpmailer/class.smtp.php');    //dodanie klasy smtp

function sendMail($receiver, $title, $message) {
   
    $mail = new PHPMailer(); // create a new object
    $mail->IsSMTP(); // enable SMTP
    $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 465; // or 587
    $mail->CharSet = 'UTF-8';
    $mail->IsHTML(true);
    $mail->Username = "ewaryst1002@gmail.com";
    $mail->Password = "123EWer123@";
    $mail->SetFrom("ewaryst1002@gmail.com");
    $mail->Subject = $title;
    $mail->Body = $message;
    $mail->AddAddress($receiver);
    
     if(!$mail->Send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
     } else {
        echo "Message has been sent";
     }
   }

