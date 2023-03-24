<?php
$userService = new UserService();
$user = $userService->getUserById($_SESSION['userId']);

$userProfileService = new UserProfileService();
$userProfile = $userProfileService->getUsersProfileById($_SESSION['userId']);

$all = 0;
$live = 0;
$underReview = 0;
$rejected = 0;
$expired = 0;
$adService = new AdService();
$adCountsByStatus = $adService->getAllAdsCountByStatus($_SESSION['userId']);
if($adCountsByStatus !== NULL) {
	for($i = 0; $i < count($adCountsByStatus); $i++) {
		if($adCountsByStatus[$i]["status"] == "Approved") {
			$live = $adCountsByStatus[$i]["count"];
			$all = $all + $adCountsByStatus[$i]["count"];
		} 
		else if($adCountsByStatus[$i]["status"] == "Under_Review") {
			$underReview = $adCountsByStatus[$i]["count"];
			$all = $all + $adCountsByStatus[$i]["count"];
		}
		else if($adCountsByStatus[$i]["status"] == "Rejected") {
			$rejected = $adCountsByStatus[$i]["count"];
			$all = $all + $adCountsByStatus[$i]["count"];
		}
		else if($adCountsByStatus[$i]["status"] == "Expired") {
			$expired = $adCountsByStatus[$i]["count"];
			$all = $all + $adCountsByStatus[$i]["count"];
		}
	}
}

// Create a new DateTime object from the MySQL date string

