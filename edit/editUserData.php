<?php 
	include 'conn.php';

	$user_studentID = $_POST['user_studentID'];
	$user_fullname = $_POST['user_fullname'];
	$user_faculty = $_POST['user_faculty'];
	$user_department = $_POST['user_department'];
	$user_tel = $_POST['user_tel'];
	$user_address = $_POST['user_address'];
	$user_person = $_POST['user_person'];

	$connect->query("UPDATE tb_usernew SET user_studentID = '".$user_studentID."',user_fullname = '".$user_fullname."',user_faculty = '".$user_faculty."',user_department = '".$user_department."',user_tel = '".$user_tel."' ,user_address = '".$user_address."',user_person = '".$user_person."' where user_studentID = '".$user_studentID."'");
?>