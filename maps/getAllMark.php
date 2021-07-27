<?php 
	include 'conn.php';

	$sql = $connect->query("SELECT hospital_id, hospital_name, unusual_pin, hospital_address, latitude, longitude FROM tb_hosmap WHERE unusual_pin = 'Y'");

	$res = array();

	while($row=$sql->fetch_assoc()){
		$res[] = $row;
	}
	echo json_encode($res);
?>