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
        $this->con = mysqli_connect(HOST,USER,PASS,DB);
        mysqli_set_charset($this->con,"utf8");
        if($this->con){
            return $this->con;
        }else{
            return false;
        }
    }

    public function query($SQL_Query,$Keep = false)
    {
        $qu=mysqli_query($this->con,$SQL_Query);
        if($qu){
            $result['stat']=true;
            $result['func'] =__CLASS__.":".__FUNCTION__;
            $result['result']=$qu;
        }else{
            $result['stat']=false;
            $result['func'] =__CLASS__.":".__FUNCTION__;
            $result['result']=mysqli_error($this->con);
        }
        !$Keep? mysqli_close($this->con): "" ;
        return $result;
    }
}