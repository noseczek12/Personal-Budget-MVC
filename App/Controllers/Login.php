<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\User;
use \App\Auth;

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
					Auth::login($user);
					$this->redirect(Auth::getReturnToPage());
			}else {
					View::renderTemplate('Login/new.html' , ['email' => $_POST['email'],]);
			}
	}
	
	// funkcja wylogowania
	public function destroyAction()
	{
			Auth::logout();
			
			$this->redirect(Auth::getReturnToPage());
	}
}