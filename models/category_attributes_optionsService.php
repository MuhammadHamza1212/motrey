<?php

include "category_attributes_options.php";

class CategoryAttributesOptionsService
{
    public function addCategoryAttributeOptions($categoryAttributesOptions)
    {
        global $conn;
        $attribute_id = $categoryAttributesOptions->getAttribute_id();
        $option_value= $categoryAttributesOptions->getOption_value();
        $sql = $conn->prepare("INSERT INTO category_attributes_options (attribute_id, option_value) VALUES (?, ?)");
        $sql->bind_param("is", $attribute_id, $option_value);
        $sql->execute();
    }

    public function getCategoryAttributeOptionsByOptionId($id)
    {
        global $conn;
        $sql = "SELECT * FROM category_attributes_options WHERE option_id=$id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $categoryAttributesOptions = new CategoryAttributesOptions();
            $categoryAttributesOptions->setOption_id($row["option_id"]);
            $categoryAttributesOptions->setAttribute_id($row["attribute_id"]);
            $categoryAttributesOptions->setOption_value($row["option_value"]);
            return $categoryAttributesOptions;
        }
    }

    public function getCategoryAttributesOptionsByAttributeId($id)
    {
        global $conn;
        $sql = "SELECT * FROM category_attributes_options WHERE attribute_id=$id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $categoryAttributesOptionsObject = array();
            while ($row = $result->fetch_assoc()) {
                $categoryAttributesOptions = new CategoryAttributesOptions();
                $categoryAttributesOptions->setOption_id($row["option_id"]);
                $categoryAttributesOptions->setAttribute_id($row["attribute_id"]);
                $categoryAttributesOptions->setOption_value($row["option_value"]);
                array_push($categoryAttributesOptionsObject, $categoryAttributesOptions);
            }
            return $categoryAttributesOptionsObject;
        }
    }

    public function updateCategoriesAttributesByAttributeId($categoryAttributesOptions)
    {
        global $conn;
        $option_id = $categoryAttributesOptions->getOption_id();
        $attribute_id = $categoryAttributesOptions->getAttribute_id();
        $option_value= $categoryAttributesOptions->getOption_value();
        $sql = $conn->prepare("UPDATE category_attributes_options SET attribute_id=?, option_value=? WHERE option_id=?");
        $sql->bind_param("isi", $attribute_id, $option_value, $option_id);
        $sql->execute();
    }

    public function updateCategoryAttributeOptionByOptionId($categoryAttributeOption)
    {
        global $conn;
        $option_id = $categoryAttributeOption->getOption_id();
        $option_value= $categoryAttributeOption->getOption_value();
        $sql = $conn->prepare("UPDATE category_attributes_options SET option_value=? WHERE option_id=?");
        $sql->bind_param("si", $option_value, $option_id);
        $sql->execute();
    }

    public function deleteCategoryAttributesOptionsByOptionId($id)
    {
        global $conn;
        $sql = "DELETE FROM category_attributes_options WHERE option_id=$id";
        $result = $conn->query($sql);
    }
}
