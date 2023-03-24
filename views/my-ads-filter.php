<?php
$status = "All";
if (isset($_GET['status'])) {
	$status = $_GET['status'];
}
$all = 0;
$live = 0;
$underReview = 0;
$rejected = 0;
$expired = 0;
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
?>
<div class="flex-container">
	<div class="flex-item">
		<?php 
		if($status == "All")
			echo '<input type="radio" class="btn-check" name="ad-status" id="all-ads" value="all" onclick="changeStatus(\'All\')" checked>';
		else
			echo '<input type="radio" class="btn-check" name="ad-status" id="all-ads" value="all" onclick="changeStatus(\'All\')">';
		
		echo '<label class="btn btn-outline-danger mb-2" for="all-ads" style="border-radius: 25px;">'.$labels[$currentLanguageIsoCode]['All_Ads'].' ('.$all.')</label>';
		?>
	</div>
	<div class="flex-item">
		<?php 
		if($status == "Live")
			echo '<input type="radio" class="btn-check" name="ad-status" id="live-ads" value="live" onclick="changeStatus(\'Live\')" checked>';
		else
			echo '<input type="radio" class="btn-check" name="ad-status" id="live-ads" value="live" onclick="changeStatus(\'Live\')">';
		
		echo '<label class="btn btn-outline-danger mb-2" for="live-ads" style="border-radius: 25px;">'.$labels[$currentLanguageIsoCode]['Live'].' ('.$live.')</label>';
		?>
	</div>
	<div class="flex-item">
		<input type="radio" class="btn-check" name="ad-status" id="under-review-ads" value="under-review" onclick="changeStatus('Under_Review')" <?php echo ($status == "Under_Review" ? "checked" : ""); ?>>
		<?php echo '<label class="btn btn-outline-danger mb-2" for="under-review-ads" style="border-radius: 25px;">'.$labels[$currentLanguageIsoCode]['Under_Review'].' ('.$underReview.')</label>'; ?>
	</div>
	<div class="flex-item">
		<input type="radio" class="btn-check" name="ad-status" id="rejected-ads" value="rejected" onclick="changeStatus('Rejected')" <?php echo ($status == "Rejected" ? "checked" : ""); ?>>
		<?php echo '<label class="btn btn-outline-danger mb-2" for="rejected-ads" style="border-radius: 25px;">'.$labels[$currentLanguageIsoCode]['Rejected'].' ('.$rejected.')</label>'; ?>
	</div>
	<div class="flex-item">
		<input type="radio" class="btn-check" name="ad-status" id="expired-ads" value="expired" onclick="changeStatus('Expired')" <?php echo ($status == "Expired" ? "checked" : ""); ?>>
		<?php echo '<label class="btn btn-outline-danger mb-2" for="expired-ads"style="border-radius: 25px;">'.$labels[$currentLanguageIsoCode]['Expired'].' ('.$expired.')</label>'; ?>
	</div>
</div>	
<hr>	
<script>
function changeStatus(status) {
	var url = window.location.href;
	url = url.split('?')[0] + '?status=' + status;

	window.location.href = url;
}
</script>	