<?php

include 'models/favorite_adService.php';
include 'config.php';

session_start();

if(isset($_SESSION["userId"])) {
	
	$userId = $_SESSION["userId"];
	$adId = $_GET["ad_id"];
	
	$favoriteAd = new FavoriteAd();
	$favoriteAd->setUser_id($userId);
	$favoriteAd->setAd_id($adId);
	
	$favoriteAdService = new FavoriteAdService();
	$favoriteAdService->addFavoriteAd($favoriteAd);
	
	echo "added";
}
?>