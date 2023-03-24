<?php
$adService = new AdService(); 
$adsImagesService = new AdsImagesService(); 

$category_id = $_GET["category_id"];
$page = 1;
if (isset($_GET['page'])) {
	$page = intval($_GET['page']);
	if($page < 1)
		$page = 1;
}
$category = $categoryService->getCategoryById($category_id);
$allHierarchicalSubCategories = $categoryService->getAllCategoriesHierarchicallyByParentCategoryId($category_id);
$allHierarchicalSubCategoriesIdsSal = array($category === null ? 0 : $category->getCategory_id_sal());
if($allHierarchicalSubCategories !== NULL) {
	foreach ($allHierarchicalSubCategories as $subCategory) {
		array_push($allHierarchicalSubCategoriesIdsSal, $subCategory->getCategory_id_sal());
	}
}
$cityId = null;
if (isset($_GET['city']) && $_GET['city'] != 0) {
	$cityId = $_GET['city'];
}
$from_price = null;
if (isset($_GET['from_price'])) {
	$from_price = $_GET['from_price'];
}
$to_price = null;
if (isset($_GET['to_price']) && $_GET['to_price'] != "") {
	$to_price = $_GET['to_price'];
}
$countryId = $currentCountry->getCountry_id_sal();
$ads = $adService->getAdsByMultipleFilters($allHierarchicalSubCategoriesIdsSal, $cityId, $countryId, $from_price, $to_price);

// filtering ads by dynamic attributes
$categoriesAttributesService = new CategoriesAttributesService();
$categoryAttributesValuesService = new CategoryAttributesValuesService();
$categoryAttributes = $categoriesAttributesService->getCategoriesAttributesByCategoryId($category_id);
if($categoryAttributes !== null) {
	if($ads !== null) {
		for($j = 0; $j < count($ads); $j++){
			for($k = 0; $k < count($categoryAttributes); $k++) {
				if($k<2) {
					if(isset($_GET[$categoryAttributes[$k]->getName()]) && $_GET[$categoryAttributes[$k]->getName()] !== '') {
						$categoryAttributesValue = $categoryAttributesValuesService->getCategoryAttributesValueByAdIdAndAttributeId($ads[$j]->getAd_id(), $categoryAttributes[$k]->getAttribute_id());
						if($categoryAttributesValue === null || $categoryAttributesValue->getValue() !== $_GET[$categoryAttributes[$k]->getName()]) {
							unset($ads[$j]);
							$ads = array_values($ads); // update the indexes to start from 0
							$j--;
							break;
						}
					}
				}
				else {
					// filteration by some dynamic attributes statically
					
					if($categoryAttributes[$k]->getName() == "Kilometers") {
						if((isset($_GET['from_km']) && $_GET['from_km'] !== '') || (isset($_GET['to_km']) && $_GET['to_km'] !== '')) {
							$categoryAttributesValue = $categoryAttributesValuesService->getCategoryAttributesValueByAdIdAndAttributeId($ads[$j]->getAd_id(), $categoryAttributes[$k]->getAttribute_id());
							if($categoryAttributesValue === null || $categoryAttributesValue->getValue() === '') {
								unset($ads[$j]);
								$ads = array_values($ads); // update the indexes to start from 0
								$j--;
								break;
							}
							else if($_GET['from_km'] !== '' && $categoryAttributesValue->getValue() < $_GET['from_km']) {
								unset($ads[$j]);
								$ads = array_values($ads); // update the indexes to start from 0
								$j--;
								break;
							}
							else if($_GET['to_km'] !== '' && $categoryAttributesValue->getValue() > $_GET['to_km']) {
								unset($ads[$j]);
								$ads = array_values($ads); // update the indexes to start from 0
								$j--;
								break;
							}
						}
					}
					if($categoryAttributes[$k]->getName() == "Year") {
						if((isset($_GET['from_year']) && $_GET['from_year'] !== '') || (isset($_GET['to_year']) && $_GET['to_year'] !== '')) {
							$categoryAttributesValue = $categoryAttributesValuesService->getCategoryAttributesValueByAdIdAndAttributeId($ads[$j]->getAd_id(), $categoryAttributes[$k]->getAttribute_id());
							if($categoryAttributesValue === null || $categoryAttributesValue->getValue() === '') {
								unset($ads[$j]);
								$ads = array_values($ads); // update the indexes to start from 0
								$j--;
								break;
							}
							else if($_GET['from_year'] !== '' && $categoryAttributesValue->getValue() < $_GET['from_year']) {
								unset($ads[$j]);
								$ads = array_values($ads); // update the indexes to start from 0
								$j--;
								break;
							}
							else if($_GET['to_year'] !== '' && $categoryAttributesValue->getValue() > $_GET['to_year']) {
								unset($ads[$j]);
								$ads = array_values($ads); // update the indexes to start from 0
								$j--;
								break;
							}
						}
					}
				}
			}
		}
	}	
}
$noOfAdsPerPage = 10;
?>

