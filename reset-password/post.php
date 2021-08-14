<?php

require '../conn.php';
$id='';
$password = '';
if(isset($_POST['id'])){
    $id = $_POST['id'];
}

if(isset($_POST['password'])){
    $password = $_POST['password'];
}

$sql = "UPDATE tb_usernew SET user_password = '$password' WHERE user_studentID='$id'";
$result = $conn->query($sql);
$arr = array();
if($result){
    $arr['status'] = 'success';
    $arr['statusCode'] = 200;
    echo json_encode($arr);
}
else{
    $arr['status'] = 'error';
    $arr['statusCode'] = 400;
    echo json_encode($arr);
}