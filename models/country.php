<?php

class Country{
    private $country_id;
	private $country_id_sal;
	private $language;
    private $name;
    private $flag;
    private $dialing_code;
    private $iso_code;
    private $currency;

	public function getCountry_id(){
		return $this->country_id;
	}

	public function setCountry_id($country_id){
		$this->country_id = $country_id;
	}
	
	public function getCountry_id_sal(){
		return $this->country_id_sal;
	}

	public function setCountry_id_sal($country_id_sal){
		$this->country_id_sal = $country_id_sal;
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

	public function getFlag(){
		return $this->flag;
	}

	public function setFlag($flag){
		$this->flag = $flag;
	}

	public function getDialing_code(){
		return $this->dialing_code;
	}

	public function setDialing_code($dialing_code){
		$this->dialing_code = $dialing_code;
	}

	public function getIso_code(){
		return $this->iso_code;
	}

	public function setIso_code($iso_code){
		$this->iso_code = $iso_code;
	}

	public function getCurrency(){
		return $this->currency;
	}

	public function setCurrency($currency){
		$this->currency = $currency;
	}
}
?>