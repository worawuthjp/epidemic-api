<?php


class UserLogin
{
    public $userID;
    public $status;
    public $msg;
    public $errMsg;

    public function __construct()
    {
        $this->userID = null;
        $this->status = null;
        $this->msg = "error";
        $this->errMsg = "";
    }

    public function mapResponse(){
        return json_encode($this);
    }
}