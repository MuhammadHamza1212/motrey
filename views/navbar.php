<script>
    var body = document.body;

    // Loop through all child nodes of the body
    for (var i = 0; i < body.childNodes.length; i++) {
      var node = body.childNodes[i];
      if (node.nodeType === Node.TEXT_NODE || node.tagName === 'B' || node.tagName === 'BR') {
            if(node.tagName == 'NAV')
                break;
            node.remove(); i--;
      }
    }
</script>
<nav class="navbar navbar-expand-lg px-3 py-3" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">
		<img src="resources/images/logo.png" width="130" height="auto"/>
	</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" style="background-color:white;">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <?php echo '<ul class="navbar-nav '.($currentLanguageDirection === "rtl" ? "ms-auto" : "me-auto").' mb-2 mb-lg-0">'; ?>
        <li class="nav-item dropdown mx-2 mx-lg-3">
          <?php
		  echo '<a class="nav-link dropdown-toggle countries" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><span class="'.$currentCountry->getFlag().'" style="font-size:20px;"></span> </a>';
		  echo '<ul class="dropdown-menu '.($currentLanguageDirection === "rtl" ? "text-end" : "").'">';
			$countries = $countryService->getAllCountries($currentLanguageIsoCode);
			foreach ($countries as $country) { 
				echo '<li><a class="dropdown-item" onclick="setCurrentCountryCookie(\''.$country->getIso_code().'\');" style="cursor:pointer;"><span class="'.$country->getFlag().'" style="font-size:20px;"></span> '.$country->getName().'</a></li>';
			}
          echo '</ul>';
		  ?>
        </li>
		<!-- <li class="nav-item dropdown mx-2 mx-lg-3">
          <a class="nav-link dropdown-toggle languages" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
             <i class="fas fa-globe" style="font-size:20px;"></i>
          </a>
          <?php echo '<ul class="dropdown-menu '.($currentLanguageDirection === "rtl" ? "text-end" : "").'">'; ?>
            <li><a class="dropdown-item" onclick="setCurrentLanguageCookie('ar', 'rtl');" style="cursor:pointer"><span class="fi fi-ae" style="font-size:20px;"></span> <?php echo $labels[$currentLanguageIsoCode]['Arabic']; ?></a></li>
            <li><a class="dropdown-item" onclick="setCurrentLanguageCookie('en', 'ltr');" style="cursor:pointer"><span class="fi fi-gb" style="font-size:20px;"></span> <?php echo $labels[$currentLanguageIsoCode]['English']; ?></a></li>
		  </ul>
        </li> -->
		<li class="nav-item mx-2 mx-lg-3">
  <a class="nav-link languages" href="#">
    <i class="fas fa-globe" style="font-size:20px;"></i>
  </a>
  <?php echo '<ul class="'.($currentLanguageDirection === "rtl" ? "text-end" : "").'">'; ?>
    <li><a class="language-link" onclick="setCurrentLanguageCookie('ar', 'rtl');" style="cursor:pointer"><span class="fi fi-ae" style="font-size:20px;"></span> <?php echo $labels[$currentLanguageIsoCode]['Arabic']; ?></a></li>
    <li><a class="language-link" onclick="setCurrentLanguageCookie('en', 'ltr');" style="cursor:pointer"><span class="fi fi-gb" style="font-size:20px;"></span> <?php echo $labels[$currentLanguageIsoCode]['English']; ?></a></li>
  </ul>
