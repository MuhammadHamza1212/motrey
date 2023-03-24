<?php

class AdsModeration{
    private $moderation_id;
    private $ad_id;
    private $status;
    private $moderated_at;
    private $moderated_by;

    public function getModeration_id(){
		return $this->moderation_id;
	}

	public function setModeration_id($moderation_id){
		$this->moderation_id = $moderation_id;
	}

	public function getAd_id(){
		return $this->ad_id;
	}

	public function setAd_id($ad_id){
		$this->ad_id = $ad_id;
	}

	public function getStatus(){
		return $this->status;
	}

	public function setStatus($status){
		$this->status = $status;
	}

	public function getModerated_at(){
		return $this->moderated_at;
	}

	public function setModerated_at($moderated_at){
		$this->moderated_at = $moderated_at;
	}

	public function getModerated_by(){
		return $this->moderated_by;
	}

	public function setModerated_by($moderated_by){
		$this->moderated_by = $moderated_by;
	}
}


?>