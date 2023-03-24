<?php
$categoryId = $_GET['category_id'];
$category = null;
$subCategories = array();
if($categoryId > 0) {
    $category = $categoryService->getCategoryById($categoryId);
    if($category->getParent_category_id() > 0) {
    	$subCategories = $categoryService->getCategoriesByParentCategoryIdAndLanguage($category->getParent_category_id(), $currentLanguageIsoCode);
    }
    else {
    	$subCategories = $categoryService->getCategoriesByParentCategoryIdAndLanguage($categoryId, $currentLanguageIsoCode);
    }
}
else {
    $subCategories = $categoryService->getCategoriesByParentCategoryIdAndLanguage(0, $currentLanguageIsoCode);
}
?>

<!-- filter bar above 768px -->
<div class="filter-md">
	<ul class="nav nav-pills nav-fill border border-3 rounded-4 filter-bar">
	  <li class="nav-item dropdown rounded-start-3">
		<a class="nav-link text-reset dropdown-toggle" data-bs-toggle="collapse" data-bs-target="#collapse-item-1">
			<div class="menu-item">
				<div><?php echo $labels[$currentLanguageIsoCode]['City']; ?></div>
				<div id="selected-city" class="selected-item"><?php echo $labels[$currentLanguageIsoCode]['All_Cities']; ?></div>
			</div>
		</a>
		<div class="collapse shadow border-1 rounded-3 p-3 filter-collapsible" id="collapse-item-1">
		  <form id="city-filter-form" method="get">
		    <?php
			if((isset($_GET['city']) && $_GET['city'] == 0) || !isset($_GET['city']))
				echo '<input type="radio" class="btn-check" name="city" id="all-cities" value="0" autocomplete="off" checked>';
			else
				echo '<input type="radio" class="btn-check" name="city" id="all-cities" value="0" autocomplete="off">';
			echo '<label class="btn btn-outline-danger mb-2" for="all-cities">'.$labels[$currentLanguageIsoCode]['All_Cities'].'</label>';
			
			$cities = $cityService->getCityByCountryId($currentCountry->getCountry_id());
			for($i = 0; $i < count($cities); $i++)
			{
				if(isset($_GET['city']) && $_GET['city'] == $cities[$i]->getCity_id_sal()) {
					echo '<input type="radio" class="btn-check" name="city" id="'.$cities[$i]->getCity_id_sal().'" value="'.$cities[$i]->getCity_id_sal().'" checked>';
					$selectedCity = $cities[$i];
				}
				else
					echo '<input type="radio" class="btn-check" name="city" id="'.$cities[$i]->getCity_id_sal().'" value="'.$cities[$i]->getCity_id_sal().'">';
				echo '<label class="btn btn-outline-danger mb-2" for="'.$cities[$i]->getCity_id_sal().'">'.$cities[$i]->getName().'</label>';
			}
			?>
			
			<hr>
			<button type="submit" class="btn btn-outline-danger" style="width: 90%;"><?php echo $labels[$currentLanguageIsoCode]['Apply_filters']; ?></button>

		  </form>
		</div>
	  </li>
	  <div class="vr my-2"></div>
	  <li class="nav-item dropdown">
		<a class="nav-link text-reset dropdown-toggle" data-bs-toggle="collapse" data-bs-target="#collapse-item-2">
			<div class="menu-item">
				<div><?php echo $labels[$currentLanguageIsoCode]['Category']; ?></div>
				<?php
				if($categoryId > 0) {
    				if($category->getParent_category_id() > 0) {
    					echo '<div id="selected-category" class="selected-item">'.$category->getName().'</div>';
    				}
    				else {
    					echo '<div id="selected-category" class="selected-item">'.$labels[$currentLanguageIsoCode]['All_in'].' '.$category->getName().'</div>';
    				}
				}
				else {
				    echo '<div id="selected-category" class="selected-item">'.$labels[$currentLanguageIsoCode]['All_Categories'].'</div>';
				}
				?>
				
			</div>
		</a>
		<div class="collapse shadow border-1 rounded-3 filter-collapsible" id="collapse-item-2" >
			<ul class="list-group" style="max-height: 240px;overflow-y:scroll;text-align: left;font-weight: bold;">
			<?php 
			if($subCategories !== NULL)
			{
				foreach ($subCategories as $value) { 
				  echo '<li class="list-group-item" style="cursor:pointer;" onclick="changeCategory('.$value->getCategory_Id().')">'.$value->getName().'</li>';
				}
			}
			?>
			</ul>
		</div>
	  </li>
	  <div class="vr my-2"></div>
	  <li class="nav-item dropdown">
		<a class="nav-link text-reset dropdown-toggle" data-bs-toggle="collapse" data-bs-target="#collapse-item-3">
			<div class="menu-item">
				<div><?php echo $labels[$currentLanguageIsoCode]['Price'] . '(' . $currentCountry->getCurrency() . ')'; ?></div>
				<div id="selected-city" class="selected-item"><?php echo $labels[$currentLanguageIsoCode]['Select']; ?></div>
			</div>
		</a>
		<div class="collapse shadow border-1 rounded-3 p-3 filter-collapsible" id="collapse-item-3">
			<form id="price-filter-form">
				<div class="row">
					<div class="col-6">
					  <label for="from-price" class="form-label"><?php echo $labels[$currentLanguageIsoCode]['From']; ?></label>
					  <input type="number" class="form-control form-control-lg" id="from-price" name="from_price" required="true" value="<?php echo (isset($_GET['from_price']) ? $_GET['from_price'] : "") ?>">
					</div>
					<div class="col-6">
					  <label for="to-price" class="form-label"><?php echo $labels[$currentLanguageIsoCode]['To']; ?></label>
					  <input type="number" class="form-control form-control-lg" id="to-price" name="to_price" value="<?php echo (isset($_GET['to_price']) ? $_GET['to_price'] : "") ?>">
					</div>
				</div>
				
				<hr>
				<div class="row">
					<div class="col-3">
						<a onclick="clearPriceFilter()" class="btn btn-outline-secondary px-4"><?php echo $labels[$currentLanguageIsoCode]['Clear']; ?></a>
					</div>
					<div class="col-9">
						<button type="submit" class="btn btn-secondary" style="background-color:#000; width: 90%;"><?php echo $labels[$currentLanguageIsoCode]['Apply_filters']; ?></button>
					</div>
				</div>
			</form>
		</div>
	  </li>
	  <!--
	  <div class="vr my-2"></div>
	  <li class="nav-item">
		<a class="nav-link text-reset dropdown-toggle">
			<div class="menu-item">
				<div class="menu-item">Year</div>
				<div id="selected-city" class="selected-item">Select</div>
			</div>
		</a>
	  </li>
	  <div class="vr my-2"></div>
	  <li class="nav-item rounded-end-3">
		<a class="nav-link text-reset dropdown-toggle">
			<div class="menu-item">
				<div class="menu-item">Filters</div>
				<div id="selected-city" class="selected-item">Kilometers, Seller Type, etc</div>
			</div>
		</a>
	  </li>
	  -->
	</ul>
