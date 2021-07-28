<?php


class RiskArea
{
    public $msg;
    public $found;

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
            $this->checkRisk($conn,$lat,$long,$startDate,$endDate);
        }
        return json_encode($this);

    }

    public function checkRisk($conn,$lat,$long,$startDate,$endDate){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=$lat,$long&radius=1500&key=AIzaSyCXzEl_l-8_eE-tK1W4KQ3wiKT1OoOGq-E",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $res = json_decode($response['result']);
        print_r($res);
        foreach ($res as $item){
            $placeID = $item->place_id;
            $sql = "UPDATE `tb_timeline` SET status='1' WHERE place_id = '$placeID' and timeline_checkin >= '$startDate' and timeline_checkout <= '$endDate' ";
            echo $sql;
            $result = $conn->query($sql);
            $this->found = $result;
        }
    }
}