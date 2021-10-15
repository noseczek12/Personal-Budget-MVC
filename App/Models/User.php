<?php

namespace App\Models;

use PDO;
use \App\Token;
use \App\Mail;
use \Core\View;

// User model//

class User extends \Core\Model
{
	public $errors = [];
	//konstruktor klasy
	public function __construct($data = [])
	{
			foreach ($data as $key => $value){
				$this->$key = $value;
			};	
	}
	
	//metoda zapisująca użytkownika z bieżącymi wartościami
	public function save()
	{
		 $this->validate();

        if (empty($this->errors)) {
          
            $password_hash = password_hash($this->password, PASSWORD_DEFAULT);

            $sql = 'INSERT INTO users (name, email, password_hash)
                    VALUES (:name, :email, :password_hash)';

            $db = static::getDB();
            $stmt = $db->prepare($sql);

            $stmt->bindValue(':name', $this->name, PDO::PARAM_STR);
            $stmt->bindValue(':email', $this->email, PDO::PARAM_STR);
            $stmt->bindValue(':password_hash', $password_hash, PDO::PARAM_STR);

            return $stmt->execute();
        }

        return false;
	}
	
	//funkcja sprawdzająca dane przed dodaniem do bazy
	public function validate()
	{
		// Name
       if ($this->name == '') {
           $this->errors[] = 'Name is required';
       }

       // email address
       if (filter_var($this->email, FILTER_VALIDATE_EMAIL) === false) {
           $this->errors[] = 'Invalid email';
       }
	   if (static::emailExists($this->email)) {
            $this->errors[] = 'email already taken';
        }

       // Password
       if (strlen($this->password) < 6) {
           $this->errors[] = 'Please enter at least 6 characters for the password';
       }

       if (preg_match('/.*[a-z]+.*/i', $this->password) == 0) {
           $this->errors[] = 'Password needs at least one letter';
       }

       if (preg_match('/.*\d+.*/i', $this->password) == 0) {
           $this->errors[] = 'Password needs at least one number';
       }
	}
	
	//funkcja sprawdzająca czy istnieje już konto z podanym mailem
	public static function emailExists($email)
    {
			return static::findByEmail($email) !== false;
    }
	
	//sprawdzanie użytkownika po mailu
	public static function findByEmail($email)
	{
		$sql = 'SELECT * FROM users WHERE email = :email';

        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
		$stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt->execute();

        return $stmt->fetch();
	}
	
	//weryfikacja logowania, czy email i hasło się zgadają
	public static function authenticate($email,$password)
	{
			$user = static::findByEmail($email);
			
			if($user){
					if(password_verify($password, $user->password_hash)){
							return $user;
					}
			}
			return false;
	}
	
	//sprawdzanie użytkownika po mailu
	public static function findByID($id)
	{
		$sql = 'SELECT * FROM users WHERE id = :id';

        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
		$stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt->execute();

        return $stmt->fetch();
	}
	
	//funkcja pamietająca login użytkownika
	public function rememberLogin()
	{
		$token = new Token();
		$hashed_token = $token->getHash();
		$this->remember_token = $token->getValue();
		
		$this->expiry_timestamp = time() + 60 * 60 * 24 * 30; //30 dni od teraz
		
		$sql = 'INSERT INTO remembered_logins (token_hash, user_id, expires_at) VALUES (:token_hash, :user_id, :expires_at)';
		
		$db = static::getDB();
		$stmt = $db->prepare($sql);
		
		$stmt->bindValue(':token_hash', $hashed_token, PDO::PARAM_STR);
        $stmt->bindValue(':user_id', $this->id, PDO::PARAM_INT);
        $stmt->bindValue(':expires_at', date('Y-m-d H:i:s', $this->expiry_timestamp), PDO::PARAM_STR);

        return $stmt->execute();
	}
	
	//wyślij instrukcje resetu hasła dla konkretnego użytkownika
	public static function sendPasswordReset($email)
	{
			$user = static::findByEmail($email);
			if($user){
						if($user->startPasswordReset()) {
							
							$user->sendPasswordResetEmail();
							
						}
			}
	}
	
	//funkcja rozpoczynająca proces resetowania hasła
	protected function startPasswordReset()
	{
		$token = new Token();
        $hashed_token = $token->getHash();
		$this->password_reset_token = $token->getValue();

        $expiry_timestamp = time() + 60 * 60 * 2;  // 2 hours from now

        $sql = 'UPDATE users
                SET password_reset_hash = :token_hash,
                    password_reset_expiry = :expires_at
                WHERE id = :id';

        $db = static::getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':token_hash', $hashed_token, PDO::PARAM_STR);
        $stmt->bindValue(':expires_at', date('Y-m-d H:i:s', $expiry_timestamp), PDO::PARAM_STR);
        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);

        return $stmt->execute();	
	}
	
	//funcja wysyłająca instrukcje do resetu hasła
	protected function sendPasswordResetEmail()
	{
				$url = 'http://' . $_SERVER['HTTP_HOST'] . '/password/reset/' . $this->password_reset_token;
				$text = View::getTemplate('Password/reset_email.html', ['url' => $url]);
				
				Mail::send($this->email, 'Password reset', $text);
				
	}
}