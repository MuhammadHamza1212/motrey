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
		<div class="heading"><?php echo $labels[$currentLanguageIsoCode]['Frequently_Asked_Questions']; ?></div>
		<div class="accordion mt-4" id="accordionExample">
		  <div class="accordion-item accordion-items" style='overflow: hidden;'>
			<h2 class="accordion-header" id="headingOne">
			  <button class="accordion-button <?php echo $currentLanguageDirection === "rtl" ? "accordion-button-rtl" : "" ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
				<?php echo $labels[$currentLanguageIsoCode]['How_do_I_buy_a_car_on_Motarey']; ?>
			  </button>
			</h2>
			<div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
			  <div class="accordion-body">
				<?php echo $labels[$currentLanguageIsoCode]['How_do_I_buy_a_car_on_Motarey_Answer']; ?>
			  </div>
			</div>
		  </div>
		  <div class="accordion-item accordion-items style='overflow: hidden;">
			<h2 class="accordion-header" id="headingTwo">
			  <button class="accordion-button <?php echo $currentLanguageDirection === "rtl" ? "accordion-button-rtl" : "" ?> collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
				<?php echo $labels[$currentLanguageIsoCode]['How_do_I_sell_my_car_on_Motarey']; ?>
			  </button>
			</h2>
			<div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
			  <div class="accordion-body">
				<?php echo $labels[$currentLanguageIsoCode]['How_do_I_sell_my_car_on_Motarey_Answer']; ?>
			  </div>
			</div>
		  </div>
		  <div class="accordion-item accordion-items style='overflow: hidden;">
			<h2 class="accordion-header" id="headingThree">
			  <button class="accordion-button <?php echo $currentLanguageDirection === "rtl" ? "accordion-button-rtl" : "" ?> collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
				<?php echo $labels[$currentLanguageIsoCode]['What_type_of_vehicles_can_I_find_on_Motarey']; ?>
			  </button>
			</h2>
			<div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
			  <div class="accordion-body">
				<?php echo $labels[$currentLanguageIsoCode]['What_type_of_vehicles_can_I_find_on_Motarey_Answer']; ?>
			  </div>
			</div>
		  </div>
		  <div class="accordion-item accordion-items style='overflow: hidden;">
			<h2 class="accordion-header" id="headingFour">
			  <button class="accordion-button <?php echo $currentLanguageDirection === "rtl" ? "accordion-button-rtl" : "" ?> collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
				<?php echo $labels[$currentLanguageIsoCode]['Is_it_safe_to_buy_sell_car_on_Motarey']; ?>
			  </button>
			</h2>
			<div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
			  <div class="accordion-body">
				<?php echo $labels[$currentLanguageIsoCode]['Is_it_safe_to_buy_sell_car_on_Motarey_Answer']; ?>
			  </div>
			</div>
		  </div>
		  <div class="accordion-item accordion-items style='overflow: hidden;">
			<h2 class="accordion-header" id="headingFive">
			  <button class="accordion-button <?php echo $currentLanguageDirection === "rtl" ? "accordion-button-rtl" : "" ?> collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
				<?php echo $labels[$currentLanguageIsoCode]['Do_you_offer_financing_options']; ?>
			  </button>
			</h2>
			<div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
			  <div class="accordion-body">
				<?php echo $labels[$currentLanguageIsoCode]['Do_you_offer_financing_options_Answer']; ?>
			  </div>
			</div>
		  </div>
		  <div class="accordion-item accordion-items style='overflow: hidden;">
			<h2 class="accordion-header" id="headingSix">
			  <button class="accordion-button <?php echo $currentLanguageDirection === "rtl" ? "accordion-button-rtl" : "" ?> collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
				<?php echo $labels[$currentLanguageIsoCode]['Do_you_provide_warranties_on_cars_sold_on_Motarey']; ?>
			  </button>
			</h2>
			<div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#accordionExample">
			  <div class="accordion-body">
				<?php echo $labels[$currentLanguageIsoCode]['Do_you_provide_warranties_on_cars_sold_on_Motarey_Answer']; ?>
			  </div>
			</div>
		  </div>
		  <div class="accordion-item accordion-items style='overflow: hidden;">
			<h2 class="accordion-header" id="headingSeven">
			  <button class="accordion-button <?php echo $currentLanguageDirection === "rtl" ? "accordion-button-rtl" : "" ?> collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
				<?php echo $labels[$currentLanguageIsoCode]['How_can_I_get_in_touch_with_Motarey_if_I_have_questions_concerns']; ?>
			  </button>
			</h2>
			<div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven" data-bs-parent="#accordionExample">
			  <div class="accordion-body">
				<?php echo $labels[$currentLanguageIsoCode]['How_can_I_get_in_touch_with_Motarey_if_I_have_questions_concerns_Answer']; ?>
			  </div>
			</div>
		  </div>
		</div>
	</div>
	
	<!-- popular ads category wise start -->
	<?php include 'views/footer.php'; ?>
	<!-- popular ads category wise end -->
	
	
  </body>
</html>