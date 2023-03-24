<?php

include "notifications.php";

class NotificationsService
{
    public function addNotification($notificaiton)
    {
        global $conn;
        $name = $notificaiton->getName();
        $notifications_criteria_id = $notificaiton->getNotifications_criteria_id();
        $message_template = $notificaiton->getMessage_template();
        $validity_time = $notificaiton->getValidity_time();
        $action = $notificaiton->getAction();
        $destinations = $notificaiton->getDestinations();
        $is_enabled = $notificaiton->getIs_enabled();
        $sql = $conn->prepare("INSERT INTO notifications (name, notifications_criteria_id, message_template, validity_time, action, destinations, is_enabled) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $sql->bind_param("sisssss", $name, $notifications_criteria_id, $message_template, $validity_time, $action, $destinations, $is_enabled);
        $sql->execute();
    }

    public function getNotificationByNotificationId($notificationId)
    {
        global $conn;
        $sql = "SELECT * FROM notifications WHERE notification_id=$notificationId";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $notifications = new Notification();
            $notifications->setNotification_id($row["notification_id"]);
            $notifications->setName($row["name"]);
            $notifications->setNotification_criteria_id($row["notification_criteria_id"]);
            $notifications->setMessage_template($row["message_template"]);
            $notifications->setValidity_time($row["validity_time"]);
            $notifications->setAction($row["action"]);
            $notifications->setDestinations($row["destinations"]);
            $notifications->setIs_enabled($row["is_enabled"]);
            return $notifications;
        }
    }

    public function getNotificationByNotificationsCriteriaId($id)
    {
        global $conn;
        $sql = "SELECT * FROM notifications WHERE notifications_criteria_id=$id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $notifications = new Notification();
            $notifications->setNotification_id($row["notification_id"]);
            $notifications->setName($row["name"]);
            $notifications->setNotification_criteria_id($row["notification_criteria_id"]);
            $notifications->setMessage_template($row["message_template"]);
            $notifications->setValidity_time($row["validity_time"]);
            $notifications->setAction($row["action"]);
            $notifications->setDestinations($row["destinations"]);
            $notifications->setIs_enabled($row["is_enabled"]);
            return $notifications;
        }
    }

    public function updateNotificationByNotificationId($notification)
    {
        global $conn;
        $id = $notification->getNotification_id();
        $name = $notificaiton->getName();
        $notifications_criteria_id = $notificaiton->getNotifications_criteria_id();
        $message_template = $notificaiton->getMessage_template();
        $validity_time = $notificaiton->getValidity_time();
        $action = $notificaiton->getAction();
        $destinations = $notificaiton->getDestinations();
        $is_enabled = $notificaiton->getIs_enabled();
        $sql = $conn->prepare("UPDATE notifications SET name=?, notification_criteria_id=?, message_template=?, validity_time=?, action=?, destinations=?, is_enabled=? WHERE notification_id=?");
        $sql->bind_param("sisssssi", $name, $notifications_criteria_id, $message_template, $validity_time, $action, $destinations, $is_enabled, $id);
        $sql->execute();
    }

    public function deleteNotificationByNotificationId($id)
    {
        global $conn;
        $sql = "DELETE FROM notifications WHERE notification_id=$id";
        $result = $conn->query($sql);
    }

    public function getAllNotifications()
    {
        global $conn;
        $sql = "SELECT * FROM notifications";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $notificationObjects = array();
            while ($row = $result->fetch_assoc()) {
                $notifications = new Notification();
                $notifications->setNotification_id($row["notification_id"]);
                $notifications->setName($row["name"]);
                $notifications->setNotification_criteria_id($row["notification_criteria_id"]);
                $notifications->setMessage_template($row["message_template"]);
                $notifications->setValidity_time($row["validity_time"]);
                $notifications->setAction($row["action"]);
                $notifications->setDestinations($row["destinations"]);
                $notifications->setIs_enabled($row["is_enabled"]);
                array_push($notificationObjects, $notifications);
            }
            return $notificationObjects;
        }
    }
}
