<?php

include "user_profile.php";

class UserProfileService
{
    public function addUserProfile($userProfile)
    {
        global $conn;
        $userId = $userProfile->getUser_id();
        $firstName = $userProfile->getFirst_name();
        $lastName = $userProfile->getLast_name();
        $profilePicture = $userProfile->getProfile_picture();
        $address = $userProfile->getAddress();
        $birthDate = $userProfile->getBirth_date();
        $bio = $userProfile->getBio();
        $updatedAt = $userProfile->getUpdated_at();
        $updatedBy = $userProfile->getUpdated_by();
        $sql = $conn->prepare("INSERT INTO users_profile (user_id, first_name, last_name, profile_picture, address, birth_date, bio, updated_at, updated_by) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $sql->bind_param("isssssssi", $userId, $firstName, $lastName, $profilePicture, $address, $birthDate, $bio, $updatedAt, $updatedBy);
        //$sql->execute();
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
        if (!$sql->execute()) {
            echo "Execute failed: (" . $sql->errno . ") " . $sql->error;
        } 
    }

    public function getUsersProfileById($id)
    {
        global $conn;
        $sql = "SELECT * FROM users_profile WHERE user_id=$id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $usersProfile = new userProfile();
            $usersProfile->setUser_id($row["user_id"]);
            $usersProfile->setFirst_name($row["first_name"]);
            $usersProfile->setLast_name($row["last_name"]);
            $usersProfile->setProfile_picture($row["profile_picture"]);
            $usersProfile->setAddress($row["address"]);
            $usersProfile->setBirth_date($row["birth_date"]);
            $usersProfile->setBio($row["bio"]);
            $usersProfile->setUpdated_at($row["updated_at"]);
            $usersProfile->setUpdated_by($row["updated_by"]);
            return $usersProfile;
        }
    }

    public function updateUsersProfileById($userProfile)
    {
        global $conn;
        $userId = $userProfile->getUser_id();
        $firstName = $userProfile->getFirst_name();
        $lastName = $userProfile->getLast_name();
        $profilePicture = $userProfile->getProfile_picture();
        $address = $userProfile->getAddress();
        $birthDate = $userProfile->getBirth_date();
        $bio = $userProfile->getBio();
        $updatedAt = $userProfile->getUpdated_at();
        $updatedBy = $userProfile->getUpdated_by();
        $sql = $conn->prepare("UPDATE users_profile SET first_name=?, last_name=?, profile_picture=?, address=?, birth_date=?, bio=?, updated_at=?, updated_by=? WHERE user_id=?");
        $sql->bind_param("sssssssii", $firstName, $lastName, $profilePicture, $address, $birthDate, $bio, $updatedAt, $updatedBy, $userId);
        $sql->execute();
    }

    public function deleteUsersProfileById($id)
    {
        global $conn;
        $sql = "DELETE FROM users_profile WHERE user_id=$id";
        $result = $conn->query($sql);
    }

    public function getAllUsersProfile()
    {
        global $conn;
        $sql = "SELECT * FROM users_profile";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $usersProfileObjects = array();
            while ($row = $result->fetch_assoc()) {
                $usersProfile = new usersProfile();
                $usersProfile->setUser_id($row["user_id"]);
                $usersProfile->setFirst_name($row["first_name"]);
                $usersProfile->setLast_name($row["last_name"]);
                $usersProfile->setProfile_picture($row["profile_picture"]);
                $usersProfile->setAddress($row["address"]);
                $usersProfile->setBirth_date($row["birth_date"]);
                $usersProfile->setBio($row["bio"]);
                $usersProfile->setUpdated_at($row["updated_at"]);
                $usersProfile->setUpdated_by($row["updated_by"]);
                array_push($usersProfileObjects, $usersProfile);
            }
            return $usersProfileObjects;
        }
    }
}
