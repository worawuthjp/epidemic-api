<?php


class Timeline
{

    public $places;
    public $msg;
    public $searchDate;

    public function __construct()
    {
        $this->places = [];
        $this->msg = "Not Found";
        $this->searchDate = null;
    }

    /**
     * @param null $searchDate
     */
    public function setSearchDate($searchDate)
    {
        $this->searchDate = $searchDate;
    }

    public function fecth($url){
        $ch = curl_init();

        // set url
        curl_setopt($ch, CURLOPT_URL, $url);

        //return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // $output contains the output string
        $output = curl_exec($ch);

        // close curl resource to free up system resources
        curl_close($ch);
        return $output;
    }

    public function mapResponse($id,$date = null,$conn){
        $str = $date? "and DATE(tb_timeline.time_checkin) = '$date'" : '';
        $sql = "SELECT * FROM `tb_timeline` WHERE tb_timeline.user_studentID = '$id' $str ";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            $this->places = [];
            while ($row = $result->fetch_assoc()){
                $obj = array();
                $obj['lat'] = $row['latitude'];
                $obj['long'] = $row['longtitude'];
                array_push($this->places,$obj);
            }

            $this->msg = "success";
            $this->searchDate = $date;
        }else{
            $this->msg = "error";
        }

        return json_encode($this);
    }
}