<?php


class RiskArea
{
    public $msg;

    public function __construct()
    {

        $this->msg = "error";
    }

    public function add($id, $name, $lat, $long, $startDate, $endDate, $admin_id, $conn)
    {
        $sql = "INSERT INTO `tb_riskarea` (riskarea_name,placeID,latitude,longtitude,startDate,endDate,admin_id) VALUES('$name','$id','$lat','$long','$startDate','$endDate','$admin_id')";
        $result = $conn->query($sql);
        if ($result) {
            $this->msg = "success";
        }
        return json_encode($this);

    }
}