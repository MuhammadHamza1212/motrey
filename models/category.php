<?php

class Category{
    private $category_id;
	private $category_id_sal;
	private $language;
    private $name;
    private $description;
    private $parent_category_id;
    private $created_at;
    private $created_by;
    private $updated_at;
    private $updated_by;
	private $is_active;

    public function getCategory_id(){
		return $this->category_id;
	}

	public function setCategory_id($category_id){
		$this->category_id = $category_id;
	}
	
	public function getCategory_id_sal(){
		return $this->category_id_sal;
	}

	public function setCategory_id_sal($category_id_sal){
		$this->category_id_sal = $category_id_sal;
	}
	
	public function getLanguage(){
		return $this->language;
	}

	public function setLanguage($language){
		$this->language = $language;
	}

	public function getName(){
		return $this->name;
	}

	public function setName($name){
		$this->name = $name;
	}

	public function getDescription(){
		return $this->description;
	}

	public function setDescription($description){
		$this->description = $description;
	}

	public function getParent_category_id(){
		return $this->parent_category_id;
	}

	public function setParent_category_id($parent_category_id){
		$this->parent_category_id = $parent_category_id;
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
	
	public function getIs_active(){
		return $this->is_active;
	}

	public function setIs_active($is_active){
		$this->is_active = $is_active;
	}
}


?>