</li>
		<li class="nav-item dropdown mx-2 mx-lg-3">
		  <a class="nav-link dropdown-toggle category" role="button" data-bs-auto-close="outside" data-bs-toggle="dropdown" aria-expanded="false"><?php echo $labels[$currentLanguageIsoCode]['Motors']; ?></a>
          <ul class="dropdown-menu categories">

		    <?php
			$categories = $categoryService->getCategoriesByParentCategoryIdAndLanguage(0, $currentLanguageIsoCode);
		    foreach ($categories as $value) { 
				echo '<li class="'.($currentLanguageDirection === "rtl" ? "dropstart text-end" : "dropend").' px-3" style="position: unset;">
						<a class="dropdown-item dropdown-toggle category-link" data-bs-auto-close="outside" data-bs-toggle="dropdown" href="#"> ' . $value->getName() . ' </a>
						<ul class="dropdown-menu sub-categories items-ui '.($currentLanguageDirection === "rtl" ? "text-end" : "").'">
							<li>
								<div class="px-3 py-1" style="display: block, color:red">
									<div class="row">
										<div class="col-8 pe-0">' . $value->getName() . '</div>
										<div class="col-4 ps-0 text-end"><a class="text-reset text-decoration-none view-all-link" href="ads.php?category_id='.$value->getCategory_id().'">'.$labels[$currentLanguageIsoCode]['View_All'].'</a></div>
									</div>
								</div>
							</li>
							<li><hr class="dropdown-divider"></li>';
							$subCategories = $categoryService->getCategoriesByParentCategoryId($value->getCategory_id());
							if(!is_null($subCategories)) {
								echo '<div class="row">';
								for($x = 1; $x <= (count($subCategories)/10)+1; $x++) {
								  echo '<div class="col-lg-6">';
								  for ($y = ($x-1)*10; $y < ($x*10) && $y < count($subCategories); $y++) {
									  echo '<li><a class="dropdown-item" style="white-space: pre-wrap;" href="ads.php?category_id='.$subCategories[$y]->getCategory_id().'">' . $subCategories[$y]->getName() . '</a></li>';
								  }
								  echo '</div>';
								}
								echo '</div>';
							}
						echo '</ul>
					</li>';
            }
			?>
			<li><hr class="dropdown-divider"></li>
			<?php 
			echo '<li class="'.($currentLanguageDirection === "rtl" ? "text-end" : "").' mt-3 px-3">
				<a class="dropdown-item" >'.$labels[$currentLanguageIsoCode]['Looking_to_sell_your_car?'].'</a>
			</li>';
			?>
          </ul>
        </li>
		<li class="nav-item mx-2 mx-lg-3">
          <a class="nav-link" href="#"><?php echo $labels[$currentLanguageIsoCode]['Contact_Us']; ?></a>
        </li>
		<li class="nav-item mx-2 mx-lg-3">
          <a class="nav-link" href="faqs.php"><?php echo $labels[$currentLanguageIsoCode]['FAQs']; ?></a>
        </li>
      </ul>
	  <ul class="navbar-nav mb-2 mb-lg-0">
	    <li class="nav-item mx-2 mb-2 mx-lg-3">
		  <a class="nav-link py-0 text-center" style="display:inline-block">
			<i class="fa fa-bell" style="color:white; font-size:22px;"></i>
			<span class="d-lg-block ms-2 ms-lg-0"><?php echo $labels[$currentLanguageIsoCode]['Notifications']; ?></span>
		  </a>
		</li>
		<li class="nav-item mx-2 mb-2 mx-lg-3">
			<?php
			if (isset($_SESSION['username'])) {
			    echo '<a class="nav-link py-0 text-center" style="display:inline-block" href="my-favorites.php">
					<i class="fa fa-heart" style="color:white; font-size:22px;"></i>
					<span class="d-lg-block ms-2 ms-lg-0">'. $labels[$currentLanguageIsoCode]['Favourites'] .'</span>
				</a>';
			} 
			else {
				echo '<a class="nav-link py-0 text-center" style="display:inline-block" type="button" data-bs-toggle="modal" data-bs-target="#loginModal">
					<i class="fa fa-heart" style="color:white; font-size:22px;"></i>
					<span class="d-lg-block ms-2 ms-lg-0">'. $labels[$currentLanguageIsoCode]['Favourites'] .'</span>
				</a>';
			}
			?>
		  
		</li>
	    <li class="nav-item mx-2 mb-2 ms-lg-3 me-lg-4">
			<?php
			if (isset($_SESSION['username'])) {
			    echo '<a class="nav-link py-0 text-center d-inline-block" href="my-ads.php">
					<i class="fa fa-ad" style="color:white; font-size:22px;"></i>
					<span class="d-lg-block ms-2 ms-lg-0">'. $labels[$currentLanguageIsoCode]['My_Ads'] .'</span>
			    </a>';
			} 
			else {
				echo '<a class="nav-link py-0 text-center d-inline-block" type="button" data-bs-toggle="modal" data-bs-target="#loginModal">
					<i class="fa fa-ad" style="color:white; font-size:22px;"></i>
					<span class="d-lg-block ms-2 ms-lg-0">'. $labels[$currentLanguageIsoCode]['My_Ads'] .'</span>
				</a>';
			}
			?>
		</li>
		<li class="nav-item dropdown mb-2 mx-2 mx-lg-3">
			<?php
			if (isset($_SESSION['username'])) {
				echo '<a class="btn btn-dark dropdown-toggle d-inline-block user-account-btn" data-bs-toggle="dropdown" aria-expanded="false">
						'.$_SESSION['username'].'
					  </a>
					  <ul class="dropdown-menu dropdown-menu-dark">
						<li><a class="dropdown-item" href="my-profile.php">'.$labels[$currentLanguageIsoCode]['My_Profile'].'</a></li>
						<li><a class="dropdown-item" href="sign-out.php">'.$labels[$currentLanguageIsoCode]['Sign_Out'].'</a></li>
					  </ul>';
			} 
			else {
				echo '<a class="nav-link btn d-inline-block" type="button" data-bs-toggle="modal" data-bs-target="#loginModal">'.$labels[$currentLanguageIsoCode]['Log_in_or_Sign_up'].'</a>';
			}
			?>
		</li>
		<li class="nav-item mx-2 mx-lg-3">
			<?php
			if (isset($_SESSION['username'])) {
				echo '<a href="place-an-ad.php?category_id=0" class="btn btn-outline-danger px-4 nav-link btn-place " style="padding-top: 11px; padding-bottom:11px;border:2px solid #dc3545 !important;">
						<i style="font-size: 14px; margin-right:4px;" class="fas fa-plus"></i> '.$labels[$currentLanguageIsoCode]['Place_an_Ad'].'
					  </a>';
			} else {
				echo '<a type="button" data-bs-toggle="modal" data-bs-target="#loginModal" class="btn btn-outline-danger px-4 nav-link" style="padding-top: 11px; padding-bottom:11px; border:2px solid  #dc3545!important;">
						<i style="font-size: 14px; margin-right:4px;" class="fas fa-plus"></i> '.$labels[$currentLanguageIsoCode]['Place_an_Ad'].'
					  </a>';
			}
			?>
		</li>
	  </ul>
    </div>
  </div>
