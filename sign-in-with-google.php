<?php

include 'config.php';
include 'models/userService.php';
include 'models/user_rolesService.php';
include 'models/user_profileService.php';

$token = $_GET["credentials"];
$token_parts = explode('.', $token);
$token_payload = base64_decode($token_parts[1]);
$payload = json_decode($token_payload);

$email = $payload->email;
$userService = new UserService();
$user = $userService->getUserByEmail($email);
if($user === NULL){
    
    // signup with google account
    $createdAt = date('y-m-d h:i:s');
    $updatedAt = date('y-m-d h:i:s');
    $status = 'Active';
    
    $user = new User(); 
    $user->setEmail($email);
    $user->setUsername($email);
    $user->setCreated_at($createdAt);
    $user->setUpdated_at($updatedAt);
    $user->setStatus($status);
    $user->setGoogle_account(true);
    
    //call userService class function to add all values in users table.
    $userService->addUser($user);
    
    //after adding user record in table, here we get the assigning automatic id to user row.
    $user = $userService->getUserByEmail($email);
    $recentUserId = $user->getUser_id();
    
    //we set demanding values in userRoles object.
    $userRoles = new UserRoles();
    $userRoles->setUser_id($recentUserId);
    $userRoles->setRole_id(1);
    $userRoles->setCreated_at($createdAt);

    //call the function to add values in database of user_roles table.
    $userRolesService = new UserRolesService();
    $userRolesService->addUserRoles($userRoles);

    //add UserId in userprofile table.
    $userProfile = new UserProfile();
    $userProfileService = new UserProfileService();
    $userProfile->setUser_id($recentUserId);
    $userProfileService->addUserProfile($userProfile);
    
    session_start();
	$_SESSION["userId"] = $user->getUser_id();
	$_SESSION["username"] = $user->getUsername();
	
	echo "signup";

}
else {
    if($user->getGoogle_account()) {
        session_start();
    	$_SESSION["userId"] = $user->getUser_id();
    	$_SESSION["username"] = $user->getUsername();
        echo "signin";
    }
    else {
        echo "A user with current Email Address already exists";
    }
}
?>