<?php

include "user.php";

class UserService
{
    public function addUser($user)
    {
        global $conn;
        $membershipPlanId = $user->getMembership_plan_id();
        $userName = $user->getUsername();
        $userEmail = $user->getEmail();
        $userPhone = $user->getPhone();
        $userCreatedAt = $user->getCreated_at();
        $userCreatedBy = $user->getCreated_by();
        $userUpdatedAt = $user->getUpdated_at();
        $userUpdatedBy = $user->getUpdated_by();
        $userStatus = $user->getStatus();
        $googleAcount = $user->getGoogle_account();
        $facebookAccount = $user->getFacebook_account();
		$facebookId = $user->getFacebook_id();
        $sql = $conn->prepare("INSERT INTO users (membership_plan_id, username, email, phone, created_at, created_by, updated_at, updated_by, status, google_account, facebook_account, facebook_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $sql->bind_param("issssisissss", $membershipPlanId, $userName, $userEmail, $userPhone, $userCreatedAt, $userCreatedBy, $userUpdatedAt, $userUpdatedBy, $userStatus, $googleAcount, $facebookAccount, $facebookId);
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
        if (!$sql->execute()) {
            echo "Execute failed: (" . $sql->errno . ") " . $sql->error;
        }
    }

    public function getUserById($id)
    {
        global $conn;
        $sql = "SELECT * FROM users WHERE user_id=$id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $user = new User();
            $user->setMembership_plan_id($row["membership_plan_id"]);
            $user->setUser_id($row["user_id"]);
            $user->setUsername($row["username"]);
            $user->setEmail($row["email"]);
            $user->setPhone($row["phone"]);
            $user->setCreated_at($row["created_at"]);
            $user->setCreated_by($row["created_by"]);
            $user->setUpdated_at($row["updated_at"]);
            $user->setUpdated_by($row["updated_by"]);
            $user->setStatus($row["status"]);
            $user->setGoogle_account($row["google_account"]);
            $user->setFacebook_account($row["facebook_account"]);
			$user->setFacebook_id($row["facebook_id"]);
            return $user;
        }
    }