</div>

<!-- filter bar below 768px -->
<div class="filter-sm">
	<ul class="list-group list-group-horizontal border-bottom pb-2 text-center" style="overflow: scroll;">
	  <li class="list-group-item border-0">
		<button class="btn btn-outline-secondary rounded-pill dropdown-toggle" type="button" data-bs-toggle="offcanvas" data-bs-target="#citiesCanvasBottom" aria-controls="citiesCanvasBottom">City</button>
	  </li>
	  <li class="list-group-item border-0">
		<button class="btn btn-outline-secondary rounded-pill dropdown-toggle" type="button" data-bs-toggle="offcanvas" data-bs-target="#categoriesCanvasBottom" aria-controls="categoriesCanvasBottom">Category</button>
	  </li>
	  <li class="list-group-item border-0">
		<button class="btn btn-outline-secondary rounded-pill dropdown-toggle" type="button" data-bs-toggle="offcanvas" data-bs-target="#priceCanvasBottom" aria-controls="priceCanvasBottom">Price</button>
	  </li>
	</ul>
</div>


<div class="offcanvas offcanvas-bottom h-auto" tabindex="-1" id="citiesCanvasBottom" aria-labelledby="citiesCanvasBottomLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="citiesCanvasBottomLabel">All Cities</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body small">
    <form id="city-filter-form2" method="get">
		<?php
		if((isset($_GET['city']) && $_GET['city'] == 0) || !isset($_GET['city']))
			echo '<input type="radio" class="btn-check" name="city" id="all-cities2" value="0" autocomplete="off" checked>';
		else
			echo '<input type="radio" class="btn-check" name="city" id="all-cities2" value="0" autocomplete="off">';
		echo '<label class="btn btn-outline-danger mb-2" for="all-cities2">All Cities</label>';
		
		//$cities = $cityService->getCityByCountryId($currentCountry->getCountry_id());
		for($i = 0; $i < count($cities); $i++)
		{
			if(isset($_GET['city']) && $_GET['city'] == $cities[$i]->getCity_id()) {
				echo '<input type="radio" class="btn-check" name="city" id="'.$cities[$i]->getCity_id().'2" value="'.$cities[$i]->getCity_id().'" checked>';
				$selectedCity = $cities[$i];
			}
			else
				echo '<input type="radio" class="btn-check" name="city" id="'.$cities[$i]->getCity_id().'2" value="'.$cities[$i]->getCity_id().'">';
			echo '<label class="btn btn-outline-danger mb-2" for="'.$cities[$i]->getCity_id().'2">'.$cities[$i]->getName().'</label>';
		}
		?>
		
		<hr>
		<button type="submit" class="btn btn-danger w-100">Apply filters</button>

	</form>
  </div>
