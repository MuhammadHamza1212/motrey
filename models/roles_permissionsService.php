<?php

include "roles_permissions.php";

class RolesPermissionsService
{
    public function addRolePermissionId($rolesPermissions)
    {
        global $conn;
        $id = $rolesPermissions->getRole_id();
        $permission_id = $rolesPermissions->getPermission_id();
        $created_at = $rolesPermissions->getCreated_at();
        $created_by = $rolesPermissions->getCreated_by();
        $sql = $conn->prepare("INSERT INTO roles_permissions (role_id, permission_id, created_at, created_by) VALUES (?, ?, ?, ?)");
        $sql->bind_param("iisi", $id, $permission_id, $created_at, $created_by);
        $sql->execute();
    }

    public function getRolesPermissionsByRoleId($id)
    {
        global $conn;
        $sql = "SELECT * FROM roles_permissions WHERE role_id=$id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $RolesPermissionsObjects = array();
            while ($row = $result->fetch_assoc()) {
                $RolesPermissions = new RolesPermissions();
                $RolesPermissions->setRole_id($row["role_id"]);
                $RolesPermissions->setPermission_id($row["permission_id"]);
                $RolesPermissions->setCreated_at($row["created_at"]);
                $RolesPermissions->setCreated_by($row["created_by"]);
                array_push($RolesPermissionsObjects, $RolesPermissions);
            }
            return $RolesPermissionsObjects;
        }
    }

    public function getRolesPermissionsByPermissionId($id)
    {
        global $conn;
        $sql = "SELECT * FROM roles_permissions WHERE permission_id=$id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $RolesPermissionsObjects = array();
            while ($row = $result->fetch_assoc()) {
                $RolesPermissions = new RolesPermissions();
                $RolesPermissions->setRole_id($row["role_id"]);
                $RolesPermissions->setPermission_id($row["permission_id"]);
                $RolesPermissions->setCreated_at($row["created_at"]);
                $RolesPermissions->setCreated_by($row["created_by"]);
                array_push($RolesPermissionsObjects, $RolesPermissions);
            }
            return $RolesPermissionsObjects;
        }
    }

    public function deleteRolePermissionsByRolePermissionId($id)
    {
        global $conn;
        $sql = "DELETE FROM roles_permissions WHERE role_permission_id=$id";
        $result = $conn->query($sql);
    }

    public function deleteRolePermissionsByRoleId($id)
    {
        global $conn;
        $sql = "DELETE FROM roles_permissions WHERE role_id=$id";
        $result = $conn->query($sql);
    }
}
