<?php

class Validation{
	
	private $error = false;
	public function checkFormat($value, $regex)
	{
		switch($regex){
			case "name": return $this->name($value); break;
			case "phone": return $this->phone($value); break;
			case "email": return $this->email($value); break;
			case "address": return $this->address($value); break;
			case "city": return $this->city($value); break;
			case "password": return $this->password($value); break;
			case "status": return $this->status($value); break;
			case "dob": return $this->dob($value); break;
			default: echo(" Invalid regex type "); return false;
		}
	}
	private function name($value){
		$match = preg_match('/^[a-z-\' ]{1,50}$/i', $value);
		return $this->setError($match);
	}
	private function email($value){
		$match = preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i', $value);
		return $this->setError($match);
	}
	private function phone($value){
		$match = preg_match('/\d{3}\.\d{3}.\d{4}/', $value);
		return $this->setError($match);
	}
	private function address($value){
		$match = preg_match('/\d+ [0-9a-zA-Z ]+/', $value);
		return $this->setError($match);
	}
	private function city($value){
		$match = preg_match('/^[a-z-\' ]{1,50}$/i', $value);
		return $this->setError($match);
	}
	private function password($value){
		$match = preg_match('/^[a-z-\' ]{1,50}$/i', $value);
		return $this->setError($match);
	}
	private function dob($value){
		$match = preg_match('/(0[1-9]|1[012])[-\/](0[1-9]|[12][0-9]|3[01])[-\/](19|20)\d\d/', $value);
		return $this->setError($match);
	}
	private function setError($match){
		if(!$match){
			$this->error = true;
			return "error";
		}
		else {
			return "";
		}
	}
	public function checkErrors(){
		return $this->error;
	}
}