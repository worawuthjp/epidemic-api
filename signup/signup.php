<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

require "../conn.php";


	$name = $_POST['name'];
	$user_studentID = $_POST['user_studentID'];
	$user_fullname = $_POST['user_fullname'];
	$user_faculty = $_POST['user_faculty'];
	$user_department = $_POST['user_department'];
	$user_tel = $_POST['user_tel'];
	$user_address = $_POST['user_address'];
	$user_person = $_POST['user_person'];
	$user_username = $_POST['user_username'];
	$user_email = $_POST['user_email'];
	$user_password = $_POST['user_password'];
	$image = '';
	$tmp_name = '';
	if(isset($_FILES['image']['name'])){
		$image = $_FILES['image']['name'];
		$tmp_name = $_FILES['image']['tmp_name'];
		move_uploaded_file($tmp_name, $imagePath);
	}
	$imagePath = 'avataruser/'.$image;
	// $imagePath = 'opencv/test-data/1.jpg';

	$sql = "INSERT INTO tb_usernew(user_studentID,user_fullname,user_faculty,user_department,user_tel,user_address,user_person,user_username,user_email,user_password,user_img,image) 
VALUES('$user_studentID','$user_fullname','$user_faculty','$user_department','$user_tel','$user_address','$user_person','$user_username','$user_email','$user_password','$tmp_name','$imagePath')";
	$result = $conn->query($sql);
	if($result){
		//send mail
		$mail = new PHPMailer(true);
		$mail->CharSet = 'UTF-8';

		$FROM = $SYSEMAIL;
		$TO = $user_email; // recipient email
		$subject = "Verify Email";
		$txt = "Please Verify Email thanatorn.chr@gmail.com <br>Please click follow this link : <a href='$SIGNUPLINK"."$user_studentID'".">$SIGNUPLINK.$id</a>";
		$headers = "From: $SYSEMAIL" . "\r\n";
		$arr = array();
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
			$sql = "DELETE FROM tb_usernew WHERE user_studentID='$user_studentID'";
			$conn->query($sql);
			$arr['isSent'] = false;
			$arr['status'] = 'error';
			$arr['statusCode'] = 400;
			echo json_encode($arr) ;

		}
	}

?>
