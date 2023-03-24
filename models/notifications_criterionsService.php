<?php

include "notifications_criterions.php";

class NotificationsCriterionsService
{
    public function addNotificaitonCriteria($notificationCriterion)
    {
        global $conn;
        $name = $notificationCriterion->getName();
        $parent_criteria_id = $notificationCriterion->getParent_criteria_id();
        $destinations = $notificationCriterion->getDestinations();
        $is_enabled = $notificationCriterion->getIs_enabled();
        $sql = $conn->prepare("INSERT INTO notifications_criterions (name, parent_criteria_id, destinations, is_enabled) VALUES (?, ?, ?, ?)");
        $sql->bind_param("siss", $name, $parent_criteria_id, $destinations, $is_enabled);
        $sql->execute();
    }

    public function getNotificaitonCriteriaByNotificaitonCriteriaId($id)
    {
        global $conn;
        $sql = "SELECT * FROM notifications_criterions WHERE notifications_criteria_id=$id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $notificationCriterion = new NotificationsCriterions();
            $notificationCriterion->setNotifications_criteria_id($row["notifications_criteria_id"]);
            $notificationCriterion->setName($row["name"]);
            $notificationCriterion->setParent_criteria_id($row["parent_criteria_id"]);
            $notificationCriterion->setDestinations($row["destinations"]);
            $notificationCriterion->setIs_enabled($row["is_enabled"]);
            return $notificationCriterion;
        }
    }

    public function getNotificaitonCriteriaByParentCriteriaId($id)
    {
        global $conn;
        $sql = "SELECT * FROM notifications_criterions WHERE parent_criteria_id=$id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $notificationsCriterionsObjects = array();
            while ($row = $result->fetch_assoc()) {
                $notificationCriterion = new NotificationsCriterions();
                $notificationCriterion->setNotifications_criteria_id($row["notifications_criteria_id"]);
                $notificationCriterion->setName($row["name"]);
                $notificationCriterion->setParent_criteria_id($row["parent_criteria_id"]);
                $notificationCriterion->setDestinations($row["destinations"]);
                $notificationCriterion->setIs_enabled($row["is_enabled"]);
                array_push($notificationsCriterionsObjects, $notificationCriterion);
            }
            return $notificationsCriterionsObjects;
        }
    }

    public function updateNotificaitonCriteriaByNotificaitonCriteriaId($notificationCriterion)
    {
        global $conn;
        $id = $notificationCriterion->getNotifications_criteria_id();
        $name = $notificationCriterion->getName();
        $parent_criteria_id = $notificationCriterion->getParent_criteria_id();
        $destinations = $notificationCriterion->getDestinations();
        $is_enabled = $notificationCriterion->getIs_enabled();
        $sql = $conn->prepare("UPDATE notifications_criterions SET name=?, parent_criteria_id=?, destinations=?, is_enabled=? WHERE notifications_criteria_id=?");
        $sql->bind_param("sissi", $name, $parent_criteria_id, $destinations, $is_enabled, $id);
        $sql->execute();
    }

    public function deleteNotificaitonCriteriaByNotificaitonCriteriaId($id)
    {
        global $conn;
        $sql = "DELETE FROM notifications_criterions WHERE notifications_criteria_id=$id";
        $result = $conn->query($sql);
    }

    public function getAllNotificationsCriterions()
    {
        global $conn;
        $sql = "SELECT * FROM notifications_criterions";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $notificationsCriterionsObjects = array();
            while ($row = $result->fetch_assoc()) {
                $notificationCriterion = new NotificationsCriterions();
                $notificationCriterion->setNotifications_criteria_id($row["notifications_criteria_id"]);
                $notificationCriterion->setName($row["name"]);
                $notificationCriterion->setParent_criteria_id($row["parent_criteria_id"]);
                $notificationCriterion->setDestinations($row["destinations"]);
                $notificationCriterion->setIs_enabled($row["is_enabled"]);
                array_push($notificationsCriterionsObjects, $notificationCriterion);
            }
            return $notificationsCriterionsObjects;
        }
    }
}
