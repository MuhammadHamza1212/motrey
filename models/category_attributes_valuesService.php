<?php

include "category_attributes_values.php";

class CategoryAttributesValuesService
{
    public function addCategoryAttributesValues($categoryAttributesValues)
    {
        global $conn;
        $attribute_id = $categoryAttributesValues->getAttribute_id();
        $ad_id = $categoryAttributesValues->getAd_id();
        $value = $categoryAttributesValues->getValue();
        $sql = $conn->prepare("INSERT INTO category_attributes_values (attribute_id, ad_id, value) VALUES (?, ?, ?)");
        $sql->bind_param("iis", $attribute_id, $ad_id, $value);
        $sql->execute();
    }

    public function getAllCategoryAttributesValuesByAdId($id)
    {
        global $conn;
        $sql = "SELECT * FROM category_attributes_values WHERE ad_id=$id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $categoryAttributesValuesObjects = array();
            while ($row = $result->fetch_assoc()) {
                $categoryAttributesValues = new CategoryAttributesValues();
                $categoryAttributesValues->setValue_id($row["value_id"]);
                $categoryAttributesValues->setAttribute_id($row["attribute_id"]);
                $categoryAttributesValues->setAd_id($row["ad_id"]);
                $categoryAttributesValues->setValue($row["value"]);
                array_push($categoryAttributesValuesObjects, $categoryAttributesValues);
            }
            return $categoryAttributesValuesObjects;
        }
    }

    public function getCategoryAttributesValueByAdIdAndAttributeId($ad_id, $attribute_id)
    {
        global $conn;
        $sql = "SELECT * FROM category_attributes_values WHERE ad_id=$ad_id AND attribute_id=$attribute_id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$categoryAttributesValues = new CategoryAttributesValues();
			$categoryAttributesValues->setValue_id($row["value_id"]);
			$categoryAttributesValues->setAttribute_id($row["attribute_id"]);
			$categoryAttributesValues->setAd_id($row["ad_id"]);
			$categoryAttributesValues->setValue($row["value"]);
			return $categoryAttributesValues;
        }
    }

    public function updateCategoryAttributesValuesByValueId($categoryAttributesValues)
    {
        global $conn;
        $value_id = $categoryAttributesValues->getValue_id();
        $attribute_id = $categoryAttributesValues->getAttribute_id();
        $ad_id = $categoryAttributesValues->getAd_id();
        $value = $categoryAttributesValues->getValue();
        $sql = $conn->prepare("UPDATE category_attributes_values SET attribute_id=?, ad_id=?, value=? WHERE value_id=?");
        $sql->bind_param("iisi", $attribute_id, $ad_id, $value, $value_id);
        $sql->execute();
    }

    public function deleteCategoryAttributesValuesByRoleValueId($id)
    {
        global $conn;
        $sql = "DELETE FROM category_attributes_values WHERE value_id=$id";
        $result = $conn->query($sql);
    }
}
