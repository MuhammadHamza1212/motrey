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
	<div class="container py-5">
		<div class="heading"><?php echo $labels[$currentLanguageIsoCode]['About_Us']; ?></div>
		<div class="mt-3"><?php echo $labels[$currentLanguageIsoCode]['About_Us_Line_One']; ?></div>
		<div class="mt-3"><?php echo $labels[$currentLanguageIsoCode]['About_Us_Line_Two']; ?></div>
		<div class="mt-3"><?php echo $labels[$currentLanguageIsoCode]['About_Us_Line_Three']; ?></div>
		<div class="mt-3"><?php echo $labels[$currentLanguageIsoCode]['About_Us_Line_Four']; ?></div>
		<div class="mt-3"><?php echo $labels[$currentLanguageIsoCode]['About_Us_Line_Five']; ?></div>
		<div class="mt-3"><?php echo $labels[$currentLanguageIsoCode]['About_Us_Line_Six']; ?></div>
		<div class="mt-3"><?php echo $labels[$currentLanguageIsoCode]['About_Us_Line_Seven']; ?></div>
		<blockquote class="mt-3">“<?php echo $labels[$currentLanguageIsoCode]['About_Us_Quotation']; ?>”</blockquote>
	</div>
	
	<div class="container pb-5">
		<div class="heading"><?php echo $labels[$currentLanguageIsoCode]['Our_Mission']; ?></div>
		<ul class="list-group mt-3" style="border-color:black;">
		  <li class="list-group-item" style="border-color:black;"><?php echo $labels[$currentLanguageIsoCode]['Our_Mission_Line_One']; ?></li>
		  <li class="list-group-item" style="border-color:black;"><?php echo $labels[$currentLanguageIsoCode]['Our_Mission_Line_Two']; ?></li>
		  <li class="list-group-item" style="border-color:black;"><?php echo $labels[$currentLanguageIsoCode]['Our_Mission_Line_Three']; ?></li>
		</ul>
	</div>
	
	<div class="container pb-5">
		<div class="heading"><?php echo $labels[$currentLanguageIsoCode]['Our_Vision']; ?></div>
		<ul class="list-group mt-3" style="border-color:black;">
		  <li class="list-group-item" style="border-color:black;"><?php echo $labels[$currentLanguageIsoCode]['Our_Vision_Line_One']; ?></li>
		  <li class="list-group-item" style="border-color:black;"><?php echo $labels[$currentLanguageIsoCode]['Our_Vision_Line_Two']; ?></li>
		  <li class="list-group-item" style="border-color:black;"><?php echo $labels[$currentLanguageIsoCode]['Our_Vision_Line_Three']; ?></li>
		</ul>
	</div>
	
	<div class="container pb-5">
		<div class="heading"><?php echo $labels[$currentLanguageIsoCode]['Core_Values']; ?></div>
		<div class="mt-3"><?php echo $labels[$currentLanguageIsoCode]['Core_Values_Line']; ?>:</div>
		<div class="mt-3">
			<div class="fw-bold"><?php echo $labels[$currentLanguageIsoCode]['Customer_Satisfaction']; ?></div>
			<div><?php echo $labels[$currentLanguageIsoCode]['Customer_Satisfaction_Line']; ?></div>
		</div>
		<div class="mt-3">
			<div class="fw-bold"><?php echo $labels[$currentLanguageIsoCode]['Integrity']; ?></div>
			<div><?php echo $labels[$currentLanguageIsoCode]['Integrity_Line']; ?></div>
		</div>
		<div class="mt-3">
			<div class="fw-bold"><?php echo $labels[$currentLanguageIsoCode]['Innovation']; ?></div>
			<div><?php echo $labels[$currentLanguageIsoCode]['Innovation_Line']; ?></div>
		</div>
		<div class="mt-3">
			<div class="fw-bold"><?php echo $labels[$currentLanguageIsoCode]['Reliability']; ?></div>
			<div><?php echo $labels[$currentLanguageIsoCode]['Reliability_Line']; ?></div>
		</div>
		<div class="mt-3">
			<div class="fw-bold"><?php echo $labels[$currentLanguageIsoCode]['Efficiency']; ?></div>
			<div><?php echo $labels[$currentLanguageIsoCode]['Efficiency_Line']; ?></div>
		</div>
		<div class="mt-3">
			<div class="fw-bold"><?php echo $labels[$currentLanguageIsoCode]['Diversity']; ?></div>
			<div><?php echo $labels[$currentLanguageIsoCode]['Diversity_Line']; ?></div>
		</div>
	</div>
	
	<!-- popular ads category wise start -->
	<?php include 'views/footer.php'; ?>
	<!-- popular ads category wise end -->
	
	
  </body>
</html>