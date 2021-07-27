<?php 
	include '../conn.php';

	$search = $_GET['search'];

	$queryResult = $conn->query("SELECT * from tb_epidemic where epidemic_topic LIKE '%$search%'");

	$result = array ();

	while ($fetchData = $queryResult->fetch_assoc()) {
		$result[] = $fetchData;
	}

	echo json_encode($result);
?>