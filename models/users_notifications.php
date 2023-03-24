<?php

class UsersNotifications{
    private $user_notification_id;
    private $user_id;
    private $notification_id;
    private $messge;
    private $created_at;
    private $expiration_time;
    private $status;

    public function getUser_notification_id(){
		return $this->user_notification_id;
	}

	public function setUser_notification_id($user_notification_id){
		$this->user_notification_id = $user_notification_id;
	}

	public function getUser_id(){
		return $this->user_id;
	}

	public function setUser_id($user_id){
		$this->user_id = $user_id;
	}

	public function getNotification_id(){
		return $this->notification_id;
	}

	public function setNotification_id($notification_id){
		$this->notification_id = $notification_id;
	}

	public function getMessge(){
		return $this->messge;
	}

	public function setMessge($messge){
		$this->messge = $messge;
	}

	public function getCreated_at(){
		return $this->created_at;
	}

	public function setCreated_at($created_at){
		$this->created_at = $created_at;
	}

	public function getExpiration_time(){
		return $this->expiration_time;
	}

	public function setExpiration_time($expiration_time){
		$this->expiration_time = $expiration_time;
	}

	public function getStatus(){
		return $this->status;
	}

	public function setStatus($status){
		$this->status = $status;
	}
}


?>