$day = null;
$month = null;
$year = null;
$date_str = $userProfile->getBirth_date(); // The MySQL date string
if($date_str !== null) {
	$date = new DateTime($date_str);

	// Extract the day, month, and year values from the DateTime object
	$day = $date->format('d');
	$month = $date->format('m');
	$year = $date->format('Y');
}
?>
<div class="row">
	<div class="col-lg-6">
		<div class="heading mb-5"><?php echo $labels[$currentLanguageIsoCode]['My_Profile']; ?></div>
		<div class="row align-items-center">
			<div class="col-4 col-lg-3 text-center">
				<?php
				if($userProfile->getProfile_picture() === null) {
					echo '<img class="profile-image" id="profile-image" src="resources/images/profile-image-placeholder.png">';
				}
				else {
					echo '<img class="profile-image" id="profile-image" src="'.$userProfile->getProfile_picture().'">';
				}
				?>
				<a type="button" class="text-decoration-none text-danger" onclick="triggerImageInput();"><?php echo $labels[$currentLanguageIsoCode]['Change_Image']; ?></a>
			</div>
			<div class="col-8 col-lg-9">
				<div class="fw-bold"><?php echo $user->getUsername(); ?></div>
				<div class="text-secondary fst-italic"><?php echo $user->getEmail(); ?></div>
				<div class="text-secondary fst-italic"><?php echo $user->getPhone(); ?></div>
			</div>
		</div>
		<form class="row my-5" action="update-profile.php" method="post" enctype="multipart/form-data">
		  <input type="file" name="profile-image" id="profile-image-input" style="display:none;" onchange="displayImage();">
		  <div class="mb-3 col-6">
			<label for="first-name" class="form-label"><?php echo $labels[$currentLanguageIsoCode]['First_Name']; ?></label>
			<input type="text" class="form-control" id="first-name" name="first-name" value="<?php echo $userProfile->getFirst_name(); ?>">
		  </div>
		  <div class="mb-3 col-6">
			<label for="last-name" class="form-label"><?php echo $labels[$currentLanguageIsoCode]['Last_Name']; ?></label>
			<input type="text" class="form-control" id="last-name" name="last-name" value="<?php echo $userProfile->getLast_name(); ?>">
		  </div>
		  <div class="mb-3 col-12">
			<label class="form-label"><?php echo $labels[$currentLanguageIsoCode]['Date_of_Birth']; ?></label>
			<div class="dob-field d-flex w-100">
			    <select id="dob-day" name="dob-day">
					<option value="">-- <?php echo $labels[$currentLanguageIsoCode]['Select_Day']; ?> --</option>
					<?php
					for($i = 1; $i < 32; $i++) {
						if($day == $i)
							echo '<option value="'.$i.'" selected>'.$i.'</option>';
						else
							echo '<option value="'.$i.'">'.$i.'</option>';
					}
					?>
			    </select>
			  
			    <select id="dob-month" name="dob-month" value="<?php echo $month; ?>">
					<option value="">-- <?php echo $labels[$currentLanguageIsoCode]['Select_Month']; ?> --</option>
					<?php echo '<option value="January" '.(($month=="01") ? "selected" : "").'>' .$labels[$currentLanguageIsoCode]['January'].'</option>'; ?>
					<?php echo '<option value="February"'.(($month=="02") ? "selected" : "").' >' .$labels[$currentLanguageIsoCode]['February'].'</option>'; ?>
					<?php echo '<option value="March"'.(($month=="03") ? "selected" : "").' >' .$labels[$currentLanguageIsoCode]['March'].'</option>'; ?>
					<?php echo '<option value="April"'.(($month=="04") ? "selected" : "").' >' .$labels[$currentLanguageIsoCode]['April'].'</option>'; ?>
					<?php echo '<option value="May"'.(($month=="05") ? "selected" : "").' >' .$labels[$currentLanguageIsoCode]['May'].'</option>'; ?>
					<?php echo '<option value="June"'.(($month=="06") ? "selected" : "").' >' .$labels[$currentLanguageIsoCode]['June'].'</option>'; ?>
					<?php echo '<option value="July"'.(($month=="07") ? "selected" : "").' >' .$labels[$currentLanguageIsoCode]['July'].'</option>'; ?>
					<?php echo '<option value="August"'.(($month=="08") ? "selected" : "").' >' .$labels[$currentLanguageIsoCode]['August'].'</option>'; ?>
					<?php echo '<option value="September"'.(($month=="09") ? "selected" : "").' >' .$labels[$currentLanguageIsoCode]['September'].'</option>'; ?>
					<?php echo '<option value="October"'.(($month=="10") ? "selected" : "").' >' .$labels[$currentLanguageIsoCode]['October'].'</option>'; ?>
					<?php echo '<option value="November"'.(($month=="11") ? "selected" : "").' >' .$labels[$currentLanguageIsoCode]['November'].'</option>'; ?>
					<?php echo '<option value="December"'.(($month=="12") ? "selected" : "").' >' .$labels[$currentLanguageIsoCode]['December'].'</option>'; ?>
			    </select>
				
				<select id="dob-year" name="dob-year" value="<?php echo $year; ?>">
					<option value="">-- <?php echo $labels[$currentLanguageIsoCode]['Select_Year']; ?> --</option>
					<?php
					for($i = 1921; $i < 2024; $i++) {
						if($year == $i)
							echo '<option value="'.$i.'" selected>'.$i.'</option>';
						else
							echo '<option value="'.$i.'">'.$i.'</option>';
					}
					?>
			    </select>
			</div>
		  </div>
		  <div class="mb-3 col-12">
			<label for="address" class="form-label"><?php echo $labels[$currentLanguageIsoCode]['Address']; ?></label>
			<input type="text" class="form-control" id="address" name="address" value="<?php echo $userProfile->getAddress(); ?>">
		  </div>
		  <div class="mb-3 col-12">
			<button type="submit" class="btn btn-outline-danger"><?php echo $labels[$currentLanguageIsoCode]['Update']; ?></button>
		  </div>
		</form>
	</div>
	<div class="col-lg-6 px-5">
		<div class="heading mb-5"><?php echo $labels[$currentLanguageIsoCode]['My_Statistics']; ?></div>
		<div class="card mb-3 rounded-4" style="overflow: hidden;">
		  <div class="row g-0 bg-secondary rounded-4 border-end">
			<div class="col-md-4 align-items-center m-auto">
			  <div class="text-center display-6 text-white h-100"><?php echo $labels[$currentLanguageIsoCode]['My']; ?> <br> <?php echo $labels[$currentLanguageIsoCode]['Ads']; ?></div>
			</div>
			<div class="col-md-8 bg-white">
			  <div class="card-body">
				<h5 class="card-title mb-0"><?php echo $labels[$currentLanguageIsoCode]['Total']; ?>: <?php echo $all; ?></h5>
				<p class="card-text mb-0"><?php echo $labels[$currentLanguageIsoCode]['Live']; ?>: <?php echo $live; ?></p>
				<p class="card-text mb-0"><?php echo $labels[$currentLanguageIsoCode]['Under_Review']; ?>: <?php echo $underReview; ?></p>
				<p class="card-text mb-0"><?php echo $labels[$currentLanguageIsoCode]['Expired']; ?>: <?php echo $expired; ?></p>
				<p class="card-text mb-0"><?php echo $labels[$currentLanguageIsoCode]['Rejected']; ?>: <?php echo $rejected; ?></p>
			  </div>
			</div>
		  </div>
		</div>
	</div>
</div>

<script>
	function triggerImageInput() {
	  // Click the hidden file input when the icon is clicked
	  document.getElementById("profile-image-input").click();
	}
	function displayImage() {
	  // Get the selected file from the input element
	  var file = document.getElementById("profile-image-input").files[0];
	  // Create a FileReader object
	  var reader = new FileReader();
	  // Set the image source when the file is loaded
	  reader.onload = function(event) {
		document.getElementById("profile-image").src = event.target.result;
	  }
	  // Read the selected file as a URL
	  reader.readAsDataURL(file);
	}
</script>