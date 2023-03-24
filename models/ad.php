<?php

class Ad{
    private $ad_id;
    private $user_id;
    private $category_id;
	private $category_id_sal;
    private $ad_type;
    private $title;
    private $description;
    private $price;
    private $expiry_date;
    private $source_location_coordinates;
    private $source_location_address;
    private $posted_at;
    private $status;
	private $source_city_id;
	private $source_city_id_sal;
	private $source_country_id;
	private $source_country_id_sal;

	public function getAd_id(){
		return $this->ad_id;
	}

	public function setAd_id($ad_id){
		$this->ad_id = $ad_id;
	}

	public function getUser_id(){
		return $this->user_id;
	}

	public function setUser_id($user_id){
		$this->user_id = $user_id;
	}

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

	public function getAd_type(){
		return $this->ad_type;
	}

	public function setAd_type($ad_type){
		$this->ad_type = $ad_type;
	}

	public function getTitle(){
		return $this->title;
	}

	public function setTitle($title){
		$this->title = $title;
	}

	public function getDescription(){
		return $this->description;
	}

	public function setDescription($description){
		$this->description = $description;
	}

	public function getPrice(){
		return $this->price;
	}

	public function setPrice($price){
		$this->price = $price;
	}

	public function getExpiry_date(){
		return $this->expiry_date;
	}

	public function setExpiry_date($expiry_date){
		$this->expiry_date = $expiry_date;
	}

	public function getSource_location_coordinates(){
		return $this->source_location_coordinates;
	}

	public function setSource_location_coordinates($source_location_coordinates){
		$this->source_location_coordinates = $source_location_coordinates;
	}

	public function getSource_location_address(){
		return $this->source_location_address;
	}

	public function setSource_location_address($source_location_address){
		$this->source_location_address = $source_location_address;
	}

	public function getPosted_at(){
		return $this->posted_at;
	}

	public function setPosted_at($posted_at){
		$this->posted_at = $posted_at;
	}

	public function getStatus(){
		return $this->status;
	}

	public function setStatus($status){
		$this->status = $status;
	}

	public function getSource_city_id(){
		return $this->source_city_id;
	}

	public function setSource_city_id($source_city_id){
		$this->source_city_id = $source_city_id;
	}
	
	public function getSource_city_id_sal(){
		return $this->source_city_id_sal;
	}

	public function setSource_city_id_sal($source_city_id_sal){
		$this->source_city_id_sal = $source_city_id_sal;
	}

	public function getSource_country_id(){
		return $this->source_country_id;
	}

	public function setSource_country_id($source_country_id){
		$this->source_country_id = $source_country_id;
	}
	
	public function getSource_country_id_sal(){
		return $this->source_country_id_sal;
	}

	public function setSource_country_id_sal($source_country_id_sal){
		$this->source_country_id_sal = $source_country_id_sal;
	}
}


?>