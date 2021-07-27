<?php 
	include '../conn.php';

	$province = $_GET['province'];
	$district = $_GET['district'];

	$queryResult = $conn->query("SELECT * from tb_hosmap where hospital_address LIKE '%$province%' AND hospital_address LIKE '%$district%'");

	$result = array ();

	while ($fetchData = $queryResult->fetch_assoc()) {
		$result[] = $fetchData;
	}

	echo json_encode($result);
?>