<?php 
	include '../conn.php';

	$assignment_vomit = $_POST['assignment_vomit'];
	$assignment_cough = $_POST['assignment_cough'];
	$assignment_sore_throat = $_POST['assignment_sore_throat'];
	$assignment_temp37 = $_POST['assignment_temp37'];
	$assignment_no_symptoms = $_POST['assignment_no_symptoms'];

	$conn -> query("INSERT INTO tb_assignment (assignment_vomit,assignment_cough,assignment_sore_throat,assignment_temp37,assignment_no_symptoms) VALUES ('".$assignment_vomit."','".$assignment_cough."','".$assignment_sore_throat."','".$assignment_temp37."','".$assignment_no_symptoms."')");
?>