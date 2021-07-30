<?php


class Checkin
{
    public $id;
    public $lat;
    public $long;

    public function __construct()
    {
        $this->id = null;
        $this->lat = null;
        $this->long = null;
    }

    public function mapRequest($id, $lat, $long,$name,$placeID, $conn)
    {
        $res = array();
        $record = $this->getLastest($id,$conn);
        if(!$this->isCheckout($record['timeline_id'],$conn)){
            $res['msg'] = 'error';
            $res['isCheckout'] = false;
            $res['statusCode'] = 400;
            return json_encode($res);
        }
        $date = date('Y-m-d H:i:s');
        $status = 0;
        $sql = "SELECT COUNT(*) AS NUM FROM tb_riskarea WHERE placeID = '$placeID' and '$date' BETWEEN startDate and endDate ";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            if($row['NUM'] > 0){
                $status = 1;
            }
        }
        $sql = "INSERT INTO `tb_timeline`(timeline_name,place_id,user_studentID,latitude,longtitude,time_checkin,status) 
VALUES('$name','$placeID','$id','$lat','$long','$date','$status')";
        $result = $conn->query($sql);
        if($result){
            $res['msg'] = 'success';
            $res['statusCode'] = 200;
            if($status == 1){
                $res['isRisk'] = true;
            }
            return json_encode($res);
        }else{

            $res['msg'] = 'error';
            $res['statusCode'] = 400;
            return json_encode($res);
        }
    }

    public function getLastest($id,$conn){
        $sql = "SELECT * FROM tb_timeline WHERE user_studentID = '$id' ORDER BY time_checkin DESC LIMIT 1";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            return $result->fetch_assoc();
        }
        return null;
    }

    public function isCheckout($timelineID,$conn){
        $sql = "SELECT * FROM tb_timeline WHERE timeline_id = '$timelineID' ";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            $row =  $result->fetch_assoc();
            return !is_null($row['time_checkout']);
        }
        return false;
    }
}