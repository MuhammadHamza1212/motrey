<?php

include "category.php";

class CategoryService
{
    public function addCategory($category)
    {
        global $conn;
		$category_id_sal = $category->getCategory_id_sal();
		$language = $category->getLanguage();
        $name = $category->getName();
        $description = $category->getDescription();
        $parent_category_id = $category->getParent_category_id();
        $created_at = $category->getCreated_at();
        $created_by = $category->getCreated_by();
        $updated_at = $category->getUpdated_at();
        $updated_by = $category->getUpdated_by();
		$is_active = $category->getIs_active();
        $sql = $conn->prepare("INSERT INTO categories (category_id_sal, language, name, description, parent_category_id, created_at, created_by, updated_at, updated_by, is_active) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $sql->bind_param("isssisisii", $category_id_sal, $language, $name, $description, $parent_category_id, $created_at, $created_by, $updated_at, $updated_by, $is_active);
        $sql->execute();
    }

    public function getCategoryById($id)
    {
		global $conn;
        $sql = "SELECT * FROM categories WHERE category_id=$id AND is_active=TRUE";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $category = new Category();
			$category->setCategory_id_sal($row["category_id_sal"]);
			$category->setLanguage($row["language"]);
            $category->setCategory_id($row["category_id"]);
            $category->setName($row["name"]);
            $category->setDescription($row["description"]);
            $category->setParent_category_id($row["parent_category_id"]);
            $category->setCreated_at($row["created_at"]);
            $category->setCreated_by($row["created_by"]);
            $category->setUpdated_at($row["updated_at"]);
            $category->setUpdated_by($row["updated_by"]);
			$category->setIs_active($row["is_active"]);
            return $category;
        }
    }

