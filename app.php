<?php
include_once "auth.php";
include_once "Quest.php";
include_once "./includes/Styler.php";
include_once "Users.php";
//$new = new auth();
//
//$newUser = $new->register(9151000960);
//echo json_encode($newUser)."\n";
//if($newUser['stat']){
//    $token = $newUser['token'];
//    echo "\n";
//    echo json_encode($new->check(9151000960,$token));
//    echo "\n";
////}

//Styler::API_RESP($qu->getLastQuest());
////Styler::API_RESP($qu->RightAns(1));
////Styler::API_RESP($qu->WrongAns(1));
////Styler::API_RESP($qu->WrongAns(1));
//Styler::API_RESP($qu->getMissedQuests());
//echo json_encode($qu=new Quest(9151000960),JSON_PRETTY_PRINT);
//
//echo  json_encode($qu->getLastQuest(),JSON_PRETTY_PRINT)."\n";
$qu = new Quest(9151000960);
Styler::API_RESP(Users::UserStat(9151000960));

Styler::API_RESP($qu->WrongAns(1));
Styler::API_RESP($qu->WrongAns(2));
Styler::API_RESP($qu->WrongAns(3));

Styler::API_RESP($qu->getMissedQuests());
Styler::API_RESP($qu->getLastQuest());

Styler::API_RESP(Users::UserStat(9151000960));


