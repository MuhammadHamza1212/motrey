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
	include 'models/categoryService.php';
	include "models/categories_attributesService.php";
	include "models/category_attributes_optionsService.php";
	include 'models/cityService.php';
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
	
	$countryService = new CountryService();
	$currentCountry = $countryService->getCountryByIsoCode($currentCountryIsoCode, $currentLanguageIsoCode);

	$categories_attributesService = new CategoriesAttributesService();
    
	$categoryService = new CategoryService();
	$categoryName = $labels[$currentLanguageIsoCode]['Motors'];
	$categoryId = $_GET['category_id'];
	
	if($categoryId > 0) {
		$category = $categoryService->getCategoryById($categoryId);
		$categoryName = $category->getName();
	}
	$subCategories = $categoryService->getCategoriesByParentCategoryIdAndLanguage($categoryId, $currentLanguageIsoCode);
	$userService = new UserService();
	$user = $userService->getUserById($_SESSION['userId']);
	
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
	
	if($subCategories !== NULL)
		include 'views/select-ad-categories.php';
	else
		include 'views/fill-ad-details.php';
		
	?>
  </body>
</html>