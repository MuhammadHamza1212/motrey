<?php

include "ad.php";

class AdService
{
    public function addAd($ad)
    {
        global $conn;
        $user_id = $ad->getUser_id();
        $category_id = $ad->getCategory_id();
		$category_id_sal = $ad->getCategory_id_sal();
        $ad_type = $ad->getAd_type();
        $title = $ad->getTitle();
        $description = $ad->getDescription();
        $price = $ad->getPrice();
        $expiry_date = $ad->getExpiry_date();
        $source_location_coordinates = $ad->getSource_location_coordinates();
        $source_location_address = $ad->getSource_location_address();
        $posted_at = $ad->getPosted_at();
        $status = $ad->getStatus();
        $source_city_id = $ad->getSource_city_id();
		$source_city_id_sal = $ad->getSource_city_id_sal();
        $source_country_id = $ad->getSource_country_id();
		$source_country_id_sal = $ad->getSource_country_id_sal();
        $sql = $conn->prepare("INSERT INTO ads (user_id, category_id, category_id_sal, ad_type, title, description, price, expiry_date, source_location_coordinates, source_location_address, posted_at, status, source_city_id, source_city_id_sal, source_country_id, source_country_id_sal) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $sql->bind_param("iiisssisssssiiii", $user_id, $category_id, $category_id_sal, $ad_type, $title, $description, $price, $expiry_date, $source_location_coordinates, $source_location_address, $posted_at, $status, $source_city_id, $source_city_id_sal, $source_country_id, $source_country_id_sal);
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
        if (!$sql->execute()) {
            echo "Execute failed: (" . $sql->errno . ") " . $sql->error;
        }
    }

    public function getAdById($id)
    {
        global $conn;
        $sql = "SELECT * FROM ads WHERE ad_id=$id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $ad = new Ad();
            $ad->setAd_id($row["ad_id"]);
            $ad->setUser_id($row["user_id"]);
            $ad->setCategory_id($row["category_id"]);
			$ad->setCategory_id_sal($row["category_id_sal"]);
            $ad->setAd_type($row["ad_type"]);
            $ad->setTitle($row["title"]);
            $ad->setDescription($row["description"]);
            $ad->setPrice($row["price"]);
            $ad->setExpiry_date($row["expiry_date"]);
            $ad->setSource_location_coordinates($row["source_location_coordinates"]);
            $ad->setSource_location_address($row["source_location_address"]);
            $ad->setPosted_at($row["posted_at"]);
            $ad->setStatus($row["status"]);
            $ad->setSource_city_id($row["source_city_id"]);
			$ad->setSource_city_id_sal($row["source_city_id_sal"]);
            $ad->setSource_country_id($row["source_country_id"]);
			$ad->setSource_country_id_sal($row["source_country_id_sal"]);
            return $ad;
        }
    }

