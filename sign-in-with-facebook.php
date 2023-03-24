<?php

include 'config.php';
include 'models/userService.php';
include 'models/user_rolesService.php';
include 'models/user_profileService.php';

$name = $_POST["name"];
$fb_id = $_POST["fb_id"];

$userService = new UserService();
$user = $userService->getUserByFacebookId($fb_id);
if($user === NULL){
    
    // signup with google account
    $createdAt = date('y-m-d h:i:s');
    $updatedAt = date('y-m-d h:i:s');
    $status = 'Active';
    
    $user = new User(); 
    $user->setUsername($name);
    $user->setCreated_at($createdAt);
    $user->setUpdated_at($updatedAt);
    $user->setStatus($status);
    $user->setFacebook_account(true);
    $user->setFacebook_id($fb_id);
    
    //call userService class function to add all values in users table.
    $userService->addUser($user);
    
    //after adding user record in table, here we get the assigning automatic id to user row.
    $user = $userService->getUserByFacebookId($fb_id);
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
    if($user->getFacebook_account()) {
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