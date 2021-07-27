<?php


class UserLogin
{
    public $userID;
    public $status;
    public $msg;

    public function __construct()
    {
        $this->userID = null;
        $this->status = null;
        $this->msg = "error";
    }

    public function mapResponse(){
        return json_encode($this);
    }
}