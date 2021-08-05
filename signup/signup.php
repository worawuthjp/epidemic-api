<?php
	require "../conn.php";

	$image = $_FILES['image']['name'];
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

	$imagePath = 'avataruser/'.$image;
	// $imagePath = 'opencv/test-data/1.jpg';
	$tmp_name = $_FILES['image']['tmp_name'];

	move_uploaded_file($tmp_name, $imagePath);

	$conn->query("INSERT INTO tb_usernew(user_img,image,user_studentID,user_fullname,user_faculty,user_department,user_tel,user_address,user_person,user_username,user_email,user_password)VALUES('".''."','".$imagePath."','".$user_studentID."','".$user_fullname."','".$user_faculty."','".$user_department."','".$user_tel."','".$user_address."','".$user_person."','".$user_username."','".$user_email."','".$user_password."')");


?>
