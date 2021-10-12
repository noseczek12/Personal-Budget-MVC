<?php

namespace App;

//unikalne losowe tokeny

class Token
{
	protected $token;
	
	public function __construct($token_value = null)
	{
			if ($token_value){
					$this->token = $token_value;
			}else{
					$this->token = bin2hex(random_bytes(16));
			}
	}
	
	//zwróc wartość tokena
	public function getValue()
	{
			return $this->token;
	}
	
	//zwróć zhashowany token za pomoca HMAC
	public function getHash()
	{
			return hash_hmac('sha256', $this->token, \App\Config::SECRET_KEY);
	}
}