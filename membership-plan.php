<?php include 'google-translate-api-object.php'; ?>
<!doctype html>
<html lang="<?php echo $currentLanguageIsoCode; ?>" dir="<?php echo $currentLanguageDirection; ?>">
  <head>
    <?php include 'head.php'; ?>
  </head>
  <body>
    
	<div class="py-2 text-center border-bottom">
		<img src="resources/images/logo-light.jpeg" width="130" height="auto"/>
	</div>
	
	<?php
	include 'config.php';
	include 'models/countryService.php';
	include 'models/roleService.php';
	include 'models/user_rolesService.php';
	include 'models/membership_plansService.php';
	include 'models/userService.php';
	include 'resources/includes/labels.php';

	use GeoIp2\Database\Reader;
	
	$countryService = new CountryService();
	
	session_start();
	
	$currentCountryIsoCode = "";
	$supportedCountry = false;
	if (isset($_COOKIE["currentCountryIsoCode"])) {
		$currentCountryIsoCode = $_COOKIE["currentCountryIsoCode"];
	} else {
		try {
			$reader = new Reader('vendor/maxmind-db/GeoLite2-Country_20230207/GeoLite2-Country.mmdb');
			$visitorIpAddress = $_SERVER['REMOTE_ADDR'];
			$currentCountryIsoCode = $reader->country($visitorIpAddress)->country->isoCode;
			$countries = $countryService->getAllCountries($currentLanguageIsoCode);
			foreach ($countries as $country) { 
				if($country->getIso_code() == $currentCountryIsoCode) {
					$supportedCountry = true;
				}
			}
		}
		catch (GeoIp2\Exception\AddressNotFoundException $e) {
			$currentCountryIsoCode = "AE";
		}
		if($supportedCountry == false) {
			$currentCountryIsoCode = "AE";
		}
	}			
	
	// Check if the form was submitted
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		// Store the form data in a session variable
		$_SESSION["form_data"] = $_POST;
		
		// uploading images and adding their path in session
		$targetDir = "data/temp/"; 
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
						$_SESSION["form_images_paths"][$key] = $fileName;
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
		
		if($errorUploadType !== '')
			echo $errorUploadType;

	}
	
	$countryService = new CountryService();
	$currentCountry = $countryService->getCountryByIsoCode($currentCountryIsoCode, $currentLanguageIsoCode);
	
	echo "<script>
		var body = document.body;

		// Loop through all child nodes of the body
		for (var i = 0; i < body.childNodes.length; i++) {
		  var node = body.childNodes[i];
		  if (node.nodeType === Node.TEXT_NODE || node.tagName === 'B' || node.tagName === 'BR') {
				if(node.tagName == 'NAV')
					break;
				node.remove(); i--;
		  }
		}
	</script>";
	
	include 'views/select-membership-plan.php';
		
	?>
  </body>
</html>