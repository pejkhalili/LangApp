<?php
include_once "auth.php";

$new = new auth();

$newUser = $new->register(9151000960);

if($newUser['stat']){
    $token = $newUser['token'];
    echo "\n";
    echo json_encode($new->check(9151000960,$token));
    echo "\n";
}

