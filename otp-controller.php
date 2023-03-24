<?php
session_start();
error_reporting(E_ALL & ~ E_NOTICE);

require ('resources/includes/textlocal.class.php');

switch ($_GET["action"]) {
    case "send_otp":
        $mobile_number = $_GET['phoneNumber'];
        
        $apiKey = urlencode('NDk2ZjQ0Mzg2ZDYzNTg0MTRhNDY2YzRkNmI3ODU3NjY=');
        $Textlocal = new Textlocal(false, false, $apiKey);
        
        $numbers = array(
            $mobile_number
        );
        $sender = 'P Valley';
        $otp = rand(100000, 999999);
        $_SESSION['session_otp'] = $otp;
        $message = "Your One Time Password is " . $otp;
        try{
            //$response = $Textlocal->sendSms($numbers, $message, $sender);
            //var_dump($response); 
            //echo $mobile_number;
            echo "Message Sent<br>" . $message;
            exit();
        }catch(Exception $e){
            die('Error: '.$e->getMessage());
        }
        break;
        
    case "verify_otp":
        $otp = $_GET['mobileOtp'];
        
        if ($otp == $_SESSION['session_otp']) {
            unset($_SESSION['session_otp']);
            echo "Success";
        } else {
            echo "Error";
        }
        break;
}
    
?>