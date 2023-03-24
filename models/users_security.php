<?php

class UserSecurity{
    private $user_id;
    private $password_hash;
    private $salt;
    private $updated_at;
    private $token;
	private $token_expiration_time;

    public function getUser_id(){
		return $this->user_id;
	}

	public function setUser_id($user_id){
		$this->user_id = $user_id;
	}

	public function getPassword_hash(){
		return $this->password_hash;
	}

	public function setPassword_hash($password_hash){
		$this->password_hash = $password_hash;
	}

	public function getSalt(){
		return $this->salt;
	}

	public function setSalt($salt){
		$this->salt = $salt;
	}

	public function getUpdated_at(){
		return $this->updated_at;
	}

	public function setUpdated_at($updated_at){
		$this->updated_at = $updated_at;
	}

	public function getToken(){
		return $this->token;
	}

	public function setToken($token){
		$this->token = $token;
	}
	
	public function getToken_expiration_time(){
		return $this->token_expiration_time;
	}

	public function setToken_expiration_time($token_expiration_time){
		$this->token_expiration_time = $token_expiration_time;
	}
}


?>