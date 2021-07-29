<?php


class RiskArea
{
    public $msg;
    public $found;

    public function __construct()
    {

        $this->msg = "error";
    }

    public function edit($id,$placeID, $placeName, $lat, $long, $startDate, $endDate, $conn){
        $sql = "SELECT tb_timeline.timeline_id FROM tb_timeline
INNER JOIN tb_riskarea ON tb_riskarea.placeID = tb_timeline.place_id
WHERE tb_timeline.status = 1 and tb_riskarea.riskarea_id = '$id' and tb_timeline.time_checkin BETWEEN tb_riskarea.startDate and tb_riskarea.endDate";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $this->found = $result->num_rows;
                $sql = "UPDATE `tb_timeline` SET status='0' WHERE timeline_id = '{$row['timeline_id']}'";
                $conn->query($sql);
            }
        }
        $sql = "UPDATE tb_riskarea SET riskarea_name='$placeName',placeID='$placeID',latitude='$lat',longtitude='$long',startDate='$startDate',endDate='$endDate' WHERE riskarea_id = $id";
        $result = $conn->query($sql);
        if ($result) {
            $this->msg = "success";
            $this->found = 0;
            $this->checkRisk($conn, $lat, $long, $startDate, $endDate);
        }
        return json_encode($this);
    }

    public function delete($id, $conn){
        $sql = "SELECT tb_timeline.timeline_id FROM tb_timeline
INNER JOIN tb_riskarea ON tb_riskarea.placeID = tb_timeline.place_id
WHERE tb_timeline.status = 1 and tb_riskarea.riskarea_id = '$id' and tb_timeline.time_checkin BETWEEN tb_riskarea.startDate and tb_riskarea.endDate";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $this->found = $result->num_rows;
                $sql = "UPDATE `tb_timeline` SET status='0' WHERE timeline_id = '{$row['timeline_id']}'";
                $conn->query($sql);
            }
        }
        $sql = "DELETE FROM tb_riskarea WHERE riskarea_id = $id";
        $result = $conn->query($sql);
        if ($result) {
            $this->msg = "success";
        }
        return json_encode($this);
    }

    public function getAll($conn){
        $sql = "SELECT tb_riskarea.*,tb_admin.admin_id,tb_admin.admin_username,tb_admin.admin_fullname FROM tb_riskarea INNER JOIN tb_admin ON tb_admin.admin_id = tb_riskarea.admin_id ORDER BY tb_riskarea.riskarea_id DESC";
        $result = $conn->query($sql);
        $res = array();
        $res['msg'] = 'error';
        if($result->num_rows >= 0){
            $res['msg'] = 'success';
            $arr = array();
            while ($row = $result->fetch_assoc()){
                $arr[] = $row;
            }
            $res['data'] = $arr;
        }

        return json_encode($res);
    }

    public function add($id, $name, $lat, $long, $startDate, $endDate, $admin_id, $conn)
    {
        $sql = "INSERT INTO `tb_riskarea` (riskarea_name,placeID,latitude,longtitude,startDate,endDate,admin_id) VALUES('$name','$id','$lat','$long','$startDate','$endDate','$admin_id')";
        $result = $conn->query($sql);
        if ($result) {
            $this->msg = "success";
            $this->found = 0;
            $this->checkRisk($conn, $lat, $long, $startDate, $endDate);
        }
        return json_encode($this);

    }

    public function checkRisk($conn, $lat, $long, $startDate, $endDate)
    {
//        $curl = curl_init();
//
//        curl_setopt_array($curl, array(
//            CURLOPT_URL => "https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=$lat,$long&radius=1500&key=AIzaSyCXzEl_l-8_eE-tK1W4KQ3wiKT1OoOGq-E",
//            CURLOPT_RETURNTRANSFER => true,
//            CURLOPT_ENCODING => '',
//            CURLOPT_MAXREDIRS => 10,
//            CURLOPT_TIMEOUT => 0,
//            CURLOPT_FOLLOWLOCATION => true,
//            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//            CURLOPT_CUSTOMREQUEST => 'GET',
//        ));
//
//        $response = curl_exec($curl);
//
//        curl_close($curl);
//        $res = json_decode($response);
        $sql = "SELECT tb_timeline.timeline_id FROM tb_timeline
INNER JOIN tb_riskarea ON tb_riskarea.placeID = tb_timeline.place_id
WHERE tb_timeline.status = 0 and tb_timeline.time_checkin BETWEEN tb_riskarea.startDate and tb_riskarea.endDate";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $this->found = $result->num_rows;
                $sql = "UPDATE `tb_timeline` SET status='1' WHERE timeline_id = '{$row['timeline_id']}'";
                $conn->query($sql);

            }
        }
    }
}