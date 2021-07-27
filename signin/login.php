<?php

    //include 'conn.php';

    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "db_covid";

    $conn = mysqli_connect($servername, $username, $password, $db);

    if(!$conn){
        die("Connection Failed : " . mysqli_connect_error());
    }

    $user_username = $_POST['user_username'];
    $user_password = $_POST['user_password'];



    $sql = "SELECT * FROM tb_usernew WHERE user_username = '".$user_username."' AND user_password = '".$user_password."'";
    $result = $conn->query($sql);


    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $id = $row['user_studentID'];
        }

        echo json_encode($id);
    } else {
        echo json_encode("Error");
    }
?>