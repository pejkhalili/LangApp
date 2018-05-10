<?php

include ("./includes/connection.php");

class auth{

    public function check($UserID,$TOKEN){
        //check db to get id's token and check if it match
        $con= new DB_Handler();
        $userId = $UserID;
        $token  = $TOKEN;
        $query = $con->query("SELECT token FROM users WHERE id = $userId");

        if($query['stat'] == true ){
            $db_token = mysqli_fetch_assoc($query['result']);
            if($token == $db_token['token']){
                $result['stat'] = true;
                $result['register']=true;
            }else{
                $result['stat'] = true;
                $result['register']=false;
            }
        }else{
            $result['stat'] = false;
            $result['error'] = $query['result'];
        }
        return $result;
    }

    public function register($UserID){
        $userId =$UserID;
        $con = new DB_Handler();
        $token = md5($userId+time());
        $query = $con->query("INSERT INTO users(id,phone,token) VALUE ($userId,'$userId','$token')");
        if($query['stat']){
            $result['stat'] = true;
            $result['token']=$token;
        }else{
            $result['stat'] = false;

        }
        return $result;

    }
}