<div class="container mt-5">
	<div class="row">
		<div class="col-lg-4 offset-lg-4">
			<div class="heading text-center "><?php echo $labels[$currentLanguageIsoCode]['You_are_there']; ?></div>
			<div class="row py-3">
				<div style="color:#777;"><?php echo $labels[$currentLanguageIsoCode]['Include_details_pictures_and_set_right_price']; ?></div>
			</div>
			<?php 
			$category_id = $_GET["category_id"];
			$category_id_sal = $_GET["category_id_sal"];
			if($user->getMembership_plan_id() !== null && $user->getMembership_plan_id() > 0) {	
				echo '<form action="submit-ad.php?category_id='.$category_id.'&category_id_sal='.$category_id_sal.'" method="POST" enctype="multipart/form-data" style="margin-bottom: 90px;"> ';
			}
			else {
				echo '<form action="membership-plan.php?category_id='.$category_id.'&category_id_sal='.$category_id_sal.'" method="POST" enctype="multipart/form-data" style="margin-bottom: 90px;"> ';
			}
			?>
				<div class="form-floating mb-3">
					<input type="text" class="form-control px-4 form-field" id="adTitle" name="title" placeholder="<?php echo $labels[$currentLanguageIsoCode]['Title']; ?>">
					<label class="px-4" for="adTitle"><?php echo $labels[$currentLanguageIsoCode]['Title']; ?></label>
				</div>
				<div class="mb-3">
					<input class="form-control form-field" type="file" name="images[]" value="Upload" accept="image/*" multiple>
				</div>
				<?php
				
			    $userPhoneNumber = null;
			    $userCountry = null;
			    if(!is_null($user->getPhone())) {
			        $userPhoneNumber = substr($user->getPhone(), -10);
			        $userDialingCode = substr($user->getPhone(), 0, -10);
				    if($userDialingCode == $currentCountry->getDialing_code()) {
				        $userCountry = $currentCountry;
				    } else {
				        $userCountry = $countryService->getCountryByDialingCode($userDialingCode);
						if($userCountry === null)
							$userCountry = $currentCountry;
				    }
			    }
			    else {
			        $userCountry = $currentCountry;
			    }
				?>
				<div class="input-group mb-3">
					<span type="button" class="input-group-text dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
						<span id="countryFlag" class="<?php echo $userCountry->getFlag(); ?>" style="font-size:20px;"></span> 
						<span id="dialingCode" style="height: 80%; margin-left: 5px;"> <?php echo $userCountry->getDialing_code(); ?></span>
						<input id="dialingCodeField" type="hidden" name="dialingCode" value="<?php echo $userCountry->getDialing_code(); ?>">
					</span>	
					<ul class="dropdown-menu" style="min-width:15px;">
						<?php
							$countries = $countryService->getAllCountries($currentLanguageIsoCode);
						  	for($i=0; $i<count($countries); $i++){
								echo '<li><a class="dropdown-item" style="cursor:pointer;" onclick="updateDialingCode(\''. $countries[$i]->getDialing_code() .'\',\''. $countries[$i]->getFlag() .'\')"><span class="'. $countries[$i]->getFlag() .'" style="font-size:20px;"></span> '. $countries[$i]->getDialing_code() .'</a></li>';
						  	}
						?>
					</ul>
					<input type="text" name="phonenumber" class="form-control px-4 form-field" placeholder="Phone*" value="<?php echo $userPhoneNumber; ?>" required>
				</div>
				<div class="mb-3">
					<input type="number" name="price" class="form-control px-4 form-field" placeholder="<?php echo $labels[$currentLanguageIsoCode]['Price']; ?>" style="direction:<?php echo $currentLanguageDirection; ?>">
				</div>
				<div class="mb-3">
					<textarea class="form-control" name="description" placeholder="<?php echo $labels[$currentLanguageIsoCode]['Describe_your_item']; ?>" rows="10"></textarea>
				</div>
				
				<?php
					$categoryAttributes = array();
					while($category_id != 0){
						$categoryAttributesTemp = $categories_attributesService->getCategoriesAttributesByCategoryId($category_id);
						if($categoryAttributesTemp !== NULL) {
							$categoryAttributes = array_merge($categoryAttributes, $categoryAttributesTemp);
						}
						$category = $categoryService->getCategoryById($category_id);
						$category_id = $category->getParent_category_id();
					}
					if($categoryAttributes !== NULL){
						for($i=0; $i<count($categoryAttributes) && $i < 24; $i++){
							$elementType = $categoryAttributes[$i]->getElement_type();
							
							if($elementType == 'Text'){
								echo "<div class='mb-3'>
										<input type='text' name='".$categoryAttributes[$i]->getAttribute_id()."' class='form-control px-4 form-field' placeholder='".$categoryAttributes[$i]->getName()."'>
									</div>";
							}
							else if($elementType == 'Number'){
								echo '<div class="mb-3">
										<input type="number" name="'. $categoryAttributes[$i]->getAttribute_id() .'" class="form-control px-4 form-field" placeholder="'. $categoryAttributes[$i]->getName() .'">
									</div>';
							}
							else if($elementType == 'Boolean'){
								echo '<div class="form-check mb-3">
										<input class="form-check-input" type="checkbox" value="'. $categoryAttributes[$i]->getName() .'" name="'. $categoryAttributes[$i]->getAttribute_id() .'">
										<label class="form-check-label" for="'. $categoryAttributes[$i]->getName() .'">'. $categoryAttributes[$i]->getName() .'</label>
							  		</div>';
							}
							else if($elementType == 'Dropdown'){
								$attribute_id = $categoryAttributes[$i]->getAttribute_id();
								$categoryAttributesOptionsService = new CategoryAttributesOptionsService();
								$categoryAttributesOptions = $categoryAttributesOptionsService->getCategoryAttributesOptionsByAttributeId($attribute_id);
								echo '<div class="form-floating mb-3">
										<select id="'.$categoryAttributes[$i]->getName().'" class="form-select px-4 form-field" name="'. $categoryAttributes[$i]->getAttribute_id() .'">';
										echo '<option value="">'.$labels[$currentLanguageIsoCode]['Select_One'].'</option>';
										if($categoryAttributesOptions !== NULL) {
											for($j=0; $j<count($categoryAttributesOptions); $j++){
												echo '<option value="'. $categoryAttributesOptions[$j]->getOption_value() .'">'. $categoryAttributesOptions[$j]->getOption_value() .'</option>';
											}
										}
							  			echo '</select>
										<label class="px-4" for="'.$categoryAttributes[$i]->getName().'">'.$categoryAttributes[$i]->getName().'</label>
									</div>';
							}
							
						}
						if(count($categoryAttributes) >= 24) {
        				    echo '<p><a class="btn btn-outline-danger btn-sm" data-bs-toggle="collapse" href="#additionalFeaturesCollapse" role="button" aria-expanded="false" aria-controls="additionalFeaturesCollapse">View Additional Features</a></p>
        				    <div class="row">
                                <div class="col">
                                  <div class="collapse multi-collapse" id="additionalFeaturesCollapse">
                                    <div class="card card-body">';
            						for($i=24; $i<count($categoryAttributes); $i++){
            						    $elementType = $categoryAttributes[$i]->getElement_type();
        						        if($elementType == 'Text') {
            								echo "<div class='mb-3'>
            										<input type='text' name='".$categoryAttributes[$i]->getAttribute_id()."' class='form-control px-4 form-field' placeholder='".$categoryAttributes[$i]->getName()."'>
            									</div>";
            							}
            							else if($elementType == 'Number') {
            								echo '<div class="mb-3">
            										<input type="number" name="'. $categoryAttributes[$i]->getAttribute_id() .'" class="form-control px-4 form-field" placeholder="'. $categoryAttributes[$i]->getName() .'">
            									</div>';
            							}
            							else if($elementType == 'Boolean') {
            								echo '<div class="form-check mb-3">
            										<input class="form-check-input" type="checkbox" value="'. $categoryAttributes[$i]->getName() .'" name="'. $categoryAttributes[$i]->getAttribute_id() .'">
            										<label class="form-check-label" for="'. $categoryAttributes[$i]->getName() .'">'. $categoryAttributes[$i]->getName() .'</label>
            							  		</div>';
            							}
            							else if($elementType == 'Dropdown') {
            								$attribute_id = $categoryAttributes[$i]->getAttribute_id();
            								$categoryAttributesOptionsService = new CategoryAttributesOptionsService();
            								$categoryAttributesOptions = $categoryAttributesOptionsService->getCategoryAttributesOptionsByAttributeId($attribute_id);
            								echo '<div class="form-floating mb-3">
            										<select id="'.$categoryAttributes[$i]->getName().'" class="form-select px-4 form-field" name="'. $categoryAttributes[$i]->getAttribute_id() .'">';
            										echo '<option value="">'.$labels[$currentLanguageIsoCode]['Select_One'].'</option>';
            										if($categoryAttributesOptions !== NULL) {
            											for($j=0; $j<count($categoryAttributesOptions); $j++){
            												echo '<option value="'. $categoryAttributesOptions[$j]->getOption_value() .'">'. $categoryAttributesOptions[$j]->getOption_value() .'</option>';
            											}
            										}
            							  			echo '</select>
            										<label class="px-4" for="'.$categoryAttributes[$i]->getName().'">'.$categoryAttributes[$i]->getName().'</label>
            									</div>';
            							}
            						}
        				            echo '</div>
        				            </div>
                                </div>
                            </div>';
						}
					}
				?>
				<!-- Create the map container -->
				<div class="mb-3">
					<label class="form-label" style="font-weight: bold;" for="map"><?php echo $labels[$currentLanguageIsoCode]['Please_select_Location_on_Map']; ?></label>
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
				<!-- Add the latitude and longitude input fields -->
				<div class="mb-3">
					<input type="hidden" class="form-control px-4 form-field" id="latitude" name="latitude" placeholder="latitude">
				</div> 
				<div class="mb-3">
					<input type="hidden" class="form-control px-4 form-field" id="longitude" name="longitude" placeholder="longitude">
				</div>
				<div class="mb-3 form-floating">
					<input type="text" class="form-control px-4 form-field" id="address" name="address" placeholder="<?php echo $labels[$currentLanguageIsoCode]['Address'] . ", " . $labels[$currentLanguageIsoCode]['Area'] . ", " . $labels[$currentLanguageIsoCode]['Town']; ?>" required="true">
					<label class="px-4" for="address"><?php echo $labels[$currentLanguageIsoCode]['Address']; ?></label>
				</div>
				<div class="mb-3 form-floating">
					<select class="form-select px-4 form-field" id="city" name="city-id" placeholder="Dubai" required="true">
					<?php
					$cityService = new CityService(); 
					$cities = $cityService->getCityByCountryId($currentCountry->getCountry_id());
					echo "<option value=''>".$labels[$currentLanguageIsoCode]['Select_One']."</option>";
					for($i=0; $i<count($cities); $i++){
						echo '<option value="'. $cities[$i]->getCity_id() .'">'. $cities[$i]->getName() .'</option>';
					}
					?>
					</select>
					<label class="px-4" for="city"><?php echo $labels[$currentLanguageIsoCode]['City']; ?></label>
				</div>
				
				<div class="mb-3 form-floating">
					<select class="form-select px-4 form-field" id="country" name="country-id">
						<?php echo '<option value="'.$currentCountry->getCountry_Id().'">'.$currentCountry->getName().'</option>'; ?>
					</select>
					<label class="px-4" for="country"><?php echo $labels[$currentLanguageIsoCode]['Country']; ?></label>
				</div>
				<input type="hidden" class="form-control px-4 form-field" id="country-id-sal" name="country-id-sal" value="<?php echo $currentCountry->getCountry_Id_sal(); ?>">
				
				<div class="row ad-submit-button-row">
					<div class="col-lg-4">
					<?php
					if($user->getMembership_plan_id() !== null && $user->getMembership_plan_id() > 0) {
						echo '<button type="submit" class="btn btn-danger btn-theme" style="width:100%;">Submit</button>';
					}
					else {
						echo '<button type="submit" class="btn btn-danger btn-theme" style="width:100%;">Next</button>';
					}
					?>
					</div>
				</div>
				
			</form>
			<!-- Add the JavaScript to initialize the map and handle user interaction -->
			<script type="text/javascript">
				let marker, circle;
			  
				var map = L.map('map').setView([25.2048, 55.2708], 13);
				var osmLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
					attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
				  }).addTo(map);
				marker = L.marker([25.2048, 55.2708]).addTo(map);
			  
				function setAddressDetails(lat, lng) {
					var nominatimUrl = "https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=" + lat + "&lon=" + lng;
					// send a request to Nominatim API
					var xhr = new XMLHttpRequest();
					xhr.open("GET", nominatimUrl, true);
	  				xhr.setRequestHeader("Content-Type", "application/json");
					xhr.onreadystatechange = function () {
						if (this.readyState == 4 && this.status == 200) {
							var data = JSON.parse(this.responseText);
							var city = data.address.city;
							var country = data.address.country;
							
							// compiling address
							var address = "";
							if(typeof data.address.house_number !== 'undefined')
								address += data.address.house_number + ", ";
							if(typeof data.address.shop !== 'undefined')
								address += data.address.shop + ", ";
							if(typeof data.address.residential !== 'undefined')
								address += data.address.residential + ", ";
							if(typeof data.address.amenity !== 'undefined')
								address += data.address.amenity + ", ";
							if(typeof data.address.building !== 'undefined')
								address += data.address.building + ", ";
							if(typeof data.address.road !== 'undefined')
								address += data.address.road + ", ";
							if(typeof data.address.neighbourhood !== 'undefined')
								address += data.address.neighbourhood + ", ";
							if(typeof data.address.suburb !== 'undefined')
								address += data.address.suburb;
							
							document.getElementById('mapBlockShield').style.display = "none";
							
							// setting address
							document.getElementById('address').value = address;
							
							// setting city
							if(typeof city !== 'undefined') {
								var cityElement = document.getElementById('city');
								for (var i = 0; i < cityElement.options.length; i++) {
								  var option = cityElement.options[i];
								  if(option.text == city) {
									  cityElement.value = option.value;
								  }
								}
							}
						}
					}
					xhr.send();
				}
				
			    function setPositionInMap(position) {
					  var lat = position.coords.latitude;
					  var lng = position.coords.longitude;
					  var accuracy = position.coords.accuracy;
					  //map.setView([lat, lng], 12);
					  if(marker) {
						  map.removeLayer(marker);
						  if(circle)
							map.removeLayer(circle);
					  }
					  marker = L.marker([lat, lng]).addTo(map);
					  circle = L.circle([lat, lng], {radius: accuracy}).addTo(map);
					  map.fitBounds(circle.getBounds());
					  document.getElementById('latitude').value = lat;
					  document.getElementById('longitude').value = lng;
					  setAddressDetails(lat, lng);
				}
				
			    function onMapClick(e) {
					document.getElementById('mapBlockShield').style.display = "block";
					if(marker) {
						map.removeLayer(marker);
						if(circle)
							map.removeLayer(circle);
					}
					marker = L.marker(e.latlng).addTo(map);
					document.getElementById('latitude').value = e.latlng.lat;
					document.getElementById('longitude').value = e.latlng.lng;
					setAddressDetails(e.latlng.lat, e.latlng.lng);
			    }
				
				if (navigator.geolocation) {
					navigator.geolocation.getCurrentPosition(setPositionInMap);
				} else {
					console.log("Geolocation is not supported by this browser.");
				}
				
				map.on('click', onMapClick);
			</script>
		</div>
	</div>
</div>
<script>
	function updateDialingCode(dialingCode, countryFlag){
		var dialingCodeElement = document.getElementById("dialingCode");
		var countryFlagElement = document.getElementById("countryFlag");
		var dialingCodeFieldElement = document.getElementById("dialingCodeField");
		dialingCodeElement.innerHTML = dialingCode;
		countryFlagElement.className = countryFlag;
		dialingCodeFieldElement.value = dialingCode;
	}
</script>