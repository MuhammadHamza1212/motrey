<?php

class CategoryAttributesOptions{
    private $option_id;
    private $attribute_id;
    private $option_value;

    public function getOption_id(){
		return $this->option_id;
	}

	public function setOption_id($option_id){
		$this->option_id = $option_id;
	}

	public function getAttribute_id(){
		return $this->attribute_id;
	}

	public function setAttribute_id($attribute_id){
		$this->attribute_id = $attribute_id;
	}

	public function getOption_value(){
		return $this->option_value;
	}

	public function setOption_value($option_value){
		$this->option_value = $option_value;
	}
}


?>