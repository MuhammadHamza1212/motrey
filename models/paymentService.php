<?php

include "payment.php";

class PaymentService
{
    public function addPayment($payment)
    {
        global $conn;
        $user_id = $payment->getUser_id();
        $amount = $payment->getAmount();
        $payment_method = $payment->getPayment_method();
        $payment_date = $payment->getPayment_date();
        $transaction_id = $payment->getTransaction_id();
        $sql = $conn->prepare("INSERT INTO payment (user_id, amount, payment_method, payment_date, transaction_id) VALUES (?, ?, ?, ?, ?, ?)");
        $sql->bind_param("iissi", $user_id, $amount, $payment_method, $payment_date, $transaction_id);
        $sql->execute();
    }

    public function getPaymentByPaymentId($paymentId)
    {
        global $conn;
        $sql = "SELECT * FROM payment WHERE payment_id=$paymentId";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $payment = new Payment();
            $payment->setPayment_id($row["payment_id"]);
            $payment->setUser_id($row["user_id"]);
            $payment->setAmount($row["amount"]);
            $payment->setPayment_method($row["payment_method"]);
            $payment->setPayment_date($row["payment_date"]);
            $payment->setTransaction_id($row["transaction_id"]);
            return $payment;
        }
    }

    public function getPaymentByUserId($userId)
    {
        global $conn;
        $sql = "SELECT * FROM payment WHERE user_id=$userId";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $paymentObjects = array();
            while ($row = $result->fetch_assoc()) {
                $payment = new Payment();
                $payment->setPayment_id($row["payment_id"]);
                $payment->setUser_id($row["user_id"]);
                $payment->setAmount($row["amount"]);
                $payment->setPayment_method($row["payment_method"]);
                $payment->setPayment_date($row["payment_date"]);
                $payment->setTransaction_id($row["transaction_id"]);
                array_push($paymentObjects, $payment);
            }
            return $paymentObjects;
        }
    }

    public function updatePaymentById($payment)
    {
        global $conn;
        $payment_id = $payment->getPayment_id();
        $user_id = $payment->getUser_id();
        $amount = $payment->getAmount();
        $payment_method = $payment->getPayment_method();
        $payment_date = $payment->getPayment_date();
        $transaction_id = $payment->getTransaction_id();
        $sql = $conn->prepare("UPDATE payment SET user_id=?, amount=?, payment_method=?, payment_date=?, transaction_id=? WHERE payment_id=?");
        $sql->bind_param("iissii", $user_id, $amount, $payment_method, $payment_date, $transaction_id, $payment_id);
        $sql->execute();
    }

    public function deletePaymentById($id)
    {
        global $conn;
        $sql = "DELETE FROM payment WHERE payment_id=$id";
        $result = $conn->query($sql);
    }

    public function getAllPayments()
    {
        global $conn;
        $sql = "SELECT * FROM payment";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $paymentObjects = array();
            while ($row = $result->fetch_assoc()) {
                $payment = new Payment();
                $payment->setPayment_id($row["payment_id"]);
                $payment->setUser_id($row["user_id"]);
                $payment->setAmount($row["amount"]);
                $payment->setPayment_method($row["payment_method"]);
                $payment->setPayment_date($row["payment_date"]);
                $payment->setTransaction_id($row["transaction_id"]);
                array_push($paymentObjects, $payment);
            }
            return $paymentObjects;
        }
    }
}
