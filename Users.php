<?php
/**
 * Created by PhpStorm.
 * User: pejman
 * Date: 5/12/18
 * Time: 2:14 PM
 */
include_once "./includes/connection.php";
class Users
{
    public static function UserStat($UserId){
        $con = new DB_Handler();
        $UserStatQuery = $con->query("SELECT users.*, true_quest,false_quest,last_quest FROM users JOIN user_status on user_status.uid=users.id WHERE user_status.uid = '".$UserId."'");
        if($UserStatQuery['stat']){
            $userStat = mysqli_fetch_assoc($UserStatQuery['result']);
            $result = [
                'stat'=>true,
                'func'=>__CLASS__.":".__FUNCTION__,
                'result' => $userStat
            ];
        }else{
            $result = [
                'stat'=>true,
                'func'=>__CLASS__.":".__FUNCTION__,
                'result' => $UserStatQuery['result']
            ];
        }
        return $result;
    }

    public static function AddPoint($UserID,$QuestionId,$Type=true){
        $con = new DB_Handler();
        if($Type){
            $query = $con->query("Update user_status set true_quest = true_quest+1,last_quest = $QuestionId where uid = '".$UserID."'");
        }else{
            $query = $con->query("Update user_status set false_quest = false_quest+1, last_quest = $QuestionId where uid = '".$UserID."'");
        }
        if($query['stat']){
            $result = [
                'stat'=>true,
                'func'=>__CLASS__.":".__FUNCTION__,
                'result'=>true
            ];
        }else{
            $result = [
                'stat'=>false,
                'func'=>__CLASS__.":".__FUNCTION__,
                'result'=>$query['result']
            ];
        }
        return $result;
    }

}