<?php

include '../conn.php';
require '../model/UserLogin.php';

$user_username = $_POST['user_username'];
$user_password = $_POST['user_password'];


$sql = "SELECT * FROM tb_usernew WHERE user_username = '" . $user_username . "' AND user_password = '" . $user_password . "' AND isVerify = 1";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    $id = -1;
    while ($row = mysqli_fetch_array($result)) {
        $id = $row['user_studentID'];
    }

    $sql = "SELECT * FROM `tb_timeline` 
    INNER JOIN `tb_usernew` ON tb_usernew.user_studentID = tb_timeline.user_studentID 
WHERE tb_usernew.user_studentID = '$id' ORDER BY tb_timeline.time_checkout DESC";
    $result2 = $conn->query($sql);
    $s = false;
    $res = new UserLogin();
    $res->userID = $id;
    if ($result2->num_rows > 0) {
        $record = array();
        $status = "";
        while ($row = $result2->fetch_assoc()) {
            if($row['status'] == 1){
                $record = $row;
                $s = true;
                break;
            }
        }

        if($s){
            $origin = new DateTime($record['time_checkout']);
            $target = new DateTime('now');
            $interval = $origin->diff($target);
            $diff = $interval->format('%a');

            if($diff <= 14 ){
                $res->status = "มีความเสี่ยงสูง";
            }else if($diff > 14 && $diff <= 28){
                $res->status = "เฝ้าระวัง";
            }else{
                $res->status = "ไม่มีความเสี่ยง";
            }
        }else{
            $res->status = "ไม่มีความเสี่ยง";
        }

    }
    if(!is_null($res->userID)){
        $res->msg = "success";
    }
    else{
        $res->msg = "error";
    }
    echo $res->mapResponse();
} else {
    $errRes = new UserLogin();

    $errRes->errMsg = "username/password invalid or account is not verify email";
    echo $errRes->mapResponse();
}
?>