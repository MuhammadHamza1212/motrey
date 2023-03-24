<?php

class Payment{
    private $payment_id;
    private $user_id;
    private $amount;
    private $payment_method;
    private $payment_date;
    private $transaction_id;

    public function getPayment_id(){
		return $this->payment_id;
	}

	public function setPayment_id($payment_id){
		$this->payment_id = $payment_id;
	}

	public function getUser_id(){
		return $this->user_id;
	}

	public function setUser_id($user_id){
		$this->user_id = $user_id;
	}

	public function getAmount(){
		return $this->amount;
	}

	public function setAmount($amount){
		$this->amount = $amount;
	}

	public function getPayment_method(){
		return $this->payment_method;
	}

	public function setPayment_method($payment_method){
		$this->payment_method = $payment_method;
	}

	public function getPayment_date(){
		return $this->payment_date;
	}

	public function setPayment_date($payment_date){
		$this->payment_date = $payment_date;
	}

	public function getTransaction_id(){
		return $this->transaction_id;
	}

	public function setTransaction_id($transaction_id){
		$this->transaction_id = $transaction_id;
	}
    
}


?>