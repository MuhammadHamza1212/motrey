<?php

class CategoriesAttributes{
    private $attribute_id;
	private $attribute_id_sal;
	private $language;
    private $category_id;
    private $name;
    private $element_type;
    private $description;
	private $icon_image_path;
    private $created_at;
    private $created_by;
    private $updated_at;
    private $updated_by;

    public function getAttribute_id(){
		return $this->attribute_id;
	}

	public function setAttribute_id($attribute_id){
		$this->attribute_id = $attribute_id;
	}
	
	public function getAttribute_id_sal(){
		return $this->attribute_id_sal;
	}

	public function setAttribute_id_sal($attribute_id_sal){
		$this->attribute_id_sal = $attribute_id_sal;
	}

	public function getLanguage(){
		return $this->language;
	}

	public function setLanguage($language){
		$this->language = $language;
	}
	
	public function getCategory_id(){
		return $this->category_id;
	}

	public function setCategory_id($category_id){
		$this->category_id = $category_id;
	}

	public function getName(){
		return $this->name;
	}

	public function setName($name){
		$this->name = $name;
	}

	public function getElement_type(){
		return $this->element_type;
	}

	public function setElement_type($element_type){
		$this->element_type = $element_type;
	}
	
	public function getDescription(){
		return $this->description;
	}

	public function setDescription($description){
		$this->description = $description;
	}
	
	public function getIcon_image_path(){
		return $this->icon_image_path;
	}

	public function setIcon_image_path($icon_image_path){
		$this->icon_image_path = $icon_image_path;
	}
	
	public function getCreated_at(){
		return $this->created_at;
	}

	public function setCreated_at($created_at){
		$this->created_at = $created_at;
	}

	public function getCreated_by(){
		return $this->created_by;
	}

	public function setCreated_by($created_by){
		$this->created_by = $created_by;
	}

	public function getUpdated_at(){
		return $this->updated_at;
	}

	public function setUpdated_at($updated_at){
		$this->updated_at = $updated_at;
	}

	public function getUpdated_by(){
		return $this->updated_by;
	}

	public function setUpdated_by($updated_by){
		$this->updated_by = $updated_by;
	}
}


?>