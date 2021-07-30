<?php
require '../model/Status.php';
require '../conn.php';

$status = new Status();
echo json_encode($status);