<?php


class User
{
    public $msg = 'error';
    public $data;
    public function getUser($conn,$id){
        $sql = "SELECT * FROM tb_usernew WHERE user_studentID ='$id'";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            $this->msg = 'success';
        }

        return json_encode($this);
    }
}