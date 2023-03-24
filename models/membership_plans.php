<?php

class MembershipPlan{
    private $plan_id;
	private $plan_id_sal;
	private $language;
    private $role_id;
    private $plan_name;
    private $ad_duration;
    private $no_of_ads;
    private $ad_type;
    private $plan_price;

    public function getPlan_id(){
		return $this->plan_id;
	}

	public function setPlan_id($plan_id){
		$this->plan_id = $plan_id;
	}
	
	public function getPlan_id_sal(){
		return $this->plan_id_sal;
	}

	public function setPlan_id_sal($plan_id_sal){
		$this->plan_id_sal = $plan_id_sal;
	}

	public function getLanguage(){
		return $this->language;
	}

	public function setLanguage($language){
		$this->language = $language;
	}
	
	public function getRole_id(){
		return $this->role_id;
	}

	public function setRole_id($role_id){
		$this->role_id = $role_id;
	}

	public function getPlan_name(){
		return $this->plan_name;
	}

	public function setPlan_name($plan_name){
		$this->plan_name = $plan_name;
	}

	public function getAd_duration(){
		return $this->ad_duration;
	}

	public function setAd_duration($ad_duration){
		$this->ad_duration = $ad_duration;
	}

	public function getNo_of_ads(){
		return $this->no_of_ads;
	}

	public function setNo_of_ads($no_of_ads){
		$this->no_of_ads = $no_of_ads;
	}

	public function getAd_type(){
		return $this->ad_type;
	}

	public function setAd_type($ad_type){
		$this->ad_type = $ad_type;
	}

	public function getPlan_price(){
		return $this->plan_price;
	}

	public function setPlan_price($plan_price){
		$this->plan_price = $plan_price;
	}
}


?>