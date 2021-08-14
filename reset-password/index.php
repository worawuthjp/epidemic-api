<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
require '../conn.php';

if(isset($_GET['userID'])){
    $id = $_GET['userID'];
    $user_email = '';
    $arr = array();

    $sql = "SELECT * FROM tb_usernew WHERE user_studentID = '$id'";
    $result = $conn->query($sql);
    if($result->num_rows >= 0){

        while ($row = $result->fetch_assoc()){
            $user_email = $row['user_email'];
        }

        $mail = new PHPMailer(true);
        $mail->CharSet = 'UTF-8';

        $FROM = $SYSEMAIL;
        $TO = $user_email; // recipient email
        $subject = "Reset Password";
        $txt = "If you need to reset password,you can clicked this link : <a href='$RESETPATH"."$id'>$RESETPATH.$id</a>";
        $headers = "From: $SYSEMAIL" . "\r\n";

        try {
            //Server settings
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host = 'smtp.gmail.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth = true;                                   // Enable SMTP authentication
            $mail->Username = $SYSEMAIL;                     // SMTP username
            $mail->Password = $SYSPASS;                               // SMTP password
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

            $arr['isSent'] = true;
            $arr['status'] = 'success';
            $arr['statusCode'] = 200;
            echo json_encode($arr) ;

        }
        catch (Exception $e) {
            $arr['isSent'] = false;
            $arr['status'] = 'error';
            $arr['statusCode'] = 400;
            echo json_encode($arr) ;

        }
    }else{
        $arr['isSent'] = false;
        $arr['status'] = 'error';
        $arr['statusCode'] = 400;
        echo json_encode($arr) ;
    }

}