</nav>

<!--
<nav class="navbar bg-body-tertiary fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Offcanvas navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Offcanvas</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Dropdown
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </li>
        </ul>
        <form class="d-flex mt-3" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </div>
</nav>

-->

<!-- login-register modal start -->
<?php include 'views/login-register-modals.php'; ?>
<!-- login-register modal end -->

<script>
	function setCurrentCountryCookie(isoCode) {
		// Calculating the expiry date of cookie (30 days from now)
		var d = new Date();
		d.setTime(d.getTime() + (30 * 24 * 60 * 60 * 1000));
		
		// Setting cookie
		document.cookie = "currentCountryIsoCode=" + isoCode + "; expires=" + d.toUTCString() + "; path=/;";
		
		// Reload from server
		location.reload(true); 
	}
	
	function setCurrentLanguageCookie(isoCode, direction) {
		// Calculating the expiry date of cookie (30 days from now)
		var d = new Date();
		d.setTime(d.getTime() + (30 * 24 * 60 * 60 * 1000));
		
		// Setting cookie
		document.cookie = "currentLanguageIsoCode=" + isoCode + "; expires=" + d.toUTCString() + "; path=/;";
		document.cookie = "currentLanguageDirection=" + direction + "; expires=" + d.toUTCString() + "; path=/;";
		
		// Reload from server
		location.reload(true); 
	}
	
	// Get the link element
	var languagesLink = document.getElementsByClassName("languages")[0];
	var countriesLink = document.getElementsByClassName("countries")[0];
	var motorsLink = document.getElementsByClassName("category")[0];
	var categoriesLinks = document.getElementsByClassName("category-link");
	var userAccountButton = document.getElementsByClassName("user-account-btn")[0];
	// Create a media query to check the screen size
	var mediaQuery = window.matchMedia("(min-width: 992px)");

	// Check the media query and disable the link if the screen size is smaller than 768px
	if (mediaQuery.matches) {
		languagesLink.disabled = "true";
		countriesLink.disabled = "true";
		motorsLink.disabled = "true";
		for (var i = 0; i < categoriesLinks.length; i++) {
		  categoriesLinks[i].disabled = "true";
		}
		if(userAccountButton !== undefined)
			userAccountButton.disabled = "true";
	}

</script>