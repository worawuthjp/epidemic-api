<?php
require '../conn.php';
require '../model/RiskArea.php';

$placeName = '';
$placeID = '';
$lat = null;
$long = null;
$startDate = null;
$endDate = null;
$adminID = null;
$status_id = null;

if(isset($_POST['placeName'])){
    $placeName = $_POST['placeName'];
}
if(isset($_POST['placeID'])){
    $placeID = $_POST['placeID'];
}
if(isset($_POST['lat'])){
    $lat = $_POST['lat'];
}
if(isset($_POST['long'])){
    $long = $_POST['long'];
}

if(isset($_POST['startDate'])){
    $startDate = $_POST['startDate'];
}

if(isset($_POST['endDate'])){
    $endDate = $_POST['endDate'];
}

if(isset($_POST['adminID'])){
    $adminID = $_POST['adminID'];
}

if(isset($_POST['statusID'])){
    $status_id = $_POST['statusID'];
}


$riskArea = new RiskArea();
echo $riskArea->add($placeID,$placeName,$lat,$long,$startDate,$endDate,$adminID,$status_id,$conn);