<div class="container mt-5 mb-4 pt-4 pb-3 section-container">

<?php

echo '<div class="heading section-heading w-100 bg-transparent" >
<div class="bg-white px-sm-2 me-sm-2 d-inline-block section-heading-text" style="width:fit-content;">'. $labels[$currentLanguageIsoCode]['Popular_In'] . ' ' . $labels[$currentLanguageIsoCode]['Featured_Ads'] .'</div>
<div class="mx-sm-4 bg-white '.($currentLanguageDirection === "rtl" ? "float-start" : "float-end").'"><a href="ads.php?category_id=0" class="btn btn-outline-danger">'.$labels[$currentLanguageIsoCode]['View_All'].'</a></div>
</div>';



$adService = new AdService();
$adType = "Featured";
$ads = $adService->getAdsByAdType($adType, true);
if($ads == NULL) {
	echo '<div class="alert alert-warning p-4 mt-4" role="alert">
			<div class="row ms-0">
				<div class="col-4 col-lg-1">
					<img height="auto" width="100%" src="resources/images/info-icon.png">
				</div>
				<div class="col-8 col-lg-11">';
				echo '<h4 class="alert-heading">'.$labels[$currentLanguageIsoCode]['We_could_not_find_any_featured_Ads'].'</h4 >';
				echo '<div>'.$labels[$currentLanguageIsoCode]['Please_come_again_later'].'</div>
				</div>
			</div>
		</div>';
}
else {
	echo '<div class="row row-cols-1 row-cols-md-5 g-4 mt-2">';
	for($i = 0; $i < count($ads) && $i < 5; $i++) {
	  echo '<div class="col '.($i < 4 ? "" : "").'">
				<a href="ad-detail.php?ad_id='.$ads[$i]->getAd_id().'" class="text-reset text-decoration-none" aria-current="true">
					<div class="card h-100 popular-ad-card p-2">';
					$adImageService = new AdsImagesService();
					$adMainImage = $adImageService->getAdImagesByAdId($ads[$i]->getAd_id());
					echo '<div class="h-100 d-flex ratio-lg-3-by-2">';
					if($adMainImage !== NULL) {
						echo '<img src="'.$adMainImage[0]->getImage_path().'" class="card-img-top rounded-2">';
					} else {
						echo '<img src="resources/images/placeholder-image.png" class="card-img-top rounded-2">';
					}
					echo '</div>';

				echo '<div class="card-body ps-0 pt-2">
						<h5 class="card-title my-0">'.$currentCountry->getCurrency().' '.$ads[$i]->getPrice(). '</h5>';
						$categoryAttributesService = new CategoriesAttributesService();
						$categoryAttributes = $categoryAttributesService->getCategoriesAttributesByCategoryId($value->getCategory_id());
				  echo '<p class="card-text mb-0">';
							
							$translatedAdTitle = $translate->translate($ads[$i]->getTitle(), ['target' => $currentLanguageIsoCode])['text'];
							echo $translatedAdTitle;
				  echo '</p>';
				  $today = strtotime("now");
				  $date = strtotime($ads[$i]->getPosted_at());
				  $adPostDays = floor(($today - $date) / (60 * 60 * 24)) . ' '.$labels[$currentLanguageIsoCode]['Days'].' '.$labels[$currentLanguageIsoCode]['Ago'].'';
				  echo '<p class="card-text text-danger">'. $adPostDays .'</p>
					  </div>
					</div>
				</a>
			</div>';
	}
	echo '</div>';
}
?>
</div>