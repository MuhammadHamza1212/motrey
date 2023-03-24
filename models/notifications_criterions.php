<?php

class NotificaitonsCriterions{
    private $notificaiton_criteria_id;
    private $name;
    private $parent_criteria_id;
    private $destinations;
    private $is_enabled;
    
    public function getNotificaiton_criteria_id(){
		return $this->notificaiton_criteria_id;
	}

	public function setNotificaiton_criteria_id($notificaiton_criteria_id){
		$this->notificaiton_criteria_id = $notificaiton_criteria_id;
	}

	public function getName(){
		return $this->name;
	}

	public function setName($name){
		$this->name = $name;
	}

	public function getParent_criteria_id(){
		return $this->parent_criteria_id;
	}

	public function setParent_criteria_id($parent_criteria_id){
		$this->parent_criteria_id = $parent_criteria_id;
	}

	public function getDestinations(){
		return $this->destinations;
	}

	public function setDestinations($destinations){
		$this->destinations = $destinations;
	}

	public function getIs_enabled(){
		return $this->is_enabled;
	}

	public function setIs_enabled($is_enabled){
		$this->is_enabled = $is_enabled;
	}
}


?>