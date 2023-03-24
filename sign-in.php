<?php

include 'config.php';
include 'models/userService.php';
include 'models/users_securityService.php';

$userService = new UserService(); 
$userSecurityService = new UserSecurityService();

//get element values from form.
$email = $_POST["email"];
$password = $_POST["password"];

//call userService class function to add all values in users table.
$user = $userService->getUserByEmail($email);
if($user !== null){
    $userId = $user->getUser_id();
    $userSecurity = $userSecurityService->getUsersSecurityById($userId);
    $passwordHash = $userSecurity->getPassword_hash();
    $verify = password_verify($password, $passwordHash);
    if($verify){
		session_start();
		$_SESSION["userId"] = $userId;
		$_SESSION["username"] = $user->getUsername();
    } 
    else{
        echo "wrong";
    }
}

else {
    echo "wrong";
}
?>