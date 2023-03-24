<?php
session_start();
include 'config.php';
include 'models/adService.php';
include 'models/ads_imagesService.php';
include 'models/category_attributes_valuesService.php';
include 'models/ads_analyticService.php';
include 'models/ads_moderationService.php';
include 'models/userService.php';
include 'models/membership_plansService.php';
include 'models/cityService.php';

$ad = new Ad(); 
$adService = new AdService(); 
$adImage = new AdsImages(); 
$adImagesService = new AdsImagesService();
$categoryAttributesValues = new CategoryAttributesValues(); 
$categoryAttributesValuesService = new CategoryAttributesValuesService();
$adAnalytic = new AdsAnalytic();
$adAnalyticService = new AdsAnalyticService();
$adModeration = new AdsModeration();
$adModerationService = new AdsModerationService();
$user = new User();
$userService = new UserService();
$membershipPlan = new MembershipPlan();
$membershipPlanService = new MembershipPlanService();
$cityService = new CityService();
 
if (isset($_SESSION["form_data"]) && isset($_GET["category_id"])) {
	
	// Retrieve the form data from the session
	$_POST = $_SESSION["form_data"];
	unset($_SESSION["form_data"]);
}

if (isset($_GET["plan_id"])) {
	$user = $userService->getUserById($_SESSION["userId"]);
	$user->setMembership_plan_id($_GET["plan_id"]);
	$userService->updateUserById($user);
}

//getting static elements' values from form.
$category_id = $_GET["category_id"];
$category_id_sal = $_GET["category_id_sal"];
$user_id = $_SESSION["userId"];
$title = $_POST["title"];
$phoneNumber = $_POST["phonenumber"];
$dialingCode = $_POST["dialingCode"];
$completeNumber = $dialingCode . $phoneNumber;
$price = $_POST["price"];
$description = $_POST["description"];
$latitude = $_POST["latitude"];
$longitude = $_POST["longitude"];
$source_location_coordinates = $latitude .','. $longitude;
$posted_at = date('y-m-d h:i:s');
$status = 'Under_Review';
$address = $_POST["address"];
$city_id = $_POST["city-id"];
$city = $cityService->getCityByCityId($city_id);
$city_id_sal = $city->getCity_id_sal();
$country = $_POST["country-id"];
$country_id_sal = $_POST["country-id-sal"];

//updating user phone number
$user = $userService->getUserById($user_id);
$user->setPhone($completeNumber);
$userService->updateUserById($user);

// adding static attributes values in ads table
$ad->setUser_id($user_id);
$ad->setCategory_id($category_id);
$ad->setCategory_id_sal($category_id_sal);
$ad->setTitle($title);
$ad->setDescription($description);
$ad->setPrice($price);
$ad->setSource_location_coordinates($source_location_coordinates);
$ad->setPosted_at($posted_at);
$ad->setStatus($status);

$user = $userService->getUserById($_SESSION["userId"]);
$membershipPlan = $membershipPlanService->getMembershipPlanByPlanId($user->getMembership_plan_id());
if($membershipPlan->getPlan_name() == "Premium") {
	$ad->setAd_type("Featured");
}
else {
	$ad->setAd_type("Basic");
}

$ad->setSource_location_address($address);
$ad->setSource_city_id($city_id);
$ad->setSource_city_id_sal($city_id_sal);
$ad->setSource_country_id($country);
$ad->setSource_country_id_sal($country_id_sal);
$adService->addAd($ad);

$lastAd = $adService->getLastAd();
$ad_id = $lastAd->getAd_id();

// uploading images and adding their path in ads_image table
if(isset($_SESSION["form_images_paths"])) {
	foreach($_SESSION['form_images_paths'] as $key=>$val){
		$old_path = "data/temp/" . $val;
		$new_path = "data/images/" . $val;

		if (rename($old_path, $new_path)) {
			$adImage->setAd_id($ad_id);
			$adImage->setImage_path($new_path);
			$adImage->setCreated_at($posted_at);
			$adImagesService->addAdImage($adImage);
		} else {
			echo "File move failed.";
		}
	}		
}
else {
	$targetDir = "data/images/"; 
	$allowTypes = array('jpg','png','jpeg','gif', 'JPG'); 
	$statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = '';

	$fileNames = array_filter($_FILES['images']['name']);
	if(!empty($fileNames)){ 
		foreach($_FILES['images']['name'] as $key=>$val){ 
			// File upload path 
			$fileName = basename($_FILES['images']['name'][$key]); 
			$targetFilePath = $targetDir . $fileName; 
		
			// Check whether file type is valid 
			$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
			if(in_array($fileType, $allowTypes)){
				
				// Upload file to server
				if(move_uploaded_file($_FILES["images"]["tmp_name"][$key], $targetFilePath)){ 
					$adImage->setAd_id($ad_id);
					$adImage->setImage_path($targetFilePath);
					$adImage->setCreated_at($posted_at);
					$adImagesService->addAdImage($adImage);
				}else{ 
					$errorUpload .= $_FILES['images']['name'][$key].' | '; 
				} 
			}else{ 
				$errorUploadType .= $_FILES['images']['name'][$key].' | '; 
			} 
		} 
		// Error message 
		$errorUpload = !empty($errorUpload)?'Upload Error: '.trim($errorUpload, ' | '):''; 
		$errorUploadType = !empty($errorUploadType)?'File Type Error: '.trim($errorUploadType, ' | '):''; 
		$errorMsg = !empty($errorUpload)?'<br/>'.$errorUpload.'<br/>'.$errorUploadType:'<br/>'.$errorUploadType;    
	} else{ 
		$statusMsg = 'Please select a file to upload.'; 
	}

	if($errorUpload !== '')
		echo $errorUpload;
}


// adding dynamic attributes values in category_attributes_values table
$staticAttributes = array('title', 'images', 'dialingCode', 'phonenumber', 'price', 'description', 'latitude', 'longitude');
foreach ($_POST as $key => $value) {
   if(in_array($key, $staticAttributes) == false) {
	   $categoryAttributesValues->setAttribute_id($key);
	   $categoryAttributesValues->setAd_id($ad_id);
	   $categoryAttributesValues->setValue($value);
	   $categoryAttributesValuesService->addCategoryAttributesValues($categoryAttributesValues);
   }
}

// adding row in ads_analytic table
$adAnalytic->setAd_id($ad_id);
$adAnalytic->setViews(0);
$adAnalytic->setClicks(0);
$adAnalyticService->addAdsAnalytic($adAnalytic);

// adding row in ads_moderation table
$adModeration->setAd_id($ad_id);
$adModeration->setStatus($status);
$adModeration->setModerated_at(date('y-m-d h:i:s'));
$adModeration->setModerated_by(0);
$adModerationService->addAdsModeration($adModeration);

header('Location: index.php');
?>