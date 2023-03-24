<?php

include "role.php";

class RoleService
{
    public function addRole($role)
    {
        global $conn;
        $name = $role->getName();
        $created_at = $role->getCreated_at();
        $created_by = $role->getCreated_by();
        $updated_at = $role->getUpdated_at();
        $updated_by = $role->getUpdated_by();
        $sql = $conn->prepare("INSERT INTO roles (name, created_at, created_by, updated_at, updated_by) VALUES (?, ?, ?, ?, ?)");
        $sql->bind_param("ssisi", $name, $created_at, $created_by, $updated_at, $updated_by);
        $sql->execute();
    }

    public function getRoleById($id)
    {
        global $conn;
        $sql = "SELECT * FROM roles WHERE role_id=$id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $role = new Role();
            $role->setRole_id($row["role_id"]);
            $role->setName($row["name"]);
            $role->setCreated_at($row["created_at"]);
            $role->setCreated_by($row["created_by"]);
            $role->setUpdated_at($row["updated_at"]);
            $role->setUpdated_by($row["updated_by"]);
            return $role;
        }
    }

    public function getRoleByName($name)
    {
        global $conn;
        $sql = "SELECT * FROM roles WHERE name='$name'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $role = new Role();
            $role->setRole_id($row["role_id"]);
            $role->setName($row["name"]);
            $role->setCreated_at($row["created_at"]);
            $role->setCreated_by($row["created_by"]);
            $role->setUpdated_at($row["updated_at"]);
            $role->setUpdated_by($row["updated_by"]);
            return $role;
        }
    }

    public function updateRoleById($role)
    {
        global $conn;
        $role_id = $role->getRole_id();
        $name = $role->getName();
        $created_at = $role->getCreated_at();
        $created_by = $role->getCreated_by();
        $updated_at = $role->getUpdated_at();
        $updated_by = $role->getUpdated_by();
        $sql = $conn->prepare("UPDATE roles SET name=?, created_at=?, created_by=?, updated_at=?, updated_by=? WHERE role_id=?");
        $sql->bind_param("ssisii", $name, $created_at, $created_by, $updated_at, $updated_by, $role_id);
        $sql->execute();
    }

    public function deleteRoleById($id)
    {
        global $conn;
        $sql = "DELETE FROM roles WHERE role_id=$id";
        $result = $conn->query($sql);
    }

    public function getAllRoles()
    {
        global $conn;
        $sql = "SELECT * FROM roles";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $rolesObjects = array();
            while ($row = $result->fetch_assoc()) {
                $role = new Role();
                $role->setRole_id($row["role_id"]);
                $role->setName($row["name"]);
                $role->setCreated_at($row["created_at"]);
                $role->setCreated_by($row["created_by"]);
                $role->setUpdated_at($row["updated_at"]);
                $role->setUpdated_by($row["updated_by"]);
                array_push($rolesObjects, $role);
            }
            return $rolesObjects;
        }
    }

    public function getAllRolesExceptPrivateAndDealerSeller()
    {
        global $conn;
        $sql = "SELECT * FROM roles Where name NOT IN('Private Seller','Dealer Seller');";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $rolesObjects = array();
            while ($row = $result->fetch_assoc()) {
                $role = new Role();
                $role->setRole_id($row["role_id"]);
                $role->setName($row["name"]);
                $role->setCreated_at($row["created_at"]);
                $role->setCreated_by($row["created_by"]);
                $role->setUpdated_at($row["updated_at"]);
                $role->setUpdated_by($row["updated_by"]);
                array_push($rolesObjects, $role);
            }
            return $rolesObjects;
        }
    }
}
