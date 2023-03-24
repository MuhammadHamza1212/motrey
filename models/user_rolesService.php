<?php

include "user_roles.php";

class UserRolesService
{
    public function addUserRoles($userRoles)
    {
        global $conn;
        $userId = $userRoles->getUser_id();
        $roleId = $userRoles->getRole_id();
        $createdAt = $userRoles->getCreated_at();
        $createdBy = $userRoles->getCreated_by();
        $sql = $conn->prepare("INSERT INTO users_roles (user_id, role_id, created_at, created_by) VALUES (?, ?, ?, ?)");
        $sql->bind_param("iisi", $userId, $roleId, $createdAt, $createdBy);
        $sql->execute();
    }

    public function getUserRolesByUserId($id)
    {
        global $conn;
        $sql = "SELECT * FROM users_roles WHERE user_id=$id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $usersRolesObjects = array();
            while ($row = $result->fetch_assoc()) {
                $userRole = new UserRoles();
                $userRole->setUser_role_id($row["user_role_id"]);
                $userRole->setUser_id($row["user_id"]);
                $userRole->setRole_id($row["role_id"]);
                $userRole->setCreated_at($row["created_at"]);
                $userRole->setCreated_by($row["created_by"]);
                array_push($usersRolesObjects, $userRole);
            }
            return $usersRolesObjects;
        }
    }

    public function getUserRolesByRoleId($id)
    {
        global $conn;
        $sql = "SELECT * FROM users_roles WHERE role_id=$id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $usersRolesObjects = array();
            while ($row = $result->fetch_assoc()) {
                $userRole = new UserRoles();
                $userRole->setUser_role_id($row["user_role_id"]);
                $userRole->setUser_id($row["user_id"]);
                $userRole->setRole_id($row["role_id"]);
                $userRole->setCreated_at($row["created_at"]);
                $userRole->setCreated_by($row["created_by"]);
                array_push($usersRolesObjects, $userRole);
            }
            return $usersRolesObjects;
        }
    }

    public function deleteUserRoleByUserRoleId($id)
    {
        global $conn;
        $sql = "DELETE FROM users_roles WHERE user_role_id=$id";
        $result = $conn->query($sql);
    }

    public function deleteUserRoleByUserIdExceptPrivateAndDealer($id)
    {
        global $conn;
        $sql = "DELETE FROM users_roles WHERE user_id=$id AND role_id NOT IN (1, 2)";
        $result = $conn->query($sql);
    }
}
