<?php
header("Access-Control-Allow-Origin: *");
$servername = "localhost";
$username = "mypos";
$password = "Jay_0925191680";
$db = "db_covid";

$conn = mysqli_connect($servername, $username, $password, $db);

if (!$conn) {
    die("Connection Failed : " . mysqli_connect_error());
}

?>
