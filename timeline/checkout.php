<?php

require '../conn.php';
require '../model/Checkout.php';

$id = null;
if(isset($_POST['userID'])){
    $id = $_POST['userID'];
}

$response = new Checkout();
echo $response->checkout($id,$conn);