</div>

<div class="offcanvas offcanvas-bottom h-auto" tabindex="-1" id="categoriesCanvasBottom" aria-labelledby="categoriesCanvasBottomLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="categoriesCanvasBottomLabel">All Categories</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body small">
    <ul class="list-group" style="max-height: 240px;overflow-y:scroll;text-align: left;font-weight: bold;">
	<?php 
	if($subCategories !== NULL)
	{
		foreach ($subCategories as $value) { 
		  echo '<li class="list-group-item" style="cursor:pointer;" onclick="changeCategory('.$value->getCategory_Id().')">'.$value->getName().'</li>';
		}
	}
	?>
	</ul>
  </div>
</div>

<div class="offcanvas offcanvas-bottom h-auto" tabindex="-1" id="priceCanvasBottom" aria-labelledby="priceCanvasBottomLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="priceCanvasBottomLabel">Price Range</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body small">
    <form id="price-filter-form2">
		<div class="row">
			<div class="col-6">
			  <label for="from-price" class="form-label">From</label>
			  <input type="number" class="form-control form-control-lg" id="from-price" name="from_price" required="true" value="<?php echo (isset($_GET['from_price']) ? $_GET['from_price'] : "") ?>">
			</div>
			<div class="col-6">
			  <label for="to-price" class="form-label">To</label>
			  <input type="number" class="form-control form-control-lg" id="to-price" name="to_price" value="<?php echo (isset($_GET['to_price']) ? $_GET['to_price'] : "") ?>">
			</div>
		</div>
		
		<hr>
		<div class="d-flex">
			<div  style="">
				<a onclick="clearPriceFilter()" class="btn btn-outline-secondary px-4">Clear</a>
			</div>
			<div class="ms-2" style="flex-grow:1">
				<button type="submit" class="btn btn-secondary w-100">Apply filters</button>
			</div>
		</div>
	</form>
  </div>
</div>



<script>
	
	var filterCollapsible = document.getElementsByClassName('filter-collapsible');
	document.addEventListener('click', function(event){
		for(var i = 0; i < filterCollapsible.length; i++)
		{
			if (!filterCollapsible[i].contains(event.target)) 
				filterCollapsible[i].classList.remove("show");
		}
	});
	
	document.getElementById("city-filter-form").addEventListener("submit", function(event) {
		var url = window.location.href;

		var currentSearchParams = new URLSearchParams(window.location.search);
		currentSearchParams.delete("city");
		url = url.split('?')[0] + '?' + currentSearchParams.toString();

		var formData = new FormData(this);
		var searchParams = new URLSearchParams(formData).toString();
		if(searchParams !== "")
			url = url + "&" + searchParams;

		window.location.href = url;
		event.preventDefault();
	});
	
	document.getElementById("city-filter-form2").addEventListener("submit", function(event) {
		var url = window.location.href;

		var currentSearchParams = new URLSearchParams(window.location.search);
		currentSearchParams.delete("city");
		url = url.split('?')[0] + '?' + currentSearchParams.toString();

		var formData = new FormData(this);
		var searchParams = new URLSearchParams(formData).toString();
		if(searchParams !== "")
			url = url + "&" + searchParams;

		window.location.href = url;
		event.preventDefault();
	});
	
	document.getElementById("price-filter-form").addEventListener("submit", function(event) {
		var url = window.location.href;

		var currentSearchParams = new URLSearchParams(window.location.search);
		currentSearchParams.delete("from_price");
		currentSearchParams.delete("to_price");
		url = url.split('?')[0] + '?' + currentSearchParams.toString();

		var formData = new FormData(this);
		var searchParams = new URLSearchParams(formData).toString();
		if(searchParams !== "")
			url = url + "&" + searchParams;
		
		window.location.href = url;
		event.preventDefault();
	});
	
	document.getElementById("price-filter-form2").addEventListener("submit", function(event) {
		var url = window.location.href;

		var currentSearchParams = new URLSearchParams(window.location.search);
		currentSearchParams.delete("from_price");
		currentSearchParams.delete("to_price");
		url = url.split('?')[0] + '?' + currentSearchParams.toString();

		var formData = new FormData(this);
		var searchParams = new URLSearchParams(formData).toString();
		if(searchParams !== "")
			url = url + "&" + searchParams;
		
		window.location.href = url;
		event.preventDefault();
	});
	
	function changeCategory(categoryId) {
		var url = window.location.href;

		var currentSearchParams = new URLSearchParams(window.location.search);
		currentSearchParams.delete("category_id");
		url = url.split('?')[0] + '?' + currentSearchParams.toString();
		
		var searchParams = "category_id=" + categoryId;
		url = url + "&" + searchParams;

		window.location.href = url;
	}
	
	function clearPriceFilter() {
		document.getElementById("from-price").value = "0";
		document.getElementById("to-price").value = "";
	}
</script>