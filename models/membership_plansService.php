<?php

include "membership_plans.php";

class MembershipPlanService
{
    public function addMembershipPlan($membershipPlan)
    {
        global $conn;
		$plan_id_sal = $membershipPlan->getPlan_id_sal();
		$language = $membershipPlan->getLanguage();
        $role_id = $membershipPlan->getRole_id();
        $plan_name = $membershipPlan->getPlan_name();
        $ad_duration = $membershipPlan->getAd_duration();
        $no_of_ads = $membershipPlan->getNo_of_ads();
        $ad_type = $membershipPlan->getAd_type();
        $plan_price = $membershipPlan->getPlan_price();
        $sql = $conn->prepare("INSERT INTO membership_plans (plan_id_sal, language, role_id, plan_name, ad_duration, no_of_ads, ad_type, plan_price) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $sql->bind_param("isisiisi", $plan_id_sal, $language, $role_id, $plan_name, $ad_duration, $no_of_ads, $ad_type, $plan_price);
        $sql->execute();
    }

    public function getMembershipPlanByPlanId($planId)
    {
        global $conn;
        if($planId != NULL){   
            $sql = "SELECT * FROM membership_plans WHERE plan_id=$planId";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $membershipPlan = new MembershipPlan();
				$membershipPlan->setPlan_id_sal($row["plan_id_sal"]);
				$membershipPlan->setLanguage($row["language"]);
                $membershipPlan->setPlan_id($row["plan_id"]);
                $membershipPlan->setRole_id($row["role_id"]);
                $membershipPlan->setPlan_name($row["plan_name"]);
                $membershipPlan->setAd_duration($row["ad_duration"]);
                $membershipPlan->setNo_of_ads($row["no_of_ads"]);
                $membershipPlan->setAd_type($row["ad_type"]);
                $membershipPlan->setPlan_price($row["plan_price"]);
                return $membershipPlan;
            }
        }
    }

    public function getMembershipPlanByRoleId($roleId, $language)
    {
        global $conn;
        $sql = "SELECT * FROM membership_plans WHERE role_id=$roleId AND language='$language'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $membershipPlanObjects = array();
            while ($row = $result->fetch_assoc()) {
                $membershipPlan = new MembershipPlan();
                $membershipPlan->setPlan_id($row["plan_id"]);
				$membershipPlan->setPlan_id_sal($row["plan_id_sal"]);
				$membershipPlan->setLanguage($row["language"]);
                $membershipPlan->setRole_id($row["role_id"]);
                $membershipPlan->setPlan_name($row["plan_name"]);
                $membershipPlan->setAd_duration($row["ad_duration"]);
                $membershipPlan->setNo_of_ads($row["no_of_ads"]);
                $membershipPlan->setAd_type($row["ad_type"]);
                $membershipPlan->setPlan_price($row["plan_price"]);
                array_push($membershipPlanObjects, $membershipPlan);
            }
            return $membershipPlanObjects;
        }
    }

    public function updateMembershipPlanByPlanId($membershipPlan)
    {
        global $conn;
        $plan_id = $membershipPlan->getPlan_id();
		$plan_id_sal = $membershipPlan->getPlan_id_sal();
		$language = $membershipPlan->getLanguage();
        $role_id = $membershipPlan->getRole_id();
        $plan_name = $membershipPlan->getPlan_name();
        $ad_duration = $membershipPlan->getAd_duration();
        $no_of_ads = $membershipPlan->getNo_of_ads();
        $ad_type = $membershipPlan->getAd_type();
        $plan_price = $membershipPlan->getPlan_price();
        $sql = $conn->prepare("UPDATE membership_plans SET plan_id_sal=?, language=?, role_id=?, plan_name=?, ad_duration=?, no_of_ads=?, ad_type=?, plan_price=? WHERE plan_id=?");
        $sql->bind_param("isisiisii", $plan_id_sal, $language, $role_id, $plan_name, $ad_duration, $no_of_ads, $ad_type, $plan_price, $plan_id);
        $sql->execute();
    }

    public function deleteMembershipPlanByPlanId($id)
    {
        global $conn;
        $sql = "DELETE FROM membership_plans WHERE plan_id=$id";
        $result = $conn->query($sql);
    }

    public function getAllMembershipPlans()
    {
        global $conn;
        $sql = "SELECT * FROM membership_plans";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $membershipPlanObjects = array();
            while ($row = $result->fetch_assoc()) {
                $membershipPlan = new MembershipPlan();
                $membershipPlan->setPlan_id($row["plan_id"]);
				$membershipPlan->setPlan_id_sal($row["plan_id_sal"]);
				$membershipPlan->setLanguage($row["language"]);
                $membershipPlan->setRole_id($row["role_id"]);
                $membershipPlan->setPlan_name($row["plan_name"]);
                $membershipPlan->setAd_duration($row["ad_duration"]);
                $membershipPlan->setNo_of_ads($row["no_of_ads"]);
                $membershipPlan->setAd_type($row["ad_type"]);
                $membershipPlan->setPlan_price($row["plan_price"]);
                array_push($membershipPlanObjects, $membershipPlan);
            }
            return $membershipPlanObjects;
        }
    }
}
