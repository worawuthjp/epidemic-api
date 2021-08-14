<?php
require '../model/Checkin.php';
require '../conn.php';
$id = null;
$lat = null;
$long = null;
$name = '';
$placeID = '';

$res = new Checkin();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['userID'])){
        $id = $_POST['userID'];
    }

    if(isset($_POST['lat'])){
        $lat = $_POST['lat'];
    }

    if(isset($_POST['long'])){
        $long = $_POST['long'];
    }

    if(isset($_POST['placeName'])){
        $name = $_POST['placeName'];
    }
    if(isset($_POST['placeID'])){
        $placeID = $_POST['placeID'];
    }
    echo $res->mapRequest($id,$lat,$long,$name,$placeID,$conn);
}else if($_SERVER['REQUEST_METHOD'] == 'GET'){
    if(isset($_GET['userID'])){
        $id = $_GET['userID'];
    }
    $row = $res->getLastest($id,$conn);
    $response = array();
    $response['msg'] = 'error';
    $response['statusCode'] = 200;
    if($id){
        $response['msg'] = 'success';
        $response['isCheckout'] = isset($row['timeline_id']) ? $res->isCheckout($row['timeline_id'],$conn) : true;
        $response['placeID'] = isset($row['place_id']) ? $row['place_id'] : null;
        $response['placeName'] = isset($row['timeline_name']) ?$row['timeline_name']:null;
        $response['time_checkin'] = isset($row['time_checkin']) ?$row['time_checkin']:null;
        $response['statusCode'] = 200;
    }
    echo json_encode($response);

}