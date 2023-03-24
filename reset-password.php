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
	include "models/users_securityService.php";
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

	$userSecurityService = new UserSecurityService();
	$userSecurity = $userSecurityService->getUsersSecurityByUnexpiredToken($_GET['token']);
	
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
	if($userSecurity === null) {
		echo '<div class="row mt-5">
			<div class="col-md-4 offset-md-4">
				<div class="alert alert-warning" role="alert">
				  This Token is Expired. Please generate another one.
				</div>
			</div>
		</div>';
	}
	else {
		echo '<div class="row mt-5">
			<div class="col-md-4 offset-md-4">
				<div class="heading mb-3">'.$labels[$currentLanguageIsoCode]["Reset_Your_Password"].'</div>
				<form id="reset-password-form" action="update-password.php" method="post" style="margin-bottom: 90px;">
					<input type="hidden" name="user-id" value="'.$userSecurity->getUser_id().'">
					<div class="form-floating mb-3">
						<input id="password" type="text" class="form-control px-4 form-field" id="adTitle" name="password" placeholder="'.$labels[$currentLanguageIsoCode]["Enter_New_Password"].'" required="true">
						<label class="px-4" for="password">'.$labels[$currentLanguageIsoCode]["Enter_New_Password"].'</label>
						<div id="password-required" style="display=none;" class="invalid-feedback">'.$labels[$currentLanguageIsoCode]['Password_Required'].'</div>
					</div>
					<div class="form-floating mb-3">
						<input id="password-again" type="text" class="form-control px-4 form-field" id="adTitle" name="password-again" placeholder="'.$labels[$currentLanguageIsoCode]["Enter_New_Password_Again"].'" required="true">
						<label class="px-4" for="password_again">'.$labels[$currentLanguageIsoCode]["Enter_New_Password_Again"].'</label>
						<div id="password-again-required" style="display=none;" class="invalid-feedback">'.$labels[$currentLanguageIsoCode]['Password_Again_Required'].'</div>
					</div>
					<div id="same-password-error" style="display=none;" class="invalid-feedback">'.$labels[$currentLanguageIsoCode]['Same_Password_Error'].'</div>
					<a onclick="submitPasswordResetForm()" class="btn btn-danger btn-theme w-100">'.$labels[$currentLanguageIsoCode]['Submit'].'</a>
					
				</form>
			</div>
		</div>';
	}

	?>
  </body>
  <script>
  function submitPasswordResetForm(){
	  
	  document.getElementById("password-required").style.display = "none";
	  document.getElementById("password-again-required").style.display = "none";
	  document.getElementById("same-password-error").style.display = 'none';
	  var password = document.getElementById("password").value;
	  if(password === "") {
		  document.getElementById("password-required").style.display = "block";
		  return;
	  }
	  var passwordAgain = document.getElementById("password-again").value;
	  if(passwordAgain === "") {
		  document.getElementById("password-again-required").style.display = "block";
		  return;
	  }
	  
	  if(password === passwordAgain) {
		 document.getElementById("reset-password-form").submit();
	  }
	  else {
		  document.getElementById("same-password-error").style.display = 'block';
	  }
	  
	}
  </script>
</html>