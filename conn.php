<?php

$servername = "localhost";
$username = "root";
$password = "";
$db = "db_covid";

$conn = mysqli_connect($servername, $username, $password, $db);

if (!$conn) {
    die("Connection Failed : " . mysqli_connect_error());
}

?>