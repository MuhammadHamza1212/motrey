<?php

class City{
    private $city_id;
	private $city_id_sal;
	private $language;
    private $name;
    private $country_id;

    public function getCity_id(){
		return $this->city_id;
	}

	public function setCity_id($city_id){
		$this->city_id = $city_id;
	}
	
	public function getCity_id_sal(){
		return $this->city_id_sal;
	}

	public function setCity_id_sal($city_id_sal){
		$this->city_id_sal = $city_id_sal;
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

	public function getCountry_id(){
		return $this->country_id;
	}

	public function setCountry_id($country_id){
		$this->country_id = $country_id;
	}
}


?>