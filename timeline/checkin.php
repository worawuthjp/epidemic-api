<?php
require '../model/Checkin.php';
require '../conn.php';
$id = null;
$lat = null;
$long = null;
$name = '';
$placeID = '';
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


$res = new Checkin();
echo $res->mapRequest($id,$lat,$long,$name,$placeID,$conn);