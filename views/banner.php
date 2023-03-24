<div class="jumbotron banner">
	<div class="banner-content mx-auto">
		<h1 class="heading-title"><?php echo $labels[$currentLanguageIsoCode]['Find_Your_Perfect_Car']; ?></h1>
		<div class="mb-5 search-form-div">
			<form class="search-form" action="ads.php" method="GET">
				<div class="row">
					<div class="col-lg-6">
						<select class="form-select form-select-lg mb-3" name="city">
						<?php
							$cities = $cityService->getCityByCountryId($currentCountry->getCountry_id());
							echo '<option value="0" selected>'.$labels[$currentLanguageIsoCode]['All_Cities'].'</option>';
						  	for($i=0; $i<count($cities); $i++){
								echo '<option value="'. $cities[$i]->getCity_id() .'">'. $cities[$i]->getName() .'</option>';
						  	}
						?>
						</select>
					</div>
					<div class="col-lg-6">
						<select id="banner-categories-dropdown" class="form-select form-select-lg mb-3" onchange="toggleDynamicSearchAttributes();" name="category_id">
						<?php
							echo '<option value="0" selected>'.$labels[$currentLanguageIsoCode]['Motors'].'</option>';
							$categoriesAttributesService = new CategoriesAttributesService();
							$allCategoriesAttributes = array();
						    $categories = $categoryService->getCategoriesByParentCategoryIdAndLanguage(0, $currentLanguageIsoCode);
						  	for($i=0; $i<count($categories); $i++) {
								echo '<option value="'. $categories[$i]->getCategory_id() .'">'. $categories[$i]->getName() .'</option>';
								$categoryAttributes = $categoriesAttributesService->getCategoriesAttributesByCategoryId($categories[$i]->getCategory_id());
								if($categoryAttributes != null)
									array_push($allCategoriesAttributes, $categoryAttributes);
						  	}
						?>
						</select>
					</div>
				</div>
				
				<?php 
				for($i = 0; $i < count($allCategoriesAttributes); $i++) {
					echo '<div id="dynamic-search-attributes-for-'.$categories[$i]->getCategory_id().'" class="row dynamic-search-attributes">';
					for($j = 0; $j < count($allCategoriesAttributes[$i]) && $j < 2; $j++) {
						echo '<div class="col-lg-6">
								<select class="form-select form-select-lg mb-3" name="'.$allCategoriesAttributes[$i][$j]->getName().'">
									<option value="" selected>'.$labels[$currentLanguageIsoCode]['All'].' '.$allCategoriesAttributes[$i][$j]->getName().'</option>';
									if($allCategoriesAttributes[$i][$j]->getElement_type() === "Dropdown")	{
										$categoryAttributesOptionsService = new CategoryAttributesOptionsService();
										$categoryAttributesOptions = $categoryAttributesOptionsService->getCategoryAttributesOptionsByAttributeId($allCategoriesAttributes[$i][$j]->getAttribute_id());
										if($categoryAttributesOptions !== null) {
											foreach($categoryAttributesOptions as $option) {
												echo '<option value="'.$option->getOption_value().'">'.$option->getOption_value().'</option>';
											}
										}
									}
								echo '</select>
							</div>';
					}
					echo '</div>';
				}
				?>
				
				<div class="row mt-3">
					<div class="col-lg-4 <?php echo ($currentLanguageDirection === "rtl" ? "text-end" : "text-start"); ?>">
						<label class="form-label"><?php echo $labels[$currentLanguageIsoCode]['Price'] . " (" . $currentCountry->getCurrency() . ")"; ?></label>
						<div class="row">
							<div class="col-lg-6">
								<input class="form-control form-control-lg mb-3" type="text" placeholder="<?php echo $labels[$currentLanguageIsoCode]['Price_From']; ?>" name="from_price">
							</div>
							<div class="col-lg-6">
								<input class="form-control form-control-lg mb-3" type="text" placeholder="<?php echo $labels[$currentLanguageIsoCode]['Price_To']; ?>" name="to_price">
							</div>
						</div>
					</div>
					
					<div class="col-lg-4 <?php echo ($currentLanguageDirection === "rtl" ? "text-end" : "text-start"); ?>">
						<label class="form-label"><?php echo $labels[$currentLanguageIsoCode]['Year']; ?></label>
						<div class="row">
							<div class="col-lg-6">
								<input class="form-control form-control-lg mb-3" type="text" placeholder="<?php echo $labels[$currentLanguageIsoCode]['Year_From']; ?>" name="from_year">
							</div>
							<div class="col-lg-6">
								<input class="form-control form-control-lg mb-3" type="text" placeholder="<?php echo $labels[$currentLanguageIsoCode]['Year_To']; ?>" name="to_year">
							</div>
						</div>
					</div>
					<div class="col-lg-4 <?php echo ($currentLanguageDirection === "rtl" ? "text-end" : "text-start"); ?>">
						<label class="form-label"><?php echo $labels[$currentLanguageIsoCode]['KM']; ?></label>
						<div class="row">
							<div class="col-lg-6">
								<input class="form-control form-control-lg mb-3" type="text" placeholder="<?php echo $labels[$currentLanguageIsoCode]['KM_From']; ?>" name="from_km">
							</div>
							<div class="col-lg-6">
								<input class="form-control form-control-lg mb-3" type="text" placeholder="<?php echo $labels[$currentLanguageIsoCode]['KM_To']; ?>" name="to_km">
							</div>
						</div>
					</div>
					
				</div>
				<hr class="my-4">
				<div class="row"> 
					<div class="col-lg-10">
						<input class="form-control form-control-lg mb-3" type="text" placeholder="<?php echo $labels[$currentLanguageIsoCode]['Search_for_anything']; ?>">
					</div>
					<div class="col-lg-2">
						<button type="submit" class="btn btn-outline-danger btn-lg mb-3"><i class="fas fa-search"></i> <?php echo $labels[$currentLanguageIsoCode]['Search']; ?></button>
					</div>
				</div>
			</form>
			<div class="search-form-div-mask-bottom"></div>
		</div>
	</div>
</div>
<script>
function toggleDynamicSearchAttributes() {
	var bannerCategoriesDropdown = document.getElementById('banner-categories-dropdown');
	<?php
	for($i=0; $i<count($categories); $i++) {
		echo "document.getElementById('dynamic-search-attributes-for-".$categories[$i]->getCategory_id()."').style.display = 'none';";
	}
	?>
	if(document.getElementById('dynamic-search-attributes-for-' + bannerCategoriesDropdown.value) != null)
		document.getElementById('dynamic-search-attributes-for-' + bannerCategoriesDropdown.value).style.display = 'flex';
}
</script>