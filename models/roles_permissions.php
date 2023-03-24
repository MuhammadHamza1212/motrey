<?php

class RolesPermissions{
    private $role_permission_id;
    private $role_id;
    private $permission_id;
    private $created_at;
    private $created_by;

    public function getRole_permission_id(){
		return $this->role_permission_id;
	}

	public function setRole_permission_id($role_permission_id){
		$this->role_permission_id = $role_permission_id;
	}

	public function getRole_id(){
		return $this->role_id;
	}

	public function setRole_id($role_id){
		$this->role_id = $role_id;
	}

	public function getPermission_id(){
		return $this->permission_id;
	}

	public function setPermission_id($permission_id){
		$this->permission_id = $permission_id;
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