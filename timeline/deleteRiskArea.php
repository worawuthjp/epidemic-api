<?php
require '../conn.php';
require '../model/RiskArea.php';
$id = null;
if(isset($_POST['id'])){
    $id = $_POST['id'];
}

$riskArea = new RiskArea();
echo $riskArea->delete($id,$conn);