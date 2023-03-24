<?php

class User{
    private $user_id;
    private $membership_plan_id;
    private $username;
    private $email;
    private $phone;
    private $created_at;
    private $created_by;
    private $updated_at;
    private $updated_by;
    private $status;
    private $google_account;
    private $facebook_account;
	private $facebook_id;

    public function getUser_id(){
		return $this->user_id;
	}

	public function setUser_id($user_id){
		$this->user_id = $user_id;
	}

	public function getMembership_plan_id(){
		return $this->membership_plan_id;
	}

	public function setMembership_plan_id($membership_plan_id){
		$this->membership_plan_id = $membership_plan_id;
	}

	public function getUsername(){
		return $this->username;
	}

	public function setUsername($username){
		$this->username = $username;
	}

	public function getEmail(){
		return $this->email;
	}

	public function setEmail($email){
		$this->email = $email;
	}

	public function getPhone(){
		return $this->phone;
	}

	public function setPhone($phone){
		$this->phone = $phone;
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

	public function getStatus(){
		return $this->status;
	}

	public function setStatus($status){
		$this->status = $status;
	}

	public function getGoogle_account(){
		return $this->google_account;
	}

	public function setGoogle_account($google_account){
		$this->google_account = $google_account;
	}

	public function getFacebook_account(){
		return $this->facebook_account;
	}

	public function setFacebook_account($facebook_account){
		$this->facebook_account = $facebook_account;
	}
	
	public function getFacebook_id(){
		return $this->facebook_id;
	}

	public function setFacebook_id($facebook_id){
		$this->facebook_id = $facebook_id;
	}
}


?>