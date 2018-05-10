<?php
    const DB   = "langapp";
    const USER = "root";
    const PASS = "";
    const HOST = "localhost";

class DB_Handler{

    var $con;


    function __construct()
    {
        $this->con = mysqli_connect(HOST,USER,PASS,DB);
        mysqli_set_charset($this->con,"utf8");
    }

    public function connect()
    {
        if($this->con){
            return $this->con;
        }else{
            return false;
        }
    }

    public function query($SQL_Query)
    {
        $qu=mysqli_query($this->con,$SQL_Query);
        if($qu){
            $result['stat']=true;
            $result['result']=$qu;
        }else{
            $result['stat']=false;
            $result['result']=mysqli_error($this->con);
        }
        return $result;
    }
}