<?php
require '../model/Checkin.php';
require '../conn.php';
$id = null;
$lat = null;
$long = null;
if(isset($_POST['userID'])){
    $id = $_POST['userID'];
}

if(isset($_POST['lat'])){
    $lat = $_POST['lat'];
}

if(isset($_POST['long'])){
    $long = $_POST['long'];
}

$res = new Checkin();
echo $res->mapRequest($id,$lat,$long,$conn);