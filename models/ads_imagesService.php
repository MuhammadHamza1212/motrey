<?php

include "ads_images.php";

class AdsImagesService
{
    public function addAdImage($adsImages)
    {
        global $conn;
        $id = $adsImages->getAd_id();
        $image_path = $adsImages->getImage_path();
        $created_at = $adsImages->getCreated_at();
        $sql = $conn->prepare("INSERT INTO ads_image (ad_id, image_path, created_at) VALUES (?, ?, ?)");
        $sql->bind_param("iss", $id, $image_path, $created_at);
        $sql->execute();
    }

    public function getAdImageByImageId($id)
    {
        global $conn;
        $sql = "SELECT * FROM ads_image WHERE image_id=$id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $adsImage = new AdsImages();
            $adsImage->setImage_id($row["image_id"]);
            $adsImage->setAd_id($row["ad_id"]);
            $adsImage->setImage_path($row["image_path"]);
            $adsImage->setCreated_at($row["created_at"]);
            return $adsImage;
        }
    }

    public function getAdImagesByAdId($id)
    {
        global $conn;
        $sql = "SELECT * FROM ads_image WHERE ad_id=$id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $adsImagesObjects = array();
            while ($row = $result->fetch_assoc()) {
                $adsImages = new AdsImages();
                $adsImages->setImage_id($row["image_id"]);
                $adsImages->setAd_id($row["ad_id"]);
                $adsImages->setImage_path($row["image_path"]);
                $adsImages->setCreated_at($row["created_at"]);
                array_push($adsImagesObjects, $adsImages);
            }
            return $adsImagesObjects;
        }
    }

    public function updateAdsImagesByImageId($adsImages)
    {
        global $conn;
        $image_id = $adsImages->getImage_id();
        $id = $adsImages->getAd_id();
        $image_path = $adsImages->getImage_path();
        $created_at = $adsImages->getCreated_at();
        $sql = $conn->prepare("UPDATE ads_image SET ad_id=?, image_path=?, created_at=? WHERE image_id=?");
        $sql->bind_param("issi", $id, $image_path, $created_at, $image_id);
        $sql->execute();
    }

    public function deleteAdsImagesByImageId($id)
    {
        global $conn;
        $sql = "DELETE FROM ads_image WHERE image_id=$id";
        $result = $conn->query($sql);
    }
}
