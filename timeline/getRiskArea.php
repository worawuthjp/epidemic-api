<?php
require '../conn.php';
require '../model/RiskArea.php';

$area = new RiskArea();
echo $area->getAll($conn);