<div id="ads-list" class="mt-4 ads-list">
	<?php
	echo '<div class="heading mb-4">'.$labels[$currentLanguageIsoCode]['Buy_sell'].' '.($category == null ? " " : " " . $category->getName()). ' '.$labels[$currentLanguageIsoCode]['Online_in'].' '. ($selectedCity == null ? "" : $selectedCity->getName() . ", ") .''.$currentCountry->getName().' • <span style="font-weight:100">' . ($ads == NULL ? "0" : count($ads)) . ' '.$labels[$currentLanguageIsoCode]['Ads'].'</span></div>';
	
	if($ads != null && $page <= ceil(count($ads)/$noOfAdsPerPage)) {	
		$startingIndex = ($page-1)*$noOfAdsPerPage;
		for($i = $startingIndex; $i < count($ads) && $i < $startingIndex + $noOfAdsPerPage; $i++){
			$adsImages = $adsImagesService->getAdImagesByAdId($ads[$i]->getAd_id());
			echo '<div class="row mb-4">
					<div class="col-lg-8 border-bottom">
					  <a href="ad-detail.php?ad_id='.$ads[$i]->getAd_id().'" class="text-reset text-decoration-none" aria-current="true">
						<div class="card pb-4" style="border:none;">
						  <div class="row g-0">
							<div class="col-md-4">';
							  if($adsImages !== NULL) {
								echo '<img src="'. $adsImages[0]->getImage_path() .'" class="img-fluid rounded-start rounded-end w-100" >';
							  } else {
								echo '<img src="resources/images/placeholder-image.png" class="card-img-top rounded-2">';
							  }
							echo '</div>
							<div class="col-md-8">
							  <div class="card-body py-0">
								<div class="row">
									<div class="col-9">
										<div class="card-title">'. $currentCountry->getCurrency(). ' ' . $ads[$i]->getPrice() .'</div>
										<p class="card-text d-inline-block mb-1 pb-1 border-bottom border-danger">'. $translate->translate($ads[$i]->getTitle(), ['target' => $currentLanguageIsoCode])['text'] .':</p>
										<p class="card-text mb-0">'. $translate->translate($ads[$i]->getDescription(), ['target' => $currentLanguageIsoCode])['text'] .'</p>';
										$today = strtotime("now");
										$date = strtotime($ads[$i]->getPosted_at());
										echo '<p class="card-text text-danger" style="font-style: bold;">'. floor(($today - $date) / (60 * 60 * 24)) .' '.$labels[$currentLanguageIsoCode]['Days'].' '.$labels[$currentLanguageIsoCode]['Ago'].'</p>
									</div>
									<div class="col-3 text-end mt-1">';
										if($ads[$i]->getAd_type() == "Featured")
											echo '<span class="badge text-bg-warning">'.$labels[$currentLanguageIsoCode]['Featured'].'</span>';
										
										$userRolesService = new UserRolesService();
										$userRoles = $userRolesService->getUserRolesByUserId($ads[$i]->getUser_id());
										$roleService = new RoleService();
										$userProfileService = new UserProfileService();
										$userProfile =$userProfileService->getUsersProfileById($ads[$i]->getUser_id());
										for($j = 0; $j < count($userRoles); $j++) {
											$role = $roleService->getRoleById($userRoles[$j]->getRole_id());
											if($role->getName() === "Dealer Seller") {
												if($userProfile->getProfile_picture() === null)
													echo '<img class="profile-image lg-only" src="resources/images/dealer-icon.png" style="-webkit-transform: rotate(30deg); -moz-transform: rotate(30deg); transform: rotate(30deg); margin-top:100%">';
												else
													echo '<img class="profile-image lg-only" src="'.$userProfile->getProfile_picture().'" style="margin-top:100%">';
												break;
											}
										}
										
									echo '</div>
								</div>
							  </div>
							</div>
						  </div>
						</div>
					  </a>
					</div>
					<div class="col-lg-4">
					
					</div>
				  </div>';
		}
		echo '<div class="row">
				<div class="col-lg-8 pb-2 text-center">
					<nav aria-label="Page navigation example">
					  <ul class="pagination justify-content-center">
						<li class="page-item">
							<a id="previous-page-link" class="page-link" href="?category_id='.$category_id.'&page='.($page-1).'" aria-label="Previous">
							  <span aria-hidden="true">&laquo;</span>
							</a>
						</li>';
						for($i = 1; $i < (count($ads)/$noOfAdsPerPage)+1; $i++){
							echo '<li class="page-item"><a class="page-link" href="?category_id='.$category_id.'&page='.$i.'">'.$i.'</a></li>';
						}
						echo '<li class="page-item">
							<a id="next-page-link" class="page-link" href="?category_id='.$category_id.'&page='.($page+1).'" aria-label="Next">
								<span aria-hidden="true">&raquo;</span>
							</a>
						</li>
					  </ul>
					</nav>
				</div>
				<div class="col-lg-4">
				
				</div>
			</div>';
	} else {
		echo '<div class="alert alert-warning p-4 mt-4" role="alert">
				<div class="row ms-0">
					<div class="col-4 col-lg-1">
						<img height="auto" width="100%" src="resources/images/info-icon.png">
					</div>
					<div class="col-8 col-lg-11">
					  <h4 class="alert-heading">'.$labels[$currentLanguageIsoCode]['We_could_not_find_any_results_matching_your_criteria'].'</h4 >
					  <div>'.$labels[$currentLanguageIsoCode]['Try_broadening_your_search_using_filters'].'</div>
					</div>
				</div>
			</div>';
	}
	?>
</div>
<script>
	var previousPageLink = document.getElementById("previous-page-link");
	var nextPageLink = document.getElementById("next-page-link");
	var currentPage = <?php echo $page; ?>;
	var lastPage = <?php echo ceil($ads === NULL ? 0 : count($ads)/$noOfAdsPerPage); ?>;
	if(previousPageLink != null && currentPage == 1)
		previousPageLink.removeAttribute("href");
	if(nextPageLink != null && currentPage == lastPage)
		nextPageLink.removeAttribute("href");
	
</script>