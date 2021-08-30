<?php


class RiskArea
{
    public $msg;
    public $found;

    public function __construct()
    {

        $this->msg = "error";
    }

    public function edit($id,$placeID, $placeName, $lat, $long, $startDate, $endDate,$statusID,$epidemic_id, $conn){
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
        $sql = "UPDATE tb_riskarea SET riskarea_name='$placeName',placeID='$placeID',latitude='$lat',longtitude='$long',startDate='$startDate',endDate='$endDate',status_id = '$statusID',epidemic_id='$epidemic_id' WHERE riskarea_id = $id";
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

    public function getAll($conn,$id){
        $this->delete_riskarea_expire($conn);
        $sql = "SELECT tb_riskarea.*,tb_admin.admin_id,tb_admin.admin_username,tb_admin.admin_fullname,tb_status.status_id,tb_status.status_name FROM tb_riskarea INNER JOIN tb_admin ON tb_admin.admin_id = tb_riskarea.admin_id INNER JOIN tb_status ON tb_status.status_id = tb_riskarea.status_id ORDER BY tb_riskarea.riskarea_id DESC";
        if($id){
            $sql = "SELECT tb_riskarea.*,tb_admin.admin_id,tb_admin.admin_username,tb_admin.admin_fullname,tb_status.status_id,tb_status.status_name FROM tb_riskarea INNER JOIN tb_admin ON tb_admin.admin_id = tb_riskarea.admin_id INNER JOIN tb_status ON tb_status.status_id = tb_riskarea.status_id WHERE tb_riskarea.riskarea_id = $id ORDER BY tb_riskarea.riskarea_id DESC";
        }
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

    public function add($id, $name, $lat, $long, $startDate, $endDate, $admin_id,$status_id,$epidemic_id, $conn)
    {
        $sql = "INSERT INTO `tb_riskarea` (riskarea_name,placeID,latitude,longtitude,startDate,endDate,admin_id,status_id,epidemic_id) 
VALUES('$name','$id','$lat','$long','$startDate','$endDate','$admin_id','$status_id','$epidemic_id')";
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
        $this->delete_riskarea_expire($conn);
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

    public function delete_riskarea_expire($conn){
        $now = date('Y-m-d');
        $sql = "SELECT tb_riskarea.* FROM tb_riskarea WHERE DATEDIFF('$now',tb_riskarea.endDate) > 14";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            while ($row = $result->fetch_assoc()){
                $query = "DELETE FROM tb_riskarea WHERE riskarea_id = '{$row['riskarea_id']}'";
                $conn->query($query);
            }
        }
    }
}