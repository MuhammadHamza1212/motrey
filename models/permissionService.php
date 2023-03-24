<?php

include "permission.php";

class PermissionService
{
    public function addPermission($permission)
    {
        global $conn;
        $type = $permission->getType();
        $entity = $permission->getEntity();
        $created_at = $permission->getCreated_at();
        $created_by = $permission->getCreated_by();
        $sql = $conn->prepare("INSERT INTO permissions (type, entity, created_at, created_by) VALUES (?, ?, ?, ?, ?)");
        $sql->bind_param("sssi", $type, $entity, $created_at, $created_by);
        $sql->execute();
    }

    public function getPermissionById($id)
    {
        global $conn;
        $sql = "SELECT * FROM permissions WHERE permission_id=$id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $permission = new Permission();
            $permission->setPermission_id($row["permission_id"]);
            $permission->setType($row["type"]);
            $permission->setEntity($row["entity"]);
            $permission->setCreated_at($row["created_at"]);
            $permission->setCreated_by($row["created_by"]);
            return $permission;
        }
    }

    public function getPermissionByType($type)
    {
        global $conn;
        $sql = "SELECT * FROM permissions WHERE type='$type'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $permissionsObjects = array();
            while ($row = $result->fetch_assoc()) {
                $permission = new Permission();
                $permission->setPermission_id($row["permission_id"]);
                $permission->setType($row["type"]);
                $permission->setEntity($row["entity"]);
                $permission->setCreated_at($row["created_at"]);
                $permission->setCreated_by($row["created_by"]);
                array_push($permissionsObjects, $permission);
            }
            return $permissionsObjects;
        }
    }

    public function getPermissionByEntity($entity)
    {
        global $conn;
        $sql = "SELECT * FROM permissions WHERE entity='$entity'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $permissionsObjects = array();
            while ($row = $result->fetch_assoc()) {
                $permission = new Permission();
                $permission->setPermission_id($row["permission_id"]);
                $permission->setType($row["type"]);
                $permission->setEntity($row["entity"]);
                $permission->setCreated_at($row["created_at"]);
                $permission->setCreated_by($row["created_by"]);
                array_push($permissionsObjects, $permission);
            }
            return $permissionsObjects;
        }
    }

    public function updatePermissionById($permission)
    {
        global $conn;
        $permission_id = $permission->getPermission_id();
        $type = $permission->getType();
        $entity = $permission->getEntity();
        $created_at = $permission->getCreated_at();
        $created_by = $permission->getCreated_by();
        $sql = $conn->prepare("UPDATE permissions SET type=?, entity=?, created_at=?, created_by=? WHERE permission_id=?");
        $sql->bind_param("sssii", $type, $entity, $created_at, $created_by, $permission_id);
        $sql->execute();
    }

    public function deletePermissionById($id)
    {
        global $conn;
        $sql = "DELETE FROM permissions WHERE permission_id=$id";
        $result = $conn->query($sql);
    }

    public function getDistinctEntity()
    {
        global $conn;
        $sql = "SELECT DISTINCT entity FROM permissions";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $permissionsObjects = array();
            while ($row = $result->fetch_assoc()) {
                $permission = new Permission();
                $permission->setEntity($row["entity"]);
                array_push($permissionsObjects, $permission);
            }
            return $permissionsObjects;
        }
    }

    public function getAllPermission()
    {
        global $conn;
        $sql = "SELECT * FROM permissions";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $permissionsObjects = array();
            while ($row = $result->fetch_assoc()) {
                $permission = new Permission();
                $permission->setPermission_id($row["permission_id"]);
                $permission->setType($row["type"]);
                $permission->setEntity($row["entity"]);
                $permission->setCreated_at($row["created_at"]);
                $permission->setCreated_by($row["created_by"]);
                array_push($permissionsObjects, $permission);
            }
            return $permissionsObjects;
        }
    }
}
