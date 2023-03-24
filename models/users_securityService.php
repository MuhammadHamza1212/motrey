<?php

include "users_security.php";

class UserSecurityService
{
    public function addUserSecurity($userSecurity)
    {
        global $conn;
        $userId = $userSecurity->getUser_id();
        $passwordHash = $userSecurity->getPassword_hash();
        $salt = $userSecurity->getSalt();
        $updatedAt = $userSecurity->getUpdated_at();
        $token = $userSecurity->getToken();
		$token_expiration_time = $userSecurity->getToken_expiration_time();
        $sql = $conn->prepare("INSERT INTO users_security (user_id, password_hash, salt, updated_at, token, token_expiration_time) VALUES (?, ?, ?, ?, ?, ?)");
        $sql->bind_param("isisis", $userId, $passwordHash, $salt, $updatedAt, $token, $token_expiration_time);
        //$sql->execute();
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
        if (!$sql->execute()) {
            echo "Execute failed: (" . $sql->errno . ") " . $sql->error;
        } 
    }

    public function getUsersSecurityById($id)
    {
        global $conn;
        $sql = "SELECT * FROM users_security WHERE user_id=$id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $usersSecurity = new UserSecurity();
            $usersSecurity->setUser_id($row["user_id"]);
            $usersSecurity->setPassword_hash($row["password_hash"]);
            $usersSecurity->setSalt($row["salt"]);
            $usersSecurity->setUpdated_at($row["updated_at"]);
            $usersSecurity->setToken($row["token"]);
			$usersSecurity->setToken_expiration_time($row["token_expiration_time"]);
            return $usersSecurity;
        }
    }

	public function getUsersSecurityByUnexpiredToken($token)
    {
        global $conn;
        $sql = "SELECT * FROM users_security WHERE token=$token AND token_expiration_time > NOW()";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $usersSecurity = new UserSecurity();
            $usersSecurity->setUser_id($row["user_id"]);
            $usersSecurity->setPassword_hash($row["password_hash"]);
            $usersSecurity->setSalt($row["salt"]);
            $usersSecurity->setUpdated_at($row["updated_at"]);
            $usersSecurity->setToken($row["token"]);
			$usersSecurity->setToken_expiration_time($row["token_expiration_time"]);
            return $usersSecurity;
        }
    }
	
    public function updateUsersSecurityById($userSecurity)
    {
        global $conn;
        $userId = $userSecurity->getUser_id();
        $passwordHash = $userSecurity->getPassword_hash();
        $salt = $userSecurity->getSalt();
        $updatedAt = $userSecurity->getUpdated_at();
        $token = $userSecurity->getToken();
		$token_expiration_time = $userSecurity->getToken_expiration_time();
        $sql = $conn->prepare("UPDATE users_security SET password_hash=?, salt=?, updated_at=?, token=?, token_expiration_time=? WHERE user_id=?");
        $sql->bind_param("sisisi", $passwordHash, $salt, $updatedAt, $token, $token_expiration_time, $userId);
        $sql->execute();
    }

    public function deleteUsersSecurityById($id)
    {
        global $conn;
        $sql = "DELETE FROM users_security WHERE user_id=$id";
        $result = $conn->query($sql);
    }

    public function softDeleteUsersSecurityById($id)
    {
        global $conn;
        $sql = $conn->prepare("UPDATE users_security SET status=? WHERE user_id=?");
        $sql->bind_param("si", "DELETED", $id);
        $sql->execute();
    }

    public function getAllUsersSecurity()
    {
        global $conn;
        $sql = "SELECT * FROM users_security";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $usersSecurityObjects = array();
            while ($row = $result->fetch_assoc()) {
                $usersSecurity = new UsersSecurity();
                $usersSecurity->setUser_id($row["user_id"]);
                $usersSecurity->setPassword_hash($row["password_hash"]);
                $usersSecurity->setSalt($row["salt"]);
                $usersSecurity->setUpdated_at($row["updated_at"]);
                $usersSecurity->setToken($row["token"]);
				$usersSecurity->setToken_expiration_time($row["token_expiration_time"]);
                array_push($usersSecurityObjects, $usersSecurity);
            }
            return $usersSecurityObjects;
        }
    }
}
