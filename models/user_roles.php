<?php

class UserRoles{
    private $user_role_id;
    private $user_id;
    private $role_id;
    private $created_at;
    private $created_by;

    public function getUser_role_id(){
		return $this->user_role_id;
	}

	public function setUser_role_id($user_role_id){
		$this->user_role_id = $user_role_id;
	}

	public function getUser_id(){
		return $this->user_id;
	}

	public function setUser_id($user_id){
		$this->user_id = $user_id;
	}

	public function getRole_id(){
		return $this->role_id;
	}

	public function setRole_id($role_id){
		$this->role_id = $role_id;
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
}


?>