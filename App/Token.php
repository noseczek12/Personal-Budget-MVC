<?php

namespace App;

/**
 * * Generating unique random tokens
 */

class Token
{
    protected $token;

    public function __construct($token_value = null)
    {
        if ($token_value) {
            $this->token = $token_value;
        } else {
            $this->token = bin2hex(random_bytes(16));
        }
    }//end __construct()

    /**
     * * Get token value.
     */
    public function getValue()
    {
        return $this->token;
    }//end getValue()

    /**
     * * Get hashed token with HMAC.
     */
    public function getHash()
    {
        return hash_hmac('sha256', $this->token, Config_new::SECRET_KEY);
    }//end getHash()
}//end class