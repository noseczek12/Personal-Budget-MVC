<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\User;

//Login controller

class Login extends \Core\Controller
{
	//funkcja pokazująca stronę logowania
	public function newAction()
	{
			View::renderTemplate('Login/new.html');
	}
	
	//funkcja logowania użytkownika
	public function createAction()
	{
			$user = User::authenticate($_POST['email'] , $_POST['password']);
			
			if($user){
					$this->redirect('/');
			}else {
					View::renderTemplate('Login/new.html' , ['email' => $_POST['email'],]);
			}
	}
}