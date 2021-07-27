<?php 
	include 'conn.php';

	$sql = $connect->query("SELECT * FROM tb_epidemic");

	$res = array();

	while($row=$sql->fetch_assoc()){
		$res[] = $row;
	}
	echo json_encode($res);
?>