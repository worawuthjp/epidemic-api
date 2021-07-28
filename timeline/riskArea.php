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
if(isset($_GET['placeName'])){
    $placeName = $_GET['placeName'];
}
if(isset($_GET['$placeID'])){
    $placeID = $_GET['$placeID'];
}
if(isset($_GET['lat'])){
    $lat = $_GET['lat'];
}
if(isset($_GET['long'])){
    $long = $_GET['long'];
}

if(isset($_GET['startDate'])){
    $startDate = $_GET['startDate'];
}

if(isset($_GET['endDate'])){
    $endDate = $_GET['endDate'];
}

if(isset($_GET['adminID'])){
    $adminID = $_GET['adminID'];
}

$riskArea = new RiskArea();
echo $riskArea->add($placeID,$placeName,$lat,$long,$startDate,$endDate,$adminID,$conn);