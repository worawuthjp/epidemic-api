<?php
require '../conn.php';
require '../model/placeSearchApi.php';
$placeID = '';
if(isset($_GET['placeID'])){
    $placeID = $_GET['placeID'];
}

$map = new placeSearchApi();
echo $map->getMapDetail($placeID,$API_MAP_KEY);