<?php

include 'config.php';
include 'models/user_profileService.php';

session_start();

$firstName = $_POST['first-name'];
$lastName = $_POST['last-name'];
$dobDay = $_POST['dob-day'];
$dobMonth = $_POST['dob-month'];
$dobYear = $_POST['dob-year'];
$address = $_POST['address'];
$imagePath = "";

if(isset($_FILES["profile-image"]["name"])){
  $target_dir = "data/profile-images/";
  $target_file = $target_dir . basename($_FILES["profile-image"]["name"]);
  move_uploaded_file($_FILES["profile-image"]["tmp_name"], $target_file);
  // Get the URL of the uploaded image
  $imagePath = $target_file;
}

// Add a leading zero to the month if it is a single digit
if (strlen($dobMonth) == 1) {
  $dobMonth = '0' . $dobMonth;
}

// Combine the day, month, and year into a single string in the format 'YYYY-MM-DD'
$date_string = sprintf('%s-%s-%s', $dobYear, $dobMonth, $dobDay);

// Convert the date string to a UNIX timestamp using strtotime()
$timestamp = strtotime($date_string);

// Convert the timestamp to a MySQL-compatible date format using date()
$date_mysql = date('Y-m-d', $timestamp);

$userProfile = new UserProfile();
$userProfile->setUser_id($_SESSION['userId']);
$userProfile->setFirst_name($firstName);
$userProfile->setLast_name($lastName);
$userProfile->setProfile_picture($imagePath);
$userProfile->setAddress($address);
$userProfile->setBirth_date($date_mysql);
$userProfile->setUpdated_at(date('y-m-d h:i:s'));
$userProfile->setUpdated_by($_SESSION['userId']);

$userProfileService = new UserProfileService();
$userProfileService->updateUsersProfileById($userProfile);

header('Location: my-profile.php');
?>