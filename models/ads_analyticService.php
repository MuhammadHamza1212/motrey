<?php

include "ads_analytic.php";

class AdsAnalyticService
{
    public function addAdsAnalytic($adsAnalytic)
    {
        global $conn;
        $id = $adsAnalytic->getAd_id();
        $views = $adsAnalytic->getViews();
        $clicks = $adsAnalytic->getClicks();
        $sql = $conn->prepare("INSERT INTO ads_analytic (ad_id, views, clicks) VALUES (?, ?, ?)");
        $sql->bind_param("iii", $id, $views, $clicks);
        $sql->execute();
    }

    public function getAdsAnalyticByAnalyticId($id)
    {
        global $conn;
        $sql = "SELECT * FROM ads_analytic WHERE analytic_id=$id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $AdsAnalytic = new AdsAnalytic();
            $AdsAnalytic->setAnalytic_id($row["analytic_id"]);
            $AdsAnalytic->setAd_id($row["ad_id"]);
            $AdsAnalytic->setViews($row["views"]);
            $AdsAnalytic->setClicks($row["clicks"]);
            return $AdsAnalytic;
        }
    }

    public function getAdsAnalyticByAdId($id)
    {
        global $conn;
        $sql = "SELECT * FROM ads_analytic WHERE ad_id=$id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $adsAnalyticsObjects = array();
            while ($row = $result->fetch_assoc()) {
                $AdsAnalytic = new AdsAnalytic();
                $AdsAnalytic->setAnalytic_id($row["analytic_id"]);
                $AdsAnalytic->setAd_id($row["ad_id"]);
                $AdsAnalytic->setViews($row["views"]);
                $AdsAnalytic->setClicks($row["clicks"]);
                array_push($adsAnalyticsObjects, $AdsAnalytic);
            }
            return $adsAnalyticsObjects;
        }
    }

    public function updateAdsAnalyticByAnalyticId($adsAnalytic)
    {
        global $conn;
        $analytic_id = $adsAnalytic->getAnalytic_id();
        $id = $adsAnalytic->getAd_id();
        $views = $adsAnalytic->getViews();
        $clicks = $adsAnalytic->getClicks();
        $sql = $conn->prepare("UPDATE ads_analytic SET ad_id=?, views=?, clicks=? WHERE analytic_id=?");
        $sql->bind_param("iiii", $id, $views, $clicks, $analytic_id);
        $sql->execute();
    }

    public function deleteAdsAnalyticByAnalyticId($id)
    {
        global $conn;
        $sql = "DELETE FROM ads_analytic WHERE analytic_id=$id";
        $result = $conn->query($sql);
    }
}
