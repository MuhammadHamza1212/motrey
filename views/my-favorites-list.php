<?php
$adService = new AdService(); 
$adsImagesService = new AdsImagesService();
if (isset($_SESSION['username'])) {
	$favorites = $favoriteAdService->getFavoriteAdsByUserId($_SESSION['userId']);
	echo '<div class="my-4">';
	if($favorites != null) {
		for($i = 0; $i < count($favorites); $i++){
			$ad = $adService->getAdById($favorites[$i]->getAd_id());
			$adImages = $adsImagesService->getAdImagesByAdId($ad->getAd_id());
			
			echo '<div class="row mb-2 border-bottom">
					<div class="col-1 d-flex align-items-center">
						<input class="form-check-input m-auto" type="checkbox" value="" id="check-'.$ad->getAd_id().'" style="padding:10px;border:1px solid grey">
					</div>
					<div class="col-10">
					  <a href="ad-detail.php?ad_id='.$ad->getAd_id().'" class="text-reset text-decoration-none" aria-current="true">
						<div class="card pb-2" style="border:none;">
						  <div class="row g-0">
							<div class="col-4 col-md-2">';
							  if($adImages !== NULL) {
								echo '<img src="'. $adImages[0]->getImage_path() .'" class="img-fluid rounded-start rounded-end">';
							  } else {
								echo '<img src="resources/images/placeholder-image.png" class="card-img-top rounded-2">';
							  }
							echo '</div>
							<div class="col-8 col-sm-6 d-flex align-items-center">
							  <div class="card-body py-0 w-100" style="'.($currentLanguageDirection === "rtl" ? "padding-left:0" : "padding-right:0").'">
								<div class="card-title mb-0 fs-6" style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">'. $ad->getTitle() .'</div>';
								$today = strtotime("now");
								$date = strtotime($ad->getPosted_at());
								echo '<p class="card-text mb-0" style="font-style: bold;">'. floor(($today - $date) / (60 * 60 * 24)) .' days ago</p>
							  </div>
							</div>
							<div class="d-none d-sm-flex col-md-4 align-items-center">
							  <div class="card-body py-0">
								<div class="card-title mb-0 fs-6">'. $currentCountry->getCurrency() . ' ' . $ad->getPrice() .'</div>
							  </div>
							</div>
						  </div>
						</div>
					  </a>
					</div>
					<div class="col-1 text-end p-0">
						<div class="dropdown">
							<div class="menu-icon mt-2 px-2" data-bs-toggle="dropdown" aria-expanded="false">
							  <span></span>
							  <span></span>
							  <span></span>
							</div>
							<ul class="dropdown-menu">
								<li><a class="dropdown-item" href="#">Delete</a></li>
							</ul>
						</div>
					</div>
				  </div>';
		}
		echo '<div class="row">
			<div class="col-4 col-sm-2 col-lg-1 offset-1">
				<a class="btn btn-outline-danger w-100">Delete</a>
			</div>
		</div>';
		
	} else {
		echo '<div class="card text-center my-5	py-4" style="border:1px solid black;">
				<img class="card-img-top" src="resources/images/info-icon.png" style="width: 200px;height:auto;margin: auto;">
				<div class="card-body">';
					echo '<h5 class="card-title alert alert-danger m-auto mb-3" style="max-width:400px">'.$labels[$currentLanguageIsoCode]['Your_Favourite_list_is_empty'].'</h5>';
					echo '<div class="fw-bold">'.$labels[$currentLanguageIsoCode]['To_fill_your_favorites'].'</div>
				</div>
			</div>';
	}
	echo '</div>';
}
?>