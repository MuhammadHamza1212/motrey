<?php

class FavoriteAd{
    private $favorite_id;
	private $user_id;
	private $ad_id;
    private $created_at;

	public function getFavorite_id(){
		return $this->favorite_id;
	}

	public function setFavorite_id($favorite_id){
		$this->favorite_id = $favorite_id;
	}
	
	public function getUser_id(){
		return $this->user_id;
	}

	public function setUser_id($user_id){
		$this->user_id = $user_id;
	}
	
	public function getAd_id(){
		return $this->ad_id;
	}

	public function setAd_id($ad_id){
		$this->ad_id = $ad_id;
	}

	public function getCreated_at(){
		return $this->created_at;
	}

	public function setCreated_at($created_at){
		$this->created_at = $created_at;
	}
}
?>