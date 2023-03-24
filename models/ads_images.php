<?php

class AdsImages{
    private $image_id;
    private $ad_id;
    private $image_path;
    private $created_at;

    public function getImage_id(){
		return $this->image_id;
	}

	public function setImage_id($image_id){
		$this->image_id = $image_id;
	}

	public function getAd_id(){
		return $this->ad_id;
	}

	public function setAd_id($ad_id){
		$this->ad_id = $ad_id;
	}

	public function getImage_path(){
		return $this->image_path;
	}

	public function setImage_path($image_path){
		$this->image_path = $image_path;
	}

	public function getCreated_at(){
		return $this->created_at;
	}

	public function setCreated_at($created_at){
		$this->created_at = $created_at;
	}

}


?>