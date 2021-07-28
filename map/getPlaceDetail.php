<?php
require '../model/placeSearchApi.php';
$placeID = '';
if(isset($_GET['placeID'])){
    $placeID = $_GET['placeID'];
}

$map = new placeSearchApi();
echo $map->getMapDetail($placeID);