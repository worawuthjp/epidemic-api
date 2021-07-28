<?php
require '../model/Timeline.php';
require '../conn.php';
$date = null;
$id = '';
$name = '';
$placeID = '';
if(isset($_GET['userID'])){
    $id = $_GET['userID'];
}
if(isset($_GET['searchDate'])){
    $date = $_GET['searchDate'];
}
if(isset($_GET['placeName'])){
    $name = $_GET['placeName'];
}
if(isset($_GET['placeID'])){
    $placeID = $_GET['placeID'];
}

$timeline = new Timeline();
echo $timeline->mapResponse($id,$date,$conn);