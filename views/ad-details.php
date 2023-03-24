<?php
$isFavoriteAd = "false";
$favoriteAd = $favoriteAdService->getFavoriteAdsByUserIdAndAdId($userId, $ad->getAd_id());
if($favoriteAd !== null) {
	$isFavoriteAd = "true";
}
?>


<div class="row">
	<div class="col-lg-8">
		<div class="row mb-3 details d-none d-md-flex">
			<div class="col-12">
				<div class="heading" style="font-size: 30px;"><?php echo $translate->translate($ad->getTitle(), ['target' => $currentLanguageIsoCode])['text']; ?></div>
				<?php
				$today = strtotime("now");
				$date = strtotime($ad->getPosted_at());
				echo '<div style="font-style: bold, color:red !important">'.$labels[$currentLanguageIsoCode]['Posted'].' '. floor(($today - $date) / (60 * 60 * 24)) .' '.$labels[$currentLanguageIsoCode]['Days'].' '.$labels[$currentLanguageIsoCode]['Ago'].'</div>';
				?>
				
			</div>
		</div>
		<div class="row">
			<div class="col-12 px-0 px-md-1" style="position: relative">
				<div class="favorite-btn-div bg-transparent">
					<a class="mx-2" onclick="share(<?php echo $ad->getAd_id() ?>);" data-bs-toggle="modal" data-bs-target="#shareModal"><img id="share-icon" src="resources/images/share-icon.svg" width="40" class="shareicon"></a>
					<?php if(isset($_SESSION['userId'])) { ?>
					<a onclick="addFavorite(<?php echo $ad->getAd_id() ?>);"><img id="favorite-icon" src="<?php echo ($isFavoriteAd === "true" ? "resources/images/filled-heart.png" : "resources/images/empty-heart."); ?>" width="35"></a>
					<?php } else { ?>
					<a data-bs-toggle="modal" data-bs-target="#loginModal"><img id="favorite-icon" src="resources/images/empty-heart.svg" style="width:44px" class="heart-image"></a>
					<?php } ?>
				</div>
				
				<!-- Modal -->
				<div class="modal fade" id="shareModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="shareModalLabel" aria-hidden="true">
				  <div class="modal-dialog" style="margin-top:30vh;">
					<div class="modal-content">
					  <div class="modal-header">
						<h1 class="modal-title fs-5" id="shareModalLabel"><?php echo $labels[$currentLanguageIsoCode]['Share_this_Ad']; ?></h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="margin-left:<?php echo ($currentLanguageDirection === "rtl" ? "0px" : "auto"); ?>"></button>
					  </div>
					  <div class="modal-body m-auto">
						<div class="input-group mb-3">
						  <input id="url-input" type="text" class="form-control" value="<?php echo "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" readonly="true">
						  <button class="btn btn-outline-danger" type="button" id="copy-button" onclick="copyURLToClipboard();"><?php echo $labels[$currentLanguageIsoCode]['Copy']; ?></button>
						</div>
						<!--
						<ul class="list-group list-group-horizontal">
						  <li class="list-group-item"><img src="resources/images/facebook-icon.png" width="30"></li>
						  <li class="list-group-item"><img src="resources/images/twitter-icon.png" width="30"></li>
						  <li class="list-group-item"><img src="resources/images/gmail-icon.png" width="30"></li>
						  <li class="list-group-item"><img src="resources/images/linkedin-icon.png" width="30"></li>
						  <li class="list-group-item"><img src="resources/images/whatsapp-icon.png" width="30"></li>
						</ul>
						-->
					  </div>
					</div>
				  </div>
				</div>
				<script>
					function copyURLToClipboard() {
						var textBox = document.getElementById("url-input");
						textBox.select();
						document.execCommand("copy");
					}
				</script>
				<div class="toast-container position-fixed bottom-0 p-3" style="right:0;">
				  <div id="favoriteAddedToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
					<div class="toast-header">
					  <img src="resources/images/thumbs-up-green.png" class="rounded me-2" width="50">
					  <strong><?php echo $labels[$currentLanguageIsoCode]['Favorite_Added']; ?></strong>
					  <button type="button" class="btn-close" style="margin-left:auto;width:40px" data-bs-dismiss="toast" aria-label="Close"></button>
					</div>
					<div class="toast-body px-4">
					  <?php echo $labels[$currentLanguageIsoCode]['Ad_is_added_to_Favorites']; ?>
					</div>
				  </div>
				</div>
				
				<div class="toast-container position-fixed bottom-0 p-3" style="right:0;">
				  <div id="favoriteRemovedToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
					<div class="toast-header">
					  <img src="resources/images/thumbs-up-red.png" class="rounded me-2" width="50">
					  <strong><?php echo $labels[$currentLanguageIsoCode]['Favorite_Removed']; ?></strong>
					  <button type="button" class="btn-close" style="margin-left:auto;width:40px" data-bs-dismiss="toast" aria-label="Close"></button>
					</div>
					<div class="toast-body px-4">
					  <?php echo $labels[$currentLanguageIsoCode]['Ad_is_removed_from_Favorites']; ?>
					</div>
				  </div>
				</div>
				
				<div id="carouselExampleIndicators" class="carousel slide mb-2 mb-md-5 ad-carousel">
				    <div class="carousel-indicators ad-carousel-buttons d-none d-md-flex">
				    <?php
						if($adImages !== null) {
							for($i = 0; $i < count($adImages); $i++) {
								echo '<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="'.$i.'" class="'.($i==0 ? "active" : "").' carousel-gallery-image" aria-current="true" aria-label="Slide '.($i+1).'">
									<img src="'.$adImages[$i]->getImage_path().'" class="d-block w-100">
								</button>';
							}
						}
						else {
							echo '<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active carousel-gallery-image" aria-label="Slide 1">
								<img src="resources/images/placeholder-image.png" class="d-block w-100">
							</button>';
						}
				    ?>
				    </div>
				    <div class="carousel-inner">
						<?php
						if($adImages !== null) {
							for($i = 0; $i < count($adImages); $i++) {
								echo '<div  style="margin-left:0;" class="carousel-item '.($i==0 ? "active" : "").'">
								  <img src="'.$adImages[$i]->getImage_path().'" class="d-block w-100">
								</div>';
							}	
						}
						else {
							echo '<div style="margin-left:0;"  class="carousel-item active">
							  <img src="resources/images/placeholder-image.png" class="d-block w-100">
							</div>';
						}
						?>
					</div>
					<button class="carousel-control-prev sliderss" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="visually-hidden"><?php echo $labels[$currentLanguageIsoCode]['Previous']; ?></span>
					</button>
					<button class="carousel-control-next sliders" style="left:auto;" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="visually-hidden"><?php echo $labels[$currentLanguageIsoCode]['Next']; ?></span>
					</button>
				</div>
				
			</div>
		</div>
		<div class="row mb-3 details d-md-none">
			<div class="col-12">
				<?php echo '<div class="fw-bold" style="font-size: 25px;color:red">'.$currentCountry->getCurrency().' '.$ad->getPrice().'</div>'; ?>
				<div class="heading" style="font-size: 30px;"><?php echo $translate->translate($ad->getTitle(), ['target' => $currentLanguageIsoCode])['text']; ?></div>
				<?php
				$today = strtotime("now");
				$date = strtotime($ad->getPosted_at());
				echo '<div style="font-style: bold, ">'.$labels[$currentLanguageIsoCode]['Posted'].' '. floor(($today - $date) / (60 * 60 * 24)) .' '.$labels[$currentLanguageIsoCode]['Days'].' '.$labels[$currentLanguageIsoCode]['Ago'].'</div>';
				?>
				
			</div>
		</div>
		<div class="row ad-item-overview">
			<div class="col-12">
				<div class="sub-heading"><?php echo $labels[$currentLanguageIsoCode]['Description']; ?>: </div>
			</div>
		</div>
		<div class="row mt-3">
		    <div class="col-12">
		        <?php echo $translate->translate($ad->getDescription(), ['target' => $currentLanguageIsoCode])['text']; ?>
		    </div>
		</div>
		<div class="row ad-item-overview">
			<div class="col-12">
				<div class="sub-heading"><?php echo $labels[$currentLanguageIsoCode]['Item_Overview']; ?></div>
			</div>
		</div>
		<div class="row mt-3">
		<?php 
		$categoryAttributesService = new CategoriesAttributesService();
		
		$category = $categoryService->getCategoryById($ad->getCategory_id());
	
		$categoryAttributes = $categoryAttributesService->getCategoriesAttributesByCategoryId($category->getCategory_id());
		while($category->getParent_category_id() > 0) {
			$category = $categoryService->getCategoryById($category->getParent_category_id());
			$tempCategoryAttributes = $categoryAttributesService->getCategoriesAttributesByCategoryId($category->getCategory_id());
			if($categoryAttributes !== null && $tempCategoryAttributes !== null)
				$categoryAttributes = array_merge($categoryAttributes, $tempCategoryAttributes);
			else if($categoryAttributes === null && $tempCategoryAttributes !== null)
				$categoryAttributes = $tempCategoryAttributes;
		}
		$categoryAttributesValuesService = new CategoryAttributesValuesService();
		if($categoryAttributes !== null) {
			for($i=0; $i < count($categoryAttributes) && $i < 6; $i++) {
				$categoryAttributesValue = $categoryAttributesValuesService->getCategoryAttributesValueByAdIdAndAttributeId($ad->getAd_id(), $categoryAttributes[$i]->getAttribute_id());
				
				echo '<div class="col-4 col-lg-2 mb-3 ">
					<div class="card shadow border border-0 text-center small-cards" style="height: 140px;">
					  <div class="card-body px-2" style="align-items: center;display: grid;">
						<p class="card-text mb-0" style="font-weight:bold;">'.$translate->translate($categoryAttributes[$i]->getName(), ['target' => $currentLanguageIsoCode])['text'].'</p>';
						
						if($categoryAttributes[$i]->getIcon_image_path() !== null)
							echo '<p class="card-text my-0" style="font-weight:bold;"><img width="30" height="30" src="'.$categoryAttributes[$i]->getIcon_image_path().'"></p>';
						echo '<p class="card-text">'.$translate->translate($categoryAttributesValue->getValue(), ['target' => $currentLanguageIsoCode])['text'].'</p>
						
					  </div>
					</div>
				</div>';
			}
		}
		?>	
		</div>
		<div class="row my-5">
			<div class="col-12">
				<div class="sub-heading"><?php echo $labels[$currentLanguageIsoCode]['Additional_Details']; ?></div>
			</div>
		</div>
		<?php
		if($categoryAttributes !== null) {
    		for($i=6; $i < count($categoryAttributes); $i++) {
    			$categoryAttributesValue = $categoryAttributesValuesService->getCategoryAttributesValueByAdIdAndAttributeId($ad->getAd_id(), $categoryAttributes[$i]->getAttribute_id());
    			if($categoryAttributesValue !== null) {
        			echo '
				
					<div class="row pb-4 mb-3 ps-4 border-bottom border-right">
        				<div class="col-6">
        					<div class="fw-bold">'.$translate->translate($categoryAttributes[$i]->getName(), ['target' => $currentLanguageIsoCode])['text'].'</div>
        				</div>
        				<div class="col-6">
    						<div>'.$translate->translate($categoryAttributesValue->getValue(), ['target' => $currentLanguageIsoCode])['text'].'</div>
    					</div>
        			</div>';
    			}
    		}
		}
		?>
		<div class="row my-5">
			<div class="col-12">
				<div class="sub-heading"><?php echo $labels[$currentLanguageIsoCode]['Location']; ?></div>
				<?php 
				$cityService = new CityService();
				$city = $cityService->getCityByCityId($ad->getSource_city_id());
				if($city !== null)
					echo '<div class="my-3">' . $ad->getSource_location_address() . ', ' . $city->getName() . ', ' . $currentCountry->getName() . '</div>';
				else
					echo '<div class="my-3">' . $ad->getSource_location_address() . ', ' . $currentCountry->getName() . '</div>';
				?>
				<!-- Create the map container -->
				<div>
					<div id="map" style="width:100%; height:350px;"></div>
					<div id="mapBlockShield"></div>
					<style>
						#mapBlockShield {
							width:100%;
							height:350px;
							opacity:0;
							margin-top:-350px;
							position:relative;
							z-index:1000;
							display: none;
						}
					</style>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-4">
		<div class="row d-none d-md-flex" style="margin-bottom:39px;">
			<div class="col-12">
				<?php echo '<div class="heading text-end" style="font-size: 30px;color:red">'.$currentCountry->getCurrency().' '.$ad->getPrice().'</div>'; ?>
			</div>
		</div>
		<?php
		$userService = new UserService();
		$user = $userService->getUserById($ad->getUser_id());
		
		$userProfileService = new UserProfileService();
		$userProfile = $userProfileService->getUsersProfileById($ad->getUser_id());
		
		if($user->getPhone() !== null) {
			$whatsappNumber = $user->getPhone();
			$message = 'Assalam-u-Alaikum, I need to inquire about your Ad.';
			$whatsappLink = 'https://api.whatsapp.com/send?phone=' . $whatsappNumber . '&text=' . urlencode($message);
		}
		?>
		<div class="row">
			<div class="col-12">
				<div class="card">
				  <div class="card-body">
					<div class="row mb-3">
						<div class="col-8">
							<h6 class="card-subtitle mb-2 text-muted"><?php echo $labels[$currentLanguageIsoCode]['Posted_by']; ?></h6>
							<h5 class="card-title"><?php echo $user->getUsername(); ?></h5>
						</div>
						<div class="col-4">
							<?php echo '<img src="'.$userProfile->getProfile_picture().'" width="100%">'; ?>
						</div>
					</div>
					<div class="row mb-3">
						<div class="col-12 text-center">
							<a id="show-phone-number" class="btn btn-outline-danger w-75" onclick="showPhoneNumber();" style="direction:ltr;"><?php echo $labels[$currentLanguageIsoCode]['Show_Phone_Number']; ?></a>
						</div>
					</div>
					<?php
					if($user->getPhone() !== null) {
						echo '<div class="row">
							<div class="col-12 text-center">
								<a target="_blank" href="' . $whatsappLink . '" class="btn btn-outline-danger w-75">'.$labels[$currentLanguageIsoCode]['Send_WhatsApp_Message'].'</a>
							</div>
						</div>';
					}
					?>
				  </div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
