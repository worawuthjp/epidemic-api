<?php
include "constant.php";
header("Access-Control-Allow-Origin: http://localhost");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: false");
header("access-control-allow-methods: OPTIONS,DELETE,GET,HEAD,PATCH,POST,PUT");
$servername = "localhost";
$username = "root";
$password = "";
$db = "db_covid";
date_default_timezone_set("Asia/Bangkok");
$conn = mysqli_connect($servername, $username, $password, $db);
$conn->set_charset('utf8');


if (!$conn) {
    die("Connection Failed : " . mysqli_connect_error());
}

?>
