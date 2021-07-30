<?php


class Status
{
    public $msg = 'error';
    public $data;

    public function getAll($conn)
    {
        $sql = "SELECT * FROM tb_status";
        $result = $conn->query($sql);
        $arr = array();
        if ($result->num_rows > 0) {
            $this->msg = "success";
            while ($row = $result->fetch_assoc()) {
                $arr[] = $row;
            }
            $this->data = $arr;
        }
        return json_encode($this);
    }
}