function showPhoneNumber() {
	document.getElementById('show-phone-number').innerText = '<?php echo $user->getPhone(); ?>';
}

let marker;
var coordinates = '<?php echo $ad->getSource_location_coordinates(); ?>';
var lat = coordinates.split(",")[0];
var lng = coordinates.split(",")[1];
var map = L.map('map').setView([lat, lng], 13);
var osmLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
	attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
  }).addTo(map);
marker = L.marker([lat, lng]).addTo(map);

let favoriteAd = <?php echo ($isFavoriteAd === "true" ? "true" : "false"); ?>;
const favoriteAddedToast = new bootstrap.Toast(document.getElementById('favoriteAddedToast'));
const favoriteRemovedToast = new bootstrap.Toast(document.getElementById('favoriteRemovedToast'));

function addFavorite(adId) {
	if(!favoriteAd) {
		var xhr = new XMLHttpRequest();
		xhr.open("GET", "add-favorite-ad.php?ad_id="+adId, false);
		xhr.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
				if(this.responseText == 'added') {
					document.getElementById('favorite-icon').src = "resources/images/filled-heart.png";
					favoriteRemovedToast.hide();
					favoriteAddedToast.show();
					favoriteAd = true;
				} else {
					console.info(this.responseText);
				}
			} else {
				console.error(this.responseText);
			}
		};
		xhr.send();
	}
	else {
		var xhr = new XMLHttpRequest();
		xhr.open("GET", "remove-favorite-ad.php?ad_id="+adId, false);
		xhr.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
				if(this.responseText == 'removed') {
					document.getElementById('favorite-icon').src = "resources/images/empty-heart.svg";
					favoriteAddedToast.hide();
					favoriteRemovedToast.show();
					favoriteAd = false;
				} else {
					console.info(this.responseText);
				}
			} else {
				console.error(this.responseText);
			}
		};
		xhr.send();
	}
}
</script>