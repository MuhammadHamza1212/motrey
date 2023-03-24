<?php

include 'config.php';
include 'models/userService.php';

$userName = $_GET["name"];
$email = $_GET["email"];
$userNameStatus;
$userEmailStatus;
$userService = new UserService(); 
if($userName == ""){
    $userNameStatus = "Empty";
}
else{
    $userName = $userService->getUserByUserName($userName);
    if($userName === NULL){
        $userNameStatus = "Available";
    }
    else{
        $userNameStatus = "Not Available";
    }    
}

if($email == ""){
    $userEmailStatus = "Empty";
}
else{
    $userEmail = $userService->getUserByEmail($email);
    if($userEmail === NULL){
        $userEmailStatus = "Available";
    }
    else{
        $userEmailStatus = "Not Available";
    }    
}

echo $userNameStatus .','. $userEmailStatus;

?>