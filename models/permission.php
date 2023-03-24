<?php

class Permission{
    private $permission_id;
    private $type;
    private $entity;
    private $created_at;
    private $created_by;

    public function getPermission_id(){
		return $this->permission_id;
	}

	public function setPermission_id($permission_id){
		$this->permission_id = $permission_id;
	}

	public function getType(){
		return $this->type;
	}

	public function setType($type){
		$this->type = $type;
	}

	public function getEntity(){
		return $this->entity;
	}

	public function setEntity($entity){
		$this->entity = $entity;
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