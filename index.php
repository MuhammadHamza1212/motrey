<?php include 'google-translate-api-object.php'; ?>
<!doctype html>
<html lang="<?php echo $currentLanguageIsoCode; ?>" dir="<?php echo $currentLanguageDirection; ?>">
  <head>
    <?php include 'head.php'; ?>
  </head>
  <body>
	
	<script>
		window.fbAsyncInit = function() {
			FB.init({
			  appId      : '2175062012883316',
			  cookie     : true,
			  xfbml      : true,
			  version    : 'v6.0'
			});
			  
			FB.AppEvents.logPageView();   
		  
		};

		(function(d, s, id){
			 var js, fjs = d.getElementsByTagName(s)[0];
			 if (d.getElementById(id)) {return;}
			 js = d.createElement(s); js.id = id;
			 js.src = "https://connect.facebook.net/en_US/sdk.js";
			 fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));

		function fbLogin() {
			FB.login(function(response){
				if(response.authResponse) {
				  fbLoginAfter();
				}
			});
		}
		function fbLoginAfter() {  
			FB.getLoginStatus(function(response) {
				console.log('Welcome!  Fetching your information.... ');
				if (response.status === 'connected') {
					FB.api('/me', function(response) {
					    var xhr = new XMLHttpRequest();
						xhr.open("POST", "sign-in-with-facebook.php", true);
						xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
						var formData = "name=" + encodeURIComponent(response.name) + "&fb_id=" + encodeURIComponent(response.id);
						xhr.send(formData);
						xhr.onload = function() {
							if (xhr.status === 200) {
								if(this.responseText == 'signup' || this.responseText == 'signin') {
									location.reload(true); // Reload from server
								} else {
									alert(this.responseText);
								}
							} else {
								console.error(this.responseText);
							}
						};
					});
				}
			});
		}
	</script>
	
	
	<?php 
	include 'config.php';
	include 'models/categoryService.php';
	include 'models/countryService.php';
	include 'models/cityService.php';
	include 'models/adService.php';
	include 'models/ads_imagesService.php';
	include 'models/categories_attributesService.php';
	include 'models/category_attributes_optionsService.php';
	include 'models/category_attributes_valuesService.php';
	include 'resources/includes/labels.php';
	
	use GeoIp2\Database\Reader;
	
    $categoryService = new CategoryService(); 
	$countryService = new CountryService();
	$cityService = new CityService(); 

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
	<?php include 'views/navbar.php'; ?>
    <!-- navbar end -->

	<!-- banner start -->
	<?php include 'views/banner.php'; ?>
    <!-- banner end -->
	
	<!-- featured ads start -->
	<?php include 'views/featured-ads.php'; ?>
	<!-- featured ads end -->
	
	<!-- popular ads category wise start -->
	<?php include 'views/popular-ads-category-wise.php'; ?>
	<!-- popular ads category wise end -->
	
	<!-- dealer section start -->
	<?php include 'views/dealer-section.php'; ?>
	<!-- dealer section end -->
	
	<!-- about start -->
	<?php include 'views/about.php'; ?>
    <!-- about end -->
	
	<!-- popular ads category wise start -->
	<?php include 'views/footer.php'; ?>
	<!-- popular ads category wise end -->
	
	
  </body>
</html>