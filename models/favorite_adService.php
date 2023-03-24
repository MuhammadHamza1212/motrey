<?php

include "favorite_ad.php";

class FavoriteAdService
{
    public function addFavoriteAd($favoriteAd)
    {
        global $conn;
		$user_id = $favoriteAd->getUser_id();
        $ad_id = $favoriteAd->getAd_id();
        $sql = $conn->prepare("INSERT INTO favorite_ads (user_id, ad_id) VALUES (?, ?)");
        $sql->bind_param("ii", $user_id, $ad_id);
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
        if (!$sql->execute()) {
            echo "Execute failed: (" . $sql->errno . ") " . $sql->error;
        }
    }

    public function getFavoriteAdsByUserId($userId)
    {
        global $conn;
        if($userId != NULL){   
            $sql = "SELECT * FROM favorite_ads WHERE user_id=$userId";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
				$favoriteAds = array();
				while ($row = $result->fetch_assoc()) {
					$favoriteAd = new FavoriteAd();
					$favoriteAd->setFavorite_id($row["favorite_id"]);
					$favoriteAd->setUser_id($row["user_id"]);
					$favoriteAd->setAd_id($row["ad_id"]);
					$favoriteAd->setCreated_at($row["created_at"]);
					array_push($favoriteAds, $favoriteAd);
				}
				return $favoriteAds;
            }
        }
    }

    public function getFavoriteAdsByUserIdAndAdId($userId, $adId)
    {
        global $conn;
        if($userId != NULL && $adId != NULL){   
            $sql = "SELECT * FROM favorite_ads WHERE user_id=$userId AND ad_id=$adId";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
				$row = $result->fetch_assoc();
				$favoriteAd = new FavoriteAd();
				$favoriteAd->setFavorite_id($row["favorite_id"]);
				$favoriteAd->setUser_id($row["user_id"]);
				$favoriteAd->setAd_id($row["ad_id"]);
				$favoriteAd->setCreated_at($row["created_at"]);
				return $favoriteAd;
            }
        }
    }

    public function deleteFavoriteAdByfavoriteId($favoriteId)
    {
        global $conn;
        $sql = "DELETE FROM favorite_ads WHERE favorite_id=$favoriteId";
        $result = $conn->query($sql);
    }
	
	public function deleteFavoriteAdByUserIdAndAdId($userId, $adId)
    {
        global $conn;
        $sql = "DELETE FROM favorite_ads WHERE user_id=$userId AND ad_id=$adId";
        $result = $conn->query($sql);
    }
}
