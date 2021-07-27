<?php 
	include 'conn.php';

	$plague_headache = $_POST['plague_headache'];
	$plague_fever = $_POST['plague_fever'];
	$plague_heart = $_POST['plague_heart'];
	$plague_cough = $_POST['plague_cough'];
	$plague_pain = $_POST['plague_pain'];

	$connect -> query("INSERT INTO tb_assignment_plague (plague_headache,plague_fever,plague_heart,plague_cough,plague_pain) VALUES ('".$plague_headache."','".$plague_fever."','".$plague_heart."','".$plague_cough."','".$plague_pain."')");
?>