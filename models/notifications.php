<?php

class Notifications{
    private $notification_id;
    private $name;
    private $notification_criteria_id;
    private $message_template;
    private $validity_time;
    private $action;
    private $destinations;
    private $is_enabled;

    public function getNotification_id(){
		return $this->notification_id;
	}

	public function setNotification_id($notification_id){
		$this->notification_id = $notification_id;
	}

	public function getName(){
		return $this->name;
	}

	public function setName($name){
		$this->name = $name;
	}

	public function getNotification_criteria_id(){
		return $this->notification_criteria_id;
	}

	public function setNotification_criteria_id($notification_criteria_id){
		$this->notification_criteria_id = $notification_criteria_id;
	}

	public function getMessage_template(){
		return $this->message_template;
	}

	public function setMessage_template($message_template){
		$this->message_template = $message_template;
	}

	public function getValidity_time(){
		return $this->validity_time;
	}

	public function setValidity_time($validity_time){
		$this->validity_time = $validity_time;
	}

	public function getAction(){
		return $this->action;
	}

	public function setAction($action){
		$this->action = $action;
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