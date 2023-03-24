<?php

class CategoryAttributesValues{
    private $value_id;
    private $attribute_id;
    private $ad_id;
    private $value;

    public function getValue_id(){
		return $this->value_id;
	}

	public function setValue_id($value_id){
		$this->value_id = $value_id;
	}

	public function getAttribute_id(){
		return $this->attribute_id;
	}

	public function setAttribute_id($attribute_id){
		$this->attribute_id = $attribute_id;
	}

	public function getAd_id(){
		return $this->ad_id;
	}

	public function setAd_id($ad_id){
		$this->ad_id = $ad_id;
	}

	public function getValue(){
		return $this->value;
	}

	public function setValue($value){
		$this->value = $value;
	}
}


?>