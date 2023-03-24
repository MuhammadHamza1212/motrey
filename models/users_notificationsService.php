<?php

include "users_notifications.php";

class UsersNotificationsService
{
    public function addUserNotificationId($userNotifications)
    {
        global $conn;
        $userId = $userNotifications->getUser_ _id();
        $notification_id = $userNotifications->getNotification_id();
        $message = $userNotifications->getMessage();
        $created_at = $userNotifications->getCreated_at();
        $expiration_time = $userNotifications->getExpiration_time();
        $status = $userNotifications->getStatus();
        $sql = $conn->prepare("INSERT INTO users_notifications (user_id, notification_id, message, created_at, expiration_time, status) VALUES (?, ?, ?, ?, ?, ?)");
        $sql->bind_param("iissss", $userId, $notification_id, $message, $created_at, $expiration_time, $status);
        $sql->execute();
    }

    public function getUserNotificaitonsByUserId($id)
    {
        global $conn;
        $sql = "SELECT * FROM users_notifications WHERE user_id=$id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $usersNotificationsObjects = array();
            while ($row = $result->fetch_assoc()) {
                $userNotification = new UserNotification();
                $userNotification->setUser_notification_id($row["user_notification_id"]);
                $userNotification->setUser_id($row["user_id"]);
                $userNotification->setNotification_id($row["notification_id"]);
                $userNotification->setMessage($row["message"]);
                $userNotification->setCreated_at($row["created_at"]);
                $userNotification->setExpiration_time($row["expiration_time"]);
                $userNotification->setStatus($row["status"]);
                array_push($usersNotificationsObjects, $userNotification);
            }
            return $usersNotificationsObjects;
        }
    }

    public function getUserNotificaitonsByNotificationId($id)
    {
        global $conn;
        $sql = "SELECT * FROM users_notifications WHERE notification_id=$id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $usersNotificationsObjects = array();
            while ($row = $result->fetch_assoc()) {
                $userNotification = new UserNotification();
                $userNotification->setUser_notification_id($row["user_notification_id"]);
                $userNotification->setUser_id($row["user_id"]);
                $userNotification->setNotification_id($row["notification_id"]);
                $userNotification->setMessage($row["message"]);
                $userNotification->setCreated_at($row["created_at"]);
                $userNotification->setExpiration_time($row["expiration_time"]);
                $userNotification->setStatus($row["status"]);
                array_push($usersNotificationsObjects, $userNotification);
            }
            return $usersNotificationsObjects;
        }
    }

    public function deleteUserNotificationByUserNotificationId($id)
    {
        global $conn;
        $sql = "DELETE FROM users_notifications WHERE user_notification_id=$id";
        $result = $conn->query($sql);
    }
}