    public function getCategoryByName($name)
    {
        global $conn;
        $sql = "SELECT * FROM categories WHERE name='$name'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $category = new Category();
			$category->setCategory_id_sal($row["category_id_sal"]);
			$category->setLanguage($row["language"]);
            $category->setCategory_id($row["category_id"]);
            $category->setName($row["name"]);
            $category->setDescription($row["description"]);
            $category->setParent_category_id($row["parent_category_id"]);
            $category->setCreated_at($row["created_at"]);
            $category->setCreated_by($row["created_by"]);
            $category->setUpdated_at($row["updated_at"]);
            $category->setUpdated_by($row["updated_by"]);
			$category->setIs_active($row["is_active"]);
            return $category;
        }
    }

    public function getCategoriesByParentCategoryId($id)
    {
		global $conn;
        $sql = "SELECT * FROM categories WHERE parent_category_id=$id AND is_active=TRUE";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $categoriesObjects = array();
            while ($row = $result->fetch_assoc()) {
                $category = new Category();
				$category->setCategory_id_sal($row["category_id_sal"]);
				$category->setLanguage($row["language"]);
                $category->setCategory_id($row["category_id"]);
                $category->setName($row["name"]);
                $category->setDescription($row["description"]);
                $category->setParent_category_id($row["parent_category_id"]);
                $category->setCreated_at($row["created_at"]);
                $category->setCreated_by($row["created_by"]);
                $category->setUpdated_at($row["updated_at"]);
                $category->setUpdated_by($row["updated_by"]);
				$category->setIs_active($row["is_active"]);
                array_push($categoriesObjects, $category);
            }
            return $categoriesObjects;
        }
    }
	
	public function getCategoriesByParentCategoryIdAndLanguage($id, $language)
    {
		global $conn;
        $sql = "SELECT * FROM categories WHERE parent_category_id=$id AND language='$language' AND is_active=TRUE";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $categoriesObjects = array();
            while ($row = $result->fetch_assoc()) {
                $category = new Category();
				$category->setCategory_id_sal($row["category_id_sal"]);
				$category->setLanguage($row["language"]);
                $category->setCategory_id($row["category_id"]);
                $category->setName($row["name"]);
                $category->setDescription($row["description"]);
                $category->setParent_category_id($row["parent_category_id"]);
                $category->setCreated_at($row["created_at"]);
                $category->setCreated_by($row["created_by"]);
                $category->setUpdated_at($row["updated_at"]);
                $category->setUpdated_by($row["updated_by"]);
				$category->setIs_active($row["is_active"]);
                array_push($categoriesObjects, $category);
            }
            return $categoriesObjects;
        }
    }

	public function getAllCategoriesHierarchicallyByParentCategoryId($id)
	{
		global $conn;
        $sql = "SELECT * FROM categories WHERE parent_category_id=$id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $categoriesObjects = array();
            while ($row = $result->fetch_assoc()) {
                $category = new Category();
				$category->setCategory_id_sal($row["category_id_sal"]);
				$category->setLanguage($row["language"]);
                $category->setCategory_id($row["category_id"]);
                $category->setName($row["name"]);
                $category->setDescription($row["description"]);
                $category->setParent_category_id($row["parent_category_id"]);
                $category->setCreated_at($row["created_at"]);
                $category->setCreated_by($row["created_by"]);
                $category->setUpdated_at($row["updated_at"]);
                $category->setUpdated_by($row["updated_by"]);
				$category->setIs_active($row["is_active"]);
                array_push($categoriesObjects, $category);
				$childCategories = $this->getAllCategoriesHierarchicallyByParentCategoryId($row["category_id"]);
				if($childCategories !== NULL)
					$categoriesObjects = array_merge($categoriesObjects, $childCategories);
            }
            return $categoriesObjects;
        }
    }
	
    public function updateCategoryById($category)
    {
        global $conn;
		$category_id_sal = $category->getCategory_id_sal();
		$language = $category->getLanguage();
        $category_id = $category->getCategory_id();
        $name = $category->getName();
        $description = $category->getDescription();
        $parent_category_id = $category->getParent_category_id();
        $created_at = $category->getCreated_at();
        $created_by = $category->getCreated_by();
        $updated_at = $category->getUpdated_at();
        $updated_by = $category->getUpdated_by();
		$is_active = $category->getIs_active();
        $sql = $conn->prepare("UPDATE categories SET category_id_sal=?, language=?, name=?, description=?, parent_category_id=?, created_at=?, created_by=?, updated_at=?, updated_by=?, is_active=? WHERE category_id=?");
        $sql->bind_param("isssisisiii", $category_id_sal, $language, $name, $description, $parent_category_id, $created_at, $created_by, $updated_at, $updated_by, $is_active, $category_id);
        $sql->execute();
    }

    public function deleteCatgoryById($id)
    {
        global $conn;
        $sql = "DELETE FROM categories WHERE category_id=$id";
        $result = $conn->query($sql);
    }

    public function getAllCategories()
    {
        global $conn;
        $sql = "SELECT * FROM categories WHERE is_active=true";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $categoriesObjects = array();
            while ($row = $result->fetch_assoc()) {
                $category = new Category();
				$category->setCategory_id_sal($row["category_id_sal"]);
				$category->setLanguage($row["language"]);
                $category->setCategory_id($row["category_id"]);
                $category->setName($row["name"]);
                $category->setDescription($row["description"]);
                $category->setParent_category_id($row["parent_category_id"]);
                $category->setCreated_at($row["created_at"]);
                $category->setCreated_by($row["created_by"]);
                $category->setUpdated_at($row["updated_at"]);
                $category->setUpdated_by($row["updated_by"]);
				$category->setIs_active($row["is_active"]);
                array_push($categoriesObjects, $category);
            }
            return $categoriesObjects;
        }
    }
	
	public function getAllCategoriesByLanguage($language)
    {
        global $conn;
        $sql = "SELECT * FROM categories WHERE language='$language' AND is_active=true";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $categoriesObjects = array();
            while ($row = $result->fetch_assoc()) {
                $category = new Category();
				$category->setCategory_id_sal($row["category_id_sal"]);
				$category->setLanguage($row["language"]);
                $category->setCategory_id($row["category_id"]);
                $category->setName($row["name"]);
                $category->setDescription($row["description"]);
                $category->setParent_category_id($row["parent_category_id"]);
                $category->setCreated_at($row["created_at"]);
                $category->setCreated_by($row["created_by"]);
                $category->setUpdated_at($row["updated_at"]);
                $category->setUpdated_by($row["updated_by"]);
				$category->setIs_active($row["is_active"]);
                array_push($categoriesObjects, $category);
            }
            return $categoriesObjects;
        }
    }
}
