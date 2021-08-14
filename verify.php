<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require './conn.php';
sendMail($SIGNUPLINK,$SYSEMAIL);
if(isset($_GET['id'])){


    $sql = "UPDATE tb_usernew SET isVerify=1 WHERE user_studentID = '{$_GET['id']}'";
    $result = $conn->query($sql);
    if($result){
        header('location: http://localhost/epidemic/done-reset-password.php');
    }
}

function sendMail($SIGNUPLINK,$SYSEMAIL){
    $mail = new PHPMailer(true);
    $mail->CharSet = 'UTF-8';

    $FROM = 'jay.worawuth@gmail.com';
    $TO = 'thanatorn.chr@gmail.com'; // recipient email
    $subject = "Verify Email";
    $txt = "Please Verify Email thanatorn.chr@gmail.com <br>Please click follow this link : <a href='$SIGNUPLINK"."07590240'".">$SIGNUPLINK</a>";
    $headers = "From: $SYSEMAIL" . "\r\n";

    try {
        //Server settings
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host = 'smtp.gmail.com';                    // Set the SMTP server to send through
        $mail->SMTPAuth = true;                                   // Enable SMTP authentication
        $mail->Username = 'jay.worawuth@gmail.com';                     // SMTP username
        $mail->Password = 'rxtxhldumrvbgqzq';                               // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //Recipients
        $mail->From = $FROM;
        $mail->FromName = 'System';

        $mail->addAddress($TO, '');     // Add a recipient


        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $subject;
        $context = $txt;
        $mail->Body = $context;

        $mail->send();
        echo 'Message has been sent';

    }
    catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";

    }
}