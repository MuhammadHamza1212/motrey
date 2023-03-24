<?php include 'google-translate-api-object.php'; ?>
<!doctype html>
<html lang="<?php echo $currentLanguageIsoCode; ?>" dir="<?php echo $currentLanguageDirection; ?>">
  <head>
    <?php include 'head.php'; ?>
  </head>
  <body>
  
	
	<?php 
	include 'config.php';
	include 'models/categoryService.php';
	include 'models/countryService.php';
	include 'models/cityService.php';
	include 'models/adService.php';
	include 'models/ads_imagesService.php';
	include 'models/categories_attributesService.php';
	include 'models/category_attributes_valuesService.php';	
	include 'models/userService.php';
	include 'models/user_profileService.php';
	include 'models/favorite_adService.php';
	include 'resources/includes/labels.php';
	
	require 'vendor/autoload.php';
	use GeoIp2\Database\Reader;
	
    $categoryService = new CategoryService(); 
	$category = new Category();
	$countryService = new CountryService();
	$cityService = new CityService();
	$favoriteAdService = new FavoriteAdService();	
	$selectedCity = null;
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
	$currentCountry = $countryService->getCountryByIsoCode($currentCountryIsoCode, $currentLanguageIsoCode);
	$adService = new AdService(); 
	$adsImagesService = new AdsImagesService(); 
	$ad = $adService->getAdById($_GET['ad_id']);
	$adImages = $adsImagesService->getAdImagesByAdId($_GET['ad_id']);
	
	session_start();
	$userId = $_SESSION['userId'];
	?>
	
	<!-- navbar start -->
	<?php include 'views/navbar.php' ?>
    <!-- navbar end -->

	<div class="container pt-md-5 mb-5">
		<!-- ad details start -->
		<?php include 'views/ad-details.php' ?>
		<!-- ad details end -->
	</div>
	
	<!-- footer start -->
	<?php include 'views/footer.php'; ?>
	<!-- footer end -->
	<nav class="navbar sticky-bottom bg-body-tertiary sticky-bottom-nav-for-phone border border-top">
	  <div class="container-fluid">
		<a id="show-phone-number-bottom-nav" class="btn btn-outline-danger px-0 mx-1" style="flex-grow:1" onclick="showPhoneNumberBottomNav();">
			<img src="resources/images/phone-icon.png" width="30">
			<span>Phone No</span>
		</a>
		<a class="btn btn-outline-danger px-0 mx-1" style="flex-grow:1" href="<?php echo $whatsappLink; ?>">
			<img src="resources/images/whatsapp-icon.png" width="30">
			<span>WhatsApp</span>
		</a>
	  </div>
	</nav>
	
	<script>
		function showPhoneNumberBottomNav() {
			document.getElementById('show-phone-number-bottom-nav').innerText = '<?php echo $user->getPhone(); ?>';
		}
	</script>
  </body>
</html>