<?php
$adService = new AdService(); 
$adsImagesService = new AdsImagesService();
if (isset($_SESSION['username'])) {
	$ads = null;
	if($status == "All")
		$ads = $adService->getAdByUserId($_SESSION['userId']);
	else
		$ads = $adService->getAdByUserIdAndStatus($_SESSION['userId'], ($status=="Live" ? "Approved" : $status));
	
	echo '<div class="mt-4">';
	if($ads != null) {
		for($i = 0; $i < count($ads); $i++){
			$adsImages = $adsImagesService->getAdImagesByAdId($ads[$i]->getAd_id());
			echo '<div class="row mb-4 border-bottom">
					<div class="col-1 text-center align-self-center">
						<input class="form-check-input" type="checkbox" value="" id="check-'.$ads[$i]->getAd_id().'" style="padding:10px;border:1px solid grey">
					</div>
					<div class="col-9">
					  <a href="ad-detail.php?ad_id='.$ads[$i]->getAd_id().'" class="text-reset text-decoration-none" aria-current="true">
						<div class="card pb-4" style="border:none;">
						  <div class="row g-0">
							<div class="col-4 col-md-2">';
							  if($adsImages !== NULL) {
								echo '<img src="'. $adsImages[0]->getImage_path() .'" class="img-fluid rounded-start rounded-end" >';
							  } else {
								echo '<img src="resources/images/placeholder-image.png" class="card-img-top rounded-2">';
							  }
							echo '</div>
							<div class="col-8 col-md-10">
							  <div class="card-body py-0">
							    <p class="card-text mb-0"><span class="badge rounded-pill text-bg-secondary px-2 pb-2">'.$ads[$i]->getStatus().'</span></p>
								<div class="card-title mb-0">'. $ads[$i]->getTitle() .'</div>';
								$today = strtotime("now");
								$date = strtotime($ads[$i]->getPosted_at());
								echo '<p class="card-text mb-0" style="font-style: bold;">'. floor(($today - $date) / (60 * 60 * 24)) .' days ago</p>
							  </div>
							</div>
						  </div>
						</div>
					  </a>
					</div>
					<div class="col-2 text-end pe-4">
						<div class="dropdown">
							<div class="menu-icon mt-2 px-3" data-bs-toggle="dropdown" aria-expanded="false">
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
	} else {
		echo '<div class="card text-center my-5" style="border:none;">
				<img class="card-img-top" src="resources/images/info-icon.png" style="width: 200px;height:auto;margin: auto;">
				<div class="card-body">';
				if($status == "All")
					echo '<h5 class="card-title">'.$labels[$currentLanguageIsoCode]['You_do_not_have_any_ads'].'</h5>';
				else if($status == "Under_Review")
					echo '<h5 class="card-title">'.$labels[$currentLanguageIsoCode]['You_do_not_have_any_ads_that_are'] . ' ' . $labels[$currentLanguageIsoCode]['Under_Review'] .'</h5>';
				else
					echo '<h5 class="card-title">'.$labels[$currentLanguageIsoCode]['You_do_not_have_any_ads_that_are'] . ' ' . $labels[$currentLanguageIsoCode][$status] .'</h5>';
				
				echo '<a href="place-an-ad.php?category_id=0" class="btn btn-danger">'.$labels[$currentLanguageIsoCode]['Post_ad_now'].'</a>
				</div>
			</div>';
	}
	echo '</div>';
}
?>