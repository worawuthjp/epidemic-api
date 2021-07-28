<?php
require '../model/Timeline.php';
require '../conn.php';
$date = null;
$id = '';
if(isset($_GET['userID'])){
    $id = $_GET['userID'];
}
if(isset($_GET['searchDate'])){
    $date = $_GET['searchDate'];
}


$timeline = new Timeline();
echo $timeline->mapResponse($id,$date,$conn);