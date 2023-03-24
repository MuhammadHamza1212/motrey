<?php

include 'models/favorite_adService.php';
include 'config.php';

session_start();

if(isset($_SESSION['userId'])) {
	
	$userId = $_SESSION['userId'];
	$adId = $_GET['ad_id'];
	
	$favoriteAdService = new FavoriteAdService();
	$favoriteAdService->deleteFavoriteAdByUserIdAndAdId($userId, $adId);
	
	echo "removed";
}
?>