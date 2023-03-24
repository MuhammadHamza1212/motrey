<?php
include 'config.php';
include 'models/users_securityService.php';

$userId = $_POST['user-id'];
$password = $_POST['password'];
$userSecurityService = new UserSecurityService();
$userSecurity = $userSecurityService->getUsersSecurityById($userId);

//here we make salt for making the strong password.
$salt = array('cost' => 9);
	
//here we make password in hash.
$password_hash = password_hash($password, PASSWORD_DEFAULT, $salt);

$userSecurity->setPassword_hash($password_hash);

$userSecurityService->updateUsersSecurityById($userSecurity);
?>


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
	include 'models/cityService.php';
	include 'models/userService.php';
	include 'resources/includes/labels.php';

	use GeoIp2\Database\Reader;
	
	$countryService = new CountryService();
	
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
	?>
	<div class="row mt-5">
		<div class="col-md-4 offset-md-4 text-center">
			<div class="alert alert-success" role="alert">
			  Password is Updated Successfully!
			</div>
			
			<a class="btn btn-outline-danger" href="index.php">Go To Home Page</a>
		</div>
	</div>

  </body>
</html>