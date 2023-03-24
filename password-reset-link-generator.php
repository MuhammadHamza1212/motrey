<?php

include 'config.php';
include 'models/userService.php';
include 'models/users_securityService.php';

$email = $_POST["email"];
$userService = new UserService(); 

$user = $userService->getUserByEmail($email);
if($user === NULL){
	echo "email not valid";
}
else{
	// Generate a unique token
	$token = bin2hex(openssl_random_pseudo_bytes(16));

	// Store the token in the database along with the user's email address or username and a timestamp
	$userSecurityService = new UserSecurityService();
	$userSecurity = $userSecurityService->getUsersSecurityById($user->getUser_id());
	$userSecurity->setToken($token);
	$userSecurity->setToken_expiration_time(date('y-m-d h:i:s'));
	$userSecurityService->updateUsersSecurityById($userSecurity);
	
	// Build the password reset link
	$link = "https://motarey.com/reset-password.php?token=" . $token;

	// Send the password reset link via email
	$to = $email;
	$subject = "Motarey Password Reset";
	$message = "Please click on the following link to reset your password: " . $link;
	$headers = "From: webmaster@motarey.com";

	mail($to, $subject, $message, $headers);
	
	echo 'link sent';
} 

?>
