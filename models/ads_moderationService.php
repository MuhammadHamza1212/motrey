<?php

include "ads_moderation.php";

class AdsModerationService
{
    public function addAdsModeration($adsModeration)
    {
        global $conn;
        $ad_id = $adsModeration->getAd_id();
        $status = $adsModeration->getStatus();
        $moderated_at = $adsModeration->getModerated_at();
        $moderated_by = $adsModeration->getModerated_by();
        $sql = $conn->prepare("INSERT INTO ads_moderation (ad_id, status, moderated_at, moderated_by) VALUES (?, ?, ?, ?)");
        $sql->bind_param("issi", $ad_id, $status, $moderated_at, $moderated_by);
        $sql->execute();
    }

    public function getAdsModerationByModerationId($id)
    {
        global $conn;
        $sql = "SELECT * FROM ads_moderation WHERE moderation_id=$id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $AdsModeration = new AdsModeration();
            $AdsModeration->setModeration_id($row["moderation_id"]);
            $AdsModeration->setAd_id($row["ad_id"]);
            $AdsModeration->setStatus($row["staus"]);
            $AdsModeration->setModerated_at($row["moderated_at"]);
            $AdsModeration->setModerated_by($row["moderated_by"]);
            return $AdsModeration;
        }
    }

    public function getAdsModerationByAdId($id)
    {
        global $conn;
        $sql = "SELECT * FROM ads_moderation WHERE ad_id=$id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $AdsModeration = new AdsModeration();
            $AdsModeration->setModeration_id($row["moderation_id"]);
            $AdsModeration->setAd_id($row["ad_id"]);
            $AdsModeration->setStatus($row["staus"]);
            $AdsModeration->setModerated_at($row["moderated_at"]);
            $AdsModeration->setModerated_by($row["moderated_by"]);
            return $AdsModeration;
        }
    }

    public function updateAdsModerationByModerationId($adsModeration)
    {
        global $conn;
        $moderation_id = $adsModeration->getModeration_id();
        $ad_id = $adsModeration->getAd_id();
        $status = $adsModeration->getStatus();
        $moderated_at = $adsModeration->getModerated_at();
        $moderated_by = $adsModeration->getModerated_by();
        $sql = $conn->prepare("UPDATE ads_moderation SET ad_id=?, status=?, moderated_at=?, moderated_by=? WHERE moderation_id=?");
        $sql->bind_param("issii", $ad_id, $status, $moderated_at, $moderated_by, $moderation_id);
        $sql->execute();
    }

    public function updateAdsModerationStatusByAdId($ad)
    {
        global $conn;
        $ad_id = $ad->getAd_id();
        $status = $ad->getStatus();
        $sql = $conn->prepare("UPDATE ads_moderation SET status=? WHERE ad_id=?");
        $sql->bind_param("si", $status, $ad_id);
        $sql->execute();
    }

    public function deleteAdsModerationByModerationId($id)
    {
        global $conn;
        $sql = "DELETE FROM ads_moderation WHERE moderation_id=$id";
        $result = $conn->query($sql);
    }

    public function deleteAdsModerationByAdId($id)
    {
        global $conn;
        $sql = "DELETE FROM ads_moderation WHERE ad_id=$id";
        $result = $conn->query($sql);
    }
}
