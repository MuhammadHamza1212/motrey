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
	include 'resources/includes/labels.php';
	include "models/favorite_adService.php";
	
	require 'vendor/autoload.php';
	use GeoIp2\Database\Reader;
	
    $categoryService = new CategoryService(); 
	$countryService = new CountryService();
	$cityService = new CityService(); 
	$adService = new AdService();
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

	session_start();
	?>
	
	<!-- navbar start -->
	<?php include 'views/navbar.php' ?>
    <!-- navbar end -->

	<div class="container pt-5">
		<div class="heading mb-4"><?php echo $labels[$currentLanguageIsoCode]['Favourites'] ?></div>
	
		<!-- my ads list start -->
		<?php include 'views/my-favorites-list.php' ?>
		<!-- my ads list end -->

	</div>
	
	<!-- popular footer start -->
	<?php include 'views/footer.php'; ?>
	<!-- popular footer end -->

  </body>
</html>