    public function getUserByUserName($username)
    {
        global $conn;
        $sql = "SELECT * FROM users WHERE username='$username'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $user = new User();
            $user->setUser_id($row["user_id"]);
            $user->setMembership_plan_id($row["membership_plan_id"]);
            $user->setUsername($row["username"]);
            $user->setEmail($row["email"]);
            $user->setPhone($row["phone"]);
            $user->setCreated_at($row["created_at"]);
            $user->setCreated_by($row["created_by"]);
            $user->setUpdated_at($row["updated_at"]);
            $user->setUpdated_by($row["updated_by"]);
            $user->setStatus($row["status"]);
            $user->setGoogle_account($row["google_account"]);
            $user->setFacebook_account($row["facebook_account"]);
			$user->setFacebook_id($row["facebook_id"]);
            return $user;
        }
    }

    public function getUserByEmail($email)
    {
        global $conn;
        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $user = new User();
            $user->setUser_id($row["user_id"]);
            $user->setMembership_plan_id($row["membership_plan_id"]);
            $user->setUsername($row["username"]);
            $user->setEmail($row["email"]);
            $user->setPhone($row["phone"]);
            $user->setCreated_at($row["created_at"]);
            $user->setCreated_by($row["created_by"]);
            $user->setUpdated_at($row["updated_at"]);
            $user->setUpdated_by($row["updated_by"]);
            $user->setStatus($row["status"]);
            $user->setGoogle_account($row["google_account"]);
            $user->setFacebook_account($row["facebook_account"]);
			$user->setFacebook_id($row["facebook_id"]);
            return $user;
        }
    }
	
	public function getUserByFacebookId($facebookId)
    {
        global $conn;
        $sql = "SELECT * FROM users WHERE facebook_id='$facebookId'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $user = new User();
            $user->setUser_id($row["user_id"]);
            $user->setMembership_plan_id($row["membership_plan_id"]);
            $user->setUsername($row["username"]);
            $user->setEmail($row["email"]);
            $user->setPhone($row["phone"]);
            $user->setCreated_at($row["created_at"]);
            $user->setCreated_by($row["created_by"]);
            $user->setUpdated_at($row["updated_at"]);
            $user->setUpdated_by($row["updated_by"]);
            $user->setStatus($row["status"]);
            $user->setGoogle_account($row["google_account"]);
            $user->setFacebook_account($row["facebook_account"]);
			$user->setFacebook_id($row["facebook_id"]);
            return $user;
        }
    }

    public function updateUserById($user)
    {
        global $conn;
        $user_id = $user->getUser_id();
        $membership_plan_id = $user->getMembership_plan_id();
        $userName = $user->getUsername();
        $userEmail = $user->getEmail();
        $userPhone = $user->getPhone();
        $userCreatedAt = $user->getCreated_at();
        $userCreatedBy = $user->getCreated_by();
        $userUpdatedAt = $user->getUpdated_at();
        $userUpdatedBy = $user->getUpdated_by();
        $userStatus = $user->getStatus();
        $googleAcount = $user->getGoogle_account();
        $facebookAccount = $user->getFacebook_account();
		$facebookId = $user->getFacebook_id();
        $sql = $conn->prepare("UPDATE users SET membership_plan_id=?, username=?, email=?, phone=?, created_at=?, created_by=?, updated_at=?, updated_by=?, status=?, google_account=?, facebook_account=?, facebook_id=? WHERE user_id=?");
        $sql->bind_param("issssisissssi", $membership_plan_id, $userName, $userEmail, $userPhone, $userCreatedAt, $userCreatedBy, $userUpdatedAt, $userUpdatedBy, $userStatus, $googleAcount, $facebookAccount, $facebookId, $user_id);
        $sql->execute();
    }

    public function deleteUserById($id)
    {
        global $conn;
        $sql = "DELETE FROM users WHERE user_id=$id";
        $result = $conn->query($sql);
    }

    public function softDeleteUserById($id)
    {
        global $conn; 
        $sql = "UPDATE users SET status='Deleted' WHERE user_id=$id";
        $result = $conn->query($sql);
    }

    public function getAllUsers()
    {
        global $conn;
        $sql = "SELECT * FROM users";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $usersObjects = array();
            while ($row = $result->fetch_assoc()) {
                $user = new User();
                $user->setUser_id($row["user_id"]);
                $user->setMembership_plan_id($row["membership_plan_id"]);
                $user->setUsername($row["username"]);
                $user->setEmail($row["email"]);
                $user->setPhone($row["phone"]);
                $user->setCreated_at($row["created_at"]);
                $user->setCreated_by($row["created_by"]);
                $user->setUpdated_at($row["updated_at"]);
                $user->setUpdated_by($row["updated_by"]);
                $user->setStatus($row["status"]);
                $user->setGoogle_account($row["google_account"]);
                $user->setFacebook_account($row["facebook_account"]);
				$user->setFacebook_id($row["facebook_id"]);
                array_push($usersObjects, $user);
            }
            return $usersObjects;
        }
    }

    public function getAllUsersExceptDeletedStatus()
    {
        global $conn;
        $sql = "SELECT * FROM users WHERE status!='DELETED'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $usersObjects = array();
            while ($row = $result->fetch_assoc()) {
                $user = new User();
                $user->setUser_id($row["user_id"]);
                $user->setMembership_plan_id($row["membership_plan_id"]);
                $user->setUsername($row["username"]);
                $user->setEmail($row["email"]);
                $user->setPhone($row["phone"]);
                $user->setCreated_at($row["created_at"]);
                $user->setCreated_by($row["created_by"]);
                $user->setUpdated_at($row["updated_at"]);
                $user->setUpdated_by($row["updated_by"]);
                $user->setStatus($row["status"]);
                $user->setGoogle_account($row["google_account"]);
                $user->setFacebook_account($row["facebook_account"]);
				$user->setFacebook_id($row["facebook_id"]);
                array_push($usersObjects, $user);
            }
            return $usersObjects;
        }
    }
}
