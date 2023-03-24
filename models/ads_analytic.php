<?php

class AdsAnalytic{
    private $analytic_id;
    private $ad_id;
    private $views;
    private $clicks;

    public function getAnalytic_id(){
		return $this->analytic_id;
	}

	public function setAnalytic_id($analytic_id){
		$this->analytic_id = $analytic_id;
	}

	public function getAd_id(){
		return $this->ad_id;
	}

	public function setAd_id($ad_id){
		$this->ad_id = $ad_id;
	}

	public function getViews(){
		return $this->views;
	}

	public function setViews($views){
		$this->views = $views;
	}

	public function getClicks(){
		return $this->clicks;
	}

	public function setClicks($clicks){
		$this->clicks = $clicks;
	}
}


?>