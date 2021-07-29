<?php
require '../conn.php';
require '../model/placeSearchApi.php';
$input = null;
if(isset($_GET['input'])){
    $input = $_GET['input'];
}

$map = new placeSearchApi();
echo $map->getResponse($input);
