<?php include 'google-translate-api-object.php'; ?>
<!doctype html>
<html lang="<?php echo $currentLanguageIsoCode; ?>" dir="<?php echo $currentLanguageDirection; ?>">
  <head>
    <?php include 'head.php'; ?>
	 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
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
		<div class="heading"><?php echo $labels[$currentLanguageIsoCode]['Our_Services']; ?></div>
		<div class="mt-3"><?php echo $labels[$currentLanguageIsoCode]['Our_Services_Line']; ?>:</div>
		<div class="row text-center mt-5 mb-3">
			<div class="col-md-6 mb-4 d-flex">
				<div class="card" style="border-color:gray">
				  <div class="card-body">
					<h5 class="card-title"><?php echo $labels[$currentLanguageIsoCode]['Buying']; ?></h5>
					<h6 class="card-subtitle mb-2 text-muted">"<?php echo $labels[$currentLanguageIsoCode]['Buying_Quotation']; ?>"</h6>
					<img class="w-50 img-service" src="resources/images/land2.jpg">
					<p class="card-text justify-center"><?php echo $labels[$currentLanguageIsoCode]['Buying_Line']; ?></p>
				  </div>
				</div>
			</div>
		
			<div class="col-md-6 mb-4 d-flex">
				<div class="card" style="border-color:gray">
				  <div class="card-body">
					<h5 class="card-title"><?php echo $labels[$currentLanguageIsoCode]['Selling']; ?></h5>
					<h6 class="card-subtitle mb-2 text-muted">"<?php echo $labels[$currentLanguageIsoCode]['Selling_Quotation']; ?>"</h6>
					<img class="w-50 img-service" src="resources/images/rangess.jpg">
					<p class="card-text justify-center"><?php echo $labels[$currentLanguageIsoCode]['Selling_Line']; ?></p>
				  </div>
				</div>
			</div>
		
			<div class="col-md-6 mb-4 d-flex ">
				<div class="card " style="border-color:gray">
				  <div class="card-body">
					<h5 class="card-title"><?php echo $labels[$currentLanguageIsoCode]['Financing']; ?></h5>
					<h6 class="card-subtitle mb-2 text-muted">"<?php echo $labels[$currentLanguageIsoCode]['Financing_Quotation']; ?>"</h6>
					<img class="w-50 img-service" src="resources/images/finace.jpg">
					<p class="card-text justify-center"><?php echo $labels[$currentLanguageIsoCode]['Financing_Line']; ?></p>
				  </div>
				</div>
			</div>
		
			<div class="col-md-6 mb-4 d-flex ">
				<div class="card" style="border-color:gray">
				  <div class="card-body">
					<h5 class="card-title"><?php echo $labels[$currentLanguageIsoCode]['Inspection']; ?></h5>
					<h6 class="card-subtitle mb-2 text-muted">"<?php echo $labels[$currentLanguageIsoCode]['Inspection_Quotation']; ?>"</h6>
					<img class="w-50 img-service"  src="resources/images/inspection.jpg">
					<p class="card-text justify-center"><?php echo $labels[$currentLanguageIsoCode]['Inspection_Line']; ?></p>
				  </div>
				</div>
			</div>
		</div>
		<div class="mb-3"><?php echo $labels[$currentLanguageIsoCode]['Our_Services_Line_End'] . ' ' . $labels[$currentLanguageIsoCode]['Our_Services_Line_End_Two']; ?></div>
	</div>
	
	<!-- popular ads category wise start -->
	<?php include 'views/footer.php'; ?>
	<!-- popular ads category wise end -->
	
	
  </body>
</html>