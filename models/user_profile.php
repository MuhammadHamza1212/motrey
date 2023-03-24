<?php

class UserProfile{
    private $user_id;
    private $first_name;
    private $last_name;
    private $profile_picture;
    private $address;
    private $birth_date;
    private $bio;
    private $updated_at;
    private $updated_by;

    public function getUser_id(){
		return $this->user_id;
	}

	public function setUser_id($user_id){
		$this->user_id = $user_id;
	}

	public function getFirst_name(){
		return $this->first_name;
	}

	public function setFirst_name($first_name){
		$this->first_name = $first_name;
	}

	public function getLast_name(){
		return $this->last_name;
	}

	public function setLast_name($last_name){
		$this->last_name = $last_name;
	}

	public function getProfile_picture(){
		return $this->profile_picture;
	}

	public function setProfile_picture($profile_picture){
		$this->profile_picture = $profile_picture;
	}

	public function getAddress(){
		return $this->address;
	}

	public function setAddress($address){
		$this->address = $address;
	}

	public function getBirth_date(){
		return $this->birth_date;
	}

	public function setBirth_date($birth_date){
		$this->birth_date = $birth_date;
	}

	public function getBio(){
		return $this->bio;
	}

	public function setBio($bio){
		$this->bio = $bio;
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
}


?>