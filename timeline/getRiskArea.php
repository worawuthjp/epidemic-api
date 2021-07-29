<?php
require '../conn.php';
require '../model/RiskArea.php';
$id = null;
if(isset($_GET['id'])){
    $id = $_GET['id'];
}
$area = new RiskArea();
echo $area->getAll($conn,$id);