    public function getAdByUserId($userId)
    {
        global $conn;
        $sql = "SELECT * FROM ads WHERE user_id=$userId";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $adsObjects = array();
            while ($row = $result->fetch_assoc()) {
                $ad = new Ad();
                $ad->setAd_id($row["ad_id"]);
                $ad->setUser_id($row["user_id"]);
                $ad->setCategory_id($row["category_id"]);
				$ad->setCategory_id_sal($row["category_id_sal"]);
                $ad->setAd_type($row["ad_type"]);
                $ad->setTitle($row["title"]);
                $ad->setDescription($row["description"]);
                $ad->setPrice($row["price"]);
                $ad->setExpiry_date($row["expiry_date"]);
                $ad->setSource_location_coordinates($row["source_location_coordinates"]);
                $ad->setSource_location_address($row["source_location_address"]);
                $ad->setPosted_at($row["posted_at"]);
                $ad->setStatus($row["status"]);
                $ad->setSource_city_id($row["source_city_id"]);
				$ad->setSource_city_id_sal($row["source_city_id_sal"]);
                $ad->setSource_country_id($row["source_country_id"]);
				$ad->setSource_country_id_sal($row["source_country_id_sal"]);
                array_push($adsObjects, $ad);
            }
            return $adsObjects;
        }
    }

    public function getAdByCategoryId($categoryId)
    {
        global $conn;
        $sql = "SELECT * FROM ads WHERE category_id=$categoryId";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $adsObjects = array();
            while ($row = $result->fetch_assoc()) {
                $ad = new Ad();
                $ad->setAd_id($row["ad_id"]);
                $ad->setUser_id($row["user_id"]);
                $ad->setCategory_id($row["category_id"]);
				$ad->setCategory_id_sal($row["category_id_sal"]);
                $ad->setAd_type($row["ad_type"]);
                $ad->setTitle($row["title"]);
                $ad->setDescription($row["description"]);
                $ad->setPrice($row["price"]);
                $ad->setExpiry_date($row["expiry_date"]);
                $ad->setSource_location_coordinates($row["source_location_coordinates"]);
                $ad->setSource_location_address($row["source_location_address"]);
                $ad->setPosted_at($row["posted_at"]);
                $ad->setStatus($row["status"]);
                $ad->setSource_city_id($row["source_city_id"]);
				$ad->setSource_city_id_sal($row["source_city_id_sal"]);
                $ad->setSource_country_id($row["source_country_id"]);
				$ad->setSource_country_id_sal($row["source_country_id_sal"]);
                array_push($adsObjects, $ad);
            }
            return $adsObjects;
        }
    }
	
	public function getAdByCategoryIdSal($categoryIdSal)
    {
        global $conn;
        $sql = "SELECT * FROM ads WHERE category_id_sal=$categoryIdSal";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $adsObjects = array();
            while ($row = $result->fetch_assoc()) {
                $ad = new Ad();
                $ad->setAd_id($row["ad_id"]);
                $ad->setUser_id($row["user_id"]);
                $ad->setCategory_id($row["category_id"]);
				$ad->setCategory_id_sal($row["category_id_sal"]);
                $ad->setAd_type($row["ad_type"]);
                $ad->setTitle($row["title"]);
                $ad->setDescription($row["description"]);
                $ad->setPrice($row["price"]);
                $ad->setExpiry_date($row["expiry_date"]);
                $ad->setSource_location_coordinates($row["source_location_coordinates"]);
                $ad->setSource_location_address($row["source_location_address"]);
                $ad->setPosted_at($row["posted_at"]);
                $ad->setStatus($row["status"]);
                $ad->setSource_city_id($row["source_city_id"]);
				$ad->setSource_city_id_sal($row["source_city_id_sal"]);
                $ad->setSource_country_id($row["source_country_id"]);
				$ad->setSource_country_id_sal($row["source_country_id_sal"]);
                array_push($adsObjects, $ad);
            }
            return $adsObjects;
        }
    }
	
	public function getAdByCategoryIds($categoryIds)
    {
        global $conn;
		$imploded_array = implode(',', $categoryIds);
        $sql = "SELECT * FROM ads WHERE category_id IN ($imploded_array)";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $adsObjects = array();
            while ($row = $result->fetch_assoc()) {
                $ad = new Ad();
                $ad->setAd_id($row["ad_id"]);
                $ad->setUser_id($row["user_id"]);
                $ad->setCategory_id($row["category_id"]);
				$ad->setCategory_id_sal($row["category_id_sal"]);
                $ad->setAd_type($row["ad_type"]);
                $ad->setTitle($row["title"]);
                $ad->setDescription($row["description"]);
                $ad->setPrice($row["price"]);
                $ad->setExpiry_date($row["expiry_date"]);
                $ad->setSource_location_coordinates($row["source_location_coordinates"]);
                $ad->setSource_location_address($row["source_location_address"]);
                $ad->setPosted_at($row["posted_at"]);
                $ad->setStatus($row["status"]);
                $ad->setSource_city_id($row["source_city_id"]);
				$ad->setSource_city_id_sal($row["source_city_id_sal"]);
                $ad->setSource_country_id($row["source_country_id"]);
				$ad->setSource_country_id_sal($row["source_country_id_sal"]);
                array_push($adsObjects, $ad);
            }
            return $adsObjects;
        }
    }
	
	public function getAdByCategoryIdsSal($categoryIdsSal)
    {
        global $conn;
		$imploded_array = implode(',', $categoryIdsSal);
        $sql = "SELECT * FROM ads WHERE category_id_sal IN ($imploded_array)";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $adsObjects = array();
            while ($row = $result->fetch_assoc()) {
                $ad = new Ad();
                $ad->setAd_id($row["ad_id"]);
                $ad->setUser_id($row["user_id"]);
                $ad->setCategory_id($row["category_id"]);
				$ad->setCategory_id_sal($row["category_id_sal"]);
                $ad->setAd_type($row["ad_type"]);
                $ad->setTitle($row["title"]);
                $ad->setDescription($row["description"]);
                $ad->setPrice($row["price"]);
                $ad->setExpiry_date($row["expiry_date"]);
                $ad->setSource_location_coordinates($row["source_location_coordinates"]);
                $ad->setSource_location_address($row["source_location_address"]);
                $ad->setPosted_at($row["posted_at"]);
                $ad->setStatus($row["status"]);
                $ad->setSource_city_id($row["source_city_id"]);
				$ad->setSource_city_id_sal($row["source_city_id_sal"]);
                $ad->setSource_country_id($row["source_country_id"]);
				$ad->setSource_country_id_sal($row["source_country_id_sal"]);
                array_push($adsObjects, $ad);
            }
            return $adsObjects;
        }
    }
	
	public function getAdsByAdType($adType, $popularity)
    {
        global $conn;
		if(is_null($popularity) || $popularity == false)
			$sql = "SELECT * FROM ads WHERE ad_type='$adType'";
		else
			$sql = "SELECT * FROM ads JOIN ads_analytic ON ads.ad_id = ads_analytic.ad_id WHERE ads.ad_type='$adType' ORDER BY ads_analytic.views DESC";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $adsObjects = array();
            while ($row = $result->fetch_assoc()) {
                $ad = new Ad();
                $ad->setAd_id($row["ad_id"]);
                $ad->setUser_id($row["user_id"]);
                $ad->setCategory_id($row["category_id"]);
				$ad->setCategory_id_sal($row["category_id_sal"]);
                $ad->setAd_type($row["ad_type"]);
                $ad->setTitle($row["title"]);
                $ad->setDescription($row["description"]);
                $ad->setPrice($row["price"]);
                $ad->setExpiry_date($row["expiry_date"]);
                $ad->setSource_location_coordinates($row["source_location_coordinates"]);
                $ad->setSource_location_address($row["source_location_address"]);
                $ad->setPosted_at($row["posted_at"]);
                $ad->setStatus($row["status"]);
                $ad->setSource_city_id($row["source_city_id"]);
				$ad->setSource_city_id_sal($row["source_city_id_sal"]);
                $ad->setSource_country_id($row["source_country_id"]);
				$ad->setSource_country_id_sal($row["source_country_id_sal"]);
                array_push($adsObjects, $ad);
            }
            return $adsObjects;
        }
    }
	
	public function getAdsByMultipleFilters($categoryIdsSal, $cityIdSal, $countryIdSal, $priceFrom, $priceTo)
    {
        global $conn;
		$imploded_array = implode(',', $categoryIdsSal);
		$sql = "SELECT * FROM ads";
		if(is_null($categoryIdsSal) == false)
			$sql = $sql . " WHERE category_id_sal IN ($imploded_array)";
        if(is_null($cityIdSal) == false)
			$sql = $sql . " AND source_city_id_sal=$cityIdSal";
		if(is_null($countryIdSal) == false)
			$sql = $sql . " AND source_country_id_sal=$countryIdSal";
		if(is_null($priceFrom) == false && is_null($priceTo) == false)
			$sql = $sql . " AND price BETWEEN $priceFrom AND $priceTo";
		$result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $adsObjects = array();
            while ($row = $result->fetch_assoc()) {
                $ad = new Ad();
                $ad->setAd_id($row["ad_id"]);
                $ad->setUser_id($row["user_id"]);
                $ad->setCategory_id($row["category_id"]);
				$ad->setCategory_id_sal($row["category_id_sal"]);
                $ad->setAd_type($row["ad_type"]);
                $ad->setTitle($row["title"]);
                $ad->setDescription($row["description"]);
                $ad->setPrice($row["price"]);
                $ad->setExpiry_date($row["expiry_date"]);
                $ad->setSource_location_coordinates($row["source_location_coordinates"]);
                $ad->setSource_location_address($row["source_location_address"]);
                $ad->setPosted_at($row["posted_at"]);
                $ad->setStatus($row["status"]);
                $ad->setSource_city_id($row["source_city_id"]);
				$ad->setSource_city_id_sal($row["source_city_id_sal"]);
                $ad->setSource_country_id($row["source_country_id"]);
				$ad->setSource_country_id_sal($row["source_country_id_sal"]);
                array_push($adsObjects, $ad);
            }
            return $adsObjects;
        }
    }

    public function getLastAd()
    {
        global $conn;   
        $sql = "SELECT * FROM ads ORDER BY ad_id DESC LIMIT 1";
        $result = $conn->query($sql); 
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $ad = new Ad();
            $ad->setAd_id($row["ad_id"]);
            $ad->setUser_id($row["user_id"]);
            $ad->setCategory_id($row["category_id"]);
			$ad->setCategory_id_sal($row["category_id_sal"]);
            $ad->setAd_type($row["ad_type"]);
            $ad->setTitle($row["title"]);
            $ad->setDescription($row["description"]);
            $ad->setPrice($row["price"]);
            $ad->setExpiry_date($row["expiry_date"]);
            $ad->setSource_location_coordinates($row["source_location_coordinates"]);
            $ad->setSource_location_address($row["source_location_address"]);
            $ad->setPosted_at($row["posted_at"]);
            $ad->setStatus($row["status"]);
            $ad->setSource_city_id($row["source_city_id"]);
			$ad->setSource_city_id_sal($row["source_city_id_sal"]);
            $ad->setSource_country_id($row["source_country_id"]);
			$ad->setSource_country_id_sal($row["source_country_id_sal"]);
            return $ad;
        }
    }

    public function updateAdByAdId($ad)
    {
        global $conn;
        $ad_id = $ad->getAd_id();
        $user_id = $ad->getUser_id();
        $category_id = $ad->getCategory_id();
		$category_id_sal = $ad->getCategory_id_sal();
        $ad_type = $ad->getAd_type();
        $title = $ad->getTitle();
        $description = $ad->getDescription();
        $price = $ad->getPrice();
        $expiry_date = $ad->getExpiry_date();
        $source_location_coordinates = $ad->getSource_location_coordinates();
        $source_location_address = $ad->getSource_location_address();
        $posted_at = $ad->getPosted_at();
        $status = $ad->getStatus();
        $source_city_id = $ad->getSource_city_id();
		$source_city_id_sal = $ad->getSource_city_id_sal();
        $source_country_id = $ad->getSource_country_id();
		$source_country_id_sal = $ad->getSource_country_id_sal();
        $sql = $conn->prepare("UPDATE ads SET user_id=?, category_id=?, category_id_sal=?, ad_type=?, title=?, description=?, price=?, expiry_date=?, source_location_coordinates=?, source_location_address=?, posted_at=?, status=?, source_city_id=?, source_city_id_sal=?, source_country_id=?, source_country_id_sal=? WHERE ad_id=?");
        $sql->bind_param("iiisssisssssiiiii", $user_id, $category_id, $category_id_sal, $ad_type, $title, $description, $price, $expiry_date, $source_location_coordinates, $source_location_address, $posted_at, $status, $source_city_id, $source_city_id_sal, $source_country_id, $source_country_id_sal, $ad_id);
        $sql->execute();
    }

    public function updateAdStatusByAdId($ad)
    {
        global $conn;
        $ad_id = $ad->getAd_id();
        $status = $ad->getStatus();
        $sql = $conn->prepare("UPDATE ads SET status=? WHERE ad_id=?");
        $sql->bind_param("si", $status, $ad_id);
        $sql->execute();
    }

    public function deleteAdByAdId($ad_id)
    {
        global $conn;
        $sql = "DELETE FROM ads WHERE ad_id=$ad_id";
        $result = $conn->query($sql);
    }

    public function softDeleteAdByAdId($ad_id)
    {
        global $conn;
        $sql = $conn->prepare("UPDATE ads SET status=? WHERE ad_id=?");
        $sql->bind_param("si", "DELETED", $ad_id);
        $sql->execute();
    }

    public function getAllAds()
    {
        global $conn;
        $sql = "SELECT * FROM ads";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $adsObjects = array();
            while ($row = $result->fetch_assoc()) {
                $ad = new Ad();
                $ad->setAd_id($row["ad_id"]);
                $ad->setUser_id($row["user_id"]);
                $ad->setCategory_id($row["category_id"]);
				$ad->setCategory_id_sal($row["category_id_sal"]);
                $ad->setAd_type($row["ad_type"]);
                $ad->setTitle($row["title"]);
                $ad->setDescription($row["description"]);
                $ad->setPrice($row["price"]);
                $ad->setExpiry_date($row["expiry_date"]);
                $ad->setSource_location_coordinates($row["source_location_coordinates"]);
                $ad->setSource_location_address($row["source_location_address"]);
                $ad->setPosted_at($row["posted_at"]);
                $ad->setStatus($row["status"]);
                $ad->setSource_city_id($row["source_city_id"]);
				$ad->setSource_city_id_sal($row["source_city_id_sal"]);
                $ad->setSource_country_id($row["source_country_id"]);
				$ad->setSource_country_id_sal($row["source_country_id_sal"]);
                array_push($adsObjects, $ad);
            }
            return $adsObjects;
        }
    }
	
	public function getAllAdsCountByStatus($userId)
    {
        global $conn;
        $sql = "SELECT status, COUNT(*) AS count FROM ads WHERE user_id=$userId GROUP BY status";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $adsCountObjects = array();
            while ($row = $result->fetch_assoc()) {
                array_push($adsCountObjects, $row);
            }
            return $adsCountObjects;
        }
    }
	
	public function getAdByUserIdAndStatus($userId, $status) 
	{
		global $conn;
        $sql = "SELECT * FROM ads WHERE user_id=$userId AND status='$status'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $adsObjects = array();
            while ($row = $result->fetch_assoc()) {
                $ad = new Ad();
                $ad->setAd_id($row["ad_id"]);
                $ad->setUser_id($row["user_id"]);
                $ad->setCategory_id($row["category_id"]);
				$ad->setCategory_id_sal($row["category_id_sal"]);
                $ad->setAd_type($row["ad_type"]);
                $ad->setTitle($row["title"]);
                $ad->setDescription($row["description"]);
                $ad->setPrice($row["price"]);
                $ad->setExpiry_date($row["expiry_date"]);
                $ad->setSource_location_coordinates($row["source_location_coordinates"]);
                $ad->setSource_location_address($row["source_location_address"]);
                $ad->setPosted_at($row["posted_at"]);
                $ad->setStatus($row["status"]);
                $ad->setSource_city_id($row["source_city_id"]);
				$ad->setSource_city_id_sal($row["source_city_id_sal"]);
                $ad->setSource_country_id($row["source_country_id"]);
				$ad->setSource_country_id_sal($row["source_country_id_sal"]);
                array_push($adsObjects, $ad);
            }
            return $adsObjects;
        }
	}
}
?>