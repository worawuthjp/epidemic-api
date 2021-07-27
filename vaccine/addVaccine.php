<?php 
	$db = mysqli_connect('localhost','root','','db_covid');
	if (!$db) {
		echo "Database connection faild";
	}

	$image = $_FILES['image']['name'];
	$name = $_POST['name'];
	$user_vaccine = $_POST['user_vaccine'];
	$user_status = $_POST['user_status'];
	$user_studentID = $_POST['user_studentID'];
	$user_date = $_POST['user_date'];

	$imagePath = 'avataruser/'.$image;
	// $imagePath = 'opencv/test-data/1.jpg';
	$tmp_name = $_FILES['image']['tmp_name'];

	move_uploaded_file($tmp_name, $imagePath);

	$db->query("INSERT INTO tb_vaccine(user_image,image,user_vaccine,user_status,user_studentID,user_date)VALUES('".$image."','".$imagePath."','".$user_vaccine."','".$user_status."','".$user_studentID."','".$user_date."')");
?>