<?php
/**
 * Created by PhpStorm.
 * User: pejman
 * Date: 5/12/18
 * Time: 11:25 AM
 */
include_once "./includes/connection.php";
include_once "Users.php";
class Quest
{
    private $question=1;
    private $userid;
     public function __construct($UserId)
     {
        $this->userid = $UserId;
        $con = new DB_Handler();
        $getUserStatQuery = $con->query("SELECT * FROM user_status WHERE id = '".$this->userid."'");
        if($getUserStatQuery['stat']){
            $userStat = mysqli_fetch_assoc($getUserStatQuery['result']);
            $this->question = $userStat['last_quest'];
            $result=['stat'=>true,'func'=>__CLASS__.":".__FUNCTION__,'result'=>true];
        }else{
            $result=['stat'=>false,'func'=>__CLASS__.":".__FUNCTION__,'result'=>$getUserStatQuery['result'] ];
        }
        return $result;

     }

     public function getQuestionId(){
         return $this->question;
     }

     public function getLastQuest(){
         $con = new DB_Handler();
         $getLastQuestQuery = $con->query("SELECT * FROM questions where id = ".$this->question);
         if($getLastQuestQuery['stat']){
             $loadedQuest = mysqli_fetch_assoc($getLastQuestQuery['result']);
             $result = ['stat'=>true,
                        'func'=>__CLASS__.":".__FUNCTION__,
                        'result'=>$loadedQuest
                        ];
         }else{
             $result = ['stat'=>true,
                 'func'=>__CLASS__.":".__FUNCTION__,
                 'result'=>$getLastQuestQuery['result']
             ];
         }
         return $result;
     }

     public function getMissedQuests(){
         $con = new DB_Handler();
         $getMissedQuestQuery = $con->query("SELECT count(qid) as qCount,id,qid FROM answers WHERE stat = 'f' and uid = '".$this->userid."'",true);
         if($getMissedQuestQuery['stat']){
             $result['stat']=true;
             $result['func'] =__CLASS__.":".__FUNCTION__;
             $lastQi='';
             while ($row = mysqli_fetch_assoc($getMissedQuestQuery['result'])){
                 if($lastQi!=$row['qid']){
                     $lastQi=$row['qid'];
                     $getMisQeQuery = $con->query("SELECT * FROM questions WHERE id='".$row['qid']."'");
                     if($getMisQeQuery['stat']){
                         while($que=mysqli_fetch_assoc($getMisQeQuery['result'])){
                             $que['count']=$row['qCount'];
                             $result['result'][$row['id']]=$que;

                         }
                     }else {
                         $result['stat'] = false;
                         $result['func'] =__CLASS__.":".__FUNCTION__;
                         $result['result'] = $getMissedQuestQuery['result'];
                     }
                 }
             }
         }else{
             $result['stat']=false;
             $result['func'] =__CLASS__.":".__FUNCTION__;
             $result['result']=$getMissedQuestQuery['result'];
         }
         return $result;
     }

     public function RightAns($QuestionId){
         $con = new DB_Handler();
         $insertQuery = $con->query("insert into answers(uid,qid) VALUE ('".$this->userid."' , $QuestionId)");
        if($insertQuery['stat']){
            Users::AddPoint($this->userid,$QuestionId);
            $result=['stat'=>true,'func'=>__CLASS__.":".__FUNCTION__,'result'=>true];
        }else{
            $result = ['stat'=>false,'result'=>$insertQuery['result']];
        }

        return $result;
     }

    public function WrongAns($QuestionId){
        $con = new DB_Handler();
        $insertQuery = $con->query("insert into answers(uid,qid,stat) VALUE ('".$this->userid."' , $QuestionId, 'f')");
        Users::AddPoint($this->userid,$QuestionId,false);
        if($insertQuery['stat']){
            $result=['stat'=>true,'func'=>__CLASS__.":".__FUNCTION__,'result'=>true];
        }else{
            $result = ['stat'=>false,'func'=>__CLASS__.":".__FUNCTION__,'result'=>$insertQuery['result']];
        }

        return $result;
    }
}