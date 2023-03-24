<?php

include "categories_attributes.php";

class CategoriesAttributesService
{
    public function addCategoryAttribute($categoriesAttributes)
    {
        global $conn;
		$attribute_id_sal = $categoriesAttributes->getAttribute_id_sal();
		$language = $categoriesAttributes->getLanguage();
        $category_id = $categoriesAttributes->getCategory_id();
        $name = $categoriesAttributes->getName();
        $element_type = $categoriesAttributes->getElement_type();
        $description = $categoriesAttributes->getDescription();
		$icon_image_path = $categoriesAttributes->getIcon_image_path();
        $created_at = $categoriesAttributes->getCreated_at();
        $created_by = $categoriesAttributes->getCreated_by();
        $updated_at = $categoriesAttributes->getUpdated_at();
        $updated_by = $categoriesAttributes->getUpdated_by();
        $sql = $conn->prepare("INSERT INTO categories_attributes (attribute_id_sal, language, category_id, name, element_type, description, icon_image_path, created_at, created_by, updated_at, updated_by) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $sql->bind_param("isisssssisi", $attribute_id_sal, $language, $category_id, $name, $element_type, $description, $icon_image_path, $created_at, $created_by, $updated_at, $updated_by);
        $sql->execute();
    }

    public function getCategoriesAttributeByAttributeId($id)
    {
        global $conn;
        $sql = "SELECT * FROM categories_attributes WHERE attribute_id=$id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $categoriesAttributes = new CategoriesAttributes();
            $categoriesAttributes->setAttribute_id($row["attribute_id"]);
			$categoriesAttributes->setAttribute_id_sal($row["attribute_id_sal"]);
			$categoriesAttributes->setLanguage($row["language"]);
            $categoriesAttributes->setCategory_id($row["category_id"]);
            $categoriesAttributes->setName($row["name"]);
            $categoriesAttributes->setElement_type($row["element_type"]);
            $categoriesAttributes->setDescription($row["description"]);
			$categoriesAttributes->setIcon_image_path($row["icon_image_path"]);
            $categoriesAttributes->setCreated_at($row["created_at"]);
            $categoriesAttributes->setCreated_by($row["created_by"]);
            $categoriesAttributes->setUpdated_at($row["updated_at"]);
            $categoriesAttributes->setUpdated_by($row["updated_by"]);
            return $categoriesAttributes;
        }
    }

    public function getCategoriesAttributesByCategoryId($id)
    {
        global $conn;
        $sql = "SELECT * FROM categories_attributes WHERE category_id=$id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $categoriesAttributesObjects = array();
            while ($row = $result->fetch_assoc()) {
                $categoriesAttributes = new CategoriesAttributes();
                $categoriesAttributes->setAttribute_id($row["attribute_id"]);
				$categoriesAttributes->setAttribute_id_sal($row["attribute_id_sal"]);
				$categoriesAttributes->setLanguage($row["language"]);
                $categoriesAttributes->setCategory_id($row["category_id"]);
                $categoriesAttributes->setName($row["name"]);
                $categoriesAttributes->setElement_type($row["element_type"]);
                $categoriesAttributes->setDescription($row["description"]);
				$categoriesAttributes->setIcon_image_path($row["icon_image_path"]);
                $categoriesAttributes->setCreated_at($row["created_at"]);
                $categoriesAttributes->setCreated_by($row["created_by"]);
                $categoriesAttributes->setUpdated_at($row["updated_at"]);
                $categoriesAttributes->setUpdated_by($row["updated_by"]);
                array_push($categoriesAttributesObjects, $categoriesAttributes);
            }
            return $categoriesAttributesObjects;
        }
    }

    public function updateCategoriesAttributesByAttributeId($categoriesAttributes)
    {
        global $conn;
        $attribute_id = $categoriesAttributes->getAttribute_id();
		$attribute_id_sal = $categoriesAttributes->getAttribute_id_sal();
		$language = $categoriesAttributes->getLanguage();
        $category_id = $categoriesAttributes->getCategory_id();
        $name = $categoriesAttributes->getName();
        $element_type = $categoriesAttributes->getElement_type();
        $description = $categoriesAttributes->getDescription();
		$icon_image_path = $categoriesAttributes->getIcon_image_path();
        $created_at = $categoriesAttributes->getCreated_at();
        $created_by = $categoriesAttributes->getCreated_by();
        $updated_at = $categoriesAttributes->getUpdated_at();
        $updated_by = $categoriesAttributes->getUpdated_by();
        $sql = $conn->prepare("UPDATE categories_attributes SET attribute_id_sal=?, language=?, category_id=?, name=?, element_type=?, description=?, icon_image_path=?, created_at=?, created_by=?, updated_at=?, updated_by=? WHERE attribute_id=?");
        $sql->bind_param("isisssssisii", $attribute_id_sal, $language, $category_id, $name, $element_type, $description, $icon_image_path, $created_at, $created_by, $updated_at, $updated_by, $attribute_id);
        $sql->execute();
    }

    public function deleteCategoriesAttributesByAttributeId($id)
    {
        global $conn;
        $sql = "DELETE FROM categories_attributes WHERE attribute_id=$id";
        $result = $conn->query($sql);
    }
}
