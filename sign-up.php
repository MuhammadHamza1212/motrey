<?php

include 'config.php';
include 'models/userService.php';
include 'models/users_securityService.php';
include 'models/user_rolesService.php';
include 'models/roleService.php';
include 'models/user_profileService.php';

$user = new User(); 
$userService = new UserService(); 
$userSecurity = new UserSecurity(); 
$userSecurityService = new UserSecurityService();
$userRoles = new UserRoles();
$userRolesService = new UserRolesService();
$role = new Role();  
$roleService = new RoleService();
$userProfile = new UserProfile();
$userProfileService = new UserProfileService();

//get element values from form.
$userName = $_POST["username"];
$email = $_POST["email"];

$contents = file_get_contents('https://motarey.com/validate-username-email.php?name=' . $userName . '&email=' . $email);
$arr = explode (",", $contents);
$userNameStatus = $arr[0];
$emailStatus = $arr[1];

if($userNameStatus == 'Available' && $emailStatus == 'Available'){
    $phoneNumber = $_POST["phonenumber"];
    $dialingCode = $_POST["dialingCode"];
    $completeNumber = $dialingCode . $phoneNumber;
    $password = $_POST["password"];
    $sellerType = $_POST["sellerType"];
    $createdAt = date('y-m-d h:i:s');
    $updatedAt = date('y-m-d h:i:s');
    $status = 'Active';
    
    //set these values in user object.
    $user->setUsername($userName);
    $user->setEmail($email);
    $user->setPhone($completeNumber);
    $user->setCreated_at($createdAt);
    $user->setUpdated_at($updatedAt);
    $user->setStatus($status);

    //call userService class function to add all values in users table.
    $userService->addUser($user);

    //after adding user record in table, here we get the assigning automatic id to user row.
    $userObject = $userService->getUserByUserName($userName);
    $recentUserId = $userObject->getUser_id();

    //here we make salt for making the strong password.
    $salt = array('cost' => 9);

    //here we make password in hash.
    $password_hash = password_hash($password, PASSWORD_DEFAULT, $salt);

    //here we set demanding values in userSecurity object.
    $userSecurity->setUser_id($recentUserId);
    $userSecurity->setPassword_hash($password_hash);
    $userSecurity->setSalt($salt);

    //here call the addUserSecurity function to add the all values from userSecurity object in database.
    $userSecurityService->addUserSecurity($userSecurity);

    //here we get role_id.
    $roleServiceObject = $roleService->getRoleByName($sellerType);
    $role_id = $roleServiceObject->getRole_id();

    //we set demanding values in userRoles object.
    $userRoles->setUser_id($recentUserId);
    $userRoles->setRole_id($role_id);
    $userRoles->setCreated_at($createdAt);

    //call the function to add values in database of user_roles table.
    $userRolesService->addUserRoles($userRoles);

    //add UserId in userprofile table.
    $userProfile->setUser_id($recentUserId);
    $userProfileService->addUserProfile($userProfile);

    /* echo password_verify($password,
            $password_hash ) . "<br>";
     */
    echo "right";
}
else{
    echo "wrong";
}
?>