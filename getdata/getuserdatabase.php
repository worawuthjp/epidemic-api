<?php
	include '../conn.php';
	$id = $_GET['id'];

	// $queryResult=$connect -> query("SELECT * FROM user  ");
	$queryResult=$conn -> query("SELECT * FROM tb_usernew where user_studentID ='$id'");

	$result = array ();

	while ($fetchData = $queryResult->fetch_assoc()) {
		$result[] = $fetchData;
	}

	echo utf8_decode(json_encode($result));

?>