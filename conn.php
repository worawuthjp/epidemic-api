<?php
header("Access-Control-Allow-Origin: *,http://localhost");
header("Access-Control-Allow-Credentials: false");
header("access-control-allow-methods: OPTIONS,DELETE,GET,HEAD,PATCH,POST,PUT");
$servername = "localhost";
$username = "mypos";
$password = "Jay_0925191680";
$db = "db_covid";

$conn = mysqli_connect($servername, $username, $password, $db);

if (!$conn) {
    die("Connection Failed : " . mysqli_connect_error());
}

?>
