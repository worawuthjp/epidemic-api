<?php


class Checkout
{
    public $id;

    public function __construct()
    {
        $this->id = null;
    }

    public function checkout($id,$conn){
        $this->id = $id;
        $res = array();
        $res['msg'] = "error";
        $res['statusCode'] = 400;
        $row = $this->getLastest($id,$conn);
        $date = date('Y-m-d H:i:s');
        $sql = "UPDATE tb_timeline SET time_checkout = '$date' WHERE timeline_id = '{$row['timeline_id']}' ";
        $result = $conn->query($sql);
        if($result){
            $res['msg'] = "success";
            $res['statusCode'] = 200;
            return json_encode($res);
        }
        return json_encode($res);
    }

    public function getLastest($id,$conn){
        $sql = "SELECT * FROM tb_timeline WHERE user_studentID = '$id' ORDER BY time_checkin DESC LIMIT 1";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            return $result->fetch_assoc();
        }
        return null;
    }
}